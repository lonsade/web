<?php 
	session_start();
	$_SESSION['available'] = false;
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Анкета</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="/design/main.css">
        <link rel="stylesheet" type="text/css" href="/design/form.css">
        <link rel="stylesheet" type="text/css" href="style.css">
        <script type="text/javascript" src="/jquery-3.0.0.min.js"></script>
        <script type="text/javascript" src="/jquery-ui.min.js"></script>
        <script type="text/javascript" src="form.js"></script>
    </head>

    <body>
        <div class="form">
            <p class="name_form">Анкета</p>
            <form action="action.php" method="post">
                <p>Имя</p>
                <input type="text" name="name1" pattern="^[a-zA-Z]+$" required>
                <p>Фамилия</p>
                <input type="text" name="name2" pattern="^[a-zA-Z]+$" required>
                <p>Отчество</p>
                <input type="text" name="name3" pattern="^[a-zA-Z]+$">
                <p>Город</p>
                <input type="text" name="city" pattern="^[a-zA-Z]+$" required>
                <p>Возраст</p>
                <input type="text" name="age" pattern="[1-9][0-9]?" required>
                <p>Email</p>
                <input type="text" name="email">
                <p>Пол</p> <span>М</span>
                <input type="radio" name="mw" value="m" required> <span>Ж</span>
                <input type="radio" name="mw" value="w" required>
                <p>О себе</p>
                <textarea name="about" rows="5"></textarea>
                <p>Ваши предпочтения</p>
                <p>Политический(-ие) режим(-ы)</p>
                <select multiple name="modes[]">
                    <option value="k">Комунизм</option>
                    <option value="d">Демократия</option>
                    <option value="s">Социализм</option>
                    <option value="m">Марксизм</option>
                    <option value="f">Фашизм</option>
                    <option value="n">Национализм</option>
                </select>
                <p>Отношение к курению</p>
                <select name="smoke">
                    <option value="1">Не переношу</option>
                    <option value="2">Негативно</option>
                    <option value="3">Нейтрально</option>
                    <option value="4">Положительно</option>
                    <option value="5">Смысл моей жизни</option>
                </select>
                <p id="music">Любимые жанры музыки</p>
                <input type="checkbox" name="music[]" value="1"><span class="checkbox_title">Хип-хоп</span>
                <br>
                <input type="checkbox" name="music[]" value="2"><span class="checkbox_title">Рок</span>
                <br>
                <input type="checkbox" name="music[]" value="3"><span class="checkbox_title">Популярная</span>
                <br>
                <input type="checkbox" name="music[]" value="4"><span class="checkbox_title">Электронника</span>
                <br>
                <input type="checkbox" name="music[]" value="5"><span class="checkbox_title">Клауд рэп</span>
                <br>
                <input type="submit" value="Отправить эту чудо-анкету"> </form>
        </div>
        <div class="ankets">
            <p id="show_ankets">Показать список анкет</p>
            <?php
	if(file_exists("anket.xml")){
		$str = file_get_contents("anket.xml");
	}
	if (isset($str)){
		$xml = new SimpleXmlElement($str);
		$id=0;
		foreach ($xml->anket as $ank){
	echo '<div id="anket_'.$id.'">';
	$id++;
		echo '<p><span>Имя:</span> '.$ank->name1.'</p>';
		echo '<p><span>Фамилия:</span> '.$ank->name2.'</p>';
		if (isset($ank->name3)) echo '<p><span>Отчество:</span> '.$ank->name3.'</p>';
		echo '<p><span>Город:</span> '.$ank->city.'</p>';
		echo '<p><span>Возраст:</span> '.$ank->age.'</p>';
		if (isset($ank->email)) echo '<p><span>Email:</span> '.$ank->email.'</p>';
		echo '<p><span>Пол:</span> ';
		if ($ank->gender=='m')
			echo 'мужской';
		else
			echo 'женский';
		echo '</p>';
		if (isset($ank->about)) echo '<p><span>О себе:</span> '.$ank->about.'</p>';	
		$c=1;
		if (isset($ank->modes)){
			echo '<p><span>Политические режимы:</span> ';
				foreach ($ank->modes->mode as $mode){
					switch ($mode) {
						case 'k':
							echo 'Комунизм';
							break;
						case 'd':
							echo 'Демократия';
							break;
						case 's':
							echo 'Социализм';
							break;
						case 'm':
							echo 'Марксизм';
							break;
						case 'f':
							echo 'Фашизм';
							break;
						case 'n':
							echo 'Национализм';
							break;
						default:
							echo 'Неопределено!';
					}
					if ($c != count($ank->modes->mode))
						echo ', ';
					$c++;
				}
			echo '</p>';
		}
		 echo '<p><span>Отношение к курению:</span> ';
		 switch ($ank->smoke) {
						case '1':
							echo 'Не переношу';
							break;
						case '2':
							echo 'Негативно';
							break;
						case '3':
							echo 'Нейтрально';
							break;
						case '4':
							echo 'Положительно';
							break;
						case '5':
							echo 'Смысл моей жизни';
							break;
						default:
							echo 'Неопределено!';
					}
		 echo '</p>';
		$c=1;
		if (isset($ank->music)){
			echo '<p><span>Любимые жанры музыки:</span> ';
			foreach ($ank->music->genre as $genre){
					switch ($genre) {
						case '1':
							echo 'Хип-хоп';
							break;
						case '2':
							echo 'Рок';
							break;
						case '3':
							echo 'Популярная';
							break;
						case '4':
							echo 'Электронника';
							break;
						case '5':
							echo 'Клауд рэп';
							break;
						default:
							echo 'Неопределено!';
					}
					if ($c != count($ank->music->genre))
						echo ', ';
					$c++;
				}
			echo '</p>';
		}
	echo '</div>';
		}
	}
?> </div>
    </body>

    </html>