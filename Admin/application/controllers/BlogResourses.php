<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class BlogResourses extends CI_Controller {
	 function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

	public function index()
	{
		$getData = $this->Common_model->getResourseReply();
		$data = array("BlogResoursesData"=>$getData);
		$this->load->view('blogReplyResourses/list',$data);
	}

}