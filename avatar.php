<?php
include ('top_tpl.php');

if ($row['mwork'] > 0)
{
	loca('mine.php?a=open');
	exit;
}

if (isset($_POST['go']))
{
	count_query("UPDATE `users` SET gender='".$_POST['gender']."' WHERE id_user='".$_SESSION['id']."'");
	echo "<script>location.href='avatar.php';</script>";
}

if ($row['gender'] == 1)
{
	$m = 'selected';
	$w = '';
} else if ($row['gender'] == 2) {
	$m = '';
	$w = 'selected';
}
?>
<tr>
        <td height="750" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class='blockHead'><img src='images/RU/titles/h_avatar.png' alt='Внешний вид' /></div>
			
		<div class='contentBlock' id='contentBlock'><link href='css/rare.css' rel='stylesheet' type='text/css'><a href='index.php' class='back'><img src='images/RU/b_back_p.png' alt='Назад' class='cmd'
								onMouseOver="doImage(this,'RU/b_back')" /></a>
		<div class='box_wrap' id='other_3'>
			<div onclick="showBox('other_3')" class='box_title title_show' id='t_other_3'>Помощь</div>
			<div id='b_other_3' class='box_body shown'>Здесь вы можете настроить внешний вид персонажа. Под изображением персонажа отображены элементы, которые вы можете настраивать, а справа список всех элементов, которые можно перебирать. Галочкой отмечается текущий выбранный элемент. Иконки без значка моргающей капусты являются бесплатными.<br /><br />Все приобретенные элементы аватара остаются бесплатными навсегда</div>
		</div>
			<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'><div class='content'><div class='b2'><div id='av_block'>
		<table class='avatar_page'>
			<tr>
				<td class='l'>
					<div class='avatar '><?=$ava;?></div><br />
				</td>
			</tr>
		</table>
		<b>Пол</b>
		<form method='POST' action='avatar.php'>
			<select name='gender'>
				<option value='1' <?=$m;?>>Мужской</option>
				<option value='2' <?=$w;?>>Женский</option>
			</select><br /><br />
			<input type='submit' name='go' value='Подтвердить'>
		</form>
			</div></div></div></div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
</div>	</td></tr>
<?php
include ('footer_tpl.php');
?>