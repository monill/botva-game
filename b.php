<?php
include ("top_tpl.php");

if (/*!$_POST['do_searchm'] OR */$_SERVER['HTTP_REFERER'] != "http://".$_SERVER['HTTP_HOST']."/dozor.php")
{
	echo "<script>location.href='game.php';</script>";
}

$char_b = mysql_fetch_array(count_query("SELECT * FROM users WHERE id_user = '".$_GET['id']."'"));
if ($char_b['clan'] == 0)
{
	$clan_t =  "Не состоит в клане";
}
else
{
	$row_clan_p = mysql_fetch_array(count_query("SELECT * FROM clans WHERE id = '".$char_b['clan']."'"));
	$clan_t = "<a href='/clan.php?id=".$row_clan_p['id']."'  class='profile '>".$row_clan_p['name']."</a>";
}

if ($char_b['power'] >= $char_b['def'] && $char_b['power'] >= $char_b['ability'] && $char_b['power'] >= $char_b['mass'] && $char_b['power'] >= $char_b['skill'])
{
	$max = $char_b['power'];
}
if ($char_b['def'] >= $char_b['power'] && $char_b['def'] >= $char_b['ability'] && $char_b['def'] >= $char_b['mass'] && $char_b['def'] >= $char_b['skill'])
{
	$max = $char_b['def'];
}
if ($char_b['ability'] >= $char_b['def'] && $char_b['ability'] >= $char_b['power'] && $char_b['ability'] >= $char_b['mass'] && $char_b['ability'] >= $char_b['skill'])
{
	$max = $char_b['ability'];
}
if ($char_b['mass'] >= $char_b['def'] && $char_b['mass'] >= $char_b['ability'] && $char_b['mass'] >= $char_b['power'] && $char_b['mass'] >= $char_b['skill'])
{
	$max = $char_b['mass'];
}
if ($char_b['skill'] >= $char_b['def'] && $char_b['skill'] >= $char_b['ability'] && $char_b['skill'] >= $char_b['mass'] && $char_b['skill'] >= $char_b['power'])
{
	$max = $char_b['skill'];
}

$power_num = round((150*($max-$char_b['power']))/$max);
$def_num = round((150*($max-$char_b['def']))/$max);
$ability_num = round((150*($max-$char_b['ability']))/$max);
$mass_num = round((150*($max-$char_b['mass']))/$max);
$skill_num = round((150*($max-$char_b['skill']))/$max);	
?>	
<tr>
        <td height="700" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class='blockHead'><img src='images/RU/titles/h_dozor.png' alt='Бодалка' /></div>
			
		<div class='contentBlock' id='contentBlock'><a href='dozor.php' class='back'><img src='images/RU/b_back_p.png' alt='Назад' class='cmd'
								onMouseOver="doImage(this,'RU/b_back')" /></a><br /><br />	<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'><div class='content'><div class='b2'>
			<table class='attack'>
			<tr><td class='left' rowspan='2'>
				<div class='avatar'><div style='background: url(images/avatars/<?=$char_b['gender'];?>/<?=$char_b['ava1'];?>.jpg)'><div style='background: url(images/avatars/<?=$char_b['gender'];?>/<?=$char_b['ava2'];?>.png)'><div style='background: url(images/avatars/<?=$char_b['gender'];?>/<?=$char_b['ava3'];?>.png)'></div></div></div></div>
				<img src='images/RU/b_moral_b.png' alt='мораль - в разработке' class='moral'/>
				</td>
				<td class='right info'>
					<div class='blockTitle2 '><?=$char_b['name']?></div>
					<div class='blockTitle nobold'><?=$clan_t?></div>
				</td>
			</tr>
			<tr><td valign='middle' class='enemy_message text_main_4' >
					<div class='enemy_message'><?=$char_b['att_description'];?></div>
				</td>
			</tr>
			<tr><td class='left'>	
				<td class='right'>	
    <table class='skills'>
    <tr><th colspan='5' class='blockTitle'>Способности</th></tr>
    <tr	class='row_1'>
	    <td class='c1'><img src="images/ico_11.png" alt="Уровень" class='ico'></td>
	    <td class='c2 left'>Уровень
	    <td class='center'><?php echo lvl($char_b['exp']); ?>
	    <td>
    </tr>
	    <tr >
	    <td><img src="images/ico_12.png" alt="Сила" class='ico'></td>
		    <td class='left'>Сила</td>
		    <td class='c3'><span class='polzun'><img src='images/b2_2.gif' alt='' width='3'  /><img src='images/b2_3.gif' alt='' width='<?php echo 150-$power_num; ?>' /><img src='images/b2_4.gif' alt='' width='3'  /><img src='images/b2_5.gif' alt='' width='<?=$power_num;?>' /><img src='images/b2_6.gif' alt='' width='3' /></span></td>
		    <td class='c4'><?=$char_b['power']?></td>
	    </tr>	    <tr class='row_1'>
	    <td><img src="images/ico_13.png" alt="Защита" class='ico'></td>
		    <td class='left'>Защита</td>
		    <td class='c3'><span class='polzun'><img src='images/b2_2.gif' alt='' width='3'  /><img src='images/b2_3.gif' alt='' width='<?php echo 150-$def_num; ?>' /><img src='images/b2_4.gif' alt='' width='3'  /><img src='images/b2_5.gif' alt='' width='<?=$def_num;?>' /><img src='images/b2_6.gif' alt='' width='3' /></span></td>
		    <td class='c4'><?=$char_b['def']?></td>
	    </tr>	    <tr >
	    <td><img src="images/ico_14.png" alt="Ловкость" class='ico'></td>
		    <td class='left'>Ловкость</td>
		    <td class='c3'><span class='polzun'><img src='images/b2_2.gif' alt='' width='3'  /><img src='images/b2_3.gif' alt='' width='<?php echo 150-$ability_num; ?>' /><img src='images/b2_4.gif' alt='' width='3'  /><img src='images/b2_5.gif' alt='' width='<?=$ability_num;?>' /><img src='images/b2_6.gif' alt='' width='3' /></span></td>
		    <td class='c4'><?=$char_b['ability']?></td>
	    </tr>	    <tr class='row_1'>
	    <td><img src="images/ico_15.png" alt="Масса" class='ico'></td>
		    <td class='left'>Масса</td>
		    <td class='c3'><span class='polzun'><img src='images/b2_2.gif' alt='' width='3'  /><img src='images/b2_3.gif' alt='' width='<?php echo 150-$mass_num; ?>' /><img src='images/b2_4.gif' alt='' width='3'  /><img src='images/b2_5.gif' alt='' width='<?=$mass_num;?>' /><img src='images/b2_6.gif' alt='' width='3' /></span></td>
		    <td class='c4'><?=$char_b['mass']?></td>
	    </tr>	    <tr >
	    <td><img src="images/ico_16.png" alt="Мастерство" class='ico'></td>
		    <td class='left'>Мастерство</td>
		    <td class='c3'><span class='polzun'><img src='images/b2_2.gif' alt='' width='3'  /><img src='images/b2_3.gif' alt='' width='<?php echo 150-$skill_num; ?>' /><img src='images/b2_4.gif' alt='' width='3'  /><img src='images/b2_5.gif' alt='' width='<?=$skill_num;?>' /><img src='images/b2_6.gif' alt='' width='3' /></span></td>
		    <td class='c4'><?=$char_b['skill']?></td>
	    </tr>

    <tr class='row_1'><td><img src='images/ico_17.png' alt='Слава' class='ico'></td>
	    <td class='left'>Слава
	    <td class='center'><?=$char_b['glory']?>
	    <td>
    </tr>
	</table>
			</tr>
			</table>
			</div></div></div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div><span class='text_main_5'><span class='num_zero'></span></span><br /><br />
	<form method='POST' action='dozor.php'>
					<input type='hidden' name='char_id' value='<?=$char_b['id_user'];?>'>
					<input type='hidden' name='type' 	value='same'>
					<input type='hidden' name='min' 	value='0'>
					<input type='hidden' name='max' 	value='3'>
					<input type='hidden' name='do_attack' 	value='1'>
			<input type='image' name='do_attack' class='image cmd' src='images/RU/b_nap_p.png' alt='напасть'
					onMouseOver="doImage(this,'RU/b_nap',null)"/ >
					</form>
					<form method='POST' action='dozor.php'>
					<input type='hidden' name='do_searchm'>
					<input type='image' name='do_search' class='image cmd' src='images/RU/b_newfind_p.png' alt='новый поиск'
					onMouseOver="doImage(this,'RU/b_newfind',null)"/ ></form></div>	</td></tr>
<?php include ("footer_tpl.php"); ?>	