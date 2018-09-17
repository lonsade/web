<?php

	session_start();

	if($_SERVER['REQUEST_METHOD'] != 'POST'){
		header('Location: index.php');
		exit(0);
	}
	if(!isset($_POST)){
		header("Location: index.php");
		exit(0);
	}
	$name1 = trim(strip_tags($_POST['name1']));
	$name2 = trim(strip_tags($_POST['name2']));
	$name3 = trim(strip_tags($_POST['name3']));
	$city = trim(strip_tags($_POST['city']));
	$age = trim(strip_tags($_POST['age']));
	$email = trim(strip_tags($_POST['email']));
	$about = trim(strip_tags($_POST['about']));
	$gender = trim(strip_tags($_POST['mw']));
	$modes = $_POST['modes'];
	$smoke = trim(strip_tags($_POST['smoke']));
	$music = $_POST['music'];
	
	if ($name1=="" || $name2=="" || $city=="" || $age=="" || !isset($gender)){
		header("Location: index.php");
		exit(0);
	}

	$str = "<root/>";
	if(file_exists("anket.xml")){
		$str = file_get_contents("anket.xml");
	}
	$xml = new SimpleXmlElement($str);
	$anket = $xml->addChild("anket");
	$anket->addChild("name1", $name1);
	$anket->addChild("name2", $name2);
	if ($name3!="")
		$anket->addChild("name3", $name3);
	$anket->addChild("city", $city);
	$anket->addChild("age", $age);
	if ($email!="")
		$anket->addChild("email", $email);
	$anket->addChild("gender", $gender);
	if ($about!="")
		$anket->addChild("about", $about);
	if (isset($modes)){
		$mode = $anket->addChild('modes');
		foreach ($modes as $m)
			$mode->addChild("mode", trim(strip_tags($m)));
	}
	$anket->addChild("smoke", $smoke);
	if (isset($music)){
		$m = $anket->addChild('music');
		foreach ($music as $genre)
			$m->addChild("genre", trim(strip_tags($genre)));
	}

	file_put_contents("anket.xml", $xml->asXML());

	$_SESSION['available'] = true;
	header("Location: good.php");
	exit(0);
?>