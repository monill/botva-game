<?php
include ("top_tpl.php");

$t = $_GET['t'];
$well = array();
$well['apple'] = array('h_apple.png', '�������', 'b7_2_p.png', '<td>� �������! ���� �� ���� �������, �� ������� �������! � ���� ������ � �������� �������, � ���� �����, ���������� �������.', '<b>����� �������!</b> (��������� ����: 75 <img src=\'/images/ico_green1.png\' alt=\'������\' align=\'absmiddle\' class=\'png\'> )<br />
����� ������� ����� ������ ��������. ������ ������ � ��������� ��� ������� ��������� �������.', '<b>����� �����������!</b> (��������� ����: 75 <img src=\'/images/ico_krist1.png\' alt=\'��������\' align=\'absmiddle\' class=\'png\'> )<br />
����� ������� ����� ������ �����������. ������ ������ � ��������� ��� ������� ��������� �������.', '<input type=\'image\' name=\'h_apple\' class=\'image cmd\' src=\'images/RU/b_apple_p.png\' alt=\'�������� �������\' onMouseOver="doImage(this,\'RU/b_apple\',null)"/ >');
$well['pin'] = array('h_pin.png', '���������', 'b7_3_p.png', '<td class=\'center\'>�������� ���� ���.<br />
���������� ��� �� ������� ����������� � �������� ����� �����, ���� ��������� ������� ������ ������� ����������� ������.<br />
������������ ������ ����� ������������, ������ � ������� �����, �� ����� �� �� ��������.<br />', '<b>����� �������!</b> (��������� ����: 15 <img src=\'/images/ico_green1.png\' alt=\'������\' align=\'absmiddle\' class=\'png\'> )<br />
������������ ������, ������������, ���������� � ������� ���������. ����� ������� �������� ������ ������ �� ������, ������������ � ����� ���������.', '<b>�������� �������!</b> (����� 10% �����, ����: 1920 <img src=\'/images/ico_gold1.png\' alt=\'������\' align=\'absmiddle\' class=\'png\'>)<br />
�������������� ������. ��� ������� ���������� ���������� ���������� �������� ������. ��� ���� ���� ������ ���������� �� ������.', '<input name=\'new_name\' type=\'text\'  size=\'25\' maxlength=\'20\' value=\'\' /><br /><br /><input type=\'image\' name=\'do\' class=\'image cmd\' src=\'images/RU/b_renaming_p.png\' alt=\'������� ���\' onMouseOver="doImage(this,\'RU/b_renaming\',null)"/ >');
$well['leave_clan'] = array('h_leave_clan.png', '����� �� �����', 'b7_6_p.png', '<td>���� ���� � ��������� ���������� �����, � �� �� ������ � �� ������ ������ ���������� � ���� ����� � ������ ������ ����� ������.', '<b>���� ���������</b> (����� 10% �����, ����: 1920 <img src=\'/images/ico_gold1.png\' alt=\'������\' align=\'absmiddle\' class=\'png\'>):<br />
������ ��������� ����� ������ ����� �� ����� ������� ����� ��� �������. ������ ����� �������� �� ����� ���������.', '<b>���������� ������</b> (����: <input type=\'radio\' name=\'ptype\' value=\'1\' checked />15 <img src=\'/images/ico_krist1.png\' alt=\'��������\' align=\'absmiddle\' class=\'png\'> / <input type=\'radio\' name=\'ptype\' value=\'2\' checked2/>15 <img src=\'/images/ico_green1.png\' alt=\'������\' align=\'absmiddle\' class=\'png\'>):<br />
������ ���� ��� ��������� ��������, ������� �������� ������������� ������. ��� ������, ��� �� ������ � ��� ���� � ������� ���� �� ������� �����.', '<input type=\'image\' name=\'h_clan_leave\' class=\'image cmd\' src=\'images/RU/buttons/b_leave_p.png\' alt=\'����� �� �����\' onMouseOver="doImage(this,\'RU/buttons/b_leave\',null)"/ >');
$well['leave_guild'] = array('h_leave_guild.png', '�������� �������', 'b7_8_p.png', '<td>���� ������� ��� ������ �� ���������� � ������ ������ ����� ������. ������� - �������, ��� � ������ ����������� � �������, ��� ����� ����� �������� �������, ������, ���, �� �����������. <br /><b> ����� - ����������� ����� � ������� ����� ������!</b>', '<b>�������� �������</b> (����� 20% �����, ����: 12800 <img src=\'/images/ico_gold1.png\' alt=\'������\' align=\'absmiddle\' class=\'png\'> ):<br />
������ ������������ �������, ���������� �������� �� �����������. ��� �������� �� ������� � ��� ������ �������� �� ����� ���������.', '<b>���� ������</b> (����: <input type=\'radio\' name=\'ptype\' value=\'1\' checked />150 <img src=\'/images/ico_krist1.png\' alt=\'��������\' align=\'absmiddle\' class=\'png\'> / <input type=\'radio\' name=\'ptype\' value=\'2\' checked2/>150 <img src=\'/images/ico_green1.png\' alt=\'������\' align=\'absmiddle\' class=\'png\'> ):<br />
������ ������� ������ ���� ������ ����� �������, ������� �������� ��������� � ����� ����� �� ������� �� ����� ������������ ��������.', '<input type=\'image\' name=\'h_wguild\' class=\'image cmd\' src=\'images/RU/buttons/b_wguild_p.png\' alt=\'�������� �������\' onMouseOver="doImage(this,\'RU/buttons/b_wguild\',null)"/ >');

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
		case 1: //����� �������
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
						$err = "<div class='message'>��� ������ ���� �� �����</div>";
					}
					else
					{
						$err = "<div class='message'>�� ������� ������</div>";
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
						$err = "<div class='message'>��� ������ ���� �� �����</div>";
					}
					else
					{
						$err = "<div class='message'>�� ������� ���������</div>";
					};
					break;
			}
			break;
		case 2: //������� ���
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
							$err = "<div class='message'>�� ������� ������</div>";
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
							$err = "<div class='message'>�� ������� ������</div>";
						}
						break;
				}
			}
			break;
		case 3: //���� �� �����
			if ($row['clan'] > 0)
			{
				switch ($_POST['radio'])
				{
					case "price1": 
						if ($row['gold'] >= 1920)
						{
							count_query("UPDATE `users` SET gold=gold-'1920', clan='0', clan_stat='���������' WHERE id_user='".$_SESSION['id']."'");
						}
						else
						{
							$err = "<div class='message'>�� ������� ������</div>";
						}
						break;
					case "price2":
						switch ($_POST['ptype'])
						{
							case 1: $m = 'krystal'; $mt = '���������'; break;
							case 2: $m = 'zelen'; $mt = '������'; break;
						}
						if ($row[$m] >= 15)
						{
							count_query("UPDATE `users` SET ".$m."=".$m."-'15', clan='0', clan_stat='���������' WHERE id_user='".$_SESSION['id']."'");
						}
						else
						{
							$err = "<div class='message'>�� ������� ".$mt."</div>";
						}
						break;
				}
			}
			else
			{
				$err = "<div class='message'>�� �� � �����, ������ ������� ��������-�� ?</div>";
			}
			break;
		case 4: //�������� �������
			$err = "� ����������";
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
			
		<div class='contentBlock' id='contentBlock'><a href='well.php' class='back'><img src='images/RU/b_back_p.png' alt='�����' class='cmd'
								onMouseOver="doImage(this,'RU/b_back')" /></a><br /><br /><?php if ($t == 4) echo "<div class='message'>�� �� � �������, ������ ������� ��������-�� ?</div>"; ?><?=$err;?>	<div class='inputGroup'>
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
<div class='blockHead'><img src='images/RU/titles/h_witch.png' alt='�������' /></div>
			
		<div class='contentBlock' id='contentBlock'><table class='up_avatar'><tr><td class='avatar'><img src='images/witch_man.jpg' alt='������'>	</td><td>	<div class='inputGroup inputSmall  ' >
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1' style='height:180px !important'>
			<div class='content' ><div class='title'>������</div><div class='body'>���-���, ��� ���� ��������.<br /><br />
�� ��� ��, �������, �� ����� �� ���� ����. �� ��������� �� ����, �� ��� ��, ��������, ������ � ����, ��� ��� �������� �� �����. �� ���� �� �� ����, �� ������� ������, ��� ���� � ��������, �� � ����� � ����� �����.
� ���� �� ������, ����� � ���� ���� ����������, ����� ���� � ������.<br /><br />
�� ������� �� ����� � �� ������� ����� ��� ���� ��������. � ���� �� ���������� �� ��� �� ������ � �� ���� ���� � ����.</div></div>
		</div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
</td></tr></table>	<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'><div class='content'><div class='b2'><table class='default' style='margin:0 5px;width:500px;'><tr class='row_5'>
				<td style='width:100px' class='top'><a href='well.php?t=1'><img src='images/b7_2_p.png' id='img1'	onmouseover="doImageHover(1);" onmouseout='doImageHover(1,false);' ></a>
				<td class='center text_main_4'>
� ������� �� �� �������. �������, �� ��������. �� ������ ���� ����, ��������, ������� ��.<br />
� ���� ��� ��������� �����, � ���� �� ���� �����, � ���� �� � ���� � ������������ ��� ��, �����, ������� ���� ���������, ��� ����.<br /><br /><a href='well.php?t=1' ><img src='images/RU/b_change2_p.png' alt='������� �������' class='cmd'
								onMouseOver="doImage(this,'RU/b_change2','skip')" /></a><br /><tr class='row_5'>
				<td style='width:100px' class='top'><a href='well.php?t=2'><img src='images/b7_3_p.png' id='img2'	onmouseover="doImageHover(2);" onmouseout='doImageHover(2,false);' ></a>
				<td class='center text_main_4'>��������� ���� �� ������� �����, ������ ��� ��� � ������ �����. � ������ ������ � ��� ��� ��������, ������� �����-������ ����������.<br />���� ���� ������� � ��� ����� �� ���� ��������� ��� ������. �����.<br /><br /><a href='well.php?t=2' ><img src='images/RU/b_change1_p.png' alt='������� ���' class='cmd'
								onMouseOver="doImage(this,'RU/b_change1','skip')" /></a><br /><tr class='row_5'>
				<td style='width:100px' class='top'><a href='well.php?t=3'><img src='images/b7_6_p.png' id='img3'	onmouseover="doImageHover(3);" onmouseout='doImageHover(3,false);' ></a>
				<td class='center text_main_4'>���� � ����� ���������� ������ ����������, � ������ �� ������, ���� ������������. � ������, ���� �����, ������ �� ������, � �������, ���� �����, ��������� �����. ���� ������������ ������ ������, �������� ���� ������ � ��� ������.<br /><br /><a href='well.php?t=3' ><img src='images/RU/buttons/b_leave_p.png' alt='���� �� �����' class='cmd'
								onMouseOver="doImage(this,'RU/buttons/b_leave','skip')" /></a><br /><tr class='row_5'>
				<td style='width:100px' class='top'><a href='well.php?t=4'><img src='images/b7_8_p.png' id='img5'	onmouseover="doImageHover(5);" onmouseout='doImageHover(5,false);' ></a>
				<td class='center text_main_4'>���� �� ������� �� ���-�� �����, �� ���� ����� ������� ������. ��������� ��, ��� �� � ������ ������, ��� ������ �������� - �� ����� �����. ���� ���������, ��� ������� �� - ������, � ������� ����� � ������ ����.<br /><br /><a href='well.php?t=4' ><img src='images/RU/buttons/b_wguild_p.png' alt='�������� �������' class='cmd'
								onMouseOver="doImage(this,'RU/buttons/b_wguild','skip')" /></a><br /></table></div></div></div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div></div>	</td></tr>
<?php
}
include ("footer_tpl.php");
?>