#!/usr/local/bin/php
<?php
include ('../function/conf.php');

$res = mysql_query("SELECT * FROM `users` WHERE  `hp_now` < `hp`");
 while ($row = mysql_fetch_array($res))
{
	$tik=$row['mass'];
	$toc=$row['hp_now']+$tik;
	if ($toc>$row['hp'])
	{
		$toc=$row['hp'];
	}
	else
	{
		$toc=$row['hp_now']+$tik;
	}
 	mysql_query("UPDATE `users` SET `hp_now` = '".$toc."' WHERE id_user='".$row['id_user']."'");
 }
?>