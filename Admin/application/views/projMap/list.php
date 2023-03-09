<?php $this->load->view('includes/header');$this->load->view('includes/left_panel');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Project Mapping List</h1>
      <ol class="breadcrumb">
        <li><a href="<?= site_url('Dashboard/index');?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Project Mapping List</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <span style="float:right;"><a href="<?= site_url('ProjectMappings/create');?>"><button class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-plus"></i>&nbsp;Create</button></a></span>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Sr No.</th>
                    <th>Project Name</th>
                    <th>User Name</th><th>Access</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php $sr=1; foreach($ProjectMappingsData as $data) { ?>
                  <tr>
                    <td><?= $sr;?></td>
                    <td><?= $data->project_name?></td>
                    <td><?= ucfirst($data->first_name.' '.$usersRows->middle_name.' '.$usersRows->last_name); ?></td>
                    <td><?= $data->access?></td>
                    <td><?php echo anchor(site_url('Categories/update/'.$data->project_mapping_id),'<button class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i>&nbsp;Edit</button>'); ?>
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