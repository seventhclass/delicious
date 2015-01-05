<?php 
require_once './include.php';

$pageSize=5;
$page = $_REQUEST ['page'] ? ( int ) $_REQUEST ['page'] : 1;
$sql="select * from promotion";
$totalRows=getResultNum($sql);
$totalPage=ceil($totalRows/$pageSize);
if ($page < 1 || $page == null || ! is_numeric ( $page )) {
	$page = 1;
}
if ($page >= $totalPage)
	$page = $totalPage;
$offset=($page-1)*$pageSize;

$sql="select p.prom_id,pc.title_cn,pe.title_en,pf.title_fr,p.start_time,p.end_time,pc.content_cn,pe.content_en,pf.content_fr,p.dish_id from promotion as p, promotion_cn as pc, promotion_en as pe, promotion_fr as pf where p.prom_id=pc.prom_id and pc.prom_id=pe.prom_id and pe.prom_id=pf.prom_id limit {$offset},{$pageSize}";
$rows=fetchAll($sql);

?>

<section class="content" id="content_promotion">
<?php foreach ($rows as $row) {
	$promImgs=getAllImgByPromId($row['prom_id']);
?>
<!--<div class="description_info comWidth">-->
	<div class="description clearfix">
		<div class="leftArea">
			<!--<div class="description_imgs">-->
				<div class="big">
           			 <img src="./image_350/<?php  echo $promImgs[0]['album_path'];?>"  title="<?php echo $row['title_en'];?>">
				</div>
				<div class="des_smimg clearfix">
					<i class="p_back"></i>
					<ul  id="thumblist" >
						<?php foreach($promImgs as $key=>$promImg):?>
						<li><a class="<?php echo $key==0?"zoomThumbActive":"";?> active" href='javascript:void(0);' rel="{gallery: 'gal<?php echo $row['prom_id'];?>', smallimage: './image_350/<?php echo $promImg['album_path'];?>',largeimage: './image_800/<?php echo $promImg['album_path'];?>'}">
							<img src="./image_50/<?php echo $promImg['album_path'];?>" alt="">
						</a></li>
						<?php endforeach;?>
					</ul>
					<i class="p_forward"></i>
				</div>
			</div>
		<!--</div>-->
		<div class="rightArea">
			<div class="des_content">
				<h3 class="des_content_tit"><?php echo $row['title_en'];?></h3>
				<div class="dl clearfix">
					<div class="dt">Valide Period</div>
					<div class="dd clearfix"><?php echo "From ".date("Y-m-d ",$row['start_time'])." to ".date("Y-m-d.",$row['end_time']);?></div>				
				</div>
				<div class="dl clearfix">
					<div class="dt">Detail</div>
					<div class="dd clearfix"><?php echo $row['content_en'];?></div>
				</div>
				<div class="dl clearfix">
					<div class="dt">Dish</div><br/>
					<div class="dd clearfix">
						<?php 
							if($row['dish_id']){
								$dishInfo=getDishById($row['dish_id']);
								$promImgs=getAllImgByDishId($row['dish_id']);
								$cateInfo=getCateById($dishInfo['cate_id']);
						?>
						<div class="dt">Dish Name：</div>
						<div class="dd clearfix">
							<a href="javascript:;" id="<?php echo $row['dish_id'];?>">
								<?php echo $dishInfo['dish_name_en'];?>
							</a>
						</div>
						<div class="dt">Category：</div>
						<div class="dd clearfix">
							<?php echo $cateInfo['cate_name_en'];?>
						</div>
<!-- 						<div class="dt">菜品编号：</div> -->
<!-- 						<div class="dd clearfix"> -->
							<?php //echo $dishInfo['dish_no'];?>
<!-- 						</div> -->
<!-- 						<div class="dt">数&nbsp;&nbsp;&nbsp;&nbsp;量：</div> -->
<!-- 						<div class="dd clearfix"> -->
							<?php //echo $dishInfo['dish_num'];?>
<!-- 						</div> -->
						<div class="dt">Current Price：</div>
						<div class="dd clearfix des_money">
							<?php echo $dishInfo['current_price']." $";?>
						</div>
						<div class="dt">Regular Price：</div>
						<div class="dd clearfix des_money"><em>
							<?php echo $dishInfo['reg_price']." $";?></em>
						</div>
						<?php } ?>				
					</div>
				</div>
			</div>
		</div>
	</div>
<!--</div>-->
<?php };?>
</section>