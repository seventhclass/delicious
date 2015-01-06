<?php 

require_once '../include.php';

class detailpageClass {
	public $dishinfo=array();
	public $dishimages=array();
	public $cateinfo=array();

	public function setDishInfo($array){
		$this->dishinfo=$array;
	}

	public function getDishInfo(){
		return $this->dishinfo;
	}
	
	public function setDishImages($array){
		$this->dishimages=$array;
	}
	
	public function getDishImages(){
		return $this->dishimages;
	}	
	
	public function setCateInfo($array){
		$this->cateinfo=$array;
	}
	
	public function getCateInfo(){
		return $this->cateinfo;
	}	
}

$id=$_REQUEST['dish_id'];

if($id){
	//Get dish information by dish id
	$dish_info = getDishById($id);
	//var_dump($dish_info);	
		
	//Get all dish images by dish id
	$dish_images = getAllImgByDishId($id);	
	//var_dump($dish_images);
		
	if($dish_info){
		//Get category information by category id
		$cate_info = getCateById($dish_info['cate_id']);
	}
	
	$detailObj=new detailpageClass();
	$detailObj->setDishInfo($dish_info);
	$detailObj->setDishImages($dish_images);
	$detailObj->setCateInfo($cate_info);
	
	echo json_encode($detailObj);	
}
else {
	$detailObj=new detailpageClass();
	echo json_encode($detailObj);
}






