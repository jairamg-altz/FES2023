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
    .middle {
  position: relative;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
}
.content-header{
  font-family: 'Oleo Script', cursive;
  color:#fcc500;
  font-size: 35px;
}

.section-content{
  text-align: center; 

}
#contact{
    
    font-family: 'Teko', sans-serif;
  padding-top: 10px;
  width: 100%;
  width: 100vw;
  height: 550px;
  background: #3a6186; /* fallback for old browsers */
  background: -webkit-linear-gradient(to left, #3a6186 , #89253e); /* Chrome 10-25, Safari 5.1-6 */
  background: linear-gradient(to left, #3a6186 , #89253e); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    color : #fff;    
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
        <h1 class="display-4">Contact Us</h1></div>
</section id="contact">
<!--Section: Contact v.2-->
<section>
      <div class="section-content">
        <h1 class="section-header">Get in Touch with us</h1>
        <!-- <h3>Lorem Ipsum is simply dummy text of the printing and typesetting industry</h3> -->
      </div>
      <div class="contact-section">
      <div class="container">
  <form id="CCForm">
    <div class="row">
      <div class="alert alert-danger status text-center" role="alert" style="position: relative;display: none;"></div>
      <div class="alert alert-success statusSuccess text-center" role="alert" style="position: relative;display: none;"></div>
      <div class="col-25">
        <label for="fname">First Name</label>
      </div>
      <div class="col-75">
        <input type="text" id="fname" name="firstname" placeholder="Your name..">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="lname">Last Name</label>
      </div>
      <div class="col-75">
        <input type="text" id="lname" name="lastname" placeholder="Your last name..">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="email">Email</label>
      </div>
      <div class="col-75">
        <input type="text" id="email" name="email" placeholder="Your email..">
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
    </section>
<!--Section: Contact v.2-->
<?php $this->load->view('common/footer'); ?>
<script type="text/javascript">
  function contactForm() {
    $("form[id*=CCForm]").each(function() {
        event.preventDefault();
  var fname =  document.getElementById('fname').value;
  if (fname == "") {
      $('.status').show();
      document.querySelector('.status').innerHTML = "First Name cannot be empty";
      setTimeout(function(){$(".status").hide();},3000);
      return false;
  }
  var lname =  document.getElementById('lname').value;
  if (lname == "") {
      $('.status').show();
      document.querySelector('.status').innerHTML = "Last Name cannot be empty";
      setTimeout(function(){$(".status").hide();},3000);
      return false;
  }
  var email =  document.getElementById('email').value;
  if (email == "") {
      $('.status').show();
      document.querySelector('.status').innerHTML = "Email cannot be empty";
      setTimeout(function(){$(".status").hide();},3000);
      return false;
  } else {
      var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      if(!re.test(email)){
          $('.status').show();
          document.querySelector('.status').innerHTML = "Email format invalid";
          setTimeout(function(){$(".status").hide();},3000);
          return false;
      }
  }
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
    url: "<?= site_url('Welcome/contactAction');?>",// where you wanna post
    data: formData,
    processData: false,
    contentType: false,
    error: function(jqXHR, textStatus, errorMessage) {
        console.log(errorMessage); // Optional
    },
    success: function(data) {
      if(data=='1')
      {
        $('.statusSuccess').show();
        document.querySelector('.statusSuccess').innerHTML = "Your message has been submitted";
        setTimeout(function(){
        $(".statusSuccess").hide();
        window.location.href = '<?= site_url('Welcome/contact')?>';
      },3000);
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