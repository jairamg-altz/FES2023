<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class ScNames extends CI_Controller {
	 function __construct()
    {
        parent::__construct();
        $this->load->database(); 
        //$this->load->model('Sp_model');
        //ini_set('memory_limit', '10240M');  
    }
public function indexTest()
{
	print_r("sf");exit;
}
public function index()
	{
		print_r("sf");exit;
		/*$getData = $this->Common_model->getData("species_common_names",'','','','','8000');
		//print_r($getData);exit;
		$data = array("ScNData"=>$getData);*/
		
		//$this->load->view('ccc/list');
	}
public function ajax_list()
    {
        $list = $this->Sp_model->get_datatables();
        print_r($this->db->last_query());exit;
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $sprs) {
        	$button ="";
        		$button = echo anchor(site_url('ScNData/update/'.$sprs->col_id),'<button class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i>&nbsp;Edit</button>'); 
                      $button .=  echo '|';
                       $button .=  echo anchor(site_url('ScNData/delete/'.$sprs->col_id),'<button class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i>&nbsp;Delete</button>','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
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
				'action' =>site_url('ScNames/create_action'),
				'button'=>'Create',
				'heading'=>'Create Species Masters',
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
                    redirect('ScNames/index');		              				
	}	

public function update($col_id)
	{
		$row= $this->Common_model->getData("species_master","1","col_id='".$col_id."'",'','','10');
		//print_r($row);exit;	
		$data = array(
		'button'=>'Update',
		'heading'=>'Update Species Masters',
		'action'=>site_url('ScNames/update_action'),
		'col_id' => set_value('col_id', $row->col_id),
		'language' => set_value('language', $row->language),
		'common_name' => set_value('common_name', $row->common_name),
		'scientific_name' => set_value('scientific_name', $row->scientific_name),
		'error' =>'');
		$this->load->view('ccc/form',$data);

	}

public function update_action()
	{
			$row= $this->Common_model->getData("species_master","1","col_id='".$_POST['col_id']."'");
			$data = array("language"=>$this->input->post('language'),"common_name"=>$this->input->post('common_name'),"scientific_name"=>$this->input->post('scientific_name'));
        	$this->Common_model->save('species_common_names',$data,"col_id='".$row->col_id."'");
			$this->session->set_flashdata('message',"Record has been updated successfully");
			redirect('ScNames/index');	
}
// Delete Functionality  
public function delete($col_id)
	{
		if($col_id)
		{
			$this->Common_model->delete("species_common_names","col_id='".$col_id."'");
			$this->session->set_flashdata('message',"Record has been deleted successfully");
        	redirect('ScNames/index');
		}
		else
		{
			$this->session->set_flashdata('message',"<span style='color:red'>No record found</span>");
        	redirect('ScNames/index');
		}
	}
}