#!/bin/bash

set -e
set -u

echo " ⏳ Configurando o PostgreSQL"

# Connection options:
#   -h, --host=HOSTNAME      host do servidor de banco de dados
#   -p, --port=PORT          porta do servidor de banco de dados
#   -U, --username=USERNAME  nome de usuário do banco de dados
#   -w, --no-password        nunca solicitar senha
#   -W, --password           forçar prompt de senha (should happen automatically)

# databases
function create_user_and_database() {
	local database=$1
	echo " ⏳ Elevando o usuario e criando o banco de dados $database"
	psql -v ON_ERROR_STOP=1 -d "host=localhost port=5432 dbname=postgres user=$POSTGRES_USER" -w "$POSTGRES_PASSWORD" <<-EOSQL
	    
        ------------------------------------------------------------------------------------
        -- CONFIGURA USUARIO E SENHA
        ------------------------------------------------------------------------------------
        CREATE ROLE "$POSTGRES_MULTIPLE_DATABASES_USER" WITH
            SUPERUSER
            LOGIN 
            CREATEDB
            CREATEROLE
            REPLICATION
            INHERIT
            CONNECTION LIMIT -1
            PASSWORD '$POSTGRES_MULTIPLE_DATABASES_PASSWORD';
            -- ENCRYPTED PASSWORD 'SCRAM-SHA-256\$4096:WsWlAj4V8q5F5Vgntw/aKA==\$eO8bF24UBuDU32dLmC3dk3Xzpl/Ap3MXfvxMsiZcGIY=:vMU0MUrLmICBvzCJcs1/8LX0YaPvVlEc4QyWR+hYx+g=';
        COMMENT ON ROLE "$POSTGRES_MULTIPLE_DATABASES_USER" IS 'Usuario padrao do banco de dados';

        ------------------------------------------------------------------------------------
        -- CRIA DATABASE
        ------------------------------------------------------------------------------------
        CREATE DATABASE "$database"
            WITH
            OWNER = "$POSTGRES_MULTIPLE_DATABASES_USER"
            ENCODING = 'UTF8'
            CONNECTION LIMIT = -1
            TEMPLATE template0;
        COMMENT ON DATABASE "$database" IS 'Dadabase PosgresSQL Local.';

EOSQL
}

# schemas
function create_schemas() {
	local database=$1
	echo " ⏳ Configurando schemas para o banco de dados $database"
    psql -v ON_ERROR_STOP=1 -d "host=localhost port=5432 dbname=$database user=$POSTGRES_MULTIPLE_DATABASES_USER" -W "$POSTGRES_MULTIPLE_DATABASES_PASSWORD" <<-EOSQL
        
        ------------------------------------------------------------------------------------
        -- CONFIGURA SCHEMAS para DATABASE E USUARIO PADRAO DO BANCO
        ------------------------------------------------------------------------------------
            
        CREATE SCHEMA IF NOT EXISTS dev;
        CREATE SCHEMA IF NOT EXISTS prod;
        GRANT ALL ON SCHEMA dev TO "$POSTGRES_MULTIPLE_DATABASES_USER";
        GRANT ALL ON SCHEMA prod TO "$POSTGRES_MULTIPLE_DATABASES_USER";
        GRANT ALL PRIVILEGES ON DATABASE "$database" TO "$POSTGRES_MULTIPLE_DATABASES_USER";
        SET search_path TO dev;
        ALTER DATABASE "$database" SET search_path TO dev;

        ------------------------------------------------------------------------------------
        -- EXCLUI O SCHEMA PADRAO
        ------------------------------------------------------------------------------------
        -- DROP SCHEMA IF EXISTS public CASCADE;

EOSQL
}
function config_user() {
	local database=$1
	echo " ⏳ Configurando usuário do banco de dados $database"
	psql -v ON_ERROR_STOP=1 -d "host=localhost port=5432 dbname=postgres user=$POSTGRES_USER" -W "$POSTGRES_PASSWORD" <<-EOSQL
	    
        ------------------------------------------------------------------------------------
        -- CONFIGURA USUARIO
        ------------------------------------------------------------------------------------
        ALTER USER "$POSTGRES_MULTIPLE_DATABASES_USER" WITH 
            SUPERUSER
            LOGIN 
            CREATEDB
            CREATEROLE
            REPLICATION
            INHERIT
            CONNECTION LIMIT -1;
EOSQL
}

# migrations
function create_migrations() {
	local database=$1

    echo " ⏳ Criando tabelas no $database"

    #################################################################################################
    #  Scripts para criação da estrutura inicial do database.                                       #
    #################################################################################################

    psql -v ON_ERROR_STOP=1 -d "host=localhost port=5432 dbname=$database user=$POSTGRES_USER" -W "$POSTGRES_PASSWORD" -a -q -f "/mnt/01init.sql"
}


# host="localhost"
# #wait postgres up
# until psql -h "$host" -U "postgres" -c '\q'; do
#   echo "Postgres is unavailable - sleeping"
#   sleep 10s
# done

# #wait populate script
# while ! psql -h "$host" -U "postgres" -t -c "select 1" | egrep .
# do
#   sleep 10s
# done
# echo "Postgres is populated - executing command"


# # Espere para ter certeza de que o PostgreSQL ficou Up.
# echo "⏳ Aguardando o SGBD ficar disponível"


# if [ "$( psql -XtAc "SELECT 1 FROM pg_database WHERE datname='laravel-dev'" )" = '1' ]
# then
#     echo " ⏳ Banco de dados existente."
# else
#     if [ -n "$POSTGRES_MULTIPLE_DATABASES" ]; then
#         for db in $(echo $POSTGRES_MULTIPLE_DATABASES | tr ',' ' '); do
#             create_user_and_database $db
#         done
#     fi

#     if [ -n "$POSTGRES_MULTIPLE_DATABASES" ]; then
#         for db in $(echo $POSTGRES_MULTIPLE_DATABASES | tr ',' ' '); do
#             create_schemas $db
#         done
#     fi

#     if [ -n "$POSTGRES_MULTIPLE_DATABASES" ]; then
#         for db in $(echo $POSTGRES_MULTIPLE_DATABASES | tr ',' ' '); do
#             create_migrations $db
#         done
#     fi

#     if [ -n "$POSTGRES_MULTIPLE_DATABASES" ]; then
#         for db in $(echo $POSTGRES_MULTIPLE_DATABASES | tr ',' ' '); do
#             config_user $db
#         done
#     fi
# fi

