<?php $this->load->view('includes/header');
$this->load->view('includes/left_panel');?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1> Dynamic Reward System  </h1>
      <ol class="breadcrumb">
        <li><a href="<?= site_url('Dashboard/index');?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Dynamic Reward System</li>
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
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Sr No.</th>
                    <th>Category Name</th>
                    <th>Weightage</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php $sr=1; foreach($DynamicRewardsData as $data) { ?>
                  <tr>
                    <td><?= $sr;?></td>
                    <td><?= $data->category_name?></td>
                     <td><?= $data->weightage;?></td>                  
                    <td><?php echo anchor(site_url('DynamicRewards/update/'.$data->category),'<button class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i>&nbsp;Edit</button>'); ?>
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