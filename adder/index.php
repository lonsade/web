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


	//$fff = false;

	/*

	foreach ($_heroes as $key1 => $party)
	foreach ($party as $key2 => $type)
	foreach ($type as $heroval){


		//if ($heroval == 'doom' || $fff){
		//	$fff = true;
		$html = file_get_html(RESOURCE1."/heroes/".$heroval."/");
		if(count($html->find('.p-guides')))
			foreach($html->find('.p-guides') as $div)
				$content = $div->innertext;
		$dom = str_get_html($content);	

		$info['type'] = $key2;
		$info['party'] = $key1;

		foreach($dom->find('.p-header h1') as $div)
			$info['name'] = make_good($div->innertext);
		foreach($dom->find('.p-content .stats .hero .information') as $div)
			$info['role'] = make_good($div->innertext);
		foreach($dom->find('.stats table tr',12)->find('td') as $div)
			$info['fight'] = make_good($div->innertext);
		foreach($dom->find('.stats table tr',11)->find('td') as $div)
			$info['distance_vision'] = make_good($div->innertext);
		foreach($dom->find('.stats table tr',13)->find('td') as $div)
			$info['fight_speed'] = make_good($div->innertext);
		foreach($dom->find('.stats table tr',3)->find('td') as $div)
			$info['damage'] = make_good($div->innertext);
		foreach($dom->find('.stats table tr',5)->find('td') as $div)
			$info['move_speed'] = make_good($div->innertext);
		foreach($dom->find('.stats table tr',4)->find('td') as $div)
			$info['armor'] = make_good($div->innertext);
		foreach($dom->find('.stats table tr',2)->find('td') as $div)
			$info['intellect'] = make_good($div->innertext);
		foreach($dom->find('.stats table tr',0)->find('td') as $div)
			$info['strength'] = make_good($div->innertext);
		foreach($dom->find('.stats table tr',1)->find('td') as $div)
			$info['agility'] = make_good($div->innertext);
		foreach($dom->find('.stats .bio text') as $div)
			$info['bio'] = make_good($div->innertext);
		//Портрет
		/*foreach($dom->find('.p-content .stats .hero img') as $div)
			$info['image'] = RESOURCE1.make_good($div->src);
		


		//http://cdn.dota2.com/apps/dota2/images/heroes/storm_spirit_full.png

		$info['image'] = 'http://elitecod.clan.su/dota2/heroes/'.$heroval.'_full.png';

		$sql = "INSERT INTO hero(name,type,party,role,fight,strength,agility,intellect,damage,armor,move_speed,fight_speed,distance_vision,biograph,image) VALUES('".$info['name']."','".$info['type']."','".$info['party']."','".$info['role']."','".$info['fight']."','".$info['strength']."','".$info['agility']."','".$info['intellect']."','".$info['damage']."','".$info['armor']."','".$info['move_speed']."','".$info['fight_speed']."','".$info['distance_vision']."','".$info['bio']."','".$info['image']."')";
		//Отключен
		//mysql_query($sql) or die(mysql_error());
		//
		
		$html->clear();
   	unset($html);

   //}
	}

	*/
	$idhero = 0;
	foreach ($_heroes as $key1 => $party)
	foreach ($party as $key2 => $type)
	foreach ($type as $heroval){

		$idhero++;
		//if ($heroval == 'doom' || $fff){
		//	$fff = true;
		$html = file_get_html(RESOURCE1."/heroes/".$heroval."/");
		if(count($html->find('.p-guides')))
			foreach($html->find('.p-guides') as $div)
				$content = $div->innertext;
		$dom = str_get_html($content);
		
		foreach($dom->find('.skills .single') as $div){
			$title = '';
			$about = '';
			$img = '';
			$mp = '';
			$cd = '';
			$other = '';
			foreach($div->find('h3') as $div1){
				$title = make_good($div1->innertext);
			}
			foreach($div->find('.description') as $div1){
				$about = make_good($div1->innertext);
			}
			foreach($div->find('.info img') as $div1){
				$img = RESOURCE1.make_good($div1->src);
			}
			if(count($div->find('.top img[src*=mana]'))){
				foreach($div->find('.top img[src*=mana]') as $div1){
					$parent = $div1->parent();
					$text = $parent->find('text');
					$mp = make_good(str_replace('Расход маны: ', '', $parent->plaintext));
				}
			}
			if(count($div->find('.top img[src*=cooldown]'))){
				foreach($div->find('.top img[src*=cooldown]') as $div1){
					$parent = $div1->parent();
					$text = $parent->find('text');
					$cd = make_good(str_replace('Перезарядка: ', '', $parent->plaintext));
				}
			}
			foreach($div->find('.features') as $div1){
				$other = '';
				$other .= make_good(str_replace('</span>', '&', str_replace('</div>', '&', $div1->innertext)));
			}
			foreach($div->find('.lore') as $div1){
				$extra = make_good($div1->innertext);
			}

			$sql = "INSERT INTO skills(name, about, extra_about, cooldown, manacost, info, image, Hero_id) VALUES('".$title."', '".$about."', '".$extra."', '".$cd."', '".$mp."', '".$other."', '".$img."', '".$idhero."')";
			mysql_query($sql) or die(mysql_error());

			$html->clear();
   	unset($html);
		}
	}
}
?>
<meta charset="utf-8">
<style>
	input[type="text"], textarea{
		width: 500px;
		height: 30px;
		font: 14px 'Comic Sans MS', cursive;
	}
</style>
<form action="index.php" method="POST">
	<span>Ссылка от dota2.ru<br></span><input type="text" name="url"><br/>
	<input type="submit" value="Отправить">
</form>