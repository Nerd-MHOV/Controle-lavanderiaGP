create table collaborator
(
    id            int auto_increment
        primary key,
    id_department int          not null,
    collaborator  varchar(255) not null,
    cpf           varchar(255) not null,
    type          varchar(255) not null,
    created_at    timestamp    null,
    updated_at    timestamp    null
);

INSERT INTO lavanderia.collaborator (id, id_department, collaborator, cpf, type, created_at, updated_at) VALUES (0, 0, 'SETOR', '000.000.000-00', 'SETOR', null, null);
INSERT INTO lavanderia.collaborator (id, id_department, collaborator, cpf, type, created_at, updated_at) VALUES (1, 1, 'Matheus Henrique de Oliveira Viana', '480.111.628-02', 'mesalista', null, null);
