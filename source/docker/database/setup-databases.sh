#!/bin/bash

###############################################################################
# 
# Nome do arquivo: setup-databases.sh
# Autor: Erivando Sena <erivandoramos@unilab.edu.br>
# Data de criação: 29/04/2023
#
# Descrição: Este script foi desenvolvido como parte do projeto [Stack DEVOPS DTI] da 
#            Universidade da Integração Internacional da Lusofonia Afro-Brasileira (UNILAB).
#
# Direitos autorais (c) 2023 Erivando Sena/UNILAB.
#
# É concedida permissão para usar, copiar, modificar e distribuir este software apenas para 
# uso pessoal ou em sua organização, desde que este aviso de direitos autorais apareça em 
# todas as cópias. 
# Este software é fornecido "como está" e sem garantias expressas ou implícitas, incluindo, 
# mas não se limitando a, garantias implícitas de comercialização e adequação a um propósito 
# específico. 
# Em nenhum caso, o autor será responsável por quaisquer danos diretos, indiretos, 
# incidentais, especiais, exemplares ou consequentes (incluindo, mas não se limitando 
# a, aquisição de bens ou serviços substitutos, perda de uso, dados ou lucros, ou 
# interrupção dos negócios) decorrentes do uso, incapacidade de uso ou resultados do 
# uso deste software.
#
# Este programa é distribuído na esperança de que possa ser útil, mas SEM NENHUMA 
# GARANTIA; sem uma garantia implícita de ADEQUAÇÃO a qualquer MERCADO ou APLICAÇÃO EM PARTICULAR.
# Veja a Licença Pública Geral GNU para mais detalhes.
#
##############################################################################

# Connection options:
#   -h, --host=HOSTNAME      host do servidor de banco de dados
#   -p, --port=PORT          porta do servidor de banco de dados
#   -U, --username=USERNAME  nome de usuário do banco de dados
#   -w, --no-password        nunca solicitar senha
#   -W, --password           forçar prompt de senha (should happen automatically)

set -euo pipefail

connection_string_root="postgresql://$PG_USER_ROOT:$PG_ROOT_PASSWORD@$PG_HOST:$PG_PORT"

# # Define as constantes
# readonly MAX_ATTEMPTS=15
# readonly WAIT_TIME=5

# # Define a função para verificar a conexão com o PostgreSQL
# function verifica_postgres() {
#     local database="${1:?Database name not provided}"
#     attempts=0
#     until psql "$connection_string_root/$database" -c '\q'; do
#         >&2 echo "PostgreSQL indisponível! Tentando novamente em ${WAIT_TIME} segundos..."
#         sleep ${WAIT_TIME}

#         attempts=$((attempts+1))
#         if [ $attempts -eq $MAX_ATTEMPTS ]; then
#             >&2 echo "Falha ao conectar ao PostgreSQL após $MAX_ATTEMPTS tentativas."
#             exit 1
#         fi
#     done
# }

# set -euo pipefail

# Define as constantes
readonly MAX_ATTEMPTS=15
readonly WAIT_TIME=5

# Define a função para verificar a conexão com o PostgreSQL
function verifica_postgres() {
    local connection_string="$1"
    local database="$2"
    local attempts=0

    until psql -tAc "${connection_string}/${database}" -qc '\q'; do
        >&2 echo "PostgreSQL indisponível! Tentando novamente em ${WAIT_TIME} segundos..."
        sleep ${WAIT_TIME}

        attempts=$((attempts+1))
        if [ ${attempts} -eq ${MAX_ATTEMPTS} ]; then
            >&2 echo "Falha ao conectar ao PostgreSQL após ${MAX_ATTEMPTS} tentativas."
            exit 1
        fi
    done
}


function database_exists() {
    local database_name="$1"
    return $(psql -tAc "SELECT 1 FROM pg_database WHERE datname='$database_name';" | grep -qc 1)
}

function user_exists() {
    local username="$1"
    return $(psql -tAc "SELECT 1 FROM pg_roles WHERE rolname='$username'" | grep -qc 1)
}

function create_user_admin() {
    local username=$1

    psql -tc "$connection_string_root/postgres" <<-EOSQL
        CREATE ROLE "$username" WITH
            SUPERUSER
            LOGIN 
            CREATEDB
            CREATEROLE
            REPLICATION
            INHERIT
            CONNECTION LIMIT -1
            PASSWORD 'md5' || md5('$username');

        COMMENT ON ROLE "$username" IS 'Usuario admin padrão.';
EOSQL
}

function create_user_regular() {
    local username=$1

    psql -tc "$connection_string_root/postgres" <<-EOSQL
        CREATE ROLE "$username" WITH
            LOGIN 
            CREATEDB
            CREATEROLE
            REPLICATION
            INHERIT
            CONNECTION LIMIT -1
            PASSWORD 'md5' || md5('$username');

        COMMENT ON ROLE "$username" IS 'Usuario regular padrão.';
EOSQL
}

function check_user_privilegios() {
    local database="$1"
    local user="$2"
    local result="$(psql -tAc "SELECT has_database_privilege('$user', '$database', 'CREATE')" 2>/dev/null)"

    if [ "$result" == "t" ]; then
        return 1
    else
        return 0
    fi
}

function check_owner_database() {
    local database="$1"
    local user="$2"
    if [[ $(psql -tA "$connection_string_root/postgres" -c "SELECT pg_catalog.pg_get_userbyid(d.datdba) AS owner FROM pg_catalog."$database" d WHERE d.datname = '$database'") = "$user" ]]; then
        return 1
    else
        return 0
    fi
}

function create_database() {
	local database=$1
    local user=$2

    psql -tc "$connection_string_root/postgres" <<-EOSQL
        CREATE DATABASE "$database"
            WITH
            OWNER = "$user"
            ENCODING = 'UTF8'
            CONNECTION LIMIT = -1
            TEMPLATE template0;

        COMMENT ON DATABASE "$database" IS 'Dadabase PostgreSQL $database.';
EOSQL
}

function atribui_privilegios() {
    local database="$1"
    local user="$2"

    psql -tc "$connection_string_root/postgres" <<-EOSQL
        GRANT CONNECT ON DATABASE "$database" TO "$user";
        GRANT USAGE, CREATE, TEMPORARY ON SCHEMA public TO "$user";
        ALTER DEFAULT PRIVILEGES IN DATABASE $database GRANT USAGE, CREATE, TEMPORARY ON TABLES TO "$user";
        ALTER DEFAULT PRIVILEGES IN DATABASE $database GRANT SELECT, INSERT, UPDATE, DELETE ON TABLES TO "$user";
        ALTER DEFAULT PRIVILEGES IN DATABASE $database GRANT USAGE, SELECT ON SEQUENCES TO "$user";
EOSQL

    psql -tc "$connection_string_root/$database" <<-EOSQL
        GRANT USAGE, CREATE, TEMPORARY ON SCHEMA public TO "$user";
EOSQL
}

function atribui_privilegios_woner() {
    local database="$1"
    local user="$2"

    psql -tc "$connection_string_root/postgres" <<-EOSQL
        ALTER DATABASE "$database" OWNER TO "$user";"
        GRANT USAGE, CREATE, TEMPORARY ON SCHEMA public TO "$user";
        GRANT ALL PRIVILEGES ON DATABASE "$database" TO "$user";"
EOSQL
}

verifica_postgres "$connection_string_root" "$PG_DATABASE"

if ! database_exists "$PG_DATABASE"; then
    create_database $PG_DATABASE $PG_USER
fi

if ! database_exists "$PG_DATABASE_HOMOLOGACAO"; then
    create_database $PG_DATABASE_HOMOLOGACAO $PG_USER
fi

array_users=("3s" "ocorrencias_user" "admindti")
for i in ${!array_users[@]}; do

    echo "O elemento $i é ${array_users[$i]}"
    username="${array_users[$i]}"

    if ! user_exists "$username"; then
        create_user_admin "$username"
    fi

    if ! check_user_privilegios "$PG_DATABASE" "$username"; then
        atribui_privilegios_woner "$PG_DATABASE" "$username"
    fi

    if ! check_user_privilegios "$PG_DATABASE_HOMOLOGACAO" "$username"; then
        atribui_privilegios_woner "$PG_DATABASE_HOMOLOGACAO" "$username"
    fi
done

array_users=("cicero_robson" "luansidney" "manoeljr")
for i in ${!array_users[@]}; do

    echo "O elemento $i é ${array_users[$i]}"
    username="${array_users[$i]}"

    if ! user_exists "$username"; then
        create_user_regular "$username"
    fi

    if ! check_user_privilegios "$PG_DATABASE" "$username"; then
        atribui_privilegios "$PG_DATABASE" "$username"
    fi

    if ! check_user_privilegios "$PG_DATABASE_HOMOLOGACAO" "$username"; then
        atribui_privilegios "$PG_DATABASE_HOMOLOGACAO" "$username"
    fi
done