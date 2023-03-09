<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class ProjectCMaster extends CI_Controller {
	 function __construct()
    {
        parent::__construct();
        $this->load->database();
       	$this->load->library('upload');
       	
    }

	public function index()
	{
		$getData = $this->Common_model->getData('project_column_masters');
		$data = array("ProjectColumnsData"=>$getData);
		$this->load->view('projectc_master/list',$data);
	}
	
	public function create()
	{
		$project = $this->Common_model->getData("project_details");
		$data = array(
				'action' =>site_url('ProjectCMaster/create_action'),
				'button'=>'Create',
				'heading'=>'Create Project Column',
				'alias_name'=>set_value('alias_name'),
				'data_type'=>set_value('data_type'),
				'options'=>set_value('options'),'is_mandatory'=>set_value('is_mandatory'),
				'project_column_master_id' => set_value('project_column_master_id'),'project'=>$project,
	    		'error' =>'',

		);
		$this->load->view('projectc_master/form',$data);
	}

public function create_action()
	{
	    //print_r($_POST);exit;	
		$data = array("attribute_name"=>$this->input->post('attribute_name'),
					  "alias_name"=>$this->input->post('alias_name'),"data_type"=>$this->input->post('data_type'),"options"=>$this->input->post('options'),"is_mandatory"=>$this->input->post('is_mandatory'));
                    $this->Common_model->save('project_column_masters',$data);
                    $this->session->set_flashdata('message',"Record has been created successfully");
                    redirect('ProjectCMaster/index');
            	
		              				
	}	

	public function update($project_column_id)
	{
		$row= $this->Common_model->getData("project_column_masters","","project_column_master_id='".$project_column_id."'");
		$data = array(
		'button'=>'Update',
		'heading'=>'Update Project Column Master',
		'action'=>site_url('ProjectCMaster/update_action'),
		'project_column_master_id' => set_value('project_column_master_id', $row[0]->project_column_master_id),
		'attribute_name' => set_value('attribute_name', $row[0]->attribute_name),
		'alias_name' => set_value('alias_name', $row[0]->alias_name),
		'data_type' => set_value('data_type', $row[0]->data_type),'options' => set_value('options', $row[0]->options),'is_mandatory' => set_value('is_mandatory', $row[0]->is_mandatory),
		'error' =>'');
		$this->load->view('projectc_master/form',$data);

	}

public function update_action()
	{
		$row= $this->Common_model->getData("project_column_masters","1","project_column_master_id='".$_POST['project_column_master_id']."'");
		$data = array("attribute_name"=>$this->input->post('attribute_name'),"alias_name"=>$this->input->post('alias_name'),"data_type"=>$this->input->post('data_type'),"options"=>$this->input->post('options'),"is_mandatory"=>$this->input->post('is_mandatory'));
	    $this->Common_model->save('project_column_masters',$data,"project_column_master_id='".$row->project_column_master_id."'");
		$this->session->set_flashdata('message',"Record has been updated successfully");
	    redirect('ProjectCMaster/index');
            						
			
}
// Delete Functionality  
	/*public function delete($id)
	{
		if($id)
		{
			$data = array("Is_deleted"=>'Yes',"deleted_date"=>date('Y-m-d'),"deleted_by"=>$_SESSION['FES_admin']['id']);
			$this->Common_model->save("ProjectColumns",$data,"id='".$id."'");
			$this->session->set_flashdata('message',"Record has been deleted successfully");
        	redirect('ProjectColumns/index');
		}
		else
		{
			$this->session->set_flashdata('message',"<span style='color:red'>No record found</span>");
        	redirect('ProjectColumns/index');
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