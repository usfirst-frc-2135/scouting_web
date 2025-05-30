<?php
$title = 'Database Status';
require 'header.php';
?>

<div class="container row-offcanvas row-offcanvas-left">
  <div id="content" class="column card-lg-12 col-sm-12 col-xs-12">

    <div class="row pt-3 pb-3 mb-3">
      <h2><?php echo $title; ?></h2>
    </div>

    <div class="row mb-3">
      <div class="col-lg-6 col-sm-6 col-xs-6 gx-3">
        <!-- Status Card -->
        <div class="card">
          <div class="card-header">
            Database Status
          </div>
          <div class="card-body">
            <h4>MySQL Server Status: <span id="serverStatus" class="badge bg-warning">Not Connected</span></h4>
            <h4>Database Status: <span id="databaseStatus" class="badge bg-warning">Not Connected</span></h4>
            <h4>Data Table Status: <span id="dataTableStatus" class="badge bg-warning">Not Connected</span></h4>
            <h4>TBA Table Status: <span id="TBATableStatus" class="badge bg-warning">Not Connected</span></h4>
            <h4>Pit Table Status: <span id="pitTableStatus" class="badge bg-warning">Not Connected</span></h4>
            <h4>Strategic Table Status: <span id="strategicTableStatus" class="badge bg-warning">Not Connected</span></h4>
            <hr />
            <h4>MySQL Server: <span id="serverName" class="badge bg-primary">????</span></h4>
            <h4>Database: <span id="databaseName" class="badge bg-primary">????</span></h4>
            <h4>Username: <span id="userName" class="badge bg-primary">????</span></h4>
            <h4>TBA Key: <span id="tbaKey" class="badge bg-primary">????</span></h4>
            <h4>Event Code: <span id="eventCode" class="badge bg-primary">????</span></h4>
          </div>
        </div>

        <!-- Match filter button card -->
        <div class="overflow-auto">
          <div class="card">
            <div class="card-header">
              Select Match Data to Use
            </div>
            <div class="card-body d-grid gap-4">
              <div class="p-2">
                <div class="form-check form-check-inline">
                  <input id="dataP" class="form-check-input" type="checkbox" name="dataGroup">
                  <label for="dataP" class="form-check-label">Practice</label>
                </div>
                <div class="form-check form-check-inline">
                  <input id="dataQm" class="form-check-input" type="checkbox" name="dataGroup">
                  <label for="dataQm" class="form-check-label">Quals</label>
                </div>
                <div class="form-check form-check-inline">
                  <input id="dataQf" class="form-check-input" type="checkbox" name="dataGroup">
                  <label for="dataQf" class="form-check-label">Quarterfinals</label>
                </div>
                <div class="form-check form-check-inline">
                  <input id="dataSf" class="form-check-input" type="checkbox" name="dataGroup">
                  <label for="dataSf" class="form-check-label">Semifinals</label>
                </div>
                <div class="form-check form-check-inline">
                  <input id="dataF" class="form-check-input" type="checkbox" name="dataGroup">
                  <label for="dataF" class="form-check-label">Finals</label>
                </div>
              </div>
              <div class="p-2">
                <button id="useData" class="btn btn-primary">Use this data</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- DB Config text entry card -->
      <div class="col-lg-6 col-sm-6 col-xs-6 gx-3">
        <div class="card">
          <div class="card-header">
            Database Config
          </div>
          <div class="card-body">
            <div class="mb-3">
              <label for="writeServer" class="form-label"> MySQL Server URL</label>
              <input id="writeServer" class="form-control" type="text" aria-describedby="serverName">
            </div>
            <div class="mb-3">
              <label for="writeDatabase" class="form-label">Database Name</label>
              <input id="writeDatabase" class="form-control" type="text" aria-describedby="databaseName">
            </div>
            <div class="mb-3">
              <label for="writeUsername" class="form-label">User Name</label>
              <input id="writeUsername" class="form-control" type="text" aria-describedby="userName">
            </div>
            <div class="mb-3">
              <label for="writePassword" class="form-label">Password</label>
              <input id="writePassword" class="form-control" type="password" aria-describedby="password">
            </div>
            <div class="mb-3">
              <label for="writeTBAKey" class="form-label">TBA Key</label>
              <input id="writeTBAKey" class="form-control" type="text" aria-describedby="tbaKey">
            </div>
            <div class="mb-3">
              <label for="writeEventCode" class="form-label">Event Code</label>
              <input id="writeEventCode" class="form-control" type="text" aria-describedby="tbaEventCode">
            </div>

            <div class="mb-3">
              <button id="writeConfig" class="btn btn-primary">Write Config</button>
              <button id="createDB" class="btn btn-primary">Create DB</button>
              <button id="createTable" class="btn btn-primary">Create Table</button>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>

<script>

  var myEventCode = null;

  // Set the status badges for an item
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

  // Update all status badges for DB connection
  function updateStatusValues(statusArray) {
    $("#serverName").text(statusArray["server"]);
    $("#databaseName").text(statusArray["db"]);
    $("#userName").text(statusArray["username"]);
    $("#tbaKey").text(statusArray["tbakey"]);
    $("#eventCode").text(statusArray["eventcode"]);
    myEventCode = statusArray["eventcode"];

    setStatusBadge(statusArray["serverExists"], "serverStatus");
    setStatusBadge(statusArray["dbExists"], "databaseStatus");
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

  // Map form form-control IDs to labels for db_config
  var id_to_key_map = {
    "writeServer": "server",
    "writeDatabase": "db",
    "writeUsername": "username",
    "writePassword": "password",
    "writeTBAKey": "tbakey",
    "writeEventCode": "eventcode",
  };

  var id_to_written_map = {}

  //
  // Process the generated html
  //
  $(document).ready(function () {
    $.post("dbAPI.php", {
      "getDBStatus": true
    }, function (data) {
      updateStatusValues(JSON.parse(data));
    });

    // Loop through handling all text fields
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

    // Write the db_config file
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

    // Update the match type filters
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

    // Create a new database
    $("#createDB").on('click', function (event) {
      $.post("dbAPI.php", {
        "createDB": true
      }, function (data) {
        updateStatusValues(JSON.parse(data));
      });
    });

    // Create new tables in database
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
