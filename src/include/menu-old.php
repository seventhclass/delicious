<?php 
require_once './include.php';

$pageSize=5;
$page = $_REQUEST ['page'] ? ( int ) $_REQUEST ['page'] : 1;
$sql="select d.dish_id,dc.dish_name as 'dish_name_cn',de.dish_name as 'dish_name_en',df.dish_name as 'dish_name_fr',d.dish_no,d.dish_num,d.reg_price,d.current_price,d.dish_time,d.is_show,d.is_hot,d.is_spicy,cc.cate_name as 'cate_name_cn', ce.cate_name as 'cate_name_en',cf.cate_name as 'cate_name_fr', dc.dish_desc as 'dish_desc_cn',de.dish_desc as 'dish_desc_en',df.dish_desc as 'dish_desc_fr' from dish as d, dish_cn as dc, dish_en as de, dish_fr as df, cate_cn as cc, cate_en as ce, cate_fr as cf where d.dish_id=dc.dish_id and dc.dish_id=de.dish_id and de.dish_id=df.dish_id and d.cate_id=cc.cate_id and d.cate_id=ce.cate_id and d.cate_id=cf.cate_id";
$totalRows=getResultNum($sql);
$totalPage=ceil($totalRows/$pageSize);
if ($page < 1 || $page == null || ! is_numeric ( $page )) {
	$page = 1;
}
if ($page >= $totalPage)
	$page = $totalPage;
$offset=($page-1)*$pageSize;

$sql="select d.dish_id,dc.dish_name as 'dish_name_cn',de.dish_name as 'dish_name_en',df.dish_name as 'dish_name_fr',d.dish_no,d.dish_num,d.reg_price,d.current_price,d.dish_time,d.is_show,d.is_hot,d.is_spicy,cc.cate_name as 'cate_name_cn', ce.cate_name as 'cate_name_en',cf.cate_name as 'cate_name_fr', dc.dish_desc as 'dish_desc_cn',de.dish_desc as 'dish_desc_en',df.dish_desc as 'dish_desc_fr' from dish as d, dish_cn as dc, dish_en as de, dish_fr as df, cate_cn as cc, cate_en as ce, cate_fr as cf where d.dish_id=dc.dish_id and dc.dish_id=de.dish_id and de.dish_id=df.dish_id and d.cate_id=cc.cate_id and d.cate_id=ce.cate_id and d.cate_id=cf.cate_id limit {$offset},{$pageSize}";
$rows=fetchAll($sql);

//print_r($rows);	
?>

<section class="content" id="content_menu">
	<nav>
		<div><ul id="category">
			<li class="on">Appetizers</li>
			<li>Soup Meals</li>
			<li>Thaï Style</li>
			<li>Spécialités Cantonaises et Hong Kong</li>
			<li>Szechuan Style</li>
			<li>Assorted Plates</li>
		</ul></div>
	</nav>
	<div id="gallery">
		<div >
			<?php foreach ($rows as $row):?>	
			<?php 
			$dishImg=getFirstImgByDishId($row['dish_id']);
			if($dishImg){
			?>
				<div class="pic"><img style="background-color:#ccc" src="./image_350/<?php echo $dishImg['album_path']?>" alt="<?php echo $dishImg['album_path']?>"/>
					<div class="info">
						<span class="t_left"><?php echo $row['dish_name_en']?></span>
						<span class="t_right"><?php echo "CAD&nbsp;&nbsp;".$row['current_price']; ?></span>
					</div>
				</div>			
			<?php }?>	
            <?php endforeach; 
            	if($totalRows>$pageSize)
            		echo "<br/>".showPage($page, $totalPage);
            ?> 			
		</div>		
	</div>
</section>