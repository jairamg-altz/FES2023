<?php $this->load->view('includes/header');
$this->load->view('includes/left_panel');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Functionalities List
       <!--  <small>Newsletter</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= site_url('Dashboard/index');?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Functionalities List</li>
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
              <span style="float:right;"><a href="<?= site_url('Functionalities/create');?>"><button class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-plus"></i>&nbsp;Create</button></a></span>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Sr No.</th>
                    <th>Funcionality Name</th>
                    <th>Sub Funcionality Name</th>
                    <th>Module Name</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php $sr=1; foreach($FunctionalitiesData as $data) {  ?>
                  <tr>
                    <td><?= $sr;?></td>
                    <td><?= $data->fnct_name?></td>
                    <td><?= $data->sub_fnct_name?></td>
                    <td><?= $data->module_name?></td>                    
                    <td>   
                      <?php echo anchor(site_url('Functionalities/update/'.$data->fnct_uuid),'<button class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i>&nbsp;Edit</button>'); 
                        echo ' | '; 
                          echo anchor(site_url('Functionalities/delete/'.$data->fnct_uuid),'<button class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i>&nbsp;Delete</button>','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
<?php $this->load->view('includes/footer');?>
<script>
  setTimeout(function(){$("#hide").html('<?php unset($_SESSION['message']);?>');},4000);
</script>