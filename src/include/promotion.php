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
<div class="description_info comWidth">
	<div class="description clearfix">
		<div class="leftArea">
			<div class="description_imgs">
				<div class="big">
					<a href="./image_800/<?php echo  $promImgs[0]['album_path'];?>" class="jqzoom" rel="gal<?php echo $row['prom_id'];?>"  title="triumph" >
           			 <img width="309" height="340" src="./image_350/<?php  echo $promImgs[0]['album_path'];?>"  title="triumph">
	        		</a>
				</div>
				<ul class="des_smimg clearfix" id="thumblist" >
					<?php foreach($promImgs as $key=>$promImg):?>
					<li><a class="<?php echo $key==0?"zoomThumbActive":"";?> active" href='javascript:void(0);' rel="{gallery: 'gal<?php echo $row['prom_id'];?>', smallimage: './image_350/<?php echo $promImg['album_path'];?>',largeimage: './image_800/<?php echo $promImg['album_path'];?>'}"><img src="./image_50/<?php echo $promImg['album_path'];?>" alt=""></a></li>
					<?php endforeach;?>
				</ul>
			</div>
		</div>
		<div class="rightArea">
			<div class="des_content">
				<h3 class="des_content_tit"><?php echo $row['title_cn'];?></h3>
				<div class="dl clearfix">
					<div class="dt">活动有效期</div>
					<div class="dd clearfix"><?php echo date("Y年m月d日",$row['start_time'])." 至 ".date("Y年m月d日",$row['end_time']);?></div>				
				</div>
				<div class="dl clearfix">
					<div class="dt">活动详情</div>
					<div class="dd clearfix"><?php echo $row['content_cn'];?></div>
				</div>
				<div class="dl clearfix">
					<div class="dt">促销菜品</div><br/>
					<div class="dd clearfix">
						<?php 
							if($row['dish_id']){
								$dishInfo=getDishById($row['dish_id']);
								$promImgs=getAllImgByDishId($row['dish_id']);
								$cateInfo=getCateById($dishInfo['cate_id']);
						?>
						<div class="dt">名&nbsp;&nbsp;&nbsp;&nbsp;称：</div>
						<div class="dd clearfix">
							<a href="#"><h4><?php echo $dishInfo['dish_name_cn'];?></h4></a>
						</div>
						<div class="dt">分&nbsp;&nbsp;&nbsp;&nbsp;类：</div>
						<div class="dd clearfix">
							<?php echo $cateInfo['cate_name_cn'];?>
						</div>
<!-- 						<div class="dt">菜品编号：</div> -->
<!-- 						<div class="dd clearfix"> -->
							<?php //echo $dishInfo['dish_no'];?>
<!-- 						</div> -->
<!-- 						<div class="dt">数&nbsp;&nbsp;&nbsp;&nbsp;量：</div> -->
<!-- 						<div class="dd clearfix"> -->
							<?php //echo $dishInfo['dish_num'];?>
<!-- 						</div> -->
						<div class="dt">原&nbsp;&nbsp;&nbsp;&nbsp;价：</div>
						<div class="dd clearfix">
							<?php echo $dishInfo['reg_price']." $";?>
						</div>
						<div class="dt">现&nbsp;&nbsp;&nbsp;&nbsp;价：</div>
						<div class="dd clearfix">
							<?php echo $dishInfo['current_price']." $";?>
						</div>
						<?php } ?>				
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php };?>
</section>