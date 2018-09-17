<?php
	define(HOST, "localhost");
	define(USER, "root");
	define(PASSWORD, "");
	define(DATABASE, "study");

	$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
	if ($mysqli->connect_error)
		exit(0);
?>