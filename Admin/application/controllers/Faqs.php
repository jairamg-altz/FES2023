<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Faqs extends CI_Controller {
	 function __construct()
    {
        parent::__construct();
        $this->load->database();
       	$this->load->library('upload');
       	
    }
public function index()
	{
		$getData = $this->Common_model->getData("faqs",'',"is_deleted='No'");
		$data = array("FaqData"=>$getData);
		$this->load->view('faq/list',$data);
	}
public function create()
	{
		$data = array(
				'action' =>site_url('Faqs/create_action'),
				'button'=>'Create',
				'heading'=>'Create FAQ',
				'question'=>set_value('question'),
				'answer'=>set_value('answer'),
				'faq_id' => set_value('faq_id'),
	    		'error' =>'',

		);
		$this->load->view('faq/form',$data);
	}


	public function create_action()
	{
		$data = array(
                			"question"=>$this->input->post('question'),"answer"=>$this->input->post('answer'),'created_by'=>$_SESSION['FES_admin']['user_uuid'],'is_deleted'=>'No');
                    		$this->Common_model->save('faqs',$data);
                    		$this->session->set_flashdata('message',"Record has been created successfully");
                    		redirect('Faqs/index');
            	
		              				
	}	

	public function update($faq_id)
	{
		$row= $this->Common_model->getData("faqs","","faq_id='".$faq_id."'");	
		$data = array(
		'button'=>'Update',
		'heading'=>'Update FAQ',
		'action'=>site_url('Faqs/update_action'),
		'faq_id' => set_value('faq_id', $row[0]->faq_id),
		'question' => set_value('question', $row[0]->question),'answer' => set_value('answer', $row[0]->answer),'error' =>'');
		$this->load->view('faq/form',$data);

	}

	public function update_action()
	{
		$row= $this->Common_model->getData("faqs","1","faq_id='".$_POST['faq_id']."'");
		$data = array("question"=>$this->input->post('question'),
				"answer"=>$this->input->post('answer'),'modified_date'=> date('Y-m-d H:i:s'),'visibility_status'=>$this->input->post('visibility_status'),'modified_by'=>$_SESSION['FES_admin']['user_uuid'],'is_deleted'=>'No');
    	$this->Common_model->save('faqs',$data,"faq_id='".$row->faq_id."'");
		$this->session->set_flashdata('message',"Record has been updated successfully");
		redirect('Faqs/index');
            						
			
}
// Delete Functionality  
public function delete($faq_id)
	{
		if($faq_id)
		{
			$data = array('is_deleted'=> 'Yes','deleted_date'=>date('Y-m-d H:i:s'),'deleted_by'=>$_SESSION['FES_admin']['user_uuid']
	                   );
			$this->Common_model->save("faqs",$data,"faq_id='".$faq_id."'");
			$this->session->set_flashdata('message',"Record has been deleted successfully");
        	redirect('Faqs/index');
		}
		else
		{
			$this->session->set_flashdata('message',"<span style='color:red'>No record found</span>");
        	redirect('Faqs/index');
		}
	}
}