<?php
session_start();

$att = mysql_fetch_array(count_query("SELECT * FROM `users` WHERE `email` = '".$_SESSION['email']."'"));

$delta = $att['bat_timer']-time(); //������� � ��������� ��������

if ($delta < 0)
{
	count_query("UPDATE `users` SET `bat_timer` = '0' WHERE email='".$_SESSION['email']."'");
}
?>
����� �������� �� ����� <br> ������ ��� � 15 �����.<br>
	<a href='kormushka.php' class='text_main_4'>�������</a> ����� �������� ��� � 5 �����.<br>
	<br>
	�� ���������� ��������� <br>��������:<div id="bx0">---</div>
<script type="text/javascript">v=new Date();var bx0=document.getElementById('bx0');function tbx0(){n=new Date();s=<?=$delta;?>-Math.round((n.getTime()-v.getTime())/1000.);m=0;h=0;if(s<0){bx0.innerHTML='---';document.location=document.location;}else{if(s>59){m=Math.floor(s/60); s=s-m*60}if(m>59){h=Math.floor(m/60);m=m-h*60} if(s<10){s="0"+s}if(m<10){m="0"+m}bx0.innerHTML=" "+h+":"+m+":"+s+'';document.title=h+':'+m+':'+s+' �����';window.setTimeout("tbx0();",999);}}tbx0();</script>
 <br><br><br>