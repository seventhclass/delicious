<?php 
require_once '../include.php';
checkLogined();

$pageSize=5;
$page = $_REQUEST ['page'] ? ( int ) $_REQUEST ['page'] : 1;
$sql="select d.dish_id,dc.dish_name as 'dish_name_cn',de.dish_name as 'dish_name_en',df.dish_name as 'dish_name_fr',d.dish_no,d.dish_num,d.reg_price,d.current_price,d.dish_time,d.is_show,d.is_hot,cc.cate_name as 'cate_name_cn', ce.cate_name as 'cate_name_en',cf.cate_name as 'cate_name_fr', dc.dish_desc as 'dish_desc_cn',de.dish_desc as 'dish_desc_en',df.dish_desc as 'dish_desc_fr' from dish as d, dish_cn as dc, dish_en as de, dish_fr as df, cate_cn as cc, cate_en as ce, cate_fr as cf where d.dish_id=dc.dish_id and dc.dish_id=de.dish_id and de.dish_id=df.dish_id and d.cate_id=cc.cate_id and d.cate_id=ce.cate_id and d.cate_id=cf.cate_id";
$totalRows=getResultNum($sql);
$totalPage=ceil($totalRows/$pageSize);
if ($page < 1 || $page == null || ! is_numeric ( $page )) {
	$page = 1;
}
if ($page >= $totalPage)
	$page = $totalPage;
$offset=($page-1)*$pageSize;

$strkeys = $_REQUEST['keywords'];

if($strkeys) {
	$delimiters=array(" ",",","，");
	$keywords=splitKeyWords($delimiters,$strkeys);
	
	$sql = null;	
	foreach ($keywords as $keyword){
		if($sql==null)  
			$sql = "select d.dish_id,dc.dish_name as 'dish_name_cn',de.dish_name as 'dish_name_en',df.dish_name as 'dish_name_fr',d.dish_no,d.dish_num,d.reg_price,d.current_price,d.dish_time,d.is_show,d.is_hot,cc.cate_name as 'cate_name_cn', ce.cate_name as 'cate_name_en',cf.cate_name as 'cate_name_fr', dc.dish_desc as 'dish_desc_cn',de.dish_desc as 'dish_desc_en',df.dish_desc as 'dish_desc_fr' from dish as d, dish_cn as dc, dish_en as de, dish_fr as df, cate_cn as cc, cate_en as ce, cate_fr as cf where d.dish_id=dc.dish_id and dc.dish_id=de.dish_id and de.dish_id=df.dish_id and d.cate_id=cc.cate_id and d.cate_id=ce.cate_id and d.cate_id=cf.cate_id and concat(d.dish_id,' ',dc.dish_name,' ',de.dish_name,' ',df.dish_name,' ',d.dish_no,' ',d.dish_num,' ',d.reg_price,' ',d.current_price,' ',d.dish_time,' ',cc.cate_name,' ',ce.cate_name,' ',cf.cate_name,' ',dc.dish_desc,' ',de.dish_desc,' ',df.dish_desc) like '%{$keyword}%' ";
		else
			$sql.= "and concat(d.dish_id,' ',dc.dish_name,' ',de.dish_name,' ',df.dish_name,' ',d.dish_no,' ',d.dish_num,' ',d.reg_price,' ',d.current_price,' ',d.dish_time,' ',cc.cate_name,' ',ce.cate_name,' ',cf.cate_name,' ',dc.dish_desc,' ',de.dish_desc,' ',df.dish_desc) like '%{$keyword}%' ";		
	}
	$sql.=" limit {$offset},{$pageSize}";
	//echo "sql=".$sql."<br/>";
	$rows = fetchAll ( $sql );
	if (! $rows) {
		alertMesg ( "搜索结果: 无满足条件记录!", "listDish.php" );
		exit ();
	}	
}else{	
	
	$_REQUEST['order']?$order="order by ".$_REQUEST['order']:$order=null;
	$sql="select d.dish_id,dc.dish_name as 'dish_name_cn',de.dish_name as 'dish_name_en',df.dish_name as 'dish_name_fr',d.dish_no,d.dish_num,d.reg_price,d.current_price,d.dish_time,d.is_show,d.is_hot,cc.cate_name as 'cate_name_cn', ce.cate_name as 'cate_name_en',cf.cate_name as 'cate_name_fr', dc.dish_desc as 'dish_desc_cn',de.dish_desc as 'dish_desc_en',df.dish_desc as 'dish_desc_fr' from dish as d, dish_cn as dc, dish_en as de, dish_fr as df, cate_cn as cc, cate_en as ce, cate_fr as cf where d.dish_id=dc.dish_id and dc.dish_id=de.dish_id and de.dish_id=df.dish_id and d.cate_id=cc.cate_id and d.cate_id=ce.cate_id and d.cate_id=cf.cate_id {$order} limit {$offset},{$pageSize}";
	$rows=fetchAll($sql);
	
	//print_r($rows);
	if (! $rows) {
		alertMesg ( "没有菜品,请添加!", "addDish.php" );
		exit ();
	}
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>菜品列表</title>
<link rel="stylesheet" href="styles/backstage.css">
<link rel="stylesheet" href="scripts/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
<script src="scripts/jquery-ui/js/jquery-1.10.2.js"></script>
<script src="scripts/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
<script src="scripts/jquery-ui/js/jquery-ui-1.10.4.custom.min.js"></script>
</head>

<body>
<div id="showDetail"  style="display:none;">

</div>
<div class="details">
                    <div class="details_operation clearfix">
                        <div class="bui_select">
                            <input type="button" value="添&nbsp;&nbsp;加" class="add" onclick="addDish()">
                        </div>
                        <div class="fr">
                            <div class="text">
                                <span>菜品价格：</span>
                                <div class="bui_select">
                                    <select id="" class="select" onchange="change(this.value)">
                                    	<option>-请选择-</option>
                                        <option value="current_price asc " <?php if($_REQUEST['order']=="current_price asc"){echo "selected='selected'";}?>>由低到高</option>
                                        <option value="current_price desc " <?php if($_REQUEST['order']=="current_price desc"){echo "selected='selected'";}?>>由高到底</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text">
                                <span>上架时间：</span>
                                <div class="bui_select">
                                 <select id="" class="select" onchange="change(this.value)">
                                 	<option>-请选择-</option>
                                        <option value="dish_time desc " <?php if($_REQUEST['order']=="dish_time desc"){echo "selected='selected'";}?>>最新发布</option>
                                        <option value="dish_time asc " <?php if($_REQUEST['order']=="dish_time asc"){echo "selected='selected'";}?>>历史发布</option>
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
                                <th width="10%">菜品分类</th>
                                <th width="10%">是否上架</th>
                                <th width="15%">上架时间</th>
                                <th width="10%">菜品现价</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
						<?php foreach ($rows as $row):?>
                            <tr>
                                <!--这里的id和for里面的c1 需要循环出来-->
                                <td><input type="checkbox" id="c<?php echo $row['dish_id'];?>" class="check" value=<?php echo $row['dish_id'];?>><label for="c1" class="label"><?php echo $row['dish_id'];?></label></td>                              
                                <td>
								<?php 
									if($strkeys){
										$dish_name_cn=$row['dish_name_cn'];
										foreach ($keywords as $keyval){	
											$dish_name_cn=hightlightkeyword($dish_name_cn,$keyval);
										}
										echo $dish_name_cn;
									}
									else{
										echo $row['dish_name_cn'];
									}			
								?>                                                                  
                                </td>                                 
                                <td>
								<?php 
									if($strkeys){
										$cate_name_cn=$row['cate_name_cn'];
										foreach ($keywords as $keyval){	
											$cate_name_cn=hightlightkeyword($cate_name_cn,$keyval);
										}
										echo $cate_name_cn;
									}
									else{
										echo $row['cate_name_cn'];
									}			
								?>                                 
                                </td>
                                <td>
                                	<?php echo $row['is_show']==1?"上架":"下架";?>
                                </td>
                                <td><?php echo date("Y-m-d H:i:s",$row['dish_time']);?></td>                                  
                                <td>
								<?php 
									if($strkeys){
										$current_price=$row['current_price'];
										foreach ($keywords as $keyval){	
											$current_price=hightlightkeyword($current_price,$keyval);
										}
										echo $current_price."元";
									}
									else{
										echo $row['current_price']."元";
									}			
								?>                                   
                                </td>
                                <td align="center">
                                				<input type="button" value="详情" class="btn" onclick="showDetail(<?php echo $row['dish_id'];?>,'<?php echo $row['dish_name_cn'];?>')"><input type="button" value="修改" class="btn" onclick="editDish(<?php echo $row['dish_id'];?>)"><input type="button" value="删除" class="btn"onclick="delDish(<?php echo $row['dish_id'];?>)">
					                            <div id="showDetail<?php echo $row['dish_id'];?>" style="display:none;">
					                        	<table class="table" cellspacing="0" cellpadding="0">
					                        		<tr>
					                        			<td width="20%" align="right">菜品名称(中文)</td>					                        			
					                        			<td>
														<?php 
															if($strkeys){
																$dish_name_cn=$row['dish_name_cn'];
																foreach ($keywords as $keyval){																																			
																	$dish_name_cn=hightlightkeyword($dish_name_cn,$keyval);																	
																}
																echo $dish_name_cn;
															}
															else{
																echo $row['dish_name_cn'];
															}			
														?>  					                        			
					                        			</td>
					                        		</tr>
					                        		<tr>
					                        			<td width="20%" align="right">菜品名称(English)</td>														 					                        		
					                        			<td>
					                        			<?php 
															if($strkeys){
																$dish_name_en=$row['dish_name_en'];
																foreach ($keywords as $keyval){																		
																	$dish_name_en=hightlightkeyword($dish_name_en,$keyval);
																}
																echo $dish_name_en;
															}
															else{
																echo $row['dish_name_en'];
															}			
														?>  
					                        			</td>
					                        		</tr>	
					                        		<tr>
					                        			<td width="20%" align="right">菜品名称(Francais)</td>																	                        		
					                        			<td>
					                        			<?php 
															if($strkeys){
																$dish_name_fr=$row['dish_name_fr'];																
																foreach ($keywords as $keyval){	
																	$dish_name_fr=hightlightkeyword($dish_name_fr,$keyval);
																}
																echo $dish_name_fr;
															}
															else{
																echo $row['dish_name_fr'];
															}			
														?> 
					                        			</td>
					                        		</tr>						                        						                        		
					                        		<tr>
					                        			<td width="20%"  align="right">菜品类别(中文)</td> 						                        			
					                        			<td>
					                        			<?php 
															if($strkeys){
																$cate_name_cn=$row['cate_name_cn'];
																foreach ($keywords as $keyval){																
																	$cate_name_cn=hightlightkeyword($cate_name_cn,$keyval);
																}
																echo $cate_name_cn;
															}
															else{
																echo $row['cate_name_cn'];
															}			
														?>
					                        			</td>
					                        		</tr>
					                        		<tr>
					                        			<td width="20%"  align="right">菜品类别(English)</td>
					                        			<td>
					                        			<?php 
															if($strkeys){
																$cate_name_en=$row['cate_name_en'];
																foreach ($keywords as $keyval){	
																	$cate_name_en=hightlightkeyword($cate_name_en,$keyval);
																}
																echo $cate_name_en;
															}
															else{
																echo $row['cate_name_en'];
															}			
														?>
					                        			</td>
					                        		</tr>
					                        		<tr>
					                        			<td width="20%"  align="right">菜品类别(Francais)</td>																				                        			
					                        			<td>
					                        			<?php 
															if($strkeys){
																$cate_name_fr=$row['cate_name_fr'];
																foreach ($keywords as $keyval){	
																	$cate_name_fr=hightlightkeyword($cate_name_fr,$keyval);
																}
																echo $cate_name_fr;
															}
															else{
																echo $row['cate_name_fr'];
															}			
														?>
					                        			</td>
					                        		</tr>					                        							                        		
					                        		<tr>
					                        			<td width="20%"  align="right">菜品货号</td>																			                        			
					                        			<td>
					                        			<?php 
															if($strkeys){
																$dish_no=$row['dish_no'];
																foreach ($keywords as $keyval){	
																	$dish_no=hightlightkeyword($dish_no,$keyval);
																}
																echo $dish_no;
															}
															else{
																echo $row['dish_no'];
															}			
														?>
					                        			</td>
					                        		</tr>
					                        		<tr>
					                        			<td width="20%"  align="right">菜品数量</td>																				                        			
					                        			<td>
					                        			<?php 
															if($strkeys){
																$dish_num=$row['dish_num'];
																foreach ($keywords as $keyval){	
																	$dish_num=hightlightkeyword($dish_num,$keyval);
																}
																echo $dish_num;
															}
															else{
																echo $row['dish_num'];
															}			
														?>
					                        			</td>
					                        		</tr>
					                        		<tr>
					                        			<td  width="20%"  align="right">菜品原价</td>																	                        			
					                        			<td>
					                        			<?php 
															if($strkeys){
																$reg_price=$row['reg_price'];
																foreach ($keywords as $keyval){	
																	$reg_price=hightlightkeyword($reg_price,$keyval);
																}
																echo $reg_price;
															}
															else{
																echo $row['reg_price'];
															}			
														?>
					                        			</td>
					                        		</tr>
					                        		<tr>
					                        			<td  width="20%"  align="right">菜品现价</td>																			                        			
					                        			<td>
					                        			<?php 
															if($strkeys){
																$current_price=$row['current_price'];
																foreach ($keywords as $keyval){	
																	$current_price=hightlightkeyword($current_price,$keyval);
																}
																echo $current_price;
															}
															else{
																echo $row['current_price'];
															}			
														?>
					                        			</td>
					                        		</tr>
					                        		<tr>
					                        			<td width="20%"  align="right">菜品图片</td>
					                        			<td>
															<?php 
															$dishImg=getAllImgByDishId($row['dish_id']);
															if($dishImg){
																foreach ($dishImg as $img):															
															?>
															<img width="100" height="100" src="../image_220/<?php echo $img['album_path'];?>" alt=""/> &nbsp;&nbsp;
															<?php endforeach; }?>
															<?php 
																if(!$dishImg){
																	echo "<p>无图片</p>";
																}
															?>
					                        			</td>
					                        		</tr>
					                        		<tr>
					                        			<td width="20%"  align="right">是否上架</td>
					                        			<td>
					                        				<?php echo $row['is_show']==1?"上架":"下架";?>
					                        			</td>
					                        		</tr>
					                        		<tr>
					                        			<td width="20%"  align="right">是否热卖</td>
					                        			<td>
					                        				<?php echo $row['is_hot']==1?"热卖":"正常";?>
					                        			</td>
					                        		</tr>
													<tr>
														<td width="20%"  align="right">菜品描述(中文)</td>													 														
					                        			<td>	
					                        			<?php 
															if($strkeys){
																$dish_desc_cn=$row['dish_desc_cn'];
																foreach ($keywords as $keyval){	
																	$dish_desc_cn=hightlightkeyword($dish_desc_cn,$keyval);
																}
																echo $dish_desc_cn;
															}
															else{
																echo $row['dish_desc_cn'];
															}			
														?>					                        							                        	
					                        			</td>
					                        		</tr>
													<tr>
														<td width="20%"  align="right">菜品描述(English)</td>																											
					                        			<td>
					                        			<?php 
															if($strkeys){
																$dish_desc_en=$row['dish_desc_en'];
																foreach ($keywords as $keyval){	
																	$dish_desc_en=hightlightkeyword($dish_desc_en,$keyval);
																}
																echo $dish_desc_en;
															}
															else{
																echo $row['dish_desc_en'];
															}			
														?>					                        	
					                        			</td>					                        			
					                        		</tr>
													<tr>
														<td width="20%"  align="right">菜品描述(Francais)</td>														 														
					                        			<td>
					                        			<?php 
															if($strkeys){
																$dish_desc_fr=$row['dish_desc_fr'];
																foreach ($keywords as $keyval){	
																	$dish_desc_fr=hightlightkeyword($dish_desc_fr,$keyval);
																}
																echo $dish_desc_fr;
															}
															else{
																echo $row['dish_desc_fr'];
															}			
														?>					                        	
					                        			</td>
					                        		</tr>					                        							                        		
					                        	</table>					                        					                        						                        	
					                        </div>
                                
                                </td>
                            </tr>
                 		<?php endforeach;?>
						<?php if($totalRows>$pageSize): ?>
						<tr>
								<td colspan="5"><?php echo showPage($page, $totalPage);?></td>
							</tr>
						<?php endif;?>                 		
                        </tbody>
                    </table>
                </div>
<script type="text/javascript">
function showDetail(id,t){
	$("#showDetail"+id).dialog({
		  height:"auto",
	      width: "auto",
	      position: {my: "center", at: "center",  collision:"fit"},
	      modal:false,//是否模式对话框
	      draggable:true,//是否允许拖拽
	      resizable:true,//是否允许拖动
	      title:"菜品名称："+t,//对话框标题
	      show:"slide",
	      hide:"explode"
	});
}
	function addDish(){
		window.location='addDish.php';
	}
	function editDish(id){
		window.location='editDish.php?id='+id;
	}
	function delDish(id){
		if(window.confirm("您确认要删除嘛？添加一次不易，且删且珍惜!")){
			window.location="doAdminAction.php?act=delDish&id="+id;
		}
	}
	function search(){
		if(event.keyCode==13){
			var val=document.getElementById("search").value;
			window.location="listDish.php?keywords="+val;
		}
	}
	function change(val){
		window.location="listDish.php?order="+val;
	}
</script>
</body>
</html>