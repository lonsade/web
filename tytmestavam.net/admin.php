<?php

session_start();
include('query.inc.php');
include('labs.php');

if ($_SESSION['acc']['level'] == 0 || $_SESSION['acc']['banned'] != 0){
	$_SESSION['request']['message'][] = 'Ууу, не туда ты полез паренек';
	$_SESSION['request']['title'] = 'Неудачно';
	header('Location: '.$_SERVER['HTTP_REFERER']);
	exit(0);
}

if ($_GET['act']){
	$act_was = false;
	$user = get_user_passport($mysqli, $_GET['user']);
	switch ($_GET['act']) {
		case 'verify':
			if ($_GET['user'] && $_SESSION['acc']['level'] > $user['level']){
				update_user_ban($mysqli, $_GET['user'], '0');
				$_SESSION['request']['message'][] = 'Пользователь с id '.$_GET['user'].' успешно верифицирован';
				$_SESSION['request']['title'] = 'Успешно';
				$act_was = true;
			}
			break;
		case 'ban':
			if ($_GET['user'] && $_SESSION['acc']['level'] > $user['level']){
				update_user_ban($mysqli, $_GET['user'], '2');
				$_SESSION['request']['message'][] = 'Пользователь с id '.$_GET['user'].' успешно забанен';
				$_SESSION['request']['title'] = 'Успешно';
				$act_was = true;
			}
			break;
		case 'unban':
			if ($_GET['user'] && $_SESSION['acc']['level'] > $user['level']){
				update_user_ban($mysqli, $_GET['user'], '1');
				$_SESSION['request']['message'][] = 'Пользователь с id '.$_GET['user'].' успешно восстановлен';
				$_SESSION['request']['title'] = 'Успешно';
				$act_was = true;
			}
			break;
		case 'unverify':
			if ($_GET['user'] && $_SESSION['acc']['level'] > $user['level']){
				update_user_ban($mysqli, $_GET['user'], '1');
				$_SESSION['request']['message'][] = 'Пользователь с id '.$_GET['user'].' успешно отправился к неверифицированным';
				$_SESSION['request']['title'] = 'Успешно';
				$act_was = true;
			}
			break;
		case 'makeadmin':
			if ($_GET['user'] && $_SESSION['acc']['level'] > $user['level'] && $_SESSION['acc']['level'] > 1){
				update_user_role($mysqli, $_GET['user'], '3', $_SESSION['acc']['level']);
				$_SESSION['request']['message'][] = 'Пользователь с id '.$_GET['user'].' успешно отправился к элите';
				$_SESSION['request']['title'] = 'Успешно';
				$act_was = true;
			}
			break;
		case 'makecommon':
			if ($_GET['user'] && $_SESSION['acc']['level'] > $user['level'] && $_SESSION['acc']['level'] > 1){
				update_user_common($mysqli, $_GET['user']);
				$_SESSION['request']['message'][] = 'Пользователь с id '.$_GET['user'].' успешно отправился к низшим';
				$_SESSION['request']['title'] = 'Успешно';
				$act_was = true;
			}
			break;
		default:
			$_SESSION['request']['message'][] = 'Операции '.$_GET['act'].' не сущеcтвует';
			$_SESSION['request']['title'] = 'Ошибка';
			break;
	}
	if (!$act_was){
		$_SESSION['request']['message'][] = 'Вы нарушаете целостность системы';
		$_SESSION['request']['title'] = 'Выход за границу';
	}
}

header('Location: '.$_SERVER['HTTP_REFERER']);
exit(0);

?>