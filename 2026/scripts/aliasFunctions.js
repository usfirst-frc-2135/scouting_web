/*
  Function Definition
*/

//
//  This file has two functions
//    These fucntions will get data from the alias table
//           - getAliasFromTeamNum(teamnum, aliaslist)
//           - getTeamNumFromAlias(alias, aliaslist)
//
// Returns corresponding alias value ("99xx" number) for the given teamnum ("254B")
function getAliasFromTeamNum(teamnum, teamAliasList) {
  let rtnAlias = "";
  for (let entry of teamAliasList) {
    let tnum = entry["teamnumber"].trim();
    //HOLD    console.log( "---> comparing teamnum " + teamnum + " with tnum " + tnum);
    if (tnum === teamnum) {
      rtnAlias = entry["aliasnumber"]
      //HOLD      console.log("   ---> FOUND teamnum, got alias = " + rtnAlias);
      break;
    }
  }
  return rtnAlias;
}



function getTeamNumFromAlias(alias, teamAliasList) {
  let rtnTeamNum = "";
  for (let entry of teamAliasList) {
    let anum = entry["aliasnumber"].trim();
    //HOLD    console.log( "---> comparing alias " + alias + " with " + anum);
    if (anum == alias) {
      rtnTeamNum = entry["teamnumber"]
      //HOLD       console.log("   ---> FOUND alias, got teamnum = " + rtnTeamNum);
      break;
    }
  }
  return rtnTeamNum;
}
