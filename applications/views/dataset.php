<?php $this->load->view('common/header'); ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/dataset.css');?>">
<section class="p-0">
    <div class="col-md-12 page-header">
        <h1 class="display-6">Dataset</h1>
    </div>
</section>
<div class="p-3">
<div class="row" style="padding-top: 10px;">
 <input type="hidden" name="uploadID" id="uploadID" value="<?= $uploadID; ?>">
     <div class="col-md-12 bg-white card" style="background-color: #f3f3f3">
        <div class="card-body">
     <blockquote class="blockquote" style="color:black;">
  <h1 class="mb-0" ><?= $data_title;?></h1>
  <p class="mb-0"><?= $data_subtitle;?></p>
  
</blockquote></div>
        </div>
  <div class="col-md-12">
   <table class="table">
  <thead>
    <tr>      
      <th scope="col">Description</th>
      <th scope="col">Authors</th>
      <th scope="col">Published Date</th>
      <th scope="col">Occurrences</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td style="width: 600px;"><?= $data_description;?></td>
      <td><?= $data_author;?></td>
      <td><?= $created_date;?></td>
      <td><?= $getUploadCount->uploaded_records_count; ?></td>
    </tr>
   
  </tbody>
</table>  
  </div>  
  <div id="overlay">
  <div class="cv-spinner">
    <span class="spinner"></span>
  </div>
</div>
  <div class="card-body">
    <h1>Geographic Scope</h1>
  </div>
<div id="datasetMap" class="z-depth-1-half map-container" style="height: 500px;width: 100%;"></div>  
    </div>
</div>

<section class="team px-5 py-2">
  <div class="row">
    <h1>Images</h1>    
   <?php if(!empty($responseD)) { ?>
  <section class="customer-logos slider">
<?php  foreach ($responseD->data as $key => $value) {?>  
<div class="slide" ><img src="<?= $value->sp_file_uri;?>"
  id="img" onclick="ImagesPreview(this.src);"></div>
  <p></p>
 <?php }  ?>
</section>    
<?php } else { ?>
<section class="team px-5 py-2">
<div class="card" style="width:100%">No Images Found!</div>
</section>
<?php } ?>
   <hr><h1>Major Taxonomic Groups</h1> <hr><div class="row">
  <div class="column">
    <div class="card">
      <h3>CLASS</h3>
      <?php if(!empty($class)) {  $srno=0; foreach ($class as $key => $value) { if($srno < 3) { ?>
      <p><?= ucfirst($value['sp_unique_records']);?></p>
    <?php } $srno++; } } else { ?>
     <p>No Record Found!</p>  
     <?php } ?> 
    </div>
  </div>

  <div class="column">
    <div class="card">
      <h3>ORDER </h3>
      <?php if(!empty($order)) { $srno=0; foreach ($order as $key => $value) {  if($srno < 3) { ?>
      <p><?= ucfirst($value['sp_unique_records']);?></p>
     <?php } $srno++; } } else { ?>
     <p>No Record Found!</p>  
     <?php } ?> 
    </div>
  </div>
  
  <div class="column">
    <div class="card">
      <h3>FAMILY</h3>
      <?php if(!empty($family)) { $srno=0; foreach ($family as $key => $value) { 
if($srno < 3) {
        ?>
      <p><?= ucfirst($value['sp_unique_records']);?></p>
     <?php } $srno++; } } else { ?>
     <p>No Record Found!</p>  
     <?php } ?> 
    </div>
  </div>
  
  <div class="column">
    <div class="card">
      <h3>SCIENTIFIC NAME</h3>
      <?php if(!empty($scientificname)) {  $srno=0; foreach ($scientificname as $key => $value) { 
        if($srno < 3) { ?>
      <p><i><?= ucfirst($value['sp_unique_records']);?></i></p>
    <?php } $srno++; } } 
if (count($scientificname) > 3) { ?>
<p class="btn-primary" style="background-color: black;" type="button" data-bs-toggle="modal" data-bs-target="#SCIENTIFIC">Read more...</p>
  <?php  } elseif(empty($scientificname)) { ?>
     <p>No Record Found!</p>  
     <?php } ?>
    </div>
  </div>
</div>  
    </div>
</section>
<section class="align-center"><div class="col-md-9 row">
</div> </section>
<div class="center" style="background: linear-gradient(135deg, #31B155 0%, #255A9B 100%);background-color:transparent;">
  <a href="<?= site_url('Profile/Btaxonomy/'.$this->uri->segment(3));?>"><p style="text-align: center;color: white;"><b>BROWSE COMPLETE TAXONOMY</b></p></a>
</div>
<section class="team px-5 py-2">
  <div class="row">
      <h1>License</h1>
  </div>
  <p><?= $data_licenses;?></p>  
  <div class="row">
      <h1>Citation</h1>
  </div>
  <p><?= $data_citations;?></p>  
</section>
<?php $this->load->view('common/footer'); ?>  
<script type="text/javascript" src="<?= base_url('assets/js/dataset.js');?>"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('.customer-logos').slick({
    slidesToShow: 5,
    slidesToScroll: 1,
    autoplay: false,
    autoplaySpeed: 1500,
    arrows: true,
    dots: false,
    pauseOnHover: false,
    prevArrow: '<i class="slick-prev fas fa-angle-left"></i>',
    nextArrow: '<i class="slick-next fas fa-angle-right"></i>',
    responsive: [{
      breakpoint: 768,
      settings: {
        slidesToShow: 3
      }
    }, {
      breakpoint: 520,
      settings: {
        slidesToShow: 2
      }
    }]
    });
  });
</script> 
<!-- Modal -->
<div class="modal fade" id="SCIENTIFIC" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">SCIENTIFIC NAME</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="height: 80vh;
    overflow-x: auto;">
        <table class="table table-striped" >
  <thead>
    <tr>
      <th scope="col">SrNo.</th>
      <th scope="col">SCIENTIFIC NAME</th>
    </tr>
  </thead>
  <tbody>
    <?php if(!empty($scientificname)) {  $srno=1; foreach ($scientificname as $key => $value) { ?>
    <tr>
      <th scope="row"><?= $srno;?></th>
      <td><i><?= ucfirst($value['sp_unique_records']);?></i></td>
    </tr>
    <?php $srno++;} }?>
    </tbody>
</table>
      </div>
     </div>
  </div>
</div>

//Image Preview

<div class="modal" tabindex="-1" id="imageModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">SCIENTIFIC IMAGE</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p id="imageAppend"></p>
      </div>
      </div>
  </div>
</div> 
<script type="text/javascript">
  function ImagesPreview(value) {
    $('#imageModal').modal('show');
    $imghtml = '<img src='+value+' class="img-fluid">';
    $('#imageAppend').empty();
    $('#imageAppend').append($imghtml);
  }
</script>