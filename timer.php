<?php
include ("top_tpl.php");

if ($work['id'] == '') {
	echo "<script>location.href='game.php';</script>";
	exit;
}

if ($_POST['abort'] == 1) {
	count_query("DELETE FROM `action` WHERE `uid` = '".$row['id_user']."'");
	echo "<script>location.href='timer.php';</script>";
	exit;
}

if ($work['model'] == 3)
{
	loca('mine.php?a=open');
}

if ($work['model'] == 1)
{
?>
      <tr>
        <td height="750" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class='blockHead'><img src='images/RU/titles/h_farm.png' alt='�����' /></div>
			
		<div class='contentBlock' id='contentBlock'>	<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'><div class='content'><div class='b2'><img src='images/farm.jpg' alt='�����' width='504' height='200'></div></div></div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div><br />	<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'><div class='content'><div class='b2'><div style='width:90%'>�� ��������� �������� �� ����� �� ���������� ��� ��������������� ������ � �������� ���������� � ��� ������� ����������� �������� ����� ����� � ����� �� ����� ��������, ��� ������� ��� �������� �������������.<br><br>�� ���� ������������� ������ �� ������� �������� �� ����� �� �������� ���� ������ �������� �� ��������� �������:</div><br />
<?php } else if ($work['model'] == 2) { ?>
<tr>
        <td height="750" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class='blockHead'><img src='images/RU/titles/h_dozor.png' alt='�������' /></div>
			
		<div class='contentBlock' id='contentBlock'>	<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'><div class='content'><div class='b2'><img src='images/dozor1_1.gif' alt=' ' width='504' height='200'></div></div></div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div><br />	<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'><div class='content'><div class='b2'><div class='blockText'>�� ������ ������. ��-������� ������. ������ �� �� � ���������, ��������� � �����������,
			 ������ �������� �� ����� ��� ��� ����������, ���������� �� ����� � ������� �� ��������� �������:<br /><br /><br />
<?php } ?>
<span class='text_main_5'><div id="bx0" class="z" style="text-align:center"><b>---</b></div></span>
			<script type="text/javascript">v=new Date();var bx0=document.getElementById('bx0');function tbx0(){n=new Date();s=<?=$delta;?>-Math.round((n.getTime()-v.getTime())/1000.);m=0;h=0;if(s<0){bx0.innerHTML='---';document.location=document.location;}else{if(s>59){m=Math.floor(s/60); s=s-m*60}if(m>59){h=Math.floor(m/60);m=m-h*60} if(s<10){s="0"+s}if(m<10){m="0"+m}bx0.innerHTML=" "+h+":"+m+":"+s+'';document.title=h+':'+m+':'+s+' �����';window.setTimeout("tbx0();",999);}}tbx0();</script>
	<br><br />
<table>
<br />
<?php if ($work['model'] != 2) {?>
<form method='post' class='inline' action='timer.php'>
<input type="hidden" name="abort" value="1">
<input type='image' name='submit' class='image cmd' src='images/RU/b_endwork_p.png' alt='�������� ������' onMouseOver="doImage(this,'RU/b_endwork',null)"/ >
</form>
<?php } ?>
</table>
</div>
</div></div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
<?php include ("footer_tpl.php");?>