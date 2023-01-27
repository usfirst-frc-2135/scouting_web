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
    /*
      Modify this.data to only include matches between start_match and end_match
    */
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
    /* Rounding helper function */
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
    /*
      Modify this.data to only include matches specified by the site filter
    */
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
      //
      // console.log(temp_this);
      temp_this.applySiteFilter();
      //
      successFunction(temp_this.getAverages());
    });
  }

  getAverages() {
    var avg = {}; //general for all matches and all teams
    for (var i = 0; i < this.data.length; i++) {
      var tn = this.data[i]["teamnumber"];
      if (!(tn in avg)) {
        avg[tn] = {};

        avg[tn]["avgtotalpoints"] = 0;
        avg[tn]["maxtotalpoints"] = 0;

        avg[tn]["avgautopoints"] = 0;
        avg[tn]["maxautopoints"] = 0;

        avg[tn]["avgteleoppoints"] = 0;
        avg[tn]["maxteleoppoints"] = 0;

        avg[tn]["avgendgamepoints"] = 0;
        avg[tn]["maxendgamepoints"] = 0;

        avg[tn]["avgautoncones"] = 0;
        avg[tn]["maxautoncones"] = 0;
	avg[tn]["avgautoncubes"] = 0;
        avg[tn]["maxautoncubes"] = 0;
		
        avg[tn]["avg_autontoprowitems"] = 0;
        avg[tn]["max_autontoprowitems"] = 0;
        avg[tn]["avg_autonmidrowitems"] = 0;
        avg[tn]["max_autonmidrowitems"] = 0;
        avg[tn]["avg_autonbotrowitems"] = 0;
        avg[tn]["max_autonbotrowitems"] = 0;

	avg[tn]["avgteleopcones"] = 0;
        avg[tn]["maxteleopcones"] = 0;
	avg[tn]["avgteleopcubes"] = 0;
        avg[tn]["maxteleopcubes"] = 0;
		  
	avg[tn]["autonchargestationpercent"] = { 0: 0, 1: 0, 2: 0};
        avg[tn]["endgamechargestationpercent"] = { 0: 0, 1: 0, 2: 0, 3: 0 };  
       
        avg[tn]["totaldied"] = 0;

        avg[tn]["totalmatches"] = 0;

        avg[tn]["scoutnames"] = [];
        avg[tn]["commentlist"] = [];
      }
	  
      var totalmatches = (this.data[i]["totalmatches"]);
      var mobilitycheck = (this.data[i]["exitcommunity"]);
      var autonbottomPieces = (this.data[i]["autonconesbottom"]) += (this.data[i]["autoncubesbottom"]);
      var autonmiddlePieces = (this.data[i]["autonconesmiddle"]) += (this.data[i]["autoncubesmiddle"]);
      var autontopPieces = (this.data[i]["autonconestop"]) += (this.data[i]["autoncubestop"]);
      var autonchargestationPoints = 0;
	 
      if (this.data[i]["autonchargelevel"] == 1) { 
        autonchargestationPoints = 8; 
      }
      if (this.data[i]["autonchargelevel"] == 2) { 
        autonchargestationPoints = 12; 
      }
		
      var autoPoints = ((mobilitycheck * 3) + (autonbottomPieces * 3) + (autonmiddlePieces * 5) + (autontopPieces * 6) +(autonchargestationPoints));

      var teleopbottomPieces = (this.data[i]["teleopconesbottom"]) + (this.data[i]["teleopcubesbottom"]);
      var teleopmiddlePieces = (this.data[i]["teleopconesmiddle"]) + (this.data[i]["teleopcubesmiddle"]);
      var teleoptopPieces = (this.data[i]["teleopconestop"]) + (this.data[i]["teleopcubestop"]);
      var telopPoints = ((parseInt(teleopbottomPieces) * 3) + (parseInt(teleopmiddlePieces) * 5) + (parseInt(teleoptopPieces) * 6));

      var endgamePoints = 0;
      if (this.data[i]["endgamechargelevel"] == 1) { 
        endgamePoints = 2; 
      }
      if (this.data[i]["endgamechargelevel"] == 2) { 
        endgamePoints = 6; 
      }
      if (this.data[i]["endgamechargelevel"] == 3) { 
        endgamePoints = 10; 
      }
      
      var totalPoints = autoPoints + telopPoints + endgamePoints;
      var autonconePieces = (this.data[i]["autonconesbottom"]) + (this.data[i]["autonconesmiddle"]) + (this.data[i]["autonconestop"]);
      var autoncubePieces = (this.data[i]["autoncubesbottom"]) + (this.data[i]["autoncubesmiddle"]) + (this.data[i]["autoncubestop"]);
      var teleopconePieces = (this.data[i]["teleopconesbottom"]) + (this.data[i]["teleopconesmiddle"]) + (this.data[i]["teleopconestop"]);
      var teleopcubePieces = (this.data[i]["teleopcubesbottom"]) + (this.data[i]["teleopcubesmiddle"]) + (this.data[i]["teleopcubestop"]);

      avg[tn]["avgtotalpoints"] += totalPoints;
      avg[tn]["maxtotalpoints"] = Math.max(avg[tn]["maxtotalpoints"], totalPoints);

      avg[tn]["avgautopoints"] += autoPoints;
      avg[tn]["maxautopoints"] = Math.max(avg[tn]["maxautopoints"], autoPoints);

      avg[tn]["avgteleoppoints"] += telopPoints;
      avg[tn]["maxteleoppoints"] = Math.max(avg[tn]["maxteleoppoints"], telopPoints);
		
      avg[tn]["avgendgamepoints"] += endgamePoints;
      avg[tn]["maxendgamepoints"] = Math.max(avg[tn]["maxendgamepoints"], endgamePoints);
		
      var combinedAutonCones = (parseInt(this.data[i]["autonconestop"]))+(parseInt(this.data[i]["autonconesmiddle"]))+(parseInt(this.data[i]["autonconesbottom"]));
      var topcones = (parseInt(this.data[i]["autonconestop"]));
//      console.log ("top cones is " + topcones);
//      console.log(">+++=== initial auton cone value " + combinedAutonCones);
      avg[tn]["avgautoncones"] += combinedAutonCones;
      avg[tn]["maxautoncones"] = Math.max(avg[tn]["maxautoncones"], combinedAutonCones);
//      console.log(">+++=== auton cone value " + combinedAutonCones);
		
      var combinedAutonCubes = (parseInt(this.data[i]["autoncubestop"]))+(parseInt(this.data[i]["autoncubesmiddle"]))+(parseInt(this.data[i]["autoncubesbottom"]));
      avg[tn]["avgautoncubes"] += combinedAutonCubes;
      avg[tn]["maxautoncubes"] = Math.max(avg[tn]["maxautoncubes"], combinedAutonCubes);
		
      var autonTopRowItems = (parseInt(this.data[i]["autonconestop"]))+(parseInt(this.data[i]["autoncubestop"]));
      var autonMidRowItems = (parseInt(this.data[i]["autonconesmiddle"]))+(parseInt(this.data[i]["autoncubesmiddle"]));
      var autonBotRowItems = (parseInt(this.data[i]["autonconesbottom"]))+(parseInt(this.data[i]["autoncubesbottom"]));
      avg[tn]["avg_autontoprowitems"] += autonTopRowItems;
      avg[tn]["max_autontoprowitems"] = Math.max(avg[tn]["max_autontoprowitems"], autonTopRowItems);
      avg[tn]["avg_autonmidrowitems"] += autonMidRowItems;
      avg[tn]["max_autonmidrowitems"] = Math.max(avg[tn]["max_autonmidrowitems"], autonMidRowItems);
      avg[tn]["avg_autonbotrowitems"] += autonBotRowItems;
      avg[tn]["max_autonbotrowitems"] = Math.max(avg[tn]["max_autonbotrowitems"], autonBotRowItems);

      var combinedTeleopCones = (parseInt(this.data[i]["teleopconestop"]))+(parseInt(this.data[i]["teleopconesmiddle"]))+(parseInt(this.data[i]["teleopconesbottom"]));
      avg[tn]["avgteleopcones"] += combinedTeleopCones;
      avg[tn]["maxteleopcones"] = Math.max(avg[tn]["maxteleopcones"], combinedTeleopCones);
	
      var combinedTeleopCubes = (parseInt(this.data[i]["teleopcubestop"]))+(parseInt(this.data[i]["teleopcubesmiddle"]))+(parseInt(this.data[i]["teleopcubesbottom"]));
      avg[tn]["avgteleopcubes"] += combinedTeleopCubes;
      avg[tn]["maxteleopcubes"] = Math.max(avg[tn]["maxteleopcubes"], combinedTeleopCubes);
		
      avg[tn]["endgamechargestationpercent"][this.data[i]["endgamechargelevel"]] += 1;
      avg[tn]["autonchargestationpercent"][this.data[i]["autonchargelevel"]] += 1;
      avg[tn]["totaldied"] += this.data[i]["died"];
      avg[tn]["totalmatches"] += 1;
      avg[tn]["scoutnames"].push(this.data[i]["scoutname"]);
      avg[tn]["commentlist"].push(this.data[i]["comment"]);

    }

    for (var key in avg) {
      avg[key]["avgtotalpoints"] = this.rnd(avg[key]["avgtotalpoints"] / avg[key]["totalmatches"]);
      avg[key]["avgautopoints"] = this.rnd(avg[key]["avgautopoints"] / avg[key]["totalmatches"]);
      avg[key]["avgteleoppoints"] = this.rnd(avg[key]["avgteleoppoints"] / avg[key]["totalmatches"]);
      avg[key]["avgendgamepoints"] = this.rnd(avg[key]["avgendgamepoints"] / avg[key]["totalmatches"]);
	
      avg[key]["avgautoncones"] = this.rnd(avg[key]["avgautoncones"] / avg[key]["totalmatches"]);
      avg[key]["avgautoncubes"] = this.rnd(avg[key]["avgautoncubes"] / avg[key]["totalmatches"]);
		
      avg[key]["avgteleopcones"] = this.rnd(avg[key]["avgteleopcones"] / avg[key]["totalmatches"]);
      avg[key]["avgteleopcubes"] = this.rnd(avg[key]["avgteleopcubes"] / avg[key]["totalmatches"]);
	
      avg[key]["avg_autontoprowitems"] = this.rnd(avg[key]["avg_autontoprowitems"] / avg[key]["totalmatches"]);
      avg[key]["avg_autonmidrowitems"] = this.rnd(avg[key]["avg_autonmidrowitems"] / avg[key]["totalmatches"]);
      avg[key]["avg_autonmidrowitems"] = this.rnd(avg[key]["avg_autonmidrowitems"] / avg[key]["totalmatches"]);

      avg[key]["endgamechargestationpercent"][0] = this.rnd(100 * avg[key]["endgamechargestationpercent"][0] / avg[key]["totalmatches"]);
      avg[key]["endgamechargestationpercent"][1] = this.rnd(100 * avg[key]["endgamechargestationpercent"][1] / avg[key]["totalmatches"]);
      avg[key]["endgamechargestationpercent"][2] = this.rnd(100 * avg[key]["endgamechargestationpercent"][2] / avg[key]["totalmatches"]);
      avg[key]["endgamechargestationpercent"][3] = this.rnd(100 * avg[key]["endgamechargestationpercent"][3] / avg[key]["totalmatches"]);
      
      avg[key]["autonchargestationpercent"][0] = this.rnd(100 * avg[key]["autonchargestationpercent"][0] / avg[key]["totalmatches"]);
      avg[key]["autonchargestationpercent"][1] = this.rnd(100 * avg[key]["autonchargestationpercent"][1] / avg[key]["totalmatches"]);
      avg[key]["autonchargestationpercent"][2] = this.rnd(100 * avg[key]["autonchargestationpercent"][2] / avg[key]["totalmatches"]);
    }
    return avg;
  }
}
