<?php
$title = 'Match Data';
require 'header.php';
?>

<div class="container row-offcanvas row-offcanvas-left">
  <div id="content" class="column card-lg-12 col-sm-12 col-xs-12">

    <!-- Page Title -->
    <div class="row pt-3 pb-3 mb-3">
      <h2><?php echo $title; ?></h2>
    </div>

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

      <table id="matchDataTable" class="table table-striped table-bordered table-hover sortable">
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
          <!-- <tr>
              <th colspan="1"> </th>
              <th colspan="1"> </th>
              <th colspan="19" class="text-center">Match Scouted Data</th>
            </tr>
            <tr>
              <th colspan="1"> </th>
              <th colspan="1"> </th>
              <th colspan="19" class="text-center">Table</th>
            </tr> -->
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

      <!-- </div> -->
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>

<!-- Javascript page handlers -->

<script>
  var frozenTable = null;

  function sortTable() {
    var table = document.getElementById("matchDataTable");
    var rows = Array.prototype.slice.call(table.querySelectorAll("tbody> tr"));
    rows.sort(function (rowA, rowB) {
      return (compareMatchNumbers(rowA.cells[0].textContent.trim(), rowB.cells[0].textContent.trim()));
    });
    // Update the table body with the sorted rows.
    rows.forEach(function (row) {
      table.querySelector("tbody").appendChild(row);
    });
  }

  // NOTE: data object keywords should match the database definition in dbHander.php
  function buildMatchDataTable(dataObj) {
    console.log("==> matchData.php: buildMatchDataTable()");
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

  function readMatchDataAndBuildTable() {
    console.log("==> matchData.php: readMatchDataAndBuildTable()");
    // output: gets the API data from our server
    $.get("api/readAPI.php", {
      getAllMatchData: 1
    }).done(function (matchData) {
      console.log("===> getAllMatchData:\n" + matchData);
      var dataObj = JSON.parse(matchData);
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
      }, 100);
      sortTable();
    });
  }

  //
  // Process the generated html
  //
  $(document).ready(function () {
    // Update the navbar with the event code
    $.get("api/tbaAPI.php", {
      getEventCode: true
    }, function (eventCode) {
      console.log("==> matchData.php - getEventCode: " + eventCode);
      $("#navbarEventCode").html(eventCode);
    });

    readMatchDataAndBuildTable();

    // Keep the frozen pane updated 
    $("#matchDataTable").click(function () {
      if (frozenTable) {
        frozenTable.update();
      }
    });
  });
</script>

<script type="text/javascript" src="./scripts/compareMatchNumbers.js"></script>
