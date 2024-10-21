<title>Strategic Scouts Schedule</title>
<?php include("header.php") ?>
<div class="container row-offcanvas row-offcanvas-left">
  <div class="well column  col-lg-12  col-sm-12 col-xs-12" id="content">

    <div class="row pt-3 pb-3 mb-3">
      <h2>Strategic Scouting Schedule</h2>
      <div class="col-md-3">
          <button id="createButton" type="button" class="btn btn-primary">Create Schedule</button>
      </div>
    </div>
  </div>
  <div id="freezeTableDiv"> 
      <style type="text/css" media="screen">
      table tr {
          border: 1px solid black;
      }
      table td, table th {
           border-right: 1px solid black;
      }
      </style>
    <table id="matchTable" class="table table-striped table-hover sortable">
      <colgroup>
        <col span="1" style="background-color:transparent">
        <col span="1" style="background-color:#cfe2ff">
      </colgroup>
      <thead>
        <tr>
        <th scope="col">Match#</th>
        <th scope="col">Team Numbers</th>
        </tr>
      </thead>
      <tbody id="tableData">
      </tbody>
    </table>
  </div>
</div>


<?php include("footer.php") ?>
<script type="text/javascript" src="./external/DataTables/DataTables-1.11.5/js/jquery.dataTables.min.js"></script>

<script>
  src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"


  console.log("---> doing strategic page");

  var frozenTable = null;

  function dataToTable(dataObj) {
    $("#tableData").html(""); // Clear table
    for (let i = 0; i < dataObj.length; i++) {
      var rowString = "<tr><td align=\"center\">" + dataObj[i]["match_number"] + "</td>" +
           "<td align=\"center\">" + dataObj[i]["teams"] + "</td>" + "</td>";
      $("#tableData").append(rowString);
    }
  }

  // Figure out which matches and teams for strategic scouts 
  function determineMatches() {
    console.log("---> starting determineMatches()");
    $.get("tbaAPI.php", {
      getStrategicMatches: 1
    }).done(function(data) {
      var dataObj = JSON.parse(data);
      dataToTable(dataObj);
/*      setTimeout(function() {
        sorttable.makeSortable(document.getElementById("matchTable"));
        frozenTable = $('#freezeTableDiv').freezeTable({
          'backgroundColor': "white",
          'columnNum': 1,
          'frozenColVerticalOffset': 0
        });
     }, 1); */
    });
  }



  $(document).ready(function() {
    console.log("--->>> starting ready() for strategic");
    $("#createButton").click(function() {
      console.log("--->>> Create Schedule button clicked!");
      determineMatches();
    });

//    $("#matchTable").click(function() {
//      frozenTable.update();
//    });
  });
</script>
