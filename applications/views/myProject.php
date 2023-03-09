<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/css/a17myprojects.css" />
<script type="text/javascript">
  function deleteItem($id) {
    if (confirm("Are you sure?")) {
        alert(id); return false;
    }
    return false;
}
</script>
<style>
    .page-header {
        background-image: linear-gradient(135deg, #31b551 0%, #2249a7 100%);
        min-height: 250px;
        margin-top: 110px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 20px 70px;
        color: #fff;
    }
</style>  
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <?php $this->load->view('common/header'); ?>

<section class="p-0">
    <div class="col-md-12 page-header">
        <h1 class="display-4">All Projects</h1>
        <p class="fs-2">Create and manage projects for topic-specific research.<br>
Keep projects public or make it private and invite collaborators. </p>
    </div>
</section>
<section>
    <div class="py-5 team4">
  <div class="container">   
    <div class="row">
      <div class="col-md-12">
       <h1><b>My Project</b> <a href="<?= site_url('PMS/CreateProject'); ?>"><button class="btn btn-primary" style="float: right;background: linear-gradient(135deg, #31B155 0%, #255A9B 100%);background-color:transparent;">CREATE PROJECT</button></a></h1>
<hr></div>
    <div class="blog--list-view">
                                <!-- Article Posts -->
                                <?php foreach($pdata as $pdataRows) { ?>
                                <div class="row article">
                                    <div class="col-12 col-sm-6 col-md-6 col-lg-6 post-img">
                                      <img src="<?= IMAGE_URL.'../project/'.$pdataRows->file_media;?>" class="img-fluid img-thumbnail">
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-6 col-lg-6 post-content">
                                        <!-- Blog Content -->
                                        <h2 class="article__title h3 text-uppercase mb-2"><?= ucfirst($pdataRows->project_name);?></h2>
                                        <div class="rte mb-2 pb-1"> 
                                            <p><?= ucfirst($pdataRows->project_desc);?></p>
                                        </div>
                                        <hr>
                                        <div class="blog-action">
                                        <div class="col-md-12"><span style="font-size:large;"><b><?= ucfirst($pdataRows->access);?></b></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <!-- <span style="font-size: large;"><b>Contributors: 0</b></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size: large;"><b>Total Entries: 46</b></span> --></div><hr>
                                        <div class="col-md-12"><span style="font-size:medium;"><i class="fa-solid fa-eye"></i>&nbsp;<a href="<?= site_url('PMS/projectView/'.$pdataRows->project_id);?>">View</a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <!-- <span style="font-size: small;"><i class="fa-solid fa-handshake"></i>&nbsp;<?php if($_SESSION[SESSION_NAME]['user_uuid']==$pdataRows->created_by) { ?>
            <a href="<?= site_url('PMS/ProjChecklist/'.$pdataRows->project_id);?>">Contributors</a><?php } else { ?>Contribute<?php }?></span> -->&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size: medium;"><i class="fa-solid fa-book-open"></i>&nbsp;<?php if($_SESSION[SESSION_NAME]['user_uuid']==$pdataRows->created_by) { ?>
            <a href="<?= site_url('PMS/projectEdit/'.$pdataRows->project_id)?>">Edit</a><?php } else { ?>Edit<?php } ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if($_SESSION[SESSION_NAME]['user_uuid']==$pdataRows->created_by) { ?>
            <a href="<?= site_url('PMS/delete/'.$pdataRows->project_id);?>"><span style="font-size: medium;" onclick="return confirm('Are you sure?');"><i class="fa-solid fa-trash"></i>&nbsp;Delete</span></a><?php } else { ?><span style="font-size: medium;"><i class="fa-solid fa-trash"></i>&nbsp;Delete</span><?php } ?></div>
                                        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <!-- End Blog Content -->
                                    </div>
                                </div> <hr>  
                                <?php } ?>                                                           
                            </div>

                            <div class="col-md-12" style="padding-top: 30px;">
       <h1><b>Project you have joined</b> </h1><hr></div>
       <div class="blog--list-view">
                                <!-- Article Posts -->
                                <div class="row article">
                                    <div class="col-12 col-sm-6 col-md-6 col-lg-6 post-img">
                                      
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-6 col-lg-6 post-content">
                                        <!-- Blog Content -->
                                        <h2 class="article__title h3 text-uppercase mb-2"><a href="blog-single-post.html">Lorem Ipsum is simply dummy text</a></h2>
                                        <div class="rte mb-2 pb-1"> 
                                            <p>On sait depuis longtemps que travailler avec du texte lisible et contenant du sens est source de distractions...</p>
                                        </div>
                                        <hr>
                                        <div class="blog-action">
                                        <div class="col-md-12"><span style="font-size:large;"><b>Private</b></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <!-- <span style="font-size: large;"><b>Contributors: 0</b></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size: large;"><b>Total Entries: 46</b></span> --></div><hr>
                                        <div class="col-md-12"><span style="font-size:medium;"><i class="fa-solid fa-eye"></i>&nbsp;View</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="font-size: small;"><i class="fa-solid fa-handshake"></i>&nbsp;Contributors</span></div>
                                        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <!-- End Blog Content -->
                                    </div>
                                </div>
                                <!-- End Article Posts -->

                                <!-- Article Posts -->
                                <div class="row article">
                                    <div class="col-12 col-sm-6 col-md-6 col-lg-6 post-img">
                                     
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-6 col-lg-6 post-content">
                                        <!-- Blog Content -->
                                        <h2 class="article__title h3 text-uppercase mb-2"><a href="blog-single-post.html">Lorem Ipsum is simply dummy text</a></h2>
                                        <div class="rte mb-2 pb-1"> 
                                            <p>On sait depuis longtemps que travailler avec du texte lisible et contenant du sens est source de distractions...</p>
                                        </div>
                                        <hr>
                                        <div class="blog-action">
                                        <div class="col-md-12"><span style="font-size:large;"><b>Private</b></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <!-- <span style="font-size: large;"><b>Contributors: 0</b></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size: large;"><b>Total Entries: 46</b></span> --></div><hr>
                                        <div class="col-md-12"><span style="font-size:medium;"><i class="fa-solid fa-eye"></i>&nbsp;View</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="font-size: small;"><i class="fa-solid fa-handshake"></i>&nbsp;Contributors</span></div>
                                        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <!-- End Blog Content -->
                                    </div>
                                </div>
                                <!-- End Article Posts -->
                                
                            </div>
    </div>
  </div>
</div>
</section>
<?php $this->load->view('common/footer'); ?>
<script src="<?= base_url(); ?>assets/js/observation.js"></script>
<div class="modal" id="addChecklistModalP" tabindex="-1">
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
