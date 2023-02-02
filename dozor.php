<?php
include ("top_tpl.php");

$tp = $_POST['type'];

$work = mysql_fetch_array(count_query("SELECT * FROM `action` WHERE `uid` = '".$row['id_user']."'"));
if ($work['id']<>'') {
	echo "<script>location.href='timer.php';</script>";
	exit;
}
if ($row['mwork'] > 0)
{
	loca('mine.php?a=open');
	exit;
}

if ($row['vip'] > 0)
{
	$doz = $_POST['auto_watch']<=24 AND $_POST['auto_watch']>=1;
	$sel = "<option value='13'>130 мин</option>
			<option value='14'>140 мин</option>
			<option value='15'>150 мин</option>
			<option value='16'>160 мин</option>
			<option value='17'>170 мин</option>
			<option value='18'>180 мин</option>
			<option value='19'>190 мин</option>
			<option value='20'>200 мин</option>
			<option value='21'>210 мин</option>
			<option value='22'>220 мин</option>
			<option value='23'>230 мин</option>
			<option value='24'>240 мин</option>";
}
else
{
	$doz = $_POST['auto_watch']<=12 AND $_POST['auto_watch']>=1;
	$sel = "";
}

if (isset($_POST['do_watch']) AND $doz) //Дозор
{
	if ($row['time_dozor'] > 0 AND $row['gold'] > 10 AND $row['time_dozor'] >= ($_POST['auto_watch']*10))
	{
		$minutes  = $_POST['auto_watch'];
		$method = $_POST['auto_watch'];
		$dozor_t = $row['time_dozor']-($_POST['auto_watch']*10);
		$minutes  = time()+$minutes*600;
		count_query("UPDATE `users` SET `gold`=gold-'10', `time_dozor`='".$dozor_t."' WHERE `id_user` = '".$_SESSION['id']."'");
		count_query("INSERT INTO `action` (`uid`, `model`, `speed`, `timer`) VALUES ('".$row['id_user']."','2', '".$method."','".$minutes."')");
		echo "<script>location.href='timer.php';</script>";
		exit;
	}
	else
	{
		$err = "Низзя";
	}
}

if ($_GET['a'] == "monster") //Страшилки
{
	if (isset($_POST['select_search']))
	{
		if (lvl($row['exp']) < 7)
		{
			$err = "Мал ещё по страшилкам бегать. Вот дорости до 7ого класса, тогда и приходи.";
		}
		else
		{
			switch ($_POST['ptype'])
			{
				case 1: if ($row['krystal'] >= 1) { count_query("UPDATE users SET krystal=krystal-'1' WHERE email='".$_SESSION['email']."'"); $err = monster(2,$_POST['level']);} else {$err="Не хватает Кристалов";}; break;
				case 2: if ($row['zelen'] >= 1) { count_query("UPDATE users SET zelen=zelen-'1' WHERE email='".$_SESSION['email']."'"); $err = monster(2,$_POST['level']);} else {$err="Не хватает Зелени";}; break;
			}
		}
	}
	else if (isset($_POST['strash_rand']))
	{
		if (lvl($row['exp']) < 7)
		{
			$err = "Мал ещё по страшилкам бегать. Вот дорости до 7ого класса, тогда и приходи.";
		}
		else
		{
			if ($row['gold'] >= 500)
			{
				$err = monster(1);
			}
		}
	}
}

if (isset($_POST['addon_search'])) //Расширенный поиск
{
	if($row['vip'] > 1)
	{
		count_query("UPDATE users SET gold=gold-1 WHERE id_user='".$row['id_user']."'");
		$lvls = $_POST['min'];
		$lvle = $_POST['max'];
		$err = search_batt(5,null,$lvls,$lvle);
	}
	else
	{
		echo "<script>location.href='kormushka.php';</script>";
	}
}

if (isset($_POST['do_search']) AND $_POST['do_search'] == 1) //Бойня
{
	if ($_POST['name'] != null AND $row['gold'] > 0) //поиск по имени
	{
		$select_enemy_name = mysql_fetch_array(count_query("SELECT * FROM users WHERE name = '".$_POST['name']."'"));
		
		count_query("UPDATE users SET gold=gold-1 WHERE id_user='".$row['id_user']."'");
		$err = search_batt(4,$select_enemy_name['name']);
	}
	else if (isset($tp) AND $row['gold'] > 0) //поиск по выборке
	{
		count_query("UPDATE users SET gold=gold-1 WHERE id_user='".$row['id_user']."'");
		switch ($tp)
		{
			case 1: $err = search_batt(1); break; //равные
			case 2: $err = search_batt(2); break; //слабые
			case 3: $err = search_batt(3); break; //сильные
			case $tp > 3: $err = "Еще не доступно"; break;
		}
	}
	else
	{
		$err = "Не хватает золота";
	}
}

if (isset($_POST['do_attack']) AND $_POST['do_attack'] == 1)
{
	bat($row['id_user'], $_POST['char_id']);
}

if (isset($_POST['do_searchm']))
{
	count_query("UPDATE users SET gold=gold-1 WHERE id_user='".$row['id_user']."'");
	search_batt();
}
?>
      <tr>
        <td height="750" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class='blockHead'><img src='images/RU/titles/h_dozor.png' alt='Бодалка' /></div>
			
		<div class='contentBlock' id='contentBlock'><table class='up_avatar'><tr><td class='avatar'><img src='images/war_man_b.jpg' alt='Капитан стражи'>	</td><td>	<div class='inputGroup inputSmall ' >
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1' style='height:180px !important'>
			<div class='content' ><div class='title'>Капитан стражи</div><div class='body'>Так-так, наши отряды пополнились ещё одним искателем приключений на свою пятую точку.<br /><br />
Если на <b>бойню</b> – записывайся в левую группу. Ведь что может быть приятнее, чем надавать по шее противнику? Не только надавать по шее, но и получить за это его же золото.<br /><br />
Если в <b>дозор</b> – направо. В дозоре надо быть готовым ко всему и, если не спать на посту, можно рассчитывать на какое-нибудь приключение.<br /></div></div>
		</div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
</td></tr></table><div class='message'><?php echo $err; ?></div>
<div class='dozor'>



<table class='info'>
	<tr><td class='half'>	<div class='inputGroup inputSmall ' >
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1' style='height:250px !important'>
		<div class='content' ><div class='title'>Бойня</div><div class='body'>
			<?php
			if ($row['bat_timer'] <> 0)
			{
				include ("bat_timer.php");
			}
			else
			{
			?>
				<form action='' method ='POST' class='center inline'>
				<input type='hidden' name='do_search' value='1'>
			Цена: 1 <img src='images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'><br /><br /><select name='type' class='field select_type' id='type' ><option value='1' selected>Поиск равных</option><option value='3'>Поиск сильных</option><option value='2'>Поиск слабых</option><option value='10'>Список для грабежа</option><option value='11'>Список для славы</option><option value='12'>Список для мести</option><option value='100'>Клановые войны</option></select><br /><input type='image' name='auto_search' class='image cmd' src='images/RU/b_find_p.png' alt='Искать противника'
					onMouseOver="doImage(this,'RU/b_find',null)"/ ><br /><br />Имя противника<input type='text' name='name' id='name' size='25' maxlength='20' value='' ><br /><br /><input type='image' name='name_search' class='image cmd' src='images/RU/b_nap_p.png' alt='Напасть'
					onMouseOver="doImage(this,'RU/b_nap',null)"/ ><br /></form>
			<?php } ?>
			</div></div>
		</div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
	<br />	<div class='inputGroup inputSmall ' >
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1' style='height:165px !important'>
		<div class='content' ><div class='title'>Расширенный поиск <br /><span class='nobold'>(только для "крутых")</span></div><div class='body'>
			<?php
			if ($row['bat_timer'] <> 0)
			{
				include ("bat_timer2.php");
			}
			else
			{
			?>
			<form action='' method ='POST' class='center inline'>
				<input type='hidden' name='addon_search'>
				Цена: 1 <img src='images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'><br /><br />Уровень от <input type='text' name='min' id='min' value='<?php echo lvl($row['exp']); ?>' class='small' size='2' maxlength='2'> до <input type='text' name='max' id='max' value='<?php echo lvl($row['exp'])+4; ?>' class='small' size='2' maxlength='2'> <br /><br /><input type='image' name='auto_search' class='image cmd' src='images/RU/b_find_p.png' alt='Искать противника'
					onMouseOver="doImage(this,'RU/b_find',null)"/ ><br /></form>
			<?php } ?>
			</div></div>
		</div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
	</td>
		<td class='half'>	<div class='inputGroup inputSmall ' >
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1' style='height:150px !important'>
			<div class='content' ><div class='title'>Дозор</div><div class='body'><form action='' method ='POST' class='center inline'>
			Цена: 10 <img src='images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'><br /><br />
			<table class='center'>
				<tr>
					<td>
						<select name='auto_watch' class='field select_auto_watch' id='auto_watch' >
							<option value='1'>10 мин</option>
							<option value='2'>20 мин</option>
							<option value='3'>30 мин</option>
							<option value='4'>40 мин</option>
							<option value='5'>50 мин</option>
							<option value='6'>60 мин</option>
							<option value='7'>70 мин</option>
							<option value='8'>80 мин</option>
							<option value='9'>90 мин</option>
							<option value='10'>100 мин</option>
							<option value='11'>110 мин</option>
							<option value='12'>120 мин</option>
							<?=$sel;?>
						</select>
					<td width=40>
			<input type='hidden' name='do_watch'>
			<input type='image' name='do_watch' class='image cmd' src='images/RU/b_bgn_p.png' alt='Начать' onMouseOver="doImage(this,'RU/b_bgn',null)"/ ><br />
			</td></tr></table><br />осталоcь времени: <?=$row['time_dozor'];?></form></div></div>
		</div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
<br />	<div class='inputGroup inputSmall ' >
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1' style='height:265px !important'>
			<div class='content' ><div class='title'>Страшилки</div><div class='body'>Цена: 500 <img src='images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'> <br /><br />Вы можете встретить страшилку от 1 до 3 уровня<br /><br /> <form method='post' class='inline' action='?a=monster'><input type='hidden' name='level' value='auto' /><input type='hidden' name='strash_rand'/><input type='image' name='doit' class='image cmd' src='images/RU/buttons/b_w_m_search_p.png' alt='искать страшилку'
					onMouseOver="doImage(this,'RU/buttons/b_w_m_search',null)"/ ></form><br /><br /><form method='POST' action='?a=monster'>

			Цена: <input type='radio' name='ptype' value='1' />1 <img src='images/ico_krist1.png' alt='Кристалл' align='absmiddle' class='png'> / <input type='radio' name='ptype' value='2' checked/>1 <img src='images/ico_green1.png' alt='Зелень' align='absmiddle' class='png'><br /><br />
			<select name='level' class='field select_level' id='level' ><option value='1' selected>страшилка 1 уровня</option><option value='2'>страшилка 2 уровня</option><option value='3'>страшилка 3 уровня</option></select><br /><br />
			<input type='hidden' name='select_search'>
			<input type='image' name='doit' class='image cmd' src='images/RU/buttons/b_w_m_search_p.png' alt='искать страшилку'
					onMouseOver="doImage(this,'RU/buttons/b_w_m_search',null)"/ ><br /></form>

			</div></div>
		</div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
		</td>
	</td></tr></table>
	<Br /><br />
</div>
</div></div>	</td></tr>
<?php include ("footer_tpl.php"); ?>