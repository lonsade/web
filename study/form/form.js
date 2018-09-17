$(document).ready(function(){
	var ankets = $('.ankets div');
	$('#show_ankets').click(function(){
		if ($(this).text() == 'Показать список анкет'){
			$(this).text('Скрыть список анкет');
			ankets.show();
		}
		else{
			$(this).text('Показать список анкет');
			ankets.hide();
		}
	}).disableSelection();
});