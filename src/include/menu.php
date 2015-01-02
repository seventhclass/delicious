<?php 
require_once './include.php';

$cateids = getAllCate();

?>

<section class="content" id="content_menu">
	<nav>
		<div class="cat_sidebar">
			<ul id="category">
				<?php 
					if($_REQUEST ['cate_id']){
				?>
					<li onclick='cate_clicked()'>All</li>	
				<?php 
					}else{
				?>	
					<li class="on" onclick='cate_clicked()'>All</li>					
				<?php 		
					};
				?>
				<?php 
					foreach ($cateids as $cateid):
				?>											
				<li <?php $_REQUEST ['cate_id']==$cateid['cate_id'] ? "class='on'":null; echo "onclick='cate_clicked({$cateid['cate_id']})'";?> ><?php echo $cateid['cate_name_en'] ?></li>
				<?php endforeach; ?>
			</ul>
			<div class="dot_curr"></div>
		</div>
	</nav>
	<div class="gallery_main">
		<div class="gallery_cont">
			<iframe src="./include/dishGallery.php"  frameborder="0" name="mainFrame" width="100%" height="980"></iframe>	
		</div>
	</div>
</section>