<?php
/*
 * author: zp
 * date: 2011-3-10
 */
class Model_Album extends My_Model {
	protected $_name = "photo_album";
	protected $_primary = "id";
	protected $_photo_album = array("name", "create_date");
	
	function findByName($name){
		$where = $this->_db->quoteInto("name = ?", $name);
		$photo_album = $this->fetchRow($where);
		return $photo_album;
	}
	
	function orderByDate(){
		$sql = "select * from photo_album as p order by p.create_date desc";
		$results = $this->query($sql);
		return $results;
	}
}