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
              <th scope="col" style="background-color:#fbe6d3">Cage Climb</th>
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

  // let frozenTable = null;  // doesn't work with table-responsive
  const teamColumn = 1;
  const matchColumn = 0;

  // Load match data to page
  // NOTE: data object keywords MUST match the database definition in dbHandler.php
  function loadMatchData(tableId, dataObj) {
    console.log("==> matchData: loadMatchData()");
    let tbodyRef = document.getElementById(tableId).querySelector('tbody');;
    tbodyRef.innerHTML = ""; // Clear Table
    for (let i = 0; i < dataObj.length; i++) {
      let teamNum = dataObj[i]["teamnumber"];
      let rowString = "<th>" + dataObj[i]["matchnumber"] + "</th>" +
        "<td style=\"background-color:transparent\"><a href='teamLookup.php?teamNum=" + teamNum + "'>" + teamNum + "</td>" +
        "<td style=\"background-color:#cfe2ff\">" + dataObj[i]["autonLeave"] + "</td>" +
        "<td style=\"background-color:transparent\">" + dataObj[i]["autonCoralL1"] + "</td>" +
        "<td style=\"background-color:#cfe2ff\">" + dataObj[i]["autonCoralL2"] + "</td>" +
        "<td style=\"background-color:transparent\">" + dataObj[i]["autonCoralL3"] + "</td>" +
        "<td style=\"background-color:#cfe2ff\">" + dataObj[i]["autonCoralL4"] + "</td>" +
        "<td style=\"background-color:transparent\">" + dataObj[i]["autonAlgaeNet"] + "</td>" +
        "<td style=\"background-color:#cfe2ff\">" + dataObj[i]["autonAlgaeProcessor"] + "</td>" +
        "<td style=\"background-color:transparent\">" + dataObj[i]["acquiredCoral"] + "</td>" +
        "<td style=\"background-color:#cfe2ff\">" + dataObj[i]["acquiredAlgae"] + "</td>" +
        "<td style=\"background-color:transparent\">" + dataObj[i]["teleopCoralL1"] + "</td>" +
        "<td style=\"background-color:#cfe2ff\">" + dataObj[i]["teleopCoralL2"] + "</td>" +
        "<td style=\"background-color:transparent\">" + dataObj[i]["teleopCoralL3"] + "</td>" +
        "<td style=\"background-color:#cfe2ff\">" + dataObj[i]["teleopCoralL4"] + "</td>" +
        "<td style=\"background-color:transparent\">" + dataObj[i]["teleopAlgaeNet"] + "</td>" +
        "<td style=\"background-color:#cfe2ff\">" + dataObj[i]["teleopAlgaeProcessor"] + "</td>" +
        "<td style=\"background-color:transparent\">" + dataObj[i]["cageClimb"] + "</td>" +
        "<td style=\"background-color:#cfe2ff\">" + dataObj[i]["died"] + "</td>" +
        "<td style=\"background-color:transparent\">" + dataObj[i]["scoutname"] + "</td>" +
        "<td style=\"background-color:#cfe2ff\">" + dataObj[i]["comment"] + "</td>";
      tbodyRef.insertRow().innerHTML = rowString;
    }
  }

  // Acquire match data and build the page
  function buildMatchDataTable(tableId, frozenId) {
    $.get("api/dbReadAPI.php", {
      getEventMatches: 1
    }).done(function (eventMatches) {
      console.log("=> getEventMatches");
      let dataObj = JSON.parse(eventMatches);
      loadMatchData(tableId, dataObj);
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

    const tableId = "matchDataTable";

    // Update the navbar with the event code
    $.get("api/tbaAPI.php", {
      getEventCode: true
    }, function (eventCode) {
      eventCode = eventCode.trim();
      console.log("=> matchData: getEventCode: " + eventCode);
      document.getElementById("navbarEventCode").innerText = eventCode;
    });

    buildMatchDataTable(tableId);

    // Create frozen table panes and keep the panes updated
    let frozenTable = new FreezeTable('.freeze-table', { fixedNavbar: '.navbar' });
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
