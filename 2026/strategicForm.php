<?php
$title = 'Strategic Form';
require 'inc/header.php';
?>

<div class="container row-offcanvas row-offcanvas-left">
  <div id="content" class="column card-lg-12 col-sm-12 col-xs-12">

    <!-- Page Title -->
    <div class="row pt-3 pb-3 mb-3">
      <div class="row justify-content-md-center">
        <h2 class="col-md-6"><?php echo $title; ?></h2>
      </div>

      <!-- Main card to hold the strategic form -->
      <div class="card col-md-6 mx-auto">

        <div id="strategicScoutingMessage" class="alert alert-dismissible fade show" style="display: none" role="alert">
          <div id="uploadMessageText"></div>
          <button id="closeMessage" class="btn-close" type="button" aria-label="Strategic Form Close"></button>
        </div>

        <!-- Strategic Entry Form -->
        <div class="card-body mb-3">
          <form id="strategicForm" method="post" enctype="multipart/form-data" name="strategicForm">
            <div>
              <h4>Match Info</h4>
            </div>
            <div class="col-7 col-md-5 mb-3">
              <label for="teamNumber" class="form-label">Team Number</label>
              <input id="teamNumber" class="form-control" type="text" placeholder="FRC team number">
            </div>
            <div class="row  col-9 col-md-7 mb-3">
              <span>Match Number</span>
              <div class="input-group">
                <div class="input-group-prepend">
                  <select id="compLevel" class="form-select" aria-label="Comp Level Select">
                    <option value="p">P</option>
                    <option value="qm" selected>QM</option>
                    <option value="sf">SF</option>
                    <option value="f">F</option>
                  </select>
                </div>
                <input id="matchNumber" class="form-control" type="text" placeholder="Match number">
              </div>
            </div>

            <div class="col-7 col-md-6 mb-3">
              <label for="scoutName" class="form-label">Scout Name</label>
              <input id="scoutName" class="form-control" type="text" placeholder="First name, last initial">
            </div>

            <!-- Autonomous Mode -->
            <div class="card mb-3" style="background-color:#D5E6DE">
              <div class="card-header fw-bold">
                Autonomous Mode
              </div>
              <div class="card-body">
                <div>
                  <span class="fw-bold">Auton - Get coral from:</span>
                </div>
                <div class="form-check form-check-inline">
                  <label for="autonGetCoralFromFloor" class="form-label">Floor</label>
                  <input id="autonGetCoralFromFloor" class="form-check-input" type="checkbox">
                </div>
                <div class="form-check form-check-inline">
                  <label for="autonGetCoralFromStation" class="form-label">Coral Station</label>
                  <input id="autonGetCoralFromStation" class="form-check-input" type="checkbox">
                </div>
                <div>
                  <span class="fw-bold">Auton - Get algae from:</span>
                </div>
                <div class="form-check form-check-inline">
                  <label for="autonGetAlgaeFromFloor" class="form-label">Floor</label>
                  <input id="autonGetAlgaeFromFloor" class="form-check-input" type="checkbox">
                </div>
                <div class="form-check form-check-inline">
                  <label for="autonGetAlgaeFromReef" class="form-label">Reef</label>
                  <input id="autonGetAlgaeFromReef" class="form-check-input" type="checkbox">
                </div>

                <!-- Auton - Committed fouls section -->
                <div>
                  <span class="fw-bold">Auton - Committed fouls:</span>
                </div>
                <div class="form-check form-check-inline">
                  <label for="autonFoul1" class="form-label">Contact with opposing robot in their barge zone</label>
                  <input id="autonFoul1" class="form-check-input" type="checkbox">
                </div>
                <div class="form-check form-check-inline">
                  <label for="autonFoul2" class="form-label">Contact with opposing cage</label>
                  <input id="autonFoul2" class="form-check-input" type="checkbox">
                </div>
              </div>
            </div>
            <!-- end Autonomous Mode -->

            <!-- Teleop Mode -->
            <div class="card mb-3" style="background-color:#D6F3FB">
              <div class="card-header fw-bold">
                Teleop Mode
              </div>
              <div class="card-body">

                <!-- Teleop - Floor pickup section -->
                <div>
                  <span class="fw-bold">Teleop - Floor pickup:</span>
                </div>
                <div class="form-check form-check-inline">
                  <label for="teleopFloorPickupCoral" class="form-label">Coral</label>
                  <input id="teleopFloorPickupCoral" class="form-check-input" type="checkbox">
                </div>
                <div class="form-check form-check-inline">
                  <label for="teleopFloorPickupAlgae" class="form-label">Algae</label>
                  <input id="teleopFloorPickupAlgae" class="form-check-input" type="checkbox">
                </div>
                <!-- Teleop - Algae from reef section -->
                <div>
                  <span class="fw-bold">Teleop - Algae from reef:</span>
                </div>
                <div class="form-check form-check-inline">
                  <label for="teleopKnockOffAlgaeFromReef" class="form-label">Knock off algae from reef</label>
                  <input id="teleopKnockOffAlgaeFromReef" class="form-check-input" type="checkbox">
                </div>
                <div class="form-check form-check-inline">
                  <label for="teleopAcquireAlgaeFromReef" class="form-label">Acquire algae from reef</label>
                  <input id="teleopAcquireAlgaeFromReef" class="form-check-input" type="checkbox">
                </div>

                <!-- Driver ability section -->
                <div>
                  <span class="fw-bold">Driver ability/speed:</span>
                </div>
                <div class="form-check form-check-inline">
                  <input id="driveScore1" class="form-check-input" type="radio" name="driverAbilityGroup" value="1">
                  <label for="driveScore1" class="form-check-label">1 - Jerky</label>
                </div>
                <div class="form-check form-check-inline">
                  <input id="driveScore2" class="form-check-input" type="radio" name="driverAbilityGroup" value="2">
                  <label for="driveScore2" class=" form-check-label">2 - Slow</label>
                </div>
                <div class="form-check form-check-inline">
                  <input id="driveScore3" class="form-check-input" type="radio" name="driverAbilityGroup" value="3">
                  <label for="driveScore3" class="form-check-label">3 - Average</label>
                </div>
                <div class="form-check form-check-inline">
                  <input id="driveScore4" class="form-check-input" type="radio" name="driverAbilityGroup" value="4">
                  <label for="driveScore4" class="form-check-label">4 - Quick/agile</label>
                </div>
                <div class="form-check form-check-inline">
                  <input id="driveScore5" class="form-check-input" type="radio" name="driverAbilityGroup" value="5">
                  <label for="driveScore5" class="form-check-label">5 - N/A</label>
                </div>

                <!-- Against defensive robot section -->
                <div>
                  <span class="fw-bold">Against defensive robot:</span>
                </div>
                <div class="form-check form-check-inline">
                  <label for="againstTactic1" class="form-label">Path Blocked (able to escape quickly?)</label>
                  <input id="againstTactic1" class="form-check-input" type="checkbox">
                </div>
                <div class="mb-3">
                  <label for="againstComment" class="form-label">Against defense note: </label>
                  <input id="againstComment" class="form-control" type="text">
                </div>
                <div>
                  <span class="fw-bold">Endgame: Climbing Foul:</span>
                </div>
                <div class="form-check form-check-inline">
                  <label for="teleopFoul1" class="form-label">Contact with anchor when climbing</label>
                  <input id="teleopFoul1" class="form-check-input" type="checkbox">
                </div>
              </div>
            </div>
            <!-- end Teleop Mode -->

            <!-- Playing Defense Section -->
            <div class="card mb-3" style="background-color:#fbe6d3">
              <div class="card-header fw-bold">
                Playing Defense
              </div>
              <div class="card-body">
                <!-- Defense tactics section -->
                <div>
                  <span class="fw-bold">Defense tactics played:</span>
                </div>
                <div class="form-check form-check-inline">
                  <label for="defenseTactic1" class="form-label">Blocking loading station (how long detained?)</label>
                  <input id="defenseTactic1" class="form-check-input" type="checkbox">
                </div>
                <div class="form-check form-check-inline">
                  <label for="defenseTactic2" class="form-label">Blocking path (how long detained? where?)</label>
                  <input id="defenseTactic2" class="form-check-input" type="checkbox">
                </div>
                <div class="mb-3">
                  <label for="defenseComment" class="form-label">Defense note: </label>
                  <input id="defenseComment" class="form-control" type="text">
                </div>

                <!-- Committed fouls section -->
                <div>
                  <span class="fw-bold">Committed fouls:</span>
                </div>
                <div class="form-check form-check-inline">
                  <label for="foul1" class="form-label">Pinning for 3 count</label>
                  <input id="foul1" class="form-check-input" type="checkbox">
                </div>
                <div class="form-check form-check-inline">
                  <label for="teleopFoul3" class="form-label">Contact with opposing robot in their reef zone</label>
                  <input id="teleopFoul3" class="form-check-input" type="checkbox">
                </div>
                <div class="form-check form-check-inline">
                  <label for="teleopFoul2" class="form-label">Contact with opposing robot in their barge zone</label>
                  <input id="teleopFoul2" class="form-check-input" type="checkbox">
                </div>
                <div class="form-check form-check-inline">
                  <label for="teleopFoul4" class="form-label">Contact with opposing cage </label>
                  <input id="teleopFoul4" class="form-check-input" type="checkbox">
                </div>

                <!-- Endgame fouls section -->
                <div>
                  <span class="fw-bold">Endgame fouls:</span>
                </div>
                <div class="form-check form-check-inline">
                  <label for="endgameFoul1" class="form-label">Contact with opposing robot while it is touching its cage</label>
                  <input id="endgameFoul1" class="form-check-input" type="checkbox">
                </div>
              </div>
            </div>

            <!-- Comments section -->
            <div class="card mb-3" style="background-color:#F8F9FA">
              <div class="card-header fw-bold">
                Comments
              </div>
              <div class="card-body">
                <div>
                  <label for="problemComment" class="form-label">Problems robot ran into on the field:</label>
                  <input id="problemComment" class="form-control" type="text">
                </div>

                <div>
                  <label for="generalComment" class="form-label">General comment:</label>
                  <input id="generalComment" class="form-control" type="text">
                </div>
              </div>
            </div>
            <!-- End Comments section -->
          </form>

          <!-- Submit button -->
          <div class="d-grid gap-2 col-6 mx-auto">
            <button id="submitButton" class="btn btn-primary" type="button">Submit</button>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'inc/footer.php'; ?>

<!-- Javascript page handlers -->

<script>

  function verifyStrategicForm() {
    console.log("==> strategicForm.php: clearStrategicForm()");
    let isError = false;
    let errMsg = "Please enter values for these fields:";

    // Make sure there is a team number, scoutname and matchnum.
    let teamNum = document.getElementById("teamNumber").value;
    if (((teamNum === "") || (validateTeamNumber(teamNum, null) <= 0))) {
      errMsg += " Team Number";
      isError = true;
    }
    if (document.getElementById("matchNumber").value === "") {
      errMsg += " Match Number";
      isError = true;
    }
    if (document.getElementById("scoutName").value === "") {
      errMsg += " Scout Name";
      isError = true;
    }
    if (isError) {
      alert(errMsg);
    }
    return isError;
  }

  function clearStrategicForm() {
    console.log("==> strategicForm.php: clearStrategicForm()");
    document.getElementById("scoutName").value = "";
    document.getElementById("teamNumber").value = "";
    document.getElementById("compLevel").value = "";
    document.getElementById("matchNumber").value = "";
    const driverAbilityBtns = document.querySelectorAll("input[name = 'driverAbilityGroup']");
    driverAbilityBtns.forEach(button => {
      button.checked = false;
    });

    document.getElementById("defenseTactic1").checked = false;
    document.getElementById("defenseTactic2").checked = false;
    document.getElementById("defenseComment").value = "";

    document.getElementById("againstTactic1").checked = false;
    document.getElementById("againstComment").value = "";

    document.getElementById("foul1").checked = false;

    document.getElementById("autonFoul1").checked = false;
    document.getElementById("autonFoul2").checked = false;
    document.getElementById("autonGetCoralFromFloor").checked = false;
    document.getElementById("autonGetCoralFromStation").checked = false;
    document.getElementById("autonGetAlgaeFromFloor").checked = false;
    document.getElementById("autonGetAlgaeFromReef").checked = false;

    document.getElementById("teleopFoul1").checked = false;
    document.getElementById("teleopFoul2").checked = false;
    document.getElementById("teleopFoul3").checked = false;
    document.getElementById("teleopFoul4").checked = false;
    document.getElementById("teleopKnockOffAlgaeFromReef").checked = false;
    document.getElementById("teleopAcquireAlgaeFromReef").checked = false;
    document.getElementById("teleopFloorPickupCoral").checked = false;
    document.getElementById("teleopFloorPickupAlgae").checked = false;

    document.getElementById("endgameFoul1").checked = false;

    document.getElementById("problemComment").value = "";
    document.getElementById("generalComment").value = "";
  }

  // Write strategic form data to DB table
  function writeStrategicFormToTable() {
    console.log("==> strategicForm.php: writeStrategicFormToTable()");
    let dataToSave = {};

    let compLevel = document.getElementById("compLevel").value;
    let matchNumber = document.getElementById("matchNumber").value;
    let teamnum = validateTeamNumber(document.getElementById("teamNumber").value, null);

    // Clean up teamnumber before writing to table.
    dataToSave["matchnumber"] = compLevel + matchNumber;
    dataToSave["teamnumber"] = teamnum;
    dataToSave["scoutname"] = document.getElementById("scoutName").value;

    // Process driver ability radio buttons
    const driverAbilityBtns = document.querySelectorAll("input[name = 'driverAbilityGroup']");
    dataToSave["driverability"] = 0; // default
    driverAbilityBtns.forEach(button => {
      if (button.checked) {
        console.log("driverability: " + button.value + " selected!");
        dataToSave["driverability"] = +button.value;
      }
    });

    // Checkboxes and comment fields
    dataToSave["defense_tactic1"] = (document.getElementById("defenseTactic1").checked) ? 1 : 0;
    dataToSave["defense_tactic2"] = (document.getElementById("defenseTactic2").checked) ? 1 : 0;
    dataToSave["defense_comment"] = document.getElementById("defenseComment").value;

    dataToSave["against_tactic1"] = (document.getElementById("againstTactic1").checked) ? 1 : 0;
    dataToSave["against_comment"] = document.getElementById("againstComment").value;

    dataToSave["foul1"] = (document.getElementById("foul1").checked) ? 1 : 0;
    dataToSave["autonFoul1"] = (document.getElementById("autonFoul1").checked) ? 1 : 0;
    dataToSave["autonFoul2"] = (document.getElementById("autonFoul2").checked) ? 1 : 0;
    dataToSave["autonGetCoralFromFloor"] = (document.getElementById("autonGetCoralFromFloor").checked) ? 1 : 0;
    dataToSave["autonGetCoralFromStation"] = (document.getElementById("autonGetCoralFromStation").checked) ? 1 : 0;
    dataToSave["autonGetAlgaeFromFloor"] = (document.getElementById("autonGetAlgaeFromFloor").checked) ? 1 : 0;
    dataToSave["autonGetAlgaeFromReef"] = (document.getElementById("autonGetAlgaeFromReef").checked) ? 1 : 0;
    dataToSave["teleopFoul1"] = (document.getElementById("teleopFoul1").checked) ? 1 : 0;
    dataToSave["teleopFoul2"] = (document.getElementById("teleopFoul2").checked) ? 1 : 0;
    dataToSave["teleopFoul3"] = (document.getElementById("teleopFoul3").checked) ? 1 : 0;
    dataToSave["teleopFoul4"] = (document.getElementById("teleopFoul4").checked) ? 1 : 0;
    dataToSave["teleopKnockOffAlgaeFromReef"] = (document.getElementById("teleopKnockOffAlgaeFromReef").checked) ? 1 : 0;
    dataToSave["teleopAcquireAlgaeFromReef"] = (document.getElementById("teleopAcquireAlgaeFromReef").checked) ? 1 : 0;
    dataToSave["teleopFloorPickupCoral"] = (document.getElementById("teleopFloorPickupCoral").checked) ? 1 : 0;
    dataToSave["teleopFloorPickupAlgae"] = (document.getElementById("teleopFloorPickupAlgae").checked) ? 1 : 0;
    dataToSave["endgameFoul1"] = (document.getElementById("endgameFoul1").checked) ? 1 : 0;

    dataToSave["problem_comment"] = document.getElementById("problemComment").value;
    dataToSave["general_comment"] = document.getElementById("generalComment").value;

    $.post("api/dbWriteAPI.php", {
      writeStrategicData: JSON.stringify(dataToSave)
    }).done(function (response) {
      console.log("=> writeStrategicData");
      // Because success word may have a newline at the end, don't do a direct compare
      if (response.indexOf('success') > -1) {
        alert("Success in submitting Strategic Form data!");
        clearStrategicForm();
      } else {
        alert("Failure in submitting Strategic Form!");
      }
    });
  }

  /////////////////////////////////////////////////////////////////////////////
  //
  // Process the generated html
  //
  document.addEventListener("DOMContentLoaded", () => {

    // Update the navbar with the event code
    $.get("api/dbAPI.php", {
      getEventCode: true
    }, function (eventCode) {
      eventCode = eventCode.trim();
      console.log("=> strategicForm: getEventCode: " + eventCode);
      document.getElementById("navbarEventCode").innerText = eventCode;
    });

    // Submit the strategic form data
    document.getElementById("submitButton").addEventListener('click', function () {
      // Should be:
      // formData getFormData()
      // if (validateStrategicData(formData))
      //    submitStrategicData(formData);

      if (!verifyStrategicForm()) {
        writeStrategicFormToTable();
      }
    });

  });
</script>

<script src="./scripts/validateTeamNumber.js"></script>
