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

set -eu

# PG_USER="$1"
# PG_PASSWORD="$2"
# PG_USER_ROOT="$3"
# PG_ROOT_PASSWORD="$4"
# PG_PASSWORD_HOMOLOGACAO="$5"

# connection_string_root="postgresql://$PG_USER_ROOT:$PG_ROOT_PASSWORD@$PG_HOST:$PG_PORT/$PG_DATABASE"
# connection_string_prod="postgresql://$PG_USER:$PG_PASSWORD@$PG_HOST:$PG_PORT"
# connection_string_staging="postgresql://$PG_USER:$PG_PASSWORD_HOMOLOGACAO@$PG_HOST:$PG_PORT"

# USERS=("3s" "admindti" "cicero_robson" "luansidney" "manoeljr")
# users_admin=("3s" "ocorrencias_user")
# users_all=("3s" "ocorrencias_user" "admindti" "cicero_robson" "luansidney" "manoeljr")


# database_exists() {
#     local database_name="$1"
#     psql -tAc "SELECT 1 FROM pg_database WHERE datname='$database_name'" | grep -q 1
# }

# until psql "$connection_string_root" -c '\q'; do
#   >&2 echo "PostgreSQL is unavailable - sleeping"
#   sleep 5
# done

# # Verifica setup de databases, usuários e concede permissões
# psql -tA "$connection_string_root" <<-EOSQL
#     if ! database_exists "$PG_DATABASE"; then
#         psql -c "CREATE DATABASE \"$PG_DATABASE\";"
#     fi

#     if ! database_exists "$PG_DATABASE_HOMOLOGACAO"; then
#         psql -c "CREATE DATABASE \"$PG_DATABASE_HOMOLOGACAO\";"
#     fi

#     i=0
#     while [ $i -lt ${#USERS[@]} ]; do
#         USER="${USERS[$i]}"
#         echo "Verificando usuário $USER"
#         if ! psql -tAc "SELECT 1 FROM pg_roles WHERE rolname='$USER'" | grep -q 1; then
#             psql -c "CREATE USER \"$USER\";"
#             psql -c "GRANT CONNECT ON DATABASE \"$PG_DATABASE\" TO \"$USER\";"
#             psql -c "GRANT CONNECT ON DATABASE \"$PG_DATABASE_HOMOLOGACAO\" TO \"$USER\";"
#             echo "Permissões concedidas para usuário $USER"
#         else
#             echo "Usuário $USER já possui permissões de GRANT CONNECT ON DATABASE"
#         fi

#         i=$((i+1))
#     done


# EOSQL

# connection_string_root="postgresql://$PG_USER_ROOT:$PG_ROOT_PASSWORD@$PG_HOST:$PG_PORT/$PG_DATABASE"
# connection_string_prod="postgresql://$PG_USER:$PG_PASSWORD@$PG_HOST:$PG_PORT"
# connection_string_staging="postgresql://$PG_USER:$PG_PASSWORD_HOMOLOGACAO@$PG_HOST:$PG_PORT"

# users=("3s" "admindti" "cicero_robson" "luansidney" "manoeljr")
# users_admin=("3s" "ocorrencias_user")
# users_all=("3s" "ocorrencias_user" "admindti" "cicero_robson" "luansidney" "manoeljr")

database_exists() {
    local database_name="$1"
    psql -tAc "SELECT 1 FROM pg_database WHERE datname='$database_name'" | grep -q 1
}

check_user_permissions() {
    local user="$1"
    local database="$2"
    local result="$(psql -tAc "SELECT has_database_privilege('$user', '$database', 'CREATE')" 2>/dev/null)"

    if [ "$result" == "t" ]; then
        return 0
    else
        return 1
    fi
}

setup_databases() {
    local db_prod="$1"
    local db_staging="$2"
    local db_root="$3"
    local db_password="$4"
    local db_host="$5"
    local db_port="$6"

    psql -tA "postgresql://$db_root:$db_password@$db_host:$db_port/$db_prod" <<-EOSQL
        if ! database_exists "$db_prod"; then
            psql -c "CREATE DATABASE \"$db_prod\";"
        fi

        if ! database_exists "$db_staging"; then
            psql -c "CREATE DATABASE \"$db_staging\";"
        fi

        for user in ("3s" "ocorrencias_user" "admindti" "cicero_robson" "luansidney" "manoeljr"); do
            if ! psql -tAc "SELECT 1 FROM pg_roles WHERE rolname='$user'" | grep -q 1; then
                psql -c "CREATE USER \"$user\";"
                psql -c "GRANT CONNECT ON DATABASE \"$db_prod\" TO \"$user\";"
                psql -c "GRANT CONNECT ON DATABASE \"$db_staging\" TO \"$user\";"
                # concede outras permissoes
                psql -c "GRANT USAGE, CREATE, TEMPORARY ON SCHEMA public TO "$user";"
                psql -c "ALTER DEFAULT PRIVILEGES IN SCHEMA public GRANT USAGE, CREATE, TEMPORARY ON TABLES TO "$user";"
                psql -c "ALTER DEFAULT PRIVILEGES IN SCHEMA public GRANT SELECT, INSERT, UPDATE, DELETE ON TABLES TO "$user";"
                psql -c "ALTER DEFAULT PRIVILEGES IN SCHEMA public GRANT USAGE, SELECT ON SEQUENCES TO "$user";"
            fi
        done

        for user in ("3s" "ocorrencias_user"); do
            if ! check_user_permissions "$user" "$db_prod"; then
                psql -c "GRANT ALL PRIVILEGES ON DATABASE \"$db_prod\" TO \"$user\";"
            fi

            if ! check_user_permissions "$user" "$db_staging"; then
                psql -c "GRANT ALL PRIVILEGES ON DATABASE \"$db_staging\" TO \"$user\";"
            fi

            if [[ $(psql -tA "$connection_string_root" -c "SELECT pg_catalog.pg_get_userbyid(d.datdba) AS owner FROM pg_catalog.db_prod d WHERE d.datname = '$db_prod'") = "$user" ]]; then
                echo "O usuário $user é o dono do database $db_prod"
            else
                psql -c "ALTER DATABASE \"$db_prod\" OWNER TO \"$user\";"
            fi

            # Verifica se o usuário é dono do database $db_staging
            if [[ $(psql -tA "$connection_string_root" -c "SELECT pg_catalog.pg_get_userbyid(d.datdba) AS owner FROM pg_catalog.db_prod d WHERE d.datname = '$db_staging'") = "$user" ]]; then
                echo "O usuário $user é o dono do database $db_staging"
            else
                psql -c "ALTER DATABASE \"$db_staging\" OWNER TO \"$user\";"
            fi
        done

        psql -d "$db_prod" -tAc "\q";
        psql -d "$db_staging" -tAc "\q";
EOSQL
}


until psql "$connection_string_root" -c '\q'; do
  >&2 echo "PostgreSQL is unavailable - sleeping"
  sleep 5
done

setup_databases "$PG_DATABASE" "$PG_DATABASE_HOMOLOGACAO" "$PG_USER_ROOT" "$PG_ROOT_PASSWORD" "$PG_HOST" "$PG_PORT"

# Verifica setup de databases, usuários e concede permissões
    # for user in "${users_all[@]}"; do
    #     if ! psql -tAc "SELECT 1 FROM pg_roles WHERE rolname='$user'" | grep -q 1; then
    #         psql -c "CREATE USER \"$user\";"
    #         psql -c "GRANT CONNECT ON DATABASE \"$PG_DATABASE\" TO \"$user\";"
    #         psql -c "GRANT CONNECT ON DATABASE \"$PG_DATABASE_HOMOLOGACAO\" TO \"$user\";"
    #     fi
    # done

    # for user in "${users[@]}"; do
    #     if [[ "$(psql -tAc "SELECT pg_get_userbyid(d.datdba) FROM pg_database d WHERE d.datname = '$PG_DATABASE_HOMOLOGACAO'")" != "$user" ]]; then
    #         psql -c "GRANT ALL PRIVILEGES ON DATABASE \"$PG_DATABASE_HOMOLOGACAO\" TO \"$user\";"
    #     fi
    #     if [[ "$(psql -tAc "SELECT pg_get_userbyid(d.datdba) FROM pg_database d WHERE d.datname = '$PG_DATABASE'")" != "$user" ]]; then
    #         psql -c "GRANT ALL PRIVILEGES ON DATABASE \"$PG_DATABASE\" TO \"$user\";"
    #     fi
    # done

    # for user in "${users_admin[@]}"; do
    #     if [[ "$(psql -tAc "SELECT pg_get_userbyid(d.datdba) FROM pg_database d WHERE d.datname = '$PG_DATABASE_HOMOLOGACAO'")" != "$user" ]]; then
    #         psql -c "ALTER DATABASE \"$PG_DATABASE_HOMOLOGACAO\" OWNER TO \"$user\";"
    #     fi
    #     if [[ "$(psql -tAc "SELECT pg_get_userbyid(d.datdba) FROM pg_database d WHERE d.datname = '$PG_DATABASE'")" != "$user" ]]; then
    #         psql -c "ALTER DATABASE \"$PG_DATABASE\" OWNER TO \"$user\";"
    #     fi
    # done
    # psql -d postgres -tAc "\q";


# # Conceder permissões adicionais aos usuários root
# psql -tA "$connection_string_prod/$PG_DATABASE" <<-EOSQL
#     for user in "${users_all[@]}"; do
#         psql -c "GRANT USAGE, CREATE, TEMPORARY ON SCHEMA public TO "$user";"
#         psql -c "ALTER DEFAULT PRIVILEGES IN SCHEMA public GRANT USAGE, CREATE, TEMPORARY ON TABLES TO "$user";"
#         psql -c "ALTER DEFAULT PRIVILEGES IN SCHEMA public GRANT SELECT, INSERT, UPDATE, DELETE ON TABLES TO "$user";"
#         psql -c "ALTER DEFAULT PRIVILEGES IN SCHEMA public GRANT USAGE, SELECT ON SEQUENCES TO "$user";"
#     done
#     psql -d "$PG_DATABASE" -tAc "\q";
# EOSQL

# # Conceder permissões adicionais aos usuários regulares
# psql -tA "$connection_string_staging/$PG_DATABASE_HOMOLOGACAO" <<-EOSQL
#     for user in "${users_all[@]}"; do
#         psql -c "GRANT USAGE, CREATE, TEMPORARY ON SCHEMA public TO \"$user\";"
#         psql -c "ALTER DEFAULT PRIVILEGES IN SCHEMA public GRANT USAGE, CREATE, TEMPORARY ON TABLES TO \"$user\";"
#         psql -c "ALTER DEFAULT PRIVILEGES IN SCHEMA public GRANT SELECT, INSERT, UPDATE, DELETE ON TABLES TO \"$user\";"
#         psql -c "ALTER DEFAULT PRIVILEGES IN SCHEMA public GRANT USAGE, SELECT ON SEQUENCES TO \"$user\";"
#     done
#     psql -d "$PG_DATABASE_HOMOLOGACAO" -tAc "\q";
# EOSQL