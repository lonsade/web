<?php
	session_start();
	if (!isset($_POST['hash']))
		exit(0);
	require "query.inc.php";
	require "labs.inc.php";
	$progects = get_progects();

	$titles = get_titles();

	$address = substr($_POST['hash'], 1);
	$project = explode(">", $address);

	$type_error = 0;
	$error = false;

	///Обработка проектов

	if (!isset($progects[$project[0]]))
		//Проект не существует
		$type_error = 1;
	else{
		if (!isset($project[1])){
			//Открыта главная страница проекта
			include 'templates/'.$project[0].'/index.php';
			$ready_title = $titles[$project[0]];
		}
		else{
			//Идентификатор подпроекта
			$id = $project[1];
			switch ($project[0]){
			 	case 'all':
			 		$id_guides = get_id_guides();
			 		if (!in_array($id, $id_guides))
			 			//Не найден гайд
						$type_error = 2;
					else
						$ready_title = 'Гайд #'.$id;
			 		break;
			 	case 'creating':
			 		$heroes = get_heroes_list();
			 		if (!in_array($id, $heroes))
			 			//Не найден герой
						$type_error = 3;
					else{
						$title_id = str_replace("'", '', $id);
						$ready_title = "Создание гайда на ".$title_id;
					}
			 		break;
			 	case 'my':
			 		$id_guides = get_id_guides();
			 		if (!in_array($id, $id_guides))
			 			//Не найден гайд
						$type_error = 4;
					else
						$ready_title = 'Мой гайд #'.$id;
			 		break;
			 	case 'heroes':
			 		$heroes = get_heroes_list();
			 		if (!in_array($id, $heroes))
			 			//Не найден герой
						$type_error = 5;
					else{
						$title_id = str_replace("'", '', $id);
						$ready_title = $title_id;
					}
			 		break;
			 	default:
			 		//Ошибка сервера (маловероятна)
			 		$type_error = 6;
			 }
			 if (!$type_error)
			 	//Подключение нужного подпроекта
			 	include 'templates/'.$project[0].'/next.php';
		}
	}
	//Вывод ошибки
	if($type_error){
		include 'error.inc.php';
		$ready_title = 'Ошибка';
		$error = true;
	}
?>
<script type="text/javascript">
	<?if(!$type_error):?>
	ready_project = '<?=$project[0]?>';
	<?endif;?>
	ready_title = '<?=$ready_title?>';
	error = '<?=$error?>';
</script>