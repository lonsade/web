<?php
	include('query.inc.php');
	$error = 0;
	$login = trim(strip_tags($_POST['login']));
	$pass = $_POST['pass'];
	$confirm = $_POST['confirm'];
	$email = trim($_POST['email']);
	$hash = password_hash($pass, PASSWORD_DEFAULT);
	$sql = "INSERT INTO User (name, login, pass, email) VALUES (?, ?, ?, ?)";
	print_r($_POST);
	if ($stmt = $_SESSION['link']->prepare($sql)){
		$stmt->bind_param("ssss", $login, $login, $hash, $email);
		$stmt->execute();
		$stmt->close();
	}
?>