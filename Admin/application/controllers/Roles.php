<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Roles extends CI_Controller {
	 function __construct()
    {
        parent::__construct();
        $this->load->database();
       	$this->load->library('upload');
       	
    }
public function index()
	{
		$getData = $this->Common_model->getData("roles",'',"is_deleted='No'");
		$data = array("RolesData"=>$getData);
		$this->load->view('role/list',$data);
	}
public function create()
	{
		$data = array(
				'action' =>site_url('Roles/create_action'),
				'button'=>'Create',
				'heading'=>'Create Role',
				'role_name'=>set_value('role_name'),
				'roles_uuid' => set_value('roles_uuid'),
	    		'error' =>'');
		$this->load->view('role/form',$data);
	}
public function create_action()
	{
		$data = array("roles_uuid"=>$random,"role_name"=>$this->input->post('role_name'),
							"created_by"=>$_SESSION['FES_admin']['user_uuid'],"created_date"=>date('Y-m-d'));
                    		$this->Common_model->save('roles',$data);
                    		//print_r($this->db->last_query());exit;
                    		$this->session->set_flashdata('message',"Record has been created successfully");
                    		redirect('Roles/index');              				
	}	

public function update($roles_uuid)
	{
		$row= $this->Common_model->getData("roles","","roles_uuid='".$roles_uuid."'");	
		$data = array(
		'button'=>'Update',
		'heading'=>'Update Role',
		'action'=>site_url('Roles/update_action'),
		'roles_uuid' => set_value('roles_uuid', $row[0]->roles_uuid),
		'role_name' => set_value('role_name', $row[0]->role_name),
		'error' =>'');
		$this->load->view('role/form',$data);
	}
public function update_action()
{
		$row= $this->Common_model->getData("roles","1","roles_uuid='".$_POST['roles_uuid']."'");
		$data = array("role_name"=>$this->input->post('role_name'),
	                   "modified_by"=>$_SESSION['FES_admin']['user_uuid'],
						  "modified_date"=>date('Y-m-d'));
	            $this->Common_model->save('roles',$data,"roles_uuid='".$row->roles_uuid."'");
	           	$this->session->set_flashdata('message',"Record has been updated successfully");
	        	redirect('Roles/index');		
}
// Delete Functionality  
public function delete($roles_uuid)
	{
		if($roles_uuid)
		{
			$data = array("is_deleted"=>'Yes',"deleted_date"=>date('Y-m-d'),"deleted_by"=>$_SESSION['FES_admin']['id']);
			$this->Common_model->save("roles",$data,"roles_uuid='".$roles_uuid."'");
			$this->session->set_flashdata('message',"Record has been deleted successfully");
        	redirect('Roles/index');
		}
		else
		{
			$this->session->set_flashdata('message',"<span style='color:red'>Record not found</span>");
        	redirect('Roles/index');
		}
	}
}