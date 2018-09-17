$(function(){
/*****FUNCTIONS[BEGINS]****/
function ucwords(s){
    return s.charAt(0).toUpperCase() + s.substr(1).toLowerCase();  
}
/*****FUNCTIONS[END]****/
/*****GLOBAL[BEGINS]****/
//Переменные неизменяемых обьектов
var imgsHeroes = $('.imgHeroForView');
var hero_name = $('.text_box');
//alert(imgsHeroes.length);
/*****GLOBAL[END]****/
/*****HEROES[BEGINS]****/
//Принятие данных о каждом герое
/*imgsHeroes.each(function(){
	$(this).data({
		vars: $(this).attr('data-role') + ',' + $(this).attr('data-fight') + ',all,' + $(this).attr('alt')
	});
});
//Удаление побочных данных
imgsHeroes.removeAttr('data-role').removeAttr('data-fight');

//Выбор героя из заданного поиска
function pickHero(id, other_id, mode){
	//var data, alt;
	//var id1 = $('.main-list').first().attr('id');
	//var id2 = $('.main-list').last().attr('id');
	imgsHeroes.each(function(){
		data = $(this).data('vars');
		alt = (mode)?data.slice(data.lastIndexOf(',')):data;
		if(alt.indexOf(id) + 1 && data.indexOf(other_id) + 1 && data.indexOf(id1) + 1 && data.indexOf(id2) + 1){
			$(this).css({opacity: 1});
		}else{
			$(this).css({opacity: 0.2});
		}
	});
}*/
//Увеличение картинки героя при наведении на него
imgsHeroes.hover(function(){
	if($(this).css('opacity') == 1){
		$(this).addClass('hoverHero');
		hero_name.css('color', '#e8a902').text($(this).attr('alt'));
	}
},function(){
	if($(this).css('opacity') == 1){
		$(this).removeClass('hoverHero');
		hero_name.css('color', '#666').text('Имя героя');
	}
});
//Скрытие списка
/*function closeList(list, lists){
	list.parent().css({'z-index': 1});
	lists.hide().removeClass('active-list main-list');
	list.addClass('main-list').show();
	lists.first().removeClass('first-list');
	lists.last().removeClass('last-list');
}
//Функция для сортировки героев
function sortableHeroes(){
	var id1 = $('.main-list').first().attr('id');
	var id2 = $('.main-list').last().attr('id');
	imgsHeroes.each(function(){
		var data = $(this).data('vars');
		if(data.indexOf(id1) + 1 && data.indexOf(id2) + 1){
			$(this).css({opacity: 1});
		}else{
			$(this).css({opacity: 0.2});
		}
	});
}/*
//Функция для скрытых списков
$('.list-name').click(function(){
	//Текущий список и текущая выбранная ранее опция
	var lists = $(this).parent().children();
	var list = $(this);
	list.parent().css({'z-index': 1000});
	//Клик по закрытому списку
	if(list.attr('class').indexOf('main-list') + 1){
		list.removeClass('main-list').addClass('active-list');
		lists.first().addClass('first-list');
		lists.last().addClass('last-list');
		lists.show();
	}else{
		//Если список открыт
		closeList(list, lists);
		//Вызов функции для сортировки
		sortableHeroes();
	}
	//Если открыто сразу 2 или более списков
    if($('.list-name:visible').length - 1 > lists.length){
		var newlists = $('.list-name').not(lists);
		closeList(newlists.siblings('.active-list'), newlists);
	}
	//Уход из списка путем нажатия на любое другое место, не включающее сам список
	$(document).on('click', function(e){
		var classTarget = $(e.target).attr('class');
		if(!classTarget || !(classTarget.indexOf('list-name') + 1)){
			closeList(list, lists);
			$(document).off('click');
		}
	});
});*/


//Ввод имени героя и его отлов
$('#contentHeroes .search input').keyup(function(){
	value = $(this).val().toLowerCase();
	if(value.search(/[a-zA-Z]/) != -1){
		imgsHeroes.each(function(){
			if($(this).attr('alt').toLowerCase().indexOf(value)+1)
				$(this).css({opacity: 1});
			else
				$(this).css({opacity: 0.2});
		});
	}else if(value == ''){
		imgsHeroes.css({opacity: 1});
	}
});
/*****HEROES[END]****/
});