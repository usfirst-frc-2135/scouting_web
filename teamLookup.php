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
            <h5 id="teamTitle" class="card-title">Team # </h5>
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
                    <th scope="col">Pit</th>
                    <th scope="col">Spare Parts</th>
                    <th scope="col">Vision</th>
                    <th scope="col">Swerve</th>
                    <th scope="col">Programming</th>
                    <th scope="col">Drive Motors</th>
                    <th scope="col">Preparedness</th>
                  </tr>
                </thead>

                <div class="card mb-3">
                  <div class="card-body">
                    <h5 class="card-title">Auton Graph</h5>
                    <canvas id="myChart" width="400" height="400"></canvas>

                  </div>
                </div>

                <!-- pit data-- use this somewhere -->

                <tbody id="pitData">
                </tbody>
              </table>
            </div>

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
          </div>
        </div>

        <!-- Commented out the All Matches Rapid React raw data lines FOR NOW
        <div class="card mb-3">
          <div class="card-body">
            <h5 class="card-title">All Matches</h5>
            <div class="overflow-auto">
              <table id="sortableAllMatches" class="table table-striped table-hover sortable">
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
                    <th scope="col">Scout</th>
                  </tr>
                </thead>
                <tbody id="allMatchesTable">
                </tbody>
              </table>
            </div>
          </div>
        </div>
        -->

      </div>
      <div class="col-lg-6 col-sm-6 col-xs-6 gx-3">
        <div class="card mb-3">
          <div class="card-body">
            <h5 class="card-title">Match Averages</h5>
              
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
                      <th scope="row">Total Points</th>
                    </tr>
                  </tbody>
                </table>
              
            <div class="card mb-3">
              <div class="card-body">
                <div class="overflow-auto">
                  <h5 class="text-center">Auton</h5>
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
      console.log("Adding comment: "+commentObj[i].comment);
      if (commentObj[i].comment === "-") {
        continue;
      }
      writeTableRow("comments", commentObj[i], ["comment", "scoutname"]);
    }
  }

  function dataToMatchTable(dataObj) {
    /* HOLD for (let i = 0; i < dataObj.length; i++) {
      writeTableRow("allMatchesTable", dataObj[i], ["matchnumber", "startpos", "tarmac",
        "autonhighpoints", "autonlowpoints", "teleophighpoints", "teleoplowpoints", "climbed", "died", "scoutname"
      ]);
    }
    sorttable.makeSortable(document.getElementById("sortableAllMatches")); */
  }

  function dataToAvgTables(avgs) {
    // Auton Scores
    /* HOLD avgs["autostartpercent"]["autostr"] = "<b>Start %</b>";
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
    writeTableRow("totalTable", avgs, ["totalstr", "avgtotalpoints", "maxtotalpoints"]); match */
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
    /* HOLD var mdp = new matchDataProcessor(data);
    mdp.sortMatches(data);
    mdp.getSiteFilteredAverages(function(averageData) {
      processedData = averageData[team];
      dataToAvgTables(processedData);
    });
    dataToCommentTable(data);
    dataToMatchTable(data); */
    dataToGraph(data);
    /* sorttable.makeSortable(document.getElementById("sortableAllMatches")); */
  }

  function dataToGraph(matchdata) {
    // Declare variables
    var match_list = []; // List of matches to use as x lables
    var datasets = []; // Each entry is a dict with a label and data attribute
    var autonTopRowTips = []; // custom tooltips for auton top row points
    var autonMidRowTips = []; // custom tooltips for auton middle row points
    var autonBotRowTips = []; // custom tooltips for auton bottom row points

    datasets.push({
      label: "Auton Top Row Items",
      data: [],
      borderColor: 'red'
    });
    datasets.push({
      label: "Auton Middle Row Items",
      data: [],
      borderColor: 'green'
    });
    datasets.push({
      label: "Auton Bottom Row Items",
      data: [],
      borderColor: 'blue'
    });
    datasets.push({
      label: "Auton Charge Level",
      data: [],
      borderColor: 'yellow'
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
      var tooltipStr = "Auton Top Row (cubes: "+autonTopRowCubes+"; cones: "+autonTopRowCones+") = "+autonTopSum;
      autonTopRowTips.push({xlabel: matchnum, tip: tooltipStr}); 

      // Get auton middle row data
      var autonMidRowCubes = matchdata[i]["autoncubesmiddle"];
      var autonMidRowCones = matchdata[i]["autonconesmiddle"];
      var autonMidSum = autonMidRowCones + autonMidRowCubes;
      datasets[1]["data"].push(autonMidSum);
      var tooltipStr = "Auton Middle Row (cubes: "+autonMidRowCubes+"; cones: "+autonMidRowCones+") = "+autonMidSum;
      autonMidRowTips.push({xlabel: matchnum, tip: tooltipStr}); 

      // Get auton bottom row data
      var autonBotRowCubes = matchdata[i]["autoncubesbottom"];
      var autonBotRowCones = matchdata[i]["autonconesbottom"];
      var autonBotSum = autonBotRowCones + autonBotRowCubes;
      datasets[2]["data"].push(autonBotSum);
      var tooltipStr = "Auton Bottom Row (cubes: "+autonBotRowCubes+"; cones: "+autonBotRowCones+") = "+autonBotSum;
      autonBotRowTips.push({xlabel: matchnum, tip: tooltipStr}); 

      // Get auton charge level
      datasets[3]["data"].push(matchdata[i]["autonchargelevel"]);
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
                 var tipStr = "Auton Charge Level = ";
                 var label = datasets[toolIndex].label;
      // doesn't work:           var ivalue = tooltipItem.value;
      //           console.log("--> in callback: ivalue = "+ivalue);
 // FOR NOW - hard coding generic tooltip to use data at index 2.
                 var dvalue = datasets[toolIndex].data[2];
                 var tipStr = label+" = "+dvalue;
       //          console.log("      --> tipStr = "+tipStr);
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
                   var clevel = "None";
                   if(dvalue == 1)
                     clevel = "Docked";
                   else if(dvalue == 2)
                     clevel = "Engaged";
                   tipStr = "Auton Charge Level = "+clevel;
                 }
                 return tipStr;
              }
            }
          }
        }
      }
    });
  }

  function processCommentData(data) {
    dataToCommentTable(data);
  }

  function processPitData(data) {
    if (!data || !data.length) {
      data["sparepartsstring"] = data["spareparts"] ? "yes" : "no";
      data["computervisionstring"] = data["computervision"] ? "yes" : "no";
      data["swervedrivestring"] = data["swerve"] ? "yes" : "no"; 
      writeTableRow("pitData", data, ["numbatteries", "pitorg", "sparepartsstring", "computervisionstring", "swervedrivestring", "proglanguage", "drivemotors", "preparedness"]);
    }
  }

  function loadTeam(team) {
    /* This is the main function that runs when we want to load a new team onto the page */

    // Clear existing data
    $("#robotPics").html("");
    $("#teamTitle").html("");
    $("#pitData").html("");
    $("#comments").html("");
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
    });

    // Add Pit Scouting Data
    $.get("readAPI.php", {
      getTeamPitData: team
    }).done(function(data) {
      pitData = JSON.parse(data);
      processPitData(pitData);
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
