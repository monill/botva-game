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

switch ($row['road'])
{
	case 0: $metka0 = "class='row_1'"; break;
	case 1: $metka1 = "class='row_1'"; break;
	case 2: $metka2 = "class='row_1'"; break;
	case 3: $metka3 = "class='row_1'"; break;
	case 4: $metka4 = "class='row_1'"; break;
	case 5: $metka5 = "class='row_1'"; break;
	case 6: $metka6 = "class='row_1'"; break;
	case 7: $metka7 = "class='row_1'"; break;
	case 8: $metka8 = "class='row_1'"; break;
	case 9: $metka9 = "class='row_1'"; break;
	case 10: $metka10 = "class='row_1'"; break;
}

if (isset($_POST['build']))
{
	if ($_POST['build'] == 1)
	{
		if ($row['road'] < 10)
		{
			if ($row['gold'] >= $road_cost)
			{
				count_query("UPDATE `users` SET gold=gold-'".$road_cost."', `road`=road+1 WHERE `email` = '".$_SESSION['email']."'");
				echo "<script>location.href='?info=road';</script>";
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
<div class='blockHead'><img src='images/RU/titles/h_home_road.png' alt='Дорожка' /></div>
			
		<div class='contentBlock' id='contentBlock'><a href='house.php' class='back'><img src='images/RU/b_back_p.png' alt='Назад' class='cmd'
								onMouseOver="doImage(this,'RU/b_back')" /></a>
		<div class='box_wrap' id='help_25'>
			<div onclick="showBox('help_25')" class='box_title title_show' id='t_help_25'>Помощь</div>
			<div id='b_help_25' class='box_body shown'><div class='left'>Повышение уровня Дорожки позволяет находить новых соперников при случайном поиске в разделе «Бодалка». Дорожка напрямую связана с уровнем Местности противника. Так, если у вас 5й уровень Дорожки, это означает, что вы можете найти по случайному поиску только тех противников, у которых уровень Местности равен или меньше 5. В этом случае противники с уровнем Местности 6 и выше защищены от вашего нападения по случайному поиску.<br /><br />
Также при каждом повышении уровня Дорожки вы получаете +1% к шансу отменить бонусы Ограды соперника, которые действуют при вашем на него нападении. При постройке 10 уровня Дорожки вы получаете сразу +5% к шансу отменить бонусы Ограды соперника.
<table class='default center' style='width:510px'>
	<tr><th width='100'>Уровень<th>Поиск по окрестностям	<th> Шанс отменить бонусы ограды <th width='100'>Цена улучшения
	<tr <?=$metka0;?>><td> 0	<td>0<td>1%<td>4 <img src='/images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'>
	<tr <?=$metka1;?>><td> 1	<td>1<td>2%<td>16 <img src='/images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'>
	<tr <?=$metka2;?>><td> 2	<td>2<td>3%<td>64 <img src='/images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'>
	<tr <?=$metka3;?>><td> 3	<td>3<td>4%<td>256 <img src='/images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'>
	<tr <?=$metka4;?>><td> 4	<td>4<td>5%<td>1024 <img src='/images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'>
	<tr <?=$metka5;?>><td> 5	<td>5<td>6%<td>4096 <img src='/images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'>
	<tr <?=$metka6;?>><td> 6	<td>6<td>7%<td>16384 <img src='/images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'>
	<tr <?=$metka7;?>><td> 7	<td>7<td>8%<td>65536 <img src='/images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'>
	<tr <?=$metka8;?>><td> 8	<td>8<td>9%<td>262144 <img src='/images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'>
	<tr <?=$metka9;?>><td> 9	<td>9<td>10%<td>1048576 <img src='/images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'>
	<tr <?=$metka10;?>><td> 10	<td>10<td>15%<td>-</table></div></div>
		</div>
			<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'><div class='content'><div class='b2'><table class='default'>
					<tr><td valign='top' class='img'><img src='images/house/M_road_1.jpg' alt='' width=180 height=180/>
						<td valign='top' style='padding-left:2px'>
			<form method='POST' action='house.php?info=road'>
				<input type='hidden' name='build' value='1'>
				<input type='hidden' name='k' value='25743'>
				<table class='default left' style='width:330px'>
			<tr><th>Текущий уровень: <?=$row['road'];?>
			<tr><td>&bull; Поиск по окрестностям <b><?=$row['road'];?></b> уровня и ниже. <br />&bull; Шанс <b><?php if ($row['road'] == 10) {echo 15;} else {echo $row['road']+1;} ?>%</b> отменить бонусы Ограды противника.
			<?php
			if ($row['road'] < 10)
			{
			?>
			<tr><th>Следующий уровень: <?=$row['road']+1;?>
			<tr><td>&bull; Поиск по окрестностям <b><?=$row['road']+1;?></b> уровня и ниже. <br />&bull; Шанс <b><?=$row['road']+2;?>%</b> отменить бонусы Ограды противника.
			<tr><th class='center'><b>Цена: <?=$road_cost;?> <img src='/images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'></b>
						<tr><td class='center'><input type='image' name='cmd' class='image cmd' src='images/RU/buttons/b_upgrade_p.png' alt='Улучшить'
					onMouseOver="doImage(this,'RU/buttons/b_upgrade',null)"/ >
			<? } ?>
			</table>
				</form>
			</table></div></div></div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div></div>	</td></tr>