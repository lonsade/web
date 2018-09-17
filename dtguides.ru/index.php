<?php
	session_start();
	header('Last-Modified: '. gmdate('D, d M Y H:i:s', time()) . ' GMT');
	header('Expires: '. gmdate('D, d M Y H:i:s', time()) . ' GMT');
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");  
?>

<?php
	require_once 'query.inc.php';
	require_once 'labs.inc.php';
	require_once 'sessions.inc.php';
?>

<!DOCTYPE>
<html>
	<head>
		<title>В процессе...</title>
		<meta charset="utf-8">
		<script type="text/javascript" src="/dtguides.ru/js/jquery-3.0.0.min.js"></script>
		<script type="text/javascript" src="/dtguides.ru/js/jquery-ui.min.js"></script>
		<script type="text/javascript" src="/dtguides.ru/js/jquery.mousewheel.min.js"></script>
		<script type="text/javascript" src="/dtguides.ru/js/jquery.placeholder.min.js"></script>
		<link rel="stylesheet" type="text/css" href="/dtguides.ru/css/styles.css">
	</head>
	
	<body>
		<?require_once 'dom/header.inc.php';?>
		<div class="wrap box_shadow">
			<?require_once 'dom/menu.inc.php';?>
			<?require_once 'dom/content.inc.php';?>
			<?require_once 'dom/footer.inc.php';?>
		</div>
		<div id="other"></div>
		<script type="text/javascript" src="/dtguides.ru/js/guides.js"></script>
	</body>
</html>