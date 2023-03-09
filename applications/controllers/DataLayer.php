<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class DataLayer extends CI_Controller {
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
        $data =  array("srs" => "3857");
         $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => NODE_URL.'/getTotalStatistics',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
        $response = curl_exec($curl);
        
        curl_close($curl);
        $arrayRes = json_decode(($response), true);
        $GetDataSet = $this->Crud_model->GetData('data_attributes');
        foreach ($arrayRes as $value);
        if(!empty($value))
        {
            $getData = $this->Crud_model->GetData('layer_configuration','',"layer_type='Raster'");
            $data = array('DataLayer' =>$getData,'TotalStatistics' =>$value);
        }
        else {
             $getData = $this->Crud_model->GetData('layer_configuration','',"layer_type='Raster'");
            $data = array('DataLayer' =>array(),'Added_this_week' =>'0','Total_Species'=>'0','Taxonomy_Data'=>'0','GetDataSet'=>'');
        }
        $this->load->view('Dlayer',$data);
    }

}

?>