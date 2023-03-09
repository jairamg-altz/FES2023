<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class BirdID extends CI_Controller {
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
        $this->load->view('birdID');
    }
public function imageSCCDDData()
    {
        //print_r($_POST);exit;
        $cond="b.".$_POST['column']."='".$_POST['color']."'";
        $data = $this->Crud_model->GetImgScientD($cond);
       // print_r($this->db->last_query());exit;
 if(!empty($data)) {
     foreach ($data as $key => $value) {
     $stringDD = str_replace(' ', '-', $value->m_sn);   
 $res = '<div class="col-md-3 card-body"><div class="text-center">';
 if(!empty($value->file_url)) {
 $res .='<img src='.$GetImgSData->file_uri.' alt="..." class="img-thumbnail" style="cursor:pointer">';
}
else {     
     //print_r($stringDD);exit;
    $res .='<img src='.base_url('media/Silhouette.png').' alt="..." class="img-thumbnail" style="cursor:pointer">';
 $res .='<a href='.site_url('DataDashboard/speciesDetails/'.$stringDD).' target="_blank()"><p>'.$value->m_cn.'(<i>'.$value->m_sn.'</i>)</p></a>';
$res .= '</div></div>';
echo $res; 
    }  
  }
}
else {
    $res = '<div class="card-body text-center"><h5>Record Not Found</h5></div>';
    echo $res;
}
}
public function imageSData()
    {
        $cond="b.size='".$_POST['size']."'";
        $data = $this->Crud_model->GetImgScientD($cond);
 if(!empty($data)) {
     foreach ($data as $key => $value) {
        $stringDD = str_replace(' ', '-', $value->m_sn);  
 $res = '<div class="col-md-3 card-body"><div class="text-center">';
 if(!empty($value->file_url)) {
 $res .='<img src='.$GetImgSData->file_uri.' alt="..." class="img-thumbnail" style="cursor:pointer">';
}
else {
    $res .='<img src='.base_url('media/Silhouette.png').' alt="..." class="img-thumbnail" style="cursor:pointer">';
 $res .='<a href='.site_url('DataDashboard/speciesDetails/'.$stringDD).' target="_blank()"><p>'.$value->m_cn.'(<i>'.$value->m_sn.'</i>)</p></a>';
$res .= '</div></div>';
echo $res; 
    }  
  }
}
else {
    $res = '<div class="card-body text-center"><h5>Record Not Found</h5></div>';
    echo $res;
}
}
public function imageAData()
    {
        $cond="b.appearance='".$_POST['appearance']."'";
        $data = $this->Crud_model->GetImgScientD($cond);
  if(!empty($data)) {       
 foreach ($data as $key => $value) { 
 $stringDD = str_replace(' ', '-', $value->m_sn);          
 $res = '<div class="col-md-3 card-body"><div class="text-center">';
 if(!empty($value->file_url)) {
 $res .='<img src='.$GetImgSData->file_uri.' alt="..." class="img-thumbnail" style="cursor:pointer">';
}
else {
    $res .='<img src='.base_url('media/Silhouette.png').' alt="..." class="img-thumbnail" style="cursor:pointer">';
 $res .='<a href='.site_url('DataDashboard/speciesDetails/'.$stringDD).' target="_blank()"><p>'.$value->m_cn.'(<i>'.$value->m_sn.'</i>)</p></a>';
$res .= '</div></div>';
echo $res; 
    }  
}
}
else {
    $res = '<div class="card-body text-center"><h5>Record Not Found</h5></div>';
    echo $res;
}
}
public function imageBData()
    {
        $cond="b.bill_shape='".$_POST['bill_shape']."'";
        $data = $this->Crud_model->GetImgScientD($cond);
  if(!empty($data)) {   
     foreach ($data as $key => $value) {
 $stringDD = str_replace(' ', '-', $value->m_sn);       
 $res = '<div class="col-md-3 card-body"><div class="text-center">';
 if(!empty($value->file_url)) {
 $res .='<img src='.$GetImgSData->file_uri.' alt="..." class="img-thumbnail" style="cursor:pointer">';
}
else {
    $res .='<img src='.base_url('media/Silhouette.png').' alt="..." class="img-thumbnail" style="cursor:pointer">';
 $res .='<a href='.site_url('DataDashboard/speciesDetails/'.$stringDD).' target="_blank()"><p>'.$value->m_cn.'(<i>'.$value->m_sn.'</i>)</p></a>';
$res .= '</div></div>';
echo $res; 
    }  
   } 
}
else {
    $res = '<div class="card-body text-center"><h5>Record Not Found</h5></div>';
    echo $res;
}
}
public function imageHData()
    {
        $cond="b.head_patterns='".$_POST['head_patterns']."'";
        $data = $this->Crud_model->GetImgScientD($cond);
 if(!empty($data)) {
 foreach ($data as $key => $value) {     
 $stringDD = str_replace(' ', '-', $value->m_sn);      
 $res = '<div class="col-md-3 card-body"><div class="text-center">';
 if(!empty($value->file_url)) {
 $res .='<img src='.$GetImgSData->file_uri.' alt="..." class="img-thumbnail" style="cursor:pointer">';
}
else {
    $res .='<img src='.base_url('media/Silhouette.png').' alt="..." class="img-thumbnail" style="cursor:pointer">';
 $res .='<a href='.site_url('DataDashboard/speciesDetails/'.$stringDD).' target="_blank()"><p>'.$value->m_cn.'(<i>'.$value->m_sn.'</i>)</p></a>';
$res .= '</div></div>';
echo $res; 
    }  
}
}
else {
    $res = '<div class="card-body text-center"><h5>Record Not Found</h5></div>';
    echo $res;
}
}
public function imageEData()
    {
        $cond="b.eye_patterns='".$_POST['eye_patterns']."'";
        $data = $this->Crud_model->GetImgScientD($cond);
    if(!empty($data)) {    
     foreach ($data as $key => $value) { 
     $stringDD = str_replace(' ', '-', $value->m_sn);          
 $res = '<div class="col-md-3 card-body"><div class="text-center">';
 if(!empty($value->file_url)) {
 $res .='<img src='.$GetImgSData->file_uri.' alt="..." class="img-thumbnail" style="cursor:pointer">';
}
else {
    $res .='<img src='.base_url('media/Silhouette.png').' alt="..." class="img-thumbnail" style="cursor:pointer">';
 $res .='<a href='.site_url('DataDashboard/speciesDetails/'.$stringDD).' target="_blank()"><p>'.$value->m_cn.'(<i>'.$value->m_sn.'</i>)</p></a>';
$res .= '</div></div>';
echo $res; 
    }  
}
} else {
    $res = '<div class="col-md-3 card-body"><div class="text-center">Record not found!</div></div>';
    echo $res;
}
}
public function imageWData()
    {
        $cond="b.wing_shape='".$_POST['wing_shape']."'";
        $data = $this->Crud_model->GetImgScientD($cond);
 if(!empty($data)) { 
 foreach ($data as $key => $value) {
 $stringDD = str_replace(' ', '-', $value->m_sn);           
 $res = '<div class="col-md-3 card-body"><div class="text-center">';
 if(!empty($value->file_url)) {
 $res .='<img src='.$GetImgSData->file_uri.' alt="..." class="img-thumbnail" style="cursor:pointer">';
}
else {
    $res .='<img src='.base_url('media/Silhouette.png').' alt="..." class="img-thumbnail" style="cursor:pointer">';
 $res .='<a href='.site_url('DataDashboard/speciesDetails/'.$stringDD).' target="_blank()"><p>'.$value->m_cn.'(<i>'.$value->m_sn.'</i>)</p></a>';
$res .= '</div></div>';
echo $res; 
    }  
}
}
else {
    $res = '<div class="card-body text-center"><h5>Record Not Found</h5></div>';
    echo $res;
}
}
public function imageTData()
    {
        $cond="b.tail_shape='".$_POST['tail_shape']."'";
        $data = $this->Crud_model->GetImgScientD($cond);
 if(!empty($data)) { 
 foreach ($data as $key => $value) { 
 $stringDD = str_replace(' ', '-', $value->m_sn);          
 $res = '<div class="col-md-3 card-body"><div class="text-center">';
 if(!empty($value->file_url)) {
 $res .='<img src='.$GetImgSData->file_uri.' alt="..." class="img-thumbnail" style="cursor:pointer">';
}
else {
    $res .='<img src='.base_url('media/Silhouette.png').' alt="..." class="img-thumbnail" style="cursor:pointer">';
 $res .='<a href='.site_url('DataDashboard/speciesDetails/'.$stringDD).' target="_blank()"><p>'.$value->m_cn.'(<i>'.$value->m_sn.'</i>)</p></a>';
$res .= '</div></div>';
echo $res; 
    }  
}
}
else {
    $res = '<div class="card-body text-center"><h5>Record Not Found</h5></div>';
    echo $res;
}
}
public function imageBPData()
    {
        $cond="b.back_patterns='".$_POST['back_patterns']."'";
        $data = $this->Crud_model->GetImgScientD($cond);
 if(!empty($data)) { 
 foreach ($data as $key => $value) { 
 $stringDD = str_replace(' ', '-', $value->m_sn);          
 $res = '<div class="col-md-3 card-body"><div class="text-center">';
 if(!empty($value->file_url)) {
 $res .='<img src='.$GetImgSData->file_uri.' alt="..." class="img-thumbnail" style="cursor:pointer">';
}
else {
    $res .='<img src='.base_url('media/Silhouette.png').' alt="..." class="img-thumbnail" style="cursor:pointer">';
 $res .='<a href='.site_url('DataDashboard/speciesDetails/'.$stringDD).' target="_blank()"><p>'.$value->m_cn.'(<i>'.$value->m_sn.'</i>)</p></a>';
$res .= '</div></div>';
echo $res; 
    }  
}
}
else {
    $res = '<div class="card-body text-center"><h5>Record Not Found</h5></div>';
    echo $res;
}
}
public function imageMSData()
    {
        $cond="b.migratory_status='".$_POST['migratory_status']."'";
        $data = $this->Crud_model->GetImgScientD($cond);
        if(!empty($data)) {
     foreach ($data as $key => $value) {  
     $stringDD = str_replace(' ', '-', $value->m_sn);         
 $res = '<div class="col-md-3 card-body"><div class="text-center">';
 if(!empty($value->file_url)) {
 $res .='<img src='.$GetImgSData->file_uri.' alt="..." class="img-thumbnail" style="cursor:pointer">';
}
else {
    $res .='<img src='.base_url('media/Silhouette.png').' alt="..." class="img-thumbnail" style="cursor:pointer">';
 $res .='<a href='.site_url('DataDashboard/speciesDetails/'.$stringDD).' target="_blank()"><p>'.$value->m_cn.'(<i>'.$value->m_sn.'</i>)</p></a>';
$res .= '</div></div>';
echo $res; 
    }  
}
}
else {
    $res = '<div class="card-body text-center"><h5>Record Not Found</h5></div>';
    echo $res;
}
}
public function imageHBBData()
    {
        $cond="b.habitat='".$_POST['habitat']."'";
        $data = $this->Crud_model->GetImgScientD($cond);
 if(!empty($data)) {    
     foreach ($data as $key => $value) {
     $stringDD = str_replace(' ', '-', $value->m_sn);           
 $res = '<div class="col-md-3 card-body"><div class="text-center">';
 if(!empty($value->file_url)) {
 $res .='<img src='.$GetImgSData->file_uri.' alt="..." class="img-thumbnail" style="cursor:pointer">';
}
else {
    $res .='<img src='.base_url('media/Silhouette.png').' alt="..." class="img-thumbnail" style="cursor:pointer">';
 $res .='<a href='.site_url('DataDashboard/speciesDetails/'.$stringDD).' target="_blank()"><p>'.$value->m_cn.'(<i>'.$value->m_sn.'</i>)</p></a>';
$res .= '</div></div>';
echo $res; 
    }  
}
}
else {
    $res = '<div class="card-body text-center"><h5>Record Not Found</h5></div>';
    echo $res;
}
}
}

?>