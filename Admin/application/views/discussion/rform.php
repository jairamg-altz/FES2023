<?php $this->load->view('includes/header'); $this->load->view('includes/left_panel'); ?>
	<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> <?= $heading;?> </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?= site_url('Dforums/index');?>">Discussion Response List</a></li>
        <li class="active"><?= $heading;?></li>
      </ol>
    </section>
    <section class="content">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title"></h3>
          <div class="box-tools pull-right">
            <a href="<?= site_url('Dforums/index');?>">
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
	                <label for="title">Response <span class="red">*</span></label>
	                <input type="text" class="form-control" id="text_msg" name="text_msg" value="<?= $text_msg;?>" placeholder="Enter Response">
	                <span style="color:red" id="errTitle"><?= form_error('text_msg');?></span>
	            </div>
	            <div class="form-group">
                  <label for="number">Like No <span class="red">*</span></label>
                  <input type="text" class="form-control" id="subject" name="like_no" value="<?= $like_no;?>" placeholder="Enter like no">
                  <span style="color:red" id="errTitle"><?= form_error('like_no');?></span>
              </div> 
            </div>
            <div class="col-md-12">
            	<input type="hidden" name="forum_id" value="<?= $forum_id?>">
              <input type="hidden" name="response_id" value="<?= $response_id?>">
            	<button class="btn btn-primary" type="submit"><?= $button;?></button>
            	<a href="<?= site_url('Dforums/index');?>"><button class="btn btn-danger" type="button">Cancel</button></a>
            </div>
        </div>
      	</form>    
       </div>
    </div>
    </section>
</div>
<?php $this->load->view('includes/footer'); ?>