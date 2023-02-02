<?php
session_start();
include ("function/conf.php");
include ("function/statistic.php");
include ("function/func.php");

##################### Класс борьбы с SQL атаками ################
include_once("function/sql.php");

$stop_injection = new InitVars();
$stop_injection->checkVars();
##################### Класс борьбы с SQL атаками ################

$how_online = mysql_num_rows(count_query("SELECT * FROM `online`"));
$how_register = mysql_num_rows(count_query("SELECT id_user FROM users"));
$how_active = mysql_num_rows(count_query("SELECT `id_user` FROM `users` WHERE `last_time`>='".(time()-604800)."' AND `last_time` > '0'"));
$how_svintus = mysql_num_rows(count_query("SELECT id_user FROM users WHERE race='1'"));
$how_barantus = mysql_num_rows(count_query("SELECT id_user FROM users WHERE race='2'"));

$err = "";
$name = "";
$pass = "";
$retryPass = "";
$email = "";
$father = "";

if (isset($_POST['next'])) {
	$name = HtmlSpecialChars($_POST['userName']);
	$pass = HtmlSpecialChars($_POST['passWord']);
	$retryPass = HtmlSpecialChars($_POST['passWord2']);
	$email = HtmlSpecialChars($_POST['email']);
	$rules = HtmlSpecialChars($_POST['rules']);
	$father = HtmlSpecialChars($_POST['father']);
	
	if (strlen ($pass)<3 || strlen ($pass)>20) {
		$err = "Длина пароля должна быть от 3-х до 20 символов";
	} else if (strlen ($name)<3 || strlen ($name)>20) {
		$err = "Длина имени должна быть от 3-х до 20 символов";
	} else if ($name == "" || $pass == "" || $email == "") {
		$err = "Необходимо ввести имя, пароль и адрес e-mail";
	} else if (!preg_match("/^[a-zA-Z0-9_\.\-]+@([a-zA-Z0-9\-]+\.)+[a-zA-Z]{2,6}$/", $email)) {
		$err = "Неправильный адрес e-mail";
	} else if (!$rules) {
		$err = "Необходимо принять правила игры";
	} else if ($pass != $retryPass) {
		$err = "Пароли не совпадают";
	}
	if($_GET['race'] == 1) {
		$race = 1;
		$ava1 = "112a35";
		$ava2 = "112b314";
		$ava3 = "112c53";
		
		if ($how_svintus<$how_barantus)
		{
			$gold_prize = 100;
			$zelen_prize = 3;
		}
		else
		{
			$gold_prize = 50;
			$zelen_prize = 0;
		}
	} else if ($_GET['race'] == 2) {
		$race = 2;
		$ava1 = "012a23";
		$ava2 = "012b311";
		$ava3 = "012c32";
		
		if ($how_svintus>$how_barantus)
		{
			$gold_prize = 100;
			$zelen_prize = 3;
		}
		else
		{
			$gold_prize = 50;
			$zelen_prize = 0;
		}
	}
	$c_n = mysql_num_rows(count_query("SELECT id_user FROM users WHERE name='".$name."'")); 
    if ($c_n>0) {
        $err = 'Данное имя уже зарегистрировано';
    }
    $c_e = mysql_num_rows(count_query("SELECT id_user FROM users WHERE email='".$email."'")); 
    if ($c_e>0) {
        $err = 'Данный e-mail уже зарегистрирован';
    }
	if ($err == "") {
		if ($father != null)
		{
			$zap = mysql_fetch_array(count_query("SELECT id_user FROM users WHERE name='".$father."'"));
			count_query("UPDATE users SET gold=gold+'50', ref=ref+'1' WHERE id_user='".$zap['id_user']."'");
		}
		$pass = base64_encode($pass);
		count_query ("INSERT INTO users (name, pass, email, ip, last_ip, gold, zelen, race, ava1, ava2, ava3) values('".$name."','".$pass."','".addslashes($email)."', '".$_SERVER['REMOTE_ADDR']."', '".$_SERVER['REMOTE_ADDR']."', '".$gold_prize."', '".$zelen_prize."', '".$race."', '".$ava1."', '".$ava2."', '".$ava3."')");
		echo "<script>location.href='game.php';</script>";
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE>Регистрация. Ботва Онлайн - бесплатная онлайн игра</TITLE>
<META http-equiv=Content-Type content="text/html; charset=windows-1251">

<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link href="css/sheet1.9.css" rel="stylesheet" type="text/css">
<link href="css/sheet-RU.9.css" rel="stylesheet" type="text/css">

<script language='javascript' src='css/script.9.js'></script>
<script language='javascript' src='css/script-RU.9.js'></script>
<script language='javascript' src='css/pp.1.js'></script>
<script language='javascript' src='css/jquery-1.4.2.min.js'></script></HEAD>
	<body>
		<table width="100%" height="347" border="0" cellpadding="0" cellspacing="0" bgcolor="#9EB5D0">
  <tr>
    <td background="images/baner_tile.jpg">&nbsp;</td>
    <td width="994" height="347" align="right" valign="bottom" background="images/RU/main_baner.jpg">
	<table class='online2'>
<tr>
	<td class='m1' rowspan="8"><a href="index.php"><img src="/images/RU/botva_logo_main.png" alt="" width="230" height="220" border="0"></a></td>
	<td class='m2' rowspan="8">&nbsp;</td>
	<td class='m3'>&nbsp;</td>
</tr>
<tr><td class="text_top_link">Регистраций:</td></tr>
<tr><td class="text_top_all"><?php echo $how_register;?></td></tr>
<tr><td class="text_top_link">Активных игроков:</td></tr>
<tr><td class="text_top_all"><?php echo $how_active;?></td></tr>
<tr><td class="text_top_link">Онлайн:</td></tr>
<tr><td class="text_top_all"><?php echo $how_online;?></td></tr>
<tr><td></td></tr>
</table>
    </td>
    <td background="images/baner_tile.jpg">&nbsp;</td>
  </tr>
</table>
<table class='btable'  cellpadding="0" cellspacing="0">
  <tr>
    <td align="right" valign="top" background="images/bg_dark.png" bgcolor="#7B5B33">
    <div class='menuGuest png'>
<a class='link1' href="login.php"><img src="images/RU/but_enter2_p.png" alt="Вход"  onMouseOver="this.src='images/RU/but_enter2_a.png'" onMouseOut="this.src='images/RU/but_enter2_p.png'"></a>
<a class='link2' href="registration.php"><img src="images/RU/but_reg_p.png" alt="Регистрация"  onMouseOver="this.src='images/RU/but_reg_a.png'" onMouseOut="this.src='images/RU/but_reg_p.png'"></a>

<a class='link3' href="#"><img src="images/RU/but_tour_p.png" alt="Тур по игре"  onMouseOver="this.src='images/RU/but_tour_a.png'" onMouseOut="this.src='images/RU/but_tour_p.png'"></a>
<b><img src="images/RU/but_pic_n.png" alt="Картинки"   ></b>
<a href="help.php"><img src="images/RU/but_help2_p.png" alt="Помощь" onMouseOver="this.src='images/RU/but_help2_a.png'" onMouseOut="this.src='images/RU/but_help2_p.png'"></a>

<a class='link4' href="#"><img src="images/RU/but_forum2_p.png" alt="Форум"  onMouseOver="this.src='images/RU/but_forum2_a.png'" onMouseOut="this.src='images/RU/but_forum2_p.png'"></a>
<a href="#"><img src="images/RU/but_games_p.png" alt="Другие игры" onMouseOver="this.src='images/RU/but_games_a.png'" onMouseOut="this.src='images/RU/but_games_p.png'"></a>

<a class='link5' href='#'><img src="images/RU/but_bash0_p.png" alt="Смешилка"   onMouseOver="this.src='images/RU/but_bash0_a.png'" onMouseOut="this.src='images/RU/but_bash0_p.png'"></a>

</div>

	</td>
   <td width="574" align="left" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
   	<table width="574" border="0" cellpadding="0" cellspacing="0" background="images/bg_dark.png">
     <tr>
       <td height="450" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
		<br />
    <div class='blockHead'><img src='images/RU/titles/h_reg.png' alt='Регистрация' /></div>
			
<?php
if ($_GET['race'] == null) {
?>
<div class='contentBlock' id='contentBlock'>	<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'><div class='content'><div class='b2'>
<table class='default center'>
<tr><td class='text_main_7'>Всего свинтусов: <?php echo $how_svintus;?>			<td class='text_main_7'>Всего барантусов: <?php echo $how_barantus;?>
<tr><td><a href='registration.php?race=1' ><img src='images/RU/../logo_svin1_p.png' alt='Свинтус' class='cmd'
								onMouseOver="doImage(this,'RU/../logo_svin1','skip')" /></a>		<td><a href='registration.php?race=2' ><img src='images/RU/../logo_bar1_p.png' alt='Барантус' class='cmd'
								onMouseOver="doImage(this,'RU/../logo_bar1','skip')" /></a>
<tr><td class='top'><a href='registration.php?race=1' ><img src='images/RU/b_svin_p.png' alt='Свинтус' class='cmd'
								onMouseOver="doImage(this,'RU/b_svin','skip')" /></a>		<td><a href='registration.php?race=2' ><img src='images/RU/b_bar_p.png' alt='Барантус' class='cmd'
								onMouseOver="doImage(this,'RU/b_bar','skip')" /></a><br /><br />
<tr><td colspan='2' class='row_4 text_main_6' style='padding:10px'>Чтобы продолжить регистрацию вам необходимо выбрать одну из сторон противостояния, для этого нажмите на логотип фракции либо на ссылку с названием под ним.
<tr><td colspan='2' style='line-height:10px'>&nbsp;
<tr><td colspan='2' class='row_4 text_main_6' style='padding:10px'><b class='text_main_7'>Внимание!</b><br />
За выбор фракции, которая меньше по количеству регистраций, вы получите в благодарность дополнительный бонус за поддержку баланса в виде:<br />
50 <img src='/images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'> 3 <img src='/images/ico_green1.png' alt='Зелень' align='absmiddle' class='png'><br />
В игре вы всегда имеете возможность сменить фракцию.
</table>
</div></div></div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div></div>	</td>
  </tr>
<?php } else if ($_GET['race'] != null) {
?>
<div class='contentBlock' id='contentBlock'></div>
<table width="574" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="25" rowspan="4">&nbsp;</td>
    <td height="30" colspan="3" align="center" valign="top" ><table width="524" border="0" cellspacing="0" cellpadding="0">
      <tr><td class='center'><div class='message'><?php echo $err; ?></div></td>
      </tr>
    </table></td>
    <td width="25" rowspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td width="10" height="10" background="images/k01.png"></td>
    <td background="images/k02.png"></td>
    <td width="10" background="images/k03.png"></td>
  </tr>
  <tr>
    <td background="images/k08.png"></td>
    <td width="504" align="left" valign="top" background="images/k09.png">
		<center></center>
	<form action=""  method="post">
      <table width="504" border="0" cellspacing="0" cellpadding="0">
        <tr>
			<?php if ($_GET['race'] == 1) {?>
          <td width="200" height="240" rowspan="11" align="center" valign="top"><img src="images/logo_svin1_p.png" width="200" height="200" border="0" />
			<?php } else if ($_GET['race'] == 2) {?>
		  <td width="200" height="240" rowspan="11" align="center" valign="top"><img src="images/logo_bar1_p.png" width="200" height="200" border="0" />
			<?php } ?>
		</td>
        
<tr height='30' class='center'><td colspan='2' class='text_main_4'>Раса:</td><td><?php if ($_GET['race'] == 1) {?><input class='input' style='width:170px' name='race' 	value='Свинтус' disabled/><?php } else if ($_GET['race'] == 2) {?><input class='input' style='width:170px' name='race' 	value='Барантус' disabled/><?php } ?></td></tr>		<tr><td colspan='2'>&nbsp;<td>	<a href='registration.php' ><img src='images/RU/buttons/b_chserver2_p.png' alt='Изменить расу или сервер' class='cmd'
								onMouseOver="doImage(this,'RU/buttons/b_chserver2','skip')" /></a></td></tr>

		<td height="30" colspan="2" align="center" valign="middle" class="text_main_4">Имя в игре:</td>
          <td width="175" class="center" valign="middle">
			<span class="text2_2"><input class="input" maxlength="15" style='width:170px;' name="userName" id="userName"  value="<?=$name;?>" />
			</span>
			</td>
        </tr>

		        <tr>
          <td height="30" colspan="2" align="center" valign="middle"><span class="text_main_4">Введите пароль:</span></td>
          <td height="30" align="center" valign="middle"><span class="text2_2">
            <input class="input" type="password" maxlength="20"  style='width:170px'  name="passWord" id="passWord" />
          </span></td>
        </tr>
        <tr>
          <td height="30" colspan="2" align="center" valign="middle"><span class="text_main_4">Пароль повторно:</span></td>
          <td height="30" align="center" valign="middle"><span class="text2_2">
            <input class="input" type="password" maxlength="20"  style='width:170px'  name="passWord2" id="passWord2" />
          </span></td>
        </tr>
		        <tr>
          <td height="30" colspan="2" align="center" valign="middle"><span class="text_main_4">Ваш E-mail:</span></td>
          <td height="25" align="center" valign="middle"><span class="text2_2"><input class='input' maxlength='120' style='width:170px' name='email' value='<?=$email;?>'></span></td>
        </tr>

				<tr>
          <td height="40" align="center" valign="middle" class="text_main_3" colspan=3>
			<input type="checkbox" value="ok" name="rules" id="rules" />
Я прочёл, понял и соглашаюсь с<br /> <a href='page.php?page=rules' >Правила игры.</a> и <a href='page.php?page=offer' >Договором Офертой</a>			</td>
        </tr>
        <tr>
          <td height="40" colspan="3" align="center" valign="middle"><span class="text_main_6">Введите имя игрока, который привёл Вас в игру.<br />Он станет Вашим создателем!</span> </td>
        </tr>
        <tr>
          <td height="30" colspan="2" align="center" valign="middle"><span class="text_main_4">Ваш друг:</span></td>
          <td height="25" align="center" valign="middle"><span class="text2_2">
            <input class="input" maxlength="15"  style='width:170px'  name="father" value="<?=$father;?>"/>
          </span></td>
        </tr>
        <tr>
          <td height="40" colspan="4" align="center" valign="middle">
		  <input type='hidden' name='next'>
		  <input type='image' name='reg' class='image cmd' src='images/RU/b_msg_post_p.png' alt='Регистрация' onMouseOver="doImage(this,'RU/b_msg_post',null)"/ >
        </tr>
		        <tr>
          <td height="60" colspan="4" align="center" valign="middle" background="images/k15.png" class="text_main_6">
           Письмо с кодом активации будет выслано на Ваш E-mail.<br />
Аккаунт необходимо активировать в течение 3 дней.</td>
        </tr>
		      </table>
    </form></td>
    <td background="images/k04.png">&nbsp;</td>
  </tr>
  <tr>
    <td height="10" background="images/k07.png"></td>
    <td background="images/k06.png"></td>
    <td background="images/k05.png"></td>
  </tr>
</table>
<br />
	</td>
  </tr>
<?php } ?>
  <tr><td height="50" background="images/foot_01.png"></td></tr>
  <tr>
    <td height="90" align="center" valign="middle" background="images/bg_dark.png"><table width="520" height="50" border="0" cellpadding="0" cellspacing="0" background="images/bg_foot.png">
        <tr>
          <td width="65%" height="25" align="center" valign="bottom" class="menu_foot" style='line-height:16px'>Все права защищены &copy; 2008 - 2010</td>
          <td width="35%" rowspan="2" align="left" valign="top"><a href="http://www.ddestiny.ru"><img src="images/logo_destiny.png" alt="Destiny Development" name="destiny" width="134" height="50" border="0" id="destiny" onMouseOver="this.src='images/logo_destiny_a.png'" onMouseOut="this.src='images/logo_destiny.png'"></a></td>
         </tr>
        <tr>
          <td height="25" align="center" valign="top"><a href="page.php?page=legal" class="menu_foot">Основные положения</a> <a href="page.php?page=rules" class="menu_foot">Правила  игры</a></td>
        </tr>
    </table><br>
<br><br></td>
      </tr>
    </table></td>
    <td align="left" valign="top" background="images/bg_dark.png" bgcolor="#7B5B33"><table width="210" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="110" align="left" valign="top"><table width="210" height="110" border="0" cellpadding="0" cellspacing="0" background="images/bg_right_01.png">
            <tr><td id='topcmd'><a href='http://g2.botva.ru' ><img src='images/RU/righu_top1_p.png' alt='Рейтинг' class='cmd'
								onMouseOver="doImage(this,'RU/righu_top1','skip')" /></a></td></tr>

			<tr><td height="25" align="center"><a href="top.php?t=1"><img src="images/RU/but_users_p.png" alt="Игроки" width="130" height="25" id="top2"  onMouseOver="doImage(this,'RU/but_users')"></a></td></tr>
            <tr>

              <td height="13"></td>
            </tr>
          </table></td>
        </tr>
        <tr><td>	<table class='ltop' >
	<tr><td height="4"></td></tr>
	<?php top_p(); ?>
	<tr><td height="25"></td></tr>
	<tr><td height="25" align="center"><a href="top.php?t=2"><img src="/images/RU/but_clans_p.png" alt="" name="top3" width="130" height="25" border="0" id="top3" onMouseOver="this.src='/images/RU/but_clans_a.png'" onMouseOut="this.src='/images/RU/but_clans_p.png'"></a></td></tr>
	<tr><td height="10"></td></tr>
	<?php top_c(); ?>
	<tr><td></td></tr>
	</table> </td></tr>
    </table></td>
  </tr>
</table>
<div id='tooltip' style='display:none'></div>
</body>
</html>