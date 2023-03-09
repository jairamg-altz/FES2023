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
</style>  
<div class="col-md-12">
    <div class="row page-header">
        <h1 class="display-6">Create Post</h1>
    <p>Share your ideas, finding, or questions with the community.</p>    
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
   <div class="container-fluid">
     <div class="col-md-12">
   <div class="row"> 
   <div class="col-md-9">   
   <div class="flex-row-3">
              <div class="overlap-group5">
               <form action="<?= site_url('Forum/CreatePostAction');?>" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
    <label for="exampleInputtext" class="form-label"><h6>Categories <span style="color:red;">*</span></h6></label>
    <select name="categories" class="form-control" required>
      <option value="">Select Category</option>
    <?php foreach($categories as $categoriesRows) { ?>  
      <option value="<?= $categoriesRows->category_name; ?>"><?= $categoriesRows->category_name; ?></option>
    <?php } ?>  
    </select>    
  </div>
  <div class="mb-3 form-group">
    <label for="exampleInputtext" class="form-label"><h6>Title <span style="color:red;">*</span></h6></label>
    <input type="text" class="form-control"  placeholder="Enter Title" name="title" required>    
  </div>
  <div class="mb-3 form-group">
    <label for="exampleInputtext" class="form-label"><h6>Attachment Type <span style="color:red;">*</span></h6></label>
    <select class="form-control" name="attachment_type"> 
      <option value="">Select Attachment Type</option>
      <option value="image">Image</option>
      <option value="video">Video</option>
      <option value="audio">Audio</option>
    </select>    
  </div>
  <div class="mb-3 form-group">
    <label for="exampleInput"><h6>Attachment</h6></label>
    <div class="file-loading">
    <input type="file" name="media[]" multiple  id="attachmentD">
    </div>
  </div>
  <div class="mb-3 form-group">
    <label for="exampleInputDescription" class="form-label"><h6>Description <span style="color:red;">*</span></h6></label>
     <div class="">
      <textarea id="editor" name="text_msg" required></textarea>
            </div>
  </div>
  <div class="group-2" style="float: right;"><div class="publish"><button class="btn btn-primary">PUBLISH</button></div></div>
</form>       
</div>              
          </div>  
   </div>
   <div class="col-md-3">
     <p>01. IBIS’s Forums and Blogs aim enable information sharing.</p>
     <p>02. The singular objective is to foster knowledge partnerships among
IBIS users.</p>
     <p>03. All users are welcome here, including contributors, students,
scientists, teachers, community members, or citizen scientists.</p>
     <p>04. IBIS requests users to communicate in a spirit of cooperation and
maintain scientific temper at all times.</p>
     <p>05. It is mandatory that everyone remains respectful to fellow users
at all times and in every communication.</p>

   </div>     
 </div>
</div>
</div>
<?php $this->load->view('common/footer'); ?>
<script type="text/javascript">
   $("#attachmentD").change(function() {
   //alert("hi");return false;
   var val = $(this).val();
   
   switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
   case 'png': case 'PNG': case 'JPG': case 'jpg': case 'JPEG': case 'jpeg':  case 'MP4': case'mp4': case 'WMV': case'wmv':
           //alert("an image");
           break;
           default:
           $(this).val('');
           // error message here
           $("#errImage").fadeIn().html("This file type is not allowed.");
           setTimeout(function(){$("#errImage").html("&nbsp;");},5000);
          alert("This is Not a valid media");
          break;
      }
   });
</script>
<script type="text/javascript">
  $(function() {
    // Multiple images preview in browser
    var imagesPreview = function(input, placeToInsertImagePreview) {

        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    $($.parseHTML('<img class="img-thumbnail" style="width:120px;height:80px;">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                }

                reader.readAsDataURL(input.files[i]);
            }
        }

    };

    $('#gallery-photo-add').on('change', function() {
        imagesPreview(this, 'div.gallery');
    });
});
</script> 
<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'editor' );
</script>