<?php
/*
 * author : zp
 * update : 2011-3-8
 * 屏蔽更改作品信息操作，若想更改可先删除再上传
 */
class Upload_WorkController extends My_Admin {
	private $work;
	private $photo_album;
	
	public function init() {
		parent::init ();
		
		if ($this->session->admin == null) {
			$this->_redirect ( "admin/login" );
		}
		
		$this->work = new Model_Work ();
	}
	
	public function indexAction() {
		$this->display ( "upload/work.html" );
	}
	
	public function addAction() {
		$this->_helper->viewRenderer->setNoRender ();
		$photo_album_name = $this->getParam ( "photo_album_name" );
		$photo_album = new Model_Album ();
		$album = $photo_album->findByName ( $photo_album_name );
		$title = $this->getParam ( "title" );
		$src = APPLICATION_PATH . "/upload/work/";
		$type = $this->getParam ( "type" );
		
		//上传图像
		try{
			$up = new My_Upphoto ();
			$up->set_ph_path ( $src );
			$up->get_ph_tmpname ( $_FILES ['photo'] ['tmp_name'] );
			$up->get_ph_type ( $_FILES ['photo'] ['type'] );
			$up->get_ph_size ( $_FILES ['photo'] ['size'] );
			$src = $up->get_ph_name ( $_FILES ['photo'] ['name'] );
			$up->save ();
		} catch (Exception $e) {
			$this->assign("msg", $e->getMessage());
			$this->display("error.html");
		}
		$data = array ("title" => $title, "src" => $src, "type" => $type, "id_album" => $album->id );
		$id = $this->work->save ( $data );
		$this->display ( "upload/work.html" );
		return $id;
	}
	
	public function deleteAction() {
		$id = $this->getParam ( "id" );
		$this->work->deleteById ( $id );
	}

}