<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SpMasters extends CI_Controller {
	 function __construct()
    {
        parent::__construct();
        $this->load->database();       	
    }

public function index()
	{
		$getData = $this->Common_model->getData("species_master");
		$data = array("SpMastersData"=>$getData);
		$this->load->view('smm/list',$data);
	}
	
public function create()
	{
		$data = array(
				'action' =>site_url('SpMasters/create_action'),
				'button'=>'Create',
				'heading'=>'Create Species Masters',
				'name'=>set_value('species_master_name'),
				'id' => set_value('species_master_id'),
	    		'error' =>'');
		$this->load->view('spm/form',$data);
	}

public function create_action()
	{		
		$data = array("species_master_name"=>$this->input->post('name'),'created_by'=>$_SESSION['FES_admin']['user_uuid']);
                    $this->Common_model->save('species_master',$data);
                    $this->session->set_flashdata('message',"Record has been created successfully");
                    redirect('SpMasters/index');		              				
	}	

public function update($species_master_id)
	{
		$row= $this->Common_model->getData("species_master","","species_master_id='".$species_master_id."'");	
		$data = array(
		'button'=>'Update',
		'heading'=>'Update Species Masters',
		'action'=>site_url('SpMasters/update_action'),
		'id' => set_value('id', $row[0]->species_master_id),
		'name' => set_value('name', $row[0]->species_master_name),
		'error' =>'');
		$this->load->view('smm/form',$data);

	}

public function update_action()
	{
			$row= $this->Common_model->getData("species_master","1","species_master_id='".$_POST['id']."'");
			$data = array("species_master_name"=>$this->input->post('name'),'modified_by'=>$_SESSION['FES_admin']['user_uuid'],'modified_date'=>date('Y-m-d'));
        	$this->Common_model->save('species_master',$data,"species_master_id='".$row->species_master_id."'");
			$this->session->set_flashdata('message',"Record has been updated successfully");
			redirect('SpMasters/index');	
}
// Delete Functionality  
public function delete($species_master_id)
	{
		if($species_master_id)
		{
			$data = array("is_deleted"=>'Yes',"deleted_date"=>date('Y-m-d'),"deleted_by"=>$_SESSION['FES_admin']['user_uuid']);
			$this->Common_model->save("species_master",$data,"species_master_id='".$species_master_id."'");
			$this->session->set_flashdata('message',"Record has been deleted successfully");
        	redirect('SpMasters/index');
		}
		else
		{
			$this->session->set_flashdata('message',"<span style='color:red'>No record found</span>");
        	redirect('SpMasters/index');
		}
	}
}