<?php
	function clearStr($data, $type = 's'){
		switch($type){
			case 's': $data = $_SESSION['link']->real_escape_string(trim(strip_tags($data)));break;
			case 'i': $data = abs((int)$data);break;
			case 'sf': $data = trim(strip_tags($data));
		}
		return $data;
	}
	function upData($str){
		$word = ucwords($str);
		if(strstr($word, '_')){
			$words = explode('_',$word);
			$word = '';
			foreach($words as $word1){
				$word .= ucwords($word1)." ";
			}
		}
		return $word;
	}
	function fetch($query){
		if($result = $_SESSION['link']->query($query)){
			$array = array();
			//Выборка данных и помещение их в массив
			while($row = $result->fetch_assoc()){
				$array[] = $row;
			}
			//Очищаем результирующий набор
			$result->close();
			return $array;
		}
	}
	function getOnlyHeroes(){
		return fetch("SELECT name FROM heroes ORDER BY name");
	}
	//Получение предметов
	function get_items(){
		$arr_types = array(
			'consumables'=>'Расходуемые',
			'attributes'=>'Атрибуты',
			'armament'=>'Вооружение',
			'mysticism'=>'Мистика',
			'common'=>'Общее',
			'support'=>'Поддержка',
			'magic'=>'Магия',
			'weapon'=>'Оружие',
			'armor'=>'Броня',
			'artefact'=>'Артефакты',
			'secret'=>'Потайная лавка'
		);
		$sql = "SELECT id, name, image, cost FROM Item WHERE type = ?";
		if ($stmt = $_SESSION['link']->prepare($sql)){
			$stmt->bind_param("s", $type);
			foreach($arr_types as $key=>$type){
				$stmt->execute();
				$res = $stmt->get_result();
				while ($row = $res->fetch_assoc())
					$result[$key][] = $row;
			}
			$stmt->close();
		}
		return $result;
	}
	//Получение героев для отображения в пунктах "Герои" и "Создать гайд"
	function get_heroes(){
		$arr_types = array('сила', 'ловкость', 'интеллект');
		$arr_party = array('свет', 'тьма');
		$sql = "SELECT name, image, role, fight FROM Hero WHERE type = ? AND party = ?";
		if ($stmt = $_SESSION['link']->prepare($sql)){
			$stmt->bind_param("ss", $type, $party);
			foreach($arr_party as $party)
				foreach($arr_types as $type){
					$stmt->execute();
					$res = $stmt->get_result();
					while ($row = $res->fetch_assoc())
						$result[$party][$type][] = $row;
				}
			$stmt->close();
		}
		return $result;
	}
	//Получение списка героев
	function get_heroes_list(){
		$sql = "SELECT name FROM Hero";
		if ($stmt = $_SESSION['link']->prepare($sql)){
			$stmt->execute();
			$stmt->bind_result($name);
			while ($stmt->fetch())
				$result[] = $name;
			$stmt->close();
			return $result;
		}
	}
	//Получение списка id гайдов
	function get_id_guides(){
		$sql = "SELECT id FROM Guide";
		if ($stmt = $_SESSION['link']->prepare($sql)){
			$stmt->execute();
			$stmt->bind_result($id);
			while ($stmt->fetch())
				$result[] = $id;
			$stmt->close();
			return $result;
		}
	}
	//Получение списка id предметов
	function get_id_items(){
		$sql = "SELECT id FROM Item";
		if ($stmt = $_SESSION['link']->prepare($sql)){
			$stmt->execute();
			$stmt->bind_result($id);
			while ($stmt->fetch())
				$result[] = $id;
			$stmt->close();
			return $result;
		}
	}
	//Получение списка id скиллов героя
	function get_id_skills($hero){
		$sql = "SELECT id FROM Skill WHERE hero_name = ?";
		if ($stmt = $_SESSION['link']->prepare($sql)){
			$stmt->bind_param("s", $hero);
			$stmt->execute();
			$stmt->bind_result($id);
			while ($stmt->fetch())
				$result[] = $id;
			$stmt->close();
			return $result;
		}
	}
	//Получение информации о герое, для которого создается гайд
	function get_hero_for_guide($hero){
		$sql = "SELECT name, type, role, fight, strength, agility, intellect, damage, armor, move_speed, fight_speed, distance_vision, image FROM Hero WHERE name = ?";
		if ($stmt = $_SESSION['link']->prepare($sql)){
			$stmt->bind_param("s", $hero);
			$stmt->execute();
			$res = $stmt->get_result();
			$row = $res->fetch_assoc();
			$stmt->close();
			return $row;
		}
	}
	//Получение скиллов героя
	function get_hero_skills($hero){
		$sql = "SELECT id, image, title, about, cooldown, manacost, text_info, int_info, extra_about FROM Skill WHERE hero_name = ? AND up = ?";
		if ($stmt = $_SESSION['link']->prepare($sql)){
			$stmt->bind_param("si", $hero, $up);
			$up = 1;
			$stmt->execute();
			$res = $stmt->get_result();
			while ($row = $res->fetch_assoc())
				$result[] = $row;
			$stmt->close();
			return $result;
		}
	}
	//Получение всех гайдов
	function get_guides(){
		$sql = "SELECT g.id, g.Hero_name, g.title, u.login, g.rating, g.views, g.patch, DATE_FORMAT(g.date_t,'%d.%m.%y %H:%i:%s') AS date_t, h.image FROM Guide g, User u, Hero h WHERE g.User_id = u.id AND g.Hero_name = h.name ORDER BY g.date_t DESC";
		if ($stmt = $_SESSION['link']->prepare($sql)){
			$stmt->execute();
			$res = $stmt->get_result();
			while ($row = $res->fetch_assoc())
				$result[] = $row;
			$stmt->close();
			return $result;
		}
	}
	//Получение предметов для гайда
	function get_items_for_guide($id){
		$sql = "SELECT i.id, i.name, i.description, i.type, i.image, i.cost, i.attributes, i.manacost, i.cooldown, i.extra_about, i.components, ig.place, ig.stage_name, ig.stage_id FROM Item i, Items_for_guide ig WHERE ig.Guide_id = ? AND ig.Item_id = i.id";
		if ($stmt = $_SESSION['link']->prepare($sql)){
			$stmt->bind_param('i', $id);
			$stmt->execute();
			$res = $stmt->get_result();
			while ($row = $res->fetch_assoc())
				$result[] = $row;
			$stmt->close();
		}
		return $result;
	}
	//Получение информации о гайде
	function get_guide($id){
		//Выборка по гайду
		$sql = "SELECT id, title, about, levels, patch, rating, views, date_t, Hero_name FROM Guide WHERE id = ?";
		if ($stmt = $_SESSION['link']->prepare($sql)){
			$stmt->bind_param('s', $id);
			$stmt->execute();
			$res = $stmt->get_result();
			$result['guide'] = $res->fetch_assoc();
			$stmt->close();
			$result['hero'] = get_hero_for_guide($result['guide']['Hero_name']);
			$result['skills'] = get_hero_skills($result['guide']['Hero_name']);
			$result['items'] = get_items_for_guide($result['guide']['id']);
		}
		return $result;
	}

	function getGuides($my = false){
		$author = ($my)?"AND g.author = '".$my."' ":"";
		return fetch("SELECT g.name, g.author, g.hero, g.dt, g.id, g.rating, g.n_rating, g.looks, h.image FROM guides g, heroes h WHERE g.hero = h.name ".$author."ORDER BY id DESC");
	}
	function getGuid($guid){
		return fetch("SELECT author, hero, information, s1, s2, s3, s4, lvls, name, dt, items, titles, rating, n_rating, looks FROM guides WHERE id = '".$guid."'");
	}
	function getHeroInfo($hero){
		$hero = $_SESSION['link']->real_escape_string($hero);
		return fetch("SELECT role, fight, image, type, damage, speed, armor, intellect, strength, agility, bio FROM heroes WHERE name = '".$hero."'");
	}
	function getHideItemInfo($url){
		$arr = fetch("SELECT name, price, info, story, attrs, cd, mp, components FROM items WHERE img = '".$url."'");
		$helper = '';
		$helper .= '<div class="item-helper"><div class="shower"></div><div class="i-name">'.$arr[0]['name'].'</div><div class="i-gold"><img src="images/resources/gold.png">'.$arr[0]['price'].'</div>';
		$helper .= (!empty($arr[0]['info']))?'<hr/><div class="i-info">'.$arr[0]['info'].'</div>':'';
		$helper .= (!empty($arr[0]['story']))?'<hr/><div class="i-story">'.$arr[0]['story'].'</div>':'';
		$helper .= (!empty($arr[0]['attrs']))?'<hr/><div class="i-attrs">'.$arr[0]['attrs'].'</div>':'';
		if($arr[0]['cd'] != '0' or $arr[0]['mp'] != '0'){
			$helper .= '<hr><div class="i-cdmp">';
			$helper .= ($arr[0]['cd'] != '0')?'<p>Кулдаун: <span>'.$arr[0]['cd'].'</span></p>':'';
			$helper .= ($arr[0]['mp'] != '0')?'<p>Расход маны: <span>'.$arr[0]['mp'].'</span></p>':'';
			$helper .= '</div>';
		}
		$helper .= (!empty($arr[0]['components']))?'<hr/><div class="i-components">':'';
		foreach(explode('&', $arr[0]['components']) as $component){
			if(!empty($component)){
				$helper .= '<img src="'.$component.'"/>';
			}
		}
		$helper .= (!empty($arr[0]['components']))?'</div>':'';
		$helper .= '</div>';
		return $helper;
	}

	
	function getUser($login){
		return fetch("SELECT login, password FROM users WHERE login = '".$login."'");
	}
	function getUsers(){
		return fetch("SELECT login FROM users");
	}
	function setRating($star, $guide, $user){
		//Проверка возможности голоса
		$arrU = fetch("SELECT ratings FROM users WHERE login = '".$user."'");
		if(!strrpos($arrU[0]['ratings'], (string)$guide)){
			//Выборка предыдущего значения суммы всех голосов и их количества
			$arr = fetch("SELECT rating, n_rating FROM guides WHERE id = ".$guide."");
			//Перезаписование данных
			$rating = $arr[0]['rating'] + $star;
			$n_rating = $arr[0]['n_rating'] + 1;
			$sql = "UPDATE guides SET rating = '".$rating."', n_rating = '".$n_rating."' WHERE id = ".$guide."";
			$_SESSION['link']->query($sql);
			//Запись в базу пользователя, что он голосовал
			$ratings = $arrU[0]['ratings'].','.$guide;
			$sql = "UPDATE users SET ratings = '".$ratings."' WHERE login = '".$user."'";
			$_SESSION['link']->query($sql);
			//Возвращение измененного голоса
			return $rating / $n_rating;
		}
	}
	function ableforvoice($user, $guide){
		$arr = fetch("SELECT ratings FROM users WHERE login = '".$user."'");
		if(strrpos($arr[0]['ratings'], (string)$guide)){
			return false;
		}else{
			return true;
		}
	}
	function ableForLook($guide, $looker){
		$user = $_COOKIE['login'];
		$arr = fetch("SELECT looks FROM guides WHERE id = '".$guide."'");
		if($user){
			$arrUser = fetch("SELECT looks FROM users WHERE login = '".$user."'");
			if(!strrpos($arrUser[0]['looks'], (string)$guide)){
				$lookguide = $arrUser[0]['looks'].','.$guide;
				$sql = "UPDATE users SET looks = '".$lookguide."' WHERE login = '".$user."'";
				$_SESSION['link']->query($sql);	
				$looks = $arr[0]['looks'] + 1;
			}
		}elseif($looker){
			$looks = $arr[0]['looks'] + 1;
		}
		if($looks){
			$sql = "UPDATE guides SET looks = '".$looks."' WHERE id = '".$guide."'";
			$_SESSION['link']->query($sql);
		}
	}
	function get_info_hero($hero){
		$sql = "SELECT image, title, about, cooldown, manacost, info, extra_about FROM Skill WHERE hero_name = '".$hero."'";
		$arr_skills = fetch($sql);
		$sql = "SELECT name, image, role, fight, type, party, damage, move_speed, armor, intellect, strength, agility, biograph, distance_vision, fight_speed FROM Hero WHERE name = '".$hero."'";
		$arr_hero = fetch($sql);
		$array = array();
		$array['skills'] = $arr_skills;
		$array['hero'] = $arr_hero;
		return $array;
	}



	function get_health($strength){
		return 200 + $strength * 20;
	}
	function get_begin_damage($type, $damage_begin, $strength, $agility, $intellect){
		if ($type == 'сила')
			return ($damage_begin + $strength);
		else if ($type == 'ловкость')
			return ($damage_begin + $agility);
		else
			return ($damage_begin + $intellect);
	}
    function get_end_damage($type, $damage_end, $strength, $agility, $intellect){
		if ($type == 'сила')
			return ($damage_end + $strength);
		else if ($type == 'ловкость')
			return ($damage_end + $agility);
		else
			return ($damage_end + $intellect);
	}
	function get_mana($intellect){
		return 50 + $intellect * 13;
	}
	function get_width_h($own){
		$max_health = 780;
		$max_width = 133;
		return ($own * $max_width / $max_health) . 'px';
	}
	function get_width_m($own){
		$max_mana = 440;
		$max_width = 133;
		return ($own * $max_width / $max_mana) . 'px';
	}

	function get_progects(){
		$result = array(
			'creating'=>'Создать гайд',
			'my'=>'Мои гайды',
			'all'=>'Все гайды',
			'heroes'=>'Герои'
		);
		return $result;
	}
	function get_titles(){
		$result = array(
			'creating'=>'Создание гайда',
			'my'=>'Мои гайды',
			'all'=>'Все гайды',
			'heroes'=>'Все герои'
		);
		return $result;
	}
?>