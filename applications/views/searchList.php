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

    .member-img .bi-image {
        font-size: 10rem;
    }

    .checklist-block-left {
        background: linear-gradient(180deg, #31B551 0%, #2249A7 80%);
        border-radius: 0.5rem;
        display: grid;
        align-content: space-between;
        color: #fff;
        padding: 0;
        min-height: 60vh;
    }
</style>

<section class="p-0">
    <div class="col-md-12 page-header">
        <h1 class="display-6">Search Result</h1>
    <!-- <p><b>Have you been birding this morning? Or herping last night? The data you gathered could help so 
many people. Record your observations with IBIS. </b></p> -->
    </div>
</section>
<section class="team px-5 py-2">
<div class="container-fluid">
<div class="col-md-12">
<div class="row">
<div class="card-body"><h4 class="card-title dataColl">Checklists & Observations</h4></div>
<?php foreach ($checklistD as $key => $value) { ?>
  <div class="col-sm-3 p-2">
    <div class="card">
      <div class="card-body">
        <a href="<?= site_url('observations/ViewObjservation/'.$value->checklist_id);?>" target="_blank();"><h5 class="card-title"><?= ucfirst($value->checklist_name);?></h5>
        <p class="card-text"><?= $value->description;?></p></a>
        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
      </div>
    </div>
  </div>
  <?php } ?>
<div class="card-body" hidden><h4 class="card-title dataColl">Forum & Blog</h4></div>
  <div class="col-sm-3 p-2" hidden>
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Special title treatment</h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
      </div>
    </div>
  </div>
  <div class="col-sm-3 p-2" hidden>
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Special title treatment</h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
      </div>
    </div>
  </div>
  <div class="col-sm-3 p-2" hidden>
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Special title treatment</h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
      </div>
    </div>
  </div>
  <div class="col-sm-3 p-2" hidden>
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Special title treatment</h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        <!-- <a href="#" class="btn btn-primary" style="text-align: center;">Go somewhere</a> -->
      </div>
    </div>
  </div>  
</div>
</div>
</div>
</section>
<?php $this->load->view('common/footer'); ?>
