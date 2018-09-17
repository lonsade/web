<?php
	$items = get_items();
?>
<div class="block_items">
<?foreach($items as $name => $item):?>
	<div id="<?=$name?>_type">
	<?foreach($item as $info):?>
		<div class="c_item">
			<img data-id="<?=$info['id']?>" data-price="<?=$info['cost']?>" src="<?=$info['image']?>" alt="<?=$info['name']?>" class="item_image">
		</div>
	<?endforeach;?>
	</div>
<?endforeach;?>
</div>