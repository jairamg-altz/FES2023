var userId = $("#duserId").val();
//alert(userId); 
var importExcelId;
var importImagesId;
var imageSelected = false;
var imageColumnName;
var sheetColumns = [];
var schemaArr = [];
var uploadExcelFormData;
var uploadImageFormData;

const uploadData =() => {            
    var uploadExcelFormData = new FormData($('#uploadDataForm')[0]);
    $.ajax({
        type: 'POST',
        url : uploadDataExcelURL,
        data: uploadExcelFormData,
        dataType: 'json',
        contentType: false,
        processData: false,
        beforeSend: function() { $("#overlay").fadeIn(300); },            
        success: function(d) {
            if(d.status == "SUCCESS") {
                setTimeout(function() { $("#overlay").fadeOut(300); },500);
                uploadExcelFormData = null;
                $("#columnsMappingTable>tbody").empty();
                var _tableArr = ['<option id="tableSelect">-Select-</option>'];
                var _tableColumnsArr = ['<option id="columnSelect">-Select-</option>'];
                schemaArr = d.dbColumns;
                importExcelId = d.fileName;
                sheetColumns = [];
                d.dbColumns.forEach((column) => {
                    var item = '<option id="' + column.sp_table_name + '">' + column.sp_table_name + '</option>';
                    if(!_tableArr.includes(item))
                    _tableArr.push(item);
                    _tableColumnsArr.push('<option id="' + column.sp_column_name + '">' + column.sp_column_name + '</option>');
                })
                d.sheetColumns.forEach((columnName) => {
                    var _simplifiedColumnName = columnName.trim().replaceAll(' ', '_').replaceAll('.', '_')
                    sheetColumns.push({
                        originalColumnName: columnName,
                        simplifiedColumnName: _simplifiedColumnName
                    });
                    $("#columnsMappingTable>tbody").append('<tr>'
                        + '<td>'
                            + '<input id="source_' + _simplifiedColumnName + '" class="form-control" value="' + _simplifiedColumnName +'" readonly></input>'
                        + '</td>'
                        + '<td>'
                            + '<input id="target_image_column_' + _simplifiedColumnName + '" type="checkbox"></input>'
                        + '</td>'
                        + '<td>'
                            + '<select id="target_table_' + _simplifiedColumnName + '" class="form-select" onchange="loadColumnsCombo(this.id)">' + _tableArr.join() + '</select>'
                        + '</td>'
                        + '<td>'
                            + '<select id="target_columns_' + _simplifiedColumnName + '" class="form-select" onchange="loadColumnType(this.id)" style="width: 200px;"></select>'
                        + '</td>'
                        + '<td>'
                            + '<input id="target_columns_type_' + _simplifiedColumnName + '" class="form-control" style="width: 200px;" readonly></input>'
                        + '</td>'
                        + '<td>'
                            + '<input id="target_import_column_' + _simplifiedColumnName + '" type="checkbox" checked></input>'
                        + '</td>'
                    + '</tr>');
                });
                $("#activityStatus").html("<b>Status</b>");
                $("#activityStatus").append("</br>Number of columns in the sheet: " + sheetColumns.length);
            }
            
            /*
            * Image Column Selection and Row Enable/Disable
            */
            $("input:checkbox[id*=image_column]").click(function() {
                var _id = this.id.substr("target_image_column_".length);
                if(!$(this).is(':checked')) {
                    $("input:checkbox[id*=image_column]").not(this).prop("disabled", false);
                    $("#target_table_" + _id).val("-Select-");
                    $("#target_columns_" + _id).val("-Select-");
                    $("#target_columns_" + _id).empty();
                    $("#target_table_" + _id).attr("disabled", false);
                    $("#target_columns_" + _id).attr("disabled", false);
                    $("#imageUploadDiv").hide();
                    imageSelected = false;
                }
                else {
                    $("input:checkbox[id*=image_column]").not(this).prop("disabled", true);
                    $("#target_table_" + _id).val("record_level");
                    loadColumnsCombo("target_table_" + _id);
                    $("#target_columns_" + _id).val("file_path");
                    $("#target_table_" + _id).attr("disabled", true);
                    $("#target_columns_" + _id).attr("disabled", true);
                    $("#imageUploadDiv").show();
                    imageSelected = true;
                }
            });

            $("input:checkbox[id*=import]").click(function() {
                var _id = this.id.substr("target_import_column_".length);
                if(!$(this).is(':checked')) {
                    $("#source_" + _id).prop("disabled", true);
                    $("#target_image_column_" + _id).prop("disabled", true);
                    $("#target_table_" + _id).prop("disabled", true);
                    $("#target_columns_" + _id).prop("disabled", true);
                    $("#target_columns_type_" + _id).prop("disabled", true);
                }
                else {
                    $("#source_" + _id).prop("disabled", false);
                    $("#target_image_column_" + _id).prop("disabled", false);
                    $("#target_table_" + _id).prop("disabled", false);
                    $("#target_columns_" + _id).prop("disabled", false);
                    $("#target_columns_type_" + _id).prop("disabled", false);
                }
            });
        },
        error: function(e) {
            setTimeout(function() { $("#overlay").fadeOut(300); },500);
        }
    });
}

const loadColumnsCombo = (id) => {
    $("#target_columns_" + id.substr("target_table_".length)).empty();
    var _tableColumnsArr = ['<option id="targetColumnSelect">-Select-</option>'];
    var columns = schemaArr.filter((x) => x.sp_table_name == $("#" + id).val());
    columns.forEach((column) => {
        _tableColumnsArr.push('<option id="' + column.sp_column_name + '">' + column.sp_column_name + '</option>');
    })
    $("#target_columns_" + id.substr("target_table_".length)).append(_tableColumnsArr.join());
}

const loadColumnType = (id) => {
    var _id = id.substr("target_columns_".length)
    if(isDuplicateColumn(_id)) {
        alert("This column has already been selected.");
        $("#target_columns_" + _id).val("-Select-");
        return;
    }
    var _table = $("#target_table_" + _id).val();
    var _column = $("#target_columns_" + _id).val();
    var t = schemaArr.filter((x) => x.sp_table_name == _table & x.sp_column_name == _column);
    $("#target_columns_type_" + _id).val(t[0].sp_data_type);
    console.log(_table, _column);
}


const isDuplicateColumn = (id) => {
    var duplicateFound = false;
    var _table = $("#target_table_" + id).val();
    var _currentTable = "target_table_" + id;
    $("select[id*=target_table_]").each(function () {
        if(this.id != _currentTable && $("#" + this.id).val() == _table) {
            console.log("=> " + $("#target_columns_" + this.id.substr("target_table_".length)).val());
            console.log("=> " + $("#target_columns_" + id).val());
            if($("#target_columns_" + this.id.substr("target_table_".length)).val() == "dynamic_properties" && $("#target_columns_" + id).val() == "dynamic_properties") {
                return;
            }
            if($("#target_columns_" + this.id.substr("target_table_".length)).val() == $("#target_columns_" + id).val()) {
                duplicateFound = true;
                console.log(id)                        
            }
        }
    });
    return duplicateFound;
}

const uploadImages = () => {
    $("input:checkbox[id*=image_column]").each(function() {
        if($(this).is(":checked")) {
            var imageColumnNameItem = sheetColumns.filter((x) => x.simplifiedColumnName == ($("#source_" + this.id.substr("target_image_column_".length)).val()));
            imageColumnName = imageColumnNameItem[0].originalColumnName;
            console.log(imageColumnName);
            $("#imageColumnName").val(imageColumnName);
        }
    });
    $("#importExcelId").val(importExcelId);
    //uploadImageFormData = new FormData($('#uploadImageForm')[0]);
    $.ajax({
        type: 'POST',
        url : uploadZippedImagesURL,
        data: uploadImageFormData,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function(d) {
            if(d.status == "UPLOADED") {
                uploadImageFormData = null;
                importImagesId = d.fileName;
                $("#activityStatus").append("</br>Uploaded <b>" + d.imagesCount + "</b> images");
                if(d.mismatchedFiles){
                    $("#activityStatus").append("</br><label class='error-red'>Mismatched image names found: <b>" + d.mismatchedFiles.split(',').length + "</b></label>");
                    $("#activityStatus").append("</br><label class='error-red'>Mismatched image names: <i>" + d.mismatchedFiles + "</i></label>");
                    $("#activityStatus").append("</br>(Please correlate your image column names with the zipped images)")
                }
            }
        },
        error: function(e) {
            
        }
    });
}

const importData = () => {

    var _col = [];
    /* $("input[id*=source_]").forEach((elem) => {
        if(elem.is(':enabled'))
            _col.push({
                id: elem.id
            })
    }); */

    var isTableSelected = true;
    var isColumnSelected = true;
    var latitudeSelected = true;
    var longitudeSelected = true;
    var _columnsArray = [];
    var selectedColumnsArr = [];
    $("input[id*=target_import_column_]").each(function () {
        if($("#" + this.id).is(":checked")) {
            selectedColumnsArr.push('target_table_' + this.id.substr('target_import_column_'.length, this.id.length));
        }
    });
    selectedColumnsArr.forEach(function(item) {
        if($("#" + item).val() == "-Select-")
            isTableSelected = false;
    });

    if(!isTableSelected) {
        alert("Select a table first");
        return;
    }

    $("select[id*=target_columns_]").each(function () {
        if($("#" + this.id).val() == "-Select-")
            isColumnSelected = false;
    });

    $("select[id*=target_columns_]").each(function () {
        _columnsArray.push($("#" + this.id).val());
        
    });

    if(jQuery.inArray("decimal_latitude", _columnsArray) == -1) {
        alert("Select decimal_latitude column from the location table");
        return;
    }

    if(jQuery.inArray("decimal_longitude", _columnsArray) == -1) {
        alert("Select decimal_longitude column from the location table");
        return;
    }

    if(!isColumnSelected) {
        alert("Select a column first");
        return;
    }

    $("input[id*=source_]").each(function () {
        if($("#" + this.id).is(':enabled')) {
            var _id = this.id.substr("source_".length);
            var t = sheetColumns.filter((x) => x.simplifiedColumnName == this.id.substr("source_".length))
            _col.push({
                sourceColumn:       t[0].originalColumnName,
                targetTable:        $("#target_table_" + _id).val(),
                targetColumn:       $("#target_columns_" + _id).val(),
                targetColumnType:   $("#target_columns_type_" + _id).val()
            });
        }
    })
    console.log(_col);
    $("input:checkbox[id*=image_column]").each(function() {
        if($(this).is(":checked")) {
            var imageColumnNameItem = sheetColumns.filter((x) => x.simplifiedColumnName == ($("#source_" + this.id.substr("target_image_column_".length)).val()));
            imageColumnName = imageColumnNameItem[0].originalColumnName;
            console.log(imageColumnName);
            $("#imageColumnName").val(imageColumnName);
        }
    });
    console.log("imageSelected: " + imageSelected);
    if($("#uploadImageFormFileUpload").val() == "" && imageSelected)
    {
        alert("Please select an image zip file to upload");
        return;
    }
    $("#dataUploadColumns").val(JSON.stringify(_col));
    $("#importExcelId").val(importExcelId);
    $("#dataUploadUserId").val(userId);
    uploadImageFormData = new FormData($('#uploadImageForm')[0]);
    /* var data = {
        importExcelId,
        importImagesId,
        imageColumnName,
        columns: JSON.stringify(_col),
        dataUploadUserId: 'b95998da-ad7d-43bf-9274-572920b7d4f0'
    } */
    console.log(uploadImageFormData);
    //return;
    $.ajax({
        type: 'POST',
        url : uploadDataURL,
        data: uploadImageFormData,
        dataType: 'json',
        contentType: false,
        processData: false,
        beforeSend: function() { $("#overlay").fadeIn(300); },
        success: function(d) {
            if(d.status == "SUCCESS") {
                setTimeout(function() { $("#overlay").fadeOut(300); },500);
		alert("Your data has been uploaded and you can find it in the My Data tab with the id: " + d.responseObject);
		$("#activityStatus").html("</br><label>Your data has been uploaded and you can find it in the My Data tab with the id: <b>" + d.responseObject + "</b></label>");
                getUploadedDataSession();
            }
            if(d.status == "DATATYPEMISMATCH") {
                $("#activityStatus").html("</br><label class='error-red'>Mismatched data type found for column: <b>" + d.sourceColumn + "</b> and <b>" + d.targetColumn + "</b>. The source column data type must be of type <b>" + d.targetColumnType + "</b>.</label>");
            }
        },
        error: function(e) {
            setTimeout(function() { $("#overlay").fadeOut(300); },500);
            $("#activityStatus").html("</br><label class='error-red'>Mismatched image names found: <b>" + e + "</b></label>");
        }
    });
}

const getUploadedDataSession = () => {
    var data = {
        userId: userId
    };
    $.ajax({
        type: 'POST',
        url : getUploadedDataSessionsURL,
        data: JSON.stringify(data),
        dataType: 'json',
        success: function(d) {
            console.log(d.data);
            if(d.data){
                $("#uploadedDataSessionsTable>tbody").empty();
                d.data.forEach((item) => {
		    if(parseInt(item.sp_datasets_exists) == 0) {
			$("#uploadedDataSessionsTable>tbody").append("<tr>"
                    	+ "<td>" + item.sp_upload_session_id + " </td>"
                    	+ "<td>" + item.sp_uploaded_records_count + " </td>"
                    	+ "<td>" + item.sp_uploaded_images_count + " </td>"
                    	+ "<td>" + item.sp_uploaded_timestamp + " </td>"
                    	+ "<td><input id='delete_" + item.sp_upload_session_id + "' type='button' class='btn btn-danger' onclick='deleteUploadedDataSession(this.id)' value='Delete Records'></td>"
                    	+ "<td><button  id='attribute_" + item.sp_upload_session_id + "' type='button' class='btn btn-success' data-toggle='modal' data-target='#exampleModal' onclick='DataAttr(this.id)'>Attribution</button></td>"
		    	+ "</tr>");
		    }
                    else {
			$("#uploadedDataSessionsTable>tbody").append("<tr>"
                    	+ "<td>" + item.sp_upload_session_id + " </td>"
                    	+ "<td>" + item.sp_uploaded_records_count + " </td>"
                    	+ "<td>" + item.sp_uploaded_images_count + " </td>"
                    	+ "<td>" + item.sp_uploaded_timestamp + " </td>"
                    	+ "<td><input id='delete_" + item.sp_upload_session_id + "' type='button' class='btn btn-danger' onclick='deleteUploadedDataSession(this.id)' value='Delete Records'></td>"
                    	+ "<td> Attribution exists </td>"
			+ "</tr>");
		    }
                });
            }
        },
        error: function(e) {
            
        }
    });
}

const deleteUploadedDataSession = (sessionId) => {
    if (confirm('Are you sure you want to delete all the uploaded records for this session?')) {
        console.log("sessionId: " + sessionId.split("_")[1]);
        var data = {
            userId: userId,
            sessionId: sessionId.split("_")[1]
        };
        $.ajax({
            type: 'POST',
            url : deleteUploadedDataSessionURL,
            data: JSON.stringify(data),
            dataType: 'json',
            success: function(d) {
                if(d.data[0].sp_deleteuploadedsatasession == "DELETED")
                    getUploadedDataSession();
            },
            error: function(e) {
                getUploadedDataSession();
            }
        });
    } else {
        // Do nothing!
    }
}

const resetImportDataForm = () => {
    $("#uploadDataFormFileUpload").val("");
    $("#uploadImageFormFileUpload").val("");
    $("#imageColumnName").val("");
    $("#importExcelId").val("");
    uploadExcelFormData = null;
    uploadImageFormData = null;
    $("#activityStatus").html("<b>Status</b>");
    $("#columnsMappingTable>tbody").empty();
}

function DataAttr(sessionId)
{
    //alert(sessionId.split("_")[1]); return false;
    var uploadDataId= sessionId.split("_")[1];
    var InPut = '<input type="hidden" name="UploadDataID" value='+uploadDataId+'>';
    $("#uploadDataIDD").append(InPut);
}