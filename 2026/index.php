<?php
$title = 'Database Status';
require 'inc/header.php';
?>

<div class="container row-offcanvas row-offcanvas-left">
  <div id="content" class="column card-lg-12 col-sm-12 col-xs-12">

    <!-- Page Title -->
    <div class="row pt-3 pb-3 mb-3">
      <h2 class="col-md-6"><?php echo $title; ?></h2>
    </div>

    <div class="row mb-3">
      <div class="col-lg-6 col-sm-6 col-xs-6 gx-3">

        <!-- Status Card -->
        <div class="card">
          <div class="card-header">
            Database Status
          </div>
          <div class="card-body">
            <h5>MySQL Server Status: <span id="serverStatus" class="badge bg-warning float-end">Not Connected</span></h5>
            <h5>Database Status: <span id="databaseStatus" class="badge bg-warning float-end">Not Connected</span></h5>
            <h5>Match Table Status: <span id="matchTableStatus" class="badge bg-warning float-end">Not Connected</span></h5>
            <h5>TBA Table Status: <span id="TBATableStatus" class="badge bg-warning float-end">Not Connected</span></h5>
            <h5>Pit Table Status: <span id="pitTableStatus" class="badge bg-warning float-end">Not Connected</span></h5>
            <h5>Strategic Table Status: <span id="strategicTableStatus" class="badge bg-warning float-end">Not Connected</span></h5>
            <hr />
            <h5>MySQL Server: <span id="serverName" class="badge bg-primary float-end">????</span></h5>
            <h5>Database: <span id="databaseName" class="badge bg-primary float-end">????</span></h5>
            <h5>Username: <span id="userName" class="badge bg-primary float-end">????</span></h5>
            <h5>TBA Key: <span id="tbaKey" class="badge bg-primary float-end">????</span></h5>
            <h5>Event Code: <span id="eventCode" class="badge bg-primary float-end">????</span></h5>
          </div>
        </div>

        <!-- Match filter button card -->
        <div class="overflow-auto">
          <div class="card">
            <div class="card-header">
              Select Match Data to Use
            </div>
            <div class="card-body d-grid gap-4">
              <div class="row">
                <div class="col">
                  <div class="form-check">
                    <input id="dataP" class="form-check-input" type="checkbox" name="dataP" checked>
                    <label for="dataP" class="form-check-label">Practice</label>
                  </div>
                  <div class="form-check">
                    <input id="dataQm" class="form-check-input" type="checkbox" name="dataQm" checked>
                    <label for="dataQm" class="form-check-label">Quals</label>
                  </div>
                  <div class="form-check">
                    <input id="dataQf" class="form-check-input" type="checkbox" name="dataQf" checked>
                    <label for="dataQf" class="form-check-label">Quarterfinals</label>
                  </div>
                  <div class="form-check">
                    <input id="dataSf" class="form-check-input" type="checkbox" name="dataSf" checked>
                    <label for="dataSf" class="form-check-label">Semifinals</label>
                  </div>
                  <div class="form-check">
                    <input id="dataF" class="form-check-input" type="checkbox" name="dataF" checked>
                    <label for="dataF" class="form-check-label">Finals</label>
                  </div>
                </div>
                <div class="col">
                  <button id="filterData" class="btn btn-primary">Use these matches</button>
                </div>
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
              <input id="enterServerURL" class="form-control text-bg-warning" type="text" placeholder="(localhost)"
                aria-describedby="serverName">
            </div>
            <div class="mb-3">
              <label for="enterDBName" class="form-label">Database Name</label>
              <input id="enterDBName" class="form-control text-bg-warning" type="text" placeholder="scouting2025"
                aria-describedby="databaseName">
            </div>
            <div class="mb-3">
              <label for="enterUserName" class="form-label">User Name</label>
              <input id="enterUserName" class="form-control text-bg-warning" type="text" placeholder="DB username"
                aria-describedby="userName">
            </div>
            <div class="mb-3">
              <label for="enterPassword" class="form-label">Password</label>
              <input id="enterPassword" class="form-control text-bg-warning" type="password" placeholder="DB password"
                aria-describedby="password">
            </div>
            <div class="mb-3">
              <label for="enterTBAKey" class="form-label">TBA Key</label>
              <input id="enterTBAKey" class="form-control text-bg-warning" type="text" placeholder="(from theBlueAlliance)"
                aria-describedby="tbaKey">
            </div>
            <div class="mb-3">
              <label for="enterEventCode" class="form-label">Event Code</label>
              <input id="enterEventCode" class="form-control text-bg-warning" type="text" placeholder="2025CAFR"
                aria-describedby="tbaEventCode">
            </div>

            <div class="row mb-3 mx-auto" style=" width: 200px;">
              <button id="writeConfig" class="btn btn-primary">Write Config File</button>
            </div>
            <div class="row mb-3 mx-auto" style=" width: 200px;">
              <button id="createDB" class="btn btn-primary">Create DB</button>
            </div>
            <div class="row mb-3 mx-auto" style=" width: 200px;">
              <button id="createTable" class="btn btn-primary">Create Table</button>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<?php include 'inc/footer.php'; ?>

<!-- Javascript page handlers -->

<script>

  // Set the status badges for an item
  function setStatusBadge(id, isSuccess) {
    console.log("==> index.php: setStatusBadge()");
    document.getElementById(id).classList.remove("bg-warning");
    if (isSuccess) {
      document.getElementById(id).innerText = "Connected";
      document.getElementById(id).classList.add("bg-success");
      document.getElementById(id).classList.remove("bg-danger");
    } else {
      document.getElementById(id).innerText = "Not Connected";
      document.getElementById(id).classList.add("bg-danger");
      document.getElementById(id).classList.remove("bg-success");
    }
  }

  // Update all status badges for DB connection
  function updateStatusValues(statusArray) {
    console.log("==> index.php: updateStatusValues()");
    document.getElementById("serverName").innerText = statusArray["server"];
    document.getElementById("databaseName").innerText = statusArray["db"];
    document.getElementById("userName").innerText = statusArray["username"];
    document.getElementById("tbaKey").innerText = statusArray["tbakey"];
    document.getElementById("eventCode").innerText = statusArray["eventcode"];

    setStatusBadge("serverStatus", statusArray["serverExists"]);
    setStatusBadge("databaseStatus", statusArray["dbExists"]);
    setStatusBadge("matchTableStatus", statusArray["matchTableExists"]);
    setStatusBadge("TBATableStatus", statusArray["tbaTableExists"]);
    setStatusBadge("pitTableStatus", statusArray["pitTableExists"]);
    setStatusBadge("strategicTableStatus", statusArray["strategicTableExists"]);

    document.getElementById("dataP").checked = statusArray["useP"];
    document.getElementById("dataQm").checked = statusArray["useQm"];
    document.getElementById("dataQf").checked = statusArray["useQf"];
    document.getElementById("dataSf").checked = statusArray["useSf"];
    document.getElementById("dataF").checked = statusArray["useF"];
  }

  // Map form form-control IDs to the db_config labels that store them
  const idToKeyMap = {
    "enterServerURL": "server",
    "enterDBName": "db",
    "enterUserName": "username",
    "enterPassword": "password",
    "enterTBAKey": "tbakey",
    "enterEventCode": "eventcode",
  };

  let idToWrittenMap = {}

  /////////////////////////////////////////////////////////////////////////////
  //
  // Process the generated html
  //
  document.addEventListener("DOMContentLoaded", () => {

    // Update the navbar with the event code
    // Update the database statuses
    $.post("api/dbAPI.php", {
      getDBStatus: true
    }, function (dbStatus) {
      console.log("=> getDBStatus");
      updateStatusValues(JSON.parse(dbStatus));

      $.get("api/tbaAPI.php", {
        getEventCode: true
      }, function (eventCode) {
        eventCode = eventCode.trim();
        console.log("=> index: getEventCode: " + eventCode);
        document.getElementById("navbarEventCode").innerHTML = eventCode;
      });

    });

    // Loop through handling all fields
    for (const key in idToKeyMap) {
      idToWrittenMap[key] = false;
      let elementRef = document.getElementById(key);
      elementRef.addEventListener("change", function (evt) {
        if (elementRef.innerText === "") {
          document.getElementById(key).classList.remove("bg-info");
          idToWrittenMap[key] = false;
          if (key === "enterDBName") {
            idToWrittenMap["writeMatchTable"] = false;
            idToWrittenMap["writeTBATable"] = false;
            idToWrittenMap["writePitTable"] = false;
            idToWrittenMap["writeStrategicTable"] = false;
          }
        } else {
          elementRef.classList.add("bg-info");
          idToWrittenMap[key] = true;
          if (key === "enterDBName") {
            // Mark tables in idToWrittenMap 
            idToWrittenMap["writeMatchTable"] = true;
            idToWrittenMap["writeTBATable"] = true;
            idToWrittenMap["writePitTable"] = true;
            idToWrittenMap["writeStrategicTable"] = true;
          }
        }
      });
    }

    // Write the db_config file
    document.getElementById("writeConfig").addEventListener('click', function () {
      for (const key in idToKeyMap) {
        if (document.getElementById(key).value == "") {
          console.warn("Enter all fields: server URL, database name, username, password, TBA key, and event code.");
          alert("Enter all fields: server URL, database name, username, password, TBA key, and event code.")
          return;
        }
      }

      let configData = {};
      for (const key in idToKeyMap) {
        if (idToWrittenMap[key]) {
          configData[idToKeyMap[key]] = document.getElementById(key).value;
        }
      }
      // Create table names from database name.
      let databaseName = document.getElementById("enterDBName").value;
      console.log("index: " + databaseName);
      configData["datatable"] = databaseName + "_dt";
      configData["tbatable"] = databaseName + "_tba";
      configData["pittable"] = databaseName + "_pt";
      configData["strategictable"] = databaseName + "_st";
      configData["writeConfig"] = JSON.stringify(configData);

      $.post("api/dbAPI.php", configData, function (statusValues) {
        updateStatusValues(JSON.parse(statusValues));
      });
    });

    // Update the match type filters
    document.getElementById("filterData").addEventListener('click', function () {
      // Make data to send to API
      let filterData = {};
      filterData["useP"] = +document.getElementById("dataP").checked;
      filterData["useQm"] = +document.getElementById("dataQf").checked;
      filterData["useQf"] = +document.getElementById("dataQm").checked;
      filterData["useSf"] = +document.getElementById("dataSf").checked;
      filterData["useF"] = +document.getElementById("dataF").checked;

      let configInfo = {}
      configInfo["filterConfig"] = JSON.stringify(filterData);

      // Make request
      $.post("api/dbAPI.php", configInfo, function (statusValues) {
        updateStatusValues(JSON.parse(statusValues));
      });
    });

    // Create a new database
    document.getElementById("createDB").addEventListener('click', function () {
      $.post("api/dbAPI.php", {
        createDB: true
      }, function (statusValues) {
        console.log("=> createDB");
        updateStatusValues(JSON.parse(statusValues));
      });
    });

    // Create new tables in database
    document.getElementById("createTable").addEventListener('click', function () {
      $.post("api/dbAPI.php", {
        createTable: true
      }, function (createTable) {
        console.log("=> createDB");
        updateStatusValues(JSON.parse(createTable));
      });
    });
  });
</script>
