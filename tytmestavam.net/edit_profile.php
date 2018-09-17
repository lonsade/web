<?php
session_start();
require('query.inc.php');
//Редирект
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
	header('Location: '.$_SERVER['HTTP_REFERER']);
	exit(0);
}

if ($_SESSION['acc']['role'] == 0 || $_SESSION['acc']['banned'] == 2){
	$_SESSION['request']['message'][] = 'Ууу, не туда ты полез паренек';
	$_SESSION['request']['title'] = 'Неудачно';
	header('Location: '.$_SERVER['HTTP_REFERER']);
	exit(0);
}

$sql = "SELECT password FROM user WHERE id = ".$_SESSION['acc']['id'];
if ($stmt = $mysqli->prepare($sql)){
	$stmt->execute();
	$stmt->bind_result($password);
	$stmt->fetch();
	$stmt->close();
	//Проверка пароля и существования логина
	if (!$password || !password_verify($_POST['password'], $password)){
		$_SESSION['request']['message'][] = 'Неверный пароль';
		$_SESSION['request']['title'] = 'Ошибка подтверждения';
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit(0);
	}

	//Проверка данных
	if ($_POST['login'] == '' || strlen($_POST['login']) > 15)
		$_SESSION['request']['message'][] = 'Логин не должен быть пустым и его длина не должна первышать 15 символов';
	if ($_POST['email'] == '' || strlen($_POST['email']) > 150 || !preg_match('/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/', $_POST['email']))
		$_SESSION['request']['message'][] = 'Неправильно введен email';
	if (strlen($_POST['phone']) != 10 || !preg_match('/\d{10}/', $_POST['phone'])) 
		$_SESSION['request']['message'][] = 'Телефон должен содержать 10 цифр';
	if ($_POST['new_password'] != '')
		if (strlen($_POST['new_password']) > 25)
			$_SESSION['request']['message'][] = 'Новый пароль должен быть не меньше 6 и не больше 25 символов';
	if (isset($_SESSION['request']['message'])){
		$_SESSION['request']['title'] = 'Ошибка изменения';
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit(0);
	}

	//Форматирование данных
	foreach ($_POST as $key => $value)
		if ($key == 'password')
			$data['password'] = password_hash(trim($value), PASSWORD_DEFAULT);
		else
			$data[$key] = trim(strip_tags($value));

	///Проверка на дубликат логина
	$sql = "SELECT login FROM User WHERE login = ? AND id<>".$_SESSION['acc']['id'];
	if ($stmt = $mysqli->prepare($sql)){
		$stmt->bind_param('s', $data['login']);
		$stmt->execute();
		$stmt->bind_result($login);
		$stmt->fetch();
		$stmt->close();
	}
	if ($data['login'] == $login){
		$_SESSION['request']['message'][] = 'Такой логин уже существует';
		$_SESSION['request']['title'] = 'Ошибка изменения';
	}

	///Проверка на дубликат email
	$sql = "SELECT email FROM User WHERE email = ? AND id<>".$_SESSION['acc']['id'];
	if ($stmt = $mysqli->prepare($sql)){
		$stmt->bind_param('s', $data['email']);
		$stmt->execute();
		$stmt->bind_result($email);
		$stmt->fetch();
		$stmt->close();
	}
	if ($data['email'] == $email){
		$_SESSION['request']['message'][] = 'Данная почта занята';
		$_SESSION['request']['title'] = 'Ошибка изменения';
	}


	if (!isset($login) && !isset($email)){
		if ($_POST['new_password'] != ''){
			$sql = "UPDATE user SET login = ?, email = ?, phone = ?, password = ? WHERE id = ".$_SESSION['acc']['id'];
			$password = password_hash(trim($_POST['new_password']), PASSWORD_DEFAULT);
		}
		else
			$sql = "UPDATE user SET login = ?, email = ?, phone = ? WHERE id = ".$_SESSION['acc']['id'];
		if ($stmt = $mysqli->prepare($sql)){
			if ($_POST['new_password'] != '')
				$stmt->bind_param('ssss', $data['login'], $data['email'], $data['phone'], $password);
			else
				$stmt->bind_param('sss', $data['login'], $data['email'], $data['phone']);
			$stmt->execute();
			$_SESSION['acc']['login'] = $data['login'];
			$_SESSION['acc']['email'] = $data['email'];
			$_SESSION['acc']['phone'] = $data['phone'];
		}
		$_SESSION['request']['message'][] = 'Профиль успешно изменен';
		$_SESSION['request']['title'] = 'Успешно';
	}
	header('Location: '.$_SERVER['HTTP_REFERER']);
	exit(0);
}
?>