<?php
include('top_tpl.php');

$zap_user_true = count_query("SELECT * FROM `users` WHERE `id_user`='".$_GET['add']."'");
$zap_user_num = mysql_num_rows($zap_user_true);
if ($zap_user_num > 0)
{
	if ($row['id_user'] == $_GET['add'])
	{
		echo "<tr>
    <td height='750' width='574' align='center' valign='top' background='images/site_01_07.png' bgcolor='#EBDBC1'>
		<div class='blockHead'><img src='images/RU/titles/h_chaps.png' alt='Братва' /></div>
		<div class='contentBlock' id='contentBlock'>
		<a href='contacts.php' class='back'><img src='images/RU/b_back_p.png' alt='Назад' class='cmd' onMouseOver=\"doImage(this,'RU/b_back')\" /></a>
		<div class='message'>Нельзя самого себя добавлять!</div></div>	
	</td>
</tr>";
	}
	else
	{
		count_query("INSERT INTO `contacts` (`pid`,`fid`) VALUES ('".$row['id_user']."','".$_GET['add']."')");
		loca('contacts.php');
	}
}
else
{
?>
<tr>
    <td height='750' width='574' align='center' valign='top' background='images/site_01_07.png' bgcolor='#EBDBC1'>
		<div class='blockHead'><img src='images/RU/titles/h_chaps.png' alt='Братва' /></div>
		<div class='contentBlock' id='contentBlock'>
		<a href='contacts.php' class='back'><img src='images/RU/b_back_p.png' alt='Назад' class='cmd' onMouseOver="doImage(this,'RU/b_back')" /></a>
		<div class='message'>Такого пользователя не существует!</div></div>	
	</td>
</tr>
<?php } include('footer_tpl.php');?>