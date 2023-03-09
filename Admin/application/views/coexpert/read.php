<?php $this->load->view('includes/header');$this->load->view('includes/left_panel');?>
	<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
			<?= $heading;?>       
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?= site_url('Cexperts/index');?>">Consortium of Experts List</a></li>
        <li class="active"><?= $heading;?></li>
      </ol>
    </section>
    <section class="content">
      <div class="box box-primary">
        <div class="box-header">
          
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
        <div class="col-md-12">
       <div class="col-md-6">   
        <div class="form-group">
        <label>UUID:</label>
        <span><?= $rowsData->uuid;?></span>
      </div>
        </div>
        <div class="col-md-6">
        <div class="form-group">   
        <label>Expert Name:</label>
        <span><?= $rowsData->expert_name;?></span>
        </div>     
            </div>
        </div>    
            <div class="col-md-12">
       <div class="col-md-6">   
        <label>Expert Detail:</label>
        <span><?= $rowsData->expert_details;?></span>
        </div>
        <div class="col-md-6">   
        <label>Expert Category:</label>
        <span><?= ucfirst($rowsData->expert_category);?></span>
        </div>     
            </div>
            <div class="col-md-12">
       <div class="col-md-6">   
        <label>Specialization:</label>
        <span><?= ucfirst($rowsData->specialization);?></span>
        </div>
       <div class="col-md-6">   
        <label>Qualification:</label>
        <span><?= ucfirst($rowsData->Qualification);?></span>
        </div>
            </div>
        <div class="col-md-12">
       <div class="col-md-6">   
        <label>Publication URL:</label>
        <span><?= ucfirst($rowsData->Publication_ur);?></span>
        </div>
       <div class="col-md-6">   
        <label>User UUid:</label>
        <span><?= $rowsData->User_UUid;?></span>
        </div>
            </div>   
       </div>
    </div>
    </section>
</div>
<?php  $this->load->view('includes/footer');?>
<script type="text/javascript">
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
        }else{
          if(video=="")
          {
            $("#errVideo").html("Please select video");
            setTimeout(function(){$("#errVideo").html('');},9000);
            $("#video").focus();
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