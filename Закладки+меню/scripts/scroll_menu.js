$(function() {     
    //verison 1.1
    
    /*
    change log:
        1.0: beta-version.
        1.1:
            -Добавлена динамическая зависимость скроллинга от высоты блока footer.
            -Добавлена динамическая зависимость высоты анимирования пунктов меню.
            -Теперь положение фиксации меню сохраняется при обновлении окна браузера.
    */
    
    //Рабочие переменные.
	var head = $('#header');
	var cont = $('#content');
    var foot = $('#footer');
	var menu = $('.menu');
	var win = $(window);
	var doc = $(document);

    //Скроллинг и фиксация меню
    function scrool_menu() {
		if(win.scrollTop() < 21 + head.height() + cont.height() - win.height()) {
			menu.addClass('menu_scroll'); 
			menu.css('bottom', 7);
			
		} else {
			menu.removeClass('menu_scroll');
            var bott = -(doc.height()-win.height()-(foot.height()+14));
			menu.css('bottom', bott);
		}    
	}
    scrool_menu();
	win.scroll(scrool_menu);
    
    //Анимирование меню.
	var elem = $('#menu_block > li');
    var bottom_height = $('#menu_block > li .menu_info').height();
    var hov;
    
    
    elem.on('mouseenter', 'div',function(){
        hov = $(this).children('.menu_info_hover');
		hov.stop().stop().stop();
		hov.animate({height: bottom_height+5}, 100).animate({height: bottom_height}, 65).animate({height: bottom_height+5}, 70);
    });
    elem.on('mouseleave', 'div', function(){
        hov = $(this).children('.menu_info_hover');
		hov.stop();
		hov.animate({height: '0px'}, 90);
    });
    
    
    
    
});    