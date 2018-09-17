<menu class="box_shadow">
	<div id="pointer"></div>
	<?foreach($_SESSION['LIST_MENU'] as $el):?>
	<a id="<?=$el['id']?>" class="links" href="<?="/dtguides.ru/".$el['id']?>"><?=$el['name']?></a>
	<?endforeach;?>
</menu>