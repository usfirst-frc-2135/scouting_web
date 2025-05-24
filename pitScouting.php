<?php include "header.php"; ?>

<title>Pit Scouting</title>

<div class="container row-offcanvas row-offcanvas-left">
  <div class="well column  col-lg-12  col-sm-12 col-xs-12" id="content">
    <div class="row pt-3 pb-3 mb-3">
      <div class="row g-3 justify-content-md-center">
        <div class="row justify-content-md-center">
          <h2 class="col-md-6"> Pit Scouting </h2>
        </div>
      </div>

      <div class="card col-md-6 mx-auto">

        <div id="pitScoutingMessage" style="display: none" class="alert alert-dismissible fade show" role="alert">
          <div id="uploadMessageText"></div>
          <button type="button" class="btn-close" id="closeMessage" aria-label="Close"></button>
        </div>

        <div class="card-body">
          <form id="pitScoutingForm" method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="teamNumber" class="form-label">Team Number </label>
              <input type="text" class="form-control" id="teamNumber">
            </div>

            <div class="mb-3">
              <label for="batteries" class="form-label">Count the number of batteries they have</label>
              <input type="text" class="form-control" id="batteries">
            </div>

            <div>
              <label class="form-label">Pit Organization</label>
              <label class="form-label" style="color:red;">(observe only, do not ask)</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="pitOrgGroup" id="pitScore1">
              <label class="form-check-label" for="pitScore1">1 (Little Organization)</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="pitOrgGroup" id="pitScore2">
              <label class="form-check-label" for="pitScore2">3 (Average)</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="pitOrgGroup" id="pitScore3">
              <label class="form-check-label" for="pitScore3">5 (Pristine)</label>
            </div>

            <p> </p>
            <div>
              <label class="form-label">Does your team have spare parts for the robot?</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="sparePartsGroup" id="sparePartsYes">
              <label class="form-check-label" for="sparePartsYes">Yes</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="sparePartsGroup" id="sparePartsNo">
              <label class="form-check-label" for="sparePartsNo">No</label>
            </div>

            <p> </p>
            <div>
              <label class="form-label">Does your robot have computer vision?</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="computerVisionGroup" id="computerVisionYes">
              <label class="form-check-label" for="computerVisionYes">Yes</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="computerVisionGroup" id="computerVisionNo">
              <label class="form-check-label" for="computerVisionNo">No</label>
            </div>

            <p> </p>
            <div>
              <label class="form-label">Does your robot have swerve drive?</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="swerveDriveGroup" id="swerveDriveYes">
              <label class="form-check-label" for="swerveDriveYes">Yes</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="swerveDriveGroup" id="swerveDriveNo">
              <label class="form-check-label" for="swerveDriveNo">No</label>
            </div>

            <p> </p>
            <div class="mb-3">
              <label for="driveType" class="form-label">What programming language do you use?</label>
              <div class="input-group mb-3">
                <select class="form-select" id="programmingLanguage">
                  <option selected value="0">Choose...</option>
                  <option id="java" value="1">Java</option>
                  <option id="labView" value="2">LabView</option>
                  <option id="C++" value="3">C++</option>
                  <option id="python" value="4">Python</option>
                  <option id="other" value="5">Other</option>
                </select>
              </div>
            </div>

            <p> </p>
            <div class="mb-3">
              <label for="driveMotors" class="form-label">What type of motors do you use on your drive train?</label>
              <div class="input-group mb-3">
                <select class="form-select" id="driveMotors">
                  <option selected>Choose...</option>
                  <option value="1">Krakens</option>
                  <option value="2">Neos</option>
                  <option value="3">Falcons</option>
                  <option value="4">Cims</option>
                </select>
              </div>
            </div>

            <p> </p>
            <div>
              <label class="form-label">Preparedness/Professionalism</label>
              <label class="form-label" style="color:red;">(observe only, do not ask)</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="preparednessGroup" id="preparednessScore1">
              <label class="form-check-label" for="preparednessScore1">1 (Minimal)</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="preparednessGroup" id="preparednessScore2">
              <label class="form-check-label" for="preparednessScore2">3 (Average)</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="preparednessGroup" id="preparednessScore3">
              <label class="form-check-label" for="preparednessScore3">5 (Excellent)</label>
            </div>

            <p> </p>
            <div class="d-grid gap-2 col-6 mx-auto">
              <button class="btn btn-primary" type="button" id="submitButton">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include "footer.php"; ?>

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
      dataToUse["drivemotors"] = "Cims";
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

  $(document).ready(function () {

    $("#submitButton").click(function () {
      if (!verifyData()) {
        writeDataToAPI();
      }
    });

  });
</script>
