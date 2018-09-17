//Глобальные переменные, необходимые для работы скрипта
var enter_under_error;
var content = $('.wrap > .content');
var links = $('menu .links');
var pointer = $('#pointer');
//Функция перенаправления без перезагрузки страницы
function doRedirect(hash){
	//Курсор на самый вверх
	$(document).scrollTop(0);
	//Установка главной страницы
	if(!hash)
		hash = '#all';
	//Установка загрузучного титла
	document.title = 'В процессе...';
	links.removeClass('active');
	pointer.hide();
	content.animate({opacity: 0}, 300).slideUp(300,function(){
		content.load('handler.php', {hash: hash}, function(responseText){
			$(function(){
				content.slideDown(300).animate({opacity: 1}, 300, function(){
					document.title = ready_title;
					if (!error){
						pointer.show();
						alert(322);
						cur_link = links.filter('#'+current_project).addClass('active');
						pointer.css({left: Math.ceil((cur_link.innerWidth() - 45) / 2 + cur_link.position().left) + 'px'}).show();
					}
				});
			});
		});
	});
}
//Вызов редиректа для первого раза(для нового хеша)
doRedirect(location.hash);
//Вызов редиректа по нажатию ссылок навигации
links.click(function(){
	location.hash = $(this).attr('id');
});
//Функция для отловки смены хеша(основа работы скрипта)
$(window).bind('hashchange', function(){
	doRedirect(location.hash);
});

$(function(){
	$('.registration input').placeholder();

	window_reg = $('.window_reg');
	window_login = $('.window_login');

	$('.button_login').click(function(){
		if (window_reg.is(':visible'))
			window_reg.hide();
		if (window_login.is(':visible'))
			window_login.hide();
		else
			window_login.show();
	});
	$('.button_reg').click(function(){
		if (window_login.is(':visible'))
			window_login.hide();
		if (window_reg.is(':visible'))
			window_reg.hide();
		else
			window_reg.show();
	});

	window_reg.children('#l_but').click(function(){

	});

	window_reg.children('#r_but').click(function(){
		$.ajax({
			type: 'POST',
			url: 'registration.php',
			data: {
				login : window_reg.children('#r_login').val(),
				pass : window_reg.children('#r_pass').val(),
				confirm : window_reg.children('#r_confirm').val(),
				email : window_reg.children('#r_email').val()
			},
			dataType: 'html',
			success: function(msg){
				alert(msg);
			}
		});
	});

});