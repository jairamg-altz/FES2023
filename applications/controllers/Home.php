<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);
class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
public function index()
    {
        if (!empty($_SESSION[SESSION_NAME]['user_uuid'])) {
            redirect('dashboard');
        }
         $data =  array("srs" => "3857");
         $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => API_URL.'/Apis/getTotalStatistics',
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
        $response = curl_exec($curl);
        curl_close($curl);
        $arrayRes = json_decode(($response), true);
        foreach ($arrayRes as $value);
        //print_r($response);exit;
        $arrayData = array('TotalStatistics' =>$value);
        $this->load->view('index',$arrayData);
 }       
public function signup()
    {
        $name = trim($_POST['first_name']) . ' ' . trim($_POST['last_name']);
        $user_id = trim($_POST['username']);
        $email = trim($_POST['email']);
        if(!empty($_POST['phone']))
        {
            $mobile = trim($_POST['phone']);
        }
        else {
            $mobile = 0;
        }        
        $password = trim($_POST['password']);
        $confirm_password = trim($_POST['confirm_password']);
    if (!empty($user_id)) {
         $cond="user_id='".$user_id."' and email='" . $email . "' and status='Active'";
            $checkUser = $this->Crud_model->GetData('users_details', '', $cond, '', '', '', '1');
            if (empty($checkUser)) {
                if ($password == $confirm_password) {
                    $otp = random_int(100000, 999999);
                    $SaveDataArray = array(
                        'user_id' => $user_id,
                        'first_name' => trim($_POST['first_name']),
                        'last_name' => trim($_POST['last_name']),
                        'email' => $email,
                        'mobile_number' => $mobile,
                        'password' => md5($password),
                        'is_deleted'=>'No','role'=>'User',
                        'registration_date'=>date('Y-m-d g:i:s'),'otp'=>$otp,'otp_verified'=>'No',
                        'status'   => 'Active');
                    //print_r($SaveDataArray);exit;
                    $this->Crud_model->SaveData('users_details', $SaveDataArray);
                    $UserData = $this->Crud_model->GetData('users_details', '',"otp='".$otp."'", '', '', '', '1');
                    //SMTP & mail configuration
                    $this->load->library('email');
                    $config = array(
                        'protocol'  => PROTOCOL,
                        'smtp_host' => SMTP_HOST,
                        'smtp_port' => SMTP_PORT,
                        'smtp_user' => SMTP_USER,
                        'smtp_pass' => SMTP_PASS,
                        'mailtype'  => 'html',
                        'charset'   => 'utf-8'
                    );
                    $this->email->initialize($config);
                    $this->email->set_mailtype("html");
                    $this->email->set_newline("\r\n");

                    //Email content
                    $htmlContent = '<h1 style="text-align:center;"></h1>';
                    $htmlContent .= '<p>Dear '.ucfirst($name).',</p>
<p>Welcome to IBIS registration! </p>
<p>This is the second step of your registration process.</p> 
<p>Your OTP for contact details verification is <b>'.$otp.'</b>.
Please use this OTP to continue your registration process at the IBIS website.
Please do not share this OTP with anyone.</p>
<p>This is a system generated e-mail and please do not reply. Add ibis.org.in to your 
contact list/safe sender list. This is to prevent your mailbox security filter or ISP (Internet 
Service Provider) from stopping you from receiving emails from IBIS.</p><p>
Thanks & Regards,<br>
IBIS TEAM
</p>';
                    $this->email->to($email);
                    $this->email->from(email_id,'IBIS');
                    $this->email->subject('OTP');
                    $this->email->message($htmlContent);
                    $this->email->send();
                    redirect('Home/otpAuth/'.$UserData->user_uuid);
                } 
                else{
                    redirect('home');
                }
        
        
        }
        else{
            redirect('home');
        }
    }
}
//Resend Otp
public function resendotp()
{
    $getDUser = $this->Crud_model->GetSingleData('users_details', '', "user_uuid='" .$_REQUEST['user_uuid']. "' and status='Active'");
    $otp = random_int(100000, 999999);
    $SaveDataArray = array('otp'=>$otp);
    $this->Crud_model->SaveData('users_details', $SaveDataArray,"user_uuid='" .$_REQUEST['user_uuid']."'");
    //SMTP & mail configuration
                    $this->load->library('email');
                    $config = array(
                        'protocol'  => PROTOCOL,
                        'smtp_host' => SMTP_HOST,
                        'smtp_port' => SMTP_PORT,
                        'smtp_user' => SMTP_USER,
                        'smtp_pass' => SMTP_PASS,
                        'mailtype'  => 'html',
                        'charset'   => 'utf-8'
                    );
                    $this->email->initialize($config);
                    $this->email->set_mailtype("html");
                    $this->email->set_newline("\r\n");

                    //Email content
                    $htmlContent = '<h1 style="text-align:center;"></h1>';
                    $htmlContent .= '<p>Dear '.ucfirst($getDUser->first_name.' '.$getDUser->last_name).',</p>
<p>Welcome to IBIS registration! </p>
<p>This is the second step of your registration process.</p> 
<p>Your OTP for contact details verification is <b>'.$otp.'</b>.
Please use this OTP to continue your registration process at the IBIS website.
Please do not share this OTP with anyone.</p>
<p>This is a system generated e-mail and please do not reply. Add ibis.org.in to your 
contact list/safe sender list. This is to prevent your mailbox security filter or ISP (Internet 
Service Provider) from stopping you from receiving emails from IBIS.</p><p>
Thanks & Regards,<br>
IBIS TEAM
</p>';
                    $this->email->to($getDUser->email);
                    $this->email->from(email_id,'IBIS');
                    $this->email->subject('RESEND OTP');
                    $this->email->message($htmlContent);
                    $this->email->send();
                    if($this->email->send()){
                        echo 1;exit;
                    }
                    else {
                        echo $this->email->print_debugger();exit;
                    }
    //print_r($this->email->send());exit;
}
//User Verification
public function userVerified()
{
    $getUser = $this->Crud_model->GetSingleData('users_details', '', "user_id='" .$_REQUEST['user_id']. "' and status='Active'");
    if(!empty($getUser))
    {
        echo "1";
    }
    else {
        echo "0";
    }
}
//User Verification

//User Verification
public function emailVerified()
{
    $getUser = $this->Crud_model->GetSingleData('users_details', '', "email='" .$_REQUEST['email']. "' and status='Active'");
    if(!empty($getUser))
    {
        echo "1";
    }
    else {
        echo "0";
    }
}
//email 
//Otp Auth
public function otpAuth($user_uuid)
{
    $getUser = $this->Crud_model->GetSingleData('users_details', '', "user_uuid='" .$user_uuid. "'");
    $arrayData = array('user_uuid' =>$user_uuid,'getUser'=>$getUser);
    $this->load->view('otpAuth',$arrayData);
}
public function OtpCheck()
{
    $getUser = $this->Crud_model->GetSingleData('users_details', '', "otp='".$_REQUEST['otp']."'");    
    if(!empty($getUser))
    {
        $username = $getUser->user_id;
        $password = $getUser->password; 
        $arrayData = array('otp_verified' =>'Yes');
        $this->Crud_model->save('users_details',$arrayData,"user_id='".$username."'");
        $cond = "user_id='".$username."' and password='".$password."'"; 
        $checkUser = $this->Crud_model->GetData('users_details', '', $cond, '', '', '', '1'); 
        //print_r($checkUser);exit;
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
                $sess_array[SESSION_NAME] = (array) $data;
                $this->session->set_userdata($sess_array);
                $_SESSION[SESSION_NAME]['name'] = $_SESSION[SESSION_NAME]['first_name'] . ' ' . $_SESSION[SESSION_NAME]['last_name'];
                $_SESSION[SESSION_NAME]['profileImg'] = $_SESSION[SESSION_NAME]['profileimage_id'];
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('message', '<span class="alert alert-danger text-center" role="alert">' . $response['message'] . '</span>');
                redirect('home');
            }
    }
    else {
        $this->session->unset_userdata('message');
        $this->session->set_flashdata('message', '<span class="alert alert-success text-center" role="alert">Otp wrong</span>');
        redirect('Home/otpAuth/'.$_REQUEST['user_uuid']);
    }
}
public function login()
    {
        $username = $_POST['username'];
        $password = md5($_REQUEST['password']);        
        $data = array(
            'user_id' => $username,
            'password' => $password,
            'otp' =>'','logintype'=>'web'
        );
            $cond = "user_id='".$username."' and password='".$password."'"; 
            $checkUser = $this->Crud_model->GetData('users_details', '', $cond, '', '', '', '1'); 
            if ($checkUser->status=='Active') {
                if($checkUser->otp_verified=='No')
                {
                    redirect('Home/otpAuth/'.$checkUser->user_uuid);
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
                $sess_array[SESSION_NAME] = (array) $data;
                $this->session->set_userdata($sess_array);
                $_SESSION[SESSION_NAME]['name'] = $_SESSION[SESSION_NAME]['first_name'] . ' ' . $_SESSION[SESSION_NAME]['last_name'];
                $_SESSION[SESSION_NAME]['profileImg'] = $_SESSION[SESSION_NAME]['profileimage_id'];
                redirect('dashboard');
            }
            } else {
                $this->session->set_flashdata('message', '<span class="alert alert-danger text-center" role="alert">' . $response['message'] . '</span>');
                redirect('home');
            }
        
    }
public function Slogin()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];        
        $data = array(
            'user_id' => $username,
            'password' => $password,
            'otp' =>'','logintype'=>'web'
        );
            $password = md5($_REQUEST['password']);
            $cond = "user_id='".$username."' and password='".$password."' and status='Active'"; 
            $checkUser = $this->Crud_model->GetData('users_details', '', $cond, '', '', '', '1'); 
            if (!empty($checkUser)) {
                if($checkUser->otp_verified=='No')
                {
                    redirect('Home/otpAuth/'.$checkUser->user_uuid);
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
                $sess_array[SESSION_NAME] = (array) $data;
                $this->session->set_userdata($sess_array);
                $_SESSION[SESSION_NAME]['name'] = $_SESSION[SESSION_NAME]['first_name'] . ' ' . $_SESSION[SESSION_NAME]['last_name'];
                $_SESSION[SESSION_NAME]['profileImg'] = $_SESSION[SESSION_NAME]['profileimage_id'];
                redirect('observations');
            }
            } else {
                $this->session->set_flashdata('message', '<span class="alert alert-danger text-center" role="alert">' . $response['message'] . '</span>');
                redirect('home');
            }
        
    } 
public function Dlogin()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];        
        $data = array(
            'user_id' => $username,
            'password' => $password,
            'otp' =>'','logintype'=>'web'
        );
            $password = md5($_REQUEST['password']);
            $cond = "user_id='".$username."' and password='".$password."' and status='Active'"; 
            $checkUser = $this->Crud_model->GetData('users_details', '', $cond, '', '', '', '1'); 
            if (!empty($checkUser)) {
                if($checkUser->otp_verified=='No')
                {
                    redirect('Home/otpAuth/'.$checkUser->user_uuid);
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
                $sess_array[SESSION_NAME] = (array) $data;
                $this->session->set_userdata($sess_array);
                $_SESSION[SESSION_NAME]['name'] = $_SESSION[SESSION_NAME]['first_name'] . ' ' . $_SESSION[SESSION_NAME]['last_name'];
                $_SESSION[SESSION_NAME]['profileImg'] = $_SESSION[SESSION_NAME]['profileimage_id'];
                redirect('DataPlayground/index');
            }
            } else {
                $this->session->set_flashdata('message', '<span class="alert alert-danger text-center" role="alert">' . $response['message'] . '</span>');
                redirect('home');
            }
        
    } 
public function loginBID()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];        
        $data = array(
            'user_id' => $username,
            'password' => $password,
            'otp' =>'','logintype'=>'web'
        );
            $password = md5($_REQUEST['password']);
            $cond = "user_id='".$username."' and password='".$password."' and status='Active'"; 
            $checkUser = $this->Crud_model->GetData('users_details', '', $cond, '', '', '', '1'); 
            if (!empty($checkUser)) {
                if($checkUser->otp_verified=='No')
                {
                    redirect('Home/otpAuth/'.$checkUser->user_uuid);
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
                $sess_array[SESSION_NAME] = (array) $data;
                $this->session->set_userdata($sess_array);
                $_SESSION[SESSION_NAME]['name'] = $_SESSION[SESSION_NAME]['first_name'] . ' ' . $_SESSION[SESSION_NAME]['last_name'];
                $_SESSION[SESSION_NAME]['profileImg'] = $_SESSION[SESSION_NAME]['profileimage_id'];
                redirect('BirdID/index');
            }
            } else {
                $this->session->set_flashdata('message', '<span class="alert alert-danger text-center" role="alert">' . $response['message'] . '</span>');
                redirect('home');
            }
        
    }            
public function logout()
{
    unset($_SESSION['fes_home']);
    redirect('home');
}
}