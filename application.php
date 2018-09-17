<!Doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>
			Анкета
		</title>
		<style>
			body
			{
				background: url(alphard.jpg);
			}
			div.main
			{
				width: 550px;
				height: 350px;
			}
			div.main2
			{
				width: 550px;
				height: 300px;
			}
			div.a 
			{
				background: #32CD32;
				color: #FFFFFF;
				padding: 10px;
				border-radius: 5px;
			}
			div.b 
			{
				background: #FFFFFF;
				color: #000000;
				padding: 10px;
				border-radius: 5px;
				width: 250px; 
			}
			div.c 
			{
				background: #FFFFFF;
				color: #000000;
				padding: 10px;
				border-radius: 5px;
				width: 250px;
				position: relative;
				top: -155px;				
				right: -300px;  
			}
			div.d 
			{
				background: #FFFFFF;
				color: #000000;
				padding: 10px;
				border-radius: 5px;
				width: 250px;
				position: relative;
				top: -120px;				 
			}
			div.e 
			{
				background: #FFFFFF;
				color: #000000;
				padding: 10px;
				border-radius: 5px;
				width: 250px;
				position: relative;
				top: -275px;
				right: -300px;				
			}
			div.f 
			{
				padding: 10px;
				width: 250px;
				position: relative;
				top: -325px;
				right: -300px;				
			}
			h1
			{
				font-family: 'Comic sans MS', fantasy;
			}
			p.a
			{
				color: #FFFFFF;
			}
			p.q
			{
				color: red;
			}
			button
			{
				background: -webkit-gradient(linear, 0 0, 0  100%, from(#D0ECF4), to(#D0ECF4), color-stop(0.5, #5BC9E1));
				border-radius: 5px;
				font-size: 120%
			}
		</style>
	</head>
	<body>
		<form method="post" action="res.html">
		<h1 align="center"> <div class="a"> Анкета SPL-щика</div></h1>
		<div class="main">
		<div class="b" <p align="left">
			Какую музыку Вы предпочитаете? <br>
			<input type="checkbox" checked name="classick" value="classick"> Классика <br>
			<input type="checkbox" name="instr" value="instr"> Инструментал <br>
			<input type="checkbox" name="rock" value="rock"> Рок <br>
			<input type="checkbox" name="niger" value="rap"> Рэп <br>
			<input type="checkbox" name="club" value="club"> Клубная <br>
		</p> </div>
		<div class="c" <p align="left">
			Звуковое давление в салоне <br>
			<input type="radio" checked name="db" value="db1"> 130-139.9 Дб <br>
			<input type="radio"  name="db" value="db2"> 140-149.9 Дб <br>
			<input type="radio"  name="db" value="db3"> 150-154.9 Дб <br>
			<input type="radio"  name="db" value="db4"> 155-159.9 Дб <br>
			<input type="radio"  name="db" value="db5"> 160+ Дб <br>
		</p> </div>
		<div class="d" <p align="left">
			Компоненты системы <br>
			<input type="checkbox" checked name="Pride" value="Pride"> Pride <br>
			<input type="checkbox" name="Alphard" value="Alphard"> Alphard <br>
			<input type="checkbox" name="Sundown" value="Sundown"> Sundown <br>
			<input type="checkbox" name="Ural" value="Ural"> Ural <br>
			<input type="checkbox" name="Egge" value="Egge"> Egge <br>
		</p> </div>
		<div class="e" <p align="left">
			Бюджет системы <br>
			<input type="radio" checked name="budget" value="budget1"> 1-50 т.р. <br>
			<input type="radio"  name="budget" value="budget2"> 50-150 т.р. <br>
			<input type="radio"  name="budget" value="budget3"> 150-300 т.р. <br>
			<input type="radio"  name="budget" value="budget4"> 300-500 т.р. <br>
			<input type="radio"  name="budget" value="budget5"> 500+ т.р. <br>
		</p> </div>
		</div>
		<div class="main2">
		<p class="a">Введите своё имя(*)<br><input type="text" placeholder="Вася" maxlength="30" required name="human_name"></p>
		<p class="a">Введите свой номер телефона<br><input type="tel" placeholder="8XXXXXXXXXX" pattern="8[0-9]{10}" maxlength="11" name="phone"></p>
		<p class="a">Введите свой e-mail<br><input type="email" placeholder="xxx@xxx.xxx" name="e-mail"></p>
		<p class="a">Подробное описание своей системы<br>
		<textarea name="description" maxlength="500" cols="40" rows="6"> </textarea></p><br>
		<div class="f" align="center"> <p class="a">Сколько лет занимаетесь автозвуком?<br>
	    <select name="year">
		<option value="y1" selected>Меньше года</option>
		<option value="y2">1 - 2</option>
		<option value="y3">3 - 4</option>
		<option value="y4">5 - 7</option>
		<option value="y5">Больше семи лет</option>
	   </select> </p>
	   <p class="a">Соревнования, в которых Вы принимали участие<br>
	   <select name="competitions" size="8" multiple>
	   <option value="com1" selected>Не принимал </option>
		<option value="com2">DBBattle</option>
		<option value="com3">DBDrag</option>
		<option value="com4">AMT</option>
		<option value="com5">EMMA</option>
		<option value="com6">SPL-show</option>
		<option value="com7">Bass race</option>
		<option value="com6">Rasca</option>	
	   </select></p><br>
	   </div></div>
		<button type="reset" name="clr" value="clr">Очистить форму</button>
		<button type="submit" name="send" value="send">Отправить</button>
		</form>
	</body>
</html>