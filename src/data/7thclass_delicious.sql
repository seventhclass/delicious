CREATE DATABASE IF NOT EXISTS delicious default character set utf8;
USE delicious;

/*
Navicat MySQL Data Transfer

Source Server         : mysql(xampp)
Source Server Version : 50620
Source Host           : localhost:3306
Source Database       : 7thclass_delicious

Target Server Type    : MYSQL
Target Server Version : 50620
File Encoding         : 65001

Date: 2014-12-06 22:14:05
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `album`
-- ----------------------------
DROP TABLE IF EXISTS `album`;
CREATE TABLE `album` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dish_id` int(10) unsigned NOT NULL,
  `album_path` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of album
-- ----------------------------
INSERT INTO `album` VALUES ('7', '5', 'e5eaf62bc4c93d71c8f93cfbe8f731ce.jpg');
INSERT INTO `album` VALUES ('8', '5', '8447083b2bf6553079319af88987f27f.jpg');
INSERT INTO `album` VALUES ('10', '1', '90611705dcf1a6c6d1faceab9e777c29.jpg');
INSERT INTO `album` VALUES ('11', '2', 'e5119e6b7816f8bf8ab39ce406286212.jpg');
INSERT INTO `album` VALUES ('17', '2', '32a403e3740510f3538e5de0a4d51f9a.png');
INSERT INTO `album` VALUES ('18', '2', '004afe50326ee32425d8904b7f7e8a0f.png');
INSERT INTO `album` VALUES ('19', '1', 'd836add1503aa34f8a276f04f795098c.jpg');

-- ----------------------------
-- Table structure for `cate_cn`
-- ----------------------------
DROP TABLE IF EXISTS `cate_cn`;
CREATE TABLE `cate_cn` (
  `cate_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`cate_id`),
  UNIQUE KEY `cate_name` (`cate_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cate_cn
-- ----------------------------
INSERT INTO `cate_cn` VALUES ('1', '中餐');
INSERT INTO `cate_cn` VALUES ('2', '广东美食');
INSERT INTO `cate_cn` VALUES ('5', '测试');

-- ----------------------------
-- Table structure for `cate_en`
-- ----------------------------
DROP TABLE IF EXISTS `cate_en`;
CREATE TABLE `cate_en` (
  `cate_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`cate_id`),
  UNIQUE KEY `cate_name` (`cate_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cate_en
-- ----------------------------
INSERT INTO `cate_en` VALUES ('1', 'Chinese Cuisine');
INSERT INTO `cate_en` VALUES ('2', 'GuangDong Cuisine');
INSERT INTO `cate_en` VALUES ('5', 'test');

-- ----------------------------
-- Table structure for `cate_fr`
-- ----------------------------
DROP TABLE IF EXISTS `cate_fr`;
CREATE TABLE `cate_fr` (
  `cate_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`cate_id`),
  UNIQUE KEY `cate_name` (`cate_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cate_fr
-- ----------------------------
INSERT INTO `cate_fr` VALUES ('2', 'La Cuisine de GuangDong');
INSERT INTO `cate_fr` VALUES ('1', 'La Cuisine Francais');
INSERT INTO `cate_fr` VALUES ('5', 'test');

-- ----------------------------
-- Table structure for `dish`
-- ----------------------------
DROP TABLE IF EXISTS `dish`;
CREATE TABLE `dish` (
  `dish_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cate_id` smallint(5) unsigned NOT NULL,
  `dish_no` varchar(50) NOT NULL,
  `dish_num` int(10) unsigned DEFAULT '0',
  `reg_price` decimal(6,2) NOT NULL,
  `current_price` decimal(6,2) NOT NULL,
  `dish_time` int(10) unsigned NOT NULL,
  `is_show` tinyint(1) DEFAULT '1',
  `is_hot` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`dish_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dish
-- ----------------------------
INSERT INTO `dish` VALUES ('1', '1', '123456', '500', '12.00', '10.00', '0', '1', '0');
INSERT INTO `dish` VALUES ('2', '1', '10002', '120', '16.00', '13.00', '1417493231', '0', '1');
INSERT INTO `dish` VALUES ('5', '2', '1123334', '100', '21.00', '17.00', '1417569208', '1', '0');

-- ----------------------------
-- Table structure for `dish_cn`
-- ----------------------------
DROP TABLE IF EXISTS `dish_cn`;
CREATE TABLE `dish_cn` (
  `dish_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dish_name` varchar(50) NOT NULL,
  `dish_desc` mediumtext,
  PRIMARY KEY (`dish_id`),
  UNIQUE KEY `dish_name` (`dish_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dish_cn
-- ----------------------------
INSERT INTO `dish_cn` VALUES ('1', '鱼香肉丝', '鱼香肉丝好吃啊，非常好吃，太好吃了，好吃的不行了。');
INSERT INTO `dish_cn` VALUES ('2', '水煮鱼123', '<p>\r\n	<span style=\"color:#337FE5;font-size:18px;font-family:NSimSun;\">水煮鱼123</span> \r\n</p>\r\n<p>\r\n	<span><span style=\"font-size:14px;line-height:27px;font-family:NSimSun;color:#9933E5;\">我爱水煮鱼！<span style=\"color:#9933E5;font-family:NSimSun;font-size:14px;line-height:27px;\">我爱水煮鱼！</span><span style=\"color:#9933E5;font-family:NSimSun;font-size:14px;line-height:27px;\">我爱水煮鱼！</span><span style=\"color:#9933E5;font-family:NSimSun;font-size:14px;line-height:27px;\">我爱水煮鱼！</span><span style=\"color:#9933E5;font-family:NSimSun;font-size:14px;line-height:27px;\">我爱水煮鱼！</span><span style=\"color:#9933E5;font-family:NSimSun;font-size:14px;line-height:27px;\">我爱水煮鱼！</span><span style=\"color:#9933E5;font-family:NSimSun;font-size:14px;line-height:27px;\">我爱水煮鱼！</span><span style=\"color:#9933E5;font-family:NSimSun;font-size:14px;line-height:27px;\">我爱水煮鱼！</span><span style=\"color:#9933E5;font-family:NSimSun;font-size:14px;line-height:27px;\">我爱水煮鱼！</span><span style=\"color:#9933E5;font-family:NSimSun;font-size:14px;line-height:27px;\">我爱水煮鱼！</span><span style=\"color:#9933E5;font-family:NSimSun;font-size:14px;line-height:27px;\">我爱水煮鱼！</span>我爱水煮鱼！我爱水煮鱼！<span style=\"color:#9933E5;font-family:NSimSun;font-size:14px;line-height:27px;\">我爱水煮鱼！</span>我爱水煮鱼！我爱水煮鱼！<span style=\"color:#9933E5;font-family:NSimSun;font-size:14px;line-height:27px;\">我爱水煮鱼！</span>我爱水煮鱼！我爱水煮鱼！<span style=\"color:#9933E5;font-family:NSimSun;font-size:14px;line-height:27px;\">我爱水煮鱼！</span>我爱水煮鱼！我爱水煮鱼！我爱水煮鱼！<span style=\"color:#9933E5;font-family:NSimSun;font-size:14px;line-height:27px;\">我爱水煮鱼！</span>我爱水煮鱼！我爱水煮鱼！我爱水煮鱼！<span style=\"color:#9933E5;font-family:NSimSun;font-size:14px;line-height:27px;\">我爱水煮鱼！</span>我爱水煮鱼！我爱水煮鱼！我爱水煮鱼！<span style=\"color:#9933E5;font-family:NSimSun;font-size:14px;line-height:27px;\">我爱水煮鱼！</span>我爱水煮鱼！我爱水煮鱼！我爱水煮鱼！我爱水煮鱼！<span style=\"color:#9933E5;font-family:NSimSun;font-size:14px;line-height:27px;\">我爱水煮鱼！</span>我爱水煮鱼！我爱水煮鱼！我爱水煮鱼！<span style=\"color:#9933E5;font-family:NSimSun;font-size:14px;line-height:27px;\">我爱水煮鱼！</span>我爱水煮鱼！我爱水煮鱼！<span style=\"color:#9933E5;font-family:NSimSun;font-size:14px;line-height:27px;\">我爱水煮鱼！</span>我爱水煮鱼！我爱水煮鱼！<span style=\"color:#9933E5;font-family:NSimSun;font-size:14px;line-height:27px;\">我爱水煮鱼！</span>我爱水煮鱼！我爱水煮鱼！我爱水煮鱼！<span style=\"color:#9933E5;font-family:NSimSun;font-size:14px;line-height:27px;\">我爱水煮鱼！</span>我爱水煮鱼！我爱水煮鱼！<span style=\"color:#9933E5;font-family:NSimSun;font-size:14px;line-height:27px;\">我爱水煮鱼！</span><img src=\"/delicious/plugins/kindeditor/attached/image/20141202/20141202050449_79760.png\" alt=\"\" /></span></span> \r\n</p>');
INSERT INTO `dish_cn` VALUES ('5', '测试123', '2343dfhd');

-- ----------------------------
-- Table structure for `dish_en`
-- ----------------------------
DROP TABLE IF EXISTS `dish_en`;
CREATE TABLE `dish_en` (
  `dish_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dish_name` varchar(50) NOT NULL,
  `dish_desc` mediumtext,
  PRIMARY KEY (`dish_id`),
  UNIQUE KEY `dish_name` (`dish_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dish_en
-- ----------------------------
INSERT INTO `dish_en` VALUES ('1', 'yuxiangroushi', 'yuxiangroushi hao chi a ,hao chi ,fei chang hao chi ,hao chi de bu xing le.');
INSERT INTO `dish_en` VALUES ('2', 'ShuiZhu Fish123', '<p>\r\n	<span style=\"color:#337FE5;font-size:18px;\">Shuizhu Fish123</span> \r\n</p>\r\n<p>\r\n	<span>I love shuizhu fish!</span><span>I love shuizhu fish!</span><span>I love shuizhu fish!</span><span>I love shuizhu fish!</span>I love shuizhu fish!I love shuizhu fish!<span>I love shuizhu fish!</span>I love shuizhu fish!<span>I love shuizhu fish!</span>I love shuizhu fish!<span>I love shuizhu fish!</span>I love shuizhu fish!<span>I love shuizhu fish!</span><span>I love shuizhu fish!</span>I love shuizhu fish!I love shuizhu fish!<span>I love shuizhu fish!</span>I love shuizhu fish!I love shuizhu fish!<span>I love shuizhu fish!</span>I love shuizhu fish!I love shuizhu fish!<span>I love shuizhu fish!</span>I love shuizhu fish!I love shuizhu fish!I love shuizhu fish!I love shuizhu fish!<span>I love shuizhu fish!</span>I love shuizhu fish!I love shuizhu fish!I love shuizhu fish!I love shuizhu fish!<span>I love shuizhu fish!</span>I love shuizhu fish!I love shuizhu fish!I love shuizhu fish!I love shuizhu fish!I love shuizhu fish!I love shuizhu fish!I love shuizhu fish!I love shuizhu fish!I love shuizhu fish!I love shuizhu fish!I love shuizhu fish!I love shuizhu fish!I love shuizhu fish!I love shuizhu fish!<span>I love shuizhu fish!</span>I love shuizhu fish!I love shuizhu fish!I love shuizhu fish!I love shuizhu fish!I love shuizhu fish!I love shuizhu fish!I love shuizhu fish!I love shuizhu fish!I love shuizhu fish!<span>I love shuizhu fish!</span>I love shuizhu fish!I love shuizhu fish!<span>I love shuizhu fish!</span>I love shuizhu fish!I love shuizhu fish!I love shuizhu fish!<span>I love shuizhu fish!</span> \r\n</p>');
INSERT INTO `dish_en` VALUES ('5', 'test123', 'dfgdfgd');

-- ----------------------------
-- Table structure for `dish_fr`
-- ----------------------------
DROP TABLE IF EXISTS `dish_fr`;
CREATE TABLE `dish_fr` (
  `dish_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dish_name` varchar(50) NOT NULL,
  `dish_desc` mediumtext,
  PRIMARY KEY (`dish_id`),
  UNIQUE KEY `dish_name` (`dish_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dish_fr
-- ----------------------------
INSERT INTO `dish_fr` VALUES ('1', 'francais ', 'francais francis');
INSERT INTO `dish_fr` VALUES ('2', 'ShuiZhu Poisson123', '<p>\r\n	<span style=\"color:#337FE5;font-size:24px;\">Shuizhu&nbsp;poisson123</span> \r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<span>Shuizhu </span><span>poisson</span>!<span>Shuizhu </span><span>poisson</span><span>!</span><span>Shuizhu </span><span>poisson</span><span>!</span><span>Shuizhu </span><span>poisson</span><span>!</span>Shuizhu&nbsp;poisson!<span>Shuizhu </span><span>poisson</span><span>!</span>Shuizhu&nbsp;poisson!<span>Shuizhu </span><span>poisson</span><span>!</span>Shuizhu&nbsp;poisson!Shuizhu&nbsp;poisson!Shuizhu&nbsp;poisson!<span>Shuizhu </span><span>poisson</span><span>!</span>Shuizhu&nbsp;poisson!Shuizhu&nbsp;poisson!Shuizhu&nbsp;poisson!<span>Shuizhu </span><span>poisson</span><span>!</span>Shuizhu&nbsp;poisson!Shuizhu&nbsp;poisson!<span>Shuizhu </span><span>poisson</span><span>!</span>Shuizhu&nbsp;poisson!Shuizhu&nbsp;poisson!Shuizhu&nbsp;poisson!Shuizhu&nbsp;poisson!Shuizhu&nbsp;poisson!<span>Shuizhu </span><span>poisson</span><span>!</span>Shuizhu&nbsp;poisson!Shuizhu&nbsp;poisson!Shuizhu&nbsp;poisson!Shuizhu&nbsp;poisson!Shuizhu&nbsp;poisson!Shuizhu&nbsp;poisson!Shuizhu&nbsp;poisson!Shuizhu&nbsp;poisson!Shuizhu&nbsp;poisson!Shuizhu&nbsp;poisson!Shuizhu&nbsp;poisson!Shuizhu&nbsp;poisson!Shuizhu&nbsp;poisson!Shuizhu&nbsp;poisson!Shuizhu&nbsp;poisson!Shuizhu&nbsp;poisson!Shuizhu&nbsp;poisson!<span>Shuizhu </span><span>poisson</span><span>!</span>Shuizhu&nbsp;poisson!Shuizhu&nbsp;poisson!Shuizhu&nbsp;poisson!Shuizhu&nbsp;poisson!Shuizhu&nbsp;poisson!Shuizhu&nbsp;poisson!Shuizhu&nbsp;poisson!Shuizhu&nbsp;poisson!Shuizhu&nbsp;poisson!Shuizhu&nbsp;poisson!Shuizhu&nbsp;poisson!Shuizhu&nbsp;poisson!Shuizhu&nbsp;poisson!\r\n</p>');
INSERT INTO `dish_fr` VALUES ('5', 'test123', 'dfgdcgfd');

-- ----------------------------
-- Table structure for `resto_admin`
-- ----------------------------
DROP TABLE IF EXISTS `resto_admin`;
CREATE TABLE `resto_admin` (
  `admin_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` char(32) NOT NULL,
  `email` varchar(60) NOT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of resto_admin
-- ----------------------------
INSERT INTO `resto_admin` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@qq.com');
INSERT INTO `resto_admin` VALUES ('2', 'Leo', 'e10adc3949ba59abbe56e057f20f883e', 'leo@qq.com');
INSERT INTO `resto_admin` VALUES ('3', 'Lucas', 'e10adc3949ba59abbe56e057f20f883e', 'Lucas@qq.com');
INSERT INTO `resto_admin` VALUES ('4', 'veron', 'e10adc3949ba59abbe56e057f20f883e', 'veron@qq.com');
INSERT INTO `resto_admin` VALUES ('5', 'Michael', 'e10adc3949ba59abbe56e057f20f883e', 'Michael@qq.com');
