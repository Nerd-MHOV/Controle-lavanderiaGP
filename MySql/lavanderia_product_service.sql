create table product_service
(
    id         int auto_increment
        primary key,
    service    varchar(255) not null,
    created_at timestamp    null,
    updated_at timestamp    null
);

INSERT INTO lavanderia.product_service (service, created_at, updated_at) VALUES ('Brotas Eco Hotel Fazenda', null, null);
INSERT INTO lavanderia.product_service (service, created_at, updated_at) VALUES ('Brotas Eco Resort', null, null);
INSERT INTO lavanderia.product_service (service, created_at, updated_at) VALUES ('CEU', null, null);
INSERT INTO lavanderia.product_service (service, created_at, updated_at) VALUES ('Escolas/Temporadas', null, null);
INSERT INTO lavanderia.product_service (service, created_at, updated_at) VALUES ('Geral', null, null);
INSERT INTO lavanderia.product_service (service, created_at, updated_at) VALUES ('Peraltas', null, null);
