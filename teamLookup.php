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
                    <th scope="col">Batt</th>
                    <th scope="col">Pit</th>
                    <th scope="col">Spare Parts</th>
                    <th scope="col">Vision</th>
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
                    <th scope="col">Drive Motors</th>
                    <th scope="col">Prep</th>
                    <th scope="col">Swerve</th>
                    <th scope="col">Lang</th>
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
                  <h5 class="text-center">Match Total Points </h5>
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
                        <th scope="row">Total Pts</th>
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
                            <th scope="col">N</th>
                            <th scope="col">D</th>
                            <th scope="col">E</th>
                          </tr>
                        </thead>
                        <tbody id="autonChargeTable">
                          <tr>
                            <th scope="row">Charge Level %</th>
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
                        <tbody id="autoTable">
                          <tr>
                            <th scope="row">Mobility %</th>
                          </tr>
                         <tr>
                            <th scope="row">Top Row</th>
                          </tr>
                          <tr>
                            <th scope="row">Middle Row</th>
                          </tr>
                          <tr>
                            <th scope="row">Bottom Row</th>
                          </tr>
                        </tbody>
                        <tfoot id="autoTotalTable">
                          <tr>
                            <th scope="col">Total Pts</th>
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
                            <th scope="row">Top Row</th>
                          </tr>
                          <tr>
                            <th scope="row">Middle Row</th>
                          </tr>
                          <tr>
                            <th scope="row">Bottom Row</th>
                          </tr>
                        </tbody>
                        <tfoot id="teleopTotalTable">
                          <tr>
                            <th scope="col">Total Pts</th>
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
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <td>&nbsp;</td>
                            <th scope="col">N</th>
                            <th scope="col">P</th>
                            <th scope="col">D</th>
                            <th scope="col">E</th>
                          </tr>
                        </thead>
                        <tbody id="endgameChargeTable">
                          <tr>
                            <th scope="row">Charge Level %</th>
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
                      <canvas id="myChart3" width="400" height="350"></canvas>
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
  </div>

<?php include("footer.php") ?>

<script>
  var chartDefined = false;
  var myChart;
    
  var chart2Defined = false;
  var myChart2;
	
  var chart3Defined = false;
  var myChart3;

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
    // Auton Scores
    avgs["autonchargestationpercent"]["autonchargestr"] = "<b>Charge Level %</b>";
    avgs["mobilitystr"] = "<b>Mobility %</b>";
    avgs["toprowstr"] = "<b>Top Row Items</b>";
    avgs["midrowstr"] = "<b>Middle Row Items</b>";
    avgs["botrowstr"] = "<b>Bottom Row Items</b>";
    avgs["totalstr"] = "<b>Total Pts</b>";
      
//    console.log[avgs, ["mobilitystr", "exitcommunity"]];
      
    writeTableRow("autonChargeTable", avgs["autonchargestationpercent"], ["autonchargestr", 0, 1, 2]);
    writeTableRow("autoTable", avgs, ["mobilitystr", "mobilitypercent"]);
    writeTableRow("autoTable", avgs, ["toprowstr", "avg_autontoprowitems", "max_autontoprowitems"]);
    writeTableRow("autoTable", avgs, ["midrowstr", "avg_autonmidrowitems", "max_autonmidrowitems"]);
    writeTableRow("autoTable", avgs, ["botrowstr", "avg_autonbotrowitems", "max_autonbotrowitems"]);
    writeTableRow("autoTotalTable", avgs, ["totalstr", "avgautopoints", "maxautopoints"]);
      
    // Teleop Scores
    avgs["toprowstr"] = "<b>Top Row Items</b>";
    avgs["midrowstr"] = "<b>Middle Row Items</b>";
    avgs["botrowstr"] = "<b>Bottom Row Items</b>";
    avgs["totalstr"] = "<b>Total Pts</b>";
    writeTableRow("teleopTable", avgs, ["toprowstr", "avg_teleoptoprowitems", "max_teleoptoprowitems"]);
    writeTableRow("teleopTable", avgs, ["midrowstr", "avg_teleopmidrowitems", "max_teleopmidrowitems"]);
    writeTableRow("teleopTable", avgs, ["botrowstr", "avg_teleopbotrowitems", "max_teleopbotrowitems"]);
    writeTableRow("teleopTotalTable", avgs, ["totalstr", "avgteleoppoints", "maxteleoppoints"]);

    // Endgame Climb Table
    avgs["endgamechargestationpercent"]["endgamechargestr"] = "<b>Charge Level %</b>";
    var chargestationlevel = avgs["endgamechargestationpercent"];
    chargestationlevel["chargestr"] = "<b>Charge Level %</b>";
    writeTableRow("endgameChargeTable", avgs["endgamechargestationpercent"], ["endgamechargestr", 0, 1, 2, 3]);

    // Total Table
    writeTableRow("totalTable", avgs, ["totalstr", "avgtotalpoints", "maxtotalpoints"]); 
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
    sorttable.makeSortable(document.getElementById("sortableAllMatches")); 
  }
	


  function dataToAutonGraph(matchdata) {
    // Declare variables
    var match_list = []; // List of matches to use as x lables
    var datasets = []; // Each entry is a dict with a label and data attribute
    var autonTopRowTips = []; // holds custom tooltips for auton top row points
    var autonMidRowTips = []; // holds custom tooltips for auton middle row points
    var autonBotRowTips = []; // holds custom tooltips for auton bottom row points
    var autonChargeTips = []; // holds custom tooltips for auton charge level points

    datasets.push({
      label: "Auton Amp Notes",
      data: [],
      borderColor: 'Red'
    });
    datasets.push({
      label: "Auton Speaker Notes",
      data: [],
      borderColor: 'Yellow'
    });
    datasets.push({
      label: "Auton Bottom Row Items",
      data: [],
      borderColor: 'Green'
    });
    datasets.push({
      label: "Auton Charge Level",
      data: [],
      borderColor: 'Blue'
    });
    

    // Build data sets; go thru each matchdata QR code string and populate the graph datasets.
    for (let i = 0; i < matchdata.length; i++) {
      var matchnum = matchdata[i]["matchnumber"];
      match_list.push(matchnum);

      // Get auton top row data
      var autonTopRowCubes = matchdata[i]["autoncubestop"];
      var autonTopRowCones = matchdata[i]["autonconestop"];
      var autonTopSum = autonTopRowCones + autonTopRowCubes;
      datasets[0]["data"].push(autonTopSum);
      var tooltipStr = "Top (cubes "+autonTopRowCubes+", cones "+autonTopRowCones+")="+autonTopSum;
      autonTopRowTips.push({xlabel: matchnum, tip: tooltipStr}); 

      // Get auton middle row data
      var autonMidRowCubes = matchdata[i]["autoncubesmiddle"];
      var autonMidRowCones = matchdata[i]["autonconesmiddle"];
      var autonMidSum = autonMidRowCones + autonMidRowCubes;
      datasets[1]["data"].push(autonMidSum);
      var tooltipStr = "Middle (cubes "+autonMidRowCubes+", cones "+autonMidRowCones+")="+autonMidSum;
      autonMidRowTips.push({xlabel: matchnum, tip: tooltipStr}); 

      // Get auton bottom row data
      var autonBotRowCubes = matchdata[i]["autoncubesbottom"];
      var autonBotRowCones = matchdata[i]["autonconesbottom"];
      var autonBotSum = autonBotRowCones + autonBotRowCubes;
      datasets[2]["data"].push(autonBotSum);
      var tooltipStr = "Bottom (cubes "+autonBotRowCubes+", cones "+autonBotRowCones+")="+autonBotSum;
      autonBotRowTips.push({xlabel: matchnum, tip: tooltipStr}); 

      // Get auton charge level
      var autonChargeLevel = matchdata[i]["autonchargelevel"];
      datasets[3]["data"].push(autonChargeLevel);
      var clevel = "None";
      if(autonChargeLevel == 1)
        clevel = "Docked";
      else if(autonChargeLevel == 2)
        clevel = "Engaged";
      var tipStr = "Charge Level="+clevel;
      autonChargeTips.push({xlabel: matchnum, tip: tipStr}); 
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

                 if(toolIndex == 0) {   // Auton Top Row
                   for (let i = 0; i < autonTopRowTips.length; i++) {
                     if(autonTopRowTips[i].xlabel == matchnum) {
                       tipStr = autonTopRowTips[i].tip;
                       break;
                     }
                   }
                 }
                 else if(toolIndex == 1) {   // Auton Middle Row
                   for (let i = 0; i < autonMidRowTips.length; i++) {
                     if(autonMidRowTips[i].xlabel == matchnum) {
                       tipStr = autonMidRowTips[i].tip;
                       break;
                     }
                   }
                 }
                 else if(toolIndex == 2) {   // Auton Bottom Row
                   for (let i = 0; i < autonBotRowTips.length; i++) {
                     if(autonBotRowTips[i].xlabel == matchnum) {
                       tipStr = autonBotRowTips[i].tip;
                       break;
                     }
                   }
                 }
                 else if(toolIndex == 3) {   // Auton Charge Level
                   for (let i = 0; i < autonChargeTips.length; i++) {
                     if(autonChargeTips[i].xlabel == matchnum) {
                       tipStr = autonChargeTips[i].tip;
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
    var teleopTopRowTips = []; // holds custom tooltips for teleop top row points
    var teleopMidRowTips = []; // holds custom tooltips for teleop middle row points
    var teleopBotRowTips = []; // holds custom tooltips for teleop bottom row points
    var endgameChargeTips = []; // holds custom tooltips for endgame charge level points

    datasets.push({
      label: "Teleop Top Row Items",
      data: [],
      borderColor: 'MediumOrchid'
    });
    datasets.push({
      label: "Teleop Middle Row Items",
      data: [],
      borderColor: 'MediumSeaGreen'
    });
    datasets.push({
      label: "Teleop Bottom Row Items",
      data: [],
      borderColor: 'MediumTurquoise'
    });
    datasets.push({
      label: "Endgame Charge Level",
      data: [],
      borderColor: 'PaleVioletRed'
    });
    

    // Build data sets; go thru each matchdata QR code string and populate the graph datasets.
    for (let i = 0; i < matchdata.length; i++) {
      var matchnum = matchdata[i]["matchnumber"];
      match_list.push(matchnum);

      // Get teleop top row data
      var teleopTopRowCubes = matchdata[i]["teleopcubestop"];
      var teleopTopRowCones = matchdata[i]["teleopconestop"];
      var teleopTopSum = teleopTopRowCones + teleopTopRowCubes;
      datasets[0]["data"].push(teleopTopSum);
      var tooltipStr = "Top (cubes "+teleopTopRowCubes+", cones "+teleopTopRowCones+")="+teleopTopSum;
      teleopTopRowTips.push({xlabel: matchnum, tip: tooltipStr}); 

      // Get teleop middle row data
      var teleopMidRowCubes = matchdata[i]["teleopcubesmiddle"];
      var teleopMidRowCones = matchdata[i]["teleopconesmiddle"];
      var teleopMidSum = teleopMidRowCones + teleopMidRowCubes;
      datasets[1]["data"].push(teleopMidSum);
      var tooltipStr = "Middle (cubes "+teleopMidRowCubes+", cones "+teleopMidRowCones+")="+teleopMidSum;
      teleopMidRowTips.push({xlabel: matchnum, tip: tooltipStr}); 

      // Get teleop bottom row data
      var teleopBotRowCubes = matchdata[i]["teleopcubesbottom"];
      var teleopBotRowCones = matchdata[i]["teleopconesbottom"];
      var teleopBotSum = teleopBotRowCones + teleopBotRowCubes;
      datasets[2]["data"].push(teleopBotSum);
      var tooltipStr = "Bottom (cubes "+teleopBotRowCubes+", cones "+teleopBotRowCones+")="+teleopBotSum;
      teleopBotRowTips.push({xlabel: matchnum, tip: tooltipStr}); 

      // Get endgame charge level
      var endgameChargeLevel = matchdata[i]["endgamechargelevel"];
      datasets[3]["data"].push(endgameChargeLevel);
      var clevel = "None";
      if(endgameChargeLevel == 1)
        clevel = "Parked";
      if(endgameChargeLevel == 2)
        clevel = "Docked"
      else if(endgameChargeLevel == 3)
        clevel = "Engaged";
      var tipStr = "Charge Level="+clevel;
      endgameChargeTips.push({xlabel: matchnum, tip: tipStr}); 
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
                   for (let i = 0; i < teleopTopRowTips.length; i++) {
                     if(teleopTopRowTips[i].xlabel == matchnum) {
                       tipStr = teleopTopRowTips[i].tip;
                       break;
                     }
                   }
                 }
                 else if(toolIndex == 1) {   // Teleop Middle Row
                   for (let i = 0; i < teleopMidRowTips.length; i++) {
                     if(teleopMidRowTips[i].xlabel == matchnum) {
                       tipStr = teleopMidRowTips[i].tip;
                       break;
                     }
                   }
                 }
                 else if(toolIndex == 2) {   // Teleop Bottom Row
                   for (let i = 0; i < teleopBotRowTips.length; i++) {
                     if(teleopBotRowTips[i].xlabel == matchnum) {
                       tipStr = teleopBotRowTips[i].tip;
                       break;
                     }
                   }
                 }
                 else if(toolIndex == 3) {   // Endgame Charge Level
                   for (let i = 0; i < endgameChargeTips.length; i++) {
                     if(endgameChargeTips[i].xlabel == matchnum) {
                       tipStr = endgameChargeTips[i].tip;
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
    if (chart3Defined) {
      myChart3.destroy();
    }
    chart3Defined = true;

    const ctx = document.getElementById('myChart3').getContext('2d');
    myChart3 = new Chart(ctx, {
      type: 'line',
      data: {
        labels: match_list,
        datasets: datasetsx
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
    $("#endgameChargeTable").html("");
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
