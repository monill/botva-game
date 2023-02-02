<?php
include('top_tpl.php');

$zap_naperst = count_query("SELECT * FROM `naperstki` WHERE `pid`='".$row['id_user']."' AND `win`='0'");
$num_naperst = mysql_num_rows($zap_naperst);
if ($num_naperst == 0)
{
	loca('tavern.php?a=game&id=2');
}

$txt = "Выбирай наперсток. Найдешь шарик – твоя победа.";
$nap = "<form method='POST'>
<input type='hidden' name='cmd' value='sel'>
<center>
<br /><br />
<table class='center default'  ><tr><td><img src='images/tavern/Cup.png' alt='1' title=''><td><img src='images/tavern/Cup.png' alt='2' title=''><td><img src='images/tavern/Cup.png' alt='3' title=''><tr><td><input type='radio' name='cup' value='1'><td><input type='radio' name='cup' value='2'><td><input type='radio' name='cup' value='3'></table><br /><br />
<input type='image' name='do' class='image cmd' src='images/RU/buttons/b_select_2_p.png' alt='Выбираю напёрсток!'
					onMouseOver=\"doImage(this,'RU/buttons/b_select_2',null)\"/ >
</center>
</form>";

if (isset($_POST['cmd']))
{
	if ($_POST['cmd'] == 'sel')
	{
		if (isset($_POST['cup']))
		{
			$row_naperst = mysql_fetch_array($zap_naperst);
			switch ($row_naperst['stavka'])
			{
				case 1: $ppc='gold'; $recd='recd_naper_g_stat'; break;
				case 2: $ppc='krystal'; $recd='recd_naper_k_stat'; break;
				case 3: $ppc='zelen'; $recd='recd_naper_z_stat'; break;
			}
			switch ($row_naperst['stavka'])
			{
				case 1: $img='gold'; $nimg='Золото'; break;
				case 2: $img='krist'; $nimg='Кристаллы'; break;
				case 3: $img='green'; $nimg='Зелень'; break;
			}
			$winner = mt_rand(1,3);
			if ($winner == 1) { $open1 = 'open'; } else { $open1 = 'fail'; }
			if ($winner == 2) { $open2 = 'open'; } else { $open2 = 'fail'; }
			if ($winner == 3) { $open3 = 'open'; } else { $open3 = 'fail'; }
			
			if ($_POST['cup'] == $winner)
			{
				count_query("UPDATE `users` SET ".$ppc."=".$ppc."+".($row_naperst['money']*2).", `naper_win`=naper_win+'1', ".$recd."=".$recd."+'".($row_naperst['money']*2)."' WHERE `id_user`='".$row['id_user']."'");
				$txt = "<b>Вы выиграли:</b> <br /> ".($row_naperst['money']*2)." <img src='/images/ico_".$img."1.png' alt='Золото' align='absmiddle' class='png'><br />	<img src='images/tavern/Complete_1.png' />";
				$nap = "<center><br /><br />
						<table class='default center'>
						<tr>
							<td><img src='images/tavern/Cup_".$open1.".png' alt='1' title=''>
							<td><img src='images/tavern/Cup_".$open2.".png' alt='2' title=''>
							<td><img src='images/tavern/Cup_".$open3.".png' alt='3' title=''>
						<tr>
							<td><input type='radio' name='cup' disabled='1' value='1'  checked>
							<td><input type='radio' name='cup' disabled='1' value='2' >
							<td><input type='radio' name='cup' disabled='1' value='3' >
						</table>
						<br /><br /><a href='tavern.php?a=game&amp;id=2' ><img src='images/RU/buttons/b_moretime_p.png' alt='Ещё раз' class='cmd' onMouseOver=\"doImage(this,'RU/buttons/b_moretime','skip')\" /></a></center>";
				count_query("UPDATE `naperstki` SET `win`='1' WHERE `pid`='".$row['id_user']."'");
			}
			else
			{
				count_query("UPDATE `users` SET `naper_lose`=naper_lose+'1' WHERE `id_user`='".$row['id_user']."'");
				$txt = "<b>Вы проиграли и потеряли:</b> <br /> ".$row_naperst['money']." <img src='/images/ico_".$img."1.png' alt='".$nimg."' align='absmiddle' class='png'><br />	<img src='images/tavern/Complete_2.png' />";
				$nap = "<center><br /><br />
						<table class='default center'>
						<tr>
							<td><img src='images/tavern/Cup_".$open1.".png' alt='1' title=''>
							<td><img src='images/tavern/Cup_".$open2.".png' alt='2' title=''>
							<td><img src='images/tavern/Cup_".$open3.".png' alt='3' title=''>
						<tr>
							<td><input type='radio' name='cup' disabled='1' value='1'  checked>
							<td><input type='radio' name='cup' disabled='1' value='2' >
							<td><input type='radio' name='cup' disabled='1' value='3' >
						</table>
						<br /><br /><a href='tavern.php?a=game&amp;id=2' ><img src='images/RU/buttons/b_moretime_p.png' alt='Ещё раз' class='cmd' onMouseOver=\"doImage(this,'RU/buttons/b_moretime','skip')\" /></a></center>";
				count_query("UPDATE `naperstki` SET `win`='1' WHERE `pid`='".$row['id_user']."'");
				
			}
		}
		else
		{
			$err = '<div class="message">Выбери наперсток!</div>';
		}
	}
}
?>
<tr>
        <td height="750" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class='blockHead'><img src='images/RU/titles/h_tavern_2.png' alt='Напёрсточки' /></div>
		<?=$err;?>
		<div class='contentBlock' id='contentBlock'><script src='/css/rare.js'></script><script>var WIN_MULTI = 2;</script><a href='tavern.php' class='back'><img src='images/RU/b_back_p.png' alt='Назад' class='cmd'
								onMouseOver="doImage(this,'RU/b_back')" /></a>	<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'><div class='content'><div class='b2'><table class='default center'><tr><td width='150'><a href='/player.php?id=<?=$row['id_user'];?>' class='profile ' ><?=$row['name'];?></a><br /><div class='avatar av_small'><div style='background: url(images/avatars/<?=$row['gender'];?>/s<?=$row['ava1'];?>.jpg)'><div style='background: url(images/avatars/<?=$row['gender'];?>/s<?=$row['ava2'];?>.png)'><div style='background: url(images/avatars/<?=$row['gender'];?>/s<?=$row['ava3'];?>.png)'></div></div></div></div><td>
<?=$nap;?>
<td width=150><b>Бармен Октоупус</b><br /><img src='images/tavern/barman.jpg' alt='' /></table></div></div></div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>	<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'><div class='content'><div class='b2'><?=$txt;?><br /></div></div></div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div></div>	</td></tr>
<?php include('footer_tpl.php'); ?>