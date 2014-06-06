<?php /* Smarty version 2.6.25, created on 2011-03-09 22:28:32
         compiled from error.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Zend Framework Default Application</title>
</head>
<body>
  <h1>An error occurred</h1>

  <h3>Exception information:</h3>
  <p>
  <?php echo $this->_tpl_vars['msg']; ?>

  </p>

  <h3>Stack trace:</h3>
  <pre><?php echo $this->_tpl_vars['trace']; ?>

  </pre>

  <h3>Request Parameters:</h3>
  <pre><?php echo $this->_tpl_vars['params']; ?>

  </pre>

</body>
</html>
