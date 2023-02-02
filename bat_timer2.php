<?php
session_start();

$att = mysql_fetch_array(count_query("SELECT * FROM `users` WHERE `email` = '".$_SESSION['email']."'"));

$delta = $att['bat_timer']-time(); //разница с настояцим временем

if ($delta < 0) {
	count_query("UPDATE `users` SET `bat_timer` = '0' WHERE email='".$_SESSION['email']."'");
}
?>
Можно нападать на врага <br> только раз в 15 минут.<br>
	<a href='kormushka.php' class='text_main_4'>«Крутые»</a> могут нападать раз в 5 минут.<br>
	<br>
	До следующего нападения <br>осталось:<div id="bx1">---</div>
<script type="text/javascript">v=new Date();var bx1=document.getElementById('bx1');function tbx1(){n=new Date();s=<?=$delta;?>-Math.round((n.getTime()-v.getTime())/1000.);m=0;h=0;if(s<0){bx1.innerHTML='---';document.location=document.location;}else{if(s>59){m=Math.floor(s/60); s=s-m*60}if(m>59){h=Math.floor(m/60);m=m-h*60} if(s<10){s="0"+s}if(m<10){m="0"+m}bx1.innerHTML=" "+h+":"+m+":"+s+'';document.title=h+':'+m+':'+s+' Ботва';window.setTimeout("tbx1();",999);}}tbx1();</script>
 <br><br><br>
