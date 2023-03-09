<?php $this->load->view('includes/header');
$this->load->view('includes/left_panel');
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Consortium of Experts List
       <!--  <small>Newsletter</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= site_url('Dashboard/index');?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <!-- <li><a href="<?= site_url();?>">Tables</a></li> -->
        <li class="active">Consortium of Experts List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <center>
                <?php if(empty($this->session->userdata('message'))) { ?><span style="color:green;" id="hide"><?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : '';?></span><?php } ?>
              </center>
              <!-- <span style="float:right;"><a href="<?= site_url('Cexperts/create');?>"><button class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-plus"></i>&nbsp;Create</button></a></span> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Sr No.</th>
                    <th>UUID</th>
                    <th>Expert Name</th>
                    <th>Expert Email</th>
                    <th>Expert Detail</th>
                    <th>Created Date</th>
                    <th>Specialization</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                 $sr=1;
                foreach($CexpertsData as $data) {
                 ?>
                  <tr>
                    <td><?= $sr;?></td>
                    <td><?= $data->uuid?></td>
                    <td><?= $data->expert_name?></td>
                    <td><?= $data->expert_email?></td>
                    <td><?= $data->expert_details?></td>
                    <td><?= $data->added_date?></td> 
                    <td><?= $data->specialization?></td>                      
                    <td>                      
                      <?php 
                          echo anchor(site_url('Cexperts/read/'.$data->uuid),'<button class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-eye"></i>&nbsp;Read</button>'); 
                        //  echo ' | '; 
                    /*      echo anchor(site_url('Cexperts/update/'.$data->id),'<button class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i>&nbsp;Edit</button>'); 
                         if($data->id <>'1'){
*/                          echo ' | '; 
                          echo anchor(site_url('Cexperts/delete/'.$data->uuid),'<button class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i>&nbsp;Delete</button>','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
//                        }
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