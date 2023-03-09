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
 .main-verification-input {
     background: #fff;
     padding: 0 120px 0 0;
     border-radius: 1px;
     margin-top: 6px
 }

 .fl-wrap {
     float: left;
     width: 100%;
     position: relative;
     border-radius: 4px
 }

 .main-verification-input:before {
     content: '';
     position: absolute;
     bottom: -40px;
     width: 50px;
     height: 1px;
     background: rgba(255, 255, 255, 0.41);
     left: 50%;
     margin-left: -25px
 }

 .main-verification-input-item {
     float: left;
     width: 100%;
     box-sizing: border-box;
     border-right: 1px solid #eee;
     height: 50px;
     position: relative
 }

 .main-verification-input-item input:first-child {
     border-radius: 100%
 }

 .main-verification-input-item input {
     float: left;
     border: none;
     width: 100%;
     height: 36px;
     padding-left: 20px
 }

 .main-verification-button {
     background: #4DB7FE
 }

 .main-verification-button {
     position: absolute;
     right: 0px;
     height: 50px;
     width: 120px;
     color: #fff;
     top: 0;
     border: none;
     border-top-right-radius: 4px;
     border-bottom-right-radius: 4px;
     cursor: pointer
 }

 .main-verification-input-wrap {
     max-width: 500px;
     margin: 20px auto;
     position: relative;
     margin-top: 49px
 }

 .main-verification-input-wrap ul {
     background-color: #fff;
     padding: 27px;
     color: #757575;
     border-radius: 4px
 }

 a {
     text-decoration: none !important;
     color: #9C27B0
 }

 :focus {
     outline: 0
 }

 @media only screen and (max-width: 768px) {
     .main-verification-input {
         background: rgba(255, 255, 255, 0.2);
         padding: 14px 20px 10px;
         border-radius: 10px;
         box-shadow: 0px 0px 0px 10px rgba(255, 255, 255, 0.0)
     }

     .main-verification-input-item {
         width: 100%;
         border: 1px solid #eee;
         height: 50px;
         border: none;
         margin-bottom: 10px
     }

     .main-verification-input-item input {
         border-radius: 6px !important;
         background: #fff
     }

     .main-verification-button {
         position: relative;
         float: left;
         width: 100%;
         border-radius: 6px
     }
 }  
</style>
<section class="p-0">
    <div class="col-md-12 page-header">
        <h1 class="display-6">Otp Authentication</h1>
    </div>
</section>
<section class="team px-5 py-2">
    <div class="row">    
    <div class="col-md-12">
        <center>
 <?php if($this->session->flashdata('message')) { ?><span style="color:green;" id="hide"><?php echo $this->session->flashdata('message') <> '' ? $this->session->flashdata('message') : '';?></span><?php } ?>
              </center>
        <div class="main-verification-input-wrap">
            <ul class="card-body">
                <h6><b>You will receive a verification code on your mail after you registered. Enter that code below.</b></h6> </ul>
               
            <div class="main-verification-input fl-wrap">
            <form method="POST" action="<?= site_url('Home/OtpCheck');?>">
                <input type="hidden" name="user_uuid" value="<?= $user_uuid;?>">    
                <div class="main-verification-input-item form-control"> <input type="text" placeholder="Enter the verification code" required minlength="6" name="otp"> </div> <button class="main-verification-button" type="submit">Verify Now</button></form>

            </div>
            <div style="padding-top:65px;text-align: center;">
            <button class="btn btn-primary outline"  type="button" onclick="resendOtp(this.value);" value="<?= $user_uuid;?>">Resend OTP</button>
            </div>
        </div>
    </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php $this->load->view('common/footer'); ?>
<script type="text/javascript">
setTimeout(function(){$("#hide").html('');},2000);
</script>
<script type="text/javascript">
 function resendOtp(value) {
    //
    $.ajax({
    type: "POST",
    url: "<?= site_url('Home/resendotp');?>",// where you wanna post
    data: "user_uuid="+value,
    success: function(data) {
      alert(data); return false;
    } 
});
    }   
</script>