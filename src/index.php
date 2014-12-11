<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Welcome to Restaurant Delicieux</title>
		<!--<script type="text/javascript" async="" src="./include/home.js"></script>-->
		<script src="./js/jquery.min.js"></script>
		<script src="http://maps.googleapis.com/maps/api/js"></script>
		<script type="text/javascript" src="./js/content.js"></script>
		<script type="text/javascript" src="./js/home.js"></script>
		<link href="./css/style.css" type="text/css" rel="stylesheet">
		<!--<link href="./include/home.css" type="text/css" rel="stylesheet">-->
	</head>
	<body>
	<!--<div id="wrap"> -->
			<?php
				include("./include/header.php");
				//according to certain condition, load different content:
				include("./include/home.php");
				include("./include/menu.php");
				include("./include/promotion.php");
				include("./include/about.php");
				include("./include/contact.php");
				include("./include/footer.php");
			?>
		<!--</div>-->
	</body>
</html>
