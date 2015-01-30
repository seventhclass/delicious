<?php
require_once '../include.php';

class menupageClass {
	public $pageSize;
	public $totalRows;
	public $totalPage;
	public $pageLink;
	public $dishinfo=array();

	public function setPageSize($pageSize){
		$this->pageSize=$pageSize;
	}
	
	public function setTotalRows($totalRows){
		$this->totalRows=$totalRows;
	}
		
	public function setTotalPage($totalPage){
		$this->totalPage=$totalPage;
	}

	public function setPageLink($pageLink){
		$this->pageLink=$pageLink;
	}
		
	public function setDishInfo($array){
		$this->dishinfo=$array;
	}
	
	public function getPageSize(){
		return $this->pageSize;
	}
	
	public function getTotalRows(){
		return $this->totalRows;
	}
		
	public function getTotalPage(){
		return $this->totalPage;
	}

	public function getPageLink(){
		return $this->pageLink;
	}
		
	public function getDishInfo(){
		return $this->dishinfo;
	}
}

$page = $_REQUEST ['page'] ? ( int ) $_REQUEST ['page'] : 1;
$cateid = $_REQUEST ['cateid'];
$where_cateid = $_REQUEST ['cateid'] ? "and d.cate_id=".$_REQUEST ['cateid']." " : null;

$pageSize=18;

$sql="select d.dish_id,dc.dish_name as 'dish_name_cn',de.dish_name as 'dish_name_en',df.dish_name as 'dish_name_fr',d.dish_no,d.dish_num,d.reg_price,d.current_price,d.dish_time,d.is_show,d.is_hot,d.is_spicy,cc.cate_name as 'cate_name_cn', ce.cate_name as 'cate_name_en',cf.cate_name as 'cate_name_fr', dc.dish_desc as 'dish_desc_cn',de.dish_desc as 'dish_desc_en',df.dish_desc as 'dish_desc_fr' from dish as d, dish_cn as dc, dish_en as de, dish_fr as df, cate_cn as cc, cate_en as ce, cate_fr as cf where d.dish_id=dc.dish_id and dc.dish_id=de.dish_id and de.dish_id=df.dish_id and d.cate_id=cc.cate_id and d.cate_id=ce.cate_id and d.cate_id=cf.cate_id {$where_cateid}";
$totalRows=getResultNum($sql);	

if($totalRows>0){
	$totalPage=ceil($totalRows/$pageSize);
	if ($page < 1 || $page == null || ! is_numeric ( $page )) {
		$page = 1;
	}
	if ($page >= $totalPage)
		$page = $totalPage;
	
	$offset=($page-1)*$pageSize;
	
	$sql="select d.dish_id,dc.dish_name as 'dish_name_cn',de.dish_name as 'dish_name_en',df.dish_name as 'dish_name_fr',d.dish_no,d.dish_num,d.reg_price,d.current_price,d.dish_time,d.is_show,d.is_hot,d.is_spicy,cc.cate_name as 'cate_name_cn', ce.cate_name as 'cate_name_en',cf.cate_name as 'cate_name_fr', dc.dish_desc as 'dish_desc_cn',de.dish_desc as 'dish_desc_en',df.dish_desc as 'dish_desc_fr' from dish as d, dish_cn as dc, dish_en as de, dish_fr as df, cate_cn as cc, cate_en as ce, cate_fr as cf where d.dish_id=dc.dish_id and dc.dish_id=de.dish_id and de.dish_id=df.dish_id and d.cate_id=cc.cate_id and d.cate_id=ce.cate_id and d.cate_id=cf.cate_id {$where_cateid} limit {$offset},{$pageSize}";
	$rows=fetchAll($sql);
	
	if($rows){
		for($i=0; $i<count($rows); $i++){
			$dishImg = getFirstImgByDishId ( $rows[$i]['dish_id'] );
			$rows[$i]['album_path']=$dishImg['album_path'];
		}
		
		if($cateid){
			$pageLink = showPage3 ( $page, $totalPage, $cateid );
		}else{
			$pageLink = showPage3 ( $page, $totalPage );
		}	
			
		$menuObj=new menupageClass();
		$menuObj->setPageSize($pageSize);
		$menuObj->setTotalRows($totalRows);
		$menuObj->setTotalPage($totalPage);
		$menuObj->setPageLink($pageLink);
		$menuObj->setDishInfo($rows);
		
		echo json_encode($menuObj);	
	}
}else{
	$menuObj=new menupageClass();
	echo json_encode($menuObj);
}












