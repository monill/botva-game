<?php
include ("top_tpl.php");
$c_q = count_query("SELECT * FROM `clans` WHERE `id` = '".$_GET['id']."'");
$res = mysql_num_rows($c_q);

if ($res > 0)
{
$row_clan_id = mysql_fetch_array($c_q);

if ($row_clan_id['site'] == "")
{
	$site = "�� ������";
}
else
{
	$site = $row_clan_id['site'];
}

$cmember = mysql_num_rows(count_query("SELECT * FROM `users` WHERE `clan` = '".$row_clan_id['id']."' AND clan_stat != '���������'"));
$cgl = mysql_result(count_query("SELECT SUM(glory) FROM `users` WHERE clan = '".$row_clan_id['id']."'"), 0);
$cGlory = round($cgl);
count_query("UPDATE `clans` SET `glory`='".$cGlory."' WHERE id='".$row_clan_id['id']."'");

count_query("set @n:=0"); 
$zap_id = count_query("select rownum from (select @n:=@n+1 as rownum,id from clans order by glory desc) t where id='".$row_clan_id['id']."'"); 
$topcl_id = mysql_fetch_array($zap_id);

if (isset($_POST['logToClan']))
{
	$zap_logToClan = count_query("UPDATE `users` SET clan='".$row_clan_id['id']."' WHERE email = '".$_SESSION['email']."'");
	echo "<script>location.href=''</script>";
}
###########################
# �������� �����, ��� ��� #
# � ���� ��� ����� � ���  #
# �� � �����              #
###########################
?>
<tr>
        <td height="750" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class='blockHead'><img src='images/RU/titles/h_clan.png' alt='����' /></div>
			
		<div class='contentBlock' id='contentBlock'><table class='clan_info'>
<tr><td style='background-image:url(/images/flags/<?=$row_clan_id['ava'];?>.png)' class='clan_img'>&nbsp;
	<td class='clan_info'>	<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'><div class='content'><div class='b2'><div style='padding:0 10px'><table class='clanInfo' >
<tr class='blockTitle left'><td style='width:100px'>��� �����:			<td><a href='/clan.php?id=<?=$row_clan_id['id'];?>'  class='profile '><?=$row_clan_id['name'];?></a>
<tr class='row_1'><td style='width:100px'>��� �����:							<td><?=$row_clan_id['tag'];?>
<tr><td><a href='top.php?t=2'>�������:</a>		<td><?=$topcl_id['rownum'];?>
<tr class='row_1'><td>���� �����:												<td><?=$site;?>
<tr><td>������� �����:							<td><?=$row_clan_id['glory'];?>
<tr class='row_1'><td><a href='clan_members.php?id=<?=$row_clan_id['id'];?>'>������ ������</a>
	<td><?=$cmember;?> / <?=$row_clan_id['mem'];?>
<tr><td>�����:
	<td><?=$row_clan_id['kgold'];?> <img src='/images/ico_gold1.png' alt='������' align='absmiddle'>
<tr class='row_1'><td>&nbsp;</td><td>&nbsp;</td></tr>
</table>
<style>

TABLE.clanInfo TD{height:20px !important};
</style></div></div></div></div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div></td>
</tr>
</table>
		<?php
		if ($row_clan_id['mem'] > $cmember)
		{
			if ($row['clan_stat'] == '���������' AND $row['race'] == $row_clan_id['race'] AND $row['clan'] == 0)
			{
		?>
		<form method="post">
		<input type="hidden" name="logToClan">
		<input type='image' src='images/RU/b_zaya_p.png' alt='������ ������ � ����' class='image cmd' onMouseOver="doImage(this,'RU/b_zaya','skip')" />
		</form>
		<?php
			}
			else if ($row['clan_stat'] == '���������' AND $row['clan'] == $_GET['id'])
			{
				echo "������ ������!";
			}
		}
		?>
<br /><br />	<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'><div class='content'><div class='b2'><img src='images/zamok1_1.jpg' width='504' height='200'></div></div></div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>	<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'>
		
		<div class='content'><div class='b2'><?=$row_clan_id['description'];?></div></div>

		</div>
		
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div></div>	</td></tr>
<?php
}
else if ($row['clan'] == 0)
{
##################
# �������� ����� #
##################
?>
      <tr>
        <td height="700" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class='blockHead'><img src='images/RU/titles/h_clan.png' alt='����' /></div>
			
		<div class='contentBlock' id='contentBlock'>	<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'><div class='content'><div class='b2'><div class='text_main_2'>���� �� ��������, ��� � ��� ������ ���, ����� ������� ��������� ����, � ����� ���������� �� - ����� ����������� �����������.<br /><br /><a href='clan_create.php' ><img src='images/RU/b_clan_do_p.png' alt='�������� ����' class='cmd'
								onMouseOver="doImage(this,'RU/b_clan_do','skip')" /></a></div></div></div></div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>	<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'><div class='content'><div class='b2'><div class='text_main_2'>���� �� ������ ����� ����, �������� �������� ���� ������ ��������, ���������� ������ ����� ����� ���� ������.<br /><br /><img src='images/RU/b_clan_search_b.png' alt='��������� ����' class='cmd' ></div></div></div></div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>	<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'><div class='content'><div class='b2'><div class='text_main_2'>���� �� ����� �������� �����, ������� ������ ����� - ����� ��������� ����� ����� ���� ������.<br /><br /><a href='search.php?el=c' ><img src='images/RU/b_clan_search2_p.png' alt='����� ����' class='cmd'
								onMouseOver="doImage(this,'RU/b_clan_search2','skip')" /></a></div></div></div></div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div></div>	</td></tr>
<?php
}
else
{
$clan = mysql_fetch_array(count_query("SELECT * FROM `clans` WHERE `id` = '".$row['clan']."'"));

if ($clan['site'] == "")
{
	$site = "�� ������";
}
else
{
	$site = $clan['site'];
}

$cmember = mysql_num_rows(count_query("SELECT * FROM `users` WHERE `clan` = '".$clan['id']."' AND clan_stat != '���������'"));
$cgl = mysql_result(count_query("SELECT SUM(glory) FROM `users` WHERE clan = '".$clan['id']."'"), 0);
$cGlory = round($cgl);
count_query("UPDATE `clans` SET `glory`='".$cGlory."' WHERE id='".$clan['id']."'");

count_query("set @n:=0"); 
$zap = count_query("select rownum from (select @n:=@n+1 as rownum,id from clans order by glory desc) t where id='".$row['clan']."'"); 
$topcl = mysql_fetch_array($zap); 
###########################
# �������� �����, ��� ��� #
# � ���� ���� ����, ����  #
# ��� ���, ��� � �����    #
###########################
?>
<tr>
        <td height="750" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class='blockHead'><img src='images/RU/titles/h_clan.png' alt='����' /></div>
			
		<div class='contentBlock' id='contentBlock'><table class='clan_info'>
<tr><td style='background-image:url(/images/flags/<?=$clan['ava'];?>.png)' class='clan_img'>&nbsp;
	<td class='clan_info'>	<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'><div class='content'><div class='b2'><div style='padding:0 10px'><table class='clanInfo' >
<tr class='blockTitle left'><td style='width:100px'>��� �����:			<td><a href='/clan.php?id=<?=$clan['id'];?>'  class='profile '><?=$clan['name'];?></a>
<tr class='row_1'><td style='width:100px'>��� �����:							<td><?=$clan['tag'];?>
<tr><td><a href='top.php?t=2'>�������:</a>		<td><?=$topcl['rownum'];?>
<tr class='row_1'><td>���� �����:												<td><?=$site;?>
<tr><td>������� �����:							<td><?=$clan['glory'];?>	
<tr class='row_1'><td><a href='clan_members.php?id=<?=$clan['id'];?>'>������ ������</a>
	<td><?=$cmember;?> / <?=$clan['mem'];?>
<tr><td>�����:
	<td><?=$clan['kgold'];?> <img src='/images/ico_gold1.png' alt='������' align='absmiddle'>
<tr class='row_1'><td>��� ����:</td><td><?=$row['clan_stat'];?></td></tr>
</table>
<style>

TABLE.clanInfo TD{height:20px !important};
</style></div></div></div></div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div></td>
</tr>
</table>
	<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'><div class='content'><div class='b2'><table class='default castle2' style='margin:0 10px;width:490px;'><tr class='row_5'>
				<td style='width:120px' class='img'><a href='clan_mod.php?m=view'><img src='images/b5_8_8_p.png' id='img1'	onmouseover="doImageHover(1);" onmouseout='doImageHover(1,false);' ></a>
				<td width=120 class='center'><b><a href='clan_mod.php?m=view' onmouseover='doImageHover(1)' onmouseout='doImageHover(1,false)' >�����</a></b>
				<td class='text_main_3'>����� ����������� ������ ��� �� ����� ������ �����, ��� �������� ����������� ��� ���������, � ����� ������ ��� �������.
				<?php 
				if ($row['clan_stat'] != '���������') {
				?>
				<tr class='row_5'>
				<td style='width:120px' class='img'><a href='clan_common_hall.php'><img src='images/b5_8_9_p.png' id='img2'	onmouseover="doImageHover(2);" onmouseout='doImageHover(2,false);' ></a>
				<td width=120 class='center'><b><a href='clan_common_hall.php' onmouseover='doImageHover(2)' onmouseout='doImageHover(2,false)' >����� ���</a></b>
				<td class='text_main_3'>��������� �������� ��������� �� ����� ����� � ����� ����. ��� ���� ����� ������� ������ ������������ ���������.
				<?php
				}
				if ($row['clan_stat'] != '����������' AND $row['clan_stat'] != '���������') {
				?>
				<tr class='row_5'>
				<td style='width:120px' class='img'><a href='clan_mod.php?m=training'><img src='images/b5_8_10_p.png' id='img3'	onmouseover="doImageHover(3);" onmouseout='doImageHover(3,false);' ></a>
				<td width=120 class='center'><b><a href='clan_mod.php?m=training' onmouseover='doImageHover(3)' onmouseout='doImageHover(3,false)' >����������</a></b>
				<td class='text_main_3'>� ���������� �������� ��������� ������������� ������ ����. � �������������� ���� �������, � ����� �������� �� �����. ���� �� ������, ��� ���������, �� ��� ������
				<?php 
				}
				if ($row['clan_stat'] != '���������') {
				?>
				<tr class='row_5'>
				<td style='width:120px' class='img'><a href='clan_mod.php?m=treasury'><img src='images/b5_8_11_p.png' id='img4'	onmouseover="doImageHover(4);" onmouseout='doImageHover(4,false);' ></a>
				<td width=120 class='center'><b><a href='clan_mod.php?m=treasury' onmouseover='doImageHover(4)' onmouseout='doImageHover(4,false)' >������������</a></b>
				<td class='text_main_3'>�� ��������� ����� ��������� ����� ����� ������� ����� � ������������. ���� ������ ��������� ������, ����� ������� ����� �� ����� ������������ �������.
				<?php
				}
				if ($row['clan_stat'] != '����������' AND $row['clan_stat'] != '���������') {
				?>
				<tr class='row_5'>
				<td style='width:120px' class='img'><a href='clan_embassy.php'><img src='images/b5_8_12_p.png' id='img5'	onmouseover="doImageHover(5);" onmouseout='doImageHover(5,false);' ></a>
				<td width=120 class='center'><b><a href='clan_embassy.php' onmouseover='doImageHover(5)' onmouseout='doImageHover(5,false)' >����������</a></b>
				<td class='text_main_3'>����������������� ������ ����� � ��� �����, ��� ����� �������, ����������� ������ ��������, �������������� ����� � ����������� ����� � �������������, �� �����������.
				
				<tr class='row_5'>
				<td style='width:120px' class='img'><a href='clan_plac.php'><img src='images/b5_8_13_p.png' id='img6'	onmouseover="doImageHover(6);" onmouseout='doImageHover(6,false);' ></a>
				<td width=120 class='center'><b><a href='clan_plac.php' onmouseover='doImageHover(6)' onmouseout='doImageHover(6,false)' >����</a></b>
				<td class='text_main_3'>���� ��� � �������� ����� ��������� ���������������� ���� � ��� ��� �� �����. ������ ����� ������ ����� ������� ��� ������������� � ��������, ������ ���� � ���������� �� �����.
				<?php 
				}
				if ($row['clan_stat'] != '���������') {
				?>
				<tr class='row_5'>
				<td style='width:120px' class='img'><a href='clan_mod.php?m=watch'><img src='images/b5_8_15_p.jpg' id='img7'	onmouseover="doImageHover(7);" onmouseout='doImageHover(7,false);' ></a>
				<td width=120 class='center'><b><a href='clan_mod.php?m=watch' onmouseover='doImageHover(7)' onmouseout='doImageHover(7,false)' >��������</a></b>
				<td class='text_main_3'>���� ������� �� �������� ����� ��������, ���� ���������� �������� ����� ����� ������. ���� ��� ���� � ��������� �����, ������� ���������� ������ ������ ���������� ��� ���������.
				<?php
				}
				if ($row['clan_stat'] != '����������' AND $row['clan_stat'] != '���������') {
				?>
				<tr class='row_5'>
				<td style='width:120px' class='img'><a href='clan_mod.php?m=tron'><img src='images/b5_8_14_p.png' id='img8'	onmouseover="doImageHover(8);" onmouseout='doImageHover(8,false);' ></a>
				<td width=120 class='center'><b><a href='clan_mod.php?m=tron' onmouseover='doImageHover(8)' onmouseout='doImageHover(8,false)' >������� ���</a></b>
				<td class='text_main_3'>� ������� ��� ����������� ������ ���������. ��� �� ��������, ���� ������ ����� �������� ��� ��������� ������� �� ����������� � ����������� ����������� �����.
				<?php } ?>
				</table></div></div></div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div></div>	</td></tr>
<?php
}
include ("footer_tpl.php"); ?>	