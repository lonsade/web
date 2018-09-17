<?php
$ankets = get_ankets($mysqli);
?>
<?if($ankets):?>
<div class="ankets">
	<?foreach($ankets as $ank):?>
	<div id="anket_<?=$ank['id']?>">
	<?$_SESSION['id_ankets'][]=$ank['id'];?>	
		<div class="extra_view">
			<div class="vissible">
				<div class="id_view">#<?=$ank['id']?></div>
				<?if($_SESSION['acc']['role'] == 3 || $_SESSION['acc']['role'] == 4):?>
				<div class="open"></div>
				<?endif;?>
			</div>
			<?if($_SESSION['acc']['role'] == 3 || $_SESSION['acc']['role'] == 4):?>
			<div class="edit">
				<a href="functions_for_users.php?act=delete&id=<?=$ank['id']?>">Удалить</a>
			</div>
			<?endif;?>
		</div>

		<div class="view">
			<p class="stat_info">Никнейм</p>
			<p class="text_info"><?=$ank['nickname']?></p>
		</div>
		<div class="view">
			<p class="stat_info">При обращении</p>
			<p class="text_info"><?=$ank['name']?></p>
		</div>
		<div class="view">
			<p class="stat_info">Возраст</p>
			<p class="text_info"><?=$ank['age']?></p>
		</div>
		<div class="view">
			<p class="stat_info">Email</p>
			<p class="text_info"><?=$ank['email']?></p>
		</div>
		<div class="view">
			<p class="stat_info">Телефон</p>
			<p class="text_info"><?=$ank['phone']?></p>
		</div>
		<?if($ank['achievment']):?>	
		<div class="view">
			<p class="stat_info">Достижения</p>
			<p class="text_info textarea_info"><?=$ank['achievment']?></p>
		</div>
		<?endif;?>
		<div class="view">
			<p class="stat_info">Рифма к слову "<?=$ank['word_name']?>"</p>
			<p class="text_info"><?=$ank['rifm']?></p>
		</div>

		<?if($ank['cultures']):?>	
		<div class="view">
			<p class="stat_info">Любимые культуры</p>
			<?foreach($ank['cultures'] as $value):?>
			<p class="text_info"><?=$value?></p>
			<?endforeach;?>
		</div>
		<?endif;?>
		<?if($ank['styles']):?>	
		<div class="view">
			<p class="stat_info">Любимые стили</p>
			<?foreach($ank['styles'] as $value):?>
			<p class="text_info"><?=$value?></p>
			<?endforeach;?>
		</div>
		<?endif;?>

		<?if($ank['vape_name']):?>	
		<div class="view">
			<p class="stat_info">Отношение к вейпу</p>
			<p class="text_info"><?=$ank['vape_name']?></p>
		</div>
		<?endif;?>
		<?if($ank['obscene_name']):?>	
		<div class="view">
			<p class="stat_info">Отношение к матам</p>
			<p class="text_info"><?=$ank['obscene_name']?></p>
		</div>
		<?endif;?>
	</div>
	<?endforeach;?>
</div>
<?else:?>
<p class="title_error">Анкет нет</p>
<?endif;?>