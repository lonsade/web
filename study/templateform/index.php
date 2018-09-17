<?php
session_start();
include('templates/headers.inc.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?=$title?></title>
    <link type="text/css" rel="stylesheet" href="style.css">
    <script type="text/javascript" src="../../jquery-3.0.0.min.js"></script>
    <script type="text/javascript" src="../../jquery-ui.min.js"></script>
    <script type="text/javascript" src="style.js"></script>
</head>
<body>
    <?php
    include('templates/header.inc.php');
    ?>
    <div class="wrap">
    <?php
    include('templates/menu.inc.php');
    include('templates/content.inc.php');
    include('templates/footer.inc.php');
    ?>
    </div>
</body>
</html>