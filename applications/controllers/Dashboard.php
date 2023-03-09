<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Dashboard extends CI_Controller {
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
         $url = NODE_URL.'/getTotalStatistics';
         curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
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
        $cox = $this->Crud_model->GetData('coxs','expert_name,expert_details','','','added_date desc','');
        //print_r($cox);exit;
        $dforum = $this->Crud_model->GetData('discussions','','','','','');
        $blog = $this->Crud_model->blogList();
        $observation = $this->Crud_model->GetData('observation','',"need_id IS NOT NULL",'','','');
        $Dobservation = $this->Crud_model->GetData('observation','','','','date_time DESC','','1');
        //print_r($Dobservation->observation_id);exit;
        $Ocond = "rl.is_image = 'true'";
        $objerv = $this->Crud_model->getLatestObj($Ocond);
        //print_r($objerv);exit;
        $forom = $this->Crud_model->ForomDas();
        $Uexpert = $this->Crud_model->Coxeprts();
        //print_r($Uexpert);exit;
        $Lcond = "rl.type = 'Event'";
        $Globl = $this->Crud_model->getLatestObjList($Lcond);
        $NewDate=Date('Y-m-d', strtotime('+1 days'));
        $weekD = date('Y-m-d', strtotime('last sunday', strtotime(date('Y-m-d'))));
        $Acond = "o.date_time BETWEEN '".$weekD."' AND '".$NewDate."'";
        $Acobl = $this->Crud_model->GetActiveUser($Acond);
        //print_r($this->db->last_query());exit;
        if(!empty($value))
        {
            $arrayData = array('TotalStatistics' =>$value,'cox'=>$cox,'objerv'=>$objerv,'forom'=>$forom,'blogs'=>$blog,'dforum'=>$dforum,'observation'=>$observation,'Uexpert'=>$Uexpert,'Dobservation'=>$Dobservation,'lobserList'=>$Globl,'Auser'=>$Acobl);
            $this->load->view('dashboard', $arrayData);
        }
        else {
            $arrayData = array('Added_this_week' =>'0','Total_Species'=>'0','Taxonomy_Data'=>'0','cox'=>$cox,'objerv'=>$objerv,'forom'=>$forom,'blogs'=>$blog,'dforum'=>$dforum,'observation'=>$observation,'Uexpert'=>$Uexpert,'Dobservation'=>$Dobservation,'lobserList'=>$Globl,'Auser'=>$Acobl);
            $this->load->view('dashboard', $arrayData);
        }
    }
    public function indexT()
    {
        $data =  array("srs" => "3857");
         $curl = curl_init();
         $url = NODE_URL.'/getTotalStatistics';
         curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
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
        $cox = $this->Crud_model->GetData('coxs','expert_name,expert_details','','','added_date desc','');
        //print_r($cox);exit;
        $dforum = $this->Crud_model->GetData('discussions','','','','','');
        $blog = $this->Crud_model->GetData('blogs','','','','','');
        $observation = $this->Crud_model->GetData('observation','',"need_id IS NOT NULL",'','','');
        $Dobservation = $this->Crud_model->GetData('observation','','','','date_time','');
   // print_r($this->db->last_query());exit;getLatestObjList
        $objerv = $this->Crud_model->getLatestObj();
        $Globl = $this->Crud_model->getLatestObjList();
        //print_r($Globl);exit;
        $forom = $this->Crud_model->ForomDas();
        $Uexpert = $this->Crud_model->Coxeprts();
        //print_r($this->db->last_query());exit;
        if(!empty($value))
        {
            $arrayData = array('TotalStatistics' =>$value,'cox'=>$cox,'objerv'=>$objerv,'forom'=>$forom,'blogs'=>$blog,'dforum'=>$dforum,'observation'=>$observation,'Uexpert'=>$Uexpert,'Dobservation'=>$Dobservation,'lobserList'=>$Globl);
            $this->load->view('dashboardT', $arrayData);
        }
        else {
            $arrayData = array('Added_this_week' =>'0','Total_Species'=>'0','Taxonomy_Data'=>'0','cox'=>$cox,'objerv'=>$objerv,'forom'=>$forom,'blogs'=>$blog,'dforum'=>$dforum,'observation'=>$observation,'Uexpert'=>$Uexpert,'Dobservation'=>$Dobservation,'lobserList'=>$Globl);
            $this->load->view('dashboardT', $arrayData);
        }
    }

    public function gallery ($checklistId)
    {
        $data = array(
            'checklistId' => $checklistId,
        );
        $this->load->view('gallery', $data);
    }
    
    public function createBlog()
    {
        $this->load->view('cblog');
    }
public function Blog()
    {
        if(!empty($_SESSION[SESSION_NAME]['user_uuid'])) {
        $blogCount = count($this->Crud_model->GetData('blogs','',"blog_post_by='".$_SESSION[SESSION_NAME]['user_uuid']."'"));
        $reward = array('blog_count' =>$blogCount); 
            $this->Crud_model->SaveData('user_observation_statistics',$reward,"user_id='".$_SESSION[SESSION_NAME]['user_uuid']."'");
        }
        $blog = $this->Crud_model->blogList();
        foreach($blog as $blogDRows);
        $getDMedia = $this->Crud_model->GetData('blog_medias','',"blog_activity='post' and blog_id='".$blogDRows->blogpost_id."' and blog_media_type='image'",'','','','1'); 
        $data = array('blog' => $blog,'blogDRows'=>$blogDRows,'getDMedia'=>$getDMedia);
        $this->load->view('blog',$data);
    }
public function likesCount()
{
    if(!empty($_REQUEST['blogpost_id']))
    {
        $data = $this->Crud_model->GetData('blogs','likes',"blogpost_id='".$_REQUEST['blogpost_id']."'",'','','','1');
        $Tlike = $data->likes + 1; 
        $arrayData= array('likes' => $Tlike);
        $this->Crud_model->save('blogs',$arrayData,"blogpost_id='".$_REQUEST['blogpost_id']."'");
        echo "1";exit;
    }
}
public function shareForum()
{
    $data = $this->Crud_model->GetData('blog_medias','blog_media',"blog_id='".$_REQUEST['blogpost_id']."' and blog_activity='post'",'','','','1');
    if(!empty($data)) { 
    $url = IMAGE_URL.'blog/'.$data->blog_media;
} else {
    $url = site_url();
}
    $dataA = '<a href="http://www.facebook.com/sharer.php?u='.$url.'" target="_blank();" class="fa fa-facebook p-3"></a>
    <a href="http://twitter.com/share?url='.$url.'&text=Simple Share Buttons&hashtags=simplesharebuttons" target="_blank();" class="fa fa-twitter p-3"></a>
   <a href="https://plus.google.com/share?url='.$url.'" target="_blank" class="fa fa-google p-3"></a>
   <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?= site_url();?>" target="_blank" class="fa fa-linkedin p-3"></a>
   <a href="https://www.instagram.com/?url='.$url.'" target="_blank" class="fa fa-instagram"></a>';
   echo $dataA;exit;
}    
public function BlogDetail($blogId)
    {
        $cond="b.blogpost_id='".$blogId."'";
        $blogD = $this->Crud_model->blogListToID($cond);
        $getDMedia = $this->Crud_model->GetData('blog_medias','',"blog_activity='post' and blog_id='".$blogD->blogpost_id."'",'','','','');
        $date1 = new DateTime(date('Y-m-d H:i:s')); 
        $date2 = new DateTime($blogD->blog_post_timestamp);
        $interval = date_diff($date1, $date2);
        $getTdiffD = $interval->format("%d");
        $getTdiffH = $interval->format("%h");
        $getTdiffM = $interval->format("%i");
        $gDBlogMedia = $this->Crud_model->DBlogMedia();
        //print_r($blog);exit;
    $data = array('blogD' => $blogD,'getTdiffH'=>$getTdiffH,'getTdiffM'=>$getTdiffM,'getDMedia'=>$getDMedia,'gDBlogMedia'=>$gDBlogMedia,'getTdiffD'=>$getTdiffD);
        $this->load->view('blog_details',$data);
    }
function createBlogAction() {
    $random = rand(1000,10000);
    $this->load->library('upload');
    $dataInfo = array();
    $files = $_FILES;
    $cpt = count($_FILES['media']['name']);
   // print_r($files);exit;
    if($cpt!=0) { 
    $BDData = array('blog_title'=>$_REQUEST['title'],'blog_body'=>$_REQUEST['description'],'blog_post_timestamp'=>date('Y-m-d H:i:s'),'blog_post_by'=>$_SESSION[SESSION_NAME]['user_uuid'],'is_blog_public'=>$_REQUEST['is_blog_public'],'unique_id'=>$random);
        $this->Crud_model->save('blogs',$BDData);
    $lastId = $this->Crud_model->GetData('blogs','blogpost_id',"unique_id='".$random."'",'','','','1');
    for($i=0; $i<$cpt; $i++)
    { 
        $_FILES['media']['name']= $files['media']['name'][$i];
        $_FILES['media']['type']= $files['media']['type'][$i];
        $_FILES['media']['tmp_name']= $files['media']['tmp_name'][$i];
        $_FILES['media']['error']= $files['media']['error'][$i];
        $_FILES['media']['size']= $files['media']['size'][$i]; 
        $uploadPath = 'media/img/blog/';
        $config['upload_path'] = $uploadPath;
        $config['allowed_types'] = 'jpg|jpeg|png|gif|mp4';
        $config['max_size'] = '3000000';
        // Load and initialize upload library
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $this->upload->do_upload('media');
        // Uploaded file data
        $imageData = $this->upload->data();
        $mediaUrl = API_URL.'/media/img/blog/'.$imageData['file_name']; 
        $iparr = substr($_FILES['media']['type'], 0, 5); 
        $arrMedia = array('blog_id' =>$lastId->blogpost_id,'blog_media'=>$imageData['file_name'],'blog_media_url'=>$mediaUrl,'blog_media_type'=>$iparr,'blog_activity'=>'post','created_by'=>$_SESSION[SESSION_NAME]['user_uuid'],'created_date_time'=>date('Y-m-d H:i:s')); 
        $this->Crud_model->SaveData('blog_medias',$arrMedia);
        $blogCount = count($this->Crud_model->GetData('blogs','',"blog_post_by='".$_SESSION[SESSION_NAME]['user_uuid']."'"));
        $userStat = $this->Crud_model->GetData('user_observation_statistics','',"user_id='".$_SESSION[SESSION_NAME]['user_uuid']."'");
        if(!empty($userStat))
        {
            $reward = array('blog_count' =>$blogCount); 
            $this->Crud_model->SaveData('user_observation_statistics',$reward,"user_id='".$_SESSION[SESSION_NAME]['user_uuid']."'");
        }
        else {
         $reward = array('blog_count' =>$blogCount,'user_id'=>$_SESSION[SESSION_NAME]['user_uuid']); 
            $this->Crud_model->SaveData('user_observation_statistics',$reward);         
    }
    
    redirect('Dashboard/Blog');
        }
}
    else {
      /* $arrayData = array('blog_title'=>$_REQUEST['title'],'blog_body'=>$_REQUEST['description'],'blog_post_timestamp'=>date('Y-m-d H:i:s'),'blog_post_by'=>$_SESSION[SESSION_NAME]['user_uuid'],'is_blog_public'=>$_REQUEST['is_blog_public'],'unique_id'=>$random);
            $this->Crud_model->save('blogs',$arrayData); 
            redirect('Dashboard/Blog');*/
    }

}

function createBlogActionD() {
   $random = rand(1000,10000);
   
   $arrayData = array('blog_title' => $_REQUEST['title'],'blog_body'=>strip_tags($_REQUEST['description']),'blog_post_by'=>$_SESSION[SESSION_NAME]['user_uuid'],'blog_post_timestamp'=>date('Y-m-d h:i:s'),'is_blog_public'=>$_REQUEST['is_blog_public'],'unique_id'=>$random);
   $this->Crud_model->save('blogs',$arrayData);
   if (!empty($_FILES['image']['name'])) {
    $lastId = $this->Crud_model->GetData('blogs','',"unique_id='".$random."'",'','','','1');            
    for($i=0; $i < count($_FILES['image']['name']); $i++) 
    {
        $image = base64_encode(file_get_contents($_FILES['image']['tmp_name'][$i]));
        $image_name = str_replace(" ","_", $_FILES['image']['name'][$i]);
        $url = API_URL.'/FAPI/index.php/Fapis/blogImage';    
        $arrayData = array('image' => $image,'image_name'=>$image_name,'blog_id'=>$lastId);
        $postdata = json_encode($arrayData);
        //print_r($image_name);
        $ch =   curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $result = curl_exec($ch);
        curl_close($ch);
    }       

        }
    redirect('Dashboard/Blog');    
   
}
public function DataDashboard()
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
        //print_r($response);exit;
        curl_close($curl);
        $arrayRes = json_decode(($response), true);
        $GetDataSet = $this->Crud_model->GetData('data_attributes');
        foreach ($arrayRes as $value);
        if(!empty($value))
        {
            $arrayData = array('TotalStatistics' =>$value,'GetDataSet'=>$GetDataSet);
            $this->load->view('data_dashboard',$arrayData);
        }
        else {
                $arrayData = array('Added_this_week' =>'0','Total_Species'=>'0','Taxonomy_Data'=>'0','GetDataSet'=>'');
                $this->load->view('data_dashboard',$arrayData);    
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
 
 public function indexTest()
    {
        //print_r("expression");exit;
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
        $cox = $this->Crud_model->GetData('coxs','expert_name,expert_details','','','added_date desc','');
        $dforum = $this->Crud_model->GetData('discussions','','','','','');
        $blog = $this->Crud_model->blogList();
        $observation = $this->Crud_model->GetData('observation','',"need_id IS NOT NULL",'','','');
        $Dobservation = $this->Crud_model->GetData('observation','','','','date_time','');
        $objerv = $this->Crud_model->getLatestObj();
        $forom = $this->Crud_model->ForomDas();
        //print_r($blog);exit;
        $Uexpert = $this->Crud_model->Coxeprts();
        
        if(!empty($value))
        {
            $arrayData = array('TotalStatistics' =>$value,'cox'=>$cox,'objerv'=>$objerv,'forom'=>$forom,'blogs'=>$blog,'dforum'=>$dforum,'observation'=>$observation,'Uexpert'=>$Uexpert,'Dobservation'=>$Dobservation);
            $this->load->view('dashboard_test', $arrayData);
        }
        else {
            $arrayData = array('Added_this_week' =>'0','Total_Species'=>'0','Taxonomy_Data'=>'0','objerv'=>0,'forom'=>0,'blogs'=>0,'dforum'=>0,'observation'=>0,'Uexpert'=>0);
        $this->load->view('dashboard_test', $arrayData);
        //$this->load->view('index',$arrayData);
        }
    }   
}
/* End of file Dashboard.php */
?>