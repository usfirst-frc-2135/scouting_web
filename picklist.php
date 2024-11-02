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
    if (item == "endgamestagepercent") {
      return localAverages[team][item][2];
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

  // Returns a string with the comma-separated line of data for the given team.
  function createCSVLine(localAverages,team) {
    var oprTP = dummyGetOPR(oprData[team]);
    var onstagePercent = rnd(dummylocalAveragesLookup(localAverages,team, "endgamestagepercent"));
    var trapPercent = rnd(dummylocalAveragesLookup(localAverages,team, "trapPercentage"));
    var teleopShootingAcc = rnd(dummylocalAveragesLookup(localAverages,team, "teleopSpeakerShootPercent"));
    var out = team+",";
    out += oprTP + ",";
    out += dummylocalAveragesLookup(localAverages,team, "avgtotalnotes") + ",";
    out += dummylocalAveragesLookup(localAverages,team, "maxtotalnotes") + ",";
    out += dummylocalAveragesLookup(localAverages,team, "avgautonotes") + ",";
    out += dummylocalAveragesLookup(localAverages,team, "avgteleopnotes") + ",";
    out += teleopShootingAcc + ",";
    out += dummylocalAveragesLookup(localAverages,team, "avgPasses") + ",";
    out += dummylocalAveragesLookup(localAverages,team, "maxPasses") + ",";
    out += dummylocalAveragesLookup(localAverages,team, "avgendgamepoints") + ",";
    out += onstagePercent + ",";
    out += trapPercent + ",";
    out += dummylocalAveragesLookup(localAverages,team, "totaldied") + ",";
    out += "-\n";    // Comment
    return out;
  }


  function writeCSVFile() {
    console.log("starting writeCSVFile() ");
    // Get OPR data 
    $.get("tbaAPI.php", {
      getCOPRs: 1
    }).done(function(data) {
      data = JSON.parse(data)["data"];
      oprData = data;

      $.get("readAPI.php", {
        getAllData: 1
      }).done(function(data) {
        matchData = JSON.parse(data);
        var mdp = new matchDataProcessor(matchData);
        var csvStr = "Team,OPR,Avg Total Notes,Max Total Notes,Avg A Notes,Avg T Notes,T Speaker Acc,Avg Passes,Max Passes,Avg E Points, Onstage%, Trap%, Total Died, Comment\n";
        mdp.getSiteFilteredAverages(function(averageData) {
          for (var key in averageData) {
            csvStr += createCSVLine(averageData,key);  // key is team number
          }

          var hiddenElement = document.createElement('a');
          var filename = eventCode + ".csv";
          console.log("CSV filename = "+filename);
          hiddenElement.href = 'data:text/csv;charset=utf-8,' + encodeURI(csvStr);
          hiddenElement.target = '_blank';
          hiddenElement.download = filename;
          hiddenElement.click();
        });
      });
    });
  }


  $(document).ready(function() {

    $.get("./tbaAPI.php", {
      getEventCode: true
    }, function(data) {
        eventCode = data;
    });
      
    $("#download_csv_file").on('click', function(event) {
       // Write out picklist CSV file to client's download dir.
       writeCSVFile();
    });
  });

</script>

<script type="text/javascript" src="./scripts/matchDataProcessor.js"></script>
