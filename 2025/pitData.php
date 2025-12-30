<?php
$title = 'Pit Data';
require 'inc/header.php';
?>

<div class="container row-offcanvas row-offcanvas-left">
  <div id="content" class="column card-lg-12 col-sm-12 col-xs-12">

    <!-- Page Title -->
    <div class="row pt-3 mb-3">
      <h2 class="col-md-6 mb-3 me-3"><?php echo $title; ?> </h2>
    </div>

    <!-- Main row to hold the table -->
    <div class="row col-12 mb-3">

      <div id="freeze-table" class="freeze-table overflow-auto">
        <table id="pitDataTable" class="table table-striped table-bordered table-hover table-sm border-secondary text-center">
          <thead class="z-3"> </thead>
          <tbody class="table-group-divider"> </tbody>
        </table>
      </div>

    </div>
  </div>
</div>

<?php include 'inc/footer.php'; ?>

<!-- Javascript page handlers -->

<script>

  //
  // Insert the pit data table header
  //
  function insertPitTableHeader(tableId, pitData) {
    console.log("==> pitData: insertPitDataHeader()");
    let tbodyRef = document.getElementById(tableId).querySelector('thead');
    let headerRow = tbodyRef.insertRow();

    // Static columns
    let headers = [
      { text: "Team", class: "table-primary sorttable_numeric" },
      { text: "Swerve", class: "table-primary" },
      { text: "Drive Motors", class: "table-primary" },
      { text: "Spare Parts", class: "table-primary" },
      { text: "Prog Language", class: "table-primary" },
      { text: "Computer Vision", class: "table-primary" },
      { text: "Pit Org", class: "table-primary text-start" },
      { text: "Prep", class: "table-primary text-start" },
      { text: "Num Batteries", class: "table-primary" },
      { text: "Scout", class: "table-primary" }
    ];

    // Create header cells
    for (let header of headers) {
      let th = document.createElement('th');
      th.scope = 'col';
      th.className = header.class;
      th.innerText = header.text;
      headerRow.appendChild(th);
    }
  }

  //
  // Converts a given "1" to yes, "2" to no, anything else to a dash.
  //
  function toYesNo(value) {
    switch (String(value)) {
      case "0": return "No";
      case "1": return "Yes";
      default: return "-";
    }
  }

  //
  // Converts a given pit organization to a string
  //
  function toOrganization(value) {
    switch (String(value)) {
      case "1": return "1-Messy";
      case "2": return "2-Below Average";
      case "3": return "3-Organized!";
      case "4": return "4-Above Average";
      case "5": return "5-Pristine";
      default: return "-";
    }
  }

  //
  // Converts a given readiness to a string
  //
  function toPreparedness(value) {
    switch (String(value)) {
      case "1": return "1-Chaos";
      case "2": return "2-Below Average";
      case "3": return "3-Prepared!";
      case "4": return "4-Above Average";
      case "5": return "5-Proactive";
      default: return "-";
    }
  }


  //
  // Insert the pit data table body
  //
  function insertPitTableBody(tableId, pitData) {
    console.log("==> pitData: insertPitDataBody()");
    let tbodyRef = document.getElementById(tableId).querySelector('tbody');

    for (let teamNum in pitData) {
      let rowString = "";
      rowString += "<td><a href='teamLookup.php?teamNum=" + teamNum + "'>" + teamNum + "</a>";

      let teamPitData = pitData[teamNum];
      rowString += "<td>" + toYesNo(teamPitData["swerve"]) + "</td>";
      rowString += "<td>" + teamPitData["drivemotors"] + "</td>";
      rowString += "<td>" + toYesNo(teamPitData["spareparts"]) + "</td>";
      rowString += "<td>" + teamPitData["proglanguage"] + "</td>";
      rowString += "<td>" + toYesNo(teamPitData["computervision"]) + "</td>";
      rowString += "<td class='text-start'>" + toOrganization(teamPitData["pitorg"]) + "</td>";
      rowString += "<td class='text-start'>" + toPreparedness(teamPitData["preparedness"]) + "</td>";
      rowString += "<td>" + teamPitData["numbatteries"] + "</td>";
      rowString += "<td>" + teamPitData["scoutname"] + "</td>";

      tbodyRef.insertRow().innerHTML = rowString;
    }
  }

  //
  // Acquire match data and build the page
  //
  function buildPitDataTable(tableId) {
    $.get("api/dbReadAPI.php", {
      getAllPitData: true
    }).done(function (pitData) {
      console.log("=> eventAliasNames");
      let jPitData = JSON.parse(pitData);
      insertPitTableHeader(tableId, jPitData);
      insertPitTableBody(tableId, jPitData);
      // script instructions say this is needed, but it breaks table header sorting
      sorttable.makeSortable(document.getElementById(tableId));
      document.getElementById(tableId).click(); // This magic fixes the floating column bug
    });

  }

  /////////////////////////////////////////////////////////////////////////////
  //
  // Process the generated html
  //    Get all pit data from our database
  //    When completed, display the web page
  //
  document.addEventListener("DOMContentLoaded", function () {

    const tableId = "pitDataTable";
    const frozenTable = new FreezeTable('.freeze-table', { fixedNavbar: '.navbar' });

    buildPitDataTable(tableId);

    // Create frozen table panes and keep the panes updated
    document.getElementById(tableId).addEventListener('click', function () {
      if (frozenTable) {
        frozenTable.update();
      }
    });
  });
</script>

<script src="./scripts/compareMatchNumbers.js"></script>
<script src="./scripts/compareTeamNumbers.js"></script>
<!-- <script src="./scripts/pitDataTable.js"></script> -->
<script src="./scripts/sortFrcTables.js"></script>
