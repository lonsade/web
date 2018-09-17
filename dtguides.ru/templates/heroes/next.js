imgsHeroes.click(function(){
    if ($(this).css('opacity') != '0.2')
	   location.hash = 'heroes>' + $(this).attr('alt');
});