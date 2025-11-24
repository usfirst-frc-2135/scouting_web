<?php
$title = 'Team Compare';
require 'inc/header.php';
?>

<div class="container row-offcanvas row-offcanvas-left">
  <div id="content" class="column card-lg-12 col-sm-12 col-xs-12">

    <!-- Page Title -->
    <div class="row pt-3 pb-3 mb-3">
      <h2 class="col-md-6"><?php echo $title; ?></h2>
    </div>

    <!-- Main row to hold the team number entry -->
    <div class="row col-md-6 mb-3">
      <div class="input-group mb-3">
        <input id="enterTeamNumber1" class="form-control" type="text" placeholder="FRC team 1" aria-label="Team Number 1">
        <input id="enterTeamNumber2" class="form-control" type="text" placeholder="FRC team 2" aria-label="Team Number 2">
        <div class="input-group-append">
          <button id="loadTeamButton" class="btn btn-primary" type="button">Load Teams</button>
        </div>
      </div>
      <div id="aliasNumber1" class="ms-3 mb-3 text-success"></div>
      <div id="aliasNumber2" class="ms-3 mb-3 text-success"></div>
    </div>

    <!-- First column of data starts here -->
    <div class="row">
      <div class="col-lg-6 col-sm-6 col-xs-6 gx-3">
        <div class="card mb-3">
          <div class="card-body">
            <h5 id="teamMainTitle1" class="card-title">Team 1</h5>
            <h5 id="teamMainTitle2" class="card-title">Team 2</h5>

            <!-- First Pick collapsible graph -->
            <div class="card mb-3" style="background-color:#F0FFFF">
              <div class="card-header">
                <h5 class="text-center">
                  <a href="#collapseFirstPickGraph" data-bs-toggle="collapse" aria-expanded="true">First Pick</a>
                </h5>
              </div>
              <div id="collapseFirstPickGraph" class="card-body collapse show">
                <canvas id="firstPickChart" width="400" height="360"></canvas>
              </div>
            </div>
            <!-- end of First Pick collapsible graph -->

          </div>
        </div>
      </div>

      <!-- Second column of data starts here -->
      <div class="col-lg-6 col-sm-6 col-xs-6 gx-3">
        <div class="card mb-3">
          <div class="card-body">

            <!-- End game card -->
            <div class="card mb-3" style="background-color:#FBE6D3">
              <div class="card-header">
                <h5 class="text-center"> <a href="#collapseEndgame" data-bs-toggle="collapse" aria-expanded="true">Endgame Climb
                    Percentages
                  </a>
                </h5>
              </div>
              <div id="collapseEndgame" class="card-body collapse show">
                <table id="endgameClimbTable"
                  class="table table-striped table-bordered table-hover table-sm border-dark text-center ">
                  <thead>
                    <tr>
                      <th>Team</th>
                      <th style="width:12%" scope="col">N%</th>
                      <th style="width:12%" scope="col">F%</th>
                      <th style="width:12%" scope="col">P%</th>
                      <th style="width:12%" scope="col">S%</th>
                      <th style="width:12%" scope="col">D%</th>
                    </tr>
                  </thead>
                  <tbody class="table-group-divider">
                  </tbody>
                </table>
              </div>
            </div>

            <!-- Second Pick collapsible graph -->
            <div class="card mb-3" style="background-color:#F0FFFF">
              <div class="card-header">
                <h5 class="text-center">
                  <a href="#collapseSecondPickGraph" data-bs-toggle="collapse" aria-expanded="false">Second Pick</a>
                </h5>
              </div>
              <div id="collapseSecondPickGraph" class="card-body collapse">
                <canvas id="secondPickChart" width="400" height="360"></canvas>
              </div>
            </div>

            <!-- Third Pick collapsible graph -->
            <div class="card mb-3" style="background-color:#F0FFFF">
              <div class="card-header">
                <h5 class="text-center">
                  <a href="#collapseThirdPickGraph" data-bs-toggle="collapse" aria-expanded="false">Third Pick</a>
                </h5>
              </div>
              <div id="collapseThirdPickGraph" class="card-body collapse">
                <canvas id="ThirdPickChart" width="400" height="360"></canvas>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

    <div class="card mb-3">
      <div id="strategicLink1" class="card-header">
        <h5 class="text-center">
          <a href="#collapseStrategicData1" data-bs-toggle="collapse" aria-expanded="false">Team 1 - Strategic Data</a>
        </h5>
      </div>

      <div id="collapseStrategicData1" class="card-body collapse">
        <div class="overflow-auto">
          <table id="strategicDataTable1" class="table table-striped table-bordered table-hover table-sm border-dark text-center">
            <thead> </thead>
            <tbody class="table-group-divider"> </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="card mb-3">
      <div id="strategicLink2" class="card-header">
        <h5 class="text-center">
          <a href="#collapseStrategicData2" data-bs-toggle="collapse" aria-expanded="false">Team 2 - Strategic Data</a>
        </h5>
      </div>

      <div id="collapseStrategicData2" class="card-body collapse">
        <div class="overflow-auto">
          <table id="strategicDataTable2" class="table table-striped table-bordered table-hover table-sm border-dark text-center">
            <thead> </thead>
            <tbody class="table-group-divider"> </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="container row-offcanvas row-offcanvas-left">
      <div class="column card-lg-12 col-sm-12 col-xs-12" id="content">

        <!-- Page Title -->
        <div class="row pt-3 pb-3 mb-3">
          <h3 class="col-md-4"><?php echo "Event Averages"; ?></h3>

          <!-- Match Filter -->
          <div class="col-md-3 mb-3">
            <div id="customMatch" class="accordion accordion-flush">
              <div class="accordion-item" style="background-color: #F8F9FA">
                <h2 class="accordion-header">
                  <button class="accordion-button text-light bg-secondary" type="button" data-bs-toggle="collapse"
                    data-bs-target="#filterEntry" aria-expanded="false" aria-controls="matchEntry">Match Range Filter</button>
                </h2>

                <div id="filterEntry" class="accordion-collapse collapse" data-bs-parent="#customMatch">

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <select id="startCompLevel" class="form-select mb-3" aria-label="Comp Level Select">
                        <option value="p">P</option>
                        <option value="qm" selected>QM</option>
                        <option value="sf">SF</option>
                        <option value="f">F</option>
                      </select>
                    </div>
                    <input id="startMatchNum" class="form-control col-2 mb-3" type="text" placeholder="Start"
                      aria-label="Start Match Filter">
                  </div>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <select id="endCompLevel" class="form-select mb-3" aria-label="Comp Level Select">
                        <option value="p">P</option>
                        <option value="qm" selected>QM</option>
                        <option value="sf">SF</option>
                        <option value="f">F</option>
                      </select>
                    </div>
                    <input id="endMatchNum" class="form-control col-2 mb-3" type="text" placeholder="End"
                      aria-label="End Match Filter">
                  </div>

                </div>

              </div>
            </div>
          </div>

        </div>

        <!-- Main row to hold the table -->
        <div class="row mb-3">

          <div id="freeze-table" class="freeze-table overflow-auto">
            <table id="averagesTable" class="table table-striped table-bordered table-hover table-sm border-dark text-center">
              <thead> </thead>
              <tbody class="table-group-divider">
              </tbody>
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

  let firstPickChart;
  let secondPickChart;
  let thirdPickChart;

  // Round data to no more than two decimal digits
  function roundTwoPlaces(val) {
    return Math.round((val + Number.EPSILON) * 100) / 100;
  }

  ///// FIRST PICK GRAPH STARTS HERE /////
  function loadFirstPickGraph(team1, team2, avgData) {
    console.log("==> teamCompare: loadFirstPickGraph()");
    let datasets = [];

    datasets.push({
      label: team1, data: [
        avgData[team1]["autonPointsAvg"],
        avgData[team1]["teleopPointsAvg"],
        avgData[team1]["endgamePointsAvg"],
        avgData[team1]["teleopAlgaeNetAvg"] * 4,    // Multiply teleopAlgaeNetAvg by 4 to get points.
        avgData[team1]["teleopCoralL4Avg"] * 5,     // Multiply teleopCoralL4Avg by 5 to get points.
        avgData[team1]["teleopCoralL3Avg"] * 4      // Multiply teleopCoralL3Avg by 4 to get points.
      ], backgroundColor: '#FF4316'
    });
    datasets.push({
      label: team2, data: [
        avgData[team2]["autonPointsAvg"],
        avgData[team2]["teleopPointsAvg"],
        avgData[team2]["endgamePointsAvg"],
        avgData[team2]["teleopAlgaeNetAvg"] * 4,    // Multiply teleopAlgaeNetAvg by 4 to get points.
        avgData[team2]["teleopCoralL4Avg"] * 5,     // Multiply teleopCoralL4Avg by 5 to get points.
        avgData[team2]["teleopCoralL3Avg"] * 4      // Multiply teleopCoralL3Avg by 4 to get points.
      ], backgroundColor: '#0033FF'
    });

    // Define the graph as a bar chart:
    if (firstPickChart !== undefined) {
      firstPickChart.destroy();
    }

    // Create the Auton graph
    const ctx = document.getElementById('firstPickChart').getContext('2d');
    firstPickChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ["Auton Avg Pts", "Teleop Avg Pts", "Endgame Avg Pts", "Teleop Net Pts", "Teleop L4 Pts", "Teleop L3 Pts"],
        datasets: datasets
      },
      options: {
        scales: {
          x: {},
          y: { min: 0, ticks: { precision: 0 }, max: 50 } // Set Y axis maximum value - 4 coral + algae in  auto plus leave
        },
        plugins: {
        }
      }
    });
  }
  ///// End of FIRST PICK GRAPH /////

  ///// SECOND PICK GRAPH STARTS HERE /////
  function loadSecondPickGraph(team1, team2, avgData) {
    console.log("==> teamCompare: loadSecondPickGraph()");
    let datasets = [];

    datasets.push({
      label: team1, data: [
        avgData[team1]["autonPointsAvg"],
        avgData[team1]["teleopPointsAvg"],
        avgData[team1]["endgamePointsAvg"],
        avgData[team1]["teleopAlgaeNetAvg"] * 4,    // Multiply teleopAlgaeNetAvg by 4 to get points.
        avgData[team1]["teleopCoralL3Avg"] * 4,     // Multiply teleopCoralL3Avg by 4 to get points.
        avgData[team1]["teleopCoralL2Avg"] * 3      // Multiply teleopCoralL2Avg by 3 to get points.
      ], backgroundColor: '#FF4316'
    });
    datasets.push({
      label: team2, data: [
        avgData[team2]["autonPointsAvg"],
        avgData[team2]["teleopPointsAvg"],
        avgData[team2]["endgamePointsAvg"],
        avgData[team2]["teleopAlgaeNetAvg"] * 4,    // Multiply teleopAlgaeNetAvg by 4 to get points.   
        avgData[team2]["teleopCoralL3Avg"] * 4,     // Multiply teleopCoralL3Avg by 4 to get points.
        avgData[team2]["teleopCoralL2Avg"] * 3      // Multiply teleopCoralL2Avg by 3 to get points.
      ], backgroundColor: '#0033FF'
    });

    // Define the graph as a bar chart:
    if (secondPickChart !== undefined) {
      secondPickChart.destroy();
    }

    // Create the second pick graph
    const ctx = document.getElementById('secondPickChart').getContext('2d');
    secondPickChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ["Auton Avg Pts", "Teleop Avg Pts", "Endgame Avg Pts", "Teleop Net Pts", "Teleop L3 Pts", "Teleop L2 Pts"],
        datasets: datasets
      },
      options: {
        scales: {
          x: {},
          y: { min: 0, ticks: { precision: 0 }, max: 50 } // Set Y axis maximum value - 4 coral + algae in  auto plus leave
        },
        plugins: {
        }
      }
    });
  }
  ///// End of SECOND PICK GRAPH /////

  ///// THIRD PICK GRAPH STARTS HERE /////
  function loadThirdPickGraph(team1, team2, avgData) {
    console.log("==> teamCompare: loadThirdPickGraph()");
    let datasets = [];

    datasets.push({
      label: team1, data: [
        avgData[team1]["autonPointsAvg"],
        avgData[team1]["teleopPointsAvg"],
        avgData[team1]["endgamePointsAvg"],
        avgData[team1]["teleopAlgaeNetAvg"] * 4,    // Multiply teleopAlgaeNetAvg by 4 to get points.
        avgData[team1]["teleopCoralL3Avg"] * 4      // Multiply teleopCoralL3Avg by 4 to get points.
      ], backgroundColor: '#FF4316'
    });
    datasets.push({
      label: team2, data: [
        avgData[team2]["autonPointsAvg"],
        avgData[team2]["teleopPointsAvg"],
        avgData[team2]["endgamePointsAvg"],
        avgData[team2]["teleopAlgaeNetAvg"] * 4,    // Multiply teleopAlgaeNetAvg by 4 to get points.
        avgData[team2]["teleopCoralL3Avg"] * 4      // Multiply teleopCoralL3Avg by 4 to get points.
      ], backgroundColor: '#0033FF'
    });

    // Define the graph as a bar chart:
    if (thirdPickChart !== undefined) {
      thirdPickChart.destroy();
    }

    // Create the third pick graph
    const ctx = document.getElementById('ThirdPickChart').getContext('2d');
    thirdPickChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ["Auton Avg Pts", "Teleop Avg Pts", "Endgame Avg Pts", "Teleop Net Pts", "Teleop L3 Pts"],
        datasets: datasets
      },
      options: {
        scales: {
          x: {},
          y: { min: 0, ticks: { precision: 0 }, max: 50 } // Set Y axis maximum value - 4 coral + algae in  auto plus leave
        },
        plugins: {
        }
      }
    });
  }
  ///// End of THIRD PICK GRAPH /////


  ///// MAIN PAGE PROCESSORS HERE /////
  // Check if our URL directs to a specific team compare
  function checkURLForTeamSpec(teamId) {
    console.log("=> teamCompare: checkURLForTeamSpec()");
    let sp = new URLSearchParams(window.location.search);
    if (sp.has('teamId')) {
      return sp.get('teamId');
    }
    return "";
  }

  function clearTeamComparePage() {
    // Clear existing data
    document.getElementById("aliasNumber1").innerText = "";
    document.getElementById("aliasNumber2").innerText = "";
    document.getElementById("teamMainTitle1").innerText = "";
    document.getElementById("teamMainTitle2").innerText = "";
    document.getElementById("firstPickChart").querySelector('tbody').innerHTML = "";
    document.getElementById("secondPickChart").querySelector('tbody').innerHTML = "";
    document.getElementById("thirdPickChart").querySelector('tbody').innerHTML = "";
    document.getElementById("strategicDataTable1").querySelector('tbody').innerHTML = "";
    document.getElementById("strategicDataTable2").querySelector('tbody').innerHTML = "";
    document.getElementById("averagesTable").querySelector('body').innerHTML = "";
  }

  function getDataValue(dict, key) {
    if (!dict) {
      console.warn("getDataValue: Dictionary not found! " + dict);
    }
    else if (key in dict) {
      return dict[key];
    }
    else {
      console.warn("getDataValue: Key not found in dictionary! " + key + " " + dict);
    }
    return "";
  }

  function createEndgameEntry(teamNum, avgData) {
    let endgameClimbPercentage = getDataValue(avgData[teamNum], "endgameClimbPercent");
    const tdPrefix = "<td>";

    let rowString = "";
    rowString += tdPrefix + "<a href='teamLookup.php?teamNum=" + teamNum + "'>" + teamNum + "</a></td>";
    rowString += tdPrefix + getDataValue(endgameClimbPercentage, 0) + "</td>";
    rowString += tdPrefix + getDataValue(endgameClimbPercentage, 2) + "</td>";
    rowString += tdPrefix + getDataValue(endgameClimbPercentage, 1) + "</td>";
    rowString += tdPrefix + getDataValue(endgameClimbPercentage, 3) + "</td>";
    rowString += tdPrefix + getDataValue(endgameClimbPercentage, 4) + "</td>";

    return rowString;
  }

  function loadEndgameTable(teamNum, teamNum2, avgData) {
    console.log("==> teamCompare: loadEndgameTable()");
    let tbodyRef = document.getElementById("endgameClimbTable").querySelector('tbody');
    tbodyRef.innerHTML = ""; // Clear Table

    tbodyRef.insertRow().innerHTML = createEndgameEntry(teamNum, avgData);
    tbodyRef.insertRow().innerHTML = createEndgameEntry(teamNum2, avgData);
  }

  // This is the main function that runs when we want to load teams.
  function buildTeamComparePage(teamNum1, teamNum2, aliasList) {
    console.log("==> teamCompare: buildTeamComparePage()");

    // Get team1 name from TBA
    $.get("api/tbaAPI.php", {
      getEventTeamNames: true
    }).done(function (eventTeamNames) {
      console.log("=> getEventTeamNames: ");
      if (eventTeamNames === null) {
        return alert("Can't load teams from TBA; check if TBA Key was set in db_config");
      }
      let jTeamNames = JSON.parse(eventTeamNames);
      let teamStr1 = "";
      let teamStr2 = "";
      for (let entry in jTeamNames) {
        if (parseInt(teamNum1) === jTeamNames[entry]["teamnum"]) {
          teamStr1 = jTeamNames[entry]["teamnum"] + " - " + jTeamNames[entry]["teamname"];
        }
        if (parseInt(teamNum2) === jTeamNames[entry]["teamnum"]) {
          teamStr2 = jTeamNames[entry]["teamnum"] + " - " + jTeamNames[entry]["teamname"];
        }
      }
      console.log("==> teamCompare: team1: \n" + teamStr1 + "\n" + teamStr2);
      document.getElementById("teamMainTitle1").innerHTML = teamStr1;
      document.getElementById("teamMainTitle2").innerHTML = teamStr2;
    });

    // Get strategic data and filter for both teams
    $.get("api/dbReadAPI.php", {
      getAllStrategicData: true
    }).done(function (allStrategicData) {
      let jStratData = JSON.parse(allStrategicData);
      console.log("=> getAllStrategicData");
      document.getElementById("strategicLink1").querySelector('a').text = teamNum1 + " - Strategic Data";
      insertStrategicDataBody("strategicDataTable1", jStratData, aliasList, [teamNum1]);
      document.getElementById("strategicLink2").querySelector('a').text = teamNum2 + " - Strategic Data";
      insertStrategicDataBody("strategicDataTable2", jStratData, aliasList, [teamNum2]);
    });

    // Get team2 match data
    $.get("api/dbReadAPI.php", {
      getAllMatchData: true
    }).done(function (allMatchData) {
      console.log("=> getAllMatchData");
      let jMatches = JSON.parse(allMatchData);
      let compareMatches = jMatches.filter(function (el) { return el["teamnumber"] == teamNum1 || el["teamnumber"] == teamNum2; });
      let mdp = new matchDataProcessor(compareMatches);
      if (mdp === null) {
        alert("No match data for this team at this event!");
      }

      // Get the team1 averages data from matchDataProcessor (mdp)
      mdp.getSiteFilteredAverages(function (filteredMatches, filteredAvgData) {
        if (filteredAvgData !== undefined) {

          // Load the graphs
          loadFirstPickGraph(teamNum1, teamNum2, filteredAvgData);
          loadSecondPickGraph(teamNum1, teamNum2, filteredAvgData);
          loadThirdPickGraph(teamNum1, teamNum2, filteredAvgData);
          loadEndgameTable(teamNum1, teamNum2, filteredAvgData);
          insertEventAveragesBody("averagesTable", filteredAvgData, [], aliasList, [teamNum1, teamNum2]);
        }
        else
          alert("No averages data for matches at this event!");
      });
    });
  }

  // Converts alias number in team number entry field
  function validateEnteredTeamNumber(enterId, aliasId, event, aliasList) {
    console.log("enterTeamNumber: focus out");
    let enteredNum = event.target.value.toUpperCase().trim();
    if (isAliasNumber(enteredNum)) {
      let teamNum = getTeamNumFromAlias(enteredNum, aliasList);
      if (teamNum === "")
        document.getElementById(aliasId).innerText = "Alias number " + enteredNum + " is NOT valid!";
      else
        document.getElementById(aliasId).innerText = "Alias number " + enteredNum + " is Team " + teamNum;
      document.getElementById(enterId).value = teamNum;
    }
    else
      document.getElementById(aliasId).innerText = "";
  }

  /////////////////////////////////////////////////////////////////////////////
  //
  // Process the generated html
  //    When the team compare page load button is pressed
  //      In parallel, start retrieving each of these for the selected team:
  //        - Team info (name) from TBA
  //
  document.addEventListener("DOMContentLoaded", function () {

    let jAliasNames = null;

    // Read the alias table
    $.get("api/dbReadAPI.php", {
      getEventAliasNames: true
    }).done(function (eventAliasNames) {
      console.log("=> eventAliasNames");
      jAliasNames = JSON.parse(eventAliasNames);
      insertStrategicDataHeader("strategicDataTable1", jAliasNames);
      insertStrategicDataHeader("strategicDataTable2", jAliasNames);
      insertEventAveragesHeader("averagesTable", jAliasNames);
    });


    // Pressing enter in team number field loads the page
    document.getElementById("enterTeamNumber1").addEventListener("keypress", function (event1) {
      if (event1.key === "Enter") {
        validateEnteredTeamNumber("enterTeamNumber1", "aliasNumber1", event, jAliasNames);
        event1.preventDefault();
        document.getElementById("loadTeamButton").click();
      }
    });

    document.getElementById("enterTeamNumber2").addEventListener("keypress", function (event2) {
      if (event2.key === "Enter") {
        validateEnteredTeamNumber("enterTeamNumber2", "aliasNumber2", event, jAliasNames);
        event2.preventDefault();
        document.getElementById("loadTeamButton").click();
      }
    });

    // Attach enterTeamNumber listener when losing focus to check for alias numbers
    document.getElementById('enterTeamNumber1').addEventListener('focusout', function () {
      console.log("enterTeamNumber: focus out");
      validateEnteredTeamNumber("enterTeamNumber1", "aliasNumber1", event, jAliasNames);
    });

    document.getElementById('enterTeamNumber2').addEventListener('focusout', function () {
      console.log("enterTeamNumber: focus out");
      validateEnteredTeamNumber("enterTeamNumber2", "aliasNumber2", event, jAliasNames);
    });

    // Load team data for the number entered
    document.getElementById("loadTeamButton").addEventListener('click', function () {
      let teamNum1 = document.getElementById("enterTeamNumber1").value.toUpperCase().trim();
      let teamNum2 = document.getElementById("enterTeamNumber2").value.toUpperCase().trim();
      if (validateTeamNumber(teamNum1, null) > 0 && validateTeamNumber(teamNum2, null) > 0) {
        buildTeamComparePage(teamNum1, teamNum2, jAliasNames);
      }
    });
  });

</script>

<script src="./scripts/aliasFunctions.js"></script>
<script src="./scripts/compareMatchNumbers.js"></script>
<script src="./scripts/compareTeamNumbers.js"></script>
<script src="./scripts/eventAveragesTable.js"></script>
<script src="./scripts/sortFrcTables.js"></script>
<script src="./scripts/matchDataProcessor.js"></script>
<script src="./scripts/strategicDataTable.js"></script>
<script src="./scripts/validateTeamNumber.js"></script>

<script src="./external/charts/chart.umd.js"></script>
