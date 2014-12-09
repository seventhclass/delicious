<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>登陆</title>
<link type="text/css" rel="stylesheet" href="styles/reset.css">
<link type="text/css" rel="stylesheet" href="styles/main.css">
<script src="../js/jquery-1.11.1.js"></script>
<!--[if IE 6]>
<script type="text/javascript" src="../js/DD_belatedPNG_0.0.8a-min.js"></script>
<script type="text/javascript" src="../js/ie6Fixpng.js"></script>
<![endif]-->
</head>

<body>
<div class="headerBar">
	<div class="logoBar login_logo">
		<div class="comWidth">
			<div class="logo fl">
				<a href="#"><img src="images/logo_delicieux.jpg" alt="吃货网"></a>
			</div>
			<h3 class="welcome_title">欢迎登陆</h3>
		</div>
	</div>
</div>

<div class="loginBox">
	<div class="login_cont">
	<form id="loginForm" action="doLogin.php" method="post">
			<ul class="login">
				<li class="l_tit">管理员账号</li>
				<li class="mb_10"><input type="text"  id="username" name="username" placeholder="请输入管理员帐号" class="login_input user_icon"><span class="prompt" id="sp1"></span></li>
				<li class="l_tit">密码</li>
				<li class="mb_10"><input type="password" id="password" name="password" class="login_input password_icon"><span class="prompt" id="sp2"></span></li>
				<li class="l_tit">验证码</li>
				<li class="mb_10"><input type="text" id="verify" name="verify" class="login_input password_icon"><span class="prompt" id="sp3"></span></li>				
				<img src="getVerify.php" alt="验证码" />
				<li class="autoLogin"><input type="checkbox" id="a1" class="checked" name="autoFlag" value="1"><label for="a1">自动登陆(一周内自动登陆)</label></li>				
				<div id="login_status" style="display:none"><img width="80" height="80" src="./images/loader4.gif" alt="logging"/></div> 
				<div id="response" style='color:red; font-size:20px;font-style:oblique;font-weight:bold;'></div>				
				<li><input type="submit" value="" class="login_btn"></li>
			</ul>
		</form>
	</div>
</div>
<div class="hr_25"></div>
<div class="footer">
	<p>Copyright &copy; 2023 Delicious Restaurant版权所有&nbsp;&nbsp;&nbsp;</p>
</div>

<script>
$(document).ready(function(){
	$('#username').focus(function(){
		if ($(this).val() == "") {
	            $(this).css("border-color", "#FF0000");	            
	    } else {
	            $(this).css("border-color", "#999");
	            $("#sp1").html("");
	    }
	});	
	$('#username').blur(function() {
        if ($(this).val() == "") {
                $(this).css("border-color", "#FF0000");
                $("#sp1").html("用户名不能为空").css("color", "red");
                $('#username').focus();
        } else {
                $(this).css("border-color", "#999");
                $("#sp1").html("");
        }
	});
	$('#password').focus(function(){
		if ($(this).val() == "") {
	            $(this).css("border-color", "#FF0000");
	    } else {
	            $(this).css("border-color", "#999");
	            $("#sp2").html("");
	    }
	});	
	$('#password').blur(function() {
        if ($(this).val() == "") {
                $(this).css("border-color", "#FF0000");
                $("#sp2").html("密码不能为空").css("color", "red");
                $('#password').focus();
        } else {
                $(this).css("border-color", "#999");
                $("#sp2").html("");
        }
	});	
	$('#verify').focus(function(){
		if ($(this).val() == "") {
	            $(this).css("border-color", "#FF0000");
	    } else {
	            $(this).css("border-color", "#999");
	            $("#sp3").html("");
	    }
	});	
	$('#verify').blur(function() {
        if ($(this).val() == "") {
                $(this).css("border-color", "#FF0000");
                $("#sp3").html("验证码不能为空").css("color", "red");
                $('#verify').focus();
        } else {
                $(this).css("border-color", "#999");
                $("#sp3").html("");
        }
	});		
    $('#loginForm').submit(function(){
     	if($('#username').val() == ""){
     		$("#sp1").html("用户名不能为空").css("color", "red");
     		return false;
     	}
     	if($('#password').val() == ""){
     		$("#sp2").html("密码不能为空").css("color", "red");
     		return false;
     	}
     	if($('#verify').val() == ""){
     		$("#sp3").html("验证码不能为空").css("color", "red");
     		return false;
     	}
     	
        // show that something is loading
        /*$('#response').html("<b>Logging system...</b>");*/
        $('#response').html("");
        $('#login_status').show();
        /*
         * 'doLogin.php' - where you will pass the form data
         * $(this).serialize() - to easily read form data
         * function(data){... - data contains the response from doLogin.php
         */
        $.post('doLogin.php', $(this).serialize(), function(data){
        	$('#login_status').hide(); 
            // show the response
            $('#response').html(data);
             
        }).fail(function() {
         
            // just in case posting your form failed
            $('#response').html("发送失败.");
             
        });
 
        // to prevent refreshing the whole page page
        return false;
 
    });
});
</script>
</body>
</html>
