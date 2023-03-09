<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Species extends CI_Controller {

public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION[SESSION_NAME]['user_uuid'])) {
            redirect('home');
        }
    }    

public function index()
    {
        $data = array(
            'foo' => 'bar', 
        );
        $this->load->view('species', $data);
    }

public function countries()
{
    //print_r($_REQUEST['scientificName']);exit;
    $data =  array("" => '');
    $scientificName = $_REQUEST['scientificName'];
    $token = '9bb4facb6d23f48efbf424bb05c0c1ef1cf6f468393bc745d42179ac4aca5fee';
         $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://apiv3.iucnredlist.org/api/v3/species/countries/name/'.$scientificName.'?token='.$token,
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
        $arrayRes = array(json_decode(($response), true));
        $data = '<table class="table table-striped">
        <div class="card-body">
    <h4 class="card-title">Country occurrence by species name</h4>
        </div>
    
  <thead>
    <tr>
      <th scope="col">Code</th>
      <th scope="col">Country</th>
      <th scope="col">Presence</th>
      <th scope="col">Origin</th>
      <th scope="col">Distribution code</th>
    </tr>
  </thead>
  <tbody>';
  foreach($arrayRes[0]['result'] as $rowData)
        {
         $data .= '  <tr>
          <th scope="row">'.$rowData['code'].'</th>
          <td>'.$rowData['country'].'</td>
          <td>'.$rowData['presence'].'</td>
          <td>'.$rowData['origin'].'</td>
          <td>'.$rowData['distribution_code'].'</td>
    </tr>';
            
        }
    
    
  $data .= '</tbody>
</table>';
        
   echo $data;     
        
        
}
public function Synonyms()
{
    //print_r($_REQUEST['scientificName']);exit;
    $data =  array("" => '');
    $scientificName = $_REQUEST['scientificName'];
    $token = '9bb4facb6d23f48efbf424bb05c0c1ef1cf6f468393bc745d42179ac4aca5fee';
         $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://apiv3.iucnredlist.org/api/v3/species/synonym/'.$scientificName.'?token='.$token,
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
        $arrayRes = array(json_decode(($response), true));
        $data = '<table class="table table-striped">
        <div class="card-body">
    <h4 class="card-title">Synonyms</h4>
        </div>
    
  <thead>
    <tr>
      <th scope="col">Accepted Id</th>
      <th scope="col">Accepted Name</th>
      <th scope="col">Authority</th>
      <th scope="col">Synonym</th>
      <th scope="col">Syn Authority</th>
      </tr>
  </thead>
  <tbody>';
  foreach($arrayRes[0]['result'] as $rowData)
        {
         $data .= '  <tr>
          <th scope="row">'.$rowData['accepted_id'].'</th>
          <td>'.$rowData['accepted_name'].'</td>
          <td>'.$rowData['authority'].'</td>
          <td>'.$rowData['synonym'].'</td>
          <td>'.$rowData['syn_authority'].'</td>
    </tr>';
            
        }
    
    
  $data .= '</tbody>
</table>';
        
   echo $data;     
        
        
}
public function Habitat()
{
    //print_r($_REQUEST['scientificName']);exit;
    $data =  array("" => '');
    $scientificName = $_REQUEST['scientificName'];
    $token = '9bb4facb6d23f48efbf424bb05c0c1ef1cf6f468393bc745d42179ac4aca5fee';
         $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://apiv3.iucnredlist.org/api/v3/habitats/species/name/'.$scientificName.'?token='.$token,
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
        $arrayRes = array(json_decode(($response), true));
        $data = '<table class="table table-striped"><div class="card-body">
    <h4 class="card-title">Habitat</h4>
        </div></div>
  <thead>
    <tr>
      <th scope="col">Code</th>
      <th scope="col">Habitat</th>
      <th scope="col">Suitability</th>
      <th scope="col">Season</th>
      <th scope="col">Major importance</th>
      </tr>
  </thead>
  <tbody>';
  foreach($arrayRes[0]['result'] as $rowData)
        {
         $data .= '  <tr>
          <th scope="row">'.$rowData['code'].'</th>
          <td>'.$rowData['habitat'].'</td>
          <td>'.$rowData['suitability'].'</td>
          <td>'.$rowData['season'].'</td>
          <td>'.$rowData['majorimportance'].'</td>
    </tr>';
            
        }
    
    
  $data .= '</tbody>
</table>';
        
   echo $data;     
        
        
}
public function Measures()
{
    //print_r($_REQUEST['scientificName']);exit;
    $data =  array("" => '');
    $scientificName = $_REQUEST['scientificName'];
    $token = '9bb4facb6d23f48efbf424bb05c0c1ef1cf6f468393bc745d42179ac4aca5fee';
         $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://apiv3.iucnredlist.org/api/v3/measures/species/name/'.$scientificName.'?token='.$token,
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
        $arrayRes = array(json_decode(($response), true));
        $data = '<table class="table table-striped"><div class="card-body">
    <h4 class="card-title">Conservation Measures</h4>
        </div></div> 
  <thead>
    <tr>
      <th scope="col">Code</th>
      <th scope="col">Title</th>
    </tr>
  </thead>
  <tbody>';
  foreach($arrayRes[0]['result'] as $rowData)
        {
         $data .= '  <tr>
          <th scope="row">'.$rowData['code'].'</th>
          <td>'.$rowData['title'].'</td>
          
    </tr>';
            
        }
    
    
  $data .= '</tbody>
</table>';
        
   echo $data;     
        
        
}
public function Smedias()
{
    //print_r($_REQUEST['scientificName']);exit;
    $data =  array("scientificName" => $_REQUEST['scientificName']);
         $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => NODE_URL.'/getSpeciesImages',
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
        //print_r(count($arrayRes));exit;
        foreach ($arrayRes as $key => $valueData);
        if(!empty($valueData['sp_file_url'])) { 
    $data = '<div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel"><ol class="carousel-indicators">';
      for($i=0; $i < count($arrayRes); $i++)
      {
        if($i==0) 
            {
                $olC = 'class="active"';
            }
            
        $data .=' <li data-bs-target="#carouselExampleFade" data-bs-slide-to="'.$i.'"  '.$olC.' ></li>'; 
            
        }     
   $data .=' </ol>
    <div class="carousel-inner">';

    $srno =0;
foreach ($arrayRes as $key => $value) {
    if($srno ==1)
    {
        $scL = 'class="carousel-item active"';
    }
    else {
        $scL = 'class="carousel-item"';
    }
    $data .='<div '.$scL.'>
        <img src="'.$value['sp_file_url'].'" alt="img" class="d-block w-100">
      </div>';
      $srno++;
      echo $data;
}
      
  $data .='</div></div>';

}
else {
    echo '<div class="card-body btn-primary" style="text-align:center">Record not found!</div>';
}
}
/*public function Smedias()
{
    //print_r($_REQUEST['scientificName']);exit;
    $data =  array("scientificName" => $_REQUEST['scientificName']);
         $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => NODE_URL.'/getSpeciesImages',
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
        //print_r(count($arrayRes));exit;
        foreach ($arrayRes as $key => $valueData);
        if(!empty($valueData['sp_file_url'])) { 
    $data = '<div class="container" style="width:700px;height:450px">
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">';
      for($i=0; $i < count($arrayRes); $i++)
      {
        if($i==0) 
            {
                $olC = 'class="active"';
            }
            
        $data .=' <li data-target="#myCarousel" data-slide-to="'.$i.'"  '.$olC.' >'; 
            
        }
        
        $data .='&nbsp;&nbsp;&nbsp;&nbsp;</li>';
       
      
   $data .=' </ol>
    <div class="carousel-inner">';

    $srno =0;
foreach ($arrayRes as $key => $value) {
    if($srno ==1)
    {
        $scL = 'class="item active"';
    }
    else {
        $scL = 'class="item"';
    }
    $data .='<div '.$scL.'>
        <img src='.$value['sp_file_url'].' alt="img" style="width:100%;">
      </div>';
      $srno++;
}
      
  $data .='</div>
  </div>
</div>';
echo $data;
}
else {
    echo '<div class="card-body btn-primary" style="text-align:center">Record not found!</div>';
}
}*/
public function xenoDataBird()
{   
    //$scientificName = $_REQUEST['scientificName'];
    $data =  array("" => '');
    $url = 'https://xeno-canto.org/api/2/recordings?query='.$_REQUEST['scientificName'];
    $arrayRes = file_get_contents($url);
    print_r($arrayRes);exit;
    //print_r($url);
         $curl = curl_init();
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
        print_r($response);exit;
    $data = '<table id="exampleDD" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>SNID</th>
                <th>Issue No</th>
                <th>Month</th>
                <th>Year</th>
                <th>News Topic</th>
                <th>State</th>
                <th>Location</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>';
    foreach ($GetData as $key => $value) {
       
    $data .= '<tr>
                <td>'.$value->snid.'</td>
                <td>'.$value->pdf_no.'</td>
                <td>'.$value->month.'</td>
                <td>'.$value->year.'</td>
                <td>'.$value->news_topic.'</td>
                <td>'.$value->state.'</td>
                <td>'.$value->location.'</td>
                <td><a href='.base_url('media/protected_area_pdfs/'.$value->pdf_no.'.pdf').' target="_blank()"><button class="btn-primary">View</button></a></td>
            </tr>';

          
    //print_r($GetData);exit;
                }
      $data .='</tbody></table>';
      echo $data;          
}
}

/* End of file Species.php */
?>