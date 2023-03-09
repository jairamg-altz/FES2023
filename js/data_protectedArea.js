var protectedAreaArray = [];
const ProtectedAreaData = () => {
			PTAREAGeojsonObject.features.push({
					type: "Feature",
					geometry: _item.geometry,
					properties: _item.properties,
				});
			// console.log(PTAREAGeojsonObject);

			const vectorSource = new ol.source.Vector({
				features: new ol.format.GeoJSON().readFeatures(PTAREAGeojsonObject),
			});

			const vectorLayer = new ol.layer.Vector({
				source: vectorSource,
				name: "protected Area",
				style: [
					new ol.style.Style({
						image: new ol.style.Circle({
							radius: 8,
							fill: new ol.style.Fill({
								color: [255, 255, 255, 0.3],
							}),
							stroke: new ol.style.Stroke({ color: "#cb1d1d", width: 2 }),
						}),
					}),
				],
			});
			protectedAreasMap.getLayers().forEach(function (layer) {
				if (layer.get("name") != undefined && layer.get("name") == "protected Area") {
					protectedAreasMap.removeLayer(layer);
				}
			});
			protectedAreasMap.addLayer(vectorLayer);

			// Add Pop up
			var container = document.getElementById("popup");
			var content_element = document.getElementById("popup-content");
			var closer = document.getElementById("popup-closer");

			var overlay = new ol.Overlay({
				element: container,
				autoPan: true,
				offset: [0, -10],
				autoPanAnimation: {
					duration: 250,
				},
			});
			protectedAreasMap.addOverlay(overlay);

			/*closer.onclick = function () {
				overlay.setPosition(undefined);
				closer.blur();
				return false;
			};*/

			protectedAreasMap.on("click", function (evt) {
				var feature = protectedAreasMap.forEachFeatureAtPixel(
					evt.pixel,
					function (feature, layer) {
						return feature;
					}
				);
				if (feature) {
					var geometry = feature.getGeometry();
					var coord = geometry.getCoordinates();					
				}
			});

			protectedAreasMap.on("pointermove", function (evt) {
				var hit = this.forEachFeatureAtPixel(
					evt.pixel,
					function (feature, layer) {
						return true;
					}
				);
				if (hit) {
					this.getTargetElement().style.cursor = "pointer";
				} else {
					this.getTargetElement().style.cursor = "";
				}
			});		
};

//getSpeciesLocationUrl
const getprotectedAreaLocation = () => {
	//alert("hello");
    //console.log(scientificName);
    var protectedAreasData;
    fetch(getProtectedAreasUrl,
    {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
            },
        body: JSON.stringify({
            srs: protectedAreasMap.getView().getProjection().getCode().split(":")[1],
            geometry: '',
            geometrysrs: '4326'
        })
    })
    .then(function(res){ return res.text(); })
    .then(function(data) {
        data = JSON.parse(data);
        protectedAreasData = data;
        console.log(data);
	ProtectedAreaLocationPlotter(data);
    });
}

const ProtectedAreaLocationPlotter = (data) => {
    var featuresArray = [];
    const iconStyle = new ol.style.Style({
        image: new ol.style.Icon({
            anchor: [0.5, 46],
            anchorXUnits: 'fraction',
            anchorYUnits: 'pixels',
            src: window.location.href.split('index.php')[0] + '../media/img/dp-icons/icon.png'
        }),
    });

    data.data.forEach((item) => {
            const feature = new ol.Feature({
            geometry: new ol.geom.Point([item.json_row.geometry.coordinates[0], item.json_row.geometry.coordinates[1]]),
            month: item.json_row.properties.month,
            location: item.json_row.properties.location,
            news_topic: item.json_row.properties.news_topic,
            pdf_no: item.json_row.properties.pdf_no,
            snid: item.json_row.properties.snid,
            state: item.json_row.properties.state,
			year: item.json_row.properties.year
            });
            feature.setStyle(iconStyle);
            featuresArray.push(feature);
    });

    const vectorSource = new ol.source.Vector({
        features: [],
    });
    vectorSource.addFeatures(featuresArray);
    
    const vectorLayer = new ol.layer.Vector({
        name: 'protectedAreasLayer',
        source: vectorSource,
    });

    protectedAreasMap.getLayers().forEach(function (layer) {
        if(layer != undefined) {
            if(layer.get('name') == "protectedAreasLayer") {
                protectedAreasMap.removeLayer(layer);
            }
        }
    });
    protectedAreasMap.addLayer(vectorLayer);

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
    protectedAreasMap.addOverlay(overlay);

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

    protectedAreasMap.on('click', function(evt) {
        var feature = protectedAreasMap.forEachFeatureAtPixel(evt.pixel,
            function(feature, layer) {
            return feature;
            });
        if (feature) {
            var geometry = feature.getGeometry();
            var coord = geometry.getCoordinates();
            getProtectedAreaDetails(feature.get('location'));
            /*if(feature.get('name') == undefined)
                return;
            
            $(".ol-popup").show();
            var imageTag = '';
            //if(feature.get('image') != undefined)
                //imageTag = '<img width=60 src=' + feature.get('image') + '></br>';
            var content = imageTag;
			var snid = feature.get('snid');
            content += '<label><b><i>' + feature.get('pdf_no') + '</i></b></label></br>';
            content += '<label>' + feature.get('snid') + '</label></br>';
            content += '<label>' + feature.get('news_topic') + '</label></br>';
            content += '<label>' + feature.get('state') + '</label></br>';
            content += '<label>' + feature.get('month') + '</label></br>';
            content += '<label>' + feature.get('year') + '</label></br>';
			content += '<p><a id="' + location + '" onclick="getProtectedAreaDetails(this.id)" href="#">view more</a></p>';
            //content_element.innerHTML = content;
            overlay.setPosition(coord);
            //popupFanOverlay.setPosition(coord);*/
        }
    });


    protectedAreasMap.on("pointermove", function (evt) {
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

var PTAREAGeojsonObject;
const getptBiome = () => {

	protectedAreasMap.getLayers().forEach(function (layer) {
		if(layer != undefined) {
			if(layer.get('name') == "speciesbiomeLayer") {
				protectedAreasMap.removeLayer(layer);
			}
		}
	});
	
	speciesBiomesSource = new ol.source.ImageWMS({
		url: speciesBiomesWMSUrl,
		params: {
			'LAYERS': speciesBiomesLayerName,
			'CQL_FILTER' : "binomial",
			'FORMAT_OPTIONS': 'layout:legend;countMatched:true;hideEmptyRules:true'
		},
		ratio: 1,
		//format: 'format',
		serverType: 'geoserver',
		transition: 0
	});
	
	speciesBiomesLayer = new ol.layer.Image({
		name: 'speciesbiomeLayer',
		source: speciesBiomesSource
	});
	protectedAreasMap.addLayer(speciesBiomesLayer);
	getprotectedAreaLocation();
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
              color: 'rgba(40, 205, 124, 0.7)',
            }),
        })
    }
}


var geomArray = [];
var protectedAreasMap;
var mapview;
var PTAREAGeojsonObject;
const initOpenPTLayers = () => {
const mousePositionControl = new ol.control.MousePosition({
	coordinateFormat: ol.coordinate.createStringXY(4),
	projection: 'EPSG:4326',
  	// comment the following two lines to have the mouse position
  	// be placed within the protectedAreasMap.
  	// className: 'custom-mouse-position',
  	// target: document.getElementById('mouse-position'),
});

var attribution = new ol.control.Attribution({
		collapsible: false,
	});
	mapview = new ol.View({
		center: ol.proj.fromLonLat([81.0095998, 22.3052918]),
        	maxZoom: 18,
        	zoom: 4,
	});
	protectedAreasMap = new ol.Map({
		controls: ol.control.defaults({ attribution: false }).extend([attribution, mousePositionControl]),
		interactions: ol.interaction.defaults({ mouseWheelZoom: false }),
		layers: [
			new ol.layer.Tile({
				source: new ol.source.OSM(),
			}),
		],
		target: "protectedArea_map",
		view: mapview,
	});
	//getPTLocation();
};

/*var currentPosition = document.getElementById("currentPosition");
const getPTLocation = () => {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(showPosition);
	} else {
		currentPosition.innerHTML = "Geolocation is not supported by this browser.";
	}
};*/
initOpenPTLayers();
$( document ).ready(function() {
   //alert("hello"); return false;
    //getprotectedAreaLocation();
    getptBiome();
});