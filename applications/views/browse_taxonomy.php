<?php $this->load->view('common/header'); ?>
<link rel="stylesheet" href="<?= base_url();?>assets/plugins/fontawesome-free/css/all.min.css">
<link rel="stylesheet" href="<?= base_url();?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
<link rel="stylesheet" href="<?= base_url();?>assets/dist/css/adminlte.min2167.css?v=3.2.0">
<link rel="stylesheet" href="<?= base_url();?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url();?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url();?>assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/browse_taxonomy.css');?>">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<section class="p-0">
    <div class="col-md-12 page-header">
        <h1 class="display-6">Browse Complete Taxonomy </h1>
    <p><b>Have you been birding this morning? Or herping last night? The data you gathered could help so 
many people. Record your observations with IBIS. </b></p>
    </div>
</section>
<section class="py-3 p-3">
  <div class="col-md-12">
  <div class="row">           
   <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home"><b>Location </b></a></li>
    <?php if(!empty($doccurence)) { ?>
    <li><a data-toggle="tab" href="#menu11"><b>Occurrence </b></a></li>
<?php } ?>
<?php if(!empty($drecord)) { ?>
    <li><a data-toggle="tab" href="#menu1"><b>Record level</b></a></li>
<?php } ?> 
<?php if(!empty($dtaxon)) { ?>   
    <li><a data-toggle="tab" href="#menu2"><b>Taxon </b></a></li>
    <?php } if(!empty($devent)) { ?>
    <li><a data-toggle="tab" href="#menu3"><b>Event </b></a></li>
   <?php } ?>
  </ul>
 <div class="tab-content">
    <?php if(!empty($dlocation)) { ?>
    <div id="home" class="tab-pane fade in active">
    <div class="card-body">
        <h3 class="card-title">Location</h3></div>
   <div class="table-responsive">   
   <table id="ddlocaton" class="table table-striped table-bordered">
    <thead>
            <tr>
                <th>SrNo.</th>
                <th>Latitude</th>
                <th>Longitude</th>
               <!-- <th>Higher Geography Id</th>
               <th>Higher Geography</th>
               <th>Continent</th>
               <th>Waterbody</th>
               <th>Island Group</th>
               <th>Country</th>
               <th>Country Code</th>
               <th>State Province</th>
               <th>Municipality</th>
               <th>Locality</th>
               <th>Minimum Elevation In Meters</th>
               <th>Maximum Elevation In Meters</th>
               <th>Location According To</th>
               <th>Location Remarks</th>
               <th>Coordinate Uncertainity In Meters</th>
               <th>Coordinate Precision</th> -->
               <!-- <th>Observation ID</th> -->
            </tr>
        </thead>
        <tbody>
            <?php $srno =1; foreach($dlocation as $dlocationRow) { ?>   
            <tr>
                <td><?= $srno; ?></td>
                <td><?= $dlocationRow->decimal_latitude;?></td>
                <!-- <td><?= $dlocationRow->higher_geography_id;?></td>
                <td><?= $dlocationRow->higher_geography;?></td>
                <td><?= $dlocationRow->continent;?></td>
                <td><?= $dlocationRow->waterbody;?></td>
                <td><?= $dlocationRow->island_group;?></td>
                <td><?= $dlocationRow->country;?></td>
                <td><?= $dlocationRow->country_code;?></td>
                <td><?= $dlocationRow->state_province;?></td>
                <td><?= $dlocationRow->municipality;?></td>
                <td><?= $dlocationRow->locality;?></td>
                <td><?= $dlocationRow->minimum_elevation_in_meters;?></td>
                <td><?= $dlocationRow->maximum_elevation_in_meters;?></td>
                <td><?= $dlocationRow->location_according_to;?></td>
                <td><?= $dlocationRow->location_remarks;?></td>
                <td><?= $dlocationRow->coordinate_uncertainity_in_meters;?></td>
                <td><?= $dlocationRow->coordinate_precision;?></td> -->
                <td><?= $dlocationRow->decimal_longitude;?></td>

            </tr>
            <?php $srno++;} ?>
        </tbody>
        </table>    </div></div> <?php } ?>
    <?php if(!empty($doccurence)) { ?>    
    <div id="menu11" class="tab-pane fade">
        <div class="card-body">
        <h3 class="card-title">Occurrence</h3></div>
        <div class="table-responsive">   
   <table id="ddOccurrence" class="table table-striped table-bordered">
    <thead>
            <tr>
                <th>SrNo.</th>
                <th>Occurence Id</th>
               <th>Recorded By</th>
               <!-- <th>Recorded By Id</th> -->
               <th>Individual Count</th>
               <th>Sex</th>
               <th>Lifestage</th>
               <th>Reproductive Condition</th>
               <th>Behaviour</th>
               <th>Occurence Status</th>
               <th>Associated Media</th>
               <th>Associated Occurences</th>
               <th>Occurence Remarks</th>
               <th>Observation ID</th>
            </tr>
        </thead>
        <tbody>
            <?php $srno =1; foreach($doccurence as $drecordRow) { ?>   
            <tr>
                <td><?= $srno; ?></td>
                <td><?= $drecordRow->occurence_id;?></td>
                <td><?= $drecordRow->recorded_by;?></td>
                <!-- <td><?= $drecordRow->recorded_by_id;?></td> -->
                <td><?= $drecordRow->individual_count;?></td>
                <td><?= $drecordRow->sex;?></td>
                <td><?= $drecordRow->lifestage;?></td>
                <td><?= $drecordRow->reproductive_condition;?></td>
                <td><?= $drecordRow->behaviour;?></td>
                <td><?= $drecordRow->occurence_status;?></td>
                <td><?= $drecordRow->associated_media;?></td>                
                <td><?= $drecordRow->associated_occurences;?></td>
                <td><?= $drecordRow->occurence_remarks;?></td>
                <td><?= $drecordRow->observation_id;?></td>

            </tr>
            <?php $srno++;} ?>
        </tbody>
        </table>    </div>
        
      
    </div>
<?php } ?>
<?php if(!empty($drecord)) { ?>
 <div id="menu1" class="tab-pane fade">
        <div class="card-body">
        <h3 class="card-title">Record level</h3></div>
       <div class="table-responsive">   
   <table id="ddrecord" class="table table-striped table-bordered">
    <thead>
            <tr>
                <th>SrNo.</th>
                <!-- <th>Record Level Id</th> -->
               <!-- <th>Type</th> -->
               <!-- <th>Modified</th>
               <th>License</th>
               <th>Rights Holder</th>
               <th>Access Rights</th>
               <th>Institution Id</th>
               <th>Collection Id</th>
               <th>Dataset Id</th>
               <th>Institution Code</th>
               <th>Collection Code</th>
               <th>Dataset Name</th>
               <th>Basis Of Record</th>
               <th>Dynamic Properties</th> -->
               <!-- <th>File Path</th> -->
               <th>File Uri</th>
               <!-- <th>Is Image</th>
               <th>Is Video</th> -->
               <!-- <th>Observation Id</th> -->
            </tr>
        </thead>
        <tbody>
            <?php $srno =1; foreach($drecord as $drecordRow) { ?>   
            <tr>
                <td><?= $srno; ?></td>
                <!-- <td><?= $drecordRow->record_level_id;?></td> -->
                <!-- <td><?= $drecordRow->type;?></td>
                <td><?= $drecordRow->modified;?></td>
                <td><?= $drecordRow->license;?></td>
                <td><?= $drecordRow->rights_holder;?></td>
                <td><?= $drecordRow->access_rights;?></td>
                <td><?= $drecordRow->institution_id;?></td>
                <td><?= $drecordRow->collection_id;?></td>
                <td><?= $drecordRow->dataset_id;?></td>
                <td><?= $drecordRow->institution_code;?></td>                
                <td><?= $drecordRow->collection_code;?></td>
                <td><?= $drecordRow->dataset_name;?></td>
                <td><?= $drecordRow->basis_of_record;?></td>
                <td><?= $drecordRow->dynamic_properties;?></td> -->
                <!-- <td><?= $drecordRow->file_path;?></td> -->
                <td><a href="<?= $drecordRow->file_uri;?>" target="_blank()"><?= $drecordRow->file_uri;?></a></td>
                <!-- <td><?= $drecordRow->is_image;?></td>
                <td><?= $drecordRow->is_video;?></td> -->
               <!--  <td><?= $drecordRow->observation_id;?></td> -->

            </tr>
            <?php $srno++;} ?>
        </tbody>
        </table>    </div>
    </div>
     <?php } ?>
    <?php if(!empty($dtaxon)) { ?> 
    <div id="menu2" class="tab-pane fade">
        <div class="card-body">
        <h3 class="card-title">Taxon</h3></div>
       <div class="table-responsive">   
   <table id="ddtaxon" class="table table-striped table-bordered">
    <thead>
            <tr>
                <th>SrNo.</th>
                <!-- <th>Taxon Id</th> -->
               <!-- <th>Observation Id</th> -->
               <!-- <th>Scientific Name Id</th>
               <th>Accepted Name Usage Id</th>
               <th>Parent Name Usage Id</th>
               <th>Original Name Usage Id</th>
               <th>Name According To Id</th>
               <th>Name Published In Id</th>-->
               <th>Scientific Name</th>
               <!-- <th>Accepted Name Usage</th>
               <th>Parent Name Usage</th>
               <th>Original Name Usage</th>
               <th>Name According To</th>
               <th>Name Published In</th> 
               <th>Name Published In Year</th>
               <th>Higher Classification</th>
               <th>Kingdom</th>
               <th>Phylum</th>
               <th>Class</th>
               <th>Order</th>
               <th>Family</th>
               <th>Subfamily</th>
               <th>Genus</th>
               <th>Generic Name</th>
               <th>Subgenus</th>
               <th>Infra Generic Epithet</th>
               <th>Specific Epithet</th>
               <th>Infra Specific Epithet</th>
               <th>Cultivar Epithet</th>
               <th>Taxon Rank</th>
               <th>Scientific Name Authorship</th>
               <th>Vernacular Name</th>
               <th>Nomenclatural Code</th>
               <th>Taxonomic Status</th>
               <th>Nomenclatural Status</th> -->
            </tr>
        </thead>
        <tbody>
            <?php $srno =1; foreach($dtaxon as $drecordRow) { ?>   
            <tr>
                <td><?= $srno; ?></td>
                <!-- <td><?= $drecordRow->taxon_id;?></td> -->
                <!-- <td><?= $drecordRow->observation_id;?></td> -->
                <!-- <td><?= $drecordRow->scientific_name_id;?></td>
                <td><?= $drecordRow->accepted_name_usage_id;?></td>
                <td><?= $drecordRow->parent_name_usage_id;?></td>
                <td><?= $drecordRow->original_name_usage_id;?></td>
                <td><?= $drecordRow->name_according_to_id;?></td>
                <td><?= $drecordRow->name_published_in_id;?></td> -->
                <td><?= $drecordRow->scientific_name;?></td>
                <!-- <td><?= $drecordRow->accepted_name_usage;?></td>                
                <td><?= $drecordRow->parent_name_usage;?></td>
                <td><?= $drecordRow->original_name_usage;?></td>
                <td><?= $drecordRow->name_according_to;?></td>
                <td><?= $drecordRow->name_published_in;?></td>
                <td><?= $drecordRow->name_published_in_year;?></td>
                <td><?= $drecordRow->higher_classification;?></td>
                <td><?= $drecordRow->kingdom;?></td>
                <td><?= $drecordRow->phylum;?></td>
                <td><?= $drecordRow->class;?></td>
                <td><?= $drecordRow->order;?></td>
                <td><?= $drecordRow->family;?></td>
                <td><?= $drecordRow->subfamily;?></td>
                <td><?= $drecordRow->genus;?></td>
                <td><?= $drecordRow->generic_name;?></td>
                <td><?= $drecordRow->sub_genus;?></td>
                <td><?= $drecordRow->infra_generic_epithet;?></td>
                <td><?= $drecordRow->specific_epithet;?></td>
                <td><?= $drecordRow->infra_specific_epithet;?></td>
                <td><?= $drecordRow->cultivar_epithet;?></td>
                <td><?= $drecordRow->taxon_rank;?></td>
                <td><?= $drecordRow->scientific_name_authorship;?></td>
                <td><?= $drecordRow->vernacular_name;?></td>
                <td><?= $drecordRow->nomenclatural_code;?></td>
                <td><?= $drecordRow->taxonomic_status?></td>
                <td><?= $drecordRow->nomenclatural_status?></td> -->

            </tr>
            <?php $srno++;} ?>
        </tbody>
        </table>    </div>
    </div> <?php } ?>
<?php if(!empty($devent)) { ?>
     <div id="menu3" class="tab-pane fade">
        <div class="card-body">
        <h3 class="card-title">Event</h3></div>
       <div class="table-responsive">   
   <table id="ddEvent" class="table table-striped table-bordered">
    <thead>
            <tr>
                <th>SrNo.</th>
                <th>Event Id</th>
               <th>Observation ID</th>
               <th>Parent Event Id</th>
               <th>Event Date</th>
               <th>Event Time</th>
               <th>Year</th>
               <th>Month</th>
               <th>Day</th>
               <th>Habitat</th>
               <th>Event Remarks</th>
               <th>Sampling Protocol</th>
               <th>Sampling Effort</th>
            </tr>
        </thead>
        <tbody>
            <?php $srno =1; foreach($devent as $drecordRow) { ?>   
            <tr>
                <td><?= $srno; ?></td>
                <td><?= $drecordRow->event_id;?></td>
                <td><?= $drecordRow->observation_id;?></td>
                <td><?= $drecordRow->parent_event_id;?></td>
                <td><?= $drecordRow->event_date;?></td>
                <td><?= $drecordRow->event_time;?></td>
                <td><?= $drecordRow->year;?></td>
                <td><?= $drecordRow->month;?></td>
                <td><?= $drecordRow->day;?></td>
                <td><?= $drecordRow->habitat;?></td>                
                <td><?= $drecordRow->event_remarks;?></td>
                <td><?= $drecordRow->sampling_protocol;?></td>
                <td><?= $drecordRow->sampling_effort;?></td>
            </tr>
            <?php $srno++;} ?>
        </tbody>
        </table>    </div>
    </div>
<?php } ?>
  </div>               
    </div></div>
</section>
<?php $this->load->view('common/footer'); ?>
<script src="<?= base_url();?>assets/plugins/jquery/jquery.min.js"></script>
<script src="<?= base_url();?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url();?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="<?= base_url();?>assets/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="<?= base_url();?>assets/plugins/raphael/raphael.min.js"></script>
<script src="<?= base_url();?>assets/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="<?= base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url();?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url();?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url();?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url();?>assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url();?>assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url();?>assets/plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url();?>assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url();?>assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url();?>assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url();?>assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url();?>assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script type="text/javascript">
 $(document).ready(function() {
    $('#ddlocaton').DataTable();
    $('#ddOccurrence').DataTable();
    $('#ddrecord').DataTable();
    $('#ddtaxon').DataTable();
    $('#ddEvent').DataTable();
 });   
</script>