<?php
$title = 'Match Scouting Form - REEFSCAPE';
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
              <h4>Match Info</h4>
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
              <label for="selectScoutName" class="form-label">Scout Name</label>
              <select id="selectScoutName" class="form-select mb-3" onchange="showScoutInputBox(this.value)"
                aria-label="selectScoutName">
                <option selected>Choose ...</option>
              </select>
              <div id="otherDiv" class="mb-3" style="display:none;">
                <input id="otherScoutName" class="form-control" type="text" placeholder="First name, last initial">
              </div>

            </div>

            <!-- Autonomous Mode -->
            <div class="card mb-3 bg-success-subtle">
              <div class="card-header fw-bold">
                Autonomous Mode
              </div>

              <div class="card-body">
                <!-- Checkboxes -->
                <div class="form-check form-check-inline mb-3">
                  <input id="leaveStartLine" class="form-check-input" type="checkbox" name="leaveStartLine">
                  <label for=" leaveStartLine" class=" form-check-label">Leave Start Line?</label>
                </div>

                <!-- Coral -->
                <div class="input-group mb-3 fw-bold">
                  <div class="input-group-prepend col-1">
                    <button id="autonCoralL4Minus" class="btn btn-danger" type="button">-</button>
                  </div>
                  <span id="autonCoralL4" class="input-group-text col-8" style="background-color:#CE649B">Coral Level 4: 0</span>
                  <div class="input-group-append col-1">
                    <button id="autonCoralL4Plus" class="btn btn-success" type="button">+</button>
                  </div>
                </div>

                <div class="input-group mb-3 fw-bold">
                  <div class="input-group-prepend col-1">
                    <button id="autonCoralL3Minus" class="btn btn-danger" type="button">-</button>
                  </div>
                  <span id="autonCoralL3" class="input-group-text col-8" style="background-color:#CE649B">Coral Level 3: 0</span>
                  <div class="input-group-append col-1">
                    <button id="autonCoralL3Plus" class="btn btn-success" type="button">+</button>
                  </div>
                </div>

                <div class="input-group mb-3 fw-bold">
                  <div class="input-group-prepend col-1">
                    <button id="autonCoralL2Minus" class="btn btn-danger" type="button">-</button>
                  </div>
                  <span id="autonCoralL2" class="input-group-text col-8" style="background-color:#CE649B">Coral Level 2: 0</span>
                  <div class="input-group-append col-1">
                    <button id="autonCoralL2Plus" class="btn btn-success" type="button">+</button>
                  </div>
                </div>

                <div class="input-group mb-3 fw-bold">
                  <div class="input-group-prepend col-1">
                    <button id="autonCoralL1Minus" class="btn btn-danger" type="button">-</button>
                  </div>
                  <span id="autonCoralL1" class="input-group-text col-8" style="background-color:#CE649B">Coral Level 1: 0</span>
                  <div class="input-group-append col-1">
                    <button id="autonCoralL1Plus" class="btn btn-success" type="button">+</button>
                  </div>
                </div>

                <!-- Algae -->
                <div class="input-group mb-3 fw-bold">
                  <div class="input-group-prepend col-1">
                    <button id="autonAlgaeNetMinus" class="btn btn-danger" type="button">-</button>
                  </div>
                  <span id="autonAlgaeNet" class="input-group-text col-8" style="background-color:#76D1AE">Algae Net: 0</span>
                  <div class="input-group-append col-1">
                    <button id="autonAlgaeNetPlus" class="btn btn-success" type="button">+</button>
                  </div>
                </div>

                <div class="input-group mb-3 fw-bold">
                  <div class="input-group-prepend col-1">
                    <button id="autonAlgaeProcMinus" class="btn btn-danger" type="button">-</button>
                  </div>
                  <span id="autonAlgaeProc" class="input-group-text col-8" style="background-color:#76D1AE">Algae Processor:
                    0</span>
                  <div class="input-group-append col-1">
                    <button id="autonAlgaeProcPlus" class="btn btn-success" type="button">+</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- end Autonomous Mode -->

            <!-- Telop Mode -->
            <div class="card mb-3 bg-primary-subtle">
              <div class="card-header fw-bold">
                Teleop Mode
              </div>
              <div class="card-body">

                <!-- Coral -->
                <div class="input-group mb-3 fw-bold">
                  <div class="input-group-prepend col-1">
                    <button id="teleopCoralL4Minus" class="btn btn-danger" type="button">-</button>
                  </div>
                  <span id="teleopCoralL4" class="input-group-text col-8" style="background-color:#CE649B">Coral Level 4: 0</span>
                  <div class="input-group-append col-1">
                    <button id="teleopCoralL4Plus" class="btn btn-success" type="button">+</button>
                  </div>
                </div>

                <div class="input-group mb-3 fw-bold">
                  <div class="input-group-prepend col-1">
                    <button id="teleopCoralL3Minus" class="btn btn-danger" type="button">-</button>
                  </div>
                  <span id="teleopCoralL3" class="input-group-text col-8" style="background-color:#CE649B">Coral Level 3:
                    0</span>
                  <div class="input-group-append col-1">
                    <button id="teleopCoralL3Plus" class="btn btn-success" type="button">+</button>
                  </div>
                </div>

                <div class="input-group mb-3 fw-bold">
                  <div class="input-group-prepend col-1">
                    <button id="teleopCoralL2Minus" class="btn btn-danger" type="button">-</button>
                  </div>
                  <span id="teleopCoralL2" class="input-group-text col-8" style="background-color:#CE649B">Coral Level 2:
                    0</span>
                  <div class="input-group-append col-1">
                    <button id="teleopCoralL2Plus" class="btn btn-success" type="button">+</button>
                  </div>
                </div>

                <div class="input-group mb-3 fw-bold">
                  <div class="input-group-prepend col-1">
                    <button id="teleopCoralL1Minus" class="btn btn-danger" type="button">-</button>
                  </div>
                  <span id="teleopCoralL1" class="input-group-text col-8" style="background-color:#CE649B">Coral Level 1: 0</span>
                  <div class="input-group-append col-1">
                    <button id="teleopCoralL1Plus" class="btn btn-success" type="button">+</button>
                  </div>
                </div>

                <!-- Algae -->
                <div class="input-group mb-3 fw-bold">
                  <div class="input-group-prepend col-1">
                    <button id="teleopAlgaeNetMinus" class="btn btn-danger" type="button">-</button>
                  </div>
                  <span id="teleopAlgaeNet" class="input-group-text col-8" style="background-color:#76D1AE">Algae Net: 0</span>
                  <div class="input-group-append col-1">
                    <button id="teleopAlgaeNetPlus" class="btn btn-success" type="button">+</button>
                  </div>
                </div>

                <div class="input-group mb-3 fw-bold">
                  <div class="input-group-prepend col-1">
                    <button id="teleopAlgaeProcMinus" class="btn btn-danger" type="button">-</button>
                  </div>
                  <span id="teleopAlgaeProc" class="input-group-text col-8" style="background-color:#76D1AE">Algae Processor:
                    0</span>
                  <div class="input-group-append col-1">
                    <button id="teleopAlgaeProcPlus" class="btn btn-success" type="button">+</button>
                  </div>
                </div>

              </div>
            </div>
            <!-- end Teleop Mode -->

            <!-- End Game -->
            <div class="card mb-3 bg-warning-subtle">
              <div class="card-header fw-bold">
                End Game
              </div>

              <div class="card-body">

                <div class="row">
                  <div class="form-check form-check-inline mb-3">
                    <label for="endGameClimb" class="form-check-label">Barge Climb?</label>
                    <select id="endGameClimb" class="form-select">
                      <option id="endGameClimbNA" value="0">No Attempt</option>
                      <option id="endGameClimbFell" value="1">Fell</option>
                      <option id="endGameClimbParked" value="2">Parked</option>
                      <option id="endGameClimbShallow" value="3">Shallow Climb</option>
                      <option id="endGameClimbDeep" value="4">Deep Climb</option>
                    </select>
                  </div>
                </div>

                <div class="row">
                  <div class="col-1">
                    <div class="form-check form-check-inline mb-3">
                      <label for="robotDied" class="form-check-label">Died?</label>
                      <input id="robotDied" class="form-check-input" type="checkbox" name="robotDied">
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

  //
  // Clear all form fields
  //
  function clearMatchForm(auton, teleop) {
    console.log("==> matchForm: clearMatchForm()");
    document.getElementById("compLevelQM").selected = true;
    document.getElementById("enterMatchNumber").value = "";
    document.getElementById("enterTeamNumber").value = "";
    document.getElementById("selectScoutName").value = "Choose ...";
    document.getElementById("otherScoutName").value = "";

    auton.coral.l4 = 0;
    auton.coral.l3 = 0;
    auton.coral.l2 = 0;
    auton.coral.l1 = 0;
    auton.algae.net = 0;
    auton.algae.processor = 0;

    teleop.coral.l4 = 0;
    teleop.coral.l3 = 0;
    teleop.coral.l2 = 0;
    teleop.coral.l1 = 0;
    teleop.algae.net = 0;
    teleop.algae.processor = 0;

    document.getElementById("autonCoralL4").innerText = "Coral Level 4: " + auton.coral.l4;
    document.getElementById("autonCoralL3").innerText = "Coral Level 3: " + auton.coral.l3;
    document.getElementById("autonCoralL2").innerText = "Coral Level 2: " + auton.coral.l2
    document.getElementById("autonCoralL1").innerText = "Coral Level 1: " + auton.coral.l1;
    document.getElementById("autonAlgaeNet").innerText = "Algae Net: " + auton.algae.net;
    document.getElementById("autonAlgaeProc").innerText = "Algae Processor: " + auton.algae.processor;

    document.getElementById("teleopCoralL4").innerText = "Coral Level 4: " + teleop.coral.l4;
    document.getElementById("teleopCoralL3").innerText = "Coral Level 3: " + teleop.coral.l3;
    document.getElementById("teleopCoralL2").innerText = "Coral Level 2: " + teleop.coral.l2
    document.getElementById("teleopCoralL1").innerText = "Coral Level 1: " + teleop.coral.l1;
    document.getElementById("teleopAlgaeNet").innerText = "Algae Net: " + teleop.algae.net;
    document.getElementById("teleopAlgaeProc").innerText = "Algae Processor: " + teleop.algae.processor;

    document.getElementById("endGameClimbNA").selected = true;
    document.getElementById("robotDied").checked = false;
    document.getElementById("generalComment").innerText = "";
  }

  //
  // Show scout name text entry box
  //
  function showScoutInputBox(value) {
    document.getElementById('otherDiv').style.display = value === 'Other' ? 'block' : 'none';
  }

  // Get scout name - return empty string if not a valid selection or empty text box
  function getScoutName() {
    let scoutName = document.getElementById("selectScoutName").value.trim();

    if (scoutName === "Choose ...")
      scoutName = "";
    else if (scoutName === "Other") {
      scoutName = document.getElementById("otherScoutName").value.trim();
      scoutName.replace(' ', '_');
    }
    return scoutName;
  }
  //
  // Validate that all required fields have been entered  
  //
  function validateMatchForm(auton, teleop) {
    console.log("==> matchForm: validateMatchForm()");
    let isError = false;
    let errMsg = "Please enter values for these fields:";
    let matchNumber = document.getElementById("enterMatchNumber").value.trim();
    let teamNum = document.getElementById("enterTeamNumber").value.toUpperCase().trim();
    let scoutName = getScoutName();

    // Make sure each piece of data has a value selected.
    if ((matchNumber === "") || isNaN(parseInt(matchNumber))) {
      if (isError)
        errMsg += ",";
      errMsg += " Match Number";
      isError = true;
    }

    if (validateTeamNumber(teamNum, null) <= 0) {
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

  //
  // Retrieve the form data and prepare for submission
  //
  function getMatchFormData(auton, teleop) {
    console.log("==> matchForm: getMatchFormData()");
    let dataToSave = {};
    let compLevel = document.getElementById("enterCompLevel").value;
    let matchNumber = document.getElementById("enterMatchNumber").value.trim();
    let teamNumber = document.getElementById("enterTeamNumber").value.toUpperCase().trim();
    let scoutName = getScoutName();

    dataToSave["matchnumber"] = compLevel + matchNumber;
    dataToSave["teamnumber"] = teamNumber;
    dataToSave["scoutname"] = getScoutName();
    dataToSave["autonLeave"] = document.getElementById("leaveStartLine").checked ? 1 : 0;
    dataToSave["autonCoralL4"] = auton.coral.l4;
    dataToSave["autonCoralL3"] = auton.coral.l3;
    dataToSave["autonCoralL2"] = auton.coral.l2;
    dataToSave["autonCoralL1"] = auton.coral.l1;
    dataToSave["autonAlgaeNet"] = auton.algae.net;
    dataToSave["autonAlgaeProc"] = auton.algae.processor;

    dataToSave["teleopCoralL4"] = teleop.coral.l4;
    dataToSave["teleopCoralL3"] = teleop.coral.l3;
    dataToSave["teleopCoralL2"] = teleop.coral.l2;
    dataToSave["teleopCoralL1"] = teleop.coral.l1;
    dataToSave["teleopAlgaeNet"] = teleop.algae.net;
    dataToSave["teleopAlgaeProc"] = teleop.algae.processor;

    dataToSave["endgameCageClimb"] = document.getElementById("endGameClimb").value;
    dataToSave["died"] = document.getElementById("robotDied").checked ? 1 : 0;
    dataToSave["comment"] = document.getElementById("generalComment").innerText;
    return dataToSave;
  }

  //
  // Write the match data form to the DB table
  //
  function submitMatchFormData(matchFormData) {
    console.log("==> matchForm: submitMatchFormData()");
    $.post("api/dbWriteAPI.php", {
      writeSingleMatch: JSON.stringify(matchFormData)
    }, function (response) {
      if (response.indexOf('success') > -1) {    // A loose compare, because success word may have a newline
        alert("Success in submitting Match data! Clearing Data.");
        clearMatchForm();
      } else {
        alert("Failure in submitting Match Form! Please Check network connectivity.");
      }
    });
  }

  //
  // Create button event listeners to process form input
  //
  function attachButtonListeners(auton, teleop) {
    console.log("=> matchForm: attachButtonListeners()");

    // Auto coral
    document.getElementById("autonCoralL4Plus").addEventListener('click', function () {
      auton.coral.l4 += 1;
      document.getElementById("autonCoralL4").innerText = "Coral Level 4: " + auton.coral.l4;
    });

    document.getElementById("autonCoralL4Minus").addEventListener('click', function () {
      auton.coral.l4 = Math.max(auton.coral.l4 - 1, 0);
      document.getElementById("autonCoralL4").innerText = "Coral Level 4: " + auton.coral.l4;
    });

    document.getElementById("autonCoralL3Plus").addEventListener('click', function () {
      auton.coral.l3 += 1;
      document.getElementById("autonCoralL3").innerText = "Coral Level 3: " + auton.coral.l3;
    });

    document.getElementById("autonCoralL3Minus").addEventListener('click', function () {
      auton.coral.l3 = Math.max(auton.coral.l3 - 1, 0);
      document.getElementById("autonCoralL3").innerText = "Coral Level 3: " + auton.coral.l3;
    });

    document.getElementById("autonCoralL2Plus").addEventListener('click', function () {
      auton.coral.l2 += 1;
      document.getElementById("autonCoralL2").innerText = "Coral Level 2: " + auton.coral.l2
    });

    document.getElementById("autonCoralL2Minus").addEventListener('click', function () {
      auton.coral.l2 = Math.max(auton.coral.l2 - 1, 0);
      document.getElementById("autonCoralL2").innerText = "Coral Level 2: " + auton.coral.l2
    });

    document.getElementById("autonCoralL1Plus").addEventListener('click', function () {
      auton.coral.l1 += 1;
      document.getElementById("autonCoralL1").innerText = "Coral Level 1: " + auton.coral.l1;
    });

    document.getElementById("autonCoralL1Minus").addEventListener('click', function () {
      auton.coral.l1 = Math.max(auton.coral.l1 - 1, 0);
      document.getElementById("autonCoralL1").innerText = "Coral Level 1: " + auton.coral.l1;
    });

    // Auto algae
    document.getElementById("autonAlgaeProcPlus").addEventListener('click', function () {
      auton.algae.processor += 1;
      document.getElementById("autonAlgaeProc").innerText = "Algae Processor: " + auton.algae.processor;
    });

    document.getElementById("autonAlgaeProcMinus").addEventListener('click', function () {
      auton.algae.processor = Math.max(auton.algae.processor - 1, 0);
      document.getElementById("autonAlgaeProc").innerText = "Algae Processor: " + auton.algae.processor;
    });

    document.getElementById("autonAlgaeNetPlus").addEventListener('click', function () {
      auton.algae.net += 1;
      document.getElementById("autonAlgaeNet").innerText = "Algae Net: " + auton.algae.net;
    });

    document.getElementById("autonAlgaeNetMinus").addEventListener('click', function () {
      auton.algae.net = Math.max(auton.algae.net - 1, 0);
      document.getElementById("autonAlgaeNet").innerText = "Algae Net: " + auton.algae.net;
    });

    // Teleop coral
    document.getElementById("teleopCoralL4Plus").addEventListener('click', function () {
      teleop.coral.l4 += 1;
      document.getElementById("teleopCoralL4").innerText = "Coral Level 4: " + teleop.coral.l4;
    });

    document.getElementById("teleopCoralL4Minus").addEventListener('click', function () {
      teleop.coral.l4 = Math.max(teleop.coral.l4 - 1, 0);
      document.getElementById("teleopCoralL4").innerText = "Coral Level 4: " + teleop.coral.l4;
    });

    document.getElementById("teleopCoralL3Plus").addEventListener('click', function () {
      teleop.coral.l3 += 1;
      document.getElementById("teleopCoralL3").innerText = "Coral Level 3: " + teleop.coral.l3;
    });

    document.getElementById("teleopCoralL3Minus").addEventListener('click', function () {
      teleop.coral.l3 = Math.max(teleop.coral.l3 - 1, 0);
      document.getElementById("teleopCoralL3").innerText = "Coral Level 3: " + teleop.coral.l3;
    });

    document.getElementById("teleopCoralL2Plus").addEventListener('click', function () {
      teleop.coral.l2 += 1;
      document.getElementById("teleopCoralL2").innerText = "Coral Level 2: " + teleop.coral.l2
    });

    document.getElementById("teleopCoralL2Minus").addEventListener('click', function () {
      teleop.coral.l2 = Math.max(teleop.coral.l2 - 1, 0);
      document.getElementById("teleopCoralL2").innerText = "Coral Level 2: " + teleop.coral.l2
    });

    document.getElementById("teleopCoralL1Plus").addEventListener('click', function () {
      teleop.coral.l1 += 1;
      document.getElementById("teleopCoralL1").innerText = "Coral Level 1: " + teleop.coral.l1;
    });

    document.getElementById("teleopCoralL1Minus").addEventListener('click', function () {
      teleop.coral.l1 = Math.max(teleop.coral.l1 - 1, 0);
      document.getElementById("teleopCoralL1").innerText = "Coral Level 1: " + teleop.coral.l1;
    });

    // Teleop algae
    document.getElementById("teleopAlgaeProcPlus").addEventListener('click', function () {
      teleop.algae.processor += 1;
      document.getElementById("teleopAlgaeProc").innerText = "Algae Processor: " + teleop.algae.processor;
    });

    document.getElementById("teleopAlgaeProcMinus").addEventListener('click', function () {
      teleop.algae.processor = Math.max(teleop.algae.processor - 1, 0);
      document.getElementById("teleopAlgaeProc").innerText = "Algae Processor: " + teleop.algae.processor;
    });

    document.getElementById("teleopAlgaeNetPlus").addEventListener('click', function () {
      teleop.algae.net += 1;
      document.getElementById("teleopAlgaeNet").innerText = "Algae Net: " + teleop.algae.net;
    });

    document.getElementById("teleopAlgaeNetMinus").addEventListener('click', function () {
      teleop.algae.net = Math.max(teleop.algae.net - 1, 0);
      document.getElementById("teleopAlgaeNet").innerText = "Algae Net: " + teleop.algae.net;
    });

  }

  /////////////////////////////////////////////////////////////////////////////
  //
  // Process the generated html
  //
  document.addEventListener("DOMContentLoaded", function () {

    const auton = {
      coral: { l1: 0, l2: 0, l3: 0, l4: 0 },
      algae: { processor: 0, net: 0 }
    };
    const teleop = {
      coral: { l1: 0, l2: 0, l3: 0, l4: 0 },
      algae: { processor: 0, net: 0 }
    };

    attachButtonListeners(auton, teleop);

    // Read scout names from database for this event
    $.get("api/dbReadAPI.php", {
      getEventScoutNames: true
    }).done(function (eventScoutNames) {
      console.log("=> getEventScoutNames");
      let scoutSelect = document.getElementById("selectScoutName");
      let jsonNames = JSON.parse(eventScoutNames);
      for (let name of jsonNames) {
        let option = document.createElement('option');
        option.value = name["scoutname"];
        option.innerHTML = name["scoutname"];
        scoutSelect.appendChild(option);
      };
      let other = document.createElement('option');
      other.value = "Other";
      other.innerHTML = "Other";
      scoutSelect.appendChild(other);
    });

    // Submit the match data form 
    document.getElementById("submitForm").addEventListener('click', function () {
      if (!validateMatchForm(auton, teleop)) {
        matchFormData = getMatchFormData(auton, teleop);
        alert("This match form is NOT yet tested to save data for the 2025 game!");
        //    submitMatchFormData(matchFormData);
      }
    });
  });

</script>

<script src="./scripts/validateTeamNumber.js"></script>
