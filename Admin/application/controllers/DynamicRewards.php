<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class DynamicRewards extends CI_Controller {
	 function __construct()
    {
        parent::__construct();
        $this->load->database();
      	
    }
public function index()
	{
		$getData = $this->Common_model->getData("rewards_weightage");
		$data = array("DynamicRewardsData"=>$getData);
		$this->load->view('drs/list',$data);
	}	

public function update($category)
	{
		$row= $this->Common_model->getData("rewards_weightage","","category='".$category."'");
		$catData= $this->Common_model->getData("rewards_weightage");	
		//print_r($row);exit;
		$data = array(
		'button'=>'Update',
		'heading'=>'Update Dynamic Reward System',
		'action'=>site_url('DynamicRewards/update_action'),'categoryData'=>$catData,
		'category' => set_value('category', $row[0]->category),
		'category_name' => set_value('category_name', $row[0]->category_name),
		'weightage' => set_value('weightage', $row[0]->weightage),
		'error' =>'');
		$this->load->view('drs/form',$data);

	}

public function update_action()
	{
		//print_r($_REQUEST);exit;
			$row= $this->Common_model->getData("rewards_weightage","1","category='".$_REQUEST['category']."'");
			$data = array("weightage"=>$this->input->post('weightage'));
	        $this->Common_model->save('rewards_weightage',$data,"category='".$row->category."'");
			$this->session->set_flashdata('message',"Record has been updated successfully");
   			redirect('DynamicRewards/index');
            						
			
}
}