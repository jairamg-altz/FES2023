<?php $this->load->view('includes/header');
$this->load->view('includes/left_panel'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>    Team List  </h1>
      <ol class="breadcrumb">
        <li><a href="<?= site_url('Dashboard/index');?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Team List</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <?php if(!empty($this->session->userdata('message'))) { ?>
              <center>
                <span style="color:green;" id="hide"><?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : '';?></span>
              </center>
              <?php } ?>
              <span style="float:right;"><a href="<?= site_url('Teams/create');?>"><button class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-plus"></i>&nbsp;Create</button></a></span>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Sr No.</th>
                    <th>Member Name</th>
                    <th>Member Designation</th>
                    <th>Member About</th> <th>Email</th> <th>Image</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                 $sr=1;
                foreach($TeamsData as $data) {
                 ?>
                  <tr>
                    <td><?= $sr;?></td>
                    <td><?= ucfirst($data->member_name);?></td>
                    <td><?= ucfirst($data->member_designation);?></td>
                    <td><?= ucfirst($data->about_member);?></td>
                    <td><?= $data->email_id;?></td>
                    <td><?php if(!empty($data->image_id)) { ?>
                      <img src="<?= base_url('../media/img/team/'.$data->image_id);?>" style="width:80px;height: 80px;">
                    <?php } else { ?>     
                      <img src="<?= base_url('uploads/user.png');?>">
                    <?php } ?>  
                    </td>             
                    <td>                      
                      <?php 
                          /*echo anchor(site_url('admin_logins/read/'.$data->id),'Read','class="btn btn-primary"'); 
                          echo ' | '; */
                          echo anchor(site_url('Teams/update/'.$data->team_id),'<button class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i>&nbsp;Edit</button>'); 
                          echo ' | '; 
                          echo anchor(site_url('Teams/delete/'.$data->team_id),'<button class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i>&nbsp;Delete</button>','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
                      ?>
                    </td>
                  </tr>
                <?php $sr++; } ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
 <!-- /.content-wrapper -->
</body>
</html> 
<?php $this->load->view('includes/footer'); ?>
<script>
  setTimeout(function(){$("#hide").html('<?php unset($_SESSION['message']);?>');},4000);
</script>