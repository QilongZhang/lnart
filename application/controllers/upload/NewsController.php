<?php
/**
 * @author 王沛文
 *管理员模块未写
 */
class Upload_NewsController extends My_Admin
{
	private $news;
	
	public function init()
	{
		parent::init();
		if($this->session->admin==null)
		{
			$this->_redirect("admin/login");
		}
		$news=new Model_News();
	}
	
	public function indexAction() {
		$this->display("upload/news.html");
	}
	
	public function addAction()
	{
		$username = $this->session->admin;
		$title=$this->getParam("title");
		$class=$this->getParam("class");
		$content=$this->getParam("content");
		$data=array(
		"user"=>$username,
		"title"=>$title,
		"content"=>$content,
		"class"=>$class
		);
		$id=$this->news->save($data);
		return $id;
	}
	
	public function deleteAction()
	{
		$id=$this->getParam("id");
		$this->news->deleteById($id);
	}
	
	public function updateAction()
	{
		$username = $this->session->admin;
		$id=$this->getParam("id");
		$title=$this->getParam("title");
		$class=$this->getParam("class");
		$content=$this->getParam("content");
		$data=array(
		"user"=>$username,
		"title"=>$title,
		"content"=>$content,
		"publish_date"=>time(),
		"class"=>$class
		);
		$id=$this->news->updateById($data,$id);
		return $id;		
	}
}
?>
