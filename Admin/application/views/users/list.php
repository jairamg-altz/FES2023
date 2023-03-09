<?php $this->load->view('includes/header');
$this->load->view('includes/left_panel');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>User Managment System List</h1>
      <ol class="breadcrumb">
        <li><a href="<?= site_url('Dashboard/index');?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">User Managment System List</li>
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
               <span style="float:right;"><a href="<?= site_url('Users/create');?>"><button class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-plus"></i>&nbsp;Create</button></a></span>
            </div>
             </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Sr No.</th>
                    <!-- <th>UUID </th> -->
                    <th>User ID </th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Status</th>                    
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                 $sr=1;
                foreach($usersData as $data) {  
                 $expertd = $this->Common_model->getData("coxs","1","expert_email='".$data->email."'"); ?>
                  <tr>
                    <td><?= $sr;?></td>
                    <!-- <td><?= $data->user_uuid;?></td> -->
                    <td><?= ucfirst($data->user_id);?></td>
                    <td><?= ucfirst($data->first_name.' '.$data->middle_name.' '.$data->last_name);?></td>
                    <td><?= $data->email?></td>
                    <td><?= $data->mobile_number?></td>                                 
                    <td>
                      <?php if($data->status=='Active'){?>
                        <span class="label label-success"><?= ucfirst($data->status);?></span>
                      <?php } else { ?>
                        <span class="label label-danger"><?= ucfirst($data->status); ?></span>
                      <?php  } ?>
                    </td>
                    <td>                      
                      <?php echo anchor(site_url('Users/read/'.$data->user_uuid),'View','class="btn btn-xs btn-primary"'); 
                          echo ' | '; 
                          echo anchor(site_url('Users/update/'.$data->user_uuid),'<button class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i>&nbsp;Edit</button>'); 
                          echo ' | ';
                          echo anchor(site_url('Users/delete/'.$data->user_uuid),'<button class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i>&nbsp;Delete</button>','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
                         if(empty($expertd))
                         {
                            echo ' | '; 
                            echo anchor(site_url('Users/expert/'.$data->user_uuid),'<button class="btn btn-xs btn-success"><i class="glyphicon glyphicon-certificate"></i>&nbsp;Expert</button>');
                         }
                          
                      ?>
                    </td>
                  </tr>
                <?php  
                  $sr++; 
                  } 
                  ?>
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