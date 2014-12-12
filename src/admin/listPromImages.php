<?php 
require_once '../include.php';
checkLogined();

$pageSize=20;
$page = $_REQUEST ['page'] ? ( int ) $_REQUEST ['page'] : 1;

$strkeys = $_REQUEST['keywords'];

if($strkeys) {
	$delimiters=array(" ",",","，");
	$keywords=splitKeyWords($delimiters,$strkeys);

	$sql = null;
	foreach ($keywords as $keyword){
		if($sql==null)
			$sql = "select p.prom_id,pc.title_cn,pe.title_en,pf.title_fr,p.start_time,p.end_time,pc.content_cn,pe.content_en,pf.content_fr,p.dish_id from promotion as p, promotion_cn as pc, promotion_en as pe, promotion_fr as pf where p.prom_id=pc.prom_id and pc.prom_id=pe.prom_id and pe.prom_id=pf.prom_id and concat(pc.title_cn,' ',p.start_time,' ',p.end_time) like '%{$keyword}%' ";
		else
			$sql.= "and concat(pc.title_cn,' ',p.start_time,' ',p.end_time) like '%{$keyword}%' ";
	}
	
	$totalRows=getResultNum($sql);
	$totalPage=ceil($totalRows/$pageSize);
	if ($page < 1 || $page == null || ! is_numeric ( $page )) {
		$page = 1;
	}
	if ($page >= $totalPage)
		$page = $totalPage;
	$offset=($page-1)*$pageSize;
		
	$sql.=" limit {$offset},{$pageSize}";
	//echo "sql=".$sql."<br/>";
	$rows = fetchAll ( $sql );
	if (! $rows) {
		alertMesg ( "搜索结果: 无满足条件记录!", "listPromImages.php" );
		exit ();
	}	
}else{

	$_REQUEST['order']?$order="order by ".$_REQUEST['order']:$order=null;
	$sql="select p.prom_id,pc.title_cn,pe.title_en,pf.title_fr,p.start_time,p.end_time,pc.content_cn,pe.content_en,pf.content_fr,p.dish_id from promotion as p, promotion_cn as pc, promotion_en as pe, promotion_fr as pf where p.prom_id=pc.prom_id and pc.prom_id=pe.prom_id and pe.prom_id=pf.prom_id ";

	$totalRows=getResultNum($sql);
	$totalPage=ceil($totalRows/$pageSize);
	if ($page < 1 || $page == null || ! is_numeric ( $page )) {
		$page = 1;
	}
	if ($page >= $totalPage)
		$page = $totalPage;
	$offset=($page-1)*$pageSize;	
	
	$sql.= " {$order} limit {$offset},{$pageSize}";
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
<title>促销活动图片列表</title>
<link rel="stylesheet" href="styles/backstage.css">
</head>

<body>

<div class="details">
                    <div class="details_operation clearfix">
                        <div class="bui_select">
                            <input type="button" value="添&nbsp;加&nbsp;促&nbsp;销" class="add" onclick="addPromotion()">
                        </div>
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
                                <th width="8%">编号</th>
                                <th width="15%">促销活动标题</th>
                                <th width="11%">起始日期</th>
                                <th width="11%">结束日期</th>
                                <th width="30%">促销图片</th>
                                <th width="10%">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($rows as $row):?>
                            <tr>
                                <!--这里的id和for里面的c1 需要循环出来-->
                                <td><input  type="checkbox" id="p<?php echo $row['prom_id'];?>" class="check" value=<?php echo $row['prom_id'];?>><label for="p1" class="label"><?php echo $row['prom_id'];?></label></td>                                
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
										$start_time=date("Y年m月d日",$row['start_time']);
										foreach ($keywords as $keyval){	
											$start_time=hightlightkeyword($start_time,$keyval);
										}
										echo $start_time;
									}
									else{
										echo date("Y年m月d日",$row['start_time']);
									}			
								?>                                 
                                </td> 
                                <td>
								<?php 
									if($strkeys){
										$end_time=date("Y年m月d日",$row['end_time']);
										foreach ($keywords as $keyval){	
											$end_time=hightlightkeyword($end_time,$keyval);
										}
										echo $end_time;
									}
									else{
										echo date("Y年m月d日",$row['end_time']);
									}			
								?>                                 
                                </td>                               
								<td>
	                        			<?php 
	                        			$promImgs=getAllImgByPromId($row['prom_id']);	 
	                        			if($promImgs){                       			
	                        			foreach($promImgs as $img):		                        			                       		
	                        			?>
	                        			<img class="promimg" onclick="delImg(<?php echo $img['album_id'];?>)" width="100" height="100" src="../image_220/<?php echo $img['album_path'];?>" alt=""/>&nbsp;&nbsp;
	                        			<?php endforeach;}?>
                        		</td>			             
					             <td>						                                            			           				             
					             	<input type="button" value="添加新图片"  onclick="appendImg('<?php echo $row['prom_id'];?>','<?php echo $row['dish_id'];?>')" class="btn"/>					             	
					             </td>					              
                            </tr>
                        <?php  endforeach;?>
						<?php if($totalRows>$pageSize): ?>
							<tr>
								<td colspan="6"><?php echo showPage($page, $totalPage);?></td>
							</tr>
						<?php endif;?>                           
                        </tbody>
                    </table>
                </div>
 <script type="text/javascript">
		function addPromotion(){
			window.location='addPromotion.php';
		}
 	 	function appendImg(prom_id,dish_id){
 	 		window.location="appendPromImage.php?prom_id="+prom_id+"&dish_id="+dish_id;
 	 	}
 		function delImg(id){
 			if(window.confirm("您确认要删除嘛？添加一次不容易，且删且珍惜!")){
 				window.location="doAdminAction.php?act=delPromotionImage&id="+id;
 			}
 		} 
 		function search(){
 			if(event.keyCode==13){
 				var val=document.getElementById("search").value;
 				window.location="listPromImages.php?keywords="+val;
 			}
 		}
 		function change(val){
 			window.location="listPromImages.php?order="+val;
 		} 			 	
 </script>
</body>
</html>