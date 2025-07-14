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
              <label for="enterTeamNumber" class="form-label">Team Number </label>
              <input id="enterTeamNumber" class="form-control" type="text" placeholder="FRC team number">
            </div>
            <div class="col-7 col-md-6 mb-3">
              <label for="enterScoutName" class="form-label">Scout Name</label>
              <input id="enterScoutName" class="form-control" type="text" placeholder="First name, last initial">
            </div>

            <div class="card col-md-12 mx-auto" style=" background-color:#AFE8F7">
              <div class="card-header">
                <h5>Questions</h5>
              </div>

              <div class="card-body">
                <div class="mb-3">
                  <span>Does your robot have swerve drive?</span>
                  <div class="col-4">
                    <div class="input-group mb-3">
                      <select id="swerveDrive" class="form-select">
                        <option selected value="-1">Choose ...</option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="mb-3">
                  <span>What type of motors do you use on your drive train?</span>
                  <div class="col-4">
                    <div class="input-group mb-3">
                      <select id="driveMotors" class="form-select">
                        <option selected value="-1">Choose ...</option>
                        <option value="Krakens">Krakens</option>
                        <option value="NEOs">NEOs</option>
                        <option value="Falcons">Falcons</option>
                        <option value="CIMs">CIMs</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="mb-3">
                  <span>Does your team have spare parts for the robot?</span>
                  <div class="col-4">
                    <div class="input-group mb-3">
                      <select id="spareParts" class="form-select">
                        <option selected value="-1">Choose ...</option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="mb-3">
                  <span>What programming language do you use?</span>
                  <div class="col-4">
                    <div class="input-group mb-3">
                      <select id="progLanguage" class="form-select">
                        <option selected value="-1">Choose ...</option>
                        <option value="Java">Java</option>
                        <option value="LabView">LabView</option>
                        <option value="C++">C++</option>
                        <option value="Python">Python</option>
                        <option value="Other">Other</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="mb-3">
                  <div>
                    <span>Does your robot have computer vision?</span>
                    <div class="col-4">
                      <div class="input-group mb-3">
                        <select id="computerVision" class="form-select">
                          <option selected value="-1">Choose ...</option>
                          <option value="1">Yes</option>
                          <option value="0">No</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="card col-md-12 mx-auto" style=" background-color:#FBE7A5">
              <div class="card-header">
                <h5>Observations</h5>
                <h6><span class="text-danger">(observe only, do not ask)</span></h6>
              </div>

              <div class="card-body">
                <div class="mb-3">
                  <div>
                    <span>Pit Organization</span>
                    <div class="col-5">
                      <div class="input-group mb-3">
                        <select id="progLanguage" class="form-select">
                          <option selected value="-1">Choose ...</option>
                          <option value="1">1 - Messy</option>
                          <option value="2">2 - Below average</option>
                          <option value="3">3 - Organized!</option>
                          <option value="4">4 - Above average</option>
                          <option value="5">5 - Pristine</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="mb-3">
                  <div>
                    <span>Preparedness/Professionalism</span>
                    <div class="col-5">
                      <div class="input-group mb-3">
                        <select id="progLanguage" class="form-select">
                          <option selected value="-1">Choose ...</option>
                          <option value="1">1 - Utter chaos</option>
                          <option value="2">2 - Below average</option>
                          <option value="3">3 - Prepared!</option>
                          <option value="4">4 - Above average</option>
                          <option value="5">5 - Proactive</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="mb-3">
                  <label for="numBatteries" class="form-label">Count the number of batteries they have</label>
                  <input id="numBatteries" class="form-control" type="text" placeholder="Battery count">
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

  // Check if our URL directs to a specific team
  function checkURLForTeamSpec() {
    console.log("=> pitForm: checkURLForTeamSpec()");
    let sp = new URLSearchParams(window.location.search);
    if (sp.has('teamNum')) {
      return sp.get('teamNum');
    }
    return null;
  }

  // Verify pit form data
  function validatePitForm() {
    console.log("==> pitForm: validatePitForm()");
    let isError = false;
    let errMsg = "Please enter values for these fields:";
    let teamNum = document.getElementById("enterTeamNumber").value.trim();
    let scoutName = document.getElementById("enterScoutName").value.trim();

    // Make sure each piece of data has a value selected.
    if (validateTeamNumber(teamNum, null) <= 0) {
      errMsg += " Team Number";
      isError = true;
    }

    if (scoutName === "") {
      if (isError)
        errMsg += ",";
      errMsg += " Scout Name";
      isError = true;
    }

    if (document.getElementById("swerveDrive").value === "-1") {
      if (isError)
        errMsg += ",";
      errMsg += " Swerve Drive";
      isError = true;
    }

    if (document.getElementById("driveMotors").value === "-1") {
      if (isError)
        errMsg += ",";
      errMsg += " Drive Motors";
      isError = true;
    }

    if (document.getElementById("spareParts").value === "-1") {
      if (isError)
        errMsg += ",";
      errMsg += " Spare Parts";
      isError = true;
    }

    if (document.getElementById("progLanguage").value === "-1") {
      if (isError)
        errMsg += ",";
      errMsg += " Programming Language";
      isError = true;
    }

    if (document.getElementById("computerVision").value === "-1") {
      if (isError)
        errMsg += ",";
      errMsg += " Computer Vision";
      isError = true;
    }

    if (!document.getElementById("pitScore").value === "-1") {
      if (isError)
        errMsg += ",";
      errMsg += " Pit Organization";
      isError = true;
    }

    if (!document.getElementById("preparednessScore").value === "-1") {
      if (isError)
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
    document.getElementById("enterTeamNumber").value = "";
    document.getElementById("enterScoutName").value = "";
    document.getElementById("swerveDrive").value = "-1";
    document.getElementById("driveMotors").value = "-1";
    document.getElementById("spareParts").value = "-1";
    document.getElementById("progLanguage").value = "-1";
    document.getElementById("computerVision").value = "-1";
    document.getElementById("pitScore").value = "-1";
    document.getElementById("preparednessScore").value = "-1";
    document.getElementById("numBatteries").value = "";
  }

  // Write pit data form fields to DB table
  function getPitFormData() {
    console.log("==> pitForm: writeFormToPitTable()");
    let dataToSave = {};
    dataToSave["teamnumber"] = document.getElementById("enterTeamNumber").value.trim();
    dataToSave["scoutname"] = document.getElementById("enterScoutName").value.trim();

    // All fields use the "value" of the html element above to eliminate any translation
    dataToSave["swerve"] = document.getElementById("swerveDrive").value;
    dataToSave["drivemotors"] = document.getElementById("driveMotors").value;
    dataToSave["spareparts"] = document.getElementById("spareParts").value;
    dataToSave["proglanguage"] = document.getElementById("progLanguage").value;
    dataToSave["computervision"] = document.getElementById("computerVision").value;
    dataToSave["pitorg"] = document.getElementById("pitScore1").value;
    dataToSave["preparedness"] = document.getElementById("preparednessScore").value;
    dataToSave["numbatteries"] = document.getElementById("numBatteries").value;

    return dataToSave;
  }

  // Send the pit form data to the server
  function submitPitFormData(pitFormData) {
    console.log("==> pitForm: submitPitFormData()");
    $.post("api/dbWriteAPI.php", {
      writePitTable: JSON.stringify(pitFormData)
    }).done(function (response) {
      console.log("=> writePitTable");
      if (response.indexOf('success') > -1) {    // A loose compare, because success word may have a newline
        clearPitForm();
        alert("Success in submitting Pit data! - Clearning form");
      } else {
        alert("Failure in submitting Pit Form! Is this a duplicate?");
      }
    });
  }

  /////////////////////////////////////////////////////////////////////////////
  //
  // Process the generated html
  //
  document.addEventListener("DOMContentLoaded", function () {

    // Check URL for source team to load
    let initTeamNumber = checkURLForTeamSpec();
    if (initTeamNumber) {
      document.getElementById("enterTeamNumber").value = initTeamNumber;
    }

    // Submit the match data form
    document.getElementById("submitButton").addEventListener('click', function () {
      if (!validatePitForm()) {
        pitFormData = getPitFormData();
        submitPitFormData(pitFormData);
      }
    });

  });
</script>

<script src="./scripts/validateTeamNumber.js"></script>
