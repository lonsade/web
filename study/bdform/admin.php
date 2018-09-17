<?php

session_start();
include('query.inc.php');
include('labs.php');

//Набор функций для создателя
if ($_SESSION['acc']['role'] == 4){

	switch ($_GET['act']) {
		case 'verify':
			if ($_GET['user'])
				update_user_ban($mysqli, $_GET['user'], '0');
			$_SESSION['request']['message'][] = 'Пользователь с id '.$_GET['user'].' успешно верифицирован';
			$_SESSION['request']['title'] = 'Успешно';
			break;
		case 'ban':
			if ($_GET['user'])
				update_user_ban($mysqli, $_GET['user'], '2');
			$_SESSION['request']['message'][] = 'Пользователь с id '.$_GET['user'].' успешно забанен';
			$_SESSION['request']['title'] = 'Успешно';
			break;
		default:
			# code...
			break;
	}

}
//Набор функций для админа
else if ($_SESSION['acc']['role'] == 3){
	
}

header('Location: '.$_SERVER['HTTP_REFERER']);
exit(0);

?>