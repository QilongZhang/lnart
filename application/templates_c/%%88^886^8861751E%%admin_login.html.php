<?php /* Smarty version 2.6.25, created on 2011-03-13 13:53:32
         compiled from admin/admin_login.html */ ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>管理员窗口</title>
</head>
<body>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "./admin/admin_header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<form method="post" action="<?php echo $this->_tpl_vars['base']; ?>
/admin/login/submit">
	<table>
		<tr>
			<td colspan="2"><h4>管理员登陆</h4></td>
		</tr>
		<tr>
			<td>管理员名称:</td>
			<td><input type="text" name="username" id="username"/></td>
		</tr>
		<tr>
			<td>密码:</td>
			<td><input type="password" name="password" id="password"/></td>
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