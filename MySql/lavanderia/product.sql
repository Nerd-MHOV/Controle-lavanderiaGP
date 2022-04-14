create or replace table product
(
    id                 int auto_increment
        primary key,
    status             char default 'A' not null,
    id_department      int              not null,
    id_product_type    int              not null,
    id_product_service int              not null,
    product            varchar(25)      not null,
    unitary_value      varchar(255)     not null,
    created_at         timestamp        null,
    updated_at         timestamp        null
);

