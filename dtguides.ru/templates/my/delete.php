<?php
	require "../../query.inc.php";
	require "../../labs.inc.php";
	$sql = "DELETE FROM guides WHERE id = '".$_POST['id']."'";
	mysql_query($sql) or die(mysql_error());
?>