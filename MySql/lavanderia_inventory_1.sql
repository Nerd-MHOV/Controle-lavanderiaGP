create table inventory
(
    id            int auto_increment
        primary key,
    id_product    int       not null,
    id_department int       not null,
    amount        int       not null,
    created_at    timestamp null,
    updated_at    timestamp null
);

INSERT INTO lavanderia.inventory (id, id_product, id_department, amount, created_at, updated_at) VALUES (1, 1, 1, 83, null, null);
INSERT INTO lavanderia.inventory (id, id_product, id_department, amount, created_at, updated_at) VALUES (2, 2, 1, 98, null, null);
INSERT INTO lavanderia.inventory (id, id_product, id_department, amount, created_at, updated_at) VALUES (3, 3, 1, 148, null, null);
INSERT INTO lavanderia.inventory (id, id_product, id_department, amount, created_at, updated_at) VALUES (4, 0, 0, 5, null, null);
