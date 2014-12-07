<?php

require_once '../include.php';

$act=$_REQUEST['act'];
$id=$_REQUEST['id'];

if($act=="logout"){
	logout();
}elseif($act=="addAdmin"){
	$mesg=addAdmin();
}elseif($act=="editAdmin"){	
	$mesg=editAdmin($id);
}elseif($act=="delAdmin"){
	$mesg=delAdmin($id);
}elseif($act=="addCate"){
	$mesg=addCate();
}elseif($act=="editCate"){
	$where="cate_id={$id}";
	$mesg=editCate($where);
}elseif($act=="delCate"){
	$where="cate_id={$id}";
	$mesg=delCate($where);
}elseif($act=="addDish"){
	$mesg=addDish();
}elseif($act=="editDish"){
	$mesg=editDish($id);
}elseif($act=="delDish"){
	$mesg=delDish($id);
}elseif($act=="waterText"){
	$mesg=doWaterText($id);
}elseif($act=="waterPic"){
	$mesg=doWaterPic($id);
}elseif($act=="delDishImage"){
	$mesg=delDishImgById($id);
}elseif($act=="uploadPic"){
	$mesg=uploadDishPic($id);
}

?>

<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>后台管理调度</title>
</head>
<body>
<?php 
	if($mesg){
		echo $mesg;
	}
?>
</body>
</html>