<?php
/*
 * author : zp
 * update : 2011-3-10
 */
class Upload_AlbumController extends My_Admin {
	private $album;
	
	public function init() {
		parent::init();
		if($this->session->admin==null)
		{
			$this->_redirect("admin/login");
		}
		$this->album = new Model_Album();
	}
	
	public function indexAction() {
		$this->display("upload/album.html");
	}
	
	public function createAction() {
		$name = $this->getParam("name");
		$data = array(
				"name" => $name		
		);
		$id = $this->album->save($data);
		$this->display("upload/album.html");
		return $id;
	}

	public function deleteAction() {
		$id = $this->getParam("id");
		$this->album->deleteById($id);
	}
	
	public function updateAction() {
		$id = $this->getParam("id");
		$name = $this->getParam("name");
		$data = array(
			"name" =>$name
		);
		$this->album->updateById($data, $id);
	}
}