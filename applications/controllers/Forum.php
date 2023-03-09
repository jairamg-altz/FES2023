<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Forum extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        /*if(empty($_SESSION[SESSION_NAME]['user_uuid']))
        {
            redirect('home');
        }*/
    }    

public function index()
    {
        $data = $this->Crud_model->Forom();
        //print_r($data);exit;
        $categories = $this->Crud_model->GetData('categories','','','','','5','');
        foreach ($data as $key => $valueRow);
        $data = array('foo' => 'bar','data'=>$data,'categories'=>$categories,'Apost'=>$valueRow);
        $this->load->view('forum', $data);
    }
public function myPost()
    {
        $data = $this->Crud_model->ForomS();
        $categories = $this->Crud_model->GetData('categories','','','','','5','');
        foreach ($data as $key => $valueRow);
        $data = array('foo' => 'bar','data'=>$data,'categories'=>$categories,'Apost'=>$valueRow);
        $this->load->view('forum', $data);
    }    
public function CreatePost()
{
    $categories = $this->Crud_model->GetData('categories');
    $data = array('foo' => 'bar','categories'=>$categories);
    $this->load->view('post', $data);
}
public function likesCount()
{
   // print_r($_REQUEST);exit;
    if(!empty($_REQUEST['forumID']))
    {
        $data = $this->Crud_model->GetData('discussions','like_no',"forum_id='".$_REQUEST['forumID']."'",'','','','1');
        $Tlike = $data->like_no + 1; 
        $arrayData= array('like_no' => $Tlike);
        $this->Crud_model->save('discussions',$arrayData,"forum_id='".$_REQUEST['forumID']."'");
        echo "1";exit;
    }
}
public function shareForum()
{
    $data = $this->Crud_model->GetData('discussion_medias','discussion_media',"discussion_post_id='".$_REQUEST['forumID']."' and discussion_activity='post'",'','','','1');
    if(!empty($data)) { 
    $url = IMAGE_URL.'forum/fmedia/'.$data->discussion_media;
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
public function CreatePostAction()
{
    $random = uniqid();
    $this->load->library('upload');
    $dataInfo = array();
    $files = $_FILES;
    $cpt = count($_FILES['media']['name']);
    if($cpt!=0) { 
    $arrayData = array('subject' =>$_REQUEST['title'],'text_msg'=>$_REQUEST['text_msg'],'date_time'=>date('Y-m-d H:i:s'),'created_by'=>$_SESSION[SESSION_NAME]['user_uuid'],'category'=>$_REQUEST['categories'],'funique_id'=>$random);
        $this->Crud_model->save('discussions',$arrayData);
        $lastUnqid = $this->Crud_model->GetData('discussions','forum_id',"funique_id='".$random."'",'','','','1');    
    for($i=0; $i<$cpt; $i++)
    {           
        $_FILES['media']['name']= $files['media']['name'][$i];
        $_FILES['media']['type']= $files['media']['type'][$i];
        $_FILES['media']['tmp_name']= $files['media']['tmp_name'][$i];
        $_FILES['media']['error']= $files['media']['error'][$i];
        $_FILES['media']['size']= $files['media']['size'][$i]; 
        $uploadPath = 'media/img/forum/fmedia/';
        $config['upload_path'] = $uploadPath;
        $config['allowed_types'] = 'jpg|jpeg|png|gif|mp4';
        $config['max_size'] = '3000000';
        // Load and initialize upload library
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $this->upload->do_upload('media');
        // Uploaded file data
        $imageData = $this->upload->data();
        $mediaUrl = API_URL.'/media/img/forum/fmedia/'.$imageData['file_name']; 
        //print_r($mediaUrl);exit;   
        $arrMedia = array('discussion_post_id' =>$lastUnqid->forum_id,'discussion_media'=>$imageData['file_name'],'discussion_media_url'=>$mediaUrl,'discussions_media_type'=>$_REQUEST['attachment_type'],'discussion_activity'=>'post','created_by'=>$_SESSION[SESSION_NAME]['user_uuid'],'created_date'=>date('Y-m-d')); 
            $this->Crud_model->save('discussion_medias',$arrMedia);   
            //$uploadImgData[$i]['image_name'] = $imageData['file_name'];
            //print_r($imageData['file_name']);
    }
    
        redirect('Forum/index');
}
else {
   $arrayData = array('subject' =>$_REQUEST['title'],'text_msg'=>$_REQUEST['text_msg'],'date_time'=>date('Y-m-d H:i:s'),'created_by'=>$_SESSION[SESSION_NAME]['user_uuid'],'category_id'=>$_REQUEST['categories'],'funique_id'=>$random);
        $this->Crud_model->save('discussions',$arrayData); 
        redirect('Forum/index');
} 
}
public function replyAction($postId)
{
    //print_r($_REQUEST);exit;
    if(!empty($_REQUEST['reply']))
    {
        $this->load->library('upload');
        $dataInfo = array();
        $files = $_FILES;
        $cpt = count($_FILES['media']['name']);
        if($cpt!=0) { 
        $arrayData = array('discussion_forum_id' =>$postId,'text_msg'=>$_REQUEST['reply'],'date_time'=>date('Y-m-d H:i:s'),'created_by'=>$_SESSION[SESSION_NAME]['user_uuid']);
        $this->Crud_model->save('discussion_responses',$arrayData);
        for($i=0; $i<$cpt; $i++)
    { 
        $_FILES['media']['name']= $files['media']['name'][$i];
        $_FILES['media']['type']= $files['media']['type'][$i];
        $_FILES['media']['tmp_name']= $files['media']['tmp_name'][$i];
        $_FILES['media']['error']= $files['media']['error'][$i];
        $_FILES['media']['size']= $files['media']['size'][$i]; 
        $uploadPath = 'assets/img/forum/fmedia/';
        $config['upload_path'] = $uploadPath;
        $config['allowed_types'] = 'jpg|jpeg|png|gif|mp4';
        $config['max_size'] = '300000';
        // Load and initialize upload library
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $this->upload->do_upload('media');
        // Uploaded file data
        $imageData = $this->upload->data();
        $mediaUrl = API_URL.'/assets/img/forum/fmedia/'.$imageData['file_name']; 
        $iparr = substr($files['media']['type'][$i], 0, 5);  
        $arrMedia = array('discussion_post_id' =>$postId,'discussion_media'=>$imageData['file_name'],'discussion_media_url'=>$mediaUrl,'discussions_media_type'=>$iparr,'discussion_activity'=>'reply','created_by'=>$_SESSION[SESSION_NAME]['user_uuid'],'created_date'=>date('Y-m-d')); 
            $this->Crud_model->save('discussion_medias',$arrMedia);

    }
       
            //$uploadImgData[$i]['image_name'] = $imageData['file_name'];
            //print_r($imageData['file_name']);
    }
    else {
             $arrayData = array('discussion_forum_id' =>$postId,'text_msg'=>$_REQUEST['reply'],'date_time'=>date('Y-m-d H:i:s'),'created_by'=>$_SESSION[SESSION_NAME]['user_uuid']);
        $this->Crud_model->save('discussion_responses',$arrayData); 
    }
    
        redirect('Forum/index');
}

}
public function categories()
{
    $getGenCat = $this->Crud_model->GetData('discussions','',"category='General'",'','5','');
    $getpCat = $this->Crud_model->GetData('discussions','',"category='Portal Updates'",'','5','');
    //print_r($getpCat);exit;
    $getpBat = $this->Crud_model->GetData('discussions','',"category='Bugs and features'",'','5','');
    $getfCat = $this->Crud_model->GetData('discussions','',"category='Feedback'",'','5','');
    $getcoCat = $this->Crud_model->GetData('discussions','',"category='Community Outreach'",'','5','');
    $getctCat = $this->Crud_model->GetData('discussions','',"category='Collaborations and trainings'",'','5','');
    $getksCat = $this->Crud_model->GetData('discussions','',"category='Knowledge sharing'",'','5','');
    $getsiCat = $this->Crud_model->GetData('discussions','',"category='Species identification'",'','5','');
    $getsdiCat = $this->Crud_model->GetData('discussions','',"category='SDM'",'','5','');
    $arrayData = array('getGenCat' =>$getGenCat,'getpCat'=>$getpCat,'getpBat'=>$getpBat,'getfCat'=>$getfCat,'getcoCat'=>$getcoCat,'getctCat'=>$getctCat,'getksCat'=>$getksCat,'getsiCat'=>$getsiCat,'getsdiCat'=>$getsdiCat);
    $this->load->view('categories',$arrayData);
}

public function Catforum()
{
    if(!empty($this->uri->segment(3)))
    {
        $cond="d.category='".$this->uri->segment(3)."'";
        $data = $this->Crud_model->CatForom($cond);
        //print_r($data);exit;
        $categories = $this->Crud_model->GetData('categories','','','','','5','');
       // foreach ($data as $key => $valueRow);
        $data = array('foo' => 'bar','data'=>$data,'categories'=>$categories,'Apost'=>$valueRow);
        $this->load->view('category_forum', $data);    
    }
    
    
}
public function Fdetails($forumId)
{
    $cond="forum_id='".$forumId."'";
    $data = $this->Crud_model->ForomDetail($cond);
    $date1 = new DateTime(date('Y-m-d H:i:s'));
    $date2 = new DateTime($data->date_time);
    $interval = date_diff($date1, $date2);
    $getTdiffY = $interval->format("%y");
    $getTdiffMM = $interval->format("%m");
    $getTdiffD = $interval->format("%d");
    $getTdiffH = $interval->format("%h");
    $getTdiffM = $interval->format("%i");     
if (strlen($data->text_msg) > 250) {
   $str = substr($data->text_msg, 0, 230) . '...';
}
$getMedia = $this->Crud_model->GetData('discussion_medias','',"discussion_activity='post' and discussion_post_id='".$data->forum_id."'",'','','');
$cond="discussion_forum_id='".$data->forum_id."'";
$getReply = $this->Crud_model->ForomReply($cond);
 $arrayData = array('data' => $data,'getMedia'=>$getMedia,'getReply'=>$getReply,'getTdiffH'=>$getTdiffH,'getTdiffM'=>$getTdiffM,'getTdiffD'=>$getTdiffD,'getTdiffY'=>$getTdiffY,'getTdiffMM'=>$getTdiffMM);
$this->load->view('forumDetails',$arrayData);
}    
}

?>