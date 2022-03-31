create definer = root@localhost trigger TRG_SaidaProduto_AD
    after delete
    on `exit`
    for each row
BEGIN
      CALL SP_AtualizaEstoque (old.id_produto, old.qtde, old.id_departamento);
END;

