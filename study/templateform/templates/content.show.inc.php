<?php
$_SESSION['send'] = false;
?>
<?php if(!file_exists("anket.xml")):?>
<p class="no_ankets">База знаний каким-то образом до сих пор еще пуста</p>
<?php else:?>
<?php
$str = file_get_contents("anket.xml");
if (isset($str)){
$xml = new SimpleXmlElement($str);
$id=1;
$t_gender = array(
	'no'=>'Пока еще не понял',
	'm'=>'Мужской',
	'w'=>'Женский'
);
$t_modes = array(
	'k'=>'Комунизм',
	'd'=>'Демократия',
	's'=>'Социализм',
	'm'=>'Марксизм',
	'f'=>'Фашизм',
	'n'=>'Национализм'
);
$t_music = array(
	'1'=>'Хип-хоп',
	'2'=>'Рок',
	'3'=>'Популярная',
	'4'=>'Электронника',
	'5'=>'Клауд рэп'
);
$t_smoke = array(
	'1'=>'Не переношу',
	'2'=>'Негативно',
	'3'=>'Нейтрально',
	'4'=>'Положительно',
	'5'=>'Смысл моей жизни'
);
}
?>
<div class="ankets">
	<?foreach($xml->anket as $ank):?>
	<div id="anket_<?=id?>">
		<span id="id_ankets">#<?=$id?></span>
		<div class="info">
			<p>Имя</p>
			<p><?=$ank->name1?></p>
		</div>
		<div class="info">
			<p>Фамилия</p>
			<p><?=$ank->name2?></p>
		</div>
		<?if(isset($ank->name3)):?>
		<div class="info">
			<p>Отчество</p>
			<p><?=$ank->name3?></p>
		</div>
		<?endif;?>
		<div class="info">
			<p>Город</p>
			<p><?=$ank->city?></p>
		</div>
		<div class="info">
			<p>Возраст</p>
			<p><?=$ank->age?></p>
		</div>
		<?if(isset($ank->email)):?>
		<div class="info">
			<p>Email</p>
			<p><?=$ank->email?></p>
		</div>
		<?endif;?>
		<div class="info">
			<p>Пол</p>
			<p><?=$t_gender[(string)$ank->gender]?></p>
		</div>
		<div class="info">
			<p>О себе</p>
			<p><?=$ank->about?></p>
		</div>
		<div class="info">
			<p>Политические режимы</p>
			<?foreach($ank->modes->kind as $kind):?>
			<p><?=$t_modes[(string)$kind]?></p>
			<?endforeach;?>
		</div>
		<div class="info">
			<p>Отношение к курению</p>
			<p><?=$t_smoke[(string)$ank->smoke]?></p>
		</div>
		<div class="info">
			<p>Жанры музыки</p>
			<?foreach($ank->music->kind as $kind):?>
			<p><?=$t_music[(string)$kind]?></p>
			<?endforeach;?>
		</div>
	</div>
	<?php $id++;?>
	<?endforeach;?>
</div>
<?php endif;?>