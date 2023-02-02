#!/usr/local/bin/php
<?php
include ('../function/conf.php');

$res = mysql_query("SELECT * FROM `users`");
 while ($row = mysql_fetch_array($res))
{
	mysql_query("UPDATE `users` SET `naper_g` = '0', `naper_k`='0' WHERE `id_user`='".$row['id_user']."'");
}
?>