$(function(){
	$('.registration input, .input_reg').placeholder();

	window_reg = $('.window_reg');
	window_login = $('.window_login');

	$('.button_login').click(function(){
		if (window_reg.is(':visible'))
			window_reg.hide('drop');
		if (window_login.is(':visible'))
			window_login.hide('drop');
		else
			window_login.show('drop');
	});
	$('.button_reg').click(function(){
		if (window_login.is(':visible'))
			window_login.hide('drop');
		if (window_reg.is(':visible'))
			window_reg.hide('drop');
		else
			window_reg.show('drop');
	});

	$('.my_select').selectmenu({
		appendTo : '#other'
	});

	$('.dialog_error').dialog({
    appendTo : '#other',
    resizable : false,
    width : 400,
    closeText : 'Закрыть',
    minHeight : 50,
    modal : true
	});
	$('.dialog_error').dialog('close').dialog('option', 'hide', {effect : 'drop', duration : 500}).dialog('option', 'show', {effect : 'drop', duration : 500});

	$('#r_but').click(function(e){
		$(this).blur();
		//Проверка данных
		var error = new Array();
		if ($('#r_login').val() == '' || $('#r_login').val().length > 15)
			error.push('Логин не должен быть пустым и его длина не должна первышать 15 символов');
		if ($('#r_pass').val() == '' || $('#r_pass').val().length > 25)
			error.push('Пароль должен быть не меньше 6 и не больше 25 символов');
		if ($('#r_email').val() == '' || $('#r_email').val().length > 150 || $('#r_email').val().search(new RegExp(/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/, "g")) == -1)
			error.push('Неправильно введен email');
		if ($('#r_phone').val().length != 10 || $('#r_phone').val().search(new RegExp(/\d{10}/, 'g')) == -1) 
			error.push('Телефон должен содержать 10 цифр');
		if ($('#r_pass').val() != $('#r_confirm').val())
			error.push('Пароль не совпадает с подтвержденным паролем');
		if ($('#r_role').val() == 0)
			error.push('Не выбрана желаемая роль');
		if (error.length != 0){
			$('.dialog_error').dialog('option', 'title', 'Ошибка при регистрации').dialog('open');
			$('.ui-dialog-content').empty();
			for (i=0;i<error.length;i++)
				$('.ui-dialog-content').append('<p>'+error[i]+'</p>');
			return false;
		}	
	});
	
	$('#pointer').css({
		left : $('.active').position().left + $('.active').width()/2-10
	}).show();

	$('.title_panel').click(function(){
		if ($(this).next().is(':visible'))
			$(this).next().hide('drop');
		else
			$(this).next().show('drop');
	});


	var textarea = $('.blook_input textarea');
	var hiddendiv = $('.hiddendiv');

	textarea.keyup(function(){
		hiddendiv.html($(this).val().replace(/\n/g, '<br> '));
		$(this).css('height', hiddendiv.outerHeight()-1);
	});


	$('.extra_view .open').click(function(){
		if ($(this).parent().next().is(':visible'))
			$(this).parent().next().hide('drop');
		else
			$(this).parent().next().show('drop');
	});


	$('.open_profile').click(function(){
		if($('.about_profile').is(':visible')){
			$('.about_profile').hide('drop');
		}
		else{
			if ($('.edit_profile').is(':visible'))
				$('.edit_profile').hide('drop');
			$('.about_profile').show('drop');
		}
	});


	$('.edit_profile_but').click(function(){
		$('.about_profile').hide('drop', function(){
			$('.edit_profile').show('drop');
		});
	});

	$('.edit_profile input[type="button"]').click(function(){
		$('.edit_profile').hide('drop', function(){
			$('.about_profile').show('drop');
		});
	});

});