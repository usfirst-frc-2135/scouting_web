/*
  Match Data Processor
  Takes in match data from source and calculates averages and other derived data from it.
  Data types:
    jMatchData - the JSON parsed match data from our scouting database
    matchId - the string used to identify a match competition level and match number (e.g. qm5)
    matchTuple - a two entry tuple that identifies a match (e.g. ["qm", "5"])
*/
class matchDataProcessor {
  mData = {};   // Match data from scouting database
  pData = [];   // Processed data after totals and averages calculated

  constructor(jMatchData) {
    this.mData = jMatchData;
    this.siteFilter = null;
    console.log("matchDataProcessor: MatchData: num of matches = " + this.mData.length);

    // Organize the match data by team number
    for (let i = 0; i < this.mData.length; i++) {
      let teamNum = this.mData[i]["teamnumber"];
      if (this.pData[teamNum] === undefined) {
        this.pData[teamNum] = { teamNum: teamNum, matches: [] };
      }
      this.pData[teamNum]["matches"].push(this.mData[i]);
    }

    // Sort the matches for each team by match number
    for (const teamNum in this.pData) {
      let matches = this.pData[teamNum]["matches"];
      matches.sort((a, b) => { return compareMatchNumbers(a["matchnumber"], b["matchnumber"]) });
    }
  }

  //
  // Convert to integer percent (one decimal digit)
  //
  toPercent(val) {
    return this.roundOnePlace(((val + Number.EPSILON) * 1000) / 10);
  }

  //
  // Round data to no more than one decimal digit
  //
  roundOnePlace(val) {
    return Math.round((val + Number.EPSILON) * 10) / 10;
  }

  //
  // Round data to no more than two decimal digits
  //
  roundTwoPlaces(val) {
    return Math.round((val + Number.EPSILON) * 100) / 100;
  }

  //
  // Fix match IDs that are missing the comp level
  //
  getFixedMatchId(matchId) {
    if (matchId != 0) {
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
    else {
      console.warn("getMatchTuple: Invalid matchId! " + matchId);
      return "qm" + matchId;
    }
  }

  //
  // Get the comp level and match number from the match ID string (ex. [qm, 25] from qm25)
  //
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

  //
  // Compare if second match ID is larget than first match ID
  //
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

  //
  // Compare if match ID string is within two match ID endpoints
  //
  ifMatchInRange(startMatchId, matchId, endMatchId) {
    return this.isMatchLessThanOrEqual(startMatchId, matchId) && this.isMatchLessThanOrEqual(matchId, endMatchId);
  }

  //
  // Filters out all matches in this.mData not within the specified range (destructively changes this.mData)
  //
  filterMatchRange(startMatchId, endMatchId) {
    let newData = [];
    for (let i = 0; i < this.mData.length; i++) {
      let matchId = this.mData[i]["matchnumber"];
      if (this.ifMatchInRange(startMatchId, matchId, endMatchId)) {
        newData.push(this.mData[i]);
      }
    }
    this.mData = newData;
  }

  //
  // Sorts the data by match number (ignores comp_level)
  //
  sortMatches(newData) {
    console.log("matchDataProcessor: sortMatches:");
    newData.sort(function (a, b) {
      let compare = this.isMatchLessThanOrEqual(a["matchnumber"], b["matchnumber"]);
      return (compare) ? -1 : 1;
    });
  }

  //
  //  Modify match data to only include matches specified by the site filter
  //
  applySiteFilter() {
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
  }

  //
  // Filters match data based on the retrieved site filter from DB config
  //
  getSiteFilteredAverages(processorFunction) {
    let tempThis = this;
    $.post("api/dbAPI.php", {
      getDBStatus: true
    }, function (dbStatus) {
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

  //  
  // Initialize match item statistics
  //
  initializeItem(item, itemField) {
    if (!Object.prototype.hasOwnProperty.call(item, itemField)) {
      item[itemField] = { val: 0, sum: 0, max: 0, avg: 0, acc: 0 };
    }
  }

  //
  // Retrieve match data into item statistics
  //
  getMatchItem(item, itemField, match, matchField) {
    this.initializeItem(item, itemField);

    // If the match data field is null, use the item field name instead
    if (match[matchField] === null) {
      matchField = itemField;
    }

    let value = parseInt(match[matchField]);
    item[itemField].val = value;
    item[itemField].sum += value;
    item[itemField].max = Math.max(item[itemField].max, value);

    return value;
  }

  //
  // Update match array into item statistics
  //
  getMatchArray(item, itemField, arraySize, match, matchField) {
    if (!Object.prototype.hasOwnProperty.call(item, itemField)) {
      item[itemField] = { val: 0, arr: [] };
      for (let i = 0; i < arraySize; i++) {
        item[itemField].arr[i] = { sum: 0, max: 0, avg: 0, acc: 0 };
      }
    }

    // If the match data field is null, use the item field name instead
    if (match[matchField] === null) {
      matchField = itemField;
    }

    let value = parseFloat(match[matchField]);
    item[itemField].val = value;
    if (value >= arraySize) {
      console.error("getMatchArray: array index out of bounds! " + value + " >= " + arraySize);
      return -1;
    }

    item[itemField].arr[value].sum += 1;
    return value;
  }

  //
  // Update match item statistics
  //
  updateItem(item, itemField, value) {
    this.initializeItem(item, itemField);

    item[itemField].sum += value;
    item[itemField].max = Math.max(item[itemField].max, value);
  }

  //
  // Update match item average
  //
  calcAverage(item, itemField, denominator) {
    item[itemField].avg = (item[denominator] != 0) ? this.roundOnePlace(item[itemField].sum / item[denominator]) : 0;
  }

  //
  // Update match item accuracy
  //
  calcAccuracy(item, itemField, denominator) {
    item[itemField].acc = (item[denominator].sum != 0) ? this.toPercent(item[itemField].sum / item[denominator].sum) : 0;
  }

  //
  // Update match item percent array
  //
  calcArray(item, itemField, denominator) {
    for (const i in item[itemField].arr) {
      item[itemField].arr[i].avg = (item[denominator] != 0) ? this.toPercent(item[itemField].arr[i].sum / item[denominator]) : 0;
    }
  }

  //
  // Get event averages by calculating averages from the match data
  //
  // pData - processed data structure is an array of team numbered objects with match data and calculated averages
  //  structure:
  //  teamNumber: {
  //   matches: [match1, match2, ...]
  //   totalMatches: int
  //   autonLeave: { sum: int, max: int, avg: float }
  //   autonCoralL1: { sum: int, max: int, avg: float }
  //   ...
  //   scoutNames: [name1, name2, ...]
  //   commentList: [comment1, comment2, ...]
  //  }
  //
  getEventAverages() {
    console.log("matchDataProcessor: getEventAverages:");

    //////////////////// PROCESS ALL TEAMS ////////////////////

    //  For each team, go thru all its matches and do the calculations for this event
    for (const i in this.pData) {
      let team = this.pData[i];
      let matchList = team["matches"];
      console.log("===> MDP calcs team: " + team["teamNum"] + " matches: " + matchList.length);  // TEST

      // Initialize text data for matches
      team["scoutNames"] = [];
      team["commentList"] = [];

      // Initialize team processed data
      team["totalDefenseMatches"] = 0;  // incremented each match this team played defense
      team["totalMatches"] = matchList.length;

      //////////////////// PROCESS MATCHES INTO TEAM OBJECT ////////////////////

      for (const j in matchList) {
        let match = matchList[j];

        // NOTE: The field names on the right side of getMatchXXX must match the DB field names in the scouting database
        //        The field names on the left side of getMatchXXX must match the field names in this class

        // Autonomous mode
        this.getMatchItem(team, "autonLeave", match, "autonLeave");
        this.getMatchItem(team, "autonCoralL1", match, "autonCoralL1");
        this.getMatchItem(team, "autonCoralL2", match, "autonCoralL2");
        this.getMatchItem(team, "autonCoralL3", match, "autonCoralL3");
        this.getMatchItem(team, "autonCoralL4", match, "autonCoralL4");
        this.getMatchItem(team, "autonAlgaeProc", match, "autonAlgaeProc");
        this.getMatchItem(team, "autonAlgaeNet", match, "autonAlgaeNet");

        // Teleop mode
        this.getMatchItem(team, "teleopCoralL1", match, "teleopCoralL1");
        this.getMatchItem(team, "teleopCoralL2", match, "teleopCoralL2");
        this.getMatchItem(team, "teleopCoralL3", match, "teleopCoralL3");
        this.getMatchItem(team, "teleopCoralL4", match, "teleopCoralL4");
        this.getMatchItem(team, "teleopAlgaeProc", match, "teleopAlgaeProc");
        this.getMatchItem(team, "teleopAlgaeNet", match, "teleopAlgaeNet");
        this.getMatchItem(team, "teleopCoralAcquired", match, "teleopCoralAcquired");
        this.getMatchItem(team, "teleopAlgaeAcquired", match, "teleopAlgaeAcquired");

        let matchDefenseLevel = this.getMatchItem(team, "defenseLevel", match, "defenseLevel");
        if (matchDefenseLevel != 0) {
          team["totalDefenseMatches"] += 1;  // increment if this team played defense
        }

        // Endgame
        this.getMatchArray(team, "endgameStartClimb", 4, match, "endgameStartClimb");
        this.getMatchArray(team, "endgameCageClimb", 5, match, "endgameCageClimb");

        this.getMatchItem(team, "died", match, "died");

        // Append text data for matches
        team["scoutNames"].push(match["matchnumber"] + " - " + match["scoutname"]);
        team["commentList"].push(match["matchnumber"] + " - " + match["comment"]);

        //////////////////// GAME PIECE TOTALS ////////////////////

        let autonCoralPieces = team["autonCoralL1"].val + team["autonCoralL2"].val + team["autonCoralL3"].val + team["autonCoralL4"].val;
        let autonAlgaePieces = team["autonAlgaeNet"].val + team["autonAlgaeProc"].val;

        let teleopCoralPieces = team["teleopCoralL1"].val + team["teleopCoralL2"].val + team["teleopCoralL3"].val + team["teleopCoralL4"].val;
        let teleopAlgaePieces = team["teleopAlgaeNet"].val + team["teleopAlgaeProc"].val;
        let totalCoralPieces = autonCoralPieces + teleopCoralPieces;
        let totalAlgaePieces = autonAlgaePieces + teleopAlgaePieces;

        // Store piece values
        this.updateItem(team, "autonCoralPieces", autonCoralPieces);
        this.updateItem(team, "autonAlgaePieces", autonAlgaePieces);

        this.updateItem(team, "teleopCoralPieces", teleopCoralPieces);
        this.updateItem(team, "teleopAlgaePieces", teleopAlgaePieces);

        this.updateItem(team, "totalCoralPieces", totalCoralPieces);
        this.updateItem(team, "totalAlgaePieces", totalAlgaePieces);

        //////////////////// POINT TOTALS ////////////////////

        let autonLeavePoints = (team["autonLeave"].val === 1) ? 3 : 0;
        let autonCoralPoints = (team["autonCoralL1"].val * 3) + (team["autonCoralL2"].val * 4) + (team["autonCoralL3"].val * 6) + (team["autonCoralL4"].val * 7);
        let autonAlgaePoints = (team["autonAlgaeNet"].val * 4) + (team["autonAlgaeProc"].val * 6);
        let totalAutoPoints = autonLeavePoints + autonCoralPoints + autonAlgaePoints;

        let teleopCoralPoints = (team["teleopCoralL1"].val * 2) + (team["teleopCoralL2"].val * 3) + (team["teleopCoralL3"].val * 4) + (team["teleopCoralL4"].val * 5);
        let teleopAlgaePoints = (team["teleopAlgaeNet"].val * 4) + (team["teleopAlgaeProc"].val * 6);
        let totalTeleopPoints = teleopCoralPoints + teleopAlgaePoints;

        let totalCoralPoints = autonCoralPoints + teleopCoralPoints;
        let totalAlgaePoints = autonAlgaePoints + teleopAlgaePoints;

        let endgameClimbPoints = 0;
        switch (String(team["endgameCageClimb"].val)) {
          case "1": endgameClimbPoints = 2; break;  // Parked
          case "2": endgameClimbPoints = 2; break;  // Fell
          case "3": endgameClimbPoints = 6; break;  // Shallow
          case "4": endgameClimbPoints = 12; break; // Deep
          default: endgameClimbPoints = 0; break;   // No climb
        }

        let totalMatchPoints = totalAutoPoints + totalTeleopPoints + endgameClimbPoints;

        // Store point values
        this.updateItem(team, "autonCoralPoints", autonCoralPoints);
        this.updateItem(team, "autonAlgaePoints", autonAlgaePoints);
        this.updateItem(team, "autonPoints", totalAutoPoints);

        this.updateItem(team, "teleopCoralPoints", teleopCoralPoints);
        this.updateItem(team, "teleopAlgaePoints", teleopAlgaePoints);
        this.updateItem(team, "teleopPoints", totalTeleopPoints);

        this.updateItem(team, "totalCoralPoints", totalCoralPoints);
        this.updateItem(team, "totalAlgaePoints", totalAlgaePoints);

        this.updateItem(team, "endgamePoints", endgameClimbPoints);
        this.updateItem(team, "totalMatchPoints", totalMatchPoints);
      }

      //////////////////// CALCULATE AVERAGES USING TOTAL MATCH COUNT ////////////////////

      // console.log("===> doing MDP averages, max for team: " + key);  // TEST

      // Autonomous mode
      this.calcAverage(team, "autonLeave", "totalMatches");
      this.calcAverage(team, "autonCoralL1", "totalMatches");
      this.calcAverage(team, "autonCoralL2", "totalMatches");
      this.calcAverage(team, "autonCoralL3", "totalMatches");
      this.calcAverage(team, "autonCoralL4", "totalMatches");
      this.calcAverage(team, "autonAlgaeProc", "totalMatches");
      this.calcAverage(team, "autonAlgaeNet", "totalMatches");

      // Teleop mode
      this.calcAverage(team, "teleopCoralL1", "totalMatches");
      this.calcAverage(team, "teleopCoralL2", "totalMatches");
      this.calcAverage(team, "teleopCoralL3", "totalMatches");
      this.calcAverage(team, "teleopCoralL4", "totalMatches");
      this.calcAverage(team, "teleopAlgaeProc", "totalMatches");
      this.calcAverage(team, "teleopAlgaeNet", "totalMatches");

      // Divide coral/algae pieces by acquired pieces
      this.calcAccuracy(team, "teleopCoralPieces", "teleopCoralAcquired");
      this.calcAccuracy(team, "teleopAlgaePieces", "teleopAlgaeAcquired");

      // Defense avg - only calculate this if this team played defense in a match
      this.calcAverage(team, "defenseLevel", "totalDefenseMatches");

      this.calcAverage(team, "died", "totalMatches");

      // endgame
      this.calcArray(team, "endgameStartClimb", "totalMatches");
      this.calcArray(team, "endgameCageClimb", "totalMatches");

      // points by game phase
      this.calcAverage(team, "autonCoralPoints", "totalMatches");
      this.calcAverage(team, "autonAlgaePoints", "totalMatches");
      this.calcAverage(team, "teleopCoralPoints", "totalMatches");
      this.calcAverage(team, "teleopAlgaePoints", "totalMatches");

      this.calcAverage(team, "autonPoints", "totalMatches");
      this.calcAverage(team, "teleopPoints", "totalMatches");
      this.calcAverage(team, "totalMatchPoints", "totalMatches");

      // points by game piece
      this.calcAverage(team, "totalCoralPoints", "totalMatches");
      this.calcAverage(team, "totalAlgaePoints", "totalMatches");

      // total auton
      this.calcAverage(team, "autonCoralPieces", "totalMatches");
      this.calcAverage(team, "autonAlgaePieces", "totalMatches");
      this.calcAverage(team, "teleopCoralPieces", "totalMatches");
      this.calcAverage(team, "teleopAlgaePieces", "totalMatches");

      // total game pieces
      this.calcAverage(team, "totalCoralPieces", "totalMatches");
      this.calcAverage(team, "totalAlgaePieces", "totalMatches");

      this.calcAverage(team, "endgamePoints", "totalMatches");
    }

    return this.pData;
  }

}
