<?php $this->load->view('includes/header');
$this->load->view('includes/left_panel');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Layer Configuration List</h1>
      <ol class="breadcrumb">
        <li><a href="<?= site_url('Dashboard/index');?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Layer Configuration List</li>
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
              <span style="float:right;"><a href="<?= site_url('Layers/create');?>"><button class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-plus"></i>&nbsp;Create</button></a></span>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-responsive">
                <thead>
                  <tr>
                    <th>Sr No.</th>
                    <th>Layer Type</th>
                    <th>Layer Name</th>
                    <th>Category</th>
                    <th>Layer Url</th>
                    <th>Description</th>
                    <th>From Date</th>
                    <th>To Date</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php $sr=1;  foreach($LayersData as $data) { ?>
                  <tr>
                    <td><?= $sr;?></td>
                    <td><?= ucfirst($data->layer_type);?></td>
                    <td><?= ucfirst($data->layer_name)?></td>
                    <td><?= $data->category?></td>
                    <td><a href="javascript:void(0);" data-toggle="modal" data-target="#layerurl" data-id="<?= $data->layer_url; ?>" onclick="layerpop(this.getAttribute('data-id'));"><?= substr($data->layer_url, 0, 50);?></a></td>
                    <td><?= $data->description?></td>
                    <td><?= $data->from_date?></td> 
                    <td><?= $data->to_date?></td>
                    <?php if(empty($data->layer_status) || $data->layer_status=='Invisible') { ?> 
                    <td><a href="<?= site_url('Layers/layerStatus/Invisible/'.$data->layer_id)?>"><button class="btn-danger">Invisible</button></a></td>
                  <?php } else { ?>
                  <td><a href="<?= site_url('Layers/layerStatus/visible/'.$data->layer_id)?>"><button class="btn-success">visible</button></a></td>
                  <?php } ?>                    
                    <td>                      
                      <?php echo anchor(site_url('Layers/update/'.$data->layer_id),'<button class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i>&nbsp;Edit</button>'); 
                      echo ' | '; 
                      echo anchor(site_url('Layers/delete/'.$data->layer_id),'<button class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i>&nbsp;Delete</button>','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
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
  setTimeout(function(){$("#hide").html('');},4000);  
function layerpop(value)
{
  $("#ddapt").empty();
  $("#ddapt").append('<h4 style="overflow-wrap:break-word">'+value+'</h4>');
}  
</script>
<div class="modal" tabindex="-1" role="dialog" id="layerurl">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Layer Url</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="ddapt"></div>
      </div>
  </div>
</div>