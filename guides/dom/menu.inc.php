<?php
$menu = get_progects();
?>
<menu class="box_shadow">
	<div id="pointer"></div>
	<?foreach($menu as $key=>$value):?>
	<div class="links" id="<?=$key?>"><p><?=$value?></p></div>
	<?endforeach;?>
</menu>