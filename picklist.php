<?php include "header.php"; ?>

<title>Pick List</title>
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

<?php include "footer.php"; ?>

<script>

  var eventCode = null;
  var oprData = {};          // for TBA OPR data

  function dummylocalAveragesLookup(localAverages, team, item) {
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
    if (!dict) {
      return 0;
    }
    if ("totalPoints" in dict) {
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
  function createCSVLine(localAverages, team, bSkipOpr) {
    var oprTP = 0;
    var pitLocation = 0;
    if (bSkipOpr == false)
      oprTP = dummyGetOPR(oprData[team]);
    //var trapPercent = rnd(dummylocalAveragesLookup(localAverages,team, "trapPercentage"));
    var teleopCoralScoringAcc = rnd(dummylocalAveragesLookup(localAverages, team, "teleopCoralScoringPercent"));
    var teleopAlgaeScoringAcc = rnd(dummylocalAveragesLookup(localAverages, team, "teleopAlgaeScoringPercent"));
    var endgameClimbPercent = dummylocalAveragesLookup(localAverages, team, "endgameClimbPercent");
    //var endgameharmonyPercentage = dummylocalAveragesLookup(localAverages,team, "endgameharmonypercent");
    var out = team + ",";
    out += pitLocation + ",";
    out += oprTP + ",";
    out += dummylocalAveragesLookup(localAverages, team, "avgTotalCoral") + ",";
    out += dummylocalAveragesLookup(localAverages, team, "maxTotalCoral") + ",";
    out += dummylocalAveragesLookup(localAverages, team, "avgTotalAlgae") + ",";
    out += dummylocalAveragesLookup(localAverages, team, "maxTotalAlgae") + ",";
    out += dummylocalAveragesLookup(localAverages, team, "avgTotalAutoPoints") + ",";
    out += dummylocalAveragesLookup(localAverages, team, "maxTotalAutoPoints") + ",";
    out += dummylocalAveragesLookup(localAverages, team, "avgTotalTeleopPoints") + ",";
    out += dummylocalAveragesLookup(localAverages, team, "maxTotalTeleopPoints") + ",";
    out += dummylocalAveragesLookup(localAverages, team, "avgEndgamePoints") + ",";
    out += dummylocalAveragesLookup(localAverages, team, "maxEndgamePoints") + ",";
    out += dummylocalAveragesLookup(localAverages, team, "avgTotalPoints") + ",";
    out += dummylocalAveragesLookup(localAverages, team, "maxTotalPoints") + ",";
    out += dummylocalAveragesLookup(localAverages, team, "avgAutonCoral") + ",";
    out += dummylocalAveragesLookup(localAverages, team, "maxAutonCoral") + ",";
    out += dummylocalAveragesLookup(localAverages, team, "avgAutonCoralL1") + ",";
    out += dummylocalAveragesLookup(localAverages, team, "maxAutonCoralL1") + ",";
    out += dummylocalAveragesLookup(localAverages, team, "avgAutonCoralL2") + ",";
    out += dummylocalAveragesLookup(localAverages, team, "maxAutonCoralL2") + ",";
    out += dummylocalAveragesLookup(localAverages, team, "avgAutonCoralL3") + ",";
    out += dummylocalAveragesLookup(localAverages, team, "maxAutonCoralL3") + ",";
    out += dummylocalAveragesLookup(localAverages, team, "avgAutonCoralL4") + ",";
    out += dummylocalAveragesLookup(localAverages, team, "maxAutonCoralL4") + ",";
    out += dummylocalAveragesLookup(localAverages, team, "avgAutonAlgae") + ",";
    out += dummylocalAveragesLookup(localAverages, team, "maxAutonAlgae") + ",";
    out += dummylocalAveragesLookup(localAverages, team, "avgAutonAlgaeNet") + ",";
    out += dummylocalAveragesLookup(localAverages, team, "maxAutonAlgaeNet") + ",";
    out += dummylocalAveragesLookup(localAverages, team, "avgAutonAlgaeProc") + ",";
    out += dummylocalAveragesLookup(localAverages, team, "maxAutonAlgaeProc") + ",";
    out += dummylocalAveragesLookup(localAverages, team, "avgTeleopCoralScored") + ",";
    out += dummylocalAveragesLookup(localAverages, team, "maxTeleopCoralScored") + ",";
    out += dummylocalAveragesLookup(localAverages, team, "avgTeleopCoralL1") + ",";
    out += dummylocalAveragesLookup(localAverages, team, "maxTeleopCoralL1") + ",";
    out += dummylocalAveragesLookup(localAverages, team, "avgTeleopCoralL2") + ",";
    out += dummylocalAveragesLookup(localAverages, team, "maxTeleopCoralL2") + ",";
    out += dummylocalAveragesLookup(localAverages, team, "avgTeleopCoralL3") + ",";
    out += dummylocalAveragesLookup(localAverages, team, "maxTeleopCoralL3") + ",";
    out += dummylocalAveragesLookup(localAverages, team, "avgTeleopCoralL4") + ",";
    out += dummylocalAveragesLookup(localAverages, team, "maxTeleopCoralL4") + ",";
    out += dummylocalAveragesLookup(localAverages, team, "teleopCoralScoringPercent") + ",";
    out += dummylocalAveragesLookup(localAverages, team, "avgTeleopAlgaeScored") + ",";
    out += dummylocalAveragesLookup(localAverages, team, "maxTeleopAlgaeScored") + ",";
    out += dummylocalAveragesLookup(localAverages, team, "avgTeleopAlgaeNet") + ",";
    out += dummylocalAveragesLookup(localAverages, team, "maxTeleopAlgaeNet") + ",";
    out += dummylocalAveragesLookup(localAverages, team, "avgTeleopAlgaeProc") + ",";
    out += dummylocalAveragesLookup(localAverages, team, "maxTeleopAlgaeProc") + ",";
    out += dummylocalAveragesLookup(localAverages, team, "teleopAlgaeScoringPercent") + ",";
    out += dummyGet(endgameClimbPercent, 0) + ",";
    out += dummyGet(endgameClimbPercent, 1) + ",";
    out += dummyGet(endgameClimbPercent, 2) + ",";
    out += dummyGet(endgameClimbPercent, 3) + ",";
    out += dummyGet(endgameClimbPercent, 4) + ",";
    out += dummylocalAveragesLookup(localAverages, team, "totaldied") + ",";
    out += "-\n";    // NOTE
    return out;
  }

  function processData(matchData, bSkipOpr) {
    console.log("setting up mdp ");
    var mdp = new matchDataProcessor(matchData);
    var csvStr = "Team,Pit Location,OPR,Total Coral Avg,Total Coral Max,Total Algae Avg,Total Algae Max,Auto Pts Avg,Auto Pts Max,Tel Pts Avg,Tel Pts Max,End Pts Avg,End Pts Max,Total Pts Avg,Total Pts Max,Auto Coral Avg,Auto Coral Max,Auto L1 Avg,Auto L1 Max,Auto L2 Avg,Auto L2 Max,Auto L3 Avg,Auto L3 Max,Auto L4 Avg,Auto L4 Max,Auto Algae Avg,Auto Algae Max,Auto Net Avg,Auto Net Max,Auto Proc Avg,Auto Proc Max,Tel Coral Avg,Tel Coral Max,Tel L1 Avg,Tel L1 Max,Tel L2 Avg,Tel L2 Max,Tel L3 Avg,Tel L3 Max,Tel L4 Avg,Tel L4 Max,Tel Coral Acc,Tel Algae Avg,Tel Algae Max,Tel Net Avg,Tel Net Max,Tel Proc Avg,Tel Proc Max,Tel Algae Acc,End N/A,End Park,End Fall,End Shal,End Deep, Total Died, Note\n";
    mdp.getSiteFilteredAverages(function (averageData) {
      console.log("writing csv lines");
      for (var key in averageData) {
        csvStr += createCSVLine(averageData, key, bSkipOpr);  // key is team number
      }

      var hiddenElement = document.createElement('a');
      var filename = eventCode + ".csv";
      console.log("CSV filename = " + filename);
      hiddenElement.href = 'data:text/csv;charset=utf-8,' + encodeURI(csvStr);
      hiddenElement.target = '_blank';
      hiddenElement.download = filename;
      hiddenElement.click();
    });
  }

  function writeCSVFile(bSkipOpr) {
    console.log("starting writeCSVFile(): skipOpr = " + bSkipOpr);

    console.log("getting raw data");
    $.get("readAPI.php", {
      getAllData: 1
    }).done(function (data) {
      matchData = JSON.parse(data);

      if (bSkipOpr == false) {
        // Get OPR data 
        console.log("getting OPR data");
        $.get("tbaAPI.php", {
          getCOPRs: 1
        }).done(function (data) {
          data = JSON.parse(data)["data"];
          oprData = data;
          console.log("--> setting oprData");
          processData(matchData, bSkipOpr);
        });
      }
      else {
        console.log("skipped OPR ");
        processData(matchData, bSkipOpr);
      }
    });
  }


  $(document).ready(function () {
    var bSkipOPR = false;
    if ($("#skip_opr").is(":checked") == true)
      bSkipOPR = true;    // Don't put OPR data in the CSV file

    $.get("./tbaAPI.php", {
      getEventCode: true
    }, function (data) {
      eventCode = data;
    });

    $("#download_csv_file").on('click', function (event) {
      // Write out picklist CSV file to client's download dir.
      writeCSVFile(bSkipOPR);
    });
  });

</script>

<script type="text/javascript" src="./scripts/matchDataProcessor.js"></script>
