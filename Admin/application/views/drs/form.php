<?php $this->load->view('includes/header');
$this->load->view('includes/left_panel');?>
	<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?= $heading;?> </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?= site_url('DynamicRewards/index');?>">Dynamic Reward System</a></li>
        <li class="active"><?= $heading;?></li>
      </ol>
    </section>
    <section class="content">
      <!-- SELECT2 EXAMPLE -->
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title"></h3>
          <div class="box-tools pull-right">
            <a href="<?= site_url('DynamicRewards/index');?>">
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
	                <label for="title">Category Name <span class="red">*</span></label>
	                <select class="form-control" name="category_name" style="font: sans-serif;">
                    <?php foreach($categoryData as $catRows) { ?>
                   <option value="<?= $catRows->category_name;?>" <?php if($catRows->category_name==$category_name) { echo 'selected'; } ?>><b><?= $catRows->category_name;?></b></option> 
                 <?php } ?>
                  </select>
	            </div>
              <div class="form-group">
                  <label for="title">Weightage <span class="red">*</span></label>
                  <input type="number" name="weightage" value="<?= $weightage; ?>" class="form-control">
              </div>
	          <div class="col-md-12">
            	<input type="hidden" name="category" value="<?= $category?>">
            	<button class="btn btn-primary" type="submit" onclick="return checkValidates();"><?= $button;?></button>
            	<a href="<?= site_url('DynamicRewards/index');?>"><button class="btn btn-danger" type="button">Cancel</button></a>
            </div>
        </div>
      	</form>    
       </div>
    </div>
    </section>
</div>
<?php $this->load->view('includes/footer');?>
