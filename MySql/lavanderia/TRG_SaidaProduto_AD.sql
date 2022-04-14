create or replace definer = root@localhost trigger TRG_SaidaProduto_AD
    after delete
    on output
    for each row
BEGIN
      CALL SP_AtualizaEstoque (old.id_department, old.amount, old.id_department);
END;

