<title>Pit Scouting</title>
<?php include("header.php") ?>
<div class="container row-offcanvas row-offcanvas-left">
  <div class="well column  col-lg-12  col-sm-12 col-xs-12" id="content">
    <div class="row pt-3 pb-3 mb-3">
      <div class="card col-md-6 mx-auto">
        <div id="pitScoutingMessage" style="display: none" class="alert alert-dismissible fade show" role="alert">
          <div id="uploadMessageText"></div>
          <button type="button" class="btn-close" id="closeMessage" aria-label="Close"></button>
        </div>
        <div class="card-header">
          Pit Scouting
        </div>
        <div class="card-body">
          <form id="pitScoutingForm" method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="teamNumber" class="form-label">Team Number </label>
              <input type="number" class="form-control" id="teamNumber">
            </div>

            <div class="mb-3">
              <label for="batteries" class="form-label">Count the number of batteries they have</label>
              <input type="number" class="form-control" id="batteries">
            </div>

            <div>
              <label class="form-label">Pit Organization</label>
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

            <div>
              <label class="form-label">Do you have a functioning climber attached to your robot?</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="climberOnGroup" id="climberOnYes">
              <label class="form-check-label" for="climberOnYes">Yes</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="climberOnGroup" id="climberOnNo">
              <label class="form-check-label" for="climberOnNo">No</label>
            </div>

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

            <div class="mb-3">
              <label for="driveMotors" class="form-label">What type of motors do you use on your drive train?</label>
              <div class="input-group mb-3">
                <select class="form-select" id="driveMotors">
                  <option selected>Choose...</option>
                  <option value="1">Falcons</option>
                  <option value="2">Neos</option>
                  <option value="3">Cims</option>
                </select>
              </div>
            </div>

            <div class="d-grid gap-2 col-6 mx-auto">
              <button class="btn btn-primary" type="button" id="submitButton">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include("footer.php") ?>

<script>
  function verifyData() {
    var isError = false;
    var errorMessage = "";

    if ($("#teamNumber").val() == "") {
      errorMessage += "Please Enter Team Number. ";
      isError = true;
    }

    var driveMotors = $("#driveMotors").val();
    if (driveMotors != 1 && driveMotors != 2 && driveMotors != 3) {
      errorMessage += "Please Select Drive Motor. ";
      isError = true;
    }

    var progLanguage = $("#programmingLanguage").val();
    if (progLanguage != 1 && progLanguage != 2 && progLanguage != 3 && progLanguage != 4 && progLanguage != 5) {
      errorMessage += "Please Select Programming Language. ";
      isError = true;
    }

    if (isError) {
      alert(errorMessage);
    }
    return isError;
  }

  function clearForm() {
    $("#teamNumber").val("");
    $("#batteries").val("");
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
    $("#climberOnYes").prop("checked", false);
    $("#climberOnNo").prop("checked", false);
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

    if ($("#climberOnYes").is(':checked')) {
      dataToUse["climberon"] = 1;
    }
    if ($("#climberOnNo").is(':checked')) {
      dataToUse["climberon"] = 0;
    }

    var progLang = $("#programmingLanguage").val();
    if (progLang == 1) {
      dataToUse["proglanguage"] = "Java";
    }
    if (progLang == 2) {
      dataToUse["proglanguage"] = "LabView";
    }
    if (progLang == 3) {
      dataToUse["proglanguage"] = "C++";
    }
    if (progLang == 4) {
      dataToUse["proglanguage"] = "Python";
    }
    if (progLang == 5) {
      dataToUse["proglanguage"] = "Other";
    }

    var driveMotors = $("#driveMotors").val()
    if (driveMotors == 1) {
      dataToUse["drivemotors"] = "Falcons";
    }
    if (driveMotors == 2) {
      dataToUse["drivemotors"] = "NEOs";
    }
    if (driveMotors == 3) {
      dataToUse["drivemotors"] = "Cims";
    }

    console.log("   ==> dataToUse[pitorg] = "+ dataToUse["pitorg"]);
    console.log("   ==> dataToUse[spareparts] = "+ dataToUse["spareparts"]);
    console.log("   ==> dataToUse[computervision] = "+ dataToUse["computervision"]);
    console.log("   ==> dataToUse[swerve] = "+ dataToUse["swerve"]);
    console.log("   ==> dataToUse[climberon] = "+ dataToUse["climberon"]);
    console.log("   ==> dataToUse[proglanguage] = "+ dataToUse["proglanguage"]);
    console.log("   ==> dataToUse[drivemotors] = "+ dataToUse["drivemotors"]);
    console.log("  ===> in writeDataToAPI() calling writePitData ");

    $.post("writeAPI.php", {
      writePitData: JSON.stringify(dataToUse)
    }).done(function(data) {
      if (data == "success") {
        alert("Success in submitting data!");
        clearForm();
      } else {
        alert("Failure in submitting data!");
      }
    });
  }

  $(document).ready(function() {

    $("#submitButton").click(function() {
      if (!verifyData()) {
        writeDataToAPI();
      }
    });

  });
</script>
