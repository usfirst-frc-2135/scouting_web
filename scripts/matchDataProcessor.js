/*
  Match Data Processor
  Takes in match data from source and calculates averages and other derived data from it.
*/

class matchDataProcessor {
  constructor(data) {
    /*
      Args:
        data: The input data that we get from the READ API
          data = [{eventcode : x,
                   teamnumber : x,
                   matchnumber : x,
                   startpos : x,
                   tarmac : x,
                   autonlowpoints : x,
                   autonhighpoints : x,
                   teleoplowpoints : x,
                   teleophighpoints : x,
                   climbed : x,
                   died : x,
                   scoutname : x,
                   comment : x
                  }]
    */
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
    /*

      Returns = {
                  teamNumber : { avgtotalpoints : x,
                                 maxtotalpoints : x,

                                 avgautopoints   : x,
                                 maxautopoints   : x,

                                 avgteleoppoints   : x,
                                 maxteleoppoints   : x,

                                 avgendgamepoints   : x,
                                 maxendgamepoints   : x,

                                 avgautonhighgoals  : x,
                                 maxautonhighgoals  : x,
                                 avgautonlowergoals : x,
                                 maxautonlowergoals : x,

                                 avgteleophighgoals  : x,
                                 maxteleophighgoals  : x,
                                 avgteleoplowergoals : x,
                                 maxteleoplowergoals : x,

                                 tarmacpercent       : 0
                                 endgameclimbpercent : {0:x, 1:x, 2:x, 3:x, 4:x}
                                 autostartpercent    : {1:x, 2:x, 3:x, 4:x, 5:x}

                                 totaldied : x,

                                 totalmatches : x

                                 scoutnames : []
                                 commentlist : []
                  }
                }
    */

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

        avg[tn]["avgautonconesbottom"] = 0;
        avg[tn]["maxautonconesbottom"] = 0;
		avg[tn]["avgautonconesmiddle"] = 0;
        avg[tn]["maxautonconesmiddle"] = 0;
		avg[tn]["avgautonconestop"] = 0;
        avg[tn]["maxautonconestop"] = 0;
		  
		avg[tn]["avgautoncubesbottom"] = 0;
        avg[tn]["maxautoncubesbottom"] = 0;
		avg[tn]["avgautoncubesmiddle"] = 0;
        avg[tn]["maxautoncubesmiddle"] = 0;
		avg[tn]["avgautoncubestop"] = 0;
        avg[tn]["maxautoncubestop"] = 0;
		  
		avg[tn]["avgteleopconesbottom"] = 0;
        avg[tn]["maxteleopconesbottom"] = 0;
		avg[tn]["avgteleopconesmiddle"] = 0;
        avg[tn]["maxteleopconesmiddle"] = 0;
		avg[tn]["avgteleopconestop"] = 0;
        avg[tn]["maxteleopconestop"] = 0;
		  
		avg[tn]["avgteleopcubesbottom"] = 0;
        avg[tn]["maxteleopcubesbottom"] = 0;
		avg[tn]["avgteleopcubesmiddle"] = 0;
        avg[tn]["maxteleopcubesmiddle"] = 0;
		avg[tn]["avgteleopcubestop"] = 0;
        avg[tn]["maxteleopcubestop"] = 0;
		  
		 
        avg[tn]["mobilitypercent"] = 0;
		avg[tn]["autonchargestationpercent"] = { 0: 0, 1: 0, 2: 0};
        avg[tn]["endgamechargestationpercent"] = { 0: 0, 1: 0, 2: 0, 3: 0 };
       

        avg[tn]["totaldied"] = 0;

        avg[tn]["totalmatches"] = 0;

        avg[tn]["scoutnames"] = [];
        avg[tn]["commentlist"] = [];
      }

      var autoPoints = (this.data[i]["autonbottompoints"] * 3) + (this.data[i]["autonmiddlepoints"] * 4) + (this.data[i]["autontoppoints"] * 6) + (this.data[i]["mobility"] * 3) + (this.data[i]["autondockedpoints"] *8) +(this.data[i]["autonengagedpoints"] * 12);
		
      var telopPoints = (this.data[i]["teleopbottompoints"] * 2) + (this.data[i]["teleopmiddlepoints"] * 3) + (this.data[i]["teleoptoppoints"] * 5); 
	  

      var endgamePoints = 0;
      if (this.data[i]["endgamechargestation"] == 1) { endgamePoints = 2; }
      if (this.data[i]["endgamechargestation"] == 2) { endgamePoints = 6; }
      if (this.data[i]["endgamechargestation"] == 3) { endgamePoints = 10; }
      

      var totalPoints = autoPoints + telopPoints + endgamePoints;

      avg[tn]["avgtotalpoints"] += totalPoints;
      avg[tn]["maxtotalpoints"] = Math.max(avg[tn]["maxtotalpoints"], totalPoints);

      avg[tn]["avgautopoints"] += autoPoints;
      avg[tn]["maxautopoints"] = Math.max(avg[tn]["maxautopoints"], autoPoints);

      avg[tn]["avgteleoppoints"] += telopPoints;
      avg[tn]["maxteleoppoints"] = Math.max(avg[tn]["maxteleoppoints"], telopPoints);

      avg[tn]["avgendgamepoints"] += endgamePoints;
      avg[tn]["maxendgamepoints"] = Math.max(avg[tn]["maxendgamepoints"], endgamePoints);
		

      avg[tn]["avgautonconesbottom"] += this.data[i]["autonbottompoints"];
      avg[tn]["maxautonconesbottom"] = Math.max(avg[tn]["maxautonconesbottom"], this.data[i]["autonbottompoints"]);
		
	  avg[tn]["avgautonconesmiddle"] += this.data[i]["autonmiddlepoints"];
      avg[tn]["maxautonconesmiddle"] = Math.max(avg[tn]["maxautonconesmiddle"], this.data[i]["autonmiddlepoints"]);
		
	  avg[tn]["avgautonconestop"] += this.data[i]["autontoppoints"];
      avg[tn]["maxautonconestop"] = Math.max(avg[tn]["maxautonconestop"], this.data[i]["autontoppoints"]);
		
	  avg[tn]["avgautoncubesbottom"] += this.data[i]["autonbottompoints"];
      avg[tn]["maxautoncubesbottom"] = Math.max(avg[tn]["maxautoncubesbottom"], this.data[i]["autonbottompoints"]);
		
	  avg[tn]["avgautoncubesmiddle"] += this.data[i]["autonmiddlepoints"];
      avg[tn]["maxautoncubesmiddle"] = Math.max(avg[tn]["maxautoncubesmiddle"], this.data[i]["autonmiddlepoints"]);
		
	  avg[tn]["avgautoncubestop"] += this.data[i]["autontoppoints"];
      avg[tn]["maxautoncubestop"] = Math.max(avg[tn]["maxautoncubestop"], this.data[i]["autontoppoints"]);
		
	  
	  avg[tn]["avgteleopconesbottom"] += this.data[i]["teleopbottompoints"];
      avg[tn]["maxteleopconesbottom"] = Math.max(avg[tn]["maxteleopconesbottom"], this.data[i]["teleopbottompoints"]);
		
	  avg[tn]["avgteleopconesmiddle"] += this.data[i]["teleopmiddlepoints"];
      avg[tn]["maxteleopconesmiddle"] = Math.max(avg[tn]["maxteleopconesmiddle"], this.data[i]["teleopmiddlepoints"]);
		
	  avg[tn]["avgteleopconestop"] += this.data[i]["teleoptoppoints"];
      avg[tn]["maxteleopconestop"] = Math.max(avg[tn]["maxteleopconestop"], this.data[i]["teleoptoppoints"]);
		
	  avg[tn]["avgteleopcubesbottom"] += this.data[i]["teleopbottompoints"];
      avg[tn]["maxteleopcubesbottom"] = Math.max(avg[tn]["maxteleopcubesbottom"], this.data[i]["teleopbottompoints"]);
		
	  avg[tn]["avgteleopcubesmiddle"] += this.data[i]["teleopmiddlepoints"];
      avg[tn]["maxteleopcubesmiddle"] = Math.max(avg[tn]["maxteleopcubesmiddle"], this.data[i]["teleopmiddlepoints"]);
		
	  avg[tn]["avgteleopcubestop"] += this.data[i]["teleoptoppoints"];
      avg[tn]["maxteleopcubestop"] = Math.max(avg[tn]["maxteleopcubestop"], this.data[i]["teleoptoppoints"]);
		

      avg[tn]["mobilitypercent"] += this.data[i]["mobility"];
      avg[tn]["endgamechargestationpercent"][this.data[i]["endgamechargestation"]] += 1;
      avg[tn]["autonchargestationpercent"][this.data[i]["autonchargestation"]] += 1;

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
	
      avg[key]["avgautonconesbottom"] = this.rnd(avg[key]["avgautonconesbottom"] / avg[key]["totalmatches"]);
	  avg[key]["avgautonconesmiddle"] = this.rnd(avg[key]["avgautonconesmiddle"] / avg[key]["totalmatches"]);
	  avg[key]["avgautonconestop"] = this.rnd(avg[key]["avgautonconestop"] / avg[key]["totalmatches"]);
		
	  avg[key]["avgautoncubesbottom"] = this.rnd(avg[key]["avgautoncubesbottom"] / avg[key]["totalmatches"]);
	  avg[key]["avgautoncubesmiddle"] = this.rnd(avg[key]["avgautoncubesmiddle"] / avg[key]["totalmatches"]);
	  avg[key]["avgautoncubestop"] = this.rnd(avg[key]["avgautoncubestop"] / avg[key]["totalmatches"]);
		
	  
	  avg[key]["avgteleopconesbottom"] = this.rnd(avg[key]["avgteleopconesbottom"] / avg[key]["totalmatches"]);
	  avg[key]["avgteleopconesmiddle"] = this.rnd(avg[key]["avgteleopconesmiddle"] / avg[key]["totalmatches"]);
	  avg[key]["avgteleopconestop"] = this.rnd(avg[key]["avgteleopconestop"] / avg[key]["totalmatches"]);
		
	  avg[key]["avgteleopcubesbottom"] = this.rnd(avg[key]["avgteleopcubesbottom"] / avg[key]["totalmatches"]);
	  avg[key]["avgteleopcubesmiddle"] = this.rnd(avg[key]["avgteleopcubesmiddle"] / avg[key]["totalmatches"]);
	  avg[key]["avgteleopcubestop"] = this.rnd(avg[key]["avgteleopcubestop"] / avg[key]["totalmatches"]);
	
		
      avg[key]["mobilitypercent"] = this.rnd(100 * avg[key]["mobilitypercent"] / avg[key]["totalmatches"]);

      avg[key]["endgamechargestationpercent"][0] = this.rnd(100 * avg[key]["endgamechargestationpercent"][0] / avg[key]["totalmatches"]);
      avg[key]["endgamechargestationpercent"][1] = this.rnd(100 * avg[key]["endgamechargestationpercent"][1] / avg[key]["totalmatches"]);
      avg[key]["endgamechargestationpercent"][2] = this.rnd(100 * avg[key]["endgamechargestationpercent"][2] / avg[key]["totalmatches"]);
      avg[key]["endgamechargestationpercent"][3] = this.rnd(100 * avg[key]["endgamechargestationpercent"][3] / avg[key]["totalmatches"]);
      

      avg[key]["autonchargestationpercent"][1] = this.rnd(100 * avg[key]["autonchargestationpercent"][1] / avg[key]["totalmatches"]);
      avg[key]["autonchargestationpercent"][2] = this.rnd(100 * avg[key]["autonchargestationpercent"][2] / avg[key]["totalmatches"]);
      avg[key]["autonchargestationpercent"][3] = this.rnd(100 * avg[key]["autonchargestationpercent"][3] / avg[key]["totalmatches"]);

    }

    return avg;

  }
}