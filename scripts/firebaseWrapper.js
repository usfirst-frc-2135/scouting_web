/*
  Firebase Wrapper
*/

class firebaseWrapper {
  constructor(firebaseApp = null) {
    /*
      Args:
        firebaseApp
    */
    this.secretStorage = "secretStorage";
    this.db = firebaseApp;
  }

  applyAuth(secretWord) {
    localStorage.setItem(this.secretStorage, secretWord);
  }

  getAuthWord() {
    return localStorage.getItem(this.secretStorage);
  }

  checkAuth(successFunction, failureFunction) {
    $.ajax({
      url: "readAPI.php?config=1&secret=" + this.getAuthWord(),
      type: 'get',
      dataType: 'json',
      async: true,
      success: function (data) {
        if (data["response"]) {
          console.log("SuccessFunction: Success");
          successFunction({ ...data });
        }
        else {
          console.log("SuccessFunction: Fail");
          failureFunction();
        }
      },
      fail: function () {
        console.log("failureFunction: Fail");
        failureFunction();
      }
    });
  }

  getConfig() {
    var out = null;
    $.ajax({
      url: "readAPI.php?config",
      type: 'get',
      dataType: 'json',
      async: false,
      success: function (data) {
        out = data;
      }
    });
    return out;
  }

  createDB(cfg) {
    this.cfg = cfg;
    this.eventcode = this.cfg["eventcode"];
    this.tbakey = this.cfg["tbakey"];
    const firebaseConfig = {
      apiKey: this.cfg["fbapikey"],
      authDomain: this.cfg["fbauthdomain"],
      databaseURL: this.cfg["fbdburl"],
      projectId: this.cfg["fbprojectid"],
      storageBucket: this.cfg["fbstoragebucket"],
      messagingSenderId: this.cfg["fbsenderid"],
      appId: this.cfg["fbappid"],
      measurementId: this.cfg["fbmeasurementid"]
    };
    var rawFirebaseApp = firebase.initializeApp(firebaseConfig);
    this.db = firebase.database();
    return this.db;
  }

  set(key, value) {
    this.db.ref(key).set(value);
  }

  get(key, func) {
    this.db.ref(key).once("value").then(func);
  }

  attachListener(key, func) {
    this.db.ref(key).on('value', func);
  }

  removeAllListeners(key) {
    this.db.ref(key).off();
  }

}
