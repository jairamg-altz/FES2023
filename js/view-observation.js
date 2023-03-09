var geomArray = [];
var viewObservationMap;
var mapview;
var geojsonObject;
var getOccurenceDateTime;
const initOpenLayers = () => {
	var attribution = new ol.control.Attribution({
		collapsible: false,
	});
	mapview = new ol.View({
		center: ol.proj.fromLonLat([4.35247, 50.84673]),
		maxZoom: 18,
		zoom: 2,
		extent: [
			1193621.21746663, -788296.0228458717, 16055425.50101002,
			5082067.749455664,
		],
	});
	viewObservationMap = new ol.Map({
		controls: ol.control
			.defaults({
				attribution: false,
			})
			.extend([attribution]),
		interactions: ol.interaction.defaults({
			mouseWheelZoom: false,
		}),
		layers: [
			new ol.layer.Tile({
				source: new ol.source.OSM(),
			}),
		],
		target: "galleryMap",
		view: mapview,
	});

	viewObservationMap
		.getView()
		.fit(
			[
				1193621.21746663, -788296.0228458717, 16055425.50101002,
				5082067.749455664,
			],
			viewObservationMap.getSize()
		);

	var url_string = window.location.href;
	var checklistid = url_string.split("/").pop();

	if (checklistid == "") getObservations();
	else getObservations(checklistid);

	getLocation();
};
const getObservations = (checkListId) => {
    //alert(checkListId); return false;
    viewObservationMap.getLayers().forEach(function (layer) {
        if (layer.get("name") == "myObservations") {
            viewObservationMap.removeLayer(layer);
        }
    });
    var data;

    const userId = $("#loggedInUserId").val();
 if (checkListId == "")
        data = {
            user_id: userId,
            checklist_id: "",
            srs: parseInt(viewObservationMap.getView().getProjection().getCode().split(":")[1]),
        };
    else
        data = {
            user_id: userId,
            checklist_id: checkListId,
            srs: parseInt(viewObservationMap.getView().getProjection().getCode().split(":")[1]),
        };
		
		fetch(getObservationsForChecklistUrl, {
    //fetch(getObservationUrl, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
    })
        .then(function (res) {
            return res.json();
        })
        .then(function (data) {
			geojsonObject = {
                type: "FeatureCollection",
                crs: {
                    type: "name",
                    properties: {
                        name: "EPSG:3857",
                    },
                },
                features: [],
            };
			data.data.forEach((item)=>{
				item.coordinates = item.sp_long + "," + item.sp_lat
			});
			var unique_coordinates = [...new Set(data.data.map(item => item.coordinates))];
			unique_coordinates.forEach((uniqueitem, i) => {
				var arr = data.data.filter((x) => x.coordinates == uniqueitem);
				console.log(arr);
				geojsonObject.features.push({
					type: "Feature",
					geometry: {
						"type": "Point",
						"coordinates": [uniqueitem.split(',')[0], uniqueitem.split(',')[1]]
					}
				});
				var _properties = {};
				var _id = [];
				var _scientificnames = [];
				var _vernacularname = [];
				arr.forEach((propItem, j)=>{
					_id.push(propItem.sp_observation_id);
					_scientificnames.push(propItem.sp_scientific_name);
					_vernacularname.push(propItem.sp_vernacular_name);
				});
				_properties['id'] = _id.join();
				_properties['scientific_name'] = _scientificnames.join();
				_properties['vernacular_name'] = _vernacularname.join();
				geojsonObject.features[i].properties = _properties;
			});
            console.log(geojsonObject);
            const vectorSource = new ol.source.Vector({
                features: new ol.format.GeoJSON().readFeatures(geojsonObject),
            });

            const vectorLayer = new ol.layer.Vector({

                source: vectorSource,
                name: "myObservations",
                style: [
                    new ol.style.Style({
                        image: new ol.style.Circle({
                            radius: 8,
                            fill: new ol.style.Fill({
                                color: [255, 255, 255, 0.3],
                            }),
                            stroke: new ol.style.Stroke({
                                color: "#cb1d1d",
                                width: 2,
                            }),
                        }),
                    }),
                ],
            });

            viewObservationMap.addLayer(vectorLayer);
			viewObservationMap.getView().fit(vectorSource.getExtent());

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
            viewObservationMap.addOverlay(overlay);

            closer.onclick = function () {
                overlay.setPosition(undefined);
                closer.blur();
                return false;
            };

            viewObservationMap.on("click", function (evt) {
            	
                var feature = viewObservationMap.forEachFeatureAtPixel(
                    evt.pixel,
                    function (feature, layer) {
                        return feature;
                    }
                );
               /// alert(feature);
                if (feature) { 
                    var geometry = feature.getGeometry();
                    var coord = geometry.getCoordinates();
                    var obid = feature.get("id");
					console.log(obid, coord);
					
					var content = '<h6>Click on the species name to view details</h6>';
					var idArray = obid.split(',');
					var scientificNamesArray = feature.get("scientific_name").split(',');
					var vernacularNamesArray = feature.get("vernacular_name").split(',');
					
					idArray.forEach((id, i)=>{
						var srno = i + 1;
						content += '<p><a id=' + id + ' onclick="getObservationDetails(this.id)" href="#">' + srno + '. <b><i>' + scientificNamesArray[i] + '</i></b>, ' + vernacularNamesArray[i] + '</a></p>';
						//content += '<label><b>' + id + ", " + scientificNamesArray[i] + '</b></label></br>';
					});
					
					
					//content += '<label><b>' + feature.get('name') + '</b></label></br>';
					//content += '<label>' + feature.get('kingdom') + '</label></br>';
					//content += '<label>' + feature.get('family') + '</label></br>';
					content_element.innerHTML = content;
					
					overlay.setPosition(coord);
                    //getObservationDetails(obid);
                    return;
                }
            });

            viewObservationMap.on("pointermove", function (evt) {
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
        });
};

const getObservationDetails = (observationId) => {
	//alert(observationId); return false;
	var data = {
		observationId,
	};
	fetch(getObservationDetailsUrl, {
		method: "POST",
		headers: {
			"Content-Type": "application/json",
		},
		body: JSON.stringify(data),
	})
		.then(function (res) {
			return res.json();
		})
		.then(function (data) {
			// console.log(data[0].json_row);
			var obj = data.data[0].json_row;
			//console.log(obj.taxon_id);
			//alert(obj); return false;
			var vernacular = obj.vernacular_name.substring(0,24);
			$("#speciesName").html(`<em>${obj.scientific_name}</em>`);
			let vernacularName = (occurenceDate = author = "");
			if (obj.vernacular_name != "") {
				vernacularName = `<strong>${vernacular}</strong> in ${
					languageStore[obj.language]
				}`;
			}
			/*if (obj.date_time != "") {
				occurenceDate = ` | Occurence <strong>${getOccurenceDateTime(
					obj.date_time
				)}</strong>`;
			}*/
			//console.log(obj);
			if (obj.scientific_name_authorship != "") {
				author = ` | Published by <strong>${obj.scientific_name_authorship}</strong>`;
			}
			$("#observationDetails").html(
				`<p>${vernacularName} | Observed in <strong>${obj.continent}</strong>${occurenceDate}${author}`
			);
			$(".observationDetailsBlock").removeClass("d-none").fadeIn(1000);
			$("#mailCount").html(obj.male_count);
			$("#femailCount").html(obj.female_count);
			$("#childCount").html(obj.child_count);

			$("#taxon_id").html(obj.taxon_id);
			$("#species").html(obj.scientific_name);
			$("#kingdom").html(obj.kingdom);
			$("#phylum").html(obj.phylum);
			$("#class").html(obj.class);
			$("#order").html(obj.order);
			$("#family").html(obj.family);
			$("#subfamily").html(obj.subfamily);
			$("#genus").html(obj.genus);

			//$("#basisOfRecord").html(basisOfRecordStore[obj.basis_of_record]);
			$("#collectionCode").html(obj.collection_code);
			$("#dynamicProperties").html(obj.dynamic_properties);
			$("#institutionCode").html(obj.institution_code);

			$("#occurenceId").html(obj.occurence_id);
			$("#behaviour").html(obj.behaviour);
			$("#individualCount").html(obj.individual_count);
			$("#recordedBy").html(obj.recorded_by);
			//location
			$("#lllId").html(obj.location_id);
			$("#hgid").html(obj.higher_geography_id);
			$("#higgg").html(obj.higher_geography);
			$("#contii").html(obj.continent);
			$("#wwaadd").html(obj.waterbody);
			$("#iiggg").html(obj.island_group);
			$("#cccc").html(obj.country);
			$("#cooggty").html(obj.country_code);
			$("#sppyyy").html(obj.state_province);
			$("#mmunciple").html(obj.municipality);
			$("#lllogg").html(obj.locality);
			$("#mmeeiimm").html(obj.minimum_elevation_in_meters);
			$("#mmaxxeeiimm").html(obj.maximum_elevation_in_meters);
			$("#llaatto").html(obj.location_according_to);
			$("#llrrr").html(obj.location_remarks);
			$("#ccuuim").html(obj.coordinate_uncertainity_in_meters);
			$("#ccpp").html(obj.coordinate_precision);
			$("#oobbid").html(obj.observation_id);
//Event
$("#eventid").html(obj.event_id);
$("#observationid").html(obj.observation_id);
$("#parentevenid").html(obj.parent_event_id);
$("#eventdate").html(obj.event_date);
$("#eventime").html(obj.event_time);
$("#yyear").html(obj.year);
$("#mmonth").html(obj.month);
$("#dayy").html(obj.day);
$("#habitat").html(obj.habitat);
$("#eventemarks").html(obj.event_remarks);
$("#samplingrotocol").html(obj.sampling_protocol);
$("#samplingffort").html(obj.sampling_effort);

			var swiperSourceHTML = "";
			obj.associated_media.split("|").forEach((item, i) => {
				//console.log(item);
				swiperSourceHTML +=
					'<div class="swiper-slide"><img src="' +
					item+
					'" alt="img" width="100%"></div>';
			});

			$("#obs_img_swiper_block").html(swiperSourceHTML);
		});
};

var currentPosition = document.getElementById("currentPosition");
const getLocation = () => {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(showPosition);
	} else {
		currentPosition.innerHTML = "Geolocation is not supported by this browser.";
	}
};

const showPosition = (position) => {
	currentPosition.innerHTML =
		"<b>Latitude</b>: " +
		position.coords.latitude +
		", <b>Longitude</b>: " +
		position.coords.longitude;
};

const inputWMSLayer = () => {
	$("#addWMSLayerDialog").modal("show");
};

const addWMSLayer = () => {
	var layer = new ol.layer.Image({
		extent: [-13884991, 2870341, -7455066, 6338219],
		source: new ol.source.ImageWMS({
			url: $("#wmsServiceURL").val(), //'https://ahocevar.com/geoserver/wms','topp:states'
			params: {
				LAYERS: $("#wmsLayerName").val(),
			},
			ratio: 1,
			//serverType: 'geoserver',
		}),
	});
	viewObservationMap.addLayer(layer);
};

var layerDataProjection;
initOpenLayers();
new Swiper(".obs_img_swiper", {
	speed: 400,
	// loop: true,
	autoplay: {
		delay: 3000,
		disableOnInteraction: false,
		stopOnLastSlide: false,
	},
	pagination: {
		el: ".swiper-pagination",
		type: "bullets",
		clickable: true,
	},
});