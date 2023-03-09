<?php $this->load->view('common/header'); ?>
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/data_taxonomy.css">
<script type="text/javascript">
var uploadDataExcelURL = '<?= API_URL?>/Apis/uploadDataExcel';
var uploadZippedImagesURL = '<?= API_URL?>/Apis/uploadZippedImages';
var uploadDataURL = '<?= API_URL?>/Apis/uploadData';
var getUploadedDataSessionsURL = '<?= API_URL?>/Apis/getUploadedDataSessions';
var deleteUploadedDataSessionURL = '<?= API_URL?>/Apis/deleteUploadedDataSession';    
</script>
<div id="overlay">
  <div class="cv-spinner">
    <span class="spinner"></span>
  </div>
</div>
<section class="p-0">
    <div class="col-md-12 page-header">
        <h1 class="display-6">Data upload Taxonomy</h1>
    </div>
</section>
<div class="p-3">
    <div class="row col-md-12">
   <h4>Data Upload Taxonomy</h4>
    </div>
</div>
<input type="hidden" name="userId" value="<?= $_SESSION[SESSION_NAME]['user_uuid'];?>" id="duserId">
<section class="team px-5 py-2">
    <div class="row">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<div class="container">
   <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home"><b>Upload Data</b></a></li>
    <li><a data-toggle="tab" href="#menu1" onclick="getUploadedDataSession()"><b>My Data</b></a></li>
    
</ul>

<div class="tab-content">
    <div id="home" class="tab-pane fade in active">
     <div class="form-group">
            <form id="uploadDataForm" enctype="multipart/form-data" method="POST">
                <input type="file" id="uploadDataFormFileUpload" name="uploadDataFormFileUpload" class="form-control"><br>
            </form>
            <input type="button" value="Upload" onclick="uploadData()" class="btn btn-primary">
        </div>
       
        <div>
            <div class="float-child-left table-responsive">
                <table id="columnsMappingTable" class="table">
                    <thead>
                        <tr>
                            <th>Source</th>
                            <th>Image Column</th>
                            <th>Target Table</th>
                            <th>Target Column</th>
                            <th>Target Column Type</th>
                            <th>Import</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>

            <div id="activityStatus" class="float-child-right form-group" style="float: right;">
                <b>Status</b>
            </div>
        </div>

        <div id="imageUploadDiv" style="display: none;">
            <form id="uploadImageForm" enctype="multipart/form-data" method="POST">
                <input type="file" id="uploadImageFormFileUpload" name="uploadImageFormFileUpload" class="form-control btn btn-success"><br>
                <input id="imageColumnName" type="hidden" name="imageColumnName">
                <input id="importExcelId" type="hidden" name="importExcelId">
                <input id="dataUploadUserId" type="hidden" name="dataUploadUserId">
                <input id="dataUploadColumns" type="hidden" name="dataUploadColumns">
            </form>
        </div>
        
        <div>
            <input type="button" value="Import" onclick="importData()" class="btn btn-success">
            <input type="button" value="Reset" onclick="resetImportDataForm()" class="btn btn-danger">
        </div> 
    </div>
    <div id="menu1" class="tab-pane fade">
    <div class="table-responsive">
            <table id="uploadedDataSessionsTable" class="table">
                <thead>
                    <tr>
                        <th>Upload Id</th>
                        <th>Uploaded Records</th>
                        <th>Uploaded Images</th>
                        <th>Uploaded Time</th>
                        <th>Delete Uploaded Records</th>
                        <th>Citation and Attribution</th>
                    </tr>
                </thead>
        	       <tbody></tbody>
	   </table>
        </div>
    </div>        
  </div>
</div>
</div>
</section>
<div  class="modal" id="exampleModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Citation and Attributation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?= site_url('Profile/DaAction');?>">
            <p id="uploadDataIDD"></p>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Title:<span style="color: red;">*</span></label>
            <input type="text" class="form-control" id="title" name="title" placeholder="title" required>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Sub Title:<span style="color: red;">*</span></label>
            <input type="text" class="form-control" id="title" name="sub_title" placeholder="sub title" required>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Author Name:<span style="color: red;">*</span></label>
            <input type="text" class="form-control" id="author_name" name="author_name" placeholder="author name" required>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Description:<span style="color: red;">*</span></label>
            <textarea class="form-control" id="message-text" name="description" placeholder="description" required></textarea>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">License:<span style="color: red;">*</span></label>
           <select class="form-control" name="data_licenses" required>
           <option value="">Select License</option> 
           <?php foreach($GetLicense as $GetLicenseRows) { ?>
           <option value="<?= $GetLicenseRows->data_license;?>"><?= $GetLicenseRows->data_license;?></option> 
           <?php } ?>   
           </select>   
          </div>
           <div class="form-group">
            <label for="message-text" class="col-form-label">Citation:<span style="color: red;">*</span></label>
            <textarea class="form-control" id="message-text" name="data_citations" placeholder="Citation" required></textarea>
          </div>
           <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
        </form>
      </div>
     
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php $this->load->view('common/footer'); ?>
<script src="<?= base_url(); ?>assets/js/dataTaxonomy.js"></script>
<script type="text/javascript">
function setUploadId(sessionId) {
    $("#uploadDataIDD").append(sessionId);
}  
</script>