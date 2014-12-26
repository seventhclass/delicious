<?php
	require_once "../include.php";

    
    $msg = $_POST['leaveMessage'];

    $msg = wordwrap($msg,70);
    
    $today = date("D M j G:i:s T Y");
    $subject="New Message "+ $today;
    
    $toMailAddress="delicieux.restauant@gmail.com";
    $clientEmail=$_POST['clientEmail'];
    $clientName=$_POST['clientName'];
    
    $resut=mail($toMailAddress,$subject,$msg);
    
    echo $resut;
    
    alertMesg("go home page ",'../index.php');
    
?>