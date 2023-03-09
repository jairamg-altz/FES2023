<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');
class Welcome extends CI_Controller {
	 function __construct()
    {
        parent::__construct();
        $this->load->model('Common_model');
        $this->load->library('form_validation');
		$this->load->database();
		$this->load->library('session');
		$this->load->helper('url');
    }
	public function index()
	{
		$this->load->view('login');
	}
	public function login()
	{		
		if($_POST['user_id'] and $_POST['password'])
		{
			$getCredentials = $this->Common_model->get_single_with_cond("users_details","user_id='".$_POST['user_id']."' and password='".md5($_POST['password'])."' and role='Admin'");
//print_r($this->db->last_query());exit;
			if($getCredentials)
			{
				
				$data[session_name] = array("user_uuid"=>$getCredentials->user_uuid,"user_id"=>$getCredentials->user_id,
							  "first_name"=>$getCredentials->first_name,
							  "middle_name"=>$getCredentials->middle_name,
							  "last_name"=>$getCredentials->last_name,
							  "email"=>$getCredentials->email,
							  "profile_image"=>$getCredentials->profileimage_id,
							);
				
				$this->session->set_userdata($data);
				redirect(site_url("Dashboard"));
			}
			else
			{
				$this->session->set_flashdata('message','You have entered wrong credentials.');
				redirect(site_url('Welcome/index'));
			}

		}
		else
		{
			redirect(site_url('Welcome/index'));
		}

		/*print_r($_POST['email']);exit;*/

		/*if($_POST['email'] || $_POST['password'])
		{
			$getUserData = $this->Common_model->get_single_with_cond("users","email='".$_POST['email']."' and password='".md5($_POST['password'])."'");
			if($getUserData)
			{
				
				$the_session[session_name] = array('id'=>$getUserData->id,'name'=>$getUserData->name,"email" => $getUserData->email);
                $this->session->set_userdata($the_session);
                redirect(site_url('Dashboard'));
                
			}
			else
			{
				$this->session->set_flashdata('message','You have entered wrong credentials.');
                redirect(site_url('Welcome'));
			}
		}
		else
		{
			$this->load->view('login');
		}*/
	}
	public function change_status($status,$id)
	{
		if($status=='Active')
		{
			$varForStatus='Inactive';
		}
		else
		{
			$varForStatus='Active';
		}
		$data= array('status'=>$varForStatus,"modified"=>date('Y-m-d H:i:s'));
		$this->Common_model->save('worker_registrations',$data,"id='".$id."'");
		//print_r($this->db->last_query());exit;
		$this->session->set_flashdata("message","Status has been changed successfully");
		redirect(site_url('Welcome/user_list'));
	}
	public function logout()
	{
		
		$this->session->unset_userdata($_SESSION[session_name]);
     	$this->session->sess_destroy($_SESSION[session_name]);
     	redirect('Welcome');
	}

	public function registration()
	{
		$this->load->view('registration');
	}

	public function registrationData()
	{
		$rand= rand(0000,9999);
		$data= array("name"=>$_POST['name'],"email"=>$_POST['email'],"password"=>md5($rand),"created"=>date("Y-m-d H:i:s"));
		$this->Common_model->save("users_w",$data);
		echo "1";exit;
	}

	public function change_password()
	{
		//print_r($_SESSION);exit;
		$this->load->view('change_password');
	} 

	   /*/*change password functionality code
        public function update_pass()
        {
           $this->load->View('changepassword');
        }*/

      public function update_password()
      {
         
        $conForPassword="password='".md5($_POST['opassword'])."' and user_uuid='".$_SESSION['FES_admin']['user_uuid']."'";
        $checkPasswordData=$this->Common_model->get_single_with_cond("users_details",$conForPassword);
       
        if($checkPasswordData) 
        { 
              /*check for new pass and confirm pass*/
              if($_POST['npassword'] == $_POST['cpassword'])
              {
                      $data=array('password' =>md5($_POST['npassword'])	
                          //"modified"=>date('Y-m-d H:i:s')
                    );
                      
                       
                        $this->Common_model->save("users_details",$data,"user_uuid='".$_SESSION['FES_admin']['user_uuid']."'");
                        //print_r($this->db->last_query());
                        exit;
                        $this->session->set_flashdata('message',"<span style='color:green;''>Pasword has been changed successfully</span>");
                        
                        redirect('Welcome');
                }
                else
                {
 
                  $this->session->set_flashdata('message',"New password and confirm password must be same.");
                  redirect('Welcome/change_password');
               }
        }
        else  
        {
        
         $this->session->set_flashdata("message","You have entered wrong password");
          redirect('Welcome/change_password');
       
        }               
    }
public function user_list()
    {
    	$getData = $this->Common_model->get_all('users');
    	$data = array("usersData"=>$getData);
		  $this->load->view('users/list',$data);
    }
public function WorkerS()
{
	$category = $this->Common_model->getData('categories','',"status='Active'");
	//$states = $this->Common_model->getData('states');
	//print_r($this->db->last_query());exit;
	$cities = $this->Common_model->getCities();
	$data = array(
		'button'=>'Create',
		'heading'=>'Create Worker',
		'action'=>site_url('Welcome/WorkerAction'),
		'id' => set_value('id'),
		'emp_code' => set_value('emp_code'),
		'category_id' => set_value('category_id'),
		'subcat_id' => set_value('subcat_id'),
		'first_name' => set_value('first_name'),
		'middle_name' => set_value('middle_name'),
		'email' => set_value('email'),
		'mobile1' => set_value('mobile1'),
		'state_id' => set_value('state_id'),
		'city_id' => set_value('city_id'),
		'aadhar_no' => set_value('aadhar_no'),
		'profile_url' => set_value('profile_url'),
		'aadhar_url' => set_value('aadhar_url'),
		'signature_url' => set_value('signature_url'),
		'address' => set_value('address'),
		'current_location' => set_value('current_location'),
		'pincode'=>set_value('pincode'),
		'modified' => set_value('created'),
		'cities'=>$cities,
		'category'=>$category,
		'error' =>'');
		$this->load->view('users/form',$data);
}  
public function WorkerAction()
{
	if(!empty($_REQUEST))
	{
		$arrayData = array('emp_code' => $_POST['emp_code'],'category_id'=>$_POST['category_id'],'subcat_id'=>$_POST['subcat_id'],'first_name'=>$_POST['first_name'],'mobile1'=>$_POST['mobile1'],'state_id'=>'1','city_id'=>$_POST['city_id'],'aadhar_no'=>$_POST['aadhar_no'],'profile_url'=>$_POST['profile_url'],'aadhar_url'=>$_POST['aadhar_url'],'signature_url'=>$_POST['signature_url'],'address'=>$_POST['address'],'pincode'=>$_POST['pincode'],'current_location'=>$_POST['current_location']);
		$this->Common_model->save('worker_registrations',$arrayData);
		$this->session->set_flashdata('message',"Record has been created successfully");
	            	  redirect('Welcome/user_list');
	}
	else{
		$this->session->set_flashdata('message',"Oops Something Wrong!");
        redirect('Welcome/user_list');	
	}
} 
public function UpdateWorker($id)
{
	$update = $this->Common_model->get_single_with_cond('worker_registrations',"id='".$id."'");
	$cities = $this->Common_model->getCities();
	if(!empty($update))
	{
		$data = array(
		'button'=>'Update',
		'heading'=>'Update Worker',
		'action'=>site_url('Welcome/UpdateWorkerAction'),
		'id' => set_value('id', $update->id),
		'emp_code' => set_value('emp_code', $update->emp_code),
		'category_id' => set_value('category_id', $update->category_id),
		'subcat_id' => set_value('subcat_id', $update->subcat_id),
		'first_name' => set_value('first_name', $update->first_name),
		'middle_name' => set_value('middle_name', $update->middle_name),
		'email' => set_value('email', $update->email),
		'mobile1' => set_value('mobile1', $update->mobile1),
		'state_id' => set_value('state_id', $update->state_id),
		'city_id' => set_value('city_id', $update->city_id),
		'aadhar_no' => set_value('aadhar_no', $row->aadhar_no),
		'address' => set_value('address', $update->address),
		'current_location' => set_value('current_location', $update->current_location),
		'pincode'=>set_value('pincode', $update->pincode),
		'modified' => set_value('modified',$update->modified),
		"cities"=>$cities,
		'error' =>'');
		$this->load->view('users/form',$data);
	}
	else {
		$this->session->set_flashdata('message',"Oops Something Wrong!");
        redirect('Welcome/user_list');
	}	
}
public function UpdateWorkerAction()
{
	if(!empty($_REQUEST['id']))
	{
		$data = array("emp_code"=>$this->input->post('emp_code'),
					  "city_id"=>$this->input->post('city_id'),	
					  "pincode"=>$this->input->post('pincode'),
					  "current_location"=>$this->input->post('current_location'),
					  "modified"=>date('Y-m-d H:i:s'));
	            	  $this->Common_model->save('worker_registrations',$data,"id='".$_REQUEST['id']."'");
	            	  $this->session->set_flashdata('message',"Record has been created successfully");
	            	  redirect('Welcome/user_list');
	}
	else {
	$this->session->set_flashdata('message',"Oops Something Wrong!");
        redirect('Welcome/user_list');	
	}
}
public function read($id)
{
	if(!empty($id))
	{
		$cond="wr.id='".$id."' and wr.status='Active'";
		$rows = $this->Common_model->getWorkersCond($cond);
		//print_r($this->db->last_query());exit;
		$arrayData = array('button'=>'Update',
		'heading'=>'Worker Details','rowsData' =>$rows);
		$this->load->view('users/read',$arrayData);
	}
	else {
		$this->session->set_flashdata('message',"Oops Something Wrong!");
        redirect('Welcome/user_list');	
	}	
}
public function deleteUser($id)
{
	$this->Common_model->delete("users",'id="'.$id.'"');
	$this->session->set_flashdata("message","Record deleted successfully");
    redirect('Welcome/user_list');
}
}