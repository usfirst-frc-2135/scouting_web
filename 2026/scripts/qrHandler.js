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
function validaateQrList(qrList) {
  console.log("===> validaateQrList: qrList.length = " + qrList.length + " (valid " + qrValidLength + ")");
  if (qrList.length != qrValidLength) {
    console.warn("   ===> validaateQrList: returning false! ");
    return false;
  }
  console.log("   ===> validaateQrList: returning true! ");
  return true;
}

// update this data list length whenever more data is added to the table
function padList(qrList) {
  if (qrList.length === qrValidLength - qrPadLength) {
    qrList.push("");
    console.warn("Padding QR scan! (Why?)")
  }
  return qrList;
}

// IMPORTANT! also need to adjust data list size in "validaateQrList" and "padList"!!!
function qrListToMatchData(qrList) {
  let matchData = {};
  matchData["teamnumber"] = qrList[0];
  matchData["autonStartPos"] = qrList[1];
  matchData["autonLeave"] = qrList[2];
  matchData["reefzoneAB"] = qrList[3];
  matchData["reefzoneCD"] = qrList[4];
  matchData["reefzoneEF"] = qrList[5];
  matchData["reefzoneGH"] = qrList[6];
  matchData["reefzoneIJ"] = qrList[7];
  matchData["reefzoneKL"] = qrList[8];
  matchData["autonCoralL1"] = qrList[9];
  matchData["autonCoralL2"] = qrList[10];
  matchData["autonCoralL3"] = qrList[11];
  matchData["autonCoralL4"] = qrList[12];
  matchData["autonAlgaeNet"] = qrList[13];
  matchData["autonAlgaeProcessor"] = qrList[14];
  matchData["autonCoralFloor"] = qrList[15];
  matchData["autonCoralStation"] = qrList[16];
  matchData["autonAlgaeFloor"] = qrList[17];
  matchData["autonAlgaeReef"] = qrList[18];
  matchData["acquiredCoral"] = qrList[19];
  matchData["acquiredAlgae"] = qrList[20];
  matchData["teleopAlgaeFloorPickup"] = qrList[21];
  matchData["teleopCoralFloorPickup"] = qrList[22];
  matchData["teleopKnockOffAlgae"] = qrList[23];
  matchData["teleopAlgaeFromReef"] = qrList[24];
  matchData["teleopHoldBoth"] = qrList[25];
  matchData["teleopCoralL1"] = qrList[26];
  matchData["teleopCoralL2"] = qrList[27];
  matchData["teleopCoralL3"] = qrList[28];
  matchData["teleopCoralL4"] = qrList[29];
  matchData["teleopAlgaeNet"] = qrList[30];
  matchData["teleopAlgaeProcessor"] = qrList[31];
  matchData["defenseLevel"] = qrList[32];
  matchData["cageClimb"] = qrList[33];
  matchData["startClimb"] = qrList[34];
  matchData["died"] = qrList[35];
  matchData["matchnumber"] = qrList[36];
  matchData["eventcode"] = qrList[37];
  matchData["scoutname"] = qrList[38];
  matchData["comment"] = qrList[39];
  return matchData;
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
    document.getElementById("submitData").innerText = "Submit Data: " + scannedCount;
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
    document.getElementById("submitData").innerText = "Submit Data: " + scannedCount;
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
      let qrList = qrStringToList(result.text);
      qrList = padList(qrList);
      console.log("scanCamera: qrList = " + qrList);
      if (validaateQrList(qrList)) {
        alertSuccessfulScan();
        addQrScanToTable("qrScanTable", qrListToMatchData(qrList));
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

  // Creates drop down menu to change between cameras
  reader.getVideoInputDevices().then((videoInputDevices) => {
    let initialId = null;
    let select = document.getElementById(cameraId);
    console.log("getVideoInputDevices: Camera count: " + videoInputDevices.length);
    if (videoInputDevices.length >= 1) {
      videoInputDevices.forEach((element) => {
        if (initialId === null) {
          initialId = element.deviceId;
        }

        let option = document.createElement('option');
        option.value = element.deviceId;
        option.innerHTML = element.label;
        select.appendChild(option);
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
        document.getElementById("submitData").innerText = "Click to Submit Data: " + scannedCount;
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
