<?php
/**
 * @author 樊溪
 * 数据库操作对象父类
 * 获取数据库连接与数据库简单操作
 * */
class My_Model extends Zend_Db_Table_Abstract 
{
	
	/**
	 * @author Grooc Fan
	 * @param $id
	 * 根据$id 返回相应的查询结果，返回一行
	 * */
	
	protected $logger;
	public function init()
	{
		parent::init();
		$this->logger = Zend_Registry::get('log');
	}
	protected $count = 10;
	public function getById($id)
	{
		$where = $this->_db->quoteInto($this->_primary . ' = ?', $id);
		return $this->fetchRow($where);
	}
	
	public function deleteById($id)
	{
		$where = $this->_db->quoteInto($this->_primary . ' = ?', $id);
		return $this->delete($where);
	}
	
	public function updateById($data,$id)
	{
		$where = $this->_db->quoteInto($this->_primary . ' = ?', $id);
		return $this->update($data,$where);
	}
	/**
	 * @author Grooc Fan 
	 * @param $data
	 * 保存数据
	 * */
	public function save($data)
	{
		$id = $this->insert($data);
		return $id;
	}
	
	/**
	 * @author Grooc Fan
	 * @param $count
	 * 函数根据$count的值按相应的顺序将查询结果返回
	 * */
	public function findTops($count = 10 )
	{
		$where = null;
		$order = "count ASC";
		return $this->fetchAll($where,$order,$count,$offset)->toArray();
	}
	
	
	/**
	 * sql执行函数
	 * */
	public function sqlExecute($sql,$order=null,$limit=null,$offset=null)
	{
		if($order){
			$sql .= ' ORDER BY '.$order;
		}
		if($limit)
		{
			$sql.= ' LIMIT '.$limit;
		}
		if($offset)
		{
			$sql.=' OFFSET '.$offset;
		}
		$query = $this->_db->query($sql);
		$results = $query->fetchAll();
		return $results;
	}
	
	public function getCount()
	{
		$sql = "select count(*) as count from ".$this->_name;
		$query = $this->_db->query($sql);
		$result = $query->fetchAll();
		return $result[0]['count'];
	}
}