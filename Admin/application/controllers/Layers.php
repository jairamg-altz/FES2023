<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Layers extends CI_Controller {
	 function __construct()
    {
        parent::__construct();
        $this->load->database();
      	
    }
public function index()
	{
		$getData = $this->Common_model->getData("layer_configuration");
		$data = array("LayersData"=>$getData);
		$this->load->view('lc/list',$data);
	}	
public function layerStatus($status,$id)
{
	$_POST['layer_id'] = $id;
	if($status=='Invisible') {
		$aD = array('layer_status' =>'visible');
		$this->Common_model->save('layer_configuration',$aD,"layer_id='".$_POST['layer_id']."'");
		redirect('Layers/index');
	}
	else {
		$aD = array('layer_status' =>'Invisible');
		$this->Common_model->save('layer_configuration',$aD,"layer_id='".$_POST['layer_id']."'");
		redirect('Layers/index');
	}
}
public function create()
	{
		$categoryD= $this->Common_model->getDistric("layer_configuration");
		//print_r($this->db->last_query());exit;
		$data = array(
				'action' =>site_url('Layers/create_action'),
				'button'=>'Create',
				'heading'=>'Create Layer Configuration',
				'layer_type'=>set_value('layer_type'),
				'layer_name'=>set_value('layer_name'),
				'category'=>set_value('category'),
				'layer_url'=>set_value('layer_url'),
				'description'=>set_value('description'),
				'from_date'=>set_value('from_date'),
				'to_date'=>set_value('to_date'),
				'layer_id' => set_value('layer_id'),'categoryD'=>$categoryD,
	    		'error' =>''
		);
		$this->load->view('lc/form',$data);
	}
	
public function create_action()
	{
		//print_r($_REQUEST);exit;
		if(!empty($this->input->post('categoryI')))
		{
			$categoryDD = $this->input->post('categoryI');
		}
		elseif (!empty($this->input->post('categoryS'))) {
			$categoryDD = $this->input->post('categoryS');
		}
		else {
			redirect('Layers/create');  	
		}
		$data = array("layer_type"=>$this->input->post('layer_type'),"layer_name"=>$this->input->post('layer_name'),"category"=>$categoryDD,"layer_url"=>$this->input->post('layer_url'),"description"=>$this->input->post('description'),"from_date"=>$this->input->post('from_date'),"to_date"=>$this->input->post('to_date'));
		$this->Common_model->save('layer_configuration',$data);
		$this->session->set_flashdata('message',"Record has been created successfully");
        redirect('Layers/index');  	              				
	}	

public function update($layer_id)
	{
		$row= $this->Common_model->getData("layer_configuration","","layer_id='".$layer_id."'");
		$categoryD= $this->Common_model->getDistric("layer_configuration");
		$data = array(
		'button'=>'Update',
		'heading'=>'Update Layer Configuration',
		'action'=>site_url('Layers/update_action'),
		'layer_id' => set_value('layer_id', $row[0]->layer_id),
		'layer_type' => set_value('layer_type', $row[0]->layer_type),
		'layer_name' => set_value('layer_name', $row[0]->layer_name),
		'category' => set_value('category', $row[0]->category),
		'layer_url' => set_value('layer_url', $row[0]->layer_url),
		'description' => set_value('description', $row[0]->description),
		'from_date' => set_value('from_date', $row[0]->from_date),
		'to_date' => set_value('to_date', $row[0]->to_date),'categoryD'=>$categoryD,
		'error' =>'');
		//print_r($data);exit;
		$this->load->view('lc/form',$data);

	}

public function update_action()
	{
			$row= $this->Common_model->getData("layer_configuration","1","layer_id='".$_POST['layer_id']."'");
		if(!empty($this->input->post('categoryI')))
		{
			$categoryDD = $this->input->post('categoryI');
		}
		elseif (!empty($this->input->post('categoryS'))) {
			$categoryDD = $this->input->post('categoryS');
		}
		else {
			redirect('Layers/update/'.$row->layer_id);  	
		}
			$data = array("layer_type"=>$this->input->post('layer_type'),"layer_name"=>$this->input->post('layer_name'),"category"=>$categoryDD,"layer_url"=>$this->input->post('layer_url'),"description"=>$this->input->post('description'),"from_date"=>$this->input->post('from_date'),"to_date"=>$this->input->post('to_date'));
        	$this->Common_model->save('layer_configuration',$data,"layer_id='".$row->layer_id."'");
			$this->session->set_flashdata('message',"Record has been updated successfully");
			redirect('Layers/index');       						
			
}
public function delete($layer_id)
{
	$this->Common_model->delete('layer_configuration',"layer_id='".$layer_id."'");
	$this->session->set_flashdata('message',"Record delete successfully");
			redirect('Layers/index');
}
}