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
$strings = array(
	'name1'=>$_POST['name1'],
	'name2'=>$_POST['name2'],
	'name3'=>$_POST['name3'],
	'city'=>$_POST['city'],
	'age'=>$_POST['age'],
	'email'=>$_POST['email'],
	'about'=>$_POST['about'],
	'gender'=>$_POST['mw'],
	'smoke'=>$_POST['smoke']
);
$arrs = array(
	'modes'=>$_POST['modes'],
	'music'=>$_POST['music']
);
if ($strings['name1']=="" || $strings['name2']=="" || $strings['city']=="" || $strings['age']=="" || !isset($strings['gender'])){
	header("Location: index.php");
	exit(0);
}
$str = "<root/>";
if(file_exists("anket.xml")){
	$str = file_get_contents("anket.xml");
}
$xml = new SimpleXmlElement($str);
$anket = $xml->addChild("anket");
foreach ($strings as $key => $value){
	if ($value != '')
		$anket->addChild($key, trim(strip_tags($value)));
}
foreach ($arrs as $key => $value){
	if (isset($value)){
		$child = $anket->addChild($key);
		foreach ($value as $kind)
			$child->addChild("kind", trim(strip_tags($kind)));
	}
}
file_put_contents("anket.xml", $xml->asXML());
$_SESSION['send'] = true;
header("Location: index.php");
exit(0);
?>