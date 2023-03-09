<?php $this->load->view('common/header'); ?>
<style>
    .map {
        width: 100%;
        height: 600px;
    }

    .gallery {
        margin-top: 100px;
    }

    .margin-15 {
        margin: 15px;
    }

    
</style>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
<section class="gallery container-fluid">
<div class="row"> 
   <div class="table-responsive">            
<table id="ddset" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>SrNo.</th>
                <th>Checklist ID</th>
                <th>Observation ID</th>
                <th>Event Date</th>
                <th>Event Time</th>
                <th>Travelled Distance</th>
                <th>Party Count</th>
                <th>Observation Type</th>
                <th>Scientific Name</th>
                <th>Kingdom</th>
                <th>Phylum</th>
                <th>Class</th>
                <th>Order</th>
                <th>Family</th>
                <th>Subfamily</th>
                <th>Genus</th>
                <th>Taxon ID</th>
                <th>Collection Code</th>
                <th>Dynamic properties</th>
                <th>Individual Count</th>
                <th>Recorded By</th>
                <th>Habitat</th>
                <th>Event Remark</th>
                <th>Continent</th>
                <th>Waterbody</th>
                <th>Island Group</th>
                <th>Country</th>
                <th>Country Code</th>
                <th>State Province</th>
                <th>Municipality</th>
                <th>Locality</th>
            </tr>
        </thead>
        <tbody>
        <?php $srno=1; foreach ($data as $key => $value) { ?>    
            <tr>
                <td><?= $srno;?></td>
                <td><?= $value->checklist_id;?></td>
                <td><?= $value->observation_id;?></td>
                <td><?= $value->event_date;?></td>
                <td><?php date('d-M-Y', strtotime($value->event_time))?></td>
                <td><?= $value->travelled_distance;?></td>
                <td><?= $value->party_count;?></td>
                <td><?= $value->observation_type;?></td>
                <td><?= $value->scientific_name;?></td>
                <td><?= $value->kingdom;?></td>
                <td><?= $value->phylum;?></td>
                <td><?= $value->class;?></td>
                <td><?= $value->order;?></td>
                <td><?= $value->family;?></td>
                <td><?= $value->subfamily;?></td>
                <td><?= $value->genus;?></td>
                <td>-</td>
                <td>-</td>
                <td><?= $value->dynamic_properties;?></td>
                <td><?= $value->individual_count;?></td>
                <td><?= $value->recorded_by;?></td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                </tr>
          <?php $srno++; } ?>
        </tbody>       
    </table>
        </div>   
    </div>
</section>
<?php $this->load->view('common/footer'); ?>
<script src="<?= base_url(); ?>assets/js/view-observation.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#ddset').DataTable( {
        dom: 'Bfrtip',
        buttons: [
             'excel'
        ]
    } );
} );    
   
</script>