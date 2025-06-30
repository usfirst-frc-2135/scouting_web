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
              <th colspan="2" style="background-color:transparent">Coral</th>
              <th colspan="2" style="background-color:#83b4ff">Algae</th>
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

  let _jsonMatchData = null;
  // let _frozenTable = null;

  // Round to 2 decimal places
  function rnd(val) {
    // Rounding helper function 
    return Math.round((val + Number.EPSILON) * 100) / 100;
  }

  // Lookup value for a key in the passed dictionary (team in match data)
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

      let rowString =
        "<td style=\"background-color:transparent\"><a href='teamLookup.php?teamNum=" + teamNum + "'>" + teamNum + "</a></td>" +
        //"<td>" + getDataValue(tbaData[teamNum], "totalPoints") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "avgTotalPoints") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "maxTotalPoints") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "avgTotalCoral") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "maxTotalCoral") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "avgTotalAlgae") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "maxTotalAlgae") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "avgTotalAutoPoints") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "maxTotalAutoPoints") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "avgTotalAutoCoralPoints") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "maxTotalAutoCoralPoints") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "avgTotalAutoAlgaePoints") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "maxTotalAutoAlgaePoints") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "avgTotalTeleopPoints") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "maxTotalTeleopPoints") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "avgTotalTeleopCoralPoints") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "maxTotalTeleopCoralPoints") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "avgTotalTeleopAlgaePoints") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "maxTotalTeleopAlgaePoints") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "avgEndgamePoints") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "maxEndgamePoints") + "</td>" +

        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "avgAutonCoral") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "maxAutonCoral") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "avgAutonCoralL1") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "maxAutonCoralL1") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "avgAutonCoralL2") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "maxAutonCoralL2") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "avgAutonCoralL3") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "maxAutonCoralL3") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "avgAutonCoralL4") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "maxAutonCoralL4") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "avgAutonAlgae") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "maxAutonAlgae") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "avgAutonAlgaeNet") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "maxAutonAlgaeNet") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "avgAutonAlgaeProc") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "maxAutonAlgaeProc") + "</td>" +

        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "teleopCoralScoringPercent") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "avgTeleopCoralScored") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "maxTeleopCoralScored") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "avgTeleopCoralL1") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "maxTeleopCoralL1") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "avgTeleopCoralL2") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "maxTeleopCoralL2") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "avgTeleopCoralL3") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "maxTeleopCoralL3") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "avgTeleopCoralL4") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "maxTeleopCoralL4") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "teleopAlgaeScoringPercent") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "avgTeleopAlgaeScored") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "maxTeleopAlgaeScored") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "avgTeleopAlgaeNet") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "maxTeleopAlgaeNet") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "avgTeleopAlgaeProc") + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "maxTeleopAlgaeProc") + "</td>" +

        "<td style=\"background-color:transparent\">" + getDataValue(endgameClimbPercentage, 0) + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(endgameClimbPercentage, 1) + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(endgameClimbPercentage, 2) + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(endgameClimbPercentage, 3) + "</td>" +
        "<td style=\"background-color:transparent\">" + getDataValue(endgameClimbPercentage, 4) + "</td>" +

        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "totaldied") + "</td>";

      tbodyRef.insertRow().innerHTML = rowString;
    }
  }

  // Add a team (key) to the final team list
  function addKeysToMatchTable(dataObj) {
    console.log("==> eventAverages: addKeysToMatchTable()");
    let keyList = [];
    for (let teamNum in dataObj) {
      keyList.push(teamNum);
    }
    return keyList;
  }

  // Update table when match filters are changed
  function filterEventMatchData() {
    console.log("==> eventAverages: filterEventMatchData()");
    let startMatch = document.getElementById("startCompLevel").value + document.getElementById("startMatchNum").value;
    let endMatch = document.getElementById("endCompLevel").value + document.getElementById("endMatchNum").value;
    console.log("eventAverages: filterEventMatches: " + startMatch + " to " + endMatch);
    let mdp = new matchDataProcessor(_jsonMatchData);
    mdp.filterEventMatches(startMatch, endMatch);
    let filteredData = mdp.getAverages();
    let teamList = addKeysToMatchTable(filteredData);
    addAveragesToTable(teamList, filteredData);
  }

  // CSV File functions

  // Retrieve an average value from data for a team
  function lookupAverage(teamAverages, team, item) {
    // console.log("==> eventAverages: lookupAverage()");
    if (!teamAverages) {
      console.warn("lookupAverages: No team averages!")
      return "NA";
    }
    if (!(team in teamAverages)) {
      console.warn("lookupAverages: Team not in list!")
      return "NA";
    }
    return teamAverages[team][item];
  }

  // Returns a string with the comma-separated line of data for the given team.
  function createCSVLine(team, evtAvgs, coprs) {
    let pitLocation = 0;
    let oprTP = getDataValue(coprs[team], "totalPoints");
    //let trapPercent = rnd(lookupAverage(evtAvgs,team, "trapPercentage"));
    let teleopCoralScoringAcc = rnd(lookupAverage(evtAvgs, team, "teleopCoralScoringPercent"));
    let teleopAlgaeScoringAcc = rnd(lookupAverage(evtAvgs, team, "teleopAlgaeScoringPercent"));
    let endgameClimbPercent = lookupAverage(evtAvgs, team, "endgameClimbPercent");
    //let endgameharmonyPercentage = lookupAverage(evtAvgs,team, "endgameharmonypercent");
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
  function createCSVFile(eventCode, eventMatches, coprs) {
    console.log("==> eventAverages: createCSVFile()");
    let mdp = new matchDataProcessor(eventMatches);
    let csvStr = "Team,Pit Location,OPR,Total Coral Avg,Total Coral Max,Total Algae Avg,Total Algae Max,Auto Pts Avg,Auto Pts Max,Tel Pts Avg,Tel Pts Max,End Pts Avg,End Pts Max,Total Pts Avg,Total Pts Max,Auto Coral Avg,Auto Coral Max,Auto L1 Avg,Auto L1 Max,Auto L2 Avg,Auto L2 Max,Auto L3 Avg,Auto L3 Max,Auto L4 Avg,Auto L4 Max,Auto Algae Avg,Auto Algae Max,Auto Net Avg,Auto Net Max,Auto Proc Avg,Auto Proc Max,Tel Coral Avg,Tel Coral Max,Tel L1 Avg,Tel L1 Max,Tel L2 Avg,Tel L2 Max,Tel L3 Avg,Tel L3 Max,Tel L4 Avg,Tel L4 Max,Tel Coral Acc,Tel Algae Avg,Tel Algae Max,Tel Net Avg,Tel Net Max,Tel Proc Avg,Tel Proc Max,Tel Algae Acc,End N/A,End Park,End Fall,End Shal,End Deep, Total Died, Note\n";

    mdp.getSiteFilteredAverages(function (averageData) {
      for (let key in averageData) {
        csvStr += createCSVLine(key, averageData, coprs);  // key is team number
      }

      let hiddenElement = document.createElement('a');
      let filename = eventCode.trim() + ".csv";
      console.log("eventAverages: createCSVFile() CSV filename: " + filename);
      hiddenElement.href = 'data:text/csv;charset=utf-8,' + encodeURI(csvStr);
      hiddenElement.target = '_blank';
      hiddenElement.download = filename;
      hiddenElement.click();
    });
  }

  // Get all match data, filter it, create final HTML table, and sort it
  function buildAveragesTable(tableId) {
    console.log("==> eventAverages: buildAveragesTable()");
    $.get("api/dbReadAPI.php", {
      getEventMatches: 1
    }).done(function (eventMatches) {
      console.log("=> getEventMatches:");
      _jsonMatchData = JSON.parse(eventMatches);
      let mdp = new matchDataProcessor(_jsonMatchData);
      mdp.getSiteFilteredAverages(function (averageData) {
        let filteredData = {
          ...averageData
        };
        let teamList = addKeysToMatchTable(filteredData);
        addAveragesToTable(tableId, teamList, filteredData);
        // script instructions say this is needed, but it breaks table header sorting
        // sorttable.makeSortable(document.getElementById(tableId));
        document.getElementById(tableId).click(); // This magic fixes the floating column bug
      });
    });
  }

  // Retrieve match data and OPRs data and write out CSV file
  function downloadCSVFile(eventCode) {
    console.log("==> eventAverages: downloadCSVFile()");
    $.get("api/dbReadAPI.php", {
      getEventMatches: 1
    }).done(function (eventMatches) {
      console.log("=> getEventMatches:");
      let jsonEventMatches = JSON.parse(eventMatches);

      // Get OPR data from TBA
      $.get("api/tbaAPI.php", {
        getCOPRs: 1
      }).done(function (getCoprs) {
        console.log("=> getCOPRs");
        let jsonCoprData = JSON.parse(getCoprs)["data"];
        createCSVFile(eventCode, jsonEventMatches, jsonCoprData);
      });
    });
  }

  /////////////////////////////////////////////////////////////////////////////
  //
  // Process the generated html
  //
  document.addEventListener("DOMContentLoaded", () => {

    let tableId = "averagesTable";
    let tbaEventCode;

    // Update the navbar with the event code
    $.get("api/tbaAPI.php", {
      getEventCode: true
    }, function (eventCode) {
      eventCode = eventCode.trim();
      console.log("=> eventAverages.php: getEventCode: " + eventCode);
      document.getElementById("navbarEventCode").innerText = eventCode;
      tbaEventCode = eventCode;
    });

    buildAveragesTable(tableId); // Retrieve all data

    // Filter out unwanted matches
    document.getElementById("filterData").addEventListener('click', function () {
      filterEventMatchData();
    });

    // Create frozen table panes and keep the panes updated
    let frozenTable = new FreezeTable('.freeze-table', { fixedNavbar: '.navbar' });
    document.getElementById(tableId).addEventListener('click', function () {
      if (frozenTable) {
        frozenTable.update();
      }
    });

    // Write out picklist CSV file to client's download dir.
    document.getElementById("downloadCsvFile").addEventListener('click', function () {
      downloadCSVFile(tbaEventCode);
    });
  });

</script>

<script src="./scripts/matchDataProcessor.js"></script>
