<?php $this->load->view('includes/header');$this->load->view('includes/left_panel');?>
	<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
			<?= $heading;?>       
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?= site_url('Users/index');?>">User Managment System List</a></li>
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
        <div class="col-md-12">
       <div class="col-md-6">   
        <div class="form-group">
        <label>First Name:</label>
        <span><?= ucfirst($rowsData->first_name);?></span>
      </div>
        </div>
        <div class="col-md-6">
        <div class="form-group">   
        <label>Middle Name:</label>
        <span><?= $rowsData->middle_name;?></span>
        </div>     
            </div>
        </div>    
            <div class="col-md-12">
       <div class="col-md-6">   
        <label>Last Name:</label>
        <span><?= ucfirst($rowsData->last_name);?></span>
        </div>
        <div class="col-md-6">   
        <label>UUID:</label>
        <span><?= $rowsData->user_uuid;?></span>
        </div>     
            </div>
            <div class="col-md-12">
       <div class="col-md-6">   
        <label>Mobile No:</label>
        <span><?= $rowsData->mobile_number;?></span>
        </div>
       <div class="col-md-6">   
        <label>Email:</label>
        <span><?= $rowsData->email;?></span>
        </div>
            </div>
        <div class="col-md-12">
       <div class="col-md-6">   
        <label>Registration Date:</label>
        <span><?= $rowsData->registration_date;?></span>
        </div>
       <div class="col-md-6">   
        <label>Status:</label>
        <span><?= $rowsData->status;?></span>
        </div>
            </div>   
            <div class="col-md-12">
       <div class="col-md-6">   
        <label>Modified By:</label>
        <span><?= $rowsData->modified_by;?></span>
        </div>
       
            </div>   
       </div>
    </div>
    </section>
</div>
<?php  $this->load->view('includes/footer');?>
