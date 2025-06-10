/*
  Global Variable Definition
*/

/*
  Function Definition
*/

//  Compare two alphnumAeric match numbers in the form of [comp_level][match_num]
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
  var prefixA = "";
  var prefixB = "";
  var numA = "";
  var numB = "";
  matchA = matchA.toString().trim().toLowerCase();
  matchB = matchB.toString().trim().toLowerCase();

  // Pull apart prefix and number from matchnum (ie, "p", "qm", "sf")
  if (matchA.charAt(0) == "p") {
    numA = matchA.substr(1, matchA.length);
    prefixA = "p";
  }
  else if (matchA.charAt(0) == "q") {   // "qm"
    numA = matchA.substr(2, matchA.length);
    prefixA = "qm";
  }
  else if (matchA.charAt(0) == "s") {   // "sf"
    numA = matchA.substr(2, matchA.length);
    prefixA = "sf";
  }
  if (prefixA == "") {
    console.warn("compareMatchNumbers: matchA is missing comp_level! - " + matchA)
    prefixA = "qm";
    numA = matchA;
    matchA = prefixA + matchA;
  }

  if (matchB.charAt(0) == "p") {
    numB = matchB.substr(1, matchB.length);
    prefixB = "p";
  }
  else if (matchB.charAt(0) == "q") {   // "qm"
    numB = matchB.substr(2, matchB.length);
    prefixB = "qm";
  }
  else if (matchB.charAt(0) == "s") {   // "sf"
    numB = matchB.substr(2, matchB.length);
    prefixB = "sf";
  }
  if (prefixB == "") {
    console.warn("compareMatchNumbers: matchB is missing comp_level! - " + matchB)
    prefixB = "qm";
    numB = matchB;
    matchB = prefixB + matchB;
  }

  // console.log("compareMatchNumbers: " + prefixA + " " + numA + " " + matchA + " " + prefixB + " " + numB + " " + matchB);

  var returnVal;

  if (prefixA == prefixB)   // Comp level is same, use numbers
    returnVal = (numA - numB);
  else if (prefixA == "p")  // A != B, practice matches always first
    returnVal = -1;
  else if (prefixB == "p")  // A !practice, so B is first
    returnVal = 1;
  else if (prefixA == "qm") // A & B !practice, so A must be first
    returnVal = -1;
  else
    returnVal = 1;          // B must be first

  console.log("compareMatchNumbers: " + matchA + " " + matchB + " " + returnVal);

  return returnVal;
};

