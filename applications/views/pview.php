<?php $this->load->view('common/header'); ?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<style>
    .dropdown-div {
        display: none;
        /* position: absolute; */
        background-color: #f6f6f6;
        width: 100%;
        overflow: auto;
        border: 1px solid #ddd;
        z-index: 1;
        max-height: 200px;
        text-align: left;
    }

    .dropdown-div a {
        color: black;
        padding: 6px 12px;
        text-decoration: none;
        display: block;
    }

    .dropdown-div a:hover {
        color: white;
        padding: 6px 12px;
        text-decoration: none;
        display: block;
        background-color: #619bce;
    }

    .show {
        display: block;
    }

    .map {
        width: 100%;
        height: 600px;
    }

    .ol-attribution.ol-logo-only,
    .ol-attribution.ol-uncollapsible {
        max-width: calc(100% - 3em) !important;
        height: 1.5em !important;
    }

    .ol-control button,
    .ol-attribution,
    .ol-scale-line-inner {
        font-family: 'Lucida Grande', Verdana, Geneva, Lucida, Arial, Helvetica, sans-serif !important;
    }

    .ol-popup {
        position: absolute;
        display: none;
        font-size: 11px;
        min-width: 400px;
        height: 300px;
        background-color: white;
        -webkit-filter: drop-shadow(0 1px 4px rgba(0, 0, 0, 0.2));
        filter: drop-shadow(0 1px 4px rgba(0, 0, 0, 0.2));
        padding: 15px;
        border-radius: 10px;
        border: 1px solid #ccc;
        bottom: 12px;
        left: -50px;
    }

    .ol-popup:after,
    .ol-popup:before {
        top: 100%;
        border: solid transparent;
        content: " ";
        height: 0;
        width: 0;
        position: absolute;
        pointer-events: none;
    }

    .ol-popup:after {
        border-top-color: white;
        border-width: 10px;
        left: 48px;
        margin-left: -10px;
    }

    .ol-popup:before {
        border-top-color: #cccccc;
        border-width: 11px;
        left: 48px;
        margin-left: -11px;
    }

    .ol-popup-closer {
        text-decoration: none;
        position: absolute;
        top: 2px;
        right: 8px;
    }

    .ol-popup-closer:after {
        content: "✖";
    }

    .table {
        width: 100%;
        max-width: 100%;
        margin-bottom: 19px;
    }

    td {
        vertical-align: top;
    }

    .u-section-3 .u-sheet-1 {
        min-height: 247px;
    }

    .u-section-3 .u-text-1 {
        font-weight: 700;
        margin: 60px auto 0;
    }

    .u-section-3 .u-text-2 {
        width: 543px;
        margin: 20px auto 13px;
    }

    @media (max-width: 767px) {
        .u-section-3 .u-text-2 {
            width: 540px;
        }
    }

    @media (max-width: 575px) {
        .u-section-3 .u-text-2 {
            width: 340px;
        }
    }

    .u-section-1 .u-sheet-1 {
        min-height: 500px;
    }

    @media (max-width: 1199px) {
        .u-section-1 .u-sheet-1 {
            min-height: 412px;
        }
    }

    @media (max-width: 991px) {
        .u-section-1 .u-sheet-1 {
            min-height: 316px;
        }
    }

    @media (max-width: 767px) {
        .u-section-1 .u-sheet-1 {
            min-height: 296px;
        }
    }


    .u-section-9 {
        min-height: 1714px;
    }

    .u-section-9 .u-dialog-1 {
        width: 662px;
        min-height: 374px;
        height: auto;
        margin: 58px auto 60px;
    }

    .u-section-9 .u-container-layout-1 {
        padding: 30px 30px 0;
    }

    .u-section-9 .u-text-1 {
        font-size: 1.5rem;
        margin: 21px auto 0;
    }

    .u-section-9 .u-form-1 {
        width: 570px;
        margin: 26px auto 0;
    }

    .u-section-9 .u-form-group-2 {
        margin-left: 0;
    }

    .u-section-9 .u-btn-2 {
        border-style: none;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin: 4px auto 0;
    }

    .u-section-9 .u-icon-1 {
        width: 20px;
        height: 20px;
    }

    @media (max-width: 1199px) {
        .u-section-9 .u-dialog-1 {
            width: 662px;
        }
    }

    @media (max-width: 767px) {
        .u-section-9 .u-dialog-1 {
            width: 540px;
        }

        .u-section-9 .u-container-layout-1 {
            padding-left: 10px;
            padding-right: 10px;
        }

        .u-section-9 .u-form-1 {
            width: 520px;
        }
    }

    @media (max-width: 575px) {
        .u-section-9 .u-dialog-1 {
            width: 340px;
        }

        .u-section-9 .u-form-1 {
            width: 320px;
        }
    }

    .adminToolset {
        /* top: 0px; */
        right: 0px;
        position: absolute;
        padding: 10px;
        background-color: rgba(0, 60, 136, .7);
        height: 350px;
        opacity: 0.8;
        z-index: 2;
    }

    .adminToolset:hover {
        opacity: 1;
    }

    .toolset-combo {
        width: 218px;
        margin: 3px;
    }

    .layerlistAddButtonClass {
        margin: 3px;
        background-color: #6690b9;
        color: white;
        border: none;
        cursor: pointer;
    }

    .layerlistAddButtonClass:hover {
        background-color: #3e668d;
    }

    .margin-15 {
        margin: 15px;
    }

    .input-group {
        position: relative;
        display: flex;
        flex-wrap: wrap;
        align-items: stretch;
        width: 100%;
        /* margin-top: 30px; */
    }

    .form-control {
        display: block;
        width: 100%;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #212529;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        border-radius: 0.25rem;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }

    .input-group-text {
        display: flex;
        align-items: center;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #212529;
        text-align: center;
        white-space: nowrap;
        background-color: #e9ecef;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
    }

    .toggleAdminSearchToolsClass {
        color: white;
        position: absolute;
        /* top: 0px; */
        /* left: -50px; */
        right: 310px;
        background-color: rgba(0, 60, 136, .7);
        cursor: pointer;
        width: 50px;
        text-align: center;
        z-index: 1;
    }

    .adminSearchPanelLoader {
        display: none;
        background-color: black;
        z-index: 5;
        width: 100%;
        height: 100%;
        position: absolute;
        margin: -10px;
        opacity: 0.5;
        color: white;
        text-align: center;
    }

    .speciesSection {
        margin-top: 140px;
    }

    @media (max-width:767px) {
        .speciesSection {
            margin-top: 110px;
        }

    }
</style>
<section class="speciesSection p-0">
    <div class="row">
        <div id="map" class="map col-md-12">

            <div class="col-md-6 px-5 py-4 position-absolute" style="z-index: 1;">

                <div class="input-group">
                    <input id="searchSpeciesTextBox" class="form-control" type="search" placeholder="Search species..." onclick="toggleDropDownDiv()" onkeyup="searchSpeciesOnKeyPress(this.value)" aria-label="Search" aria-describedby="basic-addon2">
                </div>
                <div id="searchSpeciesTextBoxDropDown" class="dropdown-div"></div>
                <div id="currentPosition"></div>
            </div>
            <div id="popup" class="ol-popup">
                <a href="#" id="popup-closer" class="ol-popup-closer"></a>
                <div id="popup-content"></div>
            </div>
            <div id="toggleAdminSearchTools" class="toggleAdminSearchToolsClass" title="Show/hide layers search panel" onclick="toggleList()">Hide</div>
            <div id="addWMSLayerButton" class="adminToolset">
                <div id="adminSearchPanelLoader" class="adminSearchPanelLoader">Loading...</div>
                <input type="button" value="Add WMS" class="layerlistAddButtonClass " onclick="inputWMSLayer()"></input>

                <input type="checkbox" id="zoomToFeature" name="zoomToFeature">
                <label for="zoomToFeature"> Zoom to feature</label><br>

                <select id="statesCombo" onchange="loadDistricts(this.value)" class="toolset-combo">
                    <option value="">Select States</option>
                </select>
                <input type="button" value="Show" class="layerlistAddButtonClass" onclick="showStatesGeometry()"></input><br />

                <select id="districtsCombo" onchange="loadSubDistricts(this.value); loadBlocks(this.value);" class="toolset-combo">
                    <option value="">Select Districts</option>
                </select>
                <input type="button" value="Show" class="layerlistAddButtonClass" onclick="showDistrictsGeometry()"></input><br />

                <select id="subDistrictsCombo" class="toolset-combo">
                    <option value="">Select Sub Districts</option>
                </select>
                <input type="button" value="Show" class="layerlistAddButtonClass" onclick="showSubDistrictsGeometry()"></input><br />

                <select id="blocksCombo" class="toolset-combo">
                    <option value="">Select Blocks</option>
                </select>
                <input type="button" value="Show" class="layerlistAddButtonClass" onclick="showBlocksGeometry()"></input><br />
            </div>
        </div>
    <div id="details"></div>
    </div>
</section>
<section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<div class="container">
   <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Overview</a></li>
    <li><a data-toggle="tab" href="#menu1">Descriptions</a></li>
    <li><a data-toggle="tab" href="#menu2">Literature</a></li>
    <li><a data-toggle="tab" href="#menu3">Maps</a></li>
    <li><a data-toggle="tab" href="#menu4">Specimens</a></li>
    <li><a data-toggle="tab" href="#menu5">Statistics</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <h3>Overview</h3>
      <p>NOMENCLATURE</p>
    </div>
    <div id="menu1" class="tab-pane fade">
      <h3>Descriptions</h3>
      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>
    <div id="menu2" class="tab-pane fade">
      <h3>Literature</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div>
    <div id="menu3" class="tab-pane fade">
      <h3>Maps</h3>
      <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
    </div>
    <div id="menu4" class="tab-pane fade">
      <h3>Specimens</h3>
      <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
    </div>
    <div id="menu5" class="tab-pane fade">
      <h3>Statistics</h3>
      <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
    </div>
  </div>
</div>
</section>
<?php $this->load->view('common/footer'); ?>

<div class="modal" id="addWMSLayerDialog" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Enter WMS layer details</h4>
                <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form method="post">
                            <div class="my-3">
                                <input type="text" placeholder="Enter WMS URL" id="wmsServiceURL" name="name" class="form-control" required="">
                            </div>
                            <div class="my-3">
                                <input type="text" placeholder="Enter layer name" id="wmsLayerName" name="text" class="form-control">
                            </div>
                            <div class="my-4 text-center">
                                <button type="button" class="btn btn-primary" type="button" onclick="return addWMSLayer();">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url(); ?>assets/js/species.js"></script>