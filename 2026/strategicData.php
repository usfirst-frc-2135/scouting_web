<?php
$title = 'Strategic Data';
require 'inc/header.php';
?>

<div class="container row-offcanvas row-offcanvas-left">
  <div id="content" class="column card-lg-12 col-sm-12 col-xs-12">

    <!-- Page Title -->
    <div class="row pt-3 pb-3 mb-3">
      <h2 class="col-md-6"><?php echo $title; ?></h2>
    </div>

    <!-- Main row to hold the strategic table -->
    <div class="row col-12 mb-3">

      <div id="freeze-table" class="freeze-table overflow-auto">
        <table id="strategicTable" class="table table-striped table-bordered table-hover table-sm border-dark text-center sortable">
          <thead>
            <tr>
              <th colspan="1" style="background-color:transparent"> </th>
              <th colspan="1" style="background-color:transparent"> </th>
              <th colspan="1" style="background-color:#cfe2ff"> </th>
              <th colspan="2" style="background-color:#cfe2ff">Against Defense</th>
              <th colspan="3" style="background-color:transparent">Defense Tactics</th>
              <th colspan="8" style="background-color:#cfe2ff">Fouls</th>
              <th colspan="4" style="background-color:transparent">Auton</th>
              <th colspan="4" style="background-color:#cfe2ff">Teleop</th>
              <th colspan="2" style="background-color:transparent">Notes</th>
              <th colspan="1"> </th>
            </tr>
            <tr>
              <th scope="col" style="background-color:transparent" class="sorttable_numeric">Team</th>
              <th scope="col" style="background-color:transparent">Match</th>
              <th scope="col" style="background-color:#cfe2ff">Drive Skill</th>
              <th scope="col" style="background-color:transparent">Block</th>
              <th scope="col" style="background-color:#cfe2ff">Note</th>
              <th scope="col" style="background-color:transparent">Block Path</th>
              <th scope="col" style="background-color:#cfe2ff">Block Station</th>
              <th scope="col" style="background-color:transparent">Note</th>
              <th scope="col" style="background-color:#cfe2ff">Pin</th>
              <th scope="col" style="background-color:transparent">Auton Barge Contact</th>
              <th scope="col" style="background-color:#cfe2ff">Auton Cage Contact</th>
              <th scope="col" style="background-color:transparent">Anchor Contact</th>
              <th scope="col" style="background-color:#cfe2ff">Barge Contact</th>
              <th scope="col" style="background-color:transparent">Reef Contact</th>
              <th scope="col" style="background-color:#cfe2ff">Cage Contact</th>
              <th scope="col" style="background-color:transparent">Contact Climbing Robot</th>
              <th scope="col" style="background-color:#cfe2ff">Get Floor Coral</th>
              <th scope="col" style="background-color:transparent">Get Stn Coral</th>
              <th scope="col" style="background-color:#cfe2ff">Get Floor Algae</th>
              <th scope="col" style="background-color:transparent">Get Reef Algae</th>
              <th scope="col" style="background-color:#cfe2ff">Get Floor Coral</th>
              <th scope="col" style="background-color:transparent">Get Floor Algae</th>
              <th scope="col" style="background-color:#cfe2ff">Knock Algae</th>
              <th scope="col" style="background-color:transparent">Acquire Reef Algae</th>
              <th scope="col" style="background-color:#cfe2ff">Problem Note</th>
              <th scope="col" style="background-color:transparent">General Note</th>
              <th scope="col" style="background-color:#cfe2ff">Scout Name</th>
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

  // Converts a given "1" to yes, "2" to no, anything else to a dash.
  function toYesNo(value) {
    switch (String(value)) {
      case "1": return "Yes";
      case "2": return "No";
      default: return "-";
    }
  }

  // Load the strategic data into the table
  function loadStrategicData(tableId, stratData) {
    console.log("==> strategicData: loadStrategicData()");
    let tbodyRef = document.getElementById(tableId).querySelector('tbody');
    tbodyRef.innerHTML = "";   // Clear Table

    for (let i = 0; i < stratData.length; i++) {
      let stratItem = stratData[i];
      let driveVal = "";
      switch (stratItem["driverability"]) {
        case 1: driveVal = "Jerky"; break;
        case 2: driveVal = "Slow"; break;
        case 3: driveVal = "Average"; break;
        case 4: driveVal = "Quick"; break;
        default:
        case 5: driveVal = "-"; break;
      }

      let teamNum = stratItem["teamnumber"];
      const tdPrefix0 = "<td style=\"background-color:transparent\">";
      const tdPrefix1 = "<td style=\"background-color:#cfe2ff\">";
      let rowString = "";
      rowString += tdPrefix0 + "<a href='teamLookup.php?teamNum=" + teamNum + "'>" + teamNum + "</td>";
      rowString += tdPrefix0 + stratItem["matchnumber"] + "</td>";
      rowString += tdPrefix1 + driveVal + "</td>";
      rowString += tdPrefix0 + toYesNo(stratItem["against_tactic1"]) + "</td>";
      rowString += tdPrefix1 + stratItem["against_comment"] + "</td>";
      rowString += tdPrefix0 + toYesNo(stratItem["defense_tactic1"]) + "</td>";
      rowString += tdPrefix1 + toYesNo(stratItem["defense_tactic2"]) + "</td>";
      rowString += tdPrefix0 + stratItem["defense_comment"] + "</td>";
      rowString += tdPrefix1 + toYesNo(stratItem["foul1"]) + "</td>";
      rowString += tdPrefix0 + toYesNo(stratItem["autonFoul1"]) + "</td>";
      rowString += tdPrefix1 + toYesNo(stratItem["autonFoul2"]) + "</td>";
      rowString += tdPrefix0 + toYesNo(stratItem["teleopFoul1"]) + "</td>";
      rowString += tdPrefix1 + toYesNo(stratItem["teleopFoul2"]) + "</td>";
      rowString += tdPrefix0 + toYesNo(stratItem["teleopFoul3"]) + "</td>";
      rowString += tdPrefix1 + toYesNo(stratItem["teleopFoul4"]) + "</td>";
      rowString += tdPrefix0 + toYesNo(stratItem["endgameFoul1"]) + "</td>";
      rowString += tdPrefix1 + toYesNo(stratItem["autonGetCoralFromFloor"]) + "</td>";
      rowString += tdPrefix0 + toYesNo(stratItem["autonGetCoralFromStation"]) + "</td>";
      rowString += tdPrefix1 + toYesNo(stratItem["autonGetAlgaeFromFloor"]) + "</td>";
      rowString += tdPrefix0 + toYesNo(stratItem["autonGetAlgaeFromReef"]) + "</td>";
      rowString += tdPrefix1 + toYesNo(stratItem["teleopFloorPickupAlgae"]) + "</td>";
      rowString += tdPrefix0 + toYesNo(stratItem["teleopFloorPickupCoral"]) + "</td>";
      rowString += tdPrefix1 + toYesNo(stratItem["teleopKnockOffAlgaeFromReef"]) + "</td>";
      rowString += tdPrefix0 + toYesNo(stratItem["teleopAcquireAlgaeFromReef"]) + "</td>";
      rowString += tdPrefix1 + stratItem["problem_comment"] + "</td>";
      rowString += tdPrefix0 + stratItem["general_comment"] + "</td>";
      rowString += tdPrefix1 + stratItem["scoutname"] + "</td>";
      tbodyRef.insertRow().innerHTML = rowString;
    }
  }

  // Retrive strategic scouting data and load the table
  function buildStrategicDataTable(tableId) {
    console.log("==> strategicData: buildStrategicDataTable()");
    $.get("api/dbReadAPI.php", {
      getAllStrategicData: true
    }).done(function (strategicData) {
      console.log("=> getAllStrategicData");
      loadStrategicData(tableId, JSON.parse(strategicData));
      const teamColumn = 0;
      const matchColumn = 1;
      sortTableByMatchAndTeam(tableId, teamColumn, matchColumn);
      // script instructions say this is needed, but it breaks table header sorting
      // sorttable.makeSortable(document.getElementById(tableId));
      document.getElementById(tableId).click(); // This magic fixes the floating column bug
    });
  }

  /////////////////////////////////////////////////////////////////////////////
  //
  // Process the generated html
  //
  document.addEventListener("DOMContentLoaded", () => {

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

<script src="./scripts/compareMatchNumbers.js"></script>
<script src="./scripts/compareTeamNumbers.js"></script>
<script src="./scripts/sortFrcTables.js"></script>
