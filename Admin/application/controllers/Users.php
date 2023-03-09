<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Users extends CI_Controller {
	 function __construct()
    {
        parent::__construct();
        $this->load->database();
       	$this->load->library('upload');       	
    }

	public function index()
	{
		$getData = $this->Common_model->getData('users_details','',"");
		//print_r($this->db->last_query());exit;
    	$data = array("usersData"=>$getData);
		  $this->load->view('users/list',$data);
	}
	
public function expert($user_uuid)
	{
		$row= $this->Common_model->getData("users_details","1","user_uuid='".$user_uuid."'");
		$data = array(
				'action' =>site_url('Users/expert_action'),
				'button'=>'Create',
				'heading'=>'Create Consortium of Experts',
				'expert_name'=>set_value('expert_name',$row->first_name.' '.$row->middle_name.' '.$row->last_name),
				'expert_details'=>set_value('expert_details'),
				'expert_category'=>set_value('expert_category'),
				'specialization'=>set_value('specialization'),
				'expert_email'=>set_value('expert_email',$row->email),
				'Qualification'=>set_value('Qualification'),
				'Publication_url'=>set_value('Publication_url'),
				'skype_id'=>set_value('skype_id'),
				'twitter_id'=>set_value('twitter_id'),
				'facebook_id'=>set_value('facebook_id'),
				'linkedin_id'=>set_value('linkedin_id'),
				'cox_uuid' => $user_uuid,
	    		'error' =>'',

		);
		$this->load->view('users/expert',$data);
	}
public function expert_action()
{
	$row= $this->Common_model->getData("users_details","1","user_uuid='".$_POST['cox_uuid']."'");
	//print_r($row);exit;
	if(empty($row))
	{
		redirect('Users/index');
	}
	else
	{
		$data = array("expert_name" => $this->input->post('expert_name'),
					  "expert_details"=>$this->input->post('expert_details'),
					  "expert_category"=>$this->input->post('expert_category'),
	                  "specialization"=>$this->input->post('specialization'),
	                  "expert_email"=>$this->input->post('expert_email'),
	                  "qualification"=>$this->input->post('Qualification'),
	                  "publication_url"=>$this->input->post('Publication_url'),
	                  "skype_id"=>$this->input->post('skype_id'),
	                  "twitter_id"=>$this->input->post('twitter_id'),
	                  "facebook_id"=>$this->input->post('facebook_id'),
	                  "linkedin_id"=>$this->input->post('linkedin_id'),
	                  "created_by"=>$_SESSION['FES_admin']['user_uuid'],	
					  "added_date"=>date('Y-m-d'),
					  "is_deleted"=>'No');	   	                    
                	  $this->Common_model->save('coxs',$data);
					  $this->session->set_flashdata('message',"Record has been updated successfully");
        			  redirect('Users/index');
            		}
}	
	public function create()
	{
		$data = array(
				'action' =>site_url('Users/create_action'),
				'button'=>'Create',
				'heading'=>'Create User Managment System',
				'user_id'=>set_value('user_id'),
				'first_name'=>set_value('first_name'),
				'middle_name'=>set_value('middle_name'),
				'last_name'=>set_value('last_name'),
				'email'=>set_value('email'),
				'mobile'=>set_value('mobile'),
				'password'=>set_value('password'),
				'gender'=>set_value('gender'),
				'status'=>set_value('status'),
				'role' => set_value('role'),
	    		//'modified' => set_value('modified'),
	    		'user_uuid' => set_value('user_uuid'),
	    		'error' =>'',

		);
		$this->load->view('users/form',$data);
	}


	public function create_action()
	{
		//print_r($_POST);exit;
		if(empty($_POST))
		{
			redirect('Users/create');
		}
		else{
				$data = array("user_id"=>$this->input->post('user_id'),
                    		"first_name"=>$this->input->post('first_name'),
                    		"middle_name"=>$this->input->post('middle_name'),
                    		"last_name"=>$this->input->post('last_name'),
                    		"email"=>$this->input->post('email'),
                    		"mobile_number"=>$this->input->post('mobile'),
                    		"password"=>md5($this->input->post('password')),
							"gender"=>$this->input->post('gender'),
							//"uuid"=>$uuid,
							"status"=>'Active',		
							"registration_date"=>date('Y-m-d'),
							"is_deleted"=>'No'
						);
                    		$this->Common_model->save('users_details',$data);
                    		//print_r($this->db->last_query());exit;
                    		$this->session->set_flashdata('message',"Record has been created successfully");
                    		redirect('Users/index');
		}
                   
            	}
		    

	public function update($user_uuid)
	{
		$row= $this->Common_model->getData("users_details","","user_uuid='".$user_uuid."'");	
		$data = array(
		'button'=>'Update',
		'heading'=>'Update User Managment System',
		'action'=>site_url('Users/update_action'),
		'user_uuid' => set_value('user_uuid', $row[0]->user_uuid),'user_id' => set_value('user_id', $row[0]->user_id),
		'first_name' => set_value('first_name', $row[0]->first_name),
		'middle_name' => set_value('middle_name', $row[0]->middle_name),
		'last_name' => set_value('last_name', $row[0]->last_name),
		'email' => set_value('email', $row[0]->email),
		'mobile' => set_value('mobile_number', $row[0]->mobile_number),
		'password' => set_value('password', $row[0]->password),
		'gender'=>set_value('gender',$row[0]->gender),
		'status' => set_value('status', $row[0]->status),
		'role' => set_value('role',$row[0]->role),
		'error' =>'');
		$this->load->view('users/form',$data);

	}

	public function update_action()
	{	
		$row= $this->Common_model->getData("users_details","1","user_uuid='".$_POST['user_uuid']."'");
		//print_r($row);exit;
		if(empty($row))
			{
				redirect('Users/index');
			}
			else
			{	  	$data = array("gender"=>$this->input->post('gender'),'password'=>md5($this->input->post('password')),
	                    		"status"=>$this->input->post('status'),
								"lastmodified_date"=>date('Y-m-d'),
								"modified_by"=>$row->user_uuid
							);
				  		$cond = "user_uuid='".$row->user_uuid."'";
	                	$this->Common_model->save('users_details',$data,$cond);
						$this->session->set_flashdata('message',"Record has been updated successfully");
	        			redirect('Users/index');
            		}				
	}			
	
public function read($user_uuid)
{
	if(!empty($user_uuid))
	{
		$rows = $this->Common_model->getData('users_details','1',"user_uuid='".$user_uuid."'");
		//print_r($this->db->last_query());exit;
		$arrayData = array(
		'heading'=>'User Detail','rowsData' =>$rows);
		$this->load->view('users/read',$arrayData);
	}
	else {
		$this->session->set_flashdata('message',"Oops Something Wrong!");
        redirect('Users/index');	
	}	
}
	public function delete($user_uuid)
	{
		if($user_uuid)
		{
			$row= $this->Common_model->getData("users_details","1","user_uuid='".$user_uuid."'");
			$data = array("is_deleted"=>"Yes","deleted_date"=>date('Y-m-d'),"deleted_by"=>$row->user_uuid);
			$cond ="user_uuid='".$user_uuid."'";
			$this->Common_model->delete("users_details",$cond);
			//print_r($this->db->last_query());exit;
			//$this->Common_model->save("users_details",$data,$cond);
			$this->session->set_flashdata('message',"Record has been deleted successfully");
        	redirect('Users/index');
		}
		else
		{
			$this->session->set_flashdata('message',"<span style='color:red'>No record found</span>");
        	redirect('Users/index');
		}
	}
	

	/*public function _rules() 
    {
		$this->form_validation->set_rules('cat_name', 'cat_name', 'trim|required');
		//$this->form_validation->set_rules('position', 'position', 'trim|required');
		//$this->form_validation->set_rules('description', 'description', 'trim|required');
		$this->form_validation->set_rules('id', 'id', 'trim');
		$this->form_validation->set_error_delimiters('<span>', '</span>');
    }*/

}