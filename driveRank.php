<title>Drive Rank</title>
<?php include("header.php") ?>

<div class="container row-offcanvas row-offcanvas-left">
  <div class="well column  col-lg-12  col-sm-12 col-xs-12" id="content">
    <div class="row pt-3 pb-3 mb-3">
        <div class="row g-3 justify-content-md-center">
            <div class="row justify-content-md-center">
              <h2 class="col-md-6"> Stratgic Scouting </h2>
            </div>
        </div>
        
      <div class="card col-md-6 mx-auto">
          
        <div id="driveRankScoutingMessage" style="display: none"   class="alert alert-dismissible fade show" role="alert">
          <div id="uploadMessageText"></div>
          <button type="button" class="btn-close" id="closeMessage" aria-label="Close"></button>
        </div>

        <div class="card-body">
          <form id="driveRankForm" method="post" enctype="multipart/form-data">
		
          <div class="mb-3">
            <label for="teamNumber" class="form-label">Team Number </label>
            <input type="text" class="form-control" id="teamNumber">
          </div>
			
          <div class="mb-3">
            <label for="matchNumber" class="form-label">Match Number </label>
            <input type="text" class="form-control" id="matchNumber">
          </div>

          <div class="mb-3">
            <label for="scoutName" class="form-label">Scout Name</label>
            <input type="text" class="form-control" id="scoutName">
          </div>
          <div>
            <label class="form-label"><b>Driver ability/speed:</b></label>
          </div>
			
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="driverAbilityGroup" id="driveScore1">
            <label class="form-check-label" for="driveScore1">1 - Jerky</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="driverAbilityGroup" id="driveScore2">
            <label class="form-check-label" for="driveScore2">2 - Slow</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="driverAbilityGroup" id="driveScore3">
            <label class="form-check-label" for="driveScore3">3 - Average</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="driverAbilityGroup" id="driveScore4">
            <label class="form-check-label" for="driveScore4">4 - Quick/agile</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="driverAbilityGroup" id="driveScore5">
            <label class="form-check-label" for="driveScore5">5 - N/A</label>
          </div>
              
          <p>   </p>
          <div>
            <label class="form-label"><b>Multi-note auton - gets notes from:</b></label>
          </div>
          <div class="form-check form-check-inline">
            <label for="multinote_starting_zone" class ="form-label">Starting zone</label>
            <input class="form-check-input" type="checkbox" id="multinote_starting_zone">
          </div>
          <div class="form-check form-check-inline">
            <label for="multinote_centerline" class ="form-label">Center line</label>
            <input class="form-check-input" type="checkbox" id="multinote_centerline">
          </div>
            
              
          <p>   </p>
          <div>
            <label class="form-label"><b>Teleop - shoots from:</b></label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="shootsFromGroup" id="shootsFromScore1">
            <label class="form-check-label" for="shootsFromScore1">1 - Subwoofer</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="shootsFromGroup" id="shootsFromScore2">
            <label class="form-check-label" for="shootsFromScore2">2 - Podium</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="shootsFromGroup" id="shootsFromScore3">
            <label class="form-check-label" for="shootsFromScore3">3 - Anywhere</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="shootsFromGroup" id="shootsFromScore4">
            <label class="form-check-label" for="shootsFromScore4">4 - N/A</label>
          </div>


          <p>   </p>
          <div>
            <label class="form-label"><b>Passing - consistently lands in starting zone area?</b></label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="passingGroup" id="passingScore1">
            <label class="form-check-label" for="passingScore1">Yes</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="passingGroup" id="passingScore2">
            <label class="form-check-label" for="passingScore2">No</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="passingGroup" id="passingScore3">
            <label class="form-check-label" for="passingScore3">N/A</label>
          </div>
             

          <p>   </p>
          <div>
            <label class="form-label"><b>Can go under the stage?</b></label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="underStageGroup" id="underStageScore1">
            <label class="form-check-label" for="underStageScore1">Yes</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="underStageGroup" id="underStageScore2">
            <label class="form-check-label" for="underStageScore2">No</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="underStageGroup" id="underStageScore3">
            <label class="form-check-label" for="underStageScore3">N/A</label>
          </div>
             

          <p>   </p>
          <div>
            <label class="form-label"><b>Defense tactics played:</b></label>
          </div>
          <div class="form-check form-check-inline">
            <label for="defenseTactic1" class ="form-label">Bumping a shooting robot (how many shots missed?)</label>
            <input class="form-check-input" type="checkbox" id="defenseTactic1">
          </div>
          <div class="form-check form-check-inline">
            <label for="defenseTactic2" class ="form-label">Pinning (how long before clearing?)</label>
            <input class="form-check-input" type="checkbox" id="defenseTactic2">
          </div>
          <div class="form-check form-check-inline">
            <label for="defenseTactic3" class ="form-label">Blocking path (how long detained?)</label>
            <input class="form-check-input" type="checkbox" id="defenseTactic3">
          </div>
          <div class="mb-3">
            <label for="defenseComment" class="form-label">Defense note: </label>
            <input type="text" class="form-control" id="defenseComment">
          </div>
 

          <p>   </p>
          <div>
            <label class="form-label"><b>Against defensive robot:</b></label>
          </div>
          <div class="form-check form-check-inline">
            <label for="againstTactic1" class ="form-label">Pinned or path blocked (able to quickly escape?)</label>
            <input class="form-check-input" type="checkbox" id="againstTactic1">
          </div>
          <div class="form-check form-check-inline">
            <label for="againstTactic2" class ="form-label">Bumped when shooting (how many shots missed?)</label>
            <input class="form-check-input" type="checkbox" id="againstTactic2">
          </div>
          <div class="mb-3">
            <label for="againstComment" class="form-label">Against defense note: </label>
            <input type="text" class="form-control" id="againstComment">
          </div>


          <p>   </p>
          <div>
            <label class="form-label"><b>Caused fouls:</b></label>
          </div>
          <div class="form-check form-check-inline">
            <label for="foul1" class ="form-label">Pinning for 5 count</label>
            <input class="form-check-input" type="checkbox" id="foul1">
          </div>
          <div class="form-check form-check-inline">
            <label for="foul2" class ="form-label">Controlling more than 1 note</label>
            <input class="form-check-input" type="checkbox" id="foul2">
          </div>
          <div class="form-check form-check-inline">
            <label for="foul3" class ="form-label">Crossed center line in auton</label>
            <input class="form-check-input" type="checkbox" id="foul3">
          </div>
          <div class="form-check form-check-inline">
            <label for="foul4" class ="form-label">Touched opposing robot at Podium</label>
            <input class="form-check-input" type="checkbox" id="foul4">
          </div>
          <div class="form-check form-check-inline">
            <label for="foul5" class ="form-label">Touched opposing robot at Source or Amp</label>
            <input class="form-check-input" type="checkbox" id="foul5">
          </div>
          <div class="form-check form-check-inline">
            <label for="foul6" class ="form-label">Touched opposing robot at stage in Endgame</label>
            <input class="form-check-input" type="checkbox" id="foul6">
          </div>


          <p>   </p>
          <div class="mb-3">
            <label for="climbComment" class="form-label">How long it took to climb; at what time do they go to climb once Endgame starts?</label>
            <input type="text" class="form-control" id="climbComment">
          </div>
 
          <p>   </p>
          <div class="mb-3">
            <label for="problemComment" class="form-label">Problems robot ran into on the field:</label>
            <input type="text" class="form-control" id="problemComment">
          </div>

          <p>   </p>
          <div class="mb-3">
            <label for="climbComment" class="form-label">General comment:</label>
            <input type="text" class="form-control" id="generalComment">
          </div>
 
    
          <p>   </p>
          <div class="d-grid gap-2 col-6 mx-auto">
            <button class="btn btn-primary" type="button" id="submitButton">Submit</button>
          </div>
			
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
 

<?php include("footer.php") ?>

<script>

  function verifyData() {
    var isError = false;
    var errMsg = "Please enter values for these fields:";

    // Make sure there is a team number, scoutname and matchnum.
    if ($("#teamNumber").val() == "") {
      errMsg += " Team Number";
      isError = true;
    }         
    if ($("#matchNumber").val() == "") {
      errMsg += " Match Number";
      isError = true;
    }         
    if ($("#scoutName").val() == "") {
      errMsg += " Scout Name";
      isError = true;
    }         
    if (isError) {
      alert(errMsg);
    }
    return isError;
  }


  function clearForm() {
    $("#scoutName").val("");
    $("#teamNumber").val("");
    $("#matchNumber").val("");
    $("#driveScore1").prop("checked", false);
    $("#driveScore2").prop("checked", false);
    $("#driveScore3").prop("checked", false);
    $("#driveScore4").prop("checked", false);
    $("#driveScore5").prop("checked", false);

    $("#multinote_starting_zone").prop("checked", false);
    $("#multinote_centerline").prop("checked", false);  

    $("#shootsFromScore1").prop("checked", false);
    $("#shootsFromScore2").prop("checked", false);
    $("#shootsFromScore3").prop("checked", false);
    $("#shootsFromScore4").prop("checked", false);

    $("#passingScore1").prop("checked", false);
    $("#passingScore2").prop("checked", false);
    $("#passingScore3").prop("checked", false);

    $("#underStageScore1").prop("checked", false);
    $("#underStageScore2").prop("checked", false);
    $("#underStageScore3").prop("checked", false);

    $("#defenseTactic1").prop("checked", false); 
    $("#defenseTactic2").prop("checked", false);
    $("#defenseTactic3").prop("checked", false);
    $("#defenseComment").val("");

    $("#againstTactic1").prop("checked", false);
    $("#againstTactic2").prop("checked", false);
    $("#againstComment").val(""); 

    $("#foul1").prop("checked", false); 
    $("#foul2").prop("checked", false); 
    $("#foul3").prop("checked", false); 
    $("#foul4").prop("checked", false);
    $("#foul5").prop("checked", false);
    $("#foul6").prop("checked", false);

    $("#climbComment").val("");  
    $("#problemComment").val(""); 
    $("#generalComment").val("");
  }

  function writeDataToAPI() {
    var dataToUse = {};

    // Clean up teamnumber before writing to table.
    var teamnum = $("#teamNumber").val();
    teamnum = teamnum.toUpperCase();  // if there's a letter, make it upper case
    teamnum = teamnum.replace(/[^0-9a-zA-Z]/g, '');  // remove any non-alphanumeric chars
    dataToUse["scoutname"] = $("#scoutName").val();
    dataToUse["teamnumber"] = teamnum;
    dataToUse["matchnumber"] = $("#matchNumber").val();
	  
    // Assume that some options were not checked at all.
    dataToUse["driverability"] = 0; // default
    if ($("#driveScore1").is(':checked')) {
      dataToUse["driverability"] = 1;
    }
    if ($("#driveScore2").is(':checked')) {
      dataToUse["driverability"] = 2;
    }
    if ($("#driveScore3").is(':checked')) {
      dataToUse["driverability"] = 3;
    }
    if ($("#driveScore4").is(':checked')) {
      dataToUse["driverability"] = 4;
    }
    if ($("#driveScore5").is(':checked')) {
      dataToUse["driverability"] = 5;
    }
    
    dataToUse["multinote_starting_zone"] = 0;  // default
    dataToUse["multinote_centerline"] = 0;     // default
    if ($("#multinote_starting_zone").is(':checked')) {
      dataToUse["multinote_starting_zone"] = 1;
    }
    if ($("#multinote_centerline").is(':checked')) {
      dataToUse["multinote_centerline"] = 1;
    }
      
    dataToUse["shootsfrom"] = 0; // default
    if ($("#shootsFromScore1").is(':checked')) {
      dataToUse["shootsfrom"] = 1;
    }
    if ($("#shootsFromScore2").is(':checked')) {
      dataToUse["shootsfrom"] = 2;
    }
    if ($("#shootsFromScore3").is(':checked')) {
      dataToUse["shootsfrom"] = 3;
    }
    if ($("#shootsFromScore4").is(':checked')) {
      dataToUse["shootsfrom"] = 4;
    }
    console.log(dataToUse["shootsfrom"]);
      
    dataToUse["passing"] = 0; // default
    if ($("#passingScore1").is(':checked')) {
      dataToUse["passing"] = 1;
    }
    if ($("#passingScore2").is(':checked')) {
      dataToUse["passing"] = 2;
    }
    if ($("#passingScore3").is(':checked')) {
      dataToUse["passing"] = 3;
    }

    dataToUse["understage"] = 0;  // default
    if ($("#underStageScore1").is(':checked')) {
      dataToUse["understage"] = 1;
    }
    if ($("#underStageScore2").is(':checked')) {
      dataToUse["understage"] = 2;
    }
    if ($("#underStageScore3").is(':checked')) {
      dataToUse["understage"] = 3;
    }

    dataToUse["defense_tactic1"] = 0;     // default
    dataToUse["defense_tactic2"] = 0;     // default
    dataToUse["defense_tactic3"] = 0;     // default
    if ($("#defenseTactic1").is(':checked')) {
      dataToUse["defense_tactic1"] = 1;
    }
    if ($("#defenseTactic2").is(':checked')) {
      dataToUse["defense_tactic2"] = 1;
    }
    if ($("#defenseTactic3").is(':checked')) {
      dataToUse["defense_tactic3"] = 1;
    }
    dataToUse["defense_comment"] = $("#defenseComment").val();

    dataToUse["against_tactic1"] = 0;     // default
    dataToUse["against_tactic2"] = 0;     // default
    if ($("#againstTactic1").is(':checked')) {
      dataToUse["against_tactic1"] = 1;
    }
    if ($("#againstTactic2").is(':checked')) {
      dataToUse["against_tactic2"] = 1;
    }
    dataToUse["against_comment"] = $("#againstComment").val();

    dataToUse["foul1"] = 0;     // default
    dataToUse["foul2"] = 0;     // default
    dataToUse["foul3"] = 0;     // default
    dataToUse["foul4"] = 0;     // default
    dataToUse["foul5"] = 0;     // default
    dataToUse["foul6"] = 0;     // default
    if ($("#foul1").is(':checked')) {
      dataToUse["foul1"] = 1;
    }
    if ($("#foul2").is(':checked')) {
      dataToUse["foul2"] = 1;
    }
    if ($("#foul3").is(':checked')) {
      dataToUse["foul3"] = 1;
    }
    if ($("#foul4").is(':checked')) {
      dataToUse["foul4"] = 1;
    }
    if ($("#foul5").is(':checked')) {
      dataToUse["foul5"] = 1;
    }
    if ($("#foul6").is(':checked')) {
      dataToUse["foul6"] = 1;
    }

    dataToUse["climb_comment"] = $("#climbComment").val();
    dataToUse["problem_comment"] = $("#problemComment").val();
    dataToUse["general_comment"] = $("#generalComment").val();

    $.post("writeAPI.php", {
      writeDriveRankData: JSON.stringify(dataToUse)
    }).done(function(data) {
      // Because success word may have a new-line at the end, don't do a direct compare
      if (data.indexOf('success') > -1) {
        alert("Success in submitting strategic scouting data!");
        clearForm();
      } else {
        alert("Failure in submitting strategic scouting!");
      }
    });
  }
	

  $(document).ready(function() {

    $("#submitButton").click(function() {
      if (!verifyData()) {
        writeDataToAPI();
      }
    });

  });
</script>
