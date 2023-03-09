<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Experts extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }
public function index()
    {
        $postData = array();
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => API_URL.'/Apis/consortiumExperts',
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
        $response = json_decode($response);
        //print_r($response);exit;
        $expertsData = array();
        if ($response->success == '1') {
            $expertsData = $response->data;
        }
        
        $data = array(
            'expertsData' => $expertsData,
        );
        $this->load->view('cox', $data);
    }
public function askData()
{
    //print_r($_REQUEST);exit;
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
                    $htmlContent = '<h1 style="text-align:center;">ASK ME</h1>';
                    $htmlContent .= '<p>Dear '.ucfirst($_REQUEST['name']).',</p>
<p>Welcome to IBIS registration! </p>
<p>This is the second step of your registration process.</p> 
<p>Your OTP for contact details verification is <b>'.$_REQUEST['subject'].'</b>.
Please use this OTP to continue your registration process at the IBIS website.
Please do not share this OTP with anyone.</p>
<p>This is a system generated e-mail and please do not reply. Add ibis.org.in to your 
contact list/safe sender list. This is to prevent your mailbox security filter or ISP (Internet 
Service Provider) from stopping you from receiving emails from IBIS.</p><p>
Thanks & Regards,<br>
IBIS TEAM
</p>';
                    $this->email->to($_REQUEST['email']);
                    $this->email->from(email_id,'IBIS');
                    $this->email->subject($_REQUEST['title']);
                    $this->email->message($htmlContent);
                    $this->email->send();
}

}
/* End of file Experts.php */
 ?>