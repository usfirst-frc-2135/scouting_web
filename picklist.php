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
    var trapPercent = rnd(dummylocalAveragesLookup(localAverages,team, "trapPercentage"));
    var teleopShootingAcc = rnd(dummylocalAveragesLookup(localAverages,team, "teleopSpeakerShootPercent"));
    var endgamestagePercentage = dummylocalAveragesLookup(localAverages,team, "endgamestagepercent");
    var endgameharmonyPercentage = dummylocalAveragesLookup(localAverages,team, "endgameharmonypercent");
    var out = team+",";
    out += oprTP + ",";
    out += dummylocalAveragesLookup(localAverages,team, "avgtotalnotes") + ",";
    out += dummylocalAveragesLookup(localAverages,team, "maxtotalnotes") + ",";
    out += dummylocalAveragesLookup(localAverages,team, "avgautonotes") + ",";
    out += dummylocalAveragesLookup(localAverages,team, "maxautonotes") + ",";  
    out += dummylocalAveragesLookup(localAverages,team, "avgteleopnotes") + ",";
    out += dummylocalAveragesLookup(localAverages,team, "maxteleopnotes") + ",";   
    out += dummylocalAveragesLookup(localAverages,team, "avgendgamepoints") + ",";
    out += dummylocalAveragesLookup(localAverages,team, "maxendgamepoints") + ",";  
    out += dummylocalAveragesLookup(localAverages,team, "avgautonamps") + ",";  
    out += dummylocalAveragesLookup(localAverages,team, "maxautonamps") + ",";  
    out += dummylocalAveragesLookup(localAverages,team, "avgautonspeaker") + ",";  
    out += dummylocalAveragesLookup(localAverages,team, "maxautonspeaker") + ","; 
    out += dummylocalAveragesLookup(localAverages,team, "autonSpeakerShootPercent") + ","; 
    out += dummylocalAveragesLookup(localAverages,team, "avgteleopampnotes") + ",";  
    out += dummylocalAveragesLookup(localAverages,team, "maxteleopampnotes") + ",";  
    out += dummylocalAveragesLookup(localAverages,team, "avgteleopspeakernotes") + ",";  
    out += dummylocalAveragesLookup(localAverages,team, "maxteleopspeakernotes") + ",";  
    out += dummylocalAveragesLookup(localAverages,team, "teleopSpeakerShootPercent") + ",";   
    out += dummylocalAveragesLookup(localAverages,team, "avgPasses") + ",";
    out += dummylocalAveragesLookup(localAverages,team, "maxPasses") + ",";
    out += dummyGet(endgamestagePercentage, 0) + ",";   
    out += dummyGet(endgamestagePercentage, 1) + ",";   
    out += dummyGet(endgamestagePercentage, 2) + ","; 
    out += dummyGet(endgameharmonyPercentage, 0) + ",";   
    out += dummyGet(endgameharmonyPercentage, 1) + ",";
    out += dummyGet(endgameharmonyPercentage, 2) + ",";
    out += trapPercent + ",";
    out += dummylocalAveragesLookup(localAverages,team, "spotlitPercentage") + ",";   
    out += dummylocalAveragesLookup(localAverages,team, "totaldied") + ",";
    out += "-\n";    // NOTE
    return out;
  }

  function processData(matchData,bSkipOpr) {
    console.log("setting up mdp ");
    var mdp = new matchDataProcessor(matchData);
    var csvStr = "Team, OPR, Avg Total Notes,Max Total Notes,Avg A Notes, Max A Notes, Avg T Notes, Max T Notes, Avg E Points, Max E Points, Avg A Amp, Max A Amp, Avg A Speaker, Max A Speaker, A Speaker Acc, Avg T Amp, Max T Amp, Avg T Speaker, Max T Speaker, T Speaker Acc, Avg Passes, Max Passes, N, P, O, H 0, H 1, H 2, Trap%, Spotlit%, Total Died, Note\n";
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
