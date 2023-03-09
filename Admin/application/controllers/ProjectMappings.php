<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class ProjectMappings extends CI_Controller {
	 function __construct()
    {
        parent::__construct();
        $this->load->database();
       	$this->load->library('upload');
       	
    }

	public function index()
	{
		$getData = $this->Common_model->getProjectMap();
		$data = array("ProjectMappingsData"=>$getData);
		$this->load->view('projMap/list',$data);
	}
	
	public function create()
	{
		$project = $this->Common_model->getData("project_details");
		$user = $this->Common_model->getData("users_details");
		$data = array(
				'action' =>site_url('ProjectMappings/create_action'),
				'button'=>'Create',
				'heading'=>'Create Project Mapping',
				'project_id'=>set_value('project_id'),'projects'=>$project,'users'=>$user,
				'user_id'=>set_value('user_id'),'access'=>set_value('access'),
				'project_mapping_id' => set_value('project_mapping_id'),
	    		'error' =>'',

		);
		$this->load->view('projMap/form',$data);
	}


	public function create_action()
	{
		$data = array("project_id"=>$this->input->post('project_id'),
							"user_id"=>$this->input->post('user_id'),"access"=>$this->input->post('access'));
                    		$this->Common_model->save('project_mapping',$data);
                    		$this->session->set_flashdata('message',"Record has been created successfully");
                    		redirect('ProjectMappings/index');
            	
		              				
	}	

	public function update($project_mapping_id)
	{
		$row= $this->Common_model->getData("project_mapping","","project_mapping_id='".$project_mapping_id."'");	
		$data = array(
		'button'=>'Update',
		'heading'=>'Update Project Mapping',
		'action'=>site_url('ProjectMappings/update_action'),
		'project_mapping_id' => set_value('project_mapping_id', $row[0]->project_mapping_id),
		'project_id' => set_value('project_id', $row[0]->project_id),
		'user_id' => set_value('user_id', $row[0]->user_id),'access'=>set_value('access',$row[0]['access']),
		'error' =>'');
		$this->load->view('projMap/form',$data);

	}

	public function update_action()
	{
		
			$row= $this->Common_model->getData("project_mapping","1","project_mapping_id='".$_POST['project_mapping_id']."'");
			$data = array("project_id"=>$this->input->post('project_id'),
	                      "user_id"=>$this->input->post('user_id'),'access'=>$this->input->post('access'));
	                	$this->Common_model->save('project_mapping',$data,"project_mapping_id='".$row->project_mapping_id."'");
						$this->session->set_flashdata('message',"Record has been updated successfully");
	        			redirect('ProjectMappings/index');
            						
			
}
// Delete Functionality  
	/*public function delete($id)
	{
		if($id)
		{
			$data = array("Is_deleted"=>'Yes',"deleted_date"=>date('Y-m-d'),"deleted_by"=>$_SESSION['FES_admin']['id']);
			$this->Common_model->save("ProjectMappings",$data,"id='".$id."'");
			$this->session->set_flashdata('message',"Record has been deleted successfully");
        	redirect('ProjectMappings/index');
		}
		else
		{
			$this->session->set_flashdata('message',"<span style='color:red'>No record found</span>");
        	redirect('ProjectMappings/index');
		}
	}
	

	public function _rules() 
    {
		$this->form_validation->set_rules('category name', 'category_name', 'trim|required');
		//$this->form_validation->set_rules('position', 'position', 'trim|required');
		//$this->form_validation->set_rules('description', 'description', 'trim|required');
		$this->form_validation->set_rules('id', 'id', 'trim');
		$this->form_validation->set_error_delimiters('<span>', '</span>');
    }*/

}