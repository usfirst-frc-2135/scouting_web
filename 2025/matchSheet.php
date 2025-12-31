<?php
$title = 'Match Sheet';
require 'inc/header.php';
?>

<div class="container row-offcanvas row-offcanvas-left">
  <div id="content" class="column card-lg-12 col-sm-12 col-xs-12">

    <!-- Page Title -->
    <div class="row pt-3 mb-3">
      <div class="row">
        <h2 class="col-md-6 mb-3 me-3"><?php echo $title; ?> </h2>
      </div>

      <!-- Main card to hold the match selection -->
      <div class="card col-md-6 mx-auto mb-3">

        <!-- Our team matches list -->
        <h5 class="pt-3">2135 Match Links</h5>
        <div class="row mb-3">
          <div id="ourMatches">
          </div>
        </div>

        <!-- Load Match buttons -->
        <div class="card mb-3">
          <div class="input-group">
            <div class="input-group-prepend">
              <select id="enterCompLevel" class="form-select" aria-label="Comp Level Select">
                <option value="qm">QM</option>
                <option value="sf">SF</option>
                <option value="f">F</option>
              </select>
            </div>
            <input id="enterMatchNumber" class="form-control" type="text" placeholder="Match Number" aria-label="Match Number">
            <div class="input-group-append">
              <button id="loadMatchButton" class="btn btn-primary" type="button">Load Match</button>
            </div>
          </div>
        </div>

        <!-- Custom match button (collapsible section) -->
        <div class="card mb-3">

          <div id="customMatch" class="accordion accordion-flush">
            <div class="accordion-item bg-secondary-subtle">
              <h2 class="accordion-header">
                <button class="accordion-button text-light bg-secondary" type="button" data-bs-toggle="collapse"
                  data-bs-target="#matchEntry" aria-expanded="false" aria-controls="matchEntry">Enter Custom Match
                </button>
              </h2>
              <div id="matchEntry" class="accordion-collapse collapse" data-bs-parent="#customMatch">
                <div class="accordion-body">
                  <div class="input-group mb-3">
                    <h5 id="red">Red Alliance:</h5>
                    <div class="input-group mb-3">
                      <input id="enterRed1" class="form-control border border-black bg-danger-subtle" type="text"
                        placeholder="Red Team 1" aria-label="Red Team 1">
                      <input id="enterRed2" class="form-control border border-black bg-danger-subtle" type="text"
                        placeholder="Red Team 2" aria-label="Red Team 2">
                      <input id="enterRed3" class="form-control border border-black bg-danger-subtle" type="text"
                        placeholder="Red Team 3" aria-label="Red Team 3">
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <h5 id="blue">Blue Alliance:</h5>
                    <div class="input-group mb-3">
                      <input id="enterBlue1" class="form-control border border-black bg-primary-subtle" type="text"
                        placeholder="Blue Team 1" aria-label="Blue Team 1">
                      <input id="enterBlue2" class="form-control border border-black bg-primary-subtle" type="text"
                        placeholder="Blue Team 2" aria-label="Blue Team 2">
                      <input id="enterBlue3" class="form-control border border-black bg-primary-subtle" type="text"
                        placeholder="Blue Team 3" aria-label="Blue Team 3">
                    </div>
                  </div>
                  <button id="loadCustomMatch" class="btn btn-primary" type="button">Load Custom Match</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Match overview card -->
      <div class="card col-md-6 mx-auto mb-3 p-3">
        <h5 id="matchTitle">Match:</h5>
        <h5 id="matchTime">Time:</h5>
        <table class="table table-bordered table-sm border-secondary text-center">
          <thead>
            <tr>
              <th></th>
              <th class="text-bg-danger">Red</th>
              <th class="text-bg-primary">Blue</th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
            <tr>
              <td class="text-start table-secondary">Avg Total Coral</td>
              <td id="redTotalCoral" class="table-danger"></td>
              <td id="blueTotalCoral" class="table-primary"></td>
            </tr>
            <tr>
              <td class="text-start table-secondary">Avg Total Algae</td>
              <td id="redTotalAlgae" class="table-danger"></td>
              <td id="blueTotalAlgae" class="table-primary"></td>
            </tr>
            <tr>
              <td class="text-start table-secondary">Avg Auton Points</td>
              <td id="redAvgAutoPoints" class="table-danger"></td>
              <td id="blueAvgAutoPoints" class="table-primary"></td>
            </tr>
            <tr>
              <td class="text-start table-secondary">Avg Teleop Points</td>
              <td id="redAvgTeleopPoints" class="table-danger"></td>
              <td id="blueAvgTeleopPoints" class="table-primary"></td>
            </tr>
            <tr>
              <td class="text-start table-secondary">Avg Endgame Points</td>
              <td id="redAvgEndgamePoints" class="table-danger"></td>
              <td id="blueAvgEndgamePoints" class="table-primary"></td>
            <tr>
              <td class="text-start table-secondary">Predicted Points</td>
              <td id="redPredictedTotalPoints" class="table-danger"></td>
              <td id="bluePredictedTotalPoints" class="table-primary"></td>
            </tr>
            <tr>
              <td class="text-start table-secondary">Actual Points</td>
              <td id="redActualTotalPoints" class="table-danger"></td>
              <td id="blueActualTotalPoints" class="table-primary"></td>
            <tr>
              <td class="text-start table-secondary">Predicted RP</td>
              <td id="redPredictedRP" class="table-danger"></td>
              <td id="bluePredictedRP" class="table-primary"></td>
            </tr>
            <tr>
              <td class="text-start table-secondary">Actual RP</td>
              <td id="redActualRP" class="table-danger"></td>
              <td id="blueActualRP" class="table-primary"></td>
            </tr>
          </tbody>
        </table>
      </div>

    </div>
  </div>

  <!-- Red Team cards -->
  <div class="row mb-3 gx-3">

    <!-- Red0 - Red Team 1 -->
    <div class="col-lg-4 col-sm-4 col-xs-4 gx-3">
      <div id="R0TeamBox" class="accordion accordion-flush mb-3">
        <div class="accordion-item bg-danger">

          <div id="R0TeamHeader" class="accordion-header d-flex align-items-center bg-danger">
            <a class="text-start text-nowrap link-light fw-bold ms-3">Team #</a>
            <button class="accordion-button bg-transparent shadow-none collapsed" type="button" data-bs-toggle="collapse"
              data-bs-target="#R0TeamCollapse" aria-expanded="false" aria-controls="R0TeamCollapse">
            </button>
          </div>

          <div id="R0TeamCollapse" class="accordion-collapse collapse" data-bs-parent="#R0TeamBox">
            <div id="R0PicsCarousel" class="carousel slide" data-interval="false">
              <div id="R0RobotPics" class="carousel-inner"> </div>
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
            <table id="R0DataTable" class="table table-bordered table-danger table-sm text-center">
              <thead> </thead>
              <tbody class="table-group-divider"> </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>

    <!-- Red1 - Red Team 2 -->
    <div class="col-lg-4 col-sm-4 col-xs-4 gx-3">
      <div id="R1TeamBox" class="accordion accordion-flush mb-3">
        <div class="accordion-item bg-danger">

          <div id="R1TeamHeader" class="accordion-header d-flex align-items-center bg-danger">
            <a class="text-start text-nowrap link-light fw-bold ms-3">Team #</a>
            <button class="accordion-button bg-transparent shadow-none collapsed" type="button" data-bs-toggle="collapse"
              data-bs-target="#R1TeamCollapse" aria-expanded="false" aria-controls="R1TeamCollapse">
            </button>
          </div>

          <div id="R1TeamCollapse" class="accordion-collapse collapse" data-bs-parent="#R1TeamBox">
            <div id="R1PicsCarousel" class="carousel slide" data-interval="false">
              <div id="R1RobotPics" class="carousel-inner"> </div>
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
            <table id="R1DataTable" class="table table-bordered table-danger table-sm text-center">
              <thead> </thead>
              <tbody class="table-group-divider"> </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>

    <!-- Red2 - Red Team 3 -->
    <div class="col-lg-4 col-sm-4 col-xs-4 gx-3">
      <div id="R2TeamBox" class="accordion accordion-flush mb-3">
        <div class="accordion-item bg-danger">

          <div id="R2TeamHeader" class="accordion-header d-flex align-items-center bg-danger">
            <a class="text-start text-nowrap link-light fw-bold ms-3">Team #</a>
            <button class="accordion-button bg-transparent shadow-none collapsed" type="button" data-bs-toggle="collapse"
              data-bs-target="#R2TeamCollapse" aria-expanded="false" aria-controls="R2TeamCollapse">
            </button>
          </div>

          <div id="R2TeamCollapse" class="accordion-collapse collapse" data-bs-parent="#R2TeamBox">
            <div id="R2PicsCarousel" class="carousel slide" data-interval="false">
              <div id="R2RobotPics" class="carousel-inner"> </div>
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
            <table id="R2DataTable" class="table table-bordered table-danger table-sm text-center">
              <thead> </thead>
              <tbody class="table-group-divider"> </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
  </div>

  <!-- Blue Team cards -->
  <div class="row mb-3 gx-3">

    <!-- Blue0 - Blue Team 1 -->
    <div class="col-lg-4 col-sm-4 col-xs-4 gx-3">
      <div id="B0TeamBox" class="accordion accordion-flush mb-3">
        <div class="accordion-item bg-primary">

          <div id="B0TeamHeader" class="accordion-header d-flex align-items-center bg-primary">
            <a class="text-start text-nowrap link-light fw-bold ms-3">Team #</a>
            <button class="accordion-button bg-transparent shadow-none collapsed" type="button" data-bs-toggle="collapse"
              data-bs-target="#B0TeamCollapse" aria-expanded="false" aria-controls="B0TeamCollapse">
            </button>
          </div>

          <div id="B0TeamCollapse" class="accordion-collapse collapse" data-bs-parent="#B0TeamBox">
            <div id="B0PicsCarousel" class="carousel slide" data-interval="false">
              <div id="B0RobotPics" class="carousel-inner"> </div>
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
            <table id="B0DataTable" class="table table-bordered table-primary table-sm text-center">
              <thead> </thead>
              <tbody class="table-group-divider"> </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>

    <!-- Blue1 - Blue Team 2 -->
    <div class="col-lg-4 col-sm-4 col-xs-4 gx-3">
      <div id="B1TeamBox" class="accordion accordion-flush mb-3">
        <div class="accordion-item bg-primary">

          <div id="B1TeamHeader" class="accordion-header d-flex align-items-center bg-primary">
            <a class="text-start text-nowrap link-light fw-bold ms-3">Team #</a>
            <button class="accordion-button bg-transparent shadow-none collapsed" type="button" data-bs-toggle="collapse"
              data-bs-target="#B1TeamCollapse" aria-expanded="false" aria-controls="B1TeamCollapse">
            </button>
          </div>

          <div id="B1TeamCollapse" class="accordion-collapse collapse" data-bs-parent="#B1TeamBox">
            <div id="B1PicsCarousel" class="carousel slide" data-interval="false">
              <div id="B1RobotPics" class="carousel-inner"> </div>
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
            <table id="B1DataTable" class="table table-bordered table-primary table-sm text-center">
              <thead> </thead>
              <tbody class="table-group-divider"> </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>

    <!-- Blue2 - Blue Team 3 -->
    <div class="col-lg-4 col-sm-4 col-xs-4 gx-3">
      <div id="B2TeamBox" class="accordion accordion-flush mb-3">
        <div class="accordion-item bg-primary">

          <div id="B2TeamHeader" class="accordion-header d-flex align-items-center bg-primary">
            <a class="text-start text-nowrap link-light fw-bold ms-3">Team #</a>
            <button class="accordion-button bg-transparent shadow-none collapsed" type="button" data-bs-toggle="collapse"
              data-bs-target="#B2TeamCollapse" aria-expanded="false" aria-controls="B2TeamCollapse">
            </button>
          </div>

          <div id="B2TeamCollapse" class="accordion-collapse collapse" data-bs-parent="#B2TeamBox">
            <div id="B2PicsCarousel" class="carousel slide" data-interval="false">
              <div id="B2RobotPics" class="carousel-inner"> </div>
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
            <table id="B2DataTable" class="table table-bordered table-primary table-sm text-center">
              <thead> </thead>
              <tbody class="table-group-divider"> </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>

  </div>
</div>

<?php include 'inc/footer.php'; ?>

<!-- Javascript page handlers -->

<script>

  //
  // Utility to strip off leading "frc" from team number
  //
  function strTeamToIntTeam(team) {
    return team.replace(/^(frc)/, '');
  }

  //
  // Round data to no more than two decimal digits
  //
  function roundTwoPlaces(val) {
    return Math.round((val + Number.EPSILON) * 100) / 100;
  }

  //
  // Fix match IDs that are missing the comp level
  //
  function getFixedMatchId(matchId) {
    matchId = matchId.toLowerCase();
    if ((matchId.search("p") != -1) || (matchId.search("qm") != -1) ||
      (matchId.search("sf") != -1) || (matchId.search("f") != -1)) {
      return matchId;
    }
    else {  // Attempt to repair bad match IDs but log them
      console.warn("getMatchTuple: Invalid matchId! " + matchId);
      return "qm" + matchId;
    }
  }

  //
  // Get the comp level and match number from the match ID string (ex. [qm, 25] from qm25)
  //
  function getMatchTuple(matchId) {
    matchId = getFixedMatchId(matchId);
    if (matchId.search("p") != -1) {
      return ["p", parseInt(matchId.substring(1))];
    }
    else if (matchId.search("qm") != -1) {
      return ["qm", parseInt(matchId.substring(2))];
    }
    else if (matchId.search("sf") != -1) {
      return ["sf", parseInt(matchId.substring(2))];
    }
    else if (matchId.search("f") != -1) {
      return ["f", parseInt(matchId.substring(1))];
    }
    else {  // Repair bad match IDs but report them
      console.warn("getMatchTuple: Invalid match prefix! " + matchId);
    }
    return null;
  }

  //
  // Create a match key in the form QM_1
  //
  function idToKey(matchId) {
    mt = getMatchTuple(matchId);
    return mt[0].toUpperCase() + "_" + String(mt[1]).toUpperCase();
  }

  //
  // Create a match key in the form QM_1
  //
  function makeKey(compLevel, matchNumber) {
    return compLevel.toUpperCase() + "_" + String(matchNumber).toUpperCase();
  }

  //
  // Clear all existing data from the match sheet table
  //
  function clearMatchSheet() {
    console.log("==> matchSheet: clearMatchSheet()");

    // Clear out custom match entries
    document.getElementById("enterRed1").innerText = "";
    document.getElementById("enterRed2").innerText = "";
    document.getElementById("enterRed3").innerText = "";
    document.getElementById("enterBlue1").innerText = "";
    document.getElementById("enterBlue2").innerText = "";
    document.getElementById("enterBlue3").innerText = "";

    // Clear match summary
    document.getElementById("matchTitle").innerText = "Match:";
    document.getElementById("matchTime").innerText = "Time:";

    document.getElementById("redTotalCoral").innerText = "";
    document.getElementById("redTotalAlgae").innerText = "";
    document.getElementById("redAvgAutoPoints").innerText = "";
    document.getElementById("redAvgTeleopPoints").innerText = "";
    document.getElementById("redAvgEndgamePoints").innerText = "";
    document.getElementById("redPredictedTotalPoints").innerText = "";
    document.getElementById("redActualTotalPoints").innerText = "";
    document.getElementById("redPredictedRP").innerText = "";
    document.getElementById("redActualRP").innerText = "";

    document.getElementById("blueTotalCoral").innerText = "";
    document.getElementById("blueTotalAlgae").innerText = "";
    document.getElementById("blueAvgAutoPoints").innerText = "";
    document.getElementById("blueAvgTeleopPoints").innerText = "";
    document.getElementById("blueAvgEndgamePoints").innerText = "";
    document.getElementById("bluePredictedTotalPoints").innerText = "";
    document.getElementById("blueActualTotalPoints").innerText = "";
    document.getElementById("bluePredictedRP").innerText = "";
    document.getElementById("blueActualRP").innerText = "";

    // Clear team box photo and match data
    document.getElementById("R0RobotPics").innerText = "";
    document.getElementById("R1RobotPics").innerText = "";
    document.getElementById("R2RobotPics").innerText = "";
    document.getElementById("B0RobotPics").innerText = "";
    document.getElementById("B1RobotPics").innerText = "";
    document.getElementById("B2RobotPics").innerText = "";

    document.getElementById("R0DataTable").querySelector('tbody').innerHTML = "";
    document.getElementById("R1DataTable").querySelector('tbody').innerHTML = "";
    document.getElementById("R2DataTable").querySelector('tbody').innerHTML = "";
    document.getElementById("B0DataTable").querySelector('tbody').innerHTML = "";
    document.getElementById("B1DataTable").querySelector('tbody').innerHTML = "";
    document.getElementById("B2DataTable").querySelector('tbody').innerHTML = "";
  }

  //
  // Build the list of HTML links to our matches at this event
  //
  function buildOurTeamMatchLinks(ourMatches) {
    console.log("==> matchSheet: buildOurTeamMatchLinks()");
    let ourMatchesArray = [];
    for (let key in ourMatches) {
      ourMatchesArray.push(ourMatches[key]);
    }

    ourMatchesArray.sort(function (matchA, matchB) {
      return compareMatchNumbers(matchA["comp_level"] + matchA["match_number"], matchB["comp_level"] + matchB["match_number"]);
    });

    for (let i = 0; i < ourMatchesArray.length; i++) {
      let thisMatch = ourMatchesArray[i];
      let matchId = thisMatch["comp_level"] + thisMatch["match_number"]
      const button = document.createElement("button");
      button.id = matchId;
      button.classList.add("btn");
      button.classList.add("btn-secondary");
      button.classList.add("btn-sm");
      button.classList.add("col-2");
      button.classList.add("m-1");
      button.type = "button";
      button.textContent = matchId;

      button.onclick = function (el) {
        document.getElementById("enterCompLevel").value = thisMatch["comp_level"];
        document.getElementById("enterMatchNumber").value = thisMatch["match_number"];
        document.getElementById("loadMatchButton").click();
      }
      document.getElementById("ourMatches").appendChild(button);
    }
  }

  //
  // Takes list of Team Pic paths and loads them
  //
  function buildRobotPhotoLinks(prefix, teamPics) {
    console.log("==> buildRobotPhotoLinks: build the entries in the photo carousels");
    let count = 0;
    let slideRef = document.getElementById(prefix + "RobotPics");
    slideRef.innerHTML = "";
    for (let uri of teamPics) {
      let slide = "<div class='carousel-item";
      if (count === 0) {
        slide += " active";
      }
      count++;
      slide += "'> <img src='./" + uri + "' class='d-block w-100'></div>";
      slideRef.innerHTML += slide;
    }
    if (count > 0) {
      document.getElementById(prefix + "TeamCollapse").classList.add("show");
    }
  }

  //
  // Update match time from system time in msec
  //
  function updateMatchTime(time) {
    let date = new Date(time * 1000);
    let hours = date.getHours();
    let suffix = "AM";
    if (hours > 12) {
      hours = hours - 12;
      suffix = "PM"
    }
    let minutes = "0" + date.getMinutes();
    document.getElementById("matchTime").innerText = "Time: " + hours + ":" + minutes.substring(minutes.length - 2) + " " + suffix;
  }

  //
  // Build the header in each team box data table
  //
  function buildTeamBoxTableHeader(tableId) {
    let rowString1 = "";
    rowString1 += '<th colspan="6" class="text-center fs-6 table-success">Auton</th>';
    rowString1 += '<th colspan="8" class="text-center fs-6 table-primary">Teleop</th>';
    rowString1 += '<th colspan="5" class="text-center fs-6 table-warning">Endgame</th>';

    let rowString2 = "";
    const thAuto = '<th scope="col" class="table-success">';
    rowString2 += thAuto + 'L4' + '</th>';
    rowString2 += thAuto + 'L3' + '</th>';
    rowString2 += thAuto + 'L2' + '</th>';
    rowString2 += thAuto + 'L1' + '</th>';
    rowString2 += thAuto + 'Net' + '</th>';
    rowString2 += thAuto + 'Proc' + '</th>';;

    const thTeleop = '<th scope="col" class="table-primary">';
    rowString2 += thTeleop + 'L4' + '</th >';
    rowString2 += thTeleop + 'L3' + '</th>';
    rowString2 += thTeleop + 'L2' + '</th>';
    rowString2 += thTeleop + 'L1' + '</th>';
    rowString2 += thTeleop + 'C%' + '</th>';
    rowString2 += thTeleop + 'Net' + '</th>';
    rowString2 += thTeleop + 'Proc' + '</th>';
    rowString2 += thTeleop + 'A%' + '</th>';

    const thEndgame = '<th scope="col" class="table-warning">';
    rowString2 += thEndgame + 'DP' + '</th>';
    rowString2 += thEndgame + 'SH' + '</th>';
    rowString2 += thEndgame + 'FL' + '</th>';
    rowString2 += thEndgame + 'PK' + '</th>';
    rowString2 += thEndgame + 'NO' + '</th>';

    document.getElementById(tableId).querySelector('thead').insertRow().innerHTML = rowString1;
    document.getElementById(tableId).querySelector('thead').insertRow().innerHTML = rowString2;
  }

  //
  // Load the info into the team box
  //
  function buildTeamBoxTableBody(color, index, teamNum, averagesData) {
    console.log("==> buildTeamBoxTableBody: build the team box in the match sheet - " + teamNum);
    // Get team name from TBA
    $.get("api/tbaAPI.php", {
      getTeamInfo: teamNum
    }).done(function (teamInfo) {
      console.log("=> getTeamInfo:");
      if (teamInfo === null) {
        return alert("Can't load teamInfo from TBA; check if TBA Key was set in db_config");
      }
      let teamName = "";
      if (teamInfo === null) {
        alert("Can't load teamName from TBA; check if TBA Key was set in db_config");
      }
      else {
        let jTeamInfo = JSON.parse(teamInfo)["response"];
        teamName += " " + jTeamInfo["nickname"];
      }
      console.log("==> matchSheet: buildTeamBoxTableBody() for " + teamNum + teamName);
      let elementRef = document.getElementById(color + index + "TeamHeader");
      let aRef = elementRef.querySelector('a');
      aRef.href = 'teamLookup.php?teamNum=' + teamNum;
      aRef.text = teamNum + " " + teamName;
    });

    // Load team scouted information
    let ad = averagesData[teamNum];
    let tbodyRef = document.getElementById(color + index + "DataTable").querySelector('tbody');
    tbodyRef.innerHTML = "";
    let row = "";
    if (ad != null) {
      row += "<td>" + ad["autonCoralL4"].avg + "</td>";
      row += "<td>" + ad["autonCoralL3"].avg + "</td>";
      row += "<td>" + ad["autonCoralL2"].avg + "</td>";
      row += "<td>" + ad["autonCoralL1"].avg + "</td>";
      row += "<td>" + ad["autonAlgaeNet"].avg + "</td>";
      row += "<td>" + ad["autonAlgaeProc"].avg + "</td>";
      row += "<td>" + ad["teleopCoralL4"].avg + "</td>";
      row += "<td>" + ad["teleopCoralL3"].avg + "</td>";
      row += "<td>" + ad["teleopCoralL2"].avg + "</td>";
      row += "<td>" + ad["teleopCoralL1"].avg + "</td>";
      row += "<td>" + ad["teleopCoralPieces"].acc + "</td>";
      row += "<td>" + ad["teleopAlgaeNet"].avg + "</td>";
      row += "<td>" + ad["teleopAlgaeProc"].avg + "</td>";
      row += "<td>" + ad["teleopAlgaePieces"].acc + "</td>";
      row += "<td>" + ad["endgameCageClimb"].arr[4].avg + "</td>";
      row += "<td>" + ad["endgameCageClimb"].arr[3].avg + "</td>";
      row += "<td>" + ad["endgameCageClimb"].arr[2].avg + "</td>";
      row += "<td>" + ad["endgameCageClimb"].arr[1].avg + "</td>";
      row += "<td>" + ad["endgameCageClimb"].arr[0].avg + "</td>";
    }
    tbodyRef.insertRow().innerHTML = row;
  }

  //
  // Update the match summary table comparing both alliances
  //
  function updateMatchSummary(matchSpec, averagesData) {
    let totalCoralPiecesAvg = { "red": 0, "blue": 0 };
    let totalAlgaePiecesAvg = { "red": 0, "blue": 0 };
    let avgAutoPoints = { "red": 0, "blue": 0 };
    let avgTeleopPoints = { "red": 0, "blue": 0 };
    let endgamePointsAvg = { "red": 0, "blue": 0 };
    let predictedPoints = { "red": 0, "blue": 0 };
    let autoLeaves = { "red": 0, "blue": 0 };
    let autoCorals = { "red": 0, "blue": 0 };
    let totalCoralsL1 = { "red": 0, "blue": 0 };
    let totalCoralsL2 = { "red": 0, "blue": 0 };
    let totalCoralsL3 = { "red": 0, "blue": 0 };
    let totalCoralsL4 = { "red": 0, "blue": 0 };

    for (let i in matchSpec.red) {
      teamNum = matchSpec.red[i];
      let ad = averagesData[teamNum];
      if (ad != null) {
        totalCoralPiecesAvg["red"] += ad["totalCoralPieces"].avg;
        totalAlgaePiecesAvg["red"] += ad["totalAlgaePieces"].avg;
        avgAutoPoints["red"] += ad["autonPoints"].avg;
        avgTeleopPoints["red"] += ad["teleopPoints"].avg;
        endgamePointsAvg["red"] += ad["endgamePoints"].avg;
        predictedPoints["red"] += ad["totalMatchPoints"].avg;
        autoLeaves["red"] += ad["autonLeave"].avg;
        autoCorals["red"] += ad["autonCoralL1"].avg + ad["autonCoralL2"].avg + ad["autonCoralL3"].avg + ad["autonCoralL4"].avg;
        totalCoralsL1["red"] += ad["autonCoralL1"].avg + ad["teleopCoralL1"].avg;
        totalCoralsL2["red"] += ad["autonCoralL2"].avg + ad["teleopCoralL2"].avg;
        totalCoralsL3["red"] += ad["autonCoralL3"].avg + ad["teleopCoralL3"].avg;
        totalCoralsL4["red"] += ad["autonCoralL4"].avg + ad["teleopCoralL4"].avg;
      }
    }
    for (let i in matchSpec.blue) {
      teamNum = matchSpec.blue[i];
      let ad = averagesData[teamNum];
      if (ad != null) {
        totalCoralPiecesAvg["blue"] += ad["totalCoralPieces"].avg;
        totalAlgaePiecesAvg["blue"] += ad["totalAlgaePieces"].avg;
        avgAutoPoints["blue"] += ad["autonPoints"].avg;
        avgTeleopPoints["blue"] += ad["teleopPoints"].avg;
        endgamePointsAvg["blue"] += ad["endgamePoints"].avg;
        predictedPoints["blue"] += ad["totalMatchPoints"].avg;
        autoLeaves["blue"] += ad["autonLeave"].avg;
        autoCorals["blue"] += ad["autonCoralL1"].avg + ad["autonCoralL2"].avg + ad["autonCoralL3"].avg + ad["autonCoralL4"].avg;
        totalCoralsL1["blue"] += ad["autonCoralL1"].avg + ad["teleopCoralL1"].avg;
        totalCoralsL2["blue"] += ad["autonCoralL2"].avg + ad["teleopCoralL2"].avg;
        totalCoralsL3["blue"] += ad["autonCoralL3"].avg + ad["teleopCoralL3"].avg;
        totalCoralsL4["blue"] += ad["autonCoralL4"].avg + ad["teleopCoralL4"].avg;
      }
    }

    // Predict ranking points
    //  AutoRP - auto leaves > 2.5 (> 80% success for leaving) AND at least one coral scored in autonomous (> 0.8 coral scored)
    //  CoralRP - 5 coral on each level:  can score on L1 and average a total of at tleast 18.5 coral
    //  Endgame average points > 10 (indicates at least one deep climb, because one shallow plus 2 parks is == 10)
    //  Win - predicted points for each alliance 2, 1, 0
    let predictedRP = { "red": 0, "blue": 0 };
    predictedRP["red"] += (autoLeaves["red"] > 2.5) && (autoCorals["red"] > 0.8);
    predictedRP["blue"] += (autoLeaves["blue"] > 2.5) && (autoCorals["blue"] > 0.8);

    predictedRP["red"] += (totalCoralsL1["red"] > 2.5) && ((totalCoralsL1["red"] + totalCoralsL2["red"] + totalCoralsL3["red"] + totalCoralsL4["red"]) > 18.5) ? 1 : 0;
    predictedRP["blue"] += (totalCoralsL1["blue"] > 2.5) && ((totalCoralsL1["blue"] + totalCoralsL2["blue"] + totalCoralsL3["blue"] + totalCoralsL4["blue"]) > 18.5) ? 1 : 0;

    predictedRP["red"] += (endgamePointsAvg["red"] > 10.0) ? 1 : 0;
    predictedRP["blue"] += (endgamePointsAvg["blue"] > 10.0) ? 1 : 0;

    predictedRP["red"] += (predictedPoints["red"] > predictedPoints["blue"]) ? 3 :
      (predictedPoints["red"] == predictedPoints["blue"]) ? 1 : 0;
    predictedRP["blue"] += (predictedPoints["blue"] > predictedPoints["red"]) ? 3 :
      (predictedPoints["blue"] == predictedPoints["red"]) ? 1 : 0;

    let summedOPR = { "red": 0, "blue": 0 };
    let actualPoints = { "red": 0, "blue": 0 };

    document.getElementById("redTotalCoral").innerText = roundTwoPlaces(totalCoralPiecesAvg["red"]);
    document.getElementById("redTotalAlgae").innerText = roundTwoPlaces(totalAlgaePiecesAvg["red"]);
    document.getElementById("redAvgAutoPoints").innerText = roundTwoPlaces(avgAutoPoints["red"]);
    document.getElementById("redAvgTeleopPoints").innerText = roundTwoPlaces(avgTeleopPoints["red"]);
    document.getElementById("redAvgEndgamePoints").innerText = roundTwoPlaces(endgamePointsAvg["red"]);
    document.getElementById("redPredictedTotalPoints").innerText = roundTwoPlaces(predictedPoints["red"]);
    document.getElementById("redActualTotalPoints").innerText = roundTwoPlaces(matchSpec["redScore"]);
    document.getElementById("redPredictedRP").innerText = roundTwoPlaces(predictedRP["red"]);
    document.getElementById("redActualRP").innerText = roundTwoPlaces(matchSpec["redRP"]);

    document.getElementById("blueTotalCoral").innerText = roundTwoPlaces(totalCoralPiecesAvg["blue"]);
    document.getElementById("blueTotalAlgae").innerText = roundTwoPlaces(totalAlgaePiecesAvg["blue"]);
    document.getElementById("blueAvgAutoPoints").innerText = roundTwoPlaces(avgAutoPoints["blue"]);
    document.getElementById("blueAvgTeleopPoints").innerText = roundTwoPlaces(avgTeleopPoints["blue"]);
    document.getElementById("blueAvgEndgamePoints").innerText = roundTwoPlaces(endgamePointsAvg["blue"]);
    document.getElementById("bluePredictedTotalPoints").innerText = roundTwoPlaces(predictedPoints["blue"]);
    document.getElementById("blueActualTotalPoints").innerText = roundTwoPlaces(matchSpec["blueScore"]);
    document.getElementById("bluePredictedRP").innerText = roundTwoPlaces(predictedRP["blue"]);
    document.getElementById("blueActualRP").innerText = roundTwoPlaces(matchSpec["blueRP"]);
  }

  //
  // Build team photo image list
  //
  function sendPhotoRequest(matchSpec) {
    console.log("==> matchSheet: sendPhotoRequest()");
    let _picDB = {};
    let requestList = [];

    for (let i in matchSpec.red) {
      let tn = matchSpec.red[i];
      if (tn !== "") {
        _picDB[tn] = "R" + i;
        requestList.push(tn);
      }
    }

    for (let i in matchSpec.blue) {
      let tn = matchSpec.blue[i];
      if (tn !== "") {
        _picDB[tn] = "B" + i;
        requestList.push(tn);
      }
    }

    $.get("api/dbReadAPI.php", {
      getAllTeamImages: JSON.stringify(requestList)
    }).done(function (imageData) {
      console.log("=> getAllTeamImages");
      let jImageData = JSON.parse(imageData);
      for (let team of Object.keys(jImageData)) {
        buildRobotPhotoLinks(_picDB[team], jImageData[team]);
      }
    });
  }

  //
  // Clear a match spec object
  //
  function clearMatchSpec(spec) {
    spec.title = "";
    spec.time = "";
    spec.red = ["", "", ""];
    spec.blue = ["", "", ""];
  }

  //
  // Create the event match list, extract our matches and build links for them
  //
  function buildMatchList(allEventMatches) {
    console.log("==> matchSheet: buildMatchList()");
    const OURTEAM = "frc2135";
    let ourMatches = {};
    let eventMatchList = [];
    for (let mi in allEventMatches) {
      let match = allEventMatches[mi];
      let newMatch = {};

      newMatch["comp_level"] = match["comp_level"];
      newMatch["match_number"] = match["match_number"];
      if (match["comp_level"] === "sf") {
        newMatch["match_number"] = match["set_number"];
      }

      newMatch["red_teams"] = match["alliances"]["red"]["team_keys"];
      newMatch["redScore"] = match["alliances"]["red"]["score"];
      newMatch["redRP"] = match["score_breakdown"]["red"]["rp"];

      newMatch["blue_teams"] = match["alliances"]["blue"]["team_keys"];
      newMatch["blueScore"] = match["alliances"]["blue"]["score"];
      newMatch["blueRP"] = match["score_breakdown"]["blue"]["rp"];

      newMatch["time"] = null;
      if (match["predicted_time"] != null) {
        newMatch["time"] = match["predicted_time"];
      } else if (match["actual_time"] != null) {
        newMatch["time"] = match["actual_time"];
      }

      // if (newMatch["time"] === null && match["time"] != null){ newMatch["time"] = match["time"]; }
      eventMatchList[idToKey(newMatch["comp_level"] + newMatch["match_number"])] = newMatch;

      // Create list of matches for our team
      if (newMatch["red_teams"].includes(OURTEAM) || newMatch["blue_teams"].includes(OURTEAM)) {
        let keyw = newMatch["comp_level"] + newMatch["match_number"];
        ourMatches[keyw] = newMatch;
      }
    }
    buildOurTeamMatchLinks(ourMatches);
    return eventMatchList;
  }

  //
  // Check source URL for match specifier
  //
  function checkURLForMatchId() {
    console.log("==> matchSheet: checkURLForMatchId()");
    let sp = new URLSearchParams(window.location.search);
    if (sp.has('compLevel') && sp.has('matchNum')) {
      return sp.get('compLevel') + sp.get('matchNum');
    }
    return null;
  }

  //
  // Get a match spec from a matchId
  //
  function getEventMatchSpec(matchId, matchList) {
    if (matchList === null) {
      return null;
    }

    let matchVector = matchList[idToKey(matchId)];
    if (!matchVector) {
      console.error("matchSheet: getEventMatchSpec: Match does not exist: " + idToKey(matchId));
      return alert("Match " + idToKey(matchId) + " does not exist!");
    }

    matchSpec = {
      title: matchId,
      time: matchVector["time"],
      red: [
        strTeamToIntTeam(matchVector["red_teams"][0]),
        strTeamToIntTeam(matchVector["red_teams"][1]),
        strTeamToIntTeam(matchVector["red_teams"][2])
      ],
      redScore: matchVector["redScore"],
      redRP: matchVector["redRP"],
      blue: [
        strTeamToIntTeam(matchVector["blue_teams"][0]),
        strTeamToIntTeam(matchVector["blue_teams"][1]),
        strTeamToIntTeam(matchVector["blue_teams"][2])
      ],
      blueScore: matchVector["blueScore"],
      blueRP: matchVector["blueRP"]
    };

    return matchSpec;
  }

  //
  // Build a custom red and blue alliance matchsheet
  //
  function loadMatchSheet(matchSpec, averagesData) {
    console.log("==> matchSheet: loadMatchSheet()");
    clearMatchSheet();

    if (matchSpec === null) {
      console.error("matchSheet: loadMatchSheet: averagesData is null!");
      return alert("matchSheet: loadMatchSheet: averagesData is null!");
    }
    sendPhotoRequest(matchSpec);

    document.getElementById("matchTitle").innerText = matchSpec.title;
    if (matchSpec.title !== "CUSTOM") {
      updateMatchTime(matchSpec["time"]);
    }
    updateMatchSummary(matchSpec, averagesData);

    buildTeamBoxTableBody("R", 0, matchSpec.red[0], averagesData);
    buildTeamBoxTableBody("R", 1, matchSpec.red[1], averagesData);
    buildTeamBoxTableBody("R", 2, matchSpec.red[2], averagesData);
    buildTeamBoxTableBody("B", 0, matchSpec.blue[0], averagesData);
    buildTeamBoxTableBody("B", 1, matchSpec.blue[1], averagesData);
    buildTeamBoxTableBody("B", 2, matchSpec.blue[2], averagesData);
  }

  /////////////////////////////////////////////////////////////////////////////
  //
  // Process the generated html
  //  Get the event match list (1) from TBA and identify our matches from TBA schedule to build quick links
  //  Get all match data and averages (2) from our database to prepare for creating the match sheet
  //  When load button (3) our quick link (4) is clicked 
  //    Use the match ID to identify all teams with a matchSpec
  //  When the custom match button (5) is clicked
  //    Create a matchSpec from the teams entered
  //
  //  Note that all 5 of these events can happen or complete at different times. All five sequences test 
  //    to see if the minimum data is needed for the match sheet (matchSpec and averagesData) and call the 
  //    final function to load the match sheet.
  //
  //  LoadMatchSheet function:
  //    Request photos for each team
  //    Update the match summary table using the match averages
  //    Build a team box for each team with the team info, photo, and match average data
  //
  document.addEventListener("DOMContentLoaded", function () {
    let matchId = null;
    let matchList = null;
    let averagesData = null;
    let matchSpec = null;

    buildTeamBoxTableHeader("R0DataTable");
    buildTeamBoxTableHeader("R1DataTable");
    buildTeamBoxTableHeader("R2DataTable");
    buildTeamBoxTableHeader("B0DataTable");
    buildTeamBoxTableHeader("B1DataTable");
    buildTeamBoxTableHeader("B2DataTable");

    // Load event matches from TBA and build our links and a full match list
    $.get("api/tbaAPI.php", {
      getEventMatches: true
    }).done(function (eventMatches) {
      console.log("=> getEventMatches");
      if (eventMatches === null) {
        return alert("Can't load eventMatches from TBA; check if TBA Key was set in db_config");
      }
      else {
        let jEventMatches = JSON.parse(eventMatches)["response"];
        matchList = buildMatchList(jEventMatches);
        if (matchId !== null)
          matchSpec = getEventMatchSpec(matchId, matchList);
        if ((matchSpec !== null) && (averagesData !== null))
          loadMatchSheet(matchSpec, averagesData);
      }
    });

    // Load all match scouting data to be processed later
    $.get("api/dbReadAPI.php", {
      getAllMatchData: true
    }).done(function (allMatchData) {
      console.log("=> getAllMatchData");
      let mdp = new matchDataProcessor(JSON.parse(allMatchData));
      mdp.getSiteFilteredAverages(function (filteredMatchData, filteredAvgData) {
        averagesData = filteredAvgData;
        if ((matchSpec !== null) && (averagesData !== null))
          loadMatchSheet(matchSpec, averagesData);
      });
    });

    // Check URL for match ID to load
    matchId = checkURLForMatchId();
    if (matchId !== null) {
      console.log("==> matchsheet: building from URL match ID! " + matchId);
      matchSpec = getEventMatchSpec(matchId, matchList);
      if ((matchSpec !== null) && (averagesData !== null))
        loadMatchSheet(matchSpec, averagesData);
    }

    // Load the match sheet from the match number entries
    document.getElementById("loadMatchButton").addEventListener('click', function () {
      console.log("=> matchsheet: load event match!");
      matchId = document.getElementById("enterCompLevel").value + document.getElementById("enterMatchNumber").value.trim();
      matchSpec = getEventMatchSpec(matchId, matchList);
      if ((matchSpec !== null) && (averagesData !== null))
        loadMatchSheet(matchSpec, averagesData);
    });

    // Load the custom match using the custom team numbers entries
    document.getElementById("loadCustomMatch").addEventListener('click', function () {
      console.log("=> matchsheet: load custom match!");
      let newSpec = {
        title: "CUSTOM",
        time: "",
        red: [document.getElementById("enterRed1").value.trim(), document.getElementById("enterRed2").value.trim(), document.getElementById("enterRed3").value.trim()],
        blue: [document.getElementById("enterBlue1").value.trim(), document.getElementById("enterBlue2").value.trim(), document.getElementById("enterBlue3").value.trim()]
      };
      console.log("==> Custom match sheet: " + newSpec.red[0] + " " + newSpec.blue[0]);
      if (newSpec.red[0] === "" && newSpec.blue[0] === "") {
        console.warn("loadCustomMatch: No Red or Blue team 1 entered!");
        return alert("Please fill in Red Team Number 1 and Blue Team Number 1!");
      }
      else {
        matchSpec = newSpec;
        if ((matchSpec !== null) && (averagesData !== null))
          loadMatchSheet(matchSpec, averagesData);
      }
    });

  });

</script>

<script src="./scripts/compareMatchNumbers.js"></script>
<script src="./scripts/matchDataProcessor.js"></script>
