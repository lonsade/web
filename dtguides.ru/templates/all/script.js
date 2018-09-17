//Сортировка гайдов по какому-то критерию
var contairner_guides = $('.list_guides');
$('.content_guides > #titles > div').click(function(){
	if (!$(this).hasClass('g_sorting')){
		type = $(this).attr('class');
		sorting = $('.'+type);
		$('.g_sorting').removeClass('g_sorting');
		sorting.addClass('g_sorting');
		sorting = sorting.not(this);
		list_guides = $.makeArray(contairner_guides.children());
		if (type == 'g_hero')
			list_guides.sort(function (a, b){
        a = $(a).children('.'+type).children('img').attr('alt');
        b = $(b).children('.'+type).children('img').attr('alt');
        return a < b ? -1 : a > b ? 1 : 0;
    	});
		else if(type == 'g_rating')
			list_guides.sort(function (a, b){
        a = $(a).children('.'+type).children('#r_process').width();
        b = $(b).children('.'+type).children('#r_process').width();
        if (!a) a = 0;
        if (!b) b = 0;
        return a < b ? 1 : a > b ? -1 : 0;
    	});
		else
			if (type == 'g_patch' || type == 'g_views' || type == 'g_date')
				list_guides.sort(function (a, b){
					a = $(a).children('.'+type).text();
	        b = $(b).children('.'+type).text();
					return a < b ? 1 : a > b ? -1 : 0;
				});
			else
				list_guides.sort(function (a, b){
					a = $(a).children('.'+type).text();
	        b = $(b).children('.'+type).text();
					return a < b ? -1 : a > b ? 1 : 0;
				});
    $(list_guides).appendTo(contairner_guides);
	}
});
//Элементы фильтра

var g_type = 'Герою';

$('.g_checkbox').checkboxradio({
	icon: false
});
$('#g_type').selectmenu({
	width: 110,
	change: function(e, ui){
		g_type = ui.item.value;
	}
});

function g_filter(clicked, callback){
	if (!clicked.hasClass('ui-checkboxradio-checked')){
		re = contairner_guides.children().map(callback);
		clicked.data('list', contairner_guides.children());
		contairner_guides.empty();
    re.appendTo(contairner_guides);
	}
	else
		clicked.data('list').appendTo(contairner_guides);
}

$('#s_views').click(function(){
	g_filter($(this), function(){
		if ($(this).children('.g_views').text() != '0')
			return this;
	});
});

$('#s_rating').click(function(){
	g_filter($(this), function(){
		if ($(this).children('.g_rating').find('#r_process').length == 1)
			return this;
	});
});

$('#s_patch').click(function(){
	g_filter($(this), function(){
		if ($(this).children('.g_patch').text() == '6.88')
			return this;
	});
});

function g_filter_text(value){
	switch (g_type){
		case 'Герою':
			re = contairner_guides.children().map(function(){
				if ($(this).children('.g_hero').children('img').attr('alt').toLowerCase().indexOf(value)+1)
					return this;
			});
			break;
		case 'Названию':
			re = contairner_guides.children().map(function(){
				if ($(this).children('.g_title').text().toLowerCase().indexOf(value)+1)
					return this;
			});
			break;
		case 'Патчу':
			re = contairner_guides.children().map(function(){
				if ($(this).children('.g_patch').text().toLowerCase().indexOf(value)+1)
					return this;
			});
			break;
		case 'Автору':
			re = contairner_guides.children().map(function(){
				if ($(this).children('.g_creator').text().toLowerCase().indexOf(value)+1)
					return this;
			});
			break;
		case 'Дате':
			re = contairner_guides.children().map(function(){
				if ($(this).children('.g_date').text().toLowerCase().indexOf(value)+1)
					return this;
			});
			break;
		case 'Рейтингу':
			re = contairner_guides.children().map(function(){
				if ($(this).children('.g_rating').children('#r_process').width() >= value*24)
					return this;
			});
			break;
	}
	//$(this).data('list', contairner_guides.children());
	contairner_guides.empty();
  re.appendTo(contairner_guides);
}

$('.icon_search').click(function(){
	g_filter_text($(this).next().val().toLowerCase());
});

$('.field input').keyup(function(event) {
	if (event.keyCode==13)
		g_filter_text($(this).val().toLowerCase());
});


//Переход к гайду
$('.list_guides .g_title').click(function(){
	location.hash = '#all>'+$(this).parent().data('id');
});