create or replace definer = root@localhost trigger TRG_EntradaProduto_AD
    after delete
    on input
    for each row
BEGIN
      CALL SP_AtualizaEstoque (old.id_product, old.amount * -1, old.id_department);
END;

