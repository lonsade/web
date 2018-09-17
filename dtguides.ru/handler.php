<?php
session_start();
require_once 'query.inc.php';
require_once 'labs.inc.php';
try {
	//Прямое попадание на эту страницу
	if (!$_POST)
		throw new Exception('Ошибка в доступе');
	$address = explode('/', $_POST['url']);
	//Проверка 3 уровня адреса
	if (isset($address[4]))
		throw new Exception('Такой страницы не существует');
	//Проверка названия проекта
	$f = false;
	foreach ($_SESSION['LIST_MENU'] as $key => $el)
		if ($el['id'] == $address[2]){
			$f = true;
			break;
		}
	if (!$f)
		throw new Exception('Ошибка в проекте, а именно проект <span>'.$address[2].'</span> не существует');
	//Проверка подпроекта
	if (isset($address[3])){
		if ($address[2] == 'creating' || $address[2] == 'heroes')
			if (!in_array($address[3], $_SESSION['LIST_HEROES']))
				throw new Exception('Ошибка в герое, а именно герой <span>'.$address[3].'</span> не существует');
		$id = $address[3];
		$ready_title = $_SESSION['LIST_MENU'][$key]['title'].' - '.$address[3];
		include 'templates/'.$address[2].'/next.php';
	}
	else if (isset($address[2])){
		$ready_title = $_SESSION['LIST_MENU'][$key]['title'];
		include 'templates/'.$address[2].'/index.php';
	}
} catch (Exception $e) {
	$error = $e->getMessage();
	echo '<p>'.$error.'</p>';
	$ready_title = 'Ошибка';
}
?>

<script type="text/javascript">
	$ready_title = '<?=$ready_title?>';
	$current_error = '<?=$error?>';
	$current_project = '<?=$address[2]?>';
</script>