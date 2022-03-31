create definer = root@localhost trigger TRG_SaidaProduto_AD
    after delete
    on `exit`
    for each row
BEGIN
      CALL SP_AtualizaEstoque (old.id_product, old.amount, old.id_department);
END;

