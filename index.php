<title>2135 Scouting System</title>
<?php include("header.php") ?>

<div class="container row-offcanvas row-offcanvas-left">
    <div class="well column  col-lg-12  col-sm-12 col-xs-12" id="content">
    
      <div class="row pt-3 pb-3 mb-3">
        <h1>2135 2022 Scouting Database</h1>

        <table id="psTable" class="table table-striped table-bordered table-hover sortable">
          <thead>
            <tr>
              <td>Team</td>
              <td>Pit Scouted?</td>
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

  var allPitData = null;
  var teamList = null;

  function createTable(){
    if (allPitData == null || teamList == null){
      return null;
    }
    $("#pitScoutTable").html("");
    var row = "";
    for (let teamNum of teamList) {
      row += "<tr>";
      row += "  <td>"+teamNum+"</td>";
      if (allPitData[teamNum] != null){
        row += "  <td class='bg-success'>Yes</td>";
      }
      else {
        row += "  <td>No</td>";
      }
      row += "</tr>";
    }
    $("#pitScoutTable").html(row);
  }

  $(document).ready(function() {

    $.get( "./tbaAPI.php", {getTeamList: 1}).done( function( data ) {
      teamList = JSON.parse(data);        
      createTable();
      sorttable.makeSortable(document.getElementById("psTable"));
    });
    
    
    $.get( "./readAPI.php", {getAllPitData: 1}).done( function( data ) {
      allPitData = JSON.parse(data);        
      createTable();
      sorttable.makeSortable(document.getElementById("psTable"));
    });
    
  });
</script>
