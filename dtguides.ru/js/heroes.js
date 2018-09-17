$(function(){
//Переменные неизменяемых обьектов
var imgsHeroes = $('.imgHeroForView');
var hero_name = $('.text_box');
//Увеличение картинки героя при наведении на него
imgsHeroes.hover(function(){
	if($(this).attr('class').indexOf('dis') == -1){
		$(this).addClass('hoverHero');
		hero_name.css('color', '#e8a902').text($(this).attr('alt'));
	}
},function(){
	if($(this).attr('class').indexOf('dis') == -1){
		$(this).removeClass('hoverHero');
		hero_name.css('color', '#666').text('Имя героя');
	}
});
//Ввод имени героя и его отлов
$('#contentHeroes .search input').keyup(function(){
	value = $(this).val().toLowerCase();
	if(value.search(/[a-zA-Z]/) != -1){
		imgsHeroes.each(function(){
			if($(this).attr('alt').toLowerCase().substr(0, value.length) == value)
				$(this).removeClass('dis_on_text');
			else
				$(this).addClass('dis_on_text');
		});
	}else if(value == ''){
		imgsHeroes.removeClass('dis_on_text');
	}
});
});