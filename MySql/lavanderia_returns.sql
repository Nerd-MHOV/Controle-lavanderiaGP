create table returns
(
    id              int auto_increment
        primary key,
    id_product      int          not null,
    id_department   int          not null,
    id_collaborator int          not null,
    id_user         int          not null,
    amount          int          not null,
    status_in       varchar(255) not null,
    status_out      varchar(255) not null,
    obs_in          varchar(255) null,
    obs_out         varchar(255) null,
    created_at      timestamp    null,
    updated_at      timestamp    null
);

INSERT INTO lavanderia.returns (id, id_product, id_department, id_collaborator, id_user, amount, status_in, status_out, obs_in, obs_out, created_at, updated_at) VALUES (1, 1, 0, 0, 2, 1, 'ruim', 'NULL', null, null, '2022-04-11 18:37:24', '2022-04-11 18:37:24');
INSERT INTO lavanderia.returns (id, id_product, id_department, id_collaborator, id_user, amount, status_in, status_out, obs_in, obs_out, created_at, updated_at) VALUES (2, 1, 0, 0, 2, 1, 'bom', 'NULL', null, null, '2022-04-11 18:37:57', '2022-04-11 18:37:57');
INSERT INTO lavanderia.returns (id, id_product, id_department, id_collaborator, id_user, amount, status_in, status_out, obs_in, obs_out, created_at, updated_at) VALUES (3, 1, 0, 0, 2, 1, 'bom', 'ruim', null, null, '2022-04-11 18:40:24', '2022-04-11 18:40:24');
INSERT INTO lavanderia.returns (id, id_product, id_department, id_collaborator, id_user, amount, status_in, status_out, obs_in, obs_out, created_at, updated_at) VALUES (4, 1, 0, 0, 2, 1, 'bom', 'ruim', null, 'NULL', '2022-04-11 18:41:06', '2022-04-11 18:41:06');
INSERT INTO lavanderia.returns (id, id_product, id_department, id_collaborator, id_user, amount, status_in, status_out, obs_in, obs_out, created_at, updated_at) VALUES (5, 1, 0, 0, 2, 1, 'bom', 'ruim', null, '', '2022-04-11 18:42:02', '2022-04-11 18:42:02');
INSERT INTO lavanderia.returns (id, id_product, id_department, id_collaborator, id_user, amount, status_in, status_out, obs_in, obs_out, created_at, updated_at) VALUES (6, 1, 0, 0, 2, 1, 'bom', 'ruim', null, 'teste DB', '2022-04-11 18:42:50', '2022-04-11 18:42:50');
INSERT INTO lavanderia.returns (id, id_product, id_department, id_collaborator, id_user, amount, status_in, status_out, obs_in, obs_out, created_at, updated_at) VALUES (7, 1, 1, 1, 2, 1, 'bom', 'ruim', null, 'Teste de DB
', '2022-04-11 18:48:30', '2022-04-11 18:48:30');
