<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Licenses extends CI_Controller {
	 function __construct()
    {
        parent::__construct();
        $this->load->database();
      	
    }
public function index()
	{
		$getData = $this->Common_model->getData("data_licenses");
		$data = array("LicensesData"=>$getData);
		$this->load->view('license/list',$data);
	}	

public function create()
	{
		$data = array(
				'action' =>site_url('Licenses/create_action'),
				'button'=>'Create',
				'heading'=>'Create Licenses',
				'data_license'=>set_value('data_license'),
				'data_licenses_id' => set_value('data_licenses_id'),
	    		'error' =>''
		);
		$this->load->view('license/form',$data);
	}
	
public function create_action()
	{
		$data = array("data_license"=>$this->input->post('data_license'));
                    		$this->Common_model->save('data_licenses',$data);
                    		$this->session->set_flashdata('message',"Record has been created successfully");
                    		redirect('Licenses/index');            	
		              				
	}	

public function update($data_licenses_id)
	{
		$row= $this->Common_model->getData("data_licenses","","data_licenses_id='".$data_licenses_id."'");	
		$data = array(
		'button'=>'Update',
		'heading'=>'Update Licenses',
		'action'=>site_url('Licenses/update_action'),
		'data_licenses_id' => set_value('data_licenses_id', $row[0]->data_licenses_id),
		'data_license' => set_value('data_license', $row[0]->data_license),
		'error' =>'');
		$this->load->view('license/form',$data);

	}

public function update_action()
	{
		$row= $this->Common_model->getData("data_licenses","1","data_licenses_id='".$_POST['data_licenses_id']."'");

			$data = array("data_license"=>$this->input->post('data_license')
	                   );
	                	$this->Common_model->save('data_licenses',$data,"data_licenses_id='".$row->data_licenses_id."'");
						$this->session->set_flashdata('message',"Record has been updated successfully");
	        			redirect('Licenses/index');
            						
			
}
}