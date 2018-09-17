
/**********|Last-modified: 06.11.2016|**********/

/*****SKILLBUILD[BEGINS]****/
var health_bar = $('#health_bar');
var speed_bar = $('#speed_bar');
var damage_begin_bar = $('#damage_begin_bar');
var damage_end_bar = $('#damage_end_bar');
var armor_bar = $('#armor_bar');
var mana_bar = $('#mana_bar');	
var strength_bar = $('#strength_bar');
var agility_bar = $('#agility_bar');
var intellect_bar = $('#intellect_bar');
var strength_bar_up = $('#strength_bar_up');
var agility_bar_up = $('#agility_bar_up');
var intellect_bar_up = $('#intellect_bar_up');
$('.shot_info:last p').each(function(){
	if ($(this).attr('style') == 'color:#00bcff;')
		type = $(this).index();
});
var levels = $('.levels:not(.levelup_off)');
//Подсчет количества выбранных левелапов до текущего левела
function count_prev(level){
	count = 0;
	for (i = 0; i < level.data('col') - 1; i++)
		if (level.siblings().eq(i).hasClass('levelup'))
			count++;
	return count;
}
//Уменьшение характеристик
function reduce(level){
	if (level.data('health_up')){
		health_bar.text(health_bar.text()*1-level.data('health_up'));
		mana_bar.text(Math.round(mana_bar.text()*1-level.data('mana_up')));
		armor_bar.text((armor_bar.text()*1-level.data('armor_up')).toFixed(2));
		strength_bar.text(Math.round(strength_bar.text()*1-level.data('strength_up')));
		agility_bar.text(Math.round(agility_bar.text()*1-level.data('agility_up')));
		intellect_bar.text(Math.round(intellect_bar.text()*1-level.data('intellect_up')));
		damage_begin_bar.text(Math.round(damage_begin_bar.text()*1-level.data('damage_up')));
		damage_end_bar.text(Math.round(damage_end_bar.text()*1-level.data('damage_up')));
		level.removeData(['health_up','mana_up','armor_up','strength_up','agility_up','intellect_up','damage_up']);
	}
}
levels.click(function(){
	var clicked_level = $(this);
	if (!clicked_level.hasClass('levelup_disable') && !clicked_level.hasClass('levelup')){
		var siblings_l = clicked_level.siblings();
		//Клик по левелу стобец которого заблокирован уже выбранным ранее левелом
		if (clicked_level.hasClass('levelup_mb_re')){
			clicked_level.removeClass('levelup_mb_re');
			uping = levels.filter('[data-col="'+clicked_level.data('col')+'"]').filter('.levelup');
			uping.removeClass('levelup');
			if (uping.data('disable_level'))
				for (i = 0; i < uping.data('disable_level').length; i++)
					uping.data('disable_level').removeClass('levelup_disable');
			uping.removeData('disable_level');
			reduce(uping);
		}
		clicked_level.addClass('levelup');
		//Проверка на готовность к отправке
		if (levels.filter('.levelup').length == 25)
			clicked_level.closest('.tool').prev().children('.error_creating').hide();
		levels.filter('[data-col="'+clicked_level.data('col')+'"]').not('.levelup_off').not(clicked_level).addClass('levelup_mb_re');
		//Блокировка всех левелов идущих от 1 и до текущего (спорное поведение)
		for (i = 0; i < clicked_level.data('col') - 1; i++)
			if (!siblings_l.eq(i).hasClass('levelup') && !siblings_l.eq(i).hasClass('levelup_off') && !siblings_l.eq(i).hasClass('levelup_disable')){
				siblings_l.eq(i).addClass('levelup_disable');
				clicked_level.data('disable_level', siblings_l.eq(i));
			}
		//Клик по левелу ульты
		if (clicked_level.data('row') == '4'){
			var level = clicked_level.next();
			//Блокировка в случае диапозона от 6 до 9
			if (clicked_level.data('col') > 5 && clicked_level.data('col') < 10)
				while (level.data('col') < 11){
					level.addClass('levelup_disable');
					clicked_level.data('disable_level', level);
					level = level.next();
				}
			//Блокировка в случае наличия одного левела и для диапозона от 11 до 14
			else if (clicked_level.data('col') > 10 && clicked_level.data('col') < 15 && count_prev(clicked_level) == 1)
				while (level.data('col') < 16){
					level.addClass('levelup_disable');
					clicked_level.data('disable_level', level);
					level = level.next();
				}
			//Блокировка в ином случае если количество выбранных ранее левелов равняется 2
			else if(count_prev(clicked_level) == 2){
				temp_levels = siblings_l.not('.levelup_disable, .levelup, .levelup_off');
				temp_levels.addClass('levelup_disable');
				clicked_level.data('disable_level', temp_levels);
			}
		}
		//Клик на прокачку плюсов
		else if (clicked_level.data('row') == '5'){
			//Изменение информационных баров
			var health_up = strength_bar_up.text()*40;
			var mana_up = intellect_bar_up.text()*26;
			var armor_up = agility_bar_up.text()*2/7;
			var strength_up = 2*strength_bar_up.text();
			var agility_up = 2*agility_bar_up.text();
			var intellect_up = 2*intellect_bar_up.text();
			switch(type){
				case 1:
					var damage_up = strength_bar_up.text()*2;
					break;
				case 2:
					var damage_up = agility_bar_up.text()*2;
					break;
				case 3:
					var damage_up = intellect_bar_up.text()*2;
					break;
			}
			$(this).data({
				'health_up': health_up,
				'mana_up': mana_up,
				'armor_up': armor_up,
				'strength_up': strength_up,
				'agility_up': agility_up,
				'intellect_up': intellect_up,
				'damage_up': damage_up
			});
			health_bar.text(health_bar.text()*1+health_up);
			mana_bar.text(Math.round(mana_bar.text()*1+mana_up));
			armor_bar.text((armor_bar.text()*1+armor_up).toFixed(2));
			strength_bar.text(Math.round(strength_bar.text()*1+strength_up));
			agility_bar.text(Math.round(agility_bar.text()*1+agility_up));
			intellect_bar.text(Math.round(intellect_bar.text()*1+intellect_up));
			damage_begin_bar.text(Math.round(damage_begin_bar.text()*1+damage_up));
			damage_end_bar.text(Math.round(damage_end_bar.text()*1+damage_up));
			//Выполнение дальнейшей функции
			free_levels = siblings_l.not('.levelup_disable, .levelup, .levelup_off');
			if (count_prev(clicked_level) == 9){
				free_levels.addClass('levelup_disable');
				clicked_level.data('disable_level', free_levels);
			}
		}
		//Клик на обычные скилы
		else
			//Блокировка исходя из уровня
			switch(clicked_level.text()){
				case '1':
					clicked_level.next().addClass('levelup_disable');
					clicked_level.data('disable_level', clicked_level.next());
					break;
				case '3':
					if (count_prev(clicked_level) == 1){
						clicked_level.next().addClass('levelup_disable');
						clicked_level.data('disable_level', clicked_level.next());
					}
					break;
				case '4':
					if (count_prev(clicked_level) == 2){
						clicked_level.next().addClass('levelup_disable');
						clicked_level.data('disable_level', clicked_level.next());
					}
					break;
				case '5':
					if (count_prev(clicked_level) == 2){
						clicked_level.next().addClass('levelup_disable');
						clicked_level.data('disable_level', clicked_level.next());
					}
					break;
				default:
					if (count_prev(clicked_level) == 3){
						temp_levels = siblings_l.not('.levelup_disable, .levelup, .levelup_off');
						temp_levels.addClass('levelup_disable');
						clicked_level.data('disable_level', temp_levels);
					}
					break;
			}
	}
});
//Обновление строки прокачки
$('.col_refresh>div').click(function(){
	if ($(this).data('row') == '5'){
		levels.filter('[data-row="'+$(this).data('row')+'"]').each(function(){
			if ($(this).hasClass('levelup')){
				reduce($(this));
			}
		});
	}
	levels.filter('[data-row="'+$(this).data('row')+'"]').each(function(){
		if ($(this).hasClass('levelup')){
			levels.filter('[data-col="'+$(this).data('col')+'"]').not(this).removeClass('levelup_mb_re');
			$(this).removeClass('levelup');
		}
		else if($(this).hasClass('levelup_disable'))
			$(this).removeClass('levelup_disable');
	});
});
/*****SKILLBUILD[END]****/

/*****ACCORDION[BEGINS]****/
//Реализация плагина "Аккордион" (Анимированные вкладки)
$('.accordion').accordion({
	header: '.title',
	heightStyle: 'content',
	icons: false
});
/*****ACCORDION[END]****/

/*****TOOLTIP[BEGINS]****/
$('.skills > div > img, .col_skills > img').hover(function(){
	tooltip = $(this).next();
	tooltip.show();
	//Первоначальная настройка отображения
	if(!tooltip.data('up')){
		$(this).data('up', true);
		width = 0;
		tooltip.find('p').each(function(){
			if ($(this).outerWidth() > width){
				width = $(this).outerWidth();
			}
		});
		tooltip.width(Math.round(width+30));
	}
	margin = tooltip.outerHeight()+tooltip.offset().top+$(document).scrollTop()-$(window).height();
	if (margin > 0){
		tooltip.css('margin-top', parseInt(tooltip.css('margin-top'))-margin-10+'px');
		tooltip.find('.shower').css('margin-top', margin+10+'px');
	}
},function(){
	$(this).next().hide();
});
/*****TOOLTIP[END]****/

/*****ITEMBUILD[BEGINS]****/
var items = $('.c_item');
var contentitem = $('.container');
var addercontent = $('#stage_4');
var prev_stage = false;
//Реализация плагина для перемещения предмтов
items.draggable({
	addClasses: false,
	helper: 'clone',
	zIndex: 100,
	scroll: false
});
//Реализация плагина для принятия предметов
contentitem.droppable({
	drop: function(e, ui){
		//Проверка готовности к отправке
		if (!prev_stage)
			prev_stage = $(this).parent().attr('id');
		if (prev_stage != $(this).parent().attr('id'))
			$(this).closest('.tool').prev().children('.error_creating').hide();
		prev_stage = $(this).parent().attr('id');
		var drag = ui.draggable;
		var gold = $(this).siblings('.gold');
		$(this).addClass('c_active');
		$(this).parent().addClass('c_ready');
		var prevgold = (gold.text())?parseInt(gold.text()):0;
		prevgold_c = 0;
		if ($(this).html() != ""){
			prevgold_c = parseInt($(this).find('img').data('price'));
			$(this).empty();
		}
		gold.text(prevgold - prevgold_c + parseInt(drag.children().data('price')));
		$(this).append(drag.clone());
	}
});
//Добавление блока закупа
addercontent.click(function(){
	if (!$(this).hasClass('up_stage')){
		$(this).addClass('up_stage');
	}
});
/*****ITEMBUILD[END]****/

/*****FORM[BEGINS]****/
var all_textarea = $('.tools_for_guide textarea');
//Текстовые данные, которые нужно еще проверить
var g_name = $('#tool_for_name textarea');
var g_about = $('#tool_for_about textarea');
var g_skills = $('#tool_for_skills textarea');
//Структурные данные, которые нужно еще проверить
var g_items = $('#tool_for_itembuild .content_for_items');
//Элементы, отвечающие за ошибки
var g_name_e = $('#tool_for_name').prev().children('.error_creating');
var g_about_e = $('#tool_for_about').prev().children('.error_creating');
var g_skills_e = $('#tool_for_skills').prev().children('.error_creating');
var g_levels_e = $('#tool_for_skillbuild').prev().children('.error_creating');
var g_items_e = $('#tool_for_itembuild').prev().children('.error_creating');

//Проверка на пустоту хотя бы одного текстого поля
function g_empty(obj){
	f = false;
	obj.each(function(){
		if($.trim($(this).val())==''){
			f = true;
			return;
		}
	});
	if (f)
		return true;
	else
		return false;
}

$('#create_guide').click(function(){
	error = false;
	if ($.trim(g_name.val())==''){
		error = true;
		g_name_e.show();
	}
	if ($.trim(g_about.val())==''){
		error = true;
		g_about_e.show();
	}
	if (g_empty(g_skills)){
		error = true;
		g_skills_e.show();
	}
	if (g_empty(g_items.children('textarea'))){
		error = true;
		g_items_e.show();
	}
	if (levels.filter('.levelup').length != 25){
		error = true;
		g_levels_e.show();
	}
	if (g_items.filter('.c_ready').length < 2){
		error = true;
		g_items_e.show();
	}
	if (!error){
		var g_skills_ready = {};
		var g_levels_ready = '';
		var g_items_ready = {};
		//Формирование g_levels_ready
		for (i = 1; i < 26; i++)
			g_levels_ready += $.trim(levels.filter('.levelup').filter('[data-col='+i+']').data('row'));
		//Формирование g_skills_ready
		g_skills.each(function(){
			g_skills_ready[$(this).data('id')] = $.trim($(this).val());
		});
		//Формирование g_items_ready
		g_items.filter('.c_ready').each(function(){
			var text = $(this).children('textarea');
			g_items_ready[text.data('stage-id')] = {};
			g_items_ready[text.data('stage-id')]['name'] = $.trim(text.val());
			$(this).children('.c_active').each(function(){
				g_items_ready[text.data('stage-id')][$(this).data('col')] = $(this).find('img').data('id');
			});
		});
		//Отправка данных
		$.ajax({
			type: 'POST',
			url: 'templates/creating/handler.php',
			data: {
				hero: $.trim($('.name_hero').text()),
				name: $.trim(g_name.val()),
				info: $.trim(g_about.val()),
				skills: g_skills_ready,
				levels: g_levels_ready,
				items: g_items_ready
			},
			dataType: 'html',
			success: function(data){
				//location.hash = 'my>'+id;
				$('body').append(data);
			}
		});
	}
	else{
		all_textarea.one('keyup', function(){
			tool = $(this).closest('.tool');
			if ($(this).val() == "")
				tool.prev().children('.error_creating').show();
			else{
				error = false;
				if (tool.attr('id') == 'tool_for_skills' || tool.attr('id') == 'tool_for_itembuild'){
					tool.find('textarea').each(function(){
						if ($(this).val() == ""){
							tool.prev().children('.error_creating').show();
							error = true;
							return false;
						}
					});
				}
				if (!error)
					tool.prev().children('.error_creating').hide();
			}
		});
	}
});
/*****FORM[END]****/