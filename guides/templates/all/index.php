<?php
	$arr_guides = get_guides();
?>
<?if(isset($arr_guides)):?>
<div class="content_guides">
	<div class="g_filter">
		<div class="search">
			<div class="type">
				<span>Поиск по</span>
				<select id="g_type">
					<option>Герою</option>
					<option>Названию</option>
					<option>Патчу</option>
					<option>Автору</option>
					<option>Дате</option>
					<option>Рейтингу</option>
				</select>
			</div>
			<div class="field">
				<span class="icon_search"></span>
				<input type="text">
			</div>
		</div>
		<div class="current_patch">
			<label for="patch" id="s_patch">Текущий патч</label>
			<input type="checkbox" id="patch" class="g_checkbox">
		</div>	
		<div class="with_rating">
			<label for="rating" id="s_rating">С рейтингом</label>
			<input type="checkbox" id="rating" class="g_checkbox">
		</div>
		<div class="with_views">
			<label for="views" id="s_views">С просмотрами</label>
			<input type="checkbox" id="views" class="g_checkbox">
		</div>
	</div>
	<div class="g_row" id="titles">
		<div class="g_hero">Герой</div>
		<div class="g_title">Название</div>
		<div class="g_patch">Патч</div>
		<div class="g_creator">Автор</div>
		<div class="g_date g_sorting">Дата</div>
		<div class="g_rating">Рейтинг</div>
		<div class="g_views">Просмотры</div>
	</div>
	<div class="list_guides">
		<?foreach($arr_guides as $guide):?>
		<div class="g_row" data-id="<?=$guide['id']?>">
            <div class="g_hero"><a href="#heroes><?=$guide['Hero_name']?>"><img alt="<?=$guide['Hero_name']?>" src="<?=$guide['image']?>"></a></div>
			<div class="g_title"><?=$guide['title']?></div>
			<div class="g_patch"><?=$guide['patch']?></div>
			<div class="g_creator"><?=$guide['login']?></div>
			<div class="g_date g_sorting"><?=$guide['date_t']?></div>
			<div class="g_rating">
				<?if(isset($guide['rating'])):?>
				<div id="g_rating_1"></div>
				<div id="g_rating_2"></div>
				<div id="g_rating_3"></div>
				<div id="g_rating_4"></div>
				<div id="g_rating_5"></div>
				<div id="r_process" style="width: <?=$guide['rating']*24?>;">
					<span></span>
					<span></span>
					<span></span>
					<span></span>
					<span></span>
				</div>
				<?else:?>
				<p>Нет оценок</p>
				<?endif;?>
			</div>
			<div class="g_views"><?=$guide['views']?></div>
		</div>
		<?endforeach;?>
	</div>
</div>
<?else:?>
<p>Гайдов еще нету</p>
<?endif;?>
<script type="text/javascript" src="templates/all/script.js"></script>