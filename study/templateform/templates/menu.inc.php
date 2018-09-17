<div class="header">
    <div class="darkmenu">
        <div id="pointer" style="<?if($left):?>left: <?=$left?><?else:?>display: none;<?endif;?>"></div>
        <div class="links <?if($id_link==1):?>active<?endif;?>"><a href="index.php?id=home">Главная страница</a></div>
        <div class="links <?if($id_link==2):?>active<?endif;?>"><a href="index.php?id=create">Создать анкету</a></div>
        <div class="links <?if($id_link==3):?>active<?endif;?>"><a href="index.php?id=show">Показать анкеты</a></div>
        <div id="loader"></div>
    </div>
</div>