<?php
require_once '../include.php';

$pageSize=12;
$page = $_REQUEST ['page'] ? ( int ) $_REQUEST ['page'] : 1;
$where_cateid = $_REQUEST ['cate_id'] ? "and d.cate_id=".$_REQUEST ['cate_id']." " : null;

$sql="select d.dish_id,dc.dish_name as 'dish_name_cn',de.dish_name as 'dish_name_en',df.dish_name as 'dish_name_fr',d.dish_no,d.dish_num,d.reg_price,d.current_price,d.dish_time,d.is_show,d.is_hot,d.is_spicy,cc.cate_name as 'cate_name_cn', ce.cate_name as 'cate_name_en',cf.cate_name as 'cate_name_fr', dc.dish_desc as 'dish_desc_cn',de.dish_desc as 'dish_desc_en',df.dish_desc as 'dish_desc_fr' from dish as d, dish_cn as dc, dish_en as de, dish_fr as df, cate_cn as cc, cate_en as ce, cate_fr as cf where d.dish_id=dc.dish_id and dc.dish_id=de.dish_id and de.dish_id=df.dish_id and d.cate_id=cc.cate_id and d.cate_id=ce.cate_id and d.cate_id=cf.cate_id {$where_cateid}";
$totalRows=getResultNum($sql);
$totalPage=ceil($totalRows/$pageSize);
if ($page < 1 || $page == null || ! is_numeric ( $page )) {
	$page = 1;
}
if ($page >= $totalPage)
	$page = $totalPage;

$offset=($page-1)*$pageSize;

$sql="select d.dish_id,dc.dish_name as 'dish_name_cn',de.dish_name as 'dish_name_en',df.dish_name as 'dish_name_fr',d.dish_no,d.dish_num,d.reg_price,d.current_price,d.dish_time,d.is_show,d.is_hot,d.is_spicy,cc.cate_name as 'cate_name_cn', ce.cate_name as 'cate_name_en',cf.cate_name as 'cate_name_fr', dc.dish_desc as 'dish_desc_cn',de.dish_desc as 'dish_desc_en',df.dish_desc as 'dish_desc_fr' from dish as d, dish_cn as dc, dish_en as de, dish_fr as df, cate_cn as cc, cate_en as ce, cate_fr as cf where d.dish_id=dc.dish_id and dc.dish_id=de.dish_id and de.dish_id=df.dish_id and d.cate_id=cc.cate_id and d.cate_id=ce.cate_id and d.cate_id=cf.cate_id {$where_cateid} limit {$offset},{$pageSize}";
$rows=fetchAll($sql);

//print_r($rows);
?>

<!DOCTYPE html >
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>菜单页</title>
	<link href="../css/dishGallery.css" type="text/css" rel="stylesheet">
	<!--<script type="text/javascript" src="../js/content.js"></script>-->
</head>
<body>
	<div id="gallery">
	<div class="wrap">
		<?php if($rows){
			foreach ($rows as $row):
			$dishImg = getFirstImgByDishId ( $row ['dish_id'] );
			//if ($dishImg) {
		?>
			<div class="pic">
			<img src="../image_350/<?php echo $dishImg['album_path']?>"
				alt="<?php echo $row['dish_name_cn']?>" />
			<div class="info">
				<span class="t_left"><?php echo $row['dish_name_cn']?></span> <span
					class="t_right"><?php echo "$&nbsp;".$row['current_price']; ?></span>
			</div>
			</div>			
		<?php //}?>	
        <?php endforeach;
			if ($totalRows > $pageSize) {
				$where = "content_id=content_menu";
				$where .= $_REQUEST ['cate_id'] ? "&cate_id=" . $_REQUEST ['cate_id'] : null;
				// var_dump($where);
				echo "<div class='pagebox'>" . showPage ( $page, $totalPage, $where )."</div>";
			}
		}else{
			echo "<h4>对不起，没有找到您需要的菜品 </h4>";
		}
		?> 			
	</div>
	</div>
</body>
</html>
