create table output
(
    id              int auto_increment
        primary key,
    id_product      int          not null,
    id_department   int          not null,
    id_collaborator int          not null,
    id_user         int          not null,
    amount          int          not null,
    status          varchar(255) not null,
    obs             varchar(255) null,
    created_at      timestamp    null,
    updated_at      timestamp    null
);

INSERT INTO lavanderia.output (id, id_product, id_department, id_collaborator, id_user, amount, status, obs, created_at, updated_at) VALUES (35, 1, 1, 0, 2, 10, 'bom', null, '2022-04-01 21:19:09', '2022-04-01 21:19:09');
INSERT INTO lavanderia.output (id, id_product, id_department, id_collaborator, id_user, amount, status, obs, created_at, updated_at) VALUES (39, 1, 1, 1, 2, 1, 'bom', null, '2022-04-01 17:18:16', '2022-04-01 17:18:16');
INSERT INTO lavanderia.output (id, id_product, id_department, id_collaborator, id_user, amount, status, obs, created_at, updated_at) VALUES (40, 1, 1, 1, 2, 1, 'bom', null, '2022-04-06 15:49:52', '2022-04-06 15:49:52');
INSERT INTO lavanderia.output (id, id_product, id_department, id_collaborator, id_user, amount, status, obs, created_at, updated_at) VALUES (41, 1, 1, 0, 2, 1, 'bom', null, '2022-04-06 15:51:24', '2022-04-06 15:51:24');
INSERT INTO lavanderia.output (id, id_product, id_department, id_collaborator, id_user, amount, status, obs, created_at, updated_at) VALUES (42, 1, 1, 1, 2, 1, 'bom', null, '2022-04-08 18:19:41', '2022-04-08 18:19:41');
INSERT INTO lavanderia.output (id, id_product, id_department, id_collaborator, id_user, amount, status, obs, created_at, updated_at) VALUES (43, 1, 1, 1, 2, 1, 'ruim', 'ta com defeito ai o', '2022-04-11 11:15:11', '2022-04-11 11:15:11');
INSERT INTO lavanderia.output (id, id_product, id_department, id_collaborator, id_user, amount, status, obs, created_at, updated_at) VALUES (44, 1, 1, 0, 2, 50, 'bom', null, '2022-04-11 11:29:45', '2022-04-11 11:29:45');
