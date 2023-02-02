<?php
include ("top_tpl.php");

$house_cost = pl_cost($row['house'],'house');
$cage_cost = pl_cost($row['cage'],'cage');
$fence_cost  = pl_cost($row['fence'],'fence');
$road_cost   = pl_cost($row['road'],'road');
$out_cost   = pl_cost($row['out'],'out');

$buy = $_POST['buy'];
$ptype = $_POST['ptype'];
$info = $_GET['info'];
$info2 = $_GET['info2'];

if (isset($buy))
{
	switch($buy)
	{
		case "safe": $type = "safe"; $t = 1209600; $krystal = 30; $zelen = 30; break;
		case "safe2": $type = "safe2"; $t = 1209600; $krystal = 10; $zelen = 10; break;
		case "safe3": $type = "safe3"; $t = 1209600; $krystal = 250; $zelen = 250; break;
		case "safe4": $type = "safe4"; $t = 1209600; $krystal = 100; $zelen = 100; break;
		case "woodoo": $type = "woodoo"; $t = 2419200; $krystal = 30; $zelen = 30; break;
		case "woodoo2": $type = "woodoo2"; $t = 2419200; $krystal = 30; $zelen = 30; break;
		case "totem": $type = "woodoo3"; $t = 2419200; $krystal = 30; $zelen = 30; break;
		case "totem2": $type = "woodoo4"; $t = 2419200; $krystal = 30; $zelen = 30; break;
	}
	if (isset($ptype))
	{
		if ($type == "safe3")
		{
			if (lvl($row['exp']) < 25)
			{
				$err = "<div class='message'>Для покупки нужен как минимум 25 уровень</div>";
			}
		}
		if ($type == "safe4")
		{
			if (lvl($row['exp']) < 25)
			{
				$err = "<div class='message'>Для покупки нужен как минимум 25 уровень</div>";
			}
		}
		if ($err == "")
		{
			if ($ptype == 1)
			{
				if ($row['krystal'] >= $krystal)
				{
					/* buy and activate */
					if($row[$type]>time())
					{
						$time=$row[$type]+$t;
					}
					else
					{
						$time=time()+$t;
					} 
					count_query("UPDATE users SET  ".$type."='".$time."', krystal=krystal-'".$krystal."' WHERE id_user = '".$row['id_user']."'");
					echo "<script>location.href='house.php';</script>";
					exit;
				}
				else
				{
					$err = "<div class='message'>Нет денег</div>";
				}
			} 
			else if ($ptype == 2) 
			{
				if ($row['zelen'] >= $zelen)
				{
					/* buy and activate */
					if($row[$type]>time())
					{
						$time=$row[$type]+$t;
					}
					else
					{
						$time=time()+$t;
					} 
					count_query("UPDATE users SET  ".$type."='".$time."', zelen=zelen-'".$zelen."' WHERE id_user = '".$row['id_user']."'");
					echo "<script>location.href='house.php';</script>";
					exit;
				}
				else
				{
					$err = "<div class='message'>Нет денег</div>";
				}
			}
		}
	}
}

if (isset($info2))
{
	switch ($info2)
	{
		case "safe": include ("home/abilki.php"); break;
		case "safe2": include ("home/abilki.php"); break;
		case "safe3": include ("home/abilki.php"); break;
		case "safe4": include ("home/abilki.php"); break;
		case "woodoo": include ("home/abilki.php"); break;
		case "woodoo2": include ("home/abilki.php"); break;
		case "totem": include ("home/abilki.php"); break;
		case "totem2": include ("home/abilki.php"); break;
	}
}
else if (isset($info))
{
	switch ($info)
	{		
		case "home": include ("home/home.php"); break;
		case "cage": include ("home/cage.php"); break;
		case "fence": include ("home/fence.php"); break;
		case "road": include ("home/road.php"); break;
		case "out": include ("home/out.php"); break;
	}
}
else
{
?>
      <tr>
        <td height="700" width="574" align="center" valign="top" background="images/site_01_07.png" bgcolor="#EBDBC1">
<div class='blockHead'><img src='images/RU/titles/h_house.png' alt='Жилище' /></div>
			
		<div class='contentBlock' id='contentBlock'>	<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'><div class='content'><div class='b2'><div class='contentBlock'><div id='houseDiv' style="background:url('images/house/101.jpg')">
				<div style="background:url('images/house/3000000.png')">
					<div style="background:url('images/house/210.png')"></div>
				</div>
			</div>
			</div></div></div></div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div><?=$err;?>	<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'><div class='content'><div class='b2'><table class='default center' style='width:500px'><tr><th width=100><th>Постройка	<th>Статус	<th>Цена<tr class='row_3'><td><a href='house.php?info2=safe'>
					<img src='images/house/b_safe_p.png' id='img1'	onmouseover="doImageHover(1);doItem('safe','<br />Защищает 960 <img src=\'images/ico_gold1.png\' alt=\'Золото\' align=\'absmiddle\' class=\'png\'>','','0',event,this)" onmouseout='doImageHover(1,false);hide_tooltip();'   height=75 width=100></a>
					<td width=150><a href='house.php?info2=safe'  onmouseover='doImageHover(1)' onmouseout='doImageHover(1,false)' ><b>Сейф</b></a><br />
						<span style='font-size:10px'>
						<?php
						if ($row['safe'] > 0)
						{
							echo "действует до: ".date('j.m.Y H:i', $row['safe']);
						}
						?>
						</span><br />
					<td>
					<?php
					if ($row['safe'] == 0)
					{
						echo "не активен";
					}
					else
					{
						echo "активен";
					}
					?>
					<td width=140><form method='POST' action=''>
						<input type='hidden' name='buy' value='safe'>
						<input type='radio' name='ptype' value='1' />30 <img src='images/ico_krist1.png' alt='Кристалл' align='absmiddle' class='png'> / <input type='radio' name='ptype' value='2' checked/>30 <img src='images/ico_green1.png' alt='Зелень' align='absmiddle' class='png'><br /><br />
						<input type='image' name='cmd' class='image ' src='images/RU/buttons/b_buy_p.png' alt='Купить'
					onMouseOver="doImage(this,'RU/buttons/b_buy',null)"/ >
						</form><tr class='row_3'><td><a href='house.php?info2=safe3'>
					<img src='images/house/b_safe3_p.png' id='img2'	onmouseover="doImageHover(2);doItem('safe3','<br />Защищает 0 <img src=\'images/ico_gold1.png\' alt=\'Золото\' align=\'absmiddle\' class=\'png\'>','','0',event,this)" onmouseout='doImageHover(2,false);hide_tooltip();'   height=75 width=100></a>
					<td width=150><a href='house.php?info2=safe3'  onmouseover='doImageHover(2)' onmouseout='doImageHover(2,false)' ><b>Золотой сейф</b></a><br />
						<span style='font-size:10px'>
						<?php
						if ($row['safe3'] > 0)
						{
							echo "действует до: ".date('j.m.Y H:i', $row['safe3']);
						}
						?>
						</span><br />
					<td>
					<?php
					if ($row['safe3'] == 0)
					{
						echo "не активен";
					}
					else
					{
						echo "активен";
					}
					?>
					<td width=140><form method='POST' action=''>
						<input type='hidden' name='buy' value='safe3'>
						<input type='radio' name='ptype' value='1' />250 <img src='images/ico_krist1.png' alt='Кристалл' align='absmiddle' class='png'> / <input type='radio' name='ptype' value='2' checked/>250 <img src='images/ico_green1.png' alt='Зелень' align='absmiddle' class='png'><br /><br />
						<input type='image' name='cmd' class='image ' src='images/RU/buttons/b_buy_p.png' alt='Купить'
					onMouseOver="doImage(this,'RU/buttons/b_buy',null)"/ >
						</form><tr class='row_3'><td><a href='house.php?info2=safe2'>
					<img src='images/house/b_safe2_p.png' id='img3'	onmouseover="doImageHover(3);doItem('safe2','<br />Защищает 5 <img src=\'images/ico_krist1.png\' alt=\'Кристалл\' align=\'absmiddle\' class=\'png\'>','','0',event,this)" onmouseout='doImageHover(3,false);hide_tooltip();'   height=75 width=100></a>
					<td width=150><a href='house.php?info2=safe2'  onmouseover='doImageHover(3)' onmouseout='doImageHover(3,false)' ><b>Кристальный сейф</b></a><br />
						<span style='font-size:10px'>
						<?php
						if ($row['safe2'] > 0)
						{
							echo "действует до: ".date('j.m.Y H:i', $row['safe2']);
						}
						?>
						</span><br />
					<td>
					<?php
					if ($row['safe2'] == 0)
					{
						echo "не активен";
					}
					else
					{
						echo "активен";
					}
					?>
					<td width=140><form method='POST' action=''>
						<input type='hidden' name='buy' value='safe2'>
						<input type='radio' name='ptype' value='1' />10 <img src='images/ico_krist1.png' alt='Кристалл' align='absmiddle' class='png'> / <input type='radio' name='ptype' value='2' checked/>10 <img src='images/ico_green1.png' alt='Зелень' align='absmiddle' class='png'><br /><br />
						<input type='image' name='cmd' class='image ' src='images/RU/buttons/b_buy_p.png' alt='Купить'
					onMouseOver="doImage(this,'RU/buttons/b_buy',null)"/ >
						</form><tr class='row_3'><td><a href='house.php?info2=safe4'>
					<img src='images/house/b_safe4_p.png' id='img4'	onmouseover="doImageHover(4);doItem('safe4','<br />Защищает 0 <img src=\'images/ico_krist1.png\' alt=\'Кристалл\' align=\'absmiddle\' class=\'png\'>','','0',event,this)" onmouseout='doImageHover(4,false);hide_tooltip();'   height=75 width=100></a>
					<td width=150><a href='house.php?info2=safe4'  onmouseover='doImageHover(4)' onmouseout='doImageHover(4,false)' ><b>Улучшенный Кристальный сейф</b></a><br />
						<span style='font-size:10px'>
						<?php
						if ($row['safe4'] > 0)
						{
							echo "действует до: ".date('j.m.Y H:i', $row['safe4']);
						}
						?>
						</span><br />
					<td>
					<?php
					if ($row['safe4'] == 0)
					{
						echo "не активен";
					}
					else
					{
						echo "активен";
					}
					?>
					<td width=140><form method='POST' action=''>
						<input type='hidden' name='buy' value='safe4'>
						<input type='radio' name='ptype' value='1' />100 <img src='images/ico_krist1.png' alt='Кристалл' align='absmiddle' class='png'> / <input type='radio' name='ptype' value='2' checked/>100 <img src='images/ico_green1.png' alt='Зелень' align='absmiddle' class='png'><br /><br />
						<input type='image' name='cmd' class='image ' src='images/RU/buttons/b_buy_p.png' alt='Купить'
					onMouseOver="doImage(this,'RU/buttons/b_buy',null)"/ >
						</form><tr class='row_3'><td><a href='house.php?info2=woodoo'>
					<img src='images/house/b_woodoo_p.png' id='img5'	onmouseover="doImageHover(5);doItem('woodoo','','','0',event,this)" onmouseout='doImageHover(5,false);hide_tooltip();'   height=75 width=100></a>
					<td width=150><a href='house.php?info2=woodoo'  onmouseover='doImageHover(5)' onmouseout='doImageHover(5,false)' ><b>Кукла Вуду</b></a><br />
						<span style='font-size:10px'>
						<?php
						if ($row['woodoo'] > 0)
						{
							echo "действует до: ".date('j.m.Y H:i', $row['woodoo']);
						}
						?>
						</span><br />
					<td>
					<?php
					if ($row['woodoo'] == 0)
					{
						echo "не активен";
					}
					else
					{
						echo "активен";
					}
					?>
					<td width=140><form method='POST' action=''>
						<input type='hidden' name='buy' value='woodoo'>
						<input type='radio' name='ptype' value='1' />30 <img src='images/ico_krist1.png' alt='Кристалл' align='absmiddle' class='png'> / <input type='radio' name='ptype' value='2' checked/>30 <img src='images/ico_green1.png' alt='Зелень' align='absmiddle' class='png'><br /><br />
						<input type='image' name='cmd' class='image ' src='images/RU/buttons/b_buy_p.png' alt='Купить'
					onMouseOver="doImage(this,'RU/buttons/b_buy',null)"/ >
						</form><tr class='row_3'><td><a href='house.php?info2=woodoo2'>
					<img src='images/house/b_woodoo2_p.png' id='img6'	onmouseover="doImageHover(6);doItem('woodoo2','','','0',event,this)" onmouseout='doImageHover(6,false);hide_tooltip();'   height=75 width=100></a>
					<td width=150><a href='house.php?info2=woodoo2'  onmouseover='doImageHover(6)' onmouseout='doImageHover(6,false)' ><b>Знак Вуду</b></a><br />
						<span style='font-size:10px'>
						<?php
						if ($row['woodoo2'] > 0)
						{
							echo "действует до: ".date('j.m.Y H:i', $row['woodoo2']);
						}
						?>
						</span><br />
					<td>
					<?php
					if ($row['woodoo2'] == 0)
					{
						echo "не активен";
					}
					else
					{
						echo "активен";
					}
					?>
					<td width=140><form method='POST' action=''>
						<input type='hidden' name='buy' value='woodoo2'>
						<input type='radio' name='ptype' value='1' />30 <img src='images/ico_krist1.png' alt='Кристалл' align='absmiddle' class='png'> / <input type='radio' name='ptype' value='2' checked/>30 <img src='images/ico_green1.png' alt='Зелень' align='absmiddle' class='png'><br /><br />
						<input type='image' name='cmd' class='image ' src='images/RU/buttons/b_buy_p.png' alt='Купить'
					onMouseOver="doImage(this,'RU/buttons/b_buy',null)"/ >
						</form><tr class='row_3'><td><a href='house.php?info2=totem'>
					<img src='images/house/b_totem_p.png' id='img7'	onmouseover="doImageHover(7);doItem('totem','','','0',event,this)" onmouseout='doImageHover(7,false);hide_tooltip();'   height=75 width=100></a>
					<td width=150><a href='house.php?info2=totem'  onmouseover='doImageHover(7)' onmouseout='doImageHover(7,false)' ><b>Бронзовый Тотем</b></a><br />
						<span style='font-size:10px'>
						<?php
						if ($row['woodoo3'] > 0)
						{
							echo "действует до: ".date('j.m.Y H:i', $row['woodoo3']);
						}
						?>
						</span><br />
					<td>
					<?php
					if ($row['woodoo3'] == 0)
					{
						echo "не активен";
					}
					else
					{
						echo "активен";
					}
					?>
					<td width=140><form method='POST' action=''>
						<input type='hidden' name='buy' value='totem'>
						<input type='radio' name='ptype' value='1' />30 <img src='images/ico_krist1.png' alt='Кристалл' align='absmiddle' class='png'> / <input type='radio' name='ptype' value='2' checked/>30 <img src='images/ico_green1.png' alt='Зелень' align='absmiddle' class='png'><br /><br />
						<input type='image' name='cmd' class='image ' src='images/RU/buttons/b_buy_p.png' alt='Купить'
					onMouseOver="doImage(this,'RU/buttons/b_buy',null)"/ >
						</form><tr class='row_3'><td><a href='house.php?info2=totem2'>
					<img src='images/house/b_totem2_p.png' id='img8'	onmouseover="doImageHover(8);doItem('totem2','','','0',event,this)" onmouseout='doImageHover(8,false);hide_tooltip();'   height=75 width=100></a>
					<td width=150><a href='house.php?info2=totem2'  onmouseover='doImageHover(8)' onmouseout='doImageHover(8,false)' ><b>Золотой Тотем</b></a><br />
						<span style='font-size:10px'>
						<?php
						if ($row['woodoo4'] > 0)
						{
							echo "действует до: ".date('j.m.Y H:i', $row['woodoo4']);
						}
						?>
						</span><br />
					<td>
					<?php
					if ($row['woodoo4'] == 0)
					{
						echo "не активен";
					}
					else
					{
						echo "активен";
					}
					?>
					<td width=140><form method='POST' action=''>
						<input type='hidden' name='buy' value='totem2'>
						<input type='radio' name='ptype' value='1' />30 <img src='images/ico_krist1.png' alt='Кристалл' align='absmiddle' class='png'> / <input type='radio' name='ptype' value='2' checked/>30 <img src='images/ico_green1.png' alt='Зелень' align='absmiddle' class='png'><br /><br />
						<input type='image' name='cmd' class='image ' src='images/RU/buttons/b_buy_p.png' alt='Купить'
					onMouseOver="doImage(this,'RU/buttons/b_buy',null)"/ >
						</form><tr class='row_3'><td><a href='house.php?info=home'><img src='images/house/b_home_p.png' id='img9'	onmouseover="doImageHover(9);doItem('home','<br />&bull; <b><?=$row['house']+2;?></b> слотов в инвентаре «Одевалка». <br />&bull; Бутылки:  <b><?=$row['house']+2;?></b> шт. каждого вида.','','0',event,this)" onmouseout='doImageHover(9,false);hide_tooltip();'    height=75 width=100></a>
				<td><a href='house.php?info=home' onmouseover='doImageHover(9)' onmouseout='doImageHover(9,false)' ><b>Хибара</b></a>
				<td>Уровень<br /><br />
					<?=$row['house'];?>	 / 10
				<td><?=$house_cost;?> <img src='images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'><br /><a href='house.php?info=home' ><img src='images/RU/buttons/b_look3_p.png' alt='Смотреть' class='cmd'
								onMouseOver="doImage(this,'RU/buttons/b_look3','skip')" /></a><tr class='row_3'><td><a href='house.php?info=cage'><img src='images/house/b_cage_p.png' id='img10'	onmouseover="doImageHover(10);doItem('cage','<br />Характеристики вашей зверушки составляют <b><?=$row['cage']*10+20?>%</b> от ваших боевых характеристик.','','0',event,this)" onmouseout='doImageHover(10,false);hide_tooltip();'    height=75 width=100></a>
				<td><a href='house.php?info=cage' onmouseover='doImageHover(10)' onmouseout='doImageHover(10,false)' ><b>Клетка</b></a>
				<td>Уровень<br /><br />
					<?=$row['cage'];?>	 / 8
				<td><?=$cage_cost;?> <img src='images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'><br /><a href='house.php?info=cage' ><img src='images/RU/buttons/b_look3_p.png' alt='Смотреть' class='cmd'
								onMouseOver="doImage(this,'RU/buttons/b_look3','skip')" /></a><tr class='row_3'><td><a href='house.php?info=fence'><img src='images/house/b_fence_p.png' id='img11'	onmouseover="doImageHover(11);doItem('fence','<br />&bull; <b>+<?=$row['fence']*2+2?></b> к защите от нападения врагов. <br />&bull; +<?php if ($row['fence'] < 3) {echo 0;} else if ($row['fence'] >= 3 AND $row['fence'] < 7) {echo 1;} else if ($row['fence'] >= 7 AND $row['fence'] < 10) {echo 2,5;} else if ($row['fence'] == 10) {echo 5;}?>% к общему значению характеристики «Защита».','','0',event,this)" onmouseout='doImageHover(11,false);hide_tooltip();'    height=75 width=100></a>
				<td><a href='house.php?info=fence' onmouseover='doImageHover(11)' onmouseout='doImageHover(11,false)' ><b>Ограда</b></a>
				<td>Уровень<br /><br />
					<?=$row['fence'];?>	 / 10
				<td><?=$fence_cost;?> <img src='images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'><br /><a href='house.php?info=fence' ><img src='images/RU/buttons/b_look3_p.png' alt='Смотреть' class='cmd'
								onMouseOver="doImage(this,'RU/buttons/b_look3','skip')" /></a><tr class='row_3'><td><a href='house.php?info=road'><img src='images/house/b_road_p.png' id='img12'	onmouseover="doImageHover(12);doItem('road','<br />&bull; Поиск по окрестностям <b><?=$row['road'];?></b> уровня и ниже. <br />&bull; Шанс <b><?=$row['road']+1;?>%</b> отменить бонусы Ограды противника.','','0',event,this)" onmouseout='doImageHover(12,false);hide_tooltip();'    height=75 width=100></a>
				<td><a href='house.php?info=road' onmouseover='doImageHover(12)' onmouseout='doImageHover(12,false)' ><b>Дорожка</b></a>
				<td>Уровень<br /><br />
					<?=$row['road'];?>	 / 10
				<td><?=$road_cost;?> <img src='images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'><br /><a href='house.php?info=road' ><img src='images/RU/buttons/b_look3_p.png' alt='Смотреть' class='cmd'
								onMouseOver="doImage(this,'RU/buttons/b_look3','skip')" /></a><tr class='row_3'><td><a href='house.php?info=out'><img src='images/house/b_out_p.png' id='img13'	onmouseover="doImageHover(13);doItem('out','<br />&bull; Защита от случайного поиска врагов с дорожкой <b><?php if ($row['out'] == 0) {echo 0;} else {echo $row['out']-1;}?></b> уровня и ниже.<br />&bull; <b><?php if ($row['out'] == 10) {echo 15;} else {echo $row['out']+1;} ?>%</b> шанс избежать боя с нападающим врагом.','','0',event,this)" onmouseout='doImageHover(13,false);hide_tooltip();'    height=75 width=100></a>
				<td><a href='house.php?info=out' onmouseover='doImageHover(13)' onmouseout='doImageHover(13,false)' ><b>Местность</b></a>
				<td>Уровень<br /><br />
					<?=$row['out'];?>	 / 10
				<td><?=$out_cost;?> <img src='images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'><br /><a href='house.php?info=out' ><img src='images/RU/buttons/b_look3_p.png' alt='Смотреть' class='cmd'
								onMouseOver="doImage(this,'RU/buttons/b_look3','skip')" /></a>
				</table></div></div></div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div></div>	</td></tr>
<?php
}
include ("footer_tpl.php");
?>