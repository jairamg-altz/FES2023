<?php $this->load->view('includes/header');
$this->load->view('includes/left_panel'); ?>
	<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
			<?= $heading;?>       
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?= site_url('DynamicRWeightage/index');?>">Dynamic Reward Weightage List</a></li>
        <li class="active"><?= $heading;?></li>
      </ol>
    </section>
    <section class="content">
      <!-- SELECT2 EXAMPLE -->
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title"></h3>
          <div class="box-tools pull-right">
            <a href="<?= site_url('DynamicRWeightage/index');?>">
            	<button class="btn btn-danger" title="Back Button"><i class="glyphicon glyphicon-arrow-left"></i></button>
            </a>
          </div>
        </div>
        <div class="box-body">
          <div class="row">
          	<form method="POST" action="<?= $action;?>" enctype="multipart/form-data">
            <div class="col-md-6">

            	<!-- Title -->
	            <div class="form-group">
	                <label for="title">Name <span class="red">*</span></label>
	                <select class="form-control" name="dynamic_reward_title" <?php if($button=='Update') { echo 'readonly'; } ?>>
                   <option value="Novice" <?php if($dynamic_reward_title=='Novice') { echo "selected";}?>>Novice</option> 
                   <option value="Watcher" <?php if($dynamic_reward_title=='Watcher') { echo "selected";}?>>Watcher</option> 
                   <option value="Avid_Watcher" <?php if($dynamic_reward_title=='Avid_Watcher') { echo "selected";}?>>Avid Watcher</option> 
                   <option value="Observer" <?php if($dynamic_reward_title=='Observer') { echo "selected";}?>>Observer</option> 
                   <option value="Community_Participant" <?php if($dynamic_reward_title=='Community_Participant') { echo "selected";}?>>Community Participant</option> 
                   <option value="Community_Champion" <?php if($dynamic_reward_title=='Community_Champion') { echo "selected";}?>>Community Champion</option> 
                   <option value="Contributor" <?php if($dynamic_reward_title=='Contributor') { echo "selected";}?>>Contributor</option> 
                   <option value="Researcher" <?php if($dynamic_reward_title=='Researcher') { echo "selected";}?>>Researcher</option> 
                   <option value="Expert" <?php if($dynamic_reward_title=='Expert') { echo "selected";}?>>Expert</option>
                  </select>
	            </div>
              <div class="form-group">
                  <label for="title">Weightage from<span class="red">*</span></label>
                 <input type="number" name="dynamic_reward_weightage_from" class="form-control" value="<?= $dynamic_reward_weightage_from;?>" placeholder="Weightage from" min="<?php if($button=='Create') { echo $Twight; } ?>" required>
              </div>
              <div class="form-group">
                  <label for="title">Weightage To<span class="red">*</span></label>
                 <input type="number" name="dynamic_reward_weightage_to" class="form-control" value="<?= $dynamic_reward_weightage_to;?>" placeholder="Weightage To" max="<?php if($button=='Create') { echo $Twight; } ?>" required>
              </div>
	          <div class="col-md-12">
            	<input type="hidden" name="dynamic_reward_weightages_id" value="<?= $dynamic_reward_weightages_id?>">
            	<button class="btn btn-primary" type="submit" onclick="return checkValidates();"><?= $button;?></button>
            	<a href="<?= site_url('DynamicRWeightage/index');?>"><button class="btn btn-danger" type="button">Cancel</button></a>
            </div>
        </div>
      	</form>
    
       </div>
    </div>
    </section>
</div>
<?php $this->load->view('includes/footer');?>