<?php
	switch ($type_error) {
		case 1:
			echo '<p>Страница не существует, ошибка в <span>'.$project[0].'</span></p>';
			break;
		case 2:
			echo '<p>Гайд с идентификатором <span>'.$project[1].'</span> не существует</p>';
			break;
		case 3:
			echo '<p>Герой <span>'.$project[1].' не существует</span></p>';
			break;
		case 4:
			echo '<p>Гайд с идентификатором <span>'.$project[1].'</span> не существует</p>';
			break;
		case 5:
			echo '<p>Герой <span>'.$project[1].' не существует</span></p>';
			break;
		case 6:
			echo '<p>Сервер залагал</p>';
			break;
	}
?>