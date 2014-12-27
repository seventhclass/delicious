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

		<link href="./css/promotion.css" type="text/css" rel="stylesheet">		
		<link type="text/css" rel="stylesheet" media="all" href="./css/jquery.jqzoom.css"/>
		<script src="./js/jquery-1.6.js" type="text/javascript"></script>
		<script src="./js/jquery.jqzoom-core.js" type="text/javascript"></script>
		<!--[if IE 6]>
		<script type="text/javascript" src="./js/DD_belatedPNG_0.0.8a-min.js"></script>
		<script type="text/javascript" src="./js/ie6Fixpng.js"></script>
		<![endif]-->		
		<script type="text/javascript">
		$(document).ready(function() {
			$('.jqzoom').jqzoom({
					zoomType: 'standard',
					lens:true,
					preloadImages: false,
					alwaysOn:false,
					title:false,
					zoomWidth:410,
					zoomHeight:410
				});
			
		});
		</script>			
	</head>
	<body>
		<?php
			include("./include/home.php");
			include("./include/menu.php");
			include("./include/promotion.php");
			include("./include/about.php");
			include("./include/contact.php");
			include("./include/header.php");
			include("./include/footer.php");
			include("./include/detail.php");
		?>
	</body>
</html>
