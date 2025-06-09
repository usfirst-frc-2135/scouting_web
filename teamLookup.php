<?php
$title = 'Team Lookup';
require 'header.php';
?>

<div class="container row-offcanvas row-offcanvas-left">
  <div id="content" class="column card-lg-12 col-sm-12 col-xs-12">

    <!-- Page Title -->
    <div class="row pt-3 pb-3 mb-3">
      <h2><?php echo $title; ?></h2>
    </div>

    <!-- Main row to hold the team lookup form -->
    <div class="row mb-3">
      <div class="input-group mb-3">
        <input id="enterTeamNumber" class="form-control" type="text" placeholder="FRC team number" aria-label="Team Number">
        <button id="loadTeamButton" class="btn btn-primary" type="button">Load Team</button>
      </div>

      <!-- First column of data starts here -->
      <div class="col-lg-6 col-sm-6 col-xs-6 gx-3">
        <div class="card mb-3">
          <div class="card-body">
            <h5 id="teamTitle" class="card-title">Team # </h5>
            <!-- Robot photo carousel section -->
            <div id="robotPicsCarousel" class="carousel slide mb-3" data-bs-ride="carousel">
              <div id="robotPics" class="carousel-inner">

              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#robotPicsCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#robotPicsCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>

            <!-- Auton collapsible graph -->
            <div class="card mb-3">
              <div class="card-body">
                <div class="overflow-auto">
                  <h5 class="text-center">
                    <a href="#collapseAutonCoralGraph" data-bs-toggle="collapse" aria-expanded="false"> Auton Coral Graph</a>
                  </h5>
                  <div id="collapseAutonCoralGraph" class="collapse">
                    <canvas id="autoChart" width="400" height="360"></canvas>
                  </div>
                </div>
              </div>
            </div>

            <!-- Teleop collapsible graph -->
            <div class="card mb-3">
              <div class="card-body">
                <div class="overflow-auto">
                  <h5 class="text-center">
                    <a href="#collapseTeleopCoralGraph" data-bs-toggle="collapse" aria-expanded="false"> Teleop Coral Graph</a>
                  </h5>
                  <div id="collapseTeleopCoralGraph" class="collapse">
                    <canvas id="teleopChart" width="400" height="360"></canvas>
                  </div>
                </div>
              </div>
            </div>

            <!-- Endgame collapsible graph -->
            <div class="card mb-3">
              <div class="card-body">
                <div class="overflow-auto">
                  <h5 class="text-center">
                    <a href="#collapseEndgameGraph" data-bs-toggle="collapse" aria-expanded="false"> Endgame Graph</a>
                  </h5>
                  <div id="collapseEndgameGraph" class="collapse">
                    <canvas id="endgameChart" width="400" height="360"></canvas>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <!-- here -->
        </div>
      </div>

      <!-- Second Column of Data starts here -->
      <div class="col-lg-6 col-sm-6 col-xs-6 gx-3">
        <div class="card mb-3">
          <div class="card-body">

            <!-- Match Total Points section -->
            <div class="card mb-3">
              <div class="card-body">
                <div class="overflow-auto">
                  <h5 class="text-center">Match Totals </h5>
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <td>&nbsp;</td>
                        <th scope="col">AVG</th>
                        <th scope="col">MAX</th>
                      </tr>
                    </thead>
                    <tbody id="totalTable">
                      <tr>
                        <th scope="row">Total Coral Scored</th>
                      </tr>
                      <tr>
                        <th scope="row">Total Algae Scored</th>
                      </tr>
                      <tr>
                        <th scope="row">Total Coral Points</th>
                      </tr>
                      <tr>
                        <th scope="row">Total Algae Points</th>
                      </tr>
                    </tbody>
                    <tfoot id="matchTotalTable">
                  </table>
                </div>
              </div>
            </div>

            <!-- Auton Points section -->
            <div class="card mb-3">
              <div class="card-header">
                <div class="overflow-auto">
                  <h5 class="text-center"> <a href="#collapseAuton" data-bs-toggle="collapse" aria-expanded="false"> Auton </a>
                  </h5>
                  <div id="collapseAuton" class="collapse">
                    <div class="card card-body">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <td>&nbsp;</td>
                            <th scope="col">AVG</th>
                            <th scope="col">MAX</th>
                          </tr>
                        </thead>
                        <tbody id="autoTable">
                          <tr>
                            <th scope="row">Total Points</th>
                          </tr>
                          <tr>
                            <th scope="row">Total Coral Scored</th>
                          </tr>
                          <tr>
                            <th scope="row">Total Algae Scored</th>
                          </tr>
                          <tr>
                            <th scope="row">Total Coral Points</th>
                          </tr>
                          <tr>
                            <th scope="row">Total Algae Points</th>
                          </tr>
                        </tbody>
                        <tfoot id="autoTotalTable">
                          <tr>
                            <th scope="col">Total Notes</th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Teleop Points section -->
            <div class="card mb-3">
              <div class="card-header">
                <div class="overflow-auto">
                  <h5 class="text-center"> <a href="#collapseTeleop" data-bs-toggle="collapse" aria-expanded="false"> Teleop </a>
                  </h5>
                  <div id="collapseTeleop" class="collapse">
                    <div class="card card-body">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <td>&nbsp;</td>
                            <th scope="col">AVG</th>
                            <th scope="col">MAX</th>
                          </tr>
                        </thead>
                        <tbody id="teleopTable">
                          <tr>
                            <th scope="row">Total Points</th>
                          </tr>
                          <tr>
                            <th scope="row">Total Coral Scored</th>
                          </tr>
                          <tr>
                            <th scope="row">Total Algae Scored</th>
                          </tr>
                          <tr>
                            <th scope="row">Total Coral Points</th>
                          </tr>
                          <tr>
                            <th scope="row">Total Algae Points</th>
                          </tr>
                          <tr>
                            <th scope="row">Coral Acc%</th>
                          </tr>
                          <tr>
                            <th scope="row">Algae Acc%</th>
                          </tr>
                        </tbody>
                        <tfoot id="teleopTotalTable">
                        </tfoot>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Endgame Points section -->
            <div class="card mb-3">
              <div class="card-header">
                <div class="overflow-auto">
                  <h5 class="text-center"> <a href="#collapseEndgame" data-bs-toggle="collapse" aria-expanded="false"> Endgame
                    </a>
                  </h5>
                  <div id="collapseEndgame" class="collapse">
                    <div class="card card-body">
                      <table class="table">
                        <thead>
                          <tr>
                            <td>&nbsp;</td>
                            <th scope="col">AVG</th>
                            <th scope="col">MAX</th>
                          </tr>
                        </thead>
                        <tbody id="endgameTotalPtsTable">
                          <tr>
                            <th scope="row">Total Points</th>
                          </tr>
                        </tbody>
                        <thead>
                          <tr>
                            <td>&nbsp;</td>
                            <th scope="col">N</th>
                            <th scope="col">P</th>
                            <th scope="col">F</th>
                            <th scope="col">S</th>
                            <th scope="col">D</th>
                          </tr>
                        </thead>
                        <tbody id="endgameClimbTable">
                          <tr>
                            <th scope="row">Cage Climb %</th>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Strategic Data collapsible table -->
        <div class="card mb-3">
          <div class="card-body">
            <div class="overflow-auto">
              <h5 class="text-center">
                <a href="#collapseStrategicData" data-bs-toggle="collapse" aria-expanded="false"> Strategic Data </a>
              </h5>
              <div id="collapseStrategicData" class="collapse">
                <div id="freeze-table-2" class="freeze-table overflow-auto">
                  <style type="text/css" media="screen">
                    table tr {
                      border: 1px solid black;
                    }

                    table td,
                    table th {
                      border-right: 1px solid black;
                    }
                  </style>
                  <table id="sortableStrategicData" class="table table-striped table-hover sortable">
                    <colgroup>
                      <col span="2" style="background-color:transparent">
                      <col span="1" style="background-color:#cfe2ff">
                      <col span="1" style="background-color:transparent">
                      <col span="1" style="background-color:#cfe2ff">
                      <col span="1" style="background-color:transparent">
                      <col span="1" style="background-color:#cfe2ff">
                      <col span="1" style="background-color:#transparent">
                      <col span="1" style="background-color:#cfe2ff">
                      <col span="1" style="background-color:transparent">
                      <col span="1" style="background-color:#cfe2ff">
                      <col span="1" style="background-color:#transparent">
                      <col span="1" style="background-color:#cfe2ff">
                      <col span="1" style="background-color:#transparent">
                      <col span="1" style="background-color:#cfe2ff">
                      <col span="1" style="background-color:#transparent">
                      <col span="1" style="background-color:#cfe2ff">
                      <col span="1" style="background-color:#transparent">
                      <col span="1" style="background-color:#cfe2ff">
                      <col span="1" style="background-color:#transparent">
                      <col span="1" style="background-color:#cfe2ff">
                      <col span="1" style="background-color:#transparent">
                      <col span="1" style="background-color:#cfe2ff">
                      <col span="1" style="background-color:#transparent">
                      <col span="1" style="background-color:#cfe2ff">
                      <col span="1" style="background-color:#transparent">
                      <col span="1" style="background-color:#cfe2ff">
                    </colgroup>
                    <thead>
                      <style type="text/css" media="screen">
                        #sortableStrategicData tr,
                        #sortableStrategicData td,
                        #sortableStrategicData th {
                          border: 1px solid black;
                        }
                      </style>
                      <tr>
                        <th colspan="1"> </th>
                        <th colspan="24" class="text-center">Strategic Scouting Data</th>
                      </tr>
                      <tr>
                        <th colspan="1"> </th>
                        <th colspan="1"> </th>
                        <th colspan="24" class="text-center">Table</th>
                      </tr>
                      <tr>
                        <th colspan="1"> </th>
                        <th colspan="1"> </th>
                        <th colspan="2" class="text-center" style="background-color:#3686FF">Against Defense</th>
                        <th colspan="3" class="text-center">Defense Tactics</th>
                        <th colspan="8" class="text-center" style="background-color:#3686FF">Fouls</th>
                        <th colspan="4" class="text-center">Auton</th>
                        <th colspan="4" class="text-center" style="background-color:#3686FF">Teleop</th>
                        <th colspan="2" class="text-center">Notes</th>
                        <th colspan="1"> </th>
                      </tr>
                      <tr>
                        <th scope="col">Match</th>
                        <th scope="col">Drive Skill</th>
                        <th scope="col">Block</th>
                        <th scope="col">Note</th>
                        <th scope="col">Block Path</th>
                        <th scope="col">Block Stn</th>
                        <th scope="col">Note</th>
                        <th scope="col">Pin</th>
                        <th scope="col">Auton Barge Contact</th>
                        <th scope="col">Auton Cage Contact</th>
                        <th scope="col">Anchor Contact</th>
                        <th scope="col">Barge Contact</th>
                        <th scope="col">Reef Contact</th>
                        <th scope="col">Cage Contact</th>
                        <th scope="col">Contact Climbing Robot</th>
                        <th scope="col">Get Floor Coral</th>
                        <th scope="col">Get Stn Coral</th>
                        <th scope="col">Get Floor Algae</th>
                        <th scope="col">Get Reef Algae</th>
                        <th scope="col">Get Floor Coral</th>
                        <th scope="col">Get Floor Algae</th>
                        <th scope="col">Knock Algae</th>
                        <th scope="col">Aquire Reef Algae</th>
                        <th scope="col">Problem Note</th>
                        <th scope="col">General Note</th>
                        <th scope="col">Scout Name</th>
                      </tr>
                    </thead>
                    <tbody id="strategicDataTable">
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="card mb-3">
          <div class="card-body">
            <div class="overflow-auto">
              <h5 class="text-center">
                <a href="#collapsePitData" data-bs-toggle="collapse" aria-expanded="false"> Pit Data </a>
              </h5>
            </div>
            <!-- Pit Scouting 1st row -->
            <div id="collapsePitData" class="collapse">
              <div class="overflow-auto">
                <table class="table table-striped">
                  <thead>
                    <colgroup>
                      <col span="1" style="background-color:transparent">
                      <col span="1" style="background-color:#cfe2ff">
                      <col span="1" style="background-color:transparent">
                      <col span="1" style="background-color:#cfe2ff">
                      <col span="1" style="background-color:transparent">
                    </colgroup>
                    <tr>
                      <th scope="col" style="width:25%">Batt</th>
                      <th scope="col" style="width:25%">Pit</th>
                      <th scope="col" style="width:25%">Spare Parts</th>
                      <th scope="col" style="width:25%">Vision</th>
                    </tr>
                  </thead>
                  <tbody id="pitRow1">
                  </tbody>
                </table>
              </div>

              <!-- Pit Scouting 2nd row -->
              <div class="overflow-auto">
                <table class="table table-striped">
                  <thead>
                    <colgroup>
                      <col span="1" style="background-color:transparent">
                      <col span="1" style="background-color:#cfe2ff">
                      <col span="1" style="background-color:transparent">
                      <col span="1" style="background-color:#cfe2ff">
                      <col span="1" style="background-color:transparent">
                      <col span="1" style="background-color:#cfe2ff">
                    </colgroup>
                    <tr>
                      <th scope="col" style="width:25%">Drive Motors</th>
                      <th scope="col" style="width:25%">Prep</th>
                      <th scope="col" style="width:25%">Swerve</th>
                      <th scope="col" style="width:25%">Lang</th>
                    </tr>
                  </thead>
                  <tbody id="pitRow2">
                  </tbody>
                </table>
              </div>

              <!-- Comments section -->
              <div class="overflow-auto">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">Comments</th>
                      <th scope="col">Scout</th>
                    </tr>
                  </thead>
                  <tbody id="comments">
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <!-- All Matches collapsible table -->
        <div class="card mb-3">
          <div class="card-body">
            <div class="overflow-auto">
              <h5 class="text-center">
                <a href="#collapseAllMatches" data-bs-toggle="collapse" aria-expanded="false"> All Matches </a>
              </h5>
              <div id="collapseAllMatches" class="collapse">
                <div id="freeze-table" class="freeze-table overflow-auto">
                  <style type="text/css" media="screen">
                    table tr {
                      border: 1px solid black;
                    }

                    table td,
                    table th {
                      border-right: 1px solid black;
                    }
                  </style>
                  <table id="sortableAllMatches" class="table table-striped table-hover sortable">
                    <colgroup>
                      <col span="2" style="background-color:transparent">
                      <col span="1" style="background-color:#cfe2ff">
                      <col span="1" style="background-color:transparent">
                      <col span="1" style="background-color:#cfe2ff">
                      <col span="1" style="background-color:transparent">
                      <col span="1" style="background-color:#cfe2ff">
                      <col span="1" style="background-color:#transparent">
                      <col span="1" style="background-color:#cfe2ff">
                      <col span="1" style="background-color:transparent">
                      <col span="1" style="background-color:#cfe2ff">
                      <col span="1" style="background-color:#transparent">
                      <col span="1" style="background-color:#cfe2ff">
                      <col span="1" style="background-color:#transparent">
                      <col span="1" style="background-color:#cfe2ff">
                      <col span="1" style="background-color:#transparent">
                      <col span="1" style="background-color:#cfe2ff">
                      <col span="1" style="background-color:#transparent">
                      <col span="1" style="background-color:#cfe2ff">
                      <col span="1" style="background-color:#transparent">
                      <col span="1" style="background-color:#cfe2ff">
                    </colgroup>
                    <thead>
                      <style type="text/css" media="screen">
                        #sortableAllMatches tr,
                        #sortableAllMatches td,
                        #sortableAllMatches th {
                          border: 1px solid black;
                        }
                      </style>
                      <tr>
                        <th scope="col">Match</th>
                        <th scope="col">Auton Leave</th>
                        <th scope="col">Auton Coral L1</th>
                        <th scope="col">Auton Coral L2</th>
                        <th scope="col">Auton Coral L3</th>
                        <th scope="col">Auton Coral L4</th>
                        <th scope="col">Auton Algae Net</th>
                        <th scope="col">Auton Algae Proc</th>
                        <th scope="col">Acquired Coral</th>
                        <th scope="col">Acquired Algae</th>
                        <th scope="col">Teleop Coral L1</th>
                        <th scope="col">Teleop Coral L2</th>
                        <th scope="col">Teleop Coral L3</th>
                        <th scope="col">Teleop Coral L4</th>
                        <th scope="col">Teleop Algae Net</th>
                        <th scope="col">Teleop Algae Proc</th>
                        <th scope="col">Cage Climb</th>
                        <th scope="col">Died</th>
                        <th scope="col">Scout Name</th>
                      </tr>
                    </thead>
                    <tbody id="allMatchesTable">
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>

<!-- Javascript page handlers -->

<script>
  var frozenTableMatches = null;
  var frozenTableStrategy = null;

  var autoChartDefined = false;
  var autoChart;

  var teleopChartDefined = false;
  var teleopChart;

  var endgameChartDefined = false;
  var endgameChart;

  function writeTableRow(tbodyID, dict, keys) {
    var row = "<tr>";
    for (let i = 0; i < keys.length; i++) {
      row += "<td>" + dict[keys[i]] + "</td>";
    }
    row += "</tr>";
    $("#" + tbodyID).append(row);
  }

  function dataToCommentTable(commentObj) {
    for (let i = 0; i < commentObj.length; i++) {
      if (commentObj[i].comment === "-") {
        continue;
      }
      writeTableRow("comments", commentObj[i], ["comment", "scoutname"]);
    }
  }

  function dataToAvgTables(avgs) {
    console.log("==> teamLookup.php: dataToAvgTables()");

    //Auton Table  
    avgs["autonpointsstr"] = "<b>Total Points</b>";
    avgs["autontotalcoralstr"] = "<b>Total Coral Scored</b>";
    avgs["autontotalalgaestr"] = "<b>Total Algae Scored</b>";
    avgs["autoncoralpointsstr"] = "<b>Total Coral Points</b>";
    avgs["autonalgaepointsstr"] = "<b>Total Algae Points</b>";

    writeTableRow("autoTable", avgs, ["autonpointsstr", "avgTotalAutoPoints", "maxTotalAutoPoints"]);
    writeTableRow("autoTable", avgs, ["autontotalcoralstr", "avgAutonCoral", "maxAutonCoral"]);
    writeTableRow("autoTable", avgs, ["autontotalalgaestr", "avgAutonAlgae", "maxAutonAlgae"]);
    writeTableRow("autoTable", avgs, ["autoncoralpointsstr", "avgTotalAutoCoralPoints", "maxTotalAutoCoralPoints"]);
    writeTableRow("autoTable", avgs, ["autonalgaepointsstr", "avgTotalAutoAlgaePoints", "maxTotalAutoAlgaePoints"]);

    // Teleop Table

    avgs["teleoppointsstr"] = "<b>Total Points</b>";
    avgs["teleoptotalcoralstr"] = "<b>Total Coral Scored</b>";
    avgs["teleoptotalalgaestr"] = "<b>Total Algae Scored</b>";
    avgs["teleopcoralpointsstr"] = "<b>Total Coral Points</b>";
    avgs["teleopalgaepointsstr"] = "<b>Total Algae Points</b>";
    avgs["teleopcoralaccuracystr"] = "<b>Coral Acc%</b>";
    avgs["teleopalgaeaccuracysstr"] = "<b>Algae Acc%</b>";

    writeTableRow("teleopTable", avgs, ["teleoppointsstr", "avgTotalTeleopPoints", "maxTotalTeleopPoints"]);
    writeTableRow("teleopTable", avgs, ["teleoptotalcoralstr", "avgTeleopCoralScored", "maxTeleopCoralScored"]);
    writeTableRow("teleopTable", avgs, ["teleoptotalalgaestr", "avgTeleopAlgaeScored", "maxTeleopAlgaeScored"]);
    writeTableRow("teleopTable", avgs, ["teleopcoralpointsstr", "avgTotalTeleopCoralPoints", "maxTotalTeleopCoralPoints"]);
    writeTableRow("teleopTable", avgs, ["teleopalgaepointsstr", "avgTotalTeleopAlgaePoints", "maxTotalTeleopAlgaePoints"]);
    writeTableRow("teleopTable", avgs, ["teleopcoralaccuracystr", "teleopCoralScoringPercent"]);
    writeTableRow("teleopTable", avgs, ["teleopalgaeaccuracysstr", "teleopAlgaeScoringPercent"]);

    /////// Endgame Table
    avgs["totalEndGamePointsstr"] = "<b>Total Points</b>";
    avgs["endgameClimbPercent"]["endgameclimbstr"] = "<b>Cage Climb %</b>";

    writeTableRow("endgameTotalPtsTable", avgs, ["totalEndGamePointsstr", "avgEndgamePoints", "maxEndgamePoints"]);
    writeTableRow("endgameClimbTable", avgs["endgameClimbPercent"], ["endgameclimbstr", 0, 1, 2, 3, 4]);

    /////// Total Table
    avgs["totalCoralstr"] = "<b>Total Coral Scored</b>";
    avgs["totalAlgaestr"] = "<b>Total Algae Scored</b>";
    avgs["totalCoralPointsstr"] = "<b>Total Coral Points</b>";
    avgs["totalAlgaePointsstr"] = "<b>Total Algae Points</b>";

    writeTableRow("totalTable", avgs, ["totalCoralstr", "avgTotalCoral", "maxTotalCoral"]);
    writeTableRow("totalTable", avgs, ["totalAlgaestr", "avgTotalAlgae", "maxTotalAlgae"]);
    writeTableRow("totalTable", avgs, ["totalCoralPointsstr", "avgTotalCoralPoints", "maxTotalCoralPoints"]);
    writeTableRow("totalTable", avgs, ["totalAlgaePointsstr", "avgTotalAlgaePoints", "maxTotalAlgaePoints"]);
  }

  // Check if our URL directs to a specific team
  function checkGet() {
    console.log("==> teamLookup.php: checkGet()");
    let sp = new URLSearchParams(window.location.search);
    if (sp.has('teamNum')) {
      return sp.get('teamNum')
    }
    return null;
  }

  function loadTeamPics(teamPics) {
    console.log("==> teamLookup.php: loadTeamPics()");
    // Takes list of Team Pic paths and loads them.
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
      $("#robotPics").append(tags);
    }
  }

  // filters out the match type as specified in the db status page
  function getFilteredData(team, successFunction) {
    console.log("==> teamLookup.php: loadTeamPics(): " + team);
    var tempThis = this;
    $.post("api/dbAPI.php",
      {
        "getDBStatus": true
      }, function (dbStatus) {
        console.log("==> getDBStatus");
        dbdata = JSON.parse(dbStatus);
        var localSiteFilter = {};
        localSiteFilter["useP"] = dbdata["useP"];
        localSiteFilter["useQm"] = dbdata["useQm"];
        localSiteFilter["useQf"] = dbdata["useQf"];
        localSiteFilter["useSf"] = dbdata["useSf"];
        localSiteFilter["useF"] = dbdata["useF"];
        //tempThis.siteFilter = { ...localSiteFilter };
        //          console.log(">>> useP = " + localSiteFilter["useP"]);
        //          console.log(">>> useQm = " + localSiteFilter["useQm"]);
        //tempThis.applySiteFilter();
        $.get("api/readAPI.php", {
          getTeamData: team
        }).done(function (matchData) {
          console.log("==> getTeamData");
          matchData = JSON.parse(matchData);

          var newData = [];
          for (var i = 0; i < matchData.length; i++) {
            var mn = matchData[i]["matchnumber"];
            var mt = "-";
            var matchStr = mn.toLowerCase();
            if (matchStr.search("p") != -1) {
              mt = "p";
            }
            else if (matchStr.search("qm") != -1) {
              mt = "qm";
            }
            else if (matchStr.search("qf") != -1) {
              mt = "qf";
            }
            else if (matchStr.search("sf") != -1) {
              mt = "sf";
            }
            else if (matchStr.search("f") != -1) {
              mt = "f";
            }

            if (mt == "p" && localSiteFilter["useP"]) { newData.push(matchData[i]); }
            else if (mt == "qm" && localSiteFilter["useQm"]) { newData.push(matchData[i]); }
            else if (mt == "qf" && localSiteFilter["useQf"]) { newData.push(matchData[i]); }
            else if (mt == "sf" && localSiteFilter["useSf"]) { newData.push(matchData[i]); }
            else if (mt == "f" && localSiteFilter["useF"]) { newData.push(matchData[i]); }
          }
          matchData = [...newData];

          successFunction(matchData);
        });
      });
  }

  function sortAllMatchesTable() {
    var table = document.getElementById("sortableAllMatches");
    var rows = Array.prototype.slice.call(table.querySelectorAll("tbody> tr"));
    rows.sort(function (rowA, rowB) {
      var cellA = rowA.cells[0].textContent.trim();
      var cellB = rowB.cells[0].textContent.trim();
      return (sortRows(cellA, cellB));
    });
    // Update the table body with the sorted rows.
    rows.forEach(function (row) {
      table.querySelector("tbody").appendChild(row);
    });
  }

  function sortStrategicDataTable() {
    var table = document.getElementById("sortableStrategicData");
    var rows = Array.prototype.slice.call(table.querySelectorAll("tbody> tr"));
    rows.sort(function (rowA, rowB) {
      var cellA = rowA.cells[0].textContent.trim();
      var cellB = rowB.cells[0].textContent.trim();
      return (sortRows(cellA, cellB));
    });
    // Update the table body with the sorted rows.
    rows.forEach(function (row) {
      table.querySelector("tbody").appendChild(row);
    });
  }

  // Returns 0 if rowA is before rowB; else returns 1. Assumes the row has a "matchnum" key
  // that is <prefix><number>, where prefix is "p", "qm" or "sf".
  function sortRows(cellA, cellB) {

    // Pull apart prefix and number from matchnum (ie, "p", "qm", "sf")
    var Aprefix = "";
    var Anum = "";
    var Bprefix = "";
    var Bnum = "";
    if (cellA.charAt(0) == "p") {
      Anum = cellA.substr(1, cellA.length);
      Aprefix = "p";
    }
    else if (cellA.charAt(0) == "q") {   // "qm"
      Anum = cellA.substr(2, cellA.length);
      Aprefix = "qm";
    }
    else if (cellA.charAt(0) == "s") {   // "sf"
      Anum = cellA.substr(2, cellA.length);
      Aprefix = "sf";
    }
    if (cellB.charAt(0) == "p") {
      Bnum = cellB.substr(1, cellB.length);
      Bprefix = "p";
    }
    else if (cellB.charAt(0) == "q") {   // "qm"
      Bnum = cellB.substr(2, cellB.length);
      Bprefix = "qm";
    }
    else if (cellA.charAt(0) == "s") {   // "sf"
      Bnum = cellB.substr(2, cellB.length);
      Bprefix = "sf";
    }
    if (Aprefix == Bprefix)
      return (Anum - Bnum);
    if (Aprefix == "p")
      return 0;
    if (Bprefix == "p")
      return 1;
    if (Aprefix == "qm")
      return 0;
    return 1;
  };

  function dataToMatchTable(dataObj) {
    console.log("==> teamLookup.php: dataToMatchTable()");
    $("#allMatchesTable").html("");  // clear table
    for (let i = 0; i < dataObj.length; i++) {
      var rowString = "<tr><td align=\"center\">" + dataObj[i]["matchnumber"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["autonLeave"] + "</td>" +

        "<td align=\"center\">" + dataObj[i]["autonCoralL1"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["autonCoralL2"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["autonCoralL3"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["autonCoralL4"] + "</td>" +

        "<td align=\"center\">" + dataObj[i]["autonAlgaeNet"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["autonAlgaeProcessor"] + "</td>" +

        "<td align=\"center\">" + dataObj[i]["acquiredCoral"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["acquiredAlgae"] + "</td>" +

        "<td align=\"center\">" + dataObj[i]["teleopCoralL1"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["teleopCoralL2"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["teleopCoralL3"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["teleopCoralL4"] + "</td>" +

        "<td align=\"center\">" + dataObj[i]["teleopAlgaeNet"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["teleopAlgaeProcessor"] + "</td>" +

        "<td align=\"center\">" + dataObj[i]["cageClimb"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["died"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["scoutname"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["comment"] + "</td>" +
        "</tr>";
      $("#allMatchesTable").append(rowString);
    }
    setTimeout(function () {
      sorttable.makeSortable(document.getElementById("sortableAllMatches"));
      frozenTableMatches = $('#freeze-table').freezeTable({
        'freezeHead': true,
        'freezeColumn': true,
        'freezeColumnHead': true,
        'scrollBar': true,
        'fixedNavbar': '.navbar',
        'scrollable': true,
        'fastMode': true,
        // 'container': '#navbar',
        'columnNum': 1,
        'columnKeep': true,
        'columnBorderWidth': 2,
        'backgroundColor': 'blue',
        'frozenColVerticalOffset': 0
      });
    }, 100);
    sortAllMatchesTable();
  }

  function processStrategicData(stratData) {
    dataToStrategicTable(stratData);
  }

  function processMatchData(team, matchData) {
    console.log("==> teamLookup.php: processMatchData()");
    var mdp = new matchDataProcessor(matchData);
    mdp.sortMatches(matchData);
    mdp.getSiteFilteredAverages(function (averageData) {
      processedData = averageData[team];
      dataToAvgTables(processedData);
    });
    getFilteredData(team, function (fData) {
      filteredData = fData;
      dataToCommentTable(filteredData);
      dataToMatchTable(filteredData);
      dataToAutonGraph(filteredData);
      dataToTeleopGraph(filteredData);
      dataToEndgameGraph(filteredData);
    });
  }

  // Converts a given "1" to yes, "0" to no, anything else to empty string.
  function convertToYesNo(value) {
    var convertedVal = "";
    if (value == "1")
      convertedVal = "yes";
    else if (value == "0")
      convertedVal = "-";
    else if (value == "2")
      convertedVal = "no";
    else if (value == "3")
      convertedVal = "-";
    return convertedVal;
  }

  function dataToStrategicTable(dataObj) {
    console.log("==> teamLookup.php: dataToStrategicTable()");
    $("#strategicDataTable").html("");  // clear table
    for (let i = 0; i < dataObj.length; i++) {
      var driverability = dataObj[i]["driverability"];
      var driveVal = "";
      if (driverability == "1")
        driveVal = "Jerky";
      else if (driverability == "2")
        driveVal = "Slow";
      else if (driverability == "3")
        driveVal = "Average";
      else if (driverability == "4")
        driveVal = "Quick";
      else if (driverability == "5")
        driveVal = "-";

      var rowString = "<tr><td align=\"center\">" + dataObj[i]["matchnumber"] + "</td>" +
        "<td align=\"center\">" + driveVal + "</td>" +
        "<td align=\"center\">" + convertToYesNo(dataObj[i]["against_tactic1"]) + "</td>" +
        "<td align=\"center\">" + dataObj[i]["against_comment"] + "</td>" +

        "<td align=\"center\">" + convertToYesNo(dataObj[i]["defense_tactic1"]) + "</td>" +
        "<td align=\"center\">" + convertToYesNo(dataObj[i]["defense_tactic2"]) + "</td>" +
        "<td align=\"center\">" + dataObj[i]["defense_comment"] + "</td>" +

        "<td align=\"center\">" + convertToYesNo(dataObj[i]["foul1"]) + "</td>" +
        "<td align=\"center\">" + convertToYesNo(dataObj[i]["autonFoul1"]) + "</td>" +
        "<td align=\"center\">" + convertToYesNo(dataObj[i]["autonFoul2"]) + "</td>" +
        "<td align=\"center\">" + convertToYesNo(dataObj[i]["teleopFoul1"]) + "</td>" +
        "<td align=\"center\">" + convertToYesNo(dataObj[i]["teleopFoul2"]) + "</td>" +
        "<td align=\"center\">" + convertToYesNo(dataObj[i]["teleopFoul3"]) + "</td>" +
        "<td align=\"center\">" + convertToYesNo(dataObj[i]["teleopFoul4"]) + "</td>" +
        "<td align=\"center\">" + convertToYesNo(dataObj[i]["endgameFoul1"]) + "</td>" +

        "<td align=\"center\">" + convertToYesNo(dataObj[i]["autonGetCoralFromFloor"]) + "</td>" +
        "<td align=\"center\">" + convertToYesNo(dataObj[i]["autonGetCoralFromStation"]) + "</td>" +
        "<td align=\"center\">" + convertToYesNo(dataObj[i]["autonGetAlgaeFromFloor"]) + "</td>" +
        "<td align=\"center\">" + convertToYesNo(dataObj[i]["autonGetAlgaeFromReef"]) + "</td>" +
        "<td align=\"center\">" + convertToYesNo(dataObj[i]["teleopFloorPickupAlgae"]) + "</td>" +
        "<td align=\"center\">" + convertToYesNo(dataObj[i]["teleopFloorPickupCoral"]) + "</td>" +
        "<td align=\"center\">" + convertToYesNo(dataObj[i]["teleopKnockOffAlgaeFromReef"]) + "</td>" +
        "<td align=\"center\">" + convertToYesNo(dataObj[i]["teleopAcquireAlgaeFromReef"]) + "</td>" +

        "<td align=\"center\">" + dataObj[i]["problem_comment"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["general_comment"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["scoutname"] + "</td>" +
        "</tr>";
      $("#strategicDataTable").append(rowString);
    }

    setTimeout(function () {
      sorttable.makeSortable(document.getElementById("sortableStrategicData"));
      frozenTableStrategy = $('#freeze-table-2').freezeTable({
        'backgroundColor': "white",
        'columnKeep': true,
        'frozenColVerticalOffset': 0
      });
    }, 100);
    sortStrategicDataTable();
  }

  // AUTON GRAPH STARTS HERE

  function dataToAutonGraph(matchdata) {
    console.log("==> teamLookup.php: dataToAutonGraph()");

    // Declare variables
    var matchList = []; // List of matches to use as x lables
    var datasets = []; // Each entry is a dict with a label and data attribute
    var autonLeaveTips = []; // holds custom tooltips for auton leave start line data      
    var autonAlgaeProcTips = []; // holds custom tooltips for auton algae processor
    var autonAlgaeNetTips = []; // holds custom tooltips for auton algae net
    var autonCoralL1Tips = []; // holds custom tooltips for auton coral L1
    var autonCoralL2Tips = []; // holds custom tooltips for auton coral L2
    var autonCoralL3Tips = []; // holds custom tooltips for auton coral L3
    var autonCoralL4Tips = []; // holds custom tooltips for auton coral 4      

    datasets.push({
      label: "Leave Start Line",
      data: [],
      backgroundColor: 'Red'
    });
    datasets.push({
      label: "Processor",
      data: [],
      backgroundColor: 'Orange'
    });
    datasets.push({
      label: "Net",
      data: [],
      backgroundColor: 'Yellow'
    });
    datasets.push({
      label: "L1",
      data: [],
      backgroundColor: 'Green'
    });
    datasets.push({
      label: "L2",
      data: [],
      backgroundColor: 'Blue'
    });
    datasets.push({
      label: "L3",
      data: [],
      backgroundColor: 'Indigo'
    });
    datasets.push({
      label: "L4",
      data: [],
      backgroundColor: 'Violet'
    });

    // Go thru each matchdata QR code string and build up a table of the data, so we can
    // later sort it so the matches are listed in the right order. 
    var mydata = [];
    for (let i = 0; i < matchdata.length; i++) {
      var matchnum = matchdata[i]["matchnumber"];
      var autonLeave = matchdata[i]["autonLeave"];
      var autonAlgaeProcessor = matchdata[i]["autonAlgaeProcessor"];
      var autonAlgaeNet = matchdata[i]["autonAlgaeNet"];
      var autonCoralOne = matchdata[i]["autonCoralL1"];
      var autonCoralTwo = matchdata[i]["autonCoralL2"];
      var autonCoralThree = matchdata[i]["autonCoralL3"];
      var autonCoralFour = matchdata[i]["autonCoralL4"];
      mydata.push({
        matchnum: matchnum,
        leave: autonLeave,
        processor: autonAlgaeProcessor,
        net: autonAlgaeNet,
        one: autonCoralOne,
        two: autonCoralTwo,
        three: autonCoralThree,
        four: autonCoralFour
      });
    }

    mydata.sort(function (rowA, rowB) {
      var cellA = rowA["matchnum"];
      var cellB = rowB["matchnum"];
      return (sortRows(cellA, cellB));
    });

    // Build data sets; go thru each mydata row and populate the graph datasets.
    for (let i = 0; i < mydata.length; i++) {
      var matchnum = mydata[i]["matchnum"];
      matchList.push(matchnum);

      // Get auton leave start line data
      var autonLeaveStartingZone = mydata[i]["leave"];
      datasets[0]["data"].push(autonLeaveStartingZone);
      var clevel = "No";
      if (autonLeaveStartingZone == 1)
        clevel = "Yes";
      var tipStr = "Leave Start Line" + clevel;
      autonLeaveTips.push({ xlabel: matchnum, tip: tipStr });

      // Get auton algae processor data
      var autonAlgaeProcessor = mydata[i]["processor"];
      datasets[1]["data"].push(autonAlgaeProcessor);
      var tooltipStr = "Processor=" + autonAlgaeProcessor;
      autonAlgaeProcTips.push({ xlabel: matchnum, tip: tooltipStr });

      // Get auton algae net data
      var autonAlgaeNet = mydata[i]["net"];
      datasets[2]["data"].push(autonAlgaeNet);
      var tooltipStr = "Net=" + autonAlgaeNet;
      autonAlgaeNetTips.push({ xlabel: matchnum, tip: tooltipStr });

      // Get auton coral level one
      var autonCoralOne = mydata[i]["one"];
      datasets[3]["data"].push(autonCoralOne);
      var tooltipStr = "L1=" + autonCoralOne;
      autonCoralL1Tips.push({ xlabel: matchnum, tip: tooltipStr });

      // Get auton coral level two
      var autonCoralTwo = mydata[i]["two"];
      datasets[4]["data"].push(autonCoralTwo);
      var tooltipStr = "L2=" + autonCoralTwo;
      autonCoralL2Tips.push({ xlabel: matchnum, tip: tooltipStr });

      // Get auton coral level three
      var autonCoralThree = mydata[i]["three"];
      datasets[5]["data"].push(autonCoralThree);
      var tooltipStr = "L3=" + autonCoralThree;
      autonCoralL3Tips.push({ xlabel: matchnum, tip: tooltipStr });

      // Get auton coral level four
      var autonCoralFour = mydata[i]["four"];
      datasets[6]["data"].push(autonCoralFour);
      var tooltipStr = "L4=" + autonCoralFour;
      autonCoralL4Tips.push({ xlabel: matchnum, tip: tooltipStr });
    }

    // Define the graph as a line chart:
    if (autoChartDefined) {
      autoChart.destroy();
    }
    autoChartDefined = true;

    const ctx = document.getElementById('autoChart').getContext('2d');
    autoChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: matchList,
        datasets: datasets
      },
      options: {
        scales: {
          x: {
            stacked: true
          },
          y: {
            stacked: true
          }
        },
        plugins: {
          tooltip: {
            callbacks: {  // Special tooltip handling
              label: function (tooltipItem, ddata) {
                var toolIndex = tooltipItem.datasetIndex;
                var matchnum = tooltipItem.label;
                var tipStr = datasets[toolIndex].label;

                if (toolIndex == 0) {   // Auton leave
                  for (let i = 0; i < autonLeaveTips.length; i++) {
                    if (autonLeaveTips[i].xlabel == matchnum) {
                      tipStr = autonLeaveTips[i].tip;
                      break;
                    }
                  }
                }
                else if (toolIndex == 1) {   // Auton algae processor
                  for (let i = 0; i < autonAlgaeProcTips.length; i++) {
                    if (autonAlgaeProcTips[i].xlabel == matchnum) {
                      tipStr = autonAlgaeProcTips[i].tip;
                      break;
                    }
                  }
                }
                else if (toolIndex == 2) {   // Auton algae net
                  for (let i = 0; i < autonAlgaeNetTips.length; i++) {
                    if (autonAlgaeNetTips[i].xlabel == matchnum) {
                      tipStr = autonAlgaeNetTips[i].tip;
                      break;
                    }
                  }
                }
                else if (toolIndex == 3) {   // Auton Amp Notes
                  for (let i = 0; i < autonCoralL1Tips.length; i++) {
                    if (autonCoralL1Tips[i].xlabel == matchnum) {
                      tipStr = autonCoralL1Tips[i].tip;
                      break;
                    }
                  }
                }
                else if (toolIndex == 4) {   // Auton coral
                  for (let i = 0; i < autonCoralL2Tips.length; i++) {
                    if (autonCoralL2Tips[i].xlabel == matchnum) {
                      tipStr = autonCoralL2Tips[i].tip;
                      break;
                    }
                  }
                }
                else if (toolIndex == 5) {   // Auton coral
                  for (let i = 0; i < autonCoralL3Tips.length; i++) {
                    if (autonCoralL3Tips[i].xlabel == matchnum) {
                      tipStr = autonCoralL3Tips[i].tip;
                      break;
                    }
                  }
                }
                else if (toolIndex == 6) {   // Auton coral
                  for (let i = 0; i < autonCoralL4Tips.length; i++) {
                    if (autonCoralL4Tips[i].xlabel == matchnum) {
                      tipStr = autonCoralL4Tips[i].tip;
                      break;
                    }
                  }
                }
                return tipStr;
              }
            }
          }
        }
      }
    });
  }

  // AUTON GRAPH ENDS HERE

  // TELEOP GRAPH STARTS HERE

  function dataToTeleopGraph(matchdata) {
    console.log("==> teamLookup.php: dataToTeleopGraph()");

    // Declare variables
    var matchList = []; // List of matches to use as x lables
    var datasets = []; // Each entry is a dict with a label and data attribute
    var teleopAlgaeProcessorTips = []; // holds custom tooltips for teleop speaker notes
    var teleopAlgaeNetTips = [];//holds custom tooltips for if amplification used
    var teleopCoralL1Tips = []; // holds custom tooltips for teleop coral L1
    var teleopCoralL2Tips = []; // holds custom tooltips for teleop coral L2
    var teleopCoralL3Tips = []; // holds custom tooltips for teleop coral L3
    var teleopCoralL4Tips = []; // holds custom tooltips for teleop coral 4      

    datasets.push({
      label: "Processor",
      data: [],
      backgroundColor: 'Red'
    });
    datasets.push({
      label: "Net",
      data: [],
      backgroundColor: 'Orange'
    });
    datasets.push({
      label: "L1",
      data: [],
      backgroundColor: 'Yellow'
    });
    datasets.push({
      label: "L2",
      data: [],
      backgroundColor: 'Green'
    });
    datasets.push({
      label: "L3",
      data: [],
      backgroundColor: 'Blue'
    });
    datasets.push({
      label: "L4",
      data: [],
      backgroundColor: 'Violet'

    });

    // Go thru each matchdata QR code string and build up a table of the data, so we can
    // later sort it so the matches are listed in the right order. 
    var mydata = [];
    for (let i = 0; i < matchdata.length; i++) {
      var matchnum = matchdata[i]["matchnumber"];
      var teleopAlgaeProcessor = matchdata[i]["teleopAlgaeProcessor"];
      var teleopAlgaeNet = matchdata[i]["teleopAlgaeNet"];
      var teleopCoralOne = matchdata[i]["teleopCoralL1"];
      var teleopCoralTwo = matchdata[i]["teleopCoralL2"];
      var teleopCoralThree = matchdata[i]["teleopCoralL3"];
      var teleopCoralFour = matchdata[i]["teleopCoralL4"];
      mydata.push({
        matchnum: matchnum,
        teleopprocessor: teleopAlgaeProcessor,
        teleopnet: teleopAlgaeNet,
        levelone: teleopCoralOne,
        leveltwo: teleopCoralTwo,
        levelthree: teleopCoralThree,
        levelfour: teleopCoralFour
      });
    }
    mydata.sort(function (rowA, rowB) {
      var cellA = rowA["matchnum"];
      var cellB = rowB["matchnum"];
      return (sortRows(cellA, cellB));
    });
    // Build data sets; go thru each mydata row and populate the graph datasets.
    for (let i = 0; i < mydata.length; i++) {
      var matchnum = mydata[i]["matchnum"];
      matchList.push(matchnum);

      // Get teleop algae processor
      var teleopAlgaeProcessor = mydata[i]["teleopprocessor"];
      datasets[0]["data"].push(teleopAlgaeProcessor);
      var tooltipStr1 = "Processor=" + teleopAlgaeProcessor;
      teleopAlgaeProcessorTips.push({ xlabel: matchnum, tip: tooltipStr1 });

      //Get teleop algae net
      var teleopAlgaeNet = mydata[i]["teleopnet"];
      datasets[1]["data"].push(teleopAlgaeNet);
      var tooltipStr3 = "Net =" + teleopAlgaeNet;
      teleopAlgaeNetTips.push({ xlabel: matchnum, tip: tooltipStr3 });

      // Get teleop coral level one
      var teleopCoralOne = mydata[i]["levelone"];
      datasets[2]["data"].push(teleopCoralOne);
      var tooltipStr = "L1=" + teleopCoralOne;
      teleopCoralL1Tips.push({ xlabel: matchnum, tip: tooltipStr });

      // Get teleop coral level two
      var teleopCoralTwo = mydata[i]["leveltwo"];
      datasets[3]["data"].push(teleopCoralTwo);
      var tooltipStr = "L2=" + teleopCoralTwo;
      teleopCoralL2Tips.push({ xlabel: matchnum, tip: tooltipStr });

      // Get teleop coral level three
      var teleopCoralThree = mydata[i]["levelthree"];
      datasets[4]["data"].push(teleopCoralThree);
      var tooltipStr = "L3=" + teleopCoralThree;
      teleopCoralL3Tips.push({ xlabel: matchnum, tip: tooltipStr });

      // Get teleop coral level four
      var teleopCoralFour = mydata[i]["levelfour"];
      datasets[5]["data"].push(teleopCoralFour);
      var tooltipStr = "L4=" + teleopCoralFour;
      teleopCoralL4Tips.push({ xlabel: matchnum, tip: tooltipStr });
    }

    // Define the graph as a line chart:
    if (teleopChartDefined) {
      teleopChart.destroy();
    }
    teleopChartDefined = true;

    const ctx = document.getElementById('teleopChart').getContext('2d');
    teleopChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: matchList,
        datasets: datasets
      },
      options: {
        scales: {
          x: {
            stacked: true
          },
          y: {
            stacked: true
          }
        },
        plugins: {
          tooltip: {
            callbacks: {  // Special tooltip handling
              label: function (tooltipItem, ddata) {
                var toolIndex = tooltipItem.datasetIndex;
                var matchnum = tooltipItem.label;
                var tipStr = datasets[toolIndex].label;

                if (toolIndex == 0) {   // Teleop algae processor
                  for (let i = 0; i < teleopAlgaeProcessorTips.length; i++) {
                    if (teleopAlgaeProcessorTips[i].xlabel == matchnum) {
                      tipStr = teleopAlgaeProcessorTips[i].tip;
                      break;
                    }
                  }
                }
                else if (toolIndex == 1) {   // Teleop Algae Net
                  for (let i = 0; i < teleopAlgaeNetTips.length; i++) {
                    if (teleopAlgaeNetTips[i].xlabel == matchnum) {
                      tipStr = teleopAlgaeNetTips[i].tip;
                      break;
                    }
                  }
                }
                if (toolIndex == 2) {   // teleop coral level one
                  for (let i = 0; i < teleopCoralL1Tips.length; i++) {
                    if (teleopCoralL1Tips[i].xlabel == matchnum) {
                      tipStr = teleopCoralL1Tips[i].tip;
                      break;
                    }
                  }
                }
                else if (toolIndex == 3) {   // teleop coral level two
                  for (let i = 0; i < teleopCoralL2Tips.length; i++) {
                    if (teleopCoralL2Tips[i].xlabel == matchnum) {
                      tipStr = teleopCoralL2Tips[i].tip;
                      break;
                    }
                  }
                }
                else if (toolIndex == 4) {   // teleop coral level three
                  for (let i = 0; i < teleopCoralL3Tips.length; i++) {
                    if (teleopCoralL3Tips[i].xlabel == matchnum) {
                      tipStr = teleopCoralL3Tips[i].tip;
                      break;
                    }
                  }
                }
                else if (toolIndex == 5) {   // teleop coral level four
                  for (let i = 0; i < teleopCoralL4Tips.length; i++) {
                    if (teleopCoralL4Tips[i].xlabel == matchnum) {
                      tipStr = teleopCoralL4Tips[i].tip;
                      break;
                    }
                  }
                }
                return tipStr;
              }
            }
          }
        }
      }
    });
  }

  // TELEOP GRAPH ENDS HERE

  // ENDGAME GRAPH STARTS HERE

  function dataToEndgameGraph(matchdata) {
    console.log("==> teamLookup.php: dataToEndgameGraph()");
    var matchList = [];

    var datasets = [];

    var cageClimbTips = [];

    datasets.push({
      label: "Cage Climb",
      data: [],
      backgroundColor: 'SteelBlue'
    });

    // Go thru each matchdata QR code string and build up a table of the data, so we can
    // later sort it so the matches are listed in the right order. 
    var mydata = [];
    for (let i = 0; i < matchdata.length; i++) {
      var matchnum = matchdata[i]["matchnumber"];
      var cageClimb = matchdata[i]["cageClimb"];
      mydata.push({
        matchnum: matchnum,
        cage: cageClimb,
      });
    }
    mydata.sort(function (rowA, rowB) {
      var cellA = rowA["matchnum"];
      var cellB = rowB["matchnum"];
      return (sortRows(cellA, cellB));
    });

    // Build data sets; go thru each mydata row and populate the graph datasets.
    for (let i = 0; i < mydata.length; i++) {
      var matchnum = mydata[i]["matchnum"];
      matchList.push(matchnum);

      // Get endgame climb cage level
      var cageClimb = mydata[i]["cage"];
      datasets[0]["data"].push(cageClimb);
      var clevel = "N/A";
      if (cageClimb == 1)
        clevel = "Parked";
      if (cageClimb == 2)
        clevel = "Fell";
      if (cageClimb == 3)
        clevel = "Shallow";
      if (cageClimb == 4)
        clevel = "Deep";
      var tipStr = "Cage Climb =" + clevel;
      cageClimbTips.push({ xlabel: matchnum, tip: tipStr });

    }

    if (endgameChartDefined) {
      endgameChart.destroy();
    }
    endgameChartDefined = true;
    const ctx = document.getElementById('endgameChart').getContext('2d');
    endgameChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: matchList,
        datasets: datasets
      },
      options: {
        scales: {
          x: {
            stacked: true
          },
          y: {
            stacked: true
          }
        },
        plugins: {
          tooltip: {
            callbacks: {  // Special tooltip handling
              label: function (tooltipItem, ddata) {
                var toolIndex = tooltipItem.datasetIndex;
                var matchnum = tooltipItem.label;
                var tipStr = datasets[toolIndex].label;

                if (toolIndex == 0) {   // Cage Climb
                  for (let i = 0; i < cageClimbTips.length; i++) {
                    if (cageClimbTips[i].xlabel == matchnum) {
                      tipStr = cageClimbTips[i].tip;
                      break;
                    }
                  }
                }
                return tipStr;
              }
            }
          }
        }
      }
    });
  }

  // ENDGAME GRAPH END HERE

  // function processCommentData(commentData) {
  //   dataToCommentTable(commentData);
  // }

  function processPitData(pitData, matchData) {
    console.log("==> teamLookup.php: processPitData()");
    if (!pitData || !pitData.length) {
      // row one    
      pitData["sparepartsstring"] = pitData["spareparts"] ? "yes" : "no";
      pitData["computervisionstring"] = pitData["computervision"] ? "yes" : "no";
      pitData["swervedrivestring"] = pitData["swerve"] ? "yes" : "no";

      // row two    
      pitData["drivemotors"];
      pitData["preparedness"];
      pitData["projlanguage"];
    }

    writeTableRow("pitRow1", pitData, ["numbatteries", "pitorg", "sparepartsstring", "computervisionstring"]);
    writeTableRow("pitRow2", pitData, ["drivemotors", "preparedness", "swervedrivestring", "proglanguage"]);
  }

  // This is the main function that runs when we want to load a new team 
  function loadTeamSheet(teamNum) {
    console.log("==> teamLookup.php: loadTeamSheet()");
    // Clear existing data
    $("#robotPics").html("");
    $("#teamTitle").html("");
    $("#pitRow1").html("");
    $("#pitRow2").html("");
    $("#comments").html("");
    $("#allMatchesTable").html("");
    $("#strategicDataTable").html("");
    $("#autoTable").html("");
    $("#autoTotalTable").html("");
    $("#teleopTable").html("");
    $("#teleopTotalTable").html("");
    $("#endgameTotalPtsTable").html("");
    $("#endgameClimbTable").html("");
    $("#totalTable").html("");

    // Get team name from TBA
    $.get("api/tbaAPI.php", {
      getTeamInfo: teamNum
    }).done(function (teamInfo) {
      console.log("==> getTeamInfo");
      var teamname = "XX";
      if (teamInfo == null)
        alert("Can't load teamName from TBA; check if TBA Key was set in db_config");
      else {
        console.log("teamLookup: getTeamInfo:\n" + teamInfo);
        teamInfo = JSON.parse(teamInfo)["response"];
        teamname = teamInfo["nickname"];
        console.log("teamLookup: for " + teamNum + ", teamname = " + teamname);
      }
      if (teamname != "XX") {
        $("#teamTitle").html(teamNum + " - " + teamname);
      } else {
        $("#teamTitle").html("Team " + teamNum);
      }
    });

    // Add new images
    $.get("api/readAPI.php", {
      getImagesForTeam: teamNum
    }).done(function (teamImages) {
      console.log("==> getImagesForTeam");
      var listOfImages = JSON.parse(teamImages);
      console.log("PHOTO CHECK: " + listOfImages);
      loadTeamPics(listOfImages);
    });

    // Add Match Scouting Data
    $.get("api/readAPI.php", {
      getTeamData: teamNum
    }).done(function (matchData) {
      console.log("==> getTeamData");
      jsonMatchData = JSON.parse(matchData);
      processMatchData(teamNum, jsonMatchData);

      // Do the Pit Scouting Data here because it also needs the matchData.
      $.get("api/readAPI.php", {
        getTeamPitData: teamNum
      }).done(function (teamPitData) {
        console.log("==> getTeamPitData");
        pitData = JSON.parse(teamPitData);
        processPitData(pitData, matchData);

        // Do the Strategic Data Table next.
        $.get("api/readAPI.php", {
          getTeamStrategicData: teamNum
        }).done(function (strategicData) {
          console.log("==> getTeamStrategicData");
          stratData = JSON.parse(strategicData);
          processStrategicData(stratData);
        });
      });
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
      console.log("==> teamLookup.php - getEventCode: " + eventCode);
      $("#navbarEventCode").html(eventCode);
    });

    var initTeamNumber = checkGet()
    if (initTeamNumber) {
      loadTeamSheet(initTeamNumber);
    }

    // Pressing enter in team number field loads the page
    var input = document.getElementById("enterTeamNumber");
    input.addEventListener("keypress", function (event) {
      if (event.key === "Enter") {
        event.preventDefault();
        document.getElementById("loadTeamButton").click();
      }
    });

    // Load team data for the number entered
    $("#loadTeamButton").click(function () {
      loadTeamSheet($("#enterTeamNumber").val());
    });

    // Keep the frozen match data updated
    $("#sortableAllMatches").click(function () {
      if (frozenTableMatches) {
        frozenTableMatches.update();
      }
    });

    // Keep the frozen strategy table updated
    $("#sortableStrategicData").click(function () {
      if (frozenTableStrategy) {
        frozenTableStrategy.update();
      }
    });
  });
</script>

<script type="text/javascript" src="./scripts/matchDataProcessor.js"></script>
