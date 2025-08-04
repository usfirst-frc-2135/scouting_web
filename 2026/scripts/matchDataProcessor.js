/*
  Match Data Processor
  Takes in match data from source and calculates averages and other derived data from it.
  Data types:
    jMatchData - the JSON parsed match data from our scouting database
    matchId - the string used to identify a match competition level and match number (e.g. qm5)
    matchTuple - a two entry tuple that identifies a match (e.g. ["qm", "5"])
*/
class matchDataProcessor {

  constructor(jMatchData) {
    this.mData = jMatchData;
    this.siteFilter = null;
    console.log("this.mData length: " + this.mData.length);
  }

  // Fix match IDs that are missing the comp level
  getFixedMatchId(matchId) {
    matchId = matchId.toLowerCase();
    if ((matchId.search("p") != -1) || (matchId.search("qm") != -1) ||
      (matchId.search("sf") != -1) || (matchId.search("f") != -1)) {
      return matchId;
    }
    else {  // Attempt to repair bad match IDs but log them
      console.warn("getMatchTuple: Invalid matchId! " + matchId);
      return "qm" + matchId;
    }
  }

  // Get the comp level and match number from the match ID string (ex. [qm, 25] from qm25)
  getMatchTuple(matchId) {
    matchId = this.getFixedMatchId(matchId);
    if (matchId.search("p") != -1) {
      return ["p", parseInt(matchId.substring(1))];
    }
    else if (matchId.search("qm") != -1) {
      return ["qm", parseInt(matchId.substring(2))];
    }
    else if (matchId.search("sf") != -1) {
      return ["sf", parseInt(matchId.substring(2))];
    }
    else if (matchId.search("f") != -1) {
      return ["f", parseInt(matchId.substring(1))];
    }
    else {  // Repair bad match IDs but report them
      console.warn("getMatchTuple: Invalid match prefix! " + matchId);
    }
    return null;
  }

  // Compare if second match ID is larget than first match ID
  isMatchLessThanOrEqual(startMatchId, endMatchId) {
    let smt = this.getMatchTuple(startMatchId);
    let emt = this.getMatchTuple(endMatchId);

    let compLevel = { "p": 0, "qm": 1, "sf": 3, "f": 4 };
    if (smt === null || emt === null) {
      return false;
    }
    if (compLevel[smt[0]] < compLevel[emt[0]]) {
      return true;
    }
    if (compLevel[smt[0]] > compLevel[emt[0]]) {
      return false;
    }
    return smt[1] <= emt[1];
  }

  // Compare if match ID string is within two match ID endpoints
  ifMatchInRange(startMatchId, matchId, endMatchId) {
    return this.isMatchLessThanOrEqual(startMatchId, matchId) && this.isMatchLessThanOrEqual(matchId, endMatchId);
  }

  // Filters out all matches in this.mData not within the specified range (destructively changes this.mData)
  filterMatchRange(startMatchId, endMatchId) {
    console.log("==> matchDataProcessor: filterMatchRange:");
    let newData = [];
    for (let i = 0; i < this.mData.length; i++) {
      let matchId = this.mData[i]["matchnumber"];
      if (this.ifMatchInRange(startMatchId, matchId, endMatchId)) {
        newData.push(this.mData[i]);
      }
    }
    this.mData = newData;
  }

  // Sorts the data by match number (ignores comp_level)
  sortMatches(newData) {
    console.log("==> matchDataProcessor: sortMatches:");
    newData.sort(function (a, b) {
      let compare = this.isMatchLessThanOrEqual(a["matchnumber"], b["matchnumber"]);
      return (compare) ? -1 : 1;
    });
  }

  //  Modify match data to only include matches specified by the site filter
  applySiteFilter() {
    console.log("==> matchDataProcessor: applySiteFilter:");
    let newData = [];
    for (let i = 0; i < this.mData.length; i++) {
      let matchId = this.mData[i]["matchnumber"];
      let mt = this.getMatchTuple(matchId);
      if (mt === null) {
        mt = ["qm", null];
      }
      if (mt[0] === "p" && this.siteFilter["useP"]) { newData.push(this.mData[i]); }
      else if (mt[0] === "qm" && this.siteFilter["useQm"]) { newData.push(this.mData[i]); }
      else if (mt[0] === "sf" && this.siteFilter["useSf"]) { newData.push(this.mData[i]); }
      else if (mt[0] === "f" && this.siteFilter["useF"]) { newData.push(this.mData[i]); }
    }
    this.mData = [...newData];
    console.log("this.mData length: " + this.mData.length + " (after filter)");
  }

  // Filters match data based on the retrieved site filter from DB config
  getSiteFilteredAverages(processorFunction) {
    console.log("==> matchDataProcessor: getSiteFilteredAverages:");
    let tempThis = this;
    $.post("api/dbAPI.php", {
      getDBStatus: true
    }, function (dbStatus) {
      console.log("==> getDBStatus");
      let jDbStatus = JSON.parse(dbStatus);
      let newSiteFilter = {};
      newSiteFilter["useP"] = jDbStatus["useP"];
      newSiteFilter["useQm"] = jDbStatus["useQm"];
      newSiteFilter["useSf"] = jDbStatus["useSf"];
      newSiteFilter["useF"] = jDbStatus["useF"];
      tempThis.siteFilter = { ...newSiteFilter };

      tempThis.applySiteFilter();

      processorFunction(tempThis.mData, tempThis.getEventAverages());
    });
  }

  // Returns the match data with all calculations
  getEventAverages() {
    console.log("==> matchDataProcessor: getEventAverages:");
    let pdata = {}; // to hold returning data for all matches and all teams

    // For each team, go thru all its matches and do the calculations for the averages data.
    for (let i = 0; i < this.mData.length; i++) {
      let tn = this.mData[i]["teamnumber"];
      // console.log("===> doing MDP calculations for team (" + i + "): " + tn);  // TEST

      if (!(tn in pdata)) {
        // If this team doesn't have any data stored yet, initialize its data array.
        pdata[tn] = {};

        // points by game phase
        pdata[tn]["totalPointsAvg"] = 0;
        pdata[tn]["totalPointsMax"] = 0;
        pdata[tn]["autonPointsAvg"] = 0;
        pdata[tn]["autonPointsMax"] = 0;
        pdata[tn]["teleopPointsAvg"] = 0;
        pdata[tn]["teleopPointsMax"] = 0;
        pdata[tn]["endgamePointsAvg"] = 0;
        pdata[tn]["endgamePointsMax"] = 0;

        // points by game piece
        pdata[tn]["totalCoralPointsAvg"] = 0;
        pdata[tn]["totalCoralPointsMax"] = 0;
        pdata[tn]["totalAlgaePointsAvg"] = 0;
        pdata[tn]["totalAlgaePointsMax"] = 0;

        pdata[tn]["autonCoralPointsAvg"] = 0;
        pdata[tn]["autonCoralPointsMax"] = 0;
        pdata[tn]["autonAlgaePointsAvg"] = 0;
        pdata[tn]["autonAlgaePointsMax"] = 0;
        pdata[tn]["teleopCoralPointsAvg"] = 0;
        pdata[tn]["teleopCoralPointsMax"] = 0;
        pdata[tn]["teleopAlgaePointsAvg"] = 0;
        pdata[tn]["teleopAlgaePointsMax"] = 0;

        // total game pieces
        pdata[tn]["totalCoralAvg"] = 0;
        pdata[tn]["totalCoralMax"] = 0;
        pdata[tn]["totalAlgaeAvg"] = 0;
        pdata[tn]["totalAlgaeMax"] = 0;

        // reef face
        pdata[tn]["reefzoneABpercent"] = 0;
        pdata[tn]["reefzoneCDpercent"] = 0;
        pdata[tn]["reefzoneEFpercent"] = 0;
        pdata[tn]["reefzoneGHpercent"] = 0;
        pdata[tn]["reefzoneIJpercent"] = 0;
        pdata[tn]["reefzoneKLpercent"] = 0;

        // auton coral
        pdata[tn]["autonCoralAvg"] = 0;
        pdata[tn]["autonCoralMax"] = 0;
        pdata[tn]["autonCoralL4Avg"] = 0;
        pdata[tn]["autonCoralL4Max"] = 0;
        pdata[tn]["autonCoralL3Avg"] = 0;
        pdata[tn]["autonCoralL3Max"] = 0;
        pdata[tn]["autonCoralL2Avg"] = 0;
        pdata[tn]["autonCoralL2Max"] = 0;
        pdata[tn]["autonCoralL1Avg"] = 0;
        pdata[tn]["autonCoralL1Max"] = 0;

        pdata[tn]["autonCoralPickupFloor"] = 0;
        pdata[tn]["autonCoralPickupStation"] = 0;
        pdata[tn]["autonStartPositionPercent"] = { 0: 0, 1: 0, 2: 0 };

        // auton algae
        pdata[tn]["autonAlgaeAvg"] = 0;
        pdata[tn]["autonAlgaeMax"] = 0;
        pdata[tn]["autonAlgaeProcAvg"] = 0;
        pdata[tn]["autonAlgaeProcMax"] = 0;
        pdata[tn]["autonAlgaeNetAvg"] = 0;
        pdata[tn]["autonAlgaeNetMax"] = 0;

        pdata[tn]["autonAlgaePickupFloor"] = 0;
        pdata[tn]["autonAlgaePickupReef"] = 0;

        // teleop coral
        pdata[tn]["teleopCoralPercent"] = 0;
        pdata[tn]["teleopCoralAvg"] = 0;
        pdata[tn]["teleopCoralMax"] = 0;
        pdata[tn]["teleopCoralL4Avg"] = 0;
        pdata[tn]["teleopCoralL4Max"] = 0;
        pdata[tn]["teleopCoralL3Avg"] = 0;
        pdata[tn]["teleopCoralL3Max"] = 0;
        pdata[tn]["teleopCoralL2Avg"] = 0;
        pdata[tn]["teleopCoralL2Max"] = 0;
        pdata[tn]["teleopCoralL1Avg"] = 0;
        pdata[tn]["teleopCoralL1Max"] = 0;

        pdata[tn]["teleopAcquireCoral"] = 0;    // for calculating shooting percentage
        pdata[tn]["teleopCoralFloorPickup"] = 0;

        // teleop algae
        pdata[tn]["teleopAlgaePercent"] = 0;
        pdata[tn]["teleopAlgaeAvg"] = 0;
        pdata[tn]["teleopAlgaeMax"] = 0;
        pdata[tn]["teleopAlgaeProcAvg"] = 0;
        pdata[tn]["teleopAlgaeProcMax"] = 0;
        pdata[tn]["teleopAlgaeNetAvg"] = 0;
        pdata[tn]["teleopAlgaeNetMax"] = 0;

        pdata[tn]["teleopAcquireAlgae"] = 0;   // for calculating shooting percentage
        pdata[tn]["teleopAlgaeFloorPickup"] = 0;
        pdata[tn]["teleopKnockOffAlgae"] = 0;
        pdata[tn]["teleopAcquireAlgaeFromReef"] = 0;
        pdata[tn]["teleopHoldTwoGamePieces"] = 0;

        // endgame
        pdata[tn]["endgameClimbPercent"] = { 0: 0, 1: 0, 2: 0, 3: 0, 4: 0 };
        pdata[tn]["endgameStartClimbingPercent"] = { 0: 0, 1: 0, 2: 0, 3: 0 };

        pdata[tn]["totaldied"] = 0;

        pdata[tn]["scoutnames"] = [];
        pdata[tn]["commentlist"] = [];
        pdata[tn]["totalmatches"] = 0;
      }

      // HOLD      console.log("  -> for match = "+ this.mData[i]["matchnumber"]); //TEST

      pdata[tn]["reefzoneABpercent"] += this.mData[i]["reefzoneAB"];
      pdata[tn]["reefzoneCDpercent"] += this.mData[i]["reefzoneCD"];
      pdata[tn]["reefzoneEFpercent"] += this.mData[i]["reefzoneEF"];
      pdata[tn]["reefzoneGHpercent"] += this.mData[i]["reefzoneGH"];
      pdata[tn]["reefzoneIJpercent"] += this.mData[i]["reefzoneIJ"];
      pdata[tn]["reefzoneKLpercent"] += this.mData[i]["reefzoneKL"];

      let autonLeave = (this.mData[i]["autonLeave"]);
      let autonLeavePoints = 0;
      if (parseInt(autonLeave) === 1) {
        autonLeavePoints = 3;
      }
      // HOLD      console.log(" --> auton Leave points = "+autonLeavePoints);  //TEST

      let currentAutonCoralL1 = (this.mData[i]["autonCoralL1"]);
      // HOLD      console.log(" --> auton coral L1 = "+currentAutonCoralL1);  //TEST
      let currentAutonCoralL2 = (this.mData[i]["autonCoralL2"]);
      // HOLD      console.log(" --> auton coral L2 = "+currentAutonCoralL2);  //TEST
      let currentAutonCoralL3 = (this.mData[i]["autonCoralL3"]);
      // HOLD      console.log(" --> auton coral L3 = "+currentAutonCoralL3);  //TEST
      let currentAutonCoralL4 = (this.mData[i]["autonCoralL4"]);
      // HOLD      console.log(" --> auton coral L4 = "+currentAutonCoralL4);  //TEST
      let currentAutonAlgaeNet = (this.mData[i]["autonAlgaeNet"]);
      // HOLD      console.log(" --> auton algae net = "+currentAutonAlgaeNet);  //TEST
      let currentAutonAlgaeProcessor = (this.mData[i]["autonAlgaeProcessor"]);
      // HOLD      console.log(" --> auton algae proc = "+currentAutonAlgaeProcessor);  //TEST

      let totalAutoCoral = parseInt(currentAutonCoralL1) + parseInt(currentAutonCoralL2) + parseInt(currentAutonCoralL3) + parseInt(currentAutonCoralL4);
      // HOLD      console.log(" --> total auton coral = "+totalAutoCoral);  //TEST

      let totalAutoCoralPoints = (parseInt(currentAutonCoralL1) * 3) + (parseInt(currentAutonCoralL2) * 4) + (parseInt(currentAutonCoralL3) * 6) + (parseInt(currentAutonCoralL4) * 7);
      // HOLD      console.log(" --> total auton coral pts = "+totalAutoCoralPoints);  //TEST

      let totalAutoAlgae = parseInt(currentAutonAlgaeNet) + parseInt(currentAutonAlgaeProcessor);
      let totalAutoAlgaePoints = (parseInt(currentAutonAlgaeNet) * 4) + (parseInt(currentAutonAlgaeProcessor) * 6);
      // HOLD      console.log(" --> total auton algae = "+totalAutoAlgae);  //TEST
      // HOLD      console.log(" --> total auton algae pts = "+totalAutoAlgaePoints);  //TEST

      let currentTeleopCoralL1 = (this.mData[i]["teleopCoralL1"]);
      let currentTeleopCoralL2 = (this.mData[i]["teleopCoralL2"]);
      let currentTeleopCoralL3 = (this.mData[i]["teleopCoralL3"]);
      let currentTeleopCoralL4 = (this.mData[i]["teleopCoralL4"]);
      let currentTeleopAlgaeNet = (this.mData[i]["teleopAlgaeNet"]);
      let currentTeleopAlgaeProcessor = (this.mData[i]["teleopAlgaeProcessor"]);

      let totalTeleopCoral = (parseInt(currentTeleopCoralL1)) + (parseInt(currentTeleopCoralL2)) + (parseInt(currentTeleopCoralL3)) + (parseInt(currentTeleopCoralL4));
      let totalTeleopCoralPoints = (parseInt(currentTeleopCoralL1) * 2) + (parseInt(currentTeleopCoralL2) * 3) + (parseInt(currentTeleopCoralL3) * 4) + (parseInt(currentTeleopCoralL4) * 5);
      // HOLD      console.log(" --> total teleop coral = "+totalTeleopCoral);  //TEST
      // HOLD      console.log(" --> total teleop coral pts = "+totalTeleopCoralPoints);  //TEST

      let totalTeleopAlgae = (parseInt(currentTeleopAlgaeNet)) + (parseInt(currentTeleopAlgaeProcessor));
      let totalTeleopAlgaePoints = (parseInt(currentTeleopAlgaeNet) * 4) + (parseInt(currentTeleopAlgaeProcessor) * 6);
      // HOLD      console.log(" --> total teleop algae = "+totalTeleopAlgae);  //TEST
      // HOLD      console.log(" --> total teleop algae pts = "+totalTeleopAlgaePoints);  //TEST

      let currentTeleopCoralAcquired = (this.mData[i]["acquiredCoral"]);
      let currentTeleopAlgaeAcquired = (this.mData[i]["acquiredAlgae"]);
      pdata[tn]["totalTeleopCoral"] += parseInt(totalTeleopCoral);
      pdata[tn]["teleopAcquireCoral"] += parseInt(currentTeleopCoralAcquired);
      pdata[tn]["totalTeleopAlgae"] += parseInt(totalTeleopAlgae);
      pdata[tn]["teleopAcquireAlgae"] += parseInt(currentTeleopAlgaeAcquired);

      let endgameClimbPoints = 0;
      let climbLevel = (this.mData[i]["cageClimb"]);
      switch (climbLevel) {
        case 1: endgameClimbPoints = 2; break;
        case 2: endgameClimbPoints = 2; break;
        case 3: endgameClimbPoints = 6; break;
        case 4: endgameClimbPoints = 12; break;
        default: endgameClimbPoints = 0; break;
      }
      // HOLD      console.log(" --> endgame climb points = "+endgameClimbPoints);  //TEST

      let totalCoral = totalAutoCoral + totalTeleopCoral;
      let totalAlgae = totalAutoAlgae + totalTeleopAlgae;
      let totalCoralPoints = totalAutoCoralPoints + totalTeleopCoralPoints;
      let totalAlgaePoints = totalAutoAlgaePoints + totalTeleopAlgaePoints;
      let totalAutoPoints = autonLeavePoints + totalAutoCoralPoints + totalAutoAlgaePoints;
      let totalTeleopPoints = totalTeleopCoralPoints + totalTeleopAlgaePoints;
      let totalPoints = totalAutoPoints + totalTeleopPoints + endgameClimbPoints;
      // HOLD      console.log("    ==> totalCoralPoints = "+totalCoralPoints);  //TEST
      // HOLD      console.log("    ==> totalAlgaePoints = "+totalAlgaePoints);  //TEST
      // HOLD      console.log("    ==> totalAutoPoints = "+totalAutoPoints);  //TEST
      // HOLD      console.log("    ==> totalTeleopPoints = "+totalTeleopPoints);  //TEST
      // HOLD      console.log("    ==> totalPoints = "+totalPoints);  //TEST

      pdata[tn]["totalPointsAvg"] += totalPoints;
      pdata[tn]["totalPointsMax"] = Math.max(pdata[tn]["totalPointsMax"], totalPoints);

      pdata[tn]["totalCoralPointsAvg"] += totalCoralPoints;
      pdata[tn]["totalCoralPointsMax"] = Math.max(pdata[tn]["totalCoralPointsMax"], totalCoralPoints);

      pdata[tn]["totalAlgaePointsAvg"] += totalAlgaePoints;
      pdata[tn]["totalAlgaePointsMax"] = Math.max(pdata[tn]["totalAlgaePointsMax"], totalAlgaePoints);

      pdata[tn]["totalCoralAvg"] += totalCoral;
      pdata[tn]["totalCoralMax"] = Math.max(pdata[tn]["totalCoralMax"], totalCoral);

      pdata[tn]["totalAlgaeAvg"] += totalAlgae;
      pdata[tn]["totalAlgaeMax"] = Math.max(pdata[tn]["totalAlgaeMax"], totalAlgae);

      pdata[tn]["autonPointsAvg"] += totalAutoPoints;
      pdata[tn]["autonPointsMax"] = Math.max(pdata[tn]["autonPointsMax"], totalAutoPoints);
      pdata[tn]["autonCoralPointsAvg"] += totalAutoCoralPoints;
      pdata[tn]["autonCoralPointsMax"] = Math.max(pdata[tn]["autonCoralPointsMax"], totalAutoCoralPoints);

      pdata[tn]["autonAlgaePointsAvg"] += totalAutoAlgaePoints;
      pdata[tn]["autonAlgaePointsMax"] = Math.max(pdata[tn]["autonAlgaePointsMax"], totalAutoAlgaePoints);

      pdata[tn]["teleopPointsAvg"] += totalTeleopPoints;
      pdata[tn]["teleopPointsMax"] = Math.max(pdata[tn]["teleopPointsMax"], totalTeleopPoints);

      pdata[tn]["teleopCoralPointsAvg"] += totalTeleopCoralPoints;
      pdata[tn]["teleopCoralPointsMax"] = Math.max(pdata[tn]["teleopCoralPointsMax"], totalTeleopCoralPoints);

      pdata[tn]["teleopAlgaePointsAvg"] += totalTeleopAlgaePoints;
      pdata[tn]["teleopAlgaePointsMax"] = Math.max(pdata[tn]["teleopAlgaePointsMax"], totalTeleopAlgaePoints);

      pdata[tn]["endgamePointsAvg"] += endgameClimbPoints;
      pdata[tn]["endgamePointsMax"] = Math.max(pdata[tn]["endgamePointsMax"], endgameClimbPoints);

      let currentAutonCoral = (parseInt(totalAutoCoral));
      pdata[tn]["autonCoralAvg"] += currentAutonCoral;
      pdata[tn]["autonCoralMax"] = Math.max(pdata[tn]["autonCoralMax"], currentAutonCoral);

      let currentAutonAlgae = (parseInt(totalAutoAlgae));
      pdata[tn]["autonAlgaeAvg"] += currentAutonAlgae;
      pdata[tn]["autonAlgaeMax"] = Math.max(pdata[tn]["autonAlgaeMax"], currentAutonAlgae);

      let currentTeleopCoral = (parseInt(totalTeleopCoral));
      pdata[tn]["teleopCoralAvg"] += currentTeleopCoral;
      pdata[tn]["teleopCoralMax"] = Math.max(pdata[tn]["teleopCoralMax"], currentTeleopCoral);

      let currentTeleopAlgae = (parseInt(totalTeleopAlgae));
      pdata[tn]["teleopAlgaeAvg"] += currentTeleopAlgae;
      pdata[tn]["teleopAlgaeMax"] = Math.max(pdata[tn]["teleopAlgaeMax"], currentTeleopAlgae);

      pdata[tn]["autonCoralL1Avg"] += currentAutonCoralL1;
      pdata[tn]["autonCoralL2Avg"] += currentAutonCoralL2;
      pdata[tn]["autonCoralL3Avg"] += currentAutonCoralL3;
      pdata[tn]["autonCoralL4Avg"] += currentAutonCoralL4;

      pdata[tn]["autonCoralL1Max"] = Math.max(pdata[tn]["autonCoralL1Max"], currentAutonCoralL1);
      pdata[tn]["autonCoralL2Max"] = Math.max(pdata[tn]["autonCoralL2Max"], currentAutonCoralL2);
      pdata[tn]["autonCoralL3Max"] = Math.max(pdata[tn]["autonCoralL3Max"], currentAutonCoralL3);
      pdata[tn]["autonCoralL4Max"] = Math.max(pdata[tn]["autonCoralL4Max"], currentAutonCoralL4);

      pdata[tn]["autonAlgaeNetAvg"] += currentAutonAlgaeNet;
      pdata[tn]["autonAlgaeProcAvg"] += currentAutonAlgaeProcessor;

      pdata[tn]["autonAlgaeNetMax"] = Math.max(pdata[tn]["autonAlgaeNetMax"], currentAutonAlgaeNet);
      pdata[tn]["autonAlgaeProcMax"] = Math.max(pdata[tn]["autonAlgaeProcMax"], currentAutonAlgaeProcessor);

      pdata[tn]["teleopCoralL1Avg"] += currentTeleopCoralL1;
      pdata[tn]["teleopCoralL2Avg"] += currentTeleopCoralL2;
      pdata[tn]["teleopCoralL3Avg"] += currentTeleopCoralL3;
      pdata[tn]["teleopCoralL4Avg"] += currentTeleopCoralL4;

      pdata[tn]["teleopCoralL1Max"] = Math.max(pdata[tn]["teleopCoralL1Max"], currentTeleopCoralL1);
      pdata[tn]["teleopCoralL2Max"] = Math.max(pdata[tn]["teleopCoralL2Max"], currentTeleopCoralL2);
      pdata[tn]["teleopCoralL3Max"] = Math.max(pdata[tn]["teleopCoralL3Max"], currentTeleopCoralL3);
      pdata[tn]["teleopCoralL4Max"] = Math.max(pdata[tn]["teleopCoralL4Max"], currentTeleopCoralL4);

      pdata[tn]["teleopAlgaeNetAvg"] += currentTeleopAlgaeNet;
      pdata[tn]["teleopAlgaeProcAvg"] += currentTeleopAlgaeProcessor;

      pdata[tn]["teleopAlgaeNetMax"] = Math.max(pdata[tn]["teleopAlgaeNetMax"], currentTeleopAlgaeNet);
      pdata[tn]["teleopAlgaeProcMax"] = Math.max(pdata[tn]["teleopAlgaeProcMax"], currentTeleopAlgaeProcessor);
      // For boolean data, we are just incrementing that data instead of adding the value here.
      pdata[tn]["endgameClimbPercent"][this.mData[i]["cageClimb"]] += 1;
      // HOLD pdata[tn]["endgameStartClimbPercent"][this.mData[i]["endgameStartClimbing"]] += 1;

      pdata[tn]["totaldied"] += this.mData[i]["died"];
      pdata[tn]["totalmatches"] += 1;
      pdata[tn]["scoutnames"].push(this.mData[i]["scoutname"]);
      pdata[tn]["commentlist"].push(this.mData[i]["comment"]);
    }

    // Go thru each team in pdata and do the avg, max and percent calculations.
    for (let key in pdata) {
      // console.log("===> doing MDP averages, max for team: " + key);  // TEST
      // HOLD      console.log(">>>> Calculations for team " + key);
      // Calculate the accuracy percentage before the actual AVG is calculated.
      let totalCoralAcquired = (parseInt(pdata[key]["teleopAcquireCoral"]));
      // HOLD      console.log("  ---> total (teleop) coral acquired: " + totalCoralAcquired); //TEST
      // If there are no coral acq'd, don't bother doing the calculation here.
      if (totalCoralAcquired != 0) {
        let teleopCoralPercent = (parseInt(pdata[key]["teleopCoralAvg"])) / totalCoralAcquired;
        pdata[key]["teleopCoralPercent"] = Math.round(100 * teleopCoralPercent);
        // HOLD        console.log("   ---> Coral Scoring Percentage: " + pdata[key]["teleopCoralPercent"]); //TEST
      }
      let totalAlgaeAcquired = (parseInt(pdata[key]["teleopAcquireAlgae"]));
      // HOLD      console.log("  ---> total (teleop) algae acquired: " + totalAlgaeAcquired); //TEST
      // If there are no algae acquired, don't bother doing the calculation here.
      if (totalAlgaeAcquired != 0) {
        let teleopAlgaePercent = (parseInt(pdata[key]["teleopAlgaeAvg"])) / totalAlgaeAcquired;
        pdata[key]["teleopAlgaePercent"] = Math.round(100 * teleopAlgaePercent);
        // HOLD        console.log("   ---> Algae Scoring Percentage: " + pdata[key]["teleopAlgaePercent"]); //TEST
      }

      pdata[key]["reefzoneABpercent"] = Math.round(100 * pdata[key]["reefzoneABpercent"] / pdata[key]["totalmatches"]);
      pdata[key]["reefzoneCDpercent"] = Math.round(100 * pdata[key]["reefzoneCDpercent"] / pdata[key]["totalmatches"]);
      pdata[key]["reefzoneEFpercent"] = Math.round(100 * pdata[key]["reefzoneEFpercent"] / pdata[key]["totalmatches"]);
      pdata[key]["reefzoneGHpercent"] = Math.round(100 * pdata[key]["reefzoneGHpercent"] / pdata[key]["totalmatches"]);
      pdata[key]["reefzoneIJpercent"] = Math.round(100 * pdata[key]["reefzoneIJpercent"] / pdata[key]["totalmatches"]);
      pdata[key]["reefzoneKLpercent"] = Math.round(100 * pdata[key]["reefzoneKLpercent"] / pdata[key]["totalmatches"]);

      // points by game phase
      pdata[key]["totalPointsAvg"] = Math.round(10 * pdata[key]["totalPointsAvg"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["autonPointsAvg"] = Math.round(10 * pdata[key]["autonPointsAvg"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["autonCoralPointsAvg"] = Math.round(10 * pdata[key]["autonCoralPointsAvg"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["autonAlgaePointsAvg"] = Math.round(10 * pdata[key]["autonAlgaePointsAvg"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["teleopPointsAvg"] = Math.round(10 * pdata[key]["teleopPointsAvg"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["teleopCoralPointsAvg"] = Math.round(10 * pdata[key]["teleopCoralPointsAvg"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["teleopAlgaePointsAvg"] = Math.round(10 * pdata[key]["teleopAlgaePointsAvg"] / pdata[key]["totalmatches"]) / 10;

      // points by game piece
      pdata[key]["totalCoralPointsAvg"] = Math.round(10 * pdata[key]["totalCoralPointsAvg"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["totalAlgaePointsAvg"] = Math.round(10 * pdata[key]["totalAlgaePointsAvg"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["totalCoralAvg"] = Math.round(10 * pdata[key]["totalCoralAvg"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["totalAlgaeAvg"] = Math.round(10 * pdata[key]["totalAlgaeAvg"] / pdata[key]["totalmatches"]) / 10;

      // total auton
      pdata[key]["autonCoralAvg"] = Math.round(10 * pdata[key]["autonCoralAvg"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["autonAlgaeAvg"] = Math.round(10 * pdata[key]["autonAlgaeAvg"] / pdata[key]["totalmatches"]) / 10;

      // total teleop
      pdata[key]["teleopCoralAvg"] = Math.round(10 * pdata[key]["teleopCoralAvg"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["teleopAlgaeAvg"] = Math.round(10 * pdata[key]["teleopAlgaeAvg"] / pdata[key]["totalmatches"]) / 10;

      pdata[key]["endgamePointsAvg"] = Math.round(10 * pdata[key]["endgamePointsAvg"] / pdata[key]["totalmatches"]) / 10;

      // auton coral
      pdata[key]["autonCoralL4Avg"] = Math.round(10 * pdata[key]["autonCoralL4Avg"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["autonCoralL3Avg"] = Math.round(10 * pdata[key]["autonCoralL3Avg"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["autonCoralL2Avg"] = Math.round(10 * pdata[key]["autonCoralL2Avg"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["autonCoralL1Avg"] = Math.round(10 * pdata[key]["autonCoralL1Avg"] / pdata[key]["totalmatches"]) / 10;

      // auton algae
      pdata[key]["autonAlgaeProcAvg"] = Math.round(10 * pdata[key]["autonAlgaeProcAvg"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["autonAlgaeNetAvg"] = Math.round(10 * pdata[key]["autonAlgaeNetAvg"] / pdata[key]["totalmatches"]) / 10;

      // teleop coral
      pdata[key]["teleopCoralL4Avg"] = Math.round(10 * pdata[key]["teleopCoralL4Avg"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["teleopCoralL3Avg"] = Math.round(10 * pdata[key]["teleopCoralL3Avg"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["teleopCoralL2Avg"] = Math.round(10 * pdata[key]["teleopCoralL2Avg"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["teleopCoralL1Avg"] = Math.round(10 * pdata[key]["teleopCoralL1Avg"] / pdata[key]["totalmatches"]) / 10;

      // teleop algae
      pdata[key]["teleopAlgaeProcAvg"] = Math.round(10 * pdata[key]["teleopAlgaeProcAvg"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["teleopAlgaeNetAvg"] = Math.round(10 * pdata[key]["teleopAlgaeNetAvg"] / pdata[key]["totalmatches"]) / 10;

      // endgame
      pdata[key]["endgameClimbPercent"][0] = Math.round(100 * pdata[key]["endgameClimbPercent"][0] / pdata[key]["totalmatches"]);
      pdata[key]["endgameClimbPercent"][1] = Math.round(100 * pdata[key]["endgameClimbPercent"][1] / pdata[key]["totalmatches"]);
      pdata[key]["endgameClimbPercent"][2] = Math.round(100 * pdata[key]["endgameClimbPercent"][2] / pdata[key]["totalmatches"]);
      pdata[key]["endgameClimbPercent"][3] = Math.round(100 * pdata[key]["endgameClimbPercent"][3] / pdata[key]["totalmatches"]);
      pdata[key]["endgameClimbPercent"][4] = Math.round(100 * pdata[key]["endgameClimbPercent"][4] / pdata[key]["totalmatches"]);

      pdata[key]["endgameStartClimbingPercent"][0] = Math.round(100 * pdata[key]["endgameStartClimbingPercent"][0] / pdata[key]["totalmatches"]);
      pdata[key]["endgameStartClimbingPercent"][1] = Math.round(100 * pdata[key]["endgameStartClimbingPercent"][1] / pdata[key]["totalmatches"]);
      pdata[key]["endgameStartClimbingPercent"][2] = Math.round(100 * pdata[key]["endgameStartClimbingPercent"][2] / pdata[key]["totalmatches"]);
      pdata[key]["endgameStartClimbingPercent"][3] = Math.round(100 * pdata[key]["endgameStartClimbingPercent"][3] / pdata[key]["totalmatches"]);

    }
    return pdata;
  }
}
