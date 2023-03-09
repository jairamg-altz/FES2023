<?php $this->load->view('common/header'); ?>
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
<style>

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}

label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}

input[type=submit] {
  background-color: #04AA6D;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  /*background-color: #f2f2f2;*/
  padding: 20px;
}

.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
}

.col-75 {
  float: left;
  width: 75%;
  margin-top: 6px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}
</style>
<section class="p-0">
    <div class="col-md-12 page-header">
        <h1 class="display-4">Consortium of Experts</h1>
        <!-- <p class="fs-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. </p> -->
    </div>
</section>
<section class="team px-5">
    <?php if (!empty($expertsData)) { ?>
        <div class="row">
            <?php $sr=1; foreach ($expertsData as $expert) { 
              if (strlen($expert->expert_details) > 120)
              {
                $str = substr($expert->expert_details, 0, 120) . '...';
              }
             // print_r($expert->linkedin_id);
                $expert->followers=null; ?>
                <input type="hidden" name="email" value="<?= $expert->expert_email?>" id="eemail<?= $sr;?>">
                <input type="hidden" name="ename" value="<?= $expert->expert_name?>" id="eename<?= $sr;?>">
                <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                    <div class="member">
                        <div class="member-img">
                            <img class="img-fluid rounded" style="height: 250px;" src="<?php if(!empty($expert->profileimage_id)) { echo IMAGE_URL.'../uploads/' . $expert->profileimage_id; } else { echo IMAGE_URL.'user.png'; } ?>">
                            <div class="social">
                                <a href="<?php if(!empty($expert->twitter_id)) { echo $expert->twitter_id; } else { echo "#"; }?>" target="_blank"><i class="bi bi-twitter"></i></a>
                                <a href="<?php if(!empty($expert->facebook_id)) { echo $expert->facebook_id; } else { echo "#"; }?>" target="_blank"><i class="bi bi-facebook"></i></a>
                                <a href="<?= (!empty($expert->skype_id))?$expert->skype_id:''; ?>" target="_blank"><i class="bi bi-skype"></i></a>
                                <a href="<?php if(!empty($expert->linkedin_id)) { echo $expert->linkedin_id; } else { echo "#"; }?>" target="_blank"><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info">
                            <a href="<?= site_url('Visitors/profile/'.$expert->user_uuid);?>"><h4><?= ucwords($expert->expert_name); ?></h4></a>
                            <span><?php if(!empty($expert->specialization)) { echo $expert->specialization; } else { ' '; }?></span>
                            <span><?php if(!empty($expert->Qualification)) { echo $expert->Qualification; } else { ' '; }?></span>
                            <hr>
                            <?php  if(strlen($expert->expert_details) < 120) { ?>
                              <p><?= $str; ?></p>
                            <?php } else {?>  
                            <p><?= $str; ?><button class="btn-primary" style="float:right;" onclick="viewD(this.value);" value="<?= $expert->expert_details;?>" data-bs-toggle="modal" data-bs-target="#viewDD">View</button></p>
                            <?php } ?>  
                            <div class="d-grid">
                                <a class="btn btn-outline-dark float-center" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#askmm" onclick="askme();">Ask Me</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php $sr++;} ?>
        </div>
<?php } else { ?>
<div class="text-center">
    <h1 class="text-muted"><em>No Experts Found !</em></h1>
</div>
<?php } ?>
</section>
<?php $this->load->view('common/footer'); ?>
<script type="text/javascript">
function viewD(value) {
    $("#cvdd").empty();
    $("#cvdd").append(value);
  }  
</script>
<script type="text/javascript">
  function contactForm() {
    $("form[id*=CCForm]").each(function() {
        event.preventDefault();
  
  var subject =  document.getElementById('subject').value;
  if (subject == "") {
      $('.status').show();
      document.querySelector('.status').innerHTML = "Subject cannot be empty";
      setTimeout(function(){$(".status").hide();},3000);
      return false;
  }
  
  var formData = new FormData(this);
  //console.log(formData);
  $.ajax({
    type: "POST",
    url: "<?= site_url('Experts/askData');?>",// where you wanna post
    data: formData,
    processData: false,
    contentType: false,
    error: function(jqXHR, textStatus, errorMessage) {
        console.log(errorMessage); // Optional
    },
    success: function(data) {
        //alert(data); return false;
      if(data=='1')
      {
        $('.statusSuccess').show();
        document.querySelector('.statusSuccess').innerHTML = "Your message has been submitted";
        setTimeout(function(){
        $(".statusSuccess").hide();
        window.location.href = '<?= site_url('Experts/index')?>';
      },500);
      }
     else {
       document.querySelector('.status').innerHTML = "Something are Wrong!";
      setTimeout(function(){$(".status").hide();},3000);
      window.location.reload();
     }
    } 
});
 });
}
</script>
<script type="text/javascript">
 var count = 0;   
 function askme() {
    
    count++;
   // alert(count); 
    var eem = $("#eemail"+count).val();
    var eeme = $("#eename"+count).val();
    $("#eeemm").empty();
    $("#eennn").empty();
    $("#eeemm").append('<input type="hidden" name="email" value="'+eem+'">');
    $("#eennn").append('<input type="hidden" name="name" value="'+eeme+'">');
    }   
</script>
<!-- Modal -->
<div class="modal fade" id="viewDD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Description</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="cvdd">
       
      </div>      
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="askmm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Get in Touch with us</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="contact-section">
      <div class="container">
  <form id="CCForm">
    <div class="row">
      <div class="alert alert-danger status text-center" role="alert" style="position: relative;display: none;"></div>
      <div class="alert alert-success statusSuccess text-center" role="alert" style="position: relative;display: none;"></div>
      <div class="col-25" id="eennn">     
      </div>
      <div class="col-75" id="eeemm">
        </div>
    </div>    
    <div class="row">
      <div class="col-25">
        <label for="fname">Title</label>
      </div>
      <div class="col-75">
        <input type="text" id="ftitle" name="title" placeholder="Title..">
      </div>
      <div class="col-25">
        <label for="subject">Message</label>
      </div>
      <div class="col-75">
        <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>
      </div>
    </div>
   </form>
    <div class="row  col-md-3" style="float: right;">
      <button class="btn btn-dark" name="submit" onclick="contactForm();" type="submit">Submit</button>
    </div>
</div>

    </div>
      </div>
      </div>
  </div>
</div>