/*
  Global Variable Definition
*/

/*
  Function Definition
*/

//
//  Provide match data table utilities that:
//    1) insert a header row for a match data table
//    2) insert a body row for match data table
//

//
//  Insert a match data table header (all rows)
//    Params
//      tableId     - the HTML ID where the table header is inserted
//      aliasList   - list of aliases at the event
//
function insertMatchDataHeader(tableId, aliasList) {
  console.log("==> insertMatchDataHeader: tableId " + tableId + " aliases " + aliasList.length);

  let theadRef = document.getElementById(tableId).querySelector('thead');;
  theadRef.innerHTML = ""; // Clear Table

  let rowString = '';
  const thMatch = '<th scope="col" class="bg-body">';               // No color
  const thAuto = '<th scope="col" class="bg-success-subtle">';        // Auton color
  const thTeleop = '<th scope="col" class="bg-primary-subtle">';      // Teleop color
  const thEndgame = '<th scope="col" class="bg-warning-subtle">';     // Endgame color

  rowString += '<th scope="col" class="bg-body sorttable_numeric">Match</th>';
  rowString += '<th scope="col" class="bg-body sorttable_numeric">Team</th>';
  // Insert column if the aliasList is not empty
  if (aliasList.length > 0) {
    rowString += thMatch + 'Alias</th>';
  }
  rowString += thMatch + 'Died</th>';
  rowString += thAuto + 'Auton Leave</th>';
  rowString += thAuto + 'Auton Coral L1</th>';
  rowString += thAuto + 'Auton Coral L2</th>';
  rowString += thAuto + 'Auton Coral L3</th>';
  rowString += thAuto + 'Auton Coral L4</th>';
  rowString += thAuto + 'Auton Algae Net</th>';
  rowString += thAuto + 'Auton Algae Proc</th>';
  rowString += thTeleop + 'Teleop Coral L1</th>';
  rowString += thTeleop + 'Teleop Coral L2</th>';
  rowString += thTeleop + 'Teleop Coral L3</th>';
  rowString += thTeleop + 'Teleop Coral L4</th>';
  rowString += thTeleop + 'Teleop Algae Net</th>';
  rowString += thTeleop + 'Teleop Algae Proc</th>';
  rowString += thTeleop + 'Teleop Acqd Coral</th>';
  rowString += thTeleop + 'Teleop Acqd Algae</th>';
  rowString += thEndgame + 'Cage Climb</th>';
  rowString += thEndgame + 'Start Climb</th>';
  rowString += thTeleop + 'Defense</th>';
  rowString += thMatch + 'Comment</th>';
  rowString += thMatch + 'Scout Name</th>';

  theadRef.insertRow().innerHTML = rowString;
};

//
// Converts a given climb level to a string
//
function toClimbLevel(value) {
  switch (String(value)) {
    case "1": return "1-Park";
    case "2": return "2-Fell";
    case "3": return "3-Shallow";
    case "4": return "4-Deep";
    default: return "-";
  }
}

//
//  Insert a match data table body (all rows)
//    Params
//      tableId     - the HTML ID where the table header is inserted
//      matchData   - the list of available matches to include in this table
//      aliasList   - list of aliases at the event (length 0 if none)
//      teamFilter  - list of teams to include in table (length 0 if all)
//
function insertMatchDataBody(tableId, matchData, aliasList, teamFilter) {
  console.log("==> insertMatchDataTable: tableId " + tableId + " matches " + matchData.length + " aliases " + aliasList.length + " teams " + teamFilter.length);

  let tbodyRef = document.getElementById(tableId).querySelector('tbody');;
  tbodyRef.innerHTML = ""; // Clear Table

  // Go thru each match and build the HTML string for that row.
  for (let i = 0; i < matchData.length; i++) {
    let matchItem = matchData[i];
    let teamNum = matchItem["teamnumber"];
    if (teamFilter.length !== 0 && !teamFilter.includes(teamNum))
      continue;

    const tdBody = "<td class='bg-body'>";
    const tdBlue = "<td class='bg-primary-subtle'>";

    let rowString = "<th class='fw-bold'>" + matchItem["matchnumber"] + "</th>";

    rowString += tdBody + "<a href='teamLookup.php?teamNum=" + teamNum + "'>" + teamNum + "</td>";
    // Insert column if the aliasList is not empty
    if (aliasList.length > 0) {
      rowString += tdBody + getAliasFromTeamNum(teamNum, aliasList) + "</td>";
    }
    rowString += tdBlue + matchItem["died"] + "</td>";
    rowString += tdBody + matchItem["autonLeave"] + "</td>";
    rowString += tdBlue + matchItem["autonCoralL1"] + "</td>";
    rowString += tdBody + matchItem["autonCoralL2"] + "</td>";
    rowString += tdBlue + matchItem["autonCoralL3"] + "</td>";
    rowString += tdBody + matchItem["autonCoralL4"] + "</td>";
    rowString += tdBlue + matchItem["autonAlgaeNet"] + "</td>";
    rowString += tdBody + matchItem["autonAlgaeProc"] + "</td>";
    rowString += tdBlue + matchItem["teleopCoralL1"] + "</td>";
    rowString += tdBody + matchItem["teleopCoralL2"] + "</td>";
    rowString += tdBlue + matchItem["teleopCoralL3"] + "</td>";
    rowString += tdBody + matchItem["teleopCoralL4"] + "</td>";
    rowString += tdBlue + matchItem["teleopAlgaeNet"] + "</td>";
    rowString += tdBody + matchItem["teleopAlgaeProc"] + "</td>";
    rowString += tdBody + matchItem["teleopCoralAcquired"] + "</td>";
    rowString += tdBlue + matchItem["teleopAlgaeAcquired"] + "</td>";
    rowString += tdBlue + toClimbLevel(matchItem["endgameCageClimb"]) + "</td>";
    rowString += tdBody + matchItem["endgameStartClimb"] + "</td>";
    rowString += tdBlue + matchItem["defenseLevel"] + "</td>";
    rowString += tdBlue + matchItem["comment"] + "</td>";
    rowString += tdBody + matchItem["scoutname"] + "</td>";

    tbodyRef.insertRow().innerHTML = rowString;
  }

  sorttable.makeSortable(document.getElementById(tableId));

  const matchColumn = 0;
  sortTableByMatch(tableId, matchColumn);
};
