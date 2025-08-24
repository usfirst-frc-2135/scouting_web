<?php
$title = 'Scout Name Data';
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
      <h5>Add New Scout Name</h5>
      <div class="input-group mb-3">
        <input id="enterScoutName" class="form-control me-2" type="text" placeholder="First name, last init."
          aria-label="Scout Name">
        <div class="input-group-append">
          <button id="addScoutName" class="btn btn-primary me-2" type="button">Add</button>
        </div>
        <div class="input-group-append">
          <button id="deleteScoutName" class="btn btn-primary" type="button">Delete</button>
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

      <table id="scoutTable" class="table table-striped table-bordered table-hover text-center sortable">
        <thead>
          <tr>
            <th class="text-start sorttable_numeric">Scout Name</th>
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

  // Build the scout name table
  function loadScoutDataTable(tableId, scoutNameList) {
    console.log("==> scoutData: loadScoutDataTable()");
    if (scoutNameList === []) {
      // console.warn("loadScoutDataTable: scoutNameList is missing!");
      return;
    }

    let tbodyRef = document.getElementById(tableId).querySelector('tbody');
    tbodyRef.innerHTML = "";
    for (let entry of scoutNameList) {
      let row = "";
      row += "<td class='text-start'>" + entry["scoutname"] + "</td>";

      tbodyRef.insertRow().innerHTML = row;
    }

    // script instructions say this is needed, but it breaks table header sorting
    sorttable.makeSortable(document.getElementById(tableId));
  }

  // Attempt to add the scout name to the scout table
  function addScoutName(tableId, scoutName) {
    console.log("==> scoutData: addScoutName()" + " " + scoutName);
    $.post("api/dbWriteAPI.php", {
      writeSingleScoutName: JSON.stringify({ "scoutname": scoutName })
    }, function (response) {
      if (response.indexOf('success') > -1) {    // A loose compare, because success word may have a newline
        // alert("Success in submitting Scout Name data! Clearing Data.");
        document.getElementById("enterScoutName").value = "";
        buildScoutTable(tableId);
      } else {
        alert("Failure in adding Scout Name data! Please Check network connectivity.");
      }
    });
  }

  // Attempt to remove the scout name from the scout table
  function deleteScoutName(tableId, scoutName) {
    console.log("==> scoutData: deleteScoutName()" + " " + scoutName);
    $.post("api/dbWriteAPI.php", {
      deleteSingleScoutName: JSON.stringify({ "scoutname": scoutName })
    }, function (response) {
      if (response.indexOf('success') > -1) {    // A loose compare, because success word may have a newline
        // alert("Success in submitting Scout Name data! Clearing Data.");
        document.getElementById("enterScoutName").value = "";
        buildScoutTable(tableId);
      } else {
        alert("Failure in removing Scout Name data! Please Check network connectivity.");
      }
    });
  }

  // Retrieve data and build scout name table
  function buildScoutTable(tableId) {
    $.get("api/dbReadAPI.php", {
      getEventScoutNames: true
    }).done(function (eventScoutNames) {
      console.log("=> eventScoutNames");
      let jScoutNames = JSON.parse(eventScoutNames);
      loadScoutDataTable(tableId, jScoutNames);
    });
  }

  /////////////////////////////////////////////////////////////////////////////
  //
  // Process the generated html
  //    Get scout names for this eventcode from TBA
  //    When all completed, generate the web page
  //
  document.addEventListener("DOMContentLoaded", function () {

    const tableId = "scoutTable";
    let scoutNameList = [];

    // Get the list of teams and add the team names 
    buildScoutTable(tableId);

    // Pressing enter in team number field attempts to save the scout name
    let input = document.getElementById("enterScoutName");
    input.addEventListener("keypress", function (event) {
      if (event.key === "Enter") {
        event.preventDefault();
        document.getElementById("addScoutName").click();
      }
    });

    // Add the scout name
    document.getElementById("addScoutName").addEventListener('click', function () {
      let scoutName = document.getElementById("enterScoutName").value.trim();
      if (scoutName != "") {
        addScoutName(tableId, scoutName);
      }
    });

    // Remove the scout name
    document.getElementById("deleteScoutName").addEventListener('click', function () {
      let scoutName = document.getElementById("enterScoutName").value.trim();
      if (scoutName != "") {
        deleteScoutName(tableId, scoutName);
      }
    });
  });

</script>
