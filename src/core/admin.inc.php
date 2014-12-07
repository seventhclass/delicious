<?php

/**
 * 检查管理员是否存在
 * @param unknown $sql
 * @return multitype:
 */
function checkAdmin($sql) {
	return fetchOne ( $sql );
}

/**
 * 检测是否有管理员登录
 */
function checkLogined() {
	if ($_SESSION ['adminId'] == "" && $_COOKIE ['adminId'] == "") {
		alertMesg ( "请先登录", "login.php" );
	}
}

/**
 * 添加管理员
 * 
 * @return string
 */
function addAdmin() {
	$arr = $_POST;
	$arr ['password'] = md5 ( $_POST ['password'] );
	if (insert ( "resto_admin", $arr )) {
		$mesg = "添加成功!<br/><a href='addAdmin.php'>继续添加</a>|<a href='listAdmin.php'>查看管理员列表</a>";
	} else {
		$mesg = "添加失败!<br/><a href='addAdmin.php'>重新添加</a>";
	}
	return $mesg;
}

/**
 * 得到所有的管理员
 * 
 * @return array:
 */
function getAllAdmin() {
	$sql = "select admin_id,username,email from resto_admin ";
	$rows = fetchAll ( $sql );
	return $rows;
}
function getAdminByPage($page, $pageSize = 2) {
	$sql = "select * from resto_admin";
	global $totalRows;
	$totalRows = getResultNum ( $sql );
	global $totalPage;
	$totalPage = ceil ( $totalRows / $pageSize );
	
	if ($page < 1 || $page == null || ! is_numeric ( $page )) {
		$page = 1;
	} 
	if ($page >= $totalPage)
		$page = $totalPage;
	$offset = ($page - 1) * $pageSize;
	$sql = "select admin_id,username,email from resto_admin order by admin_id limit {$offset},{$pageSize}";
	$rows = fetchAll ( $sql );
	return $rows;
}

/**
 * 编辑管理员
 * 
 * @param int $id        	
 * @return string
 */
function editAdmin($id) {
	$arr = $_POST;
	$arr ['password'] = md5 ( $_POST ['password'] );
	if (update ( "resto_admin", $arr, "admin_id={$id}" )) {
		$mesg = "编辑成功!<br/> <a href='listAdmin.php'>查看管理员列表</a>";
	} else {
		$mesg = "编辑失败!<br/> <a href='listAdmin.php'>请重新修改</a>";
	}
	return $mesg;
}

/**
 * 删除管理员的操作
 * 
 * @param int $id        	
 * @return string
 */
function delAdmin($id) {
	if (delete ( "resto_admin", "admin_id={$id}" )) {
		$mesg = "删除成功!<br/> <a href='listAdmin.php'>查看管理员列表</a>";
	} else {
		$mesg = "删除失败!<br/> <a href='listAdmin.php'>请重新删除</a>";
	}
	return $mesg;
}

/**
 * 管理员退出
 */
function logout() {
	$_SESSION = array ();
	if (isset ( $_COOKIE [session_name ()] )) {
		setcookie ( session_name (), "", time () - 1 );
	}
	if (isset ( $_COOKIE ['adminId'] )) {
		setcookie ( "adminId", "", time () - 1 );
	}
	if (isset ( $_COOKIE ['adminName'] )) {
		setcookie ( "adminName", "", time () - 1 );
	}
	session_destroy ();
	header ( "location:login.php" );
}


