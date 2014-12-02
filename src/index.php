<!DOCTYPE html>
	<head>
		<meta charset="UTF-8">
		<title>Welcome to Restaurant Delicieux</title>
		<!--<script type="text/javascript" async="" src="./include/home.js"></script>-->
		<link href="./css/style.css" type="text/css" rel="stylesheet">
		<!--<link href="./include/home.css" type="text/css" rel="stylesheet">-->

	</head>
	<body>
	<!--<div id="wrap"> -->
			<?php
				include("./include/header.php");
				//according to certain condition, load different content:
				include("./include/home1.php");
				include("./include/footer.php");
			?>
		<!--</div>-->
	</body>
</html>