<?php
include ('top_tpl.php');

if (lvl($row['exp']) < 5)
{
?>
<tr>
        <td height="750" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class='blockHead'><img src='images/RU/titles/h_tavern.png' alt='�������' /></div>
			
		<div class='contentBlock' id='contentBlock'>
<a href='village.php' class='back'><img src='images/RU/b_back_p.png' alt='�����' class='cmd'
								onMouseOver="doImage(this,'RU/b_back')" /></a><div class='message'>��� ��� �� ����� ������ ������, �������, ��� ������� 5 �������</div></div>	</td></tr>
<?
}
else
{
/********
* ����� *
********/
$kostiN = "<tr>
        <td height='750' width='574' align='center' valign='top' background='images/site_01_07.png' bgcolor='#EBDBC1'>
<div class='blockHead'><img src='images/RU/titles/h_tavern.png' alt='�������' /></div>
			
		<div class='contentBlock' id='contentBlock'><a href='tavern.php' class='back'><img src='images/RU/b_back_p.png' alt='�����' class='cmd'
								onMouseOver=\"doImage(this,'RU/b_back')\" /></a><div class='message'>� ����������</div></div>	</td></tr>";
/***************************
****************************
***************************/
$zap_kosti_gold = count_query("SELECT * FROM `kosti` WHERE `stavka` = '1' AND `fid`='0'");
$zap_kosti_kris = count_query("SELECT * FROM `kosti` WHERE `stavka` = '2' AND `fid`='0'");
$zap_kosti_zelen = count_query("SELECT * FROM `kosti` WHERE `stavka` = '3' AND `fid`='0'");

$kosti_row = mysql_fetch_array(count_query("SELECT * FROM `kosti`"));
$game_k = mysql_num_rows(count_query("SELECT * FROM `kosti` WHERE `pid` > '0' AND `fid` > '0'"));
$zap_num = count_query("SELECT * FROM `kosti` WHERE `pid`='".$row['id_user']."'");

$fingame = mysql_fetch_array($zap_num);
if ($fingame['fid'] > 0)
{
	echo '<script>location.href="kosti.php";</script>';
}

if ($kosti_row['times'] <= time() AND $kosti['fid'] == 0 AND $kosti['win'] == 0)
{
	switch ($kosti_row['stavka'])
	{
		case 1: $m = 'gold'; break;
		case 2: $m = 'krystal'; break;
		case 3: $m = 'zelen'; break;
	}
	count_query("UPDATE `users` SET ".$m."=".$m."+'".$kosti_row['money']."' WHERE `id_user`='".$kosti_row['pid']."'");
	$kosti_del = count_query("DELETE FROM `kosti` WHERE `times` <= '".time()."'");
}

if (isset($_POST['cmd']))
{
	switch ($_POST['cmd'])
	{
		case 'join': 
			$result = mysql_fetch_array(count_query("SELECT * FROM `kosti` WHERE `id`='".$_POST['join']."'"));
			if ($result['id'] AND $result['fid'] == 0)
			{
				$num_join = mysql_num_rows($zap_num);
				if ($num_join > 0)
				{
					$err = "<div class='message'>�����</div>";
				} 
				else
				{
					switch ($result['stavka'])
					{
						case 1: $m = 'gold'; break;
						case 2: $m = 'krystal'; break;
						case 3: $m = 'zelen'; break;
					}
					count_query("UPDATE `users` SET ".$m."=".$m."-'".$result['money']."' WHERE `id_user`='".$row['id_user']."'") or die(mysql_error());
					count_query("UPDATE `kosti` SET `fid`='".$row['id_user']."'")  or die(mysql_error());
					count_query("INSERT INTO `log_kosti` (`pid`,`stavka`,`fnum`,`snum`) VALUES ('".$result['id']."','".$result['money']."','".$result['money']."','".$result['money']."')") or die(mysql_error());
					echo '<script>location.href="kosti.php";</script>';
				}
			}
		break;
		case 'start': 
			$num_start = mysql_num_rows($zap_num);
			if ($num_start > 0)
			{
				$err = "<div class='message'>�����</div>";
			} 
			else
			{
				$times = time()+60;
				switch ($_POST['money'])
				{
					case 1: $m = 'gold'; break;
					case 2: $m = 'krystal'; break;
					case 3: $m = 'zelen'; break;
				}
				$stavka = ($row[$m]*20)/100;
				if ($stavka >= $_POST['amount'])
				{
					if ($row[$m] >= $_POST['amount'])
					{
						count_query("UPDATE `users` SET ".$m."=".$m."-'".$_POST['amount']."' WHERE `id_user`='".$row['id_user']."'");
						count_query("INSERT INTO `kosti` (`pid`, `stavka`, `money`, `times`) VALUES ('".$row['id_user']."', '".$_POST['money']."', '".$_POST['amount']."', '".$times."')") or die (mysql_error());
						echo "<script>location.href='?a=game&id=1';</script>";
					}
					else
					{
						$err = "<div class='message'>�� ������� �����</div>";
					}
				}
				else
				{
					$err = "<div class='message'>������� ������</div>";
				}
			}
		break;
		case 'cancel':
			if ($kosti_row['pid'] == $row['id_user'])
			{
				switch ($kosti_row['stavka'])
				{
					case 1: $m = 'gold'; break;
					case 2: $m = 'krystal'; break;
					case 3: $m = 'zelen'; break;
				}
				count_query("UPDATE `users` SET ".$m."=".$m."+'".$kosti_row['money']."' WHERE `id_user`='".$kosti_row['pid']."'");
				$kosti_del = count_query("DELETE FROM `kosti` WHERE `pid` = '".$kosti_row['pid']."'");
				echo "<script>location.href='?a=game&id=1';</script>";
			} 
			else
			{
				$err = "<div class='message'>�����</div>";
			}
		break;
	}
}

$ingame = mysql_num_rows($zap_num);
if ($ingame > 0)
{
	$j = 'cancel';
	$dis = 'disabled';
	$but = "<input type='image' name='do' class='image cmd' src='images/RU/buttons/b_cancel_p.png' alt='�������� ����!' onMouseOver=\"doImage(this,'RU/buttons/b_cancel',null)\"/ >";
} 
else 
{
	$j = 'start';
	$dis = '';
	$but = "<input type='image' name='do' class='image cmd' src='images/RU/buttons/b_play_p.png' alt='������' onMouseOver=\"doImage(this,'RU/buttons/b_play',null)\"/ >";
}

$kosti = "<tr>
        <td height='750' width='574' align='center' valign='top' background='images/site_01_07.png' bgcolor='#EBDBC1'>
<script src='/css/rare.js'></script><link href='/css/rare.css' rel='stylesheet' type='text/css'><div class='blockHead'><img src='images/RU/titles/h_tavern_1.png' alt='��������' /></div>
		
		<div class='contentBlock' id='contentBlock'><a href='tavern.php' class='back'><img src='images/RU/b_back_p.png' alt='�����' class='cmd'
								onMouseOver=\"doImage(this,'RU/b_back')\" /></a>".$err."<center><a href='page.php?page=tavern' target='_blank'><b>������� ������� ���� � ����� ���� </b></a></center>	<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'><div class='content'><div class='b2'>
		<table class='default tavern'>
		<tr><td colspan=3 >������ ������: ".$game_k."<br />��� ������� �������: ".$row['kosti_g']." / 5 <img src='/images/ico_gold1.png' alt='������' align='absmiddle'>, ".$row['kosti_k']." / 10 <img src='/images/ico_krist1.png' alt='���������' align='absmiddle'>
		<tr>
		<td width='33%'><div class='list'><table class='default'><tr><th>������<th><img src='/images/ico_gold1.png' alt='������' align='absmiddle'>";
$ind = 0;
while ($row_gold = mysql_fetch_array($zap_kosti_gold))
{
	if ($ind > 1){$ind = 0;}
	$kosti .= "<tr class='row_".$ind."'>
				<td>".$row_gold['money']." 
					<img src='/images/ico_gold1.png' alt='������' align='absmiddle' class='png'>
				<td class='c'>";
	if ($row_gold['pid'] == $row['id_user']) { $kosti .= ""; } else {
	$kosti .= "<form method='post' class='inline' action='tavern.php?a=game&id=1'>
					<input type='hidden' name='cmd' value='join' />
					<input type='hidden' name='join' value='".$row_gold['id']."' />
					<input type='image' name='do' class='image cmd' src='images/RU/buttons/b_join_p.png' alt='�����' onMouseOver=\"doImage(this,'RU/buttons/b_join',null)\"/ >
					</form>";}
	$ind++;
}

$kosti .= "</table></div><td width='33%'><div class='list'><table class='default'><tr><th>������<th><img src='/images/ico_krist1.png' alt='���������' align='absmiddle'>";
		
$ind = 0;
while ($row_kris = mysql_fetch_array($zap_kosti_kris))
{
	if ($ind > 1){$ind = 0;}
	$kosti .= "<tr class='row_".$ind."'>
				<td>".$row_kris['money']." 
					<img src='/images/ico_krist1.png' alt='���������' align='absmiddle' class='png'>
				<td class='c'>";
	if ($row_kris['pid'] == $row['id_user']) { $kosti .= ""; } else {
	$kosti .= "<form method='post' class='inline' action='tavern.php?a=game&id=1'>
					<input type='hidden' name='cmd' value='join' />
					<input type='hidden' name='join' value='".$row_kris['id']."' />
					<input type='image' name='do' class='image cmd' src='images/RU/buttons/b_join_p.png' alt='�����' onMouseOver=\"doImage(this,'RU/buttons/b_join',null)\"/ >
					</form>";}
	$ind++;
}
			
$kosti .= "</table></div><td width='33%'><div class='list'><table class='default'><tr><th>������<th><img src='/images/ico_green1.png' alt='������' align='absmiddle'>";

$ind = 0;
while ($row_zelen = mysql_fetch_array($zap_kosti_zelen))
{
	if ($ind > 1){$ind = 0;}
	$kosti .= "<tr class='row_".$ind."'>
				<td>".$row_zelen['money']." 
					<img src='/images/ico_green1.png' alt='������' align='absmiddle' class='png'>
				<td class='c'>";
	if ($row_zelen['pid'] == $row['id_user']) { $kosti .= ""; } else {
	$kosti .= "<form method='post' class='inline' action='tavern.php?a=game&id=1'>
					<input type='hidden' name='cmd' value='join' />
					<input type='hidden' name='join' value='".$row_zelen['id']."' />
					<input type='image' name='do' class='image cmd' src='images/RU/buttons/b_join_p.png' alt='�����' onMouseOver=\"doImage(this,'RU/buttons/b_join',null)\"/ >
					</form>";}
	$ind++;
}

$kosti .= "</table></div>
		</table>
		<script>startAjaxReload(15000);</script></div></div></div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>	<div class='inputGroup inputSmall inputNoHeight ' >
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1' >
			<div class='content' ><div class='title'>������� ����</div><div class='body'><table class='default'><tr><td><img src='images/tavern/Game_1.png' class='item' alt=''/><td>
<form method='POST' action='?a=game&id=1'>
<input type='hidden' name='cmd' value='".$j."'>
<br />
<center>
<table class='default center' >

<tr><td>�������� ������
	<td><select name='money' class='field select_money' id='money' style='text-align:center' class='center' ".$dis."><option value='1'>������</option><option value='2'>���������</option><option value='3'>������</option></select>
<tr><td colspan='2' style='font-size:80%'>�������, �� ��� ������ ������ - ������, ��������� ��� ������?
<tr><td>������� ������
	<td><input type='text' name='amount' value='1000' size=10 id='amount' class='center' ".$dis.">
<tr><td style='font-size:80%' colspan='2'>������� ������, ������� ��� ��������� ������ � ����. ���������� ����� �� ����� ���� ����� � ������� ����� ������ ��������� ������.<br />������ ��� ���� �� ����� ���� ������ 20% �� ����� �� ����� �����
<tr><td colspan='3'><br />".$but."</table>
</center>
</form>
</table></div></div>
		</div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
</div>	</td></tr>";
/************
* ��������� *
************/
$zap_naperst = count_query("SELECT * FROM `naperstki` WHERE `pid`='".$row['id_user']."' AND `win`='0'");
$zap_win_nap = mysql_fetch_array(count_query("SELECT * FROM `naperstki` WHERE `pid`='".$row['id_user']."'"));
if ($zap_win_nap['win'] == 1)
{
	count_query("DELETE FROM `naperstki` WHERE `pid`='".$row['id_user']."'");
}
$num_naperst = mysql_num_rows($zap_naperst);
if ($num_naperst > 0)
{
	loca('naperstki.php');
}
if (isset($_POST['cmdn']))
{
	if ($_POST['cmdn'] == 'start')
	{
		switch ($_POST['money'])
		{
			case 1: if ($row['naper_g'] < 5) { $ppc='gold'; $spend='spend_naper_g_stat'; } else { $err = '<div class="message">�� �� ������ ������ ������!</div>'; } break;
			case 2: if ($row['naper_k'] < 10) { $ppc='krystal'; $spend='spend_naper_k_stat'; } else { $err = '<div class="message">�� �� ������ ������ ������!</div>'; } break;
			case 3: $ppc='zelen'; $spend='spend_naper_z_stat'; break;
		}
		if ($row[$ppc] >= $_POST['amount'] AND $_POST['amount'] > 0)
		{
			switch ($_POST['money'])
			{
				case 1: count_query("UPDATE `users` SET `naper_g`=naper_g+'1' WHERE `id_user`='".$row['id_user']."'"); break;
				case 2: count_query("UPDATE `users` SET `naper_k`=naper_k+'1' WHERE `id_user`='".$row['id_user']."'"); break;
			}
			count_query("UPDATE `users` SET ".$ppc."=".$ppc."-'".$_POST['amount']."', ".$spend."=".$spend."+'".$_POST['amount']."'  WHERE `id_user`='".$row['id_user']."'") or die(mysql_error());
			count_query("INSERT INTO `naperstki` (`pid`,`stavka`,`money`) VALUES ('".$row['id_user']."','".$_POST['money']."','".$_POST['amount']."')") or die(mysql_error());
			loca('naperstki.php');
		}
	}
}
$naperst = "<tr>
        <td height='750' width='574' align='center' valign='top' background='images/site_01_07.png' bgcolor='#EBDBC1'>
<div class='blockHead'><img src='images/RU/titles/h_tavern_2.png' alt='����������' /></div>
		".$err."
		<div class='contentBlock' id='contentBlock'><script src='/css/rare.js'></script><script>var WIN_MULTI = 2;</script><a href='tavern.php' class='back'><img src='images/RU/b_back_p.png' alt='�����' class='cmd'
								onMouseOver=\"doImage(this,'RU/b_back')\" /></a>	<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'><div class='content'><div class='b2'><table class='default center'><tr><td width='150'><a href='/player.php?id=".$row['id_user']."' class='profile ' >".$row['name']."</a><br /><div class='avatar av_small'><div style='background: url(images/avatars/".$row['gender']."/s".$row['ava1'].".jpg)'><div style='background: url(images/avatars/".$row['gender']."/s".$row['ava2'].".png)'><div style='background: url(images/avatars/".$row['gender']."/s".$row['ava3'].".png)'></div></div></div></div><td>
<br />
<center>
<table class='default center' >

<form method='post'>
<input type='hidden' name='cmdn' value='start'>
<tr><td>�������� ������
	<td><select name='money' class='field select_money' id='money'  onchange='tavernUpdateBid()'><option value='1' selected>������</option><option value='2'>���������</option><option value='3'>������</option></select>
<tr><td>������� ������
	<td><input type='text' name='amount' value='1000' size=10 id='amount' class='center' onchange='tavernUpdateBid()' >

<tr><td colspan='3' id='txt'><br />� ������ �������� �� ��������: <br /><span id='bidget'>2000 <img src='/images/ico_gold1.png' alt='������' align='absmiddle' class='png'></span><br /><br />
<tr><td colspan='3'> <input type='image' name='do' class='image cmd' src='images/RU/buttons/b_play_p.png' alt='������' onMouseOver=\"doImage(this,'RU/buttons/b_play',null)\"/ ></form>
</table>
</center>

<td width=150><b>������ ��������</b><br /><img src='images/tavern/barman.jpg' alt='' /></table></div></div></div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>	<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'><div class='content'><div class='b2'>��� ������. ���� ����� � ��� �������. � ����� ����� � ����� ������� ���, ����� �� �� �����. �� ��������� �������, ��� ����� �������� �����. ���� ������ � � ��� ���� � ��� ���� ������, ��� ���� ������. �������� � ���� ������ ������� ����. ���� ���� � ����. ������ ������?<br /><br />��� ������� �������: ".$row['naper_g']." / 5 <img src='/images/ico_gold1.png' alt='������' align='absmiddle'>, ".$row['naper_k']." / 10 <img src='/images/ico_krist1.png' alt='���������' align='absmiddle'></div></div></div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div></div>	</td></tr>";
/**************
* ��� ��� ��� *
**************/
$tak = "<tr>
        <td height='750' width='574' align='center' valign='top' background='images/site_01_07.png' bgcolor='#EBDBC1'>
<div class='blockHead'><img src='images/RU/titles/h_tavern.png' alt='�������' /></div>
			
		<div class='contentBlock' id='contentBlock'><a href='tavern.php' class='back'><img src='images/RU/b_back_p.png' alt='�����' class='cmd'
								onMouseOver=\"doImage(this,'RU/b_back')\" /></a><div class='message'>� ����������</div></div>	</td></tr>";

/*************
* ���������� *
**************/
$sum_naper = $row['naper_win'] + $row['naper_lose'];
$stats = "<tr>
        <td height='750' width='574' align='center' valign='top' background='images/site_01_07.png' bgcolor='#EBDBC1'>
<div class='blockHead'><img src='images/RU/titles/h_tavern_4.png' alt='�������' /></div>
			
		<div class='contentBlock' id='contentBlock'><a href='tavern.php' class='back'><img src='images/RU/b_back_p.png' alt='�����' class='cmd'
								onMouseOver=\"doImage(this,'RU/b_back')\" /></a>	<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'><div class='content'><div class='b2'><table class='default center h22'>
<tr><th>��������<th>�����������<th>��� ��� ���?
<tr class='row_1'><td>��������<td>��������<td>��������
<tr><td>0 <img src='/images/ico_gold1.png' alt='������' align='absmiddle' class='png'><td>".$row['recd_naper_g_stat']." <img src='/images/ico_gold1.png' alt='������' align='absmiddle' class='png'><td>0 <img src='/images/ico_gold1.png' alt='������' align='absmiddle' class='png'>
<tr><td>0 <img src='/images/ico_krist1.png' alt='��������' align='absmiddle' class='png'><td>".$row['recd_naper_k_stat']." <img src='/images/ico_krist1.png' alt='��������' align='absmiddle' class='png'><td>0 <img src='/images/ico_krist1.png' alt='��������' align='absmiddle' class='png'>
<tr><td>0 <img src='/images/ico_green1.png' alt='������' align='absmiddle' class='png'><td>".$row['recd_naper_z_stat']." <img src='/images/ico_green1.png' alt='������' align='absmiddle' class='png'><td>0 <img src='/images/ico_green1.png' alt='������' align='absmiddle' class='png'>
<tr class='row_1'><td>���������<td>���������<td>���������
<tr><td>0 <img src='/images/ico_gold1.png' alt='������' align='absmiddle' class='png'><td>".$row['spend_naper_g_stat']." <img src='/images/ico_gold1.png' alt='������' align='absmiddle' class='png'><td>0 <img src='/images/ico_gold1.png' alt='������' align='absmiddle' class='png'>
<tr><td>0 <img src='/images/ico_krist1.png' alt='��������' align='absmiddle' class='png'><td>".$row['spend_naper_k_stat']." <img src='/images/ico_krist1.png' alt='��������' align='absmiddle' class='png'><td>0 <img src='/images/ico_krist1.png' alt='��������' align='absmiddle' class='png'>
<tr><td>0 <img src='/images/ico_green1.png' alt='������' align='absmiddle' class='png'><td>".$row['spend_naper_z_stat']." <img src='/images/ico_green1.png' alt='������' align='absmiddle' class='png'><td>0 <img src='/images/ico_green1.png' alt='������' align='absmiddle' class='png'>
<tr class='row_1'><td>����� ������<td>����� ������<td>����� ������
<tr><td>0 <img src='images/tavern/ico_total.png' alt=''  align='absmiddle' title='����� ���'/><td>".$sum_naper." <img src='images/tavern/ico_total.png' alt=''  align='absmiddle' title='����� ���'/><td>0 <img src='images/tavern/ico_total.png' alt=''  align='absmiddle' title='����� ���'/>
<tr><td>0 <img src='images/tavern/ico_wins.png' alt=''  align='absmiddle' title='�����'/><td>".$row['naper_win']." <img src='images/tavern/ico_wins.png' alt=''  align='absmiddle' title='�����'/><td>0 <img src='images/tavern/ico_wins.png' alt=''  align='absmiddle' title='�����'/>
<tr><td>0 <img src='images/tavern/ico_lost.png' alt=''  align='absmiddle' title='���������'/><td>".$row['naper_lose']." <img src='images/tavern/ico_lost.png' alt=''  align='absmiddle' title='���������'/><td>0 <img src='images/tavern/ico_lost.png' alt=''  align='absmiddle' title='���������'/>
</table>
</div></div></div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div></div>	</td></tr>";								
if (isset($_GET['a']))
{
	if ($_GET['a'] == 'game')
	{
		switch ($_GET['id'])
		{
			case 1: echo $kostiN; break;
			case 2: echo $naperst; break;
			case 3: echo $tak; break;
		}
	}
	if ($_GET['a'] == 'stats')
	{
		echo $stats;
	}
}
else
{		
?>
<tr>
        <td height='750' width='574' align='center' valign='top' background='images/site_01_07.png' bgcolor='#EBDBC1'>
<div class='blockHead'><img src='images/RU/titles/h_tavern.png' alt='�������' /></div>
			
		<div class='contentBlock' id='contentBlock'><a href='village.php' class='back'><img src='images/RU/b_back_p.png' alt='�����' class='cmd'
								onMouseOver="doImage(this,'RU/b_back')" /></a>	<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'><div class='content'><div class='b2'><img src='images/tavern/Tavern.jpg' alt='' /></div></div></div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>	<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'><div class='content'><div class='b2'><table class='default castle2 center'><tr class='row_5'>
			<td style='width:120px' class='img'><a href='?a=game&id=1'><img src='images/tavern/front_1_p.png' id='img1'	onmouseover="doImageHover(1);" onmouseout='doImageHover(1,false);' ></a>
			<td width=100 class='center'><b><a href='?a=game&id=1' onmouseover='doImageHover(1)' onmouseout='doImageHover(1,false)' >��������</a></b>
			<td class='text_main_3'>������ �����? ������, �������� � ���� ������. ���� ����� �� �����, ��������� � �������.<tr class='row_5'>
			<td style='width:120px' class='img'><a href='?a=game&id=2'><img src='images/tavern/front_2_p.png' id='img2'	onmouseover="doImageHover(2);" onmouseout='doImageHover(2,false);' ></a>
			<td width=100 class='center'><b><a href='?a=game&id=2' onmouseover='doImageHover(2)' onmouseout='doImageHover(2,false)' >����������</a></b>
			<td class='text_main_3'>��� ���������, ��� ���������, ���-�� ��� ��� �� ����. �� ����? ��, ������ ���, ��������� � �������.<tr class='row_5'>
			<td style='width:120px' class='img'><a href='?a=game&id=3'><img src='images/tavern/front_3_p.png' id='img3'	onmouseover="doImageHover(3);" onmouseout='doImageHover(3,false);' ></a>
			<td width=100 class='center'><b><a href='?a=game&id=3' onmouseover='doImageHover(3)' onmouseout='doImageHover(3,false)' >��� ��� ���?</a></b>
			<td class='text_main_3'>������, ������, ������, ������. ������? �������� ����. ���� ��� � ��, ��� ������, ���� ������� ��� ����.<tr class='row_5'>
			<td style='width:120px' class='img'><a href='?a=stats'><img src='images/tavern/front_4_p.png' id='img4'	onmouseover="doImageHover(4);" onmouseout='doImageHover(4,false);' ></a>
			<td width=100 class='center'><b><a href='?a=stats' onmouseover='doImageHover(4)' onmouseout='doImageHover(4,false)' >����������</a></b>
			<td class='text_main_3'>�� ���������� ������, ���, ��� ����, �����. ����������-�� ������ �� �������, �� ����.</table></div></div></div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div></div>	</td></tr>
<?php
}
}
include ('footer_tpl.php');
?>