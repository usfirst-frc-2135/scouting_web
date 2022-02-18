/*
  Match Data Processor
  Takes in match data from source and calculates averages and other derived data from it.
*/

class matchDataProcessor{
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
                                 
                                 avgteleophighpieces : x,
                                 maxteleophighpieces : x,
                                 
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

  var avg={};
  for (var i=0; i<this.data.length; i++){
      var tn=this.data[i]["teamnumber"];
      console.log(this.data[i]);
      if (! (tn in avg)){
          avg [tn]={};
          avg [tn]["avgteleophighpieces"]=0;
          avg [tn]["maxteleophighpieces"]=0;
          avg [tn]["totalmatches"]=0;
      }
      avg [tn]["avgteleophighpieces"]+=this.data[i]["teleoplowpoints"];
      avg [tn]["totalmatches"]+=1;
  }
      return avg;
  
  }
  
}