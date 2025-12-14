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
  const thPrefix0 = '<th scope="col" class="bg-body">';               // No color
  const thAuto = '<th scope="col" class="bg-success-subtle">';        // Auton color
  const thTeleop = '<th scope="col" class="bg-primary-subtle">';      // Teleop color
  const thEndgame = '<th scope="col" class="bg-warning-subtle">';     // Endgame color

  rowString += '<th scope="col" class="bg-body sorttable_numeric">Match</th>';
  rowString += '<th scope="col" class="bg-body sorttable_numeric">Team</th>';
  // Insert column if the aliasList is not empty
  if (aliasList.length > 0) {
    rowString += thPrefix0 + 'Alias</th>';
  }
  rowString += thAuto + 'Auton Leave</th>';
  rowString += thAuto + 'Auton Coral L1</th>';
  rowString += thAuto + 'Auton Coral L2</th>';
  rowString += thAuto + 'Auton Coral L3</th>';
  rowString += thAuto + 'Auton Coral L4</th>';
  rowString += thAuto + 'Auton Algae Net</th>';
  rowString += thAuto + 'Auton Algae Proc</th>';
  rowString += thPrefix0 + 'Acqd Coral</th>';
  rowString += thPrefix0 + 'Acqd Algae</th>';
  rowString += thTeleop + 'Teleop Coral L1</th>';
  rowString += thTeleop + 'Teleop Coral L2</th>';
  rowString += thTeleop + 'Teleop Coral L3</th>';
  rowString += thTeleop + 'Teleop Coral L4</th>';
  rowString += thTeleop + 'Teleop Algae Net</th>';
  rowString += thTeleop + 'Teleop Algae Proc</th>';
  rowString += thTeleop + 'Defense</th>';
  rowString += thEndgame + 'Cage Climb</th>';
  rowString += thEndgame + 'Start Climb</th>';
  rowString += thPrefix0 + 'Died</th>';
  rowString += thPrefix0 + 'Scout Name</th>';
  rowString += thPrefix0 + 'Comment</th>';

  theadRef.insertRow().innerHTML = rowString;
};

//
// Converts a given "1" to yes, "2" to no, anything else to a dash.
//
function toYesNo(value) {
  switch (String(value)) {
    case "1": return "Yes";
    case "2": return "No";
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

    const tdPrefix0 = "<td class='bg-body'>";
    const tdPrefix1 = "<td class='bg-primary-subtle'>";

    let rowString = "<th class='fw-bold'>" + matchItem["matchnumber"] + "</th>";

    rowString += tdPrefix0 + "<a href='teamLookup.php?teamNum=" + teamNum + "'>" + teamNum + "</td>";
    // Insert column if the aliasList is not empty
    if (aliasList.length > 0) {
      rowString += tdPrefix0 + getAliasFromTeamNum(teamNum, aliasList) + "</td>";
    }
    rowString += tdPrefix1 + matchItem["autonLeave"] + "</td>";
    rowString += tdPrefix0 + matchItem["autonCoralL1"] + "</td>";
    rowString += tdPrefix1 + matchItem["autonCoralL2"] + "</td>";
    rowString += tdPrefix0 + matchItem["autonCoralL3"] + "</td>";
    rowString += tdPrefix1 + matchItem["autonCoralL4"] + "</td>";
    rowString += tdPrefix0 + matchItem["autonAlgaeNet"] + "</td>";
    rowString += tdPrefix1 + matchItem["autonAlgaeProcessor"] + "</td>";
    rowString += tdPrefix0 + matchItem["acquiredCoral"] + "</td>";
    rowString += tdPrefix1 + matchItem["acquiredAlgae"] + "</td>";
    rowString += tdPrefix0 + matchItem["teleopCoralL1"] + "</td>";
    rowString += tdPrefix1 + matchItem["teleopCoralL2"] + "</td>";
    rowString += tdPrefix0 + matchItem["teleopCoralL3"] + "</td>";
    rowString += tdPrefix1 + matchItem["teleopCoralL4"] + "</td>";
    rowString += tdPrefix0 + matchItem["teleopAlgaeNet"] + "</td>";
    rowString += tdPrefix1 + matchItem["teleopAlgaeProcessor"] + "</td>";
    rowString += tdPrefix0 + matchItem["defenseLevel"] + "</td>";
    rowString += tdPrefix1 + matchItem["cageClimb"] + "</td>";
    rowString += tdPrefix0 + matchItem["startClimb"] + "</td>";
    rowString += tdPrefix1 + matchItem["died"] + "</td>";
    rowString += tdPrefix0 + matchItem["scoutname"] + "</td>";
    rowString += tdPrefix1 + matchItem["comment"] + "</td>";

    tbodyRef.insertRow().innerHTML = rowString;
  }

  sorttable.makeSortable(document.getElementById(tableId));

  const matchColumn = 0;
  sortTableByMatch(tableId, matchColumn);
};
