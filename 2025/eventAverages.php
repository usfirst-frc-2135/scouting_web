<?php
$title = 'Event Averages';
require 'inc/header.php';
?>

<div class="container row-offcanvas row-offcanvas-left">
  <div id="content" class="column card-lg-12 col-sm-12 col-xs-12">

    <!-- Page Title -->
    <div class="row pt-3 mb-3">
      <h2 class="col-auto text-nowrap mb-3 me-3"><?php echo $title; ?> </h2>

      <div class="col-auto mb-3 me-3">
        <button id="downloadCsvFile" class="btn btn-primary" type="button">Download CSV</button>
      </div>

      <!-- Match Filter -->
      <div class="col-md-3 mb-3 me-3">
        <div id="customMatch" class="accordion accordion-flush">
          <div class="accordion-item bg-secondary-subtle">
            <h2 class="accordion-header">
              <button class="accordion-button text-nowrap text-light bg-secondary mb-3" type="button" data-bs-toggle="collapse"
                data-bs-target="#filterEntry" aria-expanded="false" aria-controls="matchEntry">Match Range Filter</button>
            </h2>

            <div id="filterEntry" class="accordion-collapse collapse" data-bs-parent="#customMatch">

              <div class="input-group">
                <div class="input-group-prepend">
                  <select id="startCompLevel" class="form-select ms-2 mb-3" aria-label="Comp Level Select">
                    <option value="p">P</option>
                    <option value="qm" selected>QM</option>
                    <option value="sf">SF</option>
                    <option value="f">F</option>
                  </select>
                </div>
                <input id="startMatchNum" class="form-control col-2 me-2 mb-3" type="text" placeholder="Start"
                  aria-label="Start Match Filter">
              </div>

              <div class="input-group">
                <div class="input-group-prepend">
                  <select id="endCompLevel" class="form-select ms-2 mb-3" aria-label="Comp Level Select">
                    <option value="p">P</option>
                    <option value="qm" selected>QM</option>
                    <option value="sf">SF</option>
                    <option value="f">F</option>
                  </select>
                </div>
                <input id="endMatchNum" class="form-control col-2 me-3 mb-3" type="text" placeholder="End"
                  aria-label="End Match Filter">
              </div>

              <div>
                <button id="filterData" class="btn btn-primary btn-sm ms-2 mb-3" type="button">Filter Data</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="spinner" class="col-auto spinner-border ms-3 mb-3 me-3"></div>
    </div>

    <!-- Main row to hold the table -->
    <div class="row mb-3">

      <div id="freeze-table" class="freeze-table overflow-auto">
        <table id="averagesTable" class="table table-striped table-bordered table-hover table-sm border-secondary text-center">
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
  // Scrape table and write CSV file
  //
  function downloadTableAsCSV(tableId, csvName) {
    csvName = csvName + ".csv";
    console.log("==> eventAverages: downloadTableAsCSV(): " + csvName);
    const table = document.getElementById(tableId).querySelector('tbody');
    let csv = [];

    // This CSV header must match the order in eventAveragesTable.js insertEventAveragesBody()
    let hdrStr = "Team,Alias,COPRs,Matches" +
      "Total Pts Avg,Total Pts Max," +
      "Auto Pts Avg,Auto Pts Max,Tel Pts Avg,Tel Pts Max,End Pts Avg,End Pts Max," +
      "Auton Coral Pts Avg,Auton Coral Pts Max,Auto Algae Pts Avg,Auto Algae Pts Max," +
      "Tel Coral Pts Avg, Tel Coral Pts Max, Tel Algae Pts Avg, Tel Algae Pts Max," +
      "Total Coral Avg,Total Coral Max,Total Algae Avg,Total Algae Max," +
      "Auto Coral Avg,Auto Coral Max," +
      "Auto L4 Avg,Auto L4 Max,Auto L3 Avg,Auto L3 Max,Auto L2 Avg,Auto L2 Max,Auto L1 Avg,Auto L1 Max," +
      "Auto Algae Avg,Auto Algae Max,Auto Proc Avg,Auto Proc Max,Auto Net Avg,Auto Net Max," +
      "Tel Coral Acc,Tel Coral Avg,Tel Coral Max," +
      "Tel L4 Avg,Tel L4 Max,Tel L3 Avg,Tel L3 Max,Tel L2 Avg,Tel L2 Max,Tel L1 Avg,Tel L1 Max," +
      "Tel Algae Acc,Tel Algae Avg,Tel Algae Max,Tel Proc Avg,Tel Proc Max,Tel Net Avg,Tel Net Max," +
      "Def Avg," +
      "Start N/A,Start Before,Start At,Start Less10," +
      "End N/A,End Park,End Fall,End Shal,End Deep," +
      "Total Died, Note";
    csv.push(hdrStr);

    const rows = table.querySelectorAll("tr");

    rows.forEach(row => {
      const cols = row.querySelectorAll("td");
      const rowData = Array.from(cols).map(col => col.innerText);
      csv.push(rowData.join(","));
    });

    const csvFile = new Blob([csv.join("\n")], { type: "text/csv" });
    const downloadLink = document.createElement("a");
    downloadLink.download = csvName;
    downloadLink.href = window.URL.createObjectURL(csvFile);
    downloadLink.style.display = "none";
    document.body.appendChild(downloadLink);
    downloadLink.click();
    document.body.removeChild(downloadLink);
  }

  //
  // Get alias names and COPRs, create table header
  //
  function buildAveragesHeader(tableId, aliasNames) {
    if (aliasNames === null) {
      return;
    }

    insertEventAveragesHeader(tableId, aliasNames);
  }

  //
  // Get all match data, filter it, create final HTML table, and sort it
  //
  function buildAveragesBody(tableId, aliasNames, coprs, matchData, startMatch, endMatch) {
    if (aliasNames === null || coprs === null || matchData === null) {
      return;
    }

    console.log("==> eventAverages: buildAveragesBody()");
    let mdp = new matchDataProcessor(matchData);
    if (startMatch !== null && endMatch !== null) {
      mdp.filterMatchRange(startMatch, endMatch);
    }
    mdp.getSiteFilteredAverages(function (filteredMatchData, filteredAvgData) {
      insertEventAveragesBody(tableId, filteredAvgData, coprs, aliasNames, []);
      // script instructions say this is needed, but it breaks table header sorting
      // sorttable.makeSortable(document.getElementById(tableId));
      document.getElementById(tableId).click(); // This magic fixes the floating column bug
      document.getElementById('spinner').style.display = 'none';
    });
  }

  //
  // Build event averages table
  //
  function buildEventAveragesTable(tableId, startMatch, endMatch) {
    let jAliasNames = null;
    let jMatchData = null;
    let jCoprData = null;

    // Get Alias lookup table
    $.get("api/dbReadAPI.php", {
      getEventAliasNames: true
    }).done(function (eventAliasNames) {
      console.log("=> eventAliasNames");
      jAliasNames = JSON.parse(eventAliasNames);
      buildAveragesHeader(tableId, jAliasNames);
      buildAveragesBody(tableId, jAliasNames, jCoprData, jMatchData, null, null); // Retrieve all data
    });

    // Get OPR data from TBA
    $.get("api/tbaAPI.php", {
      getCOPRs: true
    }).done(function (coprs) {
      if (coprs === null) {
        return alert("Can't load COPRs from TBA; check if TBA Key was set in db_config");
      }
      console.log("=> getCOPRs");
      jCoprData = JSON.parse(coprs)["data"];
      buildAveragesBody(tableId, jAliasNames, jCoprData, jMatchData, null, null); // Retrieve all data
    });

    // Get match data from DB
    $.get("api/dbReadAPI.php", {
      getAllMatchData: true
    }).done(function (matchData) {
      console.log("=> getAllMatchData");
      jMatchData = JSON.parse(matchData);
      buildAveragesBody(tableId, jAliasNames, jCoprData, jMatchData, null, null); // Retrieve all data
    });

    // Filter out unwanted matches
    document.getElementById("filterData").addEventListener('click', function () {
      let startMatch = document.getElementById("startCompLevel").value + document.getElementById("startMatchNum").value.trim();
      let endMatch = document.getElementById("endCompLevel").value + document.getElementById("endMatchNum").value.trim();
      console.log("==> eventAverages: filterMatchRange: " + startMatch + " to " + endMatch);
      buildAveragesBody(tableId, jAliasNames, jCoprData, jMatchData, startMatch, endMatch);
    });
  }

  /////////////////////////////////////////////////////////////////////////////
  //
  // Process the generated html
  //    Get all match data and averages from our database (can be filtered by match)
  //    When completed, display the web page
  //
  //    If download button is clicked
  //    Get (again) all pit data from our database
  //    Get event COPRs from TBA
  //    Write combined data into a CSV file
  //
  document.addEventListener("DOMContentLoaded", function () {

    const tableId = "averagesTable";
    const frozenTable = new FreezeTable('.freeze-table', { fixedNavbar: '.navbar' });

    buildEventAveragesTable(tableId, null, null);

    // Write out picklist CSV file to client's download dir.
    document.getElementById("downloadCsvFile").addEventListener('click', function () {
      const csvFileName = frcEventCode + "_eventAverages";
      downloadTableAsCSV(tableId, csvFileName);
    });

    // Create frozen table panes and keep the panes updated
    document.getElementById(tableId).addEventListener('click', function () {
      if (frozenTable) {
        frozenTable.update();
      }
    });
  });

</script>

<script src="./scripts/aliasFunctions.js"></script>
<script src="./scripts/compareMatchNumbers.js"></script>
<script src="./scripts/compareTeamNumbers.js"></script>
<script src="./scripts/eventAveragesTable.js"></script>
<script src="./scripts/matchDataProcessor.js"></script>
<script src="./scripts/sortFrcTables.js"></script>
