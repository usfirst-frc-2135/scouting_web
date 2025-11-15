/*
  Global Variable Definition
*/

/*
  Function Definition
*/

//
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
  let prefixA = "";
  let prefixB = "";
  let numA = "";
  let numB = "";
  matchA = matchA.trim().toLowerCase();
  matchB = matchB.trim().toLowerCase();

  // Pull apart prefix and number from matchnum (ie, "p", "qm", "sf")
  if (matchA.charAt(0) === "p") {
    numA = matchA.substring(1);
    prefixA = "p";
  }
  else if (matchA.charAt(0) === "q") {   // "qm"
    numA = matchA.substring(2);
    prefixA = "qm";
  }
  else if (matchA.charAt(0) === "s") {   // "sf"
    numA = matchA.substring(2);
    prefixA = "sf";
  }
  else if (matchA.charAt(0) === "f") {   // "qm"
    numA = matchA.substring(1);
    prefixA = "f";
  }
  if (prefixA === "") {
    console.warn("compareMatchNumbers: matchA is missing comp_level! - " + matchA);
    prefixA = "qm";
    numA = matchA;
    matchA = prefixA + matchA;
  }

  if (matchB.charAt(0) === "p") {
    numB = matchB.substring(1);
    prefixB = "p";
  }
  else if (matchB.charAt(0) === "q") {   // "qm"
    numB = matchB.substring(2);
    prefixB = "qm";
  }
  else if (matchB.charAt(0) === "s") {   // "sf"
    numB = matchB.substring(2);
    prefixB = "sf";
  }
  else if (matchB.charAt(0) === "f") {   // "qm"
    numB = matchB.substring(1);
    prefixB = "f";
  }
  if (prefixB === "") {
    console.warn("compareMatchNumbers: matchB is missing comp_level! - " + matchB);
    prefixB = "qm";
    numB = matchB;
    matchB = prefixB + matchB;
  }

  // console.log("==> compareMatchNumbers: " + prefixA + numA + "/" + matchA + " " + prefixB + numB + "/" + matchB);

  let returnVal;

  if (prefixA === prefixB)   // Comp level is same, use numbers
    returnVal = (parseInt(numA) - parseInt(numB));
  else if (prefixA === "p")  // A != B, practice matches always first
    returnVal = -1;
  else if (prefixB === "p")  // A !practice, so B is first
    returnVal = 1;
  else if (prefixA === "qm") // A & B !practice, so A must be first
    returnVal = -1;
  else
    returnVal = 1;          // B must be first

  // console.log("==> compareMatchNumbers: " + matchA + " " + matchB + " " + returnVal);

  return returnVal;
};
