create table product
(
    id                 int auto_increment
        primary key,
    status             char default 'A' not null,
    id_department      int              not null,
    id_product_type    int              not null,
    id_product_service int              not null,
    product            varchar(25)      not null,
    size               varchar(255)     not null,
    unitary_value      varchar(255)     not null,
    created_at         timestamp        null,
    updated_at         timestamp        null
);

INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 7, 13, 2, 'Lisa/Marrom', 'Unico', 'R$ 70,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 7, 13, 2, 'Bordada/Marrom', 'Unico', 'R$ 70,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 7, 13, 1, 'Bordada/Marrom', 'Unico', 'R$ 70,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 7, 13, 2, 'Lisa/Branca', 'Unico', 'R$ 70,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 7, 13, 1, 'Lua de mel/Branca', 'Unico', 'R$ 100,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 7, 13, 1, 'Bordada/Amarela', 'Unico', 'R$ 70,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 7, 13, 2, 'Bordada/Amarela', 'Unico', 'R$ 70,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 7, 10, 2, 'Liso/Marrom', 'Unico', 'R$ 25,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 7, 10, 2, 'Bordado/Marrom', 'Unico', 'R$ 25,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 7, 10, 1, 'Liso/Marrom', 'Unico', 'R$ 25,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 7, 10, 2, 'Branco', 'Unico', 'R$ 25,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 7, 7, 4, 'Cama Solteiro/Peraltas', 'Unico', 'R$ 100,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 7, 7, 1, 'Berço', 'Unico', 'R$ 100,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 7, 7, 1, 'Cama Casal/Marrom', 'Unico', 'R$ 150,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 7, 7, 1, 'Cama Solteiro/Marrom', 'Unico', 'R$ 100,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 7, 5, 5, 'Branca', 'Unico', 'R$ 50,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 7, 5, 1, 'Marrom', 'Unico', 'R$ 50,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 7, 8, 1, 'Pequena', 'Unico', 'R$ 150,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 7, 8, 4, 'Cama Solteiro', 'Unico', 'R$ 100,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 7, 8, 1, 'Cama Casal', 'Unico', 'R$ 150,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 7, 4, 5, 'Geral', 'Unico', 'R$ 250,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 7, 12, 1, 'Cama Solteiro', 'Unico', 'R$ 50,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 7, 12, 1, 'Cama Casal', 'Unico', 'R$ 75,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 7, 3, 1, 'Cama Casal', 'Unico', 'R$ 750,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 7, 11, 5, 'Criança ', 'Unico', 'R$ 150,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 7, 15, 5, 'Geral', 'Unico', 'R$ 120,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 7, 15, 5, 'Berço', 'Unico', 'R$ 120,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 8, 14, 3, 'Redonda/Branca', 'Unico', 'R$ 100,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 8, 14, 5, 'Redonda/Verde/Xadrez', 'Unico', 'R$ 50,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 8, 14, 5, 'Redonda/Lisa/Branca', 'Unico', 'R$ 50,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 8, 14, 5, 'Redonda/Dourada', 'Unico', 'R$ 50,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 8, 14, 5, 'Redonda/Verde', 'Unico', 'R$ 50,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 8, 14, 5, 'Redonda/Preta', 'Unico', 'R$ 50,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 8, 14, 5, 'Redonda/Cinza/Florida', 'Unico', 'R$ 50,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 8, 14, 5, 'Redonda/Branca/Flor azul', 'Unico', 'R$ 50,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 8, 14, 5, 'Redonda/Branca/Flor Rosa', 'Unico', 'R$ 50,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 8, 14, 5, 'Redonda/Rosa Florida', 'Unico', 'R$ 50,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 8, 14, 5, 'Redonda/Preta/Seda', 'Unico', 'R$ 75,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 8, 14, 5, 'Redonda/Branca/Cetim/Lisa', 'Unico', 'R$ 75,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 8, 14, 5, 'Redonda/Branca Gelo/Seda', 'Unico', 'R$ 75,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 8, 14, 5, 'Redonda/Creme/Cetim/Flori', 'Unico', 'R$ 75,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 8, 14, 5, 'Redonda/Amarela/Renda', 'Unico', 'R$ 75,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 8, 14, 5, 'Redonda/Verde/Seda/Lisa', 'Unico', 'R$ 75,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 8, 14, 5, 'Redonda/Verde claro/Lisa', 'Unico', 'R$ 50,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 8, 14, 5, 'Redonda/Vermelha/Flor azu', 'Unico', 'R$ 50,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 1, 1, 1, 'Verde', 'P', 'R$ 50,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 1, 1, 1, 'Verde', 'M', 'R$ 50,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 1, 1, 1, 'Verde', 'G', 'R$ 50,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 1, 1, 1, 'Verde', 'GG', 'R$ 50,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 1, 1, 1, 'Verde', 'XG', 'R$ 50,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 1, 1, 6, 'Amarela', 'P', 'R$ 50,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 1, 1, 6, 'Amarela', 'M', 'R$ 50,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 1, 1, 6, 'Amarela', 'G', 'R$ 50,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 1, 1, 6, 'Amarela', 'GG', 'R$ 50,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 1, 1, 6, 'Amarela', 'XG', 'R$ 50,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 1, 2, 6, 'Amarela', 'XG', 'R$ 60,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 1, 2, 6, 'Amarela', 'GG', 'R$ 60,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 1, 2, 6, 'Amarela', 'G', 'R$ 60,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 1, 2, 6, 'Amarela', 'M', 'R$ 60,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 1, 2, 6, 'Amarela', 'P ', 'R$ 60,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 1, 9, 6, 'Amarela', 'GG', 'R$ 100,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 1, 9, 6, 'Amarela', 'M', 'R$ 100,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 1, 9, 6, 'Amarela', 'P', 'R$ 100,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 1, 9, 1, 'Verde', 'GG', 'R$ 100,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 1, 9, 1, 'Verde', 'G', 'R$ 100,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 1, 9, 1, 'Verde', 'M', 'R$ 100,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 1, 6, 1, 'Verdes', 'M', 'R$ 100,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 1, 6, 1, 'Verdes', 'P', 'R$ 100,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 1, 6, 6, 'Amarela', 'G 2', 'R$ 100,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 1, 6, 6, 'Amarela', 'GG', 'R$ 100,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 1, 6, 6, 'Amarela', 'G', 'R$ 100,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 1, 6, 6, 'Amarela', 'M', 'R$ 100,00', null, null);
INSERT INTO lavanderia.product (status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES ('A', 1, 6, 6, 'Amarela', 'P', 'R$ 100,00', null, null);
