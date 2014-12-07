<?php

function alertMesg($mesg, $url){
	echo "<script>alert('{$mesg}');</script>";
	echo "<script>window.location='{$url}';</script>";
}
