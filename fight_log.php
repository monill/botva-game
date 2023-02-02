<?php
include("top_tpl.php");

$uid = $_GET['log_id'];

$bat_char = mysql_fetch_array(count_query("SELECT * FROM `fight` WHERE `id` = '".$uid."'"));
$att_p = mysql_fetch_array(count_query("SELECT * FROM `users` WHERE `id_user` = '".$bat_char['att']."'"));
$def_p = mysql_fetch_array(count_query("SELECT * FROM `users` WHERE `id_user` = '".$bat_char['def']."'"));

if ($att_p['clan'] == 0)
{
	$cl = "&nbsp;";
} else {
	$zap_cl = mysql_fetch_array(count_query("SELECT id,name FROM clans WHERE id='".$att_p['clan']."'"));
	$cl = "<a href='clan.php?id=".$zap_cl['id']."' class='profile'>".$zap_cl['name']."</a>";
}

if ($def_p['clan'] == 0)
{
	$cl2 = "&nbsp;";
} else {
	$zap_cl2 = mysql_fetch_array(count_query("SELECT id,name FROM clans WHERE id='".$def_p['clan']."'"));
	$cl2 = "<a href='clan.php?id=".$zap_cl2['id']."' class='profile'>".$zap_cl2['name']."</a>";
}

#################################
if ($bat_char['safe_a'] > 0)
{
	$as = "<img src='images/ico_m1_10.jpg' alt=''  onMouseOver=\"doItem('safe','<br />Действует до ".date('j.m.Y H:i', $att_p['safe'])."','','0',event,this)\" width='40' height='40'>";
}
else
{
	$as = "<img src='images/ico_m1_00.jpg' alt=''  onMouseOver=\"doItem('safe','<br />Не действует','','0',event,this)\" width='40' height='40'>";
}
if ($bat_char['woodoo1_a'] > 0)
{
	$aw = "<img src='images/ico_m2_a.jpg' alt=''  onMouseOver=\"doItem('woodoo','<br />Действует до ".date('j.m.Y H:i', $att_p['woodoo'])."','','0',event,this)\" width='40' height='40'>";;
}
else
{
	$aw = "<img src='images/ico_m2_p.jpg' alt=''  onMouseOver=\"doItem('woodoo','<br />Не действует','','0',event,this)\" width='40' height='40'>";
}
if ($bat_char['woodoo2_a'] > 0)
{
	$aw2 = "<img src='images/ico_m3_a.jpg' alt=''  onMouseOver=\"doItem('woodoo2','<br />Действует до ".date('j.m.Y H:i', $att_p['woodoo2'])."','','0',event,this)\" width='40' height='40'>";;
}
else
{
	$aw2 = "<img src='images/ico_m3_p.jpg' alt=''  onMouseOver=\"doItem('woodoo2','<br />Не действует','','0',event,this)\" width='40' height='40'>";
}
if ($bat_char['woodoo3_a'] > 0)
{
	$aw3 = "<img src='images/ico_m4_a.jpg' alt=''  onMouseOver=\"doItem('totem','<br />Действует до ".date('j.m.Y H:i', $att_p['woodoo3'])."','','0',event,this)\" width='40' height='40'>";;
}
else
{
	$aw3 = "<img src='images/ico_m4_p.jpg' alt=''  onMouseOver=\"doItem('totem','<br />Не действует','','0',event,this)\" width='40' height='40'>";
}
if ($bat_char['woodoo4_a'] > 0)
{
	$aw4 = "<img src='images/ico_m5_a.jpg' alt=''  onMouseOver=\"doItem('totem2','<br />Действует до ".date('j.m.Y H:i', $att_p['woodoo4'])."','','0',event,this)\" width='40' height='40'>";;
}
else
{
	$aw4 = "<img src='images/ico_m5_p.jpg' alt=''  onMouseOver=\"doItem('totem2','<br />Не действует','','0',event,this)\" width='40' height='40'>";
}
###########
if ($bat_char['safe_d'] > 0)
{
	$ds = "<img src='images/ico_m1_10.jpg' alt=''  onMouseOver=\"doItem('safe','<br />Действует до ".date('j.m.Y H:i', $def_p['safe'])."','','0',event,this)\" width='40' height='40'>";;
}
else
{
	$ds = "<img src='images/ico_m1_00.jpg' alt=''  onMouseOver=\"doItem('safe','<br />Не действует','','0',event,this)\" width='40' height='40'>";
}
if ($bat_char['woodoo1_d'] > 0)
{
	$dw = "<img src='images/ico_m2_a.jpg' alt=''  onMouseOver=\"doItem('woodoo','<br />Действует до ".date('j.m.Y H:i', $def_p['woodoo'])."','','0',event,this)\" width='40' height='40'>";;
}
else
{
	$dw = "<img src='images/ico_m2_p.jpg' alt=''  onMouseOver=\"doItem('woodoo','<br />Не действует','','0',event,this)\" width='40' height='40'>";
}
if ($bat_char['woodoo2_d'] > 0)
{
	$dw2 = "<img src='images/ico_m3_a.jpg' alt=''  onMouseOver=\"doItem('woodoo2','<br />Действует до ".date('j.m.Y H:i', $def_p['woodoo2'])."','','0',event,this)\" width='40' height='40'>";;
}
else
{
	$dw2 = "<img src='images/ico_m3_p.jpg' alt=''  onMouseOver=\"doItem('woodoo2','<br />Не действует','','0',event,this)\" width='40' height='40'>";
}
if ($bat_char['woodoo3_d'] > 0)
{
	$dw3 = "<img src='images/ico_m4_a.jpg' alt=''  onMouseOver=\"doItem('totem','<br />Действует до ".date('j.m.Y H:i', $def_p['woodoo3'])."','','0',event,this)\" width='40' height='40'>";;
}
else
{
	$dw3 = "<img src='images/ico_m4_p.jpg' alt=''  onMouseOver=\"doItem('totem','<br />Не действует','','0',event,this)\" width='40' height='40'>";
}
if ($bat_char['woodoo4_d'] > 0)
{
	$dw4 = "<img src='images/ico_m5_a.jpg' alt=''  onMouseOver=\"doItem('totem2','<br />Действует до ".date('j.m.Y H:i', $def_p['woodoo4'])."','','0',event,this)\" width='40' height='40'>";;
}
else
{
	$dw4 = "<img src='images/ico_m5_p.jpg' alt=''  onMouseOver=\"doItem('totem2','<br />Не действует','','0',event,this)\" width='40' height='40'>";
}
##############################
#################################
if ($bat_char['helmet_a'] > 0)
{
	$check_item = mysql_fetch_array(count_query("SELECT * FROM items_p WHERE uid='".$att_p['id_user']."' AND id='".$att_p['helmet']."'"));
	$check_items_p = mysql_fetch_array(count_query("SELECT * FROM item WHERE id='".$check_item['item_num']."'"));
	$ap = "<img src='images/items/".$check_items_p['sname'].".jpg' alt='' onMouseOver=\"doItem('".$check_items_p['id_i']."','','','0',event,this)\" width='40' height='40'>";;
}
else
{
	$ap = "<img src='images/ico_p2.jpg' alt='' width='40' height='40'>";
}
if ($bat_char['necklet_a'] > 0)
{
	$check_item2 = mysql_fetch_array(count_query("SELECT * FROM items_p WHERE uid='".$att_p['id_user']."' AND id='".$att_p['necklet']."'"));
	$check_items_p2 = mysql_fetch_array(count_query("SELECT * FROM item WHERE id='".$check_item2['item_num']."'"));
	$ap2 = "<img src='images/items/".$check_items_p2['sname'].".jpg' alt='' onMouseOver=\"doItem('".$check_items_p2['id_i']."','','','0',event,this)\" width='40' height='40'>";;
}
else
{
	$ap2 = "<img src='images/ico_p6.jpg' alt='' width='40' height='40'>";
}
if ($bat_char['weapon_a'] > 0)
{
	$check_item3 = mysql_fetch_array(count_query("SELECT * FROM items_p WHERE uid='".$att_p['id_user']."' AND id='".$att_p['weapon']."'"));
	$check_items_p3 = mysql_fetch_array(count_query("SELECT * FROM item WHERE id='".$check_item3['item_num']."'"));
	$ap3 = "<img src='images/items/".$check_items_p3['sname'].".jpg' alt='' onMouseOver=\"doItem('".$check_items_p3['id_i']."','','','0',event,this)\" width='40' height='40'>";;
}
else
{
	$ap3 = "<img src='images/ico_p3.jpg' alt='' width='40' height='40'>";
}
if ($bat_char['shield_a'] > 0)
{
	$check_item4 = mysql_fetch_array(count_query("SELECT * FROM items_p WHERE uid='".$att_p['id_user']."' AND id='".$att_p['shield']."'"));
	$check_items_p4 = mysql_fetch_array(count_query("SELECT * FROM item WHERE id='".$check_item4['item_num']."'"));
	$ap4 = "<img src='images/items/".$check_items_p4['sname'].".jpg' alt=''  onMouseOver=\"doItem('".$check_items_p4['id_i']."','','','0',event,this)\" width='40' height='40'>";;
}
else
{
	$ap4 = "<img src='images/ico_p4.jpg' alt=''width='40' height='40'>";
}
if ($bat_char['armor_a'] > 0)
{
	$check_item5 = mysql_fetch_array(count_query("SELECT * FROM items_p WHERE uid='".$att_p['id_user']."' AND id='".$att_p['armor']."'"));
	$check_items_p5 = mysql_fetch_array(count_query("SELECT * FROM item WHERE id='".$check_item5['item_num']."'"));
	$ap5 = "<img src='images/items/".$check_items_p5['sname'].".jpg' alt='' onMouseOver=\"doItem('".$check_items_p5['id_i']."','','','0',event,this)\" width='40' height='40'>";;
}
else
{
	$ap5 = "<img src='images/ico_p5.jpg' alt='' width='40' height='40'>";
}
###########
if ($bat_char['helmet_d'] > 0)
{
	$checki_item = mysql_fetch_array(count_query("SELECT * FROM items_p WHERE uid='".$def_p['id_user']."' AND id='".$def_p['helmet']."'"));
	$check_items_d = mysql_fetch_array(count_query("SELECT * FROM item WHERE id='".$checki_item['item_num']."'"));
	$dp = "<img src='images/items/".$check_items_d['sname'].".jpg' alt='' onMouseOver=\"doItem('".$check_items_d['id_i']."','','','0',event,this)\" width='40' height='40'>";;
}
else
{
	$dp = "<img src='images/ico_p2.jpg' alt='' width='40' height='40'>";
}
if ($bat_char['necklet_d'] > 0)
{
	$checki_item2 = mysql_fetch_array(count_query("SELECT * FROM items_p WHERE uid='".$def_p['id_user']."' AND id='".$def_p['necklet']."'"));
	$check_items_d2 = mysql_fetch_array(count_query("SELECT * FROM item WHERE id='".$checki_item2['item_num']."'"));
	$dp2 = "<img src='images/items/".$check_items_d2['sname'].".jpg' alt='' onMouseOver=\"doItem('".$check_items_d2['id_i']."','','','0',event,this)\" width='40' height='40'>";;
}
else
{
	$dp2 = "<img src='images/ico_p6.jpg' alt='' width='40' height='40'>";
}
if ($bat_char['weapon_d'] > 0)
{
	$checki_item3 = mysql_fetch_array(count_query("SELECT * FROM items_p WHERE uid='".$def_p['id_user']."' AND id='".$def_p['weapon']."'"));
	$check_items_d3 = mysql_fetch_array(count_query("SELECT * FROM item WHERE id='".$checki_item3['item_num']."'"));
	$dp3 = "<img src='images/items/".$check_items_d3['sname'].".jpg' alt='' onMouseOver=\"doItem('".$check_items_d3['id_i']."','','','0',event,this)\" width='40' height='40'>";;
}
else
{
	$dp3 = "<img src='images/ico_p3.jpg' alt='' width='40' height='40'>";
}
if ($bat_char['shield_d'] > 0)
{
	$checki_item4 = mysql_fetch_array(count_query("SELECT * FROM items_p WHERE uid='".$def_p['id_user']."' AND id='".$def_p['shield']."'"));
	$check_items_d4 = mysql_fetch_array(count_query("SELECT * FROM item WHERE id='".$checki_item4['item_num']."'"));
	$dp4 = "<img src='images/items/".$check_items_d4['sname'].".jpg' alt=''  onMouseOver=\"doItem('".$check_items_d4['id_i']."','','','0',event,this)\" width='40' height='40'>";;
}
else
{
	$dp4 = "<img src='images/ico_p4.jpg' alt=''width='40' height='40'>";
}
if ($bat_char['armor_d'] > 0)
{
	$checki_item5 = mysql_fetch_array(count_query("SELECT * FROM items_p WHERE uid='".$def_p['id_user']."' AND id='".$def_p['armor']."'"));
	$check_items_d5 = mysql_fetch_array(count_query("SELECT * FROM item WHERE id='".$checki_item5['item_num']."'"));
	$dp5 = "<img src='images/items/".$check_items_d5['sname'].".jpg' alt='' onMouseOver=\"doItem('".$check_items_d5['id_i']."','','','0',event,this)\" width='40' height='40'>";;
}
else
{
	$dp5 = "<img src='images/ico_p5.jpg' alt='' width='40' height='40'>";
}
##############################
#    Статы для атакующего    #
##############################
$pow_p = $bat_char['power_a'];
$defe_p = $bat_char['def_a'];
$abi_p = $bat_char['ability_a'];
$mas_p = $bat_char['mass_a'];
$ski_p = $bat_char['skill_a'];
if ($pow_p >= $defe_p && $pow_p >= $abi_p && $pow_p >= $mas_p && $pow_p >= $ski_p)
{
	$max = $pow_p;
}
if ($defe_p >= $pow_p && $defe_p >= $abi_p && $defe_p >= $mas_p && $defe_p >= $ski_p)
{
	$max = $defe_p;
}
if ($abi_p >= $defe_p && $abi_p >= $pow_p && $abi_p >= $mas_p && $abi_p >= $ski_p)
{
	$max = $abi_p;
}
if ($mas_p >= $defe_p && $mas_p >= $abi_p && $mas_p >= $pow_p && $mas_p >= $ski_p)
{
	$max = $mas_p;
}
if ($ski_p >= $defe_p && $ski_p >= $abi_p && $ski_p >= $mas_p && $ski_p >= $pow_p)
{
	$max = $ski_p;
}
$power_num = round((110*($max-$pow_p))/$max);
$def_num = round((110*($max-$defe_p))/$max);
$ability_num = round((110*($max-$abi_p))/$max);
$mass_num = round((110*($max-$mas_p))/$max);
$skill_num = round((110*($max-$ski_p))/$max);
##############################
#    Статы для защитника     #
##############################
$pow_p2 = $bat_char['power_d'];
$defe_p2 = $bat_char['def_d'];
$abi_p2 = $bat_char['ability_d'];
$mas_p2 = $bat_char['mass_d'];
$ski_p2 = $bat_char['skill_d'];
if ($pow_p2 >= $defe_p2 && $pow_p2 >= $abi_p2 && $pow_p2 >= $mas_p2 && $pow_p2 >= $ski_p2)
{
	$max2 = $pow_p2;
}
if ($defe_p2 >= $pow_p2 && $defe_p2 >= $abi_p2 && $defe_p2 >= $mas_p2 && $defe_p2 >= $ski_p2)
{
	$max2 = $defe_p2;
}
if ($abi_p2 >= $defe_p2 && $abi_p2 >= $pow_p2 && $abi_p2 >= $mas_p2 && $abi_p2 >= $ski_p2)
{
	$max2 = $abi_p2;
}
if ($mas_p2 >= $defe_p2 && $mas_p2 >= $abi_p2 && $mas_p2 >= $pow_p2 && $mas_p2 >= $ski_p2)
{
	$max2 = $mas_p2;
}
if ($ski_p2 >= $defe_p2 && $ski_p2 >= $abi_p2 && $ski_p2 >= $mas_p2 && $ski_p2 >= $pow_p2)
{
	$max2 = $ski_p2;
}
$power_num2 = round((110*($max2-$pow_p2))/$max2);
$def_num2 = round((110*($max2-$defe_p2))/$max2);
$ability_num2 = round((110*($max2-$abi_p2))/$max2);
$mass_num2 = round((110*($max2-$mas_p2))/$max2);
$skill_num2 = round((110*($max2-$ski_p2))/$max2);
?>
<tr>
        <td height="700" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class='blockHead'><img src='images/RU/titles/h_hodb.png' alt='Лог боя' /></div>
			
		<div class='contentBlock' id='contentBlock'></div>
<style>
TD.r2{text-align:right;padding-right:20px}
/*TD.r2 span{margin-left:20px}*/
</style>

&nbsp;
<table width="574" >
<tr>
	<td width="25">&nbsp;</td>
	<td width="257" valign="top">	<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'><div class='content'><div class='b2'><center style='margin:0 auto;'><table width="206" height="250" style='	border-collapse:collapse;'>
	<tr><td class='center row_4 h22' colspan=3 ><a href='player.php?id=<?=$att_p['id_user'];?>' class='profile ' ><?=$att_p['name'];?></a></td></tr>
	<tr><td  class='center row_1 h22 text_main_7' colspan=3><?=$cl;?></td></tr>
	<tr><td rowspan='2' width=40>
		<?=$as;?><br />
		<?=$aw;?><br />
		<?=$aw2;?><br />
		<?=$aw3;?><br />
		<?=$aw4;?>
	</td>
		<td width="126" height="160"><div class='avatar av_small'><div style='background: url(images/avatars/<?=$att_p['gender'];?>/s<?=$att_p['ava1'];?>.jpg)'><div style='background: url(images/avatars/<?=$att_p['gender'];?>/s<?=$att_p['ava2'];?>.png)'><div style='background: url(images/avatars/<?=$att_p['gender'];?>/s<?=$att_p['ava3'];?>.png)'></div></div></div></div></td>
	<td rowspan='2' width=40>
		<?=$ap;?><br />
		<?=$ap2;?><br />
		<?=$ap3;?><br />
		<?=$ap4;?><br />
		<?=$ap5;?>
	</td>

	<tr><td width="126" height="40">&nbsp;</td></tr>
</table><table width="206" class='playerStats'>
<tr><th colspan="5" class='blockTitle'>Способности:</th></tr>
<tr class='row_1'  onMouseOver="doItem('level','','','0',event,this)" >
	<td width=20><img src='images/ico_11.png' alt='Уровень' width='16' height='16' align='absmiddle' /></td>
	<td class='c2 center'  colspan='2'>Уровень</td>
	<td colspan='2' class='c4'><? echo $bat_char['lvl_a'];?>
</tr>
	<tr  onMouseOver="doItem('power','','','0',event,this)"  >
	<td><img src="images/ico_12.png" alt="Сила" class='ico'></td>
		<td class='right' colspan=2><span class='polzun'><img src='images/b2_2_2.gif' alt='' width='3'  /><img src='images/b2_3_2.gif' alt='' width='<?php echo 110-$power_num; ?>' /><img src='images/b2_4_2.gif' alt='' width='3'  /><img src='images/b2_5_2.gif' alt='' width='<?=$power_num;?>' /><img src='images/b2_6_2.gif' alt='' width='3' /></span></td>
		<td class='c4'><?=$bat_char['power_a'];?></td>
	</tr>	<tr  onMouseOver="doItem('block','','','0',event,this)"  class='row_1'>
	<td><img src="images/ico_13.png" alt="Защита" class='ico'></td>
		<td class='right' colspan=2><span class='polzun'><img src='images/b2_2_2.gif' alt='' width='3'  /><img src='images/b2_3_2.gif' alt='' width='<?php echo 110-$def_num; ?>' /><img src='images/b2_4_2.gif' alt='' width='3'  /><img src='images/b2_5_2.gif' alt='' width='<?=$def_num;?>' /><img src='images/b2_6_2.gif' alt='' width='3' /></span></td>
		<td class='c4'><?=$bat_char['def_a'];?></td>
	</tr>	<tr  onMouseOver="doItem('dexterity','','','0',event,this)"  >
	<td><img src="images/ico_14.png" alt="Ловкость" class='ico'></td>
		<td class='right' colspan=2><span class='polzun'><img src='images/b2_2_2.gif' alt='' width='3'  /><img src='images/b2_3_2.gif' alt='' width='<?php echo 110-$ability_num; ?>' /><img src='images/b2_4_2.gif' alt='' width='3'  /><img src='images/b2_5_2.gif' alt='' width='<?=$ability_num;?>' /><img src='images/b2_6_2.gif' alt='' width='3' /></span></td>
		<td class='c4'><?=$bat_char['ability_a'];?></td>
	</tr>	<tr  onMouseOver="doItem('endurance','','','0',event,this)"  class='row_1'>
	<td><img src="images/ico_15.png" alt="Масса" class='ico'></td>
		<td class='right' colspan=2><span class='polzun'><img src='images/b2_2_2.gif' alt='' width='3'  /><img src='images/b2_3_2.gif' alt='' width='<?php echo 110-$mass_num; ?>' /><img src='images/b2_4_2.gif' alt='' width='3'  /><img src='images/b2_5_2.gif' alt='' width='<?=$mass_num;?>' /><img src='images/b2_6_2.gif' alt='' width='3' /></span></td>
		<td class='c4'><?=$bat_char['mass_a'];?></td>
	</tr>	<tr  onMouseOver="doItem('charisma','','','0',event,this)"  >
	<td><img src="images/ico_16.png" alt="Мастерство" class='ico'></td>
		<td class='right' colspan=2><span class='polzun'><img src='images/b2_2_2.gif' alt='' width='3'  /><img src='images/b2_3_2.gif' alt='' width='<?php echo 110-$skill_num; ?>' /><img src='images/b2_4_2.gif' alt='' width='3'  /><img src='images/b2_5_2.gif' alt='' width='<?=$skill_num;?>' /><img src='images/b2_6_2.gif' alt='' width='3' /></span></td>
		<td class='c4'><?=$bat_char['skill_a'];?></td>
	</tr>
<tr class='row_1' >
	<td><img src='images/ico_23.png' alt='Здоровье' width='16' height='16' align='absmiddle' /></td>
	<td class='c2 center' colspan='2'>Здоровье</td>
	<td colspan='2' class='c4'> <?=$bat_char['hp_a'];?>
</tr>
</table>
</center></div></div></div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div></td>
	<td width="10">&nbsp;</td>
	<td width="257" valign="top">	<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'><div class='content'><div class='b2'><center style='margin:0 auto;'><table width="206" height="250" style='	border-collapse:collapse;'>
	<tr><td class='center row_4 h22' colspan=3 ><a href='/player.php?id=<?=$def_p['id_user'];?>' class='profile ' ><?=$def_p['name'];?></a></td></tr>
	<tr><td  class='center row_1 h22 text_main_7' colspan=3><?=$cl2;?></td></tr>
	<tr><td rowspan='2' width=40>
		<?=$ds;?><br />
		<?=$dw;?><br />
		<?=$dw2;?><br />
		<?=$dw3;?><br />
		<?=$dw4;?>
	</td>
		<td width="126" height="160"><div class='avatar av_small'><div style='background: url(images/avatars/<?=$def_p['gender'];?>/s<?=$def_p['ava1'];?>.jpg)'><div style='background: url(images/avatars/<?=$def_p['gender'];?>/s<?=$def_p['ava2'];?>.png)'><div style='background: url(images/avatars/<?=$def_p['gender'];?>/s<?=$def_p['ava3'];?>.png)'></div></div></div></div></td>
	<td rowspan='2' width=40>
		<?=$dp;?><br />
		<?=$dp2;?><br />
		<?=$dp3;?><br />
		<?=$dp4;?><br />
		<?=$dp5;?>
	</td>

	<tr><td width="126" height="40">&nbsp;</td></tr>
</table><table width="206" class='playerStats'>
<tr><th colspan="5" class='blockTitle'>Способности:</th></tr>
<tr class='row_1'  onMouseOver="doItem('level','','','0',event,this)" >
	<td width=20><img src='images/ico_11.png' alt='Уровень' width='16' height='16' align='absmiddle' /></td>
	<td class='c2 center'  colspan='2'>Уровень</td>
	<td colspan='2' class='c4'><? echo $bat_char['lvl_d'];?>
</tr>
	<tr  onMouseOver="doItem('power','','','0',event,this)"  >
	<td><img src="images/ico_12.png" alt="Сила" class='ico'></td>
		<td class='right' colspan=2><span class='polzun'><img src='images/b2_2_2.gif' alt='' width='3'  /><img src='images/b2_3_2.gif' alt='' width='<?php echo 110-$power_num2; ?>' /><img src='images/b2_4_2.gif' alt='' width='3'  /><img src='images/b2_5_2.gif' alt='' width='<?=$power_num2;?>' /><img src='images/b2_6_2.gif' alt='' width='3' /></span></td>
		<td class='c4'><?=$bat_char['power_d'];?></td>
	</tr>	<tr  onMouseOver="doItem('block','','','0',event,this)"  class='row_1'>
	<td><img src="images/ico_13.png" alt="Защита" class='ico'></td>
		<td class='right' colspan=2><span class='polzun'><img src='images/b2_2_2.gif' alt='' width='3'  /><img src='images/b2_3_2.gif' alt='' width='<?php echo 110-$def_num2; ?>' /><img src='images/b2_4_2.gif' alt='' width='3'  /><img src='images/b2_5_2.gif' alt='' width='<?=$def_num2;?>' /><img src='images/b2_6_2.gif' alt='' width='3' /></span></td>
		<td class='c4'><?=$bat_char['def_d'];?></td>
	</tr>	<tr  onMouseOver="doItem('dexterity','','','0',event,this)"  >
	<td><img src="images/ico_14.png" alt="Ловкость" class='ico'></td>
		<td class='right' colspan=2><span class='polzun'><img src='images/b2_2_2.gif' alt='' width='3'  /><img src='images/b2_3_2.gif' alt='' width='<?php echo 110-$ability_num2; ?>' /><img src='images/b2_4_2.gif' alt='' width='3'  /><img src='images/b2_5_2.gif' alt='' width='<?=$ability_num2;?>' /><img src='images/b2_6_2.gif' alt='' width='3' /></span></td>
		<td class='c4'><?=$bat_char['ability_d'];?></td>
	</tr>	<tr  onMouseOver="doItem('endurance','','','0',event,this)"  class='row_1'>
	<td><img src="images/ico_15.png" alt="Масса" class='ico'></td>
		<td class='right' colspan=2><span class='polzun'><img src='images/b2_2_2.gif' alt='' width='3'  /><img src='images/b2_3_2.gif' alt='' width='<?php echo 110-$mass_num2; ?>' /><img src='images/b2_4_2.gif' alt='' width='3'  /><img src='images/b2_5_2.gif' alt='' width='<?=$mass_num2;?>' /><img src='images/b2_6_2.gif' alt='' width='3' /></span></td>
		<td class='c4'><?=$bat_char['mass_d'];?></td>
	</tr>	<tr  onMouseOver="doItem('charisma','','','0',event,this)"  >
	<td><img src="images/ico_16.png" alt="Мастерство" class='ico'></td>
		<td class='right' colspan=2><span class='polzun'><img src='images/b2_2_2.gif' alt='' width='3'  /><img src='images/b2_3_2.gif' alt='' width='<?php echo 110-$skill_num2; ?>' /><img src='images/b2_4_2.gif' alt='' width='3'  /><img src='images/b2_5_2.gif' alt='' width='<?=$skill_num2;?>' /><img src='images/b2_6_2.gif' alt='' width='3' /></span></td>
		<td class='c4'><?=$bat_char['skill_d'];?></td>
	</tr>
<tr class='row_1' >
	<td><img src='images/ico_23.png' alt='Здоровье' width='16' height='16' align='absmiddle' /></td>
	<td class='c2 center' colspan='2'>Здоровье</td>
	<td colspan='2' class='c4'> <?=$bat_char['hp_d'];?>
</tr>
</table>
</center></div></div></div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div></td>
	<td width="25">&nbsp;</td>
</tr>

<tr>
 <td>&nbsp;</td>
 <td colspan="3" valign="top"><table width="524" border="0" cellpadding="0" cellspacing="0">
   <tr>
	 <td height="10" colspan="3"></td>
   </tr>
   <tr>
	 <td width="10" height="10" background="images/k01.png"></td>
	 <td background="images/k02.png"></td>
	 <td background="images/k03.png"></td>
   </tr>
   <tr>
	 <td background="images/k08.png">&nbsp;</td>
	 <td width="504" align="center" valign="top" background="images/k09.png"><table width="504" border="0" cellspacing="0" cellpadding="0">
	   <tr>
		 <td height="30" colspan="4" align="center" valign="middle" background="images/k11.png"><span class="text_main_5">Ход боя <?=date('H.i.s', $bat_char['time_b']);?> (<?=date('d.m.Y', $bat_char['time_b']);?>)</span></td>
	   </tr>
	   <tr>
		 <td width="21" height="23" background="images/k10.png">&nbsp;</td>
		 <td width="234" background="images/k10.png" class="text_main_4">Имя</td>
		 <td width="142" background="images/k10.png" class="text_main_4">Урон</td>
		 <td width="107" background="images/k10.png" class="text_main_4">Осталось здоровья</td>
	   </tr>
	   <tr>
		 <td height="23">&nbsp;</td>
		 <td class="text_main_5"><?=$att_p['name'];?> </td>
		 <td class="text_main_2"><?=$bat_char['damage_a'];?></td>
		 <td class="text_main_2"><?=$bat_char['hp_a'];?></td>
	   </tr>
	   <tr>
		 <td height="23">&nbsp;</td>
		 <td><span class="text_main_5"><?=$def_p['name'];?> </span></td>
		 <td><span class="text_main_2"><?=$bat_char['damage_d'];?></span></td>
		 <td><span class="text_main_2"><?=$bat_char['hp_d'];?></span></td>
	   </tr>
	   <tr>
		 <td height="23" background="images/k10.png">&nbsp;</td>
		 <td colspan="3" align="center" valign="middle" background="images/k10.png" class="text_main_2">Победитель<span class='text_main_5'><?=$bat_char['winer'];?></span></td>
	   </tr>
	   <tr>
		 <td height="23" background="images/k10.png">&nbsp;</td>
		 <td colspan="3" align="center" valign="middle" background="images/k10.png"><span class='text_main_5_2'><?=$bat_char['winer'];?> </span><span class='text_main_2'>получил  <?php if ($bat_char['gold'] > 0) { echo $bat_char['gold']." <img src='/images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'>"; } ?> <?php if ($bat_char['exp'] > 0) { echo $bat_char['exp']." <img src='/images/ico_21.png' alt='Опыт' width='16' height='16' align='absmiddle' />"; }?></span></td>
	   </tr>
	 </table></td>
	 <td background="images/k04.png">&nbsp;</td>
   </tr>
   <tr>
	 <td background="images/k07.png"></td>
	 <td background="images/k06.png"></td>
	 <td width="10" height="10" background="images/k05.png"></td>
   </tr>

 </table></td>
 <td>&nbsp;</td>
  </tr>
<tr><td>&nbsp;</td><td colspan="3" valign="top">	<div class='inputGroup inputSmall inputNoHeight ' >
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1' >
			<div class='content' ><div class='title'>Подробное описание боя:</div><div class='body'>
				<table class='default h20'>
					<?php
					$zap_words = count_query("SELECT * FROM `words` WHERE id_bat='".$uid."'");
					$ind = 0;
					while ($row_words = mysql_fetch_array($zap_words))
					{
						if ($ind > 1)
						{
							$ind = 0;
						}
						if ($row_words['damage'] == 0)
						{
							$wr_words = "<b>".$row_words['plo']."</b> промахивается <b>".$row_words['plt']."</b>.";
						}
						else
						{
							$wr_words = $row_words['text'];
						}
						echo "<tr><td class='row_".$ind." text_main_2'>".$wr_words." (<b>".$row_words['damage']."</b>)</td></tr>";
						$ind++;
					}
					
					?>
					<tr><td class='row_1 text_main_2'></td></tr></table></div></div>
		</div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
</td><td>&nbsp;</td>
  </tr>
</table>
<br />
	</td></tr>
<?php include("footer_tpl.php"); ?>