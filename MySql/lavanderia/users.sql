create or replace table users
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

