<?php $this->load->view('includes/header');$this->load->view('includes/left_panel');?>
	<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
			<?= $heading;?>       
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?= site_url('Feedbacks/user_list');?>">Feedback System List</a></li>
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
        
            <hr> 
    <?php foreach ($ResponseD as $ResponseDRow) { ?>        
      <div class="col-md-12">
       <div class="col-md-6">   
        <div class="form-group">
        <label>Response:</label>
        <span><?= ucfirst($ResponseDRow->text_msg);?></span>
      </div>
        </div>
        <div class="col-md-6">
        <div class="form-group">   
        <label>Response By</label>
        <span><?= ucfirst($ResponseDRow->first_name.' '.$ResponseDRow->middle_name.' '.$ResponseDRow->last_name) ;?></span>
        </div>     
            </div>
        </div>
        </div><?php } ?>    
        
    </div>
    </section>
</div>
<?php  $this->load->view('includes/footer');?>
