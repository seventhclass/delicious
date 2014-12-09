<?php
/**
 * 添加分类的操作
 * @return string
 */
function addCate(){
	$arr_c['cate_name']=addslashes($_POST['cName']);
	$arr_e['cate_name']=addslashes($_POST['eName']);
	$arr_f['cate_name']=addslashes($_POST['fName']);
	
	if( insert("cate_cn",$arr_c) && insert("cate_en",$arr_e) && insert("cate_fr",$arr_f) ){
		$mesg="分类添加成功!<br/> <a href='addCate.php'>继续添加</a>|<a href='listCate.php'>查看分类</a>";		
	}else{
		$mesg="分类添加失败!<br/> <a href='addCate.php'>重新添加</a>|<a href='listCate.php'>查看分类</a>";
	}
	return $mesg;
}

/**
 * 根据ID得到指定分类信息
 * @param int $id
 * @return array:
 */
function getCateById($id){
	$sql="select c.cate_id 'id',c.cate_name 'cate_name_cn',e.cate_name 'cate_name_en',f.cate_name 'cate_name_fr' from cate_cn as c, cate_en as e, cate_fr as f where c.cate_id='{$id}' and c.cate_id=e.cate_id and e.cate_id=f.cate_id";
	$row=fetchOne($sql);
	return $row;
}

/**
 * 修改分类的操作
 * @param string $where
 * @return string
 */
function editCate($where){
	//$arr=$_POST;
	$arr_c['cate_name']=addslashes($_POST['cName']);
	$arr_e['cate_name']=addslashes($_POST['eName']);
	$arr_f['cate_name']=addslashes($_POST['fName']);	
	if( update("cate_cn", $arr_c, $where) && update("cate_en", $arr_e, $where) && update("cate_fr", $arr_f, $where)){
		$mesg="分类修改成功!<br/> <a href='listCate.php'>查看分类</a>";
	}else{
		$mesg="分类修改失败!<br/> <a href='listCate.php'>重新修改</a>";
	}
	return $mesg;
}


/**
 * 删除指定的分类
 * @param string $where
 * @return string
 */
function delCate($where) {
	if (delete ( "cate_cn", $where ) && delete ( "cate_en", $where ) && delete ( "cate_fr", $where )) {
		$mesg = "分类删除成功!<br/> <a href='listCate.php'>查看分类</a>|<a href='addCate.php'>添加分类</a>";
	} else {
		$mesg = "分类删除失败!<br/> <a href='listCate.php'>请重新删除</a>";
	}
	return $mesg;
}

/**
 * 得到所有分类
 * @return array:
 */
function getAllCate(){
	$sql="select c.cate_id,c.cate_name as 'cate_name_cn', e.cate_name as 'cate_name_en', f.cate_name as 'cate_name_fr' from cate_cn as c, cate_en as e, cate_fr as f where c.cate_id=e.cate_id and e.cate_id=f.cate_id order by c.cate_id";
	$rows=fetchAll($sql);
	return $rows;
}








