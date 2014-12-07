<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>添加分类</title>
</head>
<body>
<h3>添加分类</h3>
<form action="doAdminAction.php?act=addCate" method="post">
<table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
	<tr>
		<td align="right" >分类名称</td>
		<td><input type="text" name="cName" size="22" placeholder="请输入分类名称(中文)" /></td>	
		<td><input type="text" name="eName" size="50" placeholder="请输入分类名称(English)" /></td>
		<td><input type="text" name="fName" size="50" placeholder="请输入分类名称(Francais)" /></td>	
	</tr>
	<tr>
		<td colspan="4" align=center ><input type="submit" value="添加分类"/></td>		
	</tr>			
</table>
</form>
</body>
</html>