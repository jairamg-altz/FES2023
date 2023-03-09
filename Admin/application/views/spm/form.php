<?php $this->load->view('includes/header');
$this->load->view('includes/left_panel');?>
	<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?= $heading;?></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?= site_url('SpMasters/index');?>">Species Type List</a></li>
        <li class="active"><?= $heading;?></li>
      </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
        <div class="box-header">
        <h3 class="box-title"></h3>
          <div class="box-tools pull-right">
            <a href="<?= site_url('SpMasters/index');?>">
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
                  <label for="title">Name <span class="red">*</span></label>
                 <select name="species_master_id" class="form-control" required>
                   <option>Select species</option>
                  <?php foreach($species as $speciesRows) { ?> 
                   <option value="<?= $speciesRows->species_master_id;?>" <?php if($species_master_id==$speciesRows->species_master_id) { echo "selected"; }?>><?= $speciesRows->species_master_name;?></option>
                  <?php } ?> 
                 </select>
                  <span style="color:red" id="errTitle"><?= form_error('name');?></span>
              </div>
	            <div class="form-group">
	                <label for="title">Name <span class="red">*</span></label>
	                <input type="text" class="form-control" id="name" name="name" value="<?= $name;?>" placeholder="Enter name">
	                <span style="color:red" id="errTitle"><?= form_error('name');?></span>
	            </div>
	          <div class="col-md-12">
            	<input type="hidden" name="id" value="<?= $id?>">
            	<button class="btn btn-primary" type="submit" onclick="return checkValidates();"><?= $button;?></button>
            	<a href="<?= site_url('SpMasters/index');?>"><button class="btn btn-danger" type="button">Cancel</button></a>
            </div>
        </div>
      	</form>
       </div>
    </div>
    </section>
</div>
<?php $this->load->view('includes/footer');?>