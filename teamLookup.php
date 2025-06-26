<?php
$title = 'Team Lookup';
require 'inc/header.php';
?>

<div class="container row-offcanvas row-offcanvas-left">
  <div id="content" class="column card-lg-12 col-sm-12 col-xs-12">

    <!-- Page Title -->
    <div class="row pt-3 pb-3 mb-3">
      <h2 class="col-md-6"><?php echo $title; ?></h2>
    </div>

    <!-- Main row to hold the team lookup form -->
    <div class="row col-md-6 mb-3">
      <div class="input-group mb-3">
        <input id="enterTeamNumber" class="form-control" type="text" placeholder="FRC team number" aria-label="Team Number">
        <div class="input-group-append">
          <button id="loadTeamButton" class="btn btn-primary" type="button">Load Team</button>
        </div>
      </div>
    </div>

    <!-- First column of data starts here -->
    <div class="row">
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
            <div class="card mb-3" style="background-color:#D5E6DE">
              <div class="card-header">
                <h5 class="text-center">
                  <a href="#collapseAutonCoralGraph" data-bs-toggle="collapse" aria-expanded="false">Auton Scoring</a>
                </h5>
              </div>
              <div id="collapseAutonCoralGraph" class="card-body collapse">
                <canvas id="autoChart" width="400" height="360"></canvas>
              </div>
            </div>

            <!-- Teleop collapsible graph -->
            <div class="card mb-3" style="background-color:#D6F3FB">
              <div class="card-header">
                <h5 class="text-center">
                  <a href="#collapseTeleopCoralGraph" data-bs-toggle="collapse" aria-expanded="false">Teleop Scoring</a>
                </h5>
              </div>
              <div id="collapseTeleopCoralGraph" class="card-body collapse">
                <canvas id="teleopChart" width="400" height="360"></canvas>
              </div>
            </div>

            <!-- Endgame collapsible graph -->
            <div class="card mb-3" style="background-color:#FBE6D3">
              <div class="card-header">
                <h5 class="text-center">
                  <a href="#collapseEndgameGraph" data-bs-toggle="collapse" aria-expanded="false">Endgame Scoring</a>
                </h5>
              </div>
              <div id="collapseEndgameGraph" class="card-body collapse">
                <canvas id="endgameChart" width="400" height="360"></canvas>
              </div>
            </div>

          </div>
        </div>

      </div>

      <!-- Second Column of Data starts here -->
      <div class="col-lg-6 col-sm-6 col-xs-6 gx-3">
        <div class="card mb-3">
          <div class="card-body">

            <!-- Match Total Points section -->
            <div class="card mb-3">
              <div class="card-header">
                <h5 class="text-center">Match Totals</h5>
              </div>
              <div class="card-body">
                <table id="matchSheetTable"
                  class="table table-striped table-bordered table-hover table-sm border-dark text-center ">
                  <thead>
                    <tr>
                      <th scope="col" style="text-align:left">Totals</th>
                      <th scope="col">AVG</th>
                      <th scope="col">MAX</th>
                    </tr>
                  </thead>
                  <tbody class="table-group-divider">
                    <tr>
                      <th scope="row" style="text-align:left">Coral Scored</th>
                      <td> </td>
                      <td> </td>
                    </tr>
                    <tr>
                      <th scope="row" style="text-align:left">Algae Scored</th>
                      <td> </td>
                      <td> </td>
                    </tr>
                    <tr>
                      <th scope="row" style="text-align:left">Coral Points</th>
                      <td> </td>
                      <td> </td>
                    </tr>
                    <tr>
                      <th scope="row" style="text-align:left">Algae Points</th>
                      <td> </td>
                      <td> </td>
                    </tr>
                    <tr>
                      <th scope="row" style="text-align:left">Match Points</th>
                      <td> </td>
                      <td> </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- Auton Points section -->
            <div class="card mb-3" style="background-color:#D5E6DE">
              <div class="card-header">
                <h5 class="text-center"><a href="#collapseAuton" data-bs-toggle="collapse" aria-expanded="false">Auton</a></h5>
              </div>
              <div id="collapseAuton" class="card-body collapse">
                <table id="autonTable" class="table table-striped table-bordered table-hover table-sm border-dark text-center ">
                  <thead>
                    <tr>
                      <th scope="col" style="text-align:left"></th>
                      <th scope="col">AVG</th>
                      <th scope="col">MAX</th>
                    </tr>
                  </thead>
                  <tbody class="table-group-divider">
                    <tr>
                      <th scope="row" style="text-align:left">Auton Points</th>
                      <td> </td>
                      <td> </td>
                    </tr>
                    <tr>
                      <th scope="row" style="text-align:left">Coral Scored</th>
                      <td> </td>
                      <td> </td>
                    </tr>
                    <tr>
                      <th scope="row" style="text-align:left">Algae Scored</th>
                      <td> </td>
                      <td> </td>
                    </tr>
                    <tr>
                      <th scope="row" style="text-align:left">Coral Points</th>
                      <td> </td>
                      <td> </td>
                    </tr>
                    <tr>
                      <th scope="row" style="text-align:left">Algae Points</th>
                      <td> </td>
                      <td> </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- Teleop Points section -->
            <div class="card mb-3" style="background-color:#D6F3FB">
              <div class="card-header">
                <h5 class="text-center"> <a href="#collapseTeleop" data-bs-toggle="collapse" aria-expanded="false">Teleop </a>
                </h5>
              </div>
              <div id="collapseTeleop" class="card-body collapse">
                <table id="teleopTable" class="table table-striped table-bordered table-hover table-sm border-dark text-center ">
                  <thead>
                    <tr>
                      <th scope="col" style="text-align:left"></th>
                      <th scope="col">AVG</th>
                      <th scope="col">MAX</th>
                    </tr>
                  </thead>
                  <tbody class="table-group-divider">
                    <tr>
                      <th scope="row" style="text-align:left">Teleop Points</th>
                      <td> </td>
                      <td> </td>
                    </tr>
                    <tr>
                      <th scope="row" style="text-align:left">Coral Scored</th>
                      <td> </td>
                      <td> </td>
                    </tr>
                    <tr>
                      <th scope="row" style="text-align:left">Algae Scored</th>
                      <td> </td>
                      <td> </td>
                    </tr>
                    <tr>
                      <th scope="row" style="text-align:left">Coral Points</th>
                      <td> </td>
                      <td> </td>
                    </tr>
                    <tr>
                      <th scope="row" style="text-align:left">Algae Points</th>
                      <td> </td>
                      <td> </td>
                    </tr>
                    <tr>
                      <th scope="row" style="text-align:left">Coral Acc%</th>
                      <td> </td>
                      <td> </td>
                    </tr>
                    <tr>
                      <th scope="row" style="text-align:left">Algae Acc%</th>
                      <td> </td>
                      <td> </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- Endgame Points section -->
            <div class="card mb-3" style="background-color:#FBE6D3">
              <div class="card-header">
                <h5 class="text-center"> <a href="#collapseEndgame" data-bs-toggle="collapse" aria-expanded="false">Endgame
                  </a>
                </h5>
              </div>
              <div id="collapseEndgame" class="card-body collapse">
                <table id="endgameTotalPtsTable"
                  class="table table-striped table-bordered table-hover table-sm border-dark text-center ">
                  <thead>
                    <tr>
                      <th scope="col" style="text-align:left"></th>
                      <th scope="col">AVG</th>
                      <th scope="col">MAX</th>
                    </tr>
                  </thead>
                  <tbody class="table-group-divider">
                    <tr>
                      <th scope="row" style="text-align:left">Endgame Points</th>
                      <td> </td>
                      <td> </td>
                    </tr>
                  </tbody>
                </table>
                <table id="endgameClimbTable"
                  class="table table-striped table-bordered table-hover table-sm border-dark text-center ">
                  <thead>
                    <tr>
                      <th scope="col" style="text-align:left"></th>
                      <th style="width:12%" scope="col">N</th>
                      <th style="width:12%" scope="col">F</th>
                      <th style="width:12%" scope="col">P</th>
                      <th style="width:12%" scope="col">S</th>
                      <th style="width:12%" scope="col">D</th>
                    </tr>
                  </thead>
                  <tbody class="table-group-divider">
                    <tr>
                      <th scope="row" style="text-align:left">Cage Climb %</th>
                      <td> </td>
                      <td> </td>
                      <td> </td>
                      <td> </td>
                      <td> </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <!-- Strategic Data collapsible table -->
        <div class="card mb-3">
          <div class="card-header">
            <h5 class="text-center">
              <a href="#collapseStrategicData" data-bs-toggle="collapse" aria-expanded="false">Strategic Scouting</a>
            </h5>
          </div>
          <div id="collapseStrategicData" class="card-body collapse">

            <div id="freeze-table-strat" class="freeze-table overflow-auto">
              <table id="strategicDataTable"
                class="table table-striped table-bordered table-hover table-sm border-dark text-center sortable">
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
                <tbody class="table-group-divider"> </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- Pit scouting collapsible table -->
        <div class="card mb-3">
          <div class="card-header">
            <h5 class="text-center">
              <a href="#collapsePitData" data-bs-toggle="collapse" aria-expanded="false">Pit Scouting</a>
            </h5>
          </div>
          <!-- Pit Scouting 1st row -->
          <div id="collapsePitData" class="card-body collapse">
            <table id="pitTable1" class="table table-striped table-sm table-bordered table-hover border-dark text-center">
              <colgroup>
                <col span="1" style="background-color:transparent">
                <col span="1" style="background-color:#cfe2ff">
                <col span="1" style="background-color:transparent">
                <col span="1" style="background-color:#cfe2ff">
              </colgroup>
              <thead>
                <tr>
                  <th scope="col" style="width:25%">Swerve</th>
                  <th scope="col" style="width:25%">Motors</th>
                  <th scope="col" style="width:25%">Spares</th>
                  <th scope="col" style="width:25%">Language</th>
                </tr>
              </thead>
              <tbody class="table-group-divider"> </tbody>
            </table>

            <!-- Pit Scouting 2nd row -->
            <table id="pitTable2" class="table table-striped table-sm table-bordered table-hover border-dark text-center">
              <colgroup>
                <col span="1" style="background-color:transparent">
                <col span="1" style="background-color:#cfe2ff">
                <col span="1" style="background-color:transparent">
                <col span="1" style="background-color:#cfe2ff">
              </colgroup>
              <thead>
                <tr>
                  <th scope="col" style="width:25%">Vision</th>
                  <th scope="col" style="width:25%">Pit</th>
                  <th scope="col" style="width:25%">Prep</th>
                  <th scope="col" style="width:25%">Batteries</th>
                </tr>
              </thead>
              <tbody class="table-group-divider"> </tbody>
            </table>

          </div>
        </div>

        <!-- Match scouting data collapsible table -->
        <div class="card mb-3">
          <div class="card-header">
            <h5 class="text-center">
              <a href="#collapseAllMatches" data-bs-toggle="collapse" aria-expanded="false">Match Scouting</a>
            </h5>
          </div>
          <div id="collapseAllMatches" class="card-body collapse">

            <div id="freeze-table-match" class="freeze-table overflow-auto">
              <table id="matchDataTable"
                class="table table-striped table-bordered table-hover table-sm border-dark text-center sortable">
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
                <tbody class="table-group-divider"> </tbody>
              </table>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<?php include 'inc/footer.php'; ?>

<!-- Javascript page handlers -->


<script>

  const matchColumn = 0;

  let autoChart;
  let teleopChart;
  let endgameChart;

  let frozenTableMatches = null;
  let frozenTableStrategy = null;

  // Rounding helper function 
  function rnd(val) {
    return Math.round((val + Number.EPSILON) * 100) / 100;
  }

  ///// AUTON GRAPH STARTS HERE /////

  function loadAutonGraph(matchdata) {
    console.log("==> teamLookup: loadAutonGraph()");

    // Declare variables
    let matchList = []; // List of matches to use as x labels
    let datasets = []; // Each entry is a dict with a label and data attribute
    let autonLeaveTips = []; // holds custom tooltips for auton leave start line data      
    let autonAlgaeProcTips = []; // holds custom tooltips for auton algae processor
    let autonAlgaeNetTips = []; // holds custom tooltips for auton algae net
    let autonCoralL1Tips = []; // holds custom tooltips for auton coral L1
    let autonCoralL2Tips = []; // holds custom tooltips for auton coral L2
    let autonCoralL3Tips = []; // holds custom tooltips for auton coral L3
    let autonCoralL4Tips = []; // holds custom tooltips for auton coral 4      

    datasets.push({ label: "Leave", data: [], backgroundColor: '#F7CF58' });
    datasets.push({ label: "Processor", data: [], backgroundColor: '#B4E7D6' });
    datasets.push({ label: "Net", data: [], backgroundColor: '#4C9F7C' });
    datasets.push({ label: "L1", data: [], backgroundColor: '#D98AB3' });
    datasets.push({ label: "L2", data: [], backgroundColor: '#CE649B' });
    datasets.push({ label: "L3", data: [], backgroundColor: '#C54282' });
    datasets.push({ label: "L4", data: [], backgroundColor: '#9D3468' });

    // Go thru each matchdata QR code string and build up a table of the data, so we can
    // later sort it so the matches are listed in the right order. 
    let mydata = [];
    for (let i = 0; i < matchdata.length; i++) {
      let matchnum = matchdata[i]["matchnumber"];
      let autonLeave = matchdata[i]["autonLeave"];
      let autonAlgaeProcessor = matchdata[i]["autonAlgaeProcessor"];
      let autonAlgaeNet = matchdata[i]["autonAlgaeNet"];
      let autonCoralOne = matchdata[i]["autonCoralL1"];
      let autonCoralTwo = matchdata[i]["autonCoralL2"];
      let autonCoralThree = matchdata[i]["autonCoralL3"];
      let autonCoralFour = matchdata[i]["autonCoralL4"];
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
      return (compareMatchNumbers(rowA["matchnum"], rowB["matchnum"]));
    });

    // Build data sets; go thru each mydata row and populate the graph datasets.
    for (let i = 0; i < mydata.length; i++) {
      let matchnum = mydata[i]["matchnum"];
      matchList.push(matchnum);
      let tipStr = "";

      function storeAndGetTip(value, tipPrefix, dataset, yesNo) {
        dataset.push(value);
        if (yesNo)
          value = (value) ? "Yes" : "No";
        return tipPrefix + value;
      }

      autonLeaveTips.push({ xlabel: matchnum, tip: storeAndGetTip(mydata[i]["leave"], "Leave=", datasets[0]["data"], true) });
      autonAlgaeProcTips.push({ xlabel: matchnum, tip: storeAndGetTip(mydata[i]["processor"], "Processor=", datasets[1]["data"], false) });
      autonAlgaeNetTips.push({ xlabel: matchnum, tip: storeAndGetTip(mydata[i]["net"], "Net=", datasets[2]["data"], false) });
      autonCoralL1Tips.push({ xlabel: matchnum, tip: storeAndGetTip(mydata[i]["one"], "L1=", datasets[3]["data"], false) });
      autonCoralL2Tips.push({ xlabel: matchnum, tip: storeAndGetTip(mydata[i]["two"], "L2=", datasets[4]["data"], false) });
      autonCoralL3Tips.push({ xlabel: matchnum, tip: storeAndGetTip(mydata[i]["three"], "L3=", datasets[5]["data"], false) });
      autonCoralL4Tips.push({ xlabel: matchnum, tip: storeAndGetTip(mydata[i]["four"], "L4=", datasets[6]["data"], false) });
    }

    // Define the graph as a line chart:
    if (autoChart !== undefined) {
      autoChart.destroy();
    }

    // Create the Auton graph
    const ctx = document.getElementById('autoChart').getContext('2d');
    autoChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: matchList,
        datasets: datasets
      },
      options: {
        scales: {
          x: { stacked: true },
          y: { stacked: true, min: 0, ticks: { precision: 0 }, max: 5 }
        },
        plugins: {
          tooltip: {
            callbacks: {  // Special tooltip handling
              label: function (tooltipItem, ddata) {

                function getTip(matchno, tipList) {
                  for (let i = 0; i < tipList.length; i++)
                    if (tipList[i].xlabel === matchno)
                      return tipList[i].tip;
                }

                let matchnum = tooltipItem.label;
                let tipStr = datasets[tooltipItem.datasetIndex].label;
                switch (tooltipItem.datasetIndex) {
                  case 0: return getTip(matchnum, autonLeaveTips);
                  case 1: return getTip(matchnum, autonAlgaeProcTips);
                  case 2: return getTip(matchnum, autonAlgaeNetTips);
                  case 3: return getTip(matchnum, autonCoralL1Tips);
                  case 4: return getTip(matchnum, autonCoralL2Tips);
                  case 5: return getTip(matchnum, autonCoralL3Tips);
                  case 6: return getTip(matchnum, autonCoralL4Tips);
                  default: return "missing tip string!"
                }
                return tipStr;
              }
            }
          }
        }
      }
    });
  }

  ///// AUTON GRAPH ENDS HERE /////

  ///// TELEOP GRAPH STARTS HERE /////

  function loadTeleopGraph(matchdata) {
    console.log("==> teamLookup: loadTeleopGraph()");

    // Declare variables
    let matchList = []; // List of matches to use as x lables
    let datasets = []; // Each entry is a dict with a label and data attribute
    let teleopAlgaeProcessorTips = []; // holds custom tooltips for teleop speaker notes
    let teleopAlgaeNetTips = [];//holds custom tooltips for if amplification used
    let teleopCoralL1Tips = []; // holds custom tooltips for teleop coral L1
    let teleopCoralL2Tips = []; // holds custom tooltips for teleop coral L2
    let teleopCoralL3Tips = []; // holds custom tooltips for teleop coral L3
    let teleopCoralL4Tips = []; // holds custom tooltips for teleop coral 4      

    datasets.push({ label: "Processor", data: [], backgroundColor: '#B4E7D6' });
    datasets.push({ label: "Net", data: [], backgroundColor: '#4C9F7C' });
    datasets.push({ label: "L1", data: [], backgroundColor: '#D98AB3' });
    datasets.push({ label: "L2", data: [], backgroundColor: '#CE649B' });
    datasets.push({ label: "L3", data: [], backgroundColor: '#C54282' });
    datasets.push({ label: "L4", data: [], backgroundColor: '#9D3468' });

    // Go thru each matchdata QR code string and build up a table of the data, so we can
    // later sort it so the matches are listed in the right order. 
    let mydata = [];
    for (let i = 0; i < matchdata.length; i++) {
      let matchnum = matchdata[i]["matchnumber"];
      let teleopAlgaeProcessor = matchdata[i]["teleopAlgaeProcessor"];
      let teleopAlgaeNet = matchdata[i]["teleopAlgaeNet"];
      let teleopCoralOne = matchdata[i]["teleopCoralL1"];
      let teleopCoralTwo = matchdata[i]["teleopCoralL2"];
      let teleopCoralThree = matchdata[i]["teleopCoralL3"];
      let teleopCoralFour = matchdata[i]["teleopCoralL4"];
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
      return (compareMatchNumbers(rowA["matchnum"], rowB["matchnum"]));
    });
    // Build data sets; go thru each mydata row and populate the graph datasets.
    for (let i = 0; i < mydata.length; i++) {
      let matchnum = mydata[i]["matchnum"];
      matchList.push(matchnum);
      let tipStr = "";

      function storeAndGetTip(value, tipPrefix, dataset) {
        dataset.push(value);
        return tipPrefix + value;
      }

      teleopAlgaeProcessorTips.push({ xlabel: matchnum, tip: storeAndGetTip(mydata[i]["teleopprocessor"], "Processor=", datasets[0]["data"]) });
      teleopAlgaeNetTips.push({ xlabel: matchnum, tip: storeAndGetTip(mydata[i]["teleopnet"], "Processor=", datasets[1]["data"]) });
      teleopCoralL1Tips.push({ xlabel: matchnum, tip: storeAndGetTip(mydata[i]["levelone"], "L1=", datasets[2]["data"]) });
      teleopCoralL2Tips.push({ xlabel: matchnum, tip: storeAndGetTip(mydata[i]["leveltwo"], "L2=", datasets[3]["data"]) });
      teleopCoralL3Tips.push({ xlabel: matchnum, tip: storeAndGetTip(mydata[i]["levelthree"], "L3=", datasets[4]["data"]) });
      teleopCoralL4Tips.push({ xlabel: matchnum, tip: storeAndGetTip(mydata[i]["levelfour"], "L4=", datasets[5]["data"]) });
    }

    // Define the graph as a line chart:
    if (teleopChart !== undefined) {
      teleopChart.destroy();
    }

    // Create the Teleop graph
    const ctx = document.getElementById('teleopChart').getContext('2d');
    teleopChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: matchList,
        datasets: datasets
      },
      options: {
        scales: {
          x: { stacked: true },
          y: { stacked: true, min: 0, ticks: { precision: 0 }, max: 12 }
        },
        plugins: {
          tooltip: {
            callbacks: {  // Special tooltip handling
              label: function (tooltipItem, ddata) {

                function getTip(matchno, tipList) {
                  for (let i = 0; i < tipList.length; i++)
                    if (tipList[i].xlabel === matchno)
                      return tipList[i].tip;
                }

                let matchnum = tooltipItem.label;
                let tipStr = datasets[tooltipItem.datasetIndex].label;
                switch (tooltipItem.datasetIndex) {
                  case 0: return getTip(matchnum, teleopAlgaeProcessorTips);
                  case 1: return getTip(matchnum, teleopAlgaeNetTips);
                  case 2: return getTip(matchnum, teleopCoralL1Tips);
                  case 3: return getTip(matchnum, teleopCoralL2Tips);
                  case 4: return getTip(matchnum, teleopCoralL3Tips);
                  case 5: return getTip(matchnum, teleopCoralL4Tips);
                  default: return "missing tip string!"
                }
                return tipStr;
              }
            }
          }
        }
      }
    });
  }

  ///// TELEOP GRAPH ENDS HERE /////

  ///// ENDGAME GRAPH STARTS HERE /////

  function loadEndgameGraph(matchdata) {
    console.log("==> teamLookup: loadEndgameGraph()");
    let matchList = [];
    let datasets = [];
    let cageClimbTips = [];

    datasets.push({ label: "Cage Climb", data: [], backgroundColor: '#ED8537' });

    // Go thru each matchdata QR code string and build up a table of the data, so we can
    // later sort it so the matches are listed in the right order. 
    let mydata = [];
    for (let i = 0; i < matchdata.length; i++) {
      let matchnum = matchdata[i]["matchnumber"];
      let cageClimb = matchdata[i]["cageClimb"];
      mydata.push({
        matchnum: matchnum,
        cage: cageClimb,
      });
    }
    mydata.sort(function (rowA, rowB) {
      return (compareMatchNumbers(rowA["matchnum"], rowB["matchnum"]));
    });


    // Build data sets; go thru each mydata row and populate the graph datasets.
    for (let i = 0; i < mydata.length; i++) {
      let matchnum = mydata[i]["matchnum"];
      matchList.push(matchnum);

      value = { 0: "N/A", 1: "Parked", 2: "Fell", 3: "Shallow", 4: "Deep" };

      // Get endgame climb cage level
      let cageClimb = mydata[i]["cage"];
      datasets[0]["data"].push(cageClimb);
      cageClimbTips.push({ xlabel: matchnum, tip: "Cage Climb =" + value[cageClimb] });
    }

    if (endgameChart !== undefined) {
      endgameChart.destroy();
    }

    // Create the Endgame graph
    const ctx = document.getElementById('endgameChart').getContext('2d');
    endgameChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: matchList,
        datasets: datasets
      },
      options: {
        scales: {
          x: { stacked: true },
          y: { stacked: true, min: 0, ticks: { precision: 0 }, max: 4 }
        },
        plugins: {
          tooltip: {
            callbacks: {  // Special tooltip handling
              label: function (tooltipItem, ddata) {

                function getTip(matchno, tipList) {
                  for (let i = 0; i < tipList.length; i++)
                    if (tipList[i].xlabel === matchno)
                      return tipList[i].tip;
                }

                let matchnum = tooltipItem.label;
                let tipStr = datasets[tooltipItem.datasetIndex].label;
                switch (tooltipItem.datasetIndex) {
                  case 0: return getTip(matchnum, cageClimbTips);
                  default: return "missing tip string!"
                }
                return tipStr;
              }
            }
          }
        }
      }
    });
  }

  ///// ENDGAME GRAPH END HERE /////

  // Create an html table row with tr and td cells
  function writeAverageTableRow(tableID, dict, keys, length) {
    let tbodyRef = document.getElementById(tableID).querySelector('tbody');
    let row = "<th  style='text-align:left'>" + dict[keys[0]] + "</th>";
    for (let i = 1; i < length; i++) {
      row += (i < keys.length) ? "<td>" + dict[keys[i]] + "</td>" : "<td> </td>";
    }
    tbodyRef.insertRow().innerHTML = row;
  }

  // Generate all of the table data and fill them
  function loadAverageData(avgs) {
    console.log("==> teamLookup: loadAverageData()");

    /////// Match Totals Table
    avgs["totalCoralStr"] = "<b>Coral Scored</b>";
    avgs["totalAlgaeStr"] = "<b>Algae Scored</b>";
    avgs["totalCoralPointsStr"] = "<b>Coral Points</b>";
    avgs["totalAlgaePointsStr"] = "<b>Algae Points</b>";

    writeAverageTableRow("matchSheetTable", avgs, ["totalCoralStr", "avgTotalCoral", "maxTotalCoral"], 3);
    writeAverageTableRow("matchSheetTable", avgs, ["totalAlgaeStr", "avgTotalAlgae", "maxTotalAlgae"], 3);
    writeAverageTableRow("matchSheetTable", avgs, ["totalCoralPointsStr", "avgTotalCoralPoints", "maxTotalCoralPoints"], 3);
    writeAverageTableRow("matchSheetTable", avgs, ["totalAlgaePointsStr", "avgTotalAlgaePoints", "maxTotalAlgaePoints"], 3);

    avgs["totalMatchPointsStr"] = "<b>Match Points</b>";
    avgs["avgTotalMatchPoints"] = rnd(avgs["avgTotalCoralPoints"] + avgs["avgTotalAlgaePoints"]);
    avgs["maxTotalMatchPoints"] = rnd(avgs["maxTotalCoralPoints"] + avgs["maxTotalAlgaePoints"]);
    writeAverageTableRow("matchSheetTable", avgs, ["totalMatchPointsStr", "avgTotalMatchPoints", "maxTotalMatchPoints"], 3);

    //Auton Table  
    avgs["autonpointsStr"] = "<b>Total Points</b>";
    avgs["autontotalcoralStr"] = "<b>Coral Scored</b>";
    avgs["autontotalalgaeStr"] = "<b>Algae Scored</b>";
    avgs["autoncoralpointsStr"] = "<b>Coral Points</b>";
    avgs["autonalgaepointsStr"] = "<b>Algae Points</b>";

    writeAverageTableRow("autonTable", avgs, ["autonpointsStr", "avgTotalAutoPoints", "maxTotalAutoPoints"], 3);
    writeAverageTableRow("autonTable", avgs, ["autontotalcoralStr", "avgAutonCoral", "maxAutonCoral"], 3);
    writeAverageTableRow("autonTable", avgs, ["autontotalalgaeStr", "avgAutonAlgae", "maxAutonAlgae"], 3);
    writeAverageTableRow("autonTable", avgs, ["autoncoralpointsStr", "avgTotalAutoCoralPoints", "maxTotalAutoCoralPoints"], 3);
    writeAverageTableRow("autonTable", avgs, ["autonalgaepointsStr", "avgTotalAutoAlgaePoints", "maxTotalAutoAlgaePoints"], 3);

    // Teleop Table

    avgs["teleoppointsStr"] = "<b>Total Points</b>";
    avgs["teleoptotalcoralStr"] = "<b>Coral Scored</b>";
    avgs["teleoptotalalgaeStr"] = "<b>Algae Scored</b>";
    avgs["teleopcoralpointsStr"] = "<b>Coral Points</b>";
    avgs["teleopalgaepointsStr"] = "<b>Algae Points</b>";
    avgs["teleopcoralaccuracyStr"] = "<b>Coral Acc%</b>";
    avgs["teleopalgaeaccuracysStr"] = "<b>Algae Acc%</b>";

    writeAverageTableRow("teleopTable", avgs, ["teleoppointsStr", "avgTotalTeleopPoints", "maxTotalTeleopPoints"], 3);
    writeAverageTableRow("teleopTable", avgs, ["teleoptotalcoralStr", "avgTeleopCoralScored", "maxTeleopCoralScored"], 3);
    writeAverageTableRow("teleopTable", avgs, ["teleoptotalalgaeStr", "avgTeleopAlgaeScored", "maxTeleopAlgaeScored"], 3);
    writeAverageTableRow("teleopTable", avgs, ["teleopcoralpointsStr", "avgTotalTeleopCoralPoints", "maxTotalTeleopCoralPoints"], 3);
    writeAverageTableRow("teleopTable", avgs, ["teleopalgaepointsStr", "avgTotalTeleopAlgaePoints", "maxTotalTeleopAlgaePoints"], 3);
    writeAverageTableRow("teleopTable", avgs, ["teleopcoralaccuracyStr", "teleopCoralScoringPercent"], 3);
    writeAverageTableRow("teleopTable", avgs, ["teleopalgaeaccuracysStr", "teleopAlgaeScoringPercent"], 3);

    /////// Endgame Table
    avgs["totalEndGamePointsStr"] = "<b>Endgame Points</b>";
    avgs["endgameClimbPercent"]["endgameclimbStr"] = "<b>Cage Climb %</b>";

    writeAverageTableRow("endgameTotalPtsTable", avgs, ["totalEndGamePointsStr", "avgEndgamePoints", "maxEndgamePoints"], 3);
    writeAverageTableRow("endgameClimbTable", avgs["endgameClimbPercent"], ["endgameclimbStr", 0, 2, 1, 3, 4], 6);
  }

  // filters out the match type as specified in the db status page
  function getFilteredData(team, successFunction) {
    console.log("==> teamLookup: getFilteredData: " + team);
    let tempThis = this;

    $.post("api/dbAPI.php", {
      getDBStatus: true
    }, function (dbStatus) {
      console.log("=> getDBStatus");
      dbdata = JSON.parse(dbStatus);
      let localSiteFilter = {};
      localSiteFilter["useP"] = dbdata["useP"];
      localSiteFilter["useQm"] = dbdata["useQm"];
      localSiteFilter["useQf"] = dbdata["useQf"];
      localSiteFilter["useSf"] = dbdata["useSf"];
      localSiteFilter["useF"] = dbdata["useF"];

      $.get("api/dbReadAPI.php", {
        getTeamMatches: team
      }).done(function (getTeamMatches) {
        console.log("=> getTeamMatches");
        getTeamMatches = JSON.parse(getTeamMatches);

        let newData = [];
        for (let i = 0; i < getTeamMatches.length; i++) {
          let mn = getTeamMatches[i]["matchnumber"];
          let mt = "-";
          let matchStr = mn.toLowerCase();

          if (matchStr.search("p") != -1) { mt = "p"; }
          else if (matchStr.search("qm") != -1) { mt = "qm"; }
          else if (matchStr.search("qf") != -1) { mt = "qf"; }
          else if (matchStr.search("sf") != -1) { mt = "sf"; }
          else if (matchStr.search("f") != -1) { mt = "f"; }

          if (mt === "p" && localSiteFilter["useP"]) { newData.push(getTeamMatches[i]); }
          else if (mt === "qm" && localSiteFilter["useQm"]) { newData.push(getTeamMatches[i]); }
          else if (mt === "qf" && localSiteFilter["useQf"]) { newData.push(getTeamMatches[i]); }
          else if (mt === "sf" && localSiteFilter["useSf"]) { newData.push(getTeamMatches[i]); }
          else if (mt === "f" && localSiteFilter["useF"]) { newData.push(getTeamMatches[i]); }
        }
        getTeamMatches = [...newData];

        successFunction(getTeamMatches);
      });
    });
  }

  // Gets the matches and puts them into the html rows
  function sortMatchData(tableId, matchCol) {
    let tableRef = document.getElementById(tableId);
    let rows = Array.prototype.slice.call(tableRef.querySelectorAll("tbody > tr")); // All "tr" in <tbody>
    rows.sort(function (rowA, rowB) {
      return (compareMatchNumbers(rowA.cells[matchCol].textContent.trim(), rowB.cells[matchCol].textContent.trim()));
    });
    // Update the table body with the sorted rows.
    rows.forEach(function (row) {
      tableRef.querySelector("tbody").appendChild(row);
    });
  }

  // Gets the strategic match info and puts them into the html rows
  function sortStrategicData(tableId, matchCol) {
    let tableRef = document.getElementById(tableId);
    let rows = Array.prototype.slice.call(tableRef.querySelectorAll("tbody > tr")); // All "tr" in <tbody>
    rows.sort(function (rowA, rowB) {
      return (compareMatchNumbers(rowA.cells[matchCol].textContent.trim(), rowB.cells[matchCol].textContent.trim()));
    });
    // Update the table body with the sorted rows.
    rows.forEach(function (row) {
      tableRef.querySelector("tbody").appendChild(row);
    });
  }

  // Loads the match data table
  function teamMatchDataTable(dataObj) {
    console.log("==> teamLookup: teamMatchDataTable()");
    let tbodyRef = document.getElementById("matchDataTable").querySelector('tbody');
    tbodyRef.innerHTML = "";     // clear table
    for (let i = 0; i < dataObj.length; i++) {
      let rowString = "<td>" + dataObj[i]["matchnumber"] + "</td>" +
        "<td>" + dataObj[i]["autonLeave"] + "</td>" +

        "<td>" + dataObj[i]["autonCoralL1"] + "</td>" +
        "<td>" + dataObj[i]["autonCoralL2"] + "</td>" +
        "<td>" + dataObj[i]["autonCoralL3"] + "</td>" +
        "<td>" + dataObj[i]["autonCoralL4"] + "</td>" +

        "<td>" + dataObj[i]["autonAlgaeNet"] + "</td>" +
        "<td>" + dataObj[i]["autonAlgaeProcessor"] + "</td>" +

        "<td>" + dataObj[i]["acquiredCoral"] + "</td>" +
        "<td>" + dataObj[i]["acquiredAlgae"] + "</td>" +

        "<td>" + dataObj[i]["teleopCoralL1"] + "</td>" +
        "<td>" + dataObj[i]["teleopCoralL2"] + "</td>" +
        "<td>" + dataObj[i]["teleopCoralL3"] + "</td>" +
        "<td>" + dataObj[i]["teleopCoralL4"] + "</td>" +

        "<td>" + dataObj[i]["teleopAlgaeNet"] + "</td>" +
        "<td>" + dataObj[i]["teleopAlgaeProcessor"] + "</td>" +

        "<td>" + dataObj[i]["cageClimb"] + "</td>" +
        "<td>" + dataObj[i]["died"] + "</td>" +
        "<td>" + dataObj[i]["scoutname"] + "</td>" +
        "<td>" + dataObj[i]["comment"] + "</td>";
      tbodyRef.insertRow().innerHTML = rowString;
    }
    sortMatchData("matchDataTable", matchColumn);
  }

  // Converts a given "1" to yes, "0" to no, anything else to empty string.
  function toYesNo(value) {
    switch (String(value)) {
      case "1": return "Yes";
      case "2": return "No";
      default: return "-";
    }
  }

  // MAIN PROCESSORS HERE

  // Check if our URL directs to a specific team
  function checkURLForTeamSpec() {
    console.log("=> teamLookup: checkURLForTeamSpec()");
    let sp = new URLSearchParams(window.location.search);
    if (sp.has('teamNum')) {
      return sp.get('teamNum')
    }
    return null;
  }

  // Takes list of Team photo paths and loads them.
  function loadTeamPhotos(teamPhotos) {
    console.log("==> teamLookup: loadTeamPhotos()");
    let first = true;
    for (let uri of teamPhotos) {
      let tags = "";
      if (first) {
        tags += "<div class='carousel-item active'>";
      } else {
        tags += "<div class='carousel-item'>";
      }
      first = false;
      tags += " <img src='./" + uri + "' class='d-block w-100'>";
      tags += "</div>";
      document.getElementById("robotPics").innerHTML += tags;
    }
  }

  // Load the match data table
  function loadMatchData(team, allEventMatches) {
    console.log("==> teamLookup: loadMatchData()");
    let mdp = new matchDataProcessor(allEventMatches);
    mdp.sortMatches(allEventMatches);
    mdp.getSiteFilteredAverages(function (averageData) {
      processedData = averageData[team];
      loadAverageData(processedData);
    });
    getFilteredData(team, function (fData) {
      filteredData = fData;
      loadAutonGraph(filteredData);
      loadTeleopGraph(filteredData);
      loadEndgameGraph(filteredData);
      teamMatchDataTable(filteredData);
    });
  }

  // Create a row in the pit data table
  function writePitTableRow(tableID, dict, keys, length) {
    let tbodyRef = document.getElementById(tableID).querySelector('tbody');
    let row = "";
    for (let i = 0; i < length; i++) {
      row += (i < keys.length) ? "<td>" + dict[keys[i]] + "</td>" : "<td> </td>";
    }
    tbodyRef.insertRow().innerHTML = row;
  }

  // Load the pit data table for this team
  function loadPitData(pitData) {
    console.log("==> teamLookup: loadPitData()");
    if (!pitData || !pitData.length) {
      // row one    
      pitData["swervedrivestring"] = pitData["swerve"] ? "Yes" : "No";
      pitData["drivemotors"];
      pitData["sparepartsstring"] = pitData["spareparts"] ? "Yes" : "No";
      pitData["proglanguage"];

      // row two    
      pitData["computervisionstring"] = pitData["computervision"] ? "Yes" : "No";
      pitData["pitorg"];
      pitData["preparedness"];
      pitData["numbatteries"];
    }

    writePitTableRow("pitTable1", pitData, ["swervedrivestring", "drivemotors", "sparepartsstring", "proglanguage"], 4);
    writePitTableRow("pitTable2", pitData, ["computervisionstring", "pitorg", "preparedness", "numbatteries"], 4);
  }

  // Load the strategic data table for this team
  function loadStrategicData(dataObj) {
    console.log("==> teamLookup: loadStrategicData()");
    let tbodyRef = document.getElementById("strategicDataTable").querySelector('tbody');
    tbodyRef.innerHTML = "";     // clear table
    for (let i = 0; i < dataObj.length; i++) {
      let driverability = dataObj[i]["driverability"];
      switch (driverability) {
        case "1": driveVal = "Jerky"; break;
        case "2": driveVal = "Slow"; break;
        case "3": driveVal = "Average"; break;
        case "4": driveVal = "Quick"; break;
        case "5": driveVal = "-"; break;
        default: driveVal = ""; break;
      }

      let rowString = "<td>" + dataObj[i]["matchnumber"] + "</td>" +
        "<td>" + driveVal + "</td>" +
        "<td>" + toYesNo(dataObj[i]["against_tactic1"]) + "</td>" +
        "<td>" + dataObj[i]["against_comment"] + "</td>" +

        "<td>" + toYesNo(dataObj[i]["defense_tactic1"]) + "</td>" +
        "<td>" + toYesNo(dataObj[i]["defense_tactic2"]) + "</td>" +
        "<td>" + dataObj[i]["defense_comment"] + "</td>" +

        "<td>" + toYesNo(dataObj[i]["foul1"]) + "</td>" +
        "<td>" + toYesNo(dataObj[i]["autonFoul1"]) + "</td>" +
        "<td>" + toYesNo(dataObj[i]["autonFoul2"]) + "</td>" +
        "<td>" + toYesNo(dataObj[i]["teleopFoul1"]) + "</td>" +
        "<td>" + toYesNo(dataObj[i]["teleopFoul2"]) + "</td>" +
        "<td>" + toYesNo(dataObj[i]["teleopFoul3"]) + "</td>" +
        "<td>" + toYesNo(dataObj[i]["teleopFoul4"]) + "</td>" +
        "<td>" + toYesNo(dataObj[i]["endgameFoul1"]) + "</td>" +

        "<td>" + toYesNo(dataObj[i]["autonGetCoralFromFloor"]) + "</td>" +
        "<td>" + toYesNo(dataObj[i]["autonGetCoralFromStation"]) + "</td>" +
        "<td>" + toYesNo(dataObj[i]["autonGetAlgaeFromFloor"]) + "</td>" +
        "<td>" + toYesNo(dataObj[i]["autonGetAlgaeFromReef"]) + "</td>" +
        "<td>" + toYesNo(dataObj[i]["teleopFloorPickupAlgae"]) + "</td>" +
        "<td>" + toYesNo(dataObj[i]["teleopFloorPickupCoral"]) + "</td>" +
        "<td>" + toYesNo(dataObj[i]["teleopKnockOffAlgaeFromReef"]) + "</td>" +
        "<td>" + toYesNo(dataObj[i]["teleopAcquireAlgaeFromReef"]) + "</td>" +

        "<td>" + dataObj[i]["problem_comment"] + "</td>" +
        "<td>" + dataObj[i]["general_comment"] + "</td>" +
        "<td>" + dataObj[i]["scoutname"] + "</td>";
      tbodyRef.innerHTML = rowString;
    }
    sortStrategicData("strategicDataTable", matchColumn);
  }

  // This is the main function that runs when we want to load a team 
  function buildTeamLookupPage(teamNum) {
    console.log("==> teamLookup: buildTeamLookupPage()");
    // Clear existing data
    document.getElementById("teamTitle").innerHTML = "";
    document.getElementById("robotPics").innerHTML = "";
    document.getElementById("matchSheetTable").querySelector('tbody').innerHTML = "";
    document.getElementById("autonTable").querySelector('tbody').innerHTML = "";
    document.getElementById("teleopTable").querySelector('tbody').innerHTML = "";
    document.getElementById("endgameTotalPtsTable").querySelector('tbody').innerHTML = "";
    document.getElementById("endgameClimbTable").querySelector('tbody').innerHTML = "";
    document.getElementById("pitTable1").querySelector('tbody').innerHTML = "";
    document.getElementById("pitTable2").querySelector('tbody').innerHTML = "";
    document.getElementById("strategicDataTable").querySelector('tbody').innerHTML = "";
    document.getElementById("matchDataTable").querySelector('tbody').innerHTML = "";

    // Get team name from TBA
    $.get("api/tbaAPI.php", {
      getTeamInfo: teamNum
    }).done(function (teamInfo) {
      console.log("=> getTeamInfo");
      let teamname = "XX";
      if (teamInfo === null)
        alert("Can't load teamName from TBA; check if TBA Key was set in db_config");
      else {
        // console.log("==> teamLookup: getTeamInfo:\n" + teamInfo);
        jsonTeamInfo = JSON.parse(teamInfo)["response"];
        teamname = jsonTeamInfo["nickname"];
        console.log("==> teamLookup: for " + teamNum + ", teamname = " + teamname);
      }
      if (teamname != "XX") {
        document.getElementById("teamTitle").innerHTML = teamNum + " - " + teamname;
      } else {
        document.getElementById("teamTitle").innerHTML = teamNum;
      }
    });

    // Add images for the team
    $.get("api/dbReadAPI.php", {
      getImagesForTeam: teamNum
    }).done(function (teamImages) {
      console.log("=> getImagesForTeam");
      let jsonTeamImages = JSON.parse(teamImages);
      console.log("==> PHOTOS: " + jsonTeamImages);
      loadTeamPhotos(jsonTeamImages);
    });

    // Add Match Scouting Data
    $.get("api/dbReadAPI.php", {
      getTeamMatches: teamNum
    }).done(function (teamMatches) {
      console.log("=> getTeamMatches");
      jsonMatchData = JSON.parse(teamMatches);
      loadMatchData(teamNum, jsonMatchData);

      // Do the Pit Scouting Data
      $.get("api/dbReadAPI.php", {
        getTeamPitData: teamNum
      }).done(function (teamPitData) {
        console.log("=> getTeamPitData\n");
        jsonPitData = JSON.parse(teamPitData);
        loadPitData(jsonPitData);

        // Do the Strategic Data Table.
        $.get("api/dbReadAPI.php", {
          getTeamStrategicData: teamNum
        }).done(function (strategicData) {
          console.log("=> getTeamStrategicData");
          jsonStratData = JSON.parse(strategicData);
          loadStrategicData(jsonStratData);
        });
      });
    });
  }

  /////////////////////////////////////////////////////////////////////////////
  //
  // Process the generated html
  //
  document.addEventListener("DOMContentLoaded", () => {

    // Update the navbar with the event code
    $.get("api/tbaAPI.php", {
      getEventCode: true
    }, function (eventCode) {
      eventCode = eventCode.trim();
      console.log("=> teamLookup: getEventCode: " + eventCode);
      document.getElementById("navbarEventCode").innerHTML = eventCode;
    });

    // Check URL for source team to load
    let initTeamNumber = checkURLForTeamSpec();
    if (initTeamNumber) {
      buildTeamLookupPage(initTeamNumber);
    }

    // Pressing enter in team number field loads the page
    let input = document.getElementById("enterTeamNumber");
    input.addEventListener("keypress", function (event) {
      if (event.key === "Enter") {
        event.preventDefault();
        document.getElementById("loadTeamButton").click();
      }
    });

    // Load team data for the number entered
    document.getElementById("loadTeamButton").addEventListener('click', function () {
      buildTeamLookupPage(document.getElementById("enterTeamNumber").value);
    });

    // // Create frozen table panes and keep the panes updated
    // let frozenTableStrat = new FreezeTable('.freeze-table', { fixedNavbar: '.navbar' });
    // document.getElementById(stratId).addEventListener('click', function () {
    //   if (frozenTableStrat) {
    //     frozenTableStrat.update();
    //   }
    // });

    // // Create frozen table panes and keep the panes updated
    // let frozenTableMatch = new FreezeTable('.freeze-table', { fixedNavbar: '.navbar' });
    // document.getElementById(matchId).addEventListener('click', function () {
    //   if (frozenTableMatch) {
    //     frozenTableMatch.update();
    //   }
    // });
  });
</script>

<script src="./scripts/compareMatchNumbers.js"></script>
<script src="./scripts/matchDataProcessor.js"></script>
