<?php
include ("top_tpl.php");

$fd = $_GET['folder'];
$to_id = $_GET['to_id'];

$row_msg = count_query("SELECT * FROM `message` WHERE `to`='".$row['name']."' ORDER BY id_msg DESC");
$mess = count_query("SELECT * FROM `message` WHERE `to`='".$row['name']."'");
$num_msg = mysql_num_rows($mess);

if ($row['read_msg'] == 0)
{
	count_query("UPDATE `users` SET `read_msg`='1' WHERE `id_user`='".$row['id_user']."'");
	echo "<script>document.location=document.location</script>";
}

if(isset($_POST['do'])) {
	$to = HtmlSpecialChars($_POST['to']);
	$subject = HtmlSpecialChars($_POST['subject']);
	$body = HtmlSpecialChars($_POST['body']);
	$time = date('j.n.y H:i');

	$c_e = mysql_num_rows(count_query("SELECT id_user FROM `users` WHERE `name`='".$to."'"));
	$c_i = mysql_num_rows(count_query("SELECT id_ign FROM `ignore` WHERE `name`='".$row['name']."'"));
	
	if ($body == "") {
		$err = "Длина сообщения должна быть от 2 до 2000 символов";
	} else if ($to == "" || $c_e == 0) {
		$err = "Игрок не найден";
	} else if ($c_i == 1) {
		$err = "Этот игрок не желает получать от Вас сообщения!";
	} else {
		$body = nl2br($body);
		count_query("SET CHARSET cp1251"); //Задаем кодировку windows-1251
		count_query ("INSERT INTO `message` (`time`, `to`, `from`, `theme`, `text`, `metka`) values ('".$time."','".$to."','".$row['name']."', '".$subject."', '".$body."', '2')");
		count_query ("UPDATE users SET read_msg='0' WHERE name='".$to."'");
		$err = "Сообщение отправлено!";
	}
}

if(isset($_POST['do_delete'])) {
	$post_id = $_POST['msg_ids'];
	if ($_POST['clear'] == 1) {
		if ($post_id != null) {
			foreach ($post_id as $val) {
				count_query("DELETE FROM `message` WHERE `id_msg`='".$val."'");
				echo "<script>location.href='post.php';</script>";
			}
		}
	} else if ($_POST['clear'] == 3) {
		count_query("DELETE FROM `message` WHERE `to`='".$row['name']."'");
		echo "<script>location.href='post.php';</script>";
	}
}

if (isset($_POST['do_ignore_add'])) {
	$user = htmlspecialchars($_POST['user']);
	$c_n = mysql_num_rows(count_query("SELECT id_user FROM `users` WHERE `name`='".$user."'"));
	if ($user == "" || $c_n==0) {
		$err_ign = "Игрок не найден";
	} else {
		count_query ("INSERT INTO `ignore` (`name`, `id_users`) values('".$user."', '".$row['id_user']."')");
		$err_ign = "Пользователь добавлен в список заблокированных";
	}
}

if (isset($_POST['do_ignore_del'])) {
	$del_id = $_POST['delete_id'];
	if (isset($del_id)) {
		count_query("DELETE FROM `ignore` WHERE id_ign='".$del_id."'");
		$err_ign = "Пользователь успешно удален из списка заблокированных игроков";
	}
}
?>
      <tr>
        <td height="750" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class='blockHead'><img src='images/RU/titles/h_post.png' alt='Почта' /></div>
			<div class='message'><?php echo $err; ?></div>
		<div class='contentBlock' id='contentBlock'><a href='post.php' ><img src='<?php if ($_GET['m'] == null) {?>images/RU/buttons/b_msg_a.png<?php } else {?>images/RU/buttons/b_msg_p.png<?php } ?>' alt='Сообщения' class='cmd' onMouseOver="doImage(this,'RU/buttons/b_msg'<?php if ($_GET['m'] == null) {?>,'active'<?php } else {?><?php } ?>)" /></a>
		<a href='post.php?m=new' ><img src='<?php if ($_GET['m'] == "new") {?>images/RU/buttons/b_msg_new_a.png<?php } else {?>images/RU/buttons/b_msg_new_p.png<?php } ?>' alt='Написать письмо' class='cmd' onMouseOver="doImage(this,'RU/buttons/b_msg_new'<?php if ($_GET['m'] == "new") {?>,'active'<?php } else {?><?php } ?>)" /></a>
		<a href='post.php?m=ignore' ><img src='<?php if ($_GET['m'] == "ignore") {?>images/RU/buttons/b_msg_ignore_a.png<?php } else {?>images/RU/buttons/b_msg_ignore_p.png<?php } ?>' alt='Чёрный список' class='cmd' onMouseOver="doImage(this,'RU/buttons/b_msg_ignore'<?php if ($_GET['m'] == "ignore") {?>,'active'<?php } else {?><?php } ?>)" /></a> <br /><br />	<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<?php
			if (!isset($_GET['m'])) {
		?>	
		<div class='c1'><div class='content'><div class='b2'><form method='POST' action='post.php<?php if ($fd != null) { echo "?folder=".$fd; }?>'>
        			<table class='post_select'><tr><td class='c1'><select name='clear' class='field select_clear' id='clear' class='text_main_3'><option value='1' selected>отмеченные сообщения</option><option value='3'>все сообщения</option></select>	<td class='c2'>
					<input type='hidden' name='do_delete'>
					<input type='image' name='cmd' class='image ' src='images/RU/b_msg_del_p.png' alt='Удалить' onMouseOver="doImage(this,'RU/b_msg_del',null)"/ >

					</table>	<a href='post.php' ><img src='<?php if ($fd == null) {?>images/RU/buttons/b_msg_all_a.png<?php } else {?>images/RU/buttons/b_msg_all_p.png<?php } ?>' alt='Все' class='cmd' onMouseOver="doImage(this,'RU/buttons/b_msg_all'<?php if ($fd == 1 || $fd == null) {?>,'active'<?php } else {?><?php } ?>)" /></a>
								<a href='post.php?folder=2' ><img src='<?php if ($fd == 2) {?>images/RU/buttons/b_msg_users_a.png<?php } else {?>images/RU/buttons/b_msg_users_p.png<?php } ?>' alt='Игроки' class='cmd' onMouseOver="doImage(this,'RU/buttons/b_msg_users'<?php if ($fd == 2) {?>,'active'<?php } else {?><?php } ?>)" /></a>
								<a href='post.php?folder=3' ><img src='<?php if ($fd == 3) {?>images/RU/buttons/b_msg_batl_a.png<?php } else {?>images/RU/buttons/b_msg_batl_p.png<?php } ?>' alt='Бои' class='cmd' onMouseOver="doImage(this,'RU/buttons/b_msg_batl'<?php if ($fd == 3) {?>,'active'<?php } else {?><?php } ?>)" /></a>
								<a href='post.php?folder=4' ><img src='<?php if ($fd == 4) {?>images/RU/buttons/b_msg_edv_a.png<?php } else {?>images/RU/buttons/b_msg_edv_p.png<?php } ?>' alt='Квесты' class='cmd' onMouseOver="doImage(this,'RU/buttons/b_msg_edv'<?php if ($fd == 4) {?>,'active'<?php } else {?><?php } ?>)" /></a>
								<a href='post.php?folder=5' ><img src='<?php if ($fd == 5) {?>images/RU/buttons/b_msg_dozor_a.png<?php } else {?>images/RU/buttons/b_msg_dozor_p.png<?php } ?>' alt='Дозор' class='cmd'	onMouseOver="doImage(this,'RU/buttons/b_msg_dozor'<?php if ($fd == 5) {?>,'active'<?php } else {?><?php } ?>)" /></a>
								<a href='post.php?folder=6' ><img src='<?php if ($fd == 6) {?>images/RU/buttons/b_msg_diff_a.png<?php } else {?>images/RU/buttons/b_msg_diff_p.png<?php } ?>' alt='Разное' class='cmd'	onMouseOver="doImage(this,'RU/buttons/b_msg_diff'<?php if ($fd == 6) {?>,'active'<?php } else {?><?php } ?>)" /></a>
								<br /><br /><center>
								<?php if ($num_msg == null) { ?>
								Нет сообщений
								<?php } else { ?>
								<div id='post_con'><table class='default post_table'>
								<?php 
								$ind = 1;
								while ($out_msg = mysql_fetch_array($row_msg)) {
									$us_id = mysql_fetch_array(count_query("SELECT `id_user` FROM `users` WHERE `name` = '".$out_msg['from']."'"));
									switch ($fd)
									{
										case null: if ($ind > 1){$ind = 0;};
													echo "<tr class='row_".$ind."'><td class='c1'><input type='checkbox' name='msg_ids[]' value='".$out_msg['id_msg']."'/>";
													echo "<td class='c2'>".$out_msg['time'];
													if ($out_msg['from'])
													{
														echo "<td>Сообщение от <b><a href='post.php?m=new&to_id=".$us_id['id_user']."'>".$out_msg['from']."</a></b>:<br /><b>".$out_msg['theme']."</b><br />".$out_msg['text']."</tr>";
													}
													else
													{
														echo "<td>".$out_msg['text']."</tr>";
													};
													$ind++;
													break;
										case $out_msg['metka']:if ($ind > 1){$ind = 0;};
														echo "<tr class='row_".$ind."'><td class='c1'><input type='checkbox' name='msg_ids[]' value='".$out_msg['id_msg']."'/>";
																echo "<td class='c2'>".$out_msg['time'];
																if ($out_msg['from'])
																{
																	echo "<td>Сообщение от <b><a href='post.php?m=new&to_id=".$us_id['id_user']."'>".$out_msg['from']."</a></b>:<br /><b>".$out_msg['theme']."</b><br />".$out_msg['text']."</tr>";
																}
																else
																{
																	echo "<td>".$out_msg['text']."</tr>";
																};
																$ind++;
																break;
									}
								}
								?>
							</table></div><br /></form>
			<?php } ?>
								</center><br /><br /></div></div></div>
		<?php } else if ($_GET['m'] == "new") {
		if (isset($to_id)) {
			$to_id_send = mysql_fetch_array(count_query("SELECT * FROM users WHERE id_user = '".$to_id."'"));
			$to_val = $to_id_send['name'];
		}
		?>	
		
		<table class='up_avatar'><tr><td class='avatar'><img src='images/post_man.jpg' alt='Почтальон Кряпечка'>	</td><td>
		<div class='inputGroup inputSmall ' >
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1' style='height:180px !important'>
			<div class='content' ><div class='title'>Почтальон Кряпечка</div><div class='body'>Туда – сюда – обратно, о Боже, как… достало!<br /><br />
Ещё, вот вас, баранов со свиньями в нашей почтовой системе не хватало. И чего я в теплые края не подалась со всеми…<br /><br />
Давай, копыть весточку, я уже собираюсь на разнос. Таких, как ты, у меня сегодня тысячи, и у всех,  перья им в уши, горит как на пожаре.<br /></div></div>
		</div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
</td></tr></table><br />	<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'><div class='content'><div class='b2'><form method='POST' action='?m=new'>
<table class='default center'>
<tr><td width=130 class='text_main_3'>Имя адресата:	<td><input type='text' name='to' 		value='<?php echo $to_val;?>'  class='input'/>
<tr><td width=130 class='text_main_3'>Тема:	<td><input type='text' name='subject'	value='' class='input'/>
<tr><td width=130 class='text_main_3'>Сообщение<br />(2000 симв.)	<td><textarea name='body'   rows="7" class='input'/></textarea>

<tr><td colspan='2' class='center'>
<input type='hidden' name='do'>
<input type='image' name='cmd' class='image ' src='images/RU/b_msg_post_p.png' alt='Отправить' onMouseOver="doImage(this,'RU/b_msg_post',null)"/ >
</table>
</form>
		<?php } else if ($_GET['m'] == "ignore") {?>
			<div class='message'><?php echo $err_ign;?></div>
			<div class='c1' >
			<div class='content' ><div class='title'>Добавить игрока </div><div class='body'><form method='POST' action='?m=ignore' >
<table class='default center'>
<tr><td width=130 class='text_main_3'>Имя адресата:	<td><input type='text' name='user' 		value='' />
<tr><td colspan='2' class='center'>
<input type='hidden' name='do_ignore_add'>
<input type='image' name='cmd' class='image ' src='images/RU/b_msg_ad_p.png' alt='Добавить' onMouseOver="doImage(this,'RU/b_msg_ad',null)"/ >

</table>
</form>
<br />
</div></div>
		</div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
<br />	<div class='inputGroup inputSmall inputNoHeight' >
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1' >
			<div class='content' ><div class='title'>Заблокированные игроки </div><div class='body'><form method='POST' action='?m=ignore' class='center'>
<select name='delete_id' class='field select_delete_id' id='delete_id' size='10' style='width:300;text-align:center;'>
<?php
$ign_users = count_query("SELECT * FROM `ignore` WHERE `id_users`='".$row['id_user']."'");
while ($row_ign_users = mysql_fetch_array($ign_users)) {
	echo "<option value='".$row_ign_users['id_ign']."'>".$row_ign_users['name']."</option>";
}
?>
</select><br />
<input type='hidden' name='do_ignore_del'>
<input type='image' name='cmd' class='image ' src='images/RU/b_msg_del_p.png' alt='Убрать' onMouseOver="doImage(this,'RU/b_msg_del',null)"/ >

</form>
<br /></div></div>
		</div>
		<?php } ?>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div></div>
	</td></tr>
<?php include ("footer_tpl.php");?>