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
const thBody = 'class="bg-body"';
const thBodySort = 'class="bg-body sorttable_numeric"';
const thBlueSort = 'class="bg-primary-subtle sorttable_numeric"';
const thAuto = 'class="bg-success-subtle"';
const thTeleop = 'class="bg-primary-subtle"';
const thEndgame = 'class="bg-warning-subtle"';
const thMatch = 'class="bg-danger-subtle"';

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
  rowString1 += '<th colspan="1 ' + thBody + '> </th>';
  // Insert column if the aliasList is not empty
  if (aliasList.length > 0) {
    rowString1 += '<th colspan="1" ' + thBody + '> </th>';
  }
  rowString1 += '<th colspan="1" ' + thBody + '> </th>';

  // points by game phase
  rowString1 += '<th colspan="8" ' + thMatch + '>Match Points' + '</th>';
  rowString1 += '<th colspan="4" ' + thAuto + '>Auton Pts' + '</th>';
  rowString1 += '<th colspan="4" ' + thTeleop + '>Teleop Pts' + '</th>';
  rowString1 += '<th colspan="4" ' + thMatch + '>Game pieces' + '</th>';
  rowString1 += '<th colspan="10" ' + thAuto + '>Auton Coral' + '</th>';
  rowString1 += '<th colspan="6" ' + thAuto + '>Auton Algae' + '</th>';
  rowString1 += '<th colspan="11" ' + thTeleop + '>Teleop Coral' + '</th>';
  rowString1 += '<th colspan="7" ' + thTeleop + '>Teleop Algae' + '</th>';
  rowString1 += '<th colspan="1" ' + thTeleop + '>Def' + '</th>';
  rowString1 += '<th colspan="9" ' + thEndgame + '>Endgame' + '</th>';
  rowString1 += '<th colspan="1" ' + thMatch + '>' + '</th>';

  theadRef.insertRow().innerHTML = rowString1;

  let rowString2 = '';
  // team number
  rowString2 += '<th colspan="1" ' + thBodySort + '> </th>';
  // Insert column if the aliasList is not empty
  if (aliasList.length > 0) {
    rowString2 += '<th colspan="1" ' + thBody + '> </th>';
  }
  rowString2 += '<th colspan="1" ' + thBody + '> </th>';

  // points by game phase
  rowString2 += '<th colspan="2" ' + thMatch + '>Total Pts' + '</th>';
  rowString2 += '<th colspan="2" ' + thAuto + '>Auton Pts' + '</th>';
  rowString2 += '<th colspan="2" ' + thTeleop + '>Teleop Pts' + '</th>';
  rowString2 += '<th colspan="2" ' + thEndgame + '>Endgame Pts' + '</th>';

  // points by game piece
  rowString2 += '<th colspan="2" ' + thAuto + '>Coral Pts' + '</th>';
  rowString2 += '<th colspan="2" ' + thAuto + '>Algae Pts' + '</th>';
  rowString2 += '<th colspan="2" ' + thTeleop + '>Coral Pts' + '</th>';
  rowString2 += '<th colspan="2" ' + thTeleop + '>Algae Pts' + '</th>';

  rowString2 += '<th colspan="2" ' + thMatch + '>Total Coral' + '</th>';
  rowString2 += '<th colspan="2" ' + thMatch + '>Total Algae' + '</th>';

  // auton coral
  rowString2 += '<th colspan="2" ' + thAuto + '>Auton Coral' + '</th>';
  rowString2 += '<th colspan="2" ' + thAuto + '>L4' + '</th>';
  rowString2 += '<th colspan="2" ' + thAuto + '>L3' + '</th>';
  rowString2 += '<th colspan="2" ' + thAuto + '>L2' + '</th>';
  rowString2 += '<th colspan="2" ' + thAuto + '>L1' + '</th>';

  // auton algae
  rowString2 += '<th colspan="2" ' + thAuto + '>Total Algae' + '</th>';
  rowString2 += '<th colspan="2" ' + thAuto + '>Proc' + '</th>';
  rowString2 += '<th colspan="2" ' + thAuto + '>Net' + '</th>';

  // teleop coral
  rowString2 += '<th colspan="3" ' + thTeleop + '>Teleop Coral' + '</th>';
  rowString2 += '<th colspan="2" ' + thTeleop + '>L4' + '</th>';
  rowString2 += '<th colspan="2" ' + thTeleop + '>L3' + '</th>';
  rowString2 += '<th colspan="2" ' + thTeleop + '>L2' + '</th>';
  rowString2 += '<th colspan="2" ' + thTeleop + '>L1' + '</th>';

  // teleop algae
  rowString2 += '<th colspan="3" ' + thTeleop + '>Teleop Algae' + '</th>';
  rowString2 += '<th colspan="2" ' + thTeleop + '>Proc' + '</th>';
  rowString2 += '<th colspan="2" ' + thTeleop + '>Net' + '</th>';

  // defense 
  rowString2 += '<th colspan="1" ' + thTeleop + '></th>';

  // endgame 
  rowString2 += '<th colspan="4" ' + thEndgame + '>Start Climb%' + '</th>';
  rowString2 += '<th colspan="5" ' + thEndgame + '>Climb%' + '</th>';

  // died 
  rowString2 += '<th colspan="1" ' + thMatch + '>Died' + '</th>';

  theadRef.insertRow().innerHTML = rowString2;

  let rowString3 = '';
  const tdPrefix0 = '<th scope="col" ' + thBodySort + '>';
  const tdPrefix1 = '<th scope="col" ' + thBlueSort + '>';
  // team number
  rowString3 += tdPrefix0 + 'Team' + '</th>';
  if (aliasList.length > 0) {
    rowString3 += tdPrefix0 + 'Alias' + '</th>';
  }
  rowString3 += tdPrefix0 + 'COPRs' + '</th>';

  // points by game phase
  rowString3 += tdPrefix1 + 'Avg' + '</th>';
  rowString3 += tdPrefix1 + 'Max' + '</th>';
  rowString3 += tdPrefix0 + 'Avg' + '</th>';
  rowString3 += tdPrefix0 + 'Max' + '</th>';
  rowString3 += tdPrefix1 + 'Avg' + '</th>';
  rowString3 += tdPrefix1 + 'Max' + '</th>';
  rowString3 += tdPrefix0 + 'Avg' + '</th>';
  rowString3 += tdPrefix0 + 'Max' + '</th>';

  // points by game piece
  rowString3 += tdPrefix1 + 'Avg' + '</th>';
  rowString3 += tdPrefix1 + 'Max' + '</th>';
  rowString3 += tdPrefix0 + 'Avg' + '</th>';
  rowString3 += tdPrefix0 + 'Max' + '</th>';
  rowString3 += tdPrefix1 + 'Avg' + '</th>';
  rowString3 += tdPrefix1 + 'Max' + '</th>';
  rowString3 += tdPrefix0 + 'Avg' + '</th>';
  rowString3 += tdPrefix0 + 'Max' + '</th>';

  // total game pieces
  rowString3 += tdPrefix1 + 'Avg' + '</th>';
  rowString3 += tdPrefix1 + 'Max' + '</th>';
  rowString3 += tdPrefix0 + 'Avg' + '</th>';
  rowString3 += tdPrefix0 + 'Max' + '</th>';

  // auton coral
  rowString3 += tdPrefix1 + 'Avg' + '</th>';
  rowString3 += tdPrefix1 + 'Max' + '</th>';
  rowString3 += tdPrefix0 + 'Avg' + '</th>';
  rowString3 += tdPrefix0 + 'Max' + '</th>';
  rowString3 += tdPrefix1 + 'Avg' + '</th>';
  rowString3 += tdPrefix1 + 'Max' + '</th>';
  rowString3 += tdPrefix0 + 'Avg' + '</th>';
  rowString3 += tdPrefix0 + 'Max' + '</th>';
  rowString3 += tdPrefix1 + 'Avg' + '</th>';
  rowString3 += tdPrefix1 + 'Max' + '</th>';

  // auton algae
  rowString3 += tdPrefix0 + 'Avg' + '</th>';
  rowString3 += tdPrefix0 + 'Max' + '</th>';
  rowString3 += tdPrefix1 + 'Avg' + '</th>';
  rowString3 += tdPrefix1 + 'Max' + '</th>';
  rowString3 += tdPrefix0 + 'Avg' + '</th>';
  rowString3 += tdPrefix0 + 'Max' + '</th>';

  // teleop coral
  rowString3 += tdPrefix1 + 'Acc%' + '</th>';
  rowString3 += tdPrefix1 + 'Avg' + '</th>';
  rowString3 += tdPrefix1 + 'Max' + '</th>';
  rowString3 += tdPrefix0 + 'Avg' + '</th>';
  rowString3 += tdPrefix0 + 'Max' + '</th>';
  rowString3 += tdPrefix1 + 'Avg' + '</th>';
  rowString3 += tdPrefix1 + 'Max' + '</th>';
  rowString3 += tdPrefix0 + 'Avg' + '</th>';
  rowString3 += tdPrefix0 + 'Max' + '</th>';
  rowString3 += tdPrefix1 + 'Avg' + '</th>';
  rowString3 += tdPrefix1 + 'Max' + '</th>';

  // telop algae
  rowString3 += tdPrefix0 + 'Acc%' + '</th>';
  rowString3 += tdPrefix0 + 'Avg' + '</th>';
  rowString3 += tdPrefix0 + 'Max' + '</th>';
  rowString3 += tdPrefix1 + 'Avg' + '</th>';
  rowString3 += tdPrefix1 + 'Max' + '</th>';
  rowString3 += tdPrefix0 + 'Avg' + '</th>';
  rowString3 += tdPrefix0 + 'Max' + '</th>';

  // defense 
  rowString3 += tdPrefix1 + 'Avg' + '</th>';

  // endgame(start climb)
  rowString3 += tdPrefix0 + 'N' + '</th>';
  rowString3 += tdPrefix0 + 'B' + '</th>';
  rowString3 += tdPrefix0 + 'A' + '</th>';
  rowString3 += tdPrefix0 + 'L' + '</th>';

  // endgame(climb)
  rowString3 += tdPrefix1 + 'N' + '</th>';
  rowString3 += tdPrefix1 + 'P' + '</th>';
  rowString3 += tdPrefix1 + 'F' + '</th>';
  rowString3 += tdPrefix1 + 'S' + '</th>';
  rowString3 += tdPrefix1 + 'D' + '</th>';

  // died 
  rowString3 += tdPrefix0 + '#' + '</th>';

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

//
// Lookup value for a key in the passed dictionary - team in match data
//
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

    const tdPrefix0 = '<td ' + thBody + '>';
    const tdPrefix1 = '<td ' + thBlueSort + '>';
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
