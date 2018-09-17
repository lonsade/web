<?php
session_start();
if ($_SESSION['entered'] && $_GET['act'] == 1){
	session_destroy();
	setcookie('login', '', time() - 30);
	setcookie('password', '', time() - 30);
}
header('Location: index.php');
exit(0);
?>