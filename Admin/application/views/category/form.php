<?php $this->load->view('includes/header');
$this->load->view('includes/left_panel');?>
	<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
			<?= $heading;?>       
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?= site_url('Categories/index');?>">Category List</a></li>
        <li class="active"><?= $heading;?></li>
      </ol>
    </section>

    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title"></h3>
          <div class="box-tools pull-right">
            <a href="<?= site_url('Categories/index');?>">
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
	                <input type="text" class="form-control" id="category_name" name="category_name" value="<?= $category_name;?>" placeholder="Enter category name">
	                <span style="color:red" id="errTitle"><?= form_error('category_name');?></span>
	            </div>
	            <div class="form-group">
                  <label for="title">Module <span class="red">*</span></label>
                  <input type="text" class="form-control" id="module" name="module" value="<?= $module;?>" placeholder="Enter module">
                  <span style="color:red" id="errTitle"><?= form_error('module');?></span>
              </div> 
              <div class="form-group">
                  <label for="title">Description <span class="red">*</span></label>
                  <textarea class="form-control" id="" name="description" placeholder="Enter description"><?= $description;?> </textarea>
                  <span style="color:red" id="errTitle"><?= form_error('description');?></span>
              </div> 
            </div>
            <div class="col-md-12">
            	<input type="hidden" name="cat_uuid" value="<?= $cat_uuid?>">
            	<button class="btn btn-primary" type="submit" onclick="return checkValidates();"><?= $button;?></button>
            	<a href="<?= site_url('Categories/index');?>"><button class="btn btn-danger" type="button">Cancel</button></a>
            </div>
        </div>
      	</form>
       </div>
    </div>
    </section>
</div>
<?php $this->load->view('includes/footer');?>
