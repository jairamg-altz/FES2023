<?php $this->load->view('includes/header');$this->load->view('includes/left_panel'); ?>
	<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
			<?= $heading;?>       
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?= site_url('Blogs/index');?>">Blog List</a></li>
        <li class="active"><?= $heading;?></li>
      </ol>
    </section>
    <section class="content">
      <!-- SELECT2 EXAMPLE -->
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title"></h3>
          <div class="box-tools pull-right">
            <a href="<?= site_url('Blogs/index');?>">
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
	                <label for="title">Blog Title <span class="red">*</span></label>
	                <input type="text" class="form-control" id="blog_title" name="blog_title" value="<?= $blog_title;?>" placeholder="Enter blog title" readonly>
	                <span style="color:red" id="errTitle"><?= form_error('blog_title');?></span>
	            </div>
	            <div class="form-group">
                  <label for="title">Blog Body <span class="red">*</span></label>
                  <input type="text" class="form-control" id="blog_body" name="blog_body" value="<?= $blog_body;?>" placeholder="Enter blog body" readonly>
                  <span style="color:red" id="err"><?= form_error('blog_body');?></span>
              </div> 
              <div class="form-group">
                  <label for="title">Blog Question <span class="red">*</span></label>
                  <input type="text" class="form-control" id="blog_is_question" name="blog_is_question" placeholder="Enter blog question" value="<?= $blog_is_question;?>" readonly>
                  <span style="color:red" id="errTitle"><?= form_error('blog_is_question');?></span>
              </div> 
              <div class="form-group">
                  <label for="title">Is Blog Public<span class="red"></span></label>
                  <select class="form-control" name="is_blog_public" readonly>
                    <option value="Publish" <?php if($is_blog_public=='Publish')?>>Publish</option>
                    <option value="Unpublish" <?php if($is_blog_public=='Unpublish')?>>Unpublish</option>
                  </select>
                  <span style="color:red" id="errTitle"><?= form_error('blog_is_question');?></span>
              </div>
              <div class="form-group">
                  <label for="title">Blog Answer <span class="red">*</span></label>
                  <input type="text" class="form-control" id="blog_answer_body" name="blog_answer_body" placeholder="Enter blog answer" value="<?= $blog_answer_body;?>" required>
                  <span style="color:red" id="errTitle"><?= form_error('blog_is_question');?></span>
              </div>
            </div>
            <div class="col-md-12">
            	<input type="hidden" name="blogpost_id" value="<?= $blogpost_id?>">
              <input type="hidden" name="blog_answer_reply_id" value="<?= $blog_answer_reply_id?>">
            	<button class="btn btn-primary" type="submit" onclick="return checkValidates();"><?= $button;?></button>
            	<a href="<?= site_url('Blogs/Rcreate/'.$blogpost_id);?>"><button class="btn btn-danger" type="button">Cancel</button></a>
            </div>
        </div>
      	</form>    
       </div>
    </div>
    </section>
</div>
<?php $this->load->view('includes/footer');?>