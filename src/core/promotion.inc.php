<?php

/**
 * 添加促销
 * @return string
 */
function addPromotion($dish_id){

	$path="./uploads";
	$uploadFiles=uploadFile($path);
	if(is_array($uploadFiles)&&$uploadFiles){
		foreach ($uploadFiles as $key => $uploadFile){
			thumb($path."/".$uploadFile['name'],"../image_50/".$uploadFile['name'],50,50);
			thumb($path."/".$uploadFile['name'],"../image_220/".$uploadFile['name'],220,220);
			thumb($path."/".$uploadFile['name'],"../image_350/".$uploadFile['name'],350,350);
			thumb($path."/".$uploadFile['name'],"../image_800/".$uploadFile['name'],800,800);
		}
	}
	
	$arr_0['start_time']=strtotime($_POST['startDate']);
	$arr_0['end_time']=strtotime($_POST['endDate']);
	$arr_0['dish_id']=$dish_id;	
	$res0=insert("promotion", $arr_0);
	$prom_id=getInsertId();
	if($res0){
		$arr_1['prom_id']=$prom_id;
		$arr_1['title_cn']=addslashes($_POST['cTitle']);
		$arr_1['content_cn']=addslashes($_POST['cContent']);
		$res1=insert("promotion_cn", $arr_1);
		
		$arr_2['prom_id']=$prom_id;
		$arr_2['title_en']=addslashes($_POST['eTitle']);
		$arr_2['content_en']=addslashes($_POST['eContent']);
		$res2=insert("promotion_en", $arr_2);
		
		$arr_3['prom_id']=$prom_id;
		$arr_3['title_fr']=addslashes($_POST['fTitle']);
		$arr_3['content_fr']=addslashes($_POST['fContent']);
		$res3=insert("promotion_fr", $arr_3);	
	}
	if( $res0 && $res1 && $res2 && $res3 ){
		if(is_array($uploadFiles)&&$uploadFiles){
			foreach ($uploadFiles as $uploadFile){
				$arr['prom_id']=$prom_id;
				$arr['dish_id']=$dish_id;
				$arr['album_path']=$uploadFile['name'];
				addPromotionAlbum($arr);
			}
		}
		$mesg="<p>添加成功!</p><a href='addPromotion.php' target='mainFrame'>继续添加</a>|<a href='listPromotion.php' target='mainFrame'>查看促销活动列表</a>";
	}else{
		if(is_array($uploadFiles)&&$uploadFiles){
			foreach ($uploadFiles as $uploadFile){
				if(file_exists("../image_800/".$uploadFile['name'])){
					unlink("../image_800/".$uploadFile['name']);
				}
				if(file_exists("../image_50/".$uploadFile['name'])){
					unlink("../image_50/".$uploadFile['name']);
				}
				if(file_exists("../image_220/".$uploadFile['name'])){
					unlink("../image_220/".$uploadFile['name']);
				}
				if(file_exists("../image_350/".$uploadFile['name'])){
					unlink("../image_350/".$uploadFile['name']);
				}
				if(file_exists("./uploads/".$uploadFile['name'])){
					unlink("./uploads/".$uploadFile['name']);
				}			
			}
		}
		$mesg="<p>添加失败!</p><a href='addPromotion.php' target='mainFrame'>重新添加</a>";
	}

	return $mesg;
}

function editPromotion($id){
	//$arr=$_POST;
	$path="./uploads";
	$uploadFiles=uploadFile($path);
	if(is_array($uploadFiles)&&$uploadFiles){
		foreach ($uploadFiles as $key => $uploadFile){
			thumb($path."/".$uploadFile['name'],"../image_50/".$uploadFile['name'],50,50);
			thumb($path."/".$uploadFile['name'],"../image_220/".$uploadFile['name'],220,220);
			thumb($path."/".$uploadFile['name'],"../image_350/".$uploadFile['name'],350,350);
			thumb($path."/".$uploadFile['name'],"../image_800/".$uploadFile['name'],800,800);
		}
	}

	$arr_0['start_time']=strtotime($_POST['startDate']);
	$arr_0['end_time']=strtotime($_POST['endDate']);
	$where="prom_id={$id}";
	$res0=update("promotion", $arr_0, $where);
	if(!($res0===false)){
		$arr_1['title_cn']=addslashes($_POST['cTitle']);
		$arr_1['content_cn']=addslashes($_POST['cContent']);
		$res1=update("promotion_cn", $arr_1, $where);
	
		$arr_2['title_en']=addslashes($_POST['eTitle']);
		$arr_2['content_en']=addslashes($_POST['eContent']);
		$res2=update("promotion_en", $arr_2, $where);
	
		$arr_3['title_fr']=addslashes($_POST['fTitle']);
		$arr_3['content_fr']=addslashes($_POST['fContent']);
		$res3=update("promotion_fr", $arr_3, $where);
	}
	$promId=$id;
	if( !($res0===false || $res1===false || $res2===false || $res3===false) && $promId ){
		if (is_array ( $uploadFiles ) && $uploadFiles) {
				$promInfo=getPromotionImgById($promId);
			foreach ( $uploadFiles as $uploadFile ) {
				$arr ['prom_id'] = $promId;
				$arr ['dish_id'] = $promInfo['dish_id'];
				$arr ['album_path'] = $uploadFile ['name'];
				addPromotionAlbum ( $arr );
			}
		}
		$mesg="<p>编辑成功!</p><a href='listPromotion.php' target='mainFrame'>查看促销活动列表</a>";
	}else{
		if (is_array ( $uploadFiles ) && $uploadFiles) {
			foreach ( $uploadFiles as $uploadFile ) {
				if (file_exists ( "../image_800/" . $uploadFile ['name'] )) {
					unlink ( "../image_800/" . $uploadFile ['name'] );
				}
				if (file_exists ( "../image_50/" . $uploadFile ['name'] )) {
					unlink ( "../image_50/" . $uploadFile ['name'] );
				}
				if (file_exists ( "../image_220/" . $uploadFile ['name'] )) {
					unlink ( "../image_220/" . $uploadFile ['name'] );
				}
				if (file_exists ( "../image_350/" . $uploadFile ['name'] )) {
					unlink ( "../image_350/" . $uploadFile ['name'] );
				}
				if(file_exists("./uploads/".$uploadFile['name'])){
					unlink("./uploads/".$uploadFile['name']);
				}				
			}
		}
		$mesg="<p>编辑失败!</p><a href='listPromotion.php' target='mainFrame'>重新编辑</a>";
	}

	return $mesg;
}

function delPromotion($id){
	$where="prom_id=$id";
	$res0=delete("promotion",$where);
	$res1=delete("promotion_cn",$where);
	$res2=delete("promotion_en",$where);
	$res3=delete("promotion_fr",$where);
	$promImgs=getAllImgByPromId($id);
	if( $promImgs && is_array($promImgs) ){
		foreach($promImgs as $promImg){
			if(file_exists("uploads/".$promImg['album_path'])){
				unlink("uploads/".$promImg['album_path']);
			}
			if(file_exists("../image_50/".$promImg['album_path'])){
				unlink("../image_50/".$promImg['album_path']);
			}
			if(file_exists("../image_220/".$promImg['album_path'])){
				unlink("../image_220/".$promImg['album_path']);
			}
			if(file_exists("../image_350/".$promImg['album_path'])){
				unlink("../image_350/".$promImg['album_path']);
			}
			if(file_exists("../image_800/".$promImg['album_path'])){
				unlink("../image_800/".$promImg['album_path']);
			}

		}
	}

	$res4=delete("promotion_album",$where);
	if($res0 && $res1 && $res2 && $res3 && $res4){
		$mes="删除成功!<br/><a href='listPromotion.php' target='mainFrame'>查看促销活动列表</a>";
	}else{
		$mes="删除失败!<br/><a href='listPromotion.php' target='mainFrame'>重新删除</a>";
	}

	return $mes;
}

function getAllImgByPromId($id){
	$sql="select a.album_id, a.prom_id, a.dish_id, a.album_path from promotion_album a where prom_id={$id}";
	$rows=fetchAll($sql);
	return $rows;
}

function getPromotionById($id){
	$sql="select p.prom_id,pc.title_cn,pe.title_en,pf.title_fr,p.start_time,p.end_time,pc.content_cn,pe.content_en,pf.content_fr,p.dish_id from promotion as p, promotion_cn as pc, promotion_en as pe, promotion_fr as pf where p.prom_id={$id} and p.prom_id=pc.prom_id and pc.prom_id=pe.prom_id and pe.prom_id=pf.prom_id";
	$row=fetchOne($sql);
	return $row;
}







