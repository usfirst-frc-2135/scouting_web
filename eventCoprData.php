<?php
$title = 'Event COPRs';
require 'header.php';
?>

<div class="container row-offcanvas row-offcanvas-left">
  <div id="content" class="column card-lg-12 col-sm-12 col-xs-12">

    <!-- Page Title -->
    <div class="row pt-3 pb-3 mb-3">
      <h2 id="COPRHeader" class="col-4"><?php echo $title; ?></h2>

      <div class="col-2">
        <button id="reloadEvent" class="btn btn-primary" type="button">Reload COPRs</button>
      </div>
    </div>

    <!-- Main row to hold the table -->
    <div class="row col-12 mb-3">

      <!-- <div id="freeze-table" class="freeze-table"> -->
      <style type="text/css" media="screen">
        thead {
          position: sticky;
          top: 56px;
          background: white;
        }

        /* th:first-child,
        td:first-child,
        tr {
          position: sticky;
          left: 0px;
          z-index: 1;
          background: rgba(255, 255, 255, 1);
        } */
      </style>
      <table id="coprTable" class="table table-striped table-bordered table-hover table-sm border-dark text-center sortable">
        <thead>
          <tr id="tableKeys"></tr>
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
  // var _frozenTable = null;

  const teamColumn = 0;

  // Sort the generated COPR table by team/match numbers
  function sortCoprTable(tableData, teamCol) {
    console.log("==> matchData.php: sortCoprTable()");
    var table = document.getElementById(tableData);
    var rows = Array.prototype.slice.call(table.querySelectorAll("tbody> tr"));

    // Sort the rows based on column 1 match number
    rows.sort(function (rowA, rowB) {
      return (compareTeamNumbers(rowA.cells[teamCol].textContent.trim(), rowB.cells[teamCol].textContent.trim()));
    });

    // Update the table body with the sorted rows.
    rows.forEach(function (row) {
      table.querySelector("tbody").appendChild(row);
    });
  }

  // Add team data to COPR table in html
  function addDataToCoprTable(coprData, keys) {
    $("#tableData").html("");
    for (let teamNum in coprData) {
      var row = '<tr>';
      row += '<td>' + teamNum + '</td>';
      for (let j = 0; j < keys.length; j++) {
        row += '<td>' + coprData[teamNum][keys[j]] + '</td>';
      }
      row += '</tr>';
      $("#tableData").append(row);
    }
  }

  // Add data keys (fields) to COPR table in html
  function addKeysToCoprTable(keys) {
    var header = '<th scope="col">Team</th>';
    for (let i = 0; i < keys.length; i++) {
      header += '<th scope="col">' + keys[i] + '</th>'
    }
    $("#tableKeys").html(header);
  }

  // Add data keys (fields) to COPR table in html
  function buildCoprTable(coprData) {
    console.log("==> eventCoprData.php: buildCoprTable()");
    var jsonCoprData = JSON.parse(coprData);
    var keys = jsonCoprData["keys"];
    var data = jsonCoprData["data"];

    addKeysToCoprTable(keys);
    addDataToCoprTable(data, keys);
  }

  // Retrive OPRs from TBA and build the COPR table to display
  function getTbaAndBuildCoprTable() {
    //output: gets the COPR data from TBA
    $.get("api/tbaAPI.php", {
      getCOPRs: 1
    }).done(function (getCoprData) {
      console.log("==> getCOPRs");
      buildCoprTable(getCoprData);
      setTimeout(function () {
        // script instructions say this is needed, but it breaks table header sorting
        sorttable.makeSortable(document.getElementById("coprTable"));
        _frozenTable = $('#freeze-table').freezeTable({
          'freezeHead': true,
          'freezeColumn': true,
          'freezeColumnHead': true,
          'scrollBar': true,
          'fixedNavbar': '.navbar',
          'scrollable': true,
          'fastMode': true,
          // 'container': '#navbar',
          'columnNum': 1,
          'columnKeep': true,
          'columnBorderWidth': 2,
          'backgroundColor': 'blue',
          'frozenColVerticalOffset': 0
        });
      }, 500);
      sortCoprTable("coprTable", teamColumn);
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
      console.log("==> eventCoprData.php - getEventCode: " + eventCode);
      $("#navbarEventCode").html(eventCode);
    });

    getTbaAndBuildCoprTable();

    $("#reloadEvent").click(function () {
      getTbaAndBuildCoprTable();
    });

    // Keep the frozen pane updated 
    // $("#coprTable").click(function () {
    // if (_frozenTable) {
    //   _frozenTable.update();
    // }
    // });

  });
</script>

<script type="text/javascript" src="./scripts/compareTeamNumbers.js"></script>
