<?php
$_SESSION['word'] = get_random_word($mysqli);
?>

<div class="form">
	<form action="action.php" method="post">
		<div class="info">
			<div class="title_panel">Ваши сведения</div>
			<div>
				<input class="input_reg" type="text" name="nickname" required placeholder="Ваш псевдоним">
				<input class="input_reg" type="text" name="name" required placeholder="Как к вам обращаться">
				<input class="input_reg" type="text" name="age" required placeholder="Ваш возраст">
				<input class="input_reg" type="text" name="email" required placeholder="Ваше мыло" <?if($_SESSION['acc']['email']):?>value="<?=$_SESSION['acc']['email']?>"<?endif;?>>
				<input class="input_reg" type="text" name="phone" required placeholder="Ваш номер телефона" <?if($_SESSION['acc']['phone']):?>value="<?=$_SESSION['acc']['phone']?>"<?endif;?>>
				<textarea class="input_reg" name="achievment" placeholder="Достижения в области гострайтинга"></textarea>
			</div>
		</div>
		<div class="info">
			<div class="title_panel">Творческое начало</div>
			<input class="input_reg" type="text" name="rifm" required placeholder='Придумайте рифму к слову "<?=$_SESSION['word']?>"'>
		</div>
		<div class="info">
			<div class="title_panel">Ваше субъективное тяготение</div>
			<div class="blook_choose">
				<div>
					<p>К стилю</p>
					<?foreach(get_styles($mysqli) as $key => $value):?>
					<label for="checkbox_style-<?=$key?>"><?=$value?></label>
					<input type="checkbox" name="styles[]" id="checkbox_style-<?=$key?>" value="<?=$key?>">
					<?endforeach;?>
				</div>
				<div>
					<p>К культуре</p>
					<?foreach(get_cultures($mysqli) as $key=>$value):?>
					<label for="checkbox-<?=$key?>"><?=$value?></label>
					<input type="checkbox" name="cultures[]" id="checkbox-<?=$key?>" value="<?=$key?>">
					<?endforeach;?>
				</div>
				<div>
					<p>К вейпингу</p>
					<select class="my_select" name="vape">
					<?foreach(get_relation_vape($mysqli) as $key=>$value):?>
					<option value="<?=$key?>"><?=$value?></option>
					<?endforeach;?>
					</select>
				</div>
				<div>
					<p>К нецензурной лексике</p>
					<?foreach(get_relation_terms($mysqli) as $key=>$value):?>
					<label for="radio-<?=$key?>"><?=$value?></label>
					<input type="radio" name="terms" id="radio-<?=$key?>" value="<?=$key?>">
					<?endforeach;?>
					</select>
				</div>
			</div>
		</div>
		<div class="info">
			<input type="submit" value="Отправить эту чудо-анкету">
		</div>
	</form>
</div>