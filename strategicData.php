<title>Strategic Data</title>
<?php include("header.php") ?>
<div class="container row-offcanvas row-offcanvas-left">
  <div class="well column  col-lg-12  col-sm-12 col-xs-12" id="content">

    <div class="row pt-3 pb-3 mb-3">
      <h2>Strategic Scouting Data</h2>
      <div id="freezeTableDiv">
          <style type="text/css" media="screen">
            table tr {
                border: 1px solid black;
            }
            table td, table th {
                border-right: 1px solid black;
            }
            </style>
        <table id="rawDataTable" class="table table-striped table-hover sortable">
          <colgroup>
            <col span="2" style="background-color:transparent">
            <col span="1" style="background-color:#cfe2ff">
            <col span="1" style="background-color:transparent">
            <col span="1" style="background-color:#cfe2ff">
            <col span="1" style="background-color:transparent">
            <col span="1" style="background-color:#cfe2ff">
            <col span="1" style="background-color:#transparent">
            <col span="1" style="background-color:#cfe2ff">
            <col span="1" style="background-color:transparent">
            <col span="1" style="background-color:#cfe2ff">
            <col span="1" style="background-color:#transparent">
            <col span="1" style="background-color:#cfe2ff">
            <col span="1" style="background-color:#transparent">
            <col span="1" style="background-color:#cfe2ff">
            <col span="1" style="background-color:#transparent">
            <col span="1" style="background-color:#cfe2ff">
            <col span="1" style="background-color:#transparent">
            <col span="1" style="background-color:#cfe2ff">
            <col span="1" style="background-color:#transparent">
            <col span="1" style="background-color:#cfe2ff">
            <col span="1" style="background-color:#transparent">
            <col span="1" style="background-color:#cfe2ff">
            <col span="1" style="background-color:#transparent">
            <col span="1" style="background-color:#cfe2ff">
            <col span="1" style="background-color:#transparent">
            <col span="1" style="background-color:#cfe2ff">
            <col span="1" style="background-color:#transparent">
            <col span="1" style="background-color:#cfe2ff">
            <col span="1" style="background-color:#transparent">
          </colgroup>
          <thead>
            <tr>
              <th colspan="1"</th>
              <th colspan="1"</th>
              <th colspan="4" class="text-center" style="background-color:#3686FF">Pit Scouting</th>
              <th colspan="1"</th>
              <th colspan="2" class="text-center" style="background-color:#3686FF">Auto Multi-Note Source</th>
              <th colspan="1"</th>
              <th colspan="1"</th>
              <th colspan="1"</th>
              <th colspan="4" class="text-center" style="background-color:#3686FF">Defense Tactics</th>
              <th colspan="3" class="text-center">Against Defense</th>
              <th colspan="6" class="text-center" style="background-color:#3686FF">Fouls</th>
              <th colspan="1"</th>
              <th colspan="1"</th>
              <th colspan="1"</th>
              <th colspan="1"</th>
            </tr>
            <tr>
              <th scope="col" class="text-center">Team</th>
              <th scope="col" class="text-center">Match</th>
              <th scope="col" class="text-center">Gnd Intake</th>
              <th scope="col" class="text-center">Leave Shoot Auto</th>
              <th scope="col" class="text-center">Center Line Auto</th>
              <th scope="col" class="text-center">Can Do Amp</th>
              <th scope="col" class="text-center">Drive Skill</th>
              <th scope="col" class="text-center">Start Zone</th>
              <th scope="col" class="text-center">Center Line</th>
              <th scope="col" class="text-center">Shoots From</th>
              <th scope="col" class="text-center">Solid Passes</th>
              <th scope="col" class="text-center">Under Stage</th>
              <th scope="col" class="text-center">Bump</th>
              <th scope="col" class="text-center">Pin</th>
              <th scope="col" class="text-center">Block</th>
              <th scope="col" class="text-center">Note</th>
              <th scope="col" class="text-center">Pin /Block</th>
              <th scope="col" class="text-center">Bump</th>
              <th scope="col" class="text-center">Note</th>
              <th scope="col" class="text-center">Pin</th>
              <th scope="col" class="text-center">1+ Notes</th>
              <th scope="col" class="text-center">Crossed Center</th>
              <th scope="col" class="text-center">Podium Touch</th>
              <th scope="col" class="text-center">Source Touch</th>
              <th scope="col" class="text-center">Stage Touch</th>
              <th scope="col" class="text-center">Climb Note</th>
              <th scope="col" class="text-center">Problem Note</th>
              <th scope="col" class="text-center">General Note</th>
              <th scope="col" class="text-center">Scout</th>
            </tr>
          </thead>
          <tbody id="tableData">
          </tbody>
        </table>

      </div>
    </div>
  </div>
</div>

<?php include("footer.php") ?>

<script>
  var frozenTable = null;

  function sortTable() {
    // Assumes the entries are team numbers or match numbers. Note a team number could have end in 
    // a "B", "C", "D", or "E", in which case we want to strip that off and just use the number for
    // the comparison.

    var table = document.getElementById("rawDataTable");
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

  // Converts a given "1" to yes, "0" to no, anything else to empty string.
  function convertToYesNo(value) {
    var convertedVal = ""; 
    if(value == "1")
      convertedVal = "yes"; 
    else if(value == "0")
      convertedVal = "no"; 
    return convertedVal;
  }

  function dataToTable(dataObj,pitData) {
    for (let i = 0; i < dataObj.length; i++) {
      var driverability = dataObj[i]["driverability"];
      var driveVal = ""; 
      if(driverability == "1")
        driveVal = "Jerky"; 
      else if(driverability == "2")
        driveVal = "Slow"; 
      else if(driverability == "3")
        driveVal = "Average"; 
      else if(driverability == "4")
        driveVal = "Quick"; 

      var shootsFrom = dataObj[i]["shootsfrom"];
      var sfVal = ""; 
      if(shootsFrom == "1")
        sfVal = "Subwoofer"; 
      else if(shootsFrom == "2")
        sfVal = "Podium"; 
      else if(shootsFrom == "3")
        sfVal = "Anywhere"; 

      var teamnum = dataObj[i]["teamnumber"];

      // Get pit-scouting data; note ths team may not have any pit data.
      var pit_leaveVal = "NA"; 
      var pit_clVal = "NA"; 
      var pit_ampVal = "NA"; 
      var pit_intakeVal = "NA"; 
      if(pitData[teamnum] != null) {
        var pit_leaveVal = pitData[teamnum]["preloadAndLeaveAuton"];
        pit_intakeVal = convertToYesNo(pitData[teamnum]["intake"]);
        pit_clVal = convertToYesNo(pitData[teamnum]["centerLineAuton"]);
        pit_ampVal = convertToYesNo(pitData[teamnum]["amp"]);
      }

      var rowString = "<tr><td align=\"center\">" + teamnum + "</td>" +
        "<td align=\"center\">" + dataObj[i]["matchnumber"] + "</td>" +
        "<td align=\"center\">" + pit_intakeVal + "</td>" +
        "<td align=\"center\">" + pit_leaveVal + "</td>" +
        "<td align=\"center\">" + pit_clVal + "</td>" +
        "<td align=\"center\">" + pit_ampVal + "</td>" +
        "<td align=\"center\">" + driveVal + "</td>" +
        "<td align=\"center\">" + convertToYesNo(dataObj[i]["multinote_starting_zone"]) + "</td>" +
        "<td align=\"center\">" + convertToYesNo(dataObj[i]["multinote_centerline"]) + "</td>" +
        "<td align=\"center\">" + sfVal + "</td>" +
        "<td align=\"center\">" + convertToYesNo(dataObj[i]["passing"]) + "</td>" +
        "<td align=\"center\">" + convertToYesNo(dataObj[i]["understage"]) + "</td>" + 
        "<td align=\"center\">" + convertToYesNo(dataObj[i]["defense_tactic1"]) + "</td>" +
        "<td align=\"center\">" + convertToYesNo(dataObj[i]["defense_tactic2"]) + "</td>" +
        "<td align=\"center\">" + convertToYesNo(dataObj[i]["defense_tactic3"]) + "</td>" +
        "<td align=\"center\">" + dataObj[i]["defense_comment"] + "</td>" +
        "<td align=\"center\">" + convertToYesNo(dataObj[i]["against_tactic1"]) + "</td>" +
        "<td align=\"center\">" + convertToYesNo(dataObj[i]["against_tactic2"]) + "</td>" +
        "<td align=\"center\">" + dataObj[i]["against_comment"] + "</td>" +
        "<td align=\"center\">" + convertToYesNo(dataObj[i]["foul1"]) + "</td>" +
        "<td align=\"center\">" + convertToYesNo(dataObj[i]["foul2"]) + "</td>" +
        "<td align=\"center\">" + convertToYesNo(dataObj[i]["foul3"]) + "</td>" + "<td align=\"center\">" + convertToYesNo(dataObj[i]["foul4"]) + "</td>" +
        "<td align=\"center\">" + convertToYesNo(dataObj[i]["foul5"]) + "</td>" +
        "<td align=\"center\">" + convertToYesNo(dataObj[i]["foul6"]) + "</td>" +
        "<td align=\"center\">" + dataObj[i]["climb_comment"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["problem_comment"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["general_comment"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["scoutname"] + "</td>" +
        "</td>";
      $("#tableData").append(rowString);

    }
  }

  function requestAPI() {
    // get Drive Rank Scouting Data
    $.get("readAPI.php", {
      getAllDriveRankData: 1
    }).done(function(data) {
      var dataObj = JSON.parse(data);

      // Get the Pit Scouting Data too.
      $.get("readAPI.php", {
        getAllPitData: 1
      }).done(function(data) {
        var pitData = JSON.parse(data);
        dataToTable(dataObj,pitData);

        setTimeout(function() {
          sorttable.makeSortable(document.getElementById("rawDataTable"));
          frozenTable = $('#freezeTableDiv').freezeTable({
            'backgroundColor': "white",
            'columnNum': 2,
            'frozenColVerticalOffset': 0
          });
        }, 1);
        sortTable();
      });
    });
  }

  $(document).ready(function() {
    requestAPI();
    // sorttable.makeSortable(document.getElementById("rawDataTable"));

    $("#rawDataTable").click(function() {
      if (frozenTable) {
        frozenTable.update();
      }
    });
  });
</script>
