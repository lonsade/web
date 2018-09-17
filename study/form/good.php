<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Все хорошо</title>
	<link rel="stylesheet" type="text/css" href="/design/main.css">
</head>
<body>
	<p>
<?php
	if ($_SESSION['available']) echo 'Ваша анкета отправлена, оставайтесь на связи, мы с вами обязательно свяжемся (нет)';
	else
		echo 'Как вы сюда попали?!';
	$_SESSION['available'] = false;
?>
	</p>
	<a href="index.php"><p>Перейти к заполнению анкеты</p></a>
	<style type="text/css">
		p{
			text-align: center;
			margin-top: 50px;
			font-size: 20px;
			text-shadow: 0 0 1px #2e2e2e;
		}
		a{
			text-decoration: none;
		}
	</style>	
</body>
</html>