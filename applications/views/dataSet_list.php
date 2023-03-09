<?php $this->load->view('common/header'); ?>
<style>

    .page-header {
        background-image: linear-gradient(135deg, #31b551 0%, #2249a7 100%);
        min-height: 150px;
        margin-top: 120px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 20px 70px;
        color: #fff;
    }

    .member-img .bi-image {
        font-size: 10rem;
    }

</style>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap4.min.css">
<section class="p-0">
    <div class="col-md-12 page-header">
        <h1 class="display-6">DataSet List </h1>
    <p><b>Have you been birding this morning? Or herping last night? The data you gathered could help so 
many people. Record your observations with IBIS. </b></p>
    </div>
</section>
<div class="p-3">
    <div class="row">
        <div class="col-md-12">
<div class="table-responsive">            
<table id="ddset" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>SrNo.</th>
                <!-- <th>DataSet ID</th> -->
                <th>Title</th>
                <th>Sub Title</th>
                <th>Author</th>
                <th>Description</th>
                <th>License</th>
                <th>Citation</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php $srno=1; foreach ($DDset as $key => $value) { ?>    
            <tr>
                <td><?= $srno; ?></td>
                <!-- <td><?= $value->upload_data_id;?></td> -->
                <td><?= ucfirst($value->data_title);?></td>
                <td><?= ucfirst($value->data_subtitle);?></td>
                <td><?= ucfirst($value->data_author);?></td>
                <td><?= $value->data_description;?></td>
                <td><?= $value->data_licenses;?></td>
                <td><?= $value->data_citations;?></td>
                <td><a href="<?= site_url('Profile/DataSet/'.$value->upload_data_id);?>"><button type="button" class="btn-primary">View</button></a></td>
            </tr>
          <?php $srno++; } ?>
        </tbody>       
    </table>
        </div>        
    </div>
</div>
</div>
<?php $this->load->view('common/footer'); ?>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
 $(document).ready(function() {
    $('#ddset').DataTable();
 });   
</script>