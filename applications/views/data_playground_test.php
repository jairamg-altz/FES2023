<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IBIS</title>
    <meta content="IBIS" name="description">
    <meta content="IBIS" name="keywords">
<link href="<?= base_url(); ?>media/img/favicon.png" rel="icon">
<link href="<?= base_url(); ?>media/img/apple-touch-icon.png" rel="apple-touch-icon">    
<link href="<?= base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url(); ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<link href="<?= base_url(); ?>assets/css/style.css" rel="stylesheet">
<link href="<?= base_url(); ?>assets/css/data-visualization.css" rel="stylesheet">
<link href="<?= base_url(); ?>assets/css/webtour.min.css" rel="stylesheet">

<link rel="stylesheet" href="<?= base_url(); ?>assets/css/ol.css" type="text/css">
<script type="text/javascript">

const getCountriesURL = "<?= API_URL?>/Apis/getCountries";
const getStatesURL = "<?= API_URL?>/Apis/getStates";
const getDistrictsURL = "<?= API_URL?>/Apis/getDistricts";
const getSubDistrictsURL = "<?= API_URL?>/Apis/getSubDistricts";
const getBlocksURL = "<?= API_URL?>/Apis/getBlocks";
const getBoundaryGeometryURL = '<?= API_URL?>/Apis/getBoundaryGeometry';
const getDataPlaygroundDatasetsURL = '<?= API_URL?>/Apis/getDataPlaygroundDatasets';
const dataPlaygroundSearchSpeciesUrl = "<?= API_URL?>/Apis/searchSpeciesBasedOnDatasets";
const dataPlaygroundGetSpeciesObservationDetailsUrl = "<?= API_URL?>/Apis/getSpeciesObservationDetails";
const dataPlaygroundGetSpeciesLocationUrl = "<?= API_URL?>/Apis/getSpeciesLocation";
const dataPlaygroundRunSpatialQuery = "<?= API_URL?>/Apis/runSpatialQuery";
const uploadShapeFileURL = '<?= API_URL?>/Apis/uploadShapeFile';
const uploadGeoJSONURL = '<?= API_URL?>/Apis/uploadGeoJSON';
const uploadKMLURL = '<?= API_URL?>/Apis/uploadKML';
const getSpatialLayers = "<?= API_URL?>/Apis/getSpatialLayers";
const getSpatialLayerColumns = "<?= API_URL?>/Apis/getSpatialLayerColumns";
const getMatchingColumnValuesUrl = "<?= API_URL?>/Apis/getMatchingColumnValues";
const speciesBiomesWMSUrl = "<?= speciesBiomesWMSUrl?>";
const speciesBiomesLayerName = "<?= speciesBiomesLayerName?>";
</script>
</head>
<body>
	<div id="map" style="display: none;" class="map"></div>
	<div id="reportsMap" class="reports-map"></div>
	<div id="popup" class="ol-popup">
    <a href="#" id="popup-closer" class="ol-popup-closer"></a>
    <div id="popup-content"></div>
  </div>
  <div id="popupFan" class="popup-fan-class"></div>
  <div id="guestControlMenuPanel" class="guestControlMenuPanelClass">
    <a href="<?= site_url('dashboard');?>"><div id="home-button" class="button-horizontal-class" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Home"><i class="bi bi-house-fill align-icons"></i></div></a>
    <div id="menu-button" class="button-horizontal-class" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Menu"><i class="bi bi-list align-icons"></i></div>
  </div>
  <div id="guestControlHorizontalPanel" class="guestControlPanelHorizontalClass">
    <div id="social-media-button" class="button-horizontal-class" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Share"><i class="bi bi-share-fill align-icons"></i></div>
    <div id="data-source-button" class="button-horizontal-class" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Data sources"><i class="bi bi-pie-chart align-icons"></i></div>
    <div id="species-search-box" class="textbox-class">
      <input type="text" placeholder="Species" class="input-group-text-override" aria-describedby="basic-addon1" onkeyup="searchSpeciesOnKeyPress(this.value)"></input>
	  <div class="dp-spinner"></div>
      <i class="bi bi-search input-group-icon cursor-pointer" onclick="getSpeciesLocationOnClick()"></i>
    </div>
    <div id="basemaps-button" class="button-horizontal-class" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Basemaps"><i class="bi bi-stack align-icons"></i></div>
    <div id="information-button" class="button-horizontal-class" data-bs-toggle="tooltip" data-bs-placement="left" title="Click to have a guided tour of the Data Playground"><i class="bi bi-info-lg align-icons"></i></div>
  </div>
  
  <div id="guestControlVerticalPanel" class="guestControlPanelVerticalClass">
      <?php if(empty($_SESSION[SESSION_NAME]['user_uuid'])) { //print_r("expression");?>
      <div  class="button-vertical-class" data-bs-toggle="modal" data-bs-target="#loginModalD" data-bs-placement="top" title="Tools"><i class="bi bi-tools align-icons"></i></div>
    <?php } else {?>
  <div id="tools-button" class="button-vertical-class" data-bs-toggle="tooltip" data-bs-placement="top" title="Tools"><i class="bi bi-tools align-icons"></i></div>
<?php }?>
  <div id="upload-button" class="button-vertical-class" data-bs-toggle="tooltip" data-bs-placement="top" title="Data upload"><i class="bi bi-upload align-icons"></i></div>
    <div id="draw-button" class="button-vertical-class" data-bs-toggle="tooltip" data-bs-placement="top" title="Draw"><i class="bi bi-pencil-square align-icons"></i></div>
    <div id="measure-button" class="button-vertical-class" data-bs-toggle="tooltip" data-bs-placement="top" title="Measure"><i class="bi bi-rulers align-icons"></i></div>
  </div>
  <div id="advancedControlVerticalPanel" class="advancedControlPanelVerticalClass">
    <div id="export-button" class="button-vertical-class" data-bs-toggle="tooltip" data-bs-placement="top" title="Export data"><i class="bi bi-arrow-right-square align-icons"></i></div>
    <div id="report-button" class="button-vertical-class" data-bs-toggle="tooltip" data-bs-placement="top" title="Reports"><i class="bi bi-file-text align-icons"></i></div>
    <div id="query-builder-button" class="button-vertical-class" data-bs-toggle="tooltip" data-bs-placement="top" title="Query builder"><i class="bi bi-funnel-fill align-icons"></i></div>
    <!-- <div id="spatial-analyst-button" class="button-vertical-class" data-bs-toggle="tooltip" data-bs-placement="top" title="Spatial analyst"><i class="bi bi-map-fill align-icons"></i></div>
    <div id="sdm-button" class="button-vertical-class" data-bs-toggle="tooltip" data-bs-placement="top" title="SDM tools"><i class="bi bi-box align-icons"></i></div> -->
    <div id="download-button" class="button-vertical-class" data-bs-toggle="tooltip" data-bs-placement="top" title="Download"><i class="bi bi-download align-icons"></i></div>
  </div>

  <div id="leftPanel" class="left-panel-class">
    <!-- <div id="leftPanelTitle" class="left-panel-title-class">      
    </div> -->
    <div id="leftPanelBody">
      <ul class="nav nav-tabs ms-2" id="left-panel-tab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="search-tab" data-bs-toggle="tab" data-bs-target="#search" type="button" role="tab" aria-controls="home" aria-selected="true">Search by location</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="datasets-tab" data-bs-toggle="tab" data-bs-target="#datasets" type="button" role="tab" aria-controls="profile" aria-selected="false">Datasets</button>
        </li>
      </ul>
      <div class="tab-content" id="left-panel-tab-content">
        <div class="tab-pane fade show left-panel-tab-class active" id="search" role="tabpanel" aria-labelledby="search-tab">

          <div class="row mt-2 me-2">
            <div class="col-sm-9 ms-3 text-dp-theme-color">
              <input class="form-check-input" type="checkbox" value="" id="zoomToFeature">
              <label class="form-check-label" for="zoomToFeature">
                Zoom to feature
              </label>
            </div>
          </div>

          <div class="row mt-2 me-2">
            <div class="col-sm-9 input-group-sm">
              <select id="countriesCombo" onchange="loadStates(this.value)" class="form-select panel-components ms-3">
                <option value="">Select Country</option>
              </select>
            </div>
            <div class="col-sm-3">
				<button type="button" class="btn btn-outline-info btn-sm" onclick="showCountryGeometry(this)">
					<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
					<span class="sr-only"></span>
					Show
				</button>
            </div>
          </div>

          <div class="row mt-2 me-2">
            <div class="col-sm-9 input-group-sm">
              <select id="statesCombo" onchange="loadDistricts(this.value)" class="form-select panel-components ms-3">
                <option value="">Select States</option>
              </select>
            </div>
            <div class="col-sm-3">
				<button type="button" class="btn btn-outline-info btn-sm" onclick="showStatesGeometry(this)">
					<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
					<span class="sr-only"></span>
					Show
				</button>
            </div>
          </div>

          <div class="row mt-2 me-2">
            <div class="col-sm-9 input-group-sm">
              <select id="districtsCombo" onchange="loadSubDistricts(this.value); loadBlocks(this.value);" class="form-select panel-components ms-3">
                <option value="">Select Districts</option>
              </select>
            </div>
            <div class="col-sm-3">
				<button type="button" class="btn btn-outline-info btn-sm" onclick="showDistrictsGeometry(this)">
					<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
					<span class="sr-only"></span>
					Show
				</button>
            </div>
          </div>

          <div class="row mt-2 me-2">
            <div class="col-sm-9 input-group-sm">
              <select id="subDistrictsCombo" class="form-select panel-components ms-3">
                <option value="">Select Sub Districts</option>
              </select>
            </div>
            <div class="col-sm-3">
				<button type="button" class="btn btn-outline-info btn-sm" onclick="showSubDistrictsGeometry(this)">
					<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
					<span class="sr-only"></span>
					Show
				</button>
            </div>
          </div>

          <div class="row mt-2 me-2">
            <div class="col-sm-9 input-group-sm">
              <select id="blocksCombo" class="form-select panel-components ms-3">
                <option value="">Select Blocks</option>
              </select>
            </div>
            <div class="col-sm-3">
				<button type="button" class="btn btn-outline-info btn-sm" onclick="showBlocksGeometry(this)">
					<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
					<span class="sr-only"></span>
					Show
				</button>
            </div>
          </div>

          <div class="row mt-2 me-2">
            <div class="col-sm-9">
            </div>
            <div class="col-sm-3">
              <!-- <button type="button" class="btn btn-primary btn-sm" onclick="applyFilter()">Search</button> -->
				<button type="button" class="btn btn-primary btn-sm" onclick="resetAdminBoundaryFilter()">Reset</button>
            </div>
          </div>

          <div id="searchFiltersDialogTitle" class="panel-title-class mt-1 me-2">
            Data Filters
          </div>
          <div class="row mt-2 ms-3 me-2">
            <label class="text-dp-theme-color mb-2">Date Range</label>
            <div class="col-sm-5 input-group-sm">
              <input id="dpFromDate" type="date" class="form-control panel-components" placeholder="From" data-provide="datepicker">
            </div>
            <div class="col-sm-5 input-group-sm">
              <input id="dpToDate" type="date" class="form-control panel-components" placeholder="To" data-provide="datepicker">
            </div>
          </div>

          <div class="row mt-2 ms-3 me-2">
            <label class="text-dp-theme-color mb-2">Data tags</label>
            <div id="dataPlaygroundDataTags"></div>            
          </div>

          <div class="row mt-2 me-2">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-5">
              <button type="button" class="btn btn-primary btn-sm" onclick="applyDatasetFilter()">Apply</button>
              <button type="button" class="btn btn-primary btn-sm" onclick="resetDatasetFilter()">Reset</button>
            </div>
          </div>

        </div>

        <div class="tab-pane fade" id="datasets" role="tabpanel" aria-labelledby="datasets-tab">
          <ul class="nav nav-tabs ms-2" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="raster-tab" data-bs-toggle="tab" data-bs-target="#rasterDatasets" type="button" role="tab" aria-controls="home" aria-selected="true">Raster</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="vector-tab" data-bs-toggle="tab" data-bs-target="#vectorDatasets" type="button" role="tab" aria-controls="profile" aria-selected="false">Vector</button>
            </li>
          </ul>

          <div class="tab-content" style="height: 500px; overflow-y: auto;" id="datasetsTabContent">
            <div class="tab-pane fade show active" id="rasterDatasets" style="width: 381px;" role="tabpanel" aria-labelledby="raster-tab">
            </div>
            <div class="tab-pane fade show" id="vectorDatasets" style="width: 381px;" role="tabpanel" aria-labelledby="vector-tab">
            </div>
          </div>

        </div>
        
      </div>
    </div>
  </div>
  
  <div id="legend" style="position: absolute; left: 425px; top: 150px;"></div>

  <div id="socialMediaPanel" class="social-media-panel-class">
    <div id="socialMediaPanelTray" style="display:none;">
      <div id="shareFacebookButton" class="tray-icon"><i class="bi bi-facebook align-icons social-media-icon-facebook"></i></div>
      <div id="shareTwitterButton" class="tray-icon"><i class="bi bi-twitter align-icons social-media-icon-twitter"></i></div>
      <div id="shareInstagramButton" class="tray-icon"><i class="bi bi-instagram align-icons social-media-icon-instagram"></i></div>
    </div>
  </div>

  <div id="basemapSelectionPanel" class="basemap-panel-class">
    <input type="radio" name="baseLayerRadioButton" class="me-2 cursor-pointer" value="OSMStandard" checked>OSM Standard</input></br>
    <input type="radio" name="baseLayerRadioButton" class="me-2 cursor-pointer" value="OSMHumanitarian">OSM Humanitarian</input></br>
    <input type="radio" name="baseLayerRadioButton" class="me-2 cursor-pointer" value="cartoDBlightAll">Carto DB Light</input></br>
    <input type="radio" name="baseLayerRadioButton" class="me-2 cursor-pointer" value="cartoDBdarkAll">Carto DB Dark</input></br>
    <input type="radio" name="baseLayerRadioButton" class="me-2 cursor-pointer" value="cartoDBVoyager">Carto DB Voyager</input></br>
    <input type="radio" name="baseLayerRadioButton" class="me-2 cursor-pointer" value="StamenTerrain">Stamen Terrain</input></br>
    <input type="radio" name="baseLayerRadioButton" class="me-2 cursor-pointer" value="StamenToner">Stamen Toner</input></br>
	<hr/>
	<div class="col-sm-9 mt-3 text-dp-theme-color">
	  <input class="form-check-input" type="checkbox" value="" id="showRangeMapsCheckbox" onchange="removerangemaps()">
	  <label class="form-check-label" for="showRangeMapsCheckbox">
		Show Rangemaps
	  </label>
	</div>
  </div>

  <div id="drawingToolsPanel" class="drawing-tools-panel-class">
    <div id="drawingToolsPanelTray" style="display:none;">
      <div class="tray-icon"><i class="bi bi-dot align-icons editing-point"></i></div>
      <div class="tray-icon"><i class="bi bi-slash-lg align-icons editing-line"></i></div>
      <div class="tray-icon"><i class="bi bi-record align-icons editing-circle"></i></div>
      <div class="tray-icon"><i class="bi bi-bounding-box-circles align-icons editing-polygon"></i></div>
      <div class="tray-icon"><i class="bi bi-arrow-counterclockwise align-icons editing-undo"></i></div>
      <div class="tray-icon"><i class="bi bi-eraser align-icons editing-eraser"></i></div>
    </div>
  </div>

  <div id="measurementToolsPanel" class="measurement-tools-panel-class">
    <div id="measurementToolsPanelTray" style="display:none;">
      <div class="tray-icon"><i class="bi bi-dash-lg align-icons measurement-line"></i></div>
      <div class="tray-icon"><i class="bi bi-bounding-box align-icons measurement-polygon"></i></div>
      <div class="tray-icon"><i class="bi bi-eraser align-icons measurement-eraser"></i></div>
    </div>
  </div>

  <div id="dataSourcePanel" class="data-source-panel-class">
  </div>

  <div id="dataUploadDialog" class="panel-class">
    <div id="dataUploadDialogTitle" class="panel-title-class">
      Spatial Data Upload
    </div>
    <div id="dataUploadDialogBody" class="panel-body-class">
      <ul class="nav nav-tabs ms-2" id="export-panel-tab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="data-upload-shp-tab" data-bs-toggle="tab" data-bs-target="#data-upload-shp" type="button" role="tab" aria-controls="home" aria-selected="true">Shapefile</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="data-upload-geojson-tab" data-bs-toggle="tab" data-bs-target="#data-upload-geojson" type="button" role="tab" aria-controls="profile" aria-selected="false">GeoJSON</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="data-upload-kml-tab" data-bs-toggle="tab" data-bs-target="#data-upload-kml" type="button" role="tab" aria-controls="profile" aria-selected="false">KML</button>
        </li>
      </ul>
      <div class="tab-content ms-3" id="left-panel-tab-content">
        <div class="tab-pane fade show left-panel-tab-class tab-panel-height active" id="data-upload-shp" role="tabpanel" aria-labelledby="data-upload-shp-tab">
          <div class="mb-3 me-3 input-group-sm">
            <label for="shapeFileInput" class="form-label">Upload Zip file containing .shp, .shx, .dbf files</label>
            <form id="uploadShapeFileForm" class="input-group-sm" enctype="multipart/form-data" method="POST">
              <input class="form-control panel-components" type="file" id="shapeFileInput" name="shapeFileInput">
            </form>
			<div class="col-sm-9 mt-3 text-dp-theme-color">
              <input class="form-check-input" type="checkbox" value="" onchange="selectSearchBoundary(this.id)" id="searchWithinShapefile">
              <label class="form-check-label" for="searchWithinShapefile">
                Search within Shapefile
              </label>
            </div>
            <button id="uploadShapeFileButton" type="button" class="btn btn-primary mt-3 btn-sm" onclick="uploadShapeFile()">
              <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
              <span class="sr-only"></span>
              Upload
            </button>
            <button type="button" class="btn btn-primary mt-3 btn-sm" onclick="clearUploadedData()">Clear</button>
          </div>
        </div>

        <div class="tab-pane fade show left-panel-tab-class tab-panel-height" id="data-upload-geojson" role="tabpanel" aria-labelledby="data-upload-geojson-tab">
          <div class="mb-3 me-3">
            <label for="geojsonFileInput" class="form-label">Upload GeoJSON file</label>
            <form id="uploadGeoJSONForm" class="input-group-sm" enctype="multipart/form-data" method="POST">
              <input class="form-control panel-components" type="file" id="geojsonFileInput" name="geojsonFileInput">
            </form>
			<div class="col-sm-9 mt-3 text-dp-theme-color">
              <input class="form-check-input" type="checkbox" value="" onchange="selectSearchBoundary(this.id)" id="searchWithinGeojson">
              <label class="form-check-label" for="searchWithinGeojson">
                Search within GeoJSON
              </label>
            </div>
            <button id="uploadGeoJSONFileButton" type="button" class="btn btn-primary mt-3 btn-sm" onclick="uploadGeoJSONFile()">
              <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
              <span class="sr-only"></span>
              Upload
            </button>
            <button type="button" class="btn btn-primary mt-3 btn-sm" onclick="clearUploadedData()">Clear</button>
          </div>
        </div>

        <div class="tab-pane fade show left-panel-tab-class tab-panel-height" id="data-upload-kml" role="tabpanel" aria-labelledby="data-upload-kml-tab">
          <div class="mb-3 me-3">
            <label for="kmlFileInput" class="form-label">Upload KML file</label>
            <form id="uploadKMLForm" class="input-group-sm" enctype="multipart/form-data" method="POST">
              <input class="form-control panel-components" type="file" id="kmlFileInput" name="kmlFileInput">
            </form>
			<div class="col-sm-9 mt-3 text-dp-theme-color">
              <input class="form-check-input" type="checkbox" value="" onchange="selectSearchBoundary(this.id)" id="searchWithinKML">
              <label class="form-check-label" for="searchWithinKML">
                Search within KML
              </label>
            </div>
            <button id="uploadKMLFileButton" type="button" class="btn btn-primary mt-3 btn-sm" onclick="uploadKMLFile()">
              <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
              <span class="sr-only"></span>
              Upload
            </button>
            <button type="button" class="btn btn-primary mt-3 btn-sm" onclick="clearUploadedData()">Clear</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="datasetSearchDropDownListPanel" class="dropdown-div">
	<!--<div id="loader" class="spinner-div">
		<div class="spinner"></div>
	</div>-->
    <div id="datasetSearchDropDownBody"></div>
  </div>

  <div id="exportMapDialog" class="panel-class">
    <div id="exportMapDialogTitle" class="panel-title-class">
      Export Map
    </div>
    <div id="exportMapDialogBody" class="panel-body-class">
      <div id="image-download"></div>
      <ul class="nav nav-tabs ms-2" id="export-panel-tab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="template-settings-tab" data-bs-toggle="tab" data-bs-target="#template-settings" type="button" role="tab" aria-controls="home" aria-selected="true">Settings</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="title-settings-tab" data-bs-toggle="tab" data-bs-target="#title-settings" type="button" role="tab" aria-controls="profile" aria-selected="false">Title</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="template-objects-settings-tab" data-bs-toggle="tab" data-bs-target="#template-objects-settings" type="button" role="tab" aria-controls="profile" aria-selected="false">North Arrow</button>
        </li>
      </ul>
      <div class="tab-content ms-3" id="left-panel-tab-content">
        <div class="tab-pane fade show left-panel-tab-class tab-panel-height active" id="template-settings" role="tabpanel" aria-labelledby="template-settings-tab">

          <div class="row mt-3 me-1">
            <div class="col-sm-3">
              <label for="template-settings-orientation" class="mt-1">Orientation</label>
            </div>
            <div class="col-sm-9 input-group-sm">
              <select class="form-select panel-components ms-1" id="template-settings-orientation">
                <option value="landscape">Landscape</option>
                  <option value="portrait">Portrait</option>
              </select>
            </div>
          </div>

          <div class="row mt-3 me-1">
            <div class="col-sm-3">
              <label for="template-settings-format" class="mt-1">Page</label>
            </div>
            <div class="col-sm-9 input-group-sm">
              <select class="form-select panel-components ms-1" id="template-settings-format">
                <option value="a0">A0 (slow)</option>
                <option value="a1">A1</option>
                <option value="a2">A2</option>
                <option value="a3">A3</option>
                <option value="a4" selected>A4</option>
                <option value="a5">A5 (fast)</option>
              </select>
            </div>
          </div>

          <div class="row mt-3 me-1">
            <div class="col-sm-3">
              <label for="template-settings-resolution" class="mt-1">Resolution</label>
            </div>
            <div class="col-sm-9 input-group-sm">
              <select class="form-select panel-components ms-1" id="template-settings-resolution">
                <option value="72">72 dpi (fast)</option>
                <option value="150">150 dpi</option>
                <option value="200" selected>200 dpi</option>
                <option value="300">300 dpi (slow)</option>
              </select>
            </div>
          </div>

          <!--<div class="row mt-3 me-1">
            <div class="col-sm-3">
              <label for="template-settings-scale" class="mt-1">Scale</label>
            </div>
            <div class="col-sm-9 input-group-sm">
              <select class="form-select panel-components ms-1" id="template-settings-scale">
                <option value="500">1:500000</option>
                <option value="250" selected>1:250000</option>
                <option value="100">1:100000</option>
                <option value="50">1:50000</option>
                <option value="25">1:25000</option>
                <option value="10">1:10000</option>
              </select>
            </div>
          </div>-->

        </div>

        <div class="tab-pane fade show left-panel-tab-class tab-panel-height" id="title-settings" role="tabpanel" aria-labelledby="title-settings-tab">

          <ul id="titleControl" class="list-group list-group-flush mt-1">
            <li class="list-group-item">Title</li>
            <div class="row mt-3 me-1">
              <div class="col-sm-3">
                <label for="template-settings-title" class="mt-1">Text</label>
              </div>
              <div class="col-sm-9 input-group-sm">
                <input id="template-settings-title" class="form-control panel-components ms-1" type="text"></input>
              </div>
            </div>

            <div class="row mt-3 me-1">
              <div class="col-sm-3">
                <label for="template-settings-font-size" class="mt-1">Font Size</label>
              </div>
              <div class="col-sm-9 input-group-sm">
                <select class="form-select panel-components ms-1" id="template-settings-font-size">
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
                  <option value="11">11</option>
                  <option value="12">12</option>
                  <option value="14">14</option>
                  <option value="16">16</option>
                  <option value="18">18</option>
                  <option value="20">20</option>
                  <option value="22">22</option>
                  <option value="24">24</option>
                  <option value="26">26</option>
                  <option value="28">28</option>
                </select>
              </div>
            </div>

            <div class="row mt-3 me-1">
              <div class="col-sm-3">
                <label for="template-settings-title-position" class="mt-1">Position</label>
              </div>
              <div class="col-sm-9 input-group-sm">
                <select class="form-select panel-components ms-1" id="template-settings-title-position">
                  <option value="left">Left</option>
                  <option value="center">Center</option>
                  <option value="right">Right</option>                
                </select>
              </div>
            </div>

            <li class="list-group-item">Sub Title</li>
            <div class="row mt-3 me-1">
              <div class="col-sm-3">
                <label for="template-settings-subtitle" class="mt-1">Text</label>
              </div>
              <div class="col-sm-9 input-group-sm">
                <input id="template-settings-subtitle" class="form-control panel-components ms-1" type="text"></input>
              </div>
            </div>

            <div class="row mt-3 me-1">
              <div class="col-sm-3">
                <label for="template-settings-subtitle-font-size" class="mt-1">Font Size</label>
              </div>
              <div class="col-sm-9 input-group-sm">
                <select class="form-select panel-components ms-1" id="template-settings-subtitle-font-size">
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
                  <option value="11">11</option>
                  <option value="12">12</option>
                  <option value="14">14</option>
                </select>
              </div>
            </div>
          </ul>
        </div>

        <div class="tab-pane fade show left-panel-tab-class tab-panel-height" id="template-objects-settings" role="tabpanel" aria-labelledby="template-objects-settings-tab">
          
          <ul id="northArrowControl" class="list-group list-group-flush mt-1">
            <!--<li class="list-group-item">North Arrow</li>-->
            <div class="row mt-3 me-1">
              <div class="col-sm-3">
                <label for="template-settings-north-arrow-position" class="mt-1">Position</label>
              </div>
              <div class="col-sm-9 input-group-sm">
                <select class="form-select panel-components ms-1" id="template-settings-north-arrow-position">
                  <option value="topleft">Top Left</option>
                  <option value="topright">Top Right</option>
                  <option value="bottomleft">Bottom Left</option>
                  <option value="bottomright">Bottom Right</option>
                </select>
              </div>
            </div>

            <!--<li class="list-group-item">IBIS Logo</li>
            <div class="row mt-3 me-1">
              <div class="col-sm-3">
                <label for="template-settings-ibis-logo-position" class="mt-1">Show</label>
              </div>
              <div class="col-sm-9 input-group-sm">
                <input class="form-check-input" type="checkbox" value="" id="template-settings-ibis-logo-position">
              </div>
            </div>-->
          </ul>
          
        </div>
        <button id="exportMapButton" type="button" class="btn btn-primary btn-sm" onclick="printToPDF()">
			<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            <span class="sr-only"></span>
			Export
		</button>
      </div>
    </div>
  </div>

  <div id="reportsDialog" class="panel-class">
    <div id="reportsDialogTitle" class="panel-title-class">
      Reports
    </div>
    <div id="reportsDialogBody" class="panel-body-class">
		<div id="reportsDiv" class="ms-3 mt-3">
			<label>Select the layers for generating report</label>
			<div id="reportWMSLayersList" class="mt-3" style="height: 300px; overflow-y: auto; box-shadow: inset #1f7dcf -5px 0px 5px 0px;">
			</div>
		</div>
		
		<button id="exportReportButton" type="button" class="btn btn-primary btn-sm ms-3 mt-3" onclick="exportReport()">
			<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            <span class="sr-only"></span>
			Print Report
		</button>
		<button id="exportReportResetButton" type="button" class="btn btn-primary btn-sm ms-3 mt-3" onclick="exportReportReset()">
			<!--<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>-->
            <span class="sr-only"></span>
			Reset
		</button></br>
		<div id="reportsActivityStatusDiv" class="ms-3" style="color: #68ef26;">
		</div>
    </div>
  </div>

  <div id="spatialQueryBuilderDialog" class="panel-class">
    <div id="spatialQueryBuilderDialogTitle" class="panel-title-class">
      Spatial Query Builder
    </div>
    <div id="spatialQueryBuilderDialogBody" class="panel-body-class ms-3">
      <div id="queryStructure" style="color: #FFF; padding: 10px;"></div>
      <button type="button" class="btn btn-primary btn-sm" onclick="addSpatialLayer()">Add Layer</button>
      <button id="queryBuilderButton" type="button" class="btn btn-primary btn-sm" onclick="runSpatialQuery()">
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        <span class="sr-only"></span>
        Query
      </button>
      <button type="button" class="btn btn-primary btn-sm" onclick="resetSpatialQuery()">Reset</button>
    </div>

    <div id="toolsContentPanelDataPlayground" style="width: 300px; display: none;">      
    </div>
  </div>
  
  <div id="spatialAnalystDialog" class="panel-class">
    <div id="spatialAnalystDialogTitle" class="panel-title-class">
      Spatial Analyst
    </div>
    <div id="spatialAnalystDialogBody" class="panel-body-class">
    </div>
  </div>

  <div id="sdmDialog" class="panel-class">
    <div id="sdmDialogTitle" class="panel-title-class">
      SDM Tools
    </div>
    <div id="sdmDialogBody" class="panel-body-class">
    </div>
  </div>

  <div class="modal" id="dataPlaygroundSelectLayerBox" tabindex="-1">
    <div class="modal-dialog spatial-filter-dialog">
      <div class="modal-content">
        <div class="modal-header spatial-filter-modal-class">
          <h4>Choose Layer</h4>
          <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close" onclick=" $('#dataPlaygroundSelectLayerBox').hide()"></button>
        </div>
        <div class="modal-body spatial-filter-modal-class">
          <div class="row">
            <div class="col-md-12">
                <div class="my-3">
                  <div>
                    <label>Layer</label>
                    <select id="dataPlaygroundSelectLayer" class="form-select panel-components" onchange="loadSpatialTableColumns(1)">
                      <option value="">Select</option>
                    </select>
                  </div>
                </div>
                <div id="attributesControlPanel" class="my-3">
                  <input id="dataPlaygroundAddConditionButton" type="button" value="Add" class="btn btn-success" onclick="addMoreCondition({loadCombo :true})">
                  <input id="dataPlaygroundRemoveConditionButton" type="button" value="Remove" class="btn btn-danger" onclick="removeLastCondition()">
                </div>
                <div class="my-3">
                  <div id="dataPlaygroundAttributeFilters_1" class="row">
                    <div class="col">
                      <label>Attribute</label>
                      <select id="dataPlaygroundSelectLayerAttribute_1" class="form-select panel-components">
                        <option value="">Select</option>
                      </select>
                    </div>
                    <div class="col">
                      <label>Operator</label>
                      <select id="dataPlaygroundSelectLayerAttributeOperator_1" class="form-select panel-components">
                        <option value="">Select</option>
                        <option value="=">=</option>
                        <option value="<>"><></option>
                        <option value="<"><</option>
                        <option value="<=>"><=</option>
                        <option value=">">></option>
                        <option value=">=">>=</option>
                        <option value="LIKE">LIKE</option>
                        <option value="NOT LIKE">NOT LIKE</option>
                      </select>
                    </div>
                    <div class="col">
                      <label>Value</label>
                      <input id="dataPlaygroundSelectLayerAttributeValue_1" class="form-control  panel-components" type="text" onkeyup="getDataOnKeyPress(this.id)">
                    </div>
                  </div>
                </div>
                <div class="my-4 text-center">
                  <button id="dataPlaygroundAddLayerButton" type="button" class="btn btn-primary" type="button" onclick="addLayerButtonPressed(this.id);">Add</button>
                </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="modal" id="dataPlaygroundSpeciesDetails" tabindex="-1">
    <div class="modal-dialog species-details-dialog">
      <div class="modal-content">
        <div class="modal-header spatial-filter-modal-class">
          <h4>Species Details</h4>
          <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close" onclick=" $('#dataPlaygroundSpeciesDetails').hide()"></button>
        </div>
        <div class="modal-body spatial-filter-modal-class">
			<div id="speciesDetailsDialogBody" class="species-details-dialog-body">
				<!--<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
				  <li class="nav-item" role="presentation">
					<button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Home</button>
				  </li>
				  <li class="nav-item" role="presentation">
					<button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</button>
				  </li>
				  <li class="nav-item" role="presentation">
					<button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</button>
				  </li>
				</ul>
				<div class="tab-content" id="pills-tabContent">
				  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">...</div>
				  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">...</div>
				  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
				</div>-->
			</div>
        </div>
      </div>
    </div>
  </div>
  
</body>
</html>
<script src="<?= base_url() ?>assets/js/jquery.js"></script>
<script src="<?= base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets/js/ol.js')?>"></script>
<script src="<?= base_url(); ?>assets/js/html2canvas.min.js"></script>
<script src="<?= base_url(); ?>assets/js/data_play.js"></script>
<script src="<?= base_url() ?>assets/js/tour-guide.js"></script>
<script src="<?= base_url() ?>assets/js/webtour.min.js"></script>
<script src="<?= base_url() ?>assets/js/jsPDF.js"></script>

<!-- <div class="modal" tabindex="-1" role="dialog" id="dataPlayD">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Data Playground</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> 
      </div>
      <div class="modal-body">
      <p class="text-wrap alert-success text-capitalize" style="width: 36rem;">These features are available only to the registered users. If you are already a registered user, please login with you credentials in the login page by clicking on the login button.

If you want to register, please register yourself in the Join Us section of the login page.</p>
      
      <div class="modal-footer">
        <a href="<?= site_url('home');?>"><button type="button" class="btn btn-primary">Login</button></a>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</div> -->
<div class="modal" id="loginModalD" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
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
                        <form action="<?= site_url('home/Dlogin') ?>" method="post" enctype="multipart/form-data" name="login_form" id="login_form">
                            <div>
                                <h2 class="text-800">Sign In</h2>
                                <h6 class="text-800 mt-4">Sign in with your user id.</h6>
                                &nbsp;<span class="input_error_message" id="login_errors"></span>
                            </div>
                            <div class="mb-4 mt-3">
                                <input type="text" name="username" id="login_usernameDp" class="form-control" placeholder="Please type your user id." required>
                                &nbsp;<span class="input_error_message" id="login_username_error"></span>
                            </div>
                            <div class="mb-4 mt-4">
                                <input type="password" name="password" id="login_passwordDp" class="form-control" placeholder="Please type your password." required>
                                &nbsp;<span class="input_error_message" id="login_password_error"></span>
                            </div>
                            <label><input id="rememberMeDP" name="rememberme" value="lsRememberMe" type="checkbox" checked onclick="lsRememberMeDp()" /> &nbsp;Remember me</label>
                            <label style="float:right;"><input id="keepSignin" name="rememberme" value="remember" type="checkbox" checked /> &nbsp; Keep me signed in</label>
                            <div class="d-grid mb-4 mt-4 text-center">
                                <button button="button" class="btn btn-dark py-2 fs-5" onclick="return validateLoginHandlerDP(this);">Sign In <img src="<?= IMAGE_URL.'../svg/bars.svg'; ?>" alt="loader" class="loader"></button>                               
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
                                <i class="bx bxl-facebook"></i> Continue with Facebook <img src="<?= IMAGE_URL.'../svg/bars.svg'; ?>" alt="loader" class="loader">
                            </button>
                        </div>
                        <div class="mt-4 mb-4 d-grid">
                        <button button="button" class="btn btn-danger btn-google text-start py-2 fs-5">
                                <i class="bx bxl-google"></i> Continue with Google <img src="<?= IMAGE_URL.'../svg/bars.svg'; ?>" alt="loader" class="loader">
                            </button>
                        </div>
                        <div class="mt-4 mb-4 d-grid">
                            <button button="button" class="btn text-start py-2 fs-5" style="background-color: #833AB4;color: white;">
                                <i class="bi bi-instagram"></i> Continue with Instagram <img src="<?= IMAGE_URL.'../svg/bars.svg'; ?>" alt="loader" class="loader">
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 <?php if(!empty($_SESSION[SESSION_NAME]['user_uuid'])) { //print_r("expression");?>
<script type="text/javascript">
$(document).ready(function(){
$("#advancedControlVerticalPanel").animate({height: '300px'}, 'fast');
$("#tools-button").removeClass("button-panel-close-state").addClass("button-panel-open-state");
$("#advancedControlVerticalPanel").show();
});
</script>
<?php } ?>