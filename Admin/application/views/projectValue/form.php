<?php $this->load->view('includes/header');$this->load->view('includes/left_panel');?>
	<div class="content-wrapper">
    <section class="content-header">
      <h1><?= $heading;?></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?= site_url('ProjectValues/index');?>">Project Value List</a></li>
        <li class="active"><?= $heading;?></li>
      </ol>
    </section>
    <section class="content">
      <!-- SELECT2 EXAMPLE -->
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title"></h3>
          <div class="box-tools pull-right">
            <a href="<?= site_url('ProjectValues/index');?>">
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
                  <label for="title">Project Name <span class="red">*</span></label>
                  <select class="form-control" name="project_id">
                <?php foreach ($project as $projectRows) { ?>                     
                    <option value="<?= $projectRows->project_id;?>"<?php if($projectRows->project_id==$project_id) { echo "selected"; } ?>><?= $projectRows->project_name;?></option> <?php } ?>
                  </select>
              </div>
	            <div class="form-group">
	                <label for="title">Latlong<span class="red"></span></label>
	                <input type="text" class="form-control" id="latlon" name="latlon" value="<?= $latlon;?>" placeholder="Enter latlong">
	                <span style="color:red" id="errTitle"><?= form_error('latlon');?></span>
	            </div>
	            <div class="form-group">
                  <label for="title">Image Path <span class="red"></span></label>
                  <input type="text" class="form-control" id="image_path" name="image_path" value="<?= $image_path;?>" placeholder="Enter image path">
                  <span style="color:red" id="errTitle"><?= form_error('image_path');?></span>
              </div> 
              <div class="form-group">
                  <label for="title">Data <span class="red"></span></label>
                  <input type="text" class="form-control" id="data" name="data" value="<?= $data;?>" placeholder="Enter data">
                  <span style="color:red" id="errTitle"><?= form_error('data');?></span>
              </div>
              <div class="form-group">
                  <label for="title">Serial No <span class="red"></span></label>
                  <input type="text" class="form-control" id="serial_no" name="serial_no" value="<?= $serial_no;?>" placeholder="Enter serial no">
                  <span style="color:red" id="errTitle"><?= form_error('serial_no');?></span>
              </div> 
            </div>
            <div class="col-md-12">
            	<input type="hidden" name="project_values_id" value="<?= $project_values_id?>">
            	<button class="btn btn-primary" type="submit" onclick="return checkValidates();"><?= $button;?></button>
            	<a href="<?= site_url('ProjectValues/index');?>"><button class="btn btn-danger" type="button">Cancel</button></a>
            </div>
        </div>
      	</form>    
       </div>
    </div>
    </section>
    <!-- /.content -->
</div>
<?php $this->load->view('includes/footer');?>
