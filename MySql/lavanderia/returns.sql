create or replace table returns
(
    id              int auto_increment
        primary key,
    id_product      int          not null,
    id_department   int          not null,
    id_collaborator int          not null,
    id_user         int          not null,
    amount          int          not null,
    amountBad       int          null,
    status_in       varchar(255) not null,
    status_out      varchar(255) not null,
    obs_in          varchar(255) null,
    obs_out         varchar(255) null,
    created_at      timestamp    null,
    updated_at      timestamp    null
);

