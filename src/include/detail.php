<!doctype html>
<html>
	<head>
	<meta charset="utf-8">
	<title>popup and overlay</title>
	<link href="practice.css" type="text/css" rel="stylesheet"/>
	</head>

	<body>
		<div id="page_overlay"></div>
		<div id="popup">
			
			<!--<div id="popup_nav">
				<input id="back"type="image" src="arrow-back-white.png">
				<input id="forward"type="image" src="arrow-forward-white.png">
			</div>-->
			<div id="popup_nav">
				<i id="back"><a href="javascript:;"></a></i>
				<i id="forward"><a href="javascript:;"></a></i>
			</div>
			<div id="popup_main">
				<!--<div id="popup_topbar">
					<p>
						<input id="close"  type="image" src="gray-close-circled-32-1.png">
					</p>
				</div>-->
				<i id="close"><a href="javascript:;"></a></i>
				<div id="popup_page">
				<div id="dish_pic">
					<div id="pic_large"><img src="" style="opacity: 1;"></div>
					<div id="pic_small">
						<i id="s_back"></i>
						<div class="thumb_nail"></div>
						<div class="thumb_nail"></div>
						<div class="thumb_nail"></div>
						<div class="thumb_nail"></div>
						<i id="s_forward"></i>
					</div>
				</div>
				
				<div id="dish_text">
					<h1>Dish Name Dish Name Dish Name Dish Name</h1>
					<ul>
						<li><div class="dt">Dish No.</div>
							<div class="dd">10001</div>
						</li>
						<li><div class="dt">Category:</div>
							<div class="dd">Cantonese and Hong Kong Style</div>
						</li>
						<li><div class="dt">Spicy:</div>
							<div class="dd" id="is_spicy"></div>
						</li>
						<li><div class="dt">Current Price:</div>
							<div class="dd">$9.99</div>
						</li>
						<li><div class="dt">Regular Price:</div>
							<div class="dd">$11.99</div>
						</li>
					</ul>
				</div>
				
				<div id="dish_desc">
					<h1>Description</h1>
				</div>
				
			</div>
			
			
			<div id="popup_footer">
				<p><span id="slideNumber">4</span> / <span id="slideTotal">14<span></p>
			</div>
			
			</div>
		</div>

	</body>
</html>