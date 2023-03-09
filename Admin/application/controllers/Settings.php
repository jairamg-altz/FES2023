<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Settings extends CI_Controller {
	 function __construct()
    {
        parent::__construct();
        $this->load->database();
       	$this->load->library('upload');
       	
    }
public function index()
	{
		$getData = $this->Common_model->getData("settings",'',"is_deleted='No'");
		$data = array("SetData"=>$getData);
		$this->load->view('setting/list',$data);
	}
public function create()
	{
		$data = array(
				'action' =>site_url('Settings/create_action'),
				'button'=>'Create',
				'heading'=>'Create Setting',
				'setting_title'=>set_value('setting_title'),
				'setting_desc'=>set_value('setting_desc'),
				'setting_id' => set_value('setting_id'),
	    		'error' =>'',

		);
		$this->load->view('setting/form',$data);
	}

public function create_action()
	{
		$slugT = str_replace(' ', '_', $this->input->post('setting_title'));
		print
		$data = array("setting_title"=>$this->input->post('setting_title'),"setting_desc"=>$this->input->post('setting_desc'),'created_by'=>$_SESSION['FES_admin']['user_uuid'],'is_deleted'=>'No','slug_tiltle'=>$slugT);
                    		$this->Common_model->save('settings',$data);
                    		$this->session->set_flashdata('message',"Record has been created successfully");
                    		redirect('Settings/index');
            	
		              				
	}	

	public function update($setting_id)
	{
		$row= $this->Common_model->getData("settings","","setting_id='".$setting_id."'");	
		$data = array(
		'button'=>'Update',
		'heading'=>'Update Settings',
		'action'=>site_url('Settings/update_action'),
		'setting_id' => set_value('setting_id', $row[0]->setting_id),
		'setting_title' => set_value('setting_title', $row[0]->setting_title),'setting_desc' => set_value('setting_desc', $row[0]->setting_desc),'error' =>'');
		$this->load->view('setting/form',$data);

	}

public function update_action()
	{
		$row= $this->Common_model->getData("settings","1","setting_id='".$_POST['setting_id']."'");
		$slugT = str_replace(' ', '_', $this->input->post('setting_title'));
		$data = array("setting_title"=>$this->input->post('setting_title'),
				"setting_desc"=>$this->input->post('setting_desc'),
				'modified_date'=> date('Y-m-d H:i:s'),
				'modified_by'=>$_SESSION['FES_admin']['user_uuid'],'slug_tiltle'=>$slugT,
				'is_deleted'=>'No');
            	$this->Common_model->save('settings',$data,"setting_id='".$row->setting_id."'");
				$this->session->set_flashdata('message',"Record has been updated successfully");
    			redirect('Settings/index');   						
			
}
// Delete Functionality  
public function delete($setting_id)
	{
		if($setting_id)
		{
			$data = array('is_deleted'=> 'Yes','deleted_date'=>date('Y-m-d H:i:s'),'deleted_by'=>$_SESSION['FES_admin']['user_uuid']
	                   );
			$this->Common_model->save("settings",$data,"setting_id='".$setting_id."'");
			$this->session->set_flashdata('message',"Record has been deleted successfully");
        	redirect('Settings/index');
		}
		else
		{
			$this->session->set_flashdata('message',"<span style='color:red'>No record found</span>");
        	redirect('Settings/index');
		}
	}
}