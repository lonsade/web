<header>
  <div><?=$header?></div>
  <?if($_SESSION['acc']['login']):?><div class="profile">Вы зашли как <span><?=$_SESSION['acc']['login']?></span> (<?=get_role($_SESSION['acc']['role'])?>)</div><?endif;?>
  <?if($_SESSION['entered']):?>
  <div class="registration">
		<a class="button_logout" href="logout.php?act=1">Выйти</a>
  </div>
  <?else:?>
	<div class="registration">
		<div class="button_login">Войти</div>
		<div class="button_reg">Регистрация</div>
		<div class="window_login">
			<form action="login.php" method="post" autocomplete="off">
				<input id="l_login" type="text" placeholder="Логин" name="login">
				<input id="l_pass" type="password" placeholder="Пароль" name="password">
				<input id="l_but" type="submit" value="Войти">
			</form>
		</div>
		<div class="window_reg">
			<form action="registration.php" method="post" autocomplete="off">
				<input id="r_login" type="text" placeholder="Логин" name="login" <?if(isset($_SESSION['prev']['login'])):?>value="<?=$_SESSION['prev']['login']?>"<?endif;?>>
				<input id="r_pass" type="password" placeholder="Пароль" name="password">
				<input id="r_confirm" type="password" placeholder="Подтвердите пароль" name="confirm">
				<input id="r_email" type="text" placeholder="Email" name="email" <?if(isset($_SESSION['prev']['email'])):?>value="<?=$_SESSION['prev']['email']?>"<?endif;?>>
				<input id="r_phone" type="text" placeholder="Телефон" name="phone" <?if(isset($_SESSION['prev']['phone'])):?>value="<?=$_SESSION['prev']['phone']?>"<?endif;?>>
				<select class="my_select" id="r_role" name="role">
					<option value="0">Выберите желаемую роль</option>
					<option value="1" <?if($_SESSION['prev']['role'] == 1):?>selected<?endif;?>>Гострайтер</option>
					<option value="2" <?if($_SESSION['prev']['role'] == 2):?>selected<?endif;?>>Творец</option>
				</select>
				<input id="r_but" type="submit" value="Зарегистрироваться">
			</form>
		</div>
	</div>
	<?endif;?>
</header>