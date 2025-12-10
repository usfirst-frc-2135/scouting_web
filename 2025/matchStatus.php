<?php
$title = 'Match Scouting Status';
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
        <table id="matchStatusTable" class="table table-striped table-bordered table-hover table-sm border-dark text-center">
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
  // Load the table with the match status values
  //
  function loadMatchStatusTable(tableId, eventMatches, allMatchData) {
    console.log("==> matchStatus: loadMatchStatusTable()");

    if ((eventMatches === null) || (allMatchData === null))
      return;

    console.log("=> loadMatchStatusTable");
    let hdrString = "<th scope='col' class='sorttable_numerci'>Match</th> <th class='text-bg-danger'>Red 1</th> <th class='text-bg-danger'>Red 2</th> <th class='text-bg-danger'>Red 3</th> <th class='text-bg-primary'>Blue 1</th> <th class='text-bg-primary'>Blue 2</th> <th class='text-bg-primary'>Blue 3</th>";
    document.getElementById(tableId).querySelector('thead').insertRow().innerHTML = hdrString;

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
      rowString += "<td>" + matchId + "</td>";

      // Red teams in this match
      for (team in alliances["red"]["team_keys"]) {
        let cellString = "<td class='table-danger'>" + alliances["red"]["team_keys"][team].substring(3) + "</td>";
        for (let ami in allMatchData) {
          if ((allMatchData[ami]["matchnumber"] === matchId) && allMatchData[ami]["teamnumber"] === alliances["red"]["team_keys"][team].substring(3)) {
            cellString = ((!scouts.includes(allMatchData[ami]["scoutname"])) ? "<td class='table-success'>" : "<td class='table-warning'>") + allMatchData[ami]["scoutname"] + "</td>";
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
            cellString = ((!scouts.includes(allMatchData[ami]["scoutname"])) ? "<td class='table-success'>" : "<td class='table-warning'>") + allMatchData[ami]["scoutname"] + "</td>";
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
