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

  // Convert to integer percent (no decimal digits)
  toPercent(val) {
    return Math.round(100 * val);
  }

  // Round data to no more than one decimal digit
  roundOnePlace(val) {
    return Math.round((val + Number.EPSILON) * 10) / 10;
  }

  // Round data to no more than two decimal digits
  roundTwoPlaces(val) {
    return Math.round((val + Number.EPSILON) * 100) / 100;
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

    // Process the each match
    //    For each team, go thru all its matches and do the calculations for the averages data.
    for (let i = 0; i < this.mData.length; i++) {
      let tn = this.mData[i]["teamnumber"];
      // console.log("===> doing MDP calculations for team (" + i + "): " + tn);  // TEST

      // If this team doesn't have any data stored yet, initialize its data array.
      if (!(tn in pdata)) {
        pdata[tn] = {};
        // No need to initialize individual data fields here -- just the match index
        pdata[tn]["totalmatches"] = 0;

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
      }
      // HOLD      console.log("  -> for match = "+ this.mData[i]["matchnumber"]); // TEST

      //////////////////// AUTON ////////////////////

      let currentAutonCoralL4 = parseInt(this.mData[i]["autonCoralL4"]);
      let currentAutonCoralL3 = parseInt(this.mData[i]["autonCoralL3"]);
      let currentAutonCoralL2 = parseInt(this.mData[i]["autonCoralL2"]);
      let currentAutonCoralL1 = parseInt(this.mData[i]["autonCoralL1"]);
      // HOLD      console.log(" --> auton coral L4 = "+currentAutonCoralL4);  // TEST
      // HOLD      console.log(" --> auton coral L3 = "+currentAutonCoralL3);  // TEST
      // HOLD      console.log(" --> auton coral L2 = "+currentAutonCoralL2);  // TEST
      // HOLD      console.log(" --> auton coral L1 = "+currentAutonCoralL1);  // TEST
      let currentAutonAlgaeProcessor = parseInt(this.mData[i]["autonAlgaeProcessor"]);
      let currentAutonAlgaeNet = parseInt(this.mData[i]["autonAlgaeNet"]);
      // HOLD      console.log(" --> auton algae proc = "+currentAutonAlgaeProcessor);  // TEST
      // HOLD      console.log(" --> auton algae net = "+currentAutonAlgaeNet);  // TEST
      let totalAutoCoral = currentAutonCoralL1 + currentAutonCoralL2 + currentAutonCoralL3 + currentAutonCoralL4;
      let totalAutoAlgae = currentAutonAlgaeNet + currentAutonAlgaeProcessor;
      // HOLD      console.log(" --> total auton coral = "+totalAutoCoral);  // TEST
      // HOLD      console.log(" --> total auton algae = "+totalAutoAlgae);  // TEST

      //////////////////// TELEOP ////////////////////

      let currentTeleopCoralL1 = parseInt(this.mData[i]["teleopCoralL1"]);
      let currentTeleopCoralL2 = parseInt(this.mData[i]["teleopCoralL2"]);
      let currentTeleopCoralL3 = parseInt(this.mData[i]["teleopCoralL3"]);
      let currentTeleopCoralL4 = parseInt(this.mData[i]["teleopCoralL4"]);
      // HOLD      console.log(" --> teleop coral L4 = "+currentTeleopCoralL4);  // TEST
      // HOLD      console.log(" --> teleop coral L3 = "+currentTeleopCoralL3);  // TEST
      // HOLD      console.log(" --> teleop coral L2 = "+currentTeleopCoralL2);  // TEST
      // HOLD      console.log(" --> teleop coral L1 = "+currentTeleopCoralL1);  // TEST
      let currentTeleopAlgaeProcessor = parseInt(this.mData[i]["teleopAlgaeProcessor"]);
      let currentTeleopAlgaeNet = parseInt(this.mData[i]["teleopAlgaeNet"]);
      // HOLD      console.log(" --> teleop algae proc = "+currentTeleopAlgaeProcessor);  // TEST
      // HOLD      console.log(" --> teleop algae net = "+currentTeleopAlgaeNet);  // TEST

      let currentTeleopCoralAcquired = parseInt(this.mData[i]["acquiredCoral"]);
      let currentTeleopAlgaeAcquired = parseInt(this.mData[i]["acquiredAlgae"]);

      //////////////////// ENDGAME ////////////////////

      let climbLevel = parseInt(this.mData[i]["cageClimb"]);

      //////////////////// MATCH TOTALS ////////////////////

      let totalTeleopCoral = currentTeleopCoralL1 + currentTeleopCoralL2 + currentTeleopCoralL3 + currentTeleopCoralL4;
      let totalTeleopAlgae = currentTeleopAlgaeNet + currentTeleopAlgaeProcessor;
      // HOLD      console.log(" --> total teleop coral = "+totalTeleopCoral);  // TEST
      // HOLD      console.log(" --> total teleop algae = "+totalTeleopAlgae);  // TEST

      let totalCoral = totalAutoCoral + totalTeleopCoral;
      let totalAlgae = totalAutoAlgae + totalTeleopAlgae;

      //////////////////// POINT TOTALS ////////////////////

      let autonLeave = parseInt(this.mData[i]["autonLeave"]);
      let autonLeavePoints = 0;
      if (autonLeave === 1) {
        autonLeavePoints = 3;
      }
      // HOLD      console.log(" --> auton Leave points = "+autonLeavePoints);  // TEST

      let totalAutoCoralPoints = (currentAutonCoralL1 * 3) + (currentAutonCoralL2 * 4) + (currentAutonCoralL3 * 6) + (currentAutonCoralL4 * 7);
      let totalAutoAlgaePoints = (currentAutonAlgaeNet * 4) + (currentAutonAlgaeProcessor * 6);
      // HOLD      console.log(" --> total auton coral pts = "+totalAutoCoralPoints);  // TEST
      // HOLD      console.log(" --> total auton algae pts = "+totalAutoAlgaePoints);  // TEST

      let totalTeleopCoralPoints = (currentTeleopCoralL1 * 2) + (currentTeleopCoralL2 * 3) + (currentTeleopCoralL3 * 4) + (currentTeleopCoralL4 * 5);
      let totalTeleopAlgaePoints = (currentTeleopAlgaeNet * 4) + (currentTeleopAlgaeProcessor * 6);
      // HOLD      console.log(" --> total teleop coral pts = "+totalTeleopCoralPoints);  // TEST
      // HOLD      console.log(" --> total teleop algae pts = "+totalTeleopAlgaePoints);  // TEST

      let endgameClimbPoints = 0;
      switch (climbLevel) {
        case 1: endgameClimbPoints = 2; break;  // Fell
        case 2: endgameClimbPoints = 2; break;  // Park
        case 3: endgameClimbPoints = 6; break;  // Shallow
        case 4: endgameClimbPoints = 12; break; // Deep
        default: endgameClimbPoints = 0; break; // No climb
      }
      // HOLD      console.log(" --> endgame climb points = "+endgameClimbPoints);  // TEST

      let totalCoralPoints = totalAutoCoralPoints + totalTeleopCoralPoints;
      let totalAlgaePoints = totalAutoAlgaePoints + totalTeleopAlgaePoints;
      let totalAutoPoints = autonLeavePoints + totalAutoCoralPoints + totalAutoAlgaePoints;
      let totalTeleopPoints = totalTeleopCoralPoints + totalTeleopAlgaePoints;
      let totalPoints = totalAutoPoints + totalTeleopPoints + endgameClimbPoints;
      // HOLD      console.log("    ==> totalCoralPoints = "+totalCoralPoints);  // TEST
      // HOLD      console.log("    ==> totalAlgaePoints = "+totalAlgaePoints);  // TEST
      // HOLD      console.log("    ==> totalAutoPoints = "+totalAutoPoints);  // TEST
      // HOLD      console.log("    ==> totalTeleopPoints = "+totalTeleopPoints);  // TEST
      // HOLD      console.log("    ==> totalPoints = "+totalPoints);  // TEST

      //////////////////// PROCESSED DATA ////////////////////

      pdata[tn]["totalmatches"] += 1;

      // Points - accumulate in average data and find each max

      pdata[tn]["totalPointsAvg"] += totalPoints;
      pdata[tn]["totalPointsMax"] = Math.max(pdata[tn]["totalPointsMax"], totalPoints);

      pdata[tn]["autonPointsAvg"] += totalAutoPoints;
      pdata[tn]["autonPointsMax"] = Math.max(pdata[tn]["autonPointsMax"], totalAutoPoints);

      pdata[tn]["teleopPointsAvg"] += totalTeleopPoints;
      pdata[tn]["teleopPointsMax"] = Math.max(pdata[tn]["teleopPointsMax"], totalTeleopPoints);

      pdata[tn]["endgamePointsAvg"] += endgameClimbPoints;
      pdata[tn]["endgamePointsMax"] = Math.max(pdata[tn]["endgamePointsMax"], endgameClimbPoints);

      pdata[tn]["totalCoralPointsAvg"] += totalCoralPoints;
      pdata[tn]["totalCoralPointsMax"] = Math.max(pdata[tn]["totalCoralPointsMax"], totalCoralPoints);

      pdata[tn]["totalAlgaePointsAvg"] += totalAlgaePoints;
      pdata[tn]["totalAlgaePointsMax"] = Math.max(pdata[tn]["totalAlgaePointsMax"], totalAlgaePoints);

      pdata[tn]["autonCoralPointsAvg"] += totalAutoCoralPoints;
      pdata[tn]["autonCoralPointsMax"] = Math.max(pdata[tn]["autonCoralPointsMax"], totalAutoCoralPoints);

      pdata[tn]["autonAlgaePointsAvg"] += totalAutoAlgaePoints;
      pdata[tn]["autonAlgaePointsMax"] = Math.max(pdata[tn]["autonAlgaePointsMax"], totalAutoAlgaePoints);

      pdata[tn]["teleopCoralPointsAvg"] += totalTeleopCoralPoints;
      pdata[tn]["teleopCoralPointsMax"] = Math.max(pdata[tn]["teleopCoralPointsMax"], totalTeleopCoralPoints);

      pdata[tn]["teleopAlgaePointsAvg"] += totalTeleopAlgaePoints;
      pdata[tn]["teleopAlgaePointsMax"] = Math.max(pdata[tn]["teleopAlgaePointsMax"], totalTeleopAlgaePoints);

      // By game piece

      pdata[tn]["totalCoralAvg"] += totalCoral;
      pdata[tn]["totalCoralMax"] = Math.max(pdata[tn]["totalCoralMax"], totalCoral);
      pdata[tn]["totalAlgaeAvg"] += totalAlgae;
      pdata[tn]["totalAlgaeMax"] = Math.max(pdata[tn]["totalAlgaeMax"], totalAlgae);

      pdata[tn]["totalTeleopCoral"] += totalTeleopCoral;
      pdata[tn]["totalTeleopAlgae"] += totalTeleopAlgae;
      pdata[tn]["teleopCoralAcquired"] += currentTeleopCoralAcquired;
      pdata[tn]["teleopAlgaeAcquired"] += currentTeleopAlgaeAcquired;

      pdata[tn]["autonCoralAvg"] += totalAutoCoral;
      pdata[tn]["autonCoralMax"] = Math.max(pdata[tn]["autonCoralMax"], totalAutoCoral);
      pdata[tn]["autonAlgaeAvg"] += totalAutoAlgae;
      pdata[tn]["autonAlgaeMax"] = Math.max(pdata[tn]["autonAlgaeMax"], totalAutoAlgae);

      pdata[tn]["teleopCoralAvg"] += totalTeleopCoral;
      pdata[tn]["teleopCoralMax"] = Math.max(pdata[tn]["teleopCoralMax"], totalTeleopCoral);
      pdata[tn]["teleopAlgaeAvg"] += totalTeleopAlgae;
      pdata[tn]["teleopAlgaeMax"] = Math.max(pdata[tn]["teleopAlgaeMax"], totalTeleopAlgae);

      // Individual game phase by match phase

      pdata[tn]["autonCoralL1Avg"] += currentAutonCoralL1;
      pdata[tn]["autonCoralL1Max"] = Math.max(pdata[tn]["autonCoralL1Max"], currentAutonCoralL1);
      pdata[tn]["autonCoralL2Avg"] += currentAutonCoralL2;
      pdata[tn]["autonCoralL2Max"] = Math.max(pdata[tn]["autonCoralL2Max"], currentAutonCoralL2);
      pdata[tn]["autonCoralL3Avg"] += currentAutonCoralL3;
      pdata[tn]["autonCoralL3Max"] = Math.max(pdata[tn]["autonCoralL3Max"], currentAutonCoralL3);
      pdata[tn]["autonCoralL4Avg"] += currentAutonCoralL4;
      pdata[tn]["autonCoralL4Max"] = Math.max(pdata[tn]["autonCoralL4Max"], currentAutonCoralL4);

      pdata[tn]["autonAlgaeNetAvg"] += currentAutonAlgaeNet;
      pdata[tn]["autonAlgaeNetMax"] = Math.max(pdata[tn]["autonAlgaeNetMax"], currentAutonAlgaeNet);
      pdata[tn]["autonAlgaeProcAvg"] += currentAutonAlgaeProcessor;
      pdata[tn]["autonAlgaeProcMax"] = Math.max(pdata[tn]["autonAlgaeProcMax"], currentAutonAlgaeProcessor);

      pdata[tn]["teleopCoralL1Avg"] += currentTeleopCoralL1;
      pdata[tn]["teleopCoralL1Max"] = Math.max(pdata[tn]["teleopCoralL1Max"], currentTeleopCoralL1);
      pdata[tn]["teleopCoralL2Avg"] += currentTeleopCoralL2;
      pdata[tn]["teleopCoralL2Max"] = Math.max(pdata[tn]["teleopCoralL2Max"], currentTeleopCoralL2);
      pdata[tn]["teleopCoralL3Avg"] += currentTeleopCoralL3;
      pdata[tn]["teleopCoralL3Max"] = Math.max(pdata[tn]["teleopCoralL3Max"], currentTeleopCoralL3);
      pdata[tn]["teleopCoralL4Avg"] += currentTeleopCoralL4;
      pdata[tn]["teleopCoralL4Max"] = Math.max(pdata[tn]["teleopCoralL4Max"], currentTeleopCoralL4);

      pdata[tn]["teleopAlgaeNetAvg"] += currentTeleopAlgaeNet;
      pdata[tn]["teleopAlgaeNetMax"] = Math.max(pdata[tn]["teleopAlgaeNetMax"], currentTeleopAlgaeNet);
      pdata[tn]["teleopAlgaeProcAvg"] += currentTeleopAlgaeProcessor;
      pdata[tn]["teleopAlgaeProcMax"] = Math.max(pdata[tn]["teleopAlgaeProcMax"], currentTeleopAlgaeProcessor);

      // For boolean data, we are just incrementing that data instead of adding the value here.
      pdata[tn]["endgameClimbPercent"][this.mData[i]["cageClimb"]] += 1;
      // HOLD pdata[tn]["endgameStartClimbPercent"][this.mData[i]["endgameStartClimbing"]] += 1;

      // Text data for matches

      pdata[tn]["totaldied"] += this.mData[i]["died"];
      pdata[tn]["scoutnames"].push(this.mData[i]["scoutname"]);
      pdata[tn]["commentlist"].push(this.mData[i]["comment"]);
    }

    //////////////////// CALCULATE AVERAGES USING TOTAL MATCH COUNT ////////////////////

    // Go thru each team in pdata and do the avg and percent calculations.
    for (let key in pdata) {
      // console.log("===> doing MDP averages, max for team: " + key);  // TEST

      // Divide total scored by number of matches. Avoid divide by zero
      let teleopCoralAcquired = parseInt(pdata[key]["teleopCoralAcquired"]);
      pdata[key]["teleopCoralPercent"] = 0;
      if (teleopCoralAcquired !== 0) {
        pdata[key]["teleopCoralPercent"] = this.toPercent(pdata[key]["teleopCoralAvg"]) / teleopCoralAcquired;
      }

      // Divide total scored by number of matches. Avoid divide by zero
      let teleopAlgaeAcquired = parseInt(pdata[key]["teleopAlgaeAcquired"]);
      pdata[key]["teleopAlgaePercent"] = 0;
      if (teleopAlgaeAcquired !== 0) {
        pdata[key]["teleopAlgaePercent"] = this.toPercent((pdata[key]["teleopAlgaeAvg"])) / teleopAlgaeAcquired;
      }
      // HOLD      console.log("  ---> total (teleop) coral acquired: " + teleopCoralAcquired); // TEST
      // HOLD      console.log("  ---> Coral Scoring Percentage: " + pdata[key]["teleopCoralPercent"]); // TEST
      // HOLD      console.log("  ---> total (teleop) algae acquired: " + teleopAlgaeAcquired); // TEST
      // HOLD      console.log("  ---> Algae Scoring Percentage: " + pdata[key]["teleopAlgaePercent"]); // TEST

      // points by game phase
      pdata[key]["totalPointsAvg"] = this.roundOnePlace(pdata[key]["totalPointsAvg"] / pdata[key]["totalmatches"]);
      pdata[key]["autonPointsAvg"] = this.roundOnePlace(pdata[key]["autonPointsAvg"] / pdata[key]["totalmatches"]);
      pdata[key]["autonCoralPointsAvg"] = this.roundOnePlace(pdata[key]["autonCoralPointsAvg"] / pdata[key]["totalmatches"]);
      pdata[key]["autonAlgaePointsAvg"] = this.roundOnePlace(pdata[key]["autonAlgaePointsAvg"] / pdata[key]["totalmatches"]);
      pdata[key]["teleopPointsAvg"] = this.roundOnePlace(pdata[key]["teleopPointsAvg"] / pdata[key]["totalmatches"]);
      pdata[key]["teleopCoralPointsAvg"] = this.roundOnePlace(pdata[key]["teleopCoralPointsAvg"] / pdata[key]["totalmatches"]);
      pdata[key]["teleopAlgaePointsAvg"] = this.roundOnePlace(pdata[key]["teleopAlgaePointsAvg"] / pdata[key]["totalmatches"]);

      // points by game piece
      pdata[key]["totalCoralPointsAvg"] = this.roundOnePlace(pdata[key]["totalCoralPointsAvg"] / pdata[key]["totalmatches"]);
      pdata[key]["totalAlgaePointsAvg"] = this.roundOnePlace(pdata[key]["totalAlgaePointsAvg"] / pdata[key]["totalmatches"]);
      pdata[key]["totalCoralAvg"] = this.roundOnePlace(pdata[key]["totalCoralAvg"] / pdata[key]["totalmatches"]);
      pdata[key]["totalAlgaeAvg"] = this.roundOnePlace(pdata[key]["totalAlgaeAvg"] / pdata[key]["totalmatches"]);

      // total auton
      pdata[key]["autonCoralAvg"] = this.roundOnePlace(pdata[key]["autonCoralAvg"] / pdata[key]["totalmatches"]);
      pdata[key]["autonAlgaeAvg"] = this.roundOnePlace(pdata[key]["autonAlgaeAvg"] / pdata[key]["totalmatches"]);

      // total teleop
      pdata[key]["teleopCoralAvg"] = this.roundOnePlace(pdata[key]["teleopCoralAvg"] / pdata[key]["totalmatches"]);
      pdata[key]["teleopAlgaeAvg"] = this.roundOnePlace(pdata[key]["teleopAlgaeAvg"] / pdata[key]["totalmatches"]);

      pdata[key]["endgamePointsAvg"] = this.roundOnePlace(pdata[key]["endgamePointsAvg"] / pdata[key]["totalmatches"]);

      // auton coral
      pdata[key]["autonCoralL4Avg"] = this.roundOnePlace(pdata[key]["autonCoralL4Avg"] / pdata[key]["totalmatches"]);
      pdata[key]["autonCoralL3Avg"] = this.roundOnePlace(pdata[key]["autonCoralL3Avg"] / pdata[key]["totalmatches"]);
      pdata[key]["autonCoralL2Avg"] = this.roundOnePlace(pdata[key]["autonCoralL2Avg"] / pdata[key]["totalmatches"]);
      pdata[key]["autonCoralL1Avg"] = this.roundOnePlace(pdata[key]["autonCoralL1Avg"] / pdata[key]["totalmatches"]);

      // auton algae
      pdata[key]["autonAlgaeProcAvg"] = this.roundOnePlace(pdata[key]["autonAlgaeProcAvg"] / pdata[key]["totalmatches"]);
      pdata[key]["autonAlgaeNetAvg"] = this.roundOnePlace(pdata[key]["autonAlgaeNetAvg"] / pdata[key]["totalmatches"]);

      // teleop coral
      pdata[key]["teleopCoralL4Avg"] = this.roundOnePlace(pdata[key]["teleopCoralL4Avg"] / pdata[key]["totalmatches"]);
      pdata[key]["teleopCoralL3Avg"] = this.roundOnePlace(pdata[key]["teleopCoralL3Avg"] / pdata[key]["totalmatches"]);
      pdata[key]["teleopCoralL2Avg"] = this.roundOnePlace(pdata[key]["teleopCoralL2Avg"] / pdata[key]["totalmatches"]);
      pdata[key]["teleopCoralL1Avg"] = this.roundOnePlace(pdata[key]["teleopCoralL1Avg"] / pdata[key]["totalmatches"]);

      // teleop algae
      pdata[key]["teleopAlgaeProcAvg"] = this.roundOnePlace(pdata[key]["teleopAlgaeProcAvg"] / pdata[key]["totalmatches"]);
      pdata[key]["teleopAlgaeNetAvg"] = this.roundOnePlace(pdata[key]["teleopAlgaeNetAvg"] / pdata[key]["totalmatches"]);

      // endgame
      pdata[key]["endgameClimbPercent"][0] = this.toPercent(pdata[key]["endgameClimbPercent"][0] / pdata[key]["totalmatches"]);
      pdata[key]["endgameClimbPercent"][1] = this.toPercent(pdata[key]["endgameClimbPercent"][1] / pdata[key]["totalmatches"]);
      pdata[key]["endgameClimbPercent"][2] = this.toPercent(pdata[key]["endgameClimbPercent"][2] / pdata[key]["totalmatches"]);
      pdata[key]["endgameClimbPercent"][3] = this.toPercent(pdata[key]["endgameClimbPercent"][3] / pdata[key]["totalmatches"]);
      pdata[key]["endgameClimbPercent"][4] = this.toPercent(pdata[key]["endgameClimbPercent"][4] / pdata[key]["totalmatches"]);

      pdata[key]["endgameStartClimbingPercent"][0] = this.toPercent(pdata[key]["endgameStartClimbingPercent"][0] / pdata[key]["totalmatches"]);
      pdata[key]["endgameStartClimbingPercent"][1] = this.toPercent(pdata[key]["endgameStartClimbingPercent"][1] / pdata[key]["totalmatches"]);
      pdata[key]["endgameStartClimbingPercent"][2] = this.toPercent(pdata[key]["endgameStartClimbingPercent"][2] / pdata[key]["totalmatches"]);
      pdata[key]["endgameStartClimbingPercent"][3] = this.toPercent(pdata[key]["endgameStartClimbingPercent"][3] / pdata[key]["totalmatches"]);
    }

    return pdata;
  }
}
