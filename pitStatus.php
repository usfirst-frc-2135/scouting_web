<?php
$title = 'Pit Scouting Status';
require 'inc/header.php';
?>

<div class="container row-offcanvas row-offcanvas-left">
  <div id="content" class="column card-lg-12  col-sm-12 col-xs-12">

    <!-- Page Title -->
    <div class="row pt-3 pb-3 mb-3">
      <h2><?php echo $title; ?></h2>
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

      <table id="psTable" class="table table-striped table-bordered table-hover sortable">
        <thead>
          <tr>
            <th class="sorttable_numeric">Team</th>
            <th>Pit Scouted?</th>
            <th>Photo Uploaded?</th>
          </tr>
        </thead>
        <tbody class="table-group-divider"> </tbody>
      </table>
    </div>
  </div>
</div>

<?php include 'inc/footer.php'; ?>

<!-- Javascript page handlers -->

<script>

  // Sort the pit status table by team number
  function sortPitStatusTable(tableId) {
    console.log("==> pitStatus: sortTable(): id: " + tableId);
    let tableRef = document.getElementById(tableId);
    let rows = Array.prototype.slice.call(tableRef.querySelectorAll("tbody> tr"));

    rows.sort(function (rowA, rowB) {
      return compareTeamNumbers(rowA.cells[0].textContent, rowB.cells[0].textContent);
    });

    rows.forEach(function (row) {
      tableRef.querySelector('tbody').appendChild(row);
    });
  }

  // Build the pit status table
  function buildPitStatusPage(teams, names, images, pitInfo) {
    console.log("==> pitStatus: buildPitStatusPage()");
    if (teams === null || names === null || images === null || pitInfo === null) {
      console.warn("buildPitStatusPage: team, names, images, or pit data are missing!")
      return null;
    }

    document.getElementById("psTable").querySelector('tbody').innerHTML = "";
    let row = "";
    for (let teamNum of teams) {
      let teamName = names[teamNum];
      row += "<tr>";
      if (teamName != "XX") {
        row += " <td>" + "<a href='teamLookup.php?teamNum=" + teamNum + "'>" + teamNum + "</a> - " + teamName + "</td>";
      } else {
        row += " <td>" + "<a href='teamLookup.php?teamNum=" + teamNum + "'>" + teamNum + "</a>" + "</td>";
      }

      if (pitInfo[teamNum] != null) {
        row += " <td class='bg-success'>Yes</td>";
      } else {
        row += " <td>No</td>";
      }

      if ((images[teamNum] != null) && (images[teamNum].length > 0)) {
        row += " <td class='bg-success'>Yes</td>";
      } else {
        row += " <td>No</td>";
      }

      row += "</tr>";
      document.getElementById("psTable").querySelector('tbody').innerHTML = row;
    }
  }

  //
  // Process the generated html
  //
  document.addEventListener("DOMContentLoaded", () => {

    $.get("api/tbaAPI.php", {
      getEventCode: true
    }, function (eventCode) {
      eventCode = eventCode.trim();
      console.log("=> pitStatus: getEventCode: " + eventCode);
      document.getElementById("navbarEventCode").innerHTML = eventCode;
    });

    // Get the list of teams and add the team names 
    $.get("api/tbaAPI.php", {
      getEventTeamNames: 1
    }).done(function (eventTeamNames) {
      console.log("=> getEventTeamNames");
      let teamList = [];
      let namesList = {};
      if (eventTeamNames === null)
        alert("Can't load teamlist from TBA; check if TBA Key was set in db_config");
      else {
        let jsonTeamList = JSON.parse(eventTeamNames);
        for (let i in jsonTeamList) {
          let teamNum = jsonTeamList[i]["teamnum"];
          let teamName = jsonTeamList[i]["teamname"];
          teamList.push(teamNum);
          namesList[teamNum] = teamName;
        }

        // Get all the team images
        $.get("api/dbReadAPI.php", {
          getAllTeamImages: JSON.stringify(teamList)
        }).done(function (teamImageList) {
          console.log("=> pitStatus: getAllTeamImages");
          jsonImageList = JSON.parse(teamImageList);
          // Get all the teams pit scouted
          $.get("api/dbReadAPI.php", {
            getAllPitData: 1
          }).done(function (pitDataList) {
            console.log("=> getAllPitData");
            jsonPitList = JSON.parse(pitDataList);
            buildPitStatusPage(teamList, namesList, jsonImageList, jsonPitList);
            sortPitStatusTable("psTable");
            // script instructions say this is needed, but it breaks table header sorting
            // sorttable.makeSortable(document.getElementById("psTable"));
          });
        });
      }
    });
  });

</script>

<script src="./scripts/compareTeamNumbers.js"></script>
