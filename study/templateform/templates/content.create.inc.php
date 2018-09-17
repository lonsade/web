<?php
$_SESSION['send'] = false;
?>
<div class="form">
	<form action="action.php" method="post">
		<div class="info">
			<p>Имя</p>
			<input type="text" name="name1" pattern="^[a-zA-Zа-яА-Я]+$" required>
		</div>
		<div class="info">
			<p>Фамилия</p>
			<input type="text" name="name2" pattern="^[a-zA-Zа-яА-Я]+$" required>
		</div>
		<div class="info">
			<p>Отчество</p>
			<input type="text" name="name3" pattern="^[a-zA-Zа-яА-Я]+$">
		</div>
		<div class="info">
			<p>Город</p>
			<input type="text" name="city" pattern="^[a-zA-Zа-яА-Я]+$" required>
		</div>
		<div class="info">
			<p>Возраст</p>
			<input type="text" name="age" pattern="[1-9][0-9]?" required>
		</div>
		<div class="info">
			<p>Email</p>
			<input type="text" name="email">
		</div>
		<div class="info">
			<p>О себе</p>
			<textarea style="height: 100%;" name="about" rows="5"></textarea>
		</div>
		<div class="info">
			<p>Пол</p>
			<label for="radio-1">Пока еще не понял</label>
			<input type="radio" name="mw" id="radio-1" value="no" checked>
			<label for="radio-2">Мужской</label>
			<input type="radio" name="mw" id="radio-2" value="m">
			<label for="radio-3">Женский</label>
			<input type="radio" name="mw" id="radio-3" value="w">
		</div>
		<div class="intresting">Ваши предпочтения</div>
		<div class="interes">
			<p>Политический(-ие) режим(-ы)</p>
			<select class="multi" multiple name="modes[]">
				<option value="k">Комунизм</option>
				<option value="d">Демократия</option>
				<option value="s">Социализм</option>
				<option value="m">Марксизм</option>
				<option value="f">Фашизм</option>
				<option value="n">Национализм</option>
			</select>
		</div>
		<div class="interes">
			<p>Отношение к курению</p>
			<select name="smoke">
				<option value="1">Не переношу</option>
				<option value="2">Негативно</option>
				<option value="3">Нейтрально</option>
				<option value="4">Положительно</option>
				<option value="5">Смысл моей жизни</option>
			</select>
		</div>
		<div class="interes">
			<p id="music">Любимые жанры музыки</p>
			<label for="checkbox-1">Хип-хоп</label>
			<input type="checkbox" name="music[]" id="checkbox-1" value="1">
			<label for="checkbox-2">Рок</label>
			<input type="checkbox" name="music[]" id="checkbox-2" value="2">
			<label for="checkbox-3">Популярная</label>
			<input type="checkbox" name="music[]" id="checkbox-3" value="3">
			<label for="checkbox-4">Электронника</label>
			<input type="checkbox" name="music[]" id="checkbox-4" value="4">
			<label for="checkbox-5">Клауд рэп</label>
			<input type="checkbox" name="music[]" id="checkbox-5" value="5">
		</div>
		<input type="submit" value="Отправить эту чудо-анкету">
	</form>
</div>