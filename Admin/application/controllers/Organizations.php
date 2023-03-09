<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Organizations extends CI_Controller {
	 function __construct()
    {
        parent::__construct();
        $this->load->database();
      	
    }
public function index()
	{
		$getData = $this->Common_model->getData("organizations");
		$data = array("OrganizationsData"=>$getData);
		$this->load->view('org/list',$data);
	}	

public function create()
	{
		$data = array(
				'action' =>site_url('Organizations/create_action'),
				'button'=>'Create',
				'heading'=>'Create Organizations',
				'name'=>set_value('name'),
				'org_uuid' => set_value('org_uuid'),
	    		'error' =>''
		);
		$this->load->view('org/form',$data);
	}
	
public function create_action()
	{
		$data = array("name"=>$this->input->post('name'));
                    		$this->Common_model->save('organizations',$data);
                    		$this->session->set_flashdata('message',"Record has been created successfully");
                    		redirect('Organizations/index');            	
		              				
	}	

public function update($org_uuid)
	{
		$row= $this->Common_model->getData("organizations","","org_uuid='".$org_uuid."'");	
		$data = array(
		'button'=>'Update',
		'heading'=>'Update Organizations',
		'action'=>site_url('Organizations/update_action'),
		'org_uuid' => set_value('org_uuid', $row[0]->org_uuid),
		'name' => set_value('name', $row[0]->name),
		'error' =>'');
		$this->load->view('org/form',$data);

	}

public function update_action()
	{
			$row= $this->Common_model->getData("organizations","1","org_uuid='".$_POST['org_uuid']."'");
			$data = array("role_name"=>$this->input->post('role_name')
	                   );
	                	$this->Common_model->save('organizations',$data,"org_uuid='".$row->org_uuid."'");
						$this->session->set_flashdata('message',"Record has been updated successfully");
	        			redirect('Organizations/index');
            						
			
}
}