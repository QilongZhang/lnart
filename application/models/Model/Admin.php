<?php
class Model_Admin extends My_Model
{
	protected $_name = "admin";
	protected $_primary = "id";
	
	
	public function findRoot()
	{
		$where = $this->_db->quoteInto('role = ?','root');
		return $this->fetchRow($where);
	}
	
	public function findByName($username)
	{
		$where = $this->_db->quoteInto('username = ?',$username);
		return $this->fetchRow($where);
	}
}