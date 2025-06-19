/*
  Global Variable Definition
*/
let scannedData = {};
let scannedCount = 0;
// let localStore = window.localStorage;

/*
  Function Definition
*/

function qrStringToList(dataString) {
  let out = dataString.trim().split("\t");
  for (let i = 0; i < out.length; ++i) {
    out[i] = out[i].trim();
  }
  return out;
}

function validateQrList(dataList) {
  const dataListSize = dataList.length;
  const validLength = 41;
  console.log("===> validateQrList(): dataList.length = " + dataListSize + " (valid " + validLength + ")");
  if (dataListSize != validLength) {
    console.warn("   ===> validateQrList(): returning false! ");
    return false;
  }
  console.log("   ===> validateQrList(): returning true! ");
  return true;
}
// update this data list length whenever new data is added to the table
function padList(dataList) {
  if (dataList.length == 40) {
    dataList.push("");
  }
  return dataList;
}
// IMPORTANT! also need to adjust data list size in "validateQrList" and "padList"!!!
function qrListToDict(dataList) {
  let out = {};
  out["teamnumber"] = dataList[0];
  out["autonStartPos"] = dataList[1];
  out["autonLeave"] = dataList[2];
  out["reefzoneAB"] = dataList[3];
  out["reefzoneCD"] = dataList[4];
  out["reefzoneEF"] = dataList[5];
  out["reefzoneGH"] = dataList[6];
  out["reefzoneIJ"] = dataList[7];
  out["reefzoneKL"] = dataList[8];
  out["autonCoralL1"] = dataList[9];
  out["autonCoralL2"] = dataList[10];
  out["autonCoralL3"] = dataList[11];
  out["autonCoralL4"] = dataList[12];
  out["autonAlgaeNet"] = dataList[13];
  out["autonAlgaeProcessor"] = dataList[14];
  out["autonCoralFloor"] = dataList[15];
  out["autonCoralStation"] = dataList[16];
  out["autonAlgaeFloor"] = dataList[17];
  out["autonAlgaeReef"] = dataList[18];
  out["acquiredCoral"] = dataList[19];
  out["acquiredAlgae"] = dataList[20];
  out["teleopAlgaeFloorPickup"] = dataList[21];
  out["teleopCoralFloorPickup"] = dataList[22];
  out["teleopKnockOffAlgae"] = dataList[23];
  out["teleopAlgaeFromReef"] = dataList[24];
  out["teleopHoldBoth"] = dataList[25];
  out["teleopCoralL1"] = dataList[26];
  out["teleopCoralL2"] = dataList[27];
  out["teleopCoralL3"] = dataList[28];
  out["teleopCoralL4"] = dataList[29];
  out["teleopAlgaeNet"] = dataList[30];
  out["teleopAlgaeProcessor"] = dataList[31];
  out["defenseLevel"] = dataList[32];
  out["cageClimb"] = dataList[33];
  out["startClimb"] = dataList[34];
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
  let key = qrListToKey(dataObj);

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
          "<button id='" + key + "_delete' value='" + key + "' class='btn btn-danger deleteRowButton type='button''>Delete</button>"
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
  let defaultId = localStorage.getItem("cameraDefaultID");
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
      let dataList = qrStringToList(result.text);
      dataList = padList(dataList);
      console.log("scanCamera: dataList = " + dataList);
      if (validateQrList(dataList)) {
        alertSuccessfulScan();
        addQrData(qrListToDict(dataList));
      }
      else {
        alert("QR content failed validation!");
      }
    }
  });
}

function alertSuccessfulScan() {
  try {
    // window.navigator.vibrate(200);
  }
  catch (exception) {

  }
  $("#content").addClass("bg-success");
  let timeoutFunction = setTimeout(function () { $("#content").removeClass("bg-success"); }, 500);
}

/*
  Function bound to the QR Reader
  Handles reading the different cameras connected to device
*/
function createCameraSelect(reader) {
  reader.getVideoInputDevices().then((videoInputDevices) => {

    // Creates drop down menu to switch between cameras
    let initialId = null;
    if (videoInputDevices.length >= 1) {
      videoInputDevices.forEach((element) => {
        if (initialId == null) {
          initialId = element.deviceId;
        }
        $("#cameraSelect").append($('<option>', { value: element.deviceId, text: element.label }));
      });
    }

    // Creates default camera scanner based on saved data
    scanCamera(reader, getDefaultDeviceID(initialId));

    // Binds drop down on change to select new camera when necessary
    $("#cameraSelect").change(function () {
      let selCamID = $("#cameraSelect").val();
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
    let indexedData = [];
    for (const [key, value] of Object.entries(scannedData)) {
      indexedData.push(value);
    }

    $.post("api/dbWriteAPI.php", {
      writeTeamMatch: JSON.stringify(indexedData)
    }, function (response) {
      console.log("=> writeTeamMatch: " + JSON.stringify(response));
      // Because success word may have a new-line at the end, don't do a direct compare
      if (response.indexOf('success') > -1) {
        alert("Data Successfully Submitted! Clearing Data.");
        clearData();
        $("#submitData").html("Click to Submit Data: " + scannedCount);
      } else {
        alert("Data NOT Submitted. (is this a duplicate?)");
      }
    });
  });
}

//
// Process the generated html
//
$(document).ready(function () {
  const reader = new ZXing.BrowserQRCodeReader();

  createCameraSelect(reader);

  submitFunction();
});
