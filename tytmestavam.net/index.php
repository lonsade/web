<?php
session_start();
require('templates/headers.inc.php');
require('query.inc.php');
require('labs.php');

if (!isset($_SESSION['entered']))
  $_SESSION['acc']['role'] = 0;

if (isset($_COOKIE['login']) && !isset($_SESSION['entered'])){
  login($mysqli, $_COOKIE['login'], $_COOKIE['password'], false, false);
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title><?=$title?></title>
  <link type="text/css" rel="stylesheet" href="style.css">
  <script type="text/javascript" src="../../jquery-3.0.0.min.js"></script>
  <script type="text/javascript" src="../../jquery-ui.min.js"></script>
  <script type="text/javascript" src="/dtguides.ru/js/jquery.mousewheel.min.js"></script>
  <script type="text/javascript" src="/dtguides.ru/js/jquery.placeholder.min.js"></script>
  <script type="text/javascript" src="script.js"></script>
  <script type="text/javascript" src="style.js"></script>
</head>
<body>
  <?include('templates/header.inc.php');?>
  <div class="wrap">
  <?include('templates/menu.inc.php');?>
    <div class="content">
    <?include('templates/content/'.$content);?>
    </div>
  <?include('templates/footer.inc.php');?>
  </div>
  <div id="other"></div>
  <?include('templates/dialog.inc.php');?>
</body>
</html>