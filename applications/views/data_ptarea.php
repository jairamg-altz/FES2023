<?php $this->load->view('common/header'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link href="<?= base_url(); ?>assets/css/data_dashboard.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
<section class="p-0">
    <div class="col-md-42 page-header" style="width: 100%;">
        <div class="Data-header-details">
          <div class="Data-header-details-desc">
                <div class="desc-1">
                    <h4>
                       Data Dashboard
                    </h4>
                    <p class="col-md-6">
                       How many species inhabit the Indian subcontinent? What exactly do we
know about them? Some of us are in the quest to find answers. Many more
of us are curious to know. The Data Dashboard of IBIS is an effort to bring
such information pertaining to all species to anyone who wants to know.
                    </p>
                </div>
                <div class="desc-1">
                    <h5>
                       Statistics
                    </h5>
                    <div class="col-md-12">
                    <div class="row" style="flex-wrap: nowrap;">   
                     <span class="col-md-3 card"><span class="card-body"><p style="color: black"><?php if($TotalStatistics[0]['sp_parameter']=='Taxonomy Data') { echo $TotalStatistics[0]['sp_count']; } elseif($TotalStatistics[1]['sp_parameter']=='Taxonomy Data') { echo $TotalStatistics[1]['sp_count'];} elseif($TotalStatistics[2]['sp_parameter']=='Taxonomy Data') { echo 
                        $TotalStatistics[2]['sp_count']; } elseif($TotalStatistics[3]['sp_parameter']=='Taxonomy Data') { echo 
                        $TotalStatistics[3]['sp_count']; } else { echo 0; }?><div class="text-muted">No. of Occurence Data</div></p></span></span> &nbsp;

                    <span class="col-md-3 card"><span class="card-body"><p style="color: black"><?php if($TotalStatistics[0]['sp_parameter']=='Total Species') { echo $TotalStatistics[0]['sp_count']; } elseif($TotalStatistics[1]['sp_parameter']=='Total Species') { echo $TotalStatistics[1]['sp_count'];} elseif($TotalStatistics[2]['sp_parameter']=='Total Species') { echo $TotalStatistics[2]['sp_count']; } elseif($TotalStatistics[3]['sp_parameter']=='Total Species') { echo $TotalStatistics[3]['sp_count']; } else { echo 0; }?><div class="text-muted">No. of Species</div></p></span>
                </span>&nbsp;
                    
                    <span class="col-md-3 card"><span class="card-body"><p style="color: black"><?php if($TotalStatistics[0]['sp_parameter']=='Total Families') { echo $TotalStatistics[0]['sp_count']; } elseif($TotalStatistics[1]['sp_parameter']=='Total Families') { echo $TotalStatistics[1]['sp_count'];} elseif($TotalStatistics[2]['sp_parameter']=='Total Families') { echo $TotalStatistics[2]['sp_count']; } elseif($TotalStatistics[3]['sp_parameter']=='Total Families') { echo $TotalStatistics[3]['sp_count']; } else { echo 0; }?><div class="text-muted">No. of Total Families</div></p></span></span>&nbsp;

                    <span class="col-md-3 card"><span class="card-body"><p style="color: black"><?php if($TotalStatistics[0]['sp_parameter']=='Added this week') { echo $TotalStatistics[0]['sp_count']; } elseif($TotalStatistics[1]['sp_parameter']=='Added this week') { echo $TotalStatistics[1]['sp_count'];} elseif($TotalStatistics[2]['sp_parameter']=='Added this week') { echo $TotalStatistics[2]['sp_count']; } elseif($TotalStatistics[3]['sp_parameter']=='Added this week') { echo $TotalStatistics[3]['sp_count']; } else { echo 0; }?><div class="text-muted">No. of Added this week</div></p>
                    </span></span></div>
</div>
                </div>              
            </div>
        </div>
    </div>
    <div class="Data-nav-tabs">
        <ul class="nav nav-tabs justify-content-around">
            <li class="nav-item">
                <a href="<?= site_url('DataDashboard/index');?>"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#fea_ref">
                    <span class="h5">
                        Featured
                    </span>
                </button></a>
            </li>
            <li class="nav-item">
                <a href="<?= site_url('DataDashboard/Species');?>"><button id="speciesNavitemTabButton" class="nav-link" data-bs-toggle="tab" data-bs-target="#species_ref">
                   <span class="h5">
                        Species
                    </span>
                </button></a>
            </li>
             <li class="nav-item">
                <a href="<?= site_url('DataLayer/index');?>"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#species_ref">
                   <span class="h5">
                        Data Layers
                    </span>
                </button></a>
            </li>
            <li class="nav-item">
                <a href="<?= site_url('DataDashboard/Dataset');?>"><button id="datasetsNavitemTabButton" class="nav-link" data-bs-toggle="tab" data-bs-target="#dataset_ref">                   
                    <span class="h5">
                        Data Set
                    </span>
                </button></a>
            </li>
             <li class="nav-item active">
                <a href="<?= site_url('DataDashboard/PtArea');?>"><button id="datasetsNavitemTabButton" class="nav-link active" data-bs-toggle="tab" data-bs-target="#dataset_ref">                   
                    <span class="h5">
                        Protected area
                    </span>
                </button></a>
            </li>
        </ul>
    </div>
    <div class="tab-content">        
        <div class="container-fluid tab-pane active" id="species_ref"> 
        <div class="row">
           <div id="protectedArea_map" class="map col-md-12">
            </div> 
            <div id="popup" class="ol-popup">
            <a href="#" id="popup-closer" class="ol-popup-closer"></a>
            <div id="popup-content"></div>
  </div>
         </div>       
        </div>        
</div>

</section>
<section class="p-0">
    <div class="container-fluid">
    <div id="results"></div>
    </div>
    </section>
<?php $this->load->view('common/footer'); ?>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>assets/js/data_protectedArea.js"></script>
<script>
 function getProtectedAreaDetails(location) {
    var datastring = 'location='+location;
$.ajax({
  url: "<?= site_url('DataDashboard/PtAreaAction')?>",
  data:datastring,
  cache: false,
  success: function(html){
    //alert(html); return false;
    $("#results").empty();
    $("#results").append(html);
  }
});
}
$(document).ready(function () {
    $('#example').DataTable();
});   
</script>