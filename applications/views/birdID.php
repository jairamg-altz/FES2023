<?php $this->load->view('common/header'); ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/dataset.css');?>">
<section class="p-0">
    <div class="col-md-12 page-header">
        <h1 class="display-6">BIRD ID</h1>
    </div>
</section>
<section class="team px-5 py-2">
  <div class="row">
    <h1>Images</h1>    
<section class="customer-logos slider">
<div class="slide"><img src="<?= base_url('media/SIZE/mSize.png')?>" id="img" onclick="mSize(this.src);" style="cursor: pointer;">
    <p style="text-align:center;" class="card-body">SIZE</p>
</div>
<div class="slide">
    <img src="<?= base_url('media/APPEARANCE/mAppearance.png')?>" id="img" onclick="mAppearance(this.src);" style="cursor: pointer;">
    <p style="text-align:center;" class="card-body">APPEARANCE</p>
</div> 
<div class="slide">   
    <img src="<?= base_url('media/BILL SHAPE/mBillShape.png')?>" id="img" onclick="mBillShape(this.src);" style="cursor: pointer;">
    <p style="text-align:center;" class="card-body">BILL SHAPE</p>
</div>
<div class="slide">    
    <img src="<?= base_url('media/HEAD PATTERNS/mHeadPatterns.png')?>" id="img" onclick="mHeadPatterns(this.src);" style="cursor: pointer;">
    <p style="text-align:center;" class="card-body">HEAD PATTERNS</p>
</div>
<div class="slide">    
    <img src="<?= base_url('media/EYE PATTERNS/mEyePattern.png')?>" id="img" onclick="mEyePattern(this.src);" style="cursor: pointer;">
    <p style="text-align:center;" class="card-body">EYE PATTERNS</p></div>
    <div class="slide" ><img src="<?= base_url('media/TAIL SHAPE/mTailShape.png')?>" id="img" onclick="mTailShape(this.src);" style="cursor: pointer;">
    <p style="text-align:center;" class="card-body">TAIL SHAPE</p></div>
   <div class="slide"> <img src="<?= base_url('media/WING SHAPE/mWingShape.png')?>" id="img" onclick="mWingShape(this.src);" style="cursor: pointer;">
    <p style="text-align:center;" class="card-body">WING SHAPE</p></div>
   <div class="slide"> 
    <img src="<?= base_url('media/BACK PATTERNS/mBackPattern.png')?>" id="img" onclick="mBackPattern(this.src);" style="cursor: pointer;">
    <p style="text-align:center;" class="card-body">BACK PATTERNS</p></div>
    <div class="slide"><img src="<?= base_url('media/MIGRATORY STATUS/mMigratoryPattern.png')?>" id="img" onclick="mMigratoryPattern(this.src);" style="cursor: pointer;">
    <p style="text-align:center;" class="card-body">MIGRATORY STATUS</p></div>
   <div class="slide"> <img src="<?= base_url('media/HABITAT/mHabitat.png')?>" id="img" onclick="mHabitat(this.src);" style="cursor: pointer;">
    <p style="text-align:center;" class="card-body">HABITAT</p>
</div>
    <div class="slide"><img src="<?= base_url('media/COLOR/mColor.png')?>" id="img" onclick="mColor(this.src);" style="cursor: pointer;">
<p style="text-align:center;" class="card-body">COLOR</p></div>

</section> 
 </div>
 </section> 
 <section class="team px-5 py-2">
<div class="container-fluid">
 <div class="card-body" id="sizesD" style="display: none;">
 <div class="row">
<div class="text-center" id="ApsizeData">
  <h4 style="background-color: #8B2323;color: white;">Size</h4>
</div>    
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/SIZE/subSIZE/miLarge.png')?>" alt="..." class="img-thumbnail" onclick="imageSData('Small');" style="cursor: pointer;">
     <p>Small (6-30 cm)</p>
  </div>
 </div> 
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/SIZE/subSIZE/miMedium.png')?>" alt="..." class="img-thumbnail" onclick="imageSData('Medium');" style="cursor: pointer;">
     <p>Medium (30 - 50 cm)</p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/SIZE/subSIZE/miLarge.png')?>" alt="..." class="img-thumbnail" onclick="imageSData('Large');" style="cursor: pointer;">
     <p>Large (>50 cm)</p>
  </div>
 </div>     
 </div>    
 </div> 
 <div class="card-body col-md-12" id="APPEARANCED" style="display: none;">
 <div class="row">
<div class="text-center">
  <h4 style="background-color: #8B2323;color: white;">APPEARANCE</h4>
</div>
<div class="col-md-12">
<div class="row">  
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/APPEARANCE/subApperance/miBeeEater.png')?>" alt="..." class="img-thumbnail" onclick="imageAData('Bee-eater Like');" style="cursor: pointer;">
     <p>Bee-eater like </p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/APPEARANCE/subApperance/miCrow.png')?>" alt="..." class="img-thumbnail" onclick="imageAData('Crow Like');" style="cursor: pointer;">
     <p>Crow like</p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/APPEARANCE/subApperance/miCuckoo.png')?>" alt="..." class="img-thumbnail" onclick="imageAData('Cuckoo Like');" style="cursor: pointer;">
     <p>Cuckoo like</p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/APPEARANCE/subApperance/miDuck.png')?>" alt="..." class="img-thumbnail" onclick="imageAData('Duck Like');" style="cursor: pointer;">
     <p>Duck like</p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/APPEARANCE/subApperance/miGull.png')?>" alt="..." class="img-thumbnail" onclick="imageAData('Gull Like');" style="cursor: pointer;">
     <p>Gull like </p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/APPEARANCE/subApperance/miHawk.png')?>" alt="..." class="img-thumbnail" onclick="imageAData('Hawk Like');" style="cursor: pointer;">
     <p>Hawk like </p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/APPEARANCE/subApperance/miHornbill.png')?>" alt="..." class="img-thumbnail" onclick="imageAData('Hornbill Like');" style="cursor: pointer;">
     <p>Hornbill like </p>
  </div>
 </div>
  <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/APPEARANCE/subApperance/miKingfisher.png')?>" alt="..." class="img-thumbnail" onclick="imageAData('Kingfisher Like');" style="cursor: pointer;">
     <p>Kingfisher like </p>
  </div>
 </div>
 </div>
</div>
<div class="col-md-12">
<div class="row">
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/APPEARANCE/subApperance/miLonglegs.png')?>" alt="..." class="img-thumbnail" onclick="imageAData('Long Legged Like');" style="cursor: pointer;">
     <p>Long Legged like </p>
  </div>
 </div>
  <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/APPEARANCE/subApperance/miMyna.png')?>" alt="..." class="img-thumbnail" onclick="imageAData('Myna Like');" style="cursor: pointer;">
     <p>Myna like </p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/APPEARANCE/subApperance/miNightjar.png')?>" alt="..." class="img-thumbnail" onclick="imageAData('Nightjar Like');" style="cursor: pointer;">
     <p>Nightjar like </p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/APPEARANCE/subApperance/miOwl.png')?>" alt="..." class="img-thumbnail" onclick="imageAData('Owl Like');" style="cursor: pointer;">
     <p>Owl like </p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/APPEARANCE/subApperance/miParrot.png')?>" alt="..." class="img-thumbnail" onclick="imageAData('Parrot Like');" style="cursor: pointer;">
     <p>Parrot like </p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/APPEARANCE/subApperance/miPheasant.png')?>" alt="..." class="img-thumbnail" onclick="imageAData('Pheasant Like');" style="cursor: pointer;">
     <p>Pheasant like </p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/APPEARANCE/subApperance/miPigeon.png')?>" alt="..." class="img-thumbnail" onclick="imageAData('Pigeon Like');" style="cursor: pointer;">
     <p>Pigeon like </p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/APPEARANCE/subApperance/miPitta.png')?>" alt="..." class="img-thumbnail" onclick="imageAData('Pitta Like');" style="cursor: pointer;">
     <p>Pitta like </p>
  </div>
 </div>
</div>
</div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/APPEARANCE/subApperance/miHeron.png')?>" alt="..." class="img-thumbnail" onclick="imageAData('Pond heron Like');" style="cursor: pointer;">
     <p>Pond heron like </p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/APPEARANCE/subApperance/miQuail.png')?>" alt="..." class="img-thumbnail" onclick="imageAData('Quail Like');" style="cursor: pointer;">
     <p>Quail like </p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/APPEARANCE/subApperance/miSandpiper.png')?>" alt="..." class="img-thumbnail" onclick="imageAData('Sandpiper Like');" style="cursor: pointer;">
     <p>Sandpiper Like </p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/APPEARANCE/subApperance/miSparrow.png')?>" alt="..." class="img-thumbnail" onclick="imageAData('Sparrow Like');" style="cursor: pointer;">
     <p>Sparrow Like </p>
  </div>
 </div> 
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/APPEARANCE/subApperance/miSunbird.png')?>" alt="..." class="img-thumbnail" onclick="imageAData('Sunbird Like');" style="cursor: pointer;">
     <p>Sunbird like </p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/APPEARANCE/subApperance/miSwallow.png')?>" alt="..." class="img-thumbnail" onclick="imageAData('Swallow Like');" style="cursor: pointer;">
     <p>Swallow like </p>
  </div>
 </div> 
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/APPEARANCE/subApperance/miWaterhen.png')?>" alt="..." class="img-thumbnail" onclick="imageAData('Waterhen Like');" style="cursor: pointer;">
     <p>Waterhen like  </p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/APPEARANCE/subApperance/miWoodpecker.png')?>" alt="..." class="img-thumbnail" onclick="imageAData('Woodpecker Like');" style="cursor: pointer;">
     <p>Woodpecker like  </p>
  </div>
 </div>    
 </div>    
 </div>
 <div class="card-body" id="BILLD" style="display: none;">
 <div class="row">
<div class="text-center">
  <h4 style="background-color: #8B2323;color: white;">BILL SHAPE</h4>
</div>    
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/BILL SHAPE/subbilShap/miDagger.png')?>" alt="..." class="img-thumbnail" onclick="imageBData('Dagger Bill');" style="cursor: pointer;">
     <p>Dagger Bill </p>
  </div>
 </div> 
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/BILL SHAPE/subbilShap/miConeBill.png')?>" alt="..." class="img-thumbnail" onclick="imageBData('Cone Bill');" style="cursor: pointer;">
     <p>Cone Bill </p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/BILL SHAPE/subbilShap/miCrossBill.png')?>" alt="..." class="img-thumbnail" onclick="imageBData('Cross Bill');" style="cursor: pointer;">
     <p>Cross Bill </p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/BILL SHAPE/subbilShap/miCurvedBill.png')?>" alt="..." class="img-thumbnail" onclick="imageBData('Curved Bill');" style="cursor: pointer;">
     <p>Curved Bill </p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/BILL SHAPE/subbilShap/miFruitBill.png')?>" alt="..." class="img-thumbnail" onclick="imageBData('Fruit Bill');" style="cursor: pointer;">
     <p>Fruit Bill </p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/BILL SHAPE/subbilShap/miDipNetting.png')?>" alt="..." class="img-thumbnail" onclick="imageBData('Dip Netting');" style="cursor: pointer;">
     <p>Dip Netting </p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/BILL SHAPE/subbilShap/miHooked.png')?>" alt="..." class="img-thumbnail" onclick="imageBData('Hooked Bill');" style="cursor: pointer;">
     <p>Hooked Bill </p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/BILL SHAPE/subbilShap/miSpatulateBill.png')?>" alt="..." class="img-thumbnail" onclick="imageBData('Spatulate Bill');" style="cursor: pointer;">
     <p>Spatulate Bill </p>
  </div>
 </div>     
 </div>    
 </div>  
</div>
</section>

<div class="card-body" id="HEADD" style="display:none;">
 <div class="row">
<div class="text-center">
  <h4 style="background-color: #8B2323;color: white;">HEAD PATTERNS</h4>
</div>    
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/HEAD PATTERNS/SubHead/miPlain.png')?>" alt="..." class="img-thumbnail" onclick="imageHData('Plain');" style="cursor: pointer;">
     <p>Plain  </p>
  </div>
 </div> 
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/HEAD PATTERNS/SubHead/miSpotted.png')?>" alt="..." class="img-thumbnail" onclick="imageHData('Spotted');" style="cursor: pointer;">
     <p>Spotted  </p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/HEAD PATTERNS/SubHead/miCrested.png')?>" alt="..." class="img-thumbnail" onclick="imageHData('Crested or Plumed');" style="cursor: pointer;">
     <p>Crested or Plumed  </p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/HEAD PATTERNS/SubHead/miMalar.png')?>" alt="..." class="img-thumbnail" onclick="imageHData('Malar or Malar Stripe');" style="cursor: pointer;">
     <p>Malar or Malar Stripe  </p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/HEAD PATTERNS/SubHead/miStreaked.png')?>" alt="..." class="img-thumbnail" onclick="imageHData('Streaked');" style="cursor: pointer;">
     <p>Streaked  </p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/HEAD PATTERNS/SubHead/miStriped.png')?>" alt="..." class="img-thumbnail" onclick="imageHData('Banded');" style="cursor: pointer;">
     <p>Banded  </p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/HEAD PATTERNS/SubHead/miCapped.png')?>" alt="..." class="img-thumbnail" onclick="imageHData('Capped');" style="cursor: pointer;">
     <p>Capped  </p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/HEAD PATTERNS/SubHead/miUniquePattern.png')?>" alt="..." class="img-thumbnail" onclick="imageHData('Unique Patterns');" style="cursor: pointer;">
     <p>Unique Patterns  </p>
  </div>
 </div>     
 </div>    
 </div>
<div class="card-body" id="EYED" style="display:none;">
 <div class="row">
<div class="text-center">
  <h4 style="background-color: #8B2323;color: white;">EYE PATTERNS</h4>
</div>    
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/EYE PATTERNS/SUBEYE/miPlain.png')?>" alt="..." class="img-thumbnail" onclick="imageEData('Plain');" style="cursor: pointer;">
     <p>Plain  </p>
  </div>
 </div> 
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/EYE PATTERNS/SUBEYE/miEyeRing.png')?>" alt="..." class="img-thumbnail" onclick="imageEData('Eyering');" style="cursor: pointer;">
     <p>Eyering </p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/EYE PATTERNS/SUBEYE/miEyeLine.png')?>" alt="..." class="img-thumbnail" onclick="imageEData('Eyeline');" style="cursor: pointer;">
     <p>Eyeline   </p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/EYE PATTERNS/SUBEYE/miMasked.png')?>" alt="..." class="img-thumbnail" onclick="imageEData('Masked');" style="cursor: pointer;">
     <p>Masked </p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/EYE PATTERNS/SUBEYE/miEyebrow.png')?>" alt="..." class="img-thumbnail" onclick="imageEData('Eyebrows');" style="cursor: pointer;">
     <p>Eyebrows   </p>
  </div>
 </div>
  </div>    
 </div>
<div class="card-body" id="WINGD" style="display:none;">
 <div class="row">
<div class="text-center">
  <h4 style="background-color: #8B2323;color: white;">WING SHAPE</h4>
</div>    
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/WING SHAPE/Subwing/miBroadWings.png')?>" alt="..." class="img-thumbnail" onclick="imageWData('Broad Wings');" style="cursor: pointer;">
     <p>Broad Wings  </p>
  </div>
 </div> 
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/WING SHAPE/Subwing/miLongWings.png')?>" alt="..." class="img-thumbnail" onclick="imageWData('Long Wings');" style="cursor: pointer;">
     <p>Long Wings  </p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/WING SHAPE/Subwing/miPointedWings.png')?>" alt="..." class="img-thumbnail" onclick="imageWData('Pointed Wings');" style="cursor: pointer;">
     <p>Pointed Wings    </p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/WING SHAPE/Subwing/miRoundedWings.png')?>" alt="..." class="img-thumbnail" onclick="imageWData('Rounded Wings');" style="cursor: pointer;">
     <p>Rounded Wings   </p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/WING SHAPE/Subwing/miTaperedWings.png')?>" alt="..." class="img-thumbnail" onclick="imageWData('Tapered Wings');" style="cursor: pointer;">
     <p>Tapered Wings   </p>
  </div>
 </div>
  </div>    
 </div>
 <div class="card-body" id="TAILD" style="display:none;">
 <div class="row">
<div class="text-center">
  <h4 style="background-color: #8B2323;color: white;">TAIL SHAPE</h4>
</div>    
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/TAIL SHAPE/SubTEL/miFan.png')?>" alt="..." class="img-thumbnail" onclick="imageTData('Fan Shaped Tail');" style="cursor: pointer;">
     <p>Fan Shaped Tail   </p>
  </div>
 </div> 
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/TAIL SHAPE/SubTEL/miForked.png')?>" alt="..." class="img-thumbnail" onclick="imageTData('Forked Tail');" style="cursor: pointer;">
     <p>Forked Tail  </p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/TAIL SHAPE/SubTEL/miPointed.png')?>" alt="..." class="img-thumbnail" onclick="imageTData('Pointed Tail');" style="cursor: pointer;">
     <p>Pointed Tail    </p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/TAIL SHAPE/SubTEL/miNotched.png')?>" alt="..." class="img-thumbnail" onclick="imageTData('Notched Tail');" style="cursor: pointer;">
     <p>Notched Tail  </p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/TAIL SHAPE/SubTEL/miTailAbsent.png')?>" alt="..." class="img-thumbnail" onclick="imageTData('Absent Or Not Prominent Tail');" style="cursor: pointer;">
     <p>Absent or Not Prominent Tail    </p>
  </div>
 </div>
  </div>    
 </div>
 <div class="card-body" id="BACKLD" style="display:none;">
 <div class="row">
<div class="text-center">
  <h4 style="background-color: #8B2323;color: white;">BACK PATTERNS</h4>
</div>    
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/BACK PATTERNS/subBack/miBarredBack.png')?>" alt="..." class="img-thumbnail" onclick="imageBPData('Barred Or Banded');" style="cursor: pointer;">
     <p>Barred or banded </p>
  </div>
 </div> 
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/BACK PATTERNS/subBack/miScaledBack.png')?>" alt="..." class="img-thumbnail" onclick="imageBPData('Scaled Or Scalloped');" style="cursor: pointer;">
     <p>Scaled or Scalloped   </p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/BACK PATTERNS/subBack/miSpottedBack.png')?>" alt="..." class="img-thumbnail" onclick="imageBPData('Spotted Or Speckled');" style="cursor: pointer;">
     <p>Spotted or speckled </p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/BACK PATTERNS/subBack/miMottledBack.png')?>" alt="..." class="img-thumbnail" onclick="imageBPData('Mottled');" style="cursor: pointer;">
     <p>Mottled </p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/BACK PATTERNS/subBack/miSolidBack.png')?>" alt="..." class="img-thumbnail" onclick="imageBPData('Solid');" style="cursor: pointer;">
     <p>Solid </p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/BACK PATTERNS/subBack/miStripedBack.png')?>" alt="..." class="img-thumbnail" onclick="imageBPData('Striped Or Streaked');" style="cursor: pointer;">
     <p>Striped or streaked  </p>
  </div>
 </div>
  </div>    
 </div>
 <div class="card-body" id="MIGRATORYD" style="display:none;">
 <div class="row">
<div class="text-center">
  <h4 style="background-color: #8B2323;color: white;">MIGRATORY STATUS</h4>
</div>    
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/MIGRATORY STATUS/subPattern/miFixed.png')?>" alt="..." class="img-thumbnail" onclick="imageMSData('Resident');" style="cursor: pointer;">
     <p>Resident </p>
  </div>
 </div> 
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/MIGRATORY STATUS/subPattern/miMigratory.png')?>" alt="..." class="img-thumbnail" onclick="imageMSData('Migratory');" style="cursor: pointer;">
     <p>Migratory </p>
  </div>
 </div>
 
  </div>    
 </div>
 <div class="card-body" id="HABITATLD" style="display:none;">
 <div class="row">
<div class="text-center">
  <h4 style="background-color: #8B2323;color: white;">HABITAT</h4>
</div>    
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/HABITAT/sbHabitat/miCoast.png')?>" alt="..." class="img-thumbnail" onclick="imageHBBData('Pelagic Or Coasts');" style="cursor: pointer;">
     <p>Pelagic Or Coasts </p>
  </div>
 </div> 
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/HABITAT/sbHabitat/miHillsMountains.png')?>" alt="..." class="img-thumbnail" onclick="imageHBBData('Mountains Or Hills');" style="cursor: pointer;">
     <p>Mountains Or Hills </p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/HABITAT/sbHabitat/miEvergreen.png')?>" alt="..." class="img-thumbnail" onclick="imageHBBData('Evergreen Forest');" style="cursor: pointer;">
     <p>Evergreen Forest </p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/HABITAT/sbHabitat/miConifer.png')?>" alt="..." class="img-thumbnail" onclick="imageHBBData('Conifer Forest');" style="cursor: pointer;">
     <p>Conifer Forest  </p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/HABITAT/sbHabitat/miGrassland.png')?>" alt="..." class="img-thumbnail" onclick="imageHBBData('Grassland');" style="cursor: pointer;">
     <p>Grassland  </p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/HABITAT/sbHabitat/miScrubland.png')?>" alt="..." class="img-thumbnail" onclick="imageHBBData('Scrubland');" style="cursor: pointer;">
     <p>Scrubland </p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/HABITAT/sbHabitat/miFarmland.png')?>" alt="..." class="img-thumbnail" onclick="imageHBBData('Farmland');" style="cursor: pointer;">
     <p>Farmland </p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/HABITAT/sbHabitat/miWaterBodies.png')?>" alt="..." class="img-thumbnail" onclick="imageHBBData('Water Bodies');" style="cursor: pointer;">
     <p>Water Bodies </p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/HABITAT/sbHabitat/miOpenForest.png')?>" alt="..." class="img-thumbnail" onclick="imageHBBData('Open Forest');" style="cursor: pointer;">
     <p>Open Forest </p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/HABITAT/sbHabitat/miHumanAreas.png')?>" alt="..." class="img-thumbnail" onclick="imageHBBData('Human Areas');" style="cursor: pointer;">
     <p>Human Areas </p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/HABITAT/sbHabitat/miDesert.png')?>" alt="..." class="img-thumbnail" onclick="imageHBBData('Desert');" style="cursor: pointer;">
     <p>Desert </p>
  </div>
 </div>
 <div class="col">
  <div class="text-center">  
     <img src="<?= base_url('media/HABITAT/sbHabitat/miCavesCliffs.png')?>" alt="..." class="img-thumbnail" onclick="imageHBBData('Caves Or Cliffs');" style="cursor: pointer;">
     <p>Caves Or Cliffs  </p>
  </div>
 </div>
  </div>    
 </div>
 <div class="card-body" id="COLORD" style="display:none;">
 <div class="row">
<div class="text-center">
  <h4 style="background-color: #8B2323;color: white;">COLOR</h4>
  <h6>Select a color and apply it to the respective part of body of the bird you need to identify

</h6>
</div>  

 <div class="col">
    <p style="padding-left: 20px;"><img src="<?= base_url('media/COLOR/CPP/black.png')?>" alt="..." class="img-thumbnail" onclick="ImgsetColor('Black');">
   </p> 
  <div class="text-center" hidden>
   <img src="<?= base_url('media/COLOR/Sub/colorPrimary.png')?>" alt="..." class="img-thumbnail" >
     <p></p>
  </div>
 </div> 
 <div class="col">
   <p><img src="<?= base_url('media/COLOR/CPP/white.png')?>" alt="..." class="img-thumbnail" onclick="ImgsetColor('White');" style="cursor: pointer;"></p>
   <div class="imgsetCC"></div>
  <div class="text-center"> 
  <img src="<?= base_url('media/COLOR/Sub/colorPrimary.png')?>" alt="..." class="img-thumbnail" onclick="ImggetcolorData('primary_color');" style="cursor: pointer;">
     <p>PRIMARY COLOR </p> 
     
  </div>
 </div>
 <div class="col">
   <p><img src="<?= base_url('media/COLOR/CPP/blue.png')?>" alt="..." class="img-thumbnail" onclick="ImgsetColor('Blue');" style="cursor: pointer;"></p>
   <div class="imgsetCC"></div>
  <div class="text-center"> 
  <img src="<?= base_url('media/COLOR/Sub/colorUnderparts.png')?>" alt="..." class="img-thumbnail" onclick="ImggetcolorData('underparts_color');" style="cursor: pointer;">
     <p>UNDERPARTS COLOR </p> 
    
  </div>
 </div>
 <div class="col">
   <p><img src="<?= base_url('media/COLOR/CPP/gray.png')?>" alt="..." class="img-thumbnail" onclick="ImgsetColor('Gray');" style="cursor: pointer;"></p>
   <div class="imgsetCC"></div>
  <div class="text-center"> 
   <img src="<?= base_url('media/COLOR/Sub/colorUpperparts.png')?>" alt="..." class="img-thumbnail" onclick="ImggetcolorData('upperparts_color');" style="cursor: pointer;">
     <p>UPPERPARTS COLOR</p> 
     
  </div>
 </div>
 <div class="col">
   <p><img src="<?= base_url('media/COLOR/CPP/brown.png')?>" alt="..." class="img-thumbnail" onclick="ImgsetColor('Brown');" style="cursor: pointer;"></p>
   <div class="imgsetCC"></div>
  <div class="text-center">
  <img src="<?= base_url('media/COLOR/Sub/colorThroat.png')?>" alt="..." class="img-thumbnail" onclick="ImggetcolorData('throat_color');" style="cursor: pointer;">
     <p>THROAT COLOR </p>  
     
  </div>
 </div>
 <div class="col">
   <p><img src="<?= base_url('media/COLOR/CPP/green.png')?>" alt="..." class="img-thumbnail" onclick="ImgsetColor('Green');" style="cursor: pointer;"></p>
   <div class="imgsetCC"></div>
  <div class="text-center">
  <img src="<?= base_url('media/COLOR/Sub/colorCrown.png')?>" alt="..." class="img-thumbnail" onclick="ImggetcolorData('crown_color');" style="cursor: pointer;">
     <p>CROWN COLOR </p>  
    
  </div>
 </div>
 <div class="col">
   <p><img src="<?= base_url('media/COLOR/CPP/orange.png')?>" alt="..." class="img-thumbnail" onclick="ImgsetColor('Orange');" style="cursor: pointer;"></p>
   <div class="imgsetCC"></div>
  <div class="text-center"> 
   <img src="<?= base_url('media/COLOR/Sub/colorForehead.png')?>" alt="..." class="img-thumbnail" onclick="ImggetcolorData('forehead_color');" style="cursor: pointer;"><p>FOREHEAD COLOR</p>     
  </div>
 </div>
 <div class="col">
   <p><img src="<?= base_url('media/COLOR/CPP/pink.png')?>" alt="..." class="img-thumbnail" onclick="ImgsetColor('Pink');" style="cursor: pointer;"></p>
   <div class="imgsetCC"></div>
  <div class="text-center">  
   <img src="<?= base_url('media/COLOR/Sub/colorNape.png')?>" alt="..." class="img-thumbnail" onclick="ImggetcolorData('nape_color');" style="cursor: pointer;">
     <p>NAPE COLOR</p>
     
  </div>
 </div>
 <div class="col">
   <p><img src="<?= base_url('media/COLOR/CPP/olive.png')?>" alt="..." class="img-thumbnail" onclick="ImgsetColor('Olive');" style="cursor: pointer;"></p>
   <div class="imgsetCC"></div>
  <div class="text-center">  
   <img src="<?= base_url('media/COLOR/Sub/colorLegs.png')?>" alt="..." class="img-thumbnail" onclick="ImggetcolorData('leg_color');" style="cursor: pointer;">
     <p>LEG COLOR</p>
     
  </div>
 </div>
 <div class="col">
   <p><img src="<?= base_url('media/COLOR/CPP/red.png')?>" alt="..." class="img-thumbnail" onclick="ImgsetColor('Red');" style="cursor: pointer;"></p>
   <div class="imgsetCC"></div>
  <div class="text-center"> 
  <img src="<?= base_url('media/COLOR/Sub/colorBill.png')?>" alt="..." class="img-thumbnail" onclick="ImggetcolorData('bill_color');" style="cursor: pointer;">
     <p>BILL COLOR</p> 
     
  </div>
 </div>
 <div class="col">
   <p><img src="<?= base_url('media/COLOR/CPP/purple.png')?>" alt="..." class="img-thumbnail" onclick="ImgsetColor('Purple');" style="cursor: pointer;"></p>
   <div class="text-center" hidden>  
     <img src="<?= base_url('media/COLOR/Sub/colorBill.png')?>" alt="..." class="img-thumbnail">
     <p></p>
  </div>
 </div>
 <div class="col">
   <p><img src="<?= base_url('media/COLOR/CPP/yellow.png')?>" alt="..." class="img-thumbnail" onclick="ImgsetColor('Yellow');" style="cursor: pointer;"></p>
   <div class="text-center" hidden>  
     <img src="<?= base_url('media/COLOR/Sub/colorBill.png')?>" alt="..." class="img-thumbnail">
     <p></p>
  </div>
 </div>
  </div>    
 </div>
</div>
</section>
<section class="team px-5 py-2"><div class="container-fluid col-md-12">
<div class="row">
<div class="col-md-3">
   <div style="padding-top:10px;display: none;" id="CCAlDDatata"><button class="btn" onclick="javascript:removeSelected(0,'Small')" style="background-color:#8B2323;">&nbsp;<span style="font-weight: normal;color: white;text-align: center;">Clear all parameters</span></button></div>
   <div style="padding-top:5px;display: none;" id="secDDatata"></div>
   <!-- <div id="text">SIZE: <span style="font-weight: normal;">Small</span></div> -->
</div>
<div class="col-md-9">
<div class="row" id="resDDDD">

   </div>
</div>
</div>
</div>
</section>
<?php $this->load->view('common/footer'); ?>  
<script type="text/javascript">
function removeSelected() {
     $("#CCAlDDatata").hide();
     $("#secDDatata").hide();
     $("#resDDDD").empty();
   }   
function ImgsetColor(value) {
   //alert(value); return false;
   $(".imgsetCC").empty();
   $(".imgsetCC").append('<input type="hidden" name="cccl" value='+value+' class="imvalcl">');
}
//Color data
function ImggetcolorData(value) {
   var mColorN = $(".imvalcl").val();
   //alert(mColorN); return false;
   var urlD = "<?= site_url('BirdID/imageSCCDDData');?>";
   var datastring = 'column='+value+'&color='+mColorN;
   //alert(datastring); return false;
  $.ajax({
  type: "POST",    
  url: urlD,
  data: datastring,
  //cache: false,
  success: function(returndata){
   //alert(returndata); return false;
    $("#resDDDD").empty();
    $("#resDDDD").append(returndata);
  }
});
}
//
function imageSData(value) {
   //alert(value); return false;
   $("#secDDatata").show();
   $("#secDDatata").empty();
  $("#secDDatata").append('<button class="btn" title="Remove" class="removeBtn" onclick="javascript:removeSelected()" style="background-color:#aaa;"><img src="https://avis.indianbiodiversity.org/BirdID/images/removeBtn.png">&nbsp;SIZE: <span style="font-weight: normal;">'+value+'</span></button>');
   $("#CCAlDDatata").hide();
   $("#CCAlDDatata").show();
   var urlD = "<?= site_url('BirdID/imageSData');?>";
   var datastring = 'size='+value;
  $.ajax({
  type: "POST",    
  url: urlD,
  data: datastring,
  //cache: false,
  success: function(returndata){
  // alert(returndata); return false;
    $("#resDDDD").empty();
    $("#resDDDD").append(returndata);
  }
});
}
//Appearence
function imageAData(value) {
   $("#secDDatata").show();
   $("#secDDatata").empty();
  $("#secDDatata").append('<button class="btn" title="Remove" class="removeBtn" onclick="javascript:removeSelected()" style="background-color:#aaa;"><img src="https://avis.indianbiodiversity.org/BirdID/images/removeBtn.png">&nbsp;SIZE: <span style="font-weight: normal;">'+value+'</span></button>');
  $("#CCAlDDatata").hide();
   $("#CCAlDDatata").show();
   var urlD = "<?= site_url('BirdID/imageAData');?>";
   var datastring = 'appearance='+value;
  $.ajax({
  type: "POST",    
  url: urlD,
  data: datastring,
  //cache: false,
  success: function(returndata){
  // alert(returndata); return false;
    $("#resDDDD").empty();
    $("#resDDDD").append(returndata);
  }
});
}
//////////////
//BILL SHAPE
function imageBData(value) {
  $("#secDDatata").show();
   $("#secDDatata").empty();
  $("#secDDatata").append('<button class="btn" title="Remove" class="removeBtn" onclick="javascript:removeSelected()" style="background-color:#aaa;"><img src="https://avis.indianbiodiversity.org/BirdID/images/removeBtn.png">&nbsp;SIZE: <span style="font-weight: normal;">'+value+'</span></button>');
  $("#CCAlDDatata").hide();
  $("#CCAlDDatata").show();
   var urlD = "<?= site_url('BirdID/imageBData');?>";
   var datastring = 'bill_shape='+value;
  $.ajax({
  type: "POST",    
  url: urlD,
  data: datastring,
  //cache: false,
  success: function(returndata){
  // alert(returndata); return false;
    $("#resDDDD").empty();
    $("#resDDDD").append(returndata);
  }
});
}
//////////////
//HEAD PATTERN
function imageHData(value) {
   $("#secDDatata").show();
   $("#secDDatata").empty();
  $("#secDDatata").append('<button class="btn" title="Remove" class="removeBtn" onclick="javascript:removeSelected()" style="background-color:#aaa;"><img src="https://avis.indianbiodiversity.org/BirdID/images/removeBtn.png">&nbsp;SIZE: <span style="font-weight: normal;">'+value+'</span></button>');
   $("#CCAlDDatata").hide();
  $("#CCAlDDatata").show();
   var urlD = "<?= site_url('BirdID/imageHData');?>";
   var datastring = 'head_patterns='+value;
  $.ajax({
  type: "POST",    
  url: urlD,
  data: datastring,
  //cache: false,
  success: function(returndata){
  // alert(returndata); return false;
    $("#resDDDD").empty();
    $("#resDDDD").append(returndata);
  }
});
}
//////
//EYE PATTERN
function imageEData(value) {
   $("#secDDatata").show();
   $("#secDDatata").empty();
  $("#secDDatata").append('<button class="btn" title="Remove" class="removeBtn" onclick="javascript:removeSelected()" style="background-color:#aaa;"><img src="https://avis.indianbiodiversity.org/BirdID/images/removeBtn.png">&nbsp;SIZE: <span style="font-weight: normal;">'+value+'</span></button>');
   $("#CCAlDDatata").hide();
  $("#CCAlDDatata").show();
   var urlD = "<?= site_url('BirdID/imageEData');?>";
   var datastring = 'eye_patterns='+value;
  $.ajax({
  type: "POST",    
  url: urlD,
  data: datastring,
  //cache: false,
  success: function(returndata){
  // alert(returndata); return false;
    $("#resDDDD").empty();
    $("#resDDDD").append(returndata);
  }
});
}
///////////
//WING SHAPE
function imageWData(value) {
  $("#secDDatata").show();
  $("#secDDatata").empty();
  $("#secDDatata").append('<button class="btn" title="Remove" class="removeBtn" onclick="javascript:removeSelected()" style="background-color:#aaa;"><img src="https://avis.indianbiodiversity.org/BirdID/images/removeBtn.png">&nbsp;SIZE: <span style="font-weight: normal;">'+value+'</span></button>');
  $("#CCAlDDatata").hide();
  $("#CCAlDDatata").show();
   var urlD = "<?= site_url('BirdID/imageWData');?>";
   var datastring = 'wing_shape='+value;
  $.ajax({
  type: "POST",    
  url: urlD,
  data: datastring,
  //cache: false,
  success: function(returndata){
  // alert(returndata); return false;
    $("#resDDDD").empty();
    $("#resDDDD").append(returndata);
  }
});
}
///////////
//TAIL SHAPE
function imageTData(value) {
   $("#secDDatata").show();
   $("#secDDatata").empty();
  $("#secDDatata").append('<button class="btn" title="Remove" class="removeBtn" onclick="javascript:removeSelected()" style="background-color:#aaa;"><img src="https://avis.indianbiodiversity.org/BirdID/images/removeBtn.png">&nbsp;SIZE: <span style="font-weight: normal;">'+value+'</span></button>');
  $("#CCAlDDatata").hide();
  $("#CCAlDDatata").show();
   var urlD = "<?= site_url('BirdID/imageTData');?>";
   var datastring = 'tail_shape='+value;
  $.ajax({
  type: "POST",    
  url: urlD,
  data: datastring,
  //cache: false,
  success: function(returndata){
  // alert(returndata); return false;
    $("#resDDDD").empty();
    $("#resDDDD").append(returndata);
  }
});
}
///////////
//BACK PATTERN
function imageBPData(value) {
   $("#secDDatata").show();
   $("#secDDatata").empty();
  $("#secDDatata").append('<button class="btn" title="Remove" class="removeBtn" onclick="javascript:removeSelected()" style="background-color:#aaa;"><img src="https://avis.indianbiodiversity.org/BirdID/images/removeBtn.png">&nbsp;SIZE: <span style="font-weight: normal;">'+value+'</span></button>');
  $("#CCAlDDatata").hide();
  $("#CCAlDDatata").show();
  var urlD = "<?= site_url('BirdID/imageBPData');?>";
  var datastring = 'back_patterns='+value;
  $.ajax({
  type: "POST",    
  url: urlD,
  data: datastring,
  //cache: false,
  success: function(returndata){
  // alert(returndata); return false;
    $("#resDDDD").empty();
    $("#resDDDD").append(returndata);
  }
});
}
///////////
//MS
function imageMSData(value) {
  $("#secDDatata").show();
   $("#secDDatata").empty();
  $("#secDDatata").append('<button class="btn" title="Remove" class="removeBtn" onclick="javascript:removeSelected()" style="background-color:#aaa;"><img src="https://avis.indianbiodiversity.org/BirdID/images/removeBtn.png">&nbsp;SIZE: <span style="font-weight: normal;">'+value+'</span></button>');
  $("#CCAlDDatata").hide();
  $("#CCAlDDatata").show();
  var urlD = "<?= site_url('BirdID/imageMSData');?>";
  var datastring = 'migratory_status='+value;
  $.ajax({
  type: "POST",    
  url: urlD,
  data: datastring,
  //cache: false,
  success: function(returndata){
  // alert(returndata); return false;
    $("#resDDDD").empty();
    $("#resDDDD").append(returndata);
  }
});
}
///////////
//HBB
function imageHBBData(value) {
  $("#secDDatata").show();
   $("#secDDatata").empty();
  $("#secDDatata").append('<button class="btn" title="Remove" class="removeBtn" onclick="javascript:removeSelected()" style="background-color:#aaa;"><img src="https://avis.indianbiodiversity.org/BirdID/images/removeBtn.png">&nbsp;SIZE: <span style="font-weight: normal;">'+value+'</span></button>');
  $("#CCAlDDatata").hide();
  $("#CCAlDDatata").show();
  var urlD = "<?= site_url('BirdID/imageHBBData');?>";
  var datastring = 'habitat='+value;
  $.ajax({
  type: "POST",    
  url: urlD,
  data: datastring,
  //cache: false,
  success: function(returndata){
  // alert(returndata); return false;
    $("#resDDDD").empty();
    $("#resDDDD").append(returndata);
  }
});
}
///////////
  function mSize() {
   $("#ApsizeData").append('');
   $("#sizesD").show();
   $("#BILLD").hide();
   $("#APPEARANCED").hide();
   $("#HEADD").hide();
   $("#EYED").hide();
   $("#TAILD").hide();
   $("#WINGD").hide();
   $("#BACKLD").hide();
   $("#MIGRATORYD").hide();
   $("#HABITATLD").hide();
   $("#COLORD").hide();
   //$("#resDDDD").empty();
    } 
  function mAppearance() {
   $("#sizesD").hide();
   $("#BILLD").hide();
   $("#APPEARANCED").show();
   $("#HEADD").hide();
   $("#EYED").hide();
   $("#TAILD").hide();
   $("#WINGD").hide(); 
   $("#BACKLD").hide();
   $("#MIGRATORYD").hide();
   $("#HABITATLD").hide();
   $("#COLORD").hide(); 
   //$("#resDDDD").empty();
  } 
  function mBillShape() {
   $("#sizesD").hide();
   $("#BILLD").show();
   $("#APPEARANCED").hide();
   $("#HEADD").hide();
   $("#EYED").hide();
   $("#TAILD").hide();
   $("#WINGD").hide();
   $("#BACKLD").hide();
   $("#MIGRATORYD").hide();
   $("#HABITATLD").hide();
   $("#COLORD").hide();
   //$("#resDDDD").empty();
  }
  function mHeadPatterns() {
      $("#sizesD").hide();
   $("#BILLD").hide();
   $("#APPEARANCED").hide();
   $("#HEADD").show();
   $("#EYED").hide();
   $("#TAILD").hide();
   $("#WINGD").hide();
   $("#BACKLD").hide();
   $("#MIGRATORYD").hide();
   $("#HABITATLD").hide();
   $("#COLORD").hide();
   //$("#resDDDD").empty();
   } 
   function mEyePattern() {
   $("#sizesD").hide();
   $("#BILLD").hide();
   $("#APPEARANCED").hide();
   $("#HEADD").hide();
   $("#EYED").show();
   $("#TAILD").hide();
   $("#WINGD").hide();
   $("#BACKLD").hide();
   $("#MIGRATORYD").hide();
   $("#HABITATLD").hide();
   $("#COLORD").hide();
   //$("#resDDDD").empty();
   }
   function mTailShape() {
   $("#sizesD").hide();
   $("#BILLD").hide();
   $("#APPEARANCED").hide();
   $("#HEADD").hide();
   $("#EYED").hide();
   $("#TAILD").show();
   $("#WINGD").hide();
   $("#BACKLD").hide();
   $("#MIGRATORYD").hide();
   $("#HABITATLD").hide();
   $("#COLORD").hide();
   //$("#resDDDD").empty();
   }
   function mWingShape() {
      $("#sizesD").hide();
   $("#BILLD").hide();
   $("#APPEARANCED").hide();
   $("#HEADD").hide();
   $("#EYED").hide();
   $("#TAILD").hide();
   $("#WINGD").show();
   $("#BACKLD").hide();
   $("#MIGRATORYD").hide();
   $("#HABITATLD").hide();
   $("#COLORD").hide();
   //$("#resDDDD").empty();
   }
   function mBackPattern() {
      $("#sizesD").hide();
   $("#BILLD").hide();
   $("#APPEARANCED").hide();
   $("#HEADD").hide();
   $("#EYED").hide();
   $("#TAILD").hide();
   $("#WINGD").hide();
   $("#BACKLD").show();
   $("#MIGRATORYD").hide();
   $("#HABITATLD").hide();
   $("#COLORD").hide();
   //$("#resDDDD").empty();
   }
   
   function mMigratoryPattern() {
   $("#sizesD").hide();
   $("#BILLD").hide();
   $("#APPEARANCED").hide();
   $("#HEADD").hide();
   $("#EYED").hide();
   $("#TAILD").hide();
   $("#WINGD").hide();
   $("#BACKLD").hide();
   $("#MIGRATORYD").show();
   $("#HABITATLD").hide();
   $("#COLORD").hide();
   //$("#resDDDD").empty();
   }
   function mHabitat() {
      $("#sizesD").hide();
   $("#BILLD").hide();
   $("#APPEARANCED").hide();
   $("#HEADD").hide();
   $("#EYED").hide();
   $("#TAILD").hide();
   $("#WINGD").hide();
   $("#BACKLD").hide();
   $("#MIGRATORYD").hide();
   $("#HABITATLD").show();
   $("#COLORD").hide();
   //$("#resDDDD").empty();
   }
   function mColor() {
      $("#sizesD").hide();
   $("#BILLD").hide();
   $("#APPEARANCED").hide();
   $("#HEADD").hide();
   $("#EYED").hide();
   $("#TAILD").hide();
   $("#WINGD").hide();
   $("#BACKLD").hide();
   $("#MIGRATORYD").hide();
   $("#HABITATLD").hide();
   $("#COLORD").show();
   //$("#resDDDD").empty();
   }
</script>
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