<?php
session_start();

include ("function/conf.php");
include ("function/statistic.php");
include ("function/func.php");

##################### ����� ������ � SQL ������� ################
include_once("function/sql.php");

$stop_injection = new InitVars();
$stop_injection->checkVars();
##################### ����� ������ � SQL ������� ################

count_query("DELETE FROM `online` WHERE id_session = '".$_SESSION['id']."'"); 

if (isset($_SESSION['email']) AND isset($_SESSION['id'])){
	unset($_SESSION['email']);
	unset($_SESSION['id']);
	if (isset($_SESSION['timer_hp']))
	{
		unset($_SESSION['timer_hp']);
	}
        if (isset($_SESSION['admin']))
        {
                unset($_SESSION['admin']);
        }
	setcookie('token', '');
}

echo "<script>location.href='index.php';</script>";
?>