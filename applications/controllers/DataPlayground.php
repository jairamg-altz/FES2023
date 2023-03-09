<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class DataPlayground extends CI_Controller {

public function __construct()
    {
        parent::__construct();
        /*if(empty($_SESSION[SESSION_NAME]['user_uuid']))
        {
            redirect('home');
        } */
    }    

public function index()
    {
        $data = array(
            'foo' => 'bar','datavalue' =>"" 
        );
        $this->load->view('data_playground', $data);
    
    }
public function sharelink($data)
    {
        if(!empty($data)) {
        $data = array(
            'foo' => 'bar','datavalue' =>$data 
        );
        $this->load->view('data_playground', $data);
    } else {
        $data = array(
            'foo' => 'bar','datavalue' =>"" 
        );
        $this->load->view('data_playground', $data);
    }
    }    
public function index_test()
    {
        $data = array(
            'foo' => 'bar','datavalue' =>""  
        );
        $this->load->view('data_playground_test', $data);
    }
 

}

/* End of file Species.php */
?>