<div class="col-md-12" id="CitationD" style="display: none;">
    <h5 class="text-center">Citation</h5>
    <div class="card-body"><ul><li> GBIF.org (27 March 2022) GBIF Occurrence Download <a href="https://doi.org/10.15468/dl.dq3wc8">https://doi.org/10.15468/dl.dq3wc8</a></li>
    <li> eBird Basic Dataset. Version: EBD_relFeb-2022. Cornell Lab of Ornithology, Ithaca, New York. Feb 2022.</li><li> OBIS (YEAR) Ocean Biodiversity Information System. Intergovernmental Oceanographic Commission of UNESCO. <a href="www.obis.org">www.obis.org</a>.</li><li> IUCN. 2021. The IUCN Red List of Threatened Species. Version 2021-3. <a href="https://www.iucnredlist.org">https://www.iucnredlist.org</a>. </li><li> Bánki, O., Roskov, Y., Döring, M., Ower, G., Vandepitte, L., Hobern, D., Remsen, D., Schalk, P., DeWalt, R. E., Keping, M., Miller, J., Orrell, T., Aalbu, R., Adlard, R., Adriaenssens, E. M., Aedo, C., Aescht, E., Akkari, N., Alfenas-Zerbini, P., et al. (2022). Catalogue of Life Checklist (Y. Roskov, Ed.; Version 2022-05-20). Catalogue of Life. <a href="https://doi.org/10.48580/dfpn">https://doi.org/10.48580/dfpn</a></li></ul>
</div>
    <!-- <div class="card-body"></div>
    <div class="card-body"></div>
    <div class="card-body"></div>
    <div class="card-body"></div> -->
</div>
<!-- ======= Footer ======= -->
<footer id="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 footer-contact">
                    <div class="">
                    <h3 class="logo col-sm-6"><a href="<?= site_url('home'); ?>"><img src="<?= base_url('media/img/logo/ib_logo.png');?>"  style="width:100%;"></a></h3>
                </div>
                    <p>Indian Biodiversity Information System (IBIS) is a free and open reserve of comprehensive scientific information about all plant and animal lifeforms on the Indian subcontinent.</p>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="row">
                        <div class="col-lg-12 footer-tabs">
                        </div>
                        <div class="col-lg-4 col-md-4 footer-links">
                            <ul>
                                <li><i class="bx bx-chevron-right"></i> <a href="<?= site_url('Welcome/teams');?>">Team</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="<?= site_url('Welcome/faq');?>">FAQs</a></li>
                                <?php if (!empty($_SESSION[SESSION_NAME]['user_uuid'])) { ?>
                                <li><i class="bx bx-chevron-right"></i> <a href="<?= site_url('BirdID');?>">Bird ID</a></li>
                                <?php } else { ?>
                               <li><i class="bx bx-chevron-right"></i> <a href="javascript_void(0);" data-bs-toggle="modal" data-bs-target="#loginModalBID">Bird ID</a></li>
                               <?php } ?>     
                            </ul>
                        </div>

                        <div class="col-lg-4 col-md-4 footer-links">
                            <ul>
                                <li><i class="bx bx-chevron-right"></i> <a href="<?= site_url('Welcome/TaxonomoyDetails');?>">Taxonomy Details</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="<?= site_url('Welcome/tutorial');?>">Tutorials</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="javascript_void(0);" data-bs-toggle="modal" data-bs-target="#feedbackModalLP">Feedback</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-4 col-md-4 footer-links">
                            <ul>
                                <li><i class="bx bx-chevron-right"></i> <a href="<?= site_url('Welcome/DataPolicy');?>">Data Policy</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="<?= site_url('Welcome/term');?>">Terms of Use</a></li>

                         </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 px-4">     
                    
                    <div class="social-links mt-3">
                        <h4>Our Social Networks</h4>
                        <div class="w-full">
                            <a href="https://twitter.com/fesforcommons" class="twitter" target="_blank();"><i class="bx bxl-twitter"></i></a>&nbsp; Twitter
                        </div>
                        <div class="w-full py-1">
                            <a href="https://www.facebook.com/FESforCommons/" class="facebook" target="_blank();"><i class="bx bxl-facebook"></i></a>&nbsp; Facebook
                        </div>
                        <div class="w-full py-1">
                            <a href="https://www.instagram.com/fesforcommons/" class="instagram" target="_blank();"><i class="bx bxl-instagram"></i></a>&nbsp; Instagram
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
<div class="container" style="padding-top:2%;">
        <div class="row col-md-12">
        <div class="col-md-3">    
        <div>
            <a href="https://fes.org.in/"><img src="<?= base_url('media/img/logo/FES _Logo1.png');?>" style="width:70%;"></a></div>
        <div class="copyright" style="padding-top:27%;color: #528C59;">            
            &copy; Copyright <strong><span>FES</span></strong>. All Rights Reserved
        </div>
        </div> 
        <div class="col-md-6">
         <p class="text-center"><b>IBIS is an initiative of India Observatory (IO), a vertical of the Foundation for Ecological Security (FES). India Observatory (IO) aims to demystify and present comprehensive information on India’s social, ecological and economic parameters on a spatial and temporal platform for informed decision-making on nature conservation, natural resource management and enhancement of rural livelihoods.</b></p>   
        </div>
        <div class="col-md-3">  
        <div style="padding-left:65%;">
            <a href="https://indiaobservatory.org.in/"><img src="<?= base_url('media/img/logo/io-logo-footer.png');?>" style="width:100%;"></a></div>
            <div class="credits" style="padding-top:28%;color: #528C59;">
            Designed by <a href="https://altztech.com/"><strong style="color: #528C59;">AltzTech</strong></a>
        </div>
        </div>
      </div>           
    </div>
</footer>
<!-- End Footer -->
<div class="modal" id="feedbackModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body p-0">
                <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="row">
                    <div class="col-md-12 col-lg-4 feedback_nav_block">
                        <div class="feedback_nav">
                            <h2 class="text-800">FEEDBACK</h2>
                            <ul>
                                <li onclick="feedbackChangeTab(this,1)" class="active">Send Feedback</li>
                                <li onclick="feedbackChangeTab(this,2)">View Past Feedback
                                </li>
                                <li onclick="feedbackChangeTab(this,3)">Public Feedback</li>
                            </ul>
                        </div>
                        <div class="feedback_user_profile">
                            <img src="<?php if(!empty($_SESSION[SESSION_NAME]['profileImg'])) { echo base_url('media/uploads/'.$_SESSION[SESSION_NAME]['profileImg']); } 
                            else { echo base_url('media/img/user.png'); } ?>" alt="User" class="rounded-circle" style="width: 65px;height: 60px;">
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-8 feedback_form_block">
                        <form method="post" enctype="multipart/form-data" name="feedbackForm" id="feedbackForm">
                            <div class="mb-4">
                                <h2 class="text-800">Your constructive feedback is important to us.</h2>
                                <small class="text-muted">Each piece of feedback is read by the IBIS team, however a response is not guranteed in all cases.</small>
                            </div>

                            <div class="my-3">
                                <select name="section" class="form-select" id="feedback_section">
                                    <option value="">Feedback Category</option>
                                    <option value="General">General</option>
                                    <option value="Home">Home</option>
                                    <option value="Dashboard">Dashboard</option>
                                    <option value="Login">Login</option>
                                    <option value="Profile">Profile</option>
                                </select>
                                <span class="input_error_message" id="feedback_section_error"></span>
                            </div>
                            <div class="my-3">
                                <select name="type" class="form-select" id="feedback_type">
                                    <option value="">Feedback Type</option>
                                    <option value="Appreciation">Appreciation</option>
                                    <option value="Suggestion">Suggestion</option>
                                    <option value="Complaint">Complaint</option>
                                </select>
                                <span class="input_error_message" id="feedback_type_error"></span>
                            </div>
                            <div class="my-3">
                                <select name="emotion" class="form-select" id="feedback_emotion">
                                    <option value="">Your Emotion While Giving This Feedback</option>
                                    <option value="Ecstatic">Ecstatic</option>
                                    <option value="Happy">Happy</option>
                                    <option value="Neutral">Neutral</option>
                                    <option value="Annoyed">Annoyed</option>
                                    <option value="Furious">Furious</option>
                                </select>
                                <span class="input_error_message" id="feedback_emotion_error"></span>
                            </div>
                            <div class="my-3">
                                <textarea name="feedback" class="form-control" id="feedback_feedback" rows="4" placeholder="Feedback"></textarea>
                                <span class="input_error_message" id="feedback_feedback_error"></span>
                            </div>
                            <div class="my-4 row">
                                <div class="col-md-6 d-none">
                                    <label for="feedback_file" class="feedback_attachment_wrap">
                                        <i class="bx bx-paperclip"></i> Attachment
                                        <input type="file" name="feedback_file" id="feedback_file" class="form-control">
                                    </label>
                                </div>
                                <div class="col-md-12 text-end">
                                    <button type="button" class="btn btn-dark" onclick="return feedbackSubmitHandler(this);">Send &nbsp;<img src="<?= base_url('media/svg/bars.svg'); ?>" alt="loader" class="loader"></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12 col-lg-8 feedback_view_block d-none" id="feedback_view_block">
                        <h4 class="text-center text-muted"><em>No Feedbacks !</em></h4>
                    </div>
                    <div class="col-md-12 col-lg-8 public_feedback_block d-none ppl" id="public_feedback_block">
                        <h4 class="text-center text-muted"><em>No Feedbacks !</em></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<!-- Vendor JS Files -->
<script src="<?= base_url() ?>assets/js/jquery.js"></script>
<script src="<?= base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/php-email-form/validate.js"></script>
<script>
    const userDId = $(".GuiD").val();
    const site_url = (function_path) => {
        return '<?= site_url() ?>' + function_path;
    }
    const addClass = (el, class_name) => {
        el.classList.add(class_name);
    };

    const removeClass = (el, class_name) => {
        el.classList.remove(class_name);
    };

    const show = (el) => {
        document.querySelector(el).style.display = "block";
    }

    const hide = (el) => {
        document.querySelector(el).style.display = "none";
    }

    const getValue = (el) => {
        //alert(el); return false;
        return document.getElementById(el).value;
    }
    const getHtml = (el) => {
        return document.getElementById(el).innerHTML;
    }

    const setValue = (el, value) => {
        return document.getElementById(el).value = value;
    }
    const setHtml = (el, html) => {
        return document.getElementById(el).innerHTML = html;
    }
</script>
<!-- Template Main JS File -->
<!-- <script src="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/build/ol.js"></script> -->
<script src="<?= base_url(); ?>assets/js/ol.js"></script>
<script src="<?= base_url(); ?>assets/vendor/moment/moment.min.js"></script>
<script src="<?= base_url(); ?>assets/js/home.js"></script>
<script src="<?= base_url(); ?>assets/js/main.js"></script>

<?php if(!empty($_SESSION[SESSION_NAME]['user_uuid'])) { ?>
<script src="<?= base_url(); ?>assets/js/dashboard.js"></script>
<!-- <script src="<?= base_url(); ?>assets/js/search.js"></script> -->
<?php } else { ?>
<script src="<?= base_url(); ?>assets/js/feedback.js"></script>
<?php } ?>    
</body>
</html>
<?php 
//print_r($loginURL);exit;
?>
<div class="modal" id="signUpModal" tabindex="-1" style="z-index:99999">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body p-0">
                <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="row">
                    <div class="col-md-12 col-lg-6 signup_first">
                        <div class="signup_first__inner">
                         <p>You are welcome to join IBIS, on a lifetime’s effort to learn and share more data about the 
subcontinent’s biodiversity and habitats in new interactive ways. </p>
<div class="carousel d-none d-md-block" style="padding-top:527px;position: absolute;padding-left: 2px;width: 100%;">
                        <a><p class="card-body box2" style="font-size: 15px;"><i class="fa fa-copyright" aria-hidden="true"></i>
Mahek Vyas <i>Panthera tigris</i> (Bengal Tiger) Tadoba-Andhari Tiger Reserve</p></a></div>  
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 signup_second">
                        <form action="<?= site_url('Home/signup') ?>" method="post" enctype="multipart/form-data" name="signup_form" id="signup_form">
                            <div class="mb-4">
                                <h2 class="text-800 mt-4">Create Account</h2>
                             <small class="text-muted">Just provide these basic information to get started.</small>

                            </div>

                            <div></div>
                            <div class="mb-3 mt-3">
                            <div class="col-md-12 col-lg-12 row">    
                            <div class="col-md-6">
                                        <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name *" required pattern="[A-Za-z]{1,32}">
                                        <span class="input_error_message" id="first_name_error"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name *" required pattern="[A-Za-z]{1,32}">
                                        <span class="input_error_message" id="last_name_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 mt-3">  
                            <div class="col-md-12 col-lg-12 row">    
                            <div class="col-md-12">
                              <input type="text" name="username" id="username" class="form-control" placeholder="User Id *" required  onchange="userVerified(this.value);">
                                <span class="input_error_message" id="username_error"></span>
                                    </div>
                                </div>    
                             </div>   
                          <div class="mb-3 mt-3">
                            <div class="col-md-12 col-lg-12 row">    
                            <div class="col-md-12">
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email *" required onchange="emailVerified(this.value);" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
                                <span class="input_error_message" id="email_error"></span>
                            </div>
                        </div>
                    </div>
                            <div class="mb-3 mt-3">
                                <div class="col-md-12 col-lg-12 row">    
                            <div class="col-md-12">
                                <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone" maxlength="10" pattern="[789][0-9]{9}">
                                <span class="input_error_message" id="phone_error"></span>
                            </div>
                        </div>
                    </div>
                            <div class="mb-3 mt-3">
                                <div class="col-md-12 col-lg-12 row">
                                    <div class="col-md-6">
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Password *" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{12,20}$" title="Must contain at least one number and one uppercase and lowercase letter and one special character, and at least min 8 and max 12 characters.">
                                        <span class="input_error_message" id="password_error"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password *" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{12,20}$">
                                        <span class="input_error_message" id="confirm_password_error"></span>
                                    </div>
                                    <small style="color:red">Must contain at least one number and one uppercase and lowercase letter and one special character, and at least min 12 and max 20 characters.</small>
                                </div>
                            </div>
                            <div class="mb-3 mt-3">
                            <div class="col-md-12 col-lg-12 row"> 
                             <div class="col-md-12">   
                            <button button="submit" class="btn btn-dark col-md-12">Create My Account <img src="<?= base_url('media/svg/bars.svg'); ?>" alt="loader" class="loader"></button></div>
                        </div>
                        </div>
                        </form>
                        <hr class="mt-4" />
                        <div class="mt-4 mb-4">
                            <h6 class="text-800"> You can also use a social network to join</h6>
                        </div>
                        <div class="mb-3 mt-3">
                            <div class="col-md-12 col-lg-12 row"> 
                             <div class="col-md-12">
                            <button button="submit"  class="btn btn-primary btn-fb text-start col-md-12">
                                <a href="<?= $this->facebook->login_url();?>"><i class="bx bxl-facebook"></i> Continue with Facebook<img src="<?= base_url('media/svg/bars.svg'); ?>" alt="loader" class="loader"></a>
                            </button>
                        </div></div></div>
                        <div class="mb-3 mt-3">
                            <div class="col-md-12 col-lg-12 row"> 
                             <div class="col-md-12">
                            <button button="button" class="btn btn-danger btn-google text-start col-md-12">
                                <a href="<?= loginURL;?>"><i class="bx bxl-google"></i> Continue with Google <img src="<?= base_url('media/svg/bars.svg'); ?>" alt="loader" class="loader"></a>
                            </button>
                        </div></div></div>
                        <div class="mb-3 mt-3">
                            <div class="col-md-12 col-lg-12 row"> 
                             <div class="col-md-12">
                            <button button="button" class="btn text-start col-md-12" style="background-color: #833AB4;color: white;">
                               <a href="<?= authURL;?>"> <i class="bi bi-instagram"></i> Continue with Instagram <img src="<?= base_url('media/svg/bars.svg'); ?>" alt="loader" class="loader"></a>
                            </button>
                        </div></div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="loginModal" tabindex="-1" style="z-index:99999">
    <div class="modal-dialog modal-xl" >
        <div class="modal-content">
            <div class="modal-body p-0">
                <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="row">
        <div class="col-md-12 col-lg-6" style="background-image:url(<?= IMAGE_URL.'Sign_In.jpg'?>);min-height:70vh;background-position: center;
    background-size: cover;background-repeat: no-repeat;border-radius: 0.5rem;color: #fff;padding: 1rem 1rem;position: relative;">
                        <div class="login_first__inner">
                         <p>You are welcome to join IBIS, on a lifetime’s effort to learn and share more data about the 
subcontinent’s biodiversity and habitats in new interactive ways. </p>
<div class="carousel d-none d-md-block" style="padding-top:750px;position: absolute;width: 100%;">
                        <a><p class="card-body box2" style="font-size: 15px;"><i class="fa fa-copyright" aria-hidden="true"></i>
Kaushal Patel <i>Panthera pardus</i> (Leopard) Ranthambore Tiger Reserve</p></a></div>
                       </div>
                    </div>
                    <div class="col-md-12 col-lg-6 login_second">
                        <form action="<?= site_url('home/login') ?>" method="post" enctype="multipart/form-data" name="login_form" id="login_form">
                            <div>
                                <h2 class="text-800">Sign In</h2>
                                <h6 class="text-800 mt-4">Sign in with your user id.</h6>
                                &nbsp;<span class="input_error_message" id="login_errors"></span>
                            </div>
                            <div class="mb-4 mt-3">
                                <input type="text" name="username" id="login_username" class="form-control" placeholder="Please type your user id." required>
                                &nbsp;<span class="input_error_message" id="login_username_error"></span>
                            </div>
                            <div class="mb-4 mt-4">
                                <input type="password" name="password" id="login_password" class="form-control" placeholder="Please type your password." required>
                                &nbsp;<span class="input_error_message" id="login_password_error"></span>
                            </div>
                            <label><input id="rememberMe" name="rememberme" value="lsRememberMe" type="checkbox" checked onclick="lsRememberMe()" /> &nbsp;Remember me</label>
                            <label style="float:right;"><input id="keepSignin" name="rememberme" value="remember" type="checkbox" checked /> &nbsp; Keep me signed in</label>
                            <div class="d-grid mb-4 mt-4 text-center">
                                <button button="button" class="btn btn-dark py-2 fs-5" onclick="return validateLoginHandlerD(this);">Sign In <img src="<?= base_url('media/svg/bars.svg'); ?>" alt="loader" class="loader"></button>                               
                            </div>
                           
                        </form>
                        <div class="col-md-12 col-lg-12 align-items-center">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal" class="btn btn-primary">Forgot Password</button>   
                            <button type="button" style="float: right;" data-bs-toggle="modal" data-bs-target="#forgotUserIdModal" class="btn btn-success">Forgot User ID</button>                             
                          </div> 
                        <hr class="mb-5 mt-5" />
                        <div class="mt-4 mb-4">
                            <h6 class="text-800"> Sign In with Social Network</h6>
                        </div>
                        <div class="mt-4 mb-4 d-grid">
                            <button button="button" class="btn btn-primary btn-fb text-start py-2 fs-5">
                                <a href="<?= $this->facebook->login_url();?>"><i class="bx bxl-facebook"></i> Continue with Facebook <img src="<?= base_url('media/svg/bars.svg'); ?>" alt="loader" class="loader"></a>
                            </button>
                        </div>
                        <div class="mt-4 mb-4 d-grid">
                        <button button="button" class="btn btn-danger btn-google text-start py-2 fs-5">
                                <a href="<?= loginURL;?>"><i class="bx bxl-google"></i> Continue with Google <img src="<?= base_url('media/svg/bars.svg'); ?>" alt="loader" class="loader"></a>
                            </button>
                        </div>
                        <div class="mt-4 mb-4 d-grid">
                            <button button="button" class="btn text-start py-2 fs-5" style="background-color: #833AB4;color: white;">
                                <a href="<?= authURL;?>"><i class="bi bi-instagram"></i> Continue with Instagram <img src="<?= base_url('media/svg/bars.svg'); ?>" alt="loader" class="loader"></a>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="successModal" style="z-index: 1056;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal body -->
            <div class="modal-body text-center">
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                <div class="col-md-12 p-4">
                    <svg class="u-svg-content fs-1" viewBox="0 0 512 512" style="width: 1em; height: 1em;">
                        <path d="M256,6.998c-137.533,0-249,111.467-249,249c0,137.534,111.467,249,249,249s249-111.467,249-249  C505,118.464,393.533,6.998,256,6.998z M256,485.078c-126.309,0-229.08-102.771-229.08-229.081  c0-126.31,102.771-229.08,229.08-229.08c126.31,0,229.08,102.771,229.08,229.08C485.08,382.307,382.31,485.078,256,485.078z" fill="#2ce670"></path>
                        <polygon fill="#2ce670" points="384.235,158.192 216.919,325.518 127.862,236.481 113.72,250.624 216.919,353.803 398.28,172.334   "></polygon>
                    </svg>
                </div>
                <div class="col-md-12 text-success p-4">
                    <h4 id="successModalMessage"></h4>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="modal" id="forgotPasswordModal" tabindex="-1" style="z-index:99999">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="row">
                    <div class="col-md-12">
                        <form= method="post" enctype="multipart/form-data" name="forgotPass_form" id="forgotPass_form">
                            <div>
                                <h2 class="text-800">Reset Your Password</h2>
                                <h6 class="text-800 mt-4">Enter your email address to reset password.</h6>
                            </div>
                            <div class="mb-4 mt-3">
                                <input type="email" name="email" id="fp_email" class="form-control" placeholder="Email *">
                                <span class="input_error_message" id="fp_email_error"></span>
                            </div>
                            <div class="d-grid mb-4 mt-4 text-center">
                                <button button="button" class="btn btn-dark py-2 fs-5" onclick="return forgotPasswordHandler(this);">Send <img src="<?= base_url('media/svg/bars.svg'); ?>" alt="loader" class="loader"></button>
                            </div>
                        </form=>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="forgotUserIdModal" tabindex="-1" style="z-index:99999">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="row">
                    <div class="col-md-12">
                        <form= method="post" enctype="multipart/form-data" name="forgotuser_form" id="forgotPass_form">
                            <div>
                                <h2 class="text-800">Reset Your User ID</h2>
                                <h6 class="text-800 mt-4">Enter your email address to reset user Id.</h6>
                            </div>
                            <div class="mb-4 mt-3">
                                <input type="text" name="email" id="fu_user" class="form-control" placeholder="Email *">
                                <span class="input_error_message" id="fu_user_error"></span>
                            </div>
                            <div class="d-grid mb-4 mt-4 text-center">
                                <button button="button" class="btn btn-dark py-2 fs-5" onclick="return forgotUserIdHandler(this);">Send <img src="<?= base_url('media/svg/bars.svg'); ?>" alt="loader" class="loader"></button>
                            </div>
                        </form=>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Become a Citizen Scientist Login-->
<div class="modal" id="loginModalS" tabindex="-1" style="z-index:99999">
    <div class="modal-dialog modal-xl" >
        <div class="modal-content">
            <div class="modal-body p-0">
                <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="row">
        <div class="col-md-12 col-lg-6" style="background-image:url(<?= IMAGE_URL.'Sign_In.jpg'?>);min-height:70vh;background-position: center;
    background-size: cover;background-repeat: no-repeat;border-radius: 0.5rem;color: #fff;padding: 1rem 1rem;position: relative;">
                        <div class="login_first__inner">
                         <p>You are welcome to join IBIS, on a lifetime’s effort to learn and share more data about the 
subcontinent’s biodiversity and habitats in new interactive ways. </p>
<div class="carousel d-none d-md-block" style="padding-top:750px;position: absolute;width: 100%;">
                        <a><p class="card-body box2" style="font-size: 15px;"><i class="fa fa-copyright" aria-hidden="true"></i>
Kaushal Patel <i>Panthera pardus</i> (Leopard) Ranthambore Tiger Reserve</p></a></div>
                       </div>
                    </div>
                    <div class="col-md-12 col-lg-6 login_second">
                        <form action="<?= site_url('home/Slogin') ?>" method="post" enctype="multipart/form-data" name="Slogin_form" id="Slogin_form">
                            <div>
                                <h2 class="text-800">Sign In</h2>
                                <h6 class="text-800 mt-4">Sign in with your user id.</h6>
                                &nbsp;<span class="input_error_message" id="login_errors"></span>
                            </div>
                            <div class="mb-4 mt-3">
                                <input type="text" name="username" id="login_usernameS" class="form-control" placeholder="Please type your user id." required>
                                &nbsp;<span class="input_error_message" id="login_username_error"></span>
                            </div>
                            <div class="mb-4 mt-4">
                                <input type="password" name="password" id="login_passwordS" class="form-control" placeholder="Please type your password." required>
                                &nbsp;<span class="input_error_message" id="login_password_error"></span>
                            </div>
                            <label><input id="rememberMeS" name="rememberme" value="lsRememberMe" type="checkbox" checked onclick="lsRememberMeS()" /> &nbsp;Remember me</label>
                            <label style="float:right;"><input id="keepSigninS" name="rememberme" value="remember" type="checkbox" checked /> &nbsp; Keep me signed in</label>
                            <div class="d-grid mb-4 mt-4 text-center">
                                <button button="button" class="btn btn-dark py-2 fs-5" onclick="return validateLoginHandlerSD(this);">Sign In <img src="<?= base_url('media/svg/bars.svg'); ?>" alt="loader" class="loader"></button>                               
                            </div>
                           
                        </form>
                        <div class="col-md-12 col-lg-12 align-items-center">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal" class="btn btn-primary">Forgot Password</button>   
                            <button type="button" style="float: right;" data-bs-toggle="modal" data-bs-target="#forgotUserIdModal" class="btn btn-success">Forgot User ID</button>                             
                          </div> 
                        <hr class="mb-5 mt-5" />
                        <div class="mt-4 mb-4">
                            <h6 class="text-800"> Sign In with Social Network</h6>
                        </div>
                        <div class="mt-4 mb-4 d-grid">
                            <button button="button" class="btn btn-primary btn-fb text-start py-2 fs-5">
                                <a href="<?= $this->facebook->login_url();?>
"><i class="bx bxl-facebook"></i> Continue with Facebook <img src="<?= base_url('media/svg/bars.svg'); ?>" alt="loader" class="loader"></a>
                            </button>
                        </div>
                        <div class="mt-4 mb-4 d-grid">
                        <button button="button" class="btn btn-danger btn-google text-start py-2 fs-5">
                                <a href="<?= loginURL;?>"><i class="bx bxl-google"></i> Continue with Google <img src="<?= base_url('media/svg/bars.svg'); ?>" alt="loader" class="loader"></a>
                            </button>
                        </div>
                        <div class="mt-4 mb-4 d-grid">
                            <button button="button" class="btn text-start py-2 fs-5" style="background-color: #833AB4;color: white;">
                                <a href="<?= authURL;?>"><i class="bi bi-instagram"></i> Continue with Instagram <img src="<?= base_url('media/svg/bars.svg'); ?>" alt="loader" class="loader"></a>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- BirdID Login -->
<div class="modal" id="loginModalBID" tabindex="-1" style="z-index:99999">
    <div class="modal-dialog modal-xl" >
        <div class="modal-content">
            <div class="modal-body p-0">
                <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="row">
        <div class="col-md-12 col-lg-6" style="background-image:url(<?= IMAGE_URL.'Sign_In.jpg'?>);min-height:70vh;background-position: center;
    background-size: cover;background-repeat: no-repeat;border-radius: 0.5rem;color: #fff;padding: 1rem 1rem;position: relative;">
                        <div class="login_first__inner">
                         <p>You are welcome to join IBIS, on a lifetime’s effort to learn and share more data about the 
subcontinent’s biodiversity and habitats in new interactive ways. </p>
<div class="carousel d-none d-md-block" style="padding-top:750px;position: absolute;width: 100%;">
                        <a><p class="card-body box2" style="font-size: 15px;"><i class="fa fa-copyright" aria-hidden="true"></i>
Kaushal Patel <i>Panthera pardus</i> (Leopard) Ranthambore Tiger Reserve</p></a></div>
                       </div>
                    </div>
                    <div class="col-md-12 col-lg-6 login_second">
                        <form action="<?= site_url('home/loginBID') ?>" method="post" enctype="multipart/form-data" name="loginBID" id="loginBID">
                            <div>
                                <h2 class="text-800">Sign In</h2>
                                <h6 class="text-800 mt-4">Sign in with your user id.</h6>
                                &nbsp;<span class="input_error_message" id="login_errors"></span>
                            </div>
                            <div class="mb-4 mt-3">
                                <input type="text" name="username" id="login_usernameBID" class="form-control" placeholder="Please type your user id." required>
                                &nbsp;<span class="input_error_message" id="login_username_errorBID"></span>
                            </div>
                            <div class="mb-4 mt-4">
                                <input type="password" name="password" id="login_passwordBID" class="form-control" placeholder="Please type your password." required>
                                &nbsp;<span class="input_error_message" id="login_password_errorBID"></span>
                            </div>
                            <label><input id="rememberMeBID" name="rememberme" value="lsRememberMe" type="checkbox" checked onclick="lsRememberMeBID()" /> &nbsp;Remember me</label>
                            <label style="float:right;"><input id="keepSigninBID" name="rememberme" value="remember" type="checkbox" checked /> &nbsp; Keep me signed in</label>
                            <div class="d-grid mb-4 mt-4 text-center">
                                <button button="button" class="btn btn-dark py-2 fs-5" onclick="return validateLoginHandlerBID(this);">Sign In <img src="<?= base_url('media/svg/bars.svg'); ?>" alt="loader" class="loader"></button>                               
                            </div>
                           
                        </form>
                        <div class="col-md-12 col-lg-12 align-items-center">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal" class="btn btn-primary">Forgot Password</button>   
                            <button type="button" style="float: right;" data-bs-toggle="modal" data-bs-target="#forgotUserIdModal" class="btn btn-success">Forgot User ID</button>                             
                          </div> 
                        <hr class="mb-5 mt-5" />
                        <div class="mt-4 mb-4">
                            <h6 class="text-800"> Sign In with Social Network</h6>
                        </div>
                        <div class="mt-4 mb-4 d-grid">
                            <button button="button" class="btn btn-primary btn-fb text-start py-2 fs-5">
                                <a href="<?= $this->facebook->login_url();?>"><i class="bx bxl-facebook"></i> Continue with Facebook <img src="<?= base_url('media/svg/bars.svg'); ?>" alt="loader" class="loader"></a>
                            </button>
                        </div>
                        <div class="mt-4 mb-4 d-grid">
                        <button button="button" class="btn btn-danger btn-google text-start py-2 fs-5">
                                <a href="<?= loginURL;?>"><i class="bx bxl-google"></i> Continue with Google <img src="<?= base_url('media/svg/bars.svg'); ?>" alt="loader" class="loader"></a>
                            </button>
                        </div>
                        <div class="mt-4 mb-4 d-grid">
                            <button button="button" class="btn text-start py-2 fs-5" style="background-color: #833AB4;color: white;">
                                <a href="<?= authURL;?>"><i class="bi bi-instagram"></i> Continue with Instagram <img src="<?= base_url('media/svg/bars.svg'); ?>" alt="loader" class="loader"></a>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Feedback Landing Page -->
<div class="modal" id="feedbackModalLP" tabindex="-1" style="z-index:99999">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body p-0">
                <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="row">
                    <div class="col-md-12 col-lg-4 feedback_nav_block">
                        <div class="feedback_nav">
                            <h2 class="text-800">FEEDBACK</h2>
                            <ul>
                                <li onclick="feedbackChangeTabLP(this,1)" class="active">Send Feedback</li>
                                <li onclick="feedbackChangeTabLP(this,3)">Public Feedback</li>
                            </ul>
                        </div>
                        <div class="feedback_user_profile">
                            <img src="<?php if(!empty($_SESSION[SESSION_NAME]['profileImg'])) { echo base_url('media/uploads/'.$_SESSION[SESSION_NAME]['profileImg']); } 
                            else { echo base_url('media/img/user.png'); } ?>" alt="User" class="rounded-circle" style="width: 65px;height: 60px;">
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-8 feedback_form_block">
                        <form method="post" enctype="multipart/form-data" name="feedbackForm" id="feedbackFormLP">
                            <div class="mb-4">
                                <h2 class="text-800">Your constructive feedback is important to us.</h2>
                                <small class="text-muted">Each piece of feedback is read by the IBIS team, however a response is not guranteed in all cases.</small>
                            </div>

                            <div class="my-3">
                                <select name="section" class="form-select" id="feedback_sectionLP">
                                    <option value="">Feedback Category</option>
                                    <option value="General">General</option>
                                    <option value="Home">Home</option>
                                    <option value="Dashboard">Dashboard</option>
                                    <option value="Login">Login</option>
                                    <option value="Profile">Profile</option>
                                </select>
                                <span class="input_error_message" id="feedback_section_errorLP"></span>
                            </div>
                            <div class="my-3">
                                <select name="type" class="form-select" id="feedback_typeLP">
                                    <option value="">Feedback Type</option>
                                    <option value="Appreciation">Appreciation</option>
                                    <option value="Suggestion">Suggestion</option>
                                    <option value="Complaint">Complaint</option>
                                </select>
                                <span class="input_error_message" id="feedback_type_errorLP"></span>
                            </div>
                            <div class="my-3">
                                <select name="emotion" class="form-select" id="feedback_emotionLP">
                                    <option value="">Your Emotion While Giving This Feedback</option>
                                    <option value="Ecstatic">Ecstatic</option>
                                    <option value="Happy">Happy</option>
                                    <option value="Neutral">Neutral</option>
                                    <option value="Annoyed">Annoyed</option>
                                    <option value="Furious">Furious</option>
                                </select>
                                <span class="input_error_message" id="feedback_emotion_errorLP"></span>
                            </div>
                            <div class="my-3">
                                <textarea name="feedback" class="form-control" id="feedback_feedbackLP" rows="4" placeholder="Feedback"></textarea>
                                <span class="input_error_message" id="feedback_feedback_errorLP"></span>
                            </div>
                            <div class="my-4 row">
                                <div class="col-md-6 d-none">
                                    <label for="feedback_file" class="feedback_attachment_wrap">
                                        <i class="bx bx-paperclip"></i> Attachment
                                        <input type="file" name="feedback_file" id="feedback_fileLP" class="form-control">
                                    </label>
                                </div>
                                <div class="col-md-12 text-end">
                                    <button type="button" class="btn btn-dark" onclick="return feedbackSubmitHandlerLPP(this);">Send &nbsp;<img src="<?= base_url('media/svg/bars.svg'); ?>" alt="loader" class="loader"></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- <div class="col-md-12 col-lg-8 feedback_view_block d-none" id="feedback_view_block">
                        <h4 class="text-center text-muted"><em>No Feedbacks !</em></h4>
                    </div> -->
                    <div class="col-md-12 col-lg-8 public_feedback_blockD d-none" id="public_feedback_blockpl">
                        <h4 class="text-center text-muted"><em>No Feedbacks!</em></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    const rmCheckBID = document.getElementById("rememberMeBID"),
    UserIdInputBID = document.getElementById("login_usernameBID"),
    PassInputBID = document.getElementById("login_passwordBID");

if (localStorage.checkbox && localStorage.checkbox !== "") {
  rmCheckBID.setAttribute("checked", "checked");
  UserIdInputBID.value = localStorage.username;
  PassInputBID.value = localStorage.password;
} else {
  rmCheckBID.removeAttribute("checked");
  UserIdInputBID.value = "";
  PassInputBID.value = "";
}

function lsRememberMeBID() {
  if (rmCheckBID.checked && UserIdInput.value !== "") {
    localStorage.username = UserIdInput.value;
    localStorage.password = PassInput.value;
    localStorage.checkbox = rmCheckBID.value;
  } else {
    localStorage.username = "";
    localStorage.password = "";
    localStorage.checkbox = "";
  }
}
</script>
<script type="text/javascript">
    const rmCheck = document.getElementById("rememberMe"),
    UserIdInput = document.getElementById("login_username"),
    PassInput = document.getElementById("login_password");

if (localStorage.checkbox && localStorage.checkbox !== "") {
  rmCheck.setAttribute("checked", "checked");
  UserIdInput.value = localStorage.username;
  PassInput.value = localStorage.password;
} else {
  rmCheck.removeAttribute("checked");
  UserIdInput.value = "";
  PassInput.value = "";
}

function lsRememberMe() {
  if (rmCheck.checked && UserIdInput.value !== "") {
    localStorage.username = UserIdInput.value;
    localStorage.password = PassInput.value;
    localStorage.checkbox = rmCheck.value;
  } else {
    localStorage.username = "";
    localStorage.password = "";
    localStorage.checkbox = "";
  }
}
</script>
<script type="text/javascript">
    const rmCheckS = document.getElementById("rememberMeS"),
    UserIdInputS = document.getElementById("login_usernameS"),
    PassInputS = document.getElementById("login_passwordS");

if (localStorage.checkbox && localStorage.checkbox !== "") {
  rmCheckS.setAttribute("checked", "checked");
  UserIdInputS.value = localStorage.username;
  PassInputS.value = localStorage.password;
} else {
  rmCheckS.removeAttribute("checked");
  UserIdInputS.value = "";
  PassInputS.value = "";
}

function lsRememberMeS() {
  if (rmCheckS.checked && UserIdInputS.value !== "") {
    localStorage.username = UserIdInputS.value;
    localStorage.password = PassInputS.value;
    localStorage.checkbox = rmCheckS.value;
  } else {
    localStorage.username = "";
    localStorage.password = "";
    localStorage.checkbox = "";
  }
}
</script>

<script src="https://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>
<script type="text/javascript">
    $(document).ready(function(){

    $("#txt_search").keyup(function(){
        var search = $(this).val();

        if(search != ""){

            $.ajax({
                url: '<?php echo site_url('Search/SearchD');?>',
                type: 'post',
                data: {search:search, type:1},
                dataType: 'json',
                success:function(response){
                //alert(response); return false;
                    var len = response.length;
                    $("#searchResult").empty();
                    for( var i = 0; i<len; i++){
                        var id = response[i]['id'];
                        var name = response[i]['name'];

                        $("#searchResult").append("<li value='"+id+"'>"+name+"</li>");

                    }

                    // binding click event to li
                    $("#searchResult li").bind("click",function(){
                        setText(this);
                    });

                }
            });
        }

    });

});
    // Set Text to search box and get details
function setText(element){

    var value = $(element).text();
    var userid = $(element).val();

    $("#txt_search").val(value);
    $("#searchResult").empty();
    
    // Request User Details
    $.ajax({
        url: '<?php echo site_url('Search/SearchD');?>',
        type: 'post',
        data: {userid:userid, type:2},
        dataType: 'json',
        success: function(response){

            /*var len = response.length;
            $("#userDetail").empty();
            if(len > 0){
                var username = response[0]['username'];
                var email = response[0]['email'];
                $("#userDetail").append("Username : " + username + "<br/>");
                $("#userDetail").append("Email : " + email);
            }*/
        }

    });
}
/*function searchList(data) {
      alert(data);return false;
    }    */
</script>