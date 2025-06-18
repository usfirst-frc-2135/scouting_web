<?php
$title = 'Strategic Schedule';
require 'inc/header.php';
?>

<div class="container row-offcanvas row-offcanvas-left">
  <div id="content" class="column card-lg-12 col-sm-12 col-xs-12">

    <!-- Page Title -->
    <div class="row pt-3 pb-3 mb-3">
      <h2 class="col-md-4"><?php echo $title; ?></h2>

      <div class="col-2">
        <button id="reloadButton" class="btn btn-primary" type="button">Reload</button>
      </div>
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
          <tbody id="tableData">
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php include 'inc/footer.php'; ?>

<!-- Javascript page handlers -->

<script>
  function loadStrategicSchedule(dataObj) {
    console.log("==> strategicSchedule: loadStrategicSchedule()");
    $("#tableData").html(""); // Clear table
    for (let i = 0; i < dataObj.length; i++) {
      var matchNum = dataObj[i]["match_number"];
      var rowString = "<tr><td align=\"center\">" + matchNum + "</td>" +
        "<td align=\"center\">" + dataObj[i]["teams"] + "</td>" + "</td>";
      $("#tableData").append(rowString);
    }
  }

  function sortStrategicSchedule(id) {
    console.log("==> strategicSchedule: sortStrategicSchedule()");
    // Assumes the entries are team numbers or match numbers. Note a team number could have end in 
    // a "B", "C", "D", or "E", in which case we want to strip that off and just use the number for
    // the comparison.

    var table = document.getElementById(id);
    var rows = Array.prototype.slice.call(table.querySelectorAll("tbody> tr"));

    // Sort the rows based on column 1 match number value
    rows.sort(function (rowA, rowB) {
      return compareTeamNumbers(rowA.cells[0].textContent, rowB.cells[0].textContent);
    });

    // Update the table body with the sorted rows 
    rows.forEach(function (row) {
      table.querySelector("tbody").appendChild(row);
    });
  }

  // Figure out which matches and teams for strategic scouts 
  function buildScheduleTable() {
    console.log("==> strategicSchedule: buildScheduleTable()");
    $.get("api/tbaAPI.php", {
      getStrategicMatches: 1
    }).done(function (strategicData) {
      console.log("=> getStrategicMatches");
      var dataObj = JSON.parse(strategicData);
      loadStrategicSchedule(dataObj);
      sortStrategicSchedule("matchTable");
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
      console.log("=> strategicSchedule: getEventCode: " + eventCode.trim());
      $("#navbarEventCode").html(eventCode);
    });

    buildScheduleTable();

    // Create the strategic match schedule
    $("#reloadButton").click(function () {
      console.log("=> Create Schedule button clicked!");
      buildScheduleTable();
    });
  });
</script>

<script src="./scripts/compareTeamNumbers.js"></script>
