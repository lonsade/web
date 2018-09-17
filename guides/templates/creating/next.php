<?php
	$skills = get_hero_skills($id);
	$hero_for_guide = get_hero_for_guide($id);
  $row = 1;
  $titles = array('Начальные предметы','Ранние предметы','Основные предметы','По ситуации','Добавить');
  $strength = explode(' + ', $hero_for_guide['strength']);
  $agility = explode(' + ', $hero_for_guide['agility']);
  $intellect = explode(' + ', $hero_for_guide['intellect']);
  $damage = explode(' - ', $hero_for_guide['damage']);
  $id_skill = 0;
?>
<div class="guide_creating" style="margin-top: 0;" data-hero="<?=$id?>">
	<div class="top">
		<div class="shot_info">
			<div class="info_hero for_health">
				<div id="health_bar" class="progress_hm" style="width: <?=get_width_h(get_health($strength[0]))?>"><?=get_health($strength[0])?></div>
			</div>
			<p class="info_hero">
				<img src="/guides/images/resources/hero/speed.png" width="53px" style="margin-left: -3px;">
				<span id="speed_bar"><?=$hero_for_guide['move_speed']?></span>
			</p>
			<p class="info_hero">
				<img src="/guides/images/resources/hero/attack.png" width="39px" style="margin-top: 3px;">
				<span id="damage_begin_bar"><?=get_begin_damage($hero_for_guide['type'], $damage[0], $strength[0], $agility[0], $intellect[0])?></span>
				<span> - </span>
				<span id="damage_end_bar"><?=get_end_damage($hero_for_guide['type'], $damage[1], $strength[0], $agility[0], $intellect[0])?></span>
			</p>
			<p class="info_hero">
				<img src="/guides/images/resources/hero/defense.png" width="35px">
				<span id="armor_bar"><?=$hero_for_guide['armor']?></span>
			</p>
		</div>
		<div class="image">
			<p class="name_hero"><?=$hero_for_guide['name']?></p>
			<img src="<?=$hero_for_guide['image']?>" alt="<?=$id?>" width="242px">
		</div>
		<div class="shot_info">
			<div class="info_hero">
				<div id="mana_bar" class="progress_hm" style="width: <?=get_width_m(get_mana($intellect[0]))?>"><?=get_mana($intellect[0])?></div>
			</div>
			<p class="info_hero"<?if($hero_for_guide['type']=='сила'):?> style="color:#00bcff;"<?endif;?>>
				<img src="/guides/images/resources/hero/strength.png">
				<span id="strength_bar"><?=$strength[0]?></span>
				<span> + </span>
				<span id="strength_bar_up"><?=$strength[1]?></span>
			</p>
			<p class="info_hero"<?if($hero_for_guide['type']=='ловкость'):?> style="color:#00bcff;"<?endif;?>>
				<img src="/guides/images/resources/hero/agility.png">
				<span id="agility_bar"><?=$agility[0]?></span>
				<span> + </span>
				<span id="agility_bar_up"><?=$agility[1]?></span>
			</p>
			<p class="info_hero"<?if($hero_for_guide['type']=='интеллект'):?> style="color:#00bcff;"<?endif;?>>
				<img src="/guides/images/resources/hero/intellect.png">
				<span id="intellect_bar"><?=$intellect[0]?></span>
				<span> + </span>
				<span id="intellect_bar_up"><?=$intellect[1]?></span>
			</p>
		</div>
	</div>
	<div class="tools_for_guide accordion">
		<!--tool for filling in the name of the guide-->
		<div class="title">
			<span>Название гайда</span>
			<div class="error_creating">Придумайте имя гайду</div>
		</div>
		<div class="tool" id="tool_for_name">
			<textarea maxlength="40" name="name"></textarea>
		</div>
		<!--tool for filling in information about the guide-->
		<div class="title">
			<span>Информация по гайду</span>
			<div class="error_creating">Придумайте информацию по гайду</div>
		</div>
		<div class="tool" id="tool_for_about">
			<textarea maxlength="300" name="bit"></textarea>
		</div>
		<!--tool for filling in the comments to the skills-->
		<div class="title">
			<span>Комментарии к скилам</span>
			<div class="error_creating">Придумайте комментарии к скилам</div>
		</div>
		<div class="tool" id="tool_for_skills">
			<div class="skills">
			<?foreach($skills as $skill):?>
		  	<div>
		  		<img src="<?=$skill['image']?>">
		  		<?include('hide_skill_info.inc.php');?>
      	</div>
			<?endforeach;?>
			</div>
			<div class="comments_skills">
			<?foreach($skills as $skill):?>
				<textarea name="skill_<?=$id_skill++?>" maxlength="150" data-id="<?=$skill['id']?>"></textarea>
			<?endforeach;?>
			</div>
		</div>
		<!--tool for filling skillbuild-->
		<div class="title">
			<span>Скиллбилд</span>
			<div class="error_creating">Используйте все возможные уровни прокачки</div>
		</div>
		<div class="tool" id="tool_for_skillbuild">
			<div class="col_skills">
      <?foreach($skills as $skill):?>
      	<img src="<?=$skill['image']?>" alt="<?=$skill['title']?>">
      	<?include('hide_skill_info.inc.php');?>
      <?endforeach;?>
				<img src="http://localhost/guides/images/resources/plus_dota.png" alt="Plus">
			</div>
			<div class="col_levels">
			<?for($i = 1; $i < 6; $i++):?>
				<div>
				<?for($c = 1; $c < 26; $c++):?>
	        <?if($i==4 && $c>0 && $c<6):?>
	        <div class="levels levelup_off" data-row="<?=$i?>" data-col="<?=$c?>"></div>
	        <?else:?>
	        <div class="levels" data-row="<?=$i?>" data-col="<?=$c?>"><span><?=$c?></span></div>
	        <?endif;?>
		    <?endfor;?>
		    </div>
			<?endfor;?>
			</div>
			<div class="col_refresh">
				<div data-row="1"></div>
				<div data-row="2"></div>
				<div data-row="3"></div>
				<div data-row="4"></div>
				<div data-row="5"></div>
			</div>
		</div>
		<!--tool for filling itembuild-->
		<div class="title">
			<span>Итембилд</span>
			<div class="error_creating">Как минимум 2 стези должны содержать хоть по одному предмету</div>
		</div>
		<div class="tool" id="tool_for_itembuild">
			<div class="stages">
			<?foreach($titles as $k => $title):?>
				<div id="stage_<?=$k?>" class="content_for_items">
				<textarea data-stage-id="<?=$k?>" name="title_stage_<?=$k?>" maxlength="20"><?=$title?></textarea>
				<div class="gold"></div>
				<?for($count = 1; $count < 13; $count++):?>
					<?if($count < 7):?>
					<div data-col="<?=$count?>" class="container c_important"></div>
					<?else:?>
					<div data-col="<?=$count?>" class="container"></div>
					<?endif;?>
				<?endfor;?>
				</div>
				<?$row++;?>
			<?endforeach;?>
			</div>
		<?include("items.inc.php");?>
		</div>
	</div>
	<div id="create_guide">Сохранить гайд</div>
	<!--<input id="refresh_guide" type="submit">-->
</div>
<script type="text/javascript" src="templates/creating/creating.js"></script>