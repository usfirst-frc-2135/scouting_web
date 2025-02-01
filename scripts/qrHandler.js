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
  if (dataList.length != 40) {
    return false;
  }
  return true;
}
//update this data list length whenever new data is added to the table
function padList(dataList) {
  if (dataList.length == 39) {
    dataList.push("");
  }
  return dataList;
}
//IMPORTANT! also need to adjust data list size in "validateQrList" and "padList"!!!
function qrListToDict(dataList) {
  out = {};
  out["teamnumber"] = dataList[0];
  out["autonStartingPosition"] = dataList[1];
  out["autonLeave"] = dataList[2];
  out["autonCoralL1"] = dataList[3];
  out["autonCoralL2"] = dataList[4];
  out["autonCoralL3"] = dataList[5];
  out["autonCoralL4"] = dataList[6];
  out["autonAlgaeNet"] = dataList[7];
  out["autonAlgaeProcessor"] = dataList[8];
  out["autonCoralFloor"] = dataList[9];
  out["autonCoralStation"] = dataList[10];
  out["autonAlgaeFloor"] = dataList[11];
  out["autonAlgaeReef"] = dataList[12];
  out["teleopAcquireCoral"] = dataList[13];
  out["teleopAcquireAlgae"] = dataList[14];
  out["teleopAlgaeFloorPickup"] = dataList[15];
  out["teleopCoralFloorPickup"] = dataList[16];
  out["teleopKnockOffAlgae"] = dataList[17];
  out["teleopAcquireAlgaeReef"] = dataList[18];
  out["teleopHoldBothElements"] = dataList[19];
  out["teleopCoralL1"] = dataList[20];
  out["teleopCoralL2"] = dataList[21];
  out["teleopCoralL3"] = dataList[22];
  out["teleopCoralL4"] = dataList[23];
  out["teleopAlgaeNet"] = dataList[24];
  out["teleopAlgaeProcessor"] = dataList[25];
  out["teleopDefenseLevel"] = dataList[26];
  out["teleopPinFoul"] = dataList[27];
  out["teleopAnchorFoul"] = dataList[28];
  out["teleopCageFoul"] = dataList[29];
  out["teleopBargeZoneFoul"] = dataList[30];
  out["teleopReefZoneFoul"] = dataList[31];
  out["endgameClimbLevel"] = dataList[32];
  out["endgameStartClimbing"] = dataList[33];
  out["endgameFoulNumber"] = dataList[34];
  out["died"] = dataList[35];
  out["matchnumber"] = dataList[36];
  out["eventcode"] = dataList[37];
  out["scoutname"] = dataList[38];
  out["comment"] = dataList[39];
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
