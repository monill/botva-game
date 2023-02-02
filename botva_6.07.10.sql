-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Авг 05 2010 г., 17:36
-- Версия сервера: 5.1.33
-- Версия PHP: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- База данных: `botva`
--

-- --------------------------------------------------------

--
-- Структура таблицы `action`
--

CREATE TABLE IF NOT EXISTS `action` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `model` int(11) NOT NULL,
  `speed` int(11) NOT NULL,
  `timer` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 ;

--
-- Дамп данных таблицы `action`
--


-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Структура таблицы `clans`
--

CREATE TABLE IF NOT EXISTS `clans` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL,
  `race` int(1) NOT NULL,
  `tag` varchar(32) NOT NULL,
  `site` varchar(62) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `glory` int(11) NOT NULL DEFAULT '0',
  `mem` int(11) NOT NULL DEFAULT '1',
  `ava` int(11) NOT NULL DEFAULT '15144',
  `kgold` int(11) NOT NULL DEFAULT '0',
  `kzelen` int(11) NOT NULL DEFAULT '0',
  `kkrystal` int(11) NOT NULL DEFAULT '0',
  `barrak` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 ;

--
-- Дамп данных таблицы `clans`
--


-- --------------------------------------------------------

--
-- Структура таблицы `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `confirm` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 ;

--
-- Дамп данных таблицы `contacts`
--



-- --------------------------------------------------------

--
-- Структура таблицы `fight`
--

CREATE TABLE IF NOT EXISTS `fight` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `time_b` int(11) NOT NULL,
  `att` int(20) NOT NULL,
  `def` int(20) DEFAULT NULL,
  `winer` varchar(100) NOT NULL,
  `damage_a` int(11) NOT NULL,
  `damage_d` int(11) NOT NULL,
  `hp_a` int(11) NOT NULL,
  `hp_d` int(11) NOT NULL,
  `gold` int(11) NOT NULL,
  `exp` int(11) NOT NULL,
  `safe_a` int(11) NOT NULL,
  `safe_d` int(11) NOT NULL,
  `woodoo1_a` int(11) NOT NULL,
  `woodoo1_d` int(11) NOT NULL,
  `woodoo2_a` int(11) NOT NULL,
  `woodoo2_d` int(11) NOT NULL,
  `woodoo3_a` int(11) NOT NULL,
  `woodoo3_d` int(11) NOT NULL,
  `woodoo4_a` int(11) NOT NULL,
  `woodoo4_d` int(11) NOT NULL,
  `helmet_a` int(11) NOT NULL,
  `helmet_d` int(11) NOT NULL,
  `necklet_a` int(11) NOT NULL,
  `necklet_d` int(11) NOT NULL,
  `weapon_a` int(11) NOT NULL,
  `weapon_d` int(11) NOT NULL,
  `shield_a` int(11) NOT NULL,
  `shield_d` int(11) NOT NULL,
  `armor_a` int(11) NOT NULL,
  `armor_d` int(11) NOT NULL,
  `lvl_a` int(11) NOT NULL,
  `lvl_d` int(11) NOT NULL,
  `power_a` int(11) NOT NULL,
  `power_d` int(11) NOT NULL,
  `def_a` int(11) NOT NULL,
  `def_d` int(11) NOT NULL,
  `ability_a` int(11) NOT NULL,
  `ability_d` int(11) NOT NULL,
  `mass_a` int(11) NOT NULL,
  `mass_d` int(11) NOT NULL,
  `skill_a` int(11) NOT NULL,
  `skill_d` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 ;

--
-- Дамп данных таблицы `fight`
--


-- --------------------------------------------------------

--
-- Структура таблицы `gift`
--

CREATE TABLE IF NOT EXISTS `gift` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pic` varchar(64) NOT NULL,
  `name` varchar(64) NOT NULL,
  `cost` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `sell_cost` int(11) DEFAULT NULL,
  `sell_price` int(11) DEFAULT NULL,
  `when` int(11) NOT NULL,
  `eye` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `gift`
--

INSERT INTO `gift` (`id`, `pic`, `name`, `cost`, `price`, `sell_cost`, `sell_price`, `when`, `eye`) VALUES
(1, 'Gift_085', 'Пельмешки', 2, 5, 1, 25, 253, 1),
(2, 'Gift_086', 'Палитра', 2, 5, 1, 25, 254, 1),
(3, 'Gift_001', 'Сердечко', 2, 5, 1, 25, 136, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `gifts_p`
--

CREATE TABLE IF NOT EXISTS `gifts_p` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid_g` int(11) NOT NULL,
  `pid_g` int(11) NOT NULL DEFAULT '0',
  `gift_num` int(11) DEFAULT NULL,
  `desc` varchar(100) NOT NULL,
  `when` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 ;

--
-- Дамп данных таблицы `gifts_p`
--



-- --------------------------------------------------------

--
-- Структура таблицы `ignore`
--

CREATE TABLE IF NOT EXISTS `ignore` (
  `id_ign` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT NULL,
  `id_users` int(20) NOT NULL,
  PRIMARY KEY (`id_ign`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 ;

--
-- Дамп данных таблицы `ignore`
--


-- --------------------------------------------------------

--
-- Структура таблицы `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `who` int(1) NOT NULL,
  `sname` varchar(64) NOT NULL,
  `bname` varchar(64) NOT NULL,
  `model` int(11) DEFAULT NULL,
  `item` varchar(150) DEFAULT NULL,
  `lvl` int(11) DEFAULT NULL,
  `cost_gold` int(11) DEFAULT NULL,
  `cost_zelen` int(11) DEFAULT NULL,
  `cost_krystal` int(11) DEFAULT NULL,
  `health` int(11) DEFAULT NULL,
  `hp_perc` int(11) DEFAULT NULL,
  `pow` int(11) DEFAULT NULL,
  `def` int(11) DEFAULT NULL,
  `abi` int(11) DEFAULT NULL,
  `mas` int(11) DEFAULT NULL,
  `skil` int(11) DEFAULT NULL,
  `id_i` int(11) NOT NULL,
  `when` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=29 ;

--
-- Дамп данных таблицы `item`
--

INSERT INTO `item` (`id`, `who`, `sname`, `bname`, `model`, `item`, `lvl`, `cost_gold`, `cost_zelen`, `cost_krystal`, `health`, `hp_perc`, `pow`, `def`, `abi`, `mas`, `skil`, `id_i`, `when`) VALUES
(1, 1, 'Potion_1s', 'Potion_1', 1, 'Зеленка', 1, 100, 0, 0, 50, 0, 0, 0, 0, 0, 0, 1, 0),
(2, 1, 'Potion_2s', 'Potion_2', 1, 'Синька', 1, 200, 0, 0, 150, 0, 0, 0, 0, 0, 0, 2, 0),
(3, 1, 'Potion_3s', 'Potion_3', 1, 'Красный Диавол', 1, 0, 7, 7, 0, 100, 0, 0, 0, 0, 0, 3, 0),
(4, 2, 'Potion_7s', 'Potion_7', 1, 'Бутылочка', 1, 0, 1, 1, 0, 10, 0, 0, 0, 0, 0, 130, 0),
(5, 2, 'Potion_8s', 'Potion_8', 1, 'Пузырёк', 1, 0, 3, 3, 0, 35, 0, 0, 0, 0, 0, 131, 0),
(6, 2, 'Potion_9s', 'Potion_9', 1, 'Жёлтый Диавол', 1, 0, 7, 7, 0, 100, 0, 0, 0, 0, 0, 132, 0),
(7, 1, 'Weap_3s', 'Weap_3', 2, 'Ручкадраль', 4, 128, 0, 0, 0, 0, 4, 0, 0, 0, 0, 6, 3),
(8, 1, 'Weap_2s', 'Weap_2', 2, 'Мстя', 3, 80, 0, 0, 0, 0, 3, 0, 0, 0, 0, 5, 3),
(10, 1, 'Helm_1s', 'Helm_1', 4, 'Соломня', 3, 398, 0, 0, 0, 0, 0, 8, 0, 0, 0, 47, 1),
(11, 1, 'Arm_2s', 'Arm_2', 5, 'Скрепикольца', 3, 768, 0, 0, 0, 0, 4, 8, 0, 0, 0, 62, 5),
(12, 1, 'Arm_1s', 'Arm_1', 5, 'Мешанина', 1, 178, 0, 0, 0, 0, 2, 5, 0, 0, 0, 61, 5),
(13, 1, 'Weap_1s', 'Weap_1', 2, 'Скапаловник', 2, 45, 0, 0, 0, 0, 2, 0, 0, 0, 0, 4, 3),
(14, 1, 'Weap_4s', 'Weap_4', 2, 'Тыкаглаз', 5, 231, 0, 0, 0, 0, 6, 0, 0, 0, 0, 7, 3),
(15, 1, 'Weap_5s', 'Weap_5', 2, 'Гвоздопер', 6, 370, 0, 0, 0, 0, 8, 0, 0, 0, 0, 8, 3),
(16, 1, 'Weap_6s', 'Weap_6', 2, 'Древеч', 7, 611, 0, 0, 0, 0, 10, 0, 4, 0, 0, 9, 3),
(17, 1, 'Helm_2s', 'Helm_2', 4, 'Дуршлапс', 5, 1376, 0, 0, 0, 0, 0, 12, 0, 0, 0, 48, 1),
(18, 1, 'Helm_3s', 'Helm_3', 4, 'Корытса', 7, 3317, 0, 0, 0, 0, 0, 18, 0, 0, 0, 49, 1),
(19, 1, 'Arm_3s', 'Arm_3', 5, 'Бачища', 5, 5349, 0, 0, 0, 0, 8, 10, 0, 0, 0, 63, 5),
(20, 1, 'Arm_4s', 'Arm_4', 5, 'Дырбачища', 7, 8915, 0, 0, 0, 0, 10, 20, 0, 0, 0, 64, 5),
(21, 1, 'Weap_7s', 'Weap_7', 2, 'Капустыщ', 8, 800, 0, 0, 0, 0, 10, 0, 8, 0, 0, 10, 3),
(22, 1, 'Weap_8s', 'Weap_8', 2, 'Саблизуб', 9, 1200, 0, 0, 0, 0, 12, 0, 8, 0, 0, 11, 3),
(23, 1, 'Helm_4s', 'Helm_4', 4, 'Тазегс', 9, 4058, 0, 0, 0, 0, 4, 20, 0, 0, 0, 50, 1),
(24, 1, 'Arm_5s', 'Arm_5', 5, 'Садамаза', 9, 12560, 0, 0, 0, 0, 15, 25, 0, 0, 0, 65, 5),
(28, 1, 'Weap_41s', 'Weap_41', 2, 'Убийца(Артефакт)', 5, 5000, 0, 0, 0, 0, 20, 10, 5, 0, 5, 34, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `items_p`
--

CREATE TABLE IF NOT EXISTS `items_p` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `item_num` int(11) NOT NULL,
  `model` int(11) DEFAULT NULL,
  `stat` varchar(3) NOT NULL,
  `vol` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 ;

--
-- Дамп данных таблицы `items_p`
--



-- --------------------------------------------------------

--
-- Структура таблицы `klog`
--

CREATE TABLE IF NOT EXISTS `klog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `clan_stat` varchar(100) NOT NULL,
  `gold` int(11) NOT NULL,
  `zelen` int(11) NOT NULL,
  `krystal` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `klog`
--


-- --------------------------------------------------------


--
-- Структура таблицы `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id_msg` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `time` varchar(64) DEFAULT NULL,
  `to` varchar(64) DEFAULT NULL,
  `from` varchar(64) NOT NULL,
  `theme` varchar(64) NOT NULL,
  `text` varchar(2000) NOT NULL,
  `metka` int(2) NOT NULL,
  PRIMARY KEY (`id_msg`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 ;

--
-- Дамп данных таблицы `message`
--



-- --------------------------------------------------------

--
-- Структура таблицы `naperstki`
--

CREATE TABLE IF NOT EXISTS `naperstki` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `stavka` int(1) NOT NULL,
  `money` int(11) NOT NULL,
  `win` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `naperstki`
--


-- --------------------------------------------------------

--
-- Структура таблицы `online`
--

CREATE TABLE IF NOT EXISTS `online` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_session` int(11) NOT NULL,
  `putdate` int(30) NOT NULL DEFAULT '0',
  `current_page` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 ;

--
-- Дамп данных таблицы `online`
--


-- --------------------------------------------------------

--
-- Структура таблицы `pets`
--

CREATE TABLE IF NOT EXISTS `pets` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(20) NOT NULL,
  `name` varchar(32) DEFAULT NULL,
  `hp` int(11) NOT NULL,
  `hp_now` int(11) NOT NULL,
  `power` int(11) NOT NULL,
  `def` int(11) NOT NULL,
  `ability` int(11) NOT NULL,
  `mass` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 ;

--
-- Дамп данных таблицы `pets`
--


-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL,
  `pass` varchar(32) DEFAULT NULL,
  `email` varchar(64) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `last_ip` varchar(20) NOT NULL,
  `last_time` int(11) NOT NULL DEFAULT '0',
  `ban` int(20) NOT NULL DEFAULT '0',
  `race` int(1) NOT NULL,
  `gender` int(1) NOT NULL DEFAULT '1',
  `ava1` varchar(100) NOT NULL,
  `ava2` varchar(100) NOT NULL,
  `ava3` varchar(100) NOT NULL,
  `token` varchar(32) NOT NULL,
  `gold` int(11) NOT NULL DEFAULT '50',
  `krystal` int(11) NOT NULL DEFAULT '0',
  `zelen` int(11) NOT NULL DEFAULT '0',
  `hp` int(11) NOT NULL DEFAULT '100',
  `exp` int(11) NOT NULL DEFAULT '0',
  `hp_now` int(11) NOT NULL DEFAULT '100',
  `power` int(11) NOT NULL DEFAULT '5',
  `def` int(11) NOT NULL DEFAULT '5',
  `ability` int(11) NOT NULL DEFAULT '5',
  `mass` int(11) NOT NULL DEFAULT '5',
  `skill` int(11) NOT NULL DEFAULT '5',
  `glory` int(11) NOT NULL DEFAULT '0',
  `ref` int(11) NOT NULL DEFAULT '0',
  `battle` int(11) NOT NULL DEFAULT '0',
  `win` int(11) NOT NULL DEFAULT '0',
  `loot` int(11) NOT NULL DEFAULT '0',
  `lost` int(11) NOT NULL DEFAULT '0',
  `damage` int(11) NOT NULL DEFAULT '0',
  `pet` int(20) NOT NULL DEFAULT '0',
  `safe` int(11) NOT NULL DEFAULT '0',
  `safe2` int(11) NOT NULL DEFAULT '0',
  `safe3` int(11) NOT NULL DEFAULT '0',
  `safe4` int(11) NOT NULL DEFAULT '0',
  `woodoo` int(11) NOT NULL DEFAULT '0',
  `woodoo2` int(11) NOT NULL DEFAULT '0',
  `woodoo3` int(11) NOT NULL DEFAULT '0',
  `woodoo4` int(11) NOT NULL DEFAULT '0',
  `house` int(11) NOT NULL DEFAULT '0',
  `cage` int(11) NOT NULL DEFAULT '0',
  `fence` int(11) NOT NULL DEFAULT '0',
  `road` int(11) NOT NULL DEFAULT '0',
  `out` int(11) NOT NULL DEFAULT '0',
  `plant` int(11) NOT NULL DEFAULT '0',
  `time_dozor` int(11) NOT NULL DEFAULT '120',
  `vip` int(20) NOT NULL DEFAULT '0',
  `last_bat` int(11) NOT NULL DEFAULT '0',
  `clan` int(11) NOT NULL DEFAULT '0',
  `clan_stat` varchar(64) NOT NULL DEFAULT 'Призывник',
  `description` varchar(1000) NOT NULL DEFAULT 'Описание персонажа отсутствует',
  `att_description` varchar(500) NOT NULL DEFAULT 'Сообщение отсутствует',
  `bat_timer` int(11) NOT NULL DEFAULT '0',
  `authlevel` int(2) NOT NULL DEFAULT '0',
  `helmet` int(20) NOT NULL DEFAULT '0',
  `necklet` int(20) NOT NULL DEFAULT '0',
  `weapon` int(20) NOT NULL DEFAULT '0',
  `shield` int(20) NOT NULL DEFAULT '0',
  `armor` int(20) NOT NULL DEFAULT '0',
  `read_msg` int(1) NOT NULL DEFAULT '1',
  `kosti_g` int(11) NOT NULL DEFAULT '0',
  `kosti_k` int(11) NOT NULL DEFAULT '0',
  `kosti_g_stat` int(11) NOT NULL DEFAULT '0',
  `kosti_k_stat` int(11) NOT NULL DEFAULT '0',
  `kosti_z_stat` int(11) NOT NULL DEFAULT '0',
  `kosti_win` int(11) NOT NULL DEFAULT '0',
  `kosti_lose` int(11) NOT NULL DEFAULT '0',
  `naper_g` int(11) NOT NULL DEFAULT '0',
  `naper_k` int(11) NOT NULL DEFAULT '0',
  `recd_naper_g_stat` int(11) NOT NULL DEFAULT '0',
  `recd_naper_k_stat` int(11) NOT NULL DEFAULT '0',
  `recd_naper_z_stat` int(11) NOT NULL DEFAULT '0',
  `spend_naper_g_stat` int(11) NOT NULL DEFAULT '0',
  `spend_naper_k_stat` int(11) NOT NULL DEFAULT '0',
  `spend_naper_z_stat` int(11) NOT NULL DEFAULT '0',
  `naper_win` int(11) NOT NULL DEFAULT '0',
  `naper_lose` int(11) NOT NULL DEFAULT '0',
  `mmine` int(11) NOT NULL DEFAULT '0',
  `msglade` int(11) NOT NULL DEFAULT '0',
  `mbglade` int(11) NOT NULL DEFAULT '0',
  `mpick` int(11) NOT NULL DEFAULT '0',
  `mglass` int(11) NOT NULL DEFAULT '0',
  `mhelmet` int(11) NOT NULL DEFAULT '0',
  `mpicks` int(11) NOT NULL DEFAULT '0',
  `mglasss` int(11) NOT NULL DEFAULT '0',
  `mhelmets` int(11) NOT NULL DEFAULT '0',
  `mflash` int(11) NOT NULL DEFAULT '0',
  `mpow` int(11) NOT NULL DEFAULT '0',
  `mdef` int(11) NOT NULL DEFAULT '0',
  `mabi` int(11) NOT NULL DEFAULT '0',
  `mskil` int(11) NOT NULL DEFAULT '0',
  `mwork` int(11) NOT NULL DEFAULT '0',
  `mper` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id_user`, `name`, `pass`, `email`, `ip`, `last_ip`, `last_time`, `ban`, `race`, `gender`, `ava1`, `ava2`, `ava3`, `token`, `gold`, `krystal`, `zelen`, `hp`, `exp`, `hp_now`, `power`, `def`, `ability`, `mass`, `skill`, `glory`, `ref`, `battle`, `win`, `loot`, `lost`, `damage`, `pet`, `safe`, `safe2`, `safe3`, `safe4`, `woodoo`, `woodoo2`, `woodoo3`, `woodoo4`, `house`, `cage`, `fence`, `road`, `out`, `plant`, `time_dozor`, `vip`, `last_bat`, `clan`, `clan_stat`, `description`, `att_description`, `bat_timer`, `authlevel`, `helmet`, `necklet`, `weapon`, `shield`, `armor`, `read_msg`, `kosti_g`, `kosti_k`, `kosti_g_stat`, `kosti_k_stat`, `kosti_z_stat`, `kosti_win`, `kosti_lose`, `naper_g`, `naper_k`, `recd_naper_g_stat`, `recd_naper_k_stat`, `recd_naper_z_stat`, `spend_naper_g_stat`, `spend_naper_k_stat`, `spend_naper_z_stat`, `naper_win`, `naper_lose`, `mmine`, `msglade`, `mbglade`, `mpick`, `mglass`, `mhelmet`, `mpicks`, `mglasss`, `mhelmets`, `mflash`, `mpow`, `mdef`, `mabi`, `mskil`, `mwork`, `mper`) VALUES
(1, 'test', 'dGVzdA==', 'test@test.com', '0', '127.0.0.1', 1279528892, 0, 2, 1, '012a23', '012b311', '012c32', 'a19f73289638977737acde1285d6eced', 3611, 0, 28, 325, 197, 325, 30, 35, 25, 30, 40, 9, 0, 39, 11, 1453, 7697, 3155, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 120, 0, 1279630255, 0, 'Призывник', 'Описание персонажа отсутствует', 'Сообщение отсутствует', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(25, 'Bot1', 'dGVzdA==', 'bot1@bot.ru', '0', '127.0.0.1', 1280506106, 0, 2, 1, '012a23', '012b311', '012c32', '9ca946668e7a84c2202fc6ec52e66fc6', 877, 10, 10, 300, 151, 300, 25, 25, 25, 25, 25, 49, 0, 25, 1, 544, 5804, 1065, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 120, 0, 1280477254, 9, 'Вождь', 'Описание персонажа отсутствует', 'Сообщение отсутствует', 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(26, 'Bot2', 'dGVzdA==', 'bot2@bot.ru', '0', '0', 0, 0, 2, 1, '012a23', '012b311', '012c32', '', 1386, 0, 1, 250, 241, 250, 40, 35, 35, 35, 35, -1, 0, 19, 1, 479, 5274, 1037, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 120, 0, 1280477617, 0, 'Призывник', 'Описание персонажа отсутствует', 'Сообщение отсутствует', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(27, 'Botik', 'dGVzdA==', 'botik@botik.ru', '0', '127.0.0.1', 1276870603, 0, 2, 1, '012a23', '012b311', '012c32', '5f3bc361a982dce79c5b4f77dc8676ae', 4199, 0, 1, 230, 170, 230, 18, 25, 25, 18, 15, 0, 0, 25, 0, 0, 14105, 478, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 120, 0, 1279549119, 0, 'Призывник', 'Описание персонажа отсутствует', 'Сообщение отсутствует', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(36, 'Base64', 'dGVzdA==', 'base@inbox.ru', '127.0.0.1', '127.0.0.1', 1280607751, 0, 1, 1, '112a35', '112b314', '112c53', '1243827e3ee1a2267def550247892852', 100, 0, 3, 100, 0, 100, 5, 5, 5, 5, 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 120, 0, 0, 0, 'Призывник', 'Описание персонажа отсутствует', 'Сообщение отсутствует', 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `words`
--

CREATE TABLE IF NOT EXISTS `words` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_bat` int(11) NOT NULL,
  `plo` varchar(64) NOT NULL,
  `plt` varchar(64) NOT NULL,
  `text` varchar(300) NOT NULL,
  `damage` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 ;

--
-- Дамп данных таблицы `words`
--
