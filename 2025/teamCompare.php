<?php
$title = 'Team Compare';
require 'inc/header.php';
?>

<div class="container row-offcanvas row-offcanvas-left">
  <div id="content" class="column card-lg-12 col-sm-12 col-xs-12">

    <!-- Page Title -->
    <div class="row pt-3 mb-3">
      <h2 class="col-md-6 mb-3 me-3"><?php echo $title; ?> </h2>
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
            <div class="card mb-3 bg-success-subtle">
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
            <div class="card mb-3 bg-warning-subtle">
              <div class="card-header">
                <h5 class="text-center"> <a href="#collapseEndgame" data-bs-toggle="collapse" aria-expanded="true">Endgame Climb
                    Percentages
                  </a>
                </h5>
              </div>
              <div id="collapseEndgame" class="card-body collapse show">
                <table id="endgameClimbTable"
                  class="table table-striped table-bordered table-hover table-sm border-secondary text-center ">
                  <thead>
                    <tr>
                      <th>Team</th>
                      <th scope="col" style="width:12%">N%</th>
                      <th scope="col" style="width:12%">F%</th>
                      <th scope="col" style="width:12%">P%</th>
                      <th scope="col" style="width:12%">S%</th>
                      <th scope="col" style="width:12%">D%</th>
                    </tr>
                  </thead>
                  <tbody class="table-group-divider">
                  </tbody>
                </table>
              </div>
            </div>

            <!-- Second Pick collapsible graph -->
            <div class="card mb-3 bg-success-subtle">
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
            <div class="card mb-3 bg-success-subtle">
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
          <table id="strategicDataTable1"
            class="table table-striped table-bordered table-hover table-sm border-secondary text-center">
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
          <table id="strategicDataTable2"
            class="table table-striped table-bordered table-hover table-sm border-secondary text-center">
            <thead> </thead>
            <tbody class="table-group-divider"> </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Event Averages section -->
    <div class="column card-lg-12 col-sm-12 col-xs-12" id="content">

      <!-- Section Title -->
      <div class="row pt-3 mb-3">
        <h3 class="col-md-4"><?php echo "Event Averages"; ?> </h3>

        <!-- Match Filter -->
        <div class="col-md-3">
          <div id="customMatch" class="accordion accordion-flush">
            <div class="accordion-item bg-secondary-subtle">
              <h2 class="accordion-header">
                <button class="accordion-button text-light bg-secondary mb-3" type="button" data-bs-toggle="collapse"
                  data-bs-target="#filterEntry" aria-expanded="false" aria-controls="matchEntry">Match Range Filter</button>
              </h2>

              <div id="filterEntry" class="accordion-collapse collapse" data-bs-parent="#customMatch">

                <div class="input-group">
                  <div class="input-group-prepend">
                    <select id="startCompLevel" class="form-select ms-2 mb-3" aria-label="Comp Level Select">
                      <option value="p">P</option>
                      <option value="qm" selected>QM</option>
                      <option value="sf">SF</option>
                      <option value="f">F</option>
                    </select>
                  </div>
                  <input id="startMatchNum" class="form-control col-2 me-2 mb-3" type="text" placeholder="Start"
                    aria-label="Start Match Filter">
                </div>

                <div class="input-group">
                  <div class="input-group-prepend">
                    <select id="endCompLevel" class="form-select ms-2 mb-3" aria-label="Comp Level Select">
                      <option value="p">P</option>
                      <option value="qm" selected>QM</option>
                      <option value="sf">SF</option>
                      <option value="f">F</option>
                    </select>
                  </div>
                  <input id="endMatchNum" class="form-control col-2 me-2 mb-3" type="text" placeholder="End"
                    aria-label="End Match Filter">
                </div>

                <div>
                  <button id="filterData" class="btn btn-primary btn-sm ms-2 mb-3" type="button">Filter Data</button>
                </div>

              </div>
            </div>

          </div>
        </div>
      </div>

      <!-- Main row to hold the table -->
      <div class="row mb-3">

        <div id="freeze-table" class="freeze-table overflow-auto">
          <table id="averagesTable" class="table table-striped table-bordered table-hover table-sm border-secondary text-center">
            <thead> </thead>
            <tbody class="table-group-divider">
            </tbody>
          </table>
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

  //
  // Round data to no more than two decimal digits
  //
  function roundTwoPlaces(val) {
    return Math.round((val + Number.EPSILON) * 100) / 100;
  }

  //
  ///// FIRST PICK GRAPH STARTS HERE /////
  //
  function loadFirstPickGraph(team1, team2, avgData) {
    console.log("==> teamCompare: loadFirstPickGraph()");
    let datasets = [];

    datasets.push({
      label: team1, data: [
        avgData[team1]["autonPoints"].avg,
        avgData[team1]["teleopPoints"].avg,
        avgData[team1]["endgamePoints"].avg,
        avgData[team1]["teleopAlgaeNet"].avg * 4,    // Multiply teleopAlgaeNetAvg by 4 to get points.
        avgData[team1]["teleopCoralL4"].avg * 5,     // Multiply teleopCoralL4Avg by 5 to get points.
        avgData[team1]["teleopCoralL3"].avg * 4      // Multiply teleopCoralL3Avg by 4 to get points.
      ], backgroundColor: '#FF4316'
    });
    datasets.push({
      label: team2, data: [
        avgData[team2]["autonPoints"].avg,
        avgData[team2]["teleopPoints"].avg,
        avgData[team2]["endgamePoints"].avg,
        avgData[team2]["teleopAlgaeNet"].avg * 4,    // Multiply teleopAlgaeNetAvg by 4 to get points.
        avgData[team2]["teleopCoralL4"].avg * 5,     // Multiply teleopCoralL4Avg by 5 to get points.
        avgData[team2]["teleopCoralL3"].avg * 4      // Multiply teleopCoralL3Avg by 4 to get points.
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

  //
  ///// SECOND PICK GRAPH STARTS HERE /////
  //
  function loadSecondPickGraph(team1, team2, avgData) {
    console.log("==> teamCompare: loadSecondPickGraph()");
    let datasets = [];

    datasets.push({
      label: team1, data: [
        avgData[team1]["autonPoints"].avg,
        avgData[team1]["teleopPoints"].avg,
        avgData[team1]["endgamePoints"].avg,
        avgData[team1]["teleopAlgaeNet"].avg * 4,    // Multiply teleopAlgaeNetAvg by 4 to get points.
        avgData[team1]["teleopCoralL3"].avg * 4,     // Multiply teleopCoralL3Avg by 4 to get points.
        avgData[team1]["teleopCoralL2"].avg * 3      // Multiply teleopCoralL2Avg by 3 to get points.
      ], backgroundColor: '#FF4316'
    });
    datasets.push({
      label: team2, data: [
        avgData[team2]["autonPoints"].avg,
        avgData[team2]["teleopPoints"].avg,
        avgData[team2]["endgamePoints"].avg,
        avgData[team2]["teleopAlgaeNet"].avg * 4,    // Multiply teleopAlgaeNetAvg by 4 to get points.   
        avgData[team2]["teleopCoralL3"].avg * 4,     // Multiply teleopCoralL3Avg by 4 to get points.
        avgData[team2]["teleopCoralL2"].avg * 3      // Multiply teleopCoralL2Avg by 3 to get points.
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

  //
  ///// THIRD PICK GRAPH STARTS HERE /////
  //
  function loadThirdPickGraph(team1, team2, avgData) {
    console.log("==> teamCompare: loadThirdPickGraph()");
    let datasets = [];

    datasets.push({
      label: team1, data: [
        avgData[team1]["autonPoints"].avg,
        avgData[team1]["teleopPoints"].avg,
        avgData[team1]["endgamePoints"].avg,
        avgData[team1]["teleopAlgaeNet"].avg * 4,    // Multiply teleopAlgaeNetAvg by 4 to get points.
        avgData[team1]["teleopCoralL3"].avg * 4      // Multiply teleopCoralL3Avg by 4 to get points.
      ], backgroundColor: '#FF4316'
    });
    datasets.push({
      label: team2, data: [
        avgData[team2]["autonPoints"].avg,
        avgData[team2]["teleopPoints"].avg,
        avgData[team2]["endgamePoints"].avg,
        avgData[team2]["teleopAlgaeNet"].avg * 4,    // Multiply teleopAlgaeNetAvg by 4 to get points.
        avgData[team2]["teleopCoralL3"].avg * 4      // Multiply teleopCoralL3Avg by 4 to get points.
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


  //
  ///// MAIN PAGE PROCESSORS HERE /////
  //    Check if our URL directs to a specific team compare
  function checkURLForTeamSpec(teamId) {
    console.log("=> teamCompare: checkURLForTeamSpec()");
    let sp = new URLSearchParams(window.location.search);
    if (sp.has('teamId')) {
      return sp.get('teamId');
    }
    return "";
  }

  //
  // Clear all existing data fields and tables
  //
  function clearTeamComparePage() {
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

  //
  // Safely get a value from a dictionary, warn if not found
  //
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

  //
  // Create a single endgame climb entry row
  //
  function createEndgameEntry(teamNum, avgData) {
    let endgameCageClimb = getDataValue(avgData[teamNum], "endgameCageClimb");
    const tdPrefix = "<td>";

    let rowString = "";
    rowString += tdPrefix + "<a href='teamLookup.php?teamNum=" + teamNum + "'>" + teamNum + "</a></td>";
    rowString += tdPrefix + getDataValue(endgameCageClimb.arr, 0).avg + "</td>";
    rowString += tdPrefix + getDataValue(endgameCageClimb.arr, 2).avg + "</td>";
    rowString += tdPrefix + getDataValue(endgameCageClimb.arr, 1).avg + "</td>";
    rowString += tdPrefix + getDataValue(endgameCageClimb.arr, 3).avg + "</td>";
    rowString += tdPrefix + getDataValue(endgameCageClimb.arr, 4).avg + "</td>";
    return rowString;
  }

  function loadEndgameTable(teamNum, teamNum2, avgData) {
    console.log("==> teamCompare: loadEndgameTable()");
    let tbodyRef = document.getElementById("endgameClimbTable").querySelector('tbody');
    tbodyRef.innerHTML = ""; // Clear Table

    tbodyRef.insertRow().innerHTML = createEndgameEntry(teamNum, avgData);
    tbodyRef.insertRow().innerHTML = createEndgameEntry(teamNum2, avgData);
  }

  //
  // Retrieve team info from TBA and alias list
  //
  function getTeamDescription(teamNum, aliasList, evtInfo) {
    // Get alias numbers if they exist for this team number
    let aliasNum = "";
    if (aliasList !== null) {
      aliasNum = getAliasFromTeamNum(teamNum, aliasList);
    }

    // Get the team name from TBA event info
    let teamStr = "";
    for (let entry in evtInfo) {
      let teamEntry = evtInfo[entry];
      if (teamNum === teamEntry["teamnum"].toString()) {
        teamStr = teamNum + " - " + teamEntry["teamname"];
        break;
      }
    }

    // Form the final team string
    if (aliasNum !== "") {
      teamStr = teamNum + " - " + aliasNum;
    }
    console.log("==> teamCompare: team: " + teamStr);
    return teamStr
  }

  //
  // This is the main function that runs when we want to load teams.
  //
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
      document.getElementById("teamMainTitle1").innerText = getTeamDescription(teamNum1, aliasList, jTeamNames);;
      document.getElementById("teamMainTitle2").innerText = getTeamDescription(teamNum2, aliasList, jTeamNames);
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

  //
  // Autocorrects alias number in team number entry field
  //
  function validateEnteredTeamNumber(enterId, aliasId, event, aliasList) {
    console.log("enterTeamNumber: focus out");
    let enteredNum = event.target.value.toUpperCase().trim();
    if (isAliasNumber(enteredNum) && aliasList !== null) {
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

    // Filter out unwanted matches
    document.getElementById("filterData").addEventListener('click', function () {
      let startMatch = document.getElementById("startCompLevel").value + document.getElementById("startMatchNum").value.trim();
      let endMatch = document.getElementById("endCompLevel").value + document.getElementById("endMatchNum").value.trim();
      console.log("==> eventAverages: filterMatchRange: " + startMatch + " to " + endMatch);
      alert("Match filter not yet implemented!");
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
