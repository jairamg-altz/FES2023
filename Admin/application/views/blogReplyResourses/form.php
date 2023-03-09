<?php $this->load->view('includes/header'); $this->load->view('includes/left_panel'); ?>
	<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
			<?= $heading;?>       
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?= site_url('Categories/index');?>">Blog Resourses List</a></li>
        <li class="active"><?= $heading;?></li>
      </ol>
    </section>
    <section class="content">
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
            <div class="form-group">
	                <label for="title">Blog Resourse Url <span class="red">*</span></label>
	                <input type="url" class="form-control" id="blog_resources_resource_url" name="blog_resources_resource_url" value="<?= $blog_resourses_resourse_url;?>" placeholder="https://example.com"
  pattern="[Hh][Tt][Tt][Pp][Ss]?:\/\/(?:(?:[a-zA-Z\u00a1-\uffff0-9]+-?)*[a-zA-Z\u00a1-\uffff0-9]+)(?:\.(?:[a-zA-Z\u00a1-\uffff0-9]+-?)*[a-zA-Z\u00a1-\uffff0-9]+)*(?:\.(?:[a-zA-Z\u00a1-\uffff]{2,}))(?::\d{2,5})?(?:\/[^\s]*)?"
  required>
	                <span style="color:red" id="errTitle"><?= form_error('blog_resourses_resourse_url');?></span>
	            </div>
	            <div class="form-group">
                  <label for="title">Blog Resourse Comment <span class="red">*</span></label>
                  <input type="text" class="form-control" id="blog_resources_comment" name="blog_resources_comment" value="<?= $blog_resources_comment;?>" placeholder="Enter resourses Comment">
                  <span style="color:red" id="errTitle"><?= form_error('blog_resourses_comment');?></span>
              </div>
            </div>
            <div class="col-md-12">
              <input type="hidden" name="blog_resources_reply_id" value="<?= $blog_resources_reply_id?>">
            	<input type="hidden" name="blog_resourses_post_id" value="<?= $blog_resourses_post_id?>">
            	<button class="btn btn-primary" type="submit"><?= $button;?></button>
            	<a href="<?= site_url('BlogReplies/index/');?>"><button class="btn btn-danger" type="button">Cancel</button></a>
            </div>
        </div>
      	</form>    
       </div>
    </div>
    </section>
</div>
<?php $this->load->view('includes/footer');?>