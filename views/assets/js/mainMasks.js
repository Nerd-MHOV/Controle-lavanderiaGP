$(function(){
	$('.cpfMask').mask('999.999.999-99');
	$('.phoneMask').mask('(99) 99999-9999');
	$('.moneyMask').maskMoney({thousands:'.', decimal:',', allowZero:true, prefix: 'R$ '});
	$('.onlyNum').mask("###");
	$(".selectClass").select2({
		width: 'resolve'
	});
})