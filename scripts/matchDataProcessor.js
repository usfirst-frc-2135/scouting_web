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

    // For each team, go thru all its matches and do the calculations for the averages data.
    for (var i = 0; i < this.data.length; i++) 
    {
      var tn = this.data[i]["teamnumber"];
      console.log("===> doing MDP calculations for team: "+tn);  // TEST

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
          
        pdata[tn]["avgTotalCoralPoints"] = 0;
        pdata[tn]["maxTotalCoralPoints"] = 0;
        pdata[tn]["avgTotalAlgaePoints"] = 0;
        pdata[tn]["maxTotalAlgaePoints"] = 0;

        pdata[tn]["reefzoneABpercent"] = 0;
        pdata[tn]["reefzoneCDpercent"] = 0;
        pdata[tn]["reefzoneEFpercent"] = 0;
        pdata[tn]["reefzoneGHpercent"] = 0;
        pdata[tn]["reefzoneIJpercent"] = 0;
        pdata[tn]["reefzoneKLpercent"] = 0;

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
       
        pdata[tn]["totaldied"] = 0;

        pdata[tn]["totalmatches"] = 0;

        pdata[tn]["scoutnames"] = [];
        pdata[tn]["commentlist"] = [];
      }
	  
      console.log("   -> for match = "+ this.data[i]["matchnumber"]); //TEST
        
      pdata[tn]["reefzoneABpercent"] += this.data[i]["reefzoneAB"];
      pdata[tn]["reefzoneCDpercent"] += this.data[i]["reefzoneCD"];
      pdata[tn]["reefzoneEFpercent"] += this.data[i]["reefzoneEF"];
      pdata[tn]["reefzoneGHpercent"] += this.data[i]["reefzoneGH"];
      pdata[tn]["reefzoneIJpercent"] += this.data[i]["reefzoneIJ"];
      pdata[tn]["reefzoneKLpercent"] += this.data[i]["reefzoneKL"];

      var autonLeave = (this.data[i]["autonLeave"]);
      var autonLeavePoints = 0;
      if(parseInt(autonLeave) == 1)
        autonLeavePoints = 3;
      console.log("  --> auton Leave points = "+autonLeavePoints);  //TEST

      var currentAutonCoralL1 = (this.data[i]["autonCoralL1"]);
      console.log("  --> auton coral L1 = "+currentAutonCoralL1);  //TEST
      var currentAutonCoralL2 = (this.data[i]["autonCoralL2"]);
      console.log("  --> auton coral L2 = "+currentAutonCoralL2);  //TEST
      var currentAutonCoralL3 = (this.data[i]["autonCoralL3"]);
      console.log("  --> auton coral L3 = "+currentAutonCoralL3);  //TEST
      var currentAutonCoralL4 = (this.data[i]["autonCoralL4"]);
      console.log("  --> auton coral L4 = "+currentAutonCoralL4);  //TEST
      var currentAutonAlgaeNet = (this.data[i]["autonAlgaeNet"]);
      console.log("  --> auton algae net = "+currentAutonAlgaeNet);  //TEST
      var currentAutonAlgaeProcessor = (this.data[i]["autonAlgaeProcessor"]);
      console.log("  --> auton algae proc = "+currentAutonAlgaeProcessor);  //TEST

      var totalAutoCoral = parseInt(currentAutonCoralL1) + parseInt(currentAutonCoralL2) + parseInt(currentAutonCoralL3) + parseInt(currentAutonCoralL4);
      console.log("  --> total auton coral = "+totalAutoCoral);  //TEST

      var totalAutoCoralPoints = (parseInt(currentAutonCoralL1) * 3) + (parseInt(currentAutonCoralL2) * 4) + (parseInt(currentAutonCoralL3) * 6) + (parseInt(currentAutonCoralL4) * 7);
      console.log("  --> total auton coral pts = "+totalAutoCoralPoints);  //TEST

      var totalAutoAlgae = parseInt(currentAutonAlgaeNet) + parseInt(currentAutonAlgaeProcessor);
      var totalAutoAlgaePoints = (parseInt(currentAutonAlgaeNet) * 4) + (parseInt(currentAutonAlgaeProcessor) * 6)
      console.log("  --> total auton algae = "+totalAutoAlgae);  //TEST
      console.log("  --> total auton algae pts = "+totalAutoAlgaePoints);  //TEST

      var currentTeleopCoralL1 = (this.data[i]["teleopCoralL1"]);
      var currentTeleopCoralL2 = (this.data[i]["teleopCoralL2"]);
      var currentTeleopCoralL3 = (this.data[i]["teleopCoralL3"]);
      var currentTeleopCoralL4 = (this.data[i]["teleopCoralL4"]);
      var currentTeleopAlgaeNet = (this.data[i]["teleopAlgaeNet"]);
      var currentTeleopAlgaeProcessor = (this.data[i]["teleopAlgaeProcessor"]);

      var totalTeleopCoral = (parseInt(currentTeleopCoralL1)) + (parseInt(currentTeleopCoralL2)) + (parseInt(currentTeleopCoralL3)) + (parseInt(currentTeleopCoralL4));
      var totalTeleopCoralPoints = (parseInt(currentTeleopCoralL1) * 2) + (parseInt(currentTeleopCoralL2) * 3) + (parseInt(currentTeleopCoralL3) * 4) + (parseInt(currentTeleopCoralL4) * 5);
      console.log("  --> total teleop coral = "+totalTeleopCoral);  //TEST
      console.log("  --> total teleop coral pts = "+totalTeleopCoralPoints);  //TEST

      var totalTeleopAlgae = (parseInt(currentTeleopAlgaeNet)) + (parseInt(currentTeleopAlgaeProcessor));
      var totalTeleopAlgaePoints = (parseInt(currentTeleopAlgaeNet) * 4) + (parseInt(currentTeleopAlgaeProcessor) * 6);
      console.log("  --> total teleop algae = "+totalTeleopAlgae);  //TEST
      console.log("  --> total teleop algae pts = "+totalTeleopAlgaePoints);  //TEST

      var currentTeleopCoralAcquired = (this.data[i]["acquiredCoral"]);
      var currentTeleopAlgaeAcquired = (this.data[i]["acquiredAlgae"]);
      pdata[tn]["totalTeleopCoral"] += parseInt(totalTeleopCoral);
      pdata[tn]["teleopAcquireCoral"] += parseInt(currentTeleopCoralAcquired);
      pdata[tn]["totalTeleopAlgae"] += parseInt(totalTeleopAlgae);
      pdata[tn]["teleopAcquireAlgae"] += parseInt(currentTeleopAlgaeAcquired);

      var endgameClimbPoints = 0;
      var climbLevel = (this.data[i]["cageClimb"]);
      if (climbLevel == 1) { 
        endgameClimbPoints = 2; 
      }
      else if (climbLevel == 2) {
        endgameClimbPoints = 2;
      }
      else if (climbLevel == 3) {
        endgameClimbPoints = 6;
      }
      else if (climbLevel == 4) {
          endgameClimbPoints = 12;
      }
      console.log("  --> endgame climb points = "+endgameClimbPoints);  //TEST

      var totalCoral = totalAutoCoral + totalTeleopCoral;
      var totalAlgae = totalAutoAlgae + totalTeleopAlgae;
      var totalCoralPoints = totalAutoCoralPoints + totalTeleopCoralPoints;
      var totalAlgaePoints = totalAutoAlgaePoints + totalTeleopAlgaePoints;
      var totalAutoPoints = autonLeavePoints + totalAutoCoralPoints + totalAutoAlgaePoints;
      var totalTeleopPoints = totalTeleopCoralPoints + totalTeleopAlgaePoints;
      var totalPoints = totalAutoPoints + totalTeleopPoints + endgameClimbPoints;
      console.log("     ==> totalCoralPoints = "+totalCoralPoints);  //TEST
      console.log("     ==> totalAlgaePoints = "+totalAlgaePoints);  //TEST
      console.log("     ==> totalAutoPoints = "+totalAutoPoints);  //TEST
      console.log("     ==> totalTeleopPoints = "+totalTeleopPoints);  //TEST
      console.log("     ==> totalPoints = "+totalPoints);  //TEST
    
      pdata[tn]["avgTotalPoints"] += totalPoints;
      pdata[tn]["maxTotalPoints"] = Math.max(pdata[tn]["maxTotalPoints"], totalPoints);

      pdata[tn]["avgTotalCoralPoints"] += totalCoralPoints;
      pdata[tn]["maxTotalCoralPoints"] = Math.max(pdata[tn]["maxTotalCoralPoints"], totalCoralPoints);

      pdata[tn]["avgTotalAlgaePoints"] += totalAlgaePoints;
      pdata[tn]["maxTotalAlgaePoints"] = Math.max(pdata[tn]["maxTotalAlgaePoints"], totalAlgaePoints);

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
      pdata[tn]["endgameClimbPercent"][this.data[i]["cageClimb"]] += 1;
      //HOLD pdata[tn]["endgameStartClimbPercent"][this.data[i]["endgameStartClimbing"]] += 1;

      pdata[tn]["totaldied"] += this.data[i]["died"];
      pdata[tn]["totalmatches"] += 1;
      pdata[tn]["scoutnames"].push(this.data[i]["scoutname"]);
      pdata[tn]["commentlist"].push(this.data[i]["comment"]);
    }

    // Go thru each team in pdata and do the avg, max and percent calculations.
    for (var key in pdata) 
    {
      console.log(">>>> Calculations for team " + key);
      // Calculate the accuracy percentage before the actual AVG is calculated.
      var totalCoralAcquired = (parseInt(pdata[key]["teleopAcquireCoral"]));
      console.log("   ---> total (teleop) coral acquired: " + totalCoralAcquired); //TEST
      // If there are no coral acq'd, don't bother doing the calculation here.
      if (totalCoralAcquired != 0) {
        var teleopCoralPercent = (parseInt(pdata[key]["avgTeleopCoralScored"])) / totalCoralAcquired;
        pdata[key]["teleopCoralScoringPercent"] = Math.round(100 * teleopCoralPercent);
        console.log("    ---> Coral Scoring Percentage: " + pdata[key]["teleopCoralScoringPercent"]); //TEST
      }
      var totalAlgaeAcquired = (parseInt(pdata[key]["teleopAcquireAlgae"]));
      console.log("   ---> total (teleop) algae acquired: " + totalAlgaeAcquired); //TEST
      // If there are no algae acquired, don't bother doing the calculation here.
      if (totalAlgaeAcquired != 0) {
        var teleopAlgaePercent = (parseInt(pdata[key]["avgTeleopAlgaeScored"])) / totalAlgaeAcquired;
        pdata[key]["teleopAlgaeScoringPercent"] = Math.round(100 * teleopAlgaePercent);
        console.log("    ---> Algae Scoring Percentage: " + pdata[key]["teleopAlgaeScoringPercent"]); //TEST
      }
        
      pdata[key]["reefzoneABpercent"] = Math.round(100 * pdata[key]["reefzoneABpercent"] / pdata[key]["totalmatches"]);
      pdata[key]["reefzoneCDpercent"] = Math.round(100 * pdata[key]["reefzoneCDpercent"] / pdata[key]["totalmatches"]);
      pdata[key]["reefzoneEFpercent"] = Math.round(100 * pdata[key]["reefzoneEFpercent"] / pdata[key]["totalmatches"]);
      pdata[key]["reefzoneGHpercent"] = Math.round(100 * pdata[key]["reefzoneGHpercent"] / pdata[key]["totalmatches"]);
      pdata[key]["reefzoneIJpercent"] = Math.round(100 * pdata[key]["reefzoneIJpercent"] / pdata[key]["totalmatches"]);
      pdata[key]["reefzoneKLpercent"] = Math.round(100 * pdata[key]["reefzoneKLpercent"] / pdata[key]["totalmatches"]);

      pdata[key]["avgTotalPoints"] = Math.round(10 * pdata[key]["avgTotalPoints"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["avgTotalAutoPoints"] = Math.round(10 * pdata[key]["avgTotalAutoPoints"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["avgTotalAutoCoralPoints"] = Math.round(10 * pdata[key]["avgTotalAutoCoralPoints"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["avgTotalAutoAlgaePoints"] = Math.round(10 * pdata[key]["avgTotalAutoAlgaePoints"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["avgTotalTeleopPoints"] = Math.round(10 * pdata[key]["avgTotalTeleopPoints"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["avgTotalTeleopCoralPoints"] = Math.round(10 * pdata[key]["avgTotalTeleopCoralPoints"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["avgTotalTeleopAlgaePoints"] = Math.round(10 * pdata[key]["avgTotalTeleopAlgaePoints"] / pdata[key]["totalmatches"]) / 10;
        
      pdata[key]["avgTotalCoralPoints"] = Math.round(10 * pdata[key]["avgTotalCoralPoints"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["avgTotalAlgaePoints"] = Math.round(10 * pdata[key]["avgTotalAlgaePoints"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["avgTotalCoral"] = Math.round(10 * pdata[key]["avgTotalCoral"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["avgTotalAlgae"] = Math.round(10 * pdata[key]["avgTotalAlgae"] / pdata[key]["totalmatches"]) / 10;
      
      pdata[key]["avgAutonCoral"] = Math.round(10 * pdata[key]["avgAutonCoral"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["avgAutonAlgae"] = Math.round(10 * pdata[key]["avgAutonAlgae"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]
      
      pdata[key]["avgTeleopCoralScored"] = Math.round(10 * pdata[key]["avgTeleopCoralScored"] / pdata[key]["totalmatches"]) / 10; 
    
      pdata[key]["avgTeleopAlgaeScored"] = Math.round(10 * pdata[key]["avgTeleopAlgaeScored"] / pdata[key]["totalmatches"]) / 10; 
      
      pdata[key]["avgEndgamePoints"] = Math.round(10 * pdata[key]["avgEndgamePoints"] / pdata[key]["totalmatches"]) / 10;
        
      pdata[key]["avgAutonCoralL1"] = Math.round(10 * pdata[key]["avgAutonCoralL1"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["avgAutonCoralL2"] = Math.round(10 * pdata[key]["avgAutonCoralL2"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["avgAutonCoralL3"] = Math.round(10 * pdata[key]["avgAutonCoralL3"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["avgAutonCoralL4"] = Math.round(10 * pdata[key]["avgAutonCoralL4"] / pdata[key]["totalmatches"]) / 10;
        
      pdata[key]["avgAutonAlgaeNet"] = Math.round(10 * pdata[key]["avgAutonAlgaeNet"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["avgAutonAlgaeProc"] = Math.round(10 * pdata[key]["avgAutonAlgaeProc"] / pdata[key]["totalmatches"]) / 10;
        
      pdata[key]["avgTeleopCoralL1"] = Math.round(10 * pdata[key]["avgTeleopCoralL1"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["avgTeleopCoralL2"] = Math.round(10 * pdata[key]["avgTeleopCoralL2"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["avgTeleopCoralL3"] = Math.round(10 * pdata[key]["avgTeleopCoralL3"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["avgTeleopCoralL4"] = Math.round(10 * pdata[key]["avgTeleopCoralL4"] / pdata[key]["totalmatches"]) / 10;
        
      pdata[key]["avgTeleopAlgaeNet"] = Math.round(10 * pdata[key]["avgTeleopAlgaeNet"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["avgTeleopAlgaeProc"] = Math.round(10 * pdata[key]["avgTeleopAlgaeProc"] / pdata[key]["totalmatches"]) / 10;
	
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
