/*
  Global Variable Definition
*/

/*
  Function Definition
*/

//
//  Provide event averages table utilities that:
//    1) insert a header row for a event averages table
//    2) insert a body row for event averages table
//

//
//  Insert a strategic data table header (all rows)
//    Params
//      tableId     - the HTML ID where the table header is inserted
//      aliasList   - list of aliases at the event
//
function insertEventAveragesHeader(tableId, aliasList) {
  console.log("==> insertEventAveragesHeader: tableId " + tableId + " aliases " + aliasList.length);

  let theadRef = document.getElementById(tableId).querySelector('thead');;
  theadRef.innerHTML = ""; // Clear Table

  let rowString1 = '';
  rowString1 += '<th scope="col" style="background-color:transparent"> </th>';
  // Insert column if the aliasList is not empty
  if (aliasList.length > 0) {
    rowString1 += '<th scope="col" style="background-color:transparent"> </th>';
  }
  rowString1 += '<th scope="col" style="background-color:transparent"> </th>';

  // points by game phase
  rowString1 += '<th colspan="8" style="background-color:#83b4ff">Match Points</th>';
  rowString1 += '<th colspan="4" style="background-color:#d5e6de">Auton Pts</th>';
  rowString1 += '<th colspan="4" style="background-color:#d6f3fB">Teleop Pts</th>';
  rowString1 += '<th colspan="4" style="background-color:#83b4ff">Game pieces</th>';
  rowString1 += '<th colspan="10" style="background-color:#d5e6de">Auton Coral</th>';
  rowString1 += '<th colspan="6" style="background-color:#d5e6de">Auton Algae</th>';
  rowString1 += '<th colspan="11" style="background-color:#d6f3fB">Teleop Coral</th>';
  rowString1 += '<th colspan="7" style="background-color:#d6f3fB">Teleop Algae</th>';
  rowString1 += '<th colspan="1" style="background-color:#d6f3fB">Def</th>';
  rowString1 += '<th colspan="9" style="background-color:#fbe6d3">Endgame</th>';
  rowString1 += '<th colspan="1" style="background-color:transparent"></th>';

  theadRef.insertRow().innerHTML = rowString1;

  let rowString2 = '';
  // team number
  rowString2 += '<th scope="col" style="background-color:transparent" class="sorttable_numeric"> </th>';
  // Insert column if the aliasList is not empty
  if (aliasList.length > 0) {
    rowString2 += '<th scope="col" style="background-color:transparent"> </th>';
  }
  rowString2 += '<th scope="col" style="background-color:transparent"> </th>';

  // points by game phase
  rowString2 += '<th colspan="2" style="background-color:#83b4ff">Total Pts</th>';
  rowString2 += '<th colspan="2" style="background-color:#d5e6de">Auton Pts</th>';
  rowString2 += '<th colspan="2" style="background-color:#d6f3fB">Teleop Pts</th>';
  rowString2 += '<th colspan="2" style="background-color:#fbe6d3">Endgame Pts</th>';

  // points by game piece
  rowString2 += '<th colspan="2" style="background-color:#d5e6de">Coral Pts</th>';
  rowString2 += '<th colspan="2" style="background-color:transparent">Algae Pts</th>';
  rowString2 += '<th colspan="2" style="background-color:#d6f3fB">Coral Pts</th>';
  rowString2 += '<th colspan="2" style="background-color:transparent">Algae Pts</th>';

  rowString2 += '<th colspan="2" style="background-color:#83b4ff">Total Coral</th>';
  rowString2 += '<th colspan="2" style="background-color:transparent">Total Algae</th>';

  // auton coral
  rowString2 += '<th colspan="2" style="background-color:#d5e6de">Auton Coral</th>';
  rowString2 += '<th colspan="2" style="background-color:transparent">L4</th>';
  rowString2 += '<th colspan="2" style="background-color:#d5e6de">L3</th>';
  rowString2 += '<th colspan="2" style="background-color:transparent">L2</th>';
  rowString2 += '<th colspan="2" style="background-color:#d5e6de">L1</th>';

  // auton algae
  rowString2 += '<th colspan="2" style="background-color:transparent">Total Algae</th>';
  rowString2 += '<th colspan="2" style="background-color:#d5e6de">Proc</th>';
  rowString2 += '<th colspan="2" style="background-color:transparent">Net</th>';

  // teleop coral
  rowString2 += '<th colspan="3" style="background-color:#d6f3fB">Teleop Coral</th>';
  rowString2 += '<th colspan="2" style="background-color:transparent">L4</th>';
  rowString2 += '<th colspan="2" style="background-color:#d6f3fB">L3</th>';
  rowString2 += '<th colspan="2" style="background-color:transparent">L2</th>';
  rowString2 += '<th colspan="2" style="background-color:#d6f3fB">L1</th>';

  // teleop algae
  rowString2 += '<th colspan="3" style="background-color:transparent">Teleop Algae</th>';
  rowString2 += '<th colspan="2" style="background-color:#d6f3fB">Proc</th>';
  rowString2 += '<th colspan="2" style="background-color:transparent">Net</th>';

  // defense 
  rowString2 += '<th colspan="1" style="background-color:#d6f3fB"></th>';

  // endgame 
  rowString2 += '<th colspan="4" style="background-color:transparent">Start Climb%</th>';
  rowString2 += '<th colspan="5" style="background-color:#fbe6d3">Climb%</th>';

  // died 
  rowString2 += '<th colspan="1" style="background-color:transparent">Died</th>';

  theadRef.insertRow().innerHTML = rowString2;

  let rowString3 = '';
  const tdPrefix0 = '<th scope="col" class="sorttable_numeric" style="background-color:transparent">';
  const tdPrefix1 = '<th scope="col" class="sorttable_numeric" style="background-color:#cfe2ff">';
  // team number
  rowString3 += tdPrefix0 + 'Team</th>';
  if (aliasList.length > 0) {
    rowString3 += tdPrefix0 + 'Alias</th>';
  }
  rowString3 += tdPrefix0 + 'COPRs</th>';

  // points by game phase
  rowString3 += tdPrefix1 + 'Avg</th>';
  rowString3 += tdPrefix1 + 'Max</th>';
  rowString3 += tdPrefix0 + 'Avg</th>';
  rowString3 += tdPrefix0 + 'Max</th>';
  rowString3 += tdPrefix1 + 'Avg</th>';
  rowString3 += tdPrefix1 + 'Max</th>';
  rowString3 += tdPrefix0 + 'Avg</th>';
  rowString3 += tdPrefix0 + 'Max</th>';

  // points by game piece
  rowString3 += tdPrefix1 + 'Avg</th>';
  rowString3 += tdPrefix1 + 'Max</th>';
  rowString3 += tdPrefix0 + 'Avg</th>';
  rowString3 += tdPrefix0 + 'Max</th>';
  rowString3 += tdPrefix1 + 'Avg</th>';
  rowString3 += tdPrefix1 + 'Max</th>';
  rowString3 += tdPrefix0 + 'Avg</th>';
  rowString3 += tdPrefix0 + 'Max</th>';

  // total game pieces
  rowString3 += tdPrefix1 + 'Avg</th>';
  rowString3 += tdPrefix1 + 'Max</th>';
  rowString3 += tdPrefix0 + 'Avg</th>';
  rowString3 += tdPrefix0 + 'Max</th>';

  // auton coral
  rowString3 += tdPrefix1 + 'Avg</th>';
  rowString3 += tdPrefix1 + 'Max</th>';
  rowString3 += tdPrefix0 + 'Avg</th>';
  rowString3 += tdPrefix0 + 'Max</th>';
  rowString3 += tdPrefix1 + 'Avg</th>';
  rowString3 += tdPrefix1 + 'Max</th>';
  rowString3 += tdPrefix0 + 'Avg</th>';
  rowString3 += tdPrefix0 + 'Max</th>';
  rowString3 += tdPrefix1 + 'Avg</th>';
  rowString3 += tdPrefix1 + 'Max</th>';

  // auton algae
  rowString3 += tdPrefix0 + 'Avg</th>';
  rowString3 += tdPrefix0 + 'Max</th>';
  rowString3 += tdPrefix1 + 'Avg</th>';
  rowString3 += tdPrefix1 + 'Max</th>';
  rowString3 += tdPrefix0 + 'Avg</th>';
  rowString3 += tdPrefix0 + 'Max</th>';

  // teleop coral
  rowString3 += tdPrefix1 + 'Acc%</th>';
  rowString3 += tdPrefix1 + 'Avg</th>';
  rowString3 += tdPrefix1 + 'Max</th>';
  rowString3 += tdPrefix0 + 'Avg</th>';
  rowString3 += tdPrefix0 + 'Max</th>';
  rowString3 += tdPrefix1 + 'Avg</th>';
  rowString3 += tdPrefix1 + 'Max</th>';
  rowString3 += tdPrefix0 + 'Avg</th>';
  rowString3 += tdPrefix0 + 'Max</th>';
  rowString3 += tdPrefix1 + 'Avg</th>';
  rowString3 += tdPrefix1 + 'Max</th>';

  // telop algae
  rowString3 += tdPrefix0 + 'Acc%</th>';
  rowString3 += tdPrefix0 + 'Avg</th>';
  rowString3 += tdPrefix0 + 'Max</th>';
  rowString3 += tdPrefix1 + 'Avg</th>';
  rowString3 += tdPrefix1 + 'Max</th>';
  rowString3 += tdPrefix0 + 'Avg</th>';
  rowString3 += tdPrefix0 + 'Max</th>';

  // defense 
  rowString3 += tdPrefix1 + 'Avg</th>';

  // endgame(start climb)
  rowString3 += tdPrefix0 + 'N</th>';
  rowString3 += tdPrefix0 + 'B</th>';
  rowString3 += tdPrefix0 + 'A</th>';
  rowString3 += tdPrefix0 + 'L</th>';

  // endgame(climb)
  rowString3 += tdPrefix0 + 'N</th>';
  rowString3 += tdPrefix0 + 'P</th>';
  rowString3 += tdPrefix0 + 'F</th>';
  rowString3 += tdPrefix0 + 'S</th>';
  rowString3 += tdPrefix0 + 'D</th>';

  // died 
  rowString3 += tdPrefix0 + '#</th>';

  theadRef.insertRow().innerHTML = rowString3;
};

// Add a team (key) to the final team list
function getTeamListFromData(matchData) {
  console.log("==> eventAverages: getTeamListFromData()");
  let keyList = [];
  for (let teamNum in matchData) {
    keyList.push(teamNum);
  }
  return keyList;
}

// Lookup value for a key in the passed dictionary - team in match data
function getDataValue(dict, key) {
  if (!dict) {
    console.warn("getDataValue: Dictionary not found! " + dict);
  }
  else if (key in dict) {
    return dict[key];
  }
  else {
    console.warn("getDataValue: Key not found in dictionary! " + key + " " + dict);
  }
  return "";
}

//
//  Insert a strategic data table body (all rows)
//    Params
//      tableId       - the HTML ID where the table header is inserted
//      eventAverages - the list of available stategic matches to include in this table
//      aliasList     - list of aliases at the event (length 0 if none)
//      teamFilter    - list of teams to include in table (length 0 if all)
//
function insertEventAveragesBody(tableId, eventAverages, coprData, aliasList, teamFilter) {
  console.log("==> insertEventAveragesBody: tableId " + tableId + " eventAverages " + Object.keys(eventAverages).length + " aliases " + aliasList.length + " teams " + teamFilter.length);

  let tbodyRef = document.getElementById(tableId).querySelector('tbody');;
  tbodyRef.innerHTML = ""; // Clear Table

  let teamList = getTeamListFromData(eventAverages);

  // Go thru each strategic and build the HTML string for that row.
  for (let teamNum of teamList) {
    let avgItem = eventAverages[teamNum];
    if (teamFilter.length !== 0 && !teamFilter.includes(teamNum))
      continue;

    const tdPrefix0 = '<td style="background-color:transparent">';
    const tdPrefix1 = '<td style="background-color:#cfe2ff">';
    let rowString = "";
    rowString += tdPrefix0 + "<a href='teamLookup.php?teamNum=" + teamNum + "'>" + teamNum + "</td>";
    // Insert column if the aliasList is not empty
    if (aliasList.length > 0) {
      rowString += tdPrefix0 + getAliasFromTeamNum(teamNum, aliasList) + "</td>";
    }
    let coprEntry = (coprData.length !== 0) ? getDataValue(coprData[teamNum], "totalPoints") : "";  // TODO: Load COPR data from TBA and pass in here
    rowString += tdPrefix0 + coprEntry + "</td>";

    // points by game phase
    rowString += tdPrefix1 + getDataValue(avgItem, "totalPointsAvg") + "</td>";
    rowString += tdPrefix1 + getDataValue(avgItem, "totalPointsMax") + "</td>";
    rowString += tdPrefix0 + getDataValue(avgItem, "autonPointsAvg") + "</td>";
    rowString += tdPrefix0 + getDataValue(avgItem, "autonPointsMax") + "</td>";
    rowString += tdPrefix1 + getDataValue(avgItem, "teleopPointsAvg") + "</td>";
    rowString += tdPrefix1 + getDataValue(avgItem, "teleopPointsMax") + "</td>";
    rowString += tdPrefix0 + getDataValue(avgItem, "endgamePointsAvg") + "</td>";
    rowString += tdPrefix0 + getDataValue(avgItem, "endgamePointsMax") + "</td>";

    // points by game piece
    rowString += tdPrefix1 + getDataValue(avgItem, "autonCoralPointsAvg") + "</td>";
    rowString += tdPrefix1 + getDataValue(avgItem, "autonCoralPointsMax") + "</td>";
    rowString += tdPrefix0 + getDataValue(avgItem, "autonAlgaePointsAvg") + "</td>";
    rowString += tdPrefix0 + getDataValue(avgItem, "autonAlgaePointsMax") + "</td>";
    rowString += tdPrefix1 + getDataValue(avgItem, "teleopCoralPointsAvg") + "</td>";
    rowString += tdPrefix1 + getDataValue(avgItem, "teleopCoralPointsMax") + "</td>";
    rowString += tdPrefix0 + getDataValue(avgItem, "teleopAlgaePointsAvg") + "</td>";
    rowString += tdPrefix0 + getDataValue(avgItem, "teleopAlgaePointsMax") + "</td>";

    // total game pieces
    rowString += tdPrefix1 + getDataValue(avgItem, "totalCoralScoredAvg") + "</td>";
    rowString += tdPrefix1 + getDataValue(avgItem, "totalCoralScoredMax") + "</td>";
    rowString += tdPrefix0 + getDataValue(avgItem, "totalAlgaeScoredAvg") + "</td>";
    rowString += tdPrefix0 + getDataValue(avgItem, "totalAlgaeScoredMax") + "</td>";

    // auton coral
    rowString += tdPrefix1 + getDataValue(avgItem, "autonCoralScoredAvg") + "</td>";
    rowString += tdPrefix1 + getDataValue(avgItem, "autonCoralScoredMax") + "</td>";
    rowString += tdPrefix0 + getDataValue(avgItem, "autonCoralL4Avg") + "</td>";
    rowString += tdPrefix0 + getDataValue(avgItem, "autonCoralL4Max") + "</td>";
    rowString += tdPrefix1 + getDataValue(avgItem, "autonCoralL3Avg") + "</td>";
    rowString += tdPrefix1 + getDataValue(avgItem, "autonCoralL3Max") + "</td>";
    rowString += tdPrefix0 + getDataValue(avgItem, "autonCoralL2Avg") + "</td>";
    rowString += tdPrefix0 + getDataValue(avgItem, "autonCoralL2Max") + "</td>";
    rowString += tdPrefix1 + getDataValue(avgItem, "autonCoralL1Avg") + "</td>";
    rowString += tdPrefix1 + getDataValue(avgItem, "autonCoralL1Max") + "</td>";

    // auton algae
    rowString += tdPrefix0 + getDataValue(avgItem, "autonAlgaeScoredAvg") + "</td>";
    rowString += tdPrefix0 + getDataValue(avgItem, "autonAlgaeScoredMax") + "</td>";
    rowString += tdPrefix1 + getDataValue(avgItem, "autonAlgaeProcAvg") + "</td>";
    rowString += tdPrefix1 + getDataValue(avgItem, "autonAlgaeProcMax") + "</td>";
    rowString += tdPrefix0 + getDataValue(avgItem, "autonAlgaeNetAvg") + "</td>";
    rowString += tdPrefix0 + getDataValue(avgItem, "autonAlgaeNetMax") + "</td>";

    // teleop coral
    rowString += tdPrefix1 + getDataValue(avgItem, "teleopCoralPercent") + "</td>";
    rowString += tdPrefix1 + getDataValue(avgItem, "teleopCoralScoredAvg") + "</td>";
    rowString += tdPrefix1 + getDataValue(avgItem, "teleopCoralScoredMax") + "</td>";
    rowString += tdPrefix0 + getDataValue(avgItem, "teleopCoralL4Avg") + "</td>";
    rowString += tdPrefix0 + getDataValue(avgItem, "teleopCoralL4Max") + "</td>";
    rowString += tdPrefix1 + getDataValue(avgItem, "teleopCoralL3Avg") + "</td>";
    rowString += tdPrefix1 + getDataValue(avgItem, "teleopCoralL3Max") + "</td>";
    rowString += tdPrefix0 + getDataValue(avgItem, "teleopCoralL2Avg") + "</td>";
    rowString += tdPrefix0 + getDataValue(avgItem, "teleopCoralL2Max") + "</td>";
    rowString += tdPrefix1 + getDataValue(avgItem, "teleopCoralL1Avg") + "</td>";
    rowString += tdPrefix1 + getDataValue(avgItem, "teleopCoralL1Max") + "</td>";

    // teleop algae
    rowString += tdPrefix0 + getDataValue(avgItem, "teleopAlgaePercent") + "</td>";
    rowString += tdPrefix0 + getDataValue(avgItem, "teleopAlgaeScoredAvg") + "</td>";
    rowString += tdPrefix0 + getDataValue(avgItem, "teleopAlgaeScoredMax") + "</td>";
    rowString += tdPrefix1 + getDataValue(avgItem, "teleopAlgaeProcAvg") + "</td>";
    rowString += tdPrefix1 + getDataValue(avgItem, "teleopAlgaeProcMax") + "</td>";
    rowString += tdPrefix0 + getDataValue(avgItem, "teleopAlgaeNetAvg") + "</td>";
    rowString += tdPrefix0 + getDataValue(avgItem, "teleopAlgaeNetMax") + "</td>";

    // defense
    rowString += tdPrefix1 + getDataValue(avgItem, "defenseAvg") + "</td>";

    // endgame
    let endgameClimbStartPercentage = getDataValue(avgItem, "endgameClimbStartPercent");
    rowString += tdPrefix0 + getDataValue(endgameClimbStartPercentage, 0) + "</td>";
    rowString += tdPrefix0 + getDataValue(endgameClimbStartPercentage, 1) + "</td>";
    rowString += tdPrefix0 + getDataValue(endgameClimbStartPercentage, 2) + "</td>";
    rowString += tdPrefix0 + getDataValue(endgameClimbStartPercentage, 3) + "</td>";

    let endgameClimbPercentage = getDataValue(avgItem, "endgameClimbPercent");
    rowString += tdPrefix1 + getDataValue(endgameClimbPercentage, 0) + "</td>";
    rowString += tdPrefix1 + getDataValue(endgameClimbPercentage, 1) + "</td>";
    rowString += tdPrefix1 + getDataValue(endgameClimbPercentage, 2) + "</td>";
    rowString += tdPrefix1 + getDataValue(endgameClimbPercentage, 3) + "</td>";
    rowString += tdPrefix1 + getDataValue(endgameClimbPercentage, 4) + "</td>";

    rowString += tdPrefix0 + getDataValue(avgItem, "totaldied") + "</td>";

    tbodyRef.insertRow().innerHTML = rowString;
  }

  sorttable.makeSortable(document.getElementById(tableId));

  const teamColumn = 0;
  sortTableByTeam(tableId, teamColumn);
};
