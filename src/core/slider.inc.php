<?php
function getSliderInfo(){
	$sql="select slider_id,dish_id,album_path from slider_album order by slider_id";
	$rows=fetchAll($sql);
	return $rows;
}

function addSlider(){

	$path="./uploads";
	$uploadFiles=uploadFile($path);
	if( is_array($uploadFiles) && $uploadFiles ){
		$uploadFile = $uploadFiles[0];
		thumb($path."/".$uploadFile['name'],"../image_50/".$uploadFile['name'],50,50);
		thumb($path."/".$uploadFile['name'],"../image_220/".$uploadFile['name'],220,220);
		thumb($path."/".$uploadFile['name'],"../image_350/".$uploadFile['name'],350,350);
		thumb($path."/".$uploadFile['name'],"../image_800/".$uploadFile['name'],800,800);

		$arr['album_path']=$uploadFile['name'];
		addSliderAlbum($arr);

		$mesg="<p>幻灯图片上传成功!</p><a href='listSliderImgs.php' target='mainFrame'>查看幻灯图片列表</a>";
	}else{
		$mesg="<p>无幻灯图片上传!</p><a href='listSliderImgs.php' target='mainFrame'>查看幻灯图片列表</a>";
	}

	return $mesg;
}

function delSliderById($id){

	$sliderImg=getSliderImgByImagId($id);
	
	$where="slider_id={$id}";
	$res=delete("slider_album",$where);
	if(res){
		if(file_exists("../image_800/".$sliderImg['album_path'])){
			unlink("../image_800/".$sliderImg['album_path']);
		}
		if(file_exists("../image_50/".$sliderImg['album_path'])){
			unlink("../image_50/".$sliderImg['album_path']);
		}
		if(file_exists("../image_220/".$sliderImg['album_path'])){
			unlink("../image_220/".$sliderImg['album_path']);
		}
		if(file_exists("../image_350/".$sliderImg['album_path'])){
			unlink("../image_350/".$sliderImg['album_path']);
		}
		if(file_exists("./uploads/".$sliderImg['album_path'])){
			unlink("./uploads/".$sliderImg['album_path']);
		}
		$mes="删除成功!<br/><a href='listSliderImgs.php' target='mainFrame'>查看幻灯图片列表</a>";
	}else{
		$mes="删除失败!<br/><a href='listSliderImgs.php' target='mainFrame'>重新删除</a>";
	}
	
	return $mes;		
}


