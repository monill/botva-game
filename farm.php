<?php
include ("top_tpl.php");

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

if (lvl($row['exp']) <= 2) {
	$gold=40;
	$goldn = 80;
} else if (lvl($row['exp']) > 2 AND lvl($row['exp']) <= 6) {
	$gold=80;
	$goldn = 160;
} else if (lvl($row['exp']) > 6 AND lvl($row['exp']) <= 14) {
	$gold=160;
	$goldn = 320;
} else if (lvl($row['exp']) > 14 AND lvl($row['exp']) <= 30) {
	$gold=320;
}

if (isset($_POST['do']) AND $_POST['work']<=8 AND $_POST['work']>=1) {
	$hours  = $_POST['work'];
	$method = $_POST['work'];
	$hours  = time()+$hours*3600;
	count_query("INSERT INTO `action` (`uid`, `model`, `speed`, `timer`) VALUES ('".$row['id_user']."','1', '".$method."','".$hours."')");
	echo "<script>location.href='timer.php';</script>";
	exit;
}
?>
      <tr>
        <td height="750" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class='blockHead'><img src='images/RU/titles/h_farm.png' alt='�����' /></div>
			
		<div class='contentBlock' id='contentBlock'>

	<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'><div class='content'><div class='b2'>
	<img src='images/farm.jpg' alt='' class='part_logo' />
</div></div></div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
			<style type="text/css">
	#work, #work_manager {
		width:80px;
		text-align:center;
	}
</style>
<table class='up_avatar'><tr><td class='avatar' rowspan='2'><img src='images/farm_man.jpg' alt='������ ��������'>	</td><td>	<div class='inputGroup inputSmall inputNoHeight ' >
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1' >
			<div class='content' ><div class='title'>������ ��������</div><div class='body'>
	�� ������� ������?<br><br>�� ����� �� ������ �������� ��� <b>�������� ��������� ������</b> �� <?=$gold;?> <img src='/images/ico_gold1.png' alt='������' align='absmiddle' class='png'> � ���.<br><br>����� �� ����������
		7 -�� ������, ������� �������� ��� <b>������� �� ������� �������</b> �� <?=$goldn;?> <img src='/images/ico_gold1.png' alt='������' align='absmiddle' class='png'> � ���.

	</div></div>
		</div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
</td></tr>
		<tr><td><form action="" method="post">
<table width="324" height="40" border="0" cellpadding="0" cellspacing="0">
<tr><td height="25" colspan="3" align="center" valign="middle"><span class="text_main_4">���� ���������:</span><span class="text_main_5">�������� ������</span></td></tr>
<tr>
	<td width="124" height="25" align="center" valign="middle"><span class="text_main_4">����� ������:</span></td>
	<td width="100"><select name='work' class='field select_work' id='work' style='width:70;text-align:center;'><option value='1' selected>1 ���</option><option value='2'>2 ����</option><option value='3'>3 ����</option><option value='4'>4 ����</option><option value='5'>5 �����</option><option value='6'>6 �����</option><option value='7'>7 �����</option><option value='8'>8 �����</option></select></td>
	<td width="100">
<input type='hidden' name='do'>
<input type='image' name='cmd' class='image ' src='images/RU/b_work_p.png' alt='��������' onMouseOver="doImage(this,'RU/b_work',null)"/ >
					</td>
</tr>
</table></form></td>
		</table></div>	</td></tr>
<?php include ("footer_tpl.php"); ?>