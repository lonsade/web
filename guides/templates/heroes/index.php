<?php
    $heroes = get_heroes();
?>
<div id="contentHeroes">
    <div class="filterHeroes">
        <div class="search-hero">
            <div class="select-title">Имя героя:</div>
            <input type="text" id="searchPickHero" class="searching" /> </div>
        <div class="filter-hero">
            <div class="select-content" id="select-attack">
                <div class="select-title">По типу атаки:</div>
                <div class="select-list">
                    <div class="list-name main-list" id="all">Все</div>
                    <div class="list-name" id="0">Ближний бой</div>
                    <div class="list-name" id="1">Дальний бой</div>
                </div>
            </div>
            <div class="select-content" id="select-role">
                <div class="select-title">По роли:</div>
                <div class="select-list">
                    <div class="list-name main-list" id="all">Все</div>
                    <div class="list-name" id="Carry">Carry</div>
                    <div class="list-name" id="Disabler">Disabler</div>
                    <div class="list-name" id="Support">Support</div>
                    <div class="list-name" id="Initiator">Initiator</div>
                    <div class="list-name" id="Jungler">Jungler</div>
                    <div class="list-name" id="Support">Support</div>
                    <div class="list-name" id="Durable">Durable</div>
                    <div class="list-name" id="Nuker">Nuker</div>
                    <div class="list-name" id="Pusher">Pusher</div>
                    <div class="list-name" id="Escape">Escape</div>
                </div>
            </div>
        </div>
        <div class="helperToName" id="hero-name"> </div>
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
<script type="text/javascript" src="js/heroes.js"></script>
<script type="text/javascript" src="templates/heroes/next.js"></script>