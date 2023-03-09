 <?php $this->load->view('includes/header');
$this->load->view('includes/left_panel');
?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Change Password    
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= site_url('Dashboard');?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Change Password</li>
      </ol>
    </section>

    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-primary">
        <div class="box-header">
           <span class="red">* All fields are mandatory. </span>
          <h3 class="box-title"></h3>

          <div class="box-tools pull-right">
            <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> -->
            <a href="<?= site_url('Dashboard');?>">
              <button class="btn btn-danger" title="Back Button"><i class="glyphicon glyphicon-arrow-left"></i></button>
            </a>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <form method="POST" action="<?= site_url('Welcome/update_password');?>" enctype="multipart/form-data">
            <div class="col-md-6">

            <span class="red" id="errormsg">
                <?php if($this->session->userdata('message')) { ?><span class="red" id="hide"><?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : '';?></span><?php } ?>
            </span>
                      <div class="form-group">   
                  <!-- <label for="opassword">Old Password <span class="red">*</span></label> -->
                   <input type="password" class="form-control" placeholder="Enter Old Password" name="opassword" id="opassword">
                    
                   </div>
                   <div class="form-group">   
                  <!-- <label for="npassword">New Password <span class="red">*</span></label> -->
                    <input type="password" class="form-control" placeholder="Enter New Password" name="npassword" id="npassword">
                    
                   </div>
                   <div class="form-group">   
                  <!-- <label for="opassword">Old Password <span class="red">*</span></label> -->
                   <input type="password" class="form-control" placeholder="Enter Confirm Password" name="cpassword" id="cpassword">
                    
                   </div>
                  <div class="form-group"> 
                  <button type="submit" class="btn btn-primary  btn-flat" onclick ="return validation();">Submit</button>
              <a href="<?= site_url('Dashboard');?>"><button class="btn btn-danger" type="button">Cancel</button></a>
            </div>
            <!-- /.col -->
          </div>
        </form>
        <!-- /.row -->
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
 
 
<script type="text/javascript">
    function validation()
    {

      var oldpassword=$("#opassword").val();
       //alert(oldpassword);return false;
      var npassword=$("#npassword").val();
      var cpassword=$("#cpassword").val();
 
  
        if(oldpassword=="")
        {
         // alert(oldpassword);return false;
          $("#errormsg").html("Please enter old password");
          setTimeout(function(){$("#errormsg").html('');},9000);
          $("#opassword").focus();
          return false;
        }
       if(npassword=="")
        {
          $("#errormsg").html("Please enter new password");
          setTimeout(function(){$("#errormsg").html('');},9000);
          $("#npassword").focus();
          return false;
        }
         if(cpassword=="")
        {
          $("#errormsg").html("Please enter confirm password");
          setTimeout(function(){$("#errormsg").html('');},9000);
          $("#cpassword").focus();
          return false;
        }
            }
</script>

  