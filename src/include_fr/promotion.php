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
<?php 
	$counter = 0;
	foreach ($rows as $row) {
		$counter ++;  //give a number for each promotion
		$promImgs=getAllImgByPromId($row['prom_id']);
		
		if($promImgs){
			foreach($promImgs as $key=>$promImg){
				if($imgList)
					$imgList .= " ";
				
				$imgList .= $promImg['album_path'];
			}
		}
?>
<!--<div class="description_info comWidth">-->
	<div class="description clearfix">
		<div class="leftArea">
			<!--<div class="description_imgs">-->
				<div class="big" id="<?php echo 'big'.$counter ?>" data-bigid="<?php echo $counter ?>">
           			 <img class="big_img" src="./image_350/<?php  echo $promImgs[0]['album_path'];?>"  title="<?php echo $row['title_fr'];?>">
				</div>
				<div class="des_smimg clearfix">
					<div id="icon_wrap">
<!-- 						<i class="p_back"></i> -->
<!-- 						<i class="p_forward"></i> -->
							<a href="javascript:;"><i class="icon_back icon_back<?php echo $row['prom_id'];?>" data-index="0" data-promid="<?php echo $row['prom_id'];?>" data-imgs="<?php echo $imgList;?>">&#xe610;</i> </a>
							<a href="javascript:;"><i class="icon_forward icon_forward<?php echo $row['prom_id'];?>" data-index="0" data-promid="<?php echo $row['prom_id'];?>" data-imgs="<?php echo $imgList;?>">&#xe611;</i></a>
					</div>
					
					<ul  class="thumblist thumb<?php echo $row['prom_id'];?>" id="<?php echo 'thumblist'.$counter ?>" data-listid="<?php echo $counter ?>">
						<?php foreach($promImgs as $key=>$promImg):?>
						<li>
							<img src="./image_50/<?php echo $promImg['album_path'];?>" alt="">
						</li>
						<?php endforeach;?>
					</ul>
					
				</div>
			</div>
		<!--</div>-->
		<div class="rightArea">
			<div class="des_content">
				<h3 class="des_content_tit"><?php echo $row['title_fr'];?></h3>
				<div class="dl clearfix">
					<div class="dt">Valide Period:</div>
					<div class="dd clearfix"><?php echo "Dpuis ".date("Y-m-d ",$row['start_time'])." à ".date("Y-m-d.",$row['end_time']);?></div>				
				</div>
				<div class="dl clearfix">
					<div class="dt">Détail:</div>
					<div class="dd clearfix"><?php echo $row['content_fr'];?></div>
				</div>
				<div class="dl clearfix">
				<div class="dt">Plat:</div><br/>				
					<div class="dd clearfix">
						<?php 
							if($row['dish_id']){
								$dishInfo=getDishById($row['dish_id']);
								$promImgs=getAllImgByDishId($row['dish_id']);
								$cateInfo=getCateById($dishInfo['cate_id']);
						?>
						<div class="dt">Nom de Plat:</div>
						<div class="dd clearfix dishdetail" <?php echo "data-dishid='{$row['dish_id']}'";?> >
							<u><span id="<?php echo $row['dish_id'];?>" <?php echo "data-dishid='{$row['dish_id']}'";?> ><?php echo $dishInfo['dish_name_fr'];?></span></u>
						</div>
						<div class="dt">Galerie:</div>
						<div class="dd clearfix">
							<?php echo $cateInfo['cate_name_fr'];?>
						</div>
<!-- 						<div class="dt">菜品编号</div> -->
<!-- 						<div class="dd clearfix"> -->
							<?php //echo $dishInfo['dish_no'];?>
<!-- 						</div> -->
<!-- 						<div class="dt">数&nbsp;&nbsp;&nbsp;&nbsp;量</div> -->
<!-- 						<div class="dd clearfix"> -->
							<?php //echo $dishInfo['dish_num'];?>
<!-- 						</div> -->
						<div class="dt">Prix Actual:</div>
						<div class="dd clearfix des_money">
							<?php echo $dishInfo['current_price']." $";?>
						</div>
						<div class="dt">Prix Régulier:</div>
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