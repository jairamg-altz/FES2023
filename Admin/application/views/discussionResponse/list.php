<?php $this->load->view('includes/header'); $this->load->view('includes/left_panel'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Discussion Response List
       <!--  <small>Newsletter</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= site_url('Dashboard/index');?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <!-- <li><a href="<?= site_url();?>">Tables</a></li> -->
        <li class="active">Discussion Response List</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <center>
                <?php if($this->session->userdata('message')) { ?><span style="color:green;" id="hide"><?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : '';?></span><?php } ?>
              </center>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Sr No.</th>
                    <th>forum</th>
                    <th>Comment</th>
                    <th>Like No</th>
                    <th>Response User</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php $sr=1;
                foreach($DResponsesData as $data) { ?>
                  <tr>
                    <td><?= $sr;?></td>
                    <td><?= ucfirst($data->forum);?></td>
                    <td><?= $data->text_msg?></td>
                    <td><?= $data->like_no?></td>
                    <td><?= ucfirst($data->first_name.' '.$data->middle_name.' '.$data->last_name);?></td>
                    <td>                      
                      <?php echo anchor(site_url('DResponses/update/'.$data->response_id),'<button class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i>&nbsp;Edit</button>');                       
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
 setTimeout(function(){$("#hide").html('');},4000);
</script>