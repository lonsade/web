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
                <option value="Carry">Carry</option>
                <option value="Disabler">Disabler</option>
                <option value="Support">Support</option>
                <option value="Initiator">Initiator</option>
                <option value="Jungler">Jungler</option>
                <option value="Support">Support</option>
                <option value="Durable">Durable</option>
                <option value="Nuker">Nuker</option>
                <option value="Pusher">Pusher</option>
                <option value="Escape">Escape</option>
            </select>
        </div>
        <div class="text_box">Имя героя</div>
    </div>
    <div class="allHeroes">
    <?foreach(get_heroes() as $party):?>
        <div class="forTypesHeroes">
        <?foreach($party as $type):?>
            <div class="typeHeroes">
            <?foreach($type as $hero):?>
                <?$fight = (strripos($hero['fight'],'ближний бой'))?'1':'2';?>
                <div>
                    <img src="<?=$hero['image']?>" alt="<?=$hero['name']?>" class="imgHeroForView" data-role="<?=$hero['role']?>" data-fight="<?=$fight?>"/>
                </div>
            <?endforeach;?>
            </div>
        <?endforeach;?>
        </div>
    <?endforeach;?> 
    </div>
</div>
<script type="text/javascript" src="/dtguides.ru/js/filter.js"></script>
<script type="text/javascript" src="/dtguides.ru/js/heroes.js"></script>