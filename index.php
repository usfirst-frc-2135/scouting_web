<title>2135 Scouting System</title>
<?php include("header.php") ?>

<div class="container row-offcanvas row-offcanvas-left">
  <div class="well column  col-lg-12  col-sm-12 col-xs-12" id="content">

    <div class="row pt-3 pb-3 mb-3">
      <h1>2024 Scouting Database</h1>
      <h4 id="pageTitle">Event Code: </h4>
        
      <table id="psTable" class="table table-striped table-bordered table-hover sortable">
        <thead>
          <tr>
            <td>Team</td>
            <td>Pit Scouted?</td>
            <td>Photo Taken?</td>
          </tr>
        </thead>
        <tbody id="pitScoutTable">
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php include("footer.php") ?>

<script>
  var allPitData = {};
  var teamList = [];
  var picLookup = {};
  var eventCode = null;

  function createTable() {
    if (allPitData == null || teamList == null) {
      return null;
    }
    $("#pitScoutTable").html("");
    var row = "";
    for (let teamNum of teamList) {
      row += "<tr>";
      // row += "  <td>"+teamNum+"</td>";
      row += "  <td>" + "<a class='text-black' href='teamLookup.php?teamNum=" + teamNum + "'>" + teamNum + "</a>" + "</td>";
      if (allPitData[teamNum] != null) {
        row += "  <td class='bg-success'>Yes</td>";
      } else {
        row += "  <td>No</td>";
      }
      if (picLookup[teamNum] != null) {
        if (picLookup[teamNum].length > 0) {
          row += "  <td class='bg-success'>Yes</td>";
        } else {
          row += "  <td>No</td>";
        }
      } else {
        row += "  <td>No</td>";
      }
      row += "</tr>";
    }
    $("#pitScoutTable").html(row);
  }

  // Assumes the entries are team numbers or match numbers. Note a team number could 
  // end in a "B", "C", "D", or "E", in which case we want to strip that off and just 
  // use the number for the comparison.
  function sortTable() {
    var table = document.getElementById("psTable");
    var rows = Array.prototype.slice.call(table.querySelectorAll("tbody> tr"));
    rows.sort(function(rowA,rowB) {
      var cellA = rowA.cells[0].textContent.trim();
      var cellB = rowB.cells[0].textContent.trim();

      // Remove any letters at the last char for the sort comparison.
      if (cellA.charAt(cellA.length-1) == "B" || cellA.charAt(cellA.length-1) == "C" ||
          cellA.charAt(cellA.length-1) == "D" || cellA.charAt(cellA.length-1) == "E")
      {      
        cellA = cellA.substr(0,cellA.length-1);
      } 
      
      if (cellB.charAt(cellB.length-1) == "B" || cellB.charAt(cellB.length-1) == "C" ||
          cellB.charAt(cellB.length-1) == "D" || cellB.charAt(cellB.length-1) == "E")
      { 
        cellB = cellB.substr(0,cellB.length-1);
      }   
          
      return(cellA - cellB);
    });

    // Update the table body with the sorted rows.
    rows.forEach(function(row) {
      table.querySelector("tbody").appendChild(row);
    });
  }

  $(document).ready(function() {

    $.get("./tbaAPI.php", {
      getEventCode: true
    }, function(data) {
      $("#pageTitle").html("Event Code: " + data);
    });
      
      
    $.get("./tbaAPI.php", {
      getTeamList: 1
    }).done(function(data) {
      console.log("index.php: getTeamList: data = "+data);

      if(data == null)
        alert("Can't load teamlist from TBA; check if TBA Key was set in dbStatus");

      teamList = JSON.parse(data);
      createTable();
      $.get("./readAPI.php", {
        getTeamsImages: JSON.stringify(teamList)
      }).done(function(data) {
        console.log("index.php: getTeamsImages = "+data);
        picLookup = JSON.parse(data);
        createTable();
        sorttable.makeSortable(document.getElementById("psTable"));
        sortTable();
      });
    });

    $.get("./readAPI.php", {
      getAllPitData: 1
    }).done(function(data) {
      allPitData = JSON.parse(data);
      createTable();
      sorttable.makeSortable(document.getElementById("psTable"));
      sortTable();
    });

  });
</script>
