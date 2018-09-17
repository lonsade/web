<?
require "query.inc.php";
?>
<link type="text/css" rel="StyleSheet" href="css/creating.css.php">
<style type="text/css">
</style>


<script type="text/javascript">
	
</script>


<?
$able = '14-66';
$rating2 = '14-66,14-110';
$pattent = '/(,'.$able.'$|'.$able.',)/';
preg_replace($pattent, '', $rating2);




//Данные
	define("DB_HOST", "localhost");
	define("DB_LOGIN", "root");
	define("DB_PASSWORD", "");
	define("DB_NAME", "dota2");
	//Запрос в базу
	$mysqli = new mysqli(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME);
	//Проверка подключения
	if(mysqli_connect_errno()){
		echo "Не удалось подключиться: " . mysqli_connect_error();
		exit();
	}
	
	
	function fetch($query, $mysqli){
		$arr = array();
		if ($result = $mysqli->query($query)) {

			/* выборка данных и помещение их в массив */
			while($row = $result->fetch_assoc()){
				$arr[] = $row;
			}

			/* очищаем результирующий набор */
			$result->close();
		}
		return $arr;
	}

$arrU = fetch("SELECT ratings FROM users WHERE login = 'Lonsade'", $mysqli);
if(!strrpos($arrU[0]['ratings'], '18')){
	echo $arrU[0]['ratings'];
}

?>