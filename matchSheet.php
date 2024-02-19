<title>Match Sheet</title>
<?php include("header.php") ?>
<div class="container row-offcanvas row-offcanvas-left">
  <div class="well column  col-lg-12  col-sm-12 col-xs-12" id="content">
    <div class="row g-3 justify-content-md-center">
      <div class="row g-3 justify-content-md-center">
        <div class="col-md-6">
          <div id="ourMatches">
          </div>
        </div>
      </div>
      <div class="row g-3 justify-content-md-center">
        <div class="g-4 col-md-6">
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
        </div>
      </div>

      <div class="row justify-content-md-center">
        <div class="col-md-6">
          <h4 id="matchTitle">Match:</h4>
          <h5 id="matchTime">Time:</h5>
          <table class="table table-bordered">
            <thead>
                <style type="text/css" media="screen">
                table tr {
                    border: 1px solid black;
                }
                table td, table th {
                    border-right: 1px solid black;
                }
                </style>
              <tr>
                <th class="text-center"></th>
                <th class="text-center">Red</th>
                <th class="text-center">Blue</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="table-secondary">Avg Total Amps</td>
                <td class="table-danger" id="redTotalAmps"></td>
                <td class="table-primary" id="blueTotalAmps"></td>
              </tr>
              <tr>
                <td class="table-secondary">Avg Total Speakers</td>
                <td class="table-danger" id="redTotalSpeakers"></td>
                <td class="table-primary" id="blueTotalSpeakers"></td>
              </tr>
              <tr>
                <td class="table-secondary">Avg Total Notes</td>
                <td class="table-danger" id="redTotalNotes"></td>
                <td class="table-primary" id="blueTotalNotes"></td>
              </tr>
              <tr>
                <td class="table-secondary">Avg Endgame Points</td>
                <td class="table-danger" id="redAvgEndgamePoints"></td>
                <td class="table-primary" id="blueAvgEndgamePoints"></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="row pt-3 pb-3 mb-3 gx-3">
        <div class="col-lg-4 col-sm-4 col-xs-4 gx-3">
          <div class="card text-white bg-danger mb-3">
            <div class="card-head">
              <div class="accordion accordion-flush bg-danger" id="R0Flush">
                <div class="accordion-item bg-danger">
                  <h2 class="accordion-header bg-danger" id="flush-headingOne">
                    <div class="row">
                      <div class="col-6">
                        <h5 id="R0TeamNumber" class="card-title text-center">Team #</h5>
                      </div>
                      <div class="col-6">
                        <button class="btn accordion-button collapsed bg-danger btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#flush-R0Collapse" aria-expanded="false" aria-controls="flush-R0Collapse">

                        </button>
                      </div>
                    </div>
                  </h2>
                  <div id="flush-R0Collapse" class="accordion-collapse collapse show">
                    <div id="R0PicsCarousel" class="carousel slide" data-interval="false">
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
                </div>
              </div>
            </div>

            <div class="overflow-auto">
              <table class="table table-bordered table-danger">
                <thead>
                  <tr>
                    <th colspan="2" class="text-center fs-6">Auton</th>
                    <th colspan="2" class="text-center fw-bold fs-6">Teleop</th>
                    <th colspan="9" class="text-center fw-bold fs-6">Endgame</th>
                  </tr>
                  <tr>
                    <th scope="col">Amps</th>
                    <th scope="col">Spkr</th>

                    <th scope="col">Amps</th>
                    <th scope="col">Spkr</th>
                      
                    <th scope="col">N</th>
                    <th scope="col">P</th>
                    <th scope="col">O</th>
                    <th scope="col">0</th>
                    <th scope="col">1</th>
                    <th scope="col">2</th>
                    <th scope="col">Trap</th>
                    <th scope="col">Spotlit</th>
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
              <div class="accordion accordion-flush bg-danger" id="R1Flush">
                <div class="accordion-item bg-danger">
                  <h2 class="accordion-header bg-danger" id="flush-headingOne">
                    <div class="row">
                      <div class="col-6">
                        <h5 id="R1TeamNumber" class="card-title text-center">Team #</h5>
                      </div>
                      <div class="col-6">
                        <button class="btn accordion-button collapsed bg-danger btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#flush-R1Collapse" aria-expanded="false" aria-controls="flush-R1Collapse">

                        </button>
                      </div>
                    </div>
                  </h2>
                  <div id="flush-R1Collapse" class="accordion-collapse collapse show">
                    <div id="R1PicsCarousel" class="carousel slide" data-interval="false">
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
                </div>
              </div>
            </div>

            <div class="overflow-auto">
              <table class="table table-bordered table-danger">
                <thead>
                  <tr>
                    <th colspan="2" class="text-center fs-6">Auton</th>
                    <th colspan="2" class="text-center fw-bold fs-6">Teleop</th>
                    <th colspan="9" class="text-center fw-bold fs-6">Endgame</th>
                  </tr>
                  <tr>
                   <th scope="col">Amps</th>
                    <th scope="col">Spkr</th>
                    <th scope="col">Amps</th>
                    <th scope="col">Spkr</th>
                    <th scope="col">N</th>
                    <th scope="col">P</th>
                    <th scope="col">O</th>
                    <th scope="col">0</th>
                    <th scope="col">1</th>
                    <th scope="col">2</th>
                    <th scope="col">Trap</th>
                    <th scope="col">Spotlit</th>
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
              <div class="accordion accordion-flush bg-danger" id="R2Flush">
                <div class="accordion-item bg-danger">
                  <h2 class="accordion-header bg-danger" id="flush-headingOne">
                    <div class="row">
                      <div class="col-6">
                        <h5 id="R2TeamNumber" class="card-title text-center">Team #</h5>
                      </div>
                      <div class="col-6">
                        <button class="btn accordion-button collapsed bg-danger btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#flush-R2Collapse" aria-expanded="false" aria-controls="flush-R2Collapse">

                        </button>
                      </div>
                    </div>
                  </h2>
                  <div id="flush-R2Collapse" class="accordion-collapse collapse show">
                    <div id="R2PicsCarousel" class="carousel slide" data-interval="false">
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
                </div>
              </div>
            </div>

            <div class="overflow-auto">
              <table class="table table-bordered table-danger">
                <thead>
                  <tr>
                    <th colspan="2" class="text-center fs-6">Auton</th>
                    <th colspan="2" class="text-center fw-bold fs-6">Teleop</th>
                    <th colspan="9" class="text-center fw-bold fs-6">Endgame</th>
                  </tr>
                  <tr>
                    <th scope="col">Amps</th>
                    <th scope="col">Spkr</th>
                    <th scope="col">Amps</th>
                    <th scope="col">Spkr</th>
                    <th scope="col">N</th>
                    <th scope="col">P</th>
                    <th scope="col">O</th>
                    <th scope="col">0</th>
                    <th scope="col">1</th>
                    <th scope="col">2</th>
                    <th scope="col">Trap</th>
                    <th scope="col">Spotlit</th>
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
              <div class="accordion accordion-flush bg-primary" id="B0Flush">
                <div class="accordion-item bg-primary">
                  <h2 class="accordion-header bg-primary" id="flush-headingOne">
                    <div class="row">
                      <div class="col-6">
                        <h5 id="B0TeamNumber" class="card-title text-center">Team #</h5>
                      </div>
                      <div class="col-6">
                        <button class="btn accordion-button collapsed bg-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#flush-B0Collapse" aria-expanded="false" aria-controls="flush-B0Collapse">

                        </button>
                      </div>
                    </div>
                  </h2>
                  <div id="flush-B0Collapse" class="accordion-collapse collapse show">
                    <div id="B0PicsCarousel" class="carousel slide" data-interval="false">
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
                </div>
              </div>
            </div>

            <div class="overflow-auto">
              <table class="table table-bordered table-primary">
                <thead>
                  <tr>
                    <th colspan="2" class="text-center fs-6">Auton</th>
                    <th colspan="2" class="text-center fw-bold fs-6">Teleop</th>
                    <th colspan="9" class="text-center fw-bold fs-6">Endgame</th>
                  </tr>
                  <tr>
                   <th scope="col">Amps</th>
                    <th scope="col">Spkr</th>
                    <th scope="col">Amps</th>
                    <th scope="col">Spkr</th>
                    <th scope="col">N</th>
                    <th scope="col">P</th>
                    <th scope="col">O</th>
                    <th scope="col">0</th>
                    <th scope="col">1</th>
                    <th scope="col">2</th>
                    <th scope="col">Trap</th>
                    <th scope="col">Spotlit</th>
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
              <div class="accordion accordion-flush bg-primary" id="B1Flush">
                <div class="accordion-item bg-primary">
                  <h2 class="accordion-header bg-primary" id="flush-headingOne">
                    <div class="row">
                      <div class="col-6">
                        <h5 id="B1TeamNumber" class="card-title text-center">Team #</h5>
                      </div>
                      <div class="col-6">
                        <button class="btn accordion-button collapsed bg-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#flush-B1Collapse" aria-expanded="false" aria-controls="flush-B1Collapse">

                        </button>
                      </div>
                    </div>
                  </h2>
                  <div id="flush-B1Collapse" class="accordion-collapse collapse show">
                    <div id="B1PicsCarousel" class="carousel slide" data-interval="false">
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
                </div>
              </div>
            </div>

            <div class="overflow-auto">
              <table class="table table-bordered table-primary">
                <thead>
                  <tr>
                    <th colspan="2" class="text-center fs-6">Auton</th>
                    <th colspan="2" class="text-center fw-bold fs-6">Teleop</th>
                    <th colspan="9" class="text-center fw-bold fs-6">Endgame</th>
                  </tr>
                  <tr>
                   <th scope="col">Amps</th>
                    <th scope="col">Spkr</th>
                    <th scope="col">Amps</th>
                    <th scope="col">Spkr</th>
                    <th scope="col">N</th>
                    <th scope="col">P</th>
                    <th scope="col">O</th>
                    <th scope="col">0</th>
                    <th scope="col">1</th>
                    <th scope="col">2</th>
                    <th scope="col">Trap</th>
                    <th scope="col">Spotlit</th>
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
              <div class="accordion accordion-flush bg-primary" id="B2Flush">
                <div class="accordion-item bg-primary">
                  <h2 class="accordion-header bg-primary" id="flush-headingOne">
                    <div class="row">
                      <div class="col-6">
                        <h5 id="B2TeamNumber" class="card-title text-center">Team #</h5>
                      </div>
                      <div class="col-6">
                        <button class="btn accordion-button collapsed bg-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#flush-B2Collapse" aria-expanded="false" aria-controls="flush-B2Collapse">

                        </button>
                      </div>
                    </div>
                  </h2>
                  <div id="flush-B2Collapse" class="accordion-collapse collapse show">
                    <div id="B2PicsCarousel" class="carousel slide" data-interval="false">
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
                </div>
              </div>
            </div>

            <div class="overflow-auto">
              <table class="table table-bordered table-primary">
                <thead>
                  <tr>
                    <th colspan="2" class="text-center fs-6">Auton</th>
                    <th colspan="2" class="text-center fw-bold fs-6">Teleop</th>
                    <th colspan="9" class="text-center fw-bold fs-6">Endgame</th>
                  </tr>
                  <tr>
                   <th scope="col">Amps</th>
                    <th scope="col">Spkr</th>
                    <th scope="col">Amps</th>
                    <th scope="col">Spkr</th>
                    <th scope="col">N</th>
                    <th scope="col">P</th>
                    <th scope="col">O</th>
                    <th scope="col">0</th>
                    <th scope="col">1</th>
                    <th scope="col">2</th>
                    <th scope="col">Trap</th>
                    <th scope="col">Spotlit</th>
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
    var rawMatchData = null;
    var picDB = {};
    var ourTeam = "frc2135";
    var ourMatches = {};

    function checkGet() {
      let sp = new URLSearchParams(window.location.search);
      if (sp.has('matchNum') && sp.has('compLevel')) {
        return [sp.get('matchNum'), sp.get('compLevel')];
      }
      return null;
    }
 
    function loadMatchData(successFunction) {
      if (!localMatchData) {
        $.get("readAPI.php", {
          getAllData: 1
        }).done(function(data) {
          data = JSON.parse(data);
          var mdp = new matchDataProcessor(data);
          mdp.getSiteFilteredAverages(function(averageData) {
            localMatchData = averageData;
            successFunction();
          });
        });
      } else {
        successFunction();
      }
    }

    function createOurMatchTable() {
      var arrOurMatches = [];
      for (let key in ourMatches) {
        arrOurMatches.push(ourMatches[key]);
      }
      arrOurMatches.sort(function(a, b) {
        a["match_number"] - b["match_number"]
      });
      $("#ourMatches").html("");
      var row = 'Our Matches: ';
      for (let i in arrOurMatches) {
        if (i != 0) {
          row += ", ";
        }
        row += '<a class="text-black" href="./matchSheet.php?matchNum=' + arrOurMatches[i]["match_number"] + '&compLevel=' + arrOurMatches[i]["comp_level"] + '">' + arrOurMatches[i]["comp_level"] + arrOurMatches[i]["match_number"] + '</a>';
      }
      $("#ourMatches").html(row);
    }

    function loadMatchList(successFunction) {
      if (!localMatchList) {
        $.get("tbaAPI.php", {
          getMatchList: 1
        }).done(function(data) {

          if(data == null)
            alert("Can't load matchlist from TBA; check if TBA Key was set in dbStatus");

          rawMatchData = JSON.parse(data)["response"];
          localMatchList = {};
          for (let mi in rawMatchData) {
            var newMatch = {};
            var match = rawMatchData[mi];
            newMatch["comp_level"] = match["comp_level"];
            newMatch["match_number"] = match["comp_level"] == "qm" ? match["match_number"] : match["set_number"];
            newMatch["red_teams"] = match["alliances"]["red"]["team_keys"];
            newMatch["blue_teams"] = match["alliances"]["blue"]["team_keys"];
            newMatch["time"] = null;
            if (newMatch["time"] == null && match["actual_time"] != null) {
              newMatch["time"] = match["actual_time"];
            }
            if (newMatch["time"] == null && match["predicted_time"] != null) {
              newMatch["time"] = match["predicted_time"];
            }
            // if (newMatch["time"] == null && match["time"] != null){ newMatch["time"] = match["time"]; }
            localMatchList[makeKey(newMatch["match_number"], newMatch["comp_level"])] = newMatch;
            //
            if (newMatch["red_teams"].includes(ourTeam) || newMatch["blue_teams"].includes(ourTeam)) {
              ourMatches[newMatch["match_number"]] = newMatch;
            }
          }
          createOurMatchTable();
          successFunction();
        });
      } else {
        successFunction();
      }
    }

    function makeKey(matchNumber, compLevel) {
      return compLevel.toUpperCase() + "_" + String(matchNumber).toUpperCase();
    }

    function loadMatch(matchNum, compLevel) {
      // Clear Data
      $("#R0DataTable").html("");
      $("#R1DataTable").html("");
      $("#R2DataTable").html("");
      $("#B0DataTable").html("");
      $("#B1DataTable").html("");
      $("#B2DataTable").html("");
      $("#redTotalAmps").html("");
      $("#redTotalSpeakers").html("");
      $("#redTotalNotes").html("");
      $("#redAvgEndgamePoints").html("");
      $("#blueTotalAmps").html("");
      $("#blueTotalSpeakerse").html("");
      $("blueTotalNotes").html("");
      $("#blueAvgEndgamePoints").html("");
      $("#R0RobotPics").html("");
      $("#R1RobotPics").html("");
      $("#R2RobotPics").html("");
      $("#B0RobotPics").html("");
      $("#B1RobotPics").html("");
      $("#B2RobotPics").html("");
      picDB = {};
      // Write Match Number
      $("#matchTitle").html("Match " + compLevel + " " + matchNum);
      // Pull Data
      localMatchNum = matchNum;
      localCompLevel = compLevel;
      loadMatchData(function() {
        loadMatchList(processMatchList)
      });
    }

    function updateTime(time) {
      var date = new Date(time * 1000);
      var hours = date.getHours();
      var suff = "AM";
      if (hours > 12) {
        hours = hours - 12;
        suff = "PM"
      }
      var minutes = "0" + date.getMinutes();
      $("#matchTime").html("Time: " + hours + ":" + minutes.substr(-2) + " " + suff);
    }

    function processMatchList() {
      // Get Match Vector
      matchVector = localMatchList[makeKey(localMatchNum, localCompLevel)];
      if (!matchVector) {
        alert(makeKey(localMatchNum, localCompLevel) + " does not exist!");
        return;
      }

      // Update Team Boxes
      for (let i in matchVector["red_teams"]) {
        displayTeam("R", i, strTeamToIntTeam(matchVector["red_teams"][i]));
      }
      for (let i in matchVector["blue_teams"]) {
        displayTeam("B", i, strTeamToIntTeam(matchVector["blue_teams"][i]));
      }

      // Update Summary Box
      updateSummary(matchVector["red_teams"], matchVector["blue_teams"]);

      // Request Team Pics
      sendPicRequest(matchVector["red_teams"], matchVector["blue_teams"]);

      // Update Time
      updateTime(matchVector["time"]);
    }

    function updateSummary(redList, blueList) {
      var avgTotalAmps = {
        "red": 0,
        "blue": 0
      };
      var avgTotalSpeakers = {
         "red": 0,
         "blue": 0
      }
      var avgTotalNotes = {
        "red": 0,
        "blue": 0
      };
      var avgEndgamePoints = {
        "red": 0,
        "blue": 0
      };

      for (let i in redList) {
        teamNum = strTeamToIntTeam(redList[i]);
        var rd = localMatchData[teamNum];
        if (rd != null) {
          avgTotalAmps["red"] += rd["avgautonamps"] + rd["avgteleopampnotes"];
          avgTotalSpeakers["red"] += rd["avgautonspeaker"] + rd["avgteleopspeakernotes"];
          avgTotalNotes["red"] += rd["avgtotalnotes"];
          avgEndgamePoints["red"] += rd["avgendgamepoints"];
        }
      }
      for (let i in blueList) {
        teamNum = strTeamToIntTeam(blueList[i]);
        var rd = localMatchData[teamNum];
        if (rd != null) {
          avgTotalAmps["blue"] += rd["avgautonamps"] + rd["avgteleopampnotes"];
          avgTotalSpeakers["blue"] += rd["avgautonspeaker"] + rd["avgteleopspeakernotes"];
          avgTotalNotes["blue"] += rd["avgtotalnotes"];
          avgEndgamePoints["blue"] += rd["avgendgamepoints"];
        }
      }
                
      $("#redTotalAmps").html(roundInt(avgTotalAmps["red"]));
      $("#redTotalSpeakers").html(roundInt(avgTotalSpeakers["red"]));
      $("#redTotalNotes").html(roundInt(avgTotalNotes["red"]));
      $("#redAvgEndgamePoints").html(roundInt(avgEndgamePoints["red"]));

      $("#blueTotalAmps").html(roundInt(avgTotalAmps["blue"]));
      $("#blueTotalSpeakers").html(roundInt(avgTotalSpeakers["blue"]));
      $("#blueTotalNotes").html(roundInt(avgTotalNotes["blue"]));
      $("#blueAvgEndgamePoints").html(roundInt(avgEndgamePoints["blue"]));
        
      document.getElementById("redTotalAmps").setAttribute("align", "center");
      document.getElementById("redTotalSpeakers").setAttribute("align", "center");
      document.getElementById("redTotalNotes").setAttribute("align", "center");
      document.getElementById("redAvgEndgamePoints").setAttribute("align", "center");

      document.getElementById("blueTotalAmps").setAttribute("align", "center");
      document.getElementById("blueTotalSpeakers").setAttribute("align", "center");
      document.getElementById("blueTotalNotes").setAttribute("align", "center");
      document.getElementById("blueAvgEndgamePoints").setAttribute("align", "center");
    }

    function roundInt(val) {
      return Math.round((val + Number.EPSILON) * 100) / 100;
    }

    function displayTeam(color, index, teamNum) {
      $("#" + color + index + "TeamNumber").html("<a class='text-white' href='teamLookup.php?teamNum=" + teamNum + "'>" + teamNum + "</a>");
      var rd = localMatchData[teamNum];
      if (rd != null) {
        var row = "<tr>";
        row += "<td align=\"center\">" + rd["avgautonamps"] + "</td>";
        row += "<td align=\"center\">" + rd["avgautonspeaker"] + "</td>";
        row += "<td align=\"center\">" + rd["avgteleopampnotes"] + "</td>";
        row += "<td align=\"center\">" + rd["avgteleopspeakernotes"] + "</td>";
        row += "<td align=\"center\">" + rd["endgamestagepercent"][0] + "</td>";
        row += "<td align=\"center\">" + rd["endgamestagepercent"][1] + "</td>";
        row += "<td align=\"center\">" + rd["endgamestagepercent"][2] + "</td>";
        row += "<td align=\"center\">" + rd["endgameharmonypercent"][0] + "</td>";
        row += "<td align=\"center\">" + rd["endgameharmonypercent"][1] + "</td>";
        row += "<td align=\"center\">" + rd["endgameharmonypercent"][2] + "</td>";
        row += "<td align=\"center\">" + rd["trapPercentage"] + "</td>";
        row += "<td align=\"center\">" + rd["spotlitPercentage"] + "</td>";
        row += "</tr>";
      }
      $("#" + color + index + "DataTable").append(row);
    }

    function sendPicRequest(redList, blueList) {
      var requestList = []
      for (let i in redList) {
        var tn = strTeamToIntTeam(redList[i]);
        picDB[tn] = "R" + i;
        requestList.push(tn);
      }
      for (let i in blueList) {
        var tn = strTeamToIntTeam(blueList[i]);
        picDB[tn] = "B" + i;
        requestList.push(tn);
      }

      $.get("readAPI.php", {
        getTeamsImages: JSON.stringify(requestList)
      }).done(function(data) {
        var teamImages = JSON.parse(data);
        for (var team of Object.keys(teamImages)) {
          loadTeamPics(picDB[team], teamImages[team]);
        }
      });
    }

    function loadTeamPics(prefix, teamPics) {
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
        $("#" + prefix + "RobotPics").append(tags);
      }
    }

    function strTeamToIntTeam(team) {
      return team.replace(/^(frc)/, '');
    }

    $(document).ready(function() {
      var initialGet = checkGet();
      if (initialGet) {
        loadMatch(initialGet[0], initialGet[1]);
      }

      $("#loadMatch").click(function() {
        loadMatch($("#writeMatchNumber").val(), $("#writeCompLevel").val());
      });

      loadMatchList(function() {});

    });
  </script>

  <script type="text/javascript" src="./scripts/matchDataProcessor.js"></script>
