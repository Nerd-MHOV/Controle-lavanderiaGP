create table users
(
    id         int auto_increment
        primary key,
    first_name varchar(255) not null,
    last_name  varchar(255) not null,
    email      varchar(255) not null,
    user       varchar(255) not null,
    passwd     varchar(255) not null,
    photo      varchar(255) null,
    forget     varchar(255) null,
    created_at timestamp    null,
    updated_at timestamp    null
);

INSERT INTO lavanderia.users (first_name, last_name, email, user, passwd, photo, forget, created_at, updated_at) VALUES ('Matheus', 'Henrique', 'matheus.henrique4245@gmail.com', 'admin', '$2y$10$IqaAeuYofujbeuX5jCBVIOg/6lJ.9U5aA.7J8zH8vBKOYs0hs5fbW', null, null, '2022-04-29 09:27:05', '2022-04-29 09:27:05');
INSERT INTO lavanderia.users (first_name, last_name, email, user, passwd, photo, forget, created_at, updated_at) VALUES ('Teste', 'Teste', 'teste@teste.com.br', 'teste', '$2y$10$Q3OFnouIULCLFR4KsKyEQ.xQeLTKzYgnltzAEbAH44X3.PjUz2vJa', null, null, '2022-04-29 12:24:02', '2022-04-29 12:24:02');
