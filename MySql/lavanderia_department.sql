create table department
(
    id         int auto_increment
        primary key,
    department varchar(255) not null,
    created_at timestamp    null,
    updated_at timestamp    null
);

INSERT INTO lavanderia.department (department, created_at, updated_at) VALUES ('Monitoria', null, null);
INSERT INTO lavanderia.department (department, created_at, updated_at) VALUES ('Cozinha', null, null);
INSERT INTO lavanderia.department (department, created_at, updated_at) VALUES ('Jardim', null, null);
INSERT INTO lavanderia.department (department, created_at, updated_at) VALUES ('Manutenção', null, null);
INSERT INTO lavanderia.department (department, created_at, updated_at) VALUES ('Recepção', null, null);
INSERT INTO lavanderia.department (department, created_at, updated_at) VALUES ('Portaria', null, null);
INSERT INTO lavanderia.department (department, created_at, updated_at) VALUES ('Governança', null, null);
INSERT INTO lavanderia.department (department, created_at, updated_at) VALUES ('Equipe Salão', null, null);
