create definer = root@localhost trigger TRG_SaidaProduto_AI
    after insert
    on `exit`
    for each row
BEGIN
      CALL SP_AtualizaEstoque (new.id_product, new.amount * -1, new.id_department);
END;
