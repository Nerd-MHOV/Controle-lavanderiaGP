create definer = root@localhost trigger TRG_SaidaProduto_AU
    after update
    on `exit`
    for each row
BEGIN
      CALL SP_AtualizaEstoque (new.id_produto, old.qtde - new.qtde, new.id_departamento);
END;

