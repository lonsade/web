<?php
session_start();
if ($_SESSION['entered'] && $_GET['act'] == 1){
	session_destroy();
	unset($_COOKIE['acc']);
}
header('Location: index.php');
exit(0);
?>