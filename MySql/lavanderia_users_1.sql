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

INSERT INTO lavanderia.users (id, first_name, last_name, email, user, passwd, photo, forget, created_at, updated_at) VALUES (2, 'Matheus', 'Henrique', 'matheus.henrique42452@gmail.com', 'admin', '$2y$10$pwGtIVIjdszCjYqZROgwqOmbNYDk4ZD1UjKH4d0.I9jfc0QkuXMIq', null, null, '2022-03-21 22:25:32', '2022-03-21 22:25:32');
