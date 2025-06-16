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

            <div class="col-5 mb-3">
              <label for="teamNumber" class="form-label">Team Number </label>
              <input id="teamNumber" class="form-control" type="text" placeholder="FRC team number">
            </div>
            <div class="col-6 mb-3">
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
                      <option selected>Choose ...</option>
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
                      <option id="programmingLanguage" selected value="0">Choose ...</option>
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
  function verifyPitForm() {
    console.log("==> pitForm.php: verifyPitForm()");
    var isError = false;
    var errMsg = "Please enter values for these fields:";
    var teamNum = $("#teamNumber").val();

    // Make sure each piece of data has a value selected.
    if ((($("#teamNumber").val() == "") || (validateTeamNumber(teamNum, null) <= 0))) {
      errMsg += " Team Number";
      isError = true;
    }

    if ((!($("#swerveDriveYes").is(':checked'))) && (!($("#swerveDriveNo").is(':checked')))) {
      if (isError == true)
        errMsg += ", Swerve Drive";
      else errMsg += " Swerve Drive";
      isError = true;
    }

    var driveMotors = $("#driveMotors").val();
    if (driveMotors != 1 && driveMotors != 2 && driveMotors != 3 && driveMotors != 4) {
      if (isError == true)
        errMsg += ", Drive Motors";
      else errMsg += " Drive Motors";
      isError = true;
    }

    if ((!($("#sparePartsYes").is(':checked'))) && (!($("#sparePartsNo").is(':checked')))) {
      if (isError == true)
        errMsg += ", Spare Parts";
      else errMsg += " Spare Parts";
      isError = true;
    }

    var progLanguage = $("#programmingLanguage").val();
    if (progLanguage != 1 && progLanguage != 2 && progLanguage != 3 && progLanguage != 4 && progLanguage != 5) {
      if (isError == true)
        errMsg += ", Programming Language";
      else errMsg += " Programming Language";
      isError = true;
    }

    if ((!($("#computerVisionYes").is(':checked'))) && (!($("#computerVisionNo").is(':checked')))) {
      if (isError == true)
        errMsg += ", Computer Vision";
      else errMsg += " Computer Vision";
      isError = true;
    }

    if ((!($("#pitScore1").is(':checked'))) && (!($("#pitScore2").is(':checked'))) && (!($("#pitScore3").is(':checked')))) {
      if (isError == true)
        errMsg += ", Pit Organization";
      else errMsg += " Pit Organization";
      isError = true;
    }

    if ((!($("#preparednessScore1").is(':checked'))) && (!($("#preparednessScore2").is(':checked'))) && (!($("#preparednessScore3").is(':checked')))) {
      if (isError == true)
        errMsg += ", Preparedness";
      else errMsg += " Preparedness";
      isError = true;
    }

    if (isError) {
      alert(errMsg);
    }
    return isError;
  }

  function clearPitForm() {
    console.log("==> pitForm.php: clearPitForm()");
    $("#teamNumber").val("");
    $("#swerveDriveYes").prop("checked", false);
    $("#swerveDriveNo").prop("checked", false);
    $("#driveMotors").val("0");
    $("#sparePartsYes").prop("checked", false);
    $("#sparePartsNo").prop("checked", false);
    $("#programmingLanguage").val("0");
    $("#computerVisionYes").prop("checked", false);
    $("#computerVisionNo").prop("checked", false);
    $("#pitScore1").prop("checked", false);
    $("#pitScore2").prop("checked", false);
    $("#pitScore3").prop("checked", false);
    $("#preparednessScore1").prop("checked", false);
    $("#preparednessScore2").prop("checked", false);
    $("#preparednessScore3").prop("checked", false);
    $("#batteries").val("");
  }

  function writeFormToPitTable() {
    console.log("==> pitForm.php: writeFormToPitTable()");
    var dataToUse = {};
    dataToUse["teamnumber"] = $("#teamNumber").val();

    // Swerve
    if ($("#swerveDriveYes").is(':checked')) {
      dataToUse["swerve"] = 1;
    }
    if ($("#swerveDriveNo").is(':checked')) {
      dataToUse["swerve"] = 0;
    }

    // Drive motors
    var driveMotors = $("#driveMotors").val()
    if (driveMotors == 1) {
      dataToUse["drivemotors"] = "Krakens";
    }
    if (driveMotors == 2) {
      dataToUse["drivemotors"] = "NEOs";
    }
    if (driveMotors == 3) {
      dataToUse["drivemotors"] = "Falcons";
    }
    if (driveMotors == 4) {
      dataToUse["drivemotors"] = "CIMs";
    }

    // Spare parts
    if ($("#sparePartsYes").is(':checked')) {
      dataToUse["spareparts"] = 1;
    }
    if ($("#sparePartsNo").is(':checked')) {
      dataToUse["spareparts"] = 0;
    }

    // Software language
    var progLang = $("#programmingLanguage").val();
    dataToUse["proglanguage"] = "Other";  // default
    if (progLang == 1) {
      dataToUse["proglanguage"] = "Java";
    }
    else if (progLang == 2) {
      dataToUse["proglanguage"] = "LabView";
    }
    else if (progLang == 3) {
      dataToUse["proglanguage"] = "C++";
    }
    else if (progLang == 4) {
      dataToUse["proglanguage"] = "Python";
    }
    else if (progLang == 5) {
      dataToUse["proglanguage"] = "Other";
    }

    // Computer vision
    if ($("#computerVisionYes").is(':checked')) {
      dataToUse["computervision"] = 1;
    }
    if ($("#computerVisionNo").is(':checked')) {
      dataToUse["computervision"] = 0;
    }

    // Pit organization
    if ($("#pitScore1").is(':checked')) {
      dataToUse["pitorg"] = 1;
    }
    if ($("#pitScore2").is(':checked')) {
      dataToUse["pitorg"] = 3;
    }
    if ($("#pitScore3").is(':checked')) {
      dataToUse["pitorg"] = 5;
    }

    // Overall readiness
    dataToUse["preparedness"] = 1;  // default
    if ($("#preparednessScore1").is(':checked')) {
      dataToUse["preparedness"] = 1;
    }
    else if ($("#preparednessScore2").is(':checked')) {
      dataToUse["preparedness"] = 3;
    }
    else if ($("#preparednessScore3").is(':checked')) {
      dataToUse["preparedness"] = 5;
    }

    // Battery count
    dataToUse["numbatteries"] = $("#batteries").val();

    $.post("api/dbWriteAPI.php", {
      writePitTable: JSON.stringify(dataToUse)
    }).done(function (returnCode) {
      console.log("==> writePitTable");
      // Because success word may have a new-line at the end, don't do a direct compare
      if (returnCode.indexOf('success') > -1) {
        alert("Success in submitting pit data!");
        clearPitForm();
      } else {
        alert("Failure in submitting pit data!");
      }
    });
  }

  //
  // Process the generated html
  //
  $(document).ready(function () {
    // Update the navbar with the event code
    $.get("api/tbaAPI.php", {
      getEventCode: true
    }, function (eventCode) {
      console.log("==> pitForm.php - getEventCode: " + eventCode.trim());
      $("#navbarEventCode").html(eventCode);
    });

    // Submit the match data form
    $("#submitButton").click(function () {
      if (!verifyPitForm()) {
        writeFormToPitTable();
      }
    });

  });
</script>

<script src="./scripts/validateTeamNumber.js"></script>
