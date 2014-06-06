<?php
class Admin_IndexController extends My_Admin
{
	public function init()
	{
		parent::init();
		//这样就不需要在每个类中用这条语句，一旦初始化这个类的时候，就会调用这个类
		if($this->session->admin==null)
		{
			//重定向页面之后，后面的程序就不会被执行
			$this->_redirect("admin/login");
		}
	}
	
	public function indexAction()
	{
		if($this->adminModel->findRoot() == null){
			$this->_redirect("admin/index/root");
		}else{
			$this->_redirect("admin/login");
		}
	}
	
	public function rootAction()                                                                                  
	{
		if($this->adminModel->findRoot()!=null)
		{
			$this->assign("message","你没有权限使用该功能，或者已指定固定管理员");
			$this->display("admin/error.html");
			return ;
		}
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
	
	public function menuAction()
	{
		//$this->assign("admin",$admin);
		$this->display("admin/administer.html");
	}
}