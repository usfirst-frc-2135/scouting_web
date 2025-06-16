<?php
$title = 'Pit Status';
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
        <tbody id="pitScoutTable">
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php include 'inc/footer.php'; ?>

<!-- Javascript page handlers -->

<script>

  function createPitStatusTable(teams, names, images, pitInfo) {
    console.log("==> pitStatus.php: createPitStatusTable()");
    if (teams == null || names == null || images == null || pitInfo == null) {
      console.warn("createPitStatusTable: team, names, images, or pit lists are missing!")
      return null;
    }

    $("#pitScoutTable").html("");
    var row = "";
    for (let teamNum of teams) {
      var teamName = names[teamNum];
      row += "<tr>";
      if (teamName != "XX") {
        row += " <td>" + "<a href='teamLookup.php?teamNum=" + teamNum + "'>" + teamNum + "</a> - " + teamName + "</td>";
      } else {
        row += "  <td>" + "<a href='teamLookup.php?teamNum=" + teamNum + "'>" + teamNum + "</a>" + "</td>";
      }

      if (pitInfo[teamNum] != null) {
        row += "  <td class='bg-success'>Yes</td>";
      } else {
        row += "  <td>No</td>";
      }

      if ((images[teamNum] != null) && (images[teamNum].length > 0)) {
        row += "  <td class='bg-success'>Yes</td>";
      } else {
        row += "  <td>No</td>";
      }

      row += "</tr>";
      $("#pitScoutTable").html(row);
    }

    sortPitStatusTable("psTable");
  }

  // The entries are team numbers with " - <teamName>" at the end. We want to strip off the appended
  // teamName so it's just the team number for comparison. Also, a team number could end in a "B", "C",
  // "D", or "E", in which case we strip the letter off and just use the number for the comparison.
  function sortPitStatusTable(tableId) {
    console.log("==> pitStatus.php: sortTable(): id: " + tableId);
    var table = document.getElementById(tableId);
    var rows = Array.prototype.slice.call(table.querySelectorAll("tbody> tr"));

    rows.sort(function (rowA, rowB) { return compareTeamNumbers(rowA.cells[0].textContent, rowB.cells[0].textContent); });

    // Update the table body with the sorted rows.
    rows.forEach(function (row) {
      table.querySelector("tbody").appendChild(row);
    });
  }

  //
  // Process the generated html
  //
  $(document).ready(function () {
    $.get("api/tbaAPI.php", {
      getEventCode: true
    }, function (eventCode) {
      console.log("==> pitStatus.php - getEventCode: " + eventCode.trim());
      $("#navbarEventCode").html(eventCode);
    });

    // Get the list of teams and add the team names 
    console.log("index: getting teamlist from TBA using db_config event code");
    $.get("api/tbaAPI.php", {
      getTeamNamesList: 1
    }).done(function (teamNameList) {
      console.log("==> getTeamNamesList");
      var teamList = [];
      var namesList = {};
      if (teamNameList == null)
        alert("Can't load teamlist from TBA; check if TBA Key was set in db_config");
      else {
        var jsonTeamList = JSON.parse(teamNameList);
        for (let i in jsonTeamList) {
          var teamNum = jsonTeamList[i]["teamnum"];
          var teamName = jsonTeamList[i]["teamname"];
          teamList.push(teamNum);
          namesList[teamNum] = teamName;
        }

        // Get all the team images
        $.get("api/dbReadAPI.php", {
          getAllTeamImages: JSON.stringify(teamList)
        }).done(function (teamImageList) {
          console.log("pitStatus.php: getAllTeamImages:\n" + teamImageList);
          jsonImageList = JSON.parse(teamImageList);
          // Get all the teams pit scouted
          $.get("api/dbReadAPI.php", {
            getAllPitData: 1
          }).done(function (pitDataList) {
            console.log("==> getAllPitData");
            jsonPitList = JSON.parse(pitDataList);
            createPitStatusTable(teamList, namesList, jsonImageList, jsonPitList);
            // script instructions say this is needed, but it breaks table header sorting
            // sorttable.makeSortable(document.getElementById("psTable"));
          });
        });
      }
    });
  });

</script>

<script type="text/javascript" src="./scripts/compareTeamNumbers.js"></script>
