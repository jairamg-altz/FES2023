<?php $this->load->view('includes/header');$this->load->view('includes/left_panel');?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Blog Reply List
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= site_url('Dashboard/index');?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Blog Reply List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
             
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Sr No.</th>
                    <th>Blog</th>
                    <th>Reply</th>
                    <th>Reply User</th>
                    <th>Reply Timestamp</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                 $sr=1;
                foreach($BlogRepliesData as $data) {
                 ?>
                  <tr>
                    <td><?= $sr;?></td>
                    <td><?= ucfirst($data->blog_title);?></td>
                    <td><?= ucfirst($data->blog_answer_body);?></td>
                    <td><?= ucfirst($data->first_name.' '.$data->middle_name.' '.$data->last_name);?></td>
                    <td><?= $data->reply_timestamp ?></td>                    
                  </tr>
                <?php $sr++; } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
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
  setTimeout(function(){$("#hide").html('');},4000);
</script>