create or replace
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

