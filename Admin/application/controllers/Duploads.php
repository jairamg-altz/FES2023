<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Duploads extends CI_Controller {
	 function __construct()
    {
        parent::__construct();
        $this->load->database();
       	$this->load->library('upload');
       	
    }

	public function index()
	{
		$getData = $this->Common_model->getDuploadsData();
		//print_r($getData);exit;
		$data = array("DuploadsData"=>$getData);
		$this->load->view('du/list',$data);
	}
	
public function duedit($duid)
	{
		$row= $this->Common_model->getData("data_uploads","1","data_uploads_id='".$duid."'");
		$data = array(
				'action' =>site_url('Duploads/duedit_action'),
				'button'=>'Update',
				'heading'=>'Update Data Upload Taxonamy',
				'admin_feedback'=>set_value('admin_feedback'),
				'status'=>set_value('status'),
				'duid' => $duid,
	    		'error' =>'');
		$this->load->view('du/form',$data);
	}
public function duedit_action()
{
	$row= $this->Common_model->getData("data_uploads","1","data_uploads_id='".$_POST['duid']."'");
	$Userrow= $this->Common_model->getData("users_details","1","user_uuid='".$row->user_id."'");
	$email = $Userrow->email;
	//SMTP & mail configuration
                    $this->load->library('email');
                    $config = array(
                        'protocol'  => 'smtp',
                        'smtp_host' => 'ssl://smtp.googlemail.com',
                        'smtp_port' => 465,
                        'smtp_user' => 'ibisfesadm@gmail.com',
                        'smtp_pass' => 'ibisadmin@123',
                        'mailtype'  => 'html',
                        'charset'   => 'utf-8'
                    );
                    $this->email->initialize($config);
                    $this->email->set_mailtype("html");
                    $this->email->set_newline("\r\n");

                    //Email content
                    $htmlContent = '<h1>Data upload Taxonomy Confirmation By Administrator Mail</h1>';
                    $htmlContent .= '<p>'.$otp.'</p>';
                    $this->email->to($email);
                    $this->email->from('ibisfesadm@gmail.com','IBIS');
                    $this->email->subject('Data upload Taxonomy Confirmation By Administrator');
                    $this->email->message($htmlContent);
                    $this->email->send();
			//print_r($row->id);exit;

			if(empty($row))
			{
				redirect('Duploads/index');
			}
			else
			{
				  	$data = array(
				  				"admin_feedback" => $this->input->post('admin_feedback'),
	                    		"status"=>$this->input->post('status'),
	                    		"modified"=>date('Y-m-d g:i:s'));	                    
	                	$this->Common_model->save('data_uploads',$data,"data_uploads_id='".$row->data_uploads_id."'");
	                $arrayUser = array('data_upload_status' =>$this->input->post('status'));	
	                $this->Common_model->save('users_details',$arrayUser,"user_uuid='".$row->user_id."'");	
						$this->session->set_flashdata('message',"Record has been updated successfully");
	        			redirect('Duploads/index');
            		}
}	
	

}