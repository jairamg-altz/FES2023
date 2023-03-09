<?php //print_r(site_url());exit;?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>FES Admin | Log in</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?= base_url()?>/assets/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url()?>/assets/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url()?>/assets/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url()?>/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url()?>/plugins/iCheck/square/blue.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <img src="<?= base_url('/../media/img/logo/IBLOGO.png');?>" alt="img" class="img-thumbnail" style="max-width: 55%;">
</div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Admin panel</p>
    <?php if($this->session->userdata('message')) { ?><span style="color:red;"><?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : '';?></span><?php } ?>    
    <span style="color:red" id="errormsg"></span>
    <form action="<?= site_url('Welcome/login');?>" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="User ID" name="user_id" id="user_id">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password" id="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
      <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat" onclick="return validate();">Sign In</button>
        </div>
    <div class="col-xs-8">
         </div>
      </div>
    </form>
    <!-- /.social-auth-links -->
    <br>
    
  </div>
  <!-- /.login-box-body -->
</div>
<script src="<?= base_url()?>/assets/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url()?>/assets/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?= base_url()?>/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });

  function validate()
  {
    var email= $("#email").val();
    var pattern_email = /^[a-z0-9._-]+@[a-z]+.[a-z]{2,5}$/i;
    var password= $("#password").val();   
   /*if(email=="")
    {      
	      $("#errormsg").html("Please enter email");
	      setTimeout(function(){$("#errormsg").html('');},9000);
	      $("#email").focus();
	      return false;
    }
    else if(!pattern_email.test(email))
      {
	       $("#errormsg").fadeIn().html("Please enter valid email");
	       setTimeout(function(){$("#errormsg").fadeOut();},3000);
	       $("#email").focus();
	       return false; 
      }*/
    if(password=="")
    {
	      $("#errormsg").html("Please enter password");
	      setTimeout(function(){$("#errormsg").html('');},9000);
	      $("#password").focus();
	      return false;
    }
  }
</script>
</body>
</html>
