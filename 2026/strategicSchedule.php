<?php
$title = 'Strategic Schedule';
require 'inc/header.php';
?>

<div class="container row-offcanvas row-offcanvas-left">
  <div id="content" class="column card-lg-12 col-sm-12 col-xs-12">

    <!-- Page Title -->
    <div class="row pt-3 pb-3 mb-3">
      <h2 class="col-md-6"><?php echo $title; ?></h2>
    </div>

    <!-- Main column to hold the strategic match schedule -->
    <div class="col-md-6">

      <div>
        <style type="text/css" media="screen">
          thead {
            position: sticky;
            top: 56px;
            background: white;
          }
        </style>
        <table id="stratSchedTable" class="table table-striped table-bordered table-hover border-dark text-center sortable">
          <colgroup>
            <col span="1" style="background-color:transparent">
            <col span="1" style="background-color:#cfe2ff">
          </colgroup>
          <thead>
            <tr>
              <th class="sorttable_numeric" scope="col">Match</th>
              <th class="sorttable_nosort" scope="col">Teams</th>
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

  // Load strategic schedule rows
  function loadStrategicSchedule(tableId, stratSched) {
    console.log("==> strategicSchedule: loadStrategicSchedule()");
    let tbodyRef = document.getElementById(tableId).querySelector('tbody');;
    tbodyRef.innerHTML = ""; // Clear Table
    for (let i = 0; i < stratSched.length; i++) {
      let matchNum = stratSched[i]["comp_level"] + stratSched[i]["match_number"];
      let rowString = "<td>" + matchNum + "</td>" + "<td>" + stratSched[i]["teams"] + "</td>";
      tbodyRef.insertRow().innerHTML = rowString;
    }
  }

  // Figure out which teams/matches for strategic scouting table
  function buildScheduleTable(tableId) {
    console.log("==> strategicSchedule: buildScheduleTable()");
    $.get("api/tbaAPI.php", {
      getStrategicMatches: true
    }).done(function (strategicMatches) {
      console.log("=> getStrategicMatches: " + strategicMatches);
      if (strategicMatches === null) {
        return alert("Can't load strategicMatches from TBA; check if TBA Key was set in db_config");
      }
      loadStrategicSchedule(tableId, JSON.parse(strategicMatches));
      const matchColumn = 0;
      sortTableByMatch(tableId, matchColumn);
    });
  }

  /////////////////////////////////////////////////////////////////////////////
  //
  // Process the generated html
  //    Get a (calcuated) strategic schedule from our database for our matches
  //    When completed, display the web page
  //
  document.addEventListener("DOMContentLoaded", () => {

    const tableId = "stratSchedTable";

    buildScheduleTable(tableId);

  });
</script>

<script src="./scripts/compareMatchNumbers.js"></script>
<script src="./scripts/compareTeamNumbers.js"></script>
<script src="./scripts/sortFrcTables.js"></script>
