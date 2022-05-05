create table collaborator
(
    id            int auto_increment
        primary key,
    id_department int          not null,
    id_type       int          not null,
    collaborator  varchar(255) not null,
    cpf           varchar(255) not null,
    created_at    timestamp    null,
    updated_at    timestamp    null
);

INSERT INTO lavanderia.collaborator (id_department, id_type, collaborator, cpf, created_at, updated_at) VALUES (0, 0, 'SETOR', '000.000.000-00', null, null);
INSERT INTO lavanderia.collaborator (id_department, id_type, collaborator, cpf, created_at, updated_at) VALUES (1, 2, 'Matheus Henrique', '480.111.628-02', '2022-04-29 13:59:29', '2022-04-29 13:59:29');
INSERT INTO lavanderia.collaborator (id_department, id_type, collaborator, cpf, created_at, updated_at) VALUES (2, 1, 'Cozinha', '656.020.510-07', '2022-04-29 15:29:33', '2022-04-29 15:29:33');
INSERT INTO lavanderia.collaborator (id_department, id_type, collaborator, cpf, created_at, updated_at) VALUES (3, 1, 'Jardim', '656.020.510-07', '2022-04-29 15:29:41', '2022-04-29 15:29:41');
INSERT INTO lavanderia.collaborator (id_department, id_type, collaborator, cpf, created_at, updated_at) VALUES (4, 1, 'Manutenção', '656.020.510-07', '2022-04-29 15:29:50', '2022-04-29 15:29:50');
INSERT INTO lavanderia.collaborator (id_department, id_type, collaborator, cpf, created_at, updated_at) VALUES (5, 1, 'Recepção', '656.020.510-07', '2022-04-29 15:29:59', '2022-04-29 15:29:59');
INSERT INTO lavanderia.collaborator (id_department, id_type, collaborator, cpf, created_at, updated_at) VALUES (6, 1, 'Portaria', '656.020.510-07', '2022-04-29 15:30:06', '2022-04-29 15:30:06');
INSERT INTO lavanderia.collaborator (id_department, id_type, collaborator, cpf, created_at, updated_at) VALUES (7, 1, 'Governança', '656.020.510-07', '2022-04-29 15:30:13', '2022-04-29 15:30:13');
INSERT INTO lavanderia.collaborator (id_department, id_type, collaborator, cpf, created_at, updated_at) VALUES (8, 1, 'Equipe Salão', '656.020.510-07', '2022-04-29 15:30:21', '2022-04-29 15:30:21');
