<?php include 'header.php'; ?>

<title>DB Status</title>

<div class="container row-offcanvas row-offcanvas-left">
  <div class="well column  col-lg-12  col-sm-12 col-xs-12" id="content">
    <div class="row pt-3 pb-3 mb-3">
      <div class="col-lg-6 col-sm-6 col-xs-6 gx-3">
        <div class="card">
          <div class="card-header">
            Database Status
          </div>
          <div class="card-body">
            <h4>SQL Server Status: <span id="serverStatus" class="badge bg-warning">Not Connected</span></h4>
            <h4>Database Server Status: <span id="dbStatus" class="badge bg-warning">Not Connected</span></h4>
            <h4>Data Table Status: <span id="dataTableStatus" class="badge bg-warning">Not Connected</span></h4>
            <h4>TBA Table Status: <span id="TBATableStatus" class="badge bg-warning">Not Connected</span></h4>
            <h4>Pit Table Status: <span id="pitTableStatus" class="badge bg-warning">Not Connected</span></h4>
            <h4>Strategic Table Status: <span id="strategicTableStatus" class="badge bg-warning">Not Connected</span></h4>
            <h4>Server: <span id="serverName" class="badge bg-primary">????</span></h4>
            <h4>Database: <span id="databaseName" class="badge bg-primary">????</span></h4>
            <h4>Username: <span id="userName" class="badge bg-primary">????</span></h4>
            <h4>TBA Key: <span id="tbaKey" class="badge bg-primary">????</span></h4>
            <h4>Event Code: <span id="eventCode" class="badge bg-primary">????</span></h4>
          </div>
        </div>

      </div>
      <div class="col-lg-6 col-sm-6 col-xs-6 gx-3">
        <div class="overflow-auto">
          <div class="card">
            <div class="card-header">
              Select Data to Use
            </div>
            <div class="card-body d-grid gap-4">
              <div class="p-2">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" name="dataGroup" id="dataP">
                  <label class="form-check-label" for="dataP">Practice</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" name="dataGroup" id="dataQm">
                  <label class="form-check-label" for="dataQm">Quals</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" name="dataGroup" id="dataQf">
                  <label class="form-check-label" for="dataQf">Quarterfinals</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" name="dataGroup" id="dataSf">
                  <label class="form-check-label" for="dataSf">Semifinals</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" name="dataGroup" id="dataF">
                  <label class="form-check-label" for="dataF">Finals</label>
                </div>
              </div>
              <div class="p-2">
                <button id="useData" class="btn btn-primary">Use this data</button>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            Export Data
          </div>
          <div class="card-body">
            <button id="exportData" class="btn btn-primary">Export picklist data to CSV</button>
          </div>
        </div>

        <div class="card">
          <div class="card-header">
            Database Config
          </div>
          <div class="card-body">
            <div class="mb-3">
              <label for="writeServer" class="form-label"> MySQL Server URL</label>
              <input type="text" class="form-control" id="writeServer" aria-describedby="serverName">
            </div>
            <div class="mb-3">
              <label for="writeDatabase" class="form-label">Database Name</label>
              <input type="text" class="form-control" id="writeDatabase" aria-describedby="databaseName">
            </div>
            <div class="mb-3">
              <label for="writeUsername" class="form-label">User Name</label>
              <input type="text" class="form-control" id="writeUsername" aria-describedby="userName">
            </div>
            <div class="mb-3">
              <label for="writePassword" class="form-label">Password</label>
              <input type="password" class="form-control" id="writePassword" aria-describedby="password">
            </div>
            <div class="mb-3">
              <label for="writeTBAKey" class="form-label">TBA Key</label>
              <input type="text" class="form-control" id="writeTBAKey" aria-describedby="tbaKey">
            </div>
            <div class="mb-3">
              <label for="writeEventCode" class="form-label">Event Code</label>
              <input type="text" class="form-control" id="writeEventCode" aria-describedby="tbaEventCode">
            </div>

            <button id="writeConfig" class="btn btn-primary">Write Config</button>
            <button id="createDB" class="btn btn-primary">Create DB</button>
            <button id="createTable" class="btn btn-primary">Create Table</button>
          </div>
        </div>

      </div>

      <!-- DB Exists Badge -->

      <!-- Create DB - DB Name + Create -->
      <!-- Write Admin Credentials - Admin Name Write -->
    </div>

  </div>
</div>
</div>

<?php include 'footer.php'; ?>

<script>

  var myEventCode = null;

  function setStatusBadge(isSuccess, id) {
    if (isSuccess) {
      $("#" + id).text("Connected");
      $("#" + id).addClass("bg-success");
      $("#" + id).removeClass("bg-warning");
      $("#" + id).removeClass("bg-danger");
    } else {
      $("#" + id).text("Not Connected");
      $("#" + id).addClass("bg-danger");
      $("#" + id).removeClass("bg-warning");
      $("#" + id).removeClass("bg-success");
    }
  }

  function updateStatusValues(statusArray) {
    $("#serverName").text(statusArray["server"]);
    $("#databaseName").text(statusArray["db"]);
    $("#userName").text(statusArray["username"]);
    $("#tbaKey").text(statusArray["tbakey"]);
    $("#eventCode").text(statusArray["eventcode"]);
    myEventCode = statusArray["eventcode"];

    setStatusBadge(statusArray["dbExists"], "dbStatus");
    setStatusBadge(statusArray["serverExists"], "serverStatus");
    setStatusBadge(statusArray["dataTableExists"], "dataTableStatus");
    setStatusBadge(statusArray["tbaTableExists"], "TBATableStatus");
    setStatusBadge(statusArray["pitTableExists"], "pitTableStatus");
    setStatusBadge(statusArray["strategicTableExists"], "strategicTableStatus");

    $("#dataP").prop('checked', statusArray["useP"]);
    $("#dataQm").prop('checked', statusArray["useQm"]);
    $("#dataQf").prop('checked', statusArray["useQf"]);
    $("#dataSf").prop('checked', statusArray["useSf"]);
    $("#dataF").prop('checked', statusArray["useF"]);
  }

  var id_to_key_map = {
    "writeServer": "server",
    "writeDatabase": "db",
    "writeUsername": "username",
    "writePassword": "password",
    "writeTBAKey": "tbakey",
    "writeEventCode": "eventcode",
  };
  var id_to_written_map = {}

  $(document).ready(function () {
    $.post("dbAPI.php", {
      "getStatus": true
    }, function (data) {
      updateStatusValues(JSON.parse(data));
    });

    for (const key in id_to_key_map) {
      id_to_written_map[key] = false;
      $("#" + key).change(function () {
        if ($("#" + key).val() == "") {
          $("#" + key).removeClass("bg-info");
          id_to_written_map[key] = false;
          if (key == "writeDatabase") {
            id_to_written_map["writeDataTable"] = false;
            id_to_written_map["writeTBATable"] = false;
            id_to_written_map["writePitTable"] = false;
            id_to_written_map["writeStrategicTable"] = false;
          }
        } else {
          $("#" + key).addClass("bg-info");
          id_to_written_map[key] = true;
          if (key == "writeDatabase") {
            // Mark tables in id_to_written_map 
            id_to_written_map["writeDataTable"] = true;
            id_to_written_map["writeTBATable"] = true;
            id_to_written_map["writePitTable"] = true;
            id_to_written_map["writeStrategicTable"] = true;
          }
        }
      });
    }

    function requestAPI() {
      //output: gets the API data from our server
      $.get("readAPI.php", {
        getAllData: 1
      }).done(function (data) {
        var dataObj = JSON.parse(data);
      });

    }

    // Returns a string with the comma-separated line of data for the given team.
    function createCSVLine(localAverages, team) {
      var onstagePercent = rnd(dummylocalAveragesLookup(localAverages, team, "endgamestagepercent"));
      var trapPercent = rnd(dummylocalAveragesLookup(localAverages, team, "trapPercentage"));
      var out = team + ",";
      out += dummylocalAveragesLookup(localAverages, team, "avgtotalnotes") + ",";
      out += dummylocalAveragesLookup(localAverages, team, "maxtotalnotes") + ",";
      out += dummylocalAveragesLookup(localAverages, team, "avgautonotes") + ",";
      out += dummylocalAveragesLookup(localAverages, team, "avgteleopnotes") + ",";
      out += dummylocalAveragesLookup(localAverages, team, "avgendgamepoints") + ",";
      out += onstagePercent + ",";
      out += trapPercent + ",";
      out += dummylocalAveragesLookup(localAverages, team, "totaldied") + ",";
      out += "-\n";    // Comment
      return out;
    }

    function dummylocalAveragesLookup(localAverages, team, item) {
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

    function download_csv() {
      console.log("starting download_csv() ");
      $.get("readAPI.php", {
        getAllData: 1
      }).done(function (data) {
        console.log("download_csv: getting mdp data ");
        matchData = JSON.parse(data);
        var mdp = new matchDataProcessor(matchData);
        var csvStr = "Team,Avg Total Notes,Max Total Notes,Avg A Notes,Avg T Notes,Avg E Notes, Onstage%, Trap%, Total Died, Comment\n";
        mdp.getSiteFilteredAverages(function (averageData) {
          for (var key in averageData) {
            csvStr += createCSVLine(averageData, key);  // key is team number
          }

          console.log("csvStr = " + csvStr);
          var hiddenElement = document.createElement('a');
          var filename = myEventCode + ".csv";
          console.log("CSV filename = " + filename);
          hiddenElement.href = 'data:text/csv;charset=utf-8,' + encodeURI(csvStr);
          hiddenElement.target = '_blank';
          hiddenElement.download = filename;
          hiddenElement.click();
        });
      });
    }

    $("#exportData").on('click', function (event) {
      download_csv();
    });

    $("#writeConfig").on('click', function (event) {
      var writeData = {};
      for (const key in id_to_key_map) {
        if ($("#" + key).val() != "" && id_to_written_map[key]) {
          writeData[id_to_key_map[key]] = $("#" + key).val();
        }
      }
      // Create table names from database name.
      var databaseName = ($("#" + "writeDatabase").val());
      writeData["datatable"] = databaseName + "_dt";
      writeData["tbatable"] = databaseName + "_tba";
      writeData["pittable"] = databaseName + "_pt";
      writeData["strategictable"] = databaseName + "_st";
      writeData["writeConfig"] = JSON.stringify(writeData);

      $.post("dbAPI.php", writeData, function (data) {
        updateStatusValues(JSON.parse(data));
      });
    });

    $("#useData").on('click', function (event) {
      // Make data to send to API
      var useData = {};
      useData["useP"] = +$("#dataP").is(":checked");
      useData["useQm"] = +$("#dataQm").is(":checked");
      useData["useQf"] = +$("#dataQf").is(":checked");
      useData["useSf"] = +$("#dataSf").is(":checked");
      useData["useF"] = +$("#dataF").is(":checked");

      var writeData = {}
      writeData["filterConfig"] = JSON.stringify(useData);

      // Make request
      $.post("dbAPI.php", writeData, function (data) {
        updateStatusValues(JSON.parse(data));
      });
    });

    $("#createDB").on('click', function (event) {
      $.post("dbAPI.php", {
        "createDB": true
      }, function (data) {
        updateStatusValues(JSON.parse(data));
      });
    });

    $("#createTable").on('click', function (event) {
      $.post("dbAPI.php", {
        "createTable": true
      }, function (data) {
        updateStatusValues(JSON.parse(data));
      });
    });
  });
</script>
<script type="text/javascript" src="./scripts/matchDataProcessor.js"></script>
