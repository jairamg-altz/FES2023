var speciesSuggestionsArray =[];
var captureChecklistMap;
const initMapClickForChecklistCapture = () => {
    $("#captureChecklistMap").empty();
    var attribution = new ol.control.Attribution({
        collapsible: false,
    });
    captureChecklistMap = new ol.Map({
        controls: ol.control.defaults({ attribution: false }).extend([attribution]),
        layers: [
            new ol.layer.Tile({
                source: new ol.source.OSM(),
            }),
        ],
        target: "captureChecklistMap",
        view: new ol.View({
            center: ol.proj.fromLonLat([81.0095998, 22.3052918]),
            maxZoom: 18,
            zoom: 4.5,
        }),
    });
    console.log(captureChecklistMap);

    const source = new ol.source.Vector({ wrapX: false });
    var draw = new ol.interaction.Draw({
        source: source,
        type: "Point",
    });
    captureChecklistMap.addInteraction(draw);

    captureChecklistMap.on("singleclick", function (evt) {
        var pos = ol.proj.transform(evt.coordinate, "EPSG:3857", "EPSG:4326");
		console.log(pos[0], pos[1]);
        $("#checklist_location_latitude").val(pos[1]);
        $("#checklist_location_longitude").val(pos[0]);

        const vectorSource = new ol.source.Vector({
            features: new ol.format.GeoJSON().readFeatures({
                type: "Feature",
                geometry: {
                    coordinates: [evt.coordinate[0], evt.coordinate[1]],
                    type: "Point",
                },
            }),
        });

        captureChecklistMap.getLayers().forEach(function (layer) {
            if (layer.get("name") == "placemarker") {
                captureChecklistMap.removeLayer(layer);
            }
        });

        const vectorLayer = new ol.layer.Vector({
            source: vectorSource,
            name: "placemarker",
            style: [
                new ol.style.Style({
                    image: new ol.style.Circle({
                        radius: 8,
                        fill: new ol.style.Fill({
                            color: [255, 255, 255, 0.3],
                        }),
                        stroke: new ol.style.Stroke({ color: "#FF0000", width: 2 }),
                    }),
                }),
            ],
        });
        captureChecklistMap.addLayer(vectorLayer);
    });
};

var addObservMap;
const initMapClickForObservCapture = () => {
	
    $("#addObservMap").empty();
    var attribution = new ol.control.Attribution({
        collapsible: false,
    });
    addObservMap = new ol.Map({
        controls: ol.control.defaults({ attribution: false }).extend([attribution]),
        layers: [
            new ol.layer.Tile({
                source: new ol.source.OSM(),
            }),
        ],
        target: "addObservMap",
        view: new ol.View({
            center: ol.proj.fromLonLat([81.0095998, 22.3052918]),
            maxZoom: 18,
            zoom: 5,
        }),
    });
    const source = new ol.source.Vector({ wrapX: false });
    var draw = new ol.interaction.Draw({
        source: source,
        type: "Point",
    });
    addObservMap.addInteraction(draw);

    addObservMap.on("singleclick", function (evt) {
        var pos = ol.proj.transform(evt.coordinate, "EPSG:3857", "EPSG:4326");
        var LchV = $(".gId");        
		if(LchV.length === 1)
		{
			$('#location_latitude').val(pos[1]);
			$('#location_longitude').val(pos[0]);
		}
		else{
			$('#location_latitude'+LchV.length).val(pos[1]);
			$('#location_longitude'+LchV.length).val(pos[0]);
		}
        /*$("#location_latitude").val(pos[0]);
        $("#location_longitude").val(pos[1]);*/

        const vectorSource = new ol.source.Vector({
            features: new ol.format.GeoJSON().readFeatures({
                type: "Feature",
                geometry: {
                    coordinates: [evt.coordinate[0], evt.coordinate[1]],
                    type: "Point",
                },
            }),
        });

        addObservMap.getLayers().forEach(function (layer) {
            if (layer.get("name") == "placemarker1") {
                addObservMap.removeLayer(layer);
            }
        });

        const vectorLayer = new ol.layer.Vector({
            source: vectorSource,
            name: "placemarker1",
            style: [
                new ol.style.Style({
                    image: new ol.style.Circle({
                        radius: 8,
                        fill: new ol.style.Fill({
                            color: [255, 255, 255, 0.3],
                        }),
                        stroke: new ol.style.Stroke({ color: "#FF0000", width: 2 }),
                    }),
                }),
            ],
        });
        addObservMap.addLayer(vectorLayer);
    });
};

function calculateTimeSpent() {
	var now = $("#checklist_start_time").val().trim();
	var then = $("#checklist_end_time").val().trim();
	if (now != "" && then != "") {
		var comparison = moment(now, "YYYY-MM-DD HH:mm:ss").isBefore(moment(then, "YYYY-MM-DD HH:mm:ss"));
		if (comparison) {
			var ms = moment(then, "YYYY-MM-DD HH:mm:ss").diff(
				moment(now, "YYYY-MM-DD HH:mm:ss")
			);
			var d = moment.duration(ms);
			var s = Math.floor(d.asHours()) + moment.utc(ms).format(":mm:ss");
			$('#checklist_time_spent').val(s);
		} else {
			setHtml("checklist_end_time_error", "End time should be greater");
			addClass(document.getElementById("checklist_end_time"), "input_error");
			setTimeout(function () {
				setHtml("checklist_end_time_error", "");
				removeClass(
					document.getElementById("checklist_end_time"),
					"input_error"
				);
			}, 5000);
			document.getElementById("checklist_end_time").focus();
		}
	}
}

var cardsCounter = 1;
function addObservationCard() {
	//$("#forms-cards-holder").append()
    $('#cardAppend').append('<div class="col-lg-3 col-md-6">'+$('.formCard:first').html()+'<form id="form_' + ++cardsCounter + '" class="formCard"></form></div>');
}
setTimeout(() => {
	initMapClickForChecklistCapture();
}, 1000);
/*setTimeout(() => {
    initMapClickForObservCapture();
}, 200);*/
const getSpecies = (obj) => {
    $(".addObservationSpeciesNameDropDown").hide();
    $(obj).parent().find(".addObservationSpeciesNameDropDown").show();
    var keyword = obj.value;
    var data = { keyword   };

    $.ajax({

        type: 'POST',        
        url : searchSpeciesCommonNameUrl,
        data: data,
        success: function(data) {
            $(".addObservationSpeciesNameDropDown").empty();
                console.log(data);
                data = JSON.parse(data);	
                if(data.length){
                    data.forEach((item)=>{
                        if(item.sp_rank != null && item.sp_status != null) {
                        $(obj).parent().find(".addObservationSpeciesNameDropDown").append('<a id="' + item.sp_col_id + ':' + item.sp_common_name +'" href="javascript:void(0);" onclick="selectSpecies(this.id,this)">' + item.sp_common_name + ' <b><i style="color: #2a9dff">' + item.sp_scientific_name + '</i></b>' + ' <b><i style="color:black">' + item.sp_rank + '</i></b>' + ' <b><i style="color:green">' + item.sp_status + '</i></b>' + '</a>');
}
else {
 $(obj).parent().find(".addObservationSpeciesNameDropDown").append('<a id="' + item.sp_col_id + ':' + item.sp_common_name +'" href="javascript:void(0);" onclick="selectSpecies(this.id,this)">' + item.sp_common_name + ' <b><i style="color: #2a9dff">' + item.sp_scientific_name + '</i></b>' + '</a>');   
}
                    });

                }

                else {
                    $(obj).parent().find(".addObservationSpeciesNameDropDown").append('<a href="#">No match found</a>');

                }

        }

    });

}
const selectSpecies = (value,obj) => {
    var _col_id = value.split(':')[0];
    selectedSpeciesObject = speciesSuggestionsArray.filter((val) => value == val.match);
    // $("#addObservationSpeciesName").val(value.split(':')[1]);
    $(obj).parent().parent().find('.addObservationSpeciesName').val(value.split(':')[1]);
    $(".addObservationSpeciesNameDropDown").hide();
    // $("#addObservationTaxonID1").val(_col_id);
    $(obj).parent().parent().find(".addObservationTaxonID1").val(_col_id);
}














