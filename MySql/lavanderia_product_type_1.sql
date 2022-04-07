create table product_type
(
    id           int auto_increment
        primary key,
    product_type varchar(255) not null,
    created_at   timestamp    null,
    updated_at   timestamp    null
);

INSERT INTO lavanderia.product_type (id, product_type, created_at, updated_at) VALUES (1, 'Toalha', null, null);
INSERT INTO lavanderia.product_type (id, product_type, created_at, updated_at) VALUES (2, 'Manta', null, null);
