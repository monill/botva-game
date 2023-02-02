<?php
include ('top_tpl.php');

$member = mysql_fetch_array(count_query("SELECT * FROM `clans` WHERE `id` = '".$_GET['id']."'"));
?>
<tr>
        <td height="750" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class='blockHead'><img src='images/RU/titles/h_warrior.png' alt='Воины' /></div>
			
		<div class='contentBlock' id='contentBlock'></div>
<table width="574" border="0" cellpadding="0" cellspacing="0">
<tr>
<td height="45" colspan="3" align="center" valign="top"><a href='clan.php?id=<?=$member['id'];?>' class='back'><img src='images/RU/b_back_p.png' alt='Назад' class='cmd'
								onMouseOver="doImage(this,'RU/b_back')" /></a></td>
</tr>
</table>
<table width="574" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="25" rowspan="3"></td>
<td width="10" height="10" background="images/k01.png"></td>
<td background="images/k02.png"></td>
<td width="10" background="images/k03.png"></td>
<td width="25" rowspan="3"></td>
</tr>
<tr>
<td background="images/k08.png">&nbsp;</td>
<td align="left" valign="top" background="images/k09.png"><table width="504" border="0" cellpadding="0" cellspacing="0">
 <tr>
   <td height="30" colspan="6" align="center" valign="middle"><span class="text_main_5">Список воинов <?=$member['name'];?> [<?=$member['tag'];?>]</span></td>
 </tr>
<tr>
<td width="141" height="25" align="left" valign="middle" background="images/k11.png"><span class="text_main_4">Имя</span></td>
<td width="64" align="center" valign="middle" background="images/k11.png"><span class="text_main_4">Ранг</span></td>
<td width="67" align="center" valign="middle" background="images/k11.png"><span class="text_main_4">Класс</span></td>
<td width="110" align="center" valign="middle" background="images/k11.png"><span class="text_main_4">Золото</span></td>
<td width="102" align="center" valign="middle" background="images/k11.png"><span class="text_main_4">Слава</span></td>
<td width="20" align="center" valign="middle" background="images/k11.png">&nbsp;</td>
</tr>
<?php
$zap_cmember = count_query("SELECT * FROM `users` WHERE `clan` = '".$member['id']."' AND clan_stat != 'Призывник'");
while ($cmember = mysql_fetch_array($zap_cmember))
{
$zap_gold = mysql_result(mysql_query("SELECT SUM(gold) FROM klog WHERE name = '".$cmember['name']."'"), 0);
$zap_online = mysql_num_rows(count_query("SELECT * FROM `online` WHERE `id_session`='".$cmember['id_user']."'"));
if ($zap_online > 0)
{
	$img_on = "<td align='center' valign='middle' ><img src='images/ico_online.png' alt='онлайн' class='png' ></td>";
}
else
{
	$img_on = "<td align='center' valign='middle' ><img src='images/ico_offline.png' alt='оффлайн' class='png' ></td>";
}
echo '<tr>
      <td width="141" height="25" align="left" valign="middle" ><a href="player.php?id='.$cmember['id_user'].'" class="text_main_5">'.$cmember['name'].' ['.lvl($cmember['exp']).']</a></td>
      <td align="center" valign="middle" ><span class="text_main_4">'.$cmember['clan_stat'].'</span></td>
      <td align="center" valign="middle" ><span class="text_main_4">-</span></td>
      <td align="center" valign="middle" ><span class="text_main_4">'.$zap_gold.'</span></td>
	  <td align="center" valign="middle" ><span class="text_main_4">'.$cmember['glory'].'</span></td>
      '.$img_on.'
    </tr>';
}
?>

         </table></td>
         <td background="images/k04.png">&nbsp;</td>
       </tr>
       <tr>
         <td height="10" background="images/k07.png"></td>
         <td background="images/k06.png"></td>
         <td background="images/k05.png"></td>
       </tr>
       <tr>
         <td height="10" colspan="5" align="center" valign="middle" class="text_main_5"></td>
       </tr>
     </table>
<br>
	</td></tr>
<?php
include ('footer_tpl.php');
?>