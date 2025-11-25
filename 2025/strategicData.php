<?php
$title = 'Strategic Data';
require 'inc/header.php';
?>

<div class="container row-offcanvas row-offcanvas-left">
  <div id="content" class="column card-lg-12 col-sm-12 col-xs-12">

    <!-- Page Title -->
    <div class="row pt-3 pb-3 mb-3">
      <h2 class="col-md-6"><?php echo $title; ?></h2>
      <div id="spinner" class="spinner-border"></div>
    </div>

    <!-- Main row to hold the strategic table -->
    <div class="row col-12 mb-3">

      <div id="freeze-table" class="freeze-table overflow-auto">
        <table id="strategicTable" class="table table-striped table-bordered table-hover table-sm border-dark text-center">
          <thead> </thead>
          <tbody class="table-group-divider"> </tbody>
        </table>
      </div>

    </div>
  </div>
</div>

<?php include 'inc/footer.php'; ?>

<!-- Javascript page handlers -->

<script>

  // Retrive strategic scouting data and load the table
  function buildStrategicDataTable(tableId) {
    console.log("==> strategicData: buildStrategicDataTable()");
    let jAliasNames = null;

    // Load alias lookup table
    $.get("api/dbReadAPI.php", {
      getEventAliasNames: true
    }).done(function (eventAliasNames) {
      console.log("=> eventAliasNames");
      jAliasNames = JSON.parse(eventAliasNames);
      insertStrategicDataHeader(tableId, jAliasNames);
    });

    // Load the strategic data
    $.get("api/dbReadAPI.php", {
      getAllStrategicData: true
    }).done(function (strategicData) {
      console.log("=> getAllStrategicData");
      insertStrategicDataBody(tableId, JSON.parse(strategicData), jAliasNames, []);
      document.getElementById('spinner').style.display = 'none';
      // script instructions say this is needed, but it breaks table header sorting
      // sorttable.makeSortable(document.getElementById(tableId));
      document.getElementById(tableId).click(); // This magic fixes the floating column bug
    });
  }

  /////////////////////////////////////////////////////////////////////////////
  //
  // Process the generated html
  //    Get all strategic data from our database
  //    When completed, display the web page
  //
  document.addEventListener("DOMContentLoaded", function () {

    const tableId = "strategicTable";
    const frozenTable = new FreezeTable('.freeze-table', { fixedNavbar: '.navbar' });

    buildStrategicDataTable(tableId);

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
<script src="./scripts/sortFrcTables.js"></script>
<script src="./scripts/strategicDataTable.js"></script>
