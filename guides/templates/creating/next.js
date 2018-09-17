$('.imgHeroForView').click(function(){
    if ($(this).css('opacity') != '0.2')
	   location.hash = 'creating>' + $(this).attr('alt');
});