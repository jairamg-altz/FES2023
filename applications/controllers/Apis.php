<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
error_reporting(0);
class Apis extends REST_Controller {
public function __construct()
{
    parent::__construct();   
}
function headers()
    {
        /* Basic dGFza2FwcDpwYXNzJDEyMw==  */
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
        header('Access-Control-Max-Age: 1000');
        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
        header("Content-type: application/json");
    }
    // User Registration  
public function UserSignUpAction_post()
    {
        $this->headers();
        $_REQUEST = json_decode(file_get_contents('php://input'), true);
        $loginType = $_REQUEST['logintype'];
        if($loginType=="mobile")
        {
            $user_id = $_REQUEST['user_id'];
            $first_name = $_REQUEST['first_name'];
            $last_name = $_REQUEST['last_name'];
            $email = $_REQUEST['email'];
            $mobile = $_REQUEST['mobile']; 
            $password = $_REQUEST['password'];
            $password_confirm = $_REQUEST['password_confirm'];
        if (!empty($first_name) && !empty($email) && !empty($password) && !empty($password_confirm)) {
            $cond="user_id='".$user_id."' and email='" . $email . "' and mobile_number='".$mobile."'";
            $checkUser = $this->Crud_model->GetData('users_details', '', $cond, '', '', '', '1');
            if (empty($checkUser)) {
                if ($password == $password_confirm) {
                    $SaveDataArray = array(
                        'user_id' => $user_id,
                        'first_name' => $first_name,
                        'last_name' => $last_name,
                        'email' => $email,
                        'mobile_number' => $mobile,
                        'password' => md5($password),
                        'is_deleted'=>'No','role'=>'User',
                        'registration_date'=>date('Y-m-d g:i:s'),
                        'status'   => 'Active');
                    $this->Crud_model->SaveData('users_details', $SaveDataArray);
                    $this->set_response(['message'=>'User Created Successfully','success' => "1"]);
                } else {
                    $this->set_response(['message'=>'Password does not match.','success' => "0"]);
                    }
            } else {
                $this->set_response([
                            'message'=>'User already exist.',       
                             'success' => "0"]);
                   }
        } else {
            $this->set_response([
                            'message'=>'Required parameters are missing.',       
                             'success' => "0"]);
           }  
        }
        else
        {
            $user_id = $_REQUEST['user_id'];
            $first_name = $_REQUEST['first_name'];
            $last_name = $_REQUEST['last_name'];
            $email = $_REQUEST['email'];
            $mobile = $_REQUEST['mobile']; 
            $password = $_REQUEST['password'];
            $password_confirm = $_REQUEST['password_confirm'];
        if (!empty($first_name) && !empty($email) && !empty($password) && !empty($password_confirm)) {
            $cond="user_id='".$user_id."' and email='" . $email . "' and mobile_number='".$mobile."'";
            $checkUser = $this->Crud_model->GetData('users_details', '', $cond, '', '', '', '1');
            if (empty($checkUser)) {
                if ($password == $password_confirm) {
                    $otp = random_int(100000, 999999);
                    $SaveDataArray = array(
                        'user_id' => $user_id,
                        'first_name' => $first_name,
                        'last_name' => $last_name,
                        'email' => $email,
                        'mobile_number' => $mobile,
                        'password' => md5($password),
                        'is_deleted'=>'No','role'=>'User',
                        'registration_date'=>date('Y-m-d g:i:s'),'otp'=>$otp,'otp_verified'=>'No',
                        'status'   => 'Active');
                    $this->Crud_model->SaveData('users_details', $SaveDataArray);
                    $UserData = $this->Crud_model->GetData('users_details', '',"otp='".$otp."'", '', '', '', '1');
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
                    $htmlContent = '<h1>Registration Otp Authentication Mail</h1>';
                    $htmlContent .= '<p>'.$otp.'</p>';
                    $this->email->to($email);
                    $this->email->from('ibisfesadm@gmail.com','IBIS');
                    $this->email->subject('Registration Otp Authentication');
                    $this->email->message($htmlContent);
                    $this->email->send();
                    $this->set_response(['user_uuid'=>$UserData->user_uuid,'message'=>'User Created Successfully','success' => "1"]);
                } else {
                    $this->set_response(['message'=>'Password does not match.','success' => "0"]);
                    }
            } else {
                $this->set_response([
                            'message'=>'User already exist.',       
                             'success' => "0"]);
                   }
        } else {
            $this->set_response([
                            'message'=>'Required parameters are missing.',       
                             'success' => "0"]);
           }  
        }
        
 }
// User Login 
public function UserLoginAction_post()
    {
 
        $this->headers();
        $_REQUEST = json_decode(file_get_contents('php://input'), true);
        $user_id = $_REQUEST['user_id'];
        $loginType = $_REQUEST['logintype'];
        if($loginType=="mobile")
        {
            $password = md5($_REQUEST['password']);
            $cond = "user_id='".$user_id."' and password='".$password."' and status='Active'"; 
            $checkUser = $this->Crud_model->GetData('users_details', '', $cond, '', '', '', '1');
            //print_r($this->db->last_query());exit;
        if (!empty($checkUser)) {                
                $data = array(
                        'user_uuid'=> $checkUser->user_uuid,
                        'user_id'=> $checkUser->user_id,
                        'first_name' => $checkUser->first_name,
                        'middle_name' => $checkUser->middle_name,
                        'last_name' => $checkUser->last_name,
                        'email' => $checkUser->email,
                        'mobile' =>$checkUser->mobile_number,
                        'profileimage_id' =>$checkUser->profileimage_id,
                        'registration_date' =>date('Y-m-d'),
                        'status' =>$checkUser->status
                    );
                //print_r($data);exit;
            $this->set_response([
                            'data'=>$data,
                            'message'=>'Logged In Successfully',       
                             'success' => "1"]);
            } 
             else {
                $this->set_response([
                             'message'=>'User does not exist.',       
                             'success' => "0"]);
            }
        }

         else {
    if (!empty($_REQUEST['user_id'])) {
            $cond = "user_id='".$user_id."' and password='".md5($_REQUEST['password'])."' and status='Active'"; 
            $checkUser = $this->Crud_model->GetData('users_details', '', $cond, '', '', '', '1');
           if (!empty($checkUser)) { 
             if($checkUser->otp_verified=='No')
                {
                    $this->set_response([
                            'user_id'=>$checkUser->user_uuid,
                             'success' => "2"]);
                } 
            else {                  
                $data = array(
                        'user_uuid'=> $checkUser->user_uuid,
                        'user_id'=> $checkUser->user_id,
                        'first_name' => $checkUser->first_name,
                        'middle_name' => $checkUser->middle_name,
                        'last_name' => $checkUser->last_name,
                        'email' => $checkUser->email,
                        'mobile' =>$checkUser->mobile_number,
                        'profileimage_id' =>$checkUser->profileimage_id,
                        'registration_date' =>date('Y-m-d'),
                        'status' =>$checkUser->status
                    );
            $this->set_response([
                            'data'=>$data,
                            'message'=>'Logged In Successfully',       
                             'success' => "1"]);
            } 
        }else {
            $this->set_response([
                             'message'=>'User does not exist.',       
                             'success' => "0"]);
        }

            } else {
                //print_r("expression");exit;
                $this->set_response([
                             'message'=>'User does not exist.',       
                             'success' => "0"]);
            }
            }
        
            
        } 
// Feedback Insert
public function PFeedbackReg_post()
{
    $this->headers();
    $_REQUEST = json_decode(file_get_contents('php://input'), true);
    //$fuuid = md5(mt_rand(10,999999));
    $SaveDataArray = array('feedback_emotion' => $_REQUEST['femotion'],'feedback_section' => $_REQUEST['section'],'feedback_type' => $_REQUEST['type'],'text_msg' => $_REQUEST['feedback'],'created_date' => date('Y-m-d'),'visibility' => 'Unpublish','is_deleted'=>'No');
    $this->Crud_model->SaveData('feedbacks', $SaveDataArray);
    $this->set_response(['message'=>'Feedback Created Successfully','success' => "1"]);
   
}        
public function FeedbackReg_post()
{
    $this->headers();
    $_REQUEST = json_decode(file_get_contents('php://input'), true);
    if(!empty($_REQUEST['user_uuid']))
    {
        $SaveDataArray = array('created_by' => $_REQUEST['user_uuid'],
                        'feedback_emotion' => $_REQUEST['femotion'],
                        'feedback_section' => $_REQUEST['section'],
                        'feedback_type' => $_REQUEST['type'],
                        'text_msg' => $_REQUEST['feedback'],
                        'created_date' => date('Y-m-d'),
                        'visibility' => 'Unpublish',
                        'is_deleted'=>'No'                        
                    );
                    $this->Crud_model->SaveData('feedbacks', $SaveDataArray);
                    $this->set_response([
                            'message'=>'Feedback Created Successfully',       
                             'success' => "1"]);
    }
    else {
        $this->set_response([
                            'message'=>'something are missing!',       
                             'success' => "0"]);
    }
}
//FeedbackData
public function FeedbackData_post()
{
    $this->headers();
    $_REQUEST = json_decode(file_get_contents('php://input'), true);
    if(!empty($_REQUEST['user_uuid']))
    {
        $cond="f.created_by='".$_REQUEST['user_uuid']."' and f.is_deleted='No'";
        $Data = $this->Crud_model->PFeedbacksDatasD($cond);
        //print_r($this->db->last_query());exit;
        $condR="r.respondent_userid='".$_REQUEST['user_uuid']."'";
        $RData = $this->Crud_model->PFeedbacksResponseD($condR);
    if(!empty($Data))
    {
        $this->set_response([ 'data' => $Data,'ReplyData'=>$RData,
                            'message'=>'Record Feched Successfully',       
                             'success' => "1"]);
    }
    else {
        $this->set_response([
                            'message'=>'Record not found',       
                             'success' => "0"]);
    }    
    }
     else {
        $this->set_response([
                            'message'=>'something are missing!',       
                             'success' => "0"]);
    }
    
}
//FORGOT PASSWORD
public function forgotPassword_post()
{
        $this->headers();
        $_REQUEST = json_decode(file_get_contents('php://input'), true);
        $pass = uniqid();
        $email = $_REQUEST['email'];
        $password = md5($pass);
        if (!empty($email)) {
            $cond = "email='".$email."'"; 
            $checkUser = $this->Crud_model->GetData('users_details', '', $cond, '', '', '', '1');
            if (!empty($checkUser)) {
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
                    $htmlContent = '<h1>Forgot Password Mail</h1>';
                    $htmlContent .= '<p>'.$pass.'</p>';
                    $this->email->to($email);
                    $this->email->from(email_id,'IBIS');
                    $this->email->subject('Forgot Password');
                    $this->email->message($htmlContent);
                    $this->email->send();
                $data = array(
                        'password'=> $password);
                $this->Crud_model->SaveData('users_details',$data,"email='".$email."'");
            $this->set_response([
                            'data'=>$data,'password'=>$pass,
                            'message'=>'Your password has been sent to your e-mail',       
                             'success' => "1"]);
            } 
            else {
                $this->set_response([
                             'message'=>'User does not exist.',       
                             'success' => "0"]);
            }
            } else {
                $this->set_response([
                             'message'=>'User does not exist.',       
                             'success' => "0"]);
            }
}

//Forgot User ID

public function forgotUserId_post()
{
        $this->headers();
        $_REQUEST = json_decode(file_get_contents('php://input'), true);
        $uId = uniqid();
        $email = $_REQUEST['email'];
        $user_id = $uId;
        if (!empty($email)) {
            $cond = "email='".$email."'"; 
            $checkUser = $this->Crud_model->GetData('users_details', '', $cond, '', '', '', '1');
            if (!empty($checkUser)) {
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
                    $htmlContent = '<h1>Forgot User Id Mail</h1>';
                    $htmlContent .= '<p>'.$uId.'</p>';
                    $this->email->to($email);
                    $this->email->from(email_id,'IBIS');
                    $this->email->subject('Forgot User Id');
                    $this->email->message($htmlContent);
                    $this->email->send();
                $data = array(
                        'user_id'=> $user_id);
                $this->Crud_model->SaveData('users_details',$data,"email='".$email."'");
            $this->set_response([
                            'data'=>$data,'user_id'=>$uId,
                            'message'=>'Your password has been sent to your e-mail',       
                             'success' => "1"]);
            }
            else {
                $this->set_response([
                             'message'=>'User does not exist.',       
                             'success' => "0"]);
            } 
            } else {
                $this->set_response([
                             'message'=>'User does not exist.',       
                             'success' => "0"]);
            }
}
// COX
public function consortiumExperts_post()
{
    $this->headers();
        $_REQUEST = json_decode(file_get_contents('php://input'), true);
    $Data = $this->Crud_model->Coxeprts();
   // print_r($this->db->last_query());exit;
    if(!empty($Data))
    {
        $this->set_response(['data' => $Data,'Followers'=>'0',
                            'message'=>'Record Feched Successfully',       
                             'success' => "1"]);
    }
    else {
        $this->set_response([
                            'message'=>'something are missing!',       
                             'success' => "0"]);
    }
}
//Public Feedbacks
public function PublicFeedbacks_post()
{
    //print_r("sfds");exit;
    $this->headers();
    $cond="f.visibility='Publish' and f.is_deleted='No'";
    $Data = $this->Crud_model->PFeedbacksDatas($cond);
    //print_r($this->db->last_query());exit;
    if(!empty($Data))
    {
             $this->set_response(['Data'=>$Data,'message'=>'Record Feched Successfully',       
                             'success' => "1"]);
    }
    else{
       $this->set_response([
                            'message'=>'Record not found!',       
                             'success' => "0"]); 
    }
}

public function ChangePassword_post()
{
    $this->headers();
    //$_REQUEST = json_decode(file_get_contents('php://input'), true);
    if(!empty($_REQUEST['user_uuid'] && $_REQUEST['password'] && $_REQUEST['confirm_password']))
    {
        $cond="user_uuid='".$_REQUEST['user_uuid']."'";
        $Data = $this->Crud_model->GetData('users_details', ',',$cond, '', '', '', '1');
        if(!empty($Data))
        {
                if($_REQUEST['password']==$_REQUEST['confirm_password'])
                {
                    $arrayData =  array('password' => md5($_REQUEST['password']));
                    $this->Crud_model->SaveData('users_details',$arrayData,"user_uuid='".$_REQUEST['user_uuid']."'");
                 $this->set_response([
                                'message'=>'Change Password Updated Successfully',       
                                 'success' => "1"]);
                }
                 else{
                                $this->set_response([
                                'message'=>'Password does not match',       
                                 'success' => "0"]); 
                    } 

        }
        else{
           $this->set_response([
                                'message'=>'Record not found!',       
                                 'success' => "0"]); 
        }    
    }
    else{
        
       $this->set_response([
                            'message'=>'something are missing!',       
                             'success' => "0"]); 
    
    }
    
}

// Profile Update
public function profileUpdateM_post()
{
    $this->headers();
    $_REQUEST = json_decode(file_get_contents('php://input'), true);
    if(!empty($_REQUEST['user_uuid']))
    {
        $cond = "user_uuid='".$_REQUEST['user_uuid']."'";
        $Data = $this->Crud_model->get_single_with_cond('users_details',$cond);
        //print_r($Data);exit;
        if(!empty($Data))
        {

        if(!empty($_REQUEST['image'] && $_REQUEST['image_name']))
        {
            $image_name= $_REQUEST['image_name'];
            $image = $_REQUEST['image'];
            $acctual_path = $image_name;
            $path='media/uploads/'.$image_name;
            //print_r($path);exit;
            file_put_contents($path,base64_decode($image));
            $arrayName = array('profileimage_id'=>$acctual_path);
            $this->Crud_model->SaveData('users_details',$arrayName,"user_uuid='".$_REQUEST['user_uuid']."'");           
            $this->set_response(['message'=>'Profile Updated Successfully',       
                             'success' => "1"]);                
        }       
}
else {
    $this->set_response(['message'=>'Record not found',       
                             'success' => "0"]);
}
}
else {
    $this->set_response(['message'=>'something wrong!',       
                             'success' => "0"]);
}
}
public function profileUpdate_post()
{
    $this->headers();
    $_REQUEST = json_decode(file_get_contents('php://input'), true);
    if(!empty($_REQUEST['user_uuid']))
    {
        $cond = "user_uuid='".$_REQUEST['user_uuid']."'";
        $Data = $this->Crud_model->get_single_with_cond('users_details',$cond);
        //print_r($Data);exit;
        if(!empty($Data))
        {

        if(!empty($_REQUEST['image'] && $_REQUEST['image_name']))
        {
            $image_name= $_REQUEST['image_name'];
            $image = $_REQUEST['image'];
            $acctual_path = $image_name;
            $path='media/uploads/'.$image_name;
            //print_r($path);exit;
            file_put_contents($path,base64_decode($image));
            $arrayName = array('title'=>$_REQUEST['title'],'first_name'=>$_REQUEST['first_name'],'middle_name'=>$_REQUEST['middle_name'],'last_name'=>$_REQUEST['last_name'],'gender'=>$_REQUEST['gender'],'email'=>$_REQUEST['email'],'mobile_number'=>$_REQUEST['mobile_number'],'profession'=>$_REQUEST['profession'],'date_of_birth'=>$_REQUEST['date_of_birth'],'location_city'=>$_REQUEST['location'],'profileimage_id'=>$acctual_path,'about_us'=>$_REQUEST['about_us'],'orc_id'=>$_REQUEST['orc_id'],'license_detail'=>$_REQUEST['license_detail']);
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
            $this->set_response(['message'=>'Profile Updated Successfully',       
                             'success' => "1"]);
                
        }
        else {
                $arrayName = array('title'=>$_REQUEST['title'],'first_name'=>$_REQUEST['first_name'],'middle_name'=>$_REQUEST['middle_name'],'last_name'=>$_REQUEST['last_name'],'gender'=>$_REQUEST['gender'],'email'=>$_REQUEST['email'],'mobile_number'=>$_REQUEST['mobile_number'],'profession'=>$_REQUEST['profession'],'date_of_birth'=>$_REQUEST['date_of_birth'],'location_city'=>$_REQUEST['location'],'about_us'=>$_REQUEST['about_us'],'orc_id'=>$_REQUEST['orc_id'],'license_detail'=>$_REQUEST['license_detail']);
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
                $this->set_response(['message'=>'Profile Updated Successfully',       
                             'success' => "1"]);
        }
    }
    else {
        $this->set_response([
                            'message'=>'User ID already exist!',       
                             'success' => "0"]);
    }
    }
    else {
        $this->set_response([
                            'message'=>'something are missing!',       
                             'success' => "0"]);
    }
}

public function GetProfile_post()
{
    $this->headers();
    $_REQUEST = json_decode(file_get_contents('php://input'), true);
    if(!empty($_REQUEST['user_uuid']))
    {
        //print_r("expression");exit;
        $cond="u.user_uuid='".$_REQUEST['user_uuid']."'";
        $Jdata = $this->Crud_model->GetUserDetails($cond);
        if(empty($Jdata)) { 

        $cond="user_uuid='".$_REQUEST['user_uuid']."'";
        $data = $this->Crud_model->get_single_with_cond('users_details',$cond);
        $this->set_response(['user_detail'=>$data,'Followers'=>'0','message'=>'Record Fetched Successfully',       
                             'success' => "1"]);
        }
        else { 
             
        $cond="u.user_uuid='".$_REQUEST['user_uuid']."'";
        $Jdata = $this->Crud_model->GetUserDetails($cond);
       // print_r($Jdata);exit;
        $this->set_response(['user_detail'=>$Jdata,'Followers'=>'0','message'=>'Record Fetched Successfully',       
                             'success' => "1"]);
        }
    }
    else {
        $this->set_response([
                            'message'=>'something are missing!',       
                             'success' => "0"]);
    }
}
//Get Active Users
public function GetUsers_post()
{
     $this->headers();
    $_REQUEST = json_decode(file_get_contents('php://input'), true);
    $psunday = date('Y-m-d',strtotime('last sunday'));
    $present = date('Y-m-d');
    $cond="observation.date_time BETWEEN '".$psunday."' AND '".$present."' and users_details.status='Active'";
    $data = $this->Crud_model->GetActiveUser($cond);
    if(!empty($data))
    {
        $this->set_response(['data'=>$data,'message'=>'Record Fetched Successfully',       
                             'success' => "1"]);
    }
    else {
        $this->set_response([
                            'message'=>'Record not found',       
                             'success' => "0"]);
    }
}

// GetProfileDetails

public function GetProjectDetails_get()
{
    $this->headers();
    $_REQUEST = json_decode(file_get_contents('php://input'), true);
    $data = $this->Crud_model->GetProjectDetails();
    if(!empty($data))
    {
        $this->set_response(['data'=>$data,'message'=>'Record Fetched Successfully','success' => "1"]);   
    }
    else {
        $this->set_response(['message'=>'Record not found','success' => "0"]);
    }
}

// GetProjectMappings

public function GetProjectMapping_post()
{
    $this->headers();
    $_REQUEST = json_decode(file_get_contents('php://input'), true);
    if(!empty($_REQUEST['project_id']))
    {
        $data = $this->Crud_model->GetData('project_mapping','',"project_id='".$_REQUEST['project_id']."'");
        if(!empty($data))
        {
            $this->set_response(['data'=>$data,'message'=>'Record Fetched Successfully','success' => "1"]);   
        }
        else {
            $this->set_response(['message'=>'Record not found','success' => "0"]);
        }    
    }
    else {
        $this->set_response(['message'=>'something are missing','success' => "0"]);
    }    
}

// GetProjectColumns

public function GetProjectColumn_post()
{
    $this->headers();
    $_REQUEST = json_decode(file_get_contents('php://input'), true);
    if(!empty($_REQUEST['project_id']))
    {
        $data = $this->Crud_model->GetData('project_column','',"project_id='".$_REQUEST['project_id']."'");
        if(!empty($data))
        {
            $this->set_response(['data'=>$data,'message'=>'Record Fetched Successfully','success' => "1"]);   
        }
        else {
            $this->set_response(['message'=>'Record not found','success' => "0"]);
        }    
    }
    else {
        $this->set_response(['message'=>'something are missing','success' => "0"]);
    }    
}

//Get MappingColumn

public function GetMappingColumn_post()
{
    $this->headers();
    $_REQUEST = json_decode(file_get_contents('php://input'), true);
    if(!empty($_REQUEST['project_id']))
    {
        $cond="pm.project_id='".$_REQUEST['project_id']."'";
        $data = $this->Crud_model->GetMappingColumnM($cond);
        if(!empty($data))
        {
            $this->set_response(['data'=>$data,'message'=>'Record Fetched Successfully','success' => "1"]);   
        }
        else {
            $this->set_response(['message'=>'Record not found','success' => "0"]);
        }    
    }
    else {
        $this->set_response(['message'=>'something are missing','success' => "0"]);
    }    
}

//CreateBlog

public function CreateBlog_post()
{
    $this->headers();
    $_REQUEST = json_decode(file_get_contents('php://input'), true);
    if(!empty($_REQUEST['user_uuid']))
    {
        $arrayData = array('blog_title' => $_REQUEST['title'],'blog_body'=>$_REQUEST['body'],'blog_is_question'=>$_REQUEST['question'],'blog_post_by'=>$_REQUEST['user_uuid'],'blog_post_timestamp'=> date('Y-m-d H:i:s'),'is_blog_public'=>'Unpublish');
        $this->Crud_model->SaveData('blogs',$arrayData);
        $this->set_response(['message'=>'Record Created Successfully','success' => "1"]);            
    }
    else {
        $this->set_response(['message'=>'something are missing','success' => "0"]);
    }
}

//GetBlog

public function GetBlog_post()
{
    $this->headers();
        $data = $this->Crud_model->GetBlogData('blogs','blogpost_id,blog_title as title,blog_body as body,blog_is_question as question,blog_post_timestamp as timestamp,is_blog_public as public');
        if(!empty($data))
        {
            $this->set_response(['data'=>$data,'message'=>'Record Fetched Successfully','success' => "1"]);   
        }
        else {
            $this->set_response(['message'=>'Record not found','success' => "0"]);
        }    
        
}
// Create Blog Reply

public function CreateBlogReply_post()
{
    $this->headers();
    $_REQUEST = json_decode(file_get_contents('php://input'), true);
    if(!empty($_REQUEST['user_uuid'] && $_REQUEST['blogpost_id']))
    {
        $arrayData = array('reply_post_id' => $_REQUEST['blogpost_id'],'user_id'=>$_REQUEST['user_uuid'],'blog_answer_body'=>$_REQUEST['answer'],'reply_timestamp'=> date('Y-m-d H:i:s'));
        $this->Crud_model->SaveData('blog_replies',$arrayData);
        $this->set_response(['message'=>'Record Created Successfully','success' => "1"]);            
    }
    else {
        $this->set_response(['message'=>'something are missing','success' => "0"]);
    }
}

//Get BlogReply Data

public function GetBlogReply_post()
{
    $this->headers();
        $data = $this->Crud_model->GetBlogReplyDetails();
        if(!empty($data))
        {
            $this->set_response(['data'=>$data,'message'=>'Record Fetched Successfully','success' => "1"]);   
        }
        else {
            $this->set_response(['message'=>'Record not found','success' => "0"]);
        }    
        
}

// Create ReplyResourse

public function CreateReplyResourse_post()
{
    $this->headers();
    $_REQUEST = json_decode(file_get_contents('php://input'), true);
    if(!empty($_REQUEST['user_uuid'] && $_REQUEST['reply_id']))
    {
        $arrayData = array('blog_resources_reply_id' => $_REQUEST['reply_id'],'blog_resources_reply_user_uuid'=>$_REQUEST['user_uuid'],'blog_resources_resource_url'=>$_REQUEST['resourse_url'],'blog_resources_resource_comment'=> $_REQUEST['resource_comment']);
        $this->Crud_model->SaveData('blog_resources',$arrayData);
        $this->set_response(['message'=>'Record Created Successfully','success' => "1"]);            
    }
    else {
        $this->set_response(['message'=>'something are missing','success' => "0"]);
    }
}

//Get ReplyResourse

public function GetReplyResourse_get()
{
    $this->headers();
    if(!empty($_REQUEST['user_uuid'] && $_REQUEST['reply_id']))
    {
        $cond="u.user_uuid='".$_REQUEST['user_uuid']."' and rr.blog_resources_reply_id='".$_REQUEST['reply_id']."'";
        $data = $this->Crud_model->GetReplyResourseDetails($cond);
        if(!empty($data))
        {
            $this->set_response(['data'=>$data,'message'=>'Record Fetched Successfully','success' => "1"]);   
        }
        else {
            $this->set_response(['message'=>'Record not found','success' => "0"]);
        }
    }
    else {
        $this->set_response(['message'=>'something are missing','success' => "0"]);
    }  
        
}

// Create Discussion Forum

public function CreateDiscusionForum_post()
{
    $this->headers();
    $_REQUEST = json_decode(file_get_contents('php://input'), true);
    if(!empty($_REQUEST['user_uuid']))
    {
        $arrayData = array('text_msg' => $_REQUEST['text_msg'],'created_by'=>$_REQUEST['user_uuid'],'subject'=>$_REQUEST['subject'],'like_no'=> $_REQUEST['like_no'],'date_time'=> date('Y-m-d H:i:s'),'is_deleted'=>'No');
        $this->Crud_model->SaveData('discussions',$arrayData);
        $this->set_response(['message'=>'Record Created Successfully','success' => "1"]);            
    }
    else {
        $this->set_response(['message'=>'something are missing','success' => "0"]);
    }
}

// Get Discussion Forum

public function GetDiscussionForum_post()
{
    $this->headers();
    
        $data = $this->Crud_model->GetDiscussionForumDetails();
        if(!empty($data))
        {
            $this->set_response(['data'=>$data,'message'=>'Record Fetched Successfully','success' => "1"]);   
        }
        else {
            $this->set_response(['message'=>'Record not found','success' => "0"]);
        }
        
}

// Create Discussion Forum

public function CreateDiscusionForumRes_post()
{
    $this->headers();
    $_REQUEST = json_decode(file_get_contents('php://input'), true);
    if(!empty($_REQUEST['user_uuid'] && $_REQUEST['forum_id']))
    {
        $arrayData = array('discussion_foroum_id' => $_REQUEST['forum_id'],'created_by'=>$_REQUEST['user_uuid'],'respondor_userid'=>$_REQUEST['user_uuid'],'text_msg'=> $_REQUEST['text_msg'],'datetime'=> date('Y-m-d H:i:s'),'like_no'=>$_REQUEST['like_no']);
        $this->Crud_model->SaveData('discussion_responses',$arrayData);
        $this->set_response(['message'=>'Record Created Successfully','success' => "1"]);            
    }
    else {
        $this->set_response(['message'=>'something are missing','success' => "0"]);
    }
}

// Get Discussion Forum Response

public function GetDiscussionForumR_post()
{
    $this->headers();
    
        $data = $this->Crud_model->GetDiscussionForumRDetails();
        if(!empty($data))
        {
            $this->set_response(['data'=>$data,'message'=>'Record Fetched Successfully','success' => "1"]);   
        }
        else {
            $this->set_response(['message'=>'Record not found','success' => "0"]);
        }        
}

// Create Like

public function CreateLike_post()
{
    $this->headers();
    $_REQUEST = json_decode(file_get_contents('php://input'), true);
    if(!empty($_REQUEST['user_uuid'] && $_REQUEST['reply_id']))
    {
        $arrayData = array('user_id'=>$_REQUEST['user_uuid'],'reply_id'=>$_REQUEST['reply_id'],'like_timestamp'=> date('Y-m-d H:i:s'));
        $this->Crud_model->SaveData('likes',$arrayData);
        $this->set_response(['message'=>'Record Created Successfully','success' => "1"]);            
    }
    else {
        $this->set_response(['message'=>'something are missing','success' => "0"]);
    }
}

// Create Tags
public function CreateTag_post()
{
    $this->headers();
    $_REQUEST = json_decode(file_get_contents('php://input'), true);
    if(!empty($_REQUEST['post_id']))
    {
        $arrayData = array('post_id'=>$_REQUEST['post_id'],'name'=>$_REQUEST['name']);
        $this->Crud_model->SaveData('tags',$arrayData);
        $this->set_response(['message'=>'Record Created Successfully','success' => "1"]);            
    }
    else {
        $this->set_response(['message'=>'something are missing','success' => "0"]);
    }
}

public function GetFaqs_post()
{
    //print_r("dfsd");exit;
    $this->headers();
        $data = $this->Crud_model->GetData('faqs','question,answer');
        if(!empty($data))
        {
            $this->set_response(['data'=>$data,'message'=>'Record Fetched Successfully','success' => "1"]);   
        }
        else {
            $this->set_response(['message'=>'Record not found','success' => "0"]);
        }        
}
public function GetSetting_post()
{
    //print_r("dfsd");exit;
    $this->headers();
    $_REQUEST = json_decode(file_get_contents('php://input'), true);
    $cond="slug_tiltle='".$_REQUEST['slug_title']."'";
        $data = $this->Crud_model->GetData('settings','setting_title as title,setting_desc as desc',$cond,'','','','1');
        if(!empty($data))
        {
            $this->set_response(['title' => $data->title,'desc'=> $data->desc,'message'=>'Record Fetched Successfully','success' => "1"]);   
        }
        else {
            $this->set_response(['message'=>'Record not found','success' => "0"]);
        }        
}
public function teams_post()
{
    $this->headers();
    $_REQUEST = json_decode(file_get_contents('php://input'), true);
    $Data = $this->Crud_model->GetData('team_details', '','', '', '', '', '');
    if(!empty($Data))
    {
        $this->set_response(['data' => $Data,'message'=>'Record Feched Successfully',       
                             'success' => "1"]);
    }
    else {
        $this->set_response([
                            'message'=>'something are missing!',       
                             'success' => "0"]);
    }

}
// Add Project Image
public function projectImage_post()
{
    $this->headers();
    $_REQUEST = json_decode(file_get_contents('php://input'), true);    
        if(!empty($_REQUEST['image'] && $_REQUEST['image_name']))
        {
            $image_name= $_REQUEST['image_name'];
            $image = $_REQUEST['image'];
            $acctual_path = $image_name;
            $path='media/uploads/project/'.$image_name;
            file_put_contents($path,base64_decode($image));
            $arrayName = array('latlon'=>$_REQUEST['latlon'],'image_path'=>$acctual_path,'project_id'=>$_REQUEST['project_id']);
            $this->Crud_model->SaveData('project_values',$arrayName);           
            $this->set_response(['message'=>'project insert Successfully',       
                             'success' => "1"]);                
        }       
}
public function blogImage_post()
{
    $this->headers();
    $_REQUEST = json_decode(file_get_contents('php://input'), true);    
        if(!empty($_REQUEST['image'] && $_REQUEST['image_name']))
        {
            $image_name= $_REQUEST['image_name'];
            $image = $_REQUEST['image'];
            $acctual_path = $image_name;
            $path='media/uploads/blog/'.$image_name;
            file_put_contents($path,base64_decode($image));
            $arrayName = array('image_path'=>$acctual_path,'blog_id'=>$_REQUEST['blog_id']);
            $this->Crud_model->SaveData('blog_images',$arrayName);           
            $this->set_response(['message'=>'blog image insert Successfully',       
                             'success' => "1"]);                
        }       
}

public function searchSpeciesCommonName_post()
{
        //print_r($_REQUEST);exit;
        $data =  array("keyword" => $_REQUEST['keyword']);
         $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => NODE_URL.'/searchSpeciesCommonName',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
      echo $response =  curl_exec($curl);
      //print_r($response);exit;
      //echo $result = json_decode($response);
       //print_r($response);exit;
}

public function searchSpecies_post()
{
        $this->headers();
        $_REQUEST = json_decode(file_get_contents('php://input'), true);
        //print_r($_REQUEST);exit;
        $data =  array("keyword" => $_REQUEST['keyword']);
         $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => NODE_URL.'/searchSpecies',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
      echo $response =  curl_exec($curl);
     
}

public function getObservations_post()
{
        //3857
        $this->headers();
        $_REQUEST = json_decode(file_get_contents('php://input'), true);
        $data =  array("user_id" => $_REQUEST['user_id'],"checkListId"=>$_REQUEST['checkListId'],"srs"=>$_REQUEST['srs']);
         $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => NODE_URL.'/getObservations',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
      echo $response =  curl_exec($curl);
}

public function getObservationsForChecklist_post()
{
        //3857
        $this->headers();
        $_REQUEST = json_decode(file_get_contents('php://input'), true);
        $data =  array("user_id" => $_REQUEST['user_id'],"checklist_id"=>$_REQUEST['checklist_id'],"srs"=>$_REQUEST['srs']);
         $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => NODE_URL.'/getObservationsForChecklist',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
      echo $response =  curl_exec($curl);
}

public function getCountries_post()
{
        $this->headers();
        $_REQUEST = json_decode(file_get_contents('php://input'), true);
        //print_r($_REQUEST);exit;
        $data =  array("srs"=>$_REQUEST['srs']);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => NODE_URL.'/getCountries',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
      echo $response =  curl_exec($curl);
     
}

public function getStates_post()
{
        $this->headers();
        $_REQUEST = json_decode(file_get_contents('php://input'), true);
        //print_r($_REQUEST);exit;
        $data =  array("srs"=>$_REQUEST['srs']);
         $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => NODE_URL.'/getStates',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
      echo $response =  curl_exec($curl);
     
}

public function getDistricts_post()
{
        $this->headers();
        $_REQUEST = json_decode(file_get_contents('php://input'), true);
        //print_r($_REQUEST);exit;
        $data =  array("srs"=>$_REQUEST['srs'],"state_id"=>$_REQUEST['state_id']);
         $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => NODE_URL.'/getDistricts',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
      echo $response =  curl_exec($curl);
     
}

public function getSubDistricts_post()
{
        $this->headers();
        $_REQUEST = json_decode(file_get_contents('php://input'), true);
        //print_r($_REQUEST);exit;
        $data =  array("srs"=>$_REQUEST['srs'],"district_id"=>$_REQUEST['district_id']);
         $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => NODE_URL.'/getSubDistricts',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
      echo $response =  curl_exec($curl);
     
}

public function getBlocks_post()
{
        $this->headers();
        $_REQUEST = json_decode(file_get_contents('php://input'), true);
        //print_r($_REQUEST);exit;
        $data =  array("srs"=>$_REQUEST['srs'],"district_id"=>$_REQUEST['district_id']);
         $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => NODE_URL.'/getBlocks',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
      echo $response =  curl_exec($curl);
     
}

public function getUploadedDataSessions_post()
{
        $this->headers();
        $_REQUEST = json_decode(file_get_contents('php://input'), true);
        $data =  array("userId"=>$_REQUEST['userId']);
         $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => NODE_URL.'/getUploadedDataSessions',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
      echo $response =  curl_exec($curl);
     
}

public function deleteUploadedDataSession_post()
{
        $this->headers();
        $_REQUEST = json_decode(file_get_contents('php://input'), true);
        $data =  array("userId"=>$_REQUEST['userId'],"sessionId"=>$_REQUEST['sessionId']);
         $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => NODE_URL.'/deleteUploadedDataSession',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
      echo $response =  curl_exec($curl);
     
}

public function searchSpeciesBiome_post()
{
        $this->headers();
        $_REQUEST = json_decode(file_get_contents('php://input'), true);
        //print_r($_REQUEST);exit;
        $data =  array("speciesName"=>$_REQUEST['speciesName'],"srs"=>$_REQUEST['srs']);
         $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => NODE_URL.'/searchSpeciesBiome',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
      echo $response =  curl_exec($curl);
     
}

public function getSpeciesDynamicCitation_post()
{
        $this->headers();
        $_REQUEST = json_decode(file_get_contents('php://input'), true);
        //print_r($_REQUEST);exit;
        $data =  array("speciesName"=>$_REQUEST['speciesName']);
         $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => NODE_URL.'/getspeciescitation',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
      echo $response =  curl_exec($curl);
     
}

public function getSpeciesLocation_post()
{
    //4326
    //3857
        $this->headers();
        $_REQUEST = json_decode(file_get_contents('php://input'), true);
        //print_r($_REQUEST);exit;
        $data =  array("scientificName"=>$_REQUEST['scientificName'],"srs"=>$_REQUEST['srs'],"geometrysrs"=>$_REQUEST['geometrysrs'],"geometry"=>$_REQUEST['geometry'],"geometrytype"=>$_REQUEST['geometrytype']);
         $curl = curl_init();
         curl_setopt_array($curl, array(
            CURLOPT_URL => NODE_URL.'/getSpeciesLocation',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
      echo $response =  curl_exec($curl);
     
}
public function getBoundaryGeometry_post()
{
        $this->headers();
        $_REQUEST = json_decode(file_get_contents('php://input'), true);
        //print_r($_REQUEST);exit;
        $data =  array("region_id"=>$_REQUEST['region_id']);
         $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => NODE_URL.'/getBoundaryGeometry',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
      echo $response =  curl_exec($curl);
     
}

public function getDataPlaygroundDatasets_post()
{
        $this->headers();
        $_REQUEST = json_decode(file_get_contents('php://input'), true);
        //print_r($_REQUEST);exit;
        $data =  array("srs"=>$_REQUEST['srs']);
         $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => NODE_URL.'/getDataPlaygroundDatasets',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
      echo $response =  curl_exec($curl);
     
}

public function getPlaygroundSharableLink_post()
{
        $this->headers();
        $_REQUEST = json_decode(file_get_contents('php://input'), true);
        //print_r($_REQUEST);exit;
        $data = array("scientificName"=>$_REQUEST['scientificName'], "commonName"=>$_REQUEST['commonName'], "speciesData"=>$_REQUEST['speciesData']);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => NODE_URL.'/getPlaygroundSharableLink',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
      echo $response =  curl_exec($curl);
     
}

public function getSharedDataset_post()
{
        $this->headers();
        $_REQUEST = json_decode(file_get_contents('php://input'), true);
        //print_r($_REQUEST);exit;
        $data =  array("" =>'');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => NODE_URL.'/getSharedDataset?shareid='.$_REQUEST['shareid'],
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
      echo $response =  curl_exec($curl);
     
}

public function downloadDataset_post()
{
        $this->headers();
        $_REQUEST = json_decode(file_get_contents('php://input'), true);
        //print_r($_REQUEST);exit;
        $data = array("scientificName"=>$_REQUEST['scientificName']);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => NODE_URL.'/downloadDataset',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
      echo $response =  curl_exec($curl);
     
}

public function searchSpeciesBasedOnDatasets_post()
{
        $this->headers();
        $_REQUEST = json_decode(file_get_contents('php://input'), true);
        //print_r($_REQUEST);exit;
        $data =  array("keyword"=>$_REQUEST['keyword']);
         $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => NODE_URL.'/searchSpeciesBasedOnDatasets',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
      echo $response =  curl_exec($curl);
     
}

public function getSpeciesObservationDetails_post()
{
        $this->headers();
        $_REQUEST = json_decode(file_get_contents('php://input'), true);
        //print_r($_REQUEST);exit;
        $data =  array("observation_id"=>$_REQUEST['observation_id']);
         $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => NODE_URL.'/getSpeciesObservationDetails',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
      echo $response =  curl_exec($curl);
     
}

public function runSpatialQuery_post()
{
        $this->headers();
        $_REQUEST = json_decode(file_get_contents('php://input'), true);
        //print_r($_REQUEST);exit;
        $data =  array("sourceLayer"=>$_REQUEST['sourceLayer'],"sourceLayerBuffer"=>$_REQUEST['sourceLayerBuffer'],"sourceLayerBufferUnits"=>$_REQUEST['sourceLayerBufferUnits'],"sourceLayerAttributes"=>$_REQUEST['sourceLayerAttributes'],"target"=>$_REQUEST['target'],"srs"=>$_REQUEST['srs']);
         $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => NODE_URL.'/runSpatialQuery',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
      echo $response =  curl_exec($curl);
     
}
public function getSpatialLayers_get()
{
        $url = NODE_URL.'/getSpatialLayers';
       $dd =  file_get_contents($url);
      echo $response = $dd;
     
}
public function getSpatialLayerColumns_post()
{
        $this->headers();
        $_REQUEST = json_decode(file_get_contents('php://input'), true);
        
        $data =  array("table_name"=>$_REQUEST['table_name']);
         $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => NODE_URL.'/getSpatialLayerColumns',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
      echo $response =  curl_exec($curl);
     
}
public function getMatchingColumnValues_post()
{
        $this->headers();
        $_REQUEST = json_decode(file_get_contents('php://input'), true);
        //print_r($_REQUEST);exit;
        $data =  array("table"=>$_REQUEST['table'],"column"=>$_REQUEST['column'],"keyword"=>$_REQUEST['keyword']);
         $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => NODE_URL.'/getMatchingColumnValues',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
      echo $response =  curl_exec($curl);
     
}
public function getUserProfileStatistics_post()
{
        $this->headers();
        $_REQUEST = json_decode(file_get_contents('php://input'), true);
        //print_r($_REQUEST);exit;
        $data =  array("user_id"=>$_REQUEST['user_id']);
         $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => NODE_URL.'/getUserProfileStatistics',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
      echo $response =  curl_exec($curl);
     
}
public function getTotalObservations_post()
{
        $this->headers();
        $_REQUEST = json_decode(file_get_contents('php://input'), true);
        //print_r($_REQUEST);exit;
        $data =  array("user_id"=>$_REQUEST['user_id'],"srs"=>$_REQUEST['srs']);
         $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => NODE_URL.'/getTotalObservations',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
      echo $response =  curl_exec($curl);
     
}

public function getObservationDetails_post()
{
        $this->headers();
        $_REQUEST = json_decode(file_get_contents('php://input'), true);
        //print_r($_REQUEST);exit;
        $data =  array("observationId"=>$_REQUEST['observationId']);
         $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => NODE_URL.'/getObservationDetails',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
      echo $response =  curl_exec($curl);
     
}

public function addCheckList_post()
{
        $this->headers();
        $_REQUEST = json_decode(file_get_contents('php://input'), true);
        $data =  array("name"=>$_REQUEST['name'],"description"=>$_REQUEST['description'],"start_timestamp"=>$_REQUEST['start_timestamp'],"end_timestamp"=>$_REQUEST['end_timestamp'],"time_spent"=>$_REQUEST['time_spent'],"travelled_distance"=>$_REQUEST['travelled_distance'],"observation_type"=>$_REQUEST['observation_type'],"latitude"=>$_REQUEST['latitude'],"longitude"=>$_REQUEST['longitude'],"user_id"=>$_REQUEST['user_id'],"party_count"=>$_REQUEST['party_count']);
       // print_r($data);exit;
         $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => NODE_URL.'/addCheckList',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
      echo $response =  curl_exec($curl);
     
}

public function getLocationsForDataset_post()
{
        $this->headers();
        $_REQUEST = json_decode(file_get_contents('php://input'), true);
        //print_r($_REQUEST);exit;
        $data =  array("datasetId"=>$_REQUEST['datasetId'],"srs"=>$_REQUEST['srs']);
         $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => NODE_URL.'/getLocationsForDataset',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
      echo $response =  curl_exec($curl);
     
}

public function addObservationNewM_post()
{
    $this->headers();
    $_REQUEST = json_decode(file_get_contents('php://input'), true);
    if(!empty($_REQUEST['addObservationFileUpload']))
    {
        $addObservationFileUpload = $_REQUEST['addObservationFileUpload'];
        $image_name = date('Y-m-d').'png';
    }
    else {
        $addObservationFileUpload = "";
        $image_name ="";
    }
    

    $arrayData = array("addObservationCheckListId"=>$_REQUEST['addObservationCheckListId'],"addObservationCheckListName"=>$_REQUEST['addObservationCheckListName'],"addObservationUserId"=>$_REQUEST['addObservationUserId'],"addObservationTaxonID"=>$_REQUEST['addObservationTaxonID'],"addObservationSpeciesName"=>$_REQUEST['addObservationSpeciesName'],"addObservationMaleCount"=>$_REQUEST['addObservationMaleCount'],"addObservationFemaleCount"=>$_REQUEST['addObservationFemaleCount'],"addObservationChildCount"=>$_REQUEST['addObservationChildCount'],'addObservationFileUpload'=>$addObservationFileUpload,'image_name'=>$image_name,"addObservationIndividualCount"=>$_REQUEST['addObservationIndividualCount'],"addObservationSex"=>'',"addObservationLifeStage"=>'',"addObservationReproductiveCondition"=>'',"addObservationBehaviour"=>$_REQUEST['addObservationBehaviour'],"addObservationRemarks"=>$_REQUEST['addObservationRemarks'],"addObservationHabitat"=>$_REQUEST['addObservationHabitat'],"addObservationMessage"=>$_REQUEST['addObservationMessage'],"addObservationProtocol"=>'',"addObservationGeoprivacy"=>$_REQUEST['addObservationGeoprivacy'],'addObservationLatitude'=>$_REQUEST['addObservationLatitude'],'addObservationLongitude'=>$_REQUEST['addObservationLongitude'],"identification_required"=>$_REQUEST['identification_required']);
    //print_r(json_encode($arrayData));exit;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => NODE_URL.'/addObservationNew',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($arrayData),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
       $response =  curl_exec($curl);
       if(!empty($response))
       {
            //$this->set_response(['success' => "1",'response'=>$_REQUEST],'files'=>$_FILES);
            $this->set_response(['success' => "1"]); 
       }
       else {
        $this->set_response(['success' => "0"]);
       }    
}
public function addObservationNew_post()
{
    $this->headers();
    if(!empty($_FILES['addObservationFileUpload']['tmp_name'])) 
    {
        $image = base64_encode(file_get_contents($_FILES['addObservationFileUpload']['tmp_name']));
        $image_name = str_replace(" ","_", $_FILES['addObservationFileUpload']['name']);    
    }
    else {
        $image ="";
        $image_name = "";   
    }  
if(!empty($_REQUEST['addObservationMaleCount']))
{
    $maleCount = $_REQUEST['addObservationMaleCount'];
}
else {
    $maleCount = 0;
}
if(!empty($_REQUEST['addObservationFemaleCount']))
{
    $fCount = $_REQUEST['addObservationFemaleCount'];
}
else {
    $fCount = 0;
}
if(!empty($_REQUEST['addObservationChildCount']))
{
    $cCount = $_REQUEST['addObservationChildCount'];
}
else {
    $cCount = 0;
}
    $arrayData = array("addObservationCheckListId"=>$_REQUEST['addObservationCheckListId'],"addObservationCheckListName"=>$_REQUEST['addObservationCheckListName'],"addObservationUserId"=>$_REQUEST['addObservationUserId'],"addObservationTaxonID"=>$_REQUEST['addObservationTaxonID'],"addObservationSpeciesName"=>$_REQUEST['addObservationSpeciesName'],"addObservationMaleCount"=>$maleCount,"addObservationFemaleCount"=>$fCount,"addObservationChildCount"=>$cCount,'addObservationFileUpload'=>$image,'image_name'=>$image_name,"addObservationIndividualCount"=>$_REQUEST['addObservationIndividualCount'],"addObservationSex"=>'',"addObservationLifeStage"=>'',"addObservationReproductiveCondition"=>'',"addObservationBehaviour"=>$_REQUEST['addObservationBehaviour'],"addObservationRemarks"=>$_REQUEST['addObservationRemarks'],"addObservationHabitat"=>$_REQUEST['addObservationHabitat'],"addObservationMessage"=>$_REQUEST['addObservationMessage'],"addObservationProtocol"=>'',"addObservationGeoprivacy"=>$_REQUEST['addObservationGeoprivacy'],'addObservationLatitude'=>$_REQUEST['addObservationLatitude'],'addObservationLongitude'=>$_REQUEST['addObservationLongitude'],"identification_required"=>$_REQUEST['identification_required'],"addObservationDynamicProperties"=>'');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => NODE_URL.'/addObservationNew',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($arrayData),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
       $response =  curl_exec($curl);
       if(!empty($response))
       {
            //$this->set_response(['success' => "1",'response'=>$_REQUEST],'files'=>$_FILES);
            $this->set_response(['success' => "1"]); 
       }
       else {
        $this->set_response(['success' => "0"]);
       }    
}
public function uploadShapeFile_post()
{
    $this->headers();
    $image = base64_encode(file_get_contents($_FILES['shapeFileInput']['tmp_name']));
    $image_name = str_replace(" ","_", $_FILES['shapeFileInput']['name']);
    $arrayData = array("shapeFileInput"=>$image,"shapeFileName"=>$image_name);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => NODE_URL.'/uploadShapeFile',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($arrayData),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
       echo $response =  curl_exec($curl);    
}
public function uploadGeoJSON_post()
{
    $this->headers();
    $image = base64_encode(file_get_contents($_FILES['geojsonFileInput']['tmp_name']));
    $image_name = str_replace(" ","_", $_FILES['geojsonFileInput']['name']);
    $arrayData = array("geojsonFileInput"=>$image,"geojsonFileName"=>$image_name);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => NODE_URL.'/uploadGeoJSON',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($arrayData),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
       echo $response =  curl_exec($curl);    
}

public function uploadKML_post()
{
    $this->headers();
    $image = base64_encode(file_get_contents($_FILES['kmlFileInput']['tmp_name']));
    $image_name = str_replace(" ","_", $_FILES['kmlFileInput']['name']);
    $arrayData = array("kmlFileInput"=>$image,"kmlFileFileName"=>$image_name);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => NODE_URL.'/uploadKML',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($arrayData),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
       echo $response =  curl_exec($curl);    
}
public function uploadDataExcel_post()
{
    $this->headers();
    $image = base64_encode(file_get_contents($_FILES['uploadDataFormFileUpload']['tmp_name']));
    $image_name = str_replace(" ","_", $_FILES['uploadDataFormFileUpload']['name']);
    $arrayData = array("uploadDataFormFileUpload"=>$image,"uploadDataFormFileUploadName"=>$image_name);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => NODE_URL.'/uploadDataExcel',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($arrayData),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            )));
       echo $response =  curl_exec($curl);    
}
/*
public function uploadZippedImages_post()
{
    $this->headers();
    $image = base64_encode(file_get_contents($_FILES['uploadImageFormFileUpload']['tmp_name']));
    $image_name = str_replace(" ","_", $_FILES['uploadImageFormFileUpload']['name']);
    $arrayData = array("uploadImageFormFileUpload"=>$image,"uploadImageFormFileUploadName"=>$image_name, "imageColumnName"=>$_REQUEST['imageColumnName'], "importExcelId"=>$_REQUEST['importExcelId']);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => NODE_URL.'/uploadZippedImages',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($arrayData),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            )));
       echo $response =  curl_exec($curl);    
}
*/

public function uploadData_post()
{
    $this->headers();
    if($_FILES['uploadImageFormFileUpload']['name'])
            {
                $config['upload_path']      = 'media/datauploadtemp/';
                $config['allowed_types']    = 'zip';
                $config['encrypt_name'] = TRUE;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
     //print_r($config['upload_path']);exit;          
    if ($this->upload->do_upload('uploadImageFormFileUpload'))
    {
        $img = $this->upload->data();
        $arrayData = array("uploadImageFormFileUpload"=>$img['file_name'], "imageColumnName"=>$_REQUEST['imageColumnName'], "importExcelId"=>$_REQUEST['importExcelId'], "dataUploadUserId"=>$_REQUEST['dataUploadUserId'], "dataUploadColumns"=>$_REQUEST['dataUploadColumns']);
   // print_r($arrayData);exit;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => NODE_URL.'/uploadData',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($arrayData),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            )));
       echo $response =  curl_exec($curl); 
    }
    else {
        $this->set_response(['success' => "0"],'something went wrong!'); 
    }
}
       
}
public function getTotalStatistics_post()
{
    $this->headers();
    $_REQUEST = json_decode(file_get_contents('php://input'), true);
    //print_r($_REQUEST['srs']);exit;
    $arrayData = array("srs" => $_REQUEST['srs']);
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
            CURLOPT_POSTFIELDS => json_encode($arrayData),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            )));
       echo $response =  curl_exec($curl);    
}
public function travel_tracks_post()
{
    $this->headers();
    $_REQUEST = json_decode(file_get_contents('php://input'), true);
    if(!empty($_REQUEST['checklist_uuid'] && $_REQUEST['user_uuid'] && $_REQUEST['latitude'] && $_REQUEST['longitude']))
    {
        $arrayData = array("checklist_uuid" => $_REQUEST['checklist_uuid'],"user_uuid"=>$_REQUEST['user_uuid'],"latitude"=>$_REQUEST['latitude'],"longitude"=>$_REQUEST['longitude']);
        $this->Crud_model->SaveData('travel_tracks',$arrayData);           
        $this->set_response(['message'=>'Record insert Successfully',       
                                 'success' => "1"]);
    }
    else
    {
        $this->set_response(['message'=>'something are wrong!',       
                                 'success' => "0"]);
    }           
}
public function getChecklists_post()
{
    $this->headers();
    $_REQUEST = json_decode(file_get_contents('php://input'), true);
    if(!empty($_REQUEST['user_id']))
    {
        $arrayData = array("srs" => $_REQUEST['srs'],"user_id"=>$_REQUEST['user_id']);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => NODE_URL.'/getChecklists',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($arrayData),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            )));
       echo  $response =  curl_exec($curl);
        //$this->set_response(['getChecklist'=>$response,       
                            //     'success' => "1"]);
    }
    else
    {
        $this->set_response(['message'=>'something are wrong!',       
                                 'success' => "0"]);
    }           
}
public function getChecklistsAdv_post()
{
    $this->headers();
    $_REQUEST = json_decode(file_get_contents('php://input'), true);
    if(!empty($_REQUEST['user_id']))
    {
        $arrayData = array("srs" => $_REQUEST['srs'],"user_id"=>$_REQUEST['user_id']);
        $cond="created_by='".$_REQUEST['user_id']."' and project_id IS NULL";
        $getData = $this->Crud_model->GetData('checklist','',$cond);
        $aDDData = [];
        foreach($getData as $getDataRow)
        {
            $getOData = $this->Crud_model->GetData('observation','observation_id',"checklist_id='".$getDataRow->checklist_id."'",'','','','1');
            if(!empty($getOData))
            {
                $getcIMGData = $this->Crud_model->GetData('record_level','file_uri',"observation_id='".$getOData->observation_id."' and type IS NULL",'','','','1');
                $ccImage = $getcIMGData->file_uri;
                //print_r($this->db->last_query());
                $aDDData[] = array('sp_checklist_id' => $getDataRow->checklist_id,'sp_name'=>$getDataRow->checklist_name,'sp_count'=>$getDataRow->observation_count,'sp_party_count'=>$getDataRow->party_count,'sp_description'=>$getDataRow->description,'sp_travelled_distance'=>$getDataRow->travelled_distance,'sp_observation_type'=>$getDataRow->observation_type,'file_uri'=>$ccImage,'sp_start_datetime'=>$getDataRow->start_datetime,'end_datetime'=>$getDataRow->end_datetime);
                //print_r($ccImage);
            }
            else {
                $ccImage = 'No';
                $aDDData[] = array('sp_checklist_id' => $getDataRow->checklist_id,'sp_name'=>$getDataRow->checklist_name,'sp_count'=>$getDataRow->observation_count,'sp_party_count'=>$getDataRow->party_count,'sp_description'=>$getDataRow->description,'sp_travelled_distance'=>$getDataRow->travelled_distance,'sp_observation_type'=>$getDataRow->observation_type,'file_uri'=>$ccImage,'sp_start_datetime'=>$getDataRow->start_datetime,'end_datetime'=>$getDataRow->end_datetime);
            }
        }
        //print_r($ccImage);
        $this->set_response(['getChecklist'=>$aDDData,'success' => "1"]);
    }
    else
    {
        $this->set_response(['message'=>'something are wrong!',       
                                 'success' => "0"]);
    }           
}
public function ForDistrict_post()
{
    $this->headers();
    $_REQUEST = json_decode(file_get_contents('php://input'), true);
    $curl = curl_init();
    $data =  array("" =>'');
    $url = NODE_URL.'/getSpeciesSourceListBasedOnBoundary?region_id='.$_REQUEST['region_id'].'&boundarytype=district';
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
       echo $response = curl_exec($curl);
}
public function ForState_post()
{
    $curl = curl_init();
    $data =  array("" => '');
     $this->headers();
    $_REQUEST = json_decode(file_get_contents('php://input'), true);
    $url = NODE_URL.'/getSpeciesSourceListBasedOnBoundary?region_id='.$_REQUEST['region_id'].'&boundarytype=state';
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
       echo $response = curl_exec($curl);
}
public function getDistinctSpeciesInBuffer_post()
{
    $this->headers();
    $_REQUEST = json_decode(file_get_contents('php://input'), true);
    if(!empty($_REQUEST['srs']))
    {
        $arrayData = array("srs" => $_REQUEST['srs'],"buffer" => $_REQUEST['buffer'],"latitude"=>$_REQUEST['latitude'],"longitude"=>$_REQUEST['longitude']);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => NODE_URL.'/getDistinctSpeciesInBuffer',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($arrayData),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            )));
       echo  $response =  curl_exec($curl);
        //$this->set_response(['getChecklist'=>$response,       
                            //     'success' => "1"]);
    }
    else
    {
        $this->set_response(['message'=>'something are wrong!',       
                                 'success' => "0"]);
    }           
}
public function getDistinctSpeciesInBufferWithImages_post()
{
    $this->headers();
    $_REQUEST = json_decode(file_get_contents('php://input'), true);
    if(!empty($_REQUEST['srs']))
    {
        $arrayData = array("srs" => $_REQUEST['srs'],"buffer" => $_REQUEST['buffer'],"latitude"=>$_REQUEST['latitude'],"longitude"=>$_REQUEST['longitude']);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => NODE_URL.'/getDistinctSpeciesInBufferWithImages',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($arrayData),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            )));
       echo  $response =  curl_exec($curl);
        //$this->set_response(['getChecklist'=>$response,       
                            //     'success' => "1"]);
    }
    else
    {
        $this->set_response(['message'=>'something are wrong!',       
                                 'success' => "0"]);
    }           
}
public function getLandingPageStatesBoundary_get()
{
    //$this->headers();
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => NODE_URL.'/getLandingPageStatesBoundary',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            //CURLOPT_POSTFIELDS => json_encode($arrayData),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            )));
       echo  $response =  curl_exec($curl);
        //$this->set_response(['getChecklist'=>$response,       
                            //     'success' => "1"]);
            
}
public function getStateStatistics_post()
{
    $this->headers();
    $_REQUEST = json_decode(file_get_contents('php://input'), true);
    $arrayData = array("name" => $_REQUEST['name']);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => NODE_URL.'/getStateStatistics',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($arrayData),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            )));
       echo  $response =  curl_exec($curl);
        //$this->set_response(['getChecklist'=>$response,       
                            //     'success' => "1"]);
            
}


//project approval
public function projectAprroval_post()
{
    $this->headers();
    $_REQUEST = json_decode(file_get_contents('php://input'), true);
    if(!empty($_REQUEST['user_id'] && $_REQUEST['project_id']))
    {
        $checkData = $this->Crud_model->GetData('project_details', '',"project_id='".$_REQUEST['project_id']."'", '', '', '', '');
        if(!empty($checkData)) { 
        $arrayData = array('sender_user' => $_REQUEST['user_id'],'project_id'=>$_REQUEST['project_id'],'created_date'=> date('Y-m-d H:i:s'));
        $this->Crud_model->SaveData('project_approval',$arrayData);
        $this->set_response(['message'=>'Record Created Successfully','success' => "1"]); 
        }
        else {
            $this->set_response(['message'=>'Record not found!','success' => "0"]);
        }           
    }
    else {
        $this->set_response(['message'=>'something are missing','success' => "0"]);
    }
}
public function TrackingDetails_post()
{
    $this->headers();
    $_REQUEST = json_decode(file_get_contents('php://input'), true);
    if(!empty($_REQUEST['user_id'] && $_REQUEST['checklist_id']))
    {
        $checkData = $this->Crud_model->GetData('travel_tracks', '',"checklist_uuid='".$_REQUEST['checklist_id']."' and user_uuid='".$_REQUEST['user_id']."'");
        if(!empty($checkData)) { 
            $this->set_response(['travelTrackD'=>$checkData,'message'=>'Record fetched Successfully','success' => "1"]); 
        }
        else {
            $this->set_response(['message'=>'Record not found!','success' => "0"]);
        }           
    }
    else {
        $this->set_response(['message'=>'something are missing','success' => "0"]);
    }
}
public function editAction_post()
{
    $this->headers();
    $_REQUEST = json_decode(file_get_contents('php://input'), true);
    if(!empty($_REQUEST['checklist_id'])) {
    $data =  array("checklist_name"=>$_REQUEST['name'],"description"=>$_REQUEST['description'],"start_datetime"=>$_REQUEST['start_timestamp'],"end_datetime"=>$_REQUEST['end_timestamp'],"time_spent"=>$_REQUEST['time_spent'],"travelled_distance"=>$_REQUEST['travelled_distance'],"observation_type"=>$_REQUEST['observation_type'],"party_count"=>$_REQUEST['party_count']);
    $this->Crud_model->SaveData('checklist', $data,"checklist_id='".$_REQUEST['checklist_id']."'");
    $this->set_response(['success' => "1"]);
       // print_r($data);exit;
        }
    else{
        $this->set_response(['success' => "0"]);
    }    
     
     
}
public function socialLogin_post()
{
    $this->headers();
    $_REQUEST = json_decode(file_get_contents('php://input'), true);
    $user_id = $_REQUEST['user_id'];
    $first_name = $_REQUEST['first_name'];
    $last_name = $_REQUEST['last_name'];
    $email = $_REQUEST['email'];
    if (!empty($email)) {
    $cond="user_id='".$user_id."' and email='" . $email . "'";
    $checkUser = $this->Crud_model->GetData('users_details', '', $cond, '', '', '', '1');
    if (empty($checkUser)) {
    $SaveDataArray = array(
                        'user_id' => $user_id,
                        'first_name' => $first_name,
                        'last_name' => $last_name,
                        'email' => $email,
                        'is_deleted'=>'No','role'=>'User',
                        'registration_date'=>date('Y-m-d g:i:s'),
                        'status'   => 'Active');
    $this->Crud_model->SaveData('users_details', $SaveDataArray);
    $cond="user_id='".$user_id."' and email='" . $email . "'";
    $checkUser = $this->Crud_model->GetData('users_details', '', $cond, '', '', '', '1');
    $arrayD = array('first_name' => $checkUser->first_name,
                        'last_name' => $checkUser->last_name,
                        'email' => $checkUser->email,
                        'mobile' =>$checkUser->mobile_number,
                        'profileimage_id' =>$checkUser->profileimage_id,);
    $this->set_response(['data'=>$arrayD,'success' => "1"]);
                } 
    else {
    $cond="user_id='".$user_id."' and email='" . $email . "'";
    $checkUser = $this->Crud_model->GetData('users_details', '', $cond, '', '', '', '1');
    $arrayD = array('first_name' => $checkUser->first_name,
                        'last_name' => $checkUser->last_name,
                        'email' => $checkUser->email,
                        'mobile' =>$checkUser->mobile_number,
                        'profileimage_id' =>$checkUser->profileimage_id);    
    $this->set_response(['data'=>$arrayD,'success' => "1"]);
    }
}
else {
    $this->set_response(['message'=>'something went wrong.','success' => "0"]);
    }
}
public function userList_post()
{
    $this->headers();
    $_REQUEST = json_decode(file_get_contents('php://input'), true);
    $cUser = $this->Crud_model->GetData('users_details');
    $this->set_response(['data'=>$cUser,'success' => "1"]);
}
public function createMessage_post()
{
    $this->headers();
    $_REQUEST = json_decode(file_get_contents('php://input'), true);
    //print_r($_REQUEST);exit;
    if(!empty($_REQUEST['from']))
    {
        $arrayD = array('message_from' =>$_REQUEST['from'],'message_to'=>$_REQUEST['to'],'message'=>$_REQUEST['message'],'date_time'=>date('Y-m-d H:i:s'));
        $cUser = $this->Crud_model->SaveData('messages',$arrayD);
        $this->set_response(['success' => "1"]);    
    }
 else {
    $this->set_response(['message'=>'something went wrong.','success' => "0"]);
    }   
}
public function GetuserRMessage_post()
{
    $this->headers();
    $_REQUEST = json_decode(file_get_contents('php://input'), true);
    if(!empty($_REQUEST['sender_id']))
    {
        $cUser = $this->Crud_model->GetData('messages','message_from,message_to',"message_from='".$_REQUEST['sender_id']."' OR message_to='".$_REQUEST['sender_id']."'");
        $this->set_response(['data'=>$cUser,'success' => "1"]);
    }
    else {
    $this->set_response(['message'=>'something went wrong.','success' => "0"]);
    }
}

public function GetuserSMessage_post()
{
    $this->headers();
    $_REQUEST = json_decode(file_get_contents('php://input'), true);
    if(!empty($_REQUEST['sender_id'] && $_REQUEST['receiver_id']))
    {
        $cond="message_from in ('".$_REQUEST['sender_id']."' , '".$_REQUEST['receiver_id']."') and message_to in('".$_REQUEST['sender_id']."' , '".$_REQUEST['receiver_id']."')";
        $cUser = $this->Crud_model->GetData('messages','',$cond,'','date_time DESC');
        //print_r($this->db->last_query());exit;
        $this->set_response(['data'=>$cUser,'success' => "1"]);
    }
    else {
    $this->set_response(['message'=>'something went wrong.','success' => "0"]);
    }
}
public function project_addobservation_post()
{
    $ppD = $this->Crud_model->GetData('project_column','',"project_id='".$_REQUEST['project_id']."'",'','','','');
    foreach($ppD as $ppDRows) {
        $arrayData[] = json_encode(array($ppDRows->alias_name => $_REQUEST[$ppDRows->alias_name]));
    }   
    $dataProperties = $arrayData;
    $stringD = implode(',', $dataProperties);
    if(!empty($_FILES['addObservationFileUpload']['tmp_name'])) 
    {
        $image = base64_encode(file_get_contents($_FILES['addObservationFileUpload']['tmp_name']));
        $image_name = str_replace(" ","_", $_FILES['addObservationFileUpload']['name']);    
    }
    else {
        $image ="";
        $image_name = "";   
    }  
if(!empty($_REQUEST['addObservationMaleCount']))
{
    $maleCount = $_REQUEST['addObservationMaleCount'];
}
else {
    $maleCount = 0;
}
if(!empty($_REQUEST['addObservationFemaleCount']))
{
    $fCount = $_REQUEST['addObservationFemaleCount'];
}
else {
    $fCount = 0;
}
if(!empty($_REQUEST['addObservationChildCount']))
{
    $cCount = $_REQUEST['addObservationChildCount'];
}
else {
    $cCount = 0;
}
    $arrayData = array("addObservationCheckListId"=>$_REQUEST['addObservationCheckListId'],"addObservationCheckListName"=>$_REQUEST['addObservationCheckListName'],"addObservationUserId"=>$_REQUEST['addObservationUserId'],"addObservationTaxonID"=>$_REQUEST['addObservationTaxonID'],"addObservationSpeciesName"=>$_REQUEST['addObservationSpeciesName'],"addObservationMaleCount"=>$maleCount,"addObservationFemaleCount"=>$fCount,"addObservationChildCount"=>$cCount,'addObservationFileUpload'=>$image,'image_name'=>$image_name,"addObservationIndividualCount"=>$_REQUEST['addObservationIndividualCount'],"addObservationSex"=>'',"addObservationLifeStage"=>'',"addObservationReproductiveCondition"=>'',"addObservationBehaviour"=>$_REQUEST['addObservationBehaviour'],"addObservationRemarks"=>$_REQUEST['addObservationRemarks'],"addObservationHabitat"=>$_REQUEST['addObservationHabitat'],"addObservationMessage"=>$_REQUEST['addObservationMessage'],"addObservationProtocol"=>'',"addObservationGeoprivacy"=>$_REQUEST['addObservationGeoprivacy'],'addObservationLatitude'=>$_REQUEST['addObservationLatitude'],'addObservationLongitude'=>$_REQUEST['addObservationLongitude'],"identification_required"=>$_REQUEST['identification_required'],"addObservationDynamicProperties"=>$stringD);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => NODE_URL.'/addObservationNew',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($arrayData),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
       $response =  curl_exec($curl);
    //Mono Db Api
    $url = NODE_URL.'/saveProjectValueAll';    
        $data = array('data'=>$stringD,'project_id'=>$_REQUEST['project_id']);
        $postdata = json_encode($data);
        $ch =   curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $result = curl_exec($ch);
        curl_close($ch); 
        //print_r($response);exit;
    if(!empty($response))
    {
        $this->set_response(['success' => "1"]); 
    }      
}
public function getProtectedAreas_post()
{
    $this->headers();
    $_REQUEST = json_decode(file_get_contents('php://input'), true);
    $arrayData = array("srs" => $_REQUEST['srs']);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => NODE_URL.'/getProtectedAreas',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($arrayData),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            )));
       echo  $response =  curl_exec($curl);
        //$this->set_response(['getChecklist'=>$response,       
                            //     'success' => "1"]);
            
}
public function GetChecklistCoverImage_post()
{
    $this->headers();
    //$_REQUEST = json_decode(file_get_contents('php://input'), true);
    //print_r($_REQUEST['checklist_id']);exit;
    $arrayData = array("checklist_id" => $_REQUEST['checklist_id']);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => NODE_URL.'/getChecklistCoverImage',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($arrayData),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            )));
       echo  $response =  curl_exec($curl);
}
}
?>