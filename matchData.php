<?php
$title = 'Match Data';
require 'header.php';
?>

<div class="container row-offcanvas row-offcanvas-left">
  <div id="content" class="column card-lg-12 col-sm-12 col-xs-12">

    <div class="row pt-3 pb-3 mb-3">
      <h2><?php echo $title; ?></h2>
    </div>

    <div id="freeze-table" class="freeze-table overflow-auto">
      <style type="text/css" media="screen">
        table tr {
          border: 1px solid black;
        }

        table td,
        table th {
          border-right: 1px solid black;
        }
      </style>
      <table id="matchDataTable" class="table table-striped table-hover sortable">
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
        </colgroup>
        <thead>
          <tr>
            <th colspan="1"> </th>
            <th colspan="1"> </th>
            <th colspan="19" class="text-center">Raw Scouted Data</th>
          </tr>
          <tr>
            <th colspan="1"> </th>
            <th colspan="1"> </th>
            <th colspan="19" class="text-center">Table</th>
          </tr>
          <tr>
            <th scope="col">Match</th>
            <th scope="col">Team</th>
            <th scope="col">Auton Leave</th>
            <th scope="col">Auton Coral L1</th>
            <th scope="col">Auton Coral L2</th>
            <th scope="col">Auton Coral L3</th>
            <th scope="col">Auton Coral L4</th>
            <th scope="col">Auton Algae Net</th>
            <th scope="col">Auton Algae Proc</th>
            <th scope="col">Acq'd Coral</th>
            <th scope="col">Acq'd Algae</th>
            <th scope="col">Teleop Coral L1</th>
            <th scope="col">Teleop Coral L2</th>
            <th scope="col">Teleop Coral L3</th>
            <th scope="col">Teleop Coral L4</th>
            <th scope="col">Teleop Algae Net</th>
            <th scope="col">Teleop Algae Proc</th>
            <th scope="col">Cage Climb</th>
            <th scope="col">Died</th>
            <th scope="col">Scout Name</th>
            <th scope="col">Comment</th>
          </tr>
        </thead>
        <tbody id="tableData">
        </tbody>
      </table>

    </div>
  </div>
</div>

<?php include 'footer.php'; ?>

<script>
  var frozenTable = null;

  function sortTable() {
    var table = document.getElementById("matchDataTable");
    var rows = Array.prototype.slice.call(table.querySelectorAll("tbody> tr"));
    rows.sort(function (rowA, rowB) {
      var cellA = rowA.cells[0].textContent.trim();
      var cellB = rowB.cells[0].textContent.trim();
      return (sortRows(cellA, cellB));
    });
    // Update the table body with the sorted rows.
    rows.forEach(function (row) {
      table.querySelector("tbody").appendChild(row);
    });
  }

  // Returns 0 if rowA is before rowB; else returns 1. Assumes the row has a 
  // "matchnum" key that is <prefix><number>, where prefix is "p", "qm" or "sf".
  function sortRows(cellA, cellB) {

    // Pull apart prefix and number from matchnum (ie, "p", "qm", "sf")
    var Aprefix = "";
    var Anum = "";
    var Bprefix = "";
    var Bnum = "";
    if (cellA.charAt(0) == "p") {
      Anum = cellA.substr(1, cellA.length);
      Aprefix = "p";
    }
    else if (cellA.charAt(0) == "q") {   // "qm"
      Anum = cellA.substr(2, cellA.length);
      Aprefix = "qm";
    }
    else if (cellA.charAt(0) == "s") {   // "sf"
      Anum = cellA.substr(2, cellA.length);
      Aprefix = "sf";
    }
    if (cellB.charAt(0) == "p") {
      Bnum = cellB.substr(1, cellB.length);
      Bprefix = "p";
    }
    else if (cellB.charAt(0) == "q") {   // "qm"
      Bnum = cellB.substr(2, cellB.length);
      Bprefix = "qm";
    }
    else if (cellA.charAt(0) == "s") {   // "sf"
      Bnum = cellB.substr(2, cellB.length);
      Bprefix = "sf";
    }
    if (Aprefix == Bprefix)
      return (Anum - Bnum);
    if (Aprefix == "p")
      return 0;
    if (Bprefix == "p")
      return 1;
    if (Aprefix == "qm")
      return 0;
    return 1;
  };

  // NOTE: data object keywords should match the database definition in dbHander.php
  function buildMatchDataTable(dataObj) {
    for (let i = 0; i < dataObj.length; i++) {
      var rowString = "<tr><td align=\"center\">" + dataObj[i]["matchnumber"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["teamnumber"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["autonLeave"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["autonCoralL1"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["autonCoralL2"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["autonCoralL3"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["autonCoralL4"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["autonAlgaeNet"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["autonAlgaeProcessor"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["acquiredCoral"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["acquiredAlgae"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["teleopCoralL1"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["teleopCoralL2"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["teleopCoralL3"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["teleopCoralL4"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["teleopAlgaeNet"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["teleopAlgaeProcessor"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["cageClimb"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["died"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["scoutname"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["comment"] + "</td>" +
        "</tr>";
      $("#tableData").append(rowString);

    }
  }

  function requestAPI() {
    // output: gets the API data from our server
    $.get("readAPI.php", {
      getAllData: 1
    }).done(function (data) {
      console.log("===> matchData: data = " + data);
      var dataObj = JSON.parse(data);
      console.log("===> matchData: dataObj size = " + dataObj.length);
      buildMatchDataTable(dataObj);
      setTimeout(function () {
        sorttable.makeSortable(document.getElementById("matchDataTable"));
        frozenTable = $('#freeze-table').freezeTable({
          'freezeHead': true,
          'freezeColumn': true,
          'freezeColumnHead': true,
          'scrollBar': true,
          'fixedNavbar': '.navbar',
          'scrollable': true,
          'fastMode': true,
          // 'container': '#navbar',
          'columnNum': 2,
          'columnKeep': true,
          'columnBorderWidth': 2,
          'backgroundColor': 'white',
          'frozenColVerticalOffset': 0
        });
      }, 1);
      sortTable();
    });
  }

  //
  // Process the generated html
  //
  $(document).ready(function () {
    requestAPI();

    // Keep the frozen pane updated 
    $("#matchDataTable").click(function () {
      if (frozenTable) {
        frozenTable.update();
      }
    });
  });
</script>
