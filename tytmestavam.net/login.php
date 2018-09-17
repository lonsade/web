<?php
	session_start();
	require('query.inc.php');
	require('labs.php');
	//Редирект
	if ($_SERVER['REQUEST_METHOD'] != 'POST') {
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit(0);
	}
	login($mysqli, $_POST['login'], $_POST['password'], $_POST['remember'], true);
	header('Location: '.$_SERVER['HTTP_REFERER']);
	exit(0);
?>