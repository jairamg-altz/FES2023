var geomArray = [];
var map;
var mapview;
var geojsonObject;
const userDPId = $(".GuiD").val();
console.log(userDPId);
const initProfileMap = () => {
	$("#map").empty();
	var attribution = new ol.control.Attribution({
		collapsible: false,
	});
	mapview = new ol.View({
		center: ol.proj.fromLonLat([81.0095998, 22.3052918]),
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
				source: new ol.source.OSM(),
			}),
		],
		target: "map",
		view: mapview,
	});
	map
		/*.getView()
		.fit(
			[
				1193621.21746663, -788296.0228458717, 16055425.50101002,
				5082067.749455664,
			],
			map.getSize()
		);*/
	getUserStatistics();
	getTotalUserObservations();
};

const getUserStatistics = () => {
	var data = {
		user_id: userDPId,
	};
	fetch(getUserProfileStatistics, {
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
			$("#userProfileStatistics").empty();
			$("#userProfileStatistics").append(
				"<div class='p-4'><span class='display-6'>" +
					data.data[0].checklists +
					"</span> <br>Checklists</div>"
			);
			/* $("#userProfileStatistics").append(
				"<div class='p-4'><span class='display-6'>" +
					data.data[0].identifications +
					"</span> <br>Identifications</div>"
			); */
			$("#userProfileStatistics").append(
				"<div class='p-4'><span class='display-6'>" +
					data.data[0].images +
					"</span> <br>Images</div>"
			);
			$("#userProfileStatistics").append(
				"<div class='p-4'><span class='display-6'>" +
					data.data[0].observations +
					"</span> <br>Observations</div>"
			);
			$("#userProfileStatistics").append(
				"<div class='p-4'><span class='display-6'>" +
					data.data[0].species +
					"</span> <br>Species</div>"
			);
			$("#userProfileStatistics").append(
				"<div class='p-4'><span class='display-6'>" +
					data.data[0].videos +
					"</span> <br>Videos</div>"
			);
		});
};

const getTotalUserObservations = () => {
	map.getLayers().forEach(function (layer) {
		if (layer.get("name") == "myTotalObservations") {
			map.removeLayer(layer);
		}
	});

	var data = {
		user_id: userDPId,
		srs: parseInt(map.getView().getProjection().getCode().split(":")[1]),
	};

	fetch(getTotalObservationsUrl, {
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
					geometry: JSON.parse(geom.sp_geometry),
				});
			});
			// console.log(geojsonObject);

			const vectorSource = new ol.source.Vector({
				features: new ol.format.GeoJSON().readFeatures(geojsonObject),
			});

			const vectorLayer = new ol.layer.Vector({
				source: vectorSource,
				name: "myTotalObservations",
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
};
initProfileMap();
const toggleProfileFormHandler = (flag) => {
	if (flag === "Edit") {
		$("#edit_profile").removeClass("d-none");
		$("#view_profile").addClass("d-none");
	} else {
		$("#edit_profile").addClass("d-none");
		$("#view_profile").removeClass("d-none");
	}
};
function validateProfileHandler(submitBtn) {
	submitBtn.querySelector(".loader").style.display = "inline-block";
	submitBtn.setAttribute("disabled", true);
	var data = {
		first_name: getValue("profile_first_name"),
		middle_name: getValue("profile_middle_name"),
		last_name: getValue("profile_last_name"),
		user_id: getValue("profile_user_id"),
		email: getValue("profile_email"),
		mobile_number: getValue("profile_mobile"),
		user_uuid: userId,
	};
	// console.log(data);
	if (data.first_name == "") {
		setHtml("profile_first_name_error", "Required");
		addClass(document.getElementById("profile_first_name"), "input_error");
		setTimeout(function () {
			setHtml("profile_first_name_error", "");
			removeClass(document.getElementById("profile_first_name"), "input_error");
		}, 5000);
		document.getElementById("profile_first_name").focus();
		submitBtn.querySelector(".loader").style.display = "none";
		submitBtn.removeAttribute("disabled");
		return false;
	}
	if (data.last_name == "") {
		setHtml("profile_last_name_error", "Required");
		addClass(document.getElementById("profile_last_name"), "input_error");
		setTimeout(function () {
			setHtml("profile_last_name_error", "");
			removeClass(document.getElementById("profile_last_name"), "input_error");
		}, 5000);
		document.getElementById("profile_last_name").focus();
		submitBtn.querySelector(".loader").style.display = "none";
		submitBtn.removeAttribute("disabled");
		return false;
	}
	/*if (data.user_id == "") {
		setHtml("profile_user_id_error", "Required");
		addClass(document.getElementById("profile_user_id"), "input_error");
		setTimeout(function () {
			setHtml("profile_user_id_error", "");
			removeClass(document.getElementById("profile_user_id"), "input_error");
		}, 5000);
		document.getElementById("profile_user_id").focus();
		submitBtn.querySelector(".loader").style.display = "none";
		submitBtn.removeAttribute("disabled");
		return false;
	}*/
	if (data.email == "") {
		setHtml("profile_email_error", "Required");
		addClass(document.getElementById("profile_email"), "input_error");
		setTimeout(function () {
			setHtml("profile_email_error", "");
			removeClass(document.getElementById("profile_email"), "input_error");
		}, 5000);
		document.getElementById("profile_email").focus();
		submitBtn.querySelector(".loader").style.display = "none";
		submitBtn.removeAttribute("disabled");
		return false;
	}
	if (data.mobile_number == "") {
		setHtml("profile_mobile_error", "Required");
		addClass(document.getElementById("profile_mobile"), "input_error");
		setTimeout(function () {
			setHtml("profile_mobile_error", "");
			removeClass(document.getElementById("profile_mobile"), "input_error");
		}, 5000);
		document.getElementById("profile_mobile").focus();
		submitBtn.querySelector(".loader").style.display = "none";
		submitBtn.removeAttribute("disabled");
		return false;
	}
	submitBtn.querySelector(".loader").style.display = "none";
	submitBtn.removeAttribute("disabled");
	return true;
}
