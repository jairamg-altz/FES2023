<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Search extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        if(empty($_SESSION[SESSION_NAME]['user_uuid']))
        {
            redirect('home');
        }
    }    

public function index()
    {
        //print_r($_POST['sname']);exit;
        $this->load->view('searchList');
    }
public function SearchD()
{
    $cond="checklist_name LIKE '%".$_REQUEST['search']."%'";
    $data = $this->Crud_model->GetData('checklist','',$cond);
   foreach ($data as $key => $value) {
        $checklistName[] = array('id' =>$value->checklist_id,'name'=>$value->checklist_name);
    }
    //print_r($this->db->last_query());exit;
    echo json_encode($checklistName);exit;
}    
public function GetSearchData()
{
    //print_r($_REQUEST['txt_search']);exit;
    $cond="checklist_name LIKE '".$_REQUEST['txt_search']."%'";
    $data = $this->Crud_model->GetData('checklist','',$cond);
    $sdata = array('checklistD' =>$data);
    $this->load->view('searchList',$sdata);
}
}
?>