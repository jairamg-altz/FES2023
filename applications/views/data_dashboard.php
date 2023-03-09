<?php $this->load->view('common/header'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="<?= base_url(); ?>assets/css/data_dashboard.css" rel="stylesheet">
<style> 
#button{
  display:block;
  margin:20px auto;
  padding:10px 30px;
  background-color:#eee;
  border:solid #ccc 1px;
  cursor: pointer;
}
#overlay{   
  position: fixed;
  top: 0;
  z-index: 100;
  width: 100%;
  height:100%;
  display: none;
  background: rgba(0,0,0,0.6);
}
.cv-spinner {
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;  
}
.spinner {
  width: 40px;
  height: 40px;
  border: 4px #ddd solid;
  border-top: 4px #2e93e6 solid;
  border-radius: 50%;
  animation: sp-anime 0.8s infinite linear;
}
@keyframes sp-anime {
  100% { 
    transform: rotate(360deg); 
  }
}
.is-hide{
  display:none;
}
</style>
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
    <div id="overlay">
  <div class="cv-spinner">
    <span class="spinner"></span>
  </div>
</div>
    <div class="Data-nav-tabs">
        <ul class="nav nav-tabs justify-content-around">
            <li class="nav-item">
               <a href="<?= site_url('DataDashboard/index');?>"> <button class="nav-link <?php if($this->uri->segment(1)=='DataDashboard') { echo 'active'; }?>" data-bs-toggle="tab" data-bs-target="#fea_ref">
                    <span class="h5">
                        Featured
                    </span>
                </button></a>
            </li>
            <li class="nav-item">
                <a href="<?= site_url('DataDashboard/Species');?>"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#species_ref">
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
                <a href="<?= site_url('DataDashboard/Dataset');?>"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#dataset_ref">
                   
                    <span class="h5">
                        Data Set
                    </span>
                </button></a>
            </li>
            <li class="nav-item">
                <a href="<?= site_url('DataDashboard/PtArea');?>"><button id="datasetsNavitemTabButton" class="nav-link" data-bs-toggle="tab" data-bs-target="#dataset_ref">                   
                    <span class="h5">
                        Protected area
                    </span>
                </button></a>
            </li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="container-fluid tab-pane active" id="fea_ref" style="background-color:#f3f3f3">
           <div class="container-fluid">
             <div class="col-md-12">
              <div class="row">
                  <div class="col">
                    <div class="card-body"><h6 class="card-title dataColl">Featured Collection</h6>
</div>
             <div class="row g-4">
  <div class="col" >
    <div class="card">
  <img class="card-img-top" src="<?= IMAGE_URL.'../uploads/SpeciesData.png';?>" alt="Card image cap">
   <div id="speciesCardDiv" class="card-body" style="cursor: pointer;">
   <a href="<?= site_url('DataDashboard/Species');?>"><h6 class="card-title" style="text-align:center;">Species Data</h6></a>
    <p class="card-text" style="text-align:center;">Here, you can get information related to any species, such as taxonomy, conservation status, range distribution maps, and research data.</p>
  </div>
</div>
  </div>
  <div class="col">
    <div class="card">
  <img class="card-img-top" src="<?= IMAGE_URL.'../uploads/DataLayers.png';?>" alt="Card image cap" style="border-radius: 8px;">
   <div id="datalayersCardDiv" class="card-body" style="cursor: pointer;">
   <a href="<?= site_url('DataLayer/index');?>"><h6 class="card-title" style="text-align:center;">Data Layers</h6></a>
    <p class="card-text" style="text-align:center;">You can view a range of interactive data representations of ecological or physical and environmental layers.</p>
  </div>
</div>
  </div>
  <div class="col">
    <div class="card">
  <img class="card-img-top" src="<?= IMAGE_URL.'../uploads/DataSets.png';?>" alt="Card image cap" style="border-radius: 8px;">
   <div id="datasetsCardDiv" class="card-body" style="cursor: pointer; ;">
   <a href="<?= site_url('DataDashboard/Dataset');?>"><h6 class="card-title" style="text-align:center;">Data Sets</h6></a>
    <p class="card-text" style="text-align:center;">Here, users can view a catalogue of scientific research data that IBIS users
have uploaded in the Hefty Data section.</p>
  </div>
</div>
  </div>
  <!-- <div class="col">
    <div class="card">
  <img class="card-img-top" src="<?= IMAGE_URL.'../uploads/Reports.png';?>" alt="Card image cap" style="border-radius: 8px;">
   <div id="reportsCardDiv" class="card-body" style="cursor: pointer;">
   <a onclick="dr();"><h6 class="card-title" style="text-align:center;">Reports</h6></a>
    <p class="card-text" style="text-align:center;">In this section you can select any administrative hierarchy and download
biodiversity reports.</p>
  </div>
</div>
  </div> -->
  <div class="col">
    <div class="card">
  <img class="card-img-top" src="<?= IMAGE_URL.'../uploads/ProtectedArea.png';?>" alt="Card image cap" style="border-radius: 8px;">
   <div id="reportsCardDiv" class="card-body" style="cursor: pointer;">
   <a onclick="pr();"><h6 class="card-title" style="text-align:center;">Protected Area</h6></a>
    <p class="card-text" style="text-align:center;">Here, Explore Kalpavriksh's Protected Area Update newsletter in a map-based format.</p>
  </div>
</div>
  </div>
</div> </div>
             </div>  
           </div>
        </div>
    </div>
<div class="container-fluid tab-pane" id="report_ref">
            <div class="row">
            <div class="card-body">
           <h2 class="alert-primary" style="text-align:center;">Under Development!</h2>
</div>
    </div>
    </div>
</div>
</section>
<?php $this->load->view('common/footer'); ?>
<script src="<?= base_url(); ?>assets/js/data_dashboard.js"></script>
<script type="text/javascript">
function ddl() {
        alert("This page under development.");
    }
function dr() {
        alert("This page under development.");
    }
function pr() {
        alert("This page under development.");
    }        
</script>