<?php
function error_access(){
	global $title, $header, $content;
	$title = 'Ошибка доступа';
	$header = 'У вас нет никаких прав здесь находится, уважайте личное пространство других';
	$content = 'error.inc.php';
}

if (!isset($_GET['id']))
	$_GET['id'] = 'home';

switch ($_GET['id']) {
	case 'home':
		$title = 'Главная страница';
		$header = 'Сайт гострайтинга и не только';
		$content = 'home.inc.php';
		break;
	case 'create':
		if($_SESSION['acc']['role'] == 0 || $_SESSION['acc']['role'] == 2 || $_SESSION['acc']['banned'] != 0){
			error_access();
			$id = 300;
			break;
		}
		$title = 'Создание анкеты';
		$header = 'Выполните пару шагов на пути к своей мечте';
		$content = 'create.inc.php';
		break;
	case 'show':
		if($_SESSION['acc']['role'] == 0 || $_SESSION['acc']['role'] == 1 || $_SESSION['acc']['banned'] != 0){
			error_access();
			$id = 301;
			break;
		}
		$title = 'Все анкеты';
		$header = 'Здесь храняться анкеты великих гострайтеров';
		$content = 'show.inc.php';
		break;
	case 'my':
		if($_SESSION['acc']['role'] == 0 || $_SESSION['acc']['role'] == 2 || $_SESSION['acc']['banned'] != 0){
			error_access();
			$id = 302;
			break;
		}
		$title = 'Мои анкеты';
		$header = 'Здесь храняться мои труды';
		$content = 'my.inc.php';
		break;
	case 'panel':
		if($_SESSION['acc']['role'] == 0 || $_SESSION['acc']['role'] == 2 || $_SESSION['acc']['role'] == 1 || $_SESSION['acc']['banned'] != 0){
			error_access();
			$id = 303;
			break;
		}
		$title = 'Управление';
		$header = 'Все сосредоточено в моих руках';
		$content = 'panel.inc.php';
		break;
	default:
		$title = 'Ошибка';
		$header = 'Такой страницы не существует';
		$id = 404;
		$content = 'error.inc.php';
}
?>
