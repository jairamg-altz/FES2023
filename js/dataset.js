addEventListener("load", initMapdatasetMap);
function initMapdatasetMap (){
        $("#datasetMap").empty();
    var attribution = new ol.control.Attribution({
        collapsible: false,
    });
    mapview = new ol.View({
        center: ol.proj.fromLonLat([81.0095998, 22.3052918]),
        maxZoom: 18,
        zoom: 6,
        extent: [
            1193621.21746663, -788296.0228458717, 16055425.50101002,
            5082067.749455664,
        ],
    });
    map = new ol.Map({
        controls: ol.control.defaults({ attribution: false }).extend([attribution]),
        interactions: ol.interaction.defaults({ mouseWheelZoom: false }),
        layers: [
            new ol.layer.Tile({
                source: new ol.source.OSM(),
            }),
        ],
        target: "datasetMap",
        view: mapview,
    });
    map
        .getView()
        .fit(
            [
                1193621.21746663, -788296.0228458717, 16055425.50101002,
                5082067.749455664,
            ],
            map.getSize()
        );
   
    getTotalDatasetLayer();
}
function getTotalDatasetLayer() {
map.getLayers().forEach(function (layer) {
        if (layer.get("name") == "myTotalObservations") {
            map.removeLayer(layer);
        }
    });
var upID = $("#uploadID").val();
  //alert(upID);
    var data = {
        datasetId: upID,
        srs: '3857',
    };
//$("#overlay").fadeIn(300);
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
            console.log(data.data.length);
            //setTimeout(function() { $("#overlay").fadeOut(300); },500);
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

            map.addLayer(vectorLayer);
        });
}