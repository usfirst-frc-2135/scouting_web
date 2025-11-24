/*
  Global Variable Definition
*/

/*
  Function Definition
*/

//
//  Provide strategic data table utilities that:
//    1) insert a header row for a strategic data table
//    2) insert a body row for strategic data table
//

//
//  Insert a strategic data table header (all rows)
//    Params
//      tableId     - the HTML ID where the table header is inserted
//      aliasList   - list of aliases at the event
//
function insertStrategicDataHeader(tableId, aliasList) {
  console.log("==> insertStrategicDataHeader: tableId " + tableId + " aliases " + aliasList.length);

  let theadRef = document.getElementById(tableId).querySelector('thead');;
  theadRef.innerHTML = ""; // Clear Table

  let rowString1 = '';
  rowString1 += '<th colspan="1" style="background-color:transparent"> </th>';
  // Insert column if the aliasList is not empty
  if (aliasList.length > 0) {
    rowString1 += '<th colspan="1" style="background-color:transparent"> </th>';
  }
  rowString1 += '<th colspan="1" style="background-color:transparent"> </th>';
  rowString1 += '<th colspan="1" style="background-color:#cfe2ff"> </th>';
  rowString1 += '<th colspan="2" style="background-color:#cfe2ff">Against Defense</th>';
  rowString1 += '<th colspan="3" style="background-color:transparent">Defense Tactics</th>';
  rowString1 += '<th colspan="8" style="background-color:#cfe2ff">Fouls</th>';
  rowString1 += '<th colspan="4" style="background-color:transparent">Auton</th>';
  rowString1 += '<th colspan="4" style="background-color:#cfe2ff">Teleop</th>';
  rowString1 += '<th colspan="2" style="background-color:transparent">Notes</th>';
  rowString1 += '<th colspan="1"> </th>';

  theadRef.insertRow().innerHTML = rowString1;

  let rowString2 = '';
  const thPrefix0 = '<th scope="col" style="background-color:transparent">';
  const thPrefix1 = '<th scope="col" style="background-color:#cfe2ff">';
  rowString2 += '<th scope="col" style="background-color:transparent" class="sorttable_numeric">Team</th>';
  // Insert column if the aliasList is not empty
  if (aliasList.length > 0) {
    rowString2 += thPrefix0 + 'Alias</th>';
  }
  rowString2 += thPrefix0 + 'Match</th>';
  rowString2 += thPrefix1 + 'Drive Skill</th>';
  rowString2 += thPrefix0 + 'Block</th>';
  rowString2 += thPrefix1 + 'Note</th>';
  rowString2 += thPrefix0 + 'Block Path</th>';
  rowString2 += thPrefix1 + 'Block Station</th>';
  rowString2 += thPrefix0 + 'Note</th>';
  rowString2 += thPrefix1 + 'Pin</th>';
  rowString2 += thPrefix0 + 'Auton Barge Contact</th>';
  rowString2 += thPrefix1 + 'Auton Cage Contact</th>';
  rowString2 += thPrefix0 + 'Anchor Contact</th>';
  rowString2 += thPrefix1 + 'Barge Contact</th>';
  rowString2 += thPrefix0 + 'Reef Contact</th>';
  rowString2 += thPrefix1 + 'Cage Contact</th>';
  rowString2 += thPrefix0 + 'Contact Climbing Robot</th>';
  rowString2 += thPrefix1 + 'Get Floor Coral</th>';
  rowString2 += thPrefix0 + 'Get Stn Coral</th>';
  rowString2 += thPrefix1 + 'Get Floor Algae</th>';
  rowString2 += thPrefix0 + 'Get Reef Algae</th>';
  rowString2 += thPrefix1 + 'Get Floor Coral</th>';
  rowString2 += thPrefix0 + 'Get Floor Algae</th>';
  rowString2 += thPrefix1 + 'Knock Algae</th>';
  rowString2 += thPrefix0 + 'Acquire Reef Algae</th>';
  rowString2 += thPrefix1 + 'Problem Note</th>';
  rowString2 += thPrefix0 + 'General Note</th>';
  rowString2 += thPrefix1 + 'Scout Name</th>';

  theadRef.insertRow().innerHTML = rowString2;
};

// Converts a given "1" to yes, "2" to no, anything else to a dash.
function toYesNo(value) {
  switch (String(value)) {
    case "1": return "Yes";
    case "2": return "No";
    default: return "-";
  }
};

//
//  Insert a strategic data table body (all rows)
//    Params
//      tableId     - the HTML ID where the table header is inserted
//      stratData   - the list of available stategic matches to include in this table
//      aliasList   - list of aliases at the event (length 0 if none)
//      teamFilter  - list of teams to include in table (length 0 if all)
//
function insertStrategicDataBody(tableId, stratData, aliasList, teamFilter) {
  console.log("==> insertStrategicDataBody: tableId " + tableId + " stratMatches " + stratData.length + " aliases " + aliasList.length + " teams " + teamFilter.length);

  let tbodyRef = document.getElementById(tableId).querySelector('tbody');;
  tbodyRef.innerHTML = ""; // Clear Table

  // Go thru each strategic and build the HTML string for that row.
  for (let i = 0; i < stratData.length; i++) {
    let stratItem = stratData[i];
    let teamNum = stratItem["teamnumber"];
    if (teamFilter.length !== 0 && !teamFilter.includes(teamNum))
      continue;

    const tdPrefix0 = "<td style=\"background-color:transparent\">";
    const tdPrefix1 = "<td style=\"background-color:#cfe2ff\">";

    let driveVal = "";
    switch (stratItem["driverability"]) {
      case 1: driveVal = "Jerky"; break;
      case 2: driveVal = "Slow"; break;
      case 3: driveVal = "Average"; break;
      case 4: driveVal = "Quick"; break;
      default:
      case 0: driveVal = "-"; break;
    }

    let rowString = "";
    rowString += tdPrefix0 + "<a href='teamLookup.php?teamNum=" + teamNum + "'>" + teamNum + "</td>";
    // Insert column if the aliasList is not empty
    if (aliasList.length > 0) {
      rowString += tdPrefix0 + getAliasFromTeamNum(teamNum, aliasList) + "</td>";
    }
    rowString += tdPrefix0 + stratItem["matchnumber"] + "</td>";
    rowString += tdPrefix1 + driveVal + "</td>";
    rowString += tdPrefix0 + toYesNo(stratItem["against_tactic1"]) + "</td>";
    rowString += tdPrefix1 + stratItem["against_comment"] + "</td>";
    rowString += tdPrefix0 + toYesNo(stratItem["defense_tactic1"]) + "</td>";
    rowString += tdPrefix1 + toYesNo(stratItem["defense_tactic2"]) + "</td>";
    rowString += tdPrefix0 + stratItem["defense_comment"] + "</td>";
    rowString += tdPrefix1 + toYesNo(stratItem["foul1"]) + "</td>";
    rowString += tdPrefix0 + toYesNo(stratItem["autonFoul1"]) + "</td>";
    rowString += tdPrefix1 + toYesNo(stratItem["autonFoul2"]) + "</td>";
    rowString += tdPrefix0 + toYesNo(stratItem["teleopFoul1"]) + "</td>";
    rowString += tdPrefix1 + toYesNo(stratItem["teleopFoul2"]) + "</td>";
    rowString += tdPrefix0 + toYesNo(stratItem["teleopFoul3"]) + "</td>";
    rowString += tdPrefix1 + toYesNo(stratItem["teleopFoul4"]) + "</td>";
    rowString += tdPrefix0 + toYesNo(stratItem["endgameFoul1"]) + "</td>";
    rowString += tdPrefix1 + toYesNo(stratItem["autonGetCoralFromFloor"]) + "</td>";
    rowString += tdPrefix0 + toYesNo(stratItem["autonGetCoralFromStation"]) + "</td>";
    rowString += tdPrefix1 + toYesNo(stratItem["autonGetAlgaeFromFloor"]) + "</td>";
    rowString += tdPrefix0 + toYesNo(stratItem["autonGetAlgaeFromReef"]) + "</td>";
    rowString += tdPrefix1 + toYesNo(stratItem["teleopFloorPickupAlgae"]) + "</td>";
    rowString += tdPrefix0 + toYesNo(stratItem["teleopFloorPickupCoral"]) + "</td>";
    rowString += tdPrefix1 + toYesNo(stratItem["teleopKnockOffAlgaeFromReef"]) + "</td>";
    rowString += tdPrefix0 + toYesNo(stratItem["teleopAcquireAlgaeFromReef"]) + "</td>";
    rowString += tdPrefix1 + stratItem["problem_comment"] + "</td>";
    rowString += tdPrefix0 + stratItem["general_comment"] + "</td>";
    rowString += tdPrefix1 + stratItem["scoutname"] + "</td>";

    tbodyRef.insertRow().innerHTML = rowString;
  }

  sorttable.makeSortable(document.getElementById(tableId));

  const teamColumn = 0;
  let matchColumn = (aliasList.length > 0) ? 2 : 1;

  sortTableByMatchAndTeam(tableId, teamColumn, matchColumn);
};
