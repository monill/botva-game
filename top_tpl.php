<?php
session_start();
include ("function/conf.php");
include ("function/statistic.php");
include ("function/func.php");

if ($_SERVER['PHP_SELF'] != "/post.php" AND $_SERVER['PHP_SELF'] != "/clan_common_hall.php")
{
##################### Класс борьбы с SQL атаками ################
include_once("function/sql.php");

$stop_injection = new InitVars();
$stop_injection->checkVars();
##################### Класс борьбы с SQL атаками ################
}

if (!isset($_SESSION['id'])) {
	echo "<script>location.href='index.php';</script>"; //переадресовываем в игру 
}
$row = mysql_fetch_array(count_query("SELECT * FROM `users` WHERE `email`='".$_SESSION['email']."'"));

switch ($row['race'])
{
	case 1: $race = "svintus"; break;
	case 2:  $race = "barantus"; break;
}
who_online();

$how_online = mysql_num_rows(count_query("SELECT `id` FROM `online`"));
$how_active = mysql_num_rows(count_query("SELECT `id_user` FROM `users` WHERE `last_time`>='".(time()-604800)."' AND `last_time` > '0'"));

$ava = "<div style='background: url(images/avatars/".$row['gender']."/".$row['ava1'].".jpg)'><div style='background: url(images/avatars/".$row['gender']."/".$row['ava2'].".png)'><div style='background: url(images/avatars/".$row['gender']."/".$row['ava3'].".png)'></div></div></div>";

if ($row['vip'] <> 0)
{
	if ($row['vip'] <= time())
	{
		count_query("UPDATE users SET vip='0', time_dozor='120' WHERE email='".$_SESSION['email']."'");
	}
}

if ($row['read_msg'] == 0)
{
	$btn_post = '<a href="post.php"><img src="images/RU/but_post_a.png" alt="почта" width="130" height="25" border="0" id="post"></a>';
}
else
{
	$btn_post = '<a href="post.php"><img src="images/RU/but_post_p.png" onMouseOver="this.src=\'images/RU/but_post_a.png\'" onMouseOut="this.src=\'images/RU/but_post_p.png\'" alt="почта" width="130" height="25" border="0" id="post"></a>';
}

$t = time();
if ($row['safe'] < $t) { count_query("UPDATE `users` SET `safe`='0' WHERE id_user='".$row['id_user']."'"); }
if ($row['safe2'] < $t) { count_query("UPDATE `users` SET `safe2`='0' WHERE id_user='".$row['id_user']."'"); }
if ($row['safe3'] < $t) { count_query("UPDATE `users` SET `safe3`='0' WHERE id_user='".$row['id_user']."'"); }
if ($row['safe4'] < $t) { count_query("UPDATE `users` SET `safe4`='0' WHERE id_user='".$row['id_user']."'"); }
if ($row['woodoo'] < $t) { count_query("UPDATE `users` SET `woodoo`='0' WHERE id_user='".$row['id_user']."'"); }
if ($row['woodoo2'] < $t) { count_query("UPDATE `users` SET `woodoo2`='0' WHERE id_user='".$row['id_user']."'"); }
if ($row['woodoo3'] < $t) { count_query("UPDATE `users` SET `woodoo3`='0' WHERE id_user='".$row['id_user']."'"); }
if ($row['woodoo4'] < $t) { count_query("UPDATE `users` SET `woodoo4`='0' WHERE id_user='".$row['id_user']."'"); }

$work = mysql_fetch_array(count_query("SELECT * FROM `action` WHERE `uid` = '".$row['id_user']."'"));
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
<script> var LANG_NAME='RU';</script>
<script language='javascript' src='css/jquery-1.4.2.min.js'></script>

<?php
if ($work['id']<>'') {
	$delta = $work['timer']-time(); //разница с настояцим временем
	
	if ($delta<0)
	{
		if ($work['model'] == 1)
		{
			farm($work['speed']);
		}
		if ($work['model'] == 2)
		{
			dozor($work['speed']);
		}
		if ($work['model'] == 3)
		{
			mine($work['speed']);
		}
		//удаление записи о действии после всех расчетов
		count_query("DELETE FROM `action` WHERE `uid` = '".$row['id_user']."'");
	}
?>
<script type="text/javascript">
v=new Date();
function works()
{
	n=new Date();
	s=<?=$delta;?>-Math.round((n.getTime()-v.getTime())/1000.);
	m=0;
	h=0;
	if(s<0)
	{
		document.location=document.location;
	}
	else
	{
		if(s>59)
		{
			m=Math.floor(s/60);
			s=s-m*60;
		}
		if(m>59)
		{
			h=Math.floor(m/60);
			m=m-h*60;
		}
		if(s<10)
		{
			s="0"+s;
		}
		if(m<10)
		{
			m="0"+m;
		}
		window.setTimeout("works();",999);
	}
}
works();
</script>
<?php
}
?>
</HEAD>
	<body>
	<!--<h1><center>Я ОТОШЕЛ, ЕСЛИ ЧТО ПИШИ!</center></h1>-->
		<table width="100%" height="161" border="0" cellpadding="0" cellspacing="0" background="images/bg_sky.png" bgcolor="#9EB5D0" class='png'>
  <tr>
    <td>&nbsp;</td>
    <td width="210" align="left" valign="top" background="images/BOTVA01_prem.png" class='png'>&nbsp;</td>
    <td width="574" align="left" valign="top"><table width="574" height="161" border="0" cellpadding="0" cellspacing="0" background="images/menu_char_bg.png" class='png'>
      <tr>
        <td height="40" colspan="8" valign="top"><table width="574" height="25" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="65" align="left"><a href="#"  class="menu_top ">Новости</a></td>
              <td width='80' align="center"><a href="#"  target='_blank' class="menu_top ">Дневники</a></td>
              <td width="75" align="center"><a href="#" target='_blank' class="menu_top">Форум</a></td>
              <td  align="center"><a href='chat.php' class="menu_top">Чат (0)</a> </td>
              <td width="90" align="center"><a href="options.php" class="menu_top">Настройки</a></td>
              <td width="90" align="center"><a href="#" class="menu_top">Помощь</a></td>
              <?php
			  switch($row['authlevel'])
			  {
				case 15: echo "<td width='80' align='right' nowrap><a href='adm/' target='_blank' class='menu_top' style='color:red;'>Модераторская</a></td>"; break;
				case 18: echo "<td width='80' align='right' nowrap><a href='adm/' target='_blank' class='menu_top' style='color:red;'>Операторская</a></td>"; break;
				case 20: echo "<td width='80' align='right' nowrap><a href='adm/' target='_blank' class='menu_top' style='color:red;'>Админка</a></td>"; break;
			}
			  ?>
            </tr>
        </table></td>
      </tr>
      <tr><td height="22" colspan="8" align="center" valign="middle"><span class="text_head2"><?php echo $row['name']; ?></span></td></tr>
      <tr>
        <td height="15" colspan="8"></td>
      </tr>
      <tr>
        <td width="90" rowspan="2"></td>
        <td width="95" height="23" align="center"><span class="text_head1">золото:</span></td>
		<!--<td width="80" rowspan="2"><a href='castle.php?a=myguild&id=1' id='guildL'><img src='images/guilds/Guild_1ss.png' alt=''></a></td>-->
        <td width="80" rowspan="2"></td>
        <td width="90" align="center"><span class="text_head1">кристаллы:</span></td>
        <td width="85" rowspan="2"></td>
        <td width="73" align="center"><span class="text_head1">зелень:</span></td>
        <td width="33" height="47" rowspan="2"><a href="kormushka.php"><img src="images/RU/b_donat_p.png" alt="пополнить зелень" width="25" height="47" border="0" id="don" onMouseOver="this.src='images/RU/b_donat_a.png'" onMouseOut="this.src='images/RU/b_donat_p.png'"></a></td>
        <td width="28" rowspan="2"></td>
      </tr>
      <tr class='center top'>
        <td class="text_head2"><?php echo $row['gold'];?></td>
        <td class="text_head2"><?php echo $row['krystal'];?></td>
        <td class="text_head2"><?php echo $row['zelen'];?></td>
      </tr>
      <tr>
        <td height="37" colspan="2"></td>
        <td colspan="2"></td>
        <td colspan="4"></td>
      </tr>
    </table></td>
    <td width="210" valign="top" background="images/<?=$race?>1.png" class='png'>
	<table class='online center' >
<tr><td class='m1'></td></tr>
<tr><td class="menu_top2">Активных игроков:</td></tr>
<tr><td class="text_top_all"><?php echo $how_active;?></td></tr>
<tr><td class="menu_top2">Онлайн:</td></tr>
<tr><td class="text_top_all"><?php echo $how_online;?></td></tr>
</table>    </td>
    <td>&nbsp;</td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#9EB5D0">
  <tr>
    <td align="right" valign="top" background="images/bg_dark.png" bgcolor="#7B5B33"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">

      <tr>

        <td height="186" align="right" valign="top" background="images/bg00.png"><table width="100%" height="186" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td>&nbsp;</td>
            <td width="210" background="images/bg02.png" class='png'><table width="210" height="186" border="0" cellpadding="0" cellspacing="0" background="images/RU/BOTVA02_prem.png">
              <tr><td height="101">&nbsp;</td></tr>
              <tr><td height="25" align="left" class="menu1"><a href="game.php"><img src="images/RU/but_char_p.png" alt="Персонаж" name="char" width="130" height="25" border="0" id="char" onMouseOver="this.src='images/RU/but_char_a.png'" onMouseOut="this.src='images/RU/but_char_p.png'"></a></td></tr>
              <tr><td height="15"></td></tr>
              <tr><td height="25" align="left" class="menu1"><?=$btn_post;?></td></tr>
              <tr><td height="20"></td></tr>
            </table></td>
          </tr>
        </table></td>
        </tr>
      <tr>
        <td height="320" align="right" valign="top"><table width="210" height="313" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td><table width="210" height="350" border="0" cellpadding="0" cellspacing="0" background="images/RU/bg_left1_2.png" class='menuX'>
<tr><td><a href="village.php"><img src="images/RU/but_village_p.png" alt="Деревня" id="village" border="0" onMouseOver="this.src='images/RU/but_village_a.png'" onMouseOut="this.src='images/RU/but_village_p.png'"></a></td></tr>
<tr><td><a href='castle.php'><img src="images/RU/but_castle_p.png" alt="Крепость" onMouseOver="this.src='images/RU/but_castle_a.png'" onMouseOut="this.src='images/RU/but_castle_p.png'"></td></tr>
<tr><td><a href="clan.php"><img src="images/RU/but_clan_p.png" alt="Клан" id="clan" border="0" onMouseOver="this.src='images/RU/but_clan_a.png'" onMouseOut="this.src='images/RU/but_clan_p.png'"></a></td></tr>
<tr><td><a href="mine.php"><img src="images/RU/but_mine_p.png" alt="Шахта" onMouseOver="doImage(this,'RU/but_mine',null)"></a></td></tr>
<tr><td><a href="dozor.php"><img src="images/RU/but_bodalka_p.png" alt="Бодалка" id="bodalka" border="0" onMouseOver="this.src='images/RU/but_bodalka_a.png'" onMouseOut="this.src='images/RU/but_bodalka_p.png'"></a></td></tr>
<tr><td class='split' ></td></tr>
<tr><td><a href="shtab.php"><img src="images/RU/but_staff_p.png" alt="Штаб" id="shtab" border="0" onMouseOver="this.src='images/RU/but_staff_a.png'" onMouseOut="this.src='images/RU/but_staff_p.png'"></a></td></tr>
<tr><td><a href="kormushka.php"><img src="images/RU/but_jeweller_p.png" alt="Кормушка" id="jeweller" border="0" onMouseOver="this.src='images/RU/but_jeweller_a.png'" onMouseOut="this.src='images/RU/but_jeweller_p.png'"></a></td></tr>
<tr><td><a href="contacts.php"><img src="images/RU/but_chaps_p.png" alt="братва" border="0" id="chaps" onMouseOver="this.src='images/RU/but_chaps_a.png'" onMouseOut="this.src='images/RU/but_chaps_p.png'"></a></td></tr>
<tr><td><a href="search.php"><img src="images/RU/but_search_p.png" alt="Поиск" id="search" border="0" onMouseOver="this.src='images/RU/but_search_a.png'" onMouseOut="this.src='images/RU/but_search_p.png'"></a></td></tr>
<tr><td><a href="#"><img src="images/RU/but_bash_p.png" alt="Смешилка" id="bash" border="0" onMouseOver="this.src='images/RU/but_bash_a.png'" onMouseOut="this.src='images/RU/but_bash_p.png'"></a></td></tr>
<tr><td class='split2' ></td></tr>
<tr><td><a href="logout.php"><img src="images/RU/but_exit_p.png" alt="Выход" id="exit" border="0" onMouseOver="this.src='images/RU/but_exit_a.png'" onMouseOut="this.src='images/RU/but_exit_p.png'"></a></td></tr>
<tr><td class='end'></td></tr>
     </table>
     <div id='king' class='png'>
	<img src='images/ico_king_3.png' class='png'  alt='зол.' align='absmiddle'/> <a href='/player.php?id=288761' class='profile nb' >Мастер Кузнеч</a><br />
	<img src='images/avatars3/s1133531656500710500.jpg'  class='avat'/><br />
	<b>Борьба за трон</b><a href='/player.php?id=421692' class='profile ' >1. Кащей Бессмертный</a><a href='/player.php?id=470774' class='profile ' >2. =НеОдЫкВаТ=</a><a href='/player.php?id=387316' class='profile ' >3. (=НеОдЫкВаТ=)</a>
	<br />
	<a href='king.php' class='nb'>подробнее</a>
</div>
	 </td>
          </tr>
        </table>
		</td>
        </tr>
    </table></td>
    <td width="574" align="left" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
	<table width="574" border="0" cellpadding="0" cellspacing="0" background="images/bg_dark.png">