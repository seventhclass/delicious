/*
Navicat MySQL Data Transfer

Source Server         : mysql(xampp)
Source Server Version : 50620
Source Host           : localhost:3306
Source Database       : 7thclass_delicious

Target Server Type    : MYSQL
Target Server Version : 50620
File Encoding         : 65001

Date: 2014-12-09 12:08:53
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

-- ----------------------------
-- Table structure for `promotion`
-- ----------------------------
DROP TABLE IF EXISTS `promotion`;
CREATE TABLE `promotion` (
  `prom_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `start_time` int(10) unsigned NOT NULL,
  `end_time` int(10) unsigned NOT NULL,
  `dish_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`prom_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of promotion
-- ----------------------------

-- ----------------------------
-- Table structure for `promotion_album`
-- ----------------------------
DROP TABLE IF EXISTS `promotion_album`;
CREATE TABLE `promotion_album` (
  `album_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `prom_id` int(10) unsigned NOT NULL,
  `dish_id` int(10) unsigned DEFAULT NULL,
  `album_path` varchar(50) NOT NULL,
  PRIMARY KEY (`album_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of promotion_album
-- ----------------------------

-- ----------------------------
-- Table structure for `promotion_cn`
-- ----------------------------
DROP TABLE IF EXISTS `promotion_cn`;
CREATE TABLE `promotion_cn` (
  `prom_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title_cn` varchar(50) NOT NULL,
  `content_cn` mediumtext,
  PRIMARY KEY (`prom_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of promotion_cn
-- ----------------------------

-- ----------------------------
-- Table structure for `promotion_en`
-- ----------------------------
DROP TABLE IF EXISTS `promotion_en`;
CREATE TABLE `promotion_en` (
  `prom_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title_en` varchar(50) NOT NULL,
  `content_en` mediumtext,
  PRIMARY KEY (`prom_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of promotion_en
-- ----------------------------

-- ----------------------------
-- Table structure for `promotion_fr`
-- ----------------------------
DROP TABLE IF EXISTS `promotion_fr`;
CREATE TABLE `promotion_fr` (
  `prom_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title_fr` varchar(50) NOT NULL,
  `content_fr` mediumtext,
  PRIMARY KEY (`prom_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of promotion_fr
-- ----------------------------

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

-- ----------------------------
-- Table structure for `slider_album`
-- ----------------------------
DROP TABLE IF EXISTS `slider_album`;
CREATE TABLE `slider_album` (
  `slider_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dish_id` int(10) unsigned DEFAULT NULL,
  `album_path` varchar(50) NOT NULL,
  PRIMARY KEY (`slider_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of slider_album
-- ----------------------------
