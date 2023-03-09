<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Likes extends CI_Controller {
	 function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

	public function index()
	{
		$getData = $this->Common_model->getLikes();
		$data = array("LikeData"=>$getData);
		$this->load->view('Like/list',$data);
	}

}