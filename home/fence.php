<?php
session_start();

##################### ����� ������ � SQL ������� ################
include_once("function/sql.php");

$stop_injection = new InitVars();
$stop_injection->checkVars();
##################### ����� ������ � SQL ������� ################

if (!isset($_SESSION['email'])) {
	echo "<script>location.href='index.php';</script>"; //���������������� � ���� 
}

switch ($row['fence'])
{
	case 0: $metka0 = "class='row_1'"; $def = 2; $per = 5; break;
	case 1: $metka1 = "class='row_1'"; $def = 4; $per = 10; break;
	case 2: $metka2 = "class='row_1'"; $def = 6; $per = 15; break;
	case 3: $metka3 = "class='row_1'"; $def = 8; $per = 20; break;
	case 4: $metka4 = "class='row_1'"; $def = 10; $per = 25; break;
	case 5: $metka5 = "class='row_1'"; $def = 12; $per = 30; break;
	case 6: $metka6 = "class='row_1'"; $def = 14; $per = 35; break;
	case 7: $metka7 = "class='row_1'"; $def = 16; $per = 40; break;
	case 8: $metka8 = "class='row_1'"; $def = 18; $per = 45; break;
	case 9: $metka9 = "class='row_1'"; $def = 20; $per = 50; break;
	case 10: $metka10 = "class='row_1'"; $def = 25; $per = 75; break;
}

if (isset($_POST['build']))
{
	if ($_POST['build'] == 1)
	{
		if ($row['fence'] < 10)
		{
			if ($row['gold'] >= $fence_cost)
			{
				count_query("UPDATE `users` SET gold=gold-'".$fence_cost."', `fence`=fence+1 WHERE `email` = '".$_SESSION['email']."'");
				echo "<script>location.href='?info=fence';</script>";
			}
			else
			{
				$err = "<div class='message'>��� �����.</div>";
			}
		}
	}
}
?>
<tr>
        <td height="750" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class='blockHead'><img src='images/RU/titles/h_home_fence.png' alt='������' /></div>
			
		<div class='contentBlock' id='contentBlock'><a href='house.php' class='back'><img src='images/RU/b_back_p.png' alt='�����' class='cmd'
								onMouseOver="doImage(this,'RU/b_back')" /></a>
		<div class='box_wrap' id='help_25'>
			<div onclick="showBox('help_25')" class='box_title title_show' id='t_help_25'>������</div>
			<div id='b_help_25' class='box_body shown'><div class='left'>
������ �������� �������� ���� ������ �� ��������� ������.<br /><br />
���������� �� ������ +2 ������� � �������������� ������� � ������ ��������� ����� �� ���. �� ������ ������� ������ �� �������� ������������� +2 ������� � �������������� �������. �������, �������, ��� �������� � ������ ��������� ������ �����, ����� �� ��� ���-���� ��������. ���� ��������� �� � �������� � ������ �� ���������. ���� �� �� ���������� � �����, � ���� � ��������� �����, �� �������� � ������ �� ������ �� ��������� ������ ��� ������, � �������� �� ������ � � ���� ������ �������� ��������� ������ �����.<br /><br />
����� ��� ��������� ������ �� 3 ������, �� �������� 1% � ������ �������� ����� �������������� �������. ��� ��������� ������ �� 7 ������, �� �������� 2,5% � ������ �������� ����� �������������� �������. ��� ��������� ������ �� 10 ������, �������� � ������ �������� ����� �������������� ������� �������� 5%.<br /><br />
���������� �� ������ 5% ���� �������� ����� ����� �������, ���������� �� ���������, �� ����� � ���� ���������� ��� � ��� ������. �� ������ ������� ������ �� �������� ������������� +5% � ������ �����.<br /><br />
<table class='default center' style='width:510px'>
	<tr><th width='100'>�������<th>������ ��� ���������	<th width='100'>���� ���������
	<tr <?=$metka0;?>><td> 0	<td>+2<td>4 <img src='/images/ico_gold1.png' alt='������' align='absmiddle' class='png'>
	<tr <?=$metka1;?>><td> 1	<td>+4<td>23 <img src='/images/ico_gold1.png' alt='������' align='absmiddle' class='png'>
	<tr <?=$metka2;?>><td> 2	<td>+6<td>110 <img src='/images/ico_gold1.png' alt='������' align='absmiddle' class='png'>
	<tr <?=$metka3;?>><td> 3	<td>+8 + 1%<td>530 <img src='/images/ico_gold1.png' alt='������' align='absmiddle' class='png'>
	<tr <?=$metka4;?>><td> 4	<td>+10 + 1%<td>2548 <img src='/images/ico_gold1.png' alt='������' align='absmiddle' class='png'>
	<tr <?=$metka5;?>><td> 5	<td>+12 + 1%<td>12230 <img src='/images/ico_gold1.png' alt='������' align='absmiddle' class='png'>
	<tr <?=$metka6;?>><td> 6	<td>+14 + 1%<td>58706 <img src='/images/ico_gold1.png' alt='������' align='absmiddle' class='png'>
	<tr <?=$metka7;?>><td> 7	<td>+16 + 2.5%<td>281792 <img src='/images/ico_gold1.png' alt='������' align='absmiddle' class='png'>
	<tr <?=$metka8;?>><td> 8	<td>+18 + 2.5%<td>1352605 <img src='/images/ico_gold1.png' alt='������' align='absmiddle' class='png'>
	<tr <?=$metka9;?>><td> 9	<td>+20 + 2.5%<td>6492506 <img src='/images/ico_gold1.png' alt='������' align='absmiddle' class='png'>
	<tr <?=$metka10;?>><td> 10	<td>+25 + 5%<td>-</table></div></div>
		</div>
			<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'><div class='content'><div class='b2'><table class='default'>
					<tr><td valign='top' class='img'><img src='images/house/M_fence_2.jpg' alt='' width=180 height=180/>
						<td valign='top' style='padding-left:2px'>
			<form method='POST' action='house.php?info=fence'>
				<input type='hidden' name='build' value='1'>
				<table class='default left' style='width:330px'>
			<tr><th>������� �������: <?=$row['fence'];?>
			<tr><td>&bull; <b>+<?=$def;?></b> � ������ �� ��������� ������. <br />&bull; +<?php if ($row['fence'] < 3) {echo 0;} else if ($row['fence'] >= 3 AND $row['fence'] < 7) {echo 1;} else if ($row['fence'] >= 7 AND $row['fence'] < 10) {echo 2,5;} else if ($row['fence'] == 10) {echo 5;}?>% � ������ �������� �������������� �������.
			<?php
			if ($row['fence'] < 10)
			{
			?>
			<tr><th>��������� �������: <?=$row['fence']+1;?>
			<tr><td>&bull; <b>+<?php if($row['fence'] == 10) {echo 25;} else {echo $def+2;} ?></b> � ������ �� ��������� ������. <br />&bull; +<?php if ($row['fence']+1 < 3) {echo 0;} else if ($row['fence']+1 > 3 AND $row['fence']+1 < 7) {echo 1;} else if ($row['fence']+1 > 7 AND $row['fence']+1 < 10) {echo 2,5;} else {echo 5;}?>% � ������ �������� �������������� �������.
			<tr><th class='center'><b>����: <?=$fence_cost;?> <img src='/images/ico_gold1.png' alt='������' align='absmiddle' class='png'></b>
						<tr><td class='center'><input type='image' name='cmd' class='image cmd' src='images/RU/buttons/b_upgrade_p.png' alt='��������'
					onMouseOver="doImage(this,'RU/buttons/b_upgrade',null)"/ >
			<? } ?>
			</table>
				</form>
			</table></div></div></div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div></div>	</td></tr>