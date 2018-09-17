<?php
	session_start();
	require "../../query.inc.php";
	require "../../labs.inc.php";

	define(CHARSET, 'UTF-8');

	$hero = trim(strip_tags($_POST['hero']));
	$levels = trim(strip_tags($_POST['levels']));
	$about = trim(strip_tags($_POST['info']));
	$name = trim(strip_tags($_POST['name']));

	$user = 1;
	$patch = '6.88';
	$views = 0;
	$date = date("Y-m-d H:i:s");

	//////////Обработка ошибок//////////

	$heroes = get_heroes_list();
	$items = get_id_items();

	$type_error = array();

	//Проверка названия
	if (mb_strlen($name, CHARSET) == 0 || mb_strlen($name, CHARSET) > 40)
		$type_error[] = 1;
	//Проверка количества прокаченных левелов
	if (mb_strlen($levels, CHARSET) != 25)
		$type_error[] = 2;
	//Проверка информации о гайде
	if (mb_strlen($about, CHARSET) == 0 || mb_strlen($about, CHARSET) > 300)
		$type_error[] = 3;
	//Проверка, что название героя не менялось
	if (!in_array($hero, $heroes))
		$type_error[] = 4;

	//Проверка, что количество стезий соответствует интервалу
	if (count($_POST['items']) > 1 && count($_POST['items']) < 6)
		foreach ($_POST['items'] as $stage_id=>$stage){
			$stage_name = trim(strip_tags($stage['name']));
			//Проверка имен стезий
			if ((mb_strlen($stage_name, CHARSET) == 0 || mb_strlen($stage_name, CHARSET) > 20) && !in_array(5, $type_error))
				$type_error[] = 5;
			foreach ($stage as $place=>$id_item){
				if ($place != 'name'){
					//Проверка идентификаторов предметов
					if (!in_array($id_item, $items) && !in_array(7, $type_error))
						$type_error[] = 7;
					//Проерка номеров мест под предметы
					if (($place < 1 || $place > 12) && !in_array(8, $type_error))
						$type_error[] = 8;
				}
			}
		}
	else{
		$type_error[] = 6;
	}

	if (!in_array(4, $type_error)){
		$skills = get_id_skills($hero);
		foreach ($_POST['skills'] as $id_skill=>$about){
			//Проверка комментарий
			if ((mb_strlen($about, CHARSET) == 0 || mb_strlen($about, CHARSET) > 150) && !in_array(9, $type_error))
				$type_error[] = 9;
			//Проверка идентификаторов скиллов
			if (!in_array($id_skill, $skills)  && !in_array(10, $type_error))
				$type_error[] = 10;
			if (in_array(9, $type_error) && in_array(10, $type_error))
				break;
		}
	}

	if (!in_array(2, $type_error))
		for ($i=0;$i<count($levels);$i++)
			//Проверка номеров последовательностей прокачки левелов
			if ($levels[$i] < '1' || $levels[$i] > '5'){
				$type_error[] = 11;
				break;
			}
	
	//////////Отправка данных//////////

	if (!$type_error){
		$sql = "INSERT INTO Guide (title, about, levels, Hero_name, patch, User_id, views, date_t) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
		if ($stmt = $_SESSION['link']->prepare($sql)){
			$stmt->bind_param("sssssiis", $name, $about, $levels, $hero, $patch, $user, $views, $date);
			$stmt->execute();
			$stmt->close();
			$id_guide = $_SESSION['link']->insert_id;
			$sql = "INSERT INTO Items_for_guide (Guide_id, Item_id, stage_id, stage_name, place) VALUES (?, ?, ?, ?, ?)";
			if ($stmt = $_SESSION['link']->prepare($sql)){
				$stmt->bind_param('iiisi', $id_guide, $id_item, $stage_id, $stage_name, $place);
				foreach ($_POST['items'] as $stage_id=>$stage){
					$stage_name = trim(strip_tags($stage['name']));
					foreach ($stage as $place=>$id_item){
						$stmt->execute();
					}
				}
				$stmt->close();
				$sql = "INSERT INTO Skills_for_guide (Guide_id, Skill_id, about) VALUES (?, ?, ?)";
				if ($stmt = $_SESSION['link']->prepare($sql)){
					$stmt->bind_param('iis', $id_guide, $id_skill, $about);
					foreach ($_POST['skills'] as $id_skill=>$about){
						$stmt->execute();
					}
					$stmt->close();
				}
				else
					$type_error[] = 100;
			}
			else
				$type_error[] = 100;
		}
		else
			$type_error[] = 100;
	}

	$titles_error = array(
		1=>'Неправильное название',
		2=>'Не все левела прокачены',
		3=>'Неправильное описание',
		4=>'Не меняйте имя выбранному герою',
		5=>'Неправильное имя стези',
		6=>'Минимальное количество стезий - две',
		7=>'Не меняйте идентификаторы выбранных предметов',
		8=>'Не меняйте номера мест для предметов',
		9=>'Неправильные комментарии',
		10=>'Не меняйте идентификаторы скиллов',
		11=>'Не меняйте номера последовательностей прокачки скиллов',
		100=>'Ошибка сервера'
	);

?>
<div id="error_dialog" title="Error">
<?foreach($type_error as $i=>$error):?>
	<p>#<?=$i?> <?=$titles_error[$error]?></p>
<?endforeach;?>
</div>
<script type="text/javascript">
	$('#error_dialog').dialog();
</script>