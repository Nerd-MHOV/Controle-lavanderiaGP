create table department_head
(
    id            int auto_increment
        primary key,
    id_department int          not null,
    name          varchar(255) not null,
    email         varchar(255) not null,
    cel           varchar(255) not null,
    created_at    timestamp    null,
    updated_at    timestamp    null
);

