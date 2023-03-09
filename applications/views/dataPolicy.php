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
<section class="p-0">
    <div class="col-md-12 page-header">
        <h1 class="display-4"><?= ucfirst($title);?></h1>
        <p class="fs-2">Data Policy</p>
    </div>
</section>
<section>
    <div class="py-5 team4">
  <div class="container">   
    <div class="row">
      <div class="col-md-12">
      <!-- column  -->
<h2 style="text-align: center;"><?= ucfirst($title);?></h2>    
<p style="font-family:Arial, Helvetica, sans-serif "><b><?= $desc; ?></b></p>  
    </div>
    </div>
  </div>
</div>
</section>
<?php $this->load->view('common/footer'); ?>