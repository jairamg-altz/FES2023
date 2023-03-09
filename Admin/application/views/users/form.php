<?php $this->load->view('includes/header');$this->load->view('includes/left_panel');?>
	<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
			<?= $heading;?>       
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?= site_url('Welcome/index');?>">Users List</a></li>
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
          	<form method="POST" action="<?= $action;?>" enctype="multipart/form-data">
            <div class="col-md-6">
              <div class="form-group">
                  <label for="title">Title <span class="red"></span></label>
                  <input type="text" name="title" id="title"  value="<?php echo $title; ?>" class="form-control" placeholder="Title">
                  <span style="color:red" id="errCode"><?= form_error('first_name');?></span>
              </div>
              <div class="form-group">
                  <label for="title">User ID <span class="red">*</span></label>
                  <input type="text" name="user_id" id="user_id" required="required" value="<?php echo $user_id; ?>" class="form-control" placeholder="User ID">
                  <span style="color:red" id="errCode"><?= form_error('user_id');?></span>
              </div>
              <div class="form-group">
                  <label for="title">First Name <span class="red">*</span></label>
                  <input type="text" name="first_name" id="first_name" required="required" value="<?php echo $first_name; ?>" class="form-control" placeholder="Name">
                  <span style="color:red" id="errCode"><?= form_error('first_name');?></span>
              </div>
             <div class="form-group">
                  <label for="title">Middle Name <span class="red"></span></label>
                  <input type="text" name="middle_name" id="middle_name"  value="<?php echo $middle_name; ?>" class="form-control" placeholder="Middle Name">
                  <span style="color:red" id="errCode"><?= form_error('middle_name');?></span>
              </div>
              <div class="form-group">
                  <label for="title">Last Name <span class="red">*</span></label>
                  <input type="text" name="last_name" id="last_name" required="required" value="<?php echo $last_name; ?>" class="form-control" placeholder="Last Name">
                  <span style="color:red" id="errCode"><?= form_error('last_name');?></span>
              </div>
            <div class="form-group">
                  <label for="title">Email <span class="red">*</span></label>
                  <input type="text" name="email" id="email" required="required" value="<?php echo $email; ?>" class="form-control" placeholder="email">
                  <span style="color:red" id="errCode"><?= form_error('email');?></span>
              </div> 
              <div class="form-group">
                  <label for="title">Password <span class="red">*</span></label>
                  <input type="text" name="password" id="password" required="required" value="<?php echo $password; ?>" class="form-control" placeholder="Password">
                  <span style="color:red" id="errCode"><?= form_error('password');?></span>
              </div> 
              <div class="form-group">
                  <label for="title">Gender <span class="red"></span></label><br>
                  <input type="radio" name="gender" value="male" <?php if($gender=='male') { echo 'checked';} ?>> Male
                  
                  <input type="radio" name="gender" value="female" <?php if($gender=='female') { echo 'checked';} ?>> Female
              </div> 
               <div class="form-group">
                  <label for="title">Mobile <span class="red">*</span></label>
                  <input type="text" name="mobile" id="mobile" required="required" value="<?php echo $mobile; ?>" class="form-control" placeholder="Mobile" maxlength="12">
                  <span style="color:red" id="errCode"><?= form_error('mobile');?></span>
              </div> 
             <div class="form-group">
                  <label for="title">Role <span class="red">*</span></label>
                  <select class="form-control" name="role">
                    <option value="Admin" <?php if($role=='Admin') { echo 'selected'; } ?>>Admin</option>
                    <option value="User" <?php if($role=='User') { echo 'selected'; } ?>>User</option>
                  </select>
                  <span style="color:red" id="errTitle"><?= form_error('role');?></span>
              </div> 
              <div class="form-group">
                  <label for="title">Status <span class="red">*</span></label>
                  <select class="form-control" name="status">
                    <option value="Active" <?php if($status=='Active') { echo "selected"; }?>>Active</option>
                    <option value="Inactive"<?php if($status=='Inactive') { echo "selected"; } ?>>Inactive</option>
                  </select>
                  <span style="color:red" id="errTitle"><?= form_error('status');?></span>
              </div>          
             </div>
            <div class="col-md-12">
            	 <input type="hidden" name="user_uuid" value="<?= $user_uuid?>">
            	<button class="btn btn-primary" type="submit" onclick="return checkValidates();"><?= $button;?></button>
            	<a href="<?= site_url('Users/index');?>"><button class="btn btn-danger" type="button">Cancel</button></a>
            </div>
            </form>
        </div>   
       </div>
    </div>
    </section>
</div>
<?php $this->load->view('includes/footer');?>