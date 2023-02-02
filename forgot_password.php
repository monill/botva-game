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

if (isset($_COOKIE['token']) && !isset($_SESSION['email'])) {
   $token = htmlspecialchars($_COOKIE['token']); // на всякий сл.
   $res = count_query("SELECT `email` FROM `users` WHERE `token`='".$token."'", $link);
   $row = mysql_fetch_array($res); //преобразовуем в массив 
   if (mysql_num_rows($res) < 1) {
      setcookie('token', '');
   } else {
      $_SESSION['email'] = $row['email'];
   }
}

if (isset($_SESSION['email'])) {
	echo "<script>location.href='game.php';</script>"; //переадресовываем в игру 
}

$query = "DELETE FROM `online` WHERE putdate < '".(time()-60*5)."'"; 
count_query($query) or die("Invalid query: " . mysql_error());

$how_online = mysql_num_rows(count_query("SELECT * FROM `online`"));
$how_register = mysql_num_rows(count_query("SELECT `id_user` FROM `users`"));
$how_active = mysql_num_rows(count_query("SELECT `id_user` FROM `users` WHERE `last_time`>='".(time()-604800)."' AND `last_time` > '0'"));


function anorandpass($count) {
	$m_rand = mt_rand(); //генерируем случайное целое
	$u_id = uniqid("MNO!#$%&*=+XYZ", TRUE);//создаем уникальный идентификатор с префиксом, постфиксом и повышенной энтропией
	$combine = $m_rand . $u_id;// Комбинируем переменные для формирования строки
	$new = str_shuffle($combine);//смешиваем строку
	return substr($new, 2, $count);//возвращаем пароль
}


if (isset($_POST['forgPass']))
{
	$name = substr(htmlspecialchars(trim($_POST['username'])), 0, 80);
	$email = substr(htmlspecialchars(trim($_POST['email'])), 0, 80);
	$query = count_query("SELECT * FROM users WHERE name='".$name."' AND email='".$email."'");
	
	$row = mysql_fetch_array($query);
	$num = mysql_num_rows($query);
	if ($num > 0)
	{
		$newPass = anorandpass(8);
		$hashNewPass =  base64_encode($newPass);

		mysql_query("UPDATE `users` SET `pass`='".$hashNewPass."' WHERE `name`='".$name."' AND email='".$email."'");
		$err = "<div class='message'>Ваш пароль ".$newPass."</div>";
	}
	else
	{
		$err = "<div class='message'>Пользователь не найден</div>";
	}
}
?>
	   <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
	<HTML xmlns="http://www.w3.org/1999/xhtml">
	<HEAD>
<TITLE>Ботва Онлайн - бесплатная онлайн игра</TITLE>
	<META http-equiv=Content-Type content="text/html; charset=windows-1251">

	<link rel="icon" href="favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link href="css/sheet1.9.css" rel="stylesheet" type="text/css">
<link href="css/sheet-RU.9.css" rel="stylesheet" type="text/css">

<script language='javascript' src='css/script.9.js'></script>
<script language='javascript' src='css/script-RU.9.js'></script>
<script language='javascript' src='css/pp.1.js'></script>

<script language='javascript' src='css/jquery.js'></script></HEAD>
	<body>
		<table width="100%" height="347" border="0" cellpadding="0" cellspacing="0" bgcolor="#9EB5D0">
  <tr>
    <td background="images/baner_tile.jpg">&nbsp;</td>
    <td width="994" height="347" align="right" valign="bottom" background="images/RU/main_baner.jpg">
	<table class='online2'>
<tr>
	<td class='m1' rowspan="8"><a href="index.php"><img src="images/RU/botva_logo_main.png" alt="" width="230" height="220" border="0"></a></td>
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
<a class='link1' href="login.php"><img src="images/but_enter2_p.png" alt="Вход"  onMouseOver="this.src='images/but_enter2_a.png'" onMouseOut="this.src='images/but_enter2_p.png'"></a>
<a class='link2' href="registration.php"><img src="images/but_reg_p.png" alt="Регистрация"  onMouseOver="this.src='images/but_reg_a.png'" onMouseOut="this.src='images/but_reg_p.png'"></a>

<a class='link3' href="#"><img src="images/but_tour_p.png" alt="Тур по игре"  onMouseOver="this.src='images/but_tour_a.png'" onMouseOut="this.src='images/but_tour_p.png'"></a>
<b><img src="images/but_pic_n.png" alt="Картинки"   ></b>
<a href="help.php"><img src="images/but_help2_p.png" alt="Помощь" onMouseOver="this.src='images/but_help2_a.png'" onMouseOut="this.src='images/but_help2_p.png'"></a>

<a class='link4' href="#"><img src="images/but_forum2_p.png" alt="Форум"  onMouseOver="this.src='images/but_forum2_a.png'" onMouseOut="this.src='images/but_forum2_p.png'"></a>
<a href="#"><img src="images/but_games_p.png" alt="Другие игры" onMouseOver="this.src='images/but_games_a.png'" onMouseOut="this.src='images/but_games_p.png'"></a>

<a class='link5' href='#'><img src="images/but_bash0_p.png" alt="Смешилка"   onMouseOver="this.src='images/but_bash0_a.png'" onMouseOut="this.src='images/but_bash0_p.png'"></a>

</div>

	</td>
   <td width="574" align="left" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
   	<table width="574" border="0" cellpadding="0" cellspacing="0" background="images/bg_dark.png">
      <tr>
       <td height="450" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
		<br />
    <div class='blockHead'><img src='images/RU/titles/h_pass.png' alt='Вернуть пароль' /></div>
			<?=$err;?>
		<div class='contentBlock' id='contentBlock'><table class='up_avatar'><tr><td class='avatar'><img src='images/reg_man.jpg' alt='Хранитель паролей'>	</td><td>	<div class='inputGroup inputSmall  ' >
		<div class='top'><div class='top1'><div class='top2'></div></div></div>
		
		<div class='c1' style='height:180px !important'>
			<div class='content' ><div class='title'>Хранитель паролей</div><div class='body'>
<b>Забыли пароль?</b><br /><br />
Не беда!<br /><br />
Сообщите мне ваши Имя и E-mail.<br /><br />
И на вашу почту ласточки быстро доставят обновленный пароль!<br /><br />
<b>Восстановление пароля.</b></div></div>
		</div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
</td></tr></table>	<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'><div class='content'><div class='b2'><FORM action="" method="post">
<table class='default'>
<tr height='30' ><td colspan="2" align="center" class="text_main_1">Введите Ваши имя и адрес e-mail:</td></tr>
<tr><td width="180" align="right" class="text_main_4">Имя:</td>
	<td><input class=input size=25 name="username" id="username"></td>
</tr>
<tr><td height="30" align="right" class="text_main_4">E-mail:</td>
	<td><input class=input maxlength=80 size=25 name="email" id="email"></td>
</tr>
<tr><td height="40" colspan="2" align="center" ><input type='hidden' name='forgPass'><input type='image' name='do' class='image cmd' src='images/RU/b_msg_post_p.png' alt='Отправить'
					onMouseOver="doImage(this,'RU/b_msg_post',null)"/ ></td></tr>
   </table></FORM></div></div></div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div></div>	</td>
  </tr>
  <tr><td height="50" background="images/foot_01.png"></td></tr>
      <tr>
        <td height="90" align="center" valign="middle" background="images/bg_dark.png"><table width="520" height="50" border="0" cellpadding="0" cellspacing="0" background="images/bg_foot.png">
            <tr>
          <td width="65%" height="25" align="center" valign="bottom" class="menu_foot" style='line-height:16px'>Все права защищены &copy; 2008 - 2010</td>
              <td width="35%" rowspan="2" align="left" valign="top"><a href="#"><img src="images/logo_destiny.png" alt="" name="" width="134" height="50" border="0" id="" onMouseOver="this.src='images/logo_destiny_a.png'" onMouseOut="this.src='images/logo_destiny.png'"></a></td>
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
            <tr><td id='topcmd'><a href='top.php' ><img src='images/RU/righu_top1_p.png' alt='Рейтинг' class='cmd'
								onMouseOver="doImage(this,'RU/righu_top1','skip')" /></a></td></tr>

			<tr><td height="25" align="center"><a href="top.php?t=1"><img src="images/but_users_p.png" alt="Игроки" width="130" height="25" id="top2"  onMouseOver="doImage(this,'but_users')"></a></td></tr>
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