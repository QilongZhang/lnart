<?php
class Admin_LoginController extends My_Admin
{
	public function init()
	{
		parent::init();
	}
	
	public function indexAction()
	{
		if($this->session->admin==null)
		{
			$this->display("admin/admin_login.html");
		}
		else
		{
			$this->_redirect("admin/index/menu");
		}
	}
	
	
	public function submitAction()
	{
		$username = $this->getParam("username");
		$password = $this->getParam("password");
		$user = $this->adminModel->findByName($username);
		if($user->password == md5($password))
		{
			$this->session->admin = $username;
			$this->_redirect("admin/index/menu");
		}
		else
		{
			$this->_redirect("admin");	
		}
	}	
}