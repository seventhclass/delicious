<?php 
	require_once '../include.php';
	checkLogined();
	$id=$_REQUEST['id'];
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>添加促销活动</title>
<link href="./styles/global.css"  rel="stylesheet"  type="text/css" media="all" />
<script type="text/javascript" charset="utf-8" src="../plugins/kindeditor/kindeditor.js"></script>
<script type="text/javascript" charset="utf-8" src="../plugins/kindeditor/lang/zh_CN.js"></script>
<script type="text/javascript" src="./scripts/jquery-1.6.4.js"></script>
<script>
        KindEditor.ready(function(K) {
                window.editor = K.create('#editor_id_cn');
                window.editor = K.create('#editor_id_en');
                window.editor = K.create('#editor_id_fr');
        });
        $(document).ready(function(){
        	$("#selectFileBtn").click(function(){
        		$fileField = $('<input type="file" name="thumbs[]"/>');
        		$fileField.hide();
        		$("#attachList").append($fileField);
        		$fileField.trigger("click");
        		$fileField.change(function(){
        		$path = $(this).val();
        		$filename = $path.substring($path.lastIndexOf("\\")+1);
        		$attachItem = $('<div class="attachItem"><div class="left">a.gif</div><div class="right"><a href="#" title="删除附件">删除</a></div></div>');
        		$attachItem.find(".left").html($filename);
        		$("#attachList").append($attachItem);		
        		});
        	});
        	$("#attachList>.attachItem").find('a').live('click',function(obj,i){
        		$(this).parents('.attachItem').prev('input').remove();
        		$(this).parents('.attachItem').remove();
        	});
        });
</script>
</head>
<body>
<h3>添加促销活动</h3>
<form action="doAdminAction.php?act=addPromotion&id=<?php echo $id;?>" method="post" enctype="multipart/form-data">
<table width="70%"  border="1" cellpadding="5" cellspacing="0"  bgcolor="#cccccc">
	<tr>
		<td align="right">促销标题名称(中文)</td>
		<td><input type="text" name="cTitle"  size="30" placeholder="请输入促销标题名称"/></td>
	</tr>
	<tr>
		<td align="right">促销标题名称(English)</td>
		<td><input type="text" name="eTitle"  size="30" placeholder="Type promotion title, please"/></td>
	</tr>
			<tr>
		<td align="right">促销标题名称(Francais)</td>
		<td><input type="text" name="fTitle"  size="30" placeholder="Entrez le titre promotionnel, SVP"/></td>
	</tr>
	<tr>
		<td align="right">促销起始日期</td>
		<td><input type="date" name="startDate"/></td>
	</tr>
	<tr>
		<td align="right">促销结束日期</td>
		<td><input type="date" name="endDate"/></td>
	</tr>
	<tr>
		<td align="right">促销内容描述(中文)</td>
		<td>
			<textarea name="cContent" id="editor_id_cn" style="width:100%;height:150px;"></textarea>
		</td>
	</tr>
	<tr>
		<td align="right">促销内容描述(English)</td>
		<td>
			<textarea name="eContent" id="editor_id_en" style="width:100%;height:150px;"></textarea>
		</td>
	</tr>
	<tr>
		<td align="right">促销内容描述(Français)</td>
		<td>
			<textarea name="fContent" id="editor_id_fr" style="width:100%;height:150px;"></textarea>
		</td>
	</tr>		
	<tr>
		<td align="right">促销菜品图片</td>
		<td>
			<a href="javascript:void(0)" id="selectFileBtn">添加附件</a>
			<div id="attachList" class="clear"></div>
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center"><input type="submit"  value="发布促销"/></td>
	</tr>
</table>
</form>
</body>
</html>







