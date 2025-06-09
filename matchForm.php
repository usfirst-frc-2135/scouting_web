<?php
$title = 'Match Scouting Form';
require 'header.php';
?>

<div class="container row-offcanvas row-offcanvas-left">
  <div id="content" class="column card-lg-12 col-sm-12 col-xs-12">

    <!-- Page Title -->
    <div class="row pt-3 pb-3 mb-3">
      <div class="row justify-content-md-center">
        <h2 class="col-md-6"><?php echo $title; ?></h2>
      </div>

      <!-- Main card to hold the match form -->
      <div class="card col-md-6 mx-auto">

        <div id="matchScoutingMessage" class="alert alert-dismissible fade show" style="display: none" role="alert">
          <div id="uploadMessageText"></div>
          <button id="closeMessage" class="btn-close" type="button" aria-label="Close"></button>
        </div>

        <!-- Match Entry Form -->
        <div class="card-body mb-3">
          <form id="matchForm" method="post" enctype="multipart/form-data" name="matchForm">
            <div>
              <h3>Match Info</h3>
            </div>
            <div class="mb-3">
              <label for="teamNumber" class="form-label">Team Number</label>
              <input id="teamNumber" class="form-control" type="number" placeholder="FRC team number">
            </div>
            <div class="mb-3">
              <span>Match Number</span>
              <div class="input-group">
                <select id="compLevel" class="form-select" aria-label="Comp Level Select">
                  <option value="p">P</option>
                  <option value="qm">QM</option>
                  <option value="qf">QF</option>
                  <option value="sf">SF</option>
                  <option value="f">F</option>
                </select>
                <input id="matchNumber" class="form-control" type="text" placeholder="Match Number" aria-label="Match Number">
              </div>
            </div>
            <div class="mb-3">
              <label for="scoutName" class="form-label">Scout Name</label>
              <input id="scoutName" class="form-control" type="text" placeholder="First name, last initial">
            </div>

            <!-- Autonomous Mode -->
            <div class="card mb-3" style="background-color:#D5E6DE">
              <div class="card-header fw-bold">
                Autonomous Mode
              </div>

              <div class="card-body">
                <!-- Checkboxes -->
                <div class="form-check form-check-inline mb-3">
                  <input id="exitCommunity" class="form-check-input" type="checkbox" name="exitCommunity">
                  <label for=" exitCommunity" class=" form-check-label">Exited Community?</label>
                </div>

                <!-- Cones -->
                <div class="input-group mb-3 fw-bold">
                  <button id="autoConesTopMinus" class="btn btn-danger col-1" type="button">-</button>
                  <span id="autoConesTop" class="input-group-text bg-warning col-8">Auto Cones Top: 0</span>
                  <button id="autoConesTopPlus" class="btn btn-success col-1" type="button">+</button>
                </div>

                <div class="input-group mb-3 fw-bold">
                  <button id="autoConesMiddleMinus" class="btn btn-danger col-1" type="button">-</button>
                  <span id="autoConesMiddle" class="input-group-text bg-warning col-8">Auto Cones Middle: 0</span>
                  <button id="autoConesMiddlePlus" class="btn btn-success col-1" type="button">+</button>
                </div>

                <div class="input-group mb-3 fw-bold">
                  <button id="autoConesBottomMinus" class="btn btn-danger col-1" type="button">-</button>
                  <span id="autoConesBottom" class="input-group-text bg-warning col-8">Auto Cones Bottom: 0</span>
                  <button id="autoConesBottomPlus" class="btn btn-success col-1" type="button">+</button>
                </div>

                <!-- Cubes -->
                <div class="input-group mb-3 fw-bold">
                  <button id="autoCubesTopMinus" class="btn btn-danger col-1" type="button">-</button>
                  <span id="autoCubesTop" class="input-group-text col-8" style="background-color:#9B72EF">Auto Cubes Top: 0</span>
                  <button id="autoCubesTopPlus" class="btn btn-success col-1" type="button">+</button>
                </div>

                <div class="input-group mb-3 fw-bold">
                  <button id="autoCubesMiddleMinus" class="btn btn-danger col-1" type="button">-</button>
                  <span id="autoCubesMiddle" class="input-group-text col-8" style="background-color:#9B72EF">Auto Cubes Middle:
                    0</span>
                  <button id="autoCubesMiddlePlus" class="btn btn-success col-1" type="button">+</button>
                </div>

                <div class="input-group mb-3 fw-bold">
                  <button id="autoCubesBottomMinus" class="btn btn-danger col-1" type="button">-</button>
                  <span id="autoCubesBottom" class="input-group-text col-8" style="background-color:#9B72EF">Auto Cubes Bottom:
                    0</span>
                  <button id="autoCubesBottomPlus" class="btn btn-success col-1" type="button">+</button>
                </div>

                <div class="form-check">
                  <label for="autochargestation" class="form-check-label">Auto Charge Station?</label>
                  <select id="autochargestation" class="form-select">
                    <option value="0">None</option>
                    <option value="1">Docked</option>
                    <option value="2">Engaged</option>
                  </select>
                </div>
              </div>
            </div>
            <!-- end Autonomous Mode -->

            <!-- Telop Mode -->
            <div class="card mb-3" style="background-color:#D6F3FB">
              <div class="card-header fw-bold">
                Teleop Mode
              </div>
              <div class="card-body">

                <!-- Cones -->
                <div class="input-group mb-3 fw-bold">
                  <button id="teleopConesTopMinus" class="btn btn-danger col-1" type="button">-</button>
                  <span id="teleopConesTop" class="input-group-text bg-warning col-8">Teleop Cones Top: 0</span>
                  <button id="teleopConesTopPlus" class="btn btn-success col-1" type="button">+</button>
                </div>

                <div class="input-group mb-3 fw-bold">
                  <button id="teleopConesMiddleMinus" class="btn btn-danger col-1" type="button">-</button>
                  <span id="teleopConesMiddle" class="input-group-text bg-warning col-8">Teleop Cones Middle: 0</span>
                  <button id="teleopConesMiddlePlus" class="btn btn-success col-1" type="button">+</button>
                </div>

                <div class="input-group mb-3 fw-bold">
                  <button id="teleopConesBottomMinus" class="btn btn-danger col-1" type="button">-</button>
                  <span id="teleopConesBottom" class="input-group-text bg-warning col-8">Teleop Cones Bottom: 0</span>
                  <button id="teleopConesBottomPlus" class="btn btn-success col-1" type="button">+</button>
                </div>

                <!-- Cubes -->
                <div class="input-group mb-3 fw-bold">
                  <button id="teleopCubesTopMinus" class="btn btn-danger col-1" type="button">-</button>
                  <span id="teleopCubesTop" class="input-group-text col-8" style="background-color:#9B72EF">Teleop Cubes Top:
                    0</span>
                  <button id="teleopCubesTopPlus" class="btn btn-success col-1" type="button">+</button>
                </div>

                <div class="input-group mb-3 fw-bold">
                  <button id="teleopCubesMiddleMinus" class="btn btn-danger col-1" type="button">-</button>
                  <span id="teleopCubesMiddle" class="input-group-text col-8" style="background-color:#9B72EF">Teleop Cubes Middle:
                    0</span>
                  <button id="teleopCubesMiddlePlus" class="btn btn-success col-1" type="button">+</button>
                </div>

                <div class="input-group mb-3 fw-bold">
                  <button id="teleopCubesBottomMinus" class="btn btn-danger col-1" type="button">-</button>
                  <span id="teleopCubesBottom" class="input-group-text col-8" style="background-color:#9B72EF">Teleop Cubes Bottom:
                    0</span>
                  <button id="teleopCubesBottomPlus" class="btn btn-success col-1" type="button">+</button>
                </div>

                <!-- Checkboxes -->
                <div class="form-check form-check-inline">
                  <input id="pickedupCube" class="form-check-input" type="checkbox" name="pickedupCube">
                  <label for="pickedupCube" class="form-check-label">Picked Up Cube?</label>
                </div>

                <div class="form-check form-check-inline">
                  <input id="pickedupUprightCone" class="form-check-input" type="checkbox" name="pickedupUprightCone">
                  <label for="pickedupUprightCone" class="form-check-label">Picked Up Upright Cone?</label>
                </div>

                <div class="form-check form-check-inline">
                  <input id="pickedupTippedCone" class="form-check-input" type="checkbox" name="pickedupTippedCone">
                  <label for="pickedupTippedCone" class="form-check-label">Picked Up Tipped Cone</label>
                </div>
              </div>
            </div>
            <!-- end Teleop Mode -->

            <!-- End Game -->
            <div class="card mb-3" style="background-color:#FBE6D3">
              <div class="card-header fw-bold">
                End Game
              </div>
              <div class="card-body">

                <div class="form-check mb-3">
                  <label for="endgamechargestation" class="form-check-label">Charge Station?</label>
                  <select id="endgamechargestation" class="form-select">
                    <option value="0">None</option>
                    <option value="1">Parked</option>
                    <option value="2">Docked</option>
                    <option value="3">Engaged</option>
                  </select>
                </div>

                <div class="form-check form-check-inline mb-3">
                  <input id="dead" class="form-check-input" type="checkbox" name="dead">
                  <label for="dead" class="form-check-label">Dead?</label>
                </div>

                <div>
                  <label for="generalComment" class="form-label">General comment:</label>
                  <input id="generalComment" class="form-control" type="text">
                </div>
              </div>
            </div>
          </form>
          <!-- End Comments section -->

          <!-- Submit button -->
          <div class="d-grid gap-2 col-6 mx-auto">
            <button id="submitForm" class="btn btn-primary" type="button" style="width:100%">Submit</button>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>

<!-- Javascript page handlers -->

<script>
  var autoConesBottom = 0;
  var autoConesMiddle = 0;
  var autoConesTop = 0;
  var autoCubesBottom = 0;
  var autoCubesMiddle = 0;
  var autoCubesTop = 0;
  var teleopConesBottom = 0;
  var teleopConesMiddle = 0;
  var teleopConesTop = 0;
  var teleopCubesBottom = 0;
  var teleopCubesMiddle = 0;
  var teleopCubesTop = 0;

  function attachGamepieceScoring() {
    console.log("==> matchForm.php: attachGamepieceScoring()");
    // Auto cones
    $("#autoConesBottomPlus").click(function () {
      autoConesBottom += 1;
      $("#autoConesBottom").html("Auto Cones Bottom: " + autoConesBottom);
    });

    $("#autoConesBottomMinus").click(function () {
      autoConesBottom = Math.max(autoConesBottom - 1, 0);
      $("#autoConesBottom").html("Auto Cones Bottom: " + autoConesBottom);
    });

    $("#autoConesMiddlePlus").click(function () {
      autoConesMiddle += 1;
      $("#autoConesMiddle").html("Auto Cones Middle: " + autoConesMiddle);
    });

    $("#autoConesMiddleMinus").click(function () {
      autoConesMiddle = Math.max(autoConesMiddle - 1, 0);
      $("#autoConesMiddle").html("Auto Cones Middle: " + autoConesMiddle);
    });

    $("#autoConesTopPlus").click(function () {
      autoConesTop += 1;
      $("#autoConesTop").html("Auto Cones Top: " + autoConesTop);
    });

    $("#autoConesTopMinus").click(function () {
      autoConesTop = Math.max(autoConesTop - 1, 0);
      $("#autoConesTop").html("Auto Cones Top: " + autoConesTop);
    });

    // Auto cubes
    $("#autoCubesBottomPlus").click(function () {
      autoCubesBottom += 1;
      $("#autoCubesBottom").html("Auto Cubes Bottom: " + autoCubesBottom);
    });

    $("#autoCubesBottomMinus").click(function () {
      autoCubesBottom = Math.max(autoCubesBottom - 1, 0);
      $("#autoCubesBottom").html("Auto Cubes Bottom: " + autoCubesBottom);
    });

    $("#autoCubesMiddlePlus").click(function () {
      autoCubesMiddle += 1;
      $("#autoCubesMiddle").html("Auto Cubes Middle: " + autoCubesMiddle);
    });

    $("#autoCubesMiddleMinus").click(function () {
      autoCubesMiddle = Math.max(autoCubesMiddle - 1, 0);
      $("#autoCubesMiddle").html("Auto Cubes Middle: " + autoCubesMiddle);
    });

    $("#autoCubesTopPlus").click(function () {
      autoCubesTop += 1;
      $("#autoCubesTop").html("Auto Cubes Top: " + autoCubesTop);
    });

    $("#autoCubesTopMinus").click(function () {
      autoCubesTop = Math.max(autoCubesTop - 1, 0);
      $("#autoCubesTop").html("Auto Cubes Top: " + autoCubesTop);
    });

    // Teleop cones
    $("#teleopConesBottomPlus").click(function () {
      teleopConesBottom += 1;
      $("#teleopConesBottom").html("Teleop Cones Bottom: " + teleopConesBottom);
    });

    $("#teleopConesBottomMinus").click(function () {
      teleopConesBottom = Math.max(teleopConesBottom - 1, 0);
      $("#teleopConesBottom").html("Teleop Cones Bottom: " + teleopConesBottom);
    });

    $("#teleopConesMiddlePlus").click(function () {
      teleopConesMiddle += 1;
      $("#teleopConesMiddle").html("Teleop Cones Middle: " + teleopConesMiddle);
    });

    $("#teleopConesMiddleMinus").click(function () {
      teleopConesMiddle = Math.max(teleopConesMiddle - 1, 0);
      $("#teleopConesMiddle").html("Teleop Cones Middle: " + teleopConesMiddle);
    });

    $("#teleopConesTopPlus").click(function () {
      teleopConesTop += 1;
      $("#teleopConesTop").html("Teleop Cones Top: " + teleopConesTop);
    });

    $("#teleopConesTopMinus").click(function () {
      teleopConesTop = Math.max(teleopConesTop - 1, 0);
      $("#teleopConesTop").html("Teleop Cones Top: " + teleopConesTop);
    });

    // Teleop cubes
    $("#teleopCubesBottomPlus").click(function () {
      teleopCubesBottom += 1;
      $("#teleopCubesBottom").html("Teleop Cubes Bottom: " + teleopCubesBottom);
    });

    $("#teleopCubesBottomMinus").click(function () {
      teleopCubesBottom = Math.max(teleopCubesBottom - 1, 0);
      $("#teleopCubesBottom").html("Teleop Cubes Bottom: " + teleopCubesBottom);
    });

    $("#teleopCubesMiddlePlus").click(function () {
      teleopCubesMiddle += 1;
      $("#teleopCubesMiddle").html("Teleop Cubes Middle: " + teleopCubesMiddle);
    });

    $("#teleopCubesMiddleMinus").click(function () {
      teleopCubesMiddle = Math.max(teleopCubesMiddle - 1, 0);
      $("#teleopCubesMiddle").html("Teleop Cubes Middle: " + teleopCubesMiddle);
    });

    $("#teleopCubesTopPlus").click(function () {
      teleopCubesTop += 1;
      $("#teleopCubesTop").html("Teleop Cubes Top: " + teleopCubesTop);
    });

    $("#teleopCubesTopMinus").click(function () {
      teleopCubesTop = Math.max(teleopCubesTop - 1, 0);
      $("#teleopCubesTop").html("Teleop Cubes Top: " + teleopCubesTop);
    });

  }

  function getFormData() {
    console.log("==> matchForm.php: getFormData()");
    var out = {};
    var matchLevel = $("#compLevel").val();
    var matchNumber = $("#matchNumber").val();
    if (matchNumber != parseInt(matchNumber)) {
      alert("Match number must be integer.");
      throw Error("Match number must be integer.");
    }
    var teamNumber = $("#teamNumber").val();
    if (teamNumber == "") {
      alert("Team number must not be empty.");
      throw Error("Team number must not be empty.");
    }
    out["matchnumber"] = matchLevel + matchNumber;
    out["teamnumber"] = teamNumber;
    // out["startpos"] = $("#autoStartPosition").val();
    out["mobility"] = $("#exitCommunity").is(':checked') ? 1 : 0;
    out["autonconesbottom"] = autoConesBottom;
    out["autonconesmiddle"] = autoConesMiddle;
    out["autonconestop"] = autoConesTop;
    out["autoncubesbottom"] = autoCubesBottom;
    out["autoncubesmiddle"] = autoCubesMiddle;
    out["autoncubestop"] = autoCubesTop;
    out["autochargestation"] = $("#autochargestation").val();
    out["teleopconesbottom"] = teleopConesBottom;
    out["teleopconesmiddle"] = teleopConesMiddle;
    out["teleopconestop"] = teleopConesTop;
    out["teleopcubesbottom"] = teleopCubesBottom;
    out["teleopcubesmiddle"] = teleopCubesMiddle;
    out["teleopcubestop"] = teleopCubesTop;
    out["cubepickup"] = $("#pickedupCube").is(':checked') ? 1 : 0;
    out["uprightconepickup"] = $("#pickedupUprightCone").is(':checked') ? 1 : 0;
    out["tippedconepickup"] = $("#pickedupTippedCone").is(':checked') ? 1 : 0;
    out["endgamechargestation"] = $("#endgamechargestation").val();
    out["died"] = $("#dead").is(':checked') ? 1 : 0;
    out["scoutname"] = $("#scoutName").val();
    out["comment"] = $("#comment").val();
    return out;
  }

  function clearData() {
    console.log("==> matchForm.php: clearData()");
    $("#matchNumber").val("");
    //$("#startpos").val("0");
    autoConesBottom = 0;
    autoConesMiddle = 0;
    autoConesTop = 0;
    autoCubesBottom = 0;
    autoCubesMiddle = 0;
    autoCubesTop = 0;
    teleopConesBottom = 0;
    teleopConesMiddle = 0;
    teleopConesTop = 0;
    teleopCubesBottom = 0;
    teleopCubesMiddle = 0;
    teleopCubesTop = 0;
    $("#autoConesBottom").html("Auto Cones Bottom: " + autoConesBottom);
    $("#autoConesMiddle").html("Auto Cones Middle: " + autoConesMiddle);
    $("#autoConesTop").html("Auto Cones Top: " + autoConesTop);
    $("#autoCubesBottom").html("Auto Cubes Bottom: " + autoCubesBottom);
    $("#autoCubesMiddle").html("Auto Cubes Middle: " + autoCubesMiddle);
    $("#autoCubesTop").html("Auto Cubes Top: " + autoCubesTop);
    $("#teleopConesBottom").html("Teleop Cones Bottom: " + teleopConesBottom);
    $("#teleopConesMiddle").html("Teleop Cones Middle: " + teleopConesMiddle);
    $("#teleopConesTop").html("Teleop Cones Top: " + teleopConesTop);
    $("#teleopCubesBottom").html("Teleop Cubes Bottom: " + teleopCubesBottom);
    $("#teleopCubesMiddle").html("Teleop Cubes Middle: " + teleopCubesMiddle);
    $("#teleopCubesTop").html("Teleop Cubes Top: " + teleopCubesTop);
    $("#teamNumber").val("");
    $("#comment").val("");
  }

  function submitMatchData(formData) {
    console.log("==> matchForm.php: submitMatchData()");
    $.post("api/writeAPI.php", {
      "writeSingleData": JSON.stringify(formData)
    }, function (returnCode) {
      // Because success word may have a new-line at the end, don't do a direct compare
      if (returnCode.indexOf('success') > -1) {
        alert("Data Successfully Submitted! Clearing Data.");
        clearData();
      } else {
        alert("Data NOT Submitted. Please Check Network Connectivity.");
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
      console.log("==> matchForm.php - getEventCode: " + eventCode);
      $("#navbarEventCode").html(eventCode);
    });

    attachGamepieceScoring();

    // Submit the match data form 
    $("#submitForm").click(function () {
      alert("This match form is NOT configured for 2025 game!");
      // var formData = getFormData();
      // submitMatchData(formData);
    });
  });
</script>
