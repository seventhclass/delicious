<?php 
	require_once '../include.php';
	checkLogined();
	$rows=getAllCate();
	if(!$rows){
		alertMes("没有相应分类，请先添加分类!!", "addCate.php");
	}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>添加菜品</title>
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
<h3>添加菜品</h3>
<form action="doAdminAction.php?act=addDish" method="post" enctype="multipart/form-data">
<table width="70%"  border="1" cellpadding="5" cellspacing="0"  bgcolor="#cccccc">
	<tr>
		<td align="right">菜品名称(中文)</td>
		<td><input type="text" name="cName"  placeholder="请输入菜品名称"/></td>
	</tr>
	<tr>
		<td align="right">菜品名称(English)</td>
		<td><input type="text" name="eName"  placeholder="Type dish name, please"/></td>
	</tr>
			<tr>
		<td align="right">菜品名称(Francais)</td>
		<td><input type="text" name="fName"  placeholder="Entrer plat nom, SVP"/></td>
	</tr>
	<tr>
		<td align="right">菜品分类</td>
		<td>
		<select name="cId">
			<?php foreach($rows as $row):?>
				<option value="<?php echo $row['cate_id'];?>"><?php echo $row['cate_name_cn'];?></option>
			<?php endforeach;?>
		</select>
		</td>
	</tr>
	<tr>
		<td align="right">菜品货号</td>
		<td><input type="text" name="dNo"  placeholder="请输入菜品货号"/></td>
	</tr>
	<tr>
		<td align="right">菜品数量</td>
		<td><input type="text" name="dNum"  placeholder="请输入菜品数量"/></td>
	</tr>
	<tr>
		<td align="right">菜品原价</td>
		<td><input type="text" name="rPrice"  placeholder="请输入菜品原价"/></td>
	</tr>
	<tr>
		<td align="right">菜品现价</td>
		<td><input type="text" name="cPrice"  placeholder="请输入菜品现价"/></td>
	</tr>
	<tr>
		<td align="right">菜品描述(中文)</td>
		<td>
			<textarea name="cDesc" id="editor_id_cn" style="width:100%;height:150px;"></textarea>
		</td>
	</tr>
	<tr>
		<td align="right">菜品描述(English)</td>
		<td>
			<textarea name="eDesc" id="editor_id_en" style="width:100%;height:150px;"></textarea>
		</td>
	</tr>
	<tr>
		<td align="right">菜品描述(Francais)</td>
		<td>
			<textarea name="fDesc" id="editor_id_fr" style="width:100%;height:150px;"></textarea>
		</td>
	</tr>		
	<tr>
		<td align="right">菜品图像</td>
		<td>
			<a href="javascript:void(0)" id="selectFileBtn">添加附件</a>
			<div id="attachList" class="clear"></div>
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center"><input type="submit"  value="发布菜品"/></td>
	</tr>
</table>
</form>
</body>
</html>







