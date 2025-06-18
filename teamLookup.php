<?php
$title = 'Team Lookup';
require 'inc/header.php';
?>

<div class="container row-offcanvas row-offcanvas-left">
  <div id="content" class="column card-lg-12 col-sm-12 col-xs-12">

    <!-- Page Title -->
    <div class="row pt-3 pb-3 mb-3">
      <h2><?php echo $title; ?></h2>
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
                <table id="matchTotalTable"
                  class="table table-striped table-bordered table-hover table-sm table-bordered border-dark text-center ">
                  <thead>
                    <tr>
                      <th scope="col" style="text-align:left">Totals</th>
                      <th scope="col">AVG</th>
                      <th scope="col">MAX</th>
                    </tr>
                  </thead>
                  <tbody id="totalTableBody">
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
                <table id="autonTable"
                  class="table table-striped table-bordered table-hover table-sm table-bordered border-dark text-center ">
                  <thead>
                    <tr>
                      <th scope="col" style="text-align:left"></th>
                      <th scope="col">AVG</th>
                      <th scope="col">MAX</th>
                    </tr>
                  </thead>
                  <tbody id="autoTableBody">
                    <tr>
                      <th scope="row" style="text-align:left">Auton Points</th>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <th scope="row" style="text-align:left">Coral Scored</th>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <th scope="row" style="text-align:left">Algae Scored</th>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <th scope="row" style="text-align:left">Coral Points</th>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <th scope="row" style="text-align:left">Algae Points</th>
                      <td></td>
                      <td></td>
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
                <table id="teleopTable"
                  class="table table-striped table-bordered table-hover table-sm table-bordered border-dark text-center ">
                  <thead>
                    <tr>
                      <th scope="col" style="text-align:left"></th>
                      <th scope="col">AVG</th>
                      <th scope="col">MAX</th>
                    </tr>
                  </thead>
                  <tbody id="teleopTableBody">
                    <tr>
                      <th scope="row" style="text-align:left">Teleop Points</th>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <th scope="row" style="text-align:left">Coral Scored</th>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <th scope="row" style="text-align:left">Algae Scored</th>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <th scope="row" style="text-align:left">Coral Points</th>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <th scope="row" style="text-align:left">Algae Points</th>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <th scope="row" style="text-align:left">Coral Acc%</th>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <th scope="row" style="text-align:left">Algae Acc%</th>
                      <td></td>
                      <td></td>
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
                  class="table table-striped table-bordered table-hover table-sm table-bordered border-dark text-center ">
                  <thead>
                    <tr>
                      <th scope="col" style="text-align:left"></th>
                      <th scope="col">AVG</th>
                      <th scope="col">MAX</th>
                    </tr>
                  </thead>
                  <tbody id="endgameTotalPtsTableBody">
                    <tr>
                      <th scope="row" style="text-align:left">Endgame Points</th>
                      <td> </td>
                      <td> </td>
                    </tr>
                  </tbody>
                </table>
                <table id="endgameClimbTable"
                  class="table table-striped table-bordered table-hover table-sm table-bordered border-dark text-center ">
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
                  <tbody id="endgameClimbTableBody">
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
            <div id="freeze-table-2" class="freeze-table overflow-auto">
              <table id="sortableStrategicData" class="table table-striped table-sm bordered border-dark sortable">
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
                    <th colspan="24" class="text-center">Strategic Scouting</th>
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
                    <th colspan="4" class="text-center">Auton/th>
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

        <!-- Pit scouting collapsible table -->
        <div class="card mb-3">
          <div class="card-header">
            <h5 class="text-center">
              <a href="#collapsePitData" data-bs-toggle="collapse" aria-expanded="false">Pit Scouting</a>
            </h5>
          </div>
          <!-- Pit Scouting 1st row -->
          <div id="collapsePitData" class="card-body collapse">
            <table class="table table-striped table-sm table-bordered border-dark">
              <thead>
                <colgroup>
                  <col span="1" style="background-color:transparent">
                  <col span="1" style="background-color:#cfe2ff">
                  <col span="1" style="background-color:transparent">
                  <col span="1" style="background-color:#cfe2ff">
                  <col span="1" style="background-color:transparent">
                </colgroup>
                <tr>
                  <th scope="col" style="width:25%">Swerve</th>
                  <th scope="col" style="width:25%">Motors</th>
                  <th scope="col" style="width:25%">Spares</th>
                  <th scope="col" style="width:25%">Language</th>
                </tr>
              </thead>
              <tbody id="pitRow1">
              </tbody>
            </table>

            <!-- Pit Scouting 2nd row -->
            <table class="table table-striped table-sm table-bordered border-dark">
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
                  <th scope="col" style="width:25%">Vision</th>
                  <th scope="col" style="width:25%">Pit</th>
                  <th scope="col" style="width:25%">Prep</th>
                  <th scope="col" style="width:25%">Batteries</th>
                </tr>
              </thead>
              <tbody id="pitRow2">
              </tbody>
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
            <div id="freeze-table" class="freeze-table overflow-auto">
              <table id="sortableAllMatches" class="table table-striped table-sm table-bordered border-dark sortable">
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
                <tbody id="matchDataTable">
                </tbody>
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
  var autoChartDefined = false;
  var autoChart;

  var teleopChartDefined = false;
  var teleopChart;

  var endgameChartDefined = false;
  var endgameChart;

  var frozenTableMatches = null;
  var frozenTableStrategy = null;


  ///// AUTON GRAPH STARTS HERE /////

  function loadAutonGraph(matchdata) {
    console.log("==> teamLookup: loadAutonGraph()");

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

    datasets.push({ label: "Leave Start", data: [], backgroundColor: '#F7CF58' });
    datasets.push({ label: "Processor", data: [], backgroundColor: '#B4E7D6' });
    datasets.push({ label: "Net", data: [], backgroundColor: '#4C9F7C' });
    datasets.push({ label: "L1", data: [], backgroundColor: '#D98AB3' });
    datasets.push({ label: "L2", data: [], backgroundColor: '#CE649B' });
    datasets.push({ label: "L3", data: [], backgroundColor: '#C54282' });
    datasets.push({ label: "L4", data: [], backgroundColor: '#9D3468' });

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
      return (compareMatchNumbers(rowA["matchnum"], rowB["matchnum"]));
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
          x: { stacked: true },
          y: { stacked: true }
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

  ///// AUTON GRAPH ENDS HERE /////

  ///// TELEOP GRAPH STARTS HERE /////

  function loadTeleopGraph(matchdata) {
    console.log("==> teamLookup: loadTeleopGraph()");

    // Declare variables
    var matchList = []; // List of matches to use as x lables
    var datasets = []; // Each entry is a dict with a label and data attribute
    var teleopAlgaeProcessorTips = []; // holds custom tooltips for teleop speaker notes
    var teleopAlgaeNetTips = [];//holds custom tooltips for if amplification used
    var teleopCoralL1Tips = []; // holds custom tooltips for teleop coral L1
    var teleopCoralL2Tips = []; // holds custom tooltips for teleop coral L2
    var teleopCoralL3Tips = []; // holds custom tooltips for teleop coral L3
    var teleopCoralL4Tips = []; // holds custom tooltips for teleop coral 4      

    datasets.push({ label: "Processor", data: [], backgroundColor: '#B4E7D6' });
    datasets.push({ label: "Net", data: [], backgroundColor: '#4C9F7C' });
    datasets.push({ label: "L1", data: [], backgroundColor: '#D98AB3' });
    datasets.push({ label: "L2", data: [], backgroundColor: '#CE649B' });
    datasets.push({ label: "L3", data: [], backgroundColor: '#C54282' });
    datasets.push({ label: "L4", data: [], backgroundColor: '#9D3468' });

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
      return (compareMatchNumbers(rowA["matchnum"], rowB["matchnum"]));
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
          x: { stacked: true },
          y: { stacked: true }
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

  ///// TELEOP GRAPH ENDS HERE /////

  ///// ENDGAME GRAPH STARTS HERE /////

  function loadEndgameGraph(matchdata) {
    console.log("==> teamLookup: loadEndgameGraph()");
    var matchList = [];
    var datasets = [];
    var cageClimbTips = [];

    datasets.push({ label: "Cage Climb", data: [], backgroundColor: '#ED8537' });

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
      return (compareMatchNumbers(rowA["matchnum"], rowB["matchnum"]));
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
          x: { stacked: true },
          y: { stacked: true }
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

  ///// ENDGAME GRAPH END HERE /////

  // Create an html table row with tr and td cells
  function writeTableRow(tbodyID, dict, keys, length) {
    var row = "<tr>";
    row += "<th  style='text-align:left'>" + dict[keys[0]] + "</th>";
    for (let i = 1; i < length; i++) {
      if (i < keys.length)
        row += "<td>" + dict[keys[i]] + "</td>";
      else
        row += "<td></td>"
    }
    row += "</th>";
    row += "</tr>";
    $("#" + tbodyID).append(row);
  }

  // Generate all of the table data and fill them
  function loadAvgData(avgs) {
    console.log("==> teamLookup: loadAvgData()");

    /////// Match Totals Table
    avgs["totalCoralStr"] = "<b>Coral Scored</b>";
    avgs["totalAlgaeStr"] = "<b>Algae Scored</b>";
    avgs["totalCoralPointsStr"] = "<b>Coral Points</b>";
    avgs["totalAlgaePointsStr"] = "<b>Algae Points</b>";

    writeTableRow("totalTableBody", avgs, ["totalCoralStr", "avgTotalCoral", "maxTotalCoral"], 3);
    writeTableRow("totalTableBody", avgs, ["totalAlgaeStr", "avgTotalAlgae", "maxTotalAlgae"], 3);
    writeTableRow("totalTableBody", avgs, ["totalCoralPointsStr", "avgTotalCoralPoints", "maxTotalCoralPoints"], 3);
    writeTableRow("totalTableBody", avgs, ["totalAlgaePointsStr", "avgTotalAlgaePoints", "maxTotalAlgaePoints"], 3);

    avgs["totalMatchPointsStr"] = "<b>Match Points</b>";
    avgs["avgTotalMatchPoints"] = avgs["avgTotalCoralPoints"] + avgs["avgTotalAlgaePoints"];
    avgs["maxTotalMatchPoints"] = avgs["maxTotalCoralPoints"] + avgs["maxTotalAlgaePoints"];
    writeTableRow("totalTableBody", avgs, ["totalMatchPointsStr", "avgTotalMatchPoints", "maxTotalMatchPoints"], 3);

    //Auton Table  
    avgs["autonpointsStr"] = "<b>Total Points</b>";
    avgs["autontotalcoralStr"] = "<b>Coral Scored</b>";
    avgs["autontotalalgaeStr"] = "<b>Algae Scored</b>";
    avgs["autoncoralpointsStr"] = "<b>Coral Points</b>";
    avgs["autonalgaepointsStr"] = "<b>Algae Points</b>";

    writeTableRow("autoTableBody", avgs, ["autonpointsStr", "avgTotalAutoPoints", "maxTotalAutoPoints"], 3);
    writeTableRow("autoTableBody", avgs, ["autontotalcoralStr", "avgAutonCoral", "maxAutonCoral"], 3);
    writeTableRow("autoTableBody", avgs, ["autontotalalgaeStr", "avgAutonAlgae", "maxAutonAlgae"], 3);
    writeTableRow("autoTableBody", avgs, ["autoncoralpointsStr", "avgTotalAutoCoralPoints", "maxTotalAutoCoralPoints"], 3);
    writeTableRow("autoTableBody", avgs, ["autonalgaepointsStr", "avgTotalAutoAlgaePoints", "maxTotalAutoAlgaePoints"], 3);

    // Teleop Table

    avgs["teleoppointsStr"] = "<b>Total Points</b>";
    avgs["teleoptotalcoralStr"] = "<b>Coral Scored</b>";
    avgs["teleoptotalalgaeStr"] = "<b>Algae Scored</b>";
    avgs["teleopcoralpointsStr"] = "<b>Coral Points</b>";
    avgs["teleopalgaepointsStr"] = "<b>Algae Points</b>";
    avgs["teleopcoralaccuracyStr"] = "<b>Coral Acc%</b>";
    avgs["teleopalgaeaccuracysStr"] = "<b>Algae Acc%</b>";

    writeTableRow("teleopTableBody", avgs, ["teleoppointsStr", "avgTotalTeleopPoints", "maxTotalTeleopPoints"], 3);
    writeTableRow("teleopTableBody", avgs, ["teleoptotalcoralStr", "avgTeleopCoralScored", "maxTeleopCoralScored"], 3);
    writeTableRow("teleopTableBody", avgs, ["teleoptotalalgaeStr", "avgTeleopAlgaeScored", "maxTeleopAlgaeScored"], 3);
    writeTableRow("teleopTableBody", avgs, ["teleopcoralpointsStr", "avgTotalTeleopCoralPoints", "maxTotalTeleopCoralPoints"], 3);
    writeTableRow("teleopTableBody", avgs, ["teleopalgaepointsStr", "avgTotalTeleopAlgaePoints", "maxTotalTeleopAlgaePoints"], 3);
    writeTableRow("teleopTableBody", avgs, ["teleopcoralaccuracyStr", "teleopCoralScoringPercent"], 3);
    writeTableRow("teleopTableBody", avgs, ["teleopalgaeaccuracysStr", "teleopAlgaeScoringPercent"], 3);

    /////// Endgame Table
    avgs["totalEndGamePointsStr"] = "<b>Endgame Points</b>";
    avgs["endgameClimbPercent"]["endgameclimbStr"] = "<b>Cage Climb %</b>";

    writeTableRow("endgameTotalPtsTableBody", avgs, ["totalEndGamePointsStr", "avgEndgamePoints", "maxEndgamePoints"], 3);
    writeTableRow("endgameClimbTableBody", avgs["endgameClimbPercent"], ["endgameclimbStr", 0, 2, 1, 3, 4], 6);
  }

  // filters out the match type as specified in the db status page
  function getFilteredData(team, successFunction) {
    console.log("==> teamLookup: getFilteredData(): " + team);
    var tempThis = this;

    $.post("api/dbAPI.php", {
      getDBStatus: true
    }, function (dbStatus) {
      console.log("=> getDBStatus");
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
      $.get("api/dbReadAPI.php", {
        getTeamMatches: team
      }).done(function (getTeamMatches) {
        console.log("=> getTeamMatches");
        getTeamMatches = JSON.parse(getTeamMatches);

        var newData = [];
        for (var i = 0; i < getTeamMatches.length; i++) {
          var mn = getTeamMatches[i]["matchnumber"];
          var mt = "-";
          var matchStr = mn.toLowerCase();

          if (matchStr.search("p") != -1) { mt = "p"; }
          else if (matchStr.search("qm") != -1) { mt = "qm"; }
          else if (matchStr.search("qf") != -1) { mt = "qf"; }
          else if (matchStr.search("sf") != -1) { mt = "sf"; }
          else if (matchStr.search("f") != -1) { mt = "f"; }

          if (mt == "p" && localSiteFilter["useP"]) { newData.push(getTeamMatches[i]); }
          else if (mt == "qm" && localSiteFilter["useQm"]) { newData.push(getTeamMatches[i]); }
          else if (mt == "qf" && localSiteFilter["useQf"]) { newData.push(getTeamMatches[i]); }
          else if (mt == "sf" && localSiteFilter["useSf"]) { newData.push(getTeamMatches[i]); }
          else if (mt == "f" && localSiteFilter["useF"]) { newData.push(getTeamMatches[i]); }
        }
        getTeamMatches = [...newData];

        successFunction(getTeamMatches);
      });
    });
  }

  // Gets the matches and puts them into the html rows
  function sortMatchData() {
    var table = document.getElementById("sortableAllMatches");
    var rows = Array.prototype.slice.call(table.querySelectorAll("tbody> tr"));
    rows.sort(function (rowA, rowB) {
      return (compareMatchNumbers(rowA.cells[0].textContent.trim(), rowB.cells[0].textContent.trim()));
    });
    // Update the table body with the sorted rows.
    rows.forEach(function (row) {
      table.querySelector("tbody").appendChild(row);
    });
  }

  // Gets the strategic match info and puts them into the html rows
  function sortStrategicData() {
    var table = document.getElementById("sortableStrategicData");
    var rows = Array.prototype.slice.call(table.querySelectorAll("tbody> tr"));
    rows.sort(function (rowA, rowB) {
      return (compareMatchNumbers(rowA.cells[0].textContent.trim(), rowB.cells[0].textContent.trim()));
    });
    // Update the table body with the sorted rows.
    rows.forEach(function (row) {
      table.querySelector("tbody").appendChild(row);
    });
  }

  // Builds the match data table
  function loadMatchTable(dataObj) {
    console.log("==> teamLookup: loadMatchTable()");
    $("#matchDataTable").html("");  // clear table
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
      $("#matchDataTable").append(rowString);
    }
    setTimeout(function () {
      // script instructions say this is needed, but it breaks table header sorting
      // sorttable.makeSortable(document.getElementById("sortableAllMatches"));
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
    sortMatchData();
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

  // MAIN PROCESSORS HERE

  // Check if our URL directs to a specific team
  function checkGet() {
    console.log("=> teamLookup: checkGet()");
    let sp = new URLSearchParams(window.location.search);
    if (sp.has('teamNum')) {
      return sp.get('teamNum')
    }
    return null;
  }

  // Takes list of Team Pic paths and loads them.
  function loadTeamPics(teamPics) {
    console.log("==> teamLookup: loadTeamPics()");
    var first = true;
    for (let uri of teamPics) {
      var tags = "";
      if (first) {
        tags += "<div class='carousel-item active'>";
      } else {
        tags += "<div class='carousel-item'>";
      }
      first = false;
      tags += " <img src='./" + uri + "' class='d-block w-100'>";
      tags += "</div>";
      $("#robotPics").append(tags);
    }
  }

  // Build the pit data table
  function loadMatchData(team, allEventMatches) {
    console.log("==> teamLookup: loadMatchData()");
    var mdp = new matchDataProcessor(allEventMatches);
    mdp.sortMatches(allEventMatches);
    mdp.getSiteFilteredAverages(function (averageData) {
      processedData = averageData[team];
      loadAvgData(processedData);
    });
    getFilteredData(team, function (fData) {
      filteredData = fData;
      loadAutonGraph(filteredData);
      loadTeleopGraph(filteredData);
      loadEndgameGraph(filteredData);
      loadMatchTable(filteredData);
    });
  }

  // Build the pit data table
  function loadPitData(pitData) {
    console.log("==> teamLookup: loadPitData()");
    if (!pitData || !pitData.length) {
      // row one    
      pitData["swervedrivestring"] = pitData["swerve"] ? "yes" : "no";
      pitData["drivemotors"];
      pitData["sparepartsstring"] = pitData["spareparts"] ? "yes" : "no";
      pitData["proglanguage"];

      // row two    
      pitData["computervisionstring"] = pitData["computervision"] ? "yes" : "no";
      pitData["pitorg"];
      pitData["preparedness"];
      pitData["numbatteries"];
    }

    writeTableRow("pitRow1", pitData, ["swervedrivestring", "drivemotors", "sparepartsstring", "proglanguage"], 4);
    writeTableRow("pitRow2", pitData, ["computervisionstring", "pitorg", "preparedness", "numbatteries"], 4);
  }

  function loadStrategicData(dataObj) {
    console.log("==> teamLookup: dataToStrategicTable()");
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
      // script instructions say this is needed, but it breaks table header sorting
      // sorttable.makeSortable(document.getElementById("sortableStrategicData"));
      frozenTableStrategy = $('#freeze-table-2').freezeTable({
        'backgroundColor': "white",
        'columnKeep': true,
        'frozenColVerticalOffset': 0
      });
    }, 100);
    sortStrategicData();
  }

  // This is the main function that runs when we want to load a new team 
  function buildTeamLookupPage(teamNum) {
    console.log("==> teamLookup: buildTeamLookupPage()");
    // Clear existing data
    $("#teamTitle").html("");
    $("#robotPics").html("");
    $("#totalTableBody").html("");
    $("#autoTableBody").html("");
    $("#teleopTableBody").html("");
    $("#endgameTotalPtsTableBody").html("");
    $("#endgameClimbTableBody").html("");
    $("#pitRow1").html("");
    $("#pitRow2").html("");
    $("#strategicDataTable").html("");
    $("#matchDataTable").html("");

    // Get team name from TBA
    $.get("api/tbaAPI.php", {
      getTeamInfo: teamNum
    }).done(function (teamInfo) {
      console.log("=> getTeamInfo");
      var teamname = "XX";
      if (teamInfo == null)
        alert("Can't load teamName from TBA; check if TBA Key was set in db_config");
      else {
        // console.log("==> teamLookup: getTeamInfo:\n" + teamInfo);
        jsonTeamInfo = JSON.parse(teamInfo)["response"];
        teamname = jsonTeamInfo["nickname"];
        console.log("==> teamLookup: for " + teamNum + ", teamname = " + teamname);
      }
      if (teamname != "XX") {
        $("#teamTitle").html(teamNum + " - " + teamname);
      } else {
        $("#teamTitle").html("Team " + teamNum);
      }
    });

    // Add new images
    $.get("api/dbReadAPI.php", {
      getImagesForTeam: teamNum
    }).done(function (teamImages) {
      console.log("=> getImagesForTeam");
      var jsonTeamImages = JSON.parse(teamImages);
      console.log("==> PHOTOS: " + jsonTeamImages);
      loadTeamPics(jsonTeamImages);
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

  //
  // Process the generated html
  //
  $(document).ready(function () {
    // Update the navbar with the event code
    $.get("api/tbaAPI.php", {
      getEventCode: true
    }, function (eventCode) {
      console.log("=> teamLookup: getEventCode: " + eventCode.trim());
      $("#navbarEventCode").html(eventCode);
    });

    var initTeamNumber = checkGet()
    if (initTeamNumber) {
      buildTeamLookupPage(initTeamNumber);
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
      buildTeamLookupPage($("#enterTeamNumber").val());
    });

    // Keep the frozen match data updated
    // $("#sortableAllMatches").click(function () {
    //   if (frozenTableMatches) {
    //     frozenTableMatches.update();
    //   }
    // });

    // // Keep the frozen strategy table updated
    // $("#sortableStrategicData").click(function () {
    //   if (frozenTableStrategy) {
    //     frozenTableStrategy.update();
    //   }
    // });
  });
</script>

<script type="text/javascript" src="./scripts/compareMatchNumbers.js"></script>
<script type="text/javascript" src="./scripts/matchDataProcessor.js"></script>
