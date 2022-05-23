create table collaborator
(
    id            int auto_increment
        primary key,
    id_department int                                     not null,
    id_type       int                                     not null,
    collaborator  varchar(255) collate utf8mb4_general_ci not null,
    cpf           varchar(255) collate utf8mb4_general_ci not null,
    created_at    timestamp                               null,
    updated_at    timestamp                               null
)
    charset = utf8mb3
    auto_increment = 11;

create table collaborator_type
(
    id         int auto_increment
        primary key,
    type       varchar(255) charset utf8mb4 not null,
    created_at timestamp                    null,
    updated_at timestamp                    null
)
    charset = utf8mb3
    auto_increment = 3;

create table department
(
    id         int auto_increment
        primary key,
    department varchar(255) charset utf8mb4 not null,
    created_at timestamp                    null,
    updated_at timestamp                    null
)
    charset = utf8mb3
    auto_increment = 9;

create table department_head
(
    id            int auto_increment
        primary key,
    id_department int                          not null,
    first_name    varchar(255) charset utf8mb4 not null,
    last_name     varchar(255) charset utf8mb4 not null,
    email         varchar(255) charset utf8mb4 not null,
    cel           varchar(255) charset utf8mb4 not null,
    created_at    timestamp                    null,
    updated_at    timestamp                    null
)
    charset = utf8mb3;

create table input
(
    id            int auto_increment
        primary key,
    id_product    int       not null,
    id_department int       not null,
    amount        int       not null,
    created_at    timestamp null,
    updated_at    timestamp null
)
    charset = utf8mb3
    auto_increment = 108;

create definer = root@localhost trigger TRG_EntradaProduto_AD
    after delete
on input
    for each row
BEGIN
CALL SP_AtualizaEstoque (old.id_product, old.amount * -1, old.id_department);
END;

create definer = root@localhost trigger TRG_EntradaProduto_AI
    after insert
    on input
    for each row
BEGIN
CALL SP_AtualizaEstoque (new.id_product, new.amount, new.id_department);
END;

create definer = root@localhost trigger TRG_EntradaProduto_AU
    after update
                     on input
                     for each row
BEGIN
CALL SP_AtualizaEstoque (new.id_product, new.amount - old.amount, new.id_department);
END;

create table inventory
(
    id            int auto_increment
        primary key,
    id_product    int       not null,
    id_department int       not null,
    amount        int       not null,
    created_at    timestamp null,
    updated_at    timestamp null
)
    charset = utf8mb3
    auto_increment = 108;

create table output
(
    id              int auto_increment
        primary key,
    id_product      int                          not null,
    id_department   int                          not null,
    id_collaborator int                          not null,
    id_user         int                          not null,
    amount          int                          not null,
    status          varchar(255) charset utf8mb4 not null,
    obs             varchar(255) charset utf8mb4 null,
    created_at      timestamp                    null,
    updated_at      timestamp                    null
)
    charset = utf8mb3
    auto_increment = 11;

create definer = root@localhost trigger TRG_SaidaProduto_AD
    after delete
on output
    for each row
BEGIN
CALL SP_AtualizaEstoque (old.id_product, old.amount, old.id_department);
END;

create definer = root@localhost trigger TRG_SaidaProduto_AI
    after insert
    on output
    for each row
BEGIN
CALL SP_AtualizaEstoque (new.id_product, new.amount * -1, new.id_department);
END;

create definer = root@localhost trigger TRG_SaidaProduto_AU
    after update
                     on output
                     for each row
BEGIN
CALL SP_AtualizaEstoque (new.id_product, old.amount - new.amount, new.id_department);
END;

create table product
(
    id                 int auto_increment
        primary key,
    status             char charset utf8mb4 default 'A' not null,
    id_department      int                              not null,
    id_product_type    int                              not null,
    id_product_service int                              not null,
    product            varchar(25) charset utf8mb4      not null,
    size               varchar(255) charset utf8mb4     not null,
    unitary_value      varchar(255) charset utf8mb4     not null,
    created_at         timestamp                        null,
    updated_at         timestamp                        null
)
    charset = utf8mb3
    auto_increment = 108;

create table product_service
(
    id         int auto_increment
        primary key,
    service    varchar(255) charset utf8mb4 not null,
    created_at timestamp                    null,
    updated_at timestamp                    null
)
    charset = utf8mb3
    auto_increment = 7;

create table product_type
(
    id           int auto_increment
        primary key,
    product_type varchar(255) charset utf8mb4 not null,
    created_at   timestamp                    null,
    updated_at   timestamp                    null
)
    charset = utf8mb3
    auto_increment = 31;

create table returns
(
    id              int auto_increment
        primary key,
    id_product      int                          not null,
    id_department   int                          not null,
    id_collaborator int                          not null,
    id_user         int                          not null,
    amount          int                          not null,
    amount_bad      int                          null,
    status_in       varchar(255) charset utf8mb4 not null,
    status_out      varchar(255) charset utf8mb4 not null,
    obs_in          varchar(255) charset utf8mb4 null,
    obs_out         varchar(255) charset utf8mb4 null,
    date_in         datetime                     not null on update CURRENT_TIMESTAMP,
    date_out        datetime                     not null,
    created_at      timestamp                    null,
    updated_at      timestamp                    null,
    deleted_at      timestamp                    null
)
    charset = utf8mb3
    auto_increment = 10;

create table users
(
    id         int auto_increment
        primary key,
    first_name varchar(255) charset utf8mb4 not null,
    last_name  varchar(255) charset utf8mb4 not null,
    email      varchar(255) charset utf8mb4 not null,
    user       varchar(255) charset utf8mb4 not null,
    passwd     varchar(255) charset utf8mb4 not null,
    level      int default 1                null,
    photo      varchar(255) charset utf8mb4 null,
    forget     varchar(255) charset utf8mb4 null,
    created_at timestamp                    null,
    updated_at timestamp                    null
)
    charset = utf8mb3
    auto_increment = 3;

create
definer = root@localhost procedure SP_AtualizaEstoque(IN id_prod int, IN input_amount int, IN id_depart int)
BEGIN
    declare counter int(11);

SELECT count(*) into counter FROM inventory WHERE id_product = id_prod;

IF counter > 0 THEN
UPDATE inventory SET amount=amount + input_amount
WHERE id_product = id_prod;
ELSE
        INSERT INTO inventory (id_product, amount, id_department) values (id_prod, input_amount, id_depart);
END IF;
END;



INSERT INTO lavanderia.collaborator (id, id_department, id_type, collaborator, cpf, created_at, updated_at) VALUES (0, 0, 0, 'SETOR', '000.000.000-00', null, null);
INSERT INTO lavanderia.collaborator (id, id_department, id_type, collaborator, cpf, created_at, updated_at) VALUES (10, 7, 1, 'Yam Teste', '455.463.528-76', '2022-05-10 15:48:40.0', '2022-05-10 15:48:40.0');
INSERT INTO lavanderia.collaborator_type (id, type, created_at, updated_at) VALUES (1, 'Mensalista', null, null);
INSERT INTO lavanderia.collaborator_type (id, type, created_at, updated_at) VALUES (2, 'Diarista', null, null);
INSERT INTO lavanderia.department (id, department, created_at, updated_at) VALUES (1, 'Monitoria', null, null);
INSERT INTO lavanderia.department (id, department, created_at, updated_at) VALUES (2, 'Cozinha', null, null);
INSERT INTO lavanderia.department (id, department, created_at, updated_at) VALUES (3, 'Jardim', null, null);
INSERT INTO lavanderia.department (id, department, created_at, updated_at) VALUES (4, 'Manutenção', null, null);
INSERT INTO lavanderia.department (id, department, created_at, updated_at) VALUES (5, 'Recepção', null, null);
INSERT INTO lavanderia.department (id, department, created_at, updated_at) VALUES (6, 'Portaria', null, null);
INSERT INTO lavanderia.department (id, department, created_at, updated_at) VALUES (7, 'Governança', null, null);
INSERT INTO lavanderia.department (id, department, created_at, updated_at) VALUES (8, 'Equipe Salão', null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (1, 1, 7, 105, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (2, 2, 7, 47, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (3, 3, 7, 118, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (4, 4, 7, 29, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (5, 5, 7, 16, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (6, 6, 7, 150, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (7, 7, 7, 75, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (8, 8, 7, 62, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (9, 9, 7, 47, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (10, 10, 7, 108, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (11, 11, 7, 73, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (12, 12, 7, 500, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (13, 13, 7, 8, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (14, 14, 7, 17, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (15, 15, 7, 10, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (16, 16, 7, 294, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (17, 17, 7, 21, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (18, 18, 7, 5, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (19, 19, 7, 131, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (20, 20, 7, 36, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (21, 21, 7, 13, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (22, 22, 7, 105, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (23, 23, 7, 61, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (24, 24, 7, 14, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (25, 25, 7, 65, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (26, 26, 7, 516, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (27, 27, 7, 5, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (28, 28, 8, 51, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (29, 29, 8, 17, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (30, 30, 8, 24, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (31, 31, 8, 30, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (32, 32, 8, 24, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (33, 33, 8, 27, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (34, 34, 8, 16, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (35, 35, 8, 29, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (36, 36, 8, 20, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (37, 37, 8, 30, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (38, 38, 8, 5, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (39, 39, 8, 30, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (40, 40, 8, 40, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (41, 41, 8, 14, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (42, 42, 8, 20, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (43, 43, 8, 16, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (44, 44, 8, 28, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (45, 45, 8, 2, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (46, 46, 1, 41, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (47, 47, 1, 34, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (48, 48, 1, 56, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (49, 49, 1, 57, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (50, 50, 1, 11, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (51, 51, 1, 31, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (52, 52, 1, 30, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (53, 53, 1, 31, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (54, 54, 1, 33, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (55, 55, 1, 5, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (56, 56, 1, 1, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (57, 57, 1, 1, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (58, 58, 1, 2, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (59, 59, 1, 4, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (60, 60, 1, 2, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (61, 61, 1, 16, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (62, 62, 1, 10, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (63, 63, 1, 5, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (64, 64, 1, 7, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (65, 65, 1, 5, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (66, 66, 1, 0, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (67, 67, 1, 1, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (68, 68, 1, 2, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (69, 69, 1, 8, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (70, 70, 1, 8, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (71, 71, 1, 29, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (72, 72, 1, 29, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (73, 73, 1, 6, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (74, 74, 8, 6, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (75, 75, 8, 1, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (76, 76, 8, 3, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (77, 77, 2, 7, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (78, 78, 2, 37, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (79, 79, 2, 36, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (80, 80, 2, 41, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (81, 81, 2, 3, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (82, 82, 2, 1, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (83, 83, 2, 3, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (84, 84, 2, 2, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (85, 85, 2, 5, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (86, 86, 2, 4, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (87, 87, 2, 8, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (88, 88, 2, 4, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (89, 89, 2, 4, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (90, 90, 2, 2, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (91, 91, 2, 4, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (92, 92, 2, 4, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (93, 93, 2, 2, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (94, 94, 2, 2, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (95, 95, 2, 6, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (96, 96, 2, 9, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (97, 97, 2, 10, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (98, 98, 2, 22, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (99, 99, 2, 6, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (100, 100, 7, 5, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (101, 101, 7, 10, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (102, 102, 7, 10, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (103, 103, 7, 10, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (104, 104, 7, 10, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (105, 105, 7, 10, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (106, 106, 7, 10, null, null);
INSERT INTO lavanderia.input (id, id_product, id_department, amount, created_at, updated_at) VALUES (107, 107, 3, 6, null, null);

INSERT INTO lavanderia.product_service (id, service, created_at, updated_at) VALUES (1, 'Brotas Eco Hotel Fazenda', null, null);
INSERT INTO lavanderia.product_service (id, service, created_at, updated_at) VALUES (2, 'Brotas Eco Resort', null, null);
INSERT INTO lavanderia.product_service (id, service, created_at, updated_at) VALUES (3, 'CEU', null, null);
INSERT INTO lavanderia.product_service (id, service, created_at, updated_at) VALUES (4, 'Escolas/Temporadas', null, null);
INSERT INTO lavanderia.product_service (id, service, created_at, updated_at) VALUES (5, 'Geral', null, null);
INSERT INTO lavanderia.product_service (id, service, created_at, updated_at) VALUES (6, 'Peraltas', null, null);
INSERT INTO lavanderia.product_type (id, product_type, created_at, updated_at) VALUES (1, 'Camiseta', null, null);
INSERT INTO lavanderia.product_type (id, product_type, created_at, updated_at) VALUES (2, 'Camiseta Dry fit', null, null);
INSERT INTO lavanderia.product_type (id, product_type, created_at, updated_at) VALUES (3, 'Capa de Junção', null, null);
INSERT INTO lavanderia.product_type (id, product_type, created_at, updated_at) VALUES (4, 'Edredom', null, null);
INSERT INTO lavanderia.product_type (id, product_type, created_at, updated_at) VALUES (5, 'Fronha', null, null);
INSERT INTO lavanderia.product_type (id, product_type, created_at, updated_at) VALUES (6, 'Jaquetas', null, null);
INSERT INTO lavanderia.product_type (id, product_type, created_at, updated_at) VALUES (7, 'Lençol', null, null);
INSERT INTO lavanderia.product_type (id, product_type, created_at, updated_at) VALUES (8, 'Manta', null, null);
INSERT INTO lavanderia.product_type (id, product_type, created_at, updated_at) VALUES (9, 'Moleton', null, null);
INSERT INTO lavanderia.product_type (id, product_type, created_at, updated_at) VALUES (10, 'Piso', null, null);
INSERT INTO lavanderia.product_type (id, product_type, created_at, updated_at) VALUES (11, 'Protetor de Xixi', null, null);
INSERT INTO lavanderia.product_type (id, product_type, created_at, updated_at) VALUES (12, 'Saia da Cama', null, null);
INSERT INTO lavanderia.product_type (id, product_type, created_at, updated_at) VALUES (13, 'Toalha de Banho', null, null);
INSERT INTO lavanderia.product_type (id, product_type, created_at, updated_at) VALUES (14, 'Toalha de mesa', null, null);
INSERT INTO lavanderia.product_type (id, product_type, created_at, updated_at) VALUES (15, 'Travesseiro', null, null);
INSERT INTO lavanderia.product_type (id, product_type, created_at, updated_at) VALUES (23, 'Camisa Polo', null, null);
INSERT INTO lavanderia.product_type (id, product_type, created_at, updated_at) VALUES (24, 'Calça', null, null);
INSERT INTO lavanderia.product_type (id, product_type, created_at, updated_at) VALUES (25, 'Doma', null, null);
INSERT INTO lavanderia.product_type (id, product_type, created_at, updated_at) VALUES (26, 'Avental Plástico', null, null);
INSERT INTO lavanderia.product_type (id, product_type, created_at, updated_at) VALUES (27, 'Avental de Corpo', null, null);
INSERT INTO lavanderia.product_type (id, product_type, created_at, updated_at) VALUES (28, 'Avental Meio Corpo', null, null);
INSERT INTO lavanderia.product_type (id, product_type, created_at, updated_at) VALUES (29, 'Jaleco Camareira', null, null);
INSERT INTO lavanderia.product_type (id, product_type, created_at, updated_at) VALUES (30, 'Calça Camareira', null, null);
INSERT INTO lavanderia.users (id, first_name, last_name, email, user, passwd, level, photo, forget, created_at, updated_at) VALUES (1, 'Matheus', 'Henrique', 'matheus.henrique4245@gmail.com', 'admin', '$2y$10$IqaAeuYofujbeuX5jCBVIOg/6lJ.9U5aA.7J8zH8vBKOYs0hs5fbW', 4, null, null, '2022-04-29 09:27:05.0', '2022-04-29 09:27:05.0');
INSERT INTO lavanderia.users (id, first_name, last_name, email, user, passwd, level, photo, forget, created_at, updated_at) VALUES (2, 'Teste', 'Teste', 'teste@teste.com.br', 'teste', '$2y$10$Q3OFnouIULCLFR4KsKyEQ.xQeLTKzYgnltzAEbAH44X3.PjUz2vJa', 1, null, null, '2022-04-29 12:24:02.0', '2022-04-29 12:24:02.0');
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (1, 'A', 7, 13, 2, 'Lisa/Marrom', 'Unico', 'R$ 70,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (2, 'A', 7, 13, 2, 'Bordada/Marrom', 'Unico', 'R$ 70,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (3, 'A', 7, 13, 1, 'Bordada/Marrom', 'Unico', 'R$ 70,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (4, 'A', 7, 13, 2, 'Lisa/Branca', 'Unico', 'R$ 70,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (5, 'A', 7, 13, 1, 'Lua de mel/Branca', 'Unico', 'R$ 100,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (6, 'A', 7, 13, 1, 'Bordada/Amarela', 'Unico', 'R$ 70,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (7, 'A', 7, 13, 2, 'Bordada/Amarela', 'Unico', 'R$ 70,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (8, 'A', 7, 10, 2, 'Liso/Marrom', 'Unico', 'R$ 25,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (9, 'A', 7, 10, 2, 'Bordado/Marrom', 'Unico', 'R$ 25,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (10, 'A', 7, 10, 1, 'Liso/Marrom', 'Unico', 'R$ 25,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (11, 'A', 7, 10, 2, 'Branco', 'Unico', 'R$ 25,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (12, 'A', 7, 7, 4, 'Cama Solteiro/Peraltas', 'Unico', 'R$ 100,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (13, 'A', 7, 7, 1, 'Berço', 'Unico', 'R$ 100,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (14, 'A', 7, 7, 1, 'Cama Casal/Marrom', 'Unico', 'R$ 150,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (15, 'A', 7, 7, 1, 'Cama Solteiro/Marrom', 'Unico', 'R$ 100,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (16, 'A', 7, 5, 5, 'Branca', 'Unico', 'R$ 50,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (17, 'A', 7, 5, 1, 'Marrom', 'Unico', 'R$ 50,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (18, 'A', 7, 8, 1, 'Pequena', 'Unico', 'R$ 150,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (19, 'A', 7, 8, 4, 'Cama Solteiro', 'Unico', 'R$ 100,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (20, 'A', 7, 8, 1, 'Cama Casal', 'Unico', 'R$ 150,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (21, 'A', 7, 4, 5, 'Geral', 'Unico', 'R$ 250,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (22, 'A', 7, 12, 1, 'Cama Solteiro', 'Unico', 'R$ 50,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (23, 'A', 7, 12, 1, 'Cama Casal', 'Unico', 'R$ 75,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (24, 'A', 7, 3, 1, 'Cama Casal', 'Unico', 'R$ 750,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (25, 'A', 7, 11, 5, 'Criança ', 'Unico', 'R$ 150,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (26, 'A', 7, 15, 5, 'Geral', 'Unico', 'R$ 120,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (27, 'A', 7, 15, 5, 'Berço', 'Unico', 'R$ 120,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (28, 'A', 8, 14, 3, 'Redonda/Branca', 'Unico', 'R$ 100,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (29, 'A', 8, 14, 5, 'Redonda/Verde/Xadrez', 'Unico', 'R$ 50,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (30, 'A', 8, 14, 5, 'Redonda/Lisa/Branca', 'Unico', 'R$ 50,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (31, 'A', 8, 14, 5, 'Redonda/Dourada', 'Unico', 'R$ 50,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (32, 'A', 8, 14, 5, 'Redonda/Verde', 'Unico', 'R$ 50,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (33, 'A', 8, 14, 5, 'Redonda/Preta', 'Unico', 'R$ 50,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (34, 'A', 8, 14, 5, 'Redonda/Cinza/Florida', 'Unico', 'R$ 50,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (35, 'A', 8, 14, 5, 'Redonda/Branca/Flor azul', 'Unico', 'R$ 50,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (36, 'A', 8, 14, 5, 'Redonda/Branca/Flor Rosa', 'Unico', 'R$ 50,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (37, 'A', 8, 14, 5, 'Redonda/Rosa Florida', 'Unico', 'R$ 50,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (38, 'A', 8, 14, 5, 'Redonda/Preta/Seda', 'Unico', 'R$ 75,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (39, 'A', 8, 14, 5, 'Redonda/Branca/Cetim/Lisa', 'Unico', 'R$ 75,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (40, 'A', 8, 14, 5, 'Redonda/Branca Gelo/Seda', 'Unico', 'R$ 75,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (41, 'A', 8, 14, 5, 'Redonda/Creme/Cetim/Flori', 'Unico', 'R$ 75,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (42, 'A', 8, 14, 5, 'Redonda/Amarela/Renda', 'Unico', 'R$ 75,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (43, 'A', 8, 14, 5, 'Redonda/Verde/Seda/Lisa', 'Unico', 'R$ 75,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (44, 'A', 8, 14, 5, 'Redonda/Verde claro/Lisa', 'Unico', 'R$ 50,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (45, 'A', 8, 14, 5, 'Redonda/Vermelha/Flor azu', 'Unico', 'R$ 50,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (46, 'A', 1, 1, 1, 'Verde', 'P', 'R$ 50,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (47, 'A', 1, 1, 1, 'Verde', 'M', 'R$ 50,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (48, 'A', 1, 1, 1, 'Verde', 'G', 'R$ 50,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (49, 'A', 1, 1, 1, 'Verde', 'GG', 'R$ 50,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (50, 'A', 1, 1, 1, 'Verde', 'XG', 'R$ 50,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (51, 'A', 1, 1, 6, 'Amarela', 'P', 'R$ 50,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (52, 'A', 1, 1, 6, 'Amarela', 'M', 'R$ 50,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (53, 'A', 1, 1, 6, 'Amarela', 'G', 'R$ 50,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (54, 'A', 1, 1, 6, 'Amarela', 'GG', 'R$ 50,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (55, 'A', 1, 1, 6, 'Amarela', 'XG', 'R$ 50,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (56, 'A', 1, 2, 6, 'Amarela', 'XG', 'R$ 60,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (57, 'A', 1, 2, 6, 'Amarela', 'GG', 'R$ 60,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (58, 'A', 1, 2, 6, 'Amarela', 'G', 'R$ 60,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (59, 'A', 1, 2, 6, 'Amarela', 'M', 'R$ 60,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (60, 'A', 1, 2, 6, 'Amarela', 'P ', 'R$ 60,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (61, 'A', 1, 9, 6, 'Amarela', 'GG', 'R$ 100,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (62, 'A', 1, 9, 6, 'Amarela', 'M', 'R$ 100,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (63, 'A', 1, 9, 6, 'Amarela', 'P', 'R$ 100,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (64, 'A', 1, 9, 1, 'Verde', 'GG', 'R$ 100,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (65, 'A', 1, 9, 1, 'Verde', 'G', 'R$ 100,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (66, 'A', 1, 9, 1, 'Verde', 'M', 'R$ 100,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (67, 'A', 1, 6, 1, 'Verdes', 'M', 'R$ 100,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (68, 'A', 1, 6, 1, 'Verdes', 'P', 'R$ 100,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (69, 'A', 1, 6, 6, 'Amarela', 'G 2', 'R$ 100,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (70, 'A', 1, 6, 6, 'Amarela', 'GG', 'R$ 100,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (71, 'A', 1, 6, 6, 'Amarela', 'G', 'R$ 100,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (72, 'A', 1, 6, 6, 'Amarela', 'M', 'R$ 100,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (73, 'A', 1, 6, 6, 'Amarela', 'P', 'R$ 100,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (74, 'A', 8, 23, 5, 'Marrom', 'G', 'R$ 60,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (75, 'A', 8, 23, 5, 'Marrom', 'M', 'R$ 60,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (76, 'A', 8, 23, 5, 'Marrom', 'P', 'R$ 60,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (77, 'A', 2, 1, 5, 'Branca', 'G02', 'R$ 30,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (78, 'A', 2, 1, 5, 'Branca', 'GG', 'R$ 30,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (79, 'A', 2, 1, 5, 'Branca', 'G', 'R$ 30,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (80, 'A', 2, 1, 5, 'Branca', 'M', 'R$ 30,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (81, 'A', 2, 1, 5, 'Branca', 'P', 'R$ 30,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (82, 'A', 2, 24, 5, 'Xadrez', 'GG', 'R$ 100,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (83, 'A', 2, 24, 5, 'Xadrez', 'G', 'R$ 100,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (84, 'A', 2, 24, 5, 'Xadrez', 'M', 'R$ 100,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (85, 'A', 2, 24, 5, 'Xadrez', 'P', 'R$ 100,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (86, 'A', 2, 25, 5, 'Branca', 'G02', 'R$ 200,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (87, 'A', 2, 25, 5, 'Branca', 'GG', 'R$ 200,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (88, 'A', 2, 25, 5, 'Branca', 'G', 'R$ 200,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (89, 'A', 2, 25, 5, 'Branca', 'M', 'R$ 200,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (90, 'A', 2, 25, 5, 'Branca', 'P', 'R$ 200,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (91, 'A', 2, 25, 5, 'Preta', 'G', 'R$ 200,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (92, 'A', 2, 25, 5, 'Preta', 'M', 'R$ 200,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (93, 'A', 2, 25, 5, 'Preta', 'P', 'R$ 200,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (94, 'A', 2, 25, 5, 'Preta', 'GG', 'R$ 200,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (95, 'A', 2, 26, 5, 'Transparente', '0', 'R$ 30,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (96, 'A', 2, 27, 5, 'Preto', '0', 'R$ 30,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (97, 'A', 2, 27, 5, 'Branco', '0', 'R$ 30,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (98, 'A', 2, 28, 5, 'Preto', '0', 'R$ 30,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (99, 'A', 2, 28, 5, 'Branco', '0', 'R$ 30,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (100, 'A', 7, 29, 5, 'Branco e preto', 'GG', 'R$ 60,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (101, 'A', 7, 29, 5, 'Branco e preto', 'G', 'R$ 60,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (102, 'A', 7, 29, 5, 'Branco e preto', 'M', 'R$ 60,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (103, 'A', 7, 29, 5, 'Branco e preto', 'p', 'R$ 60,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (104, 'A', 7, 30, 5, 'Branco e preto', 'GG', 'R$ 100,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (105, 'A', 7, 30, 5, 'Branco e preto', 'G', 'R$ 100,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (106, 'A', 7, 30, 5, 'Branco e preto', 'M', 'R$ 100,00', null, null);
INSERT INTO lavanderia.product (id, status, id_department, id_product_type, id_product_service, product, size, unitary_value, created_at, updated_at) VALUES (107, 'A', 3, 1, 5, 'Básica / Branca e Cinza', 'G', 'R$ 30,00', null, null);
