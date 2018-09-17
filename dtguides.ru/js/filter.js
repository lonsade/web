$('.e_filter > select').selectmenu({
	appendTo : '#other',
	change : function(e, ui){
		if ($(this).attr('id') == 'type_of_role')
			if (ui.item.value == 0)
				$('.imgHeroForView').removeClass('dis_on_role');
			else
				$('.imgHeroForView').each(function(){
					if($(this).data('role').toString().indexOf(ui.item.value)+1)
						$(this).removeClass('dis_on_role');
					else
						$(this).addClass('dis_on_role');
				});
		else
			if (ui.item.value == 0)
				$('.imgHeroForView').removeClass('dis_on_fight');
			else
				$('.imgHeroForView').each(function(){
					if($(this).data('fight').toString().indexOf(ui.item.value)+1)
						$(this).removeClass('dis_on_fight');
					else
						$(this).addClass('dis_on_fight');
				});
	}
});