create table department
(
    id         int auto_increment
        primary key,
    department varchar(255) not null,
    created_at timestamp    null,
    update_at  timestamp    null
);

INSERT INTO lavanderia.department (id, department, created_at, update_at) VALUES (1, 'Monitoria', null, null);
INSERT INTO lavanderia.department (id, department, created_at, update_at) VALUES (2, 'Cozinha', null, null);
INSERT INTO lavanderia.department (id, department, created_at, update_at) VALUES (3, 'Jardim', null, null);
INSERT INTO lavanderia.department (id, department, created_at, update_at) VALUES (4, 'Manutenção', null, null);
INSERT INTO lavanderia.department (id, department, created_at, update_at) VALUES (5, 'Recepção', null, null);
INSERT INTO lavanderia.department (id, department, created_at, update_at) VALUES (6, 'Portaria', null, null);
