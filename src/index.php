<!DOCTYPE html>
	<head>
		<title>Welcome to Restaurant Delicieux</title>
		<link href="./css/style.css" type="text/css" rel="stylesheet">
		<link href="./include/home.css" type="text/css" rel="stylesheet">
		<script type="text/javascript" async="" src="./include/home.js"></script>

	</head>
	<body>
		<?php
			include("./include/header.php");
			//according to certain condition, load different content:
			include("./include/home.php");
			include("./include/footer.php");
		?>
	</body>
</html>