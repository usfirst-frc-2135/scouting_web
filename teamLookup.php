<title>Team Lookup</title>
<?php include("header.php") ?>
<div class="container row-offcanvas row-offcanvas-left">
    <div class="well column  col-lg-12  col-sm-12 col-xs-12" id="content">
        <div class="row pt-3 pb-3 mb-3 gx-3">
        
        <div>
          <div class="input-group mb-3">
            <input id="writeTeamNumber" type="text" class="form-control" placeholder="writeTeamNumber" aria-label="writeTeamNumber">
            <button id="loadTeam" type="button" class="btn btn-primary">Load Team</button>
          </div>
        </div>
        
        
            <div class="col-lg-6 col-sm-6 col-xs-6 gx-3">
                <div class="card mb-3">
                  <div class="card-body">
                      <h5 id="teamTitle" class="card-title">Team ????</h5>
                      <div id="robotPicsCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div id="robotPics" class="carousel-inner">
                          
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#robotPicsCarousel" data-bs-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#robotPicsCarousel" data-bs-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Next</span>
                        </button>
                      </div>
                    
                      <div class="overflow-auto">
                            <table class="table table-striped table-hover sortable">
                              <thead>
                                <tr>
                                  <th scope="col">Batteries</th>
                                  <th scope="col">Chargers</th>
                                  <th scope="col">Pit</th>
                                  <th scope="col">Spare Parts</th>
                                  <th scope="col">Programming</th>
                                  <th scope="col">Drive Motors</th>
                                </tr>
                              </thead>
                                
                                <!-- pit data-- use this somewhere -->
                                
                              <tbody id="pitData">
                              </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">All Matches</h5>
                        <div class="overflow-auto">
                            <table class="table table-striped table-hover sortable">
                              <thead>
                                <tr>
                                  <th scope="col">Match #</th>
                                  <th scope="col">Start Position</th>
                                  <th scope="col">Tarmac Cross</th>
                                  <th scope="col">Auto Upper Hub</th>
                                  <th scope="col">Auto Low Hub</th>
                                  <th scope="col">Teleop Upper Hub</th>
                                  <th scope="col">Teleop Low Hub</th>
                                  <th scope="col">Climb</th>
                                  <th scope="col">Died</th>
                                </tr>
                              </thead>
                                <tbody id="allMatchesTable">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-xs-6 gx-3">
                <div class="card mb-3">
                     <div class="card-body">
                        <h5 class="card-title">Match Averages</h5>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="overflow-auto">
                                        <h5 class="text-center">Auton</h5>
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                              <td>&nbsp;</td>
                                              <th scope="col">1</th>
                                              <th scope="col">2</th>
                                              <th scope="col">3</th>
                                              <th scope="col">4</th>
                                              <th scope="col">5</th>
                                              <th scope="col">6</th>
                                            </tr>
                                            </thead>
                                            <tbody id="autoStartTable">
                                                <tr>
                                                <th scope="row">Start</th>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="table table-striped">
                                            <thead>
                                              <tr>
                                                <td>&nbsp;</td>
                                                <th scope="col">AVG</th>
                                                <th scope="col">MAX</th>
                                              </tr>
                                            </thead>
                                            <tbody id="autoHubTable">
                                                <tr>
                                                    <th scope="row">Cross</th>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Upper Hub</th>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Lower Hub</th>
                                                </tr>
                                            </tbody>
                                            <tfoot id="autoHubTotalTable">
                                                <tr>
                                                    <th scope="col">TOTAL</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                         <div class="card mb-3">
                                <div class="card-body">
                                    <div class="overflow-auto">
                                        <h5 class="text-center">Teleop</h5>
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                              <td>&nbsp;</td>
                                              <th scope="col">AVG</th>
                                              <th scope="col">MAX</th>
                                            </tr>
                                            </thead>
                                            <tbody id="teleopHubTable">
                                                <tr>
                                                    <th scope="row">Upper Hub</th>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Lower Hub</th>
                                                </tr>
                                            </tbody>
                                            <tfoot id="teleopHubTotalTable">
                                                <tr>
                                                    <th scope="col">TOTAL</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                         <div class="card mb-3">
                                <div class="card-body">
                                    <div class="overflow-auto">
                                        <h5 class="text-center">Endgame</h5>
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                              <td>&nbsp;</td>
                                              <th scope="col">0</th>
                                              <th scope="col">1</th>
                                              <th scope="col">2</th>
                                              <th scope="col">3</th>
                                              <th scope="col">4</th>
                                            </tr>
                                            </thead>
                                            <tbody id="climbTable">
                                                <tr>
                                                  <th scope="row">Climb %</th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                         <table class="table table-striped">
                                            <thead>
                                            <tr>
                                              <td>&nbsp;</td>
                                              <th scope="col">AVG</th>
                                              <th scope="col">MAX</th>
                                            </tr>
                                            </thead>
                                            <tbody id="totalTable">
                                                <tr >
                                                    <th scope="row">Total Points</th>
                                                </tr>
                                            </tbody>
                                        </table>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Graph</h5>
                        </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Start Position Reference</h5>
                    </div>
                   <img src="./images/startingPositionB.png" class="card-img-top" alt="starting position image">
                </div>
            </div>            
        </div>
    </div>
</div>

        
        
<?php include("footer.php") ?>

<script>
  
  function writeTableRow(tbodyID, dict, keys){
    var row = "<tr>";
    for(let i = 0; i < keys.length; i++){
      row += "<td>"+dict[keys[i]]+"</td>";
    }
    row += "</tr>";
    $("#"+tbodyID).append(row);
  }
  
  function dataToMatchTable(dataObj){
    for (let i = 0; i < dataObj.length; i++) {
      writeTableRow("allMatchesTable", dataObj[i], ["matchnumber", "startpos", "tarmac",
        "autonhighpoints", "autonlowpoints", "teleophighpoints", "teleoplowpoints", "climbed", "died"]);
    }
  }
  
  function dataToAvgTables(avgs){
    // Auton Scores
    avgs["autostartpercent"]["autostr"] = "<b>Start %</b>";
    avgs["crossstr"] = "<b>Cross %</b>";
    avgs["upperstr"] = "<b>Upper Cargo</b>";
    avgs["lowerstr"] = "<b>Lower Cargo</b>";
    avgs["totalstr"] = "<b>Total Points</b>";
    avgs["endgameclimbpercent"]["climbstr"] = "<b>Climb %</b>";
    writeTableRow("autoStartTable", avgs["autostartpercent"], ["autostr", 1, 2, 3, 4, 5, 6]);
    writeTableRow("autoHubTable", avgs, ["crossstr", "tarmacpercent"]);
    writeTableRow("autoHubTable", avgs, ["upperstr", "avgautonhighgoals", "maxautonhighgoals"]);
    writeTableRow("autoHubTable", avgs, ["lowerstr", "avgautonlowergoals", "maxautonlowergoals"]);
    writeTableRow("autoHubTotalTable", avgs, ["totalstr", "avgautopoints", "maxautopoints"]);
    
    // Teleop Scores
    writeTableRow("teleopHubTable", avgs, ["upperstr", "avgteleophighgoals", "maxteleophighgoals"]);
    writeTableRow("teleopHubTable", avgs, ["lowerstr", "avgteleoplowergoals", "maxteleoplowergoals"]);
    writeTableRow("teleopHubTotalTable", avgs, ["totalstr", "avgteleoppoints", "maxteleoppoints"]);
    
    // Climb Table
    writeTableRow("climbTable", avgs["endgameclimbpercent"], ["climbstr", 0, 1, 2, 3, 4]);
    
    // Total Table
    writeTableRow("totalTable", avgs, ["totalstr", "avgtotalpoints", "maxtotalpoints"]);
  }
    
  function checkGet(){
    let sp = new URLSearchParams(window.location.search);
    if (sp.has('teamNum')){
      return sp.get('teamNum')
    }
    return null;
  }
    
    function loadTeamPics(teamPics){
      /* Takes list of Team Pic paths and loads them
      */
      var first = true;
      for(let uri of teamPics){
        var tags = "";
        if (first){
          tags += "<div class='carousel-item active'>";
        }
        else {
          tags += "<div class='carousel-item'>";
        }
        first = false;
        tags += "  <img src='./"+uri+"' class='d-block w-100'>";
        tags += "</div>";
        $("#robotPics").append(tags);
      }
    }
    
    function setTeamTitle(team){
      $("#teamTitle").html("Team " + team);
    }
    
    function processMatchData(team, data){
      var mdp = new matchDataProcessor(data);
      processedData = mdp.getAverages()[team];
      dataToMatchTable(data);
      dataToAvgTables(processedData);
    }
    
    
    function processPitData(data){
      if (!data || !data.length){
        data["sparepartsstring"] = data["spareparts"] ? "yes" : "no";
        writeTableRow("pitData", data, ["numbatteries", "numchargers", "pitorg", "sparepartsstring", "proglanguage", "drivemotors"]);
      }
    }
    
    function loadTeam(team){
      /* This is the main function that runs when we want to load a new team onto the page
      
      */
      
      // Clear existing data
      $("#robotPics").html("");
      $("#teamTitle").html("");
      $("#pitData").html("");
      $("#allMatchesTable").html("");
      $("#autoStartTable").html("");
      $("#autoHubTable").html("");
      $("#autoHubTotalTable").html("");
      $("#teleopHubTable").html("");
      $("#teleopHubTotalTable").html("");
      $("#climbTable").html("");
      $("#totalTable").html("");
      
      // Write new data
      setTeamTitle(team);
      
      // Add new images
      $.get( "readAPI.php", {getTeamImages: team}).done( function( data ) {
        var listOfImages = JSON.parse(data);        
        loadTeamPics(listOfImages);
      });
      
      // Add Match Scouting Data
      $.get( "readAPI.php", {getTeamData: team}).done( function( data ) {
        matchData = JSON.parse(data);        
        processMatchData(team, matchData);
      });
      
      // Add Pit Scouting Data
      $.get( "readAPI.php", {getTeamPitData: team}).done( function( data ) {
        pitData = JSON.parse(data);        
        processPitData(pitData);
      });
      
    }
    
    $(document).ready(function() {
        var initTeamNumber = checkGet()
        if (initTeamNumber){
          loadTeam(initTeamNumber);
        }
        
        $("#loadTeam").click(function(){
          loadTeam($("#writeTeamNumber").val());
        });
    });
    
    
</script>
    
<script type="text/javascript" src="./scripts/matchDataProcessor.js"></script>