<?php
$_SESSION['word'] = get_random_word($mysqli);
if ($_SESSION['edit'][0]['rifm'])
	$_SESSION['word']['name'] = $_SESSION['edit'][0]['word_name'];
?>

<div class="form">
	<form action="action.php" method="post">
		<div class="info">
			<div class="title_panel">Ваши сведения</div>
			<div class="blook_input">
				<div>
					<p>Псевдоним</p>
					<input class="input_reg" type="text" name="nickname" required <?if($_SESSION['edit'][0]['nickname']):?>value="<?=$_SESSION['edit'][0]['nickname']?>"<?endif;?>>
				</div>
				<div>
					<p>При обращении</p>
					<input class="input_reg" type="text" name="name" required <?if($_SESSION['edit'][0]['name']):?>value="<?=$_SESSION['edit'][0]['name']?>"<?endif;?>>
				</div>
				<div>
					<p>Возраст</p>
					<input class="input_reg" type="text" name="age" required <?if($_SESSION['edit'][0]['age']):?>value="<?=$_SESSION['edit'][0]['age']?>"<?endif;?>>
				</div>
				<div>
					<p>Email</p>
					<input class="input_reg" type="text" name="email" required <?if($_SESSION['acc']['email']):?>value="<?=$_SESSION['acc']['email']?>"<?endif;?> <?if($_SESSION['edit'][0]['email']):?>value="<?=$_SESSION['edit'][0]['email']?>"<?endif;?>>
				</div>
				<div>
					<p>Номер телефона</p>
					<input class="input_reg" type="text" name="phone" required <?if($_SESSION['acc']['phone']):?>value="<?=$_SESSION['acc']['phone']?>"<?endif;?> <?if($_SESSION['edit'][0]['phone']):?>value="<?=$_SESSION['edit'][0]['phone']?>"<?endif;?>>
				</div>
				<div>
					<p>Авторские достижения</p>
					<textarea class="input_reg" name="achievment"><?if($_SESSION['edit'][0]['achievment']):?><?=$_SESSION['edit'][0]['achievment']?><?endif;?></textarea>
					<div class="hiddendiv"></div>
				</div>
			</div>
		</div>
		<div class="info">
			<div class="title_panel">Придумайте рифму к слову</div>
			<div class="blook_input">
				<div>
					<p><?=mb_convert_case($_SESSION['word']['name'], MB_CASE_TITLE, "UTF-8")?></p>
					<input class="input_reg" type="text" name="rifm" required <?if($_SESSION['edit'][0]['rifm']):?>value="<?=$_SESSION['edit'][0]['rifm']?>"<?endif;?>>
				</div>
			</div>
		</div>
		<div class="info">
			<div class="title_panel">Ваше субъективное тяготение</div>
			<div class="blook_input">
				<div>
					<p>К стилю</p>
					<?foreach(get_styles($mysqli) as $key => $value):?>
					<label for="checkbox_style-<?=$key?>"><?=$value?></label>
					<input type="checkbox" name="styles[]" id="checkbox_style-<?=$key?>" value="<?=$key?>" <?if($_SESSION['edit'][0]['styles']):?><?if(in_array($value, $_SESSION['edit'][0]['styles'])):?>checked<?endif;?><?endif;?>>
					<?endforeach;?>
				</div>
				<div>
					<p>К культуре</p>
					<?foreach(get_cultures($mysqli) as $key=>$value):?>
					<label for="checkbox-<?=$key?>"><?=$value?></label>
					<input type="checkbox" name="cultures[]" id="checkbox-<?=$key?>" value="<?=$key?>" <?if($_SESSION['edit'][0]['cultures']):?><?if(in_array($value, $_SESSION['edit'][0]['cultures'])):?>checked<?endif;?><?endif;?>>
					<?endforeach;?>
				</div>
				<div>
					<p>К вейпингу</p>
					<select class="my_select" name="vape">
					<?foreach(get_relation_vape($mysqli) as $key=>$value):?>
					<option value="<?=$key?>" <?if($_SESSION['edit'][0]['vape_name']):?><?if($_SESSION['edit'][0]['vape_name']==$value):?>selected<?endif;?><?endif;?>><?=$value?></option>
					<?endforeach;?>
					</select>
				</div>
				<div>
					<p>К нецензурной лексике</p>
					<?foreach(get_relation_terms($mysqli) as $key=>$value):?>
					<label for="radio-<?=$key?>"><?=$value?></label>
					<input type="radio" name="terms" id="radio-<?=$key?>" value="<?=$key?>" <?if($_SESSION['edit'][0]['obscene_name']):?><?if($_SESSION['edit'][0]['obscene_name']==$value):?>checked<?endif;?><?else:?><?if($key == 3):?>checked<?endif;?><?endif;?>>
					<?endforeach;?>
					</select>
				</div>
			</div>
		</div>
		<div class="info">
			<?if($_SESSION['edit']):?>
			<input type="submit" value="Сохранить изменения в анкете">
			<a href="functions_for_users.php?act=cancel&id=<?=$_SESSION['edit'][0]['id']?>"><input type="button" value="Отменить" style="margin-top: 7px"></a>
			<?else:?>
			<input type="submit" value="Отправить эту чудо-анкету">
			<?endif;?>
		</div>
	</form>
</div>