<?php /* Smarty version 2.6.25, created on 2011-03-10 10:50:20
         compiled from admin/adminregister.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
</head>
<body>
<form method="post" action="<?php echo $this->_tpl_vars['base']; ?>
/admin/register?act=register">
	<table>
		<tr>
			<td colspan="2"><h4>root管理员注册</h4></td>
		</tr>
		<tr>
			<td>管理员名称</td>
			<td><input type="text" name="username" id="username"/></td>
		</tr>
		<tr>
			<td>电子邮件</td>
			<td><input type="text" name="email" id="email"/></td>
		</tr>
		<tr>
			<td>电话</td>
			<td><input type="text" name="phone" id="phone"/></td>
		</tr>
		<tr>
			<td>真是姓名</td>
			<td><input type="text" name="truename" id="truename"/></td>
		</tr>
		<tr>
			<td>密码</td>
			<td><input type="password" name="password" id="password"/></td>
		</tr>
		<tr>
			<td>确认密码</td>
			<td><input type="password" name="confirm" id="confirm"/></td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" value="登陆"/></td>
		</tr>
	</table>
</form>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "./admin/admin_footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</body>
</html>