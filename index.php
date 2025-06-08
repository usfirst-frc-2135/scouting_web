<?php
$title = 'Database Status';
require 'header.php';
?>

<div class="container row-offcanvas row-offcanvas-left">
  <div id="content" class="column card-lg-12 col-sm-12 col-xs-12">

    <!-- Page Title -->
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
            <h4>Match Table Status: <span id="matchTableStatus" class="badge bg-warning">Not Connected</span></h4>
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
                  <input id="dataP" class="form-check-input" type="checkbox" name="filterGroup">
                  <label for="dataP" class="form-check-label">Practice</label>
                </div>
                <div class="form-check form-check-inline">
                  <input id="dataQm" class="form-check-input" type="checkbox" name="filterGroup">
                  <label for="dataQm" class="form-check-label">Quals</label>
                </div>
                <div class="form-check form-check-inline">
                  <input id="dataQf" class="form-check-input" type="checkbox" name="filterGroup">
                  <label for="dataQf" class="form-check-label">Quarterfinals</label>
                </div>
                <div class="form-check form-check-inline">
                  <input id="dataSf" class="form-check-input" type="checkbox" name="filterGroup">
                  <label for="dataSf" class="form-check-label">Semifinals</label>
                </div>
                <div class="form-check form-check-inline">
                  <input id="dataF" class="form-check-input" type="checkbox" name="filterGroup">
                  <label for="dataF" class="form-check-label">Finals</label>
                </div>
              </div>
              <div class="p-2">
                <button id="filterData" class="btn btn-primary">Use this data</button>
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
              <label for="enterServerURL" class="form-label"> MySQL Server URL</label>
              <input id="enterServerURL" class="form-control" type="text" aria-describedby="serverName">
            </div>
            <div class="mb-3">
              <label for="enterDBName" class="form-label">Database Name</label>
              <input id="enterDBName" class="form-control" type="text" aria-describedby="databaseName">
            </div>
            <div class="mb-3">
              <label for="enterUserName" class="form-label">User Name</label>
              <input id="enterUserName" class="form-control" type="text" aria-describedby="userName">
            </div>
            <div class="mb-3">
              <label for="enterPassword" class="form-label">Password</label>
              <input id="enterPassword" class="form-control" type="password" aria-describedby="password">
            </div>
            <div class="mb-3">
              <label for="enterTBAKey" class="form-label">TBA Key</label>
              <input id="enterTBAKey" class="form-control" type="text" aria-describedby="tbaKey">
            </div>
            <div class="mb-3">
              <label for="enterEventCode" class="form-label">Event Code</label>
              <input id="enterEventCode" class="form-control" type="text" aria-describedby="tbaEventCode">
            </div>

            <div class="mb-3">
              <button id="writeConfig" class="btn btn-primary">Write Config File</button>
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

<!-- Javascript page handlers -->

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
    setStatusBadge(statusArray["matchTableExists"], "matchTableStatus");
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
    "enterServerURL": "server",
    "enterDBName": "db",
    "enterUserName": "username",
    "enterPassword": "password",
    "enterTBAKey": "tbakey",
    "enterEventCode": "eventcode",
  };

  var id_to_written_map = {}

  //
  // Process the generated html
  //
  $(document).ready(function () {
    // Update the navbar with the event code
    $.get("api/tbaAPI.php", {
      getEventCode: true
    }, function (data) {
      $("#navbarEventCode").html(data);
    });

    // Update the database statuses
    $.post("api/dbAPI.php", {
      "getDBStatus": true
    }, function (statusData) {
      updateStatusValues(JSON.parse(statusData));
    });

    // Loop through handling all fields
    for (const key in id_to_key_map) {
      id_to_written_map[key] = false;
      $("#" + key).change(function () {
        if ($("#" + key).val() == "") {
          $("#" + key).removeClass("bg-info");
          id_to_written_map[key] = false;
          if (key == "enterDBName") {
            id_to_written_map["writeMatchTable"] = false;
            id_to_written_map["writeTBATable"] = false;
            id_to_written_map["writePitTable"] = false;
            id_to_written_map["writeStrategicTable"] = false;
          }
        } else {
          $("#" + key).addClass("bg-info");
          id_to_written_map[key] = true;
          if (key == "enterDBName") {
            // Mark tables in id_to_written_map 
            id_to_written_map["writeMatchTable"] = true;
            id_to_written_map["writeTBATable"] = true;
            id_to_written_map["writePitTable"] = true;
            id_to_written_map["writeStrategicTable"] = true;
          }
        }
      });
    }

    // Write the db_config file
    $("#writeConfig").on('click', function (event) {
      var configData = {};
      for (const key in id_to_key_map) {
        if ($("#" + key).val() != "" && id_to_written_map[key]) {
          configData[id_to_key_map[key]] = $("#" + key).val();
        }
      }
      // Create table names from database name.
      var databaseName = ($("#" + "enterDBName").val());
      configData["datatable"] = databaseName + "_dt";
      configData["tbatable"] = databaseName + "_tba";
      configData["pittable"] = databaseName + "_pt";
      configData["strategictable"] = databaseName + "_st";
      configData["writeConfig"] = JSON.stringify(configData);

      $.post("api/dbAPI.php", configData, function (statusData) {
        updateStatusValues(JSON.parse(statusData));
      });
    });

    // Update the match type filters
    $("#filterData").on('click', function (event) {
      // Make data to send to API
      var filterData = {};
      filterData["useP"] = +$("#dataP").is(":checked");
      filterData["useQm"] = +$("#dataQm").is(":checked");
      filterData["useQf"] = +$("#dataQf").is(":checked");
      filterData["useSf"] = +$("#dataSf").is(":checked");
      filterData["useF"] = +$("#dataF").is(":checked");

      var configInfo = {}
      configInfo["filterConfig"] = JSON.stringify(filterData);

      // Make request
      $.post("api/dbAPI.php", configInfo, function (statusData) {
        updateStatusValues(JSON.parse(statusData));
      });
    });

    // Create a new database
    $("#createDB").on('click', function (event) {
      $.post("api/dbAPI.php", {
        "createDB": true
      }, function (statusData) {
        updateStatusValues(JSON.parse(statusData));
      });
    });

    // Create new tables in database
    $("#createTable").on('click', function (event) {
      $.post("api/dbAPI.php", {
        "createTable": true
      }, function (statusData) {
        updateStatusValues(JSON.parse(statusData));
      });
    });
  });
</script>

<script type="text/javascript" src="./scripts/matchDataProcessor.js"></script>
