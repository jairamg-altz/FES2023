<?php $this->load->view('includes/header');$this->load->view('includes/left_panel');?>
	<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?= $heading;?>  </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?= site_url('CommonName/index');?>">Species Common Name List</a></li>
        <li class="active"><?= $heading;?></li>
      </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title"></h3>

          <div class="box-tools pull-right">
            <a href="<?= site_url('CommonName/index');?>">
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
	                <label for="title">Col ID <span class="red">*</span></label>
	                <input type="text" class="form-control" id="name" name="col_id" value="<?= $col_id;?>" placeholder="Enter Col ID">
	                <span style="color:red" id="errTitle"><?= form_error('col_id');?></span>
	            </div>
              <div class="form-group">
                  <label for="title">Language <span class="red">*</span></label>
                  <input type="text" class="form-control" id="name" name="language" value="<?= $language;?>" placeholder="Enter Language">
                  <span style="color:red" id="errTitle"><?= form_error('language');?></span>
              </div>
              <div class="form-group">
                  <label for="title">Common Name <span class="red">*</span></label>
                  <input type="text" class="form-control" id="name" name="common_name" value="<?= $common_name;?>" placeholder="Enter Common Name">
                  <span style="color:red" id="errTitle"><?= form_error('common_name');?></span>
              </div>
              <div class="form-group">
                  <label for="title">Scientific Name <span class="red">*</span></label>
                  <input type="text" class="form-control" id="name" name="scientific_name" value="<?= $scientific_name;?>" placeholder="Enter Scientific Name">
                  <span style="color:red" id="errTitle"><?= form_error('Scientific Name');?></span>
              </div>
	          <div class="col-md-12">
            	<input type="hidden" name="col_id" value="<?= $col_id?>">
            	<button class="btn btn-primary" type="submit" onclick="return checkValidates();"><?= $button;?></button>
            	<a href="<?= site_url('CommonName/index');?>"><button class="btn btn-danger" type="button">Cancel</button></a>
            </div>
        </div>
      	</form>
       </div>
    </div>
    </section>
</div>
<?php $this->load->view('includes/footer');?>