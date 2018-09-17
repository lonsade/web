<?php


	function login($mysqli, $login, $pass, $remember, $common){
		//Проверка логина и одновременно выборка пароля
		$sql = "SELECT password FROM User WHERE login = ?";
		if ($stmt = $mysqli->prepare($sql)){
			$stmt->bind_param('s', $login);
			$stmt->execute();
			$stmt->bind_result($password);
			$stmt->fetch();
			$stmt->close();
			//Проверка пароля и существования логина
			if (!$common){
				if (!$password || $pass != $password){
					$_SESSION['request']['message'][] = 'Ваша кука устарела';
					$_SESSION['request']['title'] = 'Ошибка входа';
					exit(0);
				}
			}
			else if (!$password || !password_verify($_POST['password'], $password)){
				$_SESSION['request']['message'][] = 'Неверный логин либо пароль';
				$_SESSION['request']['title'] = 'Ошибка входа';
				header('Location: '.$_SERVER['HTTP_REFERER']);
				exit(0);
			}
			//Данные прошли авторизацию
			$sql = "SELECT id, role, email, phone, banned, password, level FROM user WHERE login = ?";
			if ($stmt = $mysqli->prepare($sql)){
				$stmt->bind_param('s', $login);
				$stmt->execute();
				$stmt->bind_result($id, $role, $email, $phone, $banned, $password, $level);
				$stmt->fetch();
				$stmt->close();
				$_SESSION['acc']['id'] = $id;
				$_SESSION['acc']['login'] = $login;
				$_SESSION['acc']['role'] = $role;
				$_SESSION['acc']['email'] = $email;
				$_SESSION['acc']['phone'] = $phone;
				$_SESSION['acc']['banned'] = $banned;
				$_SESSION['acc']['level'] = $level;
				$_SESSION['entered'] = true;
				if ($remember){
					setcookie('login', $_SESSION['acc']['login'], time()+60*60*24*365*10);
					setcookie('password', $password, time()+60*60*24*365*10);
				}
			}
		}
	}

	function delete_anketa($query, $id){
		$sql = "DELETE FROM culture_anketa WHERE anketa_id = ?";
		if ($stmt = $query->prepare($sql)){
			$stmt->bind_param("i", $id);
			$stmt->execute();
			$stmt->close();
			$sql = "DELETE FROM music_style_anketa WHERE anketa_id = ?";
			if ($stmt = $query->prepare($sql)){
				$stmt->bind_param("i", $id);
				$stmt->execute();
				$stmt->close();
				$sql = "DELETE FROM anketa WHERE id = ?";
				if ($stmt = $query->prepare($sql)){
					$stmt->bind_param("i", $id);
					$stmt->execute();
					$stmt->close();
				}
			}
		}
	}

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
			$result['id']=$id;
			$result['name']=$name;
			return $result;
		}
	}

	function get_ankets($mysqli, $user = false, $id = false){
		$count = -1;

		$sql_user = ($user)?"AND a.user_id = ?":"";
		$sql_id = ($id)?"AND a.id = ?":"";

		$sql = "SELECT a.id, a.name, a.nickname, a.email, a.phone, a.age, a.achievment, a.rifm, o.name AS obscene_name, v.name AS vape_name, w.name AS word_name FROM anketa a, to_vape v, to_obscene o, word w WHERE a.word_id = w.id AND a.to_obscene_id = o.id AND a.to_vape_id = v.id ".$sql_user." ".$sql_id." ORDER BY a.id DESC";

		if ($stmt = $mysqli->prepare($sql)){
			if ($user)
				$stmt->bind_param('i', $user);
			else if ($id)
				$stmt->bind_param('i', $id);
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


	function get_status($id){
		$s = array(
			0 => 'Полноценный гражданин',
			1 => 'Неверифицированный',
			2 => 'Забаненный'
		);
		return $s[$id];
	}



	function get_users_on_banned($query, $value){
		$sql = "SELECT id, login, email, phone, role, level FROM user WHERE banned = ?";
		if ($stmt = $query->prepare($sql)){
			$stmt->bind_param('s', $value);
			$stmt->execute();
			$res = $stmt->get_result();
			while ($row = $res->fetch_assoc())
				$result[] = $row;
			$stmt->close();
			return $result;
		}
	}

	function get_users_on_role($query, $value){
		$sql = "SELECT id, login, email, phone, role, level FROM user WHERE role = ? AND banned = '0'";
		if ($stmt = $query->prepare($sql)){
			$stmt->bind_param('s', $value);
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

	function update_user_role($query, $user, $new_role, $level){
		$sql = "SELECT role FROM user WHERE id = ?";
		if ($stmt = $query->prepare($sql)){
			$stmt->bind_param('i', $user);
			$stmt->execute();
			$stmt->bind_result($prev_role);
			$stmt->fetch();
			$stmt->close();
			$sql = "UPDATE user SET role = ?, prev_role = ?, level = ? WHERE id = ?";
			if ($stmt = $query->prepare($sql)){
				$new_level = $level - 1;
				$stmt->bind_param('ssii', $new_role, $prev_role, $new_level, $user);
				$stmt->execute();
				$stmt->close();
			}
		}
	}

	function update_user_common($query, $user){
		$sql = "SELECT prev_role FROM user WHERE id = ?";
		if ($stmt = $query->prepare($sql)){
			$stmt->bind_param('i', $user);
			$stmt->execute();
			$stmt->bind_result($prev_role);
			$stmt->fetch();
			$stmt->close();
			$sql = "UPDATE user SET role = ?, prev_role = ?, level = ? WHERE id = ?";
			if ($stmt = $query->prepare($sql)){
				$role = -1;
				$level = 0;
				$stmt->bind_param('ssii', $prev_role, $role, $level, $user);
				$stmt->execute();
				$stmt->close();
			}
		}
	}


	function get_user_passport($query, $id){
		$sql = "SELECT role, level FROM user WHERE id = ?";
		if ($stmt = $query->prepare($sql)){
			$stmt->bind_param('i', $id);
			$stmt->execute();
			$res = $stmt->get_result();
			$result = $res->fetch_assoc();
			$stmt->close();
			return $result;
		}
	}


?>