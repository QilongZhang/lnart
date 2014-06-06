<?php
/*
 * @ahthor : zp
 * date    : 2011/3/10
 */
class Upload_IndexController extends My_Admin {
	
	public function init() {
		parent::init();
		if($this->session->admin==null)
		{
			$this->_redirect("admin/login");
		}
	}
	
	public function indexAction() {
		if($this->session->admin == null){
			$this->display("admin/admin_login.html");
		}
		else {
			$this->redirect("upload/news");
		}
	}
	
	public function newsAction() {
		if($this->session->admin == null) {
			$this->display("admin/admin_login.html");
		}
		else {
			$this->redirect("upload/news");
		}
	}
	
	public function workAction() {
		if($this->session->admin == null) {
			$this->display("admin/admin_login.html");
		}
		else {
			$this->redirect("upload/work");
		}
	}
	
	public function photoAlbumAction() {
	if($this->session->admin == null) {
			$this->display("admin/admin_login.html");
		}
		else {
			$this->redirect("upload/photoAlbum");
		}
	}
	
	public function teacherAction() {
	if($this->session->admin == null) {
			$this->display("admin/admin_login.html");
		}
		else {
			$this->redirect("upload/teacher");
		}
	}
}