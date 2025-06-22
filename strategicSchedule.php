<?php
$title = 'Strategic Schedule';
require 'inc/header.php';
?>

<div class="container row-offcanvas row-offcanvas-left">
  <div id="content" class="column card-lg-12 col-sm-12 col-xs-12">

    <!-- Page Title -->
    <div class="row pt-3 pb-3 mb-3">
      <h2 class="col-md-4"><?php echo $title; ?></h2>
    </div>

    <!-- Main column to hold the strategic match schedule -->
    <div class="col-md-6">

      <div>
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
        <table id="matchTable" class="table table-striped table-hover sortable">
          <colgroup>
            <col span="1" style="background-color:transparent">
            <col span="1" style="background-color:#cfe2ff">
          </colgroup>
          <thead>
            <tr>
              <th class="text-center sorttable_numeric" scope="col">Match</th>
              <th class="text-center sorttable_nosort" scope="col">Teams</th>
            </tr>
          </thead>
          <tbody class="table-group-divider"> </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php include 'inc/footer.php'; ?>

<!-- Javascript page handlers -->

<script>

  const matchColumn = 0;

  // Sort strategic schedule rows by match number
  function sortStrategicSchedule(tableId) {
    console.log("==> strategicSchedule: sortStrategicSchedule()");
    // Assumes the entries are team numbers or match numbers. Note a team number could have end in 
    // a "B", "C", "D", or "E", in which case we want to strip that off and just use the number for
    // the comparison.

    let tableRef = document.getElementById(tableId);
    let rows = Array.prototype.slice.call(tableRef.querySelectorAll("tbody > tr"));

    // Sort the rows based on match number value
    rows.sort(function (rowA, rowB) {
      return compareMatchNumbers(rowA.cells[matchColumn].textContent, rowB.cells[matchColumn].textContent);
    });

    // Update the table body with the sorted rows 
    rows.forEach(function (row) {
      tableRef.querySelector("tbody").appendChild(row);
    });
  }

  // Load strategic schedule rows
  function loadStrategicSchedule(dataObj, tableId) {
    console.log("==> strategicSchedule: loadStrategicSchedule()");
    let tbodyRef = document.getElementById(tableId).querySelector('tbody');;
    tbodyRef.innerHTML = ""; // Clear Table
    for (let i = 0; i < dataObj.length; i++) {
      let matchNum = dataObj[i]["comp_level"] + dataObj[i]["match_number"];
      let rowString = "<tr><td align=\"center\">" + matchNum + "</td>" +
        "<td align=\"center\">" + dataObj[i]["teams"] + "</td>" + "</td>";
      tbodyRef.insertRow().innerHTML = rowString;
    }
  }

  // Figure out which teams/matches for strategic scouting table
  function buildScheduleTable() {
    console.log("==> strategicSchedule: buildScheduleTable()");
    $.get("api/tbaAPI.php", {
      getStrategicMatches: 1
    }).done(function (strategicData) {
      console.log("=> getStrategicMatches");
      let dataObj = JSON.parse(strategicData);
      loadStrategicSchedule(dataObj, "matchTable");
      sortStrategicSchedule("matchTable");
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
      console.log("=> strategicSchedule: getEventCode: " + eventCode);
      document.getElementById("navbarEventCode").innerHTML = eventCode;
    });

    buildScheduleTable();
  });
</script>

<script src="./scripts/compareMatchNumbers.js"></script>
