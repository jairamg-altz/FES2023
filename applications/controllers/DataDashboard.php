<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class DataDashboard extends CI_Controller {
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
        //print_r($TotalStatistics[2]['sp_parameter']);exit;
        if(!empty($value))
        {
            $arrayData = array('TotalStatistics' =>$value,'GetDataSet'=>$GetDataSet);
            //print_r($TotalStatistics);exit;
            $this->load->view('data_dashboard',$arrayData,$value);
        }
        else {
                $arrayData = array('Added_this_week' =>'0','Total_Species'=>'0','Taxonomy_Data'=>'0','GetDataSet'=>'');
                $this->load->view('data_dashboard',$arrayData);    
        }
    }
 public function Species()
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
        //print_r($TotalStatistics[2]['sp_parameter']);exit;
        if(!empty($value))
        {
            $arrayData = array('TotalStatistics' =>$value,'GetDataSet'=>$GetDataSet);
            //print_r($TotalStatistics);exit;
            $this->load->view('data_species',$arrayData,$value);
        }
        else {
                $arrayData = array('Added_this_week' =>'0','Total_Species'=>'0','Taxonomy_Data'=>'0','GetDataSet'=>'');
                $this->load->view('data_species',$arrayData);    
        }
    }

public function Dataset()
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
        //print_r($TotalStatistics[2]['sp_parameter']);exit;
        if(!empty($value))
        {
            $arrayData = array('TotalStatistics' =>$value,'GetDataSet'=>$GetDataSet);
            //print_r($TotalStatistics);exit;
            $this->load->view('data_dataset',$arrayData,$value);
        }
        else {
                $arrayData = array('Added_this_week' =>'0','Total_Species'=>'0','Taxonomy_Data'=>'0','GetDataSet'=>'');
                $this->load->view('data_dataset',$arrayData);    
        }
    }       
 public function gtDasLicense()
 {
    //print_r($_REQUEST['uploadID']);exit;
    $GetDataSet = $this->Crud_model->GetData('data_attributes','',"upload_data_id='".$_REQUEST['uploadID']."'",'','','','1');
    $data = '<div class="modal-header">
                <h5 class="modal-title">'.ucfirst($GetDataSet->data_title).'</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="resetDrp()" aria-label="Close"></button>
            </div>
            <div class="modal-body row">
                     <p>License: '.$GetDataSet->data_licenses.'</p>
                     <p>Citation: '.$GetDataSet->data_citations.'</p>      
            </div>';
    echo $data;
 }
public function speciesDetails($sName)
 {
    if(!empty($sName)) { 
    $string = str_replace('-', ' ', $sName);
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
    foreach ($arrayRes as $value);
    if(!empty($value))
        {
            $arrayName = array('TotalStatistics' =>$value,'scientificName' =>$string);
            $this->load->view('data_Dspecies',$arrayName);
        }
        else {
                $arrayData = array('Added_this_week' =>'0','Total_Species'=>'0','Taxonomy_Data'=>'0');
                $this->load->view('data_Dspecies',$arrayData);    
        }
    
} else {
    redirect('DataDashboard/index');
 }    
}
public function PtArea()
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
        //print_r($TotalStatistics[2]['sp_parameter']);exit;
        if(!empty($value))
        {
            $arrayData = array('TotalStatistics' =>$value,'GetDataSet'=>$GetDataSet);
            //print_r($TotalStatistics);exit;
            $this->load->view('data_ptarea',$arrayData,$value);
        }
        else {
                $arrayData = array('Added_this_week' =>'0','Total_Species'=>'0','Taxonomy_Data'=>'0','GetDataSet'=>'');
                $this->load->view('data_ptarea',$arrayData);    
        }
}
public function PtAreaAction()
{
    $GetData = $this->Crud_model->GetData('protected_areas','',"location='".$_REQUEST['location']."'",'','year DESC','','');
    $data = '<table id="exampleDD" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>SNID</th>
                <th>Issue No</th>
                <th>Month</th>
                <th>Year</th>
                <th>News Topic</th>
                <th>State</th>
                <th>Location</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>';
    foreach ($GetData as $key => $value) {
       
    $data .= '<tr>
                <td>'.$value->snid.'</td>
                <td>'.$value->pdf_no.'</td>
                <td>'.$value->month.'</td>
                <td>'.$value->year.'</td>
                <td>'.$value->news_topic.'</td>
                <td>'.$value->state.'</td>
                <td>'.$value->location.'</td>
                <td><a href='.base_url('media/protected_area_pdfs/'.$value->pdf_no.'.pdf').' target="_blank()"><button class="btn-primary">View</button></a></td>
            </tr>';

          
    //print_r($GetData);exit;
                }
      $data .='</tbody></table>';
      echo $data;          
}
}
/* End of file Dashboard.php */
?>