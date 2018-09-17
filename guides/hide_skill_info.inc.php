<?php
$text_info = explode('&', $skill['text_info']);
$int_info = explode('&', $skill['int_info']);
?>

<div class="tooltip">
	<span class="shower"></span>
	<div class="name"><?=$skill['title']?></div>
	<div class="type">
		<?foreach($text_info as $info):?>
		<?$temp=explode(':', $info);?>
		<p><span><?=$temp[0]?>:</span><?=$temp[1]?></p>
		<br>
		<?endforeach;?>
	</div>
	<div class="bio"><?=$skill['about']?></div>
	<div class="other">
		<?foreach($int_info as $info):?>
		<?$temp=explode(':', $info);?>
		<p><span><?=$temp[0]?>:</span><?=$temp[1]?></p>
		<br>
		<?endforeach;?>
	</div>
	<?if(!empty($skill['cooldown']) || !empty($skill['manacost'])):?>
	<div class="cdmp">
		<?if(!empty($skill['cooldown'])):?>
		<div class="cd"><?=$skill['cooldown']?></div>
		<?endif;?>
		<?if(!empty($skill['manacost'])):?>
		<div class="mp"><?=$skill['manacost']?></div>
		<?endif;?>
	</div>
	<?endif;?>
</div>