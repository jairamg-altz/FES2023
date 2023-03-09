<?php 
//print_r($error);exit;
$this->load->view('includes/header');
$this->load->view('includes/left_panel');
?>
	<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
			<?= $heading;?>       
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?= site_url('Projects/index');?>">Project Detail List</a></li>
        <li class="active"><?= $heading;?></li>
      </ol>
    </section>

    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-primary">
        <div class="box-header">
          
          <h3 class="box-title"></h3>

          <div class="box-tools pull-right">
            <a href="<?= site_url('Projects/index');?>">
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
	                <input type="text" class="form-control" id="project_name" name="project_name" value="<?= $project_name;?>" placeholder="Enter project name">
	                <span style="color:red" id="errTitle"><?= form_error('project_name');?></span>
	            </div>	            
              <div class="form-group">
                  <label for="title">Description <span class="red">*</span></label>
                  <textarea class="form-control" id="" name="project_desc" placeholder="Enter description"><?= $project_desc;?> </textarea>
                  <span style="color:red" id="errTitle"><?= form_error('project_desc');?></span>
              </div> 
            </div>
            <div class="col-md-12">
            	<input type="hidden" name="project_id" value="<?= $project_id?>">
            	<button class="btn btn-primary" type="submit" onclick="return checkValidates();"><?= $button;?></button>
            	<a href="<?= site_url('Projects/index');?>"><button class="btn btn-danger" type="button">Cancel</button></a>
            </div>
        </div>
      	</form>    
       </div>
    </div>
    </section>
</div>
<?php $this->load->view('includes/footer');?>
