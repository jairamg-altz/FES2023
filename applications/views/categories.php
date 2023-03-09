<?php $this->load->view('common/header'); ?> 
<style type="text/css">
  .page-header {
        background-image: linear-gradient(135deg, #31b551 0%, #2249a7 100%);
        min-height: 150px;
        margin-top: 120px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 20px 70px;
        color: #fff;
    } 
    .category-list-entry {
    margin-bottom: 1em;
    padding: 1em;
    background: #ecf0f1;
}
}
</style>
<div class="col-md-12">
    <div class="row page-header">
        <h1 class="display-6">Welcome to Forum Categories</h1>
    </div>
</div>
<div class="col-md-12 px-5 py-3">
  <div class="sub-menu-R9LRwb">
          <div class="profile-nav-tabs">
        <ul class="nav nav-tabs ">
            <li class="nav-item">
                <a href="<?= site_url('Forum/index');?>"><button class="nav-link">
                    <span class="h5"><b>
                        Feed</b>
                    </span>
                </button></a>
            </li>
            <li class="nav-item">
               <a href="<?= site_url('Forum/categories');?>"> <button class="nav-link active">
                    
                    <span class="h5"><b>
                        Categories</b>
                    </span>
                </button></a>
            </li>            
            <li class="nav-item">
                <a href="<?= site_url('Forum/myPost');?>"><button class="nav-link">
                    <span class="h5"><b>
                        My Posts</b>
                    </span>
                </button></a>
            </li>           
        </ul>
    </div>
        </div>
   </div>
<div class="container-fluid">  
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#" style="font-size: 20px;">Category </a>
      </li>
      </ul>   
  </div>
</nav>
<div class="row">
   <div class="card">
    <div class="card-body category-list-entry">
            <div class="col-md-12 row g-12">
                <div class="cateVr gap-3">
  <div class="bg-light border p-2" style="width:50%"><a href="<?= site_url('Forum/Catforum/General');?>" target="_blank();"><h5>General</h5></a>
 <p>Experiencing any difficulties while on IBIS? We are always eager to help our community of IBIS users.Please post any general queries related to the IBIS portal here.</p> 
  </div>
  <div class="vr"></div>
  <div class="bg-light border ms-auto" style="width:50%"><h5>Forum Post</h5>
 <?php if(!empty($getGenCat)) { foreach ($getGenCat as $key => $valueG) { ?>
   <a href="<?= site_url('Forum/Fdetails/'.$valueG->forum_id);?>"><div class="p-2 card-body"><?= ucfirst(substr($valueG->subject, 0,70));?></div></a>
  <!-- <p><?= substr($valueG->text_msg, 0,200);?></p>  -->  
  <?php } } else { ?>
<span class="card-body">No Record Found!</span>
<?php }?></div>
 </div>
  </div>
        </div>
  </div>
 <div class="card">
    <div class="card-body category-list-entry">
            <div class="col-md-12 row g-12">
                <div class="cateVr gap-3">
  <div class="bg-light border p-2" style="width:50%"><a href="<?= site_url('Forum/Catforum/Portal Updates');?>" target="_blank();"><h5>Portal Updates</h5></a>
 <p>IBIS is a constantly evolving space for biodiversity information. We are committed to making you part of that process. We will post any update in the IBIS portal here. Please note that only Admin users will have edit access to this category. All IBIS users are welcome to view the portal updates data here.</p> 
  </div>
  <div class="vr"></div>
  <div class="bg-light border ms-auto" style="width:50%"><h5>Forum Post</h5>
 <?php if(!empty($getpCat)) { foreach ($getpCat as $key => $valueP) { ?>
   <a href="<?= site_url('Forum/Fdetails/'.$valueP->forum_id);?>"><div class="card-body p-2"><?= ucfirst(substr($valueP->subject, 0,70));?></div></a>
  <!-- <p><?= substr($valueG->text_msg, 0,200);?></p>  -->  
  <?php } } else { ?>
<span class="card-body">No Record Found!</span>
<?php }?></div></div>
 </div>           
          </div>
        </div>
  </div>
  <div class="card">
    <div class="card-body category-list-entry">
            <div class="col-md-12 row g-12">
         <div class="cateVr gap-3">
  <div class="bg-light border p-2" style="width:50%"><a href="<?= site_url('Forum/Catforum/Bugs and features');?>" target="_blank();"><h5>Bugs and Features</h5></a>
 <p>Did you encounter any error or a bug while on IBIS? IBIS is a huge portal; and we are evolving. If you 
have noticed any bugs that you wish to notify us, let us know in this section. We will gladly address it. 
Further, you could use this section to tell us if you want a new feature on IBIS portal or the mobile 
application. Post your wishes here and we will incorporate your needs in future IBIS updates.</p> 
  </div>
  <div class="vr"></div>
  <div class="bg-light border ms-auto" style="width:50%"><h5>Forum Post</h5>
 <?php if(!empty($getpBat)) { foreach ($getpBat as $key => $valueB) { ?>
   <a href="<?= site_url('Forum/Fdetails/'.$valueB->forum_id);?>"><div class="card-body p-2"><?= ucfirst(substr($valueB->subject, 0,70));?></div></a>
  <!-- <p><?= substr($valueG->text_msg, 0,200);?></p>  -->  
  <?php } } else { ?>
<span class="card-body">No Record Found!</span>
<?php }?></div>
 </div>         
            </div>
        </div>
  </div>
  <div class="card">
    <div class="card-body category-list-entry">
            <div class="col-md-12 row g-12">
           <div class="cateVr gap-3">
<div class="bg-light border p-2" style="width:50%"><a href="<?= site_url('Forum/Catforum/Feedback');?>" target="_blank();"><h5>Feedback</h5></a>
 <p>IBIS is a new portal with great ambitions. Your feedback fuels our engines. We understand that the key to 
growth is to actively listen to our audience. Do write in with feedback. IBIS promises to display each and 
every feedback in this section.</p> 
  </div>
  <div class="vr"></div>
  <div class="bg-light border ms-auto" style="width:50%"><h5>Forum Post</h5>
 <?php if(!empty($getfCat)) { foreach ($getfCat as $key => $valueF) { ?>
   <a href="<?= site_url('Forum/Fdetails/'.$valueF->forum_id);?>"><div class="card-body p-2"><?= ucfirst(substr($valueF->subject, 0,70));?></div></a>
  <!-- <p><?= substr($valueG->text_msg, 0,200);?></p>  -->  
  <?php } } else { ?>
<span class="card-body">No Record Found!</span>
<?php }?></div>
 </div>           
          </div>
        </div>
  </div>
  <div class="card">
    <div class="card-body category-list-entry">
            <div class="col-md-12 row g-12">
                <div class="cateVr gap-3">
<div class="bg-light border p-2" style="width:50%"><a href="<?= site_url('Forum/Catforum/Community Outreach');?>" target="_blank();"><h5>Community Outreach</h5></a>
 <p>IBIS believes that biodiversity thrives when communities take action. One of the ultimate goals of IBIS is 
community-based conservation. Do you want to pursue any community-related conservation project? If 
you need our help, please post your queries here.</p> 
  </div>
  <div class="vr"></div>
  <div class="bg-light border ms-auto" style="width:50%"><h5>Forum Post</h5>
 <?php if(!empty($getcoCat)) { foreach ($getcoCat as $key => $valueCo) { ?>
   <a href="<?= site_url('Forum/Fdetails/'.$valueCo->forum_id);?>"><div class="card-body p-2"><?= ucfirst(substr($valueCo->subject, 0,70));?></div></a>
  <!-- <p><?= substr($valueG->text_msg, 0,200);?></p>  -->  
  <?php } } else { ?>
<span class="card-body">No Record Found!</span>
<?php }?></div>
 </div>            
          </div>
        </div>
  </div>
  <div class="card">
    <div class="card-body category-list-entry">
            <div class="col-md-12 row g-12">
            <div class="cateVr gap-3">
<div class="bg-light border p-2" style="width:50%"><a href="<?= site_url('Forum/Catforum/Collaborations and trainings');?>" target="_blank();"><h5>Collaborations and Trainings</h5></a>
 <p>IBIS is eager to collaborate with you. Do you want to collaborate with us and our team? Do you want to 
play a role in driving IBIS projects? Are you looking for mentoring support? Are you willing to offer 
training to fellow naturalists? Your queries and suggestions are welcome here in this section.</p> 
  </div>
  <div class="vr"></div>
  <div class="bg-light border ms-auto" style="width:50%"><h5>Forum Post</h5>
 <?php if(!empty($getctCat)) { foreach ($getctCat as $key => $valueCT) { ?>
   <a href="<?= site_url('Forum/Fdetails/'.$valueCT->forum_id);?>"><div class="card-body p-2"><?= ucfirst(substr($valueCT->subject, 0,70));?></div></a>
  <!-- <p><?= substr($valueG->text_msg, 0,200);?></p>  -->  
  <?php } } else { ?>
<span class="card-body">No Record Found!</span>
<?php }?></div>
 </div>          
          </div>
        </div>
  </div>
  <div class="card">
    <div class="card-body category-list-entry">
            <div class="col-md-12 row g-12">
            <div class="cateVr gap-3">
<div class="bg-light border p-2" style="width:50%"><a href="<?= site_url('Forum/Catforum/Knowledge sharing');?>"><h5>Knowledge Sharing</h5></a>
 <p>Want to share an interesting update with the IBIS community? Do you have a breakthrough to share with 
fellow IBIS enthusiasts? Keep them coming here.</p> 
  </div>
  <div class="vr"></div>
  <div class="bg-light border ms-auto" style="width:50%"><h5>Forum Post</h5>
 <?php if(!empty($getksCat)) { foreach ($getksCat as $key => $valueKS) { ?>
   <a href="<?= site_url('Forum/Fdetails/'.$valueKS->forum_id);?>"><div class="card-body p-2"><?= ucfirst(substr($valueKS->subject, 0,70));?></div></a>
  <!-- <p><?= substr($valueG->text_msg, 0,200);?></p>  -->  
  <?php } } else { ?>
<span class="card-body">No Record Found!</span>
<?php }?></div>
 </div>    
            </div>
        </div>
  </div>
  <div class="card">
    <div class="card-body category-list-entry">
            <div class="col-md-12 row g-12">
            <div class="cateVr gap-3">
<div class="bg-light border p-2" style="width:50%"><a href="<?= site_url('Forum/Catforum/Species identification');?>"><h5>Species identification</h5></a>
 <p>Every serious naturalist undergoes this experience: You come across a plant or animal species and you 
are unsure of its name. If identification help is what you are looking for, you are at the right place. Post a 
picture, video file, or audio call recording. Resident IBIS experts will help you identify the species. 
If you are an expert, please follow this category. Please help IBIS as we help others in species IDs.</p> 
  </div>
  <div class="vr"></div>
  <div class="bg-light border ms-auto" style="width:50%"><h5>Forum Post</h5>
 <?php if(!empty($getsiCat)) { foreach ($getsiCat as $key => $valueSIC) { ?>
   <a href="<?= site_url('Forum/Fdetails/'.$valueSIC->forum_id);?>"><div class="card-body p-2"><?= ucfirst(substr($valueSIC->subject, 0,70));?></div></a>
  <!-- <p><?= substr($valueG->text_msg, 0,200);?></p>  -->  
  <?php } } else { ?>
<span class="card-body">No Record Found!</span>
<?php }?></div>
 </div>          
          </div>
        </div>
  </div>
  <div class="card">
    <div class="card-body category-list-entry">
            <div class="col-md-12 row g-12">
            <div class="cateVr gap-3">
<div class="bg-light border p-2" style="width:50%"><a href="<?= site_url('Forum/Catforum/SDM');?>"><h5>SDM</h5></a>
 <p>Please post all queries pertaining to species distribution modelling (SDM) here. Want to know more 
about species data selection? Do you know what SDM layers to choose for the model? How about 
resampling of the SDM layers? Or do you have resolution queries? Post them all here. Make sure you use.</p> 
  </div>
  <div class="vr"></div>
  <div class="bg-light border ms-auto" style="width:50%"><h5>Forum Post</h5>
 <?php if(!empty($getsdiCat)) { foreach ($getsdiCat as $key => $valueSI) { ?>
   <a href="<?= site_url('Forum/Fdetails/'.$valueSI->forum_id);?>"><div class="card-body p-2"><?= ucfirst(substr($valueSI->subject, 0,70));?></div></a>
  <!-- <p><?= substr($valueG->text_msg, 0,200);?></p>  -->  
  <?php } } else { ?>
<span class="card-body">No Record Found!</span>
<?php }?>
  </div>
 </div>         
          </div>
        </div>
  </div>
</div>
</div>
<?php $this->load->view('common/footer'); ?>