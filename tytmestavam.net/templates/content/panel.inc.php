<?php
	$get_banned_users = get_users_on_banned($mysqli, '2');
	$get_notverificate_users = get_users_on_banned($mysqli, '1');
	$get_users = get_users_on_banned($mysqli, '0');
	$get_admins = get_users_on_role($mysqli, '3');
?>

<?if($get_admins):?>
<p class="title_panel">Список админов</p>
<div class="hide_list">
<?foreach($get_admins as $user):?>
	<div class="list_panel">
		<?if($user['level']<$_SESSION['acc']['level'] && $_SESSION['acc']['level'] > 1):?>
		<div class="admin">
			<a href="admin.php?act=makecommon&user=<?=$user['id']?>">Убрать из админов</a>
			<a href="admin.php?act=unverify&user=<?=$user['id']?>">Откатить верификацию</a>
			<a href="admin.php?act=ban&user=<?=$user['id']?>">Забанить</a>
		</div>
		<?endif;?>
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
			<p class="stat_info">Роль</p>
			<p class="text_info"><?=get_role($user['role'])?></p>
		</div>
	</div>
<?endforeach;?>
</div>
<?endif;?>

<?if($get_users):?>
<p class="title_panel">Список пользователей</p>
<div class="hide_list">
<?foreach($get_users as $user):?>
	<div class="list_panel">	
		<?if($user['level']<$_SESSION['acc']['level'] && $_SESSION['acc']['level'] > 1):?>
		<div class="admin">
			<?if($user['role'] != '3'):?>
			<a href="admin.php?act=makeadmin&user=<?=$user['id']?>">Сделать админом</a>
			<?endif;?>
			<a href="admin.php?act=unverify&user=<?=$user['id']?>">Откатить верификацию</a>
			<a href="admin.php?act=ban&user=<?=$user['id']?>">Забанить</a>
		</div>
		<?endif;?>
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
			<p class="stat_info">Роль</p>
			<p class="text_info"><?=get_role($user['role'])?></p>
		</div>
	</div>
<?endforeach;?>
</div>
<?endif;?>

<?if($get_notverificate_users):?>
<p class="title_panel">Список пользователей, не прошедших верификацию</p>
<div class="hide_list">
<?foreach($get_notverificate_users as $user):?>
	<div class="list_panel">
		<?if($user['level']<$_SESSION['acc']['level']):?>
		<div class="admin">
			<a href="admin.php?act=verify&user=<?=$user['id']?>">Верифицировать</a>
			<a href="admin.php?act=ban&user=<?=$user['id']?>">Забанить</a>
		</div>
		<?endif;?>
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
			<p class="stat_info">Роль</p>
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
		<?if($user['level']<$_SESSION['acc']['level']):?>
		<div class="admin">
			<a href="admin.php?act=unban&user=<?=$user['id']?>">Восстановить</a>
		</div>
		<?endif;?>
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
			<p class="stat_info">Роль</p>
			<p class="text_info"><?=get_role($user['role'])?></p>
		</div>
	</div>
<?endforeach;?>
</div>
<?endif;?>