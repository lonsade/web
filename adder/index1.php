<?php
	require_once 'simple_html_dom.php';
	header('Content-Type: text/html; charset=utf-8');
	?>
<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST'){


	function make_good($string){
		return preg_replace("/  +/"," ",mysql_real_escape_string(trim(strip_tags($string))));
	}
	
	define("DB_HOST", "localhost");
	define("DB_LOGIN", "root");
	define("DB_PASSWORD", "");
	define("DB_NAME", "dota2");

	define("RESOURCE", " http://dota2.ru");
	define("TYPE", "сила");
	define("PARTY", "свет");
	
	mysql_connect(DB_HOST, DB_LOGIN, DB_PASSWORD) or die(mysql_error());
	mysql_select_db(DB_NAME) or die(mysql_error());

	$html = file_get_html($_POST['url']);
	if(count($html->find('.p-guides')))
		foreach($html->find('.p-guides') as $div)
			$content = $div->innertext;
	//$dom = str_get_html($content);	
		$dom = $html;

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
	foreach($dom->find('.p-content .stats .hero img') as $div)
		$info['image'] = RESOURCE.make_good($div->src);

	print_r($info);
		/*
		$img = 'http://elitecod.ru/dota2/heroes/'.str_replace(' ', '_', trim(strtolower($name))).'_full.png';
		
		$sql = "INSERT INTO heroes(name, role, fight, damage, speed, armor, intellect, strength, agility, bio, image, type, party) VALUES('".$name."', '".$role."', '".$fight."', '".$damage."', '".$speed."', '".$armor."', '".$intellect."', '".$strength."', '".$agility."', '".$bio."', '".$img."', '".TYPE."', '".PARTY."')";
		mysql_query($sql) or die(mysql_error());
		
		foreach($dom->find('.abilities .single') as $div){
			$title = '';
			$about = '';
			$img = '';
			$mp = '';
			$cd = '';
			$other = '';
			foreach($div->find('.title') as $div1){
				$title = mysql_real_escape_string(trim($div1->innertext));
			}
			foreach($div->find('.description') as $div1){
				$about = mysql_real_escape_string(trim($div1->innertext));
			}
			foreach($div->find('.top img[src*=heroes]') as $div1){
				$img = trim($div1->src);
			}
			if(count($div->find('.top img[src*=mana]'))){
				foreach($div->find('.top img[src*=mana]') as $div1){
					$parent = $div1->parent();
					$text = $parent->find('text');
					$mp = trim(str_replace('Расход маны: ', '', $parent->plaintext));
				}
			}
			if(count($div->find('.top img[src*=cooldown]'))){
				foreach($div->find('.top img[src*=cooldown]') as $div1){
					$parent = $div1->parent();
					$text = $parent->find('text');
					$cd = trim(str_replace('Кулдаун: ', '', $parent->plaintext));
				}
			}
			foreach($div->find('.other') as $div1){
				$other = '';
				foreach($div1->find('.left') as $b){
					$other .= trim(strip_tags(str_replace('</div>', '&', $b->innertext)));
				}
				foreach($div1->find('.right') as $b){
					$other .= trim(preg_replace('/\n/', '&', trim($b->plaintext)));
				}
			}
			$sql = "INSERT INTO skills(name, hero, img, about, mp, cd, other) VALUES('".$title."', '".$name."', '".$img."', '".$about."', '".$mp."', '".$cd."', '".$other."')";
			mysql_query($sql) or die(mysql_error());
		}*/
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
<form action="index1.php" method="POST">
	<span>Ссылка от dota2.ru<br></span><input type="text" name="url"><br/>
	<input type="submit" value="Отправить">
</form>