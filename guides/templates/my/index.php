<?php
	define("USER_NAME", $_COOKIE['login']);
	$my_guides = getGuides(USER_NAME);
?>

<?php
	if($my_guides){
?>
<div class="contentAllGuides">
	<div id="commonTitles">
		<span>Герой</span>
		<span>Название</span>
		<span>Настройки</span>
		<span>Дата</span>
		<span>Рейтинг</span>
		<span>Просмотры</span>
	</div>
	<?php
foreach($my_guides as $guid){
$dt = date("d.m.y", $guid['dt']);
$name = upData($guid['name']);
$rating = ($guid['n_rating'] != 0) ? $guid['rating'] / $guid['n_rating'] : 0;
echo <<<GUIDES
		<div class="guide" id="guid_{$guid['id']}">
			<span id="hero">{$guid['hero']}</span>
			<span id="name">$name</span>
			<span id="setting"><span id="edit" title="Редактировать"></span><span id="delete" title="Удалить"></span></span>
			<span id="date">$dt</span>
			<span id="rating" title="{$guid['n_rating']} оценок">
				<span class="stars_show"></span>
				<span class="stars_active" style="width: {$rating}px;"></span>
			</span>
			<span id="looks">{$guid['looks']}</span>
		</div>
GUIDES;
}
	?>
<?php
	}else{
		echo '<p class="no-guides">У вас нет ни одного гайда, чтобы создать его, перейдите по <a href="#creating">этой ссылке</a></p>';
	}
?>
<script type="text/javascript" src="templates/my/js/creating.js"></script>