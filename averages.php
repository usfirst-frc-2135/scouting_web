<!-- this was copy and pasted from rawData.php so the java will need to change -->
<title>Averages</title>
<?php include("header.php") ?>
<div class="container row-offcanvas row-offcanvas-left">
  <div class="well column  col-lg-12  col-sm-12 col-xs-12" id="content">
    <h5>Averages</h5>

    <div class="row g-3">
      <div class="col-md-3">
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
        <table id="rawDataTable" class="tableFixHead table table-striped table-bordered table-hover sortable" style="width:100%;">
          <thead>
            <tr>
              <th colspan="1" class="text-center fw-bold"></th>
              <th colspan="1" class="text-center fw-bold"></th>
              <th colspan="1" class="text-center fw-bold"></th>
              <th colspan="2" class="text-center fw-bold">Total Pts</th>
              <th colspan="2" class="text-center">Total Auto Pts</th>
              <th colspan="2" class="text-center">Total Teleop Pts</th>
              <th colspan="2" class="text-center">Endgame Pts</th>
              <th colspan="4" class="text-center">Auton</th>
              <th colspan="4" class="text-center">Teleop</th>
              <th colspan="5" class="text-center">Endgame</th>
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
              <th colspan="1"></th>
              <th colspan="1"></th>
              
			  <th colspan="2" class="text-center">Cones</th>
              <th colspan="2" class="text-center">Cubes</th>
			
				
              <th colspan="2" class="text-center">Cones</th>
              <th colspan="2" class="text-center">Cubes</th>
              <th colspan="5" class="text-center">Charge Station %</th>
              <th colspan="1"></th>
            </tr>
            <tr>
              <th scope="col">Team #</th>
              <th scope="col">OPR</th>
              <th scope="col">Internal ELO</th>
              <th scope="col">AVG</th>
              <th scope="col">MAX</th>
              <th scope="col">AVG</th>
              <th scope="col">MAX</th>
              <th scope="col">AVG</th>
              <th scope="col">MAX</th>
              <th scope="col">AVG</th>
              <th scope="col">MAX</th>
              <th scope="col">AVG</th>
              <th scope="col">MAX</th>
              <th scope="col">AVG</th>
              <th scope="col">MAX</th>
              <th scope="col">AVG</th>
              <th scope="col">MAX</th>
              <th scope="col">AVG</th>
              <th scope="col">MAX</th>
              <th scope="col">None</th>
              <th scope="col">Parked</th>
              <th scope="col">Docked</th>
              <th scope="col">Engaged</th>
              <th scope="col">#</th>
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
	 
	  //var autonchargestationPercentage = dummyGet(scoutingData[teamNum], "autonchargestationpercent");
      var endgamechargestationPercentage = dummyGet(scoutingData[teamNum], "endgamechargestationpercent");

      var rowString = "<tr>" +
        "<td><a href='teamLookup.php?teamNum=" + teamNum + "'>" + teamNum + "</a></td>" +
        "<td>" + dummyGet(tbaData[teamNum], "totalPoints") + "</td>" +
        "<td>" + dummyGet(internalEloRank["elo"], teamNum) + "</td>" +
        "<td>" + dummyGet(scoutingData[teamNum], "avgtotalpoints") + "</td>" +
        "<td>" + dummyGet(scoutingData[teamNum], "maxtotalpoints") + "</td>" +
        "<td>" + dummyGet(scoutingData[teamNum], "avgautopoints") + "</td>" +
        "<td>" + dummyGet(scoutingData[teamNum], "maxautopoints") + "</td>" +
        "<td>" + dummyGet(scoutingData[teamNum], "avgteleoppoints") + "</td>" +
        "<td>" + dummyGet(scoutingData[teamNum], "maxteleoppoints") + "</td>" +
        "<td>" + dummyGet(scoutingData[teamNum], "avgendgamepoints") + "</td>" +
        "<td>" + dummyGet(scoutingData[teamNum], "maxendgamepoints") + "</td>" +
		 
		//"<td>" + dummyGet(autonchargestationPercentage, 0) + "%</td>" +
        //"<td>" + dummyGet(autonchargestationPercentage, 1) + "%</td>" +
        //"<td>" + dummyGet(autonchargestationPercentage, 2) + "%</td>" + 
		  
        "<td>" + dummyGet(scoutingData[teamNum], "avgautoncones") + "</td>" +
		"<td>" + dummyGet(scoutingData[teamNum], "maxautoncones") + "</td>" +
	
		
		"<td>" + dummyGet(scoutingData[teamNum], "avgautoncubes") + "</td>" +
		"<td>" + dummyGet(scoutingData[teamNum], "maxautoncubes") + "</td>" +

		  
		"<td>" + dummyGet(scoutingData[teamNum], "avgteleopcones") + "</td>" +
		"<td>" + dummyGet(scoutingData[teamNum], "maxteleopcones") + "</td>" +
		"<td>" + dummyGet(scoutingData[teamNum], "avgteleopcubes") + "</td>" +
		"<td>" + dummyGet(scoutingData[teamNum], "maxteleopcubes") + "</td>" +
		  
        "<td>" + dummyGet(endgamechargestationPercentage, 0) + "%</td>" +
        "<td>" + dummyGet(endgamechargestationPercentage, 1) + "%</td>" +
        "<td>" + dummyGet(endgamechargestationPercentage, 2) + "%</td>" +
        "<td>" + dummyGet(endgamechargestationPercentage, 3) + "%</td>" +
        "<td>" + dummyGet(scoutingData[teamNum], "totaldied") + "</td>" + 
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
        console.log(scoutingData);
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
          'frozenColVerticalOffset': 25
        });
      }, 1);
    });
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