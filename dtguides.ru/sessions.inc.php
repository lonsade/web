<?php
//Получения списка меню
$_SESSION['LIST_MENU'] = array(
	array(
		'id' => 'creating',
		'name' => 'Создать гайд',
		'title' => 'Создание гайда'
	),
	array(
		'id' => 'my',
		'name' => 'Мои гайды',
		'title' => 'Мои гайды'
	),
	array(
		'id' => 'all',
		'name' => 'Все гайды',
		'title' => 'Все гайды'
	),
	array(
		'id' => 'heroes',
		'name' => 'Герои',
		'title' => 'Герои'
	)
);
//Получение списка героев
function get_heroes_list(){
	$sql = "SELECT name FROM Hero";
	if ($stmt = $_SESSION['link']->prepare($sql)){
		$stmt->execute();
		$stmt->bind_result($name);
		while ($stmt->fetch())
			$result[] = $name;
		$stmt->close();
		return $result;
	}
}
$_SESSION['LIST_HEROES'] = get_heroes_list();
?>