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
    <div class="col-md-12 page-header">
        <?php //print_r($checklist);exit;?>
        <h1 class="display-6">Project Checklist</h1>
    </div>
</section>
<section>
<div class="container">
 <div class="row">
    
         <div class="mb-4">
                                <h2 class="text-800">Edit Project Checklist</h2>
                                <p><b>Click here to make a detailed entry. </b></p>
                            </div>
                            <form action="<?= site_url('PMS/editAction/'.$project_checklist_uuid);?>" method="post">
           <div class="my-3">
                                <label for="">Checklist Name</label>
                                <input type="text" name="checklist_name" id="checklist_name" class="form-control" placeholder="Checklist Name" required value="<?= $checklist->checklist_name;?>">
                                <span class="input_error_message" id="checklist_name_error"></span>
                            </div>
                            <div class="my-3">
                                <label for="">Description</label>
                                <textarea type="text" name="checklist_description" id="checklist_description" class="form-control" placeholder="Description"><?= $checklist->description;?></textarea>
                                <span class="input_error_message" id="checklist_description_error"></span>
                            </div>
                            <div class="my-3">
                              <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Start Time</label>
                                        <input type="datetime-local" name="checklist_start_time" id="checklist_start_time" onchange="calculateTimeSpent()" class="form-control" placeholder="Select the date on which you started your observation." required value="<?= $checklist->start_datetime;?>">
                                        <span class="input_error_message" id="checklist_start_time_error"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">End Time</label>
                                        <input type="datetime-local" name="checklist_end_time" id="checklist_end_time" onchange="calculateTimeSpent()" class="form-control" placeholder="End Time" required value="<?= $checklist->end_datetime;?>">
                                        <span class="input_error_message" id="checklist_end_time_error"></span>
                                    </div>
                                </div>  
                            </div>
                            <div class="my-3">
                                <label for="">Time Spent</label>
                                <input type="text" name="checklistTimeSpent" id="checklist_time_spent" class="form-control" placeholder="IBIS calculates this time automatically." readonly >
                            </div>
                            <div class="my-3">
                                <label for="">Travelled Distance (km)</label>
                                <input type="number" name="checklist_distance" id="checklist_distance" class="form-control" min="0" placeholder="What was the distance you travelled? " required value="<?= $checklist->travelled_distance;?>">
                                <span class="input_error_message" id="checklist_distance_error"></span>
                            </div>
                            <div class="my-3">
                                <label for="">Party Count</label>
                                <input type="number" name="checklist_group_count" id="checklist_group_count" class="form-control" min="1" placeholder="State the number of people in your group" required value="<?= $checklist->party_count;?>">
                                <span class="input_error_message" id="checklist_group_count_error"></span>
                            </div>
                            <div class="my-3">
                                <label for="">Observation Type</label>
                                <select name="checklist_type" id="checklist_type" class="form-select" required>
                                    <option value="">Select </option>
                                    <option value="Stationary" <?php if($checklist->observation_type=='Stationary') { echo "selected"; } ?>>Stationary</option>
                                    <option value="Incidental" <?php if($checklist->observation_type=='Incidental') { echo "selected"; } ?>>Incidental</option>
                                    <option value="Travelling" <?php if($checklist->observation_type=='Travelling') { echo "selected"; } ?>>Travelling</option>
                                    <option value="Other" <?php if($checklist->observation_type=='Other') { echo "selected"; } ?>>Other</option>
                                </select>
                                <span class="input_error_message" id="checklist_type_error"></span>
                            </div>
                   <input type="text" name="project_id" value="<?= $checklist->project_id;?>">          
                  <div class="text-center">          
                 <button type="submit" name="submit" class="btn btn-primary ">Submit</button> </div>          
                            </form>                   
        </div>   
</div>    
</section>
<?php $this->load->view('common/footer'); ?>