<?php /* Smarty version 2.6.25, created on 2011-03-13 13:52:18
         compiled from admin/administer.html */ ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>管理员</title>
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['base']; ?>
/public/css/admin/base.css"></link>
</head>
<body>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "./admin/admin_header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<ul id="item">
	<li><a href="<?php echo $this->_tpl_vars['base']; ?>
/admin/register" target="show">新增管理员</a></li>
	<li><a href="<?php echo $this->_tpl_vars['base']; ?>
/upload/news" target="show">上传新闻</a></li>
	<li><a href="<?php echo $this->_tpl_vars['base']; ?>
/upload/work" target="show">上传作品</a></li>
	<li><a href="<?php echo $this->_tpl_vars['base']; ?>
/upload/album" target="show">新建相册</a></li>
	<li><a href="<?php echo $this->_tpl_vars['base']; ?>
/upload/teacher" target="show">教师注册</a></li>
	
</ul>
<div>
 <iframe width="70%" height="600" src="" name="show" id="frame">
 	
 </iframe>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "./admin/admin_footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</body>
</html>