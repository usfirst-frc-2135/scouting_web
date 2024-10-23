<title>Strategic Scouts Schedule</title>
<?php include("header.php") ?>
<div class="container row-offcanvas row-offcanvas-left">
  <div class="well column  col-lg-12  col-sm-12 col-xs-12" id="content">

    <div class="row pt-3 pb-3 mb-3">
      <h2>Strategic Scouting Schedule</h2>
      <div class="col-md-3">
          <button id="createButton" type="button" class="btn btn-primary">Create Schedule</button>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div id="freezeTableDiv"> 
        <style type="text/css" media="screen">
        table tr {
            border: 1px solid black;
        }
        table td, table th {
             border-right: 1px solid black;
        }
        </style>
      <table id="matchTable" class="table table-striped table-hover sortable">
        <colgroup>
          <col span="1" style="background-color:transparent">
          <col span="1" style="background-color:#cfe2ff">
        </colgroup>
        <thead>
          <tr>
          <th class="text-center" scope="col">Match</th>
          <th class="text-center" scope="col">Teams</th>
          </tr>
        </thead>
        <tbody id="tableData">
        </tbody>
      </table>
    </div>
  </div>
  <div class="col-md-2">
    <div id="TeamListDiv"> 
        <style type="text/css" media="screen">
        table tr {
            border: 1px solid black;
        }
        table td, table th {
             border-right: 1px solid black;
        }
        </style>
      <table id="teamListTable" class="table table-striped table-hover sortable">
        <colgroup>
          <col span="1" style="background-color:transparent">
        </colgroup>
        <thead>
          <tr>
          <th id="teamTitle" class="text-center" scope="col">Teams</th>
          </tr>
        </thead>
        <tbody id="teamListData">
        </tbody>
      </table>
    </div>
  </div>
</div>


<?php include("footer.php") ?>
<script type="text/javascript" src="./external/DataTables/DataTables-1.11.5/js/jquery.dataTables.min.js"></script>

<script>
  src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"
  

//  console.log("---> doing strategic page");
  var teamList = [];   // used to hold the team numbers for the teamTable

  function addToTeamList(teamstr)
  {
    var strList = teamstr.split(",");
    var listcount = strList.length;
    for (let i = 0; i < listcount; i++) 
    {
      // Put each team number found in teamList if it isn't already there.
      var teamnum = strList[i];
      teamnum = teamnum.trim();   // trim whitespace
      var bAlreadyInList = false;
      for (let j = 0; j < teamList.length; j++)
      {
//        console.log("     ---> comparing team '"+teamList[j]+"' vs '"+teamnum+"'");
        if(teamList[j] == teamnum)
        {
          bAlreadyInList = true;
          break; 
        }
      }
      if(bAlreadyInList === false)
      {
        teamList.push(teamnum);
      }
    }
  }

  function dataToTable(dataObj) {
    $("#tableData").html(""); // Clear table
    for (let i = 0; i < dataObj.length; i++) {
      var matchNum = dataObj[i]["match_number"];
      var rowString = "<tr><td align=\"center\">" + matchNum + "</td>" +
           "<td align=\"center\">" + dataObj[i]["teams"] + "</td>" + "</td>";
      $("#tableData").append(rowString);

      // Also get the data for the teamTable; this is a string that can contain several team 
      // numbers, separated by comma-space.
      addToTeamList(dataObj[i]["teams"]);
    }
  }

  function dataToTeamListTable() {
    $("#teamListData").html(""); // Clear table
    var sizeTeams = teamList.length;
    for (let i = 0; i < sizeTeams; i++) {
      var team = teamList[i];
      var rowString = "<tr><td align=\"center\">" + team + "</td>" + "</td>";
      $("#teamListData").append(rowString);
    }
    $("#teamTitle").html("Teams - "+sizeTeams);
  }

   
  function sortTable(id) {
    // Assumes the entries are team numbers or match numbers. Note a team number could have end in 
    // a "B", "C", "D", or "E", in which case we want to strip that off and just use the number for
    // the comparison.

    var table = document.getElementById(id);
    var rows = Array.prototype.slice.call(table.querySelectorAll("tbody> tr"));

    // Sort the rows based on column 1 match number value
    rows.sort(function(rowA,rowB) {
      var cellA = rowA.cells[0].textContent.trim();                          
      var cellB = rowB.cells[0].textContent.trim();                          

      // Remove any letters at the last char for the sort comparison.
      if (cellA.charAt(cellA.length-1) == "B" || cellA.charAt(cellA.length-1) == "C" ||
          cellA.charAt(cellA.length-1) == "D" || cellA.charAt(cellA.length-1) == "E")
      {
        cellA = cellA.substr(0,cellA.length-1);
      }

      if (cellB.charAt(cellB.length-1) == "B" || cellB.charAt(cellB.length-1) == "C" ||
          cellB.charAt(cellB.length-1) == "D" || cellB.charAt(cellB.length-1) == "E")
      {
        cellB = cellB.substr(0,cellB.length-1);
      }
      
      return(cellA - cellB);
    });

    // Update the table body with the sorted rows 
    rows.forEach(function(row) {
      table.querySelector("tbody").appendChild(row);
    });
  }

  // Figure out which matches and teams for strategic scouts 
  function determineMatches() {
    console.log("---> starting determineMatches()");
    $.get("tbaAPI.php", {
      getStrategicMatches: 1
    }).done(function(data) {
      var dataObj = JSON.parse(data);
      dataToTable(dataObj);
      sortTable("matchTable");
      setupTeamList();
    });
  }

  // Get teamlist for strategic scouting matche
  function setupTeamList() {
    console.log("--->>> starting setupTeamList()");
    dataToTeamListTable();
    sortTable("teamListTable");
  }


  $(document).ready(function() {
    $("#createButton").click(function() {
      console.log("--->>> Create Schedule button clicked!");
      determineMatches();
    });
  });
</script>
