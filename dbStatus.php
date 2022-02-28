<title>DB Status</title>
<?php include("header.php") ?>

<div class="container row-offcanvas row-offcanvas-left">
    <div class="well column  col-lg-12  col-sm-12 col-xs-12" id="content">
    
      <div class="row pt-3 pb-3 mb-3">
        <div class="card col-md-6">
          <div class="card-header">
            Database Status
          </div>
          <div class="card-body">
            <h4>SQL Server Status: <span id="serverStatus" class="badge bg-warning">Not Connected</span></h4>
            <h4>Database Server Status: <span id="dbStatus" class="badge bg-warning">Not Connected</span></h4>
            <h4>Data Table Status: <span id="dataTableStatus" class="badge bg-warning">Not Connected</span></h4>
            <h4>TBA Table Status: <span id="TBATableStatus" class="badge bg-warning">Not Connected</span></h4>
            <h4>Pit Table Status: <span id="pitTableStatus" class="badge bg-warning">Not Connected</span></h4>
            <h4>Rank Table Status: <span id="rankTableStatus" class="badge bg-warning">Not Connected</span></h4>
            <h4>Server: <span id="serverName" class="badge bg-primary">????</span></h4>
            <h4>Database: <span id="databaseName" class="badge bg-primary">????</span></h4>
            <h4>Username: <span id="userName" class="badge bg-primary">????</span></h4>
            <h4>TBA Key: <span id="tbaKey" class="badge bg-primary">????</span></h4>
            <h4>Event Code: <span id="eventCode" class="badge bg-primary">????</span></h4>
            <br>
            <h3>Firebase Config</h3>
            <h4>Firebase API Key: <span id="writefbapikey" class="badge bg-primary">????</span></h4>
            <h4>Firebase Auth Domain: <span id="writefbauthdomain" class="badge bg-primary">????</span></h4>
            <h4>Firebase DB URL: <span id="writefbdburl" class="badge bg-primary">????</span></h4>
            <h4>Firebase Project ID: <span id="writefbprojectid" class="badge bg-primary">????</span></h4>
            <h4>Firebase Storage Bucket: <span id="writefbstoragebucket" class="badge bg-primary">????</span></h4>
            <h4>Firebase Sender ID: <span id="writefbsenderid" class="badge bg-primary">????</span></h4>
            <h4>Firebase App ID: <span id="writefbappid" class="badge bg-primary">????</span></h4>
            <h4>Firebase Measurement ID: <span id="writefbmeasurementid" class="badge bg-primary">????</span></h4>
          </div>
        </div>
        
        
        <div class="card col-md-6">
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
              <label for="writeDataTable" class="form-label">Data Table Name</label>
              <input type="text" class="form-control" id="writeDataTable" aria-describedby="writeTableName">
            </div>
            <div class="mb-3">
              <label for="writeTBATable" class="form-label">TBA Table Name</label>
              <input type="text" class="form-control" id="writeTBATable" aria-describedby="writeTBATable">
            </div>
            <div class="mb-3">
              <label for="writePitTable" class="form-label">Pit Table Name</label>
              <input type="text" class="form-control" id="writePitTable" aria-describedby="writePitTable">
            </div>
            <div class="mb-3">
              <label for="writeRankTable" class="form-label">Rank Table Name</label>
              <input type="text" class="form-control" id="writeRankTable" aria-describedby="writeRankTable">
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
            <div class="mb-3">
              <label for="fbAPIKey" class="form-label">Firebase API Key</label>
              <input type="text" class="form-control" id="fbAPIKey" aria-describedby="fbAPIKey">
            </div>
            <div class="mb-3">
              <label for="fbAuthDomain" class="form-label">Firebase Authentication Domain</label>
              <input type="text" class="form-control" id="fbAuthDomain" aria-describedby="fbAuthDomain">
            </div>
            <div class="mb-3">
              <label for="fbDBUrl" class="form-label">Firebase DB URL</label>
              <input type="text" class="form-control" id="fbDBUrl" aria-describedby="fbDBUrl">
            </div>
            <div class="mb-3">
              <label for="fbProjectID" class="form-label">Firebase Project ID</label>
              <input type="text" class="form-control" id="fbProjectID" aria-describedby="fbProjectID">
            </div>
            <div class="mb-3">
              <label for="fbStorageBucket" class="form-label">Firebase Storage Bucket</label>
              <input type="text" class="form-control" id="fbStorageBucket" aria-describedby="fbStorageBucket">
            </div>
            <div class="mb-3">
              <label for="fbSenderID" class="form-label">Firebase Sender ID</label>
              <input type="text" class="form-control" id="fbSenderID" aria-describedby="fbSenderID">
            </div>
            <div class="mb-3">
              <label for="fbAppID" class="form-label">Firebase Application ID</label>
              <input type="text" class="form-control" id="fbAppID" aria-describedby="fbAppID">
            </div>
            <div class="mb-3">
              <label for="fbMeasurementID" class="form-label">Firebase Measurement ID</label>
              <input type="text" class="form-control" id="fbMeasurementID" aria-describedby="fbMeasurementID">
            </div>
            <button id="writeConfig" class="btn btn-primary">Write Config</button>
            <button id="createDB" class="btn btn-primary">Create DB</button>
            <button id="createTable" class="btn btn-primary">Create Table</button>
          </div>
        </div>
        <!-- DB Exists Badge -->
        
        <!-- Create DB - DB Name + Create -->
        <!-- Write Admin Credentials - Admin Name Write -->
      </div>
      
  </div>
  </div>
</div>
<?php include("footer.php") ?>
<script>
  
  
  function setStatusBadge(isSuccess, id){
    if(isSuccess){
      $("#"+id).text("Connected");
      $("#"+id).addClass("bg-success");
      $("#"+id).removeClass("bg-warning");
      $("#"+id).removeClass("bg-danger");
    }
    else{
      $("#"+id).text("Not Connected");
      $("#"+id).addClass("bg-danger");
      $("#"+id).removeClass("bg-warning");
      $("#"+id).removeClass("bg-success");
    }
  }
  
  function updateStatusValues(statusArray){
    $("#serverName").text(statusArray["server"]);
    $("#databaseName").text(statusArray["db"]);
    $("#userName").text(statusArray["username"]);
    $("#tbaKey").text(statusArray["tbakey"]);
    $("#eventCode").text(statusArray["eventcode"]);
    
    setStatusBadge(statusArray["dbExists"], "dbStatus");
    setStatusBadge(statusArray["serverExists"], "serverStatus");
    setStatusBadge(statusArray["dataTableExists"], "dataTableStatus");
    setStatusBadge(statusArray["tbaTableExists"], "TBATableStatus");
    setStatusBadge(statusArray["pitTableExists"], "pitTableStatus");
    setStatusBadge(statusArray["rankTableExists"], "rankTableStatus");
    
    $("#writefbapikey").text(statusArray["fbapikey"]);
    $("#writefbauthdomain").text(statusArray["fbauthdomain"]);
    $("#writefbdburl").text(statusArray["fbdburl"]);
    $("#writefbprojectid").text(statusArray["fbprojectid"]);
    $("#writefbstoragebucket").text(statusArray["fbstoragebucket"]);
    $("#writefbsenderid").text(statusArray["fbsenderid"]);
    $("#writefbappid").text(statusArray["fbappid"]);
    $("#writefbmeasurementid").text(statusArray["fbmeasurementid"]);
  }
  
  
  var id_to_key_map = {"writeServer" : "server", "writeDatabase" : "db", "writeUsername" : "username", 
                       "writePassword" : "password", "writeTBAKey" : "tbakey", "writeEventCode" : "eventcode",
                       "writeDataTable" : "datatable", "writeTBATable" : "tbatable",
                       "writePitTable" : "pittable", "writeRankTable" : "ranktable",
                       "fbAPIKey" : "fbapikey", "fbAuthDomain" : "fbauthdomain", "fbDBUrl" : "fbdburl", 
                       "fbProjectID" : "fbprojectid", "fbStorageBucket" : "fbstoragebucket", "fbSenderID" : "fbsenderid",
                       "fbAppID" : "fbappid", "fbMeasurementID" : "fbmeasurementid"};
  var id_to_written_map = {}
  
  
  $(document).ready(function() {
    $.post("dbAPI.php", {"getStatus" : true}, function(data){
      updateStatusValues(JSON.parse(data));  
    });
    
    
    for(const key in id_to_key_map){
      id_to_written_map[key] = false;
      $("#"+key).change(function() {
        if ($("#"+key).val() == ""){
          $("#"+key).removeClass("bg-info");
          id_to_written_map[key] = false;
        }
        else{
          $("#"+key).addClass("bg-info");
          id_to_written_map[key] = true;
        }
      });
    }
    
    
    $("#writeConfig").on('click', function(event){
      var writeData = {};
      for(const key in id_to_key_map){
        if($("#"+key).val() != "" && id_to_written_map[key]){
          writeData[id_to_key_map[key]] = $("#"+key).val();
        }
      }
      console.log(writeData);
      writeData["writeConfig"] = JSON.stringify(writeData);
      
      $.post("dbAPI.php", writeData, function(data){
        updateStatusValues(JSON.parse(data));  
      }); 
    });
    
    $("#createDB").on('click', function(event){
      $.post("dbAPI.php", {"createDB" : true}, function(data){
        updateStatusValues(JSON.parse(data));  
      }); 
    });
    
    $("#createTable").on('click', function(event){
      $.post("dbAPI.php", {"createTable" : true}, function(data){
        updateStatusValues(JSON.parse(data));  
      });  
    });
  });
</script>

