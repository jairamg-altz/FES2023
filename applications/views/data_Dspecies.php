<?php $this->load->view('common/header'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="<?= base_url(); ?>assets/css/data_dashboard.css" rel="stylesheet">
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
            <li class="nav-item active">
                <a href="<?= site_url('DataDashboard/speciesDetails/'.$scientificName);?>"><button id="speciesNavitemTabButton" class="nav-link active" data-bs-toggle="tab" data-bs-target="#species_ref">
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
        </ul>
    </div>
    <input type="hidden" name="speciesDetail" value="<?= $scientificName; ?>" id="spDDetail">
    <div class="tab-content">        
        <div class="container-fluid tab-pane active" id="species_ref"> 
        <div class="row">
           <div id="Datadashboard_map" class="map col-md-12">
             <div class="col-md-6 position-absolute" style="z-index: 1;margin-left:2%;">
                <div class="input-group px-5 py-4">
                    <input id="searchSpeciesTextBox" class="form-control" type="search" placeholder="Search species..." onclick="toggleDropDownDiv()" onkeyup="searchSpeciesOnKeyPress(this.value)" aria-label="Search" aria-describedby="basic-addon2">
                </div>
                <div id="searchSpeciesTextBoxDropDown" class="dropdown-div"></div>
                <div id="currentPosition"></div>
            </div>
        </div> 
         </div> 
        <div class="Data-nav-tabs">
        <ul class="nav nav-tabs justify-content-around">
            <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#Overview_ref">
                    <span class="h5">
                        Overview
                    </span>
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#Descriptions_ref">
                   <span class="h5">
                        Descriptions
                    </span>
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#Literature_ref">
                    <span class="h5">
                        Literature
                    </span>
                </button>
            </li>
           <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#Media_ref">            
                    <span class="h5">
                        Media
                    </span>
                </button>
            </li>
        </ul>
    </div> 
    <div class="tab-content">
        <div class="container-fluid tab-pane active" id="Overview_ref">
            <table class="table table-striped">
  <tbody>
    <tr>
      <th scope="row">Family</th>
      <td><span id="pppp115"></span></td>
        </tr>
    <tr>
      <th scope="row">Genus</th>
      <td><span id="pppp116"></span></td>
      
    </tr>
    <tr>
      <th scope="row">Species</th>
      <td><span id="pppp1175"></span></td>     
    </tr>
    <tr>    
      <th scope="row">Vernacular Name</th>
      <td><span id="pppp111"></span></td>
      
    </tr>
  </tbody>
</table>
        </div>
        <div class="container-fluid tab-pane" id="Descriptions_ref">
        <table class="table table-striped">   
    <div class="card-body">
    <h4 class="card-title">Taxonomy</h4>
        </div>     
  <tbody>
    <tr>
      <th scope="row">Kingdom</th>
      <td><span id="pppp"></span></td>
        </tr>
    <tr>
      <th scope="row">Phylum</th>
      <td><span id="pppp1"></span></td>
      
    </tr>
    <tr>
      <th scope="row">Class</th>
      <td><span id="pppp2"></span></td>
     
    </tr>
    <tr>
      <th scope="row">Subclass</th>
      <td><span id="pppp3"></span></td>
      
    </tr>
    <tr>
      <th scope="row">Order</th>
      <td><span id="pppp4"></span></td>
      
    </tr>
    <tr>
      <th scope="row">Family</th>
      <td><span id="pppp5"></span></td>
      
    </tr>
    <tr>
      <th scope="row">Subfamily</th>
      <td><span id="pppp6"></span></td>
      
    </tr>
  </tbody>
</table>
<p><div id="ccc1"></div></p>
<p><div id="sss1"></div></p>
<p><div id="hhh1"></div></p>
<p><div id="cms11"></div></p>
<p><table class="table table-striped">
    
    <div class="card-body">
    <h4 class="card-title">Narrative</h4>
        </div>
        
  <tbody>
    <tr>
      <th scope="row">Conservation Measures</th>
      <td><span id="nnn1"></span></td>
        </tr>
    <tr>
      <th scope="row">Geographic Range</th>
      <td><span id="nnn2"></span></td>      
    </tr>
    <tr>
      <th scope="row">Habitat</th>
      <td><span id="nnn3"></span></td>     
    </tr>
    <tr>
      <th scope="row">Population</th>
      <td><span id="nnn4"></span></td>      
    </tr>
    <tr>
      <th scope="row">Population Trend</th>
      <td><span id="nnn5"></span></td>      
    </tr>
    <tr>
      <th scope="row">Rationale</th>
      <td><span id="nnn6"></span></td>      
    </tr>
    <tr>
      <th scope="row">Taxonomic Notes</th>
      <td><span id="nnn7"></span></td>      
    </tr>
    <tr>
      <th scope="row">Threates</th>
      <td><span id="nnn8"></span></td>      
    </tr>
    <tr>
      <th scope="row">Use and Trade</th>
      <td><span id="nnn9"></span></td>      
    </tr>
  </tbody>
</table></p>
</div>
<div class="container-fluid tab-pane" id="Literature_ref">
    <div class="card-body">
    <h3 class="card-title">ReFindit</h3></div>
    <div class="profile-nav-tabs">
        <ul class="nav nav-tabs justify-content-around" id="tabIData">
           
        </ul>
    </div>
    <div class="tab-content" id="dataTab">

    </div>   
    </div>
    <div class="container-fluid tab-pane" id="Maps_ref">
    </div>
    <div class="container-fluid tab-pane" id="Media_ref">
        <div id="obs_img"></div>

    </div>
    </div>  
        </div>        
</div>
</section>
<?php $this->load->view('common/footer'); ?>
<script src="<?= base_url(); ?>assets/js/data_Ddashboard.js"></script>