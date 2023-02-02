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

switch ($row['out'])
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
		if ($row['out'] < 10)
		{
			if ($row['gold'] >= $out_cost)
			{
				count_query("UPDATE `users` SET gold=gold-'".$out_cost."', `out`=`out`+1 WHERE `email` = '".$_SESSION['email']."'");
				echo "<script>location.href='?info=out';</script>";
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
<div class='blockHead'><img src='images/RU/titles/h_home_out.png' alt='Местность' /></div>
			
		<div class='contentBlock' id='contentBlock'><a href='house.php' class='back'><img src='images/RU/b_back_p.png' alt='Назад' class='cmd'
								onMouseOver="doImage(this,'RU/b_back')" /></a>
		<div class='box_wrap' id='help_25'>
			<div onclick="showBox('help_25')" class='box_title title_show' id='t_help_25'>Помощь</div>
			<div id='b_help_25' class='box_body shown'><div class='left'>Повышение уровня Местности позволяет избегать атак по случайному поиску в разделе «Бодалка» некоторых соперников. Местность напрямую связана с уровнем Дорожки противника. Так, если у вас 5й уровень Местности, это означает, что вас может найти по случайному поиску только те противники, у которых уровень Дорожки равен или больше 5. В этом случае противники с уровнем Дорожки 4 и ниже никогда не найдут вас, используя случайный поиск.<br /><br />
Также при каждом повышении уровня Местности вы получаете +1% к шансу избежать нападения противника. Это означает, что противник, напав на вас, получит сообщение, что вы избежали боя. При этом его атака будет использована, и он не сможет напасть на вас в течение 2 часов. При постройке 10 уровня Местности вы получаете сразу +5% к шансу избежать боя с напавшим противником.<br />
<table class='default center' style='width:510px'>
	<tr><th width='100'>Уровень<th>Защита от уровня дорожки	<th>Шанс избежать боя<th width='100'>Цена улучшения
	<tr <?=$metka0;?>><td> 0	<td>0<td>1%<td>4 <img src='/images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'>
	<tr <?=$metka1;?>><td> 1	<td>0<td>2%<td>16 <img src='/images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'>
	<tr <?=$metka2;?>><td> 2	<td>1<td>3%<td>64 <img src='/images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'>
	<tr <?=$metka3;?>><td> 3	<td>2<td>4%<td>256 <img src='/images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'>
	<tr <?=$metka4;?>><td> 4	<td>3<td>5%<td>1024 <img src='/images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'>
	<tr <?=$metka5;?>><td> 5	<td>4<td>6%<td>4096 <img src='/images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'>
	<tr <?=$metka6;?>><td> 6	<td>5<td>7%<td>16384 <img src='/images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'>
	<tr <?=$metka7;?>><td> 7	<td>6<td>8%<td>65536 <img src='/images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'>
	<tr <?=$metka8;?>><td> 8	<td>7<td>9%<td>262144 <img src='/images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'>
	<tr <?=$metka9;?>><td> 9	<td>8<td>10%<td>1048576 <img src='/images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'>
	<tr <?=$metka10;?>><td> 10	<td>9<td>15%<td>-</table></div></div>
		</div>
			<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'><div class='content'><div class='b2'><table class='default'>
					<tr><td valign='top' class='img'><img src='images/house/M_out_2.jpg' alt='' width=180 height=180/>
						<td valign='top' style='padding-left:2px'>
			<form method='POST' action='house.php?info=out'>
				<input type='hidden' name='build' value='1'>
				<table class='default left' style='width:330px'>
			<tr><th>Текущий уровень: <?=$row['out'];?>
			<tr><td>&bull; Защита от случайного поиска врагов с дорожкой <b><?php if ($row['out'] == 0) {echo 0;} else {echo $row['out']-1;}?></b> уровня и ниже.<br />&bull; <b><?php if ($row['out'] == 10) {echo 15;} else {echo $row['out']+1;} ?>%</b> шанс избежать боя с нападающим врагом.
			<?php
			if ($row['out'] < 10)
			{
			?>
			<tr><th>Следующий уровень: <?=$row['out']+1;?>
			<tr><td>&bull; Защита от случайного поиска врагов с дорожкой <b><?php if ($row['out']+1 == 1) {echo 0;} else {echo $row['out'];}?></b> уровня и ниже.<br />&bull; <b><?=$row['out']+2;?>%</b> шанс избежать боя с нападающим врагом.
			<tr><th class='center'><b>Цена: <?=$out_cost;?> <img src='/images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'></b>
						<tr><td class='center'><input type='image' name='cmd' class='image cmd' src='images/RU/buttons/b_upgrade_p.png' alt='Улучшить'
					onMouseOver="doImage(this,'RU/buttons/b_upgrade',null)"/ >
			<? } ?>
			</table>
				</form>
			</table></div></div></div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div></div>	</td></tr>