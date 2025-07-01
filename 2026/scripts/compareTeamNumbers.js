/*
  Global Variable Definition
*/

/*
  Function Definition
*/

// Test for an alphabetic character
let isAlpha = function (ch) {
  return /^[A-Z]$/i.test(ch);
}

//
//  Compare two alphanumeric team numbers in the form of frc[team_num][letter]
//    (e.g. 2135, 2135B, 2135C, etc.)
//  This function is passed into a sort() to compare two rows
//
//  Return:
//    < 0   if teamA is before teamB
//    0     if matches are equal
//    > 0   if teamB is before teamA
//
function compareTeamNumbers(teamA, teamB) {
  // console.log("==> compareTeamNumbers: " + teamA + " <-> " + teamB);

  // Trim beginning/ending whitespace
  teamA = teamA.toString().trim().toUpperCase();
  teamB = teamB.toString().trim().toUpperCase();

  // Pull apart prefix, number, and suffix from matchnum (ie, "frc", "2135", "A")
  // Remove the " - <teamName>" from the end of the entry.
  const dashPosA = teamA.indexOf("-");
  if (dashPosA != -1)
    teamA = teamA.substring(0, dashPosA - 1);
  const dashPosB = teamB.indexOf("-");
  if (dashPosB != -1)
    teamB = teamB.substring(0, dashPosB - 1);

  // Remove leading "frc" if any
  if (teamA.startsWith("FRC"))
    teamA = teamA.substring(3);
  if (teamB.startsWith("FRC"))
    teamB = teamB.substring(3);

  // console.log("===> teamA = " + teamA + "; teamB = " + teamB);

  // Remove any letters at the last char in teamNum for the sort comparison.
  let teamNumA;
  let teamNumB;
  if (isAlpha(teamA.charAt(teamA.length - 1)))
    teamNumA = parseInt(teamA.substring(0, teamA.length - 1));
  else
    teamNumA = parseInt(teamA.substring(0, teamA.length));
  if (isAlpha(teamB.charAt(teamB.length - 1)))
    teamNumB = parseInt(teamB.substring(0, teamB.length - 1));
  else
    teamNumB = parseInt(teamB.substring(0, teamB.length));

  let returnVal = teamNumA - teamNumB;
  if (returnVal === 0)
    returnVal = (parseInt(teamA) - parseInt(teamB));

  // console.log("compareTeamNumbers: " + teamA + " " + teamB + " " + returnVal);

  return returnVal;
}

