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

      <!-- First column of data starts here -->
      <div class="col-lg-6 col-sm-6 col-xs-6 gx-3">
        <div class="card mb-3">
          <div class="card-body">
            <h5 id="teamTitle" class="card-title">Team # </h5>
            <!-- Robot photo carousel section -->
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
              
              <!-- Auton Coral collapsible graph -->
            <div class="card mb-3">
              <div class="card-body"> 
                <div class="overflow-auto">
      		  <h5 class="text-center"> 
                    <a href="#collapseAutonCoralGraph" data-bs-toggle="collapse" aria-expanded="false"> Auton Coral Graph</a> </h5>
                  <div class="collapse" id="collapseAutonCoralGraph">
                    <canvas id="myChart" width="400" height="400"></canvas>
                  </div>
                </div>
              </div> 
            </div>

            <!-- Auton collapsible graph -->
            <div class="card mb-3">
              <div class="card-body"> 
                <div class="overflow-auto">
      		  <h5 class="text-center"> 
                    <a href="#collapseAutonGraph" data-bs-toggle="collapse" aria-expanded="false"> Auton Graph</a> </h5>
                  <div class="collapse" id="collapseAutonGraph">
                    <canvas id="myChart2" width="400" height="400"></canvas>
                  </div>
                </div>
              </div> 
            </div>
            
            <!-- Teleop Coral collapsible graph -->
            <div class="card mb-3">
              <div class="card-body">
                <div class="overflow-auto">
                  <h5 class="text-center"> 
                    <a href="#collapseTeleopCoralGraph" data-bs-toggle="collapse" aria-expanded="false"> Teleop Coral Graph</a> </h5>
                  <div class="collapse" id="collapseTeleopCoralGraph">
                    <canvas id="myChart3" width="400" height="400"></canvas>
                  </div>
                </div>
              </div>
            </div>
              
            <!-- Teleop collapsible graph -->
            <div class="card mb-3">
              <div class="card-body">
                <div class="overflow-auto">
                  <h5 class="text-center"> 
                    <a href="#collapseTeleopGraph" data-bs-toggle="collapse" aria-expanded="false"> Teleop Graph</a> </h5>
                  <div class="collapse" id="collapseTeleopGraph">
                    <canvas id="myChart4" width="400" height="400"></canvas>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Endgame collapsible graph -->
            <div class="card mb-3">
              <div class="card-body">
                <div class="overflow-auto">
                  <h5 class="text-center"> 
                    <a href="#collapseEndgameGraph" data-bs-toggle="collapse" aria-expanded="false"> Endgame Graph</a> </h5>
                  <div class="collapse" id="collapseEndgameGraph">
                    <canvas id="myChart5" width="400" height="400"></canvas>
                  </div>
                </div>
              </div>
            </div>
                  
            <!-- Pit Scouting 1st row -->
            <div class="overflow-auto">
              <table class="table table-striped">
                <thead>
                  <colgroup>
                    <col span="1" style="background-color:transparent">
                    <col span="1" style="background-color:#cfe2ff">
                    <col span="1" style="background-color:transparent">
                    <col span="1" style="background-color:#cfe2ff">
                    <col span="1" style="background-color:transparent">
                  </colgroup>
                  <tr>
                    <th scope="col" style="width:25%">Batt</th>
                    <th scope="col" style="width:25%">Pit</th>
                    <th scope="col" style="width:25%">Spare Parts</th>
                    <th scope="col" style="width:25%">Vision</th>
                  </tr>
                </thead>
                <tbody id="pitRow1">
                </tbody>  
              </table>
            </div>
                  
            <!-- Pit Scouting 2nd row -->
            <div class="overflow-auto">
              <table class="table table-striped">
                <thead>
                  <colgroup>
                    <col span="1" style="background-color:transparent">
                    <col span="1" style="background-color:#cfe2ff">
                    <col span="1" style="background-color:transparent">
                    <col span="1" style="background-color:#cfe2ff">
                    <col span="1" style="background-color:transparent">
                    <col span="1" style="background-color:#cfe2ff">
                  </colgroup>
                  <tr>
                    <th scope="col" style="width:25%">Drive Motors</th>
                    <th scope="col" style="width:25%">Prep</th>
                    <th scope="col" style="width:25%">Swerve</th>
                    <th scope="col" style="width:25%">Lang</th>
                  </tr>  
                </thead>
                <tbody id="pitRow2">
                </tbody>
              </table>
            </div>
          </div>

          <!-- Comments section -->
          <div class="overflow-auto">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">Comments</th>
                  <th scope="col">Scout</th>
                </tr>
              </thead>
            <tbody id="comments">
            </tbody>
          </table>
        </div>

        <!-- All Matches collapsible table -->
        <div class="card mb-3">
          <div class="card-body">
            <div class="overflow-auto">
              <h5 class="text-center"> 
                <a href="#collapseAllMatches" data-bs-toggle="collapse" aria-expanded="false"> All Matches </a> </h5>
                <div class="collapse" id="collapseAllMatches">
                <div class="overflow-auto" id="freezeTableDiv">
                  <style type="text/css" media="screen">
                    table tr {
                      border: 1px solid black;
                    }
                    table td, table th {
                      border-right: 1px solid black;
                    }
                  </style>
                  <table id="sortableAllMatches" class="table table-striped table-hover sortable">
                    <colgroup>
                      <col span="1" style="background-color:transparent">
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
                      <col span="1" style="background-color:transparent"> 
                      <col span="1" style="baclground-color:#cfe2ff">
                      <col span="1" style="background-color:transparent"> 
                      <col span="1" style="baclground-color:#cfe2ff">
                      <col span="1" style="background-color:transparent"> 
                      <col span="1" style="baclground-color:#cfe2ff">
                    </colgroup>
                    <thead>
                        <style type="text/css" media="screen">
                            #sortableAllMatches tr, #sortableAllMatches td, #sortableAllMatches th {
                                border: 1px solid black;
                            }
                            </style>
                      <tr>
                        <th scope="col">Match</th>
                        <th scope="col">Auton Leave</th>
                        <th scope="col">Auton Amp Notes</th>
                        <th scope="col">Auton Amp Misses</th>
                        <th scope="col">Auton Speaker Notes</th>
                        <th scope="col">Auton Speaker Misses</th>
                        <th scope="col">Teleop Amp Used</th>
                        <th scope="col">Teleop Amp Notes</th>
                        <th scope="col">Teleop Amp Misses</th>
                        <th scope="col">Teleop Speaker Notes</th>
                        <th scope="col">Teleop Speaker Misses</th>
                        <th scope="col">Teleop Passes</th>
                        <th scope="col">Endgame Stage Level</th>
                        <th scope="col">Endgame Harmony Level</th>
                        <th scope="col">Endgame Trap </th>
                        <th scope="col">Endgame Spotlit </th>
                        <th scope="col">Died</th>
                        <th scope="col">Scout Name</th>
                      </tr>
                    </thead>
                    <tbody id="allMatchesTable">
                    </tbody>
                  </table>
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Second Column of Data starts here -->
      <div class="col-lg-6 col-sm-6 col-xs-6 gx-3">
        <div class="card mb-3">
          <div class="card-body">
  
            <!-- Match Total Points section -->
            <div class="card mb-3">
              <div class="card-body">
                <div class="overflow-auto">
                  <h5 class="text-center">Match Total Notes </h5>
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <td>&nbsp;</td>
                        <th scope="col">AVG</th>
                        <th scope="col">MAX</th>
                      </tr>
                    </thead>
                    <tbody id="totalTable">
                      <tr>
                        <th scope="row">Total Notes</th>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
  
            <!-- Auton Points section -->
            <div class="card mb-3">
              <div class="card-header">
                <div class="overflow-auto">
                  <h5 class="text-center"> <a href="#collapseAuton" data-bs-toggle="collapse" aria-expanded="false"> Auton </a></h5>
                  <div class="collapse" id="collapseAuton">
                    <div class="card card-body">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <td>&nbsp;</td>
                            <th scope="col">AVG</th>
                            <th scope="col">MAX</th>
                          </tr>
                        </thead>
                        <tbody id="autoTable">
                         <tr>
                            <th scope="row">Amp Notes</th>
                          </tr>
                          <tr>
                            <th scope="row">Speaker Notes</th>
                          </tr>
                          <tr>
                            <th scope="row">Speaker Accuracy%</th>
                          </tr>
                        </tbody>
                        <tfoot id="autoTotalTable">
                          <tr>
                            <th scope="col">Total Notes</th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Teleop Points section -->
            <div class="card mb-3">
              <div class="card-header">
                <div class="overflow-auto">
                  <h5 class="text-center"> <a href="#collapseTeleop" data-bs-toggle="collapse" aria-expanded="false"> Teleop </a> </h5>
                  <div class="collapse" id="collapseTeleop">
                    <div class="card card-body">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <td>&nbsp;</td>
                            <th scope="col">AVG</th>
                            <th scope="col">MAX</th>
                          </tr>
                        </thead>
                        <tbody id="teleopTable">
                          <tr>
                            <th scope="row">Amp Notes</th>
                          </tr>
                          <tr>
                            <th scope="row">Speaker Notes</th>
                          </tr>
                          <tr>
                            <th scope="row">Passes</th>
                          </tr>
                          <tr>
                            <th scope="row">Speaker Accuracy%</th>
                          </tr>
                        </tbody>
                        <tfoot id="teleopTotalTable">
                          <tr>
                            <th scope="col">Total Notes</th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Endgame Points section -->
            <div class="card mb-3">
              <div class="card-header">
                <div class="overflow-auto">
                  <h5 class="text-center"> <a href="#collapseEndgame" data-bs-toggle="collapse" aria-expanded="false"> Endgame </a> </h5>
                  <div class="collapse" id="collapseEndgame">
                    <div class="card card-body">
                      <table class="table">
                        <thead>
                          <tr>
                            <td>&nbsp;</td>
                            <th scope="col">N</th>
                            <th scope="col">P</th>
                            <th scope="col">O</th>
                          </tr>
                        </thead>
                        <tbody id="endgameStageTable">
                          <tr>
                            <th scope="row" style="background-color:rgb(240,240,240);">Stage Level %</th>
                          </tr>
                          </tbody>
                          <thead>
                          <tr>
                            <td>&nbsp;</td>
                            <th scope="col">0</th>
                            <th scope="col">1</th>
                            <th scope="col">2</th>
                          </tr>
                        </thead>
                          <tbody id="endgameHarmonyTable">
                          <tr>
                            <th scope="row" style="background-color:rgb(240,240,240);">Harmony Level %</th>
                            </tr>
                        </tbody>
                        <thread>
                            <tr>
                                <td>&nbsp;</td>
                                <th scope="col"></th>
                            </tr>
                        </thread>
                          <tbody id="endgameTrapTable">
                          <tr>
                            <th scope="row" style="background-color:rgb(240,240,240);">Trap Note %</th>
                            </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
       
            <!-- HOLD Drive Rank graph 
            <div class="overflow-auto">
              <div class="card mb-3">
                <div class="card-body"> 
                  <div class="overflow-auto">
                    <h5 class="text-center"> 
                      <a href="#collapsedriveRankGraph" data-bs-toggle="collapse" aria-expanded="false"> Drive Rank Graph</a> </h5>
                    <div class="collapse" id="collapsedriveRankGraph">
                      <canvas id="myChart4" width="400" height="350"></canvas>
                    </div>
                  </div>
                </div>
              </div>  
            </div>
HOLD-->
			  
         </div>
        </div>
       </div>
      </div>
     </div>
    </div>

<?php include("footer.php") ?>

<script>
  var frozenTable = null;
    
  var chartDefined = false;
  var myChart;    

  var chart2Defined = false;
  var myChart2;
    
  var chart3Defined = false;
  var myChart3;    
    
  var chart4Defined = false;
  var myChart4;
	
  var chart5Defined = false;
  var myChart5;
    
//for old drive rank graph?   
/*    
  var chart4Defined = false;
  var myChart4;
*/
  function writeTableRow(tbodyID, dict, keys) {
    var row = "<tr>";
    for (let i = 0; i < keys.length; i++) {
      row += "<td>" + dict[keys[i]] + "</td>";
    }
    row += "</tr>";
    $("#" + tbodyID).append(row);
  }

  function dataToCommentTable(commentObj) {
    for (let i = 0; i < commentObj.length; i++) {
      if (commentObj[i].comment === "-") {
        continue;
      }
      writeTableRow("comments", commentObj[i], ["comment", "scoutname"]);
    }
  }
  function dataToAvgTables(avgs) {
    //Auton Scores
      /*
    avgs["amprowstr"] = "<b>Amp Notes</b>";
    avgs["speakerrowstr"] = "<b>Speaker Notes</b>";
    avgs["speakerautonaccuracyrowstr"] = "<b>Speaker Accuracy%</b>";
    avgs["totalstr"] = "<b>Total Notes</b>";
      */
    /*writeTableRow("autoTable", avgs, ["amprowstr", "avgautonamps", "maxautonamps"]);
    writeTableRow("autoTable", avgs, ["speakerrowstr", "avgautonspeaker", "maxautonspeaker"]);
    writeTableRow("autoTable", avgs, ["speakerautonaccuracyrowstr", "autonSpeakerShootPercent"]);
    writeTableRow("autoTotalTable", avgs, ["totalstr", "avgautonotes", "maxautonotes"]);
    */
      
    // Teleop Scores
      /*
    avgs["amprowstr"] = "<b>Amp Notes</b>";
    avgs["speakerrowstr"] = "<b>Speaker Notes</b>";
    avgs["speakeraccuracyrowstr"] = "<b>Speaker Accuracy%</b>";
    avgs["passesrowstr"] = "<b>Passes</b>";
    avgs["totalstr"] = "<b>Total Notes</b>";
    */
     /* 
    writeTableRow("teleopTotalTable", avgs, ["totalstr", "avgteleopnotes", "maxteleopnotes"]);
    writeTableRow("teleopTable", avgs, ["amprowstr", "avgteleopampnotes", "maxteleopampnotes"]);
    writeTableRow("teleopTable", avgs, ["speakerrowstr", "avgteleopspeakernotes", "maxteleopspeakernotes"]);
    writeTableRow("teleopTable", avgs, ["speakeraccuracyrowstr", "teleopSpeakerShootPercent"]) 
    writeTableRow("teleopTable", avgs, ["passesrowstr", "avgPasses", "maxPasses"]);
      */
    // Endgame Climb Table
    /*  
    avgs["endgamestagepercent"]["endgamestagestr"] = "<b>Stage Level %</b>";
    avgs["endgameharmonypercent"]["endgameharmonystr"] = "<b>Harmony Level %</b>";
    avgs["trapPercentage"]["endgametrapstr"] = "<b>Trap Note %</b>";
    var stageLevel = avgs["endgamestagepercent"];
    stageLevel["stagestr"] = "<b>Stage Level %</b>";
    var harmonyLevel = avgs["endgameharmonypercent"];
    harmonyLevel["harmomystr"] = "<b>Harmony Level %</b>";
    avgs["traprowstr"] = "<b>Trap Note %</b>";
    writeTableRow("endgameStageTable", avgs["endgamestagepercent"], ["endgamestagestr", 0, 1, 2]);
   */
     /* document.getElementById("endgameStageTable").style.backgroundColor = "f0f0f0";
    writeTableRow("endgameHarmonyTable", avgs["endgameharmonypercent"], ["endgameharmonystr", 0, 1, 2]);
    document.getElementById("endgameHarmonyTable").style.backgroundColor = "f0f0f0";
    avgs["trapPercentage"] = avgs["trapPercentage"];
    writeTableRow("endgameTrapTable", avgs, ["traprowstr", "trapPercentage"]);
    document.getElementById("endgameTrapTable").style.backgroundColor = "f0f0f0";
*/
      /*
    // Total Table
    writeTableRow("totalTable", avgs, ["totalstr", "avgtotalnotes", "maxtotalnotes"]); 
    */
  }

  function checkGet() {
    let sp = new URLSearchParams(window.location.search);
    if (sp.has('teamNum')) {
      return sp.get('teamNum')
    }
    return null;
  }

  function loadTeamPics(teamPics) {
    /* Takes list of Team Pic paths and loads them
     */
    var first = true;
    for (let uri of teamPics) {
      var tags = "";
      if (first) {
        tags += "<div class='carousel-item active'>";
      } else {
        tags += "<div class='carousel-item'>";
      }
      first = false;
      tags += "  <img src='./" + uri + "' class='d-block w-100'>";
      tags += "</div>";
      $("#robotPics").append(tags);
    }
  }

  function setTeamTitle(team) {
    $("#teamTitle").html("Team " + team);
  }

    //filters out the match type as specified in the db status page
  function getFilteredData(team, successFunction) {
//      console.log(">> starting getSiteFilteredData for team " + team);
      var temp_this = this;
      $.post("dbAPI.php", { "getStatus": true }, function (data) {
          dbdata = JSON.parse(data);
          var localSiteFilter = {};
          localSiteFilter["useP"] = dbdata["useP"];
          localSiteFilter["useQm"] = dbdata["useQm"];
          localSiteFilter["useQf"] = dbdata["useQf"];
          localSiteFilter["useSf"] = dbdata["useSf"];
          localSiteFilter["useF"] = dbdata["useF"];
          //temp_this.siteFilter = { ...localSiteFilter };
//          console.log(">>> useP = " + localSiteFilter["useP"]);
//          console.log(">>> useQm = " + localSiteFilter["useQm"]);
          //temp_this.applySiteFilter();
          $.get("readAPI.php", {
            getTeamData: team
          }).done(function(data) {
            matchData = JSON.parse(data);

            var new_data = [];
            for (var i = 0; i < matchData.length; i++) {
              var mn = matchData[i]["matchnumber"];
              var mt = "-";
              var match_str = mn.toLowerCase();
              if (match_str.search("p") != -1) {
                mt = "p";
              }
              else if (match_str.search("qm") != -1) {
                mt = "qm";
              }    
              else if (match_str.search("qf") != -1) {
                mt = "qf";
              }
              else if (match_str.search("sf") != -1) {
                mt = "sf";
              }
              else if (match_str.search("f") != -1) {
                mt = "f";
              } 

              if (mt == "p" && localSiteFilter["useP"]) { new_data.push(matchData[i]); }
              else if (mt == "qm" && localSiteFilter["useQm"]) { new_data.push(matchData[i]); }
              else if (mt == "qf" && localSiteFilter["useQf"]) { new_data.push(matchData[i]); }
              else if (mt == "sf" && localSiteFilter["useSf"]) { new_data.push(matchData[i]); }
              else if (mt == "f" && localSiteFilter["useF"]) { new_data.push(matchData[i]); }
            }
            matchData = [...new_data];

            successFunction(matchData);
        });
     });
  }
    
  function sortAllMatchesTable() {
    var table = document.getElementById("sortableAllMatches");
    var rows = Array.prototype.slice.call(table.querySelectorAll("tbody> tr"));
    rows.sort(function(rowA,rowB) {
      var cellA = rowA.cells[0].textContent.trim();
      var cellB = rowB.cells[0].textContent.trim();
      return(sortRows(cellA,cellB));
    });
    // Update the table body with the sorted rows.
    rows.forEach(function(row) {
      table.querySelector("tbody").appendChild(row);
    });
  }

  // Returns 0 if rowA is before rowB; else returns 1. Assumes the row has a "matchnum" key
  // that is <prefix><number>, where prefix is "p", "qm" or "sf".
  function sortRows(cellA,cellB) {

    // Pull apart prefix and number from matchnum (ie, "p", "qm", "sf")
    var Aprefix = "";
    var Anum = "";
    var Bprefix = "";
    var Bnum = "";
    if(cellA.charAt(0) == "p") {
     Anum = cellA.substr(1,cellA.length);
     Aprefix = "p";
    } 
    else if(cellA.charAt(0) == "q") {   // "qm"
     Anum = cellA.substr(2,cellA.length);
     Aprefix = "qm";
    } 
    else if(cellA.charAt(0) == "s") {   // "sf"
     Anum = cellA.substr(2,cellA.length);
     Aprefix = "sf";
    } 
    if(cellB.charAt(0) == "p") {
     Bnum = cellB.substr(1,cellB.length);
     Bprefix = "p";
    } 
    else if(cellB.charAt(0) == "q") {   // "qm"
     Bnum = cellB.substr(2,cellB.length);
     Bprefix = "qm";
    } 
    else if(cellA.charAt(0) == "s") {   // "sf"
     Bnum = cellB.substr(2,cellB.length);
     Bprefix = "sf";
    } 
    if(Aprefix == Bprefix)
      return(Anum - Bnum);
    if(Aprefix == "p")
      return 0;
    if(Bprefix == "p")
      return 1;
    if(Aprefix == "qm")
      return 0;
    return 1;
  };

  function dataToMatchTable(dataObj) {
    $("#allMatchesTable").html("");  // clear table
    for (let i = 0; i < dataObj.length; i++) {
      var rowString = "<tr><td align=\"center\">" + dataObj[i]["matchnumber"] + "</td>" +
          "<td align=\"center\">" + dataObj[i]["autonLeave"] + "</td>" +
          "<td align=\"center\">" + dataObj[i]["autonStartPos"] + "</td>" +
          "<td align=\"center\">" + dataObj[i]["autonAlgaeNet"] + "</td>" +
          "<td align=\"center\">" + dataObj[i]["autonAlgaeProcessor"] + "</td>" +
          "<td align=\"center\">" + dataObj[i]["autonspeakermisses"] + "</td>" +
          
          "<td align=\"center\">" + dataObj[i]["autonCoralL1"] + "</td>" +
          "<td align=\"center\">" + dataObj[i]["autonCoralL2"] + "</td>" +
          "<td align=\"center\">" + dataObj[i]["autonCoralL3"] + "</td>" +
          "<td align=\"center\">" + dataObj[i]["autonCoralL4"] + "</td>" +
          
          "<td align=\"center\">" + dataObj[i]["teleopCoralL1"] + "</td>" +
          "<td align=\"center\">" + dataObj[i]["teleopCoralL2"] + "</td>" +
          "<td align=\"center\">" + dataObj[i]["teleopCoralL3"] + "</td>" +
          "<td align=\"center\">" + dataObj[i]["teleopCoralL4"] + "</td>" +

          "<td align=\"center\">" + dataObj[i]["teleopAlgaeNet"] + "</td>" +
          "<td align=\"center\">" + dataObj[i]["teleopAlgaeProcessor"] + "</td>" +
          "<td align=\"center\">" + dataObj[i]["defenseLevel"] + "</td>" +
          
          "<td align=\"center\">" + dataObj[i]["teleopspeakernotes"] + "</td>" +
          "<td align=\"center\">" + dataObj[i]["teleopspeakermisses"] + "</td>" +
          
          "<td align=\"center\">" + dataObj[i]["endgamestage"] + "</td>" +
          "<td align=\"center\">" + dataObj[i]["endgameharmony"] + "</td>" +
          "<td align=\"center\">" + dataObj[i]["endgametrap"] + "</td>" +
          "<td align=\"center\">" + dataObj[i]["endgamespotlit"] + "</td>" +
          "<td align=\"center\">" + dataObj[i]["died"] + "</td>" +
          "<td align=\"center\">" + dataObj[i]["scoutname"] + "</td>" +
          "</td>";
      $("#allMatchesTable").append(rowString);
    }
    setTimeout(function() {
      sorttable.makeSortable(document.getElementById("sortableAllMatches"));
      frozenTable = $('#freezeTableDiv').freezeTable({
        'backgroundColor': "white",
        'columnKeep': true,
        'frozenColVerticalOffset': 0
      });
    }, 1);
    sortAllMatchesTable();
  }

  function processMatchData(team, data) {
    var mdp = new matchDataProcessor(data);
    mdp.sortMatches(data);
    mdp.getSiteFilteredAverages(function(averageData) {
      processedData = averageData[team];
      dataToAvgTables(processedData);
    });
    getFilteredData(team, function(fData) {
      filteredData = fData;
      dataToCommentTable(filteredData);
      dataToMatchTable(filteredData);
      dataToAutonCoralGraph(filteredData);    
      dataToAutonGraph(filteredData);
      dataToTeleopCoralGraph(filteredData);    
      dataToTeleopGraph(filteredData);
      dataToEndgameGraph(filteredData);
    });
  }
    
    
    
    
    
    //NEW AUTON CORAL GRAPH STARTS HERE
    
    
    
    
    
    function dataToAutonCoralGraph(matchdata) {

    // Declare variables
    var match_list = []; // List of matches to use as x lables

    var datasets = []; // Each entry is a dict with a label and data attribute

    var autonCoralL1Tips = []; // holds custom tooltips for auton coral L1

    var autonCoralL2Tips = []; // holds custom tooltips for auton coral L2
      
    var autonCoralL3Tips = []; // holds custom tooltips for auton coral L3

    var autonCoralL4Tips = []; // holds custom tooltips for auton coral 4      
  

    datasets.push({
      label: "L1",
      data: [],
      borderColor: 'Red'
    });
    datasets.push({
      label: "L2",
      data: [],
      borderColor: 'Green'
    });
    datasets.push({
      label: "L3",
      data: [],
      borderColor: 'Orange'
    });
    datasets.push({
      label: "L4",
      data: [],
      borderColor: 'Blue'    
        
    });
    // Go thru each matchdata QR code string and build up a table of the data, so we can
    // later sort it so the matches are listed in the right order. 
    var mydata = [];
    for (let i = 0; i < matchdata.length; i++) {
      var matchnum = matchdata[i]["matchnumber"];
      var autonCoralOne = matchdata[i]["autonCoralL1"];
      var autonCoralTwo = matchdata[i]["autonCoralL2"];
      var autonCoralThree = matchdata[i]["autonCoralL3"];
      var autonCoralFour = matchdata[i]["autonCoralL4"];
      mydata.push({
        matchnum: matchnum,
        one: autonCoralOne,
        two: autonCoralTwo,
        three: autonCoralThree,
        four: autonCoralFour 
      });
    }
    mydata.sort(function(rowA,rowB) {
      var cellA = rowA["matchnum"];
      var cellB = rowB["matchnum"];
      return(sortRows(cellA,cellB));
    });
    // Build data sets; go thru each mydata row and populate the graph datasets.
    for (let i = 0; i < mydata.length; i++) {
      var matchnum = mydata[i]["matchnum"];
      match_list.push(matchnum);
        
      // Get auton coral level one
      var autonCoralOne = mydata[i]["one"];
      datasets[0]["data"].push(autonCoralOne);
      var tooltipStr = "L1="+autonCoralOne;      
      autonCoralL1Tips.push({xlabel: matchnum, tip: tooltipStr}); 
        
      // Get auton coral level two
      var autonCoralTwo = mydata[i]["two"];
      datasets[1]["data"].push(autonCoralTwo);
      var tooltipStr = "L2="+autonCoralTwo;
      autonCoralL2Tips.push({xlabel: matchnum, tip: tooltipStr}); 
        
      // Get auton coral level three
      var autonCoralThree = mydata[i]["three"];
      datasets[2]["data"].push(autonCoralThree);
      var tooltipStr = "L3="+autonCoralThree;    
      autonCoralL3Tips.push({xlabel: matchnum, tip: tooltipStr});
        
     // Get auton coral level four
      var autonCoralFour = mydata[i]["four"];
      datasets[3]["data"].push(autonCoralFour);
      var tooltipStr = "L4="+autonCoralFour;          
      autonCoralL4Tips.push({xlabel: matchnum, tip: tooltipStr});
    }

    // Define the graph as a line chart:
    if (chartDefined) {
      myChart.destroy();
    }
    chartDefined = true;

    const ctx = document.getElementById('myChart').getContext('2d');
    myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: match_list,
        datasets: datasets
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        },
        plugins: {
          tooltip: {
            callbacks: {  // Special tooltip handling
              label: function(tooltipItem,ddata) {
                 var toolIndex = tooltipItem.datasetIndex;
                 var matchnum = tooltipItem.label;
                 var tipStr = datasets[toolIndex].label;

                 if(toolIndex == 0) {   // Auton Amp Notes
                   for (let i = 0; i < autonCoralL1Tips.length; i++) {
                     if(autonCoralL1Tips[i].xlabel == matchnum) {
                       tipStr = autonCoralL1Tips[i].tip;
                       break;
                     }
                   }
                 }
                 else if(toolIndex == 1) {   // Auton coral
                   for (let i = 0; i < autonCoralL2Tips.length; i++) {
                     if(autonCoralL2Tips[i].xlabel == matchnum) {
                       tipStr = autonCoralL2Tips[i].tip;
                       break;   
                     }
                   }
                 }
                 else if(toolIndex == 2) {   // Auton coral
                   for (let i = 0; i < autonCoralL3Tips.length; i++) {
                     if(autonCoralL3Tips[i].xlabel == matchnum) {
                       tipStr = autonCoralL3Tips[i].tip;
                       break;
                     }
                   }
                 }
                 else if(toolIndex == 3) {   // Auton coral
                   for (let i = 0; i < autonCoralL4Tips.length; i++) {
                     if(autonCoralL4Tips[i].xlabel == matchnum) {
                       tipStr = autonCoralL4Tips[i].tip;
                       break;
                     }
                   }
                 }
                 return tipStr;
              }
            }
          }
        }
      }
    });
  }
    
    
    
    
    //NEW AUTON CORAL GRAPH ENDS HERE
    
    
    
    
    
    
  function dataToAutonGraph(matchdata) {

    // Declare variables
    var match_list = []; // List of matches to use as x lables

    var datasets = []; // Each entry is a dict with a label and data attribute

    var startingSpotTips = []; // holds custom tooltips for starting position

    var autonAlgaeNetTips = []; // holds custom tooltips for auton algae net
      
    var autonAlgaeProcTips = []; // holds custom tooltips for auton algae processor

    var autonLeaveTips = []; // holds custom tooltips for auton leave starting zone data      
  

    datasets.push({
      label: "Starting Spot",
      data: [],
      borderColor: 'Red'
    });
    datasets.push({
      label: "Net",
      data: [],
      borderColor: 'Green'
    });
    datasets.push({
      label: "Processor",
      data: [],
      borderColor: 'Orange'
    });
    datasets.push({
      label: "Leave Starting Zone",
      data: [],
      borderColor: 'Blue'    
        
    });
    // Go thru each matchdata QR code string and build up a table of the data, so we can
    // later sort it so the matches are listed in the right order. 
    var mydata = [];
    for (let i = 0; i < matchdata.length; i++) {
      var matchnum = matchdata[i]["matchnumber"];
      var startingPosition = matchdata[i]["autonStartPos"];
      var autonAlgaeNet = matchdata[i]["autonAlgaeNet"];
      var autonAlgaeProcessor = matchdata[i]["autonAlgaeProcessor"];
      var autonLeave = matchdata[i]["autonLeave"];
      mydata.push({
        matchnum: matchnum,
        startposition: startingPosition,
        algae: autonAlgaeNet,
        leave: autonLeave,
        processor: autonAlgaeProcessor 
      });
    }
    mydata.sort(function(rowA,rowB) {
      var cellA = rowA["matchnum"];
      var cellB = rowB["matchnum"];
      return(sortRows(cellA,cellB));
    });
    // Build data sets; go thru each mydata row and populate the graph datasets.
    for (let i = 0; i < mydata.length; i++) {
      var matchnum = mydata[i]["matchnum"];
      match_list.push(matchnum);
      // Get starting position data
      var startingPosition = mydata[i]["startposition"];
      datasets[0]["data"].push(startingPosition);
      var slevel = "Right";
      if(startingPosition == 1)
        slevel = "Middle";
      if(startingPosition == 2)
        slevel = "Left";    
      var tipStr = "Starting Spot="+slevel;
      startingSpotTips.push({xlabel: matchnum, tip: tipStr}); 
        
      // Get auton algae net data
      var autonAlgaeNet = mydata[i]["algae"];
      datasets[1]["data"].push(autonAlgaeNet);
      var tooltipStr = "Net="+autonAlgaeNet;
      autonAlgaeNetTips.push({xlabel: matchnum, tip: tooltipStr}); 
        
      // Get auton algae processor data
      var autonAlgaeProcessor = mydata[i]["processor"];
      datasets[2]["data"].push(autonAlgaeProcessor);
      var tooltipStr = "Processor="+autonAlgaeProcessor;    
      autonAlgaeProcTips.push({xlabel: matchnum, tip: tooltipStr});
        
     // Get auton leave starting zone data
      var autonLeaveStartingZone = mydata[i]["leave"];
      datasets[3]["data"].push(autonLeaveStartingZone);
      var clevel = "No";
      if(autonLeaveStartingZone == 1)
        clevel = "Yes";
      var tipStr = "Leave Starting Zone="+clevel;
      autonLeaveTips.push({xlabel: matchnum, tip: tipStr});
    }

    // Define the graph as a line chart:
    if (chart2Defined) {
      myChart2.destroy();
    }
    chart2Defined = true;

    const ctx = document.getElementById('myChart2').getContext('2d');
    myChart2 = new Chart(ctx, {
      type: 'line',
      data: {
        labels: match_list,
        datasets: datasets
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        },
        plugins: {
          tooltip: {
            callbacks: {  // Special tooltip handling
              label: function(tooltipItem,ddata) {
                 var toolIndex = tooltipItem.datasetIndex;
                 var matchnum = tooltipItem.label;
                 var tipStr = datasets[toolIndex].label;

                 if(toolIndex == 0) {   // starting position
                   for (let i = 0; i < startingSpotTips.length; i++) {
                     if(startingSpotTips[i].xlabel == matchnum) {
                       tipStr = startingSpotTips[i].tip;
                       break;
                     }
                   }
                 }
                 else if(toolIndex == 1) {   // Auton algae net
                   for (let i = 0; i < autonAlgaeNetTips.length; i++) {
                     if(autonAlgaeNetTips[i].xlabel == matchnum) {
                       tipStr = autonAlgaeNetTips[i].tip;
                       break;   
                     }
                   }
                 }
                 else if(toolIndex == 2) {   // Auton algae net
                   for (let i = 0; i < autonAlgaeProcTips.length; i++) {
                     if(autonAlgaeProcTips[i].xlabel == matchnum) {
                       tipStr = autonAlgaeProcTips[i].tip;
                       break;
                     }
                   }
                 }
                 else if(toolIndex == 3) {   // Auton algae net
                   for (let i = 0; i < autonLeaveTips.length; i++) {
                     if(autonLeaveTips[i].xlabel == matchnum) {
                       tipStr = autonLeaveTips[i].tip;
                       break;
                     }
                   }
                 }
                 return tipStr;
              }
            }
          }
        }
      }
    });
  }
    
    
    
    
    //NEW TELEOP CORAL GRAPH STARTS HERE
    
    
    
    
    
    function dataToTeleopCoralGraph(matchdata) {

    // Declare variables
    var match_list = []; // List of matches to use as x lables

    var datasets = []; // Each entry is a dict with a label and data attribute

    var teleopCoralL1Tips = []; // holds custom tooltips for teleop coral L1

    var teleopCoralL2Tips = []; // holds custom tooltips for teleop coral L2
      
    var teleopCoralL3Tips = []; // holds custom tooltips for teleop coral L3

    var teleopCoralL4Tips = []; // holds custom tooltips for teleop coral 4      
  

    datasets.push({
      label: "L1",
      data: [],
      borderColor: 'Red'
    });
    datasets.push({
      label: "L2",
      data: [],
      borderColor: 'Green'
    });
    datasets.push({
      label: "L3",
      data: [],
      borderColor: 'Orange'
    });
    datasets.push({
      label: "L4",
      data: [],
      borderColor: 'Blue'    
        
    });
    // Go thru each matchdata QR code string and build up a table of the data, so we can
    // later sort it so the matches are listed in the right order. 
    var mydata = [];
    for (let i = 0; i < matchdata.length; i++) {
      var matchnum = matchdata[i]["matchnumber"];
      var teleopCoralOne = matchdata[i]["teleopCoralL1"];
      var teleopCoralTwo = matchdata[i]["teleopCoralL2"];
      var teleopCoralThree = matchdata[i]["teleopCoralL3"];
      var teleopCoralFour = matchdata[i]["teleopCoralL4"];
      mydata.push({
        matchnum: matchnum,
        levelone: teleopCoralOne,
        leveltwo: teleopCoralTwo,
        levelthree: teleopCoralThree,
        levelfour: teleopCoralFour 
      });
    }
    mydata.sort(function(rowA,rowB) {
      var cellA = rowA["matchnum"];
      var cellB = rowB["matchnum"];
      return(sortRows(cellA,cellB));
    });
    // Build data sets; go thru each mydata row and populate the graph datasets.
    for (let i = 0; i < mydata.length; i++) {
      var matchnum = mydata[i]["matchnum"];
      match_list.push(matchnum);
        
      // Get teleop coral level one
      var teleopCoralOne = mydata[i]["levelone"];
      datasets[0]["data"].push(teleopCoralOne);
      var tooltipStr = "L1="+teleopCoralOne;      
      teleopCoralL1Tips.push({xlabel: matchnum, tip: tooltipStr}); 
        
      // Get teleop coral level two
      var teleopCoralTwo = mydata[i]["leveltwo"];
      datasets[1]["data"].push(teleopCoralTwo);
      var tooltipStr = "L2="+teleopCoralTwo;
      teleopCoralL2Tips.push({xlabel: matchnum, tip: tooltipStr}); 
        
      // Get teleop coral level three
      var teleopCoralThree = mydata[i]["levelthree"];
      datasets[2]["data"].push(teleopCoralThree);
      var tooltipStr = "L3="+teleopCoralThree;    
      teleopCoralL3Tips.push({xlabel: matchnum, tip: tooltipStr});
        
     // Get teleop coral level four
      var teleopCoralFour = mydata[i]["levelfour"];
      datasets[3]["data"].push(teleopCoralFour);
      var tooltipStr = "L4="+teleopCoralFour;          
      teleopCoralL4Tips.push({xlabel: matchnum, tip: tooltipStr});
    }

    // Define the graph as a line chart:
    if (chart3Defined) {
      myChart3.destroy();
    }
    chart3Defined = true;

    const ctx = document.getElementById('myChart3').getContext('2d');
    myChart3 = new Chart(ctx, {
      type: 'line',
      data: {
        labels: match_list,
        datasets: datasets
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        },
        plugins: {
          tooltip: {
            callbacks: {  // Special tooltip handling
              label: function(tooltipItem,ddata) {
                 var toolIndex = tooltipItem.datasetIndex;
                 var matchnum = tooltipItem.label;
                 var tipStr = datasets[toolIndex].label;

                 if(toolIndex == 0) {   // teleop coral level one
                   for (let i = 0; i < teleopCoralL1Tips.length; i++) {
                     if(teleopCoralL1Tips[i].xlabel == matchnum) {
                       tipStr = teleopCoralL1Tips[i].tip;
                       break;
                     }
                   }
                 }
                 else if(toolIndex == 1) {   // teleop coral level two
                   for (let i = 0; i < teleopCoralL2Tips.length; i++) {
                     if(teleopCoralL2Tips[i].xlabel == matchnum) {
                       tipStr = teleopCoralL2Tips[i].tip;
                       break;   
                     }
                   }
                 }
                 else if(toolIndex == 2) {   // teleop coral level three
                   for (let i = 0; i < teleopCoralL3Tips.length; i++) {
                     if(teleopCoralL3Tips[i].xlabel == matchnum) {
                       tipStr = teleopCoralL3Tips[i].tip;
                       break;
                     }
                   }
                 }
                 else if(toolIndex == 3) {   // teleop coral level four
                   for (let i = 0; i < teleopCoralL4Tips.length; i++) {
                     if(teleopCoralL4Tips[i].xlabel == matchnum) {
                       tipStr = teleopCoralL4Tips[i].tip;
                       break;
                     }
                   }
                 }
                 return tipStr;
              }
            }
          }
        }
      }
    });
  }
    
    
    
    
    //NEW TELEOP CORAL GRAPH ENDS HERE
    
    
    
    

    
  function dataToTeleopGraph(matchdata) {
    // Declare variables
    var match_list = []; // List of matches to use as x lables
      
    var datasets = []; // Each entry is a dict with a label and data attribute
      
    var defenseLevelTips = []; // holds custom tooltips for teleop amp notes
      
    var teleopAlgaeProcessorTips = []; // holds custom tooltips for teleop speaker notes
      
    var teleopAlgaeNetTips =[];//holds custom tooltips for if amplification used

    datasets.push({
      label: "Processor",
      data: [],
      borderColor: 'MediumOrchid'
    });
    datasets.push({
      label: "Defense",
      data: [],
      borderColor: 'MediumSeaGreen'
    });
    datasets.push({
      label: "Net",
      data: [],
      borderColor: 'Blue'
    });
    
    // Go thru each matchdata QR code string and build up a table of the data, so we can 
    // later sort it so the matches are listed in the right order.
    var mydata = [];
    for (let i = 0; i < matchdata.length; i++) {
      var matchnum = matchdata[i]["matchnumber"];
      var teleopAlgaeProcessor = matchdata[i]["teleopAlgaeProcessor"];
      var defenseLevel = matchdata[i]["defenseLevel"];
      var teleopAlgaeNet = matchdata[i]["teleopAlgaeNet"];
      mydata.push({
        matchnum: matchnum,
        teleopprocessor: teleopAlgaeProcessor,
        teleopdefense: defenseLevel,
        teleopnet: teleopAlgaeNet
      });
    } 
    mydata.sort(function(rowA,rowB) {
      var cellA = rowA["matchnum"];
      var cellB = rowB["matchnum"];
      return(sortRows(cellA,cellB));
    });

    // Build data sets; go thru each mydata row and populate the graph datasets.
    for (let i = 0; i < mydata.length; i++) {
      var matchnum = mydata[i]["matchnum"];
      match_list.push(matchnum);

      // Get teleop algae processor
      var teleopAlgaeProcessor = mydata[i]["teleopprocessor"];
      datasets[0]["data"].push(teleopAlgaeProcessor);
      var tooltipStr1 = "Processor="+teleopAlgaeProcessor;
      teleopAlgaeProcessorTips.push({xlabel: matchnum, tip: tooltipStr1}); 

      // Get teleop defense level
      var defenseLevel = mydata[i]["teleopdefense"];
      datasets[1]["data"].push(defenseLevel);
      var dlevel = "N/A";
      if(defenseLevel == 1)
        dlevel = "Low";
      if(defenseLevel == 2)
        dlevel = "Medium";  
      if(defenseLevel == 3)
        dlevel = "High";      
      var tipStr2 = "Defense="+dlevel; 
      defenseLevelTips.push({xlabel: matchnum, tip: tipStr2}); 
        
      //Get teleop algae net
      var teleopAlgaeNet = mydata[i]["teleopnet"];
      datasets[2]["data"].push(teleopAlgaeNet);
      var tooltipStr3 = "Net ="+teleopAlgaeNet;
      teleopAlgaeNetTips.push({xlabel: matchnum, tip: tooltipStr3});         
    }

    // Define the graph as a line chart:
    if (chart4Defined) {
      myChart4.destroy();
    }
    chart4Defined = true;
    const ctx = document.getElementById('myChart4').getContext('2d');
    myChart4 = new Chart(ctx, {
      type: 'line',
      data: {
        labels: match_list,
        datasets: datasets
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        },
        plugins: {
          tooltip: {
            callbacks: {  // Special tooltip handling
              label: function(tooltipItem,ddata) {
                 var toolIndex = tooltipItem.datasetIndex;
                 var matchnum = tooltipItem.label;
                 var tipStr = datasets[toolIndex].label;

                 if(toolIndex == 0) {   // Teleop algae processor
                   for (let i = 0; i < teleopAlgaeProcessorTips.length; i++) {
                     if(teleopAlgaeProcessorTips[i].xlabel == matchnum) {
                       tipStr = teleopAlgaeProcessorTips[i].tip;
                       break;
                     }
                   }
                 }
                 else if(toolIndex == 1) {   // Teleop defense level
                   for (let i = 0; i < defenseLevelTips.length; i++) {
                     if(defenseLevelTips[i].xlabel == matchnum) {
                       tipStr = defenseLevelTips[i].tip;
                       break;
                     }
                   }
                 }
                 else if(toolIndex == 2) {   // Teleop Algae Net
                   for (let i = 0; i < teleopAlgaeNetTips.length; i++) {
                     if(teleopAlgaeNetTips[i].xlabel == matchnum) {
                       tipStr = teleopAlgaeNetTips[i].tip;
                       break;
                     }
                   }
                 }  
                 return tipStr;
              }
            }
          }
        }
      }
    });
  }
    
  function dataToEndgameGraph(matchdata) {
    var match_list = [];
    var datasets = [];
    var endgameStageTips = [];
    var endgameHarmonyTips = [];
     
    datasets.push({
       label: "Stage Level",
       data: [],
       borderColor: 'SteelBlue'
    });
    datasets.push({
       label: "Harmony Level",
       data: [],
       borderColor: 'RebeccaPurple'
    });
     
    // Go thru each matchdata QR code string and build up a table of the data, so we can
    // later sort it so the matches are listed in the right order. 
    var mydata = [];
    for (let i = 0; i < matchdata.length; i++) {
      var matchnum = matchdata[i]["matchnumber"];
      var stage = matchdata[i]["endgamestage"];
      var harmony = matchdata[i]["endgameharmony"];
      mydata.push({
        matchnum: matchnum,
        stage: stage,
        harmony: harmony
      });
    }
    mydata.sort(function(rowA,rowB) {
      var cellA = rowA["matchnum"];
      var cellB = rowB["matchnum"];
      return(sortRows(cellA,cellB));
    });

    // Build data sets; go thru each mydata row and populate the graph datasets.
    for (let i = 0; i < mydata.length; i++) {
      var matchnum = mydata[i]["matchnum"];
      match_list.push(matchnum);
         
      // Get endgame stage level
      var endgameStage = mydata[i]["stage"];
      datasets[0]["data"].push(endgameStage);
      var clevel = "None";
      if(endgameStage == 1)
        clevel = "Parked";
      if(endgameStage == 2)
        clevel = "Onstage";
         
      var tipStr = "Stage="+clevel;
      endgameStageTips.push({xlabel: matchnum, tip: tipStr}); 
         
      // Get endgame harmony level
      var endgameHarmony = mydata[i]["harmony"];
      datasets[1]["data"].push(endgameHarmony);
      var clevel = "0";
      if(endgameHarmony == 1)
        clevel = "1";
      if(endgameHarmony == 2)
        clevel = "2";
         
      var tipStr = "Harmony="+clevel;
      endgameHarmonyTips.push({xlabel: matchnum, tip: tipStr});
    }
         
    if (chart5Defined) {
      myChart5.destroy();
    }
    chart5Defined = true;
    const ctx = document.getElementById('myChart5').getContext('2d');
    myChart5 = new Chart(ctx, {
      type: 'line',
      data: {
        labels: match_list,
        datasets: datasets
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        },
        plugins: {
          tooltip: {
            callbacks: {  // Special tooltip handling
              label: function(tooltipItem,ddata) {
                var toolIndex = tooltipItem.datasetIndex;
                var matchnum = tooltipItem.label;
                var tipStr = datasets[toolIndex].label;

                if(toolIndex == 0) {   // Stage Level
                  for (let i = 0; i < endgameStageTips.length; i++) {
                    if(endgameStageTips[i].xlabel == matchnum) {
                      tipStr = endgameStageTips[i].tip;
                      break;
                    }
                  }
                }
                else if(toolIndex == 1) {   // Teleop Middle Row
                  for (let i = 0; i < endgameHarmonyTips.length; i++) {
                    if(endgameHarmonyTips[i].xlabel == matchnum) {
                      tipStr = endgameHarmonyTips[i].tip;
                      break;
                    }
                  }
                }
                return tipStr;
              }
            }
          }
        }
      }
    });    
  }
	
/*HOLD->
 function dataToDriveRankGraph(driveRankData) {
    // Declare variables
    var match_list = []; // List of matches to use as x lables
    var datasets = []; // Each entry is a dict with a label and data attribute

    datasets.push({
      label: "Drive Ability",
      data: [],
      borderColor: 'Teal'
    });
    datasets.push({
      label: "Quickness",
      data: [],
      borderColor: 'Salmon'
    });
    datasets.push({
      label: "Field Awareness",
      data: [],
      borderColor: 'Gold'
    });
    datasets.push({
      label: "Game Pieces Dropped",
      data: [],
      borderColor: 'FireBrick'
    });
    

    // Build data sets; go thru each matchdata QR code string and populate the graph datasets.
    for (let i = 0; i < driveRankData.length; i++) {
      var matchnum = driveRankData[i]["matchnumber"];
      match_list.push(matchnum);
      datasets[0]["data"].push(driveRankData[i]["driverability"]);
      datasets[1]["data"].push(driveRankData[i]["quickness"]);	
      datasets[2]["data"].push(driveRankData[i]["fieldawareness"]);	
      datasets[3]["data"].push(driveRankData[i]["gamepiecedrop"]);
    }

    // Define the graph as a line chart:
    if (chart4Defined) {
      myChart4.destroy();
    }
    chart4Defined = true;

    const ctx = document.getElementById('myChart4').getContext('2d');
    myChart4 = new Chart(ctx, {
      type: 'line',
      data: {
        labels: match_list,
        datasets: datasets
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
       
          }
        }
    });
  }
<-HOLD*/

  function processCommentData(data) {
    dataToCommentTable(data);
  }

  function processPitData(pitData, matchData) {
    if (!pitData || !pitData.length) {
      pitData["sparepartsstring"] = pitData["spareparts"] ? "yes" : "no";
      pitData["computervisionstring"] = pitData["computervision"] ? "yes" : "no";
      pitData["swervedrivestring"] = pitData["swerve"] ? "yes" : "no"; 
      pitData["drivemotors"];
      pitData["preparedness"];
      pitData["projlanguage"];

      // First row has pit data, so write out that data.
      writeTableRow("pitRow1", pitData, ["numbatteries", "pitorg", "sparepartsstring", "computervisionstring"]);
      writeTableRow("pitRow2",pitData,["drivemotors","preparedness","swervedrivestring","proglanguage"]);
    }
    
  }
	
   function processDriveRankData(driveRankData) {
//HOLD     dataToDriveRankGraph(driveRankData);
  }

  // This is the main function that runs when we want to load a new team 
  function loadTeam(team) {
    // Clear existing data
    $("#robotPics").html("");
    $("#teamTitle").html("");
    $("#pitRow1").html("");
    $("#pitRow2").html("")
    $("#comments").html("");
    $("#allMatchesTable").html("");
    $("#autoStartTable").html("");
    $("#autoTable").html("");
    $("#autoTotalTable").html("");
    $("#autonChargeTable").html("");
    $("#teleopTable").html("");
    $("#teleopTotalTable").html("");
    $("#endgameStageTable").html("");
    $("#endgameHarmonyTable").html("");
    $("#endgameTrapTable").html("");
    $("#totalTable").html("");

    // Write new data
    setTeamTitle(team);

    // Add new images
    $.get("readAPI.php", {
      getTeamImages: team
    }).done(function(data) {
      var listOfImages = JSON.parse(data);
      loadTeamPics(listOfImages);
    });

    // Add Match Scouting Data
    $.get("readAPI.php", {
      getTeamData: team
    }).done(function(data) {
      matchData = JSON.parse(data);
      processMatchData(team, matchData);

      // Do the Pit Scouting Data here because it also needs the matchData.
      $.get("readAPI.php", {
        getTeamPitData: team
      }).done(function(data) {
        pitData = JSON.parse(data);
        processPitData(pitData, matchData);
      });
    });
	  
    // Add Drive Rank Scouting Data
    $.get("readAPI.php", {
      getTeamDriveRankData: team
    }).done(function(data) {
      driveRankData = JSON.parse(data);
      processDriveRankData(driveRankData);
    });
  }

  $(document).ready(function() {
    var initTeamNumber = checkGet()
    if (initTeamNumber) {
      loadTeam(initTeamNumber);
    }

    $("#loadTeam").click(function() {
      loadTeam($("#writeTeamNumber").val());
    });
    
    $("#sortableAllMatches").click(function() {
       if(frozenTable) {
         frozenTable.update();
       }
    });
  });
</script>
<script type="text/javascript" src="./scripts/matchDataProcessor.js"></script>
