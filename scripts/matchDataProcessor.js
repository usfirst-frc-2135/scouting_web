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

        pdata[tn]["avgtotalnotes"] = 0;
        pdata[tn]["maxtotalnotes"] = 0;

        pdata[tn]["avgautonotes"] = 0;
        pdata[tn]["maxautonotes"] = 0;

        pdata[tn]["avgteleopnotes"] = 0;
        pdata[tn]["maxteleopnotes"] = 0;

        pdata[tn]["avgendgamepoints"] = 0;
        pdata[tn]["maxendgamepoints"] = 0;
          
        pdata[tn]["avgautonamps"] = 0;
        pdata[tn]["maxautonamps"] = 0;
        pdata[tn]["avgautonspeaker"] = 0;
        pdata[tn]["maxautonspeaker"] = 0;
        pdata[tn]["autonSpeakerShootPercent"] = 0;
        pdata[tn]["totalAutonSpeakerNotes"] = 0;    // for calculating shooting percentage
        pdata[tn]["totalAutonSpeakerMisses"] = 0;   // for calculating shooting percentage
		
        pdata[tn]["avgteleopampnotes"] = 0;
        pdata[tn]["maxteleopampnotes"] = 0;
        pdata[tn]["avgteleopspeakernotes"] = 0;
        pdata[tn]["maxteleopspeakernotes"] = 0;
        pdata[tn]["teleopSpeakerShootPercent"] = 0;
        pdata[tn]["totalTeleopSpeakerNotes"] = 0;    // for calculating shooting percentage
        pdata[tn]["totalTeleopSpeakerMisses"] = 0;   // for calculating shooting percentage
          
        pdata[tn]["avgPasses"] = 0;
        pdata[tn]["maxPasses"] = 0;

        pdata[tn]["endgamestagepercent"] = {0:0, 1:0, 2:0};  
        pdata[tn]["endgameharmonypercent"] = {0:0, 1:0, 2:0};
        pdata[tn]["spotlitPercentage"] = 0;
        pdata[tn]["trapPercentage"] = 0;
       
        pdata[tn]["totaldied"] = 0;

        pdata[tn]["totalmatches"] = 0;

        pdata[tn]["scoutnames"] = [];
        pdata[tn]["commentlist"] = [];
      }
	  
      var totalmatches = (this.data[i]["totalmatches"]);
      var mobilitycheck = (this.data[i]["exitcommunity"]);
        
      var currentAutonAmpNotes = (this.data[i]["autonampnotes"]);
      var currentAutonSpeakerNotes = (this.data[i]["autonspeakernotes"]);
      var totalAutoNotes = parseInt(currentAutonAmpNotes) + parseInt(currentAutonSpeakerNotes);
      var currentAutonSpeakerMisses = (this.data[i]["autonspeakermisses"]);
      pdata[tn]["totalAutonSpeakerNotes"] += parseInt(currentAutonSpeakerNotes);
      pdata[tn]["totalAutonSpeakerMisses"] += parseInt(currentAutonSpeakerMisses);
//      console.log("   -> current auton speaker notes = "+ currentAutonSpeakerNotes); //TEST
//      console.log("   -> current auton speaker misses = "+ currentAutonSpeakerMisses); //TEST
//      console.log("   -> total auton speaker notes = " + pdata[tn]["totalAutonSpeakerNotes"]); //TEST
//      console.log("   -> total auton speaker misses = " + pdata[tn]["totalAutonSpeakerMisses"]); //TEST

      var currentTeleopAmpNotes = (this.data[i]["teleopampnotes"]);
      var currentTeleopSpeakerNotes = (this.data[i]["teleopspeakernotes"]);
      var totalTeleopNotes = (parseInt(currentTeleopAmpNotes)) + (parseInt(currentTeleopSpeakerNotes));
      var currentTeleopSpeakerMisses = (this.data[i]["teleopspeakermisses"]);
      pdata[tn]["totalTeleopSpeakerNotes"] += parseInt(currentTeleopSpeakerNotes);
      pdata[tn]["totalTeleopSpeakerMisses"] += parseInt(currentTeleopSpeakerMisses);
//      console.log("   -> current teleop speaker notes = "+ currentTeleopSpeakerNotes); //TEST
//      console.log("   -> current total teleop notes = "+ totalTeleopNotes); //TEST
//      console.log("   -> total teleop speaker notes = " + pdata[tn]["totalTeleopSpeakerNotes"]); //TEST
//      console.log("   -> total teleop speaker misses = " + pdata[tn]["totalTeleopSpeakerMisses"]); //TEST

      var passes = (this.data[i]["teleoppasses"]);

      var endgameStagePoints = (this.data[i]["endgamestage"]);
      var endgameHarmonyPoints = (this.data[i]["endgameharmony"]);
      if (endgameStagePoints == 2) { 
        endgameStagePoints = 3; 
      }
      //harmony points based on number of robots onstage
      if (endgameHarmonyPoints == 1) {
        endgameHarmonyPoints = 2;
      }
      else if (endgameHarmonyPoints == 2) {
        endgameHarmonyPoints = 4;
      }
      var endgameSpotlit = (this.data[i]["endgamespotlit"]);
      var endgameTrap = (this.data[i]["endgametrap"]);
      var endgamePoints = (endgameStagePoints) + (endgameHarmonyPoints) + (endgameSpotlit) + (endgameTrap * 5);
//      console.log("   >> spotlit = " + endgameSpotlit);
//      console.log("   >> endgame stage = " + endgameStagePoints);
//      console.log("   >> endgame harmomy = " + endgameHarmonyPoints);
//      console.log("   >> endgame trap = " + endgameTrap);
//      console.log("   >> endgame points = " + endgamePoints);
//      console.log("   -> endgamePoints = "+endgamePoints); //TEST
      var currentTrap = (parseInt(this.data[i]["endgametrap"]));
      pdata[tn]["trapPercentage"] += currentTrap;
        
      var currentSpotlit = (parseInt(this.data[i]["endgamespotlit"]));
      pdata[tn]["spotlitPercentage"] += currentSpotlit;
      
      var totalNotes = totalAutoNotes + totalTeleopNotes;

      pdata[tn]["avgtotalnotes"] += totalNotes;
      pdata[tn]["maxtotalnotes"] = Math.max(pdata[tn]["maxtotalnotes"], totalNotes);

      pdata[tn]["avgautonotes"] += totalAutoNotes;
      pdata[tn]["maxautonotes"] = Math.max(pdata[tn]["maxautonotes"], totalAutoNotes);
//      console.log("   -> avgautopoints = "+pdata[tn]["avgautopoints"]); //TEST

      pdata[tn]["avgteleopnotes"] += totalTeleopNotes;
      pdata[tn]["maxteleopnotes"] = Math.max(pdata[tn]["maxteleopnotes"], totalTeleopNotes);
		
      pdata[tn]["avgendgamepoints"] += endgamePoints;
      pdata[tn]["maxendgamepoints"] = Math.max(pdata[tn]["maxendgamepoints"], endgamePoints);
		
      var currentAutonAmpNotes = (parseInt(this.data[i]["autonampnotes"]));
      pdata[tn]["avgautonamps"] += currentAutonAmpNotes;
      pdata[tn]["maxautonamps"] = Math.max(pdata[tn]["maxautonamps"], currentAutonAmpNotes);
		
      var currentAutonSpeakerNotes = (parseInt(this.data[i]["autonspeakernotes"]));
      pdata[tn]["avgautonspeaker"] += currentAutonSpeakerNotes;
      pdata[tn]["maxautonspeaker"] = Math.max(pdata[tn]["maxautonspeaker"], currentAutonSpeakerNotes);

      var currentTeleopAmpNotes = (parseInt(this.data[i]["teleopampnotes"]));
      pdata[tn]["avgteleopampnotes"] += currentTeleopAmpNotes;
      pdata[tn]["maxteleopampnotes"] = Math.max(pdata[tn]["maxteleopampnotes"], currentTeleopAmpNotes);
	
      var currentTeleopSpeakerNotes = (parseInt(this.data[i]["teleopspeakernotes"]));
      pdata[tn]["avgteleopspeakernotes"] += currentTeleopSpeakerNotes;
      pdata[tn]["maxteleopspeakernotes"] = Math.max(pdata[tn]["maxteleopspeakernotes"], currentTeleopSpeakerNotes);
        
      var currentPasses = (parseInt(this.data[i]["teleoppasses"]));
      pdata[tn]["avgPasses"] += currentPasses;
      pdata[tn]["maxPasses"] = Math.max(pdata[tn]["maxPasses"], currentPasses);
	
      // For boolean data, we are just incrementing that data instead of adding the new value here.
      pdata[tn]["endgamestagepercent"][this.data[i]["endgamestage"]] += 1;
      pdata[tn]["endgameharmonypercent"][this.data[i]["endgameharmony"]] += 1;

      pdata[tn]["totaldied"] += this.data[i]["died"];
      pdata[tn]["totalmatches"] += 1;
      pdata[tn]["scoutnames"].push(this.data[i]["scoutname"]);
      pdata[tn]["commentlist"].push(this.data[i]["comment"]);
    }

    // Go thru each team in pdata and do the avg, max and percent calculations.
    for (var key in pdata) 
    {
//      console.log(">>>> for team " + key);
      pdata[key]["avgtotalnotes"] = Math.round(10 * pdata[key]["avgtotalnotes"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["avgautonotes"] = Math.round(10 * pdata[key]["avgautonotes"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["avgteleopnotes"] = Math.round(10 * pdata[key]["avgteleopnotes"] / pdata[key]["totalmatches"]) / 10; 
      pdata[key]["avgendgamepoints"] = Math.round(10 * pdata[key]["avgendgamepoints"] / pdata[key]["totalmatches"]) / 10;
	
      pdata[key]["avgautonamps"] = Math.round(10 * pdata[key]["avgautonamps"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["avgautonspeaker"] = Math.round(10 * pdata[key]["avgautonspeaker"] / pdata[key]["totalmatches"]) / 10;
		
      var totalAutonSpeakerShots = (parseInt(pdata[key]["totalAutonSpeakerNotes"]) + (parseInt(pdata[key]["totalAutonSpeakerMisses"])));
//      console.log("     ---> total auton speakerShots calculated: " + totalAutonSpeakerShots); //TEST
      // If there are no shots, don't bother doing the calculation here.
      if (totalAutonSpeakerShots != 0) {
        var autonSpeakerShotPercent = (parseInt(pdata[key]["totalAutonSpeakerNotes"])) / totalAutonSpeakerShots;
        pdata[key]["autonSpeakerShootPercent"] = Math.round(100 * autonSpeakerShotPercent);
//        console.log("     ---> Auton speakerShootingPercentage: " + pdata[key]["autonSpeakerShootPercent"]); //TEST
      }

      pdata[key]["avgteleopampnotes"] = Math.round(10 * pdata[key]["avgteleopampnotes"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["avgteleopspeakernotes"] = Math.round(10 * pdata[key]["avgteleopspeakernotes"] / pdata[key]["totalmatches"]) / 10;
      pdata[key]["avgPasses"] = Math.round(10 * pdata[key]["avgPasses"] / pdata[key]["totalmatches"]) / 10;

      var totalTeleopSpeakerShots = (parseInt(pdata[key]["totalTeleopSpeakerNotes"]) + (parseInt(pdata[key]["totalTeleopSpeakerMisses"])));
//      console.log("     ---> total teleop speakerShots calculated: " + totalTeleopSpeakerShots); //TEST
      // If there are no shots, don't bother doing the calculation here.
      if (totalTeleopSpeakerShots != 0) {
        var teleopSpeakerShotPercent = (parseInt(pdata[key]["totalTeleopSpeakerNotes"])) / totalTeleopSpeakerShots;
        pdata[key]["teleopSpeakerShootPercent"] = Math.round(100 * teleopSpeakerShotPercent);
//        console.log("     ---> speakerShootingPercentage: " + pdata[key]["teleopSpeakerShootPercent"]); //TEST
      }

      pdata[key]["trapPercentage"] = Math.round(100 * pdata[key]["trapPercentage"] / pdata[key]["totalmatches"]);
      pdata[key]["spotlitPercentage"] = Math.round(100 * pdata[key]["spotlitPercentage"] / pdata[key]["totalmatches"]);
//      console.log("   >> number of traps is = " + pdata[key]["trapPercentage"]);
//      console.log("   >> spotlit (percentage) is = "+ pdata[key]["spotlitPercentage"]);
		
//      console.log("  ===> totalmatches = "+pdata[key]["totalmatches"]); //TEST
        
      pdata[key]["endgamestagepercent"][0] = Math.round(100 * pdata[key]["endgamestagepercent"][0] / pdata[key]["totalmatches"]);
      pdata[key]["endgamestagepercent"][1] = Math.round(100 * pdata[key]["endgamestagepercent"][1] / pdata[key]["totalmatches"]);
      pdata[key]["endgamestagepercent"][2] = Math.round(100 * pdata[key]["endgamestagepercent"][2] / pdata[key]["totalmatches"]);
        
      pdata[key]["endgameharmonypercent"][0] = Math.round(100 * pdata[key]["endgameharmonypercent"][0] / pdata[key]["totalmatches"]);
      pdata[key]["endgameharmonypercent"][1] = Math.round(100 * pdata[key]["endgameharmonypercent"][1] / pdata[key]["totalmatches"]);
      pdata[key]["endgameharmonypercent"][2] = Math.round(100 * pdata[key]["endgameharmonypercent"][2] / pdata[key]["totalmatches"]);
    }
    return pdata;
  }
}
