<?php include 'header.php'; ?>

<!-- this was copy and pasted from rawData.php so the java will need to change -->
<title>Averages</title>

<div class="container row-offcanvas row-offcanvas-left">
  <div class="well column  col-lg-12  col-sm-12 col-xs-12" id="content">

    <div class="row pt-3 pb-3 mb-3">
      <h2>Averages</h2>

      <!--  COMMENTED OUT FOR NOW
      <div class="col-md-2">
        <div class="input-group">
          <select class="form-select mb-3" id="startPrefix">
            <option class="dropdown-item" value="p">P</option>
            <option class="dropdown-item" value="qm" selected>Qm</option>
            <option class="dropdown-item" value="qf">Qf</option>
            <option class="dropdown-item" value="sf">Sf</option>
            <option class="dropdown-item" value="f">F</option>
          </select>
          <input type="text" id="startMatch" class="form-control" aria-label="Text input with dropdown button">
        </div>
      </div>

      <div class="col-md-3">
        <div class="input-group">
          <select class="form-select mb-3" id="endPrefix">
            <option class="dropdown-item" value="p">P</option>
            <option class="dropdown-item" value="qm" selected>Qm</option>
            <option class="dropdown-item" value="qf">Qf</option>
            <option class="dropdown-item" value="sf">Sf</option>
            <option class="dropdown-item" value="f">F</option>
          </select>
          <input type="text" id="endMatch" class="form-control" aria-label="Text input with dropdown button">
          <button id="filterData" type="button" class="btn btn-primary">Filter Data</button>
        </div>
      </div>
    </div>
COMMENTED OUT FOR NOW-->

      <div class="row pt-3 pb-3 mb-3">
        <div class="overflow-auto" id="freezeTableDiv">
          <style type="text/css" media="screen">
            table tr {
              border: 1px solid black;
            }

            table td,
            table th {
              border-right: 1px solid black;
            }
          </style>
          <table id="rawDataTable" class="tableFixHead table table-striped table-bordered table-hover sortable" style="width:100%">
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
              <tr>
                <th colspan="1" class="text-center"></th>
                <th colspan="63" class="text-center fw-bold" style="background-color:#e8f1ff">Averages</th>
              </tr>
              <tr>
                <th colspan="1" class="text-center"></th>
                <th colspan="63" class="text-center fw-bold" style="background-color:#e8f1ff">Table</th>
              </tr>
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
                <!--<th class="text-center" scope="col">N</th>
              <th class="text-center" scope="col">Bell</th>
              <th class="text-center" scope="col">10s</th>
              <th class="text-center" scope="col">5s</th>-->
                <th class="text-center" scope="col">#</th>
              </tr>

            </thead>
            <tbody id="tableData">
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <?php include 'footer.php'; ?>

  <script type="text/javascript" src="./external/DataTables/DataTables-1.11.5/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="./scripts/matchDataProcessor.js"></script>

  <script>
    src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"

    var teamList = new Set();
    var scoutingData = {};
    var tbaData = {};
    var internalEloRank = {
      "elo": {}
    };

    var rawdata = null;
    var frozenTable = null;

    function dummyGet(dict, key) {
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

    function dataToTable() {
      /* Write data to table */
      $("#tableData").html(""); // Clear Table
      for (let teamNum of teamList) {
        var endgameClimbPercentage = dummyGet(scoutingData[teamNum], "endgameClimbPercent");
        //var endgameClimbStartPercentage = dummyGet(scoutingData[teamNum], "endgameStartClimbPercent");
        var endgameFoulPercentage = dummyGet(scoutingData[teamNum], "endgameFoulPercent");

        var rowString = "<tr>" +
          "<td align=\"center\"><a href='teamLookup.php?teamNum=" + teamNum + "'>" + teamNum + "</a></td>" +
          //"<td>" + dummyGet(tbaData[teamNum], "totalPoints") + "</td>" +
          //HOLD"<td>" + dummyGet(internalEloRank["elo"], teamNum) + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "avgTotalPoints") + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "maxTotalPoints") + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "avgTotalCoral") + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "maxTotalCoral") + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "avgTotalAlgae") + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "maxTotalAlgae") + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "avgTotalAutoPoints") + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "maxTotalAutoPoints") + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "avgTotalAutoCoralPoints") + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "maxTotalAutoCoralPoints") + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "avgTotalAutoAlgaePoints") + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "maxTotalAutoAlgaePoints") + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "avgTotalTeleopPoints") + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "maxTotalTeleopPoints") + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "avgTotalTeleopCoralPoints") + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "maxTotalTeleopCoralPoints") + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "avgTotalTeleopAlgaePoints") + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "maxTotalTeleopAlgaePoints") + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "avgEndgamePoints") + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "maxEndgamePoints") + "</td>" +

          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "avgAutonCoral") + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "maxAutonCoral") + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "avgAutonCoralL1") + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "maxAutonCoralL1") + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "avgAutonCoralL2") + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "maxAutonCoralL2") + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "avgAutonCoralL3") + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "maxAutonCoralL3") + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "avgAutonCoralL4") + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "maxAutonCoralL4") + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "avgAutonAlgae") + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "maxAutonAlgae") + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "avgAutonAlgaeNet") + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "maxAutonAlgaeNet") + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "avgAutonAlgaeProc") + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "maxAutonAlgaeProc") + "</td>" +

          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "teleopCoralScoringPercent") + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "avgTeleopCoralScored") + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "maxTeleopCoralScored") + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "avgTeleopCoralL1") + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "maxTeleopCoralL1") + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "avgTeleopCoralL2") + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "maxTeleopCoralL2") + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "avgTeleopCoralL3") + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "maxTeleopCoralL3") + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "avgTeleopCoralL4") + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "maxTeleopCoralL4") + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "teleopAlgaeScoringPercent") + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "avgTeleopAlgaeScored") + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "maxTeleopAlgaeScored") + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "avgTeleopAlgaeNet") + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "maxTeleopAlgaeNet") + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "avgTeleopAlgaeProc") + "</td>" +
          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "maxTeleopAlgaeProc") + "</td>" +

          "<td align=\"center\">" + dummyGet(endgameClimbPercentage, 0) + "</td>" +
          "<td align=\"center\">" + dummyGet(endgameClimbPercentage, 1) + "</td>" +
          "<td align=\"center\">" + dummyGet(endgameClimbPercentage, 2) + "</td>" +
          "<td align=\"center\">" + dummyGet(endgameClimbPercentage, 3) + "</td>" +
          "<td align=\"center\">" + dummyGet(endgameClimbPercentage, 4) + "</td>" +

          "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "totaldied") + "</td>" +
          "</td>";

        $("#tableData").append(rowString);
      }
    }

    function addTeamKVToTeamList(data) {
      // Build a teamList from either our data or TBA data
      for (var key in data) {
        teamList.add(key);
      }
    }

    function requestAPI() {
      // Gets data from our local scouting data
      $.get("readAPI.php", {
        getAllData: 1
      }).done(function (data) {
        data = JSON.parse(data);
        rawdata = data;
        var mdp = new matchDataProcessor(data);
        // mdp.removePracticeMatches();
        mdp.getSiteFilteredAverages(function (averageData) {
          scoutingData = {
            ...averageData
          };
          //console.log(scoutingData);
          addTeamKVToTeamList(scoutingData);
          dataToTable();
          setTimeout(function () {
            sorttable.makeSortable(document.getElementById("rawDataTable"))
            frozenTable = $('#freezeTableDiv').freezeTable({
              backgroundColor: "white",
              'columnKeep': true,
              'frozenColVerticalOffset': 0
            });
          }, 1);
        });
      });

/*HOLD--> ELO column is commented out for now
    // Get internal ranking data
    $.get("readAPI.php", {
        getInternalRankings: 1
      }).done(function (data) {
        var data = JSON.parse(data);
        internalEloRank = {
          ...data
        };
        dataToTable();
      });
< --HOLD */

/*HOLD->
    // Gets data from our TBA API
    $.get("tbaAPI.php", {
      getCOPRs: 1
    }).done(function(data) {
      data = JSON.parse(data)["data"];
      addTeamKVToTeamList(data);
      tbaData = data;
      dataToTable();
      setTimeout(function() {
        sorttable.makeSortable(document.getElementById("rawDataTable"))
        frozenTable = $('#freezeTableDiv').freezeTable({
          backgroundColor: "white",
          'columnKeep': true,
          'frozenColVerticalOffset': 0
        });
      }, 1);
    }); 
<-HOLD */
  }

    function filterAndShow() {
      var start = $("#startPrefix").val() + $("#startMatch").val();
      var end = $("#endPrefix").val() + $("#endMatch").val();
      var mdp = new matchDataProcessor(rawdata);
      mdp.filterMatches(start, end);
      scoutingData = mdp.getAverages();
      addTeamKVToTeamList(scoutingData);
      dataToTable();
      setTimeout(function () {
        sorttable.makeSortable(document.getElementById("rawDataTable"))
        frozenTable = $('#freezeTableDiv').freezeTable({
          backgroundColor: "white",
          'columnKeep': true,
          'frozenColVerticalOffset': 0
        });
      }, 1);
    }

    $(document).ready(function () {
      requestAPI();

      $("#filterData").click(function () {
        filterAndShow();
      });

      $("#rawDataTable").click(function () {
        frozenTable.update();
      });
    });
  </script>
