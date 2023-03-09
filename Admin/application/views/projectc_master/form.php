<?php $this->load->view('includes/header');
$this->load->view('includes/left_panel');?>
	<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?= $heading;?></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?= site_url('ProjectColumns/index');?>">Project Column Master List</a></li>
        <li class="active"><?= $heading;?></li>
      </ol>
    </section>
    <section class="content">
      <!-- SELECT2 EXAMPLE -->
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title"></h3>
          <div class="box-tools pull-right">
            <a href="<?= site_url('ProjectCMaster/index');?>">
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
                  <label for="title">Project column <span class="red">*</span></label>
                  <input type="text" class="form-control" id="attribute_name" name="attribute_name" value="<?= $attribute_name;?>" placeholder="Enter project column">
              </div>
	            <div class="form-group">
	                <label for="title">Alias Name<span class="red">*</span></label>
	                <input type="text" class="form-control" id="alias_name" name="alias_name" value="<?= $alias_name;?>" placeholder="Enter Alias Name">
	                <span style="color:red" id="errTitle"><?= form_error('category_name');?></span>
	            </div>
	            <div class="form-group">
                  <label for="title">Data Type <span class="red">*</span></label>
                  <input type="text" class="form-control" id="data_type" name="data_type" value="<?= $data_type;?>" placeholder="Enter Data Type">
                  <span style="color:red" id="errTitle"><?= form_error('data_type');?></span>
              </div> 
              <div class="form-group">
                  <label for="title">Option <span class="red">*</span></label>
                  <textarea class="form-control" id="" name="options" placeholder="Enter Option"><?= $options;?> </textarea>
                  <span style="color:red" id="errTitle"><?= form_error('options');?></span>
              </div>
              <div class="form-group">
                  <label for="title">Is Mandatory <span class="red">*</span></label>
                  <select class="form-control" name="is_mandatory">
                  <option value="Yes"<?php if($projectRows->is_mandatory=='Yes') { echo "selected"; }?>>Yes</option>
                  <option value="No"<?php if($projectRows->is_mandatory=='No') { echo "selected"; } ?>>No</option>
                  </select>
              </div> 
            </div>
            <div class="col-md-12">
            	<input type="hidden" name="project_column_master_id" value="<?= $project_column_master_id?>">
            	<button class="btn btn-primary" type="submit" onclick="return checkValidates();"><?= $button;?></button>
            	<a href="<?= site_url('ProjectCMaster/index');?>"><button class="btn btn-danger" type="button">Cancel</button></a>
            </div>
        </div>
      	</form>
    
       </div>
    </div>
    </section>
    <!-- /.content -->
</div>
<?php $this->load->view('includes/footer');?>