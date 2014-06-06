<?php
class My_Controller extends Zend_Controller_Action{

	protected $_smarty;
	protected $options;
	protected $_registry;
	protected $_db;
	protected $session;
	protected $logger;
	protected $baseUrl;	protected $offset;
	protected $limit;
	public function init()
	{
		parent::init();
		$this->_helper->viewRenderer->setNoRender();
		$this->_registry = Zend_Registry::getInstance();
		$this->_smarty = Zend_Registry::get('smarty');
		$this->session = Zend_Registry::get('user_session');
		$this->assign("base",Zend_Registry::get('base'));
		$page = $this->getParam("p");
		$pagesize = $this->getParam("ps");
		
		if($page)
		{
			$this->offset = ($page - 1) * $pagesize;
		}
		if($pagesize)
		{
			$this->limit = $pagesize;
		}
 	}
	//
	function assign($tpl_var, $value = null)
	{
		try
		{
			$this->_smarty->assign($tpl_var, $value);
		}
		catch(Exception $e)
		{
			$this->logger->info($e->getTraceAsString());
		}

	}

	function display($tempfile)
	{
		//$tempfile = APPLICATION_PATH."/../tamplates/".$tempfile;
		$this->_smarty->display($tempfile);
	}

	public function getParam($name)
	{
		if($name!=null)
		{
			return $this->_request->getParam($name);
		}
		return null;
	}
	public function getPost($name)
	{
		if($name!=null)
		{
			return $this->_request->getPost($name);
		}
		return null;
	}
}