<!DOCTYPE html>
	<head>
		<title>Welcome to Restaurant Delicieux</title>
		<link href="./css/style.css" type="text/css" rel="stylesheet">

	</head>
	<body>
		<?php
			include("header.php");
			//according to certain condition, load different content:
			include("main.php");
			include("footer.php");
		?>
	</body>
</html>