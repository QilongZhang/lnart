<?php
/*
 * author: zp
 * update: 2011-3-8
 */
define("NO_DEFINE", 0); //未定义分类的作品
define("STUDENT_WORK", 1);
define("TEACHER_WORK", 2);

class Model_Work extends My_Model {
	protected $_name = "work";
	protected $_primary = "id";
	protected $_work = array("title","src", "finish_date", "type", "id_album");
	
	function findByName($name) {
		$where = $this->_db->quoteInto('name = ?', $name);
		$work = $this->fetchRow($where);
		return $work;
	}
	
	function findByClass($class) {
		$sql = "select * from work as w where w.class = ".$class;
		$query = $this->_db->query($sql);
		$results = $query->fetchAll();
		return $results;
	}
}