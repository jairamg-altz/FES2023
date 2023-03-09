<?php $this->load->view('includes/header');$this->load->view('includes/left_panel');?>
	<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
			<?= $heading;?>       
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?= site_url('Welcome/index');?>">Consortium of Experts List</a></li>
        <li class="active"><?= $heading;?></li>
      </ol>
    </section>
    <section class="content">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title"></h3>
          <div class="box-tools pull-right">
            <a href="<?= site_url('Users/index');?>">
            	<button class="btn btn-danger" title="Back Button"><i class="glyphicon glyphicon-arrow-left"></i></button>
            </a>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
          	<form method="POST" action="<?= $action;?>" enctype="multipart/form-data">
            <div class="col-md-6">
              <div class="form-group">
                  <label for="title">Expert Name <span class="red">*</span></label>
                  <input type="text" name="expert_name" id="expert_name" required="required" value="<?php echo $expert_name; ?>" class="form-control" placeholder="Expert Name" readonly>
                  <span style="color:red" id="errCode"><?= form_error('expert_name');?></span>
              </div>
             
            <div class="form-group">
                  <label for="title">Expert Details <span class="red">*</span></label>
                  <input type="text" name="expert_details" id="expert_details" required="required" value="<?php echo $expert_details; ?>" class="form-control" placeholder="Expert Details">
                  <span style="color:red" id="errCode"><?= form_error('expert_details');?></span>
              </div> 
              <div class="form-group">
                  <label for="title">Expert Category <span class="red">*</span></label>
                  <input type="text" name="expert_category" id="expert_category" required="required" value="<?php echo $expert_category; ?>" class="form-control" placeholder="Expert Category">
                  <span style="color:red" id="errCode"><?= form_error('expert_category');?></span>
              </div> 
              <div class="form-group">
                  <label for="title">Specialization <span class="red">*</span></label>
                  <input type="text" name="specialization" id="specialization" required="required" value="<?php echo $specialization; ?>" class="form-control" placeholder="Enter specialization">
                  <span style="color:red" id="errCode"><?= form_error('specialization');?></span>
              </div>
              <div class="form-group">
                  <label for="title">Expert Email <span class="red">*</span></label>
                  <input type="text" name="expert_email" id="expert_email" required="required" value="<?php echo $expert_email; ?>" class="form-control" placeholder="Expert Email" readonly>
                  <span style="color:red" id="errCode"><?= form_error('expert_email');?></span>
              </div> 
              <div class="form-group">
                  <label for="title">Qualification <span class="red">*</span></label>
                  <input type="text" name="Qualification" id="Qualification" required="required" value="<?php echo $Qualification; ?>" class="form-control" placeholder="Enter Qualification">
                  <span style="color:red" id="errCode"><?= form_error('Qualification');?></span>
              </div> 
              <div class="form-group">
                  <label for="title">Publication URL <span class="red">*</span></label>
                  <input type="text" name="Publication_url" id="Publication_url" required="required" value="<?php echo $Publication_url; ?>" class="form-control" placeholder="Enter Publication URL">
                  <span style="color:red" id="errCode"><?= form_error('Publication_url');?></span>
              </div>
              <div class="form-group">
                  <label for="title">Twitter URL <span class="red">*</span></label>
                  <input type="text" name="twitter_id" id="Publication_url" required="required" value="<?php echo $twitter_id; ?>" class="form-control" placeholder="Enter Twitter ID URL">
                  <span style="color:red" id="errCode"><?= form_error('twitter_id');?></span>
              </div>
              <div class="form-group">
                  <label for="title">Facebook URL <span class="red">*</span></label>
                  <input type="text" name="facebook_id" id="Publication_url" required="required" value="<?php echo $facebook_id; ?>" class="form-control" placeholder="Enter Facebook ID URL">
                  <span style="color:red" id="errCode"><?= form_error('facebook_id');?></span>
              </div>
              <div class="form-group">
                  <label for="title">Skype URL <span class="red">*</span></label>
                  <input type="text" name="skype_id" id="Publication_url" required="required" value="<?php echo $skype_id; ?>" class="form-control" placeholder="Enter Skype ID URL">
                  <span style="color:red" id="errCode"><?= form_error('skype_id');?></span>
              </div>
              <div class="form-group">
                  <label for="title">Linkedin URL <span class="red">*</span></label>
                  <input type="text" name="linkedin_id" id="Publication_url" required="required" value="<?php echo $linkedin_id; ?>" class="form-control" placeholder="Enter Linkedin ID URL">
                  <span style="color:red" id="errCode"><?= form_error('linkedin_id');?></span>
              </div>                     
             </div>
            <div class="col-md-12">
            	 <input type="hidden" name="cox_uuid" value="<?= $cox_uuid?>">
            	<button class="btn btn-primary" type="submit" onclick="return checkValidates();"><?= $button;?></button>
            	<a href="<?= site_url('Users/index');?>"><button class="btn btn-danger" type="button">Cancel</button></a>
            </div>
            </form>
        </div>   
       </div>
    </div>
    </section>
    <!-- /.content -->
</div>
<?php  $this->load->view('includes/footer');?>