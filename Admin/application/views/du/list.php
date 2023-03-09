<?php $this->load->view('includes/header');
$this->load->view('includes/left_panel');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data Upload Taxonamy</h1>
      <ol class="breadcrumb">
        <li><a href="<?= site_url('Dashboard/index');?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Data Upload Taxonamy</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <center>
                <!-- <?php if($this->session->userdata('message')) { ?><span style="color:green;" id="hide"><?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : '';?></span><?php } ?> -->
              </center>
            </div>
             </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Sr No.</th>
                    <th>User</th>
                    <th>Reason</th>
                    <th>status</th>
                    <th>Admin Feedback</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                 $sr=1;
                foreach($DuploadsData as $data) {  ?>
                  <tr>
                    <td><?= $sr;?></td>
                    <td><?= ucfirst($data->first_name.' '.$data->middle_name.' '.$data->last_name);?></td>
                    <td><?= ucfirst($data->du_textarea);?></td>
                    <td><?= ucfirst($data->status);?></td>
                    <td><?php if(!empty($data->admin_feedback)) { echo $data->admin_feedback; } else { echo "No Feedback"; } ?> </td>
                    <td>
                      
                      <?php if($data->status=='Pending')
                      {
                        echo anchor(site_url('Duploads/duedit/'.$data->data_uploads_id),'<button class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i>&nbsp;Edit</button>');
                      }
                      else {
                        echo '<button class="btn btn-xs btn-warning" disabled ><i class="glyphicon glyphicon-edit"></i>&nbsp;Edit</button>';
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
 
<?php 
  $this->load->view('includes/footer');
?>

<script>
  setTimeout(function(){$("#hide").html('');},9000);
</script>

