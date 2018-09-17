<?php
	$get_banned_users = get_users($mysqli, '2');
	$get_notverificate_users = get_users($mysqli, '1');
?>

<?if($get_notverificate_users):?>
<p class="title_panel">Список пользователей, не прошедших верификацию</p>
<div class="hide_list">
<?foreach($get_notverificate_users as $user):?>
	<div class="list_panel">
		<div class="admin">
			<a href="admin.php?act=verify&user=<?=$user['id']?>">Верифицировать</a>
			<a href="admin.php?act=ban&user=<?=$user['id']?>">Забанить</a>
		</div>
		<div class="view">
			<p class="stat_info">Идентификатор</p>
			<p class="text_info"><?=$user['id']?></p>
		</div>
		<div class="view">
			<p class="stat_info">Логин</p>
			<p class="text_info"><?=$user['login']?></p>
		</div>
		<div class="view">
			<p class="stat_info">Email</p>
			<p class="text_info"><?=$user['email']?></p>
		</div>
		<div class="view">
			<p class="stat_info">Номер телефона</p>
			<p class="text_info"><?=$user['phone']?></p>
		</div>
		<div class="view">
			<p class="stat_info">Желаемая роль</p>
			<p class="text_info"><?=get_role($user['role'])?></p>
		</div>
	</div>
<?endforeach;?>
</div>
<?endif;?>

<?if($get_banned_users):?>
<p class="title_panel">Список забаненных пользователей</p>
<div class="hide_list">
<?foreach($get_banned_users as $user):?>
	<div class="list_panel">
		<div class="view">
			<p class="stat_info">Идентификатор</p>
			<p class="text_info"><?=$user['id']?></p>
		</div>
		<div class="view">
			<p class="stat_info">Логин</p>
			<p class="text_info"><?=$user['login']?></p>
		</div>
		<div class="view">
			<p class="stat_info">Email</p>
			<p class="text_info"><?=$user['email']?></p>
		</div>
		<div class="view">
			<p class="stat_info">Номер телефона</p>
			<p class="text_info"><?=$user['phone']?></p>
		</div>
		<div class="view">
			<p class="stat_info">Желаемая роль</p>
			<p class="text_info"><?=get_role($user['role'])?></p>
		</div>
	</div>
<?endforeach;?>
</div>
<?endif;?>