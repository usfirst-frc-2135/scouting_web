/*
  Global Variable Definition
*/

/*
  Function Definition
*/

// Test for an alphabetic character
function isAlpha(ch) {
  return /^[A-Z]$/i.test(ch);
}

// Test for an numeric string
function isNumeric(str) {
  if (typeof str != "string") return false // we only process strings!  
  return !isNaN(str) && // use type coercion to parse the _entirety_ of the string (`parseFloat` alone does not do this)...
    !isNaN(parseFloat(str)) // ...and ensure strings of whitespace fail
}

//  Check if a provided team number is valid
//
//  Return:
//    -1            if teamName is invalid
//    0             if teamName is not in teamList (if provided)
//    <teamNumber>  if valid and in teamList (if provided) WITHOUT LETTER
//
function validateTeamNumber(teamName, teamList) {
  // console.log("==> validateTeamNumber: " + teamA + " <-> " + teamB);

  let teamNumber = -1;  // 

  if (typeof teamName === 'string' || teamName instanceof String) {
    if (!/\s/.test(teamName)) {
      let lastChar = teamName.substring(teamName.length - 1);
      if (isAlpha(lastChar)) {
        teamName = teamName.substring(0, teamName.length - 1);
      }
      if (isNumeric(teamName))
        teamNumber = parseInt(teamName);

      if (teamList != null) {
        // teamNumber not in teamList)
        if (teamList.indexOf(teamNumber) < 0)
          teamNumber = 0;
      }
    }
  }

  return teamNumber;
}

