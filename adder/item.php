<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){

	header('Content-Type: text/html; charset=utf-8');
	require_once 'simple_html_dom.php';
	require_once 'names_and_party_and_type_heroes.php';
	function make_good($string){
		return preg_replace("/  +/"," ",mysql_real_escape_string(trim(strip_tags($string))));
	}

	define("DB_HOST", "localhost");
	define("DB_LOGIN", "root");
	define("DB_PASSWORD", "");
	define("DB_NAME", "dota");

	define("RESOURCE1", "http://dota2.ru");
	define("RESOURCE2", "http://dota2.com");

	mysql_connect(DB_HOST, DB_LOGIN, DB_PASSWORD) or die(mysql_error());
	mysql_select_db(DB_NAME) or die(mysql_error());

	$html = file_get_html("http://dota2.ru/items/");
	if(count($html->find('.p-content')))
		foreach($html->find('.p-content') as $div)
			$content = $div->innertext;
	$dom = str_get_html($content);

	foreach($dom->find('.item') as $div){
		foreach($div->find('.icon img') as $d1)
			$type = make_good($d1->title);
		foreach ($div->find('a') as $a){

			if ($_POST['1']){
				foreach ($a->find('.tooltipe') as $img)
					$image = RESOURCE1.make_good($img->src);
				foreach ($a->find('.title') as $div1)
					$title = make_good($div1->innertext);
				foreach ($a->find('.cost') as $div1)
					$cost = make_good($div1->innertext);
				foreach ($a->find('.desctitrion') as $div1)
					$desctitrion = make_good($div1->innertext);
				foreach ($a->find('.attributes') as $div1)
					$attributes = make_good($div1->innertext);
				$manacost = -1;
				foreach ($a->find('.mana-cooldown .mana') as $div1)
					$manacost = make_good(preg_replace("/[^0-9]/", '', $div1->innertext));
				$cooldown = -1;
				foreach ($a->find('.cooldown') as $div1)
					$cooldown = make_good(preg_replace("/[^0-9]/", '', $div1->innertext));
				foreach ($a->find('.lore') as $div1)
					$extra = make_good(str_replace('<br>', '&', $div1->innertext));
				$sql = "INSERT INTO Item(name, description, type, image, cost, attributes, manacost, cooldown, extra_about) VALUES('".$title."', '".$desctitrion."', '".$type."', '".$image."', '".$cost."', '".$attributes."', '".$manacost."', '".$cooldown."', '".$extra."')";
				mysql_query($sql) or die(mysql_error());
			}
			else if ($_POST['2']){
				$res = array();
				foreach ($a->find('.title') as $div1)
					$title = make_good($div1->innertext);
				foreach ($a->find('.components .single img') as $single){
					$search = array('/img/items/', '.jpg');
					$comp = make_good(str_replace('_', ' ', str_replace($search, '', $single->src)));
					if ($comp == 'recipe')
						$res[] = '0';
					else{
						$sql = "SELECT id FROM Item WHERE name = '".$comp."'";
						$result = mysql_query($sql) or die(mysql_error());
						while($row = mysql_fetch_array($result))
							$res[] = $row['id'];
					}
				}
				if (sizeof($res) != 0){
					$components = '';
					foreach ($res as $c)
						$components .= $c.'&';
					$components = substr($components, 0, -1);
					$sql = "UPDATE Item SET components = '".$components."' WHERE name = '".$title."'";
					mysql_query($sql) or die(mysql_error());
				}
			}
		}
	}

	$html->clear();
 	unset($html);
}
?>
<meta charset="utf-8">
<form action="" method="POST">
	<input type="submit" value="Создать базу предметов" name="1">
	<input type="submit" value="Обновить список компонент у каждого предмета" name="2">
</form>