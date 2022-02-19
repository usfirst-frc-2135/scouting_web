/*
  Firebase Wrapper
*/

class firebaseWrapper{
  constructor(firebaseApp=null){
    /*
      Args:
        firebaseApp
    */
    if (firebaseApp == null){
      firebaseApp = this.createDB();
    }
    this.db = firebaseApp;
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
  
  createDB(){
    var cfg = this.getConfig();
    this.eventcode = cfg["eventcode"];
    this.tbakey = cfg["tbakey"];
    const firebaseConfig = {
      apiKey:             cfg["fbapikey"],
      authDomain:         cfg["fbauthdomain"],
      databaseURL:        cfg["fbdburl"],
      projectId:          cfg["fbprojectid"],
      storageBucket:      cfg["fbstoragebucket"],
      messagingSenderId:  cfg["fbsenderid"],
      appId:              cfg["fbappid"],
      measurementId:      cfg["fbmeasurementid"]
    };
    var rawFirebaseApp = firebase.initializeApp(firebaseConfig);
    return firebase.database();
  }
  
  
  set(key, value){
    this.db.ref(key).set(value);
  }
  
  get(key, func){
    this.db.ref(key).once("value").then(func);
  }
  
  attachListener(key, func){
    this.db.ref(key).on('value', func);
  }
  
  removeAllListeners(key){
    this.db.ref(key).off();
  }
  
  
  
}