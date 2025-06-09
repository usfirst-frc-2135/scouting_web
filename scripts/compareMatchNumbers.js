/*
  Global Variable Definition
*/

/*
  Function Definition
*/

//  Compare two alphanumeric match numbers in the form of [comp_level][match_num]
//    (e.g. p1, qm1, qm43, sf1, etc.)
//  This function is passed into a sort() to compare two rows. It can convert objects
//  to strings, trim whitespace, and remove case differences.
//
//  Return:
//    < 0   if matchA is before matchB
//    0     if matches are equal
//    > 0   if matchB is before matchA
//
function compareMatchNumbers(matchA, matchB) {
  // console.log("==> compareMatchNumbers: " + matchA + " <-> " + matchB);

  // Normalize input parameters
  var aPrefix = "";
  var bPrefix = "";
  var aNum = "";
  var bNum = "";
  matchA = matchA.toString().trim().toLowerCase();
  matchB = matchB.toString().trim().toLowerCase();

  // Pull apart prefix and number from matchnum (ie, "p", "qm", "sf")
  if (matchA.charAt(0) == "p") {
    aNum = matchA.substr(1, matchA.length);
    aPrefix = "p";
  }
  else if (matchA.charAt(0) == "q") {   // "qm"
    aNum = matchA.substr(2, matchA.length);
    aPrefix = "qm";
  }
  else if (matchA.charAt(0) == "s") {   // "sf"
    aNum = matchA.substr(2, matchA.length);
    aPrefix = "sf";
  }
  if (aPrefix == "") {
    console.warn("compareMatchNumbers: matchA is missing comp_level! - " + matchA)
    aPrefix = "qm";
  }

  if (matchB.charAt(0) == "p") {
    bNum = matchB.substr(1, matchB.length);
    bPrefix = "p";
  }
  else if (matchB.charAt(0) == "q") {   // "qm"
    bNum = matchB.substr(2, matchB.length);
    bPrefix = "qm";
  }
  else if (matchB.charAt(0) == "s") {   // "sf"
    bNum = matchB.substr(2, matchB.length);
    bPrefix = "sf";
  }
  if (bPrefix == "") {
    console.warn("compareMatchNumbers: matchB is missing comp_level! - " + matchB)
    aPrefix = "qm";
  }

  var returnVal;

  if (aPrefix == bPrefix) // Comp level is same, use numbers
    returnVal = (aNum - bNum);
  else if (aPrefix == "p")     // A != B, practice matches always first
    returnVal = -1;
  else if (bPrefix == "p")     // A !practice, so B is first
    returnVal = 1;
  else if (aPrefix == "qm")    // A & B !practice, so A must be first
    returnVal = -1;
  else
    returnVal = 1;          // B must be first

  console.log("compareMatchNumbers: " + matchA + " " + matchB + " " + returnVal);

  return returnVal;
};

