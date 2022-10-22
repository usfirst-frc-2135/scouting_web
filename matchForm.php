<title>Web Match Scout Form</title>
<?php include("header.php") ?>
<div class="container row-offcanvas row-offcanvas-left">
  <div class="well column  col-lg-12  col-sm-12 col-xs-12" id="content">
    <div class="row pt-3 pb-3 mb-3 gx-3">
      
      <h1>Match Form</h1>
      
      <div class="row g-3 justify-content-md-center">
        <div class="input-group mb-3 justify-content-md-center">
          <h3>Match Info</h3>
        </div>
        <div class="col-md-6 ">
          <div class="input-group">
            <select class="form-select" id="compLevel" aria-label="Comp Level Select">
              <option value="p">P</option>
              <option value="qm">QM</option>
              <option value="qf">QF</option>
              <option value="sf">SF</option>
              <option value="f">F</option>
            </select>
            <input id="matchNumber" type="text" class="form-control" placeholder="Match Number" aria-label="matchNumber">
          </div>
        </div>
        <div class="col-md-6 ">
          <div class="input-group">
            <label for="teamNumber" class="form-label pg-2">Team Number</label>
            <input type="number" class="form-control" id="teamNumber">
          </div>
          <div class="input-group">
            <label for="scoutName" class="form-label pg-2">Scout Name</label>
            <input type="text" class="form-control" id="scoutName">
          </div>
        </div>
      </div>
      
      <div class="row g-3 justify-content-md-center">
        <div class="input-group mb-3 justify-content-md-center">
          <h3>Auto</h3>
        </div>
        <div class="col-md-6 ">
          <div class="input-group g-5">
            <h4 class="">Auto Start Position</h4>
            <img src="./images/startingPositionB.png" class="card-img-top" alt="starting position image">
            <select class="form-select" id="autoStartPosition">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
            </select>
          </div>
        </div>
        <div class="col-md-6 g-5">
          <div class="row">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" name="leftTarmac" id="leftTarmac">
              <label class="form-check-label" for="leftTarmac">Left Tarmac?</label>
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-6 g-5">
              <div class="row">
                <button class="btn btn-primary btn-info" style="width:100%" type="button" id="plusAutoLow">+</button>
              </div>
              <div class="row">
                <b id="autoLowGoal">Auto Low Goal: 0</b>
              </div>
              <div class="row">
                <button class="btn btn-primary btn-warning" style="width:100%" type="button" id="minusAutoLow">-</button>
              </div>
              <br>
            </div>

            <div class="col-md-6 g-5">
              <div class="row">
                <button class="btn btn-primary btn-info" style="width:100%" type="button" id="plusAutoHigh">+</button>
              </div>
              <div class="row">
                <b id="autoHighGoal">Auto High Goal: 0</b>
              </div>
              <div class="row">
                <button class="btn btn-primary btn-warning" style="width:100%" type="button" id="minusAutoHigh">-</button>
              </div>
            </div>
            <br>
          </div>
          
        </div>
      </div>
      
      <div class="row g-3 justify-content-md-center">
        <div class="input-group mb-3 justify-content-md-center">
          <h3>Teleop</h3>
        </div>
        <div class="col-md-6 g-5 ">
          <div class="row">
            <div class="col-md-5">
              <div class="row">
                <button class="btn btn-primary btn-info" style="width:100%" type="button" id="plusTeleopLow">+</button>
              </div>
              <div class="row">
                <b id="teleopLowGoal">Teleop Low Goal: 0</b>
              </div>
              <div class="row">
                <button class="btn btn-primary btn-warning" style="width:100%" type="button" id="minusTeleopLow">-</button>
              </div>
              <br>
            </div>
            
            <div class="col-md-2">
            </div>
            
            <div class="col-md-5">
              <div class="row">
                <button class="btn btn-primary btn-info" style="width:100%" type="button" id="plusTeleopHigh">+</button>
              </div>
              <div class="row">
                <b id="teleopHighGoal">Teleop High Goal: 0</b>
              </div>
              <div class="row">
                <button class="btn btn-primary btn-warning" style="width:100%" type="button" id="minusTeleopHigh">-</button>
              </div>
            </div>
            <br>
          </div>
        </div>
        <div class="col-md-6 g-5">
          <div class="row">
            <div class="form-check form-check-inline">
              <label class="form-check-label" for="climbed">Climbed?</label>
              <select class="form-select" id="climbed">
                <option value="0">No Climb</option>
                <option value="1">Level 1</option>
                <option value="2">Level 2</option>
                <option value="3">Level 3</option>
                <option value="4">Level 4</option>
              </select>
            </div>

            
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" name="dead" id="dead">
              <label class="form-check-label" for="dead">Dead?</label>
            </div>
          </div>
          
          <div class="row">
            <p>Comment</p>
            <textarea id="comment" class='form-control' rows='4'></textarea>
          </div>
        </div>
      </div>
        
      
      <div class="row g-3 justify-content-md-center">
        <button class="btn btn-primary" style="width:100%" type="button" id="submitForm">Submit</button>
      </div>
    
    </div>
  </div>
</div>

<?php include("footer.php") ?>

<script>
  
  var auto_low = 0;
  var auto_high = 0;
  var teleop_low = 0;
  var teleop_high = 0;

  function attach_ball_scoring(){
    $("#plusAutoLow").click(function(){
      auto_low += 1;
      $("#autoLowGoal").html("Auto Low Goal: " + auto_low);
    });
    
    $("#minusAutoLow").click(function(){
      auto_low = Math.max(auto_low-1, 0);
      $("#autoLowGoal").html("Auto Low Goal: " + auto_low);
    });
    
    $("#plusAutoHigh").click(function(){
      auto_high += 1;
      $("#autoHighGoal").html("Auto High Goal: " + auto_high);
    });
    
    $("#minusAutoHigh").click(function(){
      auto_high = Math.max(auto_high-1, 0);
      $("#autoHighGoal").html("Auto High Goal: " + auto_high);
    });
    
    $("#plusTeleopLow").click(function(){
      teleop_low += 1;
      $("#teleopLowGoal").html("Teleop Low Goal: " + teleop_low);
    });
    
    $("#minusTeleopLow").click(function(){
      teleop_low = Math.max(teleop_low-1, 0);
      $("#teleopLowGoal").html("Teleop Low Goal: " + teleop_low);
    });
    
    $("#plusTeleopHigh").click(function(){
      teleop_high += 1;
      $("#teleopHighGoal").html("Teleop High Goal: " + teleop_high);
    });
    
    $("#minusTeleopHigh").click(function(){
      teleop_high = Math.max(teleop_high-1, 0);
      $("#teleopHighGoal").html("Teleop High Goal: " + teleop_high);
    });
    
  }
  
  function get_form_data(){
    var out = {};
    var match_level = $("#compLevel").val();
    var match_number = $("#matchNumber").val();
    if (match_number != parseInt(match_number)){
      alert("Match number must be integer.");
      throw Error("Match number must be integer.");
    }
    var teamNumber = $("#teamNumber").val();
    if (teamNumber == ""){
      alert("Team number must not be empty.");
      throw Error("Team number must not be empty.");
    }
    out["matchnumber"]      = match_level + match_number;
    out["teamnumber"]       = teamNumber;
    out["startpos"]         = $("#autoStartPosition").val();
    out["tarmac"]           = $("#leftTarmac").is(':checked') ? 1 : 0;
    out["autonlowpoints"]   = auto_low;
    out["autonhighpoints"]  = auto_high;
    out["teleoplowpoints"]  = teleop_low;
    out["teleophighpoints"] = teleop_high;
    out["climbed"]          = $("#climbed").val();
    out["died"]             = $("#dead").is(':checked') ? 1 : 0;
    out["scoutname"]        = $("#scoutName").val();
    out["comment"]          = $("#comment").val();
    return out;
  }
  
  function clear_data(){
    $("#matchNumber").val("");
    $("#startpos").val("0");
    auto_low    = 0;
    auto_high   = 0;
    teleop_low  = 0;
    teleop_high = 0;
    $("#autoLowGoal").html("Auto Low Goal: " + auto_low);
    $("#autoHighGoal").html("Auto High Goal: " + auto_high);
    $("#teleopLowGoal").html("Teleop Low Goal: " + teleop_low);
    $("#teleopHighGoal").html("Teleop High Goal: " + teleop_high);
    $("#teamNumber").val("");
    $("#comment").val("");
  }
  
  function submit(form_data){
    $.post("writeAPI.php", {"writeSingleData" : JSON.stringify(form_data)}, function(data){
      if (data == "success"){
        alert("Data Successfully Submitted! Clearing Data.");
        clear_data();
      } else {
        alert("Data NOT Submitted. Please Check Network Connectivity.");
      }
    });
  }
  
  $(document).ready(function() {
    attach_ball_scoring();
    $("#submitForm").click(function (){
      var form_data = get_form_data();
      submit(form_data);
    });
  });
</script>