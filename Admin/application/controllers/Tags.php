<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tags extends CI_Controller {
	 function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

	public function index()
	{
		$getData = $this->Common_model->getTags();
		$data = array("TagData"=>$getData);
		$this->load->view('tag/list',$data);
	}

}