<title>Match Sheet</title>
<?php include("header.php") ?>
<div class="container row-offcanvas row-offcanvas-left">
  <div class="well column  col-lg-12  col-sm-12 col-xs-12" id="content">
    <div class="row g-3">
      <div class="g-4">
        <div class="input-group mb-3">
          <select class="form-select" id="writeCompLevel" aria-label="Comp Level Select">
            <option value="QM">QM</option>
            <option value="QF">QF</option>
            <option value="SF">SF</option>
            <option value="F">F</option>
          </select>
          <input id="writeMatchNumber" type="text" class="form-control" placeholder="Match Number" aria-label="writeMatchNumber">
          <button id="loadMatch" type="button" class="btn btn-primary">Load Match</button>
        </div>
        <h4 id="matchTitle">Match:</h4>
      </div>
      
      <table class="table table-bordered">
        <thead>
          <tr>
            <th colspan="2" class="text-center">Total Pts</th>
            <th colspan="2" class="text-center">Total Pieces</th>
            <th colspan="2" class="text-center">Total Climb Pts</th>
          </tr>
        </thead>
          <tbody>
            <tr>
            <td class="table-danger">&nbsp;</td>
            <td class="table-primary">&nbsp;</td>
            <td class="table-danger">&nbsp;</td>
            <td class="table-primary">&nbsp;</td>
            <td class="table-danger">&nbsp;</td>
            <td class="table-primary">&nbsp;</td>
            </tr>
          </tbody>
        </table>
    </div>
      
    <div class="row pt-3 pb-3 mb-3 gx-3">
      <div class="col-lg-4 col-sm-4 col-xs-4 gx-3">
        <div class="card text-white bg-danger mb-3">
          <div class="card-head">
            <h5 id="R0TeamNumber" class="card-title text-center">Team ????</h5>
            <div id="R0PicsCarousel" class="carousel slide" data-bs-ride="carousel">
              <div id="R0RobotPics" class="carousel-inner">
                
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#R0PicsCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#R0PicsCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </div>
          
          <div class="overflow-auto">
          <table class="table table-bordered table-danger">
            <thead>
              <tr>
                <th colspan="2" class="text-center fs-6">Auton</th>
                <th colspan="2" class="text-center fw-bold fs-6">Teleop</th>
                <th colspan="5" class="text-center fw-bold fs-6">Endgame</th>
              </tr>
              <tr>
                <th scope="col">Upper</th>
                <th scope="col">Lower</th>
                <th scope="col">Upper</th>
                <th scope="col">Lower</th>
                <th scope="col">0</th>
                <th scope="col">1</th>
                <th scope="col">2</th>
                <th scope="col">3</th>
                <th scope="col">4</th>
              </tr>
            </thead>
            <tbody id="R0DataTable">
                                
            </tbody>
          </table>
          </div>
        </div>
      </div>
      
      <div class="col-lg-4 col-sm-4 col-xs-4 gx-3">
        <div class="card text-white bg-danger mb-3">
          <div class="card-head">
            <h5 id="R1TeamNumber" class="card-title text-center">Team ????</h5>
            <div id="R1PicsCarousel" class="carousel slide" data-bs-ride="carousel">
              <div id="R1RobotPics" class="carousel-inner">
                
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#R1PicsCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#R1PicsCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </div>
          
          <div class="overflow-auto">
          <table class="table table-bordered table-danger">
            <thead>
              <tr>
                <th colspan="2" class="text-center fs-6">Auton</th>
                <th colspan="2" class="text-center fw-bold fs-6">Teleop</th>
                <th colspan="5" class="text-center fw-bold fs-6">Endgame</th>
              </tr>
              <tr>
                <th scope="col">Upper</th>
                <th scope="col">Lower</th>
                <th scope="col">Upper</th>
                <th scope="col">Lower</th>
                <th scope="col">0</th>
                <th scope="col">1</th>
                <th scope="col">2</th>
                <th scope="col">3</th>
                <th scope="col">4</th>
              </tr>
            </thead>
            <tbody id="R1DataTable">
                                
            </tbody>
          </table>
          </div>
        </div>
      </div>
      
      <div class="col-lg-4 col-sm-4 col-xs-4 gx-3">
        <div class="card text-white bg-danger mb-3">
          <div class="card-head">
            <h5 id="R2TeamNumber" class="card-title text-center">Team ????</h5>
            <div id="R2PicsCarousel" class="carousel slide" data-bs-ride="carousel">
              <div id="R2RobotPics" class="carousel-inner">
                
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#R2PicsCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#R2PicsCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </div>
          
          <div class="overflow-auto">
          <table class="table table-bordered table-danger">
            <thead>
              <tr>
                <th colspan="2" class="text-center fs-6">Auton</th>
                <th colspan="2" class="text-center fw-bold fs-6">Teleop</th>
                <th colspan="5" class="text-center fw-bold fs-6">Endgame</th>
              </tr>
              <tr>
                <th scope="col">Upper</th>
                <th scope="col">Lower</th>
                <th scope="col">Upper</th>
                <th scope="col">Lower</th>
                <th scope="col">0</th>
                <th scope="col">1</th>
                <th scope="col">2</th>
                <th scope="col">3</th>
                <th scope="col">4</th>
              </tr>
            </thead>
            <tbody id="R2DataTable">
                                
            </tbody>
          </table>
          </div>
        </div>
      </div>
    </div> 
    <div class="row pt-3 pb-3 mb-3 gx-3">
      <div class="col-lg-4 col-sm-4 col-xs-4 gx-3">
        <div class="card text-white bg-primary mb-3">
          <div class="card-head">
            <h5 id="B0TeamNumber" class="card-title text-center">Team ????</h5>
            <div id="B0PicsCarousel" class="carousel slide" data-bs-ride="carousel">
              <div id="B0RobotPics" class="carousel-inner">
                
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#B0PicsCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#B0PicsCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </div>
          
          <div class="overflow-auto">
          <table class="table table-bordered table-primary">
            <thead>
              <tr>
                <th colspan="2" class="text-center fs-6">Auton</th>
                <th colspan="2" class="text-center fw-bold fs-6">Teleop</th>
                <th colspan="5" class="text-center fw-bold fs-6">Endgame</th>
              </tr>
              <tr>
                <th scope="col">Upper</th>
                <th scope="col">Lower</th>
                <th scope="col">Upper</th>
                <th scope="col">Lower</th>
                <th scope="col">0</th>
                <th scope="col">1</th>
                <th scope="col">2</th>
                <th scope="col">3</th>
                <th scope="col">4</th>
              </tr>
            </thead>
            <tbody id="B0DataTable">
                                
            </tbody>
          </table>
          </div>
        </div>
      </div>
      
      <div class="col-lg-4 col-sm-4 col-xs-4 gx-3">
        <div class="card text-white bg-primary mb-3">
          <div class="card-head">
            <h5 id="B1TeamNumber" class="card-title text-center">Team ????</h5>
            <div id="B1PicsCarousel" class="carousel slide" data-bs-ride="carousel">
              <div id="B1RobotPics" class="carousel-inner">
                
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#B1PicsCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#B1PicsCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </div>
          
          <div class="overflow-auto">
          <table class="table table-bordered table-primary">
            <thead>
              <tr>
                <th colspan="2" class="text-center fs-6">Auton</th>
                <th colspan="2" class="text-center fw-bold fs-6">Teleop</th>
                <th colspan="5" class="text-center fw-bold fs-6">Endgame</th>
              </tr>
              <tr>
                <th scope="col">Upper</th>
                <th scope="col">Lower</th>
                <th scope="col">Upper</th>
                <th scope="col">Lower</th>
                <th scope="col">0</th>
                <th scope="col">1</th>
                <th scope="col">2</th>
                <th scope="col">3</th>
                <th scope="col">4</th>
              </tr>
            </thead>
            <tbody id="B1DataTable">
                                
            </tbody>
          </table>
          </div>
        </div>
      </div>
      
      <div class="col-lg-4 col-sm-4 col-xs-4 gx-3">
        <div class="card text-white bg-primary mb-3">
          <div class="card-head">
            <h5 id="B2TeamNumber" class="card-title text-center">Team ????</h5>
            <div id="B2PicsCarousel" class="carousel slide" data-bs-ride="carousel">
              <div id="B2RobotPics" class="carousel-inner">
                
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#B2PicsCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#B2PicsCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </div>
          
          <div class="overflow-auto">
          <table class="table table-bordered table-primary">
            <thead>
              <tr>
                <th colspan="2" class="text-center fs-6">Auton</th>
                <th colspan="2" class="text-center fw-bold fs-6">Teleop</th>
                <th colspan="5" class="text-center fw-bold fs-6">Endgame</th>
              </tr>
              <tr>
                <th scope="col">Upper</th>
                <th scope="col">Lower</th>
                <th scope="col">Upper</th>
                <th scope="col">Lower</th>
                <th scope="col">0</th>
                <th scope="col">1</th>
                <th scope="col">2</th>
                <th scope="col">3</th>
                <th scope="col">4</th>
              </tr>
            </thead>
            <tbody id="B2DataTable">
                                
            </tbody>
          </table>
          </div>
        </div>
      </div>
    </div> 
  </div>
</div>


        
<?php include("footer.php") ?>

<script>
  
  var localMatchData = null;
  var localMatchList = null;
  var localMatchNum = null;
  var localCompLevel = null;
  
  function checkGet(){
    let sp = new URLSearchParams(window.location.search);
    if (sp.has('matchNum') && sp.has('compLevel')){
      return [sp.get('matchNum'), sp.get('compLevel')];
    }
    return null;
  }
  
  function loadMatchData(successFunction){
    if(!localMatchData){
      $.get( "readAPI.php", {getAllData: 1}).done( function( data ) {
        data = JSON.parse(data);
        var mdp = new matchDataProcessor(data);
        localMatchData = mdp.getAverages();
        successFunction();
      });
    }
    else{
      successFunction();
    }
  }
  
  function loadMatchList(successFunction){
    if(!localMatchList){
      $.get( "tbaAPI.php", {getMatchList: 1}).done( function( data ) {
        rawMatchData = JSON.parse(data)["response"];
        localMatchList = {};
        for(let mi in rawMatchData){
          var newMatch = {};
          var match = rawMatchData[mi];
          newMatch["comp_level"]   = match["comp_level"];
          newMatch["match_number"] = match["comp_level"] == "qm" ? match["match_number"] : match["set_number"];
          newMatch["red_teams"]    = match["alliances"]["red"]["team_keys"];
          newMatch["blue_teams"]   = match["alliances"]["blue"]["team_keys"];
          localMatchList[makeKey(newMatch["match_number"], newMatch["comp_level"])] = newMatch;
        }
        successFunction();
      });
    }
    else {
      successFunction();
    }
  }
  
  function makeKey(matchNumber, compLevel){
    return compLevel.toUpperCase() + "_" + String(matchNumber).toUpperCase();
  }
  
  function loadMatch(matchNum, compLevel){
    // Pull Data
    localMatchNum = matchNum;
    localCompLevel = compLevel;
    loadMatchData(function(){loadMatchList(processMatchList)});
  }
  
  function processMatchList(){
    // Get Match Vector
    matchVector = localMatchList[makeKey(localMatchNum, localCompLevel)];
    if (!matchVector){
      alert(makeKey(localMatchNum, localCompLevel) + " does not exist!");
      return;
    }
    for(let i in matchVector["red_teams"]){
      displayTeam("R", i, strTeamToIntTeam(matchVector["red_teams"][i]));
    }
    for(let i in matchVector["blue_teams"]){
      displayTeam("B", i, strTeamToIntTeam(matchVector["blue_teams"][i]));
    }
  }
  
  
  function displayTeam(color, index, teamNum){
    $("#"+color+index+"TeamNumber").html(teamNum);
    var rd = localMatchData[teamNum];
    var row = "<tr>";
    row += "<td>" + rd["avgautonhighgoals"] + "</td>";
    row += "<td>" + rd["avgautonlowergoals"] + "</td>";
    row += "<td>" + rd["avgteleophighgoals"] + "</td>";
    row += "<td>" + rd["avgteleoplowergoals"] + "</td>";
    row += "<td>" + rd["endgameclimbpercent"][0] + "</td>";
    row += "<td>" + rd["endgameclimbpercent"][1] + "</td>";
    row += "<td>" + rd["endgameclimbpercent"][2] + "</td>";
    row += "<td>" + rd["endgameclimbpercent"][3] + "</td>";
    row += "<td>" + rd["endgameclimbpercent"][4] + "</td>";
    row += "</tr>";
    $("#"+color+index+"DataTable").append(row);
  }
  
  function strTeamToIntTeam(team){
    return parseInt(team.replace(/^(frc)/,''));
  }
  
  $(document).ready(function() {
    var initialGet = checkGet();
    if (initialGet){
      loadMatch(initialGet[0], initialGet[1]);
    }
    
    $("#loadMatch").click(function(){
      loadMatch($("#writeMatchNumber").val(), $("#writeCompLevel").val());
    });
  });
  
</script>
    
<script type="text/javascript" src="./scripts/matchDataProcessor.js"></script>