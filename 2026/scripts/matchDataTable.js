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
  console.log("==> insertMatchDataHeader: tableId" + tableId + " aliases " + aliasList.length);

  let theadRef = document.getElementById(tableId).querySelector('thead');;
  theadRef.innerHTML = ""; // Clear Table

  let rowString = '';

  rowString += '<tr>';
  rowString += '<th scope="col" style="background-color:transparent" class="sorttable_numeric">Match</th>';
  rowString += '<th scope="col" style="background-color:transparent" class="sorttable_numeric">Team</th>';
  // Insert column if the aliasList is not empty
  if (aliasList.length > 0) {
    rowString += '<th scope="col" style="background-color:transparent">Alias</th>';
  }
  rowString += '<th scope="col" style="background-color:#d5e6de">Auton Leave</th>';
  rowString += '<th scope="col" style="background-color:#d5e6de">Auton Coral L1</th>';
  rowString += '<th scope="col" style="background-color:#d5e6de">Auton Coral L2</th>';
  rowString += '<th scope="col" style="background-color:#d5e6de">Auton Coral L3</th>';
  rowString += '<th scope="col" style="background-color:#d5e6de">Auton Coral L4</th>';
  rowString += '<th scope="col" style="background-color:#d5e6de">Auton Algae Net</th>';
  rowString += '<th scope="col" style="background-color:#d5e6de">Auton Algae Proc</th>';
  rowString += '<th scope="col" style="background-color:transparent">Acqd Coral</th>';
  rowString += '<th scope="col" style="background-color:transparent">Acqd Algae</th>';
  rowString += '<th scope="col" style="background-color:#d6f3fB">Teleop Coral L1</th>';
  rowString += '<th scope="col" style="background-color:#d6f3fB">Teleop Coral L2</th>';
  rowString += '<th scope="col" style="background-color:#d6f3fB">Teleop Coral L3</th>';
  rowString += '<th scope="col" style="background-color:#d6f3fB">Teleop Coral L4</th>';
  rowString += '<th scope="col" style="background-color:#d6f3fB">Teleop Algae Net</th>';
  rowString += '<th scope="col" style="background-color:#d6f3fB">Teleop Algae Proc</th>';
  rowString += '<th scope="col" style="background-color:#d6f3fB">Defense</th>';
  rowString += '<th scope="col" style="background-color:#fbe6d3">Cage Climb</th>';
  rowString += '<th scope="col" style="background-color:#fbe6d3">Start Climb</th>';
  rowString += '<th scope="col" style="background-color:transparent">Died</th>';
  rowString += '<th scope="col" style="background-color:transparent">Scout Name</th>';
  rowString += '<th scope="col" style="background-color:#cfe2ff">Comment</th>';
  rowString += '</tr>';

  theadRef.insertRow().innerHTML = rowString;
};

//
//  Insert a match data table header (all rows)
//    Params
//      tableId     - the HTML ID where the table header is inserted
//      matchData   - the list of available matches to include in this table
//      aliasList   - list of aliases at the event (length 0 if none)
//      teamFilter  - list of teams to include in table (length 0 if all)
//
function insertMatchDataBody(tableId, matchData, aliasList, teamFilter) {
  console.log("==> insertMatchDataTable: tableId" + tableId + " matches " + matchData.length + " teams " + teamFilter.length + " aliases " + aliasList.length);

  let tbodyRef = document.getElementById(tableId).querySelector('tbody');;
  tbodyRef.innerHTML = ""; // Clear Table

  // Go thru each match and build the HTML string for that row.
  for (let i = 0; i < matchData.length; i++) {
    let matchItem = matchData[i];
    let teamNum = matchItem["teamnumber"];
    if (teamFilter.length !== 0 && !teamFilter.includes(teamNum))
      continue;

    const tdPrefix0 = "<td style=\"background-color:transparent\">";
    const tdPrefix1 = "<td style=\"background-color:#cfe2ff\">";

    let rowString = "<th>" + matchItem["matchnumber"] + "</th>";

    rowString += tdPrefix0 + "<a href='teamLookup.php?teamNum=" + teamNum + "'>" + teamNum + "</td>";
    // Insert column if the aliasList is not empty
    if (aliasList.length > 0) {
      let aliasNum = matchItem["teamalias"];
      if (aliasNum === 0)
        aliasNum = "";
      rowString += tdPrefix0 + aliasNum + "</td>";
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

    sorttable.makeSortable(document.getElementById(tableId));
    const matchColumn = 0;
    sortTableByMatch(tableId, matchColumn);
  }
};
