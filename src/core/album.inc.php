<?php

function addAlbum($arr){
	return insert("album",$arr);
}

/**
 * 根据商品id得到商品图片
 * @param int $id
 * @return array
 */
function getDishImgById($id){
	$sql="select a.album_path from album a where dish_id={$id} limit 1";	
	$row=fetchOne($sql);
	return $row;
}

/**
 * 根据商品ID得到所有图片
 * @param int $id
 * @return array:
 */
function getDishImgsById($id){
	$sql="select a.album_path from album a where dish_id={$id}";
	$rows=fetchAll($sql);
	return $rows;
}

/**
 * 根据"图片ID"得到图片信息
 * @param int $id
 * @return array:
 */
function getDishImgsByImagId($id){
	$sql="select a.dish_id, a.album_path from album a where id={$id}";
	$row=fetchOne($sql);
	return $row;
}

/**
 * 文字水印的效果
 * @param int $id
 * @return string
 */
function doWaterText($id){
	$rows=getDishImgsById($id);
	foreach($rows as $row){
		$filename="../image_800/".$row['album_path'];
		waterText($filename);
	}
	$mesg="操作成功!<br/><a href='listDishImages.php'>返回菜品图片列表</a>";
	return $mesg;
}

/**
 * 图片水印的效果
 * @param int $id
 * @return string
 */
function doWaterPic($id){
	$rows=getDishImgsById($id);
	foreach($rows as $row){
		$filename="../image_800/".$row['album_path'];
		waterPic($filename);
	}
	$mesg="操作成功!<br/><a href='listDishImages.php'>返回菜品图片列表</a>";
	return $mesg;
}

function addSliderAlbum($arr){
	return insert("slider_album",$arr);
}

function getSliderImgByImagId($id){
	$sql="select slider_id, dish_id, album_path from slider_album where slider_id={$id}";
	$row=fetchOne($sql);
	return $row;
}

function addPromotionAlbum($arr){
	return insert("promotion_album",$arr);
}

function getPromotionImgById($id){
	$sql="select a.album_id, a.prom_id, a.dish_id, a.album_path from promotion_album a where prom_id={$id} limit 1";
	$row=fetchOne($sql);
	return $row;
}

function getPromImgsByImagId($id){
	$sql="select album_id, prom_id, dish_id, album_path from promotion_album where album_id={$id}";
	$row=fetchOne($sql);
	return $row;
}


