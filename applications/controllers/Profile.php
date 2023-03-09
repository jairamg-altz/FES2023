<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Profile extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION[SESSION_NAME]['user_uuid'])) {
            redirect('home');
        }
    }
public function index()
    {
        $postData = array("user_uuid"=> $_SESSION[SESSION_NAME]['user_uuid']);
        $getUserD = $this->Crud_model->GetData('users_details','',"user_uuid='".$_SESSION[SESSION_NAME]['user_uuid']."' and status='Active'",'','','','1');
        $profileData = array();
        $getReward = $this->Crud_model->GetData('user_observation_statistics','',"user_id='".$_SESSION[SESSION_NAME]['user_uuid']."'",'','','','1');
        $observation = $this->Crud_model->GetData('observation','',"need_id IS NULL and created_by='".$_SESSION[SESSION_NAME]['user_uuid']."'",'','','');
        $obIde = $this->Crud_model->GetData('observation','',"created_by='".$_SESSION[SESSION_NAME]['user_uuid']."' and need_id IS NOT NULL");
        $forum = $this->Crud_model->GetData('discussions','',"created_by='".$_SESSION[SESSION_NAME]['user_uuid']."'",'','','');
        $conobj = "o.need_id IS NULL and o.created_by='".$_SESSION[SESSION_NAME]['user_uuid']."' and rl.type='Event'";
        $getobj = $this->Crud_model->GetobservationD($conobj);
        $conide = "o.need_id IS NOT NULL and o.created_by='".$_SESSION[SESSION_NAME]['user_uuid']."' and rl.type='Event'";
        $getid = $this->Crud_model->GetobservationD($conide);
        //print_r($this->db->last_query());exit;
        if (!empty($getUserD)) {
            $profileData = $getUserD;
        }
       if(!empty($getReward))
        {
            $totalReward = $getReward->observation_count+$getReward->observation_withimage_count+$getReward->observation_with_audio_count+$getReward->observation_with_video_count+$getReward->observation_species_rarity_dd+$getReward->observation_species_rarity_nt+$getReward->observation_species_rarity_vu+$getReward->observation_species_rarity_en+$getReward->observation_species_rarity_cr+$getReward->observation_dynamic_value+$getReward->blog_count+$getReward->replies_count+$getReward->identification_count;
       // print_r($totalReward);exit;
        $getNoviceR = $this->Crud_model->GetData('dynamic_reward_weightages','',"dynamic_reward_title='Novice'",'','','','1');
        $getWatcherR = $this->Crud_model->GetData('dynamic_reward_weightages','',"dynamic_reward_title='Watcher'",'','','','1');
        $getAvid_WatcherR = $this->Crud_model->GetData('dynamic_reward_weightages','',"dynamic_reward_title='Avid_Watcher'",'','','','1');
        $getObserverR = $this->Crud_model->GetData('dynamic_reward_weightages','',"dynamic_reward_title='Observer'",'','','','1');
        $getCommunity_ParticipantR = $this->Crud_model->GetData('dynamic_reward_weightages','',"dynamic_reward_title='Community_Participant'",'','','','1');
        $getCommunity_ChampionR = $this->Crud_model->GetData('dynamic_reward_weightages','',"dynamic_reward_title='Community_Champion'",'','','','1');
        $getContributorR = $this->Crud_model->GetData('dynamic_reward_weightages','',"dynamic_reward_title='Contributor'",'','','','1');
        $getResearcherR = $this->Crud_model->GetData('dynamic_reward_weightages','',"dynamic_reward_title='Researcher'",'','','','1');
        $getExpertR = $this->Crud_model->GetData('dynamic_reward_weightages','',"dynamic_reward_title='Expert'",'','','','1');
        $GetLicense = $this->Crud_model->GetData('data_licenses','','','data_licenses_id');
        $data = array(
            'profileData' => $profileData,'GetLicense'=>$GetLicense,'totalReward'=>$totalReward,'getNoviceR'=>$getNoviceR->dynamic_reward_weightage_from,'getWatcherR'=>$getWatcherR->dynamic_reward_weightage_from,'getAvid_WatcherR'=>$getAvid_WatcherR->dynamic_reward_weightage_from,'getObserverR'=>$getObserverR->dynamic_reward_weightage_from,'getCommunity_ParticipantR'=>$getCommunity_ParticipantR->dynamic_reward_weightage_from,'getCommunity_ChampionR'=>$getCommunity_ChampionR->dynamic_reward_weightage_from,'getContributorR'=>$getContributorR->dynamic_reward_weightage_from,'getResearcherR'=>$getResearcherR->dynamic_reward_weightage_from,'getExpertR'=>$getExpertR->dynamic_reward_weightage_from,'observation'=>$observation,'obIde'=>$obIde,'forum'=>$forum,'getobj'=>$getobj,'getid'=>$getid);
        $this->load->view('profile', $data);
    } else {
        $GetLicense = $this->Crud_model->GetData('data_licenses','','','data_licenses_id');
        $data = array(
            'profileData' => $profileData,'GetLicense'=>$GetLicense,'totalReward'=>0,'getNoviceR'=>0,'getWatcherR'=>0,'getAvid_WatcherR'=>0,'getObserverR'=>0,'getCommunity_ParticipantR'=>0,'getCommunity_ChampionR'=>0,'getContributorR'=>0,'getResearcherR'=>0,'getExpertR'=>0,'observation'=>0,'obIde'=>0,'forum'=>0,'getobj'=>0,'getid'=>$getid);
        $this->load->view('profile', $data);
    }       
}
public function update_profile_action()
    {
        if(!empty($_REQUEST['user_uuid']))
        {
            $cond = "user_uuid='".$_REQUEST['user_uuid']."' and status='Active'";
            $Data = $this->Crud_model->get_single_with_cond('users_details',$cond);
        if(!empty($Data))
        {
            $image = "";
            $image_name = "";
            if (!empty($_FILES['image_name']['name'])) {
                $image = base64_encode(file_get_contents($_FILES['image_name']['tmp_name']));
                $image_name = str_replace(" ","_", $_FILES['image_name']['name']);
            }            
if(!empty($_REQUEST['mobile_number']))
{
    $mobile = $_REQUEST['mobile_number'];
}
else {
    $mobile = 0;
}
        if(!empty($_FILES['image_name']['tmp_name'] && $_FILES['image_name']['name']))
        {
            $image_name= $image_name;
            $image = $image;
            $acctual_path = $image_name;
            $path='media/uploads/'.$image_name;
            //print_r($path);exit;
            file_put_contents($path,base64_decode($image));
            $arrayName = array('title'=>$_REQUEST['title'],'first_name'=>$_REQUEST['first_name'],'middle_name'=>$_REQUEST['middle_name'],'last_name'=>$_REQUEST['last_name'],'gender'=>$_REQUEST['gender'],'email'=>$_REQUEST['email'],'mobile_number'=>$mobile,'profession'=>$_REQUEST['profession'],'date_of_birth'=>$_REQUEST['date_of_birth'],'location_city'=>$_REQUEST['location'],'profileimage_id'=>$acctual_path,'about_us'=>$_REQUEST['about_us'],'orc_id'=>$_REQUEST['orc_id'],'license_detail'=>$_REQUEST['license_detail']);
            $this->Crud_model->SaveData('users_details',$arrayName,"user_uuid='".$_REQUEST['user_uuid']."'");
            if(!empty($_REQUEST['Website_url']))
            {
                $cond = "user_uuid = '".$_REQUEST['user_uuid']."'";
                $Data = $this->Crud_model->GetData('user_website', ',',$cond, '', '', '', '');
                if(empty($Data))
                {
                    $arrayD = array("website_url" => $_REQUEST['Website_url'],"title"=> $_REQUEST['wtitle'],
                    "visibility"=>'No',"user_uuid"=> $_REQUEST['user_uuid']);
                    $this->Crud_model->SaveData('user_website',$arrayD);
                }
                else {
                    $arrayD = array("website_url" => $_REQUEST['Website_url'],"title"=> $_REQUEST['wtitle'],
                    "visibility"=>'No');
                    $this->Crud_model->SaveData('user_website',$arrayD,"user_uuid='".$_REQUEST['user_uuid']."'");
                }
                    
            }
redirect('profile');                
}    
        else {
            $arrayName = array('title'=>$_REQUEST['title'],'first_name'=>$_REQUEST['first_name'],'middle_name'=>$_REQUEST['middle_name'],'last_name'=>$_REQUEST['last_name'],'gender'=>$_REQUEST['gender'],'email'=>$_REQUEST['email'],'mobile_number'=>$mobile,'profession'=>$_REQUEST['profession'],'date_of_birth'=>$_REQUEST['date_of_birth'],'location_city'=>$_REQUEST['location'],'about_us'=>$_REQUEST['about_us'],'orc_id'=>$_REQUEST['orc_id'],'license_detail'=>$_REQUEST['license_detail']);
            $this->Crud_model->SaveData('users_details',$arrayName,"user_uuid ='".$_REQUEST['user_uuid']."'");
            if(!empty($_REQUEST['Website_url']))
            {
                $cond = "user_uuid = '".$_REQUEST['user_uuid']."'";
                $Data = $this->Crud_model->GetData('user_website', ',',$cond, '', '', '', '');
                if(empty($Data))
                {
                    $arrayD = array("website_url" => $_REQUEST['Website_url'],"title"=> $_REQUEST['wtitle'],
                    "visibility"=>'No',"user_uuid"=> $_REQUEST['user_uuid']);
                    $this->Crud_model->SaveData('user_website',$arrayD);
                }
                else {
                    $arrayD = array("website_url" => $_REQUEST['Website_url'],"title"=> $_REQUEST['wtitle'],
                    "visibility"=>'No');
                    $this->Crud_model->SaveData('user_website',$arrayD,"user_uuid='".$_REQUEST['user_uuid']."'");
                }
            }
                //$this->set_response(['message'=>'Profile Updated Successfully',       
                            // 'success' => "1"]);
            redirect('profile');

            
        }
    }
    else{
        redirect('profile');
    }
}
    }
public function upload_data()
{
    $users = $this->Crud_model->GetData('users_details','',"user_uuid='".$_SESSION[SESSION_NAME]['user_uuid']."'",'','','','1');
    $arraydata = array('data_upload_status' =>$users->data_upload_status);
    $this->load->view('du',$arraydata);
}

public function duAction()
{
    $arraydata = array('du_textarea' => $_REQUEST['reason'],'user_id'=>$_SESSION[SESSION_NAME]['user_uuid'],'created'=>date('Y-m-d g:i:s'),'status'=>'Pending');
    $this->Crud_model->save('data_uploads',$arraydata);
    $arraysuer = array('data_upload_status'=>'Pending');
    $this->Crud_model->save('users_details',$arraysuer,"user_uuid='".$_SESSION[SESSION_NAME]['user_uuid']."'");
    $users = $this->Crud_model->GetData('users_details','',"user_uuid='".$_SESSION[SESSION_NAME]['user_uuid']."'",'','','','1');
    $email = $users->email;
    //SMTP & mail configuration
                    $this->load->library('email');
                    $config = array(
                        'protocol'  => PROTOCOL,
                        'smtp_host' => SMTP_HOST,
                        'smtp_port' => 465,
                        'smtp_user' => SMTP_USER,
                        'smtp_pass' => SMTP_PASS,
                        'mailtype'  => 'html',
                        'charset'   => 'utf-8'
                    );
                    $this->email->initialize($config);
                    $this->email->set_mailtype("html");
                    $this->email->set_newline("\r\n");
                    //Email content
                    $htmlContent = '<h1>Hefty Data Upload Request Response EMail </h1>';
                    $htmlContent .= '<p>'.$_REQUEST['reason'].'</p>';
                    $this->email->to($email);
                    $this->email->from('ibisfesadm@gmail.com','IBIS');
                    $this->email->subject('Data Upload Taxonomy');
                    $this->email->message($htmlContent);
                    $this->email->send();
    //mail                
    redirect('dashboard');
}
public function uploadData()
{
   $GetLicense = $this->Crud_model->GetData('data_licenses','','','data_licenses_id');
   $arraydata = array('GetLicense'=>$GetLicense);
   $this->load->view('dataTaxonomy',$arraydata);
}
public function DataSetList()
{
    $DDset = $this->Crud_model->GetData('data_attributes','',"user_id='".$_SESSION[SESSION_NAME]['user_uuid']."'",'','','','');
    $arraydata = array('DDset' => $DDset);
    $this->load->view('dataSet_list',$arraydata);   
}
public function DataSet()
{    
    if(!empty($this->uri->segment(3)))
    {
        $cond="d.upload_data_id='".$this->uri->segment(3)."'";
        $getUploadCount = $this->Crud_model->GetDataUplodCount($cond);
        $postData = array('datasetId' => $this->uri->segment(3));
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => NODE_URL.'/getImagesForDataset',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($postData),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $imageArray = array();
        $responseD = json_decode($response);
       // print_r($responseD);exit;
      // $DDset = $this->Crud_model->GetData('data_attributes','',"user_id='".$_SESSION[SESSION_NAME]['user_uuid']."' and upload_data_id='".$this->uri->segment(3)."'",'','','','1');
       $DDset = $this->Crud_model->GetData('data_attributes','',"upload_data_id='".$this->uri->segment(3)."'",'','','','1');
        //print_r($DDset);exit;
        if(!empty($DDset->created_date)) {
        $date = DateTime::createFromFormat('Y-m-d', $DDset->created_date)->format('d-M-Y');
    }
//Major Taxonomic Groups Class
$postDataC = array('datasetId' => $this->uri->segment(3),'field'=>'class');
        $curlC = curl_init();
        curl_setopt_array($curlC, array(
            CURLOPT_URL => NODE_URL.'/getDistinctTaxonomyForDataset',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($postDataC),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $responsC = curl_exec($curlC);
        curl_close($curlC);
        $cllc = json_decode($responsC,true); 
//Order List
        $postDataO = array('datasetId' => $this->uri->segment(3),'field'=>'order');
        $curlO = curl_init();
        curl_setopt_array($curlO, array(
            CURLOPT_URL => NODE_URL.'/getDistinctTaxonomyForDataset',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($postDataO),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $responsO = curl_exec($curlO);
        curl_close($curlO);
        $cllO = json_decode($responsO,true);
//FAMILY
$postDataF = array('datasetId' => $this->uri->segment(3),'field'=>'family');
        $curlF = curl_init();
        curl_setopt_array($curlF, array(
            CURLOPT_URL => NODE_URL.'/getDistinctTaxonomyForDataset',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($postDataF),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $responsF = curl_exec($curlF);
        curl_close($curlF);
        $cllF = json_decode($responsF,true);
//SCIENTIFIC NAME
$postDataS = array('datasetId' => $this->uri->segment(3),'field'=>'scientificname');
        $curlS = curl_init();
        curl_setopt_array($curlS, array(
            CURLOPT_URL => NODE_URL.'/getDistinctTaxonomyForDataset',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($postDataS),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $responsS = curl_exec($curlS);
        curl_close($curlS);
        $cllS = json_decode($responsS,true); 
        //print_r($cllS['data']);exit;   
        if(!empty($cllc['data'] || $cllF['data'] || $cllS['data'] || $cllO['data']))  
        {
            $arrayD = array('data_title' => $DDset->data_title,'data_subtitle'=>$DDset->data_subtitle,'data_author'=>$DDset->data_author,'data_description'=>$DDset->data_description,'data_licenses'=>$DDset->data_licenses,'data_citations'=>$DDset->data_citations,'created_date'=>$date,'responseD'=>$responseD,'uploadID'=>$DDset->upload_data_id,'class'=>$cllc['data'],'order'=>$cllO['data'],'family'=>$cllF['data'],'scientificname'=>$cllS['data'],'getUploadCount'=>$getUploadCount);
        }          
        else {
            $arrayD = array('data_title' => $DDset->data_title,'data_subtitle'=>$DDset->data_subtitle,'data_author'=>$DDset->data_author,'data_description'=>$DDset->data_description,'data_licenses'=>$DDset->data_licenses,'data_citations'=>$DDset->data_citations,'created_date'=>$date,'responseD'=>$responseD,'uploadID'=>$DDset->upload_data_id,'class'=>array(),'order'=>array(),'family'=>array(),'scientificname'=>array(),'getUploadCount'=>$getUploadCount);
        }
        
        $this->load->view('dataset_U',$arrayD);

    }
    else{
        $arrayD = array('data_title' =>'','data_subtitle'=>'','data_author'=>'','data_description'=>'','data_licenses'=>'','data_citations'=>'','created_date'=>'','responseD'=>'','uploadID'=>'','class'=>'','order'=>'','family'=>'','scientificname'=>'','getUploadCount'=>'');
        $this->load->view('dataset_U',$arrayD);
    }
}
public function DaAction()
{
   if(!empty($_REQUEST['title']))
    {
        $arraydata = array('upload_data_id'=>$_REQUEST['UploadDataID'],'data_title' => $_REQUEST['title'],'data_subtitle'=>$_REQUEST['sub_title'],'data_author'=>$_REQUEST['author_name'],'data_description'=>$_REQUEST['description'],'data_licenses'=>$_REQUEST['data_licenses'],'data_citations'=>$_REQUEST['data_citations'],'user_id'=>$_SESSION[SESSION_NAME]['user_uuid'],'created_date'=>date('Y-m-d'));
        $this->Crud_model->save('data_attributes',$arraydata);
        redirect('profile/DataSetList');
    }
    else {
        redirect('profile/upload_data');
    }
}
public function Btaxonomy() {
if(!empty($this->uri->segment(3)))
    {
        $dlocation = $this->Crud_model->GetData('location','',"observation_id='".$this->uri->segment(3)."'",'','','','');
       // print_r($dlocation);exit;
        $doccurence = $this->Crud_model->GetData('occurence','',"observation_id='".$this->uri->segment(3)."'",'','','','');
        $drecord = $this->Crud_model->GetData('record_level','',"observation_id='".$this->uri->segment(3)."'",'','','','');
        $dtaxon = $this->Crud_model->GetData('taxon','',"observation_id='".$this->uri->segment(3)."'",'','','','');
        $devent = $this->Crud_model->GetData('event','',"observation_id='".$this->uri->segment(3)."'",'','','','');
        $arrayData = array('dlocation' => $dlocation,'doccurence'=>$doccurence,'drecord'=>$drecord,'dtaxon'=>$dtaxon,'devent'=>$devent);
        $this->load->view('browse_taxonomy',$arrayData);
    }
    else {
        $this->load->view('browse_taxonomy');
    }
}

}
/* End of file Profile.php */
?>