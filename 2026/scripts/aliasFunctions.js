/*
  Function Definition
*/

//
//
// Returns corresponding alias value ("99xx" number) for the given teamnum ("254B")
//
function getAliasFromTeamNum(teamnum, teamAliasList) {
  let rtnAliasNum = "";
  for (let entry of teamAliasList) {
    let tnum = entry["teamnumber"].trim();
    //HOLD    console.log( "---> comparing teamnum " + teamnum + " with tnum " + tnum);
    if (tnum === teamnum) {
      rtnAliasNum = entry["aliasnumber"]
      //HOLD      console.log("   ---> FOUND teamnum, got alias = " + rtnAliasNum);
      break;
    }
  }
  return rtnAliasNum;
}

//
// Return the team number for a given alias number
//
function getTeamNumFromAlias(aliasNum, teamAliasList) {
  let rtnTeamNum = "";
  for (let entry of teamAliasList) {
    let anum = entry["aliasnumber"].trim();
    //HOLD    console.log( "---> comparing aliasNum " + aliasNum + " with " + anum);
    if (anum == aliasNum) {
      rtnTeamNum = entry["teamnumber"]
      //HOLD       console.log("   ---> FOUND aliasNum, got teamnum = " + rtnTeamNum);
      break;
    }
  }
  return rtnTeamNum;
}

//
// Test if a team number string is in the alias number range (9970 to 9999 defined by FRC)
//
function isAliasNumber(teamStr) {
  let teamInt = parseInt(teamStr);

  return (teamInt >= 9970 && teamInt <= 9999);
}
