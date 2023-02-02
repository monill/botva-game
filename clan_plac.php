<?php
include ("top_tpl.php");
$clan = mysql_fetch_array(count_query("SELECT * FROM `clans` WHERE `id` = '".$row['clan']."'"));
$zap_cmember = count_query("SELECT * FROM `users` WHERE `clan` = '".$clan['id']."' AND clan_stat = 'Призывник'");
?>
<tr>
        <td height="750" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class='blockHead'><img src='images/RU/titles/h_platc.png' alt='Плац' /></div>
			
		<div class='contentBlock' id='contentBlock'><a href='clan.php' class='back'><img src='images/RU/b_back_p.png' alt='Назад' class='cmd'
								onMouseOver="doImage(this,'RU/b_back')" /></a></div>
<table width="574" border="0" cellpadding="0" cellspacing="0">
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
      <td width="504" align="center" valign="top" background="images/k09.png"><table width="504" height="30" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="30" align="center" valign="middle"><span class="text_main_5">Заявки на вступление в клан</span></td>
        </tr>

      </table>
</td>
		<td background="images/k04.png">&nbsp;</td>
	  </tr>
		<tr>
			<td width="10" background="images/k08.png"></td>
			<td align="center" valign="middle" class="text_main_4" background="images/k09.png">
			<?php
					if (isset($_POST['cYes']))
					{
						count_query("UPDATE users SET clan_stat='Новобранец', read_msg='0' WHERE id_user='".$cmember['id_user']."'");
						$time = date('j.n.y H:i');
						count_query("INSERT INTO `message` (`time`, `to`, `text`, `metka`) VALUES ('".$time."', '".$cmember['name']."', 'Вас приняли в клан <a href=clan.php>".$clan['name']."</a>', '6')");
						echo "<script>location.href='clan_plac.php'</script>";
					}
					else if (isset($_POST['cNo']))
					{
						count_query("UPDATE users SET clan='0', read_msg='0' WHERE id_user='".$cmember['id_user']."'");
						$time = date('j.n.y H:i');
						count_query("INSERT INTO `message` (`time`, `to`, `text`, `metka`) VALUES ('".$time."', '".$cmember['name']."', 'Ваша заявка в клан <a href=clan.php?id=".$clan['id'].">".$clan['name']."</a> отклонена', '6')");
						echo "<script>location.href='clan_plac.php'</script>";
					}
				$ind = 0;
				while ($cmember = mysql_fetch_array($zap_cmember))
				{
					echo "<form method='post'><tr><td><a href='player.php?id=".$cmember['id_user']."' target='_blank'>".$cmember['name']."[".lvl($cmember['exp'])."]</a></td><td><input type='submit' name='cYes' value='Принять'><input type='submit' name='cNo' value='Отказать'></td></tr></form>";
					$ind++;
				}
				if ($ind == 0)
				{
					echo "Заявок нет";
				}
				?>
			</td>
			<td width="10" background="images/k04.png"></td>
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
<?php include ("footer_tpl.php");?>