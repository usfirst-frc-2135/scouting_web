<?php include 'header.php'; ?>

<title>Strategic Scouting</title>

<div class="container row-offcanvas row-offcanvas-left">
  <div class="well column  col-lg-12  col-sm-12 col-xs-12" id="content">
    <div class="row pt-3 pb-3 mb-3">
      <div class="row g-3 justify-content-md-center">
        <div class="row justify-content-md-center">
          <h2 class="col-md-6"> Stratgic Scouting </h2>
        </div>
      </div>

      <div class="card col-md-6 mx-auto">

        <div id="strategicScoutingMessage" style="display: none" class="alert alert-dismissible fade show" role="alert">
          <div id="uploadMessageText"></div>
          <button type="button" class="btn-close" id="closeMessage" aria-label="Close"></button>
        </div>

        <div class="card-body">
          <form id="strategicForm" method="post" enctype="multipart/form-data">

            <div class="mb-3">
              <label for="teamNumber" class="form-label">Team Number </label>
              <input type="text" class="form-control" id="teamNumber">
            </div>

            <div class="mb-3">
              <label for="matchNumber" class="form-label">Match Number </label>
              <input type="text" class="form-control" id="matchNumber">
            </div>

            <div class="mb-3">
              <label for="scoutName" class="form-label">Scout Name</label>
              <input type="text" class="form-control" id="scoutName">
            </div>

            <!-- Autonomous Mode -->
            <div class="card" style="background-color:#cfe2ff">
              <div class="card-header">
                <b>Autonomous Mode</b>
              </div>
              <div class="card-body">
                <div>
                  <label class="form-label"><b>Auton - Get coral from:</b></label>
                </div>
                <div class="form-check form-check-inline">
                  <label for="autonGetCoralFromFloor" class="form-label">Floor</label>
                  <input class="form-check-input" type="checkbox" id="autonGetCoralFromFloor">
                </div>
                <div class="form-check form-check-inline">
                  <label for="autonGetCoralFromStation" class="form-label">Coral Station</label>
                  <input class="form-check-input" type="checkbox" id="autonGetCoralFromStation">
                </div>
                <p> </p>
                <div>
                  <label class="form-label"><b>Auton - Get algae from:</b></label>
                </div>
                <div class="form-check form-check-inline">
                  <label for="autonGetAlgaeFromFloor" class="form-label">Floor</label>
                  <input class="form-check-input" type="checkbox" id="autonGetAlgaeFromFloor">
                </div>
                <div class="form-check form-check-inline">
                  <label for="autonGetAlgaeFromReef" class="form-label">Reef</label>
                  <input class="form-check-input" type="checkbox" id="autonGetAlgaeFromReef">
                </div>

                <!-- Auton - Committed fouls section -->
                <p> </p>
                <div>
                  <label class="form-label"><b>Auton - Committed fouls:</b></label>
                </div>
                <div class="form-check form-check-inline">
                  <label for="autonFoul1" class="form-label">Contact with opposing robot in their barge zone</label>
                  <input class="form-check-input" type="checkbox" id="autonFoul1">
                </div>
                <div class="form-check form-check-inline">
                  <label for="autonFoul2" class="form-label">Contact with opposing cage</label>
                  <input class="form-check-input" type="checkbox" id="autonFoul2">
                </div>
              </div>
            </div>
            <!-- end Autonomous Mode -->

            <!-- Teleop Mode -->
            <div class="card" style="background-color:#c8f1ff">
              <div class="card-header">
                <b>Teleop Mode</b>
              </div>
              <div class="card-body">

                <!-- Teleop - Floor pickup section -->
                <div>
                  <label class="form-label"><b>Teleop - Floor pickup:</b></label>
                </div>
                <div class="form-check form-check-inline">
                  <label for="teleopFloorPickupCoral" class="form-label">Coral</label>
                  <input class="form-check-input" type="checkbox" id="teleopFloorPickupCoral">
                </div>
                <div class="form-check form-check-inline">
                  <label for="teleopFloorPickupAlgae" class="form-label">Algae</label>
                  <input class="form-check-input" type="checkbox" id="teleopFloorPickupAlgae">
                </div>
                <!-- Teleop - Algae from reef section -->
                <p> </p>
                <div>
                  <label class="form-label"><b>Teleop - Algae from reef:</b></label>
                </div>
                <div class="form-check form-check-inline">
                  <label for="teleopKnockOffAlgaeFromReef" class="form-label">Knock off algae from reef</label>
                  <input class="form-check-input" type="checkbox" id="teleopKnockOffAlgaeFromReef">
                </div>
                <div class="form-check form-check-inline">
                  <label for="teleopAcquireAlgaeFromReef" class="form-label">Acquire algae from reef</label>
                  <input class="form-check-input" type="checkbox" id="teleopAcquireAlgaeFromReef">
                </div>

                <!-- Driver ability section -->
                <p> </p>
                <div>
                  <label class="form-label"><b>Driver ability/speed:</b></label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="driverAbilityGroup" id="driveScore1">
                  <label class="form-check-label" for="driveScore1">1 - Jerky</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="driverAbilityGroup" id="driveScore2">
                  <label class="form-check-label" for="driveScore2">2 - Slow</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="driverAbilityGroup" id="driveScore3">
                  <label class="form-check-label" for="driveScore3">3 - Average</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="driverAbilityGroup" id="driveScore4">
                  <label class="form-check-label" for="driveScore4">4 - Quick/agile</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="driverAbilityGroup" id="driveScore5">
                  <label class="form-check-label" for="driveScore5">5 - N/A</label>
                </div>

                <!-- Against defensive robot section -->
                <p> </p>
                <div>
                  <label class="form-label"><b>Against defensive robot:</b></label>
                </div>
                <div class="form-check form-check-inline">
                  <label for="againstTactic1" class="form-label">Path Blocked (able to escape quickly?)</label>
                  <input class="form-check-input" type="checkbox" id="againstTactic1">
                </div>
                <div class="mb-3">
                  <label for="againstComment" class="form-label">Against defense note: </label>
                  <input type="text" class="form-control" id="againstComment">
                </div>
                <p> </p>
                <div>
                  <label class="form-label"><b>Endgame: Climbing Foul:</b></label>
                </div>
                <div class="form-check form-check-inline">
                  <label for="teleopFoul1" class="form-label">Contact with anchor when climbing</label>
                  <input class="form-check-input" type="checkbox" id="teleopFoul1">
                </div>
              </div>
            </div>
            <!-- end Teleop Mode -->

            <!-- Playing Defense Section -->
            <div class="card" style="background-color:#e8f1ff">
              <div class="card-header">
                <b>Playing Defense</b>
              </div>
              <div class="card-body">
                <!-- Defense tactics section -->
                <div>
                  <label class="form-label"><b>Defense tactics played:</b></label>
                </div>
                <div class="form-check form-check-inline">
                  <label for="defenseTactic1" class="form-label">Blocking loading station (how long detained?)</label>
                  <input class="form-check-input" type="checkbox" id="defenseTactic1">
                </div>
                <div class="form-check form-check-inline">
                  <label for="defenseTactic2" class="form-label">Blocking path (how long detained? where?)</label>
                  <input class="form-check-input" type="checkbox" id="defenseTactic2">
                </div>
                <div class="mb-3">
                  <label for="defenseComment" class="form-label">Defense note: </label>
                  <input type="text" class="form-control" id="defenseComment">
                </div>

                <!-- Committed fouls section -->
                <p> </p>
                <div>
                  <label class="form-label"><b>Committed fouls:</b></label>
                </div>
                <div class="form-check form-check-inline">
                  <label for="foul1" class="form-label">Pinning for 3 count</label>
                  <input class="form-check-input" type="checkbox" id="foul1">
                </div>
                <div class="form-check form-check-inline">
                  <label for="teleopFoul3" class="form-label">Contact with opposing robot in their reef zone</label>
                  <input class="form-check-input" type="checkbox" id="teleopFoul3">
                </div>
                <div class="form-check form-check-inline">
                  <label for="teleopFoul2" class="form-label">Contact with opposing robot in their barge zone</label>
                  <input class="form-check-input" type="checkbox" id="teleopFoul2">
                </div>
                <div class="form-check form-check-inline">
                  <label for="teleopFoul4" class="form-label">Contact with opposing cage </label>
                  <input class="form-check-input" type="checkbox" id="teleopFoul4">
                </div>

                <!-- Endgame fouls section -->
                <p> </p>
                <div>
                  <label class="form-label"><b>Endgame fouls:</b></label>
                </div>
                <div class="form-check form-check-inline">
                  <label for="endgameFoul1" class="form-label">Contact with opposing robot while it is touching its cage</label>
                  <input class="form-check-input" type="checkbox" id="endgameFoul1">
                </div>
              </div>
            </div>

            <!-- Comments section -->
            <div class="card" style="background-color:#83b4ff">
              <div class="card-header">
                <b>Comments</b>
              </div>
              <div class="card-body">
                <div class="mb-3">
                  <label for="problemComment" class="form-label">Problems robot ran into on the field:</label>
                  <input type="text" class="form-control" id="problemComment">
                </div>

                <p> </p>
                <div class="mb-3">
                  <label for="generalComment" class="form-label">General comment:</label>
                  <input type="text" class="form-control" id="generalComment">
                </div>
              </div>
            </div>
            <!-- End Comments section -->

            <!-- Submit button -->
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


<?php include 'footer.php'; ?>

<script>

  function verifyData() {
    var isError = false;
    var errMsg = "Please enter values for these fields:";

    // Make sure there is a team number, scoutname and matchnum.
    if ($("#teamNumber").val() == "") {
      errMsg += " Team Number";
      isError = true;
    }
    if ($("#matchNumber").val() == "") {
      errMsg += " Match Number";
      isError = true;
    }
    if ($("#scoutName").val() == "") {
      errMsg += " Scout Name";
      isError = true;
    }
    if (isError) {
      alert(errMsg);
    }
    return isError;
  }


  function clearForm() {
    $("#scoutName").val("");
    $("#teamNumber").val("");
    $("#matchNumber").val("");
    $("#driveScore1").prop("checked", false);
    $("#driveScore2").prop("checked", false);
    $("#driveScore3").prop("checked", false);
    $("#driveScore4").prop("checked", false);
    $("#driveScore5").prop("checked", false);

    $("#defenseTactic1").prop("checked", false);
    $("#defenseTactic2").prop("checked", false);
    $("#defenseComment").val("");

    $("#againstTactic1").prop("checked", false);
    $("#againstComment").val("");

    $("#foul1").prop("checked", false);

    $("#autonFoul1").prop("checked", false);
    $("#autonFoul2").prop("checked", false);
    $("#autonGetCoralFromFloor").prop("checked", false);
    $("#autonGetCoralFromStation").prop("checked", false);
    $("#autonGetAlgaeFromFloor").prop("checked", false);
    $("#autonGetAlgaeFromReef").prop("checked", false);

    $("#teleopFoul1").prop("checked", false);
    $("#teleopFoul2").prop("checked", false);
    $("#teleopFoul3").prop("checked", false);
    $("#teleopFoul4").prop("checked", false);
    $("#teleopKnockOffAlgaeFromReef").prop("checked", false);
    $("#teleopAcquireAlgaeFromReef").prop("checked", false);
    $("#teleopFloorPickupCoral").prop("checked", false);
    $("#teleopFloorPickupAlgae").prop("checked", false);

    $("#endgameFoul1").prop("checked", false);

    $("#problemComment").val("");
    $("#generalComment").val("");
  }

  function writeDataToAPI() {
    var dataToUse = {};

    // Clean up teamnumber before writing to table.
    var teamnum = $("#teamNumber").val();
    teamnum = teamnum.toUpperCase();  // if there's a letter, make it upper case
    teamnum = teamnum.replace(/[^0-9a-zA-Z]/g, '');  // remove any non-alphanumeric chars
    dataToUse["scoutname"] = $("#scoutName").val();
    dataToUse["teamnumber"] = teamnum;
    dataToUse["matchnumber"] = $("#matchNumber").val();

    // Assume that some options were not checked at all.
    dataToUse["driverability"] = 0; // default
    if ($("#driveScore1").is(':checked')) {
      dataToUse["driverability"] = 1;
    }
    if ($("#driveScore2").is(':checked')) {
      dataToUse["driverability"] = 2;
    }
    if ($("#driveScore3").is(':checked')) {
      dataToUse["driverability"] = 3;
    }
    if ($("#driveScore4").is(':checked')) {
      dataToUse["driverability"] = 4;
    }
    if ($("#driveScore5").is(':checked')) {
      dataToUse["driverability"] = 5;
    }

    dataToUse["defense_tactic1"] = 0;     // default
    dataToUse["defense_tactic2"] = 0;     // default
    if ($("#defenseTactic1").is(':checked')) {
      dataToUse["defense_tactic1"] = 1;
    }
    if ($("#defenseTactic2").is(':checked')) {
      dataToUse["defense_tactic2"] = 1;
    }
    dataToUse["defense_comment"] = $("#defenseComment").val();

    dataToUse["against_tactic1"] = 0;     // default
    if ($("#againstTactic1").is(':checked')) {
      dataToUse["against_tactic1"] = 1;
    }
    dataToUse["against_comment"] = $("#againstComment").val();

    dataToUse["foul1"] = 0;     // default
    dataToUse["autonFoul1"] = 0;     // default
    dataToUse["autonFoul2"] = 0;     // default
    dataToUse["autonGetCoralFromFloor"] = 0;     // default
    dataToUse["autonGetCoralFromStation"] = 0;     // default
    dataToUse["autonGetAlgaeFromFloor"] = 0;     // default
    dataToUse["autonGetAlgaeFromReef"] = 0;     // default
    dataToUse["teleopFoul1"] = 0;     // default
    dataToUse["teleopFoul2"] = 0;     // default
    dataToUse["teleopFoul3"] = 0;     // default
    dataToUse["teleopFoul4"] = 0;     // default
    dataToUse["teleopKnockOffAlgaeFromReef"] = 0;     // default
    dataToUse["teleopAcquireAlgaeFromReef"] = 0;     // default
    dataToUse["teleopFloorPickupCoral"] = 0;     // default
    dataToUse["teleopFloorPickupAlgae"] = 0;     // default
    dataToUse["endgameFoul1"] = 0;     // default
    if ($("#foul1").is(':checked')) {
      dataToUse["foul1"] = 1;
    }
    if ($("#autonFoul1").is(':checked')) {
      dataToUse["autonFoul1"] = 1;
    }
    if ($("#autonFoul2").is(':checked')) {
      dataToUse["autonFoul2"] = 1;
    }
    if ($("#autonGetCoralFromFloor").is(':checked')) {
      dataToUse["autonGetCoralFromFloor"] = 1;
    }
    if ($("#autonGetCoralFromStation").is(':checked')) {
      dataToUse["autonGetCoralFromStation"] = 1;
    }
    if ($("#autonGetAlgaeFromFloor").is(':checked')) {
      dataToUse["autonGetAlgaeFromFloor"] = 1;
    }
    if ($("#autonGetAlgaeFromReef").is(':checked')) {
      dataToUse["autonGetAlgaeFromReef"] = 1;
    }
    if ($("#teleopFoul1").is(':checked')) {
      dataToUse["teleopFoul1"] = 1;
    }
    if ($("#teleopFoul2").is(':checked')) {
      dataToUse["teleopFoul2"] = 1;
    }
    if ($("#teleopFoul3").is(':checked')) {
      dataToUse["teleopFoul3"] = 1;
    }
    if ($("#teleopFoul4").is(':checked')) {
      dataToUse["teleopFoul4"] = 1;
    }
    if ($("#teleopKnockOffAlgaeFromReef").is(':checked')) {
      dataToUse["teleopKnockOffAlgaeFromReef"] = 1;
    }
    if ($("#teleopAcquireAlgaeFromReef").is(':checked')) {
      dataToUse["teleopAcquireAlgaeFromReef"] = 1;
    }
    if ($("#teleopFloorPickupCoral").is(':checked')) {
      dataToUse["teleopFloorPickupCoral"] = 1;
    }
    if ($("#teleopFloorPickupAlgae").is(':checked')) {
      dataToUse["teleopFloorPickupAlgae"] = 1;
    }
    if ($("#endgameFoul1").is(':checked')) {
      dataToUse["endgameFoul1"] = 1;
    }

    dataToUse["problem_comment"] = $("#problemComment").val();
    dataToUse["general_comment"] = $("#generalComment").val();

    $.post("writeAPI.php", {
      writeStrategicData: JSON.stringify(dataToUse)
    }).done(function (data) {
      // Because success word may have a new-line at the end, don't do a direct compare
      if (data.indexOf('success') > -1) {
        alert("Success in submitting strategic scouting data!");
        clearForm();
      } else {
        alert("Failure in submitting strategic scouting!");
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
