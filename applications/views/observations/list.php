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
        background: linear-gradient(180deg, #31B551 0%, #2249A7 80%);
        border-radius: 0.5rem;
        display: grid;
        align-content: space-between;
        color: #fff;
        padding: 0;
        min-height: 60vh;
    }
</style>

<section class="p-0">
    <div class="col-md-12 page-header">
        <h1 class="display-6">Checklists & Observations</h1>
    <p><b>Have you been birding this morning? Or herping last night? The data you gathered could help so 
many people. Record your observations with IBIS. </b></p>
    </div>
</section>
<div class="p-3">
    <div class="row">
    <div class="col-md-12 text-end">
            <button class="btn btn-outline-dark btn-lg" data-bs-target="#addChecklistModal" data-bs-toggle="modal" onclick="initMapClickForChecklistCapture();">Add Checklist</button>
        </div>
       
    </div>
</div>
<section class="team px-5 py-2">
    <div class="row">
        <?php foreach($checklist as $key => $value ) { 

for ($x = 0; $x < count($value); $x++) {
    $startDate =date('d-m-Y',strtotime($value[$x]['sp_start_datetime']));
    $endDate = date('d-m-Y',strtotime($value[$x]['sp_end_datetime']));
    //print_r($value[$x]);
            ?>
        <div class="col-lg-3 col-md-6 d-flex align">
            <div class="member w-100">
                <div class="member-img d-flex justify-content-center">
                    <h3><?php if(empty($value[$x]['sp_name'])) { echo 'Test'; } else { echo ucfirst($value[$x]['sp_name']); }  ?></h3>
                    
                </div>
                <div class="member-info">
                    <h4><?php if(empty($value[$x]['sp_count'])) { echo '0'; } else { echo $value[$x]['sp_count']; }  ?> </h4>
                    <span style="color:gray;"> <?php if(empty($value[$x]['sp_description'])) { echo 'Test'; } else { echo $value[$x]['sp_description']; }  ?></span>
                    <span style="color:blue;"><b class="bi bi-calendar"></b> <?= $startDate; ?> and <?= $endDate;?></span>
                    <span style="color:blue;"><b class="bi bi-clock"></b> <?= date('H:i A',strtotime($value[$x]['sp_start_datetime']))?> - <?= date('H:i A',strtotime($value[$x]['sp_end_datetime']))?></span>
                    <span style="color:green;"><b class="fa-solid fa-users"></b> <?php if(empty($value[$x]['sp_party_count'])) { echo 'Test'; } else { echo $value[$x]['sp_party_count'].' Members'; }  ?> </span>
                    
                    <span style="color:green;"><b class="fa-solid fa-road"></b> <?php if(empty($value[$x]['sp_travelled_distance'])) { echo 'Test'; } else { echo $value[$x]['sp_travelled_distance'].' Kmtrs'; }  ?></span>
                    <span style="color:#da8b78;"><b class="fa-solid fa-briefcase"></b> <?php if(empty($value[$x]['sp_observation_type'])) { echo 'Test'; } else { echo $value[$x]['sp_observation_type']; }  ?></span>
                    <hr>
                    <div class="d-grid gap-1">
                        <a href="<?= site_url('observations/ViewObjservation/'.$value[$x]['sp_checklist_id']); ?>" class="btn btn-outline-dark"><i class="bi bi-binoculars"></i> View Observations</a>

                        <a href="<?= site_url('observations/add/'.$value[$x]['sp_checklist_id']); ?>" class="btn btn-outline-dark"><i class="bx bx-plus"></i> Add Observations</a>
                        <div class="row justify-content-center">
                        <div class="col-md-6">
                            <a href="<?= site_url('observations/editA/'.$value[$x]['sp_checklist_id']); ?>" class="btn btn-outline-dark" style="width: 108%"><i class="bx bx-pencil"></i>Edit </a>
                        </div>
                        <div class="col-md-6">
            <a href="<?= site_url('observations/delete/'.$value[$x]['sp_checklist_id']); ?>" class="btn btn-outline-dark" style="width: 100%" onclick="return confirm('Are you sure you want to delete this item?');"><i class="bx bx-trash"></i> Delete  </a>
                        </div></div>
                    </div>
                </div>
            </div>
        </div>
        <?php } }?>
    </div>
</section>

<div class="modal" id="addChecklistModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body p-0">
                <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="row">
               <div class="col-md-12 col-lg-6 checklist-block-left" id="captureChecklistMap">                </div>
                    <div class="col-md-12 col-lg-6 py-5 px-5">
                        <form id="addChecklistForm1" action="<?= site_url('Observations/AddChecklist')?>" method="post" enctype="multipart/form-data">
                            <div class="mb-4">
                                <h2 class="text-800">Add Checklist</h2>
                                <p><b>Click here to make a detailed entry. </b></p>
                            </div>
                            <div class="my-3">
                                <label for="">Checklist Name</label>
                                <input type="text" name="checklist_name" id="checklist_name" class="form-control" placeholder="Checklist Name">
                                <span class="input_error_message" id="checklist_name_error"></span>
                            </div>
                            <div class="my-3">
                                <label for="">Description</label>
                                <textarea type="text" name="checklist_description" id="checklist_description" class="form-control" placeholder="Description"></textarea>
                                <span class="input_error_message" id="checklist_description_error"></span>
                            </div>
                            <div class="my-3">
                              <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Start Time</label>
                                        <input type="datetime-local" name="checklist_start_time" id="checklist_start_time" onchange="calculateTimeSpent()" class="form-control" placeholder="Select the date on which you started your observation.">
                                        <span class="input_error_message" id="checklist_start_time_error"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">End Time</label>
                                        <input type="datetime-local" name="checklist_end_time" id="checklist_end_time" onchange="calculateTimeSpent()" class="form-control" placeholder="End Time">
                                        <span class="input_error_message" id="checklist_end_time_error"></span>
                                    </div>
                                </div>  
                            </div>
                            <div class="my-3">
                                <label for="">Time Spent</label>
                                <input type="text" name="checklistTimeSpent" id="checklist_time_spent" class="form-control" placeholder="IBIS calculates this time automatically." readonly>
                            </div>
                            <div class="my-3">
                                <label for="">Travelled Distance (km)</label>
                                <input type="number" name="checklist_distance" id="checklist_distance" class="form-control" min="0" placeholder="What was the distance you travelled? " required>
                                <span class="input_error_message" id="checklist_distance_error"></span>
                            </div>
                            <div class="my-3">
                                <label for="">Party Count</label>
                                <input type="number" name="checklist_group_count" id="checklist_group_count" class="form-control" min="1" placeholder="State the number of people in your group" required>
                                <span class="input_error_message" id="checklist_group_count_error"></span>
                            </div>
                            <div class="my-3">
                                <label for="">Observation Type</label>
                                <select name="checklist_type" id="checklist_type" class="form-select" required>
                                    <option value="">Select </option>
                                    <option value="Stationary">Stationary</option>
                                    <option value="Incidental">Incidental</option>
                                    <option value="Travelling">Travelling</option>
                                    <option value="Other">Other</option>
                                </select>
                                <span class="input_error_message" id="checklist_type_error"></span>
                            </div>
                            <div class="my-3">
                                <input type="text" name="checklist_location_latitude" id="checklist_location_latitude" class="form-control" placeholder="Mark the latitude of the location. 
" required pattern="^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$">
                                <span class="input_error_message" id="checklist_location_latitude_error"></span>
                            </div>
                            <div class="my-3">
                                <input type="text" name="checklist_location_longitude" id="checklist_location_longitude" class="form-control" placeholder="Mark the longitude of the location. 
" required pattern="^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$">
                                <span class="input_error_message" id="checklist_location_longitude_error"></span>
                            </div>
                            <div class="my-4">
                                <button type="submit" id="Addchecklist" class="btn btn-primary float-end btn-lg">Add &nbsp;<img src="<?= IMAGE_URL.'../svg/bars.svg'; ?>" alt="loader" class="loader"></button>
                                <P><b>Click to record your data with IBIS. </b></P>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('common/footer'); ?>
<script src="<?= base_url(); ?>assets/js/observation.js"></script>