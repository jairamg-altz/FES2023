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
                  <label for="title">User Name <span class="red">*</span></label>
                  <input type="text" name="name" id="name" required="required" value="<?php echo $name; ?>" class="form-control" placeholder="Name">
                  <span style="color:red" id="errCode"><?= form_error('name');?></span>
              </div>
             
            <div class="form-group">
                  <label for="title">Section <span class="red">*</span></label>
                  <input type="text" name="fsection" id="email" required="required" value="<?php echo $fsection; ?>" class="form-control" placeholder="email">
                  <span style="color:red" id="errCode"><?= form_error('fsection');?></span>
              </div> 
              <div class="form-group">
                  <label for="title">Type <span class="red">*</span></label>
                  <input type="text" name="ftype" id="password" required="required" value="<?php echo $ftype; ?>" class="form-control" placeholder="Feedback Type">
                  <span style="color:red" id="errCode"><?= form_error('ftype');?></span>
              </div> 
               <div class="form-group">
                  <label for="title">Emotion <span class="red">*</span></label>
                  <input type="text" name="femotion" id="mobile" required="required" value="<?php echo $femotion; ?>" class="form-control" placeholder="Emotion" >
                  <span style="color:red" id="errCode"><?= form_error('mobile');?></span>
              </div> 
             <div class="form-group">
                  <label for="title">Comment <span class="red">*</span></label>
                  <textarea name="feedback" class="form-control"><?php echo $feedback?></textarea>
                  <span style="color:red" id="errTitle"><?= form_error('role');?></span>
              </div> 
              <div class="form-group">
                  <label for="title">Reply <span class="red">*</span></label>
                 <textarea name="rcomment" class="form-control"></textarea>
                  <span style="color:red" id="errTitle"><?= form_error('rcomment');?></span>
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