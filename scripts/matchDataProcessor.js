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
                   died : x
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
                  teamNumber : { totalpoints : x,
                                 avgtotalpoints : x,
                                 maxtotalpoints : x,
                                 
                                 totalautopoints : x,
                                 avgautopoints : x,
                                 maxautopoints : x,
                                 
                                 totalteleoppoints : x,
                                 avgteleoppoints : x,
                                 maxteleoppoints : x,
                                 
                                 endgametotalpoints : x,
                                 avgendgamepoints : x,
                                 maxendgamepoints : x,
                                 
                                 avgautonhighpoints : x,
                                 maxautonhighpoints : x,
                                 avgautonlowerpoints : x,
                                 maxautonlowerpoints : x,
                                 
                                 avgteleophighpoints : x,
                                 maxteleophighpoints : x,
                                 
                                 avgteleoplowerpoints : x,
                                 maxteleoplowerpoints : x,
                                 
                                 endgame0climbpoints : x,
                                 endgame1climbpoints : x,
                                 endgame2climbpoints : x,
                                 endgame3climbpoints : x,
                                 endgame4climbpoints : x,
                                 
                                 avgdied : x,
                                 
                                 totalmatches : x
                  }
                }
    */

  var avg={}; //general for all matches and all teams
  for (var i=0; i<this.data.length; i++){
      var tn=this.data[i]["teamnumber"];
      console.log(this.data[i]);
      if (! (tn in avg)){
          avg [tn]={};
          avg [tn]["totalpoints"]=0;
          avg [tn]["avgtotalpoints"]=0;
          avg [tn]["maxtotalpoints"]=0;
          
          avg [tn]["totalautopoints"]=0;
          avg [tn]["avgautopoints"]=0;
          avg [tn]["maxautopoints"]=0;
          
          avg [tn]["totalteleoppoints"]=0;
          avg [tn]["avgteleoppoints"]=0;
          avg [tn]["maxteleoppoints"]=0;
          
          avg [tn]["endgametotalpoints"]=0;
          avg [tn]["avgendgamepoints"]=0;
          avg [tn]["maxendgamepoints"]=0;
          
          avg [tn]["avgautonhighpoints"]=0;
          avg [tn]["maxautonhighpoints"]=0;
          
          avg [tn]["avgautonlowerpoints"]=0;
          avg [tn]["maxautonlowerpoints"]=0;
          
          avg [tn]["avgteleophighpoints"]=0;
          avg [tn]["maxteleophighpoints"]=0;
          
          avg [tn]["avgteleoplowpoints"]=0;
          avg [tn]["maxteleoplowpoints"]=0;
          
          avg [tn]["endgame0climbpoints"]=0;
          avg [tn]["endgame1climbpoints"]=0;
          avg [tn]["endgame2climbpoints"]=0;
          avg [tn]["endgame3climbpoints"]=0; 
          avg [tn]["endgame4climbpoints"]=0; 
          
          avg [tn]["avgdied"]=0;
          avg [tn]["totalmatches"]=0;
      }
      avg [tn]["avgautonhighpoints"]+=this.data[i]["autonhighpoints"];
      avg [tn]["avgautonlowerpoints"]+=this.data[i]["autonlowpoints"];
      
      avg [tn]["totalautopoints"]+=this.data[i]["autonlowpoints","autonhighpoints"];
      
      avg [tn]["maxautonhighpoints"]+=this.data[i]["autonhighpoints"];
      avg [tn]["maxautonlowerpoints"]+=this.data[i]["autonlowpoints"];
      
      avg [tn]["avgautopoints"]+=this.data[i]["totalautopoints"];
      
      avg [tn]["avgteleophighpoints"]+=this.data[i]["teleophighpoints"];
      avg [tn]["avgteleoplowpoints"]+=this.data[i]["teleoplowpoints"];
      
      avg [tn]["totalteleoppoints"]+=this.data[i]["teleoplowpoints","teleophighpoints"];
      
      avg [tn]["maxteleophighpoints"]+=this.data[i]["teleophighpoints"];
      avg [tn]["maxteleoplowpoints"]+=this.data[i]["teleoplowpoints"];
      
     
      avg [tn]["endgame0climbpoints"]+=this.data[i]["climbed"];
      avg [tn]["endgame1climbpoints"]+=this.data[i]["climbed"];
      avg [tn]["endgame2climbpoints"]+=this.data[i]["climbed"];
      avg [tn]["endgame3climbpoints"]+=this.data[i]["climbed"];
      avg [tn]["endgame4climbpoints"]+=this.data[i]["climbed"];
      
      
      
      avg [tn]["avgdied"]+=this.data[i]["died"];
      avg [tn]["totalmatches"]+=1;
      
  }
      
      
      for (var key in avg){ 
          
        
        // Averages of High and Low Auton
          
        avg[key]["avgautonhighpoints"]= avg [key]["avgautonhighpoints"] / avg [key]["totalmatches"]
          
        avg[key]["avgautonlowerpoints"]= avg [key]["avgautonlowerpoints"] / avg [key]["totalmatches"]
  
        // Total Auton Points
      
        avg[key]["totalautopoints"]= avg [key]["autonhighpoints"] + avg [key]["autonlowpoints"]
  
    
        // Averages of High and Low Teleop
      
        avg[key]["avgteleophighpoints"]= avg [key]["avgteleophighpoints"] / avg [key]["totalmatches"]
   
        avg[key]["avgteleoplowpoints"]= avg [key]["avgteleoplowpoints"] / avg [key]["totalmatches"]

        // Total Teleop Points
        
        avg[key]["totalteleoppoints"]= avg [key]["teleophighpoints"] + avg [key]["teleoplowpoints"]

        // Average Died
       
        avg[key]["avgdied"]= avg [key]["avgdied"] / avg [key]["totalmatches"]
      }
          
        return avg;
      
      // Endgame Climb Points
      
      
      if (parseInt("climbed") = 0) {
        avg [key]["endgame0climbpoints"]= parseInt ("endgame0climbpoints") + 0;
        
      }
     
      return avg;
      
      
      
  }
}