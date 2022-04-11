create table product
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

INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, unitary_value, created_at, updated_at) VALUES (1, 'A', 1, 1, 1, 'Luxo', 'R$ 10,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, unitary_value, created_at, updated_at) VALUES (2, 'A', 1, 1, 1, 'Padrão', 'R$ 20,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, unitary_value, created_at, updated_at) VALUES (3, 'A', 1, 2, 1, 'Pequena', 'R$ 2,00', null, null);
