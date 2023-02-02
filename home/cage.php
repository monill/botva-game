<?php
session_start();

##################### Класс борьбы с SQL атаками ################
include_once("function/sql.php");

$stop_injection = new InitVars();
$stop_injection->checkVars();
##################### Класс борьбы с SQL атаками ################

if (!isset($_SESSION['email'])) {
	echo "<script>location.href='index.php';</script>"; //переадресовываем в игру 
}

switch ($row['cage'])
{
	case 0: $metka0 = "class='row_1'"; $per = 20; break;
	case 1: $metka1 = "class='row_1'"; $per = 30; break;
	case 2: $metka2 = "class='row_1'"; $per = 40; break;
	case 3: $metka3 = "class='row_1'"; $per = 50; break;
	case 4: $metka4 = "class='row_1'"; $per = 60; break;
	case 5: $metka5 = "class='row_1'"; $per = 70; break;
	case 6: $metka6 = "class='row_1'"; $per = 80; break;
	case 7: $metka7 = "class='row_1'"; $per = 90; break;
	case 8: $metka8 = "class='row_1'"; $per = 100; break;
}

if (isset($_POST['build']))
{
	if ($_POST['build'] == 1)
	{
		if ($row['cage'] < 8)
		{
			if ($row['gold'] >= $cage_cost)
			{
				count_query("UPDATE `users` SET gold=gold-'".$cage_cost."', `cage`=cage+1 WHERE `email` = '".$_SESSION['email']."'");
				echo "<script>location.href='?info=cage';</script>";
			}
			else
			{
				$err = "<div class='message'>Нет денег.</div>";
			}
		}
	}
}
?>
<tr>
        <td height="750" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class='blockHead'><img src='images/RU/titles/h_home_cage.png' alt='Клетка' /></div>
			
		<div class='contentBlock' id='contentBlock'><a href='house.php' class='back'><img src='images/RU/b_back_p.png' alt='Назад' class='cmd'
								onMouseOver="doImage(this,'RU/b_back')" /></a>
		<div class='box_wrap' id='help_25'>
			<div onclick="showBox('help_25')" class='box_title title_show' id='t_help_25'>Помощь</div>
			<div id='b_help_25' class='box_body shown'><div class='left'>Клетка – место обитания прирученного питомца. Когда вам грустно и плохо, вы всегда знаете, что в вашем жилище есть место, где вас ждут. Маленькие глазки-бусинки приветливо моргают, глядя на вас через решетку. А что делать?! Ведь стоит выпустить это милое создание на волю, и оно в момент разорвет ваших врагов в клочья... Так что лучше не засовывать пальцы между прутьев, пытаясь погладить зверька.
			<table class='default center' style='width:510px'>
			<tr><th width='100'>Уровень<th>Характеристики<th width='100'>Цена улучшения
			<tr <?=$metka0;?>><td> 0	<td>20%<td>1845 <img src='/images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'>
			<tr <?=$metka1;?>><td> 1	<td>30%<td>8303 <img src='/images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'>
			<tr <?=$metka2;?>><td> 2	<td>40%<td>18683 <img src='/images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'>
			<tr <?=$metka3;?>><td> 3	<td>50%<td>37366 <img src='/images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'>
			<tr <?=$metka4;?>><td> 4	<td>60%<td>74732 <img src='/images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'>
			<tr <?=$metka5;?>><td> 5	<td>70%<td>112098 <img src='/images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'>
			<tr <?=$metka6;?>><td> 6	<td>80%<td>149464 <img src='/images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'>
			<tr <?=$metka7;?>><td> 7	<td>90%<td>298928 <img src='/images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'>
			<tr <?=$metka8;?>><td> 8	<td>100%<td>-</table></div></div>
		</div>
			<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'><div class='content'><div class='b2'><table class='default'>
					<tr><td valign='top' class='img'><img src='images/house/M_cage.jpg' alt='' width=180 height=180/>
						<td valign='top' style='padding-left:2px'>
			<form method='POST' action='house.php?info=cage'>
				<input type='hidden' name='build' value='1'>
				<table class='default left' style='width:330px'>
			<tr><th>Текущий уровень: <?=$row['cage'];?>
			<tr><td>Характеристики вашей зверушки составляют <b><?=$per;?>%</b> от ваших боевых характеристик.
			<?php
			if ($row['cage'] < 8)
			{
			?>
			<tr><th>Следующий уровень: <?=$row['cage']+1;?>
			<tr><td>Характеристики вашей зверушки составляют <b><?=$per+10;?>%</b> от ваших боевых характеристик.
			<tr><th class='center'><b>Цена: <?=$cage_cost;?> <img src='/images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'></b>
						<tr><td class='center'><input type='image' name='cmd' class='image cmd' src='images/RU/buttons/b_upgrade_p.png' alt='Улучшить'
					onMouseOver="doImage(this,'RU/buttons/b_upgrade',null)"/ >
			<? } ?>
			</table>
				</form>
			</table></div></div></div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>	<div class='inputGroup inputSmall inputNoHeight' >
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1' >
			<div class='content' ><div class='title'>Увеличить клетку</div><div class='body'><form method='POST' action='house.php?info=cage' class='inline'>
		<input type='hidden' name='cmd' value='cage_up' />
		<input type='hidden' name='cage_level' value='0' />
		<input type='hidden' name='k' value='25743' />
		Если одной зверушки тебе мало, за скромную сумму умелые мастера легко увеличат клетку в два раза. Правда, в бой ты все равно взять сможешь все равно только одну зверушку.<br /><br />
Клетку можно увеличить после этого ещё раз – до трех зверушек.<br /><br />Цена: <input type='radio' name='ptype' value='1' />50 <img src='/images/ico_krist1.png' alt='Кристалл' align='absmiddle' class='png'> / <input type='radio' name='ptype' value='2' checked/>50 <img src='/images/ico_green1.png' alt='Зелень' align='absmiddle' class='png'><br /><br /><input type='image' name='do' class='image cmd' src='images/RU/buttons/b_upgrade_cage_p.png' alt='Увеличить клетку'
					onMouseOver="doImage(this,'RU/buttons/b_upgrade_cage',null)"/ >
		</form></div></div>
		</div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
<br /><br />	<div class='inputGroup inputSmall inputNoHeight' >
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1' >
			<div class='content' ><div class='title'>Ваша ручная зверушка</div><div class='body'>У вас нет магической зверушки.<br /><br />Но вы можете приобрести её <br />в <a href='shop.php?group=7'>лавке у торговца</a>.</div></div>
		</div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
<br />	<div class='inputGroup inputSmall inputNoHeight' >
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1' >
			<div class='content' ><div class='title'>Сменить зверушку</div><div class='body'><table class='default center'><tr><td style='width:33%' class='top'><img src='images/items/Pet_0s.jpg' class='item2'/><td style='width:33%' class='top'><img src='images/items/Pet_0s.jpg' class='item2'/><td style='width:33%' class='top'><img src='images/items/Pet_0s.jpg' class='item2'/></table></div></div>
		</div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
</div>	</td></tr>