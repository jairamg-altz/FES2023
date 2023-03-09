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
  .fa-heart-o {
  /*color: red;*/
  cursor: pointer;
}

.fa-heart {
  color: red;
  cursor: pointer;
}
/*.avatar {
  vertical-align: middle;
  width: 50px;
  height: 55px;
  border-radius: 50%;
}*/
@media only screen and (min-width: 768px) {
  /* For desktop: */
  .col-1 {width: 8.33%;}
  .col-2 {width: 16.66%;}
  .col-3 {width: 25%;}
  .col-4 {width: 33.33%;}
  .col-5 {width: 41.66%;}
  .col-6 {width: 50%;}
  .col-7 {width: 58.33%;}
  .col-8 {width: 66.66%;}
  .col-9 {width: 75%;}
  .col-10 {width: 83.33%;}
  .col-11 {width: 91.66%;}
  .col-12 {width: 100%;}
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
}
.textDec{
  color: var(--black);
  font-family: var(--font-family-poppins);
  font-size: var(--font-size-l);
  font-style: normal;
  font-weight: 500;
}
body {
    max-width: 100%;
    overflow-x: hidden;
}
.avatarDD{
    vertical-align: middle;
  width: 50px;
  height: 50px;
  border-radius: 50%;
}
.cursor-pointer{
  cursor: pointer;
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
 /* $(document).ready(function(){
   // alert("pp"); return false;
  $(".heart").click(function(){
    if($(".heart").hasClass("liked")){
      $(".heart").html('<span class="badge-danger lcount">0</span><i class="fa fa-heart-o" style="font-size: 24px;"></i>');
      $(".heart").removeClass("liked");
    }else{
      $(".heart").html('<span class="badge-danger lcount">0</span><i class="fa fa-heart" style="font-size: 24px;"></i>');
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
      var datastring = 'blogpost_id='+likes;
      $.ajax({
            type: "POST",
            url: "<?= site_url('Dashboard/likesCount');?>",
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
  var datastring = 'blogpost_id='+shareID;
  $.ajax({
            type: "POST",
            url: "<?= site_url('Dashboard/shareForum');?>",
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
<div class="col-md-12">
    <div class="row page-header">
        <h1 class="display-6">Welcome to Blog</h1>
    <p><b>The IBIS community is abuzz with exchanges that promote research, conservation, and education. You are welcome to share your thoughts.</b></p>  
    <div><a href="<?= site_url('Dashboard/createBlog');?>"><button class="btn btn-dark rounded"  style="border-radius:4px;float: right;">Create Blog</button></a></div>  
    </div>
</div>
<div class="container-fluid p-5">
  <div class="col-md-12">
    <div class="row">
      <div class="col-md-8">
<?php $srNo=1; $date1 = new DateTime(date('Y-m-d H:i:s')); 
foreach ($blog as $key => $value) { 
$getMedia = $this->Crud_model->GetData('blog_medias','',"blog_activity='post' and blog_id='".$value->blogpost_id."'",'','','1'); 
//print_r($getMedia);
$date2 = new DateTime($value->blog_post_timestamp);
$interval = date_diff($date1, $date2);
$getTdiffD = $interval->format("%d");
$getTdiffH = $interval->format("%h");
$getTdiffM = $interval->format("%i");
if (strlen($value->blog_body) > 250) {
   $str = substr($value->blog_body, 0, 230) . '...';
}
if(empty($value->likes))
{
  $likes = 0;  
}
else {
  $likes = $value->likes;
} 
  ?>       
<h4><?php if(!empty($value->blog_title)) { echo ucfirst($value->blog_title); } ?></h4>
<div class="p-3"><img class="avatarDD" src="<?php if(!empty($value->profileimage_id)) { echo IMAGE_URL.'../uploads/' . $value->profileimage_id; } else { echo IMAGE_URL.'06homepost-logindesktop-img-0981BB34-9E59-49F3-880E-43C6ACB6DFE8@2x.png'; }?>"><span class="textDec p-2">
By <?php if(!empty($value->first_name)) { echo ucfirst($value->first_name.' '.$value->last_name); } ?>
</span><span class="text-muted"><?php if($getTdiffD!=0) { echo $getTdiffD.' days';} ?> <?php if($getTdiffH!=0) { echo $getTdiffH.' hours';} ?>  <?= $getTdiffM; ?> minutes ago posted in</span>
<div style="margin-left:80%;"><span class="heart<?php echo $value->blogpost_id;?>" onclick="LIKdd('<?php echo $value->blogpost_id;?>')"><span class="badge-danger lcount"><?= $likes;?></span><i class="fa fa-heart-o p-3" style="font-size: 24px;"></i></span><span onclick= "shareData('<?php echo $value->blogpost_id;?>');"><i class="fa fa-share-alt p-3 cursor-pointer" style="font-size: 24px;" data-bs-toggle="modal" data-bs-target="#exampleModal"></i></span></div>
</div>
<div class="col-md-12">
<?php foreach($getMedia as $getMediaRows) {
 if($getMediaRows->blog_media_type=='image') {
  ?>    
<div class="row card-body">
    <img src="<?php if(!empty($getMediaRows->blog_media_url)) { echo IMAGE_URL.'blog/'.$getMediaRows->blog_media; } else { echo IMAGE_URL.'../uploads/Banner_02.jpg'; } ?>" class="img-fluid img-thumbnail rounded" style="width:850px;height: 500px;">
  </div>
  <?php } elseif($getMediaRows->blog_media_type=='video' || $getMediaRows->blog_media_type=='audio') { ?>
 <div class="row card-body">
    <video  class="img-fluid rounded" controls>
<source style="width:850px;height: 500px;" src=<?php if(!empty($getMediaRows->blog_media_url)) { echo IMAGE_URL.'blog/'.$getMediaRows->blog_media; } else { echo IMAGE_URL.'../uploads/Banner_02.jpg'; } ?> type=video/mp4>
</video>
  </div>
  <?php } } ?>     
</div>  
<div class="col-md-12">
<div class="card-body"><p class="p-3"><?php if(!empty($value->blog_body)) { echo $str; }?><a href="<?= site_url('Dashboard/BlogDetail/'.$value->blogpost_id);?>"><span><u>Read More...</u></span></a></p></div>
</div>
<?php $srNo++; } ?>
      </div>
  <div class="col-md-4 container-fluid">
    <h6>Most Recent</h6>
    <div class="col-md-12 p-3">
      <div class="card-body"></div>
      <?php if($getDMedia->blog_media_type=='image') { ?>
      <img src="<?php if(!empty($getDMedia->blog_media_url)) { echo $getDMedia->blog_media_url; } else { echo IMAGE_URL.'../uploads/Banner_02.jpg'; } ?>" style="width:120px;height:120px;border-radius:15px;">
    <?php } ?>
      <span style="text-align:justify-all;position: absolute;" class="p-2 word-wrap"><?= substr($blogDRows->blog_body, 0,85); ?></span>
<span style="position: relative;"><img class="avatarDD" src="<?php if(!empty($blogDRows->profileimage_id)) { echo IMAGE_URL.'../uploads/' . $blogDRows->profileimage_id; } else { echo IMAGE_URL.'06homepost-logindesktop-img-0981BB34-9E59-49F3-880E-43C6ACB6DFE8@2x.png'; }?>"><span class="textDec p-2">
By <?php if(!empty($blogDRows->first_name)) { echo ucfirst($blogDRows->first_name.' '.$blogDRows->last_name); } ?></span></span>
</div> 
 
<div class="col-md-12 p-3">
  <h6>Most Trending Post</h6>
</div>  
<div class="container-fluid">
 <div class="col-md-12">
   <div class="row">
 <div class="col-md-6">
   <div class="card-body">
     <img src="<?= IMAGE_URL.'../uploads/Banner_02.jpg';?>" style="width:120px;height:120px;border-radius:15px;">
     <span>Birds’ dazzling iridescence
tied to nanoscale tweak of
feather structure</span>
   </div>
 </div>
  <div class="col-md-6">
   <div class="card-body">
     <img src="<?= IMAGE_URL.'../uploads/Banner_02.jpg';?>" style="width:120px;height:120px;border-radius:15px;">
     <span>Birds’ dazzling iridescence
tied to nanoscale tweak of
feather structure.</span>
   </div>
 </div>
   </div>
 </div> 
</div> 
</div>
   </div>
<?php $this->load->view('common/footer'); ?>
<style type="text/css">
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
.lcount{
  position: absolute;
    padding-left: 46px;
    padding-top: 10px;
    color: red;
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
       <!-- <a href="http://www.facebook.com/sharer.php?u=<?= IMAGE_URL.'../uploads/Banner_02.jpg';?>" target="_blank();" class="fa fa-facebook p-3"></a>
<a href="http://twitter.com/share?url=<?= site_url();?>&text=Simple Share Buttons&hashtags=simplesharebuttons" target="_blank();" class="fa fa-twitter p-3"></a>
<a href="https://plus.google.com/share?url=<?= site_url();?>" target="_blank" class="fa fa-google p-3"></a>
<a href="http://www.linkedin.com/shareArticle?mini=true&url=<?= site_url();?>" target="_blank" class="fa fa-linkedin p-3"></a>
<a href="https://www.instagram.com/?url=<?= site_url();?>" target="_blank" class="fa fa-instagram"></a> -->
      </div>
      </div>
  </div>
</div>