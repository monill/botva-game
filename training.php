<?php
include("top_tpl.php"); 

$work = mysql_fetch_array(count_query("SELECT * FROM `action` WHERE `uid` = '".$row['id_user']."'"));

$pow_cost = training_cost($row['power'],'pow');
$def_cost = training_cost($row['def'],'def');
$abi_cost = training_cost($row['ability'],'abi');
$mass_cost = training_cost($row['mass'],'mass');
$skill_cost = training_cost($row['skill'],'skill');

$p = $_POST['val'];

if ($work['id'] == null && isset($p))
{
if ($p == 01 && $row['gold'] >= $pow_cost)
{
	count_query("UPDATE users SET  power=power+1, gold=gold-'".$pow_cost."' WHERE email = '".$_SESSION['email']."'");
	echo "<script>location.href='training.php';</script>";
	exit;
}
else
{
	$mes = "<div class='message'>В данный момент вы работаете работу. Вернитесь позже.</div>";
}
if ($p == 02 && $row['gold'] >= $def_cost)
{
	count_query("UPDATE users SET  def=def+1, gold=gold-'".$def_cost."' WHERE email = '".$_SESSION['email']."'");
	echo "<script>location.href='training.php';</script>";
	exit;
}
else
{
	$mes = "<div class='message'>В данный момент вы работаете работу. Вернитесь позже.</div>";
}
if ($p == 03 && $row['gold'] >= $abi_cost)
{
	count_query("UPDATE users SET  ability=ability+1, gold=gold-'".$abi_cost."' WHERE email = '".$_SESSION['email']."'");
	echo "<script>location.href='training.php';</script>";
	exit;
}
else
{
	$mes = "<div class='message'>В данный момент вы работаете работу. Вернитесь позже.</div>";
}
if ($p == 04 && $row['gold'] >= $mass_cost)
{
	$hp = ($row['mass']-4)*5;
	count_query("UPDATE users SET  mass=mass+1, hp=hp+'".$hp."', gold=gold-'".$mass_cost."' WHERE email = '".$_SESSION['email']."'");
	echo "<script>location.href='training.php';</script>";
	exit;
}
else
{
	$mes = "<div class='message'>В данный момент вы работаете работу. Вернитесь позже.</div>";
}
if ($p == 05 && $row['gold'] >= $skill_cost)
{
	count_query("UPDATE users SET  skill=skill+1, gold=gold-'".$skill_cost."' WHERE email = '".$_SESSION['email']."'");
	echo "<script>location.href='training.php';</script>";
	exit;
}
else
{
	$mes = "<div class='message'>В данный момент вы работаете работу. Вернитесь позже.</div>";
}
}
######################
######################
$pow_p = $row['power'];
$def_p = $row['def'];
$abi_p = $row['ability'];
$mas_p = $row['mass'];
$ski_p = $row['skill'];

if ($pow_p >= $def_p && $pow_p >= $abi_p && $pow_p >= $mas_p && $pow_p >= $ski_p)
{
	$max = $pow_p;
}
if ($def_p >= $pow_p && $def_p >= $abi_p && $def_p >= $mas_p && $def_p >= $ski_p)
{
	$max = $def_p;
}
if ($abi_p >= $def_p && $abi_p >= $pow_p && $abi_p >= $mas_p && $abi_p >= $ski_p)
{
	$max = $abi_p;
}
if ($mas_p >= $def_p && $mas_p >= $abi_p && $mas_p >= $pow_p && $mas_p >= $ski_p)
{
	$max = $mas_p;
}
if ($ski_p >= $def_p && $ski_p >= $abi_p && $ski_p >= $mas_p && $ski_p >= $pow_p)
{
	$max = $ski_p;
}

$power_num = round((240*($max-$pow_p))/$max);
$def_num = round((240*($max-$def_p))/$max);
$ability_num = round((240*($max-$abi_p))/$max);
$mass_num = round((240*($max-$mas_p))/$max);
$skill_num = round((240*($max-$ski_p))/$max);
?>
<tr>
        <td height="750" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<table width="574" height="70" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="52" height="60">&nbsp;</td>
      <td width="470" height="60" align="center" valign="top" background="images/bg_head.png"><img src="images/RU/titles/h_tren.png" alt="Тренировка" width="201" height="29" vspace="10" /></td>
      <td width="52">&nbsp;</td>
    </tr>
    <tr>
      <td height="10" colspan="3"></td>
    </tr>
  </table>
<table width="574" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="25" rowspan="4">&nbsp;</td>
    <td colspan="3" align="center" valign="top" ><table width="524" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="200" height="200" rowspan="3" align="center" valign="middle"><img src="images/tr_man.jpg" alt="Тренер Шварцбургер" width="200" height="200"></td>
        <td width="10" height="10" align="center" background="images/k01.png"></td>
        <td width="304" align="center" background="images/k02.png"></td>
        <td width="10" align="center" background="images/k03.png"></td>
      </tr>

      <tr>
        <td height="180" background="images/k08.png">&nbsp;</td>
        <td align="center" valign="middle" background="images/k09.png"><table width="304" height="180" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="25" align="center" valign="middle" background="images/k11.png"><span class="text_main_5">Тренер Шварцбургер</span></td>
          </tr>
          <tr>
            <td height="146" align="center" valign="middle"><span class="text_main_4">Айн Швайц!<br><br>Что за пузо, что за ноги, что за тухлое чудовище  пришло ко мне принять на грудь? Да не чарочку эля, тьфу ты, а пудов тридцать  железа для порядку!<br><br>Ах да, и прежде, чем тянуть ведро с цементом, марш двенадцать кругов вокруг дерева!</span></td>
          </tr>
        </table></td>
        <td background="images/k04.png">&nbsp;</td>
      </tr>
      <tr>
        <td width="10" height="10" background="images/k07.png"></td>
        <td background="images/k06.png"></td>
        <td background="images/k05.png"></td>
      </tr>
    </table>
	<?=$mes;?>
	</td>
    <td width="25" rowspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td width="10" height="10" background="images/k01.png"></td>
    <td background="images/k02.png"></td>
    <td width="10" background="images/k03.png"></td>
  </tr>
  <tr>
    <td background="images/k08.png"></td>
    <td width="504" align="left" valign="top" background="images/k09.png"><table width="504" height="230" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="25" colspan="3" align="center" valign="middle" background="images/k11.png" div="div"><span class="text_main_1">Способности:</span><span class="text_main_4"></span> </td>
      </tr>
	<tr class='row_1 center' height="25">
	<td width="115" class="text_main_5">&nbsp;Сила</td>
	<td width="255"><span class='polzun'><img src='images/b2_2.gif' alt='' width='3'  /><img src='images/b2_3.gif' alt='' width='<?php echo 240-$power_num; ?>' /><img src='images/b2_4.gif' alt='' width='3'  /><img src='images/b2_5.gif' alt='' width='<?=$power_num;?>' /><img src='images/b2_6.gif' alt='' width='3' /></span> </td>
	<td width="112"><span class="text_main_7"><?=$pow_cost;?> <img src='/images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'></span></td>
</tr>
<tr class='center'>
	<td width="115" height="42" class="text_main_7">&nbsp;<?php echo $row['power'];?></td>
	<td class="text_main_4">Сила определяет урон наносимый противнику.<br /> </td>
	<td align="center" valign="middle">
	<?php
	if ($row['gold'] < $pow_cost)
	{
		echo "<img src='images/RU/b_upst_b.png' alt='Улучшить' class='cmd' >";
	}
	else
	{
		echo "<form method='post' action=''><input type='hidden' name='val' value='01'><input type='image' src='images/RU/b_upst_p.png' alt='Улучшить' class='image cmd' onMouseOver=\"doImage(this,'RU/b_upst','skip')\" /></form>";
	}
	?>
	</td>
</tr>
<tr class='row_1 center' height="25">
	<td width="115" class="text_main_5">&nbsp;Защита</td>
	<td width="255"><span class='polzun'><img src='images/b2_2.gif' alt='' width='3'  /><img src='images/b2_3.gif' alt='' width='<?php echo 240-$def_num; ?>' /><img src='images/b2_4.gif' alt='' width='3'  /><img src='images/b2_5.gif' alt='' width='<?=$def_num; ?>' /><img src='images/b2_6.gif' alt='' width='3' /></span> </td>
	<td width="112"><span class="text_main_7"><?=$def_cost;?> <img src='/images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'></span></td>
</tr>
<tr class='center'>
	<td width="115" height="42" class="text_main_7">&nbsp;<?php echo $row['def'];?></td>
	<td class="text_main_4">Защита определяет урон, который вы можете заблокировать.<br /> </td>
	<td align="center" valign="middle">
	<?php
	if ($row['gold'] < $def_cost)
	{
		echo "<img src='images/RU/b_upst_b.png' alt='Улучшить' class='cmd' >";
	}
	else
	{
		echo "<form method='post' action=''><input type='hidden' name='val' value='02'><input type='image' src='images/RU/b_upst_p.png' alt='Улучшить' class='image cmd' onMouseOver=\"doImage(this,'RU/b_upst','skip')\" /></form>";
	}
	?>
	</td>
</tr>
<tr class='row_1 center' height="25">
	<td width="115" class="text_main_5">&nbsp;Ловкость</td>
	<td width="255"><span class='polzun'><img src='images/b2_2.gif' alt='' width='3'  /><img src='images/b2_3.gif' alt='' width='<?php echo 240-$ability_num; ?>' /><img src='images/b2_4.gif' alt='' width='3'  /><img src='images/b2_5.gif' alt='' width='<?=$ability_num; ?>' /><img src='images/b2_6.gif' alt='' width='3' /></span> </td>
	<td width="112"><span class="text_main_7"><?=$abi_cost;?> <img src='/images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'></span></td>
</tr>
<tr class='center'>
	<td width="115" height="42" class="text_main_7">&nbsp;<?php echo $row['ability'];?></td>
	<td class="text_main_4">Ловкость определяет вероятность увернуться от удара противника.<br /> </td>
	<td align="center" valign="middle">
	<?php
	if ($row['gold'] < $abi_cost)
	{
		echo "<img src='images/RU/b_upst_b.png' alt='Улучшить' class='cmd' >";
	}
	else
	{
		echo "<form method='post' action=''><input type='hidden' name='val' value='03'><input type='image' src='images/RU/b_upst_p.png' alt='Улучшить' class='image cmd' onMouseOver=\"doImage(this,'RU/b_upst','skip')\" /></form>";
	}
	?>
	</td>
</tr>
<tr class='row_1 center' height="25">
	<td width="115" class="text_main_5">&nbsp;Масса</td>
	<td width="255"><span class='polzun'><img src='images/b2_2.gif' alt='' width='3'  /><img src='images/b2_3.gif' alt='' width='<?php echo 240-$mass_num; ?>' /><img src='images/b2_4.gif' alt='' width='3'  /><img src='images/b2_5.gif' alt='' width='<?=$mass_num; ?>' /><img src='images/b2_6.gif' alt='' width='3' /></span> </td>
	<td width="112"><span class="text_main_7"><?=$mass_cost;?> <img src='/images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'></span></td>
</tr>
<tr class='center'>
	<td width="115" height="42" class="text_main_7">&nbsp;<?php echo $row['mass'];?></td>
	<td class="text_main_4">Масса определяет здоровье и скорость его восстановления.<br /> </td>
	<td align="center" valign="middle">
	<?php
	if ($row['gold'] < $mass_cost)
	{
		echo "<img src='images/RU/b_upst_b.png' alt='Улучшить' class='cmd' >";
	}
	else
	{
		echo "<form method='post' action=''><input type='hidden' name='val' value='04'><input type='image' src='images/RU/b_upst_p.png' alt='Улучшить' class='image cmd' onMouseOver=\"doImage(this,'RU/b_upst','skip')\" /></form>";
	}
	?>
	</td>
</tr>
<tr class='row_1 center' height="25">
	<td width="115" class="text_main_5">&nbsp;Мастерство</td>
	<td width="255"><span class='polzun'><img src='images/b2_2.gif' alt='' width='3'  /><img src='images/b2_3.gif' alt='' width='<?php echo 240-$skill_num; ?>' /><img src='images/b2_4.gif' alt='' width='3'  /><img src='images/b2_5.gif' alt='' width='<?=$skill_num; ?>' /><img src='images/b2_6.gif' alt='' width='3' /></span> </td>
	<td width="112"><span class="text_main_7"><?=$skill_cost;?> <img src='/images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'></span></td>
</tr>
<tr class='center'>
	<td width="115" height="42" class="text_main_7">&nbsp;<?php echo $row['skill'];?></td>
	<td class="text_main_4">Мастерство определяет возможность нанести противнику два удара подряд.<br /> </td>
	<td align="center" valign="middle">
	<?php
	if ($row['gold'] < $skill_cost)
	{
		echo "<img src='images/RU/b_upst_b.png' alt='Улучшить' class='cmd' >";
	}
	else
	{
		echo "<form method='post' action=''><input type='hidden' name='val' value='05'><input type='image' src='images/RU/b_upst_p.png' alt='Улучшить' class='image cmd' onMouseOver=\"doImage(this,'RU/b_upst','skip')\" /></form>";
	}
	?>
	</td>
</tr>



    </table></td>
    <td background="images/k04.png">&nbsp;</td>
  </tr>
  <tr>
    <td height="10" background="images/k07.png"></td>
    <td background="images/k06.png"></td>
    <td background="images/k05.png"></td>
  </tr>
</table>
<br>
<a href='game.php' class='back'><img src='images/RU/b_back_p.png' alt='Назад' class='cmd'
								onMouseOver="doImage(this,'RU/b_back')" /></a>	</td></tr>
<?php include("footer_tpl.php"); ?>