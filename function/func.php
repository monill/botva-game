<?php
function loca($link)
{
	echo "<script>location.href='".$link."';</script>";
}
function lvl ($exp) //������ ������ �� ����� - exp(����� �����)
{
	$c=$exp+20;
	$a=5;
	$b=5;
	$d =$b*$b+4*$a*$c;
	if($d>0) {    $lvl[0]=((-$b+sqrt($d))/(2*$a)); $lvl[1]=((-$b-+sqrt($d))/(2*$a));}
	if($d==0) {$lvl[0]=-$b/(2*$a);}
	if ($lvl[0]>=0){return floor($lvl[0]);}else{return floor($lvl[1]);}
}

function lvl_to_exp ($lvl) //������ ����� �� ������
{
	$y = $lvl*10+5;
	$x = (pow($y,2) - 425) / 20;
	return $x;
}

function n_lvl_exp ($exp) //������ ����� ��� ���������� ������ - exp(����� �����)
{
	$lvl_now=lvl($exp)+1;
	$exp=5*($lvl_now*$lvl_now)+5*$lvl_now-20;
	return $exp;
}

function who_online() //��� ������
{
	$query = "SELECT * FROM `online` WHERE `id_session` = '".$_SESSION['id']."'";
	$ses = count_query($query) or die("Invalid query: " . mysql_error());
	if(!$ses) exit("<p>������ � ������� � ������� ������</p>");
	// ���� ������ � ����� ������� ��� ����������,
	// ������ ������������ online - ��������� ����� ���
	// ���������� ���������
	if(mysql_num_rows($ses)>0){
		$query = "UPDATE `online` SET `putdate` = '".time()."', `current_page` = '".$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']."' WHERE `id_session` = '".$_SESSION['id']."'";
		count_query($query) or die("Invalid query: " . mysql_error());
	}
	// �����, ���� ������ ������ ��� - ���������� ������ ���
	// ����� - �������� � ������� ������ ����������
	else {
		echo "<script>location.href='logout.php';</script>";
		exit;
	}
	// ����� �������, ��� ������������, ������� �������������
	// � ������� 20 ����� - �������� ������ - ������� ��
	// id_session �� ���� ������
	$query = "DELETE FROM `online` WHERE putdate < '".(time()-60*20)."'";
	count_query($query) or die("Invalid query: " . mysql_error());
}

function training_cost ($stat, $type) //������ ��������� ���������� - stat(������� ������ � �����) type(��� ����)
{
	$res = mysql_fetch_array(count_query("SELECT * FROM `users` WHERE `id_user` = '".$_SESSION['id']."'")) or die("Invalid query: " . mysql_error());//��������� ������

	switch ($type)	{
		case 'pow': $cost=floor(lvl($res['exp'])*$stat*$stat*1.7); return $cost; break;
		case 'def': $cost=floor(lvl($res['exp'])*$stat*$stat*1.3); return $cost; break;
		case 'skill': $cost=floor(lvl($res['exp'])*$stat*$stat*1.6); return $cost; break;
		case 'abi': $cost=floor(lvl($res['exp'])*$stat*$stat*1.8); return $cost; break;
		case 'mass': $cost=floor(lvl($res['exp'])*$stat*$stat*1.4); return $cost; break;
	}
}

function pl_cost ($stat, $type)//������ ��������� �������� � ������� - stat(������� ������ � �����) type(��� ����)
{
	if ($type=='house')	{
		$stat++;
		$stat=ceil(pow(5, $stat));
		return $stat;
	}
	if ($type=='cage')	{
		switch ($stat) {
			case 0: $stat = 1845; break;
			case 1: $stat = 8303; break;
			case 2: $stat = 18683; break;
			case 3: $stat = 37366; break;
			case 4: $stat = 74732; break;
			case 5: $stat = 112098; break;
			case 6: $stat = 149464; break;
			case 7: $stat = 298928; break;
		}
		return $stat;
	}
	if ($type=='fence')	{
		switch ($stat) {
			case 0: $stat = 4; break;
			case 1: $stat = 23; break;
			case 2: $stat = 110; break;
			case 3: $stat = 530; break;
			case 4: $stat = 2548; break;
			case 5: $stat = 12230; break;
			case 6: $stat = 58706; break;
			case 7: $stat = 281792; break;
			case 8: $stat = 1352605; break;
			case 9: $stat = 6492506; break;
		}
		return $stat;
	}
	if ($type=='road') {
		$stat++;
		$stat=ceil(pow(4, $stat));
		return $stat;
	}
	if ($type=='out') {
		$stat++;
		$stat=ceil(pow(4, $stat));
		return $stat;
	}
}

function farm ($speed) //������ �� �����
{
	$res = mysql_fetch_array(count_query("SELECT * FROM `users` WHERE `email` = '".$_SESSION['email']."'")) or die("Invalid query: " . mysql_error());//��������� ������

	if (lvl($res['exp']) <= 2) {
		$gold=40*$speed;// ������ ��������� �����
	} else if (lvl($res['exp']) > 2 AND lvl($res['exp']) <= 6) {
		$gold=80*$speed;// ������ ��������� �����
	} else if (lvl($res['exp']) > 3 AND lvl($res['exp']) <= 14) {
		$gold=160*$speed;// ������ ��������� �����
	} else if (lvl($res['exp']) > 14 AND lvl($res['exp']) <= 30) {
		$gold=320*$speed;// ������ ��������� �����
	}
	$exp=ceil($gold/rand(10,20));// ������ ��������� �����

	$day = date("j");
	$m = date("n");
	$y = date("y");
	$h = date("H");
	$min= date("i");
	$time = $day.".".$m.".".$y." ".$h.":".$min;

	count_query("UPDATE `users` SET  `gold`=gold+'".$gold."', `exp`=exp+'".$exp."' WHERE `id_user` = '".$res['id_user']."'") or die("Invalid query: " . mysql_error());
	count_query("INSERT INTO `message` (`time`, `to`, `text`, `metka`) VALUES ('".$time."', '".$res['name']."', '����� ������ � ��������� �������� ������ �� �������� ".$gold." <img src=images/ico_gold1.png alt=������ align=absmiddle class=png> � ".$exp." <img src=images/ico_21.png alt=���� align=absmiddle/>', '5')") or die("Invalid query: " . mysql_error());
	count_query ("UPDATE users SET read_msg='0' WHERE id_user='".$res['id_user']."'");
}

function dozor ($speed) //�����
{
	$res = mysql_fetch_array(count_query("SELECT * FROM `users` WHERE `id_user` = '".$_SESSION['id']."'")) or die("Invalid query: " . mysql_error());

	$gold = round(rand(lvl($res['exp'])*3,lvl($res['exp'])*10)*$speed);
	$expa = round(rand(1,4));

	$day = date("j");
	$m = date("n");
	$y = date("y");
	$h = date("H");
	$min= date("i");
	$time = $day.".".$m.".".$y." ".$h.":".$min;

	$arr_win = array(
	"������ �� ������ �� ������ ��� ��� ������ ������������ ���� ������! �� ��������� �������� �� ���� � �������, �� ��� ��� ��������� ".$gold." <img src=images/ico_gold1.png alt=������ align=absmiddle class=png>",
	"�� ������� �������� ���� ��������, ������� ������ ������ �� �����. ������� ��� ��������� �������, �� ������ ������������.",
	"- ����� ����! - ������� ��� �������� � �� ����������� � ����� �������� ������� ��������������. ������� � ��� ����� � ��������� ���� �����, �� ��� ���� ������ ��������, �� ��� ��� ��������� ".$gold." <img src=images/ico_gold1.png alt=������ align=absmiddle class=png> � ".$expa." <img src=images/ico_21.png alt=���� align=absmiddle/>",
	"������ �� ����, �� ������ ��� � ��� ������������ ��������. �� �������� �������, �� �� ��� �� ������������ ��������� ���������� ".$expa." <img src=images/ico_21.png alt=���� align=absmiddle/>",
	"�������� ������ �������, �� �� ����� ������ ��������, ������ ������ � �������������.",
	"�� �������� ���� ���� ��� ��������� ".$gold." <img src=images/ico_gold1.png alt=������ align=absmiddle class=png> ����� �� ������ �������� ���������, ��� ��� ������� � ����� ������ ������ ���� ���������� � ������ �� ������.",
	"������� �� ����� �� ��������� ��� � ������ ����� � �����, �� ��� ��������� ".$expa." <img src=images/ico_21.png alt=���� align=absmiddle/>");

	$arr_win_rand = rand(0,sizeof($arr_win));
	switch ($arr_win_rand) {
		case 0: $g = $gold; break;
		case 1:$g = 0; $e = 0; break;
		case 2: $g = $gold; $e = $expa; break;
		case 3: $e = $expa; break;
		case 4: $g = 0; $e = 0; break;
		case 5: $g = $gold; break;
		case 6: $e = $expa; break;
	}

	count_query("UPDATE `users` SET  `gold`=gold+'".$g."', `exp`=exp+'".$e."' WHERE `id_user` = '".$res['id_user']."'") or die("Invalid query: " . mysql_error());
	count_query("INSERT INTO `message` (`time`, `to`, `text`, `metka`) VALUES ('".$time."', '".$res['name']."', '".$arr_win[$arr_win_rand]."', '5')") or die("Invalid query: " . mysql_error());
	count_query ("UPDATE users SET read_msg='0' WHERE id_user='".$res['id_user']."'");
}

function mine ($speed)
{
	$res = mysql_fetch_array(count_query("SELECT * FROM `users` WHERE `id_user` = '".$_SESSION['id']."'"));

	$kr = mt_rand(0, round(($speed*5)/100));
	$time = date('j.n.y H:i');

	count_query("UPDATE `users` SET `krystal`=krystal+'".$kr."', `mwork`='0', `mper`='0', `mmine`=mmine+'".$kr."' WHERE `id_user` = '".$res['id_user']."'") or die("Invalid query: " . mysql_error());
	count_query("INSERT INTO `message` (`time`, `to`, `text`, `metka`) VALUES ('".$time."', '".$res['name']."', '�� �������� � ����� � ������ ".$kr." <img src=/images/ico_krist1.png alt=�������� align=absmiddle class=png>', '6')") or die("Invalid query: " . mysql_error());
	count_query ("UPDATE users SET read_msg='0' WHERE id_user='".$res['id_user']."'") or die("Invalid query: " . mysql_error());
}

function kosti()
{
	$one = rand(1,6);
	$two = rand(1,6);
	$three = rand(1,6);
	$four = rand(1,6);
	$five = rand(1,6);
	$arr = array ($one,$two,$three,$four,$five);
	return $arr;
}

function power($upow,$uskill,$udef,$uabi,$idBat,$plo,$plt)
{
	$krit = rand(1,10);
	if ($krit == 7) {
		$ukrit = ($upow*150)/100;
	} else if ($krit == 5) {
		$ukrit = ($upow*150)/100;
	} else {
		$ukrit = 1;
	}
	$Damage = (($upow + $uskill) - ($udef + $uabi)) + $ukrit;

	if ($Damage <= 0)	{
		$Damage = 0;
	}

	if ($ukrit == 1)	{
		$txt = "<b>".$plo."</b> ���� ������ ������ � ������� <b>".$plt."</b>.";
	}	else if ($ukrit > 1)	{
		$txt ="<a style=color:#FF3300><b>".$plo."</b> ������� ����������� ���� � ������� ������ <b>".$plt."</b></a>";
	}

	count_query("INSERT INTO `words` (`id_bat`, `plo`, `plt`, `text`, `damage`) VALUES ('".$idBat."', '".$plo."', '".$plt."', '".$txt."', '".$Damage."')");

	return $Damage;
}

/*******************************
*������ ���������
*����������� � ������� � ��
*��� ��� �� �������
********************************/
function for_batt($att_damag,$def_damag,$bat,$win=null)
{
	$bat_zap = mysql_fetch_array(count_query("SELECT * FROM `fight` WHERE `id` = '".$bat."'"));
	$att_p = mysql_fetch_array(count_query("SELECT * FROM `users` WHERE `id_user` = '".$bat_zap['att']."'"));
	$def_p = mysql_fetch_array(count_query("SELECT * FROM `users` WHERE `id_user` = '".$bat_zap['def']."'"));

	$time = date('j.n.y H:i');
	$timer=time()+3600; //������ ������ �� ���
	$exp=rand(0,3);

	if ($win == 1 OR $att_damag > $def_damag)	{
		if ($def_p['safe'] > 0)		{
			$gold = $def_p['gold'] - ((($def_p['gold']*85)/100)*15/100);
		}		else		{
			$gold = $def_p['gold'] - (($def_p['gold']*85)/100);
		}

		if ((lvl($att_p['exp'])-lvl($def_p['exp'])) > 3)		{
			$gl = -5;
		}		else if ((lvl($att_p['exp'])-lvl($def_p['exp'])) < 3)		{
			$gl = 5;
		}
		if (lvl($att_p['exp'])< lvl($att_p['exp']+$exp)){$hp_up=25;}else{$hp_up=0;}

		if ($att_p['hp_now'] - $def_damag <= 0)		{
			$health2 = 1;
		}		else		{
			$health2 = $att_p['hp_now'] - $def_damag;
		}
		count_query("UPDATE users SET  gold=gold+'".$gold."', exp=exp+'".$exp."', `glory`=`glory`+'".$gl."', battle=battle+1, win=win+1, hp_now = '".$health2."', loot=loot+'".$gold."', hp=hp+'".$hp_up."', damage=damage+ '".$att_damag."' WHERE id_user = '".$att_p['id_user']."'");
		count_query("INSERT INTO message (`time`, `to`, `text`, `metka`) VALUES ('".$time."', '".$att_p['name']."', '<a href=\'fight_log.php?log_id=".$bat."\' class=\'text_main_1 fight_win\'>�� ��������� ".$def_p['name']."</a>', '3')");
		count_query ("UPDATE users SET read_msg='0' WHERE id_user='".$att_p['id_user']."'");
		count_query("UPDATE `fight` SET `winer` = '".$att_p['name']."', `damage_a`='".$att_damag."', `damage_d`='".$def_damag."', `gold`='".$gold."', `exp`='".$exp."', safe_a='".$att_p['safe']."', safe_d='".$def_p['safe']."', woodoo1_a='".$att_p['woodoo']."', woodoo1_d='".$def_p['woodoo']."', woodoo2_a='".$att_p['woodoo2']."', woodoo2_d='".$def_p['woodoo2']."', woodoo3_a='".$att_p['woodoo3']."', woodoo3_d='".$def_p['woodoo3']."', woodoo4_a='".$att_p['woodoo4']."', woodoo4_d='".$def_p['woodoo4']."', helmet_a='".$att_p['helmet']."', helmet_d='".$def_p['helmet']."', necklet_a='".$att_p['necklet']."', necklet_d='".$def_p['necklet']."', weapon_a='".$att_p['weapon']."', weapon_d='".$def_p['weapon']."', shield_a='".$att_p['shield']."', shield_d='".$def_p['shield']."', armor_a='".$att_p['armor']."', armor_d='".$def_p['armor']."', lvl_a='".lvl($att_p['exp'])."', lvl_d='".lvl($def_p['exp'])."', power_a='".$att_p['power']."', power_d='".$def_p['power']."', def_a='".$att_p['def']."', def_d='".$def_p['def']."', ability_a='".$att_p['ability']."', ability_d='".$def_p['ability']."', mass_a='".$att_p['mass']."', mass_d='".$def_p['mass']."', skill_a='".$att_p['skill']."', skill_d='".$def_p['skill']."' WHERE `id` = '".$bat."'");
		// ����������� defer
		if ($def_p['hp_now'] - $att_damag <= 0)		{
			$health = 1;
		}		else		{
			$health = $def_p['hp_now'] - $att_damag;
		}
		$gold2 = $def_p['gold'] - $gold;
		if ($gold2 < 0)		{
			$gold2 = 0;
		}
		count_query("UPDATE users SET  gold='".$gold2."', battle=battle+1, damage=damage+'".$def_damag."', lost=lost+'".$gold."', hp_now = '".$health."', last_bat='".time()."' WHERE id_user = '".$def_p['id_user']."'");
		count_query("INSERT INTO message (`time`, `to`, `text`, `metka`) VALUES ('".$time."', '".$def_p['name']."', '<a href=\'fight_log.php?log_id=".$bat."\' class=\'text_main_1 fight_loss\'>".$att_p['name']." �������� ���</a>', '3')");
		count_query ("UPDATE users SET read_msg='0' WHERE id_user='".$def_p['id_user']."'");
	}
	else if ($win == 2 OR $att_damag < $def_damag)
	{
		if ($att_p['safe'] > 0)		{
			$gold = $att_p['gold'] - ((($att_p['gold']*85)/100)*15/100);
		}		else		{
			$gold = $att_p['gold'] - (($att_p['gold']*85)/100);
		}

		if ((lvl($att_p['exp'])-lvl($def_p['exp'])) > 3)		{
			$gl = 5;
		}		else if ((lvl($att_p['exp'])-lvl($def_p['exp'])) < 3)		{
			$gl = -5;
		}
		if (lvl($def_p['exp'])< lvl($def_p['exp']+$exp)){$hp_up=25;}else{$hp_up=0;}

		if ($def_p['hp_now'] - $att_damag <= 0)		{
			$health2 = 1;
		}		else		{
			$health2 = $def_p['hp_now'] - $att_damag;
		}
		count_query("UPDATE users SET  gold=gold+'".$gold."', exp=exp+'".$exp."', `glory`=`glory`+'".$gl."', battle=battle+1, win=win+1, loot=loot+'".$gold."', hp=hp+'".$hp_up."', hp_now = '".$health2."', damage=damage+ '".$def_damag."' WHERE id_user = '".$def_p['id_user']."'");
		count_query("INSERT INTO message (`time`, `to`, `text`, `metka`) VALUES ('".$time."', '".$def_p['name']."', '<a href=\'fight_log.php?log_id=".$bat."\' class=\'text_main_1 fight_win\'>".$att_p['name']." �������� ���</a>', '3')");
		count_query ("UPDATE users SET read_msg='0' WHERE id_user='".$def_p['id_user']."'");
		count_query("UPDATE `fight` SET `winer` = '".$def_p['name']."', `damage_a`='".$att_damag."', `damage_d`='".$def_damag."', `gold`='".$gold."', `exp`='".$exp."', safe_a='".$att_p['safe']."', safe_d='".$def_p['safe']."', woodoo1_a='".$att_p['woodoo']."', woodoo1_d='".$def_p['woodoo']."', woodoo2_a='".$att_p['woodoo2']."', woodoo2_d='".$def_p['woodoo2']."', woodoo3_a='".$att_p['woodoo3']."', woodoo3_d='".$def_p['woodoo3']."', woodoo4_a='".$att_p['woodoo4']."', woodoo4_d='".$def_p['woodoo4']."', helmet_a='".$att_p['helmet']."', helmet_d='".$def_p['helmet']."', necklet_a='".$att_p['necklet']."', necklet_d='".$def_p['necklet']."', weapon_a='".$att_p['weapon']."', weapon_d='".$def_p['weapon']."', shield_a='".$att_p['shield']."', shield_d='".$def_p['shield']."', armor_a='".$att_p['armor']."', armor_d='".$def_p['armor']."', lvl_a='".lvl($att_p['exp'])."', lvl_d='".lvl($def_p['exp'])."', power_a='".$att_p['power']."', power_d='".$def_p['power']."', def_a='".$att_p['def']."', def_d='".$def_p['def']."', ability_a='".$att_p['ability']."', ability_d='".$def_p['ability']."', mass_a='".$att_p['mass']."', mass_d='".$def_p['mass']."', skill_a='".$att_p['skill']."', skill_d='".$def_p['skill']."' WHERE `id` = '".$bat."'");
		// ����������� ataker
		if ($att_p['hp_now'] - $def_damag <= 0)		{
			$health = 1;
		}		else		{
			$health = $att_p['hp_now'] - $def_damag;
		}
		$gold2 = $att_p['gold'] - $gold;
		if ($gold2 < 0)		{
			$gold2 = 0;
		}
		count_query("UPDATE users SET  gold='".$gold2."', battle=battle+1, damage=damage+'".$att_damag."', hp_now = '".$health."', lost=lost+'".$gold."', last_bat='".time()."' WHERE id_user = '".$att_p['id_user']."'");
		count_query("INSERT INTO message (`time`, `to`, `text`, `metka`) VALUES ('".$time."', '".$att_p['name']."', '<a href=\'fight_log.php?log_id=".$bat."\' class=\'text_main_1 fight_loss\'>�� ��������� ".$def_p['name']."</a>', '3')");
		count_query ("UPDATE users SET read_msg='0' WHERE id_user='".$att_p['id_user']."'");
	}
	$hp_a = mysql_fetch_array(count_query("SELECT * FROM `users` WHERE `id_user` = '".$att_p['id_user']."'"));
	$hp_d = mysql_fetch_array(count_query("SELECT * FROM `users` WHERE `id_user` = '".$def_p['id_user']."'"));
	count_query("UPDATE `fight` SET `hp_a`='".$hp_a['hp_now']."', `hp_d`='".$hp_d['hp_now']."' WHERE `id` = '".$bat."'");
	echo "<script>location.href='fight_log.php?log_id=".$bat."';</script>";
}
###########
####END####
###########

function bat($uid_att, $uid_def)
{
	$res = mysql_fetch_array(count_query("SELECT * FROM `users` WHERE `email` = '".$_SESSION['email']."'")) or die("Invalid query: " . mysql_error());
	if ($res['vip'] > 0)	{
		$t = time() + 300;
	}	else	{
		$t = time() + 900;
	}
	count_query("INSERT INTO `fight` (`time_b`, `att`, `def`) VALUES ('".time()."', '".$uid_att."', '".$uid_def."')");
	$battle = mysql_result(count_query("SELECT LAST_INSERT_ID() FROM `fight`"), 0);
	count_query("UPDATE `users` SET `bat_timer`='".$t."' WHERE `id_user` = '".$uid_att."'");

	############
	$att_p = mysql_fetch_array(count_query("SELECT * FROM `users` WHERE `id_user` = '".$uid_att."'"));
	$def_p = mysql_fetch_array(count_query("SELECT * FROM `users` WHERE `id_user` = '".$uid_def."'"));
	$item_a = count_query("SELECT  item.*, items_p.* FROM items_p RIGHT JOIN item  ON items_p.item_num=item.id WHERE items_p.uid = '".$att_p['id_user']."'");
	$item_d = count_query("SELECT  item.*, items_p.* FROM items_p RIGHT JOIN item  ON items_p.item_num=item.id WHERE items_p.uid = '".$def_p['id_user']."'");

	while ($item_number = mysql_fetch_array($item_a))	{
		if ($item_number['stat'] == 'on')		{
			//������ ������ �� ����� (��� ����������� ���������� � �������� ������) - ���� ���� �����
			$pow+=$item_number['pow'];
			$def+=$item_number['def'];
			$abi+=$item_number['abi'];
		}
	}
	while ($item_number2 = mysql_fetch_array($item_d))	{
		if ($item_number2['stat'] == 'on')		{
			//������ ������ �� ����� (��� ����������� ���������� � �������� ������) - ���� ���� �����
			$pow2+=$item_number2['pow'];
			$def2+=$item_number2['def'];
			$abi2+=$item_number2['abi'];
		}
	}

	/* ������ � ����� */
	if ($att_p['woodoo'] > 0)	{
		$att = ($att_p['power']+$pow) + round(($att_p['power']*30)/100);
	}	else	{
		$att = $att_p['power']+$pow;
	}
	if ($def_p['woodoo2'] > 0)	{
		$att2 = ($def_p['power']+$pow2) + round(($def_p['power']*30)/100);
	}	else	{
		$att2 = $def_p['power']+$pow2;
	}
	/* ������ � ������ */
	if ($att_p['woodoo3'] > 0)	{
		$adef = ($att_p['def']+$adef) + round(($att_p['def']*30)/100);
	}	else	{
		$adef = $att_p['def']+$adef;
	}
	if ($def_p['woodoo4'] > 0)	{
		$adef2 = ($def_p['def']+$adef2) + round(($def_p['def']*30)/100);
	}	else	{
		$adef2 = $def_p['def']+$adef2;
	}
	/* ��� */
	$index = 1;
	while ($index < 7)	{
		if ($pow == 0) {$upow = 1 + rand(1,5);} else {$upow = $pow + rand(1,5);}
		if ($pow2 == 0) {$upow2 = 1 + rand(1,5);} else {$upow2 = $pow2 + rand(1,5);}
		if ($def == 0) {$udef = 1;} else {$udef = $def;}
		if ($def2 == 0) {$udef2 = 1;} else {$udef2 = $def2;}
		$att_power = ($att_p['power'] * $upow) + $att;
		$def_power = ($def_p['power'] * $upow2) + $att2;
		$att_defender = ($att_p['def'] * $udef) + $adef;
		$def_defender = ($def_p['def'] * $udef2) + $adef2;
		$att_ability = $att_p['ability'] + $abi;
		$def_ability = $def_p['ability'] + $abi2;
		$a = power($att_power,$att_p['skill'],$def_defender,$def_ability,$battle,$att_p['name'],$def_p['name']);
		$d = power($def_power,$def_p['skill'],$att_defender,$att_ability,$battle,$def_p['name'],$att_p['name']);
		if ($a <= 0)		{
			$a = 0;
		}
		if ($d <= 0)		{
			$d = 0;
		}

		$att_damage += $a;
		$def_damage += $d;

		$aH = $att_p['hp_now'] - $def_damage;
		$dH = $def_p['hp_now'] - $att_damage;

		if ($aH <= 1)		{
			for_batt($att_damage,$def_damage,$battle,2);
			break;
		}
		if ($dH <= 1)		{
			for_batt($att_damage,$def_damage,$battle,1);
			break;
		}
		if ($index == 6)		{
			for_batt($att_damage,$def_damage,$battle);
		}
		$index++;
	}
}

function search_batt($num=null,$name=null,$min=null,$max=null)
{
	$res = mysql_fetch_array(count_query("SELECT * FROM `users` WHERE `email` = '".$_SESSION['email']."'")) or die("Invalid query: " . mysql_error());//��������� ������

	if ($res['race'] == 2) {
		$race = 1;
	} else {
		$race = 2;
	}
	//�������� �������� ����� � ����������� �� �������
	switch ($num)
	{
		case 1: $b = mysql_fetch_array(count_query("SELECT * FROM users WHERE exp >= '".$res['exp']."'-'25' AND exp <= '".$res['exp']."'+'25' AND race = '".$race."' ORDER BY rand() LIMIT 1")); break;
		case 2: $b = mysql_fetch_array(count_query("SELECT * FROM users WHERE exp <= '".$res['exp']."'-'35' AND exp >= '".$res['exp']."'-'50' AND race = '".$race."' ORDER BY rand() LIMIT 1")); break;
		case 3: $b = mysql_fetch_array(count_query("SELECT * FROM users WHERE exp >= '".$res['exp']."'+'35' AND exp <= '".$res['exp']."'+'50' AND race = '".$race."' ORDER BY rand() LIMIT 1")); break;
		case 4 AND $name != null: $b = mysql_fetch_array(count_query("SELECT * FROM users WHERE name = '".$name."'")); break;
		case 5 AND $name == null AND $min != null AND $max != null: $b = mysql_fetch_array(count_query("SELECT * FROM users WHERE exp >= '".lvl_to_exp($min)."' AND exp <= '".lvl_to_exp($max)."' AND race = '".$race."' ORDER BY rand() LIMIT 1")); break;
	}

	if ($b['name'] != $res['name'] AND $b['id_user'] != null AND (time() - $b['last_bat']) > 3600 AND $b['race'] != $res['race'] AND $b['hp_now'] >= 25) {
		return "<script>location.href='b.php?id=".$b['id_user']."';</script>";
	} else if ($name != null AND (time() - $b['last_bat']) <= 3600) {
		$err = "�� ����� ��������� ��� �������� � ������� 1 ����";
		return $err;
	} else if ($name != null AND $b['race'] == $res['race']) {
		$err = "�� ����� ������ ��������";
		return $err;
	} else {
		$err = "�� ������ �� �����";
		return $err;
	}
}

function monster($uid, $name=null)
{
	$res = mysql_fetch_array(count_query("SELECT * FROM `users` WHERE `email` = '".$_SESSION['email']."'")) or die("Invalid query: " . mysql_error());

	/*switch ($uid)
	{
		case 1: ;
			break;
		case 2: ;
			break;
	}*/
}

function top_p() //������� ��� �������
{
	include ("conf.php");

	$row = mysql_fetch_array(count_query("SELECT * FROM users WHERE email='".$_SESSION['email']."'"));
	count_query("set @n:=0");
	$zap = count_query("select rownum from (select @n:=@n+1 as rownum,id_user from users order by glory desc) t where id_user='".$row['id_user']."'");
	$topus = mysql_fetch_array($zap);
	$cont = count_query("SELECT * FROM users ORDER BY glory DESC") or die("Invalid query: " . mysql_error());
	$p = 1;
	while ($cont1 = mysql_fetch_array($cont))
	{
		if ($p > 3) {
			$pg = "_all";
		} else {
			$pg = $p;
		}
		echo '
			<tr><td class="menu3 text_top'.$pg.'">'.$p.'. <a href="http://'.$ADDR.'/player.php?id='.$cont1['id_user'].'">'.$cont1['name'].'</a></td></tr>';
			$p++;
		if ($topus['rownum'] <= 5) {
			if ($p > 5) {
				break;
			}
		}
		else if ($topus['rownum'] > 5) {
			if ($p > 3) {
				echo '<tr><td class="menu3 text_top_all">...</td></tr>';
				echo '<tr><td class="menu3 text_top_all">'.$topus['rownum'].'. <a href="http://'.$ADDR.'/player.php?id='.$row['id_user'].'">'.$row['name'].'</a></td></tr>';
				break;
			}
		}
	}
}

function top_c() //������� ��� ������
{
	include ("conf.php");

	$row = mysql_fetch_array(count_query("SELECT * FROM users WHERE email='".$_SESSION['email']."'"));
	$clan = mysql_fetch_array(count_query("SELECT * FROM clans WHERE id='".$row['clan']."'"));
	count_query("set @n:=0");
	$zap_clan = count_query("select rownum from (select @n:=@n+1 as rownum,id from clans order by glory desc) t where id='".$row['clan']."'");
	$topcl = mysql_fetch_array($zap_clan);
	$cont = count_query("SELECT * FROM clans ORDER BY glory DESC") or die("Invalid query: " . mysql_error());
	$p = 1;
	while ($cont1 = mysql_fetch_array($cont))
	{
			if ($p > 3) {
				$pg = "_all";
			} else {
				$pg = $p;
			}
			echo '
			<tr><td class="menu3 text_top'.$pg.'">'.$p.'. <a href="http://'.$ADDR.'/clan.php?id='.$cont1['id'].'">'.$cont1['name'].'</a></td></tr>';
			$p++;
			if ($topus['rownum'] <= 5) {
				if ($p > 5) {
					break;
				}
			}
			else if ($topus['rownum'] > 5) {
				if ($p > 3) {
					echo '<tr><td class="menu3 text_top_all">...</td></tr>';
					echo '<tr><td class="menu3 text_top_all">'.$topcl['rownum'].'. <a href="http://'.$ADDR.'/clan.php?id='.$clan['id'].'">'.$clan['name'].'</a></td></tr>';
					break;
				}
			}
	}
}
