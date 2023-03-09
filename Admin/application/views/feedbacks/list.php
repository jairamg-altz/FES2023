<?php $this->load->view('includes/header');$this->load->view('includes/left_panel');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Feedback System List</h1>
      <ol class="breadcrumb">
        <li><a href="<?= site_url('Dashboard/index');?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
       
        <li class="active">Feedback System List</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
                       </div>
             </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Sr No.</th>
                    <th>Section</th>
                    <th>Type</th>
                    <th>Emotion</th>
                    <th>Feedback</th>
                    <th>Created By</th>
                     <th>Visibility</th>
                    <th style="width:25%;">Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                 $sr=1;
                foreach($FeedbacksData as $data) {  ?>
                  <tr>
                    <td><?= $sr;?></td>
                    <td><?= $data->fsection?></td>
                    <td><?= $data->feedback_type?></td>
                    <td><?= $data->femotion?></td>                                     
                    <td><?= $data->text_msg ?></td>
                    <td><?= ucfirst($data->first_name.' '.$data->middle_name.' '.$data->last_name)?></td>
                    <td>
                      <?php if(empty($data->visibility) || $data->visibility=='Unpublish'){?>
                        <a href="<?= site_url('Feedbacks/visibility/'.$data->feedback_id)?>"><span class="label label-danger">Unpublish</span></a>
                      <?php } elseif($data->visibility=='Publish') { ?>
                        <span class="label label-success">Publish</span>
                      <?php  } ?>
                    </td>
                    <td><?php 
                          echo anchor(site_url('Feedbacks/read/'.$data->feedback_id),'View Response','class="btn btn-xs btn-primary"'); 
                          echo ' | '; 
                          echo anchor(site_url('Feedbacks/reply/'.$data->feedback_id),'<button class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i>&nbsp;Response</button>'); 
                          echo ' | ';
                          echo anchor(site_url('Feedbacks/delete/'.$data->feedback_id),'<button class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i>&nbsp;Delete</button>','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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