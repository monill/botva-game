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

switch ($row['house'])
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
		if ($row['house'] < 10)
		{
			if ($row['gold'] >= $house_cost)
			{
				count_query("UPDATE `users` SET `gold`=`gold`-'".$house_cost."', `house`=`house`+'1' WHERE `id_user` = '".$row['id_user']."'") or die("Invalid query: " . mysql_error());
				echo "<script>location.href='?info=home';</script>";
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
<div class='blockHead'><img src='images/RU/titles/h_home_home.png' alt='������' /></div>
			
		<div class='contentBlock' id='contentBlock'><a href='house.php' class='back'><img src='images/RU/b_back_p.png' alt='�����' class='cmd'
								onMouseOver="doImage(this,'RU/b_back')" /></a>
		<div class='box_wrap' id='help_25'>
			<div onclick="showBox('help_25')" class='box_title title_show' id='t_help_25'>������</div>
			<div id='b_help_25' class='box_body shown'><div class='left'>
���������� �� ������ 2 ����� ��� ����� �����, ������� �������� � ��������� ���������. �� ������ ������� ������ � ��� ����������� �������������� ���� ��� �����, ��� ���� �� 3, 7 � 10 ������ ������ �� �������� +2 ����� ��� �����.<br />
���������� �� ������ ����� �������� �� 2 �������, ������� �������� � ��� � ��������� �������. �� ������ ������� ������ � ��� ����������� �������������� ���� ��� ������ �������, ��� ���� �� 3, 7 � 10 ������ ������ �� �������� +2 ����� ��� ������ �������.<br />
<table class='default center' style='width:510px'>
	<tr><th width='100'>�������<th>���-�� ������	<th>����. ���-�� �������<th width='100'>���� ���������
	<tr <?=$metka0;?>><td> 0	<td>2<td>2<td>5 <img src='/images/ico_gold1.png' alt='������' align='absmiddle' class='png'>
	<tr <?=$metka1;?>><td> 1	<td>3<td>3<td>25 <img src='/images/ico_gold1.png' alt='������' align='absmiddle' class='png'>
	<tr <?=$metka2;?>><td> 2	<td>4<td>4<td>125 <img src='/images/ico_gold1.png' alt='������' align='absmiddle' class='png'>
	<tr <?=$metka3;?>><td> 3	<td>6<td>6<td>625 <img src='/images/ico_gold1.png' alt='������' align='absmiddle' class='png'>
	<tr <?=$metka4;?>><td> 4	<td>7<td>7<td>3125 <img src='/images/ico_gold1.png' alt='������' align='absmiddle' class='png'>
	<tr <?=$metka5;?>><td> 5	<td>8<td>8<td>15625 <img src='/images/ico_gold1.png' alt='������' align='absmiddle' class='png'>
	<tr <?=$metka6;?>><td> 6	<td>9<td>9<td>78125 <img src='/images/ico_gold1.png' alt='������' align='absmiddle' class='png'>
	<tr <?=$metka7;?>><td> 7	<td>11<td>11<td>390625 <img src='/images/ico_gold1.png' alt='������' align='absmiddle' class='png'>
	<tr <?=$metka8;?>><td> 8	<td>12<td>12<td>1953125 <img src='/images/ico_gold1.png' alt='������' align='absmiddle' class='png'>
	<tr <?=$metka9;?>><td> 9	<td>13<td>13<td>9765625 <img src='/images/ico_gold1.png' alt='������' align='absmiddle' class='png'>
	<tr <?=$metka10;?>><td> 10	<td>15<td>15<td>-</table></div></div>
		</div>
			<?=$err;?>
			<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'><div class='content'><div class='b2'><table class='default'>
					<tr><td valign='top' class='img'><img src='images/house/M_home_2.jpg' alt='' width=180 height=180/>
						<td valign='top' style='padding-left:2px'>
			<form method='POST' action='house.php?info=home'>
				<input type='hidden' name='build' value='1'>
				<table class='default left' style='width:330px'>
			<tr><th>������� �������: <?=$row['house'];?>
			<tr><td>&bull; <b><?=$row['house']+2;?></b> ������ � ��������� ���������. <br />&bull; �������:� <b><?=$row['house']+2;?></b> ��.�������� ����.
			<?php
			if ($row['house'] < 10)
			{
			?>
			<tr><th>��������� �������: <?=$row['house']+1;?>
			<tr><td>&bull; <b><?=$row['house']+3;?></b> ������ � ��������� ���������. <br />&bull; �������:� <b><?=$row['house']+3;?></b> ��.�������� ����.
			<tr><th class='center'><b>����: <?=$house_cost;?> <img src='/images/ico_gold1.png' alt='������' align='absmiddle' class='png'></b>
						<tr><td class='center'><input type='image' name='cmd' class='image cmd' src='images/RU/buttons/b_upgrade_p.png' alt='��������'
					onMouseOver="doImage(this,'RU/buttons/b_upgrade',null)"/ >
			<? } ?>
			</table>
				</form>
			</table></div></div></div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div></div>	</td></tr>