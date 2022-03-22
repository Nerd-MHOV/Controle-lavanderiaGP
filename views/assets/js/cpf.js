$(function(){
	$('[name=cpf]').mask('999.999.999-99');
	$('[name=celular]').mask('(99) 99999-9999');

	$('#reais').maskMoney();
	$('.reais').maskMoney();
})