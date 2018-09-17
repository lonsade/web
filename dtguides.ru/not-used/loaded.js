$('.guide #name').click(function(){
	location.hash = 'all>' + $(this).parent().attr('id').match(/\d{1,}/);
});

$('.showHelp').hover(function(){
	showHelp($(this).parent().next(), true);
},function(){
	hideHelp($(this).parent().next());
});

$('.skillImg img:not(.noshowhelp), .skills-h').hover(function(){
	showHelp($(this).next(), true);
},function(){
	hideHelp($(this).next());
});



