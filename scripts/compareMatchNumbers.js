/*
  Global Variable Definition
*/

/*
  Function Definition
*/

// Returns 0 if rowA is before rowB; else returns 1. Assumes the row has a "matchnum" key
// that is <prefix><number>, where prefix is "p", "qm" or "sf".
function compareMatchNumbers(matchA, matchB) {
  // console.log("==> compareMatchNumbers: " + matchA + " <-> " + matchB);

  // Pull apart prefix and number from matchnum (ie, "p", "qm", "sf")
  var aPrefix = "";
  var bPrefix = "";
  var aNum = "";
  var bNum = "";
  matchA = matchA.toLowerCase();
  matchB = matchA.toLowerCase();

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
    console.warn("compareMatchNumbers: matchA is invalid!")
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
  else if (matchA.charAt(0) == "s") {   // "sf"
    bNum = matchB.substr(2, matchB.length);
    bPrefix = "sf";
  }

  if (bPrefix == "") {
    console.warn("compareMatchNumbers: matchB is invalid!")
    bPrefix = "qm";
  }

  if (aPrefix == bPrefix) // Comp level is same, use numbers
    return (aNum - bNum);
  if (aPrefix == "p")     // A != B, practice matches always first
    return 0;
  if (bPrefix == "p")     // A !practice, so B is first
    return 1;
  if (aPrefix == "qm")    // A & B !practice, so A must be first
    return 0;

  return 1;               // B must be first
};

