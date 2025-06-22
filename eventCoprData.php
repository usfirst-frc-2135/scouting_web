<?php
$title = 'Event COPRs';
require 'inc/header.php';
?>

<div class="container row-offcanvas row-offcanvas-left">
  <div id="content" class="column card-lg-12 col-sm-12 col-xs-12">

    <!-- Page Title -->
    <div class="row pt-3 pb-3 mb-3">
      <h2 id="COPRHeader" class="col-4"><?php echo $title; ?></h2>
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
      </style>
      <table id="coprTable" class="table table-striped table-bordered table-hover table-sm border-dark text-center sortable">
        <thead>
          <tr id="tableKeys"></tr>
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

  // let _frozenTable = null;

  const teamColumn = 0;

  // Sort the generated COPR table by team/match numbers
  function sortCoprTable(tableData, teamCol) {
    console.log("==> eventCoprData.php: sortCoprTable()");
    let tableRef = document.getElementById(tableData);
    let rows = Array.prototype.slice.call(tableRef.querySelectorAll("tbody> tr"));

    // Sort the rows based on column 1 match number
    rows.sort(function (rowA, rowB) {
      return (compareTeamNumbers(rowA.cells[teamCol].textContent.trim(), rowB.cells[teamCol].textContent.trim()));
    });

    // Update the table body with the sorted rows.
    rows.forEach(function (row) {
      tableRef.querySelector("tbody").appendChild(row);
    });
  }

  // Add data keys (fields) to COPR table in html
  function addKeysToCoprTable(keys) {
    let header = '<th scope="col">Team</th>';
    for (let i = 0; i < keys.length; i++) {
      header += '<th scope="col">' + keys[i][1] + '</th>'
    }
    document.getElementById("tableKeys").innerHTML = header;
  }

  // Add team data to COPR table in html
  function addDataToCoprTable(coprData, keys) {
    let tableRef = document.getElementById("coprTable");
    tableRef.querySelector('tbody').innerHTML = ""; // Clear Table
    for (let teamNum in coprData) {
      let row = '<tr>';
      row += '<td>' + "<a href='teamLookup.php?teamNum=" + teamNum + "'>" + teamNum + '</td>';
      for (let j = 0; j < keys.length; j++) {
        row += '<td>' + coprData[teamNum][keys[j][0]] + '</td>';
      }
      row += '</tr>';
      tableRef.querySelector('tbody').insertRow().innerHTML = row;
    }
  }

  // This table controls the order and header names for the COPR table
  // First column matches TBA keys for a match breakdown, column two is a preferred header name
  const coprKeys =
    [["rp", "RP"],
    ["totalPoints", "Total Pts"],
    ["autoPoints", "Auto Pts"],
    ["autoMobilityPoints", "Leave"],
    ["autoCoralPoints", "Auto Coral Pts"],
    ["autoCoralCount", "Auto Coral Ct"],
    ["teleopPoints", "Teleop Pts"],
    ["teleopCoralPoints", "Teleop Coral Pts"],
    ["teleopCoralCount", "Teleop Coral Ct"],
    ["algaePoints", "Algae Pts"],
    ["wallAlgaeCount", "Wall Algae Ct"],
    ["netAlgaeCount", "Net Algae Ct"],
    ["endGameBargePoints", "Climb Pts"],
    ["foulPoints", "Foul Pts"],
    ["foulCount", "Foul Ct"],
    ["techFoulCount", "Tech Foul Ct"]
    ];

  // Add data keys (fields) to COPR table in html
  function loadCoprTable(coprData) {
    console.log("==> eventCoprData.php: loadCoprTable()");
    let jsonCoprData = JSON.parse(coprData);
    let keys = jsonCoprData["keys"];
    let data = jsonCoprData["data"];

    // Print the table then select the order in the array above
    // for (key in keys) {
    //   console.log("coprs: " + keys[i]);
    // }

    addKeysToCoprTable(coprKeys);
    addDataToCoprTable(data, coprKeys);
  }

  // Retrive OPRs from TBA and build the COPR table to display
  function buildTbaCoprTable() {
    //output: gets the COPR data from TBA
    $.get("api/tbaAPI.php", {
      getCOPRs: 1
    }).done(function (coprs) {
      console.log("=> getCOPRs");
      loadCoprTable(coprs);
      setTimeout(function () {
        // script instructions say this is needed, but it breaks table header sorting
        // sorttable.makeSortable(document.getElementById("coprTable"));
        // _frozenTable = $('#freeze-table').freezeTable({
        //   'freezeHead': true,
        //   'freezeColumn': true,
        //   'freezeColumnHead': true,
        //   'scrollBar': true,
        //   'fixedNavbar': '.navbar',
        //   'scrollable': true,
        //   'fastMode': true,
        //   // 'container': '#navbar',
        //   'columnNum': 1,
        //   'columnKeep': true,
        //   'columnBorderWidth': 2,
        //   'backgroundColor': 'blue',
        //   'frozenColVerticalOffset': 0
        // });
      }, 500);
      sortCoprTable("coprTable", teamColumn);
    });
  }

  //
  // Process the generated html
  //
  document.addEventListener("DOMContentLoaded", () => {

    // Update the navbar with the event code
    $.get("api/tbaAPI.php", {
      getEventCode: true
    }, function (eventCode) {
      eventCode = eventCode.trim();
      console.log("=> eventCoprData: getEventCode: " + eventCode);
      document.getElementById("navbarEventCode").innerHTML = eventCode;
    });

    buildTbaCoprTable();

    // Keep the frozen pane updated 
    // document.getElementById("coprTable").addEventListener('click', function () {
    // if (_frozenTable) {
    //   _frozenTable.update();
    // }
    // });

  });
</script>

<script src="./scripts/compareTeamNumbers.js"></script>
