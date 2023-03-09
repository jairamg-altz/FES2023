<?php $this->load->view('common/header'); ?> 
<style type="text/css">
@media (min-width: 576px) {
.page-header {
        background-image: linear-gradient(135deg, #31b551 0%, #2249a7 100%);
        min-height: 170px;
        margin-top: 120px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 20px 70px;
        background-color: #f3f3f3;
    }
  .fa-heart-o {
  /*color: red;*/
  cursor: pointer;
  font-size:36px;
}
.fa-heart {
  /*color: red;*/
  cursor: pointer;
  font-size: 25px;
}
.profText{
  font-size: var(--font-size-s);font-style: normal;letter-spacing: 0.25px;  margin-left:8px;
    position: absolute;
    padding-top: 25px;
    margin-right: 25px;
  }
  .avatarF {
  vertical-align: middle;
    width: 50px;
    height:50px;
    border-radius: 50%;
}

.another-element {
  float: right;
} 
body {
    max-width: 100%;
    overflow-x: hidden;
}

.FHText{
  letter-spacing: 0.88px;line-height: 21px;
}
}
/* Medium devices (tablets, 768px and up)*/
@media (min-width: 768px) {
.page-header {
        background-image: linear-gradient(135deg, #31b551 0%, #2249a7 100%);
        min-height: 170px;
        margin-top: 120px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 20px 70px;
        background-color: #f3f3f3;
    }
  .fa-heart-o {
  /*color: red;*/
  cursor: pointer;
  font-size:36px;
}
.fa-heart {
  /*color: red;*/
  cursor: pointer;
  font-size: 25px;
}
.profText{
  font-size: var(--font-size-s);font-style: normal;letter-spacing: 0.25px;  margin-left:8px;
    position: absolute;
    padding-top: 25px;
    margin-right: 25px;
  }
  .avatarF {
  vertical-align: middle;
    width: 50px;
    height:50px;
    border-radius: 50%;
}

.another-element {
  float: right;
} 
body {
    max-width: 100%;
    overflow-x: hidden;
}
.FHText{
  letter-spacing: 0.88px;line-height: 21px;
}
}

/*Large devices (desktops, 992px and up) */
@media (min-width: 992px) {
.page-header {
        background-image: linear-gradient(135deg, #31b551 0%, #2249a7 100%);
        min-height: 170px;
        margin-top: 120px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 20px 70px;
        background-color: #f3f3f3;
    }
  .fa-heart-o {
  cursor: pointer;
}

.fa-heart {
  color: red;
  cursor: pointer;
}
.profText{
  font-size: var(--font-size-s);font-style: normal;letter-spacing: 0.25px;  margin-left:8px;
    position: absolute;
    padding-top: 25px;
    margin-right: 25px;
  }
  .avatarF {
  vertical-align: middle;
    width: 50px;
    height:50px;
    border-radius: 50%;
}

.another-element {
  float: right;
} 
body {
    max-width: 100%;
    overflow-x: hidden;
}

.FHText{
  letter-spacing: 0.88px;line-height: 21px;
}
}
/*Extra large devices (large desktops, 1024px and up)*/
 @media (min-width: 1024px) {
.page-header {
        background-image: linear-gradient(135deg, #31b551 0%, #2249a7 100%);
        min-height: 170px;
        margin-top: 120px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 20px 70px;
        background-color: #f3f3f3;
    }
  
.profText{
  font-size: var(--font-size-s);font-style: normal;letter-spacing: 0.25px;  margin-left:8px;
    position: absolute;
    padding-top: 25px;
    margin-right: 25px;
  }
  .avatarF {
  vertical-align: middle;
    width: 50px;
    height:50px;
    border-radius: 50%;
}

.another-element {
  float: right;
} 
body {
    max-width: 100%;
    overflow-x: hidden;
}
.FHText{
  letter-spacing: 0.88px;line-height: 21px;
}
 }
 
</style>

<div class="col-md-12">
    <div class="row page-header">
        <h1 class="display-6" style="color:white;">Welcome to Forums</h1>
    <p style="color:white;"><b>The IBIS community is abuzz with exchanges that promote research, conservation, and education. You are welcome to share your thoughts.</b></p>
    <?php if(!empty($_SESSION[SESSION_NAME]['user_uuid'])) { ?>
    <div class="col-md-12 float-right"><a href="<?= site_url('Forum/CreatePost');?>"><button class="start-posting-hjljH6 poppins-medium-black-14px btn btn-default" style="border-radius:8px;background-color: white;">START POSTING</button></a></div>
  <?php } ?>
    </div>    
</div>
<div class="col-md-12 px-5 py-3">
  <div class="sub-menu-R9LRwb">
    <div class="profile-nav-tabs">
        <ul class="nav nav-tabs ">
            <li class="nav-item">
                <a href="<?= site_url('Forum/index');?>"><button class="nav-link <?php if($this->uri->segment(2)=='index') { echo 'active'; } ?>">
                    <span class="h5"><b>
                        Feed</b>
                    </span>
                </button></a>
            </li>
            <li class="nav-item">
               <a href="<?= site_url('Forum/categories');?>"> <button class="nav-link">
                    
                    <span class="h5"><b>
                        Categories</b>
                    </span>
                </button></a>
            </li>            
            <li class="nav-item">
                <a href="<?= site_url('Forum/myPost');?>"><button class="nav-link <?php if($this->uri->segment(2)=='myPost') { echo 'active'; } ?>">
                    <span class="h5"><b>
                        My Posts</b>
                    </span>
                </button></a>
            </li>           
        </ul>
    </div>         
  </div>
   </div>
   <div class="container-fluid col-md-12">
    <div class="col-md-12">
   <div class="row">    
     <div class="col-md-8" style="background-color:white;">
     <?php $date1 = new DateTime(date('Y-m-d H:i:s'));
     //print_r(date('Y-m-d h:i:s'));
        $srNo = 1; foreach ($data as $key => $value) { 
        $date2 = new DateTime($value->date_time);
        $interval = date_diff($date1, $date2);
        $getTdiffY = $interval->format("%y");
        $getTdiffMM = $interval->format("%m");
        $getTdiffD = $interval->format("%d");
        $getTdiffH = $interval->format("%h");
        $getTdiffM = $interval->format("%i"); 
     
if (strlen($value->text_msg) > 250) {
   $str = substr($value->text_msg, 0, 230) . '...';
}
if(empty($value->like_no))
{
  $likes = 0;  
}
else {
  $likes = $value->like_no;
} 
$getMedia = $this->Crud_model->GetData('discussion_medias','',"discussion_activity='post' and discussion_post_id='".$value->forum_id."'",'','','2');
$cond="discussion_forum_id='".$value->forum_id."'";
$getReply = $this->Crud_model->ForomReply($cond);
//print_r($getReply);
        ?>  
      <div class="col-md-12">
     <div class="row">
      <div class="col-md-10">
  <a href="<?= site_url('Visitors/profile/'.$value->user_uuid);?>" target="_blank();"><i class="fa fa-plus-circle" aria-hidden="true" style="position: absolute;margin-left: 10px;padding-top:16px;font-size: 20px;
    color: white;"></i><img class="avatar" style="height:52px;width: 52px;" src="<?php if(!empty($value->profileimage_id)) { echo IMAGE_URL.'../uploads/'.$value->profileimage_id; } else 
    { echo IMAGE_URL.'06homepost-logindesktop-img-0981BB34-9E59-49F3-880E-43C6ACB6DFE8@2x.png'; }?>"></a>
<span style="font-size:15px;position: absolute;margin-left:6px;"><b><?php if(!empty($value->first_name)) { echo ucfirst($value->first_name.' '.$value->last_name); } ?></b></span>
<span class="ml-3 profText"><span class="text-muted"><?php if($getTdiffY!=0) { echo $getTdiffY.' years';} ?> <?php if($getTdiffMM!=0) { echo $getTdiffMM.' months';} ?> <?php if($getTdiffD!=0) { echo $getTdiffD.' days';} ?> <?php if($getTdiffH!=0) { echo $getTdiffH.' hours';} ?>  <?= $getTdiffM; ?> minutes ago posted in </span><span style="font-size:15px;"></span></span> 
</div>
<div class="col-md-2"><span class="col-md-12 heart<?php echo $value->forum_id;?>" onclick="LIKdd('<?php echo $value->forum_id;?>')"><span class="badge-danger lcount"><?= $likes;?></span><i class="fa fa-heart-o" style="font-size:24px;"></i></span><span class="col-md-6 another-element" id="shareBtn" onclick= "shareData('<?php echo $value->forum_id;?>');"><i class="fa fa-share-alt" style="font-size:24px;" ></i></span>
</div>
</div>
<div class="col-md-12">
<h5 style="color: black;padding-top:30px"><b><?php if(!empty($value->subject)) { echo $value->subject; }?></b></h5>
</div>
<div class="col-md-12 container-fluid">
  <div class="row">
 <?php foreach($getMedia as $getMediaRows) {
 if($getMediaRows->discussions_media_type=='image') {
  ?>   
    <div class="col-md-6 card-body">
    <img src="<?php if(!empty($getMediaRows->discussion_media_url)) { echo IMAGE_URL.'forum/fmedia/'.$getMediaRows->discussion_media; } else { echo IMAGE_URL.'../uploads/Banner_02.jpg'; } ?>" style="width:810px;border-radius: 8px;" class="img-fluid img-responsive">
    </div>
 <?php } elseif($getMediaRows->discussions_media_type=='video' || $getMediaRows->discussions_media_type=='audio') { ?>
<div class="col-md-6 card-body">  
<video  class="img-fluid rounded" controls>
<source src=<?php if(!empty($getMediaRows->discussion_media_url)) { echo IMAGE_URL.'forum/fmedia/'.$getMediaRows->discussion_media; } else { echo IMAGE_URL.'../uploads/Banner_02.jpg'; } ?> type=video/mp4>
</video>
</div>
 <?php } } ?>   
</div>
</div>
<div class="col-md-12 card-body">
<p><?php if(!empty($value->text_msg)) { echo $str; }?>&nbsp;<a href="<?= site_url('Forum/Fdetails/'.$value->forum_id);?>"><span><u>Read More</u></span></a></p>
</div>
<?php $srPNo = 1; if(!empty($getReply)) { 



foreach($getReply as $getReplyRows) { 
 if($srPNo < 4) { 
if (strlen($getReplyRows->text_msg) > 110) {
   $strR = substr($getReplyRows->text_msg, 0, 90) . '...';
} elseif(empty($getReplyRows->text_msg))
{
  $strR = 'No reply...';
}
else{ $strR = substr($getReplyRows->text_msg, 0, 60) . '...';  }  ?>
<div class="container mt-2" >
  <div class="media border p-3">
    <a href="<?= site_url('Visitors/profile/'.$getReplyRows->user_uuid);?>"><img src="<?php if(!empty($getReplyRows->profileimage_id)) { echo IMAGE_URL.'../uploads/' . $getReplyRows->profileimage_id; } ?>" alt="<?= $getReplyRows->profileimage_id;?>" class="mr-3 mt-3 avatar" style="width:60px;"></a>
    <div class="media-body">
      <h5><?= ucfirst($getReplyRows->first_name.' '.$getReplyRows->last_name);?> <small><i>Posted on <?= date('M d Y' ,strtotime($getReplyRows->date_time))?></i></small></h5>
      <p><?= strip_tags($strR); ?></p>      
    </div>
  </div>
</div>
<?php  } $srNo++; } } else { ?>
  <div class="col-md-12 card-body">
  <span>No Reply Founded..</span>
</div>
 <?php  }?> 
 <div class="col-md-12 card-body">
<p><?php if(count($getReply) > 3) { ?> 
  <a href="<?= site_url('Forum/Fdetails/'.$value->forum_id);?>"><span><u>Read More</u></span></a><?php } ?></p>
</div>

<div class="col-md-12 card-body">
<span style="color: black;"><b>Replies: <?= count($getReply);?></b><span>
<?php if(!empty($_SESSION[SESSION_NAME]['user_uuid'])) { ?>  
<div class="col-md-12 card-body">
  <form  action="<?= site_url('Forum/replyAction/'.$value->forum_id);?>"  method="POST" enctype="multipart/form-data">
  <h6><u>POST REPLY</u></h6>
  <div class="rows form-group">
   <textarea id="editor<?= $srNo;?>" name="reply" required></textarea> 

</div>
<div class="mb-3 form-group p-3">
    <label for="formFileLg"><h6>Attachment</h6></label>
    
    <input type="file" name="media[]" multiple accept="image/png, image/gif, image/jpeg, video/mp4" id="attachmentD" class="form-control form-control-lg">
    </div>
  <button type="submit" class="btn btn-dark" style="float: right;" onclick="return ckVal(<?= $srNo;?>);">REPLY</button>
 </form> 
 <div class="col-md-12 row"></div>
 <div class="col-md-12 row"></div>
</div>  
<?php } ?>
</span>
</span></div>
    </div>
<?php $srNo++; } ?>


  </div>
<div class="col-md-4 container-fluid">     
  <div class="col-md-12 ml-3 p-3 FHText"><b>MOST REPLIED POSTS</b></div> 
     <!-- <div class="col-md-12 p-3">
     <span><img class="avatarF" src="<?= IMAGE_URL.'06homepost-logindesktop-img-0981BB34-9E59-49F3-880E-43C6ACB6DFE8@2x.png'?>"></span> 
       <span class="col-md-12" style="font-size:13px;position: absolute;margin-left:2px;padding-top:8px;"><b>Ashok Kumar</b> added an observation</span>
       <span style="padding-top:30px;position: absolute;margin-left: 20px;"><img src="<?= IMAGE_URL.'../uploads/Banner_02.jpg';?>" style="width:90px;height: 50px;border-radius: 8;"></span>
    </div><hr> -->
    <?php if (strlen($Apost->text_msg) > 120) {
   $strMP = substr($Apost->text_msg, 0, 90) . '...';
}?>
    <div class="container mt-1">
    <div class="media p-1">
    <a href="<?= site_url('Visitors/profile/'.$Apost->user_uuid);?>"><img src="<?php if(!empty($Apost->profileimage_id)) { echo IMAGE_URL.'../uploads/' . $Apost->profileimage_id; } else { echo IMAGE_URL.'06homepost-logindesktop-img-0981BB34-9E59-49F3-880E-43C6ACB6DFE8@2x.png'; }?>" alt="<?= $Apost->profileimage_id;?>" class="mr-3 mt-3 avatar" style="width:60px;">&nbsp;&nbsp;<?php if(!empty($Apost->first_name)) { echo ucfirst($Apost->first_name.' '.$Apost->last_name); } ?></a>
    <div class="media-body">
      <!-- <h6><?php if(!empty($Apost->first_name)) { echo ucfirst($Apost->first_name.' '.$Apost->last_name); } ?> </h6> -->
      <p><small><?= $strMP;?></small></p>      
    </div>
  </div>
</div>
 <hr>
    <div class="p-3 FHText" style="padding-top:5px;"><b>MOST ACTIVE CATEGORIES</b></div> 
     <div class="col-md-12 p-1">  
  <?php foreach($categories as $categoriesRows) { ?>    
    <p style="color: black;"><b><?= $categoriesRows->category_name;?></b></p>
    <?php } ?>
  </div>  
    </div>
  </div>
</div>
<?php $this->load->view('common/footer'); ?>

<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
<script>
  var arr = [];
  for (let i = 1; i < 200; i++) {
   
    CKEDITOR.replace( 'editor'+ i );
     
      arr.push(i);
   
 }  
  console.log(arr);
function ckVal(value)
{
  //alert(value); return false;
  var messageLength = CKEDITOR.instances['editor'+ value].getData();
  //alert(messageLength); return false;
  if(messageLength == "") {
                alert('Please enter reply post'); return false;
                //e.preventDefault();     
          } 
   else {
    
    return true;
   }                 
  
}
</script>
<script>
 /*$(document).ready(function(){
   // alert("pp"); return false;
  $(".heart").click(function(){
    //alert("heart");
    if($(".heart").hasClass("liked")){
      $(".heart").html('<span class="badge-danger lcount"><?= $likes;?></span><i class="fa fa-heart-o" style="font-size: 24px;"></i>');
      $(".heart").removeClass("liked");
    }else{
      $(".heart").html('<span class="badge-danger lcount"><?= $likes;?></span><i class="fa fa-heart" style="font-size: 24px;"></i>');
      $(".heart").addClass("liked");
    }
  });
});*/
function LIKdd(likes)
{
    //alert(likes); return false;
    if($(".heart"+likes).hasClass("liked")){
     // alert("hello");
      $(".heart"+likes).html('<span class="badge-danger lcount">0</span><i class="fa fa-heart-o" style="font-size: 24px;"></i>');
      $(".heart"+likes).removeClass("liked");
    }else{
      $(".heart"+likes).html('<span class="badge-danger lcount">0</span><i class="fa fa-heart" style="font-size: 24px;"></i>');
      $(".heart"+likes).addClass("liked");
      var datastring = 'forumID='+likes;
      $.ajax({
            type: "POST",
            url: "<?= site_url('Forum/likesCount');?>",
            data: datastring,
            cache: false,
            success: function(html){
              location.reload();
              //alert(html); return false;
              //$("#results").append(html);
            }
});
    }
}
function shareData(shareID) 
{
  $('#shareModal').modal('show');
  var datastring = 'forumID='+shareID;
  $.ajax({
            type: "POST",
            url: "<?= site_url('Forum/shareForum');?>",
            data: datastring,
            cache: false,
            success: function(html){
             // location.reload();
              //alert(html); return false;
              $("#shareRusult").empty();
              $("#shareRusult").append(html);
            }
            });
 // alert(shareID); return false;

} 
</script>

<style type="text/css">
  .cursor-pointer{
  cursor: pointer;
}
.fa {
  padding: 20px;
  font-size: 30px;
  width: 50px;
  text-align: center;
  text-decoration: none;
  /*margin: 5px 2px;*/
}

.fa:hover {
    opacity: 0.7;
}

.fa-facebook {
  background: #3B5998;
  color: white;
}

.fa-twitter {
  background: #55ACEE;
  color: white;
}

.fa-google {
  background: #dd4b39;
  color: white;
}

.fa-linkedin {
  background: #007bb5;
  color: white;
}

.fa-youtube {
  background: #bb0000;
  color: white;
}

.fa-instagram {
  background: #125688;
  color: white;
}

.fa-pinterest {
  background: #cb2027;
  color: white;
}

.fa-snapchat-ghost {
  background: #fffc00;
  color: white;
  text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
}

.fa-skype {
  background: #00aff0;
  color: white;
}

.fa-android {
  background: #a4c639;
  color: white;
}

.fa-dribbble {
  background: #ea4c89;
  color: white;
}

.fa-vimeo {
  background: #45bbff;
  color: white;
}

.fa-tumblr {
  background: #2c4762;
  color: white;
}

.fa-vine {
  background: #00b489;
  color: white;
}

.fa-foursquare {
  background: #45bbff;
  color: white;
}

.fa-stumbleupon {
  background: #eb4924;
  color: white;
}

.fa-flickr {
  background: #f40083;
  color: white;
}

.fa-yahoo {
  background: #430297;
  color: white;
}

.fa-soundcloud {
  background: #ff5500;
  color: white;
}

.fa-reddit {
  background: #ff5700;
  color: white;
}

.fa-rss {
  background: #ff6600;
  color: white;
}
.lcount{
  position: absolute;
    padding-left: 46px;
    padding-top: 10px;
    color: red;
}
</style>
<!-- Modal -->
<div class="modal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="width:300px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Share Social Media</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="shareRusult">
       
      </div>
      </div>
  </div>
</div>