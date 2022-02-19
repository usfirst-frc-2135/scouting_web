/*
  TBA API Wrapper
*/

class tbaAPI{
  constructor(tbaKey=null){
    /*
      Args:
        firebaseApp
    */
    this.createTBA();
    this.url = "https://www.thebluealliance.com/api/v3/";
  }
  
  getConfig(){
    var out = null;
    $.ajax({
      url: "readAPI.php?config",
      type: 'get',
      dataType: 'json',
      async: false,
      success: function(data) {
          out = data;
      } 
    });
    return out;
  }
  
  createTBA(){
    var cfg = this.getConfig();
    this.eventcode = cfg["eventcode"];
    this.tbakey = cfg["tbakey"];
  }
  
  
  makeRequest(uri, successFunc, failFunc){
    $.ajax({
      url: this.url  + uri,
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      data: { 
        "X-TBA-Auth-Key": this.tbakey,
      },
      type: "GET",
      success: successFunc,
      error: failFunc
    });
  }
  
  getTeamList(eventCode, dataFunc, failFunc = null){
    if (failFunc == null){
      failFunc = function (){};
    }
    var successFunc = function (data){
      var out = [];
      for (var i = 0; i < data.length; ++i){
        out.push(data[i]["team_number"]);
      }
      return dataFunc(out);
    };
    this.makeRequest("event/" + eventCode + "/teams/simple", successFunc, failFunc);
  }
  
  
  
}