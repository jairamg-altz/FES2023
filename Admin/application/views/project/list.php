<?php $this->load->view('includes/header');
$this->load->view('includes/left_panel');
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Project Detail List
       <!--  <small>Newsletter</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= site_url('Dashboard/index');?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Project Detail List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <center>
                <?php if($this->session->userdata('message')) { ?><span style="color:green;" id="hide" style="diaplay:none;"><?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : '';?></span><?php } ?>
              </center>
              <span style="float:right;"><a href="<?= site_url('Projects/create');?>"><button class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-plus"></i>&nbsp;Create</button></a></span>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Sr No.</th>
                    <th>Project Name</th>
                    <th>Description</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                 $sr=1;
                foreach($ProjectsData as $data) { ?>
                  <tr>
                    <td><?= $sr;?></td>
                    <td><?= $data->project_name?></td>
                    <td><?= $data->project_desc;?></td>                    
                    <td>                      
                      <?php 
                          /*echo anchor(site_url('admin_logins/read/'.$data->id),'Read','class="btn btn-primary"'); 
                          echo ' | '; */
                          echo anchor(site_url('Projects/update/'.$data->project_id),'<button class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i>&nbsp;Edit</button>'); 
                         /*if($data->id <>'1'){*/
                         /* echo ' | '; 
                          echo anchor(site_url('Categories/delete/'.$data->id),'<button class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i>&nbsp;Delete</button>','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); */
                        /*}*/
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
 
<?php 
  $this->load->view('includes/footer');
?>