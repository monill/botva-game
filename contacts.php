<?php
include('top_tpl.php');
$zap_contact = count_query("SELECT * FROM `contacts` WHERE `fid`='".$row['id_user']."' AND `confirm`='0'");
$zap_contact2 = count_query("SELECT * FROM `contacts` WHERE `pid`='".$row['id_user']."' AND `confirm`='0'");
$zap_contact3 = count_query("SELECT * FROM `contacts` WHERE `pid`='".$row['id_user']."' AND `confirm`='1' OR `fid`='".$row['id_user']."' AND `confirm`='1'");

if (isset($_POST['delete_id']))
{
	$fnums_cont = mysql_num_rows(count_query("SELECT * FROM `contacts` WHERE `pid`='".$row['id_user']."' AND `fid`='".$_POST['delete_id']."'"));
	if ($fnums_cont > 0)
	{
		count_query("DELETE FROM `contacts` WHERE `pid`='".$row['id_user']."' AND `fid`='".$_POST['delete_id']."'");
		loca('contacts.php');
	}
	else
	{
		$snums_cont = mysql_num_rows(count_query("SELECT * FROM `contacts` WHERE `fid`='".$row['id_user']."' AND `pid`='".$_POST['delete_id']."'"));
		
		if ($snums_cont > 0)
		{
			count_query("DELETE FORM `contacts` WHERE `fid`='".$row['id_user']."' AND `pid`='".$_POST['delete_id']."'");
			loca('contacts.php');
		}
	}
}
if (isset($_POST['add_id']))
{
	$fnums_cont2 = mysql_num_rows(count_query("SELECT * FROM `contacts` WHERE `pid`='".$row['id_user']."' AND `fid`='".$_POST['add_id']."'"));
	if ($fnums_cont > 0)
	{
		count_query("UPDATE `contacts` SET `confirm`='1' WHERE `pid`='".$row['id_user']."' AND `fid`='".$_POST['add_id']."'");
		loca('contacts.php');
	}
	else
	{
		$snums_cont2 = mysql_num_rows(count_query("SELECT * FROM `contacts` WHERE `fid`='".$row['id_user']."' AND `pid`='".$_POST['add_id']."'"));

		if ($snums_cont2 > 0)
		{
			count_query("UPDATE `contacts` SET `confirm`='1' WHERE `fid`='".$row['id_user']."' AND `pid`='".$_POST['add_id']."'");
			loca('contacts.php');
		}
	}
}
?>
<tr>
        <td height="750" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class='blockHead'><img src='images/RU/titles/h_chaps.png' alt='Братва' /></div>
			
		<div class='contentBlock' id='contentBlock'></div><table width="574" border="0" cellpadding="0" cellspacing="0">
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
       <td width="504" align="center" valign="top" background="images/k09.png">
			<table width="504" height="30" border="0" cellpadding="0" cellspacing="0">
         <tr>
           <td height="30" align="center" valign="middle"><span class="text_main_5">Предложения побрататься</span></td>
         </tr>
       </table>
		<table width="504" height="10" border="0" cellpadding="0" cellspacing="0">
		<tr>
		<td align="left" valign="middle" ><table width="504" border="0" cellpadding="0" cellspacing="0">
	<tr>
	  <td width="40" height="25" align="center" valign="middle" background="images/k11.png">&nbsp;</td>
	  <td width="140" align="left" valign="middle" background="images/k11.png"><span class="text_main_4">Имя</span></td>
	  <td align="center" valign="middle" background="images/k11.png"><span class="text_main_4">Клан</span></td>
	  <td width="70" align="center" valign="middle" background="images/k11.png"><span class="text_main_4">Уровень</span></td>
	  <td width="60" align="center" valign="middle" background="images/k11.png"><span class="text_main_4">Письмо</span></td>
	  <td width="60" align="center" valign="middle" background="images/k11.png"><span class="text_main_4">Принять</span></td>
	  <td width="60" align="center" valign="middle" background="images/k11.png"><span class="text_main_4">Отклонить</span></td>
	</tr>
		<?php
		$ind = 0;
		while($contacts = mysql_fetch_array($zap_contact))
		{
			$cont_us = mysql_fetch_array(count_query("SELECT * FROM `users` WHERE `id_user`='".$contacts['pid']."'"));
			$zap_online = mysql_num_rows(count_query("SELECT * FROM `online` WHERE `id_session`='".$cont_us['id_user']."'"));
			if ($zap_online > 0)
			{
				$img_on = "<td align='center'><img src='images/ico_online.png' alt='онлайн' class='png' ></td>";
			}
			else
			{
				$img_on = "<td align='center'><img src='images/ico_offline.png' alt='оффлайн' class='png' ></td>";
			}
			if ($cont_us['clan'] == '0')
			{
				$clans = '-';
			}
			else
			{
				$clan = mysql_fetch_array(count_query("SELECT `id`,`name` FROM `clans` WHERE id='".$cont_us['clan']."'"));
				$clans = "<a href='clan.php?id=".$clan['id']."' class='text_main_4'>".$clan['name']."</a>";
			}
			echo "<tr class='row_1'>
			".$img_on."
		  <td align='left' ><a href='player.php?id=".$cont_us['id_user']."' class='text_main_5'>".$cont_us['name']."</a></td>
		  <td align='center'>".$clans."</td>
		  <td align='center'><span class='text_main_4'>".lvl($cont_us['exp'])."</span></td>
		  <td align='center' class='but'><a href='post.php?m=new&to_id=".$cont_us['id_user']."'><img class='but' src='images/ico_mail.png' alt='Отправить письмо' width='18' height='18' /></a></td>
		  <td height='25' align='center'>	<form method='post' class='inline' action=''><input type='hidden' name='add_id' value='".$cont_us['id_user']."' /><input type='image' name='do' class='image cmd' src='images/ico_add_p.png' alt='Принять' onMouseOver=\"doImage(this,'ico_add',null)\"/ ></form> </td>
		  <td height='25' align='center'>	<form method='post' class='inline' action=''><input type='hidden' name='delete_id' value='".$cont_us['id_user']."' /><input type='image' name='do' class='image cmd' src='images/ico_del_p.png' alt='Удалить' onMouseOver=\"doImage(this,'ico_del',null)\"/ ></form> </td>
		</tr>";
			$ind++;
		}
		if ($ind == 0)
		{
			echo '<td height="10" colspan="7" align="center" valign="middle" class="text_main_4">пусто</td>';
		}
		?>			
		</table></td>
		</tr>
		</table>
</td>
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
                      <td width="504" align="center" valign="top" background="images/k09.png"><table width="504" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td height="30" colspan="6" align="center" valign="middle"><span class="text_main_5">Твои предложения</span></td>
                        </tr>
				<tr>
				<td align="left" valign="middle" ><table width="504" border="0" cellpadding="0" cellspacing="0">
	<tr>
	  <td width="40" height="25" align="center" valign="middle" background="images/k11.png">&nbsp;</td>
	  <td width="140" align="left" valign="middle" background="images/k11.png"><span class="text_main_4">Имя</span></td>
	  <td align="center" valign="middle" background="images/k11.png"><span class="text_main_4">Клан</span></td>
	  <td width="70" align="center" valign="middle" background="images/k11.png"><span class="text_main_4">Уровень</span></td>
	  <td width="60" align="center" valign="middle" background="images/k11.png"><span class="text_main_4">Письмо</span></td>
	  <td width="60" align="center" valign="middle" background="images/k11.png"><span class="text_main_4">Отклонить</span></td>
	</tr>
<?php
		$ind2 = 0;
		while($contacts2 = mysql_fetch_array($zap_contact2))
		{
			$cont_us2 = mysql_fetch_array(count_query("SELECT * FROM `users` WHERE `id_user`='".$contacts2['fid']."'"));
			$zap_online2 = mysql_num_rows(count_query("SELECT * FROM `online` WHERE `id_session`='".$cont_us2['id_user']."'"));
			if ($zap_online2 > 0)
			{
				$img_on2 = "<td align='center'><img src='images/ico_online.png' alt='онлайн' class='png' ></td>";
			}
			else
			{
				$img_on2 = "<td align='center'><img src='images/ico_offline.png' alt='оффлайн' class='png' ></td>";
			}
			if ($cont_us2['clan'] == '0')
			{
				$clans2 = '-';
			}
			else
			{
				$clan2 = mysql_fetch_array(count_query("SELECT `id`,`name` FROM `clans` WHERE id='".$cont_us2['clan']."'"));
				$clans2 = "<a href='clan.php?id=".$clan2['id']."' class='text_main_4'>".$clan2['name']."</a>";
			}
			echo "<tr class='row_1'>
			".$img_on2."
		  <td align='left' ><a href='player.php?id=".$cont_us2['id_user']."' class='text_main_5'>".$cont_us2['name']."</a></td>
		  <td align='center'>".$clans2."</td>
		  <td align='center'><span class='text_main_4'>".lvl($cont_us2['exp'])."</span></td>
		  <td align='center' class='but'><a href='post.php?m=new&to_id=".$cont_us2['id_user']."'><img class='but' src='images/ico_mail.png' alt='Отправить письмо' width='18' height='18' /></a></td>

		  <td height='25' align='center'>	<form method='post' class='inline' action=''><input type='hidden' name='delete_id' value='".$cont_us2['id_user']."' /><input type='image' name='do' class='image cmd' src='images/ico_del_p.png' alt='Удалить' onMouseOver=\"doImage(this,'ico_del',null)\"/ ></form> </td>
		</tr>";
			$ind2++;
		}
		if ($ind2 == 0)
		{
			echo '<td height="10" colspan="6" align="center" valign="middle" class="text_main_4">пусто</td>';
		}
		?>
</table></td>		
		</tr>
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
                      <td width="504" align="center" valign="top" background="images/k09.png"><table width="504" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td height="30" colspan="4" align="center" valign="middle"><span class="text_main_5">Братва </span></td>
                        </tr>
	<tr>
	  <td align="left" valign="middle" ><table width="504" border="0" cellpadding="0" cellspacing="0">
	<tr>
	  <td width="40" height="25" align="center" valign="middle" background="images/k11.png">&nbsp;</td>
	  <td width="140" align="left" valign="middle" background="images/k11.png"><span class="text_main_4">Имя</span></td>
	  <td align="center" valign="middle" background="images/k11.png"><span class="text_main_4">Клан</span></td>
	  <td width="70" align="center" valign="middle" background="images/k11.png"><span class="text_main_4">Уровень</span></td>
	  <td width="60" align="center" valign="middle" background="images/k11.png"><span class="text_main_4">Письмо</span></td>
	  <td width="60" align="center" valign="middle" background="images/k11.png"><span class="text_main_4">Удалить</span></td>
	</tr>
	<?php
		$ind3 = 0;
		while($contacts3 = mysql_fetch_array($zap_contact3))
		{
			if ($row['id_user'] == $contacts3['fid']) 
			{
				$user_cont = $contacts3['pid'];
			}
			else if ($row['id_user'] == $contacts3['pid'])
			{
				$user_cont = $contacts3['fid'];
			}
			$cont_us3 = mysql_fetch_array(count_query("SELECT * FROM `users` WHERE `id_user`='".$user_cont."'"));
			$zap_online3 = mysql_num_rows(count_query("SELECT * FROM `online` WHERE `id_session`='".$cont_us3['id_user']."'"));
			if ($zap_online3 > 0)
			{
				$img_on3 = "<td align='center'><img src='images/ico_online.png' alt='онлайн' class='png' ></td>";
			}
			else
			{
				$img_on3 = "<td align='center'><img src='images/ico_offline.png' alt='оффлайн' class='png' ></td>";
			}
			if ($cont_us3['clan'] == '0')
			{
				$clans3 = '-';
			}
			else
			{
				$clan3 = mysql_fetch_array(count_query("SELECT `id`,`name` FROM `clans` WHERE id='".$cont_us3['clan']."'"));
				$clans3 = "<a href='clan.php?id=".$clan3['id']."' class='text_main_4'>".$clan3['name']."</a>";
			}
			echo "<tr class='row_1'>
			".$img_on3."
		  <td align='left' ><a href='player.php?id=".$cont_us3['id_user']."' class='text_main_5'>".$cont_us3['name']."</a></td>
		  <td align='center'>".$clans3."</td>
		  <td align='center'><span class='text_main_4'>".lvl($cont_us3['exp'])."</span></td>
		  <td align='center' class='but'><a href='post.php?m=new&to_id=".$cont_us3['id_user']."'><img class='but' src='images/ico_mail.png' alt='Отправить письмо' width='18' height='18' /></a></td>

		  <td height='25' align='center'>	<form method='post' class='inline' action=''><input type='hidden' name='delete_id' value='".$cont_us3['id_user']."' /><input type='image' name='do' class='image cmd' src='images/ico_del_p.png' alt='Удалить'
					onMouseOver=\"doImage(this,'ico_del',null)\"/ ></form> </td>
		</tr>";
			$ind3++;
		}
		if ($ind3 == 0)
		{
			echo '<td height="10" colspan="6" align="center" valign="middle" class="text_main_4">пусто</td>';
		}
		?>		  </table></td>
		</tr>
	  </table></td>
	  <td background="images/k04.png">&nbsp;</td>
	</tr>
	<tr>
	  <td background="images/k07.png"></td>
	  <td background="images/k06.png"></td>
	  <td width="10" height="10" background="images/k05.png"></td>
	</tr>
  </table>
		</td>
		<td width="25">&nbsp;</td>
	  </tr>
</table>
	<br>
	</td></tr>
<?php include('footer_tpl.php'); ?>