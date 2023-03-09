<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Dashboard extends CI_Controller {
	 function __construct()
    {
        parent::__construct();
        $this->load->model('Common_model');
        $this->load->library('form_validation');
		$this->load->database();
		$this->load->library('session');
		$this->load->helper('url');
    }

	public function index()
	{
		
		//$data['newsletterEnq'] = count($this->Common_model->getData('enquiries',"","type='Newsletter'"));
		//$data['contactEnq'] = count($this->Common_model->getData('enquiries',"","type='Contact'"));
		/*$data['packages'] = count($this->Common_model->getData('packages'));
		$data['subPackages'] = count($this->Common_model->getData('sub_packages'));*/
		
		$this->load->view('index');
	}
	
}