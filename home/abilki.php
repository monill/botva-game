<?php
$inf = $_GET["info2"];

if ($row['woodoo'] > 0)
{
	$t = "��������� ��: ".date('j.m.Y H:i', $row['woodoo']);
}
if ($row['woodoo2'] > 0)
{
	$t2 = "��������� ��: ".date('j.m.Y H:i', $row['woodoo2']);
}
if ($row['woodoo3'] > 0)
{
	$t3 = "��������� ��: ".date('j.m.Y H:i', $row['woodoo3']);
}
if ($row['woodoo4'] > 0)
{
	$t4 = "��������� ��: ".date('j.m.Y H:i', $row['woodoo4']);
}

$per_gold = round(($row['gold']*85)/100);
$per_kryst = round(($row['krystal']*85)/100);
if (($row['gold']-$per_gold) < 0)
{
	$p = 0;
}
else
{
	$p = $row['gold']-$per_gold;
}
if (($row['krystal']-$per_kryst) < 0)
{
	$p2 = 0;
}
else
{
	$p2 = $row['krystal']-$per_kryst;
}

$desc1 = '<tr>
        <td height="750" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class="blockHead"><img src="images/RU/titles/h_home_safe.png" alt="����" /></div>
			
		<div class="contentBlock" id="contentBlock"><a href="house.php" class="back"><img src="images/RU/b_back_p.png" alt="�����" class="cmd"
								onMouseOver="doImage(this,"RU/b_back")" /></a>
		<div class="box_wrap" id="help_25">
			<div onclick="showBox("help_25")" class="box_title title_show" id="t_help_25">������</div>
			<div id="b_help_25" class="box_body shown"><div class="left">���� ��������� ����� ������ �� ���������. ��� ������, ��� ��������� ����� ������ � ���� ������� ������ �� ���� ���������� ������, ������� � ���� �� �����������. ���� �������� � 14 ����. ��� ������ ��������� ����� � ���� ��������� ������������ 14 ����</div></div>
		</div>
			<div class="inputGroup inputSmall inputNoHeight" >
		<div class="top"><div class="top1"><div class="top2"></div></div></div>

		<div class="c1" >
			<div class="content" ><div class="title">����</div><div class="body"><center><br />
� ��� �� ����� '.$row['gold'].' <img src="/images/ico_gold1.png" alt="������" align="absmiddle"><br />
���� ��������� '.$per_gold.' <img src="/images/ico_gold1.png" alt="������" align="absmiddle"><br />
������������ ����� ���������� '.$p.'  <img src="/images/ico_gold1.png" alt="������" align="absmiddle"><br /></center></div></div>
		</div>
		<div class="down"><div class="down1"><div class="down2"></div></div></div>
	</div>
</div>	</td></tr>';
$desc2 = '<tr>
        <td height="750" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class="blockHead"><img src="images/RU/titles/h_home_safe2.png" alt="����������� ����" /></div>
			
		<div class="contentBlock" id="contentBlock"><a href="house.php" class="back"><img src="images/RU/b_back_p.png" alt="�����" class="cmd"
								onMouseOver="doImage(this,"RU/b_back")" /></a>
		<div class="box_wrap" id="help_25">
			<div onclick="showBox("help_25")" class="box_title title_show" id="t_help_25">������</div>
			<div id="b_help_25" class="box_body shown"><div class="left">����������� ���� ��������� ����� ���������� �� ���������. ��� ������, ��� ��������� ����� ������ � ���� ������� ������ �� ���� ���������� ����������, ������� � ���� �� ����������� ���� �������� � 14 ����. ��� ������ ��������� ����� � ���� ��������� ������������ 14 ����.</div></div>
		</div>
			<div class="inputGroup inputSmall inputNoHeight" >
		<div class="top"><div class="top1"><div class="top2"></div></div></div>

		<div class="c1" >
			<div class="content" ><div class="title">����������� ����</div><div class="body"><center><br />
� ��� �� ����� '.$row['krystal'].' <img src="/images/ico_krist1.png" alt="���������" align="absmiddle"><br />
����������� ���� ��������� '.$per_kryst.' <img src="/images/ico_krist1.png" alt="���������" align="absmiddle"><br />
������������ ����� ���������� '.$p2.' <img src="/images/ico_krist1.png" alt="���������" align="absmiddle"><br />
</center></div></div>
		</div>
		<div class="down"><div class="down1"><div class="down2"></div></div></div>
	</div>
</div>	</td></tr>';
$desc3 = '<tr>
        <td height="750" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class="blockHead"><img src="images/RU/titles/h_home_safe3.png" alt="������� ����" /></div>
			
		<div class="contentBlock" id="contentBlock"><a href="house.php" class="back"><img src="images/RU/b_back_p.png" alt="�����" class="cmd"
								onMouseOver="doImage(this,"RU/b_back")" /></a>
		<div class="box_wrap" id="help_25">
			<div onclick="showBox("help_25")" class="box_title title_show" id="t_help_25">������</div>
			<div id="b_help_25" class="box_body shown"><div class="left">������� ����, ��� ��������� �������� �����. ������� ���� ��������� �� ��������� 80% �� ���������� ������ �� ����� �����, ������� �� ���������� � ������� ����. ��� ������, ��� ��������� ����� ������ � ���� ������� ������ �� ���� ���������� ������, ������� � ������� � ������� ���� �� �����������.<br /><br />
������������ ������� ���� ����� ������ ����� ��������� �����. ���� � ��� ����������� �������� �����, �� ������� ���� ����� �� ���������. ��� ���� ���� ��������� ���������� ���� � ����������� ������� �� ���������� ����� ������.<br /><br />
���� �������� � 14 ����. ��� ������ ��������� ����� � ���� ��������� ������������ 14 ����.<br /><br />
�����������: ��������� �������� ����� �������� ������ ��� ����������, ��� ������� 25 � ����.<br />
</div></div>
		</div>
			<div class="inputGroup inputSmall inputNoHeight" >
		<div class="top"><div class="top1"><div class="top2"></div></div></div>

		<div class="c1" >
			<div class="content" ><div class="title">������� ����</div><div class="body"><center><br />
� ��� �� ����� '.$row['gold'].' <img src="/images/ico_gold1.png" alt="������" align="absmiddle"><br />
���� ��������� 1920 <img src="/images/ico_gold1.png" alt="������" align="absmiddle"><br />
������� ���� ��������� 0 <img src="/images/ico_gold1.png" alt="������" align="absmiddle"><br />
������������ ����� ���������� 0  <img src="/images/ico_gold1.png" alt="������" align="absmiddle"></center></div></div>
		</div>
		<div class="down"><div class="down1"><div class="down2"></div></div></div>
	</div>
</div>	</td></tr>';
$desc4 = '<tr>
        <td height="750" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class="blockHead"><img src="images/RU/titles/h_home_safe4.png" alt="���������� ����������� ����" /></div>
			
		<div class="contentBlock" id="contentBlock"><a href="house.php" class="back"><img src="images/RU/b_back_p.png" alt="�����" class="cmd"
								onMouseOver="doImage(this,"RU/b_back")" /></a>
		<div class="box_wrap" id="help_25">
			<div onclick="showBox("help_25")" class="box_title title_show" id="t_help_25">������</div>
			<div id="b_help_25" class="box_body shown"><div class="left">���������� ����������� ����, ��� ��������� ������������ �����. ���������� ����������� ���� ��������� �� ��������� 80% �� ���������� ���������� �� ����� �����, ������� �� ���������� � ����������� ����. ��� ������, ��� ��������� ����� ������ � ���� ������� ������ �� ���� ���������� ����������, ������� � ����������� � ���������� ����������� ���� �� �����������.<br />
������������ ���������� ����������� ���� ����� ������ ����� ��������� ������������ �����. ���� � ��� ����������� �������� ������������ �����, �� ���������� ����������� ���� ����� �� ���������. ��� ���� ���� ��������� ���������� ���� � ����������� ������� �� ���������� ����� ������.<br />
���� �������� � 14 ����. ��� ������ ��������� ����� � ���� ��������� ������������ 14 ����.<br /><br />
�����������: ��������� ����������� �������� �������� ������ ��� ����������, ��� ������� 25 � ����.<br /><br />
���������� �����������: ������ 50% ��������� � ���� ���������� ��� ������ �� ������� ��������. ��������, ���� �� �������� � ������� �������� � �� ��� ����� ��������� � ������, ��������, 10 ����������, �� ���� �� ������� ������ 5 ����������, � ��� 5 ���������� ������� ���� ����. <br />
������ ������ �� �������� ��� ��������� �������� ���� �� �����.
</div></div>
		</div>
			<div class="inputGroup inputSmall inputNoHeight" >
		<div class="top"><div class="top1"><div class="top2"></div></div></div>

		<div class="c1" >
			<div class="content" ><div class="title">���������� ����������� ����</div><div class="body"><center><br />
� ��� �� ����� '.$row['krystal'].' <img src="/images/ico_krist1.png" alt="���������" align="absmiddle"><br />
����������� ���� ��������� 5 <img src="/images/ico_krist1.png" alt="���������" align="absmiddle"><br />
���������� ����������� ���� ��������� 0 <img src="/images/ico_krist1.png" alt="���������" align="absmiddle"><br />
������������ ����� ���������� 0 <img src="/images/ico_krist1.png" alt="���������" align="absmiddle"><br />
</center></div></div>
		</div>
		<div class="down"><div class="down1"><div class="down2"></div></div></div>
	</div>
</div>	</td></tr>';
$desc5 = '<tr>
        <td height="750" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class="blockHead"><img src="images/RU/titles/h_home_woodoo.png" alt="����� ����" /></div>
			
		<div class="contentBlock" id="contentBlock"><a href="house.php" class="back"><img src="images/RU/b_back_p.png" alt="�����" class="cmd"
								onMouseOver="doImage(this,"RU/b_back")" /></a>
		<div class="box_wrap" id="help_25">
			<div onclick="showBox("help_25")" class="box_title title_show" id="t_help_25">������</div>
			<div id="b_help_25" class="box_body shown"><div class="left">����� ���� ����������� ���� ���� �� 30%, �� ������ ��� �����	����� �� ����������.<br /><br />���� �������� �� ����, �� ����������� � ���� ���. ���� �������� � 28 ����. <br /><br /> ��� ������ ��������� ����� ���� � ���� ��������� ������������ 28 ����. </div></div>
		</div>
			<div class="inputGroup inputSmall inputNoHeight" >
		<div class="top"><div class="top1"><div class="top2"></div></div></div>

		<div class="c1" >
			<div class="content" ><div class="title">����� ����</div><div class="body"><center>'.$t.'</center></div></div>
		</div>
		<div class="down"><div class="down1"><div class="down2"></div></div></div>
	</div>
</div>	</td></tr>';
$desc6 = '<tr>
        <td height="750" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class="blockHead"><img src="images/RU/titles/h_home_woodoo2.png" alt="���� ����" /></div>
			
		<div class="contentBlock" id="contentBlock"><a href="house.php" class="back"><img src="images/RU/b_back_p.png" alt="�����" class="cmd"
								onMouseOver="doImage(this,"RU/b_back")" /></a>
		<div class="box_wrap" id="help_25">
			<div onclick="showBox("help_25")" class="box_title title_show" id="t_help_25">������</div>
			<div id="b_help_25" class="box_body shown"><div class="left">���� ���� ����������� ���� ���� �� 30%, �� ������ ��� ����� �� ����. ��� ������, ��� ������� ������ ���� � ������ ����, �� ��������� ���������� �������� � ����. ���� �������� �28 ����. ��� ������ ��������� ����� ���� � ���� ��������� ������������ 28 ����.</div></div>
		</div>
			<div class="inputGroup inputSmall inputNoHeight" >
		<div class="top"><div class="top1"><div class="top2"></div></div></div>

		<div class="c1" >
			<div class="content" ><div class="title">���� ����</div><div class="body"><center>'.$t2.'</center></div></div>
		</div>
		<div class="down"><div class="down1"><div class="down2"></div></div></div>
	</div>
</div>	</td></tr>';
$desc7 = '<tr>
        <td height="750" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class="blockHead"><img src="images/RU/titles/h_home_totem.png" alt="��������� �����" /></div>
			
		<div class="contentBlock" id="contentBlock"><a href="house.php" class="back"><img src="images/RU/b_back_p.png" alt="�����" class="cmd"
								onMouseOver="doImage(this,"RU/b_back")" /></a>
		<div class="box_wrap" id="help_25">
			<div onclick="showBox("help_25")" class="box_title title_show" id="t_help_25">������</div>
			<div id="b_help_25" class="box_body shown"><div class="left">��������� ����� ����������� ���� ������ �� 30%, �� ������ ��� ����� ���������� �� ����.<br /><br />���� ��������� �� ����-�� ��, �� ����������� � ������ ���. ���� �������� � 28 ����. ��� ������ ��������� ���������� ������ � ���� ��������� ������������ 28 ���� </div></div>
		</div>
			<div class="inputGroup inputSmall inputNoHeight" >
		<div class="top"><div class="top1"><div class="top2"></div></div></div>

		<div class="c1" >
			<div class="content" ><div class="title">��������� �����</div><div class="body"><center>'.$t3.'</center></div></div>
		</div>
		<div class="down"><div class="down1"><div class="down2"></div></div></div>
	</div>
</div>	</td></tr>';
$desc8 = '<tr>
        <td height="750" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class="blockHead"><img src="images/RU/titles/h_home_totem2.png" alt="������� �����" /></div>
			
		<div class="contentBlock" id="contentBlock"><a href="house.php" class="back"><img src="images/RU/b_back_p.png" alt="�����" class="cmd"
								onMouseOver="doImage(this,"RU/b_back")" /></a>
		<div class="box_wrap" id="help_25">
			<div onclick="showBox("help_25")" class="box_title title_show" id="t_help_25">������</div>
			<div id="b_help_25" class="box_body shown"><div class="left">������� ����� ����������� ���� ������ �� 30%, �� ������ ��� ����� ����� �� ����������.<br /><br /> ��� ������, ��� ������� ��������� � ������� ��������, �� ��������� ���������� �������� � ������. ���� �������� � 28 ����. ��� ������ ��������� �������� ������ � ���� ��������� ������������ 28 ����</div></div>
		</div>
			<div class="inputGroup inputSmall inputNoHeight" >
		<div class="top"><div class="top1"><div class="top2"></div></div></div>

		<div class="c1" >
			<div class="content" ><div class="title">������� �����</div><div class="body"><center>'.$t4.'</center></div></div>
		</div>
		<div class="down"><div class="down1"><div class="down2"></div></div></div>
	</div>
</div>	</td></tr>';

switch ($inf)
{
	case "safe": echo $desc1; break;
	case "safe2": echo $desc2; break;
	case "safe3": echo $desc3; break;
	case "safe4": echo $desc4; break;
	case "woodoo": echo $desc5; break;
	case "woodoo2": echo $desc6; break;
	case "totem": echo $desc7; break;
	case "totem2": echo $desc8; break;
}
?>