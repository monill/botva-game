<?php
 include("top_tpl.php");

$id_p = $_GET['id'];
$zap = count_query("SELECT * FROM users WHERE id_user = '".$id_p."'");
$nums = mysql_num_rows($zap);
if ($nums == 0)
{
	echo "<script>location.href='?id=".$row['id_user']."'</script>";
	exit;
}
$row_p = mysql_fetch_array($zap);

$pow_p = $row_p['power'];
$defe_p = $row_p['def'];
$abi_p = $row_p['ability'];
$mas_p = $row_p['mass'];
$ski_p = $row_p['skill'];
if ($pow_p >= $defe_p && $pow_p >= $abi_p && $pow_p >= $mas_p && $pow_p >= $ski_p)
{
	$max = $pow_p;
}
if ($defe_p >= $pow_p && $defe_p >= $abi_p && $defe_p >= $mas_p && $defe_p >= $ski_p)
{
	$max = $defe_p;
}
if ($abi_p >= $defe_p && $abi_p >= $pow_p && $abi_p >= $mas_p && $abi_p >= $ski_p)
{
	$max = $abi_p;
}
if ($mas_p >= $defe_p && $mas_p >= $abi_p && $mas_p >= $pow_p && $mas_p >= $ski_p)
{
	$max = $mas_p;
}
if ($ski_p >= $defe_p && $ski_p >= $abi_p && $ski_p >= $mas_p && $ski_p >= $pow_p)
{
	$max = $ski_p;
}
$power_num = round((150*($max-$pow_p))/$max);
$def_num = round((150*($max-$defe_p))/$max);
$ability_num = round((150*($max-$abi_p))/$max);
$mass_num = round((150*($max-$mas_p))/$max);
$skill_num = round((150*($max-$ski_p))/$max);

if ($_GET['id'] == $row['id_user']) { $myPod = "Мои подарки"; } else { $myPod = "Подарки ".$row_p['name']; }

if (isset($_GET['show']) AND $_GET['show'] == 'gifts')
{
	?>
	<tr>
        <td height="750" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class='blockHead'><img src='images/RU/titles/h_char2.png' alt='Игрок' /></div>
			
		<div class='contentBlock' id='contentBlock'><a href='player.php?id=<?=$_GET['id'];?>' class='back'><img src='images/RU/b_back_p.png' alt='Назад' class='cmd'
								onMouseOver="doImage(this,'RU/b_back')" /></a>	
								<?php if ($row['vip'] == 0 AND $_GET['id']==$row['id_user']) { ?>
								<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>
		<div class='c1'><div class='content'><div class='b2'>Все ваши подарки доступны для просмотра только вам. <br />Хотите, чтобы другие могли также их просматривать? <br />Активируйте статус <a href='kormushka.php'>Крутой</a>.</div></div></div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div> <? } ?>
								<div class='inputGroup inputSmall inputNoHeight ' >
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1' >
		
			<div class='content' ><div class='title'><?=$myPod;?>:</div><div class='body'><br />
			<?php
			
			$zapPlayerGift = count_query("SELECT * FROM `users` WHERE `id_user`='".$_GET['id']."'");
			$numPlayerGift = mysql_num_rows($zapPlayerGift);
			if ($numPlayerGift > 0)
			{
				$opa = 0;
				$tempGift = count_query("SELECT * FROM `gifts_p` WHERE `pid_g`='".$_GET['id']."'");
				while ($rowPlayerGifts = mysql_fetch_array($tempGift))
				{
					$rowPlayerGift = mysql_fetch_array(count_query("SELECT * FROM `gift` WHERE `id`='".$rowPlayerGifts['gift_num']."'"));
					switch($rowPlayerGifts['when'])
					{
						case 1: $myRowGiftPsBe = mysql_result(count_query("SELECT `name` FROM `users` WHERE `id_user`='".$rowPlayerGifts['uid_g']."'"),0); $tyta = $rowPlayerGifts['desc'].'<br><br>от игрока <b>'.$myRowGiftPsBe.'</b>'; break;
						case 2: if ($row['id_user'] != $rowPlayerGifts['pid_g']) {$tyta = 'Это приватный подарок';} else {$myRowGiftPsBe = mysql_result(count_query("SELECT `name` FROM `users` WHERE `id_user`='".$rowPlayerGifts['uid_g']."'"),0); $tyta = $rowPlayerGifts['desc'].'<br><br>Это приватный подарок от <b>'.$myRowGiftPsBe.'</b>';} break;
						case 3: $tyta = 'Анонимно'; break;
					}
					echo "<img src='images/items/".$rowPlayerGift['pic'].".jpg'  onMouseOver=\"doItem('g".$rowPlayerGift['when']."','".$tyta."','','0',event,this)\" >";
					$opa++;
				}
				switch ($opa)
				{
					case 8: echo "<br>"; break;
					case 16: echo "<br>"; break;
					case 24: echo "<br>"; break;
					case 32: echo "<br>"; break;
				}
			}
			else
			{
				loca('game.php');
			}
			?>
			
			</div></div>
		</div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
</div>	</td></tr>
	<?php
}
else
{
 ?>
<tr>
        <td height="700" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class='blockHead'><img src='images/RU/titles/h_char2.png' alt='Игрок' /></div>
			
		<div class='contentBlock' id='contentBlock'>	<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'><div class='content'><div class='b2'>		<table class='attack playerInfo'>
		<tr><td class='left' rowspan='2'><div class='avatar '><div style='background: url(images/avatars/<?=$row_p['gender'];?>/<?=$row_p['ava1'];?>.jpg)'><div style='background: url(images/avatars/<?=$row_p['gender'];?>/<?=$row_p['ava2'];?>.png)'><div style='background: url(images/avatars/<?=$row_p['gender'];?>/<?=$row_p['ava3'];?>.png)'></div></div></div></div></div>&nbsp;
			
		</td>
		<td class='right info' height='100'>
			<div class='blockTitle '><?=$row_p['name']?></div>
			<div class='blockTitle2 nobold'>
			<?php
			if ($row_p['clan'] == 0)
			{
				echo "-";
			}
			else if ($row_p['clan_stat'] == 'Призывник')
			{
				echo "-";
			}
			else
			{
				$row_clan_p = mysql_fetch_array(count_query("SELECT * FROM clans WHERE id = '".$row_p['clan']."'"));
				echo "<a href='/clan.php?id=".$row_clan_p['id']."'  class='profile '>".$row_clan_p['name']."</a>";
			}
			?>
			</div>
		</td>
		</tr>
		<tr><td valign='middle' class='enemy_message text_main_4' >
		<?php echo $row_p['description'] ?>
		</td></tr>
		</table></div></div></div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>	<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'><div class='content'><div class='b2'><div class='front playerInfo'><table><tr><td class='skills'>
    <table class='skills'>
    <tr><th colspan='5' class='blockTitle'>Способности</th></tr>
    <tr	class='row_1'>
	    <td class='c1'><img src="images/ico_11.png" alt="Уровень" class='ico'></td>
	    <td class='c2 left'>Уровень
	    <td class='center'><?php echo lvl($row_p['exp']);?>
	    <td>
    </tr>
	    <tr >
	    <td><img src="images/ico_12.png" alt="Сила" class='ico'></td>
		    <td class='left'>Сила</td>
		    <td class='c3'><span class='polzun'><img src='images/b2_2.gif' alt='' width='3'  /><img src='images/b2_3.gif' alt='' width='<?php echo 150-$power_num; ?>' /><img src='images/b2_4.gif' alt='' width='3'  /><img src='images/b2_5.gif' alt='' width='<?=$power_num;?>' /><img src='images/b2_6.gif' alt='' width='3' /></span></td>
		    <td class='c4'><?php echo $row_p['power'];?></td>
	    </tr>	    <tr class='row_1'>
	    <td><img src="images/ico_13.png" alt="Защита" class='ico'></td>
		    <td class='left'>Защита</td>
		    <td class='c3'><span class='polzun'><img src='images/b2_2.gif' alt='' width='3'  /><img src='images/b2_3.gif' alt='' width='<?php echo 150-$def_num; ?>' /><img src='images/b2_4.gif' alt='' width='3'  /><img src='images/b2_5.gif' alt='' width='<?=$def_num;?>' /><img src='images/b2_6.gif' alt='' width='3' /></span></td>
		    <td class='c4'><?php echo $row_p['def'];?></td>
	    </tr>	    <tr >
	    <td><img src="images/ico_14.png" alt="Ловкость" class='ico'></td>
		    <td class='left'>Ловкость</td>
		    <td class='c3'><span class='polzun'><img src='images/b2_2.gif' alt='' width='3'  /><img src='images/b2_3.gif' alt='' width='<?php echo 150-$ability_num; ?>' /><img src='images/b2_4.gif' alt='' width='3'  /><img src='images/b2_5.gif' alt='' width='<?=$ability_num;?>' /><img src='images/b2_6.gif' alt='' width='3' /></span></td>
		    <td class='c4'><?php echo $row_p['ability'];?></td>
	    </tr>	    <tr class='row_1'>
	    <td><img src="images/ico_15.png" alt="Масса" class='ico'></td>
		    <td class='left'>Масса</td>
		    <td class='c3'><span class='polzun'><img src='images/b2_2.gif' alt='' width='3'  /><img src='images/b2_3.gif' alt='' width='<?php echo 150-$mass_num; ?>' /><img src='images/b2_4.gif' alt='' width='3'  /><img src='images/b2_5.gif' alt='' width='<?=$mass_num;?>' /><img src='images/b2_6.gif' alt='' width='3' /></span></td>
		    <td class='c4'><?php echo $row_p['mass'];?></td>
	    </tr>	    <tr >
	    <td><img src="images/ico_16.png" alt="Мастерство" class='ico'></td>
		    <td class='left'>Мастерство</td>
		    <td class='c3'><span class='polzun'><img src='images/b2_2.gif' alt='' width='3'  /><img src='images/b2_3.gif' alt='' width='<?php echo 150-$skill_num; ?>' /><img src='images/b2_4.gif' alt='' width='3'  /><img src='images/b2_5.gif' alt='' width='<?=$skill_num;?>' /><img src='images/b2_6.gif' alt='' width='3' /></span></td>
		    <td class='c4'><?php echo $row_p['skill'];?></td>
	    </tr>

    <tr class='row_1'><td><img src='images/ico_17.png' alt='Слава' class='ico'></td>
	    <td class='left'>Слава
	    <td class='center'><?php echo $row_p['glory'];?>
	    <td>
    </tr>
    </table>
<td class='stats'>
<table class='stats'>
<tr><th colspan='2'  class='blockTitle'>Статистика:</th></tr>
<tr class='row_1'>	<td class='left'>Вербовка:	<td><?php echo $row_p['ref'];?>	</tr>
<tr><td class='left'>Родня:					<td>-		</tr>
<tr class='row_1'><td class='left'>Бои:	<td><?php echo $row_p['battle'];?>		</tr>
<tr><td class='left'>Победы:					<td><?php echo $row_p['win'];?>		</tr>
<tr class='row_1'><td class='left'>Награблено:		<td><?php echo $row_p['loot'];?> <img src='/images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'>
<tr><td class='left'>Утрачено:					<td><?php echo $row_p['lost'];?> <img src='/images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'>
<tr class='row_1'><td class='left'>Урон:	<td><?php echo $row_p['damage'];?></tr>
</table>
</table></div></div></div></div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>	<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'><div class='content'><div class='b2'><div id='moreGifts' ><center><?=$myPod;?>:</center>
		<?php
		$myGiftsBe = count_query("SELECT * FROM `gifts_p` WHERE `pid_g`='".$row_p['id_user']."'");
		$podarok = 0;
		while ($myRowGiftsBe = mysql_fetch_array($myGiftsBe))
		{
			$myRowGiftPBe = mysql_fetch_array(count_query("SELECT * FROM `gift` WHERE id='".$myRowGiftsBe['gift_num']."'"));
			switch($myRowGiftsBe['when'])
			{
				case 1: $myRowGiftPsBe = mysql_result(count_query("SELECT `name` FROM `users` WHERE `id_user`='".$myRowGiftsBe['uid_g']."'"),0); $tyta = $myRowGiftsBe['desc'].'<br><br>от игрока <b>'.$myRowGiftPsBe.'</b>'; break;
				case 2: if ($row['id_user'] != $myRowGiftsBe['pid_g']) {$tyta = 'Это приватный подарок';} else {$myRowGiftPsBe = mysql_result(count_query("SELECT `name` FROM `users` WHERE `id_user`='".$myRowGiftsBe['uid_g']."'"),0); $tyta = $myRowGiftsBe['desc'].'<br><br>Это приватный подарок от <b>'.$myRowGiftPsBe.'</b>';} break;
				case 3: $tyta = 'Анонимно'; break;
			}
			echo "<img src='images/items/".$myRowGiftPBe['pic'].".jpg' alt=''  onMouseOver=\"doItem('g".$myRowGiftPBe['when']."','".$tyta."','','0',event,this)\" />";
			$podarok++;
			if ($podarok==8)
			{
				break;
			}
		}
		$pod2 = 8-$podarok;
		for ($pod=0; $pod<$pod2; $pod++)
		{
			echo "<img src='images/ico_p0.jpg' alt=''/>";
		}
		?>
		
		<a href='?id=<?=$row_p['id_user'];?>&show=gifts' ><img src='images/RU/buttons/but_down2_p.png' alt='+' class='cmd'
								onMouseOver="doImage(this,'RU/buttons/but_down2')" /></a><br /></div></div></div></div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div><a href='post.php?m=new&amp;to_id=<?php echo $row_p['id_user']; ?>' ><img src='images/RU/b_msg_new_p.png' alt='Написать письмо' class='cmd'
								onMouseOver="doImage(this,'RU/b_msg_new','skip')" /></a><a href='contact_add.php?add=<?=$row_p['id_user'];?>' ><img src='images/RU/b_addkont_p.png' alt='Добавить в контакты' class='cmd'
								onMouseOver="doImage(this,'RU/b_addkont','skip')" /></a><a href='game.php?gift=0&amp;user=<?=$row_p['id_user'];?>' ><img src='images/RU/buttons/b_present_p.png' alt='Подарить подарок' class='cmd'
								onMouseOver="doImage(this,'RU/buttons/b_present','skip')" /></a></div>	</td></tr>
<?php } include("footer_tpl.php"); ?>