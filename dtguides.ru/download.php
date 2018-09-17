<?php

//Данные
define("DB_HOST", "localhost");
define("DB_LOGIN", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "dota");
//Запрос в базу
$_SESSION['link'] = new mysqli(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME);
//Проверка подключения
if ($_SESSION['link']->connect_error)
	exit(0);


$sql = "SELECT name, image FROM Item";
if ($stmt = $_SESSION['link']->prepare($sql)){
	$stmt->execute();
	$res = $stmt->get_result();
	while ($row = $res->fetch_assoc()){
		$url = $row['image'];
		$path = './images/items/'.str_replace(' ', '_', strtolower($row['name'])).'.png';

		$real_url = '/dtguides.ru/images/items/'.str_replace(' ', '_', strtolower($row['name'])).'.png';

		$sql = "UPDATE Item SET image = ? WHERE name = ?";
		if ($stmt1 = $_SESSION['link']->prepare($sql)){
			$stmt1->bind_param('ss', $real_url, $row['name']);
			$stmt1->execute();

		}

		//file_put_contents($path, file_get_contents($url));
	}
}
$stmt->close();


?>