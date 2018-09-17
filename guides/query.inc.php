<?php
	//Данные
	define("DB_HOST", "localhost");
	define("DB_LOGIN", "root");
	define("DB_PASSWORD", "");
	define("DB_NAME", "dota");
	//Запрос в базу
	$_SESSION['link'] = new mysqli(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME);
	//Проверка подключения
	if ($mysqli->connect_error)
		exit(0);
?>