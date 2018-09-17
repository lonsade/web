<?php
$ankets = get_ankets($mysqli, $_SESSION['acc']['id']);
function get_text_old($old){
	$old *= 1;
	$mod = $old % 10;
	if ($mod == 0 || $mod == 1 || $mod == 5 || $mod == 6 || $mod == 7 || $mod == 8 || $mod == 9)
		return 'лет';
	else
		return 'года';
}
?>
<?if($ankets):?>
<div class="ankets">
	<?foreach($ankets as $ank):?>
	<div id="anket_<?=$ank['id']?>">
		<span id="id_ankets">#<?=$ank['id']?></span>
		<div class="view">
			<p class="stat_info">ФИО</p>
			<p class="text_info"><?=$ank['name']?> <?=$ank['last_name']?> <?if($ank['patr']){echo $ank['patr'];}?></p>
			<p class="text_info"><?=$ank['age']?> <?=get_text_old($ank['age'])?></p>
		</div>
		<div class="view">
			<p class="stat_info">Город</p>
			<p class="text_info"><?=$ank['city']?></p>
		</div>
		<div class="view">
			<p class="stat_info">Email</p>
			<p class="text_info"><?=$ank['email']?></p>
		</div>	
		<div class="view">
			<p class="stat_info">Телефон</p>
			<p class="text_info"><?=$ank['phone']?></p>
		</div>	
		<div class="view">
			<p class="stat_info">Пол</p>
			<p class="text_info"><?=$ank['sex_title']?></p>
		</div>
		<?if($ank['about']):?>	
		<div class="view">
			<p class="stat_info">О себе</p>
			<p class="text_info textarea_info"><?=$ank['about']?></p>
		</div>
		<?endif;?>
		<?if($ank['modes']):?>	
		<div class="view">
			<p class="stat_info">Политические режимы</p>
			<?foreach($ank['modes'] as $mode):?>
			<p class="text_info"><?=$mode?></p>
			<?endforeach;?>
		</div>
		<?endif;?>
		<?if($ank['smoke_title']):?>	
		<div class="view">
			<p class="stat_info">Отношение к курению</p>
			<p class="text_info"><?=$ank['smoke_title']?></p>
		</div>
		<?endif;?>
		<?if($ank['genres']):?>	
		<div class="view">
			<p class="stat_info">Жанры музыки</p>
			<?foreach($ank['genres'] as $mode):?>
			<p class="text_info"><?=$mode?></p>
			<?endforeach;?>
		</div>
		<div class="edit_remove">
			<span class="edit" title="Изменить"></span>
			<span class="remove" title="Удалить"></span>
		</div>
		<?endif;?>
	</div>
	<?endforeach;?>
</div>
<?else:?>
<p class="title_error">Анкет нет</p>
<?endif;?>