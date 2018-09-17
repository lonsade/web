<?php
	$heroes = get_heroes();
?>
<div id="contentHeroes">
	<div class="g_filter">
		<div class="search">
			<div class="type">
				<span>Имя героя</span>
			</div>
			<div class="field">
				<input type="text">
			</div>
		</div>
		<div class="e_filter">
			<span>По типу атаки</span>
			<select id="type_of_attack">
				<option value="0">Все</option>
				<option value="1">Ближний бой</option>
				<option value="2">Дальний бой</option>
			</select>
		</div>	
		<div class="e_filter">
			<span>По типу атаки</span>
			<select id="type_of_role">
				<option value="0">Все</option>
				<option value="1">Carry</option>
				<option value="2">Disabler</option>
				<option value="3">Support</option>
				<option value="4">Initiator</option>
				<option value="5">Jungler</option>
				<option value="6">Support</option>
				<option value="7">Durable</option>
				<option value="8">Nuker</option>
				<option value="9">Pusher</option>
				<option value="10">Escape</option>
			</select>
		</div>
		<div class="text_box">Имя героя</div>
	</div>
	<div class="allHeroes">
	<?foreach($heroes as $party):?>
        <div class="forTypesHeroes">
        <?foreach($party as $type):?>
            <div class="typeHeroes">
            <?foreach($type as $hero):?>
                <?$fight = (strripos($hero['fight'],'ближний бой'))?'0':'1';?>
                <div>
                    <img style="opacity: 1;" src="<?=$hero['image']?>" alt="<?=$hero['name']?>" class="imgHeroForView" data-role="<?=$hero['role']?>" data-fight="<?=$fight?>"/>
                </div>
            <?endforeach;?>
            </div>
        <?endforeach;?>
        </div>
    <?endforeach;?> 
	</div>
</div>
<script type="text/javascript" src="js/filter.js"></script>
<script type="text/javascript" src="js/heroes.js"></script>
<script type="text/javascript" src="templates/creating/next.js"></script>