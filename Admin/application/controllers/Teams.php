<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Teams extends CI_Controller {
	 function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
public function index()
	{
		$getData = $this->Common_model->getData("team_details",'',"is_deleted='No'");
		$data = array("TeamsData"=>$getData);
		$this->load->view('team/list',$data);
	}
public function create()
	{
		$data = array(
				'action' =>site_url('Teams/create_action'),
				'button'=>'Create',
				'heading'=>'Create Team',
				'member_name'=>set_value('member_name'),
				'member_designation'=>set_value('member_designation'),
				'about_member'=>set_value('about_member'),
				'email_id' => set_value('email_id'),'image_id' => set_value('image_id'),
				'team_id' => set_value('team_id'),
	    		'error' =>'');
		$this->load->view('team/form',$data);
	}
public function create_action()
	{
	
		if(empty($_FILES['image_id']['name']))
		{
			$data = array("member_name"=>$this->input->post('member_name'),
						  "member_designation"=>$this->input->post('member_designation'),
						  "about_member"=>$this->input->post('about_member'),
						  "email_id"=>$this->input->post('email_id'),
						  "created_by"=>$_SESSION['FES_admin']['user_uuid'],	
						  "create_date"=>date('Y-m-d'),"is_deleted"=>'No');
                    	  $this->Common_model->save('team_details',$data);
                    	  $this->session->set_flashdata('message',"Record has been created successfully");
                    	  redirect('Teams/index');
		}
		else {
			$config = array(
				'upload_path' => "./../media/img/team",
				'allowed_types' => "jpg|png|jpeg",
				'overwrite' => TRUE,
				'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
				'max_height' => "768",
				'max_width' => "1024"
				);
			//print_r($config);exit;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if($this->upload->do_upload('image_id'))
				{
					//print_r($this->upload->data('file_name'));exit;
	                    $data = array("image_id" => $this->upload->data('file_name'),"member_name"=>$this->input->post('member_name'),
						  "member_designation"=>$this->input->post('member_designation'),
						  "about_member"=>$this->input->post('about_member'),
						  "email_id"=>$this->input->post('email_id'),
						  "created_by"=>$_SESSION['FES_admin']['user_uuid'],	
						  "create_date"=>date('Y-m-d'),"is_deleted"=>'No');
	                    $this->Common_model->save('team_details',$data);
						  redirect('Teams/index');
				}
				else
				{
					print_r($this->upload->display_errors());exit;
				$error = array('error' => $this->upload->display_errors());
				redirect('Teams/create');
				}

		}           	
		              				
	}
//Update
public function update($team_id)
	{
		$row= $this->Common_model->getData("team_details","","team_id='".$team_id."'");	
		$data = array(
		'button'=>'Update',
		'heading'=>'Update Category',
		'action'=>site_url('Teams/update_action'),
		'member_name' => set_value('member_name', $row[0]->member_name),
		'member_designation' => set_value('member_designation', $row[0]->member_designation),
		'about_member' => set_value('about_member', $row[0]->about_member),
		'email_id' => set_value('email_id', $row[0]->email_id),
		'team_id' => set_value('team_id',$row[0]->team_id),
		'error' =>'');
		$this->load->view('team/form',$data);

	}

	public function update_action()
	{
		
			$row= $this->Common_model->getData("team_details","1","team_id='".$_POST['team_id']."'");
			if(empty($_FILES['image_id']['name']))
		{
			$data = array("member_name"=>$this->input->post('member_name'),
						  "member_designation"=>$this->input->post('member_designation'),
						  "about_member"=>$this->input->post('about_member'),
						  "email_id"=>$this->input->post('email_id'),
						  "created_by"=>$_SESSION['FES_admin']['user_uuid'],	
						  "create_date"=>date('Y-m-d'),"is_deleted"=>'No');
                    	  $this->Common_model->save('team_details',$data,"team_id='".$row->team_id."'");
                    	  $this->session->set_flashdata('message',"Record has been created successfully");
                    	  redirect('Teams/index');
		}
		else {
			$config = array(
				'upload_path' => "./../media/img/team",
				'allowed_types' => "jpg|png|jpeg|pdf",
				'overwrite' => TRUE,
				'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
				'max_height' => "768",
				'max_width' => "1024"
				);
			//print_r($config);exit;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if($this->upload->do_upload('image_id'))
				{
					//print_r($this->upload->data('file_name'));exit;
	                    $data = array("image_id" => $this->upload->data('file_name'),"member_name"=>$this->input->post('member_name'),
						  "member_designation"=>$this->input->post('member_designation'),
						  "about_member"=>$this->input->post('about_member'),
						  "email_id"=>$this->input->post('email_id'),
						  "created_by"=>$_SESSION['FES_admin']['user_uuid'],	
						  "create_date"=>date('Y-m-d'),"is_deleted"=>'No');
	                    $this->Common_model->save('team_details',$data,"team_id='".$row->team_id."'");
						  redirect('Teams/index');
				}
				else
				{
					print_r($this->upload->display_errors());exit;
				$error = array('error' => $this->upload->display_errors());
				redirect('Teams/create');
				}
	        			redirect('Teams/index');            						
			}
}

// Delete Functionality  
	public function delete($team_id)
	{
		if($cat_uuid)
		{
			$data = array("is_deleted"=>'Yes',"deleted_date"=>date('Y-m-d'),"deleted_by"=>$_SESSION['FES_admin']['user_uuid']);
			$this->Common_model->save("team_details",$data,"cat_uuid='".$cat_uuid."'");
			$this->session->set_flashdata('message',"Record has been deleted successfully");
        	redirect('Teams/index');
		}
		else
		{
			$this->session->set_flashdata('message',"<span style='color:red'>No record found</span>");
        	redirect('Teams/index');
		}
	}
}