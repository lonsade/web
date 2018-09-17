<?php
	session_start();
	require('query.inc.php');
	//Редирект
	if ($_SERVER['REQUEST_METHOD'] != 'POST') {
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit(0);
	}
	//Проверка логина и одновременно выборка пароля
	$sql = "SELECT password FROM User WHERE login = ?";
	if ($stmt = $mysqli->prepare($sql)){
		$stmt->bind_param('s', $_POST['login']);
		$stmt->execute();
		$stmt->bind_result($password);
		$stmt->fetch();
		$stmt->close();
		//Проверка пароля и существования логина
		if (!$password || !password_verify($_POST['password'], $password)){
			$_SESSION['login_error'] = true;
			header('Location: '.$_SERVER['HTTP_REFERER']);
			exit(0);
		}
		//Данные прошли авторизацию
		$sql = "SELECT id, role, email, phone FROM User WHERE login = ?";
		if ($stmt = $mysqli->prepare($sql)){
			$stmt->bind_param('s', $_POST['login']);
			$stmt->execute();
			$stmt->bind_result($id, $role, $email, $phone);
			$stmt->fetch();
			$stmt->close();
			$_SESSION['acc']['id'] = $id;
			$_SESSION['acc']['login'] = $_POST['login'];
			$_SESSION['acc']['role'] = $role;
			$_SESSION['acc']['email'] = $email;
			$_SESSION['acc']['phone'] = $phone;
			$_SESSION['entered'] = true;
		}
	}
	header('Location: '.$_SERVER['HTTP_REFERER']);
	exit(0);
?>