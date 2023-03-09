$("#feedbackModal").on("shown.bs.modal", function () {
	getFeedbacksD();
	getPublicFeedbacks();
});
getFeedbacksD = () => {
	
	var data = {
		user_uuid: userDId,
	};
	//alert(data); return false;
	fetch(FeedbackData, {
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
			if (data.success == "1") {
				let mainData = data.data.reverse();
				let replyData = data.ReplyData.reverse();
				if (replyData.length !== 0) {
					$("#feedback_view_block").empty();
					replyData.forEach((el) => {
						let date =
							el.created_date == "" || el.created_date == null
								? ""
								: el.created_date;
						let fullName = `${el.first_name} ${el.last_name}`;
						let name = userDId == el.created_by ? "You" : fullName;
						$("#feedback_view_block").append(`<div class="feed_message">
                        <h6>${name} <span class="float-end">${date}</span></h6>
                        <div class="feed_message_block bg_grad_green">${el.text_msg}</div>
                        </div>`);

						mainData.forEach((element) => {
							if (element.feedback_uuid == el.feedback_uuid) {
								let date1 =
									element.created_date == "" || element.created_date == null
										? ""
										: element.created_date;
								let categoryBlock = "";
								let fullName1 = `${element.first_name} ${element.last_name}`;
								let name1 = userDId == element.created_by ? "You" : fullName1;
								if (userDId == element.created_by) {
									categoryBlock = `<div class="feedback_category_block">
                                    <span>
                                    Section: <strong>${element.feedback_section}</strong>
                                    </span>
                                    <span>
                                    Type: <strong>${element.feedback_type}</strong>
                                    </span>
                                    <span>
                                    Feeling: <strong>${element.feedback_emotion}</strong>
                                    </span>
                                    </div>`;
								}
								$("#feedback_view_block").append(`<div class="feed_message">
                                <h6>${name1} <span class="float-end">${date1}</span></h6>
                                <div class="feed_message_block bg_grad_blue">${categoryBlock}${element.text_msg}</div>
                                </div>`);
							}
						});
					});
				} else if (mainData.length !== 0) {
					$("#feedback_view_block").empty();
					mainData.forEach((element) => {
						let date1 =
							element.created_date == "" || element.created_date == null
								? ""
								: element.created_date;
						let categoryBlock = "";
						let fullName1 = `${element.first_name} ${element.last_name}`;
						let name1 = userDId == element.created_by ? "You" : fullName1;
						if (userDId == element.created_by) {
							categoryBlock = `<div class="feedback_category_block">
                                <span>
                                    Section: <strong>${element.feedback_section}</strong>
                                </span>
                                <span>
                                    Type: <strong>${element.feedback_type}</strong>
                                </span>
                                <span>
                                    Feeling: <strong>${element.feedback_emotion}</strong>
                                </span>
                            </div>`;
						}
						$("#feedback_view_block").append(`<div class="feed_message">
                            <h6>${name1} <span class="float-end">${date1}</span></h6>
                            <div class="feed_message_block bg_grad_blue">${categoryBlock}${element.text_msg}</div>
                        </div>`);
					});
				}
			}
		});
};
getPublicFeedbacks = () => {
	var data = {
		user_uuid: userDId,
	};
	fetch(PublicFeedbacks, {
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
			if (data.success == "1") {
				let mainData = data.Data.reverse();
				if (mainData.length !== 0) {
					$("#public_feedback_block").empty();
					mainData.forEach((element) => {
						let date1 =
							element.created_date == "" || element.created_date == null
								? ""
								: element.created_date;
						let fullName1 = `${element.first_name} ${element.last_name}`;
						let name1 = userDId == element.created_by ? "You" : fullName1;
						categoryBlock = `<div class="feedback_category_block">
                                    <span>
                                        Section: <strong>${element.feedback_section}</strong>
                                    </span>
                                    <span>
                                        Type: <strong>${element.feedback_eedback_type}</strong>
                                    </span>
                                    <span>
                                        Feeling: <strong>${element.feedback_emotion}</strong>
                                    </span>
                                </div>`;
						$("#public_feedback_block").append(`<div class="feed_message">
                                <h6>${name1} <span class="float-end">${date1}</span></h6>
                                <div class="feed_message_block bg_grad_blue">${categoryBlock}${element.text_msg}</div>
                            </div>`);
					});
				}
			}
		});
};
feedbackSubmitHandler = (submitBtn) => {
	//alert("saf"); return false;
	submitBtn.querySelector(".loader").style.display = "inline-block";
	submitBtn.setAttribute("disabled", true);
	var data = {
		section: getValue("feedback_section"),
		type: getValue("feedback_type"),
		femotion: getValue("feedback_emotion"),
		feedback: getValue("feedback_feedback"),
		user_uuid: userDId,
	};
	 //console.log(data);
	if (data.section == "") {
		setHtml("feedback_section_error", "Required");
		addClass(document.getElementById("feedback_section"), "input_error");
		setTimeout(function () {
			setHtml("feedback_section_error", "");
			removeClass(document.getElementById("feedback_section"), "input_error");
		}, 5000);
		document.getElementById("feedback_section").focus();
		submitBtn.querySelector(".loader").style.display = "none";
		submitBtn.removeAttribute("disabled");
		return false;
	}
	if (data.type == "") {
		setHtml("feedback_type_error", "Required");
		addClass(document.getElementById("feedback_type"), "input_error");
		setTimeout(function () {
			setHtml("feedback_type_error", "");
			removeClass(document.getElementById("feedback_type"), "input_error");
		}, 5000);
		document.getElementById("feedback_type").focus();
		submitBtn.querySelector(".loader").style.display = "none";
		submitBtn.removeAttribute("disabled");
		return false;
	}
	if (data.femotion == "") {
		setHtml("feedback_emotion_error", "Required");
		addClass(document.getElementById("feedback_emotion"), "input_error");
		setTimeout(function () {
			setHtml("feedback_emotion_error", "");
			removeClass(document.getElementById("feedback_emotion"), "input_error");
		}, 5000);
		document.getElementById("feedback_emotion").focus();
		submitBtn.querySelector(".loader").style.display = "none";
		submitBtn.removeAttribute("disabled");
		return false;
	}
	if (data.feedback == "") {
		setHtml("feedback_feedback_error", "Required");
		addClass(document.getElementById("feedback_feedback"), "input_error");
		setTimeout(function () {
			setHtml("feedback_feedback_error", "");
			removeClass(document.getElementById("feedback_feedback"), "input_error");
		}, 5000);
		document.getElementById("feedback_feedback").focus();
		submitBtn.querySelector(".loader").style.display = "none";
		submitBtn.removeAttribute("disabled");
		return false;
	}

	fetch(submitFeedbackUrl, {
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
			submitBtn.querySelector(".loader").style.display = "none";
			submitBtn.removeAttribute("disabled");
			if (data.success == "1") {
				$("#successModalMessage").text("Feedback Sent Successfully");
				$("#successModal").modal("show");
				$("#feedbackForm").trigger("reset");
			} else {
				alert("Something went wrong! Try again.");
			}
		});
};

function feedbackChangeTab(obj, tab) {
	if (tab == 1) {
		$(obj).addClass("active");
		$(obj).parent().children("li:nth-child(2)").removeClass("active");
		$(obj).parent().children("li:nth-child(3)").removeClass("active");
		$(".feedback_form_block").removeClass("d-none");
		$(".feedback_view_block").addClass("d-none");
		$(".public_feedback_block").addClass("d-none");
	} else if (tab == 2) {
		$(obj).addClass("active");
		$(obj).parent().children("li:nth-child(1)").removeClass("active");
		$(obj).parent().children("li:nth-child(3)").removeClass("active");
		$(".feedback_form_block").addClass("d-none");
		$(".feedback_view_block").removeClass("d-none");
		$(".public_feedback_block").addClass("d-none");
	} else {
		$(obj).addClass("active");
		$(obj).parent().children("li:nth-child(1)").removeClass("active");
		$(obj).parent().children("li:nth-child(2)").removeClass("active");
		$(".feedback_form_block").addClass("d-none");
		$(".feedback_view_block").addClass("d-none");
		$(".public_feedback_block").removeClass("d-none");
	}
}

/*addEventListener("load", initMapdatadashMap);*/
function initMapdatadashMap (){
	$("#dashboardmap").empty();
    var attribution = new ol.control.Attribution({
        collapsible: false,
    });
    mapview = new ol.View({
        center: ol.proj.fromLonLat([81.0095998, 22.3052918]),
        zoomControl: true,
        maxZoom: 18,
        zoom: 6,
        /*extent: [
            1193621.21746663, -788296.0228458717, 16055425.50101002,
            5082067.749455664,
        ],*/
    });
    map = new ol.Map({
        controls: ol.control.defaults({ attribution: false }).extend([attribution]),
        interactions: ol.interaction.defaults({ mouseWheelZoom: false }),
        layers: [
            new ol.layer.Tile({
                source: new ol.source.OSM({
					url: "http://{1-4}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}.png"
				}),
				title: 'cartoDBdarkAll'
            }),
        ],
        target: "dashboardmap",
        view: mapview,
    });
	
	var fullscreen = new ol.control.FullScreen();
	map.addControl(fullscreen);

	map.getView().fit([4468168.659276921, 260439.77237508958, 13616152.204446815, 5414245.207516396] , map.getSize())
	initLoadDashboardLayersDiv();
	$(".ol-full-screen-false").on('click', function() {
		setTimeout(function() {
			lastLayerSource.updateParams(lastLayerSource.getParams());
		}, 300);
	});
	addEventListener("click", loadSpeciesLayer("spatialDemand"));
	//$("#loadDashboardSpatialDemandLayersDiv").click();


}

function initLoadDashboardLayersDiv() {
	$("#loadDashboardLayersDiv").on('change', function() {
		loadSpeciesLayer(this.value);
	});
	$("#loadDashboardTemporalDemandLayersDiv").on('click', function() {
		$("#loadDashboardLayersDiv").val("");
		loadSpeciesLayer("temporalDemand");
	});
	$("#loadDashboardSpatialDemandLayersDiv").on('click', function() {
		$("#loadDashboardLayersDiv").val("");
		$("#loadDashboardSpatialDemandLayersDiv").removeClass("active");
		loadSpeciesLayer("spatialDemand");
	});
}

var lastLayerSource;
var lastLayer;
var lastLayerName = "";

function loadSpeciesLayer(id) {
	//console.log(id);
	var layerURL;
	var layerName;
	
	if(id == "") {
		return;
	}
	
	if(id == "Aves") {
		layerURL = avesLayerURL;
		layerName = avesLayerName;
	}
	if(id == "Mammals") {
		layerURL = mammalianLayerURL;
		layerName = mammaliansLayerName;
	}
	if(id == "Amphibians") {
		layerURL = ambhibiansLayerURL;
		layerName = ambhibiansLayerName;
	}
	if(id == "Reptiles") {
		layerURL = reptiliansLayerURL;
		layerName = reptiliansLayerName;
	}
	if(id == "spatialDemand") {
		//alert("sfs");
		layerURL = spatialDemandLayerURL;
		layerName = spatialDemandLayerName;
	}
	if(id == "temporalDemand") {
		layerURL = temporalDemandLayerURL;
		layerName = temporalDemandLayerName;
	}
	
	map.getLayers().forEach(function (layer) {
		if(layer.type != "TILE") {
			map.removeLayer(layer);
		}
	});
	
	lastLayerSource = new ol.source.ImageWMS({
		url: layerURL,
		params: {
			'LAYERS': layerName,
			'FORMAT_OPTIONS': 'layout:legend'
		},
		ratio: 1,
		//format: 'format',
		serverType: 'geoserver',
		transition: 0
	});
	
	lastLayer = new ol.layer.Image({
		source: lastLayerSource
	});
	map.addLayer(lastLayer);
	
	//$("#dashboardmap").append('<div><img style="position: absolute; bottom: -648px;" id="legend"/></div>');
	//const img = document.getElementById('legend');
	//img.src = layerURL + "service=WMS&version=1.1.0&request=GetLegendGraphic&width=20&height=20&layer=" + layerName + "&srcwidth=768&srcheight=330&srs=EPSG:4326&format=image/png&transparent=true&legend_options=fontAntiAliasing:true";
	//https://data.altztech.com/geoserver/wms?service=WMS&version=1.1.0&request=GetLegendGraphic&width=20&height=20&layer=FES:aves&srcwidth=768&srcheight=330&srs=EPSG:4326&format=image/png&legend_options=fontAntiAliasing:true
	
	lastLayerName = layerName;
}
$( document ).ready(function() {
    initMapdatadashMap();
});