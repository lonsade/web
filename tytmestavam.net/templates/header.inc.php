<header>
  <div><?=$header?></div>
  <?if($_SESSION['acc']['login']):?>
  <div class="profile">
	  <span>Вы зашли как</span>
	  <div class="open_profile">
	  	<input type="button" value="<?=$_SESSION['acc']['login']?>">
	  </div>
	  <span> - <?=get_status($_SESSION['acc']['banned'])?></span>
  </div>
  <?if($_SESSION['acc']['banned']!=2):?>
  <div class="about_profile">
		<div class="view">
			<p class="stat_info">Логин</p>
			<p class="text_info"><?=$_SESSION['acc']['login']?></p>
		</div>
		<div class="view">
			<p class="stat_info">Email</p>
			<p class="text_info"><?=$_SESSION['acc']['email']?></p>
		</div>
		<div class="view">
			<p class="stat_info">Телефон</p>
			<p class="text_info"><?=$_SESSION['acc']['phone']?></p>
		</div>
		<div class="view">
			<p class="stat_info">Роль</p>
			<p class="text_info"><?=get_role($_SESSION['acc']['role'])?></p>
		</div>
		<div class="view">
			<input class="edit_profile_but" type="button" value="Редактировать профиль">
		</div>
  </div>
  <div class="edit_profile">
		<form action="edit_profile.php" method="post" autocomplete="off">
			<div class="view">
				<p class="stat_info">Логин</p>
				<input name="login" type="text" value="<?=$_SESSION['acc']['login']?>">
			</div>
			<div class="view">
				<p class="stat_info">Email</p>
				<input name="email" type="text" value="<?=$_SESSION['acc']['email']?>">
			</div>
			<div class="view">
				<p class="stat_info">Телефон</p>
				<input name="phone" type="text" value="<?=$_SESSION['acc']['phone']?>">
			</div>
			<div class="view">
				<p class="stat_info">Новый пароль</p>
				<input name="new_password" type="password" title="Оставьте пустым, если нет необходимости его менять">
			</div>
			<div class="view">
				<p class="stat_info">Подтвердите паролем</p>
				<input name="password" type="password">
			</div>
			<div class="view">
				<input type="submit" value="Сохранить изменения">
			</div>
			<div class="view">
				<input type="button" value="Отменить редактирование">
			</div>
		</form>
  </div>
  <?endif;?>
  <?endif;?>
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
				<label style="margin-left: 0px;margin-top: 7px;" for="remember">Запомнить меня</label>
				<input type="checkbox" name="remember" id="remember">
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