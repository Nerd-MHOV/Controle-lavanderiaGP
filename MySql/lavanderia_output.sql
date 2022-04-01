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
INSERT INTO lavanderia.output (id, id_product, id_department, id_collaborator, id_user, amount, status, obs, created_at, updated_at) VALUES (36, 3, 1, 1, 2, 1, 'bom', null, '2022-04-01 21:19:36', '2022-04-01 21:19:36');
INSERT INTO lavanderia.output (id, id_product, id_department, id_collaborator, id_user, amount, status, obs, created_at, updated_at) VALUES (37, 1, 1, 1, 2, 1, 'bom', null, '2022-04-01 21:19:36', '2022-04-01 21:19:36');
INSERT INTO lavanderia.output (id, id_product, id_department, id_collaborator, id_user, amount, status, obs, created_at, updated_at) VALUES (38, 2, 1, 1, 2, 1, 'bom', null, '2022-04-01 21:19:36', '2022-04-01 21:19:36');
