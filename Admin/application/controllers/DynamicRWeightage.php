<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class DynamicRWeightage extends CI_Controller {
	 function __construct()
    {
        parent::__construct();
        $this->load->database();
      	
    }
public function index()
	{
		$getData = $this->Common_model->getData("dynamic_reward_weightages");
		$data = array("DynamicRWeightageData"=>$getData);
		$this->load->view('drw/list',$data);
	}	

public function create()
	{
		$getData = $this->Common_model->getMaxData();
		if(!empty($getData->breward))
		{
			$Twight = $getData->breward;
		}
		else {
			$Twight = 0;
		}
		$data = array(
				'action' =>site_url('DynamicRWeightage/create_action'),
				'button'=>'Create',
				'heading'=>'Create Dynamic Reward Weightage',
				'dynamic_reward_title'=>set_value('dynamic_reward_title'),
				'dynamic_reward_weightage_from'=>set_value('dynamic_reward_weightage_from'),
				'dynamic_reward_weightage_to' => set_value('dynamic_reward_weightage_to'),'Twight'=>$Twight,
	    		'error' =>''
		);
		$this->load->view('drw/form',$data);
	} 

	
public function create_action()
	{
		$checkData = $this->Common_model->getData('dynamic_reward_weightages','',"dynamic_reward_title='".$this->input->post('dynamic_reward_title')."'");
if(empty($checkData)) {
		$data = array("dynamic_reward_title"=>$this->input->post('dynamic_reward_title'),"dynamic_reward_weightage_from"=>$this->input->post('dynamic_reward_weightage_from'),"dynamic_reward_weightage_to"=>$this->input->post('dynamic_reward_weightage_to'));
                $this->Common_model->save('dynamic_reward_weightages',$data);
                $this->session->set_flashdata('message',"Record has been created successfully");
                redirect('DynamicRWeightage/index'); 
                } else { 
$this->session->set_flashdata('message',"Record already exist");
                redirect('DynamicRWeightage/create');
                }		              				
	}	
public function update($dynamic_reward_weightages_id)
	{
		$row= $this->Common_model->getData("dynamic_reward_weightages","","dynamic_reward_weightages_id='".$dynamic_reward_weightages_id."'");
		$getData = $this->Common_model->getMaxData();
		if(!empty($getData->breward))
		{
			$Twight = $getData->breward;
		}
		else {
			$Twight = 0;
		}	
		$data = array(
		'button'=>'Update',
		'heading'=>'Update Dynamic Reward Weightage',
		'action'=>site_url('DynamicRWeightage/update_action'),
		'dynamic_reward_weightages_id' => set_value('dynamic_reward_weightages_id', $row[0]->dynamic_reward_weightages_id),
		'dynamic_reward_title' => set_value('dynamic_reward_title', $row[0]->dynamic_reward_title),'dynamic_reward_weightage_from' => set_value('dynamic_reward_weightage_from', $row[0]->dynamic_reward_weightage_from),'dynamic_reward_weightage_to' => set_value('dynamic_reward_weightage_to', $row[0]->dynamic_reward_weightage_to),'Twight'=>$Twight,
		'error' =>'');
		//print_r($data);exit;
		$this->load->view('drw/form',$data);

	}

public function update_action()
	{
			$cond ="dynamic_reward_weightage_to between '".$this->input->post('dynamic_reward_weightage_from')."' and '".$this->input->post('dynamic_reward_weightage_to')."'";
			$getData = $this->Common_model->getData('dynamic_reward_weightages','',$cond);
			$row= $this->Common_model->getData("dynamic_reward_weightages","1","dynamic_reward_weightages_id='".$_POST['dynamic_reward_weightages_id']."'");
			if(empty($getData)) {			
			$data = array("dynamic_reward_title"=>$this->input->post('dynamic_reward_title'),"dynamic_reward_weightage_from"=>$this->input->post('dynamic_reward_weightage_from'),"dynamic_reward_weightage_to"=>$this->input->post('dynamic_reward_weightage_to'));
	        $this->Common_model->save('dynamic_reward_weightages',$data,"dynamic_reward_weightages_id='".$row->dynamic_reward_weightages_id."'");
			$this->session->set_flashdata('message',"Record has been updated successfully");
	        redirect('DynamicRWeightage/index');
           } 						
		else {
			redirect('DynamicRWeightage/update/'.$row->dynamic_reward_weightages_id);
		}	
}
}