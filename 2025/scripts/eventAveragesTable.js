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
  rowString3 += tdPrefix0 + '#' + '</th>';

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
  rowString3 += tdPrefix0 + 'NO' + '</th>';
  rowString3 += tdPrefix0 + 'B20' + '</th>';
  rowString3 += tdPrefix0 + 'A10' + '</th>';
  rowString3 += tdPrefix0 + 'L5' + '</th>';

  // endgame(climb)
  rowString3 += tdPrefix1 + 'NO' + '</th>';
  rowString3 += tdPrefix1 + 'PK' + '</th>';
  rowString3 += tdPrefix1 + 'FL' + '</th>';
  rowString3 += tdPrefix1 + 'SH' + '</th>';
  rowString3 += tdPrefix1 + 'DP' + '</th>';

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
function getDataValue(dict, key, field) {
  if (!dict) {
    console.warn("getDataValue: Dictionary not found! " + dict);
  }
  else if (key in dict) {
    if (field != undefined)
      return dict[key][field];
    else
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
    rowString += tdPrefix0 + getDataValue(avgItem, "totalMatches") + "</td>";

    // points by game phase
    rowString += tdPrefix1 + getDataValue(avgItem, "totalMatchPoints", "avg") + "</td>";
    rowString += tdPrefix1 + getDataValue(avgItem, "totalMatchPoints", "max") + "</td>";
    rowString += tdPrefix0 + getDataValue(avgItem, "autonPoints", "avg") + "</td>";
    rowString += tdPrefix0 + getDataValue(avgItem, "autonPoints", "max") + "</td>";
    rowString += tdPrefix1 + getDataValue(avgItem, "teleopPoints", "avg") + "</td>";
    rowString += tdPrefix1 + getDataValue(avgItem, "teleopPoints", "max") + "</td>";
    rowString += tdPrefix0 + getDataValue(avgItem, "endgamePoints", "avg") + "</td>";
    rowString += tdPrefix0 + getDataValue(avgItem, "endgamePoints", "max") + "</td>";

    // points by game piece
    rowString += tdPrefix1 + getDataValue(avgItem, "autonCoralPoints", "avg") + "</td>";
    rowString += tdPrefix1 + getDataValue(avgItem, "autonCoralPoints", "max") + "</td>";
    rowString += tdPrefix0 + getDataValue(avgItem, "autonAlgaePoints", "avg") + "</td>";
    rowString += tdPrefix0 + getDataValue(avgItem, "autonAlgaePoints", "max") + "</td>";
    rowString += tdPrefix1 + getDataValue(avgItem, "teleopCoralPoints", "avg") + "</td>";
    rowString += tdPrefix1 + getDataValue(avgItem, "teleopCoralPoints", "max") + "</td>";
    rowString += tdPrefix0 + getDataValue(avgItem, "teleopAlgaePoints", "avg") + "</td>";
    rowString += tdPrefix0 + getDataValue(avgItem, "teleopAlgaePoints", "max") + "</td>";

    // total game pieces
    rowString += tdPrefix1 + getDataValue(avgItem, "totalCoralPieces", "avg") + "</td>";
    rowString += tdPrefix1 + getDataValue(avgItem, "totalCoralPieces", "max") + "</td>";
    rowString += tdPrefix0 + getDataValue(avgItem, "totalAlgaePieces", "avg") + "</td>";
    rowString += tdPrefix0 + getDataValue(avgItem, "totalAlgaePieces", "max") + "</td>";

    // auton coral
    rowString += tdPrefix1 + getDataValue(avgItem, "autonCoralPieces", "avg") + "</td>";
    rowString += tdPrefix1 + getDataValue(avgItem, "autonCoralPieces", "max") + "</td>";
    rowString += tdPrefix0 + getDataValue(avgItem, "autonCoralL4", "avg") + "</td>";
    rowString += tdPrefix0 + getDataValue(avgItem, "autonCoralL4", "max") + "</td>";
    rowString += tdPrefix1 + getDataValue(avgItem, "autonCoralL3", "avg") + "</td>";
    rowString += tdPrefix1 + getDataValue(avgItem, "autonCoralL3", "max") + "</td>";
    rowString += tdPrefix0 + getDataValue(avgItem, "autonCoralL2", "avg") + "</td>";
    rowString += tdPrefix0 + getDataValue(avgItem, "autonCoralL2", "max") + "</td>";
    rowString += tdPrefix1 + getDataValue(avgItem, "autonCoralL1", "avg") + "</td>";
    rowString += tdPrefix1 + getDataValue(avgItem, "autonCoralL1", "max") + "</td>";

    // auton algae
    rowString += tdPrefix0 + getDataValue(avgItem, "autonAlgaePieces", "avg") + "</td>";
    rowString += tdPrefix0 + getDataValue(avgItem, "autonAlgaePieces", "max") + "</td>";
    rowString += tdPrefix1 + getDataValue(avgItem, "autonAlgaeProc", "avg") + "</td>";
    rowString += tdPrefix1 + getDataValue(avgItem, "autonAlgaeProc", "max") + "</td>";
    rowString += tdPrefix0 + getDataValue(avgItem, "autonAlgaeNet", "avg") + "</td>";
    rowString += tdPrefix0 + getDataValue(avgItem, "autonAlgaeNet", "max") + "</td>";

    // teleop coral
    rowString += tdPrefix1 + getDataValue(avgItem, "teleopCoralPieces", "acc") + "</td>";
    rowString += tdPrefix1 + getDataValue(avgItem, "teleopCoralPieces", "avg") + "</td>";
    rowString += tdPrefix1 + getDataValue(avgItem, "teleopCoralPieces", "max") + "</td>";
    rowString += tdPrefix0 + getDataValue(avgItem, "teleopCoralL4", "avg") + "</td>";
    rowString += tdPrefix0 + getDataValue(avgItem, "teleopCoralL4", "max") + "</td>";
    rowString += tdPrefix1 + getDataValue(avgItem, "teleopCoralL3", "avg") + "</td>";
    rowString += tdPrefix1 + getDataValue(avgItem, "teleopCoralL3", "max") + "</td>";
    rowString += tdPrefix0 + getDataValue(avgItem, "teleopCoralL2", "avg") + "</td>";
    rowString += tdPrefix0 + getDataValue(avgItem, "teleopCoralL2", "max") + "</td>";
    rowString += tdPrefix1 + getDataValue(avgItem, "teleopCoralL1", "avg") + "</td>";
    rowString += tdPrefix1 + getDataValue(avgItem, "teleopCoralL1", "max") + "</td>";

    // teleop algae
    rowString += tdPrefix0 + getDataValue(avgItem, "teleopAlgaePieces", "acc") + "</td>";
    rowString += tdPrefix0 + getDataValue(avgItem, "teleopAlgaePieces", "avg") + "</td>";
    rowString += tdPrefix0 + getDataValue(avgItem, "teleopAlgaePieces", "max") + "</td>";
    rowString += tdPrefix1 + getDataValue(avgItem, "teleopAlgaeProc", "avg") + "</td>";
    rowString += tdPrefix1 + getDataValue(avgItem, "teleopAlgaeProc", "max") + "</td>";
    rowString += tdPrefix0 + getDataValue(avgItem, "teleopAlgaeNet", "avg") + "</td>";
    rowString += tdPrefix0 + getDataValue(avgItem, "teleopAlgaeNet", "max") + "</td>";
    // defense
    rowString += tdPrefix1 + getDataValue(avgItem, "defenseLevel", "avg") + "</td>";

    // endgame
    let endgameClimbStartPercentage = getDataValue(avgItem, "endgameStartClimb", "arr");
    rowString += tdPrefix0 + getDataValue(endgameClimbStartPercentage, 0, "avg") + "</td>";
    rowString += tdPrefix0 + getDataValue(endgameClimbStartPercentage, 1, "avg") + "</td>";
    rowString += tdPrefix0 + getDataValue(endgameClimbStartPercentage, 2, "avg") + "</td>";
    rowString += tdPrefix0 + getDataValue(endgameClimbStartPercentage, 3, "avg") + "</td>";

    let endgameClimbPercentage = getDataValue(avgItem, "endgameCageClimb", "arr");
    rowString += tdPrefix1 + getDataValue(endgameClimbPercentage, 0, "avg") + "</td>";
    rowString += tdPrefix1 + getDataValue(endgameClimbPercentage, 1, "avg") + "</td>";
    rowString += tdPrefix1 + getDataValue(endgameClimbPercentage, 2, "avg") + "</td>";
    rowString += tdPrefix1 + getDataValue(endgameClimbPercentage, 3, "avg") + "</td>";
    rowString += tdPrefix1 + getDataValue(endgameClimbPercentage, 4, "avg") + "</td>";
    rowString += tdPrefix0 + getDataValue(avgItem, "died", "sum") + "</td>";

    tbodyRef.insertRow().innerHTML = rowString;
  }

  sorttable.makeSortable(document.getElementById(tableId));

  const teamColumn = 0;
  sortTableByTeam(tableId, teamColumn);
};
