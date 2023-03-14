#!/bin/bash

set -eu

# Connection options:
#   -h, --host=HOSTNAME      host do servidor de banco de dados
#   -p, --port=PORT          porta do servidor de banco de dados
#   -U, --username=USERNAME  nome de usuário do banco de dados
#   -w, --no-password        nunca solicitar senha
#   -W, --password           forçar prompt de senha (should happen automatically)

# user/s
function config_user() {
	echo "⏳ Criando o role $POSTGRES_MULTIPLE_DATABASES_USER"
    psql -v "postgresql://$POSTGRES_USER:$POSTGRES_PASSWORD@postgresql/postgres" <<-EOSQL
	    
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
        COMMENT ON ROLE "$POSTGRES_MULTIPLE_DATABASES_USER" IS 'Usuario padrao do banco de dados';
EOSQL

}

# database/s
function create_database() {
	local database=$1
	echo "⏳ Criando o banco de dados $database"
    psql -v "postgresql://$POSTGRES_USER:$POSTGRES_PASSWORD@postgresql/postgres" <<-EOSQL
	    
        ------------------------------------------------------------------------------------
        -- CRIA DATABASE
        ------------------------------------------------------------------------------------
        CREATE DATABASE "$database"
            WITH
            OWNER = "$POSTGRES_MULTIPLE_DATABASES_USER"
            ENCODING = 'UTF8'
            CONNECTION LIMIT = -1
            TEMPLATE template0;
        COMMENT ON DATABASE "$database" IS 'Dadabase PosgresSQL local.';

EOSQL
}


# schemas
function create_schemas() {
	local database=$1
	echo "⏳ Configurando schemas para o banco de dados $database"
    psql -v "postgresql://$POSTGRES_MULTIPLE_DATABASES_USER:$POSTGRES_MULTIPLE_DATABASES_PASSWORD@postgresql/$database" <<-EOSQL
        
        ------------------------------------------------------------------------------------
        -- CONFIGURA SCHEMAS para DATABASE E USUARIO PADRAO DO BANCO
        ------------------------------------------------------------------------------------
            
        CREATE SCHEMA IF NOT EXISTS dev AUTHORIZATION "$POSTGRES_MULTIPLE_DATABASES_USER";
        GRANT ALL ON SCHEMA public TO "$POSTGRES_MULTIPLE_DATABASES_USER";
        GRANT ALL ON SCHEMA dev TO "$POSTGRES_MULTIPLE_DATABASES_USER";
        GRANT ALL PRIVILEGES ON DATABASE "$database" TO "$POSTGRES_MULTIPLE_DATABASES_USER";
        ALTER DATABASE postgres OWNER TO "$POSTGRES_MULTIPLE_DATABASES_USER";

        ------------------------------------------------------------------------------------
        -- EXCLUI O SCHEMA PADRAO
        ------------------------------------------------------------------------------------
        -- DROP SCHEMA IF EXISTS public CASCADE;
        
EOSQL
}

# migrations
function create_migrations() {
	local database=$1

    echo " ⏳ Criando tabelas"

    #################################################################################################
    #  Scripts para criação da estrutura inicial do database.                                       #
    #################################################################################################

    psql -v "postgresql://$POSTGRES_MULTIPLE_DATABASES_USER:$POSTGRES_MULTIPLE_DATABASES_PASSWORD@postgresql/$database" -a -q -f "/mnt/01init.sql"

    pg_dump "host=10.130.0.154 port=5432 dbname=3s-ocorrencias user=3s password=$DB_PASSWORD_DUMP" -v > /tmp/3s-backup

    psql -U postgres -d laravel < /tmp/3s-backup

}

# Espere para ter certeza de que o PostgreSQL ficou Up.
echo "⏳ Aguardando o SGBD ficar disponível para iniciar setup."
sleep 30s

if [ "$( psql -XtAc "SELECT 1 FROM pg_database WHERE datname='laravel'" )" = '1' ]
then
    echo " ⏳ Banco de dados existente."
else
    if [ "$( psql -XtAc "SELECT 1 FROM pg_roles WHERE rolname='$POSTGRES_MULTIPLE_DATABASES_USER'" )" = '' ]
    then
        config_user
    fi

    if [ -n "$POSTGRES_MULTIPLE_DATABASES" ]; then
        for db in $(echo $POSTGRES_MULTIPLE_DATABASES | tr ',' ' '); do
            create_database $db
        done
    fi

    if [ -n "$POSTGRES_MULTIPLE_DATABASES" ]; then
        for db in $(echo $POSTGRES_MULTIPLE_DATABASES | tr ',' ' '); do
            create_schemas $db
        done
    fi

    if [ -n "$POSTGRES_MULTIPLE_DATABASES" ]; then
        for db in $(echo $POSTGRES_MULTIPLE_DATABASES | tr ',' ' '); do
            create_migrations $db
        done
    fi
fi
