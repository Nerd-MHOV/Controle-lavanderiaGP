create or replace table product_service
(
    id         int auto_increment
        primary key,
    service    varchar(255) not null,
    created_at timestamp    null,
    updated_at timestamp    null
);

