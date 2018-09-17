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

$sql = "SELECT info FROM Skill WHERE id = ?";
if ($stmt = $_SESSION['link']->prepare($sql)){
	$stmt->bind_param("i", $i);
	for ($i = 5; $i <= 513; $i++){
		if($stmt->execute()){
			$res = $stmt->get_result();
			$row = $res->fetch_assoc();
			if (isset($row)){
				$row['info'] = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $row['info']);
				$row['info'] = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $row['info']);
				preg_match('/Способность: \W{1,}&/', $row['info'], $type);
				$type[0] = substr($type[0], 0, -1);
				$types = explode('&', $type[0]);
				$ready = '';
				foreach ($types as $key=>$value){
					$types[$key] = trim($value);
					$ready .= $types[$key] . '&';
				}
				$ready = substr($ready, 0, -1);
				$sql = "UPDATE Skill SET text_info = ? WHERE id = ?";
				if ($stmt2 = $_SESSION['link']->prepare($sql)){
					$stmt2->bind_param("si", $ready, $i);
					$stmt2->execute();
					$stmt2->close();
				}
				$other = preg_split('/Способность: \W{1,}&/', $row['info'], -1, PREG_SPLIT_NO_EMPTY);
				$other[0] = strtoupper($other[0]);
				$chars = explode('&', $other[0]);
				mb_internal_encoding("UTF-8");
				foreach ($chars as $key=>$value){
					$chars[$key] = trim(mb_strtolower($value));
					$chars[$key] = mb_strtoupper(mb_substr($chars[$key], 0, 1)) . mb_substr($chars[$key], 1);
					if (is_numeric(substr($chars[$key], 0, 1))){
						$chars[$key-1] .= ' '.$chars[$key];
						$chars[$key] = '';
					}
				}
				foreach ($chars as $key=>$value){
					if ($value == '')
						unset($chars[$key]);
				}
				$ready = '';
				foreach ($chars as $key=>$value){
					$chars[$key] = trim($value);
					$ready .= $chars[$key] . '&';
				}
				$ready = substr($ready, 0, -1);
				$sql = "UPDATE Skill SET int_info = ? WHERE id = ?";
				if ($stmt2 = $_SESSION['link']->prepare($sql)){
					$stmt2->bind_param("si", $ready, $i);
					$stmt2->execute();
					$stmt2->close();
				}
			}
		}
	}
	$stmt->close();
}

?>