<?php
$inf = $_GET["info2"];

if ($row['woodoo'] > 0)
{
	$t = "действует до: ".date('j.m.Y H:i', $row['woodoo']);
}
if ($row['woodoo2'] > 0)
{
	$t2 = "действует до: ".date('j.m.Y H:i', $row['woodoo2']);
}
if ($row['woodoo3'] > 0)
{
	$t3 = "действует до: ".date('j.m.Y H:i', $row['woodoo3']);
}
if ($row['woodoo4'] > 0)
{
	$t4 = "действует до: ".date('j.m.Y H:i', $row['woodoo4']);
}

$per_gold = round(($row['gold']*85)/100);
$per_kryst = round(($row['krystal']*85)/100);
if (($row['gold']-$per_gold) < 0)
{
	$p = 0;
}
else
{
	$p = $row['gold']-$per_gold;
}
if (($row['krystal']-$per_kryst) < 0)
{
	$p2 = 0;
}
else
{
	$p2 = $row['krystal']-$per_kryst;
}

$desc1 = '<tr>
        <td height="750" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class="blockHead"><img src="images/RU/titles/h_home_safe.png" alt="Сейф" /></div>
			
		<div class="contentBlock" id="contentBlock"><a href="house.php" class="back"><img src="images/RU/b_back_p.png" alt="Назад" class="cmd"
								onMouseOver="doImage(this,"RU/b_back")" /></a>
		<div class="box_wrap" id="help_25">
			<div onclick="showBox("help_25")" class="box_title title_show" id="t_help_25">Помощь</div>
			<div id="b_help_25" class="box_body shown"><div class="left">Сейф сохраняет часть золота от нападений. Это значит, что противник может отнять у тебя процент только от того количества золота, которое в сейф не поместилось. Срок действия – 14 дней. При каждом продлении сейфа к дате окончания прибавляется 14 дней</div></div>
		</div>
			<div class="inputGroup inputSmall inputNoHeight" >
		<div class="top"><div class="top1"><div class="top2"></div></div></div>

		<div class="c1" >
			<div class="content" ><div class="title">Сейф</div><div class="body"><center><br />
У вас на счету '.$row['gold'].' <img src="/images/ico_gold1.png" alt="Золото" align="absmiddle"><br />
Сейф сохраняет '.$per_gold.' <img src="/images/ico_gold1.png" alt="Золото" align="absmiddle"><br />
Незащищенная сумма составляет '.$p.'  <img src="/images/ico_gold1.png" alt="Золото" align="absmiddle"><br /></center></div></div>
		</div>
		<div class="down"><div class="down1"><div class="down2"></div></div></div>
	</div>
</div>	</td></tr>';
$desc2 = '<tr>
        <td height="750" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class="blockHead"><img src="images/RU/titles/h_home_safe2.png" alt="Кристальный сейф" /></div>
			
		<div class="contentBlock" id="contentBlock"><a href="house.php" class="back"><img src="images/RU/b_back_p.png" alt="Назад" class="cmd"
								onMouseOver="doImage(this,"RU/b_back")" /></a>
		<div class="box_wrap" id="help_25">
			<div onclick="showBox("help_25")" class="box_title title_show" id="t_help_25">Помощь</div>
			<div id="b_help_25" class="box_body shown"><div class="left">Кристальный сейф сохраняет часть кристаллов от нападений. Это значит, что противник может отнять у тебя процент только от того количества кристаллов, которое в сейф не поместилось Срок действия – 14 дней. При каждом продлении сейфа к дате окончания прибавляется 14 дней.</div></div>
		</div>
			<div class="inputGroup inputSmall inputNoHeight" >
		<div class="top"><div class="top1"><div class="top2"></div></div></div>

		<div class="c1" >
			<div class="content" ><div class="title">Кристальный сейф</div><div class="body"><center><br />
У вас на счету '.$row['krystal'].' <img src="/images/ico_krist1.png" alt="Кристаллы" align="absmiddle"><br />
Кристальный сейф сохраняет '.$per_kryst.' <img src="/images/ico_krist1.png" alt="Кристаллы" align="absmiddle"><br />
Незащищенная сумма составляет '.$p2.' <img src="/images/ico_krist1.png" alt="Кристаллы" align="absmiddle"><br />
</center></div></div>
		</div>
		<div class="down"><div class="down1"><div class="down2"></div></div></div>
	</div>
</div>	</td></tr>';
$desc3 = '<tr>
        <td height="750" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class="blockHead"><img src="images/RU/titles/h_home_safe3.png" alt="Золотой сейф" /></div>
			
		<div class="contentBlock" id="contentBlock"><a href="house.php" class="back"><img src="images/RU/b_back_p.png" alt="Назад" class="cmd"
								onMouseOver="doImage(this,"RU/b_back")" /></a>
		<div class="box_wrap" id="help_25">
			<div onclick="showBox("help_25")" class="box_title title_show" id="t_help_25">Помощь</div>
			<div id="b_help_25" class="box_body shown"><div class="left">Золотой сейф, это улучшение обычного сейфа. Золотой сейф сохраняет от нападений 80% от количества золота на твоем счету, которое не помещается в обычный сейф. Это значит, что противник может отнять у тебя процент только от того количества золота, которое в обычный и золотой сейф не поместилось.<br /><br />
Активировать золотой сейф можно только после активации сейфа. Если у вас закончилось действие сейфа, то золотой сейф также не действует. При этом срок активации продолжает идти – внимательно следите за активацией обоих сейфов.<br /><br />
Срок действия – 14 дней. При каждом продлении сейфа к дате окончания прибавляется 14 дней.<br /><br />
Ограничение: Активация золотого сейфа доступна только для персонажей, чей уровень 25 и выше.<br />
</div></div>
		</div>
			<div class="inputGroup inputSmall inputNoHeight" >
		<div class="top"><div class="top1"><div class="top2"></div></div></div>

		<div class="c1" >
			<div class="content" ><div class="title">Золотой сейф</div><div class="body"><center><br />
У вас на счету '.$row['gold'].' <img src="/images/ico_gold1.png" alt="Золото" align="absmiddle"><br />
Сейф сохраняет 1920 <img src="/images/ico_gold1.png" alt="Золото" align="absmiddle"><br />
Золотой сейф сохраняет 0 <img src="/images/ico_gold1.png" alt="Золото" align="absmiddle"><br />
Незащищенная сумма составляет 0  <img src="/images/ico_gold1.png" alt="Золото" align="absmiddle"></center></div></div>
		</div>
		<div class="down"><div class="down1"><div class="down2"></div></div></div>
	</div>
</div>	</td></tr>';
$desc4 = '<tr>
        <td height="750" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class="blockHead"><img src="images/RU/titles/h_home_safe4.png" alt="Улучшенный Кристальный сейф" /></div>
			
		<div class="contentBlock" id="contentBlock"><a href="house.php" class="back"><img src="images/RU/b_back_p.png" alt="Назад" class="cmd"
								onMouseOver="doImage(this,"RU/b_back")" /></a>
		<div class="box_wrap" id="help_25">
			<div onclick="showBox("help_25")" class="box_title title_show" id="t_help_25">Помощь</div>
			<div id="b_help_25" class="box_body shown"><div class="left">Улучшенный кристальный сейф, это улучшение кристального сейфа. Улучшенный кристальный сейф сохраняет от нападений 80% от количества кристаллов на твоем счету, которое не помещается в кристальный сейф. Это значит, что противник может отнять у тебя процент только от того количества кристаллов, которое в кристальный и улучшенный кристальный сейф не поместилось.<br />
Активировать улучшенный кристальный сейф можно только после активации кристального сейфа. Если у вас закончилось действие кристального сейфа, то улучшенный кристальный сейф также не действует. При этом срок активации продолжает идти – внимательно следите за активацией обоих сейфов.<br />
Срок действия – 14 дней. При каждом продлении сейфа к дате окончания прибавляется 14 дней.<br /><br />
Ограничение: Активация улучшенного крисейфа доступна только для персонажей, чей уровень 25 и выше.<br /><br />
Уникальная возможность: защита 50% утерянных в боях кристаллов для трудяг из гильдии шахтеров. Например, если вы состоите в гильдии шахтеров и на вас напал противник и забрал, допустим, 10 кристаллов, на руки он получит только 5 кристаллов, а ещё 5 кристаллов защитит этот сейф. <br />
Данная защита не работает при нападении шахтеров друг на друга.
</div></div>
		</div>
			<div class="inputGroup inputSmall inputNoHeight" >
		<div class="top"><div class="top1"><div class="top2"></div></div></div>

		<div class="c1" >
			<div class="content" ><div class="title">Улучшенный Кристальный сейф</div><div class="body"><center><br />
У вас на счету '.$row['krystal'].' <img src="/images/ico_krist1.png" alt="Кристаллы" align="absmiddle"><br />
Кристальный сейф сохраняет 5 <img src="/images/ico_krist1.png" alt="Кристаллы" align="absmiddle"><br />
Улучшенный кристальный сейф сохраняет 0 <img src="/images/ico_krist1.png" alt="Кристаллы" align="absmiddle"><br />
Незащищенная сумма составляет 0 <img src="/images/ico_krist1.png" alt="Кристаллы" align="absmiddle"><br />
</center></div></div>
		</div>
		<div class="down"><div class="down1"><div class="down2"></div></div></div>
	</div>
</div>	</td></tr>';
$desc5 = '<tr>
        <td height="750" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class="blockHead"><img src="images/RU/titles/h_home_woodoo.png" alt="Кукла Вуду" /></div>
			
		<div class="contentBlock" id="contentBlock"><a href="house.php" class="back"><img src="images/RU/b_back_p.png" alt="Назад" class="cmd"
								onMouseOver="doImage(this,"RU/b_back")" /></a>
		<div class="box_wrap" id="help_25">
			<div onclick="showBox("help_25")" class="box_title title_show" id="t_help_25">Помощь</div>
			<div id="b_help_25" class="box_body shown"><div class="left">Кукла Вуду увеличивает твою силу на 30%, но только при твоей	атаке на противника.<br /><br />Если нападают на тебя, то прибавления к силе нет. Срок действия – 28 дней. <br /><br /> При каждом продлении Куклы Вуду к дате окончания прибавляется 28 дней. </div></div>
		</div>
			<div class="inputGroup inputSmall inputNoHeight" >
		<div class="top"><div class="top1"><div class="top2"></div></div></div>

		<div class="c1" >
			<div class="content" ><div class="title">Кукла Вуду</div><div class="body"><center>'.$t.'</center></div></div>
		</div>
		<div class="down"><div class="down1"><div class="down2"></div></div></div>
	</div>
</div>	</td></tr>';
$desc6 = '<tr>
        <td height="750" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class="blockHead"><img src="images/RU/titles/h_home_woodoo2.png" alt="Знак Вуду" /></div>
			
		<div class="contentBlock" id="contentBlock"><a href="house.php" class="back"><img src="images/RU/b_back_p.png" alt="Назад" class="cmd"
								onMouseOver="doImage(this,"RU/b_back")" /></a>
		<div class="box_wrap" id="help_25">
			<div onclick="showBox("help_25")" class="box_title title_show" id="t_help_25">Помощь</div>
			<div id="b_help_25" class="box_body shown"><div class="left">Знак Вуду увеличивает твою силу на 30%, но только при атаке на тебя. Это значит, что обладая Куклой Вуду и Знаком Вуду, вы получаете постоянную прибавку к силе. Срок действия –28 дней. При каждом продлении Знака Вуду к дате окончания прибавляется 28 дней.</div></div>
		</div>
			<div class="inputGroup inputSmall inputNoHeight" >
		<div class="top"><div class="top1"><div class="top2"></div></div></div>

		<div class="c1" >
			<div class="content" ><div class="title">Знак Вуду</div><div class="body"><center>'.$t2.'</center></div></div>
		</div>
		<div class="down"><div class="down1"><div class="down2"></div></div></div>
	</div>
</div>	</td></tr>';
$desc7 = '<tr>
        <td height="750" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class="blockHead"><img src="images/RU/titles/h_home_totem.png" alt="Бронзовый Тотем" /></div>
			
		<div class="contentBlock" id="contentBlock"><a href="house.php" class="back"><img src="images/RU/b_back_p.png" alt="Назад" class="cmd"
								onMouseOver="doImage(this,"RU/b_back")" /></a>
		<div class="box_wrap" id="help_25">
			<div onclick="showBox("help_25")" class="box_title title_show" id="t_help_25">Помощь</div>
			<div id="b_help_25" class="box_body shown"><div class="left">Бронзовый Тотем увеличивает твою защиту на 30%, но только при атаке противника на тебя.<br /><br />Если нападаешь на кого-то ты, то прибавления к защите нет. Срок действия – 28 дней. При каждом продлении Бронзового Тотема к дате окончания прибавляется 28 дней </div></div>
		</div>
			<div class="inputGroup inputSmall inputNoHeight" >
		<div class="top"><div class="top1"><div class="top2"></div></div></div>

		<div class="c1" >
			<div class="content" ><div class="title">Бронзовый Тотем</div><div class="body"><center>'.$t3.'</center></div></div>
		</div>
		<div class="down"><div class="down1"><div class="down2"></div></div></div>
	</div>
</div>	</td></tr>';
$desc8 = '<tr>
        <td height="750" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class="blockHead"><img src="images/RU/titles/h_home_totem2.png" alt="Золотой Тотем" /></div>
			
		<div class="contentBlock" id="contentBlock"><a href="house.php" class="back"><img src="images/RU/b_back_p.png" alt="Назад" class="cmd"
								onMouseOver="doImage(this,"RU/b_back")" /></a>
		<div class="box_wrap" id="help_25">
			<div onclick="showBox("help_25")" class="box_title title_show" id="t_help_25">Помощь</div>
			<div id="b_help_25" class="box_body shown"><div class="left">Золотой Тотем увеличивает твою защиту на 30%, но только при твоей атаке на противника.<br /><br /> Это значит, что обладая Бронзовым и Золотым Тотемами, вы получаете постоянную прибавку к защите. Срок действия – 28 дней. При каждом продлении Золотого Тотема к дате окончания прибавляется 28 дней</div></div>
		</div>
			<div class="inputGroup inputSmall inputNoHeight" >
		<div class="top"><div class="top1"><div class="top2"></div></div></div>

		<div class="c1" >
			<div class="content" ><div class="title">Золотой Тотем</div><div class="body"><center>'.$t4.'</center></div></div>
		</div>
		<div class="down"><div class="down1"><div class="down2"></div></div></div>
	</div>
</div>	</td></tr>';

switch ($inf)
{
	case "safe": echo $desc1; break;
	case "safe2": echo $desc2; break;
	case "safe3": echo $desc3; break;
	case "safe4": echo $desc4; break;
	case "woodoo": echo $desc5; break;
	case "woodoo2": echo $desc6; break;
	case "totem": echo $desc7; break;
	case "totem2": echo $desc8; break;
}
?>