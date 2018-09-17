<?php

	function get_styles($query){
		$sql = "SELECT id, name FROM music_style ORDER BY name";
		if ($stmt = $query->prepare($sql)){
			$stmt->execute();
			$stmt->bind_result($id, $title);
			while ($stmt->fetch())
				$result[$id] = $title;
			$stmt->close();
			return $result;
		}
	}

	function get_cultures($query){
		$sql = "SELECT id, name FROM culture ORDER BY name";
		if ($stmt = $query->prepare($sql)){
			$stmt->execute();
			$stmt->bind_result($id, $title);
			while ($stmt->fetch())
				$result[$id] = $title;
			$stmt->close();
			return $result;
		}
	}

	function get_relation_vape($query){
		$sql = "SELECT id, name FROM to_vape";
		if ($stmt = $query->prepare($sql)){
			$stmt->execute();
			$stmt->bind_result($id, $title);
			while ($stmt->fetch())
				$result[$id] = $title;
			$stmt->close();
			return $result;
		}
	}

	function get_relation_terms($query){
		$sql = "SELECT id, name FROM to_obscene";
		if ($stmt = $query->prepare($sql)){
			$stmt->execute();
			$stmt->bind_result($id, $title);
			while ($stmt->fetch())
				$result[$id] = $title;
			$stmt->close();
			return $result;
		}
	}

	function get_random_word($query){
		$id = rand(1, 30);
		$sql = "SELECT name FROM word WHERE id = ?";
		if ($stmt = $query->prepare($sql)){
			$stmt->bind_param('i', $id);
			$stmt->execute();
			$stmt->bind_result($name);
			$stmt->fetch();
			$stmt->close();
			return $name;
		}
	}

	function get_ankets($mysqli, $user = false){
		$count = -1;
		if (!$user)
			$sql = "SELECT a.id, a.name, a.last_name, a.patr, a.city, a.age, a.email, a.about, a.phone, s.title AS sex_title, rts.title AS smoke_title FROM anketa a, to_vape v, to_obscene o, word w WHERE a.word_id = w.id AND a.to_obscene_id = o.id AND a.vape_id = v.id ORDER BY a.id DESC";
		else
			$sql = "SELECT a.id, a.name, a.last_name, a.patr, a.city, a.age, a.email, a.about, a.phone, s.title AS sex_title, rts.title AS smoke_title FROM anketa a, to_vape v, to_obscene o, word w WHERE a.word_id = w.id AND a.to_obscene_id = o.id AND a.vape_id = v.id AND a.user_id = ? ORDER BY a.id DESC";
		if ($stmt = $mysqli->prepare($sql)){
			if ($user)
				$stmt->bind_param('i', $user);
			$stmt->execute();
			$res = $stmt->get_result();
				while ($row = $res->fetch_assoc()){
					$result[++$count] = $row;
					$sql = "SELECT c.name FROM culture c, culture_anketa ca WHERE ca.anketa_id = ? AND ca.culture_id = c.id";
					if ($stmt1 = $mysqli->prepare($sql)){
						$stmt1->bind_param("i", $row['id']);
						$stmt1->execute();
						$stmt1->bind_result($g);
						while ($stmt1->fetch())
							$result[$count]['cultures'][] = $g;
						$stmt1->close();
						$sql = "SELECT s.name FROM music_style_anketa sa, music_style s WHERE sa.anketa_id = ? AND sa.music_style_id = s.id";
						if ($stmt2 = $mysqli->prepare($sql)){
							$stmt2->bind_param("i", $row['id']);
							$stmt2->execute();
							$stmt2->bind_result($p);
							while ($stmt2->fetch())
								$result[$count]['styles'][] = $p;
							$stmt2->close();
						}
					}
				}
			$stmt->close();
		}
		return $result;
	}


	function get_role($id){
		$roles = array(
			0 => 'Гость',
			1 => 'Гострайтер',
			2 => 'Творец',
			3 => 'Админ',
			4 => 'Создатель'
		);
		return $roles[$id];
	}



	function get_users($query, $b){
		$sql = "SELECT id, login, email, phone, role FROM user WHERE banned = ?";
		if ($stmt = $query->prepare($sql)){
			$stmt->bind_param('s', $b);
			$stmt->execute();
			$res = $stmt->get_result();
			while ($row = $res->fetch_assoc())
				$result[] = $row;
			$stmt->close();
			return $result;
		}
	}



	function update_user_ban($query, $user, $value){
		$sql = "UPDATE user SET banned = ? WHERE id = ?";
		if ($stmt = $query->prepare($sql)){
			$stmt->bind_param('si', $value, $user);
			$stmt->execute();
			$stmt->close();
		}
	}


?>