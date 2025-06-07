<?php
$title = 'Match Sheet';
require 'header.php';
?>

<div class="container row-offcanvas row-offcanvas-left">
  <div id="content" class="column card-lg-12 col-sm-12 col-xs-12">

    <!-- Page Title -->
    <div class="row pt-3 pb-3 mb-3">
      <div class="row justify-content-md-center">
        <h2 class="col-md-6"><?php echo $title; ?></h2>
      </div>

      <!-- Main card to hold the match selection -->
      <div class="card col-md-6 mx-auto">

        <!-- Our team matches list -->
        <div class="card mb-3 p-3" style="background-color: #F8F9FA">
          <h5>2135 Match Links</h5>
          <div class="row mb-3">
            <div id="ourMatches">
            </div>
          </div>
        </div>

        <!-- Load Match buttons -->
        <div class="card mb-3">
          <div class="input-group">
            <select id="enterMatchLevel" class="form-select" aria-label="Comp Level Select">
              <option value="QM">QM</option>
              <option value="QF">QF</option>
              <option value="SF">SF</option>
              <option value="F">F</option>
            </select>
            <input id="enterMatchNumber" class="form-control" type="text" placeholder="Match Number" aria-label="Match Number">
            <button id="loadMatch" class="btn btn-primary" type="button">Load Match</button>
          </div>
        </div>

        <!-- Custom match button (collapsible section) -->
        <div class="card mb-3">
          <div id="customMatch" class="accordion">
            <style type="text/css" media="screen">
              .input-group .input {
                border: 1px solid black;
              }
            </style>
            <div class="accordion-item" style="background-color: #F8F9FA">
              <h2 class="accordion-header">
                <button class="accordion-button text-light bg-secondary" type="button" data-bs-toggle="collapse"
                  data-bs-target="#matchEntry" aria-expanded="false" aria-controls="matchEntry">
                  Enter Custom Match
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
                  <button id="loadCustom" class="btn btn-primary mb-3" type="button">Load Custom Match</button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Match overview card -->
        <div class="card mb-3 p-3" style="background-color: #F8F9FA">
          <h4 id="matchTitle">Match:</h4>
          <h5 id="matchTime">Time:</h5>
          <table class="table table-bordered">
            <thead>
              <style type="text/css" media="screen">
                table tr {
                  border: 1px solid black;
                }

                table td,
                table th {
                  border-right: 1px solid black;
                }
              </style>
              <tr>
                <th class="text-center"></th>
                <th class="text-center">Red</th>
                <th class="text-center">Blue</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="table-secondary">Avg Total Coral</td>
                <td id="redTotalCoral" class="table-danger"></td>
                <td id="blueTotalCoral" class="table-primary"></td>
              </tr>
              <tr>
                <td class="table-secondary">Avg Total Algae</td>
                <td id="redTotalAlgae" class="table-danger"></td>
                <td id="blueTotalAlgae" class="table-primary"></td>
              </tr>
              <tr>
                <td class="table-secondary">Avg Auton Points</td>
                <td id="redAvgAutoPoints" class="table-danger"></td>
                <td id="blueAvgAutoPoints" class="table-primary"></td>
              </tr>
              <tr>
                <td class="table-secondary">Avg Teleop Points</td>
                <td id="redAvgTeleopPoints" class="table-danger"></td>
                <td id="blueAvgTeleopPoints" class="table-primary"></td>
              </tr>
              <tr>
                <td class="table-secondary">Avg Endgame Points</td>
                <td id="redAvgEndgamePoints" class="table-danger"></td>
                <td id="blueAvgEndgamePoints" class="table-primary"></td>
              </tr>
              <tr>
                <td class="table-secondary">Total Predicted Points</td>
                <td id="redTotalPredictedPoints" class="table-danger"></td>
                <td id="blueTotalPredictedPoints" class="table-primary"></td>
              </tr>
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>

  <!-- Team cards -->
  <div class="row mb-3 gx-3">
    <div class="col-lg-4 col-sm-4 col-xs-4 gx-3">
      <div class="card text-white bg-danger mb-3">
        <div class="card-head">
          <div id="R0Flush" class="accordion accordion-flush bg-danger">
            <div class="accordion-item bg-danger">
              <h2 id="flush-headingOne" class="accordion-header bg-danger">
                <div class="row">
                  <div class="col-10">
                    <h5 id="R0TeamNumber" class="card-title text-center">Team #</h5>
                  </div>
                  <div class="col-2">
                    <button class="btn accordion-button collapsed bg-danger btn-sm" type="button" data-bs-toggle="collapse"
                      data-bs-target="#flush-R0Collapse" aria-expanded="false" aria-controls="flush-R0Collapse">
                    </button>
                  </div>
                </div>
              </h2>
              <div id="flush-R0Collapse" class="accordion-collapse collapse show">
                <div id="R0PicsCarousel" class="carousel slide" data-interval="false">
                  <div id="R0RobotPics" class="carousel-inner">
                  </div>
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
            </div>
          </div>
        </div>

        <div class="overflow-auto">
          <table class="table table-bordered table-danger">
            <thead>
              <tr>
                <th colspan="6" class="text-center fs-6">Auton</th>
                <th colspan="8" class="text-center fw-bold fs-6">Teleop</th>
                <th colspan="5" class="text-center fw-bold fs-6">Endgame</th>
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
            <tbody id="R0DataTable">

            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-xs-4 gx-3">
      <div class="card text-white bg-danger mb-3">
        <div class="card-head">
          <div id="R1Flush" class="accordion accordion-flush bg-danger">
            <div class="accordion-item bg-danger">
              <h2 id="flush-headingOne" class="accordion-header bg-danger">
                <div class="row">
                  <div class="col-10">
                    <h5 id="R1TeamNumber" class="card-title text-center">Team #</h5>
                  </div>
                  <div class="col-2">
                    <button class="btn accordion-button collapsed bg-danger btn-sm" type="button" data-bs-toggle="collapse"
                      data-bs-target="#flush-R1Collapse" aria-expanded="false" aria-controls="flush-R1Collapse">

                    </button>
                  </div>
                </div>
              </h2>
              <div id="flush-R1Collapse" class="accordion-collapse collapse show">
                <div id="R1PicsCarousel" class="carousel slide" data-interval="false">
                  <div id="R1RobotPics" class="carousel-inner">

                  </div>
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
            </div>
          </div>
        </div>

        <div class="overflow-auto">
          <table class="table table-bordered table-danger">
            <thead>
              <tr>
                <th colspan="6" class="text-center fs-6">Auton</th>
                <th colspan="8" class="text-center fw-bold fs-6">Teleop</th>
                <th colspan="5" class="text-center fw-bold fs-6">Endgame</th>
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
            <tbody id="R1DataTable">

            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-xs-4 gx-3">
      <div class="card text-white bg-danger mb-3">
        <div class="card-head">
          <div id="R2Flush" class="accordion accordion-flush bg-danger">
            <div class="accordion-item bg-danger">
              <h2 id="flush-headingOne" class="accordion-header bg-danger">
                <div class="row">
                  <div class="col-10">
                    <h5 id="R2TeamNumber" class="card-title text-center">Team #</h5>
                  </div>
                  <div class="col-2">
                    <button class="btn accordion-button collapsed bg-danger btn-sm" type="button" data-bs-toggle="collapse"
                      data-bs-target="#flush-R2Collapse" aria-expanded="false" aria-controls="flush-R2Collapse">

                    </button>
                  </div>
                </div>
              </h2>
              <div id="flush-R2Collapse" class="accordion-collapse collapse show">
                <div id="R2PicsCarousel" class="carousel slide" data-interval="false">
                  <div id="R2RobotPics" class="carousel-inner">

                  </div>
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
            </div>
          </div>
        </div>

        <div class="overflow-auto">
          <table class="table table-bordered table-danger">
            <thead>
              <tr>
                <th colspan="6" class="text-center fs-6">Auton</th>
                <th colspan="8" class="text-center fw-bold fs-6">Teleop</th>
                <th colspan="5" class="text-center fw-bold fs-6">Endgame</th>
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
            <tbody id="R2DataTable">

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="row mb-3 gx-3">
    <div class="col-lg-4 col-sm-4 col-xs-4 gx-3">
      <div class="card text-white bg-primary mb-3">
        <div class="card-head">
          <div id="B0Flush" class="accordion accordion-flush bg-primary">
            <div class="accordion-item bg-primary">
              <h2 id="flush-headingOne" class="accordion-header bg-primary">
                <div class="row">
                  <div class="col-10">
                    <h5 id="B0TeamNumber" class="card-title text-center">Team #</h5>
                  </div>
                  <div class="col-2">
                    <button class="btn accordion-button collapsed bg-primary btn-sm" type="button" data-bs-toggle="collapse"
                      data-bs-target="#flush-B0Collapse" aria-expanded="false" aria-controls="flush-B0Collapse">

                    </button>
                  </div>
                </div>
              </h2>
              <div id="flush-B0Collapse" class="accordion-collapse collapse show">
                <div id="B0PicsCarousel" class="carousel slide" data-interval="false">
                  <div id="B0RobotPics" class="carousel-inner">

                  </div>
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
            </div>
          </div>
        </div>

        <div class="overflow-auto">
          <table class="table table-bordered table-primary">
            <thead>
              <tr>
                <th colspan="6" class="text-center fs-6">Auton</th>
                <th colspan="8" class="text-center fw-bold fs-6">Teleop</th>
                <th colspan="5" class="text-center fw-bold fs-6">Endgame</th>
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
            <tbody id="B0DataTable">

            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-xs-4 gx-3">
      <div class="card text-white bg-primary mb-3">
        <div class="card-head">
          <div id="B1Flush" class="accordion accordion-flush bg-primary">
            <div class="accordion-item bg-primary">
              <h2 id="flush-headingOne" class="accordion-header bg-primary">
                <div class="row">
                  <div class="col-10">
                    <h5 id="B1TeamNumber" class="card-title text-center">Team #</h5>
                  </div>
                  <div class="col-2">
                    <button class="btn accordion-button collapsed bg-primary btn-sm" type="button" data-bs-toggle="collapse"
                      data-bs-target="#flush-B1Collapse" aria-expanded="false" aria-controls="flush-B1Collapse">

                    </button>
                  </div>
                </div>
              </h2>
              <div id="flush-B1Collapse" class="accordion-collapse collapse show">
                <div id="B1PicsCarousel" class="carousel slide" data-interval="false">
                  <div id="B1RobotPics" class="carousel-inner">

                  </div>
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
            </div>
          </div>
        </div>

        <div class="overflow-auto">
          <table class="table table-bordered table-primary">
            <thead>
              <tr>
                <th colspan="6" class="text-center fs-6">Auton</th>
                <th colspan="8" class="text-center fw-bold fs-6">Teleop</th>
                <th colspan="5" class="text-center fw-bold fs-6">Endgame</th>
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
            <tbody id="B1DataTable">

            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-xs-4 gx-3">
      <div class="card text-white bg-primary mb-3">
        <div class="card-head">
          <div id="B2Flush" class="accordion accordion-flush bg-primary">
            <div class="accordion-item bg-primary">
              <h2 id="flush-headingOne" class="accordion-header bg-primary">
                <div class="row">
                  <div class="col-10">
                    <h5 id="B2TeamNumber" class="card-title text-center">Team #</h5>
                  </div>
                  <div class="col-2">
                    <button class="btn accordion-button collapsed bg-primary btn-sm" type="button" data-bs-toggle="collapse"
                      data-bs-target="#flush-B2Collapse" aria-expanded="false" aria-controls="flush-B2Collapse">

                    </button>
                  </div>
                </div>
              </h2>
              <div id="flush-B2Collapse" class="accordion-collapse collapse show">
                <div id="B2PicsCarousel" class="carousel slide" data-interval="false">
                  <div id="B2RobotPics" class="carousel-inner">

                  </div>
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
            </div>
          </div>
        </div>

        <div class="overflow-auto">
          <table class="table table-bordered table-primary">
            <thead>
              <tr>
                <th colspan="6" class="text-center fs-6">Auton</th>
                <th colspan="8" class="text-center fw-bold fs-6">Teleop</th>
                <th colspan="5" class="text-center fw-bold fs-6">Endgame</th>
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
            <tbody id="B2DataTable">

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>

<!-- Javascript page handlers -->

<script>

  var coll = document.getElementsByClassName("collapsible");
  var i;

  for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function () {
      this.classList.toggle("active");
      var content = this.nextElementSibling;
      if (content.style.display === "block") {
        content.style.display = "none";
      } else {
        content.style.display = "block";
      }
    });
  }

  var localMatchData = null;
  var bUsingCustom = false;
  var localMatchList = null;
  var localMatchNum = null;
  var localCompLevel = null;
  var customRedTeam1 = "-";
  var customRedTeam2 = "-";
  var customRedTeam3 = "-";
  var customBlueTeam1 = "-";
  var customBlueTeam2 = "-";
  var customBlueTeam3 = "-";
  var rawMatchData = null;
  var picDB = {};
  var ourTeam = "frc2135";
  var ourMatches = {};

  function checkGet() {
    let sp = new URLSearchParams(window.location.search);
    if (!bUsingCustom) {
      if (sp.has('matchNum') && sp.has('compLevel')) {
        return [sp.get('matchNum'), sp.get('compLevel')];
      }
    }
    if (bUsingCustom) {
      if (sp.has('customRedTeam1') && sp.has('customRedTeam2') && sp.has('customRedTeam3') && sp.has('customBlueTeam1') && sp.has('customBlueTeam2') && sp.has('customBlueTeam3')) {
        return [sp.get('customRedTeam1'), sp.get('customRedTeam2'), sp.get('customRedTeam3'), sp.get('customBlueTeam1'), sp.get('customBlueTeam2'), sp.get('customBlueTeam3')];
      }
    }
    return null;
  }

  function loadMatchData(successFunction) {
    if (!localMatchData) {
      $.get("api/readAPI.php", {
        getAllMatchData: 1
      }).done(function (data) {
        data = JSON.parse(data);
        var mdp = new matchDataProcessor(data);
        mdp.getSiteFilteredAverages(function (averageData) {
          localMatchData = averageData;
          successFunction();
        });
      });
    } else {
      successFunction();
    }
  }

  function createOurMatchTable() {
    var arrOurMatches = [];
    for (let key in ourMatches) {
      arrOurMatches.push(ourMatches[key]);
    }
    // Sort the matches
    // Sort for "p", then "qm", then "sf" then "f" matches
    arrOurMatches.sort(function (matchA, matchB) {
      var Aprefix = matchA["comp_level"];
      var Bprefix = matchB["comp_level"];
      var Anum = matchA["match_number"];
      var Bnum = matchB["match_number"];
      if (Aprefix == Bprefix)
        return (Anum - Bnum);
      if (Aprefix == "p")
        return -1;
      if (Bprefix == "p")
        return 1;
      if (Aprefix == "qm")
        return -1;
      if (Bprefix == "qm")
        return 1;
      if (Aprefix == "sf")
        return -1;
      if (Bprefix == "sf")
        return 1;
      return 1;
    });

    $("#ourMatches").html("");
    var row = '';
    for (let i in arrOurMatches) {
      if (i != 0) {
        row += " ";
      }
      row += '<a class="btn btn-secondary btn-sm m-1" href="./matchSheet.php?matchNum=' + arrOurMatches[i]["match_number"] + '&compLevel=' + arrOurMatches[i]["comp_level"] + '">' + arrOurMatches[i]["comp_level"] + arrOurMatches[i]["match_number"] + '</a>';
    }

    $("#ourMatches").html(row);
  }

  function loadMatchList(successFunction) {
    if (!bUsingCustom) {
      if (!localMatchList) {
        $.get("api/tbaAPI.php", {
          getMatchList: 1
        }).done(function (data) {
          if (data == null)
            alert("Can't load matchlist from TBA; check if TBA Key was set in db_config");
          else {
            rawMatchData = JSON.parse(data)["response"];
            localMatchList = {};
            for (let mi in rawMatchData) {
              var newMatch = {};
              var match = rawMatchData[mi];

              newMatch["comp_level"] = match["comp_level"];
              newMatch["match_number"] = match["match_number"];
              if (match["comp_level"] == "sf")
                newMatch["match_number"] = match["set_number"];

              newMatch["red_teams"] = match["alliances"]["red"]["team_keys"];
              newMatch["blue_teams"] = match["alliances"]["blue"]["team_keys"];
              newMatch["time"] = null;
              if (newMatch["time"] == null && match["actual_time"] != null) {
                newMatch["time"] = match["actual_time"];
              }
              if (newMatch["time"] == null && match["predicted_time"] != null) {
                newMatch["time"] = match["predicted_time"];
              }
              // if (newMatch["time"] == null && match["time"] != null){ newMatch["time"] = match["time"]; }
              localMatchList[makeKey(newMatch["match_number"], newMatch["comp_level"])] = newMatch;

              if (newMatch["red_teams"].includes(ourTeam) || newMatch["blue_teams"].includes(ourTeam)) {
                var keyw = newMatch["comp_level"] + newMatch["match_number"];
                ourMatches[keyw] = newMatch;
              }
            }
            createOurMatchTable();
            successFunction();
          }
        });
      } else {
        successFunction();
      }
    }
    else { // using custom
      localMatchList = {};
      var newMatch = {};
      newMatch["comp_level"] = "qm";
      newMatch["match_number"] = 1;
      newMatch["red_teams"] = [customRedTeam1, customRedTeam2, customRedTeam3];
      newMatch["blue_teams"] = [customBlueTeam1, customBlueTeam2, customBlueTeam3]; //NEW
      newMatch["time"] = "predicted_time"; //NEW
      localMatchList["QM_1"] = newMatch;

      //if (newMatch["red_teams"].includes(ourTeam) || newMatch["blue_teams"].includes(ourTeam)) {
      //ourMatches[newMatch["match_number"]] = newMatch;

      //createOurMatchTable();
      successFunction();
    }
  }

  function makeKey(matchNumber, compLevel) {
    return compLevel.toUpperCase() + "_" + String(matchNumber).toUpperCase();
  }

  function loadMatch(matchNum, compLevel) {
    // Clear Data
    $("#R0DataTable").html("");
    $("#R1DataTable").html("");
    $("#R2DataTable").html("");
    $("#B0DataTable").html("");
    $("#B1DataTable").html("");
    $("#B2DataTable").html("");
    $("#redTotalCoral").html("");
    $("#redTotalAlgae").html("");
    $("#redAvgAutoPoints").html("");
    $("#redAvgTeleopPoints").html("");
    $("#redAvgEndgamePoints").html("");
    $("#redTotalPredictedPoints").html("");
    $("#blueTotalCoral").html("");
    $("#blueTotalAlgae").html("");
    $("#blueAvgAutoPoints").html("");
    $("#blueAvgTeleopPoints").html("");
    $("#blueAvgEndgamePoints").html("");
    $("#blueTotalPredictedPoints").html("");
    $("#R0RobotPics").html("");
    $("#R1RobotPics").html("");
    $("#R2RobotPics").html("");
    $("#B0RobotPics").html("");
    $("#B1RobotPics").html("");
    $("#B2RobotPics").html("");
    picDB = {};
    // Write Match Number
    $("#matchTitle").html("Match " + compLevel + " " + matchNum);
    // Pull Data
    localMatchNum = matchNum;
    localCompLevel = compLevel;
    loadMatchData(function () {
      loadMatchList(processMatchList)
    });
  }

  function loadCustom(redTeam1, redTeam2, redTeam3, blueTeam1, blueTeam2, blueTeam3) {
    // Clear Data
    $("#R0DataTable").html("");
    $("#R1DataTable").html("");
    $("#R2DataTable").html("");
    $("#B0DataTable").html("");
    $("#B1DataTable").html("");
    $("#B2DataTable").html("");
    $("#enterRed1").html("");
    $("#enterRed2").html("");
    $("#enterRed3").html("");
    $("#enterBlue1").html("");
    $("#enterBlue2").html("");
    $("#enterBlue3").html("");
    $("#redTotalCoral").html("");
    $("#redTotalAlgae").html("");
    $("#redAvgAutoPoints").html("");
    $("#redAvgTeleopPoints").html("");
    $("#redAvgEndgamePoints").html("");
    $("#redTotalPredictedPoints").html("");
    $("#blueTotalCoral").html("");
    $("#blueTotalAlgae").html("");
    $("#blueAvgAutoPoints").html("");
    $("#blueAvgTeleopPoints").html("");
    $("#blueAvgEndgamePoints").html("");
    $("#blueTotalPredictedPoints").html("");
    $("#R0RobotPics").html("");
    $("#R1RobotPics").html("");
    $("#R2RobotPics").html("");
    $("#B0RobotPics").html("");
    $("#B1RobotPics").html("");
    $("#B2RobotPics").html("");
    picDB = {};
    // Write Match Number
    //$("#matchTitle").html("Match " + compLevel + " " + matchNum);
    // Pull Data
    customRedTeam1 = redTeam1;
    customRedTeam2 = redTeam2;
    customRedTeam3 = redTeam3;
    customBlueTeam1 = blueTeam1;
    customBlueTeam2 = blueTeam2;
    customBlueTeam3 = blueTeam3;
    loadMatchData(function () {
      loadMatchList(processMatchList)
    });
  }

  function updateTime(time) {
    var date = new Date(time * 1000);
    var hours = date.getHours();
    var suff = "AM";
    if (hours > 12) {
      hours = hours - 12;
      suff = "PM"
    }
    var minutes = "0" + date.getMinutes();
    $("#matchTime").html("Time: " + hours + ":" + minutes.substr(-2) + " " + suff);
  }

  function processMatchList() {
    // Get Match Vector
    if (!bUsingCustom) {
      matchVector = localMatchList[makeKey(localMatchNum, localCompLevel)];
      if (!matchVector) {
        alert(makeKey(localMatchNum, localCompLevel) + " does not exist!");
        return;
      }
    }

    if (bUsingCustom) {
      customMatchVector = localMatchList["QM_1"];
      if (!customMatchVector) {
        alert("This does not exist!");
        return;
      }
    }

    // Update Team Boxes
    if (!bUsingCustom) {
      for (let i in matchVector["red_teams"]) {
        displayTeam("R", i, strTeamToIntTeam(matchVector["red_teams"][i]));
      }
      for (let i in matchVector["blue_teams"]) {
        displayTeam("B", i, strTeamToIntTeam(matchVector["blue_teams"][i]));
      }
    }

    if (bUsingCustom) {
      for (let i in customMatchVector["red_teams"]) {
        displayTeam("R", i, strTeamToIntTeam(customMatchVector["red_teams"][i]));
      }
      for (let i in customMatchVector["blue_teams"]) {
        displayTeam("B", i, strTeamToIntTeam(customMatchVector["blue_teams"][i]));
      }
    }
    // Update Summary Box
    if (!bUsingCustom) {
      updateSummary(matchVector["red_teams"], matchVector["blue_teams"]);

      // Request Team Pics
      sendPicRequest(matchVector["red_teams"], matchVector["blue_teams"]);

      // Update Time
      updateTime(matchVector["time"]);
    }
    if (bUsingCustom) {
      updateSummary(customMatchVector["red_teams"], customMatchVector["blue_teams"]);
      // Request Team Pics
      sendPicRequest(customMatchVector["red_teams"], customMatchVector["blue_teams"]);
    }
  }

  function updateSummary(redList, blueList) {
    var avgTotalCoral = {
      "red": 0,
      "blue": 0
    };
    var avgTotalAlgae = {
      "red": 0,
      "blue": 0
    };
    var avgAutoPoints = {
      "red": 0,
      "blue": 0
    };
    var avgTeleopPoints = {
      "red": 0,
      "blue": 0
    };
    var avgEndgamePoints = {
      "red": 0,
      "blue": 0
    };
    var totalPredictedPoints = {
      "red": 0,
      "blue": 0
    };

    for (let i in redList) {
      teamNum = strTeamToIntTeam(redList[i]);
      var rd = localMatchData[teamNum];
      if (rd != null) {
        avgTotalCoral["red"] += rd["avgTotalCoral"];
        avgTotalAlgae["red"] += rd["avgTotalAlgae"];
        avgAutoPoints["red"] += rd["avgTotalAutoPoints"];
        avgTeleopPoints["red"] += rd["avgTotalTeleopPoints"];
        avgEndgamePoints["red"] += rd["avgEndgamePoints"];
        totalPredictedPoints["red"] += rd["avgTotalPoints"];
      }
    }
    for (let i in blueList) {
      teamNum = strTeamToIntTeam(blueList[i]);
      var rd = localMatchData[teamNum];
      if (rd != null) {
        avgTotalCoral["blue"] += rd["avgTotalCoral"];
        avgTotalAlgae["blue"] += rd["avgTotalAlgae"];
        avgAutoPoints["blue"] += rd["avgTotalAutoPoints"];
        avgTeleopPoints["blue"] += rd["avgTotalTeleopPoints"];
        avgEndgamePoints["blue"] += rd["avgEndgamePoints"];
        totalPredictedPoints["blue"] += rd["avgTotalPoints"];
      }
    }

    $("#redTotalCoral").html(roundInt(avgTotalCoral["red"]));
    $("#redTotalAlgae").html(roundInt(avgTotalAlgae["red"]));
    $("#redAvgAutoPoints").html(roundInt(avgAutoPoints["red"]));
    $("#redAvgTeleopPoints").html(roundInt(avgTeleopPoints["red"]));
    $("#redAvgEndgamePoints").html(roundInt(avgEndgamePoints["red"]));
    $("#redTotalPredictedPoints").html(roundInt(totalPredictedPoints["red"]));

    $("#blueTotalCoral").html(roundInt(avgTotalCoral["blue"]));
    $("#blueTotalAlgae").html(roundInt(avgTotalAlgae["blue"]));
    $("#blueAvgAutoPoints").html(roundInt(avgAutoPoints["blue"]));
    $("#blueAvgTeleopPoints").html(roundInt(avgTeleopPoints["blue"]));
    $("#blueAvgEndgamePoints").html(roundInt(avgEndgamePoints["blue"]));
    $("#blueTotalPredictedPoints").html(roundInt(totalPredictedPoints["blue"]));

    document.getElementById("redTotalCoral").setAttribute("align", "center");
    document.getElementById("redTotalAlgae").setAttribute("align", "center");
    document.getElementById("redAvgAutoPoints").setAttribute("align", "center");
    document.getElementById("redAvgTeleopPoints").setAttribute("align", "center");
    document.getElementById("redAvgEndgamePoints").setAttribute("align", "center");
    document.getElementById("redTotalPredictedPoints").setAttribute("align", "center");

    document.getElementById("blueTotalCoral").setAttribute("align", "center");
    document.getElementById("blueTotalAlgae").setAttribute("align", "center");
    document.getElementById("blueAvgAutoPoints").setAttribute("align", "center");
    document.getElementById("blueAvgTeleopPoints").setAttribute("align", "center");
    document.getElementById("blueAvgEndgamePoints").setAttribute("align", "center");
    document.getElementById("blueTotalPredictedPoints").setAttribute("align", "center");
  }

  function roundInt(val) {
    return Math.round((val + Number.EPSILON) * 100) / 100;
  }

  function displayTeam(color, index, teamNum) {
    // Get team name from TBA
    $.get("api/tbaAPI.php", {
      getTeamInfo: teamNum
    }).done(function (data) {
      var teamname = "XX";
      if (data == null)
        alert("Can't load teamName from TBA; check if TBA Key was set in db_config");
      else {
        console.log("matchSheet: getTeamInfo: data = " + data);
        teamInfo = JSON.parse(data)["response"];
        teamname = teamInfo["nickname"];
        console.log("matchSheet: for " + teamNum + ", teamname = " + teamname);
      }
      if (teamname != "XX") {
        $("#" + color + index + "TeamNumber").html("<a class='text-white' href='teamLookup.php?teamNum=" + teamNum + "'>" + teamNum + "</a> - " + teamname);
      } else {
        $("#" + color + index + "TeamNumber").html("<a class='text-white' href='teamLookup.php?teamNum=" + teamNum + "'>" + teamNum + "</a>");
      }
    });

    // Load team scouted information
    var rd = localMatchData[teamNum];
    if (rd != null) {
      var row = "<tr>";
      row += "<td align=\"center\">" + rd["avgAutonCoralL1"] + "</td>";
      row += "<td align=\"center\">" + rd["avgAutonCoralL2"] + "</td>";
      row += "<td align=\"center\">" + rd["avgAutonCoralL3"] + "</td>";
      row += "<td align=\"center\">" + rd["avgAutonCoralL4"] + "</td>";
      row += "<td align=\"center\">" + rd["avgAutonAlgaeNet"] + "</td>";
      row += "<td align=\"center\">" + rd["avgAutonAlgaeProc"] + "</td>";
      row += "<td align=\"center\">" + rd["teleopCoralScoringPercent"] + "</td>";
      row += "<td align=\"center\">" + rd["avgTeleopCoralL1"] + "</td>";
      row += "<td align=\"center\">" + rd["avgTeleopCoralL2"] + "</td>";
      row += "<td align=\"center\">" + rd["avgTeleopCoralL3"] + "</td>";
      row += "<td align=\"center\">" + rd["avgTeleopCoralL4"] + "</td>";
      row += "<td align=\"center\">" + rd["teleopAlgaeScoringPercent"] + "</td>";
      row += "<td align=\"center\">" + rd["avgTeleopAlgaeNet"] + "</td>";
      row += "<td align=\"center\">" + rd["avgTeleopAlgaeProc"] + "</td>";
      row += "<td align=\"center\">" + rd["endgameClimbPercent"][0] + "</td>";
      row += "<td align=\"center\">" + rd["endgameClimbPercent"][1] + "</td>";
      row += "<td align=\"center\">" + rd["endgameClimbPercent"][2] + "</td>";
      row += "<td align=\"center\">" + rd["endgameClimbPercent"][3] + "</td>";
      row += "<td align=\"center\">" + rd["endgameClimbPercent"][4] + "</td>";
      row += "</tr>";
    }
    $("#" + color + index + "DataTable").append(row);
  }

  function sendPicRequest(redList, blueList) {
    var requestList = [];
    for (let i in redList) {
      var tn = strTeamToIntTeam(redList[i]);
      if (tn !== "") {
        picDB[tn] = "R" + i;
        requestList.push(tn);
      }
    }
    for (let i in blueList) {
      var tn = strTeamToIntTeam(blueList[i]);
      if (tn !== "") {
        picDB[tn] = "B" + i;
        requestList.push(tn);
      }
    }

    $.get("api/readAPI.php", {
      getTeamsImages: JSON.stringify(requestList)
    }).done(function (data) {
      var teamImages = JSON.parse(data);
      for (var team of Object.keys(teamImages)) {
        loadTeamPics(picDB[team], teamImages[team]);
      }
    });
  }

  function loadTeamPics(prefix, teamPics) {
    /* Takes list of Team Pic paths and loads them */
    var first = true;
    for (let uri of teamPics) {
      var tags = "";
      if (first) {
        tags += "<div class='carousel-item active'>";
      } else {
        tags += "<div class='carousel-item'>";
      }
      first = false;
      tags += "  <img src='./" + uri + "' class='d-block w-100'>";
      tags += "</div>";
      $("#" + prefix + "RobotPics").append(tags);
    }
  }

  function strTeamToIntTeam(team) {
    return team.replace(/^(frc)/, '');
  }

  //
  // Process the generated html
  //
  $(document).ready(function () {
    // Update the navbar with the event code
    $.get("api/tbaAPI.php", {
      getEventCode: true
    }, function (data) {
      $("#navbarEventCode").html(data);
    });

    var initialGet = checkGet();
    if (initialGet) {
      loadMatch(initialGet[0], initialGet[1]);
    }
    // Load all the match sheet data
    $("#loadMatch").click(function () {
      bUsingCustom = false;
      loadMatch($("#enterMatchNumber").val(), $("#enterMatchLevel").val());
    });

    // Open and set the custom settings
    $("#loadCustom").click(function () {
      bUsingCustom = true;
      var redTeamNum1 = document.getElementById("enterRed1").value;
      var blueTeamNum1 = document.getElementById("enterBlue1").value;
      console.log(redTeamNum1);
      console.log(blueTeamNum1);
      if (redTeamNum1.trim() == "" && blueTeamNum1.trim() == "") {
        alert("Please fill out Red Team Number 1 and Blue Team Number 1!");
        return false;
      }
      else if (redTeamNum1.trim() !== "" && blueTeamNum1.trim() !== "") {
        loadCustom($("#enterRed1").val(), $("#enterRed2").val(), $("#enterRed3").val(), $("#enterBlue1").val(), $("#enterBlue2").val(), $("#enterBlue3").val());
      }
      else {
        alert("Please fill out red team number 1 and blue team number 1!");
      }
    });

    loadMatchList(function () { });
  });

</script>

<script type="text/javascript" src="./scripts/matchDataProcessor.js"></script>
