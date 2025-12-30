<?php
$title = 'Match Data';
require 'inc/header.php';
?>

<div class="container row-offcanvas row-offcanvas-left">
  <div id="content" class="column card-lg-12 col-sm-12 col-xs-12">

    <!-- Page Title -->
    <div class="row pt-3 mb-3">
      <h2 class="col-md-6 mb-3 me-3"><?php echo $title; ?> </h2>
      <div id="spinner" class="spinner-border ms-3 mb-3 me-3"></div>
    </div>

    <!-- Main row to hold the table -->
    <div class="row col-12 mb-3">

      <div id="freeze-table" class="freeze-table overflow-auto">
        <table id="matchDataTable" class="table table-striped table-bordered table-hover table-sm border-secondary text-center">
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
  // Build the match data table
  //
  function buildMatchDataTable(tableId) {    // Load the alias table
    console.log("==> matchData: buildMatchDataTable()");
    let jAliasNames = null;

    // Load alias lookup table
    $.get("api/dbReadAPI.php", {
      getEventAliasNames: true
    }).done(function (eventAliasNames) {
      console.log("=> eventAliasNames");
      jAliasNames = JSON.parse(eventAliasNames);
      insertMatchDataHeader(tableId, jAliasNames);
    });

    // Load the match data
    $.get("api/dbReadAPI.php", {
      getAllMatchData: true
    }).done(function (matchData) {
      console.log("=> getAllMatchData");
      let mdp = new matchDataProcessor(JSON.parse(matchData));
      // mdp.sortMatches(allEventMatches);
      mdp.getSiteFilteredAverages(function (filteredMatchData, filteredAvgData) {
        if (filteredMatchData !== undefined) {
          insertMatchDataBody(tableId, filteredMatchData, jAliasNames, []);
          document.getElementById('spinner').style.display = 'none';
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

<script src="./scripts/aliasFunctions.js"></script>
<script src="./scripts/compareMatchNumbers.js"></script>
<script src="./scripts/compareTeamNumbers.js"></script>
<script src="./scripts/matchDataTable.js"></script>
<script src="./scripts/matchDataProcessor.js"></script>
<script src="./scripts/sortFrcTables.js"></script>
