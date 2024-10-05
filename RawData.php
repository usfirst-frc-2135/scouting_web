<title>Raw Data</title>
<?php include("header.php") ?>
<div class="container row-offcanvas row-offcanvas-left">
  <div class="well column  col-lg-12  col-sm-12 col-xs-12" id="content">

    <div class="row pt-3 pb-3 mb-3">
      <h2>Raw Data</h2>
      <div id="freezeTableDiv">
          <style type="text/css" media="screen">
            table tr {
                border: 1px solid black;
            }
            table td, table th {
                border-right: 1px solid black;
            }
            </style>
        <table id="rawDataTable" class="table table-striped table-hover sortable">
          <colgroup>
            <col span="2" style="background-color:transparent">
            <col span="1" style="background-color:#cfe2ff">
            <col span="1" style="background-color:transparent">
            <col span="1" style="background-color:#cfe2ff">
            <col span="1" style="background-color:transparent">
            <col span="1" style="background-color:#cfe2ff">
            <col span="1" style="background-color:#transparent">
            <col span="1" style="background-color:#cfe2ff">
            <col span="1" style="background-color:transparent">
            <col span="1" style="background-color:#cfe2ff">
            <col span="1" style="background-color:#transparent">
            <col span="1" style="background-color:#cfe2ff">
            <col span="1" style="background-color:#transparent">
            <col span="1" style="background-color:#cfe2ff">
            <col span="1" style="background-color:#transparent">
            <col span="1" style="background-color:#cfe2ff">
            <col span="1" style="background-color:#transparent">
            <col span="1" style="background-color:#cfe2ff">
            <col span="1" style="background-color:#transparent">
            <col span="1" style="background-color:#cfe2ff">
          </colgroup>
          <thead>
            <tr>
              <th scope="col">Match #</th>
              <th scope="col">Team #</th>
              <th scope="col">Auton Leave</th>
              <th scope="col">Auton Amp Notes</th>
              <th scope="col">Auton Amp Misses</th>
              <th scope="col">Auton Speaker Notes</th>
              <th scope="col">Auton Speaker Misses</th>
              <th scope="col">Teleop Amp Used</th>
              <th scope="col">Teleop Amp Notes</th>
              <th scope="col">Teleop Amp Misses</th>
              <th scope="col">Teleop Speaker Notes</th>
              <th scope="col">Teleop Speaker Misess</th>
              <th scope="col">Teleop Passes</th>
              <th scope="col">Endgame Stage Level</th>
              <th scope="col">Endgame Harmony Level</th>
              <th scope="col">Endgame Trap</th>
              <th scope="col">Endgame Spotlit</th>
              <th scope="col">Died</th>
              <th scope="col">Comment</th>
              <th scope="col">Scout Name</th>
            </tr>
          </thead>
          <tbody id="tableData">
          </tbody>
        </table>

      </div>
    </div>
  </div>
</div>

<?php include("footer.php") ?>

<script>
  var frozenTable = null;

  function dataToTable(dataObj) {
    for (let i = 0; i < dataObj.length; i++) {
      var rowString = "<tr><td align=\"center\">" + dataObj[i]["matchnumber"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["teamnumber"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["autonleave"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["autonampnotes"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["autonampmisses"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["autonspeakernotes"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["autonspeakermisses"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["teleopampused"] + "</td>" + 
        "<td align=\"center\">" + dataObj[i]["teleopampnotes"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["teleopampmisses"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["teleopspeakernotes"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["teleopspeakermisses"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["teleoppasses"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["endgamestage"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["endgameharmony"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["endgametrap"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["endgamespotlit"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["died"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["comment"] + "</td>" +
        "<td align=\"center\">" + dataObj[i]["scoutname"] + "</td>" +
        "</td>";
      $("#tableData").append(rowString);

    }

  }

  function requestAPI() {
    //output: gets the API data from our server
    $.get("readAPI.php", {
      getAllData: 1
    }).done(function(data) {
      var dataObj = JSON.parse(data);
      dataToTable(dataObj);
      setTimeout(function() {
        sorttable.makeSortable(document.getElementById("rawDataTable"));
        frozenTable = $('#freezeTableDiv').freezeTable({
          'backgroundColor': "white",
          'columnNum': 2,
          'frozenColVerticalOffset': 0
        });
      }, 1);
    });

  }

  $(document).ready(function() {
    requestAPI();
    // sorttable.makeSortable(document.getElementById("rawDataTable"));

    $("#rawDataTable").click(function() {
      if (frozenTable) {
        frozenTable.update();
      }
    });
  });
</script>
