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
              <h4>Match Info</h4>
            </div>
            <div class="col-5 mb-3">
              <label for="teamNumber" class="form-label">Team Number</label>
              <input id="teamNumber" class="form-control" type="number" placeholder="FRC team number">
            </div>
            <div class="row col-8 mb-3">
              <span>Match Number</span>
              <div class="input-group">
                <div class="input-group-prepend">
                  <select id="compLevel" class="form-select" aria-label="Comp Level Select">
                    <option value="p">P</option>
                    <option value="qm" selected>QM</option>
                    <option value="qf">QF</option>
                    <option value="sf">SF</option>
                    <option value="f">F</option>
                  </select>
                </div>
                <input id="matchNumber" class="form-control" type="text" placeholder="Match Number" aria-label="Match Number">
              </div>
            </div>
            <div class="col-6 mb-3">
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
                  <div class="input-group-prepend col-1">
                    <button id="autoConesTopMinus" class="btn btn-danger" type="button">-</button>
                  </div>
                  <span id="autoConesTop" class="input-group-text col-8 bg-warning">Auto Cones Top: 0</span>
                  <div class="input-group-append col-1">
                    <button id="autoConesTopPlus" class="btn btn-success" type="button">+</button>
                  </div>
                </div>

                <div class="input-group mb-3 fw-bold">
                  <div class="input-group-prepend col-1">
                    <button id="autoConesMiddleMinus" class="btn btn-danger" type="button">-</button>
                  </div>
                  <span id="autoConesMiddle" class="input-group-text col-8 bg-warning">Auto Cones Middle: 0</span>
                  <div class="input-group-append col-1">
                    <button id="autoConesMiddlePlus" class="btn btn-success" type="button">+</button>
                  </div>
                </div>

                <div class="input-group mb-3 fw-bold">
                  <div class="input-group-prepend col-1">
                    <button id="autoConesBottomMinus" class="btn btn-danger" type="button">-</button>
                  </div>
                  <span id="autoConesBottom" class="input-group-text col-8 bg-warning">Auto Cones Bottom: 0</span>
                  <div class="input-group-append col-1">
                    <button id="autoConesBottomPlus" class="btn btn-success" type="button">+</button>
                  </div>
                </div>

                <!-- Cubes -->
                <div class="input-group mb-3 fw-bold">
                  <div class="input-group-prepend col-1">
                    <button id="autoCubesTopMinus" class="btn btn-danger" type="button">-</button>
                  </div>
                  <span id="autoCubesTop" class="input-group-text col-8" style="background-color:#9B72EF">Auto Cubes Top: 0</span>
                  <div class="input-group-append col-1">
                    <button id="autoCubesTopPlus" class="btn btn-success" type="button">+</button>
                  </div>
                </div>

                <div class="input-group mb-3 fw-bold">
                  <div class="input-group-prepend col-1">
                    <button id="autoCubesMiddleMinus" class="btn btn-danger" type="button">-</button>
                  </div>
                  <span id="autoCubesMiddle" class="input-group-text col-8" style="background-color:#9B72EF">Auto Cubes Middle:
                    0</span>
                  <div class="input-group-append col-1">
                    <button id="autoCubesMiddlePlus" class="btn btn-success" type="button">+</button>
                  </div>
                </div>

                <div class="input-group mb-3 fw-bold">
                  <div class="input-group-prepend col-1">
                    <button id="autoCubesBottomMinus" class="btn btn-danger" type="button">-</button>
                  </div>
                  <span id="autoCubesBottom" class="input-group-text col-8" style="background-color:#9B72EF">Auto Cubes Bottom:
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
                  <span id="teleopConesTop" class="input-group-text col-8 bg-warning">Teleop Cones Top: 0</span>
                  <div class="input-group-append col-1">
                    <button id="teleopConesTopPlus" class="btn btn-success" type="button">+</button>
                  </div>
                </div>

                <div class="input-group mb-3 fw-bold">
                  <div class="input-group-prepend col-1">
                    <button id="teleopConesMiddleMinus" class="btn btn-danger" type="button">-</button>
                  </div>
                  <span id="teleopConesMiddle" class="input-group-text col-8 bg-warning">Teleop Cones Middle: 0</span>
                  <div class="input-group-append col-1">
                    <button id="teleopConesMiddlePlus" class="btn btn-success" type="button">+</button>
                  </div>
                </div>

                <div class="input-group mb-3 fw-bold">
                  <div class="input-group-prepend col-1">
                    <button id="teleopConesBottomMinus" class="btn btn-danger" type="button">-</button>
                  </div>
                  <span id="teleopConesBottom" class="input-group-text col-8 bg-warning">Teleop Cones Bottom: 0</span>
                  <div class="input-group-append col-1">
                    <button id="teleopConesBottomPlus" class="btn btn-success" type="button">+</button>
                  </div>
                </div>

                <!-- Cubes -->
                <div class="input-group mb-3 fw-bold">
                  <div class="input-group-prepend col-1">
                    <button id="teleopCubesTopMinus" class="btn btn-danger" type="button">-</button>
                  </div>
                  <span id="teleopCubesTop" class="input-group-text col-8" style="background-color:#9B72EF">Teleop Cubes
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
                  <span id="teleopCubesMiddle" class="input-group-text col-8" style="background-color:#9B72EF">Teleop Cubes
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
                  <span id="teleopCubesBottom" class="input-group-text col-8" style="background-color:#9B72EF">Teleop Cubes Bottom:
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

  // Create button event linkages
  function attachFormButtons(auto, teleop) {
    console.log("=> matchForm: attachFormButtons()");
    // Auto cones
    $("#autoConesBottomPlus").click(function () {
      auto.cones.bottom += 1;
      $("#autoConesBottom").html("Auto Cones Bottom: " + auto.cones.bottom);
    });

    $("#autoConesBottomMinus").click(function () {
      auto.cones.bottom = Math.max(auto.cones.bottom - 1, 0);
      $("#autoConesBottom").html("Auto Cones Bottom: " + auto.cones.bottom);
    });

    $("#autoConesMiddlePlus").click(function () {
      auto.cones.middle += 1;
      $("#autoConesMiddle").html("Auto Cones Middle: " + auto.cones.middle);
    });

    $("#autoConesMiddleMinus").click(function () {
      auto.cones.middle = Math.max(auto.cones.middle - 1, 0);
      $("#autoConesMiddle").html("Auto Cones Middle: " + auto.cones.middle);
    });

    $("#autoConesTopPlus").click(function () {
      auto.cones.top += 1;
      $("#autoConesTop").html("Auto Cones Top: " + auto.cones.top);
    });

    $("#autoConesTopMinus").click(function () {
      auto.cones.top = Math.max(auto.cones.top - 1, 0);
      $("#autoConesTop").html("Auto Cones Top: " + auto.cones.top);
    });

    // Auto cubes
    $("#autoCubesBottomPlus").click(function () {
      auto.cubes.bottom += 1;
      $("#autoCubesBottom").html("Auto Cubes Bottom: " + auto.cubes.bottom);
    });

    $("#autoCubesBottomMinus").click(function () {
      auto.cubes.bottom = Math.max(auto.cubes.bottom - 1, 0);
      $("#autoCubesBottom").html("Auto Cubes Bottom: " + auto.cubes.bottom);
    });

    $("#autoCubesMiddlePlus").click(function () {
      auto.cubes.middle += 1;
      $("#autoCubesMiddle").html("Auto Cubes Middle: " + auto.cubes.middle);
    });

    $("#autoCubesMiddleMinus").click(function () {
      auto.cubes.middle = Math.max(auto.cubes.middle - 1, 0);
      $("#autoCubesMiddle").html("Auto Cubes Middle: " + auto.cubes.middle);
    });

    $("#autoCubesTopPlus").click(function () {
      auto.cubes.top += 1;
      $("#autoCubesTop").html("Auto Cubes Top: " + auto.cubes.top);
    });

    $("#autoCubesTopMinus").click(function () {
      auto.cubes.top = Math.max(auto.cubes.top - 1, 0);
      $("#autoCubesTop").html("Auto Cubes Top: " + auto.cubes.top);
    });

    // Teleop cones
    $("#teleopConesBottomPlus").click(function () {
      teleop.cones.bottom += 1;
      $("#teleopConesBottom").html("Teleop Cones Bottom: " + teleop.cones.bottom);
    });

    $("#teleopConesBottomMinus").click(function () {
      teleop.cones.bottom = Math.max(teleop.cones.bottom - 1, 0);
      $("#teleopConesBottom").html("Teleop Cones Bottom: " + teleop.cones.bottom);
    });

    $("#teleopConesMiddlePlus").click(function () {
      teleop.cones.middle += 1;
      $("#teleopConesMiddle").html("Teleop Cones Middle: " + teleop.cones.middle);
    });

    $("#teleopConesMiddleMinus").click(function () {
      teleop.cones.middle = Math.max(teleop.cones.middle - 1, 0);
      $("#teleopConesMiddle").html("Teleop Cones Middle: " + teleop.cones.middle);
    });

    $("#teleopConesTopPlus").click(function () {
      teleop.cones.top += 1;
      $("#teleopConesTop").html("Teleop Cones Top: " + teleop.cones.top);
    });

    $("#teleopConesTopMinus").click(function () {
      teleop.cones.top = Math.max(teleop.cones.top - 1, 0);
      $("#teleopConesTop").html("Teleop Cones Top: " + teleop.cones.top);
    });

    // Teleop cubes
    $("#teleopCubesBottomPlus").click(function () {
      teleop.cubes.bottom += 1;
      $("#teleopCubesBottom").html("Teleop Cubes Bottom: " + teleop.cubes.bottom);
    });

    $("#teleopCubesBottomMinus").click(function () {
      teleop.cubes.bottom = Math.max(teleop.cubes.bottom - 1, 0);
      $("#teleopCubesBottom").html("Teleop Cubes Bottom: " + teleop.cubes.bottom);
    });

    $("#teleopCubesMiddlePlus").click(function () {
      teleop.cubes.middle += 1;
      $("#teleopCubesMiddle").html("Teleop Cubes Middle: " + teleop.cubes.middle);
    });

    $("#teleopCubesMiddleMinus").click(function () {
      teleop.cubes.middle = Math.max(teleop.cubes.middle - 1, 0);
      $("#teleopCubesMiddle").html("Teleop Cubes Middle: " + teleop.cubes.middle);
    });

    $("#teleopCubesTopPlus").click(function () {
      teleop.cubes.top += 1;
      $("#teleopCubesTop").html("Teleop Cubes Top: " + teleop.cubes.top);
    });

    $("#teleopCubesTopMinus").click(function () {
      teleop.cubes.top = Math.max(teleop.cubes.top - 1, 0);
      $("#teleopCubesTop").html("Teleop Cubes Top: " + teleop.cubes.top);
    });

  }

  // Retrieve the form data and prepare for submission
  function getFormData(auto, teleop) {
    console.log("==> matchForm: getFormData()");
    let out = {};
    let matchLevel = $("#compLevel").val();
    let matchNumber = $("#matchNumber").val();
    if (matchNumber != parseInt(matchNumber)) {
      alert("Match number must be integer.");
      throw Error("Match number must be integer.");
    }
    let teamNumber = $("#teamNumber").val();
    if (teamNumber === "") {
      alert("Team number must not be empty.");
      throw Error("Team number must not be empty.");
    }
    if (validateTeamNumber(teamNumber) <= 0) {
      alert("TTeam number is an integer with optional letter.");
      throw Error("Team number is an integer with optional letter.");
    }
    out["matchnumber"] = matchLevel + matchNumber;
    out["teamnumber"] = teamNumber;
    out["mobility"] = $("#exitCommunity").is(':checked') ? 1 : 0;
    out["autonconesbottom"] = auto.cones.bottom;
    out["autonconesmiddle"] = auto.cones.middle;
    out["autonconestop"] = auto.cones.top;
    out["autoncubesbottom"] = auto.cubes.bottom;
    out["autoncubesmiddle"] = auto.cubes.middle;
    out["autoncubestop"] = auto.cubes.bottom;
    out["autochargestation"] = $("#autochargestation").val();
    out["teleopconesbottom"] = teleop.cones.bottom;
    out["teleopconesmiddle"] = teleop.cones.middle;
    out["teleopconestop"] = teleop.cones.top;
    out["teleopcubesbottom"] = teleop.cubes.bottom;
    out["teleopcubesmiddle"] = teleop.cubes.middle;
    out["teleopcubestop"] = teleop.cubes.top;
    out["cubepickup"] = $("#pickedupCube").is(':checked') ? 1 : 0;
    out["uprightconepickup"] = $("#pickedupUprightCone").is(':checked') ? 1 : 0;
    out["tippedconepickup"] = $("#pickedupTippedCone").is(':checked') ? 1 : 0;
    out["endgamechargestation"] = $("#endgamechargestation").val();
    out["died"] = $("#dead").is(':checked') ? 1 : 0;
    out["scoutname"] = $("#scoutName").val();
    out["comment"] = $("#comment").val();
    return out;
  }

  // Clear all form fields
  function clearFormData() {
    console.log("==> matchForm: clearFormData()");
    $("#matchNumber").val("");
    //$("#startpos").val("0");
    auto.cones.bottom = 0;
    auto.cones.middle = 0;
    auto.cones.top = 0;
    auto.cubes.bottom = 0;
    auto.cubes.middle = 0;
    auto.cubes.top = 0;
    teleop.cones.bottom = 0;
    teleop.cones.middle = 0;
    teleop.cones.top = 0;
    teleop.cubes.bottom = 0;
    teleop.cubes.middle = 0;
    teleop.cubes.top = 0;
    $("#autoConesBottom").html("Auto Cones Bottom: " + auto.cones.bottom);
    $("#autoConesMiddle").html("Auto Cones Middle: " + auto.cones.middle);
    $("#autoConesTop").html("Auto Cones Top: " + auto.cones.top);
    $("#autoCubesBottom").html("Auto Cubes Bottom: " + auto.cubes.bottom);
    $("#autoCubesMiddle").html("Auto Cubes Middle: " + auto.cubes.middle);
    $("#autoCubesTop").html("Auto Cubes Top: " + auto.cubes.top);
    $("#teleopConesBottom").html("Teleop Cones Bottom: " + teleop.cones.bottom);
    $("#teleopConesMiddle").html("Teleop Cones Middle: " + teleop.cones.middle);
    $("#teleopConesTop").html("Teleop Cones Top: " + teleop.cones.top);
    $("#teleopCubesBottom").html("Teleop Cubes Bottom: " + teleop.cubes.bottom);
    $("#teleopCubesMiddle").html("Teleop Cubes Middle: " + teleop.cubes.middle);
    $("#teleopCubesTop").html("Teleop Cubes Top: " + teleop.cubes.top);
    $("#teamNumber").val("");
    $("#comment").val("");
  }

  // Submit the match data form to the database
  function submitMatchData(formData) {
    console.log("==> matchForm: submitMatchData()");
    $.post("api/dbWriteAPI.php", {
      writeSingleData: JSON.stringify(formData)
    }, function (response) {
      // Because success word may have a newline at the end, don't do a direct compare
      if (response.indexOf('success') > -1) {
        alert("Data Successfully Submitted! Clearing Data.");
        clearFormData();
      } else {
        alert("Data NOT Submitted. Please Check Network Connectivity.");
      }
    });
  }

  //
  // Process the generated html
  //
  $(document).ready(function () {
    const auto = {
      cones: { bottom: 0, middle: 0, top: 0 },
      cubes: { bottom: 0, middle: 0, top: 0 }
    };
    const teleop = {
      cones: { bottom: 0, middle: 0, top: 0 },
      cubes: { bottom: 0, middle: 0, top: 0 }
    };

    // Update the navbar with the event code
    $.get("api/tbaAPI.php", {
      getEventCode: true
    }, function (eventCode) {
      console.log("=> matchForm: getEventCode: " + eventCode.trim());
      $("#navbarEventCode").html(eventCode);
    });

    attachFormButtons(auto, teleop);

    // Submit the match data form 
    $("#submitForm").click(function () {
      let formData = getFormData(auto, teleop);
      alert("This match form is NOT configured for 2025 game!");

      // Should be:
      // formData getFormData()
      // if (validateMatchData(formData))
      //    submitMatchData(formData);
    });
  });
</script>

<script src="./scripts/validateTeamNumber.js"></script>
