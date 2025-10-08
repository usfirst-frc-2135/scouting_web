<?php
$title = 'Strategic Schedule';
require 'inc/header.php';
?>

<div class="container row-offcanvas row-offcanvas-left">
  <div id="content" class="column card-lg-12 col-sm-12 col-xs-12">

    <!-- Page Title -->
    <div class="row pt-3 pb-3 mb-3">
      <h2 class="col-md-4"><?php echo $title; ?></h2>
      <div class="col-md-4 mb-d form-check">
        <input id="showCompleted" class="form-check-input" type="checkbox" name="showCompleted" checked>
        <label for="showCompleted" class="form-check-label">Show Completed Matches</label>
      </div>
    </div>

    <!-- Main column to hold the strategic match schedule -->
    <div class="col-md-10">

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
              <th class="sorttable_nosort" scope="col">Scheduled</th>
              <th class="sorttable_nosort" scope="col">Predicted</th>
            </tr>
          </thead>
          <tbody class="table-group-divider"> </tbody>
        </table>
      </div>
    </div>

    <!-- Main row to hold the watch list card -->
    <div class="card col-md-6 mb-3">
      <div class="card-header">
        Manage Watch List <span class="text-danger fw-bold">- This affects ALL web users!</span>
      </div>
      <div class="card-body">
        <div class="input-group mb-3">
          <input id="enterTeamNumber" class="form-control me-2" type="text" placeholder="Team number" aria-label="Team Number">
          <div class="input-group-append">
            <button id="addTeamWatch" class="btn btn-success me-2" type="button">Watch</button>
          </div>
          <div class="input-group-append">
            <button id="addTeamIgnore" class="btn btn-secondary" type="button">Ignore</button>
          </div>
        </div>

        <!-- Main row to hold the table -->
        <style type="text/css" media="screen">
          thead {
            position: sticky;
            top: 56px;
            background: white;
          }
        </style>

        <table id="watchTable" class="table table-striped table-bordered table-hover text-center sortable">
          <thead>
            <tr>
              <th scope="col" class="text-start sorttable_numeric">Team Number</th>
              <th scope="col" class="sorttable_numeric">Status</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody class=" table-group-divider">
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>

<?php include 'inc/footer.php'; ?>

<!-- Javascript page handlers -->

<script>

  // Build the team watch list table
  function loadTeamWatchTable(tableId, watchId, teamWatchList) {
    console.log("==> strategicSchedule: loadTeamWatchTable()");
    if (teamWatchList === []) {
      // console.warn("loadTeamWatchTable: teamWatchList is missing!");
      return;
    }

    let tbodyRef = document.getElementById(watchId).querySelector('tbody');
    tbodyRef.innerHTML = "";
    for (let entry of teamWatchList) {
      let key = entry["teamnumber"].trim();
      let row = tbodyRef.insertRow();
      row.id = key + "_row";
      row.innerHTML = "";
      row.innerHTML += "<td class='text-start'>" + "<a href='teamLookup.php?teamNum=" + entry["teamnumber"] + "'>" + entry["teamnumber"] + "</a>" + "</td>";
      row.innerHTML += "<td>" + entry["status"] + "</td>";
      row.innerHTML += "<td> <button id='" + key + "_delete' value='" + key + "' class='btn btn-danger' type='button'>Delete</button></td>";

      // Add delete button
      document.getElementById(key + "_delete").addEventListener('click', function () {
        console.log("Deleted " + this.value);
        deleteTeamWatch(tableId, watchId, this.value);
      });
    }

    const teamColumn = 0;
    sortTableByTeam(watchId, teamColumn);
    // script instructions say this is needed, but it breaks table header sorting
    // sorttable.makeSortable(document.getElementById(watchId));
  }

  // Attempt to save the team watch status to the watch table
  function updateTeamWatch(tableId, watchId, teamNum, status) {
    console.log("==> strategicSchedule: updateTeamWatch()" + " " + teamNum + " " + status);
    $.post("api/dbWriteAPI.php", {
      writeSingleTeamWatch: JSON.stringify({ "teamnumber": teamNum, "status": status })
    }, function (response) {
      if (response.indexOf('success') > -1) {    // A loose compare, because success word may have a newline
        // alert("Success in submitting Team Watch status! Clearing Data.");
        document.getElementById("enterTeamNumber").value = "";
        buildWatchTable(tableId, watchId);
      } else {
        alert("Failure in submitting Team Watch status! Please Check network connectivity.");
      }
    });
  }

  // Attempt to remove the team watch status from the watch table
  function deleteTeamWatch(tableId, watchId, teamWatch) {
    console.log("==> strategicSchedule: deleteTeamWatch()" + " " + teamWatch);
    $.post("api/dbWriteAPI.php", {
      deleteSingleTeamWatch: JSON.stringify({ "teamwatch": teamWatch })
    }, function (response) {
      if (response.indexOf('success') > -1) {    // A loose compare, because success word may have a newline
        // alert("Success in submitting Team Watch status! Clearing Data.");
        document.getElementById("enterTeamNumber").value = "";
        buildWatchTable(tableId, watchId);
      } else {
        alert("Failure in removing Team Watch status! Please Check network connectivity.");
      }
    });
  }

  // Retrieve data and build team watch status table
  function buildWatchTable(tableId, watchId) {
    $.get("api/dbReadAPI.php", {
      getEventWatchList: true
    }).done(function (eventWatchList) {
      console.log("=> eventWatchList" + eventWatchList);
      let jWatchList = JSON.parse(eventWatchList);
      loadTeamWatchTable(tableId, watchId, jWatchList);
      buildScheduleTable(tableId, eventWatchList);
    });
  }

  // Load strategic schedule rows
  function loadStrategicSchedule(tableId, stratSched) {
    console.log("==> strategicSchedule: loadStrategicSchedule()");
    let tbodyRef = document.getElementById(tableId).querySelector('tbody');;
    tbodyRef.innerHTML = ""; // Clear Table
    for (let i = 0; i < stratSched.length; i++) {
      let matchNum = stratSched[i]["comp_level"] + stratSched[i]["match_number"];
      let matchTeams = stratSched[i]["teams"];
      let matchTime = new Date(stratSched[i]["time"] * 1000);
      let predictedTime = new Date(stratSched[i]["predicted_time"] * 1000);
      let timeNow = new Date();
      let options = { weekday: 'short', month: 'short', day: 'numeric', hour: "numeric", minute: "numeric" };
      let timeStr = matchTime.toLocaleDateString("en-us", options);
      let predStr = predictedTime.toLocaleDateString("en-us", options);
      if (matchTime < timeNow) {
        timeStr = "<del>" + timeStr + "</del>";
      }
      if (predictedTime < timeNow) {
        predStr = "<del>" + predStr + "</del>";
      }
      // Use this for testing a partial schedule, uncomment following lineand change the date/time to mid schedule
      // timeNow = new Date("2025-05-17T17:52:00");
      if (predictedTime > timeNow || document.getElementById("showCompleted").checked) {
        let rowString = "<td>" + matchNum + "</td>" + "<td>" + matchTeams + "</td>" + "<td>" + timeStr + "</td>" + "<td>" + predStr + "</td>";
        tbodyRef.insertRow().innerHTML = rowString;
      }
    }
  }

  // Figure out which teams/matches for strategic scouting table
  function buildScheduleTable(tableId, watchList) {
    console.log("==> strategicSchedule: buildScheduleTable()");
    $.get("api/tbaAPI.php", {
      getStrategicMatches: true,
      watchList: watchList
    }).done(function (strategicMatches) {
      // console.log("=> getStrategicMatches: " + strategicMatches);
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
  document.addEventListener("DOMContentLoaded", function () {

    const tableId = "stratSchedTable";
    const watchId = "watchTable";

    buildWatchTable(tableId, watchId);

    // Create the completed match filter checkbox listener
    document.getElementById("showCompleted").addEventListener('click', function () {
      buildWatchTable(tableId, watchId);
    });

    // Save the team status to watch
    document.getElementById("addTeamWatch").addEventListener('click', function () {
      let teamNum = document.getElementById("enterTeamNumber").value.trim().toUpperCase();
      if (validateTeamNumber(teamNum, null) > 0) {
        updateTeamWatch(tableId, watchId, teamNum, "watch");
      }
    });

    // Save the team status to ignore
    document.getElementById("addTeamIgnore").addEventListener('click', function () {
      let teamNum = document.getElementById("enterTeamNumber").value.trim().toUpperCase();
      if (validateTeamNumber(teamNum, null) > 0) {
        updateTeamWatch(tableId, watchId, teamNum, "ignore");
      }
    });
  });
</script>

<script src="./scripts/compareMatchNumbers.js"></script>
<script src="./scripts/compareTeamNumbers.js"></script>
<script src="./scripts/sortFrcTables.js"></script>
<script src="./scripts/validateTeamNumber.js"></script>
