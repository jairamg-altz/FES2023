const toggleDropDownDiv = () => {
	document
		.getElementById("searchSpeciesTextBoxDropDown")
		.classList.toggle("show");
};
var speciesSearchArray = [];
const searchSpeciesOnKeyPress = (keyword) => {
	//console.log(keyword);
	if (keyword.length <= 2) {
		speciesMap.getLayers().forEach(function (layer) {
        		if(layer != undefined) {
            			if(layer.get('name') == "ddSpeciesLayer") {
                			speciesMap.removeLayer(layer);
            			}
        		}
    		});
		speciesMap.getLayers().forEach(function (layer) {
                	if(layer != undefined) {
                    		if(layer.get('name') == "speciesbiomeLayer") {
                        		speciesMap.removeLayer(layer);
                    		}
                	}
            	});

		$("#searchSpeciesTextBoxDropDown").hide();
		return;
	}
	$("#searchSpeciesTextBoxDropDown").show();
    $("#overlay").fadeIn(300);　
	fetch(searchSpeciesUrl, {
		method: "POST",
		headers: {
			"Content-Type": "application/json",
		},
		body: JSON.stringify({
			keyword: keyword
			//srs: parseInt(speciesMap.getView().getProjection().getCode().split(":")[1]),
		}),
	})
		.then(function (res) {
			return res.text();
		})
		.then(function (data) {
			$("#searchSpeciesTextBoxDropDown").empty();
			//console.log(data);
			data = JSON.parse(data);
            setTimeout(function(){
            $("#overlay").fadeOut(300);
                },500);
			speciesGeojsonObject = {
				type: "FeatureCollection",
				crs: {
					type: "name",
					properties: {
						name: "EPSG:3857",
					},
				},
				features: [],
			};
			speciesSearchArray = data.data;
			
			data.data.forEach((item) => {
				//var _item = item.json_row;
                console.log(item);
                if(item.sp_class==='Aves')
                {
                	$("#callValue").show();
                }
                else {
                	$("#callValue").hide();
                }
				var str = item.sp_scientific_name;
                var vernacular_name = item.sp_vernacular_name;
                 
				if(str == null && item.sp_vernacular_name != null)
					return;
				//console.log(vernacular_name);
				vernacular_name = (vernacular_name == 'NULL')? '' : ', ' + vernacular_name;
				//speciesDisplayName = item.sp_vernacular_name + vernacular_name;
				$("#searchSpeciesTextBoxDropDown").append('<a href="javascript:void(0);" id="' + str + '" onclick="selectSpeciesValueMain(this.id)" > <b style="color: #3e668d"><i>' + item.sp_scientific_name + '</i></b>' + vernacular_name + '</a>');
				return;
				speciesGeojsonObject.features.push({
					type: "Feature",
					geometry: _item.geometry,
					properties: _item.properties,
				});
			});
			// console.log(speciesGeojsonObject);

			const vectorSource = new ol.source.Vector({
				features: new ol.format.GeoJSON().readFeatures(speciesGeojsonObject),
			});

			const vectorLayer = new ol.layer.Vector({
				source: vectorSource,
				name: "mySearchedSpeciesLayer",
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
			speciesMap.getLayers().forEach(function (layer) {
				/*if (layer.get("name") != undefined && layer.get("name") == "mySearchedSpeciesLayer") {
					speciesMap.removeLayer(layer);
				}*/
			});
			speciesMap.addLayer(vectorLayer);

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
			speciesMap.addOverlay(overlay);

			/*closer.onclick = function () {
				overlay.setPosition(undefined);
				closer.blur();
				return false;
			};*/

			speciesMap.on("click", function (evt) {
				var feature = speciesMap.forEachFeatureAtPixel(
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

			speciesMap.on("pointermove", function (evt) {
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

//getSpeciesLocationUrl
const getSpeciesLocation = (scientificName) => {
    //console.log(scientificName);
    var speciesData;
    fetch(getSpeciesLocationUrl,
    {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
            },
        body: JSON.stringify({
            scientificName,
            srs: speciesMap.getView().getProjection().getCode().split(":")[1],
            geometry: '',
            geometrysrs: '4326'
        })
    })
    .then(function(res){ return res.text(); })
    .then(function(data) {
        data = JSON.parse(data);
        speciesData = data;
       // console.log(data);
	speciesLocationPlotter(data);
    });
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
            geometry: new ol.geom.Point([item.json_row.geometry.coordinates[0], item.json_row.geometry.coordinates[1]]),
            name: item.json_row.properties.scientific_name
            //kingdom: item.json_row.properties.kingdom,
            //family: item.json_row.properties.family,
            //image: item.json_row.properties.file_uri
            });
            feature.setStyle(iconStyle);
            featuresArray.push(feature);
    });

    const vectorSource = new ol.source.Vector({
        features: [],
    });
    vectorSource.addFeatures(featuresArray);
    
    const vectorLayer = new ol.layer.Vector({
        name: 'ddSpeciesLayer',
        source: vectorSource,
    });

    speciesMap.getLayers().forEach(function (layer) {
        if(layer != undefined) {
            if(layer.get('name') == "ddSpeciesLayer") {
                speciesMap.removeLayer(layer);
            }
        }
    });
    speciesMap.addLayer(vectorLayer);
}

var speciesBiomeGeojsonObject;
const getSpeciesDynamicCitation = (speciesName) => {
	fetch(getSpeciesDynamicCitationUrl,
    {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
            },
        body: JSON.stringify({
            speciesName
        })
    })
    .then(function(res){ return res.text(); })
    .then(function(data) {
		
		var citation = JSON.parse(data);
		if(citation.data.length == 0){
			$("#dynamicCitationDiv").remove();
			return;
		}
		
		citation.data.forEach((item)=>{
			item.uniqueCitations = item.sp_citation + "," + item.sp_yrcompiled
		});
		var unique_citations = [...new Set(citation.data.map(item => item.uniqueCitations))];
		//console.log("unique_citations => " + unique_citations);
		$("#dynamicCitationDiv").remove();
		unique_citations.forEach((item)=>{
			//console.log(item.split(','))
			var dt = new Date();
			$("#CitationD>h5").after('<div id="dynamicCitationDiv" class="card-body"><h6>' + item.split(',')[0] + ', ' + item.split(',')[1] + ', ' + speciesName + '(Spatial data)' + ', ' + 'The IUCN Red List of Threatened Species. Version 2021-3. <a href="https://www.iucnredlist.org">https://www.iucnredlist.org</a>. Accessed on ' + dt.getDate() + ' ' + dt.toLocaleString('default', { month: 'long' }) + ', ' + dt.getFullYear() + '</h6></div>');
		});
    });
}

const getSpeciesBiome = (speciesName) => {
	speciesMap.getLayers().forEach(function (layer) {
		if(layer != undefined) {
			if(layer.get('name') == "speciesbiomeLayer") {
				speciesMap.removeLayer(layer);
			}
		}
	});
	
	speciesBiomesSource = new ol.source.ImageWMS({
		url: speciesBiomesWMSUrl,
		params: {
			'LAYERS': speciesBiomesLayerName,
			'CQL_FILTER' : "binomial='" + speciesName + "'",
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
	speciesMap.addLayer(speciesBiomesLayer);
	getSpeciesLocation(speciesName);
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

const selectSpeciesValueMain = (value) => {

	getSpeciesBiome(value);
	getSpeciesDynamicCitation(value);
	var strd = value;
      strd = strd.replace(/-/g, ' ');
	$.ajax({
              type: 'GET',
              url: 'https://api.catalogueoflife.org/dataset/2351/nameusage/suggest?fuzzy=false&limit=25&q='+strd,
              data: '',
              dataType: 'json',
              contentType: false,
              processData: false,           
              success: function(d) {
       //console.log(d.suggestions[0].usageId)
        if(d!=null) 
        {
       		var taxonID = d.suggestions[0].usageId; 	
        }     	
       else {
       	var taxonID = 0;
       }
       $.ajax({
        type: 'GET',
        url: 'https://api.catalogueoflife.org/dataset/2351/taxon/' + taxonID + '/info',
        data: '',
        dataType: 'json',
        contentType: false,
        processData: false,           
        success: function(d) {
       if(d.vernacularNames != undefined){
       d.vernacularNames.forEach((vernacularNamesItem) => {
       	$("#pppp111").empty();
   			$("#pppp111").append(vernacularNamesItem.name);
       })
       }  

$.ajax({
    type: 'GET',
    url: 'https://api.catalogueoflife.org/dataset/2351/tree/' + taxonID + '?catalogueKey=2351&insertPlaceholder=true&type=CATALOGUE',
    data: '',
    dataType: 'json',
    contentType: false,
    processData: false,           
    success: function(d) {
    d.forEach((item) => {
    d.forEach((subItem) => {
        //console.log(item);
    	//console.log(subItem);
if(item.parentId == subItem.id && item.rank == "kingdom") {
   $("#CitationD").show();
   $("#pppp").empty();
   $("#pppp").append(item.name);
   //console.log(subItem.name);
    }
  if(item.parentId == subItem.id && item.rank == "phylum") {
  	$("#pppp1").empty();
    $("#pppp1").append(item.name);
     //console.log(subItem.name);
   }
  if(item.parentId == subItem.id && item.rank == "subphylum") {
  	 // console.log("subphylum: ", subItem.name)
  }
 if(item.parentId == subItem.id && item.rank == "class") {
 	$("#pppp2").empty();
    $("#pppp2").append(item.name);
   //console.log(subItem.name);
   }
if(item.parentId == subItem.id && item.rank == "subclass") {
	$("#pppp3").empty();
    $("#pppp3").append(item.name);
  //console.log("subclass: ", subItem.name)
  }
if(item.parentId == subItem.id && item.rank == "infraclass") {
 //console.log("infraclass: ", subItem.name)
}
if(item.parentId == subItem.id && item.rank == "order") {
  $("#pppp4").empty();
  $("#pppp4").append(item.name);
//console.log(subItem.name);
 }
if(item.parentId == subItem.id && item.rank == "family") {
  $("#pppp5").empty();
  $("#pppp115").empty();
  $("#pppp5").append(item.name);
  $("#pppp115").append(item.name);
//console.log(subItem.name);
}
if(item.parentId == subItem.id && item.rank == "subfamily") {
  $("#pppp6").empty();
  $("#pppp6").append(item.name);
//console.log(subItem.name);
}
if(item.parentId == subItem.id && item.rank == "genus") {
	$("#pppp116").empty();
  $("#pppp116").append(item.name);
  //console.log(subItem.name+'genus');
 }
if(item.parentId == subItem.id && item.rank == "species") {
  $("#pppp1175").empty();
  $("#pppp1175").append(item.name);
  // console.log(item.parentId);
}
if(item.parentId == subItem.id && item.rank == "subspecies") {
  //console.log("subspecies: ", subItem.name)
      }   
})
})
} 
});
} 
});
}
}); 
speciesSearchArray.forEach((speciesItem) => {
		//console.log(speciesItem);
if(speciesItem.sp_scientific_name == strd) {
	var vernacular_name = (speciesItem.sp_vernacular_name == 'NULL')? '' : ', ' + speciesItem.sp_vernacular_name;
	$("#searchSpeciesTextBox").val(speciesItem.sp_scientific_name + vernacular_name);
	}
	});
	$("#searchSpeciesTextBoxDropDown").hide();
	addEventListener("click", showSpeciesImagesData(strd));
	addEventListener("click", litrature(strd));
//add API
var iucntoken = '9bb4facb6d23f48efbf424bb05c0c1ef1cf6f468393bc745d42179ac4aca5fee';
var scientificName = strd;
var url = site_url('/Species/countries');
var pdata = 'scientificName='+scientificName;
	$.ajax({
  type: "POST",
  url: url,
  data: pdata,
  cache: false,
  success: function(data){
  	$("#ccc1").empty();
    $("#ccc1").append(data);
  }
});
//For Synonyms	
var ssdata = 'scientificName='+scientificName;
var surl = site_url('/Species/Synonyms');
$.ajax({
  type: "POST",
  url: surl,
  data: ssdata,
  cache: false,
  success: function(sspdata){
  	//alert(sspdata); return false;
  	$("#sss1").empty();
     $("#sss1").append(sspdata);
  }
});

//For Habitat
var hdata = 'scientificName='+scientificName;
var hurl = site_url('/Species/Habitat');
	$.ajax({
  type: "POST",
  url: hurl,
  data: ssdata,
  cache: false,
  success: function(hpdata){
  	//alert(hpdata); return false;
  	$("#hhh1").empty();
     $("#hhh1").append(hpdata);
  }
});

//For Conservation Measures
var cmdata = 'scientificName='+scientificName;
var ccUrl = site_url('/Species/Measures');
	$.ajax({
  type: "POST",
  url: ccUrl,
  data: cmdata,
  cache: false,
  success: function(cpdata){
  	//alert(cpdata); return false;
  	$("#cms11").empty();
     $("#cms11").append(cpdata);
  }
});
//For xeno-canto

var xenodata = 'scientificName='+scientificName;
$.ajax({
               type: 'GET',
               url: 'https://xeno-canto.org/api/2/recordings?query='+scientificName,
               data: '',
               dataType: 'json',
               contentType: false,
               processData: false,
               success: function(data) {
               	console.log(data.recordings);
               	$('#callDataTable').DataTable().destroy();
               	if(data.recordings.length===0) {
               	var dataSet = [];
               	$('#callDataTable').DataTable({
        data: dataSet,
        columns: [
        	{ title: '' },
        	{ title: 'Scientific Name' },
            { title: 'Length' },
            { title: 'Recordist' },
            { title: 'Date' },
            { title: 'Time.' },
            { title: 'Country' },
            { title: 'Location' },
            { title: 'Elev. (m)' },
            { title: 'Type (predef. / other)' },
            { title: 'Remarks' },
        ],
    });	
			//alert("helloData"); 
               } else {
               	var dataSet = [];
               	data.recordings.forEach((item) => {
				    var _data = [];
				    //console.log(item["file-name"]);
				    //console.log(item.osci.small + " ...... " + item["file-name"] );
				    var audioUrl = item.osci.small.split('wave')[0] + item["file-name"];
				    _data.push('<div class="xc-mini-audio"><audio class="xc-mini-player" controls><source src="' + audioUrl + '" type="audio/mpeg"></audio></div>');
				    _data.push(item.en+'('+item.gen + " " + item.sp +')');
				    _data.push(item.length);
				    _data.push(item.rec);
				    _data.push(item.date);
				    _data.push(item.time);
				    _data.push(item.cnt);
				    _data.push(item.loc);
				    _data.push(item.alt);
				    _data.push(item.type);
				    _data.push(item.rmk);
				    dataSet.push(_data);
				})
			$('#callDataTable').DataTable({
        data: dataSet,
        columns: [
        	{ title: '' },
        	{ title: 'Scientific Name' },
            { title: 'Length' },
            { title: 'Recordist' },
            { title: 'Date' },
            { title: 'Time.' },
            { title: 'Country' },
            { title: 'Location' },
            { title: 'Elev. (m)' },
            { title: 'Type (predef. / other)' },
            { title: 'Remarks' },
        ],
    });
               	//alert("hello");               	
               }             					   
   
   //$('#callDataTable').empty();
	/*$('#callDataTable').DataTable({
        data: dataSet,
        columns: [
        	{ title: '' },
        	{ title: 'Scientific Name' },
            { title: 'Length' },
            { title: 'Recordist' },
            { title: 'Date' },
            { title: 'Time.' },
            { title: 'Country' },
            { title: 'Location' },
            { title: 'Elev. (m)' },
            { title: 'Type (predef. / other)' },
            { title: 'Remarks' },
        ],
    });*/
}
});
//For Narrative
$.ajax({
               type: 'GET',
               url: 'https://apiv3.iucnredlist.org/api/v3/species/narrative/' + scientificName + '?token=' + iucntoken,
               data: '',
               dataType: 'json',
               contentType: false,
               processData: false,
               success: function(d) {
               	console.log(d.result[0]);
               /*console.log("Conservation Measures: " + d.result[0].conservationmeasures);
        console.log("Geographic Range: " + d.result[0].geographicrange);
        console.log("Habitat: " + d.result[0].habitat);
        console.log("Population: " + d.result[0].population);
        console.log("Population Trend: " + d.result[0].populationtrend);
        console.log("Rationale: " + d.result[0].rationale);
        console.log("Taxonomic Notes: " + d.result[0].taxonomicnotes);
        console.log("Threates: " + d.result[0].threats);
        console.log("Use and Trade: " + d.result[0].usetrade);*/
       if(d.result!=null) {        	
        $("#nnn1").empty();
        $("#nnn2").empty();
        $("#nnn3").empty();
        $("#nnn4").empty();
        $("#nnn5").empty();
        $("#nnn6").empty();
        $("#nnn7").empty();
        $("#nnn8").empty();
        $("#nnn9").empty();
        $("#nnn1").append(d.result[0].conservationmeasures);  			
  			$("#nnn2").append(d.result[0].geographicrange);  			
  			$("#nnn3").append(d.result[0].habitat);  			
  			$("#nnn4").append(d.result[0].population);  			
  			$("#nnn5").append(d.result[0].populationtrend);  			
  			$("#nnn6").append(d.result[0].rationale);  			
  			$("#nnn7").append(d.result[0].taxonomicnotes);
  			$("#nnn8").append(d.result[0].threats);  			
  			$("#nnn9").append(d.result[0].usetrade);
  		}
               }

});
};
//Images
function showSpeciesImagesData(scientificName) {
	var sdata = 'scientificName='+scientificName;
	var sIurl =  site_url('/Species/Smedias');
	$.ajax({
  type: "POST",
  url: sIurl,
  data: sdata,
  cache: false,
  success: function(data){
  	//alert(data); return false;
  	$("#obs_img").empty();
     $("#obs_img").append(data);
  }
});
	    
}
function litrature(scientificName)
{
	var url = 'https://refindit.org/find?search=simple&text='+scientificName+'&more=1&limit=100';
	var xhr = new XMLHttpRequest();
	xhr.open("GET", url);
	xhr.onreadystatechange = function () {
	if (xhr.readyState === 4) {
	    	data = JSON.parse(xhr.responseText.replace(/\]\[/g, ','));
	    	unique = data.map(item => item.source).filter((value, index, self) => self.indexOf(value) === index);
		//console.log(unique);
		$("#tabIData").empty();
		$("#tabIData").next().empty();
		unique.forEach((uniqueItem, i) => {
			//console.log(i)
			var _class = (i == 0) ? _class = 'class="nav-item"' : 'class="nav-item"';
            if(i == 0)
            {
               $("#tabIData").append('<li id= "tab-' + uniqueItem + '" ' + _class + '> <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#' + uniqueItem + '"><span class="h5"><b>' + uniqueItem + '</b></span></button></li>'); 
            }
			else{
                $("#tabIData").append('<li id= "tab-' + uniqueItem + '" ' + _class + '> <button class="nav-link" data-bs-toggle="tab" data-bs-target="#' + uniqueItem + '"><span class="h5"><b>' + uniqueItem + '</b></span></button></li>');
            }
		});
		unique.forEach((uniqueItem, i) => {
			var tabData = data.filter((x) => x.source === uniqueItem);
			$("#dataTab").append('<div id="' + uniqueItem + '" class="container-fluid tab-pane active"></div>');
			tabData.forEach((dataItem, j) => {
				if(dataItem.title != undefined) {
            				var divItem = uniqueItem + '_' + j;
					var title = '';
					if(typeof(dataItem.title) == 'string')
						title = dataItem.title;
					if(typeof(dataItem.title) == 'object')
						title = dataItem.title._;
					$("#" + uniqueItem).append('<div id="' + divItem + '" class="mt-3 p-3 bg-success bg-opacity-10"><h5><a href="' + dataItem.href + '" target="_blank" style="color: #332cf9;">' + title + '</a></h5></div>');
					var authors = [];
					if(dataItem.firstauthor != undefined) {
						if(dataItem.firstauthor[0] != null || dataItem.firstauthor[1] != null)
							authors.push(dataItem.firstauthor[0] + ' ' + dataItem.firstauthor[1]);
					}
					if(dataItem.authors != undefined) {
						dataItem.authors.forEach((authorItem) => {
							if(authorItem[0] != null || authorItem[1] != null) {
								var authorName = authorItem[0] + ' ' + authorItem[1];
								if(authors.indexOf(authorName) == -1)
									authors.push(authorName);
							}
						});
					}
					var year = '';
					var volume = '';
					if(dataItem.year != undefined)
						year = "<i>, Year: " + dataItem.year + "</i>";
					if(dataItem.volume != undefined)
						volume = "<i>, Vol. " + dataItem.volume + "</i>";
					$("#" + divItem).append('<div id="author_' + uniqueItem + '_' + j + '"><label><b>' + authors.join(', ') + '</b>' + year + '</label></br></div>');
					$("#" + divItem).append('<div id="publishedIn_' + uniqueItem + '_' + j + '"><label>' + dataItem.source + '</label></br></div>');
					$("#" + divItem).append('<div id="source_' + uniqueItem + '_' + j + '"><label>' + dataItem.publishedIn + volume  + '</label></br></div>');			}
			});
		});
	}};
	xhr.send();
}
var geomArray = [];
var speciesMap;
var mapview;
var speciesGeojsonObject;
const initOpenLayers = () => {
const mousePositionControl = new ol.control.MousePosition({
	coordinateFormat: ol.coordinate.createStringXY(4),
	projection: 'EPSG:4326',
  	// comment the following two lines to have the mouse position
  	// be placed within the speciesMap.
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
	speciesMap = new ol.Map({
		controls: ol.control.defaults({ attribution: false }).extend([attribution, mousePositionControl]),
		interactions: ol.interaction.defaults({ mouseWheelZoom: false }),
		layers: [
			new ol.layer.Tile({
				source: new ol.source.OSM(),
			}),
		],
		target: "Datadashboard_map",
		view: mapview,
	});
	getLocation();
	//loadStates();
	//initDashboardTabNavigation();
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
	//currentPosition.innerHTML = "<b>Latitude</b>: " + position.coords.latitude + ", <b>Longitude</b>: " + position.coords.longitude;
};

var layerDataProjection;

const showStatesGeometry = () => {
	layerDataProjection = "EPSG:3857";
	getBoundaryGeometry($("#statesCombo").val());
};

const showDistrictsGeometry = () => {
	layerDataProjection = "EPSG:4326";
	getBoundaryGeometry($("#districtsCombo").val());
};

const showSubDistrictsGeometry = () => {
	layerDataProjection = "EPSG:4326";
	getBoundaryGeometry($("#subDistrictsCombo").val());
};

const showBlocksGeometry = () => {
	layerDataProjection = "EPSG:4326";
	getBoundaryGeometry($("#blocksCombo").val());
};

const loadStates = () => {
	fetch(nodeAppUrl + "/getStates", {
		method: "POST",
		headers: {
			"Content-Type": "application/json",
		},
		//body: JSON.stringify(data)
	})
		.then(function (res) {
			return res.json();
		})
		.then(function (data) {
			data.text.forEach((item) => {
				$("#statesCombo").append(
					'<option value="' + item.lid + '">' + item.name + "</option>"
				);
			});
		});
};

const loadDistricts = (state_id) => {
	// console.log(state_id);
	$("#adminSearchPanelLoader").show();
	var data = {
		state_id,
	};
	fetch(nodeAppUrl + "/getDistricts", {
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
			$("#adminSearchPanelLoader").hide();
			$("#districtsCombo")
				.empty()
				.append('<option value="">Select Districts</option>');
			$("#subDistrictsCombo")
				.empty()
				.append('<option value="">Select Sub Districts</option>');
			$("#blocksCombo")
				.empty()
				.append('<option value="">Select Blocks</option>');
			data.text.forEach((item) => {
				$("#districtsCombo").append(
					'<option value="' + item.id + '">' + item.name + "</option>"
				);
			});
		});
};

const loadSubDistricts = (district_id) => {
	// console.log(district_id);
	$("#adminSearchPanelLoader").show();
	var data = {
		district_id,
	};
	fetch(nodeAppUrl + "/getSubDistricts", {
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
			$("#adminSearchPanelLoader").hide();
			$("#subDistrictsCombo")
				.empty()
				.append('<option value="">Select Sub Districts</option>');
			data.text.forEach((item) => {
				$("#subDistrictsCombo").append(
					'<option value="' + item.id + '">' + item.name + "</option>"
				);
			});
		});
};

const loadBlocks = (district_id) => {
	// console.log(district_id);
	$("#adminSearchPanelLoader").show();
	var data = {
		district_id,
	};
	fetch(nodeAppUrl + "/getBlocks", {
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
			$("#adminSearchPanelLoader").hide();
			$("#blocksCombo")
				.empty()
				.append('<option value="">Select Blocks</option>');
			data.text.forEach((item) => {
				$("#blocksCombo").append(
					'<option value="' + item.id + '">' + item.name + "</option>"
				);
			});
		});
};

const getBoundaryGeometry = (region_id) => {
	var data = {
		region_id,
	};
	$("#adminSearchPanelLoader").show();
	fetch(nodeAppUrl+"/getBoundaryGeometry", {
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
			$("#adminSearchPanelLoader").hide();
			data.text.forEach((item) => {
				const format = new ol.format.WKT();

				const feature = format.readFeature(item.geometry, {
					dataProjection: layerDataProjection,
					featureProjection: "EPSG:3857",
				});

				const wktLayer = new ol.layer.Vector({
					name: "wktLayer",
					source: new ol.source.Vector({
						features: [feature],
					}),
				});
				speciesMap.getLayers().forEach(function (layer) {
					if (layer.get("name") == "wktLayer") {
						speciesMap.removeLayer(layer);
					}
				});
				speciesMap.addLayer(wktLayer);
				// console.log("WKT added");

				if ($("#zoomToFeature").is(":checked")) {
					var coord1 = ol.proj.transform(
						[parseFloat(item.xmin), parseFloat(item.ymin)],
						layerDataProjection,
						"EPSG:3857"
					);
					var coord2 = ol.proj.transform(
						[parseFloat(item.xmax), parseFloat(item.ymax)],
						layerDataProjection,
						"EPSG:3857"
					);

					speciesMap
						.getView()
						.fit([coord1[0], coord1[1], coord2[0], coord2[1]], speciesMap.getSize());
				}
			});
		});
};
initOpenLayers();

//Data Set Map
//addEventListener("load", DatasetViewMap);
function DatasetViewMap(id, value)  {
 //alert(value);
 //console.log(id);
 $("#apdatasetTitle").empty();
 $("#apdatasetTitle").append(value);
 $('#DatasetVMap').modal('show');
    $("#DatasetViewMapD").empty();
    var attribution = new ol.control.Attribution({
        collapsible: false,
    });
    DatasetViewMapD = new ol.Map({
        /*controls: ol.control.defaults({ attribution: false }).extend([attribution]),
        */layers: [
            new ol.layer.Tile({
                source: new ol.source.OSM(),
            }),
        ],
        target: "DatasetViewMapD",
        view: new ol.View({
            center: ol.proj.fromLonLat([81.0095998, 22.3052918]),
            maxZoom: 18,
            zoom: 5,
        }),
    });
    
    var upID = $("#uploadID").val();
  //alert(upID);
    var data = {
        datasetId: id,
        srs: '3857',
    };

    fetch(getLocationsForDataset, {
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
		geomArray = [];
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

		data.data.forEach((geom) => {
			geojsonObject.features.push({
				type: "Feature",
				geometry: JSON.parse(geom.sp_location),
			});
		});
		// console.log(geojsonObject);

		const vectorSource = new ol.source.Vector({
			features: new ol.format.GeoJSON().readFeatures(geojsonObject),
		});

		const vectorLayer = new ol.layer.Vector({
			source: vectorSource,
			name: "Dataset layers",
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

		DatasetViewMapD.addLayer(vectorLayer);
		DatasetViewMapD.getView().fit(vectorSource.getExtent());
	});    
}