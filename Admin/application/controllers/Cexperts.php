<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Cexperts extends CI_Controller {
	 function __construct()
    {
        parent::__construct();
        $this->load->database();
       	$this->load->library('upload');
       	
    }

	public function index()
	{
		$getData = $this->Common_model->getData("coxs");
		//print_r($getData);exit;
		$data = array("CexpertsData"=>$getData);
		$this->load->view('coexpert/list',$data);
	}
	/*public function change_status($status,$id)
	{
		if($status=='Active')
		{
			$varForStatus='Inactive';
		}
		else
		{
			$varForStatus='Active';
		}
		$data= array('status'=>$varForStatus,"modified"=>date('Y-m-d H:i:s'));
		$this->Common_model->save('consortium_experts',$data,"id='".$id."'");
		$this->session->set_flashdata("message","Status has been changed successfully");
		redirect(site_url('Cexperts'));
	}*/

public function read($id)
{
	if(!empty($id))
	{
		$cond="uuid='".$id."'";
		$rows = $this->Common_model->getData('coxs','1',$cond);
		//print_r($rows);exit;
		$arrayData = array(
		'heading'=>'Consortium of Experts Detail','rowsData' =>$rows);
		$this->load->view('coexpert/read',$arrayData);
	}
	else {
		$this->session->set_flashdata('message',"Oops Something Wrong!");
        redirect('Cexperts/index');	
	}	
}
	public function delete($id)
	{
		//print_r($id);exit;
		if($id)
		{
			$data = array("is_deleted"=>"Yes");
			$this->Common_model->delete("coxs","uuid='".$id."'");
			$this->session->set_flashdata('message',"Record has been deleted successfully");
        	redirect('Cexperts/index');
		}
		else
		{
			$this->session->set_flashdata('message',"<span style='color:red'>No record found</span>");
        	redirect('Cexperts/index');
		}
	}
}