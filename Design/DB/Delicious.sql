CREATE DATABASE IF NOT EXISTS delicious default character set utf8;
USE delicious;

/*drop tables*/
DROP TABLE IF EXISTS resto_admin;
DROP TABLE IF EXISTS cate_cn;
DROP TABLE IF EXISTS cate_en;
DROP TABLE IF EXISTS cate_fr;
DROP TABLE IF EXISTS dish;
DROP TABLE IF EXISTS dish_cn;
DROP TABLE IF EXISTS dish_en;
DROP TABLE IF EXISTS dish_fr;
DROP TABLE IF EXISTS album;

/*admin*/
CREATE TABLE resto_admin ( 
 admin_id tinyint unsigned auto_increment key,
 username varchar(30) not null unique,
 password char(32) not null,
 email varchar(60) not null
);

/*category-CHINESE*/
CREATE TABLE cate_cn (
 cate_id smallint unsigned auto_increment key,
 cate_name varchar(50) not null unique 
);

/*category-ENGLISH*/
CREATE TABLE cate_en (
 cate_id smallint unsigned auto_increment key,
 cate_name varchar(50) not null unique 
);

/*category-FRENCH*/
CREATE TABLE cate_fr (
 cate_id smallint unsigned auto_increment key,
 cate_name varchar(50) not null unique 
);

/*dish*/
CREATE TABLE dish (
 dish_id int unsigned auto_increment key, 
 cate_id smallint unsigned not null,
 dish_no varchar(50) not null,
 dish_num int unsigned default 0,
 reg_price decimal(6,2) not null,
 current_price decimal(6,2) not null,
 dish_time int unsigned not null,
 is_show tinyint(1) default 1,
 is_hot tinyint(1) default 0
);

/*dish-CHINESE*/
CREATE TABLE dish_cn (
 dish_id int unsigned auto_increment key, 
 dish_name varchar(50) not null unique,
 dish_desc mediumtext
 );
 
/*dish-ENGLISH*/
CREATE TABLE dish_en (
 dish_id int unsigned auto_increment key, 
 dish_name varchar(50) not null unique,
 dish_desc mediumtext
 );
 
/*dish-FRENCH*/
CREATE TABLE dish_fr (
 dish_id int unsigned auto_increment key, 
 dish_name varchar(50) not null unique,
 dish_desc mediumtext
 );
 
/*-- user
DROP TABLE IF EXISTS imooc_user;
CREATE TABLE imooc_user (    
 id int unsigned auto_increment key,
 username varchar(20) not null unique,
 password char(32) not null,
 sex enum("Male","Female") not null default "Male",
 face varchar(255) not null,
 regtime int unsigned not null

);*/


/*album*/
CREATE TABLE album (
 id int unsigned auto_increment key,
 dish_id int unsigned not null,
 album_path varchar(50) not null
);

/*insert resto_admin (username,password, email) values('admin','21232f297a57a5a743894a0e4a801fc3','admin@qq.com');*/

commit;