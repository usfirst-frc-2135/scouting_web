<?php
$title = 'Match Averages';
require 'header.php';
?>

<div class="container row-offcanvas row-offcanvas-left">
  <div class="column card-lg-12 col-sm-12 col-xs-12" id="content">

    <!-- Page Title -->
    <div class="row pt-3 pb-3 mb-3">
      <h2 class="col-4"><?php echo $title; ?></h2>

      <div class="col-2">
        <button id="download_csv_file" class="btn btn-primary" type="button">Download CSV File</button>
      </div>
    </div>
    <!--  COMMENTED OUT FOR NOW
      <div class="col-md-2">
        <div class="input-group">
          <select id="startPrefix" class="form-select mb-3">
            <option class="dropdown-item" value="p">P</option>
            <option class="dropdown-item" value="qm" selected>Qm</option>
            <option class="dropdown-item" value="qf">Qf</option>
            <option class="dropdown-item" value="sf">Sf</option>
            <option class="dropdown-item" value="f">F</option>
          </select>
          <input id="startMatch" class="form-control" type="text" aria-label="Start Match Filter">
        </div>
      </div>

      <div class="col-md-3">
        <div class="input-group">
          <select id="endPrefix class="form-select mb-3"">
            <option class="dropdown-item" value="p">P</option>
            <option class="dropdown-item" value="qm" selected>Qm</option>
            <option class="dropdown-item" value="qf">Qf</option>
            <option class="dropdown-item" value="sf">Sf</option>
            <option class="dropdown-item" value="f">F</option>
          </select>
          <input id="endMatch" class="form-control" type="text" aria-label="End Match Filter">
          <button id="filterData" class="btn btn-primary" type="button">Filter Data</button>
        </div>
      </div>
COMMENTED OUT FOR NOW-->

    <!-- Main row to hold the table -->
    <div class="row mb-3">

      <!-- <div id="freeze-table" class="freeze-table overflow-auto"> -->
      <style type="text/css" media="screen">
        table tr {
          border: 1px solid black;
        }

        table td,
        table th {
          border-right: 1px solid black;
        }

        thead {
          position: sticky;
          top: 56px;
          background: white;
        }
      </style>

      <table id="averageTable" class="table table-striped table-bordered table-hover sortable" style="width:100%">
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
          <col span="2" style="background-color:#B5D3FF">
          <col span="2" style="background-color:transparent">
          <col span="2" style="background-color:#B5D3FF">
          <col span="2" style="background-color:transparent">
          <col span="2" style="background-color:#B5D3FF">
          <col span="2" style="background-color:#transparent">
          <col span="2" style="background-color:cfe2ff">
          <col span="2" style="background-color:#transparent">
          <col span="3" style="background-color:#b5d3ff">
          <col span="2" style="background-color:transparent">
          <col span="2" style="background-color:#b5d3ff">
          <col span="2" style="background-color:transparent">
          <col span="2" style="background-color:#b5d3ff">
          <col span="3" style="background-color:transparent">
          <col span="2" style="background-color:#cfe2ff">
          <col span="2" style="background-color:transparent">
          <col span="1" style="background-color:#B5D3FF">
          <col span="1" style="background-color:transparent">
          <col span="1" style="background-color:#B5D3FF">
          <col span="1" style="background-color:transparent">
          <col span="1" style="background-color:#B5D3FF">
          <col span="1" style="background-color:transparent">
        </colgroup>
        <thead>
          <!-- <tr>
              <th colspan="1" class="text-center"></th>
              <th colspan="63" class="text-center fw-bold" style="background-color:#e8f1ff">Match Averages</th>
            </tr>
            <tr>
              <th colspan="1" class="text-center"></th>
              <th colspan="63" class="text-center fw-bold" style="background-color:#e8f1ff">Table</th>
            </tr> -->
          <tr>
            <th colspan="1" class="text-center"></th>
            <th colspan="20" class="text-center fw-bold" style="background-color:#e8f1ff"></th>
            <th colspan="16" class="text-center fw-bold" style="background-color:#83B4FF">Auton Game Pieces</th>
            <th colspan="18" class="text-center fw-bold" style="background-color:#cfe2ff">Teleop Game Pieces</th>
            <th colspan="6" class="text-center fw-bold" style="background-color:#e8f1ff"></th>
          </tr>
          <tr>
            <th colspan="1" class="text-center"></th>
            <th colspan="6" class="text-center fw-bold" style="background-color:#83B4FF">Totals</th>
            <th colspan="6" class="text-center">Auton</th>
            <th colspan="6" class="text-center fw-bold" style="background-color:#83B4FF">Teleop</th>
            <th colspan="2" class="text-center">Endgame</th>
            <th colspan="10" class="text-center fw-bold" style="background-color:#3686FF">Coral</th>
            <th colspan="6" class="text-center">Algae</th>
            <th colspan="11" class="text-center fw-bold" style="background-color:#3686FF">Coral</th>
            <th colspan="7" class="text-center">Algae</th>
            <th colspan="5" class="text-center fw-bold" style="background-color:#3686FF">Endgame</th>
            <th colspan="1" class="text-center"></th>
          </tr>
          <tr>
            <th colspan="1" class="text-center"></th>
            <th colspan="2" class="text-center fw-bold" style="background-color:#3686FF">Points</th>
            <th colspan="2" class="text-center fw-bold">Coral</th>
            <th colspan="2" class="text-center fw-bold" style="background-color:#3686FF">Algae</th>
            <th colspan="2" class="text-center">Points</th>
            <th colspan="2" class="text-center" style="background-color:#3686FF">Coral Pts</th>
            <th colspan="2" class="text-center">Algae Pts</th>
            <th colspan="2" class="text-center" style="background-color:#3686FF">Points</th>
            <th colspan="2" class="text-center">Coral Pts</th>
            <th colspan="2" class="text-center" style="background-color:#3686FF">Algae Pts</th>
            <th colspan="2" class="text-center">Points</th>
            <th colspan="2" class="text-center">Total</th>
            <th colspan="2" class="text-center">L1</th>
            <th colspan="2" class="text-center">L2</th>
            <th colspan="2" class="text-center">L3</th>
            <th colspan="2" class="text-center">L4</th>
            <th colspan="2" class="text-center">Total</th>
            <th colspan="2" class="text-center">Net</th>
            <th colspan="2" class="text-center">Proc</th>
            <th colspan="3" class="text-center">Total</th>
            <th colspan="2" class="text-center">L1</th>
            <th colspan="2" class="text-center">L2</th>
            <th colspan="2" class="text-center">L3</th>
            <th colspan="2" class="text-center">L4</th>
            <th colspan="3" class="text-center">Total</th>
            <th colspan="2" class="text-center">Net</th>
            <th colspan="2" class="text-center">Proc</th>
            <th colspan="5" class="text-center fw-bold" style="background-color:#3686FF">Climb%</th>
            <th colspan="1" class="text-center">Died</th>
          </tr>
          <tr>
            <th scope="col">Team</th>
            <th scope="col">Avg</th>
            <th scope="col">Max</th>
            <th scope="col">Avg</th>
            <th scope="col">Max</th>
            <th scope="col">Avg</th>
            <th scope="col">Max</th>
            <th scope="col">Avg</th>
            <th scope="col">Max</th>
            <th scope="col">Avg</th>
            <th scope="col">Max</th>
            <th scope="col">Avg</th>
            <th scope="col">Max</th>
            <th scope="col">Avg</th>
            <th scope="col">Max</th>
            <th scope="col">Avg</th>
            <th scope="col">Max</th>
            <th scope="col">Avg</th>
            <th scope="col">Max</th>
            <th scope="col">Avg</th>
            <th scope="col">Max</th>
            <th scope="col">Avg</th>
            <th scope="col">Max</th>
            <th scope="col">Avg</th>
            <th scope="col">Max</th>
            <th scope="col">Avg</th>
            <th scope="col">Max</th>
            <th scope="col">Avg</th>
            <th scope="col">Max</th>
            <th scope="col">Avg</th>
            <th scope="col">Max</th>
            <th scope="col">Avg</th>
            <th scope="col">Max</th>
            <th scope="col">Avg</th>
            <th scope="col">Max</th>
            <th scope="col">Avg</th>
            <th scope="col">Max</th>
            <th scope="col">Acc%</th>
            <th scope="col">Avg</th>
            <th scope="col">Max</th>
            <th scope="col">Avg</th>
            <th scope="col">Max</th>
            <th scope="col">Avg</th>
            <th scope="col">Max</th>
            <th scope="col">Avg</th>
            <th scope="col">Max</th>
            <th scope="col">Avg</th>
            <th scope="col">Max</th>
            <th scope="col">Acc%</th>
            <th scope="col">Avg</th>
            <th scope="col">Max</th>
            <th scope="col">Avg</th>
            <th scope="col">Max</th>
            <th scope="col">Avg</th>
            <th scope="col">Max</th>

            <th class="text-center" scope="col">N</th>
            <th class="text-center" scope="col">P</th>
            <th class="text-center" scope="col">F</th>
            <th class="text-center" scope="col">S</th>
            <th class="text-center" scope="col">D</th>
            <th class="text-center" scope="col">#</th>
          </tr>

        </thead>
        <tbody id="tableData">
        </tbody>
      </table>
      <!-- </div> -->
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>

<!-- Javascript page handlers -->

<script type="text/javascript" src="./scripts/matchDataProcessor.js"></script>

<script>
  // var tbaData = {};
  var finalList = new Set();
  var filteredData = {};
  var allJsonData = null;
  var frozenTable = null;

  function getDataValue(dict, key) {
    /* If key doesn't exist in given dict, return a 0. */
    // console.log(dict);
    if (!dict) {
      return 0;
    }
    if (key in dict) {
      return dict[key];
    }
    return 0;
  }

  function addHtmlToFinalTable() {
    /* Write data to table */
    $("#tableData").html(""); // Clear Table
    for (let teamNum of finalList) {
      var endgameClimbPercentage = getDataValue(filteredData[teamNum], "endgameClimbPercent");
      var endgameFoulPercentage = getDataValue(filteredData[teamNum], "endgameFoulPercent");

      var rowString = "<tr>" +
        "<td align=\"center\"><a href='teamLookup.php?teamNum=" + teamNum + "'>" + teamNum + "</a></td>" +
        //"<td>" + getDataValue(tbaData[teamNum], "totalPoints") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "avgTotalPoints") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "maxTotalPoints") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "avgTotalCoral") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "maxTotalCoral") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "avgTotalAlgae") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "maxTotalAlgae") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "avgTotalAutoPoints") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "maxTotalAutoPoints") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "avgTotalAutoCoralPoints") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "maxTotalAutoCoralPoints") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "avgTotalAutoAlgaePoints") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "maxTotalAutoAlgaePoints") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "avgTotalTeleopPoints") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "maxTotalTeleopPoints") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "avgTotalTeleopCoralPoints") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "maxTotalTeleopCoralPoints") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "avgTotalTeleopAlgaePoints") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "maxTotalTeleopAlgaePoints") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "avgEndgamePoints") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "maxEndgamePoints") + "</td>" +

        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "avgAutonCoral") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "maxAutonCoral") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "avgAutonCoralL1") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "maxAutonCoralL1") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "avgAutonCoralL2") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "maxAutonCoralL2") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "avgAutonCoralL3") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "maxAutonCoralL3") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "avgAutonCoralL4") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "maxAutonCoralL4") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "avgAutonAlgae") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "maxAutonAlgae") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "avgAutonAlgaeNet") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "maxAutonAlgaeNet") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "avgAutonAlgaeProc") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "maxAutonAlgaeProc") + "</td>" +

        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "teleopCoralScoringPercent") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "avgTeleopCoralScored") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "maxTeleopCoralScored") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "avgTeleopCoralL1") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "maxTeleopCoralL1") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "avgTeleopCoralL2") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "maxTeleopCoralL2") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "avgTeleopCoralL3") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "maxTeleopCoralL3") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "avgTeleopCoralL4") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "maxTeleopCoralL4") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "teleopAlgaeScoringPercent") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "avgTeleopAlgaeScored") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "maxTeleopAlgaeScored") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "avgTeleopAlgaeNet") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "maxTeleopAlgaeNet") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "avgTeleopAlgaeProc") + "</td>" +
        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "maxTeleopAlgaeProc") + "</td>" +

        "<td align=\"center\">" + getDataValue(endgameClimbPercentage, 0) + "</td>" +
        "<td align=\"center\">" + getDataValue(endgameClimbPercentage, 1) + "</td>" +
        "<td align=\"center\">" + getDataValue(endgameClimbPercentage, 2) + "</td>" +
        "<td align=\"center\">" + getDataValue(endgameClimbPercentage, 3) + "</td>" +
        "<td align=\"center\">" + getDataValue(endgameClimbPercentage, 4) + "</td>" +

        "<td align=\"center\">" + getDataValue(filteredData[teamNum], "totaldied") + "</td>" +
        "</td>";

      $("#tableData").append(rowString);
    }
  }

  function addKeysToFinalList(data) {
    // Build a team list from either our data or TBA data
    for (var key in data) {
      finalList.add(key);
    }
  }

  function requestAPI() {
    // Gets SQL data from our local scouting data
    $.get("api/readAPI.php", {
      getAllData: 1
    }).done(function (readData) {
      jsonData = JSON.parse(readData);
      allJsonData = jsonData;
      var mdp = new matchDataProcessor(jsonData);
      // mdp.removePracticeMatches();
      mdp.getSiteFilteredAverages(function (averageData) {
        filteredData = {
          ...averageData
        };
        //console.log(filteredData);
        addKeysToFinalList(filteredData);
        addHtmlToFinalTable();
        setTimeout(function () {
          sorttable.makeSortable(document.getElementById("averageTable"))
          frozenTable = $('#freeze-table').freezeTable({
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
      });
    });
  }

  function filterAndShow() {
    var start = $("#startPrefix").val() + $("#startMatch").val();
    var end = $("#endPrefix").val() + $("#endMatch").val();
    var mdp = new matchDataProcessor(allJsonData);
    mdp.filterMatches(start, end);
    filteredData = mdp.getAverages();
    addKeysToFinalList(filteredData);
    addHtmlToFinalTable();
    setTimeout(function () {
      sorttable.makeSortable(document.getElementById("averageTable"))
      frozenTable = $('#freeze-table').freezeTable({
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
  }

  // CSV File functions

  var eventCode = null;
  var oprData = {};          // for TBA OPR data

  function localAveragesLookup(localAverages, team, item) {
    if (!localAverages) {
      return "NA";
    }
    if (!(team in localAverages)) {
      return "NA";
    }
    return localAverages[team][item];
  }

  function rnd(val) {
    // Rounding helper function 
    return Math.round((val + Number.EPSILON) * 100) / 100;
  }

  function getOprTotalPoints(dict) {
    if (!dict) {
      return 0;
    }
    if ("totalPoints" in dict) {
      return dict["totalPoints"];
    }
    return 0;
  }

  function getEndGameClimb(dict, key) {
    /* If key doesn't exist in given dict, return a 0. */
    // console.log(dict);
    if (!dict) {
      return 0;
    }
    if (key in dict) {
      return dict[key];
    }
    return 0;
  }

  // Returns a string with the comma-separated line of data for the given team.
  function createCSVLine(localAverages, team) {
    var oprTP = 0;
    var pitLocation = 0;
    oprTP = getOprTotalPoints(oprData[team]);
    //var trapPercent = rnd(localAveragesLookup(localAverages,team, "trapPercentage"));
    var teleopCoralScoringAcc = rnd(localAveragesLookup(localAverages, team, "teleopCoralScoringPercent"));
    var teleopAlgaeScoringAcc = rnd(localAveragesLookup(localAverages, team, "teleopAlgaeScoringPercent"));
    var endgameClimbPercent = localAveragesLookup(localAverages, team, "endgameClimbPercent");
    //var endgameharmonyPercentage = localAveragesLookup(localAverages,team, "endgameharmonypercent");
    var out = team + ",";
    out += pitLocation + ",";
    out += oprTP + ",";
    out += localAveragesLookup(localAverages, team, "avgTotalCoral") + ",";
    out += localAveragesLookup(localAverages, team, "maxTotalCoral") + ",";
    out += localAveragesLookup(localAverages, team, "avgTotalAlgae") + ",";
    out += localAveragesLookup(localAverages, team, "maxTotalAlgae") + ",";
    out += localAveragesLookup(localAverages, team, "avgTotalAutoPoints") + ",";
    out += localAveragesLookup(localAverages, team, "maxTotalAutoPoints") + ",";
    out += localAveragesLookup(localAverages, team, "avgTotalTeleopPoints") + ",";
    out += localAveragesLookup(localAverages, team, "maxTotalTeleopPoints") + ",";
    out += localAveragesLookup(localAverages, team, "avgEndgamePoints") + ",";
    out += localAveragesLookup(localAverages, team, "maxEndgamePoints") + ",";
    out += localAveragesLookup(localAverages, team, "avgTotalPoints") + ",";
    out += localAveragesLookup(localAverages, team, "maxTotalPoints") + ",";
    out += localAveragesLookup(localAverages, team, "avgAutonCoral") + ",";
    out += localAveragesLookup(localAverages, team, "maxAutonCoral") + ",";
    out += localAveragesLookup(localAverages, team, "avgAutonCoralL1") + ",";
    out += localAveragesLookup(localAverages, team, "maxAutonCoralL1") + ",";
    out += localAveragesLookup(localAverages, team, "avgAutonCoralL2") + ",";
    out += localAveragesLookup(localAverages, team, "maxAutonCoralL2") + ",";
    out += localAveragesLookup(localAverages, team, "avgAutonCoralL3") + ",";
    out += localAveragesLookup(localAverages, team, "maxAutonCoralL3") + ",";
    out += localAveragesLookup(localAverages, team, "avgAutonCoralL4") + ",";
    out += localAveragesLookup(localAverages, team, "maxAutonCoralL4") + ",";
    out += localAveragesLookup(localAverages, team, "avgAutonAlgae") + ",";
    out += localAveragesLookup(localAverages, team, "maxAutonAlgae") + ",";
    out += localAveragesLookup(localAverages, team, "avgAutonAlgaeNet") + ",";
    out += localAveragesLookup(localAverages, team, "maxAutonAlgaeNet") + ",";
    out += localAveragesLookup(localAverages, team, "avgAutonAlgaeProc") + ",";
    out += localAveragesLookup(localAverages, team, "maxAutonAlgaeProc") + ",";
    out += localAveragesLookup(localAverages, team, "avgTeleopCoralScored") + ",";
    out += localAveragesLookup(localAverages, team, "maxTeleopCoralScored") + ",";
    out += localAveragesLookup(localAverages, team, "avgTeleopCoralL1") + ",";
    out += localAveragesLookup(localAverages, team, "maxTeleopCoralL1") + ",";
    out += localAveragesLookup(localAverages, team, "avgTeleopCoralL2") + ",";
    out += localAveragesLookup(localAverages, team, "maxTeleopCoralL2") + ",";
    out += localAveragesLookup(localAverages, team, "avgTeleopCoralL3") + ",";
    out += localAveragesLookup(localAverages, team, "maxTeleopCoralL3") + ",";
    out += localAveragesLookup(localAverages, team, "avgTeleopCoralL4") + ",";
    out += localAveragesLookup(localAverages, team, "maxTeleopCoralL4") + ",";
    out += localAveragesLookup(localAverages, team, "teleopCoralScoringPercent") + ",";
    out += localAveragesLookup(localAverages, team, "avgTeleopAlgaeScored") + ",";
    out += localAveragesLookup(localAverages, team, "maxTeleopAlgaeScored") + ",";
    out += localAveragesLookup(localAverages, team, "avgTeleopAlgaeNet") + ",";
    out += localAveragesLookup(localAverages, team, "maxTeleopAlgaeNet") + ",";
    out += localAveragesLookup(localAverages, team, "avgTeleopAlgaeProc") + ",";
    out += localAveragesLookup(localAverages, team, "maxTeleopAlgaeProc") + ",";
    out += localAveragesLookup(localAverages, team, "teleopAlgaeScoringPercent") + ",";
    out += getEndGameClimb(endgameClimbPercent, 0) + ",";
    out += getEndGameClimb(endgameClimbPercent, 1) + ",";
    out += getEndGameClimb(endgameClimbPercent, 2) + ",";
    out += getEndGameClimb(endgameClimbPercent, 3) + ",";
    out += getEndGameClimb(endgameClimbPercent, 4) + ",";
    out += localAveragesLookup(localAverages, team, "totaldied") + ",";
    out += "-\n";    // NOTE
    return out;
  }

  function processData(matchData) {
    console.log("setting up mdp ");
    var mdp = new matchDataProcessor(matchData);
    var csvStr = "Team,Pit Location,OPR,Total Coral Avg,Total Coral Max,Total Algae Avg,Total Algae Max,Auto Pts Avg,Auto Pts Max,Tel Pts Avg,Tel Pts Max,End Pts Avg,End Pts Max,Total Pts Avg,Total Pts Max,Auto Coral Avg,Auto Coral Max,Auto L1 Avg,Auto L1 Max,Auto L2 Avg,Auto L2 Max,Auto L3 Avg,Auto L3 Max,Auto L4 Avg,Auto L4 Max,Auto Algae Avg,Auto Algae Max,Auto Net Avg,Auto Net Max,Auto Proc Avg,Auto Proc Max,Tel Coral Avg,Tel Coral Max,Tel L1 Avg,Tel L1 Max,Tel L2 Avg,Tel L2 Max,Tel L3 Avg,Tel L3 Max,Tel L4 Avg,Tel L4 Max,Tel Coral Acc,Tel Algae Avg,Tel Algae Max,Tel Net Avg,Tel Net Max,Tel Proc Avg,Tel Proc Max,Tel Algae Acc,End N/A,End Park,End Fall,End Shal,End Deep, Total Died, Note\n";
    mdp.getSiteFilteredAverages(function (averageData) {
      console.log("writing csv lines");
      for (var key in averageData) {
        csvStr += createCSVLine(averageData, key);  // key is team number
      }

      var hiddenElement = document.createElement('a');
      var filename = eventCode + ".csv";
      console.log("CSV filename = " + filename);
      hiddenElement.href = 'data:text/csv;charset=utf-8,' + encodeURI(csvStr);
      hiddenElement.target = '_blank';
      hiddenElement.download = filename;
      hiddenElement.click();
    });
  }

  function writeCSVFile() {
    console.log("starting writeCSVFile()");

    console.log("getting raw data");
    $.get("api/readAPI.php", {
      getAllData: 1
    }).done(function (data) {
      matchData = JSON.parse(data);

      // Get OPR data 
      console.log("getting OPR data");
      $.get("api/tbaAPI.php", {
        getCOPRs: 1
      }).done(function (data) {
        data = JSON.parse(data)["data"];
        oprData = data;
        console.log("--> setting oprData");
        processData(matchData);
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
    }, function (data) {
      $("#navbarEventCode").html(data);
    });

    requestAPI(); // Retrieve all data

    $.get("api/tbaAPI.php", {
      getEventCode: true
    }, function (data) {
      eventCode = data;
    });

    // Filter out unwanted matches
    $("#filterData").click(function () {
      filterAndShow();  // Select desired data
    });

    // Keep the frozen pane updated 
    $("#averageTable").click(function () {
      frozenTable.update(); // Update frozen panes
    });

    $("#download_csv_file").on('click', function (event) {
      // Write out picklist CSV file to client's download dir.
      writeCSVFile();
    });
  });

</script>
