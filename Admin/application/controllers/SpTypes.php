<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SpTypes extends CI_Controller {
	 function __construct()
    {
        parent::__construct();
        $this->load->database();       	
    }

public function index()
	{
		//print_r("expression");exit;
		$getData = $this->Common_model->getspType();
		$data = array("SpTypesData"=>$getData);
		$this->load->view('spm/list',$data);
	}
	
public function create()
	{
		$sname= $this->Common_model->getData("species_master");
		$data = array(
				'action' =>site_url('SpTypes/create_action'),
				'button'=>'Create',
				'heading'=>'Create Species Type',
				'name'=>set_value('species_master_name'),
				'species_master_id'=>set_value('species_master_id'),
				'id' => set_value('species_master_id'),
	    		'error' =>'','species'=>$sname);
		$this->load->view('spm/form',$data);
	}

public function create_action()
	{		
		$data = array("species_type_name"=>$this->input->post('name'),'created_by'=>$_SESSION['FES_admin']['user_uuid'],'species_master_id'=>$_POST['species_master_id']);
        $this->Common_model->save('species_type',$data);
        $this->session->set_flashdata('message',"Record has been created successfully");
        redirect('SpTypes/index');		              				
	}	

public function update($species_master_id)
	{
		$sname= $this->Common_model->getData("species_master");
		$row= $this->Common_model->getData("species_type","","species_master_id='".$species_master_id."'");	
		$data = array(
		'button'=>'Update',
		'heading'=>'Update Species Masters',
		'action'=>site_url('SpTypes/update_action'),
		'id' => set_value('id', $row[0]->species_master_id),
		'species_master_id' => set_value('species_master_id', $row[0]->species_master_id),
		'name' => set_value('name', $row[0]->species_type_name),
		'species'=>$sname,
		'error' =>'');
		$this->load->view('spm/form',$data);

	}

public function update_action()
	{
			$row= $this->Common_model->getData("species_type","1","species_master_id='".$_POST['id']."'");
			$data = array("species_type_name"=>$this->input->post('name'),'modified_by'=>$_SESSION['FES_admin']['user_uuid'],'species_master_id'=>$_POST['species_master_id'],'modified_date'=>date('Y-m-d'));
        	$this->Common_model->save('species_type',$data,"species_master_id='".$row->species_master_id."'");
			$this->session->set_flashdata('message',"Record has been updated successfully");
			redirect('SpTypes/index');	
}
// Delete Functionality  
public function delete($species_master_id)
	{
		if($species_master_id)
		{
			$data = array("is_deleted"=>'Yes',"deleted_date"=>date('Y-m-d'),"deleted_by"=>$_SESSION['FES_admin']['user_uuid']);
			$this->Common_model->save("species_type",$data,"species_master_id='".$species_master_id."'");
			$this->session->set_flashdata('message',"Record has been deleted successfully");
        	redirect('SpTypes/index');
		}
		else
		{
			$this->session->set_flashdata('message',"<span style='color:red'>No record found</span>");
        	redirect('SpTypes/index');
		}
	}
}