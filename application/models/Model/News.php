<?php
/**
 * @author 王沛文
 *
 */
class Model_News extends My_Model
{
	protected $_name="news";
	protected $_primary="id";

	/**
	 * @param $class
	 * @return 类别为$class的news数组
	 */
	public function findByClass($class){
		$sql=$this->_db->quoteInto("select n from news as n where n.class=?",$class);
		$query=$this->_db->query($sql);
		$result=$query->fetchAll();
		return $result;
	}

	/**
	 * @param $author
	 * @return 作者为$author的news数组
	 */
	public function findByAuthor($author){
		$sql=$this->_db->quoteInto("select n from news as n where n.author=?",$author);
		$query=$this->_db->query($sql);
		$result=$query->fetchAll();
		return $result;
	}

	/**
	 * @param $title
	 * @return 标题为$title的news数组
	 */
	public function findByTitle($title){
		$sql=$this->_db->quoteInto("select n from news as n where n.title=?",$title);
		$query=$this->_db->query($sql);
		$result=$query->fetchAll();
		return $result;
	}

	/**
	 * @return 按日期降续排列的news数组
	 */
	public function orderByDate(){
		$sql=$this->_db->quoteInto("select n from news as n order by publish_date desc");
		$query=$this->_db->query($sql);
		$result=$query->fetchAll();
		return $result;
	}
}
?>