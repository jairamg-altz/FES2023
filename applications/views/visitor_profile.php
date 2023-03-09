<?php $this->load->view('common/header'); ?>
<style>
    .page-header {
        background-image: linear-gradient(135deg, #31b551 0%, #2249a7 100%);
        /* height: 250px; */
        margin-top: 110px;
        display: flex;
        padding: 20px 70px;
    }

    .profile-header-details {
        display: grid;
        grid-template-areas: 'img desc desc desc desc desc''img desc desc desc desc desc''img nav nav nav nav nav';
        margin-top: 50px;
    }

    .profile-header-details-desc {
        padding: 0 50px;
        color: #fff;
        display: flex;
        grid-area: desc;
    }

    .profile-header-details-img {
        grid-area: img;
    }

    .profile-header-details-nav {
        grid-area: nav;
    }

    .profile-header-details-img img {
        width: 200px;
        aspect-ratio: 1/1;
        border-radius: 10px;
    }

    .desc-1 {
        width: 70%;
    }

    .desc-2 {
        width: 30%;
        display: flex;
        flex-wrap: wrap;
        flex-direction: column;
        justify-content: space-between;
    }

    .desc-1 .btn-white {
        font-size: 16px;
        font-weight: 600;
        border-radius: 25px;
        padding: .5rem 1.3rem;
        margin: 0 20px;
        white-space: nowrap;
    }

    .desc-2-top .btn {
        border-radius: 25px;
        padding: 0.5rem 1.25rem;
        white-space: nowrap;
    }

    .profile-nav-tabs {
        padding-top: 0;
        padding-bottom: 0;
    }

    .profile-nav-tabs .nav .nav-link {
        border-top: 5px solid transparent;
        color: #111;
        padding: 1rem 0;
        padding: 1rem 2rem;
    }

    .profile-nav-tabs .nav .nav-link:hover,
    .profile-nav-tabs .nav .nav-link:active {
        color: #111;
        border-top: 5px solid #111;
    }

    .profile-nav-tabs .nav .nav-link.active {
        border-top-color: #111;
    }

    @media (max-width: 540px) {
        .page-header {
            flex-direction: column;
        }

        .profile-header-details-desc {
            padding: 0;
        }
    }

    @media (max-width: 767px) {
        .desc-1 {
            width: 100%;
        }

        .desc-2 {
            width: 100%;
            flex-direction: row;
        }

        .profile-header-details-desc {
            color: #333;
        }

        .profile-header-details-desc {
            flex-direction: column;
        }
    }

    #userProfileStatistics {
        top: -150px;
    }

    #userProfileStatistics div.p-4 {
        background: rgba(255, 255, 255, 0.25);
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(4.9px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        width: 13% !important;
        text-align: center;
        font-weight: 600;
    }

    #userProfileStatistics div.p-4:first-child {
        border-radius: 25px 0 0 25px;
    }

    #userProfileStatistics div.p-4:last-child {
        border-radius: 0 25px 25px 0;
    }
    table,th,td{
        border: 0px solid black; 
        border-collapse: collapse;
    }
    td{
        text-align: center; 
    }
    tr{
        color: darkgoldenrod;
    }
    .bg-image {
  /* The image used */
    /* Add the blur effect */
  filter: blur(8px);
  -webkit-filter: blur(8px);
  
  /* Full height */
  height: 100%; 
  
  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
.myImage {
    opacity: 0.2;
    filter: alpha(opacity=20); /* msie */
    color: #000;
    -webkit-filter: grayscale(100%);
       -moz-filter: grayscale(100%);
         -o-filter: grayscale(100%);
        -ms-filter: grayscale(100%);
            filter: grayscale(100%);
}
</style>
<script type="text/javascript">
function folow() {
    $("#flll").hide();
    $("#flling").show();
    }  
function Following()
{
    $("#flll").show();
    $("#flling").hide();
}      
</script>
 <input type="hidden" class="loggedInUserIdD" value="<?php if (!empty($this->uri->segment(3))) { echo $this->uri->segment(3); } else { echo 0; } ?>">
<section class="p-0">
    <div class="col-md-42 page-header">
        <div class="profile-header-details">
            <div class="profile-header-details-img">
                <?php if (!empty($profileData->profileimage_id)) {?>
                    <img src="<?= base_url('media/uploads/' . $profileData->profileimage_id) ?>" alt="Profile">
                <?php } else { ?>
                    <img src="<?= base_url('media/img/user.png') ?>" alt="Profile">
                <?php } $NlPoints = $getWatcherR - $totalReward; ?>
            </div>
            <div class="profile-header-details-desc">
                <div class="desc-1 col-md-9">
                    <h3>
                        <?= (isset($profileData->first_name) && !empty($profileData->first_name)) ? ucfirst($profileData->first_name.' '.$profileData->last_name) : ''; ?>
                         <button class="btn btn-white btn-rounded"><i class="fa-solid fa-dove"></i> Level 2 Watcher</button><span style="font-size: 12px;"><?= $NlPoints; ?> points needed for next level</span>
                    </h3>
                    <p class="d-none d-md-block">
                        <?php if(!empty($profileData->about_us)) { echo $profileData->about_us; } else { echo 'At first, biographical writings were regarded merely as a subsection of history with a focus on a particular individual of historical importance. The independent genre of biography as distinct from general history writing, began to emerge in the 18th century and reached its contemporary form at the turn of the 20th century. '; } ?>
                    </p>
                </div>
                <div class="desc-2">
                    <div class="desc-2-top text-end">
                        <button class="btn btn-outline-white" onclick="folow()" id="flll"> <i class="fa fa-plus-circle" aria-hidden="true"></i>
 Follow</button>
    <button class="btn btn-outline-white" style="display: none;" onclick="Following()" id="flling"> <i class="fa fa-check" aria-hidden="true"></i>
 Following</button>
                    </div>
                    <div class="desc-2-bottom text-end">
                        <span class="h5">0 Followers</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="profile-nav-tabs">
        <ul class="nav nav-tabs justify-content-around">
            <li class="nav-item active">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#map_ref" onclick="initVProfileMap();">
                    <i class="bi bi-map h5"></i>
                    <span class="h5">
                        Observations
                    </span>
                </button>
            </li>
          <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#identify_ref">
                    <i class="bi bi-globe2 h5"></i>
                    <span class="h5">
                        Identified (0)
                    </span>
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#posts_ref">
                    <i class="bi bi-pencil h5"></i>
                    <span class="h5">
                        Posts (0)
                    </span>
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#comments_ref">
                    <i class="bx bx-comment-detail h5"></i>
                    <span class="h5">
                        Comments (0)
                    </span>
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#reward_ref">
                    <i class="bx bx-comment-detail h5"></i>
                    <span class="h5">
                        Rewards (<?= $totalReward; ?>)
                    </span>
                </button>
            </li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="container-fluid tab-pane active" id="map_ref">
            <div id="Vmap" class="map"></div>
            <div id="userProfileStatistics" class="row justify-content-center position-relative">

            </div>
        </div>
        <div class="container tab-pane" id="personal_ref">
            <form action="<?= site_url('profile/update_profile_action') ?>" method="post" enctype="multipart/form-data">
                <div class="row d-none" id="edit_profile">
                    <div class="col-md-4 mt-4">
                        <label for="profile_first_name">First Name <span class="text-danger">*</span></label>
                        <input type="text" name="first_name" id="profile_first_name" class="form-control" placeholder="First Name" value="<?= (!empty($profileData->first_name)) ? $profileData->first_name : "" ?>">
                        <span class="input_error_message" id="profile_first_name_error"></span>
                    </div>
                    <div class="col-md-4 mt-4">
                        <label for="profile_last_name">Last Name <span class="text-danger">*</span></label>
                        <input type="text" name="last_name" id="profile_last_name" class="form-control" placeholder="Last Name" value="<?= (!empty($profileData->last_name)) ? $profileData->last_name : "" ?>">
                        <span class="input_error_message" id="profile_last_name_error"></span>
                    </div>
                    <div class="col-md-4 mt-4">
                        <label for="profile_title">Title</label>
                        <input type="text" name="title" id="profile_title" class="form-control" placeholder="Titile" value="<?= (!empty($profileData->title)) ? $profileData->title : "" ?>" required>
                    </div>
                    <div class="col-md-4 mt-4">
                        <label for="profile_email">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="profile_email" class="form-control" placeholder="Email" value="<?= (!empty($profileData->email)) ? $profileData->email : "" ?>" required>
                        <span class="input_error_message" id="profile_email_error"></span>
                    </div>
                    <div class="col-md-4 mt-4">
                        <label for="profile_mobile">Mobile <span class="text-danger">*</span></label>
                        <input type="text" name="mobile_number" id="profile_mobile" class="form-control" placeholder="Mobile" value="<?= (!empty($profileData->mobile_number)) ? $profileData->mobile_number : "" ?>" required>
                        <span class="input_error_message" id="profile_mobile_error"></span>
                    </div>
                    <div class="col-md-4 mt-4">
                        <label for="profile_gender">Gender</label>
                        <select type="text" name="gender" id="profile_gender" class="form-select">
                            <option value="">- Select -</option>
                            <option value="Male" <?= (!empty($profileData->gender) && $profileData->gender == 'Male') ? 'selected' : "" ?>>Male</option>
                            <option value="Female" <?= (!empty($profileData->gender) && $profileData->gender == 'Female') ? 'selected' : "" ?>>Female</option>
                            <option value="Other" <?= (!empty($profileData->gender) && $profileData->gender == 'Other') ? 'selected' : "" ?>>Other</option>
                        </select>
                    </div>
                    <div class="col-md-4 mt-4">
                        <label for="profile_date_of_birth">Date of Birth</label>
                        <input type="date" name="date_of_birth" id="profile_date_of_birth" class="form-control" placeholder="Date of Birth" value="<?= (!empty($profileData->date_of_birth)) ? $profileData->date_of_birth : "" ?>">
                    </div>
                    <div class="col-md-4 mt-4">
                        <label for="profile_profession">Profession</label>
                        <input type="text" name="profession" id="profile_profession" class="form-control" placeholder="Profession" value="<?= (!empty($profileData->profession)) ? $profileData->profession : "" ?>">
                    </div>
                    <div class="col-md-4 mt-4">
                        <label for="profile_location">Location</label>
                        <input type="text" name="location" id="profile_location" class="form-control" placeholder="Location" value="<?= (!empty($profileData->location_city)) ? $profileData->location_city : "" ?>">
                    </div>
                    <div class="col-md-4 mt-4">
                        <label for="profile_website">Website</label>
                        <input type="text" name="website" id="profile_website" class="form-control" placeholder="Website" value="<?= (!empty($profileData->website_url)) ? $profileData->website_url : "" ?>">
                    </div>
                    <div class="col-md-4 mt-4">
                        <label for="profile_image">Profile Image</label>
                        <input type="file" id="profile_image" name="image_name" class="form-control file-input">
                       <!--  <input type="hidden" id="old_profile_image" name="old_image_name" value="<?= (!empty($profileData->image_name)) ? $profileData->image_name : "" ?>"> -->
                    </div>
                    <div class="col-md-4 mt-4">
                        <label for="profile_website">About Us</label>
                        <textarea  name="about_us" id="about_us" class="form-control" placeholder="About us" ><?= (!empty($profileData->about_us)) ? $profileData->about_us : "" ?></textarea>
                    </div>
                    <div class="col-md-4 mt-4">
                        <label for="profile_website">ORCID</label>
                        <input type="text" name="orc_id" id="orc_id" class="form-control" placeholder="ORCID" value="<?= (!empty($profileData->orc_id)) ? $profileData->orc_id : "" ?>">
                    </div>
                    <div class="col-md-4 mt-4">
                        <label for="profile_website">License Detail</label>
                        <select class="form-control" name="license_detail">
                        <option value="">Select License Detail</option>  
                        <?php foreach($GetLicense as $GetLicenseRow) { ?>
                        <option value="<?= $GetLicenseRow->data_license;?>" <?php if($profileData->license_detail==$GetLicenseRow->data_license) { echo "selected"; } ?>><?= $GetLicenseRow->data_license;?></option> 
                        <?php } ?>  
                        </select>
                    </div>
                    <div class="col-md-12 mt-4">
                        <button type="submit" class="btn btn-primary">Update Profile <img src="<?= base_url('media/svg/bars.svg'); ?>" alt="loader" class="loader"></button>
                    </div>
                </div>
            </form>
            <div class="row" id="view_profile">
                <div class="col-md-4 mt-4">
                    <label>First Name :</label>
                    <label><?= (!empty($profileData->first_name)) ? '<span class="fw-bold">' . ucfirst($profileData->first_name) . '</span>' : '<span class="text-muted">N/A</span>' ?></label>
                </div>
               
                <div class="col-md-4 mt-4">
                    <label>Last Name :</label>
                    <label><?= (!empty($profileData->last_name)) ? '<span class="fw-bold">' . $profileData->last_name . '</span>' : '<span class="text-muted"></span>' ?></label>
                </div>
                 <div class="col-md-4 mt-4">
                    <label>Title :</label>
                    <label><?= (!empty($profileData->title)) ? '<span class="fw-bold">' . ucfirst($profileData->title) . '</span>' : '<span class="text-muted"></span>' ?></label>
                </div>
                <div class="col-md-4 mt-4">
                    <label>User ID :</label>
                    <label><?= (!empty($profileData->user_id)) ? '<span class="fw-bold">' . $profileData->user_id . '</span>' : '<span class="text-muted">N/A</span>' ?></label>
                </div>
                <div class="col-md-4 mt-4">
                    <label>Email :</label>
                    <label><?= (!empty($profileData->email)) ? '<span class="fw-bold">' . $profileData->email . '</span>' : '<span class="text-muted">N/A</span>' ?></label>
                </div>
                <div class="col-md-4 mt-4">
                    <label>Mobile :</label>
                    <label><?= (!empty($profileData->mobile_number)) ? '<span class="fw-bold">' . $profileData->mobile_number . '</span>' : '<span class="text-muted">N/A</span>' ?></label>
                </div>
                <div class="col-md-4 mt-4">
                    <label>Gender :</label>
                    <label><?= (!empty($profileData->gender)) ? '<span class="fw-bold">' . $profileData->gender . '</span>' : '<span class="text-muted">N/A</span>' ?></label>
                </div>
                <div class="col-md-4 mt-4">
                    <label>Date of Birth :</label>
                    <label><?= (!empty($profileData->date_of_birth)) ? '<span class="fw-bold">' . date('d-m-Y', strtotime($profileData->date_of_birth)) . '</span>' : '<span class="text-muted">N/A</span>' ?></label>
                </div>
                <div class="col-md-4 mt-4">
                    <label>Profession :</label>
                    <label><?= (!empty($profileData->profession)) ? '<span class="fw-bold">' . $profileData->profession . '</span>' : '<span class="text-muted">N/A</span>' ?></label>
                </div>
                <div class="col-md-4 mt-4">
                    <label>Location :</label>
                    <label><?= (!empty($profileData->location_city)) ? '<span class="fw-bold">' . $profileData->location_city . '</span>' : '<span class="text-muted">N/A</span>' ?></label>
                </div>
                <div class="col-md-4 mt-4">
                    <label>Website :</label>
                    <label><?= (!empty($profileData->website_url)) ? '<span class="fw-bold">' . $profileData->website_url . '</span>' : '<span class="text-muted">N/A</span>' ?></label>
                </div>
                <div class="col-md-42 mt-4">
                    <button type="button" class="btn btn-outline-dark" onclick="toggleProfileFormHandler('Edit');">Edit Profile</button>
                </div>
            </div>
        </div>
        <?php $Acc = 'class="myImage"';

        ?>
         <div class="container-fluid tab-pane" id="reward_ref">
           <div class="card-body">
            <h3>Understand Badges & Profile Levels</h3>
        </div>
        <div class="col-md-12 p-3">            
            <table style="width:100%">
        <tr>
        <td>
            <td></td>
            
            <td <?php if($getObserverR > $totalReward) { echo $Acc; }?>><img   src="<?= base_url('media/img/reward.png');?>" style="width: 90px"><br>Observer <br><b>↑</b></td>
        
            <td></td> 
            <td></td>
            <td></td>
    <tr>
        <td>
            <td></td> 
            <td <?php if($getAvid_WatcherR > $totalReward) { echo $Acc; }?>><img  src="<?= base_url('media/img/reward.png');?>" style="width: 90px"> <br> Avid watcher<br><b>↑</b></td>
            <td <?php if($getCommunity_ChampionR > $totalReward) { echo $Acc; }?>><img  src="<?= base_url('media/img/reward.png');?>" style="width: 90px"> <br> Community champian<br>↑</td>
            <td></td>
            <td></td>       
    </tr>
        <td>
            <blockquote>               
            <td <?php if($getNoviceR > $totalReward) { echo $Acc; }?>><img  src="<?= base_url('media/img/reward.png');?>" style="width: 90px"><br>Novice</td>
             </blockquote>
            <td <?php if($getWatcherR > $totalReward) { echo $Acc; }?>><img  src="<?= base_url('media/img/reward.png');?>" style="width: 90px"><br>Watcher</td>
            <td <?php if($getCommunity_ParticipantR > $totalReward) { echo $Acc; }?>><img  src="<?= base_url('media/img/reward.png');?>" style="width: 90px"><br>Community partcipate </td>
            <td <?php if($getContributorR > $totalReward) { echo $Acc; }?>><img  src="<?= base_url('media/img/reward.png');?>" style="width: 90px"><br>Contributor</td>
            <td <?php if($getResearcherR > $totalReward) { echo $Acc; }?>><img  src="<?= base_url('media/img/reward.png');?>" style="width: 90px"><br> Researcher</td>
            <td <?php if($getExpertR > $totalReward) { echo $Acc; }?>><img  src="<?= base_url('media/img/reward.png');?>" style="width: 90px"><br>Expert</td>
        </td>
    </table>
             
           </div>
        </div>
    </div>
</section>
<?php $this->load->view('common/footer'); ?>
<script src="<?= base_url(); ?>assets/js/vprofile.js"></script>