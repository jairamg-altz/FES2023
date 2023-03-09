<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class CommonName extends CI_Controller {
	 function __construct()
    {
        parent::__construct();
        $this->load->database();
      	$this->load->model('Sp_model');
    }
public function index()
	{
		$this->load->view('ccc/list');
	}	
public function ajax_listD()
    {
    	//print_r("expression");exit;
    	$list = $this->Sp_model->get_datatables();
        //print_r($this->db->last_query());exit;
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $sprs) {
        	$button ="";
        	$button = '<a href="'.site_url('CommonName/update/'.$sprs->col_id) . '"><button class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i>&nbsp;Edit</button></a> |'; 
            $button .= '<a href="'.site_url('CommonName/delete/'.$sprs->col_id) . '"><button class="btn btn-xs btn-danger" onclick="javasciprt: return confirm(\'Are You Sure ?\')"><i class="glyphicon glyphicon-trash"></i>&nbsp;Delete</button></a>';
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $sprs->col_id;
            $row[] = $sprs->language;
            $row[] = $sprs->common_name;
            $row[] = $sprs->scientific_name;
            $row[] = $button;
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Sp_model->count_all(),
                        "recordsFiltered" => $this->Sp_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
public function create()
	{
		$data = array(
				'action' =>site_url('CommonName/create_action'),
				'button'=>'Create',
				'heading'=>'Create Species Common Name',
				'col_id'=>set_value('col_id'),
				'language'=>set_value('language'),
				'common_name'=>set_value('common_name'),
				'scientific_name'=>set_value('scientific_name'),
				'error' =>'');
		$this->load->view('ccc/form',$data);
	}

public function create_action()
	{		
		$data = array("col_id"=>$this->input->post('col_id'),"language"=>$this->input->post('language'),"common_name"=>$this->input->post('common_name'),"scientific_name"=>$this->input->post('scientific_name'));
                    $this->Common_model->save('species_common_names',$data);
                    $this->session->set_flashdata('message',"Record has been created successfully");
                    redirect('CommonName/index');		              				
	}	

public function update($col_id)
	{
		$row= $this->Common_model->getData("species_common_names","1","col_id='".$col_id."'",'','','10');
		//print_r($row);exit;	
		$data = array(
		'button'=>'Update',
		'heading'=>'Update Species Common Name',
		'action'=>site_url('CommonName/update_action'),
		'col_id' => set_value('col_id', $row->col_id),
		'language' => set_value('language', $row->language),
		'common_name' => set_value('common_name', $row->common_name),
		'scientific_name' => set_value('scientific_name', $row->scientific_name),
		'error' =>'');
		$this->load->view('ccc/form',$data);

	}

public function update_action()
	{
			$row= $this->Common_model->getData("species_common_names","1","col_id='".$_POST['col_id']."'");
			$data = array("language"=>$this->input->post('language'),"common_name"=>$this->input->post('common_name'),"scientific_name"=>$this->input->post('scientific_name'));
        	$this->Common_model->save('species_common_names',$data,"col_id='".$row->col_id."'");
			$this->session->set_flashdata('message',"Record has been updated successfully");
			redirect('CommonName/index');	
}
// Delete Functionality  
public function delete($col_id)
	{
		if($col_id)
		{
			$this->Common_model->delete("species_common_names","col_id='".$col_id."'");
			$this->session->set_flashdata('message',"Record has been deleted successfully");
        	redirect('CommonName/index');
		}
		else
		{
			$this->session->set_flashdata('message',"<span style='color:red'>No record found</span>");
        	redirect('CommonName/index');
		}
	}
}