<?php
	session_start();
	setcookie('login', $_POST['login'],  time()+60*60*24*30);
	require "query.inc.php";
	require "labs.inc.php";
	$users = getUsers();
	$ok = true;
	$error = '';
	$numerror = 1;
	//Проверка длины логина или пароля
	if(!(strlen($_POST['login']) >= 3) || !(strlen($_POST['login']) <= 15) || !(strlen($_POST['pass']) >= 6) || !(strlen($_POST['pass']) <= 30)){
		$error .= $numerror . ')Минимальное количество введенных символов для логина - 3, для пароля - 6<br>';
		$numerror++;
		$ok = false;
	}
	//Провека валидности логина
	if (!empty($users))
	{
		foreach($users as $user){
			if(strtolower($user['login']) === strtolower($_POST['login'])){
				$error .= $numerror . ')Такой логин уже существует<br>';
				$numerror++;
				$ok = false;
				continue;
			}
		}
	}
	//Провека на требуемые вводимые символы
	preg_match("/[a-zA-Z0-9]+/", $_POST['login'], $username);
	preg_match("/[a-zA-Z0-9]+/", $_POST['pass'], $pass);
	if($username[0] !== $_POST['login'] || $pass[0] !== $_POST['pass']){
		$error .= $numerror . ')Логин и пароль должны содержать только: буквы английского алфавита, цифры от 0 до 9<br>';
		$numerror++;
		$ok = false;
	}
	//Отправка данных
	if($ok){
		$sql = "INSERT INTO users(login, password) VALUES('".$_POST['login']."', '".md5($_POST['pass'])."')";
		$_SESSION['link']->query($sql);
		echo $_POST['login'];
	}else{
		setcookie('login', '');
		echo $error;
	}
?>