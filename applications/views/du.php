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
</style>
<section class="p-0">
    <div class="col-md-12 page-header">
        <h1 class="display-6">Hefty Data Upload </h1>
    </div>
</section>
<div class="p-3">
    <div class="row col-md-12 card-body text-justify" >
    <?php if($data_upload_status!='Pending' || $data_upload_status=='Rejected') { ?>    
        <p class="text-justify"><b>The Hefty Data Upload tool was designed to help you upload large volumes of data on the IBIS portal. Any 
uploaded data takes precious space on the IBIS server.</p><p class="text-justify"> Use the Hefty Data Upload feature sparingly, only to upload large bulk data. It is not the standard procedure to 
enter data into IBIS. For all regular observation data entry requirements, please use the Add Checklist option 
on the Observations page. </b></p><p class="text-justify"><b>
To prevent spam or automated uploads and to lower the risk of high-volume of repetitive errors that may be 
tedious to fix, access to Hefty Data Upload feature is limited by permission. To request permission from the IBIS 
Admin team, please fill up the following form.</b></p><p class="text-justify"> <b>
In the <b>Reason</b> box, describe why you need access to the Hefty Data Upload feature. When you have filled up 
the description, click <b>Submit</b>. A trigger email is sent to the IBIS administrator.</b></p><p class="text-justify"> <b>
Next, check your registered email inbox. You would have received a response email. You can upload large 
volumes of heavy data after the Administrator has approved your request.</b></p><p class="text-justify"> <b>
Remember to visit the link in the email to follow the instructions about how to use the Hefty Data Upload 
feature. </b></p>

<form action="<?= site_url('Profile/duAction')?>">
  <div class="form-group">
    <label for="exampleInputEmail1"><h4>Reason</h4></label>
    <textarea class="form-control" cols="20" rows="10" name="reason"></textarea>
   </div><hr>
  <button type="submit" class="btn btn-primary float right">Submit</button>
</form>
<?php } else { ?>
    <h2>You request has already been submitted to the Administrator.You shall see the data aproved your request.</h2>
<?php } ?>
    </div>
</div>
<section class="team px-5 py-2">
    <div class="row">        
    </div>
</section>
<?php $this->load->view('common/footer'); ?>