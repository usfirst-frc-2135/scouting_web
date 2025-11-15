<?php
$title = 'Match Data';
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
        <table id="matchDataTable" class="table table-striped table-bordered table-hover table-sm border-dark text-center sortable">
          <thead class="z-3">
            <tr>
              <th scope="col" style="background-color:transparent" class="sorttable_numeric">Match</th>
              <th scope="col" style="background-color:transparent" class="sorttable_numeric">Team</th>
              <th scope="col" style="background-color:transparent">Alias</th>

              <th scope="col" style="background-color:#d5e6de">Auton Leave</th>
              <th scope="col" style="background-color:#d5e6de">Auton Coral L1</th>
              <th scope="col" style="background-color:#d5e6de">Auton Coral L2</th>
              <th scope="col" style="background-color:#d5e6de">Auton Coral L3</th>
              <th scope="col" style="background-color:#d5e6de">Auton Coral L4</th>
              <th scope="col" style="background-color:#d5e6de">Auton Algae Net</th>
              <th scope="col" style="background-color:#d5e6de">Auton Algae Proc</th>
              <th scope="col" style="background-color:transparent">Acq'd Coral</th>
              <th scope="col" style="background-color:transparent">Acq'd Algae</th>
              <th scope="col" style="background-color:#d6f3fB">Teleop Coral L1</th>
              <th scope="col" style="background-color:#d6f3fB">Teleop Coral L2</th>
              <th scope="col" style="background-color:#d6f3fB">Teleop Coral L3</th>
              <th scope="col" style="background-color:#d6f3fB">Teleop Coral L4</th>
              <th scope="col" style="background-color:#d6f3fB">Teleop Algae Net</th>
              <th scope="col" style="background-color:#d6f3fB">Teleop Algae Proc</th>
              <th scope="col" style="background-color:#d6f3fB">Defense</th>
              <th scope="col" style="background-color:#fbe6d3">Cage Climb</th>
              <th scope="col" style="background-color:#fbe6d3">Start Climb</th>
              <th scope="col" style="background-color:transparent">Died</th>
              <th scope="col" style="background-color:transparent">Scout Name</th>
              <th scope="col" style="background-color:#cfe2ff">Comment</th>
            </tr>
          </thead>
          <tbody class="table-group-divider"> </tbody>
        </table>
      </div>

    </div>
  </div>
</div>

<?php include 'inc/footer.php'; ?>

<!-- Javascript page handlers -->

<script>

  // Load match data to page
  // NOTE: match data keywords MUST match the database definition in dbHandler.php
  function loadMatchData(tableId, matchData) {
    console.log("matchData: loadMatchData()");

    let tbodyRef = document.getElementById(tableId).querySelector('tbody');;
    tbodyRef.innerHTML = ""; // Clear Table

    // Go thru each match and build the HTML string for that row.
    for (let i = 0; i < matchData.length; i++) {
      let matchItem = matchData[i];
      let teamNum = matchItem["teamnumber"];
      let alias = matchItem["teamalias"];
      if (alias == 0)
        alias = "";

      const tdPrefix0 = "<td style=\"background-color:transparent\">";
      const tdPrefix1 = "<td style=\"background-color:#cfe2ff\">";
      let data1 = matchItem["matchnumber"];
      let rowString = "<th>" + matchItem["matchnumber"] + "</th>";
      rowString += tdPrefix0 + "<a href='teamLookup.php?teamNum=" + teamNum + "'>" + teamNum + "</td>";
      rowString += tdPrefix0 + alias + "</td>";
      rowString += tdPrefix1 + matchItem["autonLeave"] + "</td>";
      rowString += tdPrefix0 + matchItem["autonCoralL1"] + "</td>";
      rowString += tdPrefix1 + matchItem["autonCoralL2"] + "</td>";
      rowString += tdPrefix0 + matchItem["autonCoralL3"] + "</td>";
      rowString += tdPrefix1 + matchItem["autonCoralL4"] + "</td>";
      rowString += tdPrefix0 + matchItem["autonAlgaeNet"] + "</td>";
      rowString += tdPrefix1 + matchItem["autonAlgaeProcessor"] + "</td>";
      rowString += tdPrefix0 + matchItem["acquiredCoral"] + "</td>";
      rowString += tdPrefix1 + matchItem["acquiredAlgae"] + "</td>";
      rowString += tdPrefix0 + matchItem["teleopCoralL1"] + "</td>";
      rowString += tdPrefix1 + matchItem["teleopCoralL2"] + "</td>";
      rowString += tdPrefix0 + matchItem["teleopCoralL3"] + "</td>";
      rowString += tdPrefix1 + matchItem["teleopCoralL4"] + "</td>";
      rowString += tdPrefix0 + matchItem["teleopAlgaeNet"] + "</td>";
      rowString += tdPrefix1 + matchItem["teleopAlgaeProcessor"] + "</td>";
      rowString += tdPrefix0 + matchItem["defenseLevel"] + "</td>";
      rowString += tdPrefix1 + matchItem["cageClimb"] + "</td>";
      rowString += tdPrefix0 + matchItem["startClimb"] + "</td>";
      rowString += tdPrefix1 + matchItem["died"] + "</td>";
      rowString += tdPrefix0 + matchItem["scoutname"] + "</td>";
      rowString += tdPrefix1 + matchItem["comment"] + "</td>";
      tbodyRef.insertRow().innerHTML = rowString;
    }
  }

  // Acquire match data and build the page
  function buildMatchDataTable(tableId) {
    $.get("api/dbReadAPI.php", {
      getAllMatchData: true
    }).done(function (matchData) {
      console.log("=> getAllMatchData");
      let mdp = new matchDataProcessor(JSON.parse(matchData));
      // mdp.sortMatches(allEventMatches);
      mdp.getSiteFilteredAverages(function (filteredMatchData, filteredAvgData) {
        if (filteredMatchData !== undefined) {
          loadMatchData(tableId, filteredMatchData);
          const teamColumn = 1;
          const matchColumn = 0;
          sortTableByMatchAndTeam(tableId, teamColumn, matchColumn);
          // script instructions say this is needed, but it breaks table header sorting
          // sorttable.makeSortable(document.getElementById(tableId));
          document.getElementById(tableId).click(); // This magic fixes the floating column bug
        }
        else {
          alert("No match data found!");
        }
      });
    });
  }

  /////////////////////////////////////////////////////////////////////////////
  //
  // Process the generated html
  //    Get all match data from our database
  //    When completed, display the web page
  //
  document.addEventListener("DOMContentLoaded", function () {

    const tableId = "matchDataTable";
    const frozenTable = new FreezeTable('.freeze-table', { fixedNavbar: '.navbar' });

    buildMatchDataTable(tableId);

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
<script src="./scripts/matchDataProcessor.js"></script>
<script src="./scripts/sortFrcTables.js"></script>
