<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	define("DB_HOST", "localhost");
	define("DB_LOGIN", "root");
	define("DB_PASSWORD", "");
	define("DB_NAME", "dota");
	
	mysql_connect(DB_HOST, DB_LOGIN, DB_PASSWORD) or die(mysql_error());
	mysql_select_db(DB_NAME) or die(mysql_error());

	$sql = 'CREATE TABLE Hero(id INT, name TINYTEXT, role TINYTEXT ,fight TINYTEXT ,strength INT ,agility INT ,intellect INT ,damage TINYTEXT ,armor TINYTEXT ,move_speed INT ,fight_speed INT ,distance_vision TINYTEXT ,biograph TEXT ,image TINYTEXT) ;';
	//CREATE TABLE Skill(id INT ,name TINYTEXT ,about TEXT ,extra_about TEXT ,cooldown TINYTEXT ,manacost TINYTEXT ,info TEXT ,image TINYTEXT ,Hero_id INT) ;

	mysql_query($sql) or die(mysql_error());
}
?>
<meta charset="utf-8">
<form action="" method="POST">
<input type="submit" value="Создать бд">
</form>