<?php
class IndexController extends My_Controller
{
	public function init()
	{
		parent::init();
	}
	
	public function indexAction()
	{
		$this->display("index.html");
	}
	
	public function loginAction()
	{
		$this->display("index.html");
	}
}