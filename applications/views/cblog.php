<?php $this->load->view('common/header'); ?>
<style type="text/css">
.page-header {
        background-image: linear-gradient(135deg, #31b551 0%, #2249a7 100%);
        min-height: 250px;
        margin-top: 110px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 20px 70px;
        color: #fff;
    }    
</style>
<section class="p-0">
    <div class="col-md-12 page-header">
        <h1 class="display-4">Create Blog</h1>
        <p class="fs-4 text-mute">Welcome to Blog The IBIS community is abuzz with exchanges that promote research, conservation, and education. You are welcome to share your thoughts.</p>
    </div>
</section>
<section>
    <div class="container-fluid">
        <h1>Create Blog</h1> 
 <div class="col-md-12"> 
<div class="row">
<form method="POST" action="<?= site_url('Dashboard/createBlogAction');?>" enctype="multipart/form-data">
  <div class="form-group col-md-12">
    <label for="exampleInputEmail1">Title <span style="color:red;">*</span></label>
    <input type="text" class="form-control" name="title"  placeholder="Enter Title" required>
  </div>
  <div class="form-group col-md-12">
    <label for="exampleInput">Images</label>
    <div class="file-loading">
    <input type="file" name="media[]" multiple  id="attachmentD">
    <div class="gallery"></div>
</div>
  </div>
  <div class="form-group col-md-12">
    <label for="exampleInputPassword1">Description</label>
    <textarea id="editor"name="description" required></textarea>
  </div><br>
  <div class="form-group col-md-12">
    <label>Is Blog Public</label>
    <select class="form-control" name="is_blog_public">
      <option value="Yes">Yes</option>
      <option value="No">No</option>
    </select>
  </div><br>
  <button type="submit" class="btn btn-primary" name="submit">Submit</button>
</form>
    </div>
  </div>
</div>
</section> 
<?php $this->load->view('common/footer'); ?>
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
<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'editor');
</script>