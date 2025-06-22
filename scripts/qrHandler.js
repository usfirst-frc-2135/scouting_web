/*
  Global Variable Definition
*/
let scannedData = {};
let scannedCount = 0;

/*
  Function Definition
*/

// Convert the scanned QR string to a list
function qrStringToList(dataString) {
  let out = dataString.trim().split("\t");
  for (let i = 0; i < out.length; ++i) {
    out[i] = out[i].trim();
  }
  return out;
}

const qrValidLength = 41;   // This is determined by game requirements and adjusted each year
const qrPadLength = 1;      // TODO: no explanation why this is padded--did we delete something?

// Validate the scanned QR string
function validaateQrList(qrDataList) {
  console.log("===> validaateQrList: qrDataList.length = " + qrDataList.length + " (valid " + qrValidLength + ")");
  if (qrDataList.length != qrValidLength) {
    console.warn("   ===> validaateQrList: returning false! ");
    return false;
  }
  console.log("   ===> validaateQrList: returning true! ");
  return true;
}

// update this data list length whenever more data is added to the table
function padList(dataList) {
  if (dataList.length === qrValidLength - qrPadLength) {
    dataList.push("");
    console.warn("Padding QR scan! (Why?)")
  }
  return dataList;
}

// IMPORTANT! also need to adjust data list size in "validaateQrList" and "padList"!!!
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

// Creates the key used to store the QR scan in the database
function qrListToKey(dataObj) {
  return dataObj["eventcode"] + "_" + dataObj["matchnumber"] + "_" + dataObj["teamnumber"];
}

// Adds a QR scan to the table of scans
function addQrScanToTable(tableId, dataObj) {
  let key = qrListToKey(dataObj);

  if (!scannedData.hasOwnProperty(key)) {
    // Modify global variables
    scannedData[key] = dataObj;
    ++scannedCount;
    document.getElementById("submitData").innerHTML = "Submit Data: " + scannedCount;
    let tbodyRef = document.getElementById(tableId).querySelector('tbody');
    row = tbodyRef.insertRow();
    row.id = key + "_row";
    row.innerHTML =
      "<td>" + dataObj["eventcode"] + "</td>" +
      "<td>" + dataObj["matchnumber"] + "</td>" +
      "<td>" + dataObj["teamnumber"] + "</td>" +
      "<td>" + dataObj["scoutname"] + "</td>" +
      "<td> <button id='" + key + "_delete' value='" + key + "' class='btn btn-danger' type='button'>Delete</button></td?";

    // Add delete button
    document.getElementById(key + "_delete").addEventListener('click', function () {
      removeQrScanEntry(this.value);
    });
  }
}

// Removes a QR scan row and cleans up
function removeQrScanEntry(dataKey) {
  if (scannedData.hasOwnProperty(dataKey)) {
    // Modify global variables
    delete scannedData[dataKey];
    --scannedCount;
    document.getElementById("submitData").innerHTML = "Submit Data: " + scannedCount;
    // Modify table
    document.getElementById(dataKey + "_row").remove();
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
  if (defaultId === null) {
    return id;
  }
  else {
    return defaultId;
  }
}

// Responsible for handling actions that occur when camera is scanning
function scanCamera(reader, id) {
  reader.decodeFromInputVideoDeviceContinuously(id, 'camera', (result, err) => {
    if (result) {
      let dataList = qrStringToList(result.text);
      dataList = padList(dataList);
      console.log("scanCamera: dataList = " + dataList);
      if (validaateQrList(dataList)) {
        alertSuccessfulScan();
        addQrScanToTable("qrScanTable", qrListToDict(dataList));
      }
      else {
        alert("QR content failed validation!");
      }
    }
  });
}

// Alerts user of a successful scan
function alertSuccessfulScan() {
  try {
    window.navigator.vibrate(200); // Chrome throws an "intervention" if window is not clicked first!
  }
  catch (exception) {
    alert("Vibrate notification request failed!")
  }
  document.getElementById("content").classList.add("bg-success");
  setTimeout(function () {
    document.getElementById("content").classList.remove("bg-success");
  }, 500);
}

/*
  Function bound to the QR Reader
  Handles reading the different cameras connected to device
*/
function createCameraSelector(cameraId, reader) {

  reader.getVideoInputDevices().then((videoInputDevices) => {
    // Creates drop down menu to change between cameras
    let initialId = null;
    if (videoInputDevices.length >= 1) {
      videoInputDevices.forEach((element) => {
        if (initialId === null) {
          initialId = element.deviceId;
        }
        $(cameraId).append($("<option>", { value: element.deviceId, text: element.label }));
      });
    }

    // Creates default camera scanner based on saved data
    scanCamera(reader, getDefaultDeviceID(initialId));

    // Binds drop down on change to select another camera when necessary
    document.getElementById(cameraId).addEventListener('change', function () {
      let selCamID = document.getElementById(cameraId).value;
      scanCamera(reader, selCamID);
      setDefaultDeviceID(selCamID);
    });
  });
}

// Clear the scanned data to reset for more scans
function clearScannedData() {
  document.getElementById("qrValidationTable").innerHTML = "";
  scannedCount = 0;
  scannedData = {};
}

// Send scanned match data to the database
function submitScannedData() {
  let indexedData = [];
  for (const [key, value] of Object.entries(scannedData)) {
    indexedData.push(value);
  }
  if (indexedData.length == 0)
    alert("Data NOT Submitted. (no entries found!)");
  else {
    $.post("api/dbWriteAPI.php", {
      writeTeamMatch: JSON.stringify(indexedData)
    }, function (response) {
      console.log("=> writeTeamMatch: " + JSON.stringify(response));
      // Because success word may have a newline at the end, don't do a direct compare
      if (response.indexOf('success') > -1) {
        alert("Data Successfully Submitted! Clearing Data.");
        clearScannedData();
        document.getElementById("submitData").innerHTML = "Click to Submit Data: " + scannedCount;
      } else {
        alert("Data NOT Submitted. (is this a duplicate?)");
        console.warn("Data NOT Submitted. (is this a duplicate?)");
      }
    });
  }
}

/////////////////////////////////////////////////////////////////////////////
//
// Process the generated html
//
document.addEventListener("DOMContentLoaded", () => {

  const reader = new ZXing.BrowserQRCodeReader();
  createCameraSelector("cameraSelector", reader);

  document.getElementById("submitData").addEventListener('click', function () {
    submitScannedData();
  });
});
