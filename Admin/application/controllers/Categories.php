<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Categories extends CI_Controller {
	 function __construct()
    {
        parent::__construct();
        $this->load->database();
       	$this->load->library('upload');
       	
    }

	public function index()
	{
		$getData = $this->Common_model->getData("categories");
		$data = array("CategoriesData"=>$getData);
		$this->load->view('category/list',$data);
	}
	
	public function create()
	{
		$data = array(
				'action' =>site_url('Categories/create_action'),
				'button'=>'Create',
				'heading'=>'Create Category',
				'category_name'=>set_value('category_name'),
				'module'=>set_value('module'),
				'description'=>set_value('description'),
				'cat_uuid' => set_value('cat_uuid'),
	    		'error' =>'');
		$this->load->view('category/form',$data);
	}

public function create_action()
	{
		$data = array("category_name"=>$this->input->post('category_name'),
							"module"=>$this->input->post('module'),
							"description"=>$this->input->post('description'),
							"created_by"=>$_SESSION['FES_admin']['user_uucat_uuid'],	
							"create_date"=>date('Y-m-d'),"is_deleted"=>'No');
                    		$this->Common_model->save('categories',$data);
                    		//print_r($this->db->last_query());exit;
                    		$this->session->set_flashdata('message',"Record has been created successfully");
                    		redirect('Categories/index');
            	
		              				
	}

public function update($cat_uuid)
	{
		$row= $this->Common_model->getData("categories","","cat_uuid='".$cat_uuid."'");	
		$data = array(
		'button'=>'Update',
		'heading'=>'Update Category',
		'action'=>site_url('Categories/update_action'),
		'cat_uuid' => set_value('cat_uuid', $row[0]->cat_uuid),
		'category_name' => set_value('category_name', $row[0]->category_name),
		'module' => set_value('module', $row[0]->module),
		'description' => set_value('description', $row[0]->description),
		'error' =>'');
		$this->load->view('category/form',$data);

	}

	public function update_action()
	{
		
			$row= $this->Common_model->getData("categories","1","cat_uuid='".$_POST['cat_uuid']."'");
			$data = array("category_name"=>$this->input->post('category_name'),
	                      "module"=>$this->input->post('module'),
	                      "description"=>$this->input->post('description'),
	                      "modified_by"=>$_SESSION['FES_admin']['user_uuid'],
						  "modified_date"=>date('Y-m-d'));
	                	$this->Common_model->save('categories',$data,"cat_uuid='".$row->cat_uuid."'");
						$this->session->set_flashdata('message',"Record has been updated successfully");
	        			redirect('Categories/index');
            						
			
}
// Delete Functionality  
	public function delete($cat_uuid)
	{
		if($cat_uuid)
		{
			$data = array("is_deleted"=>'Yes',"deleted_date"=>date('Y-m-d'),"deleted_by"=>$_SESSION['FES_admin']['user_uuid']);
			$this->Common_model->save("categories",$data,"cat_uuid='".$cat_uuid."'");
			$this->session->set_flashdata('message',"Record has been deleted successfully");
        	redirect('Categories/index');
		}
		else
		{
			$this->session->set_flashdata('message',"<span style='color:red'>No record found</span>");
        	redirect('Categories/index');
		}
	}
}