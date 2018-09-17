<?php
	$time = ($_POST['remember'] == 1)? time()+60*60*24*30: 0;
	setcookie('login', $_POST['login'], $time);
	require "query.inc.php";
	require "labs.inc.php";
	$user = getUser($_POST['login']);
	if($user[0]['login'] !== $_POST['login'] || $user[0]['password'] != md5($_POST['pass'])){
		setcookie('login', '');
		echo 0;
	}else{
		echo $user[0]['login'];
	}
?>