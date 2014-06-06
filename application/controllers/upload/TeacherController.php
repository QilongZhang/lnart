<?php
class Upload_TeacherController extends My_Admin
{
	private $teacher;
	
	public function init()
	{
		parent::init();
		if($this->session->admin==null)
		{
			$this->_redirect("admin/login");
		}
		$this->teacher = new Model_Teacher();
	}
	
	public function indexAction() 
	{
		$this->display("upload/teacher.html");	
	}
	
	public function registerAction()
	{
		$this->_helper->viewRenderer->setNoRender ();
		$photo = APPLICATION_PATH . "/upload/teacher_photo/";
		//上传图像
		try{
			$up = new My_Upphoto ();
			$up->set_ph_path ( $photo );
			$up->get_ph_tmpname ( $_FILES ['photo'] ['tmp_name'] );
			$up->get_ph_type ( $_FILES ['photo'] ['type'] );
			$up->get_ph_size ( $_FILES ['photo'] ['size'] );
			$photo = $up->get_ph_name ( $_FILES ['photo'] ['name'] );
			$up->save ();
		} catch (Exception $e) {
			$this->assign("msg", $e->getMessage());
			$this->display("error.html");
		}
		
		$data = array(
						    "id"    =>$this->getParam('id'),
		                 	"name"  =>$this->getParam('name'), 
							"class" =>$this->getParam('class'),
		                  	"photo" =>$photo,
		                  	"desc"  =>$this->getParam('desc')
						    );
						    
		$this->teacher->save($data);
		$this->display("upload/teacher.html");
	}
	
	public function deleteAction()
	{
		$id=$this->getParam("id");
		$this->teacher->deleteAction('id');
	}
	
	public function updateAction()
	{
		$id = $this->getParam("id");
		$data = array(
						    "id"    =>$id,
		                 	"name"  =>$this->getParam('name'), 
							"class" =>$this->getParam('class'),
		                  	"photo" =>$this->getParam('photo'), 
		                  	"desc"  =>$this->getParam('desc')
						    );
		return $this->teacher->updateById($data, $id);
	}
}

?>