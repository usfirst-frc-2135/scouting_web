<?php
$title = 'Event Averages';
require 'inc/header.php';
?>

<div class="container row-offcanvas row-offcanvas-left">
  <div class="column card-lg-12 col-sm-12 col-xs-12" id="content">

    <!-- Page Title -->
    <div class="row pt-3 pb-3 mb-3">
      <h2 class="col-md-4"><?php echo $title; ?></h2>

      <div class="col-md-4 mb-3">
        <button id="downloadCsvFile" class="btn btn-primary" type="button">Download CSV</button>
      </div>

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
                <input id="endMatchNum" class="form-control col-2 mb-3" type="text" placeholder="End" aria-label="End Match Filter">
              </div>

              <div>
                <button id="filterData" class="btn btn-primary btn-sm mb-3" type="button">Filter Data</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Main row to hold the table -->
    <div class="row mb-3">

      <div id="freeze-table" class="freeze-table overflow-auto">
        <table id="averagesTable" class="table table-striped table-bordered table-hover table-sm border-dark text-center sortable">
          <colgroup>
            <col span="1" style="background-color:transparent">
            <col span="2" style="background-color:#cfe2ff">
            <col span="2" style="background-color:transparent">
            <col span="2" style="background-color:#cfe2ff">
            <col span="2" style="background-color:transparent">
            <col span="2" style="background-color:#cfe2ff">
            <col span="2" style="background-color:transparent">
            <col span="2" style="background-color:#cfe2ff">
            <col span="2" style="background-color:transparent">
            <col span="2" style="background-color:#cfe2ff">
            <col span="2" style="background-color:transparent">
            <col span="2" style="background-color:#cfe2ff">
            <col span="2" style="background-color:transparent">
            <col span="2" style="background-color:#cfe2ff">
            <col span="2" style="background-color:transparent">
            <col span="2" style="background-color:#cfe2ff">
            <col span="2" style="background-color:transparent">
            <col span="2" style="background-color:#cfe2ff">
            <col span="2" style="background-color:transparent">
            <col span="3" style="background-color:#cfe2ff">
            <col span="2" style="background-color:transparent">
            <col span="2" style="background-color:#cfe2ff">
            <col span="2" style="background-color:transparent">
            <col span="2" style="background-color:#cfe2ff">
            <col span="3" style="background-color:transparent">
            <col span="2" style="background-color:#cfe2ff">
            <col span="2" style="background-color:transparent">
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
              <th colspan="1" style="background-color:transparent"></th>
              <th colspan="8" style="background-color:#83b4ff">Match Points</th>
              <th colspan="4" style="background-color:#d5e6de">Auton Pts</th>
              <th colspan="4" style="background-color:#d6f3fB">Teleop Pts</th>
              <th colspan="4" style="background-color:#83b4ff">Game pieces</th>
              <th colspan="10" style="background-color:#d5e6de">Auton Coral</th>
              <th colspan="6" style="background-color:#d5e6de">Auton Algae</th>
              <th colspan="11" style="background-color:#d6f3fB">Teleop Coral</th>
              <th colspan="7" style="background-color:#d6f3fB">Teleop Algae</th>
              <th colspan="1" style="background-color:#AFE8F7">Def</th>
              <th colspan="5" style="background-color:#fbe6d3">Endgame</th>
              <th colspan="1" style="background-color:transparent"></th>
            </tr>
            <tr>
              <!-- team number -->
              <th colspan="1" style="background-color:transparent"></th>

              <!-- points by game phase -->
              <th colspan="2" style="background-color:#83b4ff">Total Pts</th>
              <th colspan="2" style="background-color:#d5e6de">Auton Pts</th>
              <th colspan="2" style="background-color:#d6f3fB">Teleop Pts</th>
              <th colspan="2" style="background-color:#fbe6d3">Endgame Pts</th>

              <!-- points by game piece -->
              <th colspan="2" style="background-color:#d5e6de">Coral Pts</th>
              <th colspan="2" style="background-color:transparent">Algae Pts</th>
              <th colspan="2" style="background-color:#d6f3fB">Coral Pts</th>
              <th colspan="2" style="background-color:transparent">Algae Pts</th>

              <th colspan="2" style="background-color:#83b4ff">Total Coral</th>
              <th colspan="2" style="background-color:transparent">Total Algae</th>

              <!-- auton coral -->
              <th colspan="2" style="background-color:#d5e6de">Auton Coral</th>
              <th colspan="2" style="background-color:transparent">L4</th>
              <th colspan="2" style="background-color:#d5e6de">L3</th>
              <th colspan="2" style="background-color:transparent">L2</th>
              <th colspan="2" style="background-color:#d5e6de">L1</th>

              <!-- auton algae -->
              <th colspan="2" style="background-color:transparent">Total Algae</th>
              <th colspan="2" style="background-color:#d5e6de">Proc</th>
              <th colspan="2" style="background-color:transparent">Net</th>

              <!-- teleop coral -->
              <th colspan="3" style="background-color:#d6f3fB">Teleop Coral</th>
              <th colspan="2" style="background-color:transparent">L4</th>
              <th colspan="2" style="background-color:#d6f3fB">L3</th>
              <th colspan="2" style="background-color:transparent">L2</th>
              <th colspan="2" style="background-color:#d6f3fB">L1</th>

              <!-- teleop algae -->
              <th colspan="3" style="background-color:transparent">Teleop Algae</th>
              <th colspan="2" style="background-color:#d6f3fB">Proc</th>
              <th colspan="2" style="background-color:transparent">Net</th>

              <!-- defense -->
              <th colspan="1" style="background-color:#AFE8F7"></th>

              <!-- endgame -->
              <th colspan="5" style="background-color:#fbe6d3">Climb%</th>

              <!-- died -->
              <th colspan="1" style="background-color:transparent">Died</th>
            </tr>
            <tr>
              <!-- team number -->
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Team</th>

              <!-- points by game phase -->
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Max</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Max</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Max</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Max</th>

              <!-- points by game piece -->
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Max</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Max</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Max</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Max</th>

              <!-- total game pieces -->
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Max</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Max</th>

              <!-- auton coral -->
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Max</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Max</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Max</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Max</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Max</th>

              <!-- auton algae -->
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Max</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Max</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Max</th>

              <!-- teleop coral -->
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Acc%</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Max</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Max</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Max</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Max</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Max</th>

              <!-- telop algae -->
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Acc%</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Max</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Max</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Max</th>

              <!-- defense -->
              <th scope="col" class="sorttable_numeric" style="background-color:#AFE8F7">Avg</th>

              <!-- endgame -->
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">N</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">P</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">F</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">S</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">D</th>

              <!-- died -->
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">#</th>
            </tr>

          </thead>
          <tbody class="table-group-divider"> </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php include 'inc/footer.php'; ?>

<!-- Javascript page handlers -->

<script>

  // Lookup value for a key in the passed dictionary - team in match data
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

  // Create and the HTML table for display
  function addAveragesToTable(tableId, teamList, avgData) {
    console.log("==> eventAverages: addAveragesToTable()");
    let tbodyRef = document.getElementById(tableId).querySelector('tbody');
    tbodyRef.innerHTML = ""; // Clear Table
    for (let teamNum of teamList) {
      let endgameClimbPercentage = getDataValue(avgData[teamNum], "endgameClimbPercent");

      const tdPrefix = "<td style=\"background-color:transparent\">";
      let rowString = "";
      rowString += tdPrefix + "<a href='teamLookup.php?teamNum=" + teamNum + "'>" + teamNum + "</a></td>";

      // points by game phase
      rowString += tdPrefix + getDataValue(avgData[teamNum], "totalPointsAvg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "totalPointsMax") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "autonPointsAvg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "autonPointsMax") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "teleopPointsAvg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "teleopPointsMax") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "endgamePointsAvg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "endgamePointsMax") + "</td>";

      // points by game piece
      rowString += tdPrefix + getDataValue(avgData[teamNum], "autonCoralPointsAvg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "autonCoralPointsMax") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "autonAlgaePointsAvg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "autonAlgaePointsMax") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "teleopCoralPointsAvg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "teleopCoralPointsMax") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "teleopAlgaePointsAvg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "teleopAlgaePointsMax") + "</td>";

      // total game pieces
      rowString += tdPrefix + getDataValue(avgData[teamNum], "totalCoralScoredAvg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "totalCoralScoredMax") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "totalAlgaeScoredAvg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "totalAlgaeScoredMax") + "</td>";

      // auton coral
      rowString += tdPrefix + getDataValue(avgData[teamNum], "autonCoralScoredAvg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "autonCoralScoredMax") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "autonCoralL4Avg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "autonCoralL4Max") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "autonCoralL3Avg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "autonCoralL3Max") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "autonCoralL2Avg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "autonCoralL2Max") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "autonCoralL1Avg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "autonCoralL1Max") + "</td>";

      // auton algae
      rowString += tdPrefix + getDataValue(avgData[teamNum], "autonAlgaeScoredAvg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "autonAlgaeScoredMax") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "autonAlgaeProcAvg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "autonAlgaeProcMax") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "autonAlgaeNetAvg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "autonAlgaeNetMax") + "</td>";

      // teleop coral
      rowString += tdPrefix + getDataValue(avgData[teamNum], "teleopCoralPercent") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "teleopCoralScoredAvg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "teleopCoralScoredMax") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "teleopCoralL4Avg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "teleopCoralL4Max") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "teleopCoralL3Avg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "teleopCoralL3Max") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "teleopCoralL2Avg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "teleopCoralL2Max") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "teleopCoralL1Avg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "teleopCoralL1Max") + "</td>";

      // teleop algae
      rowString += tdPrefix + getDataValue(avgData[teamNum], "teleopAlgaePercent") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "teleopAlgaeScoredAvg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "teleopAlgaeScoredMax") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "teleopAlgaeProcAvg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "teleopAlgaeProcMax") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "teleopAlgaeNetAvg") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "teleopAlgaeNetMax") + "</td>";

      // defense
      rowString += tdPrefix + getDataValue(avgData[teamNum], "defenseAvg") + "</td>";

      // endgame
      rowString += tdPrefix + getDataValue(endgameClimbPercentage, 0) + "</td>";
      rowString += tdPrefix + getDataValue(endgameClimbPercentage, 1) + "</td>";
      rowString += tdPrefix + getDataValue(endgameClimbPercentage, 2) + "</td>";
      rowString += tdPrefix + getDataValue(endgameClimbPercentage, 3) + "</td>";
      rowString += tdPrefix + getDataValue(endgameClimbPercentage, 4) + "</td>";

      rowString += tdPrefix + getDataValue(avgData[teamNum], "totaldied") + "</td>";

      tbodyRef.insertRow().innerHTML = rowString;
    }
  }

  // Add a team (key) to the final team list
  function getTeamListFromData(matchData) {
    console.log("==> eventAverages: getTeamListFromData()");
    let keyList = [];
    for (let teamNum in matchData) {
      keyList.push(teamNum);
    }
    return keyList;
  }

  // CSV File functions

  // Retrieve an average value from data for a team
  function lookupAverage(teamAverages, team, item) {
    // console.log("==> eventAverages: lookupAverage()");
    if (!teamAverages) {
      console.warn("lookupAverages: No team averages!");
      return "NA";
    }
    if (!(team in teamAverages)) {
      console.warn("lookupAverages: Team not in list!");
      return "NA";
    }
    return teamAverages[team][item];
  }

  // Returns a string with the comma-separated line of data for the given team.
  function createCSVLine(team, evtAvgs, coprs) {
    let pitLocation = 0;
    let oprTP = getDataValue(coprs[team], "totalPoints");
    let endgameClimbPercent = lookupAverage(evtAvgs, team, "endgameClimbPercent");
    let csvLine = team + ",";

    csvLine += pitLocation + ",";
    csvLine += oprTP + ",";

    // points
    csvLine += lookupAverage(evtAvgs, team, "totalPointsAvg") + ",";
    csvLine += lookupAverage(evtAvgs, team, "totalPointsMax") + ",";
    csvLine += lookupAverage(evtAvgs, team, "autonPointsAvg") + ",";
    csvLine += lookupAverage(evtAvgs, team, "autonPointsMax") + ",";
    csvLine += lookupAverage(evtAvgs, team, "teleopPointsAvg") + ",";
    csvLine += lookupAverage(evtAvgs, team, "teleopPointsMax") + ",";
    csvLine += lookupAverage(evtAvgs, team, "endgamePointsAvg") + ",";
    csvLine += lookupAverage(evtAvgs, team, "endgamePointsMax") + ",";

    // points by game piece
    csvLine += lookupAverage(evtAvgs, team, "autonCoralPointsAvg") + ",";
    csvLine += lookupAverage(evtAvgs, team, "autonCoralPointsMax") + ",";
    csvLine += lookupAverage(evtAvgs, team, "autonAlgaePointsAvg") + ",";
    csvLine += lookupAverage(evtAvgs, team, "autonAlgaePointsMax") + ",";
    csvLine += lookupAverage(evtAvgs, team, "teleopCoralPointsAvg") + ",";
    csvLine += lookupAverage(evtAvgs, team, "teleopCoralPointsMax") + ",";
    csvLine += lookupAverage(evtAvgs, team, "teleopAlgaePointsAvg") + ",";
    csvLine += lookupAverage(evtAvgs, team, "teleopAlgaePointsMax") + ",";

    // total game pieces
    csvLine += lookupAverage(evtAvgs, team, "totalCoralScoredAvg") + ",";
    csvLine += lookupAverage(evtAvgs, team, "totalCoralScoredMax") + ",";
    csvLine += lookupAverage(evtAvgs, team, "totalAlgaeScoredAvg") + ",";
    csvLine += lookupAverage(evtAvgs, team, "totalAlgaeScoredMax") + ",";

    // auton coral
    csvLine += lookupAverage(evtAvgs, team, "autonCoralScoredAvg") + ",";
    csvLine += lookupAverage(evtAvgs, team, "autonCoralScoredMax") + ",";
    csvLine += lookupAverage(evtAvgs, team, "autonCoralL4Avg") + ",";
    csvLine += lookupAverage(evtAvgs, team, "autonCoralL4Max") + ",";
    csvLine += lookupAverage(evtAvgs, team, "autonCoralL3Avg") + ",";
    csvLine += lookupAverage(evtAvgs, team, "autonCoralL3Max") + ",";
    csvLine += lookupAverage(evtAvgs, team, "autonCoralL2Avg") + ",";
    csvLine += lookupAverage(evtAvgs, team, "autonCoralL2Max") + ",";
    csvLine += lookupAverage(evtAvgs, team, "autonCoralL1Avg") + ",";
    csvLine += lookupAverage(evtAvgs, team, "autonCoralL1Max") + ",";

    // auton algae
    csvLine += lookupAverage(evtAvgs, team, "autonAlgaeScoredAvg") + ",";
    csvLine += lookupAverage(evtAvgs, team, "autonAlgaeScoredMax") + ",";
    csvLine += lookupAverage(evtAvgs, team, "autonAlgaeProcAvg") + ",";
    csvLine += lookupAverage(evtAvgs, team, "autonAlgaeProcMax") + ",";
    csvLine += lookupAverage(evtAvgs, team, "autonAlgaeNetAvg") + ",";
    csvLine += lookupAverage(evtAvgs, team, "autonAlgaeNetMax") + ",";

    // teleop coral
    csvLine += lookupAverage(evtAvgs, team, "teleopCoralPercent") + ",";
    csvLine += lookupAverage(evtAvgs, team, "teleopCoralScoredAvg") + ",";
    csvLine += lookupAverage(evtAvgs, team, "teleopCoralScoredMax") + ",";
    csvLine += lookupAverage(evtAvgs, team, "teleopCoralL4Avg") + ",";
    csvLine += lookupAverage(evtAvgs, team, "teleopCoralL4Max") + ",";
    csvLine += lookupAverage(evtAvgs, team, "teleopCoralL3Avg") + ",";
    csvLine += lookupAverage(evtAvgs, team, "teleopCoralL3Max") + ",";
    csvLine += lookupAverage(evtAvgs, team, "teleopCoralL2Avg") + ",";
    csvLine += lookupAverage(evtAvgs, team, "teleopCoralL2Max") + ",";
    csvLine += lookupAverage(evtAvgs, team, "teleopCoralL1Avg") + ",";
    csvLine += lookupAverage(evtAvgs, team, "teleopCoralL1Max") + ",";

    // auton algae
    csvLine += lookupAverage(evtAvgs, team, "teleopAlgaePercent") + ",";
    csvLine += lookupAverage(evtAvgs, team, "teleopAlgaeScoredAvg") + ",";
    csvLine += lookupAverage(evtAvgs, team, "teleopAlgaeScoredMax") + ",";
    csvLine += lookupAverage(evtAvgs, team, "teleopAlgaeProcAvg") + ",";
    csvLine += lookupAverage(evtAvgs, team, "teleopAlgaeProcMax") + ",";
    csvLine += lookupAverage(evtAvgs, team, "teleopAlgaeNetAvg") + ",";
    csvLine += lookupAverage(evtAvgs, team, "teleopAlgaeNetMax") + ",";

    // endgame
    csvLine += getDataValue(endgameClimbPercent, 0) + ",";
    csvLine += getDataValue(endgameClimbPercent, 1) + ",";
    csvLine += getDataValue(endgameClimbPercent, 2) + ",";
    csvLine += getDataValue(endgameClimbPercent, 3) + ",";
    csvLine += getDataValue(endgameClimbPercent, 4) + ",";

    csvLine += lookupAverage(evtAvgs, team, "totaldied") + ",";
    csvLine += "-\n";    // NOTE
    return csvLine;
  }

  // Merge data into CSV file and write it
  function createCSVFile(csvName, matchData, coprs) {
    console.log("==> eventAverages: createCSVFile()");
    // This CSV header must match the order in createCSVLine!
    let csvStr = "Team,Pit Location,OPR," +
      "Total Pts Avg,Total Pts Max,Auto Pts Avg,Auto Pts Max,Tel Pts Avg,Tel Pts Max,End Pts Avg,End Pts Max," +
      "Auton Coral Pts Avg,Total Coral Pts Max,Auto Algae Pts Avg,Auto Algae Pts Max,Tel Coral Pts Avg,Tel Coral Pts Max,Tel Algae Pts Avg,Tel Algae Pts Max," +
      "Total Coral Avg,Total Coral Max,Total Algae Avg,Total Algae Max," +
      "Auto Coral Avg,Auto Coral Max,Auto L4 Avg,Auto L4 Max,Auto L3 Avg,Auto L3 Max,Auto L2 Avg,Auto L2 Max,Auto L1 Avg,Auto L1 Max," +
      "Auto Algae Avg,Auto Algae Max,Auto Proc Avg,Auto Proc Max,Auto Net Avg,Auto Net Max," +
      "Tel Coral Acc,Tel Coral Avg,Tel Coral Max,Tel L4 Avg,Tel L4 Max,Tel L3 Avg,Tel L3 Max,Tel L2 Avg,Tel L2 Max,Tel L1 Avg,Tel L1 Max," +
      "Tel Algae Acc,Tel Algae Avg,Tel Algae Max,Tel Proc Avg,Tel Proc Max,Tel Net Avg,Tel Net Max," +
      "End N/A,End Park,End Fall,End Shal,End Deep," +
      "Total Died, Note\n";

    let mdp = new matchDataProcessor(matchData);
    mdp.getSiteFilteredAverages(function (filteredMatchData, filteredAvgData) {
      for (let key in filteredAvgData) {
        // console.log(key);
        csvStr += createCSVLine(key, filteredAvgData, coprs);  // key is team number
      }

      let hiddenElement = document.createElement('a');
      let filename = frcEventCode + "_" + csvName.trim() + ".csv";
      console.log("eventAverages: createCSVFile() CSV filename: " + filename);
      hiddenElement.href = 'data:text/csv;charset=utf-8,' + encodeURI(csvStr);
      hiddenElement.target = '_blank';
      hiddenElement.download = filename;
      hiddenElement.click();
    });
  }

  // Retrieve match data and OPRs data (in parallel) and write out CSV file
  function downloadCSVFile(csvName) {
    console.log("==> eventAverages: downloadCSVFile()");
    let jMatchData = null;
    let jCoprData = null;
    function waitForData(mData, cData) {
      if ((mData === null) || (cData === null)) {
        return;
      }
      console.log("Creating the CSV");
      createCSVFile(csvName, mData, cData);
    }

    // Get match data from DB
    $.get("api/dbReadAPI.php", {
      getAllMatchData: true
    }).done(function (matchData) {
      console.log("=> getAllMatchData:");
      jMatchData = JSON.parse(matchData);
      waitForData(jMatchData, jCoprData);
    });

    // Get OPR data from TBA
    $.get("api/tbaAPI.php", {
      getCOPRs: true
    }).done(function (coprs) {
      console.log("=> getCOPRs");
      if (coprs === null) {
        return alert("Can't load COPRs from TBA; check if TBA Key was set in db_config");
      }
      jCoprData = JSON.parse(coprs)["data"];
      waitForData(jMatchData, jCoprData);
    });
  }

  // Get all match data, filter it, create final HTML table, and sort it
  function buildAveragesTable(tableId, startMatch, endMatch) {
    console.log("==> eventAverages: buildAveragesTable()");
    $.get("api/dbReadAPI.php", {
      getAllMatchData: true
    }).done(function (matchData) {
      console.log("=> getAllMatchData:");
      mdp = new matchDataProcessor(JSON.parse(matchData));
      if (startMatch !== null && endMatch !== null) {
        mdp.filterMatchRange(startMatch, endMatch);
      }
      mdp.getSiteFilteredAverages(function (filteredMatchData, filteredAvgData) {
        let teamList = getTeamListFromData(filteredAvgData);
        addAveragesToTable(tableId, teamList, filteredAvgData);
        // script instructions say this is needed, but it breaks table header sorting
        // sorttable.makeSortable(document.getElementById(tableId));
        document.getElementById(tableId).click(); // This magic fixes the floating column bug
      });
    });
  }

  /////////////////////////////////////////////////////////////////////////////
  //
  // Process the generated html
  //    Get all match data and averages from our database (can be filtered by match)
  //    When completed, display the web page
  //
  //    If download button is clicked
  //    Get (again) all pit data from our database
  //    Get event COPRs from TBA
  //    Write combined data into a CSV file
  //
  document.addEventListener("DOMContentLoaded", function () {

    const tableId = "averagesTable";
    const frozenTable = new FreezeTable('.freeze-table', { fixedNavbar: '.navbar' });
    const csvFileName = "eventAverages";

    buildAveragesTable(tableId, null, null); // Retrieve all data

    // Filter out unwanted matches
    document.getElementById("filterData").addEventListener('click', function () {
      let startMatch = document.getElementById("startCompLevel").value + document.getElementById("startMatchNum").value.trim();
      let endMatch = document.getElementById("endCompLevel").value + document.getElementById("endMatchNum").value.trim();
      console.log("==> eventAverages: filterMatchRange: " + startMatch + " to " + endMatch);
      buildAveragesTable(tableId, startMatch, endMatch);
    });

    // Write out picklist CSV file to client's download dir.
    document.getElementById("downloadCsvFile").addEventListener('click', function () {
      downloadCSVFile(csvFileName);
    });

    // Create frozen table panes and keep the panes updated
    document.getElementById(tableId).addEventListener('click', function () {
      if (frozenTable) {
        frozenTable.update();
      }
    });
  });

</script>

<script src="./scripts/matchDataProcessor.js"></script>
