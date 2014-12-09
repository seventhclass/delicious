<?php 
require_once '../include.php';
checkLogined();

$pageSize=5;
$page = $_REQUEST ['page'] ? ( int ) $_REQUEST ['page'] : 1;
$sql="select slider_id,dish_id,album_path from slider_album";
$totalRows=getResultNum($sql);
$totalPage=ceil($totalRows/$pageSize);
if ($page < 1 || $page == null || ! is_numeric ( $page )) {
	$page = 1;
}
if ($page >= $totalPage)
	$page = $totalPage;
$offset=($page-1)*$pageSize;

$sql="select slider_id,dish_id,album_path from slider_album limit {$offset},{$pageSize}";
$rows = fetchAll ( $sql );
//$rows=getSliderInfo();
if (!$rows) {
	alertMesg ( "没有幻灯片,请添加!", "addSlider.php" );
	exit();
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>幻灯图片列表</title>
<link rel="stylesheet" href="styles/backstage.css">
</head>

<body>

<div class="details">   
                   <div class="details_operation clearfix">
                        <div class="bui_select">
                            <input type="button" value="添&nbsp;加&nbsp;幻&nbsp;灯&nbsp;片" class="add" onclick="addSlider()">
                        </div>
                    </div>                                       
                    <!--表格-->                    
                    <table class="table" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th width="10%">编号</th>
                                <th width="30%">幻灯图片</th>
                                <th width="15%">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($rows as $row):?>
                            <tr>
                                <!--这里的id和for里面的c1 需要循环出来-->
                                <td><input type="checkbox" id="s<?php echo $row['slider_id'];?>" class="check" value=<?php echo $row['slider_id'];?>><label for="s1" class="label"><?php echo $row['slider_id'];?></label></td>                                                           
								<td>
	                        			<?php 	 
	                        			if(!empty($row['album_path'])){    
	                        			?>
	                        				<img class="dishimg" width="100" height="100" src="../image_220/<?php echo $row['album_path'];?>" alt=""/>
	                        			<?php }?>
	                        			<?php 	 
	                        			if(empty($row['album_path'])){    
	                        				echo "<p>无图片</p>";
	                        			};	                        			                       		
	                        			?>									
                        		</td>			             
					            <td>						                                            			           				             
					            	<input type="button" value="删除幻灯片"  onclick="deleteSlider('<?php echo $row['slider_id'];?>')" class="btn"/>					             	
					            </td>		              
                            </tr>
                        <?php  endforeach;?>
						<?php if($totalRows>$pageSize): ?>
							<tr>
								<td colspan="3"><?php echo showPage($page, $totalPage);?></td>
							</tr>
						<?php endif;?>                           
                        </tbody>
                    </table>
                </div>
 <script type="text/javascript">
		function addSlider(){
			window.location='addSlider.php';
		}
 		function deleteSlider(id){
 			if(window.confirm("您确认要删除嘛？添加一次不容易，且删且珍惜!")){
 				window.location="doAdminAction.php?act=deleteSlider&id="+id;
 			}
 		} 	 	
 </script>
</body>
</html>