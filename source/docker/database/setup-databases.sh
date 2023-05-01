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

set -xeu

# PG_USER="$1"
# PG_PASSWORD="$2"
# PG_USER_ROOT="$3"
# PG_ROOT_PASSWORD="$4"
# PG_PASSWORD_HOMOLOGACAO="$5"

connection_string_root="postgresql://$PG_USER_ROOT:$PG_ROOT_PASSWORD@$PG_HOST:$PG_PORT/$PG_DATABASE"
connection_string_prod="postgresql://$PG_USER:$PG_PASSWORD@$PG_HOST:$PG_PORT"
connection_string_staging="postgresql://$PG_USER:$PG_PASSWORD_HOMOLOGACAO@$PG_HOST:$PG_PORT"

database_exists() {
    local database_name="$1"
    psql -tAc "SELECT 1 FROM pg_database WHERE datname='$database_name'" | grep -q 1
}

until psql "$connection_string_root" -c '\q'; do
  >&2 echo "PostgreSQL is unavailable - sleeping"
  sleep 5
done

# Verifica setup de databases, usuários e concede permissões
psql -tA "$connection_string_root" <<-EOSQL
    if ! database_exists "$PG_DATABASE"; then
        psql -c "CREATE DATABASE \"$PG_DATABASE\";"
    fi

    if ! database_exists "$PG_DATABASE_HOMOLOGACAO"; then
        psql -c "CREATE DATABASE \"$PG_DATABASE_HOMOLOGACAO\";"
    fi

    users=($USERS_ROOT_DUMP)
    for user in "${users[@]}"; do
        if ! psql -tAc "SELECT 1 FROM pg_roles WHERE rolname='$user'" | grep -q 1; then
            psql -c "CREATE USER \"$user\";"
            psql -c "GRANT CONNECT ON DATABASE \"$PG_DATABASE\" TO \"$user\";"
            psql -c "GRANT CONNECT ON DATABASE \"$PG_DATABASE_HOMOLOGACAO\" TO \"$user\";"
        fi
    done

    users=("3s" "admindti" "cicero_robson" "luansidney" "manoeljr")
    for user in "${users_admin[@]}"; do
        if [[ "$(psql -tAc "SELECT pg_get_userbyid(d.datdba) FROM pg_database d WHERE d.datname = '$PG_DATABASE_HOMOLOGACAO'")" != "$user" ]]; then
            psql -c "GRANT ALL PRIVILEGES ON DATABASE \"$PG_DATABASE_HOMOLOGACAO\" TO \"$user\";"
        fi
        if [[ "$(psql -tAc "SELECT pg_get_userbyid(d.datdba) FROM pg_database d WHERE d.datname = '$PG_DATABASE'")" != "$user" ]]; then
            psql -c "GRANT ALL PRIVILEGES ON DATABASE \"$PG_DATABASE\" TO \"$user\";"
        fi
    done

    users_admin=($USERS_DUMP)
    for user in "${users_admin[@]}"; do
        if [[ "$(psql -tAc "SELECT pg_get_userbyid(d.datdba) FROM pg_database d WHERE d.datname = '$PG_DATABASE_HOMOLOGACAO'")" != "$user" ]]; then
            psql -c "ALTER DATABASE \"$PG_DATABASE_HOMOLOGACAO\" OWNER TO \"$user\";"
        fi
        if [[ "$(psql -tAc "SELECT pg_get_userbyid(d.datdba) FROM pg_database d WHERE d.datname = '$PG_DATABASE'")" != "$user" ]]; then
            psql -c "ALTER DATABASE \"$PG_DATABASE\" OWNER TO \"$user\";"
        fi
    done
    psql -d postgres -tAc "\q";
EOSQL

# Conceder permissões adicionais aos usuários root
psql -tA "$connection_string_prod/$PG_DATABASE" <<-EOSQL
    for user in "${users[@]}"; do
        psql -c "GRANT USAGE, CREATE, TEMPORARY ON SCHEMA public TO "$user";"
        psql -c "ALTER DEFAULT PRIVILEGES IN SCHEMA public GRANT USAGE, CREATE, TEMPORARY ON TABLES TO "$user";"
        psql -c "ALTER DEFAULT PRIVILEGES IN SCHEMA public GRANT SELECT, INSERT, UPDATE, DELETE ON TABLES TO "$user";"
        psql -c "ALTER DEFAULT PRIVILEGES IN SCHEMA public GRANT USAGE, SELECT ON SEQUENCES TO "$user";"
    done
    psql -d "$PG_DATABASE" -tAc "\q";
EOSQL

# Conceder permissões adicionais aos usuários regulares
psql -tA "$connection_string_staging/$PG_DATABASE_HOMOLOGACAO" <<-EOSQL
    for user in "${users[@]}"; do
        psql -c "GRANT USAGE, CREATE, TEMPORARY ON SCHEMA public TO \"$user\";"
        psql -c "ALTER DEFAULT PRIVILEGES IN SCHEMA public GRANT USAGE, CREATE, TEMPORARY ON TABLES TO \"$user\";"
        psql -c "ALTER DEFAULT PRIVILEGES IN SCHEMA public GRANT SELECT, INSERT, UPDATE, DELETE ON TABLES TO \"$user\";"
        psql -c "ALTER DEFAULT PRIVILEGES IN SCHEMA public GRANT USAGE, SELECT ON SEQUENCES TO \"$user\";"
    done
    psql -d "$PG_DATABASE_HOMOLOGACAO" -tAc "\q";
EOSQL