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
                                 maxpoints : x, 
                  }
                }
    */
  }
  
}