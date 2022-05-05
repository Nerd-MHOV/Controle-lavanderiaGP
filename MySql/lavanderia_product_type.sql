create table product_type
(
    id           int auto_increment
        primary key,
    product_type varchar(255) not null,
    created_at   timestamp    null,
    updated_at   timestamp    null
);

INSERT INTO lavanderia.product_type (product_type, created_at, updated_at) VALUES ('Camiseta', null, null);
INSERT INTO lavanderia.product_type (product_type, created_at, updated_at) VALUES ('Camiseta Dry fit', null, null);
INSERT INTO lavanderia.product_type (product_type, created_at, updated_at) VALUES ('Capa de Junção', null, null);
INSERT INTO lavanderia.product_type (product_type, created_at, updated_at) VALUES ('Edredom', null, null);
INSERT INTO lavanderia.product_type (product_type, created_at, updated_at) VALUES ('Fronha', null, null);
INSERT INTO lavanderia.product_type (product_type, created_at, updated_at) VALUES ('Jaquetas', null, null);
INSERT INTO lavanderia.product_type (product_type, created_at, updated_at) VALUES ('Lençol', null, null);
INSERT INTO lavanderia.product_type (product_type, created_at, updated_at) VALUES ('Manta', null, null);
INSERT INTO lavanderia.product_type (product_type, created_at, updated_at) VALUES ('Moleton', null, null);
INSERT INTO lavanderia.product_type (product_type, created_at, updated_at) VALUES ('Piso', null, null);
INSERT INTO lavanderia.product_type (product_type, created_at, updated_at) VALUES ('Protetor de Xixi', null, null);
INSERT INTO lavanderia.product_type (product_type, created_at, updated_at) VALUES ('Saia da Cama', null, null);
INSERT INTO lavanderia.product_type (product_type, created_at, updated_at) VALUES ('Toalha de Banho', null, null);
INSERT INTO lavanderia.product_type (product_type, created_at, updated_at) VALUES ('Toalha de mesa', null, null);
INSERT INTO lavanderia.product_type (product_type, created_at, updated_at) VALUES ('Travesseiro', null, null);
