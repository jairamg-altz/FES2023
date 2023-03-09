<?php $this->load->view('common/header'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
   /* Small devices (landscape phones, 576px and up)*/
@media (min-width: 576px) { .maindash {
        margin-top: 110px;
        padding: 1rem;
        background-color: #f3f3f3;
    } 
.btn-circle {
            border-radius: 6px;            
            text-align: center;
        } 
      .Htext{
    font-weight: 600;letter-spacing: 0.88px;line-height: 21px;
  }    
}

/* Medium devices (tablets, 768px and up)*/
@media (min-width: 768px) { .maindash {
        margin-top: 110px;
        padding: 1rem;
        background-color: #f3f3f3;
    } 
    .btn-circle {
            border-radius: 6px;            
            text-align: center;
        } 
      .Htext{
    font-weight: 600;letter-spacing: 0.88px;line-height: 21px;
  }    
}

/*Large devices (desktops, 992px and up) */
@media (min-width: 992px) { .maindash {
        margin-top: 110px;
        padding: 1rem;
        background-color: #f3f3f3;
    } 
    .btn-circle {
            border-radius: 6px;            
            text-align: center;
        } 
.Htext{
    font-weight: 600;letter-spacing: 0.88px;line-height: 21px;
  }
}

/*Extra large devices (large desktops, 1024px and up)*/
@media (min-width: 1024px) { .maindash {
        margin-top: 110px;
        padding: 1rem;
        background-color: #f3f3f3;
    }
.btn-circle {
            border-radius: 6px;            
            text-align: center;
        }
  .Htext{
    font-weight: 600;letter-spacing: 0.88px;line-height: 21px;
  }         
     }
/*Extra large devices (large desktops, 1200px and up)*/     
@media (min-width: 1200px) { .maindash {
        margin-top: 110px;
        padding: 1rem;
        background-color: #f3f3f3;
    }
.btn-circle {
            border-radius: 6px;            
            text-align: center;
        } 
  .Htext{
    font-weight: 600;letter-spacing: 0.88px;line-height: 21px;
  }        
     }
@media (max-width: 575.98px) { .maindash {
        margin-top: 110px;
        padding: 1rem;
        background-color: #f3f3f3;
    }
.btn-circle {
            border-radius: 6px;            
            text-align: center;
        } 
  .Htext{
    font-weight: 600;letter-spacing: 0.88px;line-height: 21px;
  }  }
  @media (max-width: 767.98px) { .maindash {
        margin-top: 110px;
        padding: 1rem;
        background-color: #f3f3f3;
    }
.btn-circle {
            border-radius: 6px;            
            text-align: center;
        } 
  .Htext{
    font-weight: 600;letter-spacing: 0.88px;line-height: 21px;
  } }
  @media (max-width: 991.98px) {  .maindash {
        margin-top: 110px;
        padding: 1rem;
        background-color: #f3f3f3;
    }
.btn-circle {
            border-radius: 6px;            
            text-align: center;
        } 
  .Htext{
    font-weight: 600;letter-spacing: 0.88px;line-height: 21px;
  }  } 
  @media (max-width: 1199.98px) { .maindash {
        margin-top: 110px;
        padding: 1rem;
        background-color: #f3f3f3;
    }
.btn-circle {
            border-radius: 6px;            
            text-align: center;
        } 
  .Htext{
    font-weight: 600;letter-spacing: 0.88px;line-height: 21px;
  }  }
</style>
<style type="text/css">
    .box2 {
    background-color: rgba(0,0,0,.5);
    color: #fff;
    font-family: sans-serif;
    font-size: 18px;
 }
   
}
</style>

<style>
   /* /* Custom style */
    .accordion-button::after {
      background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='%23333' xmlns='http://www.w3.org/2000/svg'%3e%3cpath fill-rule='evenodd' d='M8 0a1 1 0 0 1 1 1v6h6a1 1 0 1 1 0 2H9v6a1 1 0 1 1-2 0V9H1a1 1 0 0 1 0-2h6V1a1 1 0 0 1 1-1z' clip-rule='evenodd'/%3e%3c/svg%3e");
      transform: scale(.7) !important;
    }
    .accordion-button:not(.collapsed)::after {
      background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='%23333' xmlns='http://www.w3.org/2000/svg'%3e%3cpath fill-rule='evenodd' d='M0 8a1 1 0 0 1 1-1h14a1 1 0 1 1 0 2H1a1 1 0 0 1-1-1z' clip-rule='evenodd'/%3e%3c/svg%3e");
    }
</style>
<div class="conatiner maindash" style="z-index: 99999;">
 <div class="row col-md-12 col-lg-12">
   <div class="col-lg-8">
    
   <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <ol class="carousel-indicators">
                    <li data-bs-target="#carouselExampleFade" data-bs-slide-to="0" class="active"></li>
                    <li data-bs-target="#carouselExampleFade" data-bs-slide-to="1"></li>
                    <li data-bs-target="#carouselExampleFade" data-bs-slide-to="2"></li>
                    <li data-bs-target="#carouselExampleFade" data-bs-slide-to="3"></li>
                    
    </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="<?= IMAGE_URL.'/home/_DSC2617.jpg'; ?>" class="d-block w-100 banner-img" alt="...">
        <div class="carousel-caption d-none d-md-block">
        <p class="card-body box2"><i class="fa fa-copyright" aria-hidden="true"></i>Kaushal Patel <i>Panthera tigris</i> (Bengal Tiger) Ranthambore Tiger Reserve</p></div>
    </div>
    <div class="carousel-item">
      <img src="<?= IMAGE_URL.'/home/_MUM0656.jpg'; ?>" class="d-block w-100 banner-img" alt="...">
       <div class="carousel-caption d-none d-md-block">
                       <p class="card-body box2"><i class="fa fa-copyright" aria-hidden="true"></i> Akshay Shinde Flock of Shore Birds Arnala, Virar, Maharashtra</p></div>
    </div>
    <div class="carousel-item">
      <img src="<?= IMAGE_URL.'/home/pp.JPG'; ?>" class="d-block w-100 banner-img" alt="...">
      <div class="carousel-caption d-none d-md-block">
                        <p class="card-body box2"><i class="fa fa-copyright" aria-hidden="true"></i> Maitreyi <i>Tremella fuciformis</i> (Snow Fungus) kyadagi, Karnataka</p></div>
    </div>
    <div class="carousel-item">
      <img src="<?= IMAGE_URL.'/home/Banded Krait_Bungarus Fasciatus_ Maharashtra.jpg'; ?>" class="d-block w-100 banner-img" alt="...">
      <div class="carousel-caption d-none d-md-block">
                        <a href="#"><p class="card-body box2"><i class="fa fa-copyright" aria-hidden="true"></i> Mahek Vyas <i>Bungarus fasciatus</i> (Banded Krait) Maharashtra</p></a></div>
    </div>
   </div> 
</div>            
<div class="col-lg-12 mt-1 p-4" style="background: linear-gradient(135deg, #31B551 0%, #2249A7 100%);">
<div class="container-fluid">
  <div class="row justify-content-md-center" style="color: white;" >
    <div class="col-md-3 mt-1 text-center" >
      <?php if($TotalStatistics[0]['sp_parameter']=='Taxonomy Data') { echo $TotalStatistics[0]['sp_count']; } elseif($TotalStatistics[1]['sp_parameter']=='Taxonomy Data') { echo $TotalStatistics[1]['sp_count'];} elseif($TotalStatistics[2]['sp_parameter']=='Taxonomy Data') { echo $TotalStatistics[2]['sp_count']; } elseif($TotalStatistics[3]['sp_parameter']=='Taxonomy Data') { echo $TotalStatistics[3]['sp_count']; } else { echo 0; }?>
    </div>
    <div class="col-md-3 mt-1 text-center">
      <?php if($TotalStatistics[0]['sp_parameter']=='Total Species') { echo $TotalStatistics[0]['sp_count']; } elseif($TotalStatistics[1]['sp_parameter']=='Total Species') { echo $TotalStatistics[1]['sp_count'];} elseif($TotalStatistics[2]['sp_parameter']=='Total Species') { echo $TotalStatistics[2]['sp_count']; } elseif($TotalStatistics[3]['sp_parameter']=='Total Species') { echo $TotalStatistics[3]['sp_count']; } else { echo 0; }?>
    </div>   
    <div class="col-md-3 mt-1 text-center">
     <?php if($TotalStatistics[0]['sp_parameter']=='Total Families') { echo $TotalStatistics[0]['sp_count']; } elseif($TotalStatistics[1]['sp_parameter']=='Total Families') { echo $TotalStatistics[1]['sp_count'];} elseif($TotalStatistics[2]['sp_parameter']=='Total Families') { echo $TotalStatistics[2]['sp_count']; } elseif($TotalStatistics[3]['sp_parameter']=='Total Families') { echo $TotalStatistics[3]['sp_count']; } else { echo 0; }?>
    </div>
    <div class="col-md-3 mt-1 text-center">
     <?php if($TotalStatistics[0]['sp_parameter']=='Added this week') { echo $TotalStatistics[0]['sp_count']; } elseif($TotalStatistics[1]['sp_parameter']=='Added this week') { echo $TotalStatistics[1]['sp_count'];} elseif($TotalStatistics[2]['sp_parameter']=='Added this week') { echo $TotalStatistics[2]['sp_count']; } elseif($TotalStatistics[3]['sp_parameter']=='Added this week') { echo $TotalStatistics[3]['sp_count']; } else { echo 0; }?>
    </div>
    <div class="col mt-1 text-center">      
    </div>
  </div>
  <div class="row justify-content-md-center" style="color: white;width: 100%;">
    <div class="col-md-3 text-center">
      Occurence Data
    </div>
    <div class="col-md-3 text-center">
     Total Species
    </div>
    <div class="col-md-3 text-center">
      Total Families
    </div>
    <div class="col-md-3 text-center">
      Added This Week
    </div>    
    <div class="col text-center" style="float:right;padding-top: 2%;">
      <a href="<?= site_url('DataPlayground');?>"><button class="btn-circle btn-primary">Browse All Data</button></a>
    </div> 
  </div>
</div></div>
<div class="Data-nav-tabs" style="position: absolute;z-index:1;
    margin-top: 18px;
    margin-left: 180px;">
        <ul class="nav nav-tabs justify-content-around" style="border-bottom: none !important;">
            <li class="nav-item">
    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#fea_ref">
    <select id="loadDashboardLayersDiv" class="form-select" style="background-color:#5d9ad2;color: white;">
  <option value="" selected>Species classes</option>
  <option value="Aves">Aves</option>
  <option value="Mammals">Mammals</option>
  <option value="Amphibians">Amphibians</option>
  <option value="Reptiles" selected>Reptiles</option>
</select>
                   
                </button>
            </li>
            <li class="nav-item">
                <button id="loadDashboardTemporalDemandLayersDiv" class="nav-link" data-bs-toggle="tab" data-bs-target="#species_ref">
                   <span class="h5 form-control" style="background-color:#5d9ad2;color: white">
                        Temporal demand
                    </span>
                </button>
            </li>
            <li class="nav-item">
                <button id="loadDashboardSpatialDemandLayersDiv" class="nav-link form-control" data-bs-toggle="tab" data-bs-target="#dataLayer_ref">
                    <span class="h5 form-control" style="background-color:#5d9ad2;color: white;">
                        Spatial demand
                    </span>
                </button>
            </li>
           </ul>
    </div>
<div class="p-3">
	<!--<div class="cv-spinner" style="display:none;" id="layerLoadingSpinner">-->
    <div id="dashboardmap" style="height:580px"></div>
	<!--<div><img id="legend"/></div>-->
</div>
<div class="container-fluid">
    <div class="accordion" id="myAccordion">
        <div class="row gx-0"> 
        <div class="accordion-item col-md-4">
            <h2 class="accordion-header" id="headingOne">
                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseOne">FORUMS &nbsp;<?php if(!empty($dforum)) { ?>
 <a href="<?= site_url('Forum/index');?>" target="_blank();"> <span class="badge badge-light" style="background-color:black;float:right"><?php if(!empty($dforum)) {  echo count($dforum); } else { echo 0; } ?></span></a>
<?php } else { ?>
    <span class="badge badge-light" style="background-color:black;float:right"><?php if(!empty($dforum)) {  echo count($dforum); } else { echo 0; } ?></span>
<?php } ?> </button>                                 
            </h2>
        </div>
        <div class="accordion-item col-md-4">
            <h2 class="accordion-header" id="headingTwo">
                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseTwo">ID REQUEST &nbsp;<?php if(!empty($observation)) { ?><a href="<?= site_url('Observations/ViewNObjservation');?>" target="_blank();"><span class="badge badge-light" style="background-color:black;float:right"><?php if(!empty($observation)) {  echo count($observation); } else { echo 0; } ?></span></a> <?php } else { ?>
    <span class="badge badge-light" style="background-color:black;float:right"><?php if(!empty($observation)) {  echo count($observation); } else { echo 0; } ?></span>
<?php } ?></button>
            </h2>
            </div>
            <div class="accordion-item col-md-4" style="border-left: none;border-right:none ;border-bottom:none ;">
            <h2 class="accordion-header" id="headingThree">
                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseThree">FROM BLOG &nbsp;<?php if(!empty($blogs)) { ?><a href="<?= site_url('Dashboard/blog');?>"><span class="badge badge-light" style="background-color:black;float:right"><?php if(!empty($blogs)) {  echo count($blogs); } else { echo 0; } ?></span></a>
<?php } else { ?>
    <span class="badge badge-light" style="background-color:black;float:right"><?php if(!empty($blogs)) {  echo count($blogs); } else { echo 0; } ?></span>
<?php } ?>   </button>                     
            </h2>
        </div>
    <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#myAccordion">
                <div class="card-body conatiner">
                     <?php $srN=1;foreach($forom as $foromRow) {                         
    $getMedia = $this->Crud_model->GetData('discussion_medias','',"discussion_activity='post' and discussion_post_id='".$foromRow->forum_id."'",'','','2');
    if($srN < 4) { ?>
    <div class="card card-body">
        <div><a href="<?= site_url('Visitors/profile/'.$foromRow->user_uuid);?>" target="_blank();"><img class="avatar" style="height: 48px;width: 48px;" src="<?php if(!empty($foromRow->profileimage_id)) { echo IMAGE_URL.'../uploads/' . $foromRow->profileimage_id; } else { echo IMAGE_URL.'/06homepost-logindesktop-img-0981BB34-9E59-49F3-880E-43C6ACB6DFE8@2x.png'; }?>"></a>&nbsp;&nbsp;&nbsp;&nbsp;<b><a href="<?= site_url('Visitors/profile/'.$foromRow->user_uuid);?>" target="_blank();"><?= ucfirst($foromRow->first_name.' '.$foromRow->last_name);?></a></b>&nbsp;made of forum post titled: <a href="<?= site_url('Forum/Fdetails/'.$foromRow->forum_id); ?>"><span><?= substr(strip_tags($foromRow->subject), 0, 50);?><p style="line-height: 22px;margin-left: 65px;
        font-size:15px;font-weight: 400;" class="text-muted"><?= substr(strip_tags($foromRow->text_msg), 0, 150);;?></p></span></a></div>
        <div class="container-fluid">
         <div class="col-md-12">
         <div class="row">
 <?php foreach($getMedia as $getMediaRows) {
 if($getMediaRows->discussions_media_type=='image') {
  ?>   
    <div class="col-md-6 card-body">
    <img src="<?php if(!empty($getMediaRows->discussion_media_url)) { echo IMAGE_URL.'/forum/fmedia/'.$getMediaRows->discussion_media; } else { echo IMAGE_URL.'../uploads/Banner_02.jpg'; } ?>" style="width:520px;height: 210;border-radius: 8px;" class="img-fluid img-responsive">
    </div>
 <?php } elseif($getMediaRows->discussions_media_type=='video' || $getMediaRows->discussions_media_type=='audio') { ?>
<div class="col-md-6 card-body">  
<video  class="img-fluid rounded" controls>
<source src=<?php if(!empty($getMediaRows->discussion_media_url)) { echo IMAGE_URL.'/forum/fmedia/'.$getMediaRows->discussion_media; } else { echo IMAGE_URL.'/../uploads/Banner_02.jpg'; } ?> type=video/mp4 style="width:200px;height:150px;">
</video>
</div>
 <?php } } ?>   
</div>     
         </div>   
        </div>
        </div><?php } $srN++; }?> 
                
            </div>
        </div>
        
            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#myAccordion">
                 <?php if(empty($observation)) { ?>
  <div class="card-body">
   <h6 style="text-align: center;">No Record Founded!</h6>
  </div>
<?php } else { ?>
    <div class="card-body">
   <h6>Under Development.</h6>
  </div>
<?php } ?>
            
        </div>
        
            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#myAccordion">
                <?php $srN=1;foreach($blogs as $blogsRow) { //print_r($blogsRow->first_name);
    if($srN < 4) { ?>
    <div class="card-body">
        <div><a href="<?= site_url('Visitors/profile/'.$blogsRow->user_uuid);?>" target="_blank();"><img class="avatar" style="height: 48px;width: 48px;" src="<?php if(!empty($blogsRow->profileimage_id)) { echo IMAGE_URL.'../uploads/'.$blogsRow->profileimage_id; } else { echo IMAGE_URL.'06homepost-logindesktop-img-0981BB34-9E59-49F3-880E-43C6ACB6DFE8@2x.png'; }?>"></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?= site_url('Visitors/profile/'.$blogsRow->user_uuid);?>" target="_blank();"><b><?= ucfirst($blogsRow->first_name.' '.$blogsRow->last_name);?></b></a>&nbsp;posted a blog titled: <a href="<?= site_url('Dashboard/BlogDetail/'.$blogsRow->blogpost_id);?>"><span><?= substr(strip_tags($blogsRow->blog_title), 0, 50);;?></span><p style="line-height: 22px;margin-left: 65px;
        font-size:15px;font-weight: 400;" class="text-muted"><?= substr(strip_tags($blogsRow->blog_body), 0, 150);;?></p></a></div>
        
        </div><?php } $srN++; }?>
            
        </div>
    </div>
</div>   
</div>
<div class="row p-3"> 
 <h6>CONSORTIUM OF EXPERTS</h6>   
 <?php $srNo =1; foreach ($Uexpert as $key => $value) { 
    if($srNo < 4) {
if (strlen($value->expert_details) > 30)
   $str = substr($value->expert_details, 0, 20) . '...';
    ?>
     
<div class="col-md-4"> 
<div class="card"><a href="<?= site_url('Experts/index');?>"><div class="card-body"><img src="<?php if(!empty($value->profileimage_id)) { echo IMAGE_URL.'../uploads/' . $value->profileimage_id; } else { echo IMAGE_URL.'user.png'; }?>" class="img-responsive" alt="image" style="height:35px;width:35px;"><span class="m-2"><small><?php if(!empty($value->expert_details)) { echo $str; } else { '';} ?></small><span style="float:right">-- <?= ucfirst($value->first_name.' '.$value->last_name);?></span>
</span>
  </div></a></div>
</div>
<?php } $srNo++; } ?>
</div>


</div>
<div class="col-md-4 Htext">MY IBIS<button type="button" class="btn btn-outline-dark float-end" data-bs-toggle="modal" data-bs-target="#feedbackModal">Give Feedback</button><br><br><hr>
<p class="text-muted Htext" style="font-size:15px;text-align: justify;">
                    Indian Biodiversity Information System (IBIS) is a free and open reserve of comprehensive scientific information about all plant and animal lifeforms on the Indian subcontinent. IBIS provides anyone, anywhere instant access to data on Indian flora and fauna in a user-friendly, freely accessible format. 
                </p><div class="Htext">FROM YOUR FOLLOWERS</div><hr><div><a href="<?= site_url('Visitors/profile/'.$objerv->user_uuid);?>" target="_blank();">
                    <img class="avatar" style="height: 48px;width: 48px;" src="<?php if(!empty($objerv->profileimage_id)) { echo IMAGE_URL.'../uploads/'.$objerv->profileimage_id; } else { echo IMAGE_URL.'/06homepost-logindesktop-img-0981BB34-9E59-49F3-880E-43C6ACB6DFE8@2x.png'; }?>"></a>&nbsp;&nbsp;&nbsp;&nbsp;<b><a href="<?= site_url('Visitors/profile/'.$objerv->user_uuid);?>" target="_blank();"><?= ucfirst($objerv->first_name.' '.$objerv->last_name);?></a> added an observation</b><?php if(!empty($objerv->profileimage_id)) { ?>
            <a href="<?= site_url('observations/ViewObjservationDetail/'.$objerv->observation_id);?>" target="_blank();"><img style="margin-left: 55px;height:80px;width: 80px;" class="img-thumbnail" src="<?= $objerv->url;?>"></a>
                <?php } else { ?>
                <img style="margin-left: 55px;height:80px;width: 80px;" class="img-thumbnail" src="<?= IMAGE_URL.'06homepost-logindesktop-img-0981BB34-9E59-49F3-880E-43C6ACB6DFE8@2x.png';?>">
            <?php } ?>
                </div>
        <?php $srN=1;foreach($forom as $foromRow) { if($srN < 2) { ?>
        <div><a href="<?= site_url('Visitors/profile/'.$foromRow->user_uuid);?>" target="_blank();"><img class="avatar" style="height: 48px;width: 48px;" src="<?php if(!empty($foromRow->profileimage_id)) { echo IMAGE_URL.'../uploads/' . $foromRow->profileimage_id; } else { echo IMAGE_URL.'/06homepost-logindesktop-img-0981BB34-9E59-49F3-880E-43C6ACB6DFE8@2x.png'; }?>"></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?= site_url('Forum/index');?>"><b><?= ucfirst($foromRow->first_name.' '.$foromRow->last_name);?></b></a>&nbsp;made a forum post…<a href="<?= site_url('Forum/index');?>"><p style="line-height: 22px;margin-left: 65px;
        font-size:15px;font-weight: 400;" class="text-muted"><?= substr(strip_tags($foromRow->text_msg), 0, 150);;?></p></a></div><?php } $srN++; }?><hr><div class="Htext">ACTIVE USERS THIS WEEK<!-- <a href="#" style="float:right">ALL TIME</a> --></div><hr>
        <?php foreach($Auser as $AuserR) {?>
        <span class="p-2"><a href="<?= site_url('Visitors/profile/'.$AuserR->user_uuid);?>"><img class="avatar"style="height: 48px;width: 48px;" src="<?php if(!empty($AuserR->profileimage_id)) { echo IMAGE_URL.'../uploads/' . $AuserR->profileimage_id; } else { echo IMAGE_URL.'user.png'; }?>"></a></span>
    <?php } ?>
        <hr><div class="Htext">FEATURES</div><hr><div class="card-body">
            <a href="<?= site_url('PMS');?>"><button style="background-color: yellow;" class="btn col-md-12"><i class="fa-solid fa-telescope"></i>START YOUR PROJECT WITH IBIS</button></a></div><hr><div class="card-body">
            <a href="<?= site_url('Dashboard/blog');?>"><button style="background-color:#3ceb93;
;" class="btn col-md-12">WRITE A BLOG & SHARE EXPERIENCE</button></a></div><hr>

<div style="font-weight: 600;letter-spacing: 0.88px;line-height: 21px;">LATEST OBSERVATIONS LIST</div>
<?php //print_r($lobserList);?> 
<div class="col-lg-12">
 <div class="row p-1"> 
    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Common Name</th>
      <th scope="col">Scientific Name</th>
      <th scope="col">Latitude</th>
      <th scope="col">Longitude</th>
    </tr>
  </thead>
  <tbody>
    <?php $srNo=1; foreach($lobserList as $lobserListRow) { 

if($srNo <= 5) {
        ?>
    <tr>
      <th scope="row" data-toggle="tooltip" data-placement="top" title="<?= $lobserListRow->vernacular_name;?>"><?= substr($lobserListRow->vernacular_name,0,18);?></th>
      <td><i><?= $lobserListRow->scientific_name;?></i></td>
      <?php if($lobserListRow->geo_privacy=='Public') {?>
       <td><?=  substr($lobserListRow->decimal_latitude, 0, 7);?></td>
      <td><?= substr($lobserListRow->decimal_longitude, 0, 7);?></td>
  <?php } else { ?>
    <td>---</td>
      <td>---</td>
  <?php } ?>
    </tr>
<?php } $srNo++; }?>    
    </tbody>
</table>
<div style="font-weight: 600;letter-spacing: 0.88px;line-height: 21px;">LATEST OBSERVATIONS MEDIA</div>
<?php $oimges = $this->Crud_model->GetData('record_level','',"observation_id='".$Dobservation->observation_id."' and is_image = true");
   // print_r($this->db->last_query());
    ?>     
  
<div class="col-md-6"> 
    <?php foreach($oimges as $oimgesRows) {   ?>  
    <div class="card-body">
    <img src="<?php if(!empty($oimgesRows->file_uri)) { echo $oimgesRows->file_uri; } else { echo IMAGE_URL.'../uploads/Banner_02.jpg'; }?>" class="img-thumbnail rounded" alt="observation image">
</div>
<?php }?> 
<!-- <div class="card-body"><small>NA</small></div> -->
</div>
</div>


</div>
<div class="col-md-12"> 
<div class="card-body">
<a href="<?= site_url();?>/observations"><button class="btn" style="background-color: black;color: white;width: 100%;">Submit your observation</button></a>
</div>
 </div>

</div>
</div>
</div>
<?php $this->load->view('common/footer'); ?>
<!-- <script type="text/javascript" src="<?= base_url('assets/js/custom-config.js');?>"></script> -->
<script type="text/javascript" src="<?= base_url('assets/js/dashboard.js');?>"></script>
