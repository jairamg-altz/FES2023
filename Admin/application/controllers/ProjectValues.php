<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class ProjectValues extends CI_Controller {
	 function __construct()
    {
        parent::__construct();
        $this->load->database();
       	$this->load->library('upload');
       	
    }
public function index()
	{
		$getData = $this->Common_model->getProjectVal();
		$data = array("ProjectValuesData"=>$getData);
		$this->load->view('projectValue/list',$data);
	}
public function create()
	{
		$Project= $this->Common_model->getData("project_details");
		$data = array(
				'action' =>site_url('ProjectValues/create_action'),
				'button'=>'Create',
				'heading'=>'Create Project Value',
				'latlon'=>set_value('latlon'),
				'image_path'=>set_value('image_path'),
				'data'=>set_value('data'),'serial_no'=>set_value('serial_no'),
				'project_values_id' => set_value('project_values_id'),
	    		'error' =>'','project'=>$Project

		);
		$this->load->view('projectValue/form',$data);
	}


	public function create_action()
	{
		$data = array("project_id"=>$this->input->post('project_id'),"latlon"=>$this->input->post('latlon'),
							"image_path"=>$this->input->post('image_path'),
							"data"=>$this->input->post('data'),"serial_no"=>$this->input->post('serial_no'));
                    		$this->Common_model->save('project_values',$data);
                    		//print_r($this->db->last_query());exit;
                    		$this->session->set_flashdata('message',"Record has been created successfully");
                    		redirect('ProjectValues/index');
            	
		              				
	}

	

	public function update($project_values_id)
	{
		$row= $this->Common_model->getData("project_values","","project_values_id='".$project_values_id."'");	
		$data = array(
		'button'=>'Update',
		'heading'=>'Update Project Value',
		'action'=>site_url('ProjectValues/update_action'),
		'project_values_id' => set_value('project_values_id', $row[0]->project_values_id),
		'latlon' => set_value('latlon', $row[0]->latlon),
		'image_path' => set_value('image_path', $row[0]->image_path),
		'data' => set_value('data', $row[0]->data),'serial_no' => set_value('serial_no', $row[0]->serial_no),
		'error' =>'');
		$this->load->view('projectValue/form',$data);

	}
public function update_action()
	{		
			$row= $this->Common_model->getData("project_values","1","project_values_id='".$_POST['project_values_id']."'");
			$data = array("latlon"=>$this->input->post('latlon'),
	                      "image_path"=>$this->input->post('image_path'),
	                      "data"=>$this->input->post('data'),
	                      "serial_no"=>$this->input->post('serial_no'));
	                	$this->Common_model->save('project_values',$data,"project_values_id='".$row->project_values_id."'");
						$this->session->set_flashdata('message',"Record has been updated successfully");
	        			redirect('ProjectValues/index');
            						
			
}
// Delete Functionality  
	/*public function delete($id)
	{
		if($id)
		{
			$data = array("Is_deleted"=>'Yes',"deleted_date"=>date('Y-m-d'),"deleted_by"=>$_SESSION['FES_admin']['id']);
			$this->Common_model->save("ProjectValues",$data,"id='".$id."'");
			$this->session->set_flashdata('message',"Record has been deleted successfully");
        	redirect('ProjectValues/index');
		}
		else
		{
			$this->session->set_flashdata('message',"<span style='color:red'>No record found</span>");
        	redirect('ProjectValues/index');
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