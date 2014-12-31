<?php

/**
 * æ£€æŸ¥ç®¡ç�†å‘˜æ˜¯å�¦å­˜åœ¨
 * @param unknown $sql
 * @return multitype:
 */
function checkAdmin($sql) {
	return fetchOne ( $sql );
}

/**
 * æ£€æµ‹æ˜¯å�¦æœ‰ç®¡ç�†å‘˜ç™»å½•
 */
function checkLogined() {
	if ($_SESSION ['adminId'] == "" && $_COOKIE ['adminId'] == "") {
		//alertMesg ( "è¯·å…ˆç™»å½•", "login.php" );
		echo "<script>window.location='login.php';</script>";
	}
}

/**
 * æ·»åŠ ç®¡ç�†å‘˜
 * 
 * @return string
 */
function addAdmin() {
	$arr = $_POST;
	$arr ['password'] = md5 ( $_POST ['password'] );
	if (insert ( "resto_admin", $arr )) {
		$mesg = "æ·»åŠ æˆ�åŠŸ!<br/><a href='addAdmin.php'>ç»§ç»­æ·»åŠ </a>|<a href='listAdmin.php'>æŸ¥çœ‹ç®¡ç�†å‘˜åˆ—è¡¨</a>";
	} else {
		$mesg = "æ·»åŠ å¤±è´¥!<br/><a href='addAdmin.php'>é‡�æ–°æ·»åŠ </a>";
	}
	return $mesg;
}

/**
 * å¾—åˆ°æ‰€æœ‰çš„ç®¡ç�†å‘˜
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
 * ç¼–è¾‘ç®¡ç�†å‘˜
 * 
 * @param int $id        	
 * @return string
 */
function editAdmin($id) {
	$arr = $_POST;
	$arr ['password'] = md5 ( $_POST ['password'] );
	if (update ( "resto_admin", $arr, "admin_id={$id}" )) {
		$mesg = "ç¼–è¾‘æˆ�åŠŸ!<br/> <a href='listAdmin.php'>æŸ¥çœ‹ç®¡ç�†å‘˜åˆ—è¡¨</a>";
	} else {
		$mesg = "ç¼–è¾‘å¤±è´¥!<br/> <a href='listAdmin.php'>è¯·é‡�æ–°ä¿®æ”¹</a>";
	}
	return $mesg;
}

/**
 * åˆ é™¤ç®¡ç�†å‘˜çš„æ“�ä½œ
 * 
 * @param int $id        	
 * @return string
 */
function delAdmin($id) {
	if (delete ( "resto_admin", "admin_id={$id}" )) {
		$mesg = "åˆ é™¤æˆ�åŠŸ!<br/> <a href='listAdmin.php'>æŸ¥çœ‹ç®¡ç�†å‘˜åˆ—è¡¨</a>";
	} else {
		$mesg = "åˆ é™¤å¤±è´¥!<br/> <a href='listAdmin.php'>è¯·é‡�æ–°åˆ é™¤</a>";
	}
	return $mesg;
}

/**
 * ç®¡ç�†å‘˜é€€å‡º
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


