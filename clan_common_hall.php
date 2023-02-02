<?php
include ("top_tpl.php");

$clan = mysql_fetch_array(count_query("SELECT * FROM `clans` WHERE `id` = '".$row['clan']."'"));
$zap_cmember = count_query("SELECT * FROM `users` WHERE `clan` = '".$clan['id']."' AND clan_stat != 'Призывник'");

if (isset($_POST['k']))
{
	$player_id = $_POST['user_ids'];
	if ($player_id != null) 
	{
		foreach ($player_id as $val) {
			$zap_usr = mysql_fetch_array(count_query("SELECT * FROM users WHERE id_user='".$val."' AND clan='".$clan['id']."'"));
			count_query("UPDATE users SET read_msg='0' WHERE id_user='".$val."'");
			$time = date('j.n.y H:i');
			count_query("INSERT INTO `message` (`time`, `to`, `from`, `theme`, `text`, `metka`) VALUES ('".$time."', '".$zap_usr['name']."', '".$row['name']."', 'Всему клану', '".htmlspecialchars($_POST['text'])."', '6')");
			$txt = '<div class="message">Сообщение отправлено</div>';
		}
	}
}
?>
<tr>
        <td height="750" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class='blockHead'><img src='images/RU/titles/h_main.png' alt='Общий зал' /></div>
			
		<div class='contentBlock' id='contentBlock'></div>
<a href='clan.php' class='back'><img src='images/RU/b_back_p.png' alt='Назад' class='cmd'
								onMouseOver="doImage(this,'RU/b_back')" /></a><a href='clan_common_hall.php?' ><img src='images/RU/buttons/b_chall_a.png' alt='Общий зал' class='cmd'
								onMouseOver="doImage(this,'RU/buttons/b_chall','active')" /></a><a href='clan_mod.php?m=message' ><img src='images/RU/buttons/b_cmessage_p.png' alt='Объявления' class='cmd'
								onMouseOver="doImage(this,'RU/buttons/b_cmessage','skip')" /></a>
								<?=$txt;?>
<form method="post" action=""><table width="574" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="25">&nbsp;</td>
<td width="524" valign="top"><table width="524" border="0" cellpadding="0" cellspacing="0">

  <tr>
    <td width="10" height="10" background="images/k01.png"></td>
    <td background="images/k02.png"></td>
    <td background="images/k03.png"></td>
  </tr>
  <tr>
    <td background="images/k08.png">&nbsp;</td>
    <td width="504" align="center" valign="top" background="images/k09.png"><table width="504" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="30" colspan="4" align="center" valign="middle"><span class="text_main_5">Разослать весточку соратникам по клану</span></td>
      </tr>
      <tr>
        <td height="140" align="center" valign="middle" class="text_main_2">
          <textarea name="text" cols="50" rows="7" id="text"></textarea>
        </td>
      </tr>
<td height="30" colspan="2" align="center" valign="top" class="text_main_2">
<input type='hidden' name='k'>
<input name="b_post1" id="b_post1" type="image" src="images/RU/b_msg_post_p.png" alt="Отправить" width="100" height="30" border="0" onMouseOver="this.src='images/RU/b_msg_post_a.png'" onMouseOut="this.src='images/RU/b_msg_post_p.png'"  onmousedown="this.src='images/RU/b_msg_post_n.png'"/></td>
    </table></td>
    <td background="images/k04.png">&nbsp;</td>
  </tr>
  <tr>
    <td background="images/k07.png"></td>
    <td background="images/k06.png"></td>
    <td width="10" height="10" background="images/k05.png"></td>
  </tr>
</table>
  <table width="524" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td height="10" colspan="3"></td>
    </tr>
    <tr>
      <td width="10" height="10" background="images/k01.png"></td>
      <td background="images/k02.png"></td>
      <td background="images/k03.png"></td>
    </tr>
    <tr>
      <td background="images/k08.png">&nbsp;</td>
      <td width="504" align="center" valign="top" background="images/k09.png"><table width="504" border="0" cellpadding="0" cellspacing="0" class="text_main_2">
        <tr>
          <td height="30" colspan="10" align="center" valign="middle"><span class="text_main_5">Получатели</span></td>
        </tr>
        <tr>
          <td width="40" height="20" align="left" valign="middle" background="images/k11.png">&nbsp;</td>
          <td width="160" align="left" valign="middle" background="images/k11.png">Имя </td>
          <td width="152" align="center" valign="middle" background="images/k11.png" >Ранг </td>
          <td width="104" align="center" valign="middle" background="images/k11.png">Слава</td>
          <td width="48" align="center" valign="middle" background="images/k11.png">&nbsp;</td>
        </tr>
<?php
while ($cmember = mysql_fetch_array($zap_cmember))
{
$zap_online = mysql_num_rows(count_query("SELECT * FROM online WHERE id_session='".$cmember['id_user']."'"));
if ($zap_online > 0)
{
	$img_on = "<img src='images/ico_online.png' alt='онлайн' class='png' ></td>";
}
else
{
	$img_on = "<img src='images/ico_offline.png' alt='оффлайн' class='png' ></td>";
}
	echo '
<tr>
  <td width="40" height="20" align="left" valign="middle" background="images/k10.png" ><input type="checkbox" name="user_ids[]" value="'.$cmember['id_user'].'" checked></td>
  <td width="160" align="left" valign="middle" background="images/k10.png" ><a href="player.php?id='.$cmember['id_user'].'" class="text_main_5">'.$cmember['name'].'</a></td>
  <td width="152" align="center" valign="middle" background="images/k10.png">'.$cmember['clan_stat'].'</td>
  <td width="104" align="center" valign="middle" background="images/k10.png">'.$cmember['glory'].'</td>
  <td width="48" align="center" valign="middle" background="images/k10.png">
  '.$img_on.'
</tr>';
}
?>
                  </table></td>
                  <td background="images/k04.png">&nbsp;</td>
                </tr>
                <tr>
                  <td background="images/k07.png"></td>
                  <td background="images/k06.png"></td>
                  <td width="10" height="10" background="images/k05.png"></td>
                </tr>
              </table>                  </td>
            <td width="25">&nbsp;</td>
          </tr>
        </table></form>
<br>
	</td></tr>
<?php include ("footer_tpl.php");?>