create table input
(
    id            int auto_increment
        primary key,
    id_product    int       not null,
    id_department int       not null,
    amount        int       not null,
    created_at    timestamp null,
    updated_at    timestamp null
);

INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (1, 1, 1, 100, '2022-03-19 11:21:38', null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (2, 2, 1, 100, '2022-03-19 11:21:38', null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (3, 3, 1, 150, '2022-03-19 11:21:38', null);
