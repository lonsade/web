<?php
	define("USER_NAME", $_COOKIE['login']);
	require "../../query.inc.php";
	require "../../labs.inc.php";
	
	if(USER_NAME){
		echo setRating($_POST['star'], $_POST['guid'], USER_NAME);
	}else{
		echo 0;
	}
?>