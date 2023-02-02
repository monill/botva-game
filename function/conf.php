<?php 
$base_name="localhost"; //имя (стандартно у всех localhost) 
$base_user="root"; //юзер (стандартно у всех root) 
$base_pass="password"; //пароль (выставить можно зайдя во вкладку Привилегии в phpMyAdmin 
$db_name="botva"; //имя БД 
$link = mysql_pconnect($base_name, $base_user, $base_pass); //Соединяем с хостом
mysql_select_db($db_name, $link); //Выбираем БД
mysql_query("SET CHARSET cp1251"); //Задаем кодировку windows-1251
$ADDR = $_SERVER["HTTP_HOST"];
?>