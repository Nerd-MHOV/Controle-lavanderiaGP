create or replace table collaborator
(
    id            int auto_increment
        primary key,
    id_department int          not null,
    collaborator  varchar(255) not null,
    cpf           varchar(255) not null,
    type          varchar(255) not null,
    created_at    timestamp    null,
    updated_at    timestamp    null
);

