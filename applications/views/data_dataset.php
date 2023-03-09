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
               <a href="<?= site_url('DataDashboard/index');?>"> <button class="nav-link" data-bs-toggle="tab" data-bs-target="#fea_ref">
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
            <li class="nav-item active">
                <a href="<?= site_url('DataDashboard/Dataset');?>"><button id="datasetsNavitemTabButton" class="nav-link active" data-bs-toggle="tab" data-bs-target="#dataset_ref">
                   
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
        <div class="container-fluid tab-pane active" id="dataset_ref" style="background-color:#f3f3f3">
          <div class="row">
        <?php foreach($GetDataSet as $GetDataSetRow) { ?>    
        <div class="card">
         <div class="card-body datasets-list-entry">
            <div class="col-md-12 row g-12">
            <div class="col-md-6">
                <h4><?php if(!empty($GetDataSetRow->data_title)) {  echo $GetDataSetRow->data_title; } else{ echo '-'; } ?></h4>
                <h6>Authors: <?php if(!empty($GetDataSetRow->data_author)) { echo $GetDataSetRow->data_author; } else{ echo '-';} ?></h6>
                <span style="font-size:12px;"><?php if(!empty($GetDataSetRow->data_description)) { echo $GetDataSetRow->data_description; } else{ echo '-';} ?></span>
            </div> 
            <div class="col-md-6" style="">
                <button class="col-md-2 btn btn-success btn-block" id="<?= $GetDataSetRow->upload_data_id; ?>" value="<?= $GetDataSetRow->data_title; ?>" onclick="DatasetViewMap(this.id, this.value);"><i class="fa fa-object-ungroup" aria-hidden="true" style="font-size:14px"></i>&nbsp;view</button>
                <button class="col-md-2 btn btn-info btn-block" onclick="Dsetinfo(this.value);" value="<?= $GetDataSetRow->upload_data_id; ?>"><i class="fa fa-info-circle" aria-hidden="true" style="font-size:14px"></i>&nbsp;info</button>
                <a href="<?= site_url('Profile/DataSet/'.$GetDataSetRow->upload_data_id);?>"><button type="button" class="col-md-3 btn btn-primary btn-block"><i class="fa fa-database" aria-hidden="true" style="font-size:14px"></i>&nbsp;Detail</button></a>            
          </div>  
        </div>      
          </div>  
        </div>
    <?php } ?>
    </div>
</div>
</div>
</section>
<?php $this->load->view('common/footer'); ?>
<script src="<?= base_url(); ?>assets/js/data_dashboard.js"></script>
<script type="text/javascript">
function Dsetinfo(value) {      
     $('#DataInfo').modal('show');
     var sdata = 'uploadID='+value;
     var UlicU = site_url('/Dashboard/gtDasLicense');
     $.ajax({
      type: "POST",
      url: UlicU,
      data: sdata,
      cache: false,
      success: function(data){
   // alert(data); return false;
   $("#apdaTitle").empty();
  $("#apdaTitle").append(data);
  }
});    
}     
</script>
 <div class="modal" id="DatasetVMap" tabindex="-1">
    <div class="modal-dialog modal-lg">
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
<div class="modal fade" id="DataInfo" tabindex="-1" aria-labelledby="DataInfoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" >
           <div id="apdaTitle"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>