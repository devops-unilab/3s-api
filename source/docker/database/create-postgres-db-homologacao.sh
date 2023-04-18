#!/bin/bash

set -eu

# Connection options:
#   -h, --host=HOSTNAME      host do servidor de banco de dados
#   -p, --port=PORT          porta do servidor de banco de dados
#   -U, --username=USERNAME  nome de usuário do banco de dados
#   -w, --no-password        nunca solicitar senha
#   -W, --password           forçar prompt de senha (should happen automatically)

# database/s
function create_database() {
	local database=$1
	echo "⏳ Criando o banco de dados $database"
    psql -v -d $PG_DATABASE -U $PG_USER -w <<-EOSQL
        ------------------------------------------------------------------------------------
        -- CRIA DATABASE
        ------------------------------------------------------------------------------------

        CREATE DATABASE "$database"
            WITH
            OWNER = "$PG_USER"
            ENCODING = 'UTF8'
            CONNECTION LIMIT = -1
            TEMPLATE template0;
        COMMENT ON DATABASE "$database" IS 'Dadabase PostgreSQL 3S Staging (Homologacao).';
EOSQL
}


# schemas
function config_privileges() {
	local database=$1
	echo "⏳ Configurando schemas para o banco de dados $database"
    psql -v -d $PG_DATABASE -U $PG_USER -w <<-EOSQL
        ------------------------------------------------------------------------------------
        -- CONFIGURA SCHEMA, GRANT, DATABASE
        ------------------------------------------------------------------------------------
        
        GRANT ALL PRIVILEGES ON DATABASE "$database" TO "$PG_USER";
        GRANT ALL PRIVILEGES ON DATABASE "ocorrencias" TO "$PG_USER";

        ------------------------------------------------------------------------------------
        -- EXCLUI O SCHEMA PADRAO
        ------------------------------------------------------------------------------------
        -- DROP SCHEMA IF EXISTS public CASCADE;  
EOSQL
}

# migrations
function create_migrations() {
	local database=$1

    echo "⏳ Criando roles, etc"

    #################################################################################################
    #  Scripts para configuracao da estrutura do database.                                          #
    #################################################################################################

    psql -v -d $PG_DATABASE -U $PG_USER -w -a -q -f "/mnt/01init.sql"
    psql -v -d "$database" -U $PG_USER -w -a -q -f "/mnt/01init.sql"

    # pg_dump "host=3s.unilab.edu.br port=5432 dbname=ocorrencias user=3s password=$DB_PASSWORD_DUMP" -v > /tmp/3s-backup

    # psql -U "3s" -d "$database" < /tmp/3s-backup
    # psql -U "3s" -d "ocorrencias" < /tmp/3s-backup

    # rm /tmp/3s-backup

}

# databases
function config_user() {
    psql -v -d $PG_DATABASE -U postgres -w <<-EOSQL
        ------------------------------------------------------------------------------------
        -- CONFIGURA USUARIO PADRAO
        ------------------------------------------------------------------------------------
        ALTER USER "$PG_USER" WITH 
            -- SUPERUSER
            LOGIN 
            CREATEDB
            CREATEROLE
            REPLICATION
            INHERIT
            CONNECTION LIMIT -1;
EOSQL
}

# Aguarda para ter certeza de que o PostgreSQL esta Up.
echo "⏳ Aguardando o SGBD ficar disponível para iniciar setup."
sleep 30s

if [ "$( psql -XtAc "SELECT 1 FROM pg_database WHERE datname='$database'" )" = '1' ]
then
    echo "⏳ Banco de dados existente."
else
    create_database $database
    config_privileges $database
    create_migrations $database
    config_user
fi
