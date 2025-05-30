<?php
$title = 'Pit Scouting Form';
require 'header.php';
?>

<div class="container row-offcanvas row-offcanvas-left">
  <div id="content" class="column card-lg-12 col-sm-12 col-xs-12">

    <div class="row pt-3 pb-3 mb-3">
      <div class="row justify-content-md-center">
        <h2 class="col-md-6"><?php echo $title; ?></h2>
      </div>

      <div class="card col-md-6 mx-auto">

        <div id="pitScoutingMessage" class="alert alert-dismissible fade show" style="display: none" role="alert">
          <div id="uploadMessageText"></div>
          <button id="closeMessage" class="btn-close" type="button" aria-label="Close"></button>
        </div>

        <div class="card-body">
          <form id="pitScoutingForm" method="post" enctype="multipart/form-data" name="pitScoutingForm">

            <div class="mb-3">
              <label for="teamNumber" class="form-label">Team Number </label>
              <input id="teamNumber" class="form-control" type="text" placeholder="FRC team number">
            </div>

            <div class="mb-3">
              <div>
                <span>Pit Organization</span>
                <span class="text-danger"> (observe only, do not ask)</span>
              </div>
              <div class="form-check form-check-inline">
                <input id="pitScore1" class="form-check-input" type="radio" name="pitOrgGroup">
                <label for="pitScore1" class="form-check-label">1 (Unorganized)</label>
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
              <label for="batteries" class="form-label">Count the number of batteries they have</label>
              <input id="batteries" class="form-control" type="text" placeholder="Battery count">
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
              <span>What programming language do you use?</span>
              <div class="input-group mb-3">
                <select id="programmingLanguage" class="form-select">
                  <option id="programmingLanguage" selected value="0">Choose...</option>
                  <option id="java" value="1">Java</option>
                  <option id="labView" value="2">LabView</option>
                  <option id="C++" value="3">C++</option>
                  <option id="python" value="4">Python</option>
                  <option id="other" value="5">Other</option>
                </select>
              </div>
            </div>

            <div class="mb-3">
              <span>What type of motors do you use on your drive train?</span>
              <div class="input-group mb-3">
                <select id="driveMotors" class="form-select">
                  <option selected>Choose...</option>
                  <option value="1">Krakens</option>
                  <option value="2">Neos</option>
                  <option value="3">Falcons</option>
                  <option value="4">CIMs</option>
                </select>
              </div>
            </div>

            <div class="mb-3">
              <div>
                <span>Preparedness/Professionalism</span>
                <span class="text-danger"> (observe only, do not ask)</span>
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

<?php include 'footer.php'; ?>

<script>
  function verifyData() {
    var isError = false;
    var errMsg = "Please enter values for these fields:";

    // Make sure each piece of data has a value selected.
    if ($("#teamNumber").val() == "") {
      errMsg += " Team Number";
      isError = true;
    }

    if ((!($("#pitScore1").is(':checked'))) && (!($("#pitScore2").is(':checked'))) && (!($("#pitScore3").is(':checked')))) {
      if (isError == true)
        errMsg += ", Pit Organization";
      else errMsg += " Pit Organization";
      isError = true;
    }

    if ((!($("#sparePartsYes").is(':checked'))) && (!($("#sparePartsNo").is(':checked')))) {
      if (isError == true)
        errMsg += ", Spare Parts";
      else errMsg += " Spare Parts";
      isError = true;
    }

    if ((!($("#computerVisionYes").is(':checked'))) && (!($("#computerVisionNo").is(':checked')))) {
      if (isError == true)
        errMsg += ", Computer Vision";
      else errMsg += " Computer Vision";
      isError = true;
    }

    if ((!($("#swerveDriveYes").is(':checked'))) && (!($("#swerveDriveNo").is(':checked')))) {
      if (isError == true)
        errMsg += ", Swerve Drive";
      else errMsg += " Swerve Drive";
      isError = true;
    }

    var progLanguage = $("#programmingLanguage").val();
    if (progLanguage != 1 && progLanguage != 2 && progLanguage != 3 && progLanguage != 4 && progLanguage != 5) {
      if (isError == true)
        errMsg += ", Programming Language";
      else errMsg += " Programming Language";
      isError = true;
    }

    var driveMotors = $("#driveMotors").val();
    if (driveMotors != 1 && driveMotors != 2 && driveMotors != 3 && driveMotors != 4) {
      if (isError == true)
        errMsg += ", Drive Motors";
      else errMsg += " Drive Motors";
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

  function clearForm() {
    $("#teamNumber").val("");
    $("#batteries").val("");
    $("#preloadAndLeave").val("0");
    $("#programmingLanguage").val("0");
    $("#driveMotors").val("0");
    $("#pitScore1").prop("checked", false);
    $("#pitScore2").prop("checked", false);
    $("#pitScore3").prop("checked", false);
    $("#sparePartsYes").prop("checked", false);
    $("#sparePartsNo").prop("checked", false);
    $("#computerVisionYes").prop("checked", false);
    $("#computerVisionNo").prop("checked", false);
    $("#swerveDriveYes").prop("checked", false);
    $("#swerveDriveNo").prop("checked", false);
    $("#preparednessScore1").prop("checked", false);
    $("#preparednessScore2").prop("checked", false);
    $("#preparednessScore3").prop("checked", false);
  }

  function writeDataToAPI() {
    var dataToUse = {};
    dataToUse["teamnumber"] = $("#teamNumber").val();
    dataToUse["numbatteries"] = $("#batteries").val();

    if ($("#pitScore1").is(':checked')) {
      dataToUse["pitorg"] = 1;
    }
    if ($("#pitScore2").is(':checked')) {
      dataToUse["pitorg"] = 3;
    }
    if ($("#pitScore3").is(':checked')) {
      dataToUse["pitorg"] = 5;
    }

    if ($("#sparePartsYes").is(':checked')) {
      dataToUse["spareparts"] = 1;
    }
    if ($("#sparePartsNo").is(':checked')) {
      dataToUse["spareparts"] = 0;
    }

    if ($("#computerVisionYes").is(':checked')) {
      dataToUse["computervision"] = 1;
    }
    if ($("#computerVisionNo").is(':checked')) {
      dataToUse["computervision"] = 0;
    }

    if ($("#swerveDriveYes").is(':checked')) {
      dataToUse["swerve"] = 1;
    }
    if ($("#swerveDriveNo").is(':checked')) {
      dataToUse["swerve"] = 0;
    }

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

    $.post("writeAPI.php", {
      writePitData: JSON.stringify(dataToUse)
    }).done(function (data) {
      // Because success word may have a new-line at the end, don't do a direct compare
      if (data.indexOf('success') > -1) {
        alert("Success in submitting pit data!");
        clearForm();
      } else {
        alert("Failure in submitting pit data!");
      }
    });
  }

  //
  // Process the generated html
  //
  $(document).ready(function () {

    // Submit the match data form
    $("#submitButton").click(function () {
      if (!verifyData()) {
        writeDataToAPI();
      }
    });

  });
</script>
