<?php
$title = 'Pit Scouting Status';
require 'inc/header.php';
?>

<div class="container row-offcanvas row-offcanvas-left">
  <div id="content" class="column card-lg-12  col-sm-12 col-xs-12">

    <!-- Page Title -->
    <div class="row pt-3 pb-3 mb-3">
      <h2 class="col-md-6"><?php echo $title; ?></h2>
    </div>

    <!-- Main row to hold the table -->
    <div class="row mb-3">

      <style type="text/css" media="screen">
        thead {
          position: sticky;
          top: 56px;
          background: white;
        }
      </style>

      <table id="psTable" class="table table-striped table-bordered table-hover text-center sortable">
        <thead>
          <tr>
            <th class="text-start sorttable_numeric">Team</th>
            <th>Pit Scouted?</th>
            <th>Photo Uploaded?</th>
          </tr>
        </thead>
        <tbody class=" table-group-divider">
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php include 'inc/footer.php'; ?>

<!-- Javascript page handlers -->

<script>

  // Build the pit status table
  function loadPitStatusTable(tableId, teams, names, images, pitInfo) {
    console.log("==> pitStatus: loadPitStatusTable()");
    if (teams === [] || names === [] || images === null || pitInfo === null) {
      // console.warn("loadPitStatusTable: teams, names, images, or pit data are missing -- still waiting for gets!");
      return;
    }

    let tbodyRef = document.getElementById(tableId).querySelector('tbody');
    tbodyRef.innerHTML = "";
    for (let teamNum of teams) {
      let teamName = names[teamNum];
      let row = "";
      row += "<td class='text-start'>" + "<a href='teamLookup.php?teamNum=" + teamNum + "'>" + teamNum + "</a>";
      row += " - " + teamName;
      row += "</td>";

      if (pitInfo[teamNum] != null) {
        row += " <td class='bg-success'>Yes</td>";
      } else {
        row += "<td><a href='pitForm.php?teamNum=" + teamNum + "'>No</td>"
      }

      if ((images[teamNum] != null) && (images[teamNum].length > 0)) {
        row += " <td class='bg-success'>Yes</td>";
      } else {
        row += "<td><a href='pitPhotoUpload.php?teamNum=" + teamNum + "'>No</td>"
      }
      tbodyRef.insertRow().innerHTML = row;
    }

    const teamColumn = 0;
    sortTableByTeam(tableId, teamColumn);
    // script instructions say this is needed, but it breaks table header sorting
    // sorttable.makeSortable(document.getElementById(tableId));
  }

  /////////////////////////////////////////////////////////////////////////////
  //
  // Process the generated html
  //    Get team list for this eventcode from TBA
  //      - Get photos for that team list from our photos
  //    Get all pit data from our database
  //    When all completed, generate the web page
  //
  document.addEventListener("DOMContentLoaded", function () {

    const tableId = "psTable";
    let teamList = [];
    let namesList = [];
    let jTeamImages = null;
    let jPitData = null;
    let jAliasNames = [];
    let bAliasUsed = false;

    // Get alias table data
    $.get("api/dbReadAPI.php", {
      getEventAliasNames: true
    }).done(function (eventAliasNames) {
      console.log("=> eventAliasNames");
      jAliasNames = JSON.parse(eventAliasNames);
      if (jAliasNames.length > 0) { 
        console.log("pitStatus: aliases used");
        bAliasUsed = true;
      }
    });

    // Get the list of teams and add the team names 
    $.get("api/tbaAPI.php", {
      getEventTeamNames: true
    }).done(function (eventTeamNames) {
      console.log("=> getEventTeamNames");
      if (eventTeamNames === null) {
        return alert("Can't load eventTeamNames from TBA; check if TBA Key was set in db_config");
      }
      let jTeamNames = JSON.parse(eventTeamNames);
      console.log( "pitStatus: jTeamNames length = " + jTeamNames.length);
      for (let team in jTeamNames) {
        let teamNum = jTeamNames[team]["teamnum"];
        let teamName = jTeamNames[team]["teamname"];

        // Checking if alias is being used and adjust team name accordingly.
        // At this point, the teamNum could be the 99-number.
        if(bAliasUsed) {
          let BCDnum = getTeamNumFromAlias(teamNum, jAliasNames);
          if (BCDnum !== "") {
            // This entry is an alias, so create a new entry with the BCDnum with the alias as teamName.
            teamName = teamNum;
            teamNum = BCDnum;
          }
        }
        teamList.push(teamNum);
        namesList[teamNum] = teamName;
      }

      // Get all the team images for the list of teams
      $.get("api/dbReadAPI.php", {
        getAllTeamImages: JSON.stringify(teamList)
      }).done(function (teamImages) {
        console.log("=> pitStatus: getAllTeamImages");
        jTeamImages = JSON.parse(teamImages);
        loadPitStatusTable(tableId, teamList, namesList, jTeamImages, jPitData);
      });
    });

    // Get all the teams pit scouted
    $.get("api/dbReadAPI.php", {
      getAllPitData: true
    }).done(function (allPitData) {
      console.log("=> getAllPitData");
      jPitData = JSON.parse(allPitData);
      loadPitStatusTable(tableId, teamList, namesList, jTeamImages, jPitData);
    });
  });

</script>

<script src="./scripts/compareMatchNumbers.js"></script>
<script src="./scripts/compareTeamNumbers.js"></script>
<script src="./scripts/aliasFunctions.js"></script>
<script src="./scripts/sortFrcTables.js"></script>
