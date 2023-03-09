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
#button{
  display:block;
  margin:20px auto;
  padding:10px 30px;
  background-color:#eee;
  border:solid #ccc 1px;
  cursor: pointer;
}
</style>

<section class="p-0">
    <div class="col-md-12 page-header">
        <h1 class="display-6">Checklists & Observations</h1>
    </div>
</section>
<div class="p-3">
    <div class="row">
        <div class="col-md-6">
         <div class="card">
         <div class="card-body btn btn-primary"> <h5>Checklist Name: <span class="label label-success"><?= ucwords($checklistName);?></span></h5>
        </div></div></div>
         <!-- <div class="col-md-6 text-end">
            <button class="btn btn-outline-dark btn-lg" type="button" onclick="addObservationCardD();">Add</button>
        </div>  -->
    </div>
</div>
<div id="overlay">
  <div class="cv-spinner">
    <span class="spinner"></span>
  </div>
</div>
<section class="team px-5 py-2">
    <div class="card-holder">        
            <div class="row" id="cardAppend">
                <div class="col-lg-4 col-md-6">
                    <form id="form_1" class="formCard">
                    <div class="member w-100">
                        <div class="member-info">
                             <div class="status" id="occr_protocol_error1" style="color:red;"></div>
                            <div class="accordion" id="accordionObservation">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOneObservation">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseObservation" aria-expanded="true" aria-controls="collapseObservation">
                                            Observation
                                        </button>
                                    </h2>
                                    <input type="hidden" name="gId" class="gId" value="0">
                                    <div id="collapseObservation" class="accordion-collapse collapse show" aria-labelledby="headingOneObservation" data-bs-parent="#accordionObservation">
                                        <div class="accordion-body">
                                            <input id="addObservationCheckListId1" type="hidden" name="addObservationCheckListId" value="<?= $checklistID ?>">
                                            <input id="addObservationCheckListName1" type="hidden" name="addObservationCheckListName" value="<?= $checklistName ?>">
                                            <input id="addObservationUserId1" type="hidden" name="addObservationUserId" value="<?= $_SESSION[SESSION_NAME]['user_uuid'] ?>">
                                            <div class="my-3 dropdown">
                                                <input id="addObservationTaxonID1" class="addObservationTaxonID1" type="hidden" name="addObservationTaxonID">
                                                <input type="text" name="addObservationSpeciesName" id="addObservationSpeciesName" class="form-control addObservationSpeciesName" placeholder="Species Name" list="speciesNameListSuggestions" onkeyup="getSpecies(this);" autocomplete="off" required>
                                                <div id="addObservationSpeciesNameDropDown" class="dropdown-content addObservationSpeciesNameDropDown">
                                                </div>
                                                <span class="input_error_message" id="s_name_error"></span>
                                            </div>
                                            <div class="my-3">                                            
                                               <div class="form-check">
                                              <input type="checkbox" class="form-check-input form-control checkbox1"  name="identification_required" value="false"  onclick="ChecValue();" id="idreqq">
                                              <div class="checkbox-value" style="display:none;"></div>
                                              <label class="form-check-label" for="check1">&nbsp;&nbsp;Identification Required</label>
                                            </div> 
                                            </div>
                                            <div class="my-3">
                                                <input type="number" name="addObservationMaleCount" id="obsrv_male_count1" class="form-control" min="1" oninput="this.value = Math.abs(this.value)" placeholder="Male count" required>
                                                <span class="input_error_message" id="obsrv_male_count_error1"></span>
                                            </div>
                                            <div class="my-3">
                                                <input type="number" name="addObservationFemaleCount" id="obsrv_female_count1" class="form-control" min="1" oninput="this.value = Math.abs(this.value)" placeholder="Female Count" required>
                                                <span class="input_error_message" id="obsrv_female_count_error1"></span>
                                            </div>
                                            <div class="my-3">
                                                <input type="number" name="addObservationChildCount" id="obsrv_child_count1" class="form-control" min="1" oninput="this.value = Math.abs(this.value)" placeholder="Child Count" required>
                                                <span class="input_error_message" id="obsrv_child_count_error1"></span>
                                            </div>
                                            <div class="my-3">
                                                <input type="file" name="addObservationFileUpload" multiple id="obsrv_image1" class="form-control">
                                                <span class="input_error_message" id="obsrv_child_count_error1"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwoOccurence1">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOccurence1" aria-expanded="false" aria-controls="collapseOccurence">
                                            Occurence
                                        </button>
                                    </h2>
                                    <div id="collapseOccurence1" class="accordion-collapse collapse" aria-labelledby="headingTwoOccurence" data-bs-parent="#accordionObservation1">
                                        <div class="accordion-body">
                                            <div class="my-3">
                                                <input type="number" name="addObservationIndividualCount" id="occr_individual_count1" class="form-control" min="1" oninput="this.value = Math.abs(this.value)" placeholder="Individual Count">
                                                <span class="input_error_message" id="occr_individual_count_error1"></span>
                                            </div>
                                            <div class="my-3" hidden>
                                                <select type="text" name="addObservationSex" id="occr_sex1" class="form-select">
                                                    <option value="">Select Sex</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Hermaphrodite">Hermaphrodite</option>
                                                    <option value="Intersex">Intersex</option>
                                                </select>
                                                <span class="input_error_message" id="occr_sex_error1"></span>
                                            </div>
                                            <div class="my-3" hidden>
                                                <select type="text" name="addObservationLifeStage" id="occr_life_stage1" class="form-select">
                                                    <option value="">Select Life Stage</option>
                                                    <option value="Infant">Infant</option>
                                                    <option value="Young">Young</option>
                                                    <option value="Adult">Adult</option>
                                                    <option value="Old">Old</option>
                                                </select>
                                                <span class="input_error_message" id="occr_life_stage_error1"></span>
                                            </div>
                                            <div class="my-3" hidden>
                                                <select type="text" name="addObservationReproductiveCondition" id="occr_reproductive_cond2" class="form-select">
                                                    <option value="">Select Reproductive Condition</option>
                                                    <option value="Non-reproductive">Non-reproductive</option>
                                                    <option value="Pregnant">Pregnant</option>
                                                    <option value="Flowering">Flowering</option>
                                                    <option value="Fruiting">Fruiting</option>
                                                </select>
                                                <span class="input_error_message" id="occr_reproductive_cond_error1"></span>
                                            </div>
                                            <div class="my-3">
                                                <select type="text" name="addObservationBehaviour" id="occr_behaviour1" class="form-select">
                                                    <option value="">Select Behaviour</option>
                                                    <option value="Aggresive">Aggresive</option>
                                                    <option value="Quite">Quite</option>
                                                </select>
                                                <span class="input_error_message" id="occr_behaviour_error1"></span>
                                            </div>
                                            <div class="my-3">
                                                <textarea name="addObservationRemarks" id="occr_remarks1" class="form-control" placeholder="Remarks"></textarea>
                                                <span class="input_error_message" id="occr_remarks_error1"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item" hidden>
                                    <h2 class="accordion-header" id="headingEvent1">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEvent1" aria-expanded="false" aria-controls="collapseEvent">
                                            Event
                                        </button>
                                    </h2>
                                    <div id="collapseEvent1" class="accordion-collapse collapse" aria-labelledby="headingEvent" data-bs-parent="#accordionObservation1">
                                        <div class="accordion-body">
                                            <div class="my-3">
                                                <input type="text" name="addObservationHabitat" id="event_habitat1" class="form-control" placeholder="Habitat">
                                                <span class="input_error_message" id="event_habitat_error1"></span>
                                            </div>
                                            <div class="my-3">
                                                <textarea name="addObservationMessage" id="event_remarks1" class="form-control" placeholder="Remarks"></textarea>
                                                <span class="input_error_message" id="event_remarks_error1"></span>
                                            </div>
                                            <div class="my-3">
                                                <select type="text" name="addObservationProtocol" id="occr_protocol1" class="form-select">
                                                    <option value="">Select Protocol</option>
                                                    <option value="Protocol1">Protocol 1</option>
                                                    <option value="Protocol2">Protocol 2</option>
                                                </select>
                                                <span class="input_error_message" id="occr_protocol_error1"></span>
                                            </div>
                                        </div>
                                    </div>
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
                                        <?php if($otype=='Stationary' || $otype=='Incidental') {

                                         ?>  
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
                    </form>
                </div>
            </div>            
             <input type="button" value="IMPORT" onclick="importObservation()" class="btn btn-primary" align="right"></input>
    </div>
</section>
<script type="text/javascript">
function ChecValue() {
    var chV = $(".gId");
   // alert(chV.length); 
if(chV.length === 1) 
{
    //alert("hello");
    $('.checkbox-value').text($('.checkbox1').val());
       $(".checkbox1").on('change', function() {
      if ($(this).is(':checked')) {
        $(this).attr('value', 'true');
      } else {
        $(this).attr('value', 'false');
      }
      
      $('.checkbox-value').text($('.checkbox1').val());
    });
}   
else {
    //alert("hi");
   $('.checkbox-value'+chV.length).text($('.checkbox1'+chV.length).val());
       $(".checkbox1"+chV.length).on('change', function() {
      if ($(this).is(':checked')) {
        $(this).attr('value', 'true');
      } else {
        $(this).attr('value', 'false');
      }      
      $('.checkbox-value'+chV.length).text($('.checkbox1'+chV.length).val());
    }); 
   } 
    }
</script>
<script type="text/javascript">
  function locationActivity(value) {
      var lat = $('.latll').val();
      var long = $('.lonll').val();
      var cc = $(".ccoID");
     //alert("ddd");
     if(cc.length === 1)
     {
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
    }else {
        //alert("hii");
     if(value=='Checklist')
       {

            document.getElementById('location_latitude'+cc.length).value = lat;
            document.getElementById('location_longitude'+cc.length).value = long;
            //location.reload();            
       }else if(value=='Map') {

            document.getElementById('location_latitude'+cc.length).value = "";
            document.getElementById('location_longitude'+cc.length).value = "";
            $('#mapModel').modal('show');
         //addEventListener("click", initMapClickForObservCapture);
        }
    } 
    }
</script>
<script type="text/javascript">
    var i = 1;
function addObservationCardD() {       
       ++i;
    $("#cardAppend").append('<div class="col-lg-4 col-md-6 formCard"><form id="form_'+i+'"><div class="member w-100"><button type="button" class="btn-close card-btn-close remove"  aria-label="Close"></button><div class="member-info"><div class="accordion" id="accordionObservation'+i+'"><div class="accordion-item"><h2 class="accordion-header" id="headingOneObservation'+i+'"><button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseObservation'+i+'" aria-expanded="true" aria-controls="collapseObservation">Observation</button></h2><input type="hidden" name="gId" class="gId" value="'+i+'"><div id="collapseObservation'+i+'" class="accordion-collapse collapse show" aria-labelledby="headingOneObservation" data-bs-parent="#accordionObservation'+i+'"><div class="accordion-body"><input id="addObservationCheckListId1" type="hidden" name="addObservationCheckListId" value="<?= $checklistID ?>"><input id="addObservationCheckListName1" type="hidden" name="addObservationCheckListName" value="<?= $checklistName ?>"><input id="addObservationUserId1" type="hidden" name="addObservationUserId" value="<?= $_SESSION[SESSION_NAME]['user_uuid'] ?>"><div class="my-3 dropdown"><input id="addObservationTaxonID1" class="addObservationTaxonID1" type="hidden" name="addObservationTaxonID"><input type="text" name="addObservationSpeciesName" id="addObservationSpeciesName" class="form-control addObservationSpeciesName" placeholder="Species Name" list="speciesNameListSuggestions" onkeyup="getSpecies(this);" autocomplete="off" required><div id="addObservationSpeciesNameDropDown" class="dropdown-content addObservationSpeciesNameDropDown"></div><span class="input_error_message" id="obsrv_species_name_error1"></span></div><div class="my-3"><div class="form-check"><input type="checkbox" class="form-check-input form-control checkbox1'+i+'" name="identification_required" value="false"  onclick="ChecValue();"><div class="checkbox-value'+i+'" style="display:none;"></div><label class="form-check-label" for="check1">&nbsp;&nbsp;Identification Required</label></div></div><div class="my-3"><input type="number" name="addObservationMaleCount" id="obsrv_male_count1" class="form-control" min="1" oninput="this.value = Math.abs(this.value)" placeholder="Male count" required><span class="input_error_message" id="obsrv_male_count_error1"></span></div><div class="my-3"><input type="number" name="addObservationFemaleCount" id="obsrv_female_count1" class="form-control" min="1" oninput="this.value = Math.abs(this.value)" placeholder="Female Count" required><span class="input_error_message" id="obsrv_female_count_error1"></span></div><div class="my-3"><input type="number" name="addObservationChildCount" id="obsrv_child_count1" class="form-control" min="1" oninput="this.value = Math.abs(this.value)" placeholder="Child Count" required><span class="input_error_message" id="obsrv_child_count_error1"></span></div><div class="my-3"><input type="file" name="addObservationFileUpload" multiple id="obsrv_image1" class="form-control"><span class="input_error_message" id="obsrv_child_count_error1"></span></div></div></div></div><div class="accordion-item"><h2 class="accordion-header" id="headingTwoOccurence1'+i+'"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOccurence1'+i+'" aria-expanded="false" aria-controls="collapseOccurence">Occurence</button></h2><div id="collapseOccurence1'+i+'" class="accordion-collapse collapse" aria-labelledby="headingTwoOccurence'+i+'" data-bs-parent="#accordionObservation1'+i+'"><div class="accordion-body"><div class="my-3"><input type="number" name="addObservationIndividualCount" id="occr_individual_count1" class="form-control" min="1" oninput="this.value = Math.abs(this.value)" placeholder="Individual Count"><span class="input_error_message" id="occr_individual_count_error1"></span></div><div class="my-3"><select type="text" name="addObservationSex" id="occr_sex1" class="form-select"><option value="">Select Sex</option><option value="Male">Male</option><option value="Female">Female</option><option value="Hermaphrodite">Hermaphrodite</option><option value="Intersex">Intersex</option></select><span class="input_error_message" id="occr_sex_error1"></span></div><div class="my-3"><select type="text" name="addObservationLifeStage" id="occr_life_stage1" class="form-select"><option value="">Select Life Stage</option><option value="Infant">Infant</option><option value="Young">Young</option><option value="Adult">Adult</option><option value="Old">Old</option></select><span class="input_error_message" id="occr_life_stage_error1"></span></div><div class="my-3"><select type="text" name="addObservationReproductiveCondition" id="occr_reproductive_cond2" class="form-select"><option value="">Select Reproductive Condition</option><option value="Non-reproductive">Non-reproductive</option><option value="Pregnant">Pregnant</option><option value="Flowering">Flowering</option><option value="Fruiting">Fruiting</option></select><span class="input_error_message" id="occr_reproductive_cond_error1"></span></div><div class="my-3"><select type="text" name="addObservationBehaviour" id="occr_behaviour1" class="form-select"><option value="">Select Behaviour</option><option value="Aggresive">Aggresive</option><option value="Quite">Quite</option></select><span class="input_error_message" id="occr_behaviour_error1"></span></div><div class="my-3"><textarea name="addObservationRemarks" id="occr_remarks1" class="form-control" placeholder="Remarks"></textarea><span class="input_error_message" id="occr_remarks_error1"></span></div></div></div></div><div class="accordion-item"><h2 class="accordion-header" id="headingEvent1'+i+'"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEvent1'+i+'" aria-expanded="false" aria-controls="collapseEvent">Event</button></h2><div id="collapseEvent1'+i+'" class="accordion-collapse collapse" aria-labelledby="headingEvent" data-bs-parent="#accordionObservation1'+i+'"><div class="accordion-body"><div class="my-3"><input type="text" name="addObservationHabitat" id="event_habitat1" class="form-control" placeholder="Habitat"><span class="input_error_message" id="event_habitat_error1"></span></div><div class="my-3"><textarea name="addObservationMessage" id="event_remarks1" class="form-control" placeholder="Remarks"></textarea><span class="input_error_message" id="event_remarks_error1"></span></div><div class="my-3"><select type="text" name="addObservationProtocol" id="occr_protocol1" class="form-select"><option value="">Select Protocol</option><option value="Protocol1">Protocol 1</option><option value="Protocol2">Protocol 2</option></select><span class="input_error_message" id="occr_protocol_error1"></span></div></div></div></div><div class="accordion-item"><h2 class="accordion-header" id="headingLocation'+i+'"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLocation'+i+'" aria-expanded="false" aria-controls="collapseLocation">Location</button></h2><div id="collapseLocation'+i+'" class="accordion-collapse collapse" aria-labelledby="headingLocation" data-bs-parent="#accordionObservation2"><div class="accordion-body"><div class="my-3"><select class="form-control form-select" name="addObservationGeoprivacy" required="required"><option value="">Select Geoprivacy</option><option value="Public">Public</option><option value="Obscured">Obscured</option><option value="Private">Private</option></select></div><?php if($otype=='Stationary' || $otype=='Incidental') { ?><div class="my-3"><input type="text" name="addObservationLatitude" id="location_latitude1" class="form-control location_latitude1" placeholder="Longitude" value="<?= $Latitude; ?>" readonly></div><div class="my-3"><input type="text" name="addObservationLongitude" id="location_longitude1" class="form-control location_longitude1" placeholder="Latitude" value="<?= $Longitude; ?>" readonly></div><?php } else { ?><input type="hidden" name="latll" class="latll" value="<?= $Latitude; ?>"><input type="hidden" name="lonll" class="lonll" value="<?= $Longitude; ?>"><input type="hidden" id="ccoID" value="'+i+'" name="ccoID" class="ccoID"><div class="my-3"><select class="form-control" onchange="locationActivity(this.value)" id="my_select'+i+'"><option value="">Select Location</option><option value="Checklist">Checklist</option><option value="Map">Map</option></select></div><div class="my-3"><input type="text" name="addObservationLatitude" id="location_latitude'+i+'" class="form-control location_latitude'+i+'" placeholder="Longitude" required></div><div class="my-3"><input type="text" name="addObservationLongitude" id="location_longitude'+i+'" class="form-control location_longitude'+i+'" placeholder="Latitude"  required></div><?php } ?></div></div></div></div></div></div>');
$("#cardAppend").on("click",".remove",function(){ 
    $(this).parents(".formCard").remove();
    --i;
    });
}
</script>
<script type="text/javascript">
    function importObservation() {
      $("form[id*=form_]").each(function() {
        var speciesN = $('#addObservationSpeciesName').val();
        var idreq = $('#idreqq').val();
        var indcount = $('#occr_individual_count1').val();
        var llatitude = $("#location_latitude").val(); 
        var llongitude = $("#location_longitude").val();     
        if(idreq === 'false') 
        {
    if(speciesN=="")
        {
            $(".status").html("Please select species");
            setTimeout(function(){$(".status").html('');},5000);
            $("#addObservationSpeciesName").focus();
            return false;
        }
    }
    if(indcount=='')
    {
        $(".status").html("Please enter individual count");
        setTimeout(function(){$(".status").html('');},5000);
        $("#addObservationSpeciesName").focus();
        return false;
    }
    if(llatitude=='')
    {
        $(".status").html("Please enter latitude");
        setTimeout(function(){$(".status").html('');},5000);
        $("#location_latitude").focus();
        return false;
    }
    if(llongitude=='')
    {
        $(".status").html("Please enter longitude");
        setTimeout(function(){$(".status").html('');},5000);
        $("#location_longitude").focus();
        return false;
    }
        var formData = new FormData(this);
        
        $.ajax({
                type: 'POST',
                url : addObservationUrl,
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                beforeSend: function() { $("#overlay").fadeIn(300); },            
                success: function(d) {
                   // console.log(d);
                    if(d.success == 1) {
                        //console.log("imported");
                        setTimeout(function() { $("#overlay").fadeOut(300); },500);
                        window.location.href = '<?= site_url('observations');?>';
                    }
                },
                error: function(e) {
                    
                }
            });
        })
    }

</script>
<script type="text/javascript">
 function resetDrp()
 {
    var MchV = $(".gId");
    if(MchV.length===1)
    {
        $("#my_select").prop('selectedIndex',0);
    }
    else{
        $("#my_select"+MchV.length).prop('selectedIndex',0);
    }
    
 }   
</script>


<?php $this->load->view('common/footer'); ?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
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



