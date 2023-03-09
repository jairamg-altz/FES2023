$( document ).ready(function() {
   //alert("hello"); return false;
    initMapdatadashMap();
}); 
function initMapdatadashMap (layerURL, layerName) {
    //alert("hello"); return false;
    $("#DatasetViewMapD").empty();
    var attribution = new ol.control.Attribution({
        collapsible: false,
    });
    var layersMapView = new ol.View({
        center: ol.proj.fromLonLat([81.0095998, 22.3052918]),
        maxZoom: 18,
        zoom: 6,
        extent: [
            1193621.21746663, -788296.0228458717, 16055425.50101002,
            5082067.749455664,
        ],
    });
    var layersMap = new ol.Map({
        controls: ol.control.defaults({ attribution: false }).extend([attribution]),
        interactions: ol.interaction.defaults({ mouseWheelZoom: false }),
        layers: [
            new ol.layer.Tile({
                source: new ol.source.OSM(),
            }),
        ],
        target: "DatasetViewMapD",
        view: layersMapView,
    });
    layersMap
        .getView()
        .fit(
            [
                1193621.21746663, -788296.0228458717, 16055425.50101002,
                5082067.749455664,
            ],
            layersMap.getSize()
        );

    var wms_source = new ol.source.TileWMS({
        url: layerURL,
        crossOrigin: 'anonymous',
        params: {
            'LAYERS': layerName
        }
    });
    var wms_layer = new ol.layer.Tile({
        name: layerName,
        source:  wms_source
    });
    layersMap.addLayer(wms_layer);
    
    var fullscreen = new ol.control.FullScreen();
    layersMap.addControl(fullscreen);

    /*layersMap.getView().fit([4468168.659276921, 260439.77237508958, 13616152.204446815, 5414245.207516396] , map.getSize())
    initLoadDashboardLayersDiv();
    $(".ol-full-screen-false").on('click', function() {
        setTimeout(function() {
            lastLayerSource.updateParams(lastLayerSource.getParams());
        }, 300);
    });*/
    
}
  
function Dsetinfo(layerURL,layerName) { 
//alert("sfs");     
     $('#DatasetVMap').modal('show');
     initMapdatadashMap(layerURL, layerName);
      
} 