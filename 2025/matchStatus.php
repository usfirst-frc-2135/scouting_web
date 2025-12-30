<?php
$title = 'Match Data Status';
require 'inc/header.php';
?>

<div class="container row-offcanvas row-offcanvas-left">
  <div id="content" class="column card-lg-12 col-sm-12 col-xs-12">

    <!-- Page Title -->
    <div class="row col-md-6 pt-3 mb-3">
      <h2 class="col-auto mb-3 me-3"><?php echo $title; ?> </h2>
      <a class="col-auto btn btn-primary mb-3 me-3" href="javascript:history.back()">Back</a>
      <div id="spinner" class="spinner-border ms-3 mb-3 me-3"></div>
    </div>

    <!-- Main row to hold the table -->
    <div class="row col-12 mb-3">

      <div id="freeze-table" class="freeze-table overflow-auto">
        <table id="matchStatusTable" class="table table-striped table-bordered table-hover table-sm border-secondary text-center">
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
  //  Match data check table utilities that:
  //    1) insert a header row for a match data check table
  //    2) insert a body row for match data check table
  //

  //
  //  Insert a match status table header
  //    Params
  //      tableId     - the HTML ID where the table header is inserted
  //
  function insertMatchStatusHeader(tableId) {
    console.log("==> insertMatchStatusHeader: tableId " + tableId);
    let hdrString = "<th scope='col' class='sorttable_numeric'>Match</th>" +
      "<th scope='col' class='text-bg-danger'>Red 1</th>" +
      "<th scope='col' class='text-bg-danger'>Red 2</th>" +
      "<th scope='col' class='text-bg-danger'>Red 3</th>" +
      "<th scope='col' class='text-bg-primary'>Blue 1</th>" +
      "<th scope='col' class='text-bg-primary'>Blue 2</th>" +
      "<th scope='col' class='text-bg-primary'>Blue 3</th>";
    document.getElementById(tableId).querySelector('thead').insertRow().innerHTML = hdrString;
  }

  //
  //  Insert a match check table body (all rows)
  //    Params
  //      tableId     - the HTML ID where the table header is inserted
  //
  function insertMatchStatusBody(tableId, eventMatches, allMatchData) {
    console.log("==> insertMatchStatusBody: tableId " + tableId);

    let tbodyRef = document.getElementById(tableId).querySelector('tbody');
    for (let emi in eventMatches) {
      let match = eventMatches[emi];
      let matchNum = match["match_number"];
      if (match["comp_level"] === "sf") {
        matchNum = match["set_number"];
      }
      let matchId = match["comp_level"] + matchNum;
      let alliances = match["alliances"];
      let scouts = [];

      // Build a match row with scout names if the match has been scouted
      let rowString = "";
      rowString += "<td class='fw-bold'>" + matchId + "</td>";

      // Red teams in this match
      for (team in alliances["red"]["team_keys"]) {
        let cellString = "<td class='table-danger'>" + alliances["red"]["team_keys"][team].substring(3) + "</td>";
        for (let ami in allMatchData) {
          if ((allMatchData[ami]["matchnumber"] === matchId) && allMatchData[ami]["teamnumber"] === alliances["red"]["team_keys"][team].substring(3)) {
            cellString = "<td class='table-" + ((!scouts.includes(allMatchData[ami]["scoutname"])) ? "success'>" : "warning'>") + allMatchData[ami]["scoutname"] + "</td>";
            scouts.push(allMatchData[ami]["scoutname"]);
            break;
          }
        }
        rowString += cellString;
      }

      // Blue teams in this match
      for (team in alliances["blue"]["team_keys"]) {
        let cellString = "<td class='table-primary'>" + alliances["blue"]["team_keys"][team].substring(3) + "</td>";
        for (let ami in allMatchData) {
          if ((allMatchData[ami]["matchnumber"] === matchId) && allMatchData[ami]["teamnumber"] === alliances["blue"]["team_keys"][team].substring(3)) {
            cellString = "<td class='table-" + ((!scouts.includes(allMatchData[ami]["scoutname"])) ? "success'>" : "warning'>") + allMatchData[ami]["scoutname"] + "</td>";
            scouts.push(allMatchData[ami]["scoutname"]);
            break;
          }
        }
        rowString += cellString;
      }

      tbodyRef.insertRow().innerHTML = rowString;
    }

    let matchCol = 0;
    sortTableByMatch(tableId, matchCol);
  }

  //
  // Load the table with the match status values
  //
  function loadMatchStatusTable(tableId, eventMatches, allMatchData) {
    console.log("==> matchStatus: loadMatchStatusTable()");

    if ((eventMatches === null) || (allMatchData === null))
      return;

    console.log("=> loadMatchStatusTable");
    insertMatchStatusHeader(tableId);
    insertMatchStatusBody(tableId, eventMatches, allMatchData);
    document.getElementById(tableId).click(); // This magic fixes the floating column bug
    document.getElementById('spinner').style.display = 'none';
  }

  //
  // Load match data and event matches
  //
  function buildMatchStatusTable(tableId) {
    console.log("==> matchStatus: buildMatchStatusTable()");
    let jEventMatches = null;
    let jAllMatchData = null;

    $.get("api/tbaAPI.php", {
      getEventMatches: true
    }).done(function (eventMatches) {
      console.log("=> getEventMatches");
      jEventMatches = JSON.parse(eventMatches)["response"];
      loadMatchStatusTable(tableId, jEventMatches, jAllMatchData);
    });

    $.get("api/dbReadAPI.php", {
      getAllMatchData: true
    }).done(function (matchData) {
      console.log("=> getAllMatchData");
      jAllMatchData = JSON.parse(matchData);
      loadMatchStatusTable(tableId, jEventMatches, jAllMatchData);
    });

  }

  /////////////////////////////////////////////////////////////////////////////
  //
  // Process the generated html
  //    Get event matches from TBA
  //    Get all match data from our database
  //    When completed, display the web page
  //
  document.addEventListener("DOMContentLoaded", function () {

    const tableId = "matchStatusTable";
    const frozenTable = new FreezeTable('.freeze-table', { fixedNavbar: '.navbar' });

    buildMatchStatusTable(tableId);

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
<script src="./scripts/matchDataTable.js"></script>
<script src="./scripts/matchDataProcessor.js"></script>
<script src="./scripts/sortFrcTables.js"></script>
