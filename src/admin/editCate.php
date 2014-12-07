<?php 
require_once '../include.php';
$id=$_REQUEST['id'];
$row=getCateById($id);
?>

<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>insert title here</title>
</head>
<body>
<h3>修改分类</h3>
<form action="doAdminAction.php?act=editCate&id=<?php echo $id;?>" method="post">
<table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
	<tr>
		<td align="right">分类名称</td>
		<td><input type="text" name="cName" size="22" value="<?php echo $row['cate_name_cn'];?>" /></td>	
		<td><input type="text" name="eName" size="50" value="<?php echo $row['cate_name_en'];?>" /></td>	
		<td><input type="text" name="fName" size="50" value="<?php echo $row['cate_name_fr'];?>" /></td>		
	</tr>
	<tr>
		<td colspan="4" align=center><input type="submit" value="修改分类"/></td>		
	</tr>			
</table>
</form>
</body>
</html>