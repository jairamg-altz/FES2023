<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/css/a18createprojects.css" />
<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/css/cproject.css" />
<?php $this->load->view('common/header'); ?>
    <div class="container-center-horizontal">
      <form action="<?= site_url('PMS/CprojectAction');?>" method="POST" enctype="multipart/form-data">
      <div class="a18createprojects screen">        
        <div class="rectangle-72Zbby"></div>
        <div class="post-72Zbby">
          <div class="rectangle-CBaX2f"></div>
          <div class="form_long-CBaX2f">        
              <div class="form-group">
              <input type="text" name="title" class="form-control" placeholder="project title" required>  
              </div>
              <div class="form-group" style="margin-top: 15px;">
              <input type="file" name="file_media" class="form-control" required>  
              </div>              
                      </div>

          <div class="form_long-copy-CBaX2f">
            <div class="form-group">
              <textarea name="desc" class="form-control" placeholder="project descroption" rows="4"></textarea>  
              </div> 
          </div>
          <div class="form_long-copy-2-CBaX2f">
            <div class="collaboration-type-AfKjO8 poppins-medium-black-20px">Collaboration Type:</div>
          </div>
          <div class="group-CBaX2f" style="width: 80%;">
            <div class="form-group">
              <input type="radio" name="access" checked class="form-check-input" value="public">Public<span>&nbsp;(Anyone can contribute)</span>
              <input type="radio" name="access" class="form-check-input" value="private">private<span>&nbsp;(Only people you invite can contribute)</span>
            </div>
            </div>
        </div>
        <div class="rectangle-YaWj1u"></div>
        <div class="data-fileds-copy-72Zbby">
          <div class="rectangle-copy-q23Rfh"></div>
          <div class="logo-copy-6-q23Rfh">Additional Fields</div>
        </div>
        <div class="fileds-72Zbby">
          <div class="panel panel-default" style="width: 100%">
  <div class="panel-heading">Add Exta Additional Feilds</div>
  <div class="panel-body" style="width: 100%">  
  <div id="education_fields"></div>
       <div class="col-sm-3">
  <div class="form-group">
    <label class="form-check-label">Attribute Name</label>
    <input type="text" class="form-control" id="Schoolname" name="attribute_name[]"  placeholder="Attribute name" required >
  </div>
</div>
<div class="col-sm-3 nopadding">
  <div class="form-group">
    <label class="form-check-label">Alias Name</label>
    <input type="text" class="form-control" id="Major" name="alias_name[]" placeholder="Alias Name" required>
  </div>
</div>
<div class="col-sm-2 nopadding">
  <div class="form-group">
    <label class="form-check-label">Data Type</label>
    <!-- <input type="text" class="form-control" id="Degree"   placeholder="Data Type" required> -->
    <select class="form-control" name="data_type[]" required>
      <option value="text">Text</option>
      <option value="number">Number</option>
      <option value="boolean">Boolean</option>
    </select>
  </div>
</div>
<div class="col-sm-2 nopadding">
  <div class="form-group">
    <label class="form-check-label">Option</label>
    <input type="text" class="form-control" id="Degree" name="options[]" placeholder="Option">
  </div>
</div>

<div class="col-sm-2 nopadding">
  <div class="form-group">
    <div class="input-group">
      <label class="form-check-label">Is Mandatory</label>
      <!-- <input type="text" class="form-control" id="Degree" name="is_mandatory[]" placeholder="Is Mandatory" required> -->
      <select class="form-control" name="is_mandatory[]" required>
      <option value="Yes">Yes</option>
      <option value="No">No</option>
      </select>
      <div class="input-group-btn">&nbsp;
        <button class="btn btn-success" type="button"  onclick="education_fields();"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> +</button>
      </div>
    </div>
  </div>
</div>
<div class="clear"></div>
  
  </div>
  </div>
        </div>
        <div class="design-a-form-that-y-72Zbby">
          </div>
        <div class="logo-copy-4-72Zbby">Projects Name</div>
        <div class="logo-copy-5-72Zbby">Contribution Form</div>
        <h1 class="title-72Zbby">Create Project</h1>
        <div class="button-72Zbby">
          <div class="group-2-OBuIEx">
            <button type="submit" class="btn btn-success" name="submit">Create</button>
            <a href="<?= site_url('PMS/index');?>"><input type="button" name="" class="btn btn-danger" value="Cancel"></a>
          </div>
        </div>
        <div class="button-copy-72Zbby">
          <div class="group-2-UqUgJP">
            
          </div>
        </div>
      </div>
    </form>
    </div>
<?php $this->load->view('common/footer'); ?>
<script type="text/javascript">
  var room = 1;
function education_fields() {
 
    room++;
    var objTo = document.getElementById('education_fields')
    var divtest = document.createElement("div");
  divtest.setAttribute("class", "form-group removeclass"+room);
  var rdiv = 'removeclass'+room;
    divtest.innerHTML = '<div class="col-sm-3 nopadding"><div class="form-group"> <label class="form-check-label">Attribute Name</label><input type="text" class="form-control" id="Schoolname" name="attribute_name[]" placeholder="Attribute name" required></div></div><div class="col-sm-3 nopadding"><div class="form-group"> <label class="form-check-label">Alias Name</label><input type="text" class="form-control" id="Major" name="alias_name[]" placeholder="Alias name" required></div></div><div class="col-sm-2 nopadding"><div class="form-group"><label class="form-check-label">Data Type</label><select class="form-control" name="data_type[]" required><option value="text">Text</option><option value="number">Number</option><option value="boolean">Boolean</option></select></div></div><div class="col-sm-2 nopadding"><div class="form-group"> <label class="form-check-label">Option</label><input type="text" class="form-control" id="Degree" name="options[]" placeholder="Option"></div></div><div class="col-sm-2 nopadding"><div class="form-group"><div class="input-group"><label class="form-check-label">Is Mandatory</label><select class="form-control" name="is_mandatory[]" required><option value="Yes">Yes</option><option value="No">No</option></select><div class="input-group-btn">&nbsp; <button class="btn btn-danger" type="button" onclick="remove_education_fields('+ room +');"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> - </button></div></div></div></div><div class="clear"></div>';
    
    objTo.appendChild(divtest)
}
   function remove_education_fields(rid) {
     $('.removeclass'+rid).remove();
   }
</script>