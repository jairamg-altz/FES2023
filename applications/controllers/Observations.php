<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);
class Observations extends CI_Controller
{
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
        $url = NODE_URL.'/getChecklists';
        $userID = $_SESSION[SESSION_NAME]['user_uuid'];
        $data = array("user_id" => $userID, "srs" => "3857",'project_id'=>'');
        $postdata = json_encode($data);
        $ch =   curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $result = curl_exec($ch);
        curl_close($ch);
        //print_r($result);exit;
        if(!empty($result))
        {
            $checklist = array_values(json_decode($result, true));
            $data = array('checklist' => $checklist);
            $this->load->view('observations/list', $data);    
        }
        else { 
$data = array('checklist' => "");
            $this->load->view('observations/list', $data); 
        }
        
    }
    
public function ViewObjservation($checklistId)
{
    $data = array('checklist' => $checklistId);
    $this->load->view('gallery', $data);
}
public function ViewObjservationDetail($observationID)
{
    //print_r($observationID);exit;
    $data = array('observation_id' => $observationID);
    $this->load->view('galleryDetails', $data);
}
public function ViewNObjservation()
{
    $data = array('checklist' => $checklistId);
    $this->load->view('Dgallery', $data);
}
public function add($checklistId)
    {
        if (empty($_SESSION[SESSION_NAME]['user_uuid'])) {
            redirect('home');
        } else {
            $ch = $this->Crud_model->GetData('checklist','',"checklist_id='".$checklistId."' and created_by='".$_SESSION[SESSION_NAME]['user_uuid']."'",'','checklist_id DESC','','1');
            //print_r($ch);exit;
            $url = NODE_URL.'/getChecklistDetails';
            $userID = $_SESSION[SESSION_NAME]['user_uuid'];
            $data = array("user_id" => $userID, "srs" => "4326","checklist_id"=>$checklistId);
            $postdata = json_encode($data);
            $ch =   curl_init($url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            $result = curl_exec($ch);
            curl_close($ch);
            $checklist = array_values(json_decode($result, true));
            //print_r($checklist);exit;
            foreach ($checklist as $key => $value);
            $location = json_decode($value['sp_geom'], true);
            foreach ($location as $locationRow);
            $data = array('Latitude' => $locationRow[1], 'Longitude' => $locationRow[0], 'checklistID' => $checklistId, 'checklistName' => $value['sp_checklist_name'], 'otype' => $value['sp_observation_type']);
            //print_r($data);exit;
            $this->load->view('observations/add', $data, FALSE);
        }
    }

public function AddChecklist()
{ 
	$startTime = date('Y-m-d H:i:s',strtotime($_REQUEST['checklist_start_time']));
	$endTime = date('Y-m-d H:i:s',strtotime($_REQUEST['checklist_end_time']));
        //print_r($startTime);exit;
        $url = NODE_URL.'/addCheckList';
        $userID = $_SESSION[SESSION_NAME]['user_uuid'];
        $data = array("name" => $_REQUEST['checklist_name'], 'description' => $_REQUEST['checklist_description'], 'party_count' => (int) $_REQUEST['checklist_group_count'], 'start_timestamp' => $startTime, 'end_timestamp' => $endTime, 'travelled_distance' => (int) $_REQUEST['checklist_distance'], 'observation_type' => $_REQUEST['checklist_type'], 'longitude' => (float) $_REQUEST['checklist_location_longitude'], 'latitude' => (float) $_REQUEST['checklist_location_latitude'], "gps_track" => '', "gps_track_frequency" => '', "user_id" => $userID);
        $postdata = json_encode($data);
         //print_r($postdata);exit;
        $ch =   curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $result = curl_exec($ch);
        curl_close($ch);
       // print_r($_REQUEST['checklist_name']);
        $ch = $this->Crud_model->GetData('checklist','',"checklist_name='".$_REQUEST['checklist_name']."'",'','checklist_id DESC','','1');
        //print_r($ch);exit;
        if (!empty($result)) {
            redirect('Observations/add/'.$ch->checklist_id);
        }
        else {
            redirect('Observations/index');
        }   
    }
public function editA($checklist_id)
{
    $ch = $this->Crud_model->GetData('checklist','',"checklist_id='".$checklist_id."'",'','','','1');
    $arrayData = array('checklist_name'=>$ch->checklist_name,'travelled_distance'=>$ch->travelled_distance,'party_count'=>$ch->party_count,'description'=>$ch->description,'start_datetime'=>$ch->start_datetime,'end_datetime'=>$ch->end_datetime,'observation_type'=>$ch->observation_type,'checklist_id'=>$ch->checklist_id);
    $this->load->view('observations/editChecklist', $arrayData);
   // print_r($ch);exit;
}
public function editAction($checklist_id)
{
    //print_r($checklist_id);exit;
    $arrayData = array('checklist_name'=>$_REQUEST['checklist_name'],'travelled_distance'=>$_REQUEST['checklist_distance'],'party_count'=>$_REQUEST['checklist_group_count'],'description'=>$_REQUEST['checklist_description'],'start_datetime'=>$_REQUEST['checklist_start_time'],'end_datetime'=>$_REQUEST['checklist_end_time'],'observation_type'=>$_REQUEST['checklist_type']);
    $this->Crud_model->save('checklist',$arrayData,"checklist_id='".$checklist_id."'");
    //print_r($this->db->last_query());exit;
    redirect('Observations/index');
}    
public function delete($checklist_id)
{
    //print_r($checklist_id);exit;
    $arrayData = array('checklist_id' =>$checklist_id,'user_id'=>$_SESSION[SESSION_NAME]['user_uuid']);
   // print_r($arrayData);exit;
    $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => NODE_URL.'/deleteChecklist',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_POSTFIELDS => json_encode($arrayData),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            )));
        $response =  curl_exec($curl);
        //print_r($response);exit;
        redirect('observations/index');
}
public function getobddetail($checklist_id)
{
    $cond = "c.checklist_id='".$checklist_id."'";
    $data = $this->Crud_model->GetobservationD($cond);
    $aData = array('data' =>$data);
    //print_r($aData);exit;
    $this->load->view('vdetails',$aData);
    //print_r($data);exit;
}       
}
/* End of file Observations.php */
