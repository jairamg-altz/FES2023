<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('facebook');
    }
    public function index()
    {
        $this->load->view('index');
    }

    public function fblogin()
    {
        $data['user'] = array();
        if (!empty($this->facebook->is_authenticated())) {
            // User logged in, get user details
            $user = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,link,gender,picture');
            //print_r($user);exit;
            if (!empty($user)) {
$checkUser = $this->Crud_model->GetData('users_details', '', "user_id='".$user['id']."'", '', '', '', ''); 
//print_r("fddd");exit;  
if(empty($checkUser)) { 
 $SaveDataArray = array(
                        'user_id' => $user['id'],
                        'first_name' => trim($user['first_name']),
                        'last_name' => trim($user['last_name']),
                        'email' => $user['email'],
                        'is_deleted'=>'No','role'=>'User',
                        'registration_date'=>date('Y-m-d g:i:s'),'otp_verified'=>'Yes',
                        'status'   => 'Active');
                    //print_r($SaveDataArray);exit;
                    $this->Crud_model->SaveData('users_details', $SaveDataArray);
        $checkD = $this->Crud_model->GetData('users_details', '', "user_id='".$user['id']."'", '', '', '', '1');            
                $sess_array[SESSION_NAME] = (array) $checkD;
                $this->session->set_userdata($sess_array);
                $_SESSION[SESSION_NAME]['name'] = $_SESSION[SESSION_NAME]['first_name'] . ' ' . $_SESSION[SESSION_NAME]['last_name'];
                $_SESSION[SESSION_NAME]['profileImg'] = $_SESSION[SESSION_NAME]['profileimage_id'];
                redirect('dashboard');        
    
    }
    else {
        //print_r($checkUser);exit;
        $checkD = $this->Crud_model->GetData('users_details', '', "user_id='".$user['id']."'", '', '', '', '1');
        $sess_array[SESSION_NAME] = (array) $checkD;
                $this->session->set_userdata($sess_array);
                $_SESSION[SESSION_NAME]['name'] = $_SESSION[SESSION_NAME]['first_name'] . ' ' . $_SESSION[SESSION_NAME]['last_name'];
                $_SESSION[SESSION_NAME]['profileImg'] = $_SESSION[SESSION_NAME]['profileimage_id'];
             //   print_r($_SESSION);        
       // print_r($_SESSION[SESSION_NAME]['user_uuid']);exit;        
                redirect('dashboard');    
    } 

            }

        } else {
            //print_r("facebook error");exit;
            $this->load->view('index');
        }
    }
public function insta()
{
    //print_r($_REQUEST);exit;
    $url = 'https://api.instagram.com/oauth/access_token';
        
    $urlPost = 'client_id='. INSTAGRAM_CLIENT_ID .  '&client_secret=' . INSTAGRAM_CLIENT_SECRET . '&code='. $_REQUEST['code'] . '&grant_type=authorization_code'.'&redirect_uri=' . INSTAGRAM_REDIRECT_URI;
    //print_r($urlPost);exit;
        $ch = curl_init();      
        curl_setopt($ch, CURLOPT_URL, $url);        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);      
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $urlPost);         
        $data = json_decode(curl_exec($ch), true); 
        //print_r($data);exit; 
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
        curl_close($ch); 
      if($http_code != '200'){     
            throw new Exception('Error : Failed to receive access token'.$http_code); 
        } 
        else {
$urlD ='https://graph.instagram.com/v14.0/me?fields=id,username&access_token=' . $data['access_token'];
 $ch = curl_init();
$options = array(
    CURLOPT_URL            => $urlD,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CONNECTTIMEOUT => 120,
    CURLOPT_TIMEOUT        => 120,
    );
curl_setopt_array( $ch, $options );
$response = json_decode(curl_exec($ch), true); 
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
if ($httpCode == 200 ){
  $checkUser = $this->Crud_model->GetData('users_details', '', "user_id='".$response['username']."'", '', '', '', '');  
//print_r($checkUser);exit;  
if(empty($checkUser)) { 
 $SaveDataArray = array(
                        'user_id' => $response['username'],
                        'is_deleted'=>'No','role'=>'User',
                        'registration_date'=>date('Y-m-d g:i:s'),'otp_verified'=>'Yes',
                        'status'   => 'Active');
                    //print_r($SaveDataArray);exit;
                    $this->Crud_model->SaveData('users_details', $SaveDataArray);
                $sess_array[SESSION_NAME] = (array) $SaveDataArray;
                $this->session->set_userdata($sess_array);
                $_SESSION[SESSION_NAME]['name'] = $_SESSION[SESSION_NAME]['first_name'] . ' ' . $_SESSION[SESSION_NAME]['last_name'];
                $_SESSION[SESSION_NAME]['profileImg'] = $_SESSION[SESSION_NAME]['profileimage_id'];
                redirect('dashboard');        
    
    }
    else {
        //print_r($checkUser);exit;
        $checkD = $this->Crud_model->GetData('users_details', '', "user_id='".$response['username']."'", '', '', '', '1');
        $sess_array[SESSION_NAME] = (array) $checkD;
                $this->session->set_userdata($sess_array);
                $_SESSION[SESSION_NAME]['name'] = $_SESSION[SESSION_NAME]['first_name'] . ' ' . $_SESSION[SESSION_NAME]['last_name'];
                $_SESSION[SESSION_NAME]['profileImg'] = $_SESSION[SESSION_NAME]['profileimage_id'];
             //   print_r($_SESSION);        
       // print_r($_SESSION[SESSION_NAME]['user_uuid']);exit;        
                redirect('dashboard');    
    }
}
else {
    echo $httpCode;exit;
}
}       

}    
public function glogin()
{
    //print_r(APPPATH);exit;
    include_once APPPATH . "libraries/vendor/autoload.php";
    $google_client = new Google_Client();
    //require_once "google.php";
    $google_client->setClientId(ClientID); //Define your ClientID
    $google_client->setClientSecret(CLIENTSECRET); //Define your Client Secret Key
    $google_client->setRedirectUri(REDIRECT_URI); //Define your Redirect Uri
    $loginURL =  $google_client->createAuthUrl();
  $google_client->addScope('email');
 
  $google_client->addScope('profile');
  //print_r($google_client);exit;
  $token = $google_client->setAccessToken($_GET["code"]);
  
  if(isset($_GET["code"]))
  {
   $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
 
   if(!isset($token["error"]))
   {
    $google_client->setAccessToken($token['access_token']);
 
    $this->session->set_userdata('access_token', $token['access_token']);
 
    $google_service = new Google_Service_Oauth2($google_client);
    $data = $google_service->userinfo->get();
    $cond = "email='".$data['email']."'"; 
    $checkUser = $this->Crud_model->GetData('users_details', '', "email='".$data['email']."'");  
if(empty($checkUser)) { 
 $SaveDataArray = array(
                        'user_id' => $data['id'],
                        'first_name' => trim($data['givenName']),
                        'last_name' => trim($data['familyName']),
                        'email' => $data['email'],
                        //'profileimage_id' => $data['picture'],
                        'is_deleted'=>'No','role'=>'User',
                        'registration_date'=>date('Y-m-d g:i:s'),'otp_verified'=>'Yes',
                        'status'   => 'Active');
                    //print_r($SaveDataArray);exit;
                    $this->Crud_model->SaveData('users_details', $SaveDataArray);
                $sess_array[SESSION_NAME] = (array) $SaveDataArray;
                $this->session->set_userdata($sess_array);
                $_SESSION[SESSION_NAME]['name'] = $_SESSION[SESSION_NAME]['first_name'] . ' ' . $_SESSION[SESSION_NAME]['last_name'];
                $_SESSION[SESSION_NAME]['profileImg'] = $_SESSION[SESSION_NAME]['profileimage_id'];
                redirect('dashboard');        
    
    }
    else {
        $checkUser = $this->Crud_model->GetData('users_details', '', "user_id='".$data['id']."'", '', '', '', '1');
        $sess_array[SESSION_NAME] = (array) $checkUser;
                $this->session->set_userdata($sess_array);
                $_SESSION[SESSION_NAME]['name'] = $_SESSION[SESSION_NAME]['first_name'] . ' ' . $_SESSION[SESSION_NAME]['last_name'];
                $_SESSION[SESSION_NAME]['profileImg'] = $_SESSION[SESSION_NAME]['profileimage_id'];
                redirect('dashboard');    
    }
    }
   }
  }
  
    //print_r($google_client);exit;

}
