<?php
include ("top_tpl.php");

$act = $_GET['activate'];
$deact = $_GET['deactivate'];
$s = $_GET['show'];
$k = $_GET['k'];

$item = count_query("SELECT  item.*, items_p.* FROM items_p RIGHT JOIN item  ON items_p.item_num=item.id WHERE items_p.uid = '".$row['id_user']."'");
$item_number = mysql_fetch_array($item);

if (isset($act) AND $k == $row['id_user']) 
{
	$zap_it_p = mysql_fetch_array(count_query("SELECT * FROM items_p WHERE id='".$act."' AND uid='".$row['id_user']."'"))  or die("Invalid query: " . mysql_error());
	$zap_it = mysql_fetch_array(count_query("SELECT * FROM item WHERE id='".$zap_it_p['item_num']."'"))  or die("Invalid query: " . mysql_error());
	
	if ($zap_it['who'] == 1)
	{
		if ($row['hp_now'] == $row['hp'])
		{
			$err = "<center><div class='message'>Я и так здоров</div></center>";
		}
		else
		{
			if ($zap_it['health'] > 0)
			{
				count_query("UPDATE `users` SET `hp_now`=`hp_now`+'".$zap_it['health']."' WHERE `id_user` = '".$k."'")  or die("Invalid query: " . mysql_error());
				
				$zap = mysql_fetch_array(count_query("SELECT * FROM `users` WHERE `email`='".$_SESSION['email']."'"))  or die("Invalid query: " . mysql_error());
				if ($zap['hp_now'] > $zap['hp'])
				{
					count_query("UPDATE `users` SET `hp_now`=`hp` WHERE `id_user` = '".$k."'")  or die("Invalid query: " . mysql_error());
				}
			}
			else if ($zap_it['hp_perc'] > 0)
			{
				count_query("UPDATE `users` SET `hp_now`=`hp` WHERE `id_user` = '".$k."'")  or die("Invalid query: " . mysql_error());
			}
			
			if ($zap_it_p['vol'] > 1)
			{
				count_query("UPDATE `items_p` SET `vol`=`vol`-1 WHERE `uid` = '".$k."' AND `id` = '".$act."'")  or die("Invalid query: " . mysql_error());
			}
			else if ($zap_it_p['vol'] <= 0)
			{
				count_query("DELETE FROM `items_p` WHERE `id` = '".$act."' AND `uid` = '".$k."'") or die("Invalid query: " . mysql_error());
			}
			else
			{
				count_query("DELETE FROM `items_p` WHERE `id` = '".$act."' AND `uid` = '".$k."'") or die("Invalid query: " . mysql_error());
			}
			echo "<script>location.href='game.php';</script>";
		}
	}
	else if ($zap_it['who'] == 2)
	{
		if ($row['pet'] > 0)
		{
			$row_pet = mysql_fetch_array(count_query("SELECT * FROM `pets` WHERE `pid`='".$row['id_user']."'"));
			if ($row_pet['hp_now'] == $row_pet['hp'])
			{
				$err = "<center><div class='message'>Питомец и так здоров</div></center>";
			}
			else
			{
				//лечим питомца
			}
		}
		else
		{
			$err = "<center><div class='message'>Нужно купить питомца</div></center>";
		}
	}
}
#############
#############
if (isset($act) AND $s == 1)
{
	$model = mysql_fetch_assoc(count_query("SELECT model FROM items_p WHERE id='".$act."' AND uid = '".$row['id_user']."'"));//что бы не одеть однотипную или ту же
	$result = count_query("SELECT id FROM items_p WHERE model = '".$model['model']."' AND stat='on' AND uid = '".$row['id_user']."'"); //что бы не одеть однотипную или ту же
	if ($item_number['lvl'] > lvl($row['exp']))
	{
		$err = "<center><div class='message'>Что то не подходит</div></center>";
	}
	else if (@mysql_result($result,0))
	{
		$err = "<center><div class='message'>Что то не подходит</div></center>";
	}
	else
	{
		count_query("UPDATE `items_p` SET `stat`='on' WHERE `id` = '".$act."' AND `uid` = '".$row['id_user']."'");
		$abc = mysql_fetch_array(count_query("SELECT * FROM items_p WHERE `stat`='on' AND id='".$act."'"));
		$item_act = mysql_fetch_array(count_query("SELECT * FROM item WHERE `id`='".$abc['item_num']."'"));
		switch ($item_act['when'])
		{
			case 1: count_query("UPDATE `users` SET `helmet`='".$act."' WHERE id_user='".$row['id_user']."'"); break;
			case 2: count_query("UPDATE `users` SET `necklet`='".$act."' WHERE id_user='".$row['id_user']."'");; break;
			case 3: count_query("UPDATE `users` SET `weapon`='".$act."' WHERE id_user='".$row['id_user']."'");; break;
			case 4: count_query("UPDATE `users` SET `shield`='".$act."' WHERE id_user='".$row['id_user']."'");; break;
			case 5: count_query("UPDATE `users` SET `armor`='".$act."' WHERE id_user='".$row['id_user']."'");; break;
		}
		echo "<script>location.href='game.php';</script>";
	}
}

if (isset($deact) AND $s == 1)
{
	count_query("UPDATE `items_p` SET `stat`='off' WHERE `id` = '".$deact."' AND `uid` = '".$row['id_user']."'");
	$dabc = mysql_fetch_array(count_query("SELECT * FROM items_p WHERE `stat`='off' AND id='".$deact."'"));
	$ditem_act = mysql_fetch_array(count_query("SELECT * FROM item WHERE `id`='".$dabc['item_num']."'"));
	switch ($ditem_act['when'])
	{
		case 1: count_query("UPDATE `users` SET `helmet`='0' WHERE id_user='".$row['id_user']."'"); break;
		case 2: count_query("UPDATE `users` SET `necklet`='0' WHERE id_user='".$row['id_user']."'");; break;
		case 3: count_query("UPDATE `users` SET `weapon`='0' WHERE id_user='".$row['id_user']."'");; break;
		case 4: count_query("UPDATE `users` SET `shield`='0' WHERE id_user='".$row['id_user']."'");; break;
		case 5: count_query("UPDATE `users` SET `armor`='0' WHERE id_user='".$row['id_user']."'");; break;
	}
	echo "<script>location.href='game.php';</script>";
}

#################################
if ($row['safe'] > 0)
{
	$s = "<img src='images/ico_m1_10.jpg' alt=''  onMouseOver=\"doItem('safe','<br />Действует до ".date('j.m.Y H:i', $row['safe'])."','','0',event,this)\" >";;
}
else
{
	$s = "<img src='images/ico_m1_00.jpg' alt=''  onMouseOver=\"doItem('safe','<br />Не действует','','0',event,this)\" >";
}
if ($row['woodoo'] > 0)
{
	$w = "<img src='images/ico_m2_a.jpg' alt=''  onMouseOver=\"doItem('woodoo','<br />Действует до ".date('j.m.Y H:i', $row['woodoo'])."','','0',event,this)\" >";;
}
else
{
	$w = "<img src='images/ico_m2_p.jpg' alt=''  onMouseOver=\"doItem('woodoo','<br />Не действует','','0',event,this)\" >";
}
if ($row['woodoo2'] > 0)
{
	$w2 = "<img src='images/ico_m3_a.jpg' alt=''  onMouseOver=\"doItem('woodoo2','<br />Действует до ".date('j.m.Y H:i', $row['woodoo2'])."','','0',event,this)\" >";;
}
else
{
	$w2 = "<img src='images/ico_m3_p.jpg' alt=''  onMouseOver=\"doItem('woodoo2','<br />Не действует','','0',event,this)\" >";
}
if ($row['woodoo3'] > 0)
{
	$w3 = "<img src='images/ico_m4_a.jpg' alt=''  onMouseOver=\"doItem('totem','<br />Действует до ".date('j.m.Y H:i', $row['woodoo3'])."','','0',event,this)\" >";;
}
else
{
	$w3 = "<img src='images/ico_m4_p.jpg' alt=''  onMouseOver=\"doItem('totem','<br />Не действует','','0',event,this)\" >";
}
if ($row['woodoo4'] > 0)
{
	$w4 = "<img src='images/ico_m5_a.jpg' alt=''  onMouseOver=\"doItem('totem2','<br />Действует до ".date('j.m.Y H:i', $row['woodoo4'])."','','0',event,this)\" >";;
}
else
{
	$w4 = "<img src='images/ico_m5_p.jpg' alt=''  onMouseOver=\"doItem('totem2','<br />Не действует','','0',event,this)\" >";
}
##############################

//коррекция
$pow  = 0;
$def  = 0;
$abi  = 0;
$mass = 0;
$skill  = 0;

while ($item_number['id'])
{
	if ($item_number['stat'] == 'on')
	{
		//расчет статов от вещей (для дальнейшего плюсования к основным статам) - если вещь одета
		$pow+=$item_number['pow'];
		$def+=$item_number['def'];
		$abi+=$item_number['abi'];
		$mass+=$item_number['mas'];
		$skill+=$item_number['skil'];
	}
	$item_number = mysql_fetch_array($item);
}

#################
###### TOP ######
#################
/*count_query("set @n:=0"); 
$zap = count_query("select rownum from (select @n:=@n+1 as rownum,id_user from users order by glory desc) t where id_user='".$row['id_user']."'"); 
$topus = mysql_fetch_array($zap); 
echo $topus['rownum'];*/
#################
#################
$pow_p = $row['power']+$pow;
$def_p = $row['def']+$def;
$abi_p = $row['ability']+$abi;
$mas_p = $row['mass']+$mass;
$ski_p = $row['skill']+$skill;

if ($pow_p >= $def_p && $pow_p >= $abi_p && $pow_p >= $mas_p && $pow_p >= $ski_p)
{
	$max = $pow_p;
}
if ($def_p >= $pow_p && $def_p >= $abi_p && $def_p >= $mas_p && $def_p >= $ski_p)
{
	$max = $def_p;
}
if ($abi_p >= $def_p && $abi_p >= $pow_p && $abi_p >= $mas_p && $abi_p >= $ski_p)
{
	$max = $abi_p;
}
if ($mas_p >= $def_p && $mas_p >= $abi_p && $mas_p >= $pow_p && $mas_p >= $ski_p)
{
	$max = $mas_p;
}
if ($ski_p >= $def_p && $ski_p >= $abi_p && $ski_p >= $mas_p && $ski_p >= $pow_p)
{
	$max = $ski_p;
}

$power_num = round((130*($max-$pow_p))/$max);
$def_num = round((130*($max-$def_p))/$max);
$ability_num = round((130*($max-$abi_p))/$max);
$mass_num = round((130*($max-$mas_p))/$max);
$skill_num = round((130*($max-$ski_p))/$max);


if (isset($_GET['gift']) AND is_numeric($_GET['gift']))
{
	if (isset($_POST['do_send']))
	{
		if ($_POST['do_send'] == 1)
		{
			if (!isset($_GET['user']))
			{
				if (isset($_POST['text']) AND isset($_POST['username']))
				{
					$nfd = count_query("SELECT * FROM users WHERE name='".$_POST['username']."'");
					$numNfd = mysql_num_rows($nfd);
					if ($numNfd > 0)
					{
						if ($_GET['gift'] > 0)
						{
							$hackGift = mysql_num_rows(count_query("SELECT * FROM `gifts_p` WHERE uid_g='".$row['id_user']."' AND pid_g='0' AND `id`='".$_GET['gift']."'"));
							if ($hackGift > 0)
							{
								$getGift = $_GET['gift'];
							}
							else
							{
								loca('game.php'); exit;
							}
						}
						else if ($_GET['gift'] == 0)
						{
							$hackGift = mysql_num_rows(count_query("SELECT * FROM `gifts_p` WHERE uid_g='".$row['id_user']."' AND pid_g='0' AND `id`='".$_POST['gift']."'"));
							if ($hackGift > 0)
							{
								$getGift = $_POST['gift'];
							}
							else
							{
								loca('game.php'); exit;
							}
						}
						$rowNfd = mysql_fetch_array($nfd );
						count_query("UPDATE `gifts_p` SET `pid_g`='".$rowNfd['id_user']."', `desc`='".$_POST['text']."', `when`='".$_POST['type']."' WHERE `id`='".$getGift."'");
						count_query("INSERT INTO `message` (`time`, `to`, `text`, `metka`) VALUES ('".$time."', '".$rowNfd['name']."', 'Вам подарили Подарок', '2')");
						count_query ("UPDATE users SET read_msg='0' WHERE id_user='".$rowNfd['id_user']."'");
						loca('player.php?id='.$rowNfd['id_user']);
					}
					else
					{
						$err = "<center><div class='message'>Игрок не найден!</div></center>";
					}
				}
				else 
				{
					$err = "<center><div class='message'>Не все данные введены!</div></center>";
				}
			}
			else if (isset($_GET['user']))
			{
				if (isset($_POST['text']))
				{
					$nfd = count_query("SELECT * FROM users WHERE id_user='".$_POST['user']."'");
					$numNfd = mysql_num_rows($nfd);
					if ($numNfd > 0)
					{
						if ($_GET['gift'] > 0)
						{
							$hackGift = mysql_num_rows(count_query("SELECT * FROM `gifts_p` WHERE uid_g='".$row['id_user']."' AND pid_g='0' AND `id`='".$_GET['gift']."'"));
							if ($hackGift > 0)
							{
								$getGift = $_GET['gift'];
							}
							else
							{
								loca('game.php'); exit;
							}
						}
						else if ($_GET['gift'] == 0)
						{
							$hackGift = mysql_num_rows(count_query("SELECT * FROM `gifts_p` WHERE uid_g='".$row['id_user']."' AND pid_g='0' AND `id`='".$_POST['gift']."'"));
							if ($hackGift > 0)
							{
								$getGift = $_POST['gift'];
							}
							else
							{
								loca('game.php'); exit;
							}
						}
						$rowNfd = mysql_fetch_array($nfd );
						count_query("UPDATE `gifts_p` SET `pid_g`='".$rowNfd['id_user']."', `desc`='".$_POST['text']."', `when`='".$_POST['type']."' WHERE `id`='".$getGift."'");
						loca('player.php?id='.$rowNfd['id_user']);
					}
					else
					{
						$err = "<center><div class='message'>Игрок не найден!</div></center>";
					}
				}
				else 
				{
					$err = "<center><div class='message'>Не все данные введены!</div></center>";
				}
			}
		}
	}
		if (isset($_GET['user']) AND is_numeric($_GET['user']))
		{
			$zapGift = count_query("SELECT * FROM `users` WHERE `id_user`='".$_GET['user']."'");
			$numGift = mysql_num_rows($zapGift);
			if ($numGift > 0)
			{
				$rowGift = mysql_fetch_array($zapGift);
				$usGif = "<input type='hidden' name='user' value='".$rowGift['id_user']."' /><a href='/player.php?id=".$rowGift['id_user']."' class='profile ' > ".$rowGift['name']." [".lvl($rowGift['exp'])."]</a>";
			} 
			else 
			{ 
				loca('game.php?gift=0'); exit; 
			}
		}
		else
		{
			$usGif = "Введите имя получателя:<br /><input type='text' name='username' />";
		}
		?>
		<tr>
        <td height="750" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class='blockHead'><img src='images/RU/titles/h_presents.png' alt='Подарок' /></div>
			
		<div class='contentBlock' id='contentBlock'>
		<?php 
		$myGift = count_query("SELECT * FROM `gifts_p` WHERE uid_g='".$row['id_user']."' AND pid_g='0'");
		$myGiftNum = mysql_num_rows($myGift);
		if ($myGiftNum == 0)
		{
			echo "<div class='message'>Необходимо вначале приобрести подарок в лавке.</div>";
		}
		?>	
		<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'><div class='content'><div class='b2'><form method='POST' action='' class='text_main_4'><center><b>Подарок для игрока:</b><br /><br /><?=$usGif;?><br /><br /><br /><span class='text_main_2'>Выберите подарок:</span>
		<table class='default gifts'>
		<tr>
			<?php
			$y = 0;
			while ($myGiftRow = mysql_fetch_array($myGift))
			{
				$allGift = mysql_fetch_array(count_query("SELECT * FROM `gift` WHERE `id`='".$myGiftRow['gift_num']."'"));
				$ch = '';
				if ($_GET['gift'] > 0 AND $_GET['gift'] == $myGiftRow['id'])
				{
					$ch = 'checked';
				}
				echo "<td><input type='radio' name='gift' value='".$myGiftRow['id']."' ".$ch.">
				<td><img src='images/items/".$allGift['pic'].".jpg' alt='".$allGift['name']."'/>";
				$y++;
			}
			$vr = 5-$y;
			for ($iii=0; $iii < $vr; $iii++)
			{
				echo "<td>&nbsp;
						<td><img src='images/ico_block.png'/>";
			}
			echo '<tr>';
			$y = 0;
			while ($myGiftRow = mysql_fetch_array($myGift))
			{
				$allGift = mysql_fetch_array(count_query("SELECT * FROM `gift` WHERE `id`='".$myGiftRow['gift_num']."'"));
				$ch = '';
				if ($_GET['gift'] > 0 AND $_GET['gift'] == $myGiftRow['id'])
				{
					$ch = 'checked';
				}
				echo "<td><input type='radio' name='gift' value='".$myGiftRow['id']."' ".$ch.">
				<td><img src='images/items/".$allGift['pic'].".jpg' alt='".$allGift['name']."'/>";
				$y++;
			}
			$vr = 5-$y;
			for ($iii=0; $iii < $vr; $iii++)
			{
				echo "<td>&nbsp;
						<td><img src='images/ico_block.png'/>";
			}
			?>
		</table>
		<br />Введите текст к подарку:<br /><textarea name='text' cols='50' rows='7'></textarea><br />(максимум 100 знаков)<br /><br /><div class='types'><input type='radio' name='type' value='1'  checked>публичный<input type='radio' name='type' value='2' >персональный<input type='radio' name='type' value='3' >инкогнито</div><input type='image' name='do_send' class='image cmd' src='images/RU/buttons/b_present_p.png' alt='подарить подарок'
					onMouseOver="doImage(this,'RU/buttons/b_present')"/ ><input type='hidden' name='do_send' value='1'/></center></form></div></div></div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div></div>	</td></tr>
		<?php
} else {
?>
      <tr>
        <td height="700" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class='blockHead'><img src='images/RU/titles/h_char.png' alt='Персонаж' /></div>
			
		<div class='contentBlock' id='contentBlock'>
<div class='front'>
<table class='character'><?php echo $err; ?>
	<tr><td class='avatar'>		<table>
		<tr><td>
		<?=$s;?><br />
		<?=$w;?><br />
		<?=$w2;?><br />
		<?=$w3;?><br />
		<?=$w4;?>
			<td class='avatar'><div class='avatar '><?php echo $ava; ?></div>
			<a href='avatar.php' ><img src='images/RU/b_avatar1_p.png' alt='Изменить аватар' class='avatar_s'
								onMouseOver="doImage(this,'RU/b_avatar1')" /></a><br />
			
			<td>
			<?php
			$check_item = mysql_fetch_array(count_query("SELECT * FROM items_p WHERE uid='".$row['id_user']."' AND id='".$row['helmet']."'"));
			$check_items_p = mysql_fetch_array(count_query("SELECT * FROM item WHERE id='".$check_item['item_num']."'"));
			if ($check_items_p>0)
			{
				echo "<img src='images/items/".$check_items_p['sname'].".jpg' alt=''  onMouseOver=\"doItem('".$check_items_p['id_i']."','Количество перепродаж: 10<br />Количество: ".$check_item['vol']."<br />','','0',event,this)\" /><br/>";
			}
			else
			{
				echo "<img src='images/ico_p2.jpg' alt=''><br />";
			}
			
			$check_item2 = mysql_fetch_array(count_query("SELECT * FROM items_p WHERE uid='".$row['id_user']."' AND id='".$row['necklet']."'"));
			$check_items_p2 = mysql_fetch_array(count_query("SELECT * FROM item WHERE id='".$check_item2['item_num']."'"));
			if ($check_items_p2>0)
			{
				echo "<img src='images/items/".$check_items_p2['sname'].".jpg' alt=''  onMouseOver=\"doItem('".$check_items_p2['id_i']."','Количество перепродаж: 10<br />Количество: ".$check_item2['vol']."<br />','','0',event,this)\" /><br/>";
			}
			else
			{
				echo "<img src='images/ico_p6.jpg' alt=''><br />";
			}
			
			$check_item3 = mysql_fetch_array(count_query("SELECT * FROM items_p WHERE uid='".$row['id_user']."' AND id='".$row['weapon']."'"));
			$check_items_p3 = mysql_fetch_array(count_query("SELECT * FROM item WHERE id='".$check_item3['item_num']."'"));
			if ($check_items_p3>0)
			{
				echo "<img src='images/items/".$check_items_p3['sname'].".jpg' alt=''  onMouseOver=\"doItem('".$check_items_p3['id_i']."','Количество перепродаж: 10<br />Количество: ".$check_item3['vol']."<br />','','0',event,this)\" /><br/>";
			}
			else
			{
				echo "<img src='images/ico_p3.jpg' alt=''><br />";
			}
			
			$check_item4 = mysql_fetch_array(count_query("SELECT * FROM items_p WHERE uid='".$row['id_user']."' AND id='".$row['shield']."'"));
			$check_items_p4 = mysql_fetch_array(count_query("SELECT * FROM item WHERE id='".$check_item4['item_num']."'"));
			if ($check_items_p4>0)
			{
				echo "<img src='images/items/".$check_items_p4['sname'].".jpg' alt=''  onMouseOver=\"doItem('".$check_items_p4['id_i']."','Количество перепродаж: 10<br />Количество: ".$check_item4['vol']."<br />','','0',event,this)\" /><br/>";
			}
			else
			{
				echo "<img src='images/ico_p4.jpg' alt=''><br />";
			}
			
			$check_item5 = mysql_fetch_array(count_query("SELECT * FROM items_p WHERE uid='".$row['id_user']."' AND id='".$row['armor']."'"));
			$check_items_p5 = mysql_fetch_array(count_query("SELECT * FROM item WHERE id='".$check_item5['item_num']."'"));
			if ($check_items_p5>0)
			{
				echo "<img src='images/items/".$check_items_p5['sname'].".jpg' alt=''  onMouseOver=\"doItem('".$check_items_p5['id_i']."','Количество перепродаж: 10<br />Количество: ".$check_item5['vol']."<br />','','0',event,this)\" /><br/>";
			}
			else
			{
				echo "<img src='images/ico_p5.jpg' alt=''><br />";
			}
			?>

			</tr>
		</table></td><td class='items'>		<img src="images/RU/but_pois_p.png" alt="Зелья и оружие" onclick='doWeapons()' id='weapons_img'><br>
        <div class="apDiv1" id="apDiv1">
			<div id='potions'><table class='front_items'>
									<tr>
										<?php
										$invent = mysql_fetch_array(count_query("SELECT * FROM items_p WHERE uid='".$row['id_user']."' AND item_num=1"));
										$uinvent = mysql_fetch_array(count_query("SELECT * FROM item WHERE id='".$invent['item_num']."'"));

										if ($invent>0)
										{
											if ($invent['vol'] > 1 AND $invent['vol'] <= 9)
											{
												echo "<td><img src='images/items/".$uinvent['sname']."_".$invent['vol'].".jpg' alt='' onMouseOver=\"doItem('".$uinvent['id_i']."','','','0',event,this)\" /><br />";
												echo "<a href='?activate=".$invent['id']."&k=".$row['id_user']."'><img src='images/RU/b_eat.png'/></a></td>";
											}
											else if ($invent['vol'] > 9)
											{
												echo "<td><img src='images/items/".$uinvent['sname']."_10.jpg' alt='' onMouseOver=\"doItem('".$uinvent['id_i']."','','','0',event,this)\" /><br />";
												echo "<a href='?activate=".$invent['id']."&k=".$row['id_user']."'><img src='images/RU/b_eat.png'/></a></td>";
											}
											else
											{
												echo "<td><img src='images/items/".$uinvent['sname'].".jpg' alt='' onMouseOver=\"doItem('".$uinvent['id_i']."','','','0',event,this)\" /><br />";
												echo "<a href='?activate=".$invent['id']."&k=".$row['id_user']."'><img src='images/RU/b_eat.png'/></a></td>";
											}
										} else {
											echo "<td><img src='images/items/ico2_p1.jpg' alt='' /><br />";
											echo "<img src='images/ico_p10.jpg' class='cmd'/></td>";
										}
										
										$invent2 = mysql_fetch_array(count_query("SELECT * FROM items_p WHERE uid='".$row['id_user']."' AND item_num=2"));
										$uinvent2 = mysql_fetch_array(count_query("SELECT * FROM item WHERE id='".$invent2['item_num']."'"));

										if ($invent2>0)
										{
											if ($invent2['vol'] > 1 AND $invent2['vol'] <= 9)
											{
												echo "<td><img src='images/items/".$uinvent2['sname']."_".$invent2['vol'].".jpg' alt='' onMouseOver=\"doItem('".$uinvent2['id_i']."','','','0',event,this)\" /><br />";
												echo "<a href='?activate=".$invent2['id']."&k=".$row['id_user']."'><img src='images/RU/b_eat.png'/></a></td>";
											}
											else if ($invent2['vol'] > 9)
											{
												echo "<td><img src='images/items/".$uinvent2['sname']."_10.jpg' alt='' onMouseOver=\"doItem('".$uinvent2['id_i']."','','','0',event,this)\" /><br />";
												echo "<a href='?activate=".$invent2['id']."&k=".$row['id_user']."'><img src='images/RU/b_eat.png'/></a></td>";
											}
											else
											{
												echo "<td><img src='images/items/".$uinvent2['sname'].".jpg' alt='' onMouseOver=\"doItem('".$uinvent2['id_i']."','','','0',event,this)\" /><br />";
												echo "<a href='?activate=".$invent2['id']."&k=".$row['id_user']."'><img src='images/RU/b_eat.png'/></a></td>";
											}
										} else {
											echo "<td><img src='images/items/ico2_p2.jpg' alt='' /><br />";
											echo "<img src='images/ico_p10.jpg' class='cmd'/></td>";
										}
										
										$invent3 = mysql_fetch_array(count_query("SELECT * FROM items_p WHERE uid='".$row['id_user']."' AND item_num=3"));
										$uinvent3 = mysql_fetch_array(count_query("SELECT * FROM item WHERE id='".$invent3['item_num']."'"));

										if ($invent3>0)
										{
											if ($invent3['vol'] > 1 AND $invent3['vol'] <= 9)
											{
												echo "<td><img src='images/items/".$uinvent3['sname']."_".$invent3['vol'].".jpg' alt='' onMouseOver=\"doItem('".$uinvent3['id_i']."','','','0',event,this)\" /><br />";
												echo "<a href='?activate=".$invent3['id']."&k=".$row['id_user']."'><img src='images/RU/b_eat.png'/></a></td>";
											}
											else if ($invent3['vol'] > 9)
											{
												echo "<td><img src='images/items/".$uinvent3['sname']."_10.jpg' alt='' onMouseOver=\"doItem('".$uinvent3['id_i']."','','','0',event,this)\" /><br />";
												echo "<a href='?activate=".$invent3['id']."&k=".$row['id_user']."'><img src='images/RU/b_eat.png'/></a></td>";
											}
											else
											{
												echo "<td><img src='images/items/".$uinvent3['sname'].".jpg' alt='' onMouseOver=\"doItem('".$uinvent3['id_i']."','','','0',event,this)\" /><br />";
												echo "<a href='?activate=".$invent3['id']."&k=".$row['id_user']."'><img src='images/RU/b_eat.png'/></a></td>";
											}	
										}
										else 
										{
											echo "<td><img src='images/items/ico2_p3.jpg' alt='' /><br />";
											echo "<img src='images/ico_p10.jpg' class='cmd'/></td>";
										}
										?>
									</tr>
									<tr>
										<?php
										$invent4 = mysql_fetch_array(count_query("SELECT * FROM items_p WHERE uid='".$row['id_user']."' AND item_num=4"));
										$uinvent4 = mysql_fetch_array(count_query("SELECT * FROM item WHERE id='".$invent4['item_num']."'"));

										if ($invent4>0)
										{
											if ($invent4['vol'] > 1 AND $invent4['vol'] <= 9)
											{
												echo "<td><img src='images/items/".$uinvent4['sname']."_".$invent4['vol'].".jpg' alt='' onMouseOver=\"doItem('".$uinvent4['id_i']."','','','0',event,this)\" /><br />";
												echo "<a href='?activate=".$invent4['id']."&k=".$row['id_user']."'><img src='images/RU/b_eat.png'/></a></td>";
											}
											else if ($invent4['vol'] > 9)
											{
												echo "<td><img src='images/items/".$uinvent4['sname']."_10.jpg' alt='' onMouseOver=\"doItem('".$uinvent4['id_i']."','','','0',event,this)\" /><br />";
												echo "<a href='?activate=".$invent4['id']."&k=".$row['id_user']."'><img src='images/RU/b_eat.png'/></a></td>";
											}
											else
											{
												echo "<td><img src='images/items/".$uinvent4['sname'].".jpg' alt='' onMouseOver=\"doItem('".$uinvent4['id_i']."','','','0',event,this)\" /><br />";
												echo "<a href='?activate=".$invent4['id']."&k=".$row['id_user']."'><img src='images/RU/b_eat.png'/></a></td>";
											}
										} else {
											echo "<td><img src='images/items/ico2_p130.jpg' alt='' /><br />";
											echo "<img src='images/ico_p10.jpg' class='cmd'/></td>";
										}
										
										$invent5 = mysql_fetch_array(count_query("SELECT * FROM items_p WHERE uid='".$row['id_user']."' AND item_num=5"));
										$uinvent5 = mysql_fetch_array(count_query("SELECT * FROM item WHERE id='".$invent5['item_num']."'"));

										if ($invent5>0)
										{
											if ($invent5['vol'] > 1 AND $invent5['vol'] <= 9)
											{
												echo "<td><img src='images/items/".$uinvent5['sname']."_".$invent5['vol'].".jpg' alt='' onMouseOver=\"doItem('".$uinvent5['id_i']."','','','0',event,this)\" /><br />";
												echo "<a href='?activate=".$invent5['id']."&k=".$row['id_user']."'><img src='images/RU/b_eat.png'/></a></td>";
											}
											else if ($invent5['vol'] > 9)
											{
												echo "<td><img src='images/items/".$uinvent5['sname']."_10.jpg' alt='' onMouseOver=\"doItem('".$uinvent5['id_i']."','','','0',event,this)\" /><br />";
												echo "<a href='?activate=".$invent5['id']."&k=".$row['id_user']."'><img src='images/RU/b_eat.png'/></a></td>";
											}
											else
											{
												echo "<td><img src='images/items/".$uinvent5['sname'].".jpg' alt='' onMouseOver=\"doItem('".$uinvent5['id_i']."','','','0',event,this)\" /><br />";
												echo "<a href='?activate=".$invent5['id']."&k=".$row['id_user']."'><img src='images/RU/b_eat.png'/></a></td>";
											}
										} else {
											echo "<td><img src='images/items/ico2_p131.jpg' alt='' /><br />";
											echo "<img src='images/ico_p10.jpg' class='cmd'/></td>";
										}
										
										$invent6 = mysql_fetch_array(count_query("SELECT * FROM items_p WHERE uid='".$row['id_user']."' AND item_num=6"));
										$uinvent6 = mysql_fetch_array(count_query("SELECT * FROM item WHERE id='".$invent6['item_num']."'"));

										if ($invent6>0)
										{
											if ($invent6['vol'] > 1 AND $invent6['vol'] <= 9)
											{
												echo "<td><img src='images/items/".$uinvent6['sname']."_".$invent6['vol'].".jpg' alt='' onMouseOver=\"doItem('".$uinvent6['id_i']."','','','0',event,this)\" /><br />";
												echo "<a href='?activate=".$invent6['id']."&k=".$row['id_user']."'><img src='images/RU/b_eat.png'/></a></td>";
											}
											else if ($invent6['vol'] > 9)
											{
												echo "<td><img src='images/items/".$uinvent6['sname']."_10.jpg' alt='' onMouseOver=\"doItem('".$uinvent6['id_i']."','','','0',event,this)\" /><br />";
												echo "<a href='?activate=".$invent6['id']."&k=".$row['id_user']."'><img src='images/RU/b_eat.png'/></a></td>";
											}
											else
											{
												echo "<td><img src='images/items/".$uinvent6['sname'].".jpg' alt='' onMouseOver=\"doItem('".$uinvent6['id_i']."','','','0',event,this)\" /><br />";
												echo "<a href='?activate=".$invent6['id']."&k=".$row['id_user']."'><img src='images/RU/b_eat.png'/></a></td>";
											}
										} else {
											echo "<td><img src='images/items/ico2_p132.jpg' alt='' /><br />";
											echo "<img src='images/ico_p10.jpg' class='cmd'/></td>";
										}
										?>
									</tr>
								<tr></tr></table></div>
			<div id='weapons'><table class='front_items'>
								<tr>
									<?php
									$a = count_query("SELECT * FROM items_p WHERE uid = '".$row['id_user']."' AND item_num >= 7");
									$mya = count_query("SELECT * FROM gifts_p WHERE uid_g = '".$row['id_user']."' AND pid_g='0'");
									$who_b = 0;
									while ($g = mysql_fetch_array($mya))
									{
										$gift = mysql_fetch_array(count_query("SELECT * FROM gift WHERE id='".$g['gift_num']."'"));
										echo "<td><img src='images/items/".$gift['pic'].".jpg' alt=''  onMouseOver=\"doItem('".$gift['when']."','','','0',event,this)\" /><br/>
													<a href='?gift=".$g['id']."'><img src='images/RU/b_gift.png'/></a></td>";
										$who_b++;
									}
									while ($b = mysql_fetch_array($a))
									{
										$c = mysql_fetch_array(count_query("SELECT * FROM item WHERE id = '".$b['item_num']."'"));
										if ($b['id'] != null AND $b['stat'] == "off")
										{
											echo "<td><img src='images/items/".$c['sname'].".jpg' alt=''  onMouseOver=\"doItem('".$c['id_i']."','Количество перепродаж: 10<br />Количество: ".$b['vol']."<br />','','0',event,this)\" /><br/>
													<a href='?activate=".$b['id']."&show=1'><img src='images/RU/b_on.png'/></a></td>";
										}
										else if ($b['id'] != null AND $b['stat'] == "on")
										{
											echo "<td><img src='images/items/".$c['sname'].".jpg' alt=''  onMouseOver=\"doItem('".$c['id_i']."','Количество перепродаж: 10<br />Количество: ".$b['vol']."<br />','','0',event,this)\" /><br/>
													<a href='?deactivate=".$b['id']."&show=1'><img src='images/RU/b_off.png'/></a></td>";
										}
										else
										{
											echo "<td><img src='images/ico_p0.jpg' /><br/><img src='images/ico_p10.jpg' alt=' ' class='cmd'/></td>";
										}
										$who_b++;
										switch($who_b)
										{
											case 3: echo "</tr><tr>";
											case 6: echo "</tr><tr>";
											case 9: echo "</tr><tr>";
											case 12: echo "</tr><tr>";
										}
									}
									
									$house = $row['house']+1;
									
									for ($i = 0; $i < $house; $i++)
									{
										echo "<td><img src='images/ico_p0.jpg' /><br/><img src='images/ico_p10.jpg' alt=' ' class='cmd'/></td>";
										switch($i)
										{
											case 3: echo "</tr><tr>";
											case 6: echo "</tr><tr>";
											case 9: echo "</tr><tr>";
											case 12: echo "</tr><tr>";
										}
									}
									?>
								</tr>
							</table></div>
		</div>
<script>doWeapons('potions');</script> <table class='expHP'>
<tr><td><img src='images/ico_23.png' alt='Здоровье' width='16' height='16' align='absmiddle' /> Здоровье: <?php echo $row['hp_now'];?>/<?php echo $row['hp'];?></td></tr>
<tr><td height="20" align="center" valign="middle"><span class='polzun'><img src='images/b2_2.gif' alt='' width='3'  /><img src='images/b2_3.gif' alt='' width='<?php echo $health_now = (190*(($row['hp_now']*100)/$row['hp']))/100; ?>' /><img src='images/b2_4.gif' alt='' width='3'  /><img src='images/b2_5.gif' alt='' width='<?php echo 190-$health_now;?>' /><img src='images/b2_6.gif' alt='' width='3' /></span></td></tr>
<tr><td><img src='images/ico_21.png' alt='Опыт' width='16' height='16' align='absmiddle' /> Опыт: <?=$row['exp'];?>/<?=n_lvl_exp($row['exp']);?></td></tr>
<tr><td height="20" align="center" valign='middle'><span class='polzun'><img src='images/b2_2.gif' alt='' width='3'  /><img src='images/b2_3.gif' alt='' width='<?php echo $exp_now = (190*(($row['exp']*100)/n_lvl_exp($row['exp'])))/100; ?>' /><img src='images/b2_4.gif' alt='' width='3'  /><img src='images/b2_5.gif' alt='' width='<?php echo 190-$exp_now;?>' /><img src='images/b2_6.gif' alt='' width='3' /></span></td></tr>
</td></tr>
</table></td>
</table>
		<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'><div class='content'><div class='b2'><table><tr>
					<td class='skills'><img src='images/RU/buttons/but_pets_b.png' alt='Способности и зверушки' class='cmd' id='char_pet_img' onclick='javascript:doPetInfo()' style='cursor:pointer'><br />
						<div id='char_info' >	<table class='skills'>

	<tr   onMouseOver="doItem('level','До следующего уровня осталось <?php echo n_lvl_exp($row['exp'])-$row['exp']; ?> опыта.','','0',event,this)" 	class='row_1'>
		<td class='c1'><img src="images/ico_11.png" alt="Уровень" class='ico'></td>
		<td class='c2 left'>Уровень
		<td><?php echo lvl($row['exp']);?>
		<td colspan='2'>
	</tr>
		<tr  onMouseOver="doItem('power','Базовое значение: <?php echo $row['power']; if ($pow > 0)	{ echo "<br>Бонус: ".$pow;}?>','','0',event,this)"  >
		<td><img src="images/ico_12.png" alt="Сила" class='ico'></td>
			<td class='left'>Сила</td>
			<td class='c3'><span class='polzun'><img src='images/b2_2.gif' alt='' width='3'  /><img src='images/b2_3.gif' alt='' width='<?php echo 130-$power_num; ?>' /><img src='images/b2_4.gif' alt='' width='3'  /><img src='images/b2_5.gif' alt='' width='<?=$power_num;?>' /><img src='images/b2_6.gif' alt='' width='3' /></span></td>
			<td class='c4'><?php echo $row['power'];?></td>
			<?php if ($pow > 0)	{ echo "<td class='c5 bonus'>+".$pow."</td>";} ?>
		</tr>		<tr  onMouseOver="doItem('block','Базовое значение: <?php echo $row['def']; if ($def > 0)	{ echo "<br>Бонус: ".$def;}?>','','0',event,this)"  class='row_1'>
		<td><img src="images/ico_13.png" alt="Защита" class='ico'></td>
			<td class='left'>Защита</td>
			<td class='c3'><span class='polzun'><img src='images/b2_2.gif' alt='' width='3'  /><img src='images/b2_3.gif' alt='' width='<?php echo 130-$def_num; ?>' /><img src='images/b2_4.gif' alt='' width='3'  /><img src='images/b2_5.gif' alt='' width='<?=$def_num;?>' /><img src='images/b2_6.gif' alt='' width='3' /></span></td>
			<td class='c4'><?php echo $row['def'];?></td>
			<?php if ($def > 0)	{ echo "<td class='c5 bonus'>+".$def."</td>";} ?>
		</tr>		<tr  onMouseOver="doItem('dexterity','Базовое значение: <?php echo $row['ability']; if ($abi > 0)	{ echo "<br>Бонус: ".$abi;}?>','','0',event,this)"  >
		<td><img src="images/ico_14.png" alt="Ловкость" class='ico'></td>
			<td class='left'>Ловкость</td>
			<td class='c3'><span class='polzun'><img src='images/b2_2.gif' alt='' width='3'  /><img src='images/b2_3.gif' alt='' width='<?php echo 130-$ability_num; ?>' /><img src='images/b2_4.gif' alt='' width='3'  /><img src='images/b2_5.gif' alt='' width='<?=$ability_num;?>' /><img src='images/b2_6.gif' alt='' width='3' /></span></td>
			<td class='c4'><?php echo $row['ability'];?></td>
			<?php if ($abi > 0)	{ echo "<td class='c5 bonus'>+".$abi."</td>";} ?>
		</tr>		<tr  onMouseOver="doItem('endurance','Базовое значение: <?php echo $row['mass']; if ($mass > 0)	{ echo "<br>Бонус: ".$mass;}?>','','0',event,this)"  class='row_1'>
		<td><img src="images/ico_15.png" alt="Масса" class='ico'></td>
			<td class='left'>Масса</td>
			<td class='c3'><span class='polzun'><img src='images/b2_2.gif' alt='' width='3'  /><img src='images/b2_3.gif' alt='' width='<?php echo 130-$mass_num; ?>' /><img src='images/b2_4.gif' alt='' width='3'  /><img src='images/b2_5.gif' alt='' width='<?=$mass_num;?>' /><img src='images/b2_6.gif' alt='' width='3' /></span></td>
			<td class='c4'><?php echo $row['mass'];?></td>
			<?php if ($mass > 0)	{ echo "<td class='c5 bonus'>+".$mass."</td>";} ?>
		</tr>		<tr  onMouseOver="doItem('charisma','Базовое значение: <?php echo $row['skill']; if ($skill > 0)	{ echo "<br>Бонус: ".$skill;}?>','','0',event,this)"  >
		<td><img src="images/ico_16.png" alt="Мастерство" class='ico'></td>
			<td class='left'>Мастерство</td>
			<td class='c3'><span class='polzun'><img src='images/b2_2.gif' alt='' width='3'  /><img src='images/b2_3.gif' alt='' width='<?php echo 130-$skill_num; ?>' /><img src='images/b2_4.gif' alt='' width='3'  /><img src='images/b2_5.gif' alt='' width='<?=$skill_num;?>' /><img src='images/b2_6.gif' alt='' width='3' /></span></td>
			<td class='c4'><?php echo $row['skill'];?></td>
			<?php if ($skill > 0)	{ echo "<td class='c5 bonus'>+".$skill."</td>";} ?>
		</tr>

	<tr   onMouseOver="doItem('glory','Основная слава: <?php echo $row['glory'];?>','','0',event,this)"  class='row_1'><td><img src="images/ico_17.png" alt="Слава" class='ico'></td>
		<td class='left'>Слава
		<td><?php echo $row['glory'];?>
		<td colspan='2'>
	</tr>
	</table><br /><a href='training.php' ><img src='images/RU/b_tren_p.png' alt='Тренировка' class='cmd'
								onMouseOver="doImage(this,'RU/b_tren')" /></a>	</div>
								
<?php
$pet = "SELECT `id` FROM `pets` WHERE `pid`='".$row['pet']."'";
$query_pet = count_query($pet);
$row_pet = mysql_fetch_array($query_pet);

if (mysql_num_rows($query_pet) < 1) {
?>
<div id='char_pet' class='hidden'>	<table class='pet_info default default_height'>
<tr><td><div class='pet_none'>У вас нет магической зверушки.<br /><br />Но вы можете приобрести её <br />в <a href='shop.php?group=7'>лавке у торговца</a>.</div>
<tr><td>
	<table class='default polzun center'>
		<tr><td rowspan='2' class='img'><img src='images/items/Pet_0s.jpg' /><td>
		<tr><td class='polzun'><span class='polzun'><img src='images/b2_2.gif' alt='' width='3'  /><img src='images/b2_3.gif' alt='' width='0' /><img src='images/b2_4.gif' alt='' width='3'  /><img src='images/b2_5.gif' alt='' width='200' /><img src='images/b2_6.gif' alt='' width='3' /></span>
	</table>
</table>
		</div>
<?php } else { ?>
						<div id='char_pet' class='hidden'>	<table class='pet_info default default_height'>
<tr><th colspan='2'><?php echo $row_pet['name']; ?>
<tr><td class='half left'><table class='default'>
<tr class='row_1  center'>	<td colspan='3'>Против зверушек
<tr><td><img src="images/ico_12.png" alt="Сила" class='ico'>
	<td>Сила			<td class='c3'><?php echo $row_pet['power']; ?>

<tr class='row_1'>
	<td><img src="images/ico_13.png" alt="Защита" class='ico'>
	<td>Защита			<td class='c3'><?php echo $row_pet['def']; ?>

<tr>
	<td><img src="images/ico_14.png" alt="Ловкость" class='ico'>
	<td>Ловкость		<td class='c3'><?php echo $row_pet['ability']; ?>

<tr class='row_1'>
	<td><img src="images/ico_16.png" alt="Мастерство" class='ico'>
	<td>Мастерство		<td class='c3'><?php echo $row_pet['mass']; ?>
</table>
	<td class='half'><table class='default'>
<tr class='row_1 center'>	<td colspan='3'>Против персонажей
<tr>				<td>Урон			<td class='c3'>435	- 653
<tr class='row_1'>	<td>Крит. удар		<td class='c3'>653	- 980
<tr>				<td>Промах			<td class='c3'>10
<tr class='row_1'>	<td>Реген. в час	<td class='c3'>415
</table>
<tr><td colspan='2'>
	<table class='default polzun center'>
		<tr><td rowspan='2' class='img'><img src='images/items/Pet_5s.jpg'  onMouseOver="doItem('pet_5','','','0',event,this)" />
			<td><img src='images/ico_23.png' alt='' />Здоровье: 3876/3876
		<tr><td class='polzun'><span class='polzun'><img src='images/b2_2.gif' alt='' width='3'  /><img src='images/b2_3.gif' alt='' width='200' /><img src='images/b2_4.gif' alt='' width='3'  /><img src='images/b2_5.gif' alt='' width='0' /><img src='images/b2_6.gif' alt='' width='3' /></span>
	</table>
</table>
		</div>
<?php } ?>
					<td class='stats'>
<table class='stats'>
<tr><th colspan='2'  class='blockTitle'>Статистика:</th></tr>
<tr class='row_1'>	<td class='left'>Вербовка:	<td><?php echo $row['ref'];?>	</tr>
<tr><td class='left'>Родня:					<td>-		</tr>
<tr class='row_1'><td class='left'>Бои:	<td><?php echo $row['battle'];?>		</tr>
<tr><td class='left'>Победы:					<td><?php echo $row['win'];?>		</tr>
<tr class='row_1'><td class='left'>Награблено:		<td><?php echo $row['loot'];?> <img src='images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'>
<tr><td class='left'>Утрачено:					<td><?php echo $row['lost'];?> <img src='images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'>
<tr class='row_1'><td class='left'>Урон:	<td><?php echo $row['damage'];?></tr>
</table>
<br /></table></div></div></div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
		<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'><div class='content'><div class='b2'><div id='moreGifts' >
		<center>Мои подарки:</center>
		<?php
		$myGiftsBe = count_query("SELECT * FROM `gifts_p` WHERE `pid_g`='".$row['id_user']."'");
		$podarok = 0;
		while ($myRowGiftsBe = mysql_fetch_array($myGiftsBe))
		{
			$myRowGiftPBe = mysql_fetch_array(count_query("SELECT * FROM `gift` WHERE id='".$myRowGiftsBe['gift_num']."'"));
			switch($myRowGiftsBe['when'])
			{
				case 1: $myRowGiftPsBe = mysql_result(count_query("SELECT `name` FROM `users` WHERE `id_user`='".$myRowGiftsBe['uid_g']."'"),0); $tyta = 'от игрока <b>'.$myRowGiftPsBe.'</b>'; break;
				case 2: if ($row['id_user'] != $myRowGiftsBe['pid_g']) {$tyta = 'Это приватный подарок';} else {$myRowGiftPsBe = mysql_result(count_query("SELECT `name` FROM `users` WHERE `id_user`='".$myRowGiftsBe['uid_g']."'"),0); $tyta = 'Это приватный подарок от <b>'.$myRowGiftPsBe.'</b>';} break;
				case 3: $tyta = 'Анонимно'; break;
			}
			echo "<img src='images/items/".$myRowGiftPBe['pic'].".jpg' alt=''  onMouseOver=\"doItem('g".$myRowGiftPBe['when']."','".$myRowGiftsBe['desc']."<br><br>".$tyta."','','0',event,this)\" />";
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
		<a href='player.php?id=<?=$row['id_user'];?>&show=gifts' >
		<img src='images/RU/buttons/but_down2_p.png' alt='+' class='cmd' onMouseOver="doImage(this,'RU/buttons/but_down2')" /></a><br /></div></div></div></div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
		<!--<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'><div class='content'><div class='b2'>Завербуй друга - получи награду!(<a href='refer.php'>узнай подробнее</a>)<br /> <b>http://g1.botva.ru/l.php?id=408263</b></div></div></div>-->
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
</div></div>	</td></tr>
<?php } include ("footer_tpl.php");?>