<?php
include ("top_tpl.php");

$tp = $_POST['type'];

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

if ($row['vip'] > 0)
{
	$doz = $_POST['auto_watch']<=24 AND $_POST['auto_watch']>=1;
	$sel = "<option value='13'>130 ���</option>
			<option value='14'>140 ���</option>
			<option value='15'>150 ���</option>
			<option value='16'>160 ���</option>
			<option value='17'>170 ���</option>
			<option value='18'>180 ���</option>
			<option value='19'>190 ���</option>
			<option value='20'>200 ���</option>
			<option value='21'>210 ���</option>
			<option value='22'>220 ���</option>
			<option value='23'>230 ���</option>
			<option value='24'>240 ���</option>";
}
else
{
	$doz = $_POST['auto_watch']<=12 AND $_POST['auto_watch']>=1;
	$sel = "";
}

if (isset($_POST['do_watch']) AND $doz) //�����
{
	if ($row['time_dozor'] > 0 AND $row['gold'] > 10 AND $row['time_dozor'] >= ($_POST['auto_watch']*10))
	{
		$minutes  = $_POST['auto_watch'];
		$method = $_POST['auto_watch'];
		$dozor_t = $row['time_dozor']-($_POST['auto_watch']*10);
		$minutes  = time()+$minutes*600;
		count_query("UPDATE `users` SET `gold`=gold-'10', `time_dozor`='".$dozor_t."' WHERE `id_user` = '".$_SESSION['id']."'");
		count_query("INSERT INTO `action` (`uid`, `model`, `speed`, `timer`) VALUES ('".$row['id_user']."','2', '".$method."','".$minutes."')");
		echo "<script>location.href='timer.php';</script>";
		exit;
	}
	else
	{
		$err = "�����";
	}
}

if ($_GET['a'] == "monster") //���������
{
	if (isset($_POST['select_search']))
	{
		if (lvl($row['exp']) < 7)
		{
			$err = "��� ��� �� ���������� ������. ��� ������� �� 7��� ������, ����� � �������.";
		}
		else
		{
			switch ($_POST['ptype'])
			{
				case 1: if ($row['krystal'] >= 1) { count_query("UPDATE users SET krystal=krystal-'1' WHERE email='".$_SESSION['email']."'"); $err = monster(2,$_POST['level']);} else {$err="�� ������� ���������";}; break;
				case 2: if ($row['zelen'] >= 1) { count_query("UPDATE users SET zelen=zelen-'1' WHERE email='".$_SESSION['email']."'"); $err = monster(2,$_POST['level']);} else {$err="�� ������� ������";}; break;
			}
		}
	}
	else if (isset($_POST['strash_rand']))
	{
		if (lvl($row['exp']) < 7)
		{
			$err = "��� ��� �� ���������� ������. ��� ������� �� 7��� ������, ����� � �������.";
		}
		else
		{
			if ($row['gold'] >= 500)
			{
				$err = monster(1);
			}
		}
	}
}

if (isset($_POST['addon_search'])) //����������� �����
{
	if($row['vip'] > 1)
	{
		count_query("UPDATE users SET gold=gold-1 WHERE id_user='".$row['id_user']."'");
		$lvls = $_POST['min'];
		$lvle = $_POST['max'];
		$err = search_batt(5,null,$lvls,$lvle);
	}
	else
	{
		echo "<script>location.href='kormushka.php';</script>";
	}
}

if (isset($_POST['do_search']) AND $_POST['do_search'] == 1) //�����
{
	if ($_POST['name'] != null AND $row['gold'] > 0) //����� �� �����
	{
		$select_enemy_name = mysql_fetch_array(count_query("SELECT * FROM users WHERE name = '".$_POST['name']."'"));
		
		count_query("UPDATE users SET gold=gold-1 WHERE id_user='".$row['id_user']."'");
		$err = search_batt(4,$select_enemy_name['name']);
	}
	else if (isset($tp) AND $row['gold'] > 0) //����� �� �������
	{
		count_query("UPDATE users SET gold=gold-1 WHERE id_user='".$row['id_user']."'");
		switch ($tp)
		{
			case 1: $err = search_batt(1); break; //������
			case 2: $err = search_batt(2); break; //������
			case 3: $err = search_batt(3); break; //�������
			case $tp > 3: $err = "��� �� ��������"; break;
		}
	}
	else
	{
		$err = "�� ������� ������";
	}
}

if (isset($_POST['do_attack']) AND $_POST['do_attack'] == 1)
{
	bat($row['id_user'], $_POST['char_id']);
}

if (isset($_POST['do_searchm']))
{
	count_query("UPDATE users SET gold=gold-1 WHERE id_user='".$row['id_user']."'");
	search_batt();
}
?>
      <tr>
        <td height="750" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class='blockHead'><img src='images/RU/titles/h_dozor.png' alt='�������' /></div>
			
		<div class='contentBlock' id='contentBlock'><table class='up_avatar'><tr><td class='avatar'><img src='images/war_man_b.jpg' alt='������� ������'>	</td><td>	<div class='inputGroup inputSmall ' >
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1' style='height:180px !important'>
			<div class='content' ><div class='title'>������� ������</div><div class='body'>���-���, ���� ������ ����������� ��� ����� ��������� ����������� �� ���� ����� �����.<br /><br />
���� �� <b>�����</b> � ����������� � ����� ������. ���� ��� ����� ���� ��������, ��� �������� �� ��� ����������? �� ������ �������� �� ���, �� � �������� �� ��� ��� �� ������.<br /><br />
���� � <b>�����</b> � �������. � ������ ���� ���� ������� �� ����� �, ���� �� ����� �� �����, ����� ������������ �� �����-������ �����������.<br /></div></div>
		</div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
</td></tr></table><div class='message'><?php echo $err; ?></div>
<div class='dozor'>



<table class='info'>
	<tr><td class='half'>	<div class='inputGroup inputSmall ' >
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1' style='height:250px !important'>
		<div class='content' ><div class='title'>�����</div><div class='body'>
			<?php
			if ($row['bat_timer'] <> 0)
			{
				include ("bat_timer.php");
			}
			else
			{
			?>
				<form action='' method ='POST' class='center inline'>
				<input type='hidden' name='do_search' value='1'>
			����: 1 <img src='images/ico_gold1.png' alt='������' align='absmiddle' class='png'><br /><br /><select name='type' class='field select_type' id='type' ><option value='1' selected>����� ������</option><option value='3'>����� �������</option><option value='2'>����� ������</option><option value='10'>������ ��� �������</option><option value='11'>������ ��� �����</option><option value='12'>������ ��� �����</option><option value='100'>�������� �����</option></select><br /><input type='image' name='auto_search' class='image cmd' src='images/RU/b_find_p.png' alt='������ ����������'
					onMouseOver="doImage(this,'RU/b_find',null)"/ ><br /><br />��� ����������<input type='text' name='name' id='name' size='25' maxlength='20' value='' ><br /><br /><input type='image' name='name_search' class='image cmd' src='images/RU/b_nap_p.png' alt='�������'
					onMouseOver="doImage(this,'RU/b_nap',null)"/ ><br /></form>
			<?php } ?>
			</div></div>
		</div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
	<br />	<div class='inputGroup inputSmall ' >
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1' style='height:165px !important'>
		<div class='content' ><div class='title'>����������� ����� <br /><span class='nobold'>(������ ��� "������")</span></div><div class='body'>
			<?php
			if ($row['bat_timer'] <> 0)
			{
				include ("bat_timer2.php");
			}
			else
			{
			?>
			<form action='' method ='POST' class='center inline'>
				<input type='hidden' name='addon_search'>
				����: 1 <img src='images/ico_gold1.png' alt='������' align='absmiddle' class='png'><br /><br />������� �� <input type='text' name='min' id='min' value='<?php echo lvl($row['exp']); ?>' class='small' size='2' maxlength='2'> �� <input type='text' name='max' id='max' value='<?php echo lvl($row['exp'])+4; ?>' class='small' size='2' maxlength='2'> <br /><br /><input type='image' name='auto_search' class='image cmd' src='images/RU/b_find_p.png' alt='������ ����������'
					onMouseOver="doImage(this,'RU/b_find',null)"/ ><br /></form>
			<?php } ?>
			</div></div>
		</div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
	</td>
		<td class='half'>	<div class='inputGroup inputSmall ' >
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1' style='height:150px !important'>
			<div class='content' ><div class='title'>�����</div><div class='body'><form action='' method ='POST' class='center inline'>
			����: 10 <img src='images/ico_gold1.png' alt='������' align='absmiddle' class='png'><br /><br />
			<table class='center'>
				<tr>
					<td>
						<select name='auto_watch' class='field select_auto_watch' id='auto_watch' >
							<option value='1'>10 ���</option>
							<option value='2'>20 ���</option>
							<option value='3'>30 ���</option>
							<option value='4'>40 ���</option>
							<option value='5'>50 ���</option>
							<option value='6'>60 ���</option>
							<option value='7'>70 ���</option>
							<option value='8'>80 ���</option>
							<option value='9'>90 ���</option>
							<option value='10'>100 ���</option>
							<option value='11'>110 ���</option>
							<option value='12'>120 ���</option>
							<?=$sel;?>
						</select>
					<td width=40>
			<input type='hidden' name='do_watch'>
			<input type='image' name='do_watch' class='image cmd' src='images/RU/b_bgn_p.png' alt='������' onMouseOver="doImage(this,'RU/b_bgn',null)"/ ><br />
			</td></tr></table><br />������c� �������: <?=$row['time_dozor'];?></form></div></div>
		</div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
<br />	<div class='inputGroup inputSmall ' >
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1' style='height:265px !important'>
			<div class='content' ><div class='title'>���������</div><div class='body'>����: 500 <img src='images/ico_gold1.png' alt='������' align='absmiddle' class='png'> <br /><br />�� ������ ��������� ��������� �� 1 �� 3 ������<br /><br /> <form method='post' class='inline' action='?a=monster'><input type='hidden' name='level' value='auto' /><input type='hidden' name='strash_rand'/><input type='image' name='doit' class='image cmd' src='images/RU/buttons/b_w_m_search_p.png' alt='������ ���������'
					onMouseOver="doImage(this,'RU/buttons/b_w_m_search',null)"/ ></form><br /><br /><form method='POST' action='?a=monster'>

			����: <input type='radio' name='ptype' value='1' />1 <img src='images/ico_krist1.png' alt='��������' align='absmiddle' class='png'> / <input type='radio' name='ptype' value='2' checked/>1 <img src='images/ico_green1.png' alt='������' align='absmiddle' class='png'><br /><br />
			<select name='level' class='field select_level' id='level' ><option value='1' selected>��������� 1 ������</option><option value='2'>��������� 2 ������</option><option value='3'>��������� 3 ������</option></select><br /><br />
			<input type='hidden' name='select_search'>
			<input type='image' name='doit' class='image cmd' src='images/RU/buttons/b_w_m_search_p.png' alt='������ ���������'
					onMouseOver="doImage(this,'RU/buttons/b_w_m_search',null)"/ ><br /></form>

			</div></div>
		</div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
		</td>
	</td></tr></table>
	<Br /><br />
</div>
</div></div>	</td></tr>
<?php include ("footer_tpl.php"); ?>