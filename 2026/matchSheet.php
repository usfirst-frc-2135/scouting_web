<?php
$title = 'Match Sheet';
require 'inc/header.php';
?>

<div class="container row-offcanvas row-offcanvas-left">
  <div id="content" class="column card-lg-12 col-sm-12 col-xs-12">

    <!-- Page Title -->
    <div class="row pt-3 pb-3 mb-3">
      <div class="row">
        <h2 class="col-md-6"><?php echo $title; ?></h2>
      </div>

      <!-- Main card to hold the match selection -->
      <div class="card col-md-6 mx-auto mb-3">

        <!-- Our team matches list -->
        <h5 class="pt-3">2135 Match Links</h5>
        <div class="row mb-3">
          <div id="ourMatches">
          </div>
        </div>

        <!-- Load Match buttons -->
        <div class="card mb-3">
          <div class="input-group">
            <div class="input-group-prepend">
              <select id="enterCompLevel" class="form-select" aria-label="Comp Level Select">
                <option value="qm">QM</option>
                <option value="sf">SF</option>
                <option value="f">F</option>
              </select>
            </div>
            <input id="enterMatchNumber" class="form-control" type="text" placeholder="Match Number" aria-label="Match Number">
            <div class="input-group-append">
              <button id="loadMatchButton" class="btn btn-primary" type="button">Load Match</button>
            </div>
          </div>
        </div>

        <!-- Custom match button (collapsible section) -->
        <div class="card mb-3">

          <div id="customMatch" class="accordion accordion-flush">
            <div class="accordion-item" style="background-color: #F8F9FA">
              <h2 class="accordion-header">
                <button class="accordion-button text-light bg-secondary" type="button" data-bs-toggle="collapse"
                  data-bs-target="#matchEntry" aria-expanded="false" aria-controls="matchEntry">Enter Custom Match
                </button>
              </h2>
              <div id="matchEntry" class="accordion-collapse collapse" data-bs-parent="#customMatch">
                <div class="accordion-body">
                  <div class="input-group mb-3">
                    <h5 id="red">Red Alliance:</h5>
                    <div class="input-group mb-3">
                      <input id="enterRed1" class="form-control border border-black" style="background-color:#F3D8DA" type="text"
                        placeholder="Red Team 1" aria-label="Red Team 1">
                      <input id="enterRed2" class="form-control border border-black" style="background-color:#F3D8DA" type="text"
                        placeholder="Red Team 2" aria-label="Red Team 2">
                      <input id="enterRed3" class="form-control border border-black" style="background-color:#F3D8DA" type="text"
                        placeholder="Red Team 3" aria-label="Red Team 3">
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <h5 id="blue">Blue Alliance:</h5>
                    <div class="input-group mb-3">
                      <input id="enterBlue1" class="form-control border border-black" style="background-color:#D3E1FC" type="text"
                        placeholder="Blue Team 1" aria-label="Blue Team 1">
                      <input id="enterBlue2" class="form-control border border-black" style="background-color:#D3E1FC" type="text"
                        placeholder="Blue Team 2" aria-label="Blue Team 2">
                      <input id="enterBlue3" class="form-control border border-black" style="background-color:#D3E1FC" type="text"
                        placeholder="Blue Team 3" aria-label="Blue Team 3">
                    </div>
                  </div>
                  <button id="loadCustomMatch" class="btn btn-primary" type="button">Load Custom Match</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Match overview card -->
      <div class="card col-md-6 mx-auto mb-3 p-3">
        <h5 id="matchTitle">Match:</h5>
        <h5 id="matchTime">Time:</h5>
        <table class="table table-bordered table-sm border-dark text-center">
          <thead>
            <tr>
              <th></th>
              <th>Red</th>
              <th>Blue</th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
            <tr>
              <td class="text-start table-secondary">Avg Total Coral</td>
              <td id="redTotalCoral" class="table-danger"></td>
              <td id="blueTotalCoral" class="table-primary"></td>
            </tr>
            <tr>
              <td class="text-start table-secondary">Avg Total Algae</td>
              <td id="redTotalAlgae" class="table-danger"></td>
              <td id="blueTotalAlgae" class="table-primary"></td>
            </tr>
            <tr>
              <td class="text-start table-secondary">Avg Auton Points</td>
              <td id="redAvgAutoPoints" class="table-danger"></td>
              <td id="blueAvgAutoPoints" class="table-primary"></td>
            </tr>
            <tr>
              <td class="text-start table-secondary">Avg Teleop Points</td>
              <td id="redAvgTeleopPoints" class="table-danger"></td>
              <td id="blueAvgTeleopPoints" class="table-primary"></td>
            </tr>
            <tr>
              <td class="text-start table-secondary">Avg Endgame Points</td>
              <td id="redAvgEndgamePoints" class="table-danger"></td>
              <td id="blueAvgEndgamePoints" class="table-primary"></td>
            </tr>
            <tr>
              <td class="text-start table-secondary">Total Predicted Points</td>
              <td id="redTotalPredictedPoints" class="table-danger"></td>
              <td id="blueTotalPredictedPoints" class="table-primary"></td>
            </tr>
          </tbody>
        </table>
      </div>

    </div>
  </div>

  <!-- Red Team cards -->
  <div class="row mb-3 gx-3">

    <!-- Red0 - Red Team 1 -->
    <div class="col-lg-4 col-sm-4 col-xs-4 gx-3">
      <div id="R0Flush" class="accordion accordion-flush text-light bg-danger mb-3">
        <div class="accordion-item bg-danger">
          <h6 id="R0flush-headingOne" class="accordion-header bg-danger">
            <button class="accordion-button collapsed bg-danger btn-sm" type="button" data-bs-toggle="collapse"
              data-bs-target="#flush-R0Collapse" aria-expanded="false" aria-controls="flush-R0Collapse">
              <h6 id="R0TeamNumber" class="text-center text-light">Team #</h6>
            </button>
          </h6>

          <div id="flush-R0Collapse" class="accordion-collapse collapse show" data-bs-parent="#R0Flush">
            <div id="R0PicsCarousel" class="carousel slide" data-interval="false">
              <div id="R0RobotPics" class="carousel-inner"> </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#R0PicsCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#R0PicsCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </div>

          <div class="overflow-auto">
            <table id="R0DataTable" class="table table-bordered table-danger table-sm text-center">
              <thead>
                <tr>
                  <th colspan="6" class="text-center fs-6" style="background-color:#D5E6DE">Auton</th>
                  <th colspan="8" class="text-center fs-6" style="background-color:#D6F3FB">Teleop</th>
                  <th colspan="5" class="text-center fs-6" style="background-color:#FBE6D3">Endgame</th>
                </tr>
                <tr>
                  <th scope="col">L1</th>
                  <th scope="col">L2</th>
                  <th scope="col">L3</th>
                  <th scope="col">L4</th>
                  <th scope="col">Net</th>
                  <th scope="col">Proc</th>

                  <th scope="col">C%</th>
                  <th scope="col">L1</th>
                  <th scope="col">L2</th>
                  <th scope="col">L3</th>
                  <th scope="col">L4</th>
                  <th scope="col">A%</th>
                  <th scope="col">Net</th>
                  <th scope="col">Proc</th>

                  <th scope="col">N</th>
                  <th scope="col">P</th>
                  <th scope="col">F</th>
                  <th scope="col">S</th>
                  <th scope="col">D</th>
                </tr>
              </thead>
              <tbody class="table-group-divider"> </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>

    <!-- Red1 - Red Team 2 -->
    <div class="col-lg-4 col-sm-4 col-xs-4 gx-3">
      <div id="R1Flush" class="accordion accordion-flush text-light bg-danger mb-3">
        <div class="accordion-item bg-danger">
          <h6 id="R1flush-headingOne" class="accordion-header bg-danger">
            <button class="accordion-button collapsed bg-danger btn-sm" type="button" data-bs-toggle="collapse"
              data-bs-target="#flush-R1Collapse" aria-expanded="false" aria-controls="flush-R1Collapse">
              <h6 id="R1TeamNumber" class="text-center text-light">Team #</h6>
            </button>
          </h6>

          <div id="flush-R1Collapse" class="accordion-collapse collapse show" data-bs-parent="#R1Flush">
            <div id="R1PicsCarousel" class="carousel slide" data-interval="false">
              <div id="R1RobotPics" class="carousel-inner"> </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#R1PicsCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#R1PicsCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </div>

          <div class="overflow-auto">
            <table id="R1DataTable" class="table table-bordered table-danger table-sm text-center">
              <thead>
                <tr>
                  <th colspan="6" class="text-center fs-6" style="background-color:#D5E6DE">Auton</th>
                  <th colspan="8" class="text-center fs-6" style="background-color:#D6F3FB">Teleop</th>
                  <th colspan="5" class="text-center fs-6" style="background-color:#FBE6D3">Endgame</th>
                </tr>
                <tr>
                  <th scope="col">L1</th>
                  <th scope="col">L2</th>
                  <th scope="col">L3</th>
                  <th scope="col">L4</th>
                  <th scope="col">Net</th>
                  <th scope="col">Proc</th>

                  <th scope="col">C%</th>
                  <th scope="col">L1</th>
                  <th scope="col">L2</th>
                  <th scope="col">L3</th>
                  <th scope="col">L4</th>
                  <th scope="col">A%</th>
                  <th scope="col">Net</th>
                  <th scope="col">Proc</th>

                  <th scope="col">N</th>
                  <th scope="col">P</th>
                  <th scope="col">F</th>
                  <th scope="col">S</th>
                  <th scope="col">D</th>
                </tr>
              </thead>
              <tbody class="table-group-divider"> </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>

    <!-- Red2 - Red Team 3 -->
    <div class="col-lg-4 col-sm-4 col-xs-4 gx-3">
      <div id="R2Flush" class="accordion accordion-flush text-light bg-danger mb-3">
        <div class="accordion-item bg-danger">
          <h6 id="R2flush-headingOne" class="accordion-header bg-danger">
            <button class="accordion-button collapsed bg-danger btn-sm" type="button" data-bs-toggle="collapse"
              data-bs-target="#flush-R2Collapse" aria-expanded="false" aria-controls="flush-R2Collapse">
              <h6 id="R2TeamNumber" class="text-center text-light">Team #</h6>
            </button>
          </h6>

          <div id="flush-R2Collapse" class="accordion-collapse collapse show" data-bs-parent="#R2Flush">
            <div id="R2PicsCarousel" class="carousel slide" data-interval="false">
              <div id="R2RobotPics" class="carousel-inner"> </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#R2PicsCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#R2PicsCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </div>

          <div class="overflow-auto">
            <table id="R2DataTable" class="table table-bordered table-danger table-sm text-center">
              <thead>
                <tr>
                  <th colspan="6" class="text-center fs-6" style="background-color:#D5E6DE">Auton</th>
                  <th colspan="8" class="text-center fs-6" style="background-color:#D6F3FB">Teleop</th>
                  <th colspan="5" class="text-center fs-6" style="background-color:#FBE6D3">Endgame</th>
                </tr>
                <tr>
                  <th scope="col">L1</th>
                  <th scope="col">L2</th>
                  <th scope="col">L3</th>
                  <th scope="col">L4</th>
                  <th scope="col">Net</th>
                  <th scope="col">Proc</th>

                  <th scope="col">C%</th>
                  <th scope="col">L1</th>
                  <th scope="col">L2</th>
                  <th scope="col">L3</th>
                  <th scope="col">L4</th>
                  <th scope="col">A%</th>
                  <th scope="col">Net</th>
                  <th scope="col">Proc</th>

                  <th scope="col">N</th>
                  <th scope="col">P</th>
                  <th scope="col">F</th>
                  <th scope="col">S</th>
                  <th scope="col">D</th>
                </tr>
              </thead>
              <tbody class="table-group-divider"> </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
  </div>

  <!-- Blue Team cards -->
  <div class="row mb-3 gx-3">

    <!-- Blue0 - Blue Team 1 -->
    <div class="col-lg-4 col-sm-4 col-xs-4 gx-3">
      <div id="B0Flush" class="accordion accordion-flush text-light bg-primary mb-3">
        <div class="accordion-item bg-primary">
          <h6 id="B0flush-headingOne" class="accordion-header bg-primary">
            <button class="accordion-button collapsed bg-primary btn-sm" type="button" data-bs-toggle="collapse"
              data-bs-target="#flush-B0Collapse" aria-expanded="false" aria-controls="flush-B0Collapse">
              <h6 id="B0TeamNumber" class="text-center text-light">Team #</h6>
            </button>
          </h6>

          <div id="flush-B0Collapse" class="accordion-collapse collapse show" data-bs-parent="#B0Flush">
            <div id="B0PicsCarousel" class="carousel slide" data-interval="false">
              <div id="B0RobotPics" class="carousel-inner"> </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#B0PicsCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#B0PicsCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </div>

          <div class="overflow-auto">
            <table id="B0DataTable" class="table table-bordered table-primary table-sm text-center">
              <thead>
                <tr>
                  <th colspan="6" class="text-center fs-6" style="background-color:#D5E6DE">Auton</th>
                  <th colspan="8" class="text-center fs-6" style="background-color:#D6F3FB">Teleop</th>
                  <th colspan="5" class="text-center fs-6" style="background-color:#FBE6D3">Endgame</th>
                </tr>
                <tr>
                  <th scope="col">L1</th>
                  <th scope="col">L2</th>
                  <th scope="col">L3</th>
                  <th scope="col">L4</th>
                  <th scope="col">Net</th>
                  <th scope="col">Proc</th>

                  <th scope="col">C%</th>
                  <th scope="col">L1</th>
                  <th scope="col">L2</th>
                  <th scope="col">L3</th>
                  <th scope="col">L4</th>
                  <th scope="col">A%</th>
                  <th scope="col">Net</th>
                  <th scope="col">Proc</th>

                  <th scope="col">N</th>
                  <th scope="col">P</th>
                  <th scope="col">F</th>
                  <th scope="col">S</th>
                  <th scope="col">D</th>
                </tr>
              </thead>
              <tbody class="table-group-divider"> </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>

    <!-- Blue1 - Blue Team 2 -->
    <div class="col-lg-4 col-sm-4 col-xs-4 gx-3">
      <div id="B1Flush" class="accordion accordion-flush text-light bg-primary mb-3">
        <div class="accordion-item bg-primary">
          <h6 id="B1flush-headingOne" class="accordion-header bg-primary">
            <button class="accordion-button collapsed bg-primary btn-sm" type="button" data-bs-toggle="collapse"
              data-bs-target="#flush-B1Collapse" aria-expanded="false" aria-controls="flush-B1Collapse">
              <h6 id="B1TeamNumber" class="text-center text-light">Team #</h6>
            </button>
          </h6>

          <div id="flush-B1Collapse" class="accordion-collapse collapse show" data-bs-parent="#B1Flush">
            <div id="B1PicsCarousel" class="carousel slide" data-interval="false">
              <div id="B1RobotPics" class="carousel-inner"> </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#B1PicsCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#B1PicsCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </div>

          <div class="overflow-auto">
            <table id="B1DataTable" class="table table-bordered table-primary table-sm text-center">
              <thead>
                <tr>
                  <th colspan="6" class="text-center fs-6" style="background-color:#D5E6DE">Auton</th>
                  <th colspan="8" class="text-center fs-6" style="background-color:#D6F3FB">Teleop</th>
                  <th colspan="5" class="text-center fs-6" style="background-color:#FBE6D3">Endgame</th>
                </tr>
                <tr>
                  <th scope="col">L1</th>
                  <th scope="col">L2</th>
                  <th scope="col">L3</th>
                  <th scope="col">L4</th>
                  <th scope="col">Net</th>
                  <th scope="col">Proc</th>

                  <th scope="col">C%</th>
                  <th scope="col">L1</th>
                  <th scope="col">L2</th>
                  <th scope="col">L3</th>
                  <th scope="col">L4</th>
                  <th scope="col">A%</th>
                  <th scope="col">Net</th>
                  <th scope="col">Proc</th>

                  <th scope="col">N</th>
                  <th scope="col">P</th>
                  <th scope="col">F</th>
                  <th scope="col">S</th>
                  <th scope="col">D</th>
                </tr>
              </thead>
              <tbody class="table-group-divider"> </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>

    <!-- Blue2 - Blue Team 3 -->
    <div class="col-lg-4 col-sm-4 col-xs-4 gx-3">
      <div id="B2Flush" class="accordion accordion-flush text-light bg-primary mb-3">
        <div class="accordion-item bg-primary">
          <h6 id="B2flush-headingOne" class="accordion-header bg-primary">
            <button class="accordion-button collapsed bg-primary btn-sm" type="button" data-bs-toggle="collapse"
              data-bs-target="#flush-B2Collapse" aria-expanded="false" aria-controls="flush-B2Collapse">
              <h6 id="B2TeamNumber" class="text-center text-light">Team #</h6>
            </button>
          </h6>

          <div id="flush-B2Collapse" class="accordion-collapse collapse show" data-bs-parent="#B2Flush">
            <div id="B2PicsCarousel" class="carousel slide" data-interval="false">
              <div id="B2RobotPics" class="carousel-inner"> </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#B2PicsCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#B2PicsCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </div>

          <div class="overflow-auto">
            <table id="B2DataTable" class="table table-bordered table-primary table-sm text-center">
              <thead>
                <tr>
                  <th colspan="6" class="text-center fs-6" style="background-color:#D5E6DE">Auton</th>
                  <th colspan="8" class="text-center fs-6" style="background-color:#D6F3FB">Teleop</th>
                  <th colspan="5" class="text-center fs-6" style="background-color:#FBE6D3">Endgame</th>
                </tr>
                <tr>
                  <th scope="col">L1</th>
                  <th scope="col">L2</th>
                  <th scope="col">L3</th>
                  <th scope="col">L4</th>
                  <th scope="col">Net</th>
                  <th scope="col">Proc</th>

                  <th scope="col">C%</th>
                  <th scope="col">L1</th>
                  <th scope="col">L2</th>
                  <th scope="col">L3</th>
                  <th scope="col">L4</th>
                  <th scope="col">A%</th>
                  <th scope="col">Net</th>
                  <th scope="col">Proc</th>

                  <th scope="col">N</th>
                  <th scope="col">P</th>
                  <th scope="col">F</th>
                  <th scope="col">S</th>
                  <th scope="col">D</th>
                </tr>
              </thead>
              <tbody class="table-group-divider"> </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>

  </div>
</div>

<?php include 'inc/footer.php'; ?>

<!-- Javascript page handlers -->

<script>

  // Utility to strip off leading "frc" from team number
  function strTeamToIntTeam(team) {
    return team.replace(/^(frc)/, '');
  }

  // Round data to two decimal digits
  function roundInt(val) {
    return Math.round((val + Number.EPSILON) * 100) / 100;
  }

  // Fix match IDs that are missing the comp level
  function getFixedMatchId(matchId) {
    matchId = matchId.toLowerCase();
    if ((matchId.search("p") != -1) || (matchId.search("qm") != -1) ||
      (matchId.search("sf") != -1) || (matchId.search("f") != -1)) {
      return matchId;
    }
    else {  // Attempt to repair bad match IDs but log them
      console.warn("getMatchTuple: Invalid matchId! " + matchId);
      return "qm" + matchId;
    }
  }

  // Get the comp level and match number from the match ID string (ex. [qm, 25] from qm25)
  function getMatchTuple(matchId) {
    matchId = getFixedMatchId(matchId);
    if (matchId.search("p") != -1) {
      return ["p", parseInt(matchId.substring(1))];
    }
    else if (matchId.search("qm") != -1) {
      return ["qm", parseInt(matchId.substring(2))];
    }
    else if (matchId.search("sf") != -1) {
      return ["sf", parseInt(matchId.substring(2))];
    }
    else if (matchId.search("f") != -1) {
      return ["f", parseInt(matchId.substring(1))];
    }
    else {  // Repair bad match IDs but report them
      console.warn("getMatchTuple: Invalid match prefix! " + matchId);
    }
    return null;
  }

  // Create a match key in the form QM_1
  function idToKey(matchId) {
    mt = getMatchTuple(matchId);
    return mt[0].toUpperCase() + "_" + String(mt[1]).toUpperCase();
  }

  // Create a match key in the form QM_1
  function makeKey(compLevel, matchNumber) {
    return compLevel.toUpperCase() + "_" + String(matchNumber).toUpperCase();
  }

  // Clear all existing data from the match sheet table
  function clearMatchSheet() {
    console.log("==> matchSheet: clearMatchSheet()");

    // Clear out custom match entries
    document.getElementById("enterRed1").innerText = "";
    document.getElementById("enterRed2").innerText = "";
    document.getElementById("enterRed3").innerText = "";
    document.getElementById("enterBlue1").innerText = "";
    document.getElementById("enterBlue2").innerText = "";
    document.getElementById("enterBlue3").innerText = "";

    // Clear match summary
    document.getElementById("matchTitle").innerText = "Match:";
    document.getElementById("matchTime").innerText = "Time:";

    document.getElementById("redTotalCoral").innerText = "";
    document.getElementById("redTotalAlgae").innerText = "";
    document.getElementById("redAvgAutoPoints").innerText = "";
    document.getElementById("redAvgTeleopPoints").innerText = "";
    document.getElementById("redAvgEndgamePoints").innerText = "";
    document.getElementById("redTotalPredictedPoints").innerText = "";

    document.getElementById("blueTotalCoral").innerText = "";
    document.getElementById("blueTotalAlgae").innerText = "";
    document.getElementById("blueAvgAutoPoints").innerText = "";
    document.getElementById("blueAvgTeleopPoints").innerText = "";
    document.getElementById("blueAvgEndgamePoints").innerText = "";
    document.getElementById("blueTotalPredictedPoints").innerText = "";

    // Clear team box photo and match data
    document.getElementById("R0RobotPics").innerText = "";
    document.getElementById("R1RobotPics").innerText = "";
    document.getElementById("R2RobotPics").innerText = "";
    document.getElementById("B0RobotPics").innerText = "";
    document.getElementById("B1RobotPics").innerText = "";
    document.getElementById("B2RobotPics").innerText = "";

    document.getElementById("R0DataTable").querySelector('tbody').innerHTML = "";
    document.getElementById("R1DataTable").querySelector('tbody').innerHTML = "";
    document.getElementById("R2DataTable").querySelector('tbody').innerHTML = "";
    document.getElementById("B0DataTable").querySelector('tbody').innerHTML = "";
    document.getElementById("B1DataTable").querySelector('tbody').innerHTML = "";
    document.getElementById("B2DataTable").querySelector('tbody').innerHTML = "";
  }

  // Build the list of HTML links to our matches at this event
  function buildOurTeamMatchLinks(ourMatches) {
    console.log("==> matchSheet: buildOurTeamMatchLinks()");
    let ourMatchesArray = [];
    for (let key in ourMatches) {
      ourMatchesArray.push(ourMatches[key]);
    }

    ourMatchesArray.sort(function (matchA, matchB) {
      return compareMatchNumbers(matchA["comp_level"] + matchA["match_number"], matchB["comp_level"] + matchB["match_number"]);
    });

    for (let i = 0; i < ourMatchesArray.length; i++) {
      let thisMatch = ourMatchesArray[i];
      let matchId = thisMatch["comp_level"] + thisMatch["match_number"]
      const button = document.createElement("button");
      button.id = matchId;
      button.classList.add("btn");
      button.classList.add("btn-secondary");
      button.classList.add("btn-sm");
      button.classList.add("col-2");
      button.classList.add("m-1");
      button.type = "button";
      button.textContent = matchId;

      button.onclick = function (el) {
        document.getElementById("enterCompLevel").value = thisMatch["comp_level"];
        document.getElementById("enterMatchNumber").value = thisMatch["match_number"];
        document.getElementById("loadMatchButton").click();
      }
      document.getElementById("ourMatches").appendChild(button);
    }
  }

  // Takes list of Team Pic paths and loads them
  function buildRobotPhotoLinks(prefix, teamPics) {
    console.log("==> buildRobotPhotoLinks: build the entries in the photo carousels");
    let first = true;
    let elementRef = document.getElementById(prefix + "RobotPics");
    elementRef.innerHTML = "";
    for (let uri of teamPics) {
      let tags = "<div class='carousel-item";
      if (first) {
        tags += " active";
      }
      first = false;
      tags += "'> <img src='./" + uri + "' class='d-block w-100'></div>";
      elementRef.innerHTML += tags;
    }
  }

  // Update match time from system time in msec
  function updateMatchTime(time) {
    let date = new Date(time * 1000);
    let hours = date.getHours();
    let suffix = "AM";
    if (hours > 12) {
      hours = hours - 12;
      suffix = "PM"
    }
    let minutes = "0" + date.getMinutes();
    document.getElementById("matchTime").innerText = "Time: " + hours + ":" + minutes.substring(minutes.length - 2) + " " + suffix;
  }

  // Load the info into the team box
  function buildTeamBox(color, index, teamNum, averageData) {
    console.log("==> buildTeamBox: build the team box in the match sheet - " + teamNum);
    // Get team name from TBA
    $.get("api/tbaAPI.php", {
      getTeamInfo: teamNum
    }).done(function (teamInfo) {
      console.log("=> getTeamInfo:");
      if (teamInfo === null) {
        return alert("Can't load teamInfo from TBA; check if TBA Key was set in db_config");
      }
      let teamName = "";
      if (teamInfo === null) {
        alert("Can't load teamName from TBA; check if TBA Key was set in db_config");
      }
      else {
        let jTeamInfo = JSON.parse(teamInfo)["response"];
        teamName += " " + jTeamInfo["nickname"];
      }
      console.log("==> matchSheet: buildTeamBox() for " + teamNum + teamName);
      let teamLink = "<a class='text-light' href='teamLookup.php?teamNum=" + teamNum + "'>" + teamNum + "</a>";
      teamLink += " " + teamName;
      let elementRef = document.getElementById(color + index + "TeamNumber");
      elementRef.innerHTML = teamLink;
    });

    // Load team scouted information
    let rd = averageData[teamNum];
    let tbodyRef = document.getElementById(color + index + "DataTable").querySelector('tbody');
    tbodyRef.innerHTML = "";
    let row = "";
    if (rd != null) {
      row += "<td>" + rd["avgAutonCoralL1"] + "</td>";
      row += "<td>" + rd["avgAutonCoralL2"] + "</td>";
      row += "<td>" + rd["avgAutonCoralL3"] + "</td>";
      row += "<td>" + rd["avgAutonCoralL4"] + "</td>";
      row += "<td>" + rd["avgAutonAlgaeNet"] + "</td>";
      row += "<td>" + rd["avgAutonAlgaeProc"] + "</td>";
      row += "<td>" + rd["teleopCoralScoringPercent"] + "</td>";
      row += "<td>" + rd["avgTeleopCoralL1"] + "</td>";
      row += "<td>" + rd["avgTeleopCoralL2"] + "</td>";
      row += "<td>" + rd["avgTeleopCoralL3"] + "</td>";
      row += "<td>" + rd["avgTeleopCoralL4"] + "</td>";
      row += "<td>" + rd["teleopAlgaeScoringPercent"] + "</td>";
      row += "<td>" + rd["avgTeleopAlgaeNet"] + "</td>";
      row += "<td>" + rd["avgTeleopAlgaeProc"] + "</td>";
      row += "<td>" + rd["endgameClimbPercent"][0] + "</td>";
      row += "<td>" + rd["endgameClimbPercent"][1] + "</td>";
      row += "<td>" + rd["endgameClimbPercent"][2] + "</td>";
      row += "<td>" + rd["endgameClimbPercent"][3] + "</td>";
      row += "<td>" + rd["endgameClimbPercent"][4] + "</td>";
    }
    tbodyRef.insertRow().innerHTML = row;
  }

  function updateMatchSummary(matchSpec, averageData) {
    let avgTotalCoral = { "red": 0, "blue": 0 };
    let avgTotalAlgae = { "red": 0, "blue": 0 };
    let avgAutoPoints = { "red": 0, "blue": 0 };
    let avgTeleopPoints = { "red": 0, "blue": 0 };
    let avgEndgamePoints = { "red": 0, "blue": 0 };
    let totalPredictedPoints = { "red": 0, "blue": 0 };

    for (let i in matchSpec.red) {
      teamNum = matchSpec.red[i];
      let rd = averageData[teamNum];
      if (rd != null) {
        avgTotalCoral["red"] += rd["avgTotalCoral"];
        avgTotalAlgae["red"] += rd["avgTotalAlgae"];
        avgAutoPoints["red"] += rd["avgTotalAutoPoints"];
        avgTeleopPoints["red"] += rd["avgTotalTeleopPoints"];
        avgEndgamePoints["red"] += rd["avgEndgamePoints"];
        totalPredictedPoints["red"] += rd["avgTotalPoints"];
      }
    }
    for (let i in matchSpec.blue) {
      teamNum = matchSpec.blue[i];
      let rd = averageData[teamNum];
      if (rd != null) {
        avgTotalCoral["blue"] += rd["avgTotalCoral"];
        avgTotalAlgae["blue"] += rd["avgTotalAlgae"];
        avgAutoPoints["blue"] += rd["avgTotalAutoPoints"];
        avgTeleopPoints["blue"] += rd["avgTotalTeleopPoints"];
        avgEndgamePoints["blue"] += rd["avgEndgamePoints"];
        totalPredictedPoints["blue"] += rd["avgTotalPoints"];
      }
    }

    document.getElementById("redTotalCoral").innerText = roundInt(avgTotalCoral["red"]);
    document.getElementById("redTotalAlgae").innerText = roundInt(avgTotalAlgae["red"]);
    document.getElementById("redAvgAutoPoints").innerText = roundInt(avgAutoPoints["red"]);
    document.getElementById("redAvgTeleopPoints").innerText = roundInt(avgTeleopPoints["red"]);
    document.getElementById("redAvgEndgamePoints").innerText = roundInt(avgEndgamePoints["red"]);
    document.getElementById("redTotalPredictedPoints").innerText = roundInt(totalPredictedPoints["red"]);

    document.getElementById("blueTotalCoral").innerText = roundInt(avgTotalCoral["blue"]);
    document.getElementById("blueTotalAlgae").innerText = roundInt(avgTotalAlgae["blue"]);
    document.getElementById("blueAvgAutoPoints").innerText = roundInt(avgAutoPoints["blue"]);
    document.getElementById("blueAvgTeleopPoints").innerText = roundInt(avgTeleopPoints["blue"]);
    document.getElementById("blueAvgEndgamePoints").innerText = roundInt(avgEndgamePoints["blue"]);
    document.getElementById("blueTotalPredictedPoints").innerText = roundInt(totalPredictedPoints["blue"]);
  }

  // Build team photo image list
  function sendPhotoRequest(matchSpec) {
    console.log("==> matchSheet: sendPhotoRequest()");
    let _picDB = {};
    let requestList = [];

    for (let i in matchSpec.red) {
      let tn = matchSpec.red[i];
      if (tn !== "") {
        _picDB[tn] = "R" + i;
        requestList.push(tn);
      }
    }

    for (let i in matchSpec.blue) {
      let tn = matchSpec.blue[i];
      if (tn !== "") {
        _picDB[tn] = "B" + i;
        requestList.push(tn);
      }
    }

    $.get("api/dbReadAPI.php", {
      getAllTeamImages: JSON.stringify(requestList)
    }).done(function (imageData) {
      console.log("=> getAllTeamImages");
      let jImageData = JSON.parse(imageData);
      for (let team of Object.keys(jImageData)) {
        buildRobotPhotoLinks(_picDB[team], jImageData[team]);
      }
    });
  }

  // Clear a match spec object
  function clearMatchSpec(spec) {
    spec.title = "";
    spec.time = "";
    spec.red = ["", "", ""];
    spec.blue = ["", "", ""];
  }

  // Create the event match list, extract our matches and build links for them
  function buildMatchList(allEventMatches) {
    console.log("==> matchSheet: buildMatchList()");
    const OURTEAM = "frc2135";
    let ourMatches = {};
    let eventMatchList = [];
    for (let mi in allEventMatches) {
      let match = allEventMatches[mi];
      let newMatch = {};

      newMatch["comp_level"] = match["comp_level"];
      newMatch["match_number"] = match["match_number"];
      if (match["comp_level"] === "sf") {
        newMatch["match_number"] = match["set_number"];
      }

      newMatch["red_teams"] = match["alliances"]["red"]["team_keys"];
      newMatch["blue_teams"] = match["alliances"]["blue"]["team_keys"];
      newMatch["time"] = null;
      if (match["predicted_time"] != null) {
        newMatch["time"] = match["predicted_time"];
      } else if (match["actual_time"] != null) {
        newMatch["time"] = match["actual_time"];
      }

      // if (newMatch["time"] === null && match["time"] != null){ newMatch["time"] = match["time"]; }
      eventMatchList[idToKey(newMatch["comp_level"] + newMatch["match_number"])] = newMatch;

      // Create list of matches for our team
      if (newMatch["red_teams"].includes(OURTEAM) || newMatch["blue_teams"].includes(OURTEAM)) {
        let keyw = newMatch["comp_level"] + newMatch["match_number"];
        ourMatches[keyw] = newMatch;
      }
    }
    buildOurTeamMatchLinks(ourMatches);
    return eventMatchList;
  }

  // Check source URL for match specifier
  function checkURLForMatchId() {
    console.log("==> matchSheet: checkURLForMatchId()");
    let sp = new URLSearchParams(window.location.search);
    if (sp.has('compLevel') && sp.has('matchNum')) {
      return sp.get('compLevel') + sp.get('matchNum');
    }
    return null;
  }

  // Get a match spec from a matchId
  function getEventMatchSpec(matchId, matchList) {
    if (matchList === null) {
      return null;
    }

    let matchVector = matchList[idToKey(matchId)];
    if (!matchVector) {
      console.error("matchSheet: getEventMatchSpec: Match does not exist: " + idToKey(matchId));
      return alert("Match " + idToKey(matchId) + " does not exist!");
    }

    matchSpec = {
      title: matchId,
      time: matchVector["time"],
      red: [
        strTeamToIntTeam(matchVector["red_teams"][0]),
        strTeamToIntTeam(matchVector["red_teams"][1]),
        strTeamToIntTeam(matchVector["red_teams"][2])
      ],
      blue: [
        strTeamToIntTeam(matchVector["blue_teams"][0]),
        strTeamToIntTeam(matchVector["blue_teams"][1]),
        strTeamToIntTeam(matchVector["blue_teams"][2])
      ]
    };

    return matchSpec;
  }

  // Build a custom red and blue alliance matchsheet
  function loadMatchSheet(matchSpec, averageData) {
    console.log("==> matchSheet: loadMatchSheet()");
    clearMatchSheet();

    if (matchSpec === null) {
      console.error("matchSheet: loadMatchSheet: averageData is null!");
      return alert("matchSheet: loadMatchSheet: averageData is null!");
    }
    sendPhotoRequest(matchSpec);

    document.getElementById("matchTitle").innerText = matchSpec.title;
    if (matchSpec.title !== "CUSTOM") {
      updateMatchTime(matchSpec["time"]);
    }
    updateMatchSummary(matchSpec, averageData);

    buildTeamBox("R", 0, matchSpec.red[0], averageData);
    buildTeamBox("R", 1, matchSpec.red[1], averageData);
    buildTeamBox("R", 2, matchSpec.red[2], averageData);
    buildTeamBox("B", 0, matchSpec.blue[0], averageData);
    buildTeamBox("B", 1, matchSpec.blue[1], averageData);
    buildTeamBox("B", 2, matchSpec.blue[2], averageData);
  }

  /////////////////////////////////////////////////////////////////////////////
  //
  // Process the generated html
  //  Get the event match list from TBA and identify our matches from TBA schedule to build quick links
  //  Get all match data and averages from our database to prepare for creating the match sheet
  //  When load button (or quick link) is pressed
  //    Identify the teams in the selected match
  //    Request photos for each team
  //    Update the match summary using the match averages
  //    Build a team box for each team with the team info, photo, and match average data
  //
  document.addEventListener("DOMContentLoaded", function () {
    let matchId = null;
    let matchList = null;
    let averageData = null;
    let matchSpec = null;

    // Load event matches from TBA and build our links and a full match list
    $.get("api/tbaAPI.php", {
      getEventMatches: true
    }).done(function (eventMatches) {
      console.log("=> getEventMatches");
      if (eventMatches === null) {
        return alert("Can't load eventMatches from TBA; check if TBA Key was set in db_config");
      }
      else {
        let jEventMatches = JSON.parse(eventMatches)["response"];
        matchList = buildMatchList(jEventMatches);
        if (matchId !== null)
          matchSpec = getEventMatchSpec(matchId, matchList);
        if ((matchSpec !== null) && (averageData !== null))
          loadMatchSheet(matchSpec, averageData);
      }
    });

    // Load all match scouting data to be processed later
    $.get("api/dbReadAPI.php", {
      getAllMatchData: true
    }).done(function (allMatchData) {
      console.log("=> getAllMatchData");
      let mdp = new matchDataProcessor(JSON.parse(allMatchData));
      mdp.getSiteFilteredAverages(function (filteredMatchData, filteredAvgData) {
        averageData = filteredAvgData;
        if ((matchSpec !== null) && (averageData !== null))
          loadMatchSheet(matchSpec, averageData);
      });
    });

    // Check URL for match ID to load
    matchId = checkURLForMatchId();
    if (matchId !== null) {
      console.log("==> matchsheet: building from URL match ID! " + matchId);
      matchSpec = getEventMatchSpec(matchId, matchList);
      if ((matchSpec !== null) && (averageData !== null))
        loadMatchSheet(matchSpec, averageData);
    }

    // Load the match sheet from the match number entries
    document.getElementById("loadMatchButton").addEventListener('click', function () {
      console.log("=> matchsheet: load event match!");
      matchId = document.getElementById("enterCompLevel").value + document.getElementById("enterMatchNumber").value;
      matchSpec = getEventMatchSpec(matchId, matchList);
      if ((matchSpec !== null) && (averageData !== null))
        loadMatchSheet(matchSpec, averageData);
    });

    // Load the custom match using the custom team numbers entries
    document.getElementById("loadCustomMatch").addEventListener('click', function () {
      console.log("=> matchsheet: load custom match!");
      let newSpec = {
        title: "CUSTOM",
        time: "",
        red: [document.getElementById("enterRed1").value.trim(), document.getElementById("enterRed2").value.trim(), document.getElementById("enterRed3").value.trim()],
        blue: [document.getElementById("enterBlue1").value.trim(), document.getElementById("enterBlue2").value.trim(), document.getElementById("enterBlue3").value.trim()]
      };
      console.log("==> Custom match sheet: " + newSpec.red[0] + " " + newSpec.blue[0]);
      if (newSpec.red[0] === "" && newSpec.blue[0] === "") {
        console.warn("loadCustomMatch: No Red or Blue team 1 entered!");
        return alert("Please fill in Red Team Number 1 and Blue Team Number 1!");
      }
      else {
        matchSpec = newSpec;
        if ((matchSpec !== null) && (averageData !== null))
          loadMatchSheet(matchSpec, averageData);
      }
    });

  });

</script>

<script src="./scripts/compareMatchNumbers.js"></script>
<script src="./scripts/matchDataProcessor.js"></script>
