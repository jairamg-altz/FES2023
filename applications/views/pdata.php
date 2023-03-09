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

    .checklist-block-left {
        background: linear-gradient(180deg, #31B551 0%, #2249A7 100%);
        border-radius: 0.5rem;
        display: grid;
        align-content: space-between;
        color: #fff;
        padding: 0;
        min-height: 90vh;
    }
 .card-btn-close {
        position: relative;
        float: right !important;
        top: 0px !important;
        left: 0;
        display: none;
        font-size: 10px;
        background-color: red;
        border-radius: 20px;
    }

    .member:hover>.card-btn-close {
        display: inline;
    }   
</style>

<section class="p-0">
    <div class="col-md-12 page-header">
        <h1 class="display-6">Project Column Data</h1>
    </div>
</section>
<div class="p-3">
    <div class="row">
        <div class="col-md-6">
        </div>
        <div class="col-md-6 text-end">
            <button class="btn btn-outline-dark btn-lg" type="button" onclick="addObservationCardP();">Add</button>
        </div>
    </div>
</div>
<section class="team px-5 py-2">
    <div class="card-holder">
       
            <div class="row" id="cardAppend">
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch formCard">
                  <form id="form_1" method="POST" enctype="multipart/form-data" action="<?= site_url('PMS/ProjectDynamicColumn');?>">   
                    <div class="member w-100">
                        <button type="button" class="btn-close card-btn-close" onclick="removeCard(this)" aria-label="Close"></button>
                        <div class="member-info">
                            <div class="accordion" id="accordionObservation">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOneObservation">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseObservation" aria-expanded="true" aria-controls="collapseObservation">
                                            Project Column
                                        </button>
                                    </h2>
                                    <div id="collapseObservation" class="accordion-collapse collapse show" aria-labelledby="headingOneObservation" data-bs-parent="#accordionObservation">
                                    <div class="accordion-body">
                                    <div class="my-3 dropdown">
                                    <input id="addObservationTaxonID1" class="addObservationTaxonID1" type="hidden" name="addObservationTaxonID">
                                    <input type="text" name="addObservationSpeciesName" id="addObservationSpeciesName" class="form-control addObservationSpeciesName" placeholder="Species Name" list="speciesNameListSuggestions" onkeyup="getSpecies(this);" autocomplete="off" required>
                                    <div id="addObservationSpeciesNameDropDown" class="dropdown-content addObservationSpeciesNameDropDown">
                                                </div>
                                    <span class="input_error_message" id="s_name_error"></span>
                                    </div>    
                                        <input id="addObservationCheckListId1" type="hidden" name="project_id" value="<?= $project_id ?>">
                                        <input id="addObservationCheckListId1" type="hidden" name="pchecklistId" value="<?= $pchecklistId ?>">    
                                         <?php foreach($ppD as $prows) { 

                                            if(!empty($prows->attribute_name)) { ?>               
                                          <div class="my-3">
                                          <label><h6><?= ucfirst($prows->attribute_name);?></h6></label>  
                                          <?php if($prows->data_type=='boolean') { ?>
                                            <select name="<?= $prows->attribute_name;?>" class="form-control"> 
                                               <option value="Yes">Yes</option>
                                               <option value="No">No</option> 
                                            </select>
                                         
                                             <?php } else {?>   
                                          <input type="<?= $prows->data_type;?>" name="<?= $prows->attribute_name;?>" class="form-control"  <?php if($prows->is_mandatory=='Yes') { echo "required"; } ?> placeholder="<?= $prows->attribute_name;?>">
                                      <?php } ?>                                                                      
                                            </div>  
                                            <?php } }?>     
                                            <div class="my-3">
                                               <label for="img">Select image:</label>
                                               <input type="file" name="image[]" class="form-control" accept="image/png, image/jpeg, audio/*,video/*" /> 
                                            </div>
                                            <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingLocation1">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLocation1" aria-expanded="false" aria-controls="collapseLocation">
                                            Location
                                        </button>
                                    </h2>
                                    <div id="collapseLocation1" class="accordion-collapse collapse" aria-labelledby="headingLocation" data-bs-parent="#accordionObservation2">
                                        <div class="accordion-body">
                                            <div class="my-3">
                                                <select class="form-control form-select" name="addObservationGeoprivacy" required="required">
                                                    <option value="">Select Geoprivacy</option>
                                                    <option value="Public">Public</option>
                                                    <option value="Obscured">Obscured</option>
                                                    <option value="Private">Private</option>
                                                </select>
                                                <span class="input_error_message" id="location_latitude_error1"></span>
                                            </div>
                <?php if($otype=='Stationary' || $otype=='Incidental') {  ?>  
                                           <div class="my-3">
                                                <input type="text" name="addObservationLatitude" id="location_latitude1" class="form-control location_latitude1" placeholder="Longitude" value="<?= $Latitude; ?>" readonly>
                                                
                                            </div>
                                            <div class="my-3">
                                                <input type="text" name="addObservationLongitude" id="location_longitude1" class="form-control location_longitude1" placeholder="Latitude" value="<?= $Longitude; ?>" readonly>
                                               
                                            </div>
                                        <?php } else { ?> 
                                        <input type="hidden" name="latll" class="latll" value="<?= $Latitude; ?>">
                                         <input type="hidden" name="lonll" class="lonll" value="<?= $Longitude; ?>">  
                                         <input type="hidden" class="ccoID" id="ccoID" value="0" name="ccoID">  
                                        <div class="my-3">
                                            <select class="form-control" onchange="locationActivity(this.value)" id="my_select"> 
                                            <option value="">Select Location</option>    
                                            <option value="Checklist">Checklist</option>
                                            <option value="Map">Map</option>
                                            </select>    
                                            </div>
                                            <div class="my-3">
                                                <input type="text" name="addObservationLatitude" id="location_latitude" class="form-control location_latitude" placeholder="Longitude" required>
                                            </div>
                                            <div class="my-3">
                                                <input type="text" name="addObservationLongitude" id="location_longitude" class="form-control location_longitude" placeholder="Latitude" required>
                                            </div>
                                            <?php } ?> 
                                              
                                        </div>
                                    </div>
                                </div>                                            
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    <button class="btn btn-primary float-right" type="submit">Submit</button>
</form>
    </div>
</div>

</div>
</section>
<?php $this->load->view('common/footer'); ?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets/js/project.js"></script>
<script src="<?= base_url(); ?>assets/js/observation.js"></script>
<!-- Modal -->
<div class="modal fade" id="mapModel" tabindex="-1" aria-labelledby="locationMapLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Location Map</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="resetDrp()" aria-label="Close"></button>
            </div>
             <div class="modal-body">
                <div  id="addObservMap" style="width:100%; height:550px;"></div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Select Location Map</button> -->
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
  function locationActivity(value) {
      var lat = $('.latll').val();
      var long = $('.lonll').val();
      var cc = $(".ccoID");
     //alert(cc.length);
     //alert("hello");
        if(value=='Checklist')
       {
            document.getElementById('location_latitude').value = lat;
            document.getElementById('location_longitude').value = long;
            //location.reload();            
       }else if(value=='Map') {
            document.getElementById('location_latitude').value = "";
            document.getElementById('location_longitude').value = "";
            $('#mapModel').modal('show');
            
            setTimeout(() => {
                initMapClickForObservCapture();
            }, 300);
            //addEventListener("click", initMapClickForObservCapture);
        }
     
    }
</script>

