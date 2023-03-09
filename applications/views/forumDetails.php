<?php $this->load->view('common/header'); ?> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/solid.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style type="text/css">
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
.replyText{
  margin-left: 66px;margin-top:-45px;
}
.FHText{
  letter-spacing: 0.88px;line-height: 21px;
}
.lcount{
  position: absolute;
    padding-left: 46px;
    padding-top: 10px;
    color: red;
}
</style>
<?php if(empty($data->like_no))
{
  $likes = 0;  
}
else {
  $likes = $data->like_no;
} ?>
<div class="col-md-12">
    <div class="row page-header">
        <h1 class="display-6" style="color:white;">Welcome to Forum Detail</h1>
    <p style="color:white;"><b>The IBIS community is abuzz with exchanges that promote research, conservation, and education. You are welcome to share your thoughts.</b></p>
    </div>    
</div>
  <div class="col-md-12 px-5 py-3">
  <div class="sub-menu-R9LRwb">
          <a href="<?= site_url('Forum/index');?>"><span class="feed-tEk0wt" style="font-size: 20px;">Feed</span></a>
          <a href="<?= site_url('Forum/categories');?>"><span class="categories-tEk0wt p-5" style="font-size: 20px;">Categories</span></a>
          <a href="<?= site_url('Forum/myPost');?>"><span class="my-posts-tEk0wt p-4" style="font-size: 20px;">My Posts</span></a>
          <hr style="border-top:3px solid;">
        </div>
   </div>
   <div class="container-fluid col-md-12">
    <div class="col-md-12">
   <div class="row">    
     <div class="col-md-12 ml-3 p-2" style="background-color:white;">  
    <div class="col-md-12">
     <div class="row">
      <div class="col-md-10">
  <i class="fa fa-plus" aria-hidden="true" style="position: absolute;margin-left: 35px;padding-top: 32px;
    color: white;"></i> 
      <a href="<?= site_url('Visitors/profile/'.$data->user_uuid);?>"><img class="avatar" style="height:52px;width: 52px;" src="<?php if(!empty($data->profileimage_id)) { echo IMAGE_URL.'../uploads/' . $data->profileimage_id; } else { echo IMAGE_URL.'06homepost-logindesktop-img-0981BB34-9E59-49F3-880E-43C6ACB6DFE8@2x.png'; }?>"></a>
<span style="font-size:15px;position: absolute;padding-top:5px;margin-left:6px;"><b><?php if(!empty($data->first_name)) { echo ucfirst($data->first_name.' '.$data->last_name); } ?></b></span>
<span class="ml-3 profText"><span class="text-muted"><?php if($getTdiffD!=0) { echo $getTdiffD.' days';} ?> <?php if($getTdiffH!=0) { echo $getTdiffH.' hours';} ?>  <?= $getTdiffM.' minutes'; ?> ago posted in </span><span style="font-size:15px;"></span></span> 
</div>
<div class="col-md-2"><span class="col-md-12 heart<?php echo $data->forum_id;?>" onclick="LIKdd('<?php echo $data->forum_id;?>')"><span class="badge-danger lcount"><?= $likes;?></span><i class="fa fa-heart-o" style="font-size:24px;">&nbsp;</i></span><span class="col-md-8 another-element" id="shareBtn" onclick= "shareData('<?php echo $data->forum_id;?>');"><i class="fa fa-share-alt" style="font-size:24px;" data-bs-toggle="modal" data-bs-target="#exampleModal">&nbsp;</i></span>
</div>
</div>
<div class="col-md-12">
<h5 style="color: black;padding-top:30px"><b><?php if(!empty($data->subject)) { echo $data->subject; }?></b></h5>
</div>
<div class="col-md-12 container-fluid"><div class="row">
  <?php foreach($getMedia as $getMediaRows) {
 if($getMediaRows->discussions_media_type=='image') {
  ?>   
  <div class="col-md-6 card-body">
  <img src="<?php if(!empty($getMediaRows->discussion_media_url)) { echo IMAGE_URL.'../img/forum/fmedia/'.$getMediaRows->discussion_media; } else { echo IMAGE_URL.'../uploads/Banner_02.jpg'; } ?>"  class="img-fluid rounded"></div>
  <?php } elseif($getMediaRows->discussions_media_type=='video' || $getMediaRows->discussions_media_type=='audio') { ?>
 <div class="col-md-6 card-body">  
<video  class="img-fluid rounded" controls  style="width: 100%;">
<source src=<?php if(!empty($getMediaRows->discussion_media_url)) { echo IMAGE_URL.'forum/fmedia/'.$getMediaRows->discussion_media; } else { echo IMAGE_URL.'../uploads/Banner_02.jpg'; } ?> type=video/mp4>
</video>
</div>
<?php } } ?> 
</div>
</div>

<div class="col-md-12 card-body">
<p><?php if(!empty($data->text_msg)) { echo $data->text_msg; }?></p>
</div>
  <?php if(!empty($getReply)) { 
foreach($getReply as $getReplyRows) {  
  ?>  
 <div class="container mt-2" >
  <div class="media border p-3">
    <img src="<?php if(!empty($getReplyRows->profileimage_id)) { echo IMAGE_URL.'../uploads/' . $getReplyRows->profileimage_id; } else { echo IMAGE_URL.'06homepost-logindesktop-img-0981BB34-9E59-49F3-880E-43C6ACB6DFE8@2x.png'; }?>" alt="<?= $getReplyRows->profileimage_id;?>" class="mr-3 mt-3 avatar" style="width:60px;">
    <div class="media-body">
      <h5><?= ucfirst($getReplyRows->first_name.' '.$getReplyRows->last_name);?> <small><i>Posted on <?= date('M d Y' ,strtotime($getReplyRows->date_time))?></i></small></h5>
      <p><?= strip_tags($getReplyRows->text_msg); ?></p>      
    </div>
  </div>
</div>
 <?php } } else { ?> 
 <div class="col-md-12 card-body">
  <span>No Reply Founded..</span>
</div>
<?php } ?>
<div class="col-md-12 card-body">
<span style="color: black;"><b>Replies: <?= count($getReply);?></b><span>
<?php if(!empty($_SESSION[SESSION_NAME]['user_uuid'])) { ?>  
<div class="col-md-12 card-body">
  <form  action="<?= site_url('Forum/replyAction/'.$data->forum_id);?>"  method="POST" enctype="multipart/form-data">
  <h6><u>POST REPLY</u></h6>
  <div class="rows form-group">
     <textarea id="editor" name="reply" required></textarea> 

</div>
<div class="mb-3 form-group">
    <label for="exampleInput"><h6>Attachment</h6></label>
    <div class="file-loading">
    <input type="file" name="media[]" multiple accept="image/png, image/gif, image/jpeg, video/mp4" id="attachmentD" class="form-control form-control-lg">
    <span id=""></span>
    </div>
  </div>
  <button type="submit" class="btn btn-dark" style="float: right;" onclick="return ckVal();">REPLY</button>
 </form> 
</div>
<?php } ?>  
</span></div>
    </div >
  </div>
  
    </div>
  </div>
</div>
<?php $this->load->view('common/footer'); ?>
<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'editor' );

function ckVal()
{
  //alert(value); return false;
  var messageLength = CKEDITOR.instances['editor'].getData();
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
    if($(".heart").hasClass("liked")){
      $(".heart").html('<i class="fa fa-heart-o" style="font-size: 24px;"></i>');
      $(".heart").removeClass("liked");
    }else{
      $(".heart").html('<i class="fa fa-heart" style="font-size: 24px;"></i>');
      $(".heart").addClass("liked");
    }
  });
});*/
  function LIKdd(likes)
{
    //alert(likes); return false;
    if($(".heart"+likes).hasClass("liked")){
     // alert("hello");
      $(".heart"+likes).html('<span class="badge-danger lcount"><?= $likes;?></span><i class="fa fa-heart-o" style="font-size: 24px;"></i>');
      $(".heart"+likes).removeClass("liked");
    }else{
      $(".heart"+likes).html('<span class="badge-danger lcount"><?= $likes;?></span><i class="fa fa-heart" style="font-size: 24px;"></i>');
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
  margin: 5px 2px;
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
</style>
<!-- Modal -->
<div class="modal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="width:320px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Share Social Media</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="shareRusult">
      <!--  <a href="http://www.facebook.com/sharer.php?u=<?= site_url();?>" target="_blank();" class="fa fa-facebook p-3"></a>
<a href="http://twitter.com/share?url=<?= site_url();?>&text=Simple Share Buttons&hashtags=simplesharebuttons" target="_blank();" class="fa fa-twitter p-3"></a>
<a href="https://plus.google.com/share?url=<?= site_url();?>" target="_blank" class="fa fa-google p-3"></a>
<a href="http://www.linkedin.com/shareArticle?mini=true&url=<?= site_url();?>" target="_blank" class="fa fa-linkedin p-3"></a>
<a href="https://www.instagram.com/?url=<?= site_url();?>" target="_blank" class="fa fa-instagram"></a> -->
      </div>
      </div>
  </div>
</div>