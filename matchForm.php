<?php
$title = 'Match Scouting Form';
require 'header.php';
?>

<div class="container row-offcanvas row-offcanvas-left">
  <div id="content" class="column card-lg-12 col-sm-12 col-xs-12">

    <div class="row pt-3 pb-3 mb-3">
      <div class="row justify-content-md-center">
        <h2 class="col-md-6"><?php echo $title; ?></h2>
      </div>

      <div class="card col-md-6 mx-auto">

        <div id="matchScoutingMessage" class="alert alert-dismissible fade show" style="display: none" role="alert">
          <div id="uploadMessageText"></div>
          <button id="closeMessage" class="btn-close" type="button" aria-label="Close"></button>
        </div>

        <!-- Match Entry Form -->
        <div class="card-body mb-3">
          <form id="matchForm" method="post" enctype="multipart/form-data">
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
                <div class="form-check form-check-inline">
                  <input id="exitCommunity class=" form-check-input" type="checkbox" name="exitCommunity"">
                  <label for=" exitCommunity" class=" form-check-label">Exited Community?</label>
                </div>

                <!-- Cones -->
                <div class="input-group mb-3 fw-bold">
                  <button id="minusAutoConesTop" class="btn btn-primary btn-warning" type="button">-</button>
                  <span>Auto Cones Top: 0</span>
                  <button id="plusAutoConesTop" class="btn btn-primary btn-info" type="button">+</button>
                </div>

                <div class="input-group mb-3 fw-bold">
                  <button id="minusAutoConesMiddle" class="btn btn-primary btn-warning" type="button">-</button>
                  <span id="autoConesMiddle">Auto Cones Middle: 0</span>
                  <button id="plusAutoConesMiddle" class="btn btn-primary btn-info" type="button">+</button>
                </div>

                <div class="input-group mb-3 fw-bold">
                  <button id="minusAutoConesBottom" class="btn btn-primary btn-warning" type="button">-</button>
                  <span>Auto Cones Bottom: 0</span>
                  <button id="plusAutoConesBottom" class="btn btn-primary btn-info" type="button">+</button>
                </div>

                <!-- Cubes -->
                <div class="input-group mb-3 fw-bold">
                  <button id="minusAutoCubesTop" class="btn btn-primary btn-warning" type="button">-</button>
                  <span id="autoCubesTop">Auto Cubes Top: 0</span>
                  <button id="plusAutoCubesTop" class="btn btn-primary btn-info" type="button">+</button>
                </div>

                <div class="input-group mb-3 fw-bold">
                  <button id="minusAutoCubesMiddle" class="btn btn-primary btn-warning" type="button">-</button>
                  <span id="autoCubesMiddle">Auto Cubes Middle: 0</span>
                  <button id="plusAutoCubesMiddle" class="btn btn-primary btn-info" type="button">+</button>
                </div>

                <div class="input-group mb-3 fw-bold">
                  <button id="minusAutoCubesBottom" class="btn btn-primary btn-warning" type="button">-</button>
                  <span id="autoCubesBottom">Auto Cubes Bottom: 0</span>
                  <button id="plusAutoCubesBottom" class="btn btn-primary btn-info" type="button">+</button>
                </div>

                <div class="row">
                  <div class="form-check form-check-inline">
                    <label for="autochargestation" class="form-check-label">Auto Charge Station?</label>
                    <select id="autochargestation" class="form-select">
                      <option value="0">None</option>
                      <option value="1">Docked</option>
                      <option value="2">Engaged</option>
                    </select>
                  </div>
                </div>

                <br>
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
                  <button id="plusTeleopConesTop" class="btn btn-primary btn-warning" type="button">+</button>
                  <span>Teleop Cones Top: 0</span>
                  <button id="minusTeleopConesTop" class="btn btn-primary btn-info" type="button">-</button>
                </div>

                <div class="input-group mb-3 fw-bold">
                  <button id="plusTeleopConesMiddle" class="btn btn-primary btn-warning" type="button">+</button>
                  <span>Teleop Cones Middle: 0</span>
                  <button id="minusTeleopConesMiddle" class="btn btn-primary btn-info" type="button">-</button>
                </div>

                <div class="input-group mb-3 fw-bold">
                  <button id="plusTeleopConesBottom" class="btn btn-primary btn-warning" type="button">+</button>
                  <span>Teleop Cones Bottom: 0</span>
                  <button id="minusTeleopConesBottom" class="btn btn-primary btn-info" type="button">-</button>
                </div>

                <!-- Cubes -->
                <div class="input-group mb-3 fw-bold">
                  <button id="plusTeleopCubesTop" class="btn btn-primary btn-warning" type="button">+</button>
                  <span>Teleop Cubes Top: 0</span>
                  <button id="minusTeleopCubesTop" class="btn btn-primary btn-info" type="button">-</button>
                </div>

                <div class="input-group mb-3 fw-bold">
                  <button id="plusTeleopCubesMiddle" class="btn btn-primary btn-warning" type="button">+</button>
                  <span>Teleop Cubes Middle: 0</span>
                  <button id="minusTeleopCubesMiddle" class="btn btn-primary btn-info" type="button">-</button>
                </div>

                <div class="input-group mb-3 fw-bold">
                  <button id="plusTeleopCubesBottom" class="btn btn-primary btn-warning" type="button">+</button>
                  <span>Teleop Cubes Bottom: 0</span>
                  <button id="minusTeleopCubesBottom" class="btn btn-primary btn-info" type="button">-</button>
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
            <!-- end Teleop Mode -->

            <!-- End Game -->
            <div class="card mb-3" style="background-color:#FBE6D3">
              <div class="card-header fw-bold">
                End Game
              </div>
              <div class="card-body">

                <div class="form-check form-check-inline">
                  <label for="endgamechargestation" class="form-check-label">Charge Station?</label>
                  <select id="endgamechargestation" class="form-select">
                    <option value="0">None</option>
                    <option value="1">Parked</option>
                    <option value="2">Docked</option>
                    <option value="3">Engaged</option>
                  </select>
                </div>

                <div class="form-check form-check-inline">
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
          <div class="row justify-content-md-center">
            <button id="submitForm" class="btn btn-primary" type="button" style="width:100%">Submit</button>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>

<script>
  var auto_conesbottom = 0;
  var auto_conesmiddle = 0;
  var auto_conestop = 0;
  var auto_cubesbottom = 0;
  var auto_cubesmiddle = 0;
  var auto_cubestop = 0;
  var teleop_conesbottom = 0;
  var teleop_conesmiddle = 0;
  var teleop_conestop = 0;
  var teleop_cubesbottom = 0;
  var teleop_cubesmiddle = 0;
  var teleop_cubestop = 0;

  function attach_gamepiece_scoring() {
    console.log("==> matchForm.php: attach_gamepiece_scoring() starting");
    $("#plusAutoConesBottom").click(function () {
      auto_conesbottom += 1;
      $("#autoConesBottom").html("Auto Cones Bottom: " + auto_conesbottom);
    });

    $("#minusAutoConesBottom").click(function () {
      auto_conesbottom = Math.max(auto_conesbottom - 1, 0);
      $("#autoConesBottom").html("Auto Cones Bottom: " + auto_conesbottom);
    });

    $("#plusAutoConesMiddle").click(function () {
      auto_conesmiddle += 1;
      $("#autoConesMiddle").html("Auto Cones Middle: " + auto_conesmiddle);
    });

    $("#minusAutoConesMiddle").click(function () {
      auto_conesmiddle = Math.max(auto_conesmiddle - 1, 0);
      $("#autoConesMiddle").html("Auto Cones Middle: " + auto_conesmiddle);
    });

    $("#plusAutoConesTop").click(function () {
      auto_conestop += 1;
      $("#autoConesTop").html("Auto Cones Top: " + auto_conestop);
    });

    $("#minusAutoConesTop").click(function () {
      auto_conestop = Math.max(auto_conestop - 1, 0);
      $("#autoConesTop").html("Auto Cones Top: " + auto_conestop);
    });

    $("#plusAutoCubesBottom").click(function () {
      auto_cubesbottom += 1;
      $("#autoCubesBottom").html("Auto Cubes Bottom: " + auto_cubesbottom);
    });

    $("#minusAutoCubesBottom").click(function () {
      auto_cubesbottom = Math.max(auto_cubesbottom - 1, 0);
      $("#autoCubesBottom").html("Auto Cubes Bottom: " + auto_cubesbottom);
    });

    $("#plusAutoCubesMiddle").click(function () {
      auto_cubesmiddle += 1;
      $("#autoConesMiddle").html("Auto Cubes Middle: " + auto_cubesmiddle);
    });

    $("#minusAutoCubesMiddle").click(function () {
      auto_cubesmiddle = Math.max(auto_cubesmiddle - 1, 0);
      $("#autoCubesMiddle").html("Auto Cubes Middle: " + auto_cubesmiddle);
    });

    $("#plusAutoCubesTop").click(function () {
      auto_cubestop += 1;
      $("#autoCubesTop").html("Auto Cubes Top: " + auto_cubestop);
    });

    $("#minusAutoCubesTop").click(function () {
      auto_cubestop = Math.max(auto_cubestop - 1, 0);
      $("#autoCubesTop").html("Auto Cubes Top: " + auto_cubestop);
    });


    $("#plusTeleopConesBottom").click(function () {
      teleop_conesbottom += 1;
      $("#teleopConesBottom").html("Teleop Cones Bottom: " + teleop_conesbottom);
    });

    $("#minusTeleopConesBottom").click(function () {
      teleop_conesbottom = Math.max(teleop_conesbottom - 1, 0);
      $("#teleopConesBottom").html("Teleop Cones Bottom: " + teleop_conesbottom);
    });

    $("#plusTeleopConesMiddle").click(function () {
      teleop_conesmiddle += 1;
      $("#teleopConesMiddle").html("Teleop Cones Middle: " + teleop_conesmiddle);
    });

    $("#minusTeleopConesMiddle").click(function () {
      teleop_conesmiddle = Math.max(teleop_conesmiddle - 1, 0);
      $("#teleopConesMiddle").html("Teleop Cones Middle: " + teleop_conesmiddle);
    });

    $("#plusTeleopConesTop").click(function () {
      teleop_conestop += 1;
      $("#teleopConesTop").html("Teleop Cones Top: " + teleop_conestop);
    });

    $("#minusTeleopConesTop").click(function () {
      teleop_conestop = Math.max(teleop_conestop - 1, 0);
      $("#teleopConesTop").html("Teleop Cones Top: " + teleop_conestop);
    });

    $("#plusTeleopCubesBottom").click(function () {
      teleop_cubesbottom += 1;
      $("#teleopCubesBottom").html("Teleop Cubes Bottom: " + teleop_cubesbottom);
    });

    $("#minusTeleopCubesBottom").click(function () {
      teleop_cubesbottom = Math.max(teleop_cubesbottom - 1, 0);
      $("#teleopCubesBottom").html("Teleop Cubes Bottom: " + teleop_cubesbottom);
    });

    $("#plusTeleopCubesMiddle").click(function () {
      teleop_cubesmiddle += 1;
      $("#teleopConesMiddle").html("Teleop Cubes Middle: " + teleop_cubesmiddle);
    });

    $("#minusTeleopCubesMiddle").click(function () {
      teleop_cubesmiddle = Math.max(teleop_cubesmiddle - 1, 0);
      $("#teleopCubesMiddle").html("Teleop Cubes Middle: " + teleop_cubesmiddle);
    });

    $("#plusTeleopCubesTop").click(function () {
      teleop_cubestop += 1;
      $("#teleopCubesTop").html("Teleop Cubes Top: " + teleop_cubestop);
    });

    $("#minusTeleopCubesTop").click(function () {
      teleop_cubestop = Math.max(teleop_cubestop - 1, 0);
      $("#teleopCubesTop").html("Teleop Cubes Top: " + teleop_cubestop);
    });


  }

  function get_form_data() {
    console.log("==> matchForm.php: get_form_data() starting");
    var out = {};
    var match_level = $("#compLevel").val();
    var match_number = $("#matchNumber").val();
    if (match_number != parseInt(match_number)) {
      alert("Match number must be integer.");
      throw Error("Match number must be integer.");
    }
    var teamNumber = $("#teamNumber").val();
    if (teamNumber == "") {
      alert("Team number must not be empty.");
      throw Error("Team number must not be empty.");
    }
    out["matchnumber"] = match_level + match_number;
    out["teamnumber"] = teamNumber;
    // out["startpos"] = $("#autoStartPosition").val();
    out["mobility"] = $("#exitCommunity").is(':checked') ? 1 : 0;
    out["autonconesbottom"] = auto_conesbottom;
    out["autonconesmiddle"] = auto_conesmiddle;
    out["autonconestop"] = auto_conestop;
    out["autoncubesbottom"] = auto_cubesbottom;
    out["autoncubesbottom"] = auto_cubesmiddle;
    out["autoncubesbottom"] = auto_cubestop;
    out["autochargestation"] = $("#autochargestation").val();
    out["teleopconesbottom"] = teleop_conesbottom;
    out["teleopconesmiddle"] = teleop_conesmiddle;
    out["teleopconestop"] = teleop_conestop;
    out["teleopcubesbottom"] = teleop_cubesbottom;
    out["teleopcubesbottom"] = teleop_cubesmiddle;
    out["teleopcubesbottom"] = teleop_cubestop;
    out["cubepickup"] = $("#pickedupCube").is(':checked') ? 1 : 0;
    out["uprightconepickup"] = $("#pickedupUprightCone").is(':checked') ? 1 : 0;
    out["tippedconepickup"] = $("#pickedupTippedCone").is(':checked') ? 1 : 0;
    out["endgamechargestation"] = $("#endgamechargestation").val();
    out["died"] = $("#dead").is(':checked') ? 1 : 0;
    out["scoutname"] = $("#scoutName").val();
    out["comment"] = $("#comment").val();
    return out;
  }

  function clear_data() {
    console.log("==> matchForm.php: clear_data() starting");
    $("#matchNumber").val("");
    //$("#startpos").val("0");
    auto_conesbottom = 0;
    auto_conesmiddle = 0;
    auto_conestop = 0;
    auto_cubesbottom = 0;
    auto_cubesmiddle = 0;
    auto_cubestop = 0;
    teleop_conesbottom = 0;
    teleop_conesmiddle = 0;
    teleop_conestop = 0;
    teleop_cubesbottom = 0;
    teleop_cubesmiddle = 0;
    teleop_cubestop = 0;
    $("#autoConesBottom").html("Auto Cones Bottom: " + auto_conesbottom);
    $("#autoConesMiddle").html("Auto Cones Middle: " + auto_conesmiddle);
    $("#autoConesTop").html("Auto Cones Top: " + auto_conestop);
    $("#autoCubesBottom").html("Auto Cubes Bottom: " + auto_cubesbottom);
    $("#autoCubesMiddle").html("Auto Cubes Middle: " + auto_cubesmiddle);
    $("#autoCubesTop").html("Auto Cubes Top: " + auto_cubestop);
    $("#teleopConesBottom").html("Teleop Cones Bottom: " + teleop_conesbottom);
    $("#teleopConesMiddle").html("Teleop Cones Middle: " + teleop_conesmiddle);
    $("#teleopConesTop").html("Teleop Cones Top: " + teleop_conestop);
    $("#teleopCubesBottom").html("Teleop Cubes Bottom: " + teleop_cubesbottom);
    $("#teleopCubesMiddle").html("Teleop Cubes Middle: " + teleop_cubesmiddle);
    $("#teleopCubesTop").html("Teleop Cubes Top: " + teleop_cubestop);
    $("#teamNumber").val("");
    $("#comment").val("");
  }

  function submit(form_data) {
    console.log("==> matchForm.php: submit() starting");
    $.post("writeAPI.php", {
      "writeSingleData": JSON.stringify(form_data)
    }, function (data) {
      // Because success word may have a new-line at the end, don't do a direct compare
      if (data.indexOf('success') > -1) {
        alert("Data Successfully Submitted! Clearing Data.");
        clear_data();
      } else {
        alert("Data NOT Submitted. Please Check Network Connectivity.");
      }
    });
  }

  //
  // Process the generated html
  //
  $(document).ready(function () {
    console.log("==> matchForm.php: ready() starting");
    attach_gamepiece_scoring();

    // Submit the match data form 
    $("#submitForm").click(function () {
      var form_data = get_form_data();
      submit(form_data);
    });
  });
</script>
