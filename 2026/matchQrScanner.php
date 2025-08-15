<?php
$title = 'QR Scanner';
require 'inc/header.php';
?>

<div class="container row-offcanvas row-offcanvas-left">
  <div id="content" class="column card-lg-12 col-sm-12 col-xs-12">

    <!-- Page Title -->
    <div class="row pt-3 pb-3 mb-3">
      <div class="row justify-content-md-center">
        <h2 class="col-md-6"><?php echo $title; ?></h2>
      </div>

      <!-- Main card to hold the QR scanner -->
      <div class="card col-md-6 mx-auto">
        <div class="card-body">
          <div id="interactive" class="viewport mt-3">
            <video id="camera" class="col-12" autoplay="true"></video>
          </div>
          <select id="cameraSelector" class="form-select mb-3" aria-label="Camera Select">
          </select>
          <div class="d-grid gap-2 col-6 mx-auto">
            <button id="submitData" class="btn btn-success mb-3" type="button"></button>
          </div>
        </div>
      </div>

    </div>

    <table id="qrScanTable" class="table">
      <thead>
        <tr>
          <th scope="col">Event Code</th>
          <th scope="col">Match Number</th>
          <th scope="col">Team Number</th>
          <th scope="col">Scout</th>
          <th scope="col">Delete</th>
        </tr>
      </thead>
      <tbody class="table-group-divider"> </tbody>
    </table>

  </div>
</div>

<?php include 'inc/footer.php'; ?>

<!-- Javascript page handlers -->

<script>

  const qrValidLength = 41;   // This is determined by game requirements and adjusted each year
  const qrPadLength = 1;      // TODO: no explanation why this is padded--did we delete something?

  // update this data list length whenever more data is added to the table
  function padList(qrList) {
    if (qrList.length === qrValidLength - qrPadLength) {
      qrList.push("");
      console.warn("Padding QR scan! (Why is this needed?)");
    }
    return qrList;
  }
  // Validate the scanned QR string
  function validateQrList(qrList) {
    console.log("==> validateQrList: qrList.length = " + qrList.length + " (valid " + qrValidLength + ")");
    if (qrList.length != qrValidLength) {
      console.warn("===> validateQrList: returning false! ");
      return false;
    }
    console.log("===> validateQrList: returning true! ");
    return true;
  }

  // Convert the scanned QR string to a list
  function qrStringToList(dataString) {
    let out = dataString.trim().split("\t");
    for (let i = 0; i < out.length; ++i) {
      out[i] = out[i].trim();
    }
    return out;
  }

  // IMPORTANT! also need to adjust data list size in "validateQrList" and "padList"!!!
  //  TODO: For 2026, please change the field order to put year-specific items LAST (order is suggested below in comments)
  //  TODO: For 2026, remove any undocumented "padding" on the structure. Just declare an "other" field.
  //  TODO: Also for 2026, add about 3-5 "other" fields to the QR list so it can be slightly appended without breaking
  function qrListToMatchData(qrList) {
    let matchData = {};
    // Perennial fields that always occur
    matchData["eventcode"] = qrList[37];      // Make this [0] in 2026
    matchData["matchnumber"] = qrList[36];    // Make this [1] in 2026
    matchData["teamnumber"] = qrList[0];      // Make this [2] in 2026
    matchData["scoutname"] = qrList[38];      // Make this [3] in 2026

    // Game or year-specific fields below here!

    // Autonomous
    // matchData["autonStartPos"] = qrList[1];   // UNUSED
    matchData["autonLeave"] = qrList[2];
    // matchData["reefzoneAB"] = qrList[3];      // UNUSED
    // matchData["reefzoneCD"] = qrList[4];      // UNUSED
    // matchData["reefzoneEF"] = qrList[5];      // UNUSED
    // matchData["reefzoneGH"] = qrList[6];      // UNUSED
    // matchData["reefzoneIJ"] = qrList[7];      // UNUSED
    // matchData["reefzoneKL"] = qrList[8];      // UNUSED
    matchData["autonCoralL1"] = qrList[9];
    matchData["autonCoralL2"] = qrList[10];
    matchData["autonCoralL3"] = qrList[11];
    matchData["autonCoralL4"] = qrList[12];
    matchData["autonAlgaeNet"] = qrList[13];
    matchData["autonAlgaeProcessor"] = qrList[14];
    // matchData["autonCoralFloor"] = qrList[15];    // UNUSED
    // matchData["autonCoralStation"] = qrList[16];  // UNUSED
    // matchData["autonAlgaeFloor"] = qrList[17];    // UNUSED
    // matchData["autonAlgaeReef"] = qrList[18];     // UNUSED

    // Teleop
    matchData["acquiredCoral"] = qrList[19];
    matchData["acquiredAlgae"] = qrList[20];
    // matchData["teleopAlgaeFloorPickup"] = qrList[21]; // UNUSED
    // matchData["teleopCoralFloorPickup"] = qrList[22]; // UNUSED
    // matchData["teleopKnockOffAlgae"] = qrList[23];    // UNUSED
    // matchData["teleopAlgaeFromReef"] = qrList[24];    // UNUSED
    // matchData["teleopHoldBoth"] = qrList[25];         // UNUSED
    matchData["teleopCoralL1"] = qrList[26];
    matchData["teleopCoralL2"] = qrList[27];
    matchData["teleopCoralL3"] = qrList[28];
    matchData["teleopCoralL4"] = qrList[29];
    matchData["teleopAlgaeNet"] = qrList[30];
    matchData["teleopAlgaeProcessor"] = qrList[31];

    // Defense notes
    // matchData["defenseLevel"] = qrList[32];           // UNUSED

    // Endgame
    matchData["cageClimb"] = qrList[33];
    // matchData["startClimb"] = qrList[34];             // UNUSED

    // Overall
    matchData["died"] = qrList[35];
    // qrList[36] see above
    // qrList[37] see above
    // qrList[38] see above
    matchData["comment"] = qrList[39];
    return matchData;
  }

  // Creates the key used to store the QR scan in the database
  function getKeyForMatchData(matchData) {
    return matchData["eventcode"] + "_" + matchData["matchnumber"] + "_" + matchData["teamnumber"];
  }

  // Adds a QR scan to the table of scans
  function addMatchDataToTable(tableId, matchData, scannedMatches) {
    let key = getKeyForMatchData(matchData);

    console.log("addMatchDataToTable: Checking for key in scannedMatches: " + key + " " + scannedMatches);

    if (!Object.prototype.hasOwnProperty.call(scannedMatches, key)) {
      // Modify global variables
      if (matchData["eventcode"] === frcEventCode) {
        console.warn("Event code does not match the one in db_config!");
        alert("QR event code does not match the one in db_config!"); // this is a passive notification - return if we want to prevent this
      }
      scannedMatches[key] = matchData;
      updateScannedMatchCount(scannedMatches);
      let tbodyRef = document.getElementById(tableId).querySelector('tbody');
      let row = tbodyRef.insertRow();
      row.id = key + "_row";
      row.innerHTML = "";
      row.innerHTML += "<td>" + matchData["eventcode"] + "</td>";
      row.innerHTML += "<td>" + matchData["matchnumber"] + "</td>";
      row.innerHTML += "<td>" + matchData["teamnumber"] + "</td>";
      row.innerHTML += "<td>" + matchData["scoutname"] + "</td>";
      row.innerHTML += "<td> <button id='" + key + "_delete' value='" + key + "' class='btn btn-danger' type='button'>Delete</button></td?";

      // Add delete button
      document.getElementById(key + "_delete").addEventListener('click', function () {
        removeQrScanEntry(this.value, scannedMatches);
      });
    }
    else {
      console.log("addMatchDataToTable: scannedMatches already has that key!");
    }
  }

  // Removes a QR scan row and cleans up
  function removeQrScanEntry(dataKey, scannedMatches) {
    if (Object.prototype.hasOwnProperty.call(scannedMatches, dataKey)) {
      // Remove the match data, update the count, remove the row
      delete scannedMatches[dataKey];
      updateScannedMatchCount(scannedMatches);
      document.getElementById(dataKey + "_row").remove();
    }
    else {
      console.log("removeQrScanEntry: scannedMatches does not have that key!");
    }
  }

  // Alerts user of a successful QR scan
  function indicateScanSuccess() {
    try {
      window.navigator.vibrate(200); // Chrome throws an "intervention" if window is not clicked first!
    }
    catch (exception) {
      console.warn("indicateScanSuccess: Vibrate notification request failed! - " + e);
      alert("Vibrate notification request failed!");
    }
    document.getElementById("content").classList.add("bg-success");
    setTimeout(function () {
      document.getElementById("content").classList.remove("bg-success");
    }, 500);
  }

  //  Saves default camera ID to localStorage for on reload camera config persistence
  function setDefaultDeviceID(id) {
    localStorage.setItem("cameraDefaultID", id);
  }

  //  Reads default camera ID from localStorage, or returns original ID
  function getDefaultDeviceID(id) {
    let defaultId = localStorage.getItem("cameraDefaultID");
    return (defaultId !== null) ? defaultId : id;
  }

  // Responsible for handling actions that occur when camera is scanning
  function addCameraScanner(camId, scanner, tableId, scannedMatches) {
    scanner.decodeFromInputVideoDeviceContinuously(camId, 'camera', function (result, err) {
      if (result) {
        let qrList = qrStringToList(result.text);
        qrList = padList(qrList);
        console.log("addCameraScanner: qrList = " + qrList);
        if (validateQrList(qrList)) {
          indicateScanSuccess();
          addMatchDataToTable(tableId, qrListToMatchData(qrList), scannedMatches);
        }
        else {
          console.warn("addCameraScanner: QR scan content failed validation!");
          alert("QR scan content failed validation!");
        }
      }
    });
  }

  // Build the camera selection dropdown and connect the scanner passed in
  function createCameraSelector(camTagId, scanner, tableId, scannedMatches) {
    // Look for cameras, enumerate them, and connect the scanner
    scanner.getVideoInputDevices().then(function (videoInputDevices) {
      let camDeviceId = null;
      let camSelector = document.getElementById(camTagId);
      console.log("createCameraSelector: Camera count: " + videoInputDevices.length);
      if (videoInputDevices.length >= 1) {
        videoInputDevices.forEach(function (element) {
          if (camDeviceId === null) {
            camDeviceId = element.deviceId;
          }

          let option = document.createElement('option');
          option.value = element.deviceId;
          option.innerHTML = element.label;
          camSelector.appendChild(option);
        });
      }

      // Creates scanner on default camera based on saved data
      addCameraScanner(getDefaultDeviceID(camDeviceId), scanner, tableId, scannedMatches);

      // Handle drop down changes to select another camera when necessary
      document.getElementById(camTagId).addEventListener('change', function () {
        let newCamId = document.getElementById(camTagId).value;
        addCameraScanner(newCamId, scanner, tableId, scannedMatches);
        setDefaultDeviceID(newCamId);
      });
    });
  }

  // Update the scanned match counter
  function updateScannedMatchCount(scannedMatches) {
    scanCount = Object.keys(scannedMatches).length;
    document.getElementById("submitData").innerText = "Click to Submit Data: " + scanCount;
  }

  // Clear the scanned data to reset for more scans
  function clearScannedMatches(tableId, scannedMatches) {
    document.getElementById(tableId).innerHTML = "";
    scannedMatches = {};
    updateScannedMatchCount(scannedMatches);
  }

  // Send scanned match data to the database
  function submitScannedMatches(tableId, scannedMatches) {
    let indexedMatches = [];
    for (const [key, value] of Object.entries(scannedMatches)) {
      indexedMatches.push(value);
    }
    if (indexedMatches.length == 0) {
      console.warn("submitScannedMatches: No scanned match entries found! - Data NOT Submitted");
      alert("No scanned match entries found! - Data NOT Submitted");
    }
    else {
      $.post("api/dbWriteAPI.php", {
        writeTeamMatch: JSON.stringify(indexedMatches)
      }, function (response) {
        console.log("=> writeTeamMatch: " + JSON.stringify(response));
        if (response.indexOf('success') > -1) { // A loose compare, because success word may have a newline
          clearScannedMatches(tableId, scannedMatches);
          alert("Data Successfully Submitted! Clearing Data.");
        } else {
          console.warn("submitScannedMatches: Write to DB failed! - Data NOT Submitted (is this a duplicate?)");
          alert("Write to DB failed! - Data NOT Submitted (is this a duplicate?)");
        }
      });
    }
  }

  /////////////////////////////////////////////////////////////////////////////
  //
  // Process the generated html
  //
  document.addEventListener("DOMContentLoaded", function () {

    // All successfully scanned matches
    const tableId = "qrScanTable";
    const scannedMatches = {};

    // Initialze the page
    updateScannedMatchCount(scannedMatches);

    // Attach the ZXing QR scanner/decoder to the camera and load camera choices
    const scanner = new ZXing.BrowserQRCodeReader();
    createCameraSelector("cameraSelector", scanner, tableId, scannedMatches);

    // Submit the scanned data
    document.getElementById("submitData").addEventListener('click', function () {
      submitScannedMatches(tableId, scannedMatches);
    });
  });

</script>
