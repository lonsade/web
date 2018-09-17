<?php
$hero = get_info_hero($id);
?>

<div id="left_info">
	<div id="hero_image">
		<img src="<?=$hero['hero'][0]['image']?>" alt="<?=$id?>" />
	</div>
	<div id="hero_info">
		<div class="overview">
			<span class="title">
				
			</span>
			<span class="value"></span>
		</div>
	</div>
</div>
<div id="right_skills">
	
</div>

<style type="text/css">
	#left_info, #right_skills{
		display: inline-block;
		vertical-align: top;
	}
</style>