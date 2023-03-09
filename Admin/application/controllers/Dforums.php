<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dforums extends CI_Controller {
	 function __construct()
    {
        parent::__construct();
        $this->load->database();       	
    }

public function index()
	{
		$getData = $this->Common_model->getDiscussionForum();
		$data = array("DforumsData"=>$getData);
		$this->load->view('discussion/list',$data);
	}
	
public function create()
	{
		$data = array(
				'action' =>site_url('Dforums/create_action'),
				'button'=>'Create',
				'heading'=>'Create Discussion forum',
				'text_msg'=>set_value('text_msg'),
				'subject'=>set_value('subject'),
				'like_no'=>set_value('like_no'),
				'forum_id' => set_value('forum_id'),
	    		'error' =>'');
		$this->load->view('discussion/form',$data);
	}
public function create_action()
	{
		$data =       array("text_msg"=>$this->input->post('text_msg'),
							"subject"=>$this->input->post('subject'),
							"like_no"=>$this->input->post('like_no'),
							"created_by"=>$_SESSION['FES_admin']['user_uuid'],	
							"date_time"=>date('Y-m-d'),"is_deleted"=>'No');
                    		$this->Common_model->save('discussions',$data);
                    		$this->session->set_flashdata('message',"Record has been created successfully");
                    		redirect('Dforums/index');           	
		              				
	}	

public function update($forum_id)
	{
		$row= $this->Common_model->getData("discussions","1","forum_id='".$forum_id."'");	
		$data = array(
		'button'=>'Update',
		'heading'=>'Update Discussion forum',
		'action'=>site_url('Dforums/update_action'),
		'forum_id' => set_value('forum_id', $row->forum_id),
		'text_msg' => set_value('text_msg', $row->text_msg),
		'subject' => set_value('subject', $row->subject),
		'like_no' => set_value('like_no', $row->like_no),
		'error' =>'');
		$this->load->view('discussion/form',$data);
	}

public function update_action()
	{
			$row= $this->Common_model->getData("discussions","1","forum_id='".$_POST['forum_id']."'");
			$data = array("text_msg"=>$this->input->post('text_msg'),
	                      "subject"=>$this->input->post('subject'),
	                      "like_no"=>$this->input->post('like_no'),
	                      "modified_by"=>$_SESSION['FES_admin']['user_uuid'],
						  "modified_date"=>date('Y-m-d'));
	                	$this->Common_model->save('discussions',$data,"forum_id='".$row->forum_id."'");
						$this->session->set_flashdata('message',"Record has been updated successfully");
	        			redirect('Dforums/index');
            						
			
}
// Delete Functionality  
public function delete($forum_id)
	{
		if($forum_id)
		{
			$data = array("is_deleted"=>'Yes',"deleted_date"=>date('Y-m-d'),"deleted_by"=>$_SESSION['FES_admin']['user_uuid']);
			$this->Common_model->save("Dforums",$data,"forum_id='".$forum_id."'");
			$this->session->set_flashdata('message',"Record has been deleted successfully");
        	redirect('Dforums/index');
		}
		else
		{
			$this->session->set_flashdata('message',"<span style='color:red'>No record found</span>");
        	redirect('Dforums/index');
		}
	}

public function response($forum_id)
	{
		$row= $this->Common_model->getData("discussions","1","forum_id='".$forum_id."'");
		$data = array(
				'action' =>site_url('Dforums/response_action'),
				'button'=>'Create',
				'heading'=>'Create Discussion Response',
				'forum_id' => set_value('forum_id', $row->forum_id),
				'text_msg' => set_value('text_msg'),
				'like_no' => set_value('like_no'),'response_id'=>set_value('response_id'),
	    		'error' =>'');
		$this->load->view('discussion/rform',$data);
	}
public function response_action()
	{
		$data =       array("discussion_foroum_id"=>$this->input->post('forum_id'),
							"text_msg"=>$this->input->post('text_msg'),
							"respondor_userid"=>$_SESSION['FES_admin']['user_uuid'],
							"like_no"=>$this->input->post('like_no'),
							"created_by"=>$_SESSION['FES_admin']['user_uuid'],	
							"datetime"=>date('Y-m-d'));
                    		$this->Common_model->save('discussion_responses',$data);
                    		$this->session->set_flashdata('message',"Record has been created successfully");
                    		redirect('DResponses/index');           	
		              				
	}

}