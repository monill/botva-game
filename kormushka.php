<?php
include ("top_tpl.php");

if ($row['vip'] > 0)
{
	$vips = "<center><b class='text_main_1'>��� ������� ������� ��: ".date('d.m.Y H:s', $row['vip'])."</b></center><br /><a href='kormushka.php?activate=1' ><img src='images/RU/b_prodl_p.png' alt='��������' class='cmd' onMouseOver=\"doImage(this,'RU/b_prodl','skip')\" /></a>";
}
else
{
	$vips = "<center><b class='text_main_1'>������� �� �����������</b></center><br /><a href='kormushka.php?activate=1' ><img src='images/RU/b_aktiv_p.png' alt='������������' class='cmd' onMouseOver=\"doImage(this,'RU/b_aktiv','skip')\" /></a>";
}

$act = $_GET['activate'];

if (isset($act) && $act == 1)
{
	if ($row['zelen'] >= '22')
	{
		if($row['vip']>time())
		{
			$time=$row['vip']+1209600;
		}
		else
		{
			$time=time()+1209600;
		}
		count_query("UPDATE users SET `gold`=`gold`+'480', `zelen`=`zelen`-'22', time_dozor='240', vip='".$time."' WHERE email='".$_SESSION['email']."'");
		count_query("INSERT INTO items_p(model,uid,item_num,stat,vol) VALUES ('1','".$row['id_user']."','3', 'off','1')");
		echo "<script>location.href='kormushka.php';</script>";
	}
	else
	{
		$err = "<div class='message'>�� ������� �����</div>";
	}
}
?>
      <tr>
        <td height="750" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class='blockHead'><img src='images/RU/titles/h_jeweller.png' alt='��������' /></div>
			
		<div class='contentBlock' id='contentBlock'><table class='up_avatar'><tr><td class='avatar'><img src='images/RU/for_premium.png' alt='��� ������ ����� ������?'>	</td><td>	<div class='inputGroup inputSmall ' >
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1' style='height:210px !important'>
			<div class='content' ><div class='title'>��� ������ ����� ������?</div><div class='body'><ul class='left'>
<li>��� �������� ����� � ���� 480 <img src='/images/ico_gold1.png' alt='������' align='absmiddle' class='png'><br />
<li>��� �������� ��������� ��������� <img src='images/ico_red.png' alt='������� ������' align='absmiddle'> *<br />
<li>��� ������ ������ �� ����� ������ 5 �����.<br />
<li>��� 4 ���� � ���� ������ � �����.<br />
<li>��� ������� ��� ���������� �������.<br />
</ul><center><b class='center text_main_2'>14 ���� �� 22 <img src='/images/ico_green1.png' alt='������' align='absmiddle' class='png'>  </b></center>
<br />
<span style='font-size:80%'>* <img src='images/ico_red.png' alt='������� ������' align='absmiddle'> �������� ������ � ��� ������, ���� � ��� ���� ��������� ����� ��� �������.</span><style>
ul{	padding-left:20px;}
ul li{	line-height:20px;}
</style>
</div></div>
		</div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
</td></tr></table><br /><?=$err;?>	<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'><div class='content'><div class='b2'><?=$vips;?></div></div></div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>������� ����� ���������� � ����� ������ � �������������� ���-�� ���.<br /><br />	<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'><div class='content'><div class='b2'><center style='line-height:30px' class='text_main_1'>��������� ������</center>
<table class='default row_3'>
<tr><td width=60><img src='images/ico_green2.png' alt='��������� ������' width='65' height='65'>
	<td>��� ������� ���������� ������������ � ����� ��������.<br /><br />
����������� ������ - ������������ �������, ������� ������ �������� ����� ������ ������� �� ������� �����.
	<td><a href='buy.php' ><img src='images/RU/b_market_buy_p.png' alt='������' class='cmd'
								onMouseOver="doImage(this,'RU/b_market_buy')" /></a>
</table></div></div></div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div></div>	</td></tr>
<?php include ("footer_tpl.php"); ?>	