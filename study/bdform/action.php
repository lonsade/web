<?php
session_start();
require('query.inc.php');
if($_SERVER['REQUEST_METHOD'] != 'POST'){
	header('Location: index.php');
	exit(0);
}
if(sizeof($_POST) == 0){
	header("Location: index.php");
	exit(0);
}
//Форматирование данных
foreach ($_POST as $key=>$value)
	if (is_array($value))
		foreach ($value as $key2=>$value2)
			$data[$key][$key2] = trim(strip_tags($value2));
	else
		$data[$key] = trim(strip_tags($value));
//Проверка данных
if ($data['nickname']=="" || $data['name']=="" || $data['age']=="" || $data['email']=="" || $data['phone']=="" || $data['rifm']==""){
	header('Location: '.$_SERVER['HTTP_REFERER']);
	exit(0);
}
//Выполнение запросов
$sql = "INSERT INTO Anketa (nickname, name, age, email, phone, achievment, word_id, rifm, to_obscene_id, to_vape_id, user_id) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
if ($stmt = $mysqli->prepare($sql)){
	$stmt->bind_param("ssisssisiii", $data['nickname'], $data['name'], $data['age'], $data['email'], $data['phone'], $data['achievment'], $_SESSION['word'], $data['rifm'], $data['terms'], $data['vape'], $_SESSION['acc']['id']);
	$stmt->execute();
	$id_anketa = $mysqli->insert_id;
	$stmt->close();
	/*if(isset($data['styles'])){
		foreach ($data['styles'] as $value){
			$sql = "INSERT INTO music_style_anketa (anketa_id, music_style_id) VALUES (?,?)";
			if ($stmt = $mysqli->prepare($sql)){
				$stmt->bind_param("ii", $id_anketa, $value);
				$stmt->execute();
				$stmt->close();
			}
		}
	}
	if(isset($data['cultures'])){
		foreach ($data['cultures'] as $value){
			$sql = "INSERT INTO culture_anketa (culture_id, anketa_id) VALUES (?,?)";
			if ($stmt = $mysqli->prepare($sql)){
				$stmt->bind_param("ii", $value, $id_anketa);
				$stmt->execute();
				$stmt->close();
			}
		}
	}*/
}
$_SESSION['request']['message'][] = 'Анкета успешно добавлена';
$_SESSION['request']['title'] = 'Успешно';
//unset($_SESSION['word']);
//header('Location: index.php?id=my');
//exit(0);
echo '<pre>';
print_r($_POST);
?>