<?php
class My_Admin extends My_Controller
{
	protected $adminModel;
	protected $session;
	public function init(){
		parent::init();
		$this->session = Zend_Registry::get("admin_session");
		$this->adminModel = new Model_Admin();
	}
}