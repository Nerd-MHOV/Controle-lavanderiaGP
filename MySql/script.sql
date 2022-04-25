create or replace table collaborator
(
	id int auto_increment
		primary key,
	id_department int not null,
	collaborator varchar(255) not null,
	cpf varchar(255) not null,
	type varchar(255) not null,
	created_at timestamp null,
	updated_at timestamp null
);

create or replace table department
(
	id int auto_increment
		primary key,
	department varchar(255) not null,
	created_at timestamp null,
	updated_at timestamp null
);

create or replace table department_head
(
	id int auto_increment
		primary key,
	id_department int not null,
	first_name varchar(255) not null,
	last_name varchar(255) not null,
	email varchar(255) not null,
	cel varchar(255) not null,
	created_at timestamp null,
	updated_at timestamp null
);

create or replace table input
(
	id int auto_increment
		primary key,
	id_product int not null,
	id_department int not null,
	amount int not null,
	created_at timestamp null,
	updated_at timestamp null
);

create or replace definer = root@localhost trigger TRG_EntradaProduto_AD
	after delete
	on input
	for each row
	BEGIN
      CALL SP_AtualizaEstoque (old.id_product, old.amount * -1, old.id_department);
END;

create or replace definer = root@localhost trigger TRG_EntradaProduto_AI
	after insert
	on input
	for each row
	BEGIN
      CALL SP_AtualizaEstoque (new.id_product, new.amount, new.id_department);
END;

create or replace definer = root@localhost trigger TRG_EntradaProduto_AU
	after update
	on input
	for each row
	BEGIN
      CALL SP_AtualizaEstoque (new.id_product, new.amount - old.amount, new.id_department);
END;

create or replace table inventory
(
	id int auto_increment
		primary key,
	id_product int not null,
	id_department int not null,
	amount int not null,
	created_at timestamp null,
	updated_at timestamp null
);

create or replace table output
(
	id int auto_increment
		primary key,
	id_product int not null,
	id_department int not null,
	id_collaborator int not null,
	id_user int not null,
	amount int not null,
	status varchar(255) not null,
	obs varchar(255) null,
	created_at timestamp null,
	updated_at timestamp null
);

create or replace definer = root@localhost trigger TRG_SaidaProduto_AD
	after delete
	on output
	for each row
	BEGIN
      CALL SP_AtualizaEstoque (old.id_department, old.amount, old.id_department);
END;

create or replace definer = root@localhost trigger TRG_SaidaProduto_AI
	after insert
	on output
	for each row
	BEGIN
      CALL SP_AtualizaEstoque (new.id_product, new.amount * -1, new.id_department);
END;

create or replace definer = root@localhost trigger TRG_SaidaProduto_AU
	after update
	on output
	for each row
	BEGIN
      CALL SP_AtualizaEstoque (new.id_product, old.amount - new.amount, new.id_department);
END;

create or replace table product
(
	id int auto_increment
		primary key,
	status char default 'A' not null,
	id_department int not null,
	id_product_type int not null,
	id_product_service int not null,
	product varchar(25) not null,
	unitary_value varchar(255) not null,
	created_at timestamp null,
	updated_at timestamp null
);

create or replace table product_service
(
	id int auto_increment
		primary key,
	service varchar(255) not null,
	created_at timestamp null,
	updated_at timestamp null
);

create or replace table product_type
(
	id int auto_increment
		primary key,
	product_type varchar(255) not null,
	created_at timestamp null,
	updated_at timestamp null
);

create or replace table returns
(
	id int auto_increment
		primary key,
	id_product int not null,
	id_department int not null,
	id_collaborator int not null,
	id_user int not null,
	amount int not null,
	amountBad int null,
	status_in varchar(255) not null,
	status_out varchar(255) not null,
	obs_in varchar(255) null,
	obs_out varchar(255) null,
	created_at timestamp null,
	updated_at timestamp null
);

create or replace table users
(
	id int auto_increment
		primary key,
	first_name varchar(255) not null,
	last_name varchar(255) not null,
	email varchar(255) not null,
	user varchar(255) not null,
	passwd varchar(255) not null,
	photo varchar(255) null,
	forget varchar(255) null,
	created_at timestamp null,
	updated_at timestamp null
);

create or replace definer = root@localhost procedure SP_AtualizaEstoque(IN id_prod int, IN input_amount int, IN id_depart int)
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


