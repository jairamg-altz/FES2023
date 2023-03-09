<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class DResponses extends CI_Controller {
	 function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

public function index()
	{
		$getData = $this->Common_model->getDRData();
		$data = array("DResponsesData"=>$getData);
		$this->load->view('discussionResponse/list',$data);
	}

public function update($response_id)
	{
		$row= $this->Common_model->getData("discussion_responses","1","response_id='".$response_id."'");	
		$data = array(
		'button'=>'Update',
		'heading'=>'Update Discussion Response',
		'action'=>site_url('DResponses/update_action'),
		'text_msg' => set_value('text_msg', $row->text_msg),
		'like_no' => set_value('like_no', $row->like_no),'forum_id'=>set_value('forum_id',$row->discussion_foroum_id),'response_id'=>set_value('response_id',$response_id),
		'error' =>'');
		$this->load->view('discussion/rform',$data);
	}

public function update_action()
	{
			$row= $this->Common_model->getData("discussion_responses","1","response_id='".$_POST['response_id']."'");
			$data = array("text_msg"=>$this->input->post('text_msg'),
	                      "like_no"=>$this->input->post('like_no'),
	                      "modified_date"=>date('Y-m-d'));
	                	$this->Common_model->save('discussion_responses',$data,"response_id='".$row->response_id."'");
						$this->session->set_flashdata('message',"Record has been updated successfully");
	        			redirect('DResponses/index');
            						
			
}

}