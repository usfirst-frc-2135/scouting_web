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
            <col span="1" style="background-color:#cfe2ff">
            <col span="1" style="background-color:transparent">
            <col span="1" style="background-color:#cfe2ff">
            <col span="1" style="background-color:transparent">
            <col span="1" style="background-color:#cfe2ff">
            <col span="1" style="background-color:#transparent">
            <col span="1" style="background-color:#cfe2ff">
            <col span="1" style="background-color:transparent">
            <col span="1" style="background-color:#cfe2ff">
          </colgroup>
          <thead>
            <tr>
              <th scope="col">Match #</th>
              <th scope="col">Team #</th>
              <th scope="col">Mobility</th>
              <th scope="col">Auton Cones Bottom</th>
              <th scope="col">Auton Cones Middle</th>
              <th scope="col">Auton Cones Top</th>   
              <th scope="col">Auton Cubes Bottom</th>
              <th scope="col">Auton Cubes Middle</th>
              <th scope="col">Auton Cubes Top</th> 
              <th scope="col">Auton Charge Level</th>  
              <th scope="col">Teleop Cones Bottom</th>
              <th scope="col">Teleop Cones Middle</th>
              <th scope="col">Teleop Cones Top</th>   
              <th scope="col">Teleop Cubes Bottom</th>
              <th scope="col">Teleop Cubes Middle</th>
              <th scope="col">Teleop Cubes Top</th>
              <th scope="col">Endgame Charge Level</th>
              <th scope="col">Died</th>
              <th scope="col">Picked Up Cube</th>
              <th scope="col">Picked Up Upright Cone</th>
              <th scope="col">Picked Up Tipped Cone</th>
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
        "<td>" + dataObj[i]["exitcommunity"] + "</td>" +
        "<td>" + dataObj[i]["autonconesbottom"] + "</td>" +
        "<td>" + dataObj[i]["autonconesmiddle"] + "</td>" +
        "<td>" + dataObj[i]["autonconestop"] + "</td>" +
        "<td>" + dataObj[i]["autoncubesbottom"] + "</td>" +
        "<td>" + dataObj[i]["autoncubesmiddle"] + "</td>" +
        "<td>" + dataObj[i]["autoncubestop"] + "</td>" +
        "<td>" + dataObj[i]["autonchargelevel"] + "</td>" +
        "<td>" + dataObj[i]["teleopconesbottom"] + "</td>" +
        "<td>" + dataObj[i]["teleopconesmiddle"] + "</td>" +
        "<td>" + dataObj[i]["teleopconestop"] + "</td>" +
        "<td>" + dataObj[i]["teleopcubesbottom"] + "</td>" +
        "<td>" + dataObj[i]["teleopcubesmiddle"] + "</td>" +
        "<td>" + dataObj[i]["teleopcubestop"] + "</td>" +  
        "<td>" + dataObj[i]["endgamechargelevel"] + "</td>" +
        "<td>" + dataObj[i]["died"] + "</td>" +
        "<td>" + dataObj[i]["pickedupcube"] + "</td>" +
        "<td>" + dataObj[i]["pickedupupright"] + "</td>" +
        "<td>" + dataObj[i]["pickeduptipped"] + "</td>" + 
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