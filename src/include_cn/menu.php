<?php 
require_once './include.php';

$cateids = getAllCate();

$page=1;
$pageSize=18;

$sql="select d.dish_id,dc.dish_name as 'dish_name_cn',de.dish_name as 'dish_name_en',df.dish_name as 'dish_name_fr',d.dish_no,d.dish_num,d.reg_price,d.current_price,d.dish_time,d.is_show,d.is_hot,d.is_spicy,cc.cate_name as 'cate_name_cn', ce.cate_name as 'cate_name_en',cf.cate_name as 'cate_name_fr', dc.dish_desc as 'dish_desc_cn',de.dish_desc as 'dish_desc_en',df.dish_desc as 'dish_desc_fr' from dish as d, dish_cn as dc, dish_en as de, dish_fr as df, cate_cn as cc, cate_en as ce, cate_fr as cf where d.dish_id=dc.dish_id and dc.dish_id=de.dish_id and de.dish_id=df.dish_id and d.cate_id=cc.cate_id and d.cate_id=ce.cate_id and d.cate_id=cf.cate_id";
$totalRows=getResultNum($sql);
$totalPage=ceil($totalRows/$pageSize);

$offset=($page-1)*$pageSize;

$sql="select d.dish_id,dc.dish_name as 'dish_name_cn',de.dish_name as 'dish_name_en',df.dish_name as 'dish_name_fr',d.dish_no,d.dish_num,d.reg_price,d.current_price,d.dish_time,d.is_show,d.is_hot,d.is_spicy,cc.cate_name as 'cate_name_cn', ce.cate_name as 'cate_name_en',cf.cate_name as 'cate_name_fr', dc.dish_desc as 'dish_desc_cn',de.dish_desc as 'dish_desc_en',df.dish_desc as 'dish_desc_fr' from dish as d, dish_cn as dc, dish_en as de, dish_fr as df, cate_cn as cc, cate_en as ce, cate_fr as cf where d.dish_id=dc.dish_id and dc.dish_id=de.dish_id and de.dish_id=df.dish_id and d.cate_id=cc.cate_id and d.cate_id=ce.cate_id and d.cate_id=cf.cate_id limit {$offset},{$pageSize}";
$rows=fetchAll($sql);
?>

<section class="content" id="content_menu">
	<nav>
		<div id="categorybox" class="cat_sidebar">
			<table id="category">
				<tr><td id="0" class="on" data-page='1' data-cateid='' >全部</td></tr>					
				<?php 
					if($cateids){
						$i=1;
						foreach ($cateids as $cateid):						
				?>											
				<tr><td id="<?php echo $i;?>" data-page='1' <?php echo "data-cateid='{$cateid['cate_id']}'";?> ><?php echo $cateid['cate_name_cn'] ?></td></tr>
				<?php $i++; endforeach; }?>
			</table>
			<div class="dot_curr"></div>			
		</div>

	</nav><div id="gallery">
		<ul id="dishbox" class="wrap">
			<?php if($rows){
				foreach ($rows as $row):
				$dishImg = getFirstImgByDishId ( $row ['dish_id'] );
				//if ($dishImg) {
			?>
				<li class="pic">
					<img src="./image_350/<?php echo $dishImg['album_path']?>"
						alt="<?php echo $row['dish_name_cn']?>" <?php echo "data-dishid='{$row['dish_id']}'";?> />
					<div class="info" <?php echo "data-dishid='{$row['dish_id']}'";?> >
						<div class="visible_area">
							<span class="left"><?php echo $row['dish_name_cn']?></span>
							<span class="right"><?php echo "$&nbsp;".$row['current_price']; ?></span>
						</div>
					</div>
				</li>			
			<?php //}?>	
			<?php endforeach;?>	
		</ul>
			<?php	if ($totalRows > $pageSize) {					
					echo "<div class='pagebox'>" . showPage3 ( $page, $totalPage )."</div>";
				}			
			}else{
				echo "<h4>对不起，没有找到您需要的菜品 </h4>";
			}
			?>
	</div>
	<!-- <script>
console.log($("#gallery").css("height"));
	$('#content_menu').css("height",$('#gallery').height()+"px");
		console.log($('#content_menu').css("height"));
	</script> -->
	<!--</div>
	<div style="clear:both;"></div>-->
</section>