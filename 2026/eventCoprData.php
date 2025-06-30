<?php
$title = 'Event COPRs';
require 'inc/header.php';
?>

<div class="container row-offcanvas row-offcanvas-left">
  <div id="content" class="column card-lg-12 col-sm-12 col-xs-12">

    <!-- Page Title -->
    <div class="row pt-3 pb-3 mb-3">
      <h2 class="col-md-6"><?php echo $title; ?></h2>
    </div>

    <!-- Main row to hold the table -->
    <div class="row col-12 mb-3">

      <div id="freeze-table" class="freeze-table overflow-auto">
        <table id="coprTable" class="table table-striped table-bordered table-hover table-sm border-dark text-center sortable">
          <thead>
            <tr></tr>
          </thead>
          <tbody class="table-group-divider">
            <td></td>
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>

<?php include 'inc/footer.php'; ?>

<!-- Javascript page handlers -->

<script>

  const teamColumn = 0;

  // Add data keys (header fields) to COPR table in html
  function addKeysToCoprTable(tableId, keys) {
    let tableRef = document.getElementById(tableId);
    tableRef.querySelector('thead').innerHTML = ""; // Clear header
    let header = '<th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">Team</th>';
    for (let i = 0; i < keys.length; i++) {
      let color = (i % 2 == 1) ? "#cfe2ff" : "transparent";
      header += '<th scope="col" class="sorttable_numeric" style="background-color:' + color + '">' + keys[i][1] + '</th>';
    }
    // console.log("header: " + header);
    tableRef.querySelector('thead').insertRow().innerHTML = header;
  }

  // Add team data to COPR table in html
  function addDataToCoprTable(tableId, coprData, keys) {
    let tbodyRef = document.getElementById(tableId).querySelector('tbody');
    tbodyRef.innerHTML = ""; // Clear Table
    for (let teamNum in coprData) {
      let row = '<td style="background-color:#cfe2ff">' + "<a href='teamLookup.php?teamNum=" + teamNum + "'>" + teamNum + '</td>';
      for (let j = 0; j < keys.length; j++) {
        let color = (j % 2 == 1) ? "#cfe2ff" : "transparent";
        row += '<td style="background-color:' + color + '">' + coprData[teamNum][keys[j][0]] + '</td>';
      }
      // console.log("row: " + row);
      tbodyRef.insertRow().innerHTML = row;
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
  function loadCoprTable(tableId, coprData) {
    console.log("==> eventCoprData.php: loadCoprTable()");
    let jsonCoprData = JSON.parse(coprData);
    let keys = jsonCoprData["keys"];
    let data = jsonCoprData["data"];

    // Print the table then select the order in the array above
    // for (key in keys) {
    //   console.log("coprs: " + keys[i]);
    // }

    addKeysToCoprTable(tableId, coprKeys);
    addDataToCoprTable(tableId, data, coprKeys);
  }

  // Retrive OPRs from TBA and build the COPR table to display
  function buildTbaCoprTable(tableId) {
    //output: gets the COPR data from TBA
    $.get("api/tbaAPI.php", {
      getCOPRs: 1
    }).done(function (coprs) {
      console.log("=> getCOPRs");
      loadCoprTable(tableId, coprs);
      sortTableByTeam(tableId, teamColumn);
      sorttable.makeSortable(document.getElementById(tableId));
      document.getElementById(tableId).click(); // This magic fixes the floating column bug
    });
  }

  /////////////////////////////////////////////////////////////////////////////
  //
  // Process the generated html
  //
  document.addEventListener("DOMContentLoaded", () => {

    const tableId = "coprTable";

    // Update the navbar with the event code
    $.get("api/tbaAPI.php", {
      getEventCode: true
    }, function (eventCode) {
      eventCode = eventCode.trim();
      console.log("=> eventCoprData: getEventCode: " + eventCode);
      document.getElementById("navbarEventCode").innerText = eventCode;
    });

    buildTbaCoprTable(tableId);

    // Create frozen table panes and keep the panes updated
    let frozenTable = new FreezeTable('.freeze-table', { fixedNavbar: '.navbar' });
    document.getElementById(tableId).addEventListener('click', function () {
      if (frozenTable) {
        frozenTable.update();
      }
    });

    // Keep the frozen pane updated
    document.getElementById(tableId).addEventListener('click', function () {
      if (frozenTable) {
        frozenTable.update();
      }
    });

  });
</script>

<script src="./scripts/compareMatchNumbers.js"></script>
<script src="./scripts/compareTeamNumbers.js"></script>
<script src="./scripts/sortFrcTables.js"></script>
