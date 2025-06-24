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
        <tbody class="table-group-divider"> </tbody>
      </table>

      <!-- </div> -->
    </div>
  </div>
</div>

<?php include 'inc/footer.php'; ?>

<!-- Javascript page handlers -->

<script>

  // let frozenTable = null;
  const teamColumn = 0;
  const matchColumn = 1;

  // Sort strategic data table rows
  function sortStrategicData(tableId, teamCol, matchCol) {
    console.log("==> strategicData: sortStrategicData()");
    let tableRef = document.getElementById(tableId);
    let rows = Array.prototype.slice.call(tableRef.querySelectorAll("tbody > tr")); // All "tr" in <tbody>

    // Sort by match number
    rows.sort(function (rowA, rowB) {
      return compareMatchNumbers(rowA.cells[matchCol].textContent, rowB.cells[matchCol].textContent);
    });

    // Sort by team number
    rows.sort(function (rowA, rowB) {
      return compareTeamNumbers(rowA.cells[teamCol].textContent, rowB.cells[teamCol].textContent);
    });

    // Update the table body with the sorted rows 
    rows.forEach(function (row) {
      tableRef.querySelector("tbody").appendChild(row);
    });
  }

  // Converts a given "1" to yes, "2" to no, anything else to a dash.
  function toYesNo(value) {
    switch (String(value)) {
      case "1": return "Yes";
      case "2": return "No";
      default: return "-";
    }
  }

  // Load the strategic data into the table
  function loadStrategicData(dataObj) {
    console.log("==> strategicData: loadStrategicData()");
    let tbodyRef = document.getElementById("strategicDataTable").querySelector('tbody');
    tbodyRef.innerHTML = "";   // Clear Table

    for (let i = 0; i < dataObj.length; i++) {
      let driveVal = "";
      switch (dataObj[i]["driverability"]) {
        case 1: driveVal = "Jerky"; break;
        case 2: driveVal = "Slow"; break;
        case 3: driveVal = "Average"; break;
        case 4: driveVal = "Quick"; break;
        default:
        case 5: driveVal = "-"; break;
      }

      let teamNum = dataObj[i]["teamnumber"];
      let rowString = "<td style=\"background-color:transparent\"><a href='teamLookup.php?teamNum=" + teamNum + "'>" + teamNum + "</td>" +
        "<td style=\"background-color:transparent\">" + dataObj[i]["matchnumber"] + "</td>" +
        "<td style=\"background-color:#cfe2ff\">" + driveVal + "</td>" +
        "<td style=\"background-color:transparent\">" + toYesNo(dataObj[i]["against_tactic1"]) + "</td>" +
        "<td style=\"background-color:#cfe2ff\">" + dataObj[i]["against_comment"] + "</td>" +
        "<td style=\"background-color:transparent\">" + toYesNo(dataObj[i]["defense_tactic1"]) + "</td>" +
        "<td style=\"background-color:#cfe2ff\">" + toYesNo(dataObj[i]["defense_tactic2"]) + "</td>" +
        "<td style=\"background-color:transparent\">" + dataObj[i]["defense_comment"] + "</td>" +
        "<td style=\"background-color:#cfe2ff\">" + toYesNo(dataObj[i]["foul1"]) + "</td>" +
        "<td style=\"background-color:transparent\">" + toYesNo(dataObj[i]["autonFoul1"]) + "</td>" +
        "<td style=\"background-color:#cfe2ff\">" + toYesNo(dataObj[i]["autonFoul2"]) + "</td>" +
        "<td style=\"background-color:transparent\">" + toYesNo(dataObj[i]["teleopFoul1"]) + "</td>" +
        "<td style=\"background-color:#cfe2ff\">" + toYesNo(dataObj[i]["teleopFoul2"]) + "</td>" +
        "<td style=\"background-color:transparent\">" + toYesNo(dataObj[i]["teleopFoul3"]) + "</td>" +
        "<td style=\"background-color:#cfe2ff\">" + toYesNo(dataObj[i]["teleopFoul4"]) + "</td>" +
        "<td style=\"background-color:transparent\">" + toYesNo(dataObj[i]["endgameFoul1"]) + "</td>" +
        "<td style=\"background-color:#cfe2ff\">" + toYesNo(dataObj[i]["autonGetCoralFromFloor"]) + "</td>" +
        "<td style=\"background-color:transparent\">" + toYesNo(dataObj[i]["autonGetCoralFromStation"]) + "</td>" +
        "<td style=\"background-color:#cfe2ff\">" + toYesNo(dataObj[i]["autonGetAlgaeFromFloor"]) + "</td>" +
        "<td style=\"background-color:transparent\">" + toYesNo(dataObj[i]["autonGetAlgaeFromReef"]) + "</td>" +
        "<td style=\"background-color:#cfe2ff\">" + toYesNo(dataObj[i]["teleopFloorPickupAlgae"]) + "</td>" +
        "<td style=\"background-color:transparent\">" + toYesNo(dataObj[i]["teleopFloorPickupCoral"]) + "</td>" +
        "<td style=\"background-color:#cfe2ff\">" + toYesNo(dataObj[i]["teleopKnockOffAlgaeFromReef"]) + "</td>" +
        "<td style=\"background-color:transparent\">" + toYesNo(dataObj[i]["teleopAcquireAlgaeFromReef"]) + "</td>" +
        "<td style=\"background-color:#cfe2ff\">" + dataObj[i]["problem_comment"] + "</td>" +
        "<td style=\"background-color:transparent\">" + dataObj[i]["general_comment"] + "</td>" +
        "<td style=\"background-color:#cfe2ff\">" + dataObj[i]["scoutname"] + "</td>";
      tbodyRef.insertRow().innerHTML = rowString;
    }
  }

  // Retrive strategic scouting data and load the table
  function buildStrategicDataTable() {
    console.log("==> strategicData: buildStrategicDataTable()");
    $.get("api/dbReadAPI.php", {
      getAllStrategicData: 1
    }).done(function (strategicData) {
      console.log("=> getAllStrategicData");
      let dataObj = JSON.parse(strategicData);
      loadStrategicData(dataObj);
      sortStrategicData("strategicDataTable", teamColumn, matchColumn);
      // setTimeout(function () {
      //   // sorttable.makeSortable(document.getElementById("myTable"))      // Already sortable
      //   // _frozenTable = $('#freeze-table').freezeTable({});              // Still investigating
      // }, 1);
    });
  }

  /////////////////////////////////////////////////////////////////////////////
  //
  // Process the generated html
  //
  document.addEventListener("DOMContentLoaded", () => {

    // Update the navbar with the event code
    $.get("api/tbaAPI.php", {
      getEventCode: true
    }, function (eventCode) {
      eventCode = eventCode.trim();
      console.log("=> stategicData: getEventCode: " + eventCode);
      document.getElementById("navbarEventCode").innerHTML = eventCode;
    });

    buildStrategicDataTable();

    // Submit the strategic form data
    // document.getElementById("strategicDataTable").addEventListener('click', function () {
    //     // if (frozenTable) {
    //     frozenTable.update();
    //   }

    // $('.table-scrollable').freezeTable({
    //   'scrollable': true,
    // });
  });
</script>

<script src="./scripts/compareMatchNumbers.js"></script>
<script src="./scripts/compareTeamNumbers.js"></script>
