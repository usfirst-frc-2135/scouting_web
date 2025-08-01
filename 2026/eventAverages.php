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
          </colgroup>
          <thead>
            <tr>
              <th colspan="1" style="background-color:transparent"></th>
              <th colspan="6" style="background-color:#83b4ff">Totals</th>
              <th colspan="6" style="background-color:#d5e6de">Auton Pts</th>
              <th colspan="6" style="background-color:#d6f3fB">Teleop Pts</th>
              <th colspan="2" style="background-color:#fbe6d3">Endgame</th>
              <th colspan="10" style="background-color:#d5e6de">Auton Coral</th>
              <th colspan="6" style="background-color:#d5e6de">Auton Algae</th>
              <th colspan="11" style="background-color:#d6f3fB">Teleop Coral</th>
              <th colspan="7" style="background-color:#d6f3fB">Teleop Algae</th>
              <th colspan="5" style="background-color:#fbe6d3">Endgame</th>
              <th colspan="1" style="background-color:transparent"></th>
            </tr>
            <tr>
              <th colspan="1" style="background-color:transparent"></th>
              <th colspan="2" style="background-color:#83b4ff">Points</th>
              <th colspan="2" style="background-color:transparent">Coral Pts</th>
              <th colspan="2" style="background-color:#83b4ff">Algae Pts</th>
              <th colspan="2" style="background-color:transparent">Points</th>
              <th colspan="2" style="background-color:#83b4ff">Coral Pts</th>
              <th colspan="2" style="background-color:transparent">Algae Pts</th>
              <th colspan="2" style="background-color:#83b4ff">Points</th>
              <th colspan="2" style="background-color:transparent">Coral Pts</th>
              <th colspan="2" style="background-color:#83b4ff">Algae Pts</th>
              <th colspan="2" style="background-color:transparent">Points</th>
              <th colspan="2" style="background-color:#83b4ff">Total</th>
              <th colspan="2" style="background-color:transparent">L1</th>
              <th colspan="2" style="background-color:#83b4ff">L2</th>
              <th colspan="2" style="background-color:transparent">L3</th>
              <th colspan="2" style="background-color:#83b4ff">L4</th>
              <th colspan="2" style="background-color:transparent">Total</th>
              <th colspan="2" style="background-color:#83b4ff">Net</th>
              <th colspan="2" style="background-color:transparent">Proc</th>
              <th colspan="3" style="background-color:#83b4ff">Total</th>
              <th colspan="2" style="background-color:transparent">L1</th>
              <th colspan="2" style="background-color:#83b4ff">L2</th>
              <th colspan="2" style="background-color:transparent">L3</th>
              <th colspan="2" style="background-color:#83b4ff">L4</th>
              <th colspan="3" style="background-color:transparent">Total</th>
              <th colspan="2" style="background-color:#83b4ff">Net</th>
              <th colspan="2" style="background-color:transparent">Proc</th>
              <th colspan="5" style="background-color:#83b4ff">Climb%</th>
              <th colspan="1" style="background-color:transparent">Died</th>
            </tr>
            <tr>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Team</th>
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
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Max</th>
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
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Max</th>
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
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Max</th>
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
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Acc%</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Max</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Max</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Avg</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">Max</th>

              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">N</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">P</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">F</th>
              <th scope="col" class="sorttable_numeric" style="background-color:transparent">S</th>
              <th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">D</th>
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
      //rowString += tdPrefix + getDataValue(tbaData[teamNum], "totalPoints") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "avgTotalPoints") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "maxTotalPoints") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "avgTotalCoral") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "maxTotalCoral") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "avgTotalAlgae") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "maxTotalAlgae") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "avgTotalAutoPoints") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "maxTotalAutoPoints") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "avgTotalAutoCoralPoints") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "maxTotalAutoCoralPoints") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "avgTotalAutoAlgaePoints") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "maxTotalAutoAlgaePoints") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "avgTotalTeleopPoints") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "maxTotalTeleopPoints") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "avgTotalTeleopCoralPoints") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "maxTotalTeleopCoralPoints") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "avgTotalTeleopAlgaePoints") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "maxTotalTeleopAlgaePoints") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "avgEndgamePoints") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "maxEndgamePoints") + "</td>";

      rowString += tdPrefix + getDataValue(avgData[teamNum], "avgAutonCoral") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "maxAutonCoral") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "avgAutonCoralL1") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "maxAutonCoralL1") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "avgAutonCoralL2") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "maxAutonCoralL2") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "avgAutonCoralL3") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "maxAutonCoralL3") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "avgAutonCoralL4") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "maxAutonCoralL4") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "avgAutonAlgae") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "maxAutonAlgae") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "avgAutonAlgaeNet") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "maxAutonAlgaeNet") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "avgAutonAlgaeProc") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "maxAutonAlgaeProc") + "</td>";

      rowString += tdPrefix + getDataValue(avgData[teamNum], "teleopCoralScoringPercent") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "avgTeleopCoralScored") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "maxTeleopCoralScored") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "avgTeleopCoralL1") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "maxTeleopCoralL1") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "avgTeleopCoralL2") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "maxTeleopCoralL2") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "avgTeleopCoralL3") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "maxTeleopCoralL3") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "avgTeleopCoralL4") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "maxTeleopCoralL4") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "teleopAlgaeScoringPercent") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "avgTeleopAlgaeScored") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "maxTeleopAlgaeScored") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "avgTeleopAlgaeNet") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "maxTeleopAlgaeNet") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "avgTeleopAlgaeProc") + "</td>";
      rowString += tdPrefix + getDataValue(avgData[teamNum], "maxTeleopAlgaeProc") + "</td>";

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
    csvLine += lookupAverage(evtAvgs, team, "avgTotalCoral") + ",";
    csvLine += lookupAverage(evtAvgs, team, "maxTotalCoral") + ",";
    csvLine += lookupAverage(evtAvgs, team, "avgTotalAlgae") + ",";
    csvLine += lookupAverage(evtAvgs, team, "maxTotalAlgae") + ",";
    csvLine += lookupAverage(evtAvgs, team, "avgTotalAutoPoints") + ",";
    csvLine += lookupAverage(evtAvgs, team, "maxTotalAutoPoints") + ",";
    csvLine += lookupAverage(evtAvgs, team, "avgTotalTeleopPoints") + ",";
    csvLine += lookupAverage(evtAvgs, team, "maxTotalTeleopPoints") + ",";
    csvLine += lookupAverage(evtAvgs, team, "avgEndgamePoints") + ",";
    csvLine += lookupAverage(evtAvgs, team, "maxEndgamePoints") + ",";
    csvLine += lookupAverage(evtAvgs, team, "avgTotalPoints") + ",";
    csvLine += lookupAverage(evtAvgs, team, "maxTotalPoints") + ",";
    csvLine += lookupAverage(evtAvgs, team, "avgAutonCoral") + ",";
    csvLine += lookupAverage(evtAvgs, team, "maxAutonCoral") + ",";
    csvLine += lookupAverage(evtAvgs, team, "avgAutonCoralL1") + ",";
    csvLine += lookupAverage(evtAvgs, team, "maxAutonCoralL1") + ",";
    csvLine += lookupAverage(evtAvgs, team, "avgAutonCoralL2") + ",";
    csvLine += lookupAverage(evtAvgs, team, "maxAutonCoralL2") + ",";
    csvLine += lookupAverage(evtAvgs, team, "avgAutonCoralL3") + ",";
    csvLine += lookupAverage(evtAvgs, team, "maxAutonCoralL3") + ",";
    csvLine += lookupAverage(evtAvgs, team, "avgAutonCoralL4") + ",";
    csvLine += lookupAverage(evtAvgs, team, "maxAutonCoralL4") + ",";
    csvLine += lookupAverage(evtAvgs, team, "avgAutonAlgae") + ",";
    csvLine += lookupAverage(evtAvgs, team, "maxAutonAlgae") + ",";
    csvLine += lookupAverage(evtAvgs, team, "avgAutonAlgaeNet") + ",";
    csvLine += lookupAverage(evtAvgs, team, "maxAutonAlgaeNet") + ",";
    csvLine += lookupAverage(evtAvgs, team, "avgAutonAlgaeProc") + ",";
    csvLine += lookupAverage(evtAvgs, team, "maxAutonAlgaeProc") + ",";
    csvLine += lookupAverage(evtAvgs, team, "avgTeleopCoralScored") + ",";
    csvLine += lookupAverage(evtAvgs, team, "maxTeleopCoralScored") + ",";
    csvLine += lookupAverage(evtAvgs, team, "avgTeleopCoralL1") + ",";
    csvLine += lookupAverage(evtAvgs, team, "maxTeleopCoralL1") + ",";
    csvLine += lookupAverage(evtAvgs, team, "avgTeleopCoralL2") + ",";
    csvLine += lookupAverage(evtAvgs, team, "maxTeleopCoralL2") + ",";
    csvLine += lookupAverage(evtAvgs, team, "avgTeleopCoralL3") + ",";
    csvLine += lookupAverage(evtAvgs, team, "maxTeleopCoralL3") + ",";
    csvLine += lookupAverage(evtAvgs, team, "avgTeleopCoralL4") + ",";
    csvLine += lookupAverage(evtAvgs, team, "maxTeleopCoralL4") + ",";
    csvLine += lookupAverage(evtAvgs, team, "teleopCoralScoringPercent") + ",";
    csvLine += lookupAverage(evtAvgs, team, "avgTeleopAlgaeScored") + ",";
    csvLine += lookupAverage(evtAvgs, team, "maxTeleopAlgaeScored") + ",";
    csvLine += lookupAverage(evtAvgs, team, "avgTeleopAlgaeNet") + ",";
    csvLine += lookupAverage(evtAvgs, team, "maxTeleopAlgaeNet") + ",";
    csvLine += lookupAverage(evtAvgs, team, "avgTeleopAlgaeProc") + ",";
    csvLine += lookupAverage(evtAvgs, team, "maxTeleopAlgaeProc") + ",";
    csvLine += lookupAverage(evtAvgs, team, "teleopAlgaeScoringPercent") + ",";
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
    let csvStr = "Team,Pit Location,OPR,Total Coral Avg,Total Coral Max,Total Algae Avg,Total Algae Max,Auto Pts Avg,Auto Pts Max,Tel Pts Avg,Tel Pts Max,End Pts Avg,End Pts Max,Total Pts Avg,Total Pts Max,Auto Coral Avg,Auto Coral Max,Auto L1 Avg,Auto L1 Max,Auto L2 Avg,Auto L2 Max,Auto L3 Avg,Auto L3 Max,Auto L4 Avg,Auto L4 Max,Auto Algae Avg,Auto Algae Max,Auto Net Avg,Auto Net Max,Auto Proc Avg,Auto Proc Max,Tel Coral Avg,Tel Coral Max,Tel L1 Avg,Tel L1 Max,Tel L2 Avg,Tel L2 Max,Tel L3 Avg,Tel L3 Max,Tel L4 Avg,Tel L4 Max,Tel Coral Acc,Tel Algae Avg,Tel Algae Max,Tel Net Avg,Tel Net Max,Tel Proc Avg,Tel Proc Max,Tel Algae Acc,End N/A,End Park,End Fall,End Shal,End Deep, Total Died, Note\n";

    let mdp = new matchDataProcessor(matchData);
    mdp.getSiteFilteredAverages(function (filteredMatchData, filteredAvgData) {
      for (let key in filteredAvgData) {
        csvStr += createCSVLine(key, filteredAvgData, coprs);  // key is team number
      }

      let hiddenElement = document.createElement('a');
      let filename = csvName.trim() + ".csv";
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
