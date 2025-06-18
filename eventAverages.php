<?php
$title = 'Event Averages';
require 'inc/header.php';
?>

<div class="container row-offcanvas row-offcanvas-left">
  <div class="column card-lg-12 col-sm-12 col-xs-12" id="content">

    <!-- Page Title -->
    <div class="row pt-3 pb-3 mb-3">
      <h2 class="col-md-3"><?php echo $title; ?></h2>

      <div class="col-md-3">
        <button id="downloadCsvFile" class="btn btn-primary" type="button">Download CSV</button>
      </div>
    </div>

    <!--  COMMENTED OUT FOR NOW -->
    <!-- Match Filter -->
    <div class="card col-md-3 mb-3">
      <div id="customMatch" class="accordion accordion-flush">
        <div class="accordion-item" style="background-color: #F8F9FA">
          <h2 class="accordion-header">
            <button class="accordion-button text-light bg-secondary" type="button" data-bs-toggle="collapse"
              data-bs-target="#filterEntry" aria-expanded="false" aria-controls="matchEntry">Match Range Filter</button>
          </h2>

          <div id="filterEntry" class="accordion-collapse collapse" data-bs-parent="#customMatch">

            <div class="input-group">
              <div class="input-group-prepend">
                <select id="startPrefix" class="form-select mb-3" aria-label="Comp Level Select">
                  <option value="p">P</option>
                  <option value="qm" selected>QM</option>
                  <option value="qf">QF</option>
                  <option value="sf">SF</option>
                  <option value="f">F</option>
                </select>
              </div>
              <input id="startMatch" class="form-control col-2 mb-3" type="text" placeholder="Start"
                aria-label="Start Match Filter">
            </div>

            <div class="input-group">
              <div class="input-group-prepend">
                <select id="endPrefix" class="form-select mb-3" aria-label="Comp Level Select">
                  <option value="p">P</option>
                  <option value="qm" selected>QM</option>
                  <option value="qf">QF</option>
                  <option value="sf">SF</option>
                  <option value="f">F</option>
                </select>
              </div>
              <input id="endMatch" class="form-control col-2 mb-3" type="text" placeholder="End" aria-label="End Match Filter">
            </div>

            <div>
              <button id="filterData" class="btn btn-primary btn-sm mb-3" type="button">Filter Data</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- COMMENTED OUT FOR NOW-->

    <!-- Main row to hold the table -->
    <div class="row mb-3">

      <!-- <div id="freeze-table" class="freeze-table overflow-auto"> -->
      <style type="text/css" media="screen">
        thead {
          position: sticky;
          top: 56px;
          background: white;
        }
      </style>

      <table id="averageTable" class="table table-striped table-bordered table-hover table-sm border-dark text-center sortable">
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
          <!-- <tr>
            <th colspan="1"></th>
            <th colspan="20" style="background-color:#e8f1ff"></th>
            <th colspan="16" style="background-color:#d5e6de">Auton Game Pieces</th>
            <th colspan="18" style="background-color:#d6f3fB">Teleop Game Pieces</th>
            <th colspan="6" style="background-color:#fbe6d3">End Game</th>
          </tr> -->
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
        <tbody id="tableData" class="table-group-divider">
        </tbody>
      </table>
      <!-- </div> -->
    </div>
  </div>
</div>

<?php include 'inc/footer.php'; ?>

<!-- Javascript page handlers -->

<script type="text/javascript" src="./scripts/matchDataProcessor.js"></script>

<script>
  var _jsonMatchData = null;
  // var _frozenTable = null;

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
    return 0;
  }

  // Add a team (key) to the final team list
  function addKeysToTable(dataObj) {
    console.log("==> eventAverages: addKeysToTable()");
    var keyList = new Set();
    for (var teamNum in dataObj) {
      keyList.add(teamNum);
    }
    return keyList;
  }

  // Create and the HTML table for display
  function addAveragesToTable(teamList, avgData) {
    console.log("==> eventAverages: addAveragesToTable()");
    $("#tableData").html(""); // Clear Table
    for (let teamNum of teamList) {
      var endgameClimbPercentage = getDataValue(avgData[teamNum], "endgameClimbPercent");
      var endgameFoulPercentage = getDataValue(avgData[teamNum], "endgameFoulPercent");

      var rowString = "<tr>" +
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

        "<td style=\"background-color:transparent\">" + getDataValue(avgData[teamNum], "totaldied") + "</td>" +
        "</td>";

      $("#tableData").append(rowString);
    }
  }

  // Update table when match filters are changed
  function filterEventMatchData() {
    console.log("==> eventAverages: filterEventMatchData()");
    var start = $("#startPrefix").val() + $("#startMatch").val();
    var end = $("#endPrefix").val() + $("#endMatch").val();
    var mdp = new matchDataProcessor(_jsonMatchData);
    mdp.filterEventMatches(start, end);
    var filteredData = mdp.getAverages();
    teamList = addKeysToTable(filteredData);
    addAveragesToTable(teamList, fitleredData);
    setTimeout(function () {
      // sorttable.makeSortable(document.getElementById("averageTable"))
      // _frozenTable = $('#freeze-table').freezeTable({
      //   'freezeHead': true,
      //   'freezeColumn': true,
      //   'freezeColumnHead': true,
      //   'scrollBar': true,
      //   'fixedNavbar': '.navbar',
      //   'scrollable': true,
      //   'fastMode': true,
      //   // 'container': '#navbar',
      //   'columnNum': 1,
      //   'columnKeep': true,
      //   'columnBorderWidth': 2,
      //   'backgroundColor': 'blue',
      //   'frozenColVerticalOffset': 0
      // });
    }, 100);
  }

  // CSV File functions

  // Retrieve an average value from data for a team
  function lookupAverage(teamAverages, team, item) {
    console.log("==> eventAverages: lookupAverage()");
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

  // Round to 2 decimal places
  function rnd(val) {
    // Rounding helper function 
    return Math.round((val + Number.EPSILON) * 100) / 100;
  }

  // Returns a string with the comma-separated line of data for the given team.
  function createCSVLine(team, evtAvgs, coprs) {
    console.log("==> eventAverages: createCSVLine()" + team);  // TODO: team number is a number instead of a string (key)!
    var pitLocation = 0;
    var oprTP = getDataValue(coprs[team], "totalPoints");
    //var trapPercent = rnd(lookupAverage(evtAvgs,team, "trapPercentage"));
    var teleopCoralScoringAcc = rnd(lookupAverage(evtAvgs, team, "teleopCoralScoringPercent"));
    var teleopAlgaeScoringAcc = rnd(lookupAverage(evtAvgs, team, "teleopAlgaeScoringPercent"));
    var endgameClimbPercent = lookupAverage(evtAvgs, team, "endgameClimbPercent");
    //var endgameharmonyPercentage = lookupAverage(evtAvgs,team, "endgameharmonypercent");
    var out = team + ",";
    out += pitLocation + ",";
    out += oprTP + ",";
    out += lookupAverage(evtAvgs, team, "avgTotalCoral") + ",";
    out += lookupAverage(evtAvgs, team, "maxTotalCoral") + ",";
    out += lookupAverage(evtAvgs, team, "avgTotalAlgae") + ",";
    out += lookupAverage(evtAvgs, team, "maxTotalAlgae") + ",";
    out += lookupAverage(evtAvgs, team, "avgTotalAutoPoints") + ",";
    out += lookupAverage(evtAvgs, team, "maxTotalAutoPoints") + ",";
    out += lookupAverage(evtAvgs, team, "avgTotalTeleopPoints") + ",";
    out += lookupAverage(evtAvgs, team, "maxTotalTeleopPoints") + ",";
    out += lookupAverage(evtAvgs, team, "avgEndgamePoints") + ",";
    out += lookupAverage(evtAvgs, team, "maxEndgamePoints") + ",";
    out += lookupAverage(evtAvgs, team, "avgTotalPoints") + ",";
    out += lookupAverage(evtAvgs, team, "maxTotalPoints") + ",";
    out += lookupAverage(evtAvgs, team, "avgAutonCoral") + ",";
    out += lookupAverage(evtAvgs, team, "maxAutonCoral") + ",";
    out += lookupAverage(evtAvgs, team, "avgAutonCoralL1") + ",";
    out += lookupAverage(evtAvgs, team, "maxAutonCoralL1") + ",";
    out += lookupAverage(evtAvgs, team, "avgAutonCoralL2") + ",";
    out += lookupAverage(evtAvgs, team, "maxAutonCoralL2") + ",";
    out += lookupAverage(evtAvgs, team, "avgAutonCoralL3") + ",";
    out += lookupAverage(evtAvgs, team, "maxAutonCoralL3") + ",";
    out += lookupAverage(evtAvgs, team, "avgAutonCoralL4") + ",";
    out += lookupAverage(evtAvgs, team, "maxAutonCoralL4") + ",";
    out += lookupAverage(evtAvgs, team, "avgAutonAlgae") + ",";
    out += lookupAverage(evtAvgs, team, "maxAutonAlgae") + ",";
    out += lookupAverage(evtAvgs, team, "avgAutonAlgaeNet") + ",";
    out += lookupAverage(evtAvgs, team, "maxAutonAlgaeNet") + ",";
    out += lookupAverage(evtAvgs, team, "avgAutonAlgaeProc") + ",";
    out += lookupAverage(evtAvgs, team, "maxAutonAlgaeProc") + ",";
    out += lookupAverage(evtAvgs, team, "avgTeleopCoralScored") + ",";
    out += lookupAverage(evtAvgs, team, "maxTeleopCoralScored") + ",";
    out += lookupAverage(evtAvgs, team, "avgTeleopCoralL1") + ",";
    out += lookupAverage(evtAvgs, team, "maxTeleopCoralL1") + ",";
    out += lookupAverage(evtAvgs, team, "avgTeleopCoralL2") + ",";
    out += lookupAverage(evtAvgs, team, "maxTeleopCoralL2") + ",";
    out += lookupAverage(evtAvgs, team, "avgTeleopCoralL3") + ",";
    out += lookupAverage(evtAvgs, team, "maxTeleopCoralL3") + ",";
    out += lookupAverage(evtAvgs, team, "avgTeleopCoralL4") + ",";
    out += lookupAverage(evtAvgs, team, "maxTeleopCoralL4") + ",";
    out += lookupAverage(evtAvgs, team, "teleopCoralScoringPercent") + ",";
    out += lookupAverage(evtAvgs, team, "avgTeleopAlgaeScored") + ",";
    out += lookupAverage(evtAvgs, team, "maxTeleopAlgaeScored") + ",";
    out += lookupAverage(evtAvgs, team, "avgTeleopAlgaeNet") + ",";
    out += lookupAverage(evtAvgs, team, "maxTeleopAlgaeNet") + ",";
    out += lookupAverage(evtAvgs, team, "avgTeleopAlgaeProc") + ",";
    out += lookupAverage(evtAvgs, team, "maxTeleopAlgaeProc") + ",";
    out += lookupAverage(evtAvgs, team, "teleopAlgaeScoringPercent") + ",";
    out += getDataValue(endgameClimbPercent, 0) + ",";
    out += getDataValue(endgameClimbPercent, 1) + ",";
    out += getDataValue(endgameClimbPercent, 2) + ",";
    out += getDataValue(endgameClimbPercent, 3) + ",";
    out += getDataValue(endgameClimbPercent, 4) + ",";
    out += lookupAverage(evtAvgs, team, "totaldied") + ",";
    out += "-\n";    // NOTE
    return out;
  }

  // 
  function processEventMatches(eventCode, eventMatches, coprs) {
    console.log("==> eventAverages: processEventMatches()");
    var mdp = new matchDataProcessor(eventMatches);
    var csvStr = "Team,Pit Location,OPR,Total Coral Avg,Total Coral Max,Total Algae Avg,Total Algae Max,Auto Pts Avg,Auto Pts Max,Tel Pts Avg,Tel Pts Max,End Pts Avg,End Pts Max,Total Pts Avg,Total Pts Max,Auto Coral Avg,Auto Coral Max,Auto L1 Avg,Auto L1 Max,Auto L2 Avg,Auto L2 Max,Auto L3 Avg,Auto L3 Max,Auto L4 Avg,Auto L4 Max,Auto Algae Avg,Auto Algae Max,Auto Net Avg,Auto Net Max,Auto Proc Avg,Auto Proc Max,Tel Coral Avg,Tel Coral Max,Tel L1 Avg,Tel L1 Max,Tel L2 Avg,Tel L2 Max,Tel L3 Avg,Tel L3 Max,Tel L4 Avg,Tel L4 Max,Tel Coral Acc,Tel Algae Avg,Tel Algae Max,Tel Net Avg,Tel Net Max,Tel Proc Avg,Tel Proc Max,Tel Algae Acc,End N/A,End Park,End Fall,End Shal,End Deep, Total Died, Note\n";

    mdp.getSiteFilteredAverages(function (averageData) {
      for (var key in averageData) {
        console.log("key: " + key);
        csvStr += createCSVLine(key, averageData, coprs);  // key is team number
      }

      var hiddenElement = document.createElement('a');
      var filename = eventCode + ".csv";
      console.log("eventAverages: processEventMatches() CSV filename: " + filename);
      hiddenElement.href = 'data:text/csv;charset=utf-8,' + encodeURI(csvStr);
      hiddenElement.target = '_blank';
      hiddenElement.download = filename;
      hiddenElement.click();
    });
  }

  // Retrieve match data and OPRs data and write out CSV file
  function downloadEventCSVFile(eventCode) {
    console.log("==> eventAverages: downloadEventCSVFile()");
    $.get("api/dbReadAPI.php", {
      getEventMatches: 1
    }).done(function (eventMatches) {
      console.log("=> getEventMatches:");
      allEventMatches = JSON.parse(eventMatches);

      // Get OPR data from TBA
      $.get("api/tbaAPI.php", {
        getCOPRs: 1
      }).done(function (getCoprs) {
        console.log("=> getCOPRs: " + getCoprs);
        jsonCoprData = JSON.parse(getCoprs)["coprData"];
        console.log("COPRS: " + jsonCoprData);
        processEventMatches(eventCode, allEventMatches, jsonCoprData);
      });
    });
  }

  // Get all match data, filter it, create final HTML table, and sort it
  function buildAveragesTable() {
    console.log("==> eventAverages: buildAveragesTable()");
    $.get("api/dbReadAPI.php", {
      getEventMatches: 1
    }).done(function (eventMatches) {
      console.log("=> getEventMatches:");
      _jsonMatchData = JSON.parse(eventMatches);
      var mdp = new matchDataProcessor(_jsonMatchData);
      mdp.getSiteFilteredAverages(function (averageData) {
        var filteredData = {
          ...averageData
        };
        addKeysToTable(filteredData);
        var keyList = new Set();
        for (var teamNum in filteredData) {
          keyList.add(teamNum);
        }
        addAveragesToTable(keyList, filteredData);
        setTimeout(function () {
          // script instructions say this is needed, but it breaks table header sorting
          // sorttable.makeSortable(document.getElementById("averageTable"))
          // _frozenTable = $('#freeze-table').freezeTable({
          //   'freezeHead': true,
          //   'freezeColumn': true,
          //   'freezeColumnHead': true,
          //   'scrollBar': true,
          //   'fixedNavbar': '.navbar',
          //   'scrollable': true,
          //   'fastMode': true,
          //   // 'container': '#navbar',
          //   'columnNum': 1,
          //   'columnKeep': true,
          //   'columnBorderWidth': 2,
          //   'backgroundColor': 'blue',
          //   'frozenColVerticalOffset': 0
          // });
        }, 100);
      });
      return
    });
  }

  //
  // Process the generated html
  //
  $(document).ready(function () {
    var tbaEventCode;

    // Update the navbar with the event code
    $.get("api/tbaAPI.php", {
      getEventCode: true
    }, function (eventCode) {
      console.log("=> eventAverages: getEventCode: " + eventCode.trim());
      $("#navbarEventCode").html(eventCode);
      tbaEventCode = eventCode;
    });

    buildAveragesTable(); // Retrieve all data

    // Filter out unwanted matches
    $("#filterData").click(function () {
      filterEventMatchData();
    });

    // Keep the frozen pane updated 
    // $("#averageTable").click(function () {
    //   _frozenTable.update();
    // });

    // Write out picklist CSV file to client's download dir.
    $("#downloadCsvFile").on('click', function (event) {
      downloadEventCSVFile(tbaEventCode);
    });
  });

</script>
