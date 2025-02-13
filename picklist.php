<title>Pick List</title>
<?php include("header.php") ?>
<div class="container row-offcanvas row-offcanvas-left">
  <div class="well column  col-lg-12  col-sm-12 col-xs-12" id="content">
    <div class="row pt-3 pb-3 mb-3">
      <div id="authFlagDiv" class="card col-md-12">
        <div class="card-body">
          <h2 id="pickListName">Pick List</h2>
        </div>
      </div>
    </div>

  </div>
  <div class="row pt-3 pb-3 mb-3">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="mb-3">
              <label for="skip_opr" class="form-label">Skip OPR data in picklist</label>
              <input class="form-check-input" type="checkbox" id="skip_opr">
          </div>

          <div class="col-md-2 mt-1 mb-1">
            <button type="button" id="download_csv_file" class="btn btn-primary">Download CSV File</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<?php include("footer.php") ?>

<script>

  var eventCode = null;
  var oprData = {};          // for TBA OPR data

  function dummylocalAveragesLookup(localAverages,team, item) {
    if (!localAverages) {
      return "NA";
    }
    if (!(team in localAverages)) {
      return "NA";
    }
    return localAverages[team][item];
  }

  function rnd(val) {
    // Rounding helper function 
    return Math.round((val + Number.EPSILON) * 100) / 100;
  }

  function dummyGetOPR(dict) {
    if(!dict) {
      return 0;
    }
    if("totalPoints" in dict ) {
      return dict["totalPoints"];
    }
    return 0;
  }
    
    
   function dummyGet(dict, key) {
    /* If key doesn't exist in given dict, return a 0. */
    // console.log(dict);
    if (!dict) {
      return 0;
    }
    if (key in dict) {
      return dict[key];
    }
    return 0;
  }
    

  // Returns a string with the comma-separated line of data for the given team.
  function createCSVLine(localAverages,team,bSkipOpr) {
    var oprTP = 0;
    if(bSkipOpr == false) 
      oprTP = dummyGetOPR(oprData[team]);
    //var trapPercent = rnd(dummylocalAveragesLookup(localAverages,team, "trapPercentage"));
    var teleopCoralScoringAcc = rnd(dummylocalAveragesLookup(localAverages,team, "teleopCoralScoringPercent"));
    var teleopAlgaeScoringAcc = rnd(dummylocalAveragesLookup(localAverages,team, "teleopAlgaeScoringPercent"));
    var endgameClimbPercent = dummylocalAveragesLookup(localAverages,team, "endgameClimbPercent");
    //var endgameharmonyPercentage = dummylocalAveragesLookup(localAverages,team, "endgameharmonypercent");
    var out = team+",";
    out += oprTP + ",";
    out += dummylocalAveragesLookup(localAverages,team, "avgTotalCoral") + ",";
    out += dummylocalAveragesLookup(localAverages,team, "maxTotalCoral") + ",";
    out += dummylocalAveragesLookup(localAverages,team, "avgTotalAlgae") + ",";
    out += dummylocalAveragesLookup(localAverages,team, "maxTotalAlgae") + ",";  
    out += dummylocalAveragesLookup(localAverages,team, "avgTotalAutoPoints") + ",";
    out += dummylocalAveragesLookup(localAverages,team, "maxTotalAutoPoints") + ",";   
    out += dummylocalAveragesLookup(localAverages,team, "avgTotalTeleopPoints") + ",";
    out += dummylocalAveragesLookup(localAverages,team, "maxTotalTeleopPoints") + ",";  
    out += dummylocalAveragesLookup(localAverages,team, "avgEndgamePoints") + ",";  
    out += dummylocalAveragesLookup(localAverages,team, "maxEndgamePoints") + ",";  
    out += dummylocalAveragesLookup(localAverages,team, "avgTotalPoints") + ",";  
    out += dummylocalAveragesLookup(localAverages,team, "maxTotalPoints") + ",";  
    out += dummylocalAveragesLookup(localAverages,team, "avgAutonCoral") + ",";  
    out += dummylocalAveragesLookup(localAverages,team, "maxAutonCoral") + ","; 
    out += dummylocalAveragesLookup(localAverages,team, "avgAutonCoralL1") + ","; 
    out += dummylocalAveragesLookup(localAverages,team, "maxAutonCoralL1") + ","; 
    out += dummylocalAveragesLookup(localAverages,team, "avgAutonCoralL2") + ","; 
    out += dummylocalAveragesLookup(localAverages,team, "maxAutonCoralL2") + ","; 
    out += dummylocalAveragesLookup(localAverages,team, "avgAutonCoralL3") + ","; 
    out += dummylocalAveragesLookup(localAverages,team, "maxAutonCoralL3") + ","; 
    out += dummylocalAveragesLookup(localAverages,team, "avgAutonCoralL4") + ","; 
    out += dummylocalAveragesLookup(localAverages,team, "maxAutonCoralL4") + ","; 
    out += dummylocalAveragesLookup(localAverages,team, "avgAutonAlgae") + ","; 
    out += dummylocalAveragesLookup(localAverages,team, "maxAutonAlgae") + ","; 
    out += dummylocalAveragesLookup(localAverages,team, "avgAutonAlgaeNet") + ","; 
    out += dummylocalAveragesLookup(localAverages,team, "maxAutonAlgaeNet") + ","; 
    out += dummylocalAveragesLookup(localAverages,team, "avgAutonAlgaeProc") + ","; 
    out += dummylocalAveragesLookup(localAverages,team, "maxAutonAlgaeProc") + ","; 
    out += dummylocalAveragesLookup(localAverages,team, "avgTeleopCoralScored") + ","; 
    out += dummylocalAveragesLookup(localAverages,team, "maxTeleopCoralScored") + ",";  
    out += dummylocalAveragesLookup(localAverages,team, "avgTeleopCoralL1") + ",";  
    out += dummylocalAveragesLookup(localAverages,team, "maxTeleopCoralL1") + ",";  
    out += dummylocalAveragesLookup(localAverages,team, "avgTeleopCoralL2") + ",";  
    out += dummylocalAveragesLookup(localAverages,team, "maxTeleopCoralL2") + ",";  
    out += dummylocalAveragesLookup(localAverages,team, "avgTeleopCoralL3") + ",";  
    out += dummylocalAveragesLookup(localAverages,team, "maxTeleopCoralL3") + ",";  
    out += dummylocalAveragesLookup(localAverages,team, "avgTeleopCoralL4") + ",";  
    out += dummylocalAveragesLookup(localAverages,team, "maxTeleopCoralL4") + ",";  
    out += dummylocalAveragesLookup(localAverages,team, "teleopCoralScoringPercent") + ",";  
    out += dummylocalAveragesLookup(localAverages,team, "avgTeleopAlgaeScored") + ",";  
    out += dummylocalAveragesLookup(localAverages,team, "maxTeleopAlgaeScored") + ",";  
    out += dummylocalAveragesLookup(localAverages,team, "avgTeleopAlgaeNet") + ",";  
    out += dummylocalAveragesLookup(localAverages,team, "maxTeleopAlgaeNet") + ",";  
    out += dummylocalAveragesLookup(localAverages,team, "avgTeleopAlgaeProc") + ",";  
    out += dummylocalAveragesLookup(localAverages,team, "maxTeleopAlgaeProc") + ",";  
    out += dummylocalAveragesLookup(localAverages,team, "teleopAlgaeScoringPercent") + ",";   
    out += dummyGet(endgameClimbPercent, 0) + ",";   
    out += dummyGet(endgameClimbPercent, 1) + ",";   
    out += dummyGet(endgameClimbPercent, 2) + ","; 
    out += dummyGet(endgameClimbPercent, 3) + ",";   
    out += dummyGet(endgameClimbPercent, 4) + ",";
    out += dummylocalAveragesLookup(localAverages,team, "totaldied") + ",";
    out += "-\n";    // NOTE
    return out;
  }

  function processData(matchData,bSkipOpr) {
    console.log("setting up mdp ");
    var mdp = new matchDataProcessor(matchData);
    var csvStr = "Team, OPR, Avg Total Coral,Max Total Coral,Avg Total Algae,Max Total Algae,Avg A Points,Max A Points,Avg T Points,Max T Points,Avg E Points,Max E Points,Avg Total Points,Max Total Points,Avg A Coral, Max A Coral,Avg A L1,Max A L1,Avg A L2,Max A L2,Avg A L3,Max A L3,Avg A L4,Max A L4,Avg A Algae,Max A Algae,Avg A Net,Max A Net,Avg A Proc,Max A Proc,Avg T Coral, Max T Coral,Avg T L1,Max T L1,Avg T L2,Max T L2,Avg T L3,Max T L3,Avg T L4,Max T L4,T Coral Acc,Avg T Algae,Max T Algae,Avg T Net,Max T Net,Avg T Proc,Max T Proc,T Algae Acc, N, P, F, S, D, Total Died, Note\n";
    mdp.getSiteFilteredAverages(function(averageData) {
      console.log("writing csv lines");
      for (var key in averageData) {
        csvStr += createCSVLine(averageData,key,bSkipOpr);  // key is team number
      }

      var hiddenElement = document.createElement('a');
      var filename = eventCode + ".csv";
      console.log("CSV filename = "+filename);
      hiddenElement.href = 'data:text/csv;charset=utf-8,' + encodeURI(csvStr);
      hiddenElement.target = '_blank';
      hiddenElement.download = filename;
      hiddenElement.click();
    });
  }

  function writeCSVFile(bSkipOpr) {
    console.log("starting writeCSVFile(): skipOpr = "+bSkipOpr);

    console.log("getting raw data");
    $.get("readAPI.php", {
      getAllData: 1
    }).done(function(data) {
      matchData = JSON.parse(data);

      if(bSkipOpr == false)
      {
        // Get OPR data 
        console.log("getting OPR data");
        $.get("tbaAPI.php", {
          getCOPRs: 1
        }).done(function(data) {
          data = JSON.parse(data)["data"];
          oprData = data;
          console.log("--> setting oprData");
          processData(matchData,bSkipOpr);
        });
      }
      else
      {
        console.log("skipped OPR ");
        processData(matchData,bSkipOpr);
      }
    });
  }


  $(document).ready(function() {
    var bSkipOPR = false;
    if( $("#skip_opr").is(":checked") == true)
      bSkipOPR = true;    // Don't put OPR data in the CSV file

    $.get("./tbaAPI.php", {
      getEventCode: true
    }, function(data) {
        eventCode = data;
    });
      
    $("#download_csv_file").on('click', function(event) {
       // Write out picklist CSV file to client's download dir.
       writeCSVFile(bSkipOPR);
    });
  });

</script>

<script type="text/javascript" src="./scripts/matchDataProcessor.js"></script>
