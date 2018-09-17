//Глобальные переменные, необходимые для работы скрипта
var enter_under_error;
var content = $('.wrap > .content');
var links = $('menu .links');
var pointer = $('#pointer');

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
var made = true;
$(function(){

	$('body').on('mousewheel', function(event) {
    event.preventDefault();
    var scrollTop = this.scrollTop;
    this.scrollTop = (scrollTop + ((event.deltaY * event.deltaFactor) * -1));
  });

	$('.wrap').on('click', '.imgHeroForView', function(){
		if ($(this).attr('class').indexOf('dis') == -1)
			get_content(location.pathname + '/' + $(this).attr('alt'), true);
	});
	$('.wrap').on('click', 'a', function(e){
		e.preventDefault();
		if ($(this).attr('href') != location.pathname)
			get_content($(this).attr('href'), true);
	});
});

window.addEventListener("popstate", function(e){
	get_content(location.pathname, false);
});
var main = '';
if (location.pathname == '/dtguides.ru/')
	main = 'all';
get_content(location.pathname + main, true);

function get_content(url, addEntry){
	if (made){
		made = false;
		//Курсор на самый вверх
		$(document).scrollTop(0);
		//Установка загрузучного титла
		document.title = 'Загрузка';
		links.removeClass('active');
		pointer.hide();
		if(addEntry == true)
			history.pushState(null, null, url.replace(/\ /gi, '_'));
		content.animate({opacity: 0}, 300).slideUp(300,function(){
			content.load('/dtguides.ru/handler.php', {url: url.replace(/\_/gi, ' ')}, function(responseText){
				$(responseText).ready(function(){
					content.slideDown(300).animate({opacity: 1}, 300, function(){
						document.title = $ready_title;
						made = true;
						if (!$current_error){
							pointer.show();
							$cur_link = links.filter('#'+$current_project).addClass('active');
							pointer.css({left: Math.ceil(($cur_link.innerWidth() - 45) / 2 + $cur_link.position().left) - 1 + 'px'}).show();
						}
					});
				});
			});
		});
	}
}