<title>Drive Rank</title>
<?php include("header.php") ?>
<div class="container row-offcanvas row-offcanvas-left">
  <div class="well column  col-lg-12  col-sm-12 col-xs-12" id="content">
        <div class="row pt-3 pb-3 mb-3">
          <div class="card col-md-12">
            <div class="card-body">
              <h2 id="driverRankName">Driver Rank</h2>
			  <a href="./driveRankRawData.php">Raw Drive Ranking Data</a>
            </div>
          </div>
        </div>
        <div class="card-header">
          Drive Ranking
        </div>  
        <div class="card mb-3">
        
		<div class="mb-3">
              <label for="scoutName" class="form-label">Scout Name</label>
              <input type="text" class="form-control" id="scoutName">
         </div>
		
        <div class="mb-5">
          <label for="teamNumber" class="form-label">Team Number </label>
          <input type="number" class="form-control" id="teamNumber">
        </div>
			
		 <div class="mb-3">
              <label for="matchNumber" class="form-label">Match Number </label>
              <input type="number" class="form-control" id="matchNumber">
         </div>

        <div>
          <label class="form-label">Driver Ability</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="driverAbilityGroup" id="driveScore1">
          <label class="form-check-label" for="driveScore1">1 (Beginner)</label>
        </div>
            
        <div class="form-check form-check-inline">
           <input class="form-check-input" type="radio" name="driverAbilityGroup" id="driveScore2">
           <label class="form-check-label" for="driveScore2">2(Intermediate)</label>
        </div>
            
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="driverAbilityGroup" id="driveScore3">
          <label class="form-check-label" for="driveScore3">3(Advanced)</label>
        </div>
              
        <div>
          <label class="form-label">Quickness</label>
        </div>
        
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="quicknessGroup" id="quicknessScore1">
          <label class="form-check-label" for="quicknessScore1">1 (Slow/Jerky)</label>
        </div>
            
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="quicknessGroup" id="quicknessScore2">
          <label class="form-check-label" for="quicknessScore2">2 (Average)</label>
        </div>
        
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="quicknessGroup" id="quicknessScore3">
          <label class="form-check-label" for="3">3 (Swift)</label>
        </div>
              
        <div>
          <label class="form-label">Field Awareness</label>
        </div>
            
        <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="fieldAwarenessGroup" id="fieldAwarenessScore1">
              <label class="form-check-label" for="fieldAwarenessScore1">1 (Minimal)</label>
        </div>
            
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="fieldAwarenessGroup" id="fieldAwarenessScore2">
          <label class="form-check-label" for="fieldAwarenessScore2">2 (Average)</label>
        </div>
            
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="fieldAwarenessGroup" id="fieldAwarenessScore3">
          <label class="form-check-label" for="fieldAwarenessScore3">3 (Highly Aware/Agile)</label>
        </div>

        <div>
          <label class="form-label">About how many game pieces were dropped?</label>
        </div>
            
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="gamepieceDropGroup" id="gamepieceDropScore1">
          <label class="form-check-label" for="gamepieceDropScore1">0-1 (Minimal)</label>
        </div>
            
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="gamepieceDropGroup" id="gamepieceDropScore2">
          <label class="form-check-label" for="gamepieceDropScore2">2-4</label>
        </div>
             
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="gamepieceDropGroup" id="gamepieceDropScore3">
          <label class="form-check-label" for="gamepieceDropScore3">5+</label>
        </div>
			
		<div class="card mb-3">
           <div class="card-body">
             <div class="overflow-auto">
               <h5 class="text-center"> 
                <a href="#collapsedriveRankGraph" data-bs-toggle="collapse" aria-expanded="false"> Drive Rank Graph</a></h5>
                 <div class="collapse" id="collapsedriveRankGraph">
                 <canvas id="mydriveRankChart" width="400" height="400"></canvas>
                </div>
             </div>
           </div>
        </div>
    
        <div class="d-grid gap-2 col-6 mx-auto">
              <button class="btn btn-primary" type="button" id="submitButton">Submit</button>
        </div>
			
		<div id="myChart" style="width:75%; height:400px;"></div>
        </form>
      </div>
    </div>
  </div>
 

<?php include("footer.php") ?>

<script>
  var chartDefined = false;
  var myChart;
  function verifyData() {
    var isError = false;
    var errMsg = "Please enter values for these fields:";

    // Make sure each piece of data has a value selected. 
	if ($("#scoutName").val() == "") {
      errMsg += " Scout Name";
      isError = true;
    }

    if ($("#teamNumber").val() == "") {
      errMsg += " Team Number";
      isError = true;
    }
	  
	if ($("#matchNumber").val() == "") {
      errMsg += " Match Number";
      isError = true;
    }

    if ((!($("#driveScore1").is(':checked'))) && (!($("#driveScore2").is(':checked'))) && (!($("#driveScore3").is(':checked')))) {
      if (isError == true) 
        errMsg += ", Drive Ability";
      else errMsg += " Drive Ability";
      isError = true;
    }
      
    if ((!($("#quicknessScore1").is(':checked'))) && (!($("#quicknessScore2").is(':checked'))) && (!($("#quicknessScore3").is(':checked')))) {
      if (isError == true) 
        errMsg += ", Quickness";
      else errMsg += " Quickness";
      isError = true;
    }

    if ((!($("#fieldAwarenessScore1").is(':checked'))) && (!($("#fieldAwarenessScore2").is(':checked'))) && (!($("#fieldAwarenessScore3").is(':checked')))) {
      if (isError == true) 
        errMsg += ", Field Awareness";
      else errMsg += " Field Awareness";
      isError = true;
    }
    
    if ((!($("#gamepieceDropScore1").is(':checked'))) && (!($("#gamepieceDropScore2").is(':checked'))) && (!($("#gamepieceDropScore3").is(':checked')))) {
      if (isError == true) 
        errMsg += ", Gamepiece Drop";
      else errMsg += " Gamepiece Drop";
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
    $("#quicknessScore1").prop("checked", false);
    $("#quicknessScore2").prop("checked", false);
    $("#quicknessScore3").prop("checked", false);
    $("#fieldAwarenessScore1").prop("checked", false);
    $("#fieldAwarenessScore2").prop("checked", false);
    $("#fieldAwarenessScore3").prop("checked", false);
    $("#gamepieceDropScore1").prop("checked", false);
    $("#gamepieceDropScore2").prop("checked", false);
    $("#gamepieceDropScore3").prop("checked", false);
  }

  function writeDataToAPI() {
    var dataToUse = {};
	dataToUse["scoutname"] = $("#teamNumber").val();
    dataToUse["teamnumber"] = $("#teamNumber").val();
    dataToUse["matchnumber"] = $("#matchNumber").val();
	  
    if ($("#driveScore1").is(':checked')) {
      dataToUse["driverability"] = 1;
    }
    if ($("#driveScore2").is(':checked')) {
      dataToUse["driverability"] = 2;
    }
    if ($("#driveScore3").is(':checked')) {
      dataToUse["driverability"] = 3;
    }
    
    if ($("#quicknessScore1").is(':checked')) {
      dataToUse["quickness"] = 1;
    }
    if ($("#quicknessScore2").is(':checked')) {
      dataToUse["quickness"] = 2;
    }
    if ($("#quicknessScore3").is(':checked')) {
      dataToUse["quickness"] = 3;
    }
      
    if ($("#fieldAwarenessScore1").is(':checked')) {
      dataToUse["fieldawareness"] = 1;
    }
    if ($("#fieldAwarenessScore2").is(':checked')) {
      dataToUse["fieldawareness"] = 2;
    }
    if ($("#fieldAwarenessScore3").is(':checked')) {
      dataToUse["fieldawareness"] = 3;
    }
      
    if ($("#gamepieceDropScore1").is(':checked')) {
      dataToUse["gamepiecedrop"] = 1;
    }
    if ($("#gamepieceDropScore2").is(':checked')) {
      dataToUse["gamepiecedrop"] = 2;
    }
    if ($("#gamepieceDropScore3").is(':checked')) {
      dataToUse["gamepiecedrop"] = 3;
    }


    $.post("writeAPI.php", {
      writeDriveRankData: JSON.stringify(dataToUse)
    }).done(function(data) {
      // Because success word may have a new-line at the end, don't do a direct compare
      if (data.indexOf('success') > -1) {
        alert("Success in submitting drive rank data!");
        clearForm();
      } else {
        alert("Failure in submitting drive rank data!");
      }
    });
  }
	
	function dataTodriveRankGraph() {
    // Declare variables
    var match_list = []; // List of matches to use as x lables
    var datasets = []; // Each entry is a dict with a label and data attribute
	
    datasets.push({
      label: "Driver Ability",
      data: [],
      borderColor: 'Red'
    });
    datasets.push({
      label: "Quickness",
      data: [],
      borderColor: 'Yellow'
    });
    datasets.push({
      label: "Field Awareness",
      data: [],
      borderColor: 'Green'
    });
    datasets.push({
      label: "Game Piece Drop",
      data: [],
      borderColor: 'Blue'
    });

    var teamNumber = document.getElementById("teamNumber").value;
    var driverAbility = document.querySelector('input[name="driverAbilityGroup"]:checked').value;
    var quickness = document.querySelector('input[name="quicknessGroup"]:checked').value;
    var fieldAwareness = document.querySelector('input[name="fieldAwarenessGroup"]:checked').value;
    var gamepieceDrop = document.querySelector('input[name="gamepieceDropGroup"]:checked').value;

    var data = {
      teamNumber: teamNumber,
      driverAbility: driverAbility,
      quickness: quickness,
      fieldAwareness: fieldAwareness,
      gamepieceDrop: gamepieceDrop
    };

  // Define the graph as a line chart:
    if (chartDefined) {
      myChart.destroy();
    }
    chartDefined = true;
  }

  function drawLineChart(data) {
    var ctx = document.getElementById("myChart").getContext("2d");
    var chart = new Chart(ctx, {
      type: "line",
      data: {
        labels: ["Team Number", "Driver Ability", "Quickness", "Field Awareness", "Game Piece Drop"],
        datasets: {
          label: "Drive Rank",
          data: [data.teamNumber, data.driverAbility, data.quickness, data.fieldAwareness, data.gamepieceDrop],
          borderColor: [
            "rgba(255, 99, 132, 1)",
            "rgba(54, 162, 235, 1)",
            "rgba(255, 206, 86, 1)",
            "rgba(75, 192, 192, 1)",
            "rgba(153, 102, 255, 1)"
          ],
          borderWidth: 1
      },
      options: {
        scales: {
          y: {
              beginAtZero: true
            
          }
        }
      }
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
