<?php
session_start();
if ($_SESSION['acc']['role'] == 0 || $_SESSION['acc']['role'] == 2 || $_SESSION['acc']['banned'] != 0){
	$_SESSION['request']['message'][] = 'Ууу, не туда ты полез паренек';
	$_SESSION['request']['title'] = 'Неудачно';
	unset($_SESSION['word']);
	unset($_SESSION['edit']);
	header('Location: '.$_SERVER['HTTP_REFERER']);
	exit(0);
}
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
			$data[$key][$key2] = $value2;
	else
		$data[$key] = trim(strip_tags($value));
//Проверка данных
if ($data['nickname']=="" || $data['name']=="" || $data['age']=="" || $data['email']=="" || $data['phone']=="" || $data['rifm']==""){
	header('Location: '.$_SERVER['HTTP_REFERER']);
	exit(0);
}

//Выполнение запросов
if (isset($_SESSION['edit']))
	$sql = "UPDATE Anketa SET nickname = ?, name = ?, age = ?, email =?, phone = ?, achievment = ?, word_id = ?, rifm = ?, to_obscene_id = ?, to_vape_id = ?, user_id = ? WHERE id = ".$_SESSION['edit'][0]['id'];
else	
	$sql = "INSERT INTO Anketa (nickname, name, age, email, phone, achievment, word_id, rifm, to_obscene_id, to_vape_id, user_id) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
if ($stmt = $mysqli->prepare($sql)){
	$stmt->bind_param("ssisssisiii", $data['nickname'], $data['name'], $data['age'], $data['email'], $data['phone'], $data['achievment'], $_SESSION['word']['id'], $data['rifm'], $data['terms'], $data['vape'], $_SESSION['acc']['id']);
	$stmt->execute();
	$stmt->close();
	//Удаление данных и связывающих таблиц
	if (isset($_SESSION['edit'])){
		$id_anketa = $_SESSION['edit'][0]['id'];
		$sql = "DELETE FROM culture_anketa WHERE anketa_id = ?";
		if ($stmt = $mysqli->prepare($sql)){
			$stmt->bind_param("i", $id_anketa);
			$stmt->execute();
			$stmt->close();
			$sql = "DELETE FROM music_style_anketa WHERE anketa_id = ?";
			if ($stmt = $mysqli->prepare($sql)){
				$stmt->bind_param("i", $id_anketa);
				$stmt->execute();
				$stmt->close();
			}
		}
	}
	else
		$id_anketa = $mysqli->insert_id;
	if(isset($data['styles'])){
		foreach ($data['styles'] as $value){
			$sql = "INSERT INTO music_style_anketa (music_style_id, anketa_id) VALUES (?,?)";
			if ($stmt = $mysqli->prepare($sql)){
				$stmt->bind_param("ii", $value, $id_anketa);
				$stmt->execute();
				$mysqli->error;
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
				$mysqli->error;
				$stmt->close();
			}
		}
	}
}
if (isset($_SESSION['edit'])){
	unset($_SESSION['edit']);
	$_SESSION['request']['message'][] = 'Анкета #'.$id_anketa.' успешно изменена';
}
else
	$_SESSION['request']['message'][] = 'Анкета успешно добавлена';
$_SESSION['request']['title'] = 'Успешно';
unset($_SESSION['word']);
header('Location: index.php?id=my');
exit(0);
?>