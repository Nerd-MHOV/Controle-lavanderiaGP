create table output
(
    id              int auto_increment
        primary key,
    id_product      int          not null,
    id_department   int          not null,
    id_collaborator int          not null,
    id_user         int          not null,
    amount          int          not null,
    status          varchar(255) not null,
    obs             varchar(255) null,
    created_at      timestamp    null,
    updated_at      timestamp    null
);

