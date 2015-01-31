<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width">
		<title>Welcome to Restaurant Delicieux</title>					
		<!--<script type="text/javascript" async="" src="./include/home.js"></script>-->
		<script src="./js/jquery.min.js"></script>
		<script src="http://maps.googleapis.com/maps/api/js"></script>
		<script type="text/javascript" src="./js/content.js"></script>

		<script type="text/javascript" src="./js/home.js"></script>
		<link href="./css/style.css" type="text/css" rel="stylesheet">

		<!--<link href="./css/promotion.css" type="text/css" rel="stylesheet">	
		<link type="text/css" rel="stylesheet" media="all" href="./css/jquery.jqzoom.css"/>-->	
		<script src="./js/jquery-1.6.js" type="text/javascript"></script>
		<script src="./js/jquery.jqzoom-core.js" type="text/javascript"></script>
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="./js/menupage.js"></script>
		<script type="text/javascript" src="./js/jquery.easing.1.3.js"></script>
		<script type="text/javascript" src="./js/promotion.js"></script>
		<!--[if IE 6]>
		<script type="text/javascript" src="./js/DD_belatedPNG_0.0.8a-min.js"></script>
		<script type="text/javascript" src="./js/ie6Fixpng.js"></script>
		<![endif]-->		
		<!--
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
		-->			
	</head>
	<body>
		<?php
			include("./include_fr/home.php");
			include("./include_fr/menu.php");
			include("./include_fr/promotion.php");
			include("./include_fr/about.php");
			include("./include_fr/contact.php");
			include("./include_fr/header.php");
			include("./include_fr/footer.php");
			include("./include_fr/detail.php");
		?>
		
		<input type="hidden" id="curr_id" value="content_home">	
		<a href="javascript:;" id="back-to-top" title="Back to top"><i class="icon_btt">&#xe057;</i></a>
	</body>
</html>
