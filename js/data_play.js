var geomArray = [];
var map;
var reportsMap;
var mapview;
var scaleLine;
var reportsScaleLine;
var dataPlaygroundGeojsonObject;
var socialMediaPanelClickCounter = 0;
var dataSourcePanelClickCounter = 0;
var basemapPanelClickCounter = 0;
var drawingToolPanelClickCounter = 0;
var measureToolPanelClickCounter = 0;
var toolPanelClickCounter = 0;
var dataUploadClickCounter = 0;
let draw;
var vectorArray = [];
var layerDataProjection;
var layersConfiguredDataset;
var selectedGeometryCoordinates = [];
var geometryMaskId;

// WMS Layers for reporting functionality
var reportsLayersArray = [{
	url: 'https://dpmap.observatory.org.in/geoserver/biophy/wms',
	layer: 'biophy:ind_foresttype',
	layerDisplayName: 'Forest type'
}, {
	url: 'https://dpmap.observatory.org.in/geoserver/biophy/wms',
	layer: 'rts_ts:ForestCanopyHeight2019',
	layerDisplayName: 'Forest Canopy Height 2019'
}, {
	url: 'https://dpmap.observatory.org.in/geoserver/geet/wms',
	layer: 'geet:village_master',
	layerDisplayName: 'Village boundary'
}, {
	url: 'https://dpmap.observatory.org.in/geoserver/pa/wms',
	layer: 'pa:pa_boundaries_wii',
	layerDisplayName: 'PA Boundary'
}, {
	url: 'https://dpmap.observatory.org.in/geoserver/pa/wms',
	layer: 'pa:ramsar_sites',
	layerDisplayName: 'Ramsar Sites'
}, {
	url: 'https://dpmap.observatory.org.in/geoserver/pa/wms',
	layer: 'pa:tiger_reserves',
	layerDisplayName: 'Tiger Reserves'
}, {
	url: 'https://dpmap.observatory.org.in/geoserver/pa/wms',
	layer: 'pa:iba_sites',
	layerDisplayName: 'IBA Sites'
}, {
	url: 'https://dpmap.observatory.org.in/geoserver/rts_ts/wms',
	layer: 'rts_ts:MOD13Q1_006_NDVI',
	layerDisplayName: 'NDVI'
}, {
	url: 'https://dpmap.observatory.org.in/geoserver/rts_ts/wms',
	layer: 'rts_ts:MOD13Q1_006_EVI',
	layerDisplayName: 'EVI'
}, {
	url: 'https://dpmap.observatory.org.in/geoserver/biophy/wms',
	layer: 'biophy:dem',
	layerDisplayName: 'Digital Elevation Model (DEM)'
}, {
	url: 'https://dpmap.observatory.org.in/geoserver/admin/wms',
	layer: 'admin:Average Rainfall',
	layerDisplayName: 'Average rainfall in mm(1901 – 2013)'
}, {
	url: 'https://dpmap.observatory.org.in/geoserver/ifmt/wms',
	layer: 'ifmt:pan_ind_ind_geology',
	layerDisplayName: 'India Geology'
}, {
	url: 'https://dpmap.observatory.org.in/geoserver/biophy/wms',
	layer: 'biophy:ind_soils',
	layerDisplayName: 'Soil type'
}, {
	url: 'https://dpmap.observatory.org.in/geoserver/biophy/wms',
	layer: 'biophy:ind_geomorphology',
	layerDisplayName: 'Geomorphology'
}, {
	url: 'https://dpmap.observatory.org.in/geoserver/biophy/wms',
	layer: 'biophy:drainage',
	layerDisplayName: 'Streams'
}, {
	url: 'https://dpmap.observatory.org.in/geoserver/biophy/wms',
	layer: 'biophy:Maximum Water Extent',
	layerDisplayName: 'Maximum Water Extent'
}, {
	url: 'https://dpmap.observatory.org.in/geoserver/fire/wms',
	layer: 'fire:fire_prone_area',
	layerDisplayName: 'Fire Prone Area'
}, {
	url: 'https://sdmmap.indiaobservatory.org.in/geoserver/SDM_IBISv2/wms',
	layer: 'SDM_IBISv2:Amphibians_2021_Richness_Redlist',
	layerDisplayName: 'Amphibians_2021_Richness_Redlist'
}, {
	url: 'https://sdmmap.indiaobservatory.org.in/geoserver/SDM_IBISv2/wms',
	layer: 'SDM_IBISv2:Amphibians_2021_THR_Richness',
	layerDisplayName: 'Amphibians_2021_THR_Richness_ Threatened'
}, {
	url: 'https://sdmmap.indiaobservatory.org.in/geoserver/SDM_IBISv2/wms',
	layer: 'SDM_IBISv2:Birds_2021_Richness_Redlist',
	layerDisplayName: 'Birds_2021_Richness_Redlist'
}, {
	url: 'https://sdmmap.indiaobservatory.org.in/geoserver/SDM_IBISv2/wms',
	layer: 'SDM_IBISv2:Birds_2021_THR_Richness_Threatened',
	layerDisplayName: 'Birds_2021_THR_Richness_Threatened'
}, {
	url: 'https://sdmmap.indiaobservatory.org.in/geoserver/SDM_IBISv2/wms',
	layer: 'SDM_IBISv2:Mammals_2021_Richness_Redlist',
	layerDisplayName: 'Mammals_2021_Richness_Redlist'
}, {
	url: 'https://sdmmap.indiaobservatory.org.in/geoserver/SDM_IBISv2/wms',
	layer: 'SDM_IBISv2:Mammals_2021_THR_Richness_Threatened',
	layerDisplayName: 'Mammals_2021_THR_Richness_Threatened'
}, {
	url: 'https://sdmmap.indiaobservatory.org.in/geoserver/SDM_IBISv2/wms',
	layer: 'SDM_IBISv2:Richness_2021_All_Redlist',
	layerDisplayName: 'Richness_2021_All_Redlist'
}, {
	url: 'https://sdmmap.indiaobservatory.org.in/geoserver/SDM_IBISv2/wms',
	layer: 'SDM_IBISv2:Richness_THR_2021_Threatened',
	layerDisplayName: 'Richness_THR_2021_Threatened'
}];

var reportsMaskLayer = {
	url: 'https://dpmap.observatory.org.in/geoserver/admin/wms',
	layer: 'admin:mask',
	layerDisplayName: ''
}

const initOpenLayers = () => {
    var attribution = new ol.control.Attribution({
        collapsible: false
    });
    const source = new ol.source.OSM();
    const overviewMapControl = new ol.control.OverviewMap({
    layers: [
        new ol.layer.Tile({
            source: source,
        }),
    ],
    });
    mapview = new ol.View({
        center: ol.proj.fromLonLat([81.0095998, 22.3052918]),
        maxZoom: 18,
        zoom: 5,
        //extent: [4969742.362400516, 645884.7403782723, 12400644.50417221, 4363781.796169246]
    });
    map = new ol.Map({
        controls: ol.control.defaults().extend([overviewMapControl]),
        interactions: ol.interaction.defaults({mouseWheelZoom:true}),
        layers: [
            new ol.layer.Tile({
              source: source
            })
        ],
        target: 'map',
        view: mapview
    });

    scaleLine = new ol.control.ScaleLine({bar: true, text: true, minWidth: 125});
    map.addControl(scaleLine);

    //map.getView().fit([7585780.98409972, 752683.322944575, 10840351.0127791, 4447579.33499313] , map.getSize());
    initBasemaps();
    initButtonsAction();
    initTooltips();
    closePanelsWhenClickedElsewhere();
    getDatasets();
    initDrawToolsButtonClick();
    initMeasurementToolsButtonClick();
	loadCountries();
    //loadStates();

    createMeasureTooltip();
    createHelpTooltip();
    initMeasurementTools();
	$("#left-panel-tab-content").find(".spinner-border-sm").hide();
    $("#queryBuilderButton").find(".spinner-border-sm").hide();
    $("#uploadShapeFileButton").find(".spinner-border-sm").hide();
    $("#uploadGeoJSONFileButton").find(".spinner-border-sm").hide();
    $("#uploadKMLFileButton").find(".spinner-border-sm").hide();
	$("#exportMapButton").find(".spinner-border-sm").hide();
	$("#exportReportButton").find(".spinner-border-sm").hide();
	
	$(".dp-spinner").hide();
	initReportsMap();
	getSharedData();
}

const initReportsMap = () => {
	
	var attribution = new ol.control.Attribution({
        collapsible: false
    });
    const source = new ol.source.OSM();
    const overviewMapControl = new ol.control.OverviewMap({
    layers: [
        new ol.layer.Tile({
            source: source,
        }),
    ],
    });
    mapview = new ol.View({
        center: ol.proj.fromLonLat([81.0095998, 22.3052918]),
        maxZoom: 18,
        zoom: 5,
        //extent: [4969742.362400516, 645884.7403782723, 12400644.50417221, 4363781.796169246]
    });
    reportsMap = new ol.Map({
        controls: [],
        //interactions: ol.interaction.defaults({mouseWheelZoom:false}),
		interactions: ol.interaction.defaults({
                    doubleClickZoom: false,
                    dragAndDrop: false,
                    dragPan: false,
                    keyboardPan: false,
                    keyboardZoom: false,
                    mouseWheelZoom: false,
                    pointer: true,
                    select: false
                }),
        layers: [],
        target: 'reportsMap',
        view: mapview
    });
	
	/*
	reportsLayersArray.forEach((reportItem) => {
		var wms_source = new ol.source.TileWMS({
			url: reportItem.url,
			crossOrigin: 'anonymous',
			params: {
				'LAYERS': reportItem.layer
			}
		});
		var wms_layer = new ol.layer.Tile({
			name: reportItem.layer,
			source:  wms_source
		});
		reportsMap.addLayer(wms_layer);
		//wms_layer.setVisible(false);
	});
	*/

    reportsScaleLine = new ol.control.ScaleLine({bar: true, text: true, minWidth: 125});
    reportsMap.addControl(reportsScaleLine);

    reportsMap.getView().fit([7585780.98409972, 752683.322944575, 10840351.0127791, 4447579.33499313] , reportsMap.getSize());
	
	/*
	* The Report WMS layers list
	*/
	
	$("#reportWMSLayersList").empty();
	reportsLayersArray.forEach((reportItem) => {
		$("#reportWMSLayersList").append(
				'<input class="form-check-input" type="checkbox" value="" id="' + reportItem.layerDisplayName + '"/>'
			+	'<label class="ms-3 form-check-label" for="' + reportItem.layerDisplayName + '">'
			+	reportItem.layerDisplayName
			+	'</label>'
			+	'</br>'
		);
	});
	
}

const reportDims = {
    a4: [297, 210]
};
var reportsLayersToBeRendered = [];
var reportsLayersRenderingDone = false;
var reportsPrintObjectsArray = [];
const reportExportOptions = {
    useCORS: true
    
};

const exportReport = () => {
	console.log("Coming soon");
	if(geometryIndicator == 'state' || geometryIndicator == 'district') {
		//console.log(geometrySelected);
	}
	else {
		alert("Please select a State or District geometry first");
		return;
	}
	
	var selectedLayers = [];
	$("#reportWMSLayersList>input").each(function (){
		if($(this).is(":checked")) {
			selectedLayers.push(this.id);
		}
	});
	
	if(selectedLayers.length == 0) {
		alert("No layer selected. Please select a layer first.");
		return;
	}
	
	if(selectedGeometryCoordinates.length == 0) {
		alert("Click on Show button next to the selected state or district boundary to view the geometry on the map");
		return;
	}
	
	reportsLayersRenderingDone = false;
	// Fit Admin Boundary
	reportsMap.getView().fit(selectedGeometryCoordinates , reportsMap.getSize());
	
	reportsLayersToBeRendered = [];
	reportsLayersArray.forEach((reportItem) => {
		selectedLayers.forEach((selectedLayerItem) => {
			if(reportItem.layerDisplayName == selectedLayerItem) {
				reportsLayersToBeRendered.push(reportItem);
			}
		});
	});
	
	reportsPrintObjectsArray = [];
	var reportsPageFormat = 'a4';
	var reportsResolution = 200;
	var reportsOrientation = 'landscape';
	var dim = reportDims[reportsPageFormat];
	dim = reportsOrientation == 'portrait' ? dim.reverse() : dim;
	//W:  121.25  H:  134.25
	const w = dim[0];
	const h = dim[1];
	const width = Math.round((w * reportsResolution) / 25.4);
	const height = Math.round((h * reportsResolution) / 25.4);
	reportExportOptions.width = width;
	reportExportOptions.height = height;
	console.log("*********    " + width, height);
	//reportPdf = new jspdf.jsPDF(reportsOrientation, undefined, reportsPageFormat);
	
	addReportsMaskLayer();
	addReportsAdminBoundary();
	
	reportsMap.on('rendercomplete', function (x) {
		console.log('rendercomplete:::: ' + x);
		if(!reportsLayersRenderingDone) {
			console.log("RENDERED: " + reportsLayersToBeRendered[0].layer);
			$("#reportsActivityStatusDiv").html('Printing: ' + reportsLayersToBeRendered[0].layer);

			html2canvas(reportsMap.getViewport(), reportExportOptions).then(function (canvas) {

				reportsPrintObjectsArray.push({
					pageTitle: reportsLayersToBeRendered[0].layerDisplayName,
					pageLayer: reportsLayersToBeRendered[0].layer,
					pageLayerURL: reportsLayersToBeRendered[0].url,
					imageDataURL: canvas.toDataURL('image/jpeg')
				});
				
				var oldLayerObjectToBeRemoved = reportsLayersToBeRendered.splice(0,1);
				setTimeout(function(){
					removeReportsLayerByName(oldLayerObjectToBeRemoved[0].layer);
					addReportsLayer();
				}, 200);
			});
		}
		else {
			console.log("RENDERING FINISHED........");
		}
	});
	
	// Set print size
    //reportsScaleLine.setDpi(resolution);
    reportsScaleLine.set('dpi', parseInt(reportsResolution), false)
	const viewResolution = reportsMap.getView().getResolution();

    reportsMap.getTargetElement().style.width = width + 'px';
    reportsMap.getTargetElement().style.height = height + 'px';
	//map.getTargetElement().style.width = '100%';
    //map.getTargetElement().style.height = '100%';
    reportsMap.updateSize();
    reportsMap.getView().setResolution(viewResolution);
	
	// Fit Admin Boundary
	reportsMap.getView().fit(selectedGeometryCoordinates , reportsMap.getSize());
	
	console.log("STARTED ADDING REPORTS LAYERS...");
	addReportsLayer();

	
	/** 
	* 1. Check if State or District is selected or not.
	* 2. Create the main introduction page.
	* 3. Load the geometry filtered WMS for selected WMS layers.
	* 4. For each layer rendered, create a canvas snapshot in the predefined template.
	* 5. Create the list of species page at the end.
	* 6. Create the citation page at the end.
	*/

}


const addReportsLayer = () => {
	if(reportsLayersToBeRendered.length == 0){
		reportsLayersRenderingDone = true;
		printBiodiversityReport();
		$("#reportsActivityStatusDiv").html('Report generated');
		return;
	}
	console.log("Adding Reports Layer: " + reportsLayersToBeRendered[0].layer);
	$("#reportsActivityStatusDiv").html('Adding Reports Layer: ' + reportsLayersToBeRendered[0].layer);
	var wms_source = new ol.source.TileWMS({
		url: reportsLayersToBeRendered[0].url,
		crossOrigin: 'anonymous',
		params: {
			'LAYERS': reportsLayersToBeRendered[0].layer
			//'CQL_FILTER': geometrySelected
			//'CQL_FILTER': 'INTERSECTS(geom, ' + geometrySelected + ')'
			//'CQL_FILTER': 'INTERSECTS(geom, POLYGON((83.320259788 24.286124011,83.320259788 27.521777462,88.3005655690001 27.521777462,88.3005655690001 24.286124011,83.320259788 24.286124011)))'
			//'CQL_FILTER': 'INTERSECTS(geom, POLYGON((9275168.89236343 2788312.52818358,9275168.89236343 3188813.56627755,9829573.99589915 3188813.56627755,9829573.99589915 2788312.52818358,9275168.89236343 2788312.52818358)))'
		}
	});
	var wms_layer = new ol.layer.Tile({
		name: reportsLayersToBeRendered[0].layer,
		source:  wms_source
	});
	//reportsMap.addLayer(wms_layer);
	reportsMap.getLayers().insertAt(0, wms_layer);
	//wms_layer.setVisible(false);
	//reportsLayersToBeRendered.splice(0,1);
}

const addReportsMaskLayer = () => {
	
	console.log("Adding Reports Masking Layer: " + reportsMaskLayer.url);
	var wms_source = new ol.source.TileWMS({
		url: reportsMaskLayer.url,
		crossOrigin: 'anonymous',
		params: {
			'LAYERS': reportsMaskLayer.layer,
			'CQL_FILTER': "mc <> " + geometryMaskId + " and type = '" + geometryIndicator + "'"
			//'CQL_FILTER': 'INTERSECTS(geom, ' + geometrySelected + ')'
			//'CQL_FILTER': 'INTERSECTS(geom, POLYGON((83.320259788 24.286124011,83.320259788 27.521777462,88.3005655690001 27.521777462,88.3005655690001 24.286124011,83.320259788 24.286124011)))'
			//'CQL_FILTER': 'INTERSECTS(geom, POLYGON((9275168.89236343 2788312.52818358,9275168.89236343 3188813.56627755,9829573.99589915 3188813.56627755,9829573.99589915 2788312.52818358,9275168.89236343 2788312.52818358)))'
		}
	});
	var wms_layer = new ol.layer.Tile({
		name: reportsMaskLayer.layer,
		source:  wms_source
	});
	reportsMap.addLayer(wms_layer);
}

const addReportsAdminBoundary = () => {
	// Add State/District geometry to the reports map
	const format = new ol.format.WKT();
	const feature = format.readFeature(geometrySelected, {
		dataProjection: 'EPSG:4326',
		featureProjection: 'EPSG:3857',
	});
	const reportsWKTLayer = new ol.layer.Vector({
		name: 'reportsWKTLayer',
		source: new ol.source.Vector({
		features: [feature],
		}),
		style: getAdminHighlightStyle("ReportsPolygon")
	});
	reportsMap.addLayer(reportsWKTLayer);
	/*
	reportsMap.getLayers().forEach(function (layer) {
		if(layer != undefined) {
			if(layer.get('name') == "reportsWKTLayer") {
				reportsMap.removeLayer(layer);
			}
		}
	});*/
}

const printBiodiversityReport = () => {
	var reportsPageFormat = 'a4';
	var reportsOrientation = 'landscape';
	var dim = reportDims[reportsPageFormat];
	const w = dim[0];
	const h = dim[1];
	var reportPdf = new jspdf.jsPDF(reportsOrientation, undefined, reportsPageFormat);
	
	// Title Page
	reportPdf.setLineWidth(0.5);
	reportPdf.line(4.5, 4.5, w - 4.5, 4.5);
	reportPdf.line(w - 4.5, 4.5, w - 4.5, h - 4.5);
	reportPdf.line(w - 4.5, h - 4.5, 4.5, h - 4.5);
	reportPdf.line(4.5, h - 4.5, 4.5, 4.5);
	reportPdf.setFont('helvetica')
	reportPdf.setFontSize(20);
	//reportPdf.setFontType('bold')
	reportPdf.text("Biodiversity Atlas", w/2, h/2, null, null, 'center');
	reportPdf.addImage("../../media/img/logo/FES_Logo.jpg", "JPEG", 25, h-20, 22, 10);
	reportPdf.addImage("../../media/img/logo/ib_logo.png", "PNG", w-45, h-20, 20, 12);
	
	reportsPrintObjectsArray.forEach((reportObject)=> {
		//pageTitle: reportsLayersToBeRendered[0].layerDisplayName,
		//pageLayer: reportsLayersToBeRendered[0].layer,
		
		
		reportPdf.addPage();
		reportPdf.setTextColor(0,0,200);
		reportPdf.text(reportObject.pageTitle, 25, 20, null, null, 'left');
		reportPdf.setLineWidth(0.5);
		
		// Generate the main border
		reportPdf.line(4.5, 4.5, w - 4.5, 4.5);
		reportPdf.line(w - 4.5, 4.5, w - 4.5, h - 4.5);
		reportPdf.line(w - 4.5, h - 4.5, 4.5, h - 4.5);
		reportPdf.line(4.5, h - 4.5, 4.5, 4.5);
		
		// Legend Border
		reportPdf.line(25, 25, 25, h-25);
		reportPdf.line(25, 25, 75, 25);
		reportPdf.line(75, 25, 75, h-25);
		reportPdf.line(25, h-25, 75, h-25);
		
		// Map Border
		reportPdf.line(w-25, 25, w-25, h-25);
		reportPdf.line(75, 25, w-25, 25);
		reportPdf.line(75, h-25, w-25, h-25);
		
		
		var x1 = 75.25;
		var y1 = 25.25;
		var x2 = w-100.5;
		var y2 = h-50.5;
		console.log(x1, y1, x2, y2);
		console.log("W: ", x2-x1," H: ", y2-y1);
		// Add Image
		reportPdf.addImage(reportObject.imageDataURL, 'JPEG', x1, y1, x2, y2);
		reportPdf.addImage("../../media/img/logo/FES_Logo.jpg", "JPEG", 25, h-20, 22, 10);
		reportPdf.addImage("../../media/img/logo/ib_logo.png", "PNG", w-45, h-20, 20, 12);
		reportPdf.addImage("../../media/img/dp-icons/north-arrow.png", "PNG", w-44, 5, 20, 20);
		
		
		
		// Add Legend
		reportPdf.addImage(reportObject.pageLayerURL + '?service=WMS&version=1.1.0&request=GetLegendGraphic&width=20&height=20&layer=' + reportObject.pageLayer + '&srcwidth=768&srcheight=330&srs=EPSG:4326&format=image/png&legend_options=fontAntiAliasing:true', 'PNG', 27, 100);
		//$("#dashboardmap").append('<div><img style="position: absolute; bottom: -648px;" id="legend"/></div>');
		//const img = document.getElementById('legend');
		//img.src = layerURL + "service=WMS&version=1.1.0&request=GetLegendGraphic&width=20&height=20&layer=" + layerName + "&srcwidth=768&srcheight=330&srs=EPSG:4326&format=image/png&transparent=true&legend_options=fontAntiAliasing:true";
		//https://data.altztech.com/geoserver/wms?service=WMS&version=1.1.0&request=GetLegendGraphic&width=20&height=20&layer=FES:aves&srcwidth=768&srcheight=330&srs=EPSG:4326&format=image/png&legend_options=fontAntiAliasing:true
		
		
	})
	
	
	
	//reportPdf.save('Report.pdf');
	
	/*
	reportPdf.save("Report.pdf", 
		{
			returnPromise:true
		}).then({
			alert("PDF render all done!");
			reportsMap.getTargetElement().style.width = '100%';
			reportsMap.getTargetElement().style.height = '100%';
		});*/
		
	reportPdf.save("Report.pdf", {
		returnPromise:true
	}).then(
		afterPDFRender()
	);
}

const afterPDFRender = () => {
	console.log("PDF render all done!");
	reportsMap.getTargetElement().style.width = '100%';
	reportsMap.getTargetElement().style.height = '100%';
}


const dummyPrint = () => {
	var reportsPageFormat = 'a4';
	var reportsOrientation = 'landscape';
	var dim = reportDims[reportsPageFormat];
	const w = dim[0];
	const h = dim[1];
	var reportPdf = new jspdf.jsPDF(reportsOrientation, undefined, reportsPageFormat);

	// Title Page
	reportPdf.setLineWidth(0.5);
	reportPdf.line(4.5, 4.5, w - 4.5, 4.5);
	reportPdf.line(w - 4.5, 4.5, w - 4.5, h - 4.5);
	reportPdf.line(w - 4.5, h - 4.5, 4.5, h - 4.5);
	reportPdf.line(4.5, h - 4.5, 4.5, 4.5);
	reportPdf.setFont('helvetica')
	reportPdf.setFontSize(20);
	reportPdf.setTextColor(255,0,0);
	//reportPdf.setFontType('bold')
	//reportPdf.text("Biodiversity Atlas", w/2, h/2, null, null, 'center');
	reportPdf.text("Forest Type", 25, 20, null, null, 'left');
	reportPdf.addImage("../../media/img/logo/FES_Logo.jpg", "JPEG", 30, h-15, 20, 10);
	reportPdf.addImage("../../media/img/logo/ib_logo.png", "PNG", w-30, h-15, 20, 12);
	reportPdf.addImage("../../media/img/dp-icons/north-arrow.png", "PNG", w-35, 5, 20, 20);
	reportPdf.setLineWidth(0.25);
	
	// Legend Border
	reportPdf.line(25, 25, 25, h-15);
	reportPdf.line(25, 25, 75, 25);
	reportPdf.line(75, 25, 75, h-15);
	reportPdf.line(25, h-15, 75, h-15);
	
	// Map Border
	reportPdf.line(w-15, 25, w-15, h-15);
	reportPdf.line(75, 25, w-15, 25);
	reportPdf.line(75, h-15, w-15, h-15);
	
	
	var x1 = 75.25;
	var y1 = 25.25;
	var x2 = w-90.5;
	var y2 = h-40.5;
	console.log(x1, y1, x2, y2);
	console.log("W: ", x2-x1," H: ", y2-y1);
	reportPdf.addImage("../../media/img/logo/272.jpg", "JPEG", x1, y1, x2, y2);
	
	reportPdf.save('Report.pdf');
}

const removeReportsLayerByName = (layerName) => {
	var layersToRemove = [];
	reportsMap.getLayers().forEach(function (layer) {
		if (layer.get('name') != undefined && layer.get('name') === layerName) {
			layersToRemove.push(layer);
		}
	});

	var len = layersToRemove.length;
	for(var i = 0; i < len; i++) {
		reportsMap.removeLayer(layersToRemove[i]);
	}
}

const exportReportReset = () => {
	var layersToRemove = [];
	reportsMap.getLayers().forEach(function (layer) {
		if (layer.get('name') != undefined) {
			layersToRemove.push(layer);
		}
	});

	var len = layersToRemove.length;
	for(var i = 0; i < len; i++) {
		reportsMap.removeLayer(layersToRemove[i]);
	}
}

const initBasemaps = () => {

    const openStreetMapStandard = new ol.layer.Tile({
        source: new ol.source.OSM(),
        visible: true,
        title: 'OSMStandard'
    });

    const openStreetMapHumanitarian = new ol.layer.Tile({
        source: new ol.source.OSM({
            url: "http://a.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png"
        }),
        visible: false,
        title: 'OSMHumanitarian'
    });

    const cartoDBlightAll = new ol.layer.Tile({
        source: new ol.source.OSM({
            url: "http://{1-4}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png"
        }),
        visible: false,
        title: 'cartoDBlightAll'
    });

    const cartoDBdarkAll = new ol.layer.Tile({
        source: new ol.source.OSM({
            url: "http://{1-4}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}.png"
        }),
        visible: false,
        title: 'cartoDBdarkAll'
    });

    const cartoDBVoyager = new ol.layer.Tile({
        source: new ol.source.OSM({
            url: "http://{1-4}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}.png"
        }),
        visible: false,
        title: 'cartoDBVoyager'
    });
    
    const stamenToner = new ol.layer.Tile ({
        source: new ol.source.XYZ({
            url: "https://stamen-tiles.a.ssl.fastly.net/toner/{z}/{x}/{y}.png",
            attribution: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>'
        }),
        visible: false,
        title: 'StamenToner'
    });

    const stamenTerrain = new ol.layer.Tile ({
        source: new ol.source.XYZ({
            url: "https://stamen-tiles.a.ssl.fastly.net/terrain/{z}/{x}/{y}.jpg",
            attribution: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>'
        }),
        visible: false,
        title: 'StamenTerrain'
    });

    const baseLayerGroup = new ol.layer.Group({
        layers: [openStreetMapStandard, openStreetMapHumanitarian, cartoDBlightAll, cartoDBdarkAll, cartoDBVoyager, stamenTerrain, stamenToner]
    });

    map.addLayer(baseLayerGroup);

    // Enabling the layer switching
    const baseLayerElements = document.querySelectorAll('.basemap-panel-class > input[type=radio]');
    for (let baseLayerElement of baseLayerElements) {
        baseLayerElement.addEventListener('change', function() {
            let baseLayerElementValue = this.value;
            //console.log(this);
            baseLayerGroup.getLayers().forEach(function(element, index, array) {
                //console.log(element.get('title'));
                let baseLayerTitle = element.get('title');
                console.log(baseLayerTitle, baseLayerElementValue, baseLayerTitle === baseLayerElementValue)
                element.setVisible(baseLayerTitle === baseLayerElementValue);
            })
        })
    }
}

const getPlaygroundSharableLink = (itemId, scientificName, commonName, speciesData) => {
	fetch(getPlaygroundSharableLinkURL,
    {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
            },
        body: JSON.stringify({
            scientificName, commonName, speciesData
        })
    })
    .then(function(res){ return res.text(); })
    .then(function(data) {
        data = JSON.parse(data);
		
		var sharedId = data.data[0].sp_getplaygroundsharablelink;
		var shareURL;
		var sharedText = "Map showing the location of species '" + scientificName + "' (" + commonName + "), ";
		if(sharedText.length >= 280) {
			sharedText = "Map showing the location of species '" + scientificName + "', ";
		}
		
		// From allready shared link
		var baseURL = window.location.href;
		if(baseURL.split('sharelink').length >= 2) {
			baseURL = baseURL.split('sharelink')[0];
		}
		if(baseURL.indexOf('#') != -1) {
			shareURL = baseURL.replace('#', '') + "/sharelink/" + sharedId;
		}
		else {
			shareURL = baseURL + "/sharelink/" + sharedId;
		}
		
		console.log(sharedId);
		console.log(shareURL);
        if(itemId == 'shareFacebookButton') {
            window.open('https://www.facebook.com/sharer/sharer.php?u=' + shareURL);
        }
        if(itemId == 'shareTwitterButton') {
            window.open('https://twitter.com/intent/tweet?text=' + sharedText + '&url=' + shareURL);
        }
        /*if(itemId == 'shareInstagramButton') {
            window.open('https://www.instagram.com/?url=' + shareURL);
        }*/
		if(itemId == 'shareLinkedInButton') {
			window.open('https://www.linkedin.com/shareArticle?mini=true&url=' + shareURL);
		}
    });
}

const getSharedData = () => {
	if(window.location.href.indexOf('sharelink') != -1) {
		var shareid = window.location.href.split('/').pop();
		console.log(shareid);
		
		fetch(getSharedDatasetURL,
		{
			method: "POST",
			headers: {
				"Content-Type": "application/json"
				},
			body: JSON.stringify({
				shareid
			})
		})
		.then(function(res){ return res.text(); })
		.then(function(data) {
			data = JSON.parse(data);
			//shadab
			
			scientificName = data.data[0].sp_scientific_name;
			if(data.data[0].sp_common_name == 'NULL')
				commonName = '';
			else
				commonName = data.data[0].sp_common_name;
			speciesLocationPlotter(JSON.parse(data.data[0].sp_result));
			$("#species-search-box>input").val(scientificName);
			$("#species-search-box-info").show();
			$(".species-search-commonname-label").show();
			$(".species-search-commonname-label").html(commonName);
			$(".species-search-commonname-label").attr('title', commonName);
			
		});
	
	}
	else {
		console.log('No shared link');
	}
}

const downloadSpeciesData = () => {
	if(scientificName == undefined || scientificName == '') {
		return;
	}
	console.log("Downloading: " + scientificName);
	var _downloadDatasetURL = "http://fes.altztech.com:8080/downloadDataset";
	fetch(downloadDatasetURL,
    {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
            },
        body: JSON.stringify({
            scientificName
        })
    })
    .then(function(res){ return res.blob(); })
    .then(function(data) {
        //data = JSON.parse(data);
		console.log(data);
		//var file = window.URL.createObjectURL(data);
		//window.location.assign(file);
		//download('blob:https://fes.altztech.com/1609e5d3-90ec-454b-8bfc-21c5da4ae55f');
		
		var a = document.createElement("a");
        a.href = URL.createObjectURL(data);
        a.setAttribute("download", "speciesdata.xlsx");
        a.click();
		return false;
		/*
		return;
		var url = window.URL.createObjectURL(data);
		var a = document.createElement('a');
		a.href = url;
		a.download = "speciesdata.xlsx";
		document.body.appendChild(a); // we need to append the element to the dom -> otherwise it will not work in firefox
		a.click();    
		a.remove();*/
	});
}

const download = (dataurl, filename) => {
	var a = document.createElement("a");
	a.href = dataurl;
	a.setAttribute("download", filename);
	a.click();
	return false;
}

const initButtonsAction = () => {
    $("#advancedControlVerticalPanel").hide();
    $("#socialMediaPanelTray").find('.tray-icon').on('click', (item) => {
		
		getPlaygroundSharableLink(item.currentTarget.id, scientificName, commonName, speciesData);
        //$("#socialMediaPanel").animate({width: '0px'}, 'fast');
        //$(".social-media-panel-class").css('border', '0px solid #8fffff');
        //$("#socialMediaPanelTray").hide();
        socialMediaPanelClickCounter = 0;
    })

    $("#guestControlMenuPanel").find(".button-horizontal-class").on('click', (item) => {
        if(item.currentTarget.id == 'menu-button') {
            $("#leftPanel").animate({
                height: "toggle"
            }, 100, () => {
                if(!$("#leftPanel").is(":visible")) {
                    $("#menu-button").removeClass("button-panel-open-state").addClass("button-panel-close-state");
                }
                else {
                    $("#menu-button").removeClass("button-panel-close-state").addClass("button-panel-open-state");
                }
            });
        }
    });

    $("#guestControlHorizontalPanel").find(".button-horizontal-class").on('click', (item) => {
        console.log(item.currentTarget.id);
        /*if(item.currentTarget.id == 'social-media-button') {
            socialMediaPanelClickCounter++;
            if(socialMediaPanelClickCounter % 2 == 0) {
                $("#socialMediaPanel").animate({width: '0px'}, 'fast');
                $(".social-media-panel-class").css('border', '0px solid #8fffff');
		        $("#socialMediaPanelTray").hide();
            }
            else {
                $("#socialMediaPanel").animate({width: '120px'}, 'fast');
                $(".social-media-panel-class").css('border', '1px solid #8fffff');
                $("#socialMediaPanelTray").show();
                $("#socialMediaPanelTray").css("display", "flex");
            }
        }*/
        if(item.currentTarget.id == 'data-source-button') {
            dataSourcePanelClickCounter++;
            if(dataSourcePanelClickCounter % 2 == 0) {
                $("#dataSourcePanel").animate({height: '0px'}, 'fast');
                $(".data-source-panel-class").css('border', '0px solid #8fffff');
		        $("#dataSourcePanel").hide();
            }
            else {
                $("#dataSourcePanel").animate({height: '160px'}, 'fast');
                $(".data-source-panel-class").css('border', '1px solid #8fffff');
		        $("#dataSourcePanel").show();
            }
        }
        if(item.currentTarget.id == 'basemaps-button') {
            basemapPanelClickCounter++;
            if(basemapPanelClickCounter % 2 == 0) {
                $("#basemapSelectionPanel").animate({height: '0px'}, 'fast');
                $(".basemap-panel-class").css('border', '0px solid #8fffff');
		        $("#basemapSelectionPanel").hide();
            }
            else {
                $("#basemapSelectionPanel").animate({height: '250px'}, 'fast');
                $(".basemap-panel-class").css('border', '1px solid #8fffff');
		        $("#basemapSelectionPanel").show();
            }
        }
        if(item.currentTarget.id == 'information-button') {
            var wt = new WebTour();
            wt.setSteps(steps);
            wt.start();
        }
        
    });

    $("#guestControlVerticalPanel").find(".button-vertical-class").on('click', (item) => {
        console.log(item.currentTarget.id);
        if(item.currentTarget.id == 'tools-button') {
            toolPanelClickCounter++;
            if(toolPanelClickCounter % 2 == 0) {
                $("#advancedControlVerticalPanel").animate({height: '0px'}, 'fast');
                $("#tools-button").removeClass("button-panel-open-state").addClass("button-panel-close-state");
		        $("#advancedControlVerticalPanel").hide();
            }
            else {
                $("#advancedControlVerticalPanel").animate({height: '300px'}, 'fast');
                $("#tools-button").removeClass("button-panel-close-state").addClass("button-panel-open-state");
                $("#advancedControlVerticalPanel").show();
            }
        }
        if(item.currentTarget.id == 'upload-button') {
            closeAnyOpenDialogExcept('dataUploadDialog');
            $("#dataUploadDialog").animate({
                width: "toggle"
            }, 200, () => {
                if(!$("#dataUploadDialog").is(":visible")) {
                    $("#upload-button").removeClass("button-panel-open-state").addClass("button-panel-close-state");
                }
                else {
                    $("#upload-button").removeClass("button-panel-close-state").addClass("button-panel-open-state");
                }
            });
        }
        if(item.currentTarget.id == 'draw-button') {
            drawingToolPanelClickCounter++;
            if(drawingToolPanelClickCounter % 2 == 0) {
                $("#drawingToolsPanel").animate({width: '0px'}, 'fast');
                $(".drawing-tools-panel-class").css('border', '0px solid #8fffff');
		        $("#drawingToolsPanelTray").hide();
            }
            else {
                $("#drawingToolsPanel").animate({width: '240px'}, 'fast');
                $(".drawing-tools-panel-class").css('border', '1px solid #8fffff');
                $("#drawingToolsPanelTray").show();
                $("#drawingToolsPanelTray").css("display", "flex");
            }
        }
        if(item.currentTarget.id == 'measure-button') {
            measureToolPanelClickCounter++;
            if(measureToolPanelClickCounter % 2 == 0) {
                $("#measurementToolsPanel").animate({width: '0px'}, 'fast');
                $(".measurement-tools-panel-class").css('border', '0px solid #8fffff');
		        $("#measurementToolsPanelTray").hide();
            }
            else {
                $("#measurementToolsPanel").animate({width: '130px'}, 'fast');
                $(".measurement-tools-panel-class").css('border', '1px solid #8fffff');
                $("#measurementToolsPanelTray").show();
                $("#measurementToolsPanelTray").css("display", "flex");
            }
        }
    });

    $("#advancedControlVerticalPanel").find(".button-vertical-class").on('click', (item) => {
        console.log(item.currentTarget.id);
        if(item.currentTarget.id == 'export-button') {
            closeAnyOpenDialogExcept('exportMapDialog');
            $("#exportMapDialog").animate({
                width: "toggle"
            }, 200, () => {
                if(!$("#exportMapDialog").is(":visible")) {
                    $("#export-button").removeClass("button-panel-open-state").addClass("button-panel-close-state");
                }
                else {
                    $("#export-button").removeClass("button-panel-close-state").addClass("button-panel-open-state");
                }
            });
        }
        if(item.currentTarget.id == 'report-button') {
            closeAnyOpenDialogExcept('reportsDialog');
            $("#reportsDialog").animate({
                width: "toggle"
            }, 200, () => {
                if(!$("#reportsDialog").is(":visible")) {
                    $("#report-button").removeClass("button-panel-open-state").addClass("button-panel-close-state");
                }
                else {
                    $("#report-button").removeClass("button-panel-close-state").addClass("button-panel-open-state");
                }
            });
        }
        if(item.currentTarget.id == 'query-builder-button') {
            closeAnyOpenDialogExcept('spatialQueryBuilderDialog');
            $("#spatialQueryBuilderDialog").animate({
                width: "toggle"
            }, 200, () => {
                if(!$("#spatialQueryBuilderDialog").is(":visible")) {
                    $("#query-builder-button").removeClass("button-panel-open-state").addClass("button-panel-close-state");
                }
                else {
                    $("#query-builder-button").removeClass("button-panel-close-state").addClass("button-panel-open-state");
                }
            });
        }
		if(item.currentTarget.id == 'download-button') {
            closeAnyOpenDialogExcept('spatialQueryBuilderDialog');
			downloadSpeciesData();
            //shadab
        }
        if(item.currentTarget.id == 'spatial-analyst-button') {
            closeAnyOpenDialogExcept('spatialAnalystDialog');
            $("#spatialAnalystDialog").animate({
                width: "toggle"
            }, 200, () => {
                if(!$("#spatialAnalystDialog").is(":visible")) {
                    $("#spatial-analyst-button").removeClass("button-panel-open-state").addClass("button-panel-close-state");
                }
                else {
                    $("#spatial-analyst-button").removeClass("button-panel-close-state").addClass("button-panel-open-state");
                }
            });
        }
        if(item.currentTarget.id == 'sdm-button') {
            closeAnyOpenDialogExcept('sdmDialog');
            $("#sdmDialog").animate({
                width: "toggle"
            }, 200, () => {
                if(!$("#sdmDialog").is(":visible")) {
                    $("#sdm-button").removeClass("button-panel-open-state").addClass("button-panel-close-state");
                }
                else {
                    $("#sdm-button").removeClass("button-panel-close-state").addClass("button-panel-open-state");
                }
            });
        }
    });
}

const closePanelsWhenClickedElsewhere = () => {
    $("#map").click(function() {
        $("#dataSourcePanel").animate({height: '0px'}, 'fast');
        $(".basemap-panel-class").css('border', '0px solid #8fffff');
        $("#dataSourcePanel").hide();

        $("#basemapSelectionPanel").animate({height: '0px'}, 'fast');
        $(".data-source-panel-class").css('border', '0px solid #8fffff');
        $("#basemapSelectionPanel").hide();
        
        /*$("#socialMediaPanel").animate({width: '0px'}, 'fast');
        $(".social-media-panel-class").css('border', '0px solid #8fffff');
        $("#socialMediaPanelTray").hide();*/

        $("#drawingToolsPanel").animate({width: '0px'}, 'fast');
        $(".drawing-tools-panel-class").css('border', '0px solid #8fffff');
        $("#drawingToolsPanelTray").hide();

        $("#measurementToolsPanel").animate({width: '0px'}, 'fast');
        $(".measurement-tools-panel-class").css('border', '0px solid #8fffff');
        $("#measurementToolsPanelTray").hide();

        drawingToolPanelClickCounter = 0;
        measureToolPanelClickCounter = 0;
        socialMediaPanelClickCounter = 0;
        dataSourcePanelClickCounter = 0;
        basemapPanelClickCounter = 0;
    });
}

const closeAnyOpenDialogExcept = (dialogId) => {
    var closeablePanelsList = "#dataUploadDialog,#exportMapDialog,#reportsDialog,#spatialQueryBuilderDialog,#spatialAnalystDialog,#sdmDialog";
    var resetControlButtonsList = "#upload-button, #export-button, #report-button, #query-builder-button, #spatial-analyst-button, #sdm-button";
    var _arr = closeablePanelsList.split(",");
    _arr.splice(_arr.indexOf("#" + dialogId), 1);
    closeablePanelsList = _arr.join(',');
    if($(closeablePanelsList).is(":visible")) {
        $(closeablePanelsList).hide();
    }
    $(resetControlButtonsList).removeClass("button-panel-open-state")
}

const initTooltips = () => {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
    });
}

const initDrawToolsButtonClick = () => {
    $("#drawingToolsPanelTray").find(".tray-icon").on('click', (el)=>{
        console.log($(el.target).attr('class'));
        if($(el.target).hasClass('editing-point')) {
            initDrawTools('Point');
        }
        if($(el.target).hasClass('editing-line')) {
            initDrawTools('LineString');
        }
        if($(el.target).hasClass('editing-circle')) {
            initDrawTools('Circle');
        }
        if($(el.target).hasClass('editing-polygon')) {
            initDrawTools('Polygon');
        }
        if($(el.target).hasClass('editing-undo')) {
            draw.removeLastPoint();
        }
        if($(el.target).hasClass('editing-eraser')) {
            vectorArray.forEach((x) => {
                map.removeLayer(x);
            });
            vectorArray = [];
            map.removeInteraction(draw);
        }
    })
}

const initMeasurementToolsButtonClick = () => {
    $("#measurementToolsPanelTray").find(".tray-icon").on('click', (el)=>{
        console.log($(el.target).attr('class'));
        if($(el.target).hasClass('measurement-line')) {
            initMeasurement('LineString');
        }
        if($(el.target).hasClass('measurement-polygon')) {
            initMeasurement('Polygon');
        }
        if($(el.target).hasClass('measurement-eraser')) {
            measureMentVectorArray.forEach((x) => {
                map.removeLayer(x);
            });
            measureMentVectorArray = [];
            map.getOverlays().getArray().slice(0).forEach(function(overlay) {
                map.removeOverlay(overlay);
            });
            map.removeInteraction(measureMentDraw);
        }
    })
}

const initDrawTools = (type) => {
    map.removeInteraction(draw);
    map.removeInteraction(measureMentDraw);
    const source = new ol.source.Vector({wrapX: false});
    const vector = new ol.layer.Vector({
        source: source,
    });
    map.addLayer(vector);
    vectorArray.push(vector);

    const value = type;
    if (value !== 'None') {
        draw = new ol.interaction.Draw({
            source: source,
            type: value,
        });
        map.addInteraction(draw);
    }
    $("#drawingToolsPanel").animate({width: '0px'}, 'fast');
    $(".drawing-tools-panel-class").css('border', '0px solid #8fffff');
    $("#drawingToolsPanelTray").hide();
    drawingToolPanelClickCounter = 0;
}

var dataPlaygroundDatasets;
const getDatasets = () => {
    $.ajax({
        type: 'POST',
        url : getDataPlaygroundDatasetsURL,
        //data: data,
        success: function(data) {
			dataPlaygroundDatasets = data;
            data.forEach((item)=> {
                if(typeof(item.sp_to_date) == 'string') {
                    //console.log(typeof(item.sp_to_date), item.sp_to_date);
                    item.sp_to_date = new Date(Date.parse(item.sp_to_date));
                    //console.log(item.sp_to_date);
                }
            })
            layersConfiguredDataset = data;

            var categories = [...new Set(data.map(item => item.sp_category))];
            //console.log(categories);
            $("#dataPlaygroundDataTags").empty();
            categories.forEach((dataTagItem)=>{
                $("#dataPlaygroundDataTags").append(
                    '<div class="col-sm-9 ms-3">'
                +   '<input class="form-check-input" type="checkbox" checked value="" id="dataTag_' + dataTagItem + '">'
                +   '<label class="text-dp-theme-color" for="dataTag_' + dataTagItem + '">'
                +       dataTagItem
                +   '</label>'
                +   '</div>'
                );
            });

            filteredDatasetPlotter(data);
            
        },
        error: function(error) {

        }
    });
}

const filteredDatasetPlotter = (data) => {
    var rasterDataSets = data.filter((x) => x.sp_layer_type.toUpperCase() == 'RASTER');
    var vectorDataSets = data.filter((x) => x.sp_layer_type.toUpperCase() == 'VECTOR');
    
    var rasterUniqueCategories = [...new Set(rasterDataSets.map(item => item.sp_category))];
    var vectorUniqueCategories = [...new Set(vectorDataSets.map(item => item.sp_category))];
    
    $("#rasterDatasets, #vectorDatasets, #rasterDatasetsList, #vectorDataSetsList").empty();
    if(rasterDataSets.length) {
        //$("#rasterDatasets").append('<ul id="rasterDatasetsList" class="list-group list-group-flush"></ul>');
		$("#rasterDatasets").append('<div class="accordion accordion-flush ms-2" id="rasterDatasetsList"></div>');
    }
    if(vectorDataSets.length) {
        $("#vectorDatasets").append('<ul id="vectorDataSetsList" class="list-group list-group-flush"></ul>');
    }

    rasterUniqueCategories.forEach((categoryItem) => {
		var categoryItemDiv = categoryItem.replaceAll(' ','-');
        //$("#rasterDatasetsList").append('<li class="list-group-item">' + categoryItem + '</li>');
		$("#rasterDatasetsList").append('<div class="accordion-item">'
			+ '<h2 class="accordion-header" id="flush-heading-' + categoryItemDiv + '">'
			+ '  <button class="accordion-button collapsed theme-background-color theme-foreground-color" type="button" data-bs-toggle="collapse" data-bs-target="#flush-' + categoryItemDiv + '" aria-expanded="false" aria-controls="flush-' + categoryItemDiv + '">'
			+ categoryItem
			+ '  </button>'
			+ '</h2>'
			
			
			+ '<div id="flush-' + categoryItemDiv + '" class="accordion-collapse collapse theme-background-color" aria-labelledby="flush-heading-' + categoryItemDiv + '" data-bs-parent="#rasterDatasetsList">'
			+ '  <div id="rasterDatasetsList_' + categoryItemDiv + '" class="accordion-body"></div>'
			+ '</div>'
			
		  + '</div>')
		console.log(categoryItem);
        var layerObject = rasterDataSets.filter((x) => x.sp_layer_type.toUpperCase() == 'RASTER' & x.sp_category == categoryItem);
        layerObject.forEach((layerItem) => {
			//console.log(categoryItem, layerItem);
            $("#rasterDatasetsList_" + categoryItemDiv).append(
                '<div class="row mt-2">'
            +   '<div class="col-sm-8 ms-1">'
            +   '<input class="form-check-input" type="checkbox" value="" id="' + layerItem.sp_layer_id + '" onchange="controlLayerVisibility(this.id);">'
            +   '<label class="text-dp-theme-color ms-3" for="' + layerItem.sp_layer_id + '">'
            +   layerItem.sp_layer_name
            +   '</label>'
            +   '</div>'
            +   '<div class="col-sm-3">'
			+   '<i id="legend_' + layerItem.sp_layer_id + '" class="bi bi-card-image text-layerlist-help-color ms-2" data-bs-toggle="tooltip" data-bs-placement="right" onmouseover="showLegend(this.id)" onmouseout="removeLegend()" ></i>'
            +   '<i class="bi bi-question-circle text-layerlist-help-color ms-3" data-bs-toggle="tooltip" data-bs-placement="right" title="' + layerItem.sp_description + '"></i>'
            +   '</div>'
            +   '</div>'
            );
            //console.log(layerItem.sp_category, layerItem.sp_layer_name)
        });
    });

    vectorUniqueCategories.forEach((categoryItem) => {
        $("#vectorDataSetsList").append('<li class="list-group-item">' + categoryItem + '</li>');
        var layerObject = vectorDataSets.filter((x) => x.sp_layer_type.toUpperCase() == 'VECTOR' & x.sp_category == categoryItem);
        layerObject.forEach((layerItem) => {
            $("#vectorDataSetsList").append(
                '<div class="row mt-2">'
            +   '<div class="col-sm-8 ms-4">'
            +   '<input class="form-check-input" type="checkbox" value="" id="' + layerItem.sp_layer_id + '" onchange="controlLayerVisibility(this.id);">'
            +   '<label class="text-dp-theme-color ms-3" for="' + layerItem.sp_layer_id + '">'
            +   layerItem.sp_layer_name
            +   '</label>'
            +   '</div>'
            +   '<div class="col-sm-1">'
            +   '<i class="bi bi-question-circle text-layerlist-help-color ms-5" data-bs-toggle="tooltip" data-bs-placement="right" title="' + layerItem.sp_description + '"></i>'
            +   '</div>'
            +   '</div>'
            );
            console.log(layerItem.sp_category, layerItem.sp_layer_name)
        });
    });
    initTooltips();
    initLayersOnLoad();
}

const showLegend = (id) => {
	var split = id.split('_');
	var _id = split[1];
	console.log(_id);
	
	dataPlaygroundDatasets.forEach((item)=>{
		if(item.sp_layer_id == _id) {
			$("#legend").empty();
			$("#legend").append('<div><img id="legendImage"/></div>');
			const img = document.getElementById('legendImage');
			img.src = item.sp_layer_url + "service=WMS&version=1.1.0&request=GetLegendGraphic&width=20&height=20&layer=" + item.sp_layer_name + "&srcwidth=768&srcheight=330&srs=EPSG:4326&format=image/png&transparent=false&legend_options=fontAntiAliasing:true";
		}
	});
}

const removeLegend = () => {
	$("#legend").empty();
}

const applyDatasetFilter = () => {
    var categoriesToFilter = [];
    var toDate, fromDate;
    $("#dataPlaygroundDataTags").find('input').each(function() {
        if($("#" + this.id).is(":checked")) {
            categoriesToFilter.push(this.id.split('_')[1]);
        }
    });
    console.log(categoriesToFilter);
    
    var categoricallyFiltered = layersConfiguredDataset.filter((x) => categoriesToFilter.includes(x.sp_category))
    console.log(categoricallyFiltered);
    

    if($("#dpFromDate").val() != '') {
        if($("#dpToDate").val() == '') {
            alert('To date cannot be blank');
            return;
        }
        else {
            var _to = $("#dpToDate").val().split('-');
            toDate = new Date(Date.parse(_to[1] + '-' + _to[0] + '-' + _to[2]));

            var _from = $("#dpFromDate").val().split('-');
            fromDate = new Date(Date.parse(_from[1] + '-' + _from[0] + '-' + _from[2]));

            console.log(fromDate)
            console.log(toDate)
            categoricallyFiltered = categoricallyFiltered.filter((x) => x.sp_to_date > fromDate && x.sp_to_date < toDate)

        }
    }
    filteredDatasetPlotter(categoricallyFiltered);
}

const resetDatasetFilter = () => {
    $("#dpFromDate").val("");
    $("#dpToDate").val("");
    $("#dataPlaygroundDataTags").find('input').each(function() {
        $("#" + this.id).prop('checked', true);
    });
    filteredDatasetPlotter(layersConfiguredDataset);
}

const initLayersOnLoad = () => {
    layersConfiguredDataset.forEach((layerObject) => {
        var wms_source = new ol.source.TileWMS({
            url: layerObject.sp_layer_url,
            crossOrigin: 'anonymous',
            params: {
                'LAYERS': layerObject.sp_layer_name
            }
        });
        var wms_layer = new ol.layer.Tile({
            name: layerObject.sp_layer_id,
            source:  wms_source
        });
        map.addLayer(wms_layer);
        wms_layer.setVisible(false);
    })
}

const controlLayerVisibility = (id) => {
    map.getLayers().forEach(function(lyr) {
        //console.log(lyr.get('name'));
        if(lyr.get('name') == id) {
            var is_visible = lyr.get('visible');
            lyr.setVisible(!is_visible);
        }
    });
}

const getDataOnKeyPress = (div) => {
    var _id = div.split("_")[1];
    var table = $("#dataPlaygroundSelectLayer").val();
    var column = $("#dataPlaygroundSelectLayerAttribute_" + _id).val();
    var keyword = $("#" + div).val();
    if(table == '' || column == '')
        return;
    console.log(table, column, keyword);
	if(keyword.length == 0) {
		$("#columnValueListDiv").remove();
	}
    if(keyword.length <= 2) {
        return;
    }
    fetch(getMatchingColumnValuesUrl,
    {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
            },
        body: JSON.stringify({
            table,
            column,
            keyword
        })
    })
    .then(function(res){ return res.text(); })
    .then(function(data) {
        data = JSON.parse(data);
        //console.log(data);
		console.log(div);
		$("#columnValueListDiv").remove();
        $("#" + div).after('<div id="columnValueListDiv" style="height: 200px; overflow-y: auto;" class="column-value-drop-down-div"></div>');
        data.data.forEach((item) => {
            console.log(item.sp_values);
            $("#columnValueListDiv").append(
                '<div class="ps-3 mt-1 pe-3 dropdown-row-item">'
                +   '<div class="col-sm-9 text-dp-theme-color">'
                +       '<div href="#" id="' + item.sp_values + '" onclick="selectColumnValueFromDropDown(this.id)" >' + item.sp_values + '</div>'
                +   '</div>'
                +'</div>'
            );
        })
    });
}

const selectColumnValueFromDropDown = (id) => {
    $("#columnValueListDiv").prev().val(id);
    $("#columnValueListDiv").remove();
}

const searchSpeciesOnKeyPress = (keyword) => {
    console.log(keyword);
    if(keyword.length <= 2) {
        map.getLayers().forEach(function (layer) {
            if(layer != undefined) {
                if(layer.get('name') == "dpSpeciesLayer") {
                    map.removeLayer(layer);
                }
            }
        });
        $("#dataSourcePanel").empty();
        $("#dataSourcePanel").animate({height: '0px'}, 'fast');
        $(".basemap-panel-class").css('border', '0px solid #8fffff');
        $("#dataSourcePanel").hide();
        $("#datasetSearchDropDownListPanel").hide();
        $("#datasetSearchDropDownStatisticsPanel").hide();
		$(".species-search-commonname-label").html('');
		$("#species-search-box-info").hide();
		$("#popup").hide();
		scientificName = '';
		commonName = '';
        return;
    }
    $("#datasetSearchDropDownListPanel").show();
    $("#datasetSearchDropDownStatisticsPanel").show();
	$(".dp-spinner").show();
    fetch(dataPlaygroundSearchSpeciesUrl,
	{
		method: "POST",
		headers: {
			"Content-Type": "application/json"
			},
		body: JSON.stringify({
			keyword
			//srs: map.getView().getProjection().getCode().split(":")[1]
		})
	})
	.then(function(res){ return res.text(); })
	.then(function(data) {
		$(".dp-spinner").hide();
		$("#datasetSearchDropDownBody").empty();
		$("#datasetSearchDropDownStatisticsPanel").empty();
		data = JSON.parse(data);
		console.log(data);
		data.data.forEach((item) => {
			var _scientificName = item.sp_scientific_name;
			var _commonName = item.sp_common_name;
			var _id = _scientificName + "_" + _commonName;
			var _commonNameLabel = item.sp_common_name == 'NULL'? '' : ': <label style="color: #95ce95; cursor: pointer;"> ' + item.sp_common_name + '</label>';
			$("#datasetSearchDropDownBody").append(
				'<div class="ps-3 mt-1 pe-3 dropdown-row-item">'
				+   '<div class="col-sm-9 text-dp-theme-color">'
				+       '<div href="#" id="' + _id + '" onclick="getSpeciesLocation(this.id)" >' + '<i>' + _scientificName + '</i>' + _commonNameLabel + '</div>'
				+   '</div>'
				/* +   '<div class="col-sm-2 text-search-result-' + item.sp_dataset.toLowerCase() + '">'
				+       '<label>' + item.sp_dataset + '</label>'
				+   '</div>' */
				+'</div>'
			);
			
		})
	})
}

const selectSearchBoundary = (id) => {
	console.log(id)
	var checkboxes = ['searchWithinShapefile', 'searchWithinGeojson', 'searchWithinKML'];
	checkboxes.forEach((checkBox) => {
		if(checkBox != id)
			$("#" + checkBox).prop("checked", false)	
	});
}

var speciesData;
var scientificName;
var commonName;
const getSpeciesLocation = (id) => {
	scientificName = id.split('_')[0];
	commonName = id.split('_')[1];
    console.log(scientificName);
	
	// Override the geometry search if any of the uploaded geometry is present
	var geometrysrs = 4326;
	var geometrytype = 'WKT';
	if($("#searchWithinShapefile").is(":checked")) {
		var geom = JSON.parse(geometrySelected);
		if(geom.features != undefined) {
			geometrySelected = JSON.stringify(geom.features[0].geometry);
		}
		//geometrySelected = JSON.stringify(geom.coordinates);
		geometrysrs = '3857';
		geometrytype = 'GeoJSON';
	}
	if($("#searchWithinGeojson").is(":checked")) {
		var geom = JSON.parse(geometrySelected);
		if(geom.features != undefined) {
			geometrySelected = JSON.stringify(geom.features[0].geometry);
		}
		//geometrySelected = JSON.stringify(geom.coordinates);
		geometrysrs = '3857';
		geometrytype = 'GeoJSON';
	}
	if($("#searchWithinKML").is(":checked")) {
		var geom = JSON.parse(geometrySelected);
		if(geom.features != undefined) {
			geometrySelected = JSON.stringify(geom.features[0].geometry);
		}
		//geometrySelected = JSON.stringify(geom.coordinates);
		geometrysrs = 3857;
		geometrytype = 'GeoJSON';
	}
	$(".dp-spinner").show();
    fetch(dataPlaygroundGetSpeciesLocationUrl,
    {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
            },
        body: JSON.stringify({
            scientificName,
            srs: parseInt(map.getView().getProjection().getCode().split(":")[1]),
            geometry: geometrySelected,
			geometrysrs: geometrysrs,
			geometrytype: geometrytype
        })
    })
    .then(function(res){ return res.text(); })
    .then(function(data) {
		$(".dp-spinner").hide();
        //$("#species-search-box>input").val(scientificName);
		$(".species-search-commonname-label").show();
		$(".species-search-commonname-label").html(commonName);
		$(".species-search-commonname-label").attr('title', commonName);
        $("#datasetSearchDropDownListPanel").hide();
		$("#species-search-box-info").show();
        data = JSON.parse(data);
        speciesData = data;
        console.log(data);
		if(speciesData.data.length == 0) {
			alert("No data found. Please try another species name or upload any other geometry and search again.");
		}

        var datasetCategories = [...new Set(data.data.map(item => item.json_row.properties.dataset))];
        console.log(datasetCategories);
        $("#dataSourcePanel").empty();
        datasetCategories.forEach((item)=> {
            $("#dataSourcePanel").append(
                    '<input class="form-check-input" type="checkbox" checked value="" id="' + item + '_DatasetsCheckbox" onclick="filteredSpeciesLocationPlotter()">'
                +   '<label style="color: #FFFFFF;" class="form-check-label ms-2" for="' + item + '_DatasetsCheckbox">' + item + '</label></br>'
            )
        });
		
		if($("#showRangeMapsCheckbox").is(":checked")) {
			map.getLayers().forEach(function (layer) {
				if(layer != undefined) {
					if(layer.get('name') == "speciesbiomeLayer") {
						map.removeLayer(layer);
					}
				}
			});
			
		
			speciesBiomesSource = new ol.source.ImageWMS({
				url: speciesBiomesWMSUrl,
				params: {
					'LAYERS': speciesBiomesLayerName,
					'CQL_FILTER' : "binomial='" + scientificName + "'",
					'FORMAT_OPTIONS': 'layout:legend;countMatched:true;hideEmptyRules:true'
				},
				crossOrigin: 'anonymous',
				ratio: 1,
				//format: 'format',
				serverType: 'geoserver',
				transition: 0
			});
			
			speciesBiomesLayer = new ol.layer.Image({
				name: 'speciesbiomeLayer',
				source: speciesBiomesSource
			});
			map.addLayer(speciesBiomesLayer);
			
		}
		else {
			map.getLayers().forEach(function (layer) {
				if(layer != undefined) {
					if(layer.get('name') == "speciesbiomeLayer") {
						map.removeLayer(layer);
					}
				}
			});
		}
		speciesLocationPlotter(data);
		
    });
}

const removerangemaps = () => {
	if(!$("#showRangeMapsCheckbox").is(":checked")) {
		map.getLayers().forEach(function (layer) {
			if(layer != undefined) {
				if(layer.get('name') == "speciesbiomeLayer") {
					map.removeLayer(layer);
				}
			}
		});
	}
	$("#basemapSelectionPanel").hide();
	basemapPanelClickCounter = 0;
}

const getSpeciesLocationOnClick = () => {
    if($("#species-search-box>input").val() == '')
        return;
    getSpeciesLocation($("#species-search-box>input").val());
}

const speciesLocationPlotter = (data) => {
    var featuresArray = [];
    const iconStyle = new ol.style.Style({
        image: new ol.style.Icon({
            anchor: [0.5, 46],
            anchorXUnits: 'fraction',
            anchorYUnits: 'pixels',
            src: window.location.href.split('index.php')[0] + 'media/img/dp-icons/icon.png'
        }),
    });

    data.data.forEach((item) => {
            const feature = new ol.Feature({
				observation_id: item.json_row.properties.observation_id,
				geometry: new ol.geom.Point([item.json_row.geometry.coordinates[0], item.json_row.geometry.coordinates[1]]),
				name: item.json_row.properties.scientific_name,
				kingdom: item.json_row.properties.kingdom,
				family: item.json_row.properties.family,
				image: item.json_row.properties.file_uri
            });
            feature.setStyle(iconStyle);
            featuresArray.push(feature);
    });

    const vectorSource = new ol.source.Vector({
        features: [],
    });
    vectorSource.addFeatures(featuresArray);
    
    const vectorLayer = new ol.layer.Vector({
        name: 'dpSpeciesLayer',
        source: vectorSource,
    });

    map.getLayers().forEach(function (layer) {
        if(layer != undefined) {
            if(layer.get('name') == "dpSpeciesLayer") {
                map.removeLayer(layer);
            }
        }
    });
    map.addLayer(vectorLayer);

    var container = document.getElementById('popup');
    var content_element = document.getElementById('popup-content');
    var closer = document.getElementById('popup-closer');
    //var popupFan = document.getElementById('popupFan');

    var overlay = new ol.Overlay({
        element: container,
        autoPan: true,
        offset: [0, -10],
        autoPanAnimation: {
            duration: 250
        }
    });
    map.addOverlay(overlay);

    /* var popupFanOverlay = new ol.Overlay({
        element: popupFan,
        autoPan: true,
        offset: [0, -10],
        autoPanAnimation: {
            duration: 250
        }
    });
    map.addOverlay(popupFanOverlay); */

    closer.onclick = function() {
        overlay.setPosition(undefined);
        closer.blur();
        return false;
    };

    map.on('click', function(evt) {
        var feature = map.forEachFeatureAtPixel(evt.pixel,
            function(feature, layer) {
            return feature;
            });
        if (feature) {
            var geometry = feature.getGeometry();
            var coord = geometry.getCoordinates();
            if(feature.get('name') == undefined)
                return;
            
            $(".ol-popup").show();
            var imageTag = '';
            if(feature.get('image') != undefined)
                imageTag = '<img width=60 src=' + feature.get('image') + '></br>';
            var content = imageTag;
			var observation_id = feature.get('observation_id');
            content += '<label><b><i>' + feature.get('name') + '</i></b></label></br>';
            content += '<label>' + feature.get('kingdom') + '</label></br>';
            content += '<label>' + feature.get('family') + '</label></br>';
			content += '<p><a id="' + observation_id + '" onclick="getSpeciesObservationDetails(this.id)" href="#">view more</a></p>';
            content_element.innerHTML = content;
            overlay.setPosition(coord);
            //popupFanOverlay.setPosition(coord);
        }
    });


    map.on("pointermove", function (evt) {
        var hit = this.forEachFeatureAtPixel(evt.pixel, function(feature, layer) {
            return true;
        }); 
        if (hit) {
            this.getTargetElement().style.cursor = 'pointer';
        } else {
            this.getTargetElement().style.cursor = '';
        }
    });
}

const getSpeciesObservationDetails = (observation_id) => {
	console.log(observation_id);
	var data = {
		observation_id
	}
	fetch(dataPlaygroundGetSpeciesObservationDetailsUrl,
	{
		method: "POST",
		headers: {
			"Content-Type": "application/json"
			},
		body: JSON.stringify({
			observation_id
		})
	})
	.then(function(res){ return res.text(); })
	.then(function(data) {
		$("#dataPlaygroundSpeciesDetails").show();
		$("#speciesDetailsDialogBody").empty();
		$("#speciesDetailsDialogBody").append('<ul class="nav nav-pills mb-3" id="speciesDetailsTab" role="tablist"></ul>');
		$("#speciesDetailsDialogBody").append('<div class="tab-content" id="speciesDetailsTabContent"></div>');
		JSON.parse(data).data.forEach((item, i)=> {
			//console.log(item.json_row);
			var itemName = Object.keys(item.json_row)[0];
			var itemId = itemName.replace(" ", "_")
			console.log("=> " + itemId + " " + itemName);
			var tabActiveStatus = (i == 0) ? 'active':'';
			$("#speciesDetailsTab").append(
				'<li class="nav-item" role="presentation">'
					+ '<button class="nav-link ' + tabActiveStatus + '" id="pills-' + itemId + '-tab" data-bs-toggle="pill" data-bs-target="#pills-' + itemId + '" type="button" role="tab" aria-controls="pills-' + itemId + '" aria-selected="true">' + itemName + '</button>'
				+ '</li>'
			);
			$("#speciesDetailsTabContent").append(
				'<div class="tab-pane fade show species-details-tabpanel ' + tabActiveStatus + '" id="pills-' + itemId + '" role="tabpanel" aria-labelledby="pills-' + itemId + '-tab"></div>'
			);
			
			var columnHeaders = Object.keys(item.json_row[itemName]);
			var columnValues =  Object.values(item.json_row[itemName]);
			var newArray = [];
			// Sanitize null items
			Object.values(item.json_row[itemName]).forEach((validItem, j)=>{
				if(validItem != null) {
					if(typeof(validItem) == 'string' && validItem.toUpperCase() != 'NULL'){
						//console.log(validItem);
						newArray.push({
							name: columnHeaders[j],
							value: validItem
						});
					}
				}
			});
			
			
			$("#pills-" + itemId).append('<table id="' + itemId + 'Table" class="table table-bordered table-dark"><thead><tr></tr></thead><tbody><tr></tr></tbody>');
			newArray.forEach((nonNullItem) => {
				console.log("=>>>>>>", itemId, itemName, nonNullItem.name, nonNullItem.value)
				if(itemName == "Record Level" && nonNullItem.name == "Image URL") {
					$("#" + itemId + 'Table').find('thead>tr').append('<th class="species-details-table-column-heading" scope="col">' + nonNullItem.name + '</th>');
					$("#" + itemId + 'Table').find('tbody>tr').append('<td><img alt="" class="species-details-image-thumbnail" src="' + nonNullItem.value + '"title="Click to view enlarged" onclick="window.open(this.src)"></img></td>');
				}
				else {
					$("#" + itemId + 'Table').find('thead>tr').append('<th class="species-details-table-column-heading" scope="col">' + nonNullItem.name + '</th>');
					$("#" + itemId + 'Table').find('tbody>tr').append('<td>' + nonNullItem.value + '</td>');
				}
			});
		})
	});
}

const filteredSpeciesLocationPlotter = () => {
    var eligibleSet = [];
    var _data = [];
    $("#dataSourcePanel > input").each(function() {
        //console.log($(this).attr('id').split('_')[0],  $(this).is(":checked"));
        if($(this).is(":checked")) {
            eligibleSet.push($(this).attr('id').split('_')[0]);
        }
    });
    eligibleSet.forEach((item)=>{
        var t = speciesData.data.filter((x) => x.json_row.properties.dataset == item);
		_data = _data.concat(t);
    });
    speciesLocationPlotter({data: _data});
}


/**
 * Spatial Filter Scripts
 */

var layerAttributesArray = [];
var layersAddedInTheFilter = 0;
var layersAddedInTheFilterArray = [];
var spatialQueryGeojsonObject = '';
var sourceLayerAttributesArray = [];
const addSpatialLayer = () => {
    $("#dataPlaygroundSelectLayerBox").show();
    $("#dataPlaygroundAddLayerButton").html("Add");
    getspatiallayers();
    $("div[id*=dataPlaygroundAttributeFilters_]").each(function () {
        var _id = this.id.split('_')[1];
        if(_id != 1) {
            $("#" + this.id).remove();
        }
        $("#dataPlaygroundSelectLayerAttributeJoin_" + _id).remove();
    });
    $("#dataPlaygroundSelectLayerAttribute_1 option[value!='']").remove();
    $("#dataPlaygroundSelectLayerAttribute_1").val('');
    $("#dataPlaygroundSelectLayerAttributeOperator_1").val('');
    $("#dataPlaygroundSelectLayerAttributeValue_1").val('');
}

const getspatiallayers = () => {
    $.ajax({
        type: 'GET',
        url : getSpatialLayers,
        success: function(d) {
            $("#dataPlaygroundSelectLayer option[value!='']").remove();
            d = JSON.parse(d);
            d.data.forEach((layer) => {
                $("#dataPlaygroundSelectLayer").append('<option value="' + layer.sp_table_name + '">' + layer.sp_table_name + '</option>');
            })
        },
        error: function(e) {
            
        }
    });
}

const loadSpatialTableColumns = (id) => {
    var data = {
        table_name: $("#dataPlaygroundSelectLayer").val()
    };
    $.ajax({
        type: 'POST',
        url : getSpatialLayerColumns,
        data: JSON.stringify(data),
        success: function(d) {
            $("#dataPlaygroundSelectLayerAttribute_" + id).empty();
            $("#dataPlaygroundSelectLayerAttribute_" + id).append('<option value="">Select</option>');
            var attributes = [];
            d.data.forEach((column) => {
                $("#dataPlaygroundSelectLayerAttribute_" + id).append('<option value="' + column.sp_column_name + '">' + column.sp_column_name + '</option>');
                attributes.push(column.sp_column_name);
            });
            if (layerAttributesArray.length == 0 || layerAttributesArray.every(e => e.layer != $("#dataPlaygroundSelectLayer").val())) {
                layerAttributesArray.push({
                    layer: $("#dataPlaygroundSelectLayer").val(),
                    attributes: attributes
                });
            }
        },
        error: function(e) {
            
        }
    });
}

const addMoreCondition = (obj) => {
    if($("#dataPlaygroundSelectLayer").val() == "")
        return;
    var _arr = [];
    $("div[id*=dataPlaygroundAttributeFilters_]").each(function () {
        console.log(this.id);
        var _id = this.id.split('_')[1];
        _arr.push(parseInt(_id));
    });
    var _id = Math.max(..._arr);
    console.log(_id);
    var i = parseInt(_id) + 1;
    $("#dataPlaygroundAttributeFilters_" + _id).parent().after(
            '<div class="col">'
        +   '   <select id="dataPlaygroundSelectLayerAttributeJoin_' + i + '" class="form-select panel-components">'
        +   '       <option value="AND">AND</option>'
        +   '       <option value="OR">OR</option>'
        +   '   </select>'
        +   '</div>'
        +   '<div class="my-3">'
        +   '   <div id="dataPlaygroundAttributeFilters_' + i + '" class="row">'
        +   '       <div class="col">'
        +   '           <label>Attribute</label>'
        +   '           <select id="dataPlaygroundSelectLayerAttribute_' + i + '" class="form-select panel-components">'
        +   '               <option value="">Select</option>'
        +   '           </select>'
        +   '       </div>'
        +   '       <div class="col">'
        +   '           <label>Operator</label>'
        +   '           <select id="dataPlaygroundSelectLayerAttributeOperator_' + i + '" class="form-select panel-components">'
        +   '               <option value="">Select</option>'
        +   '               <option value="=">=</option>'
        +   '               <option value="<>"><></option>'
        +   '               <option value="<"><</option>'
        +   '               <option value="<=>"><=</option>'
        +   '               <option value=">">></option>'
        +   '               <option value=">=">>=</option>'
        +   '               <option value="LIKE">LIKE</option>'
        +   '               <option value="NOT LIKE">NOT LIKE</option>'
        +   '           </select>'
        +   '       </div>'
        +   '       <div class="col">'
        +   '           <label>Value</label>'
        +   '           <input id="dataPlaygroundSelectLayerAttributeValue_' + i + '" onkeyup="getDataOnKeyPress(this.id)" class="form-control panel-components" type="text"></input>'
        +   '       </div>'
        +   '   </div>'
        +   '</div>'
    );
    if(obj.loadCombo)
        loadSpatialTableColumns(i);
}

const removeLastCondition = () => {
    var _arr = [];
    $("div[id*=dataPlaygroundAttributeFilters_]").each(function () {
        console.log(this.id);
        var _id = this.id.split('_')[1];
        _arr.push(parseInt(_id));
    });
    var _id = Math.max(..._arr);
    console.log(_id);
    //var i = parseInt(_id) + 1;
    if(_id == 1)
        return;
    $("#dataPlaygroundSelectLayerAttributeJoin_" + _id).remove();
    $("#dataPlaygroundAttributeFilters_" + _id).remove();
}

const addLayerButtonPressed = (id) => {
    console.log(id);
    console.log($("#dataPlaygroundAddLayerButton").html());
    var mode = '';
    if($("#dataPlaygroundAddLayerButton").html() == "Add")
        mode = "add";
    if($("#dataPlaygroundAddLayerButton").html() == "Edit")
        mode = "edit";
    addLayerQuery(mode);
}

const addLayerQuery = (mode) => {
    $("div[id*=dataPlaygroundAttributeFilters_]").each(function () {
        console.log(this.id)
        var _id = this.id.split('_')[1];
        if($($("#" + this.id + ">select")[0]).val() != '') {
            sourceLayerAttributesArray.push({
                attribute: $($("#" + this.id).find('select')[0]).val(),
                operator: $($("#" + this.id).find('select')[1]).val(),
                value: $($("#" + this.id).find('input')[0]).val(),
                join: $("#dataPlaygroundSelectLayerAttributeJoin_" + _id).val()
            });
        }
    });

    if(mode == 'edit')
        layersAddedInTheFilterArray.splice(layersAddedInTheFilterArray.findIndex(item => item.layerName === $("#dataPlaygroundSelectLayer").val()), 1);
    

    $("#dataPlaygroundSelectLayerBox").hide();
    if (layersAddedInTheFilterArray.length == 0 || layersAddedInTheFilterArray.every(e => e.layerName != $("#dataPlaygroundSelectLayer").val())) {
        layersAddedInTheFilterArray.push({
            layerId: generateUUID(),
            layerName: $("#dataPlaygroundSelectLayer").val(),
            layerAttributesArray: sourceLayerAttributesArray,
            layerOperator: null
        });
    }
    
    sourceLayerAttributesArray = [];
    $("#queryStructure").empty();
    layersAddedInTheFilterArray.forEach((layerItem, j) => {
        var _whereItem = '';
        layerItem.layerAttributesArray.forEach((queryItem) => {
            var _join = queryItem.join == undefined? "" : queryItem.join;
            _whereItem += _join + " <label class='spatial-filter-attribute'>" + queryItem.attribute + "</label> " 
                                + " <label class='spatial-filter-operator'>" + queryItem.operator + "</label> " 
                                + " <label class='spatial-filter-value'>" + queryItem.value + "</label></br>";
        });
        var sourceLayer = "</br>Layer: <b class='spatial-filter-layername'>" + layerItem.layerName
        + "<i id='" + layerItem.layerId + "' class='fa fa-gear spatial-filter-edit' aria-hidden='true' onclick='editSpatialLayer(this.id)'></i> </b></br> " 
        + _whereItem;
        console.log(sourceLayer);
        
        if(j == 1) {
            $("#queryStructure").append(
                '</br>'
            +   '<select id="dataPlaygroundSelectLayersAttributeOperator" class="form-select panel-components">'
            +       '<option value="INTERSECTS">INTERSECTS</option>'
            +       '<option value="OVERLAPS">OVERLAPS</option>'
            +       '<option value="CROSSES">CROSSES</option>'
            +       '<option value="CONTAINS">CONTAINS</option>'
            +       '<option value="TOUCHES">TOUCHES</option>'
            +   '</select>'
            );
        }
        $("#queryStructure").append(sourceLayer);
    });
    if(layersAddedInTheFilterArray.length > 1)
        layersAddedInTheFilter++;
}

const editSpatialLayer = (layersAddedInTheFilterId) => {
	$("#dataPlaygroundSelectLayerBox").show();
    //getspatiallayers();
    $("div[id*=dataPlaygroundAttributeFilters_]").each(function () {
        var _id = this.id.split('_')[1];
        if(_id != 1) {
            $("#" + this.id).remove();
        }
        $("#dataPlaygroundSelectLayerAttributeJoin_" + _id).remove();
    });
    $("#dataPlaygroundSelectLayerAttribute_1 option[value!='']").remove();
    $("#dataPlaygroundSelectLayerAttribute_1").val('');
    $("#dataPlaygroundSelectLayerAttributeOperator_1").val('');
    $("#dataPlaygroundSelectLayerAttributeValue_1").val('');

    console.log(layersAddedInTheFilterId);
    var filterLayerObject = layersAddedInTheFilterArray.filter((x) => x.layerId == layersAddedInTheFilterId);
    
    $("#dataPlaygroundSelectLayer").val(filterLayerObject[0].layerName);
    var attributesArray = layerAttributesArray.filter((x) => x.layer == filterLayerObject[0].layerName);
    console.log(attributesArray[0].attributes);
    filterLayerObject[0].layerAttributesArray.forEach((filterItem, i) => {
        console.log(i, filterItem.attribute, filterItem.operator, filterItem.value, filterItem.join);
        if(i > 0)
            addMoreCondition({loadCombo :false});
        var id = i;
        id++;
        //$("#dataPlaygroundSelectLayerAttribute_" + id).append('<option value="">Select</option>');
        attributesArray[0].attributes.forEach((attributeItem) => {
            $("#dataPlaygroundSelectLayerAttribute_" + id).append('<option value="' + attributeItem + '">' + attributeItem + '</option>');
        })
        if(filterItem.join != undefined) {
            $("#dataPlaygroundSelectLayerAttributeJoin_" + id).val(filterItem.join);
        }
        $("#dataPlaygroundSelectLayerAttribute_" + id).val(filterItem.attribute);
        $("#dataPlaygroundSelectLayerAttributeOperator_" + id).val(filterItem.operator);
        $("#dataPlaygroundSelectLayerAttributeValue_" + id).val(filterItem.value);
        
    });
    $("#dataPlaygroundAddLayerButton").html("Edit");
}

const getStyle = (type) => {
    if(type == 'Point') {
        return new ol.style.Style({
            image: new ol.style.Circle({
                radius: 5,
                fill: null,
                stroke: new ol.style.Stroke({color: 'red', width: 1}),
              }),
        })
    }
    if(type == 'Polygon' || type == 'MultiPolygon') {
        return new ol.style.Style({
            stroke: new ol.style.Stroke({
              color: 'red',
              width: 1,
            }),
            fill: new ol.style.Fill({
              color: 'rgba(255, 255, 0, 0.7)',
            }),
        })
    }
}

const getAdminHighlightStyle = (type) => {
    if(type == 'Point') {
        return new ol.style.Style({
            image: new ol.style.Circle({
                radius: 5,
                fill: null,
                stroke: new ol.style.Stroke({color: 'red', width: 1}),
              }),
        })
    }
    if(type == 'Polygon' || type == 'MultiPolygon') {
        return new ol.style.Style({
            stroke: new ol.style.Stroke({
              color: 'red',
              width: 1,
            }),
            fill: new ol.style.Fill({
              color: 'rgba(163, 228, 215, 0.7)',
            }),
        })
    }
	if(type == 'ReportsPolygon') {
        return new ol.style.Style({
            stroke: new ol.style.Stroke({
              color: 'black',
              width: 2,
            }),
            fill: null,
        })
    }
}

const resetSpatialQuery = () => {
    map.getLayers().forEach(function (layer) {
        if(layer.get('name') == "spatialQueryLayer") {
            map.removeLayer(layer);
        }
    });
    spatialQueryGeojsonObject = '';
    sourceLayerAttributesArray = [];
    $("#queryStructure").empty();

    // Clear the popup template
    $("div[id*=dataPlaygroundAttributeFilters_]").each(function () {
        var _id = this.id.split('_')[1];
        if(_id != 1) {
            $("#" + this.id).remove();
        }
        $("#dataPlaygroundSelectLayerAttributeJoin_" + _id).remove();
    });
    $("#dataPlaygroundSelectLayerAttribute_1 option[value!='']").remove();
    $("#dataPlaygroundSelectLayerAttribute_1").val('');
    $("#dataPlaygroundSelectLayerAttributeOperator_1").val('');
    $("#dataPlaygroundSelectLayerAttributeValue_1").val('');
    layersAddedInTheFilter = 0;
    layersAddedInTheFilterArray = [];
}

const runSpatialQuery = () => {
    if(layersAddedInTheFilterArray.length == 0){
        return;
    }
    var sourceSpatialLayer = [];
    var targetSpatialLayers = [];
    layersAddedInTheFilterArray.forEach((layerItem, i) => {
        if(i == 0) {
            sourceSpatialLayer.push({
                sourceLayer: layerItem.layerName,
                sourceLayerAttributes: JSON.stringify(layerItem.layerAttributesArray)
            });
        }
        else {
            targetSpatialLayers.push({
                targetLayer: layerItem.layerName,
                targetLayerAttributes: JSON.stringify(layerItem.layerAttributesArray),
                spatialOperator: $("#dataPlaygroundSelectLayersAttributeOperator").val()
            });
        }
    })
    console.log(sourceSpatialLayer);
    console.log(targetSpatialLayers);
    var json = {
        sourceLayer: sourceSpatialLayer[0].sourceLayer,
        sourceLayerBuffer: 50,//SpatialQuery.bufferOptionEnabled ? bufferValue : null,
        sourceLayerBufferUnits: "",//Ext.getCmp('bufferDistanceUnits').getValue(),
        sourceLayerAttributes: sourceSpatialLayer[0].sourceLayerAttributes,//SpatialQuery.sourceAttributesOptionEnabled ? JSON.stringify(SpatialQuery.sourceAttributesFilterArray) : null,
        //operateOnMultipleLayers: false,
        //mergeBuffers: true,
        target: JSON.stringify(targetSpatialLayers),
        srs: parseInt(map.getView().getProjection().getCode().split(":")[1])
    };
    $("#queryBuilderButton").find(".spinner-border-sm").show();
    $.ajax({
        type: "POST",
        url: dataPlaygroundRunSpatialQuery,
        data: JSON.stringify(json),
        //timeout: 1000 * 60 * 10,
        success: function (result) {
            $("#queryBuilderButton").find(".spinner-border-sm").hide();
            var points = true;
            var geomType = JSON.parse(result.data[0].st_asgeojson).type;
            if(geomType != undefined && geomType == 'Point') {
                var featuresArray = [];
                const iconStyle = new ol.style.Style({
                    image: new ol.style.Icon({
                        anchor: [0.5, 46],
                        anchorXUnits: 'fraction',
                        anchorYUnits: 'pixels',
                        src: '../media/img/dp-icons/icon.png'
                        //src: '/icon.png'
                    }),
                });

                result.data.forEach((item) => {
                    var coordinates = JSON.parse(item.st_asgeojson).coordinates;
                    const feature = new ol.Feature({
                        geometry: new ol.geom.Point([coordinates[0], coordinates[1]])
                    });
                    feature.setStyle(iconStyle);
                    featuresArray.push(feature);
                });

                console.log(featuresArray);

                const vectorSource = new ol.source.Vector({
                    features: [],
                });
                vectorSource.addFeatures(featuresArray);
                
                const vectorLayer = new ol.layer.Vector({
                    name: 'spatialQueryLayer',
                    source: vectorSource,
                });

                map.getLayers().forEach(function (layer) {
                    if(layer != undefined) {
                        if(layer.get('name') == "spatialQueryLayer") {
                            map.removeLayer(layer);
                        }
                    }
                });
                map.addLayer(vectorLayer);
            }
            else {
                spatialQueryGeojsonObject = {
                    'type': 'FeatureCollection',
                    'crs': {
                      'type': 'name',
                      'properties': {
                        'name': 'EPSG:' + map.getView().getProjection().getCode().split(":")[1],
                      },
                    },
                    'features': []
                }
                result.data.forEach((item) => {
                    //console.log(item.st_asgeojson);
                    var geometry = JSON.parse(item.st_asgeojson);
                    //console.log("Style: " + geometry.type);
                    spatialQueryGeojsonObject.features.push({
                        'type': 'Feature',
                        'geometry': geometry
                        //'properties': item.properties
                    });
    
                    const vectorSource = new ol.source.Vector({
                        features: new ol.format.GeoJSON().readFeatures(spatialQueryGeojsonObject)
                    }); 
                
                    const vectorLayer = new ol.layer.Vector({
                        source: vectorSource,
                        name: 'spatialQueryLayer',
                        style: getStyle(geometry.type)
                    });
                    map.getLayers().forEach(function (layer) {
                        if(layer.get('name') == "spatialQueryLayer") {
                            map.removeLayer(layer);
                        }
                    });
                    map.addLayer(vectorLayer);
                });
            }
        },
        error: function (error) {

        }
    });
}


/**
 * Admin Boundaries Scripts
 */
 
var geometryIndicator = '';
var geometrySelected = '';
var countriesArray = [];
const showCountryGeometry = (el) => {
	var extents;
	if($("#countriesCombo").val() == '')
		return;
	$($($(el).children(0))[0]).show();
	countriesArray.forEach((item) => {
		if(item.sp_name == $("#countriesCombo").val()) {
			extents = item.sp_extents.replace('BOX(','').replace(')','');
		}
	});
	extentsArr = extents.split(',');
	var minx = parseFloat(extentsArr[0].split(' ')[0]);
	var miny = parseFloat(extentsArr[0].split(' ')[1]);
	var maxx = parseFloat(extentsArr[1].split(' ')[0]);
	var maxy = parseFloat(extentsArr[1].split(' ')[1]);
	console.log(minx, miny, maxx, maxy);
	map.getView().fit([minx, miny, maxx, maxy] , map.getSize());
	$($($(el).children(0))[0]).hide();
}

const showStatesGeometry = (el) => {
	if($($(el).parent().parent()).find('select').val() == '')
		return;
	$($($(el).children(0))[0]).show();
    layerDataProjection = 'EPSG:4326';
    geometryIndicator = 'state';
    getBoundaryGeometry($("#statesCombo").val(), el);
}

const showDistrictsGeometry = (el) => {
	if($($(el).parent().parent()).find('select').val() == '')
		return;
	$($($(el).children(0))[0]).show();
    layerDataProjection = 'EPSG:4326';
    geometryIndicator = 'district';
    getBoundaryGeometry($("#districtsCombo").val(), el);
}

const showSubDistrictsGeometry = (el) => {
	if($($(el).parent().parent()).find('select').val() == '')
		return;
	$($($(el).children(0))[0]).show();
    layerDataProjection = 'EPSG:4326';
    geometryIndicator = 'subdistrict';
    getBoundaryGeometry($("#subDistrictsCombo").val(), el);
}

const showBlocksGeometry = (el) => {
	if($($(el).parent().parent()).find('select').val() == '')
		return;
	$($($(el).children(0))[0]).show();
    layerDataProjection = 'EPSG:4326';
    geometryIndicator = 'block';
    getBoundaryGeometry($("#blocksCombo").val(), el);
}

const loadCountries = () => {
	var data = {
		srs: 3857
	};
	fetch(getCountriesURL,
    {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
    })
    .then(function(res) { return res.json(); })
    .then(function(data) {
		countriesArray = data.data;
        data.data.forEach((item) => {
            $("#countriesCombo").append('<option value="' + item.sp_name + '">' + item.sp_name + '</option>');
        })
    })
}

const loadStates = (country_name) => {
	if(country_name != "India") {
		$("#statesCombo").empty().append('<option value="">Select States</option>');
		$('#districtsCombo').empty().append('<option value="">Select Districts</option>');
		$('#subDistrictsCombo').empty().append('<option value="">Select Sub Districts</option>');
		$('#blocksCombo').empty().append('<option value="">Select Blocks</option>');
		geometryIndicator = '';
		geometrySelected = '';
		map.getLayers().forEach(function (layer) {
			if(layer != undefined) {
				if(layer.get('name') == "wktLayer") {
					map.removeLayer(layer);
				}
			}
		});
		return;
	}
    fetch(getStatesURL,
    {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        //body: JSON.stringify(data)
    })
    .then(function(res) { return res.json(); })
    .then(function(data) {
        data.text.forEach((item) => {
            $("#statesCombo").append('<option value="' + item.lid + '">' + item.name + '</option>');
        })
    })
}

const loadDistricts = (state_id) => {
    console.log(state_id)
    $("#adminSearchPanelLoader").show();
    var data = {
		state_id
	};
    fetch(getDistrictsURL,
    {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
    })
    .then(function(res) { return res.json(); })
    .then(function(data) {
        $("#adminSearchPanelLoader").hide();
        $('#districtsCombo').empty().append('<option value="">Select Districts</option>');
        $('#subDistrictsCombo').empty().append('<option value="">Select Sub Districts</option>');
        $('#blocksCombo').empty().append('<option value="">Select Blocks</option>');
        data.text.forEach((item) => {
            $("#districtsCombo").append('<option value="' + item.id + '">' + item.name + '</option>');
        })
    })
}

const loadSubDistricts = (district_id) => {
    console.log(district_id)
    $("#adminSearchPanelLoader").show();
    var data = {
		district_id
	};
    fetch(getSubDistrictsURL,
    {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
    })
    .then(function(res) { return res.json(); })
    .then(function(data) {
        $("#adminSearchPanelLoader").hide();
        $('#subDistrictsCombo').empty().append('<option value="">Select Sub Districts</option>');
        data.text.forEach((item) => {
            $("#subDistrictsCombo").append('<option value="' + item.id + '">' + item.name + '</option>');
        })
    })
}

const loadBlocks = (district_id) => {
    console.log(district_id)
    $("#adminSearchPanelLoader").show();
    var data = {
		district_id
	};
    fetch(getBlocksURL,
    {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
    })
    .then(function(res) { return res.json(); })
    .then(function(data) {
        $("#adminSearchPanelLoader").hide();
        $('#blocksCombo').empty().append('<option value="">Select Blocks</option>');
        data.text.forEach((item) => {
            $("#blocksCombo").append('<option value="' + item.id + '">' + item.name + '</option>');
        })
    })
}

var geometrySelectedFeature = null;
const getBoundaryGeometry = (region_id, el) => {
	if(region_id == '')
		return;
    var data = {
		region_id
	};
    $("#adminSearchPanelLoader").show();
    fetch(getBoundaryGeometryURL,
    {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
    })
    .then(function(res) { return res.json(); })
    .then(function(data) {
        $("#adminSearchPanelLoader").hide();
		$($($(el).children(0))[0]).hide();
        data.text.forEach((item) => {

			const format = new ol.format.WKT();

			const feature = format.readFeature(item.geometry, {
				dataProjection: layerDataProjection,
				featureProjection: 'EPSG:3857',
			});
			geometrySelectedFeature = feature.getGeometry();
			
			const wktLayer = new ol.layer.Vector({
				name: 'wktLayer',
				source: new ol.source.Vector({
				features: [feature],
				}),
				style: getAdminHighlightStyle("Polygon")
			});
			map.getLayers().forEach(function (layer) {
				if(layer != undefined) {
					if(layer.get('name') == "wktLayer") {
						map.removeLayer(layer);
					}
				}
			});
			map.addLayer(wktLayer);
			geometrySelected = item.geometry;
			geometryMaskId = item.source_id;
			selectedGeometryCoordinates = [];
			var coord1 = ol.proj.transform([parseFloat(item.xmin), parseFloat(item.ymin)], layerDataProjection, 'EPSG:' + map.getView().getProjection().getCode().split(":")[1]);
			var coord2 = ol.proj.transform([parseFloat(item.xmax), parseFloat(item.ymax)], layerDataProjection, 'EPSG:' + map.getView().getProjection().getCode().split(":")[1]);
			selectedGeometryCoordinates.push(coord1[0]);
			selectedGeometryCoordinates.push(coord1[1]);
			selectedGeometryCoordinates.push(coord2[0]);
			selectedGeometryCoordinates.push(coord2[1]);
			if($("#zoomToFeature").is(":checked")) {
				map.getView().fit([coord1[0], coord1[1], coord2[0], coord2[1]] , map.getSize());
			}
        })
    })
}

const resetAdminBoundaryFilter = () => {
	$("#countriesCombo").val('');
    $("#statesCombo").empty().append('<option value="">Select States</option>');
    $('#districtsCombo').empty().append('<option value="">Select Districts</option>');
    $('#subDistrictsCombo').empty().append('<option value="">Select Sub Districts</option>');
    $('#blocksCombo').empty().append('<option value="">Select Blocks</option>');
    geometryIndicator = '';
    geometrySelected = '';
    map.getLayers().forEach(function (layer) {
        if(layer != undefined) {
            if(layer.get('name') == "wktLayer") {
                map.removeLayer(layer);
            }
        }
    });
}


/**
 * Spatial Data Upload Scripts
 */

const uploadShapeFile = () => {
    var uploadShapeFileFormData = new FormData($('#uploadShapeFileForm')[0]);
	console.log(uploadShapeFileFormData);
    if($("#shapeFileInput").val() == '')
        return;
    $("#uploadShapeFileButton").find(".spinner-border-sm").show();
    $.ajax({
        type: 'POST',
        url : uploadShapeFileURL,
        data: uploadShapeFileFormData,
        dataType: 'json',
        contentType: false,
        processData: false,            
        success: function(d) {
            if(d.status == "SUCCESS") {
                var vectorSource = new ol.source.Vector({
                    features: new ol.format.GeoJSON().readFeatures(d.geometry)
                });
                $("#uploadShapeFileButton").find(".spinner-border-sm").hide();
                var geom = [];
                vectorSource.forEachFeature( function(feature) { geom.push(new ol.Feature(feature.getGeometry().clone().transform('EPSG:4326', 'EPSG:3857'))); } );
                var writer = new ol.format.GeoJSON();
                var geoJsonStr = writer.writeFeatures(geom);
                console.log(geoJsonStr);
				if($("#searchWithinShapefile").is(":checked")) {
					geometrySelected = geoJsonStr;
				}

                const vectorSource1 = new ol.source.Vector({
                    features: new ol.format.GeoJSON().readFeatures(geoJsonStr),
                    //features: writer.readFeatures(geoJsonStr),
                    projection: 'EPSG:3857'
                }); 
                
                const vectorLayer = new ol.layer.Vector({
                    source: vectorSource1,
                    name: 'uploadedShapefileLayer'
                });
                map.getLayers().forEach(function (layer) {
                    if(layer.get('name') == "uploadedShapefileLayer") {
                        map.removeLayer(layer);
                    }
                });
                map.addLayer(vectorLayer);
                map.getView().fit(vectorSource1.getExtent());
                console.log("Added")
            }
        },
        error: function(e) {
            
        }
    });
}

const uploadGeoJSONFile = () => {
    var uploadGeoJSONFormData = new FormData($('#uploadGeoJSONForm')[0]);
    if($("#geojsonFileInput").val() == '')
        return;
    $("#uploadGeoJSONFileButton").find(".spinner-border-sm").show();
    $.ajax({
        type: 'POST',
        url : uploadGeoJSONURL,
        data: uploadGeoJSONFormData,
        dataType: 'json',
        contentType: false,
        processData: false,            
        success: function(d) {
            if(d.status == "SUCCESS") {
                var vectorSource = new ol.source.Vector({
                    features: new ol.format.GeoJSON().readFeatures(d.geometry)
                });
                $("#uploadGeoJSONFileButton").find(".spinner-border-sm").hide();
                var geom = [];
                vectorSource.forEachFeature( function(feature) { geom.push(new ol.Feature(feature.getGeometry().clone().transform('EPSG:4326', 'EPSG:3857'))); } );
                var writer = new ol.format.GeoJSON();
                var geoJsonStr = writer.writeFeatures(geom);
                console.log(geoJsonStr);

				if($("#searchWithinGeojson").is(":checked")) {
					geometrySelected = geoJsonStr;
				}
				
                const vectorSource1 = new ol.source.Vector({
                    features: new ol.format.GeoJSON().readFeatures(geoJsonStr),
                    //features: writer.readFeatures(geoJsonStr),
                    projection: 'EPSG:3857'
                }); 
                
                const vectorLayer = new ol.layer.Vector({
                    source: vectorSource1,
                    name: 'uploadedGeoJSONLayer'
                });
                map.getLayers().forEach(function (layer) {
                    if(layer.get('name') == "uploadedGeoJSONLayer") {
                        map.removeLayer(layer);
                    }
                });
                map.addLayer(vectorLayer);
                map.getView().fit(vectorSource1.getExtent());
                console.log("Added")
            }
        },
        error: function(e) {
            
        }
    });
}

const uploadKMLFile = () => {
    var uploadKMLFormmData = new FormData($('#uploadKMLForm')[0]);
    if($("#kmlFileInput").val() == '')
        return;
    $("#uploadKMLFileButton").find(".spinner-border-sm").show();
    $.ajax({
        type: 'POST',
        url : uploadKMLURL,
        data: uploadKMLFormmData,
        dataType: 'json',
        contentType: false,
        processData: false,            
        success: function(d) {
            if(d.status == "SUCCESS") {
                var vectorSource = new ol.source.Vector({
                    features: new ol.format.GeoJSON().readFeatures(d.geometry)
                });
                $("#uploadKMLFileButton").find(".spinner-border-sm").hide();
                var geom = [];
                vectorSource.forEachFeature( function(feature) { geom.push(new ol.Feature(feature.getGeometry().clone().transform('EPSG:4326', 'EPSG:3857'))); } );
                var writer = new ol.format.GeoJSON();
                var geoJsonStr = writer.writeFeatures(geom);
                console.log(geoJsonStr);
				if($("#searchWithinKML").is(":checked")) {
					geometrySelected = geoJsonStr;
				}

                const vectorSource1 = new ol.source.Vector({
                    features: new ol.format.GeoJSON().readFeatures(geoJsonStr),
                    //features: writer.readFeatures(geoJsonStr),
                    projection: 'EPSG:3857'
                }); 
                
                const vectorLayer = new ol.layer.Vector({
                    source: vectorSource1,
                    name: 'uploadedKMLLayer'
                });
                map.getLayers().forEach(function (layer) {
                    if(layer.get('name') == "uploadedKMLLayer") {
                        map.removeLayer(layer);
                    }
                });
                map.addLayer(vectorLayer);
                map.getView().fit(vectorSource1.getExtent());
                console.log("Added")
            }
        },
        error: function(e) {
            
        }
    });
}

const clearUploadedData = () => {
	geometrySelected = '';
	var checkboxes = ['searchWithinShapefile', 'searchWithinGeojson', 'searchWithinKML'];
	checkboxes.forEach((checkBox) => {
		$("#" + checkBox).prop("checked", false);
	});
    $("#shapeFileInput, #geojsonFileInput, #kmlFileInput").val('');
    map.getLayers().forEach(function (layer) {
        if(layer.get('name') == "uploadedKMLLayer" || layer.get('name') == "uploadedGeoJSONLayer" || layer.get('name') == "uploadedShapefileLayer") {
            map.removeLayer(layer);
        }
    });
}


/**
 * Print to PDF Script
 */

const dims = {
    a0: [1189, 841],
    a1: [841, 594],
    a2: [594, 420],
    a3: [420, 297],
    a4: [297, 210],
    a5: [210, 148],
};

  // export options for html2canvase.
  // See: https://html2canvas.hertzen.com/configuration
const exportOptions = {
    useCORS: true,
    ignoreElements: function (element) {
      const className = element.className || '';
      return !(
        className.indexOf('ol-control') === -1 ||
        className.indexOf('ol-scale') > -1 ||
        (className.indexOf('ol-attribution') > -1 &&
          className.indexOf('ol-uncollapsible'))
      );
    },
};

const printToPDF = () => {
    document.body.style.cursor = 'progress';

    const orientation = document.getElementById('template-settings-orientation').value;
    const format = document.getElementById('template-settings-format').value;
    const resolution = document.getElementById('template-settings-resolution').value;
    //var scale = document.getElementById('template-settings-scale').value;
    const title = document.getElementById('template-settings-title').value;
    const title_position = document.getElementById('template-settings-title-position').value;
    const title_fontSize = document.getElementById('template-settings-font-size').value

    const subtitle = document.getElementById('template-settings-subtitle').value;
    const subtitle_fontSize = document.getElementById('template-settings-subtitle-font-size').value;
    const north_arrow_position = document.getElementById('template-settings-north-arrow-position').value;
    const ibis_logo_position = $("#template-settings-ibis-logo-position").is(':checked');
    
	console.log("Saving...");
	$("#exportMapButton").find(".spinner-border-sm").show();
	console.log(scale);
	var INCHES_PER_UNIT = {
	  'm': 39.37,
	  'dd': 4374754
	};
	var DOTS_PER_INCH = 72;
	var scale = INCHES_PER_UNIT[map.getView().getProjection().getUnits()] * DOTS_PER_INCH * map.getView().getResolution();
	scale = scale/1000;
	console.log("Scale: " + scale);

    var dim = dims[format];
    dim = orientation == 'portrait' ? dim.reverse() : dim;
    const w = dim[0] - 10;
    const h = dim[1] - 10;
    const width = Math.round((w * resolution) / 25.4);
    const height = Math.round((h * resolution) / 25.4);
    const viewResolution = map.getView().getResolution();
    const scaleResolution =
      scale /
      ol.proj.getPointResolution(
        map.getView().getProjection(),
        resolution / 25.4,
        map.getView().getCenter()
      );

    map.once('rendercomplete', function () {
      exportOptions.width = width;
      exportOptions.height = height;
      html2canvas(map.getViewport(), exportOptions).then(function (canvas) {
        const pdf = new jspdf.jsPDF(orientation, undefined, format);
        
        console.log(w, h, dim[0], dim[1]);

        // Create borders
        pdf.setLineWidth(0.5);
        pdf.line(4.5, 4.5, w + 5.5, 4.5);
        pdf.line(w+5.5, 4.5, w+5.5, h+5.5);
        pdf.line(w+5.5, h+5.5, 4.5, h+5.5);
        pdf.line(4.5, h+5.5, 4.5, 4.5);

        // Add Image
        pdf.addImage(canvas.toDataURL('image/jpeg'), 'JPEG', 5, 5, w, h);

        // Add Title
        pdf.setFontSize(title_fontSize);
        var startingPosition = 10;
        if(title_position == 'left'){
            startingPosition = 10;
        }
        if(title_position == 'center'){
            startingPosition = w/2;
        }
        if(title_position == 'right'){
            startingPosition = w-5;
        }
        pdf.text(title, startingPosition, 15, null, null, title_position);
        

        // Add Sub title
        pdf.setFontSize(subtitle_fontSize);
        pdf.text(subtitle, startingPosition, 20, null, null, title_position);

        // Add North Arrow
        if(north_arrow_position == 'topleft'){
            position = 10;
            pdf.addImage("../media/img/dp-icons/north-arrow.png", "PNG", position, 10, 15, 15);
        }
        if(north_arrow_position == 'topright'){
            position = w-15;
            pdf.addImage("../media/img/dp-icons/north-arrow.png", "PNG", position, 10, 15, 15);
        }
        if(north_arrow_position == 'bottomleft'){
            position = 10;
            pdf.addImage("../media/img/dp-icons/north-arrow.png", "PNG", position, h-20, 15, 15);
        }
        if(north_arrow_position == 'bottomright'){
            position = w-15;
            pdf.addImage("../media/img/dp-icons/north-arrow.png", "PNG", position, h-15, 15, 15);
        }
        
        // Add IBIS Logo
        pdf.addImage("../media/img/logo/ib_logo.png", "PNG", w/2, h-15, 20, 12);


        // Add static content
        pdf.setFontSize(8);
        pdf.text("Coordinate System: GCS WGS 1984", 6, h-2, null, null, 'left');
        pdf.text("Datum WGS 1984", 6, h+1, null, null, 'left');
        pdf.text("Units: Degree", 6, h+4, null, null, 'left');
        pdf.text("Not to scale", 5, h+9, null, null, 'left');
        pdf.text("Internal use only", w/2, h+9, null, null, 'center');
        pdf.text("Not for sale", w+5, h+9, null, null, 'right');
		
		console.log("Saved");
		$("#exportMapButton").find(".spinner-border-sm").hide();
        pdf.save('map.pdf');
        // Reset original map size
        scaleLine.set('dpi', 96, false)
        //map.getTargetElement().style.width = initialWidth + 'px';
		//map.getTargetElement().style.height = initialHeight + 'px';
		map.getTargetElement().style.width = '100%';
		map.getTargetElement().style.height = '100%';
		console.log("After: ", initialHeight, initialWidth);
        map.updateSize();
        map.getView().setResolution(viewResolution);
        //exportButton.disabled = false;
        document.body.style.cursor = 'auto';
      });
    });
	
	// Get initial map size
	var size = map.getSize();
	var initialHeight = size[1];
	var initialWidth = size[0];
	console.log("Before: ", initialHeight, initialWidth);
	
    // Set print size
    scaleLine.set('dpi', parseInt(resolution), false)

    map.getTargetElement().style.width = width + 'px';
    map.getTargetElement().style.height = height + 'px';
	//map.getTargetElement().style.width = '100%';
    //map.getTargetElement().style.height = '100%';
    map.updateSize();
    map.getView().setResolution(viewResolution);
	
	// Legend thing
	
	//$("#dashboardmap").append('<div><img style="position: absolute; bottom: -648px;" id="legend"/></div>');
	//const img = document.getElementById('legend');
	//img.src = layerURL + "service=WMS&version=1.1.0&request=GetLegendGraphic&width=20&height=20&layer=" + layerName + "&srcwidth=768&srcheight=330&srs=EPSG:4326&format=image/png&transparent=true&legend_options=fontAntiAliasing:true";
	//https://data.altztech.com/geoserver/wms?service=WMS&version=1.1.0&request=GetLegendGraphic&width=20&height=20&layer=FES:aves&srcwidth=768&srcheight=330&srs=EPSG:4326&format=image/png&legend_options=fontAntiAliasing:true
	
	
	
}

const generateLegends = () => {
    // Need more improvisation for WMS varieties.
    var arr = [];
    map.getLayers().forEach((item)=> {
        if(item.get('source') != undefined) {
            console.log(item.get('source').urls[0]);
            $("#legendPlaceHolder").append('<p>' 
            + item.get('name') + '</br>' 
            + '<img src="' + item.get('source').urls[0] + "?REQUEST=GetLegendGraphic&VERSION=1.0.0&FORMAT=image/png&WIDTH=20&HEIGHT=20&LAYER=" + item.get('name') + '"' + '</p>');
            //arr.push(item.get('source').urls[0] + "?REQUEST=GetLegendGraphic&VERSION=1.0.0&FORMAT=image/png&WIDTH=20&HEIGHT=20&LAYER=" + item.get('name'));
        }
    })
}


/**
 * Measurement
 */

let sketch;
let helpTooltipElement;
let helpTooltip;
let measureTooltipElement;
let measureTooltip;
let measureMentDraw;
const continuePolygonMsg = 'Click to continue drawing the polygon';
const continueLineMsg = 'Click to continue drawing the line';
var measureMentVectorArray = [];
var measureMentSource;

const initMeasurementTools = () => {
    map.on('pointermove', pointerMoveHandler);
    map.getViewport().addEventListener('mouseout', function () {
        helpTooltipElement.classList.add('hidden');
    });
    createMeasureTooltip();
    createHelpTooltip();
}

const pointerMoveHandler = function (evt) {
    if (evt.dragging) {
      return;
    }
    /** @type {string} */
    let helpMsg = 'Click to start drawing';
  
    if (sketch) {
        const geom = sketch.getGeometry();
        if (geom instanceof ol.geom.Polygon) {
            helpMsg = continuePolygonMsg;
            helpTooltipElement.innerHTML = helpMsg;
            helpTooltip.setPosition(evt.coordinate);
            helpTooltipElement.classList.remove('hidden');
        } else if (geom instanceof ol.geom.LineString) {
            helpMsg = continueLineMsg;
            helpTooltipElement.innerHTML = helpMsg;
            helpTooltip.setPosition(evt.coordinate);
            helpTooltipElement.classList.remove('hidden');
        }
    }
};

const formatLength = function (line) {
   const length = ol.sphere.getLength(line);
   let output;
   if (length > 100) {
     output = Math.round((length / 1000) * 100) / 100 + ' ' + 'km';
   } else {
     output = Math.round(length * 100) / 100 + ' ' + 'm';
   }
   return output;
};


 /**
  * Format area output.
  * @param {Polygon} polygon The polygon.
  * @return {string} Formatted area.
  */

 const formatArea = function (polygon) {
   const area = ol.sphere.getArea(polygon);
   let output;
   if (area > 10000) {
     output = Math.round((area / 1000000) * 100) / 100 + ' ' + 'km<sup>2</sup>';
   } else {
     output = Math.round(area * 100) / 100 + ' ' + 'm<sup>2</sup>';
   }
   return output;
 };
 
 function initMeasurement(type) {
    map.removeInteraction(draw);
    map.removeInteraction(measureMentDraw);

    measureMentSource = new ol.source.Vector();
    const measureMentVector = new ol.layer.Vector({
        source: measureMentSource,
        style: new ol.style.Style({
          fill: new ol.style.Fill({
            color: 'rgba(255, 255, 255, 0.2)',
          }),
          stroke: new ol.style.Stroke({
            color: '#ffcc33',
            width: 2,
          }),
          image: new ol.style.Circle({
            radius: 7,
            fill: new ol.style.Fill({
              color: '#ffcc33',
            }),
          }),
        }),
      });

    map.addLayer(measureMentVector);
    measureMentVectorArray.push(measureMentVector);

    measureMentDraw = new ol.interaction.Draw({
     source: measureMentSource,
     type: type,
     style: new ol.style.Style({
       fill: new ol.style.Fill({
         color: 'rgba(255, 255, 255, 0.2)',
       }),
       stroke: new ol.style.Stroke({
         color: 'rgba(0, 0, 0, 0.5)',
         lineDash: [10, 10],
         width: 2,
       }),
       image: new ol.style.Circle({
         radius: 5,
         stroke: new ol.style.Stroke({
           color: 'rgba(0, 0, 0, 0.7)',
         }),
         fill: new ol.style.Fill({
           color: 'rgba(255, 255, 255, 0.2)',
         }),
       }),
     }),
   });
   map.addInteraction(measureMentDraw);
 
   createMeasureTooltip();
   createHelpTooltip();
 
   let listener;
   measureMentDraw.on('drawstart', function (evt) {
     // set sketch
     sketch = evt.feature;
 
     /** @type {import("../src/ol/coordinate.js").Coordinate|undefined} */
     let tooltipCoord = evt.coordinate;
 
     listener = sketch.getGeometry().on('change', function (evt) {
       const geom = evt.target;
       let output;
       if (geom instanceof ol.geom.Polygon) {
         output = formatArea(geom);
         tooltipCoord = geom.getInteriorPoint().getCoordinates();
       } else if (geom instanceof ol.geom.LineString) {
         output = formatLength(geom);
         tooltipCoord = geom.getLastCoordinate();
       }
       measureTooltipElement.innerHTML = output;
       measureTooltip.setPosition(tooltipCoord);
     });
   });
 
    measureMentDraw.on('drawend', function () {
        measureTooltipElement.className = 'ol-tooltip ol-tooltip-static';
        measureTooltip.setOffset([0, -7]);
        // unset sketch
        sketch = null;
        // unset tooltip so that a new one can be created
        helpTooltipElement.innerHTML = "";
        helpTooltipElement.classList.remove('hidden');
        measureTooltipElement = null;
        createMeasureTooltip();
        ol.Observable.unByKey(listener);
   });
 }


 /**
  * Creates a new help tooltip
  */

function createHelpTooltip() {
   if (helpTooltipElement) {
     helpTooltipElement.parentNode.removeChild(helpTooltipElement);
   }
   helpTooltipElement = document.createElement('div');
   helpTooltipElement.className = 'ol-tooltip hidden';
   helpTooltip = new ol.Overlay({
     element: helpTooltipElement,
     offset: [15, 0],
     positioning: 'center-left',
   });
   map.addOverlay(helpTooltip);
 }
 
 /**
  * Creates a new measure tooltip
  */
 function createMeasureTooltip() {
   if (measureTooltipElement) {
     measureTooltipElement.parentNode.removeChild(measureTooltipElement);
   }
   measureTooltipElement = document.createElement('div');
   measureTooltipElement.className = 'ol-tooltip ol-tooltip-measure';
   measureTooltip = new ol.Overlay({
     element: measureTooltipElement,
     offset: [0, -15],
     positioning: 'bottom-center',
     stopEvent: false,
     insertFirst: false,
   });
   map.addOverlay(measureTooltip);
 }
 
 /**
  * Utilities
  */
 
  const generateUUID = () => { // Public Domain/MIT
    var d = new Date().getTime();//Timestamp
    var d2 = ((typeof performance !== 'undefined') && performance.now && (performance.now()*1000)) || 0;//Time in microseconds since page-load or 0 if unsupported
    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
        var r = Math.random() * 16;//random number between 0 and 16
        if(d > 0){//Use timestamp until depleted
            r = (d + r)%16 | 0;
            d = Math.floor(d/16);
        } else {//Use microseconds since page-load if supported
            r = (d2 + r)%16 | 0;
            d2 = Math.floor(d2/16);
        }
        return (c === 'x' ? r : (r & 0x3 | 0x8)).toString(16);
    });
} 
initOpenLayers();

//Dataplayground Login

function validateLoginHandlerDP(submitBtn) {
    const username = getValue("login_username");
    console.log(username);
    const password = getValue("login_password");

    submitBtn.querySelector(".loader").style.display = "inline-block";
    submitBtn.setAttribute("disabled", true);
    if (username.trim() == "") {
        setHtml("login_username_error", "Enter User Id");
        addClass(document.getElementById("login_username"), "input_error");
        setTimeout(function () {
            setHtml("login_username_error", "");
            removeClass(document.getElementById("login_username"), "input_error");
        }, 5000);
        document.getElementById("login_username").focus();
        submitBtn.querySelector(".loader").style.display = "none";
        submitBtn.removeAttribute("disabled");
        return false;
    }
    if (password.trim() == "") {
        setHtml("login_password_error", "Enter Password");
        addClass(document.getElementById("login_password"), "input_error");
        setTimeout(function () {
            setHtml("login_password_error", "");
            removeClass(document.getElementById("login_password"), "input_error");
        }, 5000);
        document.getElementById("login_password").focus();
        submitBtn.querySelector(".loader").style.display = "none";
        submitBtn.removeAttribute("disabled");
        return false;
    }
    var url =  apiUrl+'/Apis/UserLoginAction';
    var otpUrl = apiUrl+'/Home/otpAuth';
    var data = {
        user_id: username,password:password,logintype:'web'
    };
    //alert(JSON.stringify(data)); return false;
    fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
    })
    .then(function (res) {
            return res.text();
        })
    .then(function (data) {
            data = JSON.parse(data);
            //alert(JSON.stringify(data)); return false;
            if (data.success ==1) {
                document.Dlogin_form.submit();
                submitBtn.querySelector(".loader").style.display = "none";
                submitBtn.removeAttribute("disabled");
            }
            else if(data.success ==2){
                window.location.href = otpUrl+'/'+data.user_id;
                submitBtn.querySelector(".loader").style.display = "none";
                submitBtn.removeAttribute("disabled");
                return false;
            }
             else if(data.success ==0){
                setHtml("login_errors", "User does not exist");
                setTimeout(function () {
                    setHtml("login_errors", "");
                }, 3000);
                submitBtn.querySelector(".loader").style.display = "none";
                submitBtn.removeAttribute("disabled");
                return false;
            }
        })
}

const rmCheckDp = document.getElementById("rememberMeDP"),
    UserIdInputDp = document.getElementById("login_usernameDp"),
    PassInputDp = document.getElementById("login_passwordDp");

if (localStorage.checkbox && localStorage.checkbox !== "") {
  if(rmCheckDp !== null) {
  rmCheckDp.setAttribute('checked', 'checked');
  UserIdInputDp.value = localStorage.username;
  PassInputDp.value = localStorage.password;
}
  
} else {
	if(rmCheckDp != null) {
		rmCheckDp.removeAttribute("checked");	
	}
	if(UserIdInputDp != null) {
		UserIdInputDp.value = "";	
	}
	if(PassInputDp != null) {
		PassInputDp.value = "";	
	}
}

function lsRememberMeDp() {
  if (rmCheckDp.checked && UserIdInputDp.value !== "") {
    localStorage.username = UserIdInputDp.value;
    localStorage.password = PassInputDp.value;
    localStorage.checkbox = rmCheckDp.value;
  } else {
    localStorage.username = "";
    localStorage.password = "";
    localStorage.checkbox = "";
  }
}
