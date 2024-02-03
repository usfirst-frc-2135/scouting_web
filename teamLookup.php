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

            <!-- Auton collapsible graph -->
            <div class="card mb-3">
              <div class="card-body"> 
                <div class="overflow-auto">
      		  <h5 class="text-center"> 
                    <a href="#collapseAutonGraph" data-bs-toggle="collapse" aria-expanded="false"> Auton Graph</a> </h5>
                  <div class="collapse" id="collapseAutonGraph">
                    <canvas id="myChart" width="400" height="400"></canvas>
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
                    <canvas id="myChart2" width="400" height="400"></canvas>
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
                    <canvas id="myChart3" width="400" height="400"></canvas>
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
                    </colgroup>
                    <thead>
                      <tr>
                        <th scope="col">Match #</th>
                        <th scope="col">Leave</th>
                        <th scope="col">Auton Speaker Notes</th>
                        <th scope="col">Auton Amp Notes</th>
                        <th scope="col">Teleop Amp Notes</th>
                        <th scope="col">Teleop Speaker Notes</th>
                        <th scope="col">Endgame Stage Level</th>
                        <th scope="col">Endgame Harmony Level</th>
                        <th scope="col">Endgame Spotlit </th>
                        <th scope="col">Endgame Trap </th>
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
                            <th scope="row" style="background-color:rgb(240,240,240);">Trap Notes %</th>
                            </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
       
            <!-- Drive Rank graph -->
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
			  
         </div>
        </div>
       </div>
      </div>
     </div>
    </div>

<?php include("footer.php") ?>

<script>
  var chartDefined = false;
  var myChart;
    
  var chart2Defined = false;
  var myChart2;
	
  var chart3Defined = false;
  var myChart3;
    
  var chart4Defined = false;
  var myChart4;

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

  function dataToMatchTable(dataObj) {
      console.log("starting data to match table, data length= "+dataObj.length);
     for (let i = 0; i < dataObj.length; i++) {
      writeTableRow("allMatchesTable", dataObj[i], ["matchnumber", "autonleave", "autonampnotes", "autonspeakernotes", 
        "teleopampnotes", "teleopspeakernotes", "endgamestage", "endgameharmony", "endgamespotlit",
        "endgametrap","died", "scoutname"]);
    }
    sorttable.makeSortable(document.getElementById("sortableAllMatches")); 
  }

  function dataToAvgTables(avgs) {
    //Auton Scores
    avgs["amprowstr"] = "<b>Amp Notes</b>";
    avgs["speakerrowstr"] = "<b>Speaker Notes</b>";
    avgs["totalstr"] = "<b>Total Notes</b>";
      
    writeTableRow("autoTable", avgs, ["amprowstr", "avgautonamps", "maxautonamps"]);
    writeTableRow("autoTable", avgs, ["speakerrowstr", "avgautonspeaker", "maxautonspeaker"]);
    writeTableRow("autoTotalTable", avgs, ["totalstr", "avgautonotes", "maxautonotes"]);
      
    // Teleop Scores
    avgs["amprowstr"] = "<b>Amp Notes</b>";
    avgs["speakerrowstr"] = "<b>Speaker Notes</b>";
    avgs["totalstr"] = "<b>Total Notes</b>";
    writeTableRow("teleopTotalTable", avgs, ["totalstr", "avgteleopnotes", "maxteleopnotes"]);
    writeTableRow("teleopTable", avgs, ["amprowstr", "avgteleopampnotes", "maxteleopampnotes"]);
    writeTableRow("teleopTable", avgs, ["speakerrowstr", "avgteleopspeakernotes", "maxteleopspeakernotes"]);

    // Endgame Climb Table
    avgs["endgamestagepercent"]["endgamestagestr"] = "<b>Stage Level %</b>";
    avgs["endgameharmonypercent"]["endgameharmonystr"] = "<b>Harmony Level %</b>";
    avgs["avgtrap"]["endgametrapstr"] = "<b>Trap Notes %</b>";
    var stageLevel = avgs["endgamestagepercent"];
    stageLevel["stagestr"] = "<b>Stage Level %</b>";
    var harmonyLevel = avgs["endgameharmonypercent"];
    harmonyLevel["harmomystr"] = "<b>Harmony Level %</b>";
    avgs["traprowstr"] = "<b>Trap Notes %</b>";
    writeTableRow("endgameStageTable", avgs["endgamestagepercent"], ["endgamestagestr", 0, 1, 2]);
    document.getElementById("endgameStageTable").style.backgroundColor = "f0f0f0";
    writeTableRow("endgameHarmonyTable", avgs["endgameharmonypercent"], ["endgameharmonystr", 0, 1, 2]);
    document.getElementById("endgameHarmonyTable").style.backgroundColor = "f0f0f0";
    avgs["avgtrap"] = avgs["avgtrap"] * 100
    writeTableRow("endgameTrapTable", avgs, ["traprowstr", "avgtrap"]);
    document.getElementById("endgameTrapTable").style.backgroundColor = "f0f0f0";

    // Total Table
    writeTableRow("totalTable", avgs, ["totalstr", "avgtotalnotes", "maxtotalnotes"]); 
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

  function processMatchData(team, data) {
      var mdp = new matchDataProcessor(data);
      mdp.sortMatches(data);
      mdp.getSiteFilteredAverages(function(averageData) {
      processedData = averageData[team];
      dataToAvgTables(processedData);
    });
      dataToCommentTable(data);
      console.log("in processMatchData, calling data to MatchTable, team= "+team);
    dataToMatchTable(data); 
    dataToAutonGraph(data);
    dataToTeleopGraph(data);
    dataToEndgameGraph(data);
    sorttable.makeSortable(document.getElementById("sortableAllMatches")); 
  }
	


  function dataToAutonGraph(matchdata) {
    // Declare variables
    var match_list = []; // List of matches to use as x lables
    var datasets = []; // Each entry is a dict with a label and data attribute
    var autonAmpTips = []; // holds custom tooltips for auton amp notes
    var autonSpeakerTips = []; // holds custom tooltips for auton speaker notes
    var autonLeaveTips = []; // holds custom tooltips for auton leave starting zone data

    datasets.push({
      label: "Amp Notes",
      data: [],
      borderColor: 'Red'
    });
    datasets.push({
      label: "Speaker Notes",
      data: [],
      borderColor: 'Green'
    });
    datasets.push({
      label: "Leave Starting Zone",
      data: [],
      borderColor: 'Blue'
    });
    

    // Build data sets; go thru each matchdata QR code string and populate the graph datasets.
    for (let i = 0; i < matchdata.length; i++) {
      var matchnum = matchdata[i]["matchnumber"];
      match_list.push(matchnum);
        console.log("in matchnum");

      // Get auton amp notes data
      var autonAmpNotes = matchdata[i]["autonampnotes"];
      datasets[0]["data"].push(autonAmpNotes);
      var tooltipStr = "Amp Notes="+autonAmpNotes;
      autonAmpTips.push({xlabel: matchnum, tip: tooltipStr}); 
        console.log("autonampnotes");

      // Get auton speaker notes data
      var autonSpeakerNotes = matchdata[i]["autonspeakernotes"];
      datasets[1]["data"].push(autonSpeakerNotes);
      var tooltipStr = "Speaker Notes="+autonSpeakerNotes;
      autonSpeakerTips.push({xlabel: matchnum, tip: tooltipStr}); 
        console.log("autonspeakernotes");

     
     // Get auton leave starting zone data
      var autonLeaveStartingZone = matchdata[i]["autonleave"];
      datasets[2]["data"].push(autonLeaveStartingZone);
      var clevel = "No";
      if(autonLeaveStartingZone == 1)
        clevel = "Yes";
      var tipStr = "Leave Starting Zone="+clevel;
      autonLeaveTips.push({xlabel: matchnum, tip: tipStr});
        //console.log("leavestartingzone");
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
                   for (let i = 0; i < autonAmpTips.length; i++) {
                       //console.log("in auton amp tips line");
                     if(autonAmpTips[i].xlabel == matchnum) {
                       tipStr = autonAmpTips[i].tip;
                       break;
                     }
                   }
                 }
                 else if(toolIndex == 1) {   // Auton Speaker Notes
                   for (let i = 0; i < autonSpeakerTips.length; i++) {
                     if(autonSpeakerTips[i].xlabel == matchnum) {
                       tipStr = autonSpeakerTips[i].tip;
                       break;
                     }
                   }
                 }
                 else if(toolIndex == 2) {   // Auton Leave Starting Zone
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
    
  function dataToTeleopGraph(matchdata) {
    // Declare variables
    var match_list = []; // List of matches to use as x lables
    var datasets = []; // Each entry is a dict with a label and data attribute
    var teleopAmpTips = []; // holds custom tooltips for teleop top row points
    var teleopSpeakerTips = []; // holds custom tooltips for teleop middle row points

    datasets.push({
      label: "Amp Notes",
      data: [],
      borderColor: 'MediumOrchid'
    });
    datasets.push({
      label: "Speaker Notes",
      data: [],
      borderColor: 'MediumSeaGreen'
    });
      
    // Build data sets; go thru each matchdata QR code string and populate the graph datasets.
    for (let i = 0; i < matchdata.length; i++) {
      var matchnum = matchdata[i]["matchnumber"];
      match_list.push(matchnum);

      // Get teleop amp notes data
      var teleopAmpNotes = matchdata[i]["teleopampnotes"];
      datasets[0]["data"].push(teleopAmpNotes);
      var tooltipStr = "Amp Notes="+teleopAmpNotes;
      teleopAmpTips.push({xlabel: matchnum, tip: tooltipStr}); 

      // Get teleop speaker notes data
      var teleopSpeakerNotes = matchdata[i]["teleopspeakernotes"];
      datasets[1]["data"].push(teleopSpeakerNotes);
      var tooltipStr = "Speaker Notes="+teleopSpeakerNotes;
      teleopSpeakerTips.push({xlabel: matchnum, tip: tooltipStr});  
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

                 if(toolIndex == 0) {   // Teleop Top Row
                   for (let i = 0; i < teleopAmpTips.length; i++) {
                     if(teleopAmpTips[i].xlabel == matchnum) {
                       tipStr = teleopAmpTips[i].tip;
                       break;
                     }
                   }
                 }
                 else if(toolIndex == 1) {   // Teleop Middle Row
                   for (let i = 0; i < teleopSpeakerTips.length; i++) {
                     if(teleopSpeakerTips[i].xlabel == matchnum) {
                       tipStr = teleopSpeakerTips[i].tip;
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
     
     for (let i = 0; i < matchdata.length; i++) {
         var matchnum = matchdata[i]["matchnumber"];
         match_list.push(matchnum);
         
         // Get endgame stage level
         var endgameStage = matchdata[i]["endgamestage"];
         datasets[0]["data"].push(endgameStage);
         var clevel = "None";
         if(endgameStage == 1)
            clevel = "Parked";
         if(endgameStage == 2)
            clevel = "Onstage";
         
         var tipStr = "Stage="+clevel;
         endgameStageTips.push({xlabel: matchnum, tip: tipStr}); 
         
         // Get endgame harmony level
         var endgameHarmony = matchdata[i]["endgameharmony"];
         datasets[1]["data"].push(endgameHarmony);
         var clevel = "0";
         if(endgameHarmony == 1)
            clevel = "1";
         if(endgameHarmony == 2)
            clevel = "2";
         
         var tipStr = "Harmony="+clevel;
         endgameHarmonyTips.push({xlabel: matchnum, tip: tipStr});
         
     }
         
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
     dataToDriveRankGraph(driveRankData);
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
        //console.log("matchdata from teamAPI= "+matchData);
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
  });
</script>
<script type="text/javascript" src="./scripts/matchDataProcessor.js"></script>
