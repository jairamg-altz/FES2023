<?php $this->load->view('includes/header');$this->load->view('includes/left_panel');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Blog List
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= site_url('Dashboard/index');?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Blog List</li>
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
              <span style="float:right;"><a href="<?= site_url('Blogs/create');?>"><button class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-plus"></i>&nbsp;Create</button></a></span>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Sr No.</th>
                    <th>Title</th>
                    <th>Body</th>
                    <th>Question</th>
                    <th>Posted By</th>
                    <th>Is Public</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php $sr=1; foreach($BlogData as $data) { ?>
                  <tr>
                    <td><?= $sr;?></td>
                    <td><?= ucfirst($data->blog_title);?></td>
                    <td><?= ucfirst($data->blog_body);?></td>
                    <td><?= ucfirst($data->blog_is_question);?></td>
                    <td><?= ucfirst($data->first_name.' '.$data->middle_name.' '.$data->last_name);?></td>
                    <td><?= ucfirst($data->is_blog_public);?></td>
                    <td>                      
                      <?php 
                          echo anchor(site_url('Blogs/view/'.$data->blogpost_id),'View','class="btn btn-xs btn-primary"'); 
                          echo ' | '; 
                          echo anchor(site_url('Blogs/update/'.$data->blogpost_id),'<button class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i>&nbsp;Edit</button>'); echo ' | '; 
                          echo anchor(site_url('Blogs/reply/'.$data->blogpost_id),'<button class="btn btn-xs btn-success"><i class="glyphicon glyphicon-edit"></i>&nbsp;Reply</button>'); 
                          echo ' | '; 
                          echo anchor(site_url('Blogs/delete/'.$data->blogpost_id),'<button class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i>&nbsp;Delete</button>','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
</body>
</html> 
<?php $this->load->view('includes/footer');?>
<script>
  setTimeout(function(){$("#hide").html('<?php unset($_SESSION['message']);?>');},4000);
</script>