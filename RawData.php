<title>Raw Data</title>
<?php include("header.php") ?>
<div class="container row-offcanvas row-offcanvas-left">
  <div class="well column  col-lg-12  col-sm-12 col-xs-12" id="content">

    <div class="row pt-3 pb-3 mb-3">
      <h2>Raw Data</h2>
      <div id="freezeTableDiv">
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
          </colgroup>
          <thead>
            <tr>
              <th scope="col">Match #</th>
              <th scope="col">Team #</th>
              <th scope="col">Auton Leave</th>
              <th scope="col">Auton Amp Notes</th>
              <th scope="col">Auton Speaker Notes</th>
              <th scope="col">Teleop Amp Notes</th>
              <th scope="col">Teleop Speaker Notes</th>
              <th scope="col">Endgame Stage Level</th>
              <th scope="col">Endgame Harmony Level</th>
              <th scope="col">Endgame Spotlit</th>
              <th scope="col">Endgame Trap</th>
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
      var rowString = "<tr><td>" + dataObj[i]["matchnumber"] + "</td>" +
        "<td>" + dataObj[i]["teamnumber"] + "</td>" +
        "<td>" + dataObj[i]["autonleave"] + "</td>" +
        "<td>" + dataObj[i]["autonampnotes"] + "</td>" +
        "<td>" + dataObj[i]["autonspeakernotes"] + "</td>" +
        "<td>" + dataObj[i]["teleopampnotes"] + "</td>" +
        "<td>" + dataObj[i]["teleopspeakernotes"] + "</td>" +
        "<td>" + dataObj[i]["endgamestage"] + "</td>" +
        "<td>" + dataObj[i]["endgameharmony"] + "</td>" +
        "<td>" + dataObj[i]["endgamespotlit"] + "</td>" +
        "<td>" + dataObj[i]["endgametrap"] + "</td>" +
        "<td>" + dataObj[i]["died"] + "</td>" +
        "<td>" + dataObj[i]["comment"] + "</td>" +
        "<td>" + dataObj[i]["scoutname"] + "</td>" +
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