<?php
include ("top_tpl.php");

$el = $_GET['el'];

if (isset($el))
{
	switch ($el)
	{
		case "c": $c = "checked"; break;
		case "t": $t = "checked"; break;
		case "p": $p = "checked"; break;
	}
}
else if (!isset($el))
{
	$p = "checked";
}

if (isset($_POST['word']))
{
	switch ($_POST['type'])
	{
		case 'user': 
				$zap = mysql_fetch_array(count_query("SELECT * FROM `users` WHERE `name`='".$_POST['word']."'"));
				if ($zap['id_user'] != null)
				{
					echo "<script>location.href='player.php?id=".$zap['id_user']."';</script>";
				}
				else
				{
					$err = "<div class='message'>Нет такого игрока</div>";
				}
			break;
		case 'clan': 
				$zap = mysql_fetch_array(count_query("SELECT * FROM `clans` WHERE `name`='".$_POST['word']."'"));
				if ($zap['id'] != null)
				{
					echo "<script>location.href='clan.php?id=".$zap['id']."';</script>";
				}
				else
				{
					$err = "<div class='message'>Нет такого клана</div>";
				}
			break;
		case 'clan_tag': 
				$zap = mysql_fetch_array(count_query("SELECT * FROM `clans` WHERE `tag`='".$_POST['word']."'"));
				if ($zap['id'] != null)
				{
					echo "<script>location.href='clan.php?id=".$zap['id']."';</script>";
				}
				else
				{
					$err = "<div class='message'>Нет такого клана</div>";
				}
			break;
	}
}
?>
<tr>
        <td height="750" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class='blockHead'><img src='images/RU/titles/h_search.png' alt='Поиск' /></div><?=$err;?>
			
		<div class='contentBlock' id='contentBlock'>	<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'><div class='content'><div class='b2'>	<FORM action='search.php' method='post'  style='width: 220px;margin:0;' class='text_main_2 left'>

	<h5 class="title">Введите параметр поиска:</h5>
	<br />

	<input type="radio" name="type" value="user" <?=$p;?>>				Игрок<br />
	<input type="radio" name="type" value="clan" <?=$c;?>>				Клан (имя)<br />
	<input type="radio" name="type" value="clan_tag" <?=$t;?>>		Клан (тэг)<br />

	<br />
	<br />
	<center class='text_main_2 ' >
		Текст&nbsp;<input name="word" size="25" maxlength="20" value="" />
		<br /><br /><input type='image' name='search' class='image cmd' src='images/RU/b_search_p.png' alt='Поиск'
					onMouseOver="doImage(this,'RU/b_search',null)"/ >

	</center>
</FORM></div></div></div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div></div>	</td></tr>
<?php
include ("footer_tpl.php");
?>