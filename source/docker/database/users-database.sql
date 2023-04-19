------------------------------------------------------------------------------------
-- CONFIGURA USUARIO E SENHA | 3s
------------------------------------------------------------------------------------
create USER "3s" WITH 
    SUPERUSER
    LOGIN 
    CREATEDB
    CREATEROLE
    REPLICATION
    INHERIT
    CONNECTION LIMIT -1
    PASSWORD '<PASSWD>';
COMMENT ON ROLE "3s" IS 'Usuário padrão 3s-ocorrencias.';

create USER "vault" WITH 
    SUPERUSER
    LOGIN 
    CREATEDB
    CREATEROLE
    REPLICATION
    INHERIT
    CONNECTION LIMIT -1
    PASSWORD '<PASSWD>';
COMMENT ON ROLE "vault" IS 'Usuário do Agent Vault HashiCorp para Injecting Secrets.';

------------------------------------------------------------------------------------
-- CRIA DATABASE | 3s-ocorrencias
------------------------------------------------------------------------------------
CREATE DATABASE 3s-ocorrencias
    WITH
    OWNER = "3s"
    ENCODING = 'UTF8'
    CONNECTION LIMIT = -1
    TEMPLATE template0;
COMMENT ON DATABASE 3s-ocorrencias IS 'Dadabase para 3S';

------------------------------------------------------------------------------------
-- CRIA DATABASE | 3s-homologacao
------------------------------------------------------------------------------------
CREATE DATABASE "3s-homologacao"
    WITH
    OWNER = "3s"
    TEMPLATE = "3s-ocorrencias"
    ENCODING = 'UTF8'
    CONNECTION LIMIT = -1
    IS_TEMPLATE = False;

COMMENT ON DATABASE "3s-homologacao"
    IS 'Banco de dados temporário para homologação (Staging)';

GRANT ALL PRIVILEGES ON DATABASE "3s-ocorrencias" TO "vault";
GRANT ALL PRIVILEGES ON DATABASE "3s-homologacao" TO "vault";