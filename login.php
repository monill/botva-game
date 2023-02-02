<?php 
session_start();     
include ("function/conf.php");

if ($feik == '1' AND !$_SESSION['admin'])
{
	echo '<center><h2>Работа сайта временно приостановлена.</h2></center>';
	exit;
}

include ("function/statistic.php");
include ("function/func.php");

##################### Класс борьбы с SQL атаками ################
include_once("function/sql.php");

$stop_injection = new InitVars();
$stop_injection->checkVars();
##################### Класс борьбы с SQL атаками ################
$query = "DELETE FROM `online` WHERE putdate < '".(time()-60*5)."'"; 
count_query($query) or die("Invalid query: " . mysql_error());

$how_online = mysql_num_rows(count_query("SELECT * FROM `online`"));
$how_register = mysql_num_rows(count_query("SELECT `id_user` FROM `users`"));
$how_active = mysql_num_rows(count_query("SELECT `id_user` FROM `users` WHERE `last_time`>='".(time()-604800)."' AND `last_time` > '0'"));

$login = HtmlSpecialChars($_POST['email']); 
$passHash2 = HtmlSpecialChars($_POST['passWord']);
$passHash = base64_encode($passHash2);
$token = md5(time().$login);
if (isset($_POST['remember'])) {
   setcookie('token', $token, time() + 60 * 60 * 24 * 14);
}

if (isset($_POST['next']))
{
if ($login != "" and $passHash != "") {
	$query = count_query("SELECT * FROM users WHERE email='".$login."' AND pass='".$passHash."'"); //выделяем таблицу  users с именем и паролем которые ввел пользователь 
	$row = mysql_fetch_array($query); //преобразовуем в массив 
	$num = mysql_num_rows($query); // Возвращает количество рядов результата запроса 
	if ($num > 0 AND $row['ban'] == 0){ //если количество рядов больше 0, то 
		$_SESSION['email'] = $login; //создаем сессию  email
		$_SESSION['id'] = $row['id_user']; //создаем сессию  id
		switch ($row['vip'])
		{
			case 0: $td = 120; break;
			case $row['vip'] > 0: $td = 240; break;
		}
		$t = date('d', time());
		$d = $t - date('d', $row['last_time']);
		if ($d >= 1)
		{
			count_query("UPDATE `users` SET `time_dozor`='".$td."' WHERE `email`='".$login."'");
		}
        if ($row['authlevel'] == 20)
        {
            $_SESSION['admin'] = $login;
        }
		count_query("INSERT INTO `online` (`id_session`, `putdate`) VALUES ('".$row['id_user']."', '".time()."')");
		count_query("UPDATE `users` SET `last_ip`='".$_SERVER['REMOTE_ADDR']."', `last_time`='".time()."', `token`='".$token."' WHERE `email`='".$login."'"); //делаем пользователя онлайн 
		echo "<script>location.href='game.php';</script>"; //переадресовываем в игру 
	} else if ($row['ban'] > 0)
	{
		$err = "Ваш персонаж заблокирован";
	}
	else {
		$err = "Данные введены неверно";
	}
}
else
{
	$err = "Данные введены неверно";
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE>Вход. Ботва Онлайн - бесплатная онлайн игра</TITLE>
<META http-equiv=Content-Type content="text/html; charset=windows-1251">

<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link href="css/sheet1.9.css" rel="stylesheet" type="text/css">
<link href="css/sheet-RU.9.css" rel="stylesheet" type="text/css">

<script language='javascript' src='css/script.9.js'></script>
<script language='javascript' src='css/script-RU.9.js'></script>
<script language='javascript' src='css/pp.1.js'></script>
<script> var LANG_NAME='RU';</script>
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
    <div class='blockHead'><img src='images/RU/titles/h_enter.png' alt='Вход' /></div>
			
		<div class='contentBlock' id='contentBlock'></div>
<FORM action=login.php method=post id='loginForm'>
<table width="574" border="0" cellspacing="0" cellpadding="0">
<tr>
  <td width="25" rowspan="4">&nbsp;</td>
  <td height="10" colspan="3" align="center">&nbsp;</td>
  <td width="25" rowspan="4">&nbsp;</td>
</tr>
<tr>
  <td width="10" height="10" background="images/k01.png"></td>
  <td background="images/k02.png"></td>
  <td width="10" background="images/k03.png"></td>
</tr>
<tr>
  <td background="images/k08.png">&nbsp;</td>
  <td align="left" valign="top" background="images/k09.png"><table width="504" border="0" align="center" cellpadding="0" cellspacing="0" class="text_main_2">
      <tbody>
<tr><td height='20' align='center' colspan='2' class='text_msg' ><?php echo $err; ?></td></tr>

        <tr>
          <td width="185" height="30" align="right" class="text_main_1">
E-mail:</td>
          <td align="left" class="text_main_1"><input class='input' type='text'  maxlength='80'  name='email' id='email' /></td>
        </tr>
        <tr>
          <td height="30" align="right" class="text_main_1"><label>Пароль:</label></td>
          <td height="30" align="left" class="text_main_1"><input class="input" type="password" maxlength=20 name="passWord" id="passWord" /></td>
        </tr>

<tr>
          <td height="30" class="text_main_1 center" colspan=2><b>Запомнить меня:</b><input type="checkbox" value=1 name="remember" style='width:20px'/></td>
        </tr>
<tr>
          <td height="35" colspan="2" align="center" ><span class="text_main_3">Входя в игру, я подтверждаю<br />знание <a href='page.php?page=rules' class='text_main_3'>Правил Игры</a></span></td>
        </tr>
        <tr>
          <td height="30" colspan="2" align="center" ><input type="hidden" name="next">
		  <input type='image' name='submit' class='image submit' src='images/RU/b_enter2_p.png' alt='вход'
					onMouseOver="doImage(this,'RU/b_enter2',null)"/ ></td>
        </tr>
        <tr>
          <td height="20" colspan="2" align="center" ><span class="text2_3"><a href="forgot_password.php" class="text_main_3">
		Восстановить забытый пароль.</a></span></td>
        </tr>
        <tr>
          <td height="20" colspan="2" align="center" ><a href="registration.php" class="text_main_3">Зарегистрироваться.</a></td>
        </tr>
      </tbody>
  </table></td>
  <td background="images/k04.png">&nbsp;</td>
</tr>
<tr>
  <td height="10" background="images/k07.png"></td>
  <td background="images/k06.png"></td>
  <td background="images/k05.png"></td>
</tr>
</table><br><br><br>
</FORM>
<style>
INPUT{width:140px}
INPUT.submit{width: 168px !important}
SELECT.select_server{width:140px; }

</style>
	</td>
  </tr>
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
            <tr><td id='topcmd'><a href='http://g1.botva.ru' ><img src='images/RU/righu_top1_p.png' alt='Рейтинг' class='cmd'
								onMouseOver="doImage(this,'RU/righu_top3','skip')" /></a></td></tr>

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