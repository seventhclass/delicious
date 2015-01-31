<?php 

$id=$_REQUEST['dish_id'];

if($id){
	//Get dish information by dish id
	$dish_info = getDishById($id);	
	//var_dump($dish_info);
	if($dish_info){
		//Get category information by category id
		$cate_info = getCateById($dish_info['cate_id']);
	}
	//Get all dish images by dish id
	$dish_images = getAllImgByDishId($id);
	//var_dump($dish_images);
}

?>

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
			<div id="pic_large">
				<?php if($dish_images){ ?>
					<img id="org_pic" src="./image_800/<?php echo $dish_images[0]['album_path'];?>" alt="<?php echo $dish_images[0]['album_path'];?>" width="460" height="350" style='opacity: 1'>
				<?php }else {?>
					<img id="org_pic" src="" style="opacity: 1;">
				<?php }?>
			</div>
			<div id="pic_small">
				<!--<i id="s_back"></i>-->
				<a href="javascript:;" class="arrow icon_arrow" id="s_back">&#xe61d;</a>
				<a href="javascript:;" class="arrow icon_arrow" id="s_forward">&#xe61e;</a>
				<?php if( $dish_images && count($dish_images)>1 ){					
					$img_nums = count($dish_images);
					if($img_nums>4){
						$img_nums = 4;
					}
					for($i=0; $i<$img_nums; $i++):
				?>			
					<div class="thumb_nail"><img src="./image_50/<?php echo $dish_images[$i]['album_path'];?>" alt="<?php echo $dish_images[$i]['album_path'];?>"  ></div><!--width="66" height="66"-->
				<?php endfor;}else{?>
					<div class="thumb_nail"><img src="" alt="" ></div>
				<?php }?>
				<!--<i id="s_forward"></i>-->
			</div>
		</div>
		
		<div id="dish_text">
			<h1><?php echo $dish_info['dish_name_fr'];?></h1>
			<ul>
				<li>
					<div class="dt">Plat No.</div>
					<div class="dd"><?php echo $dish_info['dish_no'];?></div>
				</li>
				<li>
					<div class="dt">Galerie:</div>
					<div class="dd"><?php echo $cate_info['cate_name_fr'];?></div>
				</li>
				<li>
					<div class="dt">Épicé:</div>
					<div class="dd" id="is_spicy"><?php echo $dish_info['is_spicy']==1?"Oui":"Non"; ?></div>
				</li>
				<li>
					<div class="dt">Prix Actuel:</div>
					<div class="dd"><?php echo "$ ".$dish_info['current_price'];?></div>
				</li>
				<li>
					<div class="dt">Prix Régulier:</div>
					<div class="dd"><?php echo "$ ".$dish_info['reg_price'];?></div>
				</li>
			</ul>
		</div>
		
		<div id="dish_desc">
			<h1><?php echo $dish_info['dish_desc_fr'];?></h1>
		</div>
		
	</div>

	<div id="popup_footer">
		<p><span id="slideNumber">4</span> / <span id="slideTotal">14<span></p>
	</div>

	</div>
</div>
