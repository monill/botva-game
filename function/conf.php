<?php 
$base_name="localhost"; //��� (���������� � ���� localhost) 
$base_user="root"; //���� (���������� � ���� root) 
$base_pass="password"; //������ (��������� ����� ����� �� ������� ���������� � phpMyAdmin 
$db_name="botva"; //��� �� 
$link = mysql_pconnect($base_name, $base_user, $base_pass); //��������� � ������
mysql_select_db($db_name, $link); //�������� ��
mysql_query("SET CHARSET cp1251"); //������ ��������� windows-1251
$ADDR = $_SERVER["HTTP_HOST"];
?>