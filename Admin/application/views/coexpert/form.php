<?php 
//print_r($error);exit;
$this->load->view('includes/header');
$this->load->view('includes/left_panel');
?>
	<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
			<?= $heading;?>       
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?= site_url('Banners/index');?>">Consortium of Experts List</a></li>
        <li class="active"><?= $heading;?></li>
      </ol>
    </section>

    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-primary">
        <div class="box-header">
          <!-- <center>
                <?php if($this->session->userdata('message')) { ?><span style="color:red;" id="hide"><?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : '';?></span><?php } ?>
          </center> -->
          <h3 class="box-title"></h3>

          <div class="box-tools pull-right">
            <a href="<?= site_url('Cexperts/index');?>">
            	<button class="btn btn-danger" title="Back Button"><i class="glyphicon glyphicon-arrow-left"></i></button>
            </a>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
          	<form method="POST" action="<?= $action;?>" enctype="multipart/form-data">
            <div class="col-md-6">

            	<!-- Title -->
	            <div class="form-group">
	                <label for="title">Name <span class="red"></span></label>
	         <input type="text" class="form-control" id="name" name="name" value="<?= $name;?>" placeholder="Enter name"required="required">
	                <span style="color:red" id="errTitle"><?= form_error('name');?></span>
	            </div>
	            <!-- Image -->
              <div id="divImage">
	            <div class="form-group">
	            	<label for="image">Image <span class="red"></span></label>
	            	<input type="file" name="image" id="image" class="form-control">
	            	<span style="color:red" id="errImage">
                <?php if($error){ echo $error;} ?>
                </span>
	            	<?php if($button=='Update'){ ?>
	            		<br>
	            		<img src="<?php echo base_url('../var/wwww/html/ibis/FESADMIN/uploads/'.$image)?>" alt="img" height="100px" width="100px">
	            	<?php } ?>
	            </div>
              </div>    
               <div class="form-group">
                  <label for="title">Education <span class="red"></span></label>
                  <input type="text" class="form-control" id="education" name="education" value="<?= $education;?>" placeholder="Enter education">
                  <span style="color:red" id="errTitle"><?= form_error('education');?></span>
              </div> 
                      <div class="form-group">
                  <label for="title">Designation <span class="red"></span></label>
                  <input type="text" class="form-control" id="designation" name="designation" value="<?= $designation;?>" placeholder="Enter designation">
                  <span style="color:red" id="errTitle"><?= form_error('education');?></span>
              </div> 
              <div class="form-group">
                  <label for="title">Facebook URL <span class="red"></span></label>
                  <input type="text" class="form-control" id="facebook_url" name="facebook_url" value="<?= $facebook_url;?>" placeholder="Enter facebook url">
                  <span style="color:red" id="errTitle"><?= form_error('facebook_url');?></span>
              </div>   
              <div class="form-group">
                  <label for="title">Twitter URL <span class="red"></span></label>
                  <input type="text" class="form-control" id="twiter_url" name="twiter_url" value="<?= $twiter_url;?>" placeholder="Enter twiter url">
                  <span style="color:red" id="errTitle"><?= form_error('twiter_url');?></span>
              </div>   
              <div class="form-group">
                  <label for="title">LinkedIn URL <span class="red"></span></label>
                  <input type="text" class="form-control" id="linkin_url" name="linkin_url" value="<?= $linkin_url;?>" placeholder="Enter linkin url">
                  <span style="color:red" id="errTitle"><?= form_error('linkin_url');?></span>
              </div>         
              	<!-- Status  -->
	            <!-- <div class="form-group">
	            	<label for="status">Status</label>
	            	<select class="form-control" id="status" name="status">
	            		<option value="Active"  <?php if($status=='Active'){ echo 'selected';}?>>Active</option>
	            		<option value="Inactive" <?php if($status=='Inactive'){ echo 'selected';}?>>Inactive</option>
	            	</select>
	            </div> -->

            </div>
            <div class="col-md-12">
            	<input type="hidden" name="id" value="<?= $id?>">
            	<button class="btn btn-primary" type="submit" onclick="return checkValidates();"><?= $button;?></button>
            	<a href="<?= site_url('Cexperts /index');?>"><button class="btn btn-danger" type="button">Cancel</button></a>
            </div>
        </div>
      	</form>
    
       </div>
    </div>
    <!-- /.box -->

     

    </section>
    <!-- /.content -->
</div>

<?php 
  $this->load->view('includes/footer');
?>
<script src="<?= base_url();?>assets/bower_components/ckeditor/ckeditor.js"></script>
<script>

  $(function () { 
    CKEDITOR.replace('description')
  })

</script>
<script>
  <?php if($button=="Update"){ 
      if($type =='Image'){
    ?>
  $( document ).ready(function() {  //alert('image');
    $('#clickImg').click();
    });
<?php } else { ?>
  $( document ).ready(function() {  //alert('vid');
    $('#clickVid').click();
    });
  <?php } } else { ?>
  $( document ).ready(function() { //alert('nutral');
    $('#clickImg').click();
    });
<?php } ?>

  function mediaType(type)
  {
    if(type=='Image')
    {
      $('#divImage').show();
      $('#divVideo').hide();
    }
    else
    {
      $('#divImage').hide();
      $('#divVideo').show();
    }
  }
  


	function checkValidates()
	{
		var title=$('#title').val();
		var description=$('#description').val();
    var type =$('#type').val();
		var image =$('#image').val();
    var video =$('#video').val();

		var description = CKEDITOR.instances['description'].getData(); 
    //alert(title);return false;

		if(title=="")
    	{
	      
	      $("#errTitle").html("Please enter title");
	      setTimeout(function(){$("#errTitle").html('');},9000);
	      $("#title").focus();
	      return false;
    	}

    <?php if($button=='Create') { 
      ?>
      
      if(type=='Image')
      {
    		if(image=="")
        	{
    	      
    	      $("#errImage").html("Please select image");
    	      setTimeout(function(){$("#errImage").html('');},9000);
    	      $("#image").focus();
    	      return false;
        	}
        }
    <?php } ?>

    	if(description=="")
    	{
	      $("#errDecription").html("Please enter description");
	      setTimeout(function(){$("#errDecription").html('');},9000);
	      $("#description").focus();
	      return false;
    	}
    	
	}
</script>
<script type="text/javascript">
   $("#image").change(function() {
   //alert("hi");return false;
   var val = $(this).val();
   
   switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
   case 'png': case 'PNG': case 'JPG': case 'jpg': case 'JPEG': case 'jpeg':  case 'gif':
           //alert("an image");
           break;
           default:
           $(this).val('');
           // error message here
           $("#errImage").fadeIn().html("This file type is not allowed.");
           setTimeout(function(){$("#errImage").html("&nbsp;");},5000);
          // alert("This is Not a valid Image");
          break;
      }
   });
</script>