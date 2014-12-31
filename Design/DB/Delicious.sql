-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: 127.7.36.2:3306
-- Generation Time: Dec 31, 2014 at 07:10 PM
-- Server version: 5.5.40
-- PHP Version: 5.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `delicious`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE IF NOT EXISTS `album` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dish_id` int(10) unsigned NOT NULL,
  `album_path` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=60 ;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`id`, `dish_id`, `album_path`) VALUES
(44, 1, 'c342356bc4022ee7df93466f362d3a5c.jpg'),
(45, 1, '69663884a516b618b7cb83c85a3d90cb.jpg'),
(46, 2, '7a80c903b5a18b7bd902d183787079a5.jpg'),
(47, 2, '62bb57522cc24a099cbe435eb8ea2bc2.jpg'),
(48, 3, '351f43c37b2ec9603d3c226dc7fc4257.jpg'),
(49, 4, '1a9f9b83f0304fde7012121abc176091.jpg'),
(50, 4, 'ad6ac4ec84b52a75a0db50c64ea56223.jpg'),
(51, 5, '6436c60602e14e5118ce43f9ae83b233.jpg'),
(52, 5, '99eb4d32a53cb1701dbcece82d805a87.jpg'),
(53, 6, 'd326bacd887a0aaa5464b0db99bbcf90.jpg'),
(54, 6, '5e15d3b079f2f7b0f1924357641c79bf.jpg'),
(55, 7, 'f4d110151c2733ce39dcbdba3bf4850a.jpg'),
(56, 7, 'f9d83baff66475517971383f80e15939.jpg'),
(57, 8, '1c37b57b5f969524c74d0c2ffe7a22e8.jpg'),
(58, 8, 'c295794c7f5762a1ee5b2d8044d7e5cc.jpg'),
(59, 9, '2738b647ab0adf1117041b5019feb5e5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `cate_cn`
--

CREATE TABLE IF NOT EXISTS `cate_cn` (
  `cate_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`cate_id`),
  UNIQUE KEY `cate_name` (`cate_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `cate_cn`
--

INSERT INTO `cate_cn` (`cate_id`, `cate_name`) VALUES
(6, '什锦饭'),
(1, '头盘 & 汤'),
(5, '正宗四川菜'),
(4, '正宗广东和香港餐'),
(3, '正宗泰国餐'),
(2, '汤餐');

-- --------------------------------------------------------

--
-- Table structure for table `cate_en`
--

CREATE TABLE IF NOT EXISTS `cate_en` (
  `cate_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`cate_id`),
  UNIQUE KEY `cate_name` (`cate_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `cate_en`
--

INSERT INTO `cate_en` (`cate_id`, `cate_name`) VALUES
(1, 'Appetizers'),
(6, 'Assorted Plates'),
(4, 'Cantonese and Hong Kong Style'),
(2, 'Soup Meals'),
(5, 'Szechuan Style'),
(3, 'Thaï Style');

-- --------------------------------------------------------

--
-- Table structure for table `cate_fr`
--

CREATE TABLE IF NOT EXISTS `cate_fr` (
  `cate_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`cate_id`),
  UNIQUE KEY `cate_name` (`cate_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `cate_fr`
--

INSERT INTO `cate_fr` (`cate_id`, `cate_name`) VALUES
(6, 'Assiettes Assorties'),
(1, 'Les Hors - d''oeuvre'),
(2, 'Soupe Repas'),
(4, 'Spécialités Cantonaises et Hong Kong'),
(5, 'Spécialités Széchuannaises'),
(3, 'Spécialités Thaïlandaises');

-- --------------------------------------------------------

--
-- Table structure for table `dish`
--

CREATE TABLE IF NOT EXISTS `dish` (
  `dish_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cate_id` smallint(5) unsigned NOT NULL,
  `dish_no` varchar(50) NOT NULL,
  `dish_num` int(10) unsigned DEFAULT '0',
  `reg_price` decimal(6,2) NOT NULL,
  `current_price` decimal(6,2) NOT NULL,
  `dish_time` int(10) unsigned NOT NULL,
  `is_show` tinyint(1) DEFAULT '1',
  `is_hot` tinyint(1) DEFAULT '0',
  `is_spicy` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`dish_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `dish`
--

INSERT INTO `dish` (`dish_id`, `cate_id`, `dish_no`, `dish_num`, `reg_price`, `current_price`, `dish_time`, `is_show`, `is_hot`, `is_spicy`) VALUES
(1, 5, '10001', 100, '15.00', '6.00', 1418275209, 1, 0, 1),
(2, 5, '10003', 100, '25.00', '23.00', 1418275305, 1, 0, 1),
(3, 5, '43a', 100, '9.95', '9.95', 1418355100, 1, 0, 0),
(4, 4, '10008', 100, '18.00', '18.00', 1418928359, 1, 0, 0),
(5, 4, '10009', 100, '20.00', '20.00', 1418928436, 1, 0, 0),
(6, 4, '100010', 100, '21.00', '21.00', 1418928570, 1, 0, 0),
(7, 4, '123458', 23, '19.00', '20.00', 1418928658, 1, 0, 0),
(8, 4, '100023', 13, '25.00', '22.00', 1418928748, 1, 0, 0),
(9, 3, '123457', 100, '21.00', '22.00', 1420048645, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `dish_cn`
--

CREATE TABLE IF NOT EXISTS `dish_cn` (
  `dish_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dish_name` varchar(50) NOT NULL,
  `dish_desc` mediumtext,
  PRIMARY KEY (`dish_id`),
  UNIQUE KEY `dish_name` (`dish_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `dish_cn`
--

INSERT INTO `dish_cn` (`dish_id`, `dish_name`, `dish_desc`) VALUES
(1, '鱼香肉丝', '<p style="color:#333333;font-family:''Trebuchet MS'', Tahoma, Verdana, Arial, sans-serif;font-size:14px;background-color:#EEEEEE;">\r\n	菜名：鱼香肉丝\r\n</p>\r\n<p style="color:#333333;font-family:''Trebuchet MS'', Tahoma, Verdana, Arial, sans-serif;font-size:14px;background-color:#EEEEEE;">\r\n	<br />\r\n</p>\r\n<p style="color:#333333;font-family:''Trebuchet MS'', Tahoma, Verdana, Arial, sans-serif;font-size:14px;background-color:#EEEEEE;">\r\n	原料：<a href="http://www.xinshipu.com/%E5%81%9A%E6%B3%95/%E7%8C%AA%E9%87%8C%E8%84%8A%E8%82%89/" class="orange-bottom"><span class="ingredient" style="font-weight:inherit;font-style:inherit;vertical-align:baseline;color:#222222;">猪里脊肉</span></a><span style="color:#222222;font-family:Tahoma, Helvetica, Arial, 宋体, sans-serif;line-height:24px;background-color:#FFFFFF;">，</span><a href="http://www.xinshipu.com/%E5%81%9A%E6%B3%95/%E7%BB%BF%E5%B0%96%E6%A4%92/" class="orange-bottom"><span class="ingredient" style="font-weight:inherit;font-style:inherit;vertical-align:baseline;color:#222222;">绿尖椒</span></a><span style="color:#222222;font-family:Tahoma, Helvetica, Arial, 宋体, sans-serif;line-height:24px;background-color:#FFFFFF;">，</span><a href="http://www.xinshipu.com/%E5%81%9A%E6%B3%95/%E8%83%A1%E8%90%9D%E5%8D%9C/" class="orange-bottom"><span class="ingredient" style="font-weight:inherit;font-style:inherit;vertical-align:baseline;color:#222222;">胡萝卜</span></a><span style="color:#222222;font-family:Tahoma, Helvetica, Arial, 宋体, sans-serif;line-height:24px;background-color:#FFFFFF;">，</span><a href="http://www.xinshipu.com/%E5%81%9A%E6%B3%95/%E5%86%AC%E7%AC%8B/" class="orange-bottom"><span class="ingredient" style="font-weight:inherit;font-style:inherit;vertical-align:baseline;color:#222222;">冬笋</span></a><span style="color:#222222;font-family:Tahoma, Helvetica, Arial, 宋体, sans-serif;line-height:24px;background-color:#FFFFFF;">，</span><span style="color:#222222;background-color:#FFFFFF;">黑木耳。</span> \r\n</p>\r\n<p style="color:#333333;font-family:''Trebuchet MS'', Tahoma, Verdana, Arial, sans-serif;font-size:14px;background-color:#EEEEEE;">\r\n	<span style="color:#222222;font-family:Tahoma, Helvetica, Arial, 宋体, sans-serif;line-height:24px;background-color:#FFFFFF;">配料：<span>生抽，醋，白糖，盐，水淀粉</span>，<a href="http://www.xinshipu.com/%E5%81%9A%E6%B3%95/%E8%89%B2%E6%8B%89%E6%B2%B9/" class="orange-bottom"><span class="ingredient" style="font-weight:inherit;font-style:inherit;vertical-align:baseline;color:#222222;"><span class="name" style="font-weight:inherit;font-style:inherit;vertical-align:baseline;">色拉油</span></span></a><span>，葱，姜，蒜末适量，</span><a href="http://www.xinshipu.com/%E5%81%9A%E6%B3%95/%E5%9B%9B%E5%B7%9D%E6%B3%A1%E8%BE%A3%E6%A4%92/" class="orange-bottom"><span class="ingredient" style="font-weight:inherit;font-style:inherit;vertical-align:baseline;color:#222222;"><span class="name" style="font-weight:inherit;font-style:inherit;vertical-align:baseline;">四川泡辣椒</span></span></a>。</span> \r\n</p>'),
(2, '水煮鱼', '<p style="color:#333333;font-family:&quot;Trebuchet MS&quot;, Tahoma, Verdana, Arial, sans-serif;font-size:14px;background-color:#EEEEEE;">\r\n	菜名：水煮鱼\r\n</p>\r\n<p style="color:#333333;font-family:&quot;Trebuchet MS&quot;, Tahoma, Verdana, Arial, sans-serif;font-size:14px;background-color:#EEEEEE;">\r\n	<br />\r\n</p>\r\n<p style="color:#333333;font-family:&quot;Trebuchet MS&quot;, Tahoma, Verdana, Arial, sans-serif;font-size:14px;background-color:#EEEEEE;">\r\n	原料：<a class="orange-bottom" href="http://www.xinshipu.com/%E5%81%9A%E6%B3%95/%E7%BD%97%E9%9D%9E%E9%B1%BC/"><span class="ingredient" style="color:#222222;font-style:inherit;font-weight:inherit;vertical-align:baseline;">罗非鱼</span></a><a class="orange-bottom" href="http://www.xinshipu.com/%E5%81%9A%E6%B3%95/%E9%B1%BC%E7%89%87/"><span class="ingredient" style="color:#222222;font-style:inherit;font-weight:inherit;vertical-align:baseline;">鱼片</span></a><span style="color:#222222;line-height:24px;font-family:Tahoma, Helvetica, Arial, 宋体, sans-serif;background-color:#FFFFFF;">、</span><a class="orange-bottom" href="http://www.xinshipu.com/%E5%81%9A%E6%B3%95/%E9%BB%84%E8%B1%86%E8%8A%BD/"><span class="ingredient" style="color:#222222;font-style:inherit;font-weight:inherit;vertical-align:baseline;">黄豆芽</span></a><span style="color:#222222;line-height:24px;font-family:Tahoma, Helvetica, Arial, 宋体, sans-serif;background-color:#FFFFFF;">、</span><a class="orange-bottom" href="http://www.xinshipu.com/%E5%81%9A%E6%B3%95/%E8%8A%B1%E6%A4%92/"><span class="ingredient" style="color:#222222;font-style:inherit;font-weight:inherit;vertical-align:baseline;">花椒</span></a><span style="color:#222222;line-height:24px;font-family:Tahoma, Helvetica, Arial, 宋体, sans-serif;background-color:#FFFFFF;">、</span><a class="orange-bottom" href="http://www.xinshipu.com/%E5%81%9A%E6%B3%95/%E5%B9%B2%E8%BE%A3%E6%A4%92/"><span class="ingredient" style="color:#222222;font-style:inherit;font-weight:inherit;vertical-align:baseline;">干辣椒</span></a><span style="color:#222222;line-height:24px;font-family:Tahoma, Helvetica, Arial, 宋体, sans-serif;background-color:#FFFFFF;">、</span><a class="orange-bottom" href="http://www.xinshipu.com/%E5%81%9A%E6%B3%95/%E5%A7%9C%E7%B2%89/"><span class="ingredient" style="color:#222222;font-style:inherit;font-weight:inherit;vertical-align:baseline;">姜粉</span></a><span style="color:#222222;line-height:24px;font-family:Tahoma, Helvetica, Arial, 宋体, sans-serif;background-color:#FFFFFF;">、</span><a class="orange-bottom" href="http://www.xinshipu.com/%E5%81%9A%E6%B3%95/%E9%B8%A1%E7%B2%BE/"><span class="ingredient" style="color:#222222;font-style:inherit;font-weight:inherit;vertical-align:baseline;">鸡精</span></a><span style="color:#222222;line-height:24px;font-family:Tahoma, Helvetica, Arial, 宋体, sans-serif;background-color:#FFFFFF;">、</span><a class="orange-bottom" href="http://www.xinshipu.com/%E5%81%9A%E6%B3%95/%E8%83%A1%E6%A4%92%E7%B2%89/"><span class="ingredient" style="color:#222222;font-style:inherit;font-weight:inherit;vertical-align:baseline;">胡椒粉</span></a><span style="color:#222222;line-height:24px;font-family:Tahoma, Helvetica, Arial, 宋体, sans-serif;background-color:#FFFFFF;">、</span><a class="orange-bottom" href="http://www.xinshipu.com/%E5%81%9A%E6%B3%95/%E8%BE%A3%E6%A4%92%E7%B2%89/"><span class="ingredient" style="color:#222222;font-style:inherit;font-weight:inherit;vertical-align:baseline;">辣椒粉</span></a><span style="color:#222222;line-height:24px;font-family:Tahoma, Helvetica, Arial, 宋体, sans-serif;background-color:#FFFFFF;">、白糖、醋、</span><a class="orange-bottom" href="http://www.xinshipu.com/%E5%81%9A%E6%B3%95/%E6%B7%80%E7%B2%89/"><span class="ingredient" style="color:#222222;font-style:inherit;font-weight:inherit;vertical-align:baseline;">淀粉</span></a><span style="color:#222222;line-height:24px;font-family:Tahoma, Helvetica, Arial, 宋体, sans-serif;background-color:#FFFFFF;">、蒜、姜、葱、</span><a class="orange-bottom" href="http://www.xinshipu.com/%E5%81%9A%E6%B3%95/%E6%96%99%E9%85%92/"><span class="ingredient" style="color:#222222;font-style:inherit;font-weight:inherit;vertical-align:baseline;">料酒</span></a><span style="color:#222222;line-height:24px;font-family:Tahoma, Helvetica, Arial, 宋体, sans-serif;background-color:#FFFFFF;">、</span><a class="orange-bottom" href="http://www.xinshipu.com/%E5%81%9A%E6%B3%95/%E9%83%AB%E5%8E%BF%E8%B1%86%E7%93%A3%E9%85%B1/"><span class="ingredient" style="color:#222222;font-style:inherit;font-weight:inherit;vertical-align:baseline;">郫县豆瓣酱</span></a><span style="color:#222222;line-height:24px;font-family:Tahoma, Helvetica, Arial, 宋体, sans-serif;background-color:#FFFFFF;">、</span><a class="orange-bottom" href="http://www.xinshipu.com/%E5%81%9A%E6%B3%95/%E8%9B%8B%E6%B8%85/"><span class="ingredient" style="color:#222222;font-style:inherit;font-weight:inherit;vertical-align:baseline;">蛋清</span></a><span style="color:#222222;line-height:24px;font-family:Tahoma, Helvetica, Arial, 宋体, sans-serif;background-color:#FFFFFF;">、</span><a class="orange-bottom" href="http://www.xinshipu.com/%E5%81%9A%E6%B3%95/%E9%AB%98%E6%B1%A4/"><span class="ingredient" style="color:#222222;font-style:inherit;font-weight:inherit;vertical-align:baseline;">高汤</span></a><span style="color:#222222;line-height:24px;font-family:Tahoma, Helvetica, Arial, 宋体, sans-serif;background-color:#FFFFFF;">、</span><a class="orange-bottom" href="http://www.xinshipu.com/%E5%81%9A%E6%B3%95/%E9%A6%99%E8%91%B1/"><span class="ingredient" style="color:#222222;font-style:inherit;font-weight:inherit;vertical-align:baseline;">香葱</span></a><span style="color:#222222;line-height:24px;font-family:Tahoma, Helvetica, Arial, 宋体, sans-serif;background-color:#FFFFFF;">。</span> \r\n</p>'),
(3, '左公鸡', '主料：鸡腿<br />\r\n辅料：青椒、红椒、洋葱、干辣椒、蒜、黑胡椒<br />'),
(4, '佛跳墙', '<span style="color:#333333;font-family:''Trebuchet MS'', Tahoma, Verdana, Arial, sans-serif;font-size:14px;line-height:normal;background-color:#EEEEEE;">佛跳墙</span>'),
(5, '蠔油牛肉', '蠔油牛肉'),
(6, '冬瓜盅', '<span style="color:#333333;font-family:''Trebuchet MS'', Tahoma, Verdana, Arial, sans-serif;font-size:14px;line-height:normal;background-color:#EEEEEE;">冬瓜盅</span>'),
(7, '鹽水鴨', '鹽水鴨'),
(8, '糖醋黃河鯉魚', '糖醋黃河鯉魚'),
(9, '测试', '是打发斯蒂芬四大 &nbsp;&nbsp;');

-- --------------------------------------------------------

--
-- Table structure for table `dish_en`
--

CREATE TABLE IF NOT EXISTS `dish_en` (
  `dish_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dish_name` varchar(50) NOT NULL,
  `dish_desc` mediumtext,
  PRIMARY KEY (`dish_id`),
  UNIQUE KEY `dish_name` (`dish_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `dish_en`
--

INSERT INTO `dish_en` (`dish_id`, `dish_name`, `dish_desc`) VALUES
(1, 'yuxiangroushi', '<p style="color:#333333;font-family:''Trebuchet MS'', Tahoma, Verdana, Arial, sans-serif;font-size:14px;background-color:#EEEEEE;">\r\n	Dish Name: Yuxiangrousi\r\n</p>\r\n<p style="color:#333333;font-family:''Trebuchet MS'', Tahoma, Verdana, Arial, sans-serif;font-size:14px;background-color:#EEEEEE;">\r\n	<br />\r\n</p>\r\n<p style="color:#333333;font-family:''Trebuchet MS'', Tahoma, Verdana, Arial, sans-serif;font-size:14px;background-color:#EEEEEE;">\r\n	Ingredient：Pork,,,,\r\n</p>'),
(2, 'ShuiZhu Fish', '<p style="color:#333333;font-family:&quot;Trebuchet MS&quot;, Tahoma, Verdana, Arial, sans-serif;font-size:14px;background-color:#EEEEEE;">\r\n	Dish Name: Shuizhuyu\r\n</p>\r\n<p style="color:#333333;font-family:&quot;Trebuchet MS&quot;, Tahoma, Verdana, Arial, sans-serif;font-size:14px;background-color:#EEEEEE;">\r\n	<br />\r\n</p>\r\n<p style="color:#333333;font-family:&quot;Trebuchet MS&quot;, Tahoma, Verdana, Arial, sans-serif;font-size:14px;background-color:#EEEEEE;">\r\n	Ingredient: fish\r\n</p>'),
(3, 'General Tao Chicken', 'Ingredients: chicken legs, green and red pepper, onion, dry chili, garlic, black pepper.'),
(4, 'fotiaoqiang', '<span style="color:#333333;font-family:''Trebuchet MS'', Tahoma, Verdana, Arial, sans-serif;font-size:14px;line-height:normal;background-color:#EEEEEE;">fotiaoqiang</span>'),
(5, 'Hao You Niu Rou', 'Hao You Niu Rou'),
(6, 'Dgg', '<span style="color:#333333;font-family:''Trebuchet MS'', Tahoma, Verdana, Arial, sans-serif;font-size:14px;line-height:normal;background-color:#EEEEEE;">Dgg</span>'),
(7, 'YSY', '<p>\r\n	YSY\r\n</p>'),
(8, 'TANG CHU HUANG HE LI YU', 'TANG CHU HUANG HE LI YU'),
(9, 'test', 'SSSSS');

-- --------------------------------------------------------

--
-- Table structure for table `dish_fr`
--

CREATE TABLE IF NOT EXISTS `dish_fr` (
  `dish_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dish_name` varchar(50) NOT NULL,
  `dish_desc` mediumtext,
  PRIMARY KEY (`dish_id`),
  UNIQUE KEY `dish_name` (`dish_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `dish_fr`
--

INSERT INTO `dish_fr` (`dish_id`, `dish_name`, `dish_desc`) VALUES
(1, 'yuxiangroushi', '<p style="color:#333333;font-family:''Trebuchet MS'', Tahoma, Verdana, Arial, sans-serif;font-size:14px;background-color:#EEEEEE;">\r\n	Dish Name: Yuxiangrousi\r\n</p>\r\n<p style="color:#333333;font-family:''Trebuchet MS'', Tahoma, Verdana, Arial, sans-serif;font-size:14px;background-color:#EEEEEE;">\r\n	<br />\r\n</p>\r\n<p style="color:#333333;font-family:''Trebuchet MS'', Tahoma, Verdana, Arial, sans-serif;font-size:14px;background-color:#EEEEEE;">\r\n	Ingredient：Pork,,,\r\n</p>'),
(2, 'ShuiZhu Poisson', '<p style="color:#333333;font-family:&quot;Trebuchet MS&quot;, Tahoma, Verdana, Arial, sans-serif;font-size:14px;background-color:#EEEEEE;">\r\n	Dish Name: Shuizhuyu\r\n</p>\r\n<p style="color:#333333;font-family:&quot;Trebuchet MS&quot;, Tahoma, Verdana, Arial, sans-serif;font-size:14px;background-color:#EEEEEE;">\r\n	<br />\r\n</p>\r\n<p style="color:#333333;font-family:&quot;Trebuchet MS&quot;, Tahoma, Verdana, Arial, sans-serif;font-size:14px;background-color:#EEEEEE;">\r\n	Ingredient: fish\r\n</p>'),
(3, 'Poulet Général Tao', 'Ingrédients: cuisses de poulet, poivrons verts et rouges, oignons, piment sec, l''ail, le poivre noir.'),
(4, 'fotiaoqiang', '<span style="color:#333333;font-family:''Trebuchet MS'', Tahoma, Verdana, Arial, sans-serif;font-size:14px;line-height:normal;background-color:#EEEEEE;">fotiaoqiang</span>'),
(5, 'Hao You Niu Rou', 'Hao You Niu Rou'),
(6, 'Dgg', '<span style="color:#333333;font-family:''Trebuchet MS'', Tahoma, Verdana, Arial, sans-serif;font-size:14px;line-height:normal;background-color:#EEEEEE;">Dgg</span>'),
(7, 'YSY', 'YSY'),
(8, 'TANG CHU HUANG HE LI YU', 'TANG CHU HUANG HE LI YU'),
(9, 'test', 'DDDDD');

-- --------------------------------------------------------

--
-- Table structure for table `promotion`
--

CREATE TABLE IF NOT EXISTS `promotion` (
  `prom_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `start_time` int(10) unsigned NOT NULL,
  `end_time` int(10) unsigned NOT NULL,
  `dish_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`prom_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `promotion`
--

INSERT INTO `promotion` (`prom_id`, `start_time`, `end_time`, `dish_id`) VALUES
(1, 1419379200, 1419465600, 1),
(2, 1419379200, 1419465600, 2);

-- --------------------------------------------------------

--
-- Table structure for table `promotion_album`
--

CREATE TABLE IF NOT EXISTS `promotion_album` (
  `album_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `prom_id` int(10) unsigned NOT NULL,
  `dish_id` int(10) unsigned DEFAULT NULL,
  `album_path` varchar(50) NOT NULL,
  PRIMARY KEY (`album_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `promotion_album`
--

INSERT INTO `promotion_album` (`album_id`, `prom_id`, `dish_id`, `album_path`) VALUES
(32, 1, 1, '193a3d9a6a4dd1139e0bf043fde36f8e.jpg'),
(33, 2, 2, '9cabb8fd39f1039ece450d6de059af78.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `promotion_cn`
--

CREATE TABLE IF NOT EXISTS `promotion_cn` (
  `prom_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title_cn` varchar(50) NOT NULL,
  `content_cn` mediumtext,
  PRIMARY KEY (`prom_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `promotion_cn`
--

INSERT INTO `promotion_cn` (`prom_id`, `title_cn`, `content_cn`) VALUES
(1, '圣诞节7折优惠', '<h2>\r\n	<span style="color:#FFFFFF;background-color:#E53333;">圣诞节期间，菜品7折优惠！<img src="http://delicious-smallfoots.rhcloud.com/plugins/kindeditor/plugins/emoticons/images/77.gif" border="0" alt="" /><img src="http://delicious-smallfoots.rhcloud.com/plugins/kindeditor/plugins/emoticons/images/111.gif" border="0" alt="" /></span> \r\n</h2>\r\n<p>\r\n	<span style="color:#666666;font-family:Tahoma, Helvetica, arial, sans-serif;font-size:16px;line-height:24px;background-color:#FFFFFF;"><span style="font-size:14px;">节日期间全场7折优惠。最高价值112元的双人套餐，</span><span style="color:#666666;font-family:Tahoma, Helvetica, arial, sans-serif;font-size:14px;line-height:24px;background-color:#FFFFFF;">仅售88元！</span></span> \r\n</p>\r\n<p>\r\n	<span style="color:#666666;font-family:Tahoma, Helvetica, arial, sans-serif;font-size:16px;line-height:24px;background-color:#FFFFFF;"><span style="color:#666666;font-family:Tahoma, Helvetica, arial, sans-serif;font-size:16px;line-height:24px;background-color:#FFFFFF;"><br />\r\n</span></span> \r\n</p>\r\n<p>\r\n	<span style="color:#666666;font-family:Tahoma, Helvetica, arial, sans-serif;font-size:14px;line-height:24px;background-color:#FFFFFF;">提供免费WiFi。</span> \r\n</p>'),
(2, '圣诞节7折优惠', '<h3>\r\n	<span style="color:#333333;font-family:''Trebuchet MS'', Tahoma, Verdana, Arial, sans-serif;font-size:14px;line-height:normal;background-color:#EEEEEE;"><span style="color:#FFFFFF;background-color:#E53333;"><strong> </strong></span><span style="color:#FFFFFF;background-color:#E53333;"><strong>圣诞节期间，菜品7折优惠！<img src="http://delicious-smallfoots.rhcloud.com/plugins/kindeditor/plugins/emoticons/images/77.gif" border="0" alt="" /><img src="http://delicious-smallfoots.rhcloud.com/plugins/kindeditor/plugins/emoticons/images/113.gif" border="0" alt="" /></strong></span></span> \r\n</h3>\r\n<p>\r\n	<span style="color:#333333;font-family:''Trebuchet MS'', Tahoma, Verdana, Arial, sans-serif;font-size:14px;line-height:normal;background-color:#EEEEEE;"><span style="color:#FFFFFF;background-color:#E53333;"><strong><br />\r\n</strong></span></span> \r\n</p>\r\n<p>\r\n	<span style="color:#333333;font-family:''Trebuchet MS'', Tahoma, Verdana, Arial, sans-serif;font-size:14px;line-height:normal;background-color:#EEEEEE;"><span style="color:#FFFFFF;background-color:#E53333;"><strong><img src="/plugins/kindeditor/attached/image/20141213/20141213015127_13899.jpg" alt="" /><br />\r\n</strong></span></span> \r\n</p>');

-- --------------------------------------------------------

--
-- Table structure for table `promotion_en`
--

CREATE TABLE IF NOT EXISTS `promotion_en` (
  `prom_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title_en` varchar(50) NOT NULL,
  `content_en` mediumtext,
  PRIMARY KEY (`prom_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `promotion_en`
--

INSERT INTO `promotion_en` (`prom_id`, `title_en`, `content_en`) VALUES
(1, '30% discount for Christmas', '<span style="color:#333333;font-family:''Trebuchet MS'', Tahoma, Verdana, Arial, sans-serif;font-size:14px;line-height:normal;background-color:#EEEEEE;">During the Christmas season, dishes 30% discount!</span>'),
(2, '30% discount for Christmas', '<span style="color:#333333;font-family:''Trebuchet MS'', Tahoma, Verdana, Arial, sans-serif;font-size:14px;line-height:normal;background-color:#EEEEEE;">During the Christmas season, dishes 30% discount!</span>');

-- --------------------------------------------------------

--
-- Table structure for table `promotion_fr`
--

CREATE TABLE IF NOT EXISTS `promotion_fr` (
  `prom_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title_fr` varchar(50) NOT NULL,
  `content_fr` mediumtext,
  PRIMARY KEY (`prom_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `promotion_fr`
--

INSERT INTO `promotion_fr` (`prom_id`, `title_fr`, `content_fr`) VALUES
(1, '30% de réduction pour Noël', '<span style="color:#333333;font-family:''Trebuchet MS'', Tahoma, Verdana, Arial, sans-serif;font-size:14px;line-height:normal;background-color:#EEEEEE;">Pendant la saison de Noël, plats 30% de réduction!</span>'),
(2, '30% de réduction pour Noël', '<span style="color:#333333;font-family:''Trebuchet MS'', Tahoma, Verdana, Arial, sans-serif;font-size:14px;line-height:normal;background-color:#EEEEEE;">Pendant la saison de Noël, plats 30% de réduction!</span>');

-- --------------------------------------------------------

--
-- Table structure for table `resto_admin`
--

CREATE TABLE IF NOT EXISTS `resto_admin` (
  `admin_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` char(32) NOT NULL,
  `email` varchar(60) NOT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `resto_admin`
--

INSERT INTO `resto_admin` (`admin_id`, `username`, `password`, `email`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@qq.com'),
(2, 'Leo', 'e10adc3949ba59abbe56e057f20f883e', 'leo@qq.com'),
(3, 'Lucas', 'e10adc3949ba59abbe56e057f20f883e', 'Lucas@qq.com'),
(4, 'veron', 'e10adc3949ba59abbe56e057f20f883e', 'veron@qq.com'),
(5, 'Michael', 'e10adc3949ba59abbe56e057f20f883e', 'Michael@qq.com');

-- --------------------------------------------------------

--
-- Table structure for table `slider_album`
--

CREATE TABLE IF NOT EXISTS `slider_album` (
  `slider_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dish_id` int(10) unsigned DEFAULT NULL,
  `album_path` varchar(50) NOT NULL,
  PRIMARY KEY (`slider_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
