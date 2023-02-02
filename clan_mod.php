<?php
include ("top_tpl.php");

$clan = mysql_fetch_array(count_query("SELECT * FROM `clans` WHERE `id`='".$row['clan']."'"));
$zap_klog = count_query("SELECT * FROM `klog` WHERE `uid`='".$clan['id']."' ORDER BY `time` DESC");
$zap_memb = count_query("SELECT * FROM `users` WHERE `clan`='".$clan['id']."'");

$m = $_GET['m'];
$t = $_POST['type'];
$name = $_POST['name'];
$tag = $_POST['tag'];
$site = $_POST['site'];
$desc = $_POST['description'];
$change = $_POST['change'];

if ($clan['description'] == '')
{
	$d = "";
} else {
	$d = $clan['description'];
	##########
	#  ТЕГИ  #
	##########
	$d = str_replace('<B>','[B]',$d);
	$d = str_replace('</B>','[/B]',$d);
	$d = str_replace('<U>','[U]',$d);
	$d = str_replace('</U>','[/U]',$d);
	$d = str_replace('<I>','[I]',$d);
	$d = str_replace('</I>','[/I]',$d);
	$d = str_replace('<span class=size_1>','[SIZE=1]',$d);
	$d = str_replace('<span class=size_2>','[SIZE=2]',$d);
	$d = str_replace('</span>','[/ENDTAG]',$d);
	$d = str_replace('<div class=LEFT>','[LEFT]',$d);
	$d = str_replace('<div class=RIGHT>','[RIGHT]',$d);
	$d = str_replace('<div class=CENTER>','[CENTER]',$d);
	$d = str_replace('</div>','[/END]',$d);
	/*$tagChar = preg_replace("/(\<a href\=player.php\?id=)([0-9]+)\s(class=profile>)([\S]+)(<\/a>)/","[CHAR=\$2]",$d);
	$d = $tagChar;*/
	$color = preg_replace("/(\<span style=color:#)([\S]+)(>)/","[COLOR=\$2]",$d);
	$d = $color;
	$d = str_replace('<br />','',$d);
	##########
	#  /ТЕГИ #
	##########
}

if (isset($change))
{
	$err = "";
	$s_n = mysql_num_rows(count_query("SELECT name FROM clans WHERE name='".$name."' AND id <> '".$clan['id']."'"));
	if ($s_n > 0) { $err = "<div class='message'>Клан с таким именем уже есть</div>"; }
	$s_t = mysql_num_rows(count_query("SELECT tag FROM clans WHERE tag='".$tag."' AND id <> '".$clan['id']."'"));
	if ($s_t > 0) { $err = "<div class='message'>Клан с таким тегом уже есть</div>"; }
	if ($err == "")
	{
		$desc = str_replace('[B]','<B>',$desc);
		$desc = str_replace('[/B]','</B>',$desc);
		$desc = str_replace('[U]','<U>',$desc);
		$desc = str_replace('[/U]','</U>',$desc);
		$desc = str_replace('[I]','<I>',$desc);
		$desc = str_replace('[/I]','</I>',$desc);
		$desc = str_replace('[SIZE=1]','<span class=size_1>',$desc);
		$desc = str_replace('[/SIZE]','</span>',$desc);
		$desc = str_replace('[SIZE=2]','<span class=size_2>',$desc);
		$desc = str_replace('[/ENDTAG]','</span>',$desc);
		$desc = str_replace('[LEFT]','<div class=LEFT>',$desc);
		$desc = str_replace('[/END]','</div>',$desc);
		$desc = str_replace('[RIGHT]','<div class=RIGHT>',$desc);
		$desc = str_replace('[CENTER]','<div class=CENTER>',$desc);
		/*$charTag = preg_replace("/(\[CHAR=)([0-9]+)(\])/","\$2",$desc);
		$ulink = mysql_fetch_array(count_query("SELECT name FROM `users` WHERE `id_user`='".$charTag."'"),0);
		$desc = preg_replace("/(\[CHAR=)([0-9]+)(\])/","<a href=player.php?id=\$2 class=profile>".$ulink['name']."</a>",$desc);*/
		$desc = preg_replace("/(\[COLOR\=)([\S]+)(\])/","<span style=color:#\$2>",$desc);
		$desc = str_replace('[/COLOR]','</span>',$desc);
		$desc = nl2br($desc);
	
		count_query("UPDATE `clans` SET `name`='".$name."', `tag`='".$tag."', `site`='".$site."', `description`='".$desc."' WHERE id='".$clan['id']."'");
		echo "<script>location.href='?m=tron'</script>";
	}
}

if (isset($t))
{
	switch ($t)
	{
		case 1: 
				if ($row['gold'] >= $_POST['gold']) 
				{ 
					if ($_POST['gold'] > 0) 
					{ 
						count_query("INSERT INTO `klog` (`uid`, `pid`, `name`, `clan_stat`, `gold`, `time`) VALUES ('".$clan['id']."', '".$row['id_user']."', '".$row['name']."', '".$row['clan_stat']."', '".$_POST['gold']."', '".time()."')");
						count_query("UPDATE `clans` SET kgold=kgold+'".$_POST['gold']."' WHERE id='".$row['clan']."'");
						count_query("UPDATE `users` SET gold=gold-'".$_POST['gold']."' WHERE email='".$_SESSION['email']."'");
						echo "<script>location.href='?m=treasury'</script>";
					} 
				}; 
			break;
		case 2: 
				if ($row['krystal'] >= $_POST['krystal'])
				{ 
					if ($_POST['krystal'] > 0) 
					{ 
						count_query("INSERT INTO `klog` (`uid`, `pid`, `name`, `clan_stat`, `krystal`, `time`) VALUES ('".$clan['id']."', '".$row['id_user']."', '".$row['name']."', '".$row['clan_stat']."', '".$_POST['krystal']."', '".time()."')");
						count_query("UPDATE `clans` SET kkrystal=kkrystal+'".$_POST['krystal']."' WHERE id='".$row['clan']."'");
						count_query("UPDATE `users` SET krystal=krystal-'".$_POST['krystal']."' WHERE email='".$_SESSION['email']."'");
						echo "<script>location.href='?m=treasury'</script>";
					} 
				}; 
			break;
		case 3: 
				if ($row['zelen'] >= $_POST['zelen'])
				{ 
					if ($_POST['zelen'] > 0) 
					{ 
						count_query("INSERT INTO `klog` (`uid`, `pid`, `name`, `clan_stat`, `zelen`, `time`) VALUES ('".$clan['id']."', '".$row['id_user']."', '".$row['name']."', '".$row['clan_stat']."', '".$_POST['zelen']."', '".time()."')");
						count_query("UPDATE `clans` SET kzelen=kzelen+'".$_POST['zelen']."' WHERE id='".$row['clan']."'");
						count_query("UPDATE `users` SET zelen=zelen-'".$_POST['zelen']."' WHERE email='".$_SESSION['email']."'");
						echo "<script>location.href='?m=treasury'</script>";
					}
				};
			break;
	}
}

$view = "
<tr>
        <td height=\"750\" width=\"574\" align=\"center\" valign=\"top\" background=\"images/site_01_07.png\" bgcolor=\"#EBDBC1\">
<div class='blockHead'><img src='images/RU/titles/h_clan_zamok.png' alt='Замок' /></div>
			
		<div class='contentBlock' id='contentBlock'><a href='clan.php?' class='back'><img src='images/RU/b_back_p.png' alt='Назад' class='cmd'
								onMouseOver=\"doImage(this,'RU/b_back')\" /></a>	<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'><div class='content'><div class='b2'><img src='images/zamok1_1.jpg' width='504' height='200' /></div></div></div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>	<div class='inputGroup inputSmall inputNoHeight ' >
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1' >
			<div class='content' ><div class='title'>Описание клана:</div><div class='body'>".$clan['description']."</div></div>
		</div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
</div>	</td></tr>
";

$message = "";
################
#  МАСТЕРСКАЯ  #
################
if (isset($_GET['k']))
{
	if ($_GET['k'] == $clan['id'])
	{
		switch ($clan['barrak'])
		{
			case 0: 
				if ($clan['kgold'] >= '3')
				{
					count_query("UPDATE `clans` SET `kgold`=kgold-'3', `barrak`='1', `mem`='3' WHERE id='".$clan['id']."'");
					echo "<script>location.href='?m=training&t=1'</script>";
				}
				else
				{
					$err = '<div class="message">Не хватает денег</div>';
				}
			break;
			case 1: 
				if ($clan['kgold'] >= '296')
				{
					count_query("UPDATE `clans` SET `kgold`=kgold-'296', `barrak`='2', `mem`='6' WHERE id='".$clan['id']."'");
					echo "<script>location.href='?m=training&t=1'</script>";
				}
				else
				{
					$err = '<div class="message">Не хватает денег</div>';
				}
			break;
			case 2: 
				if ($clan['kgold'] >= '4130')
				{
					count_query("UPDATE `clans` SET `kgold`=kgold-'4130', `barrak`='3', `mem`='9' WHERE id='".$clan['id']."'");
					echo "<script>location.href='?m=training&t=1'</script>";
				}
				else
				{
					$err = '<div class="message">Не хватает денег</div>';
				}
			break;
			/*case 3: 
				if ($clan['kgold'] >= '3')
				{
					count_query("UPDATE `clans` SET `kgold`=kgold-'3', `barrak`='1', `mem`='3' WHERE id='".$clan['id']."'");
					echo "<script>location.href='?m=training&t=1'</script>";
				}
				else
				{
					$err = '<div class="message">Не хватает денег</div>';
				}
			break;
			case 4: 
				if ($clan['kgold'] >= '3')
				{
					count_query("UPDATE `clans` SET `kgold`=kgold-'3', `barrak`='1', `mem`='3' WHERE id='".$clan['id']."'");
					echo "<script>location.href='?m=training&t=1'</script>";
				}
				else
				{
					$err = '<div class="message">Не хватает денег</div>';
				}
			break;*/
		}
	}
}
switch ($clan['barrak'])
{
	case 0: $buy_barrak = '3'; $warrior = '3'; break;
	case 1: $buy_barrak = '296'; $warrior = '6'; break; break;
	case 2: $buy_barrak = '4130'; $warrior = '9'; break; break;
}
if ($m == "training")
{
	if ($_GET['t'] == 1 AND $clan['barrak'] > 1)
	{
		echo "
			<tr>
        <td height='750' width='574' align='center' valign='top' background='images/site_01_07.png' bgcolor='#EBDBC1'>
<div class='blockHead'><img src='images/RU/titles/h_master.png' alt='Мастерская' /></div>
			
		<div class='contentBlock' id='contentBlock'><a href='clan_mod.php?m=training' ><img src='images/RU/b_back_p.png' alt='Назад' class='cmd'
								onMouseOver=\"doImage(this,'RU/b_back','skip')\" /></a><br /><br />	<div class='inputGroup inputSmall inputNoHeight ' >
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1' >
			<div class='content' ><div class='title'>Казарма</div><div class='body'>
			На данный момент больше развивать казармы нельзя
		</div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
</div>	</td></tr>
				";
	}
	
	if (isset($_GET['t']))
	{
		switch($_GET['t'])
		{
			case 1: 
					echo "
				<tr>
        <td height='750' width='574' align='center' valign='top' background='images/site_01_07.png' bgcolor='#EBDBC1'>
<div class='blockHead'><img src='images/RU/titles/h_master.png' alt='Мастерская' /></div>
			
		<div class='contentBlock' id='contentBlock'><a href='clan_mod.php?m=training' ><img src='images/RU/b_back_p.png' alt='Назад' class='cmd'
								onMouseOver=\"doImage(this,'RU/b_back','skip')\" /></a><br /><br />	<div class='inputGroup inputSmall inputNoHeight ' >
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1' >
			<div class='content' ><div class='title'>Казарма</div><div class='body'><table>
					<tr><td class='center' valign=top><img src='images/buildings/level_1.jpg' alt='Казарма' width=180 height=180>
						<td valign='top' style='height:220px'><img src='images/RU/buttons/but_shop_a.png' alt='Характеристики и требования' onclick='doShopInfo(1)' id='image_1'><br><div class='shown item_info' id='item_1'>
							<table class='default default_height' style='width:305px'>
								
								<tr>
									<th class='left'><b>Текущий уровень: ".$clan['barrak']."</b>
								<tr>
									<td>Вместимость казарм: ".$clan['mem']." воинов<br />Количество рангов: ".$clan['barrak']."<tr><th class='left'><b>Следующий уровень: ".($clan['barrak']+1)."</b>
								<tr>
									<td >Вместимость казарм: ".$warrior." воинов<br />Количество рангов: ".($clan['barrak']+1)."
								<tr>
									<th class='left'>Цена покупки: ".$buy_barrak." <img src='/images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'>
								<tr>
									<td class='center'><a href='clan_mod.php?m=training&amp;t=1&amp;k=".$clan['id']."' ><img src='images/RU/buttons/b_upgrade_p.png' alt='Улучшить' class='cmd' onMouseOver=\"doImage(this,'RU/buttons/b_upgrade')\" /></a>
							
							</table></div><div class='hidden item_desc text_main_4' id='desc_1'><table style='width:100%'>Прежде, чем принять в клан новых воинов, надо обеспечить их помещением для сна и тренировок.</table></div></table></div></div>
		</div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
</div>	</td></tr>
				";
				break;
			case 2:
					echo "<tr>
        <td height='750' width='574' align='center' valign='top' background='images/site_01_07.png' bgcolor='#EBDBC1'>
<div class='blockHead'><img src='images/RU/titles/h_master.png' alt='Мастерская' /></div>
			
		<div class='contentBlock' id='contentBlock'><a href='clan_mod.php?m=training' ><img src='images/RU/b_back_p.png' alt='Назад' class='cmd'
								onMouseOver=\"doImage(this,'RU/b_back','skip')\" /></a><br /><br />	<div class='inputGroup inputSmall inputNoHeight ' >
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1' >
			<div class='content' ><div class='title'>Башни</div><div class='body'><table>
					<tr><td class='center' valign=top><img src='images/buildings/tower_1.jpg' alt='Башни' width=180 height=180>
						<td valign='top' style='height:220px'><img src='images/RU/buttons/but_shop_a.png' alt='Характеристики и требования' onclick='doShopInfo(1)' id='image_1'><br><div class='shown item_info' id='item_1'><table class='default default_height' style='width:305px'><tr><th class='left'><b>Текущий уровень: 0</b><tr><td>Урон 1% от общего здоровья нападающего. Вероятность попадания 10%.<tr><th class='left'><b>Следующий уровень: 1</b><tr><td >Урон 1%-2% от общего здоровья нападающего. Вероятность попадания 15%.<tr><th class='left'>Цена покупки: 5000 <img src='/images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'><tr><td class='center'><a href='clan_mod.php?m=training&amp;t=2&amp;k=11244' ><img src='images/RU/buttons/b_upgrade_p.png' alt='Улучшить' class='cmd'
								onMouseOver=\"doImage(this,'RU/buttons/b_upgrade')\" /></a></table></div><div class='hidden item_desc text_main_4' id='desc_1'><table style='width:100%'>Лучники тем чаще ведут стрельбу, чем безопаснее при этой стрельбе они себя ощущают. Улучшая башни, вы заботитесь не только о своих воинах, но и о повышении своей безопасности.</table></div></table></div></div>
		</div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
</div>	</td></tr>";
				break;
		}
	}
}
$training = "
<tr>
        <td height=\"750\" width=\"574\" align=\"center\" valign=\"top\" background=\"images/site_01_07.png\" bgcolor=\"#EBDBC1\">
<div class='blockHead'><img src='images/RU/titles/h_master.png' alt='Мастерская' /></div>
			
		<div class='contentBlock' id='contentBlock'><a href='clan.php' ><img src='images/RU/b_back_p.png' alt='Назад' class='cmd'
								onMouseOver=\"doImage(this,'RU/b_back','skip')\" /></a><br /><br />	<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'><div class='content'><div class='b2'><img src='images/zamok1_1.jpg' alt='' height='200'></div></div></div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div><br />	<div class='inputGroup'>
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1'><div class='content'><div class='b2'><table class='clan_upgrades'><tr><td>
		<a href='clan_mod.php?m=training&t=1'><img src='images/RU/../kw_ico_1p.jpg' alt='Казарма' id='h_1'
			onMouseOver=\"setImage('h_1','images/RU/../kw_ico_1a.jpg');\" onMouseOut=\"setImage('h_1','images/RU/../kw_ico_1p.jpg')\"/></a>
		<td class='link'><a href='clan_mod.php?m=training&t=1'
			onMouseOver=\"setImage('h_1','images/RU/../kw_ico_1a.jpg');\" onMouseOut=\"setImage('h_1','images/RU/../kw_ico_1p.jpg')\"/>Казарма
			</a><br /><br /><span class='info'>уровень<br />".$clan['barrak']."/16</span>
				<td class='info'>Прежде, чем принять в клан новых воинов, надо обеспечить их помещением для сна и тренировок.<tr><td>
		<a href='clan_mod.php?m=training&t=2'><img src='images/RU/../kw_ico_2p.jpg' alt='Башни' id='h_2'
			onMouseOver=\"setImage('h_2','images/RU/../kw_ico_2a.jpg');\" onMouseOut=\"setImage('h_2','images/RU/../kw_ico_2p.jpg')\"/></a>
		<td class='link'><a href='clan_mod.php?m=training&t=2'
			onMouseOver=\"setImage('h_2','images/RU/../kw_ico_2a.jpg');\" onMouseOut=\"setImage('h_2','images/RU/../kw_ico_2p.jpg')\"/>Башни
			</a><br /><br /><span class='info'>уровень<br />0/16</span>
				<td class='info'>Лучники тем чаще ведут стрельбу, чем безопаснее при этой стрельбе они себя ощущают. Улучшая башни, вы заботитесь не только о своих воинах, но и о повышении своей безопасности.<tr><td>
		<a href='clan_mod.php?m=training&t=3'><img src='images/RU/../kw_ico_3p.jpg' alt='Смоляные котлы' id='h_3'
			onMouseOver=\"setImage('h_3','images/RU/../kw_ico_3a.jpg');\" onMouseOut=\"setImage('h_3','images/RU/../kw_ico_3p.jpg')\"/></a>
		<td class='link'><a href='clan_mod.php?m=training&t=3'
			onMouseOver=\"setImage('h_3','images/RU/../kw_ico_3a.jpg');\" onMouseOut=\"setImage('h_3','images/RU/../kw_ico_3p.jpg')\"/>Смоляные котлы
			</a><br /><br /><span class='info'>уровень<br />0/8</span>
				<td class='info'>Чем лучше смоляные котлы, тем дольше в осаде держится эффект от рва. Для того, чтобы уменьшить действие смоляных котлов, штурмующим необходимо покупать пушку.<tr><td>
		<a href='clan_mod.php?m=training&t=4'><img src='images/RU/../kw_ico_4p.jpg' alt='Арсенал' id='h_4'
			onMouseOver=\"setImage('h_4','images/RU/../kw_ico_4a.jpg');\" onMouseOut=\"setImage('h_4','images/RU/../kw_ico_4p.jpg')\"/></a>
		<td class='link'><a href='clan_mod.php?m=training&t=4'
			onMouseOver=\"setImage('h_4','images/RU/../kw_ico_4a.jpg');\" onMouseOut=\"setImage('h_4','images/RU/../kw_ico_4p.jpg')\"/>Арсенал
			</a><br /><br /><span class='info'>уровень<br />0/8</span>
				<td class='info'>Чем крепче здание арсенала, тем дольше в осаде держится эффект от лучников. Для того, чтобы уменьшить действие башен, штурмующим необходимо покупать катапульту.<tr><td>
		<a href='clan_mod.php?m=training&t=5'><img src='images/RU/../kw_ico_5p.jpg' alt='Ров' id='h_5'
			onMouseOver=\"setImage('h_5','images/RU/../kw_ico_5a.jpg');\" onMouseOut=\"setImage('h_5','images/RU/../kw_ico_5p.jpg')\"/></a>
		<td class='link'><a href='clan_mod.php?m=training&t=5'
			onMouseOver=\"setImage('h_5','images/RU/../kw_ico_5a.jpg');\" onMouseOut=\"setImage('h_5','images/RU/../kw_ico_5p.jpg')\"/>Ров
			</a><br /><br /><span class='info'>уровень<br />0/10</span>
				<td class='info'>Безопасность замка тем выше, чем труднее его штурмовать. С каждым строительством дополнительных препятствий врагу будет труднее атаковать ваш замок.<tr><td>
		<a href='clan_mod.php?m=training&t=6'><img src='images/RU/../kw_ico_6p.jpg' alt='Стены' id='h_6'
			onMouseOver=\"setImage('h_6','images/RU/../kw_ico_6a.jpg');\" onMouseOut=\"setImage('h_6','images/RU/../kw_ico_6p.jpg')\"/></a>
		<td class='link'><a href='clan_mod.php?m=training&t=6'
			onMouseOver=\"setImage('h_6','images/RU/../kw_ico_6a.jpg');\" onMouseOut=\"setImage('h_6','images/RU/../kw_ico_6p.jpg')\"/>Стены
			</a><br /><br /><span class='info'>уровень<br />0/10</span>
				<td class='info'>Улучшая защиту замка в виде стен, вы обеспечиваете большую защиту воинам при нападении на них армии врага. При этом вы также повышаете защиту против диверсантов.<tr><td>
		<a href='clan_mod.php?m=training&t=8'><img src='images/RU/../kw_ico_8p.jpg' alt='Посольство' id='h_7'
			onMouseOver=\"setImage('h_7','images/RU/../kw_ico_8a.jpg');\" onMouseOut=\"setImage('h_7','images/RU/../kw_ico_8p.jpg')\"/></a>
		<td class='link'><a href='clan_mod.php?m=training&t=8'
			onMouseOver=\"setImage('h_7','images/RU/../kw_ico_8a.jpg');\" onMouseOut=\"setImage('h_7','images/RU/../kw_ico_8p.jpg')\"/>Посольство
			</a><br /><br /><span class='info'>уровень<br />0/8</span>
				<td class='info'>Посольство обеспечивает клан баллами дипломатии. Для того, чтобы заключить союз, объявить войну или совершить любое другое дипломатическое действие – необходимо потратить 1 балл дипломатии.<tr><td>
		<a href='clan_mod.php?m=training&t=9'><img src='images/RU/../kw_ico_9p.jpg' alt='Ворота' id='h_8'
			onMouseOver=\"setImage('h_8','images/RU/../kw_ico_9a.jpg');\" onMouseOut=\"setImage('h_8','images/RU/../kw_ico_9p.jpg')\"/></a>
		<td class='link'><a href='clan_mod.php?m=training&t=9'
			onMouseOver=\"setImage('h_8','images/RU/../kw_ico_9a.jpg');\" onMouseOut=\"setImage('h_8','images/RU/../kw_ico_9p.jpg')\"/>Ворота
			</a><br /><br /><span class='info'>уровень<br />0/8</span>
				<td class='info'>Чем крепче ворота, тем дольше в осаде держится эффект от стен замка. Для того, чтобы уменьшить действие ворот, штурмующим необходимо покупать таран.<tr><td>
		<a href='clan_mod.php?m=training&t=10'><img src='images/RU/../kw_ico_10p.jpg' alt='Сторожка' id='h_9'
			onMouseOver=\"setImage('h_9','images/RU/../kw_ico_10a.jpg');\" onMouseOut=\"setImage('h_9','images/RU/../kw_ico_10p.jpg')\"/></a>
		<td class='link'><a href='clan_mod.php?m=training&t=10'
			onMouseOver=\"setImage('h_9','images/RU/../kw_ico_10a.jpg');\" onMouseOut=\"setImage('h_9','images/RU/../kw_ico_10p.jpg')\"/>Сторожка
			</a><br /><br /><span class='info'>уровень<br />0/15</span>
				<td class='info'>Враг никогда не застанет замок врасплох, пока доблестные клановые воины несут стражу. Если ваш клан в состоянии войны, несение караульной службы просто необходимо для выживания.</table> </div></div></div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div></div>	</td></tr>
";
#################
#     КАЗНА     #
#################
$treasury = "
<tr>
        <td height=\"750\" width=\"574\" align=\"center\" valign=\"top\" background=\"images/site_01_07.png\" bgcolor=\"#EBDBC1\">
<div class='blockHead'><img src='images/RU/titles/h_kazna.png' alt='Казначейство' /></div>
			
		<div class='contentBlock' id='contentBlock'><a href='clan.php' ><img src='images/RU/b_back_p.png' alt='Назад' class='cmd'
								onMouseOver=\"doImage(this,'RU/b_back','skip')\" /></a><br /><br />	<div class='inputGroup inputSmall  ' >
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1' style='height:180px !important'>
			<div class='content' ><div class='title'>Вклад в казну</div><div class='body'><table style='width:100%'><tr><td><table class='treasury center'>
						<tr class='row_4'><td>В казне:
						<tr class='row_1'><td><b>".$clan['kgold']." <img src='/images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'></b>
						<tr class='row_4'><td>Сколько внести:
						<tr class='row_1'><td>
					<form method='POST' action='clan_mod.php?m=treasury'>
					<input type='hidden' name='type' value='1'>
					<input type='text' name='gold' value='0' style='margin-bottom:5px'><br />
					<input type='image' name='do_give_money' class='image cmd' src='images/RU/b_donate2_p.png' alt='Внести'
					onMouseOver=\"doImage(this,'RU/b_donate2')\"/ >
					</form>
					</table>
				<td><table class='treasury center'>
						<tr class='row_4'><td>В казне:
						<tr class='row_1'><td><b>".$clan['kkrystal']." <img src='/images/ico_krist1.png' alt='Кристалл' align='absmiddle' class='png'></b>
						<tr class='row_4'><td>Сколько внести:
						<tr class='row_1'><td>
					<form method='POST' action='clan_mod.php?m=treasury'>
					<input type='hidden' name='type' value='2'>
					<input type='text' name='krystal' value='0' style='margin-bottom:5px'><br />
					<input type='image' name='do_give_money' class='image cmd' src='images/RU/b_donate2_p.png' alt='Внести'
					onMouseOver=\"doImage(this,'RU/b_donate2')\"/ >
					</form>
					</table>
				<td><table class='treasury center'>
						<tr class='row_4'><td>В казне:
						<tr class='row_1'><td><b>".$clan['kzelen']." <img src='/images/ico_green1.png' alt='Зелень' align='absmiddle' class='png'></b>
						<tr class='row_4'><td>Сколько внести:
						<tr class='row_1'><td>
					<form method='POST' action='clan_mod.php?m=treasury'>
					<input type='hidden' name='type' value='3'>
					<input type='text' name='zelen' value='0' style='margin-bottom:5px'><br />
					<input type='image' name='do_give_money' class='image cmd' src='images/RU/b_donate2_p.png' alt='Внести'
					onMouseOver=\"doImage(this,'RU/b_donate2')\"/ >
					</form>
					</table>
				</table></div></div>
		</div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
<br />	<div class='inputGroup inputSmall inputNoHeight ' >
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1' >
			<div class='content' ><div class='title'>Пожертвования клану</div><div class='body'><div id='order_1'><table class='default treasury_now'>
						<tr class='row_4'>
							<th rowspan=2 id ='t1'  >Имя
							<th colspan=3 id ='t2' class='nopad'>Вклад в казну
							<th colspan=2 id ='t3' class='nopad'>Долг
							<th width='70' rowspan=2 id='t4' >Статус

						<tr class='nopad center'>
							<th width=80><img src='/images/ico_gold1.png' alt='Золото' align='absmiddle'>
							<th width=40><img src='/images/ico_krist1.png' alt='Кристаллы' align='absmiddle'>
							<th width=40><img src='/images/ico_green1.png' alt='Зелень' align='absmiddle'>

							<th width=60><img src='/images/ico_gold1.png' alt='Золото' align='absmiddle'>
							<th width=50><img src='/images/ico_krist1.png' alt='Кристаллы' align='absmiddle'>
							";
							$ind2 = 0;
								while ($memb = mysql_fetch_array($zap_memb)) 
								{
									$zap1 = mysql_result(mysql_query("SELECT SUM(gold) FROM klog WHERE name = '".$memb['name']."'"), 0);
									$zap2 = mysql_result(mysql_query("SELECT SUM(krystal) FROM klog WHERE name = '".$memb['name']."'"), 0);
									$zap3 = mysql_result(mysql_query("SELECT SUM(zelen) FROM klog WHERE name = '".$memb['name']."'"), 0);
									if ($zap1 == 0) { $zap1 = "-"; } else { $zap1 = $zap1; }
									if ($zap2 == 0) { $zap2 = "-"; } else { $zap2 = $zap2; }
									if ($zap3 == 0) { $zap3 = "-"; } else { $zap3 = $zap3; }
									$zap_online = mysql_num_rows(count_query("SELECT * FROM online WHERE id_session='".$memb['id_user']."'"));
									if ($zap_online > 0) { $img_on = "<img src='images/ico_online.png' alt='онлайн' class='png' ></td>"; }
									else { $img_on = "<img src='images/ico_offline.png' alt='оффлайн' class='png' ></td>"; }
									$treasury .= "<tr class='center row_1'><td><a href='/player.php?id=".$memb['id_user']."' class='profile ' >".$memb['name']."</a>	<td>".$zap1."<td>".$zap2."	<td>".$zap3."<td><b><span class='green'>?</span></b>	<td><b><span class='num_zero'>?</span></b><td>".$img_on;
								
								$ind2++;
								}
								if ($ind2 == 0)
								{
									$treasury .= "<tr class='center row_1'><td><td><td><td><td><td><td>";
								}
$treasury .= "</table></div><br /><a href='clan_mod.php?m=treasury' ><img src='images/RU/b_obn_p.png' alt='Обновить' class='cmd'
								onMouseOver=\"doImage(this,'RU/b_obn','skip')\" /></a><br /><a href='clan_mod.php?m=taxes'>Посмотреть налоговую ставку</a></div></div>
		</div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
<br />	<div class='inputGroup inputSmall inputNoHeight ' >
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1' >
			<div class='content' ><div class='title'>Подробности</div><div class='body'><div id='order_2'>
						<table class='default treasury_history'><tr>
								<th  width=150>Имя
								<th  width='100'>Ранг
								<th >Вклад
								<th  width=120>Дата
								"; 
								$ind = 0;
								while ($klog = mysql_fetch_array($zap_klog)) 
								{
									if ($klog['gold'] > 0) { $money = $klog['gold']." <img src='/images/ico_gold1.png' alt='Золото' align='absmiddle' class='png'>"; }
									if ($klog['krystal'] > 0) { $money = $klog['krystal']." <img src='/images/ico_krist1.png' alt='Кристалы' align='absmiddle' class='png'>"; }
									if ($klog['zelen'] > 0) { $money = $klog['zelen']." <img src='/images/ico_green1.png' alt='Зелень' align='absmiddle' class='png'>"; }
									$treasury .= "<tr class='center row_1'><td><a href='/player.php?id=".$klog['pid']."' class='profile ' >".$klog['name']."</a>	<td>".$klog['clan_stat']."	<td class='money'>".$money."	<td>".date('j.n.Y H:i', $klog['time']);
								$ind++;
								}
								if ($ind == 0)
								{
									$treasury .= "<tr class='center row_1'><td>	<td>	<td class='money'> 	<td>";
								}
$treasury .= "</table><br /><br /></div><a href='clan_mod.php?m=treasury' ><img src='images/RU/b_obn_p.png' alt='Обновить' class='cmd'
								onMouseOver=\"doImage(this,'RU/b_obn','skip')\" /></a></div></div>
		</div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
<br /></div>	</td></tr>
";

###############
# ТРОННЫЙ ЗАЛ #
###############
if (isset($_POST['do_cmd']))
{
	if ($_POST['do_cmd'] == 'delete')
	{
		$err = '<div class="message">В разработке</div>';
	}
}
$tron = "
<tr>
        <td height='750' width='574' align='center' valign='top' background='images/site_01_07.png' bgcolor='#EBDBC1'>
<div class='blockHead'><img src='images/RU/titles/h_tron.png' alt='Тронный зал' /></div>
			
		<div class='contentBlock' id='contentBlock'><a href='clan.php?' class='back'><img src='images/RU/b_back_p.png' alt='Назад' class='cmd'
								onMouseOver=\"doImage(this,'RU/b_back')\" /></a><table><tr><td width='50%'><a href='clan_flag.php' ><img src='images/RU/buttons/b_gerb_p.png' alt='изменить герб клана' class='cmd'
								onMouseOver=\"doImage(this,'RU/buttons/b_gerb')\" /></a><td><a href='clan_mod.php?m=taxes' ><img src='images/RU/buttons/b_taxa_p.png' alt='Налоговая ставка' class='cmd'
								onMouseOver=\"doImage(this,'RU/buttons/b_taxa')\" /></a><tr><td><a href='clan_mod.php?m=rangs' ><img src='images/RU/buttons/b_chstats_p.png' alt='Управление статусами' class='cmd'
								onMouseOver=\"doImage(this,'RU/buttons/b_chstats')\" /></a><td><a href='clan_mod.php?m=academy' ><img src='images/RU/buttons/b_acad_p.png' alt='Управление академиями' class='cmd'
								onMouseOver=\"doImage(this,'RU/buttons/b_acad')\" /></a></table> ".$err."	<div class='inputGroup inputSmall inputNoHeight ' >
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1' >
			<div class='content' ><div class='title'>Редактировать клан</div><div class='body'><form method='POST' class='center'>
<table width='400px' align='center'>
<tr><td style='width:50%'>Имя клана:			<td><input type='text' name='name' value='".$clan['name']."' class='s' />
<tr><td>Тег клана:				<td><input type='text' name='tag' value='".$clan['tag']."'  class='s' />
<tr><td>Сайт клана:				<td><input type='text' name='site' value='".$clan['site']."'  class='s' />
<tr><td colspan='2'><br /><div class='tags'>
			<span style='float:left'>
				<img src='images/tags/b.gif' onclick=\"AddTag('B','description')\">
				<img src='images/tags/u.gif' onclick=\"AddTag('U','description')\">
				<img src='images/tags/i.gif' onclick=\"AddTag('I','description')\">
				<img src='images/tags/small.gif' onclick=\"AddTag('SIZE=1','description','SIZE')\">
				<img src='images/tags/large.gif' onclick=\"AddTag('SIZE=2','description','SIZE')\">
				<img src='images/tags/color.gif' onclick=\"ShowColor(1,'description')\">
			</span>
		<span style='float:right'>
			<img src='images/tags/left.gif' onclick=\"AddTag('LEFT','description','END')\">
			<img src='images/tags/center.gif' onclick=\"AddTag('CENTER','description','END')\">
			<img src='images/tags/right.gif' onclick=\"AddTag('RIGHT','description','END')\">

		 </span>
			<!--<img src='images/tags/char.gif' onclick=\"addCharacter('description')\">
			<img src='images/tags/clan.gif' onclick=\"addClan('description')\">-->
		</div>
		<div id='colors_1' class='tags_colors'><table><tr><td style='background:#4d1f11' onclick=\"AddColor('4d1f11','description',1)\"> &nbsp;<td style='background:#cc3300' onclick=\"AddColor('cc3300','description',1)\"> &nbsp;<td style='background:#ff9933' onclick=\"AddColor('ff9933','description',1)\"> &nbsp;<td style='background:#ffff00' onclick=\"AddColor('ffff00','description',1)\"> &nbsp;<tr><td style='background:#000066' onclick=\"AddColor('000066','description',1)\"> &nbsp;<td style='background:#0000ff' onclick=\"AddColor('0000ff','description',1)\"> &nbsp;<td style='background:#6633cc' onclick=\"AddColor('6633cc','description',1)\"> &nbsp;<td style='background:#9966ff' onclick=\"AddColor('9966ff','description',1)\"> &nbsp;<tr><td style='background:#003300' onclick=\"AddColor('003300','description',1)\"> &nbsp;<td style='background:#2c8f11' onclick=\"AddColor('2c8f11','description',1)\"> &nbsp;<td style='background:#ffffff' onclick=\"AddColor('ffffff','description',1)\"> &nbsp;<td style='background:#000000' onclick=\"AddColor('000000','description',1)\"> &nbsp;</table></div>
		<div class='clear'></div><br />
<textarea name='description' style='width:100%' rows='12' id='description' >".$d."</textarea></td>
<tr><td colspan='2' class='center'><br /><br />
<input type='hidden' name='change'>
<input type='image' name='do' class='image cmd' src='images/RU/buttons/b_academy_update_p.png' alt='Сохранить изменения'
					onMouseOver=\"doImage(this,'RU/buttons/b_academy_update',null)\"/ >
</table>
</form>
<style>
INPUT.s,SELECT{width:200px}

</style><br /></div></div>
		</div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
<br />	<div class='inputGroup inputSmall inputNoHeight ' >
		<div class='top'><div class='top1'><div class='top2'></div></div></div>

		<div class='c1' >
			<div class='content' ><div class='title'>Удалить клан</div><div class='body'>Важно понимать, что удаление замка – это решение ответственное, и принимать его лучше всего на голову трезвую!<br /><br />
Разрушив замок, вы уничтожите все те труды, малые ли, большие, что успели вложить в его возведение.<br />
Поэтому на то, чтобы передумать, у тебя есть 24 часа. <br /> <br /><br /><form method='post' class='inline' action=''><input type='hidden' name='do_cmd' value='delete' /><input type='hidden' name='k' value='11244' /><input type='image' name='docmd' class='image cmd' src='images/RU/buttons/b_clan_delete_p.png' alt='Удалить клан'
					onMouseOver=\"doImage(this,'RU/buttons/b_clan_delete',null)\"/ ></form></div></div>
		</div>
		<div class='down'><div class='down1'><div class='down2'></div></div></div>
	</div>
<br /></div>	</td></tr>
";
if ($_GET['t'] == null)
{
	switch ($m)
	{
		case "view": echo $view; break;
		case "message": echo $message; break;
		case "training": echo $training; break;
		case "treasury": echo $treasury; break;
		case "tron": echo $tron; break;
	}
}
include ("footer_tpl.php");
?>