/*
  Match Data Processor
  Takes in match data from source and calculates averages and other derived data from it.
*/

class matchDataProcessor {

  constructor(data) {
    this.data = data;
    this.siteFilter = null;
  }

  get_match_tuple(match_str) {
    match_str = match_str.toLowerCase();
    if (match_str.search("p") != -1) {
      return ["p", parseInt(match_str.substr(1))];
    }
    if (match_str.search("qm") != -1) {
      return ["qm", parseInt(match_str.substr(2))];
    }
    if (match_str.search("qf") != -1) {
      return ["qf", parseInt(match_str.substr(2))];
    }
    if (match_str.search("sf") != -1) {
      return ["sf", parseInt(match_str.substr(2))];
    }
    if (match_str.search("f") != -1) {
      return ["f", parseInt(match_str.substr(1))];
    }
    return null;
  }

  matchLessEqualThan(start_match, end_match) {
    var sm = this.get_match_tuple(start_match);
    var em = this.get_match_tuple(end_match);

    if (sm == null) {
      start_match = "qm" + start_match;
      sm = this.get_match_tuple(start_match);
    }

    if (em == null) {
      end_match = "qm" + end_match;
      em = this.get_match_tuple(end_match);
    }

    var type_prog = { "p": 0, "qm": 1, "qf": 2, "sf": 3, "f": 4 };
    if (sm == null || em == null) {
      return false;
    }
    if (type_prog[sm[0]] < type_prog[em[0]]) {
      return true;
    }
    if (type_prog[sm[0]] > type_prog[em[0]]) {
      return false;
    }
    return sm[1] <= em[1];
  }

  check_if_in_range(start_match, middle_match, end_match) {
    return this.matchLessEqualThan(start_match, middle_match) && this.matchLessEqualThan(middle_match, end_match);
  }

  filterMatches(start_match, end_match) {
    //  Modify this.data to only include matches between start_match and end_match
    var type_prog = ["p", "qm", "qf", "sf", "f"];
    var new_data = [];
    for (var i = 0; i < this.data.length; i++) {
      var mid_str = this.data[i]["matchnumber"];
      if (this.get_match_tuple(mid_str) == null) {
        mid_str = "qm" + mid_str;
      }
      if (this.check_if_in_range(start_match, mid_str, end_match)) {
        new_data.push(this.data[i]);
      }

    }
    this.data = new_data;
  }

  rnd(val) {
    // Rounding helper function 
    return Math.round((val + Number.EPSILON) * 100) / 100;
  }

  removePracticeMatches() {
    var new_data = [];
    for (var i = 0; i < this.data.length; i++) {
      var mid_str = this.data[i]["matchnumber"];
      var mt = this.get_match_tuple(mid_str);
      if (mt == null || mt != "p") {
        new_data.push(this.data[i]);
      }

    }
    this.data = new_data;
  }

  sortMatches(newData) {
    newData.sort((a, b) => {
      var compare = this.matchLessEqualThan(a["matchnumber"], b["matchnumber"]);
      if (compare) { return -1; }
      return 1;
    });
  }

  getSiteFilter(successFunction) {
    if (!this.siteFilter) {
      $.post("dbAPI.php", { "getStatus": true }, function (data) {
        data = JSON.parse(data);
        var localSiteFilter = {};
        localSiteFilter["useP"] = data["useP"];
        localSiteFilter["useQm"] = data["useQm"];
        localSiteFilter["useQf"] = data["useQf"];
        localSiteFilter["useSf"] = data["useSf"];
        localSiteFilter["useF"] = data["useF"];
        this.siteFilter = { ...localSiteFilter };
        successFunction();
      });
    }
    else {
      successFunction();
    }
  }

  applySiteFilter() {
    //  Modify this.data to only include matches specified by the site filter
    var new_data = [];
    for (var i = 0; i < this.data.length; i++) {
      var mn = this.data[i]["matchnumber"];
      var mt = this.get_match_tuple(mn);
      if (mt == null) {
        mt = ["qm", null];
      }
      if (mt[0] == "p" && this.siteFilter["useP"]) { new_data.push(this.data[i]); }
      else if (mt[0] == "qm" && this.siteFilter["useQm"]) { new_data.push(this.data[i]); }
      else if (mt[0] == "qf" && this.siteFilter["useQf"]) { new_data.push(this.data[i]); }
      else if (mt[0] == "sf" && this.siteFilter["useSf"]) { new_data.push(this.data[i]); }
      else if (mt[0] == "f" && this.siteFilter["useF"]) { new_data.push(this.data[i]); }
    }
    this.data = [...new_data];
  }

  getSiteFilteredAverages(successFunction) {
    var temp_this = this;
    $.post("dbAPI.php", { "getStatus": true }, function (data) {
      data = JSON.parse(data);
      var localSiteFilter = {};
      localSiteFilter["useP"] = data["useP"];
      localSiteFilter["useQm"] = data["useQm"];
      localSiteFilter["useQf"] = data["useQf"];
      localSiteFilter["useSf"] = data["useSf"];
      localSiteFilter["useF"] = data["useF"];
      temp_this.siteFilter = { ...localSiteFilter };
        
      temp_this.applySiteFilter();
        
      successFunction(temp_this.getAverages());
    });
  }

  getAverages() {
    var pdata = {}; // to hold returning data for all matches and all teams

    // For each team, go thru all its matches and do the calculations for the averages table data.
    for (var i = 0; i < this.data.length; i++) 
    {
      var tn = this.data[i]["teamnumber"];
//      console.log("===> getAverages() for team: "+tn);

      if (!(tn in pdata)) 
      {
        // If this team doesn't have any data stored yet, initialize its data array.
        pdata[tn] = {};

        pdata[tn]["avgTotalCoral"] = 0;
        pdata[tn]["maxTotalCoral"] = 0;
        pdata[tn]["avgTotalAlgae"] = 0;
        pdata[tn]["maxTotalAlgae"] = 0;
          
        pdata[tn]["avgTotalAutoPoints"] = 0;
        pdata[tn]["maxTotalAutoPoints"] = 0;
          
        pdata[tn]["avgTotalTeleopPoints"] = 0;
        pdata[tn]["maxTotalTeleopPoints"] = 0;
          
        //pdata[tn]["avgAutoPieces"] = 0;
        //pdata[tn]["maxAutoPieces"] = 0;

        //pdata[tn]["avgTeleopPieces"] = 0;
        //pdata[tn]["maxTeleopPieces"] = 0;

        pdata[tn]["avgEndgamePoints"] = 0;
        pdata[tn]["maxEndgamePoints"] = 0;
          
        pdata[tn]["avgTotalPoints"] = 0;
        pdata[tn]["maxTotalPoints"] = 0;
          
        pdata[tn]["avgAutonCoral"] = 0;
        pdata[tn]["maxAutonCoral"] = 0;
        pdata[tn]["avgAutonAlgae"] = 0;
        pdata[tn]["maxAutonAlgae"] = 0;
        pdata[tn]["avgAutonCoralL1"] = 0;
        pdata[tn]["maxAutonCoralL1"] = 0;
        pdata[tn]["avgAutonCoralL2"] = 0;
        pdata[tn]["maxAutonCoralL2"] = 0;
        pdata[tn]["avgAutonCoralL3"] = 0;
        pdata[tn]["maxAutonCoralL3"] = 0;
        pdata[tn]["avgAutonCoralL4"] = 0;
        pdata[tn]["maxAutonCoralL4"] = 0;
        pdata[tn]["avgAutonAlgaeNet"] = 0;
        pdata[tn]["avgAutonAlgaeProc"] = 0;
        pdata[tn]["maxAutonAlgaeNet"] = 0;
        pdata[tn]["maxAutonAlgaeProc"] = 0;
        pdata[tn]["avgTotalAutoCoralPoints"] = 0;
        pdata[tn]["maxTotalAutoCoralPoints"] = 0;
        pdata[tn]["avgTotalAutoAlgaePoints"] = 0;
        pdata[tn]["maxTotalAutoAlgaePoints"] = 0;
        pdata[tn]["autonStartPositionPercent"] = {0:0, 1:0, 2:0};
        pdata[tn]["autonCoralPickupFloor"] = 0;
        pdata[tn]["autonCoralPickupStation"] = 0;
        pdata[tn]["autonAlgaePickupFloor"] = 0;
        pdata[tn]["autonAlgaePickupReef"] = 0;
		
        pdata[tn]["avgTeleopCoralScored"] = 0;
        pdata[tn]["maxTeleopCoralScored"] = 0;
        pdata[tn]["avgTeleopAlgaeScored"] = 0;
        pdata[tn]["maxTeleopAlgaeScored"] = 0;
        pdata[tn]["avgTeleopCoralL1"] = 0;
        pdata[tn]["maxTeleopCoralL1"] = 0;
        pdata[tn]["avgTeleopCoralL2"] = 0;
        pdata[tn]["maxTeleopCoralL2"] = 0;
        pdata[tn]["avgTeleopCoralL3"] = 0;
        pdata[tn]["maxTeleopCoralL3"] = 0;
        pdata[tn]["avgTeleopCoralL4"] = 0;
        pdata[tn]["maxTeleopCoralL4"] = 0;
        pdata[tn]["avgTeleopAlgaeNet"] = 0;
        pdata[tn]["avgTeleopAlgaeProc"] = 0;
        pdata[tn]["maxTeleopAlgaeNet"] = 0;
        pdata[tn]["maxTeleopAlgaeProc"] = 0;
        pdata[tn]["avgTotalTeleopCoralPoints"] = 0;
        pdata[tn]["maxTotalTeleopCoralPoints"] = 0;
        pdata[tn]["avgTotalTeleopAlgaePoints"] = 0;
        pdata[tn]["maxTotalTeleopAlgaePoints"] = 0;
        pdata[tn]["teleopCoralScoringPercent"] = 0;
        pdata[tn]["teleopAlgaeScoringPercent"] = 0;
        pdata[tn]["teleopAcquireCoral"] = 0;    // for calculating shooting percentage
        pdata[tn]["teleopAcquireAlgae"] = 0;   // for calculating shooting percentage
        pdata[tn]["teleopAlgaeFloorPickup"] = 0;
        pdata[tn]["teleopCoralFloorPickup"] = 0;
        pdata[tn]["teleopKnockOffAlgae"] = 0;
        pdata[tn]["teleopAcquireAlgaeFromReef"] = 0;
        pdata[tn]["teleopHoldTwoGamePieces"] = 0;

        pdata[tn]["endgameClimbPercent"] = {0:0, 1:0, 2:0, 3:0, 4:0};  
        pdata[tn]["endgameStartClimbingPercent"] = {0:0, 1:0, 2:0, 3:0};
        pdata[tn]["endgameFoulPercent"] = {0:0, 1:0, 2:0};
       
        pdata[tn]["totaldied"] = 0;

        pdata[tn]["totalmatches"] = 0;

        pdata[tn]["scoutnames"] = [];
        pdata[tn]["commentlist"] = [];
      }
	  
      var totalmatches = (this.data[i]["totalmatches"]);
      var mobilitycheck = (this.data[i]["exitcommunity"]);
        
      var currentAutonCoralL1 = (this.data[i]["autonCoralL1"]);
      var currentAutonCoralL2 = (this.data[i]["autonCoralL2"]);
      var currentAutonCoralL3 = (this.data[i]["autonCoralL3"]);
      var currentAutonCoralL4 = (this.data[i]["autonCoralL4"]);
      var currentAutonAlgaeNet = (this.data[i]["autonAlgaeNet"]);
      var currentAutonAlgaeProcessor = (this.data[i]["autonAlgaeProcessor"]);
      var totalAutoCoral = parseInt(currentAutonCoralL1) + parseInt(currentAutonCoralL2) + parseInt(currentAutonCoralL3) + parseInt(currentAutonCoralL4);
      var totalAutoCoralPoints = (parseInt(currentAutonCoralL1) * 3) + (parseInt(currentAutonCoralL2) * 4) + (parseInt(currentAutonCoralL3) * 6) + (parseInt(currentAutonCoralL4) * 7);
      var totalAutoAlgae = parseInt(currentAutonAlgaeNet) + parseInt(currentAutonAlgaeProcessor);
      var totalAutoAlgaePoints = (parseInt(currentAutonAlgaeNet) * 4) + (parseInt(currentAutonAlgaeProcessor) * 6)
      //var currentAutonSpeakerMisses = (this.data[i]["autonspeakermisses"]);
      //pdata[tn]["totalAutonSpeakerNotes"] += parseInt(currentAutonSpeakerNotes);
      //pdata[tn]["totalAutonSpeakerMisses"] += parseInt(currentAutonSpeakerMisses);
//      console.log("   -> current auton speaker notes = "+ currentAutonSpeakerNotes); //TEST
//      console.log("   -> current auton speaker misses = "+ currentAutonSpeakerMisses); //TEST
//      console.log("   -> total auton speaker notes = " + pdata[tn]["totalAutonSpeakerNotes"]); //TEST
//      console.log("   -> total auton speaker misses = " + pdata[tn]["totalAutonSpeakerMisses"]); //TEST

      var currentTeleopCoralL1 = (this.data[i]["teleopCoralL1"]);
      var currentTeleopCoralL2 = (this.data[i]["teleopCoralL2"]);
      var currentTeleopCoralL3 = (this.data[i]["teleopCoralL3"]);
      var currentTeleopCoralL4 = (this.data[i]["teleopCoralL4"]);
      var currentTeleopAlgaeNet = (this.data[i]["teleopAlgaeNet"]);
      var currentTeleopAlgaeProcessor = (this.data[i]["teleopAlgaeProcessor"]);
      //var currentTeleopSpeakerNotes = (this.data[i]["teleopspeakernotes"]);
      var totalTeleopCoral = (parseInt(currentTeleopCoralL1)) + (parseInt(currentTeleopCoralL2)) + (parseInt(currentTeleopCoralL3)) + (parseInt(currentTeleopCoralL4));
      var totalTeleopCoralPoints = (parseInt(currentTeleopCoralL1) * 2) + (parseInt(currentTeleopCoralL2) * 3) + (parseInt(currentTeleopCoralL3) * 4) + (parseInt(currentTeleopCoralL4) * 5);
      var totalTeleopAlgae = (parseInt(currentTeleopAlgaeNet)) + (parseInt(currentTeleopAlgaeProcessor));
      var totalTeleopAlgaePoints = (parseInt(currentTeleopAlgaeNet) * 4) + (parseInt(currentTeleopAlgaeProcessor) * 6);
      var currentTeleopCoralAcquired = (this.data[i]["teleopAcquireCoral"]);
      var currentTeleopAlgaeAcquired = (this.data[i]["teleopAcquireAlgae"]);
      pdata[tn]["totalTeleopCoral"] += parseInt(totalTeleopCoral);
      pdata[tn]["teleopAcquireCoral"] += parseInt(currentTeleopCoralAcquired);
      pdata[tn]["totalTeleopAlgae"] += parseInt(totalTeleopAlgae);
      pdata[tn]["teleopAcquireAlgae"] += parseInt(currentTeleopAlgaeAcquired);
//      console.log("   -> current teleop speaker notes = "+ currentTeleopSpeakerNotes); //TEST
//      console.log("   -> current total teleop notes = "+ totalTeleopNotes); //TEST
//      console.log("   -> total teleop speaker notes = " + pdata[tn]["totalTeleopSpeakerNotes"]); //TEST
//      console.log("   -> total teleop speaker misses = " + pdata[tn]["totalTeleopSpeakerMisses"]); //TEST

      //var passes = (this.data[i]["teleoppasses"]);

      var endgameClimbPoints = (this.data[i]["endgameClimbLevel"]);
      //var endgameHarmonyPoints = (this.data[i]["endgameharmony"]);
      if (endgameClimbPoints == 1) { 
        endgameClimbPoints = 2; 
      }
      else if (endgameClimbPoints == 2) {
        endgameClimbPoints = 2;
      }
      else if (endgameClimbPoints == 3) {
        endgameClimbPoints = 6;
      }
      else if (endgameClimbPoints == 4) {
          endgameClimbPoints = 12;
      }
      //harmony points based on number of robots onstage
      /*if (endgameHarmonyPoints == 1) {
        endgameHarmonyPoints = 2;
      }
      else if (endgameHarmonyPoints == 2) {
        endgameHarmonyPoints = 4;
      }*/
      var autonCoralFloor = (this.data[i]["autonCoralFloor"]);
      var autonCoralStation = (this.data[i]["autonCoralStation"]);
      var autonAlgaeFloor = (this.data[i]["autonAlgaeFloor"]);
      var autonAlgaeReef = (this.data[i]["autonAlgaeReef"]);
        
      var teleopAlgaeFloor = (this.data[i]["teleopAlgaeFloorPickup"]);
      var teleopCoralFloor = (this.data[i]["teleopCoralFloorPickup"]);
        
      var startClimbing = (this.data[i]["endgameStartClimbing"]);
      var endgameFouls = (this.data[i]["endgameFoulNumber"]);
      //var endgameTrap = (this.data[i]["endgametrap"]);
      //var endgamePoints = (endgameStagePoints) + (endgameHarmonyPoints) + (endgameSpotlit) + (endgameTrap * 5);
//      console.log("   >> spotlit = " + endgameSpotlit);
//      console.log("   >> endgame stage = " + endgameStagePoints);
//      console.log("   >> endgame harmomy = " + endgameHarmonyPoints);
//      console.log("   >> endgame trap = " + endgameTrap);
//      console.log("   >> endgame points = " + endgamePoints);
//      console.log("   -> endgamePoints = "+endgamePoints); //TEST
      //var currentTrap = (parseInt(this.data[i]["endgametrap"]));
      //pdata[tn]["trapPercentage"] += currentTrap;
      pdata[tn]["autonCoralFloorPercent"] += autonCoralFloor;
      pdata[tn]["autonCoralStationPercent"] += autonCoralStation;
      pdata[tn]["autonAlgaeFloorPercent"] += autonAlgaeFloor;
      pdata[tn]["autonAlgaeReefPercent"] += autonAlgaeReef;
        
      pdata[tn]["teleopAlgaeFloor"] += teleopAlgaeFloor;
      pdata[tn]["teleopCoralFloor"] += teleopCoralFloor;
      //var currentSpotlit = (parseInt(this.data[i]["endgamespotlit"]));
      //pdata[tn]["spotlitPercentage"] += currentSpotlit;
      
      var totalCoral = totalAutoCoral + totalTeleopCoral;
      var totalAlgae = totalAutoAlgae + totalTeleopAlgae;
      var totalAutoPoints = totalAutoCoralPoints + totalAutoAlgaePoints
      var totalTeleopPoints = totalTeleopCoralPoints + totalTeleopAlgaePoints
      var totalPoints = totalAutoPoints + totalTeleopPoints
    

      pdata[tn]["avgTotalCoral"] += totalCoral;
      pdata[tn]["maxTotalCoral"] = Math.max(pdata[tn]["maxTotalCoral"], totalCoral);
        
      pdata[tn]["avgTotalAlgae"] += totalAlgae;
      pdata[tn]["maxTotalAlgae"] = Math.max(pdata[tn]["maxTotalAlgae"], totalAlgae);
        
      pdata[tn]["avgTotalAutoPoints"] += totalAutoPoints;
      pdata[tn]["maxTotalAutoPoints"] = Math.max(pdata[tn]["maxTotalAutoPoints"], totalAutoPoints);
        
      pdata[tn]["avgTotalAutoCoralPoints"] += totalAutoCoralPoints;
      pdata[tn]["maxTotalAutoCoralPoints"] = Math.max(pdata[tn]["maxTotalAutoCoralPoints"], totalAutoCoralPoints);
        
      pdata[tn]["avgTotalAutoAlgaePoints"] += totalAutoAlgaePoints;
      pdata[tn]["maxTotalAutoAlgaePoints"] = Math.max(pdata[tn]["maxTotalAutoAlgaePoints"], totalAutoAlgaePoints);
        
      pdata[tn]["avgTotalTeleopPoints"] += totalTeleopPoints;
      pdata[tn]["maxTotalTeleopPoints"] = Math.max(pdata[tn]["maxTotalTeleopPoints"], totalTeleopPoints);
        
      pdata[tn]["avgTotalTeleopCoralPoints"] += totalTeleopCoralPoints;
      pdata[tn]["maxTotalTeleopCoralPoints"] = Math.max(pdata[tn]["maxTotalTeleopCoralPoints"], totalTeleopCoralPoints);
        
      pdata[tn]["avgTotalTeleopAlgaePoints"] += totalTeleopAlgaePoints;
      pdata[tn]["maxTotalTeleopAlgaePoints"] = Math.max(pdata[tn]["maxTotalTeleopAlgaePoints"], totalTeleopAlgaePoints);
        
      /*pdata[tn]["avgAutoCoral"] += totalAutoCoral;
      pdata[tn]["maxAutoCoral"] = Math.max(pdata[tn]["maxAutoCoral"], totalAutoCoral);
//      console.log("   -> avgautopoints = "+pdata[tn]["avgautopoints"]); //TEST

      pdata[tn]["avgteleopnotes"] += totalTeleopNotes;
      pdata[tn]["maxteleopnotes"] = Math.max(pdata[tn]["maxteleopnotes"], totalTeleopNotes);*/
		
      pdata[tn]["avgEndgamePoints"] += endgameClimbPoints;
      pdata[tn]["maxEndgamePoints"] = Math.max(pdata[tn]["maxEndgamePoints"], endgameClimbPoints);
		
      var currentAutonCoral = (parseInt(totalAutoCoral));
      pdata[tn]["avgAutonCoral"] += currentAutonCoral;
      pdata[tn]["maxAutonCoral"] = Math.max(pdata[tn]["maxAutonCoral"], currentAutonCoral);
        
      var currentAutonAlgae = (parseInt(totalAutoAlgae));
      pdata[tn]["avgAutonAlgae"] += currentAutonAlgae;
      pdata[tn]["maxAutonAlgae"] = Math.max(pdata[tn]["maxAutonAlgae"], currentAutonAlgae);

      var currentTeleopCoral = (parseInt(totalTeleopCoral));
      pdata[tn]["avgTeleopCoralScored"] += currentTeleopCoral;
      pdata[tn]["maxTeleopCoralScored"] = Math.max(pdata[tn]["maxTeleopCoralScored"], currentTeleopCoral);
	
      var currentTeleopAlgae = (parseInt(totalTeleopAlgae));
      pdata[tn]["avgTeleopAlgaeScored"] += currentTeleopAlgae;
      pdata[tn]["maxTeleopAlgaeScored"] = Math.max(pdata[tn]["maxTeleopAlgaeScored"], currentTeleopAlgae);
        
      pdata[tn]["avgAutonCoralL1"] += currentAutonCoralL1; 
      pdata[tn]["avgAutonCoralL2"] += currentAutonCoralL2; 
      pdata[tn]["avgAutonCoralL3"] += currentAutonCoralL3; 
      pdata[tn]["avgAutonCoralL4"] += currentAutonCoralL4; 
      
      pdata[tn]["maxAutonCoralL1"] = Math.max(pdata[tn]["maxAutonCoralL1"], currentAutonCoralL1);
      pdata[tn]["maxAutonCoralL2"] = Math.max(pdata[tn]["maxAutonCoralL2"], currentAutonCoralL2);
      pdata[tn]["maxAutonCoralL3"] = Math.max(pdata[tn]["maxAutonCoralL3"], currentAutonCoralL3);
      pdata[tn]["maxAutonCoralL4"] = Math.max(pdata[tn]["maxAutonCoralL4"], currentAutonCoralL4);
    
      pdata[tn]["avgAutonAlgaeNet"] += currentAutonAlgaeNet;
      pdata[tn]["avgAutonAlgaeProc"] += currentAutonAlgaeProcessor;
    
      pdata[tn]["maxAutonAlgaeNet"] = Math.max(pdata[tn]["maxAutonAlgaeNet"], currentAutonAlgaeNet);
      pdata[tn]["maxAutonAlgaeProc"] = Math.max(pdata[tn]["maxAutonAlgaeProc"], currentAutonAlgaeProcessor);
	
      pdata[tn]["avgTeleopCoralL1"] += currentTeleopCoralL1; 
      pdata[tn]["avgTeleopCoralL2"] += currentTeleopCoralL2; 
      pdata[tn]["avgTeleopCoralL3"] += currentTeleopCoralL3; 
      pdata[tn]["avgTeleopCoralL4"] += currentTeleopCoralL4; 
      
      pdata[tn]["maxTeleopCoralL1"] = Math.max(pdata[tn]["maxTeleopCoralL1"], currentTeleopCoralL1);
      pdata[tn]["maxTeleopCoralL2"] = Math.max(pdata[tn]["maxTeleopCoralL2"], currentTeleopCoralL2);
      pdata[tn]["maxTeleopCoralL3"] = Math.max(pdata[tn]["maxTeleopCoralL3"], currentTeleopCoralL3);
      pdata[tn]["maxTeleopCoralL4"] = Math.max(pdata[tn]["maxTeleopCoralL4"], currentTeleopCoralL4);
        
      pdata[tn]["avgTeleopAlgaeNet"] += currentTeleopAlgaeNet;
      pdata[tn]["avgTeleopAlgaeProc"] += currentTeleopAlgaeProcessor;
    
      pdata[tn]["maxTeleopAlgaeNet"] = Math.max(pdata[tn]["maxTeleopAlgaeNet"], currentTeleopAlgaeNet);
      pdata[tn]["maxTeleopAlgaeProc"] = Math.max(pdata[tn]["maxTeleopAlgaeProc"], currentTeleopAlgaeProcessor);
      // For boolean data, we are just incrementing that data instead of adding the new value here.
      pdata[tn]["endgameClimbPercent"][this.data[i]["endgameClimbLevel"]] += 1;
      //HOLD pdata[tn]["endgameStartClimbPercent"][this.data[i]["endgameStartClimbing"]] += 1;
      pdata[tn]["endgameFoulPercent"][this.data[i]["endgameFoulNumber"]] += 1;

      pdata[tn]["totaldied"] += this.data[i]["died"];
      pdata[tn]["totalmatches"] += 1;
      pdata[tn]["scoutnames"].push(this.data[i]["scoutname"]);
      pdata[tn]["commentlist"].push(this.data[i]["comment"]);
    }

    // Go thru each team in pdata and do the avg, max and percent calculations.
    for (var key in pdata) 
    {
//      console.log(">>>> for team " + key);
      pdata[key]["avgTotalCoral"] = Math.round(10 * pdata[key]["avgTotalCoral"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["avgTotalAlgae"] = Math.round(10 * pdata[key]["avgTotalAlgae"] / pdata[key]["totalmatches"]) / 10;
      
      pdata[key]["avgAutonCoral"] = Math.round(10 * pdata[key]["avgAutonCoral"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["avgAutonAlgae"] = Math.round(10 * pdata[key]["avgAutonAlgae"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]
      
      pdata[key]["avgTeleopCoralScored"] = Math.round(10 * pdata[key]["avgTeleopCoralScored"] / pdata[key]["totalmatches"]) / 10; 
      pdata[key]["maxTeleopCoralScored"] = Math.round(10 * pdata[key]["maxTeleopCoralScored"] / pdata[key]["totalmatches"]) / 10; 
    
      pdata[key]["avgTeleopAlgaeScored"] = Math.round(10 * pdata[key]["avgTeleopAlgaeScored"] / pdata[key]["totalmatches"]) / 10; 
      pdata[key]["maxTeleopAlgaeScored"] = Math.round(10 * pdata[key]["maxTeleopAlgaeScored"] / pdata[key]["totalmatches"]) / 10; 
      
      pdata[key]["avgEndgamePoints"] = Math.round(10 * pdata[key]["avgEndgamePoints"] / pdata[key]["totalmatches"]) / 10;
        
      pdata[key]["avgAutonCoralL1"] = Math.round(10 * pdata[key]["avgAutonCoralL1"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["maxAutonCoralL1"] = Math.round(10 * pdata[key]["maxAutonCoralL1"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["avgAutonCoralL2"] = Math.round(10 * pdata[key]["avgAutonCoralL2"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["maxAutonCoralL2"] = Math.round(10 * pdata[key]["maxAutonCoralL2"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["avgAutonCoralL3"] = Math.round(10 * pdata[key]["avgAutonCoralL3"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["maxAutonCoralL3"] = Math.round(10 * pdata[key]["maxAutonCoralL3"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["avgAutonCoralL4"] = Math.round(10 * pdata[key]["avgAutonCoralL4"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["maxAutonCoralL4"] = Math.round(10 * pdata[key]["maxAutonCoralL4"] / pdata[key]["totalmatches"]) / 10;
        
      pdata[key]["avgAutonAlgaeNet"] = Math.round(10 * pdata[key]["avgAutonAlgaeNet"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["maxAutonAlgaeNet"] = Math.round(10 * pdata[key]["maxAutonAlgaeNet"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["avgAutonAlgaeProc"] = Math.round(10 * pdata[key]["avgAutonAlgaeProc"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["maxAutonAlgaeProc"] = Math.round(10 * pdata[key]["maxAutonAlgaeProc"] / pdata[key]["totalmatches"]) / 10;
        
      pdata[key]["avgTeleopCoralL1"] = Math.round(10 * pdata[key]["avgTeleopCoralL1"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["maxTeleopCoralL1"] = Math.round(10 * pdata[key]["maxTeleopCoralL1"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["avgTeleopCoralL2"] = Math.round(10 * pdata[key]["avgTeleopCoralL2"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["maxTeleopCoralL2"] = Math.round(10 * pdata[key]["maxTeleopCoralL2"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["avgTeleopCoralL3"] = Math.round(10 * pdata[key]["avgTeleopCoralL3"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["maxTeleopCoralL3"] = Math.round(10 * pdata[key]["maxTeleopCoralL3"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["avgTeleopCoralL4"] = Math.round(10 * pdata[key]["avgTeleopCoralL4"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["maxTeleopCoralL4"] = Math.round(10 * pdata[key]["maxTeleopCoralL4"] / pdata[key]["totalmatches"]) / 10;
        
      pdata[key]["avgTeleopAlgaeNet"] = Math.round(10 * pdata[key]["avgTeleopAlgaeNet"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["maxTeleopAlgaeNet"] = Math.round(10 * pdata[key]["maxTeleopAlgaeNet"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["avgTeleopAlgaeProc"] = Math.round(10 * pdata[key]["avgTeleopAlgaeProc"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["maxTeleopAlgaeProc"] = Math.round(10 * pdata[key]["maxTeleopAlgaeProc"] / pdata[key]["totalmatches"]) / 10;
	
      //pdata[key]["avgautonamps"] = Math.round(10 * pdata[key]["avgautonamps"] / pdata[key]["totalmatches"]) / 10;
      //pdata[key]["avgautonspeaker"] = Math.round(10 * pdata[key]["avgautonspeaker"] / pdata[key]["totalmatches"]) / 10;

//      console.log("     ---> total auton speakerShots calculated: " + totalAutonSpeakerShots); //TEST
      // If there are no shots, don't bother doing the calculation here.
      /*if (totalAutonSpeakerShots != 0) {
        var autonSpeakerShotPercent = (parseInt(pdata[key]["totalAutonSpeakerNotes"])) / totalAutonSpeakerShots;
        pdata[key]["autonSpeakerShootPercent"] = Math.round(100 * autonSpeakerShotPercent);
//        console.log("     ---> Auton speakerShootingPercentage: " + pdata[key]["autonSpeakerShootPercent"]); //TEST
      }*/

      //pdata[key]["avgteleopampnotes"] = Math.round(10 * pdata[key]["avgteleopampnotes"] / pdata[key]["totalmatches"]) / 10;
      //pdata[key]["avgteleopspeakernotes"] = Math.round(10 * pdata[key]["avgteleopspeakernotes"] / pdata[key]["totalmatches"]) / 10;
      //pdata[key]["avgPasses"] = Math.round(10 * pdata[key]["avgPasses"] / pdata[key]["totalmatches"]) / 10;

      var totalCoralAcquired = (parseInt(pdata[key]["teleopAcquireCoral"]));
//      console.log("     ---> total teleop speakerShots calculated: " + totalTeleopSpeakerShots); //TEST
      // If there are no shots, don't bother doing the calculation here.
      if (totalCoralAcquired != 0) {
        var teleopCoralPercent = (parseInt(pdata[key]["avgTeleopCoralScored"])) / totalCoralAcquired;
        pdata[key]["teleopCoralScoringPercent"] = Math.round(100 * teleopCoralPercent);
//        console.log("     ---> speakerShootingPercentage: " + pdata[key]["teleopSpeakerShootPercent"]); //TEST
      }
        
      var totalAlgaeAcquired = (parseInt(pdata[key]["teleopAcquireAlgae"]));
//      console.log("     ---> total teleop speakerShots calculated: " + totalTeleopSpeakerShots); //TEST
      // If there are no shots, don't bother doing the calculation here.
      if (totalAlgaeAcquired != 0) {
        var teleopAlgaePercent = (parseInt(pdata[key]["teleopAcquireAlgae"])) / totalAlgaeAcquired;
        pdata[key]["teleopAlgaeScoringPercent"] = Math.round(100 * teleopAlgaePercent);
//        console.log("     ---> speakerShootingPercentage: " + pdata[key]["teleopSpeakerShootPercent"]); //TEST
      }

      //pdata[key]["trapPercentage"] = Math.round(100 * pdata[key]["trapPercentage"] / pdata[key]["totalmatches"]);
      //pdata[key]["spotlitPercentage"] = Math.round(100 * pdata[key]["spotlitPercentage"] / pdata[key]["totalmatches"]);
//      console.log("   >> number of traps is = " + pdata[key]["trapPercentage"]);
//      console.log("   >> spotlit (percentage) is = "+ pdata[key]["spotlitPercentage"]);
		
//      console.log("  ===> totalmatches = "+pdata[key]["totalmatches"]); //TEST
        
      pdata[key]["endgameClimbPercent"][0] = Math.round(100 * pdata[key]["endgameClimbPercent"][0] / pdata[key]["totalmatches"]);
      pdata[key]["endgameClimbPercent"][1] = Math.round(100 * pdata[key]["endgameClimbPercent"][1] / pdata[key]["totalmatches"]);
      pdata[key]["endgameClimbPercent"][2] = Math.round(100 * pdata[key]["endgameClimbPercent"][2] / pdata[key]["totalmatches"]);
      pdata[key]["endgameClimbPercent"][3] = Math.round(100 * pdata[key]["endgameClimbPercent"][3] / pdata[key]["totalmatches"]);
      pdata[key]["endgameClimbPercent"][4] = Math.round(100 * pdata[key]["endgameClimbPercent"][4] / pdata[key]["totalmatches"]);
        
      pdata[key]["endgameStartClimbingPercent"][0] = Math.round(100 * pdata[key]["endgameStartClimbingPercent"][0] / pdata[key]["totalmatches"]);
      pdata[key]["endgameStartClimbingPercent"][1] = Math.round(100 * pdata[key]["endgameStartClimbingPercent"][1] / pdata[key]["totalmatches"]);
      pdata[key]["endgameStartClimbingPercent"][2] = Math.round(100 * pdata[key]["endgameStartClimbingPercent"][2] / pdata[key]["totalmatches"]);
      pdata[key]["endgameStartClimbingPercent"][3] = Math.round(100 * pdata[key]["endgameStartClimbingPercent"][3] / pdata[key]["totalmatches"]);
        
      pdata[key]["endgameFoulPercent"][0] = Math.round(100 * pdata[key]["endgameFoulPercent"][0] / pdata[key]["totalmatches"]);
      pdata[key]["endgameFoulPercent"][1] = Math.round(100 * pdata[key]["endgameFoulPercent"][1] / pdata[key]["totalmatches"]);
      pdata[key]["endgameFoulPercent"][2] = Math.round(100 * pdata[key]["endgameFoulPercent"][2] / pdata[key]["totalmatches"]);
    }
    return pdata;
  }
}
