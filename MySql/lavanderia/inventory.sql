create or replace table inventory
(
    id            int auto_increment
        primary key,
    id_product    int       not null,
    id_department int       not null,
    amount        int       not null,
    created_at    timestamp null,
    updated_at    timestamp null
);

