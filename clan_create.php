<?php
include ("top_tpl.php");

if ($row['clan'] != 0)
{
	$c = true;
}
else
{
	$c = false;
}

if (isset($_POST['create']))
{
	if (strlen ($_POST['name'])<2 || strlen ($_POST['name'])>22) {
		$err = "<div class='message'>Имя должно быть от 2 до 22 символов!</div>";
		$c = false;
	} else if (strlen ($_POST['tag'])<2 || strlen ($_POST['tag'])>8) {
		$err = "<div class='message'>Тег должно быть от 2 до 8 символов!</div>";
		$c = false;
	}
	$c_n = mysql_fetch_array(count_query("SELECT id FROM clans"));
	if ($c_n['name'] == $_POST['name'])
	{
		$err = "<div class='message'>Ты не оригинален. Такое имя уже есть!</div>";
		$c = false;
	}
	if ($c_n['tag'] == $_POST['tag'])
	{
		$err = "<div class='message'>Ты не оригинален. Такой тег уже есть!</div>";
		$c = false;
	}
	if ($err == "")
	{
		$c = true;
		count_query("INSERT INTO `clans` (`name`, `race`, `tag`, `glory`) VALUES ('".$_POST['name']."', '".$row['race']."', '".$_POST['tag']."', '10')");
		$clan_mem = mysql_fetch_array(count_query("SELECT * FROM clans WHERE name='".$_POST['name']."'"));
		count_query("UPDATE `users` SET clan = '".$clan_mem['id']."', clan_stat= 'Вождь' WHERE email='".$_SESSION['email']."'");
	}
}
$compl = "<div class='contentBlock' id='contentBlock'>	<div class='inputGroup inputSmall inputNoHeight ' >
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1' >
			<div class='content' ><div class='body'>Замок клана построен! Быстро правда?<br /><br /></div></div>
		</div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
		</div>";
?>
<tr>
        <td height="750" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class='blockHead'><img src='images/RU/titles/h_clan.png' alt='Клан' /></div>
		<?php
		if ($c == false)
		{
		?>
		<div class='contentBlock' id='contentBlock'><a href='clan.php' class='back'><img src='images/RU/b_back_p.png' alt='Назад' class='cmd'
								onMouseOver="doImage(this,'RU/b_back')" /></a></div>
								<?=$err;?>
								<form method="post" action="clan_create.php">
<table width="574" border="0" cellspacing="0" cellpadding="0">
 <tr>
   <td width="25" rowspan="3">				</td>
   <td width="10" height="10" background="images/k01.png"></td>
   <td background="images/k02.png"></td>
   <td width="10" background="images/k03.png"></td>
   <td width="25" rowspan="3"></td>
 </tr>
 <tr>
   <td background="images/k08.png">&nbsp;</td>
   <td align="left" valign="top" background="images/k09.png"><table width="504" border="0" align="center" cellpadding="0" cellspacing="0">
<tbody>
<tr>
 <td height="30" align="center" valign="middle" class="text_main_1" >Полное название: </td>
</tr>

<tr><td height="20" align="center" valign="middle" class="text_main_2" >
	<input name="name" type="text" id="name" maxlength="22" size="25" value=""></td>
</tr>
<tr><td height="20" align="center" valign="middle" class="text_main_3" >(2-22 символов)</td></tr>
<tr><td height="30" align="center" valign="middle" class="text_main_1" >Короткое название(ТЭГ):</td></tr>
<tr><td height="20" align="center" valign="middle" class="text_main_2" >
	<input name="tag" type="text" id="tag" maxlength="8" size="25" value="">	</td>
</tr>
<tr><td height="20" align="center" valign="middle" class="text_main_3" >(2-8 символов)</td></tr>
<tr>
 <td height="40" align="center" valign="middle" class="text_main_2" >
 <input type='hidden' name='create'>
 <input type='image' name='submit' class='image cmd' src='images/RU/b_clan_crt_p.png' alt='создать'
					onMouseOver="doImage(this,'RU/b_clan_crt',null)"/ ></td>
</tr>
       </tbody>
   </table></td>
   <td background="images/k04.png">&nbsp;</td>
 </tr>
 <tr>
   <td height="10" background="images/k07.png"></td>
   <td background="images/k06.png"></td>
   <td background="images/k05.png"></td>
 </tr>
 <tr>
   <td height="20" colspan="5"></td>
 </tr>
</table>
</form>
<?php
}
else
{
echo $compl;
echo "</div>";
}
?>
</td></tr>
<?php
include ("footer_tpl.php");
?>
