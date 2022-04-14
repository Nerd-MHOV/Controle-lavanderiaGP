create or replace definer = root@localhost trigger TRG_EntradaProduto_AU
    after update
    on input
    for each row
BEGIN
      CALL SP_AtualizaEstoque (new.id_product, new.amount - old.amount, new.id_department);
END;

