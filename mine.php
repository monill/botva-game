<?php
include ("top_tpl.php");

$work = mysql_fetch_array(count_query("SELECT * FROM `action` WHERE `uid` = '".$row['id_user']."'"));
if ($work['id']<>'' AND $work['model'] != 3) {
	echo "<script>location.href='timer.php';</script>";
	exit;
}

//��+10% �����+5%�����+5%������

if (isset($_GET['a']))
{
	if ($_GET['a'] == 'shop')
	{
		if (isset($_GET['buy']))
		{
			switch($_GET['buy'])
			{
				case 0: if ($row['gold'] >= 5000 AND $row['mpick'] == 0) {count_query("UPDATE `users` SET `gold`=gold-'5000', `mpick`='15' WHERE `id_user`='".$row['id_user']."'"); loca('mine.php?a=shop');} else if ($row['gold'] < 5000) {$err = '�� ������� ������';} else if ($row['mpick'] > 0) {$err = '� ��� ��� ���� ����';}; break;
				case 1: if ($row['gold'] >= 3000 AND $row['mglass'] == 0) {count_query("UPDATE `users` SET `gold`=gold-'3000', `mglass`='15' WHERE `id_user`='".$row['id_user']."'"); loca('mine.php?a=shop');} else if ($row['gold'] < 3000) {$err = '�� ������� ������';} else if ($row['mglass'] > 0) {$err = '� ��� ��� ���� ����';}; break;
				case 2: if ($row['gold'] >= 3000 AND $row['mhelmet'] == 0) {count_query("UPDATE `users` SET `gold`=gold-'3000', `mhelmet`='15' WHERE `id_user`='".$row['id_user']."'"); loca('mine.php?a=shop');} else if ($row['gold'] < 3000) {$err = '�� ������� ������';} else if ($row['mhelmet'] > 0) {$err = '� ��� ��� ���� ����';}; break;
			}
		}
		?>
		<tr>
        <td height="750" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class='blockHead'><img src='images/RU/titles/h_mine_shop.png' alt='��������' /></div>
		
		<div class='contentBlock' id='contentBlock'><a href='mine.php' class='back'><img src='images/RU/b_back_p.png' alt='�����' class='cmd'
								onMouseOver="doImage(this,'RU/b_back')" /></a><table class='up_avatar'><tr><td class='avatar'><img src='images/mine_man.jpg' alt='����� �������� (������ ���������)'>	</td><td>	<div class='inputGroup inputSmall  ' >
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1' style='height:180px !important'>
			<div class='content' ><div class='title'>����� �������� (������ ���������)</div><div class='body'>���� ����������� � ������, �� ��� ����� ���� ��� ������ ������.  �� ���� �������� ����� � ����, ��� ����������� �������� ���� ����� �� ��������� ����� ���. </div></div>
		</div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
</td></tr></table><div class='message'><?=$err;?></div>	<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'><div class='content'><div class='b2'><table class='default shop_items'>		<tr><th colspan='2'>�����  <span class='normal'>(���� ����: <?=$row['mpick'];?> ��)</span>
		<tr><td class='image' style='background:url(images/items/Mine_1.jpg) no-repeat' title='�����' >
		<td>
			<div class='desc'>��������:</div>
			<div class='desc2'>������������ ���������� ��� ������ ���������� � �������. ���������� ���������� � <b>15</b>. </div>
			<div class='desc3'>&nbsp;<br /></div>

					<div class='price'>
			<form method='POST' action='mine.php?a=shop&buy=0' class='inline'>
		<input type='image' name='do' class='image cmd' src='images/RU/buttons/b_buy_p.png' alt='������'
					onMouseOver="doImage(this,'RU/buttons/b_buy')"/ >
		<span class='price'>����: 5000 <img src='/images/ico_gold1.png' alt='������' align='absmiddle' class='png'></span></form>
		</div>

		</td>
		</tr>		<tr><th colspan='2'>����  <span class='normal'>(���� ����: <?=$row['mglass'];?> ��)</span>
		<tr><td class='image' style='background:url(images/items/Mine_2.jpg) no-repeat' title='����' >
		<td>
			<div class='desc'>��������:</div>
			<div class='desc2'>����������� ����� ������ ���������� �� 5 ���������. ���������� ���������� � <b>15</b>.</div>
			<div class='desc3'>&nbsp;<br /></div>

					<div class='price'>
			<form method='POST' action='mine.php?a=shop&buy=1' class='inline'>
		<input type='image' name='do' class='image cmd' src='images/RU/buttons/b_buy_p.png' alt='������'
					onMouseOver="doImage(this,'RU/buttons/b_buy')"/ >
		<span class='price'>����: 3000 <img src='/images/ico_gold1.png' alt='������' align='absmiddle' class='png'></span></form>
		</div>

		</td>
		</tr>		<tr><th colspan='2'>�����  <span class='normal'>(���� ����: <?=$row['mhelmet'];?> ��)</span>
		<tr><td class='image' style='background:url(images/items/Mine_3.jpg) no-repeat' title='�����' >
		<td>
			<div class='desc'>��������:</div>
			<div class='desc2'>����������� ����� ������ ���������� �� 5 ���������. ���������� ���������� � <b>15</b>.</div>
			<div class='desc3'>&nbsp;<br /></div>

					<div class='price'>
			<form method='POST' action='mine.php?a=shop&buy=2' class='inline'>
		<input type='image' name='do' class='image cmd' src='images/RU/buttons/b_buy_p.png' alt='������'
					onMouseOver="doImage(this,'RU/buttons/b_buy')"/ >
		<span class='price'>����: 3000 <img src='/images/ico_gold1.png' alt='������' align='absmiddle' class='png'></span></form>
		</div>

		</td>
		</tr></table></div></div></div></div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div></div>	</td></tr>
		<?php
	} else if ($_GET['a'] == 'open')
	{
		if (isset($_GET['m']))
			if ($_GET['m'] == 'work')
			{
				if ($_GET['z'] == 'start')
				{
					if ($row['mpick'] > 0 AND $row['mwork'] == 0)
					{
						$mtime = time()+60*20;
						count_query("UPDATE `users` SET `mwork`='".$mtime."' WHERE `id_user`='".$row['id_user']."'");
						loca('mine.php?a=open');
					} else
					{
						$err = '���� ����������';
					}
				}
			}
		?>
		<tr>
        <td height="750" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class='blockHead'><img src='images/RU/titles/h_mine_open.png' alt='������' /></div>
		
		<div class='contentBlock' id='contentBlock'>	<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>
		
		<div class='c1'><div class='content'><div class='b2'><div class='opening'></div></div></div></div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div><div class='message'><?=$err;?></div><table class='full opening'>
<tr><td class='half'>	<div class='inputGroup inputSmall  ' >
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1' style='height:220px !important'>
			<div class='content' ><div class='title'>����������</div><div class='body'>	<table class='mine_open'>
		<tr><td rowspan='2'	class='img'><img src='images/items/Mine_1s.jpg' alt='�����' />
			<td>�����:
			<tr><td class='row2'>������� <b><?=$row['mpick'];?></b> ���.
		<tr><td rowspan='2' class='img'><img src='images/items/Mine_2s.jpg' alt='����'  /><td>����:
			<tr><td class='row2'>������� <b><?=$row['mglass'];?></b> ���.
		<tr><td rowspan='2' class='img'><img src='images/items/Mine_3s.jpg' alt='�����'  /><td>�����:
			<tr><td class='row2'>������� <b><?=$row['mhelmet'];?></b> ���.
	</table></div></div>
		</div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
</td>
	<td class='half'>	<div class='inputGroup inputSmall  ' >
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1' style='height:220px !important'>
		<?php
		if ($row['mwork'] == 0)
		{
		?>
			<div class='content' ><div class='title'>�������� � �������</div><div class='body'><br /><br />���� �� ����� ���������� � ������, �� ����� ���� � ���� � ���� �� ���, ����� �� ������ � ��������������� ��� �������� � ������.<br /><br /><br /><br /><br /><br /><a href='mine.php?a=open&amp;m=work&amp;z=start' ><img src='images/RU/b_working_p.png' alt='��������' class='cmd'
								onMouseOver="doImage(this,'RU/b_working','skip')" /></a></div></div>
		<?php } else if ($row['mwork'] >= time()) { 
			$delta = $row['mwork'] - time();
			?>
			<br><br><br><br><br><br><br><b><div id="bx0" class="z" style="text-align:center"><b>---</b></div></b>
			<script type="text/javascript">v=new Date();var bx0=document.getElementById('bx0');function tbx0(){n=new Date();s=<?=$delta;?>-Math.round((n.getTime()-v.getTime())/1000.);m=0;h=0;if(s<0){bx0.innerHTML='---';document.location=document.location;}else{if(s>59){m=Math.floor(s/60); s=s-m*60}if(m>59){h=Math.floor(m/60);m=m-h*60} if(s<10){s="0"+s}if(m<10){m="0"+m}bx0.innerHTML=" "+h+":"+m+":"+s+'';document.title=h+':'+m+':'+s;window.setTimeout("tbx0();",999);}}tbx0();</script>
		<?php } else if ($row['mwork'] < time() AND $work['model'] != 3) 
				{
					if ($row['mpick'] > 0) { $mpickper = 10; } else { $mpickper = 0; }
					if ($row['mglass'] > 0) { $mglassper = 5; } else { $mglassper = 0; }
					if ($row['mhelmet'] > 0) { $mhelmper = 5; } else { $mhelmper = 0; }
					
					$per = mt_rand(lvl($row['exp'])-1,lvl($row['exp'])+2)+$mpickper+$mglassper+$mhelmper;
					if ($row['mper'] == 0)
					{
						$hpDam = round(mt_rand(2,5)*20);
						count_query("UPDATE `users` SET mper='".$per."', `hp_now`=hp_now-'".$hpDam."' WHERE `id_user`='".$row['id_user']."'");
						loca('mine.php?a=open');
					}
					if (isset($_GET['a']) AND $_GET['a'] == 'open')
					{
						if (isset($_GET['m']) AND $row['mper'] > 0)
						{
							switch ($_GET['m'])
							{
								case 'dig': if (isset($_GET['z']) AND $_GET['z'] == 'dig') { $mtm = time()+60*20; count_query("UPDATE `users` SET `mpick`=mpick-'1', `mglass`=mglass-'1', `mhelmet`=mhelmet-'1' WHERE `id_user`='".$row['id_user']."'"); count_query("INSERT INTO `action` (`uid`, `model`, `speed`, `timer`) VALUES ('".$row['id_user']."','3', '".$row['mper']."','".$mtm."')"); loca('mine.php?a=open'); }; break;
								case 'reset': if (isset($_GET['z']) AND $_GET['z'] == 'reset') { $mtime = time()+60*20; count_query("UPDATE `users` SET `mwork`='".$mtime."', `mper`='0' WHERE `id_user`='".$row['id_user']."'"); loca('mine.php?a=open'); }; break;
								case 'cancel': count_query("UPDATE `users` SET `mwork`='0', `mper`='0' WHERE `id_user`='".$row['id_user']."'"); loca('mine.php'); break;
							}
						}
					}
				?>
					<div class='c1' style='height:220px !important'>
					<div class='content' ><div class='title'>�������� � �������</div><div class='body'><br /><br />�� ����� �������������! <br />����������� ������ - <?=$row['mper'];?> %. <br />����� ��������� ��������? <br /><br /><br /><a href='?a=open&amp;m=dig&amp;&amp;z=dig' ><img src='images/RU/b_krist_p.png' alt='������ �������' class='cmd'
								onMouseOver="doImage(this,'RU/b_krist','skip')" /></a><br /><a href='?a=open&amp;m=reset&amp;&amp;z=reset' ><img src='images/RU/b_more2_p.png' alt='������ ������' class='cmd'
								onMouseOver="doImage(this,'RU/b_more2','skip')" /></a><br /><a href='?a=open&amp;m=cancel' ><img src='images/RU/b_away_p.png' alt='���� � �����' class='cmd'
								onMouseOver="doImage(this,'RU/b_away','skip')" /></a></div></div>
					</div>
			<?php } else if ($work['model'] == 3 AND $work['timer'] > time()) 
						{
						$timerMine = $work['timer']-time();
						?>
				<br><br><br><br><br><br><br><b><div id="bx0" class="z" style="text-align:center"><b>---</b></div></b>
			<script type="text/javascript">v=new Date();var bx0=document.getElementById('bx0');function tbx0(){n=new Date();s=<?=$timerMine;?>-Math.round((n.getTime()-v.getTime())/1000.);m=0;h=0;if(s<0){bx0.innerHTML='---';document.location=document.location;}else{if(s>59){m=Math.floor(s/60); s=s-m*60}if(m>59){h=Math.floor(m/60);m=m-h*60} if(s<10){s="0"+s}if(m<10){m="0"+m}bx0.innerHTML=" "+h+":"+m+":"+s+'';document.title=h+':'+m+':'+s;window.setTimeout("tbx0();",999);}}tbx0();</script>
			<? } ?>
		</div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
</td>
</tr>
</table></div><a href='mine.php' class='back'><img src='images/RU/b_back_p.png' alt='�����' class='cmd'
								onMouseOver="doImage(this,'RU/b_back')" /></a>	</td></tr>
		
		<?php
	}
}
 if (lvl($row['exp']) < 7) {?>
 <tr>
        <td height="750" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class='blockHead'><img src='images/RU/titles/h_mine.png' alt='�����' /></div>
		<div class='contentBlock' id='contentBlock'><table class='up_avatar'><tr><td class='avatar'><img src='images/mine_man.jpg' alt='����� �������� (������ ���������)'>	</td><td>	<div class='inputGroup inputSmall ' >
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1' style='height:180px !important'>
			<div class='content' ><div class='title'>����� �������� (������ ���������)</div><div class='body'>���, ���, ���. �����! ���, ��������!<br>
		��� ��� � ��� ��� ������ ����� ���������  �-�����? <br />
		��� ���, �� ������ �������. ��� � ����-�� ����...�����.... � ��� � ����� ������.
		��������� � <u>�������</u> �����, ����� � ���������!... ����! ظ� �� �� ������...</div></div>
		</div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
</td></tr></table>
		<?php } else if ($_GET['a'] == null) { ?>
		<tr>
        <td height="750" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class='blockHead'><img src='images/RU/titles/h_mine.png' alt='�����' /></div>
		<div class='contentBlock' id='contentBlock'><table class='up_avatar'><tr><td class='avatar'><img src='images/mine_man.jpg' alt='����� �������� (������ ���������)'>	</td><td>	<div class='inputGroup inputSmall ' >
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1' style='height:180px !important'>
			<div class='content' ><div class='title'>����� �������� (������ ���������)</div><div class='body'>���, ���, ���. �����! ���, ��������!<br>
		�������. ������� ����� ��� ����, ����� �������, �-�����! ������ ��������� ����� ������������, ���� ��� ����� ��������! ��� ����� ��� ����� ����. ������ �� ���, ���, � ������� �������, ��� ��� ����� ���������� � ����� ��������, ���.<br>
		� �������� ������� ��� ������, � �������� �� ������ ����������. ��� ������ � ��������� ������ ������ � �����. �-�����!</div></div>
		</div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
</td></tr></table> <table class='mine_info top' style='width:100%'>
	<tr><td class='top' width='50%'>	<div class='inputGroup inputSmall inputNoHeight' >
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1' >
			<div class='content' ><div class='title'>��������</div><div class='body'>������������ � ���������� ��� ���, ��� �� ����� ��� �������� � ������ � ������ �� ���������. �����, ���� � ����� � ��, ��� �����, ����� ����������� ���� ��������� ��������. ���������� �� ���, �� ��������� ��� ����� � �����.<br /><br /><br /><a href='mine.php?a=shop' ><img src='images/RU/buttons/b_miner2_p.png' alt='��������' class='cmd'
								onMouseOver="doImage(this,'RU/buttons/b_miner2','skip')" /></a></div></div>
		</div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
<br />	<div class='inputGroup inputSmall inputNoHeight' >
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1' >
			<div class='content' ><div class='title'>��������� �������</div><div class='body'>���� ������, ���������� ��������� ������� �� ��������. ����������� � ����� ��� ��������, �� ������ ���������� ��� ���. ����� ������� �� ������ �������� ��������.<br /><br />
	<table style='width:100%' class='center'>
	<tr><td><form method='POST' action='monster.php?a=start&k=16810'><input type='hidden' name='mmtype' value='1'>20 �����<br /><input type='image' name='do' class='image cmd' src='images/RU/buttons/b_godown1_p.png' alt='�� ������'
					onMouseOver="doImage(this,'RU/buttons/b_godown1',null)"/ ><br />50 <img src='/images/ico_gold1.png' alt='������' align='absmiddle' class='png'></form>
		<td><form method='POST' action='monster.php?a=start&k=16810'>10 �����<br /><input type='image' name='do' class='image cmd' src='images/RU/buttons/b_godown2_p.png' alt='�� ������'
					onMouseOver="doImage(this,'RU/buttons/b_godown2',null)"/ ><br /><input type='radio' name='ptype' value='1' />1 <img src='/images/ico_krist1.png' alt='��������' align='absmiddle' class='png'> / <input type='radio' name='ptype' value='2' checked/>1 <img src='/images/ico_green1.png' alt='������' align='absmiddle' class='png'></form>
	</table>

</div></div>
		</div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
<br />	<div class='inputGroup inputSmall inputNoHeight' >
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1' >
			<div class='content' ><div class='title'>����������</div><div class='body'>	<table class='stat' width='100%'>
	<tr><th>����� ������:<td> <?php echo $row['mmine']+$row['msglade']+$row['mbglade']; ?> <img src='/images/ico_krist1.png' alt='��������' align='absmiddle' class='png'>	<td class='kr'>
	<tr><th>� �������:<td> <?=$row['mmine'];?> <img src='/images/ico_krist1.png' alt='��������' align='absmiddle' class='png'>		<td class='kr'>
	<tr><th>�� ����� ������:<td> <?=$row['msglade'];?> <img src='/images/ico_krist1.png' alt='��������' align='absmiddle' class='png'>	<td class='kr'>
	<tr><th>�� ������� ������:<td> <?=$row['mbglade'];?> <img src='/images/ico_krist1.png' alt='��������' align='absmiddle' class='png'>	<td class='kr'>
	</table>
</div></div>
		</div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
	</td>
		<td class='top'>	<div class='inputGroup inputSmall inputNoHeight' >
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1' >
			<div class='content' ><div class='title'>������</div><div class='body'>������� � �������, �� ������� ��� ��������, ������� ���� ������� ������. �� ������ ����� �� �� ���������, ��� ����� ��� ���������. ������� � ����� � �����. �� <br />����� � ����� ������� � ���� ��������� ����������� �������� ���� ����.<br /><br /><br /><a href='mine.php?a=open' ><img src='images/RU/buttons/b_miner1_p.png' alt='��������' class='cmd'
								onMouseOver="doImage(this,'RU/buttons/b_miner1','skip')" /></a></div></div>
		</div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
<br />	<div class='inputGroup inputSmall inputNoHeight' >
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1' >
			<div class='content' ><div class='title'>����� ������</div><div class='body'>�������, � ����� �������� ���� ������, ��� ��������� ������� ���� �� ������, ���������� ��� ���������. �� ����� ����-���� ������� �� ����� ������, ��� ��� ��������� ��������� ����������. ������, ��� ��� ��� ����� ��� �����, ���� ���� ��������� �� ��� �������. �� ������, ��� �������� �� ������, ������ ����� ������ ��������. ��� ��������� � ��������.<br /><br /><br /><img src='images/RU/b_small_b.png' alt='���������' class='cmd' >&nbsp; &nbsp;<img src='images/RU/b_big_b.png' alt='�������' class='cmd' ></a><br />	<span> 0 <img src='images/items/Ticket_1ss.png' alt='' align='absmiddle' ></span>
	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
	<span> 0 <img src='images/items/Ticket_2ss.png' alt='' align='absmiddle' ></span></div></div>
		</div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
		</td>
	</td></tr></table>
	<Br /><br />
</div><?php } ?></div>	</td></tr>
<?php include ("footer_tpl.php"); ?>	