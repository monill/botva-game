#!/usr/local/bin/php
<?php
include ('../function/conf.php');

$zap_td = mysql_query("SELECT * FROM `users`");
while ($time_dozor = mysql_fetch_array($zap_td))
{
	if ($time_dozor['vip'] == 0)
	{
		$t = '120';
	}
	else
	{
		$t='240';
	}
	mysql_query("UPDATE `users` SET `time_dozor`='".$t."' WHERE id_user='".$time_dozor['id_user']."'");
}
?>