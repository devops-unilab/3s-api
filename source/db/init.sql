-- ########################## LARAVEL ##########################

CREATE TABLE IF NOT EXISTS failed_jobs (
    id         bigserial                           not null,
    uuid       varchar(255)                        not null,
    connection text                                not null,
    queue      text                                not null,
    payload    varchar(255)                        not null,
    exception  varchar(255)                        not null,
    failed_at  timestamp default CURRENT_TIMESTAMP not null,
    constraint failed_jobs_uuid_unique unique(uuid)
);
-- collate = utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS migrations (
    id         bigserial   not null,
    migration varchar(255) not null,
    batch     int          not null
);
-- collate = utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS password_resets (
    email      varchar(255) not null,
    token      varchar(255) not null,
    created_at timestamp    null
);
-- collate = utf8mb4_unicode_ci;

create index password_resets_email_index on password_resets (email);

CREATE TABLE IF NOT EXISTS personal_access_tokens (
    id             bigserial       not null,
    tokenable_type varchar(255)    not null,
    tokenable_id   oid             not null,
    name           varchar(255)    not null,
    token          varchar(64)     not null,
    abilities      text            null,
    last_used_at   timestamp       null,
    expires_at     timestamp       null,
    created_at     timestamp       null,
    updated_at     timestamp       null,
    constraint personal_access_tokens_token_unique unique (token)
);
-- collate = utf8mb4_unicode_ci;

create index personal_access_tokens_tokenable_type_tokenable_id_index
    on personal_access_tokens (tokenable_type, tokenable_id);

CREATE TABLE IF NOT EXISTS users (
    id                bigserial    not null,
    name              varchar(255) not null,
    email             varchar(255) not null,
    email_verified_at timestamp    null,
    password          varchar(255) not null,
    remember_token    varchar(100) null,
    created_at        timestamp    null,
    updated_at        timestamp    null,
    constraint users_email_unique unique (email)
);
-- collate = utf8mb4_unicode_ci;

INSERT INTO migrations (migration, batch) (
    SELECT '2014_10_12_000000_create_users_table',1 WHERE NOT EXISTS (
		SELECT 1 FROM migrations WHERE migration='2014_10_12_000000_create_users_table' AND batch=1)
);
INSERT INTO migrations (migration, batch) (
    SELECT '2014_10_12_100000_create_password_resets_table',1 WHERE NOT EXISTS (
		SELECT 1 FROM migrations WHERE migration='2014_10_12_100000_create_password_resets_table' AND batch=1)
);
INSERT INTO migrations (migration, batch) (
    SELECT '2019_08_19_000000_create_failed_jobs_table',1 WHERE NOT EXISTS (
		SELECT 1 FROM migrations WHERE migration='2019_08_19_000000_create_failed_jobs_table' AND batch=1)
);
INSERT INTO migrations (migration, batch) (
    SELECT '2019_12_14_000001_create_personal_access_tokens_table','1' WHERE NOT EXISTS (
		SELECT 1 FROM migrations WHERE migration='2019_12_14_000001_create_personal_access_tokens_table' AND batch=1)
);

INSERT INTO users (name, email, email_verified_at, password, remember_token, created_at, updated_at) (
	SELECT 'teste user', 'teste@user.com', null, '$2y$10$bXcKxcdPExJR/29r1rZJk.7S8KKwr8Ri.uuN9TirPvB2TLeWQrliq', null, '2023-03-09 20:34:28', '2023-03-09 20:34:28' WHERE NOT EXISTS (
		SELECT 1 FROM users WHERE email='teste@user.com')
);

-- ########################## 3S ##########################
    -- Role: "3s"
    /*
    DROP ROLE IF EXISTS "3s";
    CREATE ROLE "3s" WITH
      LOGIN
    --   SUPERUSER
      INHERIT
      CREATEDB
      CREATEROLE
      REPLICATION
      CONNECTION LIMIT -1
      ENCRYPTED PASSWORD 'SCRAM-SHA-256$4096:3Jqsy2/uZq6sOWbF0ff0Pg==$cPHoXFvpbnUG1sesgk56le9jTGpBcMemuzkh3sXEA/8=:+D7jh16yPQr/kAw/dccT0Rz52Mgi4JgwD1m0hJKp2Qo=';
    COMMENT ON ROLE "3s" IS 'Usuário padrão do database 3s-ocorrencias.';
    */
    
    -- Role: ocorrencias_user
    -- DROP ROLE IF EXISTS ocorrencias_user;

    CREATE ROLE ocorrencias_user WITH
      LOGIN
      NOSUPERUSER
      INHERIT
      NOCREATEDB
      NOCREATEROLE
      NOREPLICATION;

    -- Role: admindti
    -- DROP ROLE IF EXISTS admindti;

    CREATE ROLE admindti WITH
      LOGIN
      SUPERUSER
      INHERIT
      NOCREATEDB
      NOCREATEROLE
      NOREPLICATION;

    -- Role: cicero_robson
    -- DROP ROLE IF EXISTS cicero_robson;

    CREATE ROLE cicero_robson WITH
      LOGIN
      SUPERUSER
      INHERIT
      CREATEDB
      CREATEROLE
      NOREPLICATION;

    -- Role: luansidney
    -- DROP ROLE IF EXISTS luansidney;

    CREATE ROLE luansidney WITH
      LOGIN
      SUPERUSER
      INHERIT
      CREATEDB
      NOCREATEROLE
      NOREPLICATION;

    -- Role: manoeljr
    -- DROP ROLE IF EXISTS manoeljr;

    CREATE ROLE manoeljr WITH
      LOGIN
      SUPERUSER
      INHERIT
      CREATEDB
      CREATEROLE
      NOREPLICATION;

    -- Role: rafael
    -- DROP ROLE IF EXISTS rafael;

    CREATE ROLE rafael WITH
      LOGIN
      SUPERUSER
      INHERIT
      CREATEDB
      NOCREATEROLE
      NOREPLICATION;

    -- Role: tiago17
    -- DROP ROLE IF EXISTS tiago17;

    CREATE ROLE tiago17 WITH
      LOGIN
      SUPERUSER
      NOINHERIT
      CREATEDB
      CREATEROLE
      NOREPLICATION;