<?php
$title = 'Match Check';
require 'inc/header.php';
?>

<div class="container row-offcanvas row-offcanvas-left">
  <div id="content" class="column card-lg-12 col-sm-12 col-xs-12">

    <!-- Page Title -->
    <div class="row col-md-6 pt-3 mb-3">
      <h2 class="col-auto mb-3 me-3"><?php echo $title; ?> </h2>
      <a class="col-auto btn btn-primary mb-3 me-3" href="javascript:history.back()">Back</a>
      <button id="downloadCsvFile" class="col-auto btn btn-primary mb-3 me-3" type="button">Download CSV</button>
      <div id="spinner" class="spinner-border ms-3 mb-3 me-3"></div>
    </div>

    <!-- Main row to hold the table -->
    <div class="row col-12 mb-3">

      <div id="freeze-table" class="freeze-table overflow-auto">
        <table id="matchCheckTable" class="table table-striped table-bordered table-hover table-sm border-secondary text-center">
          <thead class="z-3"> </thead>
          <tbody class="table-group-divider"> </tbody>
        </table>
      </div>
    </div>

  </div>
</div>

<?php include 'inc/footer.php'; ?>

<!-- Javascript page handlers -->

<script>

  //
  //  Match data check table utilities that:
  //    1) insert a header row for a match data check table
  //    2) insert a body row for match data check table
  //

  //
  // Scrape table and write CSV file
  //
  function downloadTableAsCSV(tableId, csvName) {
    csvName = csvName + ".csv";
    console.log("==> matchCheck: downloadTableAsCSV(): " + csvName);
    const table = document.getElementById(tableId).querySelector('tbody');
    let csv = [];

    // This CSV header must match the order in eventAveragesTable.js insertEventAveragesBody()
    let hdrStr = "Match,Count," +
      "RedTotalPts,RedAutonPts,RedTeleopPts,RedFoulsPts," +
      "RedLeave,RedAutonL4,RedAutonL3,RedAutonL2,RedAutoL1," +
      "RedTeleopL4,RedTeleopL3,RedTeleopL2,RedTelopL1,RedNet,RedProc," +
      "RedEnd1,RedEnd2,RedEnd3,RedFouls," +
      "BlueTotalPts,BlueAutonPts,BlueTeleopPts,BlueFoulsPts," +
      "BlueLeave,BlueAutonL4,BlueAutonL3,BlueAutonL2,BlueAutoL1," +
      "BlueTeleopL4,BlueTeleopL3,BlueTeleopL2,BlueTelopL1,BlueNet,BlueProc," +
      "BlueEnd1,BlueEnd2,BlueEnd3,BlueFouls";
    csv.push(hdrStr);

    const rows = table.querySelectorAll("tr");

    rows.forEach(row => {
      const cols = row.querySelectorAll("td");
      const rowData = Array.from(cols).map(col => col.innerText);
      csv.push(rowData.join(","));
    });

    const csvFile = new Blob([csv.join("\n")], { type: "text/csv" });
    const downloadLink = document.createElement("a");
    downloadLink.download = csvName;
    downloadLink.href = window.URL.createObjectURL(csvFile);
    downloadLink.style.display = "none";
    document.body.appendChild(downloadLink);
    downloadLink.click();
    document.body.removeChild(downloadLink);
  }

  const thBody = 'class="bg-body"';
  const thBodySort = 'class="bg-body"';
  const thRedPrefix = 'class="bg-danger"';
  const thBluePrefix = 'class="bg-primary"';

  //
  //  Insert a match check table header (all rows)
  //    Params
  //      tableId     - the HTML ID where the table header is inserted
  //
  function insertMatchCheckHeader(tableId) {
    console.log("==> insertMatchCheckHeader: tableId " + tableId);

    let theadRef = document.getElementById(tableId).querySelector('thead');;
    theadRef.innerHTML = ""; // Clear Table

    ///// ROW 1 /////

    let rowString1 = '';

    rowString1 += '<th colspan="2" ' + thBody + '> </th>';    // Match no, match count
    rowString1 += '<th colspan="19" ' + thRedPrefix + '>Red</th>';   // Match data count
    rowString1 += '<th colspan="19" ' + thBluePrefix + '>Blue</th>';   // Match data count

    theadRef.insertRow().innerHTML = rowString1;

    ///// ROW 2 /////

    const thBodyTable = 'class="bg-body"';
    const thRedPrefixTable = 'class="table-danger"';
    const thBluePrefixTable = 'class="table-primary"';

    let rowString2 = '';

    rowString2 += '<th colspan="2" ' + thBodyTable + '> </th>';    // Match no, match count
    rowString2 += '<th colspan="4" ' + thRedPrefixTable + '>Points</th>';   // Match data count
    rowString2 += '<th colspan="5" ' + thRedPrefixTable + '>Auto</th>';   // Match data count
    rowString2 += '<th colspan="6" ' + thRedPrefixTable + '>Teleop</th>';   // Match data count
    rowString2 += '<th colspan="3" ' + thRedPrefixTable + '>Endgame</th>';   // Match data count
    rowString2 += '<th colspan="1" ' + thRedPrefixTable + '></th>';   // Match data count

    rowString2 += '<th colspan="4" ' + thBluePrefixTable + '>Points</th>';   // Match data count
    rowString2 += '<th colspan="5" ' + thBluePrefixTable + '>Auto</th>';   // Match data count
    rowString2 += '<th colspan="6" ' + thBluePrefixTable + '>Teleop</th>';   // Match data count
    rowString2 += '<th colspan="3" ' + thBluePrefixTable + '>Endgame</th>';   // Match data count
    rowString2 += '<th colspan="1" ' + thBluePrefixTable + '></th>';   // Match data count

    theadRef.insertRow().innerHTML = rowString2;

    ///// ROW 3 /////

    const thBody3 = '<th class="bg-body">';
    const thBlue3Prefix = '<th class="table-primary">';
    const thRed3Prefix = '<th class="table-danger">';

    let rowString3 = '';

    // match info
    rowString3 += thBody3 + 'Match' + '</th>';
    rowString3 += thBody3 + '#' + '</th>';

    // red alliance
    // points by game phase
    rowString3 += thRed3Prefix + 'Total Pts' + '</th>';
    rowString3 += thRed3Prefix + 'Auto Pts' + '</th>';
    rowString3 += thRed3Prefix + 'Teleop Pts' + '</th>';
    rowString3 += thRed3Prefix + 'Foul Pts' + '</th>';

    // auton pieces an leave
    rowString3 += thRed3Prefix + 'Leave' + '</th>';
    rowString3 += thRed3Prefix + 'L4' + '</th>';
    rowString3 += thRed3Prefix + 'L3' + '</th>';
    rowString3 += thRed3Prefix + 'L2' + '</th>';
    rowString3 += thRed3Prefix + 'L1' + '</th>';

    // teleop pieces and endgame
    rowString3 += thRed3Prefix + 'L4' + '</th>';
    rowString3 += thRed3Prefix + 'L3' + '</th>';
    rowString3 += thRed3Prefix + 'L2' + '</th>';
    rowString3 += thRed3Prefix + 'L1' + '</th>';
    rowString3 += thRed3Prefix + 'Net' + '</th>';
    rowString3 += thRed3Prefix + 'Proc' + '</th>';
    rowString3 += thRed3Prefix + 'End 1' + '</th>';
    rowString3 += thRed3Prefix + 'End 2' + '</th>';
    rowString3 += thRed3Prefix + 'End 3' + '</th>';

    // fouls
    rowString3 += thRed3Prefix + 'Fouls' + '</th>';

    // blue alliance
    // points by game phase
    rowString3 += thBlue3Prefix + 'Total Pts' + '</th>';
    rowString3 += thBlue3Prefix + 'Auto Pts' + '</th>';
    rowString3 += thBlue3Prefix + 'Teleop Pts' + '</th>';
    rowString3 += thBlue3Prefix + 'Foul Pts' + '</th>';

    // auton pieces an leave
    rowString3 += thBlue3Prefix + 'Leave' + '</th>';
    rowString3 += thBlue3Prefix + 'L4' + '</th>';
    rowString3 += thBlue3Prefix + 'L3' + '</th>';
    rowString3 += thBlue3Prefix + 'L2' + '</th>';
    rowString3 += thBlue3Prefix + 'L1' + '</th>';

    // teleop pieces and endgame
    rowString3 += thBlue3Prefix + 'L4' + '</th>';
    rowString3 += thBlue3Prefix + 'L3' + '</th>';
    rowString3 += thBlue3Prefix + 'L2' + '</th>';
    rowString3 += thBlue3Prefix + 'L1' + '</th>';
    rowString3 += thBlue3Prefix + 'Net' + '</th>';
    rowString3 += thBlue3Prefix + 'Proc' + '</th>';
    rowString3 += thBlue3Prefix + 'End 1' + '</th>';
    rowString3 += thBlue3Prefix + 'End 2' + '</th>';
    rowString3 += thBlue3Prefix + 'End 3' + '</th>';

    // fouls
    rowString3 += thBlue3Prefix + 'Fouls' + '</th>';

    theadRef.insertRow().innerHTML = rowString3;
  };

  //
  // Reset match score object used to compare TBA against our match data
  //
  function resetMatchScore() {
    return {
      autonLeave: 0,
      autonCoralL4: 0,
      autonCoralL3: 0,
      autonCoralL2: 0,
      autonCoralL1: 0,
      teleopCoralL4: 0,
      teleopCoralL3: 0,
      teleopCoralL2: 0,
      teleopCoralL1: 0,
      allNet: 0,
      allProc: 0,
      endgameCageClimb: ["", "", ""],
      fouls: 0,
      totalPoints: 0,
      autonPoints: 0,
      teleopPoints: 0,
      foulPoints: 0,
    };
  }

  //
  // Build match data substring from match score object (used for TBA, match data, and diff rows)
  // Params:
  //   matchScore - the match score object to build from
  //
  buildMatchDataSubstring = function (matchScore) {
    let cellString = "";
    cellString += "<td class='table-danger'>" + matchScore.totalPoints + "</td>";
    cellString += "<td class='table-success'>" + matchScore.autonPoints + "</td>";
    cellString += "<td class='table-primary'>" + matchScore.teleopPoints + "</td>";
    cellString += "<td class='table-light'>" + matchScore.foulPoints + "</td>";
    cellString += "<td class='table-danger'>" + matchScore.autonLeave + "</td>";
    cellString += "<td class='table-danger'>" + matchScore.autonCoralL4 + "</td>";
    cellString += "<td class='table-danger'>" + matchScore.autonCoralL3 + "</td>";
    cellString += "<td class='table-danger'>" + matchScore.autonCoralL2 + "</td>";
    cellString += "<td class='table-danger'>" + matchScore.autonCoralL1 + "</td>";
    cellString += "<td class='table-primary'>" + matchScore.teleopCoralL4 + "</td>";
    cellString += "<td class='table-primary'>" + matchScore.teleopCoralL3 + "</td>";
    cellString += "<td class='table-primary'>" + matchScore.teleopCoralL2 + "</td>";
    cellString += "<td class='table-primary'>" + matchScore.teleopCoralL1 + "</td>";
    cellString += "<td class='table-primary'>" + matchScore.allNet + "</td>";
    cellString += "<td class='table-primary'>" + matchScore.allProc + "</td>";
    cellString += "<td class='table-warning'>" + matchScore.endgameCageClimb[0] + "</td>";
    cellString += "<td class='table-warning'>" + matchScore.endgameCageClimb[1] + "</td>";
    cellString += "<td class='table-warning'>" + matchScore.endgameCageClimb[2] + "</td>";
    cellString += "<td class='table-light'>" + matchScore.fouls + "</td>";

    return cellString;
  }

  //
  // Decode TBA score breakdown into match score object
  // Params:
  //   tbaBreakdown - the TBA score breakdown object for a match
  //   alliance     - "red" or "blue" alliance to decode
  //
  function decodeTBABreakdown(tbaBreakdown, alliance) {
    let tbaScore = resetMatchScore();

    tbaScore.totalPoints = tbaBreakdown[alliance]["totalPoints"];
    tbaScore.autonPoints = tbaBreakdown[alliance]["autoPoints"];
    tbaScore.teleopPoints = tbaBreakdown[alliance]["teleopPoints"];
    tbaScore.foulPoints = tbaBreakdown[alliance]["foulPoints"];

    let redLeaveCount = 0;
    if (tbaBreakdown[alliance]["autoLineRobot1"] === "Yes") redLeaveCount++;
    if (tbaBreakdown[alliance]["autoLineRobot2"] === "Yes") redLeaveCount++;
    if (tbaBreakdown[alliance]["autoLineRobot3"] === "Yes") redLeaveCount++;

    tbaScore.autonLeave = redLeaveCount;
    tbaScore.autonCoralL4 = tbaBreakdown[alliance]["autoReef"]["tba_topRowCount"];
    tbaScore.autonCoralL3 = tbaBreakdown[alliance]["autoReef"]["tba_midRowCount"];
    tbaScore.autonCoralL2 = tbaBreakdown[alliance]["autoReef"]["tba_botRowCount"];
    tbaScore.autonCoralL1 = tbaBreakdown[alliance]["autoReef"]["trough"];
    tbaScore.teleopCoralL4 = tbaBreakdown[alliance]["teleopReef"]["tba_topRowCount"] - tbaBreakdown[alliance]["autoReef"]["tba_topRowCount"];
    tbaScore.teleopCoralL3 = tbaBreakdown[alliance]["teleopReef"]["tba_midRowCount"] - tbaBreakdown[alliance]["autoReef"]["tba_midRowCount"];
    tbaScore.teleopCoralL2 = tbaBreakdown[alliance]["teleopReef"]["tba_botRowCount"] - tbaBreakdown[alliance]["autoReef"]["tba_botRowCount"];
    tbaScore.teleopCoralL1 = tbaBreakdown[alliance]["teleopReef"]["trough"] - tbaBreakdown[alliance]["autoReef"]["trough"];
    tbaScore.allNet = tbaBreakdown[alliance]["netAlgaeCount"];
    tbaScore.allProc = tbaBreakdown[alliance]["wallAlgaeCount"];
    tbaScore.endgameCageClimb[0] = tbaBreakdown[alliance]["endGameRobot1"];
    tbaScore.endgameCageClimb[1] = tbaBreakdown[alliance]["endGameRobot2"];
    tbaScore.endgameCageClimb[2] = tbaBreakdown[alliance]["endGameRobot3"];
    tbaScore.fouls = tbaBreakdown[alliance]["foulCount"];

    return tbaScore;
  }

  //
  // Accumulate our match data into match score object
  // Params:
  //   matchData  - our match data for a team in a match
  //   matchScore - the match score object to accumulate into
  //   leaveCount - which robot (0,1,2) is this for leave tracking
  //
  function accumulateMatchScore(matchData, matchScore, leaveCount) {
    matchScore.autonLeave += parseInt(matchData["autonLeave"]);
    matchScore.autonCoralL4 += parseInt(matchData["autonCoralL4"]);
    matchScore.autonCoralL3 += parseInt(matchData["autonCoralL3"]);
    matchScore.autonCoralL2 += parseInt(matchData["autonCoralL2"]);
    matchScore.autonCoralL1 += parseInt(matchData["autonCoralL1"]);
    matchScore.teleopCoralL4 += parseInt(matchData["teleopCoralL4"]);
    matchScore.teleopCoralL3 += parseInt(matchData["teleopCoralL3"]);
    matchScore.teleopCoralL2 += parseInt(matchData["teleopCoralL2"]);
    matchScore.teleopCoralL1 += parseInt(matchData["teleopCoralL1"]);
    matchScore.allNet += parseInt(matchData["autonAlgaeNet"]) + parseInt(matchData["teleopAlgaeNet"]);
    matchScore.allProc += parseInt(matchData["autonAlgaeProc"]) + parseInt(matchData["teleopAlgaeProc"]);
    matchScore.endgameCageClimb[leaveCount] = matchData["endgameCageClimb"];
    // matchScore.fouls += parseInt(matchData["fouls"]); // We don't track fouls

    let autonPoints =
      parseInt(matchData["autonLeave"] * 3) +
      parseInt(matchData["autonCoralL4"] * 7) +
      parseInt(matchData["autonCoralL3"] * 6) +
      parseInt(matchData["autonCoralL2"] * 4) +
      parseInt(matchData["autonCoralL1"] * 3);
    let teleopPoints =
      parseInt(matchData["teleopCoralL4"] * 5) +
      parseInt(matchData["teleopCoralL3"] * 4) +
      parseInt(matchData["teleopCoralL2"] * 3) +
      parseInt(matchData["teleopCoralL1"] * 2) +
      parseInt(matchData["autonAlgaeNet"]) * 4 +
      parseInt(matchData["teleopAlgaeNet"]) * 4 +
      parseInt(matchData["autonAlgaeProc"]) * 6 +
      parseInt(matchData["teleopAlgaeProc"]) * 6 +
      (parseInt(matchData["endgameCageClimb"]) === 0 ? 0 :
        parseInt(matchData["endgameCageClimb"]) === 1 ? 2 :
          parseInt(matchData["endgameCageClimb"]) === 2 ? 2 :
            parseInt(matchData["endgameCageClimb"]) === 3 ? 6 :
              parseInt(matchData["endgameCageClimb"]) === 4 ? 12 : 0);
    let foulPoints = 0 * 2; // We don't track fouls

    matchScore.autonPoints += autonPoints;
    matchScore.teleopPoints += teleopPoints;
    matchScore.foulPoints += foulPoints;
    matchScore.totalPoints += autonPoints + teleopPoints + foulPoints;

    return matchScore;
  }

  //
  // These utilities convert TBA climb values to our match data values for comparison
  //
  function stringToClimbValue(climbString) {
    let value = 0;
    switch (climbString) {
      default:
      case "None": break;
      case "Parked": value = 1; break;
      case "ShallowCage": value = 3; break;
      case "DeepCage": value = 4; break;
    }
    return value;
  }

  function matchToClimbValue(matchValue) {
    if (matchValue === 2) // Fell setting is same as park for scoring
      matchValue = 1;
    return matchValue;
  }

  //
  // Build the diff row between TBA and our match data
  // Params:
  //   tbaScoreRed    - the TBA score object for red alliance
  //   tbaScoreBlue   - the TBA score object for blue alliance
  //   matchScoreRed  - our match score object for red alliance
  //   matchScoreBlue - our match score object for blue alliance
  //
  function buildDiffDataRow(tbaScoreRed, tbaScoreBlue, matchScoreRed, matchScoreBlue) {
    let diffRowString = "";

    // Red alliance diff
    diffRowString += "<td class='table-danger'>" + (matchScoreRed.totalPoints - tbaScoreRed.totalPoints) + "</td>";
    diffRowString += "<td class='table-success'>" + (matchScoreRed.autonPoints - tbaScoreRed.autonPoints) + "</td>";
    diffRowString += "<td class='table-primary'>" + (matchScoreRed.teleopPoints - tbaScoreRed.teleopPoints) + "</td>";
    diffRowString += "<td class='table-light'>" + (matchScoreRed.foulPoints - tbaScoreRed.foulPoints) + "</td>";
    diffRowString += "<td class='table-danger'>" + (matchScoreRed.autonLeave - tbaScoreRed.autonLeave) + "</td>";
    diffRowString += "<td class='table-danger'>" + (matchScoreRed.autonCoralL4 - tbaScoreRed.autonCoralL4) + "</td>";
    diffRowString += "<td class='table-danger'>" + (matchScoreRed.autonCoralL3 - tbaScoreRed.autonCoralL3) + "</td>";
    diffRowString += "<td class='table-danger'>" + (matchScoreRed.autonCoralL2 - tbaScoreRed.autonCoralL2) + "</td>";
    diffRowString += "<td class='table-danger'>" + (matchScoreRed.autonCoralL1 - tbaScoreRed.autonCoralL1) + "</td>";
    diffRowString += "<td class='table-primary'>" + (matchScoreRed.teleopCoralL4 - tbaScoreRed.teleopCoralL4) + "</td>";
    diffRowString += "<td class='table-primary'>" + (matchScoreRed.teleopCoralL3 - tbaScoreRed.teleopCoralL3) + "</td>";
    diffRowString += "<td class='table-primary'>" + (matchScoreRed.teleopCoralL2 - tbaScoreRed.teleopCoralL2) + "</td>";
    diffRowString += "<td class='table-primary'>" + (matchScoreRed.teleopCoralL1 - tbaScoreRed.teleopCoralL1) + "</td>";
    diffRowString += "<td class='table-primary'>" + (matchScoreRed.allNet - tbaScoreRed.allNet) + "</td>";
    diffRowString += "<td class='table-primary'>" + (matchScoreRed.allProc - tbaScoreRed.allProc) + "</td>";
    diffRowString += "<td class='table-warning'>" + (matchToClimbValue(matchScoreRed.endgameCageClimb[0]) - stringToClimbValue(tbaScoreRed.endgameCageClimb[0])) + "</td>";
    diffRowString += "<td class='table-warning'>" + (matchToClimbValue(matchScoreRed.endgameCageClimb[1]) - stringToClimbValue(tbaScoreRed.endgameCageClimb[1])) + "</td>";
    diffRowString += "<td class='table-warning'>" + (matchToClimbValue(matchScoreRed.endgameCageClimb[2]) - stringToClimbValue(tbaScoreRed.endgameCageClimb[2])) + "</td>";
    diffRowString += "<td class='table-light'>" + (matchScoreRed.fouls - tbaScoreRed.fouls) + "</td>";

    // Blue alliance diff
    diffRowString += "<td class='table-danger'>" + (matchScoreBlue.totalPoints - tbaScoreBlue.totalPoints) + "</td>";
    diffRowString += "<td class='table-success'>" + (matchScoreBlue.autonPoints - tbaScoreBlue.autonPoints) + "</td>";
    diffRowString += "<td class='table-primary'>" + (matchScoreBlue.teleopPoints - tbaScoreBlue.teleopPoints) + "</td>";
    diffRowString += "<td class='table-light'>" + (matchScoreBlue.foulPoints - tbaScoreBlue.foulPoints) + "</td>";
    diffRowString += "<td class='table-danger'>" + (matchScoreBlue.autonLeave - tbaScoreBlue.autonLeave) + "</td>";
    diffRowString += "<td class='table-danger'>" + (matchScoreBlue.autonCoralL4 - tbaScoreBlue.autonCoralL4) + "</td>";
    diffRowString += "<td class='table-danger'>" + (matchScoreBlue.autonCoralL3 - tbaScoreBlue.autonCoralL3) + "</td>";
    diffRowString += "<td class='table-danger'>" + (matchScoreBlue.autonCoralL2 - tbaScoreBlue.autonCoralL2) + "</td>";
    diffRowString += "<td class='table-danger'>" + (matchScoreBlue.autonCoralL1 - tbaScoreBlue.autonCoralL1) + "</td>";
    diffRowString += "<td class='table-primary'>" + (matchScoreBlue.teleopCoralL4 - tbaScoreBlue.teleopCoralL4) + "</td>";
    diffRowString += "<td class='table-primary'>" + (matchScoreBlue.teleopCoralL3 - tbaScoreBlue.teleopCoralL3) + "</td>";
    diffRowString += "<td class='table-primary'>" + (matchScoreBlue.teleopCoralL2 - tbaScoreBlue.teleopCoralL2) + "</td>";
    diffRowString += "<td class='table-primary'>" + (matchScoreBlue.teleopCoralL1 - tbaScoreBlue.teleopCoralL1) + "</td>";
    diffRowString += "<td class='table-primary'>" + (matchScoreBlue.allNet - tbaScoreBlue.allNet) + "</td>";
    diffRowString += "<td class='table-primary'>" + (matchScoreBlue.allProc - tbaScoreBlue.allProc) + "</td>";
    diffRowString += "<td class='table-warning'>" + (matchScoreBlue.endgameCageClimb[0] - stringToClimbValue(tbaScoreBlue.endgameCageClimb[0])) + "</td>";
    diffRowString += "<td class='table-warning'>" + (matchScoreBlue.endgameCageClimb[1] - stringToClimbValue(tbaScoreBlue.endgameCageClimb[1])) + "</td>";
    diffRowString += "<td class='table-warning'>" + (matchScoreBlue.endgameCageClimb[2] - stringToClimbValue(tbaScoreBlue.endgameCageClimb[2])) + "</td>";
    diffRowString += "<td class='table-light'>" + (matchScoreBlue.fouls - tbaScoreBlue.fouls) + "</td>";

    return diffRowString;
  }

  //  Insert a match check table body (all rows)
  //    Params
  //      tableId     - the HTML ID where the table body is inserted
  //      eventMatches - the event matches from TBA API
  //      allMatchData - all match data from our database
  //
  function insertMatchCheckBody(tableId, eventMatches, allMatchData) {
    console.log("==> insertMatchCheckBody: tableId " + tableId);

    let tbodyRef = document.getElementById(tableId).querySelector('tbody');
    for (let emi in eventMatches) {
      let match = eventMatches[emi];
      if (match["comp_level"] !== "qm") {// Limit to qual matches for now
        continue;
      }
      let matchNum = match["match_number"];
      if (match["comp_level"] === "sf") {
        matchNum = match["set_number"];
      }
      let matchId = match["comp_level"] + matchNum;
      let alliances = match["alliances"];
      let matchDataCount = 0;

      let matchScoreRed = resetMatchScore();
      let matchScoreBlue = resetMatchScore();
      let redClimbCount = 0;
      let blueClimbCount = 0;

      // Red teams in this match
      for (team in alliances["red"]["team_keys"]) {
        for (let ami in allMatchData) {
          if ((allMatchData[ami]["matchnumber"] === matchId) && allMatchData[ami]["teamnumber"] === alliances["red"]["team_keys"][team].substring(3)) {
            matchScoreRed = accumulateMatchScore(allMatchData[ami], matchScoreRed, redClimbCount);
            redClimbCount++;
            matchDataCount++;
            break;
          }
        }
      }

      // Blue teams in this match
      for (team in alliances["blue"]["team_keys"]) {
        for (let ami in allMatchData) {
          if ((allMatchData[ami]["matchnumber"] === matchId) && allMatchData[ami]["teamnumber"] === alliances["blue"]["team_keys"][team].substring(3)) {
            matchScoreBlue = accumulateMatchScore(allMatchData[ami], matchScoreBlue, blueClimbCount);
            blueClimbCount++;
            matchDataCount++;
            break;
          }
        }
      }

      // build the matchRowStrings for TBA score
      let tbaRowString = "";
      tbaRowString += "<td class='fw-bold'>" + matchId + "</td>";
      tbaRowString += "<td class='bg-body'>TBA</td>";
      let tbaBreakdown = match["score_breakdown"];
      let tbaScoreRed = decodeTBABreakdown(tbaBreakdown, "red");
      let tbaScoreBlue = decodeTBABreakdown(tbaBreakdown, "blue");
      tbaRowString += buildMatchDataSubstring(tbaScoreRed);;
      tbaRowString += buildMatchDataSubstring(tbaScoreBlue);
      tbodyRef.insertRow().innerHTML = tbaRowString;

      // build the matchRowStrings for our recorded score
      let matchRowString = "";
      matchRowString += "<td class='fw-bold'>" + matchId + "</td>";
      matchRowString += "<td class='bg-body'>" + matchDataCount + "</td>";
      matchRowString += buildMatchDataSubstring(matchScoreRed);;
      matchRowString += buildMatchDataSubstring(matchScoreBlue);
      tbodyRef.insertRow().innerHTML = matchRowString;

      // build the diff row
      let diffRowString = "";
      diffRowString += "<td class='fw-bold table-primary'>" + matchId + "</td>";
      diffRowString += "<td class='table-primary'>Diff</td>";
      diffRowString += buildDiffDataRow(tbaScoreRed, tbaScoreBlue, matchScoreRed, matchScoreBlue);
      tbodyRef.insertRow().innerHTML = diffRowString;
    }

    let matchCol = 0;
    sortTableByMatch(tableId, matchCol);
  }

  //
  // Load the table with the match status values
  //
  function loadMatchCheckTable(tableId, eventMatches, allMatchData) {
    console.log("==> matchCheck: loadMatchCheckTable()");

    if ((eventMatches === null) || (allMatchData === null))
      return;

    console.log("=> loadMatchCheckTable");
    insertMatchCheckHeader(tableId);
    insertMatchCheckBody(tableId, eventMatches, allMatchData);
    document.getElementById(tableId).click(); // This magic fixes the floating column bug
    document.getElementById('spinner').style.display = 'none';
  }

  //
  // Load match data and event matches
  //
  function buildMatchCheckTable(tableId) {
    console.log("==> matchCheck: buildMatchCheckTable()");
    let jEventMatches = null;
    let jAllMatchData = null;

    $.get("api/tbaAPI.php", {
      getEventMatches: true
    }).done(function (eventMatches) {
      console.log("=> getEventMatches");
      jEventMatches = JSON.parse(eventMatches)["response"];
      loadMatchCheckTable(tableId, jEventMatches, jAllMatchData);
    });

    $.get("api/dbReadAPI.php", {
      getAllMatchData: true
    }).done(function (matchData) {
      console.log("=> getAllMatchData");
      jAllMatchData = JSON.parse(matchData);
      loadMatchCheckTable(tableId, jEventMatches, jAllMatchData);
    });

  }

  /////////////////////////////////////////////////////////////////////////////
  //
  // Process the generated html
  //    Get event matches from TBA
  //    Get all match data from our database
  //    When completed, display the web page
  //
  document.addEventListener("DOMContentLoaded", function () {

    const tableId = "matchCheckTable";
    const frozenTable = new FreezeTable('.freeze-table', { fixedNavbar: '.navbar' });

    buildMatchCheckTable(tableId);

    // Write out picklist CSV file to client's download dir.
    document.getElementById("downloadCsvFile").addEventListener('click', function () {
      const csvFileName = frcEventCode + "_matchCheck";
      downloadTableAsCSV(tableId, csvFileName);
    });

    // Create frozen table panes and keep the panes updated
    document.getElementById(tableId).addEventListener('click', function () {
      if (frozenTable) {
        frozenTable.update();
      }
    });
  });

</script>

<script src="./scripts/compareMatchNumbers.js"></script>
<script src="./scripts/compareTeamNumbers.js"></script>
<script src="./scripts/matchDataTable.js"></script>
<script src="./scripts/matchDataProcessor.js"></script>
<script src="./scripts/sortFrcTables.js"></script>
