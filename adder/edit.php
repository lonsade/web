<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){

	header('Content-Type: text/html; charset=utf-8');
	require_once 'simple_html_dom.php';
	require_once 'names_and_party_and_type_heroes.php';
	function make_good($string){
		return preg_replace("/  +/"," ",mysql_real_escape_string(trim(strip_tags($string))));
	}

	define("DB_HOST", "localhost");
	define("DB_LOGIN", "root");
	define("DB_PASSWORD", "");
	define("DB_NAME", "dota");

	define("RESOURCE1", "http://dota2.ru");
	define("RESOURCE2", "http://dota2.com");

	$mysqli = mysqli_init();
if (!$mysqli) {
    die('mysqli_init failed');
}
 
if (!$mysqli->options(MYSQLI_INIT_COMMAND, 'SET AUTOCOMMIT = 0')) {
    die('Setting MYSQLI_INIT_COMMAND failed');
}
 
if (!$mysqli->real_connect('localhost', 'root', '', 'dota')) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

	function fetch($query){
		global $mysqli;
		if($result = $mysqli->query($query)){
			$array = array();
			//Выборка данных и помещение их в массив
			while($row = $result->fetch_assoc()){
				$array[] = $row;
			}
			//Очищаем результирующий набор
			$result->close();
			return $array;
		}
	}

	mysql_connect(DB_HOST, DB_LOGIN, DB_PASSWORD) or die(mysql_error());
	mysql_select_db(DB_NAME) or die(mysql_error());

	for ($i=5; $i<515; $i++){
		$arr = fetch("SELECT id, cooldown FROM Skill WHERE id = '".$i."'");
		//print_r($arr);
		if ($arr[0]['cooldown'] != '0'){
			$sql = "UPDATE Skill SET up=1 WHERE id='".$i."'";
			mysql_query($sql) or die(mysql_error());
		}
	}
}
?>
<meta charset="utf-8">
<form action="edit.php" method="POST">
	<input type="submit" value="Отправить">
</form>