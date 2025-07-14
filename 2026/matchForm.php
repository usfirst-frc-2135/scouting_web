<?php
$title = 'Match Scouting Form';
require 'inc/header.php';
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
              <h4>Match Info (CHARGED UP)</h4>
            </div>
            <div class="row col-9 col-md-7 mb-3">
              <span>Match Number</span>
              <div class="input-group">
                <div class="input-group-prepend">
                  <select id="enterCompLevel" class="form-select" aria-label="Comp Level Select">
                    <option id="compLevelP" value="p">P</option>
                    <option id="compLevelQM" value="qm" selected>QM</option>
                    <option id="compLevelSF" value="sf">SF</option>
                    <option id="compLevelF" value="f">F</option>
                  </select>
                </div>
                <input id="enterMatchNumber" class="form-control" type="text" placeholder="Match Number" aria-label="Match Number">
              </div>
            </div>

            <div class="col-7 col-md-5 mb-3">
              <label for="enterTeamNumber" class="form-label">Team Number</label>
              <input id="enterTeamNumber" class="form-control" type="text" placeholder="FRC team number">
            </div>

            <div class="col-7 col-md-6 mb-3">
              <label for="enterScoutName" class="form-label">Scout Name</label>
              <input id="enterScoutName" class="form-control" type="text" placeholder="First name, last initial">
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
                  <div class="input-group-prepend col-1">
                    <button id="autoConesTopMinus" class="btn btn-danger" type="button">-</button>
                  </div>
                  <span id="autoConesTop" class="input-group-text col-8 bg-warning">Cones Top: 0</span>
                  <div class="input-group-append col-1">
                    <button id="autoConesTopPlus" class="btn btn-success" type="button">+</button>
                  </div>
                </div>

                <div class="input-group mb-3 fw-bold">
                  <div class="input-group-prepend col-1">
                    <button id="autoConesMiddleMinus" class="btn btn-danger" type="button">-</button>
                  </div>
                  <span id="autoConesMiddle" class="input-group-text col-8 bg-warning">Cones Middle: 0</span>
                  <div class="input-group-append col-1">
                    <button id="autoConesMiddlePlus" class="btn btn-success" type="button">+</button>
                  </div>
                </div>

                <div class="input-group mb-3 fw-bold">
                  <div class="input-group-prepend col-1">
                    <button id="autoConesBottomMinus" class="btn btn-danger" type="button">-</button>
                  </div>
                  <span id="autoConesBottom" class="input-group-text col-8 bg-warning">Cones Bottom: 0</span>
                  <div class="input-group-append col-1">
                    <button id="autoConesBottomPlus" class="btn btn-success" type="button">+</button>
                  </div>
                </div>

                <!-- Cubes -->
                <div class="input-group mb-3 fw-bold">
                  <div class="input-group-prepend col-1">
                    <button id="autoCubesTopMinus" class="btn btn-danger" type="button">-</button>
                  </div>
                  <span id="autoCubesTop" class="input-group-text col-8" style="background-color:#9B72EF">Cubes Top: 0</span>
                  <div class="input-group-append col-1">
                    <button id="autoCubesTopPlus" class="btn btn-success" type="button">+</button>
                  </div>
                </div>

                <div class="input-group mb-3 fw-bold">
                  <div class="input-group-prepend col-1">
                    <button id="autoCubesMiddleMinus" class="btn btn-danger" type="button">-</button>
                  </div>
                  <span id="autoCubesMiddle" class="input-group-text col-8" style="background-color:#9B72EF">Cubes Middle:
                    0</span>
                  <div class="input-group-append col-1">
                    <button id="autoCubesMiddlePlus" class="btn btn-success" type="button">+</button>
                  </div>
                </div>

                <div class="input-group mb-3 fw-bold">
                  <div class="input-group-prepend col-1">
                    <button id="autoCubesBottomMinus" class="btn btn-danger" type="button">-</button>
                  </div>
                  <span id="autoCubesBottom" class="input-group-text col-8" style="background-color:#9B72EF">Cubes Bottom:
                    0</span>
                  <div class="input-group-append col-1">
                    <button id="autoCubesBottomPlus" class="btn btn-success" type="button">+</button>
                  </div>
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
                  <div class="input-group-prepend col-1">
                    <button id="teleopConesTopMinus" class="btn btn-danger" type="button">-</button>
                  </div>
                  <span id="teleopConesTop" class="input-group-text col-8 bg-warning">Cones Top: 0</span>
                  <div class="input-group-append col-1">
                    <button id="teleopConesTopPlus" class="btn btn-success" type="button">+</button>
                  </div>
                </div>

                <div class="input-group mb-3 fw-bold">
                  <div class="input-group-prepend col-1">
                    <button id="teleopConesMiddleMinus" class="btn btn-danger" type="button">-</button>
                  </div>
                  <span id="teleopConesMiddle" class="input-group-text col-8 bg-warning">Cones Middle: 0</span>
                  <div class="input-group-append col-1">
                    <button id="teleopConesMiddlePlus" class="btn btn-success" type="button">+</button>
                  </div>
                </div>

                <div class="input-group mb-3 fw-bold">
                  <div class="input-group-prepend col-1">
                    <button id="teleopConesBottomMinus" class="btn btn-danger" type="button">-</button>
                  </div>
                  <span id="teleopConesBottom" class="input-group-text col-8 bg-warning">Cones Bottom: 0</span>
                  <div class="input-group-append col-1">
                    <button id="teleopConesBottomPlus" class="btn btn-success" type="button">+</button>
                  </div>
                </div>

                <!-- Cubes -->
                <div class="input-group mb-3 fw-bold">
                  <div class="input-group-prepend col-1">
                    <button id="teleopCubesTopMinus" class="btn btn-danger" type="button">-</button>
                  </div>
                  <span id="teleopCubesTop" class="input-group-text col-8" style="background-color:#9B72EF">Cubes
                    Top:
                    0</span>
                  <div class="input-group-append col-1">
                    <button id="teleopCubesTopPlus" class="btn btn-success" type="button">+</button>
                  </div>
                </div>

                <div class="input-group mb-3 fw-bold">
                  <div class="input-group-prepend col-1">
                    <button id="teleopCubesMiddleMinus" class="btn btn-danger" type="button">-</button>
                  </div>
                  <span id="teleopCubesMiddle" class="input-group-text col-8" style="background-color:#9B72EF">Cubes
                    Middle:
                    0</span>
                  <div class="input-group-append col-1">
                    <button id="teleopCubesMiddlePlus" class="btn btn-success" type="button">+</button>
                  </div>
                </div>

                <div class="input-group mb-3 fw-bold">
                  <div class="input-group-prepend col-1">
                    <button id="teleopCubesBottomMinus" class="btn btn-danger" type="button">-</button>
                  </div>
                  <span id="teleopCubesBottom" class="input-group-text col-8" style="background-color:#9B72EF">Cubes Bottom:
                    0</span>
                  <div class="input-group-append col-1">
                    <button id="teleopCubesBottomPlus" class="btn btn-success" type="button">+</button>
                  </div>
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

                <div class="row">
                  <div class="form-check form-check-inline mb-3">
                    <label for="endgamechargestation" class="form-check-label">Charge Station?</label>
                    <select id="endgamechargestation" class="form-select">
                      <option value="0">None</option>
                      <option value="1">Parked</option>
                      <option value="2">Docked</option>
                      <option value="3">Engaged</option>
                    </select>
                  </div>
                </div>

                <div class="row">
                  <div class="col-1">
                    <div class="form-check form-check-inline mb-3">
                      <label for="dead" class="form-check-label">Dead?</label>
                      <input id="dead" class="form-check-input" type="checkbox" name="dead">
                    </div>
                  </div>
                </div>

                <div class="row">
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

<?php include 'inc/footer.php'; ?>

<!-- Javascript page handlers -->

<script>

  // Clear all form fields
  function clearMatchForm(auton, teleop) {
    console.log("==> matchForm: clearMatchForm()");
    document.getElementById("compLevelQM").selected = true;
    document.getElementById("enterMatchNumber").value = "";
    document.getElementById("enterTeamNumber").value = "";
    document.getElementById("enterScoutName").value = "";
    auton.cones.bottom = 0;
    auton.cones.middle = 0;
    auton.cones.top = 0;
    auton.cubes.bottom = 0;
    auton.cubes.middle = 0;
    auton.cubes.top = 0;
    teleop.cones.bottom = 0;
    teleop.cones.middle = 0;
    teleop.cones.top = 0;
    teleop.cubes.bottom = 0;
    teleop.cubes.middle = 0;
    teleop.cubes.top = 0;
    document.getElementById("autoConesBottom").innerText = "Cones Bottom: " + auton.cones.bottom;
    document.getElementById("autoConesMiddle").innerText = "Cones Middle: " + auton.cones.middle;
    document.getElementById("autoConesTop").innerText = "Cones Top: " + auton.cones.top;
    document.getElementById("autoCubesBottom").innerText = "Cubes Bottom: " + auton.cubes.bottom;
    document.getElementById("autoCubesMiddle").innerText = "Cubes Middle: " + auton.cubes.middle;
    document.getElementById("autoCubesTop").innerText = "Cubes Top: " + auton.cubes.top;
    document.getElementById("teleopConesBottom").innerText = "Cones Bottom: " + teleop.cones.bottom;
    document.getElementById("teleopConesMiddle").innerText = "Cones Middle: " + teleop.cones.middle;
    document.getElementById("teleopConesTop").innerText = "Cones Top: " + teleop.cones.top;
    document.getElementById("teleopCubesBottom").innerText = "Cubes Bottom: " + teleop.cubes.bottom;
    document.getElementById("teleopCubesMiddle").innerText = "Cubes Middle: " + teleop.cubes.middle;
    document.getElementById("teleopCubesTop").innerText = "Cubes Top: " + teleop.cubes.top;
    document.getElementById("generalComment").innerText = "";
  }

  function validateMatchForm(auton, teleop) {
    console.log("==> matchForm: validateMatchForm()");
    let isError = false;
    let errMsg = "Please enter values for these fields:";
    let matchNumber = document.getElementById("enterMatchNumber").value.trim();
    let teamNum = document.getElementById("enterTeamNumber").value.trim();
    let scoutName = document.getElementById("enterScoutName").value.trim();

    // Make sure each piece of data has a value selected.
    if ((matchNumber === "") || isNaN(parseInt(matchNumber))) {
      if (isError)
        errMsg += ",";
      errMsg += " Match Number";
      isError = true;
    }

    if (((teamNum === "") || (validateTeamNumber(teamNum, null) <= 0))) {
      if (isError)
        errMsg += ",";
      errMsg += " Team Number";
      isError = true;
    }

    if (scoutName === "") {
      if (isError)
        errMsg += ",";
      errMsg += " Scout Name";
      isError = true;
    }

    if (isError) {
      alert(errMsg);
    }
    return isError;
  }

  // Retrieve the form data and prepare for submission
  function getMatchFormData(auton, teleop) {
    console.log("==> matchForm: getMatchFormData()");
    let dataToSave = {};
    let compLevel = document.getElementById("enterCompLevel").value;
    let matchNumber = document.getElementById("enterMatchNumber").value.trim();
    let teamNumber = document.getElementById("enterTeamNumber").value.trim();
    let scoutName = document.getElementById("enterScoutName").value.trim();

    dataToSave["matchnumber"] = compLevel + matchNumber;
    dataToSave["teamnumber"] = teamNumber;
    dataToSave["scoutname"] = scoutName;
    dataToSave["mobility"] = document.getElementById("exitCommunity").checked ? 1 : 0;
    dataToSave["autonconesbottom"] = auton.cones.bottom;
    dataToSave["autonconesmiddle"] = auton.cones.middle;
    dataToSave["autonconestop"] = auton.cones.top;
    dataToSave["autoncubesbottom"] = auton.cubes.bottom;
    dataToSave["autoncubesmiddle"] = auton.cubes.middle;
    dataToSave["autoncubestop"] = auton.cubes.bottom;
    dataToSave["autochargestation"] = document.getElementById("autochargestation").value;
    dataToSave["teleopconesbottom"] = teleop.cones.bottom;
    dataToSave["teleopconesmiddle"] = teleop.cones.middle;
    dataToSave["teleopconestop"] = teleop.cones.top;
    dataToSave["teleopcubesbottom"] = teleop.cubes.bottom;
    dataToSave["teleopcubesmiddle"] = teleop.cubes.middle;
    dataToSave["teleopcubestop"] = teleop.cubes.top;
    dataToSave["cubepickup"] = document.getElementById("pickedupCube").checked ? 1 : 0;
    dataToSave["uprightconepickup"] = document.getElementById("pickedupUprightCone").checked ? 1 : 0;
    dataToSave["tippedconepickup"] = document.getElementById("pickedupTippedCone").checked ? 1 : 0;
    dataToSave["endgamechargestation"] = document.getElementById("endgamechargestation").value;
    dataToSave["died"] = document.getElementById("dead").checked ? 1 : 0;
    dataToSave["comment"] = document.getElementById("generalComment").innerText;
    return dataToSave;
  }

  // Write the match data form to the DB table
  function submitMatchFormData(matchFormData) {
    console.log("==> matchForm: submitMatchFormData()");
    $.post("api/dbWriteAPI.php", {
      writeSingleData: JSON.stringify(matchFormData)
    }, function (response) {
      if (response.indexOf('success') > -1) {    // A loose compare, because success word may have a newline
        alert("Success in submitting Match data! Clearing Data.");
        clearMatchForm();
      } else {
        alert("Failure in submitting Match Form! Please Check network connectivity.");
      }
    });
  }

  // Create button event listeners to process form input
  function attachButtonListeners(auton, teleop) {
    console.log("=> matchForm: attachButtonListeners()");

    // Auto cones
    document.getElementById("autoConesBottomPlus").addEventListener('click', function () {
      auton.cones.bottom += 1;
      document.getElementById("autoConesBottom").innerText = "Cones Bottom: " + auton.cones.bottom;
    });

    document.getElementById("autoConesBottomMinus").addEventListener('click', function () {
      auton.cones.bottom = Math.max(auton.cones.bottom - 1, 0);
      document.getElementById("autoConesBottom").innerText = "Cones Bottom: " + auton.cones.bottom;
    });

    document.getElementById("autoConesMiddlePlus").addEventListener('click', function () {
      auton.cones.middle += 1;
      document.getElementById("autoConesMiddle").innerText = "Cones Middle: " + auton.cones.middle;
    });

    document.getElementById("autoConesMiddleMinus").addEventListener('click', function () {
      auton.cones.middle = Math.max(auton.cones.middle - 1, 0);
      document.getElementById("autoConesMiddle").innerText = "Cones Middle: " + auton.cones.middle;
    });

    document.getElementById("autoConesTopPlus").addEventListener('click', function () {
      auton.cones.top += 1;
      document.getElementById("autoConesTop").innerText = "Cones Top: " + auton.cones.top;
    });

    document.getElementById("autoConesTopMinus").addEventListener('click', function () {
      auton.cones.top = Math.max(auton.cones.top - 1, 0);
      document.getElementById("autoConesTop").innerText = "Cones Top: " + auton.cones.top;
    });

    // Auto cubes
    document.getElementById("autoCubesBottomPlus").addEventListener('click', function () {
      auton.cubes.bottom += 1;
      document.getElementById("autoCubesBottom").innerText = "Cubes Bottom: " + auton.cubes.bottom;
    });

    document.getElementById("autoCubesBottomMinus").addEventListener('click', function () {
      auton.cubes.bottom = Math.max(auton.cubes.bottom - 1, 0);
      document.getElementById("autoCubesBottom").innerText = "Cubes Bottom: " + auton.cubes.bottom;
    });

    document.getElementById("autoCubesMiddlePlus").addEventListener('click', function () {
      auton.cubes.middle += 1;
      document.getElementById("autoCubesMiddle").innerText = "Cubes Middle: " + auton.cubes.middle;
    });

    document.getElementById("autoCubesMiddleMinus").addEventListener('click', function () {
      auton.cubes.middle = Math.max(auton.cubes.middle - 1, 0);
      document.getElementById("autoCubesMiddle").innerText = "Cubes Middle: " + auton.cubes.middle;
    });

    document.getElementById("autoCubesTopPlus").addEventListener('click', function () {
      auton.cubes.top += 1;
      document.getElementById("autoCubesTop").innerText = "Cubes Top: " + auton.cubes.top;
    });

    document.getElementById("autoCubesTopMinus").addEventListener('click', function () {
      auton.cubes.top = Math.max(auton.cubes.top - 1, 0);
      document.getElementById("autoCubesTop").innerText = "Cubes Top: " + auton.cubes.top;
    });

    // Teleop cones
    document.getElementById("teleopConesBottomPlus").addEventListener('click', function () {
      teleop.cones.bottom += 1;
      document.getElementById("teleopConesBottom").innerText = "Cones Bottom: " + teleop.cones.bottom;
    });

    document.getElementById("teleopConesBottomMinus").addEventListener('click', function () {
      teleop.cones.bottom = Math.max(teleop.cones.bottom - 1, 0);
      document.getElementById("teleopConesBottom").innerText = "Cones Bottom: " + teleop.cones.bottom;
    });

    document.getElementById("teleopConesMiddlePlus").addEventListener('click', function () {
      teleop.cones.middle += 1;
      document.getElementById("teleopConesMiddle").innerText = "Cones Middle: " + teleop.cones.middle;
    });

    document.getElementById("teleopConesMiddleMinus").addEventListener('click', function () {
      teleop.cones.middle = Math.max(teleop.cones.middle - 1, 0);
      document.getElementById("teleopConesMiddle").innerText = "Cones Middle: " + teleop.cones.middle;
    });

    document.getElementById("teleopConesTopPlus").addEventListener('click', function () {
      teleop.cones.top += 1;
      document.getElementById("teleopConesTop").innerText = "Cones Top: " + teleop.cones.top;
    });

    document.getElementById("teleopConesTopMinus").addEventListener('click', function () {
      teleop.cones.top = Math.max(teleop.cones.top - 1, 0);
      document.getElementById("teleopConesTop").innerText = "Cones Top: " + teleop.cones.top;
    });

    // Teleop cubes
    document.getElementById("teleopCubesBottomPlus").addEventListener('click', function () {
      teleop.cubes.bottom += 1;
      document.getElementById("teleopCubesBottom").innerText = "Cubes Bottom: " + teleop.cubes.bottom;
    });

    document.getElementById("teleopCubesBottomMinus").addEventListener('click', function () {
      teleop.cubes.bottom = Math.max(teleop.cubes.bottom - 1, 0);
      document.getElementById("teleopCubesBottom").innerText = "Cubes Bottom: " + teleop.cubes.bottom;
    });

    document.getElementById("teleopCubesMiddlePlus").addEventListener('click', function () {
      teleop.cubes.middle += 1;
      document.getElementById("teleopCubesMiddle").innerText = "Cubes Middle: " + teleop.cubes.middle;
    });

    document.getElementById("teleopCubesMiddleMinus").addEventListener('click', function () {
      teleop.cubes.middle = Math.max(teleop.cubes.middle - 1, 0);
      document.getElementById("teleopCubesMiddle").innerText = "Cubes Middle: " + teleop.cubes.middle;
    });

    document.getElementById("teleopCubesTopPlus").addEventListener('click', function () {
      teleop.cubes.top += 1;
      document.getElementById("teleopCubesTop").innerText = "Cubes Top: " + teleop.cubes.top;
    });

    document.getElementById("teleopCubesTopMinus").addEventListener('click', function () {
      teleop.cubes.top = Math.max(teleop.cubes.top - 1, 0);
      document.getElementById("teleopCubesTop").innerText = "Cubes Top: " + teleop.cubes.top;
    });

  }

  /////////////////////////////////////////////////////////////////////////////
  //
  // Process the generated html
  //
  document.addEventListener("DOMContentLoaded", function () {

    const auton = {
      cones: { bottom: 0, middle: 0, top: 0 },
      cubes: { bottom: 0, middle: 0, top: 0 }
    };
    const teleop = {
      cones: { bottom: 0, middle: 0, top: 0 },
      cubes: { bottom: 0, middle: 0, top: 0 }
    };

    attachButtonListeners(auton, teleop);

    // Submit the match data form 
    document.getElementById("submitForm").addEventListener('click', function () {
      if (!validateMatchForm(auton, teleop)) {
        matchFormData = getMatchFormData(auton, teleop);
        alert("This match form is NOT configured for 2025 game!");
        //    submitMatchFormData(matchFormData);
      }
    });
  });
</script>

<script src="./scripts/validateTeamNumber.js"></script>
