<?php
require_once '../include.php';

$pageSize = 5;
$page = $_REQUEST ['page'] ? ( int ) $_REQUEST ['page'] : 1;
$sql = "select * from cate_en";
$totalRows = getResultNum ( $sql );
$totalPage = ceil ( $totalRows / $pageSize );
if ($page < 1 || $page == null || ! is_numeric ( $page )) {
	$page = 1;
}
if ($page >= $totalPage)
	$page = $totalPage;
$offset = ($page - 1) * $pageSize;
$sql = "select c.cate_id 'id',c.cate_name 'cate_name_cn',e.cate_name 'cate_name_en',f.cate_name 'cate_name_fr' from cate_cn as c, cate_en as e, cate_fr as f where c.cate_id=e.cate_id and e.cate_id=f.cate_id order by c.cate_id limit {$offset},{$pageSize}";
$rows = fetchAll ( $sql );

//$rows = getCateByPage ( $page, $pageSize );
if (! $rows) {
	alertMesg ( "没有分类,请添加!", "addCate.php" );
	exit ();
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>-.-</title>
<link rel="stylesheet" href="styles/backstage.css">
</head>
<body>
	<div class="details">
		<div class="details_operation clearfix">
			<div class="bui_select">
				<input type="button" value="添&nbsp;&nbsp;加" class="add"
					onclick="addCate()">
			</div>

		</div>
		<!--表格-->
		<table class="table" cellspacing="0" cellpadding="0">
			<thead>
				<tr>
					<th width="8%">编号</th>
					<th width="15%">分类名称(中文)</th>
					<th width="30%">分类名称(English)</th>
					<th width="30%">分类名称(Francais)</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($rows as $row): ?>
				<tr>
					<!--这里的id和for里面的c1 需要循环出来-->
					<td><input type="checkbox" id="c1" class="check"><label for="c1"
						class="label"><?php echo $row['id'];?></label></td>
					<td><?php echo $row['cate_name_cn']; ?></td>
					<td><?php echo $row['cate_name_en']; ?></td>
					<td><?php echo $row['cate_name_fr']; ?></td>
					<td align="center"><input type="button" value="修改" class="btn"
						onclick="editCate(<?php echo $row['id'];?>)"><input type="button"
						value="删除" class="btn"
						onclick="delCate(<?php echo $row['id'];?>)"></td>
				</tr>
			<?php endforeach; ?>
			<?php if($totalRows>$pageSize): ?>
			<tr>
					<td colspan="5"><?php echo showPage($page, $totalPage);?></td>
				</tr>
			<?php endif;?>
			</tbody>
		</table>
	</div>
</body>
<script type="text/javascript">
	function addCate(){
		window.location="addCate.php";
	}
	function editCate(id){
		window.location="editCate.php?id="+id;
	}
	function delCate(id){
		if(window.confirm("您确定要删除吗?")){			
			window.location="doAdminAction.php?act=delCate&id="+id;
		}
	}
</script>
</html>




