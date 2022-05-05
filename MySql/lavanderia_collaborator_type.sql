create table collaborator_type
(
    id         int auto_increment
        primary key,
    type       varchar(255) not null,
    created_at timestamp    null,
    updated_at timestamp    null
);

INSERT INTO lavanderia.collaborator_type (type, created_at, updated_at) VALUES ('Mensalista', null, null);
INSERT INTO lavanderia.collaborator_type (type, created_at, updated_at) VALUES ('Diarista', null, null);
