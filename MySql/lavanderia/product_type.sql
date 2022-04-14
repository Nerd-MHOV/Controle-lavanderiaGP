create or replace table product_type
(
    id           int auto_increment
        primary key,
    product_type varchar(255) not null,
    created_at   timestamp    null,
    updated_at   timestamp    null
);

