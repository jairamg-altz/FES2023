<?php $this->load->view('includes/header');
$this->load->view('includes/left_panel'); ?>
	<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
			<?= $heading;?>       
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?= site_url('Categories/index');?>">Team List</a></li>
        <li class="active"><?= $heading;?></li>
      </ol>
    </section>
    <section class="content">
    <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title"></h3>
          <div class="box-tools pull-right">
            <a href="<?= site_url('Teams/index');?>">
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
	                <label for="title">Member Name <span class="red">*</span></label>
	                <input type="text" class="form-control" id="member_name" name="member_name" value="<?= $member_name;?>" placeholder="Enter Member name" required>
	                <span style="color:red" id="errTitle"><?= form_error('member_name');?></span>
	            </div>
	            <div class="form-group">
                  <label for="title">Member Designation <span class="red">*</span></label>
                  <input type="text" name="member_designation" class="form-control" value="<?= $member_designation;?>">
                
                  <span style="color:red" id="errTitle"><?= form_error('member_designation');?></span>
              </div> 
              <div class="form-group">
                  <label for="title">About Member <span class="red">*</span></label>
                  <textarea class="form-control" id="" name="about_member" placeholder="Enter about member"><?= $about_member;?> </textarea>
                  <span style="color:red" id="errTitle"><?= form_error('about_member');?></span>
              </div> 
              <div class="form-group">
                  <label for="title">Email <span class="red">*</span></label>
                  <input type="email" class="form-control" id="email_id" name="email_id" value="<?= $email_id;?>" placeholder="Enter Email" required>
                  <span style="color:red" id="errTitle"><?= form_error('email');?></span>
              </div>
              <div class="form-group">
                  <label for="title">Image <span class="red">*</span></label>
                  <input type="file" class="form-control" name="image_id">
                  <span style="color:red" id="errTitle"><?= form_error('image_id');?></span>
              </div>
            </div>
            <div class="col-md-12">
            	<input type="hidden" name="team_id" value="<?= $team_id?>">
            	<button class="btn btn-primary" type="submit" onclick="return checkValidates();"><?= $button;?></button>
            	<a href="<?= site_url('Teams/index');?>"><button class="btn btn-danger" type="button">Cancel</button></a>
            </div>
        </div>
      	</form>
    
       </div>
    </div>
    </section>
</div>
<?php $this->load->view('includes/footer'); ?>