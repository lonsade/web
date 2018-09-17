<?php
$menu = array(
  array(
    'id' => 'home',
    'title' => 'Главная страница',
    'access' => array(0,1,2,3,4)
  ),
  array(
    'id' => 'my',
    'title' => 'Мои анкеты',
    'access' => array(1,3,4)
  ),
  array(
    'id' => 'create',
    'title' => 'Создать анкету',
    'access' => array(1,3,4)
  ),
  array(
    'id' => 'show',
    'title' => 'Все анкеты',
    'access' => array(2,3,4)
  ),
  array(
    'id' => 'panel',
    'title' => 'Панель управления',
    'access' => array(3,4)
  )
);
?>

<div class="header">
  <div class="darkmenu">
    <div id="pointer"></div>
    <?foreach($menu as $el):?>
    <?if(in_array($_SESSION['acc']['role'], $el['access'])):?>
    <div class="links <?if($_GET['id']==$el['id']):?>active<?endif;?>"><a href="index.php?id=<?=$el['id']?>"><?=$el['title']?></a></div>
    <?endif;?>
    <?endforeach;?>
    <div id="loader"></div>
  </div>
</div>