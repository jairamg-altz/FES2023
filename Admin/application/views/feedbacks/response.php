<?php $this->load->view('includes/header');$this->load->view('includes/left_panel');?>
	<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
			<?= $heading;?>       
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?= site_url('Feedbacks/index');?>">Feedback List</a></li>
        <li class="active"><?= $heading;?></li>
      </ol>
    </section>
    <section class="content">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title"></h3>
          <div class="box-tools pull-right">
            <a href="<?= site_url('Feedbacks/index');?>">
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
                  <label for="title">Response <span class="red">*</span></label>
                 <textarea name="text_msg" class="form-control" required="required"></textarea>
                  <span style="color:red" id="errtext"><?= form_error('text_msg');?></span>
              </div> 
              <div class="form-group">
                  <label for="title">Visibility<span class="red"></span></label>
                  <select class="form-control" name="visibility">
                   <option value="Unpublish">Unpublish</option>
                   <option value="Publish">Publish</option> 
                  </select>
                  <span style="color:red" id="errCode"><?= form_error('visibility');?></span>
              </div>         
             </div>
            <div class="col-md-12">
            	<input type="hidden" name="feedback_id" value="<?= $feedback_id?>">
            	<button class="btn btn-primary" type="submit" onclick="return checkValidates();"><?= $button;?></button>
            	<a href="<?= site_url('Feedbacks/index');?>"><button class="btn btn-danger" type="button">Cancel</button></a>
            </div>
            </form>
        </div>   
       </div>
    </div>
    </section>
    <!-- /.content -->
</div>
<?php  $this->load->view('includes/footer');?>