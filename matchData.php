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
    <div class="row col-12 mb-3">

      <!-- <div id="freeze-table" class="freeze-table overflow-auto"> -->
      <style type="text/css" media="screen">
        thead {
          position: sticky;
          top: 56px;
          background: white;
        }
      </style>
      <table id="matchDataTable" class="table table-striped table-bordered table-hover table-sm border-dark text-center sortable">
        <colgroup>
          <col span="2">
          <col span="1">
          <col span="1">
          <col span="1">
          <col span="1">
          <col span="1">
          <col span="1">
          <col span="1">
          <col span="1">
          <col span="1">
          <col span="1">
          <col span="1">
          <col span="1">
          <col span="1">
          <col span="1">
          <col span="1">
          <col span="1">
          <col span="1">
          <col span="1">
        </colgroup>
        <thead>
          <tr>
            <th scope="col" style="background-color:transparent">Match</th>
            <th scope="col" style="background-color:transparent" class="sorttable_numeric">Team</th>
            <th scope="col" style="background-color:#cfe2ff">Auton Leave</th>
            <th scope="col" style="background-color:transparent">Auton Coral L1</th>
            <th scope="col" style="background-color:#cfe2ff">Auton Coral L2</th>
            <th scope="col" style="background-color:transparent">Auton Coral L3</th>
            <th scope="col" style="background-color:#cfe2ff">Auton Coral L4</th>
            <th scope="col" style="background-color:transparent">Auton Algae Net</th>
            <th scope="col" style="background-color:#cfe2ff">Auton Algae Proc</th>
            <th scope="col" style="background-color:transparent">Acq'd Coral</th>
            <th scope="col" style="background-color:#cfe2ff">Acq'd Algae</th>
            <th scope="col" style="background-color:transparent">Teleop Coral L1</th>
            <th scope="col" style="background-color:#cfe2ff">Teleop Coral L2</th>
            <th scope="col" style="background-color:transparent">Teleop Coral L3</th>
            <th scope="col" style="background-color:#cfe2ff">Teleop Coral L4</th>
            <th scope="col" style="background-color:transparent">Teleop Algae Net</th>
            <th scope="col" style="background-color:#cfe2ff">Teleop Algae Proc</th>
            <th scope="col" style="background-color:transparent">Cage Climb</th>
            <th scope="col" style="background-color:#cfe2ff">Died</th>
            <th scope="col" style="background-color:transparent">Comment</th>
            <th scope="col" style="background-color:#cfe2ff">Scout Name</th>
          </tr>
        </thead>
        <tbody id="tableData" class="table-group-divider">
        </tbody>
      </table>
      <!-- </div> -->

    </div>
  </div>
</div>

<?php include 'footer.php'; ?>

<!-- Javascript page handlers -->

<script>
  // var frozenTable = null;  // doesn't work with table-responsive
  const team = 1;

  function sortTable(tableData, index) {
    console.log("==> matchData.php: sortTable()");
    var table = document.getElementById(tableData);
    var rows = Array.prototype.slice.call(table.querySelectorAll("tbody> tr"));

    // Sort the rows based on column 1 match number
    rows.sort(function (rowA, rowB) {
      return (compareMatchNumbers(rowA.cells[index].textContent.trim(), rowB.cells[index].textContent.trim()));
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
      var rowString = "<tr><td align=\"center\" style=\"background-color:transparent\">" + dataObj[i]["matchnumber"] + "</td>" +
        "<td align=\"center\" style=\"background-color:transparent\">" + dataObj[i]["teamnumber"] + "</td>" +
        "<td align=\"center\" style=\"background-color:#cfe2ff\">" + dataObj[i]["autonLeave"] + "</td>" +
        "<td align=\"center\" style=\"background-color:transparent\">" + dataObj[i]["autonCoralL1"] + "</td>" +
        "<td align=\"center\" style=\"background-color:#cfe2ff\">" + dataObj[i]["autonCoralL2"] + "</td>" +
        "<td align=\"center\" style=\"background-color:transparent\">" + dataObj[i]["autonCoralL3"] + "</td>" +
        "<td align=\"center\" style=\"background-color:#cfe2ff\">" + dataObj[i]["autonCoralL4"] + "</td>" +
        "<td align=\"center\" style=\"background-color:transparent\">" + dataObj[i]["autonAlgaeNet"] + "</td>" +
        "<td align=\"center\" style=\"background-color:#cfe2ff\">" + dataObj[i]["autonAlgaeProcessor"] + "</td>" +
        "<td align=\"center\" style=\"background-color:transparent\">" + dataObj[i]["acquiredCoral"] + "</td>" +
        "<td align=\"center\" style=\"background-color:#cfe2ff\">" + dataObj[i]["acquiredAlgae"] + "</td>" +
        "<td align=\"center\" style=\"background-color:transparent\">" + dataObj[i]["teleopCoralL1"] + "</td>" +
        "<td align=\"center\" style=\"background-color:#cfe2ff\">" + dataObj[i]["teleopCoralL2"] + "</td>" +
        "<td align=\"center\" style=\"background-color:transparent\">" + dataObj[i]["teleopCoralL3"] + "</td>" +
        "<td align=\"center\" style=\"background-color:#cfe2ff\">" + dataObj[i]["teleopCoralL4"] + "</td>" +
        "<td align=\"center\" style=\"background-color:transparent\">" + dataObj[i]["teleopAlgaeNet"] + "</td>" +
        "<td align=\"center\" style=\"background-color:#cfe2ff\">" + dataObj[i]["teleopAlgaeProcessor"] + "</td>" +
        "<td align=\"center\" style=\"background-color:transparent\">" + dataObj[i]["cageClimb"] + "</td>" +
        "<td align=\"center\" style=\"background-color:#cfe2ff\">" + dataObj[i]["died"] + "</td>" +
        "<td align=\"center\" style=\"background-color:transparent\">" + dataObj[i]["scoutname"] + "</td>" +
        "<td align=\"center\" style=\"background-color:#cfe2ff\">" + dataObj[i]["comment"] + "</td>" +
        "</tr>";
      $("#tableData").append(rowString);

    }
  }

  // get Match Scouting Data
  function readMatchDataAndBuildTable() {
    console.log("==> matchData.php: readMatchDataAndBuildTable()");
    $.get("api/readAPI.php", {
      getAllMatchData: 1
    }).done(function (matchData) {
      console.log("===> getAllMatchData:\n" + matchData);
      var dataObj = JSON.parse(matchData);
      buildMatchDataTable(dataObj);
      setTimeout(function () {
        // script instructions say this is needed, but it breaks table header sorting
        // sorttable.makeSortable(document.getElementById("matchDataTable"));
        //
        // freeze-table doesn't work with table-responsive
        // frozenTable = $('#freeze-table').freezeTable({
        //   'freezeHead': true,
        //   'freezeColumn': true,
        //   'freezeColumnHead': true,
        //   'scrollBar': true,
        //   'fixedNavbar': '.navbar',
        //   'scrollable': true,
        //   'fastMode': true,
        //   // 'container': '#navbar',
        //   'columnNum': 2,
        //   'columnKeep': true,
        //   'columnBorderWidth': 2,
        //   'backgroundColor': 'white',
        //   'frozenColVerticalOffset': 0
        // });
      }, 100);
      sortTable("matchDataTable", team);
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
      // if (frozenTable) {
      //   frozenTable.update();
      // }
    });
  });
</script>

<script type="text/javascript" src="./scripts/compareMatchNumbers.js"></script>
