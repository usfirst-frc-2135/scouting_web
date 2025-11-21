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
            <h5>Pit Table Status: <span id="pitTableStatus" class="badge bg-warning float-end">Not Connected</span></h5>
            <h5>Match Table Status: <span id="matchTableStatus" class="badge bg-warning float-end">Not Connected</span></h5>
            <h5>Strategic Table Status: <span id="strategicTableStatus" class="badge bg-warning float-end">Not Connected</span></h5>
            <h5>TBA Table Status: <span id="TBATableStatus" class="badge bg-warning float-end">Not Connected</span></h5>
            <h5>Watch Table Status: <span id="watchTableStatus" class="badge bg-warning float-end">Not Connected</span></h5>
            <h5>Scout Table Status: <span id="scoutTableStatus" class="badge bg-warning float-end">Not Connected</span></h5>
            <h5>Alias Table Status: <span id="aliasTableStatus" class="badge bg-warning float-end">Not Connected</span></h5>
            <hr />
            <h5>MySQL Server: <span id="serverName" class="badge bg-secondary float-end">????</span></h5>
            <h5>Database: <span id="databaseName" class="badge bg-secondary float-end">????</span></h5>
            <h5>Username: <span id="userName" class="badge bg-secondary float-end">????</span></h5>
            <h5>TBA Key: <span id="tbaKey" class="badge bg-secondary float-end">????</span></h5>
            <h5>Event Code: <span id="eventCode" class="badge bg-secondary float-end">????</span></h5>
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
              <input id="enterServerURL" class="form-control text-bg-warning" type="text" placeholder="ex. localhost"
                aria-describedby="serverName">
            </div>
            <div class="mb-3">
              <label for="enterDBName" class="form-label">Database Name</label>
              <input id="enterDBName" class="form-control text-bg-warning" type="text" placeholder="ex. scouting2025"
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
              <input id="enterTBAKey" class="form-control text-bg-warning" type="text" placeholder="From theBlueAlliance"
                aria-describedby="tbaKey">
            </div>
            <div class="mb-3">
              <label for="enterEventCode" class="form-label">Event Code</label>
              <input id="enterEventCode" class="form-control text-bg-warning" type="text"
                placeholder="FRC event code (ex. 2024camb)" aria-describedby="tbaEventCode">
            </div>

            <div class="row mb-3 mx-auto" style=" width: 200px;">
              <button id="writeConfig" class="btn btn-primary">Write Config File</button>
            </div>
            <div class="row mb-3 mx-auto" style=" width: 200px;">
              <button id="createDB" class="btn btn-primary">Create DB</button>
            </div>
            <div class="row mb-3 mx-auto" style=" width: 200px;">
              <button id="createTables" class="btn btn-primary">Create Tables</button>
            </div>
          </div>
        </div>

      </div>

      <!-- DB Config text entry card -->
      <div class="col-lg-6 col-sm-6 col-xs-6 gx-3">
        <div class="card">
          <div class="card-header">
            Table Config
          </div>
          <div class="card-body">
            <div class="row mb-3 mx-auto" style=" width: 200px;">
              <a class="btn btn-primary" href="./scoutData.php" role="button">Configure Scout Names</a>
            </div>
            <div class="row mb-3 mx-auto" style=" width: 200px;">
              <a class="btn btn-primary" href="./aliasData.php" role="button">Configure Team Aliases</a>
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
  function updateStatusValues(dbStatus) {
    if (dbStatus["server"] !== "") {
      {
        console.log("==> index.php: updateStatusValues()");
        document.getElementById("serverName").innerText = dbStatus["server"];
        document.getElementById("enterServerURL").value = dbStatus["server"];
        document.getElementById("enterServerURL").classList.remove("text-bg-warning");
        document.getElementById("databaseName").innerText = dbStatus["db"];
        document.getElementById("enterDBName").value = dbStatus["db"];
        document.getElementById("enterDBName").classList.remove("text-bg-warning");
        document.getElementById("userName").innerText = dbStatus["username"];
        document.getElementById("enterUserName").value = dbStatus["username"];
        document.getElementById("enterUserName").classList.remove("text-bg-warning");
        document.getElementById("tbaKey").innerText = dbStatus["tbakey"].substring(0, 8) + "********"; // Only show partial TBAKey
        document.getElementById("enterTBAKey").value = dbStatus["tbakey"];
        document.getElementById("enterTBAKey").classList.remove("text-bg-warning");
        document.getElementById("eventCode").innerText = dbStatus["eventcode"];
        document.getElementById("enterEventCode").value = dbStatus["eventcode"];
        document.getElementById("enterEventCode").classList.remove("text-bg-warning");

        setStatusBadge("serverStatus", dbStatus["serverExists"]);
        setStatusBadge("databaseStatus", dbStatus["dbExists"]);
        setStatusBadge("matchTableStatus", dbStatus["matchTableExists"]);
        setStatusBadge("TBATableStatus", dbStatus["tbaTableExists"]);
        setStatusBadge("pitTableStatus", dbStatus["pitTableExists"]);
        setStatusBadge("strategicTableStatus", dbStatus["strategicTableExists"]);
        setStatusBadge("scoutTableStatus", dbStatus["scoutTableExists"]);
        setStatusBadge("aliasTableStatus", dbStatus["aliasTableExists"]);
        setStatusBadge("watchTableStatus", dbStatus["watchTableExists"]);

        document.getElementById("dataP").checked = dbStatus["useP"];
        document.getElementById("dataQm").checked = dbStatus["useQm"];
        document.getElementById("dataSf").checked = dbStatus["useSf"];
        document.getElementById("dataF").checked = dbStatus["useF"];
      }
    }
  }

  // Loop through field IDs and add event listeners to each one
  function addFieldListeners(idToConfigKey) {
    let fieldWriteMap = [];

    // Loop through handling all fields
    for (const id in idToConfigKey) {
      fieldWriteMap[id] = false;
      let elementRef = document.getElementById(id);
      elementRef.addEventListener("change", function (evt) {
        if (elementRef.value === "") {
          elementRef.classList.add("text-bg-warning");
          fieldWriteMap[id] = false;
          if (id === "enterDBName") {
            fieldWriteMap["writeMatchTable"] = false;
            fieldWriteMap["writeTBATable"] = false;
            fieldWriteMap["writePitTable"] = false;
            fieldWriteMap["writeStrategicTable"] = false;
          }
        } else {
          elementRef.classList.remove("text-bg-warning");
          fieldWriteMap[id] = true;
          if (id === "enterDBName") {
            fieldWriteMap["writeMatchTable"] = true;
            fieldWriteMap["writeTBATable"] = true;
            fieldWriteMap["writePitTable"] = true;
            fieldWriteMap["writeStrategicTable"] = true;
          }
        }
      });
    }
    return fieldWriteMap;
  }

  /////////////////////////////////////////////////////////////////////////////
  //
  // Process the generated html
  //
  document.addEventListener("DOMContentLoaded", function () {

    // Map form form-control IDs to the db_config labels that store them
    const idToConfigKey = {
      "enterServerURL": "server",
      "enterDBName": "db",
      "enterUserName": "username",
      "enterPassword": "password",
      "enterTBAKey": "tbakey",
      "enterEventCode": "eventcode",
    };

    // Attach listeners on the text fields
    let fieldWriteMap = addFieldListeners(idToConfigKey);

    // Update the database status badges
    $.post("api/dbAPI.php", {
      getDBStatus: true
    }, function (dbStatus) {
      console.log("=> getDBStatus");
      updateStatusValues(JSON.parse(dbStatus));
    });

    // Create the write db_config file button
    document.getElementById("writeConfig").addEventListener('click', function () {
      for (const id in idToConfigKey) {
        if (document.getElementById(id).value.trim() == "") {
          console.warn("Enter all fields: server URL, database name, username, password, TBA key, and event code.");
          return alert("Enter all fields: server URL, database name, username, password, TBA key, and event code.");
        }
      }

      // Create the config file to write
      let configData = {};
      for (const id in idToConfigKey) {
        if ((document.getElementById(id).value != "") && fieldWriteMap[id]) {
          configData[idToConfigKey[id]] = document.getElementById(id).value;
        }
      }

      // Create table names from database name
      let databaseName = document.getElementById("enterDBName").value;
      console.log("index: " + databaseName);
      configData["datatable"] = databaseName + "_match";
      configData["tbatable"] = databaseName + "_tba";
      configData["pittable"] = databaseName + "_pit";
      configData["strategictable"] = databaseName + "_strat";
      configData["scouttable"] = databaseName + "_scout";
      configData["aliastable"] = databaseName + "_alias";
      configData["watchtable"] = databaseName + "_watch";
      configData["writeConfig"] = JSON.stringify(configData);

      // Update the status badges after writing the config file and reload the page
      $.post("api/dbAPI.php", configData, function (dbStatus) {
        console.log("=> writeConfig");
        updateStatusValues(JSON.parse(dbStatus));
        location.reload(); // This updates the event code in the header
      });
    });

    // Create the filter checkbox listeners and create the config file values
    document.getElementById("filterData").addEventListener('click', function () {
      let filterData = {};
      filterData["useP"] = +document.getElementById("dataP").checked;
      filterData["useQm"] = +document.getElementById("dataQm").checked;
      filterData["useSf"] = +document.getElementById("dataSf").checked;
      filterData["useF"] = +document.getElementById("dataF").checked;

      let configInfo = {}
      configInfo["filterConfig"] = JSON.stringify(filterData);

      // Make request
      $.post("api/dbAPI.php", configInfo, function (dbStatus) {
        console.log("=> filterConfig");
        updateStatusValues(JSON.parse(dbStatus));
      });
    });

    // Create the button to create a new database
    document.getElementById("createDB").addEventListener('click', function () {
      $.post("api/dbAPI.php", {
        createDB: true
      }, function (dbStatus) {
        console.log("=> createDB");
        updateStatusValues(JSON.parse(dbStatus));
        alert("While this might create a new database, it cannot add permissions for this username! This must be done using phpMyAdmin.");
      });
    });

    // Create the button to create new tables in the atabase
    document.getElementById("createTables").addEventListener('click', function () {
      $.post("api/dbAPI.php", {
        createTables: true
      }, function (createTables) {
        console.log("=> createTables");
        updateStatusValues(JSON.parse(createTables));
      });
    });
  });

</script>
