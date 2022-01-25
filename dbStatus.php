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
            <h4>Table Status: <span id="tableStatus" class="badge bg-warning">Not Connected</span></h4>
            <h4>Server: <span id="serverName" class="badge bg-primary">????</span></h4>
            <h4>Database: <span id="databaseName" class="badge bg-primary">????</span></h4>
            <h4>Username: <span id="userName" class="badge bg-primary">????</span></h4>
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
              <label for="writeTable" class="form-label">Table Name</label>
              <input type="text" class="form-control" id="writeTable" aria-describedby="tableName">
            </div>
            <div class="mb-3">
              <label for="writeUsername" class="form-label">User Name</label>
              <input type="text" class="form-control" id="writeUsername" aria-describedby="userName">
            </div>
            <div class="mb-3">
              <label for="writePassword" class="form-label">Password</label>
              <input type="password" class="form-control" id="writePassword" aria-describedby="password">
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
  function updateStatusValues(statusArray){
    $("#serverName").text(statusArray["server"]);
    $("#databaseName").text(statusArray["db"]);
    $("#userName").text(statusArray["username"]);
    if(statusArray["dbExists"]){
      $("#dbStatus").text("Connected");
      $("#dbStatus").addClass("bg-success");
      $("#dbStatus").removeClass("bg-warning");
      $("#dbStatus").removeClass("bg-danger");
    }
    else{
      $("#dbStatus").text("Not Connected");
      $("#dbStatus").addClass("bg-danger");
      $("#dbStatus").removeClass("bg-warning");
      $("#dbStatus").removeClass("bg-success");
    }
    if(statusArray["serverExists"]){
      $("#serverStatus").text("Connected");
      $("#serverStatus").addClass("bg-success");
      $("#serverStatus").removeClass("bg-warning");
      $("#serverStatus").removeClass("bg-danger");
    }
    else {
      $("#serverStatus").text("Not Connected");
      $("#serverStatus").addClass("bg-danger");
      $("#serverStatus").removeClass("bg-warning");
      $("#serverStatus").removeClass("bg-success");
    }
    if(statusArray["tableExists"]){
      $("#tableStatus").text("Connected");
      $("#tableStatus").addClass("bg-success");
      $("#tableStatus").removeClass("bg-warning");
      $("#tableStatus").removeClass("bg-danger");
    }
    else {
      $("#tableStatus").text("Not Connected");
      $("#tableStatus").addClass("bg-danger");
      $("#tableStatus").removeClass("bg-warning");
      $("#tableStatus").removeClass("bg-success");
    }
  }
  
  
  
  $(document).ready(function() {
    $.post("dbAPI.php", {"getStatus" : true}, function(data){
      console.log(data);
      updateStatusValues(JSON.parse(data));  
    });
    
    $("#writeConfig").on('click', function(event){
      var writeData = {};
      writeData["server"] = $("#writeServer").val();
      writeData["db"] = $("#writeDatabase").val();
      writeData["table"] = $("#writeTable").val();
      writeData["username"] = $("#writeUsername").val();
      writeData["password"] = $("#writePassword").val();
      writeData["writeConfig"] = true;
      
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

