<?php $this->load->view('includes/header');$this->load->view('includes/left_panel');?>
	<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?= $heading;?> </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?= site_url('ProjectMappings/index');?>">Project Mapping List</a></li>
        <li class="active"><?= $heading;?></li>
      </ol>
    </section>
    <section class="content">
      <!-- SELECT2 EXAMPLE -->
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title"></h3>
          <div class="box-tools pull-right">
            <a href="<?= site_url('ProjectMappings/index');?>">
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
	                <label for="title">Project Name <span class="red">*</span></label>
	                <select class="form-control" name="project_id">
                <?php foreach($projects as $projectRows) { ?>    
                   <option value="<?= $projectRows->project_id ?>"><?= $projectRows->project_name; ?></option> 
                <?php } ?>   
                  </select>
	                <span style="color:red" id="errTitle"><?= form_error('project_id');?></span>
	            </div>
	            <div class="form-group">
                  <label for="title">User Name <span class="red">*</span></label>
                  <select class="form-control" name="user_id">
                <?php foreach($users as $usersRows) { ?>    
                   <option value="<?= $usersRows->user_uuid ?>"><?= ucfirst($usersRows->first_name.' '.$usersRows->middle_name.' '.$usersRows->last_name); ?></option> 
                <?php } ?>   
                  </select>
                  <span style="color:red" id="errTitle"><?= form_error('user_id');?></span>
              </div> 
              <div class="form-group">
                  <label for="title">Access <span class="red"></span></label>
                  <input type="text" class="form-control" id="access" name="access" value="<?= $access;?>" placeholder="Enter Access">
                  <span style="color:red" id="errTitle"><?= form_error('serial_no');?></span>
              </div> 
            </div>
            <div class="col-md-12">
            	<input type="hidden" name="project_mapping_id" value="<?= $project_mapping_id?>">
            	<button class="btn btn-primary" type="submit" onclick="return checkValidates();"><?= $button;?></button>
            	<a href="<?= site_url('ProjectMappings/index');?>"><button class="btn btn-danger" type="button">Cancel</button></a>
            </div>
        </div>
      	</form>    
       </div>
    </div>
    </section>
</div>
<?php $this->load->view('includes/footer');?>