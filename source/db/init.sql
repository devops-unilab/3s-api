create table failed_jobs (
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

create table migrations (
    id         bigserial   not null,
    migration varchar(255) not null,
    batch     int          not null
);
-- collate = utf8mb4_unicode_ci;

create table password_resets (
    email      varchar(255) not null,
    token      varchar(255) not null,
    created_at timestamp    null
);
-- collate = utf8mb4_unicode_ci;

create index password_resets_email_index on password_resets (email);

create table personal_access_tokens (
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

create table users (
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

insert into migrations (migration, batch)
values  ('2014_10_12_000000_create_users_table', 1),
        ('2014_10_12_100000_create_password_resets_table', 1),
        ('2019_08_19_000000_create_failed_jobs_table', 1),
        ('2019_12_14_000001_create_personal_access_tokens_table', 1);

insert into users (name, email, email_verified_at, password, remember_token, created_at, updated_at)
values  ('teste user', 'teste@user.com', null, '$2y$10$bXcKxcdPExJR/29r1rZJk.7S8KKwr8Ri.uuN9TirPvB2TLeWQrliq', null, '2023-03-09 20:34:28', '2023-03-09 20:34:28'),
        ('guest user', 'guest@user.com', null, 'this-will-not-work', null, '2023-03-09 20:35:25', '2023-03-09 20:35:25');
        