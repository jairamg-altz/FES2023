<?php $this->load->view('includes/header');
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
        <li><a href="<?= site_url('Layers/index');?>">Layer Configuration List</a></li>
        <li class="active"><?= $heading;?></li>
      </ol>
    </section>
    <section class="content">
      <!-- SELECT2 EXAMPLE -->
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title"></h3>
          <div class="box-tools pull-right">
            <a href="<?= site_url('Layers/index');?>">
            	<button class="btn btn-danger" title="Back Button"><i class="glyphicon glyphicon-arrow-left"></i></button>
            </a>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <input type="button" name="" style="float:right;" class="btn btn-primary" value="Add category" onclick="addCat();">
          <div class="row">
          	<form method="POST" action="<?= $action;?>" enctype="multipart/form-data">
            <div class="col-md-6">
              <div class="form-group">
                <label for="title">Layer Type <span class="red">*</span></label>
               <select name="layer_type" class="form-control" required> 
                <option value="">Select Layer Type</option>
                <option value="vector" <?php if($layer_type=='vector') { echo 'selected'; } ?>>Vector</option>
                <option value="raster" <?php if($layer_type=='raster') { echo 'selected'; } ?>>Raster</option>
               </select> 
              </div>
            	<!-- Title -->
              <div class="form-group">
	                <label for="title">Layer Name <span class="red">*</span></label>
	                <input type="text" class="form-control" id="layer_name" name="layer_name" value="<?= $layer_name;?>" placeholder="Enter layer name" required>
	                <span style="color:red" id="errTitle"><?= form_error('layer_name');?></span>
	            </div>
             <!-- category-->
             <div class="form-group" id="catSel">
               <label for="title">Category <span class="red">*</span></label>
               <select class="form-control" name="categoryS">
                 <?php foreach ($categoryD as $value) { ?>
                 <option value="<?= $value->category;?>" <?php if($value->category==$category) { echo 'selected'; } ?>><?= $value->category;?></option>
               <?php } ?>
               </select>
             </div>
              <div class="form-group" style="display: none;" id="catInput">
                  <label for="title">Category <span class="red">*</span></label>
                  <input type="text" class="form-control"  name="categoryI" value="<?= $category;?>" placeholder="Enter category">
                  <span style="color:red" id="errTitle"><?= form_error('category');?></span>
              </div> 
               <div class="form-group">
                  <label for="title">Layer URL <span class="red">*</span></label>
                  <input type="url" class="form-control"  name="layer_url" value="<?= $layer_url;?>" placeholder="Enter layer url" required>
                  <span style="color:red" id="errTitle"><?= form_error('layer_url');?></span>
              </div> 
                <div class="form-group">
                  <label for="title">Description <span class="red">*</span></label>
                  <textarea class="form-control"  name="description" placeholder="Enter description" required><?= $description;?></textarea>
                  <span style="color:red" id="errTitle"><?= form_error('description');?></span>
              </div> 
               <div class="form-group">
                  <label for="title">From Date <span class="red">*</span></label>
                  <input type="date" class="form-control"  name="from_date" value="<?= $from_date;?>" placeholder="Enter from date" required>
                  <span style="color:red" id="errTitle"><?= form_error('from_date');?></span>
              </div> 
             <div class="form-group">
                  <label for="title">To Date <span class="red">*</span></label>
                  <input type="date" class="form-control"  name="to_date" value="<?= $to_date;?>" placeholder="Enter to date" required>
                  <span style="color:red" id="errTitle"><?= form_error('to_date');?></span>
              </div>  
	          <div class="col-md-12">
            	<input type="hidden" name="layer_id" value="<?= $layer_id?>">
            	<button class="btn btn-primary" type="submit" onclick="return checkValidates();"><?= $button;?></button>
            	<a href="<?= site_url('Layers/index');?>"><button class="btn btn-danger" type="button">Cancel</button></a>
            </div>
        </div>
      	</form>    
       </div>
    </div>
    </section>
    <!-- /.content -->
</div>
<?php $this->load->view('includes/footer'); ?>
<script>
  setTimeout(function(){$("#hide").html('');},500);  
function addCat() {
  $("#catSel").hide();
  $("#catInput").show();
}
</script>