<?php $this->load->view('common/header'); ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/dataset.css');?>">
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
            <li class="nav-item">
                <a href="<?= site_url('DataDashboard/Species');?>"><button id="speciesNavitemTabButton" class="nav-link" data-bs-toggle="tab" data-bs-target="#species_ref">
                   <span class="h5">
                        Species
                    </span>
                </button></a>
            </li>
             <li class="nav-item active">
                <a href="<?= site_url('DataLayer/index');?>"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#species_ref">
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
              <li class="nav-item">
                <a href="<?= site_url('DataDashboard/PtArea');?>"><button id="datasetsNavitemTabButton" class="nav-link" data-bs-toggle="tab" data-bs-target="#dataset_ref">                   
                    <span class="h5">
                        Protected area
                    </span>
                </button></a>
            </li>
        </ul>
    </div>
</section>
<section class="team px-5 py-2">
 <div class="container-fluid">
  <div class="col-md-12">
<div class="row"> 
 <?php foreach ($DataLayer as $key => $value) {  ?>  
   <div class="col-md-3">
<div class="dataset-card" style="width: 18rem;">
  <img class="card-img-top" src="<?= $value->layer_url.'SERVICE=WMS&VERSION=1.3.0&REQUEST=GetMap&FORMAT=image/png&TRANSPARENT=true&LAYERS='.$value->layer_name.'&WIDTH=305&HEIGHT=150&CRS=EPSG:4326&STYLES=&BBOX=-90,-180,90,180'?>" alt="Card image cap">
  <div class="card-body tex-left">
    <h5 class="card-title" style="text-align: left;"><?= ucfirst($value->layer_name)?><div class="tex-center" style="font-size: 12px;"><small><b><?= $value->layer_type?></b></small></div>
      <div class="tex-center" style="font-size: 12px;"><small>From:<?= date('d-M-Y', strtotime($value->from_date))?></small>&nbsp;<small>To:<?= date('d-M-Y', strtotime($value->from_to))?></small></div></h5>
    <p class="card-text" style="text-align: left;font-size:12px;height: 15px;"><i><?= $value->description;?></i></p>
    <button class="btn btn-primary" onclick='Dsetinfo("<?php echo $value->layer_url;?>" , "<?php echo $value->layer_name; ?>");'>View</button>
  </div>
</div>      
   </div>  
  <?php } ?>  
</div>
   </div>  
  </div>  
 </section>
<?php $this->load->view('common/footer'); ?> 
<script src="<?= base_url(); ?>assets/js/data_layer.js"></script>
<div class="modal" id="DatasetVMap" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="apdatasetTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="resetDrp()" aria-label="Close"></button>
            </div>            
            <div class="modal-body row">
                <div id="DatasetViewMapD" style="width:100%; height:500px;"></div>     
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                
            </div>
        </div>
    </div>
</div>