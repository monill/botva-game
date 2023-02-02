<?php
session_start();
if (!isset($_SESSION['email'])) {
	echo "<script>location.href='index.php';</script>"; //переадресовываем в игру 
}
?>
<tr><td height="50" background="images/foot_01.png"></td></tr>
      <tr>
        <td height="90" align="center" valign="middle" background="images/bg_dark.png"><table width="520" height="50" border="0" cellpadding="0" cellspacing="0" background="images/bg_foot.png">
            <tr>
             <td width="65%" height="25" align="center" valign="bottom" class="menu_foot" style='line-height:16px'>Все права защищены &copy; 2010</td>
              <td width="35%" rowspan="2" align="left" valign="top"><a href="#"><img src="images/logo.png" alt="logo" name="logo" width="134" height="50" border="0" id="logo" onMouseOver="this.src='images/logo_a.png'" onMouseOut="this.src='images/logo.png'"></a></td>
			            </tr>
            <tr>
              <td height="25" align="center" valign="top"><a href="page.php?page=legal" class="menu_foot">Основные положения</a> <a href="page.php?page=rules" class="menu_foot">Правила  игры</a></td>
            </tr>
        </table><br>
<br><br>
</td>
</tr>
</table></td>
<td align="left" valign="top" background="images/bg_dark.png" bgcolor="#7B5B33"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="186" background="images/bg00.png"><table width="100%" height="186" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="210" background="images/RU/bg_right6.png" class='png'><table width="210" height="186" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="91" background="images/<?=$race?>2.png" class='png'></td>
          </tr>
          <tr><td></td></tr>
          <tr><td height="25" align="center"><a href="top.php?t=1"><img src="images/RU/but_users_p.png" alt="Игроки" width="130" height="25" id="top2" onMouseOver="doImage(this,'RU/but_users',null)"></a></td></tr>
          <tr>
            <td height="13"></td>
          </tr>
        </table></td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
    </tr>
  <tr>
    <td height="320" align="left" valign="top">
    		<table class='ltop' >
	<tr><td height="4"></td></tr>
	<?php top_p(); ?>
	<tr><td height="25"></td></tr>
	<tr><td height="25" align="center"><a href="top.php?t=2"><img src="/images/RU/but_clans_p.png" alt="" name="top3" width="130" height="25" border="0" id="top3" onMouseOver="this.src='/images/RU/but_clans_a.png'" onMouseOut="this.src='/images/RU/but_clans_p.png'"></a></td></tr>
	<tr><td height="10"></td></tr>
	<?php top_c(); ?>
	<tr><td></td></tr>
	</table>
    		</td>
    </tr>
</table></td>
</tr>
</table>
<div id='tooltip' style='display:none'></div>
<div id='tooltip2' style='display:none' class='shadow9'></div>

</body>
</html>
<?php
if ($row['authlevel'] == 20)
{
?>
<center>
<?
	result();
}
?>