<?php $this->load->view('includes/header');
$this->load->view('includes/left_panel');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Blog Reply List
       <!--  <small>Newsletter</small> -->
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
                    <th>Title</th>
                    <th>Body</th>
                    <th>Question</th>
                    <th>Answer</th>
                    <th>Reply by</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                 $sr=1;
                foreach($BlogRData as $data) { ?>
                  <tr>
                    <td><?= $sr;?></td>
                    <td><?= ucfirst($data->blog_title);?></td>
                    <td><?= ucfirst($data->blog_body);?></td>
                    <td><?= ucfirst($data->blog_is_question);?></td>
                    <td><?= ucfirst($data->blog_answer_body);?></td>
                    <td><?= ucfirst($data->first_name.' '.$data->middle_name.' '.$data->last_name);?></td>
                    <td><?php echo anchor(site_url('BlogReplies/Cresourses/'.$data->blog_answer_reply_id),'<button class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-url"></i>&nbsp;Resourses</button>');?>
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