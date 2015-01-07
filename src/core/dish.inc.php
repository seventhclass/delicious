<?php

/**
 * 添加菜品
 * @return string
 */
function addDish(){

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
	$arr_0['cate_id']=$_POST['cId'];
	$arr_0['dish_no']=$_POST['dNo'];
	$arr_0['dish_num']=$_POST['dNum'];
	$arr_0['reg_price']=$_POST['rPrice'];
	$arr_0['current_price']=$_POST['cPrice'];
	$arr_0['dish_time']=time();
	$arr_0['is_spicy']=$_POST['cSpicy'];
	$res0=insert("dish", $arr_0);
	$dish_id=getInsertId();
	
	$arr_1['dish_id']=$dish_id;
	$arr_1['dish_name']=addslashes($_POST['cName']);
	$arr_1['dish_desc']=addslashes($_POST['cDesc']);
	$res1=insert("dish_cn", $arr_1);
	
	$arr_2['dish_id']=$dish_id;
	$arr_2['dish_name']=addslashes($_POST['eName']);
	$arr_2['dish_desc']=addslashes($_POST['eDesc']);	
	$res2=insert("dish_en", $arr_2);
	
	$arr_3['dish_id']=$dish_id;
	$arr_3['dish_name']=addslashes($_POST['fName']);
	$arr_3['dish_desc']=addslashes($_POST['fDesc']);	
	$res3=insert("dish_fr", $arr_3);

	if( $res0 && $res1 && $res2 && $res3 && $dish_id ){
		if(is_array($uploadFiles)&&$uploadFiles){
			foreach ($uploadFiles as $uploadFile){
				$arr['dish_id']=$dish_id;
				$arr['album_path']=$uploadFile['name'];
				addAlbum($arr);
			}
		}
		$mesg="<p>添加成功!</p><a href='addDish.php' target='mainFrame'>继续添加</a>|<a href='listDish.php' target='mainFrame'>查看菜品列表</a>";
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
		$mesg="<p>添加失败!</p><a href='addDish.php' target='mainFrame'>重新添加</a>";
	}
	
	return $mesg;
}


/**
 * 编辑菜品
 * @param int $id
 * @return string
 */
function editDish($id){
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
	
	$arr_0['cate_id']=$_POST['cId'];
	$arr_0['dish_no']=$_POST['dNo'];
	$arr_0['dish_num']=$_POST['dNum'];
	$arr_0['reg_price']=$_POST['rPrice'];
	$arr_0['current_price']=$_POST['cPrice'];
	$arr_0['is_show']=$_POST['isShow'];
	$arr_0['is_hot']=$_POST['isHot'];
	$arr_0['is_spicy']=$_POST['cSpicy'];
	$where="dish_id={$id}";
	$res0=update("dish", $arr_0, $where);

	$arr_1['dish_name']=addslashes($_POST['cName']);
	$arr_1['dish_desc']=addslashes($_POST['cDesc']);
	$res1=update("dish_cn", $arr_1, $where);

	$arr_2['dish_name']=addslashes($_POST['eName']);
	$arr_2['dish_desc']=addslashes($_POST['eDesc']);
	$res2=update("dish_en", $arr_2, $where);

	$arr_3['dish_name']=addslashes($_POST['fName']);
	$arr_3['dish_desc']=addslashes($_POST['fDesc']);
	$res3=update("dish_fr", $arr_3, $where);	

	$pid=$id;
	if( !($res0===false || $res1===false || $res2===false || $res3===false) && $pid ){
		if (is_array ( $uploadFiles ) && $uploadFiles) {
			foreach ( $uploadFiles as $uploadFile ) {
				$arr ['dish_id'] = $pid;
				$arr ['album_path'] = $uploadFile ['name'];
				addAlbum ( $arr );
			}
		}
		$mesg="<p>编辑成功!</p><a href='listDish.php' target='mainFrame'>查看菜品列表</a>";
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
		$mesg="<p>编辑失败!</p><a href='listDish.php' target='mainFrame'>重新编辑</a>";
	}
	
	return $mesg; 	
}

/**
 * 删除菜品
 * @param int $id
 * @return string
 */
function delDish($id){
	$where="dish_id=$id";
	$res0=delete("dish",$where);
	$res1=delete("dish_cn",$where);
	$res2=delete("dish_en",$where);
	$res3=delete("dish_fr",$where);
	$dishImgs=getAllImgByDishId($id);
	if( $dishImgs && is_array($dishImgs) ){
		foreach($dishImgs as $dishImg){
			if(file_exists("uploads/".$dishImg['album_path'])){
				unlink("uploads/".$dishImg['album_path']);
			}
			if(file_exists("../image_50/".$dishImg['album_path'])){
				unlink("../image_50/".$dishImg['album_path']);
			}
			if(file_exists("../image_220/".$dishImg['album_path'])){
				unlink("../image_220/".$dishImg['album_path']);
			}
			if(file_exists("../image_350/".$dishImg['album_path'])){
				unlink("../image_350/".$dishImg['album_path']);
			}
			if(file_exists("../image_800/".$dishImg['album_path'])){
				unlink("../image_800/".$dishImg['album_path']);
			}
				
		}
	}

	$res4=delete("album",$where);
	if($res0 && $res1 && $res2 && $res3 && $res4){
		$mes="删除成功!<br/><a href='listDish.php' target='mainFrame'>查看菜品列表</a>";
	}else{
		$mes="删除失败!<br/><a href='listDish.php' target='mainFrame'>重新删除</a>";
	}
	
	return $mes;
}

function delDishImgById($id){
	
	$dishImg=getDishImgsByImagId($id);
	
	$where="id={$id}";
	$res=delete("album",$where);
	if(res){
		if(file_exists("../image_800/".$dishImg['album_path'])){
			unlink("../image_800/".$dishImg['album_path']);
		}
		if(file_exists("../image_50/".$dishImg['album_path'])){
			unlink("../image_50/".$dishImg['album_path']);
		}
		if(file_exists("../image_220/".$dishImg['album_path'])){
			unlink("../image_220/".$dishImg['album_path']);
		}
		if(file_exists("../image_350/".$dishImg['album_path'])){
			unlink("../image_350/".$dishImg['album_path']);
		}
		if(file_exists("./uploads/".$dishImg['album_path'])){
			unlink("./uploads/".$dishImg['album_path']);
		}	
		$mes="删除成功!<br/><a href='listDishImages.php' target='mainFrame'>查看菜品图片列表</a>";					
	}else{
		$mes="删除失败!<br/><a href='listDishImages.php' target='mainFrame'>重新删除</a>";
	}
	
	return $mes;
}

function uploadDishPic($id){

	$path="./uploads";
	$uploadFiles=uploadFile($path);

	if( is_array($uploadFiles) && $uploadFiles ){
		foreach ($uploadFiles as $key => $uploadFile){
			thumb($path."/".$uploadFile['name'],"../image_50/".$uploadFile['name'],50,50);
			thumb($path."/".$uploadFile['name'],"../image_220/".$uploadFile['name'],220,220);
			thumb($path."/".$uploadFile['name'],"../image_350/".$uploadFile['name'],350,350);
			thumb($path."/".$uploadFile['name'],"../image_800/".$uploadFile['name'],800,800);
		}
	
		foreach ($uploadFiles as $uploadFile){
			$arr['dish_id']=$id;
			$arr['album_path']=$uploadFile['name'];
			addAlbum($arr);
		}
		
		$mesg="<p>图片上传成功!</p><a href='listDishImages.php' target='mainFrame'>查看菜品图片列表</a>";
	}else{
		$mesg="<p>无图片上传!</p><a href='listDishImages.php' target='mainFrame'>查看菜品图片列表</a>";
	}
	
	return $mesg;
}

/**
 * 得到商品的所有信息
 * @return array:

function getAllProByAdmin(){
	$sql="select p.id,p.pname,p.psn,p.pnum,p.mprice,p.iprice,p.pdesc,p.pubtime,p.isshow,p.ishot,c.cname from imooc_pro as p join imooc_cate c on p.cid=c.id";
	$rows=fetchAll($sql);
	return $rows;
} */

/**
 * 根据商品ID得到商品图片
 * @param int $id
 * @return array:
 */
function getAllImgByDishId($id){
	$sql="select a.id, a.album_path from album a where dish_id={$id}";
	$rows=fetchAll($sql);
	return $rows;
}

/**
 * 根据菜品ID得到菜品第一张图片
 * @param int $id
 * @return array:
 */
function getFirstImgByDishId($id){
	$sql="select a.id, a.album_path from album a where dish_id={$id} limit 1";
	$row=fetchOne($sql);
	return $row;
}

/**
 * 根据ID得到商品的详细信息
 * @param int $id
 * @return array:
 */
function getDishById($id){
	$sql="select d.dish_id,d.cate_id,dc.dish_name as 'dish_name_cn',de.dish_name as 'dish_name_en',df.dish_name as 'dish_name_fr',d.dish_no,d.dish_num,d.reg_price,d.current_price,d.dish_time,d.is_show,d.is_hot,d.is_spicy,dc.dish_desc as 'dish_desc_cn',de.dish_desc as 'dish_desc_en',df.dish_desc as 'dish_desc_fr' from dish as d, dish_cn as dc, dish_en as de, dish_fr as df where d.dish_id={$id} and d.dish_id=dc.dish_id and dc.dish_id=de.dish_id and de.dish_id=df.dish_id";
	$row=fetchOne($sql);
	return $row;
}

/**
 * 检查分类下是否有菜品
 * @param int $cid
 * @return array
 */
function checkProExist($cid){
	$sql="select * from dish where cate_id={$cid}";
	$rows=fetchAll($sql);
	return $rows;
}

/**
 * 得到所有商品
 * @return array

function getAllPros(){
	$sql="select p.id,p.pname,p.psn,p.pnum,p.mprice,p.iprice,p.pdesc,p.pubtime,p.isshow,p.ishot,c.cname,p.cid from imooc_pro as p join imooc_cate c on p.cid=c.id ";
	$rows=fetchAll($sql);
	return $rows;
} */


/**
 *根据cid得到4条产品
 * @param int $cid
 * @return Array

function getProsByCid($cid){
	$sql="select p.id,p.pname,p.psn,p.pnum,p.mprice,p.iprice,p.pdesc,p.pubtime,p.isshow,p.ishot,c.cname,p.cid from imooc_pro as p join imooc_cate c on p.cid=c.id where p.cid={$cid} limit 4";
	$rows=fetchAll($sql);
	return $rows;
} */

/**
 * 得到下4条产品
 * @param int $cid
 * @return array

function getSmallProsByCid($cid){
	$sql="select p.id,p.pname,p.psn,p.pnum,p.mprice,p.iprice,p.pdesc,p.pubtime,p.isshow,p.ishot,c.cname,p.cid from imooc_pro as p join imooc_cate c on p.cid=c.id where p.cid={$cid} limit 4,4";
	$rows=fetchAll($sql);
	return $rows;
} */

/**
 * 得到商品ID和商品名称
 * @return array:
 */
function getDishInfo(){
	$sql="select d.dish_id,d.cate_id,dc.dish_name as 'dish_name_cn',de.dish_name as 'dish_name_en',df.dish_name as 'dish_name_fr',d.dish_no,d.dish_num,d.reg_price,d.current_price,d.dish_time,d.is_show,d.is_hot,d.is_spicy,dc.dish_desc as 'dish_desc_cn',de.dish_desc as 'dish_desc_en',df.dish_desc as 'dish_desc_fr' from dish as d, dish_cn as dc, dish_en as de, dish_fr as df where d.dish_id=dc.dish_id and dc.dish_id=de.dish_id and de.dish_id=df.dish_id";
	$rows=fetchAll($sql);
	return $rows;
}







