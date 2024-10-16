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
    var avg = {}; //general for all matches and all teams
    for (var i = 0; i < this.data.length; i++) {
      var tn = this.data[i]["teamnumber"];

      if (!(tn in avg)) {
        avg[tn] = {};

        avg[tn]["avgtotalnotes"] = 0;
        avg[tn]["maxtotalnotes"] = 0;

        avg[tn]["avgautonotes"] = 0;
        avg[tn]["maxautonotes"] = 0;

        avg[tn]["avgteleopnotes"] = 0;
        avg[tn]["maxteleopnotes"] = 0;

        avg[tn]["avgendgamepoints"] = 0;
        avg[tn]["maxendgamepoints"] = 0;
          
        avg[tn]["avgautonamps"] = 0;
        avg[tn]["maxautonamps"] = 0;
        avg[tn]["avgautonspeaker"] = 0;
        avg[tn]["maxautonspeaker"] = 0;
        avg[tn]["autonSpeakerShootPercent"] = 0;
		
        avg[tn]["avgteleopampnotes"] = 0;
        avg[tn]["maxteleopampnotes"] = 0;
        avg[tn]["avgteleopspeakernotes"] = 0;
        avg[tn]["maxteleopspeakernotes"] = 0;
        avg[tn]["teleopSpeakerShootPercent"] = 0;
          
        avg[tn]["avgPasses"] = 0;
        avg[tn]["maxPasses"] = 0;

        avg[tn]["endgamestagepercent"] = {0:0, 1:0, 2:0};  
        avg[tn]["endgameharmonypercent"] = {0:0, 1:0, 2:0};
        avg[tn]["spotlitPercentage"] = 0;
        avg[tn]["trapPercentage"] = 0;
       
        avg[tn]["totaldied"] = 0;

        avg[tn]["totalmatches"] = 0;

        avg[tn]["scoutnames"] = [];
        avg[tn]["commentlist"] = [];
      }
	  
      var totalmatches = (this.data[i]["totalmatches"]);
      var mobilitycheck = (this.data[i]["exitcommunity"]);
        
      var autonAmpNotes = (this.data[i]["autonampnotes"]);
      var autonSpeakerNotes = (this.data[i]["autonspeakernotes"]);
		
      var autoNotes = (autonAmpNotes) + (autonSpeakerNotes);
//      console.log("===> for team "+tn+":"); //TEST
      var autonSpeakerMisses = (this.data[i]["autonspeakermisses"]);
      var totalAutonSpeakerShots = (parseInt(autonSpeakerNotes)) + (parseInt(autonSpeakerMisses));
      if (totalAutonSpeakerShots != 0) {
          var autonSpeakerShotPercent = (parseInt(autonSpeakerNotes)) / totalAutonSpeakerShots;
          avg[tn]["autonSpeakerShootPercent"] += autonSpeakerShotPercent;
      }

      var teleopAmpNotes = (this.data[i]["teleopampnotes"]);
      var teleopSpeakerNotes = (this.data[i]["teleopspeakernotes"]);
      var teleopNotes = (parseInt(teleopAmpNotes)) + (parseInt(teleopSpeakerNotes));
//      console.log("   -> teleop notes = "+teleopNotes); //TEST

      // Calculate the shooting percentage for each match: (#speakerNotes/#totalNotes)
      var teleopSpeakerMisses = (this.data[i]["teleopspeakermisses"]);
      var totalSpeakerShots = (parseInt(teleopSpeakerNotes)) + (parseInt(teleopSpeakerMisses));
      // If there are no shots, don't bother doing the calculation here.
      if (totalSpeakerShots != 0) {
        var teleopSpeakerShotPercent = (parseInt(teleopSpeakerNotes)) / totalSpeakerShots;
        avg[tn]["teleopSpeakerShootPercent"] += teleopSpeakerShotPercent;
      }

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
//      console.log(">> spotlit = " + endgameSpotlit);
//      console.log(">> endgame stage = " + endgameStagePoints);
//      console.log(">> endgame harmomy = " + endgameHarmonyPoints);
//      console.log(">> endgame trap = " + endgameTrap);
//      console.log(">> endgame points = " + endgamePoints);
//      console.log("   -> endgamePoints = "+endgamePoints); //TEST
      var combinedTrap = (parseInt(this.data[i]["endgametrap"]));
      avg[tn]["trapPercentage"] += combinedTrap;
        
      var combinedSpotlit = (parseInt(this.data[i]["endgamespotlit"]));
      avg[tn]["spotlitPercentage"] += combinedSpotlit;
      
      var totalNotes = autoNotes + teleopNotes;
//      console.log("     -> totalPoints = "+totalPoints); //TEST

      avg[tn]["avgtotalnotes"] += totalNotes;
      avg[tn]["maxtotalnotes"] = Math.max(avg[tn]["maxtotalnotes"], totalNotes);

      avg[tn]["avgautonotes"] += autoNotes;
      avg[tn]["maxautonotes"] = Math.max(avg[tn]["maxautonotes"], autoNotes);
//      console.log("   -> avgautopoints = "+avg[tn]["avgautopoints"]); //TEST

      avg[tn]["avgteleopnotes"] += teleopNotes;
      avg[tn]["maxteleopnotes"] = Math.max(avg[tn]["maxteleopnotes"], teleopNotes);
		
      avg[tn]["avgendgamepoints"] += endgamePoints;
      avg[tn]["maxendgamepoints"] = Math.max(avg[tn]["maxendgamepoints"], endgamePoints);
		
      var combinedAutonAmpNotes = (parseInt(this.data[i]["autonampnotes"]));
      avg[tn]["avgautonamps"] += combinedAutonAmpNotes;
      avg[tn]["maxautonamps"] = Math.max(avg[tn]["maxautonamps"], combinedAutonAmpNotes);
		
      var combinedAutonSpeakerNotes = (parseInt(this.data[i]["autonspeakernotes"]));
      avg[tn]["avgautonspeaker"] += combinedAutonSpeakerNotes;
      avg[tn]["maxautonspeaker"] = Math.max(avg[tn]["maxautonspeaker"], combinedAutonSpeakerNotes);

      var combinedTeleopAmpNotes = (parseInt(this.data[i]["teleopampnotes"]));
      avg[tn]["avgteleopampnotes"] += combinedTeleopAmpNotes;
      avg[tn]["maxteleopampnotes"] = Math.max(avg[tn]["maxteleopampnotes"], combinedTeleopAmpNotes);
	
      var combinedTeleopSpeakerNotes = (parseInt(this.data[i]["teleopspeakernotes"]));
      avg[tn]["avgteleopspeakernotes"] += combinedTeleopSpeakerNotes;
      avg[tn]["maxteleopspeakernotes"] = Math.max(avg[tn]["maxteleopspeakernotes"], combinedTeleopSpeakerNotes);
        
      var combinedPasses = (parseInt(this.data[i]["teleoppasses"]));
      avg[tn]["avgPasses"] += combinedPasses;
      avg[tn]["maxPasses"] = Math.max(avg[tn]["maxPasses"], combinedPasses);
	
      // For some reason the real website handling of boolean data (exit and mobilitypercent
      // is to treat it like a string, and keep appending the next value 
      // as a char. To fix that, we are just incrementing mobilitypercent instead of
      // adding the value here.
      
      avg[tn]["endgamestagepercent"][this.data[i]["endgamestage"]] += 1;
      avg[tn]["endgameharmonypercent"][this.data[i]["endgameharmony"]] += 1;

      avg[tn]["totaldied"] += this.data[i]["died"];
      avg[tn]["totalmatches"] += 1;
      avg[tn]["scoutnames"].push(this.data[i]["scoutname"]);
      avg[tn]["commentlist"].push(this.data[i]["comment"]);

    }

    for (var key in avg) {
//      console.log(">>>> for team " + key);
      avg[key]["avgtotalnotes"] = Math.round(10 * avg[key]["avgtotalnotes"] / avg[key]["totalmatches"]) / 10;
      avg[key]["avgautonotes"] = Math.round(10 * avg[key]["avgautonotes"] / avg[key]["totalmatches"]) / 10;
      avg[key]["avgteleopnotes"] = Math.round(10 * avg[key]["avgteleopnotes"] / avg[key]["totalmatches"]) / 10; 
      avg[key]["avgendgamepoints"] = Math.round(10 * avg[key]["avgendgamepoints"] / avg[key]["totalmatches"]) / 10;
	
      avg[key]["avgautonamps"] = Math.round(10 * avg[key]["avgautonamps"] / avg[key]["totalmatches"]) / 10;
      avg[key]["avgautonspeaker"] = Math.round(10 * avg[key]["avgautonspeaker"] / avg[key]["totalmatches"]) / 10;
      if (avg[key]["autonSpeakerShootPercent"] != "0") {
        avg[key]["autonSpeakerShootPercent"] = Math.round(100 * avg[key]["autonSpeakerShootPercent"] / avg[key]["totalmatches"]); 
      }
		
      avg[key]["avgteleopampnotes"] = Math.round(10 * avg[key]["avgteleopampnotes"] / avg[key]["totalmatches"]) / 10;
      avg[key]["avgteleopspeakernotes"] = Math.round(10 * avg[key]["avgteleopspeakernotes"] / avg[key]["totalmatches"]) / 10;
      if (avg[key]["teleopSpeakerShootPercent"] != "0") {
        avg[key]["teleopSpeakerShootPercent"] = Math.round(100 * avg[key]["teleopSpeakerShootPercent"] / avg[key]["totalmatches"]); 
      }
//      console.log("---> AVG shootingPercentage calculated: "+ avg[key]["teleopSpeakerShootPercent"]); //TEST
        
      avg[key]["avgPasses"] = Math.round(10 * avg[key]["avgPasses"] / avg[key]["totalmatches"]) / 10;

      avg[key]["trapPercentage"] = Math.round(100 * avg[key]["trapPercentage"] / avg[key]["totalmatches"]);
      avg[key]["spotlitPercentage"] = Math.round(100 * avg[key]["spotlitPercentage"] / avg[key]["totalmatches"]);
//      console.log("   >> number of traps is = " + avg[key]["trapPercentage"]);
//      console.log("   >> spotlit (percentage) is = "+ avg[key]["spotlitPercentage"]);
		
//      console.log("  ===> totalmatches = "+avg[key]["totalmatches"]); //TEST
        
      avg[key]["endgamestagepercent"][0] = Math.round(100 * avg[key]["endgamestagepercent"][0] / avg[key]["totalmatches"]);
      avg[key]["endgamestagepercent"][1] = Math.round(100 * avg[key]["endgamestagepercent"][1] / avg[key]["totalmatches"]);
      avg[key]["endgamestagepercent"][2] = Math.round(100 * avg[key]["endgamestagepercent"][2] / avg[key]["totalmatches"]);
        
      avg[key]["endgameharmonypercent"][0] = Math.round(100 * avg[key]["endgameharmonypercent"][0] / avg[key]["totalmatches"]);
      avg[key]["endgameharmonypercent"][1] = Math.round(100 * avg[key]["endgameharmonypercent"][1] / avg[key]["totalmatches"]);
      avg[key]["endgameharmonypercent"][2] = Math.round(100 * avg[key]["endgameharmonypercent"][2] / avg[key]["totalmatches"]);
    }
    return avg;
  }
}
