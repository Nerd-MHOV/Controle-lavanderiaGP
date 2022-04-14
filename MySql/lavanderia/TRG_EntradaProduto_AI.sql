create or replace definer = root@localhost trigger TRG_EntradaProduto_AI
    after insert
    on input
    for each row
BEGIN
      CALL SP_AtualizaEstoque (new.id_product, new.amount, new.id_department);
END;

