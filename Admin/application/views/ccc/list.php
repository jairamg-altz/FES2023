<?php $this->load->view('includes/header');$this->load->view('includes/left_panel');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Species Common Name List
       <!--  <small>Newsletter</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= site_url('Dashboard/index');?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Species Common Name List</li>
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
              <span style="float:right;"><a href="<?= site_url('SpMasters/create');?>"><button class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-plus"></i>&nbsp;Create</button></a></span>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="user_data" class="table table-bordered table-striped" width="100%">
                <thead>
                  <tr>
                    <th>Sr No.</th>
                    <th>Col ID</th>
                    <th>Language</th>
                    <th>Common Name</th>
                    <th>Scientific Name</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
              </tbody>
              </table>
            </div>           
          </div>         
        </div>
      </div>
    </section>
  </div>
</body>
</html>
<?php $this->load->view('includes/footer'); ?>
<script>
setTimeout(function(){$("#hide").html('<?php unset($_SESSION['message']);?>');},4000);
</script>
<script type="text/javascript"> 
$(document).ready(function(){  
      var dataTable = $('#user_data').DataTable({  
           "processing":true,  
           "serverSide":true,  
           "order":[],  
           "ajax":{  
                url:"<?php echo site_url() . '/CommonName/ajax_listD'; ?>",  
                type:"POST"  
           },  
           "columnDefs":[  
                {  
                     "targets":[0, 3, 4],  
                     "orderable":false,  
                },  
           ],  
      });  
 }); 
</script>