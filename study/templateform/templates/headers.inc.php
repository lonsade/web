<?php
$title = 'Главная страница';
$header = "Добро пожаловать на этот необычный сайт, который покажет вам обратную стронону луны";
$left = '58px';
$id_link = 1;
$id = strtolower(strip_tags(trim($_GET['id'])));
switch($id){
    case 'home': 
        $title = 'Главная страница';
        $header = 'Добро пожаловать на этот необычный сайт, который покажет вам обратную стронону луны';
        $left = '58px';
        $id_link = 1;
        break;
    case 'create': 
        $title = 'Создание анкеты';
        $header = 'Здесь осуществлятся все ваши мечты';
        $left = '211px';
        $id_link = 2;
        break;
    case 'show': 
        $title = 'Все анкеты';
        $header = 'Здесь хранится база всех знаний';
        $left = '363px';
        $id_link = 3;
        break;
    default:
        if ($id != ''){
            $title = 'Ошибочка';
            $header = 'Ваши желания заходят за пределы разумной логики';
            $left = false;
            $id_link = false;
        }
        break;
}
?>