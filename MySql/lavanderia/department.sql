create or replace table department
(
    id         int auto_increment
        primary key,
    department varchar(255) not null,
    created_at timestamp    null,
    update_at  timestamp    null
);

