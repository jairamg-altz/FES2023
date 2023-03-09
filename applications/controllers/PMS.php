<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class PMS extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION[SESSION_NAME]['user_uuid'])) {
            redirect('home');
        }
    }
public function index()
    {
        //print_r($pid);exit;
        $cond = "pd.is_deleted='No'";
        $pdata = $this->Crud_model->projectList($cond);
        //print_r($pdata);exit;       
        $data = array(
            'foo' => 'bar','pdata'=>$pdata 
        );
        $this->load->view('myProject', $data);
    }
public function CreateProject()
{
    $pmaster = $this->Crud_model->GetData('project_column_masters');
    //print_r($pmaster);exit;
    $data = array('foo' => 'bar','pmaster'=>$pmaster);
    $this->load->view('cProject', $data);
}
public function CprojectAction()
{
   //print_r($_FILES['file_media']['name']); exit;
   //print_r($_REQUEST);exit;
        $this->load->library('upload');
        $files = $_FILES;
        $_FILES['file_media']['name']= $files['file_media']['name'];
        $_FILES['file_media']['type']= $files['file_media']['type'];
        $_FILES['file_media']['tmp_name']= $files['file_media']['tmp_name'];
        $_FILES['file_media']['error']= $files['file_media']['error'];
        $_FILES['file_media']['size']= $files['file_media']['size']; 
        $uploadPath = 'media/project/';
        $config['upload_path'] = $uploadPath;
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = '3000000';
        // Load and initialize upload library
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $this->upload->do_upload('file_media');
        // Uploaded file data
    $imageData = $this->upload->data();
    //print_r($imageData['file_name']);exit;
    $arrayData = array('project_name' => $_REQUEST['title'],'project_desc'=>$_REQUEST['desc'],'created_by'=>$_SESSION[SESSION_NAME]['user_uuid'],'date_time'=>date('Y-m-d g:i:s'),'is_deleted'=>'No','file_media'=>$imageData['file_name']);
    $res = $this->Crud_model->save('project_details',$arrayData);
    $dd= date('Y-m-d g:i:s');
    $ddd = $this->Crud_model->GetData('project_details','project_id',"date_time='".date('Y-m-d g:i:s')."'",'','','','1');
    $insert_id = $ddd->project_id;
    $arraymap = array('project_id' => $insert_id,'user_id'=>$_SESSION[SESSION_NAME]['user_uuid'],'access'=>$_REQUEST['access']);
    $res = $this->Crud_model->save('project_mapping',$arraymap);
    if (count($_REQUEST['attribute_name'])!=0) {
       // 
        for ($j=0; $j < count($_REQUEST['attribute_name']); $j++) {
            //print_r($j);
            $arraymap = array('attribute_name' => $_REQUEST['attribute_name'][$j],'alias_name'=>$_REQUEST['alias_name'][$j],'data_type'=>$_REQUEST['data_type'][$j],'options'=>$_REQUEST['options'][$j],'is_mandatory'=>$_REQUEST['is_mandatory'][$j],'project_id'=>$insert_id,'input_type'=>'Input');
        $this->Crud_model->save('project_column',$arraymap);
        }
         redirect('PMS/index');
    }
    redirect('PMS/index');
}
public function projectView($project_id)
{
    $Cdata = $this->Crud_model->GetData('checklist','checklist_id',"project_id='".$project_id."'",'','','','1');
    $data = array('checklist' => $Cdata->checklist_id);
    $this->load->view('gallery', $data);
}
public function deletepCheclist($pid)
{
    $res = $this->Crud_model->DeleteData('project_details',"project_id='".$pid."'");
    redirect('PMS/index');
}  
public function delete($pid)
{
    $arrayData = array('is_deleted' => 'Yes');
    $res = $this->Crud_model->save('project_details',$arrayData,"project_id='".$pid."'");
    redirect('PMS/index');
}  
public function projectEdit($pid)
{
    $pIDcolumn = array();
    $cond = "pd.is_deleted='No' and pd.project_id='".$pid."'";
    $pdata = $this->Crud_model->projectSList($cond);
    $pmaster = $this->Crud_model->GetData('project_column_masters');
    $pcolumn = $this->Crud_model->GetData('project_column','',"project_id='".$pid."'");
    $pINcolumn = $this->Crud_model->GetData('project_column','',"project_id='".$pid."' and input_type='Input'");
    //print_r($pINcolumn);exit;
    $arrayData = array('project_id' => $pdata->project_id,'project_name'=> $pdata->project_name,'project_desc'=>$pdata->project_desc,'access'=>$pdata->access,'pmaster'=>$pmaster,'pcolumn'=>$pcolumn,'pINcolumn'=>$pINcolumn);
    $this->load->view('eProject',$arrayData);
}
public function peAction()
{
    //print_r($_REQUEST['sattribute_name'][0]); exit;
    $this->Crud_model->DeleteData('project_column',"project_id='".$_REQUEST['project_id']."'");
    /*if(count($_REQUEST['sattribute_name'])!=0)
    {
        for ($i=0; $i < count($_REQUEST['sattribute_name']); $i++) { 
        $ddd = $this->Crud_model->GetData('project_column_masters','',"attribute_name='".$_REQUEST['sattribute_name'][$i]."'",'','','','1');
        $arraymap = array('attribute_name' => $ddd->attribute_name,'alias_name'=>$ddd->alias_name,'data_type'=>$ddd->data_type,'options'=>$ddd->options,'is_mandatory'=>$ddd->is_mandatory,'project_id'=>$_REQUEST['project_id'],'input_type'=>'Checked');
        $this->Crud_model->save('project_column',$arraymap);
        }
    }*/
    
    if (count($_REQUEST['attribute_name'])!=0) {
       for ($j=0; $j < count($_REQUEST['attribute_name']); $j++) {
            //print_r($j);
            $arraymap = array('attribute_name' => $_REQUEST['attribute_name'][$j],'alias_name'=>$_REQUEST['alias_name'][$j],'data_type'=>$_REQUEST['data_type'][$j],'options'=>$_REQUEST['options'][$j],'is_mandatory'=>$_REQUEST['is_mandatory'][$j],'project_id'=>$_REQUEST['project_id'],'input_type'=>'Input');
            $this->Crud_model->save('project_column',$arraymap);
        }
         redirect('PMS/index');
    }
}
public function pDynamicColumn($pid,$checklistId)
{
    //print_r($checklistId);exit;
    $ppD = $this->Crud_model->GetData('project_column','',"project_id='".$pid."'",'project_column_id');
    //print_r($ppD);exit;
    //checklist
    $url = NODE_URL.'/getChecklistDetails';
    $userID = $_SESSION[SESSION_NAME]['user_uuid'];
    $data = array("user_id" => $userID, "srs" => "3857",'project_id'=>$pid,"checklist_id"=>$checklistId);
    $postdata = json_encode($data);
    $ch =   curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    $result = curl_exec($ch);
    curl_close($ch);
   $checklist = array_values(json_decode($result, true));
     foreach ($checklist as $key => $value);
    $location = json_decode($value['sp_geom'], true);
    //print_r($value);exit;
    foreach ($location as $locationRow);
    $arrayData = array('project_id' =>$pid,'ppD'=>$ppD,'Latitude' => $locationRow[1], 'Longitude' => $locationRow[0], 'checklistID' => $checklistId, 'checklistName' => $value['sp_checklist_name'], 'otype' => $value['sp_observation_type']);
    $this->load->view('addPobserv',$arrayData);
}
public function indexData()
{    
    $cond = "pd.is_deleted='No'";
    $pdata = $this->Crud_model->projectList($cond);
    $data = array('foo' => 'bar','pdata'=>$pdata);
    $this->load->view('myProject_back', $data);
}
public function ProjectDynamicColumn()
{
    if(count($_FILES['image']['name']) || !empty($_REQUEST))
    {
        for($i=0; $i < count($_FILES['image']['name']); $i++)
        {
            $image = "";
            $image_name = "";
            $image = base64_encode(file_get_contents($_FILES['image']['tmp_name'][$i]));
            $image_name = str_replace(" ","_", $_FILES['image']['name'][$i]);            
        $url = API_URL.'/Apis/projectImage';    
        $arrayData = array('image' => $image,'image_name'=>$image_name,'latlon'=>$_REQUEST['latitude'][$i].','.$_REQUEST['latitude'][$i],'project_id'=>$_REQUEST['project_id'],'projchecklist_id'=>$_REQUEST['pchecklistId']);
        $postdata = json_encode($arrayData);
        //print_r($image_name);
        $ch =   curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $result = curl_exec($ch);
        curl_close($ch);
        //print_r($result);

        }
    for ($j=0; $j < count($_REQUEST['latitude']); $j++) { 
            
        $url = NODE_URL.'/saveProjectValueAll';    
        $data = array('data'=>$_REQUEST,'project_id'=>$_REQUEST['project_id'],'projchecklist_id'=>$_REQUEST['pchecklistId']);
        $postdata = json_encode($data);
        $ch =   curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $result = curl_exec($ch);
        curl_close($ch);
        if($result=='success')
        {
            redirect('PMS/index');            
        }    
        
        }
    }
}
public function ProjChecklist($project_id)
{
    $url = NODE_URL.'/getChecklists';
        $userID = $_SESSION[SESSION_NAME]['user_uuid'];
        $data = array("user_id" => $userID, "srs" => "3857",'project_id'=>$project_id);
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
            $data = array('checklist' => $checklist,'project_id'=>$project_id);
            $this->load->view('projchecklist', $data);    
        }
        else { 
$data = array('checklist' => "",'project_id'=>$project_id);
            $this->load->view('projchecklist', $data); 
        }
    /*$ppD = $this->Crud_model->GetData('project_checklist','',"project_uuid='".$project_id."' and project_checklist_created_by='".$_SESSION[SESSION_NAME]['user_uuid']."'");
   //print_r($ppD);exit;
    $data = array('checklist' => $ppD);
    $this->load->view('projchecklist', $data);*/
   // print_r($ppD);exit;
}
public function ProjChecklistAction()
{
    //print_r($_REQUEST);exit;
    $startTime = date('Y-m-d H:i:s',strtotime($_REQUEST['checklist_start_time']));
    $endTime = date('Y-m-d H:i:s',strtotime($_REQUEST['checklist_end_time']));
    //print_r($startTime);exit;
    $userID = $_SESSION[SESSION_NAME]['user_uuid'];
    $arrayD = array('party_count' =>(int)$_REQUEST['checklist_group_count'],'description'=>$_REQUEST['checklist_description'],'start_timestamp'=>$startTime,'end_timestamp'=>$endTime,'name'=>$_REQUEST['checklist_name'],'travelled_distance' => (int) $_REQUEST['checklist_distance'], 'observation_type' => $_REQUEST['checklist_type'], 'longitude' => (float) $_REQUEST['checklist_location_longitude'], 'latitude' => (float) $_REQUEST['checklist_location_latitude'], "gps_track" => '', "gps_track_frequency" => '','user_id' => $userID,'project_id'=>$_REQUEST['project_id']);
    $url = NODE_URL.'/addCheckList';
    $postdata = json_encode($arrayD);
         //print_r($postdata);exit;
        $ch =   curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $result = curl_exec($ch);
        curl_close($ch);
    if (!empty($result)) {    
    redirect('PMS/ProjChecklist/'.$_REQUEST['project_id']);
}
else {
    print_r("expression");exit;
}
}
public function editChecklist($checklist_id)
{
    $ppD = $this->Crud_model->GetData('checklist','',"checklist_id='".$checklist_id."'",'','','','1');
    //print_r($ppD);exit;
    $data = array('checklist' => $ppD,'project_checklist_uuid'=>$project_id);
    $this->load->view('editProjChecklist', $data);
   // print_r($ppD);exit;
}
public function editAction($checklist_id)
{
   // print_r($pchecklistId);exit;
    $startTime = date('Y-m-d H:i:s',strtotime($_REQUEST['checklist_start_time']));
    $endTime = date('Y-m-d H:i:s',strtotime($_REQUEST['checklist_end_time']));
    $arrayD = array('party_count' =>(int)$_REQUEST['checklist_group_count'],'description'=>$_REQUEST['checklist_description'],'start_datetime'=>$startTime,'end_datetime'=>$endTime,'project_checklist_name'=>$_REQUEST['checklist_name'],'travelled_distance' => (int) $_REQUEST['checklist_distance'], 'obsevation_type' => $_REQUEST['checklist_type']);
    $this->Crud_model->save('checklist',$arrayD,"checklist_id='".$checklist_id."'");
    redirect('PMS/ProjChecklist/'.$_REQUEST['project_id']);
}
public function ProjChecklistDel($pchecklistId,$project_id)
{
    $this->Crud_model->DeleteData('project_checklist',"project_checklist_uuid='".$pchecklistId."'");
    redirect('PMS/ProjChecklist/'.$project_id);
}
public function Cdelete($checklist_id,$project_id)
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
        if(!empty($response))
        {
            redirect('PMS/ProjChecklist/'.$project_id);
        }        
}
}
/* End of file Dashboard.php */
?>