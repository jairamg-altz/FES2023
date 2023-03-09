<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Projects extends CI_Controller {
function __construct()
    {
        parent::__construct();
        $this->load->database();
       	$this->load->library('upload');
       	
    }

	public function index()
	{
		$getData = $this->Common_model->getData("project_details");
		$data = array("ProjectsData"=>$getData);
		$this->load->view('project/list',$data);
	}
	
	public function create()
	{
		$data = array(
				'action' =>site_url('Projects/create_action'),
				'button'=>'Create',
				'heading'=>'Create Project',
				'project_name'=>set_value('project_name'),
				'project_desc'=>set_value('project_desc'),
				'project_id' => set_value('project_id'),
	    		'error' =>'',

		);
		$this->load->view('project/form',$data);
	}

public function create_action()
	{ 
		$data = array("project_name"=>$this->input->post('project_name'),
					  "project_desc"=>$this->input->post('project_desc'),
					  "created_by"=>$_SESSION['FES_admin']['user_uuid'],
					  "date_time"=>date('Y-m-d'));						
                    	$this->Common_model->save('project_details',$data);
                    	$this->session->set_flashdata('message',"Record has been created successfully");
                    	redirect('Projects/index');
            	
		              				
	}

public function update($project_id)
	{
		$row= $this->Common_model->getData("project_details","","project_id='".$project_id."'");	
		$data = array(
		'button'=>'Update',
		'heading'=>'Update Project',
		'action'=>site_url('Projects/update_action'),
		'project_id' => set_value('project_id', $row[0]->project_id),
		'project_name' => set_value('project_name', $row[0]->project_name),
		'project_desc' => set_value('project_desc', $row[0]->project_desc),
		'error' =>'');
		$this->load->view('project/form',$data);

	}
public function update_action()
	{
		
			$row= $this->Common_model->getData("project_details","1","project_id='".$_POST['project_id']."'");
			$data = array("project_name"=>$this->input->post('project_name'),
	                      "project_desc"=>$this->input->post('project_desc'));
	                	$this->Common_model->save('project_details',$data,"project_id='".$row->project_id."'");
						$this->session->set_flashdata('message',"Record has been updated successfully");
	        			redirect('Projects/index');
            						
			
}
// Delete Functionality  
	/*public function delete($project_id)
	{
		if($project_id)
		{
			$data = array("is_deleted"=>'Yes',"deleted_date"=>date('Y-m-d'),"deleted_by"=>$_SESSION['FES_admin']['id']);
			$this->Common_model->save("project_details",$data,"project_id='".$project_id."'");
			$this->session->set_flashdata('message',"Record has been deleted successfully");
        	redirect('Projects/index');
		}
		else
		{
			$this->session->set_flashdata('message',"<span style='color:red'>No record found</span>");
        	redirect('Projects/index');
		}
	}*/
	

	/*public function _rules() 
    {
		$this->form_validation->set_rules('category name', 'category_name', 'trim|required');
		//$this->form_validation->set_rules('position', 'position', 'trim|required');
		//$this->form_validation->set_rules('description', 'description', 'trim|required');
		$this->form_validation->set_rules('id', 'id', 'trim');
		$this->form_validation->set_error_delimiters('<span>', '</span>');
    }*/

}