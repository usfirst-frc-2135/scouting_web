/*
  Global Variable Definition
*/
var scannedData = {};
var scannedCount = 0;
var localStore = window.localStorage;
/*
  Function Definition
*/

function qrStringToList(dataString) {
  out = dataString.trim().split("\t");
  for (var i = 0; i < out.length; ++i) {
    out[i] = out[i].trim();
  }
  return out;
}

function validateQrList(dataList) {
  var dataListSize = dataList.length;
  if (dataList.length != 15) {
    return false;
  }
  return true;
}

function padList(dataList) {
  if (dataList.length == 14) {
    dataList.push("");
  }
  return dataList;
}
//also need to adjust data list size in "validateQrList" and "padList"!!!
function qrListToDict(dataList) {
  out = {};
  out["teamnumber"] = dataList[0];
  out["autonleave"] = dataList[1];
  out["autonampnotes"] = dataList[2];
  out["autonspeakernotes"] = dataList[3];
  out["teleopampnotes"] = dataList[4];
  out["teleopspeakernotes"] = dataList[5];
  out["endgamestage"] = dataList[6];
  out["endgameharmony"] = dataList[7];
  out["endgamespotlit"] = dataList[8];
  out["endgametrap"] = dataList[9];
  out["died"] = dataList[10];
  out["matchnumber"] = dataList[11];
  out["eventcode"] = dataList[12];
  out["scoutname"] = dataList[13];
  out["comment"] = dataList[14];
  return out;
}

function qrListToKey(dataObj) {
  return dataObj["eventcode"] + "_" + dataObj["matchnumber"] + "_" + dataObj["teamnumber"];
}

function addQrData(dataObj) {
  var key = qrListToKey(dataObj);

  if (!scannedData.hasOwnProperty(key)) {
    // Modify global variables
    scannedData[key] = dataObj;
    ++scannedCount;
    $("#submitData").html("Submit Data: " + scannedCount);
    // Modify table
    $("#qrValidationTable").append(
      $("<tr>").append([
        $("<td>").text(dataObj["eventcode"]),
        $("<td>").text(dataObj["matchnumber"]),
        $("<td>").text(dataObj["teamnumber"]),
        $("<td>").text(dataObj["scoutname"]),
        $("<td>").append(
          "<button id='" + key + "_delete' value='" + key + "' type='button' class='btn btn-danger deleteRowButton'>Delete</button>"
        )
      ]).prop("id", key + "_row")
    );
    // Add delete button
    $("#" + key + "_delete").on('click', function (event) {
      removeQrData($(this).val());
    });
  }
}

function removeQrData(dataKey) {
  if (scannedData.hasOwnProperty(dataKey)) {
    // Modify global variables
    delete scannedData[dataKey];
    --scannedCount;
    $("#submitData").html("Submit Data: " + scannedCount);
    // Modify table
    $("#" + dataKey + "_row").remove();
  }
}

/*
  Saves default camera ID to localStorage for on reload camera config persistence
*/
function setDefaultDeviceID(id) {
  localStorage.setItem("cameraDefaultID", id);
}

/*
  Reads default camera ID from localStorage, or passes default first ID
*/
function getDefaultDeviceID(id) {
  var defaultId = localStorage.getItem("cameraDefaultID");
  if (defaultId == null) {
    return id;
  }
  else {
    return defaultId;
  }
}

/*
  Responsible for handling actions that occur when camera is scanning
*/
function scanCamera(reader, id) {
  reader.decodeFromInputVideoDeviceContinuously(id, 'camera', (result, err) => {
    if (result) {
      var dataList = qrStringToList(result.text);
      dataList = padList(dataList);
      console.log("scanCamera: dataList = "+dataList);
      if (validateQrList(dataList)) {
        alertSuccessfulScan();
	    addQrData(qrListToDict(dataList));
      }
      else {
        alert("QR data failed validation!");
      }
    }
  });
}

function alertSuccessfulScan() {
  try {
    window.navigator.vibrate(200);
  }
  catch (exception) {

  }
  $("#content").addClass("bg-success");
  var timeoutFunction = setTimeout(function () { $("#content").removeClass("bg-success"); }, 500);
}

/*
  Function bound to the QR Reader
  Handles reading the different cameras connected to device
*/
function createCameraSelect(reader) {
  reader.getVideoInputDevices().then((videoInputDevices) => {

    // Creates drop down menu to switch between cameras
    var initial_id = null;
    if (videoInputDevices.length >= 1) {
      videoInputDevices.forEach((element) => {
        if (initial_id == null) {
          initial_id = element.deviceId;
        }
        $("#cameraSelect").append($('<option>', { value: element.deviceId, text: element.label }));
      });
    }

    // Creates default camera scanner based on saved data
    scanCamera(reader, getDefaultDeviceID(initial_id));

    // Binds drop down on change to select new camera when necessary
    $("#cameraSelect").change(function () {
      var selCamID = $("#cameraSelect").val();
      scanCamera(reader, selCamID);
      setDefaultDeviceID(selCamID);
    });
  });
}

function clearData() {
  $("#qrValidationTable").html("");
  scannedCount = 0;
  scannedData = {};
}

/*
  Submit Function
*/
function submitFunction() {
  $("#submitData").on('click', function (event) {
    var indexedData = [];
    for (const [key, value] of Object.entries(scannedData)) {
      indexedData.push(value);
    }
    $.post("writeAPI.php", { "writeData": JSON.stringify(indexedData) }, function (data) {
      // Because success word may have a new-line at the end, don't do a direct compare
      if (data.indexOf('success') > -1) {
        alert("Data Successfully Submitted! Clearing Data.");
        clearData();
        $("#submitData").html("Click to Submit Data: " + scannedCount);
      } else {
        alert("Data NOT Submitted.");
      }
    });
  });
}

$(document).ready(function () {
  const reader = new ZXing.BrowserQRCodeReader();

  createCameraSelect(reader);

  submitFunction();

});
