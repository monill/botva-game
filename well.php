<?php
include ("top_tpl.php");

$t = $_GET['t'];
$well = array();
$well['apple'] = array('h_apple.png', 'Яблочко', 'b7_2_p.png', '<td>Я яблочко! Меня ты если укусишь, то фракцию сменишь! И если свинья – заблеешь бараном, а если баран, захрюкаешь свинкой.', '<b>Плачу зеленью!</b> (стоимость Цена: 75 <img src=\'/images/ico_green1.png\' alt=\'Зелень\' align=\'absmiddle\' class=\'png\'> )<br />
Смена фракции через оплату капустой. Будьте готовы к переменам при нажатии «Откусить яблочко».', '<b>Плачу кристаллами!</b> (стоимость Цена: 75 <img src=\'/images/ico_krist1.png\' alt=\'Кристалл\' align=\'absmiddle\' class=\'png\'> )<br />
Смена фракции через оплату кристаллами. Будьте готовы к переменам при нажатии «Откусить яблочко».', '<input type=\'image\' name=\'h_apple\' class=\'image cmd\' src=\'images/RU/b_apple_p.png\' alt=\'Откусить яблочко\' onMouseOver="doImage(this,\'RU/b_apple\',null)"/ >');
$well['pin'] = array('h_pin.png', 'Царапалка', 'b7_3_p.png', '<td class=\'center\'>Объясняю один раз.<br />
Нацарапать имя на грамоте подделанной – лишиться части славы, ведь несолидно славным героям бумажки подделанные носить.<br />
Лицензионных грамот число ограниченное, потому и зеленью плата, но славы ты не лишишься.<br />', '<b>Новая грамота!</b> (стоимость Цена: 15 <img src=\'/images/ico_green1.png\' alt=\'Зелень\' align=\'absmiddle\' class=\'png\'> )<br />
Лицензионная бумага, качественная, завезенная с острова бегемотов. Такие грамоты бегемоты меняют только на зелень, выращиваемую в горах «Шубидубу».', '<b>Подделка грамоты!</b> (минус 10% славы, Цена: 1920 <img src=\'/images/ico_gold1.png\' alt=\'Золото\' align=\'absmiddle\' class=\'png\'>)<br />
Некачественная бумага. При покупке поддельных документов понижается параметр «Слава». При этом сама бумага покупается за золото.', '<input name=\'new_name\' type=\'text\'  size=\'25\' maxlength=\'20\' value=\'\' /><br /><br /><input type=\'image\' name=\'do\' class=\'image cmd\' src=\'images/RU/b_renaming_p.png\' alt=\'Сменить имя\' onMouseOver="doImage(this,\'RU/b_renaming\',null)"/ >');
$well['leave_clan'] = array('h_leave_clan.png', 'Выйти из клана', 'b7_6_p.png', '<td>Если клан в состоянии постоянной войны, а ты не можешь и не хочешь больше находиться в этом клане – только Ведьма может помочь.', '<b>Уйти подкопами</b> (минус 10% славы, Цена: 1920 <img src=\'/images/ico_gold1.png\' alt=\'Золото\' align=\'absmiddle\' class=\'png\'>):<br />
Ведьма сканирует замок вашего клана на поиск лучшего места для подкопа. Однако побег скажется на вашей репутации.', '<b>Остановить сердце</b> (Цена: <input type=\'radio\' name=\'ptype\' value=\'1\' checked />15 <img src=\'/images/ico_krist1.png\' alt=\'Кристалл\' align=\'absmiddle\' class=\'png\'> / <input type=\'radio\' name=\'ptype\' value=\'2\' checked2/>15 <img src=\'/images/ico_green1.png\' alt=\'Зелень\' align=\'absmiddle\' class=\'png\'>):<br />
Ведьма дает вам волшебное средство, которое временно останавливает сердце. Все думают, что вы отошли в мир иной и выносят тело за пределы замка.', '<input type=\'image\' name=\'h_clan_leave\' class=\'image cmd\' src=\'images/RU/buttons/b_leave_p.png\' alt=\'Выйти из клана\' onMouseOver="doImage(this,\'RU/buttons/b_leave\',null)"/ >');
$well['leave_guild'] = array('h_leave_guild.png', 'Покинуть гильдию', 'b7_8_p.png', '<td>Если гильдия вас больше не устраивает – только Ведьма может помочь. Главное - помнить, что в случае возвращения в гильдию, все нужно будет начинать сначала, успехи, увы, не сохраняются. <br /><b> Помни - последующие входы в гильдию будут дороже!</b>', '<b>Устроить скандал</b> (минус 20% славы, Цена: 12800 <img src=\'/images/ico_gold1.png\' alt=\'Золото\' align=\'absmiddle\' class=\'png\'> ):<br />
Ведьма подстраивает скандал, виновником которого вы становитесь. Вас выгоняют из гильдии и это сильно скажется на вашей репутации.', '<b>Дать взятку</b> (Цена: <input type=\'radio\' name=\'ptype\' value=\'1\' checked />150 <img src=\'/images/ico_krist1.png\' alt=\'Кристалл\' align=\'absmiddle\' class=\'png\'> / <input type=\'radio\' name=\'ptype\' value=\'2\' checked2/>150 <img src=\'/images/ico_green1.png\' alt=\'Зелень\' align=\'absmiddle\' class=\'png\'> ):<br />
Ведьма находит способ дать взятку главе гильдии, который подпишет документы о вашем уходе из гильдии по очень уважительным причинам.', '<input type=\'image\' name=\'h_wguild\' class=\'image cmd\' src=\'images/RU/buttons/b_wguild_p.png\' alt=\'Покинуть гильдию\' onMouseOver="doImage(this,\'RU/buttons/b_wguild\',null)"/ >');

switch ($t)
{
	case 1: $x = $well['apple']; break;
	case 2: $x = $well['pin']; break;
	case 3: $x = $well['leave_clan']; break;
	case 4: $x = $well['leave_guild']; break;
}
if (isset($t) AND $t >= 1 AND $t <= 4)
{
if (isset($_POST['radio']))
{
	switch ($t)
	{
		case 1: //Смена фракции
			switch ($_POST['radio'])
			{
				case "price1": 
					if ($row['zelen'] >= 75 AND $row['clan'] == 0)
					{
						switch ($row['race'])
						{
							case 1: $r = 2; break;
							case 2: $r = 1; break;
						}
						count_query("UPDATE `users` SET zelen=zelen-'75', race='".$r."' WHERE email='".$_SESSION['email']."'");
					}
					else if ($row['clan'] > 0)
					{
						$err = "<div class='message'>Для начала уйди из клана</div>";
					}
					else
					{
						$err = "<div class='message'>Не хватает Зелени</div>";
					};
					break;
				case "price2":
					if ($row['krystal'] >= 75 AND $row['clan'] == 0)
					{
						switch ($row['race'])
						{
							case 1: $r = 2; break;
							case 2: $r = 1; break;
						}
						count_query("UPDATE `users` SET krystal=krystal-'75', race='".$r."' WHERE email='".$_SESSION['email']."'");
					}
					else if ($row['clan'] > 0)
					{
						$err = "<div class='message'>Для начала уйди из клана</div>";
					}
					else
					{
						$err = "<div class='message'>Не хватает Кристалов</div>";
					};
					break;
			}
			break;
		case 2: //Сменить имя
			if (isset($_POST['new_name']))
			{
				switch ($_POST['radio'])
				{
					case "price1": 
						if ($row['zelen'] >= 15)
						{
							count_query("UPDATE `users` SET zelen=zelen-'15', name='".$_POST['new_name']."' WHERE id_user='".$_SESSION['id']."'");
						}
						else
						{
							$err = "<div class='message'>Не хватает Зелени</div>";
						}
						break;
					case "price2":
						if ($row['gold'] >= 1920)
						{
							$stavka = round($row['glory']*10/100);
							count_query("UPDATE `users` SET gold=gold-'1920', glory=glory-'".$stavka."', name='".$_POST['new_name']."' WHERE id_user='".$_SESSION['id']."'");
						}
						else
						{
							$err = "<div class='message'>Не хватает Золота</div>";
						}
						break;
				}
			}
			break;
		case 3: //Уйти из клана
			if ($row['clan'] > 0)
			{
				switch ($_POST['radio'])
				{
					case "price1": 
						if ($row['gold'] >= 1920)
						{
							count_query("UPDATE `users` SET gold=gold-'1920', clan='0', clan_stat='Призывник' WHERE id_user='".$_SESSION['id']."'");
						}
						else
						{
							$err = "<div class='message'>Не хватает Зелени</div>";
						}
						break;
					case "price2":
						switch ($_POST['ptype'])
						{
							case 1: $m = 'krystal'; $mt = 'Кристалов'; break;
							case 2: $m = 'zelen'; $mt = 'Зелени'; break;
						}
						if ($row[$m] >= 15)
						{
							count_query("UPDATE `users` SET ".$m."=".$m."-'15', clan='0', clan_stat='Призывник' WHERE id_user='".$_SESSION['id']."'");
						}
						else
						{
							$err = "<div class='message'>Не хватает ".$mt."</div>";
						}
						break;
				}
			}
			else
			{
				$err = "<div class='message'>Ты не в клане, откуда убегать собрался-то ?</div>";
			}
			break;
		case 4: //Покинуть гильдию
			$err = "В разработке";
			break;
	}
	if ($err == "")
	{
		echo "<script>location.href='?t=".$t."';</script>";
	}
}
?>
<tr>
        <td height="750" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class='blockHead'><img src='images/RU/titles/<?=$x[0];?>' alt='<?=$x1;?>' /></div>
			
		<div class='contentBlock' id='contentBlock'><a href='well.php' class='back'><img src='images/RU/b_back_p.png' alt='Назад' class='cmd'
								onMouseOver="doImage(this,'RU/b_back')" /></a><br /><br /><?php if ($t == 4) echo "<div class='message'>Ты не в гильдии, откуда убегать собрался-то ?</div>"; ?><?=$err;?>	<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'><div class='content'><div class='b2'>
	<form action='' method='post'>
	<table class='default well' style='width:97%'>
	<tr class='row_3 r1'>
		<td width='100'><img src='images/<?=$x[2];?>' alt='' />
		<?=$x[3];?>
	</tr>
	<tr class='row_3'><td class='center'><input type='radio' name='radio'	value='price1'/>	<td><?=$x[4];?></tr>
	<tr class='row_3'><td class='center'><input type='radio' name='radio'	value='price2' />		<td><?=$x[5];?></tr>
	<tr class='row_3'><td class='center' colspan='2'><?=$x[6];?></tr>
	</table>
	</form>
	</div></div></div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div></div>	</td></tr>
<?php
}
else
{
?>
<tr>
        <td height="750" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class='blockHead'><img src='images/RU/titles/h_witch.png' alt='Колодец' /></div>
			
		<div class='contentBlock' id='contentBlock'><table class='up_avatar'><tr><td class='avatar'><img src='images/witch_man.jpg' alt='Ведьма'>	</td><td>	<div class='inputGroup inputSmall  ' >
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1' style='height:180px !important'>
			<div class='content' ><div class='title'>Ведьма</div><div class='body'>Так-так, ещё один смельчак.<br /><br />
Ну что же, проходи, да страх ты свой уйми. Не испугался ты меня, ну что же, размазня, устрою я тебе, сто тыщ прыщавок на спине. Но если ты по делу, то проходи налево, там тебя и накормлю, да и спать с собою уложу.
А если ты девица, будет к чему тебе стремиться, когда себя я покажу.<br /><br />
Но сначала ты плати – за яблочко живое мне руку позолоти. А если за царапалкой ко мне ты пришел – их тоже есть у меня.</div></div>
		</div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
</td></tr></table>	<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'><div class='content'><div class='b2'><table class='default' style='margin:0 5px;width:500px;'><tr class='row_5'>
				<td style='width:100px' class='top'><a href='well.php?t=1'><img src='images/b7_2_p.png' id='img1'	onmouseover="doImageHover(1);" onmouseout='doImageHover(1,false);' ></a>
				<td class='center text_main_4'>
А яблочко то не простое. Румяное, да наливное. Но только есть одно, огромное, большое НО.<br />
Я ядом его пропитала своим, и будь ты хоть баран, а хоть бы и свин – почувствуешь жар ты, когда, пятачок твой отвалится, или рога.<br /><br /><a href='well.php?t=1' ><img src='images/RU/b_change2_p.png' alt='Сменить фракцию' class='cmd'
								onMouseOver="doImage(this,'RU/b_change2','skip')" /></a><br /><tr class='row_5'>
				<td style='width:100px' class='top'><a href='well.php?t=2'><img src='images/b7_3_p.png' id='img2'	onmouseover="doImageHover(2);" onmouseout='doImageHover(2,false);' ></a>
				<td class='center text_main_4'>Царапалку если ты выбрать решил, забудь своё имя – другое купил. И будешь отныне с тех пор навсегда, зваться какой-нибудь «Караганда».<br />Хотя буду честной – для имени ты себе нацарапай что хочешь. Аминь.<br /><br /><a href='well.php?t=2' ><img src='images/RU/b_change1_p.png' alt='Сменить имя' class='cmd'
								onMouseOver="doImage(this,'RU/b_change1','skip')" /></a><br /><tr class='row_5'>
				<td style='width:100px' class='top'><a href='well.php?t=3'><img src='images/b7_6_p.png' id='img3'	onmouseover="doImageHover(3);" onmouseout='doImageHover(3,false);' ></a>
				<td class='center text_main_4'>Если в клане невозможно больше находиться, к ведьме ты пришел, чтоб освободиться. И подкоп, если нужно, научит тя делать, и продаст, если нужно, волшебное зелье. Всем замечательна добрая ведьма, особенно если почаще к ней бегать.<br /><br /><a href='well.php?t=3' ><img src='images/RU/buttons/b_leave_p.png' alt='Уйти из клана' class='cmd'
								onMouseOver="doImage(this,'RU/buttons/b_leave','skip')" /></a><br /><tr class='row_5'>
				<td style='width:100px' class='top'><a href='well.php?t=4'><img src='images/b7_8_p.png' id='img5'	onmouseover="doImageHover(5);" onmouseout='doImageHover(5,false);' ></a>
				<td class='center text_main_4'>Если от гильдии ты что-то устал, то твой черед уходить настал. Правильно то, что ты к ведьме пришел, где помощь получишь - ты место нашел. Хоть сохранить, что накопил ты - нельзя, с гильдии хитро я выведу тебя.<br /><br /><a href='well.php?t=4' ><img src='images/RU/buttons/b_wguild_p.png' alt='Покинуть гилдьию' class='cmd'
								onMouseOver="doImage(this,'RU/buttons/b_wguild','skip')" /></a><br /></table></div></div></div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div></div>	</td></tr>
<?php
}
include ("footer_tpl.php");
?>