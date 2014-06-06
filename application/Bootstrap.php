<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{


	protected function _initTimeZone()
	{
		$config = $this->getOption("phpsettings");
		date_default_timezone_set("Asia/Shanghai");
	}

	

	protected function _initDb()
	{

		$config = $this->getOption('resources');
		$config['db']['params']['driver_options'][PDO::MYSQL_ATTR_USE_BUFFERED_QUERY] = true;
		$dbAdapter = Zend_Db::factory($config['db']['adapter'], $config['db']['params']);
		//$dbAdapter->setFetchMode(Zend_Db::FETCH_OBJ);
		// Zend_Registry::set('dbAdapter',$dbAdapter);
		Zend_Db_Table_Abstract::setDefaultAdapter($dbAdapter);
	}
	
	protected function _initViews()
	{
		$config = $this->getOption('smarty');
		//加载smarty库
		require_once $config['class_path'];

		//初始化smarty库
		$smarty = new Smarty();
		$smarty->left_delimiter = $config['left_delimiter'];
		$smarty->right_delimiter = $config["right_delimiter"];
		$smarty->template_dir = $config["template_dir"];
		$smarty->compile_dir = $config["compile_dir"];
		$smarty->cache_dir = $config["cache_dir"];
		$smarty->cache_lifetime = $config["cache_lifetime"];
		$smarty->caching = $config["caching"];
		Zend_Registry::set('smarty', $smarty);
	}
	protected function _initSession(){
		require_once 'Zend/Session/Namespace.php';
		$userNamespace = new Zend_Session_Namespace('user');//使用SESSION存储数据时要设置命名空间
		$adminNamespace = new Zend_Session_Namespace('admin');
		$uploadNamespace = new Zend_Session_Namespace('upload');
		Zend_Registry::set('admin_session', $adminNamespace);
		Zend_Registry::set('user_session', $userNamespace);
		Zend_Registry::set('upload_session', $uploadNamespace);
	}

	protected function _initLog(){
		$log = $this->getOption("log");
		$filepath = $log['path'].'/log-'.date('Y-m-d').'.php';
		$writer = new Zend_Log_Writer_Stream($filepath);
		$logger = new Zend_Log($writer);
		Zend_Registry::set('log',$logger);
	}
	
	protected function _initBaseUrl(){
		$config=$this->getOption('url');
		Zend_Registry::set('base',$config['base']);
	}


	protected function _initUpload()
	{
		$config = $this->getOption("upload");
		Zend_Registry::set('upload',$config);
	}

}

