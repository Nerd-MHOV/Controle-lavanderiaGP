create table returns
(
    id              int auto_increment
        primary key,
    id_product      int          not null,
    id_department   int          not null,
    id_collaborator int          not null,
    id_user         int          not null,
    amount          int          not null,
    amountBad       int          null,
    status_in       varchar(255) not null,
    status_out      varchar(255) not null,
    obs_in          varchar(255) null,
    obs_out         varchar(255) null,
    created_at      timestamp    null,
    updated_at      timestamp    null
);

INSERT INTO lavanderia.returns (id_product, id_department, id_collaborator, id_user, amount, amountBad, status_in, status_out, obs_in, obs_out, created_at, updated_at) VALUES (46, 1, 0, 1, 15, 0, 'bom', 'bom', null, '', '2022-05-04 16:59:40', '2022-05-04 16:59:40');
INSERT INTO lavanderia.returns (id_product, id_department, id_collaborator, id_user, amount, amountBad, status_in, status_out, obs_in, obs_out, created_at, updated_at) VALUES (48, 1, 1, 1, 1, 0, 'bom', 'bom', null, '', '2022-05-04 16:59:46', '2022-05-04 16:59:46');
INSERT INTO lavanderia.returns (id_product, id_department, id_collaborator, id_user, amount, amountBad, status_in, status_out, obs_in, obs_out, created_at, updated_at) VALUES (47, 1, 1, 1, 1, 0, 'bom', 'bom', null, '', '2022-05-04 17:05:30', '2022-05-04 17:05:30');
INSERT INTO lavanderia.returns (id_product, id_department, id_collaborator, id_user, amount, amountBad, status_in, status_out, obs_in, obs_out, created_at, updated_at) VALUES (47, 1, 1, 1, 1, 0, 'bom', 'bom', null, '', '2022-05-04 17:22:58', '2022-05-04 17:22:58');
INSERT INTO lavanderia.returns (id_product, id_department, id_collaborator, id_user, amount, amountBad, status_in, status_out, obs_in, obs_out, created_at, updated_at) VALUES (46, 1, 0, 1, 20, 0, 'bom', 'bom', null, '', '2022-05-04 17:23:03', '2022-05-04 17:23:03');
INSERT INTO lavanderia.returns (id_product, id_department, id_collaborator, id_user, amount, amountBad, status_in, status_out, obs_in, obs_out, created_at, updated_at) VALUES (1, 7, 0, 1, 100, 0, 'bom', 'bom', null, '', '2022-05-05 11:54:36', '2022-05-05 11:54:36');
INSERT INTO lavanderia.returns (id_product, id_department, id_collaborator, id_user, amount, amountBad, status_in, status_out, obs_in, obs_out, created_at, updated_at) VALUES (46, 1, 1, 1, 1, 0, 'bom', 'bom', null, '', '2022-05-05 12:03:22', '2022-05-05 12:03:22');
INSERT INTO lavanderia.returns (id_product, id_department, id_collaborator, id_user, amount, amountBad, status_in, status_out, obs_in, obs_out, created_at, updated_at) VALUES (46, 1, 0, 1, 30, 0, 'bom', 'bom', null, '', '2022-05-05 12:03:27', '2022-05-05 12:03:27');
INSERT INTO lavanderia.returns (id_product, id_department, id_collaborator, id_user, amount, amountBad, status_in, status_out, obs_in, obs_out, created_at, updated_at) VALUES (48, 1, 0, 1, 30, 0, 'bom', 'bom', null, '', '2022-05-05 12:03:30', '2022-05-05 12:03:30');
