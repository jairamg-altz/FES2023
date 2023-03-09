<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Feedbacks extends CI_Controller {
	 function __construct()
    {
        parent::__construct();
        $this->load->database();
       	$this->load->library('upload');       	
    }
	public function index()
	{
		$cond ="feedbacks.is_deleted='No'";
		$getData = $this->Common_model->getFeedbacks($cond);
		$data = array("FeedbacksData"=>$getData);
		$this->load->view('feedbacks/list',$data);
	}
	public function visibility($feedback_id)
	{
		$fcond = "feedback_id='".$feedback_id."'";
		$feedback = $this->Common_model->get_single_with_cond('feedbacks',$fcond);
		if(empty($feedback->visibility))
		{
		$data= array('visibility'=>'Unpublish',"modified_date"=>date('Y-m-d'),'modified_by'=>$_SESSION['FES_admin']['user_uuid']);
		$this->Common_model->save('feedbacks',$data,"feedback_id='".$feedback_id."'");
		//print_r($this->db->last_query());exit;
		$this->session->set_flashdata("message","Visibility has been changed successfully");
		redirect(site_url('Feedbacks/index'));
		}
		elseif($feedback->visibility=='Unpublish')
		{
			$data= array('visibility'=>'Publish',"modified_date"=>date('Y-m-d'),'modified_by'=>$_SESSION['FES_admin']['user_uuid']);
		    $this->Common_model->save('feedbacks',$data,"feedback_id='".$feedback_id."'");
		    //print_r($this->db->last_query());exit;
			$this->session->set_flashdata("message","Status has been changed successfully");
			redirect(site_url('Feedbacks/index'));
		}
		else{
			redirect(site_url('Feedbacks/index'));
		}
		$this->session->set_flashdata("message","Status has been changed successfully");
		
	}
	

	public function reply($feedback_id)
	{
		$fcond = "feedback_id='".$feedback_id."'";
		$feedback = $this->Common_model->get_single_with_cond('feedbacks',$fcond);
		//print_r($feedback);exit;
		$data = array(
				'action' =>site_url('Feedbacks/reply_action'),
				'button'=>'Response',
				'heading'=>'Response',
				'text_msg'=>set_value('text_msg'),
				'visibility'=>set_value('visibility'),
	    		'feedback_id' => $feedback_id,
	    		'error' =>'');
		$this->load->view('feedbacks/response',$data);
	}

//User Response By Admin
	public function reply_action()
	{
		//print_r($_SESSION);exit;
		if(empty($_POST['text_msg']))
		{
			redirect('Feedbacks/create');
		}
		else{
			$row= $this->Common_model->getData("feedbacks","1","feedback_id='".$_POST['feedback_id']."'");
				$data = array("text_msg"=>$this->input->post('text_msg'),
                    		"visibility"=>$this->input->post('visibility'),
                    		"feedback_uuid"=>$row->feedback_id,
                    		"respondent_userid"=>$row->created_by,
                    		"created_by"=>$_SESSION['FES_admin']['user_uuid'],"created_date"=>date('Y-m-d'),
                    		"is_deleted"=>'No'
                    	);
				$this->Common_model->save('responses',$data);                    		
                $this->session->set_flashdata('message',"Record has been created successfully");
                redirect('Feedbacks/index');
		}
}
// View Response	
public function read($feedback_id)
{
	if(!empty($feedback_id))
	{
		$rows = $this->Common_model->getData('feedbacks','1',"feedback_id='".$feedback_id."'");
		$cond="feedbacks.feedback_id='".$rows->feedback_id."'";
		$ResponseD = $this->Common_model->getFeedbackResponse($cond);
		//print_r($ResponseD);exit;
		$arrayData = array(
		'heading'=>'Feedback Response','rowsData' =>$rows,'ResponseD'=>$ResponseD);
		$this->load->view('feedbacks/read',$arrayData);
	}
	else {
		$this->session->set_flashdata('message',"Oops Something Wrong!");
        redirect('Feedbacks/index');	
	}	
}
// Delete Functionality
public function delete($feedback_id)
	{
		if($feedback_id)
		{
			$data = array("is_deleted"=>"Yes","deleted_date"=>date('Y-m-d'),"deleted_by"=>$_SESSION['FES_admin']['user_uuid']);
			$this->Common_model->save("feedbacks",$data,"feedback_id='".$feedback_id."'");
			$this->session->set_flashdata('message',"Record has been deleted successfully");
        	redirect('Feedbacks/index');
		}
		else
		{
			$this->session->set_flashdata('message',"<span style='color:red'>No record found</span>");
        	redirect('Feedbacks/index');
		}
	}

}