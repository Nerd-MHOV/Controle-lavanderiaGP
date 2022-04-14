create or replace definer = root@localhost trigger TRG_SaidaProduto_AU
    after update
    on output
    for each row
BEGIN
      CALL SP_AtualizaEstoque (new.id_product, old.amount - new.amount, new.id_department);
END;

