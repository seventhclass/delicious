<?php 
require_once '../include.php';
checkLogined();

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

$strkeys = $_REQUEST['keywords'];

if($strkeys) {
	$delimiters=array(" ",",","，");
	$keywords=splitKeyWords($delimiters,$strkeys);
	
	$sql = null;	
	foreach ($keywords as $keyword){
		if($sql==null)  
			$sql = "select p.prom_id,pc.title_cn,pe.title_en,pf.title_fr,p.start_time,p.end_time,pc.content_cn,pe.content_en,pf.content_fr,p.dish_id from promotion as p, promotion_cn as pc, promotion_en as pe, promotion_fr as pf where p.prom_id=pc.prom_id and pc.prom_id=pe.prom_id and pe.prom_id=pf.prom_id and concat(pc.title_cn,' ',pe.title_en,' ',pf.title_fr,' ',p.start_time,' ',p.end_time,' ',pc.content_cn,' ',pe.content_en,' ',pf.content_fr) like '%{$keyword}%' ";
		else
			$sql.= "and concat(pc.title_cn,' ',pe.title_en,' ',pf.title_fr,' ',p.start_time,' ',p.end_time,' ',pc.content_cn,' ',pe.content_en,' ',pf.content_fr) like '%{$keyword}%' ";		
	}
	$sql.=" limit {$offset},{$pageSize}";
	//echo "sql=".$sql."<br/>";
	$rows = fetchAll ( $sql );
	if (! $rows) {
		alertMesg ( "搜索结果: 无满足条件记录!", "listPromotion.php" );
		exit ();
	}	
}else{	
	
	$_REQUEST['order']?$order="order by ".$_REQUEST['order']:$order=null;
	$sql="select p.prom_id,pc.title_cn,pe.title_en,pf.title_fr,p.start_time,p.end_time,pc.content_cn,pe.content_en,pf.content_fr,p.dish_id from promotion as p, promotion_cn as pc, promotion_en as pe, promotion_fr as pf where p.prom_id=pc.prom_id and pc.prom_id=pe.prom_id and pe.prom_id=pf.prom_id {$order} limit {$offset},{$pageSize}";
	//echo "sql=".$sql;
	$rows=fetchAll($sql);
	
	//print_r($rows);
	if (! $rows) {
		alertMesg ( "没有促销活动,请添加!", "addPromotion.php" );
		exit ();
	}
}

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>促销活动列表</title>
<link rel="stylesheet" href="styles/backstage.css">
<link rel="stylesheet" href="scripts/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
<script src="scripts/jquery-ui/js/jquery-1.10.2.js"></script>
<script src="scripts/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
<script src="scripts/jquery-ui/js/jquery-ui-1.10.4.custom.min.js"></script>
</head>

<body>
<div id="showDetail"  style="display:none;"></div>
<div class="details">
                    <div class="details_operation clearfix">
                        <div class="bui_select"><input type="button" value="添&nbsp;&nbsp;加" class="add" onclick="addPromotion()"></div>
                        <div class="fr">
                            <div class="text">
                                <span>促销起始日期：</span>
                                <div class="bui_select">
                                 <select  class="select" onchange="change(this.value)">
                                 	<option>-请选择-</option>
                                        <option value="start_time desc " <?php if($_REQUEST['order']=="start_time desc"){echo "selected='selected'";}?>>由远至近</option>
                                        <option value="start_time asc " <?php if($_REQUEST['order']=="start_time asc"){echo "selected='selected'";}?>>由近至远</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text">
                                <span>促销结束日期：</span>
                                <div class="bui_select">
                                 <select  class="select" onchange="change(this.value)">
                                 	<option>-请选择-</option>
                                        <option value="end_time desc " <?php if($_REQUEST['order']=="end_time desc"){echo "selected='selected'";}?>>由远至近</option>
                                        <option value="end_time asc " <?php if($_REQUEST['order']=="end_time asc"){echo "selected='selected'";}?>>由近至远</option>
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
                                <th width="20%">促销标题名称</th>
                                <th width="10%">起始日期</th>
                                <th width="10%">结束日期</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
						<?php foreach ($rows as $row):?>
                            <tr>
                                <td><input type="checkbox" id="p<?php echo $row['prom_id'];?>" class="check" value=<?php echo $row['prom_id'];?>><label for="p1" class="label"><?php echo $row['prom_id'];?></label></td>                              
                                <td>                                
								<?php 
									if($strkeys){
										$title_cn=$row['title_cn'];
										foreach ($keywords as $keyval){	
											$title_cn=hightlightkeyword($title_cn,$keyval);
										}
										echo $title_cn;
									}
									else{
										echo $row['title_cn'];
									}			
								?>                                                                  
                                </td>                                 
                                <td>                                
								<?php 
									if($strkeys){
										$start_time=date("Y-m-d",$row['start_time']);
										foreach ($keywords as $keyval){	
											$start_time=hightlightkeyword($start_time,$keyval);
										}
										echo $start_time;
									}
									else{
										echo date("Y-m-d",$row['start_time']);
									}			
								?>                                 
                                </td>
                                <td>                                
								<?php 
									if($strkeys){
										$end_time=date("Y-m-d",$row['end_time']);
										foreach ($keywords as $keyval){	
											$end_time=hightlightkeyword($end_time,$keyval);
										}
										echo $end_time;
									}
									else{
										echo date("Y-m-d",$row['end_time']);
									}			
								?>                                 
                                </td>
                                <td align="center">
                                				<input type="button" value="详情" class="btn" onclick="showDetail(<?php echo $row['prom_id'];?>,'<?php echo $row['title_cn'];?>')"><input type="button" value="修改" class="btn" onclick="editPromotion(<?php echo $row['prom_id'];?>)"><input type="button" value="删除" class="btn" onclick="delPromotion(<?php echo $row['prom_id'];?>)">
					                            <div id="showDetail<?php echo $row['prom_id'];?>" style="display:none;">
					                        	<table class="table" cellspacing="0" cellpadding="0">				                        	
					                        		<tr>
					                        			<td width="20%" align="right">促销标题名称(中文)</td>					                        			
					                        			<td>
														<?php 
															if($strkeys){
																$title_cn=$row['title_cn'];
																foreach ($keywords as $keyval){																																			
																	$title_cn=hightlightkeyword($title_cn,$keyval);																	
																}
																echo $title_cn;
															}
															else{
																echo $row['title_cn'];
															}			
														?>  					                        			
					                        			</td>
					                        		</tr>
					                        		<tr>
					                        			<td width="20%" align="right">促销标题名称(English)</td>														 					                        		
					                        			<td>
					                        			<?php 
															if($strkeys){
																$title_en=$row['title_en'];
																foreach ($keywords as $keyval){																		
																	$title_en=hightlightkeyword($title_en,$keyval);
																}
																echo $title_en;
															}
															else{
																echo $row['title_en'];
															}			
														?>  
					                        			</td>
					                        		</tr>						                        		
					                        		<tr>
					                        			<td width="20%" align="right">促销标题名称(Francais)</td>																	                        		
					                        			<td>
					                        			<?php 
															if($strkeys){
																$title_fr=$row['title_fr'];																
																foreach ($keywords as $keyval){	
																	$title_fr=hightlightkeyword($title_fr,$keyval);
																}
																echo $title_fr;
															}
															else{
																echo $row['title_fr'];
															}			
														?> 
					                        			</td>
					                        		</tr>						                        						                        		
					                        		<tr>
					                        			<td width="20%"  align="right">促销图片</td>
					                        			<td>
															<?php 
															$promImg=getAllImgByPromId($row['prom_id']);
															if($promImg){
																foreach ($promImg as $img):															
															?>
															<img width="100" height="100" src="../image_220/<?php echo $img['album_path'];?>" alt=""/> &nbsp;&nbsp;
															<?php endforeach; }?>
															<?php 
																if(!$promImg){
																	echo "<p>无图片</p>";
																}
															?>
					                        			</td>
					                        		</tr>				         
													<tr>
														<td width="20%"  align="right">促销内容描述(中文)</td>													 														
					                        			<td>	
					                        			<?php 
															if($strkeys){
																$content_cn=$row['content_cn'];
																foreach ($keywords as $keyval){	
																	$content_cn=hightlightkeyword($content_cn,$keyval);
																}
																echo $content_cn;
															}
															else{
																echo $row['content_cn'];
															}			
														?>					                        							                        	
					                        			</td>
					                        		</tr>
													<tr>
														<td width="20%"  align="right">促销内容描述(English)</td>																											
					                        			<td>
					                        			<?php 
															if($strkeys){
																$content_en=$row['content_en'];
																foreach ($keywords as $keyval){	
																	$content_en=hightlightkeyword($content_en,$keyval);
																}
																echo $content_en;
															}
															else{
																echo $row['content_en'];
															}			
														?>					                        	
					                        			</td>					                        			
					                        		</tr>
													<tr>
														<td width="20%"  align="right">促销内容描述(Francais)</td>														 														
					                        			<td>
					                        			<?php 
															if($strkeys){
																$content_fr=$row['content_fr'];
																foreach ($keywords as $keyval){	
																	$content_fr=hightlightkeyword($content_fr,$keyval);
																}
																echo $content_fr;
															}
															else{
																echo $row['content_fr'];
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
	function addPromotion(){
		window.location='addPromotion.php';
	}
	function editPromotion(id){
		window.location='editPromotion.php?id='+id;
	}
	function delPromotion(id){
		if(window.confirm("您确认要删除嘛？添加一次不易，且删且珍惜!")){
			window.location="doAdminAction.php?act=delPromotion&id="+id;
		}
	}
	function search(){
		if(event.keyCode==13){
			var val=document.getElementById("search").value;
			window.location="listPromotion.php?keywords="+val;
		}
	}
	function change(val){
		window.location="listPromotion.php?order="+val;
	}
	function showDetail(id,t){
		$("#showDetail"+id).dialog({
			  height:"auto",
		      width: "auto",
		      position: {my: "center", at: "center",  collision:"fit"},
		      modal:false,//是否模式对话框
		      draggable:true,//是否允许拖拽
		      resizable:true,//是否允许拖动
		      title:"促销标题名称："+t,//对话框标题
		      show:"slide",
		      hide:"explode"
		});
	}	
</script>
</body>
</html>