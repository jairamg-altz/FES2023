<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Functionalities extends CI_Controller {
	 function __construct()
    {
        parent::__construct();
        $this->load->database();
       	$this->load->library('upload');
       	
    }

	public function index()
	{
		$getData = $this->Common_model->getData("functionalities");
		$data = array("FunctionalitiesData"=>$getData);
		$this->load->view('functionalities/list',$data);
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
		$this->Common_model->save('Functionalities',$data,"id='".$id."'");
		$this->session->set_flashdata("message","Status has been changed successfully");
		redirect(site_url('Functionalities'));
	}*/
	/*public function getDescription()
	{
		$getDescription =$this->Common_model->getData("banner","","id='".$_POST['id']."'");
		echo $getDescription[0]->description;exit;
	}*/
public function create()
	{
		$data = array(
				'action' =>site_url('Functionalities/create_action'),
				'button'=>'Create',
				'heading'=>'Create Functionalities',
				'fnct_name'=>set_value('fnct_name'),
				'sub_fnct_name'=>set_value('sub_fnct_name'),
				'module'=>set_value('module'),
				'fnct_uuid' => set_value('fnct_uuid'),
	    		'error' =>'',

		);
		$this->load->view('functionalities/form',$data);
	}

public function create_action()
	{
		$data = array("fnct_name"=>$this->input->post('fnct_name'),
							"sub_fnct_name"=>$this->input->post('sub_fnct_name'),
							"module_name"=>$this->input->post('module_name'),
							"created_by"=>$_SESSION['FES_admin']['uuid'],	
							"created_date"=>date('Y-m-d'),"is_deleted"=>'No');
                    		$this->Common_model->save('functionalities',$data);
                    		//print_r($this->db->last_query());exit;
                    		$this->session->set_flashdata('message',"Record has been created successfully");
                    		redirect('Functionalities/index');
            	
		              				
	}

	public function update($fnct_uuid)
	{
		$row= $this->Common_model->getData("functionalities","","fnct_uuid='".$fnct_uuid."'");	
		$data = array(
		'button'=>'Update',
		'heading'=>'Update Functionalities',
		'action'=>site_url('Functionalities/update_action'),
		'fnct_uuid' => set_value('fnct_uuid', $row[0]->fnct_uuid),
		'fnct_name' => set_value('fnct_name', $row[0]->fnct_name),
		'sub_fnct_name' => set_value('sub_fnct_name', $row[0]->sub_fnct_name),
		'module_name' => set_value('module_name', $row[0]->module_name),
		'error' =>'');
		$this->load->view('functionalities/form',$data);

	}

	public function update_action()
	{
		
			$row= $this->Common_model->getData("functionalities","1","fnct_uuid='".$_POST['fnct_uuid']."'");
			$data = array("fnct_name"=>$this->input->post('fnct_name'),
	                      "sub_fnct_name"=>$this->input->post('sub_fnct_name'),
	                      "module_name"=>$this->input->post('module_name'),
	                      "modified_by"=>$_SESSION['FES_admin']['uuid'],
						  "modified_date"=>date('Y-m-d'));
	                	$this->Common_model->save('functionalities',$data,"fnct_uuid='".$row->fnct_uuid."'");
						$this->session->set_flashdata('message',"Record has been updated successfully");
	        			redirect('Functionalities/index');
            						
			
}
// Delete Functionality  
	public function delete($fnct_uuid)
	{
		if($id)
		{
			$data = array("is_deleted"=>'Yes',"deleted_date"=>date('Y-m-d'),"deleted_by"=>$_SESSION['FES_admin']['user_uuid']);
			$this->Common_model->save("functionalities",$data,"fnct_uuid='".$fnct_uuid."'");
			$this->session->set_flashdata('message',"Record has been deleted successfully");
        	redirect('Functionalities/index');
		}
		else
		{
			$this->session->set_flashdata('message',"<span style='color:red'>No record found</span>");
        	redirect('Functionalities/index');
		}
	}
}