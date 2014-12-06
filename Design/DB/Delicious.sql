CREATE DATABASE IF NOT EXISTS delicious default character set utf8;
USE delicious;

/*drop tables*/
DROP TABLE IF EXISTS resto_admin;
DROP TABLE IF EXISTS cate;
DROP TABLE IF EXISTS dish;
DROP TABLE IF EXISTS album;
DROP TABLE IF EXISTS promotion;
DROP TABLE IF EXISTS slider;

/*admin*/
CREATE TABLE resto_admin ( 
 admin_id tinyint unsigned auto_increment key,
 username varchar(30) not null unique,
 password char(32) not null,
 email varchar(60) not null
);

/*category*/
CREATE TABLE cate (
 cate_id smallint unsigned auto_increment key,
 name_cn varchar(50) unique, 
 name_en varchar(50) unique,
 name_fr varchar(50) unique 
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
 name_cn varchar(50) unique,
 name_en varchar(50) unique,
 name_fr varchar(50) unique,
 desc_cn mediumtext,
 desc_en mediumtext,
 desc_fr mediumtext
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
 album_id int unsigned auto_increment key,
 dish_id int unsigned not null,
 album_path varchar(50) not null
);

/*promotion*/
CREATE TABLE promotion (
 prom_id int unsigned auto_increment key,
 start_time int unsigned,
 end_time int unsigned not null,
 title_cn varchar(50),
 title_en varchar(50),
 title_fr varchar(50),
 content_cn mediumtext,
 content_en mediumtext,
 content_fr mediumtext,
 dish_id int unsigned,
 img_path varchar(50)
);

/*slider*/
CREATE TABLE slider (
 slide_id int unsigned auto_increment key,
 dish_id int unsigned not null,
 img_path varchar(50) not null
);
/*insert resto_admin (username,password, email) values('admin','21232f297a57a5a743894a0e4a801fc3','admin@qq.com');*/

commit;