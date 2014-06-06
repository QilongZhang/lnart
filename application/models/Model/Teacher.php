<?php
class Model_Teacher extends My_Model
{
	protected $_name='teacher';
	protected $_primary='id';
	
	public function findById($id)
	{
		$sql=$this->_db->quoteInto("select n from teacher as n where n.id=?", $id);
		$result=$this->_db->query($sql);
		return  $result;
	}
}
?>