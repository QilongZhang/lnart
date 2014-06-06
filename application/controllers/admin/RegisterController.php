<?php
class Admin_RegisterController extends My_Admin
{
	public function init()
	{
		parent::init();
	}
	public function indexAction()
	{
		$action = $this->getParam("act");
		if($action=="register")
		{
			$username = $this->getParam("username");
			$password = $this->getParam("password");
			$email = $this->getParam("email");
			$phone = $this->getParam("phone");
			$truename = $this->getParam("truename");
			
			$data = array(
				"username"=>$username,
				"password"=>md5($password),
				"email"=>$email,
				"phone"=>$phone,
				"truename"=>$truename,
				"role"=>"root"
			);
			$this->adminModel->save($data);
			$this->session->admin = $this->adminModel->findRoot();
			$this->_redirect("admin/index/menu");
		}
		else
		{
			$this->display("admin/admin_register.html");
		}
	}
}