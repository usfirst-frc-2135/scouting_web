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

            <!-- <div id="freeze-table-strat" class="freeze-table overflow-auto"> -->
            <div class="overflow-auto">
              <table id="strategicDataTable"
                class="table table-striped table-bordered table-hover table-sm border-dark text-center sortable">
                <colgroup>
                  <col span="2" style="background-color:transparent">
                  <col span="1" style="background-color:#cfe2ff">
                  <col span="1" style="background-color:transparent">
                  <col span="1" style="background-color:#cfe2ff">
                  <col span="1" style="background-color:transparent">
                  <col span="1" style="background-color:#cfe2ff">
                  <col span="1" style="background-color:transparent">
                  <col span="1" style="background-color:#cfe2ff">
                  <col span="1" style="background-color:transparent">
                  <col span="1" style="background-color:#cfe2ff">
                  <col span="1" style="background-color:transparent">
                  <col span="1" style="background-color:#cfe2ff">
                  <col span="1" style="background-color:transparent">
                  <col span="1" style="background-color:#cfe2ff">
                  <col span="1" style="background-color:transparent">
                  <col span="1" style="background-color:#cfe2ff">
                  <col span="1" style="background-color:transparent">
                  <col span="1" style="background-color:#cfe2ff">
                  <col span="1" style="background-color:transparent">
                  <col span="1" style="background-color:#cfe2ff">
                  <col span="1" style="background-color:transparent">
                  <col span="1" style="background-color:#cfe2ff">
                  <col span="1" style="background-color:transparent">
                  <col span="1" style="background-color:#cfe2ff">
                  <col span="1" style="background-color:transparent">
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

            <!-- <div id="freeze-table-match" class="freeze-table overflow-auto"> -->
            <div class="overflow-auto">
              <table id="matchDataTable"
                class="table table-striped table-bordered table-hover table-sm border-dark text-center sortable">
                <colgroup>
                  <col span="2" style="background-color:transparent">
                  <col span="1" style="background-color:#cfe2ff">
                  <col span="1" style="background-color:transparent">
                  <col span="1" style="background-color:#cfe2ff">
                  <col span="1" style="background-color:transparent">
                  <col span="1" style="background-color:#cfe2ff">
                  <col span="1" style="background-color:transparent">
                  <col span="1" style="background-color:#cfe2ff">
                  <col span="1" style="background-color:transparent">
                  <col span="1" style="background-color:#cfe2ff">
                  <col span="1" style="background-color:transparent">
                  <col span="1" style="background-color:#cfe2ff">
                  <col span="1" style="background-color:transparent">
                  <col span="1" style="background-color:#cfe2ff">
                  <col span="1" style="background-color:transparent">
                  <col span="1" style="background-color:#cfe2ff">
                  <col span="1" style="background-color:transparent">
                  <col span="1" style="background-color:#cfe2ff">
                  <col span="1" style="background-color:transparent">
                  <col span="1" style="background-color:#cfe2ff">
                  <col span="1" style="background-color:transparent">
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
                    <th scope="col">Def</th>
                    <th scope="col">Cage Climb</th>
                    <th scope="col">Start Climb</th>
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

  let autoChart;
  let teleopChart;
  let endgameChart;

  // Round data to no more than two decimal digits
  function roundTwoPlaces(val) {
    return Math.round((val + Number.EPSILON) * 100) / 100;
  }

  ///// AUTON GRAPH STARTS HERE /////

  function loadAutonGraph(matchData) {
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

    datasets.push({ label: "Leave", data: [], backgroundColor: '#F7CF58' });      // Yellow
    datasets.push({ label: "Processor", data: [], backgroundColor: '#B4E7D6' });  // Teal - algae
    datasets.push({ label: "Net", data: [], backgroundColor: '#4C9F7C' });        // Darker Teal - algae
    datasets.push({ label: "L1", data: [], backgroundColor: '#D98AB3' });         // Light pink - coral branch
    datasets.push({ label: "L2", data: [], backgroundColor: '#CE649B' });         // Medium light pink - coral branch
    datasets.push({ label: "L3", data: [], backgroundColor: '#C54282' });         // Medium dark pink - coral branch
    datasets.push({ label: "L4", data: [], backgroundColor: '#9D3468' });         // Dark pink - coral branch

    // Go thru each matchData QR code string and build up a table of the data, so we can
    // later sort it so the matches are listed in the right order. 
    let mydata = [];
    for (let i = 0; i < matchData.length; i++) {
      let matchItem = matchData[i];
      let matchnum = matchItem["matchnumber"];
      let autonLeave = matchItem["autonLeave"];
      let autonAlgaeProcessor = matchItem["autonAlgaeProcessor"];
      let autonAlgaeNet = matchItem["autonAlgaeNet"];
      let autonCoralOne = matchItem["autonCoralL1"];
      let autonCoralTwo = matchItem["autonCoralL2"];
      let autonCoralThree = matchItem["autonCoralL3"];
      let autonCoralFour = matchItem["autonCoralL4"];
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
        if (yesNo) {
          value = (value) ? "Yes" : "No";
        }
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
          y: { stacked: true, min: 0, ticks: { precision: 0 }, max: 5 } // Set Y axis maximum value - 4 coral + algae in  auto plus leave
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

  function loadTeleopGraph(matchData) {
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

    datasets.push({ label: "Processor", data: [], backgroundColor: '#B4E7D6' });  // Teal - algae
    datasets.push({ label: "Net", data: [], backgroundColor: '#4C9F7C' });        // Darker Teal - algae
    datasets.push({ label: "L1", data: [], backgroundColor: '#D98AB3' });         // Light pink - coral branch
    datasets.push({ label: "L2", data: [], backgroundColor: '#CE649B' });         // Medium light pink - coral branch
    datasets.push({ label: "L3", data: [], backgroundColor: '#C54282' });         // Medium dark pink - coral branch
    datasets.push({ label: "L4", data: [], backgroundColor: '#9D3468' });         // Dark pink - coral branch

    // Go thru each matchData QR code string and build up a table of the data, so we can
    // later sort it so the matches are listed in the right order. 
    let mydata = [];
    for (let i = 0; i < matchData.length; i++) {
      let matchItem = matchData[i];
      let matchnum = matchItem["matchnumber"];
      let teleopAlgaeProcessor = matchItem["teleopAlgaeProcessor"];
      let teleopAlgaeNet = matchItem["teleopAlgaeNet"];
      let teleopCoralOne = matchItem["teleopCoralL1"];
      let teleopCoralTwo = matchItem["teleopCoralL2"];
      let teleopCoralThree = matchItem["teleopCoralL3"];
      let teleopCoralFour = matchItem["teleopCoralL4"];
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
      teleopAlgaeNetTips.push({ xlabel: matchnum, tip: storeAndGetTip(mydata[i]["teleopnet"], "Net=", datasets[1]["data"]) });
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
          y: { stacked: true, min: 0, ticks: { precision: 0 }, max: 14 } // Set Y axis maximum value - 14 coral + algae in teleop
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

  function loadEndgameGraph(matchData) {
    console.log("==> teamLookup: loadEndgameGraph()");
    let matchList = [];
    let datasets = [];
    let cageClimbTips = [];

    datasets.push({ label: "Cage Climb", data: [], backgroundColor: '#ED8537' });   // Orange - endgame

    // Go thru each matchData QR code string and build up a table of the data, so we can
    // later sort it so the matches are listed in the right order. 
    let mydata = [];
    for (let i = 0; i < matchData.length; i++) {
      let matchnum = matchData[i]["matchnumber"];
      let cageClimb = matchData[i]["cageClimb"];
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
          y: { stacked: true, min: 0, ticks: { precision: 0 }, max: 4 } // Set Y axis maximum value - deep climb
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
  function loadAverageTables(avgs) {
    console.log("==> teamLookup: loadAverageTables()");

    /////// Match Totals Table
    avgs["totalCoralStr"] = "Coral Scored";
    avgs["totalAlgaeStr"] = "Algae Scored";
    avgs["totalCoralPointsStr"] = "Coral Points";
    avgs["totalAlgaePointsStr"] = "Algae Points";

    writeAverageTableRow("matchSheetTable", avgs, ["totalCoralStr", "totalCoralScoredAvg", "totalCoralScoredMax"], 3);
    writeAverageTableRow("matchSheetTable", avgs, ["totalAlgaeStr", "totalAlgaeScoredAvg", "totalAlgaeScoredMax"], 3);
    writeAverageTableRow("matchSheetTable", avgs, ["totalCoralPointsStr", "totalCoralPointsAvg", "totalCoralPointsMax"], 3);
    writeAverageTableRow("matchSheetTable", avgs, ["totalAlgaePointsStr", "totalAlgaePointsAvg", "totalAlgaePointsMax"], 3);

    avgs["totalMatchPointsStr"] = "Match Points";
    avgs["avgTotalMatchPoints"] = roundTwoPlaces(avgs["totalCoralPointsAvg"] + avgs["totalAlgaePointsAvg"]);
    avgs["maxTotalMatchPoints"] = roundTwoPlaces(avgs["totalCoralPointsMax"] + avgs["totalAlgaePointsMax"]);
    writeAverageTableRow("matchSheetTable", avgs, ["totalMatchPointsStr", "avgTotalMatchPoints", "maxTotalMatchPoints"], 3);

    //Auton Table  
    avgs["autonpointsStr"] = "Total Points";
    avgs["autontotalcoralStr"] = "Coral Scored";
    avgs["autontotalalgaeStr"] = "Algae Scored";
    avgs["autoncoralpointsStr"] = "Coral Points";
    avgs["autonalgaepointsStr"] = "Algae Points";

    writeAverageTableRow("autonTable", avgs, ["autonpointsStr", "autonPointsAvg", "autonPointsMax"], 3);
    writeAverageTableRow("autonTable", avgs, ["autontotalcoralStr", "autonCoralScoredAvg", "autonCoralScoredMax"], 3);
    writeAverageTableRow("autonTable", avgs, ["autontotalalgaeStr", "autonAlgaeScoredAvg", "autonAlgaeScoredMax"], 3);
    writeAverageTableRow("autonTable", avgs, ["autoncoralpointsStr", "autonCoralPointsAvg", "autonCoralPointsMax"], 3);
    writeAverageTableRow("autonTable", avgs, ["autonalgaepointsStr", "autonAlgaePointsAvg", "autonAlgaePointsMax"], 3);

    // Teleop Table

    avgs["teleoppointsStr"] = "Total Points";
    avgs["teleoptotalcoralStr"] = "Coral Scored";
    avgs["teleoptotalalgaeStr"] = "Algae Scored";
    avgs["teleopcoralpointsStr"] = "Coral Points";
    avgs["teleopalgaepointsStr"] = "Algae Points";
    avgs["teleopcoralaccuracyStr"] = "Coral Acc%";
    avgs["teleopalgaeaccuracysStr"] = "Algae Acc%";

    writeAverageTableRow("teleopTable", avgs, ["teleoppointsStr", "teleopPointsAvg", "teleopPointsMax"], 3);
    writeAverageTableRow("teleopTable", avgs, ["teleoptotalcoralStr", "teleopCoralScoredAvg", "teleopCoralScoredMax"], 3);
    writeAverageTableRow("teleopTable", avgs, ["teleoptotalalgaeStr", "teleopAlgaeScoredAvg", "teleopAlgaeScoredMax"], 3);
    writeAverageTableRow("teleopTable", avgs, ["teleopcoralpointsStr", "teleopCoralPointsAvg", "teleopCoralPointsMax"], 3);
    writeAverageTableRow("teleopTable", avgs, ["teleopalgaepointsStr", "teleopAlgaePointsAvg", "teleopAlgaePointsMax"], 3);
    writeAverageTableRow("teleopTable", avgs, ["teleopcoralaccuracyStr", "teleopCoralPercent"], 3);
    writeAverageTableRow("teleopTable", avgs, ["teleopalgaeaccuracysStr", "teleopAlgaePercent"], 3);

    /////// Endgame Table
    avgs["totalEndGamePointsStr"] = "Endgame Points";
    avgs["endgameClimbPercent"]["endgameclimbStr"] = "Cage Climb %";

    writeAverageTableRow("endgameTotalPtsTable", avgs, ["totalEndGamePointsStr", "endgamePointsAvg", "endgamePointsMax"], 3);
    writeAverageTableRow("endgameClimbTable", avgs["endgameClimbPercent"], ["endgameclimbStr", 0, 2, 1, 3, 4], 6);
  }

  // Loads the match data table
  function teamMatchDataTable(matchData) {
    console.log("==> teamLookup: teamMatchDataTable()");
    let tbodyRef = document.getElementById("matchDataTable").querySelector('tbody');
    tbodyRef.innerHTML = "";     // clear table
    for (let i = 0; i < matchData.length; i++) {
      let matchItem = matchData[i];
      let rowString = "";
      rowString += "<td>" + matchItem["matchnumber"] + "</td>";
      rowString += "<td>" + matchItem["autonLeave"] + "</td>";

      rowString += "<td>" + matchItem["autonCoralL1"] + "</td>";
      rowString += "<td>" + matchItem["autonCoralL2"] + "</td>";
      rowString += "<td>" + matchItem["autonCoralL3"] + "</td>";
      rowString += "<td>" + matchItem["autonCoralL4"] + "</td>";

      rowString += "<td>" + matchItem["autonAlgaeNet"] + "</td>";
      rowString += "<td>" + matchItem["autonAlgaeProcessor"] + "</td>";

      rowString += "<td>" + matchItem["acquiredCoral"] + "</td>";
      rowString += "<td>" + matchItem["acquiredAlgae"] + "</td>";

      rowString += "<td>" + matchItem["teleopCoralL1"] + "</td>";
      rowString += "<td>" + matchItem["teleopCoralL2"] + "</td>";
      rowString += "<td>" + matchItem["teleopCoralL3"] + "</td>";
      rowString += "<td>" + matchItem["teleopCoralL4"] + "</td>";

      rowString += "<td>" + matchItem["teleopAlgaeNet"] + "</td>";
      rowString += "<td>" + matchItem["teleopAlgaeProcessor"] + "</td>";

      rowString += "<td>" + matchItem["defenseLevel"] + "</td>";
      rowString += "<td>" + matchItem["cageClimb"] + "</td>";
      rowString += "<td>" + matchItem["startClimb"] + "</td>";
      rowString += "<td>" + matchItem["died"] + "</td>";
      rowString += "<td>" + matchItem["scoutname"] + "</td>";
      rowString += "<td>" + matchItem["comment"] + "</td>";
      tbodyRef.insertRow().innerHTML = rowString;
    }
    const matchColumn = 0;
    sortTableByMatch("matchDataTable", matchColumn);
  }

  // MAIN PAGE PROCESSORS HERE

  // Check if our URL directs to a specific team
  function checkURLForTeamSpec() {
    console.log("=> teamLookup: checkURLForTeamSpec()");
    let sp = new URLSearchParams(window.location.search);
    if (sp.has('teamNum')) {
      return sp.get('teamNum');
    }
    return null;
  }

  // Takes list of Team photo paths and loads them.
  function loadTeamPhotos(teamPhotos) {
    console.log("==> teamLookup: loadTeamPhotos()");
    let first = true;
    for (let uri of teamPhotos) {
      let tags = "<div class='carousel-item";
      if (first) {
        tags += " active";
      }
      first = false;
      tags += "'> <img src='./" + uri + "' class='d-block w-100'> </div>";
      document.getElementById("robotPics").innerHTML += tags;
    }
  }

  // Converts a given "1" to yes, "0" to no, anything else to empty string.
  function toYesNo(value) {
    switch (String(value)) {
      case "1": return "Yes";
      case "2": return "No";
      default: return "-";
    }
  }

  // Load the strategic data table for this team
  function loadStrategicData(stratData) {
    console.log("==> teamLookup: loadStrategicData()");
    let tbodyRef = document.getElementById("strategicDataTable").querySelector('tbody');
    tbodyRef.innerHTML = "";     // clear table
    for (let i = 0; i < stratData.length; i++) {
      let stratItem = stratData[i];

      let driverability = stratItem["driverability"];
      switch (driverability) {
        case 1: driveVal = "Jerky"; break;
        case 2: driveVal = "Slow"; break;
        case 3: driveVal = "Average"; break;
        case 4: driveVal = "Quick"; break;
        case 5: driveVal = "-"; break;
        default: driveVal = ""; break;
      }

      let rowString = "";
      rowString += "<td>" + stratItem["matchnumber"] + "</td>";
      rowString += "<td>" + driveVal + "</td>";
      rowString += "<td>" + toYesNo(stratItem["against_tactic1"]) + "</td>";
      rowString += "<td>" + stratItem["against_comment"] + "</td>";

      rowString += "<td>" + toYesNo(stratItem["defense_tactic1"]) + "</td>";
      rowString += "<td>" + toYesNo(stratItem["defense_tactic2"]) + "</td>";
      rowString += "<td>" + stratItem["defense_comment"] + "</td>";

      rowString += "<td>" + toYesNo(stratItem["foul1"]) + "</td>";
      rowString += "<td>" + toYesNo(stratItem["autonFoul1"]) + "</td>";
      rowString += "<td>" + toYesNo(stratItem["autonFoul2"]) + "</td>";
      rowString += "<td>" + toYesNo(stratItem["teleopFoul1"]) + "</td>";
      rowString += "<td>" + toYesNo(stratItem["teleopFoul2"]) + "</td>";
      rowString += "<td>" + toYesNo(stratItem["teleopFoul3"]) + "</td>";
      rowString += "<td>" + toYesNo(stratItem["teleopFoul4"]) + "</td>";
      rowString += "<td>" + toYesNo(stratItem["endgameFoul1"]) + "</td>";

      rowString += "<td>" + toYesNo(stratItem["autonGetCoralFromFloor"]) + "</td>";
      rowString += "<td>" + toYesNo(stratItem["autonGetCoralFromStation"]) + "</td>";
      rowString += "<td>" + toYesNo(stratItem["autonGetAlgaeFromFloor"]) + "</td>";
      rowString += "<td>" + toYesNo(stratItem["autonGetAlgaeFromReef"]) + "</td>";
      rowString += "<td>" + toYesNo(stratItem["teleopFloorPickupAlgae"]) + "</td>";
      rowString += "<td>" + toYesNo(stratItem["teleopFloorPickupCoral"]) + "</td>";
      rowString += "<td>" + toYesNo(stratItem["teleopKnockOffAlgaeFromReef"]) + "</td>";
      rowString += "<td>" + toYesNo(stratItem["teleopAcquireAlgaeFromReef"]) + "</td>";

      rowString += "<td>" + stratItem["problem_comment"] + "</td>";
      rowString += "<td>" + stratItem["general_comment"] + "</td>";
      rowString += "<td>" + stratItem["scoutname"] + "</td>";
      tbodyRef.insertRow().innerHTML = rowString;
    }
    const matchColumn = 0;
    sortTableByMatch("strategicDataTable", matchColumn);
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

  // Load the match data table
  function loadMatchData(team, allEventMatches) {
    console.log("==> teamLookup: loadMatchData()");
    let mdp = new matchDataProcessor(allEventMatches);
    // mdp.sortMatches(allEventMatches);
    mdp.getSiteFilteredAverages(function (filteredMatches, filteredAvgData) {
      if (filteredMatches != undefined) {
        loadAutonGraph(filteredMatches);
        loadTeleopGraph(filteredMatches);
        loadEndgameGraph(filteredMatches);
        teamMatchDataTable(filteredMatches);
      }
      else {
        alert("No match data for this team at this event!");
      }
      let teamAverages = filteredAvgData[team];
      if (teamAverages !== undefined) {
        loadAverageTables(teamAverages);
      }
      else {
        alert("No averages data for this team at this event!");
      }
    });
  }

  function clearTeamLookupPage() {
    // Clear existing data
    console.log("teamLookup: starting clearTeamLookupPage()");
    document.getElementById("teamTitle").innerText = "";
    document.getElementById("robotPics").innerText = "";
    document.getElementById("matchSheetTable").querySelector('tbody').innerHTML = "";
    document.getElementById("autonTable").querySelector('tbody').innerHTML = "";
    document.getElementById("teleopTable").querySelector('tbody').innerHTML = "";
    document.getElementById("endgameTotalPtsTable").querySelector('tbody').innerHTML = "";
    document.getElementById("endgameClimbTable").querySelector('tbody').innerHTML = "";
    document.getElementById("pitTable1").querySelector('tbody').innerHTML = "";
    document.getElementById("pitTable2").querySelector('tbody').innerHTML = "";
    document.getElementById("strategicDataTable").querySelector('tbody').innerHTML = "";
    document.getElementById("matchDataTable").querySelector('tbody').innerHTML = "";
  }

  ///////////////////////////////////////////////////////////////////
  // This is the main function that runs when we want to load a team.
  // teamName will be set to the alias for BCD teamnums; else it's empty here and will be looked up later.
  function buildTeamLookupPage(teamNum, teamName, aliasList) {
    console.log("!!> teamLookup: buildTeamLookupPage(), teamnum = " + teamNum + ", teamName = " + teamName);
    clearTeamLookupPage();
    if (teamName == "") {
      // teamName is empty, so get it from TBA or from aliasList. First check for alias.
      if (teamNum.charAt(0) == '9' && teamNum.charAt(1) == '9' && (aliasList != undefined)) {
        // 'teamNum' is a 99# (an alias in the aliasList), so get the BCDnum from aliasList and use it for teamName
        let bcdname = getTeamNumFromAlias(teamNum, aliasList);
        console.log("for alias: " + teamNum + ", bcdname = " + bcdname);
        if (bcdname !== "") {
          mname = bcdname;
          document.getElementById("teamTitle").innerHTML = teamNum + " - " + mname;
        }
      } else if (teamNum.charAt(teamNum.length - 1) === 'B' || teamNum.charAt(teamNum.length - 1) === 'C' ||
        teamNum.charAt(teamNum.length - 1) === 'D' || teamNum.charAt(teamNum.length - 1) === 'E') {
        // 'teamNum' is a BCDnum so get the alias from aliasList and use it for teamName
        let alias = getAliasFromTeamNum(teamNum, aliasList);
        console.log("for BCDnum: " + teamNum + ", alias = " + alias);
        if (alias !== "") {
          teamName = alias;
          document.getElementById("teamTitle").innerHTML = teamNum + " - " + teamName;
        }
      }
    }
    // If teamName is still empty, look it up from TBA teamInfo.
    if (teamName == "") {
      // Get teamInfo from TBA
      console.log("going to get teaminfo from TBA")
      $.get("api/tbaAPI.php", {
        getTeamInfo: teamNum
      }).done(function (teamInfo) {
        //HOLD        console.log("=> getTeamInfo:\n" + teamInfo);
        if (teamInfo === null) {
          return alert("Can't load teamName from TBA; check if TBA Key was set in db_config");
        }

        let jTeamInfo = JSON.parse(teamInfo)["response"];
        teamName = jTeamInfo["nickname"];
        console.log("teamName from TBA = " + teamName);
        document.getElementById("teamTitle").innerHTML = teamNum + " - " + teamName;
      });
    }
    document.getElementById("teamTitle").innerHTML = teamNum + " - " + teamName;

    // Add images for the team
    $.get("api/dbReadAPI.php", {
      getImagesForTeam: teamNum
    }).done(function (teamImages) {
      console.log("=> getImagesForTeam:\n" + teamImages);
      loadTeamPhotos(JSON.parse(teamImages));
    });

    // Add Match Scouting Data
    $.get("api/dbReadAPI.php", {
      getTeamMatchData: teamNum
    }).done(function (teamMatches) {
      console.log("=> getTeamMatchData");
      loadMatchData(teamNum, JSON.parse(teamMatches));
    });

    // Do the Pit Scouting Data
    $.get("api/dbReadAPI.php", {
      getTeamPitData: teamNum
    }).done(function (teamPitData) {
      console.log("=> getTeamPitData\n");
      loadPitData(JSON.parse(teamPitData));
    });

    // Do the Strategic Data Table.
    $.get("api/dbReadAPI.php", {
      getTeamStrategicData: teamNum
    }).done(function (strategicData) {
      console.log("=> getTeamStrategicData");
      loadStrategicData(JSON.parse(strategicData));
    });
    console.log("going to set title again for team " + teamNum + " with teamName: " + teamName);
    document.getElementById("teamTitle").innerHTML = teamNum + " - " + teamName;

  }

  /////////////////////////////////////////////////////////////////////////////
  //
  // Process the generated html
  //    When the team lookup page load button is pressed
  //      In parallel, start retrieving each of these for the selected team:
  //        - Team info (name) from TBA
  //        - Images of the robot from database
  //        - Match scouting data from database
  //        - Pit scouting data from database
  //        - Strategic scouting data from database
  //
  document.addEventListener("DOMContentLoaded", function () {

    console.log("!!> addEventListener");
    // first get alias table data
    let teamName = "";

    $.get("api/dbReadAPI.php", {
      getEventAliasNames: true
    }).done(function (eventAliasNames) {
      console.log("=> eventAliasNames");
      let jAliasNames = JSON.parse(eventAliasNames);

      // Check URL for team# to use (we may have gotten here by clicking on a team number link from another page)
      // Note: for aliases: this could only be the BCDnum, never the 99#.
      let urlTeamNum = checkURLForTeamSpec();
      if (validateTeamNumber(urlTeamNum, null) > 0) {
        console.log("urlTeamNum = " + urlTeamNum);
        document.getElementById("enterTeamNumber").value = urlTeamNum;

        // This team number might be a BCDnum, so look up its alias and use it for the teamName.
        let alias = getAliasFromTeamNum(urlTeamNum, jAliasNames);
        if (alias != "") {
          console.log("for URL team: " + urlTeamNum + ", alias = " + alias);
          teamName = alias;
        }
        buildTeamLookupPage(urlTeamNum, teamName, jAliasNames);
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
        let enteredNum = document.getElementById("enterTeamNumber").value.trim();
        let teamNum = enteredNum;
        clearTeamLookupPage();

        // Figure out if the entered number is a 99#.
        if (jAliasNames.length > 0) {
          if ((enteredNum.charAt(0) == '9') && (enteredNum.charAt(1) == '9')) {

            // This team number is an alias, so get the BCDnumber.
            let bcdNum = getTeamNumFromAlias(enteredNum, jAliasNames);
            console.log("Entered number is an alias: " + enteredNum + ", bcdNum = " + bcdNum);
            if (bcdNum !== "") {
              teamName = enteredNum;
              teamNum = bcdNum;
            }
          }
        }

        if (validateTeamNumber(teamNum, null) > 0) {
          buildTeamLookupPage(teamNum, teamName, jAliasNames);
        }
      });
    });
  });
</script>

<script src="./scripts/compareMatchNumbers.js"></script>
<script src="./scripts/compareTeamNumbers.js"></script>
<script src="./scripts/sortFrcTables.js"></script>
<script src="./scripts/matchDataProcessor.js"></script>
<script src="./scripts/aliasFunctions.js"></script>
<script src="./scripts/validateTeamNumber.js"></script>

<script src="./external/charts/chart.umd.js"></script>
