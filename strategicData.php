<?php
$title = 'Strategic Data';
require 'inc/header.php';
?>

<div class="container row-offcanvas row-offcanvas-left">
  <div id="content" class="column card-lg-12 col-sm-12 col-xs-12">

    <!-- Page Title -->
    <div class="row pt-3 pb-3 mb-3">
      <h2><?php echo $title; ?></h2>
    </div>

    <!-- Main row to hold the strategic table -->
    <div class="row col-12 mb-3">

      <!-- <div id="freeze-table" class="freeze-table overflow-auto"> -->
      <style type="text/css" media="screen">
        thead {
          position: sticky;
          top: 56px;
          background: white;
        }
      </style>
      <table id="strategicDataTable"
        class="table table-striped table-bordered table-hover table-sm border-dark text-center sortable">
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
          <col span="1">
          <col span="1">
          <col span="1">
          <col span="1">
          <col span="1">
          <col span="1">
        </colgroup>
        <thead>
          <tr>
            <th colspan="1" style="background-color:transparent"> </th>
            <th colspan="1" style="background-color:transparent"> </th>
            <th colspan="1" style="background-color:#cfe2ff"> </th>
            <th colspan="2" style="background-color:#cfe2ff">Against Defense</th>
            <th colspan="3" style="background-color:transparent">Defense Tactics</th>
            <th colspan="8" style="background-color:#cfe2ff">Fouls</th>
            <th colspan="4" style="background-color:transparent">Auton</th>
            <th colspan="4" style="background-color:#cfe2ff">Teleop</th>
            <th colspan="2" style="background-color:transparent">Notes</th>
            <th colspan="1"> </th>
          </tr>
          <tr>
            <th scope="col" style="background-color:transparent" class="sorttable_numeric">Team</th>
            <th scope="col" style="background-color:transparent">Match</th>
            <th scope="col" style="background-color:#cfe2ff">Drive Skill</th>
            <th scope="col" style="background-color:transparent">Block</th>
            <th scope="col" style="background-color:#cfe2ff">Note</th>
            <th scope="col" style="background-color:transparent">Block Path</th>
            <th scope="col" style="background-color:#cfe2ff">Block Station</th>
            <th scope="col" style="background-color:transparent">Note</th>
            <th scope="col" style="background-color:#cfe2ff">Pin</th>
            <th scope="col" style="background-color:transparent">Auton Barge Contact</th>
            <th scope="col" style="background-color:#cfe2ff">Auton Cage Contact</th>
            <th scope="col" style="background-color:transparent">Anchor Contact</th>
            <th scope="col" style="background-color:#cfe2ff">Barge Contact</th>
            <th scope="col" style="background-color:transparent">Reef Contact</th>
            <th scope="col" style="background-color:#cfe2ff">Cage Contact</th>
            <th scope="col" style="background-color:transparent">Contact Climbing Robot</th>
            <th scope="col" style="background-color:#cfe2ff">Get Floor Coral</th>
            <th scope="col" style="background-color:transparent">Get Stn Coral</th>
            <th scope="col" style="background-color:#cfe2ff">Get Floor Algae</th>
            <th scope="col" style="background-color:transparent">Get Reef Algae</th>
            <th scope="col" style="background-color:#cfe2ff">Get Floor Coral</th>
            <th scope="col" style="background-color:transparent">Get Floor Algae</th>
            <th scope="col" style="background-color:#cfe2ff">Knock Algae</th>
            <th scope="col" style="background-color:transparent">Acquire Reef Algae</th>
            <th scope="col" style="background-color:#cfe2ff">Problem Note</th>
            <th scope="col" style="background-color:transparent">General Note</th>
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

<?php include 'inc/footer.php'; ?>

<!-- Javascript page handlers -->

<script>
  // var frozenTable = null;
  const teamColumn = 0;
  const matchColumn = 1;

  function sortStrategicTable(tableData, teamCol, matchCol) {
    console.log("==> strategicData.php: sortStrategicTable()");
    var table = document.getElementById(tableData);
    var rows = Array.prototype.slice.call(table.querySelectorAll("tbody> tr"));

    // Sort by match number
    rows.sort(function (rowA, rowB) {
      compareMatchNumbers(rowA.cells[matchCol].textContent.trim(), rowB.cells[matchCol].textContent.trim());
    });

    for (var i = 0; i < rows.length; i++)
      console.log("after match: " + i + " " + rows[i].cells[1].textContent.toString() + " " + rows[i].cells[0].textContent.toString());

    // Sort by team number
    rows.sort(function (rowA, rowB) {
      compareTeamNumbers(rowA.cells[teamCol].textContent, rowB.cells[teamCol].textContent);
    });

    for (var i = 0; i < rows.length; i++)
      console.log("after teams: " + i + " " + rows[i].cells[0].textContent.toString() + " " + rows[i].cells[1].textContent.toString());

    // Update the table body with the sorted rows 
    rows.forEach(function (row) {
      table.querySelector("tbody").appendChild(row);
    });
  }

  // Converts a given "1" to yes, "0" to no, anything else to empty string.
  function convertToYesNo(value) {
    switch (String(value)) {
      case "1": return "yes";
      case "2": return "no";
      default: return "-";
    }
  }

  function buildStrategicDataTable(dataObj, pitData) {
    console.log("==> strategicData.php: buildStrategicDataTable()");
    for (let i = 0; i < dataObj.length; i++) {
      var driveVal = "";
      switch (dataObj[i]["driverability"]) {
        case 1: driveVal = "Jerky";
        case 2: driveVal = "Slow";
        case 3: driveVal = "Average";
        case 4: driveVal = "Quick";
        default:
        case 5: driveVal = "-";
      }

      var teamNum = dataObj[i]["teamnumber"];
      var rowString = "<tr><td style=\"background-color:transparent\"><a href='teamLookup.php?teamNum=" + teamNum + "'>" + teamNum + "</td>" +
        "<td align=\"center\" style=\"background-color:transparent\">" + dataObj[i]["matchnumber"] + "</td>" +
        "<td align=\"center\" style=\"background-color:#cfe2ff\">" + driveVal + "</td>" +
        "<td align=\"center\" style=\"background-color:transparent\">" + convertToYesNo(dataObj[i]["against_tactic1"]) + "</td>" +
        "<td align=\"center\" style=\"background-color:#cfe2ff\">" + dataObj[i]["against_comment"] + "</td>" +
        "<td align=\"center\" style=\"background-color:transparent\">" + convertToYesNo(dataObj[i]["defense_tactic1"]) + "</td>" +
        "<td align=\"center\" style=\"background-color:#cfe2ff\">" + convertToYesNo(dataObj[i]["defense_tactic2"]) + "</td>" +
        "<td align=\"center\" style=\"background-color:transparent\">" + dataObj[i]["defense_comment"] + "</td>" +
        "<td align=\"center\" style=\"background-color:#cfe2ff\">" + convertToYesNo(dataObj[i]["foul1"]) + "</td>" +
        "<td align=\"center\" style=\"background-color:transparent\">" + convertToYesNo(dataObj[i]["autonFoul1"]) + "</td>" +
        "<td align=\"center\" style=\"background-color:#cfe2ff\">" + convertToYesNo(dataObj[i]["autonFoul2"]) + "</td>" +
        "<td align=\"center\" style=\"background-color:transparent\">" + convertToYesNo(dataObj[i]["teleopFoul1"]) + "</td>" +
        "<td align=\"center\" style=\"background-color:#cfe2ff\">" + convertToYesNo(dataObj[i]["teleopFoul2"]) + "</td>" +
        "<td align=\"center\" style=\"background-color:transparent\">" + convertToYesNo(dataObj[i]["teleopFoul3"]) + "</td>" +
        "<td align=\"center\" style=\"background-color:#cfe2ff\">" + convertToYesNo(dataObj[i]["teleopFoul4"]) + "</td>" +
        "<td align=\"center\" style=\"background-color:transparent\">" + convertToYesNo(dataObj[i]["endgameFoul1"]) + "</td>" +
        "<td align=\"center\" style=\"background-color:#cfe2ff\">" + convertToYesNo(dataObj[i]["autonGetCoralFromFloor"]) + "</td>" +
        "<td align=\"center\" style=\"background-color:transparent\">" + convertToYesNo(dataObj[i]["autonGetCoralFromStation"]) + "</td>" +
        "<td align=\"center\" style=\"background-color:#cfe2ff\">" + convertToYesNo(dataObj[i]["autonGetAlgaeFromFloor"]) + "</td>" +
        "<td align=\"center\" style=\"background-color:transparent\">" + convertToYesNo(dataObj[i]["autonGetAlgaeFromReef"]) + "</td>" +
        "<td align=\"center\" style=\"background-color:#cfe2ff\">" + convertToYesNo(dataObj[i]["teleopFloorPickupAlgae"]) + "</td>" +
        "<td align=\"center\" style=\"background-color:transparent\">" + convertToYesNo(dataObj[i]["teleopFloorPickupCoral"]) + "</td>" +
        "<td align=\"center\" style=\"background-color:#cfe2ff\">" + convertToYesNo(dataObj[i]["teleopKnockOffAlgaeFromReef"]) + "</td>" +
        "<td align=\"center\" style=\"background-color:transparent\">" + convertToYesNo(dataObj[i]["teleopAcquireAlgaeFromReef"]) + "</td>" +
        "<td align=\"center\" style=\"background-color:#cfe2ff\">" + dataObj[i]["problem_comment"] + "</td>" +
        "<td align=\"center\" style=\"background-color:transparent\">" + dataObj[i]["general_comment"] + "</td>" +
        "<td align=\"center\" style=\"background-color:#cfe2ff\">" + dataObj[i]["scoutname"] + "</td>" +
        "</td>";
      $("#tableData").append(rowString);
    }
  }

  // get Strategic Scouting Data
  function readStrategicDataAndBuildTable() {
    console.log("==> strategicData.php: readStrategicDataAndBuildTable()");
    $.get("api/dbReadAPI.php", {
      getAllStrategicData: 1
    }).done(function (strategicData) {
      console.log("==> getAllStrategicData");
      var dataObj = JSON.parse(strategicData);
      buildStrategicDataTable(dataObj);
      setTimeout(function () {
        // script instructions say this is needed, but it breaks table header sorting
        // sorttable.makeSortable(document.getElementById("strategicDataTable"));
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
        //   'backgroundColor': 'blue',
        //   'frozenColVerticalOffset': 0
        // });
      }, 100);
      sortStrategicTable("strategicDataTable", teamColumn, matchColumn);
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
      console.log("==> strategicData.php - getEventCode: " + eventCode);
      $("#navbarEventCode").html(eventCode);
    });

    readStrategicDataAndBuildTable();

    // Submit the strategic form data
    $("#strategicDataTable").click(function () {
      // if (frozenTable) {
      //   frozenTable.update();
      // }
    });

    // $(".table-scrollable").freezeTable({
    //   'scrollable': true,
    // });
  });
</script>

<script type="text/javascript" src="./scripts/compareMatchNumbers.js"></script>
<script type="text/javascript" src="./scripts/compareTeamNumbers.js"></script>
