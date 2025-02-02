<title>Raw Data</title>
<?php include("header.php") ?>
<div class="container row-offcanvas row-offcanvas-left">
  <div class="well column  col-lg-12  col-sm-12 col-xs-12" id="content">

    <div class="row pt-3 pb-3 mb-3">
      <h2>Raw Data</h2>
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
              <th colspan="38" class="text-center">Raw Scouted Data</th>
            </tr>
            <tr>
              <th colspan="1"</th>
              <th colspan="1"</th>
              <th colspan="38" class="text-center">Table</th>
            </tr>
            <tr>
              <th scope="col">Match</th>
              <th scope="col">Team</th>
              <th scope="col">Auton Leave</th>
              <th scope="col">Auton Start</th>
              <th scope="col">Auton L1</th>
              <th scope="col">Auton L2</th>
              <th scope="col">Auton L3</th>
              <th scope="col">Auton L4</th>
              <th scope="col">Auton Net</th>
              <th scope="col">Auton Proc</th>
              <th scope="col">Auton Acq Coral Floor</th>
              <th scope="col">Auton Acq Coral Statn</th>
              <th scope="col">Auton Acq Algae Floor</th>
              <th scope="col">Auton Acq Algae Reef</th>
              <th scope="col">Teleop Acq Coral</th>
              <th scope="col">Teleop Acq Algae</th>
              <th scope="col">Teleop Algae Floor Pickup</th>
              <th scope="col">Teleop Coral Floor Pickup</th>
              <th scope="col">Teleop Knock Algae</th>
              <th scope="col">Teleop Acq Reef Algae</th>
              <th scope="col">Teleop Hold Both</th>
              <th scope="col">Teleop L1</th>
              <th scope="col">Teleop L2</th>
              <th scope="col">Teleop L3</th>
              <th scope="col">Teleop L4</th>
              <th scope="col">Teleop Net</th>
              <th scope="col">Teleop Proc</th>
              <th scope="col">Teleop Pin Foul</th>
              <th scope="col">Teleop Anchor Foul</th>
              <th scope="col">Teleop Cage Foul</th>
              <th scope="col">Teleop Barge Foul</th>
              <th scope="col">Teleop Reef Foul</th>
              <th scope="col">Climb</th>
              <th scope="col">Start Climb</th>
              <th scope="col">Endgame Foul</th>  
              <th scope="col">Died</th>
              <th scope="col">Comment</th>
              <th scope="col">Scout Name</th>
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
    var table = document.getElementById("rawDataTable");
    var rows = Array.prototype.slice.call(table.querySelectorAll("tbody> tr"));
    rows.sort(function(rowA,rowB) {
      var cellA = rowA.cells[0].textContent.trim();
      var cellB = rowB.cells[0].textContent.trim();
      return(sortRows(cellA,cellB));
    });
    // Update the table body with the sorted rows.
    rows.forEach(function(row) {
      table.querySelector("tbody").appendChild(row);
    });
  }

  // Returns 0 if rowA is before rowB; else returns 1. Assumes the row has a 
  // "matchnum" key that is <prefix><number>, where prefix is "p", "qm" or "sf".
  function sortRows(cellA,cellB) {

    // Pull apart prefix and number from matchnum (ie, "p", "qm", "sf")
    var Aprefix = "";
    var Anum = "";
    var Bprefix = "";
    var Bnum = "";
    if(cellA.charAt(0) == "p") {
     Anum = cellA.substr(1,cellA.length);
     Aprefix = "p";
    } 
    else if(cellA.charAt(0) == "q") {   // "qm"
     Anum = cellA.substr(2,cellA.length);
     Aprefix = "qm";
    } 
    else if(cellA.charAt(0) == "s") {   // "sf"
     Anum = cellA.substr(2,cellA.length);
     Aprefix = "sf";
    } 
    if(cellB.charAt(0) == "p") {
     Bnum = cellB.substr(1,cellB.length);
     Bprefix = "p";
    } 
    else if(cellB.charAt(0) == "q") {   // "qm"
     Bnum = cellB.substr(2,cellB.length);
     Bprefix = "qm";
    } 
    else if(cellA.charAt(0) == "s") {   // "sf"
     Bnum = cellB.substr(2,cellB.length);
     Bprefix = "sf";
    } 
    if(Aprefix == Bprefix)
      return(Anum - Bnum);
    if(Aprefix == "p")
      return 0;
    if(Bprefix == "p")
      return 1;
    if(Aprefix == "qm")
      return 0;
    return 1;
  };
//data object keywords should match the database configuration in dbHander.php
  function dataToTable(dataObj) {
    for (let i = 0; i < dataObj.length; i++) {
      var rowString = "<tr><td align=\"center\">" + dataObj[i]["matchnumber"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["teamnumber"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["autonLeave"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["autonStartingPosition"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["autonCoralL1"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["autonCoralL2"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["autonCoralL3"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["autonCoralL4"] + "</td>" + 
        "<td align=\"center\">" + dataObj[i]["autonAlgaeNet"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["autonAlgaeProcessor"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["autonCoralFloor"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["autonCoralStation"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["autonAlgaeFloor"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["autonAlgaeReef"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["teleopAcquireCoral"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["teleopAcquireAlgae"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["teleopAlgaeFloorPickup"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["teleopCoralFloorPickup"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["teleopKnockOffAlgae"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["teleopAcquireAlgaeReef"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["teleopHoldBothElements"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["teleopCoralL1"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["teleopCoralL2"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["teleopCoralL3"] + "</td>" +  
        "<td align=\"center\">" + dataObj[i]["teleopCoralL4"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["teleopAlgaeNet"] + "</td>" +  
        "<td align=\"center\">" + dataObj[i]["teleopAlgaeProcessor"] + "</td>" + 
        "<td align=\"center\">" + dataObj[i]["teleopDefenseLevel"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["teleopPinFoul"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["teleopAnchorFoul"] + "</td>" +  
        "<td align=\"center\">" + dataObj[i]["teleopCageFoul"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["teleopBargeZoneFoul"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["endgameClimbLevel"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["endgameStartClimbing"] + "</td>" + 
        
        "<td align=\"center\">" + dataObj[i]["endgameFoulNumber"] + "</td>" +  
        "<td align=\"center\">" + dataObj[i]["died"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["comment"] + "</td>" +  
        "<td align=\"center\">" + dataObj[i]["scoutname"] + "</td>" +  
        "</tr>";
      $("#tableData").append(rowString);

    }
  }

  function requestAPI() {
    //output: gets the API data from our server
    $.get("readAPI.php", {
      getAllData: 1
    }).done(function(data) {
      var dataObj = JSON.parse(data);
      dataToTable(dataObj);
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
