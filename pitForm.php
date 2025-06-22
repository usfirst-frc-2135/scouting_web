<?php
$title = 'Pit Scouting Form';
require 'inc/header.php';
?>

<div class="container row-offcanvas row-offcanvas-left">
  <div id="content" class="column card-lg-12 col-sm-12 col-xs-12">

    <!-- Page Title -->
    <div class="row pt-3 pb-3 mb-3">
      <div class="row justify-content-md-center">
        <h2 class="col-md-6"><?php echo $title; ?></h2>
      </div>

      <!-- Main card to hold the pit scouting form -->
      <div class="card col-md-6 mx-auto">

        <div id="pitScoutingMessage" class="alert alert-dismissible fade show" style="display: none" role="alert">
          <div id="uploadMessageText"></div>
          <button id="closeMessage" class="btn-close" type="button" aria-label="Pit Form Close"></button>
        </div>

        <div class="card-body">
          <form id="pitScoutingForm" method="post" enctype="multipart/form-data" name="pitScoutingForm">

            <div class="col-7 col-md-5 mb-3">
              <label for="teamNumber" class="form-label">Team Number </label>
              <input id="teamNumber" class="form-control" type="text" placeholder="FRC team number">
            </div>
            <div class="col-7 col-md-6 mb-3">
              <label for="scoutName" class="form-label">Scout Name</label>
              <input id="scoutName" class="form-control" type="text" placeholder="First name, last initial">
            </div>

            <div class="card col-md-12 mx-auto" style=" background-color:#AFE8F7">
              <div class="card-header">
                <h5>Questions</h5>
              </div>

              <div class="card-body">
                <div class="mb-3">
                  <div>
                    <span>Does your robot have swerve drive?</span>
                  </div>
                  <div class="form-check form-check-inline">
                    <input id="swerveDriveYes" class="form-check-input" type="radio" name="swerveDriveGroup">
                    <label for="swerveDriveYes" class="form-check-label">Yes</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input id="swerveDriveNo" class="form-check-input" type="radio" name="swerveDriveGroup">
                    <label for="swerveDriveNo" class="form-check-label">No</label>
                  </div>
                </div>

                <div class="mb-3">
                  <span>What type of motors do you use on your drive train?</span>
                  <div class="input-group mb-3">
                    <select id="driveMotors" class="form-select">
                      <option selected value="0">Choose ...</option>
                      <option value="1">Krakens</option>
                      <option value="2">Neos</option>
                      <option value="3">Falcons</option>
                      <option value="4">CIMs</option>
                    </select>
                  </div>
                </div>

                <div class="mb-3">
                  <div>
                    <span>Does your team have spare parts for the robot?</span>
                  </div>
                  <div class="form-check form-check-inline">
                    <input id="sparePartsYes" class="form-check-input" type="radio" name="sparePartsGroup">
                    <label for="sparePartsYes" class="form-check-label">Yes</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input id="sparePartsNo" class="form-check-input" type="radio" name="sparePartsGroup">
                    <label for="sparePartsNo" class="form-check-label">No</label>
                  </div>
                </div>

                <div class="mb-3">
                  <span>What programming language do you use?</span>
                  <div class="input-group mb-3">
                    <select id="programmingLanguage" class="form-select">
                      <option selected value="0">Choose ...</option>
                      <option id="java" value="1">Java</option>
                      <option id="labView" value="2">LabView</option>
                      <option id="C++" value="3">C++</option>
                      <option id="python" value="4">Python</option>
                      <option id="other" value="5">Other</option>
                    </select>
                  </div>
                </div>

                <div class="mb-3">
                  <div>
                    <span>Does your robot have computer vision?</span>
                  </div>
                  <div class="form-check form-check-inline">
                    <input id="computerVisionYes" class="form-check-input" type="radio" name="computerVisionGroup">
                    <label for="computerVisionYes" class="form-check-label">Yes</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input id="computerVisionNo" class="form-check-input" type="radio" name="computerVisionGroup">
                    <label for="computerVisionNo" class="form-check-label">No</label>
                  </div>
                </div>
              </div>
            </div>

            <div class="card col-md-12 mx-auto" style=" background-color:#FBE7A5">
              <div class="card-header">
                <h5>Observations<span class="text-danger"> (observe only, do not ask)</span></h5>
              </div>

              <div class="card-body">
                <div class="mb-3">
                  <div>
                    <span>Pit Organization</span>
                  </div>
                  <div class="form-check form-check-inline">
                    <input id="pitScore1" class="form-check-input" type="radio" name="pitOrgGroup">
                    <label for="pitScore1" class="form-check-label">1 (Messy)</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input id="pitScore2" class="form-check-input" type="radio" name="pitOrgGroup">
                    <label for="pitScore2" class="form-check-label">3 (Average)</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input id="pitScore3" class="form-check-input" type="radio" name="pitOrgGroup">
                    <label for="pitScore3" class="form-check-label">5 (Pristine)</label>
                  </div>
                </div>

                <div class="mb-3">
                  <div>
                    <span>Preparedness/Professionalism</span>
                  </div>
                  <div class="form-check form-check-inline">
                    <input id="preparednessScore1" class="form-check-input" type="radio" name="preparednessGroup">
                    <label for="preparednessScore1" class="form-check-label">1 (Minimal)</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input id="preparednessScore2" class="form-check-input" type="radio" name="preparednessGroup">
                    <label for="preparednessScore2" class="form-check-label">3 (Average)</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input id="preparednessScore3" class="form-check-input" type="radio" name="preparednessGroup">
                    <label for="preparednessScore3" class="form-check-label">5 (Excellent)</label>
                  </div>
                </div>

                <div class="mb-3">
                  <label for="batteries" class="form-label">Count the number of batteries they have</label>
                  <input id="batteries" class="form-control" type="text" placeholder="Battery count">
                </div>
              </div>
            </div>

            <p> </p>
            <div class="d-grid gap-2 col-6 mx-auto">
              <button id="submitButton" class="btn btn-primary" type="button">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'inc/footer.php'; ?>

<!-- Javascript page handlers -->

<script>

  // Verify pit form data
  function verifyPitForm() {
    console.log("==> pitForm: verifyPitForm()");
    let isError = false;
    let errMsg = "Please enter values for these fields:";
    let teamNum = document.getElementById("teamNumber").value;

    // Make sure each piece of data has a value selected.
    if (((document.getElementById("teamNumber").value === "") || (validateTeamNumber(teamNum, null) <= 0))) {
      errMsg += " Team Number";
      isError = true;
    }

    if (!document.getElementById("swerveDriveYes").checked && !document.getElementById("swerveDriveNo").checked) {
      if (isError === true)
        errMsg += ",";
      errMsg += " Swerve Drive";
      isError = true;
    }

    let driveMotors = document.getElementById("driveMotors").value;
    if (driveMotors != 1 && driveMotors != 2 && driveMotors != 3 && driveMotors != 4) {
      if (isError === true)
        errMsg += ",";
      errMsg += " Drive Motors";
      isError = true;
    }

    if (!document.getElementById("sparePartsYes").checked && !document.getElementById("sparePartsNo").checked) {
      if (isError === true)
        errMsg += ",";
      errMsg += " Spare Parts";
      isError = true;
    }

    let progLanguage = document.getElementById("programmingLanguage").value;
    if (progLanguage != 1 && progLanguage != 2 && progLanguage != 3 && progLanguage != 4 && progLanguage != 5) {
      if (isError === true)
        errMsg += ",";
      errMsg += " Programming Language";
      isError = true;
    }

    if (!document.getElementById("computerVisionYes").checked && !document.getElementById("computerVisionNo").checked) {
      if (isError === true)
        errMsg += ",";
      errMsg += " Computer Vision";
      isError = true;
    }

    if (!document.getElementById("pitScore1").checked && !document.getElementById("pitScore2").checked && !document.getElementById("pitScore3").checked) {
      if (isError === true)
        errMsg += ",";
      errMsg += " Pit Organization";
      isError = true;
    }

    if (!document.getElementById("preparednessScore1").checked && !document.getElementById("preparednessScore2").checked && !document.getElementById("preparednessScore3").checked) {
      if (isError === true)
        errMsg += ",";
      errMsg += " Preparedness";
      isError = true;
    }

    if (isError) {
      alert(errMsg);
    }
    return isError;
  }

  // Clear pit form fields
  function clearPitForm() {
    console.log("==> pitForm: clearPitForm()");
    document.getElementById("teamNumber").value = "";
    document.getElementById("scoutName").value = "";
    document.getElementById("swerveDriveYes").checked = false;
    document.getElementById("swerveDriveNo").checked = false;
    document.getElementById("driveMotors").value = "0";
    document.getElementById("sparePartsYes").checked = false;
    document.getElementById("sparePartsNo").checked = false;
    document.getElementById("programmingLanguage").value = "0";
    document.getElementById("computerVisionYes").checked = false;
    document.getElementById("computerVisionNo").checked = false;
    document.getElementById("pitScore1").checked = false;
    document.getElementById("pitScore2").checked = false;
    document.getElementById("pitScore3").checked = false;
    document.getElementById("preparednessScore1").checked = false;
    document.getElementById("preparednessScore2").checked = false;
    document.getElementById("preparednessScore3").checked = false;
    document.getElementById("batteries").value = "";
  }

  // Write pit data form fields to DB table
  function writeFormToPitTable() {
    console.log("==> pitForm: writeFormToPitTable()");
    let dataToUse = {};
    dataToUse["teamnumber"] = document.getElementById("teamNumber").value;

    // dataToUse["scoutname"] = document.getElementById("scoutName").value; // TODO: enable once db is changed

    // Swerve
    if (document.getElementById("swerveDriveYes").checked) {
      dataToUse["swerve"] = 1;
    }
    if (document.getElementById("swerveDriveNo").checked) {
      dataToUse["swerve"] = 0;
    }

    // Drive motors
    let driveMotors = document.getElementById("driveMotors").value;
    switch (driveMotors) {
      case "1": dataToUse["drivemotors"] = "Krakens"; break;
      case "2": dataToUse["drivemotors"] = "NEOs"; break;
      case "3": dataToUse["drivemotors"] = "Falcons"; break;
      case "4": dataToUse["drivemotors"] = "CIMs"; break;
      default: dataToUse["drivemotors"] = "Missing"; break;
    }

    // Spare parts
    if (document.getElementById("sparePartsYes").checked) {
      dataToUse["spareparts"] = 1;
    }
    if (document.getElementById("sparePartsNo").checked) {
      dataToUse["spareparts"] = 0;
    }

    // Software language
    let progLang = document.getElementById("programmingLanguage").value;
    switch (progLang) {
      case "1": dataToUse["proglanguage"] = "Java"; break;
      case "2": dataToUse["proglanguage"] = "LabView"; break;
      case "3": dataToUse["proglanguage"] = "C++"; break;
      case "4": dataToUse["proglanguage"] = "Python"; break;
      case "5": dataToUse["proglanguage"] = "Other"; break;
      default: dataToUse["proglanguage"] = "Missing"; break;
    }

    // Computer vision
    if (document.getElementById("computerVisionYes").checked) {
      dataToUse["computervision"] = 1;
    }
    if (document.getElementById("computerVisionNo").checked) {
      dataToUse["computervision"] = 0;
    }

    // Pit organization
    if (document.getElementById("pitScore1").checked) {
      dataToUse["pitorg"] = 1;
    }
    if (document.getElementById("pitScore2").checked) {
      dataToUse["pitorg"] = 3;
    }
    if (document.getElementById("pitScore3").checked) {
      dataToUse["pitorg"] = 5;
    }

    // Overall readiness
    dataToUse["preparedness"] = 1;  // default
    if (document.getElementById("preparednessScore1").checked) {
      dataToUse["preparedness"] = 1;
    }
    else if (document.getElementById("preparednessScore2").checked) {
      dataToUse["preparedness"] = 3;
    }
    else if (document.getElementById("preparednessScore3").checked) {
      dataToUse["preparedness"] = 5;
    }

    // Battery count
    dataToUse["numbatteries"] = document.getElementById("batteries").value;

    $.post("api/dbWriteAPI.php", {
      writePitTable: JSON.stringify(dataToUse)
    }).done(function (response) {
      console.log("=> writePitTable");
      // Because success word may have a newline at the end, don't do a direct compare
      if (response.indexOf('success') > -1) {
        alert("Success in submitting pit data!");
        clearPitForm();
      } else {
        alert("Failure in submitting Pit Form! (is this a duplicate?)");
      }
    });
  }

  //
  // Process the generated html
  //
  document.addEventListener("DOMContentLoaded", () => {

    // Update the navbar with the event code
    $.get("api/tbaAPI.php", {
      getEventCode: true
    }, function (eventCode) {
      eventCode = eventCode.trim();
      console.log("=> pitForm: getEventCode: " + eventCode);
      document.getElementById("navbarEventCode").innerHTML = eventCode;
    });

    // Submit the match data form
    document.getElementById("submitButton").addEventListener('click', function () {
      if (!verifyPitForm()) {
        writeFormToPitTable();
      }
    });

  });
</script>

<script src="./scripts/validateTeamNumber.js"></script>
