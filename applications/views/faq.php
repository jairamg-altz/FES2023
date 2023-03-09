<?php $this->load->view('common/header'); ?>
<style type="text/css">
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
<section class="p-0">
    <div class="col-md-12 page-header">
        <h1 class="display-4">Frequently Asked Question</h1>
        <!-- <p class="fs-2">Lorem Ipsum is simply dummy text of the <br />printing and typesetting industry</p> -->
    </div>
</section>
<section>
    <div class="py-5 team4">
  <div class="container">   
    <div class="row">
      <!-- column  -->
      <div class="accordion" id="myAccordion">
          <?php  
        $sr=1;foreach($Fdata as $FdataRow) { ?>
        <div class="accordion-item" >
            <h2 class="accordion-header" id="headingOne<?= $sr;?>">
                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseOne<?= $sr;?>"><h4><?= $sr;?>. <?= $FdataRow->question;?></h4></button>                  
            </h2>
            <div id="collapseOne<?= $sr;?>" class="accordion-collapse collapse">
                <div class="card-body">
                    <p><?= $FdataRow->answer;?></p>
                </div>
            </div>
              <?php $sr++; } ?>
        </div>
    </div>
    </div>
  </div>
</div>
</section> 
<?php $this->load->view('common/footer'); ?>