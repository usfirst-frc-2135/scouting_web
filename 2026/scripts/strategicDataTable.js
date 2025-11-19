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
  rowString1 += '<tr>';
  rowString1 += '<th colspan="1" style="background-color:transparent"> </th>';
  rowString1 += '<th colspan="1" style="background-color:transparent"> </th>';
  rowString1 += '<th colspan="1" style="background-color:#cfe2ff"> </th>';
  rowString1 += '<th colspan="2" style="background-color:#cfe2ff">Against Defense</th>';
  rowString1 += '<th colspan="3" style="background-color:transparent">Defense Tactics</th>';
  rowString1 += '<th colspan="8" style="background-color:#cfe2ff">Fouls</th>';
  rowString1 += '<th colspan="4" style="background-color:transparent">Auton</th>';
  rowString1 += '<th colspan="4" style="background-color:#cfe2ff">Teleop</th>';
  rowString1 += '<th colspan="2" style="background-color:transparent">Notes</th>';
  rowString1 += '<th colspan="1"> </th>';
  rowString1 += '</tr>';

  theadRef.insertRow().innerHTML = rowString1;

  let rowString2 = '';
  rowString2 += '<tr>';
  rowString2 += '<th scope="col" style="background-color:transparent" class="sorttable_numeric">Team</th>';
  rowString2 += '<th scope="col" style="background-color:transparent">Match</th>';
  rowString2 += '<th scope="col" style="background-color:#cfe2ff">Drive Skill</th>';
  rowString2 += '<th scope="col" style="background-color:transparent">Block</th>';
  rowString2 += '<th scope="col" style="background-color:#cfe2ff">Note</th>';
  rowString2 += '<th scope="col" style="background-color:transparent">Block Path</th>';
  rowString2 += '<th scope="col" style="background-color:#cfe2ff">Block Station</th>';
  rowString2 += '<th scope="col" style="background-color:transparent">Note</th>';
  rowString2 += '<th scope="col" style="background-color:#cfe2ff">Pin</th>';
  rowString2 += '<th scope="col" style="background-color:transparent">Auton Barge Contact</th>';
  rowString2 += '<th scope="col" style="background-color:#cfe2ff">Auton Cage Contact</th>';
  rowString2 += '<th scope="col" style="background-color:transparent">Anchor Contact</th>';
  rowString2 += '<th scope="col" style="background-color:#cfe2ff">Barge Contact</th>';
  rowString2 += '<th scope="col" style="background-color:transparent">Reef Contact</th>';
  rowString2 += '<th scope="col" style="background-color:#cfe2ff">Cage Contact</th>';
  rowString2 += '<th scope="col" style="background-color:transparent">Contact Climbing Robot</th>';
  rowString2 += '<th scope="col" style="background-color:#cfe2ff">Get Floor Coral</th>';
  rowString2 += '<th scope="col" style="background-color:transparent">Get Stn Coral</th>';
  rowString2 += '<th scope="col" style="background-color:#cfe2ff">Get Floor Algae</th>';
  rowString2 += '<th scope="col" style="background-color:transparent">Get Reef Algae</th>';
  rowString2 += '<th scope="col" style="background-color:#cfe2ff">Get Floor Coral</th>';
  rowString2 += '<th scope="col" style="background-color:transparent">Get Floor Algae</th>';
  rowString2 += '<th scope="col" style="background-color:#cfe2ff">Knock Algae</th>';
  rowString2 += '<th scope="col" style="background-color:transparent">Acquire Reef Algae</th>';
  rowString2 += '<th scope="col" style="background-color:#cfe2ff">Problem Note</th>';
  rowString2 += '<th scope="col" style="background-color:transparent">General Note</th>';
  rowString2 += '<th scope="col" style="background-color:#cfe2ff">Scout Name</th>';
  rowString2 += '</tr>';

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

    sorttable.makeSortable(document.getElementById(tableId));

    const teamColumn = 0;
    const matchColumn = 1;
    sortTableByMatchAndTeam(tableId, teamColumn, matchColumn);
  }
};
