<?php
include ("top_tpl.php");

$a = $_GET['a'];
$uid = $_GET['id'];
$group = $_GET['group'];

global $senks;

$c_row = count_query("SELECT  item.*, items_p.* FROM items_p RIGHT JOIN item  ON items_p.item_num=item.id WHERE items_p.uid = '".$row['id_user']."'");
$item_number = mysql_fetch_array($c_row);
$count_item = mysql_num_rows($c_row);

if (isset($_POST['cmd'])) {
	$col = mysql_fetch_array(count_query("SELECT count(*) FROM items_p WHERE item_num = '".$uid."' AND uid = '".$row['id_user']."'"));
	$sell_col = mysql_fetch_array(count_query("SELECT vol FROM items_p WHERE item_num = '".$_POST['id']."' AND uid = '".$row['id_user']."'"));
	$buy_item = mysql_fetch_array(count_query("SELECT * FROM `item` WHERE id = '".$uid."'"));
	$sell_item = mysql_fetch_array(count_query("SELECT * FROM `item` WHERE id = '".$_POST['id']."'"));
	if ($_POST['cmd'] == "buy" AND $group < 6)
	{
		$model = $buy_item['model'];
	
		if ($count_item == ($row['house']+2))
		{
			echo "<script>location.href='house.php?info=home';</script>";
			exit;
		}
	
		if ($item_number['vol'] == ($row['house']+2))
		{
			echo "<script>location.href='house.php?info=home';</script>";
			exit;
		}
	
		if (!isset($_POST['ptype']) AND $row['gold'] >= $buy_item['cost_gold'])
		{
			if ($col['count(*)']==0)
			{
				count_query("INSERT INTO items_p(model,uid,item_num,stat,vol) VALUES ('".$model."','".$row['id_user']."','".$uid."', 'off','1')");
			}
			else
			{
				count_query("UPDATE items_p SET  vol=vol+1 WHERE uid = '".$row['id_user']."' AND item_num='".$uid."'");
			}
			count_query("UPDATE users SET  gold=gold-'".$buy_item['cost_gold']."' WHERE email = '".$_SESSION['email']."'");
			$senks = "<div class='message'>Спасибо за покупку!</div>";
		}
		else 
		{
			$senks = "<div class='message'>Не хватает денег</div>";
		}
		if (isset($_POST['ptype']))
		{
			if ($_POST['ptype'] == 2 AND $row['zelen'] >= $buy_item['cost_zelen'])
			{
				if ($col['count(*)']==0)
				{
					count_query("INSERT INTO items_p(model,uid,item_num,stat,vol) VALUES ('".$model."','".$row['id_user']."','".$uid."', 'off','1')");
				}
				else
				{
					count_query("UPDATE items_p SET  vol=vol+1 WHERE uid = '".$row['id_user']."' AND item_num='".$uid."'");
				}
				count_query("UPDATE users SET  zelen=zelen-'".$buy_item['cost_zelen']."' WHERE email = '".$_SESSION['email']."'");
				$senks = "<div class='message'>Спасибо за покупку!</div>";
			}
			else if ($_POST['ptype'] == 1 AND $row['krystal'] >= $buy_item['cost_krystal'])
			{
				if ($col['count(*)']==0)
				{
					count_query("INSERT INTO items_p(model,uid,item_num,stat,vol) VALUES ('".$model."','".$row['id_user']."','".$uid."', 'off','1')");
				}
				else
				{
					count_query("UPDATE items_p SET  vol=vol+1 WHERE uid = '".$row['id_user']."' AND item_num='".$uid."'");
				}
				count_query("UPDATE users SET  krystal=krystal-'".$buy_item['cost_krystal']."' WHERE email = '".$_SESSION['email']."'");
				$senks = "<div class='message'>Спасибо за покупку!</div>";
			}
			else
			{
				$senks = "<div class='message'>Не хватает денег</div>";
			}
		}
	}
	else if ($_POST['cmd'] == "sell")
	{
		if ($sell_col['vol']==1)
		{
			count_query("DELETE FROM `items_p` WHERE `item_num`='".$_POST['id']."'");
		}
		else
		{
			count_query("UPDATE items_p SET  vol=vol-1 WHERE uid = '".$row['id_user']."' AND item_num='".$_POST['id']."'");
		}
		$g = round($sell_item['cost_gold']*25/100);
		count_query("UPDATE users SET  gold=gold+'".$g."' WHERE email = '".$_SESSION['email']."'");
		echo "<script>location.href='?a=sell&group=".$group."'</script>";
	}
}

if (is_numeric($_GET['id']) AND $a == null)
{
$zapBuyGift = count_query("SELECT * FROM `gift` WHERE `id`='".$_GET['id']."' AND `eye`='1'");
$zapNumGift = mysql_num_rows($zapBuyGift);
if ($zapNumGift == 0) {
	loca('shop.php?group=8');
}
if (isset($_POST['gift']))
{
	if ($_POST['gift'] == 'buy')
	{
		$zapBuyGift = count_query("SELECT * FROM `gift` WHERE `id`='".$_GET['id']."' AND `eye`='1'");
		$zapNumGift = mysql_num_rows($zapBuyGift);
		if ($zapNumGift > 0)
		{
			$zapRowGift = mysql_fetch_array($zapBuyGift);
			switch ($zapRowGift['cost'])
			{
				case 1: $mm = $zapRowGift['price']; $cm = 'gold'; break;
				case 2: $mm = $zapRowGift['price']; if ($_POST['ptype'] == 1) {$cm = 'krystal';} else {$cm = 'zelen';} break;
			}
			if ($row[$cm] >= $mm)
			{
				count_query("UPDATE `users` SET ".$cm."=".$cm."-".$mm." WHERE id_user='".$row['id_user']."'") or die(mysql_error());
				count_query("INSERT INTO `gifts_p` (`uid_g`,`gift_num`) VALUES ('".$row['id_user']."','".$zapRowGift['id']."')") or die(mysql_error());
				$senks = "<div class='message'>Спасибо за покупку!</div>";
			}
			else {
				$senks = "<div class='message'>Не хватает денег</div>";
			}
		} else {
			loca('shop.php?group=8');
		}
	}
}
}

if ($a == "sell")
{
	$t = "a=sell&";
}
else
{
	$t = "";
}

$row_item = count_query("SELECT * FROM `item` WHERE `lvl` <= '".(lvl($row['exp'])+3)."' ORDER BY `lvl` DESC");
if ($a == "info")
{
	$object = mysql_fetch_array(count_query("SELECT * FROM item WHERE id = '".$_GET['id']."'"));
	if ($object['pow'] > 0) { $r_pow = "Сила +".$object['pow']."<br />"; } else { $r_pow = ""; }
	if ($object['def'] > 0) { $r_def = "Защита +".$object['def']."<br />"; } else { $r_def = ""; }
	if ($object['abi'] > 0) { $r_abi = "Ловкость +".$object['abi']."<br />"; } else { $r_abi = ""; }
	if ($object['mas'] > 0) { $r_mas = "Масса +".$object['mas']."<br />"; } else { $r_mas = ""; }
	if ($object['skil'] > 0) { $r_skil = "Мастерство +".$object['skil']."<br />"; } else { $r_skil = ""; }
	
	$item_number2 = mysql_fetch_array(count_query("SELECT * FROM `items_p` WHERE `item_num`='".$object['id']."' AND uid='".$row['id_user']."'"));
	if ($item_number2['vol'] != null AND $item_number2['id'] != null) {
		$kol = $item_number2['vol'];
	} else {
		$kol = 0;
	}

	$info_buy= "<tr>
        <td height='750' width='574' align='center' valign='top' background='images/site_01_07.png' bgcolor='#EBDBC1'>
<div class='blockHead'><img src='images/RU/titles/h_lavka.png' alt='Лавка' /></div>
			
		<div class='contentBlock' id='contentBlock'><a href='?group=".$object['model']."' class='back'><img src='images/RU/b_back_p.png' alt='Назад' class='cmd'
								onMouseOver=\"doImage(this,'RU/b_back')\" /></a><div class='message'>".$senks."</div>	<div class='inputGroup inputSmall inputNoHeight ' >
		<div class='top'><div class='top1'><div class='top2'></div></div></div>
		
		<div class='c1' >
			<div class='content' ><div class='title'>".$object['item']." <span class='text_main_4 nobold'>(Ваши вещи: ".$kol." шт.)</div><div class='body'><table class='default'>
	<tr><td class='img top' style='padding-right:10px'><img src='images/items/".$object['bname'].".jpg' alt='".$object['item']."' width='180' height='180'/>
		<td style='width:340px' class='item_shop_info'><b>Характеристики:</b><br />".$r_pow."".$r_def."".$r_abi."".$r_mas."".$r_skil."<b>Требования для покупки:</b><br />Минимальный уровень: ".$object['lvl']."
</table>

	<center class='shop' style='width:300px;margin:0 auto' ><form method='POST' action='?a=info&id=".$object['id']."' class='inline'>
			<input type='hidden' name='cmd' value='buy'>

			<input type='image' name='do_buy' class='image cmd' src='images/RU/b_market_buy_p.png' alt='Купить'
					onMouseOver=\"doImage(this,'RU/b_market_buy',null)\"/ >
			<span class='price'><b>Цена покупки: ".$object['cost_gold']." <img src='/images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'></b></span></form></center></div></div>
		</div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
<br />	<div class='inputGroup inputSmall inputNoHeight ' >
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1' >
			<div class='content' ><div class='title'>Подробнее</div><div class='body'><b>Эффект улучшения в кузнице:</b><br />
В кузнице вы можете улучшить вещь 5 раз. Каждое улучшение поднимает уровень вещи на 5.<br /><br />

Вещь 6 уровня: +5% ловкости<br />
Вещь 11 уровня: +10% ловкости<br />
Вещь 16 уровня: +15% ловкости<br />
Вещь 21 уровня: +20% ловкости<br />
Вещь 26 уровня: +25% ловкости<br />

</div></div>
		</div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
<br /></div>	</td></tr>";
echo $info_buy;
}
else
{
?>
      <tr>
        <td height="750" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class='blockHead'><img src='images/RU/titles/h_lavka.png' alt='Лавка' /></div>
			
		<div class='contentBlock' id='contentBlock'><a href='village.php' ><img src='images/RU/b_back_p.png' alt='Назад' class='cmd'
								onMouseOver="doImage(this,'RU/b_back','skip')" /></a><?php if ($a == "sell") {?><a href='?group=<?=$group;?>' ><img src='images/RU/buttons/b_shop_buy_p.png' alt='Продажи' class='cmd'
								onMouseOver="doImage(this,'RU/buttons/b_shop_buy','skip')" /></a><?php } else { ?><a href='?a=sell&amp;group=<?=$group;?>' ><img src='images/RU/buttons/b_shop_sell_p.png' alt='Продажи' class='cmd'
								onMouseOver="doImage(this,'RU/buttons/b_shop_sell','skip')" /></a><?php } ?><table class='up_avatar'><tr><td class='avatar'><img src='images/market_man.jpg' alt='Торговец Попандопулус'>	</td><td>	<div class='inputGroup inputSmall ' >
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1' style='height:180px !important'>
			<div class='content' ><div class='title'>Торговец Попандопулус</div><div class='body'>Я видеть большой ходячий кошелек. Я очень радый!<br /><br />
Прошу простить мой свинячо-бараний диалект. Видит Махайлай-Бахалай, выучить здешний набор блеяний и хрюканий не такой простой задача. Ты давать мене деньга, я давать тебе крутой скалка, ведро на голова и бутылочка зеленки.<br /><br />
У меня много есть разный мусор для тебя. Выбирай, покупай!<br /><br />
</div></div>
		</div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
</td></tr></table><?=$senks;?><center>
				<a href='?<?=$t;?>group=1' ><img src='<?php if ($group == 1) {?>images/RU/b_market_zel_a.png<?php } else {?>images/RU/b_market_zel_p.png<?php } ?>' alt='Зелья' class='cmd'
				onMouseOver="doImage(this,'RU/b_market_zel',<?php if ($group == 1) {?>'active'<?php } else {?>'skip'<?php } ?>)" /></a><a href='?<?=$t;?>group=2' ><img src='<?php if ($group == 2) {?>images/RU/b_market_weap_a.png<?php } else {?>images/RU/b_market_weap_p.png<?php } ?>' alt='Оружие' class='cmd' 
				onMouseOver="doImage(this,'RU/b_market_weap',<?php if ($group == 2) {?>'active'<?php } else {?>'skip'<?php } ?>)" /></a><a href='?<?=$t;?>group=3' ><img src='<?php if ($group == 3) {?>images/RU/b_market_def_a.png<?php } else {?>images/RU/b_market_def_p.png<?php } ?>' alt='Щиты' class='cmd'
				onMouseOver="doImage(this,'RU/b_market_def',<?php if ($group == 3) {?>'active'<?php } else {?>'skip'<?php } ?>)" /></a><a href='?<?=$t;?>group=4' ><img src='<?php if ($group == 4) {?>images/RU/b_market_hd_a.png<?php } else {?>images/RU/b_market_hd_p.png<?php } ?>' alt='Шлемы' class='cmd'
				onMouseOver="doImage(this,'RU/b_market_hd',<?php if ($group == 4) {?>'active'<?php } else {?>'skip'<?php } ?>)" /></a><a href='?<?=$t;?>group=5' ><img src='<?php if ($group == 5) {?>images/RU/b_market_dos_a.png<?php } else {?>images/RU/b_market_dos_p.png<?php } ?>' alt='Доспехи' class='cmd'
				onMouseOver="doImage(this,'RU/b_market_dos',<?php if ($group == 5) {?>'active'<?php } else {?>'skip'<?php } ?>)" /></a><a href='?<?=$t;?>group=6' ><img src='<?php if ($group == 6) {?>images/RU/b_market_amlt_a.png<?php } else {?>images/RU/b_market_amlt_p.png<?php } ?>' alt='Кулоны' class='cmd'
				onMouseOver="doImage(this,'RU/b_market_amlt',<?php if ($group == 6) {?>'active'<?php } else {?>'skip'<?php } ?>)" /></a><a href='?<?=$t;?>group=7' ><img src='<?php if ($group == 7) {?>images/RU/b_market_anml_a.png<?php } else {?>images/RU/b_market_anml_p.png<?php } ?>' alt='Звери' class='cmd'
				onMouseOver="doImage(this,'RU/b_market_anml',<?php if ($group == 7) {?>'active'<?php } else {?>'skip'<?php } ?>)" /></a><a href='?<?=$t;?>group=8' ><img src='<?php if ($group == 8) {?>images/RU/b_market_gift_a.png<?php } else {?>images/RU/b_market_gift_p.png<?php } ?>' alt='Подарки' class='cmd' onMouseOver="doImage(this,'RU/b_market_gift',<?php if ($group == 8) {?>'active'<?php } else {?>'skip'<?php } ?>)" /></a>
				<?php if ($group == 6) {
							$activ = 'skip';
							$activ2 = 'skip';
							$activ3 = 'skip';
							$img_activ = 'p';
							$img_activ2 = 'p';
							$img_activ3 = 'p';
							switch ($_GET['sub'])
							{
								case null: $activ = 'active'; $img_activ = 'a'; break;
								case 1: $activ = 'active'; $img_activ = 'a'; break;
								case 2: $activ2 = 'active'; $img_activ2 = 'a'; break;
								case 3: $activ3 = 'active'; $img_activ3 = 'a'; break;
							}
							echo "<a href='?group=6&amp;sub=1' ><img src='images/RU/b_amlt_b_".$img_activ.".png' alt='Боевые' class='small'
								onMouseOver=\"doImage(this,'RU/b_amlt_b','".$activ."')\" /></a><a href='?group=6&amp;sub=2' ><img src='images/RU/b_amlt_w_".$img_activ2.".png' alt='Трудовые' class='small'
								onMouseOver=\"doImage(this,'RU/b_amlt_w','".$activ2."')\" /></a><a href='?group=6&amp;sub=3' ><img src='images/RU/b_amlt_m_".$img_activ3.".png' alt='Разные' class='small'
								onMouseOver=\"doImage(this,'RU/b_amlt_m','".$activ3."')\" /></a>";} ?>
		</center>	<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>		
		<div class='c1'><div class='content'><div class='b2'><table class='default shop'>	
		<?php 
		if ($a == "sell")
		{
			$ind = 0;
			while ($item_number['id'])
			{
			if ($item_number['stat'] == 'off')
			{
				if ($item_number['vol'] != null AND $item_number['id'] != null) {
					$kol = $item_number['vol'];
				} else {
					$kol = 0;
				}
				if ($item_number['health'] == 0) {
					$hp = $item_number['hp_perc']."%"; 
				} else { 
					$hp = $item_number['health']; 
				}
				if ($item_number['cost_gold'] == 0) {
					$money = "<input type='radio' name='ptype' value='1' />".$item_number['cost_crystal']." <img src='images/ico_krist1.png' alt='Кристалл' align='absmiddle' class='png'> / <input type='radio' name='ptype' value='2' checked/>".$item_number['cost_zelen']." <img src='images/ico_green1.png' alt='Зелень' align='absmiddle' class='png'>";
				} else {
					$money = $item_number['cost_gold']." <img src='images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'>";
				}
				$txt = "<tr><td colspan=2 class='center remove'>";
				$txt .= "<tr><th class='row_1' colspan=2>".$item_number['item']." <span class='text_main_4 nobold'>(Ваши вещи: ".$kol." шт.)";
				$txt .= "<tr><td class='img top' rowspan=3 width=70>";
				$txt .= "<img src='images/items/".$item_number['sname'].".jpg' alt='".$item_number['item']."' onMouseOver=\"doItem('".$item_number['id_i']."','','','0',event,this)\"  width='60' height='60'/><br /><br />";
				if ($group == 1) {$txt .= "<td class='item_shop_info'><b>Характеристики:</b><br />Здоровье +".$hp;}
				if ($group > 1 AND $group < 6) {$txt .= "<td class='item_shop_info'><b>Характеристики:</b><br />Минимальный уровень: ".$item_number['lvl'];}
				$txt .= "<tr><td class='row_4'><form method='POST' action='?a=buy&id=".$item_number['id']."&group=".$group."' class='inline'><input type='hidden' name='cmd' value='buy'>";
				$txt .= "<span class='price'><b>Цена покупки: ".$money." </b></span></form><tr><td class='row_2'><span class='price'><b>Цена продажи: ".round(($item_number['cost_gold']*25)/100)." <img src='images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'></b></span></form>";
				$txt .= "<tr><td colspan=2 class='center remove'><form method='post' class='inline' action='?a=sell&group=".$group."'><input type='hidden' name='cmd' value='sell' /><input type='hidden' name='id' value='".$item_number['item_num']."' /><input type='image' name='' class='image cmd' src='images/RU/buttons/b_prd2_p.png' alt='Продать'
					onMouseOver=\"doImage(this,'RU/buttons/b_prd2',null)\"/ ></form>";
				switch ($group)
				{
					case 1: if ($item_number['model'] == 1) {echo $txt; $ind++;} break;
					case 2: if ($item_number['model'] == 2) {echo $txt; $ind++;} break;
					case 3: if ($item_number['model'] == 3) {echo $txt; $ind++;} break;
					case 4: if ($item_number['model'] == 4) {echo $txt; $ind++;} break;
					case 5: if ($item_number['model'] == 5) {echo $txt; $ind++;} break;
					case 6: if ($item_number['model'] == 6) {echo $txt; $ind++;} break;
				}
			}
				$item_number = mysql_fetch_array($c_row);
			}
			if ($ind == 0)
			{
				echo "<tr><td colspan=2 class='center remove'>Полка пуста</td></tr>";
			}
		}
		else if ($a == null OR $a == "buy")
		{
		$ind = 0;
		
		$zapGifts = count_query("SELECT * FROM `gift` WHERE `eye`='1' ORDER BY `id` DESC");
		
		while ($rowGift = mysql_fetch_array($zapGifts))
		{
			switch ($rowGift['cost'])
			{
				case 2: $moneyGift = "<input type='radio' name='ptype' value='1' />".$rowGift['price']." <img src='images/ico_krist1.png' alt='Кристалл' align='absmiddle' class='png'> / <input type='radio' name='ptype' value='2' checked/>".$rowGift['price']." <img src='images/ico_green1.png' alt='Зелень' align='absmiddle' class='png'>"; break;
				case 1: $moneyGift = $rowGift['price']." <img src='images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'>"; break;
			}
			switch ($rowGift['sell_cost'])
			{
				case 2: $sellGift = $rowGift['sell_price']."<img src='images/ico_krist1.png' alt='Кристалл' align='absmiddle' class='png'>"; break;
				case 1: $sellGift = $rowGift['sell_price']."<img src='images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'>"; break;
			}
			$outText = "<tr><th class='row_1' colspan=2>".$rowGift['name']." <span class='text_main_4 nobold'>(Ваши вещи: 0 шт.)
<tr class='row_4'>
	<td rowspan='2' class='img2'><img src='images/items/".$rowGift['pic'].".jpg' alt='".$rowGift['name']."'  onMouseOver=\"doItem('".$rowGift['when']."','','','0',event,this)\"  />
	<td><form method='POST' action='?group=8&id=".$rowGift['id']."' class='inline'>
			<input type='hidden' name='gift' value='buy'>

			<input type='image' name='do_buy' class='image cmd' src='images/RU/b_market_buy_p.png' alt='Купить'
					onMouseOver=\"doImage(this,'RU/b_market_buy',null)\"/ >
			<span class='price'><b>Цена покупки: ".$moneyGift."</b></span></form>
<tr><td><span class='price'><b>Цена продажи: ".$sellGift."</form>";
			$ind++;
			if ($group == 8)
			{
				echo $outText;
			}
		}
		
		while ($item = mysql_fetch_array($row_item)) {
			$item_number = mysql_fetch_array(count_query("SELECT * FROM `items_p` WHERE `item_num`='".$item['id']."' AND uid='".$row['id_user']."'"));
			if ($item_number['vol'] != null AND $item_number['id'] != null) {
				$kol = $item_number['vol'];
			} else {
				$kol = 0;
			}
			if ($item['who'] == 1) {
				$player = "Здоровье"; 
			} else if ($item['who'] == 2) { 
				$player = "Здоровье зверушки"; 
			}
			if ($item['health'] == 0) {
				$hp = $item['hp_perc']."%"; 
			} else { 
				$hp = $item['health']; 
			}
			if ($item['cost_gold'] == 0) {
				$money = "<input type='radio' name='ptype' value='1' />".$item['cost_crystal']." <img src='images/ico_krist1.png' alt='Кристалл' align='absmiddle' class='png'> / <input type='radio' name='ptype' value='2' checked/>".$item['cost_zelen']." <img src='images/ico_green1.png' alt='Зелень' align='absmiddle' class='png'>";
			} else {
				$money = $item['cost_gold']." <img src='images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'>";
			}
			if ($group == 4){
				$price = 26.6;
			} else {
				$price = 25;
			}
			
			$txt = "<tr><td colspan=2 class='center remove'>";
			$txt .= "<tr><th class='row_1' colspan=2>".$item['item']." <span class='text_main_4 nobold'>(Ваши вещи: ".$kol." шт.)";
			$txt .= "<tr><td class='img top' rowspan=3 width=70>";
			$txt .= "<img src='images/items/".$item['sname'].".jpg' alt='".$item['item']."' onMouseOver=\"doItem('".$item['id_i']."','','','0',event,this)\"  width='60' height='60'/><br /><br />";
			if ($group > 1 AND $group < 6) {$txt .= "<a href='?a=info&amp;id=".$item['id']."' ><img src='images/RU/buttons/b_moreinfo2_p.png' alt='Подробнее' class='cmd2' onMouseOver=\"doImage(this,'RU/buttons/b_moreinfo2','skip')\" /></a>";}
			if ($group == 1) {$txt .= "<td class='item_shop_info'><b>Характеристики:</b><br />".$player." +".$hp;}
			if ($group > 1 AND $group < 6) {$txt .= "<td class='item_shop_info'><b>Характеристики:</b><br />Минимальный уровень: ".$item['lvl'];}
			$txt .= "<tr><td class='row_4'><form method='POST' action='?a=buy&id=".$item['id']."&group=".$group."' class='inline'><input type='hidden' name='cmd' value='buy'><input type='image' name='do_buy' class='image cmd' src='images/RU/b_market_buy_p.png' alt='Купить' onMouseOver=\"doImage(this,'RU/b_market_buy',null)\"/ >";
			$txt .= "<span class='price'><b>Цена покупки: ".$money." </b></span></form><tr><td class='row_2'><span class='price'><b>Цена продажи: ".round(($item['cost_gold']*$price)/100)." <img src='images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'></b></span></form>";
			
			switch ($group)
			{
				case 1: if ($item['model'] == 1) {echo $txt; $ind++;} break;
				case 2: if ($item['model'] == 2) {echo $txt; $ind++;} break;
				case 3: if ($item['model'] == 3) {echo $txt; $ind++;} break;
				case 4: if ($item['model'] == 4) {echo $txt; $ind++;} break;
				case 5: if ($item['model'] == 5) {echo $txt; $ind++;} break;
				case 6: if ($item['model'] == 6) {echo $txt; $ind++;} break;
			}
			}
			if ($ind == 0)
			{
				echo "<tr><td colspan=2 class='center remove'>Полка пуста</td></tr>";
			}
		}
		?>		
</table></div></div></div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div><script>$(document).ready(function() {addTradeImages();})</script></div>	</td></tr>
<?php } include ("footer_tpl.php"); ?>