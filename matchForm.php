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
        <!--<div class="col-md-6 ">
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
          </div> -->
        </div>
        <div class="col-md-6 g-5">
          <div class="row">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" name="exitCommunity" id="exitCommunity">
              <label class="form-check-label" for="exitCommunity">Exited Community?</label>
            </div>
          </div>

          <div class="row">
           
              
            <div class="col-md-6 g-5">
              <div class="row">
                <button class="btn btn-primary btn-info" style="width:100%" type="button" id="plusAutoConesBottom">+</button>
              </div>
              <div class="row">
                <b id="autoConesBottom">Auto Cones Bottom: 0</b>
              </div>
              <div class="row">
                <button class="btn btn-primary btn-warning" style="width:100%" type="button" id="minusAutoConesBottom">-</button>
              </div>
              <br>
            </div>  

              
            <div class="col-md-6 g-5">
              <div class="row">
                <button class="btn btn-primary btn-info" style="width:100%" type="button" id="plusAutoConesMiddle">+</button>
              </div>
              <div class="row">
                <b id="autoConesMiddle">Auto Cones Middle: 0</b>
              </div>
              <div class="row">
                <button class="btn btn-primary btn-warning" style="width:100%" type="button" id="minusAutoConesMiddle">-</button>
              </div>
              <br>
            </div>  
            
              
            <div class="col-md-6 g-5">
              <div class="row">
                <button class="btn btn-primary btn-info" style="width:100%" type="button" id="plusAutoConesTop">+</button>
              </div>
              <div class="row">
                <b id="autoConesTop">Auto Cones Top: 0</b>
              </div>
              <div class="row">
                <button class="btn btn-primary btn-warning" style="width:100%" type="button" id="minusAutoConesTop">-</button>
              </div>
              <br>
            </div>  
              
            <div class="col-md-6 g-5">
              <div class="row">
                <button class="btn btn-primary btn-info" style="width:100%" type="button" id="plusAutoCubesBottom">+</button>
              </div>
              <div class="row">
                <b id="autoCubesBottom">Auto Cubes Bottom: 0</b>
              </div>
              <div class="row">
                <button class="btn btn-primary btn-warning" style="width:100%" type="button" id="minusAutoCubesBottom">-</button>
              </div>
              <br>
            </div>  

              
            <div class="col-md-6 g-5">
              <div class="row">
                <button class="btn btn-primary btn-info" style="width:100%" type="button" id="plusAutoCubesMiddle">+</button>
              </div>
              <div class="row">
                <b id="autoCubesMiddle">Auto Cubes Middle: 0</b>
              </div>
              <div class="row">
                <button class="btn btn-primary btn-warning" style="width:100%" type="button" id="minusAutoCubesMiddle">-</button>
              </div>
              <br>
            </div>  
            
              
            <div class="col-md-6 g-5">
              <div class="row">
                <button class="btn btn-primary btn-info" style="width:100%" type="button" id="plusAutoCubesTop">+</button>
              </div>
              <div class="row">
                <b id="autoCubesTop">Auto Cubes Top: 0</b>
              </div>
              <div class="row">
                <button class="btn btn-primary btn-warning" style="width:100%" type="button" id="minusAutoCubesTop">-</button>
              </div>
              <br>
            </div> 
              
            <div class="col-md-6 g-5">
              <div class="row">
                <div class="form-check form-check-inline">
                  <label class="form-check-label" for="autochargestation">Auto Charge Station?</label>
                <select class="form-select" id="autochargestation">
                  <option value="0">None</option>
                  <option value="1">Docked</option>
                  <option value="2">Engaged</option>
               </select>
               </div>
             <br>
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
        <div class="col-md-6 g-5">
              <div class="row">
                <button class="btn btn-primary btn-info" style="width:100%" type="button" id="plusTeleopConesBottom">+</button>
              </div>
              <div class="row">
                <b id="teleopConesBottom">Teleop Cones Bottom: 0</b>
              </div>
              <div class="row">
                <button class="btn btn-primary btn-warning" style="width:100%" type="button" id="minusTeleopConesBottom">-</button>
              </div>
              <br>
            </div>  

              
            <div class="col-md-6 g-5">
              <div class="row">
                <button class="btn btn-primary btn-info" style="width:100%" type="button" id="plusTeleopConesMiddle">+</button>
              </div>
              <div class="row">
                <b id="teleopConesMiddle">Teleop Cones Middle: 0</b>
              </div>
              <div class="row">
                <button class="btn btn-primary btn-warning" style="width:100%" type="button" id="minusTeleopConesMiddle">-</button>
              </div>
              <br>
            </div>  
            
              
            <div class="col-md-6 g-5">
              <div class="row">
                <button class="btn btn-primary btn-info" style="width:100%" type="button" id="plusTeleopConesTop">+</button>
              </div>
              <div class="row">
                <b id="teleopConesTop">Teleop Cones Top: 0</b>
              </div>
              <div class="row">
                <button class="btn btn-primary btn-warning" style="width:100%" type="button" id="minusTeleopConesTop">-</button>
              </div>
              <br>
            </div>  
             
            <div class="col-md-6 g-5">
              <div class="row">
                <button class="btn btn-primary btn-info" style="width:100%" type="button" id="plusTeleopCubesBottom">+</button>
              </div>
              <div class="row">
                <b id="teleopCubesBottom">Teleop Cubes Bottom: 0</b>
              </div>
              <div class="row">
                <button class="btn btn-primary btn-warning" style="width:100%" type="button" id="minusTeleopCubesBottom">-</button>
              </div>
              <br>
            </div>  

              
            <div class="col-md-6 g-5">
              <div class="row">
                <button class="btn btn-primary btn-info" style="width:100%" type="button" id="plusTeleopCubesMiddle">+</button>
              </div>
              <div class="row">
                <b id="teleopCubesMiddle">Teleop Cubes Middle: 0</b>
              </div>
              <div class="row">
                <button class="btn btn-primary btn-warning" style="width:100%" type="button" id="minusTeleopCubesMiddle">-</button>
              </div>
              <br>
            </div>  
            
              
            <div class="col-md-6 g-5">
              <div class="row">
                <button class="btn btn-primary btn-info" style="width:100%" type="button" id="plusTeleopCubesTop">+</button>
              </div>
              <div class="row">
                <b id="teleopCubesTop">Teleop Cubes Top: 0</b>
              </div>
              <div class="row">
                <button class="btn btn-primary btn-warning" style="width:100%" type="button" id="minusTeleopCubesTop">-</button>
              </div>
              <br>
            </div> 
          
          <div class="row">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" name="pickedupCube" id="pickedupCube">
              <label class="form-check-label" for="pickedupCube">Picked Up Cube?</label>
            </div>
          </div>
          
          <div class="row">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" name="pickedupUprightCone" id="pickedupUprightCone">
              <label class="form-check-label" for="pickedupUprightCone">Picked Up Upright Cone?</label>
            </div>
          </div>
          
          <div class="row">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" name="pickedupTippedCone" id="pickedupTippedCone">
              <label class="form-check-label" for="pickedupTippedCone">Picked Up Tipped Cone</label>
            </div>
          </div>
        
        </div>
      
        <div class="col-md-6 g-5">
          <div class="row">
            <div class="form-check form-check-inline">
              <label class="form-check-label" for="endgamechargestation">Charge Station?</label>
              <select class="form-select" id="endgamechargestation">
                <option value="0">None</option>
                <option value="1">Parked</option>
                <option value="2">Docked</option>
                <option value="3">Engaged</option>
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
  <!-- </div> -->
<!-- </div> -->

<?php include("footer.php") ?>

<script>
  var auto_conesbottom = 0;
  var auto_conesmiddle = 0;
  var auto_conestop = 0;
  var auto_cubesbottom = 0;
  var auto_cubesmiddle = 0;
  var auto_cubestop = 0;
  var teleop_conesbottom = 0;
  var teleop_conesmiddle = 0;
  var teleop_conestop = 0;
  var teleop_cubesbottom = 0;
  var teleop_cubesmiddle = 0;
  var teleop_cubestop = 0;

  function attach_gamepiece_scoring() {
    console.log("==> matchForm.php: attach_gamepiece_scoring() starting");
    $("#plusAutoConesBottom").click(function() {
      auto_conesbottom += 1;
      $("#autoConesBottom").html("Auto Cones Bottom: " + auto_conesbottom);
    });

    $("#minusAutoConesBottom").click(function() {
      auto_conesbottom = Math.max(auto_conesbottom - 1, 0);
      $("#autoConesBottom").html("Auto Cones Bottom: " + auto_conesbottom);
    });
      
    $("#plusAutoConesMiddle").click(function() {
      auto_conesmiddle += 1;
      $("#autoConesMiddle").html("Auto Cones Middle: " + auto_conesmiddle);
    });

    $("#minusAutoConesMiddle").click(function() {
      auto_conesmiddle = Math.max(auto_conesmiddle - 1, 0);
      $("#autoConesMiddle").html("Auto Cones Middle: " + auto_conesmiddle);
    });

    $("#plusAutoConesTop").click(function() {
      auto_conestop += 1;
      $("#autoConesTop").html("Auto Cones Top: " + auto_conestop);
    });

    $("#minusAutoConesTop").click(function() {
      auto_conestop = Math.max(auto_conestop - 1, 0);
      $("#autoConesTop").html("Auto Cones Top: " + auto_conestop);
    });
      
    $("#plusAutoCubesBottom").click(function() {
      auto_cubesbottom += 1;
      $("#autoCubesBottom").html("Auto Cubes Bottom: " + auto_cubesbottom);
    });

    $("#minusAutoCubesBottom").click(function() {
      auto_cubesbottom = Math.max(auto_cubesbottom - 1, 0);
      $("#autoCubesBottom").html("Auto Cubes Bottom: " + auto_cubesbottom);
    });
      
    $("#plusAutoCubesMiddle").click(function() {
      auto_cubesmiddle += 1;
      $("#autoConesMiddle").html("Auto Cubes Middle: " + auto_cubesmiddle);
    });

    $("#minusAutoCubesMiddle").click(function() {
      auto_cubesmiddle = Math.max(auto_cubesmiddle - 1, 0);
      $("#autoCubesMiddle").html("Auto Cubes Middle: " + auto_cubesmiddle);
    });

    $("#plusAutoCubesTop").click(function() {
      auto_cubestop += 1;
      $("#autoCubesTop").html("Auto Cubes Top: " + auto_cubestop);
    });

    $("#minusAutoCubesTop").click(function() {
      auto_cubestop = Math.max(auto_cubestop - 1, 0);
      $("#autoCubesTop").html("Auto Cubes Top: " + auto_cubestop);
    });
      
      
    $("#plusTeleopConesBottom").click(function() {
      teleop_conesbottom += 1;
      $("#teleopConesBottom").html("Teleop Cones Bottom: " + teleop_conesbottom);
    });

    $("#minusTeleopConesBottom").click(function() {
      teleop_conesbottom = Math.max(teleop_conesbottom - 1, 0);
      $("#teleopConesBottom").html("Teleop Cones Bottom: " + teleop_conesbottom);
    });
      
    $("#plusTeleopConesMiddle").click(function() {
      teleop_conesmiddle += 1;
      $("#teleopConesMiddle").html("Teleop Cones Middle: " + teleop_conesmiddle);
    });

    $("#minusTeleopConesMiddle").click(function() {
      teleop_conesmiddle = Math.max(teleop_conesmiddle - 1, 0);
      $("#teleopConesMiddle").html("Teleop Cones Middle: " + teleop_conesmiddle);
    });

    $("#plusTeleopConesTop").click(function() {
      teleop_conestop += 1;
      $("#teleopConesTop").html("Teleop Cones Top: " + teleop_conestop);
    });

    $("#minusTeleopConesTop").click(function() {
      teleop_conestop = Math.max(teleop_conestop - 1, 0);
      $("#teleopConesTop").html("Teleop Cones Top: " + teleop_conestop);
    });
      
    $("#plusTeleopCubesBottom").click(function() {
      teleop_cubesbottom += 1;
      $("#teleopCubesBottom").html("Teleop Cubes Bottom: " + teleop_cubesbottom);
    });

    $("#minusTeleopCubesBottom").click(function() {
      teleop_cubesbottom = Math.max(teleop_cubesbottom - 1, 0);
      $("#teleopCubesBottom").html("Teleop Cubes Bottom: " + teleop_cubesbottom);
    });
      
    $("#plusTeleopCubesMiddle").click(function() {
      teleop_cubesmiddle += 1;
      $("#teleopConesMiddle").html("Teleop Cubes Middle: " + teleop_cubesmiddle);
    });

    $("#minusTeleopCubesMiddle").click(function() {
      teleop_cubesmiddle = Math.max(teleop_cubesmiddle - 1, 0);
      $("#teleopCubesMiddle").html("Teleop Cubes Middle: " + teleop_cubesmiddle);
    });

    $("#plusTeleopCubesTop").click(function() {
      teleop_cubestop += 1;
      $("#teleopCubesTop").html("Teleop Cubes Top: " + teleop_cubestop);
    });

    $("#minusTeleopCubesTop").click(function() {
      teleop_cubestop = Math.max(teleop_cubestop - 1, 0);
      $("#teleopCubesTop").html("Teleop Cubes Top: " + teleop_cubestop);
    });
    

  }

  function get_form_data() {
    console.log("==> matchForm.php: get_form_data() starting");
    var out = {};
    var match_level = $("#compLevel").val();
    var match_number = $("#matchNumber").val();
    if (match_number != parseInt(match_number)) {
      alert("Match number must be integer.");
      throw Error("Match number must be integer.");
    }
    var teamNumber = $("#teamNumber").val();
    if (teamNumber == "") {
      alert("Team number must not be empty.");
      throw Error("Team number must not be empty.");
    }
    out["matchnumber"] = match_level + match_number;
    out["teamnumber"] = teamNumber;
    // out["startpos"] = $("#autoStartPosition").val();
    out["mobility"] = $("#exitCommunity").is(':checked') ? 1 : 0;
    out["autonconesbottom"] = auto_conesbottom;
    out["autonconesmiddle"] = auto_conesmiddle;
    out["autonconestop"] = auto_conestop;
    out["autoncubesbottom"] = auto_cubesbottom;
    out["autoncubesbottom"] = auto_cubesmiddle;
    out["autoncubesbottom"] = auto_cubestop;
    out["autochargestation"] = $("#autochargestation").val();
    out["teleopconesbottom"] = teleop_conesbottom;
    out["teleopconesmiddle"] = teleop_conesmiddle;
    out["teleopconestop"] = teleop_conestop;
    out["teleopcubesbottom"] = teleop_cubesbottom;
    out["teleopcubesbottom"] = teleop_cubesmiddle;
    out["teleopcubesbottom"] = teleop_cubestop;
    out["cubepickup"] = $("#pickedupCube").is(':checked') ? 1 : 0;
    out["uprightconepickup"] = $("#pickedupUprightCone").is(':checked') ? 1 : 0;
    out["tippedconepickup"] = $("#pickedupTippedCone").is(':checked') ? 1 : 0;
    out["endgamechargestation"] = $("#endgamechargestation").val();
    out["died"] = $("#dead").is(':checked') ? 1 : 0;
    out["scoutname"] = $("#scoutName").val();
    out["comment"] = $("#comment").val();
    return out;
  }

  function clear_data() {
    console.log("==> matchForm.php: clear_data() starting");
    $("#matchNumber").val("");
    //$("#startpos").val("0");
    auto_conesbottom = 0;
    auto_conesmiddle = 0;
    auto_conestop = 0;
    auto_cubesbottom = 0;
    auto_cubesmiddle = 0;
    auto_cubestop = 0;
    teleop_conesbottom = 0;
    teleop_conesmiddle = 0;
    teleop_conestop = 0;
    teleop_cubesbottom = 0;
    teleop_cubesmiddle = 0;
    teleop_cubestop = 0;
    $("#autoConesBottom").html("Auto Cones Bottom: " + auto_conesbottom);
    $("#autoConesMiddle").html("Auto Cones Middle: " + auto_conesmiddle);
    $("#autoConesTop").html("Auto Cones Top: " + auto_conestop);
    $("#autoCubesBottom").html("Auto Cubes Bottom: " + auto_cubesbottom);
    $("#autoCubesMiddle").html("Auto Cubes Middle: " + auto_cubesmiddle);
    $("#autoCubesTop").html("Auto Cubes Top: " + auto_cubestop);
    $("#teleopConesBottom").html("Teleop Cones Bottom: " + teleop_conesbottom);
    $("#teleopConesMiddle").html("Teleop Cones Middle: " + teleop_conesmiddle);
    $("#teleopConesTop").html("Teleop Cones Top: " + teleop_conestop);
    $("#teleopCubesBottom").html("Teleop Cubes Bottom: " + teleop_cubesbottom);
    $("#teleopCubesMiddle").html("Teleop Cubes Middle: " + teleop_cubesmiddle);
    $("#teleopCubesTop").html("Teleop Cubes Top: " + teleop_cubestop);
    $("#teamNumber").val("");
    $("#comment").val("");
  }

  function submit(form_data) {
    console.log("==> matchForm.php: submit() starting");
    $.post("writeAPI.php", {
      "writeSingleData": JSON.stringify(form_data)
    }, function(data) {
      // Because success word may have a new-line at the end, don't do a direct compare
      if (data.indexOf('success') > -1) {
        alert("Data Successfully Submitted! Clearing Data.");
        clear_data();
      } else {
        alert("Data NOT Submitted. Please Check Network Connectivity.");
      }
    });
  }

  $(document).ready(function() {
    console.log("==> matchForm.php: ready() starting");
    attach_gamepiece_scoring();
    $("#submitForm").click(function() {
      var form_data = get_form_data();
      submit(form_data);
    });
  });
</script>
