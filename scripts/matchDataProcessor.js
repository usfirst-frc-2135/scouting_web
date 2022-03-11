/*
  Match Data Processor
  Takes in match data from source and calculates averages and other derived data from it.
*/

class matchDataProcessor {
  constructor(data){
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
  }
  
  get_match_tuple(match_str){
    match_str = match_str.toLowerCase();
    if (match_str.search("p") != -1){
      return ["p", parseInt(match_str.substr(1))];
    }
    if (match_str.search("qm") != -1){
      return ["qm", parseInt(match_str.substr(2))];
    }
    if (match_str.search("qf") != -1){
      return ["qf", parseInt(match_str.substr(2))];
    }
    if (match_str.search("sf") != -1){
      return ["sf", parseInt(match_str.substr(2))];
    }
    if (match_str.search("f") != -1){
      return ["f", parseInt(match_str.substr(1))];
    }
    return null;
  }
  
  verify_valid_start_end_match(start_match, end_match){
    var sm = this.get_match_tuple(start_match);
    var em = this.get_match_tuple(end_match);
    console.log(sm);
    console.log(em);
    var type_prog = {"p" : 0, "qm" : 1, "qf" : 2, "sf" : 3, "f" : 4};
    if (sm == null || em == null){
      return false;
    }
    if (type_prog[sm[0]] < type_prog[em[0]]){
      return true;
    }
    if (type_prog[sm[0]] > type_prog[em[0]]){
      return false;
    }
    return sm[1] <= em[1];
  }
  
  check_if_in_range(start_match, middle_match, end_match){
    return this.verify_valid_start_end_match(start_match, middle_match) && this.verify_valid_start_end_match(middle_match, end_match);
  }
  
  filterMatches(start_match, end_match){
    /*
      Modify this.data to only include matches between start_match and end_match
    */
    var type_prog = ["p", "qm", "qf", "sf", "f"];
    var new_data = [];
    for (var i = 0; i < this.data.length; i++){
      var mid_str = this.data[i]["matchnumber"];
      if (this.get_match_tuple(mid_str) == null){
        mid_str = "qm" + mid_str;
      }
      if (this.check_if_in_range(start_match, mid_str, end_match)){
        new_data.push(this.data[i]);
      }
      
    }
    this.data = new_data;
  }
  
  rnd(val){
    /* Rounding helper function */
    return Math.round((val + Number.EPSILON) * 100) / 100;
  }
  
  removePracticeMatches(){
    var new_data = [];
    for (var i = 0; i < this.data.length; i++){
      var mid_str = this.data[i]["matchnumber"];
      var mt = this.get_match_tuple(mid_str);
      if (mt == null || mt != "p"){
        new_data.push(this.data[i]);
      }
      
    }
    this.data = new_data;
  }
  
  
  getAverages(){
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
    
    var avg={}; //general for all matches and all teams
    for (var i=0; i<this.data.length; i++){
      var tn = this.data[i]["teamnumber"];
      if (! (tn in avg)){
        avg[tn] = {};
        
        avg[tn]["avgtotalpoints"] = 0;
        avg[tn]["maxtotalpoints"] = 0;
        
        avg[tn]["avgautopoints"]   = 0;
        avg[tn]["maxautopoints"]   = 0;
  
        avg[tn]["avgteleoppoints"]   = 0;
        avg[tn]["maxteleoppoints"]   = 0;
  
        avg[tn]["avgendgamepoints"]   = 0;
        avg[tn]["maxendgamepoints"]   = 0;
        
        avg[tn]["avgautonhighgoals"]  = 0;
        avg[tn]["maxautonhighgoals"]  = 0;
        avg[tn]["avgautonlowergoals"] = 0;
        avg[tn]["maxautonlowergoals"] = 0;
        
        avg[tn]["avgteleophighgoals"] = 0;
        avg[tn]["maxteleophighgoals"] = 0;
        avg[tn]["avgteleoplowergoals"] = 0;
        avg[tn]["maxteleoplowergoals"] = 0;
        
        avg[tn]["tarmacpercent"]       = 0;
        avg[tn]["endgameclimbpercent"] = {0:0, 1:0, 2:0, 3:0, 4:0};
        avg[tn]["autostartpercent"]    = {1:0, 2:0, 3:0, 4:0, 5:0, 6:0};
        
        avg[tn]["totaldied"] = 0;
        
        avg[tn]["totalmatches"] = 0 ;
        
        avg[tn]["scoutnames"]  = [];
        avg[tn]["commentlist"] = [];
      }
      
      var autoPoints  = (this.data[i]["autonlowpoints"] * 2) + (this.data[i]["autonhighpoints"] * 4) + (this.data[i]["tarmac"] * 2);
      var telopPoints = this.data[i]["teleoplowpoints"] + (this.data[i]["teleophighpoints"] * 2);
      
      var climbPoints = 0;
      if(this.data[i]["climbed"] == 1){climbPoints = 4;}
      if(this.data[i]["climbed"] == 2){climbPoints = 6;}
      if(this.data[i]["climbed"] == 3){climbPoints = 10;}
      if(this.data[i]["climbed"] == 4){climbPoints = 15;}
      
      var totalPoints = autoPoints + telopPoints + climbPoints;
      
      avg[tn]["avgtotalpoints"] += totalPoints;
      avg[tn]["maxtotalpoints"] = Math.max(avg[tn]["maxtotalpoints"], totalPoints);
      
      avg[tn]["avgautopoints"] += autoPoints;
      avg[tn]["maxautopoints"] =  Math.max(avg[tn]["maxautopoints"], autoPoints);
  
      avg[tn]["avgteleoppoints"]   += telopPoints;
      avg[tn]["maxteleoppoints"]   =  Math.max(avg[tn]["maxteleoppoints"], telopPoints);
  
      avg[tn]["avgendgamepoints"]   += climbPoints;
      avg[tn]["maxendgamepoints"]   =  Math.max(avg[tn]["maxendgamepoints"], climbPoints);
      
      avg[tn]["avgautonhighgoals"]  += this.data[i]["autonhighpoints"];
      avg[tn]["maxautonhighgoals"]  = Math.max(avg[tn]["maxautonhighgoals"], this.data[i]["autonhighpoints"]);
      avg[tn]["avgautonlowergoals"] += this.data[i]["autonlowpoints"];
      avg[tn]["maxautonlowergoals"] = Math.max(avg[tn]["maxautonlowergoals"], this.data[i]["autonlowpoints"]);
      
      avg[tn]["avgteleophighgoals"]  += this.data[i]["teleophighpoints"];
      avg[tn]["maxteleophighgoals"]  = Math.max(avg[tn]["maxteleophighgoals"], this.data[i]["teleophighpoints"]);
      avg[tn]["avgteleoplowergoals"] += this.data[i]["teleoplowpoints"];
      avg[tn]["maxteleoplowergoals"] = Math.max(avg[tn]["maxteleoplowergoals"], this.data[i]["teleoplowpoints"]);
      
      avg[tn]["tarmacpercent"] += this.data[i]["tarmac"];
      avg[tn]["endgameclimbpercent"][this.data[i]["climbed"]] += 1;
      avg[tn]["autostartpercent"][this.data[i]["startpos"]]   += 1;
      
      avg[tn]["totaldied"] += this.data[i]["died"];
      
      avg[tn]["totalmatches"] += 1;
      
      avg[tn]["scoutnames"].push(this.data[i]["scoutname"]);
      avg[tn]["commentlist"].push(this.data[i]["comment"]);
      
    }
    
    for (var key in avg){ 
      avg[key]["avgtotalpoints"]       = this.rnd(avg[key]["avgtotalpoints"]      / avg[key]["totalmatches"]);
      avg[key]["avgautopoints"]        = this.rnd(avg[key]["avgautopoints"]       / avg[key]["totalmatches"]);
      avg[key]["avgteleoppoints"]      = this.rnd(avg[key]["avgteleoppoints"]     / avg[key]["totalmatches"]);
      avg[key]["avgendgamepoints"]     = this.rnd(avg[key]["avgendgamepoints"]    / avg[key]["totalmatches"]);
      avg[key]["avgautonhighgoals"]    = this.rnd(avg[key]["avgautonhighgoals"]   / avg[key]["totalmatches"]);
      avg[key]["avgautonlowergoals"]   = this.rnd(avg[key]["avgautonlowergoals"]  / avg[key]["totalmatches"]);
      avg[key]["avgteleophighgoals"]   = this.rnd(avg[key]["avgteleophighgoals"]  / avg[key]["totalmatches"]);
      avg[key]["avgteleoplowergoals"]  = this.rnd(avg[key]["avgteleoplowergoals"] / avg[key]["totalmatches"]);
      
      avg[key]["tarmacpercent"] = this.rnd(100* avg[key]["tarmacpercent"] / avg[key]["totalmatches"]);
      
      avg[key]["endgameclimbpercent"][0] = this.rnd(100 * avg[key]["endgameclimbpercent"][0] / avg[key]["totalmatches"]);
      avg[key]["endgameclimbpercent"][1] = this.rnd(100 * avg[key]["endgameclimbpercent"][1] / avg[key]["totalmatches"]);
      avg[key]["endgameclimbpercent"][2] = this.rnd(100 * avg[key]["endgameclimbpercent"][2] / avg[key]["totalmatches"]);
      avg[key]["endgameclimbpercent"][3] = this.rnd(100 * avg[key]["endgameclimbpercent"][3] / avg[key]["totalmatches"]);
      avg[key]["endgameclimbpercent"][4] = this.rnd(100 * avg[key]["endgameclimbpercent"][4] / avg[key]["totalmatches"]);
      
      avg[key]["autostartpercent"][1] = this.rnd(100 * avg[key]["autostartpercent"][1] / avg[key]["totalmatches"]);
      avg[key]["autostartpercent"][2] = this.rnd(100 * avg[key]["autostartpercent"][2] / avg[key]["totalmatches"]);
      avg[key]["autostartpercent"][3] = this.rnd(100 * avg[key]["autostartpercent"][3] / avg[key]["totalmatches"]);
      avg[key]["autostartpercent"][4] = this.rnd(100 * avg[key]["autostartpercent"][4] / avg[key]["totalmatches"]);
      avg[key]["autostartpercent"][5] = this.rnd(100 * avg[key]["autostartpercent"][5] / avg[key]["totalmatches"]);
      avg[key]["autostartpercent"][5] = this.rnd(100 * avg[key]["autostartpercent"][6] / avg[key]["totalmatches"]);
      
    }
    
    return avg;
    
  }
}