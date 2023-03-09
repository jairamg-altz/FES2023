<?php $this->load->view('common/header'); ?>
<style>
    .map {
        width: 100%;
        height: 600px;
    }

    .gallery {
        margin-top: 100px;
    }

    .adminToolset {
        /* top: 0px; */
        right: 0px;
        position: absolute;
        padding: 10px;
        background-color: rgba(0, 60, 136, .7);
        height: 350px;
        opacity: 0.8;
        z-index: 1;
        transform: translateX(0);
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

    .toggleAdminSearchToolsClass {
        color: white;
        position: absolute;
        top: 0px;
        left: -50px;
        background-color: rgba(0, 60, 136, .7);
        cursor: pointer;
        width: 50px;
        text-align: center;
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

    .gender-male {
        background-color: aliceblue;
    }

    .gender-female {
        background-color: #efe0ee;
    }

    .child {
        background-color: #dbf1ef;
    }
		
	.ol-popup {
		position: absolute;
		display: block;
		font-size: 11px;
		/* min-width: 400px;
		height: 300px; */
		background-color: white;
		-webkit-filter: drop-shadow(0 1px 4px rgba(0,0,0,0.2));
		filter: drop-shadow(0 1px 4px rgba(0,0,0,0.2));
		padding: 15px;
		border-radius: 10px;
		border: 1px solid #ccc;
		bottom: 10px;
		left: -75px;
		width: 350px;
	}
	.ol-popup:after, .ol-popup:before {
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
		left: 75px;
		margin-left: -10px;
	}
	.ol-popup:before {
		border-top-color: #cccccc;
		border-width: 11px;
		left: 74px;
		margin-left: -11px;
	}
	.ol-popup-closer {
		text-decoration: none;
		position: absolute;
		top: 2px;
		right: 8px;
	}
	.ol-popup-closer:after {
		content: "x";
	}
	.ol-popup-content {
		max-height: 250px;
		overflow-y: auto;
	}
</style>
<section class="gallery container-fluid">
<div class="row"> 
    <div class="col-md-12">
            <div class="text-center p-4 d-none observationDetailsBlock">
                <h2 id="speciesName"></h2>
                <p id="observationDetails"></p>
            </div>
            <div id="currentPosition"></div>
        </div>
        <div class="col-md-12" id="galleryMapdddd">
		<div id="galleryMap" class="map"></div>
		<div id="popup" class="ol-popup">
			<a href="#" id="popup-closer" class="ol-popup-closer"></a>
			<div id="popup-content" class="ol-popup-content"></div>
		</div>
		</div>
        <div class="col-md-12">
            <a href="<?= site_url('observations/getobddetail/'.$checklist);?>"><button type="button" class="btn btn-primary" style="float: right;position: absolute;margin-top: -649px;margin-left: 1205px;">View Detail</button></a>
            <div class="px-5 py-4 row">
                <div class="col-md-6">
                    <div class="obs_img_swiper swiper">
                        <div class="swiper-wrapper align-items-center" id="obs_img_swiper_block"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <table class="table table-striped table-hover">
                        <tbody>
                            <tr>
                                <th>Taxon Id</th>
                                <td id="taxon_id"></td>
                            </tr>
                            <tr>
                                <th>Species</th>
                                <td id="species"></td>
                            </tr>
                            <tr>
                                <th>Kingdom</th>
                                <td id="kingdom"></td>
                            </tr>
                            <tr>
                                <th>Phylum</th>
                                <td id="phylum"></td>
                            </tr>
                            <tr>
                                <th>Class</th>
                                <td id="class"></td>
                            </tr>
                            <tr>
                                <th>Order</th>
                                <td id="order"></td>
                            </tr>
                            <tr>
                                <th>Family</th>
                                <td id="family"></td>
                            </tr>
                            <tr>
                                <th>Subfamily</th>
                                <td id="subfamily"></td>
                            </tr>
                            <tr>
                                <th>Genus</th>
                                <td id="genus"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="px-5 py-4 row">

                <div class="col-md-4 py-5 text-center gender-male">
                    <h1 id="mailCount" class="display-1" data-animation-name="counter" data-animation-event="scroll" data-animation-duration="3000"></h1>
                    <p class="u-text u-text-4">Males</p>
                </div>
                <div class="col-md-4 py-5 text-center gender-female">
                    <h1 id="femailCount" class="display-1" data-animation-name="counter" data-animation-event="scroll" data-animation-duration="3000"></h1>
                    <p class="u-text u-text-6">Females</p>
                </div>
                <div class="col-md-4 py-5 text-center child">
                    <h1 id="childCount" class="display-1" data-animation-name="counter" data-animation-event="scroll" data-animation-duration="3000"></h1>
                    <p class="u-text u-text-8">Children</p>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="px-5 py-4 row justify-content-center">
                <div class="col-md-6">
                    <h2 class="pb-3">Record</h2>
                    <table class="table table-striped table-hover">
                        <tbody>
                            <tr>
                                <th>Basis of record</th>
                                <td id="basisOfRecord"></td>
                            </tr>
                            <tr>
                                <th>Collection code</th>
                                <td id="collectionCode"></td>
                            </tr>
                            <tr>
                                <th>Dynamic properties</th>
                                <td id="dynamicProperties"></td>
                            </tr>
                            <tr>
                                <th>Institution code</th>
                                <td id="institutionCode"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <h2 class="pb-3">Occurence</h2>
                    <table class="table table-striped table-hover">
                        <tbody>
                            <tr>
                                <th>Occurence ID</th>
                                <td id="occurenceId"></td>
                            </tr>
                            <tr>
                                <th>Behaviour</th>
                                <td id="behaviour"></td>
                            </tr>
                            <tr>
                                <th>Individual count</th>
                                <td id="individualCount"></td>
                            </tr>
                            <tr>
                                <th>Recorded by</th>
                                <td id="recordedBy"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
<div class="col-md-12">
            <div class="px-5 py-4 row justify-content-center">
                <div class="col-md-6">
                    <h2 class="pb-3">Event</h2>
                    <table class="table table-striped table-hover">
                        <tbody>
                            <tr>
                                <th>Event Id</th>
                                <td id="eventid"></td>
                            </tr>
                            <tr>
                                <th>Observation Id</th>
                                <td id="observationid"></td>
                            </tr>
                            <tr>
                                <th>Parent Event Id</th>
                                <td id="parentevenid"></td>
                            </tr>
                            <tr>
                                <th>Event Date</th>
                                <td id="eventdate"></td>
                            </tr>
                             <tr>
                                <th>Event Time</th>
                                <td id="eventime"></td>
                            </tr>
                             <tr>
                                <th>Year</th>
                                <td id="yyear"></td>
                            </tr>
                             <tr>
                                <th>Month</th>
                                <td id="mmonth"></td>
                            </tr>
                            <tr>
                                <th>Day</th>
                                <td id="dayy"></td>
                            </tr>
                            <tr>
                                <th>Habitat</th>
                                <td id="habitat"></td>
                            </tr>
                             <tr>
                                <th>Event Remarks</th>
                                <td id="eventemarks"></td>
                            </tr>
                            <tr>
                                <th>Sampling Protocol</th>
                                <td id="samplingrotocol"></td>
                            </tr>
                            <tr>
                                <th>Sampling Effort</th>
                                <td id="samplingffort"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <h2 class="pb-3">Location</h2>
                    <table class="table table-striped table-hover">
                        <tbody>
                            <tr>
                                <th>Location Id</th>
                                <td id="lllId"></td>
                            </tr>
                            <tr>
                                <th>Higher Geography Id</th>
                                <td id="hgid"></td>
                            </tr>
                            <tr>
                                <th>Higher Geography</th>
                                <td id="higgg"></td>
                            </tr>
                            <tr>
                                <th>Continent</th>
                                <td id="contii"></td>
                            </tr>
                             <tr>
                                <th>Waterbody</th>
                                <td id="wwaadd"></td>
                            </tr>
                             <tr>
                                <th>Island Group</th>
                                <td id="iiggg"></td>
                            </tr>
                             <tr>
                                <th>Country</th>
                                <td id="cccc"></td>
                            </tr>
                             <tr>
                                <th>Country Code</th>
                                <td id="cooggty"></td>
                            </tr>
                             <tr>
                                <th>State Province</th>
                                <td id="sppyyy"></td>
                            </tr>
                             <tr>
                                <th>Municipality</th>
                                <td id="mmunciple"></td>
                            </tr>
                             <tr>
                                <th>Locality</th>
                                <td id="lllogg"></td>
                            </tr>
                             <tr>
                                <th>Minimum Elevation In Meters</th>
                                <td id="mmeeiimm"></td>
                            </tr>
                             <tr>
                                <th>Maximum Elevation In Meters</th>
                                <td id="mmaxxeeiimm"></td>
                            </tr>
                             <tr>
                                <th>Location According To</th>
                                <td id="llaatto"></td>
                            </tr>
                             <tr>
                                <th>Location Remarks</th>
                                <td id="llrrr"></td>
                            </tr>
                             <tr>
                                <th>Coordinate Uncertainity In Meters</th>
                                <td id="ccuuim"></td>
                            </tr>
                             <tr>
                                <th>Coordinate Precision</th>
                                <td id="ccpp"></td>
                            </tr>
                             <tr>
                                <th>Observation ID</th>
                                <td id="oobbid"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
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
<script src="<?= base_url(); ?>assets/js/view-observation.js"></script>