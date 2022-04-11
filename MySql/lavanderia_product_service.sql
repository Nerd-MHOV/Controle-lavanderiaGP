create table product_service
(
    id         int auto_increment
        primary key,
    service    varchar(255) not null,
    created_at timestamp    null,
    updated_at timestamp    null
);

INSERT INTO lavanderia.product_service (id, service, created_at, updated_at) VALUES (1, 'Geral', null, null);
INSERT INTO lavanderia.product_service (id, service, created_at, updated_at) VALUES (2, 'Hotel Fazenda', null, null);
INSERT INTO lavanderia.product_service (id, service, created_at, updated_at) VALUES (3, 'Resort', null, null);
