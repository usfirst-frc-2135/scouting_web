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
  var localNotes = {};


  function dummyGet(dict, key) {
    /* If key doesn't exist in given dict, return a 0. */
    if (!dict) {
      return 0;
    }
    if (key in dict) {
      return dict[key];
    }
    return 0;
  }

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

// Returns a string with the comma-separated line of data for the given team.
  function createCSVLine(localAverages,team) {
    var onstagePercent = rnd(dummylocalAveragesLookup(localAverages,team, "endgamestagepercent"));
    var trapPercent = rnd(dummylocalAveragesLookup(localAverages,team, "avgtrap") * 100);
    var out = team+",";
    out += dummylocalAveragesLookup(localAverages,team, "avgtotalnotes") + ",";
    out += dummylocalAveragesLookup(localAverages,team, "maxtotalnotes") + ",";
    out += dummylocalAveragesLookup(localAverages,team, "avgautonotes") + ",";
    out += dummylocalAveragesLookup(localAverages,team, "avgteleopnotes") + ",";
    out += dummylocalAveragesLookup(localAverages,team, "avgendgamepoints") + ",";
    out += onstagePercent + ",";
    out += trapPercent + ",";
    out += dummylocalAveragesLookup(localAverages,team, "totaldied") + ",";
    out += "-\n";    // Comment
    return out;
  }


  function writeCSVFile() {
    console.log("starting writeCSVFile() ");
    $.get("readAPI.php", {
      getAllData: 1
    }).done(function(data) {
      matchData = JSON.parse(data);
      var mdp = new matchDataProcessor(matchData);
      var plistStrings = "Team,Avg Total Notes,Max Total Notes,Avg A Notes,Avg T Notes,Avg E Notes, Onstage%, Trap%, Total Died, Comment\n";
      mdp.getSiteFilteredAverages(function(averageData) {
        for (var key in averageData) {
          plistStrings += createCSVLine(averageData,key);  // key is team number
        }

        // Now create a csv file with these strings
        $.post("writeAPI.php", {
          writePicklist: plistStrings
        }).done(function(data) {
        });
      });
    });
  }

  function downloadCSVFile(newPath) { 
    console.log("starting downloadCSVFile() ");
    var filename = eventCode + ".csv"; 
    
    $.ajax({
      url:'downloadFile.php',
      data: {'file' : filename,
             'newFilePath' : newPath}
    }).then(
       function(response)
       {
         var jsonData = JSON.parse(response);
         if(jsonData.success == "1")
           alert("Successfully downloaded "+filename); 
         else
           alert("Failed to download "+filename); 
       }

     );
  }


  $(document).ready(function() {

    $.get("./tbaAPI.php", {
      getEventCode: true
    }, function(data) {
        eventCode = data;
    });
      
    $("#download_csv_file").on('click', function(event) {
       // Write out CSV file (will overwrite existing one).
       writeCSVFile();  

       // Download existing CSV file.
       const userInput = prompt("Please enter MAC user id: ");
       if (!userInput == "") {
         const newPath = "/Users/" + userInput + "/" + "Desktop/" + eventCode + ".csv";
         downloadCSVFile(newPath); 
       }
    });
  });

</script>

<script type="text/javascript" src="./scripts/matchDataProcessor.js"></script>
