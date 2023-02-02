<?php
include ("top_tpl.php");

	$d = $row['description'];
	##########
	#  ТЕГИ  #
	##########
	$d = str_replace('<B>','[B]',$d);
	$d = str_replace('</B>','[/B]',$d);
	$d = str_replace('<U>','[U]',$d);
	$d = str_replace('</U>','[/U]',$d);
	$d = str_replace('<I>','[I]',$d);
	$d = str_replace('</I>','[/I]',$d);
	$d = str_replace('<span class=size_1>','[SIZE=1]',$d);
	$d = str_replace('<span class=size_2>','[SIZE=2]',$d);
	$d = str_replace('</span>','[/ENDTAG]',$d);
	$d = str_replace('<div class=LEFT>','[LEFT]',$d);
	$d = str_replace('<div class=RIGHT>','[RIGHT]',$d);
	$d = str_replace('<div class=CENTER>','[CENTER]',$d);
	$d = str_replace('</div>','[/END]',$d);
	/*$preg = preg_replace("/^(\<a href\=player.php\?id=)([0-9]+)\s(class=profile>)([\S]+)(<\/a>)$/","[CHAR=\$2]",$d);
	$d = $preg;*/
	$color = preg_replace("/(\<span style=color:#)([\S]+)(>)/","[COLOR=\$2]",$d);
	$d = $color;
	$d = str_replace('<br />','',$d);
	##########
	#  /ТЕГИ #
	##########



	$ad = $row['att_description'];
	##########
	#  ТЕГИ  #
	##########
	$ad = str_replace('<B>','[B]',$ad);
	$ad = str_replace('</B>','[/B]',$ad);
	$ad = str_replace('<U>','[U]',$ad);
	$ad = str_replace('</U>','[/U]',$ad);
	$ad = str_replace('<I>','[I]',$ad);
	$ad = str_replace('</I>','[/I]',$ad);
	$ad = str_replace('<span class=size_1>','[SIZE=1]',$ad);
	$ad = str_replace('<span class=size_2>','[SIZE=2]',$ad);
	$ad = str_replace('</span>','[/ENDTAG]',$ad);
	$ad = str_replace('<div class=LEFT>','[LEFT]',$ad);
	$ad = str_replace('<div class=RIGHT>','[RIGHT]',$ad);
	$ad = str_replace('<div class=CENTER>','[CENTER]',$ad);
	$ad = str_replace('</div>','[/END]',$ad);
	/*$preg = preg_replace("/^(\<a href\=player.php\?id=)([0-9]+)\s(class=profile>)([\S]+)(<\/a>)$/","[CHAR=\$2]",$ad);
	$ad = $preg;*/
	$color2 = preg_replace("/(\<span style=color:#)([\S]+)(>)/","[COLOR=\$2]",$ad);
	$ad = $color2;
	$ad = str_replace('<br />','',$ad);
	##########
	#  /ТЕГИ #
	##########


if (isset($_GET['rtype']))
{
	##########
	#  ТЕГИ  #
	##########
	$_POST['description'] = str_replace('[B]','<B>',$_POST['description']);
	$_POST['description'] = str_replace('[/B]','</B>',$_POST['description']);
	$_POST['description'] = str_replace('[U]','<U>',$_POST['description']);
	$_POST['description'] = str_replace('[/U]','</U>',$_POST['description']);
	$_POST['description'] = str_replace('[I]','<I>',$_POST['description']);
	$_POST['description'] = str_replace('[/I]','</I>',$_POST['description']);
	$_POST['description'] = str_replace('[SIZE=1]','<span class=size_1>',$_POST['description']);
	$_POST['description'] = str_replace('[/SIZE]','</span>',$_POST['description']);
	$_POST['description'] = str_replace('[SIZE=2]','<span class=size_2>',$_POST['description']);
	$_POST['description'] = str_replace('[/ENDTAG]','</span>',$_POST['description']);
	$_POST['description'] = str_replace('[LEFT]','<div class=LEFT>',$_POST['description']);
	$_POST['description'] = str_replace('[/END]','</div>',$_POST['description']);
	$_POST['description'] = str_replace('[RIGHT]','<div class=RIGHT>',$_POST['description']);
	$_POST['description'] = str_replace('[CENTER]','<div class=CENTER>',$_POST['description']);
	/*$preg = preg_replace("/(\[CHAR=)([0-9]+)(\])/","\$2",$_POST['description']);
	$ulink = mysql_result(count_query("SELECT name FROM `users` WHERE `id_user`='".$preg."'"),0);
	$_POST['description'] = preg_replace("/(\[CHAR=)([0-9]+)(\])/","<a href=player.php?id=\$2 class=profile>".$ulink."</a>",$_POST['description']);*/
	$_POST['description'] = preg_replace("/(\[COLOR\=)([\S]+)(\])/","<span style=color:#\$2>",$_POST['description']);
	$_POST['description'] = str_replace('[/COLOR]','</span>',$_POST['description']);
	$_POST['description'] = nl2br($_POST['description']);
	
	$_POST['message_for_victim'] = str_replace('[B]','<B>',$_POST['message_for_victim']);
	$_POST['message_for_victim'] = str_replace('[/B]','</B>',$_POST['message_for_victim']);
	$_POST['message_for_victim'] = str_replace('[U]','<U>',$_POST['message_for_victim']);
	$_POST['message_for_victim'] = str_replace('[/U]','</U>',$_POST['message_for_victim']);
	$_POST['message_for_victim'] = str_replace('[I]','<I>',$_POST['message_for_victim']);
	$_POST['message_for_victim'] = str_replace('[/I]','</I>',$_POST['message_for_victim']);
	$_POST['message_for_victim'] = str_replace('[SIZE=1]','<span class=size_1>',$_POST['message_for_victim']);
	$_POST['message_for_victim'] = str_replace('[/SIZE]','</span>',$_POST['message_for_victim']);
	$_POST['message_for_victim'] = str_replace('[SIZE=2]','<span class=size_2>',$_POST['message_for_victim']);
	$_POST['message_for_victim'] = str_replace('[/ENDTAG]','</span>',$_POST['message_for_victim']);
	$_POST['message_for_victim'] = str_replace('[LEFT]','<div class=LEFT>',$_POST['message_for_victim']);
	$_POST['message_for_victim'] = str_replace('[/END]','</div>',$_POST['message_for_victim']);
	$_POST['message_for_victim'] = str_replace('[RIGHT]','<div class=RIGHT>',$_POST['message_for_victim']);
	$_POST['message_for_victim'] = str_replace('[CENTER]','<div class=CENTER>',$_POST['message_for_victim']);
	/*$preg = preg_replace("/(\[CHAR=)([0-9]+)(\])/","\$2",$_POST['message_for_victim']);
	$ulink = mysql_result(count_query("SELECT name FROM `users` WHERE `id_user`='".$preg."'"),0);
	$_POST['message_for_victim'] = preg_replace("/(\[CHAR=)([0-9]+)(\])/","<a href=player.php?id=\$2 class=profile>".$ulink."</a>",$_POST['message_for_victim']);*/
	$_POST['message_for_victim'] = preg_replace("/(\[COLOR\=)([\S]+)(\])/","<span style=color:#\$2>",$_POST['message_for_victim']);
	$_POST['message_for_victim'] = str_replace('[/COLOR]','</span>',$_POST['message_for_victim']);
	$_POST['message_for_victim'] = nl2br($_POST['message_for_victim']);
	##########
	#  /ТЕГИ #
	##########
	switch ($_GET['rtype'])
	{
		case 1: count_query("UPDATE `users` SET `description`='".$_POST['description']."' WHERE email='".$_SESSION['email']."'") or die("Invalid query: " . mysql_error()); count_query("UPDATE `users` SET `att_description`='".$_POST['message_for_victim']."' WHERE email='".$_SESSION['email']."'") or die("Invalid query: " . mysql_error()); echo "<script>location.href='options.php';</script>"; break;
		case 2: $err = "<div class='message'>В разработке</div>"; break;
		case 3: 
				if ($_POST['email'] != $row['email']) 
				{
					$s_e = mysql_num_rows(count_query("SELECT * FROM `users` WHERE `email`='".$_POST['email']."'"));
					if ($s_e > 0)
					{
						$err = '<div class="message">Такой email уже есть</div>';
					}
					else
					{
						count_query("UPDATE `users` SET `email` = '".$_POST['email']."' WHERE `id_user`='".$row['id_user']."'"); 
						unset($_SESSION['email']); 
						$_SESSION['email'] = $_POST['email'];
						echo "<script>location.href='options.php';</script>";
					}
				}
				if ($_POST['old_password'] != "" && $_POST['new_password']!= "" && $_POST['retype_password'] != "")
				{
					if (md5($_POST['old_password']) == $row['pass'])
					{
						if ($_POST['new_password'] == $_POST['retype_password'])
						{
							count_query("UPDATE `users` SET `pass`='".md5($_POST['new_password'])."' WHERE id_user='".$row['id_user']."'");
							$err = '<div class="message">Пароль изменен</div>';
						}
						else
						{
							$err = '<div class="message">Пароли не совпадают</div>';
						}
					}
					else
					{
						$err = '<div class="message">Пароли не совпадают</div>';
					}
				};
			break;
		case 4: 
				/*if (isset($_GET['delete']))
				{
					if($_GET['delete'] == 1)
					{
						$del_item = count_query("SELECT  item.*, items_p.* FROM items_p RIGHT JOIN item  ON items_p.item_num=item.id WHERE items_p.uid = '".$row['id_user']."'");
						while ($del = mysql_fetch_array($del_item))
						{
							count_query("DELETE FROM `items_p` WHERE `uid`='".$row['id_user']."'");
						}
						count_query("DELETE FROM `users` WHERE `id_user`='".$row['id_user']."'");
						loca('index.php');
					}
				}*/
				$err = '<div class="message">В разработке</div>';
			break;
	}
}
?>
<tr>
        <td height="750" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class='blockHead'><img src='images/RU/titles/h_sets.png' alt='настройки' /></div>
		<div class='contentBlock' id='contentBlock'><?=$err;?>	<div class='inputGroup inputSmall inputNoHeight ' >
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1' >
			<div class='content' ><div class='title'>Игровые настройки</div><div class='body'><FORM action='options.php?rtype=1' method=post>
<input type='hidden' name='k' value = '59154'>
	Описание персонажа:<br>
	<div class='tags'>
			<span style='float:left'>
				<img src='images/tags/b.gif' onclick="AddTag('B','description')">
				<img src='images/tags/u.gif' onclick="AddTag('U','description')">
				<img src='images/tags/i.gif' onclick="AddTag('I','description')">
				<img src='images/tags/small.gif' onclick="AddTag('SIZE=1','description','SIZE')">
				<img src='images/tags/large.gif' onclick="AddTag('SIZE=2','description','SIZE')">
				<img src='images/tags/color.gif' onclick="ShowColor(1,'description')">
			</span>
		<span style='float:right'>
			<img src='images/tags/left.gif' onclick="AddTag('LEFT','description','END')">
			<img src='images/tags/center.gif' onclick="AddTag('CENTER','description','END')">
			<img src='images/tags/right.gif' onclick="AddTag('RIGHT','description','END')">

		 </span>
			<!--<img src='images/tags/char.gif' onclick="addCharacter('description')">
			<img src='images/tags/clan.gif' onclick="addClan('description')">-->
		</div>
		<div id='colors_1' class='tags_colors'><table><tr><td style='background:#4d1f11' onclick="AddColor('4d1f11','description',1)"> &nbsp;<td style='background:#cc3300' onclick="AddColor('cc3300','description',1)"> &nbsp;<td style='background:#ff9933' onclick="AddColor('ff9933','description',1)"> &nbsp;<td style='background:#ffff00' onclick="AddColor('ffff00','description',1)"> &nbsp;<tr><td style='background:#000066' onclick="AddColor('000066','description',1)"> &nbsp;<td style='background:#0000ff' onclick="AddColor('0000ff','description',1)"> &nbsp;<td style='background:#6633cc' onclick="AddColor('6633cc','description',1)"> &nbsp;<td style='background:#9966ff' onclick="AddColor('9966ff','description',1)"> &nbsp;<tr><td style='background:#003300' onclick="AddColor('003300','description',1)"> &nbsp;<td style='background:#2c8f11' onclick="AddColor('2c8f11','description',1)"> &nbsp;<td style='background:#ffffff' onclick="AddColor('ffffff','description',1)"> &nbsp;<td style='background:#000000' onclick="AddColor('000000','description',1)"> &nbsp;</table></div>
		<div class='clear'></div>
	<textarea name='description' style='width:100%' rows='5' id='description'><?=$d;?></textarea>
	<br>
	<br>
	Сообщение нападающему:<br>
	<div class='tags'>
			<span style='float:left'>
				<img src='images/tags/b.gif' onclick="AddTag('B','message_for_victim')">
				<img src='images/tags/u.gif' onclick="AddTag('U','message_for_victim')">
				<img src='images/tags/i.gif' onclick="AddTag('I','message_for_victim')">
				<img src='images/tags/small.gif' onclick="AddTag('SIZE=1','message_for_victim','SIZE')">
				<img src='images/tags/large.gif' onclick="AddTag('SIZE=2','message_for_victim','SIZE')">
				<img src='images/tags/color.gif' onclick="ShowColor(2,'message_for_victim')">
			</span>
		<span style='float:right'>
			<img src='images/tags/left.gif' onclick="AddTag('LEFT','message_for_victim')">
			<img src='images/tags/center.gif' onclick="AddTag('CENTER','message_for_victim')">
			<img src='images/tags/right.gif' onclick="AddTag('RIGHT','message_for_victim')">

		 </span>
			<!--<img src='images/tags/char.gif' onclick="addCharacter('message_for_victim')">
			<img src='images/tags/clan.gif' onclick="addClan('message_for_victim')">-->
		</div>
		<div id='colors_2' class='tags_colors'><table><tr><td style='background:#4d1f11' onclick="AddColor('4d1f11','message_for_victim',2)"> &nbsp;<td style='background:#cc3300' onclick="AddColor('cc3300','message_for_victim',2)"> &nbsp;<td style='background:#ff9933' onclick="AddColor('ff9933','message_for_victim',2)"> &nbsp;<td style='background:#ffff00' onclick="AddColor('ffff00','message_for_victim',2)"> &nbsp;<tr><td style='background:#000066' onclick="AddColor('000066','message_for_victim',2)"> &nbsp;<td style='background:#0000ff' onclick="AddColor('0000ff','message_for_victim',2)"> &nbsp;<td style='background:#6633cc' onclick="AddColor('6633cc','message_for_victim',2)"> &nbsp;<td style='background:#9966ff' onclick="AddColor('9966ff','message_for_victim',2)"> &nbsp;<tr><td style='background:#003300' onclick="AddColor('003300','message_for_victim',2)"> &nbsp;<td style='background:#2c8f11' onclick="AddColor('2c8f11','message_for_victim',2)"> &nbsp;<td style='background:#ffffff' onclick="AddColor('ffffff','message_for_victim',2)"> &nbsp;<td style='background:#000000' onclick="AddColor('000000','message_for_victim',2)"> &nbsp;</table></div>
		<div class='clear'></div>
	<textarea name='message_for_victim' style='width:100%'  rows='5' id='message_for_victim'><?=$ad;?></textarea>
<br /><br />
	<input type='image' name='submit' class='image cmd' src='images/RU/b_save_p.png' alt='Сохранить'
					onMouseOver="doImage(this,'RU/b_save',null)"/ >
</FORM>&nbsp;</div></div>
		</div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
<br /><br />	<div class='inputGroup inputSmall inputNoHeight ' >
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1' >
			<div class='content' ><div class='title'>Уйти в отпуск</div><div class='body'><FORM action='options.php?rtype=2' method=post>
<input type='hidden' name='k' value = '59154'>
<center>
<div style='text-align:justify; padding:20px;'>Вы можете активировать Режим Отпуска, если не работаете на ферме, в дозоре или шахте. Ваш аккаунт не будет удален за неактивностью, а ваш персонаж не может быть атакован. В целях соблюдения игрового баланса минимальное время отпуска – 48 часов, в течение которых вы не сможете войти в игру. По истечении 48 часов вы сможете войти в игру в любой момент, и режим отпуска автоматически отключится. Также режим отпуска отключится автоматически через 28 дней после его активации. Повторно в отпуск можно уйти через 5 дней после завершения предыдущего отпуска.
	<b>Во время премиум отпуска замораживюется до выхода из режима отпуска действие тотемов, куклы и знака вуду, а также сейфа, аренды кузницы, сумки в сбытнице и другие элементы, приобретаемые за кристаллы или зелень.</.</b>
	</div>
<br />

<table class='center'>
<tr><td>Цена: 0 <img src='/images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'>	</td><td>Цена: 30 <img src='/images/ico_krist1.png' alt='Кристалл' align='absmiddle' class='png'> / 30 <img src='/images/ico_green1.png' alt='Зелень' align='absmiddle' class='png'>&nbsp;&nbsp;</td></tr>
<tr><td ><input type='image' name='do_vacation_2' class='image cmd' src='images/RU/b_holiday_2_p.png' alt='Отдыхать!'
					onMouseOver="doImage(this,'RU/b_holiday_2',null)"/ >	</td><td>	<input type='image' name='do_vacation' class='image cmd' src='images/RU/b_holiday_p.png' alt='Отдыхать!'
					onMouseOver="doImage(this,'RU/b_holiday',null)"/ >	</td></tr>
</table>
</center>
</form>&nbsp;</div></div>
		</div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
<br />	<div class='inputGroup inputSmall inputNoHeight ' >
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1' >
			<div class='content' ><div class='title'>Настройки аккаунта</div><div class='body'><FORM action='options.php?rtype=3' method=post>
<center>
<label><br>
	<span class='text_main_1'>Адрес e-mail:</span>
	<input name='email' type='text' id='email' value='<?=$row['email'];?>' size='30' maxlength='80' />
</label>
<br>
	
<br /><br />
<table width='400' border='0' cellpadding='0' cellspacing='0' class='text_main_2'>
<caption align='top' class='text_main_1'>Изменить пароль<br><br></caption>
<tr>
   <td width='194' height='23'><div align='left'>Старый пароль:</div></td>
   <td class='left'><input name='old_password' type='password' id='old_password' size='25' maxlength='23'></td>
</tr>
<tr>
   <td height='23'><div align='left'>Новый пароль:</div></td>
   <td class='left'><input name='new_password' type='password' id='new_password' size='25' maxlength='23'></td>
</tr>
<tr>
   <td height='23'><div align='left'>Подтвердить пароль:</div></td>
   <td class='left'><input name='retype_password' type='password' id='retype_password' size='25' maxlength='23'></td>
</tr>
</table>
<input type='image' name='submit' class='image cmd' src='images/RU/b_save_p.png' alt='Сохранить'
					onMouseOver="doImage(this,'RU/b_save',null)"/ >
</center>
</form>
<br /></div></div>
		</div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
</div>	</td></tr>
<?php include ("footer_tpl.php");?>