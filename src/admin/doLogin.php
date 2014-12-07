<?php

require_once '../include.php';
usleep(500000);
$username=$_POST['username'];		//user input username
$username=addslashes($username);	//user inout password
$password=md5($_POST['password']);
$verify=$_POST['verify'];			//user input verification code
$verify1=$_SESSION['verify'];		//system generated
$autoFlag=$_POST['autoFlag'];		//Auto login flag

//check verification code
if($verify==$verify1){
	$sql="select * from resto_admin where username='{$username}' and password='{$password}'";
	$row=checkAdmin($sql);
	if($row){
		//如果选了一周内自动登录
		if($autoFlag){
			setcookie("adminId",$row['admin_id'],time()+7*24*3600);
			setcookie("adminName",$row['username'],time()+7*24*3600);
		}
		$_SESSION['adminName']=$row['username'];
		$_SESSION['adminId']=$row['admin_id'];
		//alertMesg("登录成功", "index.php");
		echo "<script>window.location='index.php';</script>";
	}else{
		//alertMesg("登录失败，请重新登录", "login.php"); 
		echo "登录失败.";
	}
}else {
	//alertMesg("验证码错误", "login.php");
	echo "验证码错误.";
}
?>

