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
  
  filterMatches(start_match, end_match){
    /*
      Modify this.data to only include matches between start_match and end_match
    */
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
        avg[tn]["autostartpercent"]    = {1:0, 2:0, 3:0, 4:0, 5:0};
        
        avg[tn]["totaldied"] = 0;
        
        avg[tn]["totalmatches"] = 0 ;
        
        avg[tn]["scoutnames"]  = [];
        avg[tn]["commentlist"] = [];
      }
      
      var autoPoints  = (this.data[i]["autonlowpoints"] * 2) + (this.data[i]["autonhighpoints"] * 4);
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
      avg[tn]["avgtotalpoints"]       = avg[tn]["avgtotalpoints"]      / avg[tn]["totalmatches"];
      avg[tn]["avgautopoints"]        = avg[tn]["avgautopoints"]       / avg[tn]["totalmatches"];
      avg[tn]["avgteleoppoints"]      = avg[tn]["avgteleoppoints"]     / avg[tn]["totalmatches"];
      avg[tn]["avgendgamepoints"]     = avg[tn]["avgendgamepoints"]    / avg[tn]["totalmatches"];
      avg[tn]["avgautonhighgoals"]    = avg[tn]["avgautonhighgoals"]   / avg[tn]["totalmatches"];
      avg[tn]["avgautonlowergoals"]   = avg[tn]["avgautonlowergoals"]  / avg[tn]["totalmatches"];
      avg[tn]["avgteleophighgoals"]   = avg[tn]["avgteleophighgoals"]  / avg[tn]["totalmatches"];
      avg[tn]["avgteleoplowergoals"]  = avg[tn]["avgteleoplowergoals"] / avg[tn]["totalmatches"];
      
      avg[tn]["tarmacpercent"] = avg[tn]["tarmacpercent"] / avg[tn]["totalmatches"];
      
      avg[tn]["endgameclimbpercent"][0] = avg[tn]["endgameclimbpercent"][0] / avg[tn]["totalmatches"];
      avg[tn]["endgameclimbpercent"][1] = avg[tn]["endgameclimbpercent"][1] / avg[tn]["totalmatches"];
      avg[tn]["endgameclimbpercent"][2] = avg[tn]["endgameclimbpercent"][2] / avg[tn]["totalmatches"];
      avg[tn]["endgameclimbpercent"][3] = avg[tn]["endgameclimbpercent"][3] / avg[tn]["totalmatches"];
      avg[tn]["endgameclimbpercent"][4] = avg[tn]["endgameclimbpercent"][4] / avg[tn]["totalmatches"];
      
      avg[tn]["autostartpercent"][1] = avg[tn]["autostartpercent"][1] / avg[tn]["totalmatches"];
      avg[tn]["autostartpercent"][2] = avg[tn]["autostartpercent"][2] / avg[tn]["totalmatches"];
      avg[tn]["autostartpercent"][3] = avg[tn]["autostartpercent"][3] / avg[tn]["totalmatches"];
      avg[tn]["autostartpercent"][4] = avg[tn]["autostartpercent"][4] / avg[tn]["totalmatches"];
      avg[tn]["autostartpercent"][5] = avg[tn]["autostartpercent"][5] / avg[tn]["totalmatches"];
      
    }
    
    return avg;
    
  }
}