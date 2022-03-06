<!-- this was copy and pasted from rawData.php so the java will need to change -->
<title>Averages</title>
<?php include("header.php") ?>
<div class="container row-offcanvas row-offcanvas-left">
    <div class="well column  col-lg-12  col-sm-12 col-xs-12" id="content">
        <h5>Averages</h5>
        
        <div class="row g-3">
            <div class="col-md-3">
                <div class="input-group">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Select</button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Qm</a></li>
                    <li><a class="dropdown-item" href="#">Qf</a></li>
                    <li><a class="dropdown-item" href="#">Sf</a></li>
                    <li><a class="dropdown-item" href="#">F</a></li>
                  </ul>
                  <input type="text" class="form-control" aria-label="Text input with dropdown button">
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="input-group">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Select</button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Qm</a></li>
                    <li><a class="dropdown-item" href="#">Qf</a></li>
                    <li><a class="dropdown-item" href="#">Sf</a></li>
                    <li><a class="dropdown-item" href="#">F</a></li>
                  </ul>
                  <input type="text" class="form-control" aria-label="Text input with dropdown button">
                </div>
            </div>
        </div>
        
      <div class="row pt-3 pb-3 mb-3">
          <div class="overflow-auto">
              
              <!-- Heading of table -->
              <table class="table table-striped table-bordered table-hover sortable">
              <thead>
                <tr>
                    <td rowspan="1" class="text-center fw-bold"></td>
                    <td rowspan="1" class="text-center fw-bold"></td>
                    <td colspan="2" class="text-center fw-bold">Total Pts</td>
                    <th colspan="2" class="text-center">Total Auto Pts</th>
                    <th colspan="2" class="text-center">Total Teleop Pts</th>
                    <th colspan="2" class="text-center">Climb Pts</th>
                    <th colspan="4" class="text-center">Auton</th>
                    <th colspan="4" class="text-center">Teleop</th>
                    <th colspan="5" class="text-center">Endgame</th>
                    <td colspan="1" class="text-center fw-bold">Died</td>
                </tr>
                <tr>
                    <th rowspan="1"></th>
                    <th rowspan="1"></th>
                    <th rowspan="1"></th>
                    <th rowspan="1"></th>
                    <th rowspan="1"></th>
                    <th rowspan="1"></th>
                    <th rowspan="1"></th>
                    <th rowspan="1"></th>
                    <th rowspan="1"></th>
                    <th rowspan="1"></th>
                    <th colspan="2" class="text-center">Upper</th>
                    <th colspan="2" class="text-center">Lower</th>
                    <th colspan="2" class="text-center">Upper</th>
                    <th colspan="2" class="text-center">Lower</th>
                    <th colspan="5" class="text-center">Climb %</th>
                </tr>
                <tr style="visibility: collapse;">
                  <th scope="col">Team #</th>
                  <th scope="col">OPR</th>
                  <th scope="col">AVG</th>
                  <th scope="col">MAX</th>
                  <th scope="col">AVG</th>
                  <th scope="col">MAX</th>
                  <th scope="col">AVG</th>
                  <th scope="col">MAX</th>
                  <th scope="col">AVG</th>
                  <th scope="col">MAX</th>
                  <th scope="col">AVG</th>
                  <th scope="col">MAX</th>
                  <th scope="col">AVG</th>
                  <th scope="col">MAX</th>
                  <th scope="col">AVG</th>
                  <th scope="col">MAX</th>
                  <th scope="col">AVG</th>
                  <th scope="col">MAX</th>
                  <th scope="col">0</th>
                  <th scope="col">1</th>
                  <th scope="col">2</th>
                  <th scope="col">3</th>
                  <th scope="col">4</th>
                  <th scope="col">#</th>
                </tr>
              </thead>
            </table>

            <!-- sortable table body -->
              <table id="rawDataTable" class="table table-striped table-bordered table-hover sortable">
              <thead>
                <tr>
                  <th scope="col">Team #</th>
                  <th scope="col">OPR</th>
                  <th scope="col">AVG</th>
                  <th scope="col">MAX</th>
                  <th scope="col">AVG</th>
                  <th scope="col">MAX</th>
                  <th scope="col">AVG</th>
                  <th scope="col">MAX</th>
                  <th scope="col">AVG</th>
                  <th scope="col">MAX</th>
                  <th scope="col">AVG</th>
                  <th scope="col">MAX</th>
                  <th scope="col">AVG</th>
                  <th scope="col">MAX</th>
                  <th scope="col">AVG</th>
                  <th scope="col">MAX</th>
                  <th scope="col">AVG</th>
                  <th scope="col">MAX</th>
                  <th scope="col">0</th>
                  <th scope="col">1</th>
                  <th scope="col">2</th>
                  <th scope="col">3</th>
                  <th scope="col">4</th>
                  <th scope="col">#</th>
                </tr>
                  
              </thead>
              <tbody id="tableData">
              </tbody>
            </table>
          </div>
        </div>
    </div>
</div>


<td colspan="2">&nbsp;</td>


<?php include("footer.php") ?>

<script>
  
  var teamList = new Set();
  var scoutingData = {};
  var tbaData = {};
  
  
  function dummyGet(dict, key){
    /* If key doesn't exist in given dict, return a 0. */
    console.log(dict);
    if (! dict){
      return 0;
    }
    if (key in dict){
      return dict[key];
    }
    return 0;
  }
  
  
  function dataToTable(){
    /* Write data to table */
    $("#tableData").html(""); // Clear Table
    for (let teamNum of teamList) {
      
      var climbPercentage = dummyGet(scoutingData[teamNum], "endgameclimbpercent");
      
      var rowString = "<tr>"
      + "<td><a href='teamLookup.php?teamNum="+teamNum+"'>" + teamNum + "</a></td>"
      + "<td>" + dummyGet(tbaData[teamNum], "totalPoints") + "</td>"
      + "<td>" + dummyGet(scoutingData[teamNum], "avgtotalpoints") + "</td>"
      + "<td>" + dummyGet(scoutingData[teamNum], "maxtotalpoints") + "</td>"
      + "<td>" + dummyGet(scoutingData[teamNum], "avgautopoints") + "</td>"
      + "<td>" + dummyGet(scoutingData[teamNum], "maxautopoints") + "</td>"
      + "<td>" + dummyGet(scoutingData[teamNum], "avgteleoppoints") + "</td>"
      + "<td>" + dummyGet(scoutingData[teamNum], "maxteleoppoints") + "</td>"
      + "<td>" + dummyGet(scoutingData[teamNum], "avgendgamepoints") + "</td>"
      + "<td>" + dummyGet(scoutingData[teamNum], "maxendgamepoints") + "</td>"
      + "<td>" + dummyGet(scoutingData[teamNum], "avgautonhighgoals") + "</td>"
      + "<td>" + dummyGet(scoutingData[teamNum], "maxautonhighgoals") + "</td>"
      + "<td>" + dummyGet(scoutingData[teamNum], "avgautonlowgoals") + "</td>"
      + "<td>" + dummyGet(scoutingData[teamNum], "maxautonlowgoals") + "</td>"
      + "<td>" + dummyGet(scoutingData[teamNum], "avgteleophighgoals") + "</td>"
      + "<td>" + dummyGet(scoutingData[teamNum], "maxteleophighgoals") + "</td>"
      + "<td>" + dummyGet(scoutingData[teamNum], "avgteleoplowgoals") + "</td>"
      + "<td>" + dummyGet(scoutingData[teamNum], "maxteleoplowgoals") + "</td>"
      + "<td>" + dummyGet(climbPercentage, 0) + "%</td>"
      + "<td>" + dummyGet(climbPercentage, 1) + "%</td>"
      + "<td>" + dummyGet(climbPercentage, 2) + "%</td>"
      + "<td>" + dummyGet(climbPercentage, 3) + "%</td>"
      + "<td>" + dummyGet(climbPercentage, 4) + "%</td>"
      + "<td>" + dummyGet(scoutingData[teamNum], "totaldied") + "</td>"
      + "</td>";
      
      $("#tableData").append(rowString);
    }
    sorttable.makeSortable(document.getElementById("rawDataTable"));
  }
    
  
  function addTeamKVToTeamList(data){
    // Build a teamList from either our data or TBA data
    for (var key in data){
      teamList.add(key);
    }
  }
    
    
  function requestAPI() {
    // Gets data from our local scouting data
    $.get( "readAPI.php", {getAllData: 1}).done( function( data ) {
      data = JSON.parse(data);
      var mdp = new matchDataProcessor(data);
      scoutingData = mdp.getAverages();
      addTeamKVToTeamList(scoutingData); 
      dataToTable();
    });
    
    // Gets data from our TBA API
    $.get( "tbaAPI.php", {getCOPRs: 1}).done( function( data ) {
      data = JSON.parse(data)["data"];
      addTeamKVToTeamList(data);
      tbaData = data;
      dataToTable();
    });
  }
    
    
  $(document).ready(function() {
    requestAPI();
  });
    
</script>
    
<script type="text/javascript" src="./scripts/matchDataProcessor.js"></script>