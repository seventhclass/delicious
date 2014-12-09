<?php 
require_once '../include.php';
checkLogined();
$rows=getDishInfo();

if (! $rows) {
	alertMesg ( "没有菜品,请添加!", "addDish.php" );
	exit ();
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>菜品图片列表</title>
<link rel="stylesheet" href="styles/backstage.css">
</head>

<body>

<div class="details">
                    <div class="details_operation clearfix">
                        <div class="bui_select">
                            <input type="button" value="添&nbsp;加&nbsp;菜&nbsp;品" class="add" onclick="addDish()">
                        </div>
                        <div class="fr">
                            <div class="text">
                                <span>菜品价格：</span>
                                <div class="bui_select">
                                    <select id="" class="select" onchange="change(this.value)">
                                    	<option>-请选择-</option>
                                        <option value="iPrice asc" >由低到高</option>
                                        <option value="iPrice desc">由高到底</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text">
                                <span>上架时间：</span>
                                <div class="bui_select">
                                 <select id="" class="select" onchange="change(this.value)">
                                 	<option>-请选择-</option>
                                        <option value="pubTime desc" >最新发布</option>
                                        <option value="pubTime asc">历史发布</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text">
                                <span>搜索</span>
                                <input type="text" value="" class="search"  id="search" onkeypress="search()" >
                            </div>
                        </div>
                    </div>
                    <!--表格-->                    
                    <table class="table" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th width="10%">编号</th>
                                <th width="20%">菜品名称</th>
                                <th>菜品图片</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($rows as $row):?>
                            <tr>
                                <!--这里的id和for里面的c1 需要循环出来-->
                                <td><input  type="checkbox" id="c<?php echo $row['dish_id'];?>" class="check" value=<?php echo $row['dish_id'];?>><label for="c1" class="label"><?php echo $row['dish_id'];?></label></td>                                
                                <td><?php echo $row['dish_name_cn']; ?></td>                              
								<td>
	                        			<?php 
	                        			$dishImgs=getAllImgByDishId($row['dish_id']);	 
	                        			if($dishImgs){                       			
	                        			foreach($dishImgs as $img):		                        			                       		
	                        			?>
	                        			<img class="dishimg" onclick="delImg(<?php echo $img['id'];?>)" width="100" height="100" src="../image_220/<?php echo $img['album_path'];?>" alt=""/>&nbsp;&nbsp;
	                        			<?php endforeach;}?>
                        		</td>			             
					             <td>						                                            			           
					             	<input type="button" value="添加文字水印" onclick="doImg('<?php echo $row['dish_id'];?>','waterText')" class="btn"/>					             	
					             	<br/><br/>			             
					             	<input type="button" value="添加图片水印" onclick="doImg('<?php echo $row['dish_id'];?>','waterPic')" class="btn"/>
									<br/><br/>					             
					             	<input type="button" value="添加新图片"  onclick="appendImg('<?php echo $row['dish_id'];?>')" class="btn"/>					             	
					             </td>					              
                            </tr>
                        <?php  endforeach;?>
                        </tbody>
                    </table>
                </div>
 <script type="text/javascript">
		function addDish(){
			window.location='addDish.php';
		}
 		function doImg(id,act){
			window.location="doAdminAction.php?act="+act+"&id="+id;
 	 	}
 	 	function appendImg(id){
 	 		window.location="appendImage.php?id="+id;
 	 	}
 		function delImg(id){
 			if(window.confirm("您确认要删除嘛？添加一次不容易，且删且珍惜!")){
 				window.location="doAdminAction.php?act=delDishImage&id="+id;
 			}
 		} 	 	
 </script>
</body>
</html>