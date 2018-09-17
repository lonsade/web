<?php
	header('Last-Modified: '. gmdate('D, d M Y H:i:s', time()) . ' GMT');
	header('Expires: '. gmdate('D, d M Y H:i:s', time()) . ' GMT');
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");  
?>

<?php
	require "query.inc.php";
	require "labs.inc.php";	
?>

<!DOCTYPE>

<html>
	<head>
		<title>В процессе...</title>
		<meta charset="utf-8">
		<script type="text/javascript" src="js/jquery-3.0.0.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui.min.js"></script>
		<script type="text/javascript" src="js/jquery.placeholder.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/styles.css">
	</head>
	
	<body>
		<?include('dom/header.inc.php');?>
		<div class="wrap box_shadow">
			<?include('dom/menu.inc.php');?>
			<?include('dom/content.inc.php');?>
			<?include('dom/footer.inc.php');?>
		</div>
		<script type="text/javascript" src="js/guides.js"></script>
	</body>
</html>