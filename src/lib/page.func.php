<?php
// require_once '../include.php';
// $sql="select * from imooc_admin";
// $totalRows=getResultNum($sql);
// //echo $totalRows;

// $pageSize=2;

// //å¾—åˆ°æ€»é¡µç �æ•°
// $totalPage=ceil($totalRows/$pageSize);
// $page=$_REQUEST['page']?(int)$_REQUEST['page']:1;
// if($page<1||$page==null||!is_numeric($page)){
// 	$page=1;
// }

// if($page>=$totalPage)
// 	$page=$totalPage;
// $offset=($page-1)*$pageSize;

// $sql="select * from imooc_admin limit {$offset},{$pageSize}";
// //echo $sql;

// $rows=fetchAll($sql);
// //print_r($rows);
// foreach ($rows as $row){
// 	echo "ç¼–å�·:".$row['id'],"<br/>";
// 	echo "ç®¡ç�†å‘˜çš„å��ç§°:".$row['username'],"<hr/>";
// }

// echo showPage($page, $totalPage);
// echo "<hr/>";
// echo showPage($page,$totalPage,"cid=5");

function showPage($page, $totalPage, $where = null, $seprator = "&nbsp;") {
	
	$where = ($where == null) ? null : "&" . $where;
	$url = $_SERVER ['PHP_SELF'];
	$index = ($page == 1) ? "首页" : "<a href='{$url}?page=1{$where}'>首页</a>";
	$last = ($page == $totalPage) ? "尾页" : "<a href='{$url}?page={$totalPage}{$where}'>尾页</a>";
	$prev = ($page == 1) ? "上一页" : "<a href='{$url}?page=" . ($page - 1) . "{$where}'>上一页</a>";
	$next = ($page == $totalPage) ? "下一页" : "<a href='{$url}?page=" . ($page + 1) . "{$where}'>下一页</a>";
	$str = "总共:{$totalPage}页/当前是第{$page}页";
	for($i = 1; $i <= $totalPage; $i ++) {
		// 当前页无连接
		if ($page == $i) {
			$p .= "[{$i}]";
		} else {
			$p .= "<a href='{$url}?page={$i}{$where}'>[{$i}]</a>";
		}
	}
	
	$pageStr = "<span class='headbox'>".$str."</span>" . $seprator.$seprator.$seprator.$seprator . $index . $seprator . $prev . $seprator . $p . $seprator . $next . $seprator . $last;
	return $pageStr;
}

function showPage2($page, $totalPage, $cateid = null, $seprator = "&nbsp;") {

	if($cateid){
		$cateid=",".$cateid;
	}
	
	$index = ($page == 1) ? "首页" : "<span class='availablePage' onclick='getMenuInfo(1{$cateid})'>首页</span>";
	$last = ($page == $totalPage) ? "尾页" : "<span class='availablePage' onclick='getMenuInfo({$totalPage}{$cateid})'>尾页</span>";
	$prev = ($page == 1) ? "上一页" : "<span class='availablePage' onclick='getMenuInfo(({$page}-1){$cateid})'>上一页</span>";
	$next = ($page == $totalPage) ? "下一页" : "<span class='availablePage' onclick='getMenuInfo(({$page}+1){$cateid})'>下一页</span>";
	$str = "总共:{$totalPage}页/当前是第{$page}页";
	for($i = 1; $i <= $totalPage; $i ++) {
		// 当前页无连接
		if ($page == $i) {
			$p .= "[{$i}]";
		} else {
			$p .= "<span class='availablePage' onclick='getMenuInfo({$i}{$cateid})'>[{$i}]</span>";
		}
	}

	$pageStr = "<span class='headbox'>".$str."</span>" . $seprator.$seprator.$seprator.$seprator . $index . $seprator . $prev . $seprator . $p . $seprator . $next . $seprator . $last;
	return $pageStr;
}

function showPage3($page, $totalPage, $cateid = null, $seprator = "&nbsp;") {

	if($cateid){
		$where_cateid = "data-cateid='".$cateid."'";	
	}else{
		$where_cateid = "data-cateid=''";
	}
	
	
	if($page>1)
		$prevPage=$page-1;
	if($page<$totalPage)
		$nextPage=$page+1;
	
	$index = ($page == 1) ? "首页" : "<span class='availablePage' data-page='1' {$where_cateid} >首页</span>";
	$last = ($page == $totalPage) ? "尾页" : "<span class='availablePage' data-page='{$totalPage}' {$where_cateid} >尾页</span>";
	$prev = ($page == 1) ? "上一页" : "<span class='availablePage' data-page='{$prevPage}' {$where_cateid} >上一页</span>";
	$next = ($page == $totalPage) ? "下一页" : "<span class='availablePage' data-page='{$nextPage}' {$where_cateid} >下一页</span>";
	$str = "总共:{$totalPage}页/当前是第{$page}页";
	for($i = 1; $i <= $totalPage; $i ++) {
		// 当前页无连接
		if ($page == $i) {
			$p .= "[{$i}]";
		} else {
			$p .= "<span class='availablePage' data-page='{$i}' {$where_cateid} > [{$i}] </span>";
		}
	}

	$pageStr = "<span class='headbox'>".$str."</span>" . $seprator.$seprator.$seprator.$seprator . $index . $seprator . $prev . $seprator . $p . $seprator . $next . $seprator . $last;
	return $pageStr;
}



