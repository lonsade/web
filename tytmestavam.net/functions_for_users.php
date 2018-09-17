<?php
session_start();
include 'query.inc.php';
include 'labs.php';

if ($_SESSION['acc']['role'] == 0 || $_SESSION['acc']['banned'] != 0){
	$_SESSION['request']['message'][] = 'Ууу, не туда ты полез паренек';
	$_SESSION['request']['title'] = 'Неудачно';
	header('Location: '.$_SERVER['HTTP_REFERER']);
	exit(0);
}

if ($_SESSION['acc']['role'] != 0 && $_SESSION['acc']['role'] != 2){
	if ($_SESSION['acc']['role'] == 1)
		if (isset($_GET['id']) && !in_array($_GET['id'], $_SESSION['id_ankets'])){
			$_SESSION['request']['message'][] = 'У вас нет доступа к анкете #'.$_GET['id'];
			$_SESSION['request']['title'] = 'Ошибка доступа';
		}
	switch ($_GET['act']) {
		case 'edit':
			$_SESSION['edit'] = get_ankets($mysqli, false, $_GET['id']);
			header('Location: index.php?id=create');
			exit();
			break;
		case 'delete':
			delete_anketa($mysqli, $_GET['id']);
			$_SESSION['request']['message'][] = 'Анкета #'.$_GET['id'].' успешно удалена';
			$_SESSION['request']['title'] = 'Успешно';
			break;
		case 'cancel':
			unset($_SESSION['edit']);
			$_SESSION['request']['message'][] = 'Анкета #'.$_GET['id'].' не была изменена';
			$_SESSION['request']['title'] = 'Отмена';
			header('Location: index.php?id=my');
			exit();
			break;
		default:
			# code...
			break;
	}

	unset($_SESSION['id_ankets']);
}
header('Location: '.$_SERVER['HTTP_REFERER']);
exit(0);
?>