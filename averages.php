<!-- this was copy and pasted from rawData.php so the java will need to change -->
<title>Averages</title>
<?php include("header.php") ?>
<div class="container row-offcanvas row-offcanvas-left">
  <div class="well column  col-lg-12  col-sm-12 col-xs-12" id="content">

    <div class="row pt-3 pb-3 mb-3">
      <h2>Averages</h2>
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

    <div class="row pt-3 pb-3 mb-3">
      <div class="overflow-auto" id="freezeTableDiv">
          <style type="text/css" media="screen">
            table tr {
                border: 1px solid black;
            }
            table td, table th {
                border-right: 1px solid black;
            }
            </style>
        <table id="rawDataTable" class="tableFixHead table table-striped table-bordered table-hover sortable" style="width:100%;">
          <colgroup>
            <col span="1" style="background-color:transparent" >
            <col span="2" style="background-color:#cfe2ff">
            <col span="2" style="background-color:transparent">
            <col span="2" style="background-color:#cfe2ff">
            <col span="2" style="background-color:transparent">
            <col span="2" style="background-color:#cfe2ff">
            <col span="2" style="background-color:#B5D3FF">
            <col span="5" style="background-color:transparent">
            <col span="1" style="background-color:#cfe2ff">
            <col span="1" style="background-color:#B5D3FF">
            <col span="1" style="background-color:#cfe2ff">
            <col span="1" style="background-color:#cfe2ff">
            <col span="1" style="background-color:#B5D3FF">
            <col span="1" style="background-color:#cfe2ff">
            <col span="1" style="background-color:#b5d3ff">
            <col span="1" style="background-color:#b5d3ff">

          </colgroup>
          <thead>
            <tr>
              <th colspan="1" class="text-center fw-bold"></th>
              <th colspan="2" class="text-center fw-bold" style="background-color:#3686FF">Total Notes</th>
              <th colspan="2" class="text-center">Total Auto Notes</th>
              <th colspan="2" class="text-center" style="background-color:#3686FF">Total Teleop Notes</th>
              <th colspan="2" class="text-center">Endgame Pts</th>
              <th colspan="4" class="text-center" style="background-color:#3686FF">Auton</th>
              <th colspan="5" class="text-center">Teleop</th>
              <th colspan="8" class="text-center" style="background-color:#3686FF">Endgame</th>
              <th colspan="1" class="text-center fw-bold">Died</th>
            </tr>
            <tr>
              <th colspan="1"></th>
              <th colspan="1"></th> 
              <th colspan="1"></th>
              <th colspan="1"></th>
              <th colspan="1"></th>
              <th colspan="1"></th>
				
              <th colspan="1"></th>
              <th colspan="1"></th>
              <th colspan="1"></th>
              
              <th colspan="2" class="text-center">Amp</th>
              <th colspan="2" class="text-center">Speaker</th>
				
              <th colspan="2" class="text-center">Amp</th>
              <th colspan="3" class="text-center">Speaker</th>
              <th colspan="3" class="text-center" style="background-color:#83B4FF">Stage%</th>
              <th colspan="3" class="text-center" style="background-color:#83B4FF">Harmony%</th> 
              <th colspan="1" class="text-center" style="background-color:#83b4ff">Trap</th> 
              <th colspan="1" class="text-center" style="background-color:#83b4ff">Spotlit</th> 
              <th colspan="1"></th>
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
              <th scope="col">Acc%</th>
              <th class="text-center" scope="col">N</th>
              <th class="text-center" scope="col">P</th>
              <th class="text-center" scope="col">O</th>
              <th class="text-center" scope="col">0</th>
              <th class="text-center" scope="col">1</th>
              <th class="text-center" scope="col">2</th>
              <th class="text-center" scope="col">%</th>
              <th class="text-center" scope="col">%</th>
              <th class="text-center" scope="col">#</th>
            </tr>

          </thead>
          <tbody id="tableData" style="z-index:-1;">>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<style>

</style>

<?php include("footer.php") ?>
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
      var endgamestagePercentage = dummyGet(scoutingData[teamNum], "endgamestagepercent");
      var endgameharmonyPercentage = dummyGet(scoutingData[teamNum], "endgameharmonypercent");

      var rowString = "<tr>" +
        "<td align=\"center\"><a href='teamLookup.php?teamNum=" + teamNum + "'>" + teamNum + "</a></td>" +
        //"<td>" + dummyGet(tbaData[teamNum], "totalPoints") + "</td>" +
        //HOLD"<td>" + dummyGet(internalEloRank["elo"], teamNum) + "</td>" +
        "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "avgtotalnotes") + "</td>" +
        "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "maxtotalnotes") + "</td>" +
        "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "avgautonotes") + "</td>" +
        "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "maxautonotes") + "</td>" +
        "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "avgteleopnotes") + "</td>" +
        "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "maxteleopnotes") + "</td>" +
        "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "avgendgamepoints") + "</td>" +
        "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "maxendgamepoints") + "</td>" +

        "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "avgautonamps") + "</td>" +
	    "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "maxautonamps") + "</td>" +
	    "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "avgautonspeaker") + "</td>" +
	    "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "maxautonspeaker") + "</td>" +
		  
        "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "avgteleopampnotes") + "</td>" +
	    "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "maxteleopampnotes") + "</td>" +
	    "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "avgteleopspeakernotes") + "</td>" +
	    "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "maxteleopspeakernotes") + "</td>" +
        "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "teleopSpeakerShootPercent") + "</td>" +
		  
        "<td align=\"center\">" + dummyGet(endgamestagePercentage, 0) + "</td>" +
        "<td align=\"center\">" + dummyGet(endgamestagePercentage, 1) + "</td>" +
        "<td align=\"center\">" + dummyGet(endgamestagePercentage, 2) + "</td>" +
          
        "<td align=\"center\">" + dummyGet(endgameharmonyPercentage, 0) + "</td>" +
        "<td align=\"center\">" + dummyGet(endgameharmonyPercentage, 1) + "</td>" +
        "<td align=\"center\">" + dummyGet(endgameharmonyPercentage, 2) + "</td>" +
          
        "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "trapPercentage") + "</td>" +
        "<td align=\"center\">" + dummyGet(scoutingData[teamNum], "spotlitPercentage") + "</td>" +
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
    }).done(function(data) {
      data = JSON.parse(data);
      rawdata = data;
      var mdp = new matchDataProcessor(data);
      // mdp.removePracticeMatches();
      mdp.getSiteFilteredAverages(function(averageData) {
        scoutingData = {
          ...averageData
        };
        //console.log(scoutingData);
        addTeamKVToTeamList(scoutingData);
        dataToTable();
        setTimeout(function() {
          sorttable.makeSortable(document.getElementById("rawDataTable"))
          frozenTable = $('#freezeTableDiv').freezeTable({
            backgroundColor: "white",
            'columnKeep': true,
            'frozenColVerticalOffset': 25
          });
        }, 1);
      });
    });

/*HOLD--> ELO column is commented out for now
    // Get internal ranking data
    $.get("readAPI.php", {
      getInternalRankings: 1
    }).done(function(data) {
      var data = JSON.parse(data);
      internalEloRank = {
        ...data
      };
      dataToTable();
    });
<--HOLD*/

    // Gets data from our TBA API
    /* HOLD $.get("tbaAPI.php", {
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
          'frozenColVerticalOffset': 25
        });
      }, 1);
    }); HOLD */
  }

  function filterAndShow() {
    var start = $("#startPrefix").val() + $("#startMatch").val();
    var end = $("#endPrefix").val() + $("#endMatch").val();
    var mdp = new matchDataProcessor(rawdata);
    mdp.filterMatches(start, end);
    scoutingData = mdp.getAverages();
    addTeamKVToTeamList(scoutingData);
    dataToTable();
    setTimeout(function() {
      sorttable.makeSortable(document.getElementById("rawDataTable"))
      frozenTable = $('#freezeTableDiv').freezeTable({
        backgroundColor: "white",
        'columnKeep': true,
        'frozenColVerticalOffset': 25
      });
    }, 1);
  }

  $(document).ready(function() {
    requestAPI();

    $("#filterData").click(function() {
      filterAndShow();
    });

    $("#rawDataTable").click(function() {
      frozenTable.update();
    });
  });
</script>
