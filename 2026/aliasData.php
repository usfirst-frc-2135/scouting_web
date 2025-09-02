<?php
$title = 'Alias Data';
require 'inc/header.php';
?>

<div class="container row-offcanvas row-offcanvas-left">
  <div id="content" class="column card-lg-12  col-sm-12 col-xs-12">

    <!-- Page Title -->
    <div class="row pt-3 pb-3 mb-3">
      <h2 class="col-md-6"><?php echo $title; ?></h2>
    </div>

    <!-- Main row to hold the entry card -->
    <div class="row col-md-6 mb-3">
      <h5>Add New Alias</h5>
      <div class="input-group mb-3">
        <input id="enterTeamNumber" class="form-control me-2" type="text" placeholder="Team number" aria-label="Team Number">
        <input id="enterAliasNumber" class="form-control me-2" type="text" placeholder="Alias number" aria-label="Alias Number">
        <div class="input-group-append">
          <button id="addTeamAlias" class="btn btn-primary me-2" type="button">Add</button>
        </div>
        <div class="input-group-append">
          <button id="deleteTeamAlias" class="btn btn-primary me-2" type="button">Delete</button>
        </div>
        <div class="input-group-append">
          <button id="writeTeamAliasJSON" class="btn btn-primary" type="button">Write File</button>
        </div>
      </div>
    </div>


    <!-- Main row to hold the table -->
    <div class="row col-md-6 mb-3">
      <style type="text/css" media="screen">
        thead {
          position: sticky;
          top: 56px;
          background: white;
        }
      </style>

      <table id="aliasTable" class="table table-striped table-bordered table-hover text-center sortable">
        <thead>
          <tr>
            <th class="text-start sorttable_numeric">Team Number</th>
            <th>Team Alias</th>
          </tr>
        </thead>
        <tbody class=" table-group-divider">
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php include 'inc/footer.php'; ?>

<!-- Javascript page handlers -->

<script>

  // Build the team alias table
  function loadAliasDataTable(tableId, teamAliasList) {
    console.log("==> aliasData: loadAliasDataTable()");
    if (teamAliasList === []) {
      // console.warn("loadAliasDataTable: teamAliasList is missing!");
      return;
    }

    let tbodyRef = document.getElementById(tableId).querySelector('tbody');
    tbodyRef.innerHTML = "";
    for (let entry of teamAliasList) {
      let row = "";
      row += "<td class='text-start'>" + "<a href='teamLookup.php?teamNum=" + entry["teamnumber"] + "'>" + entry["teamnumber"] + "</a>";
      row += "</td>";
      row += "<td>" + entry["aliasnumber"] + "</td>";

      tbodyRef.insertRow().innerHTML = row;
    }

    const teamColumn = 0;
    sortTableByTeam(tableId, teamColumn);
    // script instructions say this is needed, but it breaks table header sorting
    // sorttable.makeSortable(document.getElementById(tableId));
  }

  // Attempt to save the team alias to the alias table
  function addTeamAlias(tableId, teamNum, alias) {
    console.log("==> aliasData: addTeamAlias()" + " " + teamNum + " " + alias);
    $.post("api/dbWriteAPI.php", {
      writeSingleTeamAlias: JSON.stringify({ "teamnumber": teamNum, "aliasnumber": alias })
    }, function (response) {
      if (response.indexOf('success') > -1) {    // A loose compare, because success word may have a newline
        // alert("Success in submitting Team Alias data! Clearing Data.");
        document.getElementById("enterTeamNumber").value = "";
        document.getElementById("enterAliasNumber").value = "";
        buildAliasTable(tableId);
      } else {
        alert("Failure in submitting Team Alias data! Please Check network connectivity.");
      }
    });
  }

  // Attempt to remove the team alias from the alias table
  function deleteTeamAlias(tableId, teamAlias) {
    console.log("==> aliasData: deleteTeamAlias()" + " " + teamAlias);
    $.post("api/dbWriteAPI.php", {
      deleteSingleTeamAlias: JSON.stringify({ "teamalias": teamAlias })
    }, function (response) {
      if (response.indexOf('success') > -1) {    // A loose compare, because success word may have a newline
        // alert("Success in submitting Team Alias data! Clearing Data.");
        document.getElementById("enterTeamNumber").value = "";
        document.getElementById("enterAliasNumber").value = "";
        buildAliasTable(tableId);
      } else {
        alert("Failure in removing Team Alias data! Please Check network connectivity.");
      }
    });
  }

  // Retrieve team aliases and write out file
  function writeTeamAliasFile(tableId, fileName) {
    console.log("==> aliasData: writeTeamAliasFile()");
    jsonTable = tableToJSON(tableId);
    console.log(jsonTable);

    $.post("api/dbAPI.php", {
      writeTeamAliasJSON: JSON.stringify(jsonTable),
      filename: fileName
    }, function (dbStatus) {
      console.log("=> writeTeamAliasFile");
    });
  }

  // Retrieve data and build team and alias table
  function buildAliasTable(tableId) {
    $.get("api/dbReadAPI.php", {
      getEventAliasNames: true
    }).done(function (eventAliasNames) {
      console.log("=> eventAliasNames");
      let jAliasNames = JSON.parse(eventAliasNames);
      loadAliasDataTable(tableId, jAliasNames);
    });
  }

  /////////////////////////////////////////////////////////////////////////////
  //
  // Process the generated html
  //    Get team list and aliases for this eventcode from TBA
  //    When all completed, generate the web page
  //
  document.addEventListener("DOMContentLoaded", function () {

    const tableId = "aliasTable";
    let teamAliasList = [];
    const teamAliasFileName = "../json/teamAliases.json";

    // Get the list of teams and add the team names 
    buildAliasTable(tableId);

    // Pressing enter in team number field attempts to save the alias
    let teamInput = document.getElementById("enterTeamNumber");
    teamInput.addEventListener("keypress", function (event) {
      if (event.key === "Enter") {
        event.preventDefault();
        document.getElementById("addTeamAlias").click();
      }
    });

    // Pressing enter in alias number field attempts to save the alias
    let aliasInput = document.getElementById("enterAliasNumber");
    aliasInput.addEventListener("keypress", function (event) {
      if (event.key === "Enter") {
        event.preventDefault();
        document.getElementById("addTeamAlias").click();
      }
    });

    // Save the team alias for the number entered
    document.getElementById("addTeamAlias").addEventListener('click', function () {
      let teamNum = document.getElementById("enterTeamNumber").value.trim();
      let aliasNum = document.getElementById("enterAliasNumber").value.trim();
      if (validateTeamNumber(teamNum, null) > 0 && validateTeamNumber(aliasNum, null) > 0) {
        addTeamAlias(tableId, teamNum, aliasNum);
      }
    });

    // Remove the team alias
    document.getElementById("deleteTeamAlias").addEventListener('click', function () {
      let teamAlias = document.getElementById("enterTeamNumber").value.trim();
      if (teamAlias != "") {
        deleteTeamAlias(tableId, teamAlias);
      }
    });

    // Write out team alias JSON file to server folder
    document.getElementById("writeTeamAliasJSON").addEventListener('click', function () {
      writeTeamAliasFile(tableId, teamAliasFileName);
    });
  });

</script>

<script src="./scripts/compareMatchNumbers.js"></script>
<script src="./scripts/compareTeamNumbers.js"></script>
<script src="./scripts/sortFrcTables.js"></script>
<script src="./scripts/tableToJSON.js"></script>
<script src="./scripts/validateTeamNumber.js"></script>
