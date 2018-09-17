<?php
session_start();
require('query.inc.php');
//Редирект
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
	header('Location: '.$_SERVER['HTTP_REFERER']);
	exit(0);
}
//Для автокомплита в случае ошибок
$_SESSION['prev'] = $_POST;
//Проверка данных
if ($_POST['login'] == '' || strlen($_POST['login']) > 15)
	$_SESSION['request']['message'][] = 'Логин не должен быть пустым и его длина не должна первышать 15 символов';
if ($_POST['password'] == '' || strlen($_POST['password']) > 25)
	$_SESSION['request']['message'][] = 'Пароль должен быть не меньше 6 и не больше 25 символов';
if ($_POST['email'] == '' || strlen($_POST['email']) > 150 || !preg_match('/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/', $_POST['email']))
	$_SESSION['request']['message'][] = 'Неправильно введен email';
if (strlen($_POST['phone']) != 10 || !preg_match('/\d{10}/', $_POST['phone'])) 
	$_SESSION['request']['message'][] = 'Телефон должен содержать 10 цифр';
if ($_POST['password'] != $_POST['confirm'])
	$_SESSION['request']['message'][] = 'Пароль не совпадает с подтвержденным паролем';
if ($_POST['role'] == 0)
	$_SESSION['request']['message'][] = 'Не выбрана желаемая роль';
if (isset($_SESSION['request']['message'])){
	if (isset($_POST['password']))
		unset($_POST['password']);
	if (isset($_POST['confirm']))
		unset($_POST['confirm']);
	$_SESSION['request']['title'] = 'Ошибка регистрации';
	header('Location: '.$_SERVER['HTTP_REFERER']);
	exit(0);
}
//Форматирование данных
unset($_POST['confirm']);
foreach ($_POST as $key => $value)
	if ($key == 'password')
		$data['password'] = password_hash(trim($value), PASSWORD_DEFAULT);
	else
		$data[$key] = trim(strip_tags($value));

///Проверка на дубликат логина
$sql = "SELECT login FROM User WHERE login = ?";
if ($stmt = $mysqli->prepare($sql)){
	$stmt->bind_param('s', $data['login']);
	$stmt->execute();
	$stmt->bind_result($login);
	$stmt->fetch();
	$stmt->close();
}
if ($data['login'] == $login){
	$_SESSION['request']['message'][] = 'Такой логин уже существует';
	$_SESSION['request']['title'] = 'Ошибка регистрации';
}

///Проверка на дубликат email
$sql = "SELECT email FROM User WHERE email = ?";
if ($stmt = $mysqli->prepare($sql)){
	$stmt->bind_param('s', $data['email']);
	$stmt->execute();
	$stmt->bind_result($email);
	$stmt->fetch();
	$stmt->close();
}
if ($data['email'] == $email){
	$_SESSION['request']['message'][] = 'Данная почта занята';
	$_SESSION['request']['title'] = 'Ошибка регистрации';
}

//Отправка данных
if (!isset($login) && !isset($email)){
	//Формирование сессии с инфой о юзере
	$banned = '1';
	$sql = "INSERT INTO User (login, password, email, phone, role, banned) VALUES (?,?,?,?,?,?)";
	if ($stmt = $mysqli->prepare($sql)){
		$stmt->bind_param("ssssss", $data['login'], $data['password'], $data['email'], $data['phone'], $data['role'], $banned);
		$stmt->execute();
		$stmt->close();
		$_SESSION['acc']['id'] = $mysqli->insert_id;
		$_SESSION['acc']['login'] = $data['login'];
		$_SESSION['acc']['role'] = $data['role'];
		$_SESSION['acc']['email'] = $data['email'];
		$_SESSION['acc']['phone'] = $data['phone'];
		$_SESSION['entered'] = true;
	}
}
header('Location: '.$_SERVER['HTTP_REFERER']);
exit(0);
?>