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
@import url(//fonts.googleapis.com/css?family=Montserrat:300,500);
.team4 {
  font-family: "Montserrat", sans-serif;
    color: #8d97ad;
  font-weight: 300;
}

.team4 h1, .team4 h2, .team4 h3, .team4 h4, .team4 h5, .team4 h6 {
  color: #3e4555;
}

.team4 .font-weight-medium {
    font-weight: 500;
}

.team4 h5 {
    line-height: 22px;
    font-size: 18px;
}

.team4 .subtitle {
    color: #8d97ad;
    line-height: 24px;
        font-size: 13px;
}

.team4 ul li a {
  color: #8d97ad;
  padding-right: 15px;
  -webkit-transition: 0.1s ease-in;
  -o-transition: 0.1s ease-in;
  transition: 0.1s ease-in;
}

.team4 ul li a:hover {
  -webkit-transform: translate3d(0px, -5px, 0px);
  transform: translate3d(0px, -5px, 0px);
    color: #316ce8;
}    
</style>

<section class="p-0">
    <div class="col-md-12 page-header">
        <h1 class="display-4">Team</h1>
        <p class="fs-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>
    </div>
</section>
<section>
    <div class="py-5 team4">
  <div class="container">   
    <div class="row">
      <!-- column  -->
      <?php foreach($teamData as $teamDataRow) { ?>
      <div class="col-lg-3 mb-4">
        <!-- Row -->
        <div class="row">
          <div class="col-md-12">
            <?php if(!empty($teamDataRow->image_id)) { ?>
            <img src="<?= base_url('/assets/uploads/team/'.$teamDataRow->image_id);?>" alt="wrapkit" class="img-fluid rounded-circle" />
          <?php } else { ?>
            <img src="<?= base_url('/assets/uploads/team/user.png');?>" alt="wrapkit" class="img-fluid rounded-circle" />
          <?php } ?>
          </div>
          <div class="col-md-12 text-center">
            <div class="pt-2">
              <h5 class="mt-4 font-weight-medium mb-0"><?= ucfirst($teamDataRow->member_name);?></h5>
              <h6 class="subtitle mb-3"><?= ucfirst($teamDataRow->member_designation);?></h6>
              <p><?= $teamDataRow->about_member;?></p>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
    </div>
  </div>
</div>
</section>
<?php $this->load->view('common/footer'); ?>